@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Eloquent Advanced — глубокий разбор</title>
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
.bad-good{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;}
.bad-good .bad{border-left:3px solid #D0404E;padding-left:12px;}
.bad-good .good{border-left:3px solid #0D7D53;padding-left:12px;}
.bad-good h4{font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;}
.bad-good .bad h4{color:#D0404E;}
.bad-good .good h4{color:#0D7D53;}
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
.diagram{background:#1E1E2D;color:#ABB2BF;border-radius:var(--radius);padding:18px;overflow-x:auto;font-family:'JetBrains Mono',monospace;font-size:12px;line-height:1.5;white-space:pre;margin-bottom:14px;}
ul.bullets{margin:8px 0 14px 22px;color:var(--text2);font-size:13px;line-height:1.85;}
ul.bullets li{margin-bottom:4px;}
ul.bullets strong{color:var(--text);}
.task-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:18px 20px;margin-bottom:18px;box-shadow:var(--shadow);border-left:4px solid var(--primary);}
.task-card h3{font-size:15px;font-weight:700;color:var(--text);margin-bottom:8px;}
.task-card .criteria{font-size:12.5px;color:var(--primary);background:var(--primary-light);padding:8px 12px;border-radius:6px;margin-top:10px;}
</style>
</head>
<body>
<div class="container">
<div class="sidebar">
  <a href="/" class="sidebar-back"><i data-lucide="arrow-left"></i> На главную</a>
  <div class="sidebar-title">Eloquent Advanced</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">Relations</div>
  <a class="nav-item" onclick="showSection('relations-all',this)"><i data-lucide="list"></i> Все типы (обзор)</a>
  <a class="nav-item" onclick="showSection('relations-btm',this)"><i data-lucide="users"></i> belongsToMany + Pivot</a>
  <a class="nav-item" onclick="showSection('relations-through',this)"><i data-lucide="git-branch"></i> hasManyThrough</a>
  <a class="nav-item" onclick="showSection('relations-poly',this)"><i data-lucide="git-fork"></i> Polymorphic</a>
  <a class="nav-item" onclick="showSection('relations-eager',this)"><i data-lucide="zap"></i> Eager loading</a>

  <div class="nav-group-label">Attributes</div>
  <a class="nav-item" onclick="showSection('attr-casts',this)"><i data-lucide="repeat"></i> Casts</a>
  <a class="nav-item" onclick="showSection('attr-acc',this)"><i data-lucide="edit-3"></i> Accessors / Mutators</a>
  <a class="nav-item" onclick="showSection('attr-hidden',this)"><i data-lucide="eye-off"></i> Hidden / Visible / Appended</a>

  <div class="nav-group-label">Запросы</div>
  <a class="nav-item" onclick="showSection('query-scopes',this)"><i data-lucide="filter"></i> Scopes (local + global)</a>
  <a class="nav-item" onclick="showSection('query-softdel',this)"><i data-lucide="trash"></i> Soft Deletes</a>
  <a class="nav-item" onclick="showSection('query-subquery',this)"><i data-lucide="layers"></i> Subqueries / raw</a>
  <a class="nav-item" onclick="showSection('query-chunks',this)"><i data-lucide="split"></i> chunk / lazy / cursor</a>
  <a class="nav-item" onclick="showSection('query-upsert',this)"><i data-lucide="upload"></i> upsert / insert bulk</a>

  <div class="nav-group-label">События</div>
  <a class="nav-item" onclick="showSection('event-model',this)"><i data-lucide="activity"></i> Model Events</a>
  <a class="nav-item" onclick="showSection('event-observer',this)"><i data-lucide="eye"></i> Observers</a>
  <a class="nav-item" onclick="showSection('event-traits',this)"><i data-lucide="puzzle"></i> Bootable traits</a>

  <div class="nav-group-label">Производительность</div>
  <a class="nav-item" onclick="showSection('perf-nplusone',this)"><i data-lucide="alert-triangle"></i> N+1 проблема</a>
  <a class="nav-item" onclick="showSection('perf-tx',this)"><i data-lucide="lock"></i> Транзакции</a>
  <a class="nav-item" onclick="showSection('perf-joins',this)"><i data-lucide="git-merge"></i> Relations vs JOIN</a>
  <a class="nav-item" onclick="showSection('perf-collection',this)"><i data-lucide="layers-3"></i> Eloquent vs Support Collection</a>

  <div class="nav-group-label">Применение</div>
  <a class="nav-item" onclick="showSection('practice',this)"><i data-lucide="hammer"></i> Практика (5 задач)</a>
  <a class="nav-item" onclick="showSection('pitfalls',this)"><i data-lucide="alert-octagon"></i> Подводные камни</a>
  <a class="nav-item" onclick="showSection('interview',this)"><i data-lucide="brain"></i> На собеседование</a>
</div>

<div class="main">
<div class="page-header">
  <h1>Eloquent Advanced — глубокий разбор</h1>
  <p>То что отличает middle от junior: polymorphic, hasManyThrough, custom casts, observers, race conditions, chunk vs cursor vs lazy. С практическими задачами и interview-вопросами.</p>
  <div class="badge-row">
    <span class="badge">Laravel</span>
    <span class="badge">Eloquent</span>
    <span class="badge">Advanced</span>
    <span class="badge badge-success">Interview-ready</span>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     OVERVIEW
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>

  <p class="text">Это <strong>не повторение</strong> KB_3 (там был обзор Eloquent на уровне «что такое»). Здесь — <strong>глубокий разбор</strong> с упором на:</p>
  <ul class="bullets">
    <li>что реально спрашивают на собеседовании на middle/senior;</li>
    <li>что встречается в продакшене и ломается без понимания;</li>
    <li>как избегать race conditions, N+1, мест где «оно работало, а потом перестало».</li>
  </ul>

  <div class="info-box primary">
    <strong>После прочтения ты должен уметь:</strong>
    <ul class="bullets" style="margin-top:8px;margin-bottom:0;">
      <li>спроектировать любые relations включая polymorphic и hasManyThrough без подсказок;</li>
      <li>выбрать между <code>with()</code>, <code>load()</code>, <code>chunk()</code>, <code>cursor()</code>, <code>lazy()</code> для конкретной задачи;</li>
      <li>написать кастомный каст и accessor в новом API (Laravel 9+);</li>
      <li>использовать observers без бесконечных циклов и race conditions;</li>
      <li>объяснить как Eloquent отличается от Query Builder под капотом.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Prerequisites</div>
    <ul class="bullets">
      <li><strong>KB_1</strong> — PHP OOP, traits, magic methods</li>
      <li><strong>KB_2</strong> — SQL, JOIN, индексы</li>
      <li><strong>KB_3</strong> разделы 1-5 — базовый Eloquent</li>
      <li><strong>KB_9</strong> — что наследует <code>Model</code></li>
    </ul>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     RELATIONS — ALL TYPES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-relations-all" class="section">
  <div class="section-title">Все типы relations — обзор</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Relation — это объявленный в модели метод, который декларативно описывает связь с другой моделью. На основании этого объявления Eloquent генерирует SQL-запросы (SELECT, JOIN, подзапросы) и гидрирует результат в коллекцию связанных моделей.</p>
    <p class="text">Преимущества декларативного подхода относительно ручного построения запросов:</p>
    <ul class="bullets">
      <li>отсутствие дублирования JOIN-логики между контроллерами и сервисами;</li>
      <li>работа с объектной моделью домена (<code>$post-&gt;author-&gt;name</code>) вместо плоских массивов;</li>
      <li>встроенная оптимизация: <code>with()</code> и <code>load()</code> автоматически устраняют проблему N+1;</li>
      <li>композиция relation с произвольными условиями: <code>$user-&gt;posts()-&gt;where('published', true)-&gt;count()</code>.</li>
    </ul>
    <p class="text">Eloquent предоставляет десять типов отношений, разделённых на четыре категории по кардинальности и характеру связи: один к одному, один ко многим, многие ко многим и полиморфные.</p>
  </div>

  <!-- ─── 2. ВСЕ ОБЪЕКТЫ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень типов отношений</div>

    <p class="text">Каждый тип разбирается по единой схеме: определение, область применения, генерируемый SQL, синтаксис объявления и использования. Порядок изложения: четыре базовых типа, две модификации «через промежуточную модель», четыре полиморфных варианта.</p>

    <!-- Группа 1: один к одному -->
    <div class="card">
      <h3>1. <code>hasOne</code></h3>
      <p class="text"><strong>Определение.</strong> Связь, при которой одной записи родительской модели соответствует не более одной записи дочерней модели. Внешний ключ располагается в дочерней таблице.</p>
      <p class="text"><strong>Применение.</strong> Используется при декомпозиции таблицы по соображениям нормализации, разделения прав доступа или производительности. Характерные примеры: <code>User</code> и <code>Profile</code> (расширенные атрибуты профиля), <code>Order</code> и <code>Invoice</code> (счёт-фактура), <code>User</code> и <code>ApiToken</code>.</p>
      <p class="text"><strong>SQL.</strong> Один запрос вида <code>SELECT * FROM profiles WHERE user_id = ? LIMIT 1</code>.</p>
<pre><code><span class="c-comment">// Таблица profiles: id, user_id, bio, avatar</span>
<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">profile</span>(): <span class="c-type">HasOne</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasOne</span>(<span class="c-type">Profile</span>::<span class="c-key">class</span>);
        <span class="c-comment">// эквивалентно: hasOne(Profile::class, 'user_id', 'id')</span>
    }
}

<span class="c-comment">// Использование</span>
<span class="c-var">$user</span>-><span class="c-var">profile</span>;             <span class="c-comment">// Profile или null</span>
<span class="c-var">$user</span>-><span class="c-var">profile</span>-><span class="c-var">bio</span>;        <span class="c-comment">// доступ к полю</span>
<span class="c-var">$user</span>-><span class="c-fn">profile</span>()-><span class="c-fn">create</span>([<span class="c-str">'bio'</span> =&gt; <span class="c-str">'Hello'</span>]);  <span class="c-comment">// создать привязанный profile</span>
</code></pre>
    </div>

    <div class="card">
      <h3>2. <code>belongsTo</code></h3>
      <p class="text"><strong>Определение.</strong> Обратная сторона <code>hasOne</code> и <code>hasMany</code>. Объявляется на модели, таблица которой содержит внешний ключ, ссылающийся на родительскую модель.</p>
      <p class="text"><strong>Применение.</strong> Восходящий обход графа моделей: из дочерней получить родительскую. Примеры: <code>Post::author()</code> (поле <code>posts.user_id</code>), <code>OrderItem::order()</code> (поле <code>order_items.order_id</code>), <code>Comment::post()</code>. Эвристика: внешний ключ <code>*_id</code> находится в таблице той модели, на которой объявляется <code>belongsTo</code>.</p>
      <p class="text"><strong>SQL.</strong> <code>SELECT * FROM users WHERE id = ? LIMIT 1</code>.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">author</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-comment">// 2-й параметр — имя FK (если не стандартное user_id)</span>
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsTo</span>(<span class="c-type">User</span>::<span class="c-key">class</span>, <span class="c-str">'user_id'</span>);
    }
}

<span class="c-var">$post</span>-><span class="c-var">author</span>;                <span class="c-comment">// User или null</span>
<span class="c-var">$post</span>-><span class="c-fn">author</span>()-><span class="c-fn">associate</span>(<span class="c-var">$user</span>);    <span class="c-comment">// привязать (set user_id)</span>
<span class="c-var">$post</span>-><span class="c-fn">author</span>()-><span class="c-fn">dissociate</span>();         <span class="c-comment">// отвязать (user_id = null)</span>
</code></pre>
    </div>

    <div class="card">
      <h3>3. <code>hasMany</code></h3>
      <p class="text"><strong>Определение.</strong> Одной родительской записи соответствует произвольное количество дочерних. Внешний ключ располагается в дочерней таблице.</p>
      <p class="text"><strong>Применение.</strong> Самое распространённое отношение в реляционных моделях. Примеры: <code>Post</code> и <code>Comment</code>, <code>User</code> и <code>Order</code>, <code>Category</code> и <code>Product</code>, <code>Author</code> и <code>Book</code>.</p>
      <p class="text"><strong>SQL.</strong> При обращении к одной модели: <code>SELECT * FROM comments WHERE post_id = ?</code>. При eager loading коллекции: <code>SELECT * FROM comments WHERE post_id IN (?, ?, ...)</code>.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">comments</span>(): <span class="c-type">HasMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasMany</span>(<span class="c-type">Comment</span>::<span class="c-key">class</span>);
    }
}

<span class="c-var">$post</span>-><span class="c-var">comments</span>;                          <span class="c-comment">// Collection&lt;Comment&gt;</span>
<span class="c-var">$post</span>-><span class="c-fn">comments</span>()-><span class="c-fn">where</span>(<span class="c-str">'approved'</span>, <span class="c-key">true</span>)-><span class="c-fn">get</span>(); <span class="c-comment">// фильтр</span>
<span class="c-var">$post</span>-><span class="c-fn">comments</span>()-><span class="c-fn">create</span>([<span class="c-str">'body'</span> =&gt; <span class="c-str">'Привет'</span>]);    <span class="c-comment">// создать привязанный</span>
<span class="c-var">$post</span>-><span class="c-fn">comments</span>()-><span class="c-fn">count</span>();                  <span class="c-comment">// число коммов (SELECT COUNT)</span>
</code></pre>
    </div>

    <div class="card">
      <h3>4. <code>belongsToMany</code></h3>
      <p class="text"><strong>Определение.</strong> Симметричное отношение «многие ко многим», при котором каждая запись одной модели может быть связана с произвольным количеством записей другой и наоборот. Реализуется через промежуточную (pivot) таблицу, содержащую как минимум два внешних ключа.</p>
      <p class="text"><strong>Применение.</strong> Связи без направления подчинённости: <code>User</code> и <code>Role</code> (пользователь имеет несколько ролей, одна роль назначена множеству пользователей), <code>Post</code> и <code>Tag</code>, <code>Student</code> и <code>Course</code>, <code>Product</code> и <code>Warehouse</code>.</p>
      <p class="text"><strong>SQL.</strong> <code>SELECT roles.* FROM roles INNER JOIN role_user ON role_user.role_id = roles.id WHERE role_user.user_id = ?</code>.</p>
<pre><code><span class="c-comment">// Pivot-таблица role_user: user_id + role_id</span>
<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">roles</span>(): <span class="c-type">BelongsToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsToMany</span>(<span class="c-type">Role</span>::<span class="c-key">class</span>);
    }
}

<span class="c-var">$user</span>-><span class="c-var">roles</span>;                          <span class="c-comment">// Collection&lt;Role&gt;</span>
<span class="c-var">$user</span>-><span class="c-fn">roles</span>()-><span class="c-fn">attach</span>(<span class="c-num">3</span>);              <span class="c-comment">// добавить роль с id=3</span>
<span class="c-var">$user</span>-><span class="c-fn">roles</span>()-><span class="c-fn">detach</span>(<span class="c-num">3</span>);              <span class="c-comment">// отвязать роль с id=3</span>
<span class="c-var">$user</span>-><span class="c-fn">roles</span>()-><span class="c-fn">sync</span>([<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">5</span>]);       <span class="c-comment">// оставить ровно эти, остальные убрать</span>
</code></pre>
      <p class="text">Детальный разбор pivot с дополнительными колонками, кастомными pivot-моделями и методами синхронизации вынесен в отдельный подраздел «belongsToMany &amp; Pivot».</p>
    </div>

    <div class="card">
      <h3>5. <code>hasOneThrough</code></h3>
      <p class="text"><strong>Определение.</strong> Доступ к единственной записи из «дальней» таблицы через одну промежуточную модель. Применяется к транзитивным отношениям длины 2.</p>
      <p class="text"><strong>Применение.</strong> Когда между двумя моделями отсутствует прямая связь, но существует промежуточная сущность, дающая логически однозначное соответствие. Пример: <code>Country</code> &mdash; <code>User</code> &mdash; <code>Profile</code>, где требуется получить профиль главного представителя страны.</p>
      <p class="text">Альтернатива &mdash; последовательность из двух обращений к relation, однако <code>hasOneThrough</code> выполняется одним SQL-запросом с JOIN, что эффективнее.</p>
<pre><code><span class="c-comment">// Country → User → Profile</span>
<span class="c-key">class</span> <span class="c-type">Country</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">primaryProfile</span>(): <span class="c-type">HasOneThrough</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasOneThrough</span>(<span class="c-type">Profile</span>::<span class="c-key">class</span>, <span class="c-type">User</span>::<span class="c-key">class</span>);
        <span class="c-comment">// SQL: SELECT profiles.* FROM profiles</span>
        <span class="c-comment">//      INNER JOIN users ON profiles.user_id = users.id</span>
        <span class="c-comment">//      WHERE users.country_id = ? LIMIT 1</span>
    }
}

<span class="c-var">$country</span>-><span class="c-var">primaryProfile</span>;  <span class="c-comment">// Profile или null</span>
</code></pre>
    </div>

    <div class="card">
      <h3>6. <code>hasManyThrough</code></h3>
      <p class="text"><strong>Определение.</strong> Аналог <code>hasOneThrough</code> с возвратом коллекции. Позволяет получить все записи «дальней» таблицы, связанные с текущей моделью через одну промежуточную.</p>
      <p class="text"><strong>Применение.</strong> Транзитивный обход агрегатов. Примеры: <code>Country</code> &mdash; <code>User</code> &mdash; <code>Post</code> (все посты пользователей страны), <code>Project</code> &mdash; <code>User</code> &mdash; <code>Task</code>, <code>Forum</code> &mdash; <code>Thread</code> &mdash; <code>Reply</code>.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">Country</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">posts</span>(): <span class="c-type">HasManyThrough</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasManyThrough</span>(<span class="c-type">Post</span>::<span class="c-key">class</span>, <span class="c-type">User</span>::<span class="c-key">class</span>);
    }
}

<span class="c-var">$country</span>-><span class="c-var">posts</span>;            <span class="c-comment">// Collection&lt;Post&gt; — все посты всех юзеров страны</span>
<span class="c-var">$country</span>-><span class="c-fn">posts</span>()-><span class="c-fn">count</span>();   <span class="c-comment">// число одним SQL</span>
</code></pre>
      <p class="text">Сравнение с <code>whereHas</code> и нестандартными вариантами цепочек разобрано в отдельном подразделе «hasManyThrough».</p>
    </div>

    <div class="card">
      <h3>7. <code>morphOne</code></h3>
      <p class="text"><strong>Определение.</strong> Полиморфный вариант <code>hasOne</code>: к текущей модели привязана одна запись, но идентификатор привязки хранится в комбинации из двух колонок &mdash; <code>{name}_type</code> (полное имя класса родителя) и <code>{name}_id</code> (его идентификатор).</p>
      <p class="text"><strong>Применение.</strong> Когда несколько различных моделей нуждаются в одинаково устроенной «однократной» связанной сущности. Пример: единственное изображение-аватар у <code>User</code> и единственное изображение-обложка у <code>Post</code>, при этом обе сущности используют общую таблицу <code>images</code>.</p>
<pre><code><span class="c-comment">// Таблица images: id, imageable_type, imageable_id, url</span>
<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">avatar</span>(): <span class="c-type">MorphOne</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphOne</span>(<span class="c-type">Image</span>::<span class="c-key">class</span>, <span class="c-str">'imageable'</span>);
    }
}

<span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">cover</span>(): <span class="c-type">MorphOne</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphOne</span>(<span class="c-type">Image</span>::<span class="c-key">class</span>, <span class="c-str">'imageable'</span>);
    }
}

<span class="c-var">$user</span>-><span class="c-var">avatar</span>-><span class="c-var">url</span>;
<span class="c-var">$post</span>-><span class="c-var">cover</span>-><span class="c-var">url</span>;
</code></pre>
    </div>

    <div class="card">
      <h3>8. <code>morphMany</code></h3>
      <p class="text"><strong>Определение.</strong> Полиморфный вариант <code>hasMany</code>: к текущей модели может быть привязано произвольное количество записей единой связанной таблицы, при этом разные родительские модели делят одно хранилище.</p>
      <p class="text"><strong>Применение.</strong> Классический случай &mdash; система комментариев, в которой <code>Comment</code> может относиться к <code>Post</code>, <code>Photo</code> или <code>Video</code>. Альтернативой было бы создание отдельных таблиц <code>post_comments</code>, <code>photo_comments</code>, <code>video_comments</code>, что приводит к дублированию схемы и логики.</p>
<pre><code><span class="c-comment">// Таблица comments: id, commentable_type, commentable_id, body</span>
<span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">comments</span>(): <span class="c-type">MorphMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphMany</span>(<span class="c-type">Comment</span>::<span class="c-key">class</span>, <span class="c-str">'commentable'</span>);
    }
}

<span class="c-key">class</span> <span class="c-type">Photo</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">comments</span>(): <span class="c-type">MorphMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphMany</span>(<span class="c-type">Comment</span>::<span class="c-key">class</span>, <span class="c-str">'commentable'</span>);
    }
}

<span class="c-var">$post</span>-><span class="c-var">comments</span>;                       <span class="c-comment">// Collection&lt;Comment&gt;</span>
<span class="c-var">$post</span>-><span class="c-fn">comments</span>()-><span class="c-fn">create</span>([<span class="c-str">'body'</span> =&gt; <span class="c-str">'!'</span>]);  <span class="c-comment">// commentable_type=App\Models\Post автоматически</span>
</code></pre>
    </div>

    <div class="card">
      <h3>9. <code>morphTo</code></h3>
      <p class="text"><strong>Определение.</strong> Обратная сторона полиморфного отношения. Объявляется на модели, в таблице которой хранится пара колонок <code>{name}_type</code> и <code>{name}_id</code>. Eloquent определяет конкретный класс родителя по значению из колонки <code>_type</code> и инстанцирует соответствующую модель.</p>
      <p class="text"><strong>Применение.</strong> Используется в паре с <code>morphOne</code> или <code>morphMany</code>: на модели <code>Comment</code>, <code>Image</code>, <code>Like</code> и им подобных. Позволяет из связанной записи получить родительскую сущность произвольного типа.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">Comment</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">commentable</span>(): <span class="c-type">MorphTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphTo</span>();
    }
}

<span class="c-var">$comment</span>-><span class="c-var">commentable</span>;     <span class="c-comment">// Post, Photo, или Video — в зависимости от commentable_type</span>

<span class="c-key">if</span> (<span class="c-var">$comment</span>-><span class="c-var">commentable</span> <span class="c-key">instanceof</span> <span class="c-type">Post</span>) { ... }
</code></pre>
      <p class="text"><strong>Примечание о хранении типа.</strong> По умолчанию Laravel записывает в колонку <code>{name}_type</code> полное имя класса (например, <code>App\Models\Post</code>). Это создаёт жёсткую зависимость данных от структуры неймспейсов: переименование класса или перемещение его в другой каталог делает существующие записи нечитаемыми. Решение &mdash; явная регистрация морф-карты через <code>Relation::enforceMorphMap()</code>, разобранная в подразделе «Polymorphic».</p>
    </div>

    <div class="card">
      <h3>10. <code>morphToMany</code> и <code>morphedByMany</code></h3>
      <p class="text"><strong>Определение.</strong> Полиморфный вариант отношения «многие ко многим». Промежуточная таблица содержит, помимо двух внешних ключей, дополнительную колонку <code>{name}_type</code>, что позволяет одной общей таблице связей обслуживать несколько типов родительских моделей. Объявление <code>morphToMany</code> используется на «специализированной» стороне (Post, Photo), <code>morphedByMany</code> &mdash; на «общей» (Tag).</p>
      <p class="text"><strong>Применение.</strong> Системы тегирования, категоризации, отметок «избранное» и иных свойств, применимых к разнородным сущностям без дублирования pivot-таблиц для каждой пары.</p>
<pre><code><span class="c-comment">// Pivot polymorphic: taggables (tag_id, taggable_id, taggable_type)</span>
<span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">tags</span>(): <span class="c-type">MorphToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphToMany</span>(<span class="c-type">Tag</span>::<span class="c-key">class</span>, <span class="c-str">'taggable'</span>);
    }
}

<span class="c-key">class</span> <span class="c-type">Tag</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-comment">// На стороне «общей» сущности — обратная связь morphedByMany</span>
    <span class="c-key">public function</span> <span class="c-fn">posts</span>(): <span class="c-type">MorphToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphedByMany</span>(<span class="c-type">Post</span>::<span class="c-key">class</span>, <span class="c-str">'taggable'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">photos</span>(): <span class="c-type">MorphToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphedByMany</span>(<span class="c-type">Photo</span>::<span class="c-key">class</span>, <span class="c-str">'taggable'</span>);
    }
}

<span class="c-var">$post</span>-><span class="c-fn">tags</span>()-><span class="c-fn">attach</span>(<span class="c-var">$tag</span>-><span class="c-var">id</span>);    <span class="c-comment">// прикрепить тег</span>
<span class="c-var">$tag</span>-><span class="c-var">posts</span>;                       <span class="c-comment">// все посты с этим тегом</span>
<span class="c-var">$tag</span>-><span class="c-var">photos</span>;                      <span class="c-comment">// все фото с этим тегом</span>
</code></pre>
    </div>

    <div class="info-box primary">
      <strong>Правило выбора (когда сомневаешься):</strong>
      <ul class="bullets" style="margin-top:6px;margin-bottom:0;color:#404357;">
        <li>FK <code>*_id</code> на текущей модели → <code>belongsTo</code></li>
        <li>FK <code>*_id</code> на «дочерней» модели → <code>hasOne</code> (если одна) или <code>hasMany</code> (если много)</li>
        <li>Нужна отдельная таблица связей с двумя FK → <code>belongsToMany</code></li>
        <li>Нужно дотянуться через промежуточную модель → <code>hasManyThrough</code></li>
        <li>Одна сущность связана с несколькими разными моделями → <code>morphTo</code> на ней + <code>morphMany</code>/<code>morphToMany</code> на родителях</li>
      </ul>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА НА ПРИМЕРЕ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: схема блога</div>

    <p class="text">Чтобы продемонстрировать взаимодействие всех изложенных типов отношений, рассмотрим схему многопользовательского блога. Большинство десяти relation встретится в одной модельной структуре.</p>

    <p class="text">Сущности предметной области:</p>
    <ul class="bullets">
      <li><code>User</code> &mdash; зарегистрированный пользователь; автор статей, комментариев и лайков;</li>
      <li><code>Profile</code> &mdash; расширенная информация о пользователе, вынесенная в отдельную таблицу;</li>
      <li><code>Post</code> &mdash; опубликованная статья;</li>
      <li><code>Comment</code> &mdash; комментарий, оставленный к <code>Post</code> или <code>Photo</code>;</li>
      <li><code>Photo</code> &mdash; самостоятельный медиаобъект в галерее;</li>
      <li><code>Tag</code> &mdash; тематическая метка, применимая и к <code>Post</code>, и к <code>Photo</code>;</li>
      <li><code>Like</code> &mdash; реакция, оставленная к <code>Post</code>, <code>Comment</code> или <code>Photo</code>;</li>
      <li><code>Country</code> &mdash; географическая принадлежность пользователя.</li>
    </ul>

<pre><code><span class="c-comment">// ═══════════════════ User ═══════════════════</span>
<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-comment">// hasOne — один профиль</span>
    <span class="c-key">public function</span> <span class="c-fn">profile</span>(): <span class="c-type">HasOne</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasOne</span>(<span class="c-type">Profile</span>::<span class="c-key">class</span>);
    }

    <span class="c-comment">// hasMany — много постов</span>
    <span class="c-key">public function</span> <span class="c-fn">posts</span>(): <span class="c-type">HasMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasMany</span>(<span class="c-type">Post</span>::<span class="c-key">class</span>);
    }

    <span class="c-comment">// belongsTo — юзер принадлежит стране</span>
    <span class="c-key">public function</span> <span class="c-fn">country</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsTo</span>(<span class="c-type">Country</span>::<span class="c-key">class</span>);
    }
}

<span class="c-comment">// ═══════════════════ Post ═══════════════════</span>
<span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-comment">// belongsTo — автор</span>
    <span class="c-key">public function</span> <span class="c-fn">author</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsTo</span>(<span class="c-type">User</span>::<span class="c-key">class</span>, <span class="c-str">'user_id'</span>);
    }

    <span class="c-comment">// morphMany — комментарии (полиморфные, могут быть и у Photo)</span>
    <span class="c-key">public function</span> <span class="c-fn">comments</span>(): <span class="c-type">MorphMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphMany</span>(<span class="c-type">Comment</span>::<span class="c-key">class</span>, <span class="c-str">'commentable'</span>);
    }

    <span class="c-comment">// morphToMany — теги (общие с Photo)</span>
    <span class="c-key">public function</span> <span class="c-fn">tags</span>(): <span class="c-type">MorphToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphToMany</span>(<span class="c-type">Tag</span>::<span class="c-key">class</span>, <span class="c-str">'taggable'</span>);
    }

    <span class="c-comment">// morphMany — лайки</span>
    <span class="c-key">public function</span> <span class="c-fn">likes</span>(): <span class="c-type">MorphMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphMany</span>(<span class="c-type">Like</span>::<span class="c-key">class</span>, <span class="c-str">'likeable'</span>);
    }
}

<span class="c-comment">// ═══════════════════ Comment ═══════════════════</span>
<span class="c-key">class</span> <span class="c-type">Comment</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-comment">// morphTo — к чему привязан комментарий (Post или Photo)</span>
    <span class="c-key">public function</span> <span class="c-fn">commentable</span>(): <span class="c-type">MorphTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphTo</span>();
    }

    <span class="c-comment">// belongsTo — автор коммента</span>
    <span class="c-key">public function</span> <span class="c-fn">author</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsTo</span>(<span class="c-type">User</span>::<span class="c-key">class</span>, <span class="c-str">'user_id'</span>);
    }
}

<span class="c-comment">// ═══════════════════ Tag ═══════════════════</span>
<span class="c-key">class</span> <span class="c-type">Tag</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-comment">// morphedByMany — обратная сторона polymorphic many-to-many</span>
    <span class="c-key">public function</span> <span class="c-fn">posts</span>(): <span class="c-type">MorphToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphedByMany</span>(<span class="c-type">Post</span>::<span class="c-key">class</span>, <span class="c-str">'taggable'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">photos</span>(): <span class="c-type">MorphToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphedByMany</span>(<span class="c-type">Photo</span>::<span class="c-key">class</span>, <span class="c-str">'taggable'</span>);
    }
}

<span class="c-comment">// ═══════════════════ Country ═══════════════════</span>
<span class="c-key">class</span> <span class="c-type">Country</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-comment">// hasMany — много юзеров</span>
    <span class="c-key">public function</span> <span class="c-fn">users</span>(): <span class="c-type">HasMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasMany</span>(<span class="c-type">User</span>::<span class="c-key">class</span>);
    }

    <span class="c-comment">// hasManyThrough — все посты всех юзеров страны</span>
    <span class="c-key">public function</span> <span class="c-fn">posts</span>(): <span class="c-type">HasManyThrough</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasManyThrough</span>(<span class="c-type">Post</span>::<span class="c-key">class</span>, <span class="c-type">User</span>::<span class="c-key">class</span>);
    }

    <span class="c-comment">// hasOneThrough — главный модератор страны (один первый по дате)</span>
    <span class="c-key">public function</span> <span class="c-fn">leadModerator</span>(): <span class="c-type">HasOneThrough</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasOneThrough</span>(<span class="c-type">Profile</span>::<span class="c-key">class</span>, <span class="c-type">User</span>::<span class="c-key">class</span>)
            -><span class="c-fn">where</span>(<span class="c-str">'users.role'</span>, <span class="c-str">'moderator'</span>);
    }
}
</code></pre>

    <p class="text">Типовые сценарии применения объявленных отношений:</p>
<pre><code><span class="c-comment">// 1. Страница страны: пользователи, посты, главный модератор — одним набором запросов</span>
<span class="c-var">$country</span> = <span class="c-type">Country</span>::<span class="c-fn">with</span>([<span class="c-str">'users.profile'</span>, <span class="c-str">'posts.author'</span>, <span class="c-str">'leadModerator'</span>])
    -><span class="c-fn">findOrFail</span>(<span class="c-num">1</span>);

<span class="c-comment">// 2. Лента блога — посты с автором, тегами, числом комментов и лайков</span>
<span class="c-var">$feed</span> = <span class="c-type">Post</span>::<span class="c-fn">with</span>([<span class="c-str">'author.profile'</span>, <span class="c-str">'tags'</span>])
    -><span class="c-fn">withCount</span>([<span class="c-str">'comments'</span>, <span class="c-str">'likes'</span>])
    -><span class="c-fn">latest</span>()
    -><span class="c-fn">paginate</span>(<span class="c-num">10</span>);

<span class="c-comment">// 3. Привязать тег к посту</span>
<span class="c-var">$post</span>-><span class="c-fn">tags</span>()-><span class="c-fn">attach</span>(<span class="c-var">$tag</span>-><span class="c-var">id</span>);
<span class="c-var">$post</span>-><span class="c-fn">tags</span>()-><span class="c-fn">sync</span>([<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>]); <span class="c-comment">// заменить все теги на эти</span>

<span class="c-comment">// 4. Оставить комментарий к посту (через morphMany)</span>
<span class="c-var">$post</span>-><span class="c-fn">comments</span>()-><span class="c-fn">create</span>([
    <span class="c-str">'body'</span> =&gt; <span class="c-str">'Привет!'</span>,
    <span class="c-str">'user_id'</span> =&gt; <span class="c-fn">auth</span>()-><span class="c-fn">id</span>(),
]);

<span class="c-comment">// 5. На странице коммента узнать, к чему он привязан</span>
<span class="c-key">if</span> (<span class="c-var">$comment</span>-><span class="c-var">commentable</span> <span class="c-key">instanceof</span> <span class="c-type">Post</span>) {
    <span class="c-key">return</span> <span class="c-fn">route</span>(<span class="c-str">'posts.show'</span>, <span class="c-var">$comment</span>-><span class="c-var">commentable</span>);
} <span class="c-key">elseif</span> (<span class="c-var">$comment</span>-><span class="c-var">commentable</span> <span class="c-key">instanceof</span> <span class="c-type">Photo</span>) {
    <span class="c-key">return</span> <span class="c-fn">route</span>(<span class="c-str">'photos.show'</span>, <span class="c-var">$comment</span>-><span class="c-var">commentable</span>);
}

<span class="c-comment">// 6. Все посты, отмеченные тегом "laravel"</span>
<span class="c-var">$posts</span> = <span class="c-type">Tag</span>::<span class="c-fn">where</span>(<span class="c-str">'name'</span>, <span class="c-str">'laravel'</span>)-><span class="c-fn">first</span>()-><span class="c-var">posts</span>;

<span class="c-comment">// 7. Юзеры, у которых есть хотя бы один опубликованный пост</span>
<span class="c-type">User</span>::<span class="c-fn">whereHas</span>(<span class="c-str">'posts'</span>, <span class="c-key">fn</span>(<span class="c-var">$q</span>) =&gt; <span class="c-var">$q</span>-><span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'published'</span>))
    -><span class="c-fn">get</span>();
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. Имена внешних ключей.</strong> Eloquent предполагает соглашение snake_case с суффиксом <code>_id</code> и именем, производным от связанной модели (<code>user_id</code>, <code>post_id</code>). При отступлении от соглашения &mdash; например, использовании <code>author_id</code> вместо <code>user_id</code> &mdash; имя ключа необходимо указывать явно вторым параметром: <code>belongsTo(User::class, 'author_id')</code>.
    </div>

    <div class="pitfall">
      <strong>2. Имя pivot-таблицы определяется алфавитно.</strong> Для пары <code>User</code> и <code>Role</code> Eloquent ожидает таблицу <code>role_user</code>, а не <code>user_role</code>. При несоответствии передавайте имя таблицы вторым параметром: <code>belongsToMany(Role::class, 'user_roles')</code>.
    </div>

    <div class="pitfall">
      <strong>3. Обращение к <code>belongsTo</code> при NULL во внешнем ключе.</strong> Если поле <code>posts.user_id</code> допускает значение NULL, выражение <code>$post-&gt;author-&gt;name</code> приведёт к ошибке доступа к свойству у <code>null</code>. Корректные подходы: использование nullsafe-оператора <code>$post-&gt;author?-&gt;name ?? 'Аноним'</code>, либо ограничение <code>NOT NULL</code> на уровне миграции.
    </div>

    <div class="pitfall">
      <strong>4. Утрата ссылки в полиморфных колонках после рефакторинга.</strong> В таблице хранится полное имя класса (например, <code>App\Models\Post</code>). Переименование, перенос в другой неймспейс или удаление класса делают связанные записи неразрешимыми. Стандартное решение &mdash; декларация явного отображения через <code>Relation::enforceMorphMap()</code> в провайдере приложения.
    </div>

    <div class="pitfall">
      <strong>5. Глубина цепочки в <code>hasManyThrough</code>.</strong> Метод поддерживает только одну промежуточную модель. Для цепочек большей длины (например, <code>Country</code> &mdash; <code>Region</code> &mdash; <code>City</code> &mdash; <code>Hotel</code>) необходим либо ручной JOIN-запрос, либо сторонний пакет <code>staudenmeir/eloquent-has-many-deep</code>.
    </div>

    <div class="pitfall">
      <strong>6. Стоимость <code>morphTo</code> при eager loading.</strong> В отличие от <code>belongsTo</code>, требующего одного запроса, <code>morphTo</code> вынужден выполнить отдельный запрос для каждого встреченного типа &mdash; невозможно построить JOIN, не зная заранее, к какой таблице обращаться. Это следует учитывать при проектировании выборок с большим количеством разнородных родителей.
    </div>

    <div class="pitfall">
      <strong>7. Различие между методом и динамическим свойством.</strong> Обращение <code>$user-&gt;posts</code> возвращает уже загруженную коллекцию (или выполняет запрос и кеширует результат). Обращение <code>$user-&gt;posts()</code> возвращает экземпляр построителя запросов, к которому можно применять дополнительные ограничения: <code>$user-&gt;posts()-&gt;where('status', 'published')-&gt;count()</code>. Смешение этих форм приводит либо к избыточным запросам, либо к ошибкам компиляции.
    </div>

    <div class="pitfall">
      <strong>8. Рекурсивные отношения.</strong> Модель может ссылаться на саму себя &mdash; например, <code>User</code> с полем <code>manager_id</code>, указывающим на другого <code>User</code>. Это объявляется как <code>belongsTo(User::class, 'manager_id')</code>. При использовании eager loading необходимо ограничивать глубину рекурсии, поскольку выражение вида <code>with('manager.manager.manager')</code> приведёт к экспоненциальному росту количества запросов.
    </div>

    <div class="info-box success">
      <strong>Рекомендация по именованию.</strong> Имена relation должны делать выражения в коде читаемыми как естественный текст. Конструкция <code>$post-&gt;author-&gt;profile-&gt;avatar</code> однозначно описывает обход графа моделей. Сокращения наподобие <code>$post-&gt;u-&gt;p-&gt;a</code> экономят символы, но требуют чтения схемы для понимания.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     RELATIONS — BELONGS TO MANY + PIVOT
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-relations-btm" class="section">
  <div class="section-title">belongsToMany и Pivot</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Отношение «многие ко многим» реализуется в реляционных базах данных через промежуточную таблицу, традиционно называемую pivot-таблицей. Она содержит как минимум два внешних ключа, ссылающихся на связываемые сущности, и может включать дополнительные атрибуты, описывающие саму связь, &mdash; временные метки, статус, автор присвоения, дату истечения.</p>
    <p class="text">Объявление <code>belongsToMany</code> в модели Eloquent скрывает работу с этой таблицей: при обращении к свойству выполняется JOIN, при вызове методов <code>attach</code>, <code>detach</code>, <code>sync</code> производятся соответствующие INSERT и DELETE. При этом дополнительные колонки pivot-таблицы доступны через специальный атрибут <code>pivot</code> на связанной модели.</p>
    <p class="text">Понимание pivot-таблицы как самостоятельного хранилища данных о связи &mdash; ключевое отличие промышленного применения отношений от учебных примеров. Большинство реальных задач (управление ролями с истечением, корзина с количеством товара, участники проекта с уровнем доступа) требуют не только факта связи, но и её атрибутов.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Компоненты механизма</div>

    <div class="card">
      <h3>Базовая схема и объявление</h3>
      <p class="text">Минимальная конфигурация состоит из миграции pivot-таблицы с двумя внешними ключами и двух взаимно-симметричных объявлений <code>belongsToMany</code> на связываемых моделях.</p>
<pre><code><span class="c-comment">// Миграция pivot-таблицы. Имя соответствует соглашению:</span>
<span class="c-comment">// две модели в алфавитном порядке, snake_case, единственное число.</span>
<span class="c-type">Schema</span>::<span class="c-fn">create</span>(<span class="c-str">'role_user'</span>, <span class="c-key">function</span> (<span class="c-type">Blueprint</span> <span class="c-var">$table</span>) {
    <span class="c-var">$table</span>-><span class="c-fn">foreignId</span>(<span class="c-str">'user_id'</span>)-><span class="c-fn">constrained</span>()-><span class="c-fn">cascadeOnDelete</span>();
    <span class="c-var">$table</span>-><span class="c-fn">foreignId</span>(<span class="c-str">'role_id'</span>)-><span class="c-fn">constrained</span>()-><span class="c-fn">cascadeOnDelete</span>();
    <span class="c-var">$table</span>-><span class="c-fn">primary</span>([<span class="c-str">'user_id'</span>, <span class="c-str">'role_id'</span>]);
});

<span class="c-comment">// На каждой из связываемых моделей объявляется зеркальный метод.</span>
<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">roles</span>(): <span class="c-type">BelongsToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsToMany</span>(<span class="c-type">Role</span>::<span class="c-key">class</span>);
    }
}

<span class="c-key">class</span> <span class="c-type">Role</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">users</span>(): <span class="c-type">BelongsToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsToMany</span>(<span class="c-type">User</span>::<span class="c-key">class</span>);
    }
}
</code></pre>
      <p class="text">Объявление принимает дополнительные параметры для случаев, когда имена таблицы или ключей отступают от соглашений: <code>belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id')</code>.</p>
    </div>

    <div class="card">
      <h3>Дополнительные колонки pivot-таблицы</h3>
      <p class="text">Если pivot-таблица содержит атрибуты сверх двух внешних ключей, их необходимо явно перечислить через <code>withPivot()</code>, иначе они не будут возвращены в результатах запроса. Метод <code>withTimestamps()</code> подключает обработку колонок <code>created_at</code> и <code>updated_at</code>, обновляемых при <code>attach</code>, <code>updateExistingPivot</code> и связанных операциях.</p>
<pre><code><span class="c-type">Schema</span>::<span class="c-fn">create</span>(<span class="c-str">'role_user'</span>, <span class="c-key">function</span> (<span class="c-type">Blueprint</span> <span class="c-var">$table</span>) {
    <span class="c-var">$table</span>-><span class="c-fn">id</span>();
    <span class="c-var">$table</span>-><span class="c-fn">foreignId</span>(<span class="c-str">'user_id'</span>)-><span class="c-fn">constrained</span>();
    <span class="c-var">$table</span>-><span class="c-fn">foreignId</span>(<span class="c-str">'role_id'</span>)-><span class="c-fn">constrained</span>();
    <span class="c-var">$table</span>-><span class="c-fn">foreignId</span>(<span class="c-str">'granted_by_user_id'</span>)-><span class="c-fn">constrained</span>(<span class="c-str">'users'</span>);
    <span class="c-var">$table</span>-><span class="c-fn">timestamp</span>(<span class="c-str">'expires_at'</span>)-><span class="c-fn">nullable</span>();
    <span class="c-var">$table</span>-><span class="c-fn">timestamps</span>();
});

<span class="c-key">public function</span> <span class="c-fn">roles</span>(): <span class="c-type">BelongsToMany</span>
{
    <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsToMany</span>(<span class="c-type">Role</span>::<span class="c-key">class</span>)
        -><span class="c-fn">withPivot</span>(<span class="c-str">'expires_at'</span>, <span class="c-str">'granted_by_user_id'</span>)
        -><span class="c-fn">withTimestamps</span>();
}

<span class="c-comment">// Доступ к атрибутам pivot осуществляется через свойство pivot.</span>
<span class="c-key">foreach</span> (<span class="c-var">$user</span>-><span class="c-var">roles</span> <span class="c-key">as</span> <span class="c-var">$role</span>) {
    <span class="c-fn">echo</span> <span class="c-var">$role</span>-><span class="c-var">name</span>;
    <span class="c-fn">echo</span> <span class="c-var">$role</span>-><span class="c-var">pivot</span>-><span class="c-var">expires_at</span>;
    <span class="c-fn">echo</span> <span class="c-var">$role</span>-><span class="c-var">pivot</span>-><span class="c-var">created_at</span>;
}
</code></pre>
      <p class="text">Имя свойства <code>pivot</code> можно переопределить методом <code>as()</code>: <code>belongsToMany(Role::class)-&gt;as('membership')</code>. Это особенно полезно, когда pivot-связь имеет собственное доменное значение и обращение через <code>$role-&gt;membership-&gt;expires_at</code> читается естественнее.</p>
    </div>

    <div class="card">
      <h3>Pivot-модель</h3>
      <p class="text">При наличии содержательной логики, относящейся к самой связи, pivot-таблица может быть представлена отдельной моделью, наследующей класс <code>Illuminate\Database\Eloquent\Relations\Pivot</code> (или <code>MorphPivot</code> для полиморфных случаев). Такая модель подключается через метод <code>using()</code> в объявлении relation.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Relations\Pivot</span>;

<span class="c-key">class</span> <span class="c-type">UserRole</span> <span class="c-key">extends</span> <span class="c-type">Pivot</span>
{
    <span class="c-key">protected</span> <span class="c-var">$casts</span> = [
        <span class="c-str">'expires_at'</span> =&gt; <span class="c-str">'datetime'</span>,
    ];

    <span class="c-key">public function</span> <span class="c-fn">isExpired</span>(): <span class="c-key">bool</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-var">expires_at</span> !== <span class="c-key">null</span>
            &amp;&amp; <span class="c-var">$this</span>-><span class="c-var">expires_at</span>-><span class="c-fn">isPast</span>();
    }

    <span class="c-key">public function</span> <span class="c-fn">grantedBy</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsTo</span>(<span class="c-type">User</span>::<span class="c-key">class</span>, <span class="c-str">'granted_by_user_id'</span>);
    }
}

<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">roles</span>(): <span class="c-type">BelongsToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsToMany</span>(<span class="c-type">Role</span>::<span class="c-key">class</span>)
            -><span class="c-fn">using</span>(<span class="c-type">UserRole</span>::<span class="c-key">class</span>)
            -><span class="c-fn">withPivot</span>(<span class="c-str">'expires_at'</span>, <span class="c-str">'granted_by_user_id'</span>)
            -><span class="c-fn">withTimestamps</span>();
    }
}

<span class="c-comment">// Теперь pivot — полноценная модель с собственными методами и отношениями.</span>
<span class="c-key">foreach</span> (<span class="c-var">$user</span>-><span class="c-var">roles</span> <span class="c-key">as</span> <span class="c-var">$role</span>) {
    <span class="c-key">if</span> (<span class="c-var">$role</span>-><span class="c-var">pivot</span>-><span class="c-fn">isExpired</span>()) {
        <span class="c-key">continue</span>;
    }
    <span class="c-var">$grantedByName</span> = <span class="c-var">$role</span>-><span class="c-var">pivot</span>-><span class="c-var">grantedBy</span>-><span class="c-var">name</span>;
}
</code></pre>
    </div>

    <div class="card">
      <h3>Методы управления связями</h3>
      <p class="text">Eloquent предоставляет набор методов для манипуляции записями pivot-таблицы. Все они вызываются на построителе relation (<code>$user-&gt;roles()</code>), а не на коллекции.</p>
      <table class="data-table">
        <tr><th>Метод</th><th>Поведение</th></tr>
        <tr><td><code>attach($id)</code></td><td>Создаёт связь. Принимает идентификатор, массив идентификаторов или модель.</td></tr>
        <tr><td><code>attach($id, ['expires_at' =&gt; ...])</code></td><td>Создаёт связь с заданными значениями дополнительных колонок pivot-таблицы.</td></tr>
        <tr><td><code>detach($id)</code></td><td>Удаляет указанную связь.</td></tr>
        <tr><td><code>detach()</code></td><td>Вызов без аргументов удаляет все связи текущей модели.</td></tr>
        <tr><td><code>sync([1, 2, 3])</code></td><td>Приводит набор связей к указанному: добавляет отсутствующие, удаляет лишние.</td></tr>
        <tr><td><code>syncWithoutDetaching([1, 2])</code></td><td>Добавляет отсутствующие связи, существующие не затрагивает.</td></tr>
        <tr><td><code>toggle([1, 2])</code></td><td>Инвертирует состояние связи: добавляет недостающее, удаляет имеющееся.</td></tr>
        <tr><td><code>updateExistingPivot($id, [...])</code></td><td>Обновляет дополнительные колонки pivot-записи без создания новой связи.</td></tr>
        <tr><td><code>syncWithPivotValues([1, 2], ['scope' =&gt; 'admin'])</code></td><td>Синхронизирует связи и одновременно записывает одинаковые значения в дополнительные колонки pivot.</td></tr>
      </table>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: система ролей с временным членством</div>

    <p class="text">Рассмотрим типичный сценарий: пользователю можно назначить роль с указанием срока действия и автора назначения. Через определённое время роль автоматически перестаёт считаться действительной, при этом запись об историческом назначении сохраняется.</p>

    <p class="text">Схема данных:</p>
<pre><code><span class="c-comment">// Миграция таблиц</span>
<span class="c-type">Schema</span>::<span class="c-fn">create</span>(<span class="c-str">'roles'</span>, <span class="c-key">function</span> (<span class="c-type">Blueprint</span> <span class="c-var">$table</span>) {
    <span class="c-var">$table</span>-><span class="c-fn">id</span>();
    <span class="c-var">$table</span>-><span class="c-fn">string</span>(<span class="c-str">'name'</span>)-><span class="c-fn">unique</span>();
    <span class="c-var">$table</span>-><span class="c-fn">string</span>(<span class="c-str">'description'</span>)-><span class="c-fn">nullable</span>();
    <span class="c-var">$table</span>-><span class="c-fn">timestamps</span>();
});

<span class="c-type">Schema</span>::<span class="c-fn">create</span>(<span class="c-str">'role_user'</span>, <span class="c-key">function</span> (<span class="c-type">Blueprint</span> <span class="c-var">$table</span>) {
    <span class="c-var">$table</span>-><span class="c-fn">id</span>();
    <span class="c-var">$table</span>-><span class="c-fn">foreignId</span>(<span class="c-str">'user_id'</span>)-><span class="c-fn">constrained</span>()-><span class="c-fn">cascadeOnDelete</span>();
    <span class="c-var">$table</span>-><span class="c-fn">foreignId</span>(<span class="c-str">'role_id'</span>)-><span class="c-fn">constrained</span>()-><span class="c-fn">cascadeOnDelete</span>();
    <span class="c-var">$table</span>-><span class="c-fn">foreignId</span>(<span class="c-str">'granted_by_user_id'</span>)-><span class="c-fn">constrained</span>(<span class="c-str">'users'</span>);
    <span class="c-var">$table</span>-><span class="c-fn">timestamp</span>(<span class="c-str">'expires_at'</span>)-><span class="c-fn">nullable</span>();
    <span class="c-var">$table</span>-><span class="c-fn">timestamps</span>();
    <span class="c-var">$table</span>-><span class="c-fn">unique</span>([<span class="c-str">'user_id'</span>, <span class="c-str">'role_id'</span>]);
});
</code></pre>

    <p class="text">Pivot-модель с инкапсулированной доменной логикой:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">RoleAssignment</span> <span class="c-key">extends</span> <span class="c-type">Pivot</span>
{
    <span class="c-key">protected</span> <span class="c-var">$table</span> = <span class="c-str">'role_user'</span>;
    <span class="c-key">public</span> <span class="c-var">$incrementing</span> = <span class="c-key">true</span>;

    <span class="c-key">protected</span> <span class="c-var">$casts</span> = [
        <span class="c-str">'expires_at'</span> =&gt; <span class="c-str">'datetime'</span>,
    ];

    <span class="c-key">public function</span> <span class="c-fn">isActive</span>(): <span class="c-key">bool</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-var">expires_at</span> === <span class="c-key">null</span>
            || <span class="c-var">$this</span>-><span class="c-var">expires_at</span>-><span class="c-fn">isFuture</span>();
    }

    <span class="c-key">public function</span> <span class="c-fn">grantedBy</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsTo</span>(<span class="c-type">User</span>::<span class="c-key">class</span>, <span class="c-str">'granted_by_user_id'</span>);
    }
}
</code></pre>

    <p class="text">Объявления отношений на основных моделях:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-comment">// Все назначения, в том числе истёкшие — для аудита.</span>
    <span class="c-key">public function</span> <span class="c-fn">roles</span>(): <span class="c-type">BelongsToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsToMany</span>(<span class="c-type">Role</span>::<span class="c-key">class</span>)
            -><span class="c-fn">using</span>(<span class="c-type">RoleAssignment</span>::<span class="c-key">class</span>)
            -><span class="c-fn">withPivot</span>([<span class="c-str">'id'</span>, <span class="c-str">'expires_at'</span>, <span class="c-str">'granted_by_user_id'</span>])
            -><span class="c-fn">withTimestamps</span>();
    }

    <span class="c-comment">// Только действующие роли — для авторизации.</span>
    <span class="c-key">public function</span> <span class="c-fn">activeRoles</span>(): <span class="c-type">BelongsToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">roles</span>()-><span class="c-fn">where</span>(<span class="c-key">function</span> (<span class="c-var">$q</span>) {
            <span class="c-var">$q</span>-><span class="c-fn">whereNull</span>(<span class="c-str">'role_user.expires_at'</span>)
              -><span class="c-fn">orWhere</span>(<span class="c-str">'role_user.expires_at'</span>, <span class="c-str">'&gt;'</span>, <span class="c-fn">now</span>());
        });
    }
}
</code></pre>

    <p class="text">Типовые операции и контексты их применения:</p>
<pre><code><span class="c-comment">// 1. Выдача роли с указанием срока и автора назначения.</span>
<span class="c-var">$user</span>-><span class="c-fn">roles</span>()-><span class="c-fn">attach</span>(<span class="c-var">$adminRoleId</span>, [
    <span class="c-str">'expires_at'</span> =&gt; <span class="c-fn">now</span>()-><span class="c-fn">addYear</span>(),
    <span class="c-str">'granted_by_user_id'</span> =&gt; <span class="c-fn">auth</span>()-><span class="c-fn">id</span>(),
]);

<span class="c-comment">// 2. Замена набора ролей пользователя в рамках обновления профиля админом.</span>
<span class="c-comment">//    Каждая запись синхронизации получает одного и того же автора.</span>
<span class="c-var">$user</span>-><span class="c-fn">roles</span>()-><span class="c-fn">syncWithPivotValues</span>(
    <span class="c-var">$request</span>-><span class="c-fn">input</span>(<span class="c-str">'role_ids'</span>, []),
    [<span class="c-str">'granted_by_user_id'</span> =&gt; <span class="c-fn">auth</span>()-><span class="c-fn">id</span>()]
);

<span class="c-comment">// 3. Продление срока действия роли без создания новой записи.</span>
<span class="c-var">$user</span>-><span class="c-fn">roles</span>()-><span class="c-fn">updateExistingPivot</span>(<span class="c-var">$roleId</span>, [
    <span class="c-str">'expires_at'</span> =&gt; <span class="c-fn">now</span>()-><span class="c-fn">addMonths</span>(<span class="c-num">6</span>),
]);

<span class="c-comment">// 4. Проверка прав в middleware или политике.</span>
<span class="c-key">public function</span> <span class="c-fn">hasRole</span>(<span class="c-key">string</span> <span class="c-var">$name</span>): <span class="c-key">bool</span>
{
    <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">activeRoles</span>()-><span class="c-fn">where</span>(<span class="c-str">'name'</span>, <span class="c-var">$name</span>)-><span class="c-fn">exists</span>();
}

<span class="c-comment">// 5. Журнал назначений конкретной роли с авторами и сроками.</span>
<span class="c-var">$history</span> = <span class="c-var">$user</span>-><span class="c-fn">roles</span>()
    -><span class="c-fn">with</span>(<span class="c-str">'pivot.grantedBy'</span>)
    -><span class="c-fn">orderByPivot</span>(<span class="c-str">'created_at'</span>, <span class="c-str">'desc'</span>)
    -><span class="c-fn">get</span>();

<span class="c-comment">// 6. Запланированная очистка истёкших назначений из таблицы.</span>
<span class="c-comment">//    Выполняется в Artisan-команде по расписанию.</span>
<span class="c-type">DB</span>::<span class="c-fn">table</span>(<span class="c-str">'role_user'</span>)
    -><span class="c-fn">whereNotNull</span>(<span class="c-str">'expires_at'</span>)
    -><span class="c-fn">where</span>(<span class="c-str">'expires_at'</span>, <span class="c-str">'&lt;'</span>, <span class="c-fn">now</span>()-><span class="c-fn">subMonth</span>())
    -><span class="c-fn">delete</span>();
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. Семантика <code>sync</code> при пустом массиве.</strong> Вызов <code>$user-&gt;roles()-&gt;sync([])</code> приводит к удалению всех связей пользователя, поскольку метод приводит набор к указанному, а указанный набор пуст. Для добавления к существующему набору без удаления используется <code>syncWithoutDetaching</code>.
    </div>

    <div class="pitfall">
      <strong>2. <code>attach</code> не предотвращает дублирование.</strong> Повторный вызов <code>attach($id)</code> с тем же идентификатором создаёт ещё одну строку в pivot-таблице. Если повторение недопустимо, наложите уникальный составной индекс на пару внешних ключей и используйте <code>syncWithoutDetaching</code> вместо <code>attach</code>.
    </div>

    <div class="pitfall">
      <strong>3. <code>withTimestamps()</code> требуется явно.</strong> Колонки <code>created_at</code> и <code>updated_at</code> в pivot-таблице не обновляются автоматически &mdash; необходимо вызвать <code>withTimestamps()</code> в объявлении relation. Без этого временные метки останутся равными значениям, проставленным при первой вставке.
    </div>

    <div class="pitfall">
      <strong>4. Доступ к pivot из стандартной коллекции.</strong> Свойство <code>pivot</code> присутствует только на моделях, полученных через relation. При загрузке связанной модели напрямую (<code>Role::find($id)</code>) обращение к <code>$role-&gt;pivot</code> вернёт <code>null</code>. Это естественно: вне контекста конкретного пользователя у роли нет «своих» pivot-данных.
    </div>

    <div class="pitfall">
      <strong>5. Pivot-модель и события.</strong> По умолчанию класс <code>Pivot</code> не вызывает события Eloquent (<code>created</code>, <code>updated</code>). Для их активации необходимо переопределить свойство <code>public $incrementing = true</code> и обращаться к pivot через <code>$role-&gt;pivot-&gt;save()</code>, а не через методы <code>attach</code>/<code>sync</code>, работающие на уровне Query Builder.
    </div>

    <div class="pitfall">
      <strong>6. Полиморфные pivot-модели.</strong> Для отношений <code>morphToMany</code> pivot-модель должна наследовать <code>MorphPivot</code> вместо <code>Pivot</code>. Использование обычного <code>Pivot</code> приведёт к отсутствию поля <code>{name}_type</code> в результатах и неверной маршрутизации запросов.
    </div>

    <div class="pitfall">
      <strong>7. Сортировка по полю pivot.</strong> Прямое использование <code>orderBy('expires_at')</code> приведёт к неоднозначности имени колонки. Корректно использовать либо метод-обёртку <code>orderByPivot('expires_at')</code>, либо квалифицированное имя с указанием таблицы: <code>orderBy('role_user.expires_at')</code>.
    </div>

    <div class="pitfall">
      <strong>8. Каскадное удаление и pivot.</strong> При удалении одной из связываемых моделей записи pivot-таблицы должны удаляться внешним ключом базы данных (<code>cascadeOnDelete</code>). Опора на наблюдатели Eloquent ненадёжна: bulk-удаления и прямые SQL-запросы их не вызывают, оставляя «висящие» pivot-записи.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     RELATIONS — HAS THROUGH
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-relations-through" class="section">
  <div class="section-title">hasOneThrough и hasManyThrough</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Отношения <code>hasOneThrough</code> и <code>hasManyThrough</code> описывают транзитивный обход графа моделей через одну промежуточную сущность. Они применяются, когда между исходной и конечной таблицами отсутствует прямая связь, но существует посредник, через которого связь однозначно прослеживается.</p>
    <p class="text">Альтернативный способ получить тот же набор данных &mdash; последовательно загрузить промежуточные модели и затем обратиться к их связям. Такой подход порождает либо проблему N+1, либо требует ручной агрегации идентификаторов и составления отдельного запроса. Декларация <code>hasManyThrough</code> сводит весь обход к одному SQL-запросу с JOIN.</p>
    <p class="text">Принципиальное ограничение метода &mdash; глубина цепочки. Стандартный Eloquent поддерживает ровно одну промежуточную модель. Для более длинных цепочек (например, <code>Country</code> &mdash; <code>Region</code> &mdash; <code>City</code> &mdash; <code>Hotel</code>) применяются либо ручной JOIN, либо специализированные пакеты вроде <code>staudenmeir/eloquent-has-many-deep</code>.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Компоненты механизма</div>

    <div class="card">
      <h3>Сигнатура и параметры</h3>
      <p class="text">Оба метода принимают одинаковый набор аргументов. Большинство значений выводятся Eloquent из соглашений об именах, однако в случае нестандартных схем все шесть параметров можно указать явно.</p>
<pre><code><span class="c-var">$this</span>-><span class="c-fn">hasManyThrough</span>(
    <span class="c-type">Post</span>::<span class="c-key">class</span>,          <span class="c-comment">// 1. Конечная (target) модель</span>
    <span class="c-type">User</span>::<span class="c-key">class</span>,          <span class="c-comment">// 2. Промежуточная (through) модель</span>
    <span class="c-str">'country_id'</span>,           <span class="c-comment">// 3. FK на промежуточной таблице, ссылается на текущую</span>
    <span class="c-str">'user_id'</span>,              <span class="c-comment">// 4. FK на конечной таблице, ссылается на промежуточную</span>
    <span class="c-str">'id'</span>,                   <span class="c-comment">// 5. Локальный ключ текущей модели</span>
    <span class="c-str">'id'</span>                    <span class="c-comment">// 6. Локальный ключ промежуточной модели</span>
);
</code></pre>
      <p class="text">Значения параметров &mdash; это имена колонок, участвующих в JOIN. Структура запроса от них напрямую зависит, поэтому имеет смысл разобрать на конкретной схеме, какая колонка какой роли соответствует.</p>
    </div>

    <div class="card">
      <h3>Принцип работы: разбор по схеме</h3>
      <p class="text">Рассмотрим классическую трёхзвенную схему: страны, пользователи в каждой стране, посты, написанные пользователями.</p>
<pre><code><span class="c-comment">// Структура таблиц</span>
countries: id, name
users:     id, country_id, name
posts:     id, user_id, title

<span class="c-comment">// Объявление в Country</span>
<span class="c-key">class</span> <span class="c-type">Country</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">posts</span>(): <span class="c-type">HasManyThrough</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasManyThrough</span>(<span class="c-type">Post</span>::<span class="c-key">class</span>, <span class="c-type">User</span>::<span class="c-key">class</span>);
    }
}
</code></pre>
      <p class="text">Поскольку имена полей соответствуют соглашениям (<code>country_id</code> на промежуточной, <code>user_id</code> на конечной), параметры можно опустить. SQL, генерируемый при обращении <code>$country-&gt;posts</code>:</p>
      <div class="diagram">SELECT posts.*, users.country_id AS laravel_through_key
FROM posts
INNER JOIN users ON posts.user_id = users.id
WHERE users.country_id = ?</div>
      <p class="text">Дополнительная колонка <code>laravel_through_key</code> используется внутренне при eager loading для группировки результатов по идентификатору исходной модели.</p>
    </div>

    <div class="card">
      <h3>hasOneThrough</h3>
      <p class="text">Идентичен <code>hasManyThrough</code> по сигнатуре, но возвращает единственную запись или <code>null</code>. Применяется, когда транзитивная связь логически однозначна или ограничена дополнительным условием.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">Country</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-comment">// Профиль главного модератора страны.</span>
    <span class="c-comment">// Country → User (с ролью moderator) → Profile</span>
    <span class="c-key">public function</span> <span class="c-fn">moderatorProfile</span>(): <span class="c-type">HasOneThrough</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasOneThrough</span>(<span class="c-type">Profile</span>::<span class="c-key">class</span>, <span class="c-type">User</span>::<span class="c-key">class</span>)
            -><span class="c-fn">where</span>(<span class="c-str">'users.role'</span>, <span class="c-str">'moderator'</span>);
    }
}

<span class="c-var">$country</span>-><span class="c-var">moderatorProfile</span>;  <span class="c-comment">// Profile или null</span>
</code></pre>
    </div>

    <div class="card">
      <h3>Сравнение с whereHas</h3>
      <p class="text">Оба механизма работают с цепочкой моделей, но решают принципиально разные задачи и возвращают записи разной природы. Их следует чётко различать.</p>
      <table class="data-table">
        <tr><th>Критерий</th><th><code>hasManyThrough</code></th><th><code>whereHas</code></th></tr>
        <tr><td>Возвращаемая сущность</td><td>Конечная модель цепочки (Post)</td><td>Исходная модель (Country)</td></tr>
        <tr><td>Постановка задачи</td><td>«Получить все посты пользователей данной страны»</td><td>«Получить страны, в которых есть пользователи с постами»</td></tr>
        <tr><td>SQL-конструкция</td><td>JOIN промежуточной и конечной таблиц</td><td>Подзапрос с EXISTS</td></tr>
        <tr><td>Где объявляется</td><td>Метод relation в исходной модели</td><td>Произвольный запрос в любой модели</td></tr>
      </table>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: статистика проектной платформы</div>

    <p class="text">Рассмотрим платформу управления проектами, где организация (<code>Organization</code>) содержит команды (<code>Team</code>), а каждая команда выполняет задачи (<code>Task</code>). Требуется получать сводные данные на уровне организации без последовательного обхода команд.</p>

    <p class="text">Схема данных:</p>
<pre><code>organizations: id, name, plan
teams:         id, organization_id, name, leader_id
tasks:         id, team_id, title, status, completed_at
</code></pre>

    <p class="text">Объявления отношений:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">Organization</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">teams</span>(): <span class="c-type">HasMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasMany</span>(<span class="c-type">Team</span>::<span class="c-key">class</span>);
    }

    <span class="c-comment">// Все задачи всех команд организации одним запросом.</span>
    <span class="c-key">public function</span> <span class="c-fn">tasks</span>(): <span class="c-type">HasManyThrough</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasManyThrough</span>(<span class="c-type">Task</span>::<span class="c-key">class</span>, <span class="c-type">Team</span>::<span class="c-key">class</span>);
    }

    <span class="c-comment">// Завершённые задачи — с дополнительным условием в той же relation.</span>
    <span class="c-key">public function</span> <span class="c-fn">completedTasks</span>(): <span class="c-type">HasManyThrough</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasManyThrough</span>(<span class="c-type">Task</span>::<span class="c-key">class</span>, <span class="c-type">Team</span>::<span class="c-key">class</span>)
            -><span class="c-fn">whereNotNull</span>(<span class="c-str">'tasks.completed_at'</span>);
    }
}

<span class="c-key">class</span> <span class="c-type">Team</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">organization</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsTo</span>(<span class="c-type">Organization</span>::<span class="c-key">class</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">tasks</span>(): <span class="c-type">HasMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasMany</span>(<span class="c-type">Task</span>::<span class="c-key">class</span>);
    }
}
</code></pre>

    <p class="text">Типовые операции и контексты их применения:</p>
<pre><code><span class="c-comment">// 1. Общее число задач организации для шапки дашборда.</span>
<span class="c-comment">//    Один SQL вместо обхода всех команд.</span>
<span class="c-var">$totalTasks</span> = <span class="c-var">$organization</span>-><span class="c-fn">tasks</span>()-><span class="c-fn">count</span>();

<span class="c-comment">// 2. Список просроченных задач для письма-уведомления администратору.</span>
<span class="c-var">$overdue</span> = <span class="c-var">$organization</span>-><span class="c-fn">tasks</span>()
    -><span class="c-fn">where</span>(<span class="c-str">'tasks.status'</span>, <span class="c-str">'in_progress'</span>)
    -><span class="c-fn">where</span>(<span class="c-str">'tasks.due_at'</span>, <span class="c-str">'&lt;'</span>, <span class="c-fn">now</span>())
    -><span class="c-fn">get</span>();

<span class="c-comment">// 3. Eager loading в выборке организаций для админ-панели.</span>
<span class="c-comment">//    withCount по through-связи работает аналогично hasMany.</span>
<span class="c-var">$organizations</span> = <span class="c-type">Organization</span>::<span class="c-fn">withCount</span>([<span class="c-str">'tasks'</span>, <span class="c-str">'completedTasks'</span>])
    -><span class="c-fn">orderByDesc</span>(<span class="c-str">'tasks_count'</span>)
    -><span class="c-fn">get</span>();

<span class="c-key">foreach</span> (<span class="c-var">$organizations</span> <span class="c-key">as</span> <span class="c-var">$org</span>) {
    <span class="c-var">$percent</span> = <span class="c-var">$org</span>-><span class="c-var">tasks_count</span> &gt; <span class="c-num">0</span>
        ? <span class="c-fn">round</span>(<span class="c-var">$org</span>-><span class="c-var">completed_tasks_count</span> / <span class="c-var">$org</span>-><span class="c-var">tasks_count</span> * <span class="c-num">100</span>)
        : <span class="c-num">0</span>;
}

<span class="c-comment">// 4. Поиск задачи с проверкой принадлежности организации текущего пользователя.</span>
<span class="c-comment">//    Используется в политике доступа.</span>
<span class="c-key">public function</span> <span class="c-fn">view</span>(<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-type">Task</span> <span class="c-var">$task</span>): <span class="c-key">bool</span>
{
    <span class="c-key">return</span> <span class="c-var">$user</span>-><span class="c-var">organization</span>-><span class="c-fn">tasks</span>()
        -><span class="c-fn">whereKey</span>(<span class="c-var">$task</span>-><span class="c-var">id</span>)
        -><span class="c-fn">exists</span>();
}

<span class="c-comment">// 5. Сравнение с whereHas: выбрать организации, в которых есть хотя бы одна</span>
<span class="c-comment">//    задача со статусом &laquo;blocked&raquo;. Возвращает Organization, а не Task.</span>
<span class="c-var">$blockedOrgs</span> = <span class="c-type">Organization</span>::<span class="c-fn">whereHas</span>(<span class="c-str">'tasks'</span>, <span class="c-key">function</span> (<span class="c-var">$q</span>) {
    <span class="c-var">$q</span>-><span class="c-fn">where</span>(<span class="c-str">'tasks.status'</span>, <span class="c-str">'blocked'</span>);
})-><span class="c-fn">get</span>();
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. Ограничение глубины цепочки.</strong> Метод поддерживает ровно одну промежуточную модель. Для цепочек с двумя и более посредниками (<code>Country</code> &mdash; <code>Region</code> &mdash; <code>City</code> &mdash; <code>Hotel</code>) штатное решение отсутствует. Альтернативы: ручной запрос с JOIN, последовательная цепочка <code>hasManyThrough</code> через дополнительные relation на промежуточных моделях, либо пакет <code>staudenmeir/eloquent-has-many-deep</code>.
    </div>

    <div class="pitfall">
      <strong>2. Неоднозначность имён колонок.</strong> При добавлении условий (<code>where</code>, <code>orderBy</code>) необходимо указывать имя таблицы явно: <code>where('tasks.status', 'completed')</code>, иначе СУБД может вернуть ошибку <code>ambiguous column</code> либо применить условие к промежуточной таблице.
    </div>

    <div class="pitfall">
      <strong>3. Soft Deletes на промежуточной модели.</strong> Если промежуточная модель использует <code>SoftDeletes</code>, <code>hasManyThrough</code> по умолчанию не учитывает её удалённые записи только в том случае, если глобальный scope активен. При прямом построении SQL через JOIN такая фильтрация не применяется. Решение &mdash; явно дополнить условие <code>whereNull('teams.deleted_at')</code>.
    </div>

    <div class="pitfall">
      <strong>4. <code>hasOneThrough</code> и упорядочивание.</strong> Метод возвращает первую запись, найденную базой данных, без явного <code>ORDER BY</code>. Если необходим конкретный экземпляр (например, главный модератор, самый ранний и т. п.), сортировку нужно задавать явно: <code>hasOneThrough(...)-&gt;latest('users.created_at')</code>.
    </div>

    <div class="pitfall">
      <strong>5. Производительность на больших наборах.</strong> Транзитивный JOIN порождает запросы, потенциально обходящие миллионы записей в промежуточной таблице. Для конечных таблиц с высокой кардинальностью имеет смысл добавить покрывающие индексы на колонки FK, либо использовать <code>chunkById</code> при обходе результатов.
    </div>

    <div class="pitfall">
      <strong>6. <code>withCount</code> по through-связи.</strong> Работает аналогично обычным relation, но генерирует подзапрос с двумя JOIN, что заметно дороже плоского <code>COUNT</code>. Для часто отображаемых счётчиков рассмотрите денормализацию: денормализованное поле <code>tasks_count</code> на <code>Organization</code> с обновлением через event-слушатели.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     RELATIONS — POLYMORPHIC
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-relations-poly" class="section">
  <div class="section-title">Polymorphic relations</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Полиморфные отношения позволяют единственной таблице обслуживать связи с несколькими различными моделями. В отличие от обычной связи, где внешний ключ ссылается на одну конкретную таблицу, полиморфная связь хранит дополнительную колонку с именем класса родителя. Это даёт возможность сохранить одну запись (например, комментарий или лайк), не привязываясь жёстко к одному типу владельца.</p>
    <p class="text">Альтернативой полиморфному подходу было бы создание отдельных таблиц для каждого типа связи: <code>post_comments</code>, <code>photo_comments</code>, <code>video_comments</code>. Такой подход приводит к дублированию схемы, тройной реализации одних и тех же бизнес-операций (создание, валидация, удаление, отображение) и сложной агрегации при выводе универсальных лент.</p>
    <p class="text">Полиморфизм реализуется парой колонок: <code>{name}_type</code> хранит имя класса родителя (например, <code>App\Models\Post</code>), а <code>{name}_id</code> &mdash; его идентификатор. Eloquent на основе значения <code>_type</code> определяет, в какой таблице искать запись, и инстанцирует соответствующую модель.</p>
    <p class="text">Метод применяется в системах комментариев, отметок «нравится», вложений, изображений-обложек, тегов, аудит-логов и любых сценариях, где одна семантика связи распространяется на разнородные сущности.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Компоненты механизма</div>

    <div class="card">
      <h3>Схема таблицы и хелпер <code>morphs()</code></h3>
      <p class="text">Стандартная полиморфная таблица содержит две дополнительные колонки. Хелпер <code>morphs()</code> в миграции создаёт пару полей и автоматически добавляет составной индекс <code>(name_type, name_id)</code>, необходимый для эффективной выборки.</p>
<pre><code><span class="c-type">Schema</span>::<span class="c-fn">create</span>(<span class="c-str">'comments'</span>, <span class="c-key">function</span> (<span class="c-type">Blueprint</span> <span class="c-var">$table</span>) {
    <span class="c-var">$table</span>-><span class="c-fn">id</span>();
    <span class="c-var">$table</span>-><span class="c-fn">foreignId</span>(<span class="c-str">'user_id'</span>)-><span class="c-fn">constrained</span>();
    <span class="c-var">$table</span>-><span class="c-fn">text</span>(<span class="c-str">'body'</span>);
    <span class="c-var">$table</span>-><span class="c-fn">morphs</span>(<span class="c-str">'commentable'</span>);
    <span class="c-comment">// эквивалентно:</span>
    <span class="c-comment">//   $table->string('commentable_type');</span>
    <span class="c-comment">//   $table->unsignedBigInteger('commentable_id');</span>
    <span class="c-comment">//   $table->index(['commentable_type', 'commentable_id']);</span>
    <span class="c-var">$table</span>-><span class="c-fn">timestamps</span>();
});
</code></pre>
      <p class="text">Содержимое таблицы после нескольких вставок:</p>
      <div class="diagram">id | user_id | body  | commentable_type     | commentable_id
---|---------|-------|----------------------|----------------
 1 |       5 | hi    | App\Models\Post      |              5
 2 |       3 | nice  | App\Models\Photo     |             12
 3 |      11 | wow   | App\Models\Video     |              3</div>
      <p class="text">Если предполагается использование UUID в качестве первичных ключей, вместо <code>morphs()</code> применяется <code>uuidMorphs()</code> или <code>ulidMorphs()</code>. Для допущения <code>NULL</code> в обеих колонках существует <code>nullableMorphs()</code>.</p>
    </div>

    <div class="card">
      <h3>Стороны отношения: <code>morphTo</code></h3>
      <p class="text">Метод <code>morphTo()</code> объявляется на модели, в таблице которой расположены парные колонки <code>{name}_type</code> и <code>{name}_id</code>. При обращении к relation Eloquent читает значение <code>_type</code>, разрешает его в имя класса и выполняет SELECT в соответствующую таблицу.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">Comment</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">commentable</span>(): <span class="c-type">MorphTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphTo</span>();
    }

    <span class="c-key">public function</span> <span class="c-fn">author</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsTo</span>(<span class="c-type">User</span>::<span class="c-key">class</span>, <span class="c-str">'user_id'</span>);
    }
}

<span class="c-comment">// Eloquent определит конкретный класс родителя автоматически.</span>
<span class="c-var">$comment</span> = <span class="c-type">Comment</span>::<span class="c-fn">find</span>(<span class="c-num">1</span>);
<span class="c-var">$parent</span> = <span class="c-var">$comment</span>-><span class="c-var">commentable</span>;
<span class="c-comment">// $parent instanceof Post / Photo / Video</span>
</code></pre>
    </div>

    <div class="card">
      <h3>Стороны отношения: <code>morphOne</code> и <code>morphMany</code></h3>
      <p class="text">На каждой родительской модели объявляется свой метод связи. Вторым параметром передаётся <strong>имя morph-связи</strong> (общий префикс пары колонок) &mdash; именно его Eloquent использует для построения условий <code>WHERE</code>.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">comments</span>(): <span class="c-type">MorphMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphMany</span>(<span class="c-type">Comment</span>::<span class="c-key">class</span>, <span class="c-str">'commentable'</span>);
    }

    <span class="c-comment">// Обложка — единичная полиморфная связь.</span>
    <span class="c-key">public function</span> <span class="c-fn">cover</span>(): <span class="c-type">MorphOne</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphOne</span>(<span class="c-type">Image</span>::<span class="c-key">class</span>, <span class="c-str">'imageable'</span>);
    }
}

<span class="c-comment">// Создание связанной записи через relation: тип и id заполняются автоматически.</span>
<span class="c-var">$post</span>-><span class="c-fn">comments</span>()-><span class="c-fn">create</span>([
    <span class="c-str">'user_id'</span> =&gt; <span class="c-fn">auth</span>()-><span class="c-fn">id</span>(),
    <span class="c-str">'body'</span>    =&gt; <span class="c-str">'Текст комментария'</span>,
]);

<span class="c-comment">// SQL:</span>
<span class="c-comment">// INSERT INTO comments (user_id, body, commentable_type, commentable_id, ...)</span>
<span class="c-comment">// VALUES (?, ?, 'App\\Models\\Post', ?, ...);</span>
</code></pre>
    </div>

    <div class="card">
      <h3>Полиморфная связь «многие ко многим»: <code>morphToMany</code> и <code>morphedByMany</code></h3>
      <p class="text">Для случая, когда один тип сущности (например, <code>Tag</code>) должен связываться с несколькими разнородными моделями через общую pivot-таблицу, используется пара <code>morphToMany</code> на специализированных сторонах и <code>morphedByMany</code> на общей. Pivot-таблица содержит, помимо ключа <code>Tag</code>, два полиморфных поля.</p>
<pre><code><span class="c-type">Schema</span>::<span class="c-fn">create</span>(<span class="c-str">'taggables'</span>, <span class="c-key">function</span> (<span class="c-type">Blueprint</span> <span class="c-var">$table</span>) {
    <span class="c-var">$table</span>-><span class="c-fn">foreignId</span>(<span class="c-str">'tag_id'</span>)-><span class="c-fn">constrained</span>()-><span class="c-fn">cascadeOnDelete</span>();
    <span class="c-var">$table</span>-><span class="c-fn">morphs</span>(<span class="c-str">'taggable'</span>);
    <span class="c-var">$table</span>-><span class="c-fn">primary</span>([<span class="c-str">'tag_id'</span>, <span class="c-str">'taggable_id'</span>, <span class="c-str">'taggable_type'</span>]);
});

<span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">tags</span>(): <span class="c-type">MorphToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphToMany</span>(<span class="c-type">Tag</span>::<span class="c-key">class</span>, <span class="c-str">'taggable'</span>);
    }
}

<span class="c-key">class</span> <span class="c-type">Tag</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">posts</span>(): <span class="c-type">MorphToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphedByMany</span>(<span class="c-type">Post</span>::<span class="c-key">class</span>, <span class="c-str">'taggable'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">videos</span>(): <span class="c-type">MorphToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphedByMany</span>(<span class="c-type">Video</span>::<span class="c-key">class</span>, <span class="c-str">'taggable'</span>);
    }
}
</code></pre>
    </div>

    <div class="card">
      <h3>Morph map: устранение зависимости от FQCN</h3>
      <p class="text">По умолчанию Laravel записывает в колонку <code>{name}_type</code> полное имя класса (например, <code>App\Models\Post</code>). Это создаёт неявную привязку данных к структуре каталогов проекта: переименование класса, изменение пространства имён или перемещение в подкаталог приведёт к тому, что существующие записи перестанут разрешаться в живые модели.</p>
      <p class="text">Решение &mdash; явная регистрация морф-карты, отображающей короткие строковые алиасы на классы. После её регистрации Laravel записывает в БД алиасы, а при обращении к связи восстанавливает класс по карте. Рефакторинг кода требует только обновления карты, без миграции данных.</p>
<pre><code><span class="c-comment">// app/Providers/AppServiceProvider.php</span>
<span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Relations\Relation</span>;

<span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
{
    <span class="c-type">Relation</span>::<span class="c-fn">enforceMorphMap</span>([
        <span class="c-str">'post'</span>  =&gt; <span class="c-type">Post</span>::<span class="c-key">class</span>,
        <span class="c-str">'photo'</span> =&gt; <span class="c-type">Photo</span>::<span class="c-key">class</span>,
        <span class="c-str">'video'</span> =&gt; <span class="c-type">Video</span>::<span class="c-key">class</span>,
    ]);
}
</code></pre>
      <p class="text">Метод <code>enforceMorphMap</code> также запрещает использование классов, не объявленных в карте: попытка сохранить полиморфную запись с неучтённым типом породит исключение, что предотвращает скрытое появление «сырых» FQCN в данных.</p>
      <p class="text">Для уже работающих проектов миграция с FQCN на алиасы требует одноразовой команды, обновляющей значения в колонках <code>_type</code>:</p>
<pre><code><span class="c-type">DB</span>::<span class="c-fn">table</span>(<span class="c-str">'comments'</span>)
    -><span class="c-fn">where</span>(<span class="c-str">'commentable_type'</span>, <span class="c-str">'App\\Models\\Post'</span>)
    -><span class="c-fn">update</span>([<span class="c-str">'commentable_type'</span> =&gt; <span class="c-str">'post'</span>]);
</code></pre>
    </div>

    <div class="card">
      <h3>Eager loading и метод <code>morphWith</code></h3>
      <p class="text">При выборке коллекции записей с полиморфной связью обычное <code>with('commentable')</code> работает, но для каждой группы родительских типов Eloquent выполняет отдельный запрос. Метод <code>morphWith</code> позволяет дополнительно подгрузить вложенные relation, специфичные для конкретного типа родителя.</p>
<pre><code><span class="c-var">$comments</span> = <span class="c-type">Comment</span>::<span class="c-fn">with</span>([
    <span class="c-str">'commentable'</span> =&gt; <span class="c-key">function</span> (<span class="c-type">MorphTo</span> <span class="c-var">$morphTo</span>) {
        <span class="c-var">$morphTo</span>-><span class="c-fn">morphWith</span>([
            <span class="c-type">Post</span>::<span class="c-key">class</span>  =&gt; [<span class="c-str">'author'</span>, <span class="c-str">'tags'</span>],
            <span class="c-type">Video</span>::<span class="c-key">class</span> =&gt; [<span class="c-str">'thumbnail'</span>],
        ]);
    },
])-><span class="c-fn">get</span>();
</code></pre>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: универсальная система комментариев и реакций</div>

    <p class="text">Спроектируем универсальный модуль комментариев и реакций (likes), применимый к постам, фотографиям и видео. Помимо хранения данных, модуль должен поддерживать вложенные ответы, отображение унифицированной ленты активности пользователя и эффективную выгрузку родительских сущностей одним запросом.</p>

    <p class="text">Схема таблиц:</p>
<pre><code>posts:     id, user_id, title, body
photos:    id, user_id, url, caption
videos:    id, user_id, source_url, duration_sec

comments:  id, user_id, parent_id, body, commentable_type, commentable_id
reactions: id, user_id, kind, reactable_type, reactable_id
</code></pre>

    <p class="text">Морф-карта в провайдере (обязательно):</p>
<pre><code><span class="c-comment">// app/Providers/AppServiceProvider.php</span>
<span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
{
    <span class="c-type">Relation</span>::<span class="c-fn">enforceMorphMap</span>([
        <span class="c-str">'post'</span>  =&gt; <span class="c-type">Post</span>::<span class="c-key">class</span>,
        <span class="c-str">'photo'</span> =&gt; <span class="c-type">Photo</span>::<span class="c-key">class</span>,
        <span class="c-str">'video'</span> =&gt; <span class="c-type">Video</span>::<span class="c-key">class</span>,
    ]);
}
</code></pre>

    <p class="text">Трейт, инкапсулирующий объявление полиморфных связей для упрощения подключения к нескольким моделям:</p>
<pre><code><span class="c-key">trait</span> <span class="c-type">HasCommentsAndReactions</span>
{
    <span class="c-key">public function</span> <span class="c-fn">comments</span>(): <span class="c-type">MorphMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphMany</span>(<span class="c-type">Comment</span>::<span class="c-key">class</span>, <span class="c-str">'commentable'</span>)
            -><span class="c-fn">whereNull</span>(<span class="c-str">'parent_id'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">reactions</span>(): <span class="c-type">MorphMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphMany</span>(<span class="c-type">Reaction</span>::<span class="c-key">class</span>, <span class="c-str">'reactable'</span>);
    }
}

<span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>  { <span class="c-key">use</span> <span class="c-type">HasCommentsAndReactions</span>; }
<span class="c-key">class</span> <span class="c-type">Photo</span> <span class="c-key">extends</span> <span class="c-type">Model</span> { <span class="c-key">use</span> <span class="c-type">HasCommentsAndReactions</span>; }
<span class="c-key">class</span> <span class="c-type">Video</span> <span class="c-key">extends</span> <span class="c-type">Model</span> { <span class="c-key">use</span> <span class="c-type">HasCommentsAndReactions</span>; }
</code></pre>

    <p class="text">Модель <code>Comment</code> с поддержкой вложенности и обратной связью:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">Comment</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$fillable</span> = [<span class="c-str">'user_id'</span>, <span class="c-str">'parent_id'</span>, <span class="c-str">'body'</span>];

    <span class="c-key">public function</span> <span class="c-fn">commentable</span>(): <span class="c-type">MorphTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphTo</span>();
    }

    <span class="c-key">public function</span> <span class="c-fn">author</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsTo</span>(<span class="c-type">User</span>::<span class="c-key">class</span>, <span class="c-str">'user_id'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">replies</span>(): <span class="c-type">HasMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasMany</span>(<span class="c-key">self</span>::<span class="c-key">class</span>, <span class="c-str">'parent_id'</span>);
    }
}
</code></pre>

    <p class="text">Типовые операции и их применение:</p>
<pre><code><span class="c-comment">// 1. Создание комментария к произвольной сущности через её relation.</span>
<span class="c-comment">//    commentable_type и commentable_id заполняются Eloquent автоматически.</span>
<span class="c-var">$post</span>-><span class="c-fn">comments</span>()-><span class="c-fn">create</span>([
    <span class="c-str">'user_id'</span> =&gt; <span class="c-fn">auth</span>()-><span class="c-fn">id</span>(),
    <span class="c-str">'body'</span>    =&gt; <span class="c-var">$request</span>-><span class="c-fn">input</span>(<span class="c-str">'body'</span>),
]);

<span class="c-comment">// 2. Дерево комментариев с eager loading вложенных ответов.</span>
<span class="c-var">$tree</span> = <span class="c-var">$post</span>-><span class="c-fn">comments</span>()
    -><span class="c-fn">with</span>([<span class="c-str">'author'</span>, <span class="c-str">'replies.author'</span>])
    -><span class="c-fn">latest</span>()
    -><span class="c-fn">get</span>();

<span class="c-comment">// 3. Универсальная лента активности пользователя.</span>
<span class="c-comment">//    Возвращает комментарии без знания, к чему они привязаны;</span>
<span class="c-comment">//    morphWith подгружает специфичные relation для каждого типа родителя.</span>
<span class="c-var">$activity</span> = <span class="c-type">Comment</span>::<span class="c-fn">where</span>(<span class="c-str">'user_id'</span>, <span class="c-var">$user</span>-><span class="c-var">id</span>)
    -><span class="c-fn">with</span>([
        <span class="c-str">'commentable'</span> =&gt; <span class="c-key">function</span> (<span class="c-type">MorphTo</span> <span class="c-var">$q</span>) {
            <span class="c-var">$q</span>-><span class="c-fn">morphWith</span>([
                <span class="c-type">Post</span>::<span class="c-key">class</span>  =&gt; [<span class="c-str">'author'</span>],
                <span class="c-type">Video</span>::<span class="c-key">class</span> =&gt; [<span class="c-str">'author'</span>],
            ]);
        },
    ])
    -><span class="c-fn">latest</span>()
    -><span class="c-fn">paginate</span>(<span class="c-num">20</span>);

<span class="c-comment">// 4. Маршрутизация при отображении комментария: определяем URL родителя.</span>
<span class="c-key">public function</span> <span class="c-fn">parentUrl</span>(<span class="c-type">Comment</span> <span class="c-var">$comment</span>): <span class="c-key">string</span>
{
    <span class="c-key">return match</span> (<span class="c-var">$comment</span>-><span class="c-var">commentable_type</span>) {
        <span class="c-str">'post'</span>  =&gt; <span class="c-fn">route</span>(<span class="c-str">'posts.show'</span>,  <span class="c-var">$comment</span>-><span class="c-var">commentable_id</span>),
        <span class="c-str">'photo'</span> =&gt; <span class="c-fn">route</span>(<span class="c-str">'photos.show'</span>, <span class="c-var">$comment</span>-><span class="c-var">commentable_id</span>),
        <span class="c-str">'video'</span> =&gt; <span class="c-fn">route</span>(<span class="c-str">'videos.show'</span>, <span class="c-var">$comment</span>-><span class="c-var">commentable_id</span>),
    };
}

<span class="c-comment">// 5. Подсчёт числа реакций каждого типа для произвольной сущности.</span>
<span class="c-var">$counts</span> = <span class="c-var">$post</span>-><span class="c-fn">reactions</span>()
    -><span class="c-fn">select</span>(<span class="c-str">'kind'</span>, <span class="c-type">DB</span>::<span class="c-fn">raw</span>(<span class="c-str">'COUNT(*) as total'</span>))
    -><span class="c-fn">groupBy</span>(<span class="c-str">'kind'</span>)
    -><span class="c-fn">pluck</span>(<span class="c-str">'total'</span>, <span class="c-str">'kind'</span>);

<span class="c-comment">// 6. Удаление всех комментариев и реакций при удалении родителя.</span>
<span class="c-comment">//    Реализуется через observer, поскольку morphMany не поддерживает</span>
<span class="c-comment">//    каскадное удаление на уровне БД (там нет FK).</span>
<span class="c-key">class</span> <span class="c-type">CleanupCommentsObserver</span>
{
    <span class="c-key">public function</span> <span class="c-fn">deleting</span>(<span class="c-type">Model</span> <span class="c-var">$model</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$model</span>-><span class="c-fn">comments</span>()-><span class="c-fn">delete</span>();
        <span class="c-var">$model</span>-><span class="c-fn">reactions</span>()-><span class="c-fn">delete</span>();
    }
}
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. Хранение FQCN без морф-карты.</strong> Это наиболее распространённая ошибка проектирования. По умолчанию в колонке <code>_type</code> сохраняется полное имя класса. Любое изменение пространства имён, переименование или перенос файла приводит к рассинхронизации между БД и кодом, при этом ошибка проявляется не сразу &mdash; только при попытке разрешить релейшен на старых записях. Регистрация <code>Relation::enforceMorphMap()</code> должна быть выполнена в проекте до первой работы с полиморфными моделями.
    </div>

    <div class="pitfall">
      <strong>2. Отсутствие внешних ключей на уровне БД.</strong> Полиморфные колонки не образуют FK, поскольку ссылаются на разные таблицы. Это означает: каскадное удаление на уровне СУБД невозможно, целостность данных лежит на коде. Удаление родительской модели без обработки в observer (или без явного <code>delete()</code> по связи) оставляет «висящие» записи, ссылающиеся в никуда.
    </div>

    <div class="pitfall">
      <strong>3. Стоимость запросов <code>morphTo</code>.</strong> В отличие от обычного <code>belongsTo</code>, который выполняет один SELECT, <code>morphTo</code> вынужден сгруппировать загружаемые записи по типу и выполнить отдельный SELECT для каждого. При выборках, охватывающих много разнородных родителей, это даёт N+M запросов вместо одного. Метод <code>morphWith</code> позволяет одновременно подгрузить вложенные relation, но количество запросов всё равно пропорционально числу типов.
    </div>

    <div class="pitfall">
      <strong>4. Индекс на пару колонок обязателен.</strong> Запросы вида <code>WHERE commentable_type = ? AND commentable_id = ?</code> без составного индекса деградируют до полного сканирования. Хелпер <code>morphs()</code> создаёт нужный индекс автоматически; при ручном объявлении пары колонок индекс необходимо добавить явно.
    </div>

    <div class="pitfall">
      <strong>5. Уникальность в полиморфной таблице.</strong> Создание условия «один лайк на один объект от одного пользователя» требует уникального индекса на тройке колонок <code>(user_id, reactable_type, reactable_id)</code>. Простой <code>unique</code> по двум полям недостаточен.
    </div>

    <div class="pitfall">
      <strong>6. <code>morphTo</code> и удалённый класс.</strong> Если значение <code>_type</code> ссылается на класс, который больше не существует (например, после удаления модели), обращение к <code>$comment-&gt;commentable</code> породит ошибку. Безопасный обход &mdash; обернуть доступ в <code>try / catch</code> или предварительно отфильтровать выборку по списку известных типов.
    </div>

    <div class="pitfall">
      <strong>7. Глобальные scopes на полиморфной модели.</strong> Если родительская модель использует глобальные scopes (например, фильтр по тенанту), при разрешении <code>morphTo</code> Laravel применяет их к каждому из запросов. Это может неожиданно скрыть записи, если контекст scope недоступен (например, в фоновой задаче без авторизованного пользователя).
    </div>

    <div class="pitfall">
      <strong>8. Полиморфная pivot-модель.</strong> Для отношений <code>morphToMany</code> кастомная pivot-модель должна наследовать <code>Illuminate\Database\Eloquent\Relations\MorphPivot</code>, а не базовый <code>Pivot</code>. В противном случае полиморфная колонка <code>{name}_type</code> не будет учитываться при запросах, и связи окажутся неверными.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     RELATIONS — EAGER LOADING
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-relations-eager" class="section">
  <div class="section-title">Eager loading</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Eager loading &mdash; механизм предварительной загрузки связанных моделей единым набором запросов. Решает проблему N+1, возникающую при ленивом доступе к relation: когда для каждой записи родительской коллекции выполняется отдельный SELECT к таблице дочерней модели.</p>
    <p class="text">Принципиальное отличие от ленивой загрузки заключается в количестве запросов. Без eager loading выборка из ста пользователей с обращением к их профилям внутри цикла порождает 101 запрос: один на список пользователей и сто индивидуальных запросов на профили. С использованием <code>with('profile')</code> выполняются ровно два запроса: SELECT по таблице <code>users</code> и SELECT по таблице <code>profiles</code> с условием <code>WHERE user_id IN (...)</code>, после чего Eloquent распределяет полученные профили между загруженными пользователями.</p>
    <p class="text">Eloquent предоставляет несколько вариантов eager loading, различающихся моментом применения (до или после получения коллекции), полнотой загружаемых данных (записи целиком или только агрегаты) и стратегией обработки уже загруженных relation.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень методов</div>

    <div class="card">
      <h3><code>with()</code> &mdash; декларация при построении запроса</h3>
      <p class="text">Применяется на построителе запросов до вызова <code>get()</code>, <code>first()</code>, <code>paginate()</code>. Принимает имя relation, массив имён или ассоциативный массив с замыканиями для ограничения вложенных выборок. Является основным и наиболее распространённым способом.</p>
<pre><code><span class="c-comment">// Ленивый доступ — антипаттерн N+1.</span>
<span class="c-key">foreach</span> (<span class="c-type">User</span>::<span class="c-fn">all</span>() <span class="c-key">as</span> <span class="c-var">$user</span>) {
    <span class="c-fn">echo</span> <span class="c-var">$user</span>-><span class="c-var">profile</span>-><span class="c-var">bio</span>;
}
<span class="c-comment">// Итого: 1 + N запросов.</span>

<span class="c-comment">// Eager loading через with(): два запроса независимо от размера коллекции.</span>
<span class="c-key">foreach</span> (<span class="c-type">User</span>::<span class="c-fn">with</span>(<span class="c-str">'profile'</span>)-><span class="c-fn">get</span>() <span class="c-key">as</span> <span class="c-var">$user</span>) {
    <span class="c-fn">echo</span> <span class="c-var">$user</span>-><span class="c-var">profile</span>-><span class="c-var">bio</span>;
}
<span class="c-comment">// SQL:</span>
<span class="c-comment">//   SELECT * FROM users;</span>
<span class="c-comment">//   SELECT * FROM profiles WHERE user_id IN (1, 2, 3, ...);</span>
</code></pre>
    </div>

    <div class="card">
      <h3>Вложенные relation и точечная нотация</h3>
      <p class="text">Eloquent поддерживает произвольную глубину вложения через точечный синтаксис. Каждый сегмент пути порождает отдельный SELECT-запрос к соответствующей таблице.</p>
<pre><code><span class="c-comment">// Загрузка трёх уровней связей одной декларацией.</span>
<span class="c-type">User</span>::<span class="c-fn">with</span>(<span class="c-str">'posts.comments.author'</span>)-><span class="c-fn">get</span>();

<span class="c-comment">// SQL:</span>
<span class="c-comment">//   SELECT * FROM users;</span>
<span class="c-comment">//   SELECT * FROM posts    WHERE user_id IN (...);</span>
<span class="c-comment">//   SELECT * FROM comments WHERE post_id IN (...);</span>
<span class="c-comment">//   SELECT * FROM users    WHERE id      IN (...);  -- авторы комментариев</span>

<span class="c-comment">// Несколько независимых relation на одном уровне.</span>
<span class="c-type">Post</span>::<span class="c-fn">with</span>([<span class="c-str">'author'</span>, <span class="c-str">'tags'</span>, <span class="c-str">'comments.author'</span>])-><span class="c-fn">get</span>();
</code></pre>
    </div>

    <div class="card">
      <h3>Constrained eager loading</h3>
      <p class="text">Замыкание во втором значении массива позволяет ограничить выборку связанной модели произвольными условиями: фильтрацией, сортировкой, лимитом, вложенными relation. Все ограничения применяются на стороне БД, что критично для коллекций с большим количеством связанных записей.</p>
<pre><code><span class="c-type">User</span>::<span class="c-fn">with</span>([
    <span class="c-str">'posts'</span> =&gt; <span class="c-key">function</span> (<span class="c-type">Builder</span> <span class="c-var">$query</span>) {
        <span class="c-var">$query</span>-><span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'published'</span>)
              -><span class="c-fn">orderByDesc</span>(<span class="c-str">'published_at'</span>)
              -><span class="c-fn">limit</span>(<span class="c-num">5</span>);
    },
])-><span class="c-fn">get</span>();

<span class="c-comment">// Выборка по конкретному набору колонок снижает объём передаваемых данных.</span>
<span class="c-type">Post</span>::<span class="c-fn">with</span>(<span class="c-str">'author:id,name,avatar_url'</span>)-><span class="c-fn">get</span>();
<span class="c-comment">// SELECT id, name, avatar_url FROM users WHERE id IN (...);</span>
<span class="c-comment">// При указании списка колонок поле первичного ключа обязательно — иначе Eloquent</span>
<span class="c-comment">// не сможет сопоставить связанные записи с родителями.</span>
</code></pre>
    </div>

    <div class="card">
      <h3><code>load()</code> &mdash; eager loading после получения коллекции</h3>
      <p class="text">Применяется к уже загруженной модели или коллекции, когда необходимость в relation возникает после построения основного запроса (например, в зависимости от условия в коде, или при условном рендеринге). Выполняет ровно один дополнительный SELECT.</p>
<pre><code><span class="c-var">$users</span> = <span class="c-type">User</span>::<span class="c-fn">all</span>();

<span class="c-key">if</span> (<span class="c-var">$showProfiles</span>) {
    <span class="c-var">$users</span>-><span class="c-fn">load</span>(<span class="c-str">'profile'</span>);
}

<span class="c-comment">// load принимает тот же синтаксис что и with: вложенность, замыкания, списки колонок.</span>
<span class="c-var">$users</span>-><span class="c-fn">load</span>([
    <span class="c-str">'posts'</span> =&gt; <span class="c-key">fn</span>(<span class="c-var">$q</span>) =&gt; <span class="c-var">$q</span>-><span class="c-fn">latest</span>()-><span class="c-fn">limit</span>(<span class="c-num">10</span>),
    <span class="c-str">'roles:id,name'</span>,
]);
</code></pre>
    </div>

    <div class="card">
      <h3><code>loadMissing()</code> &mdash; идемпотентная загрузка</h3>
      <p class="text">Загружает relation только в том случае, если он ещё не был загружен ранее. Полезен в коде, где трудно отследить, какие relation уже подгружены (например, в Blade-компонентах, View Composers, методах модели).</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">summarize</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">array</span>
{
    <span class="c-var">$user</span>-><span class="c-fn">loadMissing</span>(<span class="c-str">'posts'</span>, <span class="c-str">'roles'</span>);

    <span class="c-key">return</span> [
        <span class="c-str">'posts_count'</span> =&gt; <span class="c-var">$user</span>-><span class="c-var">posts</span>-><span class="c-fn">count</span>(),
        <span class="c-str">'roles'</span>       =&gt; <span class="c-var">$user</span>-><span class="c-var">roles</span>-><span class="c-fn">pluck</span>(<span class="c-str">'name'</span>),
    ];
}
<span class="c-comment">// Если вызывающий код уже подгрузил posts через with('posts'),</span>
<span class="c-comment">// повторный запрос не выполнится.</span>
</code></pre>
    </div>

    <div class="card">
      <h3><code>withCount()</code> и <code>loadCount()</code> &mdash; подсчёт без выгрузки</h3>
      <p class="text">Возвращают количество связанных записей через коррелированный подзапрос, не загружая сами записи. Результат сохраняется в атрибуте с именем <code>{relation}_count</code>. Это оптимальный способ для отображения счётчиков в списках (число комментариев у поста, число подписчиков у канала).</p>
<pre><code><span class="c-var">$users</span> = <span class="c-type">User</span>::<span class="c-fn">withCount</span>(<span class="c-str">'posts'</span>)-><span class="c-fn">get</span>();
<span class="c-fn">echo</span> <span class="c-var">$users</span>[<span class="c-num">0</span>]-><span class="c-var">posts_count</span>;  <span class="c-comment">// 42</span>

<span class="c-comment">// Можно подсчитать одну и ту же relation с разными условиями.</span>
<span class="c-type">User</span>::<span class="c-fn">withCount</span>([
    <span class="c-str">'posts'</span>,
    <span class="c-str">'posts as published_posts_count'</span> =&gt; <span class="c-key">fn</span>(<span class="c-var">$q</span>) =&gt; <span class="c-var">$q</span>-><span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'published'</span>),
])-><span class="c-fn">get</span>();
<span class="c-comment">// → $user->posts_count и $user->published_posts_count</span>

<span class="c-comment">// На уже загруженной коллекции:</span>
<span class="c-var">$users</span>-><span class="c-fn">loadCount</span>(<span class="c-str">'posts'</span>);
</code></pre>
    </div>

    <div class="card">
      <h3>Агрегатные методы: <code>withSum</code>, <code>withAvg</code>, <code>withMin</code>, <code>withMax</code>, <code>withExists</code></h3>
      <p class="text">Семейство методов, аналогичных <code>withCount</code>, но возвращающих не количество, а агрегатные функции по полю связанной таблицы. Результат сохраняется в атрибуте <code>{relation}_{agg}_{column}</code>.</p>
<pre><code><span class="c-comment">// Сумма по полю amount у связанных orders.</span>
<span class="c-type">User</span>::<span class="c-fn">withSum</span>(<span class="c-str">'orders'</span>, <span class="c-str">'amount'</span>)-><span class="c-fn">get</span>();
<span class="c-comment">// → $user->orders_sum_amount</span>

<span class="c-comment">// Средний рейтинг комментариев.</span>
<span class="c-type">Post</span>::<span class="c-fn">withAvg</span>(<span class="c-str">'comments'</span>, <span class="c-str">'rating'</span>)-><span class="c-fn">get</span>();

<span class="c-comment">// Проверка наличия связанных записей без их загрузки.</span>
<span class="c-type">User</span>::<span class="c-fn">withExists</span>(<span class="c-str">'subscription'</span>)-><span class="c-fn">get</span>();
<span class="c-comment">// → $user->subscription_exists = true/false</span>

<span class="c-comment">// Допустимо комбинировать несколько агрегатов в одном запросе.</span>
<span class="c-type">Project</span>::<span class="c-fn">withCount</span>(<span class="c-str">'tasks'</span>)
    -><span class="c-fn">withSum</span>(<span class="c-str">'tasks'</span>, <span class="c-str">'estimated_hours'</span>)
    -><span class="c-fn">withMax</span>(<span class="c-str">'tasks'</span>, <span class="c-str">'updated_at'</span>)
    -><span class="c-fn">get</span>();
</code></pre>
    </div>

    <div class="card">
      <h3>Сводная таблица методов</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>Применяется к</th><th>Возвращает</th><th>SQL</th></tr>
        <tr><td><code>with(...)</code></td><td>Построителю запросов</td><td>Полные связанные модели</td><td>Основной + по одному на каждую relation</td></tr>
        <tr><td><code>load(...)</code></td><td>Модели или коллекции</td><td>Полные связанные модели</td><td>По одному на каждую relation</td></tr>
        <tr><td><code>loadMissing(...)</code></td><td>Модели или коллекции</td><td>Полные связанные модели</td><td>По одному, если relation не загружена</td></tr>
        <tr><td><code>withCount(...)</code></td><td>Построителю запросов</td><td>Целое число в атрибуте <code>{rel}_count</code></td><td>Подзапрос в SELECT основного запроса</td></tr>
        <tr><td><code>loadCount(...)</code></td><td>Модели или коллекции</td><td>Целое число</td><td>Отдельный запрос с GROUP BY</td></tr>
        <tr><td><code>withSum / withAvg / ...</code></td><td>Построителю запросов</td><td>Агрегат в атрибуте <code>{rel}_{agg}_{col}</code></td><td>Подзапрос в SELECT</td></tr>
        <tr><td><code>withExists(...)</code></td><td>Построителю запросов</td><td>Булев флаг</td><td>Подзапрос с EXISTS</td></tr>
      </table>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: лента блога без N+1</div>

    <p class="text">Рассмотрим типичную задачу: построить страницу-ленту с пагинацией, в которой для каждого поста отображаются заголовок, автор, число комментариев, число лайков и три первых тега. Без правильного eager loading такой шаблон легко превращается в десятки запросов на страницу.</p>

    <p class="text">Структура моделей:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">author</span>(): <span class="c-type">BelongsTo</span>     { <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsTo</span>(<span class="c-type">User</span>::<span class="c-key">class</span>, <span class="c-str">'user_id'</span>); }
    <span class="c-key">public function</span> <span class="c-fn">comments</span>(): <span class="c-type">MorphMany</span>  { <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphMany</span>(<span class="c-type">Comment</span>::<span class="c-key">class</span>, <span class="c-str">'commentable'</span>); }
    <span class="c-key">public function</span> <span class="c-fn">likes</span>(): <span class="c-type">MorphMany</span>     { <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphMany</span>(<span class="c-type">Like</span>::<span class="c-key">class</span>,    <span class="c-str">'likeable'</span>); }
    <span class="c-key">public function</span> <span class="c-fn">tags</span>(): <span class="c-type">MorphToMany</span>    { <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">morphToMany</span>(<span class="c-type">Tag</span>::<span class="c-key">class</span>,  <span class="c-str">'taggable'</span>); }
}
</code></pre>

    <p class="text">Контроллер ленты, выполняющий ровно одну выборку с eager loading и тремя агрегатами:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">FeedController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__invoke</span>(): <span class="c-type">View</span>
    {
        <span class="c-var">$posts</span> = <span class="c-type">Post</span>::<span class="c-fn">query</span>()
            -><span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'published'</span>)
            -><span class="c-fn">with</span>([
                <span class="c-str">'author:id,name,avatar_url'</span>,
                <span class="c-str">'tags'</span> =&gt; <span class="c-key">fn</span>(<span class="c-var">$q</span>) =&gt; <span class="c-var">$q</span>-><span class="c-fn">limit</span>(<span class="c-num">3</span>),
            ])
            -><span class="c-fn">withCount</span>([<span class="c-str">'comments'</span>, <span class="c-str">'likes'</span>])
            -><span class="c-fn">latest</span>(<span class="c-str">'published_at'</span>)
            -><span class="c-fn">paginate</span>(<span class="c-num">15</span>);

        <span class="c-key">return</span> <span class="c-fn">view</span>(<span class="c-str">'feed.index'</span>, <span class="c-fn">compact</span>(<span class="c-str">'posts'</span>));
    }
}
</code></pre>

    <p class="text">Полный набор SQL-запросов на одну страницу ленты &mdash; четыре запроса, независимо от числа постов:</p>
<pre><code><span class="c-comment">-- 1. Основная выборка постов с двумя коррелированными COUNT.</span>
<span class="c-key">SELECT</span> posts.*,
    (<span class="c-key">SELECT COUNT</span>(*) <span class="c-key">FROM</span> comments
     <span class="c-key">WHERE</span> comments.commentable_id = posts.id
       <span class="c-key">AND</span> comments.commentable_type = <span class="c-str">'post'</span>) <span class="c-key">AS</span> comments_count,
    (<span class="c-key">SELECT COUNT</span>(*) <span class="c-key">FROM</span> likes
     <span class="c-key">WHERE</span> likes.likeable_id = posts.id
       <span class="c-key">AND</span> likes.likeable_type = <span class="c-str">'post'</span>) <span class="c-key">AS</span> likes_count
<span class="c-key">FROM</span> posts
<span class="c-key">WHERE</span> status = <span class="c-str">'published'</span>
<span class="c-key">ORDER BY</span> published_at <span class="c-key">DESC</span>
<span class="c-key">LIMIT</span> 15 <span class="c-key">OFFSET</span> 0;

<span class="c-comment">-- 2. Авторы постов одной выборкой.</span>
<span class="c-key">SELECT</span> id, name, avatar_url <span class="c-key">FROM</span> users <span class="c-key">WHERE</span> id <span class="c-key">IN</span> (...);

<span class="c-comment">-- 3. Связи постов с тегами через polymorphic pivot.</span>
<span class="c-key">SELECT</span> tags.*, taggables.taggable_id <span class="c-key">AS</span> pivot_taggable_id
<span class="c-key">FROM</span> tags
<span class="c-key">INNER JOIN</span> taggables <span class="c-key">ON</span> taggables.tag_id = tags.id
<span class="c-key">WHERE</span> taggables.taggable_type = <span class="c-str">'post'</span>
  <span class="c-key">AND</span> taggables.taggable_id <span class="c-key">IN</span> (...);

<span class="c-comment">-- 4. SELECT COUNT(*) для пагинатора (если используется LengthAwarePaginator).</span></code></pre>

    <p class="text">При использовании Telescope или Debugbar убедитесь, что отображение страницы со 100 постами укладывается в эти четыре запроса. Любое отклонение свидетельствует о неучтённом обращении к relation в шаблоне.</p>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. Constrained eager loading не ограничивает количество записей на родителя.</strong> Конструкция <code>with(['posts' =&gt; fn($q) =&gt; $q-&gt;limit(5)])</code> применяет LIMIT к запросу в целом, а не к каждому пользователю. Для получения, например, последних пяти постов <strong>каждого</strong> пользователя стандартный Eloquent не имеет средств; применяются сторонние пакеты (<code>staudenmeir/eloquent-eager-limit</code>) или подзапросы с оконными функциями.
    </div>

    <div class="pitfall">
      <strong>2. Указание колонок без первичного ключа.</strong> При использовании синтаксиса <code>with('author:name,email')</code> необходимо включать в список первичный ключ (обычно <code>id</code>). Без него Eloquent не сможет сопоставить загруженные записи с родителями, и связь будет пустой. Корректная запись: <code>with('author:id,name,email')</code>.
    </div>

    <div class="pitfall">
      <strong>3. Неявная разница между <code>load</code> и <code>loadMissing</code>.</strong> Метод <code>load</code> выполняет запрос всегда, даже если relation уже подгружена; полученный результат заменит предыдущий. Это может неожиданно затереть данные, изменённые в памяти после первой загрузки. Для безопасной идемпотентной загрузки используйте <code>loadMissing</code>.
    </div>

    <div class="pitfall">
      <strong>4. <code>withCount</code> и привязанные условия родителя.</strong> Подзапрос <code>withCount</code> формируется в SELECT основного запроса. Если основной запрос содержит <code>WHERE</code>, добавляющий JOIN к таблице связанной модели, могут возникать неоднозначности имён колонок. Используйте квалифицированные имена: <code>where('posts.status', 'published')</code>.
    </div>

    <div class="pitfall">
      <strong>5. <code>preventLazyLoading</code> в продакшене.</strong> Метод <code>Model::preventLazyLoading()</code> в <code>AppServiceProvider</code> запрещает ленивую загрузку relation, кидая <code>LazyLoadingViolationException</code>. Это эффективная защита от N+1, но в production-окружении приведёт к падению любых пользовательских действий, для которых разработчики не предусмотрели eager loading. Рекомендуется включать только в локальной разработке: <code>Model::preventLazyLoading(! app()-&gt;isProduction())</code>.
    </div>

    <div class="pitfall">
      <strong>6. Пагинация и <code>withCount</code>.</strong> <code>paginate()</code> сам по себе выполняет дополнительный SELECT COUNT для определения общего числа записей. В сочетании с <code>withCount</code> по нескольким relation на больших таблицах это даёт ощутимую нагрузку. Если общее количество не критично (например, для бесконечной прокрутки), используйте <code>simplePaginate()</code>, не вычисляющий <code>total</code>.
    </div>

    <div class="pitfall">
      <strong>7. Eager loading и сортировка по полю связанной модели.</strong> <code>with('author')-&gt;orderBy('author.name')</code> не работает: ordering применяется к основной таблице, а связанная подгружается отдельным запросом. Для сортировки по полю связанной модели необходимо использовать JOIN: <code>Post::join('users', ...)-&gt;orderBy('users.name')</code>.
    </div>

    <div class="pitfall">
      <strong>8. Несимметричное eager loading при <code>morphTo</code>.</strong> Загрузка <code>with('commentable')</code> на коллекции комментариев порождает по одному запросу на каждый тип родителя. Если требуется дополнительно подгрузить relation специфичные для типа (например, <code>author</code> у Post, но <code>thumbnail</code> у Video), применяется <code>morphWith</code> &mdash; см. подраздел Polymorphic.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     ATTRIBUTES — CASTS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-attr-casts" class="section">
  <div class="section-title">Casts</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Casts &mdash; механизм автоматического преобразования атрибутов модели между их представлением в базе данных и в коде PHP. При чтении значения из БД Eloquent применяет преобразование «get» (например, превращает JSON-строку в массив), при записи &mdash; обратное преобразование «set» (массив сериализуется в JSON).</p>
    <p class="text">Без кастов разработчик вынужден повсеместно вручную выполнять <code>json_decode</code>, <code>Carbon::parse</code>, <code>(bool)</code>, что приводит к разбросу логики преобразований и ошибкам при их пропуске. Касты централизуют преобразование в декларации модели и гарантируют единообразие во всех точках обращения к полю.</p>
    <p class="text">Помимо встроенных типов, Eloquent позволяет создавать собственные классы кастов для произвольных value objects (Money, Color, GeoPoint, EmailAddress). Это даёт возможность хранить в БД примитивы, а в коде работать с типизированными доменными объектами, имеющими методы и инвариантами.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Виды кастов</div>

    <div class="card">
      <h3>Объявление и встроенные типы</h3>
      <p class="text">Касты декларируются в свойстве <code>$casts</code> модели. Ключ массива &mdash; имя атрибута, значение &mdash; идентификатор типа или класс кастомного каста.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$casts</span> = [
        <span class="c-comment">// Примитивные типы</span>
        <span class="c-str">'is_admin'</span>     =&gt; <span class="c-str">'boolean'</span>,
        <span class="c-str">'age'</span>          =&gt; <span class="c-str">'integer'</span>,
        <span class="c-str">'rating'</span>       =&gt; <span class="c-str">'float'</span>,
        <span class="c-str">'price'</span>        =&gt; <span class="c-str">'decimal:2'</span>,      <span class="c-comment">// строка с фикс. знаками после запятой</span>

        <span class="c-comment">// JSON-структуры</span>
        <span class="c-str">'metadata'</span>     =&gt; <span class="c-str">'array'</span>,          <span class="c-comment">// JSON → array</span>
        <span class="c-str">'options'</span>      =&gt; <span class="c-str">'json'</span>,           <span class="c-comment">// синоним для array</span>
        <span class="c-str">'tags'</span>         =&gt; <span class="c-str">'collection'</span>,     <span class="c-comment">// JSON → Support\Collection</span>
        <span class="c-str">'profile'</span>      =&gt; <span class="c-str">'object'</span>,         <span class="c-comment">// JSON → stdClass</span>

        <span class="c-comment">// Даты и время</span>
        <span class="c-str">'published_at'</span> =&gt; <span class="c-str">'datetime'</span>,       <span class="c-comment">// → Carbon</span>
        <span class="c-str">'birth_date'</span>   =&gt; <span class="c-str">'date'</span>,           <span class="c-comment">// → Carbon без времени</span>
        <span class="c-str">'expires_at'</span>   =&gt; <span class="c-str">'datetime:Y-m-d H:i'</span>, <span class="c-comment">// с форматом сериализации</span>
        <span class="c-str">'login_at'</span>     =&gt; <span class="c-str">'immutable_datetime'</span>, <span class="c-comment">// CarbonImmutable</span>
        <span class="c-str">'created_on'</span>   =&gt; <span class="c-str">'immutable_date'</span>,
        <span class="c-str">'duration'</span>    =&gt; <span class="c-str">'timestamp'</span>,       <span class="c-comment">// Unix timestamp как int</span>

        <span class="c-comment">// Изменяемые JSON-обёртки (см. ниже про AsArrayObject)</span>
        <span class="c-str">'settings'</span>    =&gt; <span class="c-type">AsArrayObject</span>::<span class="c-key">class</span>,
        <span class="c-str">'preferences'</span> =&gt; <span class="c-type">AsCollection</span>::<span class="c-key">class</span>,
        <span class="c-str">'name'</span>        =&gt; <span class="c-type">AsStringable</span>::<span class="c-key">class</span>,  <span class="c-comment">// → Stringable, методы Str::*</span>

        <span class="c-comment">// Шифрование</span>
        <span class="c-str">'api_token'</span>   =&gt; <span class="c-str">'encrypted'</span>,
        <span class="c-str">'secrets'</span>     =&gt; <span class="c-str">'encrypted:array'</span>,

        <span class="c-comment">// PHP 8.1+ enum</span>
        <span class="c-str">'status'</span>      =&gt; <span class="c-type">OrderStatus</span>::<span class="c-key">class</span>,
    ];
}
</code></pre>
      <p class="text">Начиная с Laravel 11, вместо свойства <code>$casts</code> рекомендуется использовать метод <code>casts()</code>, возвращающий массив. Это позволяет использовать вызовы статических методов и условную логику.</p>
<pre><code><span class="c-key">protected function</span> <span class="c-fn">casts</span>(): <span class="c-key">array</span>
{
    <span class="c-key">return</span> [
        <span class="c-str">'options'</span>  =&gt; <span class="c-type">AsCollection</span>::<span class="c-fn">using</span>(<span class="c-type">UserOptions</span>::<span class="c-key">class</span>),
        <span class="c-str">'password'</span> =&gt; <span class="c-str">'hashed'</span>,
    ];
}
</code></pre>
    </div>

    <div class="card">
      <h3>Изменяемые JSON-обёртки: <code>AsArrayObject</code>, <code>AsCollection</code></h3>
      <p class="text">Каст <code>array</code> возвращает обычный PHP-массив. Изменение значения внутри этого массива не отражается на атрибуте: следующее обращение к атрибуту вернёт прежнюю копию. Это распространённый источник ошибок при работе с JSON-полями.</p>
<pre><code><span class="c-comment">// При обычном array-касте:</span>
<span class="c-var">$user</span>-><span class="c-var">metadata</span>[<span class="c-str">'last_login'</span>] = <span class="c-fn">now</span>();
<span class="c-comment">// ⚠ Ошибка PHP: непрямое изменение свойства массива.</span>

<span class="c-comment">// Решение через AsArrayObject:</span>
<span class="c-key">protected</span> <span class="c-var">$casts</span> = [<span class="c-str">'metadata'</span> =&gt; <span class="c-type">AsArrayObject</span>::<span class="c-key">class</span>];

<span class="c-var">$user</span>-><span class="c-var">metadata</span>[<span class="c-str">'last_login'</span>] = <span class="c-fn">now</span>();  <span class="c-comment">// корректно: ArrayObject изменяемый</span>
<span class="c-var">$user</span>-><span class="c-fn">save</span>();
</code></pre>
      <p class="text"><code>AsCollection</code> работает аналогично, но возвращает экземпляр <code>Illuminate\Support\Collection</code>, что даёт доступ ко всем коллекционным методам (<code>map</code>, <code>filter</code>, <code>where</code>).</p>
<pre><code><span class="c-key">protected</span> <span class="c-var">$casts</span> = [<span class="c-str">'tags'</span> =&gt; <span class="c-type">AsCollection</span>::<span class="c-key">class</span>];

<span class="c-var">$post</span>-><span class="c-var">tags</span>-><span class="c-fn">push</span>(<span class="c-str">'laravel'</span>);
<span class="c-var">$visible</span> = <span class="c-var">$post</span>-><span class="c-var">tags</span>-><span class="c-fn">reject</span>(<span class="c-key">fn</span>(<span class="c-var">$t</span>) =&gt; <span class="c-fn">str_starts_with</span>(<span class="c-var">$t</span>, <span class="c-str">'_'</span>));
</code></pre>
    </div>

    <div class="card">
      <h3>Шифрование на стороне приложения</h3>
      <p class="text">Касты <code>encrypted</code>, <code>encrypted:array</code>, <code>encrypted:json</code>, <code>encrypted:collection</code>, <code>encrypted:object</code> прозрачно шифруют значение перед сохранением и расшифровывают при чтении. Используется ключ приложения <code>APP_KEY</code>, поэтому при его потере данные становятся нечитаемыми.</p>
<pre><code><span class="c-key">protected</span> <span class="c-var">$casts</span> = [
    <span class="c-str">'api_token'</span>        =&gt; <span class="c-str">'encrypted'</span>,
    <span class="c-str">'kyc_documents'</span>    =&gt; <span class="c-str">'encrypted:array'</span>,
    <span class="c-str">'private_settings'</span> =&gt; <span class="c-str">'encrypted:collection'</span>,
];

<span class="c-var">$user</span>-><span class="c-var">api_token</span> = <span class="c-str">'sk_live_...'</span>;
<span class="c-var">$user</span>-><span class="c-fn">save</span>();
<span class="c-comment">// В БД: 'eyJpdiI6IjY...' (base64 шифротекст)</span>

<span class="c-fn">echo</span> <span class="c-var">$user</span>-><span class="c-var">api_token</span>;
<span class="c-comment">// В коде: 'sk_live_...' (расшифрованное значение)</span>
</code></pre>
      <p class="text">Поскольку зашифрованное значение хранится как непрозрачная строка, поиск по такому полю через <code>WHERE</code> невозможен. Если необходима возможность поиска (например, по email), хранится отдельная hash-копия, по которой выполняется фильтрация.</p>
    </div>

    <div class="card">
      <h3>Касты enum (PHP 8.1+)</h3>
      <p class="text">Eloquent поддерживает прямой каст к PHP-перечислениям. Backed enum (с указанным типом-носителем) сохраняется в БД как его значение; pure enum &mdash; как имя case.</p>
<pre><code><span class="c-key">enum</span> <span class="c-type">OrderStatus</span>: <span class="c-key">string</span>
{
    <span class="c-key">case</span> Pending   = <span class="c-str">'pending'</span>;
    <span class="c-key">case</span> Paid      = <span class="c-str">'paid'</span>;
    <span class="c-key">case</span> Shipped   = <span class="c-str">'shipped'</span>;
    <span class="c-key">case</span> Cancelled = <span class="c-str">'cancelled'</span>;

    <span class="c-key">public function</span> <span class="c-fn">label</span>(): <span class="c-key">string</span>
    {
        <span class="c-key">return match</span>(<span class="c-var">$this</span>) {
            <span class="c-key">self</span>::<span class="c-key">Pending</span>   =&gt; <span class="c-str">'Ожидает оплаты'</span>,
            <span class="c-key">self</span>::<span class="c-key">Paid</span>      =&gt; <span class="c-str">'Оплачен'</span>,
            <span class="c-key">self</span>::<span class="c-key">Shipped</span>   =&gt; <span class="c-str">'Отправлен'</span>,
            <span class="c-key">self</span>::<span class="c-key">Cancelled</span> =&gt; <span class="c-str">'Отменён'</span>,
        };
    }
}

<span class="c-key">class</span> <span class="c-type">Order</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$casts</span> = [<span class="c-str">'status'</span> =&gt; <span class="c-type">OrderStatus</span>::<span class="c-key">class</span>];
}

<span class="c-comment">// Присвоение и сравнение типобезопасны.</span>
<span class="c-var">$order</span>-><span class="c-var">status</span> = <span class="c-type">OrderStatus</span>::<span class="c-key">Paid</span>;
<span class="c-key">if</span> (<span class="c-var">$order</span>-><span class="c-var">status</span> === <span class="c-type">OrderStatus</span>::<span class="c-key">Paid</span>) {
    <span class="c-comment">// типобезопасное сравнение, IDE подсказывает варианты</span>
}

<span class="c-comment">// Использование в Blade.</span>
<span class="c-comment">// {{ $order->status->label() }}</span>
</code></pre>
    </div>

    <div class="card">
      <h3>Кастомный каст: интерфейс <code>CastsAttributes</code></h3>
      <p class="text">Произвольный класс, реализующий <code>Illuminate\Contracts\Database\Eloquent\CastsAttributes</code>, может выступать в роли каста. Метод <code>get()</code> вызывается при чтении атрибута и должен вернуть значение в нужном виде; <code>set()</code> вызывается при записи и должен вернуть либо скалярное значение для одной колонки, либо ассоциативный массив для нескольких.</p>
      <p class="text">Реализация каста для value object Money с хранением суммы и валюты в двух отдельных колонках:</p>
<pre><code><span class="c-comment">// Value object</span>
<span class="c-key">final class</span> <span class="c-type">Money</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">public readonly</span> <span class="c-key">int</span> <span class="c-var">$amount</span>,        <span class="c-comment">// в минимальных единицах (копейки, центы)</span>
        <span class="c-key">public readonly</span> <span class="c-key">string</span> <span class="c-var">$currency</span>,
    ) {
        <span class="c-key">if</span> (<span class="c-var">$this</span>-><span class="c-var">amount</span> &lt; <span class="c-num">0</span>) {
            <span class="c-key">throw new</span> <span class="c-type">InvalidArgumentException</span>(<span class="c-str">'Money amount cannot be negative'</span>);
        }
    }

    <span class="c-key">public static function</span> <span class="c-fn">usd</span>(<span class="c-key">int</span> <span class="c-var">$cents</span>): <span class="c-key">self</span>
    {
        <span class="c-key">return new</span> <span class="c-key">self</span>(<span class="c-var">$cents</span>, <span class="c-str">'USD'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">add</span>(<span class="c-key">self</span> <span class="c-var">$other</span>): <span class="c-key">self</span>
    {
        <span class="c-key">if</span> (<span class="c-var">$this</span>-><span class="c-var">currency</span> !== <span class="c-var">$other</span>-><span class="c-var">currency</span>) {
            <span class="c-key">throw new</span> <span class="c-type">InvalidArgumentException</span>(<span class="c-str">'Currency mismatch'</span>);
        }
        <span class="c-key">return new</span> <span class="c-key">self</span>(<span class="c-var">$this</span>-><span class="c-var">amount</span> + <span class="c-var">$other</span>-><span class="c-var">amount</span>, <span class="c-var">$this</span>-><span class="c-var">currency</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">format</span>(): <span class="c-key">string</span>
    {
        <span class="c-key">return</span> <span class="c-fn">number_format</span>(<span class="c-var">$this</span>-><span class="c-var">amount</span> / <span class="c-num">100</span>, <span class="c-num">2</span>) . <span class="c-str">' '</span> . <span class="c-var">$this</span>-><span class="c-var">currency</span>;
    }
}

<span class="c-comment">// Каст</span>
<span class="c-key">use</span> <span class="c-type">Illuminate\Contracts\Database\Eloquent\CastsAttributes</span>;

<span class="c-key">final class</span> <span class="c-type">MoneyCast</span> <span class="c-key">implements</span> <span class="c-type">CastsAttributes</span>
{
    <span class="c-key">public function</span> <span class="c-fn">get</span>(<span class="c-type">Model</span> <span class="c-var">$model</span>, <span class="c-key">string</span> <span class="c-var">$key</span>, <span class="c-var">$value</span>, <span class="c-key">array</span> <span class="c-var">$attributes</span>): ?<span class="c-type">Money</span>
    {
        <span class="c-key">if</span> (<span class="c-var">$attributes</span>[<span class="c-str">'price_amount'</span>] === <span class="c-key">null</span>) {
            <span class="c-key">return</span> <span class="c-key">null</span>;
        }

        <span class="c-key">return new</span> <span class="c-type">Money</span>(
            (<span class="c-key">int</span>) <span class="c-var">$attributes</span>[<span class="c-str">'price_amount'</span>],
            (<span class="c-key">string</span>) <span class="c-var">$attributes</span>[<span class="c-str">'price_currency'</span>],
        );
    }

    <span class="c-key">public function</span> <span class="c-fn">set</span>(<span class="c-type">Model</span> <span class="c-var">$model</span>, <span class="c-key">string</span> <span class="c-var">$key</span>, <span class="c-var">$value</span>, <span class="c-key">array</span> <span class="c-var">$attributes</span>): <span class="c-key">array</span>
    {
        <span class="c-key">if</span> (! <span class="c-var">$value</span> <span class="c-key">instanceof</span> <span class="c-type">Money</span>) {
            <span class="c-key">throw new</span> <span class="c-type">InvalidArgumentException</span>(<span class="c-str">'Expected Money instance.'</span>);
        }

        <span class="c-key">return</span> [
            <span class="c-str">'price_amount'</span>   =&gt; <span class="c-var">$value</span>-><span class="c-var">amount</span>,
            <span class="c-str">'price_currency'</span> =&gt; <span class="c-var">$value</span>-><span class="c-var">currency</span>,
        ];
    }
}

<span class="c-comment">// Использование в модели</span>
<span class="c-key">class</span> <span class="c-type">Product</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$casts</span> = [<span class="c-str">'price'</span> =&gt; <span class="c-type">MoneyCast</span>::<span class="c-key">class</span>];
}

<span class="c-var">$product</span>-><span class="c-var">price</span> = <span class="c-type">Money</span>::<span class="c-fn">usd</span>(<span class="c-num">9999</span>);
<span class="c-var">$product</span>-><span class="c-fn">save</span>();
<span class="c-fn">echo</span> <span class="c-var">$product</span>-><span class="c-var">price</span>-><span class="c-fn">format</span>();   <span class="c-comment">// "99.99 USD"</span>
</code></pre>
    </div>

    <div class="card">
      <h3>Касты с параметрами и наследуемые касты</h3>
      <p class="text">Если каст требует параметров, реализуйте интерфейс <code>Castable</code> на классе value object &mdash; он возвращает экземпляр каста с переданными аргументами.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Contracts\Database\Eloquent\Castable</span>;

<span class="c-key">final class</span> <span class="c-type">Currency</span> <span class="c-key">implements</span> <span class="c-type">Castable</span>
{
    <span class="c-key">public static function</span> <span class="c-fn">castUsing</span>(<span class="c-key">array</span> <span class="c-var">$arguments</span>): <span class="c-type">CastsAttributes</span>
    {
        <span class="c-key">return new</span> <span class="c-type">CurrencyCast</span>(<span class="c-var">$arguments</span>[<span class="c-num">0</span>] ?? <span class="c-str">'USD'</span>);
    }
}

<span class="c-comment">// Использование с параметром в декларации</span>
<span class="c-key">protected</span> <span class="c-var">$casts</span> = [<span class="c-str">'price'</span> =&gt; <span class="c-type">Currency</span>::<span class="c-key">class</span> . <span class="c-str">':EUR'</span>];
</code></pre>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: модель Order с типизированными атрибутами</div>

    <p class="text">Рассмотрим модель заказа в интернет-магазине, в которой одновременно применяются несколько разновидностей кастов: enum для статуса, кастомный каст Money для суммы, AsCollection для строк заказа, шифрование для адреса доставки, datetime для жизненного цикла.</p>

    <p class="text">Схема таблицы:</p>
<pre><code>orders:
  id, user_id,
  status            varchar(20),
  total_amount      bigint,             <span class="c-comment">// в копейках</span>
  total_currency    varchar(3),
  items             json,
  shipping_address  text,                <span class="c-comment">// будет храниться зашифрованным</span>
  placed_at         timestamp,
  paid_at           timestamp nullable,
  cancelled_at      timestamp nullable,
  created_at, updated_at
</code></pre>

    <p class="text">Объявление модели и сопутствующих типов:</p>
<pre><code><span class="c-key">enum</span> <span class="c-type">OrderStatus</span>: <span class="c-key">string</span>
{
    <span class="c-key">case</span> Draft     = <span class="c-str">'draft'</span>;
    <span class="c-key">case</span> Placed    = <span class="c-str">'placed'</span>;
    <span class="c-key">case</span> Paid      = <span class="c-str">'paid'</span>;
    <span class="c-key">case</span> Shipped   = <span class="c-str">'shipped'</span>;
    <span class="c-key">case</span> Cancelled = <span class="c-str">'cancelled'</span>;

    <span class="c-key">public function</span> <span class="c-fn">canTransitionTo</span>(<span class="c-key">self</span> <span class="c-var">$next</span>): <span class="c-key">bool</span>
    {
        <span class="c-key">return match</span> ([<span class="c-var">$this</span>, <span class="c-var">$next</span>]) {
            [<span class="c-key">self</span>::<span class="c-key">Draft</span>,   <span class="c-key">self</span>::<span class="c-key">Placed</span>]    =&gt; <span class="c-key">true</span>,
            [<span class="c-key">self</span>::<span class="c-key">Placed</span>,  <span class="c-key">self</span>::<span class="c-key">Paid</span>]      =&gt; <span class="c-key">true</span>,
            [<span class="c-key">self</span>::<span class="c-key">Paid</span>,    <span class="c-key">self</span>::<span class="c-key">Shipped</span>]   =&gt; <span class="c-key">true</span>,
            [<span class="c-key">self</span>::<span class="c-key">Placed</span>,  <span class="c-key">self</span>::<span class="c-key">Cancelled</span>] =&gt; <span class="c-key">true</span>,
            <span class="c-key">default</span> =&gt; <span class="c-key">false</span>,
        };
    }
}

<span class="c-key">class</span> <span class="c-type">Order</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected function</span> <span class="c-fn">casts</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'status'</span>           =&gt; <span class="c-type">OrderStatus</span>::<span class="c-key">class</span>,
            <span class="c-str">'total'</span>            =&gt; <span class="c-type">MoneyCast</span>::<span class="c-key">class</span>,
            <span class="c-str">'items'</span>            =&gt; <span class="c-type">AsCollection</span>::<span class="c-key">class</span>,
            <span class="c-str">'shipping_address'</span> =&gt; <span class="c-str">'encrypted'</span>,
            <span class="c-str">'placed_at'</span>        =&gt; <span class="c-str">'immutable_datetime'</span>,
            <span class="c-str">'paid_at'</span>          =&gt; <span class="c-str">'immutable_datetime'</span>,
            <span class="c-str">'cancelled_at'</span>     =&gt; <span class="c-str">'immutable_datetime'</span>,
        ];
    }
}
</code></pre>

    <p class="text">Типовые операции и контексты их применения:</p>
<pre><code><span class="c-comment">// 1. Создание заказа: касты применяются автоматически при сохранении.</span>
<span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">create</span>([
    <span class="c-str">'user_id'</span>          =&gt; <span class="c-fn">auth</span>()-><span class="c-fn">id</span>(),
    <span class="c-str">'status'</span>           =&gt; <span class="c-type">OrderStatus</span>::<span class="c-key">Draft</span>,
    <span class="c-str">'total'</span>            =&gt; <span class="c-type">Money</span>::<span class="c-fn">usd</span>(<span class="c-num">12999</span>),
    <span class="c-str">'items'</span>            =&gt; <span class="c-fn">collect</span>([
        [<span class="c-str">'sku'</span> =&gt; <span class="c-str">'A1'</span>, <span class="c-str">'qty'</span> =&gt; <span class="c-num">2</span>, <span class="c-str">'price_cents'</span> =&gt; <span class="c-num">4999</span>],
        [<span class="c-str">'sku'</span> =&gt; <span class="c-str">'B5'</span>, <span class="c-str">'qty'</span> =&gt; <span class="c-num">1</span>, <span class="c-str">'price_cents'</span> =&gt; <span class="c-num">3001</span>],
    ]),
    <span class="c-str">'shipping_address'</span> =&gt; <span class="c-var">$request</span>-><span class="c-fn">input</span>(<span class="c-str">'address'</span>),
    <span class="c-str">'placed_at'</span>        =&gt; <span class="c-fn">now</span>(),
]);

<span class="c-comment">// 2. Бизнес-проверка статуса с использованием метода enum.</span>
<span class="c-key">if</span> (! <span class="c-var">$order</span>-><span class="c-var">status</span>-><span class="c-fn">canTransitionTo</span>(<span class="c-type">OrderStatus</span>::<span class="c-key">Paid</span>)) {
    <span class="c-key">throw new</span> <span class="c-type">DomainException</span>(<span class="c-str">'Invalid order status transition.'</span>);
}

<span class="c-comment">// 3. Изменение коллекции items: AsCollection возвращает Collection, на которой</span>
<span class="c-comment">// доступны map/filter; результат корректно сериализуется обратно в JSON.</span>
<span class="c-var">$order</span>-><span class="c-var">items</span> = <span class="c-var">$order</span>-><span class="c-var">items</span>-><span class="c-fn">reject</span>(<span class="c-key">fn</span>(<span class="c-var">$i</span>) =&gt; <span class="c-var">$i</span>[<span class="c-str">'qty'</span>] === <span class="c-num">0</span>);
<span class="c-var">$order</span>-><span class="c-fn">save</span>();

<span class="c-comment">// 4. Работа с зашифрованным адресом доставки.</span>
<span class="c-fn">logger</span>()-><span class="c-fn">info</span>(<span class="c-str">"Ship to: {$order->shipping_address}"</span>); <span class="c-comment">// расшифрованное значение</span>
<span class="c-comment">// В БД хранится непрозрачный шифротекст; даже при утечке дампа</span>
<span class="c-comment">// адреса остаются защищёнными без APP_KEY.</span>

<span class="c-comment">// 5. Сериализация модели в JSON для API.</span>
<span class="c-key">return</span> <span class="c-fn">response</span>()-><span class="c-fn">json</span>(<span class="c-var">$order</span>);
<span class="c-comment">// Eloquent сериализует status как 'paid', total — как объект (если у Money есть JsonSerializable),</span>
<span class="c-comment">// даты — в формате ISO 8601, items — как массив. Зашифрованные поля попадут в расшифрованном виде,</span>
<span class="c-comment">// поэтому их обычно скрывают через $hidden.</span>

<span class="c-comment">// 6. Применение immutable datetime для предотвращения случайных мутаций.</span>
<span class="c-comment">// $order->placed_at = $order->placed_at->addHour() породит исключение, поскольку</span>
<span class="c-comment">// CarbonImmutable возвращает новый экземпляр; для изменения требуется явное переприсваивание.</span>
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. Поиск по зашифрованному полю невозможен.</strong> Шифрование применяется на стороне приложения; БД видит непрозрачный шифротекст и не способна выполнять <code>WHERE</code> по содержимому. Если требуется поиск (например, по email клиента), помимо зашифрованного поля хранится поле с хешем для точного совпадения и/или blind index для частичного поиска.
    </div>

    <div class="pitfall">
      <strong>2. Каст <code>array</code> и непрямые изменения.</strong> Конструкция <code>$user-&gt;metadata['key'] = $value</code> порождает ошибку <code>Indirect modification of overloaded property</code>, поскольку Eloquent возвращает копию массива через accessor. Используйте <code>AsArrayObject</code>, либо присваивайте полностью новый массив: <code>$user-&gt;metadata = [...$user-&gt;metadata, 'key' =&gt; $value]</code>.
    </div>

    <div class="pitfall">
      <strong>3. Каст <code>decimal:n</code> возвращает строку, не число.</strong> Это сделано для сохранения точности при сериализации в JSON. Прямое арифметическое сравнение (<code>$product-&gt;price &gt; 100</code>) даст корректный результат благодаря приведению типов, но для финансовых вычислений лучше использовать целые числа в минимальных единицах или специализированный value object.
    </div>

    <div class="pitfall">
      <strong>4. <code>$casts</code> игнорируется в <code>Model::insert()</code> и подобных bulk-операциях.</strong> Прямые вставки через query builder выполняются в обход цикла гидрации Eloquent: касты, accessors, mutators, observers не вызываются. Если используются bulk-операции, преобразование значений выполняется вручную перед вставкой.
    </div>

    <div class="pitfall">
      <strong>5. Каст enum и невалидное значение в БД.</strong> Если в БД оказалось значение, отсутствующее в перечислении (например, после ручной правки или миграции с прежней системой), обращение к атрибуту бросит <code>ValueError</code>. При работе с легаси-данными целесообразно реализовать кастомный enum-каст, возвращающий <code>null</code> или специальное значение по умолчанию для неизвестных строк.
    </div>

    <div class="pitfall">
      <strong>6. Кастомный каст и attribute caching.</strong> По умолчанию Eloquent кеширует результат каста при первом обращении и возвращает один и тот же экземпляр объекта при повторных. Для value objects с состоянием это безопасно, но если каст возвращает изменяемый объект и его нужно перечитать из атрибутов, реализуйте <code>SerializesCastableAttributes</code> или используйте <code>refresh()</code>.
    </div>

    <div class="pitfall">
      <strong>7. <code>immutable_datetime</code> и привычки изменения дат.</strong> При обычном <code>datetime</code>-касте возвращается <code>Carbon</code> с изменяемым внутренним состоянием: <code>$model-&gt;date-&gt;addDay()</code> модифицирует существующий объект. У <code>immutable_datetime</code> те же методы возвращают новый экземпляр, и результат необходимо присвоить обратно. Использование immutable-варианта рекомендуется для предотвращения трудноуловимых ошибок.
    </div>

    <div class="pitfall">
      <strong>8. Унификация формата сериализации дат.</strong> Дополнительный параметр <code>datetime:Y-m-d H:i:s</code> определяет формат вывода при сериализации модели в массив или JSON, а не способ парсинга из БД. Если требуется единый формат для всех дат в API-ответах, переопределите метод <code>serializeDate()</code> на базовой модели приложения.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     ATTRIBUTES — ACCESSORS / MUTATORS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-attr-acc" class="section">
  <div class="section-title">Accessors и Mutators</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Accessor &mdash; метод, вычисляющий значение атрибута при его чтении. Используется для производных атрибутов (полное имя из первого и фамилии, абсолютный URL аватара из относительного пути, человекочитаемая длительность из секунд) или для нормализации значения, лежащего в БД, перед выдачей в код.</p>
    <p class="text">Mutator &mdash; метод, преобразующий значение перед его сохранением в атрибут модели. Применяется для хеширования паролей, обрезки пробелов в email, нормализации регистра, упрощения единиц измерения.</p>
    <p class="text">Граница между mutator и cast в Laravel размыта: оба механизма преобразуют значение при чтении/записи. Различие в том, что cast описывает <strong>тип</strong> атрибута (как сериализовать в БД), а accessor/mutator описывает <strong>пользовательскую логику</strong> (как вычислить или нормализовать). Для повторно используемых преобразований предпочтителен кастомный cast; для логики, специфичной одной модели, &mdash; accessor/mutator.</p>
    <p class="text">В Laravel 9 был введён новый API на основе класса <code>Illuminate\Database\Eloquent\Casts\Attribute</code>. Он объединяет accessor и mutator в одном методе, поддерживает многоколоночные mutator (запись в несколько столбцов одним присваиванием) и встроенное кеширование результата. Старый стиль (<code>getXxxAttribute</code> / <code>setXxxAttribute</code>) остаётся работоспособным для обратной совместимости.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень механизмов</div>

    <div class="card">
      <h3>Старый API: префиксные методы</h3>
      <p class="text">Метод с именем <code>get{Name}Attribute</code> объявляет accessor, <code>set{Name}Attribute</code> &mdash; mutator. Имя атрибута получается преобразованием PascalCase в snake_case: <code>getFullNameAttribute</code> соответствует обращению <code>$user-&gt;full_name</code>.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-comment">// Accessor: вычисляет производный атрибут.</span>
    <span class="c-key">public function</span> <span class="c-fn">getFullNameAttribute</span>(): <span class="c-key">string</span>
    {
        <span class="c-key">return</span> <span class="c-fn">trim</span>(<span class="c-str">"{$this->first_name} {$this->last_name}"</span>);
    }

    <span class="c-comment">// Mutator: нормализует email при записи.</span>
    <span class="c-key">public function</span> <span class="c-fn">setEmailAttribute</span>(<span class="c-key">string</span> <span class="c-var">$value</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$this</span>-><span class="c-fn">attributes</span>[<span class="c-str">'email'</span>] = <span class="c-fn">strtolower</span>(<span class="c-fn">trim</span>(<span class="c-var">$value</span>));
    }

    <span class="c-comment">// Mutator с побочным эффектом: автоматически хеширует пароль.</span>
    <span class="c-key">public function</span> <span class="c-fn">setPasswordAttribute</span>(<span class="c-key">string</span> <span class="c-var">$value</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$this</span>-><span class="c-fn">attributes</span>[<span class="c-str">'password'</span>] = <span class="c-type">Hash</span>::<span class="c-fn">make</span>(<span class="c-var">$value</span>);
    }
}

<span class="c-comment">// Использование</span>
<span class="c-var">$user</span>-><span class="c-var">email</span>    = <span class="c-str">'  Alice@Example.COM  '</span>;
<span class="c-var">$user</span>-><span class="c-var">password</span> = <span class="c-str">'plain-text'</span>;
<span class="c-var">$user</span>-><span class="c-fn">save</span>();
<span class="c-comment">// В БД: email = 'alice@example.com', password = '$2y$10$...' (bcrypt-хеш)</span>
<span class="c-fn">echo</span> <span class="c-var">$user</span>-><span class="c-var">full_name</span>;  <span class="c-comment">// "Alice Brown"</span>
</code></pre>
    </div>

    <div class="card">
      <h3>Новый API: класс <code>Attribute</code></h3>
      <p class="text">Метод объявляется с типом-возвратом <code>Attribute</code> и возвращает результат <code>Attribute::make()</code>. Передаются именованные аргументы <code>get</code> (accessor) и <code>set</code> (mutator). Это сокращает декларацию и даёт ряд дополнительных возможностей.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Casts\Attribute</span>;

<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-comment">// Только accessor.</span>
    <span class="c-key">protected function</span> <span class="c-fn">fullName</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">make</span>(
            get: <span class="c-key">fn</span> (<span class="c-var">$value</span>, <span class="c-key">array</span> <span class="c-var">$attributes</span>): <span class="c-key">string</span> =&gt;
                <span class="c-fn">trim</span>(<span class="c-str">"{$attributes['first_name']} {$attributes['last_name']}"</span>),
        );
    }

    <span class="c-comment">// Только mutator с нормализацией.</span>
    <span class="c-key">protected function</span> <span class="c-fn">email</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">make</span>(
            set: <span class="c-key">fn</span> (<span class="c-key">string</span> <span class="c-var">$value</span>): <span class="c-key">string</span> =&gt; <span class="c-fn">strtolower</span>(<span class="c-fn">trim</span>(<span class="c-var">$value</span>)),
        );
    }

    <span class="c-comment">// Сокращённая запись для случая, когда нужен только один из вариантов.</span>
    <span class="c-key">protected function</span> <span class="c-fn">password</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">set</span>(<span class="c-key">fn</span> (<span class="c-key">string</span> <span class="c-var">$value</span>) =&gt; <span class="c-type">Hash</span>::<span class="c-fn">make</span>(<span class="c-var">$value</span>));
    }

    <span class="c-comment">// Accessor с зависимостью от других полей.</span>
    <span class="c-key">protected function</span> <span class="c-fn">isVerified</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">get</span>(<span class="c-key">fn</span> (<span class="c-var">$value</span>, <span class="c-key">array</span> <span class="c-var">$attributes</span>): <span class="c-key">bool</span> =&gt;
            <span class="c-var">$attributes</span>[<span class="c-str">'email_verified_at'</span>] !== <span class="c-key">null</span>
                &amp;&amp; <span class="c-var">$attributes</span>[<span class="c-str">'phone_verified_at'</span>] !== <span class="c-key">null</span>);
    }
}
</code></pre>
      <p class="text">Имя атрибута для внешнего обращения получается преобразованием camelCase метода в snake_case: <code>fullName()</code> доступен как <code>$user-&gt;full_name</code>, <code>isVerified()</code> &mdash; как <code>$user-&gt;is_verified</code>.</p>
    </div>

    <div class="card">
      <h3>Многоколоночные mutator</h3>
      <p class="text">Если присваивание атрибуту должно затрагивать несколько столбцов БД, mutator возвращает ассоциативный массив <code>'столбец' =&gt; значение</code>. Это полезно для синтетических атрибутов вроде «полное имя» с автоматическим разбиением на части.</p>
<pre><code><span class="c-key">protected function</span> <span class="c-fn">fullName</span>(): <span class="c-type">Attribute</span>
{
    <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">make</span>(
        get: <span class="c-key">fn</span> (<span class="c-var">$value</span>, <span class="c-key">array</span> <span class="c-var">$attributes</span>): <span class="c-key">string</span> =&gt;
            <span class="c-fn">trim</span>(<span class="c-str">"{$attributes['first_name']} {$attributes['last_name']}"</span>),

        set: <span class="c-key">function</span> (<span class="c-key">string</span> <span class="c-var">$value</span>): <span class="c-key">array</span> {
            <span class="c-var">$parts</span> = <span class="c-fn">explode</span>(<span class="c-str">' '</span>, <span class="c-fn">trim</span>(<span class="c-var">$value</span>), <span class="c-num">2</span>);
            <span class="c-key">return</span> [
                <span class="c-str">'first_name'</span> =&gt; <span class="c-var">$parts</span>[<span class="c-num">0</span>],
                <span class="c-str">'last_name'</span>  =&gt; <span class="c-var">$parts</span>[<span class="c-num">1</span>] ?? <span class="c-str">''</span>,
            ];
        },
    );
}

<span class="c-var">$user</span>-><span class="c-var">full_name</span> = <span class="c-str">'Alice Brown'</span>;
<span class="c-var">$user</span>-><span class="c-fn">save</span>();
<span class="c-comment">// В БД: first_name='Alice', last_name='Brown'.</span>
</code></pre>
    </div>

    <div class="card">
      <h3>Кеширование значения accessor: <code>shouldCache()</code></h3>
      <p class="text">По умолчанию accessor вызывается при каждом обращении к атрибуту. Если вычисление затратно (преобразование больших данных, обращение к внешним сервисам, генерация подписанных URL), результат можно закешировать в памяти инстанса модели на время её жизни.</p>
<pre><code><span class="c-key">protected function</span> <span class="c-fn">avatarUrl</span>(): <span class="c-type">Attribute</span>
{
    <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">make</span>(
        get: <span class="c-key">fn</span> (): <span class="c-key">string</span> =&gt; <span class="c-type">Storage</span>::<span class="c-fn">disk</span>(<span class="c-str">'s3'</span>)-><span class="c-fn">temporaryUrl</span>(
            <span class="c-var">$this</span>-><span class="c-var">avatar_path</span>,
            <span class="c-fn">now</span>()-><span class="c-fn">addHour</span>(),
        ),
    )-><span class="c-fn">shouldCache</span>();
}

<span class="c-comment">// Первое обращение генерирует подписанный URL, второе и далее возвращает его из кеша.</span>
<span class="c-fn">echo</span> <span class="c-var">$user</span>-><span class="c-var">avatar_url</span>;  <span class="c-comment">// сетевой вызов</span>
<span class="c-fn">echo</span> <span class="c-var">$user</span>-><span class="c-var">avatar_url</span>;  <span class="c-comment">// без вызова</span>
</code></pre>
      <p class="text">Метод <code>shouldCache()</code> кеширует значение в свойстве модели. При вызове <code>$model-&gt;refresh()</code> или <code>$model-&gt;fresh()</code> кеш сбрасывается. Для критичных к актуальности данных кеширование не применяется.</p>
    </div>

    <div class="card">
      <h3>Связь с appended-атрибутами</h3>
      <p class="text">По умолчанию accessor не попадает в сериализованное представление модели (<code>toArray()</code>, <code>toJson()</code>). Чтобы вычисленное значение появилось в API-ответе, имя атрибута перечисляется в свойстве <code>$appends</code>.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$appends</span> = [<span class="c-str">'full_name'</span>, <span class="c-str">'avatar_url'</span>];

    <span class="c-key">protected function</span> <span class="c-fn">fullName</span>(): <span class="c-type">Attribute</span> { <span class="c-comment">/* ... */</span> }
    <span class="c-key">protected function</span> <span class="c-fn">avatarUrl</span>(): <span class="c-type">Attribute</span> { <span class="c-comment">/* ... */</span> }
}
</code></pre>
      <p class="text">Более точный подход к управлению сериализацией &mdash; через <code>Eloquent Resource</code>, особенно если набор полей зависит от роли запрашивающего пользователя.</p>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: профиль пользователя с производными полями</div>

    <p class="text">Рассмотрим модель <code>User</code> в проекте, где требуется ряд производных атрибутов: полное имя, инициалы, возраст по дате рождения, флаг полной верификации, временный URL аватара. Mutators применяются для нормализации входных данных: тримминг email, хеширование пароля, разбиение полного имени на составляющие.</p>

<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Casts\Attribute</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Hash</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Storage</span>;

<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$fillable</span> = [
        <span class="c-str">'first_name'</span>, <span class="c-str">'last_name'</span>, <span class="c-str">'email'</span>, <span class="c-str">'password'</span>,
        <span class="c-str">'birth_date'</span>, <span class="c-str">'avatar_path'</span>, <span class="c-str">'phone'</span>,
        <span class="c-str">'email_verified_at'</span>, <span class="c-str">'phone_verified_at'</span>,
    ];

    <span class="c-key">protected</span> <span class="c-var">$hidden</span>   = [<span class="c-str">'password'</span>, <span class="c-str">'remember_token'</span>];
    <span class="c-key">protected</span> <span class="c-var">$appends</span>  = [<span class="c-str">'full_name'</span>, <span class="c-str">'initials'</span>, <span class="c-str">'age'</span>, <span class="c-str">'is_fully_verified'</span>];

    <span class="c-key">protected function</span> <span class="c-fn">casts</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'birth_date'</span>         =&gt; <span class="c-str">'immutable_date'</span>,
            <span class="c-str">'email_verified_at'</span>  =&gt; <span class="c-str">'datetime'</span>,
            <span class="c-str">'phone_verified_at'</span>  =&gt; <span class="c-str">'datetime'</span>,
        ];
    }

    <span class="c-comment">// ───── Mutators (нормализация при записи) ─────</span>

    <span class="c-key">protected function</span> <span class="c-fn">email</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">set</span>(<span class="c-key">fn</span> (<span class="c-key">string</span> <span class="c-var">$v</span>): <span class="c-key">string</span> =&gt; <span class="c-fn">strtolower</span>(<span class="c-fn">trim</span>(<span class="c-var">$v</span>)));
    }

    <span class="c-key">protected function</span> <span class="c-fn">phone</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">set</span>(<span class="c-key">fn</span> (?<span class="c-key">string</span> <span class="c-var">$v</span>): ?<span class="c-key">string</span> =&gt;
            <span class="c-var">$v</span> === <span class="c-key">null</span> ? <span class="c-key">null</span> : <span class="c-fn">preg_replace</span>(<span class="c-str">'/\\D+/'</span>, <span class="c-str">''</span>, <span class="c-var">$v</span>));
    }

    <span class="c-key">protected function</span> <span class="c-fn">password</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">set</span>(<span class="c-key">fn</span> (<span class="c-key">string</span> <span class="c-var">$v</span>): <span class="c-key">string</span> =&gt; <span class="c-type">Hash</span>::<span class="c-fn">make</span>(<span class="c-var">$v</span>));
    }

    <span class="c-comment">// ───── Accessors (производные атрибуты) ─────</span>

    <span class="c-key">protected function</span> <span class="c-fn">fullName</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">make</span>(
            get: <span class="c-key">fn</span> (<span class="c-var">$value</span>, <span class="c-key">array</span> <span class="c-var">$attributes</span>): <span class="c-key">string</span> =&gt;
                <span class="c-fn">trim</span>(<span class="c-str">"{$attributes['first_name']} {$attributes['last_name']}"</span>),

            set: <span class="c-key">function</span> (<span class="c-key">string</span> <span class="c-var">$value</span>): <span class="c-key">array</span> {
                <span class="c-var">$parts</span> = <span class="c-fn">explode</span>(<span class="c-str">' '</span>, <span class="c-fn">trim</span>(<span class="c-var">$value</span>), <span class="c-num">2</span>);
                <span class="c-key">return</span> [<span class="c-str">'first_name'</span> =&gt; <span class="c-var">$parts</span>[<span class="c-num">0</span>], <span class="c-str">'last_name'</span> =&gt; <span class="c-var">$parts</span>[<span class="c-num">1</span>] ?? <span class="c-str">''</span>];
            },
        );
    }

    <span class="c-key">protected function</span> <span class="c-fn">initials</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">get</span>(<span class="c-key">fn</span> (<span class="c-var">$value</span>, <span class="c-key">array</span> <span class="c-var">$a</span>): <span class="c-key">string</span> =&gt;
            <span class="c-fn">mb_substr</span>(<span class="c-var">$a</span>[<span class="c-str">'first_name'</span>], <span class="c-num">0</span>, <span class="c-num">1</span>) . <span class="c-fn">mb_substr</span>(<span class="c-var">$a</span>[<span class="c-str">'last_name'</span>], <span class="c-num">0</span>, <span class="c-num">1</span>));
    }

    <span class="c-key">protected function</span> <span class="c-fn">age</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">get</span>(<span class="c-key">fn</span> (): ?<span class="c-key">int</span> =&gt;
            <span class="c-var">$this</span>-><span class="c-var">birth_date</span>?-><span class="c-fn">diffInYears</span>(<span class="c-fn">now</span>()));
    }

    <span class="c-key">protected function</span> <span class="c-fn">isFullyVerified</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">get</span>(<span class="c-key">fn</span> (): <span class="c-key">bool</span> =&gt;
            <span class="c-var">$this</span>-><span class="c-var">email_verified_at</span> !== <span class="c-key">null</span>
            &amp;&amp; <span class="c-var">$this</span>-><span class="c-var">phone_verified_at</span> !== <span class="c-key">null</span>);
    }

    <span class="c-key">protected function</span> <span class="c-fn">avatarUrl</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">get</span>(<span class="c-key">fn</span> (): ?<span class="c-key">string</span> =&gt;
            <span class="c-var">$this</span>-><span class="c-var">avatar_path</span>
                ? <span class="c-type">Storage</span>::<span class="c-fn">disk</span>(<span class="c-str">'s3'</span>)-><span class="c-fn">temporaryUrl</span>(<span class="c-var">$this</span>-><span class="c-var">avatar_path</span>, <span class="c-fn">now</span>()-><span class="c-fn">addHour</span>())
                : <span class="c-key">null</span>)-><span class="c-fn">shouldCache</span>();
    }
}
</code></pre>

    <p class="text">Применение модели в типовых сценариях:</p>
<pre><code><span class="c-comment">// 1. Регистрация: ввод преобразуется автоматически.</span>
<span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">create</span>([
    <span class="c-str">'full_name'</span>  =&gt; <span class="c-str">'Алиса Браун'</span>,                <span class="c-comment">// разобьётся на first_name, last_name</span>
    <span class="c-str">'email'</span>      =&gt; <span class="c-str">'  Alice@Example.COM  '</span>,        <span class="c-comment">// нормализуется до 'alice@example.com'</span>
    <span class="c-str">'phone'</span>      =&gt; <span class="c-str">'+7 (701) 555-12-34'</span>,           <span class="c-comment">// сохранится как '77015551234'</span>
    <span class="c-str">'password'</span>   =&gt; <span class="c-var">$request</span>-><span class="c-fn">input</span>(<span class="c-str">'password'</span>),     <span class="c-comment">// захешируется bcrypt</span>
    <span class="c-str">'birth_date'</span> =&gt; <span class="c-str">'1990-06-15'</span>,
]);

<span class="c-comment">// 2. Чтение производных полей.</span>
<span class="c-fn">echo</span> <span class="c-var">$user</span>-><span class="c-var">full_name</span>;          <span class="c-comment">// "Алиса Браун"</span>
<span class="c-fn">echo</span> <span class="c-var">$user</span>-><span class="c-var">initials</span>;           <span class="c-comment">// "АБ"</span>
<span class="c-fn">echo</span> <span class="c-var">$user</span>-><span class="c-var">age</span>;                <span class="c-comment">// 35</span>
<span class="c-fn">echo</span> <span class="c-var">$user</span>-><span class="c-var">is_fully_verified</span>;  <span class="c-comment">// false (email/phone ещё не подтверждены)</span>
<span class="c-fn">echo</span> <span class="c-var">$user</span>-><span class="c-var">avatar_url</span>;         <span class="c-comment">// S3-URL, кешируется в памяти инстанса</span>

<span class="c-comment">// 3. Сериализация для API: благодаря $appends, производные атрибуты попадают в JSON.</span>
<span class="c-key">return</span> <span class="c-fn">response</span>()-><span class="c-fn">json</span>(<span class="c-var">$user</span>);
<span class="c-comment">// {</span>
<span class="c-comment">//   "id": 1, "first_name": "Алиса", "last_name": "Браун",</span>
<span class="c-comment">//   "email": "alice@example.com", "phone": "77015551234",</span>
<span class="c-comment">//   "full_name": "Алиса Браун", "initials": "АБ", "age": 35,</span>
<span class="c-comment">//   "is_fully_verified": false</span>
<span class="c-comment">// }</span>
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. Mutator не заменяет валидацию.</strong> Mutator нормализует значение, но не отвергает невалидные данные. Логика «email должен быть валидным» относится к слою валидации (<code>FormRequest</code>, правила Eloquent). Mutator выполняет последний штрих &mdash; приведение к канонической форме (lowercase, trim).
    </div>

    <div class="pitfall">
      <strong>2. Накладные расходы accessor в циклах.</strong> Accessor вызывается при каждом обращении к атрибуту. Если он выполняет тяжёлую работу (например, формирует подписанный URL, обращается к кешу), цикл по большой коллекции порождает соответствующее число вызовов. Для таких случаев применяется <code>shouldCache()</code>, либо данные вычисляются на этапе выборки одним пакетом.
    </div>

    <div class="pitfall">
      <strong>3. Accessor не виден в WHERE.</strong> Запросы Eloquent работают с реальными колонками БД. Условие <code>where('full_name', 'Alice Brown')</code> приведёт к SQL-ошибке &mdash; столбца <code>full_name</code> в таблице нет. Для поиска по производным значениям применяется фильтрация по составляющим (<code>where('first_name', 'Alice')-&gt;where('last_name', 'Brown')</code>), индексированные сгенерированные столбцы БД, либо полнотекстовый поиск.
    </div>

    <div class="pitfall">
      <strong>4. Конфликт mutator и cast на одном атрибуте.</strong> Если на одном атрибуте объявлены и mutator, и cast, выполняется только mutator. Это легко не заметить, что приводит к молчаливой потере преобразования. Не размещайте оба механизма на одном поле; для одиночных трансформаций выбирайте либо cast (если логика переиспользуется), либо mutator.
    </div>

    <div class="pitfall">
      <strong>5. <code>save()</code> не вызывает mutator при прямом изменении массива <code>attributes</code>.</strong> Конструкция <code>$user-&gt;attributes['email'] = $value</code> минует mutator. Используйте присваивание через свойство (<code>$user-&gt;email = $value</code>) или метод <code>setAttribute()</code>, чтобы цепочка преобразований сработала.
    </div>

    <div class="pitfall">
      <strong>6. Bulk-обновления через query builder.</strong> Вызов <code>User::query()-&gt;update(['password' =&gt; $value])</code> не вызывает mutator &mdash; обновление происходит напрямую через query builder. Для применения логики mutator используется обход через инстансы (<code>User::find($id)-&gt;update(...)</code>), либо явное преобразование значения перед bulk-операцией.
    </div>

    <div class="pitfall">
      <strong>7. Зависимости accessor от других atributes.</strong> Accessor получает второй аргумент &mdash; массив всех текущих атрибутов модели. Не следует обращаться к <code>$this-&gt;attribute_name</code> внутри accessor, поскольку это рекурсивно вернёт результат самого accessor (если он на это поле тоже определён), либо вызовет повторный проход по тому же accessor. Используйте параметр <code>$attributes</code>.
    </div>

    <div class="pitfall">
      <strong>8. Mutator на полях, не входящих в <code>$fillable</code>.</strong> При массовом присваивании через <code>Model::create()</code> или <code>Model::update()</code> учитываются только поля из <code>$fillable</code>. Если mutator определён на поле вне этого списка, его вызов при mass-assignment не произойдёт. Для критичных преобразований (хеширование пароля) удостоверьтесь, что поле явно разрешено к массовому присваиванию, либо присваивайте его отдельно через свойство.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     ATTRIBUTES — HIDDEN
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-attr-hidden" class="section">
  <div class="section-title">Hidden, Visible, Appended</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">При сериализации модели в массив или JSON Eloquent по умолчанию включает все колонки таблицы, известные накопителю атрибутов, и не включает производные accessor-атрибуты. Свойства <code>$hidden</code>, <code>$visible</code> и <code>$appends</code> позволяют точечно настроить, какие поля попадают в результирующее представление.</p>
    <p class="text">Главная задача механизма &mdash; предотвращение случайной утечки чувствительных данных (пароли, токены, внутренние пометки) при сериализации модели и явное включение вычисляемых полей, не существующих в БД (полное имя, инициалы, число дочерних записей).</p>
    <p class="text">Свойства модели задают поведение по умолчанию для всех её экземпляров; дополнительно существуют методы инстанса, временно изменяющие список видимых полей для конкретного объекта (<code>makeHidden</code>, <code>makeVisible</code>, <code>setHidden</code>, <code>setVisible</code>, <code>append</code>). Для сложных сценариев, в которых форма ответа зависит от прав запрашивающего пользователя или версии API, рекомендуется использовать <code>Eloquent Resource</code> &mdash; отдельный класс-преобразователь, явно описывающий структуру выходных данных.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень механизмов</div>

    <div class="card">
      <h3>Свойство <code>$hidden</code></h3>
      <p class="text">Чёрный список колонок и accessor-атрибутов, исключаемых из сериализации. Применяется, когда подавляющее большинство полей открыто, а скрыть нужно лишь несколько чувствительных. Это наиболее распространённый сценарий.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$hidden</span> = [
        <span class="c-str">'password'</span>,
        <span class="c-str">'remember_token'</span>,
        <span class="c-str">'api_secret'</span>,
        <span class="c-str">'two_factor_secret'</span>,
        <span class="c-str">'two_factor_recovery_codes'</span>,
    ];
}

<span class="c-var">$user</span>-><span class="c-fn">toArray</span>();
<span class="c-comment">// [</span>
<span class="c-comment">//   'id' => 1, 'name' => 'Alice', 'email' => 'alice@example.com',</span>
<span class="c-comment">//   'created_at' => '...', 'updated_at' => '...'</span>
<span class="c-comment">// ]</span>
<span class="c-comment">// password, remember_token и остальные не появятся в выводе.</span>
</code></pre>
    </div>

    <div class="card">
      <h3>Свойство <code>$visible</code></h3>
      <p class="text">Белый список: в сериализованном виде окажутся только перечисленные поля, остальные будут скрыты. Используется, когда требуется строгое ограничение состава полей &mdash; например, для специализированной таблицы аудита, ответа справочника API, минимального профиля гостевого пользователя.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">PublicProfile</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$visible</span> = [<span class="c-str">'id'</span>, <span class="c-str">'name'</span>, <span class="c-str">'avatar_url'</span>];
}

<span class="c-var">$profile</span>-><span class="c-fn">toJson</span>();
<span class="c-comment">// {"id":1,"name":"Alice","avatar_url":"https://..."}</span>
</code></pre>
      <p class="text">Одновременное использование <code>$hidden</code> и <code>$visible</code> на одной модели допустимо, но логически избыточно: <code>$visible</code> имеет приоритет, <code>$hidden</code> применяется только к полям, попавшим в белый список.</p>
    </div>

    <div class="card">
      <h3>Свойство <code>$appends</code></h3>
      <p class="text">Список accessor-атрибутов, которые необходимо включить в результат сериализации. По умолчанию accessor вычисляется только при прямом обращении к свойству; чтобы он автоматически попал в <code>toArray()</code> и <code>toJson()</code>, его имя добавляется в <code>$appends</code>.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$appends</span> = [<span class="c-str">'full_name'</span>, <span class="c-str">'avatar_url'</span>];

    <span class="c-key">protected function</span> <span class="c-fn">fullName</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">get</span>(<span class="c-key">fn</span> (<span class="c-var">$_</span>, <span class="c-key">array</span> <span class="c-var">$a</span>) =&gt; <span class="c-str">"{$a['first_name']} {$a['last_name']}"</span>);
    }
}

<span class="c-var">$user</span>-><span class="c-fn">toArray</span>();
<span class="c-comment">// [..., 'full_name' => 'Alice Brown', 'avatar_url' => 'https://...']</span>
</code></pre>
      <p class="text">Имена в <code>$appends</code> используют snake_case, согласно конвенции сериализации Eloquent. Если accessor определён через метод <code>fullName()</code>, в <code>$appends</code> указывается <code>'full_name'</code>.</p>
    </div>

    <div class="card">
      <h3>Динамическое изменение состава полей</h3>
      <p class="text">Методы инстанса позволяют изменить видимость полей у конкретного объекта без модификации настроек класса. Возвращают <code>$this</code>, поэтому пригодны к цепочечному применению.</p>
      <table class="data-table">
        <tr><th>Метод</th><th>Действие</th></tr>
        <tr><td><code>makeHidden($attrs)</code></td><td>Добавляет указанные поля в скрытые на данном экземпляре.</td></tr>
        <tr><td><code>makeVisible($attrs)</code></td><td>Удаляет указанные поля из списка скрытых и (если используется <code>$visible</code>) добавляет в список видимых.</td></tr>
        <tr><td><code>setHidden($attrs)</code></td><td>Полностью замещает список скрытых полей переданным массивом.</td></tr>
        <tr><td><code>setVisible($attrs)</code></td><td>Полностью замещает список видимых полей.</td></tr>
        <tr><td><code>append($attrs)</code></td><td>Добавляет имена к списку <code>$appends</code> на данном экземпляре.</td></tr>
      </table>
<pre><code><span class="c-comment">// Сериализация одного пользователя для админ-панели с раскрытием служебных полей.</span>
<span class="c-key">return</span> <span class="c-fn">response</span>()-><span class="c-fn">json</span>(
    <span class="c-var">$user</span>
        -><span class="c-fn">makeVisible</span>([<span class="c-str">'internal_notes'</span>, <span class="c-str">'risk_score'</span>])
        -><span class="c-fn">append</span>(<span class="c-str">'last_login_country'</span>)
);

<span class="c-comment">// Скрытие части полей для коллекции, отдаваемой публичным API.</span>
<span class="c-var">$users</span>-><span class="c-fn">each</span>-><span class="c-fn">makeHidden</span>([<span class="c-str">'email'</span>, <span class="c-str">'phone'</span>]);
<span class="c-key">return</span> <span class="c-fn">response</span>()-><span class="c-fn">json</span>(<span class="c-var">$users</span>);
</code></pre>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: разные представления модели User в зависимости от роли</div>

    <p class="text">Рассмотрим API, в котором один и тот же ресурс <code>User</code> отдаётся в трёх вариантах: гостю &mdash; минимальная карточка с именем и аватаром; самому пользователю &mdash; полный профиль без чувствительных полей; администратору &mdash; полный набор полей, включая внутренние пометки и оценку риска. Поля для каждого случая декларируются комбинацией <code>$hidden</code>, <code>$appends</code> и динамических вызовов.</p>

<pre><code><span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-comment">// Скрыты всегда — чувствительные поля, никогда не должны попадать в API.</span>
    <span class="c-key">protected</span> <span class="c-var">$hidden</span> = [
        <span class="c-str">'password'</span>,
        <span class="c-str">'remember_token'</span>,
        <span class="c-str">'two_factor_secret'</span>,
        <span class="c-str">'two_factor_recovery_codes'</span>,
        <span class="c-str">'internal_notes'</span>,        <span class="c-comment">// только для админов — раскроется через makeVisible</span>
        <span class="c-str">'risk_score'</span>,            <span class="c-comment">// только для админов</span>
    ];

    <span class="c-comment">// Производные поля, всегда отображаемые в JSON-выводе.</span>
    <span class="c-key">protected</span> <span class="c-var">$appends</span> = [<span class="c-str">'full_name'</span>, <span class="c-str">'avatar_url'</span>];
}
</code></pre>

    <p class="text">Контроллер с тремя вариантами представления:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">UserController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-comment">// Гостевой запрос: минимальное представление через setVisible.</span>
    <span class="c-key">public function</span> <span class="c-fn">publicShow</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-type">JsonResponse</span>
    {
        <span class="c-key">return</span> <span class="c-fn">response</span>()-><span class="c-fn">json</span>(
            <span class="c-var">$user</span>-><span class="c-fn">setVisible</span>([<span class="c-str">'id'</span>, <span class="c-str">'full_name'</span>, <span class="c-str">'avatar_url'</span>])
        );
    }

    <span class="c-comment">// Личный кабинет: всё кроме чувствительных полей.</span>
    <span class="c-key">public function</span> <span class="c-fn">selfShow</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>): <span class="c-type">JsonResponse</span>
    {
        <span class="c-key">return</span> <span class="c-fn">response</span>()-><span class="c-fn">json</span>(<span class="c-var">$request</span>-><span class="c-fn">user</span>());
        <span class="c-comment">// password и токены скрыты через $hidden, остальное возвращается как есть.</span>
    }

    <span class="c-comment">// Админ: раскрытие внутренних полей и добавление вычисляемых.</span>
    <span class="c-key">public function</span> <span class="c-fn">adminShow</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-type">JsonResponse</span>
    {
        <span class="c-key">return</span> <span class="c-fn">response</span>()-><span class="c-fn">json</span>(
            <span class="c-var">$user</span>
                -><span class="c-fn">makeVisible</span>([<span class="c-str">'internal_notes'</span>, <span class="c-str">'risk_score'</span>])
                -><span class="c-fn">append</span>(<span class="c-str">'last_login_at'</span>)
                -><span class="c-fn">loadCount</span>([<span class="c-str">'posts'</span>, <span class="c-str">'comments'</span>])
        );
    }
}
</code></pre>

    <p class="text">Тот же подход применим к коллекциям:</p>
<pre><code><span class="c-comment">// Для списка пользователей в гостевом справочнике — обнуляем чувствительные поля каждого.</span>
<span class="c-var">$users</span> = <span class="c-type">User</span>::<span class="c-fn">latest</span>()-><span class="c-fn">paginate</span>(<span class="c-num">20</span>);
<span class="c-var">$users</span>-><span class="c-fn">getCollection</span>()-><span class="c-fn">each</span>-><span class="c-fn">setVisible</span>([<span class="c-str">'id'</span>, <span class="c-str">'full_name'</span>, <span class="c-str">'avatar_url'</span>]);
<span class="c-key">return</span> <span class="c-fn">response</span>()-><span class="c-fn">json</span>(<span class="c-var">$users</span>);
</code></pre>

    <p class="text">Для проектов, в которых вариантов представления становится много, целесообразен переход на <code>Eloquent Resources</code> &mdash; отдельные классы-преобразователи, в которых форма ответа описана явно. Использование <code>$hidden</code> и компании остаётся актуальным как «защитная сетка» от случайной утечки полей при любом способе сериализации.</p>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. <code>$hidden</code> срабатывает только при сериализации.</strong> Прямое обращение через свойство (<code>$user-&gt;password</code>) возвращает значение независимо от <code>$hidden</code>. Защита от утечки работает в момент <code>toArray()</code> / <code>toJson()</code> / автоматического приведения модели к JSON в роутах API; для абсолютного скрытия значения необходимо не загружать его из БД (например, через <code>select()</code> в запросе).
    </div>

    <div class="pitfall">
      <strong>2. <code>$appends</code> увеличивает стоимость сериализации.</strong> Каждый accessor, перечисленный в <code>$appends</code>, выполняется при каждой сериализации модели. Если accessor обращается к БД (например, вычисляет число дочерних записей), это легко превращается в N+1 при отдаче коллекции. Используйте <code>withCount</code>, кеширование accessor через <code>shouldCache()</code>, либо <code>Eloquent Resources</code>.
    </div>

    <div class="pitfall">
      <strong>3. Конфликт <code>$hidden</code> и сериализации связанных моделей.</strong> Если на родителе скрыто поле <code>password</code>, оно не появится в выводе самого родителя, но в связанных моделях (например, <code>$post-&gt;author</code>) видимость определяется настройками <code>User</code>. Убедитесь, что <code>$hidden</code> объявлен на самой модели <code>User</code>, а не только в одном контроллере.
    </div>

    <div class="pitfall">
      <strong>4. <code>makeVisible</code> на закешированной коллекции.</strong> При вызове на коллекции (<code>$users-&gt;makeVisible(...)</code>) изменение применяется к каждой модели по отдельности, но не возвращает новую коллекцию &mdash; работает по ссылкам. Если та же коллекция используется ещё где-то ниже по стеку, изменения видимости будут видны и там.
    </div>

    <div class="pitfall">
      <strong>5. Поля, объявленные в <code>$appends</code>, должны быть accessor.</strong> Если в <code>$appends</code> указано имя, для которого не определён accessor, при сериализации Laravel попытается получить значение через стандартный механизм атрибутов; обычно это вернёт <code>null</code> без ошибки, что приводит к молчаливо неправильному JSON.
    </div>

    <div class="pitfall">
      <strong>6. <code>$visible</code> блокирует даже служебные поля.</strong> Если в <code>$visible</code> не включено поле <code>id</code> или <code>created_at</code>, они исчезнут из вывода. Это может неожиданно сломать клиентов API, ожидающих идентификаторы. При работе с белым списком всегда явно перечисляйте обязательные служебные поля.
    </div>

    <div class="pitfall">
      <strong>7. Связь между <code>$hidden</code> и Mass Assignment.</strong> Списки <code>$fillable</code> / <code>$guarded</code> и <code>$hidden</code> / <code>$visible</code> регулируют разные стороны: первые &mdash; что разрешено присваивать при массовом обновлении, вторые &mdash; что выводится в сериализации. Их часто путают, в результате чего одно и то же поле может быть «защищено» от записи, но утекать при чтении, или наоборот.
    </div>

    <div class="pitfall">
      <strong>8. <code>$hidden</code> и логирование.</strong> Некоторые инструменты логирования (Telescope, debug-логи) дампят полное состояние модели, обходя сериализацию. <code>$hidden</code> их не защищает; для чувствительных значений необходима явная фильтрация на уровне логгера или передача в логи специально подготовленного представления.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     QUERIES — SCOPES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-query-scopes" class="section">
  <div class="section-title">Scopes: локальные и глобальные</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Scope &mdash; именованный фрагмент query builder, инкапсулирующий часто используемое условие или последовательность условий. Применение scope позволяет переиспользовать запросные правила в нескольких местах кода и сделать места их применения декларативными: вместо <code>where('status', 'active')-&gt;where('deleted_at', null)-&gt;where(...)</code> пишется <code>active()</code>.</p>
    <p class="text">Eloquent различает два рода scope. <strong>Локальные</strong> объявляются как методы модели и применяются явно при построении запроса. <strong>Глобальные</strong> применяются автоматически ко всем запросам модели без дополнительных вызовов; их используют для системных условий, которые должны действовать всегда (фильтр по тенанту, скрытие soft-deleted, ограничение по правам доступа).</p>
    <p class="text">Глобальные scopes &mdash; основа таких функций Laravel, как Soft Deletes (<code>SoftDeletingScope</code>) и встроенная фильтрация архивных записей. Этот же приём активно применяется в коммерческих пакетах: <code>spatie/laravel-permission</code>, <code>spatie/laravel-multitenancy</code>, <code>tenancy/tenancy</code>.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень механизмов</div>

    <div class="card">
      <h3>Локальный scope: декларация</h3>
      <p class="text">Метод модели с префиксом <code>scope</code> и аргументом-построителем запросов. При вызове из контекста модели (статически или цепочкой) префикс отбрасывается, имя приводится к camelCase: <code>scopeActive</code> вызывается как <code>active()</code>.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Builder</span>;

<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-comment">// Простой scope без параметров.</span>
    <span class="c-key">public function</span> <span class="c-fn">scopeActive</span>(<span class="c-type">Builder</span> <span class="c-var">$query</span>): <span class="c-type">Builder</span>
    {
        <span class="c-key">return</span> <span class="c-var">$query</span>-><span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'active'</span>);
    }

    <span class="c-comment">// Scope с параметром.</span>
    <span class="c-key">public function</span> <span class="c-fn">scopeOfRole</span>(<span class="c-type">Builder</span> <span class="c-var">$query</span>, <span class="c-key">string</span> <span class="c-var">$role</span>): <span class="c-type">Builder</span>
    {
        <span class="c-key">return</span> <span class="c-var">$query</span>-><span class="c-fn">where</span>(<span class="c-str">'role'</span>, <span class="c-var">$role</span>);
    }

    <span class="c-comment">// Scope, инкапсулирующий несколько условий и подзапрос.</span>
    <span class="c-key">public function</span> <span class="c-fn">scopeWithActiveSubscription</span>(<span class="c-type">Builder</span> <span class="c-var">$query</span>): <span class="c-type">Builder</span>
    {
        <span class="c-key">return</span> <span class="c-var">$query</span>-><span class="c-fn">whereHas</span>(<span class="c-str">'subscription'</span>, <span class="c-key">function</span> (<span class="c-type">Builder</span> <span class="c-var">$q</span>) {
            <span class="c-var">$q</span>-><span class="c-fn">whereNull</span>(<span class="c-str">'cancelled_at'</span>)
              -><span class="c-fn">where</span>(<span class="c-str">'expires_at'</span>, <span class="c-str">'&gt;'</span>, <span class="c-fn">now</span>());
        });
    }
}

<span class="c-comment">// Использование</span>
<span class="c-type">User</span>::<span class="c-fn">active</span>()-><span class="c-fn">get</span>();
<span class="c-type">User</span>::<span class="c-fn">active</span>()-><span class="c-fn">ofRole</span>(<span class="c-str">'admin'</span>)-><span class="c-fn">get</span>();
<span class="c-type">User</span>::<span class="c-fn">withActiveSubscription</span>()-><span class="c-fn">orderBy</span>(<span class="c-str">'name'</span>)-><span class="c-fn">paginate</span>(<span class="c-num">20</span>);
</code></pre>
      <p class="text">Возврат <code>$query</code> из scope формально не обязателен (методы query builder возвращают сам построитель), но является явной документацией намерения и удобен при анализе кода.</p>
    </div>

    <div class="card">
      <h3>Локальный scope: новый PHP-атрибутный синтаксис (Laravel 11+)</h3>
      <p class="text">Начиная с Laravel 11, поддерживается альтернативная декларация scope через PHP-атрибут <code>#[Scope]</code>. Префикс <code>scope</code> в имени метода не требуется.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Attributes\Scope</span>;

<span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    #[<span class="c-type">Scope</span>]
    <span class="c-key">protected function</span> <span class="c-fn">published</span>(<span class="c-type">Builder</span> <span class="c-var">$query</span>): <span class="c-type">Builder</span>
    {
        <span class="c-key">return</span> <span class="c-var">$query</span>-><span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'published'</span>);
    }
}

<span class="c-type">Post</span>::<span class="c-fn">published</span>()-><span class="c-fn">get</span>();
</code></pre>
      <p class="text">Оба синтаксиса равноценны функционально; атрибутный вариант предпочтительнее в новых проектах за счёт явного объявления намерения.</p>
    </div>

    <div class="card">
      <h3>Глобальный scope как отдельный класс</h3>
      <p class="text">Реализация интерфейса <code>Illuminate\Database\Eloquent\Scope</code>. Класс должен содержать единственный метод <code>apply(Builder $builder, Model $model)</code>, в котором накладываются условия. Регистрация выполняется методом <code>addGlobalScope()</code> в обратном вызове <code>booted()</code> модели.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Builder</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Model</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Scope</span>;

<span class="c-key">final class</span> <span class="c-type">TenantScope</span> <span class="c-key">implements</span> <span class="c-type">Scope</span>
{
    <span class="c-key">public function</span> <span class="c-fn">apply</span>(<span class="c-type">Builder</span> <span class="c-var">$builder</span>, <span class="c-type">Model</span> <span class="c-var">$model</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$tenantId</span> = <span class="c-fn">app</span>(<span class="c-type">TenantManager</span>::<span class="c-key">class</span>)-><span class="c-fn">currentTenantId</span>();

        <span class="c-key">if</span> (<span class="c-var">$tenantId</span> !== <span class="c-key">null</span>) {
            <span class="c-var">$builder</span>-><span class="c-fn">where</span>(<span class="c-var">$model</span>-><span class="c-fn">qualifyColumn</span>(<span class="c-str">'tenant_id'</span>), <span class="c-var">$tenantId</span>);
        }
    }
}

<span class="c-key">class</span> <span class="c-type">Project</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected static function</span> <span class="c-fn">booted</span>(): <span class="c-key">void</span>
    {
        <span class="c-key">static</span>::<span class="c-fn">addGlobalScope</span>(<span class="c-key">new</span> <span class="c-type">TenantScope</span>());
    }
}

<span class="c-comment">// Все запросы Project автоматически дополняются условием по tenant_id:</span>
<span class="c-type">Project</span>::<span class="c-fn">all</span>();
<span class="c-type">Project</span>::<span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'active'</span>)-><span class="c-fn">get</span>();
<span class="c-type">Project</span>::<span class="c-fn">find</span>(<span class="c-num">42</span>);
</code></pre>
      <p class="text">Метод <code>qualifyColumn()</code> возвращает имя колонки с префиксом таблицы (<code>projects.tenant_id</code>), что критично при использовании JOIN: без квалификации возможна ошибка <code>ambiguous column</code>.</p>
    </div>

    <div class="card">
      <h3>Глобальный scope через замыкание</h3>
      <p class="text">Для простых случаев класс не обязателен: <code>addGlobalScope()</code> принимает имя scope и замыкание. Имя используется при последующем удалении scope из запроса.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected static function</span> <span class="c-fn">booted</span>(): <span class="c-key">void</span>
    {
        <span class="c-key">static</span>::<span class="c-fn">addGlobalScope</span>(<span class="c-str">'published'</span>, <span class="c-key">function</span> (<span class="c-type">Builder</span> <span class="c-var">$builder</span>): <span class="c-key">void</span> {
            <span class="c-var">$builder</span>-><span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'published'</span>);
        });
    }
}
</code></pre>
    </div>

    <div class="card">
      <h3>Управление глобальными scope в конкретном запросе</h3>
      <p class="text">Когда требуется получить данные в обход глобального условия (например, в админ-панели или фоновой задаче), scope временно отключается.</p>
      <table class="data-table">
        <tr><th>Метод</th><th>Действие</th></tr>
        <tr><td><code>withoutGlobalScope(Class::class)</code></td><td>Отключает один scope, переданный по классу или строковому имени.</td></tr>
        <tr><td><code>withoutGlobalScopes()</code></td><td>Отключает все scopes у текущего запроса.</td></tr>
        <tr><td><code>withoutGlobalScopes([A::class, B::class])</code></td><td>Отключает указанный список scopes.</td></tr>
      </table>
<pre><code><span class="c-comment">// Получить заявки всех арендаторов из админ-панели.</span>
<span class="c-type">Project</span>::<span class="c-fn">withoutGlobalScope</span>(<span class="c-type">TenantScope</span>::<span class="c-key">class</span>)-><span class="c-fn">get</span>();

<span class="c-comment">// Системный обходчик без фильтров и soft-delete-учёта.</span>
<span class="c-type">Project</span>::<span class="c-fn">withoutGlobalScopes</span>()-><span class="c-fn">chunkById</span>(<span class="c-num">500</span>, ...);

<span class="c-comment">// Phone-confirmation worker — снимает только tenant, но сохраняет soft-deletes.</span>
<span class="c-type">Project</span>::<span class="c-fn">withoutGlobalScopes</span>([<span class="c-type">TenantScope</span>::<span class="c-key">class</span>])-><span class="c-fn">get</span>();
</code></pre>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: мультитенантный SaaS</div>

    <p class="text">Рассмотрим типичную многоарендную (multi-tenant) SaaS-платформу, в которой пользователи нескольких организаций работают в одной базе данных, но каждый видит только данные своей. Глобальный <code>TenantScope</code> гарантирует автоматическую изоляцию; локальные scope упрощают повседневные фильтры.</p>

    <p class="text">Сервис, хранящий идентификатор текущего арендатора в контейнере:</p>
<pre><code><span class="c-key">final class</span> <span class="c-type">TenantManager</span>
{
    <span class="c-key">private</span> ?<span class="c-key">int</span> <span class="c-var">$tenantId</span> = <span class="c-key">null</span>;

    <span class="c-key">public function</span> <span class="c-fn">setCurrentTenantId</span>(?<span class="c-key">int</span> <span class="c-var">$id</span>): <span class="c-key">void</span>  { <span class="c-var">$this</span>-><span class="c-var">tenantId</span> = <span class="c-var">$id</span>; }
    <span class="c-key">public function</span> <span class="c-fn">currentTenantId</span>(): ?<span class="c-key">int</span>                  { <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-var">tenantId</span>; }
}

<span class="c-comment">// Регистрация как singleton в провайдере.</span>
<span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">TenantManager</span>::<span class="c-key">class</span>);
</code></pre>

    <p class="text">Middleware определяет арендатора по поддомену запроса и устанавливает его в менеджер:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">SetCurrentTenant</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>, <span class="c-type">Closure</span> <span class="c-var">$next</span>): <span class="c-type">Response</span>
    {
        <span class="c-var">$subdomain</span> = <span class="c-fn">explode</span>(<span class="c-str">'.'</span>, <span class="c-var">$request</span>-><span class="c-fn">getHost</span>())[<span class="c-num">0</span>];
        <span class="c-var">$tenant</span>    = <span class="c-type">Tenant</span>::<span class="c-fn">where</span>(<span class="c-str">'slug'</span>, <span class="c-var">$subdomain</span>)-><span class="c-fn">firstOrFail</span>();

        <span class="c-fn">app</span>(<span class="c-type">TenantManager</span>::<span class="c-key">class</span>)-><span class="c-fn">setCurrentTenantId</span>(<span class="c-var">$tenant</span>-><span class="c-var">id</span>);

        <span class="c-key">return</span> <span class="c-var">$next</span>(<span class="c-var">$request</span>);
    }
}
</code></pre>

    <p class="text">Глобальный scope, накладываемый на все тенант-зависимые модели через трейт:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Builder</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Model</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Scope</span>;

<span class="c-key">final class</span> <span class="c-type">TenantScope</span> <span class="c-key">implements</span> <span class="c-type">Scope</span>
{
    <span class="c-key">public function</span> <span class="c-fn">apply</span>(<span class="c-type">Builder</span> <span class="c-var">$builder</span>, <span class="c-type">Model</span> <span class="c-var">$model</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$tenantId</span> = <span class="c-fn">app</span>(<span class="c-type">TenantManager</span>::<span class="c-key">class</span>)-><span class="c-fn">currentTenantId</span>();
        <span class="c-key">if</span> (<span class="c-var">$tenantId</span> !== <span class="c-key">null</span>) {
            <span class="c-var">$builder</span>-><span class="c-fn">where</span>(<span class="c-var">$model</span>-><span class="c-fn">qualifyColumn</span>(<span class="c-str">'tenant_id'</span>), <span class="c-var">$tenantId</span>);
        }
    }
}

<span class="c-key">trait</span> <span class="c-type">BelongsToTenant</span>
{
    <span class="c-key">public static function</span> <span class="c-fn">bootBelongsToTenant</span>(): <span class="c-key">void</span>
    {
        <span class="c-key">static</span>::<span class="c-fn">addGlobalScope</span>(<span class="c-key">new</span> <span class="c-type">TenantScope</span>());

        <span class="c-comment">// Автоматически подставлять tenant_id при создании.</span>
        <span class="c-key">static</span>::<span class="c-fn">creating</span>(<span class="c-key">function</span> (<span class="c-type">Model</span> <span class="c-var">$model</span>): <span class="c-key">void</span> {
            <span class="c-key">if</span> (<span class="c-var">$model</span>-><span class="c-var">tenant_id</span> === <span class="c-key">null</span>) {
                <span class="c-var">$model</span>-><span class="c-var">tenant_id</span> = <span class="c-fn">app</span>(<span class="c-type">TenantManager</span>::<span class="c-key">class</span>)-><span class="c-fn">currentTenantId</span>();
            }
        });
    }

    <span class="c-key">public function</span> <span class="c-fn">tenant</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsTo</span>(<span class="c-type">Tenant</span>::<span class="c-key">class</span>);
    }
}

<span class="c-key">class</span> <span class="c-type">Project</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">use</span> <span class="c-type">BelongsToTenant</span>;

    <span class="c-key">public function</span> <span class="c-fn">scopeArchived</span>(<span class="c-type">Builder</span> <span class="c-var">$query</span>): <span class="c-type">Builder</span>
    {
        <span class="c-key">return</span> <span class="c-var">$query</span>-><span class="c-fn">whereNotNull</span>(<span class="c-str">'archived_at'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">scopeOwnedBy</span>(<span class="c-type">Builder</span> <span class="c-var">$query</span>, <span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-type">Builder</span>
    {
        <span class="c-key">return</span> <span class="c-var">$query</span>-><span class="c-fn">where</span>(<span class="c-str">'owner_user_id'</span>, <span class="c-var">$user</span>-><span class="c-var">id</span>);
    }
}
</code></pre>

    <p class="text">Типовые операции в коде приложения:</p>
<pre><code><span class="c-comment">// 1. Обычные пользовательские запросы — TenantScope невидим, фильтр накладывается автоматически.</span>
<span class="c-var">$projects</span> = <span class="c-type">Project</span>::<span class="c-fn">latest</span>()-><span class="c-fn">paginate</span>(<span class="c-num">20</span>);
<span class="c-comment">// SELECT * FROM projects WHERE tenant_id = ? ORDER BY ... LIMIT 20</span>

<span class="c-comment">// 2. Комбинация локальных scope с глобальным.</span>
<span class="c-var">$myArchived</span> = <span class="c-type">Project</span>::<span class="c-fn">archived</span>()-><span class="c-fn">ownedBy</span>(<span class="c-var">$user</span>)-><span class="c-fn">get</span>();

<span class="c-comment">// 3. Системная задача аналитики, обходящая все тенанты.</span>
<span class="c-type">Project</span>::<span class="c-fn">withoutGlobalScope</span>(<span class="c-type">TenantScope</span>::<span class="c-key">class</span>)
    -><span class="c-fn">selectRaw</span>(<span class="c-str">'tenant_id, COUNT(*) as cnt'</span>)
    -><span class="c-fn">groupBy</span>(<span class="c-str">'tenant_id'</span>)
    -><span class="c-fn">get</span>();

<span class="c-comment">// 4. Artisan-команда для миграции данных одного конкретного тенанта.</span>
<span class="c-fn">app</span>(<span class="c-type">TenantManager</span>::<span class="c-key">class</span>)-><span class="c-fn">setCurrentTenantId</span>(<span class="c-var">$argTenantId</span>);
<span class="c-type">Project</span>::<span class="c-fn">archived</span>()-><span class="c-fn">chunkById</span>(<span class="c-num">200</span>, <span class="c-key">function</span> (<span class="c-var">$batch</span>) {
    <span class="c-comment">// бизнес-логика</span>
});

<span class="c-comment">// 5. Создание проекта: tenant_id подставляется автоматически из BelongsToTenant.</span>
<span class="c-type">Project</span>::<span class="c-fn">create</span>([<span class="c-str">'name'</span> =&gt; <span class="c-str">'Q4 Roadmap'</span>, <span class="c-str">'owner_user_id'</span> =&gt; <span class="c-fn">auth</span>()-><span class="c-fn">id</span>()]);
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. Отсутствие контекста при работе глобального scope.</strong> Если scope опирается на состояние, доступное только в HTTP-запросе (текущий пользователь, идентификатор арендатора), его выполнение в Artisan-команде, очереди или системной задаче приведёт к одному из двух исходов: либо запрос вернёт пустой результат (контекст не установлен), либо ошибочно выберет данные «по умолчанию». Перед выполнением системных задач необходимо явно установить контекст или отключить scope через <code>withoutGlobalScope</code>.
    </div>

    <div class="pitfall">
      <strong>2. Неоднозначность колонок при JOIN.</strong> Если scope накладывает условие <code>where('tenant_id', ...)</code>, а запрос содержит JOIN с другой таблицей, в которой также есть колонка <code>tenant_id</code>, SQL завершится ошибкой <code>ambiguous column</code>. Решение &mdash; всегда использовать <code>qualifyColumn()</code> в scope.
    </div>

    <div class="pitfall">
      <strong>3. Глобальный scope не применяется к raw-запросам.</strong> Конструкции вида <code>DB::table('projects')-&gt;get()</code> не проходят через цикл Eloquent и игнорируют все глобальные scopes. Для запросов с обходом ORM фильтрация требуется вручную.
    </div>

    <div class="pitfall">
      <strong>4. Локальный scope и <code>orWhere</code>.</strong> Условия внутри scope, объединённые с внешним <code>orWhere</code>, могут давать неожиданный результат из-за приоритета операторов. Например, <code>User::active()-&gt;orWhere('role', 'admin')</code> формирует SQL <code>WHERE status = 'active' OR role = 'admin'</code>, что соответствует «либо активный, либо администратор». Для корректной группировки используйте замыкание: <code>User::active()-&gt;orWhere(fn($q) =&gt; $q-&gt;where('role', 'admin'))</code>, либо явное <code>where(function ($q) { ... })</code>.
    </div>

    <div class="pitfall">
      <strong>5. Глобальный scope и <code>insert</code>/<code>update</code>.</strong> Bulk-операции через построитель запросов (<code>Project::query()-&gt;update(...)</code>) выполняют scope-условия в <code>WHERE</code>. Это означает, что <code>update</code> затронет только записи, прошедшие фильтр &mdash; что обычно и желаемое поведение, но требует осознанности при системных миграциях данных.
    </div>

    <div class="pitfall">
      <strong>6. Порядок применения глобальных scopes.</strong> Несколько глобальных scopes применяются в порядке регистрации. Если один зависит от другого (например, второй ожидает уже наложенный JOIN), порядок имеет значение. Регистрируйте scopes явно и не полагайтесь на «случайный» порядок при использовании трейтов.
    </div>

    <div class="pitfall">
      <strong>7. Тестирование с глобальными scopes.</strong> При написании unit-тестов фабрика может неожиданно не находить созданные ею же записи, если scope требует контекста (например, тенанта). В тестах необходимо либо установить контекст до запросов, либо отключать scope через <code>withoutGlobalScopes()</code>.
    </div>

    <div class="pitfall">
      <strong>8. Зависимость от глобального scope как меры безопасности.</strong> Глобальный scope &mdash; удобный механизм, но он защищает только в той мере, в какой выполняется. Любой запрос, выполненный с <code>withoutGlobalScope</code> или через <code>DB::table()</code>, его обходит. Для критичных требований изоляции данных (например, регуляторных) применяется дополнительная проверка на уровне политик, ограничений БД (row-level security) или отдельных схем.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     QUERIES — SOFT DELETES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-query-softdel" class="section">
  <div class="section-title">Soft Deletes</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Soft Deletes &mdash; механизм логического удаления, при котором запись остаётся в таблице, но помечается как удалённая через timestamp в специальной колонке <code>deleted_at</code>. Eloquent автоматически исключает помеченные записи из стандартных выборок, оставляя возможность восстановления и аудита.</p>
    <p class="text">Технически реализован через глобальный scope <code>SoftDeletingScope</code>, добавляющий условие <code>deleted_at IS NULL</code> ко всем запросам модели, и переопределённый метод <code>delete()</code>, который вместо SQL <code>DELETE</code> выполняет <code>UPDATE</code>, устанавливая текущее время в <code>deleted_at</code>.</p>
    <p class="text">Применяется в нескольких типовых сценариях: пользователю предоставляется возможность отменить удаление (корзина, восстановление аккаунта), система обязана сохранять историю изменений для аудита или регуляторных требований, удаление родительской записи не должно нарушать ссылочную целостность для связанных записей в логах и архивах. Альтернативой soft delete служит выделенная архивная таблица или event-sourcing, однако soft delete сохраняет простоту работы с одной таблицей и сохраняет существующие индексы.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень компонентов</div>

    <div class="card">
      <h3>Подключение к модели</h3>
      <p class="text">Активация включает два шага: добавление колонки <code>deleted_at</code> в миграции и подключение трейта <code>SoftDeletes</code> к модели. Трейт автоматически регистрирует глобальный scope и подменяет поведение метода <code>delete()</code>.</p>
<pre><code><span class="c-comment">// Миграция</span>
<span class="c-type">Schema</span>::<span class="c-fn">create</span>(<span class="c-str">'posts'</span>, <span class="c-key">function</span> (<span class="c-type">Blueprint</span> <span class="c-var">$table</span>) {
    <span class="c-var">$table</span>-><span class="c-fn">id</span>();
    <span class="c-var">$table</span>-><span class="c-fn">string</span>(<span class="c-str">'title'</span>);
    <span class="c-var">$table</span>-><span class="c-fn">text</span>(<span class="c-str">'body'</span>);
    <span class="c-var">$table</span>-><span class="c-fn">timestamps</span>();
    <span class="c-var">$table</span>-><span class="c-fn">softDeletes</span>();  <span class="c-comment">// добавляет колонку deleted_at TIMESTAMP NULL</span>
});

<span class="c-comment">// Модель</span>
<span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\SoftDeletes</span>;

<span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">use</span> <span class="c-type">SoftDeletes</span>;
}
</code></pre>
      <p class="text">Имя колонки можно изменить, переопределив константу <code>DELETED_AT</code> или свойство <code>$deletedAtColumn</code> (в Laravel 12+). Это полезно при работе с legacy-схемами, в которых поле называется иначе (<code>removed_at</code>, <code>archived_at</code>).</p>
    </div>

    <div class="card">
      <h3>Операции с моделью</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>Поведение</th></tr>
        <tr><td><code>$model-&gt;delete()</code></td><td>Логическое удаление: устанавливает <code>deleted_at = now()</code>.</td></tr>
        <tr><td><code>$model-&gt;forceDelete()</code></td><td>Физическое удаление: выполняет SQL <code>DELETE</code>, обходя soft-delete.</td></tr>
        <tr><td><code>$model-&gt;restore()</code></td><td>Восстановление: устанавливает <code>deleted_at = NULL</code>.</td></tr>
        <tr><td><code>$model-&gt;trashed()</code></td><td>Возвращает <code>true</code>, если запись помечена удалённой.</td></tr>
        <tr><td><code>Model::onlyTrashed()</code></td><td>Построитель, выбирающий только удалённые записи.</td></tr>
        <tr><td><code>Model::withTrashed()</code></td><td>Построитель, включающий и активные, и удалённые записи.</td></tr>
        <tr><td><code>Model::withoutTrashed()</code></td><td>Явное исключение удалённых (поведение по умолчанию). Полезно, когда требуется отменить активированный ранее <code>withTrashed</code>.</td></tr>
      </table>
<pre><code><span class="c-var">$post</span>-><span class="c-fn">delete</span>();
<span class="c-comment">// UPDATE posts SET deleted_at = NOW() WHERE id = ?</span>

<span class="c-var">$post</span>-><span class="c-fn">restore</span>();
<span class="c-comment">// UPDATE posts SET deleted_at = NULL WHERE id = ?</span>

<span class="c-var">$post</span>-><span class="c-fn">forceDelete</span>();
<span class="c-comment">// DELETE FROM posts WHERE id = ?</span>

<span class="c-comment">// Запросы</span>
<span class="c-type">Post</span>::<span class="c-fn">all</span>();                        <span class="c-comment">// только активные (deleted_at IS NULL)</span>
<span class="c-type">Post</span>::<span class="c-fn">withTrashed</span>()-><span class="c-fn">get</span>();          <span class="c-comment">// все записи включая удалённые</span>
<span class="c-type">Post</span>::<span class="c-fn">onlyTrashed</span>()-><span class="c-fn">get</span>();          <span class="c-comment">// только удалённые</span>
<span class="c-type">Post</span>::<span class="c-fn">withTrashed</span>()-><span class="c-fn">find</span>(<span class="c-var">$id</span>);     <span class="c-comment">// найти, даже если удалён</span>
</code></pre>
    </div>

    <div class="card">
      <h3>События модели</h3>
      <p class="text">Soft delete добавляет два собственных события Eloquent: <code>trashed</code> (после успешного логического удаления) и <code>restoring</code>/<code>restored</code> (до и после восстановления). Стандартные <code>deleting</code>/<code>deleted</code> вызываются и при soft delete, и при <code>forceDelete</code> &mdash; различить их можно через метод <code>isForceDeleting()</code>.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">PostObserver</span>
{
    <span class="c-key">public function</span> <span class="c-fn">deleting</span>(<span class="c-type">Post</span> <span class="c-var">$post</span>): <span class="c-key">void</span>
    {
        <span class="c-key">if</span> (<span class="c-var">$post</span>-><span class="c-fn">isForceDeleting</span>()) {
            <span class="c-comment">// окончательное удаление — стираем связанные файлы</span>
            <span class="c-type">Storage</span>::<span class="c-fn">delete</span>(<span class="c-var">$post</span>-><span class="c-var">attachments</span>-><span class="c-fn">pluck</span>(<span class="c-str">'path'</span>)-><span class="c-fn">all</span>());
        } <span class="c-key">else</span> {
            <span class="c-comment">// soft delete — каскад на связанные сущности</span>
            <span class="c-var">$post</span>-><span class="c-fn">comments</span>()-><span class="c-fn">delete</span>();
        }
    }

    <span class="c-key">public function</span> <span class="c-fn">restored</span>(<span class="c-type">Post</span> <span class="c-var">$post</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$post</span>-><span class="c-fn">comments</span>()-><span class="c-fn">onlyTrashed</span>()-><span class="c-fn">restore</span>();
    }
}
</code></pre>
    </div>

    <div class="card">
      <h3>Soft delete на отношениях</h3>
      <p class="text">При обращении к связанным моделям <code>SoftDeletes</code> применяется к каждой из них по отдельности. Если родительская модель использует soft delete, а дочерняя нет (или наоборот), это может приводить к ситуациям, когда у удалённого родителя «висят» активные дочерние записи. Для согласованного поведения трейт подключается ко всем участникам цепочки, а каскад реализуется явно в observer.</p>
<pre><code><span class="c-comment">// На уже удалённой модели relation выбирает только живые дочерние.</span>
<span class="c-var">$post</span>-><span class="c-fn">delete</span>();
<span class="c-var">$post</span>-><span class="c-var">comments</span>;                          <span class="c-comment">// только активные комментарии</span>
<span class="c-var">$post</span>-><span class="c-fn">comments</span>()-><span class="c-fn">withTrashed</span>()-><span class="c-fn">get</span>();   <span class="c-comment">// все, включая удалённые</span>
</code></pre>
    </div>

    <div class="card">
      <h3>Массовое восстановление</h3>
      <p class="text">Метод <code>restore()</code> на построителе запросов восстанавливает все записи, удовлетворяющие условию. Применяется в bulk-сценариях: восстановление всех записей пользователя при его реактивации, отмена ошибочного массового удаления.</p>
<pre><code><span class="c-type">Post</span>::<span class="c-fn">onlyTrashed</span>()
    -><span class="c-fn">where</span>(<span class="c-str">'user_id'</span>, <span class="c-var">$user</span>-><span class="c-var">id</span>)
    -><span class="c-fn">restore</span>();
<span class="c-comment">// UPDATE posts SET deleted_at = NULL WHERE deleted_at IS NOT NULL AND user_id = ?</span>
</code></pre>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: корзина с возможностью восстановления</div>

    <p class="text">Рассмотрим административную панель CMS, в которой статьи удаляются логически. Пользователю в течение 30 дней доступно восстановление из корзины, после чего отдельная задача физически очищает старые записи. При окончательном удалении статьи освобождаются связанные файлы из хранилища, а при логическом удалении каскадом удаляются комментарии и реакции.</p>

    <p class="text">Структура моделей и схемы:</p>
<pre><code><span class="c-type">Schema</span>::<span class="c-fn">create</span>(<span class="c-str">'posts'</span>, <span class="c-key">function</span> (<span class="c-type">Blueprint</span> <span class="c-var">$table</span>) {
    <span class="c-var">$table</span>-><span class="c-fn">id</span>();
    <span class="c-var">$table</span>-><span class="c-fn">foreignId</span>(<span class="c-str">'user_id'</span>)-><span class="c-fn">constrained</span>();
    <span class="c-var">$table</span>-><span class="c-fn">string</span>(<span class="c-str">'slug'</span>);
    <span class="c-var">$table</span>-><span class="c-fn">string</span>(<span class="c-str">'title'</span>);
    <span class="c-var">$table</span>-><span class="c-fn">text</span>(<span class="c-str">'body'</span>);
    <span class="c-var">$table</span>-><span class="c-fn">json</span>(<span class="c-str">'attachments'</span>)-><span class="c-fn">nullable</span>();
    <span class="c-var">$table</span>-><span class="c-fn">timestamps</span>();
    <span class="c-var">$table</span>-><span class="c-fn">softDeletes</span>();

    <span class="c-comment">// Условный (partial) уникальный индекс на slug — только среди активных записей,</span>
    <span class="c-comment">// чтобы освободить slug после soft delete и не блокировать переиспользование.</span>
    <span class="c-comment">// Синтаксис специфичен СУБД: для PostgreSQL ниже, для MySQL 8 — generated column.</span>
});

<span class="c-comment">// PostgreSQL partial unique index</span>
<span class="c-type">DB</span>::<span class="c-fn">statement</span>(<span class="c-str">'CREATE UNIQUE INDEX posts_slug_unique ON posts(slug) WHERE deleted_at IS NULL'</span>);

<span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">use</span> <span class="c-type">SoftDeletes</span>;

    <span class="c-key">protected</span> <span class="c-var">$casts</span> = [
        <span class="c-str">'attachments'</span> =&gt; <span class="c-str">'array'</span>,
    ];

    <span class="c-key">public function</span> <span class="c-fn">comments</span>(): <span class="c-type">HasMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">hasMany</span>(<span class="c-type">Comment</span>::<span class="c-key">class</span>);
    }
}

<span class="c-key">class</span> <span class="c-type">Comment</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">use</span> <span class="c-type">SoftDeletes</span>;
}
</code></pre>

    <p class="text">Observer, реализующий каскадное поведение:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Storage</span>;

<span class="c-key">class</span> <span class="c-type">PostObserver</span>
{
    <span class="c-key">public function</span> <span class="c-fn">deleting</span>(<span class="c-type">Post</span> <span class="c-var">$post</span>): <span class="c-key">void</span>
    {
        <span class="c-key">if</span> (<span class="c-var">$post</span>-><span class="c-fn">isForceDeleting</span>()) {
            <span class="c-comment">// Окончательное удаление — освобождаем хранилище и удаляем связанные.</span>
            <span class="c-key">foreach</span> ((<span class="c-key">array</span>) <span class="c-var">$post</span>-><span class="c-var">attachments</span> <span class="c-key">as</span> <span class="c-var">$path</span>) {
                <span class="c-type">Storage</span>::<span class="c-fn">delete</span>(<span class="c-var">$path</span>);
            }
            <span class="c-var">$post</span>-><span class="c-fn">comments</span>()-><span class="c-fn">withTrashed</span>()-><span class="c-fn">forceDelete</span>();
        } <span class="c-key">else</span> {
            <span class="c-comment">// Логическое удаление — каскад только в пределах живых дочерних.</span>
            <span class="c-var">$post</span>-><span class="c-fn">comments</span>()-><span class="c-fn">delete</span>();
        }
    }

    <span class="c-key">public function</span> <span class="c-fn">restored</span>(<span class="c-type">Post</span> <span class="c-var">$post</span>): <span class="c-key">void</span>
    {
        <span class="c-comment">// При восстановлении возвращаем комментарии, удалённые именно вместе с постом.</span>
        <span class="c-var">$post</span>-><span class="c-fn">comments</span>()
            -><span class="c-fn">onlyTrashed</span>()
            -><span class="c-fn">where</span>(<span class="c-str">'deleted_at'</span>, <span class="c-str">'&gt;='</span>, <span class="c-var">$post</span>-><span class="c-var">deleted_at</span>)
            -><span class="c-fn">where</span>(<span class="c-str">'deleted_at'</span>, <span class="c-str">'&lt;='</span>, <span class="c-var">$post</span>-><span class="c-var">deleted_at</span>-><span class="c-fn">addSeconds</span>(<span class="c-num">5</span>))
            -><span class="c-fn">restore</span>();
    }
}
</code></pre>

    <p class="text">Контроллер корзины и операций восстановления:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">TrashController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-comment">// 1. Просмотр корзины: только удалённые записи текущего пользователя.</span>
    <span class="c-key">public function</span> <span class="c-fn">index</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>): <span class="c-type">View</span>
    {
        <span class="c-var">$posts</span> = <span class="c-type">Post</span>::<span class="c-fn">onlyTrashed</span>()
            -><span class="c-fn">where</span>(<span class="c-str">'user_id'</span>, <span class="c-var">$request</span>-><span class="c-fn">user</span>()-><span class="c-var">id</span>)
            -><span class="c-fn">orderByDesc</span>(<span class="c-str">'deleted_at'</span>)
            -><span class="c-fn">paginate</span>(<span class="c-num">20</span>);

        <span class="c-key">return</span> <span class="c-fn">view</span>(<span class="c-str">'trash.index'</span>, <span class="c-fn">compact</span>(<span class="c-str">'posts'</span>));
    }

    <span class="c-comment">// 2. Восстановление: поиск по withTrashed, чтобы найти даже удалённую запись.</span>
    <span class="c-key">public function</span> <span class="c-fn">restore</span>(<span class="c-key">int</span> <span class="c-var">$id</span>): <span class="c-type">RedirectResponse</span>
    {
        <span class="c-var">$post</span> = <span class="c-type">Post</span>::<span class="c-fn">withTrashed</span>()-><span class="c-fn">findOrFail</span>(<span class="c-var">$id</span>);
        <span class="c-var">$post</span>-><span class="c-fn">restore</span>();

        <span class="c-key">return</span> <span class="c-fn">redirect</span>()-><span class="c-fn">route</span>(<span class="c-str">'posts.show'</span>, <span class="c-var">$post</span>);
    }

    <span class="c-comment">// 3. Окончательное удаление по запросу пользователя.</span>
    <span class="c-key">public function</span> <span class="c-fn">forceDelete</span>(<span class="c-key">int</span> <span class="c-var">$id</span>): <span class="c-type">RedirectResponse</span>
    {
        <span class="c-type">Post</span>::<span class="c-fn">withTrashed</span>()-><span class="c-fn">findOrFail</span>(<span class="c-var">$id</span>)-><span class="c-fn">forceDelete</span>();

        <span class="c-key">return</span> <span class="c-fn">redirect</span>()-><span class="c-fn">route</span>(<span class="c-str">'trash.index'</span>);
    }
}
</code></pre>

    <p class="text">Запланированная Artisan-команда, очищающая корзину старше 30 дней:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">PruneOldTrash</span> <span class="c-key">extends</span> <span class="c-type">Command</span>
{
    <span class="c-key">protected</span> <span class="c-var">$signature</span> = <span class="c-str">'trash:prune {--days=30}'</span>;

    <span class="c-key">public function</span> <span class="c-fn">handle</span>(): <span class="c-key">int</span>
    {
        <span class="c-var">$threshold</span> = <span class="c-fn">now</span>()-><span class="c-fn">subDays</span>((<span class="c-key">int</span>) <span class="c-var">$this</span>-><span class="c-fn">option</span>(<span class="c-str">'days'</span>));

        <span class="c-type">Post</span>::<span class="c-fn">onlyTrashed</span>()
            -><span class="c-fn">where</span>(<span class="c-str">'deleted_at'</span>, <span class="c-str">'&lt;'</span>, <span class="c-var">$threshold</span>)
            -><span class="c-fn">chunkById</span>(<span class="c-num">200</span>, <span class="c-key">function</span> (<span class="c-type">Collection</span> <span class="c-var">$batch</span>) {
                <span class="c-var">$batch</span>-><span class="c-fn">each</span>-><span class="c-fn">forceDelete</span>();
                <span class="c-comment">// Через каждый экземпляр — чтобы сработал observer с очисткой файлов.</span>
            });

        <span class="c-key">return</span> <span class="c-key">self</span>::<span class="c-key">SUCCESS</span>;
    }
}

<span class="c-comment">// app/Console/Kernel.php</span>
<span class="c-var">$schedule</span>-><span class="c-fn">command</span>(<span class="c-str">'trash:prune'</span>)-><span class="c-fn">dailyAt</span>(<span class="c-str">'03:00'</span>);
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. Уникальные ограничения и soft delete.</strong> Стандартный уникальный индекс БД не различает активные и удалённые записи: после soft delete пользователя с email <code>alice@example.com</code> повторная регистрация с тем же адресом будет отклонена СУБД. Решения: условный (partial) уникальный индекс <code>WHERE deleted_at IS NULL</code> (поддерживается PostgreSQL, SQLite, частично MySQL 8 через generated columns), либо валидация на уровне приложения через <code>Rule::unique('users')-&gt;whereNull('deleted_at')</code> &mdash; при этом БД-уровневая гарантия отсутствует.
    </div>

    <div class="pitfall">
      <strong>2. Cascade soft delete не работает «из коробки».</strong> Внешние ключи БД с <code>ON DELETE CASCADE</code> срабатывают только при физическом удалении. При soft delete родителя дочерние записи не затрагиваются. Каскад реализуется либо в observer (метод <code>deleting</code>), либо в сервис-классе, выполняющем удаление, либо через сторонние пакеты вроде <code>iatstuti/laravel-cascade-soft-deletes</code>.
    </div>

    <div class="pitfall">
      <strong>3. Eager loading и soft-deleted родители.</strong> При <code>Comment::with('post')-&gt;get()</code> метод <code>with</code> учитывает глобальный scope, поэтому комментарии к soft-deleted постам получат <code>$comment-&gt;post === null</code>. Для включения удалённых: <code>with(['post' =&gt; fn($q) =&gt; $q-&gt;withTrashed()])</code>.
    </div>

    <div class="pitfall">
      <strong>4. <code>find()</code> и <code>findOrFail()</code> игнорируют удалённые.</strong> Если требуется получить запись независимо от статуса (для админ-панели или восстановления), используется <code>Model::withTrashed()-&gt;find($id)</code>. Прямое обращение по <code>find</code> для удалённой записи вернёт <code>null</code>, что может неожиданно вести к 404.
    </div>

    <div class="pitfall">
      <strong>5. Route Model Binding и SoftDeletes.</strong> По умолчанию неявное связывание модели в маршрутах не включает удалённые записи. Для маршрутов корзины это требуется явно: либо через <code>Route::resource(...)-&gt;withTrashed()</code>, либо ручным разрешением модели в контроллере (<code>Post::withTrashed()-&gt;findOrFail($id)</code>).
    </div>

    <div class="pitfall">
      <strong>6. <code>forceDelete</code> игнорирует <code>SoftDeletes</code>-каскады.</strong> При окончательном удалении observer должен сам решить, что делать с дочерними записями: оставить их (нарушив ссылочную целостность, если нет FK), удалить логически, удалить физически. Реализация различается в зависимости от регуляторных требований (история комментариев может быть необходима даже после удаления статьи).
    </div>

    <div class="pitfall">
      <strong>7. Производительность запросов с большим количеством удалённых записей.</strong> Если таблица содержит миллионы soft-deleted строк, фильтр <code>deleted_at IS NULL</code> становится узким местом. Для PostgreSQL и MySQL рекомендуется частичный индекс или индекс <code>(deleted_at, frequently_queried_column)</code>. Альтернатива &mdash; периодическое перемещение старых удалённых записей в архивную таблицу через scheduled-задачу.
    </div>

    <div class="pitfall">
      <strong>8. Конфликт <code>$dates</code> и автоматического каста <code>deleted_at</code>.</strong> Трейт <code>SoftDeletes</code> сам добавляет <code>deleted_at</code> в массив <code>$casts</code> как <code>datetime</code>. В моделях, ранее использовавших устаревший массив <code>$dates</code>, дублирование может вызвать неожиданное поведение. Используйте только <code>$casts</code>; <code>$dates</code> считается устаревшим, начиная с Laravel 10.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     QUERIES — SUBQUERIES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-query-subquery" class="section">
  <div class="section-title">Subqueries и raw expressions</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Стандартные методы Query Builder (<code>where</code>, <code>join</code>, <code>orderBy</code>) покрывают большую часть запросов. Однако в продакшен-задачах регулярно требуется встроить подзапрос в SELECT-список, наложить условие <code>EXISTS</code>, выполнить арифметическое выражение или агрегатную функцию, для которых нет специализированного метода. Для таких случаев Eloquent предоставляет API подзапросов и сырых SQL-выражений.</p>
    <p class="text">Подзапросы (<code>addSelect</code>, <code>selectSub</code>, <code>whereExists</code>, <code>fromSub</code>) позволяют декларативно встроить SELECT внутрь SELECT, при этом сохраняя биндинг параметров и защиту от SQL-инъекций. Сырые выражения (<code>DB::raw</code>, <code>selectRaw</code>, <code>whereRaw</code>, <code>orderByRaw</code>) дают возможность вставить произвольный фрагмент SQL для случаев, когда даже API подзапросов недостаточен.</p>
    <p class="text">Сырой SQL &mdash; обоюдоострый инструмент. С одной стороны, он раскрывает полную мощь СУБД (оконные функции, выражения CASE, JSON-операторы PostgreSQL, специфичные функции). С другой стороны, при некорректном использовании он открывает уязвимость SQL-инъекции и ломает переносимость кода между разными СУБД. Главное правило: пользовательский ввод всегда передаётся через биндинг параметров, никогда не конкатенируется в строку SQL.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень механизмов</div>

    <div class="card">
      <h3><code>addSelect</code> и <code>selectSub</code>: подзапрос как столбец</h3>
      <p class="text">Позволяют добавить к выборке вычисляемый столбец, полученный из подзапроса. Применяется для отображения связанных агрегированных данных без N+1, без необходимости eager loading. Альтернатива <code>withSum</code>/<code>withAvg</code>, дающая полную свободу формулировки подзапроса.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">App\Models\Login</span>;

<span class="c-var">$users</span> = <span class="c-type">User</span>::<span class="c-fn">query</span>()
    -><span class="c-fn">addSelect</span>([
        <span class="c-str">'last_login_at'</span> =&gt; <span class="c-type">Login</span>::<span class="c-fn">select</span>(<span class="c-str">'created_at'</span>)
            -><span class="c-fn">whereColumn</span>(<span class="c-str">'logins.user_id'</span>, <span class="c-str">'users.id'</span>)
            -><span class="c-fn">orderByDesc</span>(<span class="c-str">'created_at'</span>)
            -><span class="c-fn">limit</span>(<span class="c-num">1</span>),
        <span class="c-str">'failed_attempts_7d'</span> =&gt; <span class="c-type">Login</span>::<span class="c-fn">selectRaw</span>(<span class="c-str">'COUNT(*)'</span>)
            -><span class="c-fn">whereColumn</span>(<span class="c-str">'logins.user_id'</span>, <span class="c-str">'users.id'</span>)
            -><span class="c-fn">where</span>(<span class="c-str">'success'</span>, <span class="c-key">false</span>)
            -><span class="c-fn">where</span>(<span class="c-str">'created_at'</span>, <span class="c-str">'&gt;='</span>, <span class="c-fn">now</span>()-><span class="c-fn">subWeek</span>()),
    ])
    -><span class="c-fn">get</span>();

<span class="c-fn">echo</span> <span class="c-var">$users</span>[<span class="c-num">0</span>]-><span class="c-var">last_login_at</span>;
<span class="c-fn">echo</span> <span class="c-var">$users</span>[<span class="c-num">0</span>]-><span class="c-var">failed_attempts_7d</span>;
</code></pre>
      <p class="text">Эквивалентный SQL:</p>
      <div class="diagram">SELECT users.*,
    (SELECT created_at FROM logins
     WHERE logins.user_id = users.id
     ORDER BY created_at DESC LIMIT 1) AS last_login_at,
    (SELECT COUNT(*) FROM logins
     WHERE logins.user_id = users.id
       AND success = 0 AND created_at &gt;= ?) AS failed_attempts_7d
FROM users;</div>
      <p class="text">Метод <code>orderBy()</code> также принимает построитель запросов как первый аргумент &mdash; это позволяет сортировать по значению, вычисленному подзапросом.</p>
    </div>

    <div class="card">
      <h3><code>fromSub</code> и <code>joinSub</code>: подзапрос как источник</h3>
      <p class="text">Когда необходимо выполнить агрегацию по результату другой агрегации, либо присоединить группированную выборку к основному запросу, подзапрос используется в качестве источника. <code>fromSub</code> подставляет его на место <code>FROM</code>, <code>joinSub</code> &mdash; на место <code>JOIN</code>.</p>
<pre><code><span class="c-comment">// Подзапрос: для каждого пользователя — последний оплаченный заказ.</span>
<span class="c-var">$latestPaid</span> = <span class="c-type">Order</span>::<span class="c-fn">select</span>(<span class="c-str">'user_id'</span>, <span class="c-type">DB</span>::<span class="c-fn">raw</span>(<span class="c-str">'MAX(paid_at) as last_paid_at'</span>))
    -><span class="c-fn">whereNotNull</span>(<span class="c-str">'paid_at'</span>)
    -><span class="c-fn">groupBy</span>(<span class="c-str">'user_id'</span>);

<span class="c-comment">// joinSub присоединяет результат к users одним SQL.</span>
<span class="c-var">$users</span> = <span class="c-type">User</span>::<span class="c-fn">query</span>()
    -><span class="c-fn">joinSub</span>(<span class="c-var">$latestPaid</span>, <span class="c-str">'lp'</span>, <span class="c-key">function</span> (<span class="c-var">$join</span>) {
        <span class="c-var">$join</span>-><span class="c-fn">on</span>(<span class="c-str">'lp.user_id'</span>, <span class="c-str">'='</span>, <span class="c-str">'users.id'</span>);
    })
    -><span class="c-fn">select</span>(<span class="c-str">'users.*'</span>, <span class="c-str">'lp.last_paid_at'</span>)
    -><span class="c-fn">get</span>();
</code></pre>
    </div>

    <div class="card">
      <h3><code>whereExists</code> и <code>whereNotExists</code></h3>
      <p class="text">Условие «существует хотя бы одна связанная запись, удовлетворяющая критерию». В отличие от <code>whereHas</code> (работающего через Eloquent relations), <code>whereExists</code> принимает произвольный построитель запросов и более универсален, особенно для подзапросов с JOIN или агрегатами.</p>
<pre><code><span class="c-comment">// Пользователи, оставившие хотя бы один комментарий за последние 30 дней.</span>
<span class="c-type">User</span>::<span class="c-fn">whereExists</span>(<span class="c-key">function</span> (<span class="c-type">Builder</span> <span class="c-var">$q</span>) {
    <span class="c-var">$q</span>-><span class="c-fn">selectRaw</span>(<span class="c-num">1</span>)
      -><span class="c-fn">from</span>(<span class="c-str">'comments'</span>)
      -><span class="c-fn">whereColumn</span>(<span class="c-str">'comments.user_id'</span>, <span class="c-str">'users.id'</span>)
      -><span class="c-fn">where</span>(<span class="c-str">'comments.created_at'</span>, <span class="c-str">'&gt;='</span>, <span class="c-fn">now</span>()-><span class="c-fn">subDays</span>(<span class="c-num">30</span>));
})-><span class="c-fn">get</span>();
</code></pre>
      <p class="text">Применение <code>SELECT 1</code> внутри подзапроса &mdash; общепринятая практика: значение не используется (важно только наличие хотя бы одной строки), но это сигнализирует СУБД о возможной оптимизации.</p>
    </div>

    <div class="card">
      <h3><code>DB::raw</code> и контекстные <code>selectRaw</code>/<code>whereRaw</code>/<code>orderByRaw</code></h3>
      <p class="text">Сырые SQL-выражения встраиваются в запрос напрямую. <code>DB::raw()</code> создаёт <code>Expression</code>, который Query Builder использует без экранирования. Контекстные методы (<code>selectRaw</code>, <code>whereRaw</code> и т. п.) являются обёртками с поддержкой биндингов.</p>
<pre><code><span class="c-comment">// selectRaw с биндингами параметров.</span>
<span class="c-type">Order</span>::<span class="c-fn">selectRaw</span>(<span class="c-str">'SUM(amount) as total, currency'</span>)
    -><span class="c-fn">groupBy</span>(<span class="c-str">'currency'</span>)
    -><span class="c-fn">get</span>();

<span class="c-comment">// whereRaw с биндингами — пользовательский ввод передаётся параметром, не конкатенируется.</span>
<span class="c-type">Post</span>::<span class="c-fn">whereRaw</span>(<span class="c-str">'views &gt; ? AND created_at &gt;= ?'</span>, [
    <span class="c-num">100</span>,
    <span class="c-fn">now</span>()-><span class="c-fn">subWeek</span>(),
])-><span class="c-fn">get</span>();

<span class="c-comment">// orderByRaw для сортировки по выражению (например, расстояние).</span>
<span class="c-type">Place</span>::<span class="c-fn">orderByRaw</span>(<span class="c-str">'ST_Distance(point, ST_MakePoint(?, ?))'</span>, [<span class="c-var">$lng</span>, <span class="c-var">$lat</span>])
    -><span class="c-fn">limit</span>(<span class="c-num">10</span>)
    -><span class="c-fn">get</span>();

<span class="c-comment">// havingRaw — для условий на агрегаты.</span>
<span class="c-type">Order</span>::<span class="c-fn">select</span>(<span class="c-str">'user_id'</span>)
    -><span class="c-fn">selectRaw</span>(<span class="c-str">'SUM(amount) as total'</span>)
    -><span class="c-fn">groupBy</span>(<span class="c-str">'user_id'</span>)
    -><span class="c-fn">havingRaw</span>(<span class="c-str">'SUM(amount) &gt; ?'</span>, [<span class="c-num">10000</span>])
    -><span class="c-fn">get</span>();
</code></pre>
    </div>

    <div class="card">
      <h3>Сводная таблица методов</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>Что вставляет</th><th>Поддержка биндингов</th></tr>
        <tr><td><code>DB::raw($sql)</code></td><td>Произвольный фрагмент SQL</td><td>Нет (биндинги добавляются отдельно)</td></tr>
        <tr><td><code>selectRaw($sql, $bindings)</code></td><td>В SELECT</td><td>Да</td></tr>
        <tr><td><code>whereRaw($sql, $bindings)</code></td><td>В WHERE</td><td>Да</td></tr>
        <tr><td><code>orderByRaw($sql, $bindings)</code></td><td>В ORDER BY</td><td>Да</td></tr>
        <tr><td><code>groupByRaw($sql, $bindings)</code></td><td>В GROUP BY</td><td>Да</td></tr>
        <tr><td><code>havingRaw($sql, $bindings)</code></td><td>В HAVING</td><td>Да</td></tr>
        <tr><td><code>addSelect(['alias' =&gt; $builder])</code></td><td>Скалярный подзапрос как столбец</td><td>Да (через построитель)</td></tr>
        <tr><td><code>fromSub($builder, 'alias')</code></td><td>Подзапрос в FROM</td><td>Да</td></tr>
        <tr><td><code>joinSub($builder, 'alias', $closure)</code></td><td>Подзапрос в JOIN</td><td>Да</td></tr>
        <tr><td><code>whereExists($closure)</code></td><td>EXISTS-подзапрос</td><td>Да</td></tr>
        <tr><td><code>whereColumn('a.x', 'b.y')</code></td><td>Сравнение двух колонок (для корреляций)</td><td>&mdash;</td></tr>
      </table>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: аналитический отчёт по пользователям</div>

    <p class="text">Рассмотрим страницу отчёта в админ-панели: для каждого пользователя необходимо отобразить число заказов, общую сумму, дату последнего заказа, число неудачных попыток входа за последние 7 дней, среднюю оценку оставленных отзывов. Все эти данные должны быть получены одним SQL-запросом, без N+1 и без множественных eager loadings.</p>

    <p class="text">Реализация на построителе с подзапросами:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">App\Models\Login</span>;
<span class="c-key">use</span> <span class="c-type">App\Models\Order</span>;
<span class="c-key">use</span> <span class="c-type">App\Models\Review</span>;

<span class="c-key">class</span> <span class="c-type">UserReportController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__invoke</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>): <span class="c-type">View</span>
    {
        <span class="c-var">$users</span> = <span class="c-type">User</span>::<span class="c-fn">query</span>()
            -><span class="c-fn">addSelect</span>([
                <span class="c-comment">// Сумма всех оплаченных заказов.</span>
                <span class="c-str">'orders_total'</span> =&gt; <span class="c-type">Order</span>::<span class="c-fn">selectRaw</span>(<span class="c-str">'COALESCE(SUM(amount), 0)'</span>)
                    -><span class="c-fn">whereColumn</span>(<span class="c-str">'orders.user_id'</span>, <span class="c-str">'users.id'</span>)
                    -><span class="c-fn">whereNotNull</span>(<span class="c-str">'paid_at'</span>),

                <span class="c-comment">// Количество оплаченных заказов.</span>
                <span class="c-str">'orders_count'</span> =&gt; <span class="c-type">Order</span>::<span class="c-fn">selectRaw</span>(<span class="c-str">'COUNT(*)'</span>)
                    -><span class="c-fn">whereColumn</span>(<span class="c-str">'orders.user_id'</span>, <span class="c-str">'users.id'</span>)
                    -><span class="c-fn">whereNotNull</span>(<span class="c-str">'paid_at'</span>),

                <span class="c-comment">// Дата последнего оплаченного заказа.</span>
                <span class="c-str">'last_order_at'</span> =&gt; <span class="c-type">Order</span>::<span class="c-fn">select</span>(<span class="c-str">'paid_at'</span>)
                    -><span class="c-fn">whereColumn</span>(<span class="c-str">'orders.user_id'</span>, <span class="c-str">'users.id'</span>)
                    -><span class="c-fn">whereNotNull</span>(<span class="c-str">'paid_at'</span>)
                    -><span class="c-fn">orderByDesc</span>(<span class="c-str">'paid_at'</span>)
                    -><span class="c-fn">limit</span>(<span class="c-num">1</span>),

                <span class="c-comment">// Число неудачных логинов за последние 7 дней.</span>
                <span class="c-str">'failed_logins_7d'</span> =&gt; <span class="c-type">Login</span>::<span class="c-fn">selectRaw</span>(<span class="c-str">'COUNT(*)'</span>)
                    -><span class="c-fn">whereColumn</span>(<span class="c-str">'logins.user_id'</span>, <span class="c-str">'users.id'</span>)
                    -><span class="c-fn">where</span>(<span class="c-str">'success'</span>, <span class="c-key">false</span>)
                    -><span class="c-fn">where</span>(<span class="c-str">'created_at'</span>, <span class="c-str">'&gt;='</span>, <span class="c-fn">now</span>()-><span class="c-fn">subWeek</span>()),

                <span class="c-comment">// Средняя оценка оставленных отзывов.</span>
                <span class="c-str">'avg_review_rating'</span> =&gt; <span class="c-type">Review</span>::<span class="c-fn">selectRaw</span>(<span class="c-str">'AVG(rating)'</span>)
                    -><span class="c-fn">whereColumn</span>(<span class="c-str">'reviews.user_id'</span>, <span class="c-str">'users.id'</span>),
            ])
            -><span class="c-comment">// Фильтр: только активные пользователи с хотя бы одним заказом.</span>
            -><span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'active'</span>)
            -><span class="c-fn">whereExists</span>(<span class="c-key">function</span> (<span class="c-type">Builder</span> <span class="c-var">$q</span>) {
                <span class="c-var">$q</span>-><span class="c-fn">selectRaw</span>(<span class="c-num">1</span>)
                  -><span class="c-fn">from</span>(<span class="c-str">'orders'</span>)
                  -><span class="c-fn">whereColumn</span>(<span class="c-str">'orders.user_id'</span>, <span class="c-str">'users.id'</span>)
                  -><span class="c-fn">whereNotNull</span>(<span class="c-str">'paid_at'</span>);
            })
            -><span class="c-comment">// Сортировка по подзапросу — наиболее ценные клиенты сверху.</span>
            -><span class="c-fn">orderByDesc</span>(
                <span class="c-type">Order</span>::<span class="c-fn">selectRaw</span>(<span class="c-str">'COALESCE(SUM(amount), 0)'</span>)
                    -><span class="c-fn">whereColumn</span>(<span class="c-str">'orders.user_id'</span>, <span class="c-str">'users.id'</span>)
                    -><span class="c-fn">whereNotNull</span>(<span class="c-str">'paid_at'</span>)
            )
            -><span class="c-fn">paginate</span>(<span class="c-num">50</span>);

        <span class="c-key">return</span> <span class="c-fn">view</span>(<span class="c-str">'admin.reports.users'</span>, <span class="c-fn">compact</span>(<span class="c-str">'users'</span>));
    }
}
</code></pre>

    <p class="text">Альтернативная реализация через <code>fromSub</code> для группировки данных, когда логика отчёта сложнее и требует промежуточной агрегации:</p>
<pre><code><span class="c-comment">// Топ-10 продуктов по объёму продаж за квартал, с долей в общем обороте.</span>
<span class="c-var">$totals</span> = <span class="c-type">DB</span>::<span class="c-fn">table</span>(<span class="c-str">'order_items'</span>)
    -><span class="c-fn">selectRaw</span>(<span class="c-str">'product_id, SUM(qty * price) as revenue'</span>)
    -><span class="c-fn">whereBetween</span>(<span class="c-str">'created_at'</span>, [<span class="c-fn">now</span>()-><span class="c-fn">subQuarter</span>(), <span class="c-fn">now</span>()])
    -><span class="c-fn">groupBy</span>(<span class="c-str">'product_id'</span>);

<span class="c-var">$report</span> = <span class="c-type">DB</span>::<span class="c-fn">query</span>()
    -><span class="c-fn">fromSub</span>(<span class="c-var">$totals</span>, <span class="c-str">'t'</span>)
    -><span class="c-fn">join</span>(<span class="c-str">'products'</span>, <span class="c-str">'products.id'</span>, <span class="c-str">'='</span>, <span class="c-str">'t.product_id'</span>)
    -><span class="c-fn">select</span>(<span class="c-str">'products.name'</span>, <span class="c-str">'t.revenue'</span>)
    -><span class="c-fn">selectRaw</span>(<span class="c-str">'t.revenue / SUM(t.revenue) OVER () * 100 AS share_pct'</span>)
    -><span class="c-fn">orderByDesc</span>(<span class="c-str">'t.revenue'</span>)
    -><span class="c-fn">limit</span>(<span class="c-num">10</span>)
    -><span class="c-fn">get</span>();
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. SQL-инъекция через <code>DB::raw</code>.</strong> Конкатенация пользовательского ввода в строку SQL (<code>DB::raw("WHERE name = '$input'")</code>) &mdash; критическая уязвимость. Любой пользовательский ввод передаётся параметром через биндинги: <code>whereRaw('name = ?', [$input])</code>. Это правило безусловно: даже «проверенный» ввод подлежит параметризации.
    </div>

    <div class="pitfall">
      <strong>2. Подзапрос с несколькими столбцами в <code>addSelect</code>.</strong> Скалярный подзапрос в SELECT-списке должен возвращать ровно один столбец и не более одной строки. Попытка вернуть несколько столбцов или несколько строк завершится ошибкой СУБД. Для возврата нескольких связанных значений используйте <code>joinSub</code>.
    </div>

    <div class="pitfall">
      <strong>3. <code>whereExists</code> и неоднозначные имена таблиц.</strong> В корреляционном подзапросе обязательно указывать полные имена колонок (<code>logins.user_id</code>, <code>users.id</code>). Без квалификации СУБД может выбрать неправильную таблицу или вернуть ошибку <code>ambiguous column</code>.
    </div>

    <div class="pitfall">
      <strong>4. Различия диалектов SQL.</strong> Сырые выражения теряют переносимость между СУБД. <code>SUM(amount) OVER ()</code> (оконная функция) работает в PostgreSQL, MySQL 8+, SQLite 3.25+, но не в MySQL 5.7. JSON-операторы <code>-&gt;&gt;</code> различаются. При работе с несколькими СУБД (например, SQLite в тестах и PostgreSQL в продакшене) сырые выражения проверяются на обоих окружениях.
    </div>

    <div class="pitfall">
      <strong>5. Подзапрос с <code>limit</code> и пагинатором.</strong> При использовании <code>addSelect</code> с подзапросом, включающим <code>LIMIT</code>, обращение через <code>paginate()</code> может работать некорректно из-за того, что метод <code>count()</code> построителя дублирует SELECT-список, включая подзапросы. В таких случаях применяется <code>simplePaginate</code>, либо отдельная обёртка <code>fromSub</code>.
    </div>

    <div class="pitfall">
      <strong>6. Производительность подзапросов.</strong> Скалярный коррелированный подзапрос выполняется один раз для каждой строки внешнего запроса. На выборках в десятки тысяч строк это даёт ощутимую нагрузку, особенно без покрывающих индексов. Альтернатива &mdash; <code>joinSub</code> с предварительно сгруппированными данными, либо денормализованные счётчики, обновляемые наблюдателями событий.
    </div>

    <div class="pitfall">
      <strong>7. <code>DB::raw</code> в условиях с биндингами.</strong> Если внутри <code>DB::raw()</code> необходимы параметры, они не привязываются автоматически. В таких случаях используется обёртка с биндингами явно: <code>$query-&gt;whereRaw('? = ANY(tags)', [$tag])</code> &mdash; либо специальные методы построителя, понимающие массивы (<code>whereIn</code>, <code>whereBetween</code>).
    </div>

    <div class="pitfall">
      <strong>8. Тестирование запросов с подзапросами.</strong> Сложные запросы с подзапросами и сырым SQL должны покрываться тестами, фиксирующими как корректность результата на типовых данных, так и план выполнения (через <code>EXPLAIN</code>). При изменении запроса легко получить регрессию в производительности, незаметную в обычных тестах с малыми объёмами данных.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     QUERIES — CHUNKS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-query-chunks" class="section">
  <div class="section-title">chunk, chunkById, lazy и cursor</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Стандартные методы <code>get()</code> и <code>all()</code> загружают полный результат запроса в память приложения. При выборках в десятки тысяч и миллионы строк это приводит к исчерпанию памяти PHP, длительной задержке перед началом обработки и невозможности параллельной работы. Eloquent предоставляет четыре механизма потоковой обработки больших выборок: <code>chunk</code>, <code>chunkById</code>, <code>lazy</code> и <code>cursor</code>.</p>
    <p class="text">Эти механизмы решают одну задачу &mdash; обработать большой набор данных, не загружая его полностью в память &mdash; но реализуют её разными способами и имеют разные ограничения. Различия касаются количества выполняемых SQL-запросов, расхода памяти, безопасности при модификации обрабатываемых записей и интерфейса доступа (массив порциями, итератор по одному, ленивая коллекция).</p>
    <p class="text">Выбор метода критически важен для корректности и производительности bulk-операций. Неправильно выбранный механизм может пропускать или дублировать записи, исчерпать память на длинных циклах, либо заблокировать таблицу на время обработки.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень методов</div>

    <div class="card">
      <h3><code>chunk($size, $callback)</code></h3>
      <p class="text">Разбивает результат запроса на партии указанного размера, поочерёдно загружает каждую партию в память и передаёт её в callback. Для каждой партии выполняется отдельный SQL с <code>LIMIT $size OFFSET $offset</code>.</p>
<pre><code><span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'newsletter'</span>, <span class="c-key">true</span>)
    -><span class="c-fn">chunk</span>(<span class="c-num">500</span>, <span class="c-key">function</span> (<span class="c-type">Collection</span> <span class="c-var">$users</span>) {
        <span class="c-key">foreach</span> (<span class="c-var">$users</span> <span class="c-key">as</span> <span class="c-var">$user</span>) {
            <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$user</span>)-><span class="c-fn">queue</span>(<span class="c-key">new</span> <span class="c-type">NewsletterMail</span>(<span class="c-var">$user</span>));
        }
    });
</code></pre>
      <p class="text">Прерывание обхода: если callback вернёт <code>false</code>, итерация прекращается. Это удобно при пакетной обработке с условием остановки (например, обработка до определённого критерия).</p>
      <p class="text">Ограничение: метод использует <code>OFFSET</code>, что делает его уязвимым при модификации обрабатываемых записей. Если в callback удаляется текущая партия записей, следующий <code>OFFSET</code> сдвинется в исходно нумерованных строках, но реально пропустит те, что подтянулись на их место.</p>
    </div>

    <div class="card">
      <h3><code>chunkById($size, $callback, $column = null)</code></h3>
      <p class="text">Усовершенствованная версия <code>chunk</code>, использующая первичный ключ (или указанную колонку) для пагинации вместо <code>OFFSET</code>. Каждая партия выбирается условием <code>WHERE id &gt; $lastId ORDER BY id LIMIT $size</code>. Это устраняет проблему «сдвига» при модификации.</p>
<pre><code><span class="c-comment">// Безопасная пакетная очистка неактивных пользователей.</span>
<span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'last_login_at'</span>, <span class="c-str">'&lt;'</span>, <span class="c-fn">now</span>()-><span class="c-fn">subYears</span>(<span class="c-num">2</span>))
    -><span class="c-fn">chunkById</span>(<span class="c-num">200</span>, <span class="c-key">function</span> (<span class="c-type">Collection</span> <span class="c-var">$users</span>) {
        <span class="c-key">foreach</span> (<span class="c-var">$users</span> <span class="c-key">as</span> <span class="c-var">$user</span>) {
            <span class="c-var">$user</span>-><span class="c-fn">delete</span>();
        }
    });

<span class="c-comment">// SQL:</span>
<span class="c-comment">// 1: SELECT * FROM users WHERE last_login_at &lt; ? ORDER BY id ASC LIMIT 200;</span>
<span class="c-comment">// 2: SELECT * FROM users WHERE last_login_at &lt; ? AND id &gt; 199 ORDER BY id ASC LIMIT 200;</span>
<span class="c-comment">// 3: ...</span>
</code></pre>
      <p class="text">Метод требует, чтобы используемая колонка была монотонной (обычно автоинкрементный primary key) и индексированной. Без индекса каждый шаг будет приводить к полному сканированию таблицы.</p>
    </div>

    <div class="card">
      <h3><code>lazy($size = 1000)</code> и <code>lazyById($size, $column)</code></h3>
      <p class="text">Возвращают <code>LazyCollection</code> &mdash; коллекцию, элементы которой подгружаются партиями по мере итерации. В отличие от <code>chunk</code>, лениво вычисляются и поддерживают полный API коллекции (<code>map</code>, <code>filter</code>, <code>each</code>, <code>reduce</code>), при этом не загружают полный результат в память.</p>
<pre><code><span class="c-comment">// Цепочечная обработка через коллекционные методы без загрузки всего в память.</span>
<span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'plan'</span>, <span class="c-str">'pro'</span>)
    -><span class="c-fn">lazyById</span>(<span class="c-num">500</span>)
    -><span class="c-fn">filter</span>(<span class="c-key">fn</span> (<span class="c-type">User</span> <span class="c-var">$u</span>) =&gt; <span class="c-var">$u</span>-><span class="c-fn">requiresRetention</span>())
    -><span class="c-fn">each</span>(<span class="c-key">fn</span> (<span class="c-type">User</span> <span class="c-var">$u</span>) =&gt; <span class="c-type">RetentionMail</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$u</span>));
</code></pre>
      <p class="text">Принципиальная разница с <code>chunk</code>: callback вызывается по одному элементу, а не по партии. Это удобно для последовательной обработки, но менее эффективно для bulk-операций (например, массовых обновлений), где партия обрабатывается одной SQL-командой.</p>
    </div>

    <div class="card">
      <h3><code>cursor()</code></h3>
      <p class="text">Возвращает <code>LazyCollection</code>, итерация по которой выполняется с использованием SQL-курсора СУБД. Один запрос отправляется в БД, и она поочерёдно отдаёт результирующие строки. В памяти PHP в каждый момент находится один объект модели.</p>
<pre><code><span class="c-comment">// Экспорт миллионов записей в CSV без расхода памяти.</span>
<span class="c-var">$handle</span> = <span class="c-fn">fopen</span>(<span class="c-str">'php://output'</span>, <span class="c-str">'w'</span>);

<span class="c-key">foreach</span> (<span class="c-type">Transaction</span>::<span class="c-fn">where</span>(<span class="c-str">'year'</span>, <span class="c-num">2024</span>)-><span class="c-fn">cursor</span>() <span class="c-key">as</span> <span class="c-var">$tx</span>) {
    <span class="c-fn">fputcsv</span>(<span class="c-var">$handle</span>, [<span class="c-var">$tx</span>-><span class="c-var">id</span>, <span class="c-var">$tx</span>-><span class="c-var">amount</span>, <span class="c-var">$tx</span>-><span class="c-var">currency</span>, <span class="c-var">$tx</span>-><span class="c-var">created_at</span>]);
}
</code></pre>
      <p class="text">Минимальный расход памяти, наивысшая скорость для чисто read-only операций. Ограничения: один открытый запрос на всё время обхода (может удерживать соединение и блокировки), невозможность eager loading связанных моделей (для них требуется отдельный SELECT).</p>
    </div>

    <div class="card">
      <h3>Сравнительная таблица</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>Память (PHP)</th><th>SQL-запросов</th><th>Безопасен при мутации обходимых записей</th><th>Поддерживает eager loading</th></tr>
        <tr><td><code>chunk($size)</code></td><td>Средняя (одна партия)</td><td>Число записей / $size</td><td>Нет (использует OFFSET)</td><td>Да</td></tr>
        <tr><td><code>chunkById($size)</code></td><td>Средняя (одна партия)</td><td>Число записей / $size</td><td>Да (пагинация по PK)</td><td>Да</td></tr>
        <tr><td><code>lazy($size)</code></td><td>Низкая (партии лениво)</td><td>Число записей / $size</td><td>Нет</td><td>Да</td></tr>
        <tr><td><code>lazyById($size)</code></td><td>Низкая</td><td>Число записей / $size</td><td>Да</td><td>Да</td></tr>
        <tr><td><code>cursor()</code></td><td>Минимальная (одна модель)</td><td>1 (потоковый)</td><td>Условно (зависит от изоляции)</td><td>Нет (только текущая модель)</td></tr>
      </table>
    </div>

    <div class="card">
      <h3>Критерии выбора метода</h3>
      <ul class="bullets">
        <li><strong><code>cursor()</code></strong> &mdash; read-only обход максимального размера: экспорт, генерация отчётов, агрегации в памяти. Не подходит, если требуется обращение к relation внутри цикла.</li>
        <li><strong><code>chunkById()</code></strong> &mdash; bulk-операции, изменяющие обходимые записи (массовое удаление, обновление статуса). Безопасен для одновременной модификации.</li>
        <li><strong><code>chunk()</code></strong> &mdash; обход без модификации обходимых записей (рассылка писем, индексация в поисковый движок, экспорт с обработкой партиями).</li>
        <li><strong><code>lazy()</code> / <code>lazyById()</code></strong> &mdash; обработка через цепочку коллекционных методов (<code>filter</code>, <code>map</code>, <code>each</code>) для случаев, где удобство декларативного API важнее скорости.</li>
      </ul>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: ежемесячный отчёт о транзакциях</div>

    <p class="text">Рассмотрим запланированную Artisan-команду, которая еженощно генерирует CSV-отчёт о транзакциях за прошедший месяц, отправляет уведомления пользователям с подозрительной активностью и архивирует записи старше двух лет. Для каждой подзадачи используется наиболее подходящий механизм обхода.</p>

<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Console\Command</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Collection</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Storage</span>;

<span class="c-key">class</span> <span class="c-type">MonthlyTransactionReport</span> <span class="c-key">extends</span> <span class="c-type">Command</span>
{
    <span class="c-key">protected</span> <span class="c-var">$signature</span> = <span class="c-str">'reports:transactions {--month=}'</span>;

    <span class="c-key">public function</span> <span class="c-fn">handle</span>(): <span class="c-key">int</span>
    {
        <span class="c-var">$month</span> = <span class="c-type">Carbon</span>::<span class="c-fn">parse</span>(<span class="c-var">$this</span>-><span class="c-fn">option</span>(<span class="c-str">'month'</span>) ?? <span class="c-str">'last month'</span>);
        <span class="c-var">$this</span>-><span class="c-fn">exportToCsv</span>(<span class="c-var">$month</span>);
        <span class="c-var">$this</span>-><span class="c-fn">notifySuspiciousAccounts</span>(<span class="c-var">$month</span>);
        <span class="c-var">$this</span>-><span class="c-fn">archiveOldTransactions</span>();

        <span class="c-key">return</span> <span class="c-key">self</span>::<span class="c-key">SUCCESS</span>;
    }

    <span class="c-comment">// 1. Экспорт: только чтение, миллионы строк, минимальная память — используем cursor().</span>
    <span class="c-key">private function</span> <span class="c-fn">exportToCsv</span>(<span class="c-type">Carbon</span> <span class="c-var">$month</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$path</span>   = <span class="c-fn">storage_path</span>(<span class="c-str">"reports/transactions-{$month->format('Y-m')}.csv"</span>);
        <span class="c-var">$handle</span> = <span class="c-fn">fopen</span>(<span class="c-var">$path</span>, <span class="c-str">'w'</span>);
        <span class="c-fn">fputcsv</span>(<span class="c-var">$handle</span>, [<span class="c-str">'id'</span>, <span class="c-str">'user_id'</span>, <span class="c-str">'amount'</span>, <span class="c-str">'currency'</span>, <span class="c-str">'created_at'</span>]);

        <span class="c-key">foreach</span> (<span class="c-type">Transaction</span>::<span class="c-fn">whereBetween</span>(<span class="c-str">'created_at'</span>, [
            <span class="c-var">$month</span>-><span class="c-fn">copy</span>()-><span class="c-fn">startOfMonth</span>(),
            <span class="c-var">$month</span>-><span class="c-fn">copy</span>()-><span class="c-fn">endOfMonth</span>(),
        ])-><span class="c-fn">cursor</span>() <span class="c-key">as</span> <span class="c-var">$tx</span>) {
            <span class="c-fn">fputcsv</span>(<span class="c-var">$handle</span>, [
                <span class="c-var">$tx</span>-><span class="c-var">id</span>,
                <span class="c-var">$tx</span>-><span class="c-var">user_id</span>,
                <span class="c-var">$tx</span>-><span class="c-var">amount</span>,
                <span class="c-var">$tx</span>-><span class="c-var">currency</span>,
                <span class="c-var">$tx</span>-><span class="c-var">created_at</span>-><span class="c-fn">toIso8601String</span>(),
            ]);
        }

        <span class="c-fn">fclose</span>(<span class="c-var">$handle</span>);
        <span class="c-var">$this</span>-><span class="c-fn">info</span>(<span class="c-str">"CSV сохранён: {$path}"</span>);
    }

    <span class="c-comment">// 2. Рассылка уведомлений: обходим пользователей партиями, модификация не задевает обходимых.</span>
    <span class="c-comment">//    Подходит обычный chunk().</span>
    <span class="c-key">private function</span> <span class="c-fn">notifySuspiciousAccounts</span>(<span class="c-type">Carbon</span> <span class="c-var">$month</span>): <span class="c-key">void</span>
    {
        <span class="c-type">User</span>::<span class="c-fn">whereHas</span>(<span class="c-str">'transactions'</span>, <span class="c-key">function</span> (<span class="c-var">$q</span>) <span class="c-key">use</span> (<span class="c-var">$month</span>) {
            <span class="c-var">$q</span>-><span class="c-fn">whereBetween</span>(<span class="c-str">'created_at'</span>, [<span class="c-var">$month</span>-><span class="c-fn">startOfMonth</span>(), <span class="c-var">$month</span>-><span class="c-fn">endOfMonth</span>()])
              -><span class="c-fn">where</span>(<span class="c-str">'amount'</span>, <span class="c-str">'&gt;'</span>, <span class="c-num">10000</span>);
        })-><span class="c-fn">chunk</span>(<span class="c-num">200</span>, <span class="c-key">function</span> (<span class="c-type">Collection</span> <span class="c-var">$users</span>) <span class="c-key">use</span> (<span class="c-var">$month</span>) {
            <span class="c-key">foreach</span> (<span class="c-var">$users</span> <span class="c-key">as</span> <span class="c-var">$user</span>) {
                <span class="c-var">$user</span>-><span class="c-fn">notify</span>(<span class="c-key">new</span> <span class="c-type">SuspiciousActivityNotification</span>(<span class="c-var">$month</span>));
            }
        });
    }

    <span class="c-comment">// 3. Архивация: каждая обработанная запись удаляется → используем chunkById,</span>
    <span class="c-comment">//    чтобы не пропускать «сдвинувшиеся» строки.</span>
    <span class="c-key">private function</span> <span class="c-fn">archiveOldTransactions</span>(): <span class="c-key">void</span>
    {
        <span class="c-type">Transaction</span>::<span class="c-fn">where</span>(<span class="c-str">'created_at'</span>, <span class="c-str">'&lt;'</span>, <span class="c-fn">now</span>()-><span class="c-fn">subYears</span>(<span class="c-num">2</span>))
            -><span class="c-fn">chunkById</span>(<span class="c-num">500</span>, <span class="c-key">function</span> (<span class="c-type">Collection</span> <span class="c-var">$batch</span>) {
                <span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$batch</span>) {
                    <span class="c-type">ArchivedTransaction</span>::<span class="c-fn">insert</span>(<span class="c-var">$batch</span>-><span class="c-fn">map</span>-><span class="c-fn">toArchiveArray</span>()-><span class="c-fn">all</span>());
                    <span class="c-type">Transaction</span>::<span class="c-fn">whereIn</span>(<span class="c-str">'id'</span>, <span class="c-var">$batch</span>-><span class="c-fn">modelKeys</span>())-><span class="c-fn">delete</span>();
                });
            });
    }
}
</code></pre>

    <p class="text">Использование <code>lazyById</code> для случая, когда требуется сначала отфильтровать записи по полю, не индексированному в БД, а затем выполнить дальнейшую обработку:</p>
<pre><code><span class="c-comment">// Поиск дублирующихся email-адресов среди миллионов пользователей</span>
<span class="c-comment">// без загрузки всех в память.</span>
<span class="c-var">$duplicateGroups</span> = <span class="c-type">User</span>::<span class="c-fn">lazyById</span>(<span class="c-num">2000</span>)
    -><span class="c-fn">groupBy</span>(<span class="c-key">fn</span> (<span class="c-type">User</span> <span class="c-var">$u</span>) =&gt; <span class="c-fn">strtolower</span>(<span class="c-var">$u</span>-><span class="c-var">email</span>))
    -><span class="c-fn">filter</span>(<span class="c-key">fn</span> (<span class="c-type">LazyCollection</span> <span class="c-var">$group</span>) =&gt; <span class="c-var">$group</span>-><span class="c-fn">count</span>() &gt; <span class="c-num">1</span>);
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. <code>chunk</code> и одновременная модификация.</strong> Самая частая ошибка использования метода: внутри callback изменяется или удаляется текущая партия записей. Из-за <code>OFFSET</code>-пагинации следующая партия сдвинется в нумерации, и часть данных будет пропущена. Для bulk-операций над обходимыми записями всегда используется <code>chunkById</code>.
    </div>

    <div class="pitfall">
      <strong>2. <code>cursor</code> и относительно медленные операции.</strong> Метод удерживает открытое соединение с БД на всё время обхода. Если внутри цикла выполняется длительная работа (сетевые запросы, тяжёлая логика), соединение остаётся занятым, что может исчерпать пул соединений и замедлить остальное приложение. Для таких случаев предпочтителен <code>chunkById</code>, освобождающий соединение между партиями.
    </div>

    <div class="pitfall">
      <strong>3. <code>cursor</code> без буферизации (MySQL).</strong> По умолчанию PDO для MySQL загружает весь результат в память драйвера, что нивелирует преимущества <code>cursor()</code>. Для истинно потокового режима необходимо включить <code>PDO::MYSQL_ATTR_USE_BUFFERED_QUERY = false</code> в конфигурации соединения, а также избегать выполнения других запросов во время обхода.
    </div>

    <div class="pitfall">
      <strong>4. Eager loading с <code>cursor</code> невозможен.</strong> Метод выполняет один SELECT и стримит результат построчно; для eager loading требуется второй SELECT, который не может быть выполнен во время активного курсора. При необходимости обращаться к relation в цикле используется <code>chunkById</code> с <code>with(...)</code>.
    </div>

    <div class="pitfall">
      <strong>5. <code>chunkById</code> и нестандартный primary key.</strong> Метод по умолчанию опирается на колонку <code>id</code> с числовым возрастающим типом. Для UUID-ключей, составных ключей или ситуаций, когда требуется пагинация по другой колонке (<code>created_at</code>), необходимо передать имя колонки третьим аргументом и убедиться в наличии индекса.
    </div>

    <div class="pitfall">
      <strong>6. Транзакции и chunk.</strong> Открытие транзакции на всю операцию <code>chunkById</code> по большой таблице приведёт к удержанию блокировок на всё время обхода. Корректный подход &mdash; открывать транзакцию <strong>внутри</strong> callback на каждую партию (как в примере с архивацией), чтобы блокировки удерживались только в пределах одной партии.
    </div>

    <div class="pitfall">
      <strong>7. <code>lazy</code> внутри коллекционных методов с агрегацией.</strong> Методы вроде <code>sum()</code>, <code>avg()</code>, <code>count()</code> на <code>LazyCollection</code> требуют обхода всех элементов, что подгружает их в память по очереди и в итоге выполняет всю выборку. Преимущество лени теряется, если в конце цепочки используется операция, требующая полного материализованного набора.
    </div>

    <div class="pitfall">
      <strong>8. Тайм-ауты PHP и долгие обходы.</strong> При обработке миллионов записей время выполнения может превысить лимиты PHP (<code>max_execution_time</code>, лимиты PHP-FPM, веб-сервера). Длительные обходы целесообразно выносить в Artisan-команды, выполняемые в очереди или планировщике, где ограничения мягче.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     QUERIES — UPSERT
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-query-upsert" class="section">
  <div class="section-title">upsert, insert bulk, firstOrCreate</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Стандартные методы Eloquent для создания записи (<code>create</code>, <code>save</code>) работают через цикл гидрации модели: вызываются события, observers, mutators, casts, проставляются timestamps. Это удобно для одиночных операций, но неэффективно для массовых: вставка тысячи записей по одной займёт тысячи SQL-запросов и значительное время.</p>
    <p class="text">Eloquent предоставляет специализированные методы для массовых операций и условного создания:</p>
    <ul class="bullets">
      <li><strong><code>insert()</code></strong> &mdash; bulk-вставка через Query Builder, минуя цикл Eloquent;</li>
      <li><strong><code>upsert()</code></strong> &mdash; вставка с автоматическим обновлением при конфликте уникального индекса (INSERT ... ON CONFLICT/DUPLICATE KEY UPDATE);</li>
      <li><strong><code>firstOrCreate()</code></strong>, <strong><code>firstOrNew()</code></strong>, <strong><code>updateOrCreate()</code></strong> &mdash; идемпотентное создание единичной записи на основе условия поиска.</li>
    </ul>
    <p class="text">Выбор между ними определяется характером задачи: разовое создание/обновление с активной бизнес-логикой (используется <code>firstOrCreate</code>/<code>updateOrCreate</code>) или массовая операция без бизнес-обработки (используется <code>insert</code>/<code>upsert</code>). Эти методы критичны при импорте данных, синхронизации с внешними системами, обновлении справочников и подобных задачах.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень методов</div>

    <div class="card">
      <h3><code>insert($rows)</code> &mdash; массовая вставка</h3>
      <p class="text">Выполняет один SQL <code>INSERT</code> с многократным набором значений. В большинстве СУБД он значительно быстрее последовательных одиночных вставок: и за счёт уменьшения числа round-trip к базе, и за счёт батчевой обработки на стороне СУБД.</p>
<pre><code><span class="c-type">User</span>::<span class="c-fn">insert</span>([
    [<span class="c-str">'name'</span> =&gt; <span class="c-str">'Alice'</span>, <span class="c-str">'email'</span> =&gt; <span class="c-str">'alice@x.com'</span>, <span class="c-str">'created_at'</span> =&gt; <span class="c-fn">now</span>(), <span class="c-str">'updated_at'</span> =&gt; <span class="c-fn">now</span>()],
    [<span class="c-str">'name'</span> =&gt; <span class="c-str">'Bob'</span>,   <span class="c-str">'email'</span> =&gt; <span class="c-str">'bob@x.com'</span>,   <span class="c-str">'created_at'</span> =&gt; <span class="c-fn">now</span>(), <span class="c-str">'updated_at'</span> =&gt; <span class="c-fn">now</span>()],
    [<span class="c-str">'name'</span> =&gt; <span class="c-str">'Cara'</span>,  <span class="c-str">'email'</span> =&gt; <span class="c-str">'cara@x.com'</span>,  <span class="c-str">'created_at'</span> =&gt; <span class="c-fn">now</span>(), <span class="c-str">'updated_at'</span> =&gt; <span class="c-fn">now</span>()],
]);

<span class="c-comment">// SQL:</span>
<span class="c-comment">// INSERT INTO users (name, email, created_at, updated_at) VALUES</span>
<span class="c-comment">//   ('Alice', 'alice@x.com', ?, ?),</span>
<span class="c-comment">//   ('Bob',   'bob@x.com',   ?, ?),</span>
<span class="c-comment">//   ('Cara',  'cara@x.com',  ?, ?);</span>
</code></pre>
      <p class="text">Особенности:</p>
      <ul class="bullets">
        <li>Не вызываются Eloquent events (<code>creating</code>, <code>created</code>) и observers;</li>
        <li>Не применяются casts и mutators &mdash; значения отправляются в БД как есть;</li>
        <li>Колонки <code>created_at</code> и <code>updated_at</code> необходимо проставлять вручную;</li>
        <li>Возвращает <code>true</code> при успехе (не идентификаторы вставленных записей).</li>
      </ul>
    </div>

    <div class="card">
      <h3><code>upsert($rows, $uniqueBy, $update)</code></h3>
      <p class="text">Вставка записей с автоматическим обновлением, если в таблице уже существует запись с тем же значением по указанным колонкам. Под капотом транслируется в SQL-конструкцию <code>INSERT ... ON DUPLICATE KEY UPDATE</code> (MySQL) или <code>INSERT ... ON CONFLICT (...) DO UPDATE</code> (PostgreSQL, SQLite 3.24+).</p>
<pre><code><span class="c-type">Product</span>::<span class="c-fn">upsert</span>(
    [
        [<span class="c-str">'sku'</span> =&gt; <span class="c-str">'A1'</span>, <span class="c-str">'name'</span> =&gt; <span class="c-str">'Apple'</span>,  <span class="c-str">'price'</span> =&gt; <span class="c-num">100</span>, <span class="c-str">'stock'</span> =&gt; <span class="c-num">50</span>],
        [<span class="c-str">'sku'</span> =&gt; <span class="c-str">'B2'</span>, <span class="c-str">'name'</span> =&gt; <span class="c-str">'Banana'</span>, <span class="c-str">'price'</span> =&gt; <span class="c-num">50</span>,  <span class="c-str">'stock'</span> =&gt; <span class="c-num">120</span>],
        [<span class="c-str">'sku'</span> =&gt; <span class="c-str">'C3'</span>, <span class="c-str">'name'</span> =&gt; <span class="c-str">'Cherry'</span>, <span class="c-str">'price'</span> =&gt; <span class="c-num">200</span>, <span class="c-str">'stock'</span> =&gt; <span class="c-num">30</span>],
    ],
    uniqueBy: [<span class="c-str">'sku'</span>],
    update:   [<span class="c-str">'name'</span>, <span class="c-str">'price'</span>, <span class="c-str">'stock'</span>],
);
</code></pre>
      <p class="text">Параметры:</p>
      <ul class="bullets">
        <li><code>$rows</code> &mdash; массив ассоциативных массивов с данными;</li>
        <li><code>$uniqueBy</code> &mdash; колонки, по которым определяется дубликат (должен существовать уникальный индекс или primary key на этих колонках);</li>
        <li><code>$update</code> &mdash; список колонок, обновляемых при конфликте. Если опущен, обновляются все колонки из <code>$rows</code>.</li>
      </ul>
      <p class="text">Как и <code>insert</code>, не вызывает Eloquent events и не применяет casts/mutators. Колонка <code>updated_at</code> при конфликте обновляется автоматически, если она есть в таблице и не указана в <code>uniqueBy</code>.</p>
    </div>

    <div class="card">
      <h3><code>firstOrCreate($attributes, $values = [])</code></h3>
      <p class="text">Идемпотентное создание единичной записи. Сначала выполняется поиск по <code>$attributes</code>; если запись найдена &mdash; возвращается без изменений; если нет &mdash; создаётся новая, в которую попадают объединённые <code>$attributes</code> и <code>$values</code>. В отличие от <code>insert</code>, метод проходит через стандартный цикл Eloquent (events, observers, casts).</p>
<pre><code><span class="c-comment">// Подписать пользователя на канал, если ещё не подписан.</span>
<span class="c-var">$subscription</span> = <span class="c-type">Subscription</span>::<span class="c-fn">firstOrCreate</span>(
    [<span class="c-str">'user_id'</span> =&gt; <span class="c-var">$user</span>-><span class="c-var">id</span>, <span class="c-str">'channel_id'</span> =&gt; <span class="c-var">$channel</span>-><span class="c-var">id</span>],
    [<span class="c-str">'subscribed_at'</span> =&gt; <span class="c-fn">now</span>(), <span class="c-str">'plan'</span> =&gt; <span class="c-str">'basic'</span>],
);

<span class="c-comment">// Узнать, была ли запись реально создана.</span>
<span class="c-key">if</span> (<span class="c-var">$subscription</span>-><span class="c-fn">wasRecentlyCreated</span>) {
    <span class="c-var">$subscription</span>-><span class="c-fn">notify</span>(<span class="c-key">new</span> <span class="c-type">WelcomeNotification</span>());
}
</code></pre>
    </div>

    <div class="card">
      <h3><code>updateOrCreate($attributes, $values)</code></h3>
      <p class="text">Принципиальное отличие от <code>firstOrCreate</code>: если запись найдена, она <strong>обновляется</strong> значениями из <code>$values</code>, после чего возвращается. Если не найдена &mdash; создаётся. Метод применяется при синхронизации с внешними источниками данных и идемпотентной обработке webhook-событий.</p>
<pre><code><span class="c-comment">// Обработка вебхука от платёжного провайдера: обновить статус заказа или создать новый.</span>
<span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">updateOrCreate</span>(
    [<span class="c-str">'external_id'</span> =&gt; <span class="c-var">$webhook</span>-><span class="c-fn">orderId</span>()],
    [
        <span class="c-str">'status'</span>      =&gt; <span class="c-var">$webhook</span>-><span class="c-fn">status</span>(),
        <span class="c-str">'paid_at'</span>     =&gt; <span class="c-var">$webhook</span>-><span class="c-fn">paidAt</span>(),
        <span class="c-str">'amount'</span>      =&gt; <span class="c-var">$webhook</span>-><span class="c-fn">amount</span>(),
        <span class="c-str">'raw_payload'</span> =&gt; <span class="c-var">$webhook</span>-><span class="c-fn">payload</span>(),
    ],
);
</code></pre>
    </div>

    <div class="card">
      <h3><code>firstOrNew($attributes, $values = [])</code></h3>
      <p class="text">Возвращает инстанс модели &mdash; либо найденный, либо <strong>новый, но несохранённый</strong>. Удобен в случаях, когда после поиска необходимо выполнить дополнительную настройку перед сохранением.</p>
<pre><code><span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">firstOrNew</span>([<span class="c-str">'email'</span> =&gt; <span class="c-str">'alice@x.com'</span>]);
<span class="c-var">$user</span>-><span class="c-var">name</span>     = <span class="c-var">$externalProfile</span>-><span class="c-fn">name</span>();
<span class="c-var">$user</span>-><span class="c-var">timezone</span> = <span class="c-fn">request</span>()-><span class="c-fn">header</span>(<span class="c-str">'X-Timezone'</span>);
<span class="c-var">$user</span>-><span class="c-fn">save</span>();
</code></pre>
    </div>

    <div class="card">
      <h3>Сравнительная таблица</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>Запросов</th><th>Eloquent events</th><th>Casts / mutators</th><th>Timestamps</th><th>Применение</th></tr>
        <tr><td><code>insert($rows)</code></td><td>1 (bulk)</td><td>Не вызываются</td><td>Не применяются</td><td>Вручную</td><td>Импорт больших объёмов</td></tr>
        <tr><td><code>upsert(...)</code></td><td>1 (bulk)</td><td>Не вызываются</td><td>Не применяются</td><td><code>updated_at</code> автоматически</td><td>Синхронизация справочников</td></tr>
        <tr><td><code>create($data)</code></td><td>1</td><td>Вызываются</td><td>Применяются</td><td>Автоматически</td><td>Создание одной записи</td></tr>
        <tr><td><code>firstOrCreate(...)</code></td><td>1-2</td><td>Вызываются (при создании)</td><td>Применяются</td><td>Автоматически</td><td>Идемпотентное создание</td></tr>
        <tr><td><code>updateOrCreate(...)</code></td><td>1-2</td><td>Вызываются</td><td>Применяются</td><td>Автоматически</td><td>Идемпотентная синхронизация</td></tr>
        <tr><td><code>firstOrNew(...)</code></td><td>1 (без save)</td><td>Не вызываются (до save)</td><td>Применяются после save</td><td>При save</td><td>Создание с подгонкой полей</td></tr>
      </table>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: ежедневная синхронизация каталога с поставщиком</div>

    <p class="text">Рассмотрим запланированную задачу, которая загружает свежий прайс-лист поставщика (CSV с несколькими тысячами товаров), обновляет каталог: добавляет новые позиции, обновляет цены и остатки существующих, помечает отсутствующие как недоступные. Реализация комбинирует <code>upsert</code> для массового обновления и <code>updateOrCreate</code> для случаев, требующих бизнес-логики.</p>

<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Console\Command</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\DB</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\LazyCollection</span>;

<span class="c-key">class</span> <span class="c-type">SyncSupplierCatalog</span> <span class="c-key">extends</span> <span class="c-type">Command</span>
{
    <span class="c-key">protected</span> <span class="c-var">$signature</span> = <span class="c-str">'catalog:sync {file}'</span>;

    <span class="c-key">public function</span> <span class="c-fn">handle</span>(): <span class="c-key">int</span>
    {
        <span class="c-var">$file</span> = <span class="c-var">$this</span>-><span class="c-fn">argument</span>(<span class="c-str">'file'</span>);
        <span class="c-var">$now</span>  = <span class="c-fn">now</span>();

        <span class="c-comment">// 1. Считываем файл лениво, чтобы не загружать его в память целиком.</span>
        <span class="c-var">$rows</span> = <span class="c-type">LazyCollection</span>::<span class="c-fn">make</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$file</span>) {
            <span class="c-var">$h</span> = <span class="c-fn">fopen</span>(<span class="c-var">$file</span>, <span class="c-str">'r'</span>);
            <span class="c-var">$headers</span> = <span class="c-fn">fgetcsv</span>(<span class="c-var">$h</span>);
            <span class="c-key">while</span> ((<span class="c-var">$line</span> = <span class="c-fn">fgetcsv</span>(<span class="c-var">$h</span>)) !== <span class="c-key">false</span>) {
                <span class="c-key">yield</span> <span class="c-fn">array_combine</span>(<span class="c-var">$headers</span>, <span class="c-var">$line</span>);
            }
            <span class="c-fn">fclose</span>(<span class="c-var">$h</span>);
        });

        <span class="c-comment">// 2. Массовое обновление каталога через upsert по партиям.</span>
        <span class="c-comment">//    Для каждой партии формируется ровно один SQL.</span>
        <span class="c-var">$processedSkus</span> = [];

        <span class="c-var">$rows</span>-><span class="c-fn">chunk</span>(<span class="c-num">500</span>)-><span class="c-fn">each</span>(<span class="c-key">function</span> (<span class="c-type">LazyCollection</span> <span class="c-var">$batch</span>) <span class="c-key">use</span> (<span class="c-var">$now</span>, &amp;<span class="c-var">$processedSkus</span>) {
            <span class="c-var">$payload</span> = <span class="c-var">$batch</span>-><span class="c-fn">map</span>(<span class="c-key">fn</span> (<span class="c-key">array</span> <span class="c-var">$row</span>): <span class="c-key">array</span> =&gt; [
                <span class="c-str">'sku'</span>          =&gt; <span class="c-var">$row</span>[<span class="c-str">'sku'</span>],
                <span class="c-str">'name'</span>         =&gt; <span class="c-var">$row</span>[<span class="c-str">'name'</span>],
                <span class="c-str">'price'</span>        =&gt; (<span class="c-key">int</span>) <span class="c-var">$row</span>[<span class="c-str">'price_cents'</span>],
                <span class="c-str">'stock'</span>        =&gt; (<span class="c-key">int</span>) <span class="c-var">$row</span>[<span class="c-str">'stock'</span>],
                <span class="c-str">'is_available'</span> =&gt; <span class="c-key">true</span>,
                <span class="c-str">'created_at'</span>   =&gt; <span class="c-var">$now</span>,
                <span class="c-str">'updated_at'</span>   =&gt; <span class="c-var">$now</span>,
            ])-><span class="c-fn">all</span>();

            <span class="c-type">Product</span>::<span class="c-fn">upsert</span>(
                <span class="c-var">$payload</span>,
                uniqueBy: [<span class="c-str">'sku'</span>],
                update:   [<span class="c-str">'name'</span>, <span class="c-str">'price'</span>, <span class="c-str">'stock'</span>, <span class="c-str">'is_available'</span>, <span class="c-str">'updated_at'</span>],
            );

            <span class="c-var">$processedSkus</span> = <span class="c-fn">array_merge</span>(<span class="c-var">$processedSkus</span>, <span class="c-fn">array_column</span>(<span class="c-var">$payload</span>, <span class="c-str">'sku'</span>));
        });

        <span class="c-comment">// 3. Товары, отсутствующие в файле — помечаются недоступными.</span>
        <span class="c-comment">//    Здесь требуется не bulk-операция, а обработка с событием Eloquent (для индексации).</span>
        <span class="c-type">Product</span>::<span class="c-fn">whereNotIn</span>(<span class="c-str">'sku'</span>, <span class="c-var">$processedSkus</span>)
            -><span class="c-fn">where</span>(<span class="c-str">'is_available'</span>, <span class="c-key">true</span>)
            -><span class="c-fn">chunkById</span>(<span class="c-num">200</span>, <span class="c-key">function</span> (<span class="c-var">$batch</span>) {
                <span class="c-key">foreach</span> (<span class="c-var">$batch</span> <span class="c-key">as</span> <span class="c-var">$product</span>) {
                    <span class="c-var">$product</span>-><span class="c-fn">update</span>([<span class="c-str">'is_available'</span> =&gt; <span class="c-key">false</span>]);
                    <span class="c-comment">// событие updated сработает → search index пересчитается через observer</span>
                }
            });

        <span class="c-key">return</span> <span class="c-key">self</span>::<span class="c-key">SUCCESS</span>;
    }
}
</code></pre>

    <p class="text">Дополнительные сценарии применения idempotent-методов:</p>
<pre><code><span class="c-comment">// 1. Регистрация подписки на email-рассылку — не создаёт дубликат.</span>
<span class="c-type">NewsletterSubscriber</span>::<span class="c-fn">firstOrCreate</span>(
    [<span class="c-str">'email'</span> =&gt; <span class="c-var">$email</span>],
    [<span class="c-str">'subscribed_at'</span> =&gt; <span class="c-fn">now</span>(), <span class="c-str">'source'</span> =&gt; <span class="c-str">'landing-page'</span>],
);

<span class="c-comment">// 2. Идемпотентная обработка webhook платёжной системы:</span>
<span class="c-comment">//    повторная доставка не создаст дубликат, но обновит статус.</span>
<span class="c-type">PaymentEvent</span>::<span class="c-fn">updateOrCreate</span>(
    [<span class="c-str">'provider'</span> =&gt; <span class="c-var">$provider</span>, <span class="c-str">'external_id'</span> =&gt; <span class="c-var">$webhook</span>-><span class="c-fn">id</span>()],
    [<span class="c-str">'status'</span> =&gt; <span class="c-var">$webhook</span>-><span class="c-fn">status</span>(), <span class="c-str">'received_at'</span> =&gt; <span class="c-fn">now</span>()],
);

<span class="c-comment">// 3. Импорт CSV-справочника валютных курсов: тысячи строк, один SQL.</span>
<span class="c-type">ExchangeRate</span>::<span class="c-fn">upsert</span>(
    <span class="c-var">$rates</span>,
    uniqueBy: [<span class="c-str">'pair'</span>, <span class="c-str">'date'</span>],
    update:   [<span class="c-str">'rate'</span>],
);
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. <code>insert()</code> и отсутствие казтов/мутаторов.</strong> Метод выполняется на уровне Query Builder; значения отправляются в БД без преобразования. Если в модели объявлен каст <code>'options' =&gt; 'array'</code>, при <code>insert</code> массив необходимо сериализовать вручную (<code>json_encode</code>). Игнорирование этого даёт ошибку SQL «invalid string».
    </div>

    <div class="pitfall">
      <strong>2. <code>insert()</code> и timestamps.</strong> Колонки <code>created_at</code> и <code>updated_at</code> при использовании <code>insert</code> не проставляются автоматически. Их необходимо включить в каждый ряд вручную, иначе СУБД либо отвергнет вставку (если поля <code>NOT NULL</code>), либо вставит <code>NULL</code>, что нарушает целостность временных меток.
    </div>

    <div class="pitfall">
      <strong>3. <code>upsert</code> требует уникального индекса на колонках из <code>uniqueBy</code>.</strong> Без индекса операция либо не сработает (PostgreSQL вернёт ошибку), либо приведёт к нежелательному поведению (MySQL может молча применить ON DUPLICATE KEY UPDATE по неверной колонке). Перед использованием <code>upsert</code> проверяется наличие соответствующего <code>unique</code> или <code>primary key</code>.
    </div>

    <div class="pitfall">
      <strong>4. <code>upsert</code> и события Eloquent.</strong> Метод не вызывает события <code>creating</code>, <code>created</code>, <code>updating</code>, <code>updated</code>. Если в проекте на этих событиях висит логика (например, отправка уведомлений, инвалидация кэша, обновление поискового индекса), bulk-операция оставит данные в каталоге, но не приведёт к выполнению этой логики. Решение &mdash; ручной вызов соответствующих действий после <code>upsert</code>, либо реализация логики через триггеры БД для бизнес-критичных случаев.
    </div>

    <div class="pitfall">
      <strong>5. <code>firstOrCreate</code> и race condition.</strong> Если несколько процессов одновременно вызывают <code>firstOrCreate</code> с одинаковыми <code>$attributes</code>, оба могут не найти запись и попытаться её создать. Без уникального индекса на колонках поиска один из них упадёт с ошибкой constraint violation. Решение &mdash; добавление unique-индекса плюс обработка исключения, либо использование <code>upsert</code>.
    </div>

    <div class="pitfall">
      <strong>6. <code>updateOrCreate</code> и большие наборы изменений.</strong> Метод выполняет два запроса (SELECT для поиска, INSERT или UPDATE). При синхронизации тысяч записей это даёт тысячи отдельных операций. В таких случаях <code>upsert</code> на 1-2 порядка быстрее.
    </div>

    <div class="pitfall">
      <strong>7. <code>wasRecentlyCreated</code> только после возврата.</strong> Свойство <code>wasRecentlyCreated</code> модели становится <code>true</code> только в случае фактического создания записи через <code>firstOrCreate</code>/<code>updateOrCreate</code>. На моделях, найденных или загруженных иными способами, оно всегда <code>false</code>. Это удобный способ узнать, что запись новая, не выполняя дополнительный запрос.
    </div>

    <div class="pitfall">
      <strong>8. Транзакции и bulk-операции.</strong> Большие <code>upsert</code> и <code>insert</code> внутри открытой транзакции удерживают блокировки до её завершения. На больших таблицах с активной нагрузкой это может вызвать лавинообразное замедление: другие транзакции ожидают освобождения. Партиционирование bulk-операций на меньшие порции с отдельными транзакциями для каждой смягчает проблему.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     EVENTS — MODEL EVENTS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-event-model" class="section">
  <div class="section-title">Model Events</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Жизненный цикл модели Eloquent включает несколько этапов: чтение из БД, создание, обновление, удаление, восстановление. На каждом из них Eloquent публикует событие, к которому может быть привязана реакция: логирование, отправка уведомлений, инвалидация кэша, синхронизация со сторонними системами, проверка прав доступа.</p>
    <p class="text">Механизм событий моделей реализует pattern Domain Events: бизнес-логика побочных эффектов отделяется от основной операции записи и выносится в independent reaction. Это позволяет добавлять и снимать слушателей без модификации модели, тестировать побочные эффекты изолированно, переиспользовать одни и те же реакции в разных контекстах.</p>
    <p class="text">Eloquent предоставляет четыре способа подписки на события: статические методы в <code>booted()</code> модели (для самой модели), Observer-классы (для группировки нескольких реакций в одном файле), bootable traits (для переиспользования между моделями), свойство <code>$dispatchesEvents</code> (для интеграции с системой Event/Listener Laravel и преобразования в полноценные события приложения).</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень событий</div>

    <div class="card">
      <h3>Полный список событий жизненного цикла</h3>
      <p class="text">Все события приходят парами «до операции» и «после операции», за исключением <code>retrieved</code> (срабатывает только после чтения). Возврат <code>false</code> из обработчика «до операции» отменяет её выполнение.</p>
      <table class="data-table">
        <tr><th>Событие</th><th>Момент</th><th>Возврат false отменяет</th><th>Применение</th></tr>
        <tr><td><code>retrieved</code></td><td>После загрузки записи из БД</td><td>Нет</td><td>Аудит чтения, lazy-инициализация связанных данных</td></tr>
        <tr><td><code>creating</code></td><td>Перед INSERT</td><td>Да</td><td>Подстановка дефолтных значений, валидация инвариантов, генерация slug/uuid</td></tr>
        <tr><td><code>created</code></td><td>После INSERT</td><td>Нет</td><td>Уведомления, создание связанных сущностей, инвалидация кэша</td></tr>
        <tr><td><code>updating</code></td><td>Перед UPDATE</td><td>Да</td><td>Проверка допустимости перехода состояний, логирование изменений</td></tr>
        <tr><td><code>updated</code></td><td>После UPDATE</td><td>Нет</td><td>Уведомления об изменении, синхронизация с внешними системами</td></tr>
        <tr><td><code>saving</code></td><td>Перед creating ИЛИ updating</td><td>Да</td><td>Общая логика подготовки, применяемая и при создании, и при обновлении</td></tr>
        <tr><td><code>saved</code></td><td>После created ИЛИ updated</td><td>Нет</td><td>Общая логика реакции на сохранение</td></tr>
        <tr><td><code>deleting</code></td><td>Перед DELETE (или soft delete)</td><td>Да</td><td>Каскадная очистка, проверка прав, валидация бизнес-правил</td></tr>
        <tr><td><code>deleted</code></td><td>После DELETE (или soft delete)</td><td>Нет</td><td>Освобождение ресурсов, логирование, уведомления</td></tr>
        <tr><td><code>trashed</code></td><td>После soft delete</td><td>Нет</td><td>Специфическая реакция только на логическое удаление</td></tr>
        <tr><td><code>forceDeleted</code></td><td>После форсированного DELETE</td><td>Нет</td><td>Окончательная очистка файлов, внешних записей</td></tr>
        <tr><td><code>restoring</code></td><td>Перед restore (soft-deleted)</td><td>Да</td><td>Проверка возможности восстановления</td></tr>
        <tr><td><code>restored</code></td><td>После restore</td><td>Нет</td><td>Восстановление связанных сущностей, уведомление</td></tr>
        <tr><td><code>replicating</code></td><td>При вызове <code>$model-&gt;replicate()</code></td><td>Нет</td><td>Очистка полей, не подлежащих копированию (slug, токены)</td></tr>
      </table>
    </div>

    <div class="card">
      <h3>Подписка через <code>booted()</code></h3>
      <p class="text">Самый прямой способ подписаться на события &mdash; вызвать соответствующий статический метод модели внутри обратного вызова <code>booted()</code>. Каждый метод (<code>creating</code>, <code>updated</code> и т. п.) принимает замыкание, получающее модель.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">Article</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected static function</span> <span class="c-fn">booted</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// Генерация slug перед сохранением, если не задан явно.</span>
        <span class="c-key">static</span>::<span class="c-fn">creating</span>(<span class="c-key">function</span> (<span class="c-type">Article</span> <span class="c-var">$article</span>) {
            <span class="c-var">$article</span>-><span class="c-var">slug</span> ??= <span class="c-type">Str</span>::<span class="c-fn">slug</span>(<span class="c-var">$article</span>-><span class="c-var">title</span>);
        });

        <span class="c-comment">// Сброс кэша после изменения.</span>
        <span class="c-key">static</span>::<span class="c-fn">saved</span>(<span class="c-key">function</span> (<span class="c-type">Article</span> <span class="c-var">$article</span>) {
            <span class="c-type">Cache</span>::<span class="c-fn">forget</span>(<span class="c-str">"article:{$article->id}"</span>);
        });
    }
}
</code></pre>
    </div>

    <div class="card">
      <h3>Отмена операции через возврат <code>false</code></h3>
      <p class="text">Обработчики «до» (<code>creating</code>, <code>updating</code>, <code>saving</code>, <code>deleting</code>, <code>restoring</code>) могут вернуть <code>false</code>, и Eloquent отменит выполнение операции. Метод сохранения вернёт <code>false</code> в вызывающий код, а не выкинет исключение &mdash; вызывающая сторона должна это проверять.</p>
<pre><code><span class="c-key">static</span>::<span class="c-fn">deleting</span>(<span class="c-key">function</span> (<span class="c-type">User</span> <span class="c-var">$user</span>): ?<span class="c-key">bool</span> {
    <span class="c-key">if</span> (<span class="c-var">$user</span>-><span class="c-var">is_protected</span>) {
        <span class="c-key">return</span> <span class="c-key">false</span>;
    }
    <span class="c-key">return</span> <span class="c-key">null</span>;  <span class="c-comment">// Возврат null или void = продолжить операцию.</span>
});

<span class="c-comment">// Вызывающий код</span>
<span class="c-key">if</span> (! <span class="c-var">$user</span>-><span class="c-fn">delete</span>()) {
    <span class="c-key">throw new</span> <span class="c-type">RuntimeException</span>(<span class="c-str">'User is protected and cannot be deleted.'</span>);
}
</code></pre>
    </div>

    <div class="card">
      <h3>Свойство <code>$dispatchesEvents</code> &mdash; интеграция с Event/Listener</h3>
      <p class="text">Позволяет привязать события жизненного цикла к собственным классам событий Laravel. Это превращает «внутренние» события Eloquent в полноправные доменные события приложения, на которые можно подписывать множество слушателей, отправлять в очередь, тестировать через <code>Event::fake()</code>.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">Order</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$dispatchesEvents</span> = [
        <span class="c-str">'created'</span> =&gt; <span class="c-type">OrderPlaced</span>::<span class="c-key">class</span>,
        <span class="c-str">'updated'</span> =&gt; <span class="c-type">OrderUpdated</span>::<span class="c-key">class</span>,
        <span class="c-str">'deleted'</span> =&gt; <span class="c-type">OrderDeleted</span>::<span class="c-key">class</span>,
    ];
}

<span class="c-comment">// Класс события получает модель через конструктор.</span>
<span class="c-key">class</span> <span class="c-type">OrderPlaced</span>
{
    <span class="c-key">use</span> <span class="c-type">Dispatchable</span>, <span class="c-type">SerializesModels</span>;

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">public</span> <span class="c-type">Order</span> <span class="c-var">$order</span>) {}
}

<span class="c-comment">// Слушатели подключаются стандартно через EventServiceProvider или атрибуты.</span>
<span class="c-key">class</span> <span class="c-type">SendOrderConfirmation</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">OrderPlaced</span> <span class="c-var">$event</span>): <span class="c-key">void</span>
    {
        <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$event</span>-><span class="c-var">order</span>-><span class="c-var">user</span>)-><span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">OrderConfirmationMail</span>(<span class="c-var">$event</span>-><span class="c-var">order</span>));
    }
}
</code></pre>
    </div>

    <div class="card">
      <h3>Состояние модели в событии: <code>isDirty</code>, <code>wasChanged</code>, <code>getOriginal</code></h3>
      <p class="text">Внутри обработчиков доступны методы, позволяющие узнать, какие именно поля изменились. Это полезно для условной логики: реагировать только на изменения конкретных колонок.</p>
<pre><code><span class="c-key">static</span>::<span class="c-fn">updating</span>(<span class="c-key">function</span> (<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">void</span> {
    <span class="c-comment">// До сохранения: что изменилось в текущем save().</span>
    <span class="c-key">if</span> (<span class="c-var">$user</span>-><span class="c-fn">isDirty</span>(<span class="c-str">'email'</span>)) {
        <span class="c-var">$user</span>-><span class="c-var">email_verified_at</span> = <span class="c-key">null</span>;  <span class="c-comment">// сброс верификации при смене email</span>
    }
});

<span class="c-key">static</span>::<span class="c-fn">updated</span>(<span class="c-key">function</span> (<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">void</span> {
    <span class="c-comment">// После сохранения: что было изменено в только что прошедшем save().</span>
    <span class="c-key">if</span> (<span class="c-var">$user</span>-><span class="c-fn">wasChanged</span>(<span class="c-str">'email'</span>)) {
        <span class="c-var">$oldEmail</span> = <span class="c-var">$user</span>-><span class="c-fn">getOriginal</span>(<span class="c-str">'email'</span>);
        <span class="c-type">AuditLog</span>::<span class="c-fn">record</span>(<span class="c-str">'email_changed'</span>, [<span class="c-str">'from'</span> =&gt; <span class="c-var">$oldEmail</span>, <span class="c-str">'to'</span> =&gt; <span class="c-var">$user</span>-><span class="c-var">email</span>]);
    }
});
</code></pre>
      <p class="text">Различие методов:</p>
      <ul class="bullets">
        <li><strong><code>isDirty()</code></strong> &mdash; «изменено по сравнению с последним загруженным состоянием, ещё не сохранено». Используется в обработчиках «до операции» (<code>saving</code>, <code>updating</code>).</li>
        <li><strong><code>wasChanged()</code></strong> &mdash; «было изменено в только что завершённом сохранении». Используется в обработчиках «после операции» (<code>saved</code>, <code>updated</code>).</li>
        <li><strong><code>getOriginal($key)</code></strong> &mdash; значение поля до изменения. Полезно для логов и сравнений.</li>
      </ul>
    </div>

    <div class="card">
      <h3>Подавление событий: <code>withoutEvents()</code> и <code>saveQuietly()</code></h3>
      <p class="text">Иногда требуется выполнить операцию без срабатывания обработчиков &mdash; например, при импорте, миграции данных, обходе бесконечной рекурсии внутри обработчика.</p>
<pre><code><span class="c-comment">// Тихое сохранение одной модели.</span>
<span class="c-var">$user</span>-><span class="c-fn">saveQuietly</span>();
<span class="c-var">$user</span>-><span class="c-fn">deleteQuietly</span>();
<span class="c-var">$user</span>-><span class="c-fn">restoreQuietly</span>();
<span class="c-var">$user</span>-><span class="c-fn">forceDeleteQuietly</span>();

<span class="c-comment">// Блок кода без событий для всех моделей данного типа.</span>
<span class="c-type">User</span>::<span class="c-fn">withoutEvents</span>(<span class="c-key">function</span> () {
    <span class="c-comment">// Здесь можно безопасно вызывать save(), update(), delete()</span>
    <span class="c-comment">// без срабатывания observers и событий.</span>
    <span class="c-type">User</span>::<span class="c-fn">factory</span>()-><span class="c-fn">count</span>(<span class="c-num">10000</span>)-><span class="c-fn">create</span>();
});
</code></pre>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: жизненный цикл статьи в CMS</div>

    <p class="text">Рассмотрим модель <code>Article</code> в CMS, использующую события для нескольких задач одновременно: автоматическая генерация slug, аудит изменений, инвалидация кэша, отправка уведомлений редактору, контроль за допустимыми переходами статусов.</p>

<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Cache</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Str</span>;

<span class="c-key">class</span> <span class="c-type">Article</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$fillable</span> = [<span class="c-str">'title'</span>, <span class="c-str">'slug'</span>, <span class="c-str">'body'</span>, <span class="c-str">'status'</span>, <span class="c-str">'published_at'</span>];

    <span class="c-key">protected</span> <span class="c-var">$dispatchesEvents</span> = [
        <span class="c-str">'created'</span> =&gt; <span class="c-type">ArticleCreated</span>::<span class="c-key">class</span>,
        <span class="c-str">'updated'</span> =&gt; <span class="c-type">ArticleUpdated</span>::<span class="c-key">class</span>,
    ];

    <span class="c-key">protected static function</span> <span class="c-fn">booted</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// 1. Перед сохранением: автогенерация slug, если не задан.</span>
        <span class="c-key">static</span>::<span class="c-fn">saving</span>(<span class="c-key">function</span> (<span class="c-type">Article</span> <span class="c-var">$article</span>): <span class="c-key">void</span> {
            <span class="c-var">$article</span>-><span class="c-var">slug</span> ??= <span class="c-type">Str</span>::<span class="c-fn">slug</span>(<span class="c-var">$article</span>-><span class="c-var">title</span>);
        });

        <span class="c-comment">// 2. Перед обновлением: проверка допустимости перехода статуса.</span>
        <span class="c-key">static</span>::<span class="c-fn">updating</span>(<span class="c-key">function</span> (<span class="c-type">Article</span> <span class="c-var">$article</span>): ?<span class="c-key">bool</span> {
            <span class="c-key">if</span> (! <span class="c-var">$article</span>-><span class="c-fn">isDirty</span>(<span class="c-str">'status'</span>)) {
                <span class="c-key">return</span> <span class="c-key">null</span>;
            }

            <span class="c-var">$from</span> = <span class="c-var">$article</span>-><span class="c-fn">getOriginal</span>(<span class="c-str">'status'</span>);
            <span class="c-var">$to</span>   = <span class="c-var">$article</span>-><span class="c-var">status</span>;
            <span class="c-key">if</span> (! <span class="c-type">ArticleStatus</span>::<span class="c-fn">canTransition</span>(<span class="c-var">$from</span>, <span class="c-var">$to</span>)) {
                <span class="c-key">throw new</span> <span class="c-type">InvalidStateTransition</span>(<span class="c-var">$from</span>, <span class="c-var">$to</span>);
            }

            <span class="c-comment">// При публикации проставляем дату.</span>
            <span class="c-key">if</span> (<span class="c-var">$to</span> === <span class="c-str">'published'</span>) {
                <span class="c-var">$article</span>-><span class="c-var">published_at</span> = <span class="c-fn">now</span>();
            }

            <span class="c-key">return</span> <span class="c-key">null</span>;
        });

        <span class="c-comment">// 3. После сохранения: аудит изменений в журнале.</span>
        <span class="c-key">static</span>::<span class="c-fn">updated</span>(<span class="c-key">function</span> (<span class="c-type">Article</span> <span class="c-var">$article</span>): <span class="c-key">void</span> {
            <span class="c-var">$changes</span> = <span class="c-var">$article</span>-><span class="c-fn">getChanges</span>();
            <span class="c-key">if</span> (! <span class="c-fn">empty</span>(<span class="c-var">$changes</span>)) {
                <span class="c-type">AuditLog</span>::<span class="c-fn">create</span>([
                    <span class="c-str">'auditable_type'</span> =&gt; <span class="c-type">Article</span>::<span class="c-key">class</span>,
                    <span class="c-str">'auditable_id'</span>   =&gt; <span class="c-var">$article</span>-><span class="c-var">id</span>,
                    <span class="c-str">'action'</span>         =&gt; <span class="c-str">'updated'</span>,
                    <span class="c-str">'changes'</span>        =&gt; <span class="c-var">$changes</span>,
                    <span class="c-str">'user_id'</span>        =&gt; <span class="c-fn">auth</span>()-><span class="c-fn">id</span>(),
                ]);
            }
        });

        <span class="c-comment">// 4. После любого сохранения — инвалидация кэшей.</span>
        <span class="c-key">static</span>::<span class="c-fn">saved</span>(<span class="c-key">function</span> (<span class="c-type">Article</span> <span class="c-var">$article</span>): <span class="c-key">void</span> {
            <span class="c-type">Cache</span>::<span class="c-fn">forget</span>(<span class="c-str">"article:{$article->slug}"</span>);
            <span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'articles'</span>])-><span class="c-fn">flush</span>();
        });

        <span class="c-comment">// 5. Перед удалением — запрет на удаление опубликованных статей с комментариями.</span>
        <span class="c-key">static</span>::<span class="c-fn">deleting</span>(<span class="c-key">function</span> (<span class="c-type">Article</span> <span class="c-var">$article</span>): ?<span class="c-key">bool</span> {
            <span class="c-key">if</span> (<span class="c-var">$article</span>-><span class="c-var">status</span> === <span class="c-str">'published'</span> &amp;&amp; <span class="c-var">$article</span>-><span class="c-fn">comments</span>()-><span class="c-fn">exists</span>()) {
                <span class="c-key">return</span> <span class="c-key">false</span>;
            }
            <span class="c-key">return</span> <span class="c-key">null</span>;
        });

        <span class="c-comment">// 6. После удаления — освобождение прикреплённых файлов.</span>
        <span class="c-key">static</span>::<span class="c-fn">deleted</span>(<span class="c-key">function</span> (<span class="c-type">Article</span> <span class="c-var">$article</span>): <span class="c-key">void</span> {
            <span class="c-var">$article</span>-><span class="c-fn">attachments</span>()-><span class="c-fn">each</span>-><span class="c-fn">delete</span>();
        });

        <span class="c-comment">// 7. При репликации — очищаем уникальный slug, чтобы он сгенерировался заново.</span>
        <span class="c-key">static</span>::<span class="c-fn">replicating</span>(<span class="c-key">function</span> (<span class="c-type">Article</span> <span class="c-var">$article</span>): <span class="c-key">void</span> {
            <span class="c-var">$article</span>-><span class="c-var">slug</span>         = <span class="c-key">null</span>;
            <span class="c-var">$article</span>-><span class="c-var">published_at</span> = <span class="c-key">null</span>;
            <span class="c-var">$article</span>-><span class="c-var">status</span>       = <span class="c-str">'draft'</span>;
        });
    }
}
</code></pre>

    <p class="text">Стороннее использование событий через <code>$dispatchesEvents</code> и Event/Listener:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">SendPublishedNotification</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">ArticleUpdated</span> <span class="c-var">$event</span>): <span class="c-key">void</span>
    {
        <span class="c-key">if</span> (<span class="c-var">$event</span>-><span class="c-var">article</span>-><span class="c-fn">wasChanged</span>(<span class="c-str">'status'</span>)
            &amp;&amp; <span class="c-var">$event</span>-><span class="c-var">article</span>-><span class="c-var">status</span> === <span class="c-str">'published'</span>) {

            <span class="c-var">$event</span>-><span class="c-var">article</span>-><span class="c-var">author</span>-><span class="c-fn">notify</span>(<span class="c-key">new</span> <span class="c-type">ArticlePublishedNotification</span>(<span class="c-var">$event</span>-><span class="c-var">article</span>));
        }
    }
}

<span class="c-comment">// Регистрация в EventServiceProvider или через атрибут #[OnEvent].</span>
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. Bulk-операции не вызывают события.</strong> Это самый часто встречающийся источник «исчезнувшей» бизнес-логики. <code>Model::insert()</code>, <code>upsert()</code>, <code>Model::query()-&gt;update(...)</code>, <code>Model::query()-&gt;delete()</code> работают на уровне Query Builder и не проходят цикл Eloquent. Если на событии висит критическая логика (отправка нотификации, обновление поискового индекса), при bulk-операциях её необходимо вызывать явно.
    </div>

    <div class="pitfall">
      <strong>2. Бесконечная рекурсия в <code>saved</code>.</strong> Если внутри обработчика <code>saved</code> вызвать <code>save()</code> на той же модели (например, чтобы заполнить производное поле), это снова вызовет <code>saved</code> &mdash; и так до stack overflow. Решение &mdash; использовать <code>saveQuietly()</code>, либо переносить логику в <code>saving</code> (где изменения попадают в тот же UPDATE).
    </div>

    <div class="pitfall">
      <strong>3. <code>retrieved</code> срабатывает на каждое чтение.</strong> Событие <code>retrieved</code> вызывается при каждой гидрации модели из БД, включая чтения внутри циклов и eager loading. Использование тяжёлой логики в этом обработчике (внешние HTTP-запросы, длительные вычисления) даст экспоненциальную деградацию производительности.
    </div>

    <div class="pitfall">
      <strong>4. <code>isDirty</code> и <code>wasChanged</code>: разница в семантике.</strong> Перед сохранением (<code>saving</code>, <code>updating</code>) используется <code>isDirty</code> &mdash; «что собирается измениться». После сохранения (<code>saved</code>, <code>updated</code>) &mdash; <code>wasChanged</code> &mdash; «что только что изменилось». Путаница приводит к тому, что условие либо всегда срабатывает, либо никогда.
    </div>

    <div class="pitfall">
      <strong>5. Транзакции и события с побочными эффектами.</strong> Если обработчик отправляет email или диспетчит job, а сохранение модели происходит внутри транзакции, побочный эффект сработает <strong>до</strong> commit транзакции. При rollback письмо уже отправлено, queue worker может получить job, ссылающийся на несуществующую запись. Решение &mdash; <code>DB::afterCommit()</code> или свойство <code>public bool $afterCommit = true</code> на job-классе (см. подраздел «Транзакции»).
    </div>

    <div class="pitfall">
      <strong>6. <code>$dispatchesEvents</code> требует совпадения сигнатур.</strong> Класс, указанный в <code>$dispatchesEvents</code>, должен принимать в конструкторе модель в качестве первого аргумента. При несовпадении сигнатуры будет выброшено исключение в момент сохранения модели, что трудно отлаживать в продакшене.
    </div>

    <div class="pitfall">
      <strong>7. Серилизация модели в очередь.</strong> Если событие, привязанное через <code>$dispatchesEvents</code>, обрабатывается в очереди (<code>ShouldQueue</code>), модель сериализуется при постановке job и заново загружается из БД при выполнении. Если до этого времени запись была удалена, job упадёт с <code>ModelNotFoundException</code>. Это нормально и обычно желательно (повторная попытка имеет смысл только если данные актуальны), но требует учёта при проектировании поведения retry.
    </div>

    <div class="pitfall">
      <strong>8. Тестирование событий моделей.</strong> Для unit-тестов, в которых не должны срабатывать побочные эффекты, используется <code>Event::fake()</code> для классов, перечисленных в <code>$dispatchesEvents</code>. Для внутренних событий жизненного цикла (<code>creating</code>, <code>saved</code> и т. п.) <code>Event::fake()</code> не работает; для их отключения применяется <code>Model::withoutEvents()</code> или явная замена модели в тесте.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     EVENTS — OBSERVERS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-event-observer" class="section">
  <div class="section-title">Observers</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Observer &mdash; класс, группирующий обработчики нескольких событий жизненного цикла одной модели в едином файле. По функциональности эквивалентен набору подписок через <code>booted()</code>, но даёт лучшую структуру кода и поддерживает Dependency Injection в методы.</p>
    <p class="text">Применяется, когда количество обработчиков события превышает 2-3, либо когда логика реакций тесно связана между собой и должна развиваться как единое целое: подсистема аудита, нормализация данных, каскадные операции по жизненному циклу.</p>
    <p class="text">Observer не подменяет <code>$dispatchesEvents</code> и Event/Listener &mdash; они решают разные задачи. Observer удобен для логики, привязанной к модели и её жизненному циклу (создал User &mdash; создай Profile). Event/Listener подходит для широких доменных событий, на которые подписывается множество независимых слушателей (OrderPlaced &mdash; отправь email, обнови inventory, обнови аналитику). Часто оба механизма используются параллельно: observer выполняет «инфраструктурную» логику, а <code>$dispatchesEvents</code> диспетчит event для бизнес-реакций.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень компонентов</div>

    <div class="card">
      <h3>Создание Observer</h3>
      <p class="text">Класс генерируется командой Artisan. Опция <code>--model</code> создаёт каркас с пустыми методами для всех типовых событий выбранной модели.</p>
<pre><code>php artisan make:observer UserObserver --model=User</code></pre>
<pre><code><span class="c-key">namespace</span> <span class="c-type">App\Observers</span>;

<span class="c-key">use</span> <span class="c-type">App\Models\User</span>;
<span class="c-key">use</span> <span class="c-type">App\Services\AdminAlertService</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Mail</span>;

<span class="c-key">class</span> <span class="c-type">UserObserver</span>
{
    <span class="c-comment">// Dependency injection через конструктор.</span>
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private readonly</span> <span class="c-type">AdminAlertService</span> <span class="c-var">$alerts</span>,
    ) {}

    <span class="c-key">public function</span> <span class="c-fn">created</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$user</span>-><span class="c-fn">profile</span>()-><span class="c-fn">create</span>([<span class="c-str">'bio'</span> =&gt; <span class="c-str">''</span>]);
        <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$user</span>)-><span class="c-fn">queue</span>(<span class="c-key">new</span> <span class="c-type">WelcomeMail</span>(<span class="c-var">$user</span>));
    }

    <span class="c-key">public function</span> <span class="c-fn">updated</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">void</span>
    {
        <span class="c-key">if</span> (<span class="c-var">$user</span>-><span class="c-fn">wasChanged</span>(<span class="c-str">'email'</span>)) {
            <span class="c-var">$user</span>-><span class="c-fn">notify</span>(<span class="c-key">new</span> <span class="c-type">EmailChangedNotification</span>());
        }
    }

    <span class="c-key">public function</span> <span class="c-fn">deleted</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$this</span>-><span class="c-var">alerts</span>-><span class="c-fn">notify</span>(<span class="c-str">"Пользователь удалён: {$user->email}"</span>);
    }
}
</code></pre>
      <p class="text">Имена методов observer'а должны точно соответствовать именам событий жизненного цикла Eloquent: <code>retrieved</code>, <code>creating</code>, <code>created</code>, <code>updating</code>, <code>updated</code>, <code>saving</code>, <code>saved</code>, <code>deleting</code>, <code>deleted</code>, <code>trashed</code>, <code>restoring</code>, <code>restored</code>, <code>forceDeleted</code>, <code>replicating</code>. Методы, отсутствующие в классе, просто игнорируются.</p>
    </div>

    <div class="card">
      <h3>Регистрация: ServiceProvider</h3>
      <p class="text">Классический способ &mdash; явный вызов <code>Model::observe()</code> в методе <code>boot()</code> провайдера. Применяется во всех версиях Laravel.</p>
<pre><code><span class="c-comment">// app/Providers/AppServiceProvider.php</span>
<span class="c-key">use</span> <span class="c-type">App\Models\User</span>;
<span class="c-key">use</span> <span class="c-type">App\Observers\UserObserver</span>;

<span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
{
    <span class="c-type">User</span>::<span class="c-fn">observe</span>(<span class="c-type">UserObserver</span>::<span class="c-key">class</span>);
    <span class="c-type">Article</span>::<span class="c-fn">observe</span>(<span class="c-type">ArticleObserver</span>::<span class="c-key">class</span>);
    <span class="c-type">Order</span>::<span class="c-fn">observe</span>([<span class="c-type">OrderObserver</span>::<span class="c-key">class</span>, <span class="c-type">OrderAuditObserver</span>::<span class="c-key">class</span>]);
}
</code></pre>
      <p class="text">К одной модели можно подключить несколько observer'ов, в том числе разделяя реакции по ответственностям (отдельный observer для аудита, отдельный для уведомлений). Они вызываются в порядке регистрации.</p>
    </div>

    <div class="card">
      <h3>Регистрация: атрибут <code>#[ObservedBy]</code> (Laravel 11+)</h3>
      <p class="text">Альтернативный декларативный способ &mdash; атрибут на самой модели. Не требует изменений в провайдерах, делает связь модели и observer явной в её собственном файле.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Attributes\ObservedBy</span>;

#[<span class="c-type">ObservedBy</span>([<span class="c-type">UserObserver</span>::<span class="c-key">class</span>])]
<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Authenticatable</span>
{
    <span class="c-comment">// ...</span>
}

<span class="c-comment">// Можно подключить несколько observers через массив.</span>
#[<span class="c-type">ObservedBy</span>([<span class="c-type">UserObserver</span>::<span class="c-key">class</span>, <span class="c-type">UserAuditObserver</span>::<span class="c-key">class</span>])]
<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Authenticatable</span> { }
</code></pre>
    </div>

    <div class="card">
      <h3>Управление событиями: <code>withoutEvents</code>, <code>saveQuietly</code></h3>
      <p class="text">При необходимости временно отключить срабатывание observer'а используются те же механизмы, что и для обычных событий модели.</p>
<pre><code><span class="c-comment">// Тихое сохранение конкретного инстанса.</span>
<span class="c-var">$user</span>-><span class="c-fn">saveQuietly</span>();        <span class="c-comment">// observers не вызовутся</span>
<span class="c-var">$user</span>-><span class="c-fn">deleteQuietly</span>();
<span class="c-var">$user</span>-><span class="c-fn">restoreQuietly</span>();

<span class="c-comment">// Блок кода без событий — для импортов, миграций, рекурсивных сценариев.</span>
<span class="c-type">User</span>::<span class="c-fn">withoutEvents</span>(<span class="c-key">function</span> () {
    <span class="c-type">User</span>::<span class="c-fn">factory</span>()-><span class="c-fn">count</span>(<span class="c-num">10_000</span>)-><span class="c-fn">create</span>();
});
</code></pre>
    </div>

    <div class="card">
      <h3>Сравнение Observer / Event-Listener / Bootable Trait</h3>
      <table class="data-table">
        <tr><th>Подход</th><th>Применение</th><th>Особенности</th></tr>
        <tr><td><strong>Observer</strong></td><td>Логика, тесно связанная с одной моделью (User создаёт Profile, Article генерирует slug)</td><td>Один класс на модель; DI в конструктор; всегда выполняется синхронно</td></tr>
        <tr><td><strong>Event + Listener</strong></td><td>Доменные события с множеством независимых реакций (OrderPlaced &rarr; email, inventory, analytics)</td><td>Через <code>$dispatchesEvents</code>; слушатели могут быть в очереди (<code>ShouldQueue</code>); тестируются через <code>Event::fake()</code></td></tr>
        <tr><td><strong>Bootable Trait</strong></td><td>Переиспользуемое поведение на нескольких моделях (HasSlug, HasUuid, HasTimestamps)</td><td>Подключается через <code>use Trait</code>; обработчики в методе <code>boot{TraitName}()</code></td></tr>
      </table>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: полная подсистема жизненного цикла пользователя</div>

    <p class="text">Рассмотрим модель <code>User</code>, для которой требуется обширная инфраструктурная логика: при создании автоматически формируется профиль, отправляется welcome-email, генерируется API-токен; при изменении email сбрасывается верификация и логируется событие; при удалении пользователя соблюдаются регуляторные требования по сохранности данных; при смене пароля очищаются все активные сессии и оповещаются ответственные администраторы. Использование двух observers разделяет ответственности.</p>

<pre><code><span class="c-comment">// app/Observers/UserLifecycleObserver.php — инфраструктурная логика</span>
<span class="c-key">namespace</span> <span class="c-type">App\Observers</span>;

<span class="c-key">use</span> <span class="c-type">App\Models\User</span>;
<span class="c-key">use</span> <span class="c-type">App\Notifications\PasswordChangedNotification</span>;
<span class="c-key">use</span> <span class="c-type">App\Notifications\WelcomeNotification</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\DB</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Str</span>;

<span class="c-key">class</span> <span class="c-type">UserLifecycleObserver</span>
{
    <span class="c-comment">// 1. Перед сохранением — нормализация email и автогенерация UUID при создании.</span>
    <span class="c-key">public function</span> <span class="c-fn">creating</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$user</span>-><span class="c-var">uuid</span>  ??= (<span class="c-key">string</span>) <span class="c-type">Str</span>::<span class="c-fn">uuid</span>();
        <span class="c-var">$user</span>-><span class="c-var">email</span>   = <span class="c-fn">strtolower</span>(<span class="c-fn">trim</span>(<span class="c-var">$user</span>-><span class="c-var">email</span>));
    }

    <span class="c-comment">// 2. После создания — создание зависимых сущностей в одной транзакции.</span>
    <span class="c-key">public function</span> <span class="c-fn">created</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">void</span>
    {
        <span class="c-type">DB</span>::<span class="c-fn">afterCommit</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$user</span>) {
            <span class="c-var">$user</span>-><span class="c-fn">profile</span>()-><span class="c-fn">create</span>([<span class="c-str">'bio'</span> =&gt; <span class="c-str">''</span>]);
            <span class="c-var">$user</span>-><span class="c-fn">apiTokens</span>()-><span class="c-fn">create</span>([<span class="c-str">'name'</span> =&gt; <span class="c-str">'default'</span>, <span class="c-str">'token'</span> =&gt; <span class="c-type">Str</span>::<span class="c-fn">random</span>(<span class="c-num">60</span>)]);
            <span class="c-var">$user</span>-><span class="c-fn">notify</span>(<span class="c-key">new</span> <span class="c-type">WelcomeNotification</span>());
        });
    }

    <span class="c-comment">// 3. При смене email — сброс верификации и логирование.</span>
    <span class="c-key">public function</span> <span class="c-fn">updating</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">void</span>
    {
        <span class="c-key">if</span> (<span class="c-var">$user</span>-><span class="c-fn">isDirty</span>(<span class="c-str">'email'</span>)) {
            <span class="c-var">$user</span>-><span class="c-var">email_verified_at</span> = <span class="c-key">null</span>;
        }
    }

    <span class="c-comment">// 4. При смене пароля — очистка всех сессий и уведомление пользователя.</span>
    <span class="c-key">public function</span> <span class="c-fn">updated</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">void</span>
    {
        <span class="c-key">if</span> (<span class="c-var">$user</span>-><span class="c-fn">wasChanged</span>(<span class="c-str">'password'</span>)) {
            <span class="c-type">DB</span>::<span class="c-fn">table</span>(<span class="c-str">'sessions'</span>)-><span class="c-fn">where</span>(<span class="c-str">'user_id'</span>, <span class="c-var">$user</span>-><span class="c-var">id</span>)-><span class="c-fn">delete</span>();
            <span class="c-var">$user</span>-><span class="c-fn">notify</span>(<span class="c-key">new</span> <span class="c-type">PasswordChangedNotification</span>());
        }
    }

    <span class="c-comment">// 5. При удалении — анонимизация и сохранение для отчётности.</span>
    <span class="c-key">public function</span> <span class="c-fn">deleting</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">void</span>
    {
        <span class="c-key">if</span> (! <span class="c-var">$user</span>-><span class="c-fn">isForceDeleting</span>()) {
            <span class="c-comment">// soft delete — анонимизируем PII, сохраняя структурную целостность.</span>
            <span class="c-var">$user</span>-><span class="c-fn">forceFill</span>([
                <span class="c-str">'email'</span> =&gt; <span class="c-str">"deleted-{$user->id}@example.invalid"</span>,
                <span class="c-str">'name'</span>  =&gt; <span class="c-str">'(deleted)'</span>,
                <span class="c-str">'phone'</span> =&gt; <span class="c-key">null</span>,
            ])-><span class="c-fn">saveQuietly</span>();
        }
    }
}

<span class="c-comment">// app/Observers/UserAuditObserver.php — отдельный observer для аудита.</span>
<span class="c-key">class</span> <span class="c-type">UserAuditObserver</span>
{
    <span class="c-key">public function</span> <span class="c-fn">created</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">void</span>
    {
        <span class="c-type">AuditLog</span>::<span class="c-fn">record</span>(<span class="c-str">'user.created'</span>, <span class="c-var">$user</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">updated</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">void</span>
    {
        <span class="c-type">AuditLog</span>::<span class="c-fn">record</span>(<span class="c-str">'user.updated'</span>, <span class="c-var">$user</span>, [
            <span class="c-str">'changes'</span> =&gt; <span class="c-var">$user</span>-><span class="c-fn">getChanges</span>(),
        ]);
    }

    <span class="c-key">public function</span> <span class="c-fn">deleted</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">void</span>
    {
        <span class="c-type">AuditLog</span>::<span class="c-fn">record</span>(<span class="c-str">'user.deleted'</span>, <span class="c-var">$user</span>);
    }
}
</code></pre>

    <p class="text">Подключение обоих observers через атрибут на модели:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Attributes\ObservedBy</span>;

#[<span class="c-type">ObservedBy</span>([<span class="c-type">UserLifecycleObserver</span>::<span class="c-key">class</span>, <span class="c-type">UserAuditObserver</span>::<span class="c-key">class</span>])]
<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Authenticatable</span>
{
    <span class="c-key">use</span> <span class="c-type">SoftDeletes</span>;
}
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. Бесконечная рекурсия в <code>saved</code>.</strong> Метод <code>saved</code> вызывается после каждого сохранения; внутри него вызов <code>$model-&gt;save()</code> снова триггерит <code>saved</code> и приводит к stack overflow. Решение &mdash; использовать <code>saveQuietly()</code>, либо переносить логику в <code>saving</code>, где значения попадают в тот же UPDATE без дополнительного запроса.
    </div>

    <div class="pitfall">
      <strong>2. Bulk-операции не вызывают observers.</strong> Прямые операции через Query Builder (<code>insert</code>, <code>update</code> на запросе, <code>delete</code> на запросе) минуют цикл Eloquent. Если бизнес-логика реализована в observer, при bulk-операциях она не сработает. Это особенно опасно при миграциях данных и пакетных обновлениях.
    </div>

    <div class="pitfall">
      <strong>3. Side effects до commit транзакции.</strong> Если observer отправляет email, диспетчит job или вызывает внешний API, а сохранение модели происходит внутри транзакции, побочный эффект сработает <strong>до</strong> commit. При rollback транзакции письмо уже отправлено, и пользователь получит уведомление о действии, которого фактически не произошло. Защита &mdash; <code>DB::afterCommit(fn() =&gt; ...)</code> внутри observer, либо <code>public bool $afterCommit = true</code> на job-классе.
    </div>

    <div class="pitfall">
      <strong>4. Observer и <code>retrieved</code>.</strong> Метод <code>retrieved</code> вызывается при каждой гидрации модели из БД, включая внутренние операции eager loading. Тяжёлая логика в этом обработчике (внешние запросы, тяжёлые вычисления) приводит к экспоненциальной деградации производительности при выборках большого числа записей.
    </div>

    <div class="pitfall">
      <strong>5. Порядок выполнения нескольких observers.</strong> При подключении нескольких observers на одну модель они вызываются в порядке регистрации. Если порядок имеет значение (например, один observer полагается на результат другого), это должно быть явно отражено в коде и документации, поскольку случайное переупорядочивание провайдеров может изменить поведение.
    </div>

    <div class="pitfall">
      <strong>6. Observer и тестирование.</strong> Стандартные методы тестирования событий (<code>Event::fake()</code>) <strong>не подавляют</strong> observers. Для тестов, в которых требуется обойти observer (например, при создании фабрикой большого количества записей), используется <code>Model::withoutEvents()</code>:
<pre style="margin-top:8px;margin-bottom:0;"><code><span class="c-type">User</span>::<span class="c-fn">withoutEvents</span>(<span class="c-key">fn</span> () =&gt; <span class="c-type">User</span>::<span class="c-fn">factory</span>()-><span class="c-fn">count</span>(<span class="c-num">100</span>)-><span class="c-fn">create</span>());</code></pre>
    </div>

    <div class="pitfall">
      <strong>7. Зависимости в конструкторе observer.</strong> Observer разрешается через service container Laravel и поддерживает DI. Это удобно для подстановки сервисов, но требует осторожности при работе с request-scoped зависимостями (текущий пользователь, идентификатор тенанта): observer на event может сработать в очереди или Artisan-команде, где этих зависимостей нет.
    </div>

    <div class="pitfall">
      <strong>8. Observer и Soft Deletes: <code>deleted</code> для обоих видов удаления.</strong> Метод <code>deleted</code> в observer срабатывает как при soft delete, так и при force delete. Чтобы различить ситуации, используется <code>$model-&gt;isForceDeleting()</code>. Для исключительно soft delete существует отдельный метод <code>trashed</code>; для force delete &mdash; <code>forceDeleted</code> (Laravel 11+).
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     EVENTS — TRAITS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-event-traits" class="section">
  <div class="section-title">Bootable traits</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Bootable trait &mdash; механизм автоматической инициализации поведения модели при её загрузке. Если в трейте определён статический метод с именем <code>boot{TraitName}()</code>, Eloquent вызывает его автоматически при первой загрузке использующей модели. Это позволяет инкапсулировать как обработчики событий жизненного цикла, так и регистрацию scopes, в переиспользуемом виде.</p>
    <p class="text">На этом механизме реализованы все встроенные трейты Eloquent: <code>SoftDeletes</code>, <code>HasFactory</code>, <code>Notifiable</code>, <code>MassPrunable</code>, <code>HasUuids</code>. Каждый из них &mdash; обычный PHP-трейт с методом <code>boot{Name}()</code>, регистрирующим необходимые scopes и обработчики событий.</p>
    <p class="text">Применение собственных bootable traits оправдано, когда одно и то же поведение требуется на нескольких моделях: автогенерация slug, проставление UUID, аудит изменений, кеширование, привязка к тенанту, поддержка тегов. Альтернативы &mdash; абстрактные базовые классы (нарушают возможность наследования от <code>Authenticatable</code>) или копирование кода в каждую модель (нарушает DRY).</p>
    <p class="text">Помимо <code>boot{Name}()</code>, трейт может определять метод <code>initialize{TraitName}()</code>, вызываемый <strong>для каждого инстанса</strong> модели при его создании &mdash; это полезно для проставления значений по умолчанию, не зависящих от события <code>creating</code>.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень компонентов</div>

    <div class="card">
      <h3>Статический инициализатор <code>boot{TraitName}()</code></h3>
      <p class="text">Метод вызывается один раз при первой загрузке модели приложения. Используется для регистрации глобальных scopes, подписки на события жизненного цикла, объявления Macros и любой инициализации, общей для всех инстансов.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Model</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Str</span>;

<span class="c-key">trait</span> <span class="c-type">HasSlug</span>
{
    <span class="c-key">public static function</span> <span class="c-fn">bootHasSlug</span>(): <span class="c-key">void</span>
    {
        <span class="c-key">static</span>::<span class="c-fn">creating</span>(<span class="c-key">function</span> (<span class="c-type">Model</span> <span class="c-var">$model</span>): <span class="c-key">void</span> {
            <span class="c-key">if</span> (<span class="c-fn">empty</span>(<span class="c-var">$model</span>-><span class="c-var">slug</span>)) {
                <span class="c-var">$model</span>-><span class="c-var">slug</span> = <span class="c-type">Str</span>::<span class="c-fn">slug</span>(<span class="c-var">$model</span>-><span class="c-fn">getSlugSource</span>());
            }
        });

        <span class="c-key">static</span>::<span class="c-fn">updating</span>(<span class="c-key">function</span> (<span class="c-type">Model</span> <span class="c-var">$model</span>): <span class="c-key">void</span> {
            <span class="c-comment">// При изменении источника slug перегенерируем slug,</span>
            <span class="c-comment">// если не задан явно.</span>
            <span class="c-key">if</span> (<span class="c-var">$model</span>-><span class="c-fn">isDirty</span>(<span class="c-var">$model</span>-><span class="c-fn">getSlugSourceColumn</span>())
                &amp;&amp; ! <span class="c-var">$model</span>-><span class="c-fn">isDirty</span>(<span class="c-str">'slug'</span>)) {
                <span class="c-var">$model</span>-><span class="c-var">slug</span> = <span class="c-type">Str</span>::<span class="c-fn">slug</span>(<span class="c-var">$model</span>-><span class="c-fn">getSlugSource</span>());
            }
        });
    }

    <span class="c-comment">// Контракт, который реализуют использующие модели.</span>
    <span class="c-key">abstract public function</span> <span class="c-fn">getSlugSource</span>(): <span class="c-key">string</span>;

    <span class="c-key">public function</span> <span class="c-fn">getSlugSourceColumn</span>(): <span class="c-key">string</span>
    {
        <span class="c-key">return</span> <span class="c-str">'title'</span>;
    }
}
</code></pre>
    </div>

    <div class="card">
      <h3>Инстанс-инициализатор <code>initialize{TraitName}()</code></h3>
      <p class="text">Метод вызывается в конструкторе каждой новой модели, до применения mass-assignment из переданных атрибутов. Применяется для проставления значений по умолчанию, добавления полей в <code>$fillable</code> или <code>$casts</code> программно.</p>
<pre><code><span class="c-key">trait</span> <span class="c-type">HasUuids</span>
{
    <span class="c-key">public function</span> <span class="c-fn">initializeHasUuids</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// Добавляем колонку uuid в fillable программно,</span>
        <span class="c-comment">// чтобы её не нужно было перечислять в каждой модели вручную.</span>
        <span class="c-var">$this</span>-><span class="c-fn">mergeFillable</span>([<span class="c-str">'uuid'</span>]);
        <span class="c-var">$this</span>-><span class="c-fn">mergeCasts</span>([<span class="c-str">'uuid'</span> =&gt; <span class="c-str">'string'</span>]);
    }

    <span class="c-key">public static function</span> <span class="c-fn">bootHasUuids</span>(): <span class="c-key">void</span>
    {
        <span class="c-key">static</span>::<span class="c-fn">creating</span>(<span class="c-key">function</span> (<span class="c-type">Model</span> <span class="c-var">$model</span>): <span class="c-key">void</span> {
            <span class="c-var">$model</span>-><span class="c-var">uuid</span> ??= (<span class="c-key">string</span>) <span class="c-type">Str</span>::<span class="c-fn">uuid</span>();
        });
    }
}
</code></pre>
    </div>

    <div class="card">
      <h3>Сравнение методов инициализации</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>Где определяется</th><th>Когда вызывается</th><th>Применение</th></tr>
        <tr><td><code>boot()</code></td><td>В классе модели</td><td>Один раз при первой загрузке класса</td><td>Базовая инициализация. Требует вызова <code>parent::boot()</code>.</td></tr>
        <tr><td><code>booted()</code></td><td>В классе модели</td><td>После завершения <code>boot()</code> и всех <code>boot{Trait}</code></td><td>Регистрация global scopes и event subscriptions. Не требует вызова parent.</td></tr>
        <tr><td><code>boot{TraitName}()</code></td><td>В трейте</td><td>Один раз при первой загрузке модели, использующей трейт</td><td>Инициализация повторно используемого поведения.</td></tr>
        <tr><td><code>initialize{TraitName}()</code></td><td>В трейте</td><td>При создании каждого экземпляра модели</td><td>Дополнение <code>$fillable</code>, <code>$casts</code>, <code>$hidden</code>; значения по умолчанию.</td></tr>
      </table>
    </div>

    <div class="card">
      <h3>Контракты и абстрактные методы в трейтах</h3>
      <p class="text">Поскольку трейт не может полноценно объявить контракт, для обязательных методов используется один из подходов:</p>
      <ul class="bullets">
        <li><strong>Абстрактный метод в трейте</strong> &mdash; самый простой способ; PHP при компиляции обяжет дочернюю модель реализовать метод. Однако это работает только если использующий класс сам абстрактный или явно реализует метод.</li>
        <li><strong>Интерфейс</strong> &mdash; чище: трейт ничего не требует, но в документации трейта указано, что использующая модель должна реализовать конкретный интерфейс. PHP-IDE и статический анализ это поймут.</li>
        <li><strong>Значения по умолчанию через переопределяемые методы</strong> &mdash; если поведение опционально настраиваемо, трейт предоставляет метод с разумным значением по умолчанию, который модель может переопределить.</li>
      </ul>
<pre><code><span class="c-key">interface</span> <span class="c-type">Sluggable</span>
{
    <span class="c-key">public function</span> <span class="c-fn">getSlugSource</span>(): <span class="c-key">string</span>;
}

<span class="c-key">trait</span> <span class="c-type">HasSlug</span>
{
    <span class="c-comment">// Метод по умолчанию — модель может его переопределить.</span>
    <span class="c-key">public function</span> <span class="c-fn">getSlugSourceColumn</span>(): <span class="c-key">string</span>
    {
        <span class="c-key">return</span> <span class="c-str">'title'</span>;
    }

    <span class="c-comment">// boot и initialize методы как раньше.</span>
}

<span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span> <span class="c-key">implements</span> <span class="c-type">Sluggable</span>
{
    <span class="c-key">use</span> <span class="c-type">HasSlug</span>;

    <span class="c-key">public function</span> <span class="c-fn">getSlugSource</span>(): <span class="c-key">string</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-var">title</span>;
    }
}
</code></pre>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: набор переиспользуемых трейтов</div>

    <p class="text">Рассмотрим набор трейтов, типичный для среднего и крупного приложения: <code>HasUuid</code> для публичных идентификаторов, <code>HasSlug</code> для URL-friendly строк, <code>TracksUserActivity</code> для проставления автора создания и последнего изменения. Каждый трейт самодостаточен, не конфликтует с другими и может быть подключён к произвольной модели.</p>

<pre><code><span class="c-comment">// app/Models/Concerns/HasUuid.php</span>
<span class="c-key">namespace</span> <span class="c-type">App\Models\Concerns</span>;

<span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Model</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Str</span>;

<span class="c-key">trait</span> <span class="c-type">HasUuid</span>
{
    <span class="c-key">public function</span> <span class="c-fn">initializeHasUuid</span>(): <span class="c-key">void</span>
    {
        <span class="c-var">$this</span>-><span class="c-fn">mergeCasts</span>([<span class="c-str">'uuid'</span> =&gt; <span class="c-str">'string'</span>]);
    }

    <span class="c-key">public static function</span> <span class="c-fn">bootHasUuid</span>(): <span class="c-key">void</span>
    {
        <span class="c-key">static</span>::<span class="c-fn">creating</span>(<span class="c-key">function</span> (<span class="c-type">Model</span> <span class="c-var">$model</span>): <span class="c-key">void</span> {
            <span class="c-var">$model</span>-><span class="c-var">uuid</span> ??= (<span class="c-key">string</span>) <span class="c-type">Str</span>::<span class="c-fn">uuid</span>();
        });
    }

    <span class="c-comment">// Для маршрутизации по UUID вместо id.</span>
    <span class="c-key">public function</span> <span class="c-fn">getRouteKeyName</span>(): <span class="c-key">string</span>
    {
        <span class="c-key">return</span> <span class="c-str">'uuid'</span>;
    }
}

<span class="c-comment">// app/Models/Concerns/HasSlug.php</span>
<span class="c-key">trait</span> <span class="c-type">HasSlug</span>
{
    <span class="c-key">public static function</span> <span class="c-fn">bootHasSlug</span>(): <span class="c-key">void</span>
    {
        <span class="c-key">static</span>::<span class="c-fn">saving</span>(<span class="c-key">function</span> (<span class="c-type">Model</span> <span class="c-var">$model</span>): <span class="c-key">void</span> {
            <span class="c-key">if</span> (<span class="c-fn">empty</span>(<span class="c-var">$model</span>-><span class="c-var">slug</span>) || <span class="c-var">$model</span>-><span class="c-fn">isDirty</span>(<span class="c-var">$model</span>-><span class="c-fn">getSlugSourceColumn</span>())) {
                <span class="c-var">$model</span>-><span class="c-var">slug</span> = <span class="c-var">$model</span>-><span class="c-fn">generateUniqueSlug</span>(
                    <span class="c-var">$model</span>-><span class="c-fn">getAttribute</span>(<span class="c-var">$model</span>-><span class="c-fn">getSlugSourceColumn</span>())
                );
            }
        });
    }

    <span class="c-key">public function</span> <span class="c-fn">getSlugSourceColumn</span>(): <span class="c-key">string</span>
    {
        <span class="c-key">return</span> <span class="c-str">'title'</span>;
    }

    <span class="c-key">protected function</span> <span class="c-fn">generateUniqueSlug</span>(<span class="c-key">string</span> <span class="c-var">$source</span>): <span class="c-key">string</span>
    {
        <span class="c-var">$base</span>  = <span class="c-type">Str</span>::<span class="c-fn">slug</span>(<span class="c-var">$source</span>);
        <span class="c-var">$slug</span>  = <span class="c-var">$base</span>;
        <span class="c-var">$count</span> = <span class="c-num">2</span>;

        <span class="c-key">while</span> (<span class="c-key">static</span>::<span class="c-fn">where</span>(<span class="c-str">'slug'</span>, <span class="c-var">$slug</span>)
            -><span class="c-fn">when</span>(<span class="c-var">$this</span>-><span class="c-fn">exists</span>, <span class="c-key">fn</span> (<span class="c-var">$q</span>) =&gt; <span class="c-var">$q</span>-><span class="c-fn">whereKeyNot</span>(<span class="c-var">$this</span>-><span class="c-fn">getKey</span>()))
            -><span class="c-fn">exists</span>()
        ) {
            <span class="c-var">$slug</span> = <span class="c-str">"{$base}-{$count}"</span>;
            <span class="c-var">$count</span>++;
        }

        <span class="c-key">return</span> <span class="c-var">$slug</span>;
    }
}

<span class="c-comment">// app/Models/Concerns/TracksUserActivity.php</span>
<span class="c-key">trait</span> <span class="c-type">TracksUserActivity</span>
{
    <span class="c-key">public static function</span> <span class="c-fn">bootTracksUserActivity</span>(): <span class="c-key">void</span>
    {
        <span class="c-key">static</span>::<span class="c-fn">creating</span>(<span class="c-key">function</span> (<span class="c-type">Model</span> <span class="c-var">$model</span>): <span class="c-key">void</span> {
            <span class="c-var">$model</span>-><span class="c-var">created_by_user_id</span> ??= <span class="c-fn">auth</span>()-><span class="c-fn">id</span>();
            <span class="c-var">$model</span>-><span class="c-var">updated_by_user_id</span> = <span class="c-fn">auth</span>()-><span class="c-fn">id</span>();
        });

        <span class="c-key">static</span>::<span class="c-fn">updating</span>(<span class="c-key">function</span> (<span class="c-type">Model</span> <span class="c-var">$model</span>): <span class="c-key">void</span> {
            <span class="c-var">$model</span>-><span class="c-var">updated_by_user_id</span> = <span class="c-fn">auth</span>()-><span class="c-fn">id</span>();
        });
    }

    <span class="c-key">public function</span> <span class="c-fn">createdBy</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsTo</span>(<span class="c-type">User</span>::<span class="c-key">class</span>, <span class="c-str">'created_by_user_id'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">updatedBy</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">belongsTo</span>(<span class="c-type">User</span>::<span class="c-key">class</span>, <span class="c-str">'updated_by_user_id'</span>);
    }
}
</code></pre>

    <p class="text">Использование всех трёх трейтов на модели <code>Article</code>:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">App\Models\Concerns\HasSlug</span>;
<span class="c-key">use</span> <span class="c-type">App\Models\Concerns\HasUuid</span>;
<span class="c-key">use</span> <span class="c-type">App\Models\Concerns\TracksUserActivity</span>;

<span class="c-key">class</span> <span class="c-type">Article</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">use</span> <span class="c-type">HasUuid</span>, <span class="c-type">HasSlug</span>, <span class="c-type">TracksUserActivity</span>;

    <span class="c-key">protected</span> <span class="c-var">$fillable</span> = [<span class="c-str">'title'</span>, <span class="c-str">'body'</span>, <span class="c-str">'status'</span>];

    <span class="c-comment">// Никакой кастомизации для трейтов не требуется — используются дефолты:</span>
    <span class="c-comment">// HasUuid → колонка uuid с автогенерацией</span>
    <span class="c-comment">// HasSlug → колонка slug на основе title</span>
    <span class="c-comment">// TracksUserActivity → колонки created_by_user_id, updated_by_user_id</span>
}

<span class="c-comment">// Кастомизация: использовать другую колонку как источник slug.</span>
<span class="c-key">class</span> <span class="c-type">Project</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">use</span> <span class="c-type">HasUuid</span>, <span class="c-type">HasSlug</span>, <span class="c-type">TracksUserActivity</span>;

    <span class="c-key">public function</span> <span class="c-fn">getSlugSourceColumn</span>(): <span class="c-key">string</span>
    {
        <span class="c-key">return</span> <span class="c-str">'name'</span>;
    }
}
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. Несоответствие имени метода и trait.</strong> Eloquent ищет метод по точному соответствию имени класса трейта (без неймспейса). Если трейт называется <code>App\Concerns\HasSlug</code>, метод должен быть <code>bootHasSlug</code>, а не <code>bootConcernsHasSlug</code>. Опечатка в имени метода не порождает ошибку &mdash; метод просто не вызовется, и поведение трейта не активируется.
    </div>

    <div class="pitfall">
      <strong>2. Конфликт имён трейтов.</strong> Если два трейта определяют одинаковый метод с одной сигнатурой, PHP требует явного разрешения конфликта через <code>insteadof</code> или <code>as</code>. Чтобы избежать этого, имена методов делаются специфичными (включающими имя трейта), и трейты не дублируют функциональность.
    </div>

    <div class="pitfall">
      <strong>3. Регистрация global scope в трейте.</strong> Если несколько трейтов регистрируют глобальные scopes с одинаковыми именами, последний регистрировавшийся переопределит предыдущие. Используйте уникальные имена scopes или классы-обёртки.
    </div>

    <div class="pitfall">
      <strong>4. <code>boot</code> в модели и <code>parent::boot()</code>.</strong> Если в модели переопределяется метод <code>boot()</code>, необходимо вызвать <code>parent::boot()</code> в начале &mdash; иначе bootable traits не инициализируются. Метод <code>booted()</code> такого требования не имеет.
    </div>

    <div class="pitfall">
      <strong>5. <code>initialize{Trait}</code> вызывается для каждого инстанса.</strong> Этот метод срабатывает не один раз на класс, а на каждой гидрации модели &mdash; при чтении, при <code>new Model</code>, при <code>Model::factory()-&gt;make()</code>. Тяжёлая логика в нём приведёт к деградации производительности на больших выборках.
    </div>

    <div class="pitfall">
      <strong>6. Зависимость трейта от <code>auth()-&gt;id()</code> в фоновых задачах.</strong> Трейт вроде <code>TracksUserActivity</code> работает корректно в HTTP-запросе, но в Artisan-командах, очередях, фабриках сидеров <code>auth()-&gt;id()</code> возвращает <code>null</code>. Для таких сценариев предусматриваются либо отдельная техническая учётная запись, либо явное проставление значения, либо отключение трейта через <code>withoutEvents</code>.
    </div>

    <div class="pitfall">
      <strong>7. Использование <code>this</code> в <code>boot{Trait}</code>.</strong> Метод <code>boot{Trait}</code> &mdash; статический, и <code>$this</code> в нём недоступен. Внутри замыканий, регистрируемых на события (<code>static::creating(...)</code>), доступна модель через аргумент замыкания.
    </div>

    <div class="pitfall">
      <strong>8. Тестирование bootable traits.</strong> При тестировании трейтов целесообразно использовать «временные» модели &mdash; классы, создаваемые внутри теста и наследующие <code>Model</code>, &mdash; в которые подключается тестируемый трейт. Это позволяет проверить поведение трейта изолированно, не привязываясь к конкретной доменной модели.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PERF — N+1
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-perf-nplusone" class="section">
  <div class="section-title">N+1 проблема</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">N+1 &mdash; антипаттерн обращения к данным, при котором для получения списка записей и связанных с ними сущностей выполняется один запрос «список» плюс по одному запросу на каждую запись для подгрузки связи. Название отражает суть: один запрос-«родитель» (N=1) плюс N запросов-«детей», итого N+1.</p>
    <p class="text">В Eloquent это легко возникает из-за ленивой загрузки связей: обращение к relation на модели автоматически выполняет отдельный запрос. Внутри цикла это превращается в десятки или сотни запросов на одну страницу &mdash; результат корректен, но производительность катастрофическая. На локальной разработке с малыми объёмами данных проблема не заметна; в продакшене проявляется как медленные страницы, рост нагрузки на БД и таймауты под нагрузкой.</p>
    <p class="text">Решение известно и стандартно: eager loading через <code>with()</code>, <code>load()</code> или агрегатные методы <code>withCount</code>/<code>withSum</code> (подробно разобраны в подразделе «Eager loading»). Главная задача &mdash; не допустить попадания N+1 в продакшен, для чего применяются инструменты автоматического обнаружения и защита через <code>preventLazyLoading()</code>.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень механизмов</div>

    <div class="card">
      <h3>Демонстрация проблемы</h3>
      <p class="text">Контраст между ленивой загрузкой и eager loading на примере страницы со списком постов и их авторами:</p>
      <div class="bad-good">
        <div class="bad">
          <h4>Антипаттерн N+1</h4>
<pre><code><span class="c-key">foreach</span> (<span class="c-type">Post</span>::<span class="c-fn">all</span>() <span class="c-key">as</span> <span class="c-var">$post</span>) {
    <span class="c-fn">echo</span> <span class="c-var">$post</span>-><span class="c-var">author</span>-><span class="c-var">name</span>;
}

<span class="c-comment">// SQL для коллекции из 100 постов:</span>
<span class="c-comment">// 1: SELECT * FROM posts</span>
<span class="c-comment">// 2: SELECT * FROM users WHERE id = 1</span>
<span class="c-comment">// 3: SELECT * FROM users WHERE id = 2</span>
<span class="c-comment">// 4: SELECT * FROM users WHERE id = 3</span>
<span class="c-comment">// ...</span>
<span class="c-comment">// Итого: 101 запрос.</span></code></pre>
        </div>
        <div class="good">
          <h4>Eager loading через <code>with()</code></h4>
<pre><code><span class="c-key">foreach</span> (<span class="c-type">Post</span>::<span class="c-fn">with</span>(<span class="c-str">'author'</span>)-><span class="c-fn">get</span>() <span class="c-key">as</span> <span class="c-var">$post</span>) {
    <span class="c-fn">echo</span> <span class="c-var">$post</span>-><span class="c-var">author</span>-><span class="c-var">name</span>;
}

<span class="c-comment">// SQL для коллекции из 100 постов:</span>
<span class="c-comment">// 1: SELECT * FROM posts</span>
<span class="c-comment">// 2: SELECT * FROM users WHERE id IN (1, 2, ..., 100)</span>
<span class="c-comment">// Итого: 2 запроса.</span></code></pre>
        </div>
      </div>
      <p class="text">Подробное рассмотрение всех вариантов eager loading (<code>with</code>, <code>load</code>, <code>loadMissing</code>, <code>withCount</code>, <code>withSum</code>, constrained eager loading) вынесено в подраздел «Eager loading».</p>
    </div>

    <div class="card">
      <h3>Защита: <code>Model::preventLazyLoading()</code></h3>
      <p class="text">Метод запрещает ленивую загрузку связей: попытка обратиться к relation, не загруженной заранее, бросает исключение <code>LazyLoadingViolationException</code>. Применяется в окружении разработки для немедленного обнаружения N+1: вместо тихой деградации производительности падает явная ошибка с указанием места.</p>
<pre><code><span class="c-comment">// app/Providers/AppServiceProvider.php</span>
<span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Model</span>;

<span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
{
    <span class="c-comment">// Запретить lazy loading во всех окружениях, кроме production.</span>
    <span class="c-type">Model</span>::<span class="c-fn">preventLazyLoading</span>(! <span class="c-fn">app</span>()-><span class="c-fn">isProduction</span>());
}
</code></pre>
      <p class="text">Параметр <code>true</code> включает запрет, <code>false</code> снимает. В production включать опасно: любое незамеченное место с lazy loading приведёт к падению пользовательских запросов. В разработке и CI &mdash; обязательная мера, обнаруживающая N+1 на этапе тестирования.</p>
      <p class="text">Связанные методы того же семейства:</p>
<pre><code><span class="c-comment">// Запрет на silent property assignment (опечатки в именах атрибутов).</span>
<span class="c-type">Model</span>::<span class="c-fn">preventSilentlyDiscardingAttributes</span>(! <span class="c-fn">app</span>()-><span class="c-fn">isProduction</span>());

<span class="c-comment">// Запрет на доступ к атрибутам, не загруженным выборкой.</span>
<span class="c-type">Model</span>::<span class="c-fn">preventAccessingMissingAttributes</span>(! <span class="c-fn">app</span>()-><span class="c-fn">isProduction</span>());

<span class="c-comment">// Все защитные настройки сразу.</span>
<span class="c-type">Model</span>::<span class="c-fn">shouldBeStrict</span>(! <span class="c-fn">app</span>()-><span class="c-fn">isProduction</span>());
</code></pre>
    </div>

    <div class="card">
      <h3>Инструменты обнаружения и профилирования</h3>
      <table class="data-table">
        <tr><th>Инструмент</th><th>Применение</th></tr>
        <tr><td><strong>Laravel Telescope</strong></td><td>Встроенная панель разработки. Отображает все SQL-запросы каждого HTTP-запроса с группировкой по дубликатам &mdash; повторяющиеся запросы с одинаковым шаблоном явно подсвечены.</td></tr>
        <tr><td><strong>Laravel Pulse</strong></td><td>Официальный мониторинг для production. Регистрирует медленные запросы, агрегирует частые шаблоны, показывает корреляцию с конкретными маршрутами.</td></tr>
        <tr><td><strong>barryvdh/laravel-debugbar</strong></td><td>Панель внизу страницы с количеством запросов, временем выполнения и stack trace каждого. Полезна для интерактивной отладки.</td></tr>
        <tr><td><strong>Clockwork</strong></td><td>Браузерное расширение, отображающее запросы и таймлайны через DevTools браузера.</td></tr>
        <tr><td><strong><code>DB::enableQueryLog</code></strong></td><td>Минимальный встроенный механизм: захват списка выполненных запросов программно для логирования или тестов.</td></tr>
        <tr><td><strong>tighten/jigsaw-toolbox или beyondcode/laravel-query-detector</strong></td><td>Специализированные пакеты с автоматическим обнаружением N+1 во время разработки и логированием в файл.</td></tr>
      </table>
    </div>

    <div class="card">
      <h3>Использование <code>DB::listen</code> для логирования</h3>
      <p class="text">Когда нужно отловить N+1 в специфической точке (фоновая задача, тест, специальный сценарий), можно зарегистрировать обработчик каждого выполняемого запроса и проанализировать журнал.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Database\Events\QueryExecuted</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\DB</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Log</span>;

<span class="c-comment">// Например, в middleware или начале команды.</span>
<span class="c-type">DB</span>::<span class="c-fn">listen</span>(<span class="c-key">function</span> (<span class="c-type">QueryExecuted</span> <span class="c-var">$query</span>) {
    <span class="c-type">Log</span>::<span class="c-fn">debug</span>(<span class="c-str">'SQL'</span>, [
        <span class="c-str">'sql'</span>      =&gt; <span class="c-var">$query</span>-><span class="c-var">sql</span>,
        <span class="c-str">'bindings'</span> =&gt; <span class="c-var">$query</span>-><span class="c-var">bindings</span>,
        <span class="c-str">'time_ms'</span>  =&gt; <span class="c-var">$query</span>-><span class="c-var">time</span>,
    ]);
});
</code></pre>
    </div>

    <div class="card">
      <h3>Артизан-команды диагностики</h3>
<pre><code><span class="c-comment"># Отобразить статистику использования соединений и активные транзакции.</span>
php artisan db:monitor

<span class="c-comment"># Просмотреть схему таблицы (часто полезно для проверки индексов).</span>
php artisan db:show --counts
php artisan db:table users

<span class="c-comment"># Анализ структуры запросов через явное логирование в development.</span>
php artisan db:show --views --types
</code></pre>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: тестирование на отсутствие N+1</div>

    <p class="text">Лучшая защита от N+1 в продакшене &mdash; покрытие критичных эндпоинтов автоматическими тестами, проверяющими количество выполненных SQL-запросов. Ниже &mdash; реализация helper и тест для страницы списка постов.</p>

<pre><code><span class="c-comment">// tests/Concerns/AssertsQueryCount.php — общий helper для тестов.</span>
<span class="c-key">namespace</span> <span class="c-type">Tests\Concerns</span>;

<span class="c-key">use</span> <span class="c-type">Illuminate\Database\Events\QueryExecuted</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\DB</span>;

<span class="c-key">trait</span> <span class="c-type">AssertsQueryCount</span>
{
    <span class="c-key">protected function</span> <span class="c-fn">assertQueryCount</span>(<span class="c-key">int</span> <span class="c-var">$expected</span>, <span class="c-type">\Closure</span> <span class="c-var">$callback</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$queries</span> = [];
        <span class="c-type">DB</span>::<span class="c-fn">listen</span>(<span class="c-key">function</span> (<span class="c-type">QueryExecuted</span> <span class="c-var">$q</span>) <span class="c-key">use</span> (&amp;<span class="c-var">$queries</span>) {
            <span class="c-var">$queries</span>[] = <span class="c-var">$q</span>-><span class="c-var">sql</span>;
        });

        <span class="c-var">$callback</span>();

        <span class="c-var">$this</span>-><span class="c-fn">assertCount</span>(
            <span class="c-var">$expected</span>,
            <span class="c-var">$queries</span>,
            <span class="c-fn">sprintf</span>(<span class="c-str">"Expected %d queries, got %d:\n%s"</span>,
                <span class="c-var">$expected</span>,
                <span class="c-fn">count</span>(<span class="c-var">$queries</span>),
                <span class="c-fn">implode</span>(<span class="c-str">"\n"</span>, <span class="c-var">$queries</span>)
            )
        );
    }
}
</code></pre>

<pre><code><span class="c-comment">// tests/Feature/PostsIndexTest.php — тест на количество SQL-запросов.</span>
<span class="c-key">use</span> <span class="c-type">App\Models\Post</span>;
<span class="c-key">use</span> <span class="c-type">App\Models\User</span>;
<span class="c-key">use</span> <span class="c-type">Tests\Concerns\AssertsQueryCount</span>;
<span class="c-key">use</span> <span class="c-type">Tests\TestCase</span>;

<span class="c-key">class</span> <span class="c-type">PostsIndexTest</span> <span class="c-key">extends</span> <span class="c-type">TestCase</span>
{
    <span class="c-key">use</span> <span class="c-type">RefreshDatabase</span>, <span class="c-type">AssertsQueryCount</span>;

    <span class="c-key">public function</span> <span class="c-fn">test_posts_index_does_not_have_n_plus_one</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// Подготовка: 25 постов, у каждого свой автор и 5 тегов.</span>
        <span class="c-type">Post</span>::<span class="c-fn">factory</span>()-><span class="c-fn">count</span>(<span class="c-num">25</span>)
            -><span class="c-fn">for</span>(<span class="c-type">User</span>::<span class="c-fn">factory</span>(), <span class="c-str">'author'</span>)
            -><span class="c-fn">hasAttached</span>(<span class="c-type">Tag</span>::<span class="c-fn">factory</span>()-><span class="c-fn">count</span>(<span class="c-num">5</span>))
            -><span class="c-fn">create</span>();

        <span class="c-comment">// Ожидаем не более 4 запросов на страницу:</span>
        <span class="c-comment">// 1: COUNT для пагинатора;</span>
        <span class="c-comment">// 2: SELECT posts;</span>
        <span class="c-comment">// 3: SELECT users (авторы);</span>
        <span class="c-comment">// 4: SELECT tags через polymorphic pivot.</span>
        <span class="c-var">$this</span>-><span class="c-fn">assertQueryCount</span>(<span class="c-num">4</span>, <span class="c-key">function</span> () {
            <span class="c-var">$this</span>-><span class="c-fn">get</span>(<span class="c-str">'/posts'</span>)-><span class="c-fn">assertOk</span>();
        });
    }
}
</code></pre>

    <p class="text">Альтернативный подход &mdash; явное использование <code>preventLazyLoading</code> в тестовой конфигурации, которое автоматически провалит тест при любом N+1:</p>
<pre><code><span class="c-comment">// tests/TestCase.php или базовый setUp</span>
<span class="c-key">protected function</span> <span class="c-fn">setUp</span>(): <span class="c-key">void</span>
{
    <span class="c-fn">parent</span>::<span class="c-fn">setUp</span>();
    <span class="c-type">Model</span>::<span class="c-fn">preventLazyLoading</span>();
}

<span class="c-comment">// Теперь любой N+1 в коде упадёт с понятной ошибкой:</span>
<span class="c-comment">// Illuminate\Database\LazyLoadingViolationException:</span>
<span class="c-comment">//   Attempted to lazy load [author] on model [App\Models\Post] but lazy loading is disabled.</span>
</code></pre>

    <p class="text">Дополнительно &mdash; обработчик нарушения, который вместо исключения логирует факт N+1, чтобы не ломать UX в staging-окружениях:</p>
<pre><code><span class="c-type">Model</span>::<span class="c-fn">preventLazyLoading</span>(! <span class="c-fn">app</span>()-><span class="c-fn">isProduction</span>());

<span class="c-type">Model</span>::<span class="c-fn">handleLazyLoadingViolationUsing</span>(<span class="c-key">function</span> (<span class="c-type">Model</span> <span class="c-var">$model</span>, <span class="c-key">string</span> <span class="c-var">$relation</span>): <span class="c-key">void</span> {
    <span class="c-type">Log</span>::<span class="c-fn">warning</span>(<span class="c-str">"N+1 lazy load: "</span> . <span class="c-var">$model</span>::<span class="c-key">class</span> . <span class="c-str">".{$relation}"</span>);
    <span class="c-comment">// В staging — логируем, но не падаем.</span>
});
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. <code>preventLazyLoading</code> в production.</strong> Включение защиты в production-окружении опасно: любой необработанный случай N+1 приведёт к падению пользовательских запросов с 500-й ошибкой. Включается только в development и testing, либо с обработчиком, превращающим нарушение в предупреждение в логе.
    </div>

    <div class="pitfall">
      <strong>2. N+1 в шаблонах через accessor.</strong> Если accessor модели обращается к relation (<code>$user-&gt;total_orders</code> внутри возвращает <code>$this-&gt;orders-&gt;count()</code>), то eager loading самой модели не помогает: каждый accessor дёргает свой запрос. Решение &mdash; использовать <code>withCount</code> для подсчётов, либо передавать предварительно вычисленное значение через DTO.
    </div>

    <div class="pitfall">
      <strong>3. Скрытый N+1 в API Resources.</strong> Класс <code>Resource</code> часто содержит обращения к relations при формировании ответа. Если контроллер вернул коллекцию через <code>UserResource::collection($users)</code>, а в Resource есть <code>$this-&gt;posts</code>, без eager loading возникнет N+1. Тестирование с подсчётом запросов выявляет такие случаи.
    </div>

    <div class="pitfall">
      <strong>4. N+1 с условиями (<code>whereHas</code> + lazy doc).</strong> Конструкция <code>User::whereHas('posts', ...)-&gt;get()</code> не загружает посты &mdash; она только фильтрует юзеров. Если затем требуется получить отфильтрованные посты, нужен либо <code>with('posts', ...)</code>, либо отдельный запрос.
    </div>

    <div class="pitfall">
      <strong>5. Eager loading не помогает при ленивых полиморфных relations.</strong> Метод <code>with('commentable')</code> на коллекции комментариев порождает один SELECT на каждый тип родителя (Post, Photo, Video). Это естественно для polymorphic, но иногда воспринимается как N+1. Альтернативой служит <code>morphWith</code> с предварительной разбивкой по типам.
    </div>

    <div class="pitfall">
      <strong>6. <code>find()</code> в цикле.</strong> Конструкция <code>foreach ($ids as $id) { $user = User::find($id); ... }</code> &mdash; форма N+1, где «1» отсутствует, а N запросов выполняются по идентификаторам. Решение &mdash; <code>User::whereIn('id', $ids)-&gt;get()-&gt;keyBy('id')</code>, после чего обращение по идентификатору идёт к коллекции в памяти.
    </div>

    <div class="pitfall">
      <strong>7. Пагинация и N+1.</strong> N+1 на пагинированных страницах обычно не виден в логах одного запроса (нагрузка распределена по страницам), но проявляется как линейный рост числа запросов в логах БД. При наличии <code>withCount</code> по нескольким relations плюс N+1 на основной выборке pulse-метрики покажут неожиданно высокую нагрузку.
    </div>

    <div class="pitfall">
      <strong>8. N+1 в queue workers.</strong> Логика, написанная для веб-запроса, может срабатывать и в очередях (через события моделей). Если в обработчике события есть N+1, очередь будет медленно «жевать» job-ы, забирая ресурсы БД. Тесты для job'ов должны включать проверку количества запросов так же, как и тесты контроллеров.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PERF — TRANSACTIONS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-perf-tx" class="section">
  <div class="section-title">Транзакции</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Транзакция &mdash; группа SQL-запросов, выполняемая как атомарная единица. Все запросы группы либо завершаются успешно (commit), либо откатываются целиком (rollback) при возникновении ошибки. Транзакции обеспечивают целостность данных в сценариях, где несколько изменений должны быть согласованы между собой.</p>
    <p class="text">Типичные применения: создание сущности и зависимых записей (User + Profile + ApiToken), перевод средств между счетами, оформление заказа с резервированием товара на складе, обновление денормализованных счётчиков параллельно с основной записью. В каждом случае частичное выполнение операции оставит систему в неконсистентном состоянии.</p>
    <p class="text">Laravel предоставляет два уровня API для транзакций: высокоуровневый через <code>DB::transaction($closure)</code> с автоматическим откатом при исключении и встроенной поддержкой повторов при deadlock, и низкоуровневый через <code>beginTransaction</code>/<code>commit</code>/<code>rollBack</code> для случаев, когда требуется тонкий контроль над границами транзакции.</p>
    <p class="text">Принципиально важный аспект &mdash; взаимодействие транзакций с побочными эффектами (отправка email, диспетчер job в очередь, вызов внешнего API). Без специальных мер побочный эффект сработает до commit транзакции, и при rollback в БД ничего не сохранится, но почта уже отправлена. Для разрешения этой коллизии существует механизм <code>DB::afterCommit</code> и свойство <code>$afterCommit</code> на job-классах.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень механизмов</div>

    <div class="card">
      <h3><code>DB::transaction($closure, $attempts = 1)</code> &mdash; основной способ</h3>
      <p class="text">Принимает замыкание, в котором выполняются операции. При успешном завершении замыкания транзакция фиксируется автоматически. Если из замыкания вылетит исключение, транзакция откатывается, и исключение пробрасывается дальше. Второй аргумент задаёт количество повторов при обнаружении deadlock.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\DB</span>;

<span class="c-comment">// Базовый случай: создание пользователя и зависимых сущностей.</span>
<span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$data</span>) {
    <span class="c-var">$user</span>    = <span class="c-type">User</span>::<span class="c-fn">create</span>(<span class="c-var">$data</span>);
    <span class="c-var">$user</span>-><span class="c-fn">profile</span>()-><span class="c-fn">create</span>([<span class="c-str">'bio'</span> =&gt; <span class="c-str">''</span>]);
    <span class="c-var">$user</span>-><span class="c-fn">tokens</span>()-><span class="c-fn">create</span>([<span class="c-str">'name'</span> =&gt; <span class="c-str">'default'</span>]);
    <span class="c-comment">// При исключении из любой из строк выше — все три операции откатываются.</span>
});
</code></pre>
      <p class="text">Возвращаемое значение замыкания становится возвращаемым значением <code>DB::transaction()</code>, что удобно для типизации:</p>
<pre><code><span class="c-var">$order</span> = <span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$items</span>): <span class="c-type">Order</span> {
    <span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">create</span>([...]);
    <span class="c-var">$order</span>-><span class="c-fn">items</span>()-><span class="c-fn">createMany</span>(<span class="c-var">$items</span>);
    <span class="c-key">return</span> <span class="c-var">$order</span>;
});
</code></pre>
    </div>

    <div class="card">
      <h3>Ручной контроль: <code>beginTransaction</code>, <code>commit</code>, <code>rollBack</code></h3>
      <p class="text">Когда границы транзакции не совпадают с границами одной функции (например, открывается в начале обработчика и закрывается после многих условных операций), используется ручной API. Требует обязательной обработки исключений, чтобы не оставлять транзакцию открытой.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\DB</span>;

<span class="c-type">DB</span>::<span class="c-fn">beginTransaction</span>();

<span class="c-key">try</span> {
    <span class="c-var">$user</span>    = <span class="c-type">User</span>::<span class="c-fn">create</span>(<span class="c-var">$data</span>);
    <span class="c-var">$profile</span> = <span class="c-type">Profile</span>::<span class="c-fn">create</span>([<span class="c-str">'user_id'</span> =&gt; <span class="c-var">$user</span>-><span class="c-var">id</span>]);

    <span class="c-key">if</span> (<span class="c-var">$additionalConditionFails</span>) {
        <span class="c-key">throw new</span> <span class="c-type">DomainException</span>(<span class="c-str">'...'</span>);
    }

    <span class="c-type">DB</span>::<span class="c-fn">commit</span>();
} <span class="c-key">catch</span> (<span class="c-type">\Throwable</span> <span class="c-var">$e</span>) {
    <span class="c-type">DB</span>::<span class="c-fn">rollBack</span>();
    <span class="c-key">throw</span> <span class="c-var">$e</span>;
}
</code></pre>
    </div>

    <div class="card">
      <h3>Вложенные транзакции и savepoints</h3>
      <p class="text">Laravel поддерживает вложенные вызовы <code>DB::transaction()</code>. На уровне БД это реализуется через <code>SAVEPOINT</code>: внешняя транзакция остаётся одной, внутренние создают точки отката. Если внутренняя «откатывается», откат происходит только до её savepoint, а внешняя продолжается.</p>
<pre><code><span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () {
    <span class="c-type">User</span>::<span class="c-fn">create</span>([<span class="c-str">'email'</span> =&gt; <span class="c-str">'a@x.com'</span>]);

    <span class="c-key">try</span> {
        <span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () {
            <span class="c-type">User</span>::<span class="c-fn">create</span>([<span class="c-str">'email'</span> =&gt; <span class="c-str">'b@x.com'</span>]);
            <span class="c-key">throw new</span> <span class="c-type">RuntimeException</span>(<span class="c-str">'Inner failure'</span>);
        });
    } <span class="c-key">catch</span> (<span class="c-type">RuntimeException</span> <span class="c-var">$e</span>) {
        <span class="c-comment">// Откат только внутренней транзакции: пользователь 'a@x.com' остаётся.</span>
    }
});
</code></pre>
      <p class="text">Метод <code>DB::transactionLevel()</code> возвращает текущий уровень вложенности и удобен для отладки. Метод <code>DB::pretend()</code> &mdash; для запуска кода без фактического применения изменений в БД (получает SQL без выполнения).</p>
    </div>

    <div class="card">
      <h3>Повторы при deadlock</h3>
      <p class="text">Deadlock &mdash; ситуация, когда две транзакции взаимно блокируют ресурсы друг друга. СУБД разрешает её, откатив одну из транзакций с ошибкой. Это нормальное явление при конкурентном доступе; правильная реакция &mdash; повторить операцию. Второй аргумент <code>DB::transaction</code> задаёт количество автоматических повторов.</p>
<pre><code><span class="c-comment">// Перевод средств между счетами с автоматическими повторами при deadlock.</span>
<span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$from</span>, <span class="c-var">$to</span>, <span class="c-var">$amount</span>) {
    <span class="c-var">$from</span>-><span class="c-fn">decrement</span>(<span class="c-str">'balance'</span>, <span class="c-var">$amount</span>);
    <span class="c-var">$to</span>-><span class="c-fn">increment</span>(<span class="c-str">'balance'</span>, <span class="c-var">$amount</span>);
}, attempts: <span class="c-num">5</span>);
</code></pre>
      <p class="text">Laravel ловит исключения, соответствующие deadlock-кодам различных СУБД (MySQL 1213, PostgreSQL 40P01), и повторяет замыкание целиком. Важно понимать: побочные эффекты внутри замыкания будут выполнены повторно при каждом retry. Чистая логика модификации БД безопасна; вызовы внешних API, отправка писем должны быть вынесены за пределы транзакции (через <code>DB::afterCommit</code>).</p>
    </div>

    <div class="card">
      <h3>Блокировки строк: <code>lockForUpdate</code> и <code>sharedLock</code></h3>
      <p class="text">Внутри транзакции иногда требуется явная блокировка читаемых строк, чтобы предотвратить их изменение другими транзакциями до окончания текущей. Это решает классическую проблему «прочитать-проверить-изменить» в конкурентной среде.</p>
<pre><code><span class="c-comment">// Безопасное списание средств: блокируем строку пользователя на чтение,</span>
<span class="c-comment">// чтобы параллельная транзакция не успела одновременно списать те же средства.</span>
<span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$userId</span>, <span class="c-var">$amount</span>) {
    <span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">whereKey</span>(<span class="c-var">$userId</span>)-><span class="c-fn">lockForUpdate</span>()-><span class="c-fn">firstOrFail</span>();

    <span class="c-key">if</span> (<span class="c-var">$user</span>-><span class="c-var">balance</span> &lt; <span class="c-var">$amount</span>) {
        <span class="c-key">throw new</span> <span class="c-type">InsufficientFundsException</span>();
    }

    <span class="c-var">$user</span>-><span class="c-fn">decrement</span>(<span class="c-str">'balance'</span>, <span class="c-var">$amount</span>);
});

<span class="c-comment">// Альтернатива: SELECT ... LOCK IN SHARE MODE — другие транзакции могут читать,</span>
<span class="c-comment">// но не могут изменять выбранные строки.</span>
<span class="c-type">User</span>::<span class="c-fn">whereKey</span>(<span class="c-var">$userId</span>)-><span class="c-fn">sharedLock</span>()-><span class="c-fn">firstOrFail</span>();
</code></pre>
    </div>

    <div class="card">
      <h3>Побочные эффекты и <code>afterCommit</code></h3>
      <p class="text">Распространённый источник тонких багов: побочный эффект (отправка email, диспетчер job в очередь, обращение к внешнему API), выполненный внутри транзакции до её commit. Если транзакция откатывается, побочный эффект уже произошёл, и система оказывается в несогласованном состоянии (письмо отправлено о действии, которого не было).</p>
<pre><code><span class="c-comment">// АНТИПАТТЕРН: письмо может уйти при rollback транзакции.</span>
<span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$user</span>) {
    <span class="c-var">$user</span>-><span class="c-fn">save</span>();
    <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$user</span>)-><span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">WelcomeMail</span>());  <span class="c-comment">// выполнится сразу!</span>
    <span class="c-comment">// Если ниже произойдёт исключение, save() откатится, но письмо уже отправлено.</span>
});
</code></pre>
      <p class="text">Решения:</p>
<pre><code><span class="c-comment">// Способ 1: явная регистрация колбэка через DB::afterCommit.</span>
<span class="c-comment">// Выполняется после успешного commit; при rollback не вызывается.</span>
<span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$user</span>) {
    <span class="c-var">$user</span>-><span class="c-fn">save</span>();

    <span class="c-type">DB</span>::<span class="c-fn">afterCommit</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$user</span>) {
        <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$user</span>)-><span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">WelcomeMail</span>());
    });
});

<span class="c-comment">// Способ 2: свойство $afterCommit на job-классе.</span>
<span class="c-key">class</span> <span class="c-type">SendWelcomeEmail</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">public bool</span> <span class="c-var">$afterCommit</span> = <span class="c-key">true</span>;

    <span class="c-key">public function</span> <span class="c-fn">handle</span>(): <span class="c-key">void</span> { <span class="c-comment">/* ... */</span> }
}

<span class="c-comment">// Способ 3: глобальная настройка для всех job и notifications.</span>
<span class="c-comment">// config/queue.php:</span>
<span class="c-comment">// 'connections' => ['redis' => [...], 'after_commit' => true]</span>
</code></pre>
    </div>

    <div class="card">
      <h3>Сводная таблица методов</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>Назначение</th></tr>
        <tr><td><code>DB::transaction($cb, $attempts)</code></td><td>Атомарная группа операций с авто-rollback и опциональными повторами при deadlock</td></tr>
        <tr><td><code>DB::beginTransaction()</code></td><td>Открытие транзакции в ручном режиме</td></tr>
        <tr><td><code>DB::commit()</code></td><td>Фиксация транзакции</td></tr>
        <tr><td><code>DB::rollBack()</code></td><td>Откат транзакции (всю или до конкретного уровня вложенности)</td></tr>
        <tr><td><code>DB::transactionLevel()</code></td><td>Текущий уровень вложенности (0 = вне транзакции)</td></tr>
        <tr><td><code>DB::afterCommit($cb)</code></td><td>Регистрация колбэка, выполняемого после успешного commit</td></tr>
        <tr><td><code>Model::lockForUpdate()</code></td><td>SELECT с эксклюзивной блокировкой строк (FOR UPDATE)</td></tr>
        <tr><td><code>Model::sharedLock()</code></td><td>SELECT с разделяемой блокировкой (LOCK IN SHARE MODE)</td></tr>
      </table>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: оформление заказа в интернет-магазине</div>

    <p class="text">Рассмотрим типичный сценарий: пользователь оформляет заказ. Необходимо одновременно создать запись заказа, уменьшить остатки товара на складе, зарезервировать сумму со счёта, записать событие в журнал и (после успешного commit) отправить подтверждение по email и поставить в очередь job на формирование документов. Все эти операции должны быть согласованы.</p>

<pre><code><span class="c-key">use</span> <span class="c-type">App\Exceptions\InsufficientStockException</span>;
<span class="c-key">use</span> <span class="c-type">App\Exceptions\InsufficientFundsException</span>;
<span class="c-key">use</span> <span class="c-type">App\Jobs\GenerateInvoice</span>;
<span class="c-key">use</span> <span class="c-type">App\Notifications\OrderConfirmation</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\DB</span>;

<span class="c-key">class</span> <span class="c-type">PlaceOrderService</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-key">array</span> <span class="c-var">$items</span>): <span class="c-type">Order</span>
    {
        <span class="c-key">return</span> <span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$user</span>, <span class="c-var">$items</span>): <span class="c-type">Order</span> {
            <span class="c-comment">// 1. Блокируем пользователя для безопасного списания средств.</span>
            <span class="c-var">$lockedUser</span> = <span class="c-type">User</span>::<span class="c-fn">whereKey</span>(<span class="c-var">$user</span>-><span class="c-var">id</span>)-><span class="c-fn">lockForUpdate</span>()-><span class="c-fn">firstOrFail</span>();

            <span class="c-comment">// 2. Подсчёт итоговой суммы и проверка достаточности средств.</span>
            <span class="c-var">$total</span> = <span class="c-fn">collect</span>(<span class="c-var">$items</span>)-><span class="c-fn">sum</span>(<span class="c-key">fn</span> (<span class="c-key">array</span> <span class="c-var">$i</span>) =&gt; <span class="c-var">$i</span>[<span class="c-str">'qty'</span>] * <span class="c-var">$i</span>[<span class="c-str">'price'</span>]);

            <span class="c-key">if</span> (<span class="c-var">$lockedUser</span>-><span class="c-var">balance</span> &lt; <span class="c-var">$total</span>) {
                <span class="c-key">throw new</span> <span class="c-type">InsufficientFundsException</span>();
            }

            <span class="c-comment">// 3. Создание заказа.</span>
            <span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">create</span>([
                <span class="c-str">'user_id'</span>  =&gt; <span class="c-var">$lockedUser</span>-><span class="c-var">id</span>,
                <span class="c-str">'total'</span>    =&gt; <span class="c-var">$total</span>,
                <span class="c-str">'status'</span>   =&gt; <span class="c-str">'placed'</span>,
                <span class="c-str">'placed_at'</span> =&gt; <span class="c-fn">now</span>(),
            ]);

            <span class="c-comment">// 4. Резервирование остатков для каждой позиции, с блокировкой строки товара.</span>
            <span class="c-key">foreach</span> (<span class="c-var">$items</span> <span class="c-key">as</span> <span class="c-var">$item</span>) {
                <span class="c-var">$product</span> = <span class="c-type">Product</span>::<span class="c-fn">whereKey</span>(<span class="c-var">$item</span>[<span class="c-str">'product_id'</span>])
                    -><span class="c-fn">lockForUpdate</span>()
                    -><span class="c-fn">firstOrFail</span>();

                <span class="c-key">if</span> (<span class="c-var">$product</span>-><span class="c-var">stock</span> &lt; <span class="c-var">$item</span>[<span class="c-str">'qty'</span>]) {
                    <span class="c-key">throw new</span> <span class="c-type">InsufficientStockException</span>(<span class="c-var">$product</span>-><span class="c-var">sku</span>);
                }

                <span class="c-var">$product</span>-><span class="c-fn">decrement</span>(<span class="c-str">'stock'</span>, <span class="c-var">$item</span>[<span class="c-str">'qty'</span>]);

                <span class="c-var">$order</span>-><span class="c-fn">items</span>()-><span class="c-fn">create</span>([
                    <span class="c-str">'product_id'</span> =&gt; <span class="c-var">$product</span>-><span class="c-var">id</span>,
                    <span class="c-str">'qty'</span>        =&gt; <span class="c-var">$item</span>[<span class="c-str">'qty'</span>],
                    <span class="c-str">'price'</span>      =&gt; <span class="c-var">$item</span>[<span class="c-str">'price'</span>],
                ]);
            }

            <span class="c-comment">// 5. Списание средств со счёта.</span>
            <span class="c-var">$lockedUser</span>-><span class="c-fn">decrement</span>(<span class="c-str">'balance'</span>, <span class="c-var">$total</span>);

            <span class="c-comment">// 6. Запись в журнал.</span>
            <span class="c-type">AuditLog</span>::<span class="c-fn">record</span>(<span class="c-str">'order.placed'</span>, <span class="c-var">$order</span>);

            <span class="c-comment">// 7. Побочные эффекты — только ПОСЛЕ commit транзакции.</span>
            <span class="c-comment">// При rollback эти действия не сработают.</span>
            <span class="c-type">DB</span>::<span class="c-fn">afterCommit</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$order</span>, <span class="c-var">$lockedUser</span>) {
                <span class="c-var">$lockedUser</span>-><span class="c-fn">notify</span>(<span class="c-key">new</span> <span class="c-type">OrderConfirmation</span>(<span class="c-var">$order</span>));
                <span class="c-type">GenerateInvoice</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);
            });

            <span class="c-key">return</span> <span class="c-var">$order</span>;
        }, attempts: <span class="c-num">3</span>);
    }
}
</code></pre>

    <p class="text">Что обеспечивает эта структура:</p>
    <ul class="bullets">
      <li><strong>Атомарность:</strong> создание заказа, изменение остатков и списание средств происходят как единое целое. Если что-либо упадёт &mdash; всё откатывается, БД остаётся в исходном состоянии.</li>
      <li><strong>Защита от гонок:</strong> <code>lockForUpdate</code> на пользователе и товаре блокирует параллельные транзакции до завершения текущей. Это предотвращает «двойное списание» средств и продажу одного товара двум покупателям одновременно.</li>
      <li><strong>Безопасность побочных эффектов:</strong> уведомление и генерация документа произойдут только после успешного коммита. Если транзакция упадёт &mdash; пользователь не получит ошибочного письма о заказе.</li>
      <li><strong>Устойчивость к deadlock:</strong> <code>attempts: 3</code> автоматически повторит транзакцию при коллизии блокировок, не показывая пользователю ошибку.</li>
    </ul>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. Side effects внутри транзакции до commit.</strong> Самая частая и наиболее опасная ошибка. Отправка email, диспетчер job, обращение к внешнему API, выполненные внутри замыкания, сработают <strong>до</strong> commit. При rollback побочный эффект уже произошёл. Решение &mdash; <code>DB::afterCommit()</code> или свойство <code>$afterCommit = true</code> на job-классе.
    </div>

    <div class="pitfall">
      <strong>2. Повторное выполнение замыкания при deadlock-retry.</strong> Аргумент <code>attempts</code> заставляет Laravel повторить замыкание целиком при deadlock. Все операции, не идемпотентные относительно повторного выполнения (отправка email через <code>Mail::raw</code>, синхронные HTTP-запросы), могут выполниться многократно. Чистые SQL-операции на этом не страдают.
    </div>

    <div class="pitfall">
      <strong>3. <code>lockForUpdate</code> без транзакции.</strong> Блокировки строк имеют смысл только внутри транзакции, поскольку освобождаются при её commit/rollback. <code>User::find($id)-&gt;lockForUpdate()</code> вне транзакции не даст ожидаемого эффекта &mdash; блокировка освободится сразу после возврата запроса.
    </div>

    <div class="pitfall">
      <strong>4. Длительные транзакции и блокировки.</strong> Транзакция, содержащая операции с большим количеством записей или длительные вычисления, удерживает блокировки на всё время своего выполнения. Под конкурентной нагрузкой это вызывает лавинообразное замедление: другие транзакции ждут освобождения. Решение &mdash; партиционировать bulk-операции на меньшие порции с отдельными транзакциями.
    </div>

    <div class="pitfall">
      <strong>5. Вложенные транзакции и savepoints.</strong> Laravel поддерживает вложенные <code>DB::transaction</code>, но фактически использует SAVEPOINT, а не настоящие вложенные транзакции (которых нет в SQL-стандарте). Откат внешней транзакции откатит и внутреннюю savepoint, даже если она была «закоммичена». Это особенность, которая может сбить с толку начинающих.
    </div>

    <div class="pitfall">
      <strong>6. <code>RefreshDatabase</code> в тестах и транзакции.</strong> Trait <code>RefreshDatabase</code> в тестах оборачивает каждый тест в транзакцию, чтобы откатить состояние БД. Это работает корректно, но создаёт неявную «внешнюю» транзакцию. Все колбэки <code>afterCommit</code> внутри тестируемого кода <strong>не сработают</strong>, потому что внешняя транзакция никогда не коммитится. Это намеренное поведение, но требует учёта при тестировании логики, зависящей от afterCommit.
    </div>

    <div class="pitfall">
      <strong>7. Несколько соединений с БД.</strong> <code>DB::transaction</code> по умолчанию работает с дефолтным соединением. Если в одной операции изменяются записи в разных БД (например, основная и журнал в отдельной БД), стандартная транзакция не охватит обе. Для распределённых сценариев применяются двухфазные коммиты или event-sourcing с компенсирующими действиями.
    </div>

    <div class="pitfall">
      <strong>8. <code>rollBack()</code> и счётчик уровня.</strong> При вызове <code>DB::rollBack()</code> внутри ручной транзакции откатывается только текущий уровень вложенности. Если транзакция была вложенной, внешняя продолжает выполняться. Для полного отката используется <code>DB::rollBack(0)</code> с указанием уровня 0.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PERF — RELATIONS VS JOINS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-perf-joins" class="section">
  <div class="section-title">Relations vs JOIN</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Eloquent предоставляет два подхода к получению связанных данных: декларативные relations с eager loading (<code>with()</code>, <code>load()</code>) и явные JOIN-запросы через Query Builder (<code>join()</code>, <code>leftJoin()</code>). Подходы решают одну задачу, но имеют разные характеристики по числу SQL-запросов, расходу памяти, читаемости кода и поддерживаемой сложности.</p>
    <p class="text">Relations &mdash; естественный путь для большинства типовых задач: получить пользователя с его профилем, статью с автором и тегами, заказ с позициями. Каждая выбранная сущность представлена как полноценная модель с relations, accessors, casts. Eager loading устраняет N+1, выполняя по одному дополнительному SELECT на каждую загружаемую relation.</p>
    <p class="text">JOIN-запросы становятся предпочтительнее в задачах, требующих фильтрации, сортировки или агрегации по полям связанной таблицы в одном SQL-запросе. Они эффективнее по числу round-trip к БД (один запрос вместо нескольких) и потребляют меньше памяти, но возвращают «плоские» строки без объектной структуры relations. Для read-only выборок с агрегатами и сложными условиями это часто оптимальный выбор.</p>
    <p class="text">На практике эти подходы дополняют друг друга: Eloquent с relations покрывает 80% повседневных задач; JOIN применяется на горячих read-only эндпоинтах, отчётах и тяжёлых выборках, где разница в производительности оправдывает потерю удобства.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень характеристик</div>

    <div class="card">
      <h3>Сравнительная таблица</h3>
      <table class="data-table">
        <tr><th>Критерий</th><th>Relations + <code>with()</code></th><th>JOIN</th></tr>
        <tr><td>Число SQL-запросов</td><td>2 и более (основной + по одному на каждую relation)</td><td>1 (все таблицы в одном запросе)</td></tr>
        <tr><td>Расход памяти PHP</td><td>Выше: для каждой связи гидрируются отдельные модели</td><td>Ниже: одна плоская строка на запись</td></tr>
        <tr><td>Возвращаемая структура</td><td>Eloquent-модели с relations, casts, accessors</td><td>Объекты <code>stdClass</code> или массивы со всеми полями в одной строке</td></tr>
        <tr><td>Дублирование данных</td><td>Нет: каждая запись родителя &mdash; одна модель</td><td>Есть: при один-ко-многим родительские поля дублируются в каждой строке</td></tr>
        <tr><td>Фильтрация по полям связанной таблицы</td><td>Через <code>whereHas</code> или <code>has</code>, требует подзапросов</td><td>Прямой <code>WHERE</code> в одном запросе</td></tr>
        <tr><td>Агрегаты по связанной таблице</td><td><code>withCount</code>, <code>withSum</code> (отдельные подзапросы)</td><td>Прямой <code>GROUP BY</code> + агрегатные функции</td></tr>
        <tr><td>Соблюдение global scopes связанной модели</td><td>Применяются автоматически</td><td>Не применяются, необходимо добавлять условия вручную</td></tr>
        <tr><td>Soft Deletes на связанной модели</td><td>Учитываются автоматически</td><td>Не учитываются &mdash; нужно явное <code>whereNull(...deleted_at)</code></td></tr>
        <tr><td>Читаемость кода</td><td>$post-&gt;author-&gt;name; $post-&gt;tags</td><td>$row-&gt;author_name; теги через дополнительную обработку</td></tr>
      </table>
    </div>

    <div class="card">
      <h3>Когда выбирать Relations</h3>
      <p class="text">Эталонный сценарий: страница, на которой требуется отобразить родительскую сущность вместе с её связями, без сложной фильтрации или агрегации по этим связям.</p>
<pre><code><span class="c-comment">// Страница поста: автор, теги, комментарии с авторами комментариев.</span>
<span class="c-comment">// Eager loading исчерпывающе решает задачу: 4 SQL вместо ленивого N+1.</span>
<span class="c-var">$post</span> = <span class="c-type">Post</span>::<span class="c-fn">with</span>([<span class="c-str">'author'</span>, <span class="c-str">'tags'</span>, <span class="c-str">'comments.author'</span>])
    -><span class="c-fn">findOrFail</span>(<span class="c-var">$id</span>);

<span class="c-comment">// Используется в шаблонах естественно:</span>
<span class="c-comment">// {{ $post->author->name }}</span>
<span class="c-comment">// @foreach($post->tags as $tag) ... @endforeach</span>
<span class="c-comment">// @foreach($post->comments as $comment) ... @endforeach</span>
</code></pre>
    </div>

    <div class="card">
      <h3>Когда выбирать JOIN</h3>
      <p class="text">Задачи, где требуется фильтрация/сортировка/агрегация по полям связанной таблицы в едином SQL. Особенно при больших объёмах данных, где минимизация числа round-trip к БД критична.</p>
<pre><code><span class="c-comment">// 1. Список постов с числом комментариев, отсортированный по автору и числу комментариев.</span>
<span class="c-var">$report</span> = <span class="c-type">Post</span>::<span class="c-fn">query</span>()
    -><span class="c-fn">join</span>(<span class="c-str">'users'</span>, <span class="c-str">'users.id'</span>, <span class="c-str">'='</span>, <span class="c-str">'posts.user_id'</span>)
    -><span class="c-fn">leftJoin</span>(<span class="c-str">'comments'</span>, <span class="c-str">'comments.post_id'</span>, <span class="c-str">'='</span>, <span class="c-str">'posts.id'</span>)
    -><span class="c-fn">select</span>(
        <span class="c-str">'posts.id'</span>,
        <span class="c-str">'posts.title'</span>,
        <span class="c-str">'users.name as author_name'</span>,
    )
    -><span class="c-fn">selectRaw</span>(<span class="c-str">'COUNT(comments.id) AS comments_count'</span>)
    -><span class="c-fn">groupBy</span>(<span class="c-str">'posts.id'</span>, <span class="c-str">'posts.title'</span>, <span class="c-str">'users.name'</span>)
    -><span class="c-fn">having</span>(<span class="c-str">'comments_count'</span>, <span class="c-str">'&gt;'</span>, <span class="c-num">10</span>)
    -><span class="c-fn">orderByDesc</span>(<span class="c-str">'comments_count'</span>)
    -><span class="c-fn">orderBy</span>(<span class="c-str">'users.name'</span>)
    -><span class="c-fn">get</span>();
</code></pre>
<pre><code><span class="c-comment">// 2. Поиск по полю связанной модели на больших объёмах.</span>
<span class="c-comment">// Альтернатива whereHas, дающая один запрос вместо подзапроса с EXISTS.</span>
<span class="c-var">$transactions</span> = <span class="c-type">Transaction</span>::<span class="c-fn">join</span>(<span class="c-str">'merchants'</span>, <span class="c-str">'merchants.id'</span>, <span class="c-str">'='</span>, <span class="c-str">'transactions.merchant_id'</span>)
    -><span class="c-fn">where</span>(<span class="c-str">'merchants.country_code'</span>, <span class="c-str">'KZ'</span>)
    -><span class="c-fn">where</span>(<span class="c-str">'transactions.amount'</span>, <span class="c-str">'&gt;'</span>, <span class="c-num">10000</span>)
    -><span class="c-fn">select</span>(<span class="c-str">'transactions.*'</span>)  <span class="c-comment">// важно, чтобы Eloquent гидрировал только Transaction</span>
    -><span class="c-fn">get</span>();
</code></pre>
    </div>

    <div class="card">
      <h3>Гибридный подход: relations + selectRaw subqueries</h3>
      <p class="text">Альтернатива чистому JOIN &mdash; добавление вычисляемых столбцов в основной запрос через скалярные подзапросы. Сохраняет преимущества Eloquent (модель с relations) и при этом получает агрегированные данные одним SQL.</p>
<pre><code><span class="c-var">$posts</span> = <span class="c-type">Post</span>::<span class="c-fn">query</span>()
    -><span class="c-fn">with</span>(<span class="c-str">'author'</span>)
    -><span class="c-fn">addSelect</span>([
        <span class="c-str">'comments_count'</span> =&gt; <span class="c-type">Comment</span>::<span class="c-fn">selectRaw</span>(<span class="c-str">'COUNT(*)'</span>)
            -><span class="c-fn">whereColumn</span>(<span class="c-str">'comments.post_id'</span>, <span class="c-str">'posts.id'</span>),
        <span class="c-str">'last_comment_at'</span> =&gt; <span class="c-type">Comment</span>::<span class="c-fn">select</span>(<span class="c-str">'created_at'</span>)
            -><span class="c-fn">whereColumn</span>(<span class="c-str">'comments.post_id'</span>, <span class="c-str">'posts.id'</span>)
            -><span class="c-fn">latest</span>()
            -><span class="c-fn">limit</span>(<span class="c-num">1</span>),
    ])
    -><span class="c-fn">orderByDesc</span>(<span class="c-str">'comments_count'</span>)
    -><span class="c-fn">paginate</span>(<span class="c-num">20</span>);
</code></pre>
      <p class="text">Подробное рассмотрение подзапросов вынесено в подраздел «Subqueries и raw expressions».</p>
    </div>

    <div class="card">
      <h3>Типы JOIN, поддерживаемые Query Builder</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>SQL</th><th>Назначение</th></tr>
        <tr><td><code>join('table', 'a', '=', 'b')</code></td><td>INNER JOIN</td><td>Возвращает только записи, имеющие совпадение в обеих таблицах.</td></tr>
        <tr><td><code>leftJoin('table', 'a', '=', 'b')</code></td><td>LEFT JOIN</td><td>Возвращает все записи левой таблицы и совпадающие из правой (или NULL).</td></tr>
        <tr><td><code>rightJoin('table', 'a', '=', 'b')</code></td><td>RIGHT JOIN</td><td>Симметрично leftJoin (редко используется).</td></tr>
        <tr><td><code>crossJoin('table')</code></td><td>CROSS JOIN</td><td>Декартово произведение двух таблиц.</td></tr>
        <tr><td><code>joinSub($subquery, 'alias', $closure)</code></td><td>JOIN (подзапрос)</td><td>Присоединяет результат подзапроса как виртуальную таблицу.</td></tr>
        <tr><td><code>joinWhere(...)</code></td><td>JOIN ... ON ... WHERE ...</td><td>Добавляет дополнительные условия в ON.</td></tr>
      </table>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: страница отчёта с тысячами записей</div>

    <p class="text">Рассмотрим административную страницу-отчёт по транзакциям: за выбранный период необходимо вывести таблицу из 500 строк, в каждой &mdash; данные транзакции, имя клиента, страна клиента, статус мерчанта, число связанных событий fraud-check. Сортировка по имени клиента или сумме. Сравним три реализации.</p>

    <p class="text"><strong>Реализация 1: чистые relations с eager loading.</strong> Самая декларативная, но требует множества подгрузок и обработки сортировки на стороне PHP.</p>
<pre><code><span class="c-var">$transactions</span> = <span class="c-type">Transaction</span>::<span class="c-fn">query</span>()
    -><span class="c-fn">whereBetween</span>(<span class="c-str">'created_at'</span>, [<span class="c-var">$from</span>, <span class="c-var">$to</span>])
    -><span class="c-fn">with</span>([<span class="c-str">'user.country'</span>, <span class="c-str">'merchant'</span>])
    -><span class="c-fn">withCount</span>(<span class="c-str">'fraudChecks'</span>)
    -><span class="c-fn">paginate</span>(<span class="c-num">500</span>);

<span class="c-comment">// Сортировка по client name невозможна — поле в связанной таблице.</span>
<span class="c-comment">// Если требуется такая сортировка, придётся применять JOIN.</span>
</code></pre>

    <p class="text"><strong>Реализация 2: гибридный подход &mdash; relations + JOIN для сортировки.</strong> Eloquent сохраняется как способ получить модели; JOIN добавляется только для возможности сортировки по полю связанной таблицы.</p>
<pre><code><span class="c-var">$transactions</span> = <span class="c-type">Transaction</span>::<span class="c-fn">query</span>()
    -><span class="c-fn">join</span>(<span class="c-str">'users'</span>, <span class="c-str">'users.id'</span>, <span class="c-str">'='</span>, <span class="c-str">'transactions.user_id'</span>)
    -><span class="c-fn">whereBetween</span>(<span class="c-str">'transactions.created_at'</span>, [<span class="c-var">$from</span>, <span class="c-var">$to</span>])
    -><span class="c-fn">orderBy</span>(<span class="c-str">'users.name'</span>)
    -><span class="c-fn">select</span>(<span class="c-str">'transactions.*'</span>)  <span class="c-comment">// гидрируем только Transaction, не смешиваем колонки</span>
    -><span class="c-fn">with</span>([<span class="c-str">'user.country'</span>, <span class="c-str">'merchant'</span>])
    -><span class="c-fn">withCount</span>(<span class="c-str">'fraudChecks'</span>)
    -><span class="c-fn">paginate</span>(<span class="c-num">500</span>);
</code></pre>

    <p class="text"><strong>Реализация 3: чистый JOIN на Query Builder.</strong> Наиболее эффективная по числу SQL-запросов и памяти, но возвращает плоские объекты &mdash; теряется удобство Eloquent.</p>
<pre><code><span class="c-var">$rows</span> = <span class="c-type">DB</span>::<span class="c-fn">table</span>(<span class="c-str">'transactions'</span>)
    -><span class="c-fn">join</span>(<span class="c-str">'users'</span>,     <span class="c-str">'users.id'</span>,     <span class="c-str">'='</span>, <span class="c-str">'transactions.user_id'</span>)
    -><span class="c-fn">join</span>(<span class="c-str">'countries'</span>, <span class="c-str">'countries.id'</span>, <span class="c-str">'='</span>, <span class="c-str">'users.country_id'</span>)
    -><span class="c-fn">join</span>(<span class="c-str">'merchants'</span>, <span class="c-str">'merchants.id'</span>, <span class="c-str">'='</span>, <span class="c-str">'transactions.merchant_id'</span>)
    -><span class="c-fn">leftJoin</span>(<span class="c-str">'fraud_checks'</span>, <span class="c-str">'fraud_checks.transaction_id'</span>, <span class="c-str">'='</span>, <span class="c-str">'transactions.id'</span>)
    -><span class="c-fn">whereBetween</span>(<span class="c-str">'transactions.created_at'</span>, [<span class="c-var">$from</span>, <span class="c-var">$to</span>])
    -><span class="c-fn">select</span>(
        <span class="c-str">'transactions.id'</span>,
        <span class="c-str">'transactions.amount'</span>,
        <span class="c-str">'transactions.currency'</span>,
        <span class="c-str">'transactions.created_at'</span>,
        <span class="c-str">'users.name AS user_name'</span>,
        <span class="c-str">'countries.code AS country_code'</span>,
        <span class="c-str">'merchants.name AS merchant_name'</span>,
        <span class="c-str">'merchants.status AS merchant_status'</span>,
    )
    -><span class="c-fn">selectRaw</span>(<span class="c-str">'COUNT(fraud_checks.id) AS fraud_checks_count'</span>)
    -><span class="c-fn">groupBy</span>(
        <span class="c-str">'transactions.id'</span>, <span class="c-str">'transactions.amount'</span>, <span class="c-str">'transactions.currency'</span>,
        <span class="c-str">'transactions.created_at'</span>, <span class="c-str">'users.name'</span>, <span class="c-str">'countries.code'</span>,
        <span class="c-str">'merchants.name'</span>, <span class="c-str">'merchants.status'</span>,
    )
    -><span class="c-fn">orderBy</span>(<span class="c-str">'users.name'</span>)
    -><span class="c-fn">paginate</span>(<span class="c-num">500</span>);

<span class="c-comment">// Каждая строка — stdClass с плоскими полями: $row->user_name, $row->merchant_status.</span>
<span class="c-comment">// Нет relations, кастов, accessors. Зато 1 SQL вместо 4-5.</span>
</code></pre>

    <p class="text"><strong>Сравнение по количеству SQL-запросов и времени:</strong> при 500 строках на странице первая реализация &mdash; около 6 запросов (transactions, users, countries, merchants, count fraudChecks, count пагинатора). Вторая &mdash; та же стоимость + JOIN. Третья &mdash; 2 запроса (основной + count). На больших таблицах разница может составлять десятки миллисекунд.</p>

    <p class="text">Рекомендуемая стратегия:</p>
    <ul class="bullets">
      <li>Начинайте с relations: код декларативен, развивается без боли, покрывает большинство сценариев.</li>
      <li>При обнаружении узкого места через профилирование (Telescope, Pulse, EXPLAIN) переходите на гибридный подход с JOIN только там, где нужно.</li>
      <li>Чистый Query Builder с JOIN применяйте на критичных отчётах и read-only страницах, где разница в производительности оправдывает потерю удобства Eloquent.</li>
    </ul>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. JOIN с гидрацией Eloquent: дублирование полей.</strong> При использовании JOIN внутри Eloquent-выборки колонки связанной таблицы попадают в атрибуты модели. Если в обеих таблицах есть колонки с одинаковыми именами (например, <code>id</code>, <code>created_at</code>), последняя перезаписывает первую. Решение &mdash; явный <code>select('posts.*')</code> с указанием конкретных колонок.
    </div>

    <div class="pitfall">
      <strong>2. JOIN игнорирует global scopes.</strong> Если связанная модель имеет <code>SoftDeletes</code> или другие глобальные scopes, прямой JOIN их не применит. Soft-deleted записи попадут в результат. Для корректной фильтрации необходимо явно добавить условия (<code>whereNull('users.deleted_at')</code>, <code>where('users.tenant_id', ...)</code>).
    </div>

    <div class="pitfall">
      <strong>3. <code>whereHas</code> vs <code>join</code>: подзапрос против JOIN.</strong> <code>whereHas('posts', ...)</code> формирует подзапрос с EXISTS, что в большинстве случаев семантически правильно (возвращает только пользователей, не дублирует строки). JOIN с условием возвращает дубликаты для каждого совпадения и требует <code>DISTINCT</code> или <code>GROUP BY</code>. <code>whereHas</code> предпочтительнее для условий вида «пользователь, имеющий хотя бы один пост».
    </div>

    <div class="pitfall">
      <strong>4. <code>groupBy</code> и совместимость с MySQL ONLY_FULL_GROUP_BY.</strong> Современные версии MySQL по умолчанию требуют, чтобы все не-агрегированные колонки в SELECT присутствовали в GROUP BY. Старый код, опирающийся на отключённый <code>ONLY_FULL_GROUP_BY</code>, при переходе на новую версию или на PostgreSQL начнёт падать. Корректное решение &mdash; всегда явно перечислять все колонки в GROUP BY.
    </div>

    <div class="pitfall">
      <strong>5. <code>orderBy</code> по полю связанной таблицы без JOIN.</strong> Если задача только в сортировке (без фильтрации), и нет необходимости использовать другие поля связанной таблицы, через JOIN это решается с минимальными издержками. Через relations &mdash; невозможно без сторонних пакетов или предварительной сортировки на стороне приложения после получения данных.
    </div>

    <div class="pitfall">
      <strong>6. Производительность JOIN на больших таблицах.</strong> Без правильных индексов JOIN превращается в полное сканирование одной из таблиц. Перед написанием JOIN-запроса убедитесь, что колонки FK на обеих сторонах индексированы. Используйте <code>EXPLAIN</code> для анализа плана выполнения.
    </div>

    <div class="pitfall">
      <strong>7. JOIN и пагинация с DISTINCT.</strong> При JOIN с relation типа hasMany каждая родительская запись дублируется в количестве её дочерних. Подсчёт записей для пагинатора (<code>COUNT</code>) может вернуть некорректное число. Используйте <code>distinct()</code> на построителе или подзапрос-агрегатор.
    </div>

    <div class="pitfall">
      <strong>8. Чтение из плоских строк JOIN.</strong> Когда JOIN возвращает <code>stdClass</code> или массив, доступ к полям происходит через атрибуты, имена которых формируются с учётом алиасов. Опечатки и несовпадения не выявляются IDE и проявляются только в runtime. Тесты на ключевые отчёты помогают защититься от этого.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PERF — COLLECTIONS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-perf-collection" class="section">
  <div class="section-title">Eloquent\Collection и Support\Collection</div>

  <!-- ─── 1. ТЕМА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">В Laravel две различных коллекции: базовая <code>Illuminate\Support\Collection</code> и специализированная <code>Illuminate\Database\Eloquent\Collection</code>, наследующая базовую. Базовая &mdash; универсальная обёртка над массивом с богатым API (<code>map</code>, <code>filter</code>, <code>reduce</code>, <code>groupBy</code> и около ста других методов). Eloquent-коллекция добавляет к нему методы, специфичные для коллекций моделей: поиск по primary key в памяти, пакетная догрузка relations, обновление коллекции из БД.</p>
    <p class="text">Различие важно по двум причинам. Во-первых, методы Eloquent-коллекции (например, <code>$users-&gt;load('posts')</code>) работают только на коллекциях моделей; вызов на <code>Support\Collection</code> вернёт ошибку. Во-вторых, операции преобразования (<code>map</code>, <code>filter</code>) на Eloquent-коллекции часто возвращают <strong>базовую</strong> Support\Collection, а не Eloquent-коллекцию, что меняет доступный API и поведение последующих вызовов.</p>
    <p class="text">Понимание, какая коллекция в данный момент в руках, критично при цепочечной обработке выборок: можно неожиданно потерять доступ к Eloquent-методам и получить ошибки или подмену поведения. Это особенно заметно при работе с relations внутри обработчиков коллекции.</p>
  </div>

  <!-- ─── 2. ПЕРЕЧЕНЬ КОМПОНЕНТОВ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Перечень специфичных методов Eloquent\Collection</div>

    <div class="card">
      <h3>Поиск и навигация</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>Поведение</th></tr>
        <tr><td><code>$users-&gt;find($id)</code></td><td>Возвращает модель с указанным primary key <strong>из коллекции в памяти</strong>, без обращения к БД. Удобно при необходимости индексированного доступа после выборки.</td></tr>
        <tr><td><code>$users-&gt;find([1, 2, 3])</code></td><td>Возвращает новую коллекцию с моделями, чьи id указаны в массиве.</td></tr>
        <tr><td><code>$users-&gt;findOrFail($id)</code></td><td>Аналогично <code>find</code>, но бросает исключение, если модель не найдена в коллекции.</td></tr>
        <tr><td><code>$users-&gt;modelKeys()</code></td><td>Массив значений primary key всех моделей в коллекции.</td></tr>
        <tr><td><code>$users-&gt;contains($id)</code></td><td>Проверка, содержит ли коллекция модель с указанным ID.</td></tr>
        <tr><td><code>$users-&gt;diff($otherCollection)</code></td><td>Возвращает модели текущей коллекции, отсутствующие в переданной.</td></tr>
        <tr><td><code>$users-&gt;except($ids)</code> / <code>only($ids)</code></td><td>Фильтрация коллекции по списку идентификаторов.</td></tr>
      </table>
    </div>

    <div class="card">
      <h3>Работа с relations и атрибутами</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>Поведение</th></tr>
        <tr><td><code>$users-&gt;load($relations)</code></td><td>Догружает relation для всех моделей коллекции одним пакетным запросом. Решение N+1 после получения коллекции.</td></tr>
        <tr><td><code>$users-&gt;loadMissing($relations)</code></td><td>То же, но не выполняет запрос, если relation уже загружена.</td></tr>
        <tr><td><code>$users-&gt;loadCount($relations)</code></td><td>Догружает счётчики (<code>{relation}_count</code>) для всех моделей.</td></tr>
        <tr><td><code>$users-&gt;loadAggregate($relation, $column, $function)</code></td><td>Произвольный агрегат по relation (sum, avg, min, max).</td></tr>
        <tr><td><code>$users-&gt;makeHidden($attributes)</code></td><td>Скрывает атрибуты во всех моделях коллекции для последующей сериализации.</td></tr>
        <tr><td><code>$users-&gt;makeVisible($attributes)</code></td><td>Симметрично makeHidden.</td></tr>
        <tr><td><code>$users-&gt;append($attributes)</code></td><td>Добавляет accessor-атрибуты в <code>$appends</code> на каждой модели коллекции.</td></tr>
      </table>
    </div>

    <div class="card">
      <h3>Перечитывание и преобразование</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>Поведение</th></tr>
        <tr><td><code>$users-&gt;fresh($relations)</code></td><td>Возвращает новую коллекцию, перечитав каждую модель из БД (опционально с указанными relations).</td></tr>
        <tr><td><code>$users-&gt;toQuery()</code></td><td>Возвращает построитель запросов с условием <code>WHERE id IN ($modelKeys)</code>. Удобно для bulk-обновлений или удалений.</td></tr>
        <tr><td><code>$users-&gt;unique()</code> (Eloquent)</td><td>Уникальность определяется по primary key (для Support\Collection &mdash; по значению callback'а).</td></tr>
        <tr><td><code>$users-&gt;mapInto($class)</code></td><td>Преобразует каждый элемент в экземпляр указанного класса.</td></tr>
      </table>
    </div>

    <div class="card">
      <h3>Какая коллекция возвращается в каждом случае</h3>
      <table class="data-table">
        <tr><th>Выражение</th><th>Тип результата</th></tr>
        <tr><td><code>User::all()</code></td><td><code>Eloquent\Collection</code></td></tr>
        <tr><td><code>User::get()</code></td><td><code>Eloquent\Collection</code></td></tr>
        <tr><td><code>User::with('posts')-&gt;get()</code></td><td><code>Eloquent\Collection</code></td></tr>
        <tr><td><code>$user-&gt;posts</code> (hasMany)</td><td><code>Eloquent\Collection</code></td></tr>
        <tr><td><code>$user-&gt;roles</code> (belongsToMany)</td><td><code>Eloquent\Collection</code></td></tr>
        <tr><td><code>User::pluck('email')</code></td><td><code>Support\Collection</code> (значения, не модели)</td></tr>
        <tr><td><code>User::all()-&gt;pluck('email')</code></td><td><code>Support\Collection</code></td></tr>
        <tr><td><code>$users-&gt;map(fn($u) =&gt; $u-&gt;name)</code></td><td><code>Support\Collection</code> (значения, не модели)</td></tr>
        <tr><td><code>$users-&gt;mapInto(UserDto::class)</code></td><td><code>Support\Collection</code> (объекты UserDto)</td></tr>
        <tr><td><code>$users-&gt;filter(...)</code></td><td><code>Eloquent\Collection</code> (если все элементы &mdash; модели)</td></tr>
        <tr><td><code>collect([1, 2, 3])</code></td><td><code>Support\Collection</code></td></tr>
      </table>
      <p class="text">Главное правило: операции, возвращающие отфильтрованное подмножество существующих элементов (<code>filter</code>, <code>where</code>, <code>except</code>), сохраняют тип Eloquent\Collection. Операции, преобразующие элементы (<code>map</code>, <code>pluck</code>, <code>mapInto</code>), возвращают Support\Collection, поскольку результат может не быть набором моделей.</p>
    </div>

    <div class="card">
      <h3>Кастомная Eloquent-коллекция</h3>
      <p class="text">При необходимости можно определить собственный класс коллекции для конкретной модели, расширив <code>Eloquent\Collection</code> и переопределив метод <code>newCollection</code> на модели. Это позволяет добавить доменные методы непосредственно к коллекциям модели.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Database\Eloquent\Collection</span>;

<span class="c-key">class</span> <span class="c-type">PostCollection</span> <span class="c-key">extends</span> <span class="c-type">Collection</span>
{
    <span class="c-key">public function</span> <span class="c-fn">published</span>(): <span class="c-key">self</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">filter</span>(<span class="c-key">fn</span> (<span class="c-type">Post</span> <span class="c-var">$post</span>) =&gt; <span class="c-var">$post</span>-><span class="c-var">status</span> === <span class="c-str">'published'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">groupByMonth</span>(): <span class="c-key">self</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">groupBy</span>(<span class="c-key">fn</span> (<span class="c-type">Post</span> <span class="c-var">$post</span>) =&gt; <span class="c-var">$post</span>-><span class="c-var">created_at</span>-><span class="c-fn">format</span>(<span class="c-str">'Y-m'</span>));
    }
}

<span class="c-key">class</span> <span class="c-type">Post</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">newCollection</span>(<span class="c-key">array</span> <span class="c-var">$models</span> = []): <span class="c-type">PostCollection</span>
    {
        <span class="c-key">return new</span> <span class="c-type">PostCollection</span>(<span class="c-var">$models</span>);
    }
}

<span class="c-comment">// Теперь все выборки Post возвращают PostCollection с доменными методами.</span>
<span class="c-type">Post</span>::<span class="c-fn">all</span>()-><span class="c-fn">published</span>()-><span class="c-fn">groupByMonth</span>();
</code></pre>
    </div>
  </div>

  <!-- ─── 3. ПРАКТИКА ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: пакетная обработка выборки</div>

    <p class="text">Рассмотрим типичную задачу: после получения коллекции пользователей выполнить ряд операций &mdash; отфильтровать активных, догрузить их подписки и недавние посты, проверить наличие конкретного администратора, обновить статус для группы и удалить устаревших. На этом примере проявляются все ключевые особенности обеих коллекций.</p>

<pre><code><span class="c-comment">// 1. Получение исходной выборки — Eloquent\Collection.</span>
<span class="c-var">$users</span> = <span class="c-type">User</span>::<span class="c-fn">whereBetween</span>(<span class="c-str">'created_at'</span>, [<span class="c-fn">now</span>()-><span class="c-fn">subMonth</span>(), <span class="c-fn">now</span>()])-><span class="c-fn">get</span>();

<span class="c-comment">// 2. Фильтрация — результат остаётся Eloquent\Collection.</span>
<span class="c-var">$activeUsers</span> = <span class="c-var">$users</span>-><span class="c-fn">filter</span>(<span class="c-key">fn</span> (<span class="c-type">User</span> <span class="c-var">$u</span>) =&gt; <span class="c-var">$u</span>-><span class="c-var">status</span> === <span class="c-str">'active'</span>);
<span class="c-comment">// $activeUsers — Eloquent\Collection, методы load/loadCount доступны.</span>

<span class="c-comment">// 3. Пакетная догрузка relations — один SQL вместо N+1.</span>
<span class="c-var">$activeUsers</span>-><span class="c-fn">load</span>([<span class="c-str">'subscription'</span>, <span class="c-str">'posts'</span> =&gt; <span class="c-key">fn</span> (<span class="c-var">$q</span>) =&gt; <span class="c-var">$q</span>-><span class="c-fn">latest</span>()-><span class="c-fn">limit</span>(<span class="c-num">5</span>)]);

<span class="c-comment">// 4. Поиск конкретного пользователя в памяти, без запроса к БД.</span>
<span class="c-var">$admin</span> = <span class="c-var">$activeUsers</span>-><span class="c-fn">find</span>(<span class="c-var">$adminId</span>);

<span class="c-key">if</span> (<span class="c-var">$admin</span> !== <span class="c-key">null</span>) {
    <span class="c-comment">// Найден без обращения к БД.</span>
}

<span class="c-comment">// 5. Получение списка ID для bulk-операции.</span>
<span class="c-var">$ids</span> = <span class="c-var">$activeUsers</span>-><span class="c-fn">modelKeys</span>();
<span class="c-comment">// [1, 5, 12, 23, 41, ...]</span>

<span class="c-comment">// 6. Bulk-обновление через toQuery — один UPDATE для всей коллекции.</span>
<span class="c-var">$activeUsers</span>-><span class="c-fn">toQuery</span>()-><span class="c-fn">update</span>([<span class="c-str">'last_seen_at'</span> =&gt; <span class="c-fn">now</span>()]);
<span class="c-comment">// SQL: UPDATE users SET last_seen_at = ? WHERE id IN (1, 5, 12, ...)</span>
<span class="c-comment">// События Eloquent не вызываются (это bulk через Query Builder).</span>

<span class="c-comment">// 7. Преобразование в плоский список email — Support\Collection.</span>
<span class="c-var">$emails</span> = <span class="c-var">$activeUsers</span>-><span class="c-fn">pluck</span>(<span class="c-str">'email'</span>);
<span class="c-comment">// Теперь $emails — Support\Collection, методов load/loadCount нет.</span>

<span class="c-comment">// 8. Преобразование в DTO для API — Support\Collection.</span>
<span class="c-var">$dtos</span> = <span class="c-var">$activeUsers</span>-><span class="c-fn">mapInto</span>(<span class="c-type">UserResponseDto</span>::<span class="c-key">class</span>);

<span class="c-comment">// 9. Подготовка к сериализации API — скрываем поля во всех моделях коллекции.</span>
<span class="c-var">$activeUsers</span>-><span class="c-fn">makeHidden</span>([<span class="c-str">'internal_notes'</span>, <span class="c-str">'risk_score'</span>]);

<span class="c-comment">// 10. Перечитывание из БД с relations.</span>
<span class="c-var">$refreshed</span> = <span class="c-var">$activeUsers</span>-><span class="c-fn">fresh</span>([<span class="c-str">'subscription'</span>]);
</code></pre>

    <p class="text">Пример с кастомной коллекцией для модели <code>Order</code>:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">OrderCollection</span> <span class="c-key">extends</span> <span class="c-type">Collection</span>
{
    <span class="c-key">public function</span> <span class="c-fn">paid</span>(): <span class="c-key">self</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">filter</span>(<span class="c-key">fn</span> (<span class="c-type">Order</span> <span class="c-var">$o</span>) =&gt; <span class="c-var">$o</span>-><span class="c-var">paid_at</span> !== <span class="c-key">null</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">totalAmount</span>(): <span class="c-key">int</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">sum</span>(<span class="c-str">'amount'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">byCurrency</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-fn">groupBy</span>(<span class="c-str">'currency'</span>)
            -><span class="c-fn">map</span>-><span class="c-fn">totalAmount</span>()
            -><span class="c-fn">all</span>();
    }
}

<span class="c-key">class</span> <span class="c-type">Order</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">newCollection</span>(<span class="c-key">array</span> <span class="c-var">$models</span> = []): <span class="c-type">OrderCollection</span>
    {
        <span class="c-key">return new</span> <span class="c-type">OrderCollection</span>(<span class="c-var">$models</span>);
    }
}

<span class="c-comment">// Использование</span>
<span class="c-var">$orders</span> = <span class="c-type">Order</span>::<span class="c-fn">forUser</span>(<span class="c-var">$user</span>)-><span class="c-fn">get</span>();

<span class="c-fn">echo</span> <span class="c-var">$orders</span>-><span class="c-fn">paid</span>()-><span class="c-fn">totalAmount</span>();
<span class="c-fn">print_r</span>(<span class="c-var">$orders</span>-><span class="c-fn">byCurrency</span>());
</code></pre>
  </div>

  <!-- ─── 4. ОСОБЫЕ СЛУЧАИ ─── -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи и типичные ошибки</div>

    <div class="pitfall">
      <strong>1. <code>map()</code> возвращает Support\Collection.</strong> После <code>$users-&gt;map(...)</code> результат &mdash; Support\Collection даже если каждый возвращённый элемент остаётся моделью. Это значит, что методы вроде <code>$mapped-&gt;load('posts')</code> вернут ошибку. Если необходимо сохранить тип, используйте <code>$users-&gt;each(...)</code> для модификации существующих моделей или <code>$users-&gt;transform(...)</code> для in-place преобразования.
    </div>

    <div class="pitfall">
      <strong>2. <code>$users-&gt;find(5)</code> и <code>User::find(5)</code> &mdash; разные операции.</strong> Первый ищет модель с id=5 в уже загруженной коллекции (в памяти, без SQL); второй выполняет запрос к БД. Путаница приводит к скрытому выполнению лишних SQL-запросов внутри циклов.
    </div>

    <div class="pitfall">
      <strong>3. <code>toQuery()</code> и порядок вызовов.</strong> Метод возвращает построитель запросов с условием <code>WHERE id IN ($modelKeys)</code>. Если до его вызова на коллекции выполнены <code>filter</code>, <code>map</code>, <code>pluck</code> и она перестала быть Eloquent-коллекцией, <code>toQuery</code> не сработает. Метод доступен только на Eloquent\Collection.
    </div>

    <div class="pitfall">
      <strong>4. <code>load</code> и порядок выполнения.</strong> <code>$users-&gt;load('posts')</code> модифицирует коллекцию по ссылке: после этого вызова все модели в коллекции имеют загруженную relation. Однако, если коллекция была получена через <code>map</code> и стала Support\Collection, <code>load</code> вызовет ошибку.
    </div>

    <div class="pitfall">
      <strong>5. <code>pluck()</code> и многоуровневые ключи.</strong> Метод поддерживает синтаксис <code>pluck('value_column', 'key_column')</code> для построения key-value мапы. Однако значения ключей дублируются: если в коллекции несколько моделей с одинаковым ключом, в результат попадёт только последняя. Для подобных задач лучше использовать <code>keyBy</code>.
    </div>

    <div class="pitfall">
      <strong>6. <code>fresh()</code> и стоимость операции.</strong> Метод выполняет SELECT по всем primary key коллекции одним запросом, но возвращает <strong>новую</strong> коллекцию &mdash; старые модели не обновляются. Если необходимо обновить «по месту», используется <code>refresh()</code> на каждой модели, что даёт N запросов.
    </div>

    <div class="pitfall">
      <strong>7. Кастомные коллекции и интерфейсы Laravel.</strong> При определении кастомной Eloquent-коллекции необходимо корректно вернуть её тип в методах, возвращающих коллекцию (<code>filter</code>, <code>where</code>, <code>map</code>). Без переопределения они вернут базовый тип. Для типизации возвращаемых значений используется PHPDoc или генериковая типизация.
    </div>

    <div class="pitfall">
      <strong>8. Сериализация коллекций в JSON.</strong> Eloquent\Collection при сериализации использует <code>toArray</code>/<code>toJson</code> каждой модели, учитывая <code>$hidden</code> / <code>$visible</code> / <code>$appends</code>. Support\Collection с произвольными элементами сериализует каждый элемент как есть; если элементы &mdash; массивы или объекты, поведение зависит от их собственной поддержки JsonSerializable.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PRACTICE
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-practice" class="section">
  <div class="section-title">Практика — 5 реальных задач</div>

  <p class="text">Закрепить материал. Каждая задача — мини-фича на свежем Laravel-проекте. Если все осилишь — Eloquent твой.</p>

  <div class="task-card">
    <h3>1. Многоуровневые комментарии (Polymorphic + nested)</h3>
    <p class="text">Сделай систему комментариев, где Comment может быть к Post или Photo, а ещё может иметь parent_id (ответ на другой комментарий).</p>
    <ul class="bullets">
      <li>Модели: Post, Photo, Comment (с <code>morphTo('commentable')</code> + <code>parent_id</code>)</li>
      <li>Метод <code>$post->comments</code> возвращает плоский список</li>
      <li>Метод <code>$post->commentTree()</code> возвращает дерево с replies</li>
      <li>API endpoint <code>GET /posts/{id}/comments</code> возвращает JSON-дерево</li>
    </ul>
    <div class="criteria"><strong>Критерий успеха:</strong> на странице с 50 комментариями — не более <strong>3 SQL-запросов</strong> (Post, Comments, Users авторов комментариев). Замерь через Telescope.</div>
  </div>

  <div class="task-card">
    <h3>2. Multi-tenancy через Global Scope</h3>
    <p class="text">Сделай так, чтобы все модели типа Project, Task, Document автоматически фильтровались по <code>tenant_id</code> текущего юзера.</p>
    <ul class="bullets">
      <li>Создай <code>TenantScope</code> implements <code>Scope</code></li>
      <li>Middleware определяет tenant из субдомена (<code>acme.app.test</code> → tenant_id 1)</li>
      <li>Все запросы Project автоматически добавляют WHERE tenant_id = X</li>
      <li>Artisan-команда <code>tenant:run my:command --tenant=acme</code> для запуска под конкретным тенантом</li>
    </ul>
    <div class="criteria"><strong>Критерий успеха:</strong> ни один контроллер не упоминает tenant_id явно. Запросы фильтруются автоматически. Юзер тенанта A не видит данные тенанта B даже при попытке прямого <code>Project::find($id)</code>.</div>
  </div>

  <div class="task-card">
    <h3>3. Money value object через кастомный каст</h3>
    <p class="text">Реализуй Money как value object и кастомный каст к нему.</p>
    <ul class="bullets">
      <li><code>Money</code> хранит <code>amount</code> (int, копейки) + <code>currency</code> (string)</li>
      <li>В БД хранится в двух колонках: <code>price_amount</code>, <code>price_currency</code></li>
      <li><code>MoneyCast</code> implements <code>CastsAttributes</code> с методами get/set</li>
      <li>Методы на Money: <code>add()</code>, <code>multiply($factor)</code>, <code>format()</code></li>
    </ul>
    <div class="criteria"><strong>Критерий успеха:</strong> в контроллере пишется <code>$product->price->add(Money::usd(100))</code>. Никакой математики над сырыми числами.</div>
  </div>

  <div class="task-card">
    <h3>4. Экспорт 100k записей в CSV — сравнение методов</h3>
    <p class="text">Сгенерируй 100 000 фейковых юзеров. Сделай 3 реализации экспорта:</p>
    <ul class="bullets">
      <li>через <code>cursor()</code></li>
      <li>через <code>chunkById(1000)</code></li>
      <li>через <code>lazy(1000)</code></li>
    </ul>
    <p class="text">Замерь у каждой:</p>
    <ul class="bullets">
      <li>Пиковая память (<code>memory_get_peak_usage()</code>)</li>
      <li>Время выполнения</li>
      <li>Количество SQL-запросов</li>
    </ul>
    <div class="criteria"><strong>Критерий успеха:</strong> с <code>memory_limit=128M</code> ни одна реализация не падает. В отчёт включи цифры и сделай вывод какой подход для какой задачи.</div>
  </div>

  <div class="task-card">
    <h3>5. Observer + queue race condition</h3>
    <p class="text">Воспроизведи и почини классический баг.</p>
    <ul class="bullets">
      <li>OrderObserver на <code>created</code> диспатчит <code>SendInvoice</code> job</li>
      <li>Job достаёт Order по ID, генерирует PDF, отправляет email</li>
      <li>Order::create() оборачивается в DB::transaction</li>
      <li>Иногда (раз в N запусков) job падает <code>Model not found</code></li>
    </ul>
    <p class="text">Почему? Job отправился до commit транзакции, queue worker подхватил быстрее чем БД зафиксировала запись.</p>
    <div class="criteria"><strong>Критерий успеха:</strong> почини двумя способами — через <code>public $afterCommit = true</code> на job, и через <code>DB::afterCommit()</code> в observer. Напиши тест, который воспроизводит баг (без фикса падает, с фиксом проходит).</div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PITFALLS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-pitfalls" class="section">
  <div class="section-title">Подводные камни (сводная таблица)</div>

  <table class="data-table">
    <tr><th>Камень</th><th>Где</th><th>Как избежать</th></tr>
    <tr><td><code>sync([1, 2])</code> удаляет всё кроме указанного</td><td>belongsToMany</td><td><code>syncWithoutDetaching</code> если аддитивно</td></tr>
    <tr><td>Polymorphic без morph map</td><td>morphTo</td><td>Регистрировать <code>Relation::enforceMorphMap([...])</code></td></tr>
    <tr><td><code>insert()</code> минует касты / events</td><td>bulk insert</td><td>Знать что events/observers/mutators отключены</td></tr>
    <tr><td>Observer на <code>saved</code> + <code>save()</code> внутри = infinite loop</td><td>observers</td><td><code>saveQuietly()</code> или <code>withoutEvents()</code></td></tr>
    <tr><td>Mail/queue до commit транзакции</td><td>DB transactions</td><td><code>DB::afterCommit()</code> или <code>$afterCommit = true</code> на job</td></tr>
    <tr><td>Unique constraint на soft-deleted моделях</td><td>soft delete</td><td><code>Rule::unique()->whereNull('deleted_at')</code> + partial index</td></tr>
    <tr><td>N+1 в <code>count</code> внутри шаблона</td><td>views</td><td><code>withCount()</code> или <code>loadCount()</code></td></tr>
    <tr><td><code>chunk()</code> при удалении в процессе пропускает записи</td><td>chunk</td><td>Использовать <code>chunkById()</code></td></tr>
    <tr><td>Зашифрованный каст нельзя в WHERE</td><td>encrypted cast</td><td>Хранить hash отдельно для поиска</td></tr>
    <tr><td>Global scope забыли отключить → данные не найдены</td><td>global scope</td><td><code>withoutGlobalScope()</code> в импорте / фоновых задачах</td></tr>
    <tr><td><code>$casts = ['data' =&gt; 'array']</code> мутации не работают</td><td>JSON cast</td><td><code>'AsArrayObject'</code> вместо <code>'array'</code> — даст mutability</td></tr>
    <tr><td>Accessor с DB-запросом = N+1 в шаблоне</td><td>accessor</td><td><code>shouldCache()</code> или предзагрузить в контроллере</td></tr>
    <tr><td><code>cursor()</code> + <code>with()</code> не работает вместе</td><td>cursor</td><td>Использовать <code>chunkById()</code> или <code>lazy()</code></td></tr>
  </table>
</div>

<!-- ════════════════════════════════════════════════════════════════
     INTERVIEW
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-interview" class="section">
  <div class="section-title">Вопросы на собеседование</div>

  <p class="text">Реальные вопросы для middle/senior PHP/Laravel. Попробуй ответить, не подглядывая.</p>

  <div class="card">
    <h3>1. В чём разница между <code>with()</code> и <code>load()</code>?</h3>
    <p class="text"><code>with()</code> — eager load <strong>при</strong> построении запроса. <code>load()</code> — догрузить relation на <strong>уже выбранной</strong> коллекции/модели. Оба избавляют от N+1, но <code>load()</code> делает +1 SQL после основного запроса, а <code>with()</code> делает 2 SQL вместе с основным.</p>
  </div>

  <div class="card">
    <h3>2. Как работает <code>belongsToMany</code> под капотом? Какой SQL генерируется <code>attach()</code>?</h3>
    <p class="text">При вызове <code>$user->roles</code> Laravel JOIN'ит pivot-таблицу с целевой:<br>
    <code>SELECT roles.* FROM roles INNER JOIN role_user ON roles.id = role_user.role_id WHERE role_user.user_id = ?</code>.<br>
    <code>attach($id)</code> делает <code>INSERT INTO role_user (user_id, role_id) VALUES (?, ?)</code>.<br>
    <code>detach($id)</code> — <code>DELETE FROM role_user WHERE user_id = ? AND role_id = ?</code>.<br>
    <code>sync([1, 2, 3])</code> — комбинация INSERT и DELETE, чтобы оставить ровно указанные.</p>
  </div>

  <div class="card">
    <h3>3. Как реализовать комментарии для нескольких типов моделей?</h3>
    <p class="text">Polymorphic relations. Таблица comments с <code>commentable_type</code> + <code>commentable_id</code>. На Comment — <code>morphTo('commentable')</code>. На Post, Photo, Video — <code>morphMany(Comment, 'commentable')</code>. Обязательно зарегистрировать morph map в AppServiceProvider, чтобы избежать боли при ренейме классов.</p>
  </div>

  <div class="card">
    <h3>4. Что делает <code>hasManyThrough</code> и чем отличается от <code>whereHas</code>?</h3>
    <p class="text"><code>hasManyThrough</code> — «дай мне все Posts через User для Country» — возвращает <strong>Post</strong>'ы. <code>whereHas</code> — «дай мне User'ов у которых есть Posts» — возвращает <strong>User</strong>'ов. Первое — про получение «правнуков», второе — про фильтрацию исходной модели.</p>
  </div>

  <div class="card">
    <h3>5. Почему <code>Model::insert()</code> не вызывает observers?</h3>
    <p class="text">Потому что <code>insert()</code> — это метод Query Builder, а не Eloquent. Он напрямую отправляет SQL без гидрации моделей. События Eloquent (creating, created) кидаются только когда есть <strong>инстанс модели</strong>. У bulk insert инстансов нет — экономия памяти, но и observers молчат.</p>
  </div>

  <div class="card">
    <h3>6. Как избежать race condition между observer'ом и queued job'ом?</h3>
    <p class="text">Job отправляется до commit транзакции, queue worker подхватывает быстрее чем БД фиксирует. Решения: <code>DB::afterCommit(fn() =&gt; dispatch($job))</code>, или <code>public $afterCommit = true</code> на самом job-классе, или глобально в <code>config/queue.php</code>.</p>
  </div>

  <div class="card">
    <h3>7. Что произойдёт при <code>$user->roles()->sync([])</code>?</h3>
    <p class="text">Удалятся <strong>все</strong> связи юзера с ролями. <code>sync()</code> синхронизирует pivot-таблицу с переданным массивом — пустой массив = «оставь ровно ничего».</p>
  </div>

  <div class="card">
    <h3>8. Разница между <code>chunk</code> и <code>chunkById</code>?</h3>
    <p class="text"><code>chunk</code> использует LIMIT/OFFSET. Опасен, если в процессе удалять/вставлять записи — данные «сдвинутся» и часть пропустится или продублируется. <code>chunkById</code> пагинирует по primary key (<code>WHERE id &gt; last_id</code>) — безопасен при мутации, но требует индексированного автоинкремент-PK.</p>
  </div>

  <div class="card">
    <h3>9. Что такое morph map и зачем он нужен?</h3>
    <p class="text">Это маппинг короткого имени (<code>'post'</code>) на FQCN (<code>App\Models\Post</code>) для polymorphic relations. Без него в БД лежит полный namespace. Если переименуешь класс или сменишь namespace — связи сломаются. Регистрируй через <code>Relation::enforceMorphMap([...])</code> в AppServiceProvider.</p>
  </div>

  <div class="card">
    <h3>10. Как реализовать многотенантность через global scope?</h3>
    <p class="text">Создать <code>TenantScope implements Scope</code> с методом <code>apply(Builder $q, Model $m)</code>, который добавляет <code>WHERE tenant_id = auth()-&gt;user()-&gt;tenant_id</code>. Подключить через <code>static::addGlobalScope(new TenantScope)</code> в <code>booted()</code> модели. Помнить про <code>withoutGlobalScope()</code> для админских / фоновых запросов.</p>
  </div>

  <div class="info-box success">
    <strong>Бонус-вопрос:</strong> назови 3 способа решить N+1. <em>Ответ:</em> <code>with()</code> при выборке, <code>load()</code> после, <code>withCount()</code>/<code>withSum()</code> для агрегатов, <code>preventLazyLoading()</code> в dev для отлова.
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
