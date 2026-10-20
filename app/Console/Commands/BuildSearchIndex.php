<?php

namespace App\Console\Commands;

use App\Models\Module;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Собирает индекс для поиска в шапке: модули и их разделы.
 * Разделы берутся из разметки blade — из пунктов бокового меню,
 * поэтому индекс всегда совпадает с тем, что видно на странице.
 */
class BuildSearchIndex extends Command
{
    protected $signature = 'kb:search-index {--path=search-index.json : куда писать, относительно public/}';

    protected $description = 'Строит public/search-index.json по опубликованным модулям';

    public function handle(): int
    {
        $index = [];
        $skipped = [];

        foreach (Module::orderBy('sort_order')->get() as $module) {
            $view = str_replace('.', '/', $module->file ?? '') . '.blade.php';
            $path = resource_path('views/' . $view);

            if (! is_file($path)) {
                $skipped[] = $module->slug . ' (нет файла ' . $view . ')';
                continue;
            }

            $index[] = [
                'slug'     => $module->slug,
                'title'    => trim(html_entity_decode(strip_tags($module->title ?? $module->slug), ENT_QUOTES | ENT_HTML5, 'UTF-8')),
                'badge'    => $module->badge,
                'sections' => $this->sections(File::get($path)),
            ];
        }

        $out = public_path($this->option('path'));
        File::put($out, json_encode($index, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $sections = array_sum(array_map(fn ($m) => count($m['sections']), $index));
        $this->info(sprintf('%s: %d модулей, %d разделов, %d КБ',
            $this->option('path'), count($index), $sections, (int) (filesize($out) / 1024)));

        foreach ($skipped as $s) {
            $this->warn('пропущен ' . $s);
        }

        return self::SUCCESS;
    }

    /**
     * Вытаскивает пункты меню: showSection('<id>') и подпись ссылки.
     */
    private function sections(string $html): array
    {
        $pattern = '/<a\s[^>]*class="nav-item[^"]*"[^>]*onclick="showSection\(\s*\'([^\']+)\'[^)]*\)"[^>]*>(.*?)<\/a>/su';

        if (! preg_match_all($pattern, $html, $m, PREG_SET_ORDER)) {
            return [];
        }

        $out = [];
        foreach ($m as $hit) {
            $label = html_entity_decode(strip_tags($hit[2]), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $label = trim(preg_replace('/\s+/u', ' ', $label));
            if ($label === '') {
                continue;
            }
            $out[] = ['id' => $hit[1], 'label' => $label];
        }

        return $out;
    }
}
