@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nginx &amp; Docker — деплой и обслуживание веб-сервисов</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
  --bg:#F5F8FA;--surface:#FFFFFF;--border:#E4E6EF;--text:#181C32;--text2:#7E8299;--text3:#A1A5B7;
  --primary:#404357;--primary-light:#EFF2F5;
  --success:#50CD89;--success-light:#E8FFF3;--success-dark:#0D7D53;
  --warning:#FFC700;--warning-light:#FFF8DD;--warning-dark:#B45309;
  --danger:#F1416C;--danger-light:#FFF5F8;
  --shadow:0 2px 10px rgba(24,28,50,0.07);--radius:10px;
  --code-bg:#1E1E2D;--code-border:#2D3347;
}
*{margin:0;padding:0;box-sizing:border-box;}
body{background:var(--bg);color:var(--text);font-family:'Inter',-apple-system,sans-serif;font-size:14px;line-height:1.6;-webkit-font-smoothing:antialiased;}
.container{width:100%;display:grid;grid-template-columns:260px 1fr;min-height:100vh;}
.sidebar{background:var(--surface);padding:24px 14px;position:fixed;width:260px;height:100vh;overflow-y:auto;border-right:1px solid var(--border);box-shadow:2px 0 8px rgba(24,28,50,0.04);}
.sidebar-back{display:flex;align-items:center;gap:7px;padding:8px 10px;margin-bottom:14px;color:var(--primary);text-decoration:none;border-radius:7px;font-size:12px;font-weight:600;transition:background 0.2s;}
.sidebar-back:hover{background:var(--primary-light);}
.sidebar-back svg{width:14px;height:14px;}
.sidebar-title{font-size:11px;font-weight:800;color:var(--text3);text-transform:uppercase;letter-spacing:1.2px;margin-bottom:10px;padding-bottom:12px;border-bottom:1px solid var(--border);}
.nav-group-label{font-size:10px;font-weight:700;color:var(--text3);text-transform:uppercase;letter-spacing:0.8px;padding:10px 12px 4px;}
.nav-item{display:flex;align-items:center;gap:8px;padding:8px 12px;margin-bottom:2px;color:var(--text2);text-decoration:none;border-radius:8px;cursor:pointer;transition:all 0.18s;font-size:13px;font-weight:500;border:1px solid transparent;}
.nav-item svg{width:14px;height:14px;flex-shrink:0;}
.nav-item:hover{background:var(--bg);color:var(--primary);border-color:var(--border);}
.nav-item.active{background:var(--primary-light);color:var(--primary);font-weight:600;border-color:rgba(64,67,87,0.25);}
.main{margin-left:260px;padding:40px 48px;min-width:0;width:calc(100vw - 260px);}
.page-header{margin-bottom:32px;padding-bottom:24px;border-bottom:1px solid var(--border);}
.page-header h1{font-size:26px;font-weight:800;margin-bottom:8px;color:var(--text);letter-spacing:-0.3px;}
.page-header p{color:var(--text2);font-size:14px;}
.badge-row{display:flex;gap:8px;flex-wrap:wrap;margin-top:12px;}
.badge{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;background:#EFF2F5;color:#5E6278;}
.badge-success{background:var(--success-light);color:var(--success-dark);}
.badge-warning{background:var(--warning-light);color:var(--warning-dark);}
.section{display:none;animation:fadeIn 0.25s ease;}
.section.active{display:block;}
@keyframes fadeIn{from{opacity:0;transform:translateY(4px);}to{opacity:1;transform:none;}}
.section-title{font-size:20px;font-weight:700;margin-bottom:24px;color:var(--text);padding-bottom:14px;border-bottom:2px solid var(--border);display:flex;align-items:center;gap:10px;}
.section-title::before{content:'';width:4px;height:22px;background:var(--primary);border-radius:2px;flex-shrink:0;}
.subsection{margin-bottom:36px;}
.subsection-title{font-size:15px;font-weight:700;color:var(--text);margin-bottom:14px;display:flex;align-items:center;gap:8px;}
.subsection-title svg{width:16px;height:16px;}
p.text{color:var(--text2);line-height:1.8;margin-bottom:12px;font-size:14px;}
p.text strong{color:var(--text);font-weight:600;}
p.text code, td code, li code{background:var(--bg);border:1px solid var(--border);border-radius:4px;padding:1px 6px;font-size:12px;font-family:monospace;color:var(--primary);}
.info-box{border-radius:var(--radius);padding:14px 16px;margin-bottom:16px;border-left:4px solid;font-size:13px;line-height:1.7;}
.info-box strong{font-weight:700;}
.info-box.primary{background:var(--primary-light);border-color:var(--primary);color:#404357;}
.info-box.success{background:var(--success-light);border-color:var(--success);color:#0D5E3F;}
.info-box.warning{background:#FFF8E1;border-color:#E0A000;color:#7B5000;}
.info-box.danger{background:#FFF3F5;border-color:#D0404E;color:#7B1C2A;}
.analogy{background:#F8F5FF;border-left:4px solid #6F4FBA;border-radius:var(--radius);padding:14px 16px;margin-bottom:16px;font-size:13px;line-height:1.75;color:#3C2E66;}
.analogy strong{color:#1F1538;font-weight:700;}
.why-box{background:#FFF8E1;border-left:4px solid #E0A000;border-radius:var(--radius);padding:14px 16px;margin-bottom:16px;font-size:13px;line-height:1.75;color:#7B5000;}
.why-box strong{color:#3F2C00;font-weight:700;}
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:18px 20px;margin-bottom:16px;box-shadow:var(--shadow);}
.card h3{font-size:14px;font-weight:700;color:var(--text);margin-bottom:8px;display:flex;align-items:center;gap:8px;}
.pitfall{background:#FFF5F8;border-left:4px solid var(--danger);border-radius:var(--radius);padding:12px 14px;margin-bottom:12px;font-size:13px;line-height:1.7;color:#7B1C2A;}
.pitfall strong{color:#3F0813;font-weight:700;}
.remember-box{background:var(--success-light);border-left:4px solid var(--success);border-radius:var(--radius);padding:14px 16px;margin-bottom:14px;font-size:13px;line-height:1.75;color:#0D5E3F;}
.remember-box strong{color:#053922;font-weight:700;}
.stub{background:#FFF8E1;border:1px dashed #E0A000;border-radius:var(--radius);padding:20px;margin-bottom:14px;font-size:13px;line-height:1.7;color:#7B5000;}
.stub strong{color:#3F2C00;font-weight:700;}
pre{background:var(--code-bg);border:1px solid var(--code-border);border-radius:var(--radius);padding:16px 18px;overflow-x:auto;margin-bottom:14px;font-size:12.5px;line-height:1.65;}
pre code{color:#ABB2BF;font-family:'JetBrains Mono','Fira Code',Consolas,monospace;}
.c-comment{color:#5C6370;font-style:italic;}
.c-key{color:#C678DD;}
.c-str{color:#98C379;}
.c-fn{color:#61AFEF;}
.c-var{color:#E5C07B;}
.c-type{color:#E06C75;}
.c-num{color:#D19A66;}
.c-dir{color:#61AFEF;font-weight:600;}
.diagram{background:#1E1E2D;color:#ABB2BF;border-radius:var(--radius);padding:18px;overflow-x:auto;font-family:'JetBrains Mono',monospace;font-size:12px;line-height:1.5;white-space:pre;margin-bottom:14px;}
.data-table{width:100%;border-collapse:collapse;margin-bottom:16px;font-size:13px;}
.data-table th{background:var(--bg);padding:10px 14px;text-align:left;font-weight:700;font-size:11px;text-transform:uppercase;letter-spacing:0.5px;color:var(--text2);border-bottom:1px solid var(--border);}
.data-table td{padding:10px 14px;border-bottom:1px solid var(--border);color:var(--text2);vertical-align:top;}
.data-table td strong{color:var(--text);font-weight:600;}
.data-table tr:last-child td{border-bottom:none;}
ul.bullets{margin:8px 0 14px 22px;color:var(--text2);font-size:13px;line-height:1.85;}
ul.bullets li{margin-bottom:4px;}
ul.bullets strong{color:var(--text);}
ol.numbered{margin:8px 0 14px 22px;color:var(--text2);font-size:13px;line-height:1.85;}
ol.numbered li{margin-bottom:4px;}
ol.numbered strong{color:var(--text);}

/* ── Mobile / tablet adaptation ────────────────────────────── */
@media (max-width: 900px) {
  .container { display: block; grid-template-columns: 1fr; }
  .sidebar {
    position: static; width: 100%; height: auto;
    max-height: 280px; overflow-y: auto;
    border-right: none; border-bottom: 1px solid var(--border);
    padding: 14px; box-shadow: none;
  }
  .sidebar-title { margin-bottom: 6px; padding-bottom: 8px; }
  .nav-item { padding: 6px 10px; font-size: 12.5px; }
  .nav-group-label { padding: 6px 10px 2px; }
  .main { margin-left: 0; width: 100%; padding: 20px 16px; }
  .page-header { margin-bottom: 18px; padding-bottom: 16px; }
  .page-header h1 { font-size: 22px; letter-spacing: -0.2px; }
  .page-header p { font-size: 13px; }
  .section-title { font-size: 17px; margin-bottom: 18px; padding-bottom: 10px; }
  .subsection { margin-bottom: 26px; }
  .subsection-title { font-size: 14px; margin-bottom: 10px; }
  p.text { font-size: 13.5px; line-height: 1.7; }
  .card { padding: 14px 16px; }
  .card h3 { font-size: 13.5px; }
  .pitfall { padding: 10px 12px; font-size: 12.5px; }
  .info-box { padding: 12px 14px; font-size: 12.5px; }
  pre { padding: 12px 14px; font-size: 11.5px; }
  .data-table { font-size: 12px; }
  .data-table th, .data-table td { padding: 7px 9px; }
  .badge-row { gap: 6px; }
  .badge { font-size: 10px; padding: 3px 8px; }
}

@media (max-width: 500px) {
  .sidebar { max-height: 220px; }
  .main { padding: 16px 12px; }
  .page-header h1 { font-size: 18px; }
  .section-title { font-size: 15px; }
  pre { padding: 10px 12px; font-size: 10.5px; overflow-x: auto; }
  .data-table { display: block; overflow-x: auto; white-space: nowrap; }
}
</style>
</head>
<body>
<div class="container">
<div class="sidebar">
  <a href="/" class="sidebar-back"><i data-lucide="arrow-left"></i> На главную</a>
  <div class="sidebar-title">Nginx &amp; Docker</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">Nginx — основы</div>
  <a class="nav-item" onclick="showSection('nginx-what',this)"><i data-lucide="server"></i> Что такое Nginx</a>
  <a class="nav-item" onclick="showSection('nginx-install',this)"><i data-lucide="download"></i> Установка + структура файлов</a>
  <a class="nav-item" onclick="showSection('nginx-service',this)"><i data-lucide="power"></i> Управление сервисом</a>
  <a class="nav-item" onclick="showSection('nginx-config',this)"><i data-lucide="settings"></i> nginx.conf: базовые директивы</a>
  <a class="nav-item" onclick="showSection('nginx-server',this)"><i data-lucide="layout"></i> Server blocks (виртуальные хосты)</a>
  <a class="nav-item" onclick="showSection('nginx-location',this)"><i data-lucide="map-pin"></i> Location блоки</a>

  <div class="nav-group-label">Nginx — интеграция и статика</div>
  <a class="nav-item" onclick="showSection('nginx-phpfpm',this)"><i data-lucide="terminal"></i> PHP-FPM для Laravel</a>
  <a class="nav-item" onclick="showSection('nginx-static',this)"><i data-lucide="image"></i> Статика + gzip + expires</a>
  <a class="nav-item" onclick="showSection('nginx-proxy',this)"><i data-lucide="git-merge"></i> Reverse proxy (Node/Python)</a>

  <div class="nav-group-label">Nginx — продакшн</div>
  <a class="nav-item" onclick="showSection('nginx-ssl',this)"><i data-lucide="lock"></i> SSL/TLS + Let's Encrypt</a>
  <a class="nav-item" onclick="showSection('nginx-security',this)"><i data-lucide="shield"></i> Безопасность + rate limiting</a>
  <a class="nav-item" onclick="showSection('nginx-cache',this)"><i data-lucide="database"></i> Кеширование</a>
  <a class="nav-item" onclick="showSection('nginx-lb',this)"><i data-lucide="scale"></i> Load balancing (upstream)</a>
  <a class="nav-item" onclick="showSection('nginx-logs',this)"><i data-lucide="scroll-text"></i> Логи + logrotate</a>
  <a class="nav-item" onclick="showSection('nginx-laravel',this)"><i data-lucide="hammer"></i> Полный конфиг для Laravel</a>
  <a class="nav-item" onclick="showSection('nginx-troubleshoot',this)"><i data-lucide="alert-triangle"></i> Реальные боли (502/504/413…)</a>

  <div class="nav-group-label">Docker — база</div>
  <a class="nav-item" onclick="showSection('docker-intro',this)"><i data-lucide="box"></i> Что такое Docker + VM vs Container</a>
  <a class="nav-item" onclick="showSection('docker-basics',this)"><i data-lucide="terminal-square"></i> Основные команды</a>
  <a class="nav-item" onclick="showSection('docker-file',this)"><i data-lucide="file-code"></i> Dockerfile</a>
  <a class="nav-item" onclick="showSection('docker-compose',this)"><i data-lucide="layers"></i> docker compose</a>
  <a class="nav-item" onclick="showSection('docker-volumes',this)"><i data-lucide="hard-drive"></i> Volumes + bind mounts</a>
  <a class="nav-item" onclick="showSection('docker-networks',this)"><i data-lucide="network"></i> Networks</a>
  <a class="nav-item" onclick="showSection('docker-laravel',this)"><i data-lucide="package-2"></i> Laravel в Docker</a>
  <a class="nav-item" onclick="showSection('docker-troubleshoot',this)"><i data-lucide="alert-octagon"></i> Реальные боли</a>

  <div class="nav-group-label">Что ещё подтянуть</div>
  <a class="nav-item" onclick="showSection('systemd',this)"><i data-lucide="cog"></i> systemd глубже</a>
  <a class="nav-item" onclick="showSection('ssh',this)"><i data-lucide="key"></i> SSH: deploy + key auth</a>
  <a class="nav-item" onclick="showSection('cron',this)"><i data-lucide="clock"></i> Cron</a>
  <a class="nav-item" onclick="showSection('monitoring',this)"><i data-lucide="activity"></i> Мониторинг сервера</a>
  <a class="nav-item" onclick="showSection('cicd',this)"><i data-lucide="git-branch"></i> CI/CD базово</a>
  <a class="nav-item" onclick="showSection('checklist',this)"><i data-lucide="check-square"></i> Чек-лист боевого сервера</a>
</div>

<div class="main">
<div class="page-header">
  <h1>Nginx &amp; Docker — деплой и обслуживание веб-сервисов</h1>
  <p>Практический раздел с акцентом на <strong>Nginx</strong> (веб-сервер / reverse proxy) и базой по <strong>Docker</strong>. Реальные конфиги, файлы, команды перезапуска, типовые боли и как их лечить. Ориентировано на backend-разработчика, который сам катает Laravel/PHP на VPS.</p>
  <div class="badge-row">
    <span class="badge">Nginx</span>
    <span class="badge">Docker</span>
    <span class="badge">Deploy</span>
    <span class="badge badge-success">Практика</span>
    <span class="badge badge-warning">Живой</span>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     OVERVIEW
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>

  <p class="text">Backend-разработчик, который умеет только писать код, а деплоем занимается «кто-то другой» — <strong>ограничен</strong>. Как только приложение выходит из локалки, начинаются вопросы: почему 502, где логи, как перезапустить, почему письма не уходят, куда пропал SSL, что за <code>413 Payload Too Large</code>, почему `.env` не подтянулся, где хранятся сессии, как задеплоить без даунтайма. Всё это — не «магия DevOps», а базовая эксплуатация.</p>

  <div class="info-box primary">
    <strong>Цель раздела:</strong> дать <em>рабочее</em> понимание Nginx (главный веб-сервер под Linux) и базы Docker (стандартная контейнеризация) с уклоном в <strong>реальные операционные задачи</strong>: развернуть, настроить, перезапустить, диагностировать, обновить, восстановить.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map"></i> Карта раздела</div>
    <table class="data-table">
      <tr><th>Блок</th><th>Что внутри</th></tr>
      <tr><td><strong>Nginx — основы</strong></td><td>Что это, где лежит, как перезапустить, базовые директивы, server blocks, location.</td></tr>
      <tr><td><strong>Nginx — интеграция</strong></td><td>PHP-FPM (для Laravel/PHP), статика с gzip, reverse proxy для Node/Python.</td></tr>
      <tr><td><strong>Nginx — продакшн</strong></td><td>SSL/Let's Encrypt, безопасность + rate limiting, кеширование, load balancing, логи, полный Laravel-конфиг, разбор реальных ошибок.</td></tr>
      <tr><td><strong>Docker — база</strong></td><td>Что такое контейнеры, команды, Dockerfile, docker compose, volumes, networks, Laravel в Docker, боли.</td></tr>
      <tr><td><strong>Что ещё подтянуть</strong></td><td>systemd, SSH-deploy, cron, мониторинг, CI/CD, чек-лист боевого сервера.</td></tr>
    </table>
  </div>

  <div class="analogy">
    <strong>Аналогия:</strong> сайт в интернете — это <em>ресторан</em>. <strong>Nginx</strong> — метрдотель у входа: принимает всех гостей, отдаёт быстрые заказы (статика — картинки, CSS, JS) сам, а сложные заказы (динамика — PHP-код) передаёт на кухню (PHP-FPM). <strong>Docker</strong> — стандартные ящики, в которых кухня, склад, посудомойка приезжают на любую точку и работают одинаково.
  </div>

  <div class="why-box">
    <strong>Почему акцент на Nginx:</strong> в 2026 году Nginx обслуживает больше 30% всех сайтов интернета и почти 100% Laravel-деплоев на VPS. Apache уходит, Caddy/OpenResty — нишевые. Знание Nginx — базовая грамотность для PHP/Laravel-разработчика уровня middle+.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     NGINX — WHAT IS IT
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-nginx-what" class="section">
  <div class="section-title">Что такое Nginx</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Определение</div>
    <p class="text"><strong>Nginx</strong> (произносится «энджин-икс») — HTTP-сервер и обратный прокси (reverse proxy). Создан в 2004 году Игорем Сысоевым для Rambler.ru как ответ на «C10k problem» — <em>как обслужить 10 000 одновременных соединений на одном сервере, не съев всю память</em>. С тех пор стал одним из двух главных веб-серверов интернета (второй — Apache).</p>

    <p class="text">В типовой архитектуре Nginx стоит <strong>первым</strong>, между интернетом и приложением:</p>
    <div class="diagram">Пользователь (браузер)
       │
       │  HTTP/HTTPS запрос
       ▼
  ┌─────────────┐
  │    NGINX    │  ← слушает 80/443, терминирует SSL,
  │  (порт 80,  │    отдаёт статику, gzip'ит, кеширует
  │   443)      │
  └──────┬──────┘
         │
    ┌────┴────────────┬────────────────┬────────────────┐
    ▼                 ▼                ▼                ▼
 PHP-FPM        Node.js app     Python (Gunicorn)  Static files
 (Laravel)      (Express)        (Django)          (public/)
 :9000          :3000            :8000             прямо с диска</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Почему Nginx быстрый: event-driven архитектура</div>
    <p class="text">Ключевое архитектурное отличие Nginx от старого Apache prefork — <strong>модель обработки соединений</strong>.</p>

    <table class="data-table">
      <thead><tr><th></th><th>Apache prefork</th><th>Nginx</th></tr></thead>
      <tbody>
        <tr><td><strong>Модель</strong></td><td>Процесс на соединение</td><td>Event-driven, non-blocking I/O</td></tr>
        <tr><td><strong>10 000 соединений</strong></td><td>10 000 процессов × 10 МБ = 100 ГБ RAM</td><td>4 worker-процесса × ~50 МБ = 200 МБ RAM</td></tr>
        <tr><td><strong>Как ждёт I/O</strong></td><td>Блокирует процесс — ждёт БД/файл</td><td>Пишет в epoll, идёт обслуживать других</td></tr>
        <tr><td><strong>Идеально для</strong></td><td>Тяжёлых mod_php приложений старой школы</td><td>Reverse proxy, статика, много соединений</td></tr>
      </tbody>
    </table>

    <div class="analogy">
      <strong>Аналогия:</strong> Apache prefork — <em>официант на каждого гостя</em>, даже если гость молча жуёт 20 минут. Nginx — <em>один расторопный официант</em>, который обходит все столики: пока один клиент читает меню, он несёт другому счёт, третьему — заказ.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Что Nginx умеет</div>
    <div class="card">
      <h3><i data-lucide="server"></i> HTTP-сервер</h3>
      <p class="text">Отдавать статику (HTML, CSS, JS, картинки, шрифты, видео) с диска максимально быстро. Умеет keep-alive, gzip, HTTP/2, HTTP/3 (QUIC).</p>
    </div>
    <div class="card">
      <h3><i data-lucide="git-merge"></i> Reverse proxy</h3>
      <p class="text">Принимает запрос от клиента и передаёт бэкенду (PHP-FPM, Node.js, Python, Java). Скрывает бэкенд от интернета, добавляет заголовки, обрабатывает таймауты.</p>
    </div>
    <div class="card">
      <h3><i data-lucide="scale"></i> Load balancer</h3>
      <p class="text">Распределяет запросы между несколькими экземплярами бэкенда (upstream). Round-robin, least_conn, ip_hash. Проверяет здоровье бэкендов.</p>
    </div>
    <div class="card">
      <h3><i data-lucide="lock"></i> SSL termination</h3>
      <p class="text">Держит HTTPS-сертификаты, разбирает TLS, передаёт бэкенду уже расшифрованный HTTP. Бэкенд не думает про сертификаты.</p>
    </div>
    <div class="card">
      <h3><i data-lucide="database"></i> Кеш</h3>
      <p class="text"><code>proxy_cache</code> / <code>fastcgi_cache</code> — Nginx может кешировать ответы бэкенда на диск и отдавать их без обращения к PHP. На небольших проектах заменяет Varnish.</p>
    </div>
    <div class="card">
      <h3><i data-lucide="shield"></i> Security layer</h3>
      <p class="text">Rate limiting (<code>limit_req</code>), IP-фильтрация, скрытие версий, HTTP security headers, защита от медленных клиентов (slowloris).</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Nginx vs Apache — коротко</div>
    <p class="text">В 2026 году в мире Laravel/PHP-хостинга <strong>Nginx выиграл</strong>. Apache остался в 3 нишах: cPanel-хостинг (legacy), Windows-стек, и когда нужен <code>.htaccess</code> в shared-хостинге с mod_rewrite «на лету». Всё что новое строится — на Nginx.</p>

    <div class="remember-box">
      <strong>Итог:</strong> Nginx — быстрый event-driven HTTP-сервер и reverse proxy. Именно он принимает первый запрос от браузера, отдаёт статику сам, а «динамику» проксирует в PHP-FPM (для Laravel) или на любой другой бэкенд.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     NGINX — INSTALL + FILES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-nginx-install" class="section">
  <div class="section-title">Установка Nginx + структура файлов</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="download"></i> Установка (Debian/Ubuntu)</div>
<pre><code><span class="c-comment"># 1. Обновить индексы пакетов</span>
sudo apt update

<span class="c-comment"># 2. Поставить nginx</span>
sudo apt install nginx -y

<span class="c-comment"># 3. Автозапуск при загрузке системы</span>
sudo systemctl enable nginx

<span class="c-comment"># 4. Стартанули</span>
sudo systemctl start nginx

<span class="c-comment"># 5. Проверка версии</span>
nginx -v          <span class="c-comment"># короткая версия</span>
nginx -V          <span class="c-comment"># с флагами сборки: --with-http_ssl_module и т.д.</span></code></pre>

    <p class="text">На <strong>CentOS / RHEL / AlmaLinux / Rocky</strong>: <code>sudo dnf install nginx -y</code> (или <code>yum</code> на старых). На <strong>macOS</strong> (dev): <code>brew install nginx</code>.</p>

    <div class="info-box success">
      <strong>После установки:</strong> сразу открой в браузере <code>http://IP-сервера/</code>. Должна появиться дефолтная страница «Welcome to nginx!». Не появилась — <em>firewall не пропускает 80/443</em>: <code>sudo ufw allow 'Nginx Full'</code>.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="folder-tree"></i> Структура файлов Nginx (Ubuntu/Debian)</div>

    <p class="text">Nginx на Debian/Ubuntu раскладывает файлы <em>по нескольким директориям</em> — это важно знать, чтобы понимать <em>что где искать</em>:</p>

<pre><code>/etc/nginx/
├── nginx.conf              <span class="c-comment"># ГЛАВНЫЙ конфиг — общие настройки, worker'ы, включает всё остальное</span>
├── mime.types              <span class="c-comment"># таблица MIME-типов (.css → text/css, .png → image/png)</span>
├── fastcgi_params          <span class="c-comment"># стандартные переменные для FastCGI (PHP-FPM)</span>
├── proxy_params            <span class="c-comment"># стандартные заголовки для reverse proxy</span>
├── snippets/               <span class="c-comment"># переиспользуемые куски (fastcgi-php.conf, ssl-params.conf)</span>
│   ├── fastcgi-php.conf
│   └── ssl-params.conf
├── conf.d/                 <span class="c-comment"># *.conf файлы, включаемые из nginx.conf через include</span>
│   └── (по умолчанию пусто)
├── sites-available/        <span class="c-comment"># ВСЕ конфиги сайтов (по одному файлу на сайт)</span>
│   ├── default
│   ├── example.com
│   └── api.example.com
└── sites-enabled/          <span class="c-comment"># СИМЛИНКИ на активные сайты из sites-available/</span>
    ├── default -> ../sites-available/default
    └── example.com -> ../sites-available/example.com

/var/log/nginx/             <span class="c-comment"># ЛОГИ</span>
├── access.log              <span class="c-comment"># все запросы</span>
├── error.log               <span class="c-comment"># ошибки, критично при отладке</span>
├── access.log.1.gz         <span class="c-comment"># ротированные (logrotate)</span>
└── error.log.1.gz

/var/www/                   <span class="c-comment"># типичное место для сайтов (традиция, не обязательно)</span>
├── html/                   <span class="c-comment"># дефолтная welcome-страница</span>
└── example.com/            <span class="c-comment"># твой Laravel-проект</span>
    └── public/             <span class="c-comment"># root у Laravel всегда = public/</span>

/usr/sbin/nginx             <span class="c-comment"># сам бинарник</span>
/var/run/nginx.pid          <span class="c-comment"># PID главного процесса (нужен для reload)</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-fork"></i> sites-available vs sites-enabled — зачем два</div>
    <p class="text">Это <strong>Debian-специфичный</strong> паттерн (в CentOS его нет — там просто <code>conf.d/*.conf</code>). Идея простая:</p>
    <ul class="bullets">
      <li><code>sites-available/</code> — <strong>хранилище</strong> всех конфигов сайтов. Даже отключённые сайты остаются здесь.</li>
      <li><code>sites-enabled/</code> — <strong>активные</strong> сайты. Это <em>только симлинки</em> на файлы из <code>sites-available/</code>.</li>
      <li><code>nginx.conf</code> подключает через <code>include /etc/nginx/sites-enabled/*;</code> — только то, что в enabled.</li>
    </ul>

    <p class="text"><strong>Включить сайт:</strong></p>
<pre><code><span class="c-comment"># Создать симлинк</span>
sudo ln -s /etc/nginx/sites-available/example.com /etc/nginx/sites-enabled/

<span class="c-comment"># Проверить конфиг</span>
sudo nginx -t

<span class="c-comment"># Применить</span>
sudo systemctl reload nginx</code></pre>

    <p class="text"><strong>Отключить сайт</strong> (без удаления файла):</p>
<pre><code>sudo rm /etc/nginx/sites-enabled/example.com
sudo systemctl reload nginx</code></pre>

    <div class="info-box warning">
      <strong>Дефолтный сайт.</strong> <code>sites-enabled/default</code> ловит всё, что не подошло другим <code>server_name</code>. Оставь его, если хочешь отдавать 404 «в никуда»; удали симлинк, если <em>первым сайтом должен быть твой</em>.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="folder"></i> Куда класть свой Laravel-проект</div>
    <p class="text"><strong>Соглашение:</strong> <code>/var/www/example.com/</code> — корень проекта, <code>/var/www/example.com/public/</code> — то, что Nginx смотрит как <code>root</code> (там лежит <code>index.php</code>). Владелец — <code>www-data:www-data</code> (пользователь, под которым бегает Nginx и PHP-FPM на Ubuntu/Debian).</p>

<pre><code>sudo mkdir -p /var/www/example.com
sudo chown -R $USER:www-data /var/www/example.com
cd /var/www/example.com

<span class="c-comment"># Клонируем проект</span>
git clone git@github.com:youruser/yourrepo.git .

<span class="c-comment"># Права: storage и bootstrap/cache должны быть writable для www-data</span>
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache</code></pre>

    <div class="pitfall"><strong>«500 Internal Server Error» после deploy</strong> — в 90% случаев права. Laravel хочет писать в <code>storage/logs/</code>, <code>storage/framework/</code>, <code>bootstrap/cache/</code>. Проверяй владельца и <code>chmod</code>.</div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     NGINX — SERVICE MANAGEMENT
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-nginx-service" class="section">
  <div class="section-title">Управление сервисом — start/stop/restart/reload</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="power"></i> Основные команды systemctl</div>
    <table class="data-table">
      <thead><tr><th>Команда</th><th>Что делает</th><th>Когда применять</th></tr></thead>
      <tbody>
        <tr><td><code>sudo systemctl status nginx</code></td><td>Статус: active/inactive/failed, PID, недавние логи</td><td>Первое что делать, если «сайт лёг»</td></tr>
        <tr><td><code>sudo systemctl start nginx</code></td><td>Запустить</td><td>После установки или ручной остановки</td></tr>
        <tr><td><code>sudo systemctl stop nginx</code></td><td>Полностью остановить</td><td>Обслуживание, обновление системы</td></tr>
        <tr><td><code>sudo systemctl restart nginx</code></td><td>Перезапустить (stop + start). <strong>Есть даунтайм ~1 сек</strong></td><td>При проблемах, после серьёзных изменений</td></tr>
        <tr><td><code>sudo systemctl reload nginx</code></td><td>Перечитать конфиг <em>без даунтайма</em>: старые worker'ы дорабатывают, новые с новым конфигом</td><td><strong>После правки конфига — всегда reload, не restart</strong></td></tr>
        <tr><td><code>sudo systemctl enable nginx</code></td><td>Автозапуск при загрузке</td><td>Один раз после установки</td></tr>
        <tr><td><code>sudo systemctl disable nginx</code></td><td>Убрать из автозапуска</td><td>Редко</td></tr>
      </tbody>
    </table>

    <div class="info-box primary">
      <strong>Reload vs restart:</strong> <code>reload</code> отправляет <code>SIGHUP</code> — Nginx запускает новых worker'ов с новым конфигом, а старые дорабатывают текущие запросы и умирают. <strong>Ноль даунтайма.</strong> <code>restart</code> — грубее, есть короткий момент недоступности.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> ГЛАВНАЯ команда — <code>nginx -t</code></div>
    <p class="text"><strong>Всегда проверяй конфиг ДО перезапуска:</strong></p>
<pre><code>sudo nginx -t</code></pre>
    <p class="text">Что покажет:</p>
<pre><code><span class="c-str">nginx: the configuration file /etc/nginx/nginx.conf syntax is ok
nginx: configuration file /etc/nginx/nginx.conf test is successful</span></code></pre>
    <p class="text">Или с ошибкой:</p>
<pre><code><span class="c-str">nginx: [emerg] "server" directive is not allowed here in /etc/nginx/sites-enabled/example.com:15
nginx: configuration file /etc/nginx/nginx.conf test failed</span></code></pre>

    <div class="pitfall"><strong>Никогда не делай <code>systemctl reload nginx</code> без <code>nginx -t</code>.</strong> Если в конфиге ошибка — reload провалится, Nginx останется на <em>старом</em> конфиге (это ок), но если ты сделаешь <code>restart</code> с битым конфигом — Nginx не запустится, сайт лёг.</p></div>

    <p class="text"><strong>Идиоматический workflow:</strong></p>
<pre><code><span class="c-comment"># 1. Правим конфиг</span>
sudo nano /etc/nginx/sites-available/example.com

<span class="c-comment"># 2. Проверяем синтаксис</span>
sudo nginx -t

<span class="c-comment"># 3. Если ок — reload</span>
sudo systemctl reload nginx

<span class="c-comment"># Одной командой (сначала проверка, потом reload):</span>
sudo nginx -t &amp;&amp; sudo systemctl reload nginx</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="signal"></i> Nginx-сигналы напрямую (без systemd)</div>
    <p class="text">До systemd управляли через <code>kill -СИГНАЛ &lt;master-pid&gt;</code>. Иногда полезно понимать, что делает <code>reload</code>:</p>
    <table class="data-table">
      <thead><tr><th>Сигнал</th><th>Действие</th><th>Аналог systemd</th></tr></thead>
      <tbody>
        <tr><td><code>SIGTERM</code>, <code>SIGINT</code></td><td>Быстрый выход (обрывает текущие запросы)</td><td><code>systemctl stop</code></td></tr>
        <tr><td><code>SIGQUIT</code></td><td>Graceful shutdown — worker'ы дорабатывают запросы</td><td>—</td></tr>
        <tr><td><code>SIGHUP</code></td><td>Перечитать конфиг, graceful reload</td><td><code>systemctl reload</code></td></tr>
        <tr><td><code>SIGUSR1</code></td><td>Переоткрыть лог-файлы (нужно после logrotate)</td><td>—</td></tr>
        <tr><td><code>SIGUSR2</code></td><td>Обновить исполняемый файл (upgrade nginx на лету)</td><td>—</td></tr>
      </tbody>
    </table>
<pre><code><span class="c-comment"># PID главного процесса</span>
cat /var/run/nginx.pid

<span class="c-comment"># Ручной reload через сигнал (эквивалент systemctl reload)</span>
sudo kill -HUP $(cat /var/run/nginx.pid)

<span class="c-comment"># После logrotate — переоткрыть логи</span>
sudo kill -USR1 $(cat /var/run/nginx.pid)</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="search"></i> Диагностика: сервис лёг</div>
    <p class="text">Приложение не отвечает — по шагам:</p>
    <ol class="numbered">
      <li><code>sudo systemctl status nginx</code> — что говорит systemd. <code>active (running)</code> — Nginx жив, дело в бэкенде. <code>failed</code> — Nginx не запускается.</li>
      <li><code>sudo journalctl -u nginx -n 50 --no-pager</code> — последние 50 строк лога сервиса. Причина падения обычно в первой красной строке.</li>
      <li><code>sudo tail -f /var/log/nginx/error.log</code> — живой поток ошибок Nginx. Показывает 502/504/permission denied/upstream timed out.</li>
      <li><code>sudo nginx -t</code> — если правил конфиг перед падением, проверь синтаксис.</li>
      <li><code>ss -tlnp | grep -E ':80|:443'</code> — что вообще слушает эти порты (может, Apache занял).</li>
      <li><code>sudo systemctl status php8.3-fpm</code> — если Nginx работает, но 502 — умер PHP-FPM.</li>
    </ol>

    <div class="remember-box">
      <strong>Мнемоника:</strong> «упало → status → journalctl → error.log → nginx -t». Четыре команды закрывают 90% диагностики.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     NGINX — CONFIG (nginx.conf)
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-nginx-config" class="section">
  <div class="section-title">nginx.conf — базовые директивы</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Три уровня контекста в конфиге</div>
    <p class="text">Nginx-конфиг иерархический — директивы живут в разных контекстах:</p>
    <div class="diagram">main context (глобальный)
├── user, worker_processes, error_log — уровень процесса
│
├── events {           ← настройки I/O
│       worker_connections 1024;
│   }
│
└── http {             ← ВСЁ про HTTP
        include mime.types;
        gzip on;
        keepalive_timeout 65;

        server {       ← виртуальный хост (сайт)
            listen 80;
            server_name example.com;

            location / {    ← правила для конкретного URL
                root /var/www/example.com/public;
            }
        }

        server { ... }      ← ещё один сайт
    }</div>
    <p class="text">Директивы <strong>наследуются</strong> от родителя к потомку: <code>gzip on</code> в <code>http</code> — включает gzip во всех <code>server</code> внутри.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-cog" style="width:16px;height:16px"></i> Полный <code>nginx.conf</code> с пояснениями</div>
<pre><code><span class="c-comment"># /etc/nginx/nginx.conf — главный конфиг</span>

<span class="c-comment"># Под каким пользователем работают worker-процессы</span>
<span class="c-dir">user</span> www-data;

<span class="c-comment"># Кол-во worker'ов. auto = равно кол-ву CPU-ядер (оптимально)</span>
<span class="c-dir">worker_processes</span> auto;

<span class="c-comment"># PID главного процесса — где записан</span>
<span class="c-dir">pid</span> /run/nginx.pid;

<span class="c-comment"># Динамические модули (brotli, geoip и т.д.)</span>
<span class="c-dir">include</span> /etc/nginx/modules-enabled/*.conf;

<span class="c-key">events</span> {
    <span class="c-comment"># Сколько соединений на один worker (не то же, что клиентов!)</span>
    <span class="c-dir">worker_connections</span> 1024;
    <span class="c-comment"># worker_connections × worker_processes = максимум соединений сервера</span>
    <span class="c-comment"># 1024 × 4 CPU = 4096 одновременных клиентов</span>
}

<span class="c-key">http</span> {
    <span class="c-comment"># ───── I/O оптимизации ─────</span>
    <span class="c-dir">sendfile</span> on;              <span class="c-comment"># Ядро копирует файл сразу в сокет — быстро</span>
    <span class="c-dir">tcp_nopush</span> on;            <span class="c-comment"># Отправить заголовок и данные одним пакетом</span>
    <span class="c-dir">tcp_nodelay</span> on;           <span class="c-comment"># Не буферизовать (нужно для keep-alive)</span>

    <span class="c-comment"># ───── Таймауты ─────</span>
    <span class="c-dir">keepalive_timeout</span> 65;     <span class="c-comment"># Держать соединение открытым 65 сек</span>
    <span class="c-dir">client_body_timeout</span> 12;   <span class="c-comment"># Ждать тело запроса 12 сек</span>
    <span class="c-dir">client_header_timeout</span> 12; <span class="c-comment"># Ждать заголовки 12 сек</span>
    <span class="c-dir">send_timeout</span> 10;          <span class="c-comment"># Между двумя send'ами клиенту</span>

    <span class="c-comment"># ───── Размеры ─────</span>
    <span class="c-dir">client_max_body_size</span> 20M; <span class="c-comment"># !! Максимальный upload (по умолчанию 1M — часто мало)</span>
    <span class="c-dir">client_body_buffer_size</span> 16K;
    <span class="c-dir">large_client_header_buffers</span> 4 8k;

    <span class="c-comment"># ───── MIME-типы ─────</span>
    <span class="c-dir">include</span> /etc/nginx/mime.types;
    <span class="c-dir">default_type</span> application/octet-stream;

    <span class="c-comment"># ───── Скрыть версию Nginx (безопасность) ─────</span>
    <span class="c-dir">server_tokens</span> off;

    <span class="c-comment"># ───── Gzip компрессия ─────</span>
    <span class="c-dir">gzip</span> on;
    <span class="c-dir">gzip_vary</span> on;               <span class="c-comment"># Vary: Accept-Encoding — важно для CDN/кешей</span>
    <span class="c-dir">gzip_min_length</span> 1024;      <span class="c-comment"># Не жать файлы меньше 1KB (накладные больше выигрыша)</span>
    <span class="c-dir">gzip_comp_level</span> 5;         <span class="c-comment"># 1..9. 5 — золотая середина CPU/размер</span>
    <span class="c-dir">gzip_types</span>
        text/plain text/css application/json application/javascript
        text/xml application/xml application/xml+rss text/javascript
        application/vnd.ms-fontobject application/x-font-ttf font/opentype
        image/svg+xml image/x-icon;

    <span class="c-comment"># ───── Логи ─────</span>
    <span class="c-dir">log_format</span> main <span class="c-str">'$remote_addr - $remote_user [$time_local] '</span>
                    <span class="c-str">'"$request" $status $body_bytes_sent '</span>
                    <span class="c-str">'"$http_referer" "$http_user_agent"'</span>;
    <span class="c-dir">access_log</span> /var/log/nginx/access.log main;
    <span class="c-dir">error_log</span>  /var/log/nginx/error.log warn;

    <span class="c-comment"># ───── Подключаем конфиги сайтов ─────</span>
    <span class="c-dir">include</span> /etc/nginx/conf.d/*.conf;
    <span class="c-dir">include</span> /etc/nginx/sites-enabled/*;
}</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="star"></i> Главные директивы, которые крутят чаще всего</div>
    <table class="data-table">
      <thead><tr><th>Директива</th><th>Что делает</th><th>Реальный кейс</th></tr></thead>
      <tbody>
        <tr><td><code>worker_processes auto;</code></td><td>Worker'ов = кол-во CPU</td><td>Оставь <code>auto</code> — Nginx сам определит</td></tr>
        <tr><td><code>worker_connections</code></td><td>Соединений на worker</td><td>1024–4096. Больше = больше RAM</td></tr>
        <tr><td><code>keepalive_timeout</code></td><td>Держать соединение живым</td><td>65с — стандарт. 5с — если под DDoS</td></tr>
        <tr><td><code>client_max_body_size</code></td><td>Макс размер запроса/upload</td><td><strong>Ставь явно</strong> (20M/50M). Дефолт 1M — сломает загрузку файлов</td></tr>
        <tr><td><code>gzip on;</code></td><td>Сжатие ответа</td><td>Всегда on для текста, off для картинок (они уже сжаты)</td></tr>
        <tr><td><code>server_tokens off;</code></td><td>Скрыть версию nginx в Server-заголовке</td><td>Всегда off на проде — security</td></tr>
        <tr><td><code>error_log ... warn;</code></td><td>Уровень логов</td><td><code>warn</code> на проде, <code>debug</code> для отладки (только временно!)</td></tr>
      </tbody>
    </table>

    <div class="pitfall"><strong><code>client_max_body_size</code> — самая частая забытая настройка.</strong> Дефолт 1MB. Загрузка аватара 2MB → <code>413 Payload Too Large</code>. Ставь в <code>http {}</code> глобально (<code>20M</code>) или в конкретном <code>location /upload {}</code>.</div>

    <div class="info-box success">
      <strong>Про <code>worker_processes auto</code>:</strong> Nginx с CPU 4-cores создаст 4 worker'а. Каждый может обслуживать до <code>worker_connections</code>. Итого лимит одновременных клиентов = <code>worker_processes × worker_connections</code>. Ядро при этом должно уметь держать столько дескрипторов — проверь <code>ulimit -n</code>.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     NGINX — SERVER BLOCKS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-nginx-server" class="section">
  <div class="section-title">Server blocks — виртуальные хосты</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layout"></i> Что такое server block</div>
    <p class="text"><strong>Server block</strong> = виртуальный хост = конфигурация одного сайта. На одном сервере с одним IP могут крутиться десятки сайтов — Nginx различает их по заголовку <code>Host</code>, который присылает браузер.</p>

    <p class="text">Каждый сайт — свой файл в <code>/etc/nginx/sites-available/</code>, симлинк в <code>sites-enabled/</code>.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-code"></i> Минимальный server block</div>
<pre><code><span class="c-comment"># /etc/nginx/sites-available/example.com</span>
<span class="c-key">server</span> {
    <span class="c-dir">listen</span> 80;
    <span class="c-dir">listen</span> [::]:80;                    <span class="c-comment"># IPv6</span>
    <span class="c-dir">server_name</span> example.com www.example.com;

    <span class="c-dir">root</span> /var/www/example.com/public;
    <span class="c-dir">index</span> index.html index.htm index.php;

    <span class="c-key">location</span> / {
        <span class="c-dir">try_files</span> $uri $uri/ =404;
    }
}</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list-checks"></i> Ключевые директивы server-блока</div>
    <table class="data-table">
      <thead><tr><th>Директива</th><th>Что делает</th><th>Примеры</th></tr></thead>
      <tbody>
        <tr><td><code>listen</code></td><td>На каком порту/интерфейсе слушать</td><td><code>80</code>, <code>443 ssl http2</code>, <code>127.0.0.1:8080</code>, <code>[::]:80</code></td></tr>
        <tr><td><code>server_name</code></td><td>По каким доменам этот сайт отвечает</td><td><code>example.com www.example.com *.example.com</code></td></tr>
        <tr><td><code>root</code></td><td>Корневая директория файлов</td><td><code>/var/www/example.com/public</code></td></tr>
        <tr><td><code>index</code></td><td>Файл по умолчанию для директории</td><td><code>index.php index.html</code></td></tr>
        <tr><td><code>access_log</code> / <code>error_log</code></td><td>Свои логи для этого сайта</td><td><code>/var/log/nginx/example.access.log</code></td></tr>
        <tr><td><code>return</code></td><td>Быстрый ответ (редирект / статус)</td><td><code>return 301 https://$host$request_uri;</code></td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-branch"></i> Как Nginx выбирает server-блок для запроса</div>
    <p class="text">Пришёл запрос <code>GET /page HTTP/1.1</code> с <code>Host: example.com</code>. Nginx:</p>
    <ol class="numbered">
      <li>Смотрит на порт и IP из <code>listen</code>. Отбрасывает блоки, которые не слушают этот адрес.</li>
      <li>Из оставшихся сравнивает заголовок <code>Host</code> с <code>server_name</code>:
        <ul class="bullets">
          <li>Точное совпадение (<code>example.com</code>)</li>
          <li>Затем wildcard в начале (<code>*.example.com</code>)</li>
          <li>Затем wildcard в конце (<code>example.*</code>)</li>
          <li>Затем regex</li>
        </ul>
      </li>
      <li>Если ничего не подошло — берётся <code>default_server</code> (в <code>listen 80 default_server;</code>), либо <em>первый</em> server-блок в конфиге.</li>
    </ol>

    <div class="info-box warning">
      <strong>Ловушка:</strong> при переходе на HTTPS не забудь про default_server. Иначе если кто-то попадёт на IP сервера без домена — увидит <em>случайный</em> сайт.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="corner-down-right"></i> Типичный сценарий: редирект HTTP → HTTPS + www → non-www</div>
<pre><code><span class="c-comment"># Блок 1: HTTP → HTTPS редирект</span>
<span class="c-key">server</span> {
    <span class="c-dir">listen</span> 80;
    <span class="c-dir">listen</span> [::]:80;
    <span class="c-dir">server_name</span> example.com www.example.com;

    <span class="c-comment"># Один return, всё остальное — незачем</span>
    <span class="c-dir">return</span> 301 https://example.com$request_uri;
}

<span class="c-comment"># Блок 2: www → non-www на HTTPS</span>
<span class="c-key">server</span> {
    <span class="c-dir">listen</span> 443 ssl http2;
    <span class="c-dir">server_name</span> www.example.com;

    <span class="c-dir">ssl_certificate</span>     /etc/letsencrypt/live/example.com/fullchain.pem;
    <span class="c-dir">ssl_certificate_key</span> /etc/letsencrypt/live/example.com/privkey.pem;

    <span class="c-dir">return</span> 301 https://example.com$request_uri;
}

<span class="c-comment"># Блок 3: основной сайт</span>
<span class="c-key">server</span> {
    <span class="c-dir">listen</span> 443 ssl http2;
    <span class="c-dir">server_name</span> example.com;

    <span class="c-dir">ssl_certificate</span>     /etc/letsencrypt/live/example.com/fullchain.pem;
    <span class="c-dir">ssl_certificate_key</span> /etc/letsencrypt/live/example.com/privkey.pem;

    <span class="c-dir">root</span> /var/www/example.com/public;
    <span class="c-dir">index</span> index.php;

    <span class="c-key">location</span> / {
        <span class="c-dir">try_files</span> $uri $uri/ /index.php?$query_string;
    }

    <span class="c-comment"># PHP — см. раздел про PHP-FPM</span>
    <span class="c-key">location</span> ~ \.php$ {
        <span class="c-dir">include</span> snippets/fastcgi-php.conf;
        <span class="c-dir">fastcgi_pass</span> unix:/run/php/php8.3-fpm.sock;
    }
}</code></pre>

    <div class="remember-box">
      <strong>Практика:</strong> три блока — HTTP→HTTPS, www→non-www на HTTPS, основной. Три файла в <code>sites-available/</code> либо один общий с тремя <code>server{}</code> — вопрос вкуса. Один файл проще для одного сайта.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     NGINX — LOCATION
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-nginx-location" class="section">
  <div class="section-title">Location блоки — маршрутизация запросов</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map-pin"></i> Что такое location</div>
    <p class="text"><code>location</code> — правило для конкретного URL-пути внутри <code>server</code>. По одному URL может подходить несколько location'ов — Nginx выбирает <em>один</em> по приоритету.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list-ordered"></i> 5 типов location — по приоритету выбора</div>
    <table class="data-table">
      <thead><tr><th>Синтаксис</th><th>Что означает</th><th>Приоритет</th></tr></thead>
      <tbody>
        <tr><td><code>location = /path</code></td><td><strong>Точное</strong> совпадение URI</td><td>1 (высший)</td></tr>
        <tr><td><code>location ^~ /path</code></td><td>Префикс, при совпадении <em>не проверять</em> regex дальше</td><td>2</td></tr>
        <tr><td><code>location ~ pattern</code></td><td>Regex, <strong>case-sensitive</strong></td><td>3</td></tr>
        <tr><td><code>location ~* pattern</code></td><td>Regex, <em>case-insensitive</em></td><td>3</td></tr>
        <tr><td><code>location /path</code></td><td>Обычный префикс (самое длинное совпадение выигрывает)</td><td>4</td></tr>
      </tbody>
    </table>

    <div class="info-box primary">
      <strong>Правило:</strong> сначала Nginx ищет <em>самый длинный префикс</em>. Если <code>^~</code> — берёт его, дальше не смотрит. Иначе идёт по regex сверху вниз, <em>первый совпавший выигрывает</em>. Если regex не совпал — возвращается к найденному префиксу.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="code"></i> Практические примеры</div>
<pre><code><span class="c-key">server</span> {
    <span class="c-dir">listen</span> 80;
    <span class="c-dir">server_name</span> example.com;
    <span class="c-dir">root</span> /var/www/example.com/public;

    <span class="c-comment"># 1. Точное — favicon.ico. Отдать без логирования.</span>
    <span class="c-key">location</span> = /favicon.ico {
        <span class="c-dir">access_log</span> off;
        <span class="c-dir">log_not_found</span> off;
    }

    <span class="c-comment"># 2. Префикс с приоритетом ^~ — вся /admin/ через специальный handler</span>
    <span class="c-key">location</span> ^~ /admin/ {
        <span class="c-dir">auth_basic</span> <span class="c-str">"Admin area"</span>;
        <span class="c-dir">auth_basic_user_file</span> /etc/nginx/.htpasswd;
    }

    <span class="c-comment"># 3. Regex case-insensitive — статика с кешем на год</span>
    <span class="c-key">location</span> ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2)$ {
        <span class="c-dir">expires</span> 1y;
        <span class="c-dir">add_header</span> Cache-Control <span class="c-str">"public, immutable"</span>;
    }

    <span class="c-comment"># 4. Regex — PHP-файлы через FPM</span>
    <span class="c-key">location</span> ~ \.php$ {
        <span class="c-dir">include</span> snippets/fastcgi-php.conf;
        <span class="c-dir">fastcgi_pass</span> unix:/run/php/php8.3-fpm.sock;
    }

    <span class="c-comment"># 5. Дефолтный префикс — Laravel-роутинг: не файл? → index.php</span>
    <span class="c-key">location</span> / {
        <span class="c-dir">try_files</span> $uri $uri/ /index.php?$query_string;
    }
}</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> <code>try_files</code> — магия Laravel-роутинга</div>
    <p class="text"><code>try_files</code> — пробует найти файлы <em>по очереди</em>, отдаёт первый существующий. Последний аргумент — что делать, если ничего не нашлось.</p>

<pre><code><span class="c-dir">try_files</span> $uri $uri/ /index.php?$query_string;</code></pre>

    <p class="text"><strong>Разбор:</strong> для запроса <code>GET /blog/hello-world</code>:</p>
    <ol class="numbered">
      <li><code>$uri</code> = <code>/blog/hello-world</code> — есть такой файл в <code>root</code>? Нет.</li>
      <li><code>$uri/</code> = <code>/blog/hello-world/</code> — есть такая директория? Нет.</li>
      <li>Fallback: передать в <code>/index.php?$query_string</code> — Laravel возьмёт URL из <code>REQUEST_URI</code> и разберётся сам через свой роутер.</li>
    </ol>

    <div class="remember-box">
      <strong>Это единственная строка, которая нужна для Laravel-роутинга.</strong> Без <code>try_files</code> Nginx будет отдавать 404 на любой URL кроме <code>/</code>, потому что физических файлов <code>/blog/hello-world</code> нет — они генерируются PHP.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> <code>root</code> vs <code>alias</code></div>
    <p class="text">Обе задают путь на диске, но <strong>по-разному считают URL</strong>:</p>
    <table class="data-table">
      <thead><tr><th></th><th><code>root /var/www/site</code></th><th><code>alias /var/www/site</code></th></tr></thead>
      <tbody>
        <tr>
          <td>Полный путь</td>
          <td><code>root</code> + <em>полный URI</em></td>
          <td><code>alias</code> + <em>URI без префикса location</em></td>
        </tr>
        <tr>
          <td>Запрос <code>/images/photo.jpg</code></td>
          <td>ищет <code>/var/www/site/images/photo.jpg</code></td>
          <td>для <code>location /images/</code>: ищет <code>/var/www/site/photo.jpg</code></td>
        </tr>
        <tr>
          <td>Типичное применение</td>
          <td>Корень сайта</td>
          <td>«Замапить» URL-путь на директорию с другим именем</td>
        </tr>
      </tbody>
    </table>

<pre><code><span class="c-comment"># root — доступ к /static/logo.png → /var/www/site/static/logo.png</span>
<span class="c-key">location</span> /static/ {
    <span class="c-dir">root</span> /var/www/site;
}

<span class="c-comment"># alias — тот же URL /static/logo.png → /var/www/assets/logo.png</span>
<span class="c-key">location</span> /static/ {
    <span class="c-dir">alias</span> /var/www/assets/;   <span class="c-comment"># !! обязательно / в конце</span>
}</code></pre>

    <div class="pitfall"><strong>Классическая ошибка с alias:</strong> забыть <code>/</code> в конце пути. С <code>alias /var/www/assets;</code> (без слэша) для запроса <code>/static/logo.png</code> Nginx будет искать <code>/var/www/assetslogo.png</code> — 404.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Реальные боли с location</div>
    <div class="pitfall"><strong>1. Дублирующие правила.</strong> Два <code>location ~ \.php$</code> в одном server-блоке — Nginx возьмёт первый. Отладь через <code>rewrite_log on;</code> и <code>error_log ... notice;</code>.</div>
    <div class="pitfall"><strong>2. Regex переопределяет корневой location.</strong> <code>location ~* \.(jpg|png)$</code> может украсть запрос, который ты хотел отдать через <code>/</code>. Правило приоритета — regex &gt; префикс, если нет <code>^~</code>.</div>
    <div class="pitfall"><strong>3. <code>rewrite ^/(.*)$ /index.php last;</code> — устаревший синтаксис.</strong> В современном Nginx для Laravel используй <code>try_files</code>. <code>rewrite</code> оставь для сложных редиректов.</div>
    <div class="pitfall"><strong>4. Слэш в конце и без слэша — разные location.</strong> <code>location /api</code> и <code>location /api/</code> — не одно и то же. Для API обычно <code>/api/</code> с трейлингом.</div>
    <div class="pitfall"><strong>5. Забыт <code>internal;</code> для служебных путей.</strong> Если сделал <code>location /storage/</code> и оттуда через X-Accel-Redirect отдаёшь файлы — обязательно <code>internal;</code>, иначе клиент попадёт напрямую.</div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     NGINX — PHP-FPM
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-nginx-phpfpm" class="section">
  <div class="section-title">PHP-FPM для Laravel — как это связано</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Что такое PHP-FPM</div>
    <p class="text"><strong>PHP-FPM</strong> (FastCGI Process Manager) — отдельный сервис, который держит пул PHP-процессов и обрабатывает запросы по протоколу <strong>FastCGI</strong>. Nginx <em>не умеет</em> сам исполнять PHP — он передаёт запрос PHP-FPM'у, тот выполняет <code>index.php</code>, возвращает результат, Nginx отдаёт клиенту.</p>

    <div class="diagram">Browser
   │  HTTP GET /users/1
   ▼
┌───────┐   1) *.php? Да
│ NGINX │──────────────────────┐
└───────┘                      │
   ▲                           │ FastCGI (unix socket / TCP)
   │  4) HTTP response         ▼
   │                     ┌──────────┐
   └─────────────────────│ PHP-FPM  │  выполняет index.php,
        3) HTML/JSON     └──────────┘  бегает Laravel-роутер</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="download"></i> Установка PHP-FPM (Ubuntu 24.04)</div>
<pre><code><span class="c-comment"># Добавляем PPA от Ondrej (все свежие версии PHP)</span>
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update

<span class="c-comment"># Ставим PHP 8.3 FPM + типовые расширения для Laravel</span>
sudo apt install -y \
    php8.3-fpm php8.3-cli \
    php8.3-mysql php8.3-pgsql php8.3-sqlite3 \
    php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip \
    php8.3-gd php8.3-bcmath php8.3-intl php8.3-redis

<span class="c-comment"># Автозапуск + старт</span>
sudo systemctl enable php8.3-fpm
sudo systemctl start php8.3-fpm

<span class="c-comment"># Проверка</span>
sudo systemctl status php8.3-fpm
php -v</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="folder-tree"></i> Файлы PHP-FPM</div>
<pre><code>/etc/php/8.3/fpm/
├── php.ini                <span class="c-comment"># общий php.ini для FPM (memory_limit, upload_max_filesize)</span>
├── php-fpm.conf           <span class="c-comment"># глобальные настройки FPM</span>
└── pool.d/
    └── www.conf           <span class="c-comment"># настройки пула по умолчанию (user, socket, pm.*)</span>

/run/php/
└── php8.3-fpm.sock        <span class="c-comment"># unix-сокет, через который Nginx стучится к FPM</span>

/var/log/php8.3-fpm.log    <span class="c-comment"># логи FPM (fatal ошибки PHP)</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="settings"></i> Ключевые настройки пула (<code>www.conf</code>)</div>
<pre><code>[www]
<span class="c-dir">user</span> = www-data
<span class="c-dir">group</span> = www-data

<span class="c-comment"># Слушать на unix-сокете (быстрее TCP на localhost)</span>
<span class="c-dir">listen</span> = /run/php/php8.3-fpm.sock
<span class="c-dir">listen.owner</span> = www-data
<span class="c-dir">listen.group</span> = www-data

<span class="c-comment"># Управление процессами</span>
<span class="c-dir">pm</span> = dynamic          <span class="c-comment"># dynamic / static / ondemand</span>
<span class="c-dir">pm.max_children</span> = 20  <span class="c-comment"># макс одновременно PHP-процессов</span>
<span class="c-dir">pm.start_servers</span> = 4
<span class="c-dir">pm.min_spare_servers</span> = 2
<span class="c-dir">pm.max_spare_servers</span> = 6
<span class="c-dir">pm.max_requests</span> = 500 <span class="c-comment"># перезапускать процесс каждые 500 запросов (защита от утечек)</span>

<span class="c-comment"># Логи медленных запросов</span>
<span class="c-dir">slowlog</span> = /var/log/php8.3-fpm.slow.log
<span class="c-dir">request_slowlog_timeout</span> = 5s</code></pre>

    <div class="info-box primary">
      <strong>Как считать <code>pm.max_children</code>:</strong> (RAM_доступная − 1GB на ОС) ÷ (средний расход PHP-процесса, обычно 40–80MB). На сервере с 2GB RAM = (2048 − 1024) ÷ 60 ≈ <strong>17 процессов</strong>. Если поставить больше — сервер начнёт свопиться при пиках.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="link"></i> Как Nginx стучится в PHP-FPM</div>

    <p class="text"><strong>Через unix-сокет</strong> (рекомендуется, если Nginx и FPM на одной машине):</p>
<pre><code><span class="c-key">location</span> ~ \.php$ {
    <span class="c-dir">include</span> snippets/fastcgi-php.conf;
    <span class="c-dir">fastcgi_pass</span> unix:/run/php/php8.3-fpm.sock;
}</code></pre>

    <p class="text"><strong>Через TCP</strong> (когда FPM на другом сервере):</p>
<pre><code><span class="c-key">location</span> ~ \.php$ {
    <span class="c-dir">include</span> snippets/fastcgi-php.conf;
    <span class="c-dir">fastcgi_pass</span> 127.0.0.1:9000;
}</code></pre>

    <p class="text">Содержимое <code>snippets/fastcgi-php.conf</code> — стандартный шаблон Ubuntu:</p>
<pre><code><span class="c-comment"># Regex splits PATH_INFO from SCRIPT_FILENAME</span>
<span class="c-dir">fastcgi_split_path_info</span> ^(.+?\.php)(/.*)$;

<span class="c-comment"># Проверка что файл существует ДО передачи в FPM</span>
<span class="c-dir">try_files</span> $fastcgi_script_name =404;

<span class="c-comment"># Передаваемые FastCGI-параметры</span>
<span class="c-dir">fastcgi_param</span> SCRIPT_FILENAME $document_root$fastcgi_script_name;
<span class="c-dir">fastcgi_param</span> PATH_INFO $fastcgi_path_info;
<span class="c-dir">include</span> fastcgi_params;</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Полный Laravel server-блок с PHP-FPM</div>
<pre><code><span class="c-key">server</span> {
    <span class="c-dir">listen</span> 80;
    <span class="c-dir">server_name</span> example.com;
    <span class="c-dir">root</span> /var/www/example.com/public;
    <span class="c-dir">index</span> index.php;

    <span class="c-dir">client_max_body_size</span> 20M;
    <span class="c-dir">charset</span> utf-8;

    <span class="c-comment"># Все URL Laravel: файл нет → отдать в index.php</span>
    <span class="c-key">location</span> / {
        <span class="c-dir">try_files</span> $uri $uri/ /index.php?$query_string;
    }

    <span class="c-comment"># favicon и robots — молча, без логов</span>
    <span class="c-key">location</span> = /favicon.ico { <span class="c-dir">access_log</span> off; <span class="c-dir">log_not_found</span> off; }
    <span class="c-key">location</span> = /robots.txt  { <span class="c-dir">access_log</span> off; <span class="c-dir">log_not_found</span> off; }

    <span class="c-comment"># PHP через FPM</span>
    <span class="c-key">location</span> ~ \.php$ {
        <span class="c-dir">include</span> snippets/fastcgi-php.conf;
        <span class="c-dir">fastcgi_pass</span> unix:/run/php/php8.3-fpm.sock;
        <span class="c-dir">fastcgi_read_timeout</span> 300;   <span class="c-comment"># для долгих операций (импорт CSV и т.п.)</span>
    }

    <span class="c-comment"># Запретить доступ к .htaccess и любым скрытым файлам</span>
    <span class="c-key">location</span> ~ /\.(?!well-known).* {
        <span class="c-dir">deny</span> all;
    }

    <span class="c-dir">error_log</span> /var/log/nginx/example.com.error.log;
    <span class="c-dir">access_log</span> /var/log/nginx/example.com.access.log;
}</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Классические проблемы PHP-FPM + Nginx</div>
    <div class="pitfall"><strong>1. <code>502 Bad Gateway</code>.</strong> В 90% случаев PHP-FPM не запущен: <code>sudo systemctl status php8.3-fpm</code>. Реже — Nginx стучится не по тому сокету/порту.</div>
    <div class="pitfall"><strong>2. <code>connect() to unix:/run/php/php8.3-fpm.sock failed (13: Permission denied)</code>.</strong> Nginx (пользователь <code>www-data</code>) не может читать сокет. Проверь <code>listen.owner</code> / <code>listen.group</code> в <code>www.conf</code>.</div>
    <div class="pitfall"><strong>3. <code>504 Gateway Timeout</code>.</strong> PHP работает дольше <code>fastcgi_read_timeout</code> (по умолчанию 60с). Увеличь для тяжёлых операций либо унеси в очередь (Laravel Queue).</div>
    <div class="pitfall"><strong>4. Меняешь php.ini — не применяется.</strong> Правишь <code>/etc/php/8.3/cli/php.ini</code>, а FPM читает <code>/etc/php/8.3/fpm/php.ini</code>. И после правки <em>обязательно</em> <code>sudo systemctl reload php8.3-fpm</code>.</div>
    <div class="pitfall"><strong>5. Несколько версий PHP.</strong> Если стоят 8.1 и 8.3 — <code>fastcgi_pass</code> может указывать не на ту. Проверь <code>ls /run/php/</code>.</div>

    <div class="remember-box">
      <strong>Мнемоника «502 → 4 команды»:</strong>
      <br>1. <code>sudo systemctl status php8.3-fpm</code>
      <br>2. <code>sudo tail -f /var/log/php8.3-fpm.log</code>
      <br>3. <code>sudo tail -f /var/log/nginx/error.log</code>
      <br>4. <code>ls -la /run/php/php8.3-fpm.sock</code> (владелец www-data?)
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     STUB SECTIONS — to be filled in next iterations
     ════════════════════════════════════════════════════════════════ -->

<div id="sec-nginx-static" class="section">
  <div class="section-title">Статика + gzip + expires</div>
  <div class="stub">
    <strong>В разработке.</strong> Раздел про эффективную отдачу статики: gzip уровень сжатия, brotli, expires-заголовки для CSS/JS/шрифтов/картинок, immutable-кеш с хешами в имени файла, отключение логирования для favicon/robots.
  </div>
</div>

<div id="sec-nginx-proxy" class="section">
  <div class="section-title">Reverse proxy — Node.js, Python, любой бэкенд</div>
  <div class="stub">
    <strong>В разработке.</strong> <code>proxy_pass</code>, <code>proxy_set_header</code>, <code>upstream</code>-блок, X-Forwarded-For / X-Real-IP, HTTP/1.1 + connection: keep-alive для Node, WebSocket-проксирование (<code>Upgrade</code>/<code>Connection</code>).
  </div>
</div>

<div id="sec-nginx-ssl" class="section">
  <div class="section-title">SSL/TLS + Let's Encrypt</div>
  <div class="stub">
    <strong>В разработке.</strong> Установка certbot, автовыпуск и автопродление, <code>ssl_certificate</code>/<code>ssl_certificate_key</code>, ssl_protocols TLSv1.2 TLSv1.3, ssl_ciphers, HSTS, OCSP stapling, редирект HTTP→HTTPS.
  </div>
</div>

<div id="sec-nginx-security" class="section">
  <div class="section-title">Безопасность + rate limiting</div>
  <div class="stub">
    <strong>В разработке.</strong> server_tokens off, security headers (X-Frame-Options, X-Content-Type-Options, CSP, Referrer-Policy), <code>limit_req_zone</code> + <code>limit_req</code>, <code>limit_conn</code>, IP allow/deny, geo-фильтрация.
  </div>
</div>

<div id="sec-nginx-cache" class="section">
  <div class="section-title">Кеширование</div>
  <div class="stub">
    <strong>В разработке.</strong> <code>proxy_cache_path</code>, <code>proxy_cache</code>, <code>fastcgi_cache</code>, кеш-ключи, <code>proxy_cache_valid</code>, <code>proxy_cache_bypass</code>, микрокеширование в PHP-стеке, инвалидация.
  </div>
</div>

<div id="sec-nginx-lb" class="section">
  <div class="section-title">Load balancing (upstream)</div>
  <div class="stub">
    <strong>В разработке.</strong> <code>upstream</code>-блок, алгоритмы (round-robin, least_conn, ip_hash), weight, backup, max_fails, fail_timeout, health-чеки, sticky sessions.
  </div>
</div>

<div id="sec-nginx-logs" class="section">
  <div class="section-title">Логи + logrotate</div>
  <div class="stub">
    <strong>В разработке.</strong> Форматы log_format, кастомные поля, JSON-логи, error_log уровни (debug/info/notice/warn/error/crit), logrotate-конфиг для nginx, отправка в syslog / ELK.
  </div>
</div>

<div id="sec-nginx-laravel" class="section">
  <div class="section-title">Полный продакшн-конфиг для Laravel</div>
  <div class="stub">
    <strong>В разработке.</strong> Готовый server-блок «под ключ» с HTTPS, редиректом с HTTP, gzip, security headers, кешем статики, PHP-FPM, комментариями по каждой строке. Опциональные блоки: horizon UI, telescope, отладочные роуты.
  </div>
</div>

<div id="sec-nginx-troubleshoot" class="section">
  <div class="section-title">Реальные боли и как их лечить</div>
  <div class="stub">
    <strong>В разработке.</strong> Разбор частых ошибок с примерами лога и решением: <code>502 Bad Gateway</code>, <code>504 Gateway Timeout</code>, <code>413 Payload Too Large</code>, <code>499 Client Closed Request</code>, <code>upstream sent too big header</code>, permission denied on socket, «сайт то работает, то нет», mixed content после SSL.
  </div>
</div>

<div id="sec-docker-intro" class="section">
  <div class="section-title">Что такое Docker + VM vs Container</div>
  <div class="stub">
    <strong>В разработке.</strong> Зачем контейнеризация, разница с VM (общее ядро vs полная ОС), image vs container, слои, реестры (Docker Hub, GHCR), базовые термины.
  </div>
</div>

<div id="sec-docker-basics" class="section">
  <div class="section-title">Основные команды Docker</div>
  <div class="stub">
    <strong>В разработке.</strong> <code>docker run</code>, <code>docker ps</code>, <code>docker exec</code>, <code>docker logs</code>, <code>docker stop</code>/<code>rm</code>, <code>docker pull</code>/<code>images</code>/<code>rmi</code>, <code>docker inspect</code>, <code>docker system prune</code>.
  </div>
</div>

<div id="sec-docker-file" class="section">
  <div class="section-title">Dockerfile</div>
  <div class="stub">
    <strong>В разработке.</strong> FROM, WORKDIR, COPY vs ADD, RUN, ENV, ARG, EXPOSE, CMD vs ENTRYPOINT, HEALTHCHECK, USER, порядок инструкций для кеша слоёв, multi-stage builds.
  </div>
</div>

<div id="sec-docker-compose" class="section">
  <div class="section-title">docker compose</div>
  <div class="stub">
    <strong>В разработке.</strong> compose.yaml: services, image/build, ports, volumes, environment, env_file, depends_on + healthcheck, networks, restart policy. Команды <code>compose up/down/logs/exec</code>.
  </div>
</div>

<div id="sec-docker-volumes" class="section">
  <div class="section-title">Volumes + bind mounts</div>
  <div class="stub">
    <strong>В разработке.</strong> Named volumes vs bind mounts vs tmpfs, где физически хранятся, права/владельцы, бэкап/восстановление, volumes для БД (persistence), bind для разработки (hot reload).
  </div>
</div>

<div id="sec-docker-networks" class="section">
  <div class="section-title">Networks</div>
  <div class="stub">
    <strong>В разработке.</strong> Bridge/host/none, custom networks, DNS между контейнерами по имени сервиса, порты host:container, внутренние vs внешние сети, изоляция.
  </div>
</div>

<div id="sec-docker-laravel" class="section">
  <div class="section-title">Laravel в Docker</div>
  <div class="stub">
    <strong>В разработке.</strong> Готовый стек: nginx + php-fpm + mysql + redis через compose. Dockerfile для PHP с расширениями. Env-переменные, миграции, сидеры, artisan-команды через <code>exec</code>. Laravel Sail vs собственный compose.
  </div>
</div>

<div id="sec-docker-troubleshoot" class="section">
  <div class="section-title">Реальные боли Docker</div>
  <div class="stub">
    <strong>В разработке.</strong> «Контейнер выходит через секунду», permission denied на volume, порты заняты, где логи, healthcheck failed, DNS не резолвит, кеш слоёв не работает, «на моей машине работает».
  </div>
</div>

<div id="sec-systemd" class="section">
  <div class="section-title">systemd глубже</div>
  <div class="stub">
    <strong>В разработке.</strong> Unit-файлы, кастомные сервисы (для Laravel Queue Worker, Horizon), timers как замена cron, drop-in overrides, journalctl, автоперезапуск, зависимости between units.
  </div>
</div>

<div id="sec-ssh" class="section">
  <div class="section-title">SSH: deploy + key auth</div>
  <div class="stub">
    <strong>В разработке.</strong> Генерация ключей, ~/.ssh/config, ssh-agent + forwarding, jump host (ProxyJump), rsync/scp, SSH для git (deploy keys), запрет root login, fail2ban базово.
  </div>
</div>

<div id="sec-cron" class="section">
  <div class="section-title">Cron</div>
  <div class="stub">
    <strong>В разработке.</strong> crontab -e vs /etc/cron.d/, синтаксис пяти полей, env-переменные, куда пишется stdout/stderr, cron для Laravel Scheduler, systemd timers как альтернатива.
  </div>
</div>

<div id="sec-monitoring" class="section">
  <div class="section-title">Мониторинг сервера</div>
  <div class="stub">
    <strong>В разработке.</strong> top/htop/btop, iostat/vmstat/iotop, df -h/du/ncdu, ss/netstat/lsof, journalctl -f, tail -f, nload, Prometheus + Grafana в двух словах.
  </div>
</div>

<div id="sec-cicd" class="section">
  <div class="section-title">CI/CD базово</div>
  <div class="stub">
    <strong>В разработке.</strong> GitHub Actions базово: workflow.yml, jobs, steps, secrets. Пример pipeline: push в main → build → deploy на VPS через SSH. Zero-downtime deploy pattern.
  </div>
</div>

<div id="sec-checklist" class="section">
  <div class="section-title">Чек-лист боевого сервера</div>
  <div class="stub">
    <strong>В разработке.</strong> Итоговый чек-лист по свежей VPS: ufw, fail2ban, SSH key-only + no root, автообновления безопасности, swap, ntp, timezone, nginx + php-fpm + mysql/postgres, certbot автопродление, backups, мониторинг, log rotation, cron/scheduler.
  </div>
</div>

</div><!-- /main -->
</div><!-- /container -->

<script src="https://unpkg.com/lucide@0.344.0/dist/umd/lucide.min.js"></script>
<script>
lucide.createIcons();

function showSection(id, el) {
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  const sec = document.getElementById('sec-' + id);
  if (sec) { sec.classList.add('active'); }
  if (el) { el.classList.add('active'); }
  window.scrollTo(0, 0);
  lucide.createIcons();
}
</script>
</body>
</html>

@endverbatim
