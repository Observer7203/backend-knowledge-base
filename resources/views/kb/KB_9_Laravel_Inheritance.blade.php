@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laravel / PHP — Наследование и базовые элементы</title>
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
.badge-purple,.badge-orange,.badge-teal{background:#EFF2F5;color:#5E6278;}
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
.info-box{border-radius:var(--radius);padding:14px 16px;margin-bottom:16px;border-left:4px solid;font-size:13px;line-height:1.7;}
.info-box.blue,.info-box.purple{background:var(--primary-light);border-color:var(--primary);color:#404357;}
.info-box.success{background:var(--success-light);border-color:var(--success);color:#0D5E3F;}
.info-box.warning{background:#FFF8E1;border-color:#E0A000;color:#7B5000;}
.info-box.danger{background:#FFF3F5;border-color:#D0404E;color:#7B1C2A;}
.info-box.orange{background:var(--primary-light);border-color:var(--primary);color:#404357;}
.info-box strong{font-weight:700;}
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:20px;margin-bottom:16px;box-shadow:var(--shadow);}
.card-title{font-size:13px;font-weight:700;color:var(--text);margin-bottom:10px;display:flex;align-items:center;gap:8px;}
pre{background:var(--code-bg);border:1px solid var(--code-border);border-radius:var(--radius);padding:20px;overflow-x:auto;margin-bottom:16px;font-size:12.5px;line-height:1.7;}
pre code{color:#ABB2BF;font-family:'JetBrains Mono','Fira Code',Consolas,monospace;}
.c-comment{color:#5C6370;}.c-key{color:#C678DD;}.c-str{color:#98C379;}.c-fn{color:#61AFEF;}.c-var{color:#E5C07B;}.c-type{color:#E06C75;}.c-num{color:#D19A66;}
.data-table{width:100%;border-collapse:collapse;margin-bottom:16px;font-size:13px;}
.data-table th{background:var(--bg);padding:10px 14px;text-align:left;font-weight:700;font-size:11px;text-transform:uppercase;letter-spacing:0.5px;color:var(--text2);border-bottom:1px solid var(--border);}
.data-table td{padding:10px 14px;border-bottom:1px solid var(--border);color:var(--text2);vertical-align:top;}
.data-table td strong{color:var(--text);font-weight:600;}
.data-table td code{background:var(--bg);border:1px solid var(--border);border-radius:4px;padding:1px 6px;font-size:11.5px;font-family:monospace;color:var(--primary);}
.data-table tr:last-child td{border-bottom:none;}
.qa-item{border:1px solid var(--border);border-radius:var(--radius);margin-bottom:10px;overflow:hidden;}
.qa-q{padding:14px 16px;font-weight:600;font-size:13.5px;cursor:pointer;display:flex;align-items:flex-start;gap:10px;transition:background 0.15s;}
.qa-q:hover{background:var(--bg);}
.qa-q .q-icon svg{width:14px;height:14px;color:var(--primary);}
.qa-a{padding:0 16px 14px 40px;color:var(--text2);font-size:13px;line-height:1.75;display:none;}
.qa-a.open{display:block;}
.qa-a pre{margin-top:8px;}
.inherit-chain{display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:16px;font-size:13px;}
.inherit-chain .chain-item{background:var(--primary-light);border:1px solid var(--border);border-radius:6px;padding:5px 12px;font-weight:600;color:var(--primary);font-family:monospace;font-size:12px;}
.inherit-chain .chain-item.yours{background:var(--primary);border-color:var(--primary);color:#fff;}
.inherit-chain .chain-arrow{color:var(--text3);font-size:16px;font-weight:bold;}
.element-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:10px;margin-bottom:16px;}
.element-card{background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:12px 14px;transition:all 0.18s;}
.element-card:hover{border-color:var(--primary);box-shadow:var(--shadow);}
.element-card .el-type{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:4px;}
.element-card .el-name{font-size:13px;font-weight:600;color:var(--text);font-family:monospace;}
.element-card .el-desc{font-size:11.5px;color:var(--text2);margin-top:4px;}
.type-class .el-type{color:var(--primary);}
.type-interface .el-type{color:var(--text2);}
.type-trait .el-type{color:var(--text3);}
.type-facade .el-type{color:var(--success-dark);}
</style>
</head>
<body>
<div class="container">
<div class="sidebar">
  <a href="/" class="sidebar-back"><i data-lucide="arrow-left"></i> На главную</a>
  <div class="sidebar-title">Наследование</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> Зачем этот раздел</a>

  <div class="nav-group-label">Базовые классы</div>
  <a class="nav-item" onclick="showSection('controller',this)"><i data-lucide="layout-dashboard"></i> Controller</a>
  <a class="nav-item" onclick="showSection('model',this)"><i data-lucide="database"></i> Model (Eloquent)</a>
  <a class="nav-item" onclick="showSection('formrequest',this)"><i data-lucide="shield-check"></i> FormRequest</a>
  <a class="nav-item" onclick="showSection('middleware',this)"><i data-lucide="filter"></i> Middleware</a>
  <a class="nav-item" onclick="showSection('job',this)"><i data-lucide="zap"></i> Job</a>
  <a class="nav-item" onclick="showSection('command',this)"><i data-lucide="terminal"></i> Command (Artisan)</a>
  <a class="nav-item" onclick="showSection('notification',this)"><i data-lucide="bell"></i> Notification</a>
  <a class="nav-item" onclick="showSection('mail',this)"><i data-lucide="mail"></i> Mailable</a>
  <a class="nav-item" onclick="showSection('event',this)"><i data-lucide="radio"></i> Event + Listener</a>
  <a class="nav-item" onclick="showSection('policy',this)"><i data-lucide="lock"></i> Policy</a>
  <a class="nav-item" onclick="showSection('seeder',this)"><i data-lucide="sprout"></i> Seeder / Factory</a>
  <a class="nav-item" onclick="showSection('rule',this)"><i data-lucide="check-circle"></i> Rule</a>
  <a class="nav-item" onclick="showSection('resource',this)"><i data-lucide="file-json"></i> Resource / Collection</a>
  <a class="nav-item" onclick="showSection('exception',this)"><i data-lucide="alert-triangle"></i> Exception Handler</a>
  <a class="nav-item" onclick="showSection('provider',this)"><i data-lucide="plug"></i> ServiceProvider</a>
  <a class="nav-item" onclick="showSection('migration',this)"><i data-lucide="git-commit"></i> Migration</a>

  <div class="nav-group-label">Не-классы</div>
  <a class="nav-item" onclick="showSection('interfaces',this)"><i data-lucide="file-code"></i> Интерфейсы</a>
  <a class="nav-item" onclick="showSection('traits',this)"><i data-lucide="puzzle"></i> Трейты</a>
  <a class="nav-item" onclick="showSection('facades',this)"><i data-lucide="box"></i> Фасады</a>
  <a class="nav-item" onclick="showSection('contracts',this)"><i data-lucide="scroll-text"></i> Contracts vs Facades</a>

  <div class="nav-group-label">Обзор</div>
  <a class="nav-item" onclick="showSection('cheatsheet',this)"><i data-lucide="list"></i> Шпаргалка: всё в одной таблице</a>
  <a class="nav-item" onclick="showSection('quiz',this)"><i data-lucide="brain"></i> Проверь себя</a>
</div>

<div class="main">
<div class="page-header">
  <h1>Наследование и базовые элементы Laravel / PHP</h1>
  <p>Полный каталог: какие родительские классы, интерфейсы, трейты и фасады даёт Laravel «из коробки», что ты получаешь бесплатно и какие методы переопределяешь.</p>
  <div class="badge-row">
    <span class="badge badge-purple">OOP</span>
    <span class="badge badge-orange">Laravel</span>
    <span class="badge badge-teal">Наследование</span>
    <span class="badge badge-success">Практика</span>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     OVERVIEW
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-overview" class="section active">
  <div class="section-title">Зачем этот раздел</div>
  <p class="text">В Laravel ты <strong>почти никогда не пишешь с нуля</strong>. Ты наследуешь готовые родительские классы, подключаешь трейты, реализуешь интерфейсы — и получаешь кучу функционала бесплатно. Но на собеседовании спросят: <em>«Что именно даёт тебе FormRequest?»</em> или <em>«Зачем Model наследует HasFactory?»</em>.</p>

  <div class="info-box purple">
    <strong>Паттерн Laravel:</strong> Ты создаёшь свой класс → наследуешь родителя → переопределяешь нужные методы → Laravel вызывает твой класс автоматически в нужный момент (через Service Container, Router, Queue Worker и т.д.)
  </div>

  <p class="text"><strong>Пример:</strong></p>
  <div class="inherit-chain">
    <span class="chain-item">Illuminate\Foundation\Http\FormRequest</span>
    <span class="chain-arrow">←</span>
    <span class="chain-item yours">App\Http\Requests\LoginRequest</span>
  </div>
  <p class="text">Родитель <code>FormRequest</code> уже умеет: валидировать, авторизовывать, возвращать ошибки, редиректить. Ты только задаёшь <code>rules()</code> и <code>authorize()</code>.</p>

  <div class="info-box warning">
    <strong>Помимо классов</strong> в Laravel есть ещё 3 типа «строительных блоков»:<br>
    • <strong>Интерфейсы (Contracts)</strong> — «контракт» что класс обязан уметь<br>
    • <strong>Трейты</strong> — переиспользуемые методы (горизонтальное наследование)<br>
    • <strong>Фасады</strong> — статический доступ к сервисам из контейнера
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     CONTROLLER
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-controller" class="section">
  <div class="section-title">Controller</div>

  <div class="inherit-chain">
    <span class="chain-item">Illuminate\Routing\Controller</span>
    <span class="chain-arrow">←</span>
    <span class="chain-item">App\Http\Controllers\Controller</span>
    <span class="chain-arrow">←</span>
    <span class="chain-item yours">App\Http\Controllers\UserController</span>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="gift"></i> Что даёт родитель бесплатно</div>
    <table class="data-table">
      <tr><th>Возможность</th><th>Описание</th></tr>
      <tr><td><strong>middleware()</strong></td><td>Назначать middleware прямо в конструкторе: <code>$this->middleware('auth')</code></td></tr>
      <tr><td><strong>Dependency Injection</strong></td><td>Параметры метода автоматически резолвятся из Service Container</td></tr>
      <tr><td><strong>Route Model Binding</strong></td><td><code>show(User $user)</code> — Laravel сам достанет модель из БД по ID</td></tr>
      <tr><td><strong>Form Request Injection</strong></td><td><code>store(StoreRequest $request)</code> — валидация до входа в метод</td></tr>
      <tr><td><strong>AuthorizesRequests (trait)</strong></td><td><code>$this->authorize('update', $post)</code> — проверка Policy</td></tr>
      <tr><td><strong>ValidatesRequests (trait)</strong></td><td><code>$this->validate($request, [...])</code> — валидация прямо в контроллере</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="code-2"></i> Упрощённый код родителя</div>
<pre><code><span class="c-comment">// Illuminate\Routing\Controller (упрощённо)</span>
<span class="c-key">abstract class</span> <span class="c-type">Controller</span>
{
    <span class="c-key">protected</span> <span class="c-var">$middleware</span> = [];

    <span class="c-key">public function</span> <span class="c-fn">middleware</span>(<span class="c-var">$middleware</span>, <span class="c-key">array</span> <span class="c-var">$options</span> = [])
    {
        <span class="c-comment">// Регистрирует middleware для этого контроллера</span>
        <span class="c-var">$this</span>-><span class="c-var">middleware</span>[] = [
            <span class="c-str">'middleware'</span> => <span class="c-var">$middleware</span>,
            <span class="c-str">'options'</span>    => &amp;<span class="c-var">$options</span>,
        ];
    }

    <span class="c-key">public function</span> <span class="c-fn">getMiddleware</span>() { <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-var">middleware</span>; }

    <span class="c-key">public function</span> <span class="c-fn">callAction</span>(<span class="c-var">$method</span>, <span class="c-var">$parameters</span>)
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>->{<span class="c-var">$method</span>}(...<span class="c-fn">array_values</span>(<span class="c-var">$parameters</span>));
    }
}

<span class="c-comment">// App\Http\Controllers\Controller (базовый — ты можешь редактировать)</span>
<span class="c-key">class</span> <span class="c-type">Controller</span> <span class="c-key">extends</span> <span class="c-type">BaseController</span>
{
    <span class="c-key">use</span> <span class="c-type">AuthorizesRequests</span>, <span class="c-type">ValidatesRequests</span>;
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="pen-tool"></i> Твой класс — что ты пишешь</div>
<pre><code><span class="c-key">class</span> <span class="c-type">UserController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>()
    {
        <span class="c-var">$this</span>-><span class="c-fn">middleware</span>(<span class="c-str">'auth'</span>);            <span class="c-comment">// ← от родителя</span>
        <span class="c-var">$this</span>-><span class="c-fn">middleware</span>(<span class="c-str">'admin'</span>)-><span class="c-fn">only</span>(<span class="c-str">'destroy'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">index</span>()
    {
        <span class="c-var">$this</span>-><span class="c-fn">authorize</span>(<span class="c-str">'viewAny'</span>, <span class="c-type">User</span>::<span class="c-key">class</span>); <span class="c-comment">// ← от trait AuthorizesRequests</span>
        <span class="c-key">return</span> <span class="c-type">User</span>::<span class="c-fn">paginate</span>();
    }

    <span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">StoreUserRequest</span> <span class="c-var">$request</span>) <span class="c-comment">// ← FormRequest injection</span>
    {
        <span class="c-key">return</span> <span class="c-type">User</span>::<span class="c-fn">create</span>(<span class="c-var">$request</span>-><span class="c-fn">validated</span>());
    }

    <span class="c-key">public function</span> <span class="c-fn">show</span>(<span class="c-type">User</span> <span class="c-var">$user</span>)   <span class="c-comment">// ← Route Model Binding</span>
    {
        <span class="c-key">return</span> <span class="c-var">$user</span>;
    }
}
</code></pre>
  </div>

  <div class="info-box success">
    <strong>Собеседование:</strong> «Можно ли контроллер без наследования?» — Да, в Laravel 11+ Controller может быть просто invokable class с <code>__invoke()</code>. Но тогда нет <code>$this->middleware()</code> и <code>$this->authorize()</code>.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     MODEL
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-model" class="section">
  <div class="section-title">Model (Eloquent)</div>

  <div class="inherit-chain">
    <span class="chain-item">Illuminate\Database\Eloquent\Model</span>
    <span class="chain-arrow">←</span>
    <span class="chain-item yours">App\Models\User</span>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="gift"></i> Что даёт родитель бесплатно</div>
    <table class="data-table">
      <tr><th>Возможность</th><th>Как используется</th></tr>
      <tr><td><strong>CRUD операции</strong></td><td><code>User::create()</code>, <code>$user->save()</code>, <code>$user->delete()</code>, <code>User::find(1)</code></td></tr>
      <tr><td><strong>Query Builder</strong></td><td><code>User::where('age', '>', 18)->get()</code> — цепочки запросов</td></tr>
      <tr><td><strong>Relations</strong></td><td><code>hasMany()</code>, <code>belongsTo()</code>, <code>morphMany()</code> — все методы отношений</td></tr>
      <tr><td><strong>Mass Assignment</strong></td><td>Защита через <code>$fillable</code> / <code>$guarded</code></td></tr>
      <tr><td><strong>Casting</strong></td><td><code>$casts = ['is_admin' => 'boolean']</code></td></tr>
      <tr><td><strong>Events</strong></td><td><code>creating</code>, <code>created</code>, <code>updating</code>, <code>deleted</code> — lifecycle hooks</td></tr>
      <tr><td><strong>Scopes</strong></td><td><code>scopeActive($q)</code> → <code>User::active()->get()</code></td></tr>
      <tr><td><strong>Accessors/Mutators</strong></td><td><code>getFullNameAttribute()</code>, <code>setPasswordAttribute()</code></td></tr>
      <tr><td><strong>Timestamps</strong></td><td><code>created_at</code>, <code>updated_at</code> автоматически</td></tr>
      <tr><td><strong>Serialization</strong></td><td><code>$user->toArray()</code>, <code>$user->toJson()</code>, <code>$hidden</code>, <code>$visible</code></td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="code-2"></i> Упрощённый код родителя</div>
<pre><code><span class="c-comment">// Illuminate\Database\Eloquent\Model (сильно упрощён)</span>
<span class="c-key">abstract class</span> <span class="c-type">Model</span> <span class="c-key">implements</span> <span class="c-type">Arrayable</span>, <span class="c-type">Jsonable</span>, <span class="c-type">JsonSerializable</span>
{
    <span class="c-key">use</span> <span class="c-type">HasAttributes</span>, <span class="c-type">HasEvents</span>, <span class="c-type">HasRelationships</span>,
        <span class="c-type">HasTimestamps</span>, <span class="c-type">HidesAttributes</span>, <span class="c-type">GuardsAttributes</span>;

    <span class="c-key">protected</span> <span class="c-var">$table</span>;         <span class="c-comment">// имя таблицы (Convention: users)</span>
    <span class="c-key">protected</span> <span class="c-var">$primaryKey</span> = <span class="c-str">'id'</span>;
    <span class="c-key">protected</span> <span class="c-var">$fillable</span> = [];  <span class="c-comment">// разрешённые для mass assignment</span>
    <span class="c-key">protected</span> <span class="c-var">$guarded</span> = [<span class="c-str">'*'</span>]; <span class="c-comment">// запрещённые (по умолчанию — все)</span>
    <span class="c-key">protected</span> <span class="c-var">$hidden</span> = [];    <span class="c-comment">// скрыть при toArray/toJson</span>
    <span class="c-key">protected</span> <span class="c-var">$casts</span> = [];     <span class="c-comment">// приведение типов</span>
    <span class="c-key">public</span> <span class="c-var">$timestamps</span> = <span class="c-key">true</span>;

    <span class="c-key">public static function</span> <span class="c-fn">create</span>(<span class="c-key">array</span> <span class="c-var">$attributes</span>) { <span class="c-comment">/* ... */</span> }
    <span class="c-key">public function</span> <span class="c-fn">save</span>() { <span class="c-comment">/* INSERT или UPDATE */</span> }
    <span class="c-key">public function</span> <span class="c-fn">delete</span>() { <span class="c-comment">/* DELETE */</span> }
    <span class="c-key">public static function</span> <span class="c-fn">find</span>(<span class="c-var">$id</span>) { <span class="c-comment">/* SELECT WHERE id = ? */</span> }
    <span class="c-key">public static function</span> <span class="c-fn">where</span>(...) { <span class="c-comment">/* Query Builder */</span> }

    <span class="c-comment">// Relationship methods ты определяешь в СВОЕЙ модели</span>
    <span class="c-key">public function</span> <span class="c-fn">hasMany</span>(<span class="c-var">$related</span>, ...) { <span class="c-comment">/* HasMany relation */</span> }
    <span class="c-key">public function</span> <span class="c-fn">belongsTo</span>(<span class="c-var">$related</span>, ...) { <span class="c-comment">/* BelongsTo relation */</span> }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="pen-tool"></i> Твой класс</div>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">use</span> <span class="c-type">HasFactory</span>, <span class="c-type">Notifiable</span>, <span class="c-type">SoftDeletes</span>; <span class="c-comment">// ← трейты!</span>

    <span class="c-key">protected</span> <span class="c-var">$fillable</span> = [<span class="c-str">'name'</span>, <span class="c-str">'email'</span>, <span class="c-str">'password'</span>];
    <span class="c-key">protected</span> <span class="c-var">$hidden</span>   = [<span class="c-str">'password'</span>, <span class="c-str">'remember_token'</span>];
    <span class="c-key">protected</span> <span class="c-var">$casts</span>    = [<span class="c-str">'email_verified_at'</span> => <span class="c-str">'datetime'</span>];

    <span class="c-comment">// Отношения — ты определяешь, родитель обрабатывает</span>
    <span class="c-key">public function</span> <span class="c-fn">posts</span>(): <span class="c-type">HasMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasMany</span>(<span class="c-type">Post</span>::<span class="c-key">class</span>); <span class="c-comment">// ← метод из родителя</span>
    }

    <span class="c-comment">// Scope — ты определяешь, Laravel вызывает как User::active()</span>
    <span class="c-key">public function</span> <span class="c-fn">scopeActive</span>(<span class="c-var">$query</span>)
    {
        <span class="c-key">return</span> <span class="c-var">$query</span>-><span class="c-fn">where</span>(<span class="c-str">'is_active'</span>, <span class="c-key">true</span>);
    }
}
</code></pre>
  </div>

  <div class="info-box orange">
    <strong>Authenticatable:</strong> Модель <code>User</code> также наследует <code>Illuminate\Foundation\Auth\User as Authenticatable</code>, который добавляет токены аутентификации, remember token, и реализует контракт <code>AuthenticatableContract</code>.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     FORMREQUEST
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-formrequest" class="section">
  <div class="section-title">FormRequest</div>

  <div class="inherit-chain">
    <span class="chain-item">Illuminate\Http\Request</span>
    <span class="chain-arrow">←</span>
    <span class="chain-item">Illuminate\Foundation\Http\FormRequest</span>
    <span class="chain-arrow">←</span>
    <span class="chain-item yours">App\Http\Requests\LoginRequest</span>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="gift"></i> Что даёт родитель бесплатно</div>
    <table class="data-table">
      <tr><th>Возможность</th><th>Описание</th></tr>
      <tr><td><strong>Автовалидация</strong></td><td>Вызывается автоматически до входа в метод контроллера</td></tr>
      <tr><td><strong>authorize()</strong></td><td>Проверка прав — если <code>false</code>, вернёт 403</td></tr>
      <tr><td><strong>rules()</strong></td><td>Ты определяешь правила, Laravel их применяет</td></tr>
      <tr><td><strong>messages()</strong></td><td>Кастомные сообщения об ошибках</td></tr>
      <tr><td><strong>validated()</strong></td><td>Возвращает только провалидированные данные (безопасно для create)</td></tr>
      <tr><td><strong>prepareForValidation()</strong></td><td>Hook: преобразовать данные до валидации</td></tr>
      <tr><td><strong>passedValidation()</strong></td><td>Hook: действия после успешной валидации</td></tr>
      <tr><td><strong>failedValidation()</strong></td><td>Hook: кастомный ответ при ошибке</td></tr>
      <tr><td><strong>Всё от Request</strong></td><td><code>$this->input()</code>, <code>$this->file()</code>, <code>$this->ip()</code>, etc.</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="code-2"></i> Упрощённый код родителя</div>
<pre><code><span class="c-comment">// Illuminate\Foundation\Http\FormRequest (упрощён)</span>
<span class="c-key">class</span> <span class="c-type">FormRequest</span> <span class="c-key">extends</span> <span class="c-type">Request</span>
{
    <span class="c-comment">// Laravel вызывает это АВТОМАТИЧЕСКИ через Service Container</span>
    <span class="c-key">public function</span> <span class="c-fn">validateResolved</span>()
    {
        <span class="c-var">$this</span>-><span class="c-fn">prepareForValidation</span>();    <span class="c-comment">// ← твой hook</span>

        <span class="c-key">if</span> (! <span class="c-var">$this</span>-><span class="c-fn">passesAuthorization</span>()) {
            <span class="c-var">$this</span>-><span class="c-fn">failedAuthorization</span>();   <span class="c-comment">// → 403</span>
        }

        <span class="c-var">$validator</span> = <span class="c-var">$this</span>-><span class="c-fn">getValidatorInstance</span>();
        <span class="c-comment">// Правила берёт из $this->rules()</span>

        <span class="c-key">if</span> (<span class="c-var">$validator</span>-><span class="c-fn">fails</span>()) {
            <span class="c-var">$this</span>-><span class="c-fn">failedValidation</span>(<span class="c-var">$validator</span>); <span class="c-comment">// → redirect/422</span>
        }

        <span class="c-var">$this</span>-><span class="c-fn">passedValidation</span>();           <span class="c-comment">// ← твой hook</span>
    }

    <span class="c-key">public function</span> <span class="c-fn">authorize</span>() { <span class="c-key">return</span> <span class="c-key">true</span>; }
    <span class="c-key">public function</span> <span class="c-fn">rules</span>()     { <span class="c-key">return</span> []; }
    <span class="c-key">public function</span> <span class="c-fn">messages</span>()  { <span class="c-key">return</span> []; }
    <span class="c-key">public function</span> <span class="c-fn">validated</span>() { <span class="c-comment">/* возвращает только проверенные данные */</span> }
    <span class="c-key">protected function</span> <span class="c-fn">prepareForValidation</span>() { <span class="c-comment">/* пусто — ты переопределяешь */</span> }
    <span class="c-key">protected function</span> <span class="c-fn">passedValidation</span>() { <span class="c-comment">/* пусто */</span> }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="pen-tool"></i> Твой класс</div>
<pre><code><span class="c-key">class</span> <span class="c-type">LoginRequest</span> <span class="c-key">extends</span> <span class="c-type">FormRequest</span>
{
    <span class="c-key">public function</span> <span class="c-fn">authorize</span>(): <span class="c-type">bool</span>
    {
        <span class="c-key">return</span> <span class="c-key">true</span>; <span class="c-comment">// любой может попробовать залогиниться</span>
    }

    <span class="c-key">public function</span> <span class="c-fn">rules</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'email'</span>    => [<span class="c-str">'required'</span>, <span class="c-str">'email'</span>],
            <span class="c-str">'password'</span> => [<span class="c-str">'required'</span>, <span class="c-str">'min:8'</span>],
        ];
    }

    <span class="c-key">public function</span> <span class="c-fn">messages</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'email.required'</span> => <span class="c-str">'Введите email'</span>,
        ];
    }

    <span class="c-key">protected function</span> <span class="c-fn">prepareForValidation</span>()
    {
        <span class="c-var">$this</span>-><span class="c-fn">merge</span>([
            <span class="c-str">'email'</span> => <span class="c-fn">strtolower</span>(<span class="c-var">$this</span>-><span class="c-var">email</span>),
        ]);
    }
}
</code></pre>
  </div>

  <div class="info-box success">
    <strong>Запомни:</strong> <code>validated()</code> — возвращает ТОЛЬКО те поля, которые прошли валидацию. Это безопасно передавать в <code>Model::create()</code>. А <code>$request->all()</code> — опасно, может содержать лишние поля.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     MIDDLEWARE
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-middleware" class="section">
  <div class="section-title">Middleware</div>

  <div class="info-box purple">
    <strong>Нет наследования!</strong> Middleware в Laravel — это просто класс с методом <code>handle()</code>. Он реализует паттерн «Pipeline» (цепочка обработчиков). Никакого родительского класса не требуется.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="code-2"></i> Что Laravel ожидает</div>
<pre><code><span class="c-comment">// Middleware — просто класс с handle()</span>
<span class="c-key">class</span> <span class="c-type">CheckAge</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>, <span class="c-type">Closure</span> <span class="c-var">$next</span>): <span class="c-type">Response</span>
    {
        <span class="c-key">if</span> (<span class="c-var">$request</span>-><span class="c-fn">age</span> < <span class="c-num">18</span>) {
            <span class="c-key">return</span> <span class="c-fn">redirect</span>(<span class="c-str">'home'</span>);
        }

        <span class="c-key">return</span> <span class="c-var">$next</span>(<span class="c-var">$request</span>); <span class="c-comment">// передаём дальше по цепочке</span>
    }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Виды middleware</div>
    <table class="data-table">
      <tr><th>Вид</th><th>Когда выполняется</th><th>Пример</th></tr>
      <tr><td><strong>Before</strong></td><td>До контроллера</td><td>Проверка auth, CORS</td></tr>
      <tr><td><strong>After</strong></td><td>После контроллера</td><td>Добавить заголовки к response</td></tr>
      <tr><td><strong>Terminable</strong></td><td>После отправки ответа клиенту</td><td>Логирование, аналитика (метод <code>terminate()</code>)</td></tr>
    </table>
<pre><code><span class="c-comment">// After middleware</span>
<span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-var">$request</span>, <span class="c-type">Closure</span> <span class="c-var">$next</span>)
{
    <span class="c-var">$response</span> = <span class="c-var">$next</span>(<span class="c-var">$request</span>);  <span class="c-comment">// сначала контроллер</span>
    <span class="c-var">$response</span>-><span class="c-fn">header</span>(<span class="c-str">'X-Custom'</span>, <span class="c-str">'value'</span>);  <span class="c-comment">// потом модификация</span>
    <span class="c-key">return</span> <span class="c-var">$response</span>;
}

<span class="c-comment">// Terminable middleware</span>
<span class="c-key">public function</span> <span class="c-fn">terminate</span>(<span class="c-var">$request</span>, <span class="c-var">$response</span>)
{
    <span class="c-comment">// Логирование — после того как клиент УЖЕ получил ответ</span>
    <span class="c-type">Log</span>::<span class="c-fn">info</span>(<span class="c-str">'Request processed'</span>, [<span class="c-str">'url'</span> => <span class="c-var">$request</span>-><span class="c-fn">url</span>()]);
}
</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     JOB
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-job" class="section">
  <div class="section-title">Job (Queue)</div>

  <div class="inherit-chain">
    <span class="chain-item">—</span>
    <span class="chain-arrow">implements</span>
    <span class="chain-item">ShouldQueue</span>
    <span class="chain-arrow">+</span>
    <span class="chain-item yours">App\Jobs\SendWelcomeEmail</span>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="gift"></i> Что дают трейты и интерфейс</div>
    <table class="data-table">
      <tr><th>Элемент</th><th>Тип</th><th>Что даёт</th></tr>
      <tr><td><strong>ShouldQueue</strong></td><td>interface</td><td>Маркер — Laravel знает, что класс надо отправить в очередь</td></tr>
      <tr><td><strong>Dispatchable</strong></td><td>trait</td><td><code>SendWelcomeEmail::dispatch($user)</code> — статический метод отправки</td></tr>
      <tr><td><strong>InteractsWithQueue</strong></td><td>trait</td><td><code>$this->attempts()</code>, <code>$this->release(30)</code>, <code>$this->delete()</code></td></tr>
      <tr><td><strong>Queueable</strong></td><td>trait</td><td><code>->onQueue('emails')</code>, <code>->delay(60)</code>, <code>->onConnection('redis')</code></td></tr>
      <tr><td><strong>SerializesModels</strong></td><td>trait</td><td>Модели в конструкторе автоматически сериализуются по ID, а не целиком</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="pen-tool"></i> Твой класс</div>
<pre><code><span class="c-key">class</span> <span class="c-type">SendWelcomeEmail</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">use</span> <span class="c-type">Dispatchable</span>, <span class="c-type">InteractsWithQueue</span>, <span class="c-type">Queueable</span>, <span class="c-type">SerializesModels</span>;

    <span class="c-key">public</span> <span class="c-var">$tries</span> = <span class="c-num">3</span>;         <span class="c-comment">// макс попытки</span>
    <span class="c-key">public</span> <span class="c-var">$backoff</span> = [<span class="c-num">10</span>, <span class="c-num">60</span>]; <span class="c-comment">// задержка между попытками</span>
    <span class="c-key">public</span> <span class="c-var">$timeout</span> = <span class="c-num">120</span>;      <span class="c-comment">// таймаут выполнения</span>

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">public readonly</span> <span class="c-type">User</span> <span class="c-var">$user</span> <span class="c-comment">// ← SerializesModels сохранит только ID</span>
    ) {}

    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">MailService</span> <span class="c-var">$mail</span>): <span class="c-type">void</span> <span class="c-comment">// ← DI из контейнера</span>
    {
        <span class="c-var">$mail</span>-><span class="c-fn">send</span>(<span class="c-var">$this</span>-><span class="c-var">user</span>, <span class="c-str">'welcome'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">failed</span>(<span class="c-type">Throwable</span> <span class="c-var">$e</span>): <span class="c-type">void</span> <span class="c-comment">// ← hook при неудаче</span>
    {
        <span class="c-type">Log</span>::<span class="c-fn">error</span>(<span class="c-str">'Welcome email failed'</span>, [<span class="c-str">'user'</span> => <span class="c-var">$this</span>-><span class="c-var">user</span>-><span class="c-var">id</span>]);
    }
}

<span class="c-comment">// Вызов:</span>
<span class="c-type">SendWelcomeEmail</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$user</span>)-><span class="c-fn">onQueue</span>(<span class="c-str">'emails'</span>);
</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     COMMAND
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-command" class="section">
  <div class="section-title">Command (Artisan)</div>

  <div class="inherit-chain">
    <span class="chain-item">Symfony\Component\Console\Command\Command</span>
    <span class="chain-arrow">←</span>
    <span class="chain-item">Illuminate\Console\Command</span>
    <span class="chain-arrow">←</span>
    <span class="chain-item yours">App\Console\Commands\CleanOldLogs</span>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="gift"></i> Что даёт родитель</div>
    <table class="data-table">
      <tr><th>Возможность</th><th>Описание</th></tr>
      <tr><td><strong>$signature</strong></td><td>Определяет имя команды и аргументы: <code>'logs:clean {--days=30}'</code></td></tr>
      <tr><td><strong>$description</strong></td><td>Описание для <code>php artisan list</code></td></tr>
      <tr><td><strong>I/O методы</strong></td><td><code>$this->info()</code>, <code>$this->error()</code>, <code>$this->table()</code>, <code>$this->ask()</code></td></tr>
      <tr><td><strong>Progress bar</strong></td><td><code>$this->withProgressBar($items, fn)</code></td></tr>
      <tr><td><strong>Arguments & Options</strong></td><td><code>$this->argument('name')</code>, <code>$this->option('days')</code></td></tr>
      <tr><td><strong>Scheduling</strong></td><td>Можно привязать к Schedule в <code>console.php</code></td></tr>
      <tr><td><strong>call()</strong></td><td>Вызывать другие artisan-команды программно</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="pen-tool"></i> Твой класс</div>
<pre><code><span class="c-key">class</span> <span class="c-type">CleanOldLogs</span> <span class="c-key">extends</span> <span class="c-type">Command</span>
{
    <span class="c-key">protected</span> <span class="c-var">$signature</span>   = <span class="c-str">'logs:clean {--days=30 : Сколько дней хранить}'</span>;
    <span class="c-key">protected</span> <span class="c-var">$description</span> = <span class="c-str">'Удаляет старые лог-файлы'</span>;

    <span class="c-key">public function</span> <span class="c-fn">handle</span>(): <span class="c-type">int</span>
    {
        <span class="c-var">$days</span> = <span class="c-var">$this</span>-><span class="c-fn">option</span>(<span class="c-str">'days'</span>);
        <span class="c-var">$this</span>-><span class="c-fn">info</span>(<span class="c-str">"Cleaning logs older than {$days} days..."</span>);

        <span class="c-var">$files</span> = <span class="c-type">Storage</span>::<span class="c-fn">files</span>(<span class="c-str">'logs'</span>);
        <span class="c-var">$this</span>-><span class="c-fn">withProgressBar</span>(<span class="c-var">$files</span>, <span class="c-key">function</span>(<span class="c-var">$file</span>) <span class="c-key">use</span> (<span class="c-var">$days</span>) {
            <span class="c-comment">// удаление старых файлов...</span>
        });

        <span class="c-var">$this</span>-><span class="c-fn">newLine</span>();
        <span class="c-var">$this</span>-><span class="c-fn">info</span>(<span class="c-str">'Done!'</span>);
        <span class="c-key">return</span> <span class="c-type">Command</span>::<span class="c-var">SUCCESS</span>;
    }
}
</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     NOTIFICATION
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-notification" class="section">
  <div class="section-title">Notification</div>

  <div class="inherit-chain">
    <span class="chain-item">Illuminate\Notifications\Notification</span>
    <span class="chain-arrow">←</span>
    <span class="chain-item yours">App\Notifications\OrderShipped</span>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="gift"></i> Что даёт родитель</div>
    <table class="data-table">
      <tr><th>Возможность</th><th>Описание</th></tr>
      <tr><td><strong>via()</strong></td><td>Каналы доставки: <code>['mail', 'database', 'slack']</code></td></tr>
      <tr><td><strong>toMail()</strong></td><td>Формирование email через MailMessage builder</td></tr>
      <tr><td><strong>toArray()</strong></td><td>Формат для хранения в таблице <code>notifications</code></td></tr>
      <tr><td><strong>toDatabase()</strong></td><td>То же, но для database-канала специально</td></tr>
      <tr><td><strong>ShouldQueue</strong></td><td>Добавь интерфейс — и уведомления уйдут в очередь</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="pen-tool"></i> Твой класс</div>
<pre><code><span class="c-key">class</span> <span class="c-type">OrderShipped</span> <span class="c-key">extends</span> <span class="c-type">Notification</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">use</span> <span class="c-type">Queueable</span>;

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">public readonly</span> <span class="c-type">Order</span> <span class="c-var">$order</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">via</span>(<span class="c-var">$notifiable</span>): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [<span class="c-str">'mail'</span>, <span class="c-str">'database'</span>];
    }

    <span class="c-key">public function</span> <span class="c-fn">toMail</span>(<span class="c-var">$notifiable</span>): <span class="c-type">MailMessage</span>
    {
        <span class="c-key">return</span> (<span class="c-key">new</span> <span class="c-type">MailMessage</span>)
            -><span class="c-fn">subject</span>(<span class="c-str">'Ваш заказ отправлен!'</span>)
            -><span class="c-fn">line</span>(<span class="c-str">"Заказ #{$this->order->id} в пути."</span>)
            -><span class="c-fn">action</span>(<span class="c-str">'Отследить'</span>, <span class="c-fn">url</span>(<span class="c-str">"/orders/{$this->order->id}"</span>));
    }

    <span class="c-key">public function</span> <span class="c-fn">toArray</span>(<span class="c-var">$notifiable</span>): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'order_id'</span> => <span class="c-var">$this</span>-><span class="c-var">order</span>-><span class="c-var">id</span>,
            <span class="c-str">'message'</span>  => <span class="c-str">'Заказ отправлен'</span>,
        ];
    }
}

<span class="c-comment">// Вызов:</span>
<span class="c-var">$user</span>-><span class="c-fn">notify</span>(<span class="c-key">new</span> <span class="c-type">OrderShipped</span>(<span class="c-var">$order</span>)); <span class="c-comment">// ← метод из trait Notifiable</span>
</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     MAIL
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-mail" class="section">
  <div class="section-title">Mailable</div>

  <div class="inherit-chain">
    <span class="chain-item">Illuminate\Mail\Mailable</span>
    <span class="chain-arrow">←</span>
    <span class="chain-item yours">App\Mail\WelcomeMail</span>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="gift"></i> Что даёт родитель</div>
    <table class="data-table">
      <tr><th>Метод</th><th>Описание</th></tr>
      <tr><td><strong>envelope()</strong></td><td>Тема, от кого, кому, reply-to</td></tr>
      <tr><td><strong>content()</strong></td><td>Blade-шаблон и данные для него</td></tr>
      <tr><td><strong>attachments()</strong></td><td>Прикрепить файлы</td></tr>
      <tr><td><strong>Chainable API</strong></td><td><code>->to()</code>, <code>->cc()</code>, <code>->bcc()</code>, <code>->subject()</code></td></tr>
      <tr><td><strong>ShouldQueue</strong></td><td>Отправка через очередь</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="pen-tool"></i> Твой класс</div>
<pre><code><span class="c-key">class</span> <span class="c-type">WelcomeMail</span> <span class="c-key">extends</span> <span class="c-type">Mailable</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">use</span> <span class="c-type">Queueable</span>, <span class="c-type">SerializesModels</span>;

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">public readonly</span> <span class="c-type">User</span> <span class="c-var">$user</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">envelope</span>(): <span class="c-type">Envelope</span>
    {
        <span class="c-key">return new</span> <span class="c-type">Envelope</span>(<span class="c-fn">subject</span>: <span class="c-str">'Добро пожаловать!'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">content</span>(): <span class="c-type">Content</span>
    {
        <span class="c-key">return new</span> <span class="c-type">Content</span>(<span class="c-fn">view</span>: <span class="c-str">'emails.welcome'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">attachments</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-type">Attachment</span>::<span class="c-fn">fromPath</span>(<span class="c-str">'/docs/guide.pdf'</span>),
        ];
    }
}

<span class="c-comment">// Вызов:</span>
<span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$user</span>)-><span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">WelcomeMail</span>(<span class="c-var">$user</span>));
</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     EVENT + LISTENER
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-event" class="section">
  <div class="section-title">Event + Listener</div>

  <div class="info-box purple">
    <strong>Event</strong> — это простой DTO-класс (никакого обязательного наследования!). <strong>Listener</strong> — класс с методом <code>handle()</code>. Если добавить <code>ShouldQueue</code> к Listener, он обрабатывается асинхронно.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="radio"></i> Event</div>
<pre><code><span class="c-comment">// Просто класс с данными</span>
<span class="c-key">class</span> <span class="c-type">OrderPlaced</span>
{
    <span class="c-key">use</span> <span class="c-type">Dispatchable</span>, <span class="c-type">SerializesModels</span>;

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">public readonly</span> <span class="c-type">Order</span> <span class="c-var">$order</span>
    ) {}
}

<span class="c-comment">// Вызов:</span>
<span class="c-type">OrderPlaced</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);
<span class="c-comment">// или</span>
<span class="c-fn">event</span>(<span class="c-key">new</span> <span class="c-type">OrderPlaced</span>(<span class="c-var">$order</span>));
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="headphones"></i> Listener</div>
<pre><code><span class="c-key">class</span> <span class="c-type">SendOrderConfirmation</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">OrderPlaced</span> <span class="c-var">$event</span>): <span class="c-type">void</span>
    {
        <span class="c-var">$event</span>-><span class="c-var">order</span>-><span class="c-var">user</span>-><span class="c-fn">notify</span>(<span class="c-key">new</span> <span class="c-type">OrderConfirmation</span>(<span class="c-var">$event</span>-><span class="c-var">order</span>));
    }

    <span class="c-key">public function</span> <span class="c-fn">shouldQueue</span>(<span class="c-type">OrderPlaced</span> <span class="c-var">$event</span>): <span class="c-type">bool</span>
    {
        <span class="c-key">return</span> <span class="c-var">$event</span>-><span class="c-var">order</span>-><span class="c-var">total</span> > <span class="c-num">0</span>; <span class="c-comment">// условная очередь</span>
    }
}
</code></pre>
  </div>

  <div class="info-box success">
    <strong>Регистрация:</strong> В <code>EventServiceProvider</code> → <code>$listen</code> массив, или авто-обнаружение через <code>Event::listen()</code> в <code>boot()</code>, или атрибут <code>#[ListensTo(OrderPlaced::class)]</code> (Laravel 11+).
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     POLICY
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-policy" class="section">
  <div class="section-title">Policy</div>

  <div class="info-box purple">
    <strong>Нет обязательного наследования.</strong> Policy — просто класс с методами-действиями (<code>view</code>, <code>create</code>, <code>update</code>, <code>delete</code>). Laravel привязывает его к модели автоматически по Convention.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="pen-tool"></i> Твой класс</div>
<pre><code><span class="c-key">class</span> <span class="c-type">PostPolicy</span>
{
    <span class="c-comment">// Может ли пользователь обновить пост?</span>
    <span class="c-key">public function</span> <span class="c-fn">update</span>(<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-type">Post</span> <span class="c-var">$post</span>): <span class="c-type">bool</span>
    {
        <span class="c-key">return</span> <span class="c-var">$user</span>-><span class="c-var">id</span> === <span class="c-var">$post</span>-><span class="c-var">user_id</span>;
    }

    <span class="c-comment">// before() — суперадмин может всё</span>
    <span class="c-key">public function</span> <span class="c-fn">before</span>(<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-type">string</span> <span class="c-var">$ability</span>): ?<span class="c-type">bool</span>
    {
        <span class="c-key">if</span> (<span class="c-var">$user</span>-><span class="c-fn">isAdmin</span>()) {
            <span class="c-key">return</span> <span class="c-key">true</span>;
        }
        <span class="c-key">return</span> <span class="c-key">null</span>; <span class="c-comment">// null = проверяй дальше конкретный метод</span>
    }

    <span class="c-key">public function</span> <span class="c-fn">delete</span>(<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-type">Post</span> <span class="c-var">$post</span>): <span class="c-type">bool</span>
    {
        <span class="c-key">return</span> <span class="c-var">$user</span>-><span class="c-var">id</span> === <span class="c-var">$post</span>-><span class="c-var">user_id</span>
            && <span class="c-var">$post</span>-><span class="c-var">published_at</span> === <span class="c-key">null</span>;
    }
}

<span class="c-comment">// Использование:</span>
<span class="c-var">$this</span>-><span class="c-fn">authorize</span>(<span class="c-str">'update'</span>, <span class="c-var">$post</span>);       <span class="c-comment">// в контроллере</span>
@<span class="c-fn">can</span>(<span class="c-str">'update'</span>, <span class="c-var">$post</span>) ... @<span class="c-fn">endcan</span>    <span class="c-comment">// в Blade</span>
<span class="c-type">Gate</span>::<span class="c-fn">allows</span>(<span class="c-str">'update'</span>, <span class="c-var">$post</span>);        <span class="c-comment">// программно</span>
</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     SEEDER / FACTORY
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-seeder" class="section">
  <div class="section-title">Seeder / Factory</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="sprout"></i> Seeder</div>
    <div class="inherit-chain">
      <span class="chain-item">Illuminate\Database\Seeder</span>
      <span class="chain-arrow">←</span>
      <span class="chain-item yours">Database\Seeders\UserSeeder</span>
    </div>
    <table class="data-table">
      <tr><th>Что даёт</th><th>Описание</th></tr>
      <tr><td><strong>run()</strong></td><td>Ты переопределяешь — заполняешь таблицу тестовыми данными</td></tr>
      <tr><td><strong>call()</strong></td><td>Вызвать другие сидеры: <code>$this->call(UserSeeder::class)</code></td></tr>
      <tr><td><strong>command</strong></td><td><code>php artisan db:seed</code></td></tr>
    </table>
<pre><code><span class="c-key">class</span> <span class="c-type">UserSeeder</span> <span class="c-key">extends</span> <span class="c-type">Seeder</span>
{
    <span class="c-key">public function</span> <span class="c-fn">run</span>(): <span class="c-type">void</span>
    {
        <span class="c-type">User</span>::<span class="c-fn">factory</span>(<span class="c-num">50</span>)-><span class="c-fn">create</span>(); <span class="c-comment">// ← Factory!</span>
    }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="factory"></i> Factory</div>
    <div class="inherit-chain">
      <span class="chain-item">Illuminate\Database\Eloquent\Factories\Factory</span>
      <span class="chain-arrow">←</span>
      <span class="chain-item yours">Database\Factories\UserFactory</span>
    </div>
    <table class="data-table">
      <tr><th>Что даёт</th><th>Описание</th></tr>
      <tr><td><strong>definition()</strong></td><td>Ты определяешь шаблон данных с Faker</td></tr>
      <tr><td><strong>States</strong></td><td>Вариации: <code>->admin()</code>, <code>->unverified()</code></td></tr>
      <tr><td><strong>Связь с моделью</strong></td><td>Через trait <code>HasFactory</code> в модели: <code>User::factory()</code></td></tr>
    </table>
<pre><code><span class="c-key">class</span> <span class="c-type">UserFactory</span> <span class="c-key">extends</span> <span class="c-type">Factory</span>
{
    <span class="c-key">protected</span> <span class="c-var">$model</span> = <span class="c-type">User</span>::<span class="c-key">class</span>;

    <span class="c-key">public function</span> <span class="c-fn">definition</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'name'</span>     => <span class="c-fn">fake</span>()-><span class="c-fn">name</span>(),
            <span class="c-str">'email'</span>    => <span class="c-fn">fake</span>()-><span class="c-fn">unique</span>()-><span class="c-fn">safeEmail</span>(),
            <span class="c-str">'password'</span> => <span class="c-fn">bcrypt</span>(<span class="c-str">'password'</span>),
        ];
    }

    <span class="c-key">public function</span> <span class="c-fn">admin</span>(): <span class="c-type">static</span> <span class="c-comment">// state</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">state</span>([<span class="c-str">'role'</span> => <span class="c-str">'admin'</span>]);
    }
}

<span class="c-comment">// Вызов:</span>
<span class="c-type">User</span>::<span class="c-fn">factory</span>()-><span class="c-fn">admin</span>()-><span class="c-fn">count</span>(<span class="c-num">3</span>)-><span class="c-fn">create</span>();
</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     RULE
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-rule" class="section">
  <div class="section-title">Rule (Custom Validation)</div>

  <div class="inherit-chain">
    <span class="chain-item">implements</span>
    <span class="chain-arrow">→</span>
    <span class="chain-item">Illuminate\Contracts\Validation\ValidationRule</span>
    <span class="chain-arrow">←</span>
    <span class="chain-item yours">App\Rules\Uppercase</span>
  </div>

  <div class="info-box purple">
    <strong>Laravel 10+:</strong> Кастомные правила реализуют интерфейс <code>ValidationRule</code> (метод <code>validate()</code>). Раньше был класс <code>Rule</code> с <code>passes()</code> + <code>message()</code>.
  </div>

<pre><code><span class="c-key">class</span> <span class="c-type">Uppercase</span> <span class="c-key">implements</span> <span class="c-type">ValidationRule</span>
{
    <span class="c-key">public function</span> <span class="c-fn">validate</span>(<span class="c-type">string</span> <span class="c-var">$attribute</span>, <span class="c-key">mixed</span> <span class="c-var">$value</span>, <span class="c-type">Closure</span> <span class="c-var">$fail</span>): <span class="c-type">void</span>
    {
        <span class="c-key">if</span> (<span class="c-fn">strtoupper</span>(<span class="c-var">$value</span>) !== <span class="c-var">$value</span>) {
            <span class="c-var">$fail</span>(<span class="c-str">"Поле :attribute должно быть в верхнем регистре."</span>);
        }
    }
}

<span class="c-comment">// Использование:</span>
<span class="c-str">'name'</span> => [<span class="c-str">'required'</span>, <span class="c-key">new</span> <span class="c-type">Uppercase</span>]
</code></pre>
</div>

<!-- ════════════════════════════════════════════════════════════════
     RESOURCE / COLLECTION
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-resource" class="section">
  <div class="section-title">Resource / Collection</div>

  <div class="inherit-chain">
    <span class="chain-item">Illuminate\Http\Resources\Json\JsonResource</span>
    <span class="chain-arrow">←</span>
    <span class="chain-item yours">App\Http\Resources\UserResource</span>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="gift"></i> Что даёт родитель</div>
    <table class="data-table">
      <tr><th>Возможность</th><th>Описание</th></tr>
      <tr><td><strong>toArray()</strong></td><td>Ты определяешь структуру JSON-ответа</td></tr>
      <tr><td><strong>$this->resource</strong></td><td>Доступ к оригинальной модели</td></tr>
      <tr><td><strong>when() / whenLoaded()</strong></td><td>Условные поля: <code>$this->when($condition, $value)</code></td></tr>
      <tr><td><strong>collection()</strong></td><td>Автоматическая обёртка массива моделей</td></tr>
      <tr><td><strong>with()</strong></td><td>Мета-данные: <code>['meta' => ['version' => '1.0']]</code></td></tr>
      <tr><td><strong>Pagination</strong></td><td>Автоматически добавляет <code>links</code> и <code>meta</code> при пагинации</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="pen-tool"></i> Твой класс</div>
<pre><code><span class="c-key">class</span> <span class="c-type">UserResource</span> <span class="c-key">extends</span> <span class="c-type">JsonResource</span>
{
    <span class="c-key">public function</span> <span class="c-fn">toArray</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'id'</span>    => <span class="c-var">$this</span>-><span class="c-var">id</span>,
            <span class="c-str">'name'</span>  => <span class="c-var">$this</span>-><span class="c-var">name</span>,
            <span class="c-str">'email'</span> => <span class="c-var">$this</span>-><span class="c-var">email</span>,
            <span class="c-str">'posts'</span> => <span class="c-type">PostResource</span>::<span class="c-fn">collection</span>(
                <span class="c-var">$this</span>-><span class="c-fn">whenLoaded</span>(<span class="c-str">'posts'</span>) <span class="c-comment">// ← только если загружено</span>
            ),
            <span class="c-str">'is_admin'</span> => <span class="c-var">$this</span>-><span class="c-fn">when</span>(
                <span class="c-var">$request</span>-><span class="c-fn">user</span>()?-><span class="c-fn">isAdmin</span>(), <span class="c-var">$this</span>-><span class="c-var">role</span> === <span class="c-str">'admin'</span>
            ),
        ];
    }
}

<span class="c-comment">// Использование в контроллере:</span>
<span class="c-key">return</span> <span class="c-type">UserResource</span>::<span class="c-fn">collection</span>(<span class="c-type">User</span>::<span class="c-fn">paginate</span>());
</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     EXCEPTION HANDLER
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-exception" class="section">
  <div class="section-title">Exception Handler</div>

  <div class="info-box purple">
    <strong>Laravel 11+:</strong> Exception Handler больше не отдельный класс. Исключения настраиваются в <code>bootstrap/app.php</code> через <code>->withExceptions()</code>. В Laravel 10 и ранее — наследовался <code>Illuminate\Foundation\Exceptions\Handler</code>.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="code-2"></i> Laravel 11+ способ</div>
<pre><code><span class="c-comment">// bootstrap/app.php</span>
<span class="c-key">return</span> <span class="c-type">Application</span>::<span class="c-fn">configure</span>(...)
    -><span class="c-fn">withExceptions</span>(<span class="c-key">function</span> (<span class="c-type">Exceptions</span> <span class="c-var">$exceptions</span>) {
        <span class="c-var">$exceptions</span>-><span class="c-fn">render</span>(<span class="c-key">function</span> (<span class="c-type">NotFoundHttpException</span> <span class="c-var">$e</span>) {
            <span class="c-key">return</span> <span class="c-fn">response</span>()-><span class="c-fn">json</span>([<span class="c-str">'error'</span> => <span class="c-str">'Not found'</span>], <span class="c-num">404</span>);
        });

        <span class="c-var">$exceptions</span>-><span class="c-fn">reportable</span>(<span class="c-key">function</span> (<span class="c-type">PaymentException</span> <span class="c-var">$e</span>) {
            <span class="c-type">Sentry</span>::<span class="c-fn">captureException</span>(<span class="c-var">$e</span>);
        });
    })
    -><span class="c-fn">create</span>();
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="code-2"></i> Laravel 10 способ (наследование)</div>
<pre><code><span class="c-key">class</span> <span class="c-type">Handler</span> <span class="c-key">extends</span> <span class="c-type">ExceptionHandler</span>
{
    <span class="c-key">protected</span> <span class="c-var">$dontReport</span> = [
        <span class="c-type">AuthorizationException</span>::<span class="c-key">class</span>,
    ];

    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-type">void</span>
    {
        <span class="c-var">$this</span>-><span class="c-fn">renderable</span>(<span class="c-key">function</span> (<span class="c-type">NotFoundHttpException</span> <span class="c-var">$e</span>) {
            <span class="c-key">return</span> <span class="c-fn">response</span>()-><span class="c-fn">json</span>([<span class="c-str">'error'</span> => <span class="c-str">'Not found'</span>], <span class="c-num">404</span>);
        });
    }
}
</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     SERVICE PROVIDER
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-provider" class="section">
  <div class="section-title">ServiceProvider</div>

  <div class="inherit-chain">
    <span class="chain-item">Illuminate\Support\ServiceProvider</span>
    <span class="chain-arrow">←</span>
    <span class="chain-item yours">App\Providers\AppServiceProvider</span>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="gift"></i> Что даёт родитель</div>
    <table class="data-table">
      <tr><th>Метод</th><th>Описание</th></tr>
      <tr><td><strong>register()</strong></td><td>Привязки в контейнер: <code>$this->app->bind()</code>, <code>$this->app->singleton()</code></td></tr>
      <tr><td><strong>boot()</strong></td><td>Выполняется ПОСЛЕ регистрации всех провайдеров — здесь роуты, views, observers</td></tr>
      <tr><td><strong>$this->app</strong></td><td>Доступ к Service Container</td></tr>
      <tr><td><strong>mergeConfigFrom()</strong></td><td>Слияние конфига пакета с приложением</td></tr>
      <tr><td><strong>loadRoutesFrom()</strong></td><td>Загрузить файл маршрутов</td></tr>
      <tr><td><strong>loadViewsFrom()</strong></td><td>Регистрация views из пакета</td></tr>
      <tr><td><strong>loadMigrationsFrom()</strong></td><td>Миграции из пакета</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="pen-tool"></i> Твой класс</div>
<pre><code><span class="c-key">class</span> <span class="c-type">AppServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-type">void</span>
    {
        <span class="c-comment">// Привязка интерфейса к реализации</span>
        <span class="c-var">$this</span>-><span class="c-var">app</span>-><span class="c-fn">bind</span>(
            <span class="c-type">PaymentGatewayInterface</span>::<span class="c-key">class</span>,
            <span class="c-type">StripePaymentGateway</span>::<span class="c-key">class</span>
        );
    }

    <span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-type">void</span>
    {
        <span class="c-type">User</span>::<span class="c-fn">observe</span>(<span class="c-type">UserObserver</span>::<span class="c-key">class</span>);

        <span class="c-type">Blade</span>::<span class="c-fn">directive</span>(<span class="c-str">'money'</span>, <span class="c-key">function</span> (<span class="c-var">$amount</span>) {
            <span class="c-key">return</span> <span class="c-str">"&lt;?php echo number_format($amount, 2) . ' ₸'; ?&gt;"</span>;
        });
    }
}
</code></pre>
  </div>

  <div class="info-box warning">
    <strong>register() vs boot():</strong> В <code>register()</code> — только привязки контейнера. Не обращайся к другим сервисам (они могут быть ещё не зарегистрированы!). В <code>boot()</code> — всё остальное, все провайдеры уже загружены.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     MIGRATION
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-migration" class="section">
  <div class="section-title">Migration</div>

  <div class="inherit-chain">
    <span class="chain-item">Illuminate\Database\Migrations\Migration</span>
    <span class="chain-arrow">←</span>
    <span class="chain-item yours">CreateUsersTable</span>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="gift"></i> Что даёт родитель</div>
    <table class="data-table">
      <tr><th>Метод/Свойство</th><th>Описание</th></tr>
      <tr><td><strong>up()</strong></td><td>Ты определяешь — создание/изменение таблицы</td></tr>
      <tr><td><strong>down()</strong></td><td>Ты определяешь — откат миграции</td></tr>
      <tr><td><strong>$connection</strong></td><td>На какое подключение применить</td></tr>
      <tr><td><strong>Schema facade</strong></td><td>Не от родителя, но используется — <code>Schema::create()</code></td></tr>
    </table>
  </div>

<pre><code><span class="c-key">return new class extends</span> <span class="c-type">Migration</span>
{
    <span class="c-key">public function</span> <span class="c-fn">up</span>(): <span class="c-type">void</span>
    {
        <span class="c-type">Schema</span>::<span class="c-fn">create</span>(<span class="c-str">'posts'</span>, <span class="c-key">function</span> (<span class="c-type">Blueprint</span> <span class="c-var">$table</span>) {
            <span class="c-var">$table</span>-><span class="c-fn">id</span>();
            <span class="c-var">$table</span>-><span class="c-fn">foreignId</span>(<span class="c-str">'user_id'</span>)-><span class="c-fn">constrained</span>()-><span class="c-fn">cascadeOnDelete</span>();
            <span class="c-var">$table</span>-><span class="c-fn">string</span>(<span class="c-str">'title'</span>);
            <span class="c-var">$table</span>-><span class="c-fn">text</span>(<span class="c-str">'body'</span>);
            <span class="c-var">$table</span>-><span class="c-fn">timestamps</span>();
            <span class="c-var">$table</span>-><span class="c-fn">softDeletes</span>();
        });
    }

    <span class="c-key">public function</span> <span class="c-fn">down</span>(): <span class="c-type">void</span>
    {
        <span class="c-type">Schema</span>::<span class="c-fn">dropIfExists</span>(<span class="c-str">'posts'</span>);
    }
};
</code></pre>

  <div class="info-box success">
    <strong>Laravel 11+:</strong> Миграции — анонимные классы (<code>return new class extends Migration</code>). Это избегает коллизий имён.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     INTERFACES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-interfaces" class="section">
  <div class="section-title">Интерфейсы (Contracts)</div>

  <p class="text">Интерфейс — это <strong>контракт</strong>. Он говорит: «Любой класс, который меня реализует, обязан иметь вот эти методы». Laravel активно использует интерфейсы через пакет <code>illuminate/contracts</code>.</p>

  <div class="info-box purple">
    <strong>Зачем?</strong> Dependency Inversion (SOLID). Контроллер зависит от интерфейса <code>PaymentGateway</code>, а не от конкретного <code>StripeGateway</code>. В ServiceProvider ты привязываешь нужную реализацию.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Ключевые интерфейсы Laravel</div>
    <table class="data-table">
      <tr><th>Интерфейс</th><th>Пакет</th><th>Что обязывает</th></tr>
      <tr><td><code>ShouldQueue</code></td><td>Contracts\Queue</td><td><strong>Маркер</strong> — класс обрабатывается через очередь (Job, Listener, Notification, Mail)</td></tr>
      <tr><td><code>ShouldBroadcast</code></td><td>Contracts\Broadcasting</td><td>Event передаётся через WebSocket (broadcastOn(), broadcastAs())</td></tr>
      <tr><td><code>Authenticatable</code></td><td>Contracts\Auth</td><td>Модель может использоваться для auth (getAuthIdentifier, getAuthPassword...)</td></tr>
      <tr><td><code>Arrayable</code></td><td>Contracts\Support</td><td>Класс может быть преобразован в array — <code>toArray()</code></td></tr>
      <tr><td><code>Jsonable</code></td><td>Contracts\Support</td><td>Класс может быть преобразован в JSON — <code>toJson()</code></td></tr>
      <tr><td><code>Renderable</code></td><td>Contracts\Support</td><td>Класс может вернуть HTML — <code>render()</code></td></tr>
      <tr><td><code>Responsable</code></td><td>Contracts\Support</td><td>Класс может быть возвращён из контроллера как response — <code>toResponse()</code></td></tr>
      <tr><td><code>ValidationRule</code></td><td>Contracts\Validation</td><td>Кастомное правило валидации — <code>validate()</code></td></tr>
      <tr><td><code>CastsAttributes</code></td><td>Contracts\Database</td><td>Кастомный cast для Eloquent — <code>get()</code>, <code>set()</code></td></tr>
      <tr><td><code>Htmlable</code></td><td>Contracts\Support</td><td>Класс возвращает безопасный HTML — <code>toHtml()</code></td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="code-2"></i> Пример своего интерфейса</div>
<pre><code><span class="c-comment">// Контракт</span>
<span class="c-key">interface</span> <span class="c-type">PaymentGatewayInterface</span>
{
    <span class="c-key">public function</span> <span class="c-fn">charge</span>(<span class="c-type">float</span> <span class="c-var">$amount</span>, <span class="c-type">string</span> <span class="c-var">$token</span>): <span class="c-type">PaymentResult</span>;
    <span class="c-key">public function</span> <span class="c-fn">refund</span>(<span class="c-type">string</span> <span class="c-var">$transactionId</span>): <span class="c-type">bool</span>;
}

<span class="c-comment">// Реализация</span>
<span class="c-key">class</span> <span class="c-type">StripeGateway</span> <span class="c-key">implements</span> <span class="c-type">PaymentGatewayInterface</span>
{
    <span class="c-key">public function</span> <span class="c-fn">charge</span>(<span class="c-type">float</span> <span class="c-var">$amount</span>, <span class="c-type">string</span> <span class="c-var">$token</span>): <span class="c-type">PaymentResult</span>
    {
        <span class="c-comment">// Stripe API call</span>
    }

    <span class="c-key">public function</span> <span class="c-fn">refund</span>(<span class="c-type">string</span> <span class="c-var">$transactionId</span>): <span class="c-type">bool</span>
    {
        <span class="c-comment">// Stripe refund</span>
    }
}

<span class="c-comment">// Привязка в ServiceProvider</span>
<span class="c-var">$this</span>-><span class="c-var">app</span>-><span class="c-fn">bind</span>(<span class="c-type">PaymentGatewayInterface</span>::<span class="c-key">class</span>, <span class="c-type">StripeGateway</span>::<span class="c-key">class</span>);

<span class="c-comment">// В контроллере — зависишь от ИНТЕРФЕЙСА, не реализации</span>
<span class="c-key">public function</span> <span class="c-fn">pay</span>(<span class="c-type">PaymentGatewayInterface</span> <span class="c-var">$gateway</span>) { ... }
</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     TRAITS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-traits" class="section">
  <div class="section-title">Трейты</div>

  <p class="text">Трейт — это <strong>горизонтальное наследование</strong>. Класс может использовать только один родительский класс (<code>extends</code>), но сколько угодно трейтов (<code>use</code>). Laravel активно использует трейты для переиспользования кода.</p>

  <div class="info-box orange">
    <strong>Разница:</strong> Наследование = «я являюсь» (User <em>является</em> Model). Трейт = «я умею» (User <em>умеет</em> SoftDeletes). Интерфейс = «я обязуюсь» (класс <em>обязуется</em> реализовать ShouldQueue).
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Ключевые трейты Laravel</div>
    <table class="data-table">
      <tr><th>Трейт</th><th>Где используется</th><th>Что даёт</th></tr>
      <tr><td><code>HasFactory</code></td><td>Model</td><td><code>User::factory()</code> — создание тестовых данных</td></tr>
      <tr><td><code>SoftDeletes</code></td><td>Model</td><td>«Мягкое удаление»: <code>deleted_at</code>, <code>trashed()</code>, <code>restore()</code>, <code>forceDelete()</code></td></tr>
      <tr><td><code>Notifiable</code></td><td>User model</td><td><code>$user->notify()</code>, <code>$user->notifications</code></td></tr>
      <tr><td><code>HasApiTokens</code></td><td>User model</td><td>Sanctum: <code>$user->createToken()</code>, <code>$user->tokens</code></td></tr>
      <tr><td><code>Dispatchable</code></td><td>Job, Event</td><td><code>MyJob::dispatch()</code> — статический метод создания</td></tr>
      <tr><td><code>InteractsWithQueue</code></td><td>Job</td><td><code>$this->attempts()</code>, <code>$this->release()</code>, <code>$this->delete()</code></td></tr>
      <tr><td><code>Queueable</code></td><td>Job, Mail, Notification</td><td><code>->onQueue()</code>, <code>->delay()</code>, <code>->onConnection()</code></td></tr>
      <tr><td><code>SerializesModels</code></td><td>Job, Mail, Event</td><td>Модели сериализуются по ID при передаче в очередь</td></tr>
      <tr><td><code>AuthorizesRequests</code></td><td>Controller</td><td><code>$this->authorize()</code> — проверка Policy</td></tr>
      <tr><td><code>ValidatesRequests</code></td><td>Controller</td><td><code>$this->validate()</code> — валидация в контроллере</td></tr>
      <tr><td><code>HasRoles</code></td><td>User (Spatie)</td><td><code>$user->assignRole('admin')</code>, <code>$user->hasRole()</code> — пакет Spatie</td></tr>
      <tr><td><code>HasUuids</code></td><td>Model</td><td>UUID вместо auto-increment ID</td></tr>
      <tr><td><code>HasUlids</code></td><td>Model</td><td>ULID вместо auto-increment ID</td></tr>
      <tr><td><code>Searchable</code></td><td>Model (Scout)</td><td>Полнотекстовый поиск через Algolia/Meilisearch</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="code-2"></i> Как это выглядит в модели</div>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Authenticatable</span>   <span class="c-comment">// ← наследование (1 родитель)</span>
{
    <span class="c-key">use</span> <span class="c-type">HasFactory</span>;          <span class="c-comment">// User::factory() — тестирование</span>
    <span class="c-key">use</span> <span class="c-type">Notifiable</span>;          <span class="c-comment">// $user->notify() — уведомления</span>
    <span class="c-key">use</span> <span class="c-type">SoftDeletes</span>;         <span class="c-comment">// $user->delete() → deleted_at</span>
    <span class="c-key">use</span> <span class="c-type">HasApiTokens</span>;        <span class="c-comment">// Sanctum tokens</span>
    <span class="c-key">use</span> <span class="c-type">HasRoles</span>;            <span class="c-comment">// Spatie permissions</span>

    <span class="c-comment">// Теперь User УМЕЕТ всё вышеперечисленное!</span>
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="code-2"></i> Свой трейт</div>
<pre><code><span class="c-key">trait</span> <span class="c-type">HasSlug</span>
{
    <span class="c-key">public static function</span> <span class="c-fn">bootHasSlug</span>(): <span class="c-type">void</span> <span class="c-comment">// boot{TraitName} — авто-вызов</span>
    {
        <span class="c-key">static</span>::<span class="c-fn">creating</span>(<span class="c-key">function</span> (<span class="c-var">$model</span>) {
            <span class="c-var">$model</span>-><span class="c-var">slug</span> = <span class="c-type">Str</span>::<span class="c-fn">slug</span>(<span class="c-var">$model</span>-><span class="c-var">title</span>);
        });
    }

    <span class="c-key">public function</span> <span class="c-fn">getRouteKeyName</span>(): <span class="c-type">string</span>
    {
        <span class="c-key">return</span> <span class="c-str">'slug'</span>;
    }
}

<span class="c-comment">// Использование:</span>
<span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span> { <span class="c-key">use</span> <span class="c-type">HasSlug</span>; }
</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     FACADES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-facades" class="section">
  <div class="section-title">Фасады (Facades)</div>

  <p class="text">Фасад — это <strong>статическая обёртка</strong> над сервисом из контейнера. Когда ты пишешь <code>Cache::get('key')</code>, на самом деле вызывается <code>app('cache')->get('key')</code>. Фасад — это синтаксический сахар.</p>

  <div class="info-box purple">
    <strong>Как работает:</strong> Фасад — класс, наследующий <code>Illuminate\Support\Facades\Facade</code>. Он определяет метод <code>getFacadeAccessor()</code>, который возвращает ключ сервиса в контейнере. Магический метод <code>__callStatic()</code> перенаправляет вызовы к реальному объекту.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Популярные фасады</div>
    <table class="data-table">
      <tr><th>Фасад</th><th>Реальный сервис</th><th>Примеры</th></tr>
      <tr><td><code>Route</code></td><td>Illuminate\Routing\Router</td><td><code>Route::get()</code>, <code>Route::post()</code>, <code>Route::resource()</code></td></tr>
      <tr><td><code>DB</code></td><td>Illuminate\Database\DatabaseManager</td><td><code>DB::table()</code>, <code>DB::select()</code>, <code>DB::transaction()</code></td></tr>
      <tr><td><code>Cache</code></td><td>Illuminate\Cache\CacheManager</td><td><code>Cache::get()</code>, <code>Cache::put()</code>, <code>Cache::remember()</code></td></tr>
      <tr><td><code>Auth</code></td><td>Illuminate\Auth\AuthManager</td><td><code>Auth::user()</code>, <code>Auth::check()</code>, <code>Auth::login()</code></td></tr>
      <tr><td><code>Log</code></td><td>Illuminate\Log\LogManager</td><td><code>Log::info()</code>, <code>Log::error()</code></td></tr>
      <tr><td><code>Mail</code></td><td>Illuminate\Mail\Mailer</td><td><code>Mail::to()->send()</code></td></tr>
      <tr><td><code>Storage</code></td><td>Illuminate\Filesystem\FilesystemManager</td><td><code>Storage::put()</code>, <code>Storage::get()</code>, <code>Storage::url()</code></td></tr>
      <tr><td><code>Gate</code></td><td>Illuminate\Auth\Access\Gate</td><td><code>Gate::allows()</code>, <code>Gate::define()</code></td></tr>
      <tr><td><code>Event</code></td><td>Illuminate\Events\Dispatcher</td><td><code>Event::listen()</code>, <code>Event::dispatch()</code></td></tr>
      <tr><td><code>Queue</code></td><td>Illuminate\Queue\QueueManager</td><td><code>Queue::push()</code>, <code>Queue::size()</code></td></tr>
      <tr><td><code>Schema</code></td><td>Illuminate\Database\Schema\Builder</td><td><code>Schema::create()</code>, <code>Schema::hasTable()</code></td></tr>
      <tr><td><code>Validator</code></td><td>Illuminate\Validation\Factory</td><td><code>Validator::make()</code></td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="code-2"></i> Как создать свой фасад</div>
<pre><code><span class="c-comment">// 1. Сервис</span>
<span class="c-key">class</span> <span class="c-type">SmsService</span>
{
    <span class="c-key">public function</span> <span class="c-fn">send</span>(<span class="c-type">string</span> <span class="c-var">$phone</span>, <span class="c-type">string</span> <span class="c-var">$message</span>): <span class="c-type">bool</span> { <span class="c-comment">/* ... */</span> }
}

<span class="c-comment">// 2. Фасад</span>
<span class="c-key">class</span> <span class="c-type">Sms</span> <span class="c-key">extends</span> <span class="c-type">Facade</span>
{
    <span class="c-key">protected static function</span> <span class="c-fn">getFacadeAccessor</span>(): <span class="c-type">string</span>
    {
        <span class="c-key">return</span> <span class="c-type">SmsService</span>::<span class="c-key">class</span>; <span class="c-comment">// ← ключ в контейнере</span>
    }
}

<span class="c-comment">// 3. Регистрация (ServiceProvider)</span>
<span class="c-var">$this</span>-><span class="c-var">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">SmsService</span>::<span class="c-key">class</span>);

<span class="c-comment">// 4. Использование</span>
<span class="c-type">Sms</span>::<span class="c-fn">send</span>(<span class="c-str">'+77001234567'</span>, <span class="c-str">'Код: 1234'</span>);
<span class="c-comment">// ↑ на самом деле: app(SmsService::class)->send(...)</span>
</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     CONTRACTS vs FACADES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-contracts" class="section">
  <div class="section-title">Contracts vs Facades</div>

  <p class="text">И Contracts (интерфейсы), и Facades решают одну задачу — абстракция от реализации. Но подход разный:</p>

  <table class="data-table">
    <tr><th>Аспект</th><th>Contracts (interfaces)</th><th>Facades</th></tr>
    <tr><td><strong>Синтаксис</strong></td><td><code>__construct(CacheContract $cache)</code></td><td><code>Cache::get('key')</code></td></tr>
    <tr><td><strong>DI</strong></td><td>Явный — через конструктор</td><td>Неявный — через <code>__callStatic</code></td></tr>
    <tr><td><strong>Тестирование</strong></td><td>Легко мокать через DI</td><td><code>Cache::shouldReceive()</code></td></tr>
    <tr><td><strong>IDE support</strong></td><td>Полный автокомплит</td><td>Нужен пакет <code>laravel-ide-helper</code></td></tr>
    <tr><td><strong>Когда использовать</strong></td><td>В сервисах, бизнес-логике</td><td>В контроллерах, routes, config — для удобства</td></tr>
  </table>

  <div class="info-box success">
    <strong>Правило:</strong> В <strong>бизнес-логике</strong> (сервисы, репозитории) — используй Contracts (DI через конструктор). В <strong>контроллерах, middleware, artisan commands</strong> — фасады допустимы для читаемости. На собеседовании скажи: «Я предпочитаю DI через интерфейсы для тестируемости, но фасады удобны в контроллерах».
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     CHEATSHEET
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-cheatsheet" class="section">
  <div class="section-title">Шпаргалка: всё в одной таблице</div>

  <table class="data-table">
    <tr><th>Ты создаёшь</th><th>Наследуешь / реализуешь</th><th>Что переопределяешь</th><th>Ключевые трейты</th></tr>
    <tr><td><strong>Controller</strong></td><td><code>extends Controller</code></td><td>Свои методы-actions</td><td>AuthorizesRequests, ValidatesRequests</td></tr>
    <tr><td><strong>Model</strong></td><td><code>extends Model</code></td><td>$fillable, $casts, relations, scopes</td><td>HasFactory, SoftDeletes, Notifiable</td></tr>
    <tr><td><strong>FormRequest</strong></td><td><code>extends FormRequest</code></td><td>rules(), authorize(), messages()</td><td>—</td></tr>
    <tr><td><strong>Middleware</strong></td><td>Ничего</td><td>handle($request, $next)</td><td>—</td></tr>
    <tr><td><strong>Job</strong></td><td><code>implements ShouldQueue</code></td><td>handle(), failed()</td><td>Dispatchable, Queueable, SerializesModels</td></tr>
    <tr><td><strong>Command</strong></td><td><code>extends Command</code></td><td>$signature, handle()</td><td>—</td></tr>
    <tr><td><strong>Notification</strong></td><td><code>extends Notification</code></td><td>via(), toMail(), toArray()</td><td>Queueable</td></tr>
    <tr><td><strong>Mailable</strong></td><td><code>extends Mailable</code></td><td>envelope(), content(), attachments()</td><td>Queueable, SerializesModels</td></tr>
    <tr><td><strong>Event</strong></td><td>Ничего (DTO)</td><td>—</td><td>Dispatchable, SerializesModels</td></tr>
    <tr><td><strong>Listener</strong></td><td><code>implements ShouldQueue</code> (опц.)</td><td>handle($event)</td><td>—</td></tr>
    <tr><td><strong>Policy</strong></td><td>Ничего</td><td>view, create, update, delete, before</td><td>—</td></tr>
    <tr><td><strong>Seeder</strong></td><td><code>extends Seeder</code></td><td>run()</td><td>—</td></tr>
    <tr><td><strong>Factory</strong></td><td><code>extends Factory</code></td><td>definition(), states</td><td>—</td></tr>
    <tr><td><strong>Rule</strong></td><td><code>implements ValidationRule</code></td><td>validate()</td><td>—</td></tr>
    <tr><td><strong>Resource</strong></td><td><code>extends JsonResource</code></td><td>toArray()</td><td>—</td></tr>
    <tr><td><strong>ServiceProvider</strong></td><td><code>extends ServiceProvider</code></td><td>register(), boot()</td><td>—</td></tr>
    <tr><td><strong>Migration</strong></td><td><code>extends Migration</code></td><td>up(), down()</td><td>—</td></tr>
  </table>
</div>

<!-- ════════════════════════════════════════════════════════════════
     QUIZ
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-quiz" class="section">
  <div class="section-title">Проверь себя</div>

  <div class="qa-item">
    <div class="qa-q" onclick="toggleA(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span> Что такое FormRequest и зачем он нужен?</div>
    <div class="qa-a">FormRequest — это класс, наследующий <code>Illuminate\Foundation\Http\FormRequest</code> (который сам наследует <code>Request</code>). Он инкапсулирует логику валидации и авторизации, убирая её из контроллера. Laravel автоматически вызывает валидацию через Service Container ДО входа в метод контроллера. Ты переопределяешь <code>rules()</code> (правила валидации) и <code>authorize()</code> (проверка прав). Дополнительно можно переопределить <code>messages()</code>, <code>prepareForValidation()</code>, <code>passedValidation()</code>.</div>
  </div>

  <div class="qa-item">
    <div class="qa-q" onclick="toggleA(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span> Чем отличается интерфейс от трейта?</div>
    <div class="qa-a">Интерфейс (interface) — это <strong>контракт</strong>: он объявляет методы, но НЕ содержит реализации. Класс, реализующий интерфейс, обязан написать все методы. Трейт — это <strong>набор готовых методов</strong>, который класс «подключает» через <code>use</code>. Трейт содержит реализацию, но не может быть инстанцирован сам по себе. Интерфейс отвечает на вопрос «что ты обязуешься делать?», трейт — «какие готовые способности ты получаешь?».</div>
  </div>

  <div class="qa-item">
    <div class="qa-q" onclick="toggleA(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span> Что делает trait SoftDeletes?</div>
    <div class="qa-a">Добавляет «мягкое удаление». Вместо реального DELETE из базы, <code>$model->delete()</code> заполняет столбец <code>deleted_at</code> текущей датой. Все запросы через Eloquent автоматически исключают «удалённые» записи (<code>WHERE deleted_at IS NULL</code>). Для доступа к удалённым: <code>withTrashed()</code>, <code>onlyTrashed()</code>. Для реального удаления: <code>forceDelete()</code>. Для восстановления: <code>restore()</code>.</div>
  </div>

  <div class="qa-item">
    <div class="qa-q" onclick="toggleA(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span> Что такое фасад и как он работает внутри?</div>
    <div class="qa-a">Фасад — это статическая обёртка над сервисом из Service Container. Внутри каждый фасад наследует <code>Illuminate\Support\Facades\Facade</code> и определяет метод <code>getFacadeAccessor()</code>, возвращающий ключ сервиса. Когда ты вызываешь <code>Cache::get('key')</code>, магический метод <code>__callStatic()</code> перехватывает вызов, достаёт объект из контейнера по ключу, и вызывает метод <code>get()</code> уже на реальном объекте. Это синтаксический сахар для <code>app('cache')->get('key')</code>.</div>
  </div>

  <div class="qa-item">
    <div class="qa-q" onclick="toggleA(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span> Зачем ShouldQueue — это интерфейс, а не класс?</div>
    <div class="qa-a">Потому что ShouldQueue — это <strong>маркерный интерфейс</strong> (marker interface). Он не содержит методов, которые нужно реализовать. Он просто «маркирует» класс: «этот класс должен обрабатываться через очередь». Laravel проверяет <code>$job instanceof ShouldQueue</code> и решает — выполнить синхронно или отправить в очередь. Если бы это был класс, Job/Notification/Listener не смогли бы его наследовать (в PHP нет множественного наследования классов), а интерфейсов можно реализовать сколько угодно.</div>
  </div>

  <div class="qa-item">
    <div class="qa-q" onclick="toggleA(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span> Что даёт trait HasFactory и зачем его подключать к модели?</div>
    <div class="qa-a"><code>HasFactory</code> добавляет модели статический метод <code>factory()</code>, который создаёт экземпляр соответствующей Factory-класса. По Convention: для <code>App\Models\User</code> ищется <code>Database\Factories\UserFactory</code>. Без этого трейта ты бы писал <code>UserFactory::new()->create()</code> вместо <code>User::factory()->create()</code>. Это нужно для тестов (генерация тестовых данных) и сидеров.</div>
  </div>

  <div class="qa-item">
    <div class="qa-q" onclick="toggleA(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span> Можно ли создать контроллер без extends Controller?</div>
    <div class="qa-a">Да! Laravel не требует наследования для контроллера. Можно создать простой class с методами — роутер вызовет их через контейнер. Или invokable controller с методом <code>__invoke()</code>. Но без наследования ты теряешь: <code>$this->middleware()</code>, <code>$this->authorize()</code>, <code>$this->validate()</code> — эти методы приходят из базового Controller и его трейтов.</div>
  </div>

  <div class="qa-item">
    <div class="qa-q" onclick="toggleA(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span> Чем Contracts отличаются от Facades в Laravel?</div>
    <div class="qa-a">Оба предоставляют доступ к сервисам контейнера, но по-разному. Contracts — это интерфейсы из пакета <code>illuminate/contracts</code>, их инжектят через конструктор (DI). Facades — статические обёртки, вызываются как <code>Cache::get()</code>. Contracts лучше для тестируемости и явного DI. Facades удобнее синтаксически. В бизнес-логике предпочтительны Contracts, в контроллерах допустимы Facades.</div>
  </div>

  <div class="qa-item">
    <div class="qa-q" onclick="toggleA(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span> Зачем trait SerializesModels в Job?</div>
    <div class="qa-a">Когда Job отправляется в очередь, все его свойства сериализуются в JSON/строку для хранения (Redis, database). Без <code>SerializesModels</code>, Eloquent модель сериализовалась бы целиком (все атрибуты, relations). С этим трейтом — сохраняется только ID модели и имя класса. Когда worker берёт Job из очереди, трейт по ID достаёт свежую модель из БД. Это: 1) экономит место в очереди, 2) гарантирует актуальные данные, 3) избегает проблем с сериализацией сложных объектов.</div>
  </div>

  <div class="qa-item">
    <div class="qa-q" onclick="toggleA(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span> Что такое register() vs boot() в ServiceProvider?</div>
    <div class="qa-a"><code>register()</code> вызывается первым — здесь только привязки контейнера (<code>bind</code>, <code>singleton</code>). Нельзя использовать другие сервисы, потому что они могут быть ещё не зарегистрированы. <code>boot()</code> вызывается ПОСЛЕ того, как ВСЕ провайдеры отработали <code>register()</code>. Здесь можно делать всё: регистрировать observers, маршруты, Blade directives, event listeners. Порядок: все register() → все boot().</div>
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

function toggleA(el) {
  const a = el.nextElementSibling;
  a.classList.toggle('open');
}
</script>
</body>
</html>

@endverbatim
