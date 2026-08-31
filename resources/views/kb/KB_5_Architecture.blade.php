@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Архитектура и паттерны — продвинутый разбор</title>
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
  <div class="sidebar-title">Architecture &amp; Patterns</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">Принципы</div>
  <a class="nav-item" onclick="showSection('solid',this)"><i data-lucide="shield-check"></i> SOLID</a>
  <a class="nav-item" onclick="showSection('grasp',this)"><i data-lucide="git-pull-request"></i> GRASP, DRY, KISS, YAGNI</a>

  <div class="nav-group-label">GoF паттерны</div>
  <a class="nav-item" onclick="showSection('creational',this)"><i data-lucide="package-plus"></i> Creational</a>
  <a class="nav-item" onclick="showSection('structural',this)"><i data-lucide="layers"></i> Structural</a>
  <a class="nav-item" onclick="showSection('behavioral',this)"><i data-lucide="activity"></i> Behavioral</a>

  <div class="nav-group-label">Web/App паттерны</div>
  <a class="nav-item" onclick="showSection('repository',this)"><i data-lucide="database"></i> Repository</a>
  <a class="nav-item" onclick="showSection('service',this)"><i data-lucide="box"></i> Service + DTO</a>

  <div class="nav-group-label">Большая архитектура</div>
  <a class="nav-item" onclick="showSection('ddd',this)"><i data-lucide="boxes"></i> DDD тактика</a>
  <a class="nav-item" onclick="showSection('clean',this)"><i data-lucide="cuboid"></i> Clean / Hexagonal</a>
  <a class="nav-item" onclick="showSection('outbox',this)"><i data-lucide="mailbox"></i> Transactional Outbox</a>

  <div class="nav-group-label">Применение</div>
  <a class="nav-item" onclick="showSection('practice',this)"><i data-lucide="hammer"></i> Рефакторинг bad→good</a>
  <a class="nav-item" onclick="showSection('pitfalls',this)"><i data-lucide="alert-octagon"></i> Подводные камни</a>
  <a class="nav-item" onclick="showSection('interview',this)"><i data-lucide="brain"></i> На собеседование</a>
</div>

<div class="main">
<div class="page-header">
  <h1>Архитектура и паттерны</h1>
  <p>SOLID и эвристики дизайна, классические GoF-паттерны с PHP-примерами, веб-паттерны (Repository, Service, DTO), DDD-тактика (Entity, Value Object, Aggregate), Clean Architecture и Hexagonal. Все примеры на Laravel, с реальными bad-vs-good рефакторингами.</p>
  <div class="badge-row">
    <span class="badge">SOLID</span>
    <span class="badge">GoF</span>
    <span class="badge">DDD</span>
    <span class="badge">Clean Architecture</span>
    <span class="badge badge-success">Middle / Senior</span>
  </div>
</div>

<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>
  <p class="text">Паттерны и принципы &mdash; не самоцель. Junior часто заучивает 23 GoF-паттерна и применяет их где попало, делая код хуже. Senior знает те же паттерны, но <strong>применяет осознанно</strong>: видит, какую конкретную проблему решает каждый паттерн, и не использует его, если проблемы нет. Этот раздел даёт операционное понимание: когда паттерн оправдан, когда overkill, и как сводить теорию с практикой Laravel.</p>

  <div class="info-box primary">
    <strong>Принципы раздела:</strong>
    <ul class="bullets" style="margin-top:6px;margin-bottom:0;color:#404357;">
      <li><strong>Паттерны &mdash; решение, не цель</strong>. Сначала проблема, потом инструмент;</li>
      <li><strong>Простой код &gt; «правильный» код</strong>. Преждевременная абстракция дороже дублирования;</li>
      <li><strong>SOLID &mdash; эвристика, не закон</strong>. Понимание «почему» важнее буквы;</li>
      <li><strong>DDD &mdash; для сложных доменов</strong>. На CRUD-приложении создаёт лишний слой;</li>
      <li><strong>Clean Architecture &mdash; полезна, дорога в реализации</strong>. Не для каждого проекта.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Пререквизиты</div>
    <ul class="bullets">
      <li>KB_1 &mdash; интерфейсы, абстрактные классы, traits;</li>
      <li>KB_3 &mdash; controllers, services, dependency injection;</li>
      <li>KB_13 &mdash; Service Container (для понимания DI).</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map"></i> Карта раздела</div>
    <table class="data-table">
      <tr><th>Блок</th><th>Что разбирается</th></tr>
      <tr><td><strong>Принципы</strong></td><td>SOLID (5 принципов), GRASP, DRY, KISS, YAGNI</td></tr>
      <tr><td><strong>GoF</strong></td><td>Creational, Structural, Behavioral &mdash; самые используемые в backend</td></tr>
      <tr><td><strong>Web/App</strong></td><td>Repository, Service Layer, DTO &mdash; на каждый день</td></tr>
      <tr><td><strong>DDD/Clean</strong></td><td>Entity, Value Object, Aggregate, Hexagonal</td></tr>
      <tr><td><strong>Практика</strong></td><td>Рефакторинг 200-строчного контроллера до читаемого кода</td></tr>
    </table>
  </div>
</div>

<div id="sec-solid" class="section">
  <div class="section-title">SOLID</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">SOLID &mdash; пять принципов ООП-дизайна, сформулированных Робертом Мартином в 2000-х. Это эвристики, не строгие законы. Цель &mdash; уменьшить связанность, увеличить переиспользование, сделать код терпимым к изменениям. Senior следует SOLID не догматически: иногда нарушение принципа &mdash; правильное решение.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Пять принципов</div>

    <div class="card">
      <h3>S &mdash; Single Responsibility Principle</h3>
      <p class="text">Класс должен иметь <strong>одну причину для изменения</strong>. Не «делать одну вещь», а служить одной группе stakeholders. <code>OrderService</code>, который считает скидки + пишет в БД + отправляет уведомления &mdash; нарушает SRP: каждое требование может измениться независимо. Лекарство: <code>DiscountCalculator</code>, <code>OrderRepository</code>, <code>OrderNotifier</code>.</p>
    </div>

    <div class="card">
      <h3>O &mdash; Open/Closed Principle</h3>
      <p class="text">Сущности <strong>открыты для расширения, закрыты для модификации</strong>. Добавление платёжного провайдера не должно требовать правок <code>PaymentService</code>. Решение &mdash; интерфейс <code>PaymentGateway</code> + новые реализации (Stripe, Paddle, Fake).</p>
    </div>

    <div class="card">
      <h3>L &mdash; Liskov Substitution Principle</h3>
      <p class="text">Объекты подкласса <strong>взаимозаменяемы</strong> с родительскими без поломки поведения. Классика: <code>Square extends Rectangle</code> &mdash; нарушение, потому что <code>setWidth(5); setHeight(4)</code> даёт площадь 20 у Rectangle и 16 у Square. Иерархия должна отражать поведение, не семантику.</p>
    </div>

    <div class="card">
      <h3>I &mdash; Interface Segregation Principle</h3>
      <p class="text">Клиенты не зависят от методов, которые не используют. <code>Worker</code> с методами <code>work/eat/sleep</code> &mdash; робот вынужден реализовать <code>eat</code>. Лекарство: разделить на <code>Workable</code>, <code>Eatable</code>, <code>Sleepable</code>.</p>
    </div>

    <div class="card">
      <h3>D &mdash; Dependency Inversion Principle</h3>
      <p class="text">Высокоуровневые модули не зависят от низкоуровневых. Оба зависят от <strong>абстракций</strong>. <code>OrderService</code> не импортирует <code>MySqlOrderRepository</code> &mdash; только <code>OrderRepositoryInterface</code>. Реализация подменяется через Service Container.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: SRP в контроллере</div>
<pre><code><span class="c-comment">// ❌ Контроллер делает всё</span>
<span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>)
{
    <span class="c-var">$validated</span> = <span class="c-var">$request</span>-&gt;<span class="c-fn">validate</span>([<span class="c-str">'email'</span> =&gt; <span class="c-str">'required|email'</span>]);
    <span class="c-key">if</span> (<span class="c-var">$validated</span>[<span class="c-str">'country'</span>] === <span class="c-str">'KZ'</span>) <span class="c-var">$tax</span> = <span class="c-var">$validated</span>[<span class="c-str">'amount'</span>] * <span class="c-num">0.12</span>;
    <span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">create</span>([...]);
    <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$order</span>-&gt;<span class="c-var">email</span>)-&gt;<span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">OrderConfirmation</span>(<span class="c-var">$order</span>));
    <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>(<span class="c-var">$order</span>);
}

<span class="c-comment">// ✓ Каждый класс — одна ответственность</span>
<span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">StoreOrderRequest</span> <span class="c-var">$request</span>, <span class="c-type">CreateOrder</span> <span class="c-var">$action</span>): <span class="c-type">JsonResponse</span>
{
    <span class="c-var">$order</span> = <span class="c-var">$action</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());
    <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>(<span class="c-key">new</span> <span class="c-type">OrderResource</span>(<span class="c-var">$order</span>), <span class="c-num">201</span>);
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. «Класс должен делать одну вещь».</strong> Слишком узко. <code>UserService::create()</code> может делать 5 шагов &mdash; это одна <em>ответственность</em>: создание пользователя.</div>
    <div class="pitfall"><strong>2. SOLID на CRUD.</strong> Простой CRUD не требует абстракций. <code>BookController</code> с прямыми <code>Book::create()</code> &mdash; читается лучше, чем три уровня сервисов.</div>
    <div class="pitfall"><strong>3. OCP через наследование.</strong> Глубокая иерархия &mdash; кошмар. Композиция (несколько зависимостей в конструкторе) &mdash; обычно лучше.</div>
    <div class="pitfall"><strong>4. LSP через NotImplementedException.</strong> Класс наследует интерфейс, бросая <code>throw new NotImplementedException()</code> &mdash; это ISP-нарушение.</div>
    <div class="pitfall"><strong>5. ISP с микро-интерфейсами.</strong> Если каждый метод &mdash; отдельный интерфейс, проект тонет в файлах. Группируйте методы, которые используются вместе.</div>
    <div class="pitfall"><strong>6. DIP без Service Container.</strong> Инжектировать интерфейсы вручную в каждом месте &mdash; boilerplate. Laravel Container делает это автоматически.</div>
    <div class="pitfall"><strong>7. «Я переписал на SOLID, теперь идеально».</strong> Дизайн эволюционирует. Не бойтесь рефакторить.</div>
    <div class="pitfall"><strong>8. SOLID как аргумент в code review.</strong> «Здесь не SOLID» &mdash; слабо. Конкретная проблема (трудно тестировать, дублирование) &mdash; сильно.</div>
  </div>
</div>

<div id="sec-grasp" class="section">
  <div class="section-title">GRASP, DRY, KISS, YAGNI</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Дополнительные эвристики. GRASP (General Responsibility Assignment Software Patterns) &mdash; более общие принципы распределения ответственности (Крэг Ларман). DRY, KISS, YAGNI &mdash; короткие правила-якоря для повседневных решений.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Ключевые принципы</div>

    <div class="card"><h3>DRY &mdash; Don't Repeat Yourself</h3><p class="text">Каждый кусок <strong>знания</strong> имеет одно представление. Знание, не код: одинаково выглядящие фрагменты по разным причинам &mdash; не DRY-нарушение. Преждевременная унификация &mdash; типичная ошибка.</p></div>
    <div class="card"><h3>KISS &mdash; Keep It Simple, Stupid</h3><p class="text">Простое решение &mdash; лучшее, при прочих равных. Один класс на 100 строк часто проще пяти классов по 20 строк со связями.</p></div>
    <div class="card"><h3>YAGNI &mdash; You Aren't Gonna Need It</h3><p class="text">Не пишите функциональность «на будущее». 80% такого кода никогда не используется. Добавляйте абстракцию при третьем случае (rule of three), не первом.</p></div>
    <div class="card"><h3>GRASP: Information Expert</h3><p class="text">Ответственность принадлежит классу с большим количеством информации. Расчёт суммы заказа &mdash; в Order, не в OrderController.</p></div>
    <div class="card"><h3>GRASP: Low Coupling, High Cohesion</h3><p class="text"><strong>Coupling</strong> &mdash; зависимость одного модуля от другого, должна быть низкой. <strong>Cohesion</strong> &mdash; связность элементов внутри модуля, должна быть высокой.</p></div>
    <div class="card"><h3>GRASP: Controller</h3><p class="text">Объект, обрабатывающий system event. В Laravel это контроллеры. Не путать с GoF Controller. Должен быть тонким.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> DRY vs YAGNI</div>
<pre><code><span class="c-comment">// Два метода, похожих на 90%, разная семантика</span>
<span class="c-key">public function</span> <span class="c-fn">calculateOrderTax</span>(<span class="c-type">Order</span> <span class="c-var">$order</span>): <span class="c-key">int</span> {
    <span class="c-key">return</span> (<span class="c-key">int</span>) (<span class="c-var">$order</span>-&gt;<span class="c-var">total</span> * <span class="c-num">0.12</span>);
}
<span class="c-key">public function</span> <span class="c-fn">calculateRefundTax</span>(<span class="c-type">Refund</span> <span class="c-var">$refund</span>): <span class="c-key">int</span> {
    <span class="c-key">return</span> (<span class="c-key">int</span>) (<span class="c-var">$refund</span>-&gt;<span class="c-var">total</span> * <span class="c-num">0.12</span>);
}

<span class="c-comment">// ❌ Преждевременное DRY: единая абстракция.
// Если правила для refund изменятся (другие ставки) — придётся ломать.</span>
<span class="c-key">public function</span> <span class="c-fn">calculateTax</span>(<span class="c-key">int</span> <span class="c-var">$amount</span>): <span class="c-key">int</span> {
    <span class="c-key">return</span> (<span class="c-key">int</span>) (<span class="c-var">$amount</span> * <span class="c-num">0.12</span>);
}

<span class="c-comment">// ✓ KISS / YAGNI: оставить два метода до третьего случая.
// Эволюция: дублирование → паттерн → абстракция.</span>
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. DRY ради DRY.</strong> Объединение двух похожих фрагментов под одной абстракцией, когда требования эволюционируют по-разному &mdash; ломает оба.</div>
    <div class="pitfall"><strong>2. KISS как отказ от абстракций.</strong> «Просто &mdash; значит без интерфейсов» &mdash; неправильно. Простое не равно примитивному.</div>
    <div class="pitfall"><strong>3. YAGNI на инфраструктуре.</strong> «Логирование &mdash; YAGNI» &mdash; пока инцидент не случился. Инфраструктурные вещи почти никогда не YAGNI.</div>
    <div class="pitfall"><strong>4. Premature optimization.</strong> «Эта функция должна быть быстрой» без замера &mdash; источник нечитаемого кода.</div>
    <div class="pitfall"><strong>5. Cohesion vs Coupling неверно.</strong> Одна гигантская функция &mdash; не «высокая когезия». Когезия о смысле, не о близости в файле.</div>
    <div class="pitfall"><strong>6. «Используй паттерн X».</strong> Без проблемы &mdash; cargo cult.</div>
    <div class="pitfall"><strong>7. Игнор «Rule of three».</strong> Первое дублирование &mdash; OK. Второе &mdash; подозрительно. Третье &mdash; абстракция.</div>
    <div class="pitfall"><strong>8. KISS для senior vs junior.</strong> Простое для senior может быть непонятным для junior. Учитывайте уровень команды.</div>
  </div>
</div>

<div id="sec-creational" class="section">
  <div class="section-title">Creational паттерны</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Паттерны создания объектов. Решают «как получить экземпляр», когда простой <code>new</code> не подходит: валидация в конструкторе, выбор класса по параметру, тяжёлая инициализация, кеширование.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Основные</div>

    <div class="card">
      <h3>Factory Method</h3>
      <p class="text">Делегирование создания. <code>NotificationFactory::create('sms')</code> возвращает <code>SmsNotification</code>. Решает: выбор реализации в runtime.</p>
<pre><code><span class="c-key">interface</span> <span class="c-type">Notification</span> { <span class="c-key">public function</span> <span class="c-fn">send</span>(<span class="c-key">string</span> <span class="c-var">$to</span>, <span class="c-key">string</span> <span class="c-var">$text</span>): <span class="c-key">void</span>; }

<span class="c-key">final class</span> <span class="c-type">NotificationFactory</span>
{
    <span class="c-key">public static function</span> <span class="c-fn">create</span>(<span class="c-key">string</span> <span class="c-var">$channel</span>): <span class="c-type">Notification</span>
    {
        <span class="c-key">return match</span> (<span class="c-var">$channel</span>) {
            <span class="c-str">'sms'</span>   =&gt; <span class="c-key">new</span> <span class="c-type">SmsNotification</span>(),
            <span class="c-str">'email'</span> =&gt; <span class="c-key">new</span> <span class="c-type">EmailNotification</span>(),
            <span class="c-str">'push'</span>  =&gt; <span class="c-key">new</span> <span class="c-type">PushNotification</span>(),
            <span class="c-key">default</span> =&gt; <span class="c-key">throw new</span> <span class="c-type">InvalidArgumentException</span>(<span class="c-str">"Unknown: {$channel}"</span>),
        };
    }
}
</code></pre>
    </div>

    <div class="card"><h3>Abstract Factory</h3><p class="text">Семейство связанных фабрик. В backend применяется реже.</p></div>
    <div class="card"><h3>Builder</h3><p class="text">Пошаговое построение сложного объекта. Eloquent Query Builder &mdash; классика: <code>User::where(...)-&gt;orderBy(...)-&gt;limit(10)-&gt;get()</code>.</p></div>
    <div class="card"><h3>Singleton</h3><p class="text">В Laravel &mdash; через Service Container (<code>$app-&gt;singleton(...)</code>), не ручная реализация. Прямой Singleton &mdash; антипаттерн: hidden dependency, проблемы с тестами.</p></div>
    <div class="card"><h3>Prototype</h3><p class="text">Создание клонированием. PHP имеет <code>clone</code> и <code>__clone</code>. Полезно когда создание with-scratch дорого.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Static factory без причины.</strong> <code>UserFactory::create($data)</code> вместо <code>new User($data)</code> &mdash; лишний indirection.</div>
    <div class="pitfall"><strong>2. Singleton-антипаттерн.</strong> Прямой <code>getInstance()</code> &mdash; глобальные скрытые зависимости. Service Container.</div>
    <div class="pitfall"><strong>3. Builder с обязательными полями.</strong> Обязательные &mdash; в конструктор, опциональные &mdash; через with-методы.</div>
    <div class="pitfall"><strong>4. <code>__clone</code> и shallow copy.</strong> По умолчанию вложенные объекты shared. Deep clone &mdash; явно через <code>__clone</code>.</div>
    <div class="pitfall"><strong>5. Factory без default.</strong> Закрытый match без default &mdash; нельзя расширить без правки factory.</div>
    <div class="pitfall"><strong>6. Factory вместо контейнера.</strong> Если зависимости разрешаются через DI, factory избыточен.</div>
    <div class="pitfall"><strong>7. Builder, мутирующий self.</strong> Запутывает. Лучше immutable: каждый with возвращает новый instance.</div>
    <div class="pitfall"><strong>8. Static-методы как factory в моделях.</strong> Eloquent <code>Model::create</code>, <code>::firstOrCreate</code> &mdash; валидно в контексте ORM.</div>
  </div>
</div>

<div id="sec-structural" class="section">
  <div class="section-title">Structural паттерны</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Большие структуры из меньших объектов. Adapter &mdash; согласовать несовместимые интерфейсы; Decorator &mdash; добавить функциональность не меняя класс; Facade &mdash; упростить сложный API.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Основные</div>

    <div class="card">
      <h3>Adapter</h3>
      <p class="text">Оборачивает чужой класс под собственный интерфейс. Обёртка вокруг внешнего SDK (Stripe SDK → наш PaymentGateway). Позволяет заменить SDK без переписывания основного кода.</p>
<pre><code><span class="c-key">interface</span> <span class="c-type">PaymentGateway</span> {
    <span class="c-key">public function</span> <span class="c-fn">charge</span>(<span class="c-key">int</span> <span class="c-var">$amount</span>, <span class="c-key">string</span> <span class="c-var">$currency</span>): <span class="c-key">string</span>;
}

<span class="c-key">final class</span> <span class="c-type">StripeAdapter</span> <span class="c-key">implements</span> <span class="c-type">PaymentGateway</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private</span> <span class="c-type">StripeClient</span> <span class="c-var">$client</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">charge</span>(<span class="c-key">int</span> <span class="c-var">$amount</span>, <span class="c-key">string</span> <span class="c-var">$currency</span>): <span class="c-key">string</span>
    {
        <span class="c-var">$intent</span> = <span class="c-var">$this</span>-&gt;<span class="c-var">client</span>-&gt;<span class="c-var">paymentIntents</span>-&gt;<span class="c-fn">create</span>([
            <span class="c-str">'amount'</span> =&gt; <span class="c-var">$amount</span>, <span class="c-str">'currency'</span> =&gt; <span class="c-var">$currency</span>,
        ]);
        <span class="c-key">return</span> <span class="c-var">$intent</span>-&gt;<span class="c-var">id</span>;
    }
}
</code></pre>
    </div>

    <div class="card"><h3>Decorator</h3><p class="text">Добавляет поведение, оборачивая объект. <code>CachingPaymentGateway</code> декорирует обычный кешем. Composable: можно цеплять цепочкой.</p></div>
    <div class="card"><h3>Facade</h3><p class="text">Простой интерфейс к сложной подсистеме. Laravel-фасады &mdash; буквально этот паттерн (хотя реализованы через Service Container). <code>Cache::get()</code> прячет драйвер, репозиторий, конфиг.</p></div>
    <div class="card"><h3>Proxy</h3><p class="text">Заместитель реального объекта. Виды: virtual (ленивая инициализация), protection (проверка прав), remote (удалённый доступ). Eloquent lazy-loaded relations &mdash; virtual proxy.</p></div>
    <div class="card"><h3>Composite</h3><p class="text">Деревья объектов с единым интерфейсом для листа и узла. Меню сайта (пункт vs группа) &mdash; типичный пример.</p></div>
    <div class="card"><h3>Bridge</h3><p class="text">Разделение абстракции и реализации в две иерархии. Редко в обычном backend.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Adapter «потому что красиво».</strong> Если SDK уже имеет удобный API &mdash; обёртка только индирекция.</div>
    <div class="pitfall"><strong>2. Decorator поверх несовместимого интерфейса.</strong> Должен реализовать тот же интерфейс. Иначе это обёртка.</div>
    <div class="pitfall"><strong>3. Facade, скрывающий критичные детали.</strong> Если прячет timeout, retry &mdash; пользователь не сможет настроить.</div>
    <div class="pitfall"><strong>4. Глубокая цепочка декораторов.</strong> 5 декораторов вокруг одного объекта &mdash; трудно дебагать.</div>
    <div class="pitfall"><strong>5. Eager proxy.</strong> Proxy, сразу загружающий данные &mdash; не proxy.</div>
    <div class="pitfall"><strong>6. Composite на одноуровневой структуре.</strong> Нет вложенности &mdash; зачем абстракция?</div>
    <div class="pitfall"><strong>7. Bridge как «правильный».</strong> Bridge оправдан на 1-2% случаев.</div>
    <div class="pitfall"><strong>8. Facade как god class.</strong> Facade с 50 методами &mdash; делите по доменам.</div>
  </div>
</div>

<div id="sec-behavioral" class="section">
  <div class="section-title">Behavioral паттерны</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Взаимодействие между объектами. Strategy &mdash; подмена алгоритма; Observer &mdash; уведомление подписчиков; Command &mdash; инкапсуляция действия; Template Method &mdash; скелет с переопределяемыми шагами.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Основные</div>
    <div class="card"><h3>Strategy</h3><p class="text">Семейство взаимозаменяемых алгоритмов. <code>OrderShipper</code> принимает <code>ShippingStrategy</code> (DHL, FedEx, Local). Replace switch &rarr; объекты.</p></div>
    <div class="card"><h3>Observer</h3><p class="text">Один объект уведомляет N подписчиков. Laravel Events &amp; Listeners. Eloquent observers &mdash; тоже Observer.</p></div>
    <div class="card"><h3>Command</h3><p class="text">Действие как объект. <code>CreateOrderCommand</code>. Удобно для undo/redo, очередей (Laravel Job &mdash; это Command).</p></div>
    <div class="card"><h3>Template Method</h3><p class="text">Абстрактный класс задаёт скелет; подклассы переопределяют шаги. <code>ImportFile</code> с <code>parse/validate/save</code> &mdash; конкретные импортёры переопределяют parse.</p></div>
    <div class="card"><h3>Chain of Responsibility</h3><p class="text">Цепочка обработчиков; запрос проходит, пока один не обработает. Laravel middleware &mdash; чистый пример.</p></div>
    <div class="card"><h3>State</h3><p class="text">Объект меняет поведение в зависимости от состояния. <code>Order</code> в Pending разрешает cancel, в Paid &mdash; нет. Через классы-состояния.</p></div>
    <div class="card"><h3>Mediator</h3><p class="text">Объект-координатор между компонентами. В backend реже; популярен в UI.</p></div>
    <div class="card"><h3>Visitor</h3><p class="text">Отделяет алгоритм от структуры данных. Сложный, редко в PHP &mdash; double dispatch не PHP-friendly.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: Strategy вместо switch</div>
<pre><code><span class="c-comment">// ❌ Switch на тип — нарушение Open/Closed</span>
<span class="c-key">public function</span> <span class="c-fn">ship</span>(<span class="c-type">Order</span> <span class="c-var">$order</span>, <span class="c-key">string</span> <span class="c-var">$carrier</span>): <span class="c-key">string</span>
{
    <span class="c-key">return match</span> (<span class="c-var">$carrier</span>) {
        <span class="c-str">'dhl'</span>   =&gt; <span class="c-var">$this</span>-&gt;<span class="c-fn">shipViaDHL</span>(<span class="c-var">$order</span>),
        <span class="c-str">'fedex'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-fn">shipViaFedEx</span>(<span class="c-var">$order</span>),
        <span class="c-str">'local'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-fn">shipViaLocal</span>(<span class="c-var">$order</span>),
    };
}

<span class="c-comment">// ✓ Strategy</span>
<span class="c-key">interface</span> <span class="c-type">ShippingStrategy</span> { <span class="c-key">public function</span> <span class="c-fn">ship</span>(<span class="c-type">Order</span> <span class="c-var">$o</span>): <span class="c-key">string</span>; }
<span class="c-key">final class</span> <span class="c-type">DhlStrategy</span>   <span class="c-key">implements</span> <span class="c-type">ShippingStrategy</span> { ... }
<span class="c-key">final class</span> <span class="c-type">FedExStrategy</span> <span class="c-key">implements</span> <span class="c-type">ShippingStrategy</span> { ... }

<span class="c-key">final class</span> <span class="c-type">OrderShipper</span>
{
    <span class="c-key">public function</span> <span class="c-fn">ship</span>(<span class="c-type">Order</span> <span class="c-var">$o</span>, <span class="c-type">ShippingStrategy</span> <span class="c-var">$s</span>): <span class="c-key">string</span>
    { <span class="c-key">return</span> <span class="c-var">$s</span>-&gt;<span class="c-fn">ship</span>(<span class="c-var">$o</span>); }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Strategy на 2 случая.</strong> Перебор. Используйте простой if/match.</div>
    <div class="pitfall"><strong>2. Observer без unsubscribe.</strong> Listeners накапливаются. В Laravel-FPM не проблема, в Octane &mdash; критично.</div>
    <div class="pitfall"><strong>3. Command, дублирующий метод.</strong> Если есть <code>OrderService::cancel($id)</code>, а Command просто его вызывает &mdash; нет смысла.</div>
    <div class="pitfall"><strong>4. Template Method с 10 hooks.</strong> Запутанная иерархия. Лучше Strategy + Composition.</div>
    <div class="pitfall"><strong>5. Chain без явного конца.</strong> Если никто не обработал &mdash; что произошло? Default-обработчик или явная ошибка.</div>
    <div class="pitfall"><strong>6. State через if.</strong> Большой <code>if ($status === 'pending' && !$paid)</code> &mdash; запах. Извлеките в классы.</div>
    <div class="pitfall"><strong>7. Mediator с раздутой ответственностью.</strong> Mediator всех событий &mdash; god object.</div>
    <div class="pitfall"><strong>8. Observer вместо явного вызова.</strong> Если один listener и так будет всегда &mdash; прямой вызов читается лучше.</div>
  </div>
</div>

<div id="sec-repository" class="section">
  <div class="section-title">Repository</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Repository &mdash; абстракция хранилища: «дай мне сущность по критериям». Скрывает детали БД от бизнес-логики. В DDD &mdash; обязательный паттерн. В Laravel &mdash; спорный, поскольку Eloquent уже реализует Active Record + Query Builder.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Repository в Laravel: за и против</div>
    <table class="data-table">
      <tr><th>За</th><th>Против</th></tr>
      <tr><td>Изоляция бизнес-логики от Eloquent</td><td>Eloquent уже &mdash; абстракция над PDO</td></tr>
      <tr><td>Подмена реализации в тестах</td><td><code>Model::factory()</code> + <code>RefreshDatabase</code> делает то же</td></tr>
      <tr><td>Единая точка для сложных запросов</td><td>Eloquent scopes</td></tr>
      <tr><td>Готовность к смене ORM</td><td>Смена ORM &mdash; редкое событие; YAGNI</td></tr>
      <tr><td>Чистая архитектура (Hexagonal)</td><td>Для большинства проектов overkill</td></tr>
    </table>
    <p class="text">Практический критерий: если в проекте сложный домен (DDD) или multiple data sources &mdash; Repository оправдан. В обычном CRUD &mdash; антипаттерн.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: интерфейс + Eloquent-реализация</div>
<pre><code><span class="c-comment">// Интерфейс — что нужно бизнес-логике</span>
<span class="c-key">interface</span> <span class="c-type">OrderRepository</span>
{
    <span class="c-key">public function</span> <span class="c-fn">find</span>(<span class="c-key">int</span> <span class="c-var">$id</span>): <span class="c-key">?</span><span class="c-type">Order</span>;
    <span class="c-key">public function</span> <span class="c-fn">save</span>(<span class="c-type">Order</span> <span class="c-var">$order</span>): <span class="c-key">void</span>;
    <span class="c-key">public function</span> <span class="c-fn">findUnpaidOlderThan</span>(<span class="c-type">Carbon</span> <span class="c-var">$date</span>): <span class="c-type">Collection</span>;
}

<span class="c-comment">// Eloquent-реализация</span>
<span class="c-key">final class</span> <span class="c-type">EloquentOrderRepository</span> <span class="c-key">implements</span> <span class="c-type">OrderRepository</span>
{
    <span class="c-key">public function</span> <span class="c-fn">find</span>(<span class="c-key">int</span> <span class="c-var">$id</span>): <span class="c-key">?</span><span class="c-type">Order</span>
    { <span class="c-key">return</span> <span class="c-type">Order</span>::<span class="c-fn">find</span>(<span class="c-var">$id</span>); }

    <span class="c-key">public function</span> <span class="c-fn">save</span>(<span class="c-type">Order</span> <span class="c-var">$order</span>): <span class="c-key">void</span>
    { <span class="c-var">$order</span>-&gt;<span class="c-fn">save</span>(); }

    <span class="c-key">public function</span> <span class="c-fn">findUnpaidOlderThan</span>(<span class="c-type">Carbon</span> <span class="c-var">$date</span>): <span class="c-type">Collection</span>
    {
        <span class="c-key">return</span> <span class="c-type">Order</span>::<span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'pending'</span>)
            -&gt;<span class="c-fn">where</span>(<span class="c-str">'created_at'</span>, <span class="c-str">'&lt;'</span>, <span class="c-var">$date</span>)-&gt;<span class="c-fn">get</span>();
    }
}

<span class="c-comment">// Bind в Service Provider</span>
<span class="c-var">$this</span>-&gt;<span class="c-fn">app</span>-&gt;<span class="c-fn">bind</span>(<span class="c-type">OrderRepository</span>::<span class="c-key">class</span>, <span class="c-type">EloquentOrderRepository</span>::<span class="c-key">class</span>);
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Repository, дублирующий Eloquent.</strong> Тонкие обёртки &mdash; лучше Model напрямую.</div>
    <div class="pitfall"><strong>2. Generic Repository&lt;T&gt;.</strong> Универсальный CRUD-Repository &mdash; антипаттерн. Repository должен отражать domain-specific нужды.</div>
    <div class="pitfall"><strong>3. Repository, возвращающий Eloquent.</strong> Абстракция протекает. Хочется &mdash; pure entities или DTO.</div>
    <div class="pitfall"><strong>4. Repository с pagination.</strong> Ломает абстракцию. Лучше отдельный Specification/Query-object.</div>
    <div class="pitfall"><strong>5. Repository в простом CRUD.</strong> Излишество.</div>
    <div class="pitfall"><strong>6. Тесты через мок Repository.</strong> Часто &mdash; антипаттерн. Используйте in-memory implementation.</div>
    <div class="pitfall"><strong>7. Repository без транзакций.</strong> Transaction boundary &mdash; это Service, не Repository.</div>
    <div class="pitfall"><strong>8. Action как репозиторий.</strong> Action оркестрирует Repository, не должен быть БД-кодом.</div>
  </div>
</div>

<div id="sec-service" class="section">
  <div class="section-title">Service Layer + DTO</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Service Layer &mdash; место бизнес-логики. Контроллер тонкий; Service делает оркестрацию между Repositories, внешними API, событиями. DTO &mdash; неизменяемая структура для передачи данных между слоями.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Структура</div>
    <div class="card"><h3>Action vs Service</h3><p class="text">Action (Single-Action Class) &mdash; класс с одним публичным методом (<code>CreateOrder::__invoke()</code>). Service &mdash; класс с несколькими методами вокруг одной области. Action удобнее для тестирования.</p></div>
    <div class="card"><h3>DTO &mdash; иммутабельные структуры</h3><p class="text">Простой класс с публичными свойствами + конструктор. Никакого поведения. Передаёт валидированные данные от Controller к Action.</p></div>
    <div class="card"><h3>Form Request → DTO → Action</h3><p class="text">Поток: HTTP → FormRequest валидирует → собираем DTO → передаём в Action. Action возвращает результат → Resource в ответ.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика</div>
<pre><code><span class="c-comment">// DTO</span>
<span class="c-key">final class</span> <span class="c-type">CreateOrderData</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">public readonly int</span>    <span class="c-var">$userId</span>,
        <span class="c-key">public readonly array</span>  <span class="c-var">$items</span>,
        <span class="c-key">public readonly string</span> <span class="c-var">$currency</span>,
    ) {}

    <span class="c-key">public static function</span> <span class="c-fn">fromRequest</span>(<span class="c-type">StoreOrderRequest</span> <span class="c-var">$r</span>): <span class="c-key">self</span>
    {
        <span class="c-key">return new</span> <span class="c-key">self</span>(
            userId:   <span class="c-var">$r</span>-&gt;<span class="c-fn">user</span>()-&gt;<span class="c-var">id</span>,
            items:    <span class="c-var">$r</span>-&gt;<span class="c-fn">input</span>(<span class="c-str">'items'</span>),
            currency: <span class="c-var">$r</span>-&gt;<span class="c-fn">string</span>(<span class="c-str">'currency'</span>)-&gt;<span class="c-fn">value</span>(),
        );
    }
}

<span class="c-comment">// Action</span>
<span class="c-key">final class</span> <span class="c-type">CreateOrder</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private</span> <span class="c-type">OrderRepository</span> <span class="c-var">$orders</span>,
        <span class="c-key">private</span> <span class="c-type">PaymentGateway</span>  <span class="c-var">$gateway</span>,
    ) {}

    <span class="c-key">public function</span> <span class="c-fn">__invoke</span>(<span class="c-type">CreateOrderData</span> <span class="c-var">$data</span>): <span class="c-type">Order</span>
    {
        <span class="c-key">return</span> <span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$data</span>) {
            <span class="c-var">$order</span> = <span class="c-key">new</span> <span class="c-type">Order</span>([...]);
            <span class="c-var">$this</span>-&gt;<span class="c-var">orders</span>-&gt;<span class="c-fn">save</span>(<span class="c-var">$order</span>);
            <span class="c-var">$this</span>-&gt;<span class="c-var">gateway</span>-&gt;<span class="c-fn">charge</span>(<span class="c-var">$order</span>-&gt;<span class="c-var">total</span>, <span class="c-var">$data</span>-&gt;<span class="c-var">currency</span>);
            <span class="c-key">return</span> <span class="c-var">$order</span>;
        });
    }
}

<span class="c-comment">// Controller — тонкий</span>
<span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">StoreOrderRequest</span> <span class="c-var">$r</span>, <span class="c-type">CreateOrder</span> <span class="c-var">$action</span>): <span class="c-type">JsonResponse</span>
{
    <span class="c-var">$order</span> = <span class="c-var">$action</span>(<span class="c-type">CreateOrderData</span>::<span class="c-fn">fromRequest</span>(<span class="c-var">$r</span>));
    <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>(<span class="c-key">new</span> <span class="c-type">OrderResource</span>(<span class="c-var">$order</span>), <span class="c-num">201</span>);
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Service с 30 методами.</strong> God-сервис. Делите по сущностям или операциям.</div>
    <div class="pitfall"><strong>2. DTO с публичными сеттерами.</strong> Mutable DTO теряет смысл. Используйте <code>readonly</code> (PHP 8.1+).</div>
    <div class="pitfall"><strong>3. DTO с бизнес-логикой.</strong> <code>calculateDiscount()</code> в DTO &mdash; это уже не DTO.</div>
    <div class="pitfall"><strong>4. Массивы вместо DTO.</strong> Нетипизированный, легко передать неправильное.</div>
    <div class="pitfall"><strong>5. Action, вызывающий другие Action.</strong> Через DI &mdash; OK. Через <code>new</code> &mdash; нарушение DI.</div>
    <div class="pitfall"><strong>6. Transaction в Controller.</strong> Транзакция внутри Action, не Controller.</div>
    <div class="pitfall"><strong>7. Возврат Eloquent из Action.</strong> OK для веба, плохо для библиотек.</div>
    <div class="pitfall"><strong>8. Action без DI.</strong> Прямой <code>new ServiceA</code> &mdash; не подменить в тестах.</div>
  </div>
</div>

<div id="sec-ddd" class="section">
  <div class="section-title">DDD &mdash; тактический уровень</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Domain-Driven Design (Эрик Эванс, 2003). Стратегический DDD &mdash; о структуре больших систем (Bounded Context). Тактический &mdash; о шаблонах внутри одного контекста: Entity, Value Object, Aggregate, Domain Service, Repository, Domain Event.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Building blocks</div>

    <div class="card"><h3>Entity</h3><p class="text">Объект с идентичностью. Два <code>User</code> с одинаковыми именами &mdash; разные сущности при разных id. Идентичность сохраняется через жизнь объекта.</p></div>

    <div class="card">
      <h3>Value Object</h3>
      <p class="text">Без идентичности, определяется только значениями. <code>Money(100, USD)</code> и другой <code>Money(100, USD)</code> &mdash; эквивалентны. Иммутабелен.</p>
<pre><code><span class="c-key">final class</span> <span class="c-type">Money</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">public readonly int</span>    <span class="c-var">$amountMinor</span>,
        <span class="c-key">public readonly string</span> <span class="c-var">$currency</span>,
    ) {
        <span class="c-key">if</span> (<span class="c-var">$amountMinor</span> &lt; <span class="c-num">0</span>) <span class="c-key">throw new</span> <span class="c-type">InvalidArgumentException</span>(<span class="c-str">'Negative'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">add</span>(<span class="c-type">Money</span> <span class="c-var">$other</span>): <span class="c-key">self</span>
    {
        <span class="c-key">if</span> (<span class="c-var">$other</span>-&gt;<span class="c-var">currency</span> !== <span class="c-var">$this</span>-&gt;<span class="c-var">currency</span>) {
            <span class="c-key">throw new</span> <span class="c-type">CurrencyMismatchException</span>();
        }
        <span class="c-key">return new</span> <span class="c-key">self</span>(<span class="c-var">$this</span>-&gt;<span class="c-var">amountMinor</span> + <span class="c-var">$other</span>-&gt;<span class="c-var">amountMinor</span>, <span class="c-var">$this</span>-&gt;<span class="c-var">currency</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">equals</span>(<span class="c-type">Money</span> <span class="c-var">$other</span>): <span class="c-key">bool</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-var">amountMinor</span> === <span class="c-var">$other</span>-&gt;<span class="c-var">amountMinor</span>
            &amp;&amp; <span class="c-var">$this</span>-&gt;<span class="c-var">currency</span> === <span class="c-var">$other</span>-&gt;<span class="c-var">currency</span>;
    }
}
</code></pre>
    </div>

    <div class="card"><h3>Aggregate</h3><p class="text">Группа Entity и VO, единое целое. Aggregate Root &mdash; единственная точка доступа извне. <code>Order</code> &mdash; root, <code>OrderItem</code> &mdash; часть aggregate. Все изменения &mdash; через Order.</p></div>
    <div class="card"><h3>Domain Service</h3><p class="text">Логика, не принадлежащая одной сущности. <code>CurrencyConverter</code> работает с Money разных валют, но не &laquo;принадлежит&raquo; одной.</p></div>
    <div class="card"><h3>Domain Event</h3><p class="text">Факт, произошедший в домене. <code>OrderPaid</code>. Эмитится из Aggregate, обрабатывается асинхронно. В Laravel &mdash; Events &amp; Listeners.</p></div>
    <div class="card"><h3>Ubiquitous Language</h3><p class="text">Единый язык между бизнесом и разработчиками. <code>Customer</code> вместо <code>UserRow</code>; <code>activate()</code> вместо <code>setStatusActive()</code>.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. DDD на простом CRUD.</strong> Aggregate, VO, Repository вокруг Categories &mdash; overkill. DDD оправдан на сложных доменах.</div>
    <div class="pitfall"><strong>2. Eloquent как Entity.</strong> Смешивает данные и persistence. Чистый DDD требует отдельных Entity. На практике &mdash; компромисс.</div>
    <div class="pitfall"><strong>3. VO как массив.</strong> <code>['amount' =&gt; 100, 'currency' =&gt; 'USD']</code> вместо <code>Money</code> &mdash; теряете валидацию и type safety.</div>
    <div class="pitfall"><strong>4. Aggregate без границ.</strong> God aggregate &mdash; тяжёлые транзакции. Aggregate должен быть small.</div>
    <div class="pitfall"><strong>5. Cross-aggregate транзакция.</strong> Eventual consistency между aggregate'ами &mdash; через Domain Events.</div>
    <div class="pitfall"><strong>6. Domain Service для всего.</strong> 80% логики в Services &mdash; процедурный код. Логика должна быть в Entity/VO.</div>
    <div class="pitfall"><strong>7. UL для галочки.</strong> Код <code>User</code>, разговоры <code>Member</code> &mdash; UL не работает. Переименовывайте.</div>
    <div class="pitfall"><strong>8. Заимствование терминов из контекстов.</strong> <code>Order</code> в e-commerce и restaurant &mdash; разные вещи. Bounded Context.</div>
  </div>
</div>

<div id="sec-clean" class="section">
  <div class="section-title">Clean Architecture и Hexagonal</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Clean Architecture (Боб Мартин) и Hexagonal (Алистер Кокберн) ставят в центр <strong>бизнес-логику</strong>, изолированную от инфраструктуры. БД, веб, очереди &mdash; детали, легко заменяемые. Цель: код, тестируемый без БД, переносимый между фреймворками.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Слои Clean Architecture</div>
    <div class="card"><h3>1. Entities</h3><p class="text">Доменные сущности с бизнес-правилами. Не зависят ни от чего внешнего.</p></div>
    <div class="card"><h3>2. Use Cases</h3><p class="text">Оркестрация: CreateOrder, CancelOrder. Знают о Entities, не о БД/HTTP.</p></div>
    <div class="card"><h3>3. Interface Adapters</h3><p class="text">Controllers, Presenters, Repositories. Преобразование данных между слоями.</p></div>
    <div class="card"><h3>4. Frameworks &amp; Drivers</h3><p class="text">Laravel, Eloquent, Stripe SDK, Redis. Самый внешний слой.</p></div>
    <div class="card"><h3>Правило зависимости</h3><p class="text">Зависимости направлены <strong>внутрь</strong>. Внутренние слои не знают о внешних.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hexagon"></i> Hexagonal (Ports &amp; Adapters)</div>
    <p class="text">Альтернативный взгляд: центр &mdash; домен; снаружи &mdash; адаптеры через порты (интерфейсы). Каждое внешнее взаимодействие &mdash; отдельный port + adapter. Терминологически проще Clean Architecture, идея та же.</p>

<pre><code><span class="c-comment">// Port — интерфейс, определённый доменом</span>
<span class="c-key">interface</span> <span class="c-type">OrderRepository</span> { <span class="c-comment">// в src/Domain/</span>
    <span class="c-key">public function</span> <span class="c-fn">save</span>(<span class="c-type">Order</span> <span class="c-var">$order</span>): <span class="c-key">void</span>;
}

<span class="c-comment">// Adapter — реализация во внешнем слое</span>
<span class="c-key">final class</span> <span class="c-type">EloquentOrderRepository</span> <span class="c-key">implements</span> <span class="c-type">OrderRepository</span>
{ <span class="c-comment">// в src/Infrastructure/Persistence/</span>
    <span class="c-key">public function</span> <span class="c-fn">save</span>(<span class="c-type">Order</span> <span class="c-var">$order</span>): <span class="c-key">void</span> { ... }
}

<span class="c-comment">// Use Case зависит только от Port (инверсия зависимости)</span>
<span class="c-key">final class</span> <span class="c-type">CreateOrder</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private</span> <span class="c-type">OrderRepository</span> <span class="c-var">$repo</span>) {}
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Clean на маленьком проекте.</strong> 4 слоя для CRUD-приложения &mdash; убийца производительности команды.</div>
    <div class="pitfall"><strong>2. Eloquent внутри Entity.</strong> Если Entity наследует Model &mdash; нарушение правила зависимостей.</div>
    <div class="pitfall"><strong>3. Заимствование структуры папок.</strong> <code>Domain/</code>, <code>Application/</code> без следования правилу &mdash; ярлыки.</div>
    <div class="pitfall"><strong>4. Транзакции в Use Case.</strong> Use Case не должен знать про БД-транзакции. В Laravel часто компромисс.</div>
    <div class="pitfall"><strong>5. Слишком много DTO.</strong> Преобразование между слоями через 3-4 копии данных &mdash; лишняя работа.</div>
    <div class="pitfall"><strong>6. Тестирование Use Case моками.</strong> Use Case с 5 моков &mdash; тест проверяет реализацию. Используйте in-memory implementations.</div>
    <div class="pitfall"><strong>7. Hexagonal без портов.</strong> «У нас Hexagonal» &mdash; но интерфейсы Repository отсутствуют. Это не Hexagonal.</div>
    <div class="pitfall"><strong>8. Postel's Law нарушение.</strong> Принимать строгие типы, возвращать лояльные. Часто наоборот &mdash; контракт асимметричен.</div>
  </div>
</div>

<div id="sec-outbox" class="section">
  <div class="section-title">Transactional Outbox — надёжная публикация событий</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Проблема: dual-write (двойная запись)</div>
    <p class="text">Классический сценарий в микросервисах: сервис заказов должен <em>одновременно</em>:</p>
    <ul style="margin:8px 0 14px 22px;color:var(--text2);font-size:13px;line-height:1.85">
      <li>Сохранить заказ в свою БД (<code>orders</code>).</li>
      <li>Опубликовать событие <code>OrderCreated</code> в брокер (Kafka / RabbitMQ / SNS).</li>
    </ul>
    <p class="text">Это <strong>две разные системы</strong>. Атомарной транзакции между ними не бывает без сложных протоколов вроде 2PC. Значит возможны рассогласованные состояния:</p>

    <table class="data-table">
      <tr><th>Что произошло</th><th>Последствие</th></tr>
      <tr><td>Заказ сохранён ✅, событие <em>не</em> отправлено ❌ (упал брокер / сеть)</td><td>Другие сервисы никогда не узнают о заказе. Оплата не спишется, склад не зарезервирует, письмо не уйдёт.</td></tr>
      <tr><td>Событие отправлено ✅, транзакция откачена ❌ (упал SQL после публикации)</td><td>Downstream начнёт обрабатывать <em>несуществующий</em> заказ — грязные данные в других сервисах.</td></tr>
    </table>

    <div class="pitfall"><strong>Наивное «решение», которое НЕ работает:</strong> <code>DB::transaction(fn () => { $order-&gt;save(); Kafka::publish(...); });</code>. Publish не в БД — <code>rollback</code> Laravel не откатит уже отправленное сообщение. Аналогично «сначала опубликую, потом сохраню» — брокер не откатывается по сигналу приложения.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="lightbulb"></i> Решение: паттерн Transactional Outbox</div>
    <p class="text">Идея: <strong>перенести публикацию в БД</strong>. В той же транзакции, что сохраняет заказ, пишем ещё одну строку — в служебную таблицу <code>outbox</code>. Отдельный процесс (<em>relay</em>) читает outbox и публикует события в брокер уже вне транзакции.</p>

    <div class="diagram">┌─────────────────────────────────────────────────┐
│   Сервис заказов (одна транзакция БД)           │
│                                                 │
│  BEGIN                                          │
│    INSERT INTO orders   (id, total, ...)  ✅    │
│    INSERT INTO outbox   (event_type,            │
│                          payload, ...)     ✅    │
│  COMMIT                                         │
│                                                 │
└──────────┬──────────────────────────────────────┘
           │  (данные и событие сохранены атомарно)
           ▼
   ┌───────────────────┐
   │  Relay worker     │  постоянно опрашивает outbox
   │  (отдельный       │  WHERE published_at IS NULL
   │   процесс)        │  FOR UPDATE SKIP LOCKED
   └────────┬──────────┘
            │  publish
            ▼
   ┌───────────────────┐
   │  Broker           │  Kafka / RabbitMQ / SNS
   │  (Kafka/RMQ/...)  │
   └───────────────────┘
            │  успех → UPDATE outbox SET published_at = now()
            ▼
     downstream сервисы</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list-ordered"></i> Шаги паттерна</div>
    <ol style="margin:8px 0 14px 22px;color:var(--text2);font-size:13px;line-height:1.85">
      <li><strong>BEGIN</strong> транзакции БД.</li>
      <li><strong>Сохранение бизнес-данных.</strong> <code>INSERT INTO orders ...</code></li>
      <li><strong>Сохранение события в outbox.</strong> <code>INSERT INTO outbox (event_type, payload_json, aggregate_id, created_at)</code>.</li>
      <li><strong>COMMIT.</strong> Либо всё сохранилось, либо ничего — атомарно.</li>
      <li><strong>Relay-процесс</strong> опрашивает outbox, забирает не-отправленные события.</li>
      <li><strong>Publish в брокер.</strong> Успешно → пометить <code>published_at = now()</code> (или удалить строку). Неуспешно → оставить как есть, следующий цикл повторит.</li>
    </ol>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> Схема таблицы outbox</div>
<pre><code><span class="c-key">CREATE TABLE</span> <span class="c-type">outbox</span> (
    <span class="c-var">id</span>            <span class="c-type">BIGSERIAL PRIMARY KEY</span>,
    <span class="c-var">aggregate_type</span> <span class="c-type">VARCHAR(64)</span>  <span class="c-key">NOT NULL</span>,   <span class="c-comment">-- 'Order', 'Payment', ...</span>
    <span class="c-var">aggregate_id</span>   <span class="c-type">VARCHAR(64)</span>  <span class="c-key">NOT NULL</span>,   <span class="c-comment">-- для routing и порядка</span>
    <span class="c-var">event_type</span>     <span class="c-type">VARCHAR(64)</span>  <span class="c-key">NOT NULL</span>,   <span class="c-comment">-- 'OrderCreated', 'OrderPaid'</span>
    <span class="c-var">payload</span>        <span class="c-type">JSONB</span>        <span class="c-key">NOT NULL</span>,   <span class="c-comment">-- сериализованное событие</span>
    <span class="c-var">created_at</span>     <span class="c-type">TIMESTAMPTZ</span>  <span class="c-key">NOT NULL DEFAULT</span> <span class="c-fn">now</span>(),
    <span class="c-var">published_at</span>   <span class="c-type">TIMESTAMPTZ</span>  <span class="c-key">NULL</span>              <span class="c-comment">-- NULL = ещё не отправлено</span>
);

<span class="c-comment">-- Индекс для быстрого поиска не-отправленных</span>
<span class="c-key">CREATE INDEX</span> <span class="c-key">ON</span> <span class="c-type">outbox</span> (<span class="c-var">created_at</span>) <span class="c-key">WHERE</span> <span class="c-var">published_at</span> <span class="c-key">IS NULL</span>;</code></pre>
    <p class="text">Индекс <em>частичный</em> — по «горячей» части (не-опубликованные): выборка воркера всегда быстрая, даже когда в таблице миллион старых записей.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Laravel — реализация в Action</div>
<pre><code><span class="c-key">final class</span> <span class="c-type">PlaceOrderAction</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-key">array</span> <span class="c-var">$data</span>): <span class="c-type">Order</span>
    {
        <span class="c-key">return</span> <span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$data</span>) {
            <span class="c-comment">// 1. Основные данные</span>
            <span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">create</span>(<span class="c-var">$data</span>);

            <span class="c-comment">// 2. Событие в outbox — та же транзакция</span>
            <span class="c-type">DB</span>::<span class="c-fn">table</span>(<span class="c-str">'outbox'</span>)-&gt;<span class="c-fn">insert</span>([
                <span class="c-str">'aggregate_type'</span> =&gt; <span class="c-str">'Order'</span>,
                <span class="c-str">'aggregate_id'</span>   =&gt; <span class="c-var">$order</span>-&gt;<span class="c-var">id</span>,
                <span class="c-str">'event_type'</span>     =&gt; <span class="c-str">'OrderCreated'</span>,
                <span class="c-str">'payload'</span>        =&gt; <span class="c-fn">json_encode</span>([
                    <span class="c-str">'order_id'</span> =&gt; <span class="c-var">$order</span>-&gt;<span class="c-var">id</span>,
                    <span class="c-str">'total'</span>    =&gt; <span class="c-var">$order</span>-&gt;<span class="c-var">total</span>,
                    <span class="c-str">'items'</span>    =&gt; <span class="c-var">$order</span>-&gt;<span class="c-var">items</span>-&gt;<span class="c-fn">toArray</span>(),
                ]),
                <span class="c-str">'created_at'</span>     =&gt; <span class="c-fn">now</span>(),
            ]);

            <span class="c-key">return</span> <span class="c-var">$order</span>;
            <span class="c-comment">// COMMIT — обе записи атомарно</span>
        });
    }
}</code></pre>
    <p class="text">Обрати внимание: <strong>никакого <code>Kafka::publish()</code> внутри транзакции</strong>. Публикация — забота отдельного воркера. Даже если Kafka лежит — заказ создан, событие ждёт в БД.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="repeat"></i> Relay — отдельный воркер</div>
<pre><code><span class="c-comment">// app/Console/Commands/RelayOutboxCommand.php</span>
<span class="c-key">final class</span> <span class="c-type">RelayOutboxCommand</span> <span class="c-key">extends</span> <span class="c-type">Command</span>
{
    <span class="c-key">protected</span> <span class="c-var">$signature</span> = <span class="c-str">'outbox:relay'</span>;

    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">KafkaProducer</span> <span class="c-var">$kafka</span>): <span class="c-key">int</span>
    {
        <span class="c-key">while</span> (<span class="c-key">true</span>) {
            <span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$kafka</span>) {
                <span class="c-comment">// SKIP LOCKED — параллельные воркеры не мешают друг другу</span>
                <span class="c-var">$events</span> = <span class="c-type">DB</span>::<span class="c-fn">select</span>(<span class="c-str">"
                    SELECT * FROM outbox
                    WHERE published_at IS NULL
                    ORDER BY id
                    LIMIT 100
                    FOR UPDATE SKIP LOCKED
                "</span>);

                <span class="c-key">foreach</span> (<span class="c-var">$events</span> <span class="c-key">as</span> <span class="c-var">$e</span>) {
                    <span class="c-var">$kafka</span>-&gt;<span class="c-fn">publish</span>(<span class="c-var">$e</span>-&gt;<span class="c-var">event_type</span>, <span class="c-var">$e</span>-&gt;<span class="c-var">aggregate_id</span>, <span class="c-var">$e</span>-&gt;<span class="c-var">payload</span>);
                    <span class="c-type">DB</span>::<span class="c-fn">table</span>(<span class="c-str">'outbox'</span>)-&gt;<span class="c-fn">where</span>(<span class="c-str">'id'</span>, <span class="c-var">$e</span>-&gt;<span class="c-var">id</span>)
                        -&gt;<span class="c-fn">update</span>([<span class="c-str">'published_at'</span> =&gt; <span class="c-fn">now</span>()]);
                }
            });

            <span class="c-key">if</span> (<span class="c-fn">empty</span>(<span class="c-var">$events</span>)) <span class="c-fn">sleep</span>(<span class="c-num">1</span>);   <span class="c-comment">// нечего делать — пауза</span>
        }
    }
}</code></pre>
    <p class="text">Запуск: <code>supervisord</code> / <code>systemd</code> держит команду постоянно. Несколько воркеров можно запустить параллельно — <code>SKIP LOCKED</code> гарантирует, что каждое событие возьмёт только один.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle-2"></i> Ключевые преимущества</div>
    <div class="card">
      <h3>Надёжность и атомарность</h3>
      <p class="text">Событие создаётся <em>тогда и только тогда</em>, когда данные сохранены. Не бывает «заказ есть, а событие потерялось».</p>
    </div>
    <div class="card">
      <h3>At-Least-Once delivery</h3>
      <p class="text">Даже если relay упал <em>после</em> publish, но <em>до</em> обновления <code>published_at</code> — следующий запуск повторит. Гарантия «хотя бы один раз».</p>
    </div>
    <div class="card">
      <h3>Без 2PC / XA</h3>
      <p class="text">Distributed transactions сложны, медленны, требуют координатора. Outbox достигает того же эффекта только средствами обычной SQL-транзакции.</p>
    </div>
    <div class="card">
      <h3>Отладка через SQL</h3>
      <p class="text">Все события в таблице — можно посмотреть <code>SELECT * FROM outbox WHERE published_at IS NULL</code> и понять, что застряло. С Kafka log ты этого не увидишь напрямую.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Важные нюансы</div>
    <div class="pitfall"><strong>1. Потребители обязаны быть идемпотентными.</strong> «At-least-once» означает: событие может прийти <em>2+ раз</em> (relay упал после publish, но до update). Consumer должен корректно обработать дубли — обычно по <code>event_id</code> в отдельной таблице <code>processed_events</code>.</div>
    <div class="pitfall"><strong>2. Порядок событий.</strong> Для одного <code>aggregate_id</code> порядок должен сохраняться. Один relay-процесс на partition/aggregate решает это; распараллеливание — по <code>aggregate_id</code> (Kafka partition key).</div>
    <div class="pitfall"><strong>3. Разрастание таблицы.</strong> После publish можно либо удалять, либо чистить cron'ом старше N дней (<code>DELETE FROM outbox WHERE published_at &lt; now() - interval '7 days'</code>). Иначе таблица становится терабайтной.</div>
    <div class="pitfall"><strong>4. Полётов транзакции нет.</strong> Если <code>Kafka::publish</code> внутри <code>DB::transaction</code> — паттерн сломан. Publish <em>всегда</em> отдельно, после COMMIT'а бизнес-транзакции.</div>
    <div class="pitfall"><strong>5. Latency: событие появится через ~1 сек.</strong> Между COMMIT'ом заказа и приходом в consumer — задержка на цикл relay. Обычно приемлема, но для «мгновенных» сценариев (real-time уведомления в браузере) — сомнительно.</div>
    <div class="pitfall"><strong>6. Change Data Capture (CDC) как альтернатива.</strong> Debezium читает WAL PostgreSQL и публикует изменения напрямую — своя реализация Outbox не нужна. Плюс: даже <em>прямые UPDATE в БД</em> порождают события. Минус: инфраструктура сложнее.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Когда применять</div>
    <ul style="margin:8px 0 14px 22px;color:var(--text2);font-size:13px;line-height:1.85">
      <li><strong>Микросервисы</strong>, где надо гарантированно уведомить downstream о доменных событиях.</li>
      <li><strong>Модульные монолиты</strong> с eventual consistency между модулями (даже без брокера — тот же паттерн для отложенных Jobs).</li>
      <li><strong>Интеграция с внешними API</strong>: платёжный вебхук, отправка в CRM, синхронизация с 1С. Всё, где потеря = деньги/данные.</li>
    </ul>
    <p class="text"><strong>Когда <em>не</em> нужен:</strong> монолит, всё в одной БД, обработка синхронная — просто дёргай event listener напрямую. Для маленьких проектов outbox — оверинжиниринг.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-square"></i> Итог</div>
    <div class="info-box success">
      Transactional Outbox — стандартный способ надёжной коммуникации между сервисами <em>без</em> распределённых транзакций. Гарантирует, что событие уйдёт тогда и только тогда, когда бизнес-данные закоммичены. Плата: at-least-once вместо exactly-once (лечится идемпотентностью consumer'ов), задержка ~1 сек, нужен relay-процесс и таблица <code>outbox</code>. На типовом Laravel — реализуется за один вечер, но экономит недели отладки «где мои события».
    </div>
  </div>
</div>

<div id="sec-practice" class="section">
  <div class="section-title">Практика: рефакторинг bad → good</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> Постановка</div>
    <p class="text">Дано: 200-строчный <code>UserController</code>, написанный в стиле «всё в одном». Задача &mdash; пошагово привести к читаемому и тестируемому виду без изменения поведения.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="bug"></i> Шаг 1: исходный код (упрощённо)</div>
<pre><code><span class="c-key">class</span> <span class="c-type">UserController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>)
    {
        <span class="c-var">$data</span> = <span class="c-var">$request</span>-&gt;<span class="c-fn">validate</span>([
            <span class="c-str">'email'</span> =&gt; <span class="c-str">'required|email|unique:users'</span>,
            <span class="c-str">'password'</span> =&gt; <span class="c-str">'required|min:8'</span>,
            <span class="c-str">'country'</span> =&gt; <span class="c-str">'required|string|size:2'</span>,
        ]);

        <span class="c-key">if</span> (! <span class="c-fn">in_array</span>(<span class="c-var">$data</span>[<span class="c-str">'country'</span>], [<span class="c-str">'KZ'</span>, <span class="c-str">'RU'</span>, <span class="c-str">'US'</span>, <span class="c-str">'DE'</span>])) {
            <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>([<span class="c-str">'error'</span> =&gt; <span class="c-str">'Country not supported'</span>], <span class="c-num">422</span>);
        }

        <span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">create</span>([
            <span class="c-str">'email'</span> =&gt; <span class="c-var">$data</span>[<span class="c-str">'email'</span>],
            <span class="c-str">'password'</span> =&gt; <span class="c-type">Hash</span>::<span class="c-fn">make</span>(<span class="c-var">$data</span>[<span class="c-str">'password'</span>]),
            <span class="c-str">'country'</span> =&gt; <span class="c-var">$data</span>[<span class="c-str">'country'</span>],
        ]);

        <span class="c-type">Log</span>::<span class="c-fn">info</span>(<span class="c-str">'user.registered'</span>, [<span class="c-str">'user_id'</span> =&gt; <span class="c-var">$user</span>-&gt;<span class="c-var">id</span>]);

        <span class="c-key">if</span> (<span class="c-var">$request</span>-&gt;<span class="c-fn">has</span>(<span class="c-str">'promo_code'</span>)) {
            <span class="c-var">$promo</span> = <span class="c-type">Promo</span>::<span class="c-fn">where</span>(<span class="c-str">'code'</span>, <span class="c-var">$request</span>-&gt;<span class="c-fn">input</span>(<span class="c-str">'promo_code'</span>))-&gt;<span class="c-fn">first</span>();
            <span class="c-key">if</span> (<span class="c-var">$promo</span> &amp;&amp; <span class="c-var">$promo</span>-&gt;<span class="c-var">is_active</span>) {
                <span class="c-var">$user</span>-&gt;<span class="c-fn">update</span>([<span class="c-str">'credit'</span> =&gt; <span class="c-var">$promo</span>-&gt;<span class="c-var">amount</span>]);
            }
        }

        <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$user</span>-&gt;<span class="c-var">email</span>)-&gt;<span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">WelcomeMail</span>(<span class="c-var">$user</span>));
        <span class="c-type">Http</span>::<span class="c-fn">post</span>(<span class="c-str">'https://analytics.example.com/event'</span>, [<span class="c-str">'event'</span> =&gt; <span class="c-str">'signup'</span>]);

        <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>(<span class="c-var">$user</span>);
    }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Шаги рефакторинга</div>
    <div class="card"><h3>Шаг 1: FormRequest</h3><p class="text"><code>RegisterUserRequest</code> с правилами и кастомным правилом для страны. Контроллер уменьшается на 10 строк.</p></div>
    <div class="card"><h3>Шаг 2: Action</h3><p class="text"><code>RegisterUser action</code> &mdash; принимает DTO, делает всё что в контроллере.</p></div>
    <div class="card"><h3>Шаг 3: Зависимости через DI</h3><p class="text"><code>UserRepository</code>, <code>PromoApplier</code>, <code>Notifier</code>, <code>Analytics</code> &mdash; через конструктор Action. Каждая &mdash; интерфейс.</p></div>
    <div class="card"><h3>Шаг 4: Отдельный Action для промокода</h3><p class="text"><code>ApplyPromoCode action</code>. Если невалидный &mdash; молча пропускается (поведение сохранено).</p></div>
    <div class="card"><h3>Шаг 5: Mail и Analytics через события</h3><p class="text">Action эмитит <code>UserRegistered event</code>. Listeners: <code>SendWelcomeMail</code> (ShouldQueue), <code>NotifyAnalytics</code>.</p></div>
    <div class="card"><h3>Шаг 6: Транзакция</h3><p class="text"><code>DB::transaction(fn () =&gt; ...)</code> в Action оборачивает создание + промокод.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle-2"></i> Результат</div>
<pre><code><span class="c-comment">// Controller — 5 строк</span>
<span class="c-key">final class</span> <span class="c-type">UserController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(<span class="c-type">RegisterUserRequest</span> <span class="c-var">$r</span>, <span class="c-type">RegisterUser</span> <span class="c-var">$action</span>): <span class="c-type">JsonResponse</span>
    {
        <span class="c-var">$user</span> = <span class="c-var">$action</span>(<span class="c-type">RegisterUserData</span>::<span class="c-fn">fromRequest</span>(<span class="c-var">$r</span>));
        <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>(<span class="c-key">new</span> <span class="c-type">UserResource</span>(<span class="c-var">$user</span>), <span class="c-num">201</span>);
    }
}

<span class="c-comment">// Action — 12 строк, оркестрация</span>
<span class="c-key">final class</span> <span class="c-type">RegisterUser</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private</span> <span class="c-type">UserRepository</span>  <span class="c-var">$users</span>,
        <span class="c-key">private</span> <span class="c-type">ApplyPromoCode</span> <span class="c-var">$promo</span>,
    ) {}

    <span class="c-key">public function</span> <span class="c-fn">__invoke</span>(<span class="c-type">RegisterUserData</span> <span class="c-var">$data</span>): <span class="c-type">User</span>
    {
        <span class="c-key">return</span> <span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$data</span>) {
            <span class="c-var">$user</span> = <span class="c-var">$this</span>-&gt;<span class="c-var">users</span>-&gt;<span class="c-fn">create</span>(<span class="c-var">$data</span>);
            <span class="c-key">if</span> (<span class="c-var">$data</span>-&gt;<span class="c-var">promoCode</span>) (<span class="c-var">$this</span>-&gt;<span class="c-var">promo</span>)(<span class="c-var">$user</span>, <span class="c-var">$data</span>-&gt;<span class="c-var">promoCode</span>);
            <span class="c-type">UserRegistered</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$user</span>)-&gt;<span class="c-fn">afterCommit</span>();
            <span class="c-key">return</span> <span class="c-var">$user</span>;
        });
    }
}
</code></pre>

    <p class="text"><strong>Метрики до/после:</strong></p>
    <ul class="bullets">
      <li>Controller: 200 строк → 6 строк × 6 методов = 36 строк;</li>
      <li>Тестируемость: невозможно (мок 5 фасадов) → легко (DI, фейк-репозитории);</li>
      <li>Добавить новый источник промокодов: правка Controller → новая стратегия в <code>ApplyPromoCode</code>;</li>
      <li>Бизнес-логика отделена от инфраструктуры (mail, analytics &mdash; через события).</li>
    </ul>
  </div>
</div>

<div id="sec-pitfalls" class="section">
  <div class="section-title">Сводные подводные камни</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Топ ошибок дизайна</div>
    <div class="pitfall"><strong>1. Паттерны ради паттернов.</strong> Не можете назвать конкретную проблему &mdash; вы добавляете сложность без выгоды.</div>
    <div class="pitfall"><strong>2. Premature abstraction.</strong> Интерфейс для класса с одной реализацией.</div>
    <div class="pitfall"><strong>3. Big-up-front design.</strong> Месяц на UML перед написанием кода &mdash; требования меняются в первую неделю.</div>
    <div class="pitfall"><strong>4. Anemic Domain Model.</strong> Entity без поведения, только данные. Вся логика в сервисах. Это процедурный код.</div>
    <div class="pitfall"><strong>5. God class.</strong> 1000+ строк с десятком ответственностей. Разбивайте по SRP.</div>
    <div class="pitfall"><strong>6. Циклические зависимости.</strong> A зависит от B, B от A. Нужен третий компонент или event-based.</div>
    <div class="pitfall"><strong>7. Static everywhere.</strong> Static-методы повсюду &mdash; глобальное состояние, не мокаются.</div>
    <div class="pitfall"><strong>8. Inheritance over composition.</strong> Глубокая иерархия (4+ уровня) почти всегда хуже композиции.</div>
    <div class="pitfall"><strong>9. Магические числа и строки.</strong> <code>if ($status === 1)</code> вместо <code>StatusEnum::Active</code>.</div>
    <div class="pitfall"><strong>10. Тестирование реализации, не поведения.</strong> Тесты ломаются при безопасном рефакторинге.</div>
    <div class="pitfall"><strong>11. «Best practices» из соцсетей.</strong> Без контекста &mdash; вред. Контекст важнее моды.</div>
    <div class="pitfall"><strong>12. Игнор domain expert.</strong> Архитектура без понимания бизнеса &mdash; технически красивая, неподходящая.</div>
  </div>
</div>

<div id="sec-interview" class="section">
  <div class="section-title">Вопросы на собеседование</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield-check"></i> SOLID и принципы</div>
    <div class="card"><h3>1. Расскажите про SOLID на примере из своего кода</h3><p class="text">Готовьте 1-2 истории: была проблема (трудно тестировать, дублирование) → применили принцип → результат. Не «S означает Single Responsibility».</p></div>
    <div class="card"><h3>2. Когда вы НЕ применяете SOLID?</h3><p class="text">Простой CRUD, тестовый код, прототип. Показывает понимание trade-offs.</p></div>
    <div class="card"><h3>3. Разница между DRY и YAGNI?</h3><p class="text">DRY &mdash; не повторять знание. YAGNI &mdash; не делать преждевременно. Противоречие: два похожих фрагмента &mdash; объединить (DRY) или оставить (YAGNI). Rule of three.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Паттерны</div>
    <div class="card"><h3>4. Паттерн, который реально использовали недавно</h3><p class="text">Конкретный кейс. Стратегия для разных отчётов, Adapter для нового SDK, Decorator для кеширования.</p></div>
    <div class="card"><h3>5. Adapter vs Decorator?</h3><p class="text">Adapter изменяет интерфейс (приводит несовместимый к нужному). Decorator сохраняет интерфейс, добавляет функциональность.</p></div>
    <div class="card"><h3>6. Что плохого в Singleton?</h3><p class="text">Скрытая глобальная зависимость, невозможность мокать, неявное состояние. Решение в Laravel &mdash; Service Container с singleton-биндингом.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> Repository и Service</div>
    <div class="card"><h3>7. Нужен ли Repository в Laravel?</h3><p class="text">«Зависит». Eloquent уже &mdash; абстракция. Добавление Repository в простом проекте &mdash; overengineering. В DDD/Hexagonal &mdash; обязателен. Объясните trade-offs.</p></div>
    <div class="card"><h3>8. Action vs Service?</h3><p class="text">Action &mdash; один публичный метод (одно действие), Service &mdash; несколько связанных. Action лучше для CQRS-стиля.</p></div>
    <div class="card"><h3>9. Зачем DTO, если есть массивы?</h3><p class="text">Type safety, валидация в конструкторе, документация, readonly &mdash; нельзя случайно изменить.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="boxes"></i> DDD и Clean</div>
    <div class="card"><h3>10. Что такое Aggregate?</h3><p class="text">Группа Entity и VO с одной точкой доступа (Aggregate Root). Гарантирует консистентность. Order + OrderItems.</p></div>
    <div class="card"><h3>11. Entity vs Value Object?</h3><p class="text">Entity имеет идентичность (id). Value Object &mdash; без идентичности, иммутабелен, определяется значениями.</p></div>
    <div class="card"><h3>12. Что такое Clean Architecture?</h3><p class="text">Подход с бизнес-логикой в центре, инфраструктура снаружи. Зависимости направлены внутрь. Полезна для сложных доменов. На CRUD &mdash; излишество.</p></div>
    <div class="card"><h3>13. Что такое Anemic Domain Model?</h3><p class="text">Модель только с данными, логика в сервисах. Процедурный код в ООП-обёртке. Логика разбросана, легко нарушить инварианты.</p></div>
    <div class="card"><h3>14. Hexagonal vs Clean Architecture?</h3><p class="text">Концептуально одно: домен в центре, внешние взаимодействия через интерфейсы. Hexagonal проще терминологически. Clean &mdash; более явная иерархия слоёв.</p></div>
    <div class="card"><h3>15. Расскажите про самый неудачный архитектурный выбор</h3><p class="text">Senior &mdash; человек, у которого есть провалы. Конкретно: «применили микросервисы для маленькой команды, потеряли год на инфраструктуру, вернулись к монолиту». Что научились &mdash; критичная часть.</p></div>
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
