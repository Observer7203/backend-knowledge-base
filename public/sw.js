/**
 * Backend KB — Service Worker (PWA offline cache)
 *
 * Стратегия: stale-while-revalidate
 * — Первый запрос: загружаем, кладём в кеш, отдаём пользователю
 * — Повторный запрос: сразу отдаём из кеша + параллельно тянем свежую версию в фон
 * — Без интернета: всегда из кеша (даже если 1 раз заходил)
 */

const CACHE_VERSION = 'kb-v1';
const CACHE_NAME = `backend-kb-${CACHE_VERSION}`;

// Базовый набор для оффлайн-фолбэка
const CORE_ASSETS = [
    '/',
    '/manifest.json',
    '/icon-192.png',
    '/icon-512.png',
    '/apple-touch-icon.png'
];

// Install: предкеш core assets
self.addEventListener('install', (event) => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(CORE_ASSETS).catch(() => {});
        })
    );
});

// Activate: удалить старые версии
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) =>
            Promise.all(
                keys
                    .filter((k) => k.startsWith('backend-kb-') && k !== CACHE_NAME)
                    .map((k) => caches.delete(k))
            )
        ).then(() => self.clients.claim())
    );
});

// Fetch: stale-while-revalidate
self.addEventListener('fetch', (event) => {
    const req = event.request;

    // только GET и same-origin
    if (req.method !== 'GET') return;
    const url = new URL(req.url);
    if (url.origin !== self.location.origin) return;

    // skip Google Fonts CDN (третьи стороны)
    if (url.hostname !== self.location.hostname) return;

    event.respondWith(
        caches.open(CACHE_NAME).then(async (cache) => {
            const cachedResponse = await cache.match(req);

            // Параллельный фоновый апдейт
            const networkFetch = fetch(req)
                .then((response) => {
                    if (response.ok) {
                        cache.put(req, response.clone()).catch(() => {});
                    }
                    return response;
                })
                .catch(() => null);

            // Если в кеше есть — отдаём сразу, обновление в фоне
            if (cachedResponse) {
                return cachedResponse;
            }

            // Иначе ждём сеть; если её нет — null → ошибка fetch
            const networkResponse = await networkFetch;
            if (networkResponse) return networkResponse;

            // Полный офлайн + нет в кеше → отдаём index как fallback
            const indexCache = await cache.match('/');
            if (indexCache) return indexCache;

            return new Response('Offline — page not cached yet', {
                status: 503,
                statusText: 'Offline'
            });
        })
    );
});
