<?php

namespace App\Console\Commands;

use App\Models\Module;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Собирает индекс для поиска в шапке.
 *
 * На каждый раздел пишутся две вещи:
 *   label — подпись пункта бокового меню;
 *   subs  — подпункты меню, если они есть, с якорем для перехода.
 *
 * Разметка берётся из blade, поэтому индекс всегда совпадает со страницей.
 *
 * Вторым файлом пишется текст разделов для поиска по содержимому: он лежит
 * вне public и просматривается на сервере, см. KbSearchController.
 */
class BuildSearchIndex extends Command
{
    protected $signature = 'kb:search-index
        {--locale=ru : язык базы: ru или en}
        {--path= : куда писать, относительно public/; по умолчанию зависит от языка}
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

    /** Текст разделов для серверного поиска, относительно storage/. */
    private const CORPUS_FILE = 'app/kb-search-text%s.ndjson';

    public function handle(): int
    {
        $locale = (string) $this->option('locale');

        if (! in_array($locale, ['ru', 'en'], true)) {
            $this->error('неизвестный язык: ' . $locale);

            return self::FAILURE;
        }

        $suffix = $locale === 'ru' ? '' : '.' . $locale;
        $target = $this->option('path') ?: 'search-index' . $suffix . '.json';

        $index = [];
        $skipped = [];
        $corpus = [];
        $private = $this->option('with-private') ? [] : array_flip(self::PRIVATE_SLUGS);
        $titles = trans('kb.modules', [], $locale);

        foreach (Module::orderBy('sort_order')->get() as $module) {
            if (isset($private[$module->slug])) {
                $skipped[] = $module->slug . ' (закрытый модуль)';
                continue;
            }

            $view = $this->viewPath($module->file ?? '', $locale);
            $path = resource_path('views/' . $view);

            // для перевода индексируем только то, что переведено:
            // иначе поиск по-английски выдавал бы русский текст
            if (! is_file($path)) {
                $skipped[] = $module->slug . ($locale === 'ru'
                    ? ' (нет файла ' . $view . ')'
                    : ' (ещё не переведён)');
                continue;
            }

            $html = File::get($path);
            $title = $this->plain($titles[$module->slug]['title'] ?? $module->title ?? $module->slug);

            $index[] = [
                'slug'     => $module->slug,
                'title'    => $title,
                'badge'    => $module->badge,
                'sections' => $this->sections($html),
            ];

            $corpus[] = ['slug' => $module->slug, 'title' => $title, 'html' => $html];
        }

        $out = public_path($target);
        File::put($out, json_encode($index, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $sections = array_sum(array_map(fn ($m) => count($m['sections']), $index));
        $subs = array_sum(array_map(
            fn ($m) => array_sum(array_map(fn ($s) => count($s['subs'] ?? []), $m['sections'])),
            $index
        ));

        $this->info(sprintf('%s: %d модулей, %d разделов, %d подразделов, %d КБ',
            $target, count($index), $sections, $subs, (int) (filesize($out) / 1024)));

        $this->writeCorpus($corpus, $index, $suffix);

        foreach ($skipped as $s) {
            $this->warn('пропущен ' . $s);
        }

        return self::SUCCESS;
    }

    /**
     * Пишет текст разделов для поиска на сервере.
     *
     * Формат — по одной записи JSON на строку: файл читается построчно и
     * не разбирается целиком, поэтому поиск не зависит от общего объёма.
     * Лежит вне public: отдавать три мегабайта текста в браузер незачем.
     */
    private function writeCorpus(array $corpus, array $index, string $suffix): void
    {
        $labels = [];
        foreach ($index as $mod) {
            foreach ($mod['sections'] as $sec) {
                $labels[$mod['slug']][$sec['id']] = $sec['label'];
            }
        }

        $file = sprintf(self::CORPUS_FILE, $suffix);
        $out = storage_path($file);
        File::ensureDirectoryExists(dirname($out));

        $handle = fopen($out, 'w');
        $rows = 0;

        foreach ($corpus as $mod) {
            foreach ($this->bodies($mod['html']) as $id => $body) {
                $label = $labels[$mod['slug']][$id] ?? null;

                // раздела нет в меню — значит и перейти к нему некуда
                if ($label === null) {
                    continue;
                }

                $text = $this->readable($body);

                if ($text === '') {
                    continue;
                }

                fwrite($handle, json_encode([
                    'm' => $mod['slug'],
                    'n' => $mod['title'],
                    's' => $id,
                    'l' => $label,
                    't' => $text,
                ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n");

                $rows++;
            }
        }

        fclose($handle);

        $this->info(sprintf('%s: %d разделов, %d КБ',
            $file, $rows, (int) (filesize($out) / 1024)));
    }

    /**
     * Тело раздела → читаемый текст одной строкой.
     * Пробелы вокруг тегов сохраняются, иначе соседние слова слипаются.
     */
    private function readable(string $html): string
    {
        $text = preg_replace('/<(script|style)\b.*?<\/\1>/su', ' ', $html);
        $text = preg_replace('/<[^>]+>/u', ' ', $text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return trim(preg_replace('/\s+/u', ' ', $text));
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
     * Где лежит blade модуля для нужного языка:
     * kb.KB_3_Laravel -> kb/KB_3_Laravel.blade.php, для en — kb/en/KB_3_Laravel.blade.php
     */
    private function viewPath(string $view, string $locale): string
    {
        $parts = explode('.', $view);
        $name = array_pop($parts);

        if ($locale !== 'ru') {
            $parts[] = $locale;
        }

        return implode('/', [...$parts, $name]) . '.blade.php';
    }

    /** HTML → читаемая строка в одну линию. */
    private function plain(string $html): string
    {
        $text = html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return trim(preg_replace('/\s+/u', ' ', $text));
    }
}
