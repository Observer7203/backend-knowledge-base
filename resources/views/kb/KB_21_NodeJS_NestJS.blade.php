@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Node.js &amp; NestJS</title>
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
<link rel="stylesheet" href="/css/kb.css">
<script>(function(){try{var t=localStorage.getItem('kb-theme')||(window.matchMedia&&matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light');document.documentElement.setAttribute('data-theme',t);}catch(e){}})();</script>
<script src="/js/kb.js" defer></script>
</head>
<body>
<div class="container">
<div class="sidebar">
  <a href="/" class="sidebar-back"><i data-lucide="arrow-left"></i> На главную</a>
  <div class="sidebar-title">Node.js &amp; NestJS</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">Знакомство</div>
  <a class="nav-item" onclick="showSection('node-what',this)"><i data-lucide="help-circle"></i> Что такое Node.js</a>
  <a class="nav-item" onclick="showSection('node-install',this)"><i data-lucide="download"></i> Установка и версии</a>
  <a class="nav-item" onclick="showSection('node-inside',this)"><i data-lucide="layers"></i> Из чего состоит</a>
  <a class="nav-item" onclick="showSection('node-vs-php',this)"><i data-lucide="git-compare"></i> Модель процесса: vs PHP</a>
  <a class="nav-item" onclick="showSection('node-start',this)"><i data-lucide="play"></i> Первая программа и модули</a>
  <a class="nav-item" onclick="showSection('node-npm',this)"><i data-lucide="file-json"></i> package.json и npm</a>

  <div class="nav-group-label">Node.js — ядро</div>
  <a class="nav-item" onclick="showSection('io',this)"><i data-lucide="arrow-left-right"></i> I/O и libuv</a>
  <a class="nav-item" onclick="showSection('event-loop',this)"><i data-lucide="repeat"></i> Event loop и фазы</a>
  <a class="nav-item" onclick="showSection('threadpool',this)"><i data-lucide="cpu"></i> Thread pool и блокировка</a>
  <a class="nav-item" onclick="showSection('async-errors',this)"><i data-lucide="alert-triangle"></i> Ошибки в async-коде</a>
  <a class="nav-item" onclick="showSection('promises',this)"><i data-lucide="git-merge"></i> Комбинаторы промисов</a>
  <a class="nav-item" onclick="showSection('streams',this)"><i data-lucide="waves"></i> Streams и backpressure</a>
  <a class="nav-item" onclick="showSection('memory',this)"><i data-lucide="activity"></i> Утечки памяти</a>
  <a class="nav-item" onclick="showSection('modules',this)"><i data-lucide="package"></i> CommonJS и ESM</a>
  <a class="nav-item" onclick="showSection('shutdown',this)"><i data-lucide="power"></i> Graceful shutdown</a>

  <a class="nav-item" onclick="showSection('realtime',this)"><i data-lucide="radio"></i> Реальное время: WS, SSE, polling</a>

  <div class="nav-group-label">NestJS</div>
  <a class="nav-item" onclick="showSection('nest-arch',this)"><i data-lucide="boxes"></i> Строительные блоки</a>
  <a class="nav-item" onclick="showSection('nest-lifecycle',this)"><i data-lucide="list-ordered"></i> Жизненный цикл запроса</a>
  <a class="nav-item" onclick="showSection('nest-di',this)"><i data-lucide="box"></i> DI и scope</a>
  <a class="nav-item" onclick="showSection('nest-validation',this)"><i data-lucide="check-circle"></i> DTO, валидация, guards</a>
  <a class="nav-item" onclick="showSection('nest-orm',this)"><i data-lucide="database"></i> ORM и транзакции</a>
  <a class="nav-item" onclick="showSection('nest-queues',this)"><i data-lucide="list-checks"></i> Очереди</a>
  <a class="nav-item" onclick="showSection('nest-testing',this)"><i data-lucide="flask-conical"></i> Тестирование</a>

  <div class="nav-group-label">Конкурентность</div>
  <a class="nav-item" onclick="showSection('pg-concurrency',this)"><i data-lucide="lock"></i> PostgreSQL: изоляция и блокировки</a>
  <a class="nav-item" onclick="showSection('patterns',this)"><i data-lucide="shield-check"></i> Паттерны надёжности</a>

  <div class="nav-group-label">Применение</div>
  <a class="nav-item" onclick="showSection('pitfalls',this)"><i data-lucide="alert-octagon"></i> Подводные камни</a>
</div>

<div class="main">
<div class="page-header">
  <h1>Node.js &amp; NestJS</h1>
  <p>Устройство рантайма и архитектура NestJS. Event loop, асинхронность, потоки, DI и жизненный цикл запроса, транзакции и очереди, паттерны надёжной обработки платежей. Для разработчика, который приходит из PHP/Laravel — с параллелями между фреймворками.</p>
  <div class="badge-row">
    <span class="badge">Node.js</span>
    <span class="badge">NestJS</span>
    <span class="badge">TypeScript</span>
    <span class="badge badge-success">Backend</span>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>
  <div class="subsection">
    <p class="text">Node.js и NestJS разбираются вместе: сначала рантайм, потом фреймворк поверх него. Большая часть ошибок в Node растёт из непонимания event loop, поэтому он идёт первым.</p>
    <div class="remember-box"><strong>Главная параллель для тех, кто пришёл из Laravel.</strong> NestJS устроен очень похоже: модули вместо сервис-провайдеров, DI-контейнер, DTO вместо FormRequest, guards вместо middleware авторизации. Разница в рантайме: PHP-процесс умирает после запроса, Node-процесс живёт и держит состояние — отсюда и утечки памяти, и необходимость graceful shutdown.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-node-what" class="section">
  <div class="section-title">Что такое Node.js</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="help-circle"></i> Не язык и не фреймворк</div>
    <p class="text"><strong>Node.js — это среда выполнения (runtime) для JavaScript вне браузера.</strong> Язык остался тот же самый — JavaScript. Изменилось окружение: вместо DOM, <code>window</code> и запросов к серверу появились файловая система, сеть, процессы и всё, что нужно серверной программе.</p>
    <table class="data-table">
      <thead><tr><th>Что это</th><th>Пример</th><th>Node.js</th></tr></thead>
      <tbody>
        <tr><td>Язык</td><td>JavaScript, PHP, Python</td><td>Нет — язык здесь JavaScript</td></tr>
        <tr><td><strong>Среда выполнения</strong></td><td>PHP-FPM, JVM, CPython</td><td><strong>Да, это она</strong></td></tr>
        <tr><td>Фреймворк</td><td>Laravel, NestJS, Express</td><td>Нет — они пишутся <em>поверх</em> Node</td></tr>
      </tbody>
    </table>
    <div class="analogy"><strong>Аналогия с PHP.</strong> Node.js занимает то же место, что PHP-FPM: он берёт твой код и исполняет его на сервере. NestJS в этой картине — Laravel, а Express — ближе к Slim. Сравнивать «PHP и Node» некорректно: сравнивать нужно либо языки (PHP и JavaScript), либо рантаймы (PHP-FPM и Node.js).</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> Для чего подходит и для чего нет</div>
    <table class="data-table">
      <thead><tr><th>Сильная сторона</th><th>Слабая сторона</th></tr></thead>
      <tbody>
        <tr><td>Много одновременных соединений при лёгкой обработке: API, чаты, стриминг, прокси</td><td>Тяжёлые вычисления: обработка изображений, криптография в цикле, разбор гигабайтных файлов</td></tr>
        <tr><td>Реалтайм: WebSocket, long polling, SSE</td><td>Задачи, где нужен настоящий параллелизм на одном процессе</td></tr>
        <tr><td>Один язык на фронте и бэке, общие типы через TypeScript</td><td>Долгие синхронные операции — они блокируют всех</td></tr>
      </tbody>
    </table>
    <div class="why-box"><strong>Откуда растут и плюсы, и минусы.</strong> Из одной архитектурной идеи: один поток для кода плюс неблокирующий ввод-вывод. Пока программа ждёт БД или сеть, процесс занимается другими запросами — отсюда тысячи соединений на одном процессе. Но если программа <em>считает</em>, а не ждёт, этот же поток занят, и ждут уже все остальные.</div>
  </div>
</div>
@endverbatim
@verbatim
<div id="sec-node-install" class="section">
  <div class="section-title">Установка Node.js</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> JavaScript и Node.js — в чём разница</div>
    <table class="data-table">
      <thead><tr><th>Аспект</th><th>JavaScript — язык</th><th>Node.js — среда выполнения</th></tr></thead>
      <tbody>
        <tr><td><strong>Что это</strong></td><td>Язык программирования, стандарт ECMAScript</td><td>Платформа, исполняющая JS вне браузера</td></tr>
        <tr><td><strong>Где работает</strong></td><td>В браузере</td><td>На сервере или локально, отдельным процессом</td></tr>
        <tr><td><strong>Движок</strong></td><td>Движок конкретного браузера: V8, SpiderMonkey, JavaScriptCore</td><td>V8 из Chrome плюс libuv и системные библиотеки</td></tr>
        <tr><td><strong>Доступные API</strong></td><td>Браузерные: DOM, <code>window</code>, <code>localStorage</code>, <code>fetch</code></td><td>Серверные: <code>fs</code>, <code>http</code>, <code>net</code>, <code>stream</code>, <code>child_process</code></td></tr>
        <tr><td><strong>Глобальный объект</strong></td><td><code>window</code></td><td><code>global</code> (и <code>globalThis</code> в обоих)</td></tr>
        <tr><td><strong>Применение</strong></td><td>Интерактивные страницы, фронтенд</td><td>Бэкенд, API, CLI-инструменты, десктоп через Electron</td></tr>
      </tbody>
    </table>
    <div class="analogy"><strong>Аналогия.</strong> JavaScript — мотор, Node.js — шасси, на которое этот мотор ставят, чтобы он работал не только в браузере. Node даёт коду доступ к системным ресурсам, которых в браузере нет по соображениям безопасности.</div>
    <div class="remember-box"><strong>Node.js не версия и не замена JavaScript.</strong> Это инструмент, расширяющий сферу применения языка. Один и тот же <code>Array.map</code> работает и там, и там — различается только окружение вокруг.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="download"></i> Установка</div>
<pre><code><span class="c-comment"># macOS — через Homebrew, стандартный путь</span>
brew install node              <span class="c-comment"># последняя версия</span>
brew install node@22           <span class="c-comment"># конкретная major-версия</span>

<span class="c-comment"># Windows</span>
winget install OpenJS.NodeJS.LTS
<span class="c-comment"># либо .msi-установщик с nodejs.org</span>

<span class="c-comment"># Ubuntu/Debian — в репозитории обычно устаревшая версия,
# поэтому ставят из NodeSource</span>
curl -fsSL https://deb.nodesource.com/setup_22.x | sudo -E bash -
sudo apt-get install -y nodejs</code></pre>
<pre><code><span class="c-comment"># Проверка — npm ставится вместе с Node</span>
node --version
npm --version</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Менеджеры версий</div>
    <p class="text">На разных проектах нужны разные версии Node. Менеджер версий держит их рядом и переключает одной командой — примерно как <code>brew link</code> для PHP.</p>
<pre><code><span class="c-comment"># nvm — самый распространённый (macOS, Linux)</span>
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.1/install.sh | bash

nvm install --lts      <span class="c-comment"># поставить последнюю LTS</span>
nvm install 22         <span class="c-comment"># конкретную major</span>
nvm use 22             <span class="c-comment"># переключиться</span>
nvm ls                 <span class="c-comment"># что установлено</span>
nvm alias default 22   <span class="c-comment"># версия по умолчанию в новых сессиях</span></code></pre>
    <table class="data-table">
      <thead><tr><th>Менеджер</th><th>Особенность</th></tr></thead>
      <tbody>
        <tr><td><strong>nvm</strong></td><td>Стандарт де-факто. Shell-функция, поэтому <code>which nvm</code> ничего не покажет</td></tr>
        <tr><td><strong>fnm</strong></td><td>То же самое, но на Rust — заметно быстрее при старте оболочки</td></tr>
        <tr><td><strong>volta</strong></td><td>Прибивает версию к проекту: заходишь в папку — версия переключается сама</td></tr>
        <tr><td><strong>Homebrew</strong></td><td>Не менеджер версий. Держит одну версию, переключение через <code>brew unlink</code> / <code>brew link</code></td></tr>
      </tbody>
    </table>
    <div class="remember-box">Файл <code>.nvmrc</code> в корне проекта с номером версии плюс <code>nvm use</code> — способ зафиксировать версию для всей команды. Аналог <code>"engines"</code> в <code>package.json</code>, только исполняемый.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="calendar"></i> LTS против Current — что ставить</div>
    <table class="data-table">
      <thead><tr><th>Линия</th><th>Номер версии</th><th>Поддержка</th><th>Для чего</th></tr></thead>
      <tbody>
        <tr><td><strong>LTS</strong></td><td><strong>Чётный</strong>: 20, 22, 24</td><td>~30 месяцев</td><td>Прод и всё, что должно работать долго</td></tr>
        <tr><td><strong>Current</strong></td><td><strong>Нечётный</strong>: 21, 23, 25</td><td>~6 месяцев</td><td>Посмотреть новые возможности</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong>Нечётная версия в проде — мина замедленного действия.</strong> Поддержка кончается примерно через полгода, дальше нет даже патчей безопасности. Плюс часть пакетов просто не заявляет совместимость с Current-линией. Правило простое: <strong>чётный номер — ставим, нечётный — только поэкспериментировать.</strong></div>
    <div class="remember-box">Проверить, на чём работаешь сейчас: <code>node -v</code>. Зафиксировать требование в проекте: <code>"engines": { "node": "&gt;=22" }</code> в <code>package.json</code> — npm предупредит при несовпадении.</div>
  </div>
</div>
@endverbatim
@verbatim
<div id="sec-node-inside" class="section">
  <div class="section-title">Из чего состоит Node.js</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Четыре слоя</div>
    <div class="diagram">┌─────────────────────────────────────────────┐
│  Твой код + пакеты из npm                   │
├─────────────────────────────────────────────┤
│  Стандартная библиотека Node                │  fs, http, path, crypto,
│  (58 встроенных модулей)                    │  events, stream, os…
├─────────────────────────────────────────────┤
│  Bindings — мост из JavaScript в C++        │
├──────────────────────┬──────────────────────┤
│   V8                 │   libuv              │
│   исполняет JS       │   event loop,        │
│   (движок из Chrome) │   неблокирующий I/O, │
│                      │   пул потоков        │
├──────────────────────┴──────────────────────┤
│  OpenSSL · zlib · c-ares · llhttp · undici  │  шифрование, сжатие,
│                                             │  DNS, HTTP-парсер, fetch
└─────────────────────────────────────────────┘</div>
    <table class="data-table">
      <thead><tr><th>Компонент</th><th>За что отвечает</th></tr></thead>
      <tbody>
        <tr><td><strong>V8</strong></td><td>Движок JavaScript от Google, тот же, что в Chrome. Компилирует JS в машинный код и исполняет его</td></tr>
        <tr><td><strong>libuv</strong></td><td>Сердце асинхронности: event loop, неблокирующая работа с сетью и файлами, пул потоков. Написан на C</td></tr>
        <tr><td><strong>Bindings</strong></td><td>Прослойка, через которую JS вызывает C++-функции — например, <code>fs.readFile</code></td></tr>
        <tr><td><strong>OpenSSL</strong></td><td>Криптография и TLS: модуль <code>crypto</code>, HTTPS</td></tr>
        <tr><td><strong>llhttp</strong></td><td>Парсер HTTP-протокола</td></tr>
        <tr><td><strong>undici</strong></td><td>HTTP-клиент, на котором работает встроенный <code>fetch</code></td></tr>
        <tr><td><strong>zlib, c-ares, zstd</strong></td><td>Сжатие и DNS-резолвинг</td></tr>
      </tbody>
    </table>
<pre><code><span class="c-comment"># Посмотреть, что внутри именно твоей сборки</span>
node -p <span class="c-str">"process.versions"</span>

<span class="c-comment"># Пример вывода (Node 25):
# node: '25.2.1', v8: '14.1.146', uv: '1.51.0',
# openssl: '3.6.2', undici: '7.16.0', zlib: '1.2.12', ...</span></code></pre>
    <div class="remember-box"><strong>Ключевая мысль.</strong> V8 умеет только исполнять JavaScript — он ничего не знает ни о файлах, ни о сокетах. Всё, что делает Node серверной платформой, даёт <strong>libuv</strong> и остальные C-библиотеки. Поэтому event loop — это не часть языка, а часть рантайма.</div>
  </div>
</div>
@endverbatim
@verbatim
<div id="sec-node-vs-php" class="section">
  <div class="section-title">Модель процесса: Node против PHP</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Главное отличие, из которого следует всё остальное</div>
    <div class="diagram">PHP-FPM                              Node.js

запрос → форкнутый процесс          запрос ─┐
         ↓                           запрос ─┼→ ОДИН процесс
      выполнение                     запрос ─┤   живёт неделями
         ↓                           запрос ─┘
      ответ → процесс очищен                 ↓
      переменные умерли                   ответ
                                   переменные остались</div>
    <table class="data-table">
      <thead><tr><th></th><th>PHP-FPM</th><th>Node.js</th></tr></thead>
      <tbody>
        <tr><td><strong>Жизнь процесса</strong></td><td>Один запрос</td><td>Недели, пока не перезапустят</td></tr>
        <tr><td><strong>Глобальные переменные</strong></td><td>Умирают с запросом</td><td>Живут и видны <strong>всем</strong> запросам</td></tr>
        <tr><td><strong>Параллельность</strong></td><td>Несколько процессов-воркеров</td><td>Один поток + неблокирующий I/O</td></tr>
        <tr><td><strong>Соединение с БД</strong></td><td>Обычно одно на запрос</td><td>Пул, общий на весь процесс</td></tr>
        <tr><td><strong>Утечка памяти</strong></td><td>Почти незаметна — процесс умрёт</td><td>Копится и роняет сервис</td></tr>
        <tr><td><strong>Тяжёлый цикл</strong></td><td>Тормозит только свой запрос</td><td>Тормозит <strong>все</strong> соединения</td></tr>
        <tr><td><strong>Остановка</strong></td><td>Можно убивать в любой момент</td><td>Нужен graceful shutdown</td></tr>
      </tbody>
    </table>
    <div class="info-box danger"><strong>Это сдвиг мышления номер один при переходе с PHP.</strong> Привычка «переменная живёт один запрос» в Node становится источником трёх классов багов разом: утечки памяти, протекание данных одного пользователя к другому, недетерминированное поведение из-за накопленного состояния.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Как это выглядит в коде</div>
<pre><code><span class="c-comment">// ❌ В PHP безобидно, в Node — утечка и протекание данных</span>
<span class="c-key">let</span> currentUser;                  <span class="c-comment">// модульная переменная, одна на весь процесс</span>
<span class="c-key">const</span> cache = <span class="c-key">new</span> <span class="c-type">Map</span>();          <span class="c-comment">// растёт бесконечно</span>

<span class="c-key">export function</span> <span class="c-fn">handler</span>(req, res) {
  currentUser = req.user;          <span class="c-comment">// параллельный запрос перетрёт</span>
  cache.<span class="c-fn">set</span>(req.id, req.body);     <span class="c-comment">// никто никогда не чистит</span>
}

<span class="c-comment">// ✓ Состояние запроса живёт в самом запросе</span>
<span class="c-key">export function</span> <span class="c-fn">handler</span>(req, res) {
  <span class="c-key">const</span> user = req.user;           <span class="c-comment">// локально, умрёт с вызовом</span>
}</code></pre>
    <div class="remember-box">В NestJS за это отвечает DI: сервисы по умолчанию синглтоны на весь процесс, и класть в их поля данные запроса нельзя. Для данных запроса — аргументы методов, <code>AsyncLocalStorage</code> или scope <code>REQUEST</code>.</div>
  </div>
</div>
@endverbatim
@verbatim
<div id="sec-node-start" class="section">
  <div class="section-title">Первая программа и встроенные модули</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="play"></i> HTTP-сервер без единого пакета</div>
<pre><code><span class="c-comment">// server.js — всё из коробки, npm install не нужен</span>
<span class="c-key">import</span> { createServer } <span class="c-key">from</span> <span class="c-str">'node:http'</span>;

<span class="c-key">const</span> server = <span class="c-fn">createServer</span>((req, res) =&gt; {
  res.<span class="c-fn">writeHead</span>(<span class="c-num">200</span>, { <span class="c-str">'Content-Type'</span>: <span class="c-str">'application/json'</span> });
  res.<span class="c-fn">end</span>(<span class="c-type">JSON</span>.<span class="c-fn">stringify</span>({ ok: <span class="c-key">true</span>, url: req.url }));
});

server.<span class="c-fn">listen</span>(<span class="c-num">3000</span>, () =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'http://localhost:3000'</span>));</code></pre>
<pre><code>node server.js</code></pre>
    <div class="why-box"><strong>Разница с PHP видна сразу.</strong> В PHP веб-сервер — отдельная программа (Nginx, Apache), а код запускается по запросу. В Node <strong>сервер — это твоя программа</strong>: она сама слушает порт и живёт, пока её не остановят. Nginx перед ней обычно ставят, но уже как reverse proxy, а не как исполнителя кода.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package"></i> Стандартная библиотека</div>
    <p class="text">В Node <strong>58 встроенных модулей</strong>. Подключаются без установки, с префиксом <code>node:</code>.</p>
    <table class="data-table">
      <thead><tr><th>Модуль</th><th>Для чего</th></tr></thead>
      <tbody>
        <tr><td><code>node:http</code>, <code>node:https</code></td><td>HTTP-сервер и клиент</td></tr>
        <tr><td><code>node:fs</code>, <code>node:fs/promises</code></td><td>Файловая система</td></tr>
        <tr><td><code>node:path</code></td><td>Работа с путями, кроссплатформенно</td></tr>
        <tr><td><code>node:crypto</code></td><td>Хеши, HMAC, шифрование, UUID</td></tr>
        <tr><td><code>node:events</code></td><td><code>EventEmitter</code> — на нём построена половина Node</td></tr>
        <tr><td><code>node:stream</code></td><td>Потоки и <code>pipeline</code></td></tr>
        <tr><td><code>node:os</code>, <code>node:process</code></td><td>Система, переменные окружения, сигналы</td></tr>
        <tr><td><code>node:child_process</code></td><td>Запуск внешних команд</td></tr>
        <tr><td><code>node:worker_threads</code></td><td>Настоящие потоки для CPU-задач</td></tr>
        <tr><td><code>node:test</code></td><td>Встроенный тест-раннер</td></tr>
      </tbody>
    </table>
<pre><code><span class="c-comment">// Посмотреть полный список</span>
node -p <span class="c-str">"require('module').builtinModules.join('\n')"</span></code></pre>
    <div class="remember-box">Префикс <code>node:</code> не обязателен (<code>import 'fs'</code> тоже работает), но желателен: он явно говорит, что это встроенный модуль, а не пакет из <code>node_modules</code> с таким же именем.</div>
  </div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="folder-tree"></i> <code>node:path</code> — пути к файлам, а не маршруты</div>
    <div class="info-box warning"><strong>Источник путаницы.</strong> По-русски «путь» означает и файловый путь, и URL-маршрут. Это разные вещи, и <code>path</code> знает только о первом: о файлах и папках на диске. К маршрутизации HTTP он отношения не имеет.</div>
    <table class="data-table">
      <thead><tr><th>Что это</th><th>Пример</th><th>Чем работать</th></tr></thead>
      <tbody>
        <tr><td><strong>Файловый путь</strong></td><td><code>./data/users.json</code>, <code>C:\app\logs</code></td><td><code>node:path</code>, <code>node:fs</code></td></tr>
        <tr><td><strong>URL-маршрут</strong></td><td><code>/users/123</code>, <code>/api/orders?status=new</code></td><td>Express, Fastify, NestJS, <code>req.url</code></td></tr>
        <tr><td><strong>URL как объект</strong></td><td><code>https://site.com/a?b=1</code></td><td>Глобальный <code>URL</code>, <code>node:url</code></td></tr>
      </tbody>
    </table>
<pre><code><span class="c-comment">// Маршрут — это URL-шаблон, path тут ни при чём</span>
app.<span class="c-fn">get</span>(<span class="c-str">'/users/:id'</span>, (req, res) =&gt; {
  res.<span class="c-fn">json</span>({ id: req.params.id });   <span class="c-comment">// '123' из /users/123</span>
});

<span class="c-comment">// Разбор URL — третья вещь, тоже не path</span>
<span class="c-key">const</span> u = <span class="c-key">new</span> <span class="c-type">URL</span>(<span class="c-str">'https://site.com/users/123?tab=posts'</span>);
u.pathname;                   <span class="c-comment">// '/users/123' — URL-путь, не файловый</span>
u.searchParams.<span class="c-fn">get</span>(<span class="c-str">'tab'</span>);   <span class="c-comment">// 'posts'</span></code></pre>
    <div class="remember-box">URL-пути <strong>всегда</strong> через <code>/</code>, независимо от операционной системы. Поэтому собирать их через <code>path.join</code> — ошибка: на Windows получишь <code>\</code> внутри адреса.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="route"></i> Зачем нужен <code>path</code></div>
    <p class="text">Главная задача — <strong>кроссплатформенность</strong>. В Windows разделитель <code>\</code>, в Linux и macOS — <code>/</code>. Склеивание строк через <code>'/'</code> вручную ломается на Windows.</p>
<pre><code><span class="c-key">import</span> path <span class="c-key">from</span> <span class="c-str">'node:path'</span>;

path.<span class="c-fn">join</span>(<span class="c-str">'users'</span>, <span class="c-str">'data'</span>, <span class="c-str">'file.txt'</span>);
<span class="c-comment">// POSIX:   'users/data/file.txt'
// Windows: 'users\data\file.txt'</span>

path.<span class="c-fn">resolve</span>(<span class="c-str">'file.txt'</span>);       <span class="c-comment">// абсолютный путь от текущей папки</span>
path.<span class="c-fn">extname</span>(<span class="c-str">'index.html'</span>);      <span class="c-comment">// '.html'</span>
path.<span class="c-fn">basename</span>(<span class="c-str">'/foo/baz.txt'</span>);   <span class="c-comment">// 'baz.txt'</span>
path.<span class="c-fn">dirname</span>(<span class="c-str">'/foo/baz.txt'</span>);    <span class="c-comment">// '/foo'</span>
path.sep;                        <span class="c-comment">// '/' или '\' в зависимости от ОС</span>

path.<span class="c-fn">parse</span>(<span class="c-str">'/home/user/file.txt'</span>);
<span class="c-comment">// { root: '/', dir: '/home/user', base: 'file.txt',
//   ext: '.txt', name: 'file' }</span></code></pre>
    <div class="why-box"><strong><code>join</code> против <code>resolve</code>.</strong> <code>join</code> просто склеивает куски и нормализует разделители. <code>resolve</code> строит <em>абсолютный</em> путь, идя справа налево до первого абсолютного сегмента, и достраивает остальное от текущей рабочей директории. Для «файл рядом со скриптом» нужен <code>resolve</code> или <code>import.meta.dirname</code>, потому что рабочая директория зависит от того, откуда запустили процесс.</div>
    <div class="pitfall"><strong>Путь из пользовательского ввода — дыра обхода каталога.</strong> <code>path.join(uploadDir, req.query.name)</code> при <code>name=../../etc/passwd</code> выведет за пределы папки. Проверять надо после нормализации: собрать через <code>resolve</code> и убедиться, что результат начинается с разрешённой директории.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="library"></i> Что делает каждый встроенный модуль</div>
    <table class="data-table">
      <thead><tr><th>Модуль</th><th>Что даёт</th></tr></thead>
      <tbody>
        <tr><td><code>node:http</code> / <code>node:https</code></td><td>HTTP-сервер через <code>createServer</code> и клиент для запросов. На нём стоят Express, Fastify и почти весь веб в Node</td></tr>
        <tr><td><code>node:fs</code> / <code>node:fs/promises</code></td><td>Чтение и запись файлов и папок. Версия <code>/promises</code> — тот же API, но под <code>async/await</code></td></tr>
        <tr><td><code>node:path</code></td><td>Сборка и разбор файловых путей, кроссплатформенно</td></tr>
        <tr><td><code>node:url</code> + глобальный <code>URL</code></td><td>Разбор и сборка URL, работа с query-параметрами</td></tr>
        <tr><td><code>node:crypto</code></td><td>Хеши (<code>createHash</code>), HMAC, шифрование, <code>randomUUID</code>, случайные байты</td></tr>
        <tr><td><code>node:events</code></td><td><code>EventEmitter</code>. На событиях построены серверы, потоки и сокеты: <code>on</code> / <code>emit</code></td></tr>
        <tr><td><code>node:stream</code></td><td>Обработка данных по частям без загрузки в память. <code>pipeline()</code> связывает потоки и ловит ошибки</td></tr>
        <tr><td><code>node:os</code></td><td>Информация о системе: <code>cpus()</code>, <code>platform()</code>, объём памяти</td></tr>
        <tr><td><code>node:process</code></td><td>Текущий процесс: <code>env</code>, <code>argv</code>, <code>exit()</code>, обработка сигналов</td></tr>
        <tr><td><code>node:child_process</code></td><td>Запуск внешних программ: <code>exec</code>, <code>spawn</code> — например <code>git</code> или <code>ffmpeg</code></td></tr>
        <tr><td><code>node:worker_threads</code></td><td>Настоящие потоки ОС для CPU-задач, чтобы не блокировать event loop</td></tr>
        <tr><td><code>node:test</code></td><td>Встроенный тест-раннер (<code>node --test</code>) — лёгкая замена Jest без зависимостей</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="tag"></i> Префикс <code>node:</code> — зачем он на самом деле</div>
    <div class="pitfall"><strong>Частое объяснение неверно.</strong> Пишут, что префикс защищает от подмены встроенного модуля одноимённым пакетом из <code>node_modules</code>. Это не так: Node резолвит встроенные модули <strong>раньше</strong> <code>node_modules</code>. Пакет с именем <code>fs</code> встроенный <code>fs</code> не перекроет — проверяется за минуту:
<br><br>
<code>mkdir -p node_modules/fs &amp;&amp; echo 'module.exports={HACKED:1}' &gt; node_modules/fs/index.js</code><br>
<code>node -e "console.log(require('fs').HACKED ?? 'встроенный')"</code>  →  <code>встроенный</code></div>
    <table class="data-table">
      <thead><tr><th>Настоящая причина</th><th>Пояснение</th></tr></thead>
      <tbody>
        <tr><td><strong>Новые модули иначе не подключить</strong></td><td><code>require('test')</code> даёт <code>MODULE_NOT_FOUND</code>, работает только <code>require('node:test')</code>. Так же с <code>node:sqlite</code></td></tr>
        <tr><td><strong>Явность</strong></td><td>Сразу видно, что это часть Node, а не зависимость из <code>package.json</code></td></tr>
        <tr><td><strong>Скорость резолва</strong></td><td>Node не ищет по файловой системе — сразу берёт встроенный</td></tr>
      </tbody>
    </table>
    <div class="remember-box">Для старых модулей <code>import 'fs'</code> и <code>import 'node:fs'</code> равнозначны. Привычка писать префикс везде полезна тем, что код единообразен и не ломается на новых модулях.</div>
  </div>

</div>
@endverbatim
@verbatim
<div id="sec-node-npm" class="section">
  <div class="section-title">package.json и npm</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-json"></i> Манифест проекта</div>
<pre><code>{
  <span class="c-str">"name"</span>: <span class="c-str">"my-api"</span>,
  <span class="c-str">"type"</span>: <span class="c-str">"module"</span>,          <span class="c-comment">// ESM: import/export. Без этого — CommonJS</span>
  <span class="c-str">"engines"</span>: { <span class="c-str">"node"</span>: <span class="c-str">"&gt;=22"</span> },
  <span class="c-str">"scripts"</span>: {
    <span class="c-str">"dev"</span>:   <span class="c-str">"node --watch src/main.js"</span>,
    <span class="c-str">"start"</span>: <span class="c-str">"node src/main.js"</span>,
    <span class="c-str">"test"</span>:  <span class="c-str">"node --test"</span>
  },
  <span class="c-str">"dependencies"</span>:    { <span class="c-str">"@nestjs/core"</span>: <span class="c-str">"^11.0.0"</span> },
  <span class="c-str">"devDependencies"</span>: { <span class="c-str">"typescript"</span>: <span class="c-str">"^5.7.0"</span> }
}</code></pre>
    <table class="data-table">
      <thead><tr><th>Понятие</th><th>Аналог в PHP</th><th>Смысл</th></tr></thead>
      <tbody>
        <tr><td><code>package.json</code></td><td><code>composer.json</code></td><td>Манифест: зависимости, скрипты, метаданные</td></tr>
        <tr><td><code>package-lock.json</code></td><td><code>composer.lock</code></td><td>Точные версии всего дерева. <strong>В Git обязательно</strong></td></tr>
        <tr><td><code>node_modules/</code></td><td><code>vendor/</code></td><td>Сами пакеты. В Git <strong>не кладут</strong></td></tr>
        <tr><td><code>dependencies</code></td><td><code>require</code></td><td>Нужны в проде</td></tr>
        <tr><td><code>devDependencies</code></td><td><code>require-dev</code></td><td>Только для разработки: TypeScript, тесты, линтер</td></tr>
        <tr><td><code>npm ci</code></td><td><code>composer install</code></td><td>Строго по lock-файлу. Для CI и прода</td></tr>
        <tr><td><code>npm install</code></td><td><code>composer update</code> (частично)</td><td>Может обновить lock в рамках диапазонов</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong><code>npm install</code> на проде — та же ошибка, что <code>composer update</code>.</strong> Он может подтянуть версии, которых никто не тестировал, и переписать lock прямо на сервере. В CI и на проде только <code>npm ci</code>: он удаляет <code>node_modules</code> и ставит ровно то, что в lock-файле.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="terminal"></i> Команды на каждый день</div>
<pre><code>npm init -y                  <span class="c-comment"># создать package.json</span>
npm install express          <span class="c-comment"># поставить в dependencies</span>
npm install -D typescript    <span class="c-comment"># -D → devDependencies</span>
npm uninstall express        <span class="c-comment"># удалить</span>
npm ci                       <span class="c-comment"># установка по lock — прод и CI</span>
npm run dev                  <span class="c-comment"># запустить скрипт из "scripts"</span>
npm outdated                 <span class="c-comment"># что устарело</span>
npm audit                    <span class="c-comment"># известные уязвимости</span>
npx tsc --init               <span class="c-comment"># выполнить пакет без установки</span></code></pre>
    <div class="remember-box"><code>npx</code> — запуск бинарника пакета без глобальной установки. Именно так создают проекты: <code>npx @nestjs/cli new my-app</code>.</div>
  </div>
</div>
@endverbatim
@verbatim
<div id="sec-io" class="section">
  <div class="section-title">I/O: что это и почему вокруг него построен Node</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-left-right"></i> Что считается вводом-выводом</div>
    <p class="text">I/O (input/output) — любой обмен данными с внешним миром относительно процесса: чтение и запись файлов, сетевые запросы, сокеты, работа с базой, <code>stdin</code>/<code>stdout</code>, DNS-запросы. Общее у них одно: нужно <strong>ждать</strong> ответа от диска, сети или другого процесса, и это ожидание программа не контролирует.</p>
    <div class="remember-box"><strong>Ключевая мысль.</strong> I/O — это медленно, и его нельзя блокировать. Пока один запрос ждёт диск или сеть, Node обязан обслуживать остальные. Ровно этим занимается libuv.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="timer"></i> Почему ожидание — это проблема</div>
    <p class="text">Процессор работает на порядки быстрее внешних устройств. Отсюда и вся асинхронная модель:</p>
    <table class="data-table">
      <thead><tr><th>Операция</th><th>Примерное время</th><th>Во сколько раз медленнее инструкции CPU</th></tr></thead>
      <tbody>
        <tr><td>Выполнить инструкцию CPU</td><td>~0.3 нс</td><td>1×</td></tr>
        <tr><td>Прочитать из RAM</td><td>~100 нс</td><td>~300×</td></tr>
        <tr><td>Прочитать с SSD</td><td>~100 000 нс (0.1 мс)</td><td>~300 000×</td></tr>
        <tr><td>Сетевой запрос внутри дата-центра</td><td>~0.5–1 мс</td><td>~2 000 000×</td></tr>
        <tr><td>Запрос к БД</td><td>~1–50 мс</td><td>до ~150 000 000×</td></tr>
        <tr><td>Сеть через интернет</td><td>~50–500 мс</td><td>до ~1 500 000 000×</td></tr>
      </tbody>
    </table>
    <p class="text">Если программа «встаёт и ждёт» диск или сеть — процессор простаивает. Классический сервер на потоках решает это так: на каждый запрос отдельный поток, и потоки просто спят в ожидании I/O. При тысячах соединений это дорого и по памяти, и по переключениям контекста.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="split"></i> Блокирующий против неблокирующего</div>
    <p class="text">Одно и то же чтение файла двумя способами:</p>
<pre><code><span class="c-comment">// ❌ Блокирующий: поток Node замирает, пока файл читается</span>
<span class="c-key">const</span> fs = <span class="c-fn">require</span>(<span class="c-str">'node:fs'</span>);
<span class="c-key">const</span> data = fs.<span class="c-fn">readFileSync</span>(<span class="c-str">'big.txt'</span>, <span class="c-str">'utf8'</span>);
<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'прочитано'</span>, data.length);
<span class="c-comment">// следующие строки не выполнятся, пока чтение не закончится</span>

<span class="c-comment">// ✅ Неблокирующий: Node работает дальше, результат придёт позже</span>
<span class="c-key">const</span> fs = <span class="c-fn">require</span>(<span class="c-str">'node:fs'</span>);
fs.<span class="c-fn">readFile</span>(<span class="c-str">'big.txt'</span>, <span class="c-str">'utf8'</span>, (err, data) =&gt; {
  <span class="c-key">if</span> (err) <span class="c-key">throw</span> err;
  <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'прочитано'</span>, data.length);
});
<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'эта строка выполнится сразу, не дожидаясь файла'</span>);</code></pre>
    <p class="text">В асинхронном варианте Node отдаёт чтение системе через libuv, а сам возвращается в event loop и обслуживает другие запросы. Когда данные готовы — вызывается колбэк или резолвится промис.</p>
    <p class="text"><code>async/await</code> — тот же механизм, просто записанный линейно:</p>
<pre><code><span class="c-key">const</span> fs = <span class="c-fn">require</span>(<span class="c-str">'node:fs/promises'</span>);

<span class="c-key">async function</span> <span class="c-fn">main</span>() {
  <span class="c-key">const</span> data = <span class="c-key">await</span> fs.<span class="c-fn">readFile</span>(<span class="c-str">'big.txt'</span>, <span class="c-str">'utf8'</span>); <span class="c-comment">// event loop не блокируется</span>
  <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'прочитано'</span>, data.length);
}
<span class="c-fn">main</span>();</code></pre>
    <div class="pitfall"><strong>Частая ошибка.</strong> <code>await</code> не делает код «параллельным» — он лишь не блокирует event loop на время ожидания. Два последовательных <code>await</code> выполнятся один за другим; чтобы они шли одновременно, нужен <code>Promise.all</code>.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cog"></i> Две части libuv</div>
    <p class="text">libuv — C-библиотека, дающая Node кроссплатформенный неблокирующий I/O. В ней две ключевые части.</p>
    <p class="text"><strong>1. Event loop — диспетчер.</strong> Бесконечный цикл, который забирает у ОС готовые события («пришли данные по сокету», «сработал таймер», «файл прочитан»), вызывает соответствующие JS-колбэки, проверяет отложенные задачи, а если делать нечего — засыпает и просыпается на новом событии. Именно поэтому один поток JS обслуживает тысячи соединений: он не ждёт каждое, а реагирует на события. Подробный разбор фаз — в разделе <strong>Event loop и фазы</strong>.</p>
    <p class="text"><strong>2. Пул потоков.</strong> Некоторые операции ОС не умеет делать асинхронно — например, чтение файлов на Linux. Для них libuv держит пул фоновых потоков (по умолчанию 4, меняется через <code>UV_THREADPOOL_SIZE</code>): они выполняют блокирующую работу, а event loop получает только результат. Что именно уходит в пул, а что обрабатывается ОС напрямую через <code>epoll</code>/<code>kqueue</code>/<code>IOCP</code> — разобрано в разделе <strong>Thread pool и блокировка</strong>.</p>
    <div class="pitfall"><strong>Следствие, о которое спотыкаются.</strong> Запустите пять тяжёлых <code>fs.readFile</code> одновременно при пуле из четырёх потоков — пятый будет ждать освобождения. Это частая причина «загадочных» задержек, которые не объясняются ни сетью, ни базой.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="route"></i> Путь одного HTTP-запроса через слои</div>
    <p class="text">Как части схемы из раздела «Из чего состоит» работают вместе:</p>
    <div class="diagram">1. Запрос приходит по сети
   └─ ОС сообщает libuv через epoll / kqueue / IOCP

2. Event loop видит событие «данные на сокете»
   └─ вызывает JS-колбэк через Bindings (мост JS ↔ C++)

3. V8 исполняет твой обработчик (роут Express или Nest)

4. Обработчик читает файл:
   ├─ fs.readFile → libuv кладёт задачу в пул потоков
   └─ event loop свободен и обслуживает другие запросы

5. Пул потоков прочитал файл → событие в event loop
   └─ вызывается колбэк / резолвится промис → формируется ответ

6. Ответ уходит в сокет через libuv → ОС → сеть</div>
    <p class="text">Нижние слои схемы — конкретные C-библиотеки, на которых стоят встроенные модули: <strong>OpenSSL</strong> (<code>node:crypto</code>, HTTPS/TLS), <strong>zlib</strong> (сжатие, gzip в HTTP), <strong>c-ares</strong> (асинхронный DNS в <code>dns.resolve*</code>), <strong>llhttp</strong> (парсер HTTP), <strong>undici</strong> (HTTP-клиент, на котором работает глобальный <code>fetch</code>).</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="scale"></i> I/O-bound против CPU-bound</div>
    <p class="text">Node оптимизирован под <strong>I/O-bound</strong> задачи — где время уходит на ожидание сети и диска, а не на вычисления: API-серверы, прокси, real-time, чаты, стриминг. Здесь он силён.</p>
    <p class="text">Но JS исполняется в одном потоке V8. Тяжёлые вычисления — сортировка гигантского массива, обработка изображений, криптография на чистом JS — останавливают event loop, и все соединения ждут, хотя никакого I/O нет:</p>
<pre><code><span class="c-comment">// ❌ Блокирует event loop на секунды — все запросы повиснут</span>
<span class="c-key">function</span> <span class="c-fn">heavyCpu</span>() {
  <span class="c-key">let</span> sum = <span class="c-num">0</span>;
  <span class="c-key">for</span> (<span class="c-key">let</span> i = <span class="c-num">0</span>; i &lt; <span class="c-num">1e10</span>; i++) sum += i;
  <span class="c-key">return</span> sum;
}

<span class="c-comment">// ✅ Уводим в worker thread — event loop свободен</span>
<span class="c-key">const</span> { Worker } = <span class="c-fn">require</span>(<span class="c-str">'node:worker_threads'</span>);
<span class="c-key">new</span> <span class="c-type">Worker</span>(<span class="c-str">'./heavy-worker.js'</span>);</code></pre>
    <table class="data-table">
      <thead><tr><th>Куда выносить CPU-работу</th><th>Когда это правильный выбор</th></tr></thead>
      <tbody>
        <tr><td><code>node:worker_threads</code></td><td>Настоящие потоки внутри процесса, есть общая память через <code>SharedArrayBuffer</code></td></tr>
        <tr><td><code>node:child_process</code></td><td>Отдельный процесс — изоляция памяти, можно запускать не-JS</td></tr>
        <tr><td>Нативные асинхронные реализации</td><td><code>crypto</code> и <code>zlib</code> уже уходят в пул потоков — не пишите своё на чистом JS</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Короткая формула</div>
    <div class="remember-box">I/O — это ожидание внешнего мира. Неблокирующий I/O — способ ждать, не останавливая программу. libuv организует это ожидание: event loop реагирует на события, пул потоков выполняет блокирующую часть, а V8 тем временем спокойно исполняет JavaScript.<br><br>Поэтому Node и называют <strong>однопоточным, но конкурентным</strong>: один поток JS — и множество одновременных I/O-операций.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-event-loop" class="section">
  <div class="section-title">Event loop и фазы</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="repeat"></i> Почему Node однопоточный, но держит тысячи соединений</div>
    <p class="text">JS-код выполняется в <strong>одном потоке</strong>. Ввод-вывод — сеть, сокеты — отдаётся операционной системе через libuv неблокирующе. Когда операция завершается, её колбэк ставится в очередь, и event loop его подбирает.</p>
    <div class="diagram">     ┌───────────────────────────┐
  ┌─→│  timers                   │  setTimeout, setInterval
  │  ├───────────────────────────┤
  │  │  pending callbacks        │  отложенные системные колбэки
  │  ├───────────────────────────┤
  │  │  poll                     │  ждёт I/O, исполняет его колбэки
  │  ├───────────────────────────┤
  │  │  check                    │  setImmediate
  │  ├───────────────────────────┤
  │  │  close callbacks          │  socket.on('close')
  │  └───────────────────────────┘
  └──────────────┘

  Между КАЖДЫМ колбэком выполняются микрозадачи:
     1) очередь process.nextTick
     2) очередь промисов</div>
    <div class="pitfall"><strong>Пока один колбэк работает, всё остальное ждёт.</strong> Тяжёлая синхронная работа блокирует весь сервер — не «этот запрос», а <em>все</em> соединения процесса.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="puzzle"></i> Классическая задача на порядок</div>
<pre><code><span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'1'</span>);
<span class="c-fn">setTimeout</span>(() =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'2'</span>), <span class="c-num">0</span>);
<span class="c-fn">setImmediate</span>(() =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'3'</span>));
<span class="c-type">Promise</span>.<span class="c-fn">resolve</span>().<span class="c-fn">then</span>(() =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'4'</span>));
process.<span class="c-fn">nextTick</span>(() =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'5'</span>));
<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'6'</span>);</code></pre>
    <table class="data-table">
      <thead><tr><th>Порядок</th><th>Что выводится</th><th>Почему</th></tr></thead>
      <tbody>
        <tr><td>1–2</td><td><code>1</code>, <code>6</code></td><td>Синхронный код идёт первым, целиком</td></tr>
        <tr><td>3</td><td><code>5</code></td><td><code>process.nextTick</code> — отдельная очередь, приоритетнее промисов</td></tr>
        <tr><td>4</td><td><code>4</code></td><td>Очередь промисов</td></tr>
        <tr><td>5–6</td><td><code>2</code> и <code>3</code></td><td><strong>Порядок не гарантирован</strong></td></tr>
      </tbody>
    </table>
    <div class="why-box"><strong>Почему <code>2</code> и <code>3</code> плавают.</strong> В главном модуле результат зависит от того, успел ли истечь таймер к моменту входа в фазу timers — а это зависит от скорости запуска процесса. Но <strong>внутри I/O-колбэка <code>setImmediate</code> всегда раньше <code>setTimeout</code></strong>: цикл уже находится в фазе poll, и следующая фаза — check.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-threadpool" class="section">
  <div class="section-title">Thread pool и блокировка</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cpu"></i> Что уходит в пул потоков libuv</div>
    <table class="data-table">
      <thead><tr><th>Идёт в thread pool</th><th>Не идёт — работает через epoll/kqueue</th></tr></thead>
      <tbody>
        <tr><td><code>fs</code> — файловая система</td><td rowspan="4">Сеть: TCP, HTTP, сокеты</td></tr>
        <tr><td><code>crypto</code>: <code>pbkdf2</code>, <code>scrypt</code></td></tr>
        <tr><td><code>zlib</code> — сжатие</td></tr>
        <tr><td><code>dns.lookup</code></td></tr>
      </tbody>
    </table>
    <p class="text">По умолчанию в пуле <strong>4 потока</strong>, меняется переменной <code>UV_THREADPOOL_SIZE</code>.</p>
    <div class="pitfall"><strong>Распространённое заблуждение.</strong> «Node асинхронный, значит всё параллельно». Нет: сеть действительно обрабатывается ОС, а вот файловые и crypto-операции делят между собой 4 потока. Пять одновременных <code>pbkdf2</code> — и пятый ждёт.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="ban"></i> Чем нельзя блокировать event loop</div>
    <ul style="margin:8px 0 14px 22px;color:var(--text2);font-size:13px;line-height:1.85">
      <li><code>JSON.parse</code> огромных тел запроса</li>
      <li>Тяжёлые регулярные выражения (катастрофический бэктрекинг)</li>
      <li>Синхронные вызовы <code>fs</code>: <code>readFileSync</code> в обработчике</li>
      <li>Циклы на миллионы итераций</li>
      <li>Синхронный <code>bcrypt</code></li>
    </ul>
    <table class="data-table">
      <thead><tr><th>Решение</th><th>Когда применять</th></tr></thead>
      <tbody>
        <tr><td><code>worker_threads</code></td><td>CPU-задача внутри того же процесса</td></tr>
        <tr><td>Отдельный сервис или очередь</td><td>Долгая обработка, которую не ждёт пользователь</td></tr>
        <tr><td>Разбить на части через <code>setImmediate</code></td><td>Длинный цикл, который можно нарезать</td></tr>
        <tr><td><code>cluster</code> или несколько реплик</td><td>Использовать все ядра. В Docker/K8s обычно реплики, а не cluster</td></tr>
      </tbody>
    </table>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-async-errors" class="section">
  <div class="section-title">Ошибки в async-коде</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Где ловить</div>
<pre><code><span class="c-comment">// Основной способ — try/catch вокруг await</span>
<span class="c-key">try</span> {
  <span class="c-key">const</span> user = <span class="c-key">await</span> <span class="c-fn">fetchUser</span>(id);
} <span class="c-key">catch</span> (e) {
  <span class="c-comment">// обработка</span>
}</code></pre>
    <table class="data-table">
      <thead><tr><th>Ситуация</th><th>Что происходит</th></tr></thead>
      <tbody>
        <tr><td>Промис без <code>catch</code></td><td><code>unhandledRejection</code>. В современных версиях Node процесс по умолчанию <strong>падает</strong></td></tr>
        <tr><td><code>process.on('uncaughtException')</code></td><td>Последний рубеж <em>только</em> для логирования и аккуратного завершения</td></tr>
        <tr><td>В NestJS</td><td>Exception filters превращают исключения в HTTP-ответы</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong>После <code>uncaughtException</code> продолжать работу нельзя.</strong> Состояние процесса неопределённо: могли остаться незакрытые транзакции, повреждённые структуры в памяти, полузаписанные файлы. Правильное поведение — залогировать и завершиться, дав супервизору поднять новый процесс.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-promises" class="section">
  <div class="section-title">Комбинаторы промисов</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-merge"></i> Четыре способа дождаться нескольких операций</div>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Поведение</th><th>Когда применять</th></tr></thead>
      <tbody>
        <tr><td><code>Promise.all</code></td><td>Падает на <strong>первой</strong> ошибке</td><td>Нужны все результаты, и любая ошибка критична</td></tr>
        <tr><td><code>Promise.allSettled</code></td><td>Ждёт всех, возвращает статус каждого</td><td>Собрать результаты, часть из которых может упасть</td></tr>
        <tr><td><code>Promise.race</code></td><td>Первый завершившийся — успех <em>или</em> ошибка</td><td>Таймауты</td></tr>
        <tr><td><code>Promise.any</code></td><td>Первый <strong>успешный</strong></td><td>Несколько поставщиков, подходит любой ответ</td></tr>
      </tbody>
    </table>
    <div class="remember-box">Разница <code>race</code> и <code>any</code> — в отношении к ошибкам. <code>race</code> завершится ошибкой, если первым пришёл отказ; <code>any</code> будет ждать успеха и упадёт, только если провалились все.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-streams" class="section">
  <div class="section-title">Streams и backpressure</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="waves"></i> Зачем потоки</div>
    <p class="text">Поток отдаёт данные кусками и не держит всё в памяти. Отдать CSV-отчёт на гигабайт без потоков — значит сначала собрать этот гигабайт в память процесса.</p>
    <div class="why-box"><strong>Backpressure — обратное давление.</strong> Если писатель не успевает за читателем, <code>write()</code> возвращает <code>false</code>. Это сигнал прекратить писать и дождаться события <code>drain</code>. Игнорировать его — значит копить данные в буфере и прийти к той же утечке памяти, от которой уходили.</div>
<pre><code><span class="c-key">import</span> { pipeline } <span class="c-key">from</span> <span class="c-str">'node:stream/promises'</span>;

<span class="c-comment">// pipeline сам обрабатывает backpressure, ошибки и закрытие потоков</span>
<span class="c-key">await</span> <span class="c-fn">pipeline</span>(
  source,
  transform,
  destination,
);</code></pre>
    <div class="remember-box">Соединять потоки руками через <code>.pipe()</code> и <code>.on('error')</code> — источник незакрытых дескрипторов. <code>stream.pipeline()</code> закрывает всю цепочку при ошибке в любом звене.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-memory" class="section">
  <div class="section-title">Утечки памяти</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="activity"></i> Откуда берутся</div>
    <table class="data-table">
      <thead><tr><th>Причина</th><th>Как выглядит</th></tr></thead>
      <tbody>
        <tr><td>Глобальный кеш без лимита</td><td><code>Map</code>, который только растёт и никогда не чистится</td></tr>
        <tr><td>Неотписанные слушатели</td><td><code>emitter.on(...)</code> без парного <code>off</code></td></tr>
        <tr><td>Замыкания на большие объекты</td><td>Колбэк держит ссылку на весь ответ, а нужен один id</td></tr>
        <tr><td>Таймеры без очистки</td><td><code>setInterval</code> без <code>clearInterval</code></td></tr>
      </tbody>
    </table>
    <div class="why-box"><strong>Почему это болезнь именно Node, а не PHP.</strong> PHP-процесс умирает после запроса и уносит с собой всё, что натворил. Node-процесс живёт неделями: любая не освобождённая ссылка накапливается от запроса к запросу.</div>
<pre><code><span class="c-comment"># Запуск с инспектором</span>
node --inspect app.js

<span class="c-comment"># Дальше: Chrome DevTools → Memory → два heap snapshot с интервалом,
# сравнить и посмотреть, что выросло</span></code></pre>
<pre><code><span class="c-comment">// Быстрая проверка в рантайме</span>
<span class="c-fn">setInterval</span>(() =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(process.<span class="c-fn">memoryUsage</span>()), <span class="c-num">10_000</span>);</code></pre>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-modules" class="section">
  <div class="section-title">CommonJS и ESM</div>
  <div class="subsection">
    <table class="data-table">
      <thead><tr><th></th><th>CommonJS</th><th>ES Modules</th></tr></thead>
      <tbody>
        <tr><td><strong>Синтаксис</strong></td><td><code>require</code> / <code>module.exports</code></td><td><code>import</code> / <code>export</code></td></tr>
        <tr><td><strong>Загрузка</strong></td><td>Синхронная</td><td>Асинхронная</td></tr>
        <tr><td><strong>Анализ</strong></td><td>В рантайме</td><td>Статический — отсюда tree shaking</td></tr>
        <tr><td><strong>Top-level await</strong></td><td>Нет</td><td>Да</td></tr>
      </tbody>
    </table>
    <div class="remember-box">В NestJS-проектах TypeScript обычно компилируется в <strong>CommonJS</strong> — из-за декораторов и <code>emitDecoratorMetadata</code>, на которых держится DI.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-shutdown" class="section">
  <div class="section-title">Graceful shutdown</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="power"></i> Порядок завершения</div>
    <ol style="margin:8px 0 14px 22px;color:var(--text2);font-size:13px;line-height:1.85">
      <li>Поймать <code>SIGTERM</code></li>
      <li>Перестать принимать новые запросы — <code>server.close()</code></li>
      <li>Дать текущим запросам завершиться</li>
      <li>Закрыть пул БД и подключения к очередям</li>
      <li>Выйти</li>
    </ol>
<pre><code><span class="c-comment">// NestJS</span>
app.<span class="c-fn">enableShutdownHooks</span>();

<span class="c-comment">// И хуки в провайдерах:</span>
<span class="c-key">async</span> <span class="c-fn">onModuleDestroy</span>() { <span class="c-comment">/* закрыть ресурсы */</span> }
<span class="c-key">async</span> <span class="c-fn">beforeApplicationShutdown</span>(signal?: <span class="c-key">string</span>) { <span class="c-comment">/* ... */</span> }</code></pre>
    <div class="pitfall"><strong>Для воркеров, обрабатывающих платежи, это критично.</strong> Процесс, убитый посреди транзакции, оставляет задачу в статусе «выполняется» без исполнителя. Контейнер при деплое получает <code>SIGTERM</code> и через 10 секунд <code>SIGKILL</code> — за эти 10 секунд нужно успеть доработать текущую задачу и не взять новую.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-realtime" class="section">
  <div class="section-title">Реальное время: WebSocket, SSE, Long Polling</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Три способа, чем отличаются</div>
    <table class="data-table">
      <thead><tr><th>Характеристика</th><th>WebSocket</th><th>SSE</th><th>Long Polling</th></tr></thead>
      <tbody>
        <tr><td><strong>Направление</strong></td><td>Двунаправленное: клиент ⇄ сервер</td><td>Только сервер → клиент</td><td>Сервер → клиент, но запрос инициирует клиент</td></tr>
        <tr><td><strong>Протокол</strong></td><td>Свой, поверх TCP: <code>ws://</code> / <code>wss://</code></td><td>Обычный HTTP, <code>text/event-stream</code></td><td>Обычный HTTP</td></tr>
        <tr><td><strong>Применение</strong></td><td>Чаты, игры, совместное редактирование</td><td>Ленты, уведомления, дашборды, котировки</td><td>Фоллбэк, легаси, редкие обновления</td></tr>
        <tr><td><strong>Сложность</strong></td><td>Средняя — нужно вести жизненный цикл</td><td>Низкая — переподключение встроено</td><td>Низкая, но накладно</td></tr>
        <tr><td><strong>Накладные расходы</strong></td><td>Низкие</td><td>Низкие</td><td>Высокие — каждый запрос полный HTTP-цикл</td></tr>
        <tr><td><strong>Переподключение</strong></td><td>Пишешь сам</td><td><strong>Браузер сам</strong></td><td>Сам по природе — цикл запросов</td></tr>
        <tr><td><strong>Бинарные данные</strong></td><td>Да</td><td>Нет, только текст</td><td>Да</td></tr>
      </tbody>
    </table>
    <div class="remember-box"><strong>Правило выбора в одну строку.</strong> Данные идут в одну сторону → SSE. Нужно слать и обратно → WebSocket. Редкие обновления или окружение режет всё остальное → Long Polling.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-left-right"></i> WebSocket — полноценный двусторонний канал</div>
    <p class="text">Соединение начинается как обычный HTTP-запрос с просьбой сменить протокол, после чего тот же TCP-сокет работает уже по WebSocket.</p>
<pre><code><span class="c-comment">// Запрос клиента</span>
GET /ws HTTP/1.1
Upgrade: websocket
Connection: Upgrade
Sec-WebSocket-Key: dGhlIHNhbXBsZSBub25jZQ==

<span class="c-comment">// Ответ сервера</span>
HTTP/1.1 101 Switching Protocols
Upgrade: websocket
Connection: Upgrade</code></pre>
<pre><code><span class="c-key">import</span> { <span class="c-type">WebSocketServer</span> } <span class="c-key">from</span> <span class="c-str">'ws'</span>;

<span class="c-key">const</span> wss = <span class="c-key">new</span> <span class="c-type">WebSocketServer</span>({ port: <span class="c-num">8080</span> });

wss.<span class="c-fn">on</span>(<span class="c-str">'connection'</span>, (ws) =&gt; {
  ws.<span class="c-fn">send</span>(<span class="c-str">'Добро пожаловать!'</span>);

  ws.<span class="c-fn">on</span>(<span class="c-str">'message'</span>, (raw) =&gt; {
    <span class="c-key">const</span> text = raw.<span class="c-fn">toString</span>();

    <span class="c-comment">// Разослать всем живым клиентам</span>
    <span class="c-key">for</span> (<span class="c-key">const</span> client <span class="c-key">of</span> wss.clients) {
      <span class="c-key">if</span> (client.readyState === <span class="c-type">WebSocket</span>.<span class="c-type">OPEN</span>) {
        client.<span class="c-fn">send</span>(text);
      }
    }
  });
});</code></pre>
<pre><code><span class="c-comment">// Клиент</span>
<span class="c-key">const</span> ws = <span class="c-key">new</span> <span class="c-type">WebSocket</span>(<span class="c-str">'wss://example.com/ws'</span>);
ws.onopen    = () =&gt; ws.<span class="c-fn">send</span>(<span class="c-str">'привет'</span>);
ws.onmessage = (e) =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(e.data);
ws.onclose   = () =&gt; <span class="c-comment">/* переподключение пишешь сам */</span>;</code></pre>
    <div class="pitfall"><strong>Переподключения из коробки нет.</strong> Обрыв связи, спящий ноутбук, смена Wi-Fi — соединение закрылось, и клиент молча перестал получать сообщения. Нужен свой reconnect с экспоненциальной задержкой плюс досылка пропущенного по <code>last_message_id</code>. Именно за это берут <code>socket.io</code>: там это уже реализовано.</div>
    <div class="pitfall"><strong>Мёртвые соединения не определяются сами.</strong> TCP может считать сокет живым часами после того, как клиент исчез. Нужен heartbeat: сервер шлёт <code>ping</code>, клиент отвечает <code>pong</code>, не ответил за два интервала — закрываем.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="radio"></i> SSE — поток событий от сервера</div>
    <p class="text">Сервер открывает один долгоживущий HTTP-ответ и пишет в него текстовые события. Клиент только слушает.</p>
<pre><code><span class="c-key">import</span> express <span class="c-key">from</span> <span class="c-str">'express'</span>;
<span class="c-key">const</span> app = <span class="c-fn">express</span>();

app.<span class="c-fn">get</span>(<span class="c-str">'/events'</span>, (req, res) =&gt; {
  res.<span class="c-fn">setHeader</span>(<span class="c-str">'Content-Type'</span>,  <span class="c-str">'text/event-stream'</span>);
  res.<span class="c-fn">setHeader</span>(<span class="c-str">'Cache-Control'</span>, <span class="c-str">'no-cache'</span>);
  res.<span class="c-fn">setHeader</span>(<span class="c-str">'Connection'</span>,    <span class="c-str">'keep-alive'</span>);
  res.<span class="c-fn">flushHeaders</span>();

  <span class="c-key">const</span> timer = <span class="c-fn">setInterval</span>(() =&gt; {
    <span class="c-key">const</span> payload = { ts: <span class="c-type">Date</span>.<span class="c-fn">now</span>(), value: <span class="c-type">Math</span>.<span class="c-fn">random</span>() };

    <span class="c-comment">// Формат строгий: поле, двоеточие, значение. Событие закрывают ДВА \n</span>
    res.<span class="c-fn">write</span>(`id: ${payload.ts}\n`);
    res.<span class="c-fn">write</span>(`data: ${<span class="c-type">JSON</span>.<span class="c-fn">stringify</span>(payload)}\n\n`);
  }, <span class="c-num">2000</span>);

  req.<span class="c-fn">on</span>(<span class="c-str">'close'</span>, () =&gt; { <span class="c-fn">clearInterval</span>(timer); res.<span class="c-fn">end</span>(); });
});</code></pre>
<pre><code><span class="c-comment">// Клиент — всё встроено в браузер</span>
<span class="c-key">const</span> es = <span class="c-key">new</span> <span class="c-type">EventSource</span>(<span class="c-str">'/events'</span>);
es.onmessage = (e) =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-type">JSON</span>.<span class="c-fn">parse</span>(e.data));
es.onerror   = () =&gt; <span class="c-comment">/* браузер переподключится сам */</span>;</code></pre>
    <table class="data-table">
      <thead><tr><th>Поле</th><th>Что делает</th></tr></thead>
      <tbody>
        <tr><td><code>data:</code></td><td>Полезная нагрузка. Несколько строк подряд склеиваются через <code>\n</code></td></tr>
        <tr><td><code>id:</code></td><td>Идентификатор события. Браузер запоминает последний</td></tr>
        <tr><td><code>event:</code></td><td>Имя события — слушается через <code>addEventListener('имя', ...)</code></td></tr>
        <tr><td><code>retry:</code></td><td>Задержка переподключения в миллисекундах</td></tr>
        <tr><td><code>:</code> в начале строки</td><td>Комментарий. Используют как heartbeat, чтобы прокси не закрыл соединение</td></tr>
      </tbody>
    </table>
    <div class="why-box"><strong>Главное преимущество SSE — восстановление без потерь.</strong> Браузер переподключается сам и присылает заголовок <code>Last-Event-ID</code> с последним полученным <code>id</code>. Сервер по нему досылает пропущенное. С WebSocket эту логику пишут руками.</div>
    <div class="pitfall"><strong>Лимит 6 соединений на домен в HTTP/1.1.</strong> Каждая вкладка держит открытое SSE-соединение. Семь вкладок — и седьмая зависнет, а вместе с ней и обычные запросы к тому же домену. По HTTP/2 лимита практически нет, поэтому SSE в проде почти всегда ставят за HTTP/2.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hourglass"></i> Long Polling — ожидание на обычном HTTP</div>
    <p class="text">Клиент шлёт обычный запрос, сервер не отвечает сразу, а держит его открытым, пока не появятся данные или не истечёт таймаут. Получив ответ, клиент немедленно шлёт следующий.</p>
<pre><code><span class="c-key">const</span> waiting = <span class="c-key">new</span> <span class="c-type">Set</span>();

app.<span class="c-fn">get</span>(<span class="c-str">'/poll'</span>, (req, res) =&gt; {
  <span class="c-key">const</span> since = <span class="c-type">Number</span>(req.query.since ?? <span class="c-num">0</span>);
  <span class="c-key">const</span> missed = <span class="c-fn">getEventsAfter</span>(since);

  <span class="c-comment">// Если что-то уже накопилось — отдаём сразу, без ожидания</span>
  <span class="c-key">if</span> (missed.length) <span class="c-key">return</span> res.<span class="c-fn">json</span>(missed);

  waiting.<span class="c-fn">add</span>(res);

  <span class="c-comment">// Таймаут обязателен: иначе прокси оборвёт соединение сам</span>
  <span class="c-key">const</span> timer = <span class="c-fn">setTimeout</span>(() =&gt; {
    waiting.<span class="c-fn">delete</span>(res);
    res.<span class="c-fn">json</span>([]);          <span class="c-comment">// пустой ответ — клиент сразу спросит снова</span>
  }, <span class="c-num">25_000</span>);

  req.<span class="c-fn">on</span>(<span class="c-str">'close'</span>, () =&gt; { <span class="c-fn">clearTimeout</span>(timer); waiting.<span class="c-fn">delete</span>(res); });
});

<span class="c-key">function</span> <span class="c-fn">publish</span>(event) {
  <span class="c-fn">store</span>(event);
  <span class="c-key">for</span> (<span class="c-key">const</span> res <span class="c-key">of</span> waiting) res.<span class="c-fn">json</span>([event]);
  waiting.<span class="c-fn">clear</span>();
}</code></pre>
    <div class="pitfall"><strong>Между ответом и следующим запросом есть окно.</strong> Событие, случившееся в этот момент, потеряется, если хранить «последнее значение» в переменной. Поэтому клиент передаёт курсор (<code>since</code> / <code>last_event_id</code>), а сервер отдаёт <em>всё, что после него</em> — а не только свежее.</div>
    <div class="pitfall"><strong>Каждый висящий запрос занимает ресурс.</strong> В Node это дёшево — соединение не держит поток. В PHP-FPM тот же приём съедает воркер целиком, поэтому там long polling почти не применяют.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="network"></i> Что ломается в проде</div>
    <div class="pitfall"><strong>Nginx рвёт соединение через 60 секунд.</strong> Дефолтный <code>proxy_read_timeout</code> закроет и WebSocket, и SSE, если в них нет трафика. Нужны <code>proxy_http_version 1.1</code>, проброс <code>Upgrade</code> / <code>Connection</code> для WebSocket и увеличенный таймаут. Разобрано в разделе <strong>Nginx → Reverse proxy</strong>.</div>
    <div class="pitfall"><strong>Буферизация прокси ломает SSE.</strong> Nginx копит ответ в буфере и отдаёт пачкой — события приходят с задержкой или не приходят вовсе. Лечится <code>proxy_buffering off;</code> или заголовком <code>X-Accel-Buffering: no</code> из приложения.</div>
    <div class="pitfall"><strong>Несколько инстансов не видят друг друга.</strong> Клиент А подключён к первому процессу, клиент Б ко второму — сообщение от А до Б не дойдёт. Нужен общий канал: Redis pub/sub (для <code>socket.io</code> есть готовый адаптер) плюс sticky sessions на балансировщике, чтобы переподключение попадало в тот же инстанс.</div>
    <div class="pitfall"><strong>Медленный клиент копит данные в памяти сервера.</strong> Если читатель не успевает, сокет буферизует — и процесс растёт. Нужно следить за <code>ws.bufferedAmount</code> и отключать безнадёжно отстающих.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle-2"></i> Как выбрать</div>
    <table class="data-table">
      <thead><tr><th>Задача</th><th>Выбор</th></tr></thead>
      <tbody>
        <tr><td>Чат, игра, совместное редактирование</td><td>WebSocket</td></tr>
        <tr><td>Лента уведомлений, прогресс задачи, котировки</td><td><strong>SSE</strong> — проще и переподключается сам</td></tr>
        <tr><td>Обновление раз в минуту</td><td>Обычный опрос по таймеру, без всего этого</td></tr>
        <tr><td>Окружение режет WebSocket (корпоративный прокси)</td><td>Long Polling как фоллбэк</td></tr>
      </tbody>
    </table>
    <div class="remember-box">Частая ошибка — взять WebSocket там, где хватало SSE. Двусторонний канал приносит с собой переподключение, heartbeat, синхронизацию между инстансами и отслеживание состояния. Если клиенту нужно только <em>получать</em>, всё это лишняя работа.</div>
  </div>
</div>
@endverbatim
@verbatim
<div id="sec-nest-arch" class="section">
  <div class="section-title">NestJS: строительные блоки</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="boxes"></i> Что чему соответствует в Laravel</div>
    <table class="data-table">
      <thead><tr><th>NestJS</th><th>Аналог в Laravel</th><th>Что делает</th></tr></thead>
      <tbody>
        <tr><td><code>@Module</code></td><td>Service Provider</td><td>Группирует контроллеры и провайдеры, задаёт <code>imports</code> и <code>exports</code></td></tr>
        <tr><td><code>@Injectable</code> провайдер</td><td>Класс в контейнере</td><td>Сервис, который DI создаёт и внедряет через конструктор</td></tr>
        <tr><td>Controller</td><td>Controller</td><td>Маршруты: <code>@Get</code>, <code>@Post</code>, <code>@Param</code>, <code>@Body</code></td></tr>
        <tr><td>DTO + ValidationPipe</td><td>FormRequest</td><td>Валидация входа через class-validator</td></tr>
        <tr><td>Guard</td><td>Middleware auth / Gate / Policy</td><td>Решает, пускать ли запрос: JWT, роли, подпись вебхука</td></tr>
        <tr><td>Interceptor</td><td>Middleware до и после</td><td>Обёртка вокруг хендлера: логи, кеш, таймаут, преобразование ответа</td></tr>
        <tr><td>Exception filter</td><td>Exception Handler</td><td>Превращает исключения в HTTP-ответы</td></tr>
        <tr><td>Middleware</td><td>Global middleware</td><td>Низкоуровнево, до guards: request-id, raw body, CORS</td></tr>
      </tbody>
    </table>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-nest-lifecycle" class="section">
  <div class="section-title">NestJS: жизненный цикл запроса</div>
  <div class="subsection">
    <div class="diagram">Middleware
    ↓
Guards              ← пускать или нет
    ↓
Interceptors (до)   ← обёртка: логи, таймаут
    ↓
Pipes               ← валидация и преобразование
    ↓
Handler             ← метод контроллера
    ↓
Interceptors (после)
    ↓
Exception filters   ← если было исключение</div>
    <div class="remember-box"><strong>Как запомнить порядок:</strong> сначала решаем, <em>пускать ли</em> (guard), потом <em>оборачиваем</em> (interceptor), потом <em>проверяем данные</em> (pipe).</div>
    <div class="why-box"><strong>Почему guard раньше pipe.</strong> Нет смысла валидировать тело запроса от того, кого мы всё равно не пустим. Сначала отсекается неавторизованный трафик, и только потом тратится время на разбор данных.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-nest-di" class="section">
  <div class="section-title">NestJS: DI и scope</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="box"></i> Как работает внедрение</div>
    <p class="text">Провайдер регистрируется в модуле, Nest строит граф зависимостей <strong>по типам параметров конструктора</strong> — ровно как контейнер Laravel по рефлексии.</p>
    <table class="data-table">
      <thead><tr><th>Scope</th><th>Время жизни</th><th>Нюанс</th></tr></thead>
      <tbody>
        <tr><td><code>DEFAULT</code></td><td>Синглтон на всё приложение</td><td>По умолчанию</td></tr>
        <tr><td><code>REQUEST</code></td><td>Новый экземпляр на каждый запрос</td><td>Медленнее, и scope <strong>поднимается вверх</strong> по цепочке зависимостей</td></tr>
        <tr><td><code>TRANSIENT</code></td><td>Новый экземпляр на каждое внедрение</td><td>—</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong>REQUEST-scope заразен.</strong> Если провайдер с этим scope внедрён в синглтон, синглтон тоже становится request-scoped — и дальше вверх по всей цепочке. Незаметно превращает всё приложение в пересоздаваемое на каждый запрос.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="wrench"></i> Кастомные провайдеры и циклы</div>
<pre><code><span class="c-comment">// Четыре формы — аналог bind/singleton/instance в Laravel</span>
{ provide: <span class="c-type">PaymentGateway</span>, useClass: <span class="c-type">StripeGateway</span> }
{ provide: <span class="c-str">'CONFIG'</span>, useValue: { timeout: <span class="c-num">5000</span> } }
{ provide: <span class="c-type">Client</span>, useFactory: (cfg) =&gt; <span class="c-key">new</span> <span class="c-type">Client</span>(cfg), inject: [<span class="c-type">Config</span>] }
{ provide: <span class="c-type">Alias</span>, useExisting: <span class="c-type">Original</span> }</code></pre>
    <p class="text">Через них подменяют реализации — например, мок платёжного шлюза в тестах.</p>
    <div class="why-box"><strong>Циклическая зависимость.</strong> Технически лечится <code>forwardRef(() =&gt; OtherService)</code> в обоих местах. Но это признак неверной границы модулей: правильнее вынести общую логику в третий сервис или общаться через события (<code>EventEmitter2</code>).</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-nest-validation" class="section">
  <div class="section-title">NestJS: DTO, валидация, guards</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> ValidationPipe глобально</div>
<pre><code>app.<span class="c-fn">useGlobalPipes</span>(<span class="c-key">new</span> <span class="c-type">ValidationPipe</span>({
  whitelist: <span class="c-key">true</span>,              <span class="c-comment">// выкинуть поля, которых нет в DTO</span>
  forbidNonWhitelisted: <span class="c-key">true</span>,   <span class="c-comment">// или вообще отклонить запрос</span>
  transform: <span class="c-key">true</span>,              <span class="c-comment">// привести типы: '5' → 5</span>
}));</code></pre>
    <div class="remember-box"><code>whitelist: true</code> — прямой аналог <code>$fillable</code> в Laravel: защита от mass assignment. Лишние поля не доедут до сервиса.</div>
<pre><code><span class="c-key">export class</span> <span class="c-type">CreateOrderDto</span> {
  @<span class="c-fn">IsUUID</span>()      productId: <span class="c-key">string</span>;
  @<span class="c-fn">IsInt</span>() @<span class="c-fn">Min</span>(<span class="c-num">1</span>) quantity: <span class="c-key">number</span>;
  @<span class="c-fn">IsString</span>() @<span class="c-fn">IsOptional</span>() comment?: <span class="c-key">string</span>;
}</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield"></i> Авторизация</div>
    <p class="text"><code>@nestjs/passport</code> + <code>@nestjs/jwt</code>: <code>JwtStrategy</code> валидирует токен, <code>JwtAuthGuard</code> вешается на контроллер или глобально.</p>
<pre><code><span class="c-comment">// Роли: свой декоратор через SetMetadata + guard, читающий их через Reflector</span>
@<span class="c-fn">Roles</span>(<span class="c-str">'admin'</span>)
@<span class="c-fn">UseGuards</span>(<span class="c-type">JwtAuthGuard</span>, <span class="c-type">RolesGuard</span>)
@<span class="c-fn">Delete</span>(<span class="c-str">':id'</span>)
<span class="c-fn">remove</span>(@<span class="c-fn">Param</span>(<span class="c-str">'id'</span>) id: <span class="c-key">string</span>) { <span class="c-comment">/* ... */</span> }</code></pre>
    <div class="remember-box">Access-токен короткий, refresh хранится в БД или Redis — чтобы его можно было <strong>отозвать</strong>. Без хранения отозвать JWT нельзя в принципе.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-nest-orm" class="section">
  <div class="section-title">NestJS: ORM и транзакции</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> TypeORM и Prisma</div>
<pre><code><span class="c-comment">// TypeORM: все запросы внутри идут через manager</span>
<span class="c-key">await</span> dataSource.<span class="c-fn">transaction</span>(<span class="c-key">async</span> (manager) =&gt; {
  <span class="c-key">const</span> order = <span class="c-key">await</span> manager.<span class="c-fn">findOneOrFail</span>(<span class="c-type">Order</span>, {
    where: { id },
    lock: { mode: <span class="c-str">'pessimistic_write'</span> },   <span class="c-comment">// SELECT ... FOR UPDATE</span>
  });
  <span class="c-comment">// ...</span>
});

<span class="c-comment">// Prisma</span>
<span class="c-key">await</span> prisma.$<span class="c-fn">transaction</span>(<span class="c-key">async</span> (tx) =&gt; { <span class="c-comment">/* ... */</span> });</code></pre>
    <div class="pitfall"><strong>Главное правило транзакций в Node.</strong> Внутри транзакции должен использоваться <strong>один и тот же клиент из пула</strong>. Если вызвать репозиторий не через <code>manager</code> / <code>tx</code>, запрос уйдёт по <em>другому соединению</em> и окажется вне транзакции — молча, без ошибки. В PHP такой проблемы почти нет, потому что там одно соединение на запрос.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-nest-queues" class="section">
  <div class="section-title">NestJS: очереди</div>
  <div class="subsection">
    <table class="data-table">
      <thead><tr><th>Решение</th><th>Хранилище</th><th>Чем хорошо</th></tr></thead>
      <tbody>
        <tr><td><strong>BullMQ</strong> (<code>@nestjs/bullmq</code>)</td><td>Redis</td><td>Стандарт экосистемы: ретраи, backoff, отложенные задачи, приоритеты</td></tr>
        <tr><td><strong>pg-boss</strong>, <strong>graphile-worker</strong></td><td>PostgreSQL</td><td>Очередь в той же БД — задачу можно поставить <em>в одной транзакции</em> с бизнес-операцией</td></tr>
      </tbody>
    </table>
    <div class="why-box"><strong>Почему для денег очередь в Postgres удобнее.</strong> Если платёж записывается в БД, а задача на выдачу ставится в Redis, между двумя операциями есть окно: БД закоммитилась, Redis не принял — заказ оплачен, но задача потеряна. Очередь в той же БД коммитится вместе с платежом, и такого окна нет.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-nest-testing" class="section">
  <div class="section-title">NestJS: тестирование</div>
  <div class="subsection">
<pre><code><span class="c-key">const</span> moduleRef = <span class="c-key">await</span> <span class="c-type">Test</span>.<span class="c-fn">createTestingModule</span>({
  providers: [<span class="c-type">PaymentsService</span>, <span class="c-type">LedgerService</span>],
})
  .<span class="c-fn">overrideProvider</span>(<span class="c-type">PaymentGateway</span>)
  .<span class="c-fn">useValue</span>(mockGateway)
  .<span class="c-fn">compile</span>();</code></pre>
    <table class="data-table">
      <thead><tr><th>Уровень</th><th>Инструмент</th></tr></thead>
      <tbody>
        <tr><td>Unit — сервисы</td><td>Jest с подменой провайдеров</td></tr>
        <tr><td>E2E — HTTP</td><td><code>supertest</code> на поднятое приложение</td></tr>
        <tr><td>Интеграционные</td><td>Настоящий Postgres в Docker, <code>testcontainers</code></td></tr>
      </tbody>
    </table>
    <div class="remember-box"><strong>Идемпотентность нужно тестировать конкурентно.</strong> Последовательные повторы ничего не доказывают — проблема возникает именно при параллельных вызовах. Тест: <code>Promise.all</code> на 50 одинаковых вебхуков, проверка что обработка произошла ровно один раз.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-pg-concurrency" class="section">
  <div class="section-title">PostgreSQL: изоляция и блокировки</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Уровни изоляции</div>
    <table class="data-table">
      <thead><tr><th>Уровень</th><th>Что видит транзакция</th><th>Цена</th></tr></thead>
      <tbody>
        <tr><td><code>READ COMMITTED</code> — по умолчанию</td><td>Каждый запрос видит закоммиченное на момент <em>своего</em> старта</td><td>Дёшево</td></tr>
        <tr><td><code>REPEATABLE READ</code></td><td>Снимок на всю транзакцию</td><td>При конфликте записи — ошибка сериализации, нужен ретрай</td></tr>
        <tr><td><code>SERIALIZABLE</code></td><td>Как будто транзакции шли по очереди</td><td>Тоже с ретраями, дороже всего</td></tr>
      </tbody>
    </table>
    <div class="remember-box">Для балансов обычно хватает <code>READ COMMITTED</code> плюс явных блокировок строк или атомарных <code>UPDATE</code> с условием. Поднимать изоляцию до <code>SERIALIZABLE</code> ради одного места — дорого и приносит ретраи во всё приложение.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield-alert"></i> Как не допустить двойного списания</div>
<pre><code><span class="c-comment">-- Вариант 1: атомарный UPDATE с условием, затем проверка rowCount</span>
<span class="c-key">UPDATE</span> accounts <span class="c-key">SET</span> balance = balance - $1
<span class="c-key">WHERE</span> id = $2 <span class="c-key">AND</span> balance &gt;= $1;

<span class="c-comment">-- Вариант 2: блокировка строки в транзакции</span>
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> accounts <span class="c-key">WHERE</span> id = $1 <span class="c-key">FOR UPDATE</span>;</code></pre>
    <p class="text">Плюс <strong>идемпотентность операции по ключу</strong>: уникальный индекс на <code>idempotency_key</code>.</p>
    <div class="why-box"><strong>Почему вариант 1 безопасен без явной блокировки.</strong> <code>UPDATE</code> в Postgres сам берёт блокировку строки, а условие <code>balance &gt;= $1</code> проверяется уже на заблокированной строке. Если денег не хватило, обновится ноль строк — и это надо проверить по <code>rowCount</code>, иначе списание «пройдёт» молча.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="copy-x"></i> Ловля дублей и SKIP LOCKED</div>
<pre><code><span class="c-comment">-- Нарушение уникальности в Postgres = код 23505</span>
<span class="c-comment">-- Либо ловим его, либо:</span>
<span class="c-key">INSERT INTO</span> processed_events (event_id) <span class="c-key">VALUES</span> ($1)
<span class="c-key">ON CONFLICT</span> (event_id) <span class="c-key">DO NOTHING</span> <span class="c-key">RETURNING</span> event_id;
<span class="c-comment">-- Вернулась строка → обрабатываем впервые. Пусто → уже обработано.</span></code></pre>
<pre><code><span class="c-comment">-- SKIP LOCKED: берём строку и блокируем, занятые другими — пропускаем</span>
<span class="c-key">SELECT</span> id <span class="c-key">FROM</span> jobs
<span class="c-key">WHERE</span> status = <span class="c-str">'pending'</span> <span class="c-key">AND</span> run_at &lt;= now()
<span class="c-key">ORDER BY</span> id
<span class="c-key">FOR UPDATE SKIP LOCKED</span>
<span class="c-key">LIMIT</span> <span class="c-num">1</span>;</code></pre>
    <div class="remember-box">На <code>SKIP LOCKED</code> построены <code>pg-boss</code> и <code>graphile-worker</code>. Несколько воркеров разбирают одну таблицу задач без конфликтов и без двойной обработки — без внешнего брокера.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-patterns" class="section">
  <div class="section-title">Паттерны надёжности</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="webhook"></i> Идемпотентная обработка вебхука</div>
    <p class="text">Платёжные провайдеры доставляют вебхуки <em>как минимум один раз</em>: повторы при таймауте — норма, а не сбой. Обработчик обязан быть идемпотентным.</p>
<pre><code>@<span class="c-fn">Injectable</span>()
<span class="c-key">export class</span> <span class="c-type">PaymentsService</span> {
  <span class="c-fn">constructor</span>(
    <span class="c-key">private readonly</span> ds: <span class="c-type">DataSource</span>,
    <span class="c-key">private readonly</span> ledger: <span class="c-type">LedgerService</span>,
  ) {}

  <span class="c-key">async</span> <span class="c-fn">applyEvent</span>(evt: <span class="c-type">PspEvent</span>): <span class="c-type">Promise</span>&lt;<span class="c-key">void</span>&gt; {
    <span class="c-key">await</span> <span class="c-key">this</span>.ds.<span class="c-fn">transaction</span>(<span class="c-key">async</span> (m) =&gt; {

      <span class="c-comment">// 1. Дедупликация: второй такой же вебхук ничего не вставит</span>
      <span class="c-key">const</span> fresh = <span class="c-key">await</span> m.<span class="c-fn">query</span>(
        `INSERT INTO processed_events (event_id) VALUES ($1)
         ON CONFLICT (event_id) DO NOTHING RETURNING event_id`,
        [evt.id],
      );
      <span class="c-key">if</span> (fresh.length === <span class="c-num">0</span>) <span class="c-key">return</span>;   <span class="c-comment">// уже обработан</span>

      <span class="c-comment">// 2. Блокируем заказ — параллельный вебхук подождёт</span>
      <span class="c-key">const</span> order = <span class="c-key">await</span> m.<span class="c-fn">findOneOrFail</span>(<span class="c-type">Order</span>, {
        where: { id: evt.orderId },
        lock: { mode: <span class="c-str">'pessimistic_write'</span> },
      });
      <span class="c-key">if</span> (order.status !== <span class="c-str">'pending'</span>) <span class="c-key">return</span>;

      order.status = <span class="c-str">'paid'</span>;
      <span class="c-key">await</span> m.<span class="c-fn">save</span>(order);

      <span class="c-comment">// 3. Проводки и задача коммитятся ВМЕСТЕ с оплатой</span>
      <span class="c-key">await</span> <span class="c-key">this</span>.ledger.<span class="c-fn">post</span>(m, [
        { account: <span class="c-str">'psp_clearing'</span>, debit: evt.amountMinor },
        { account: <span class="c-str">'revenue'</span>,      credit: evt.amountMinor },
      ]);
      <span class="c-key">await</span> m.<span class="c-fn">insert</span>(<span class="c-type">Job</span>, { type: <span class="c-str">'deliver_key'</span>, orderId: order.id });
    });
  }
}</code></pre>
    <div class="remember-box">Три защиты работают слоями: <strong>уникальный индекс</strong> отсекает повтор события, <strong>блокировка строки</strong> упорядочивает параллельные обработчики, <strong>проверка статуса</strong> ловит логически неприменимые переходы.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="timer-off"></i> Таймаут внешнего сервиса</div>
<pre><code><span class="c-key">async</span> <span class="c-fn">requestKey</span>(orderId: <span class="c-key">string</span>, requestId: <span class="c-key">string</span>) {
  <span class="c-key">try</span> {
    <span class="c-key">const</span> res = <span class="c-key">await</span> <span class="c-fn">fetch</span>(`${<span class="c-key">this</span>.baseUrl}/keys`, {
      method: <span class="c-str">'POST'</span>,
      headers: {
        <span class="c-str">'Content-Type'</span>: <span class="c-str">'application/json'</span>,
        <span class="c-str">'Idempotency-Key'</span>: requestId,
      },
      body: <span class="c-type">JSON</span>.<span class="c-fn">stringify</span>({ orderId }),
      signal: <span class="c-type">AbortSignal</span>.<span class="c-fn">timeout</span>(<span class="c-num">5_000</span>),
    });
    <span class="c-key">if</span> (!res.ok) <span class="c-key">return</span> { status: <span class="c-str">'error'</span>, code: res.status };
    <span class="c-key">return</span> { status: <span class="c-str">'ok'</span>, key: (<span class="c-key">await</span> res.<span class="c-fn">json</span>()).key };
  } <span class="c-key">catch</span> (e) {
    <span class="c-comment">// Таймаут НЕ значит отказ: операция могла пройти.</span>
    <span class="c-key">if</span> (e <span class="c-key">instanceof</span> <span class="c-type">Error</span> &amp;&amp; e.name === <span class="c-str">'TimeoutError'</span>) {
      <span class="c-key">return</span> { status: <span class="c-str">'unknown'</span> };
    }
    <span class="c-key">throw</span> e;
  }
}</code></pre>
    <div class="pitfall"><strong>Таймаут — это «не знаю», а не «нет».</strong> Запрос мог дойти и выполниться, а оборвался только ответ. Трактовать таймаут как отказ и повторять операцию <em>без</em> ключа идемпотентности — прямой путь к двойной выдаче. Поэтому статус <code>unknown</code>, ретрай с <strong>тем же</strong> <code>Idempotency-Key</code> и сверка.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="scale"></i> Double-entry ledger</div>
    <p class="text">Баланс не хранится изменяемым числом, а <strong>считается из проводок</strong>. Каждая операция — набор проводок, где сумма дебетов равна сумме кредитов; иначе транзакция не коммитится.</p>
    <table class="data-table">
      <thead><tr><th>Правило</th><th>Зачем</th></tr></thead>
      <tbody>
        <tr><td>Суммы в минорных единицах (<code>bigint</code>)</td><td>Никаких <code>float</code> для денег</td></tr>
        <tr><td>Проводки не изменяются и не удаляются</td><td>История неизменна и проверяема</td></tr>
        <tr><td>Возврат — <strong>новая обратная проводка</strong></td><td>Не правка старой записи</td></tr>
        <tr><td>Сверка</td><td>Ищет заказы «оплачен, но не выдан» и расхождения с выпиской провайдера</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shuffle"></i> События приходят не по порядку</div>
    <div class="pitfall"><strong>Что если refund придёт раньше payment.</strong> Вебхуки не гарантируют порядок. Решение — <strong>машина состояний</strong> заказа с допустимыми переходами. Событие, которое пока нельзя применить, <em>сохраняется и обрабатывается позже</em> (или ставится в очередь с задержкой), а не отбрасывается. Сверка работает страховкой на случай, если что-то всё же потерялось.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-pitfalls" class="section">
  <div class="section-title">Подводные камни</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Node.js</div>
    <div class="pitfall"><strong>Синхронная работа в обработчике.</strong> Блокирует не один запрос, а весь процесс со всеми соединениями.</div>
    <div class="pitfall"><strong>Промис без <code>catch</code>.</strong> <code>unhandledRejection</code> в современных версиях Node роняет процесс.</div>
    <div class="pitfall"><strong>Продолжение работы после <code>uncaughtException</code>.</strong> Состояние процесса неопределённо — только логирование и выход.</div>
    <div class="pitfall"><strong>Кеш без лимита.</strong> В долгоживущем процессе любая несбрасываемая <code>Map</code> — утечка.</div>
    <div class="pitfall"><strong>Игнор backpressure.</strong> <code>write()</code> вернул <code>false</code>, а мы пишем дальше — данные копятся в памяти.</div>
  </div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="boxes"></i> NestJS</div>
    <div class="pitfall"><strong>Запрос в транзакции мимо <code>manager</code>.</strong> Уйдёт по другому соединению и окажется вне транзакции — без единой ошибки.</div>
    <div class="pitfall"><strong>REQUEST-scope, протёкший вверх.</strong> Один такой провайдер делает request-scoped всю цепочку, которая его использует.</div>
    <div class="pitfall"><strong><code>forwardRef</code> как норма.</strong> Лечит симптом циклической зависимости, но означает неверную границу модулей.</div>
    <div class="pitfall"><strong><code>ValidationPipe</code> без <code>whitelist</code>.</strong> Лишние поля из тела запроса доедут до сервиса и до ORM.</div>
    <div class="pitfall"><strong>Отсутствие <code>enableShutdownHooks</code>.</strong> Контейнер убьёт воркер посреди транзакции.</div>
  </div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> Конкурентность</div>
    <div class="pitfall"><strong><code>UPDATE ... WHERE balance &gt;= $1</code> без проверки <code>rowCount</code>.</strong> Списание не произошло, а код считает, что прошло.</div>
    <div class="pitfall"><strong>Таймаут трактуется как отказ.</strong> Повтор без ключа идемпотентности даёт двойную выдачу.</div>
    <div class="pitfall"><strong>Очередь в Redis, а платёж в Postgres.</strong> Между двумя коммитами есть окно, в котором задача теряется.</div>
    <div class="pitfall"><strong>Тест идемпотентности последовательными повторами.</strong> Ничего не проверяет — нужен <code>Promise.all</code> на параллельные одинаковые запросы.</div>
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
