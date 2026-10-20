@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laravel — Хелперы и методы (практический справочник)</title>
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
.badge{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;}
.badge-neutral{background:#EFF2F5;color:#5E6278;}
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
p.text code, .helper-card p code, td code{background:var(--bg);border:1px solid var(--border);border-radius:4px;padding:1px 6px;font-size:12px;font-family:monospace;color:var(--primary);}
.info-box{border-radius:var(--radius);padding:14px 16px;margin-bottom:16px;border-left:4px solid;font-size:13px;line-height:1.7;}
.info-box.primary{background:var(--primary-light);border-color:var(--primary);color:#404357;}
.info-box.success{background:var(--success-light);border-color:var(--success);color:#0D5E3F;}
.info-box.warning{background:#FFF8E1;border-color:#E0A000;color:#7B5000;}
.info-box.danger{background:#FFF3F5;border-color:#D0404E;color:#7B1C2A;}
.info-box strong{font-weight:700;}
.helper-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:18px 20px;margin-bottom:14px;box-shadow:var(--shadow);}
.helper-card h3{font-size:14px;font-weight:700;color:var(--text);margin-bottom:6px;display:flex;align-items:center;gap:8px;}
.helper-card h3 code{font-family:'JetBrains Mono','Fira Code',Consolas,monospace;font-size:13px;background:var(--primary-light);color:var(--primary);padding:2px 8px;border-radius:5px;border:none;}
.helper-card .h-what{color:var(--text2);font-size:13px;margin-bottom:10px;line-height:1.7;}
.helper-card .h-use{font-size:12.5px;color:var(--primary);background:var(--primary-light);padding:8px 12px;border-radius:6px;margin-top:10px;border-left:3px solid var(--primary);}
.helper-card .h-use strong{color:#181C32;}
pre{background:var(--code-bg);border:1px solid var(--code-border);border-radius:var(--radius);padding:16px 18px;overflow-x:auto;margin-bottom:12px;font-size:12.5px;line-height:1.7;}
pre code{color:#ABB2BF;font-family:'JetBrains Mono','Fira Code',Consolas,monospace;}
.c-comment{color:#5C6370;}.c-key{color:#C678DD;}.c-str{color:#98C379;}.c-fn{color:#61AFEF;}.c-var{color:#E5C07B;}.c-type{color:#E06C75;}.c-num{color:#D19A66;}
.data-table{width:100%;border-collapse:collapse;margin-bottom:16px;font-size:13px;}
.data-table th{background:var(--bg);padding:10px 14px;text-align:left;font-weight:700;font-size:11px;text-transform:uppercase;letter-spacing:0.5px;color:var(--text2);border-bottom:1px solid var(--border);}
.data-table td{padding:10px 14px;border-bottom:1px solid var(--border);color:var(--text2);vertical-align:top;}
.data-table td strong{color:var(--text);font-weight:600;}
.data-table tr:last-child td{border-bottom:none;}

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
  <div class="sidebar-title">Хелперы Laravel</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">Запрос &amp; валидация</div>
  <a class="nav-item" onclick="showSection('request',this)"><i data-lucide="arrow-down-to-line"></i> Request Handling</a>
  <a class="nav-item" onclick="showSection('validation-basic',this)"><i data-lucide="check-square"></i> Validation (база)</a>
  <a class="nav-item" onclick="showSection('validation-adv',this)"><i data-lucide="check-circle-2"></i> Validation (advanced)</a>

  <div class="nav-group-label">Данные</div>
  <a class="nav-item" onclick="showSection('eloquent',this)"><i data-lucide="database"></i> Eloquent Query</a>
  <a class="nav-item" onclick="showSection('collections',this)"><i data-lucide="layers"></i> Collections</a>
  <a class="nav-item" onclick="showSection('strings',this)"><i data-lucide="type"></i> Strings (Str)</a>
  <a class="nav-item" onclick="showSection('arrays',this)"><i data-lucide="list"></i> Arrays (Arr)</a>
  <a class="nav-item" onclick="showSection('dates',this)"><i data-lucide="calendar"></i> Dates (Carbon)</a>

  <div class="nav-group-label">Приложение</div>
  <a class="nav-item" onclick="showSection('session-auth',this)"><i data-lucide="user-check"></i> Session &amp; Auth</a>
  <a class="nav-item" onclick="showSection('routing',this)"><i data-lucide="route"></i> Routing &amp; Views</a>
  <a class="nav-item" onclick="showSection('debug',this)"><i data-lucide="bug"></i> Debug &amp; Misc</a>
  <a class="nav-item" onclick="showSection('artisan',this)"><i data-lucide="terminal"></i> Artisan CLI</a>

  <div class="nav-group-label">Сводка</div>
  <a class="nav-item" onclick="showSection('cheatsheet',this)"><i data-lucide="bookmark"></i> Шпаргалка</a>

  <div class="nav-group-label">Глубже</div>
  <a class="nav-item" onclick="showSection('under-hood',this)"><i data-lucide="cpu"></i> Под капотом: PHP за хелперами</a>
</div>

<div class="main">
<div class="page-header">
  <h1>Laravel — Хелперы и методы</h1>
  <p>Практический справочник по повседневным хелперам Laravel: что делает каждый, пример кода и use case. Покрывает 95% задач разработки.</p>
  <div class="badge-row">
    <span class="badge badge-neutral">Laravel</span>
    <span class="badge badge-neutral">Helpers</span>
    <span class="badge badge-neutral">Cheat Sheet</span>
    <span class="badge badge-success">Практика</span>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     OVERVIEW
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>
  <p class="text">Laravel поставляется с десятками <strong>helper-функций</strong> и <strong>статических методов</strong>, которые экономят сотни строк кода. Они покрывают: работу с запросами, валидацию, Eloquent-запросы, коллекции, строки, массивы, даты, сессии, авторизацию, маршруты, отладку.</p>

  <div class="info-box primary">
    <strong>Что такое helper?</strong> Глобальная функция (<code>request()</code>, <code>now()</code>, <code>collect()</code>) или статический метод фасада (<code>Str::slug()</code>, <code>Arr::get()</code>), доступные где угодно — в контроллерах, моделях, Blade, командах.
  </div>

  <p class="text">Этот раздел структурирован так, чтобы каждый helper было видно с <strong>тремя пунктами</strong>: что делает, пример кода, use case (когда применять).</p>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layout-grid"></i> Категории</div>
    <table class="data-table">
      <tr><th>Категория</th><th>Что покрывает</th><th>Примеры</th></tr>
      <tr><td><strong>Request</strong></td><td>Чтение входных данных</td><td><code>request()</code>, <code>input()</code>, <code>filled()</code>, <code>old()</code></td></tr>
      <tr><td><strong>Validation</strong></td><td>Проверка входных данных</td><td><code>required</code>, <code>email</code>, <code>unique</code>, <code>Rule::in()</code>, <code>sometimes</code></td></tr>
      <tr><td><strong>Eloquent</strong></td><td>Запросы к БД</td><td><code>where()</code>, <code>find()</code>, <code>with()</code>, <code>whereHas()</code>, <code>paginate()</code></td></tr>
      <tr><td><strong>Collections</strong></td><td>Работа с массивами на стероидах</td><td><code>map()</code>, <code>filter()</code>, <code>reduce()</code>, <code>groupBy()</code></td></tr>
      <tr><td><strong>Str</strong></td><td>Строки</td><td><code>Str::slug()</code>, <code>limit()</code>, <code>contains()</code>, <code>random()</code></td></tr>
      <tr><td><strong>Arr</strong></td><td>Массивы</td><td><code>Arr::get()</code>, <code>only()</code>, <code>except()</code>, <code>set()</code></td></tr>
      <tr><td><strong>Carbon</strong></td><td>Даты и время</td><td><code>now()</code>, <code>addDays()</code>, <code>diffForHumans()</code></td></tr>
      <tr><td><strong>Auth/Session</strong></td><td>Сессии и пользователь</td><td><code>auth()</code>, <code>session()</code>, <code>bcrypt()</code></td></tr>
      <tr><td><strong>Routing</strong></td><td>URL и редиректы</td><td><code>route()</code>, <code>url()</code>, <code>redirect()</code>, <code>asset()</code></td></tr>
      <tr><td><strong>Debug</strong></td><td>Отладка</td><td><code>dd()</code>, <code>dump()</code>, <code>abort()</code>, <code>config()</code></td></tr>
      <tr><td><strong>Artisan</strong></td><td>CLI команды</td><td><code>migrate</code>, <code>make:model</code>, <code>tinker</code></td></tr>
    </table>
  </div>

  <div class="info-box warning">
    <strong>Лайфхак:</strong> 90% повседневной разработки — это комбинация этих хелперов. Запомни их визуально (внешний вид + один use case на каждый) — и ты решишь большинство задач без гугла.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     REQUEST HANDLING
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-request" class="section">
  <div class="section-title">Request Handling</div>
  <p class="text">Чтение данных из формы, query-параметров, JSON-тела. В Laravel <strong>нет</strong> прямой работы с <code>$_GET</code>/<code>$_POST</code> — всё через объект <code>Request</code> или global helper <code>request()</code>.</p>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-down-to-line"></i> Чтение данных</div>
  <div class="helper-card">
    <h3><code>request()</code> / <code>$request-&gt;input()</code></h3>
    <p class="h-what">Получить любое поле из запроса (form, JSON, query). Второй аргумент — значение по умолчанию.</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>)
{
    <span class="c-var">$name</span>  = <span class="c-var">$request</span>-><span class="c-fn">input</span>(<span class="c-str">'name'</span>);          <span class="c-comment">// из формы/JSON</span>
    <span class="c-var">$email</span> = <span class="c-fn">request</span>(<span class="c-str">'email'</span>);                 <span class="c-comment">// то же через helper</span>
    <span class="c-var">$role</span>  = <span class="c-var">$request</span>-><span class="c-fn">input</span>(<span class="c-str">'role'</span>, <span class="c-str">'guest'</span>); <span class="c-comment">// default</span>
}
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Любой контроллер, читающий данные от пользователя.</div>
  </div>

  <div class="helper-card">
    <h3><code>$request-&gt;all()</code> / <code>only()</code> / <code>except()</code></h3>
    <p class="h-what">Получить весь массив входных данных или его подмножество.</p>
<pre><code><span class="c-var">$data</span>  = <span class="c-var">$request</span>-><span class="c-fn">all</span>();                          <span class="c-comment">// все поля</span>
<span class="c-var">$creds</span> = <span class="c-var">$request</span>-><span class="c-fn">only</span>([<span class="c-str">'email'</span>, <span class="c-str">'password'</span>]); <span class="c-comment">// только нужные</span>
<span class="c-var">$safe</span>  = <span class="c-var">$request</span>-><span class="c-fn">except</span>([<span class="c-str">'_token'</span>, <span class="c-str">'password'</span>]); <span class="c-comment">// без указанных</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> <code>Model::create($request->only([...]))</code> — безопасный mass-assign только нужных полей.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Проверка наличия</div>
  <div class="helper-card">
    <h3><code>filled()</code></h3>
    <p class="h-what"><code>true</code>, если поле есть <strong>и не пустое</strong> (не <code>null</code>, не <code>''</code>, не <code>[]</code>).</p>
<pre><code><span class="c-key">if</span> (<span class="c-var">$request</span>-><span class="c-fn">filled</span>(<span class="c-str">'phone'</span>)) {
    <span class="c-fn">sendSMS</span>(<span class="c-var">$request</span>-><span class="c-fn">input</span>(<span class="c-str">'phone'</span>));
}
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Опциональные поля — выполнять логику только если пользователь реально что-то ввёл.</div>
  </div>

  <div class="helper-card">
    <h3><code>has()</code></h3>
    <p class="h-what"><code>true</code>, если поле <strong>присутствует</strong> в запросе (даже если пустая строка).</p>
<pre><code><span class="c-key">if</span> (<span class="c-var">$request</span>-><span class="c-fn">has</span>(<span class="c-str">'promo_code'</span>)) {
    <span class="c-fn">applyDiscount</span>(<span class="c-var">$request</span>-><span class="c-fn">input</span>(<span class="c-str">'promo_code'</span>));
}
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Отличить «поле не передано» от «передано пустым» — например, очистка значения через <code>?promo_code=</code>.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="rotate-ccw"></i> UX форм / модели</div>
  <div class="helper-card">
    <h3><code>old()</code></h3>
    <p class="h-what">Возвращает старое значение поля из flash-сессии — сохраняет ввод формы после ошибки валидации.</p>
<pre><code><span class="c-comment">&lt;!-- В Blade --&gt;</span>
&lt;input type=<span class="c-str">"email"</span> name=<span class="c-str">"email"</span> value=<span class="c-str">"{{ old('email') }}"</span>&gt;
</code></pre>
    <div class="h-use"><strong>Use case:</strong> UX форм — после redirect-back пользователь видит свои данные, а не пустые поля.</div>
  </div>

  <div class="helper-card">
    <h3><code>$model-&gt;fill($request-&gt;all())</code></h3>
    <p class="h-what">Заполняет атрибуты модели из массива (без сохранения). Соблюдает <code>$fillable</code>.</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">update</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>, <span class="c-type">User</span> <span class="c-var">$user</span>)
{
    <span class="c-var">$user</span>-><span class="c-fn">fill</span>(<span class="c-var">$request</span>-><span class="c-fn">validated</span>());
    <span class="c-var">$user</span>-><span class="c-fn">save</span>();
}
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Обновление существующей модели — заполнил поля, сохранил. Альтернатива: <code>$user-&gt;update($data)</code> делает то же самое в одну строку.</div>
  </div>
  </div><!-- /subsection -->
</div>

<!-- ════════════════════════════════════════════════════════════════
     VALIDATION (BASIC)
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-validation-basic" class="section">
  <div class="section-title">Validation — базовые правила</div>
  <p class="text">90% задач валидации решаются комбинацией этих правил. Применяются через <code>$request-&gt;validate([...])</code> или в <code>FormRequest::rules()</code>.</p>

  <div class="info-box primary">
    <strong>Базовый шаблон:</strong>
<pre style="margin-top:8px;margin-bottom:0;"><code><span class="c-var">$validated</span> = <span class="c-var">$request</span>-><span class="c-fn">validate</span>([
    <span class="c-str">'email'</span>    => <span class="c-str">'required|email|unique:users,email'</span>,
    <span class="c-str">'password'</span> => <span class="c-str">'required|confirmed|min:8'</span>,
]);</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-circle"></i> Обязательность</div>
  <div class="helper-card">
    <h3><code>required</code></h3>
    <p class="h-what">Поле должно присутствовать и не быть пустым.</p>
<pre><code><span class="c-str">'email'</span> => <span class="c-str">'required'</span>,
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Обязательные поля — email, password, name.</div>
  </div>

  <div class="helper-card">
    <h3><code>nullable</code></h3>
    <p class="h-what">Разрешает <code>null</code> или отсутствие поля. Часто комбинируется с типом.</p>
<pre><code><span class="c-str">'middle_name'</span> => <span class="c-str">'nullable|string|max:100'</span>,
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Опциональные поля. Без <code>nullable</code> правило <code>string</code> отвергнет <code>null</code>.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hash"></i> Тип значения</div>
  <div class="helper-card">
    <h3><code>email</code></h3>
    <p class="h-what">Валидный email-формат. Опции: <code>email:rfc,dns</code> (проверка DNS).</p>
<pre><code><span class="c-str">'email'</span> => <span class="c-str">'required|email'</span>,
<span class="c-str">'email'</span> => <span class="c-str">'required|email:rfc,dns'</span>, <span class="c-comment">// строже</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Регистрация, контактные формы.</div>
  </div>

  <div class="helper-card">
    <h3><code>numeric</code> / <code>integer</code></h3>
    <p class="h-what"><code>numeric</code> — любое число (вкл. дробные), <code>integer</code> — только целое.</p>
<pre><code><span class="c-str">'price'</span>    => <span class="c-str">'required|numeric|min:0'</span>,
<span class="c-str">'quantity'</span> => <span class="c-str">'required|integer|min:1'</span>,
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Цены, счётчики, возраст.</div>
  </div>

  <div class="helper-card">
    <h3><code>regex:/pattern/</code></h3>
    <p class="h-what">Кастомный шаблон через регулярное выражение.</p>
<pre><code><span class="c-str">'username'</span> => [<span class="c-str">'required'</span>, <span class="c-str">'regex:/^[a-zA-Z0-9_]+$/'</span>],
<span class="c-str">'phone'</span>    => [<span class="c-str">'required'</span>, <span class="c-str">'regex:/^\+?[0-9]{10,15}$/'</span>],
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Когда стандартных правил мало — телефоны, кастомные форматы кодов.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="ruler"></i> Размер / длина</div>
  <div class="helper-card">
    <h3><code>min</code> / <code>max</code></h3>
    <p class="h-what">Для строк — длина, для чисел — значение, для файлов — размер в KB, для массивов — кол-во элементов.</p>
<pre><code><span class="c-str">'username'</span> => <span class="c-str">'required|min:3|max:20'</span>,    <span class="c-comment">// 3–20 символов</span>
<span class="c-str">'age'</span>      => <span class="c-str">'integer|min:18'</span>,           <span class="c-comment">// число ≥ 18</span>
<span class="c-str">'photo'</span>    => <span class="c-str">'file|max:2048'</span>,            <span class="c-comment">// до 2 МБ</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Ограничения длины ввода, диапазоны значений, размер загружаемых файлов.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> Список / БД</div>
  <div class="helper-card">
    <h3><code>unique:table,column</code></h3>
    <p class="h-what">Значение уникально в указанной таблице/колонке. При обновлении исключи текущую запись.</p>
<pre><code><span class="c-comment">// При создании</span>
<span class="c-str">'email'</span> => <span class="c-str">'required|email|unique:users,email'</span>,

<span class="c-comment">// При обновлении (исключить текущего юзера по id)</span>
<span class="c-str">'email'</span> => [<span class="c-str">'required'</span>, <span class="c-str">'email'</span>, <span class="c-type">Rule</span>::<span class="c-fn">unique</span>(<span class="c-str">'users'</span>)-><span class="c-fn">ignore</span>(<span class="c-var">$user</span>-><span class="c-var">id</span>)],
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Email, username, slug, SKU — всё, что должно быть уникальным в БД.</div>
  </div>

  <div class="helper-card">
    <h3><code>exists:table,column</code></h3>
    <p class="h-what">Проверяет, что значение существует в указанной таблице. Применяется к foreign key'ам.</p>
<pre><code><span class="c-str">'category_id'</span> => <span class="c-str">'required|exists:categories,id'</span>,
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Защита от FK constraint violation — не дать вставить ID несуществующей записи.</div>
  </div>

  <div class="helper-card">
    <h3><code>Rule::in([...])</code></h3>
    <p class="h-what">Значение должно быть в списке разрешённых. Аналог enum.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Validation\Rule</span>;

<span class="c-str">'status'</span> => [<span class="c-str">'required'</span>, <span class="c-type">Rule</span>::<span class="c-fn">in</span>([<span class="c-str">'draft'</span>, <span class="c-str">'published'</span>, <span class="c-str">'archived'</span>])],
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Dropdown'ы, роли, статусы, типы — любые предопределённые списки значений.</div>
  </div>

  <div class="helper-card">
    <h3><code>confirmed</code></h3>
    <p class="h-what">Требует наличия поля <code>{field}_confirmation</code> с тем же значением.</p>
<pre><code><span class="c-str">'password'</span> => <span class="c-str">'required|confirmed|min:8'</span>,
<span class="c-comment">// В форме нужны: password И password_confirmation</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Подтверждение пароля при регистрации / смене пароля.</div>
  </div>
  </div><!-- /subsection -->
</div>

<!-- ════════════════════════════════════════════════════════════════
     VALIDATION (ADVANCED)
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-validation-adv" class="section">
  <div class="section-title">Validation — продвинутые правила</div>
  <p class="text">Дополнительный арсенал для дат, массивов, файлов и условной валидации.</p>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="calendar"></i> Даты</div>
  <div class="helper-card">
    <h3><code>date</code></h3>
    <p class="h-what">Валидная дата (любой формат, который понимает PHP strtotime).</p>
<pre><code><span class="c-str">'birthday'</span> => <span class="c-str">'required|date'</span>,
<span class="c-str">'event'</span>    => <span class="c-str">'required|date_format:Y-m-d H:i'</span>, <span class="c-comment">// строгий формат</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Дни рождения, даты событий, дедлайны.</div>
  </div>

  <div class="helper-card">
    <h3><code>before</code> / <code>after</code></h3>
    <p class="h-what">Сравнение дат. Может ссылаться на другое поле или константу типа <code>today</code>.</p>
<pre><code><span class="c-str">'start_date'</span> => <span class="c-str">'required|date'</span>,
<span class="c-str">'end_date'</span>   => <span class="c-str">'required|date|after:start_date'</span>,
<span class="c-str">'birthday'</span>   => <span class="c-str">'required|date|before:today'</span>,
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Бронирования, периоды, расписания, дата рождения в прошлом.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-fork"></i> Условные</div>
  <div class="helper-card">
    <h3><code>sometimes</code></h3>
    <p class="h-what">Правило применяется только если поле <strong>присутствует</strong> в запросе. Иначе — игнорируется.</p>
<pre><code><span class="c-str">'phone'</span> => <span class="c-str">'sometimes|numeric|digits_between:10,15'</span>,
</code></pre>
    <div class="h-use"><strong>Use case:</strong> PATCH-эндпоинты (частичное обновление) — поле либо не пришло, либо должно быть валидным.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Массивы</div>
  <div class="helper-card">
    <h3><code>array</code> + <code>field.*</code></h3>
    <p class="h-what">Поле — массив. Через <code>tags.*</code> валидируется каждый элемент.</p>
<pre><code><span class="c-str">'tags'</span>   => <span class="c-str">'required|array|min:1'</span>,
<span class="c-str">'tags.*'</span> => <span class="c-str">'string|max:30'</span>,
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Чекбоксы, теги, мульти-селект, массив ID для bulk-операций.</div>
  </div>

  <div class="helper-card">
    <h3><code>distinct</code></h3>
    <p class="h-what">Элементы массива должны быть уникальными.</p>
<pre><code><span class="c-str">'emails'</span>   => <span class="c-str">'array'</span>,
<span class="c-str">'emails.*'</span> => <span class="c-str">'email|distinct'</span>,
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Массовая рассылка — запретить дубликаты адресов.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="braces"></i> Форматы данных</div>
  <div class="helper-card">
    <h3><code>json</code></h3>
    <p class="h-what">Строка должна быть валидным JSON.</p>
<pre><code><span class="c-str">'metadata'</span> => <span class="c-str">'required|json'</span>,
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Сохранение конфигов / метаданных в текстовое поле БД (если не используешь cast).</div>
  </div>

  <div class="helper-card">
    <h3><code>boolean</code></h3>
    <p class="h-what">Принимает: <code>true</code>, <code>false</code>, <code>1</code>, <code>0</code>, <code>"1"</code>, <code>"0"</code>.</p>
<pre><code><span class="c-str">'is_active'</span> => <span class="c-str">'required|boolean'</span>,
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Toggle-флаги: published/draft, active/inactive.</div>
  </div>

  <div class="helper-card">
    <h3><code>ip</code> / <code>url</code> / <code>active_url</code></h3>
    <p class="h-what">Сетевые форматы. <code>active_url</code> проверяет, что домен реально резолвится.</p>
<pre><code><span class="c-str">'server_ip'</span> => <span class="c-str">'required|ip'</span>,
<span class="c-str">'website'</span>   => <span class="c-str">'required|url'</span>,
<span class="c-str">'callback'</span>  => <span class="c-str">'required|active_url'</span>,
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Webhook URLs, callback'и, серверные конфиги.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-up"></i> Файлы</div>
  <div class="helper-card">
    <h3><code>mimes</code> / <code>mimetypes</code></h3>
    <p class="h-what">Тип загружаемого файла. <code>mimes</code> — по расширению, <code>mimetypes</code> — по MIME.</p>
<pre><code><span class="c-str">'avatar'</span>   => <span class="c-str">'required|image|mimes:jpg,png,webp|max:2048'</span>,
<span class="c-str">'document'</span> => <span class="c-str">'required|mimetypes:application/pdf|max:5120'</span>,
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Безопасные загрузки — запретить .exe, .php, .sh.</div>
  </div>
  </div><!-- /subsection -->

  <div class="info-box success">
    <strong>Совет:</strong> Сложную валидацию выноси в <code>FormRequest</code>:
<pre style="margin-top:8px;margin-bottom:0;"><code><span class="c-key">class</span> <span class="c-type">StoreUserRequest</span> <span class="c-key">extends</span> <span class="c-type">FormRequest</span>
{
    <span class="c-key">public function</span> <span class="c-fn">rules</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'name'</span>     => <span class="c-str">'required|string|max:100'</span>,
            <span class="c-str">'email'</span>    => <span class="c-str">'required|email|unique:users'</span>,
            <span class="c-str">'password'</span> => <span class="c-str">'required|confirmed|min:8'</span>,
        ];
    }
}</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     ELOQUENT QUERY
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-eloquent" class="section">
  <div class="section-title">Eloquent — query helpers</div>
  <p class="text">Методы query builder'а, доступные на любой модели и её отношениях.</p>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="filter"></i> Фильтрация</div>
  <div class="helper-card">
    <h3><code>where()</code> / <code>orWhere()</code></h3>
    <p class="h-what">Базовые условия WHERE. <code>orWhere</code> добавляет OR-ветку.</p>
<pre><code><span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'active'</span>)-><span class="c-fn">get</span>();
<span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'age'</span>, <span class="c-str">'&gt;'</span>, <span class="c-num">18</span>)
    -><span class="c-fn">orWhere</span>(<span class="c-str">'role'</span>, <span class="c-str">'admin'</span>)
    -><span class="c-fn">get</span>();
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Фильтрация — основа любого запроса.</div>
  </div>

  <div class="helper-card">
    <h3><code>whereIn()</code> / <code>whereNotIn()</code></h3>
    <p class="h-what">WHERE IN (...) — поиск по списку значений.</p>
<pre><code><span class="c-type">User</span>::<span class="c-fn">whereIn</span>(<span class="c-str">'id'</span>, [<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>])-><span class="c-fn">get</span>();
<span class="c-type">Post</span>::<span class="c-fn">whereNotIn</span>(<span class="c-str">'status'</span>, [<span class="c-str">'draft'</span>, <span class="c-str">'deleted'</span>])-><span class="c-fn">get</span>();
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Bulk-выборки по массиву ID (например, после <code>request()-&gt;input('ids')</code>).</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="search"></i> Поиск одной записи</div>
  <div class="helper-card">
    <h3><code>find()</code> / <code>findOrFail()</code></h3>
    <p class="h-what">Поиск по первичному ключу. <code>findOrFail</code> бросает 404.</p>
<pre><code><span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-num">5</span>);        <span class="c-comment">// null если не найден</span>
<span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">findOrFail</span>(<span class="c-num">5</span>);  <span class="c-comment">// 404 если не найден</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Показ страницы по ID — <code>findOrFail</code> избавляет от ручной проверки <code>if (!$user) abort(404)</code>.</div>
  </div>

  <div class="helper-card">
    <h3><code>first()</code> / <code>firstOrFail()</code></h3>
    <p class="h-what">Первая запись по условию. <code>firstOrFail</code> бросает 404.</p>
<pre><code><span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'email'</span>, <span class="c-var">$email</span>)-><span class="c-fn">first</span>();
<span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'email'</span>, <span class="c-var">$email</span>)-><span class="c-fn">firstOrFail</span>();
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Поиск по уникальному не-ID полю (email, slug).</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-up-down"></i> Сортировка / лимит / пагинация</div>
  <div class="helper-card">
    <h3><code>orderBy()</code> / <code>latest()</code> / <code>oldest()</code></h3>
    <p class="h-what">Сортировка. <code>latest()</code> — алиас <code>orderBy('created_at', 'desc')</code>.</p>
<pre><code><span class="c-type">Post</span>::<span class="c-fn">orderBy</span>(<span class="c-str">'created_at'</span>, <span class="c-str">'desc'</span>)-><span class="c-fn">get</span>();
<span class="c-type">Post</span>::<span class="c-fn">latest</span>()-><span class="c-fn">take</span>(<span class="c-num">10</span>)-><span class="c-fn">get</span>();   <span class="c-comment">// 10 свежих</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Лента новостей, последние заказы.</div>
  </div>

  <div class="helper-card">
    <h3><code>take()</code> / <code>limit()</code></h3>
    <p class="h-what">Ограничить число записей.</p>
<pre><code><span class="c-type">User</span>::<span class="c-fn">orderBy</span>(<span class="c-str">'id'</span>, <span class="c-str">'desc'</span>)-><span class="c-fn">take</span>(<span class="c-num">5</span>)-><span class="c-fn">get</span>();
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Виджеты «топ-5», превью.</div>
  </div>

  <div class="helper-card">
    <h3><code>paginate()</code></h3>
    <p class="h-what">Готовая пагинация: возвращает <code>LengthAwarePaginator</code> с навигацией.</p>
<pre><code><span class="c-var">$posts</span> = <span class="c-type">Post</span>::<span class="c-fn">latest</span>()-><span class="c-fn">paginate</span>(<span class="c-num">10</span>);

<span class="c-comment">// В Blade:</span>
{{ <span class="c-var">$posts</span>-><span class="c-fn">links</span>() }}
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Любой список, который не помещается на одной странице. Без боли с offset/limit/page.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="columns"></i> Извлечение колонок</div>
  <div class="helper-card">
    <h3><code>pluck()</code></h3>
    <p class="h-what">Извлечь одну колонку. Опционально — построить key=&gt;value мапу.</p>
<pre><code><span class="c-var">$emails</span>  = <span class="c-type">User</span>::<span class="c-fn">pluck</span>(<span class="c-str">'email'</span>);             <span class="c-comment">// [email, email, ...]</span>
<span class="c-var">$options</span> = <span class="c-type">User</span>::<span class="c-fn">pluck</span>(<span class="c-str">'name'</span>, <span class="c-str">'id'</span>);       <span class="c-comment">// [id =&gt; name]</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Опции для <code>&lt;select&gt;</code>, списки email'ов для рассылки.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="link"></i> Relations &amp; eager loading</div>
  <div class="helper-card">
    <h3><code>with()</code> — eager loading</h3>
    <p class="h-what">Подгружает связанные модели одним запросом — спасает от <strong>N+1 проблемы</strong>.</p>
<pre><code><span class="c-comment">// Плохо (N+1):</span>
<span class="c-key">foreach</span> (<span class="c-type">User</span>::<span class="c-fn">all</span>() <span class="c-key">as</span> <span class="c-var">$u</span>) {
    <span class="c-fn">echo</span> <span class="c-var">$u</span>-><span class="c-var">posts</span>-><span class="c-fn">count</span>(); <span class="c-comment">// +1 запрос на каждого юзера</span>
}

<span class="c-comment">// Хорошо (2 запроса всего):</span>
<span class="c-key">foreach</span> (<span class="c-type">User</span>::<span class="c-fn">with</span>(<span class="c-str">'posts'</span>)-><span class="c-fn">get</span>() <span class="c-key">as</span> <span class="c-var">$u</span>) {
    <span class="c-fn">echo</span> <span class="c-var">$u</span>-><span class="c-var">posts</span>-><span class="c-fn">count</span>();
}
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Любая выборка, где потом обращаешься к relations в цикле.</div>
  </div>

  <div class="helper-card">
    <h3><code>whereHas()</code></h3>
    <p class="h-what">Фильтрация по связанной модели — &laquo;есть ли подходящие related&raquo;.</p>
<pre><code><span class="c-comment">// Пользователи, у которых есть хотя бы один опубликованный пост</span>
<span class="c-type">User</span>::<span class="c-fn">whereHas</span>(<span class="c-str">'posts'</span>, <span class="c-key">function</span> (<span class="c-var">$q</span>) {
    <span class="c-var">$q</span>-><span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'published'</span>);
})-><span class="c-fn">get</span>();
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Авторы со статьями, клиенты с заказами, юзеры с подпиской.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="calculator"></i> Существование &amp; счётчики</div>
  <div class="helper-card">
    <h3><code>count()</code> / <code>exists()</code> / <code>doesntExist()</code></h3>
    <p class="h-what">Количество или булевая проверка существования без загрузки моделей.</p>
<pre><code><span class="c-var">$total</span> = <span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'active'</span>, <span class="c-key">true</span>)-><span class="c-fn">count</span>();
<span class="c-key">if</span> (<span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'email'</span>, <span class="c-var">$email</span>)-><span class="c-fn">exists</span>()) { ... }
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Счётчики на дашборде, проверка дубликатов без выгрузки данных.</div>
  </div>
  </div><!-- /subsection -->
</div>

<!-- ════════════════════════════════════════════════════════════════
     COLLECTIONS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-collections" class="section">
  <div class="section-title">Collections</div>
  <p class="text">Все Eloquent-результаты (<code>get()</code>, <code>all()</code>) возвращают <code>Collection</code>. Любой массив можно обернуть через <code>collect()</code>. Методы chain'аются и не мутируют исходное.</p>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="plus-circle"></i> Создание</div>
  <div class="helper-card">
    <h3><code>collect()</code></h3>
    <p class="h-what">Обёртка над массивом — открывает все методы коллекции.</p>
<pre><code><span class="c-var">$nums</span> = <span class="c-fn">collect</span>([<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>, <span class="c-num">4</span>, <span class="c-num">5</span>]);
<span class="c-var">$nums</span>-><span class="c-fn">filter</span>(<span class="c-key">fn</span>(<span class="c-var">$n</span>) =&gt; <span class="c-var">$n</span> % <span class="c-num">2</span> === <span class="c-num">0</span>)-><span class="c-fn">values</span>(); <span class="c-comment">// [2, 4]</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Любая обработка массива — не пиши <code>foreach</code>, используй коллекции.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="repeat"></i> Трансформация</div>
  <div class="helper-card">
    <h3><code>map()</code></h3>
    <p class="h-what">Трансформирует каждый элемент. Возвращает новую коллекцию.</p>
<pre><code><span class="c-var">$prices</span> = <span class="c-fn">collect</span>([<span class="c-num">100</span>, <span class="c-num">200</span>, <span class="c-num">300</span>]);
<span class="c-var">$withTax</span> = <span class="c-var">$prices</span>-><span class="c-fn">map</span>(<span class="c-key">fn</span>(<span class="c-var">$p</span>) =&gt; <span class="c-var">$p</span> * <span class="c-num">1.12</span>);
<span class="c-comment">// [112, 224, 336]</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Применить операцию ко всем элементам — добавить налог, форматировать даты, сериализовать.</div>
  </div>

  <div class="helper-card">
    <h3><code>reduce()</code></h3>
    <p class="h-what">Свёртка коллекции в одно значение (аккумулятор).</p>
<pre><code><span class="c-var">$total</span> = <span class="c-fn">collect</span>([<span class="c-num">100</span>, <span class="c-num">250</span>, <span class="c-num">50</span>])
    -><span class="c-fn">reduce</span>(<span class="c-key">fn</span>(<span class="c-var">$carry</span>, <span class="c-var">$x</span>) =&gt; <span class="c-var">$carry</span> + <span class="c-var">$x</span>, <span class="c-num">0</span>);
<span class="c-comment">// 400</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Сложные агрегации, где <code>sum()</code> не справляется.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="calculator"></i> Агрегаты</div>
  <div class="helper-card">
    <h3><code>sum()</code> / <code>avg()</code> / <code>max()</code> / <code>min()</code></h3>
    <p class="h-what">Базовые агрегаты. Можно передать ключ объекта.</p>
<pre><code><span class="c-var">$invoices</span>-><span class="c-fn">sum</span>(<span class="c-str">'amount'</span>);   <span class="c-comment">// сумма всех amount</span>
<span class="c-var">$grades</span>-><span class="c-fn">avg</span>();              <span class="c-comment">// среднее</span>
<span class="c-var">$products</span>-><span class="c-fn">max</span>(<span class="c-str">'price'</span>);    <span class="c-comment">// макс</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Дашборды, отчёты, статистика.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers-3"></i> Группировка / сортировка / извлечение</div>
  <div class="helper-card">
    <h3><code>groupBy()</code></h3>
    <p class="h-what">Группирует элементы по ключу или результату функции.</p>
<pre><code><span class="c-var">$users</span>-><span class="c-fn">groupBy</span>(<span class="c-str">'role'</span>);
<span class="c-comment">// ['admin' =&gt; [...], 'editor' =&gt; [...]]</span>

<span class="c-var">$orders</span>-><span class="c-fn">groupBy</span>(<span class="c-key">fn</span>(<span class="c-var">$o</span>) =&gt; <span class="c-var">$o</span>-><span class="c-var">created_at</span>-><span class="c-fn">format</span>(<span class="c-str">'Y-m'</span>));
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Отчёты — продажи по месяцам, юзеры по ролям, заказы по статусам.</div>
  </div>

  <div class="helper-card">
    <h3><code>pluck()</code></h3>
    <p class="h-what">То же, что в Eloquent — извлечь одно поле из всех элементов.</p>
<pre><code><span class="c-var">$names</span> = <span class="c-var">$users</span>-><span class="c-fn">pluck</span>(<span class="c-str">'name'</span>);
<span class="c-var">$map</span>   = <span class="c-var">$users</span>-><span class="c-fn">pluck</span>(<span class="c-str">'email'</span>, <span class="c-str">'id'</span>);
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Подготовка данных для select, exports.</div>
  </div>

  <div class="helper-card">
    <h3><code>sortBy()</code> / <code>sortByDesc()</code></h3>
    <p class="h-what">Сортировка коллекции (без модификации БД-запроса).</p>
<pre><code><span class="c-var">$products</span>-><span class="c-fn">sortBy</span>(<span class="c-str">'price'</span>);
<span class="c-var">$products</span>-><span class="c-fn">sortByDesc</span>(<span class="c-str">'created_at'</span>);
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Сортировка уже выгруженных данных или массивов из API.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="filter"></i> Фильтрация / поиск</div>
  <div class="helper-card">
    <h3><code>filter()</code></h3>
    <p class="h-what">Оставляет только элементы, удовлетворяющие условию.</p>
<pre><code><span class="c-var">$active</span> = <span class="c-var">$users</span>-><span class="c-fn">filter</span>(<span class="c-key">fn</span>(<span class="c-var">$u</span>) =&gt; <span class="c-var">$u</span>-><span class="c-var">is_active</span>);
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Удалить inactive/deleted/нерелевантные элементы из выборки.</div>
  </div>

  <div class="helper-card">
    <h3><code>contains()</code></h3>
    <p class="h-what">Проверяет наличие значения в коллекции.</p>
<pre><code><span class="c-var">$emails</span>-><span class="c-fn">contains</span>(<span class="c-str">'a@gmail.com'</span>);             <span class="c-comment">// true/false</span>
<span class="c-var">$users</span>-><span class="c-fn">contains</span>(<span class="c-str">'role'</span>, <span class="c-str">'admin'</span>);             <span class="c-comment">// есть ли админ</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Проверки на наличие, авторизация по ролям.</div>
  </div>

  <div class="helper-card">
    <h3><code>where()</code> / <code>whereIn()</code> на коллекции</h3>
    <p class="h-what">Фильтрация коллекции по ключу/значению (не путать с Eloquent-запросом).</p>
<pre><code><span class="c-var">$over30</span> = <span class="c-var">$users</span>-><span class="c-fn">where</span>(<span class="c-str">'age'</span>, <span class="c-str">'&gt;'</span>, <span class="c-num">30</span>);
<span class="c-var">$admins</span> = <span class="c-var">$users</span>-><span class="c-fn">whereIn</span>(<span class="c-str">'role'</span>, [<span class="c-str">'admin'</span>, <span class="c-str">'owner'</span>]);
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Дополнительная фильтрация уже выбранной из БД коллекции.</div>
  </div>

  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="split"></i> Итерация / bulk</div>
  <div class="helper-card">
    <h3><code>chunk()</code> / <code>each()</code></h3>
    <p class="h-what">Разбивка на куски / итерация.</p>
<pre><code><span class="c-var">$users</span>-><span class="c-fn">chunk</span>(<span class="c-num">100</span>)-><span class="c-fn">each</span>(<span class="c-key">function</span> (<span class="c-var">$chunk</span>) {
    <span class="c-fn">processBatch</span>(<span class="c-var">$chunk</span>);
});
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Bulk-обработка больших выборок без OOM (рассылки, импорты).</div>
  </div>
  </div><!-- /subsection -->
</div>

<!-- ════════════════════════════════════════════════════════════════
     STRINGS (Str)
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-strings" class="section">
  <div class="section-title">Strings — <code>Str</code> хелперы</div>
  <p class="text">Фасад <code>Illuminate\Support\Str</code> — все строковые операции. Часть из них дублирует встроенные PHP-функции, но единообразнее и с поддержкой Unicode.</p>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="link-2"></i> URL &amp; SEO-формат</div>
  <div class="helper-card">
    <h3><code>Str::slug()</code></h3>
    <p class="h-what">URL-friendly slug из строки.</p>
<pre><code><span class="c-type">Str</span>::<span class="c-fn">slug</span>(<span class="c-str">'Laravel Framework Basics!'</span>);
<span class="c-comment">// "laravel-framework-basics"</span>

<span class="c-type">Str</span>::<span class="c-fn">slug</span>(<span class="c-str">'Привет мир'</span>, <span class="c-str">'-'</span>, <span class="c-str">'ru'</span>);
<span class="c-comment">// "privet-mir"</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> URL для блог-постов, продуктов, категорий — SEO-friendly.</div>
  </div>

  <div class="helper-card">
    <h3><code>Str::limit()</code></h3>
    <p class="h-what">Обрезает строку, добавляет &laquo;…&raquo; (или кастомный суффикс).</p>
<pre><code><span class="c-type">Str</span>::<span class="c-fn">limit</span>(<span class="c-str">'Laravel is awesome framework'</span>, <span class="c-num">10</span>);
<span class="c-comment">// "Laravel is..."</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Превью статей, описание товара в карточке, превью комментариев.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="search"></i> Поиск в строке</div>
  <div class="helper-card">
    <h3><code>Str::contains()</code> / <code>startsWith()</code> / <code>endsWith()</code></h3>
    <p class="h-what">Подстроковые проверки.</p>
<pre><code><span class="c-type">Str</span>::<span class="c-fn">contains</span>(<span class="c-str">'user@gmail.com'</span>, <span class="c-str">'@gmail.com'</span>);   <span class="c-comment">// true</span>
<span class="c-type">Str</span>::<span class="c-fn">startsWith</span>(<span class="c-str">'https://site.com'</span>, <span class="c-str">'https'</span>);   <span class="c-comment">// true</span>
<span class="c-type">Str</span>::<span class="c-fn">endsWith</span>(<span class="c-str">'report.pdf'</span>, <span class="c-str">'.pdf'</span>);          <span class="c-comment">// true</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Определение домена email, протокол URL, расширение файла.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shuffle"></i> Случайные значения</div>
  <div class="helper-card">
    <h3><code>Str::random()</code></h3>
    <p class="h-what">Криптостойкая случайная строка указанной длины.</p>
<pre><code><span class="c-var">$token</span> = <span class="c-type">Str</span>::<span class="c-fn">random</span>(<span class="c-num">32</span>);
<span class="c-comment">// "d8ks92j3lqp93jf02ldk9as8dj29dkfj"</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> API-токены, invitation-коды, password reset tokens, magic links.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="case-sensitive"></i> Преобразование текста</div>
  <div class="helper-card">
    <h3><code>Str::replace()</code></h3>
    <p class="h-what">Замена всех вхождений (или массива).</p>
<pre><code><span class="c-type">Str</span>::<span class="c-fn">replace</span>(<span class="c-str">'Java'</span>, <span class="c-str">'Laravel'</span>, <span class="c-str">'I love Java.'</span>);
<span class="c-comment">// "I love Laravel."</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Шаблоны писем (плейсхолдеры), маскирование данных, чистка текста.</div>
  </div>

  <div class="helper-card">
    <h3><code>Str::upper()</code> / <code>lower()</code> / <code>title()</code></h3>
    <p class="h-what">Регистровые преобразования с поддержкой Unicode.</p>
<pre><code><span class="c-type">Str</span>::<span class="c-fn">upper</span>(<span class="c-str">'laravel'</span>);                <span class="c-comment">// "LARAVEL"</span>
<span class="c-type">Str</span>::<span class="c-fn">lower</span>(<span class="c-str">'LARAVEL'</span>);                <span class="c-comment">// "laravel"</span>
<span class="c-type">Str</span>::<span class="c-fn">title</span>(<span class="c-str">'hello world'</span>);           <span class="c-comment">// "Hello World"</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Нормализация email/username перед сохранением, форматирование имён.</div>
  </div>

  <div class="helper-card">
    <h3><code>Str::camel()</code> / <code>snake()</code> / <code>kebab()</code> / <code>studly()</code></h3>
    <p class="h-what">Конвертация между стилями именования.</p>
<pre><code><span class="c-type">Str</span>::<span class="c-fn">camel</span>(<span class="c-str">'hello_world'</span>);    <span class="c-comment">// "helloWorld"</span>
<span class="c-type">Str</span>::<span class="c-fn">snake</span>(<span class="c-str">'HelloWorld'</span>);     <span class="c-comment">// "hello_world"</span>
<span class="c-type">Str</span>::<span class="c-fn">kebab</span>(<span class="c-str">'HelloWorld'</span>);     <span class="c-comment">// "hello-world"</span>
<span class="c-type">Str</span>::<span class="c-fn">studly</span>(<span class="c-str">'hello_world'</span>);   <span class="c-comment">// "HelloWorld" (PascalCase)</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Генерация имён классов/методов, API-ключи в snake_case, CSS-классы в kebab-case.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="fingerprint"></i> Идентификаторы</div>
  <div class="helper-card">
    <h3><code>Str::uuid()</code> / <code>Str::ulid()</code></h3>
    <p class="h-what">Генерация UUID v4 / ULID (сортируемый по времени).</p>
<pre><code><span class="c-var">$id</span> = (string) <span class="c-type">Str</span>::<span class="c-fn">uuid</span>();
<span class="c-comment">// "a1b2c3d4-e5f6-7890-abcd-ef1234567890"</span>

<span class="c-var">$id</span> = (string) <span class="c-type">Str</span>::<span class="c-fn">ulid</span>();
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Публичные ID (не утечь auto-increment), distributed ID, ключи для S3.</div>
  </div>
  </div><!-- /subsection -->
</div>

<!-- ════════════════════════════════════════════════════════════════
     ARRAYS (Arr)
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-arrays" class="section">
  <div class="section-title">Arrays — <code>Arr</code> хелперы</div>
  <p class="text">Фасад <code>Illuminate\Support\Arr</code> — операции над PHP-массивами с поддержкой <strong>dot-notation</strong> для вложенных ключей.</p>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="key-round"></i> Доступ по ключу</div>
  <div class="helper-card">
    <h3><code>Arr::get()</code></h3>
    <p class="h-what">Безопасное чтение по dot-пути. Не падает на отсутствующих ключах.</p>
<pre><code><span class="c-var">$data</span> = [<span class="c-str">'user'</span> =&gt; [<span class="c-str">'profile'</span> =&gt; [<span class="c-str">'email'</span> =&gt; <span class="c-str">'a@x.com'</span>]]];

<span class="c-type">Arr</span>::<span class="c-fn">get</span>(<span class="c-var">$data</span>, <span class="c-str">'user.profile.email'</span>);     <span class="c-comment">// "a@x.com"</span>
<span class="c-type">Arr</span>::<span class="c-fn">get</span>(<span class="c-var">$data</span>, <span class="c-str">'user.profile.phone'</span>, <span class="c-str">'N/A'</span>); <span class="c-comment">// "N/A"</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Чтение JSON-ответов API без каскадов <code>isset()</code>.</div>
  </div>

  <div class="helper-card">
    <h3><code>Arr::has()</code></h3>
    <p class="h-what">Проверка существования по dot-пути.</p>
<pre><code><span class="c-key">if</span> (<span class="c-type">Arr</span>::<span class="c-fn">has</span>(<span class="c-var">$data</span>, <span class="c-str">'user.profile.email'</span>)) { ... }
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Опциональные конфиги, проверка вложенных ключей в payload.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield"></i> Whitelist / Blacklist</div>
  <div class="helper-card">
    <h3><code>Arr::only()</code> / <code>Arr::except()</code></h3>
    <p class="h-what">Whitelist / blacklist ключей.</p>
<pre><code><span class="c-type">Arr</span>::<span class="c-fn">only</span>(<span class="c-var">$user</span>, [<span class="c-str">'id'</span>, <span class="c-str">'name'</span>, <span class="c-str">'email'</span>]);
<span class="c-type">Arr</span>::<span class="c-fn">except</span>(<span class="c-var">$user</span>, [<span class="c-str">'password'</span>, <span class="c-str">'token'</span>]);
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Подготовка публичного API-ответа, удаление чувствительных полей перед логированием.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="edit"></i> Мутация</div>
  <div class="helper-card">
    <h3><code>Arr::set()</code> / <code>Arr::forget()</code></h3>
    <p class="h-what">Установка / удаление по dot-пути. Создаёт вложенные структуры при необходимости.</p>
<pre><code><span class="c-var">$data</span> = [];
<span class="c-type">Arr</span>::<span class="c-fn">set</span>(<span class="c-var">$data</span>, <span class="c-str">'user.profile.email'</span>, <span class="c-str">'a@x.com'</span>);
<span class="c-comment">// ['user' =&gt; ['profile' =&gt; ['email' =&gt; 'a@x.com']]]</span>

<span class="c-type">Arr</span>::<span class="c-fn">forget</span>(<span class="c-var">$data</span>, <span class="c-str">'user.profile.email'</span>);
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Динамическое построение конфигов, мутация nested данных.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="search"></i> Извлечение / поиск</div>
  <div class="helper-card">
    <h3><code>Arr::pluck()</code></h3>
    <p class="h-what">Извлечь колонку из массива объектов/массивов.</p>
<pre><code><span class="c-type">Arr</span>::<span class="c-fn">pluck</span>(<span class="c-var">$users</span>, <span class="c-str">'email'</span>);
<span class="c-type">Arr</span>::<span class="c-fn">pluck</span>(<span class="c-var">$users</span>, <span class="c-str">'email'</span>, <span class="c-str">'id'</span>); <span class="c-comment">// [id =&gt; email]</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> То же, что collection pluck, но для raw PHP-массивов.</div>
  </div>

  <div class="helper-card">
    <h3><code>Arr::first()</code> / <code>Arr::last()</code></h3>
    <p class="h-what">Первый/последний элемент, опц. по условию.</p>
<pre><code><span class="c-type">Arr</span>::<span class="c-fn">first</span>([<span class="c-num">10</span>, <span class="c-num">20</span>, <span class="c-num">30</span>], <span class="c-key">fn</span>(<span class="c-var">$v</span>) =&gt; <span class="c-var">$v</span> &gt; <span class="c-num">15</span>); <span class="c-comment">// 20</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Найти первый матч без явного цикла.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Структура / преобразование</div>
  <div class="helper-card">
    <h3><code>Arr::flatten()</code> / <code>Arr::collapse()</code></h3>
    <p class="h-what">Сплющивание вложенных массивов.</p>
<pre><code><span class="c-type">Arr</span>::<span class="c-fn">flatten</span>([[<span class="c-str">'a'</span>,<span class="c-str">'b'</span>], [<span class="c-str">'c'</span>]]);  <span class="c-comment">// ['a','b','c']</span>
<span class="c-type">Arr</span>::<span class="c-fn">collapse</span>([[<span class="c-num">1</span>,<span class="c-num">2</span>], [<span class="c-num">3</span>,<span class="c-num">4</span>]]);  <span class="c-comment">// [1,2,3,4]</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Сведение групп тегов в один список, объединение результатов из chunk'ов.</div>
  </div>

  <div class="helper-card">
    <h3><code>Arr::wrap()</code></h3>
    <p class="h-what">Если не массив — обернёт в массив. <code>null</code> → <code>[]</code>.</p>
<pre><code><span class="c-type">Arr</span>::<span class="c-fn">wrap</span>(<span class="c-str">'apple'</span>);   <span class="c-comment">// ['apple']</span>
<span class="c-type">Arr</span>::<span class="c-fn">wrap</span>([<span class="c-str">'a'</span>, <span class="c-str">'b'</span>]); <span class="c-comment">// ['a', 'b']</span>
<span class="c-type">Arr</span>::<span class="c-fn">wrap</span>(<span class="c-key">null</span>);      <span class="c-comment">// []</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> API, где параметр может быть скаляром или массивом — всегда приводи к массиву.</div>
  </div>

  <div class="helper-card">
    <h3><code>Arr::random()</code></h3>
    <p class="h-what">Случайный элемент (или несколько).</p>
<pre><code><span class="c-type">Arr</span>::<span class="c-fn">random</span>([<span class="c-str">'red'</span>, <span class="c-str">'blue'</span>, <span class="c-str">'green'</span>]);
<span class="c-type">Arr</span>::<span class="c-fn">random</span>([<span class="c-str">'red'</span>, <span class="c-str">'blue'</span>, <span class="c-str">'green'</span>], <span class="c-num">2</span>); <span class="c-comment">// 2 случайных</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Случайные баннеры, A/B тестирование, тестовые данные.</div>
  </div>
  </div><!-- /subsection -->
</div>

<!-- ════════════════════════════════════════════════════════════════
     DATES (Carbon)
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-dates" class="section">
  <div class="section-title">Dates &amp; Time — Carbon</div>
  <p class="text">Все даты в Laravel — <code>Carbon\Carbon</code> (расширение PHP <code>DateTime</code>). Eloquent timestamps (<code>created_at</code>, <code>updated_at</code>) тоже Carbon-инстансы.</p>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="clock"></i> Текущее время</div>
  <div class="helper-card">
    <h3><code>now()</code> / <code>today()</code></h3>
    <p class="h-what">Текущее время / начало текущего дня (00:00:00).</p>
<pre><code><span class="c-fn">now</span>();    <span class="c-comment">// 2026-05-14 18:35:42</span>
<span class="c-fn">today</span>();  <span class="c-comment">// 2026-05-14 00:00:00</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Timestamps в БД, расчёт дедлайнов от текущего момента.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="plus-minus"></i> Арифметика дат</div>
  <div class="helper-card">
    <h3><code>addDays()</code> / <code>subDays()</code> / <code>addHours()</code> / <code>subMinutes()</code></h3>
    <p class="h-what">Математика над датами. Возвращает новый Carbon-инстанс (chainable).</p>
<pre><code><span class="c-fn">now</span>()-><span class="c-fn">addDays</span>(<span class="c-num">7</span>);          <span class="c-comment">// +7 дней</span>
<span class="c-fn">now</span>()-><span class="c-fn">subHours</span>(<span class="c-num">2</span>);         <span class="c-comment">// -2 часа</span>
<span class="c-fn">now</span>()-><span class="c-fn">addMonths</span>(<span class="c-num">3</span>)-><span class="c-fn">endOfDay</span>(); <span class="c-comment">// +3 месяца, конец дня</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Trial-период, истечение токена, дата следующего платежа.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="text"></i> Форматирование &amp; вывод</div>
  <div class="helper-card">
    <h3><code>format()</code></h3>
    <p class="h-what">Формат вывода (через стандартные PHP-токены: <code>Y</code>, <code>m</code>, <code>d</code>, <code>H</code>, <code>i</code>, <code>s</code>).</p>
<pre><code><span class="c-fn">now</span>()-><span class="c-fn">format</span>(<span class="c-str">'d/m/Y H:i'</span>);   <span class="c-comment">// "14/05/2026 18:35"</span>
<span class="c-fn">now</span>()-><span class="c-fn">format</span>(<span class="c-str">'Y-m-d'</span>);       <span class="c-comment">// "2026-05-14"</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Локализованный вывод дат в UI, ключи логов.</div>
  </div>

  <div class="helper-card">
    <h3><code>diffForHumans()</code></h3>
    <p class="h-what">Человеко-читаемое расхождение: «5 минут назад», «in 3 days».</p>
<pre><code><span class="c-fn">now</span>()-><span class="c-fn">subMinutes</span>(<span class="c-num">10</span>)-><span class="c-fn">diffForHumans</span>();
<span class="c-comment">// "10 minutes ago"</span>

<span class="c-fn">now</span>()-><span class="c-fn">addDays</span>(<span class="c-num">3</span>)-><span class="c-fn">diffForHumans</span>();
<span class="c-comment">// "in 3 days"</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Ленты, уведомления, активность — «комментарий 5 минут назад».</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-pull-request"></i> Парсинг</div>
  <div class="helper-card">
    <h3><code>Carbon::parse()</code></h3>
    <p class="h-what">Парсинг строки в Carbon-объект.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Carbon\Carbon</span>;

<span class="c-var">$date</span> = <span class="c-type">Carbon</span>::<span class="c-fn">parse</span>(<span class="c-str">'2026-12-31 23:59:59'</span>);
<span class="c-var">$date</span>-><span class="c-fn">format</span>(<span class="c-str">'l, d M Y'</span>); <span class="c-comment">// "Thursday, 31 Dec 2026"</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Конвертация строк из API/CSV в Carbon перед сохранением или сравнением.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Проверки</div>
  <div class="helper-card">
    <h3><code>isPast()</code> / <code>isFuture()</code> / <code>isToday()</code></h3>
    <p class="h-what">Булевые проверки.</p>
<pre><code><span class="c-key">if</span> (<span class="c-var">$user</span>-><span class="c-var">trial_ends_at</span>-><span class="c-fn">isPast</span>()) {
    <span class="c-fn">deactivate</span>(<span class="c-var">$user</span>);
}
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Проверка просроченных подписок, токенов, событий.</div>
  </div>
  </div><!-- /subsection -->
</div>

<!-- ════════════════════════════════════════════════════════════════
     SESSION & AUTH
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-session-auth" class="section">
  <div class="section-title">Session &amp; Authentication</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="archive"></i> Сессия</div>
  <div class="helper-card">
    <h3><code>session()</code></h3>
    <p class="h-what">Чтение / запись сессии. Без аргументов — возвращает менеджер.</p>
<pre><code><span class="c-fn">session</span>([<span class="c-str">'cart_count'</span> =&gt; <span class="c-num">5</span>]);    <span class="c-comment">// записать</span>
<span class="c-var">$count</span> = <span class="c-fn">session</span>(<span class="c-str">'cart_count'</span>, <span class="c-num">0</span>); <span class="c-comment">// читать с default</span>
<span class="c-fn">session</span>()-><span class="c-fn">forget</span>(<span class="c-str">'cart_count'</span>);    <span class="c-comment">// удалить</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Корзина, шаги мастер-форм, временные настройки UI.</div>
  </div>

  <div class="helper-card">
    <h3><code>session()-&gt;flash()</code></h3>
    <p class="h-what">Сохраняет значение <strong>только на следующий запрос</strong>.</p>
<pre><code><span class="c-fn">session</span>()-><span class="c-fn">flash</span>(<span class="c-str">'status'</span>, <span class="c-str">'Profile updated!'</span>);
<span class="c-comment">// эквивалент: redirect()->with('status', '...')</span>

<span class="c-comment">// В Blade на следующей странице:</span>
@if(<span class="c-fn">session</span>(<span class="c-str">'status'</span>))
    &lt;div class=<span class="c-str">"alert"</span>&gt;{{ <span class="c-fn">session</span>(<span class="c-str">'status'</span>) }}&lt;/div&gt;
@endif
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Однократные сообщения — «Сохранено», «Ошибка», «Удалено».</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="user"></i> Текущий пользователь</div>
  <div class="helper-card">
    <h3><code>auth()-&gt;user()</code> / <code>auth()-&gt;id()</code></h3>
    <p class="h-what">Текущий аутентифицированный юзер (модель) или его ID.</p>
<pre><code><span class="c-var">$user</span>   = <span class="c-fn">auth</span>()-><span class="c-fn">user</span>();
<span class="c-var">$userId</span> = <span class="c-fn">auth</span>()-><span class="c-fn">id</span>();

<span class="c-comment">// shortcut в Blade:</span>
@<span class="c-fn">auth</span>
    Привет, {{ <span class="c-fn">auth</span>()-><span class="c-fn">user</span>()-><span class="c-fn">name</span> }}
@endauth
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Авторская атрибуция (<code>created_by =&gt; auth()->id()</code>), персонализация UI.</div>
  </div>

  <div class="helper-card">
    <h3><code>auth()-&gt;check()</code> / <code>auth()-&gt;guest()</code></h3>
    <p class="h-what">Аутентифицирован или нет.</p>
<pre><code><span class="c-key">if</span> (<span class="c-fn">auth</span>()-><span class="c-fn">check</span>()) {
    <span class="c-comment">// залогинен</span>
}

<span class="c-key">if</span> (<span class="c-fn">auth</span>()-><span class="c-fn">guest</span>()) {
    <span class="c-key">return</span> <span class="c-fn">redirect</span>()-><span class="c-fn">route</span>(<span class="c-str">'login'</span>);
}
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Условный рендеринг, защита маршрутов вне middleware.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="key"></i> Пароли &amp; вход</div>
  <div class="helper-card">
    <h3><code>bcrypt()</code> / <code>Hash::make()</code></h3>
    <p class="h-what">Хэширование пароля. Алгоритм bcrypt с salt.</p>
<pre><code><span class="c-type">User</span>::<span class="c-fn">create</span>([
    <span class="c-str">'email'</span>    =&gt; <span class="c-var">$request</span>-><span class="c-fn">input</span>(<span class="c-str">'email'</span>),
    <span class="c-str">'password'</span> =&gt; <span class="c-fn">bcrypt</span>(<span class="c-var">$request</span>-><span class="c-fn">input</span>(<span class="c-str">'password'</span>)),
]);

<span class="c-comment">// При логине — Hash::check() сравнивает без расхэширования:</span>
<span class="c-type">Hash</span>::<span class="c-fn">check</span>(<span class="c-var">$plain</span>, <span class="c-var">$user</span>-><span class="c-var">password</span>);
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Регистрация, смена пароля. <strong>Никогда</strong> не сохраняй plain-пароли.</div>
  </div>

  <div class="helper-card">
    <h3><code>Auth::attempt()</code> / <code>Auth::logout()</code></h3>
    <p class="h-what">Логин по credentials и выход из сессии.</p>
<pre><code><span class="c-key">if</span> (<span class="c-type">Auth</span>::<span class="c-fn">attempt</span>([
    <span class="c-str">'email'</span>    =&gt; <span class="c-var">$request</span>-><span class="c-fn">email</span>,
    <span class="c-str">'password'</span> =&gt; <span class="c-var">$request</span>-><span class="c-fn">password</span>,
])) {
    <span class="c-var">$request</span>-><span class="c-fn">session</span>()-><span class="c-fn">regenerate</span>(); <span class="c-comment">// защита от session fixation</span>
    <span class="c-key">return</span> <span class="c-fn">redirect</span>()-><span class="c-fn">intended</span>(<span class="c-str">'/'</span>);
}

<span class="c-type">Auth</span>::<span class="c-fn">logout</span>();
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Кастомный login-контроллер.</div>
  </div>
  </div><!-- /subsection -->
</div>

<!-- ════════════════════════════════════════════════════════════════
     ROUTING & VIEWS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-routing" class="section">
  <div class="section-title">Routing &amp; Views</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="link"></i> Генерация URL</div>
  <div class="helper-card">
    <h3><code>route()</code></h3>
    <p class="h-what">URL по имени маршрута. Параметры подставляются автоматически.</p>
<pre><code><span class="c-comment">// routes/web.php</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/posts/{post}'</span>, [<span class="c-type">PostController</span>::<span class="c-key">class</span>, <span class="c-str">'show'</span>])-><span class="c-fn">name</span>(<span class="c-str">'posts.show'</span>);

<span class="c-comment">// В контроллере / Blade</span>
<span class="c-fn">route</span>(<span class="c-str">'posts.show'</span>, <span class="c-var">$post</span>);             <span class="c-comment">// /posts/5</span>
<span class="c-fn">route</span>(<span class="c-str">'posts.show'</span>, [<span class="c-str">'post'</span> =&gt; <span class="c-num">5</span>]);     <span class="c-comment">// /posts/5</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Никогда не хардкодь URL'ы — переименуешь путь и всё сломается.</div>
  </div>

  <div class="helper-card">
    <h3><code>url()</code></h3>
    <p class="h-what">Абсолютный URL из пути.</p>
<pre><code><span class="c-fn">url</span>(<span class="c-str">'/contact'</span>);          <span class="c-comment">// https://site.com/contact</span>
<span class="c-fn">url</span>()-><span class="c-fn">current</span>();         <span class="c-comment">// URL текущей страницы</span>
<span class="c-fn">url</span>()-><span class="c-fn">previous</span>();        <span class="c-comment">// referrer</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Письма, webhooks, OAuth-redirect URI.</div>
  </div>

  <div class="helper-card">
    <h3><code>asset()</code></h3>
    <p class="h-what">URL к файлу в <code>public/</code>.</p>
<pre><code>&lt;link rel=<span class="c-str">"stylesheet"</span> href=<span class="c-str">"{{ asset('css/app.css') }}"</span>&gt;
&lt;img src=<span class="c-str">"{{ asset('img/logo.png') }}"</span>&gt;
</code></pre>
    <div class="h-use"><strong>Use case:</strong> CSS, JS, картинки в Blade. С Vite используется <code>@vite()</code>.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layout"></i> Рендеринг Blade</div>
  <div class="helper-card">
    <h3><code>view()</code></h3>
    <p class="h-what">Рендеринг Blade-шаблона с данными.</p>
<pre><code><span class="c-key">return</span> <span class="c-fn">view</span>(<span class="c-str">'posts.show'</span>, [
    <span class="c-str">'post'</span>     =&gt; <span class="c-var">$post</span>,
    <span class="c-str">'comments'</span> =&gt; <span class="c-var">$post</span>-><span class="c-var">comments</span>,
]);
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Базовый возврат из контроллера.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="corner-down-right"></i> Редиректы</div>
  <div class="helper-card">
    <h3><code>redirect()</code></h3>
    <p class="h-what">HTTP-редирект. Поддерживает имена маршрутов, обратные ссылки, flash-данные.</p>
<pre><code><span class="c-key">return</span> <span class="c-fn">redirect</span>(<span class="c-str">'/dashboard'</span>);
<span class="c-key">return</span> <span class="c-fn">redirect</span>()-><span class="c-fn">route</span>(<span class="c-str">'home'</span>);
<span class="c-key">return</span> <span class="c-fn">redirect</span>()-><span class="c-fn">back</span>()-><span class="c-fn">with</span>(<span class="c-str">'error'</span>, <span class="c-str">'Wrong data'</span>);
<span class="c-key">return</span> <span class="c-fn">redirect</span>()-><span class="c-fn">intended</span>(<span class="c-str">'/'</span>); <span class="c-comment">// после login — туда, куда хотел юзер</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> После форм (POST → Redirect → GET), после логина, при ошибках валидации.</div>
  </div>

  <div class="helper-card">
    <h3><code>back()</code></h3>
    <p class="h-what">Алиас <code>redirect()->back()</code>.</p>
<pre><code><span class="c-key">return</span> <span class="c-fn">back</span>()-><span class="c-fn">withErrors</span>(<span class="c-var">$validator</span>)-><span class="c-fn">withInput</span>();
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Возврат на предыдущую страницу с ошибками валидации и сохранёнными данными формы.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="send"></i> Ответы (API)</div>
  <div class="helper-card">
    <h3><code>response()-&gt;json()</code></h3>
    <p class="h-what">JSON-ответ с правильными заголовками.</p>
<pre><code><span class="c-key">return</span> <span class="c-fn">response</span>()-><span class="c-fn">json</span>([
    <span class="c-str">'status'</span> =&gt; <span class="c-str">'ok'</span>,
    <span class="c-str">'data'</span>   =&gt; <span class="c-var">$user</span>,
], <span class="c-num">200</span>);
</code></pre>
    <div class="h-use"><strong>Use case:</strong> API-эндпоинты, AJAX-ответы.</div>
  </div>
  </div><!-- /subsection -->
</div>

<!-- ════════════════════════════════════════════════════════════════
     DEBUG & MISC
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-debug" class="section">
  <div class="section-title">Debug &amp; Misc</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="bug"></i> Отладка</div>
  <div class="helper-card">
    <h3><code>dd()</code> — dump &amp; die</h3>
    <p class="h-what">Печатает значение и завершает выполнение.</p>
<pre><code><span class="c-fn">dd</span>(<span class="c-var">$user</span>);
<span class="c-fn">dd</span>(<span class="c-var">$request</span>-><span class="c-fn">all</span>(), <span class="c-var">$user</span>); <span class="c-comment">// можно несколько</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Основной инструмент отладки — посмотреть значение и остановиться.</div>
  </div>

  <div class="helper-card">
    <h3><code>dump()</code></h3>
    <p class="h-what">Печатает, но <strong>не останавливает</strong> выполнение.</p>
<pre><code><span class="c-fn">dump</span>(<span class="c-var">$step1</span>);
<span class="c-fn">dump</span>(<span class="c-var">$step2</span>);
<span class="c-key">return</span> <span class="c-fn">view</span>(<span class="c-str">'page'</span>); <span class="c-comment">// выполнение продолжится</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Логирование промежуточных значений без остановки.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="octagon-x"></i> Прерывание / guard'ы</div>
  <div class="helper-card">
    <h3><code>abort()</code></h3>
    <p class="h-what">Прервать запрос с HTTP-ошибкой.</p>
<pre><code><span class="c-fn">abort</span>(<span class="c-num">404</span>);
<span class="c-fn">abort</span>(<span class="c-num">403</span>, <span class="c-str">'Доступ запрещён'</span>);
<span class="c-fn">abort_if</span>(!<span class="c-fn">auth</span>()-><span class="c-fn">user</span>()-><span class="c-fn">isAdmin</span>(), <span class="c-num">403</span>);
<span class="c-fn">abort_unless</span>(<span class="c-var">$user</span>-><span class="c-var">active</span>, <span class="c-num">403</span>);
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Защита маршрутов, гард ресурсов, ранний выход из метода.</div>
  </div>

  <div class="helper-card">
    <h3><code>throw_if()</code> / <code>throw_unless()</code></h3>
    <p class="h-what">Условный throw — компактнее, чем if + throw.</p>
<pre><code><span class="c-fn">throw_if</span>(<span class="c-var">$user</span>-><span class="c-var">balance</span> &lt; <span class="c-num">0</span>, <span class="c-type">InsufficientFundsException</span>::<span class="c-key">class</span>);
<span class="c-fn">throw_unless</span>(<span class="c-var">$user</span>-><span class="c-var">verified</span>, <span class="c-type">UnverifiedException</span>::<span class="c-key">class</span>);
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Guard clauses в бизнес-логике.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="settings"></i> Конфигурация &amp; окружение</div>
  <div class="helper-card">
    <h3><code>config()</code></h3>
    <p class="h-what">Чтение / запись конфигурации (из <code>config/*.php</code>).</p>
<pre><code><span class="c-fn">config</span>(<span class="c-str">'app.name'</span>);                       <span class="c-comment">// чтение</span>
<span class="c-fn">config</span>([<span class="c-str">'app.name'</span> =&gt; <span class="c-str">'NewApp'</span>]);          <span class="c-comment">// запись (на runtime)</span>
<span class="c-fn">config</span>(<span class="c-str">'services.stripe.key'</span>);
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Доступ к настройкам приложения. <strong>Предпочтительно</strong> <code>config()</code>, а не прямой <code>env()</code> в коде — конфиги кешируются.</div>
  </div>

  <div class="helper-card">
    <h3><code>env()</code></h3>
    <p class="h-what">Чтение из <code>.env</code>. ⚠️ Работает только если <code>config:cache</code> НЕ запущен.</p>
<pre><code><span class="c-fn">env</span>(<span class="c-str">'APP_ENV'</span>);                  <span class="c-comment">// "local" / "production"</span>
<span class="c-fn">env</span>(<span class="c-str">'STRIPE_KEY'</span>, <span class="c-str">'default'</span>);
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Только в <code>config/*.php</code> файлах. В контроллерах используй <code>config()</code>.</div>
  </div>
  </div><!-- /subsection -->

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Кэш &amp; утилиты</div>
  <div class="helper-card">
    <h3><code>tap()</code></h3>
    <p class="h-what">Выполняет действие над объектом и возвращает сам объект.</p>
<pre><code><span class="c-key">return</span> <span class="c-fn">tap</span>(<span class="c-type">User</span>::<span class="c-fn">create</span>(<span class="c-var">$data</span>), <span class="c-key">function</span> (<span class="c-var">$user</span>) {
    <span class="c-var">$user</span>-><span class="c-fn">sendWelcomeEmail</span>();
}); <span class="c-comment">// вернёт $user (а не результат sendWelcomeEmail)</span>
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Side-effect после создания / обновления модели без потери chainability.</div>
  </div>

  <div class="helper-card">
    <h3><code>cache()</code></h3>
    <p class="h-what">Чтение / запись кэша.</p>
<pre><code><span class="c-fn">cache</span>([<span class="c-str">'key'</span> =&gt; <span class="c-str">'value'</span>], <span class="c-fn">now</span>()-><span class="c-fn">addMinutes</span>(<span class="c-num">10</span>));
<span class="c-fn">cache</span>(<span class="c-str">'key'</span>, <span class="c-str">'default'</span>);

<span class="c-comment">// Remember pattern — если нет, вычислить и сохранить:</span>
<span class="c-type">Cache</span>::<span class="c-fn">remember</span>(<span class="c-str">'users.count'</span>, <span class="c-num">60</span>, <span class="c-key">fn</span>() =&gt; <span class="c-type">User</span>::<span class="c-fn">count</span>());
</code></pre>
    <div class="h-use"><strong>Use case:</strong> Тяжёлые запросы (счётчики, агрегаты), внешние API.</div>
  </div>
  </div><!-- /subsection -->
</div>

<!-- ════════════════════════════════════════════════════════════════
     ARTISAN
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-artisan" class="section">
  <div class="section-title">Artisan CLI</div>
  <p class="text">Командная строка Laravel. Все артефакты (контроллеры, модели, миграции) генерируются командой.</p>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Генерация</div>
    <table class="data-table">
      <tr><th>Команда</th><th>Что делает</th></tr>
      <tr><td><code>php artisan make:model Post -mfsc</code></td><td>Модель + миграция + factory + seeder + controller</td></tr>
      <tr><td><code>php artisan make:controller PostController --resource</code></td><td>Resource controller (7 методов CRUD)</td></tr>
      <tr><td><code>php artisan make:request StorePostRequest</code></td><td>FormRequest для валидации</td></tr>
      <tr><td><code>php artisan make:migration create_posts_table</code></td><td>Новая миграция</td></tr>
      <tr><td><code>php artisan make:seeder PostSeeder</code></td><td>Seeder</td></tr>
      <tr><td><code>php artisan make:factory PostFactory --model=Post</code></td><td>Factory</td></tr>
      <tr><td><code>php artisan make:middleware EnsureUserIsAdmin</code></td><td>Middleware</td></tr>
      <tr><td><code>php artisan make:job ProcessPayment</code></td><td>Job для очереди</td></tr>
      <tr><td><code>php artisan make:notification InvoicePaid</code></td><td>Notification</td></tr>
      <tr><td><code>php artisan make:mail OrderShipped</code></td><td>Mailable</td></tr>
      <tr><td><code>php artisan make:event OrderPlaced</code></td><td>Event</td></tr>
      <tr><td><code>php artisan make:listener SendOrderEmail --event=OrderPlaced</code></td><td>Listener</td></tr>
      <tr><td><code>php artisan make:policy PostPolicy --model=Post</code></td><td>Authorization Policy</td></tr>
      <tr><td><code>php artisan make:command SendReports</code></td><td>Артизан-команда</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> База данных</div>
    <table class="data-table">
      <tr><th>Команда</th><th>Что делает</th></tr>
      <tr><td><code>php artisan migrate</code></td><td>Применить новые миграции</td></tr>
      <tr><td><code>php artisan migrate:rollback</code></td><td>Откатить последнюю партию</td></tr>
      <tr><td><code>php artisan migrate:fresh --seed</code></td><td>Drop all → migrate → seed (dev only!)</td></tr>
      <tr><td><code>php artisan db:seed</code></td><td>Запустить DatabaseSeeder</td></tr>
      <tr><td><code>php artisan db:seed --class=PostSeeder</code></td><td>Один сидер</td></tr>
      <tr><td><code>php artisan db:wipe</code></td><td>Удалить ВСЕ таблицы (опасно)</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="search"></i> Диагностика</div>
    <table class="data-table">
      <tr><th>Команда</th><th>Что делает</th></tr>
      <tr><td><code>php artisan route:list</code></td><td>Все маршруты с middleware и actions</td></tr>
      <tr><td><code>php artisan route:list --name=user</code></td><td>Фильтр по имени</td></tr>
      <tr><td><code>php artisan tinker</code></td><td>REPL — интерактивно дергать модели/код</td></tr>
      <tr><td><code>php artisan about</code></td><td>Версии, окружение, кэши</td></tr>
      <tr><td><code>php artisan config:show database</code></td><td>Просмотр конфига секции</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Очереди и расписание</div>
    <table class="data-table">
      <tr><th>Команда</th><th>Что делает</th></tr>
      <tr><td><code>php artisan queue:work</code></td><td>Воркер очереди (foreground)</td></tr>
      <tr><td><code>php artisan queue:listen</code></td><td>Воркер, перезагружается при изменениях кода</td></tr>
      <tr><td><code>php artisan queue:retry all</code></td><td>Перезапустить failed jobs</td></tr>
      <tr><td><code>php artisan schedule:work</code></td><td>Локальный планировщик (вместо cron)</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="rocket"></i> Производительность / деплой</div>
    <table class="data-table">
      <tr><th>Команда</th><th>Когда</th></tr>
      <tr><td><code>php artisan config:cache</code></td><td>На проде — кэш конфигов</td></tr>
      <tr><td><code>php artisan route:cache</code></td><td>На проде — кэш маршрутов</td></tr>
      <tr><td><code>php artisan view:cache</code></td><td>Прекомпилировать Blade</td></tr>
      <tr><td><code>php artisan optimize</code></td><td>Все кэши разом</td></tr>
      <tr><td><code>php artisan optimize:clear</code></td><td>Сбросить все кэши (после изменений)</td></tr>
    </table>
  </div>

  <div class="info-box warning">
    <strong>Tinker — лучший друг изучающего Laravel:</strong>
<pre style="margin-top:8px;margin-bottom:0;"><code>php artisan tinker

&gt;&gt;&gt; <span class="c-type">User</span>::<span class="c-fn">count</span>();
&gt;&gt;&gt; <span class="c-type">User</span>::<span class="c-fn">factory</span>()-><span class="c-fn">count</span>(<span class="c-num">10</span>)-><span class="c-fn">create</span>();
&gt;&gt;&gt; <span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'email'</span>, <span class="c-str">'me@x.com'</span>)-><span class="c-fn">first</span>()-><span class="c-fn">delete</span>();</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     CHEAT SHEET
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-cheatsheet" class="section">
  <div class="section-title">Шпаргалка — всё в одном</div>
  <p class="text">Сжатый эталон для быстрого вспоминания. Скопируй в Tinker для проверки.</p>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-down-to-line"></i> Request</div>
<pre><code><span class="c-fn">request</span>(<span class="c-str">'field'</span>);
<span class="c-var">$request</span>-><span class="c-fn">input</span>(<span class="c-str">'name'</span>, <span class="c-str">'default'</span>);
<span class="c-var">$request</span>-><span class="c-fn">filled</span>(<span class="c-str">'email'</span>);
<span class="c-var">$request</span>-><span class="c-fn">has</span>(<span class="c-str">'promo'</span>);
<span class="c-var">$request</span>-><span class="c-fn">only</span>([<span class="c-str">'email'</span>, <span class="c-str">'name'</span>]);
<span class="c-var">$request</span>-><span class="c-fn">except</span>([<span class="c-str">'_token'</span>, <span class="c-str">'password'</span>]);
<span class="c-fn">old</span>(<span class="c-str">'email'</span>);
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-square"></i> Validation</div>
<pre><code><span class="c-var">$request</span>-><span class="c-fn">validate</span>([
    <span class="c-str">'email'</span>      =&gt; <span class="c-str">'required|email|unique:users,email'</span>,
    <span class="c-str">'password'</span>   =&gt; <span class="c-str">'required|confirmed|min:8'</span>,
    <span class="c-str">'role'</span>       =&gt; [<span class="c-str">'required'</span>, <span class="c-type">Rule</span>::<span class="c-fn">in</span>([<span class="c-str">'admin'</span>, <span class="c-str">'editor'</span>, <span class="c-str">'user'</span>])],
    <span class="c-str">'start_date'</span> =&gt; <span class="c-str">'required|date'</span>,
    <span class="c-str">'end_date'</span>   =&gt; <span class="c-str">'required|date|after:start_date'</span>,
    <span class="c-str">'tags'</span>       =&gt; <span class="c-str">'array'</span>,
    <span class="c-str">'tags.*'</span>     =&gt; <span class="c-str">'string|distinct'</span>,
    <span class="c-str">'profile'</span>    =&gt; <span class="c-str">'sometimes|json'</span>,
    <span class="c-str">'avatar'</span>     =&gt; <span class="c-str">'image|mimes:jpg,png|max:2048'</span>,
]);
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> Eloquent</div>
<pre><code><span class="c-type">User</span>::<span class="c-fn">all</span>();
<span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-num">1</span>);
<span class="c-type">User</span>::<span class="c-fn">findOrFail</span>(<span class="c-num">1</span>);
<span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'active'</span>)-><span class="c-fn">get</span>();
<span class="c-type">User</span>::<span class="c-fn">whereIn</span>(<span class="c-str">'id'</span>, [<span class="c-num">1</span>,<span class="c-num">2</span>,<span class="c-num">3</span>])-><span class="c-fn">get</span>();
<span class="c-type">User</span>::<span class="c-fn">with</span>(<span class="c-str">'posts'</span>)-><span class="c-fn">get</span>();
<span class="c-type">User</span>::<span class="c-fn">whereHas</span>(<span class="c-str">'posts'</span>, <span class="c-key">fn</span>(<span class="c-var">$q</span>) =&gt; <span class="c-var">$q</span>-><span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'published'</span>))-><span class="c-fn">get</span>();
<span class="c-type">Post</span>::<span class="c-fn">latest</span>()-><span class="c-fn">paginate</span>(<span class="c-num">10</span>);
<span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'email'</span>, <span class="c-var">$e</span>)-><span class="c-fn">exists</span>();
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Collections</div>
<pre><code><span class="c-var">$c</span> = <span class="c-fn">collect</span>([<span class="c-num">1</span>,<span class="c-num">2</span>,<span class="c-num">3</span>,<span class="c-num">4</span>,<span class="c-num">5</span>]);
<span class="c-var">$c</span>-><span class="c-fn">map</span>(<span class="c-key">fn</span>(<span class="c-var">$n</span>) =&gt; <span class="c-var">$n</span> * <span class="c-num">2</span>);
<span class="c-var">$c</span>-><span class="c-fn">filter</span>(<span class="c-key">fn</span>(<span class="c-var">$n</span>) =&gt; <span class="c-var">$n</span> % <span class="c-num">2</span>);
<span class="c-var">$c</span>-><span class="c-fn">sum</span>();
<span class="c-var">$c</span>-><span class="c-fn">avg</span>();
<span class="c-var">$c</span>-><span class="c-fn">contains</span>(<span class="c-num">3</span>);
<span class="c-var">$users</span>-><span class="c-fn">groupBy</span>(<span class="c-str">'role'</span>);
<span class="c-var">$users</span>-><span class="c-fn">pluck</span>(<span class="c-str">'name'</span>, <span class="c-str">'id'</span>);
<span class="c-var">$users</span>-><span class="c-fn">sortBy</span>(<span class="c-str">'created_at'</span>);
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="type"></i> Str / Arr</div>
<pre><code><span class="c-type">Str</span>::<span class="c-fn">slug</span>(<span class="c-str">'Hello World!'</span>);
<span class="c-type">Str</span>::<span class="c-fn">limit</span>(<span class="c-var">$text</span>, <span class="c-num">100</span>);
<span class="c-type">Str</span>::<span class="c-fn">contains</span>(<span class="c-var">$email</span>, <span class="c-str">'@gmail.com'</span>);
<span class="c-type">Str</span>::<span class="c-fn">random</span>(<span class="c-num">32</span>);
<span class="c-type">Str</span>::<span class="c-fn">uuid</span>();

<span class="c-type">Arr</span>::<span class="c-fn">get</span>(<span class="c-var">$data</span>, <span class="c-str">'user.profile.email'</span>);
<span class="c-type">Arr</span>::<span class="c-fn">only</span>(<span class="c-var">$data</span>, [<span class="c-str">'id'</span>, <span class="c-str">'name'</span>]);
<span class="c-type">Arr</span>::<span class="c-fn">except</span>(<span class="c-var">$data</span>, [<span class="c-str">'password'</span>]);
<span class="c-type">Arr</span>::<span class="c-fn">set</span>(<span class="c-var">$data</span>, <span class="c-str">'a.b.c'</span>, <span class="c-num">1</span>);
<span class="c-type">Arr</span>::<span class="c-fn">flatten</span>([[<span class="c-str">'a'</span>,<span class="c-str">'b'</span>],[<span class="c-str">'c'</span>]]);
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="calendar"></i> Carbon</div>
<pre><code><span class="c-fn">now</span>();
<span class="c-fn">today</span>();
<span class="c-fn">now</span>()-><span class="c-fn">addDays</span>(<span class="c-num">7</span>);
<span class="c-fn">now</span>()-><span class="c-fn">format</span>(<span class="c-str">'d/m/Y H:i'</span>);
<span class="c-fn">now</span>()-><span class="c-fn">diffForHumans</span>();
<span class="c-type">Carbon</span>::<span class="c-fn">parse</span>(<span class="c-str">'2026-12-31'</span>)-><span class="c-fn">format</span>(<span class="c-str">'l, d M Y'</span>);
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="user-check"></i> Session / Auth / Routing</div>
<pre><code><span class="c-fn">session</span>([<span class="c-str">'cart'</span> =&gt; <span class="c-num">3</span>]);
<span class="c-fn">session</span>(<span class="c-str">'cart'</span>, <span class="c-num">0</span>);
<span class="c-fn">session</span>()-><span class="c-fn">flash</span>(<span class="c-str">'msg'</span>, <span class="c-str">'Saved!'</span>);

<span class="c-fn">auth</span>()-><span class="c-fn">user</span>();
<span class="c-fn">auth</span>()-><span class="c-fn">check</span>();
<span class="c-fn">auth</span>()-><span class="c-fn">id</span>();
<span class="c-fn">bcrypt</span>(<span class="c-str">'secret'</span>);

<span class="c-fn">route</span>(<span class="c-str">'posts.show'</span>, [<span class="c-str">'post'</span> =&gt; <span class="c-num">5</span>]);
<span class="c-fn">url</span>(<span class="c-str">'/contact'</span>);
<span class="c-fn">asset</span>(<span class="c-str">'css/app.css'</span>);
<span class="c-key">return</span> <span class="c-fn">redirect</span>()-><span class="c-fn">route</span>(<span class="c-str">'home'</span>);
<span class="c-key">return</span> <span class="c-fn">back</span>()-><span class="c-fn">with</span>(<span class="c-str">'error'</span>, <span class="c-str">'Invalid'</span>);
<span class="c-key">return</span> <span class="c-fn">response</span>()-><span class="c-fn">json</span>([<span class="c-str">'ok'</span> =&gt; <span class="c-key">true</span>]);
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="bug"></i> Debug / Misc</div>
<pre><code><span class="c-fn">dd</span>(<span class="c-var">$user</span>);
<span class="c-fn">dump</span>(<span class="c-var">$data</span>);
<span class="c-fn">abort</span>(<span class="c-num">403</span>, <span class="c-str">'Forbidden'</span>);
<span class="c-fn">abort_if</span>(!<span class="c-var">$ok</span>, <span class="c-num">403</span>);
<span class="c-fn">config</span>(<span class="c-str">'app.name'</span>);
<span class="c-fn">env</span>(<span class="c-str">'APP_ENV'</span>);
<span class="c-fn">cache</span>(<span class="c-str">'key'</span>, <span class="c-str">'default'</span>);
<span class="c-fn">tap</span>(<span class="c-type">User</span>::<span class="c-fn">create</span>(<span class="c-var">$d</span>), <span class="c-key">fn</span>(<span class="c-var">$u</span>) =&gt; <span class="c-var">$u</span>-><span class="c-fn">notify</span>());
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="terminal"></i> Artisan</div>
<pre><code><span class="c-comment"># Generation</span>
php artisan make:model Post -mfsc
php artisan make:controller PostController --resource
php artisan make:request StorePostRequest
php artisan make:policy PostPolicy --model=Post

<span class="c-comment"># Database</span>
php artisan migrate
php artisan migrate:fresh --seed
php artisan db:seed

<span class="c-comment"># Diagnostics</span>
php artisan route:list
php artisan tinker
php artisan about

<span class="c-comment"># Production</span>
php artisan optimize
php artisan optimize:clear
</code></pre>
  </div>

  <div class="info-box success">
    <strong>Эта шпаргалка покрывает 95% повседневной работы.</strong> Сохраните в закладки — обращайтесь при написании любого контроллера или сервиса.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     UNDER THE HOOD — PHP за Laravel-хелперами
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-under-hood" class="section">
  <div class="section-title">Под капотом: PHP за Laravel-хелперами</div>
  <p class="text">Каждый Laravel-хелпер — обёртка над стандартными PHP-функциями. Знать «внутренности» полезно на собеседовании и когда нужно понять, почему что-то работает не так. Ниже — таблицы «Laravel → чистый PHP» для основных категорий.</p>

  <!-- ─────── Строки Str ─────── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="type"></i> Строки (Str::)</div>
    <table class="data-table">
      <thead><tr><th>Laravel</th><th>Что делает под капотом (PHP)</th></tr></thead>
      <tbody>
        <tr><td><code>Str::contains($haystack, $needle)</code></td><td>PHP 8+: <code>str_contains($haystack, $needle)</code></td></tr>
        <tr><td><code>Str::startsWith($str, $prefix)</code></td><td>PHP 8+: <code>str_starts_with($str, $prefix)</code></td></tr>
        <tr><td><code>Str::endsWith($str, $suffix)</code></td><td>PHP 8+: <code>str_ends_with($str, $suffix)</code></td></tr>
        <tr><td><code>Str::upper($str)</code></td><td><code>mb_strtoupper($str, 'UTF-8')</code> (не <code>strtoupper</code> — та ломает кириллицу)</td></tr>
        <tr><td><code>Str::lower($str)</code></td><td><code>mb_strtolower($str, 'UTF-8')</code></td></tr>
        <tr><td><code>Str::length($str)</code></td><td><code>mb_strlen($str, 'UTF-8')</code></td></tr>
        <tr><td><code>Str::limit($str, 30)</code></td><td><code>mb_strlen($str) &gt; 30 ? mb_substr($str, 0, 30) . '...' : $str</code></td></tr>
        <tr><td><code>Str::replace($search, $replace, $subject)</code></td><td><code>str_replace($search, $replace, $subject)</code></td></tr>
        <tr><td><code>Str::random(32)</code></td><td><code>substr(bin2hex(random_bytes(16)), 0, 32)</code> (upgrade — <code>base64</code>)</td></tr>
        <tr><td><code>Str::slug('Привет мир!')</code></td><td>Транслитерация (<code>Transliterator</code>/<code>iconv</code>) → <code>preg_replace('/[^A-Za-z0-9-]/', '-', ...)</code> → <code>strtolower</code></td></tr>
        <tr><td><code>Str::camel('user_name')</code></td><td><code>lcfirst(str_replace(' ', '', ucwords(str_replace(['_','-'], ' ', $str))))</code></td></tr>
        <tr><td><code>Str::snake('userName')</code></td><td><code>strtolower(preg_replace('/(.)(?=[A-Z])/', '$1_', $str))</code></td></tr>
        <tr><td><code>Str::kebab('userName')</code></td><td>Как <code>snake</code>, но с <code>-</code> вместо <code>_</code></td></tr>
        <tr><td><code>Str::title('hello world')</code></td><td><code>mb_convert_case($str, MB_CASE_TITLE, 'UTF-8')</code></td></tr>
      </tbody>
    </table>
  </div>

  <!-- ─────── Массивы Arr ─────── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Массивы (Arr::)</div>
    <table class="data-table">
      <thead><tr><th>Laravel</th><th>PHP под капотом</th></tr></thead>
      <tbody>
        <tr><td><code>Arr::get($arr, 'a.b.c', $default)</code></td><td>Рекурсия: <code>explode('.', $key)</code> → цикл с <code>isset($arr[$part])</code> → возврат <code>$default</code>, если хоть где нет</td></tr>
        <tr><td><code>Arr::has($arr, 'a.b')</code></td><td>Аналогично <code>get</code>, но возвращает <code>bool</code></td></tr>
        <tr><td><code>Arr::set($arr, 'a.b', $val)</code></td><td><code>explode('.')</code> → создание вложенных массивов через <code>&amp;</code> reference</td></tr>
        <tr><td><code>Arr::forget($arr, 'a.b')</code></td><td>Как <code>set</code>, но в конце <code>unset()</code></td></tr>
        <tr><td><code>Arr::only($arr, ['a','b'])</code></td><td><code>array_intersect_key($arr, array_flip($keys))</code></td></tr>
        <tr><td><code>Arr::except($arr, ['a','b'])</code></td><td><code>array_diff_key($arr, array_flip($keys))</code></td></tr>
        <tr><td><code>Arr::pluck($arr, 'name')</code></td><td><code>array_column($arr, 'name')</code></td></tr>
        <tr><td><code>Arr::flatten($arr)</code></td><td>Рекурсивный <code>foreach</code>: если элемент массив — <code>array_merge($result, flatten($item))</code></td></tr>
        <tr><td><code>Arr::wrap($val)</code></td><td><code>is_array($val) ? $val : ($val === null ? [] : [$val])</code></td></tr>
        <tr><td><code>Arr::first($arr, $callback)</code></td><td><code>foreach + if $callback($v) return $v</code></td></tr>
        <tr><td><code>Arr::random($arr)</code></td><td><code>$arr[array_rand($arr)]</code></td></tr>
      </tbody>
    </table>
  </div>

  <!-- ─────── Коллекции ─────── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Collections</div>
    <p class="text">Collection — это класс-обёртка над массивом. <code>collect([1,2,3])</code> = <code>new \Illuminate\Support\Collection([1,2,3])</code>. Каждый метод либо использует нативную функцию PHP, либо делает свой <code>foreach</code>.</p>
    <table class="data-table">
      <thead><tr><th>Laravel</th><th>PHP-эквивалент</th></tr></thead>
      <tbody>
        <tr><td><code>collect($arr)</code></td><td><code>new Collection($arr)</code> — просто обёртка</td></tr>
        <tr><td><code>-&gt;map($fn)</code></td><td><code>array_map($fn, $arr)</code></td></tr>
        <tr><td><code>-&gt;filter($fn)</code></td><td><code>array_filter($arr, $fn)</code></td></tr>
        <tr><td><code>-&gt;reduce($fn, $init)</code></td><td><code>array_reduce($arr, $fn, $init)</code></td></tr>
        <tr><td><code>-&gt;pluck('name')</code></td><td><code>array_column($arr, 'name')</code></td></tr>
        <tr><td><code>-&gt;keys()</code> / <code>-&gt;values()</code></td><td><code>array_keys($arr)</code> / <code>array_values($arr)</code></td></tr>
        <tr><td><code>-&gt;sum()</code></td><td><code>array_sum($arr)</code></td></tr>
        <tr><td><code>-&gt;avg()</code></td><td><code>array_sum($arr) / count($arr)</code></td></tr>
        <tr><td><code>-&gt;count()</code></td><td><code>count($arr)</code></td></tr>
        <tr><td><code>-&gt;contains($val)</code></td><td><code>in_array($val, $arr, true)</code> или foreach + callback</td></tr>
        <tr><td><code>-&gt;groupBy('field')</code></td><td>Свой <code>foreach</code>: <code>$grouped[$item[$field]][] = $item</code></td></tr>
        <tr><td><code>-&gt;sortBy('age')</code></td><td><code>usort($arr, fn($a,$b) =&gt; $a['age'] &lt;=&gt; $b['age'])</code></td></tr>
        <tr><td><code>-&gt;chunk(3)</code></td><td><code>array_chunk($arr, 3)</code></td></tr>
        <tr><td><code>-&gt;flatten()</code></td><td>Рекурсивный обход через foreach</td></tr>
        <tr><td><code>-&gt;toArray()</code></td><td>Возвращает исходный массив (для вложенных Collections — рекурсивно)</td></tr>
        <tr><td><code>-&gt;toJson()</code></td><td><code>json_encode($arr)</code></td></tr>
      </tbody>
    </table>
    <div class="tip">
      Collection — <strong>immutable-стиль</strong>: методы возвращают новую Collection, не мутируют исходную. Отличие от нативных PHP-функций типа <code>sort()</code> которые мутируют массив.
    </div>
  </div>

  <!-- ─────── Даты (Carbon) ─────── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="calendar"></i> Даты (Carbon)</div>
    <p class="text">Carbon — обёртка над встроенным PHP-классом <code>DateTime</code> / <code>DateTimeImmutable</code>. Всё что делает Carbon — можно сделать нативно.</p>
    <table class="data-table">
      <thead><tr><th>Laravel</th><th>PHP-эквивалент</th></tr></thead>
      <tbody>
        <tr><td><code>now()</code></td><td><code>new DateTime()</code> с timezone из <code>config('app.timezone')</code></td></tr>
        <tr><td><code>today()</code></td><td><code>new DateTime('today')</code> — сегодня в 00:00:00</td></tr>
        <tr><td><code>$date-&gt;addDays(5)</code></td><td><code>$date-&gt;modify('+5 days')</code> или <code>$date-&gt;add(new DateInterval('P5D'))</code></td></tr>
        <tr><td><code>$date-&gt;subHours(2)</code></td><td><code>$date-&gt;modify('-2 hours')</code></td></tr>
        <tr><td><code>$date-&gt;format('Y-m-d')</code></td><td><code>$date-&gt;format('Y-m-d')</code> — идентично, Carbon наследует</td></tr>
        <tr><td><code>Carbon::parse('2026-01-15')</code></td><td><code>new DateTime('2026-01-15')</code> или <code>DateTime::createFromFormat(...)</code></td></tr>
        <tr><td><code>$a-&gt;diffInDays($b)</code></td><td><code>$a-&gt;diff($b)-&gt;days</code></td></tr>
        <tr><td><code>$date-&gt;diffForHumans()</code></td><td>Свой алгоритм: <code>diff()</code> + локализация («2 часа назад»)</td></tr>
        <tr><td><code>$date-&gt;toDateTimeString()</code></td><td><code>$date-&gt;format('Y-m-d H:i:s')</code></td></tr>
      </tbody>
    </table>
  </div>

  <!-- ─────── Auth / Session ─────── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="user-check"></i> Session & Auth</div>
    <table class="data-table">
      <thead><tr><th>Laravel</th><th>PHP-эквивалент</th></tr></thead>
      <tbody>
        <tr><td><code>session('key')</code></td><td>Драйвер решает: <code>file</code> → <code>$_SESSION['key']</code> после <code>session_start()</code>; <code>redis</code> → <code>Redis::get("session:$id:key")</code></td></tr>
        <tr><td><code>session(['k' =&gt; $v])</code></td><td><code>$_SESSION['k'] = $v</code> (для file-драйвера)</td></tr>
        <tr><td><code>session()-&gt;flash('msg', 'ok')</code></td><td><code>$_SESSION['_flash']['msg'] = 'ok'</code>, автоочистка на след. запросе</td></tr>
        <tr><td><code>bcrypt($password)</code></td><td><code>password_hash($password, PASSWORD_BCRYPT, ['rounds' =&gt; 10])</code></td></tr>
        <tr><td><code>Hash::check($pass, $hash)</code></td><td><code>password_verify($pass, $hash)</code></td></tr>
        <tr><td><code>auth()-&gt;user()</code></td><td>Guard → сессия/токен → <code>User::find($id)</code> (кешируется в память запроса)</td></tr>
        <tr><td><code>auth()-&gt;check()</code></td><td><code>!is_null($this-&gt;user())</code></td></tr>
        <tr><td><code>auth()-&gt;id()</code></td><td><code>$_SESSION['login_user_web_...'] ?? null</code></td></tr>
        <tr><td><code>csrf_token()</code></td><td><code>$_SESSION['_token']</code> (генерируется как <code>Str::random(40)</code> при старте)</td></tr>
      </tbody>
    </table>
  </div>

  <!-- ─────── Ответы / Redirect ─────── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="send"></i> Responses & Redirects</div>
    <table class="data-table">
      <thead><tr><th>Laravel</th><th>PHP-эквивалент</th></tr></thead>
      <tbody>
        <tr><td><code>response('Hello', 200)</code></td><td><code>http_response_code(200); echo 'Hello';</code></td></tr>
        <tr><td><code>response()-&gt;json($data)</code></td><td><code>header('Content-Type: application/json'); echo json_encode($data);</code></td></tr>
        <tr><td><code>response()-&gt;json($data, 422)</code></td><td>+ <code>http_response_code(422)</code></td></tr>
        <tr><td><code>redirect('/home')</code></td><td><code>header('Location: /home'); exit;</code></td></tr>
        <tr><td><code>redirect()-&gt;route('users.show', $id)</code></td><td><code>header('Location: ' . url_by_route_name(...)); exit;</code></td></tr>
        <tr><td><code>back()</code></td><td><code>header('Location: ' . $_SERVER['HTTP_REFERER']); exit;</code></td></tr>
        <tr><td><code>abort(404)</code></td><td><code>throw new HttpException(404)</code> → exception handler → рендер 404-view</td></tr>
        <tr><td><code>abort_if($cond, 403)</code></td><td><code>if ($cond) throw new HttpException(403);</code></td></tr>
      </tbody>
    </table>
  </div>

  <!-- ─────── Debug / Env / Config ─────── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="bug"></i> Debug, Config, Env</div>
    <table class="data-table">
      <thead><tr><th>Laravel</th><th>PHP-эквивалент</th></tr></thead>
      <tbody>
        <tr><td><code>dd($var)</code></td><td>Обёртка: <code>Symfony\VarDumper::dump($var); die();</code> (расширенный <code>var_dump</code>)</td></tr>
        <tr><td><code>dump($var)</code></td><td>То же, но без <code>die()</code></td></tr>
        <tr><td><code>env('APP_KEY')</code></td><td><code>getenv('APP_KEY') ?: $_ENV['APP_KEY'] ?? $_SERVER['APP_KEY']</code> (через vlucas/phpdotenv)</td></tr>
        <tr><td><code>config('app.name')</code></td><td><code>Arr::get($configArray, 'app.name')</code> где <code>$configArray</code> собран из <code>config/*.php</code></td></tr>
        <tr><td><code>collect($arr)</code></td><td><code>new Collection($arr)</code></td></tr>
        <tr><td><code>optional($obj)-&gt;method()</code></td><td>PHP 8+: <code>$obj?-&gt;method()</code> (nullsafe operator)</td></tr>
        <tr><td><code>tap($val, fn($v) =&gt; $v-&gt;save())</code></td><td>Вызов callback + возврат оригинала: <code>$fn($val); return $val;</code></td></tr>
      </tbody>
    </table>
  </div>

  <!-- ─────── Валидация ─────── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-square"></i> Validation правила</div>
    <table class="data-table">
      <thead><tr><th>Laravel правило</th><th>PHP под капотом</th></tr></thead>
      <tbody>
        <tr><td><code>required</code></td><td>Значение не <code>null</code>, не <code>''</code>, не пустой массив/файл</td></tr>
        <tr><td><code>email</code></td><td><code>filter_var($val, FILTER_VALIDATE_EMAIL) !== false</code></td></tr>
        <tr><td><code>url</code></td><td><code>filter_var($val, FILTER_VALIDATE_URL)</code></td></tr>
        <tr><td><code>ip</code>/<code>ipv4</code>/<code>ipv6</code></td><td><code>filter_var($val, FILTER_VALIDATE_IP)</code> с флагами</td></tr>
        <tr><td><code>numeric</code></td><td><code>is_numeric($val)</code></td></tr>
        <tr><td><code>integer</code></td><td><code>filter_var($val, FILTER_VALIDATE_INT) !== false</code></td></tr>
        <tr><td><code>boolean</code></td><td><code>in_array($val, [true, false, 1, 0, '1', '0'], true)</code></td></tr>
        <tr><td><code>json</code></td><td><code>json_decode($val) !== null &amp;&amp; json_last_error() === JSON_ERROR_NONE</code></td></tr>
        <tr><td><code>date</code></td><td><code>strtotime($val) !== false</code></td></tr>
        <tr><td><code>regex:/pattern/</code></td><td><code>preg_match($pattern, $val)</code></td></tr>
        <tr><td><code>min:3</code>, <code>max:10</code></td><td>Для строк — <code>mb_strlen</code>; для чисел — <code>&gt;=</code>/<code>&lt;=</code>; для массивов — <code>count</code>; для файлов — размер в KB</td></tr>
        <tr><td><code>unique:users,email</code></td><td><code>DB::table('users')-&gt;where('email', $val)-&gt;count() === 0</code></td></tr>
        <tr><td><code>exists:categories,id</code></td><td><code>DB::table('categories')-&gt;where('id', $val)-&gt;exists()</code></td></tr>
        <tr><td><code>mimes:jpg,png</code></td><td><code>finfo_file(...)</code> или <code>$file-&gt;getMimeType()</code> → сравнение</td></tr>
      </tbody>
    </table>
  </div>

  <!-- ─────── Eloquent Query ─────── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> Eloquent → SQL под капотом</div>
    <p class="text">Каждый Eloquent-метод в итоге строит SQL и выполняет через PDO.</p>
    <table class="data-table">
      <thead><tr><th>Laravel</th><th>SQL (примерно)</th><th>PHP (упрощённо)</th></tr></thead>
      <tbody>
        <tr>
          <td><code>User::find(5)</code></td>
          <td><code>SELECT * FROM users WHERE id = 5 LIMIT 1</code></td>
          <td><code>$pdo-&gt;prepare(...)-&gt;execute([5])-&gt;fetch(PDO::FETCH_ASSOC)</code></td>
        </tr>
        <tr>
          <td><code>User::where('active', 1)-&gt;get()</code></td>
          <td><code>SELECT * FROM users WHERE active = 1</code></td>
          <td>PDO + <code>fetchAll(PDO::FETCH_ASSOC)</code> → hydration в объекты <code>User</code></td>
        </tr>
        <tr>
          <td><code>User::pluck('email')</code></td>
          <td><code>SELECT email FROM users</code></td>
          <td>PDO + <code>fetchAll(PDO::FETCH_COLUMN)</code></td>
        </tr>
        <tr>
          <td><code>User::whereIn('id', [1,2,3])-&gt;get()</code></td>
          <td><code>SELECT * FROM users WHERE id IN (?, ?, ?)</code></td>
          <td>PDO prepared с массивом плейсхолдеров</td>
        </tr>
        <tr>
          <td><code>User::paginate(10)</code></td>
          <td>2 запроса: <code>COUNT(*)</code> + <code>SELECT ... LIMIT 10 OFFSET N</code></td>
          <td>2 PDO вызова + расчёт страниц</td>
        </tr>
        <tr>
          <td><code>User::with('posts')-&gt;get()</code></td>
          <td><code>SELECT * FROM users</code>, потом <code>SELECT * FROM posts WHERE user_id IN (...)</code> — <strong>2 запроса</strong> вместо N+1</td>
          <td>PDO + hydration + подставление связей вручную по <code>foreign_key</code></td>
        </tr>
        <tr>
          <td><code>User::firstOrFail()</code></td>
          <td><code>SELECT ... LIMIT 1</code></td>
          <td>PDO fetch, если <code>null</code> — <code>throw new ModelNotFoundException</code></td>
        </tr>
        <tr>
          <td><code>$user-&gt;save()</code></td>
          <td><code>INSERT</code> если новый, <code>UPDATE</code> если существует</td>
          <td>PDO prepared + <code>lastInsertId()</code></td>
        </tr>
        <tr>
          <td><code>$user-&gt;delete()</code></td>
          <td><code>DELETE FROM users WHERE id = ?</code></td>
          <td>PDO prepared execute</td>
        </tr>
      </tbody>
    </table>
    <div class="tip">
      Проверить <strong>сгенерированный SQL</strong> в Tinker: <code>User::where('active', 1)-&gt;toSql()</code> — вернёт строку запроса. Или <code>DB::enableQueryLog()</code> + <code>DB::getQueryLog()</code> для реального выполненного SQL с параметрами.
    </div>
  </div>

  <!-- ─────── Routing / URL ─────── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="route"></i> Routing & URL</div>
    <table class="data-table">
      <thead><tr><th>Laravel</th><th>PHP-эквивалент</th></tr></thead>
      <tbody>
        <tr><td><code>route('users.show', 5)</code></td><td>Поиск роута в реестре по имени + подстановка параметров в pattern → полный URL</td></tr>
        <tr><td><code>url('/foo')</code></td><td>Конкатенация: <code>$request-&gt;getSchemeAndHttpHost() . '/foo'</code></td></tr>
        <tr><td><code>asset('css/app.css')</code></td><td><code>url() + '/css/app.css'</code>, с учётом <code>ASSET_URL</code> для CDN</td></tr>
        <tr><td><code>view('users.show', ['user' =&gt; $u])</code></td><td>Blade-компилятор: <code>.blade.php</code> → скомпилированный PHP в <code>storage/framework/views/*.php</code> → <code>include</code> + <code>extract($data)</code></td></tr>
      </tbody>
    </table>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> Laravel = красивая обёртка над стандартным PHP. Каждый хелпер разбирается на 1-3 нативные функции. Знание «внутренностей» ценится на собеседовании и помогает быстро дебажить: если <code>Str::slug()</code> сработал странно — сразу ясно, что искать в <code>Transliterator</code>/<code>iconv</code>; если <code>with()</code> сделал 100 запросов — не сработала eager-загрузка через <code>whereIn</code>.
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
