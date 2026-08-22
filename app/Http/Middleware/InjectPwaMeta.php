<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * InjectPwaMeta — добавляет PWA meta-теги + регистрацию Service Worker
 * во все HTML-ответы перед закрывающим </head>.
 *
 * Не редактируем blade-файлы (там @verbatim — директивы не работают).
 * Вместо этого делаем чистую инжекцию HTML на уровне response.
 */
final class InjectPwaMeta
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Только HTML ответы
        $contentType = (string) $response->headers->get('Content-Type', '');
        if (!str_contains($contentType, 'text/html')) {
            return $response;
        }

        // Только успешные
        if ($response->getStatusCode() !== 200) {
            return $response;
        }

        $content = $response->getContent();
        if ($content === false || $content === '') {
            return $response;
        }

        // Если уже инжектили — пропускаем
        if (str_contains($content, '<!-- PWA-INJECTED -->')) {
            return $response;
        }

        $pwaHead = $this->buildPwaHead();

        // Вставляем перед </head> (если есть)
        if (str_contains($content, '</head>')) {
            $content = str_replace('</head>', $pwaHead . "\n</head>", $content);
            $response->setContent($content);
        }

        return $response;
    }

    private function buildPwaHead(): string
    {
        return <<<'HTML'

    <!-- PWA-INJECTED -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#404357">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Backend KB">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/icon-192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/icon-512.png">
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .catch((err) => console.warn('SW registration failed:', err));
            });
        }
    </script>
HTML;
    }
}
