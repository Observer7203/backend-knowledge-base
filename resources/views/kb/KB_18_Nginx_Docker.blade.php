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
    <div class="subsection-title"><i data-lucide="apple"></i> Установка на macOS (Homebrew)</div>
    <p class="text">На маке Nginx ставят через Homebrew — для локальной разработки, не для прода. Устройство там заметно другое, чем на Debian, и первые грабли начинаются сразу.</p>
<pre><code><span class="c-comment"># 1. Установка</span>
brew install nginx

<span class="c-comment"># 2. Запуск как сервис (поднимется и после перезагрузки)</span>
brew services start nginx

<span class="c-comment"># 3. Статус всех brew-сервисов</span>
brew services list

<span class="c-comment"># 4. Перезапуск после правки конфига</span>
brew services restart nginx

<span class="c-comment"># 5. Проверка</span>
nginx -v
curl http://localhost:8080</code></pre>

    <div class="why-box"><strong>Порт 8080, а не 80 — и это главное отличие.</strong> Homebrew запускает Nginx от <em>твоего пользователя</em>, а не от root. Порты ниже 1024 без root занять нельзя, поэтому в дефолтном конфиге стоит <code>listen 8080</code>. Если нужен именно 80 — запускай сервис через <code>sudo brew services start nginx</code> и правь <code>listen</code> в конфиге.</div>

    <div class="pitfall"><strong>На macOS нет <code>systemctl</code>.</strong> Вместо него launchd: <code>brew services</code> кладёт plist в <code>~/Library/LaunchAgents/homebrew.mxcl.nginx.plist</code>. Команды <code>systemctl status nginx</code>, <code>journalctl -u nginx</code> тут просто не существуют — смотри <code>brew services list</code> и <code>/opt/homebrew/var/log/nginx/error.log</code>.</div>

    <div class="pitfall"><strong>Префикс зависит от процессора.</strong> На Apple Silicon (M1–M4) Homebrew живёт в <code>/opt/homebrew</code>, на старых Intel-маках — в <code>/usr/local</code>. Все пути ниже даны для Apple Silicon. Свой путь всегда можно узнать командой <code>brew --prefix</code>.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="folder-tree"></i> Структура файлов на macOS (Homebrew)</div>
    <div class="diagram">/opt/homebrew/etc/nginx/
├── nginx.conf              # ГЛАВНЫЙ конфиг
├── nginx.conf.default      # нетронутая копия от установщика
├── mime.types              # таблица MIME-типов
├── fastcgi_params          # переменные для FastCGI (PHP-FPM)
├── fastcgi.conf            # то же + SCRIPT_FILENAME
├── scgi_params, uwsgi_params
├── koi-utf, koi-win, win-utf   # кодировочные карты, трогать не нужно
├── *.default               # эталонные копии ВСЕХ конфигов
└── servers/                # ← сюда кладут конфиги своих сайтов
    └── .keepme             # пустышка, чтобы папка не пропала

/opt/homebrew/var/
├── www/                    # дефолтный docroot (welcome-страница)
├── log/nginx/
│   ├── access.log
│   └── error.log
└── run/
    └── nginx.pid           # PID мастер-процесса

/opt/homebrew/bin/nginx     # симлинк на бинарник
/opt/homebrew/Cellar/nginx/1.31.7/   # сама установка нужной версии
└── bin/nginx

~/Library/LaunchAgents/homebrew.mxcl.nginx.plist   # автозапуск</div>

    <div class="remember-box"><strong>Главное структурное отличие: папки <code>servers/</code> вместо пары <code>sites-available</code> + <code>sites-enabled</code>.</strong> Символьных ссылок и команды <code>nginx_ensite</code> тут нет — просто положи файл в <code>servers/</code>, и он подхватится. В конце <code>http</code>-блока главного конфига стоит <code>include servers/*;</code>.</div>

    <div class="why-box"><strong>Зачем файлы <code>.default</code>.</strong> Homebrew хранит рядом с каждым конфигом его эталонную копию. Если доломал <code>nginx.conf</code> — всегда можно вернуться: <code>cp nginx.conf.default nginx.conf</code>. При обновлении формулы brew не перетирает твой конфиг, а обновляет только <code>.default</code>.</div>

    <table class="data-table">
      <thead><tr><th>Что</th><th>Debian / Ubuntu</th><th>macOS (Homebrew, Apple Silicon)</th></tr></thead>
      <tbody>
        <tr><td>Установка</td><td><code>apt install nginx</code></td><td><code>brew install nginx</code></td></tr>
        <tr><td>Главный конфиг</td><td><code>/etc/nginx/nginx.conf</code></td><td><code>/opt/homebrew/etc/nginx/nginx.conf</code></td></tr>
        <tr><td>Конфиги сайтов</td><td><code>sites-available/</code> + симлинк в <code>sites-enabled/</code></td><td><code>servers/</code> — без симлинков</td></tr>
        <tr><td>Порт по умолчанию</td><td>80</td><td><strong>8080</strong></td></tr>
        <tr><td>От кого работает</td><td><code>root</code> → воркеры от <code>www-data</code></td><td>От твоего пользователя</td></tr>
        <tr><td>Управление</td><td><code>systemctl</code></td><td><code>brew services</code> (launchd)</td></tr>
        <tr><td>Логи</td><td><code>/var/log/nginx/</code></td><td><code>/opt/homebrew/var/log/nginx/</code></td></tr>
        <tr><td>Docroot</td><td><code>/var/www/</code></td><td><code>/opt/homebrew/var/www/</code></td></tr>
        <tr><td>PID</td><td><code>/var/run/nginx.pid</code></td><td><code>/opt/homebrew/var/run/nginx.pid</code></td></tr>
        <tr><td>Бинарник</td><td><code>/usr/sbin/nginx</code></td><td><code>/opt/homebrew/bin/nginx</code></td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-code-2"></i> Laravel на macOS: конфиг сайта + PHP-FPM</div>
    <p class="text">PHP-FPM из Homebrew по умолчанию слушает <strong>TCP-порт 9000</strong>, а не unix-сокет — в отличие от Debian, где обычно <code>/run/php/php8.3-fpm.sock</code>. Это первое, обо что спотыкаются при переносе конфига с сервера на мак.</p>
<pre><code><span class="c-comment"># Ставим PHP (придёт вместе с php-fpm) и запускаем</span>
brew install php@8.3
brew services start php@8.3

<span class="c-comment"># Проверить, на чём слушает</span>
grep <span class="c-str">"^listen ="</span> /opt/homebrew/etc/php/8.3/php-fpm.d/www.conf
<span class="c-comment"># listen = 127.0.0.1:9000</span></code></pre>
    <p class="text">Конфиг сайта кладём в <code>servers/</code> — например <code>/opt/homebrew/etc/nginx/servers/myapp.conf</code>:</p>
<pre><code><span class="c-key">server</span> {
    <span class="c-dir">listen</span> <span class="c-num">8000</span>;
    <span class="c-dir">server_name</span> localhost;

    <span class="c-comment"># У Laravel root ВСЕГДА указывает на public/</span>
    <span class="c-dir">root</span> /Users/username/projects/myapp/public;
    <span class="c-dir">index</span> index.php;

    <span class="c-key">location</span> / {
        <span class="c-dir">try_files</span> <span class="c-var">$uri</span> <span class="c-var">$uri</span>/ /index.php?<span class="c-var">$query_string</span>;
    }

    <span class="c-key">location</span> ~ \.php$ {
        <span class="c-dir">include</span> fastcgi_params;
        <span class="c-dir">fastcgi_pass</span> <span class="c-str">127.0.0.1:9000</span>;   <span class="c-comment"># на Debian тут был бы unix-сокет</span>
        <span class="c-dir">fastcgi_param</span> SCRIPT_FILENAME <span class="c-var">$document_root</span><span class="c-var">$fastcgi_script_name</span>;
    }
}</code></pre>
<pre><code><span class="c-comment"># Проверить синтаксис и применить</span>
nginx -t
brew services restart nginx</code></pre>

    <div class="pitfall"><strong>Права доступа к домашней папке.</strong> Nginx работает от твоего пользователя, так что до <code>~/projects</code> он дотянется. Но если проект лежит в <code>~/Documents</code>, <code>~/Desktop</code> или <code>~/Downloads</code>, macOS может заблокировать доступ своей защитой приватности — в логе будет <code>Permission denied</code> при живых правах файла. Держи локальные проекты вне этих трёх папок.</div>

    <div class="remember-box"><strong>Отладка — всегда в таком порядке:</strong> <code>nginx -t</code> проверит синтаксис → <code>brew services list</code> покажет, поднят ли сервис → <code>tail -f /opt/homebrew/var/log/nginx/error.log</code> скажет, что именно не так. На macOS <code>journalctl</code> нет, лог — единственный источник правды.</div>
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

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-left-right"></i> Forward proxy против reverse proxy</div>
    <p class="text">Оба называются «прокси» и оба пересылают трафик, но стоят по разные стороны и решают противоположные задачи.</p>

    <div class="remember-box"><strong>Одной фразой.</strong> Forward proxy представляет <em>клиента</em>, reverse proxy представляет <em>сервер</em>. Forward — изнутри наружу, reverse — снаружи внутрь.</div>

    <div class="diagram">FORWARD PROXY  (прямой, «обычный»)

   Клиент ──→ Forward Proxy ──→ Интернет

   · стоит на стороне клиента
   · клиент настраивает его сам
   · скрывает КЛИЕНТА от внешних серверов
   · трафик идёт изнутри наружу


REVERSE PROXY  (обратный)

   Интернет ──→ Reverse Proxy ──→ Бэкенд
                                  (Node.js, Python, Java, PHP-FPM)

   · стоит на стороне сервера
   · клиент обычно не знает о его существовании
     и думает, что говорит напрямую с сайтом
   · скрывает СЕРВЕР от интернета
   · трафик идёт снаружи внутрь</div>

    <table class="data-table">
      <thead><tr><th></th><th>Forward proxy</th><th>Reverse proxy</th></tr></thead>
      <tbody>
        <tr><td><strong>Чью сторону представляет</strong></td><td>Клиента</td><td>Сервер</td></tr>
        <tr><td><strong>Где стоит</strong></td><td>Рядом с клиентом</td><td>Перед бэкендом</td></tr>
        <tr><td><strong>Кто его настраивает</strong></td><td>Сам клиент</td><td>Владелец сервера</td></tr>
        <tr><td><strong>Кто о нём знает</strong></td><td>Клиент знает, сервер — нет</td><td>Сервер знает, клиент — нет</td></tr>
        <tr><td><strong>Кого скрывает</strong></td><td>Клиента</td><td>Сервер</td></tr>
        <tr><td><strong>Направление</strong></td><td>Изнутри наружу</td><td>Снаружи внутрь</td></tr>
        <tr><td><strong>Типичное применение</strong></td><td>Корпоративный фильтр, обход блокировок, кеш исходящих запросов, анонимность</td><td>Терминация TLS, балансировка, отдача статики, защита бэкенда, единая точка входа</td></tr>
        <tr><td><strong>Примеры</strong></td><td>Squid, корпоративный HTTP-прокси, VPN-шлюз</td><td>Nginx, HAProxy, Traefik, Cloudflare</td></tr>
      </tbody>
    </table>

    <div class="analogy"><strong>Аналогия.</strong> Forward proxy — личный курьер: ты даёшь ему поручение, он идёт в магазин вместо тебя, и магазин видит курьера, а не тебя. Reverse proxy — ресепшен в бизнес-центре: посетитель приходит «в компанию», говорит с ресепшеном, и понятия не имеет, в каком кабинете на каком этаже сидит нужный сотрудник.</div>

    <div class="why-box"><strong>Почему Nginx — почти всегда reverse.</strong> Node.js, Python и Go умеют слушать порт сами, и сайт в принципе работает без Nginx. Но тогда прямо в интернет торчит приложение: оно само занимается TLS, медленными клиентами, отдачей статики и лимитами. Reverse proxy забирает всё это на себя и оставляет приложению только бизнес-логику.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-right-left"></i> proxy_pass — базовая схема</div>
<pre><code><span class="c-key">server</span> {
    <span class="c-dir">listen</span> <span class="c-num">80</span>;
    <span class="c-dir">server_name</span> app.example.com;

    <span class="c-key">location</span> / {
        <span class="c-dir">proxy_pass</span> <span class="c-str">http://127.0.0.1:3000</span>;

        <span class="c-comment"># Без этих заголовков бэкенд увидит вместо клиента сам Nginx</span>
        <span class="c-dir">proxy_set_header</span> Host              <span class="c-var">$host</span>;
        <span class="c-dir">proxy_set_header</span> X-Real-IP         <span class="c-var">$remote_addr</span>;
        <span class="c-dir">proxy_set_header</span> X-Forwarded-For   <span class="c-var">$proxy_add_x_forwarded_for</span>;
        <span class="c-dir">proxy_set_header</span> X-Forwarded-Proto <span class="c-var">$scheme</span>;
    }
}</code></pre>

    <div class="pitfall"><strong>Слеш в конце <code>proxy_pass</code> меняет поведение.</strong> <code>proxy_pass http://app:3000;</code> передаёт URI как есть. <code>proxy_pass http://app:3000/;</code> — со слешем — <em>отрезает</em> совпавшую часть location. Для <code>location /api/</code> запрос <code>/api/users</code> уйдёт как <code>/users</code>. Перепутал — получишь 404 на ровном месте.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="user-check"></i> Заголовки: кто на самом деле клиент</div>
    <p class="text">После проксирования бэкенд видит TCP-соединение от Nginx. Настоящий IP, хост и схему нужно передать явно.</p>
    <table class="data-table">
      <thead><tr><th>Заголовок</th><th>Что несёт</th></tr></thead>
      <tbody>
        <tr><td><code>Host</code></td><td>Исходный домен. Без него бэкенд сгенерирует ссылки на <code>127.0.0.1</code></td></tr>
        <tr><td><code>X-Real-IP</code></td><td>IP клиента одним значением</td></tr>
        <tr><td><code>X-Forwarded-For</code></td><td>Цепочка IP через запятую; <code>$proxy_add_x_forwarded_for</code> дописывает текущий к уже имеющимся</td></tr>
        <tr><td><code>X-Forwarded-Proto</code></td><td><code>http</code> или <code>https</code>. Без него Laravel за TLS-терминацией будет строить ссылки по <code>http</code> и ломать редиректы</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong>Доверять этим заголовкам можно только от своего прокси.</strong> Клиент может прислать <code>X-Forwarded-For</code> сам и подделать IP. В Laravel за это отвечает <code>TrustProxies</code>: пока прокси не перечислен как доверенный, фреймворк эти заголовки игнорирует — и это правильное поведение по умолчанию.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="network"></i> upstream — группа бэкендов</div>
<pre><code><span class="c-key">upstream</span> backend {
    <span class="c-dir">server</span> <span class="c-str">127.0.0.1:3000</span>;
    <span class="c-dir">server</span> <span class="c-str">127.0.0.1:3001</span>;

    <span class="c-comment"># Держать соединения открытыми — экономит TCP-рукопожатия</span>
    <span class="c-dir">keepalive</span> <span class="c-num">32</span>;
}

<span class="c-key">server</span> {
    <span class="c-key">location</span> / {
        <span class="c-dir">proxy_pass</span> <span class="c-str">http://backend</span>;

        <span class="c-comment"># keepalive к upstream работает только с HTTP/1.1 и пустым Connection</span>
        <span class="c-dir">proxy_http_version</span> <span class="c-num">1.1</span>;
        <span class="c-dir">proxy_set_header</span> Connection <span class="c-str">""</span>;
    }
}</code></pre>
    <div class="why-box"><strong>Почему <code>proxy_http_version 1.1</code> обязателен.</strong> По умолчанию Nginx ходит к upstream по HTTP/1.0, где keep-alive не поддерживается — директива <code>keepalive 32</code> в этом случае не даёт ничего. А <code>Connection ""</code> нужен, чтобы не ушёл унаследованный <code>Connection: close</code>.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="radio"></i> WebSocket-проксирование</div>
    <p class="text">WebSocket начинается как обычный HTTP-запрос с просьбой сменить протокол. Nginx должен эту просьбу пропустить, иначе соединение оборвётся на рукопожатии.</p>
<pre><code><span class="c-key">location</span> /ws {
    <span class="c-dir">proxy_pass</span> <span class="c-str">http://127.0.0.1:6001</span>;

    <span class="c-dir">proxy_http_version</span> <span class="c-num">1.1</span>;
    <span class="c-dir">proxy_set_header</span> Upgrade    <span class="c-var">$http_upgrade</span>;
    <span class="c-dir">proxy_set_header</span> Connection <span class="c-str">"upgrade"</span>;
    <span class="c-dir">proxy_set_header</span> Host       <span class="c-var">$host</span>;

    <span class="c-comment"># Иначе Nginx разорвёт простаивающий сокет через 60 секунд</span>
    <span class="c-dir">proxy_read_timeout</span> <span class="c-num">3600s</span>;
}</code></pre>
    <div class="pitfall"><strong>Молчащий WebSocket рвётся по таймауту.</strong> Дефолтный <code>proxy_read_timeout</code> — 60 секунд. Соединение без трафика Nginx закроет, и клиент увидит обрыв без видимой причины. Лечится увеличением таймаута или heartbeat-пингами со стороны приложения.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="timer"></i> Таймауты и типичные ошибки</div>
    <table class="data-table">
      <thead><tr><th>Директива</th><th>По умолчанию</th><th>За что отвечает</th></tr></thead>
      <tbody>
        <tr><td><code>proxy_connect_timeout</code></td><td>60s</td><td>Установка соединения с бэкендом. Больше 75s ставить бессмысленно</td></tr>
        <tr><td><code>proxy_send_timeout</code></td><td>60s</td><td>Передача запроса бэкенду</td></tr>
        <tr><td><code>proxy_read_timeout</code></td><td>60s</td><td>Ожидание ответа. Именно он даёт 504 на долгих операциях</td></tr>
      </tbody>
    </table>
    <table class="data-table">
      <thead><tr><th>Ошибка</th><th>Причина</th></tr></thead>
      <tbody>
        <tr><td><strong>502 Bad Gateway</strong></td><td>Бэкенд не отвечает: не запущен, слушает другой порт, упал</td></tr>
        <tr><td><strong>504 Gateway Timeout</strong></td><td>Бэкенд жив, но не уложился в <code>proxy_read_timeout</code></td></tr>
        <tr><td><strong>Ссылки ведут на 127.0.0.1</strong></td><td>Не передан <code>Host</code></td></tr>
        <tr><td><strong>В логах один и тот же IP</strong></td><td>Не передан <code>X-Real-IP</code> / <code>X-Forwarded-For</code></td></tr>
        <tr><td><strong>Бесконечный редирект на https</strong></td><td>Не передан <code>X-Forwarded-Proto</code>: приложение считает, что пришли по http</td></tr>
      </tbody>
    </table>
  </div>
</div>

<div id="sec-nginx-ssl" class="section">
  <div class="section-title">SSL/TLS + Let's Encrypt</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="lock"></i> Что такое TLS и при чём тут HTTPS</div>
    <p class="text"><strong>TLS</strong> (Transport Layer Security) — криптографический протокол, который даёт три вещи:</p>
    <table class="data-table">
      <thead><tr><th>Свойство</th><th>Что гарантирует</th></tr></thead>
      <tbody>
        <tr><td><strong>Шифрование</strong></td><td>Данные между клиентом и сервером нельзя прочитать по пути</td></tr>
        <tr><td><strong>Целостность</strong></td><td>Данные нельзя незаметно подменить</td></tr>
        <tr><td><strong>Аутентификация</strong></td><td>Клиент убеждается, что сервер действительно тот, за кого себя выдаёт — через TLS-сертификат</td></tr>
      </tbody>
    </table>
    <div class="remember-box"><strong>HTTPS — это просто HTTP поверх TLS.</strong> Тот же самый HTTP-запрос, только внутри зашифрованного TLS-канала. Никакого отдельного «протокола HTTPS» не существует.</div>
    <div class="why-box"><strong>Почему «SSL» всё ещё везде пишут.</strong> SSL — предшественник TLS, последняя версия SSL 3.0 признана небезопасной ещё в 2015-м. Сейчас везде используется TLS, но слово «SSL» осталось в названиях директив (<code>ssl_certificate</code>), команд и в обиходе. Когда говорят «SSL-сертификат» — имеют в виду TLS.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="scissors"></i> TLS termination — прокси разрывает шифрование</div>
    <p class="text">Самая частая схема в проде: HTTPS заканчивается на reverse proxy, а дальше внутрь идёт обычный HTTP.</p>

    <div class="diagram">Клиент ──HTTPS/TLS──→ Reverse proxy ──HTTP──→ Бэкенд
                        (Nginx)              (Node.js, Python,
                        держит                Java, PHP-FPM)
                        сертификаты</div>

    <p class="text">По шагам:</p>
    <ol style="margin:8px 0 14px 22px;color:var(--text2);font-size:13px;line-height:1.85">
      <li><strong>Прокси держит сертификаты.</strong> Например для <code>example.com</code>. Сертификат содержит публичный ключ и подпись удостоверяющего центра (CA).</li>
      <li><strong>Клиент подключается по HTTPS.</strong> Происходит TLS handshake: стороны договариваются о шифрах, клиент проверяет сертификат, обмениваются ключами.</li>
      <li><strong>Прокси «разбирает» TLS</strong> — расшифровывает входящий трафик. Это и называется терминацией.</li>
      <li><strong>Дальше идёт расшифрованный HTTP</strong> — обычно во внутреннюю сеть: <code>http://backend:3000</code> или к PHP-FPM.</li>
      <li><strong>Бэкенд не думает про сертификаты.</strong> Ему не нужно настраивать HTTPS, обновлять сертификаты и следить за версиями TLS — он получает обычный HTTP-запрос.</li>
    </ol>

    <table class="data-table">
      <thead><tr><th>Зачем так делают</th><th>Что это даёт</th></tr></thead>
      <tbody>
        <tr><td>Централизованные сертификаты</td><td>Один прокси вместо десяти бэкендов</td></tr>
        <tr><td>Автопродление</td><td>Let's Encrypt через Nginx, Caddy, Traefik — в одном месте</td></tr>
        <tr><td>Снижение нагрузки</td><td>Шифрование ложится на прокси, а не на приложение</td></tr>
        <tr><td>Единая точка безопасности</td><td>Удобно вешать WAF, rate limit, логирование</td></tr>
        <tr><td>Простота для бэкенда</td><td>Приложение слушает обычный HTTP</td></tr>
      </tbody>
    </table>

    <div class="pitfall"><strong>После терминации трафик до бэкенда идёт незашифрованным.</strong> Это нормально, пока прокси и бэкенд в одной доверенной сети. Если сеть недоверенная — делают <strong>re-encryption</strong>: прокси расшифровывает TLS от клиента и снова шифрует до бэкенда по HTTPS. Либо поднимают <strong>mTLS</strong>, где стороны проверяют сертификаты друг друга.</div>

    <table class="data-table">
      <thead><tr><th>Термин</th><th>Значение</th></tr></thead>
      <tbody>
        <tr><td><strong>TLS termination</strong></td><td>Прокси завершает TLS, дальше идёт HTTP</td></tr>
        <tr><td><strong>TLS offloading</strong></td><td>Тот же процесс с акцентом на снятие нагрузки с бэкенда</td></tr>
        <tr><td><strong>SSL termination</strong></td><td>Устаревшее название того же самого — SSL давно мёртв, термин остался</td></tr>
        <tr><td><strong>Re-encryption</strong></td><td>Расшифровал от клиента → зашифровал заново до бэкенда</td></tr>
        <tr><td><strong>TLS passthrough</strong></td><td>Прокси вообще не расшифровывает, пробрасывает TLS целиком на бэкенд</td></tr>
      </tbody>
    </table>

    <div class="pitfall"><strong>Бэкенд должен знать, что снаружи был HTTPS.</strong> После терминации приложение видит обычный HTTP и будет строить ссылки по <code>http://</code> — отсюда бесконечные редиректы и «mixed content». Лечится заголовком <code>X-Forwarded-Proto $scheme</code> из раздела про reverse proxy плюс <code>TrustProxies</code> на стороне Laravel.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="badge-check"></i> Let's Encrypt через certbot</div>
<pre><code><span class="c-comment"># Установка (Debian/Ubuntu)</span>
sudo apt install certbot python3-certbot-nginx -y

<span class="c-comment"># Выпуск сертификата — certbot сам правит конфиг Nginx и перезагружает его</span>
sudo certbot --nginx -d example.com -d www.example.com

<span class="c-comment"># Только выпустить, конфиг не трогать</span>
sudo certbot certonly --nginx -d example.com

<span class="c-comment"># Проверить автопродление вхолостую</span>
sudo certbot renew --dry-run

<span class="c-comment"># Список выпущенных</span>
sudo certbot certificates</code></pre>
    <div class="why-box"><strong>Автопродление настраивается само.</strong> Пакет ставит systemd-таймер <code>certbot.timer</code> (или cron), который дважды в сутки проверяет срок. Сертификат Let's Encrypt живёт <strong>90 дней</strong>, обновляется примерно за 30 до конца. Проверить таймер: <code>systemctl list-timers | grep certbot</code>.</div>
    <div class="pitfall"><strong>Для выпуска нужен работающий HTTP на 80 порту.</strong> HTTP-01 challenge кладёт файл в <code>/.well-known/acme-challenge/</code> и забирает его снаружи. Если 80-й закрыт файрволом или весь трафик редиректится на HTTPS без исключения для этого пути — выпуск упадёт.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-key"></i> Конфиг Nginx с TLS</div>
<pre><code><span class="c-comment"># HTTP — только редирект на HTTPS</span>
<span class="c-key">server</span> {
    <span class="c-dir">listen</span> <span class="c-num">80</span>;
    <span class="c-dir">server_name</span> example.com www.example.com;

    <span class="c-comment"># Исключение для certbot, иначе продление сломается</span>
    <span class="c-key">location</span> /.well-known/acme-challenge/ {
        <span class="c-dir">root</span> /var/www/html;
    }

    <span class="c-key">location</span> / {
        <span class="c-dir">return</span> <span class="c-num">301</span> <span class="c-str">https://</span><span class="c-var">$host</span><span class="c-var">$request_uri</span>;
    }
}

<span class="c-key">server</span> {
    <span class="c-dir">listen</span> <span class="c-num">443</span> ssl;
    <span class="c-dir">http2</span> <span class="c-key">on</span>;
    <span class="c-dir">server_name</span> example.com www.example.com;

    <span class="c-comment"># Сертификат и приватный ключ</span>
    <span class="c-dir">ssl_certificate</span>     /etc/letsencrypt/live/example.com/fullchain.pem;
    <span class="c-dir">ssl_certificate_key</span> /etc/letsencrypt/live/example.com/privkey.pem;

    <span class="c-comment"># Только современные версии — 1.0 и 1.1 устарели и небезопасны</span>
    <span class="c-dir">ssl_protocols</span> TLSv1.2 TLSv1.3;
    <span class="c-dir">ssl_prefer_server_ciphers</span> <span class="c-key">off</span>;
    <span class="c-dir">ssl_ciphers</span> ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES256-GCM-SHA384;

    <span class="c-comment"># Кеш сессий — меньше полных handshake'ов</span>
    <span class="c-dir">ssl_session_cache</span> shared:SSL:10m;
    <span class="c-dir">ssl_session_timeout</span> <span class="c-num">1d</span>;
    <span class="c-dir">ssl_session_tickets</span> <span class="c-key">off</span>;

    <span class="c-comment"># OCSP stapling — сервер сам прикладывает ответ о валидности</span>
    <span class="c-dir">ssl_stapling</span> <span class="c-key">on</span>;
    <span class="c-dir">ssl_stapling_verify</span> <span class="c-key">on</span>;
    <span class="c-dir">ssl_trusted_certificate</span> /etc/letsencrypt/live/example.com/chain.pem;
    <span class="c-dir">resolver</span> <span class="c-num">1.1.1.1</span> <span class="c-num">8.8.8.8</span> valid=300s;

    <span class="c-comment"># HSTS — браузер запомнит, что сюда только по HTTPS</span>
    <span class="c-dir">add_header</span> Strict-Transport-Security <span class="c-str">"max-age=31536000; includeSubDomains"</span> always;

    <span class="c-dir">root</span> /var/www/example.com/public;
    <span class="c-dir">index</span> index.php;
}</code></pre>

    <table class="data-table">
      <thead><tr><th>Файл Let's Encrypt</th><th>Что это</th></tr></thead>
      <tbody>
        <tr><td><code>fullchain.pem</code></td><td>Сертификат сайта + промежуточные CA. Именно его указывают в <code>ssl_certificate</code></td></tr>
        <tr><td><code>privkey.pem</code></td><td>Приватный ключ. Наружу не отдаётся никогда</td></tr>
        <tr><td><code>chain.pem</code></td><td>Только промежуточные CA — нужен для OCSP stapling</td></tr>
        <tr><td><code>cert.pem</code></td><td>Только сертификат сайта, без цепочки. Для Nginx не подходит</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong>Частая ошибка: указать <code>cert.pem</code> вместо <code>fullchain.pem</code>.</strong> В браузере всё будет выглядеть нормально, а мобильные приложения и <code>curl</code> начнут ругаться на недоверенный сертификат — без промежуточных CA цепочка не выстраивается.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield-alert"></i> HSTS и подводные камни</div>
    <div class="pitfall"><strong>HSTS необратим на время <code>max-age</code>.</strong> Выставил <code>max-age=31536000</code> — браузеры год будут ходить только по HTTPS, игнорируя твой конфиг. Сломался сертификат — сайт недоступен, и «просто откатить на HTTP» не выйдет. Начинай с малого: <code>max-age=300</code>, убедись что всё работает, и только потом поднимай до года.</div>
    <div class="pitfall"><strong><code>includeSubDomains</code> накрывает все поддомены разом.</strong> Включая те, где HTTPS ещё нет — какой-нибудь внутренний <code>old.example.com</code> просто перестанет открываться.</div>
    <div class="pitfall"><strong><code>add_header</code> не наследуется.</strong> Если в <code>location</code> есть свой <code>add_header</code>, все заголовки из <code>server</code> в этом location теряются — HSTS в том числе. Поэтому и пишут <code>always</code>, и дублируют заголовок там, где он нужен.</div>
    <div class="remember-box"><strong>Проверка конфигурации:</strong> <code>nginx -t</code> для синтаксиса, <code>openssl s_client -connect example.com:443 -servername example.com</code> для цепочки и версии TLS, <code>curl -sI https://example.com | grep -i strict</code> для HSTS. Публичный аудит — SSL Labs.</div>
  </div>
</div>

<div id="sec-nginx-security" class="section">
  <div class="section-title">Безопасность + rate limiting</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="gauge"></i> Что такое rate limit</div>
    <p class="text"><strong>Rate limiting</strong> — ограничение количества запросов от одного клиента за промежуток времени. Проще: «не больше N запросов в секунду с одного IP, пользователя или API-ключа».</p>
    <ul style="margin:8px 0 14px 22px;color:var(--text2);font-size:13px;line-height:1.85">
      <li>не больше 5 запросов в секунду с одного IP;</li>
      <li>не больше 100 запросов в минуту на один API-ключ;</li>
      <li>не больше 10 попыток логина в минуту с одного IP.</li>
    </ul>
    <p class="text">При превышении сервер обычно возвращает <strong>429 Too Many Requests</strong> или <strong>503</strong>, либо задерживает запрос, либо ненадолго ставит его в очередь.</p>

    <table class="data-table">
      <thead><tr><th>Зачем нужен</th><th>От чего защищает</th></tr></thead>
      <tbody>
        <tr><td>Брутфорс</td><td>Перебор паролей на форме логина</td></tr>
        <tr><td>DDoS и флуд</td><td>Лавина запросов с одного источника</td></tr>
        <tr><td>Скрапинг</td><td>Массовый парсинг контента</td></tr>
        <tr><td>Перегрузка бэкенда</td><td>Один клиент не кладёт приложение целиком</td></tr>
        <tr><td>Справедливое распределение</td><td>Ресурсы делятся между всеми клиентами</td></tr>
        <tr><td>Контроль нагрузки на API</td><td>Предсказуемый расход квот и мощностей</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="sliders-horizontal"></i> limit_req в Nginx</div>
<pre><code><span class="c-comment"># Зона объявляется в http-блоке, один раз</span>
<span class="c-dir">limit_req_zone</span> <span class="c-var">$binary_remote_addr</span> zone=api:<span class="c-num">10m</span> rate=<span class="c-num">5r/s</span>;

<span class="c-key">server</span> {
    <span class="c-key">location</span> /api/ {
        <span class="c-dir">limit_req</span> zone=api burst=<span class="c-num">10</span> nodelay;
        <span class="c-dir">limit_req_status</span> <span class="c-num">429</span>;        <span class="c-comment"># по умолчанию 503</span>
        <span class="c-dir">proxy_pass</span> <span class="c-str">http://backend</span>;
    }
}</code></pre>
    <table class="data-table">
      <thead><tr><th>Параметр</th><th>Что означает</th></tr></thead>
      <tbody>
        <tr><td><code>$binary_remote_addr</code></td><td>Ключ, по которому считаем. Обычно IP клиента. Бинарная форма занимает меньше памяти, чем <code>$remote_addr</code></td></tr>
        <tr><td><code>zone=api:10m</code></td><td>Имя зоны и объём памяти под счётчики — 10 МБ хватает примерно на 160 тысяч IP</td></tr>
        <tr><td><code>rate=5r/s</code></td><td>Не больше 5 запросов в секунду. Можно <code>30r/m</code> для минутных лимитов</td></tr>
        <tr><td><code>burst=10</code></td><td>Разрешает кратковременный всплеск — до 10 запросов сверх лимита</td></tr>
        <tr><td><code>nodelay</code></td><td>Всплеск не задерживать, а пропускать сразу в пределах <code>burst</code></td></tr>
        <tr><td><code>limit_req_status</code></td><td>Код ответа при превышении. 429 честнее, чем дефолтный 503</td></tr>
      </tbody>
    </table>

    <div class="why-box"><strong>Что реально делают <code>burst</code> и <code>nodelay</code>.</strong> Без <code>burst</code> лимит жёсткий: шестой запрос в ту же секунду сразу отлетает. Реальные страницы грузят десяток ресурсов пачкой, и такой лимит будет рубить обычных пользователей. <code>burst=10</code> даёт очередь на 10 запросов сверх нормы. Без <code>nodelay</code> они исполняются <em>с задержкой</em>, растягиваясь под <code>rate</code> — пользователь ждёт. С <code>nodelay</code> проходят мгновенно, а место в очереди освобождается по графику. На практике почти всегда нужен <code>burst</code> + <code>nodelay</code>.</div>

    <div class="pitfall"><strong>За балансировщиком или Cloudflare лимит считается неправильно.</strong> <code>$binary_remote_addr</code> будет содержать IP самого балансировщика, и <em>все клиенты посчитаются как один</em> — лимит сработает сразу для всех. Нужен <code>real_ip_module</code>:
<br><br>
<code>set_real_ip_from 10.0.0.0/8;</code><br>
<code>real_ip_header X-Forwarded-For;</code><br>
<code>real_ip_recursive on;</code><br><br>
Перечислять в <code>set_real_ip_from</code> надо только свои доверенные прокси — иначе клиент подделает <code>X-Forwarded-For</code> и обойдёт лимит.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> limit_req против limit_conn</div>
    <table class="data-table">
      <thead><tr><th></th><th><code>limit_req</code></th><th><code>limit_conn</code></th></tr></thead>
      <tbody>
        <tr><td><strong>Ограничивает</strong></td><td>Скорость запросов</td><td>Число одновременных соединений</td></tr>
        <tr><td><strong>Единица</strong></td><td>Запросов в секунду или минуту</td><td>Открытых соединений с одного ключа</td></tr>
        <tr><td><strong>Против чего</strong></td><td>Брутфорс, флуд, скрапинг</td><td>Качание файлов в сто потоков, Slowloris</td></tr>
      </tbody>
    </table>
<pre><code><span class="c-dir">limit_conn_zone</span> <span class="c-var">$binary_remote_addr</span> zone=addr:<span class="c-num">10m</span>;

<span class="c-key">server</span> {
    <span class="c-dir">limit_conn</span> addr <span class="c-num">10</span>;          <span class="c-comment"># максимум 10 соединений с одного IP</span>
    <span class="c-dir">limit_conn_status</span> <span class="c-num">429</span>;
}</code></pre>
    <div class="remember-box">Эти две директивы не заменяют друг друга — их ставят вместе. <code>limit_req</code> держит частоту, <code>limit_conn</code> — параллелизм.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="bucket"></i> Алгоритмы rate limiting</div>
    <table class="data-table">
      <thead><tr><th>Алгоритм</th><th>Как работает</th><th>Где встречается</th></tr></thead>
      <tbody>
        <tr><td><strong>Token bucket</strong></td><td>В ведро капают токены с постоянной скоростью, запрос забирает токен. Накопленные токены дают всплеск</td><td>API-шлюзы, Laravel <code>RateLimiter</code></td></tr>
        <tr><td><strong>Leaky bucket</strong></td><td>Запросы наливаются в ведро, вытекают с постоянной скоростью. Переполнилось — отказ</td><td><strong>Nginx <code>limit_req</code></strong></td></tr>
        <tr><td><strong>Fixed window</strong></td><td>Счётчик на фиксированное окно: 100 запросов в минуту, на границе обнуляется</td><td>Простые реализации на Redis</td></tr>
        <tr><td><strong>Sliding window</strong></td><td>Скользящее окно — учитывает хвост предыдущего периода, считает плавнее</td><td>Cloudflare, зрелые API</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong>Слабое место fixed window.</strong> На стыке двух окон клиент может отправить двойную норму: 100 запросов в последнюю секунду первой минуты и ещё 100 в первую секунду второй. Sliding window это сглаживает — потому его и выбирают там, где лимит обещан клиенту как SLA.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="eye-off"></i> Скрытие версии и IP-фильтрация</div>
<pre><code><span class="c-comment"># В http-блоке: убрать версию Nginx из заголовка Server и страниц ошибок</span>
<span class="c-dir">server_tokens</span> <span class="c-key">off</span>;

<span class="c-comment"># Доступ по IP — порядок директив важен</span>
<span class="c-key">location</span> /admin/ {
    <span class="c-dir">allow</span> <span class="c-num">203.0.113.0/24</span>;
    <span class="c-dir">allow</span> <span class="c-num">10.0.0.5</span>;
    <span class="c-dir">deny</span>  all;                 <span class="c-comment"># всё остальное — 403</span>
}

<span class="c-comment"># Закрыть служебные файлы</span>
<span class="c-key">location</span> ~ /\.(?!well-known) {
    <span class="c-dir">deny</span> all;
}</code></pre>
    <div class="why-box"><strong>Что даёт <code>server_tokens off</code>.</strong> Заголовок меняется с <code>Server: nginx/1.24.0</code> на просто <code>Server: nginx</code>. Полностью убрать имя без стороннего модуля нельзя. Это не защита сама по себе — атакующий всё равно определит версию по поведению — но лишает автоматические сканеры простого способа подобрать эксплойт под конкретную версию.</div>
    <div class="pitfall"><strong>Исключение для <code>.well-known</code> обязательно.</strong> Правило <code>location ~ /\.</code> закрывает всё, что начинается с точки — включая <code>/.well-known/acme-challenge/</code>. Продление сертификата Let's Encrypt после этого молча сломается, и узнаешь об этом через 90 дней.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield"></i> HTTP security headers</div>
<pre><code><span class="c-dir">add_header</span> Strict-Transport-Security <span class="c-str">"max-age=31536000; includeSubDomains"</span> always;
<span class="c-dir">add_header</span> X-Content-Type-Options    <span class="c-str">"nosniff"</span> always;
<span class="c-dir">add_header</span> X-Frame-Options           <span class="c-str">"SAMEORIGIN"</span> always;
<span class="c-dir">add_header</span> Referrer-Policy           <span class="c-str">"strict-origin-when-cross-origin"</span> always;
<span class="c-dir">add_header</span> Content-Security-Policy    <span class="c-str">"default-src 'self'"</span> always;</code></pre>
    <table class="data-table">
      <thead><tr><th>Заголовок</th><th>От чего защищает</th></tr></thead>
      <tbody>
        <tr><td><code>Strict-Transport-Security</code></td><td>Downgrade на HTTP и перехват на первом запросе</td></tr>
        <tr><td><code>X-Content-Type-Options: nosniff</code></td><td>Браузер не угадывает тип файла — загруженная «картинка» не исполнится как скрипт</td></tr>
        <tr><td><code>X-Frame-Options</code></td><td>Clickjacking: сайт нельзя встроить в чужой iframe</td></tr>
        <tr><td><code>Referrer-Policy</code></td><td>Утечка путей и query-параметров в <code>Referer</code> при переходе наружу</td></tr>
        <tr><td><code>Content-Security-Policy</code></td><td>XSS: ограничивает, откуда грузятся скрипты, стили и прочее</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong><code>add_header</code> не наследуется в <code>location</code>.</strong> Если внутри <code>location</code> есть хоть один свой <code>add_header</code>, все заголовки из <code>server</code> в этом location пропадают. Поэтому и пишут <code>always</code>, и дублируют набор там, где он нужен.</div>
    <div class="pitfall"><strong>CSP ломает сайт при неаккуратном включении.</strong> <code>default-src 'self'</code> отрубит все внешние CDN, инлайновые скрипты и стили. Включать через <code>Content-Security-Policy-Report-Only</code>, посмотреть отчёты, и только потом переводить в боевой режим.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hourglass"></i> Slowloris и медленные запросы</div>
    <p class="text"><strong>Slowloris</strong> — атака медленными запросами. Атакующий открывает много соединений и шлёт заголовки по байту, не завершая запрос. Соединения висят, воркеры заняты, новые клиенты не обслуживаются. Трафика почти нет — обычные анти-DDoS срабатывают плохо.</p>
<pre><code><span class="c-dir">client_header_timeout</span> <span class="c-num">10s</span>;   <span class="c-comment"># сколько ждём заголовки целиком</span>
<span class="c-dir">client_body_timeout</span>   <span class="c-num">10s</span>;   <span class="c-comment"># сколько ждём тело запроса</span>
<span class="c-dir">send_timeout</span>          <span class="c-num">10s</span>;   <span class="c-comment"># пауза между записями при ответе</span>
<span class="c-dir">keepalive_timeout</span>     <span class="c-num">15s</span>;   <span class="c-comment"># дефолт 75s — слишком щедро</span>

<span class="c-dir">client_max_body_size</span>  <span class="c-num">20m</span>;   <span class="c-comment"># заодно от залива огромных файлов</span>

<span class="c-dir">limit_conn_zone</span> <span class="c-var">$binary_remote_addr</span> zone=slow:<span class="c-num">10m</span>;
<span class="c-dir">limit_conn</span> slow <span class="c-num">20</span>;</code></pre>
    <div class="remember-box"><strong>Почему Nginx и так неплохо держит Slowloris.</strong> Он асинхронный: одно соединение не занимает процесс, как у Apache с prefork. Тысячи висящих соединений для Nginx не смертельны. Но лимиты всё равно ставят — чтобы не упереться в <code>worker_connections</code> и не пропустить атаку дальше, к бэкенду.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers-3"></i> Nginx не заменяет безопасность приложения</div>
    <p class="text">Самое частое заблуждение: «настроили rate limit и headers — безопасность закрыта». Nginx и приложение защищают <strong>разные вещи</strong> и работают вместе, а не вместо друг друга.</p>

    <div class="diagram">Интернет
  │
  ▼
[Nginx]        ← ВНЕШНИЙ ПЕРИМЕТР
  │              rate limit, IP-фильтр, TLS,
  │              security headers, WAF, slowloris
  ▼
[Приложение]   ← ВНУТРЕННЯЯ ЛОГИКА
  │              аутентификация, авторизация, валидация,
  │              CSRF, SQL-инъекции, бизнес-правила
  ▼
[БД]</div>

    <table class="data-table">
      <thead><tr><th>Nginx — периметр</th><th>Приложение — логика</th></tr></thead>
      <tbody>
        <tr><td>Отсекает флуд, брутфорс, DDoS</td><td>Аутентификация: кто ты</td></tr>
        <tr><td>Блокирует по IP и гео</td><td>Авторизация: что тебе можно</td></tr>
        <tr><td>Терминирует TLS</td><td>Валидация входных данных</td></tr>
        <tr><td>Добавляет security headers</td><td>Защита от SQL-инъекций, XSS, CSRF</td></tr>
        <tr><td>Прячет версии и внутреннюю структуру</td><td>Бизнес-правила</td></tr>
        <tr><td>Защищает от slowloris</td><td>Сессии, роли, права</td></tr>
        <tr><td>Режет явно мусорные запросы (WAF, ModSecurity)</td><td></td></tr>
      </tbody>
    </table>

    <div class="pitfall"><strong>Почему нельзя только Nginx.</strong> Он не знает, что пользователь №5 не должен читать документ пользователя №7 — для него это обычный валидный GET. Он не отличит легитимный запрос от хитро сформированного, если тот выглядит нормально. И он не проверит ни одного бизнес-правила.</div>

    <div class="pitfall"><strong>Почему нельзя только приложение.</strong> Без лимита на периметре один клиент положит бэкенд раньше, чем приложение успеет что-то проверить. Slowloris выест воркеры. TLS на каждом бэкенде превращает управление сертификатами в головную боль. DDoS-флуд дойдёт до приложения и сожрёт ресурсы на разборе запросов, которые надо было отбросить ещё на входе.</div>

    <div class="analogy"><strong>Аналогия.</strong> Nginx — охрана на входе в здание: проверяет пропуск, не пускает толпу, смотрит металлодетектором. Приложение — сотрудник внутри, который решает, есть ли у тебя доступ к конкретному кабинету и к конкретным документам. Охрана не заменяет сотрудника, сотрудник не заменяет охрану.</div>

    <div class="remember-box"><strong>Это и называется defense in depth</strong> — эшелонированная оборона. Безопасность не одна стена, а набор слоёв, каждый из которых ловит то, что пропустил предыдущий. Nginx — только один из них.</div>
  </div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-check"></i> Минимальный набор для прода</div>
<pre><code><span class="c-key">http</span> {
    <span class="c-dir">server_tokens</span> <span class="c-key">off</span>;

    <span class="c-dir">client_header_timeout</span> <span class="c-num">10s</span>;
    <span class="c-dir">client_body_timeout</span>   <span class="c-num">10s</span>;
    <span class="c-dir">keepalive_timeout</span>     <span class="c-num">15s</span>;
    <span class="c-dir">client_max_body_size</span>  <span class="c-num">20m</span>;

    <span class="c-dir">limit_req_zone</span>  <span class="c-var">$binary_remote_addr</span> zone=general:<span class="c-num">10m</span> rate=<span class="c-num">30r/s</span>;
    <span class="c-dir">limit_req_zone</span>  <span class="c-var">$binary_remote_addr</span> zone=login:<span class="c-num">10m</span>   rate=<span class="c-num">5r/m</span>;
    <span class="c-dir">limit_conn_zone</span> <span class="c-var">$binary_remote_addr</span> zone=addr:<span class="c-num">10m</span>;

    <span class="c-dir">limit_req_status</span>  <span class="c-num">429</span>;
    <span class="c-dir">limit_conn_status</span> <span class="c-num">429</span>;

    <span class="c-key">server</span> {
        <span class="c-dir">limit_req</span>  zone=general burst=<span class="c-num">50</span> nodelay;
        <span class="c-dir">limit_conn</span> addr <span class="c-num">20</span>;

        <span class="c-comment"># Логин — отдельный жёсткий лимит против брутфорса</span>
        <span class="c-key">location</span> = /login {
            <span class="c-dir">limit_req</span> zone=login burst=<span class="c-num">3</span> nodelay;
            <span class="c-dir">try_files</span> <span class="c-var">$uri</span> /index.php?<span class="c-var">$query_string</span>;
        }
    }
}</code></pre>
    <div class="remember-box"><strong>Проверять лимиты до прода.</strong> <code>ab -n 200 -c 20 https://example.com/api/</code> или <code>siege</code> — и смотри, сколько ответов пришло с кодом 429. Настроенный «на глаз» лимит одинаково часто оказывается и бесполезным, и рубящим живых пользователей.</div>
  </div>
</div>

<div id="sec-nginx-cache" class="section">
  <div class="section-title">Кеширование</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Кэш бывает на нескольких уровнях сразу</div>
    <p class="text">Уровни кэша не заменяют друг друга, а дополняют. Запрос может быть обслужен на любом из них — чем раньше, тем дешевле.</p>

    <div class="diagram">Клиент          →  Nginx           →  Бэкенд          →  Redis      →  БД
(браузер)          (proxy_cache /     (PHP / Node /      Memcached     (кэш
Cache-Control       fastcgi_cache)     Java)             APCu           запросов
ETag                                                                    внутри СУБД)

│                  │                  │                  │
└ не идёт          └ не трогает       └ не идёт          └ не идёт
  на сервер          бэкенд             в БД               на диск
  вообще</div>

    <table class="data-table">
      <thead><tr><th>Уровень</th><th>Что кэширует</th></tr></thead>
      <tbody>
        <tr><td><strong>Браузерный</strong> — <code>Cache-Control</code>, <code>ETag</code></td><td>Готовый ответ. Клиент вообще не идёт на сервер</td></tr>
        <tr><td><strong>Nginx</strong> — <code>proxy_cache</code>, <code>fastcgi_cache</code></td><td>Готовый HTTP-ответ бэкенда на диске. Отдаётся без обращения к PHP или Node — самый быстрый уровень после браузера</td></tr>
        <tr><td><strong>Приложение</strong> — Redis, Memcached, APCu</td><td>Уже не HTTP-ответ, а <em>данные</em>: результат запроса к БД, сериализованный объект</td></tr>
        <tr><td><strong>СУБД</strong></td><td>Внутренний кэш запросов и страниц данных</td></tr>
      </tbody>
    </table>

    <div class="remember-box"><strong>По умолчанию Nginx не кэширует ничего.</strong> Без явной настройки он просто проксирует запросы дальше. Кэширование включается только директивами <code>proxy_cache</code> или <code>fastcgi_cache</code> — само оно не появится.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> proxy_cache — кэш ответов бэкенда</div>
<pre><code><span class="c-comment"># В http-блоке: где хранить и сколько памяти под ключи</span>
<span class="c-dir">proxy_cache_path</span> /var/cache/nginx levels=<span class="c-num">1:2</span> keys_zone=my_cache:<span class="c-num">10m</span>
                 max_size=<span class="c-num">1g</span> inactive=<span class="c-num">60m</span> use_temp_path=<span class="c-key">off</span>;

<span class="c-key">server</span> {
    <span class="c-key">location</span> / {
        <span class="c-dir">proxy_cache</span> my_cache;
        <span class="c-dir">proxy_cache_valid</span> <span class="c-num">200</span> <span class="c-num">301</span> <span class="c-num">10m</span>;      <span class="c-comment"># успешные — 10 минут</span>
        <span class="c-dir">proxy_cache_valid</span> <span class="c-num">404</span> <span class="c-num">1m</span>;               <span class="c-comment"># ошибки — минуту</span>

        <span class="c-comment"># Не отдавать кэш авторизованным</span>
        <span class="c-dir">proxy_cache_bypass</span> <span class="c-var">$cookie_session</span>;
        <span class="c-dir">proxy_no_cache</span>     <span class="c-var">$cookie_session</span>;

        <span class="c-comment"># Удобно видеть в ответе HIT / MISS / BYPASS</span>
        <span class="c-dir">add_header</span> X-Cache-Status <span class="c-var">$upstream_cache_status</span>;

        <span class="c-dir">proxy_pass</span> <span class="c-str">http://backend</span>;
    }
}</code></pre>
    <table class="data-table">
      <thead><tr><th>Параметр</th><th>Что делает</th></tr></thead>
      <tbody>
        <tr><td><code>levels=1:2</code></td><td>Двухуровневая раскладка по подпапкам — тысячи файлов в одной директории тормозят ФС</td></tr>
        <tr><td><code>keys_zone=my_cache:10m</code></td><td>Имя зоны и память под ключи: 10 МБ ≈ 80 тысяч записей</td></tr>
        <tr><td><code>max_size=1g</code></td><td>Потолок кэша на диске, дальше вытесняется по LRU</td></tr>
        <tr><td><code>inactive=60m</code></td><td>Не запрашивали час — удаляется, даже если срок валидности не истёк</td></tr>
        <tr><td><code>proxy_cache_bypass</code></td><td>Не <em>читать</em> из кэша при истинном значении</td></tr>
        <tr><td><code>proxy_no_cache</code></td><td>Не <em>записывать</em> в кэш. Нужны обе — по отдельности толку мало</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong><code>proxy_cache_bypass</code> без <code>proxy_no_cache</code> — утечка чужих данных.</strong> Первая директива запрещает только чтение. Ответ авторизованного пользователя всё равно запишется в кэш и уедет следующему анониму с тем же URL. Ставить всегда вместе.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="key"></i> Ключ кэша и fastcgi_cache</div>
    <p class="text">Ключ по умолчанию — <code>$scheme$proxy_host$request_uri</code>. Всё, чего в ключе нет, кэш считает одинаковым.</p>
<pre><code><span class="c-comment"># Для PHP-FPM напрямую, без промежуточного HTTP-бэкенда</span>
<span class="c-dir">fastcgi_cache_path</span> /var/cache/nginx/fcgi levels=<span class="c-num">1:2</span> keys_zone=php:<span class="c-num">10m</span> inactive=<span class="c-num">60m</span>;
<span class="c-dir">fastcgi_cache_key</span> <span class="c-str">"</span><span class="c-var">$scheme</span><span class="c-var">$request_method</span><span class="c-var">$host</span><span class="c-var">$request_uri</span><span class="c-str">"</span>;

<span class="c-key">location</span> ~ \.php$ {
    <span class="c-dir">fastcgi_cache</span> php;
    <span class="c-dir">fastcgi_cache_valid</span> <span class="c-num">200</span> <span class="c-num">1m</span>;        <span class="c-comment"># микрокеширование</span>
    <span class="c-dir">fastcgi_cache_bypass</span> <span class="c-var">$cookie_laravel_session</span>;
    <span class="c-dir">fastcgi_no_cache</span>     <span class="c-var">$cookie_laravel_session</span>;
    <span class="c-dir">include</span> fastcgi_params;
    <span class="c-dir">fastcgi_pass</span> <span class="c-str">unix:/run/php/php8.3-fpm.sock</span>;
}</code></pre>
    <div class="why-box"><strong>Микрокеширование.</strong> Даже 1 секунда кэша на горячей странице срезает нагрузку на порядки: при 1000 запросов в секунду до PHP дойдёт один. Пользователь разницы не заметит — данные устарели максимум на секунду. Это самый дешёвый способ пережить всплеск трафика.</div>
    <div class="pitfall"><strong>Забыть <code>$request_method</code> в ключе.</strong> Тогда ответ на <code>GET</code> и <code>POST</code> по одному URL попадёт в одну ячейку. По умолчанию Nginx кэширует только <code>GET</code> и <code>HEAD</code>, но стоит добавить <code>proxy_cache_methods</code> — и такой ключ выстрелит.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="split"></i> Что кэшировать в Nginx, а что в приложении</div>
    <table class="data-table">
      <thead><tr><th>Что кэшируем</th><th>Где лучше</th></tr></thead>
      <tbody>
        <tr><td>Статика, картинки, публичные страницы</td><td>Nginx <code>proxy_cache</code></td></tr>
        <tr><td>Персонализированные страницы</td><td>В Nginx не кэшировать вообще — только в приложении</td></tr>
        <tr><td>Результаты тяжёлых SQL-запросов</td><td>Redis или Memcached</td></tr>
        <tr><td>API-ответы, одинаковые для всех</td><td>Nginx <code>proxy_cache</code></td></tr>
        <tr><td>API-ответы, зависящие от пользователя</td><td>Redis с ключом по <code>user_id</code></td></tr>
      </tbody>
    </table>
    <div class="remember-box"><strong>Граница простая.</strong> Nginx кэширует <em>HTTP-ответ целиком</em> — значит он должен быть одинаков для всех, кто попадёт в этот ключ. Как только ответ зависит от пользователя, уровень Nginx заканчивается и начинается кэш данных в приложении.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="trash-2"></i> Инвалидация</div>
    <p class="text">Бесплатного способа «сбросить один URL» в открытом Nginx нет — директива <code>proxy_cache_purge</code> есть только в коммерческом Nginx Plus. В open source три варианта:</p>
    <table class="data-table">
      <thead><tr><th>Способ</th><th>Как</th></tr></thead>
      <tbody>
        <tr><td><strong>Короткий TTL</strong></td><td>Не инвалидировать вовсе: <code>proxy_cache_valid 200 30s</code>. Самый надёжный подход</td></tr>
        <tr><td><strong>Удалить файл</strong></td><td>Путь считается как <code>md5</code> от ключа. Найти и удалить вручную или скриптом</td></tr>
        <tr><td><strong>Модуль <code>ngx_cache_purge</code></strong></td><td>Сторонний модуль, даёт <code>PURGE</code>-запросы. Требует пересборки Nginx</td></tr>
        <tr><td><strong>Снести всё</strong></td><td><code>rm -rf /var/cache/nginx/*</code> и <code>nginx -s reload</code>. Грубо, но работает</td></tr>
      </tbody>
    </table>
    <div class="remember-box"><strong>Отладка.</strong> Заголовок <code>X-Cache-Status</code> показывает, что произошло: <code>MISS</code> — не было в кэше, <code>HIT</code> — отдано из кэша, <code>BYPASS</code> — запрещено читать, <code>EXPIRED</code> — протухло и обновлено, <code>STALE</code> — отдали устаревшее, пока бэкенд лежал.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="help-circle"></i> Nginx вместо Varnish?</div>
    <p class="text">На небольших и средних проектах <code>proxy_cache</code> часто закрывает задачу полностью. Varnish мощнее и гибче — VCL, ESI, продвинутая инвалидация, — но Nginx проще по одной причине: он <strong>уже стоит</strong> как reverse proxy, и кэш включается парой директив вместо отдельного сервиса в стеке.</p>
    <div class="remember-box">Правило: начинай с <code>proxy_cache</code>. Переходи на Varnish, когда упрёшься в то, чего Nginx не умеет — сложная логика кэширования на VCL или сборка страницы из кусков через ESI.</div>
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
