@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laravel — продвинутый разбор</title>
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
.pitfall{background:#FFF3F5;border-left:4px solid #D0404E;border-radius:var(--radius);padding:12px 14px;margin-bottom:12px;font-size:13px;line-height:1.7;color:#7B1C2A;}
.pitfall strong{color:#430B14;font-weight:700;}
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:18px 20px;margin-bottom:14px;box-shadow:var(--shadow);}
.card h3{font-size:14px;font-weight:700;color:var(--text);margin-bottom:8px;display:flex;align-items:center;gap:8px;}
.card h3 code{font-family:'JetBrains Mono','Fira Code',Consolas,monospace;font-size:13px;background:var(--primary-light);color:var(--primary);padding:2px 8px;border-radius:5px;border:none;}
pre{background:var(--code-bg);border:1px solid var(--code-border);border-radius:var(--radius);padding:16px 18px;overflow-x:auto;margin-bottom:14px;font-size:12.5px;line-height:1.7;}
pre code{color:#ABB2BF;font-family:'JetBrains Mono','Fira Code',Consolas,monospace;}
.c-comment{color:#5C6370;}.c-key{color:#C678DD;}.c-str{color:#98C379;}.c-fn{color:#61AFEF;}.c-var{color:#E5C07B;}.c-type{color:#E06C75;}.c-num{color:#D19A66;}
.data-table{width:100%;border-collapse:collapse;margin-bottom:16px;font-size:13px;}
.data-table th{background:var(--bg);padding:10px 14px;text-align:left;font-weight:700;font-size:11px;text-transform:uppercase;letter-spacing:0.5px;color:var(--text2);border-bottom:1px solid var(--border);}
.data-table td{padding:10px 14px;border-bottom:1px solid var(--border);color:var(--text2);vertical-align:top;}
.data-table td strong{color:var(--text);font-weight:600;}
.data-table tr:last-child td{border-bottom:none;}
ul.bullets{margin:8px 0 14px 22px;color:var(--text2);font-size:13px;line-height:1.85;}
ul.bullets li{margin-bottom:4px;}
ul.bullets strong{color:var(--text);}

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
  <div class="sidebar-title">Laravel</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">Ядро</div>
  <a class="nav-item" onclick="showSection('lifecycle',this)"><i data-lucide="rotate-cw"></i> Request Lifecycle</a>
  <a class="nav-item" onclick="showSection('routing',this)"><i data-lucide="route"></i> Routing</a>
  <a class="nav-item" onclick="showSection('middleware',this)"><i data-lucide="filter"></i> Middleware</a>
  <a class="nav-item" onclick="showSection('validation',this)"><i data-lucide="check-circle"></i> Validation &amp; FormRequest</a>

  <div class="nav-group-label">Данные</div>
  <a class="nav-item" onclick="showSection('eloquent',this)"><i data-lucide="database"></i> Eloquent (базовое)</a>
  <a class="nav-item" onclick="showSection('cache',this)"><i data-lucide="zap"></i> Cache</a>

  <div class="nav-group-label">Асинхронность</div>
  <a class="nav-item" onclick="showSection('queues',this)"><i data-lucide="list-checks"></i> Queues</a>
  <a class="nav-item" onclick="showSection('events',this)"><i data-lucide="activity"></i> Events &amp; Listeners</a>
  <a class="nav-item" onclick="showSection('scheduler',this)"><i data-lucide="calendar-clock"></i> Scheduler</a>

  <div class="nav-group-label">Безопасность</div>
  <a class="nav-item" onclick="showSection('auth',this)"><i data-lucide="key"></i> Auth, Gates &amp; Policies</a>

  <div class="nav-group-label">Производительность</div>
  <a class="nav-item" onclick="showSection('octane',this)"><i data-lucide="rocket"></i> Octane / long-running</a>

  <div class="nav-group-label">Применение</div>
  <a class="nav-item" onclick="showSection('practice',this)"><i data-lucide="hammer"></i> Практика</a>
  <a class="nav-item" onclick="showSection('pitfalls',this)"><i data-lucide="alert-octagon"></i> Подводные камни</a>
  <a class="nav-item" onclick="showSection('interview',this)"><i data-lucide="brain"></i> На собеседование</a>
</div>

<div class="main">
<div class="page-header">
  <h1>Laravel</h1>
  <p>Цикл запроса, роутинг, middleware, валидация, Eloquent, кеш, очереди, события, scheduler, авторизация, Octane и long-running окружения. Глубокий middle/senior разбор с примерами и pitfalls каждого механизма.</p>
  <div class="badge-row">
    <span class="badge">Laravel 11/12</span>
    <span class="badge">Eloquent</span>
    <span class="badge">Queues</span>
    <span class="badge">Octane</span>
    <span class="badge badge-success">Middle / Senior</span>
  </div>
</div>

<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>
  <p class="text">Laravel — фреймворк, чьё освоение в глубину занимает годы. Поверхностное знание (роуты, контроллеры, миграции) хватает на CRUD'ы, но любая нетривиальная задача — расширяемый модуль, тонкая авторизация, надёжная асинхронность, Octane-окружение — требует понимания, как фреймворк устроен изнутри. Этот раздел даёт средне-старший уровень: что происходит при HTTP-запросе, как middleware вмешивается в pipeline, как очереди гарантируют доставку, чем gate отличается от policy, и какие ловушки ждут в long-running режиме.</p>

  <div class="info-box primary">
    <strong>Что разбирается:</strong>
    <ul class="bullets" style="margin-top:6px;margin-bottom:0;color:#404357;">
      <li>Полный цикл HTTP-запроса от <code>public/index.php</code> до response;</li>
      <li>Routing с привязкой моделей, scoped bindings, route caching;</li>
      <li>Middleware: handle/terminate, parameters, groups, before/after;</li>
      <li>Eloquent (базовое; deep — в KB_12), Cache c тегами и locks;</li>
      <li>Queues: драйверы, retry, batching, chains, rate limiting, race conditions;</li>
      <li>Events &amp; Listeners, Scheduler с overlapping и withoutOverlapping;</li>
      <li>Auth: guards, providers, gates и policies, before-хуки;</li>
      <li>Octane: state leaks, request-scope, что ломается и как лечить.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Пререквизиты</div>
    <ul class="bullets">
      <li>KB_1 — PHP OOP, конструкторы, интерфейсы;</li>
      <li>KB_2 — SQL и индексы (для Eloquent и Queues на БД-драйвере);</li>
      <li>Поверхностное знакомство с Laravel — что такое контроллер, миграция, фабрика.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map"></i> Связь с другими разделами</div>
    <table class="data-table">
      <tr><th>Тема</th><th>Где глубокий разбор</th></tr>
      <tr><td>Service Container, DI, providers</td><td>KB_13</td></tr>
      <tr><td>Eloquent advanced (полиморфизм, observers, race)</td><td>KB_12</td></tr>
      <tr><td>Хелперы и фасады</td><td>KB_10</td></tr>
      <tr><td>Наследование Controller/Model/FormRequest</td><td>KB_9</td></tr>
      <tr><td>Тестирование Laravel-приложений</td><td>KB_6 + KB_14</td></tr>
    </table>
  </div>
</div>

<div id="sec-lifecycle" class="section">
  <div class="section-title">Request Lifecycle</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Понимание цикла запроса — основа диагностики любого «магического» поведения Laravel. От ошибки 500 до неожиданного middleware-эффекта: всё лечится тем, что разработчик знает, в какой момент запускается какая часть фреймворка. Цикл одинаков и для классического PHP-FPM, и (с оговорками) для Octane — отличие в том, что в Octane bootstrap-фаза происходит один раз на процесс, а не на запрос.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="terminal"></i> Что такое «Bootstrap»</div>
    <p class="text"><strong>Bootstrap</strong> = «загрузка / инициализация». Термин из идиомы <em>«pull yourself up by your bootstraps»</em> — «поднять себя за шнурки собственных ботинок». В контексте фреймворка это код, который выполняется <strong>до того</strong>, как приложение начнёт обрабатывать запрос.</p>
    <p class="text">Bootstrap собирает объект <code>Application</code> (DI-контейнер), регистрирует сервис-провайдеры, читает конфиги, вешает middleware — и только потом отдаёт управление роутеру.</p>
    <p class="text"><strong>Точка входа:</strong> <code>public/index.php</code> → подключает <code>bootstrap/app.php</code> → получает готовое приложение → <code>$app-&gt;handle($request)</code>.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-code"></i> Пример <code>bootstrap/app.php</code> (Laravel 11+)</div>
    <p class="text">С Laravel 11 конфигурация приложения переехала из <code>app/Http/Kernel.php</code>, <code>app/Console/Kernel.php</code> и <code>app/Exceptions/Handler.php</code> в один декларативный файл <code>bootstrap/app.php</code>.</p>
    <pre><code><span class="c-key">return</span> <span class="c-type">Application</span>::<span class="c-fn">configure</span>(<span class="c-var">basePath</span>: <span class="c-fn">dirname</span>(<span class="c-fn">__DIR__</span>))
    -&gt;<span class="c-fn">withRouting</span>(
        <span class="c-var">web</span>:      <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/web.php'</span>,
        <span class="c-var">api</span>:      <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/api.php'</span>,
        <span class="c-var">commands</span>: <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/console.php'</span>,
        <span class="c-var">health</span>:   <span class="c-str">'/up'</span>,
    )
    -&gt;<span class="c-fn">withMiddleware</span>(<span class="c-key">function</span> (<span class="c-type">Middleware</span> <span class="c-var">$middleware</span>) {
        <span class="c-var">$middleware</span>-&gt;<span class="c-fn">append</span>(<span class="c-type">EnsureUserIsActive</span>::<span class="c-key">class</span>);
        <span class="c-var">$middleware</span>-&gt;<span class="c-fn">alias</span>([<span class="c-str">'admin'</span> =&gt; <span class="c-type">AdminOnly</span>::<span class="c-key">class</span>]);
    })
    -&gt;<span class="c-fn">withExceptions</span>(<span class="c-key">function</span> (<span class="c-type">Exceptions</span> <span class="c-var">$exceptions</span>) {
        <span class="c-var">$exceptions</span>-&gt;<span class="c-fn">render</span>(<span class="c-key">function</span> (<span class="c-type">ApiException</span> <span class="c-var">$e</span>) {
            <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>([<span class="c-str">'error'</span> =&gt; <span class="c-var">$e</span>-&gt;<span class="c-fn">getMessage</span>()], <span class="c-num">422</span>);
        });
    })
    -&gt;<span class="c-fn">create</span>();</code></pre>

    <div class="subsection-title" style="margin-top:14px"><i data-lucide="check-square"></i> Что тут происходит</div>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Что настраивает</th></tr></thead>
      <tbody>
        <tr><td><code>configure(basePath: ...)</code></td><td>Стартует построение <code>Application</code>. <code>basePath</code> — корень проекта.</td></tr>
        <tr><td><code>withRouting</code></td><td>Пути к файлам маршрутов: <code>web</code> (с сессией/CSRF), <code>api</code> (без), <code>commands</code> (artisan). <code>health: '/up'</code> — авто-эндпоинт для healthcheck.</td></tr>
        <tr><td><code>withMiddleware</code></td><td>Регистрирует глобальные middleware, группы и алиасы. Пример: <code>append()</code> добавляет в конец глобального стека; <code>alias()</code> создаёт короткое имя для роутов.</td></tr>
        <tr><td><code>withExceptions</code></td><td>Кастомная обработка исключений. Пример: <code>ApiException</code> → JSON-ответ 422.</td></tr>
        <tr><td><code>create()</code></td><td>Финализирует и возвращает готовый <code>Application</code>. Дальше его подхватит <code>public/index.php</code>.</td></tr>
      </tbody>
    </table>

    <div class="remember-box">
      <strong>Отличие Laravel 11+ от 10 и ниже:</strong> раньше эти настройки лежали в 3 разных файлах (<code>Http/Kernel.php</code>, <code>Console/Kernel.php</code>, <code>Exceptions/Handler.php</code>). Теперь всё в одном месте — <code>bootstrap/app.php</code> — как декларативная цепочка вызовов.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Этапы цикла</div>
    <div class="card"><h3>1. <code>public/index.php</code> — точка входа</h3><p class="text">Веб-сервер (nginx/Apache/built-in artisan serve) направляет любой URL в <code>public/index.php</code>. Этот файл загружает автозагрузчик Composer и <code>bootstrap/app.php</code>, который создаёт экземпляр <code>Application</code> (наследник IoC-контейнера).</p></div>
    <div class="card"><h3>2. Bootstrap: <code>bootstrap/app.php</code></h3><p class="text">Конфигурируется ядро: список middleware, провайдеров, обработчик исключений, маршруты. В Laravel 11 это стало декларативной API в одном файле (раньше — отдельные классы в <code>app/Http/Kernel.php</code>).</p></div>
    <div class="card"><h3>3. Kernel handle</h3><p class="text"><code>Http\Kernel::handle($request)</code> прогоняет запрос через <code>bootstrappers</code> (загрузка <code>.env</code>, конфига, фасадов, провайдеров) — это происходит <strong>один раз</strong> в начале запроса.</p></div>
    <div class="card"><h3>4. Service Providers: register → boot</h3><p class="text">Все провайдеры сначала проходят <code>register()</code> (только биндинги в контейнер), потом <code>boot()</code> (всё остальное: маршруты, события, фасады, observers). Подробно — в KB_13.</p></div>
    <div class="card"><h3>5. Pipeline: глобальные middleware</h3><p class="text">Запрос идёт через очередь глобальных middleware (TrustProxies, HandleCors, PreventRequestsDuringMaintenance, ValidatePostSize, TrimStrings, ConvertEmptyStringsToNull). Каждый может либо передать запрос дальше, либо вернуть response самостоятельно.</p></div>
    <div class="card"><h3>6. Router: подбор маршрута</h3><p class="text">Router находит маршрут по методу + URL, прогоняет через middleware группы (web/api), затем route-specific middleware. Привязки моделей (route model binding) разрешаются на этом шаге.</p></div>
    <div class="card"><h3>7. Controller / Closure</h3><p class="text">Вызывается обработчик с разрешёнными зависимостями через контейнер. Возвращает <code>Response</code> или то, что фреймворк превратит в Response (массив → JSON, view → HTML, модель → JSON).</p></div>
    <div class="card"><h3>8. Pipeline в обратном порядке + <code>terminate</code></h3><p class="text">Response поднимается обратно по middleware (теперь после <code>$next($request)</code>). После отправки клиенту вызываются <code>terminate</code> у middleware, поддерживающих такую фазу — здесь делается долгая работа (логирование, аналитика), не влияющая на время ответа.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: трассировка запроса</div>
<pre><code><span class="c-comment">// Простой способ увидеть, что происходит — расширить базовый middleware</span>
<span class="c-key">final class</span> <span class="c-type">TraceRequest</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>, <span class="c-type">Closure</span> <span class="c-var">$next</span>): <span class="c-type">Response</span>
    {
        <span class="c-var">$start</span> = <span class="c-fn">microtime</span>(<span class="c-key">true</span>);
        <span class="c-type">Log</span>::<span class="c-fn">debug</span>(<span class="c-str">'request.before'</span>, [<span class="c-str">'url'</span> =&gt; <span class="c-var">$request</span>-&gt;<span class="c-fn">fullUrl</span>()]);

        <span class="c-var">$response</span> = <span class="c-var">$next</span>(<span class="c-var">$request</span>); <span class="c-comment">// уходим в следующий middleware → controller → обратно</span>

        <span class="c-type">Log</span>::<span class="c-fn">debug</span>(<span class="c-str">'request.after'</span>, [
            <span class="c-str">'status'</span>      =&gt; <span class="c-var">$response</span>-&gt;<span class="c-fn">getStatusCode</span>(),
            <span class="c-str">'duration_ms'</span> =&gt; <span class="c-fn">round</span>((<span class="c-fn">microtime</span>(<span class="c-key">true</span>) - <span class="c-var">$start</span>) * <span class="c-num">1000</span>, <span class="c-num">2</span>),
        ]);

        <span class="c-key">return</span> <span class="c-var">$response</span>;
    }

    <span class="c-key">public function</span> <span class="c-fn">terminate</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>, <span class="c-type">Response</span> <span class="c-var">$response</span>): <span class="c-key">void</span>
    {
        <span class="c-comment">// Здесь — после отправки клиенту. Дорогая отправка в аналитику.</span>
        <span class="c-type">Analytics</span>::<span class="c-fn">track</span>(<span class="c-var">$request</span>, <span class="c-var">$response</span>);
    }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Тяжёлая работа в <code>boot()</code> провайдера.</strong> <code>boot()</code> выполняется на каждом запросе. Тяжёлый код (загрузка большого JSON, обращение к API) накапливается. Используйте deferred providers или ленивую инициализацию.</div>
    <div class="pitfall"><strong>2. Глобальный middleware вместо группового.</strong> Если middleware нужен только для web, его регистрация глобально замедлит и API. Используйте middleware groups (<code>web</code>/<code>api</code>).</div>
    <div class="pitfall"><strong>3. <code>terminate</code> без поддержки.</strong> Метод <code>terminate</code> вызывается только если веб-сервер поддерживает <code>fastcgi_finish_request</code> (FPM да; built-in <code>artisan serve</code> — нет). На built-in сервере terminate работает синхронно, удлиняя ответ.</div>
    <div class="pitfall"><strong>4. Подсчёт SQL-запросов в middleware.</strong> Включение <code>DB::enableQueryLog()</code> на проде раздувает память: каждый запрос хранится в массиве до конца запроса.</div>
    <div class="pitfall"><strong>5. <code>config()</code> без <code>config:cache</code>.</strong> Без <code>php artisan config:cache</code> Laravel перечитывает все конфиги с диска на каждом запросе (десятки файлов). На проде <code>config:cache</code> обязателен.</div>
    <div class="pitfall"><strong>6. Логи в <code>storage/logs/laravel.log</code> при больших объёмах.</strong> Один файл, отсутствует ротация по умолчанию — за неделю несколько ГБ. Используйте <code>daily</code> канал или внешний агрегатор.</div>
    <div class="pitfall"><strong>7. Утечка в обработчике exception.</strong> Кастомный <code>Handler::render</code> может вернуть response, но забыть закрыть транзакцию или освободить ресурс. <code>Handler::report</code> и <code>render</code> разделены неспроста: report для логов, render для ответа клиенту.</div>
    <div class="pitfall"><strong>8. Lifecycle в Octane.</strong> Bootstrap-фаза в Octane выполняется один раз на воркер. Состояние, оставленное в singleton'ах между запросами, утечёт. Подробно — в разделе Octane.</div>
  </div>
</div>

<div id="sec-routing" class="section">
  <div class="section-title">Routing</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Router связывает входящий URL с обработчиком. На простом уровне — это таблица «URL → callable». На продвинутом — механизм с route model binding, scoped bindings, route caching, проверкой подписей, привязкой по типам и сложной системой middleware groups. Понимание этих возможностей даёт компактный читаемый routing и предсказуемое поведение под нагрузкой.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Возможности роутера</div>
    <div class="card"><h3>Route model binding (implicit)</h3><p class="text"><code>Route::get('/users/{user}', fn (User $user) =&gt; ...)</code> — Laravel автоматически делает <code>User::find($id)</code> и кидает 404 если нет. По умолчанию ищет по PK; для другого ключа — <code>$user:slug</code> или <code>getRouteKeyName()</code> на модели.</p></div>
    <div class="card"><h3>Explicit binding</h3><p class="text">В <code>RouteServiceProvider::boot</code>: <code>Route::bind('user', fn ($value) =&gt; User::where(...)-&gt;firstOrFail())</code> — кастомная логика разрешения. Полезно для мультитенантности, scope'ов.</p></div>
    <div class="card"><h3>Scoped bindings</h3><p class="text"><code>Route::get('/users/{user}/posts/{post:slug}', ...)-&gt;scopeBindings()</code> — <code>Post</code> ищется в <em>контексте</em> <code>User</code> (через relation). Гарантирует, что <code>/users/1/posts/foo</code> не вернёт пост, принадлежащий другому пользователю.</p></div>
    <div class="card"><h3>Middleware на маршруте/группе</h3><p class="text">Маршрут получает middleware из своей группы (web/api), плюс заявленные через <code>-&gt;middleware('auth')</code>. Порядок: глобальные → групповые → маршрутные. Параметры middleware: <code>auth:sanctum</code>, <code>throttle:60,1</code>.</p></div>
    <div class="card"><h3>Route caching</h3><p class="text"><code>php artisan route:cache</code> компилирует все маршруты в единый PHP-файл — кратно ускоряет startup. Не работает с closure-маршрутами (только контроллеры/инвокабельные классы).</p></div>
    <div class="card"><h3>Signed routes</h3><p class="text"><code>URL::signedRoute('verify', ['user' =&gt; $id])</code> — URL с подписью, защищающей от подмены параметров. Используется для подтверждения email, magic-link login и пр. Middleware <code>signed</code> проверяет.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: scoped bindings vs ручная проверка</div>
<pre><code><span class="c-comment">// ❌ Уязвимо: пользователь может прочитать чужой пост, подменив slug</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/users/{user}/posts/{post:slug}'</span>, <span class="c-key">function</span> (<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-type">Post</span> <span class="c-var">$post</span>) {
    <span class="c-comment">// $post найдётся по любому slug, не обязательно у $user</span>
    <span class="c-key">return</span> <span class="c-var">$post</span>;
});

<span class="c-comment">// ✓ Безопасно: scoped binding ищет post через $user-&gt;posts()</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/users/{user}/posts/{post:slug}'</span>, <span class="c-key">function</span> (<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-type">Post</span> <span class="c-var">$post</span>) {
    <span class="c-key">return</span> <span class="c-var">$post</span>;
})-&gt;<span class="c-fn">scopeBindings</span>();
<span class="c-comment">// Если post.slug существует, но не принадлежит $user — 404 автоматически</span>
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Closure-маршруты ломают <code>route:cache</code>.</strong> На проде с кешем закрытий routing не закешируется. Используйте контроллеры или invokable классы.</div>
    <div class="pitfall"><strong>2. Конфликт маршрутов.</strong> <code>/users/{user}</code> и <code>/users/me</code> — первый поймает <code>me</code> как параметр. Объявляйте конкретные маршруты <strong>раньше</strong> параметризованных.</div>
    <div class="pitfall"><strong>3. Implicit binding без <code>findOrFail</code>.</strong> Если параметр маршрута не существует, Laravel вернёт 404 автоматически. Но если в кастомной логике написать <code>where(...)-&gt;first()</code> — может вернуть null. Используйте <code>firstOrFail</code>.</div>
    <div class="pitfall"><strong>4. Подписанные ссылки без таймаута.</strong> <code>signedRoute</code> без <code>temporarySignedRoute</code> валиден вечно. Для magic-link нужен короткий expiry (15 минут).</div>
    <div class="pitfall"><strong>5. Throttle без identifier.</strong> <code>throttle:60,1</code> без указания ключа ограничивает по IP. За NAT пользователь может «съесть» лимит для всех. Используйте throttle на user_id для аутентифицированных.</div>
    <div class="pitfall"><strong>6. Группа maintenance в route файле.</strong> Если включить <code>php artisan down</code>, доступ к маршрутам блокируется. Исключения — через <code>--secret</code> и middleware <code>preventDuringMaintenance</code>.</div>
    <div class="pitfall"><strong>7. Cross-route data leakage.</strong> Использование <code>request()-&gt;input(...)</code> вместо параметров маршрута: значение тянется из тела, query или route — приоритет неочевиден. Явно типизируйте через FormRequest.</div>
    <div class="pitfall"><strong>8. <code>fallback</code> ловит всё.</strong> <code>Route::fallback(...)</code> срабатывает на любой не-matched URL. Если в нём опечатка в check'е — пользователь может попасть на код, не предназначенный для публичного доступа.</div>
  </div>
</div>

<div id="sec-middleware" class="section">
  <div class="section-title">Middleware</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Middleware — слой между HTTP-запросом и обработчиком. Каждый middleware может: (а) изменить запрос, (б) вернуть ответ напрямую (не доходя до controller), (в) вмешаться в response после controller, (г) сделать дорогую работу после отправки ответа (<code>terminate</code>). Это основа кросс-cutting concerns: аутентификация, CORS, rate limiting, логирование, локализация.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Виды и порядок</div>
    <div class="card"><h3>Global</h3><p class="text">Применяются ко всем запросам. Регистрируются в <code>bootstrap/app.php</code> (Laravel 11+) или <code>app/Http/Kernel.php::$middleware</code>. Типичные: <code>TrustProxies</code>, <code>HandleCors</code>, <code>TrimStrings</code>.</p></div>
    <div class="card"><h3>Group (web / api)</h3><p class="text">Применяются ко всем маршрутам группы. <code>web</code>: session, CSRF, cookies. <code>api</code>: throttle, без session. Группы кастомизируются через <code>$middlewareGroups</code>.</p></div>
    <div class="card"><h3>Route-specific</h3><p class="text">Через <code>-&gt;middleware(['auth', 'verified'])</code> или alias <code>-&gt;middleware('auth:sanctum')</code>. Aliases объявляются в <code>$middlewareAliases</code>.</p></div>
    <div class="card"><h3>Параметризованный middleware</h3><p class="text"><code>throttle:60,1</code> — middleware <code>ThrottleRequests</code> с параметрами 60 запросов в 1 минуту. Параметры приходят в <code>handle($request, $next, ...$params)</code>.</p></div>
    <div class="card"><h3><code>terminate</code></h3><p class="text">Метод вызывается <em>после</em> отправки response клиенту. Здесь дорогая работа (логи в БД, отправка метрик), не влияющая на TTFB. Работает только под FPM с <code>fastcgi_finish_request</code>.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: middleware с проверкой и логированием</div>
<pre><code><span class="c-key">final class</span> <span class="c-type">EnsureFeatureEnabled</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>, <span class="c-type">Closure</span> <span class="c-var">$next</span>, <span class="c-key">string</span> <span class="c-var">$feature</span>): <span class="c-type">Response</span>
    {
        <span class="c-key">if</span> (! <span class="c-type">Features</span>::<span class="c-fn">enabled</span>(<span class="c-var">$feature</span>, <span class="c-var">$request</span>-&gt;<span class="c-fn">user</span>())) {
            <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>([<span class="c-str">'error'</span> =&gt; <span class="c-str">'Feature disabled'</span>], <span class="c-num">403</span>);
        }
        <span class="c-key">return</span> <span class="c-var">$next</span>(<span class="c-var">$request</span>);
    }
}

<span class="c-comment">// Маршрут</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/beta'</span>, <span class="c-type">BetaController</span>::<span class="c-key">class</span>)
    -&gt;<span class="c-fn">middleware</span>(<span class="c-str">'feature:beta-dashboard'</span>);
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Изменение request в <code>handle</code>.</strong> <code>$request-&gt;merge(['foo' =&gt; 'bar'])</code> работает, но следующие middleware и controller получат изменённый объект. Это может ломать тесты, ожидающие исходный запрос.</div>
    <div class="pitfall"><strong>2. Возврат response из <code>handle</code> без <code>$next</code>.</strong> Если middleware вернул response, дальнейшие middleware и controller не выполняются — это используется для редиректов, авторизации. Удобно, но легко создать «невидимый» branch в логике.</div>
    <div class="pitfall"><strong>3. <code>terminate</code> на built-in сервере.</strong> <code>php artisan serve</code> не поддерживает <code>fastcgi_finish_request</code> — terminate работает синхронно, удлиняя ответ.</div>
    <div class="pitfall"><strong>4. Порядок middleware.</strong> Глобальные → групповые → маршрутные. Внутри каждой категории — в порядке объявления. <code>throttle</code> перед <code>auth</code> — IP-throttle; после <code>auth</code> — user-throttle.</div>
    <div class="pitfall"><strong>5. Middleware без типизированного <code>$request</code>.</strong> <code>$request</code> может быть <code>Symfony\HttpFoundation\Request</code> или <code>Illuminate\Http\Request</code>. Типизируйте <code>Request</code> для доступа к Laravel-методам.</div>
    <div class="pitfall"><strong>6. CSRF и AJAX.</strong> JS-фреймворки отправляют CSRF через заголовок <code>X-CSRF-TOKEN</code> или <code>X-XSRF-TOKEN</code>. Без него POST/PUT/DELETE возвращают 419.</div>
    <div class="pitfall"><strong>7. Middleware ловит session, для API не нужно.</strong> <code>StartSession</code> в API-группе — лишняя нагрузка. По умолчанию в группе <code>api</code> session отключена; если включили — выключите.</div>
    <div class="pitfall"><strong>8. Утечка состояния в Octane.</strong> Middleware-инстанс переиспользуется между запросами в Octane. Свойства middleware с per-request состоянием утекут. Не храните состояние; всё — через параметры handle.</div>
  </div>
</div>

<div id="sec-validation" class="section">
  <div class="section-title">Validation и FormRequest</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Валидация — первая линия защиты данных. Laravel предлагает три уровня: inline (<code>$request-&gt;validate(...)</code>), <code>Validator::make(...)</code>, и FormRequest как отдельный класс. FormRequest — предпочтительный путь для контроллеров: правила, кастомные сообщения, авторизация и подготовка данных собраны в одном месте, контроллер остаётся тонким.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Компоненты FormRequest</div>
    <div class="card"><h3><code>authorize()</code></h3><p class="text">Возвращает bool. Если false — 403 без обращения к контроллеру. Сюда — авторизация на уровне действия (не аутентификация: для неё middleware).</p></div>
    <div class="card"><h3><code>rules()</code></h3><p class="text">Массив правил: ключ — имя поля, значение — pipe-string или массив правил. <code>'email' =&gt; ['required', 'email', Rule::unique('users')-&gt;ignore($this-&gt;user)]</code>. Доступ к маршрутным параметрам — через <code>$this-&gt;route('user')</code>.</p></div>
    <div class="card"><h3><code>messages()</code> и <code>attributes()</code></h3><p class="text">Кастомизация: <code>messages()</code> — переопределение текста; <code>attributes()</code> — человекочитаемые имена полей в сообщениях.</p></div>
    <div class="card"><h3><code>prepareForValidation()</code></h3><p class="text">Хук перед валидацией: можно изменить данные запроса (<code>$this-&gt;merge([...])</code>). Полезно для нормализации (trim, lowercase, конвертация типов).</p></div>
    <div class="card"><h3><code>passedValidation()</code></h3><p class="text">Хук после успешной валидации, перед возвратом в контроллер. Здесь — побочные действия, требующие валидных данных (логирование, dispatch event).</p></div>
    <div class="card"><h3>Доступ к валидным данным</h3><p class="text"><code>$request-&gt;validated()</code> — только валидные поля. <code>$request-&gt;safe()</code> — то же, но с методами <code>only/except/collect</code>. Не используйте <code>$request-&gt;all()</code> в контроллере после валидации — попадут невалидные поля.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: FormRequest с авторизацией и нормализацией</div>
<pre><code><span class="c-key">final class</span> <span class="c-type">UpdateUserRequest</span> <span class="c-key">extends</span> <span class="c-type">FormRequest</span>
{
    <span class="c-key">public function</span> <span class="c-fn">authorize</span>(): <span class="c-key">bool</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">user</span>()-&gt;<span class="c-fn">can</span>(<span class="c-str">'update'</span>, <span class="c-var">$this</span>-&gt;<span class="c-fn">route</span>(<span class="c-str">'user'</span>));
    }

    <span class="c-key">public function</span> <span class="c-fn">prepareForValidation</span>(): <span class="c-key">void</span>
    {
        <span class="c-var">$this</span>-&gt;<span class="c-fn">merge</span>([
            <span class="c-str">'email'</span> =&gt; <span class="c-fn">strtolower</span>(<span class="c-fn">trim</span>(<span class="c-var">$this</span>-&gt;<span class="c-fn">input</span>(<span class="c-str">'email'</span>, <span class="c-str">''</span>))),
        ]);
    }

    <span class="c-key">public function</span> <span class="c-fn">rules</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'email'</span> =&gt; [<span class="c-str">'required'</span>, <span class="c-str">'email'</span>,
                          <span class="c-type">Rule</span>::<span class="c-fn">unique</span>(<span class="c-str">'users'</span>)-&gt;<span class="c-fn">ignore</span>(<span class="c-var">$this</span>-&gt;<span class="c-fn">route</span>(<span class="c-str">'user'</span>))],
            <span class="c-str">'name'</span>  =&gt; [<span class="c-str">'required'</span>, <span class="c-str">'string'</span>, <span class="c-str">'max:255'</span>],
        ];
    }

    <span class="c-key">public function</span> <span class="c-fn">messages</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'email.unique'</span> =&gt; <span class="c-str">'Этот email уже занят'</span>,
        ];
    }
}

<span class="c-comment">// Контроллер — тонкий</span>
<span class="c-key">public function</span> <span class="c-fn">update</span>(<span class="c-type">UpdateUserRequest</span> <span class="c-var">$request</span>, <span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-type">JsonResponse</span>
{
    <span class="c-var">$user</span>-&gt;<span class="c-fn">update</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());
    <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>(<span class="c-var">$user</span>);
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>$request-&gt;all()</code> вместо <code>validated()</code>.</strong> Получите всё, включая невалидные поля. Mass-assignment на модель — потенциальная дыра безопасности.</div>
    <div class="pitfall"><strong>2. <code>required</code> и пустые строки.</strong> <code>required</code> считает пустую строку валидной. Для строгости — <code>required|string|min:1</code>.</div>
    <div class="pitfall"><strong>3. <code>nullable</code> + другие правила.</strong> <code>nullable</code> отключает все последующие правила, если значение null. Без <code>nullable</code> — null приведёт к ошибке валидации.</div>
    <div class="pitfall"><strong>4. <code>sometimes</code> правило.</strong> <code>'name' =&gt; 'sometimes|required|string'</code> — проверять только если поле присутствует. Полезно для PATCH-запросов.</div>
    <div class="pitfall"><strong>5. <code>unique</code> без ignore при update.</strong> Без <code>Rule::unique('users')-&gt;ignore($this-&gt;user)</code> валидация падает на собственном email пользователя.</div>
    <div class="pitfall"><strong>6. Кастомное правило без <code>$fail()</code>.</strong> В Laravel 10+ кастомное правило через invokable использует <code>$fail($message)</code>; забывание этого вызова делает правило всегда проходящим.</div>
    <div class="pitfall"><strong>7. Массивы и dot-notation.</strong> <code>'items.*.sku' =&gt; 'required'</code> валидирует каждый элемент массива. Без <code>*</code> — только наличие массива как поля.</div>
    <div class="pitfall"><strong>8. <code>FormRequest::after()</code>.</strong> Laravel 11+ ввёл <code>after()</code> для дополнительных проверок после правил. Полезно для меж-полевой логики (например, <code>start_date &lt; end_date</code>), которую неудобно выразить простыми правилами.</div>
  </div>
</div>

<div id="sec-eloquent" class="section">
  <div class="section-title">Eloquent — базовое</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Eloquent — реализация Active Record. Модель = таблица; экземпляр модели = строка. Удобство — мгновенный CRUD без boilerplate. Цена — лёгкость написания неоптимальных запросов (N+1, mass assignment) и сильная связанность бизнес-логики с инфраструктурой. Глубокий разбор (полиморфизм, observers, race conditions, chunk vs cursor) — в KB_12. Здесь — основа и базовые паттерны.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Основные возможности</div>
    <div class="card"><h3>Relations: hasOne / hasMany / belongsTo / belongsToMany</h3><p class="text">Decларация связей в модели. Eloquent создаёт магические геттеры (<code>$user-&gt;orders</code>) и query-методы (<code>$user-&gt;orders()</code>). Первое — collection после lazy load, второе — query builder для дальнейшей фильтрации.</p></div>
    <div class="card"><h3>Mass assignment: <code>$fillable</code> / <code>$guarded</code></h3><p class="text"><code>$fillable</code> — whitelist полей для <code>create</code>/<code>update</code> через массив. <code>$guarded = []</code> — открытый список (опасно). Без правильного списка <code>User::create($request-&gt;all())</code> пропустит <code>is_admin</code> в insert.</p></div>
    <div class="card"><h3>Casts</h3><p class="text">Автоматическое приведение типов: <code>'is_active' =&gt; 'boolean'</code>, <code>'meta' =&gt; 'array'</code>, <code>'paid_at' =&gt; 'datetime'</code>. Кастомные касты — реализация интерфейса <code>CastsAttributes</code>.</p></div>
    <div class="card"><h3>Scopes</h3><p class="text"><code>scopeActive($q) { $q-&gt;where('status', 'active'); }</code> — переиспользуемые куски запроса. Использование: <code>User::active()-&gt;get()</code>. Глобальные scopes автоматически применяются ко всем запросам модели.</p></div>
    <div class="card"><h3>Accessors / Mutators</h3><p class="text">Laravel 9+: <code>protected function name(): Attribute { return Attribute::make(get: ..., set: ...); }</code> — преобразование при чтении и записи. Кеш через <code>shouldCache()</code>.</p></div>
    <div class="card"><h3>Observers</h3><p class="text">Хуки жизненного цикла: <code>created</code>, <code>updated</code>, <code>deleted</code>, <code>retrieved</code>. Регистрация в Service Provider. Подробно — в KB_12.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: модель заказа</div>
<pre><code><span class="c-key">final class</span> <span class="c-type">Order</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$fillable</span> = [<span class="c-str">'user_id'</span>, <span class="c-str">'status'</span>, <span class="c-str">'total_minor'</span>, <span class="c-str">'currency'</span>];

    <span class="c-key">protected function</span> <span class="c-fn">casts</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'total_minor'</span> =&gt; <span class="c-str">'integer'</span>,
            <span class="c-str">'paid_at'</span>     =&gt; <span class="c-str">'datetime'</span>,
            <span class="c-str">'meta'</span>        =&gt; <span class="c-type">AsArrayObject</span>::<span class="c-key">class</span>,
        ];
    }

    <span class="c-key">public function</span> <span class="c-fn">user</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">belongsTo</span>(<span class="c-type">User</span>::<span class="c-key">class</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">scopePaid</span>(<span class="c-type">Builder</span> <span class="c-var">$q</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$q</span>-&gt;<span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'paid'</span>)-&gt;<span class="c-fn">whereNotNull</span>(<span class="c-str">'paid_at'</span>);
    }

    <span class="c-key">protected function</span> <span class="c-fn">totalMajor</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">get</span>(<span class="c-key">fn</span> () =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">total_minor</span> / <span class="c-num">100</span>);
    }
}

<span class="c-comment">// Использование</span>
<span class="c-type">Order</span>::<span class="c-fn">paid</span>()-&gt;<span class="c-fn">where</span>(<span class="c-str">'currency'</span>, <span class="c-str">'USD'</span>)-&gt;<span class="c-fn">with</span>(<span class="c-str">'user'</span>)-&gt;<span class="c-fn">get</span>();
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>$guarded = []</code> в проде.</strong> Открывает все колонки для mass assignment. <code>User::create($request-&gt;all())</code> пропустит <code>is_admin</code> в insert. Используйте явный <code>$fillable</code>.</div>
    <div class="pitfall"><strong>2. <code>save()</code> на свежей коллекции.</strong> <code>$orders = $user-&gt;orders; $orders-&gt;each(fn($o) =&gt; $o-&gt;save())</code> — N запросов вместо одного. Используйте <code>$user-&gt;orders()-&gt;update([...])</code>.</div>
    <div class="pitfall"><strong>3. <code>relation</code> vs <code>relation()</code>.</strong> <code>$user-&gt;orders</code> — collection (lazy-loaded). <code>$user-&gt;orders()</code> — query builder. Путаница приводит к лишним запросам или ошибкам.</div>
    <div class="pitfall"><strong>4. <code>updated_at</code> при <code>update</code> массивом.</strong> Laravel автоматически обновит <code>updated_at</code>. Если нужно избежать (миграция данных) — <code>$model-&gt;timestamps = false</code> или <code>DB::table()</code>.</div>
    <div class="pitfall"><strong>5. JSON-каст и dirty detection.</strong> Изменение вложенного значения в JSON: <code>$model-&gt;meta['key'] = 'x'</code> не пометит модель dirty. Используйте <code>AsArrayObject</code> или <code>AsCollection</code>.</div>
    <div class="pitfall"><strong>6. <code>find</code> с массивом не возвращает ошибку.</strong> <code>User::find([1, 2, 99])</code> — вернёт только существующих, без warning'а. Если важно полное соответствие — проверяйте count.</div>
    <div class="pitfall"><strong>7. Tinker и dirty state.</strong> В tinker отредактированная модель не сохраняется автоматически; забыли <code>save()</code> — изменения теряются.</div>
    <div class="pitfall"><strong>8. <code>chunk</code> с <code>update</code>.</strong> <code>User::chunk(100, fn($users) =&gt; $users-&gt;each-&gt;update(...))</code> — после первого chunk PK сдвигается, следующий chunk пропускает строки. Используйте <code>chunkById</code>.</div>
  </div>
</div>

<div id="sec-cache" class="section">
  <div class="section-title">Cache</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Кеш — способ обменять память на CPU/IO. Laravel предлагает единый интерфейс над несколькими бэкендами: <code>file</code>, <code>database</code>, <code>redis</code>, <code>memcached</code>, <code>array</code> (in-memory, для тестов). Понимание различий между бэкендами, паттернов инвалидации и потенциальных race conditions — обязательное знание для middle.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Возможности</div>
    <div class="card"><h3>Базовые операции</h3><p class="text"><code>Cache::put(key, value, ttl)</code>, <code>get</code>, <code>has</code>, <code>forget</code>, <code>increment</code>, <code>decrement</code>. <code>remember(key, ttl, fn() =&gt; ...)</code> — get или compute.</p></div>
    <div class="card"><h3>Tags (только Redis/Memcached)</h3><p class="text"><code>Cache::tags(['users', 'orders'])-&gt;put(...)</code> — групповая инвалидация: <code>Cache::tags(['users'])-&gt;flush()</code>. Не работает с <code>file</code>/<code>database</code> бэкендами.</p></div>
    <div class="card"><h3>Atomic locks</h3><p class="text"><code>Cache::lock('process-order', 10)-&gt;get(fn() =&gt; ...)</code> — распределённая блокировка. Защищает от двух одновременных обработчиков одной задачи. Lock автоматически освобождается через 10 сек.</p></div>
    <div class="card"><h3>Multiple stores</h3><p class="text">В <code>config/cache.php</code> можно объявить несколько стораджей и использовать по имени: <code>Cache::store('redis-fast')-&gt;put(...)</code>. Полезно для разделения горячего и холодного кеша.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: cache stampede</div>
    <p class="text">Cache stampede — ситуация, когда ключ устарел и сразу 100 запросов пытаются его пересоздать одновременно, перегружая БД. Решение — атомарный lock.</p>

<pre><code><span class="c-comment">// ❌ Под нагрузкой — N запросов одновременно регенерируют один ключ</span>
<span class="c-key">return</span> <span class="c-type">Cache</span>::<span class="c-fn">remember</span>(<span class="c-str">'dashboard:stats'</span>, <span class="c-num">300</span>, <span class="c-key">fn</span> () =&gt;
    <span class="c-type">Stats</span>::<span class="c-fn">expensive</span>());

<span class="c-comment">// ✓ Только один запрос регенерирует, остальные ждут</span>
<span class="c-key">return</span> <span class="c-type">Cache</span>::<span class="c-fn">remember</span>(<span class="c-str">'dashboard:stats'</span>, <span class="c-num">300</span>, <span class="c-key">function</span> () {
    <span class="c-key">return</span> <span class="c-type">Cache</span>::<span class="c-fn">lock</span>(<span class="c-str">'lock:dashboard:stats'</span>, <span class="c-num">10</span>)-&gt;<span class="c-fn">block</span>(<span class="c-num">5</span>, <span class="c-key">fn</span> () =&gt;
        <span class="c-type">Stats</span>::<span class="c-fn">expensive</span>());
});
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>Cache::remember</code> и null.</strong> Если callable вернул null, Laravel <em>не</em> кеширует. Каждый запрос пересоздаёт. Используйте <code>rememberForever</code> с sentinel, либо проверяйте на null отдельно.</div>
    <div class="pitfall"><strong>2. Tags с file driver.</strong> <code>Cache::tags(...)</code> на file/database driver выбросит исключение. Проверяйте драйвер или используйте только tags-capable бэкенды.</div>
    <div class="pitfall"><strong>3. Lock не освобождён.</strong> Если процесс упал между захватом lock и выполнением, lock держится до TTL. Сделайте TTL разумным (5-30 сек), не «на всякий случай 5 минут».</div>
    <div class="pitfall"><strong>4. Кеш модели с relations.</strong> Кеширование <code>$user-&gt;with('orders')-&gt;get()</code> в Cache::put — relations сериализуются. При десериализации связи могут не работать корректно. Кешируйте plain данные, не Eloquent-модели.</div>
    <div class="pitfall"><strong>5. Префиксы в Redis.</strong> Несколько приложений на одном Redis-инстансе — конфликт ключей. Указывайте <code>CACHE_PREFIX</code> в <code>.env</code>.</div>
    <div class="pitfall"><strong>6. Cache::flush() в проде.</strong> Сбрасывает <em>всё</em>. На общем Redis с другими приложениями — снесёт чужие данные. Используйте <code>tags()-&gt;flush()</code>.</div>
    <div class="pitfall"><strong>7. <code>session</code>, <code>queue</code>, <code>cache</code> на одном Redis.</strong> Дефолт. Если flush — сбрасываются и сессии, и очереди. Разделяйте по DB index'ам.</div>
    <div class="pitfall"><strong>8. Stale-while-revalidate.</strong> Laravel не имеет встроенного SWR. Реализуется вручную: вернуть устаревший кеш, регенерировать в фоне через job.</div>
  </div>
</div>

<div id="sec-queues" class="section">
  <div class="section-title">Queues</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Очереди — механизм отложенного выполнения задач. Web-запрос ставит job в очередь и возвращает ответ; воркер забирает job и исполняет. Это разгружает HTTP-обработчики, обеспечивает retry при сбоях, позволяет масштабировать воркеры независимо. Понимание драйверов, retry-логики, batching и race conditions — обязательно для всего, что выходит за рамки «отправить письмо».</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Возможности</div>
    <div class="card"><h3>Драйверы</h3><p class="text"><code>sync</code> — исполнение в текущем процессе (тесты). <code>database</code> — таблица jobs в БД (просто, медленно). <code>redis</code> — Redis-list, быстрый. <code>sqs</code>, <code>beanstalkd</code> — внешние.</p></div>
    <div class="card"><h3>Job-классы</h3><p class="text">Класс с <code>handle()</code> методом. Имплементирует <code>ShouldQueue</code>. Свойства: <code>$tries</code>, <code>$timeout</code>, <code>$maxExceptions</code>, <code>$backoff</code>.</p></div>
    <div class="card"><h3>Retry и backoff</h3><p class="text">При исключении job ставится обратно в очередь до <code>$tries</code> раз. <code>$backoff = [10, 30, 60]</code> — задержки между попытками. После исчерпания — таблица <code>failed_jobs</code>.</p></div>
    <div class="card"><h3>Chains, Batches</h3><p class="text">Chain — последовательное исполнение нескольких jobs (если один упал — остальные не идут). Batch — параллельное с финальным callback, когда все завершились (или хотя бы один упал).</p></div>
    <div class="card"><h3>Rate limiting</h3><p class="text"><code>RateLimited::for('api-calls')</code> middleware на job. Откладывает исполнение, если лимит превышен. Защищает от перегрузки внешних API.</p></div>
    <div class="card"><h3>Unique jobs</h3><p class="text"><code>ShouldBeUnique</code> — гарантия, что в очереди не более одного job этого типа с тем же <code>$uniqueId</code>. Защита от двойной постановки.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: job с retry и idempotency</div>
<pre><code><span class="c-key">final class</span> <span class="c-type">SendInvoice</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">use</span> <span class="c-type">Queueable</span>;

    <span class="c-key">public int</span> <span class="c-var">$tries</span>     = <span class="c-num">5</span>;
    <span class="c-key">public int</span> <span class="c-var">$timeout</span>   = <span class="c-num">120</span>;
    <span class="c-key">public array</span> <span class="c-var">$backoff</span> = [<span class="c-num">10</span>, <span class="c-num">30</span>, <span class="c-num">60</span>, <span class="c-num">300</span>];

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">public</span> <span class="c-key">int</span> <span class="c-var">$orderId</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">InvoiceMailer</span> <span class="c-var">$mailer</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">findOrFail</span>(<span class="c-var">$this</span>-&gt;<span class="c-var">orderId</span>);

        <span class="c-comment">// Идемпотентность: если invoice уже отправлен — выходим</span>
        <span class="c-key">if</span> (<span class="c-var">$order</span>-&gt;<span class="c-var">invoice_sent_at</span>) <span class="c-key">return</span>;

        <span class="c-var">$mailer</span>-&gt;<span class="c-fn">send</span>(<span class="c-var">$order</span>);
        <span class="c-var">$order</span>-&gt;<span class="c-fn">update</span>([<span class="c-str">'invoice_sent_at'</span> =&gt; <span class="c-fn">now</span>()]);
    }

    <span class="c-key">public function</span> <span class="c-fn">failed</span>(<span class="c-type">Throwable</span> <span class="c-var">$e</span>): <span class="c-key">void</span>
    {
        <span class="c-comment">// Финальный обработчик после исчерпания retries</span>
        <span class="c-type">Log</span>::<span class="c-fn">error</span>(<span class="c-str">'invoice.failed'</span>, [<span class="c-str">'order_id'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">orderId</span>, <span class="c-str">'error'</span> =&gt; <span class="c-var">$e</span>-&gt;<span class="c-fn">getMessage</span>()]);
    }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Job без идемпотентности.</strong> Retry означает, что handle вызовется N раз при сбоях. Если job отправляет письмо без проверки факта — пользователь получит N писем. Делайте handle идемпотентным.</div>
    <div class="pitfall"><strong>2. Передача Eloquent-модели в job.</strong> Модель сериализуется через <code>SerializesModels</code> — в БД хранится <code>['id' =&gt; 42]</code>, а в handle снова загружается через <code>findOrFail</code>. Если строка удалена между постановкой и исполнением — <code>ModelNotFoundException</code>.</div>
    <div class="pitfall"><strong>3. Транзакция вокруг dispatch.</strong> <code>DB::transaction(fn () =&gt; { ... ; SendInvoice::dispatch($order); })</code> — job отправлен до commit'а; воркер пытается найти order, которого ещё нет в БД. Используйте <code>dispatch()-&gt;afterCommit()</code> или <code>$afterCommit = true</code> в job.</div>
    <div class="pitfall"><strong>4. Долгий handle, превышающий timeout.</strong> Воркер убивает процесс через <code>$timeout</code> сек, job остаётся в БД как «в обработке». В таком случае увеличьте timeout или разбейте на несколько jobs.</div>
    <div class="pitfall"><strong>5. <code>$tries = 0</code>.</strong> Означает «бесконечные попытки». Если job всегда падает, воркер крутится в цикле. Лучше явное число.</div>
    <div class="pitfall"><strong>6. <code>maxExceptions</code> vs <code>tries</code>.</strong> <code>tries</code> — общее число запусков (включая успешные). <code>maxExceptions</code> — только неуспешных. Для jobs, которые часто timeout-ят без exception, нужно следить за обоими.</div>
    <div class="pitfall"><strong>7. Failed jobs без мониторинга.</strong> Таблица <code>failed_jobs</code> копится молча. Без алерта или дашборда (Horizon) проблемы обнаруживаются через жалобы пользователей.</div>
    <div class="pitfall"><strong>8. Воркер без <code>--max-time</code>.</strong> Долгоживущий воркер копит память (особенно в Laravel без Octane). Перезапуск через <code>--max-time=3600</code> освобождает память.</div>
  </div>
</div>

<div id="sec-events" class="section">
  <div class="section-title">Events &amp; Listeners</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">События — механизм слабого связывания: код «эмитит» событие, не зная, кто на него подпишется. Несколько listeners могут реагировать независимо. Это основной способ организации side-effects (отправка письма после регистрации, audit-лог, обновление аналитики) без раздувания основного кода.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Компоненты</div>
    <div class="card"><h3>Event class</h3><p class="text">DTO с публичными свойствами. Имплементирует ничего особого (или <code>ShouldBroadcast</code>, если транслируется). Создание: <code>php artisan make:event OrderPaid</code>.</p></div>
    <div class="card"><h3>Listener class</h3><p class="text">Класс с <code>handle(Event $event)</code>. Может имплементировать <code>ShouldQueue</code> — тогда исполнение асинхронно через очередь. Регистрация — в <code>EventServiceProvider::$listen</code> или через <code>Event::listen(...)</code>.</p></div>
    <div class="card"><h3>Auto-discovery</h3><p class="text">С Laravel 8+ Listeners автоматически обнаруживаются по типу аргумента <code>handle</code>. Включается через <code>$shouldDiscoverEvents</code>. Удобно, но усложняет grep — найти всех слушателей события через явный массив проще.</p></div>
    <div class="card"><h3>Subscriber</h3><p class="text">Класс, объявляющий несколько листенеров через <code>subscribe(Dispatcher $events)</code>. Полезно для группировки логически связанных слушателей.</p></div>
    <div class="card"><h3>Eloquent events</h3><p class="text"><code>created</code>, <code>updated</code>, <code>deleted</code>, <code>retrieved</code> — события моделей. Подписка через observers или <code>static::created(fn ($model) =&gt; ...)</code> в boot модели.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: событие и асинхронный listener</div>
<pre><code><span class="c-comment">// app/Events/OrderPaid.php</span>
<span class="c-key">final class</span> <span class="c-type">OrderPaid</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">public</span> <span class="c-type">Order</span> <span class="c-var">$order</span>) {}
}

<span class="c-comment">// app/Listeners/SendOrderConfirmation.php</span>
<span class="c-key">final class</span> <span class="c-type">SendOrderConfirmation</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">public string</span> <span class="c-var">$queue</span> = <span class="c-str">'mail'</span>;
    <span class="c-key">public int</span> <span class="c-var">$tries</span> = <span class="c-num">3</span>;

    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">OrderPaid</span> <span class="c-var">$event</span>): <span class="c-key">void</span>
    {
        <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$event</span>-&gt;<span class="c-var">order</span>-&gt;<span class="c-fn">user</span>)
            -&gt;<span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">OrderConfirmationMail</span>(<span class="c-var">$event</span>-&gt;<span class="c-var">order</span>));
    }
}

<span class="c-comment">// Эмит из кода</span>
<span class="c-type">OrderPaid</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Eloquent-модель в свойстве event.</strong> При <code>ShouldQueue</code> listener сериализуется через <code>SerializesModels</code> — сохраняется только id. Между dispatch и handle строка может измениться или удалиться.</div>
    <div class="pitfall"><strong>2. <code>Event::fake()</code> в тестах не вызывает listeners.</strong> Если тесту нужно проверить side-effect listener'а — не используйте fake, либо отдельно тестируйте listener.</div>
    <div class="pitfall"><strong>3. Sync listener бросает exception.</strong> Если listener синхронный и упал — основная операция rollback'нется (если в транзакции). Подумайте, нужна ли такая жёсткая связь.</div>
    <div class="pitfall"><strong>4. Auto-discovery и shared classes.</strong> Auto-discovery сканирует <code>app/Listeners</code> и регистрирует всё. Лишние классы (helpers, тесты) могут случайно зарегистрироваться как listeners.</div>
    <div class="pitfall"><strong>5. Listeners в EventServiceProvider не отсортированы.</strong> Порядок исполнения не гарантирован. Если порядок важен — используйте chain через subscriber.</div>
    <div class="pitfall"><strong>6. Eloquent observer + Event listener.</strong> Дублирование. Если observer пишет audit-лог на <code>created</code>, listener на <code>OrderCreated</code> делает то же — два лога. Выберите один уровень.</div>
    <div class="pitfall"><strong>7. <code>Event::dispatch()</code> в job.</strong> Job сам делает <code>SerializesModels</code>. Если event тоже имеет модель — двойная сериализация. Передавайте ids явно.</div>
    <div class="pitfall"><strong>8. Broadcast event без queue.</strong> <code>ShouldBroadcast</code> по умолчанию транслируется синхронно. На большом объёме событий это блокирует. Имплементируйте <code>ShouldBroadcastNow</code> только когда уверены; иначе — оставляйте через очередь.</div>
  </div>
</div>

<div id="sec-scheduler" class="section">
  <div class="section-title">Scheduler</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Laravel scheduler — встроенный планировщик задач, заменяющий ручное редактирование crontab. Один cron-запись (<code>* * * * * php artisan schedule:run</code>) запускает Laravel, который сам решает, что запустить в эту минуту. Это убирает разрыв между приложением и cron-конфигурацией: расписание лежит в коде, версионируется, тестируется.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Возможности</div>
    <div class="card"><h3>Декларация в <code>routes/console.php</code></h3><p class="text">С Laravel 11+ расписание лежит в <code>routes/console.php</code> через <code>Schedule::command(...)-&gt;daily()</code>. До 11 — в <code>App\Console\Kernel::schedule()</code>.</p></div>
    <div class="card"><h3>Периоды и фильтры</h3><p class="text"><code>-&gt;everyMinute()</code>, <code>-&gt;hourly()</code>, <code>-&gt;dailyAt('14:30')</code>, <code>-&gt;weekly()</code>, <code>-&gt;cron('*/5 * * * *')</code>. Фильтры: <code>-&gt;weekdays()</code>, <code>-&gt;between('9:00', '17:00')</code>, <code>-&gt;when(fn () =&gt; ...)</code>.</p></div>
    <div class="card"><h3>withoutOverlapping</h3><p class="text"><code>-&gt;withoutOverlapping(10)</code> — не запускать, если предыдущий ещё не завершился. TTL 10 минут — защита от случая, когда процесс упал и lock не освобождён.</p></div>
    <div class="card"><h3>onOneServer</h3><p class="text">При горизонтальном масштабировании (несколько серверов) job выполняется ровно на одном. Требует драйвер кеша, поддерживающий atomic lock (Redis, Memcached, DB).</p></div>
    <div class="card"><h3>Output handling</h3><p class="text"><code>-&gt;sendOutputTo($file)</code>, <code>-&gt;emailOutputOnFailure($email)</code>. Удобно для разовых отчётов; для регулярного логирования &mdash; внешние агрегаторы.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: расписание для отчётов</div>
<pre><code><span class="c-comment">// routes/console.php</span>
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Schedule</span>;

<span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'reports:daily'</span>)
    -&gt;<span class="c-fn">dailyAt</span>(<span class="c-str">'08:00'</span>)
    -&gt;<span class="c-fn">timezone</span>(<span class="c-str">'Asia/Almaty'</span>)
    -&gt;<span class="c-fn">withoutOverlapping</span>(<span class="c-num">30</span>)
    -&gt;<span class="c-fn">onOneServer</span>()
    -&gt;<span class="c-fn">emailOutputOnFailure</span>(<span class="c-str">'devops@example.com'</span>);

<span class="c-type">Schedule</span>::<span class="c-fn">job</span>(<span class="c-key">new</span> <span class="c-type">CleanupOldExports</span>())
    -&gt;<span class="c-fn">weekly</span>()
    -&gt;<span class="c-fn">sundays</span>()
    -&gt;<span class="c-fn">at</span>(<span class="c-str">'03:00'</span>);
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Cron-запись не настроена.</strong> Без <code>* * * * * php artisan schedule:run</code> в crontab расписание не работает. Заверьте на проде первой проверкой.</div>
    <div class="pitfall"><strong>2. <code>withoutOverlapping</code> без TTL.</strong> Дефолтный TTL — 24 часа. Если процесс упал, lock держится сутки. Указывайте явный таймаут.</div>
    <div class="pitfall"><strong>3. <code>onOneServer</code> на file cache.</strong> File cache локален для сервера — atomic lock не работает между серверами. Используйте Redis.</div>
    <div class="pitfall"><strong>4. <code>->daily()</code> в UTC.</strong> Дефолтная таймзона — <code>app.timezone</code>. Если она UTC, а ожидание «Asia/Almaty 8:00» — расписание сработает в 13:00 по Алматы. Указывайте <code>timezone()</code>.</div>
    <div class="pitfall"><strong>5. Долгие задачи блокируют scheduler.</strong> <code>schedule:run</code> сам по себе быстрый, но <code>->command(...)</code> может занять минуты. Используйте <code>->runInBackground()</code> или <code>->job(...)</code> для постановки в очередь.</div>
    <div class="pitfall"><strong>6. Pingback URL на dead server.</strong> <code>->thenPing('https://hc.example.com/ok')</code> — pingback после успеха. Если URL мёртв (Healthchecks.io не обновлён) — false alarm.</div>
    <div class="pitfall"><strong>7. Тестирование scheduler.</strong> <code>php artisan schedule:run</code> запустит то, что должно запуститься сейчас. Чтобы протестировать без ожидания — <code>schedule:test</code> (Laravel 9+).</div>
    <div class="pitfall"><strong>8. Несколько <code>schedule:run</code> в crontab.</strong> Две записи cron — два процесса каждую минуту. Tasks с <code>withoutOverlapping</code> справятся, без — выполнятся дважды.</div>
  </div>
</div>

<div id="sec-auth" class="section">
  <div class="section-title">Auth, Gates и Policies</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Аутентификация (auth) и авторизация (authorization) — два разных слоя. Auth отвечает «кто этот пользователь». Authorization — «может ли он сделать это действие». Laravel разделяет их явно: guards/providers для аутентификации, gates и policies — для авторизации. Понимание разницы и взаимодействия — основа безопасной архитектуры.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Компоненты</div>
    <div class="card"><h3>Guards</h3><p class="text">Способ аутентификации: <code>session</code>, <code>token</code>, <code>sanctum</code>, <code>passport</code>, кастомный. Один guard на один способ. <code>auth('api')-&gt;user()</code> — пользователь из guard <code>api</code>.</p></div>
    <div class="card"><h3>Providers</h3><p class="text">Источник пользователей: <code>eloquent</code> (модель User), <code>database</code> (таблица напрямую). Гибкость — кастомный провайдер для LDAP, SSO.</p></div>
    <div class="card"><h3>Gates</h3><p class="text">Глобальная функция авторизации: <code>Gate::define('admin-area', fn ($user) =&gt; $user-&gt;is_admin)</code>. Использование: <code>Gate::allows('admin-area')</code>. Для «сквозных» проверок, не привязанных к модели.</p></div>
    <div class="card"><h3>Policies</h3><p class="text">Класс с методами авторизации по модели: <code>UserPolicy::update(User $admin, User $target)</code>. Регистрация — <code>AuthServiceProvider::$policies</code>. Использование: <code>$user-&gt;can('update', $target)</code>.</p></div>
    <div class="card"><h3>Gate::before / after</h3><p class="text">Глобальные хуки: <code>Gate::before(fn ($user) =&gt; $user-&gt;is_root ? true : null)</code> — root проходит везде. Возврат null — продолжать проверку обычным путём.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: policy для модели</div>
<pre><code><span class="c-key">final class</span> <span class="c-type">PostPolicy</span>
{
    <span class="c-key">public function</span> <span class="c-fn">viewAny</span>(<span class="c-key">?</span><span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">bool</span>
    {
        <span class="c-key">return</span> <span class="c-key">true</span>; <span class="c-comment">// публичный список</span>
    }

    <span class="c-key">public function</span> <span class="c-fn">update</span>(<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-type">Post</span> <span class="c-var">$post</span>): <span class="c-key">bool</span>
    {
        <span class="c-key">return</span> <span class="c-var">$user</span>-&gt;<span class="c-var">id</span> === <span class="c-var">$post</span>-&gt;<span class="c-var">user_id</span> || <span class="c-var">$user</span>-&gt;<span class="c-fn">hasRole</span>(<span class="c-str">'editor'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">delete</span>(<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-type">Post</span> <span class="c-var">$post</span>): <span class="c-key">bool</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">update</span>(<span class="c-var">$user</span>, <span class="c-var">$post</span>) &amp;&amp; ! <span class="c-var">$post</span>-&gt;<span class="c-fn">isPublished</span>();
    }
}

<span class="c-comment">// Контроллер</span>
<span class="c-key">public function</span> <span class="c-fn">update</span>(<span class="c-type">UpdatePostRequest</span> <span class="c-var">$request</span>, <span class="c-type">Post</span> <span class="c-var">$post</span>): <span class="c-type">RedirectResponse</span>
{
    <span class="c-var">$this</span>-&gt;<span class="c-fn">authorize</span>(<span class="c-str">'update'</span>, <span class="c-var">$post</span>); <span class="c-comment">// бросит 403 если не разрешено</span>
    <span class="c-var">$post</span>-&gt;<span class="c-fn">update</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());
    <span class="c-key">return</span> <span class="c-fn">redirect</span>(<span class="c-var">$post</span>-&gt;<span class="c-fn">url</span>());
}

<span class="c-comment">// Auto-discovery: policy для Post автоматически находится, если</span>
<span class="c-comment">// PostPolicy лежит в app/Policies/. Иначе — регистрация явно.</span>
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>auth()-&gt;user()</code> возвращает null.</strong> Если запрос не прошёл через <code>auth</code> middleware, <code>user()</code> вернёт null. Code <code>auth()-&gt;user()-&gt;id</code> упадёт. Используйте <code>auth()-&gt;id()</code> или явные проверки.</div>
    <div class="pitfall"><strong>2. Policy <code>before</code> и <code>after</code>.</strong> Можно объявить методы <code>before</code>/<code>after</code> прямо в policy. <code>before</code> возвращает true/false/null — null означает «продолжить обычную проверку».</div>
    <div class="pitfall"><strong>3. Policy с null user (guest).</strong> Если метод принимает <code>?User $user</code> — guest пройдёт. Если просто <code>User</code> — Laravel сразу вернёт false для guest без вызова метода.</div>
    <div class="pitfall"><strong>4. Multiple guards и confusion.</strong> На странице с двумя guards (admin и user) <code>auth()-&gt;user()</code> возьмёт default guard. Уточняйте: <code>auth('admin')-&gt;user()</code>.</div>
    <div class="pitfall"><strong>5. Gate::define после регистрации.</strong> Если <code>Gate::define</code> вызван в <code>register()</code> провайдера — Gate ещё не готов. Только в <code>boot()</code>.</div>
    <div class="pitfall"><strong>6. <code>can</code> на Eloquent-модели.</strong> <code>$user-&gt;can('update', $post)</code> требует, чтобы у User был трейт <code>Authorizable</code> (он есть по умолчанию).</div>
    <div class="pitfall"><strong>7. Policy и lazy loading.</strong> <code>PostPolicy::update($user, $post)</code> может обращаться к <code>$post-&gt;owner</code> — N+1 на странице со списком постов. Eager load relations перед проверкой policy.</div>
    <div class="pitfall"><strong>8. Подмена user в тестах.</strong> <code>actingAs($user)</code> ставит user в default guard. Для API: <code>Sanctum::actingAs($user, ['*'])</code> или <code>actingAs($user, 'api')</code>.</div>
  </div>
</div>

<div id="sec-octane" class="section">
  <div class="section-title">Octane и long-running окружения</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Laravel Octane — обёртка над Swoole / RoadRunner / FrankenPHP, превращающая Laravel в long-running процесс. Bootstrap выполняется один раз на воркер, запросы обрабатываются без переинициализации фреймворка. Это даёт x5-x10 ускорение. Цена — изменение модели жизненного цикла: то, что в PHP-FPM «само очищается» между запросами, в Octane живёт между ними и приводит к утечкам состояния.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Что меняется</div>
    <div class="card"><h3>Singleton переживает запросы</h3><p class="text">В FPM singleton живёт до конца запроса. В Octane — до перезапуска воркера (десятки тысяч запросов). Состояние, накопленное в singleton, утечёт.</p></div>
    <div class="card"><h3>Static-свойства</h3><p class="text">То же: <code>static $cache = []</code> в классе остаётся между запросами. Не используйте static для request-scope данных.</p></div>
    <div class="card"><h3>Scoped bindings</h3><p class="text">Решение для request-scope: <code>$app-&gt;scoped(...)</code> — singleton на запрос, сбрасывается между запросами через <code>Octane::flushApplicationState()</code>.</p></div>
    <div class="card"><h3>Concurrent tasks</h3><p class="text"><code>Octane::concurrently([fn () =&gt; ..., fn () =&gt; ...])</code> — параллельное выполнение в отдельных воркерах. Полезно для агрегации данных из разных источников.</p></div>
    <div class="card"><h3>Ticks</h3><p class="text"><code>Octane::tick('foo', fn () =&gt; ..., 60)</code> — периодическое выполнение раз в N секунд в каждом воркере. Кеш в памяти, прогрев данных.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: безопасный сервис под Octane</div>
<pre><code><span class="c-comment">// ❌ Singleton с request-state — утечка</span>
<span class="c-var">$app</span>-&gt;<span class="c-fn">singleton</span>(<span class="c-type">RequestContext</span>::<span class="c-key">class</span>);

<span class="c-comment">// ✓ Scoped — сбрасывается между запросами</span>
<span class="c-var">$app</span>-&gt;<span class="c-fn">scoped</span>(<span class="c-type">RequestContext</span>::<span class="c-key">class</span>);

<span class="c-comment">// ❌ Static с per-request данными — утечка</span>
<span class="c-key">final class</span> <span class="c-type">UserCache</span>
{
    <span class="c-key">private static array</span> <span class="c-var">$loaded</span> = []; <span class="c-comment">// растёт между запросами</span>
}

<span class="c-comment">// ✓ Зависимость от scoped-кеша или нормального Cache</span>
<span class="c-key">final class</span> <span class="c-type">UserCache</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private</span> <span class="c-type">CacheRepository</span> <span class="c-var">$cache</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">get</span>(<span class="c-key">int</span> <span class="c-var">$id</span>): <span class="c-type">User</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-var">cache</span>-&gt;<span class="c-fn">remember</span>(<span class="c-str">"user:{$id}"</span>, <span class="c-num">300</span>, <span class="c-key">fn</span> () =&gt; <span class="c-type">User</span>::<span class="c-fn">findOrFail</span>(<span class="c-var">$id</span>));
    }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Auth-state в singleton.</strong> Если ваш guard кешируется в singleton — следующий запрос увидит предыдущего пользователя. Тестируйте под Octane перед деплоем.</div>
    <div class="pitfall"><strong>2. Конфиг, изменённый рантайм.</strong> <code>config(['key' =&gt; 'value'])</code> в FPM сбросится с концом запроса. В Octane — переживёт. Все вызовы должны быть только чтение.</div>
    <div class="pitfall"><strong>3. PDO-соединение и pool.</strong> Постоянное PDO-соединение в воркере дольше, чем в FPM. Если БД рестартанула, воркер падает с broken pipe. Octane reconnect помогает, но проверяйте.</div>
    <div class="pitfall"><strong>4. Memory leaks.</strong> Утечки PHP-память накапливаются. Перезапуск воркера через <code>--max-requests=500</code> освобождает.</div>
    <div class="pitfall"><strong>5. Event listeners в singleton.</strong> Listeners, регистрируемые на ходу через <code>Event::listen</code>, копятся между запросами. Регистрация — только в Service Provider.</div>
    <div class="pitfall"><strong>6. Eloquent global scopes.</strong> Глобальные scopes на модели — нормально, поскольку определены в коде. Но <code>Model::addGlobalScope(...)</code> в коде запроса добавит scope для всех воркеров до перезапуска.</div>
    <div class="pitfall"><strong>7. Долгий handle с большим объёмом данных.</strong> Загрузка 100MB в память остаётся в воркере. Используйте <code>cursor()</code> или <code>chunk()</code> вместо <code>get()</code>.</div>
    <div class="pitfall"><strong>8. Octane-specific хуки.</strong> Octane имеет <code>RequestReceived</code>, <code>RequestHandled</code>, <code>RequestTerminated</code> события. Регистрируйте сброс состояния через них, не через middleware terminate.</div>
  </div>
</div>

<div id="sec-practice" class="section">
  <div class="section-title">Практика: фича заказа от запроса до доставки</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> Постановка</div>
    <p class="text">Реализуем endpoint <code>POST /api/orders</code>: пользователь оформляет заказ, мы списываем платёж, ставим в очередь отправку invoice, эмитим событие, обновляем счётчики. Покажем интеграцию всех слоёв Laravel и где встречаются knock-on эффекты.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Слои</div>

<pre><code><span class="c-comment">// 1. FormRequest — валидация и авторизация</span>
<span class="c-key">final class</span> <span class="c-type">StoreOrderRequest</span> <span class="c-key">extends</span> <span class="c-type">FormRequest</span>
{
    <span class="c-key">public function</span> <span class="c-fn">authorize</span>(): <span class="c-key">bool</span> { <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">user</span>() !== <span class="c-key">null</span>; }

    <span class="c-key">public function</span> <span class="c-fn">rules</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'items'</span>            =&gt; [<span class="c-str">'required'</span>, <span class="c-str">'array'</span>, <span class="c-str">'min:1'</span>],
            <span class="c-str">'items.*.sku'</span>     =&gt; [<span class="c-str">'required'</span>, <span class="c-str">'exists:products,sku'</span>],
            <span class="c-str">'items.*.quantity'</span>=&gt; [<span class="c-str">'required'</span>, <span class="c-str">'integer'</span>, <span class="c-str">'min:1'</span>],
            <span class="c-str">'currency'</span>         =&gt; [<span class="c-str">'required'</span>, <span class="c-str">'in:USD,KZT,EUR'</span>],
        ];
    }
}

<span class="c-comment">// 2. Controller — тонкий, делегирует</span>
<span class="c-key">final class</span> <span class="c-type">OrderController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">StoreOrderRequest</span> <span class="c-var">$request</span>, <span class="c-type">CreateOrder</span> <span class="c-var">$action</span>): <span class="c-type">JsonResponse</span>
    {
        <span class="c-var">$order</span> = <span class="c-var">$action</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">user</span>(), <span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());

        <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>(<span class="c-key">new</span> <span class="c-type">OrderResource</span>(<span class="c-var">$order</span>), <span class="c-num">201</span>);
    }
}

<span class="c-comment">// 3. Action — оркестрация бизнес-логики</span>
<span class="c-key">final class</span> <span class="c-type">CreateOrder</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private</span> <span class="c-type">PaymentGateway</span> <span class="c-var">$gateway</span>,
        <span class="c-key">private</span> <span class="c-type">RiskEngine</span>     <span class="c-var">$risk</span>,
    ) {}

    <span class="c-key">public function</span> <span class="c-fn">__invoke</span>(<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-key">array</span> <span class="c-var">$data</span>): <span class="c-type">Order</span>
    {
        <span class="c-key">if</span> (<span class="c-var">$this</span>-&gt;<span class="c-var">risk</span>-&gt;<span class="c-fn">score</span>(<span class="c-var">$data</span>) &gt;= <span class="c-num">80</span>) {
            <span class="c-key">throw new</span> <span class="c-type">HighRiskException</span>();
        }

        <span class="c-key">return</span> <span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$user</span>, <span class="c-var">$data</span>) {
            <span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">create</span>([
                <span class="c-str">'user_id'</span>     =&gt; <span class="c-var">$user</span>-&gt;<span class="c-var">id</span>,
                <span class="c-str">'status'</span>      =&gt; <span class="c-str">'pending'</span>,
                <span class="c-str">'currency'</span>    =&gt; <span class="c-var">$data</span>[<span class="c-str">'currency'</span>],
                <span class="c-str">'total_minor'</span> =&gt; <span class="c-type">OrderTotal</span>::<span class="c-fn">calculate</span>(<span class="c-var">$data</span>[<span class="c-str">'items'</span>]),
            ]);
            <span class="c-var">$order</span>-&gt;<span class="c-fn">items</span>()-&gt;<span class="c-fn">createMany</span>(<span class="c-var">$data</span>[<span class="c-str">'items'</span>]);

            <span class="c-var">$chargeId</span> = <span class="c-var">$this</span>-&gt;<span class="c-var">gateway</span>-&gt;<span class="c-fn">charge</span>(<span class="c-var">$order</span>-&gt;<span class="c-var">total_minor</span>, <span class="c-var">$order</span>-&gt;<span class="c-var">currency</span>, <span class="c-str">"ord_{$order-&gt;id}"</span>);
            <span class="c-var">$order</span>-&gt;<span class="c-fn">update</span>([<span class="c-str">'status'</span> =&gt; <span class="c-str">'paid'</span>, <span class="c-str">'charge_id'</span> =&gt; <span class="c-var">$chargeId</span>, <span class="c-str">'paid_at'</span> =&gt; <span class="c-fn">now</span>()]);

            <span class="c-comment">// dispatch'аем после commit транзакции</span>
            <span class="c-type">SendInvoice</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>-&gt;<span class="c-var">id</span>)-&gt;<span class="c-fn">afterCommit</span>();
            <span class="c-type">OrderPaid</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);

            <span class="c-key">return</span> <span class="c-var">$order</span>;
        });
    }
}
</code></pre>

    <p class="text">Что демонстрирует пример: FormRequest валидирует и авторизует; Controller остаётся тонким; Action — единица бизнес-логики; транзакция оборачивает все БД-операции; <code>afterCommit</code> гарантирует, что job не отправится раньше commit'а; событие <code>OrderPaid</code> подключает дополнительные слушатели без правок Action. Все слои Laravel работают в паре, каждый отвечает за своё.</p>
  </div>
</div>

<div id="sec-pitfalls" class="section">
  <div class="section-title">Сводные подводные камни</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Топ ошибок Laravel-приложений</div>
    <div class="pitfall"><strong>1. <code>config:cache</code> с динамическими значениями.</strong> Кеш собирается раз; вызовы <code>env()</code> в коде после кеша вернут null. <code>env()</code> только в конфиге, в коде — <code>config()</code>.</div>
    <div class="pitfall"><strong>2. Mass assignment без <code>$fillable</code>.</strong> <code>User::create($request-&gt;all())</code> с <code>$guarded = []</code> пропустит <code>is_admin</code>. Используйте FormRequest и явный whitelist.</div>
    <div class="pitfall"><strong>3. N+1 в API Resource.</strong> Resource обращается к relations &mdash; если не загружены, N+1. <code>Model::preventLazyLoading()</code> в локальной разработке.</div>
    <div class="pitfall"><strong>4. Транзакция без <code>afterCommit</code> для job.</strong> Job уйдёт в очередь до commit; воркер не найдёт строку. Используйте <code>->afterCommit()</code>.</div>
    <div class="pitfall"><strong>5. Eloquent в Octane без scoped.</strong> Singleton хранит state &mdash; следующий запрос видит чужие данные. <code>$app-&gt;scoped(...)</code> для request-state.</div>
    <div class="pitfall"><strong>6. Полагание на <code>session()</code> в API.</strong> API-маршруты обычно без session middleware &mdash; <code>session()-&gt;get()</code> вернёт null. Для stateless API используйте jwt/Sanctum tokens.</div>
    <div class="pitfall"><strong>7. <code>->orWhere</code> без скобок.</strong> <code>where(...)-&gt;orWhere(...)-&gt;where(...)</code> &mdash; <code>or</code> теряет приоритет. Группируйте: <code>where(fn ($q) =&gt; $q-&gt;where(...)-&gt;orWhere(...))</code>.</div>
    <div class="pitfall"><strong>8. <code>updated_at</code> при импорте.</strong> Mass import через Eloquent обновляет timestamps &mdash; теряется исходная дата. Используйте <code>DB::table()</code> или <code>$model-&gt;timestamps = false</code>.</div>
    <div class="pitfall"><strong>9. <code>findOrFail</code> в API без exception handler.</strong> Дефолт &mdash; 404, но без явного JSON ответа &mdash; HTML страница. Кастомизируйте в <code>App\Exceptions\Handler</code>.</div>
    <div class="pitfall"><strong>10. <code>Mail::send</code> синхронно.</strong> Блокирует request на отправку. Используйте <code>Mail::queue</code> или <code>ShouldQueue</code> на Mailable.</div>
    <div class="pitfall"><strong>11. <code>config('app.url')</code> для генерации ссылок.</strong> Без правильной настройки <code>APP_URL</code> ссылки в письмах ведут на <code>http://localhost</code>. Проверяйте в проде.</div>
    <div class="pitfall"><strong>12. <code>DB::raw</code> с пользовательским вводом.</strong> Защита prepared statements теряется. Только параметризованные значения через <code>?</code> binding.</div>
  </div>
</div>

<div id="sec-interview" class="section">
  <div class="section-title">Вопросы на собеседование (middle / senior)</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="rotate-cw"></i> Lifecycle и Container</div>
    <div class="card"><h3>1. Опишите цикл HTTP-запроса в Laravel</h3><p class="text">(1) <code>public/index.php</code> загружает Composer и <code>bootstrap/app.php</code>. (2) <code>Application</code> создаётся, конфигурируется ядро. (3) <code>Kernel::handle</code> прогоняет bootstrappers (env, config, providers). (4) Провайдеры: все <code>register()</code>, потом все <code>boot()</code>. (5) Pipeline глобальных middleware. (6) Router: подбор маршрута, групповые/маршрутные middleware, route model binding. (7) Controller с DI. (8) Response поднимается через middleware. (9) <code>terminate()</code> после отправки клиенту.</p></div>
    <div class="card"><h3>2. Чем <code>register()</code> отличается от <code>boot()</code> в Service Provider?</h3><p class="text"><code>register()</code> вызывается первым у всех провайдеров — можно только добавлять binding'и в контейнер, нельзя использовать другие сервисы (их ещё нет). <code>boot()</code> — после того как все провайдеры завершили <code>register()</code>, доступны все сервисы и фасады. Регистрация маршрутов, observer'ов, событий — в <code>boot()</code>.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="route"></i> Routing и Middleware</div>
    <div class="card"><h3>3. Что делает <code>scopeBindings()</code> и зачем?</h3><p class="text">Если в маршруте два параметра-модели через relation (<code>/users/{user}/posts/{post:slug}</code>), без <code>scopeBindings</code> Laravel найдёт пост по slug в любой таблице. С <code>scopeBindings</code> — только среди постов конкретного user. Защита от чтения чужих данных через подмену slug.</p></div>
    <div class="card"><h3>4. Когда middleware-метод <code>terminate</code> не работает?</h3><p class="text">Требует поддержки <code>fastcgi_finish_request</code> или эквивалента в SAPI. PHP-FPM — поддерживает. Built-in <code>artisan serve</code> — нет; на нём <code>terminate</code> работает синхронно, удлиняя ответ. Также в Octane модель другая.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> Eloquent и Cache</div>
    <div class="card"><h3>5. Чем <code>$user-&gt;orders</code> отличается от <code>$user-&gt;orders()</code>?</h3><p class="text"><code>$user-&gt;orders</code> — magic-property, возвращает <code>Collection</code> заказов, lazy-loaded при первом обращении. <code>$user-&gt;orders()</code> — метод, возвращает <code>HasMany</code> query builder для дальнейшей фильтрации: <code>$user-&gt;orders()-&gt;where('status', 'paid')-&gt;get()</code>.</p></div>
    <div class="card"><h3>6. Что такое cache stampede и как с ним бороться?</h3><p class="text">Когда дорогой ключ устаревает, множество одновременных запросов начинают его регенерировать параллельно, перегружая БД. Решение — atomic lock через <code>Cache::lock(key)-&gt;block(timeout, fn() =&gt; ...)</code>: только один запрос пересоздаёт, остальные ждут или возвращают stale-значение.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list-checks"></i> Очереди и события</div>
    <div class="card"><h3>7. Что произойдёт, если job в очереди dispatched внутри транзакции, а транзакция откатится?</h3><p class="text">Без специальных мер job уже в очереди и будет выполнен — обработчик попробует найти строку, которой нет (rollback). Решение: <code>dispatch()-&gt;afterCommit()</code> или <code>public bool $afterCommit = true;</code> в job. Job попадает в очередь только после успешного commit.</p></div>
    <div class="card"><h3>8. Почему job должен быть идемпотентным?</h3><p class="text">При retry handle() вызывается N раз при сбоях. Без идемпотентности (например, отправка письма без проверки факта отправки) пользователь получит N писем. Решение: проверка флага в начале handle (<code>if ($order-&gt;invoice_sent_at) return;</code>) или использование уникальных идентификаторов на стороне внешнего сервиса (idempotency key).</p></div>
    <div class="card"><h3>9. В чём разница между Event и Job?</h3><p class="text">Event — декларация факта (что-то произошло), Job — задача (что нужно сделать). Event может иметь несколько listeners, каждый — отдельная единица работы. Job — единичная задача. Подписка на Event можно добавить без правок основного кода; новый Job требует явного dispatch. Используйте Events для slojnoy логики; Jobs — для атомарных действий.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="key"></i> Auth и безопасность</div>
    <div class="card"><h3>10. Чем gate отличается от policy?</h3><p class="text">Gate — глобальная функция авторизации, не привязанная к модели: <code>Gate::define('admin-area', fn ($user) =&gt; ...)</code>. Policy — класс с методами авторизации <em>для конкретной модели</em>: <code>UserPolicy::update($admin, $target)</code>. Policy лучше масштабируется на CRUD-операции; Gate — для абстрактных разрешений (доступ к админке, право видеть метрики).</p></div>
    <div class="card"><h3>11. Что делает <code>Gate::before</code> и когда уместен?</h3><p class="text">Глобальный хук перед любой проверкой. Возврат <code>true</code> — разрешает всё; <code>false</code> — запрещает всё; <code>null</code> — обычная проверка. Уместен для super-admin: <code>Gate::before(fn ($user) =&gt; $user-&gt;is_root ? true : null)</code>. Опасно использовать для основной логики — скрывает правила.</p></div>
    <div class="card"><h3>12. Как разделить аутентификацию для web и для API?</h3><p class="text">Через guards в <code>config/auth.php</code>. <code>web</code> — session-based (cookies). <code>api</code> — token-based (sanctum/passport). Доступ: <code>auth('api')-&gt;user()</code>. Маршруты группируются: <code>Route::middleware('auth:web')</code> или <code>auth:sanctum</code>. Default guard — для запросов без явного указания.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="rocket"></i> Octane и производительность</div>
    <div class="card"><h3>13. Почему singleton может быть опасен в Octane?</h3><p class="text">В классическом PHP-FPM процесс умирает после запроса &mdash; singleton сбрасывается. В Octane процесс живёт между запросами; singleton с per-request state (например, корзина, контекст пользователя) утечёт следующему пользователю. Решение: <code>$app-&gt;scoped(...)</code> &mdash; singleton на запрос, сбрасывается через <code>Octane::flushApplicationState()</code>.</p></div>
    <div class="card"><h3>14. Что делает <code>Octane::concurrently()</code>?</h3><p class="text">Выполняет несколько callable параллельно в отдельных воркерах. Возвращает массив результатов в том же порядке. Идеально для агрегации данных из разных источников: <code>[$users, $orders, $stats] = Octane::concurrently([fn () =&gt; User::count(), fn () =&gt; Order::sum('total'), fn () =&gt; Stats::current()])</code>.</p></div>
    <div class="card"><h3>15. Как мониторить производительность Laravel-приложения?</h3><p class="text">(1) Slow query log БД. (2) Laravel Telescope (только в dev/staging — он сам тяжёлый). (3) Внешние APM: New Relic, Datadog, Tideways &mdash; видят time-per-request с разбивкой по уровням (контроллер, БД, внешние API). (4) Horizon для очередей &mdash; throughput, failed jobs, wait time. (5) Метрики из приложения через middleware: timing, status codes, размер ответа &mdash; в Prometheus/Datadog.</p></div>
  </div>
</div>

</div>
</div>

<script src="https://unpkg.com/lucide@0.344.0/dist/umd/lucide.min.js"></script>
<script>
lucide.createIcons();
function showSection(id, el) {
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  const sec = document.getElementById('sec-' + id);
  if (sec) sec.classList.add('active');
  if (el) el.classList.add('active');
  window.scrollTo(0, 0);
  lucide.createIcons();
}
</script>
</body>
</html>
@endverbatim
