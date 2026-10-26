<?php

namespace App\Console\Commands;

use App\Models\Module;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Собирает индекс для поиска в шапке.
 *
 * На каждый раздел пишутся три вещи:
 *   label — подпись пункта бокового меню;
 *   subs  — подпункты меню, если они есть, с якорем для перехода;
 *   terms — слова из тела раздела: заголовки подразделов и идентификаторы
 *           из блоков кода. Благодаря им запрос вроде «response» находит
 *           раздел, в названии которого этого слова нет.
 *
 * Разметка берётся из blade, поэтому индекс всегда совпадает со страницей.
 */
class BuildSearchIndex extends Command
{
    protected $signature = 'kb:search-index
        {--path=search-index.json : куда писать, относительно public/}
        {--with-private : включить закрытые модули (только для локальной работы)}';

    protected $description = 'Строит public/search-index.json по опубликованным модулям';

    /**
     * Модули, которых не должно быть в индексе: они не публикуются.
     * Индекс отдаётся всем, поэтому даже названия их разделов наружу не идут.
     * По умолчанию исключаются всегда — выключить можно только флагом.
     */
    private const PRIVATE_SLUGS = [
        'KB_7_SSO',
        'KB_8_MegaRega',
        'KB_15_Career_Paths',
    ];

    /** Сколько слов хранить на раздел: дальше растёт размер файла, а польза нет. */
    private const TERMS_PER_SECTION = 160;

    /** Доля разделов, после которой слово считается слишком общим. */
    private const MAX_SECTION_SHARE = 0.12;

    /** Шум, который только раздувает индекс и совпадает со всем подряд. */
    private const STOPWORDS = [
        'если', 'иначе', 'когда', 'тогда', 'этот', 'этого', 'этом', 'эта', 'это',
        'которые', 'который', 'которая', 'чтобы', 'потому', 'поэтому', 'может',
        'можно', 'нужно', 'надо', 'будет', 'было', 'быть', 'есть', 'всех', 'всего',
        'тоже', 'также', 'только', 'через', 'после', 'перед', 'между', 'вместо',
        'каждый', 'каждая', 'свой', 'своя', 'своих', 'один', 'одна', 'одно',
        'что', 'как', 'для', 'при', 'или', 'над', 'под', 'без', 'про',
        'true', 'false', 'null', 'return', 'function', 'class', 'public',
        'private', 'protected', 'static', 'const', 'this', 'self', 'void',
        'string', 'array', 'const', 'let', 'var', 'else', 'from', 'with',
        'php', 'artisan', 'echo', 'name', 'value', 'data', 'type', 'item',
    ];

    public function handle(): int
    {
        $index = [];
        $skipped = [];
        $private = $this->option('with-private') ? [] : array_flip(self::PRIVATE_SLUGS);

        foreach (Module::orderBy('sort_order')->get() as $module) {
            if (isset($private[$module->slug])) {
                $skipped[] = $module->slug . ' (закрытый модуль)';
                continue;
            }

            $view = str_replace('.', '/', $module->file ?? '') . '.blade.php';
            $path = resource_path('views/' . $view);

            if (! is_file($path)) {
                $skipped[] = $module->slug . ' (нет файла ' . $view . ')';
                continue;
            }

            $html = File::get($path);

            $index[] = [
                'slug'     => $module->slug,
                'title'    => $this->plain($module->title ?? $module->slug),
                'badge'    => $module->badge,
                'sections' => $this->sections($html),
            ];
        }

        $index = $this->dropTooCommon($index);

        $out = public_path($this->option('path'));
        File::put($out, json_encode($index, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $sections = array_sum(array_map(fn ($m) => count($m['sections']), $index));
        $subs = array_sum(array_map(
            fn ($m) => array_sum(array_map(fn ($s) => count($s['subs'] ?? []), $m['sections'])),
            $index
        ));

        $this->info(sprintf('%s: %d модулей, %d разделов, %d подразделов, %d КБ',
            $this->option('path'), count($index), $sections, $subs, (int) (filesize($out) / 1024)));

        foreach ($skipped as $s) {
            $this->warn('пропущен ' . $s);
        }

        return self::SUCCESS;
    }

    /**
     * Выбрасывает слова, встречающиеся в слишком многих разделах.
     *
     * Такое слово не сужает выбор: по запросу «laravel» подсветились бы
     * двести разделов, и полезный среди них потерялся бы. Заодно это
     * заметно уменьшает файл, который грузится в браузер.
     */
    private function dropTooCommon(array $index): array
    {
        $total = 0;
        $df = [];

        foreach ($index as $mod) {
            foreach ($mod['sections'] as $sec) {
                $total++;
                foreach (explode(' ', $sec['terms'] ?? '') as $word) {
                    if ($word !== '') {
                        $df[$word] = ($df[$word] ?? 0) + 1;
                    }
                }
            }
        }

        if ($total === 0) {
            return $index;
        }

        $limit = max(8, (int) ($total * self::MAX_SECTION_SHARE));
        $dropped = 0;

        foreach ($index as $i => $mod) {
            foreach ($mod['sections'] as $j => $sec) {
                if (! isset($sec['terms'])) {
                    continue;
                }

                $kept = array_values(array_filter(
                    explode(' ', $sec['terms']),
                    fn ($w) => $w !== '' && ($df[$w] ?? 0) <= $limit
                ));

                $dropped += count(explode(' ', $sec['terms'])) - count($kept);

                if ($kept === []) {
                    unset($index[$i]['sections'][$j]['terms']);
                } else {
                    $index[$i]['sections'][$j]['terms'] = implode(' ', $kept);
                }
            }
            $index[$i]['sections'] = array_values($index[$i]['sections']);
        }

        $this->line(sprintf('  отсеяно %d вхождений слишком общих слов (порог: больше %d разделов)',
            $dropped, $limit));

        return $index;
    }

    /**
     * Пункты меню верхнего уровня: showSection('<id>') и подпись ссылки.
     */
    private function sections(string $html): array
    {
        $pattern = '/<a\s[^>]*class="nav-item[^"]*"[^>]*onclick="showSection\(\s*\'([^\']+)\'[^)]*\)"[^>]*>(.*?)<\/a>/su';

        if (! preg_match_all($pattern, $html, $m, PREG_SET_ORDER)) {
            return [];
        }

        $subs = $this->subs($html);
        $bodies = $this->bodies($html);

        $out = [];
        foreach ($m as $hit) {
            $id = $hit[1];
            $label = $this->plain($hit[2]);

            if ($label === '') {
                continue;
            }

            $section = ['id' => $id, 'label' => $label];

            if (! empty($subs[$id])) {
                $section['subs'] = $subs[$id];
            }

            $terms = $this->terms($bodies[$id] ?? '', $label, $subs[$id] ?? []);
            if ($terms !== '') {
                $section['terms'] = $terms;
            }

            $out[] = $section;
        }

        return $out;
    }

    /**
     * Подпункты меню: showSub('<sectionId>', '<anchorId>').
     * Возвращает карту sectionId => [['id' => anchorId, 'label' => ...], ...].
     */
    private function subs(string $html): array
    {
        $pattern = '/<a\s[^>]*class="nav-subitem[^"]*"[^>]*onclick="showSub\(\s*\'([^\']+)\'\s*,\s*\'([^\']+)\'[^)]*\)"[^>]*>(.*?)<\/a>/su';

        if (! preg_match_all($pattern, $html, $m, PREG_SET_ORDER)) {
            return [];
        }

        $out = [];
        foreach ($m as $hit) {
            $label = $this->plain($hit[3]);
            if ($label === '') {
                continue;
            }
            $out[$hit[1]][] = ['id' => $hit[2], 'label' => $label];
        }

        return $out;
    }

    /**
     * Тело каждого раздела: от своего <div id="sec-..."> до следующего.
     * Разделы лежат соседями, поэтому резать по началу следующего достаточно.
     */
    private function bodies(string $html): array
    {
        if (! preg_match_all('/<div\s+id="sec-([^"]+)"/', $html, $m, PREG_OFFSET_CAPTURE)) {
            return [];
        }

        $out = [];
        $count = count($m[0]);

        for ($i = 0; $i < $count; $i++) {
            $start = $m[0][$i][1];
            $end = $i + 1 < $count ? $m[0][$i + 1][1] : strlen($html);
            $out[$m[1][$i][0]] = substr($html, $start, $end - $start);
        }

        return $out;
    }

    /**
     * Слова для полнотекстового совпадения: заголовки подразделов и
     * идентификаторы из блоков кода. Именно их люди и ищут — имена методов,
     * классов и команд.
     */
    private function terms(string $body, string $label, array $subs): string
    {
        if ($body === '') {
            return '';
        }

        $chunks = [];

        // заголовки подразделов — там самые осмысленные формулировки
        if (preg_match_all('/<div class="subsection-title"[^>]*>(.*?)<\/div>/su', $body, $m)) {
            $chunks[] = implode(' ', array_map(fn ($s) => $this->plain($s), $m[1]));
        }

        // код: имена методов, классов, команд, колонок
        if (preg_match_all('/<(?:code|pre)\b[^>]*>(.*?)<\/(?:code|pre)>/su', $body, $m)) {
            $chunks[] = implode(' ', array_map(fn ($s) => $this->plain($s), $m[1]));
        }

        $text = mb_strtolower(implode(' ', $chunks), 'UTF-8');

        if (! preg_match_all('/[\p{L}][\p{L}\p{N}_]{3,}/u', $text, $m)) {
            return '';
        }

        // уже сказанное в подписи пункта искать не нужно — там и так совпадёт
        $known = array_flip(preg_split('/\W+/u', mb_strtolower(
            $label . ' ' . implode(' ', array_column($subs, 'label')), 'UTF-8'
        )) ?: []);

        $stop = array_flip(self::STOPWORDS);
        $seen = [];

        foreach ($m[0] as $word) {
            $word = str_replace('ё', 'е', $word);

            if (isset($stop[$word], $known[$word]) || isset($stop[$word]) || isset($known[$word])) {
                continue;
            }

            $seen[$word] = true;

            if (count($seen) >= self::TERMS_PER_SECTION) {
                break;
            }
        }

        return implode(' ', array_keys($seen));
    }

    /** HTML → читаемая строка в одну линию. */
    private function plain(string $html): string
    {
        $text = html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return trim(preg_replace('/\s+/u', ' ', $text));
    }
}
