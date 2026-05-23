<?php

namespace App\Http\Middleware;

use App\Models\Module;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Проверяет рендеринг KB-страниц: если БД говорит layout=sidebar, но в HTML нет sidebar —
 * добавляет header X-KB-Layout-Issue и пишет в лог. Если утекли blade-директивы (@php, @verbatim)
 * — то же самое. Работает только для KB-маршрутов и только в local/development.
 */
class KbLayoutChecker
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $this->shouldCheck($request, $response)) {
            return $response;
        }

        $slug = $request->route('slug');
        if (! $slug) {
            return $response;
        }

        $module = Module::query()->where('slug', $slug)->first();
        if (! $module) {
            return $response;
        }

        $html = $response->getContent();
        $issues = $this->detectIssues($html, $module);

        if (! empty($issues)) {
            foreach ($issues as $issue) {
                Log::warning('kb.layout.issue', [
                    'slug'   => $slug,
                    'issue'  => $issue,
                    'layout' => $module->layout,
                ]);
            }
            $response->headers->set('X-KB-Layout-Issue', implode('; ', $issues));

            // Авто-фикс №1: если найдена утечка @verbatim/@php — это почти всегда
            // следствие старого view-кеша. Сбрасываем и просим обновить вкладку.
            if ($this->hasBladeLeakage($html)) {
                @unlink(storage_path('framework/views/' . md5($module->file . '.blade.php') . '.php'));
                \Illuminate\Support\Facades\Artisan::call('view:clear');
                Log::info('kb.layout.auto-fix.view-clear', ['slug' => $slug]);
            }
        }

        return $response;
    }

    private function shouldCheck(Request $request, Response $response): bool
    {
        return app()->environment(['local', 'development', 'testing'])
            && $response->getStatusCode() === 200
            && str_contains((string) $response->headers->get('Content-Type'), 'text/html');
    }

    private function detectIssues(string $html, Module $module): array
    {
        $issues = [];

        if ($module->layout === 'sidebar' && ! str_contains($html, 'class="sidebar"')) {
            $issues[] = 'sidebar missing in HTML despite layout=sidebar in DB';
        }

        if ($module->layout === 'sidebar' && substr_count($html, 'class="nav-item') === 0) {
            $issues[] = 'no nav-items rendered';
        }

        if ($this->hasBladeLeakage($html)) {
            $issues[] = 'blade directives leaked as plain text (@php/@foreach/@verbatim)';
        }

        // Проверка что pre code имеет видимый цвет (фикс прошлого инцидента)
        if (str_contains($html, '<pre>') && ! preg_match('/pre\s+code\s*\{[^}]*color\s*:/i', $html)) {
            $issues[] = 'pre has no explicit code color — operators may be invisible on dark bg';
        }

        return $issues;
    }

    private function hasBladeLeakage(string $html): bool
    {
        // Ищем директивы внутри <body>, а не в скриптах/JS
        $bodyStart = stripos($html, '<body');
        if ($bodyStart === false) {
            return false;
        }
        $body = substr($html, $bodyStart);
        return preg_match('/(?:^|\s)@(?:php|foreach|if|endif|endforeach|endphp|verbatim|endverbatim)\b/m', $body) === 1;
    }
}
