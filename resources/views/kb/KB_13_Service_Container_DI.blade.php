@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Service Container и Dependency Injection — глубокий разбор</title>
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
</style>
</head>
<body>
<div class="container">
<div class="sidebar">
  <a href="/" class="sidebar-back"><i data-lucide="arrow-left"></i> На главную</a>
  <div class="sidebar-title">Service Container &amp; DI</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">Концепции</div>
  <a class="nav-item" onclick="showSection('concept',this)"><i data-lucide="box"></i> Что такое контейнер</a>
  <a class="nav-item" onclick="showSection('di',this)"><i data-lucide="git-branch"></i> Dependency Injection</a>

  <div class="nav-group-label">Bindings</div>
  <a class="nav-item" onclick="showSection('bind-basic',this)"><i data-lucide="link"></i> bind / singleton / instance</a>
  <a class="nav-item" onclick="showSection('bind-scoped',this)"><i data-lucide="layers"></i> Scoped bindings</a>
  <a class="nav-item" onclick="showSection('bind-contextual',this)"><i data-lucide="git-fork"></i> Contextual binding</a>
  <a class="nav-item" onclick="showSection('bind-tagged',this)"><i data-lucide="tag"></i> Tagged services</a>

  <div class="nav-group-label">Разрешение</div>
  <a class="nav-item" onclick="showSection('resolution',this)"><i data-lucide="search"></i> make / resolve / autowiring</a>
  <a class="nav-item" onclick="showSection('events',this)"><i data-lucide="activity"></i> Container events</a>

  <div class="nav-group-label">Service Providers</div>
  <a class="nav-item" onclick="showSection('providers',this)"><i data-lucide="plug"></i> Что такое ServiceProvider</a>
  <a class="nav-item" onclick="showSection('lifecycle',this)"><i data-lucide="rotate-cw"></i> register vs boot</a>
  <a class="nav-item" onclick="showSection('deferred',this)"><i data-lucide="hourglass"></i> Deferred providers</a>
  <a class="nav-item" onclick="showSection('packages',this)"><i data-lucide="package"></i> Package providers</a>

  <div class="nav-group-label">Применение</div>
  <a class="nav-item" onclick="showSection('practice',this)"><i data-lucide="hammer"></i> Практика</a>
  <a class="nav-item" onclick="showSection('pitfalls',this)"><i data-lucide="alert-octagon"></i> Подводные камни</a>
  <a class="nav-item" onclick="showSection('interview',this)"><i data-lucide="brain"></i> На собеседование</a>
</div>

<div class="main">
<div class="page-header">
  <h1>Service Container и Dependency Injection</h1>
  <p>Архитектурное ядро Laravel: как фреймворк связывает сотни сервисов между собой. Понимание контейнера отличает junior от middle и определяет, как пишется поддерживаемый код в долгоживущих проектах.</p>
  <div class="badge-row">
    <span class="badge">Laravel</span>
    <span class="badge">Architecture</span>
    <span class="badge">DI</span>
    <span class="badge badge-success">Middle / Senior</span>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     OVERVIEW
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>

  <p class="text">Service Container — невидимая, но центральная подсистема Laravel. Любой контроллер, любая команда Artisan, любой Job, любое Event-событие &mdash; всё проходит через контейнер. Он отвечает за создание объектов с правильными зависимостями, переиспользование экземпляров, подмену реализаций в тестах и сборку из конфигов.</p>

  <p class="text">Поверхностное знакомство с Laravel позволяет писать рабочий код, не задумываясь о контейнере: фреймворк автоматически подставляет зависимости в конструкторы. Однако всё, что выходит за рамки CRUD &mdash; интеграции с внешними системами, расширяемые модули, многотенантность, тестирование с моками, написание собственных пакетов &mdash; требует осознанной работы с контейнером.</p>

  <div class="info-box primary">
    <strong>Что даёт глубокое понимание контейнера:</strong>
    <ul class="bullets" style="margin-top:6px;margin-bottom:0;color:#404357;">
      <li>Возможность подменять реализации без переписывания кода (мок, fake, decorator);</li>
      <li>Понимание того, как Laravel внутренне собирает фреймворк из независимых сервис-провайдеров;</li>
      <li>Способность писать переиспользуемые пакеты с публичным API;</li>
      <li>Умение читать чужой код, опирающийся на контейнер;</li>
      <li>Корректные паттерны для тестов: <code>bind</code>, <code>instance</code>, <code>swap</code>.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Пререквизиты</div>
    <ul class="bullets">
      <li>KB_1 &mdash; PHP OOP: интерфейсы, абстрактные классы, конструкторы, наследование;</li>
      <li>KB_3 разделы 2 и 3 &mdash; базовое понимание Service Container и провайдеров;</li>
      <li>KB_9 &mdash; что такое <code>bootable trait</code> и как Laravel расширяет модели.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map"></i> Карта раздела</div>
    <table class="data-table">
      <tr><th>Блок</th><th>Что узнаешь</th></tr>
      <tr><td><strong>Концепции</strong></td><td>Что такое DI, чем отличается контейнер от Service Locator</td></tr>
      <tr><td><strong>Bindings</strong></td><td>Все способы регистрации: bind, singleton, instance, scoped, contextual, tagged</td></tr>
      <tr><td><strong>Разрешение</strong></td><td>Как Laravel создаёт объекты: autowiring, рекурсия конструкторов, primitives</td></tr>
      <tr><td><strong>Providers</strong></td><td>Жизненный цикл фреймворка через ServiceProvider; deferred &amp; package providers</td></tr>
      <tr><td><strong>Практика</strong></td><td>Расширяемая платёжная подсистема: 4 провайдера, 6 банков, заменяемые драйверы</td></tr>
    </table>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     CONCEPT
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-concept" class="section">
  <div class="section-title">Что такое Service Container</div>

  <!-- Назначение -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Service Container (контейнер служб, иногда называемый IoC-контейнером &mdash; Inversion of Control) &mdash; объект-фабрика, отвечающий за создание других объектов в приложении. Когда коду нужен экземпляр класса с зависимостями, он не создаёт его напрямую через <code>new</code>, а просит контейнер: «дай мне экземпляр <code>UserRepository</code>». Контейнер сам разбирает, какие зависимости нужны конструктору этого класса, рекурсивно создаёт их, и возвращает готовый объект.</p>
    <p class="text">Это решает несколько задач одновременно. Во-первых, инверсия зависимостей: класс не знает, как создаётся <code>Mailer</code>, ему достаточно объявить, что в конструкторе нужен <code>Mailer</code>-интерфейс. Во-вторых, единое место регистрации: вся «сборка» приложения собирается в провайдерах, а не размазывается по сотням мест с <code>new</code>. В-третьих, заменяемость реализаций: в тесте можно сказать «когда просят <code>Mailer</code>, верни fake», и весь код будет работать с этим fake без модификаций.</p>
    <p class="text">В Laravel контейнер реализован классом <code>Illuminate\Container\Container</code>; <code>Illuminate\Foundation\Application</code> &mdash; его подкласс, добавляющий специфичные для Laravel возможности (события приложения, информацию об окружении, маршрутизацию). Глобальный экземпляр доступен через хелпер <code>app()</code>, через фасад <code>App</code>, через инъекцию интерфейса <code>Illuminate\Contracts\Container\Container</code>.</p>
  </div>

  <!-- Объекты -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Базовые понятия</div>

    <div class="card">
      <h3>Abstract и concrete</h3>
      <p class="text"><strong>Abstract</strong> &mdash; «ключ», под которым сервис зарегистрирован: имя интерфейса, имя абстрактного класса, или произвольная строка. <strong>Concrete</strong> &mdash; конкретная реализация: имя класса или замыкание, возвращающее экземпляр.</p>
<pre><code><span class="c-comment">// abstract = интерфейс, concrete = конкретный класс</span>
<span class="c-fn">app</span>()-><span class="c-fn">bind</span>(
    <span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>,    <span class="c-comment">// abstract</span>
    <span class="c-type">StripeGateway</span>::<span class="c-key">class</span>,     <span class="c-comment">// concrete</span>
);

<span class="c-comment">// abstract = строковый ключ, concrete = замыкание</span>
<span class="c-fn">app</span>()-><span class="c-fn">bind</span>(<span class="c-str">'payment.fee_calculator'</span>, <span class="c-key">function</span> (<span class="c-type">Container</span> <span class="c-var">$app</span>) {
    <span class="c-key">return new</span> <span class="c-type">FeeCalculator</span>(<span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">CurrencyService</span>::<span class="c-key">class</span>));
});
</code></pre>
    </div>

    <div class="card">
      <h3>Resolution &mdash; разрешение зависимости</h3>
      <p class="text">При вызове <code>app()-&gt;make($abstract)</code> или автоматическом разрешении (например, в параметрах конструктора контроллера) контейнер выполняет цепочку действий:</p>
      <ul class="bullets">
        <li>Проверяет, есть ли зарегистрированный bind для <code>$abstract</code>;</li>
        <li>Если есть &mdash; вызывает соответствующий callback или инстанцирует concrete-класс;</li>
        <li>Если нет, но <code>$abstract</code> &mdash; имя конкретного класса &mdash; пытается инстанцировать его напрямую (autowiring);</li>
        <li>Для каждого параметра конструктора рекурсивно разрешает зависимости;</li>
        <li>Для primitive-параметров (строки, числа без type-hint) ищет контекстные bindings или применяет значение по умолчанию;</li>
        <li>Вызывает события <code>resolving</code> и <code>afterResolving</code>;</li>
        <li>Возвращает готовый экземпляр.</li>
      </ul>
    </div>

    <div class="card">
      <h3>Singleton vs Transient</h3>
      <p class="text">Сервис может быть зарегистрирован как <strong>singleton</strong> (один и тот же экземпляр на всё время жизни приложения) или как <strong>transient</strong> (каждое разрешение возвращает новый экземпляр). По умолчанию <code>bind()</code> регистрирует transient, <code>singleton()</code> &mdash; разделяемый.</p>
<pre><code><span class="c-fn">app</span>()-><span class="c-fn">bind</span>(<span class="c-type">Mailer</span>::<span class="c-key">class</span>, <span class="c-type">SmtpMailer</span>::<span class="c-key">class</span>);
<span class="c-var">$a</span> = <span class="c-fn">app</span>(<span class="c-type">Mailer</span>::<span class="c-key">class</span>);
<span class="c-var">$b</span> = <span class="c-fn">app</span>(<span class="c-type">Mailer</span>::<span class="c-key">class</span>);
<span class="c-comment">// $a !== $b — разные экземпляры</span>

<span class="c-fn">app</span>()-><span class="c-fn">singleton</span>(<span class="c-type">Mailer</span>::<span class="c-key">class</span>, <span class="c-type">SmtpMailer</span>::<span class="c-key">class</span>);
<span class="c-var">$a</span> = <span class="c-fn">app</span>(<span class="c-type">Mailer</span>::<span class="c-key">class</span>);
<span class="c-var">$b</span> = <span class="c-fn">app</span>(<span class="c-type">Mailer</span>::<span class="c-key">class</span>);
<span class="c-comment">// $a === $b — один и тот же экземпляр</span>
</code></pre>
    </div>
  </div>

  <!-- Практика -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Иллюстративный пример</div>
    <p class="text">Сравним «ручную» сборку и сборку через контейнер на примере класса, шлющего уведомления.</p>

    <p class="text"><strong>Без контейнера:</strong> вызывающий код вынужден знать, как создать все зависимости.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">NotificationService</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private</span> <span class="c-type">SmtpMailer</span> <span class="c-var">$mailer</span>,
        <span class="c-type">SmsGateway</span> <span class="c-var">$sms</span>,
        <span class="c-type">TemplateEngine</span> <span class="c-var">$templates</span>,
    ) {}
}

<span class="c-comment">// Контроллер вынужден явно собирать графы зависимостей.</span>
<span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>)
{
    <span class="c-var">$mailer</span>    = <span class="c-key">new</span> <span class="c-type">SmtpMailer</span>(<span class="c-fn">config</span>(<span class="c-str">'mail.host'</span>), <span class="c-fn">config</span>(<span class="c-str">'mail.port'</span>));
    <span class="c-var">$sms</span>       = <span class="c-key">new</span> <span class="c-type">SmsGateway</span>(<span class="c-fn">config</span>(<span class="c-str">'sms.token'</span>));
    <span class="c-var">$templates</span> = <span class="c-key">new</span> <span class="c-type">TemplateEngine</span>(<span class="c-fn">resource_path</span>(<span class="c-str">'templates'</span>));

    <span class="c-var">$service</span> = <span class="c-key">new</span> <span class="c-type">NotificationService</span>(<span class="c-var">$mailer</span>, <span class="c-var">$sms</span>, <span class="c-var">$templates</span>);
    <span class="c-var">$service</span>-><span class="c-fn">send</span>(...);
}
</code></pre>

    <p class="text"><strong>С контейнером:</strong> контроллер объявляет, что ему нужно, и получает готовый сервис.</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>, <span class="c-type">NotificationService</span> <span class="c-var">$service</span>)
{
    <span class="c-var">$service</span>-><span class="c-fn">send</span>(...);
    <span class="c-comment">// Laravel сам создал SmtpMailer, SmsGateway, TemplateEngine</span>
    <span class="c-comment">// и собрал из них NotificationService.</span>
}
</code></pre>

    <p class="text">Контейнер «знает», как создаются <code>SmtpMailer</code>, <code>SmsGateway</code>, <code>TemplateEngine</code>, потому что эти зависимости были зарегистрированы в сервис-провайдерах. Контроллер не несёт ответственности за их сборку.</p>
  </div>

  <!-- Особые случаи -->
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. Контейнер не панацея.</strong> Контейнер решает задачи сборки графа зависимостей, но не делает архитектуру правильной автоматически. Плохо спроектированные классы с десятками параметров в конструкторе остаются плохими и при использовании контейнера &mdash; просто их инстанцирование скрыто. Контейнер усиливает хорошую архитектуру, но не исправляет плохую.
    </div>
    <div class="pitfall">
      <strong>2. <code>app()</code> внутри классов &mdash; антипаттерн (Service Locator).</strong> Вызов <code>app(SomeService::class)</code> внутри метода класса делает класс зависимым от контейнера. Зависимости становятся неявными: глядя на класс, невозможно понять, что ему нужно для работы. Корректный подход &mdash; объявлять зависимости в конструкторе.
    </div>
    <div class="pitfall">
      <strong>3. Циклические зависимости.</strong> Если <code>A</code> зависит от <code>B</code>, а <code>B</code> зависит от <code>A</code>, контейнер не может разрешить ни один из них &mdash; выпадет <code>BindingResolutionException</code>. Решение &mdash; пересмотр архитектуры (выделить общую зависимость, использовать события или ленивое разрешение).
    </div>
    <div class="pitfall">
      <strong>4. Singleton с состоянием в многозадачных средах.</strong> Singleton, накапливающий состояние внутри (счётчики, кэш, очереди), безопасен в стандартном PHP-FPM (каждый запрос &mdash; новый процесс), но опасен в Laravel Octane (RoadRunner, Swoole), где состояние сохраняется между запросами. Stateless-сервисы остаются singleton; stateful &mdash; либо transient, либо scoped.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     DI
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-di" class="section">
  <div class="section-title">Dependency Injection</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Dependency Injection (внедрение зависимостей) &mdash; принцип проектирования, при котором класс получает свои зависимости извне, а не создаёт их самостоятельно. Класс становится независимым от способа создания зависимости: ему передают готовый объект через конструктор, метод или свойство.</p>
    <p class="text">DI &mdash; <strong>принцип</strong>, не привязанный к фреймворку и языку. Контейнер &mdash; <strong>реализация</strong> этого принципа: инструмент, автоматизирующий передачу зависимостей. Можно применять DI без контейнера (ручная передача в конструктор), но в проекте с сотнями классов это становится непрактичным; контейнер автоматизирует процесс.</p>
    <p class="text">Главная ценность DI &mdash; разрыв жёсткой связи между классами через интерфейсы. Класс <code>OrderService</code> зависит от интерфейса <code>PaymentGateway</code>, а не от конкретного <code>StripeGateway</code>. Конкретная реализация выбирается в одном месте (провайдере), и любая её замена не требует правки кода, использующего сервис.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Виды Injection</div>

    <div class="card">
      <h3>Constructor Injection &mdash; основной способ</h3>
      <p class="text">Зависимости объявляются в параметрах конструктора с типами. Это самый частый, самый явный и предпочтительный способ. При создании объекта через контейнер все параметры конструктора автоматически разрешаются.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">OrderService</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private readonly</span> <span class="c-type">PaymentGateway</span> <span class="c-var">$payment</span>,
        <span class="c-key">private readonly</span> <span class="c-type">InventoryService</span> <span class="c-var">$inventory</span>,
        <span class="c-key">private readonly</span> <span class="c-type">Mailer</span> <span class="c-var">$mailer</span>,
    ) {}

    <span class="c-key">public function</span> <span class="c-fn">place</span>(<span class="c-key">array</span> <span class="c-var">$items</span>): <span class="c-type">Order</span>
    {
        <span class="c-comment">// Зависимости доступны как свойства объекта.</span>
        <span class="c-var">$this</span>-><span class="c-var">inventory</span>-><span class="c-fn">reserve</span>(<span class="c-var">$items</span>);
        <span class="c-var">$result</span> = <span class="c-var">$this</span>-><span class="c-var">payment</span>-><span class="c-fn">charge</span>(...);
        <span class="c-var">$this</span>-><span class="c-var">mailer</span>-><span class="c-fn">send</span>(...);
    }
}
</code></pre>
      <p class="text">Конструктор делает зависимости <strong>обязательными</strong>: класс невозможно создать без них, что устраняет «полузаполненные» состояния. Использование <code>readonly</code> и <code>private</code> дополнительно гарантирует неизменяемость и инкапсуляцию.</p>
    </div>

    <div class="card">
      <h3>Method Injection</h3>
      <p class="text">Зависимость объявляется в параметрах конкретного метода, а не конструктора. Применяется, когда зависимость нужна только в одной операции класса, либо когда метод обрабатывает действие пользователя (контроллер, slash-команда, обработчик webhook).</p>
<pre><code><span class="c-key">class</span> <span class="c-type">UserController</span>
{
    <span class="c-comment">// Метод-обработчик контроллера. Laravel инжектирует все типизированные параметры.</span>
    <span class="c-key">public function</span> <span class="c-fn">store</span>(
        <span class="c-type">StoreUserRequest</span> <span class="c-var">$request</span>,        <span class="c-comment">// FormRequest со встроенной валидацией</span>
        <span class="c-type">UserService</span> <span class="c-var">$users</span>,                <span class="c-comment">// сервис из контейнера</span>
        <span class="c-type">EventBus</span> <span class="c-var">$events</span>,                  <span class="c-comment">// ещё одна зависимость</span>
    ): <span class="c-type">JsonResponse</span> {
        <span class="c-var">$user</span> = <span class="c-var">$users</span>-><span class="c-fn">create</span>(<span class="c-var">$request</span>-><span class="c-fn">validated</span>());
        <span class="c-var">$events</span>-><span class="c-fn">dispatch</span>(<span class="c-key">new</span> <span class="c-type">UserRegistered</span>(<span class="c-var">$user</span>));
        <span class="c-key">return</span> <span class="c-fn">response</span>()-><span class="c-fn">json</span>(<span class="c-var">$user</span>);
    }
}
</code></pre>
      <p class="text">Method injection поддерживается во всех «точках входа» Laravel: контроллеры, обработчики команд Artisan, jobs (<code>handle</code>), event listeners, middleware (<code>handle</code>). Если необходимо инжектировать зависимость в произвольный метод произвольного класса, используется <code>app()-&gt;call($object, 'method')</code>.</p>
    </div>

    <div class="card">
      <h3>Setter Injection</h3>
      <p class="text">Зависимость передаётся через сеттер-метод после создания объекта. В Laravel применяется редко и обычно через свойства, помеченные специально (например, <code>Container::resolving</code>). Подход даёт возможность опциональных зависимостей, но усложняет проверку, что объект полностью настроен.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">CacheableRepository</span>
{
    <span class="c-key">private</span> ?<span class="c-type">CacheStore</span> <span class="c-var">$cache</span> = <span class="c-key">null</span>;

    <span class="c-key">public function</span> <span class="c-fn">setCache</span>(<span class="c-type">CacheStore</span> <span class="c-var">$cache</span>): <span class="c-key">self</span>
    {
        <span class="c-var">$this</span>-><span class="c-var">cache</span> = <span class="c-var">$cache</span>;
        <span class="c-key">return</span> <span class="c-var">$this</span>;
    }
}

<span class="c-comment">// Через resolving callback можно автоматически вызывать setter.</span>
<span class="c-fn">app</span>()-><span class="c-fn">resolving</span>(<span class="c-type">CacheableRepository</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">CacheableRepository</span> <span class="c-var">$repo</span>, <span class="c-type">Container</span> <span class="c-var">$app</span>) {
    <span class="c-var">$repo</span>-><span class="c-fn">setCache</span>(<span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">CacheStore</span>::<span class="c-key">class</span>));
});
</code></pre>
    </div>

    <div class="card">
      <h3>Interface Injection</h3>
      <p class="text">Зависимости объявляются на уровне интерфейса. Класс реализует контракт <code>SetCacheAware</code>, и контейнер автоматически вызывает соответствующий метод после создания. В Laravel это не используется как идиома, но именно так работают внутренние механизмы вроде <code>Illuminate\Contracts\Container\BindingResolutionException</code>.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: переход от прямой зависимости к DI</div>
    <p class="text">Рассмотрим эволюцию класса от тесной связи с конкретной реализацией к гибкому DI через интерфейс. Видимое улучшение происходит в трёх измерениях: тестируемость, заменяемость, читаемость.</p>

    <p class="text"><strong>Этап 1: прямая зависимость от конкретного класса.</strong> Не тестируется без работающего внешнего API; смена провайдера требует переписывания.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">OrderController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">checkout</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>): <span class="c-type">Response</span>
    {
        <span class="c-comment">// Класс жёстко зависит от StripeGateway.</span>
        <span class="c-var">$gateway</span> = <span class="c-key">new</span> <span class="c-type">StripeGateway</span>(<span class="c-fn">config</span>(<span class="c-str">'services.stripe.key'</span>));
        <span class="c-var">$result</span> = <span class="c-var">$gateway</span>-><span class="c-fn">charge</span>(<span class="c-var">$request</span>-><span class="c-fn">amount</span>);
        <span class="c-comment">// В тесте — реальные обращения к Stripe API.</span>
    }
}
</code></pre>

    <p class="text"><strong>Этап 2: внедрение через конструктор.</strong> Зависимость явная, тесты могут подсунуть mock.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">OrderController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private readonly</span> <span class="c-type">StripeGateway</span> <span class="c-var">$gateway</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">checkout</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>): <span class="c-type">Response</span>
    {
        <span class="c-var">$result</span> = <span class="c-var">$this</span>-><span class="c-var">gateway</span>-><span class="c-fn">charge</span>(<span class="c-var">$request</span>-><span class="c-fn">amount</span>);
    }
}

<span class="c-comment">// В тесте</span>
<span class="c-var">$mock</span> = <span class="c-type">Mockery</span>::<span class="c-fn">mock</span>(<span class="c-type">StripeGateway</span>::<span class="c-key">class</span>);
<span class="c-var">$mock</span>-><span class="c-fn">shouldReceive</span>(<span class="c-str">'charge'</span>)-><span class="c-fn">andReturn</span>(<span class="c-key">new</span> <span class="c-type">ChargeResult</span>(<span class="c-key">true</span>));
<span class="c-fn">app</span>()-><span class="c-fn">instance</span>(<span class="c-type">StripeGateway</span>::<span class="c-key">class</span>, <span class="c-var">$mock</span>);
</code></pre>

    <p class="text"><strong>Этап 3: зависимость от интерфейса.</strong> Контроллер вообще не знает, какой провайдер используется. Можно менять Stripe на PayPal через провайдер, без изменений в контроллере.</p>
<pre><code><span class="c-key">interface</span> <span class="c-type">PaymentGateway</span>
{
    <span class="c-key">public function</span> <span class="c-fn">charge</span>(<span class="c-key">int</span> <span class="c-var">$amountCents</span>, <span class="c-key">string</span> <span class="c-var">$currency</span>): <span class="c-type">ChargeResult</span>;
}

<span class="c-key">class</span> <span class="c-type">StripeGateway</span> <span class="c-key">implements</span> <span class="c-type">PaymentGateway</span> { <span class="c-comment">/* ... */</span> }
<span class="c-key">class</span> <span class="c-type">PaypalGateway</span> <span class="c-key">implements</span> <span class="c-type">PaymentGateway</span> { <span class="c-comment">/* ... */</span> }

<span class="c-comment">// В провайдере</span>
<span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">bind</span>(<span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>, <span class="c-type">StripeGateway</span>::<span class="c-key">class</span>);
<span class="c-comment">// или, в зависимости от конфигурации:</span>
<span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">bind</span>(<span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>, <span class="c-key">function</span> () {
    <span class="c-key">return match</span> (<span class="c-fn">config</span>(<span class="c-str">'payment.driver'</span>)) {
        <span class="c-str">'stripe'</span> =&gt; <span class="c-fn">app</span>(<span class="c-type">StripeGateway</span>::<span class="c-key">class</span>),
        <span class="c-str">'paypal'</span> =&gt; <span class="c-fn">app</span>(<span class="c-type">PaypalGateway</span>::<span class="c-key">class</span>),
    };
});

<span class="c-key">class</span> <span class="c-type">OrderController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private readonly</span> <span class="c-type">PaymentGateway</span> <span class="c-var">$gateway</span>) {}
    <span class="c-comment">// Контроллер не знает, какой провайдер активен.</span>
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. Конструктор раздут до 10+ параметров.</strong> Это симптом нарушения принципа единственной ответственности (Single Responsibility). Класс делает слишком много. Решения: разбить класс на несколько меньших, выделить параметры в Value Object, использовать паттерн «параметр-объект» (Parameter Object).
    </div>
    <div class="pitfall">
      <strong>2. Тип зависимости &mdash; конкретный класс вместо интерфейса.</strong> Конструктор <code>__construct(StripeGateway $gateway)</code> требует именно <code>StripeGateway</code>. Зависимость от интерфейса (<code>PaymentGateway</code>) делает класс гибким к замене реализации. Если интерфейс пока одинокий &mdash; всё равно стоит его ввести: при добавлении второго провайдера не придётся править все вызовы.
    </div>
    <div class="pitfall">
      <strong>3. Method injection в обычных методах.</strong> Method injection поддерживается Laravel только в специальных «точках входа» (контроллеры, обработчики). Метод обычного класса (<code>$service-&gt;process($data, Mailer $mailer)</code>) не получит автоматического разрешения параметров. Используйте конструктор или явный вызов <code>app(Mailer::class)</code>.
    </div>
    <div class="pitfall">
      <strong>4. <code>app()</code> внутри метода вместо constructor injection.</strong> Это Service Locator-антипаттерн. Класс становится зависимым от глобального состояния контейнера. Симптомы &mdash; невозможность создать класс без полностью загруженного фреймворка, скрытые зависимости, сложные тесты. Корректно &mdash; всегда объявлять зависимости в конструкторе.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     BIND BASIC
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-bind-basic" class="section">
  <div class="section-title">bind, singleton, instance</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Регистрация связи между ключом и конкретной реализацией &mdash; основное действие, которое выполняется в сервис-провайдерах. От выбора метода регистрации зависит, как часто будет создаваться экземпляр, разделяется ли он между потребителями и каким образом конкретный класс получит свои зависимости.</p>
    <p class="text">Laravel предоставляет три базовых метода: <code>bind()</code> для transient-сервисов (каждое разрешение &mdash; новый экземпляр), <code>singleton()</code> для разделяемых сервисов (один экземпляр на весь запрос), <code>instance()</code> для регистрации уже созданного объекта. Выбор зависит от природы сервиса: stateless-сервис без побочных эффектов выгоднее singleton, stateful или дорогой в создании &mdash; transient.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Методы регистрации</div>

    <div class="card">
      <h3><code>bind($abstract, $concrete = null, $shared = false)</code></h3>
      <p class="text">Регистрирует transient-связь. Каждый вызов <code>app()-&gt;make($abstract)</code> создаёт новый экземпляр. Применяется для сервисов с внутренним состоянием, которое не должно делиться между потребителями, либо когда стоимость создания низка.</p>
<pre><code><span class="c-comment">// Простейший вариант — интерфейс на класс.</span>
<span class="c-fn">app</span>()-><span class="c-fn">bind</span>(<span class="c-type">Mailer</span>::<span class="c-key">class</span>, <span class="c-type">SmtpMailer</span>::<span class="c-key">class</span>);

<span class="c-comment">// С замыканием — когда требуется кастомная логика создания.</span>
<span class="c-fn">app</span>()-><span class="c-fn">bind</span>(<span class="c-type">Mailer</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">Container</span> <span class="c-var">$app</span>) {
    <span class="c-var">$config</span> = <span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">Repository</span>::<span class="c-key">class</span>)-><span class="c-fn">get</span>(<span class="c-str">'mail'</span>);
    <span class="c-key">return new</span> <span class="c-type">SmtpMailer</span>(<span class="c-var">$config</span>[<span class="c-str">'host'</span>], <span class="c-var">$config</span>[<span class="c-str">'port'</span>]);
});

<span class="c-comment">// Если abstract совпадает с concrete, второй параметр опускается.</span>
<span class="c-fn">app</span>()-><span class="c-fn">bind</span>(<span class="c-type">UserService</span>::<span class="c-key">class</span>);
<span class="c-comment">// Эквивалентно явному bind(UserService::class, UserService::class).</span>
</code></pre>
      <p class="text">Метод <code>bindIf()</code> регистрирует связь только если для указанного abstract ещё нет регистрации. Применяется в библиотечном коде, чтобы не перезаписывать пользовательскую конфигурацию.</p>
    </div>

    <div class="card">
      <h3><code>singleton($abstract, $concrete = null)</code></h3>
      <p class="text">Регистрирует singleton-связь. При первом <code>make()</code> экземпляр создаётся; все последующие вызовы возвращают тот же объект до окончания запроса.</p>
<pre><code><span class="c-comment">// Кэширующий сервис с внутренним состоянием — singleton по природе.</span>
<span class="c-fn">app</span>()-><span class="c-fn">singleton</span>(<span class="c-type">RedisStore</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">Container</span> <span class="c-var">$app</span>) {
    <span class="c-key">return new</span> <span class="c-type">RedisStore</span>(
        host: <span class="c-fn">config</span>(<span class="c-str">'redis.host'</span>),
        port: <span class="c-fn">config</span>(<span class="c-str">'redis.port'</span>),
        prefix: <span class="c-fn">config</span>(<span class="c-str">'cache.prefix'</span>),
    );
});

<span class="c-var">$store1</span> = <span class="c-fn">app</span>(<span class="c-type">RedisStore</span>::<span class="c-key">class</span>);
<span class="c-var">$store2</span> = <span class="c-fn">app</span>(<span class="c-type">RedisStore</span>::<span class="c-key">class</span>);
<span class="c-comment">// $store1 === $store2 — одно подключение на запрос.</span>
</code></pre>
      <p class="text">Метод <code>singletonIf()</code> &mdash; идемпотентный аналог. <code>bindMethod()</code> позволяет переопределить способ вызова метода (используется при <code>$container-&gt;call()</code>).</p>
    </div>

    <div class="card">
      <h3><code>instance($abstract, $instance)</code></h3>
      <p class="text">Регистрирует уже существующий экземпляр. В отличие от <code>singleton</code>, объект создаётся вне контейнера и просто передаётся в него. Главное применение &mdash; тесты: подменить реальный сервис на mock, fake или stub.</p>
<pre><code><span class="c-comment">// В тесте</span>
<span class="c-key">public function</span> <span class="c-fn">test_order_uses_mocked_payment</span>(): <span class="c-key">void</span>
{
    <span class="c-var">$mock</span> = <span class="c-key">new class</span> <span class="c-key">implements</span> <span class="c-type">PaymentGateway</span> {
        <span class="c-key">public function</span> <span class="c-fn">charge</span>(<span class="c-key">int</span> <span class="c-var">$amount</span>, <span class="c-key">string</span> <span class="c-var">$currency</span>): <span class="c-type">ChargeResult</span>
        {
            <span class="c-key">return new</span> <span class="c-type">ChargeResult</span>(success: <span class="c-key">true</span>, id: <span class="c-str">'fake-123'</span>);
        }
    };

    <span class="c-fn">app</span>()-><span class="c-fn">instance</span>(<span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>, <span class="c-var">$mock</span>);

    <span class="c-comment">// Любой код, запрашивающий PaymentGateway из контейнера,</span>
    <span class="c-comment">// получит этот fake вместо реального Stripe.</span>
    <span class="c-var">$response</span> = <span class="c-var">$this</span>-><span class="c-fn">postJson</span>(<span class="c-str">'/orders'</span>, [...]);
    <span class="c-var">$response</span>-><span class="c-fn">assertStatus</span>(<span class="c-num">201</span>);
}
</code></pre>
    </div>

    <div class="card">
      <h3>Сводная таблица</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>Когда создаётся</th><th>Сколько экземпляров</th><th>Применение</th></tr>
        <tr><td><code>bind</code></td><td>При каждом <code>make</code></td><td>Новый каждый раз</td><td>Stateful сервисы, fluent-объекты, lightweight классы</td></tr>
        <tr><td><code>singleton</code></td><td>При первом <code>make</code></td><td>Один на весь запрос</td><td>Stateless-сервисы, подключения к БД/Redis, конфигурация</td></tr>
        <tr><td><code>instance</code></td><td>Снаружи контейнера</td><td>Один указанный</td><td>Тесты, runtime-замена сервиса, ранее созданный объект</td></tr>
        <tr><td><code>bindIf</code> / <code>singletonIf</code></td><td>Идемпотентно</td><td>Зависит от вызова</td><td>Библиотечный код, default-регистрация без перезаписи</td></tr>
      </table>
    </div>

    <div class="card">
      <h3>Что выбирать: singleton или bind</h3>
      <p class="text">Правило: <strong>singleton, если сервис stateless</strong> (внутреннее состояние не накапливается, методы не оставляют побочных эффектов в свойствах). В этом случае повторное создание экземпляра было бы пустой тратой ресурсов.</p>
      <p class="text"><strong>bind (transient), если сервис содержит состояние</strong>, которое не должно делиться между потребителями. Примеры: построитель запросов (каждый запрос &mdash; новый builder с собственными условиями), value object с изменяемыми полями, временный кэш в рамках одной операции.</p>
      <p class="text">В подавляющем большинстве случаев в Laravel-приложении сервисы &mdash; stateless, поэтому singleton используется чаще, чем bind.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: репозитории и сервисы для онлайн-магазина</div>
    <p class="text">Рассмотрим регистрацию типового набора сервисов магазина: репозитории (transient), кэш-менеджер (singleton), runtime-конфигурация (instance). Все регистрации выполняются в <code>AppServiceProvider</code> или специализированных провайдерах.</p>

<pre><code><span class="c-key">namespace</span> <span class="c-type">App\Providers</span>;

<span class="c-key">use</span> <span class="c-type">App\Cache\StoreCacheManager</span>;
<span class="c-key">use</span> <span class="c-type">App\Contracts\Catalog\ProductRepository</span>;
<span class="c-key">use</span> <span class="c-type">App\Contracts\Pricing\PriceCalculator</span>;
<span class="c-key">use</span> <span class="c-type">App\Repositories\EloquentProductRepository</span>;
<span class="c-key">use</span> <span class="c-type">App\Services\Pricing\DefaultPriceCalculator</span>;
<span class="c-key">use</span> <span class="c-type">App\Services\Pricing\StoreFeatures</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Contracts\Container\Container</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\ServiceProvider</span>;

<span class="c-key">class</span> <span class="c-type">CatalogServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// 1. Репозиторий — transient. Каждый запрос строит свой query builder.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">bind</span>(<span class="c-type">ProductRepository</span>::<span class="c-key">class</span>, <span class="c-type">EloquentProductRepository</span>::<span class="c-key">class</span>);

        <span class="c-comment">// 2. Кэш-менеджер — singleton. Дорогое соединение к Redis</span>
        <span class="c-comment">//    переиспользуется в течение запроса.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">StoreCacheManager</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">Container</span> <span class="c-var">$app</span>) {
            <span class="c-key">return new</span> <span class="c-type">StoreCacheManager</span>(
                redis: <span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-str">'redis.connection'</span>),
                prefix: <span class="c-fn">config</span>(<span class="c-str">'cache.prefix'</span>),
                defaultTtl: <span class="c-num">3600</span>,
            );
        });

        <span class="c-comment">// 3. Калькулятор цен — singleton, потому что использует кэш и не имеет состояния.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">PriceCalculator</span>::<span class="c-key">class</span>, <span class="c-type">DefaultPriceCalculator</span>::<span class="c-key">class</span>);

        <span class="c-comment">// 4. Runtime-конфигурация фич — instance, потому что объект собирается</span>
        <span class="c-comment">//    из конфига при boot приложения.</span>
        <span class="c-var">$features</span> = <span class="c-key">new</span> <span class="c-type">StoreFeatures</span>(<span class="c-fn">config</span>(<span class="c-str">'store.features'</span>, []));
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">instance</span>(<span class="c-type">StoreFeatures</span>::<span class="c-key">class</span>, <span class="c-var">$features</span>);
    }
}
</code></pre>

    <p class="text">Использование в коде:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">ProductController</span>
{
    <span class="c-comment">// Все четыре зависимости автоматически разрешатся контейнером.</span>
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private readonly</span> <span class="c-type">ProductRepository</span> <span class="c-var">$repository</span>,
        <span class="c-key">private readonly</span> <span class="c-type">StoreCacheManager</span> <span class="c-var">$cache</span>,
        <span class="c-key">private readonly</span> <span class="c-type">PriceCalculator</span> <span class="c-var">$pricing</span>,
        <span class="c-key">private readonly</span> <span class="c-type">StoreFeatures</span> <span class="c-var">$features</span>,
    ) {}

    <span class="c-key">public function</span> <span class="c-fn">show</span>(<span class="c-key">int</span> <span class="c-var">$id</span>): <span class="c-type">View</span>
    {
        <span class="c-var">$product</span> = <span class="c-var">$this</span>-><span class="c-var">cache</span>-><span class="c-fn">remember</span>(<span class="c-str">"product.{$id}"</span>,
            <span class="c-key">fn</span> () =&gt; <span class="c-var">$this</span>-><span class="c-var">repository</span>-><span class="c-fn">findOrFail</span>(<span class="c-var">$id</span>));

        <span class="c-key">return</span> <span class="c-fn">view</span>(<span class="c-str">'product.show'</span>, [
            <span class="c-str">'product'</span>     =&gt; <span class="c-var">$product</span>,
            <span class="c-str">'final_price'</span> =&gt; <span class="c-var">$this</span>-><span class="c-var">pricing</span>-><span class="c-fn">calculate</span>(<span class="c-var">$product</span>),
            <span class="c-str">'show_promo'</span>  =&gt; <span class="c-var">$this</span>-><span class="c-var">features</span>-><span class="c-fn">enabled</span>(<span class="c-str">'promo-banner'</span>),
        ]);
    }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. Singleton с состоянием в Octane.</strong> Laravel Octane (Swoole, RoadRunner, FrankenPHP) держит приложение в памяти между запросами. Singleton с накапливаемым состоянием (счётчик внутри, кэш в свойстве) будет «утекать» между запросами разных пользователей. Все singleton в Octane должны быть строго stateless либо сбрасывать состояние через метод <code>flush</code> на событиях <code>RequestReceived</code>/<code>RequestTerminated</code>.
    </div>
    <div class="pitfall">
      <strong>2. Замыкание-фабрика и singleton.</strong> Замыкание в <code>singleton()</code> вызывается ровно один раз &mdash; при первом <code>make</code>. Если в замыкании используется состояние, доступное только при определённых условиях (текущий пользователь, тенант), и при первом разрешении это состояние не было установлено, singleton навсегда зафиксирует «дефолтное» значение. Для контекстно-зависимых сервисов используйте transient или scoped.
    </div>
    <div class="pitfall">
      <strong>3. <code>instance</code> не вызывает <code>resolving</code>-колбэки.</strong> Если на сервис зарегистрированы <code>app()-&gt;resolving($abstract, fn() =&gt; ...)</code>, для объекта, переданного через <code>instance()</code>, они <strong>не выполнятся</strong> &mdash; объект уже создан вне контейнера. Это нужно учитывать при подмене сервисов в тестах.
    </div>
    <div class="pitfall">
      <strong>4. <code>bind</code> с дорогими операциями в замыкании.</strong> Если замыкание открывает соединение или читает большой файл, transient-bind будет повторять это при каждом <code>make</code>. Скорее всего такому сервису место в <code>singleton</code>.
    </div>
    <div class="pitfall">
      <strong>5. Сложные графы зависимостей в замыкании.</strong> Замыкание-фабрика быстро превращается в свалку: <code>new A(new B(new C(...)))</code>. Лучше извлекать зависимости через <code>$app-&gt;make(...)</code>, чтобы каждая участвующая зависимость собиралась контейнером:
<pre style="margin-top:8px;margin-bottom:0;"><code><span class="c-fn">app</span>()-><span class="c-fn">singleton</span>(<span class="c-type">OrderService</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">Container</span> <span class="c-var">$app</span>) {
    <span class="c-key">return new</span> <span class="c-type">OrderService</span>(
        <span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>),
        <span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">InventoryService</span>::<span class="c-key">class</span>),
    );
});</code></pre>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     SCOPED BINDINGS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-bind-scoped" class="section">
  <div class="section-title">Scoped bindings</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Scoped binding &mdash; промежуточный по поведению режим между <code>bind</code> и <code>singleton</code>. Сервис создаётся один раз в рамках определённого «жизненного цикла» и сбрасывается при его завершении. В Laravel scoped введён ради совместимости с Octane и подобными окружениями, где приложение живёт между запросами и singleton может «протечь» из одного запроса в другой.</p>
    <p class="text">В классическом PHP-FPM (запрос &mdash; отдельный процесс) разницы между <code>singleton</code> и <code>scoped</code> нет: оба переживают весь запрос и уничтожаются вместе с процессом. В Octane разница принципиальна: singleton сохраняется на всё время жизни worker-процесса (минуты, часы), scoped &mdash; только на длительность одного HTTP-запроса. Контейнер автоматически вызывает <code>forgetScopedInstances()</code> между запросами.</p>
    <p class="text">Тот же механизм применяется в long-running сценариях вне HTTP: очереди (job &mdash; «область»), Artisan-команды с большим обходом данных, тесты с <code>RefreshDatabase</code>. Везде, где сервис должен быть «свежим» для каждой логической операции, но при этом разделяться между шагами этой операции, применяется scoped.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Методы и поведение</div>

    <div class="card">
      <h3><code>scoped($abstract, $concrete = null)</code></h3>
      <p class="text">Регистрирует сервис, который создаётся при первом разрешении внутри текущей «области» (scope) и переиспользуется до сброса области. По умолчанию область совпадает с запросом в Octane / queue-job / тестом.</p>
<pre><code><span class="c-fn">app</span>()-><span class="c-fn">scoped</span>(<span class="c-type">RequestContext</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">Container</span> <span class="c-var">$app</span>) {
    <span class="c-key">return new</span> <span class="c-type">RequestContext</span>(
        userId: <span class="c-fn">auth</span>()-><span class="c-fn">id</span>(),
        tenantId: <span class="c-fn">app</span>(<span class="c-type">TenantManager</span>::<span class="c-key">class</span>)-><span class="c-fn">currentId</span>(),
        traceId: (<span class="c-key">string</span>) <span class="c-type">Str</span>::<span class="c-fn">uuid</span>(),
    );
});

<span class="c-comment">// В рамках одного запроса все обращения возвращают тот же объект.</span>
<span class="c-var">$ctx1</span> = <span class="c-fn">app</span>(<span class="c-type">RequestContext</span>::<span class="c-key">class</span>);
<span class="c-var">$ctx2</span> = <span class="c-fn">app</span>(<span class="c-type">RequestContext</span>::<span class="c-key">class</span>);
<span class="c-comment">// $ctx1 === $ctx2</span>

<span class="c-comment">// При начале следующего запроса контейнер вызовет forgetScopedInstances()</span>
<span class="c-comment">// и при следующем make создаст новый RequestContext с актуальными значениями.</span>
</code></pre>
    </div>

    <div class="card">
      <h3><code>scopedIf($abstract, $concrete = null)</code></h3>
      <p class="text">Идемпотентный вариант: регистрирует scoped-binding только если для abstract ещё нет регистрации. Используется в пакетах и провайдерах, чтобы не перезаписать пользовательскую настройку.</p>
    </div>

    <div class="card">
      <h3><code>forgetScopedInstances()</code></h3>
      <p class="text">Сбрасывает все scoped-инстансы. В Octane вызывается автоматически между запросами; в собственном long-running коде (Artisan-команды, обработчики очередей) можно вызывать вручную при переходе к новой логической области.</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">handle</span>(): <span class="c-key">void</span>
{
    <span class="c-key">foreach</span> (<span class="c-type">Tenant</span>::<span class="c-fn">all</span>() <span class="c-key">as</span> <span class="c-var">$tenant</span>) {
        <span class="c-fn">app</span>(<span class="c-type">TenantManager</span>::<span class="c-key">class</span>)-><span class="c-fn">setCurrent</span>(<span class="c-var">$tenant</span>);

        <span class="c-comment">// Каждая итерация — новая область:</span>
        <span class="c-comment">// сбрасываем scoped, чтобы RequestContext построился под нового тенанта.</span>
        <span class="c-fn">app</span>()-><span class="c-fn">forgetScopedInstances</span>();

        <span class="c-var">$this</span>-><span class="c-fn">processForTenant</span>();
    }
}
</code></pre>
    </div>

    <div class="card">
      <h3>Сравнение singleton, scoped, bind</h3>
      <table class="data-table">
        <tr><th>Аспект</th><th><code>bind</code></th><th><code>scoped</code></th><th><code>singleton</code></th></tr>
        <tr><td>Время жизни</td><td>Один make</td><td>До <code>forgetScopedInstances</code></td><td>Всё время приложения</td></tr>
        <tr><td>Поведение в PHP-FPM</td><td>Новый каждый make</td><td>Один на запрос</td><td>Один на запрос (то же что scoped)</td></tr>
        <tr><td>Поведение в Octane</td><td>Новый каждый make</td><td>Один на HTTP-запрос</td><td>Один на worker-процесс (опасно для state)</td></tr>
        <tr><td>Использование</td><td>Stateful, fluent, lightweight</td><td>Контекст запроса, transaction-scope</td><td>Stateless connections, конфиги, регистры</td></tr>
      </table>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: контекст запроса в мультитенантном приложении</div>
    <p class="text">Рассмотрим SaaS-приложение в Octane, где для каждого HTTP-запроса нужен свежий объект <code>TenantContext</code> с идентификатором арендатора, текущим пользователем и trace-id для логирования. В обычных условиях этот объект использовался бы как singleton, но в Octane между запросами разных тенантов состояние утекало бы. <code>scoped</code> решает проблему.</p>

<pre><code><span class="c-key">namespace</span> <span class="c-type">App\Tenancy</span>;

<span class="c-key">final class</span> <span class="c-type">TenantContext</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">public readonly</span> <span class="c-key">int</span> <span class="c-var">$tenantId</span>,
        <span class="c-key">public readonly</span> ?<span class="c-key">int</span> <span class="c-var">$userId</span>,
        <span class="c-key">public readonly</span> <span class="c-key">string</span> <span class="c-var">$traceId</span>,
        <span class="c-key">public readonly</span> <span class="c-type">Carbon</span> <span class="c-var">$startedAt</span>,
    ) {}
}

<span class="c-comment">// app/Providers/TenancyServiceProvider.php</span>
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\ServiceProvider</span>;

<span class="c-key">class</span> <span class="c-type">TenancyServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">scoped</span>(<span class="c-type">TenantContext</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">Container</span> <span class="c-var">$app</span>) {
            <span class="c-var">$resolver</span> = <span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">TenantResolver</span>::<span class="c-key">class</span>);

            <span class="c-key">return new</span> <span class="c-type">TenantContext</span>(
                tenantId: <span class="c-var">$resolver</span>-><span class="c-fn">currentTenantId</span>() ?? <span class="c-key">throw new</span> <span class="c-type">RuntimeException</span>(<span class="c-str">'Tenant not resolved'</span>),
                userId:   <span class="c-fn">auth</span>()-><span class="c-fn">id</span>(),
                traceId:  (<span class="c-key">string</span>) <span class="c-type">Str</span>::<span class="c-fn">uuid</span>(),
                startedAt: <span class="c-fn">now</span>(),
            );
        });
    }
}

<span class="c-comment">// Использование в коде</span>
<span class="c-key">class</span> <span class="c-type">AuditLogger</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private readonly</span> <span class="c-type">TenantContext</span> <span class="c-var">$context</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">record</span>(<span class="c-key">string</span> <span class="c-var">$action</span>, <span class="c-key">array</span> <span class="c-var">$payload</span> = []): <span class="c-key">void</span>
    {
        <span class="c-type">AuditEntry</span>::<span class="c-fn">create</span>([
            <span class="c-str">'tenant_id'</span> =&gt; <span class="c-var">$this</span>-><span class="c-var">context</span>-><span class="c-var">tenantId</span>,
            <span class="c-str">'user_id'</span>   =&gt; <span class="c-var">$this</span>-><span class="c-var">context</span>-><span class="c-var">userId</span>,
            <span class="c-str">'trace_id'</span>  =&gt; <span class="c-var">$this</span>-><span class="c-var">context</span>-><span class="c-var">traceId</span>,
            <span class="c-str">'action'</span>    =&gt; <span class="c-var">$action</span>,
            <span class="c-str">'payload'</span>   =&gt; <span class="c-var">$payload</span>,
        ]);
    }
}
</code></pre>

    <p class="text">Поведение в трёх окружениях:</p>
    <ul class="bullets">
      <li><strong>PHP-FPM:</strong> процесс создаётся под запрос и уничтожается после ответа. Singleton и scoped работают одинаково.</li>
      <li><strong>Octane:</strong> worker-процесс живёт долго. На каждый HTTP-запрос Octane вызывает <code>app()-&gt;forgetScopedInstances()</code>; <code>TenantContext</code> пересоздаётся с актуальным тенантом. Singleton сохранил бы первый созданный контекст и применял его ко всем последующим тенантам.</li>
      <li><strong>Queue worker:</strong> длительный процесс, обрабатывающий jobs последовательно. Laravel сбрасывает scoped перед обработкой каждого job, поэтому job получает свой контекст.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. scoped в PHP-FPM не даёт ничего нового.</strong> Если проект работает только в классическом PHP-FPM, <code>scoped</code> ведёт себя идентично <code>singleton</code>. Различие проявится только при переходе на Octane или подобные long-running окружения. Регистрировать сервисы как scoped имеет смысл превентивно &mdash; чтобы будущий переход не сломал поведение.
    </div>
    <div class="pitfall">
      <strong>2. Ошибочное использование scoped в Artisan-командах.</strong> Долгая команда без вызова <code>forgetScopedInstances</code> между итерациями будет хранить тот же scoped-инстанс на всём её выполнении. Если контекст должен меняться (например, обход тенантов), необходимо явно сбрасывать область.
    </div>
    <div class="pitfall">
      <strong>3. Сохранённый scoped-сервис в singleton.</strong> Если singleton получает scoped-инстанс через конструктор, он «зацепляет» его навсегда. В Octane следующий запрос получит singleton с указанием на старый scoped-объект. Singleton не должен хранить ссылки на scoped и transient зависимости; для разделяемых ссылок применяется поздняя резолюция через <code>app()</code> внутри метода или передача через аргумент.
    </div>
    <div class="pitfall">
      <strong>4. Тесты и scoped.</strong> При выполнении тестов между тестами обычно сбрасывается состояние через trait <code>RefreshDatabase</code>. Однако scoped-инстансы контейнера не сбрасываются автоматически. При необходимости вызовите <code>app()-&gt;forgetScopedInstances()</code> в <code>setUp()</code> тестового класса.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     CONTEXTUAL BINDING
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-bind-contextual" class="section">
  <div class="section-title">Contextual binding</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Contextual binding (контекстное связывание) позволяет регистрировать разные реализации одного интерфейса для разных потребителей. Если двум классам нужен один и тот же интерфейс <code>Filesystem</code>, но первому &mdash; локальный диск, а второму &mdash; S3, контекстный binding это решает декларативно, без нагромождения условий внутри классов.</p>
    <p class="text">Без контекстного binding пришлось бы либо передавать конкретную реализацию вручную в каждый класс (нарушая DI), либо помещать логику выбора реализации внутрь самих классов через <code>config('app.driver')</code> или Service Locator. Контекстный binding выносит решение «какая реализация для какого класса» в провайдер, где оно концентрируется в одном месте.</p>
    <p class="text">Метод сложнее <code>bind/singleton</code> по синтаксису, но даёт мощную гибкость для архитектурных задач: разделение драйверов между разными частями приложения, разные конфигурации для контекстов «писатель/читатель», подмена реализаций в специальных контроллерах (например, admin-панели с расширенными правами).</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Синтаксис и варианты</div>

    <div class="card">
      <h3><code>when()-&gt;needs()-&gt;give()</code> &mdash; основной паттерн</h3>
      <p class="text">Цепочка читается как фраза: «когда контейнер создаёт <code>$class</code> и тот нуждается в <code>$abstract</code>, дай ему <code>$concrete</code>».</p>
<pre><code><span class="c-fn">app</span>()-><span class="c-fn">when</span>(<span class="c-type">PhotoController</span>::<span class="c-key">class</span>)
    -><span class="c-fn">needs</span>(<span class="c-type">Filesystem</span>::<span class="c-key">class</span>)
    -><span class="c-fn">give</span>(<span class="c-key">function</span> () {
        <span class="c-key">return</span> <span class="c-type">Storage</span>::<span class="c-fn">disk</span>(<span class="c-str">'s3-photos'</span>);
    });

<span class="c-fn">app</span>()-><span class="c-fn">when</span>(<span class="c-type">VideoController</span>::<span class="c-key">class</span>)
    -><span class="c-fn">needs</span>(<span class="c-type">Filesystem</span>::<span class="c-key">class</span>)
    -><span class="c-fn">give</span>(<span class="c-key">function</span> () {
        <span class="c-key">return</span> <span class="c-type">Storage</span>::<span class="c-fn">disk</span>(<span class="c-str">'s3-videos'</span>);
    });
</code></pre>
      <p class="text">Оба контроллера в конструкторе объявляют <code>Filesystem $files</code>, но получают разные диски &mdash; в зависимости от того, какой контроллер создаёт контейнер.</p>
    </div>

    <div class="card">
      <h3>Несколько потребителей &mdash; массив</h3>
      <p class="text">Если одна и та же контекстная связка нужна для нескольких классов, первым аргументом <code>when()</code> передаётся массив имён.</p>
<pre><code><span class="c-fn">app</span>()-><span class="c-fn">when</span>([<span class="c-type">PhotoUploadJob</span>::<span class="c-key">class</span>, <span class="c-type">PhotoCleanupCommand</span>::<span class="c-key">class</span>])
    -><span class="c-fn">needs</span>(<span class="c-type">Filesystem</span>::<span class="c-key">class</span>)
    -><span class="c-fn">give</span>(<span class="c-key">fn</span> () =&gt; <span class="c-type">Storage</span>::<span class="c-fn">disk</span>(<span class="c-str">'photos'</span>));
</code></pre>
    </div>

    <div class="card">
      <h3>Контекстный binding по имени параметра</h3>
      <p class="text">Иногда требуется привязка не по типу зависимости, а по имени параметра конструктора &mdash; для скаляров и строк, которые не имеют типа-интерфейса.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">StripeGateway</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private</span> <span class="c-key">string</span> <span class="c-var">$apiKey</span>,
        <span class="c-key">private</span> <span class="c-key">string</span> <span class="c-var">$webhookSecret</span>,
    ) {}
}

<span class="c-fn">app</span>()-><span class="c-fn">when</span>(<span class="c-type">StripeGateway</span>::<span class="c-key">class</span>)
    -><span class="c-fn">needs</span>(<span class="c-str">'$apiKey'</span>)
    -><span class="c-fn">give</span>(<span class="c-fn">config</span>(<span class="c-str">'services.stripe.key'</span>));

<span class="c-fn">app</span>()-><span class="c-fn">when</span>(<span class="c-type">StripeGateway</span>::<span class="c-key">class</span>)
    -><span class="c-fn">needs</span>(<span class="c-str">'$webhookSecret'</span>)
    -><span class="c-fn">give</span>(<span class="c-fn">config</span>(<span class="c-str">'services.stripe.webhook_secret'</span>));
</code></pre>
      <p class="text">Префикс <code>$</code> в имени отделяет «primitive»-зависимости от типизированных. Альтернатива &mdash; передавать значения через замыкание-фабрику в обычном <code>bind</code>, но контекстный binding по имени параметра делает интенцию явной.</p>
    </div>

    <div class="card">
      <h3><code>giveTagged()</code> &mdash; передача набора tagged-сервисов</h3>
      <p class="text">Если потребитель ожидает iterable набор однотипных сервисов (например, валидаторы, фильтры, обработчики), и эти сервисы зарегистрированы под общим тегом, в контекстном binding можно передать всю группу одной строкой.</p>
<pre><code><span class="c-comment">// Сначала регистрируем валидаторы под общим тегом:</span>
<span class="c-fn">app</span>()-><span class="c-fn">bind</span>(<span class="c-type">EmailValidator</span>::<span class="c-key">class</span>);
<span class="c-fn">app</span>()-><span class="c-fn">bind</span>(<span class="c-type">PhoneValidator</span>::<span class="c-key">class</span>);
<span class="c-fn">app</span>()-><span class="c-fn">tag</span>([<span class="c-type">EmailValidator</span>::<span class="c-key">class</span>, <span class="c-type">PhoneValidator</span>::<span class="c-key">class</span>], <span class="c-str">'contact-validators'</span>);

<span class="c-comment">// Теперь передаём всю группу в нужный класс:</span>
<span class="c-fn">app</span>()-><span class="c-fn">when</span>(<span class="c-type">RegistrationService</span>::<span class="c-key">class</span>)
    -><span class="c-fn">needs</span>(<span class="c-type">Validator</span>::<span class="c-key">class</span>)
    -><span class="c-fn">giveTagged</span>(<span class="c-str">'contact-validators'</span>);
</code></pre>
      <p class="text">Подробнее о тегах &mdash; в подразделе «Tagged services».</p>
    </div>

    <div class="card">
      <h3><code>giveConfig()</code> &mdash; значение из конфигурации</h3>
      <p class="text">Сокращённый способ передать значение из <code>config()</code> в primitive-параметр без оборачивания в замыкание.</p>
<pre><code><span class="c-fn">app</span>()-><span class="c-fn">when</span>(<span class="c-type">PaymentService</span>::<span class="c-key">class</span>)
    -><span class="c-fn">needs</span>(<span class="c-str">'$apiKey'</span>)
    -><span class="c-fn">giveConfig</span>(<span class="c-str">'services.payment.key'</span>);
</code></pre>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: разные диски для разных модулей</div>
    <p class="text">В медиа-приложении одно и то же приложение работает с несколькими хранилищами: фото &mdash; в S3 bucket <code>media-photos</code>, видео &mdash; в <code>media-videos</code> (часто другой регион из-за объёмов), временные файлы &mdash; в локальной директории, экспортированные отчёты &mdash; в защищённом S3 bucket. Контроллеры и сервисы каждой подсистемы объявляют в конструкторе <code>Filesystem</code>, но получают разные реализации.</p>

<pre><code><span class="c-key">namespace</span> <span class="c-type">App\Providers</span>;

<span class="c-key">use</span> <span class="c-type">App\Console\Commands\GenerateReports</span>;
<span class="c-key">use</span> <span class="c-type">App\Http\Controllers\PhotoController</span>;
<span class="c-key">use</span> <span class="c-type">App\Http\Controllers\VideoController</span>;
<span class="c-key">use</span> <span class="c-type">App\Jobs\ProcessImportFile</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Contracts\Filesystem\Filesystem</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Storage</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\ServiceProvider</span>;

<span class="c-key">class</span> <span class="c-type">StorageBindingsProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// Фото-модуль: чтение и запись через PhotoController, PhotoUploadJob.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">when</span>([<span class="c-type">PhotoController</span>::<span class="c-key">class</span>, <span class="c-type">PhotoUploadJob</span>::<span class="c-key">class</span>])
            -><span class="c-fn">needs</span>(<span class="c-type">Filesystem</span>::<span class="c-key">class</span>)
            -><span class="c-fn">give</span>(<span class="c-key">fn</span> () =&gt; <span class="c-type">Storage</span>::<span class="c-fn">disk</span>(<span class="c-str">'media-photos'</span>));

        <span class="c-comment">// Видео-модуль: отдельный bucket в другом регионе.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">when</span>(<span class="c-type">VideoController</span>::<span class="c-key">class</span>)
            -><span class="c-fn">needs</span>(<span class="c-type">Filesystem</span>::<span class="c-key">class</span>)
            -><span class="c-fn">give</span>(<span class="c-key">fn</span> () =&gt; <span class="c-type">Storage</span>::<span class="c-fn">disk</span>(<span class="c-str">'media-videos'</span>));

        <span class="c-comment">// Импорт-задачи работают с локальной временной директорией.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">when</span>(<span class="c-type">ProcessImportFile</span>::<span class="c-key">class</span>)
            -><span class="c-fn">needs</span>(<span class="c-type">Filesystem</span>::<span class="c-key">class</span>)
            -><span class="c-fn">give</span>(<span class="c-key">fn</span> () =&gt; <span class="c-type">Storage</span>::<span class="c-fn">disk</span>(<span class="c-str">'imports'</span>));

        <span class="c-comment">// Отчёты: защищённое хранилище с приватными ссылками.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">when</span>(<span class="c-type">GenerateReports</span>::<span class="c-key">class</span>)
            -><span class="c-fn">needs</span>(<span class="c-type">Filesystem</span>::<span class="c-key">class</span>)
            -><span class="c-fn">give</span>(<span class="c-key">fn</span> () =&gt; <span class="c-type">Storage</span>::<span class="c-fn">disk</span>(<span class="c-str">'reports-private'</span>));

        <span class="c-comment">// Default для всех остальных потребителей — публичный диск.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">bind</span>(<span class="c-type">Filesystem</span>::<span class="c-key">class</span>, <span class="c-key">fn</span> () =&gt; <span class="c-type">Storage</span>::<span class="c-fn">disk</span>(<span class="c-str">'public'</span>));
    }
}
</code></pre>

    <p class="text">Каждый из контроллеров и job'ов в коде выглядит одинаково &mdash; они не знают о том, какой диск получают:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">PhotoController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private readonly</span> <span class="c-type">Filesystem</span> <span class="c-var">$files</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">UploadedFile</span> <span class="c-var">$file</span>): <span class="c-type">JsonResponse</span>
    {
        <span class="c-var">$path</span> = <span class="c-var">$this</span>-><span class="c-var">files</span>-><span class="c-fn">putFile</span>(<span class="c-str">'uploads'</span>, <span class="c-var">$file</span>);
        <span class="c-comment">// $this->files — это диск 'media-photos', хотя контроллер этого не знает.</span>
    }
}

<span class="c-key">class</span> <span class="c-type">VideoController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private readonly</span> <span class="c-type">Filesystem</span> <span class="c-var">$files</span>) {}
    <span class="c-comment">// Тот же тип зависимости, но получит другой диск.</span>
}
</code></pre>

    <p class="text">Достигнутые преимущества:</p>
    <ul class="bullets">
      <li>Контроллеры остаются простыми и тестируемыми &mdash; в тесте подменяется только bind на in-memory диск.</li>
      <li>Изменение хранилища (например, перенос фото с S3 на CloudFront) затрагивает один провайдер, не контроллеры.</li>
      <li>Можно динамически менять биндинг для конкретного контекста в feature-flag сценариях.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. Контекстный binding работает только при создании через контейнер.</strong> Если объект создан напрямую через <code>new PhotoController(...)</code>, контейнер не участвует, и контекстный binding не применяется. В Laravel это обычно не проблема (контроллеры всегда инстанцируются через контейнер), но при ручном создании в тестах учитывать обязательно.
    </div>
    <div class="pitfall">
      <strong>2. Контекст ограничен «верхним» классом.</strong> Биндинг <code>when(A)-&gt;needs(B)-&gt;give(C)</code> срабатывает только когда B запрашивается <strong>непосредственно</strong> для A. Если B запрашивает класс D, а D не упомянут в контекстном binding, D получит «дефолтную» реализацию. Контекст не распространяется глубоко по графу зависимостей.
    </div>
    <div class="pitfall">
      <strong>3. Дублирование контекстов.</strong> Когда десяти классам нужна одна и та же контекстная реализация, повторение <code>when()-&gt;needs()-&gt;give()</code> для каждого приводит к разрастанию провайдера. Решение &mdash; перечислить классы массивом в одном <code>when()</code>, либо рассмотреть рефакторинг (выделить общий интерфейс, использовать tagged).
    </div>
    <div class="pitfall">
      <strong>4. Тесты и контекстный binding.</strong> При написании тестов, использующих <code>app()-&gt;instance($abstract, $mock)</code>, контекстный binding не отключается автоматически: если в тесте подмена не учитывает контекст, мог получиться mock не от того контекста. Для полной подмены либо переопределите контекстный binding в тесте, либо используйте <code>app()-&gt;when($class)-&gt;needs($abstract)-&gt;give($mock)</code>.
    </div>
    <div class="pitfall">
      <strong>5. Order matters: дефолтный bind после контекстных.</strong> Если в провайдере сначала зарегистрирован дефолтный bind, а потом контекстные, всё работает корректно. Обратный порядок может в редких случаях привести к неожиданному переопределению. В общем случае Laravel разрешает контекст приоритетнее, но при ручной работе с контейнером порядок имеет значение.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     TAGGED SERVICES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-bind-tagged" class="section">
  <div class="section-title">Tagged services</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Tagged services &mdash; механизм группировки нескольких сервисов под общим логическим тегом для последующего получения всей группы одним вызовом. Применяется, когда приложение содержит несколько однотипных компонентов, образующих коллекцию: набор валидаторов, цепочка обработчиков команд (chain of responsibility), плагины, генераторы отчётов, экспортёры различных форматов.</p>
    <p class="text">Без тегов получение всех реализаций интерфейса требовало бы поддержки явного списка в коде или конфиге. Например, для обработки команды чата нужно знать все доступные команды; для генерации Excel-отчёта &mdash; все экспортёры. Тегирование позволяет регистрировать новые компоненты декларативно: добавил класс, отметил тегом, и существующая логика автоматически его подхватит.</p>
    <p class="text">Тег &mdash; обычная строка-идентификатор. Контейнер хранит список abstracts, помеченных конкретным тегом. При запросе <code>tagged($tag)</code> возвращается ленивый итератор, разрешающий каждый abstract в полноценный сервис.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Методы и поведение</div>

    <div class="card">
      <h3><code>tag($abstracts, $tags)</code> &mdash; добавление тегов</h3>
      <p class="text">Принимает массив abstracts (имена классов/интерфейсов) и тег или массив тегов. Можно вызывать несколько раз &mdash; накопление аддитивное.</p>
<pre><code><span class="c-comment">// Регистрация сервисов</span>
<span class="c-fn">app</span>()-><span class="c-fn">bind</span>(<span class="c-type">EmailValidator</span>::<span class="c-key">class</span>);
<span class="c-fn">app</span>()-><span class="c-fn">bind</span>(<span class="c-type">PhoneValidator</span>::<span class="c-key">class</span>);
<span class="c-fn">app</span>()-><span class="c-fn">bind</span>(<span class="c-type">AddressValidator</span>::<span class="c-key">class</span>);

<span class="c-comment">// Тегирование группой</span>
<span class="c-fn">app</span>()-><span class="c-fn">tag</span>(
    [<span class="c-type">EmailValidator</span>::<span class="c-key">class</span>, <span class="c-type">PhoneValidator</span>::<span class="c-key">class</span>, <span class="c-type">AddressValidator</span>::<span class="c-key">class</span>],
    <span class="c-str">'contact-validators'</span>
);

<span class="c-comment">// Можно повесить несколько тегов сразу</span>
<span class="c-fn">app</span>()-><span class="c-fn">tag</span>([<span class="c-type">XmlExporter</span>::<span class="c-key">class</span>], [<span class="c-str">'exporters'</span>, <span class="c-str">'serializers'</span>]);
</code></pre>
    </div>

    <div class="card">
      <h3><code>tagged($tag)</code> &mdash; получение группы</h3>
      <p class="text">Возвращает <code>RewindableGenerator</code> &mdash; ленивый итератор, разрешающий каждый из помеченных сервисов при обращении. Можно итерировать в <code>foreach</code>, превратить в массив через <code>iterator_to_array</code>.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">ContactValidationService</span>
{
    <span class="c-key">public function</span> <span class="c-fn">validateAll</span>(<span class="c-key">array</span> <span class="c-var">$data</span>): <span class="c-key">array</span>
    {
        <span class="c-var">$errors</span> = [];
        <span class="c-key">foreach</span> (<span class="c-fn">app</span>()-><span class="c-fn">tagged</span>(<span class="c-str">'contact-validators'</span>) <span class="c-key">as</span> <span class="c-var">$validator</span>) {
            <span class="c-var">$errors</span> = <span class="c-fn">array_merge</span>(<span class="c-var">$errors</span>, <span class="c-var">$validator</span>-><span class="c-fn">validate</span>(<span class="c-var">$data</span>));
        }
        <span class="c-key">return</span> <span class="c-var">$errors</span>;
    }
}
</code></pre>
    </div>

    <div class="card">
      <h3>Tagged через инъекцию в конструктор</h3>
      <p class="text">Более идиоматично &mdash; получить tagged-набор как зависимость через контекстный binding с <code>giveTagged()</code>. Это даёт тот же результат, но без обращения к контейнеру внутри метода (избегая Service Locator-антипаттерна).</p>
<pre><code><span class="c-key">class</span> <span class="c-type">ContactValidationService</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private readonly</span> <span class="c-key">iterable</span> <span class="c-var">$validators</span>,
    ) {}

    <span class="c-key">public function</span> <span class="c-fn">validateAll</span>(<span class="c-key">array</span> <span class="c-var">$data</span>): <span class="c-key">array</span>
    {
        <span class="c-var">$errors</span> = [];
        <span class="c-key">foreach</span> (<span class="c-var">$this</span>-><span class="c-var">validators</span> <span class="c-key">as</span> <span class="c-var">$validator</span>) {
            <span class="c-var">$errors</span> = <span class="c-fn">array_merge</span>(<span class="c-var">$errors</span>, <span class="c-var">$validator</span>-><span class="c-fn">validate</span>(<span class="c-var">$data</span>));
        }
        <span class="c-key">return</span> <span class="c-var">$errors</span>;
    }
}

<span class="c-comment">// В провайдере:</span>
<span class="c-fn">app</span>()-><span class="c-fn">when</span>(<span class="c-type">ContactValidationService</span>::<span class="c-key">class</span>)
    -><span class="c-fn">needs</span>(<span class="c-str">'$validators'</span>)
    -><span class="c-fn">giveTagged</span>(<span class="c-str">'contact-validators'</span>);
</code></pre>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: система экспорта отчётов в разные форматы</div>
    <p class="text">Приложение должно уметь экспортировать отчёт в несколько форматов: CSV, XLSX, JSON, PDF. Каждый формат реализован отдельным классом. Список форматов меняется со временем: добавляются новые, удаляются устаревшие. Главное требование &mdash; чтобы добавление нового формата не требовало правок в существующем коде, выбирающем формат.</p>

<pre><code><span class="c-key">namespace</span> <span class="c-type">App\Reporting\Exporters</span>;

<span class="c-key">interface</span> <span class="c-type">ReportExporter</span>
{
    <span class="c-key">public function</span> <span class="c-fn">format</span>(): <span class="c-key">string</span>;
    <span class="c-key">public function</span> <span class="c-fn">label</span>(): <span class="c-key">string</span>;
    <span class="c-key">public function</span> <span class="c-fn">export</span>(<span class="c-type">Report</span> <span class="c-var">$report</span>): <span class="c-type">StreamedResponse</span>;
}

<span class="c-key">class</span> <span class="c-type">CsvExporter</span> <span class="c-key">implements</span> <span class="c-type">ReportExporter</span>
{
    <span class="c-key">public function</span> <span class="c-fn">format</span>(): <span class="c-key">string</span>  { <span class="c-key">return</span> <span class="c-str">'csv'</span>; }
    <span class="c-key">public function</span> <span class="c-fn">label</span>(): <span class="c-key">string</span>   { <span class="c-key">return</span> <span class="c-str">'CSV (Excel)'</span>; }
    <span class="c-key">public function</span> <span class="c-fn">export</span>(<span class="c-type">Report</span> <span class="c-var">$report</span>): <span class="c-type">StreamedResponse</span>  { <span class="c-comment">/* ... */</span> }
}

<span class="c-key">class</span> <span class="c-type">XlsxExporter</span> <span class="c-key">implements</span> <span class="c-type">ReportExporter</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private readonly</span> <span class="c-type">SpreadsheetEngine</span> <span class="c-var">$engine</span>) {}
    <span class="c-key">public function</span> <span class="c-fn">format</span>(): <span class="c-key">string</span>  { <span class="c-key">return</span> <span class="c-str">'xlsx'</span>; }
    <span class="c-key">public function</span> <span class="c-fn">label</span>(): <span class="c-key">string</span>   { <span class="c-key">return</span> <span class="c-str">'Excel 2016+'</span>; }
    <span class="c-key">public function</span> <span class="c-fn">export</span>(<span class="c-type">Report</span> <span class="c-var">$report</span>): <span class="c-type">StreamedResponse</span>  { <span class="c-comment">/* ... */</span> }
}

<span class="c-comment">// Аналогично JsonExporter, PdfExporter.</span>
</code></pre>

    <p class="text">Регистрация и тегирование в провайдере:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">ReportingServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// Регистрируем каждый экспортёр как singleton (stateless по природе).</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">CsvExporter</span>::<span class="c-key">class</span>);
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">XlsxExporter</span>::<span class="c-key">class</span>);
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">JsonExporter</span>::<span class="c-key">class</span>);
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">PdfExporter</span>::<span class="c-key">class</span>);

        <span class="c-comment">// Помечаем общим тегом для последующей итерации.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">tag</span>(
            [
                <span class="c-type">CsvExporter</span>::<span class="c-key">class</span>,
                <span class="c-type">XlsxExporter</span>::<span class="c-key">class</span>,
                <span class="c-type">JsonExporter</span>::<span class="c-key">class</span>,
                <span class="c-type">PdfExporter</span>::<span class="c-key">class</span>,
            ],
            <span class="c-str">'report-exporters'</span>
        );

        <span class="c-comment">// Менеджер экспорта получает всю группу через giveTagged.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">when</span>(<span class="c-type">ReportExportManager</span>::<span class="c-key">class</span>)
            -><span class="c-fn">needs</span>(<span class="c-str">'$exporters'</span>)
            -><span class="c-fn">giveTagged</span>(<span class="c-str">'report-exporters'</span>);
    }
}
</code></pre>

    <p class="text">Менеджер экспорта, использующий tagged-группу:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">ReportExportManager</span>
{
    <span class="c-comment">// Индексированный по формату массив экспортёров.</span>
    <span class="c-key">private readonly</span> <span class="c-key">array</span> <span class="c-var">$byFormat</span>;

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">iterable</span> <span class="c-var">$exporters</span>)
    {
        <span class="c-var">$this</span>-><span class="c-var">byFormat</span> = <span class="c-fn">collect</span>(<span class="c-var">$exporters</span>)
            -><span class="c-fn">keyBy</span>(<span class="c-key">fn</span> (<span class="c-type">ReportExporter</span> <span class="c-var">$e</span>) =&gt; <span class="c-var">$e</span>-><span class="c-fn">format</span>())
            -><span class="c-fn">all</span>();
    }

    <span class="c-key">public function</span> <span class="c-fn">available</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> <span class="c-fn">collect</span>(<span class="c-var">$this</span>-><span class="c-var">byFormat</span>)
            -><span class="c-fn">map</span>(<span class="c-key">fn</span> (<span class="c-type">ReportExporter</span> <span class="c-var">$e</span>) =&gt; <span class="c-var">$e</span>-><span class="c-fn">label</span>())
            -><span class="c-fn">all</span>();
        <span class="c-comment">// → ['csv' => 'CSV (Excel)', 'xlsx' => 'Excel 2016+', 'json' => 'JSON', 'pdf' => 'PDF']</span>
    }

    <span class="c-key">public function</span> <span class="c-fn">export</span>(<span class="c-type">Report</span> <span class="c-var">$report</span>, <span class="c-key">string</span> <span class="c-var">$format</span>): <span class="c-type">StreamedResponse</span>
    {
        <span class="c-key">if</span> (! <span class="c-fn">isset</span>(<span class="c-var">$this</span>-><span class="c-var">byFormat</span>[<span class="c-var">$format</span>])) {
            <span class="c-key">throw new</span> <span class="c-type">UnsupportedFormatException</span>(<span class="c-var">$format</span>);
        }
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-var">byFormat</span>[<span class="c-var">$format</span>]-><span class="c-fn">export</span>(<span class="c-var">$report</span>);
    }
}
</code></pre>

    <p class="text">Использование в контроллере:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">ReportController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private readonly</span> <span class="c-type">ReportExportManager</span> <span class="c-var">$exporter</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">download</span>(<span class="c-type">Report</span> <span class="c-var">$report</span>, <span class="c-type">Request</span> <span class="c-var">$request</span>): <span class="c-type">StreamedResponse</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-var">exporter</span>-><span class="c-fn">export</span>(<span class="c-var">$report</span>, <span class="c-var">$request</span>-><span class="c-fn">input</span>(<span class="c-str">'format'</span>, <span class="c-str">'csv'</span>));
    }
}
</code></pre>

    <p class="text">Добавление нового формата (например, XML) сводится к: написать класс <code>XmlExporter implements ReportExporter</code>, зарегистрировать его в провайдере, дописать в массив <code>tag()</code>. Менеджер, контроллер, шаблон выбора формата &mdash; ничего из этого менять не нужно.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. <code>tagged()</code> возвращает ленивый итератор.</strong> Метод возвращает <code>RewindableGenerator</code>, а не массив. Однократный обход в <code>foreach</code> работает корректно; повторный &mdash; тоже (объект rewindable). Однако функции вроде <code>count()</code> на нём не работают &mdash; нужно либо <code>iterator_count()</code>, либо <code>iterator_to_array()</code>.
    </div>
    <div class="pitfall">
      <strong>2. Регистрация и тег &mdash; отдельные шаги.</strong> Метод <code>tag()</code> только записывает связь «abstract принадлежит тегу». Если сам abstract не зарегистрирован через <code>bind/singleton</code> и не является автоматически разрешаемым классом, при итерации <code>tagged()</code> разрешение провалится с <code>BindingResolutionException</code>. Тегирование не заменяет регистрации.
    </div>
    <div class="pitfall">
      <strong>3. Порядок tagged недетерминирован при изменениях.</strong> Порядок элементов в итераторе соответствует порядку регистрации в <code>tag()</code>. При программной регистрации (например, через discovery в подкаталоге) порядок зависит от файловой системы. Если порядок важен (chain of responsibility, priority), реализуйте его явно &mdash; либо через сортировку после получения, либо через специальный метод <code>priority()</code> на каждом сервисе.
    </div>
    <div class="pitfall">
      <strong>4. Лишние теги затрудняют поиск проблемы.</strong> Если сервис помечен несколькими тегами и регистрируется в нескольких провайдерах, отследить, откуда он попал в группу, сложно. Сохраняйте 1-2 тега на сервис и документируйте назначение каждого тега.
    </div>
    <div class="pitfall">
      <strong>5. <code>iterable</code> vs массив в типе зависимости.</strong> Параметр конструктора лучше объявлять как <code>iterable</code>, чтобы оставить контейнеру свободу передачи генератора (быстрее) или массива (после <code>iterator_to_array</code>). Жёсткий тип <code>array</code> заставит контейнер материализовать набор немедленно, что может быть дороже.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     RESOLUTION
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-resolution" class="section">
  <div class="section-title">Разрешение зависимостей и autowiring</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Resolution &mdash; процесс, в котором контейнер по запрошенному abstract создаёт готовый объект со всеми зависимостями. Autowiring &mdash; автоматическое разрешение зависимостей без явной регистрации, на основе анализа типов в сигнатуре конструктора. Эти два механизма работают вместе и определяют, насколько «легко» в коде получить сервис.</p>
    <p class="text">Понимание процесса разрешения важно, когда необходимо вызвать произвольный метод с инъекцией зависимостей (<code>app()-&gt;call()</code>), подмешать значения в существующий объект (<code>resolving</code>-колбэки), отладить почему контейнер выбрасывает <code>BindingResolutionException</code>. Большую часть времени разработчик не задумывается о деталях разрешения &mdash; всё работает «магически», но понимание превращает магию в инженерную предсказуемость.</p>
    <p class="text">Алгоритм разрешения детерминирован и пошаговый: проверка кеша инстансов, поиск registered binding, попытка autowiring через рефлексию, рекурсия по параметрам конструктора, применение контекстных biding, primitive resolution через дефолтные значения. Каждый шаг имеет осмысленную точку расширения для опытного пользователя.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Методы и алгоритм</div>

    <div class="card">
      <h3><code>make($abstract, $parameters = [])</code> &mdash; основной метод</h3>
      <p class="text">Возвращает разрешённый экземпляр. Второй параметр &mdash; массив значений для primitive-зависимостей конструктора, перекрывающий контейнерное разрешение.</p>
<pre><code><span class="c-comment">// Получить полностью разрешённый сервис.</span>
<span class="c-var">$service</span> = <span class="c-fn">app</span>()-><span class="c-fn">make</span>(<span class="c-type">OrderService</span>::<span class="c-key">class</span>);

<span class="c-comment">// То же самое сокращённой формой через хелпер.</span>
<span class="c-var">$service</span> = <span class="c-fn">app</span>(<span class="c-type">OrderService</span>::<span class="c-key">class</span>);

<span class="c-comment">// Передать значения для primitive-параметров.</span>
<span class="c-var">$gateway</span> = <span class="c-fn">app</span>()-><span class="c-fn">make</span>(<span class="c-type">StripeGateway</span>::<span class="c-key">class</span>, [
    <span class="c-str">'apiKey'</span> =&gt; <span class="c-str">'sk_test_...'</span>,
    <span class="c-str">'webhookSecret'</span> =&gt; <span class="c-str">'whsec_...'</span>,
]);
<span class="c-comment">// Эти значения перекрывают любые контейнерные binding для $apiKey и $webhookSecret.</span>
</code></pre>
    </div>

    <div class="card">
      <h3><code>resolve($abstract, $parameters)</code> &mdash; синоним <code>make</code></h3>
      <p class="text">Функционально эквивалентен <code>make()</code>. В некоторых местах исходного кода Laravel используется именно <code>resolve</code> &mdash; для семантической ясности. В пользовательском коде обычно применяется <code>make</code> или хелпер <code>app()</code>.</p>
    </div>

    <div class="card">
      <h3><code>app()-&gt;call($callback, $parameters)</code> &mdash; вызов с инъекцией</h3>
      <p class="text">Вызывает произвольное callable (замыкание, метод объекта, имя класса в формате «Class@method»), автоматически разрешая параметры через контейнер.</p>
<pre><code><span class="c-comment">// Замыкание с инъекцией зависимостей.</span>
<span class="c-fn">app</span>()-><span class="c-fn">call</span>(<span class="c-key">function</span> (<span class="c-type">UserRepository</span> <span class="c-var">$users</span>, <span class="c-type">Mailer</span> <span class="c-var">$mailer</span>) {
    <span class="c-comment">// $users и $mailer разрешены автоматически.</span>
});

<span class="c-comment">// Метод объекта.</span>
<span class="c-var">$service</span> = <span class="c-key">new</span> <span class="c-type">ReportService</span>();
<span class="c-fn">app</span>()-><span class="c-fn">call</span>([<span class="c-var">$service</span>, <span class="c-str">'generate'</span>], [<span class="c-str">'year'</span> =&gt; <span class="c-num">2024</span>]);
<span class="c-comment">// Параметры с типами разрешаются контейнером,</span>
<span class="c-comment">// primitive (year) — берутся из второго аргумента.</span>

<span class="c-comment">// Класс@метод — Laravel создаст инстанс и вызовет метод.</span>
<span class="c-fn">app</span>()-><span class="c-fn">call</span>(<span class="c-str">'App\Services\ReportService@generate'</span>);
</code></pre>
    </div>

    <div class="card">
      <h3><code>resolving()</code> и <code>afterResolving()</code> &mdash; колбэки</h3>
      <p class="text">Хуки, вызываемые после создания объекта определённого типа. Позволяют дополнительно настраивать сервис после конструктора &mdash; например, регистрировать listeners, подмешивать конфигурацию.</p>
<pre><code><span class="c-comment">// Вызывается каждый раз перед возвратом разрешённого сервиса.</span>
<span class="c-fn">app</span>()-><span class="c-fn">resolving</span>(<span class="c-type">Logger</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">Logger</span> <span class="c-var">$logger</span>, <span class="c-type">Container</span> <span class="c-var">$app</span>) {
    <span class="c-var">$logger</span>-><span class="c-fn">pushProcessor</span>(<span class="c-key">fn</span> (<span class="c-key">array</span> <span class="c-var">$record</span>) =&gt; <span class="c-fn">array_merge</span>(<span class="c-var">$record</span>, [
        <span class="c-str">'trace_id'</span> =&gt; <span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">RequestContext</span>::<span class="c-key">class</span>)-><span class="c-var">traceId</span>,
    ]));
});

<span class="c-comment">// Вызывается после возврата сервиса, для пост-обработки.</span>
<span class="c-fn">app</span>()-><span class="c-fn">afterResolving</span>(<span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">PaymentGateway</span> <span class="c-var">$gateway</span>) {
    <span class="c-fn">logger</span>()-><span class="c-fn">info</span>(<span class="c-str">'PaymentGateway resolved'</span>);
});

<span class="c-comment">// Без указания abstract — на все разрешения подряд.</span>
<span class="c-fn">app</span>()-><span class="c-fn">resolving</span>(<span class="c-key">function</span> (<span class="c-var">$object</span>, <span class="c-type">Container</span> <span class="c-var">$app</span>) {
    <span class="c-comment">// Логирование любого разрешения, полезно для аудита.</span>
});
</code></pre>
    </div>

    <div class="card">
      <h3>Алгоритм разрешения зависимости</h3>
      <p class="text">При вызове <code>make($abstract)</code> контейнер выполняет следующие шаги:</p>
      <ol class="bullets" style="list-style:decimal;">
        <li><strong>Проверка кеша scoped/singleton-инстансов.</strong> Если для <code>$abstract</code> уже хранится экземпляр, и binding регистрировался как singleton или scoped &mdash; возвращается этот экземпляр немедленно.</li>
        <li><strong>Применение контекстного binding.</strong> Если сейчас контейнер разрешает класс A, и для него зарегистрирован <code>when(A)-&gt;needs($abstract)-&gt;give(...)</code>, используется этот binding.</li>
        <li><strong>Поиск зарегистрированного binding.</strong> Если есть <code>bind/singleton</code> для <code>$abstract</code>, вызывается соответствующий callback или инстанцируется указанный concrete-класс.</li>
        <li><strong>Autowiring.</strong> Если binding не найден, но <code>$abstract</code> &mdash; имя реального класса, контейнер пытается создать его напрямую через рефлексию конструктора.</li>
        <li><strong>Рекурсивное разрешение зависимостей конструктора.</strong> Для каждого параметра конструктора:
          <ul class="bullets" style="margin-top:4px;">
            <li>Если тип параметра &mdash; класс/интерфейс &mdash; рекурсивно <code>make</code> по нему;</li>
            <li>Если primitive &mdash; ищется значение в <code>$parameters</code> (явно переданном) или в контекстном binding по имени параметра;</li>
            <li>Если нет ни того, ни другого &mdash; используется default-значение параметра;</li>
            <li>Если default нет &mdash; <code>BindingResolutionException</code>.</li>
          </ul>
        </li>
        <li><strong>Сохранение в кеш singleton/scoped.</strong> Если binding регистрировался как singleton, экземпляр сохраняется для последующих запросов.</li>
        <li><strong>Вызов <code>resolving</code>-колбэков.</strong> Все зарегистрированные на этот abstract callbacks вызываются с готовым объектом.</li>
        <li><strong>Возврат экземпляра.</strong> Объект отдаётся вызывающему коду.</li>
      </ol>
    </div>

    <div class="card">
      <h3>Autowiring &mdash; разрешение без регистрации</h3>
      <p class="text">Если запрошенный abstract &mdash; имя конкретного класса (не интерфейс, не абстрактный класс), и binding для него не зарегистрирован, контейнер использует рефлексию для автоматической сборки.</p>
<pre><code><span class="c-comment">// Класс не зарегистрирован в провайдерах, но autowiring сработает.</span>
<span class="c-key">class</span> <span class="c-type">EmailNotifier</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private</span> <span class="c-type">Mailer</span> <span class="c-var">$mailer</span>,
        <span class="c-key">private</span> <span class="c-type">TemplateEngine</span> <span class="c-var">$templates</span>,
    ) {}
}

<span class="c-var">$notifier</span> = <span class="c-fn">app</span>(<span class="c-type">EmailNotifier</span>::<span class="c-key">class</span>);
<span class="c-comment">// Контейнер разрешит Mailer и TemplateEngine рекурсивно,</span>
<span class="c-comment">// и инстанцирует EmailNotifier с ними.</span>
</code></pre>
      <p class="text">Autowiring не работает для интерфейсов и абстрактных классов &mdash; их нельзя инстанцировать, поэтому требуется явное связывание с конкретной реализацией через <code>bind</code> или <code>singleton</code>.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: понимание разрешения на конкретной цепочке</div>
    <p class="text">Рассмотрим, как контейнер разрешает сложный граф зависимостей, и как влияют разные виды биндингов.</p>

<pre><code><span class="c-key">interface</span> <span class="c-type">PaymentGateway</span> { <span class="c-key">public function</span> <span class="c-fn">charge</span>(<span class="c-key">int</span> <span class="c-var">$cents</span>): <span class="c-type">ChargeResult</span>; }

<span class="c-key">class</span> <span class="c-type">StripeGateway</span> <span class="c-key">implements</span> <span class="c-type">PaymentGateway</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private readonly</span> <span class="c-type">HttpClient</span> <span class="c-var">$http</span>,        <span class="c-comment">// типизированная — autowire</span>
        <span class="c-key">private readonly</span> <span class="c-key">string</span> <span class="c-var">$apiKey</span>,            <span class="c-comment">// primitive — контекстный bind</span>
        <span class="c-key">private readonly</span> <span class="c-key">int</span> <span class="c-var">$timeoutSec</span> = <span class="c-num">30</span>,      <span class="c-comment">// primitive с default</span>
    ) {}
}

<span class="c-key">class</span> <span class="c-type">CheckoutService</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private readonly</span> <span class="c-type">PaymentGateway</span> <span class="c-var">$gateway</span>,
        <span class="c-key">private readonly</span> <span class="c-type">OrderRepository</span> <span class="c-var">$orders</span>,
        <span class="c-key">private readonly</span> <span class="c-type">EventDispatcher</span> <span class="c-var">$events</span>,
    ) {}
}

<span class="c-comment">// Регистрация в провайдере:</span>
<span class="c-fn">app</span>()-><span class="c-fn">bind</span>(<span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>, <span class="c-type">StripeGateway</span>::<span class="c-key">class</span>);
<span class="c-fn">app</span>()-><span class="c-fn">when</span>(<span class="c-type">StripeGateway</span>::<span class="c-key">class</span>)
    -><span class="c-fn">needs</span>(<span class="c-str">'$apiKey'</span>)
    -><span class="c-fn">giveConfig</span>(<span class="c-str">'services.stripe.key'</span>);
<span class="c-fn">app</span>()-><span class="c-fn">singleton</span>(<span class="c-type">HttpClient</span>::<span class="c-key">class</span>);
</code></pre>

    <p class="text">Что происходит при <code>app(CheckoutService::class)</code>:</p>
    <ol class="bullets" style="list-style:decimal;">
      <li>Контейнер: запрошен <code>CheckoutService</code>. Binding не найден, но это конкретный класс &mdash; autowire через рефлексию.</li>
      <li>Параметр <code>$gateway: PaymentGateway</code>. Это интерфейс. Найден binding <code>PaymentGateway → StripeGateway</code>. Рекурсивный <code>make(StripeGateway::class)</code>.</li>
      <li>Контейнер разрешает <code>StripeGateway</code>:
        <ul class="bullets" style="margin-top:4px;">
          <li><code>$http: HttpClient</code> &mdash; найден singleton-binding, инстанцируется (или возвращается из кеша). Autowire его конструктора.</li>
          <li><code>$apiKey: string</code> &mdash; primitive. Найден контекстный binding с <code>giveConfig('services.stripe.key')</code>. Получаем значение из конфига.</li>
          <li><code>$timeoutSec: int = 30</code> &mdash; primitive без binding, используется default 30.</li>
        </ul>
      </li>
      <li>Возврат к <code>CheckoutService</code>. Параметр <code>$orders: OrderRepository</code> &mdash; autowire (без явного binding).</li>
      <li>Параметр <code>$events: EventDispatcher</code> &mdash; разрешён из встроенных биндингов фреймворка (Laravel регистрирует его в <code>EventServiceProvider</code>).</li>
      <li>Конструктор <code>CheckoutService</code> вызывается со всеми тремя зависимостями. Объект готов.</li>
    </ol>

    <p class="text">Эту цепочку можно отладить, зарегистрировав глобальный <code>resolving</code>-колбэк:</p>
<pre><code><span class="c-fn">app</span>()-><span class="c-fn">resolving</span>(<span class="c-key">function</span> (<span class="c-var">$object</span>, <span class="c-type">Container</span> <span class="c-var">$app</span>) {
    <span class="c-fn">logger</span>()-><span class="c-fn">debug</span>(<span class="c-str">'Resolved: '</span> . <span class="c-var">$object</span>::<span class="c-key">class</span>);
});

<span class="c-fn">app</span>(<span class="c-type">CheckoutService</span>::<span class="c-key">class</span>);
<span class="c-comment">// В логе: Resolved: HttpClient, StripeGateway, OrderRepository, EventDispatcher, CheckoutService</span>
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. <code>BindingResolutionException</code> для интерфейса.</strong> Самая частая ошибка: контроллер ожидает <code>PaymentGateway</code> в конструкторе, но binding не зарегистрирован. Контейнер не может разрешить интерфейс без явного указания concrete. Решение &mdash; зарегистрировать <code>bind(PaymentGateway::class, StripeGateway::class)</code> в провайдере.
    </div>
    <div class="pitfall">
      <strong>2. Autowiring и абстрактные классы.</strong> Абстрактный класс невозможно инстанцировать через рефлексию. Если в конструкторе указан абстрактный тип без binding, контейнер выкинет <code>BindingResolutionException</code>. Решение &mdash; <code>bind</code> на конкретную реализацию.
    </div>
    <div class="pitfall">
      <strong>3. Primitive без контекстного binding и default.</strong> Параметр конструктора типа <code>string</code> или <code>int</code> без default-значения и без контекстного <code>when()-&gt;needs('$param')-&gt;give(...)</code> не разрешится. Это design-флаг: либо параметр должен быть зависимостью (тип-интерфейс), либо иметь default, либо контекст.
    </div>
    <div class="pitfall">
      <strong>4. Циклические зависимости.</strong> Если A требует B, а B требует A в конструкторе, разрешение зацикливается. Контейнер не имеет средства это обнаружить и упадёт со stack overflow. Признак &mdash; пересмотр архитектуры: выделить общий компонент, использовать ленивое разрешение через <code>app()</code> внутри метода (с осознанной потерей чистоты DI).
    </div>
    <div class="pitfall">
      <strong>5. <code>resolving()</code> и singleton.</strong> Колбэки <code>resolving</code> вызываются <strong>каждый раз</strong> когда возвращается объект, включая случаи когда возвращается уже закешированный singleton. Это означает, что колбэк может выполняться много раз для одного и того же объекта. Учитывайте идемпотентность.
    </div>
    <div class="pitfall">
      <strong>6. Autowiring scalar-параметров не работает.</strong> Распространённое заблуждение: «передам в конструктор <code>int $userId</code>, контейнер сам найдёт». Нет, контейнер не угадывает значения scalar-параметров. Их нужно передавать через <code>app()-&gt;make($class, ['userId' =&gt; 42])</code> или через контекстный binding по имени.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     CONTAINER EVENTS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-events" class="section">
  <div class="section-title">Container events и rebinding</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Контейнер публикует события на ключевых моментах своей работы: разрешение зависимости (<code>resolving</code>, <code>afterResolving</code>) и перепривязка ранее зарегистрированного binding (<code>rebinding</code>). Эти точки расширения позволяют выполнить дополнительные действия над созданным объектом или отреагировать на смену реализации в runtime.</p>
    <p class="text">События контейнера &mdash; не то же самое, что Application events Laravel (<code>UserCreated</code>, <code>OrderPlaced</code>). Контейнерные события низкого уровня, относятся к самому процессу создания сервисов и регистрируются методами на контейнере, а не через систему Event/Listener.</p>
    <p class="text">Главные практические применения: централизованная настройка одного типа сервисов (например, добавить trace-id во все логгеры, навесить middleware на все HTTP-клиенты), отслеживание перерегистрации binding для каскадного обновления зависимых сервисов, аудит создаваемых объектов в dev-окружении.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Методы и события</div>

    <div class="card">
      <h3><code>resolving($abstract, $callback)</code></h3>
      <p class="text">Колбэк вызывается каждый раз, когда контейнер возвращает экземпляр указанного abstract. Срабатывает как для свежесозданных, так и для уже закешированных singleton'ов. Первый аргумент колбэка &mdash; разрешённый объект, второй &mdash; экземпляр контейнера.</p>
<pre><code><span class="c-comment">// Колбэк для конкретного abstract.</span>
<span class="c-fn">app</span>()-><span class="c-fn">resolving</span>(<span class="c-type">Logger</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">Logger</span> <span class="c-var">$logger</span>, <span class="c-type">Container</span> <span class="c-var">$app</span>): <span class="c-key">void</span> {
    <span class="c-var">$context</span> = <span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">RequestContext</span>::<span class="c-key">class</span>);
    <span class="c-var">$logger</span>-><span class="c-fn">withContext</span>([<span class="c-str">'trace_id'</span> =&gt; <span class="c-var">$context</span>-><span class="c-var">traceId</span>]);
});

<span class="c-comment">// Колбэк на все типы — для аудита или дебага.</span>
<span class="c-fn">app</span>()-><span class="c-fn">resolving</span>(<span class="c-key">function</span> (<span class="c-var">$object</span>, <span class="c-type">Container</span> <span class="c-var">$app</span>): <span class="c-key">void</span> {
    <span class="c-fn">logger</span>()-><span class="c-fn">debug</span>(<span class="c-str">'Container resolved: '</span> . <span class="c-var">$object</span>::<span class="c-key">class</span>);
});
</code></pre>
    </div>

    <div class="card">
      <h3><code>afterResolving($abstract, $callback)</code></h3>
      <p class="text">Аналогичен <code>resolving</code>, но вызывается <strong>после</strong> того, как все <code>resolving</code>-колбэки отработали и объект готов к возврату. Полезен для финального шага настройки, когда нужно гарантировать, что предыдущие хуки уже отработали.</p>
<pre><code><span class="c-fn">app</span>()-><span class="c-fn">resolving</span>(<span class="c-type">HttpClient</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">HttpClient</span> <span class="c-var">$client</span>) {
    <span class="c-var">$client</span>-><span class="c-fn">middleware</span>(<span class="c-key">new</span> <span class="c-type">RetryMiddleware</span>(<span class="c-num">3</span>));
});

<span class="c-fn">app</span>()-><span class="c-fn">afterResolving</span>(<span class="c-type">HttpClient</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">HttpClient</span> <span class="c-var">$client</span>) {
    <span class="c-comment">// Здесь RetryMiddleware гарантированно уже навешан.</span>
    <span class="c-var">$client</span>-><span class="c-fn">middleware</span>(<span class="c-key">new</span> <span class="c-type">LoggingMiddleware</span>());
});
</code></pre>
    </div>

    <div class="card">
      <h3><code>rebinding($abstract, $callback)</code></h3>
      <p class="text">Колбэк вызывается при <strong>повторной регистрации</strong> abstract, который уже был зарегистрирован ранее. Используется в редких случаях, когда зависимость сервиса нужно обновить runtime после смены реализации.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">UserService</span>
{
    <span class="c-key">private</span> <span class="c-type">Logger</span> <span class="c-var">$logger</span>;

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-type">Container</span> <span class="c-var">$app</span>)
    {
        <span class="c-var">$this</span>-><span class="c-var">logger</span> = <span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">Logger</span>::<span class="c-key">class</span>);

        <span class="c-comment">// Если кто-то перепривяжет Logger позже, обновим ссылку.</span>
        <span class="c-var">$app</span>-><span class="c-fn">rebinding</span>(<span class="c-type">Logger</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">Container</span> <span class="c-var">$app</span>, <span class="c-type">Logger</span> <span class="c-var">$logger</span>) {
            <span class="c-var">$this</span>-><span class="c-var">logger</span> = <span class="c-var">$logger</span>;
        });
    }
}

<span class="c-comment">// Позже в коде:</span>
<span class="c-fn">app</span>()-><span class="c-fn">bind</span>(<span class="c-type">Logger</span>::<span class="c-key">class</span>, <span class="c-type">FileLogger</span>::<span class="c-key">class</span>);
<span class="c-comment">// → колбэк UserService сработает, $logger обновится на FileLogger.</span>
</code></pre>
      <p class="text">Метод <code>refresh($abstract, $target, $method)</code> &mdash; сахар над <code>rebinding</code>: автоматически вызывает указанный сеттер при перебиндинге.</p>
    </div>

    <div class="card">
      <h3><code>extend($abstract, $callback)</code></h3>
      <p class="text">«Декорирует» существующий binding: колбэк получает уже разрешённый объект и должен вернуть его (возможно, обёрнутый или модифицированный). Часто применяется для добавления функциональности к чужим сервисам.</p>
<pre><code><span class="c-fn">app</span>()-><span class="c-fn">extend</span>(<span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">PaymentGateway</span> <span class="c-var">$gateway</span>, <span class="c-type">Container</span> <span class="c-var">$app</span>) {
    <span class="c-comment">// Возвращаем декорированный gateway с логированием и retry.</span>
    <span class="c-key">return new</span> <span class="c-type">LoggingPaymentGateway</span>(
        <span class="c-key">new</span> <span class="c-type">RetryablePaymentGateway</span>(<span class="c-var">$gateway</span>, <span class="c-num">3</span>),
        <span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">Logger</span>::<span class="c-key">class</span>),
    );
});

<span class="c-comment">// Все последующие make(PaymentGateway::class) вернут декорированную версию.</span>
</code></pre>
    </div>

    <div class="card">
      <h3>Сводная таблица событий и хуков</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>Когда вызывается</th><th>Применение</th></tr>
        <tr><td><code>resolving</code></td><td>При каждом разрешении abstract, перед возвратом</td><td>Настройка свойств, регистрация listeners</td></tr>
        <tr><td><code>afterResolving</code></td><td>После всех resolving-колбэков</td><td>Финальный шаг после всех других хуков</td></tr>
        <tr><td><code>rebinding</code></td><td>При повторной регистрации binding</td><td>Обновление ссылок на сервис в существующих объектах</td></tr>
        <tr><td><code>refresh</code></td><td>То же что rebinding + автоматический вызов сеттера</td><td>Удобная форма rebinding для типового кейса</td></tr>
        <tr><td><code>extend</code></td><td>Декорирование binding</td><td>Обёртывание сервиса в декоратор</td></tr>
      </table>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: единая настройка HTTP-клиентов через события</div>
    <p class="text">Приложение использует HTTP-клиент для интеграций с тремя внешними API (Stripe, Twilio, Slack). Каждый клиент должен иметь общие настройки: retry с экспоненциальным бэкоффом, логирование запросов, trace-id в заголовках, метрики времени ответа. Без событий контейнера эту настройку пришлось бы дублировать в каждой регистрации; через <code>resolving</code> &mdash; в одном месте.</p>

<pre><code><span class="c-key">namespace</span> <span class="c-type">App\Providers</span>;

<span class="c-key">use</span> <span class="c-type">App\Http\Middleware\Client\LoggingMiddleware</span>;
<span class="c-key">use</span> <span class="c-type">App\Http\Middleware\Client\MetricsMiddleware</span>;
<span class="c-key">use</span> <span class="c-type">App\Http\Middleware\Client\RetryMiddleware</span>;
<span class="c-key">use</span> <span class="c-type">App\Http\Middleware\Client\TraceMiddleware</span>;
<span class="c-key">use</span> <span class="c-type">GuzzleHttp\Client as HttpClient</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\ServiceProvider</span>;

<span class="c-key">class</span> <span class="c-type">HttpClientServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// Базовые конструкторы клиентов — без middleware.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-str">'http.stripe'</span>, <span class="c-key">fn</span> () =&gt; <span class="c-key">new</span> <span class="c-type">HttpClient</span>([<span class="c-str">'base_uri'</span> =&gt; <span class="c-str">'https://api.stripe.com'</span>]));
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-str">'http.twilio'</span>, <span class="c-key">fn</span> () =&gt; <span class="c-key">new</span> <span class="c-type">HttpClient</span>([<span class="c-str">'base_uri'</span> =&gt; <span class="c-str">'https://api.twilio.com'</span>]));
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-str">'http.slack'</span>, <span class="c-key">fn</span> () =&gt; <span class="c-key">new</span> <span class="c-type">HttpClient</span>([<span class="c-str">'base_uri'</span> =&gt; <span class="c-str">'https://slack.com'</span>]));

        <span class="c-comment">// Единая настройка через resolving — применится к каждому из трёх клиентов.</span>
        <span class="c-key">foreach</span> ([<span class="c-str">'http.stripe'</span>, <span class="c-str">'http.twilio'</span>, <span class="c-str">'http.slack'</span>] <span class="c-key">as</span> <span class="c-var">$key</span>) {
            <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">resolving</span>(<span class="c-var">$key</span>, <span class="c-key">function</span> (<span class="c-type">HttpClient</span> <span class="c-var">$client</span>, <span class="c-type">Container</span> <span class="c-var">$app</span>) {
                <span class="c-var">$stack</span> = <span class="c-var">$client</span>-><span class="c-fn">getConfig</span>(<span class="c-str">'handler'</span>);

                <span class="c-var">$stack</span>-><span class="c-fn">push</span>(<span class="c-key">new</span> <span class="c-type">RetryMiddleware</span>(maxAttempts: <span class="c-num">3</span>, backoffMs: <span class="c-num">200</span>));
                <span class="c-var">$stack</span>-><span class="c-fn">push</span>(<span class="c-key">new</span> <span class="c-type">TraceMiddleware</span>(<span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">RequestContext</span>::<span class="c-key">class</span>)));
                <span class="c-var">$stack</span>-><span class="c-fn">push</span>(<span class="c-key">new</span> <span class="c-type">LoggingMiddleware</span>(<span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">Logger</span>::<span class="c-key">class</span>)));
                <span class="c-var">$stack</span>-><span class="c-fn">push</span>(<span class="c-key">new</span> <span class="c-type">MetricsMiddleware</span>(<span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">MetricsCollector</span>::<span class="c-key">class</span>)));
            });
        }
    }
}
</code></pre>

    <p class="text">Преимущества подхода: <strong>один источник истины</strong> для настройки HTTP-клиентов. Добавление нового middleware (например, circuit breaker) &mdash; одна строка в провайдере, применится ко всем клиентам автоматически. Добавление нового HTTP-клиента &mdash; одна регистрация плюс ключ в массиве, и все middleware подхватятся.</p>

    <p class="text">Альтернатива через <code>extend</code> &mdash; ещё более лаконичная, но создаёт цепочку декораторов вместо модификации существующего объекта:</p>
<pre><code><span class="c-key">foreach</span> ([<span class="c-str">'http.stripe'</span>, <span class="c-str">'http.twilio'</span>, <span class="c-str">'http.slack'</span>] <span class="c-key">as</span> <span class="c-var">$key</span>) {
    <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">extend</span>(<span class="c-var">$key</span>, <span class="c-key">function</span> (<span class="c-type">HttpClient</span> <span class="c-var">$client</span>, <span class="c-type">Container</span> <span class="c-var">$app</span>) {
        <span class="c-key">return new</span> <span class="c-type">DecoratedHttpClient</span>(<span class="c-var">$client</span>, [
            <span class="c-key">new</span> <span class="c-type">RetryDecorator</span>(<span class="c-num">3</span>),
            <span class="c-key">new</span> <span class="c-type">TraceDecorator</span>(<span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">RequestContext</span>::<span class="c-key">class</span>)),
            <span class="c-key">new</span> <span class="c-type">LoggingDecorator</span>(<span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">Logger</span>::<span class="c-key">class</span>)),
        ]);
    });
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. <code>resolving</code> вызывается на каждом make, не только при первом.</strong> Для singleton, который был создан и закеширован, колбэк всё равно сработает при повторных <code>app(Singleton::class)</code>. Это часто упускают: если в колбэке выполняется тяжёлая работа (запрос к API), она будет повторяться. Применяйте идемпотентную или однократно-применяемую логику.
    </div>
    <div class="pitfall">
      <strong>2. <code>resolving</code> на интерфейс vs concrete.</strong> Колбэк, зарегистрированный на интерфейс (<code>resolving(PaymentGateway::class, ...)</code>), сработает только когда контейнер разрешает запрос к этому интерфейсу. Если код напрямую запрашивает <code>StripeGateway::class</code> (concrete), колбэк не вызовется. Для гарантированного срабатывания регистрируйте колбэки и на интерфейс, и на конкретный класс.
    </div>
    <div class="pitfall">
      <strong>3. <code>rebinding</code> для непривязанных abstracts.</strong> Метод срабатывает только при перерегистрации уже существующего binding. Если abstract разрешается через autowiring (без явного binding), rebinding-колбэк никогда не вызовется &mdash; нет события, которому он мог бы соответствовать.
    </div>
    <div class="pitfall">
      <strong>4. <code>extend</code> и singleton-кеш.</strong> Метод <code>extend</code> применяется при разрешении: если singleton уже был создан до вызова <code>extend</code>, кеш содержит «недекорированную» версию. Решение &mdash; вызвать <code>extend</code> в провайдере до первого <code>make</code>, или явно очистить кеш через <code>forgetInstance($abstract)</code>.
    </div>
    <div class="pitfall">
      <strong>5. Регистрация события после первого разрешения.</strong> Если <code>resolving</code> зарегистрирован после того, как abstract уже был один раз разрешён в singleton, для существующего экземпляра колбэк не сработает (объект уже в кеше). Все колбэки должны быть зарегистрированы в <code>register()</code> провайдеров до начала работы приложения.
    </div>
    <div class="pitfall">
      <strong>6. Превращение событий в логику бизнес-уровня.</strong> Контейнерные события &mdash; низкоуровневый механизм. Использовать их как «событийную шину» для бизнес-событий (например, «при создании пользователя отправить welcome email») неправильно. Для этого есть Laravel Event/Listener система. Контейнерные события &mdash; для настройки самих сервисов.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PROVIDERS OVERVIEW
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-providers" class="section">
  <div class="section-title">Service Providers</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Service Provider &mdash; точка инициализации модуля приложения. Это класс, наследующий <code>Illuminate\Support\ServiceProvider</code>, в котором приложение или сторонний пакет сообщает фреймворку: «вот мои сервисы, маршруты, миграции, конфиг, observers». Провайдер выполняет роль композиционного корня (composition root) для своей подсистемы.</p>
    <p class="text">Laravel сам &mdash; набор провайдеров. Подключение к БД, событийная система, маршрутизация, авторизация, очереди, кэш &mdash; каждый из этих модулей фреймворка зарегистрирован отдельным провайдером в <code>vendor/laravel/framework/src/Illuminate/.../<*ServiceProvider.php></code>. Этот же механизм доступен приложениям и пакетам.</p>
    <p class="text">Провайдеры решают две задачи. Первая &mdash; регистрация связок в контейнере (<code>bind</code>, <code>singleton</code>, контекстные binding) до того, как фреймворк начнёт обрабатывать запросы. Вторая &mdash; «boot»-инициализация: загрузка миграций, регистрация Blade-директив, объявление маршрутов, подписка на события &mdash; всё, что требует уже собранного контейнера.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Структура и виды провайдеров</div>

    <div class="card">
      <h3>Базовая структура</h3>
      <p class="text">Провайдер генерируется командой <code>php artisan make:provider</code>. Стандартный класс наследует <code>ServiceProvider</code> и определяет два метода: <code>register()</code> и <code>boot()</code>.</p>
<pre><code><span class="c-key">namespace</span> <span class="c-type">App\Providers</span>;

<span class="c-key">use</span> <span class="c-type">Illuminate\Support\ServiceProvider</span>;

<span class="c-key">class</span> <span class="c-type">PaymentServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-comment">// Регистрация: только связки контейнера.</span>
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>, <span class="c-type">StripeGateway</span>::<span class="c-key">class</span>);
    }

    <span class="c-comment">// Boot: всё остальное.</span>
    <span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
    {
        <span class="c-type">Route</span>::<span class="c-fn">prefix</span>(<span class="c-str">'payments'</span>)-><span class="c-fn">group</span>(<span class="c-fn">base_path</span>(<span class="c-str">'routes/payments.php'</span>));
        <span class="c-var">$this</span>-><span class="c-fn">loadMigrationsFrom</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../../database/migrations/payments'</span>);
        <span class="c-type">Event</span>::<span class="c-fn">listen</span>(<span class="c-type">PaymentSucceeded</span>::<span class="c-key">class</span>, <span class="c-type">UpdateOrderStatus</span>::<span class="c-key">class</span>);
    }
}
</code></pre>
    </div>

    <div class="card">
      <h3>Регистрация провайдера в приложении</h3>
      <p class="text">Создание класса провайдера &mdash; половина дела. Чтобы Laravel его подхватил, необходимо зарегистрировать. В Laravel 11+ это делается в <code>bootstrap/providers.php</code>; в более ранних версиях &mdash; в массиве <code>providers</code> файла <code>config/app.php</code>.</p>
<pre><code><span class="c-comment">// Laravel 11+ — bootstrap/providers.php</span>
<span class="c-key">return</span> [
    <span class="c-type">App\Providers\AppServiceProvider</span>::<span class="c-key">class</span>,
    <span class="c-type">App\Providers\PaymentServiceProvider</span>::<span class="c-key">class</span>,
    <span class="c-type">App\Providers\CatalogServiceProvider</span>::<span class="c-key">class</span>,
];

<span class="c-comment">// До Laravel 11 — config/app.php</span>
<span class="c-str">'providers'</span> =&gt; [
    <span class="c-comment">// ... системные провайдеры ...</span>
    <span class="c-type">App\Providers\PaymentServiceProvider</span>::<span class="c-key">class</span>,
],
</code></pre>
    </div>

    <div class="card">
      <h3>Доступ к контейнеру внутри провайдера</h3>
      <p class="text">В провайдере доступно свойство <code>$this-&gt;app</code> &mdash; экземпляр контейнера. Все методы регистрации (<code>bind</code>, <code>singleton</code>, <code>when</code>, <code>tag</code>) вызываются на нём.</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
{
    <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">Mailer</span>::<span class="c-key">class</span>, <span class="c-type">SmtpMailer</span>::<span class="c-key">class</span>);
    <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">bind</span>(<span class="c-type">UserRepository</span>::<span class="c-key">class</span>, <span class="c-type">EloquentUserRepository</span>::<span class="c-key">class</span>);
}
</code></pre>
    </div>

    <div class="card">
      <h3>Методы провайдера для типовых задач</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>Назначение</th></tr>
        <tr><td><code>$this-&gt;loadMigrationsFrom($path)</code></td><td>Подключить миграции из указанной директории (для пакетов, модульной структуры).</td></tr>
        <tr><td><code>$this-&gt;loadRoutesFrom($path)</code></td><td>Подключить маршруты из файла.</td></tr>
        <tr><td><code>$this-&gt;loadViewsFrom($path, $namespace)</code></td><td>Зарегистрировать неймспейс для Blade-шаблонов.</td></tr>
        <tr><td><code>$this-&gt;loadTranslationsFrom($path, $namespace)</code></td><td>Подключить переводы пакета.</td></tr>
        <tr><td><code>$this-&gt;mergeConfigFrom($path, $key)</code></td><td>Слить дефолтную конфигурацию пакета с пользовательской.</td></tr>
        <tr><td><code>$this-&gt;publishes($paths, $groups)</code></td><td>Объявить публикуемые ресурсы (config, миграции, assets) для <code>php artisan vendor:publish</code>.</td></tr>
        <tr><td><code>$this-&gt;commands($commands)</code></td><td>Зарегистрировать классы Artisan-команд (вызывается в <code>boot</code>).</td></tr>
      </table>
    </div>

    <div class="card">
      <h3>Виды провайдеров</h3>
      <p class="text">В Laravel есть несколько разновидностей провайдеров, различающихся семантикой и моментом загрузки:</p>
      <ul class="bullets">
        <li><strong>Обычный <code>ServiceProvider</code></strong> &mdash; загружается при каждом запросе. Подходит для общих модулей.</li>
        <li><strong>Deferred Provider</strong> (реализует <code>DeferrableProvider</code>) &mdash; откладывает загрузку до момента, когда впервые понадобится зарегистрированный им сервис. Подходит для тяжёлых пакетов, используемых редко.</li>
        <li><strong>Package Provider</strong> &mdash; провайдер, поставляемый в составе Composer-пакета. Регистрируется автоматически через mechanism «package auto-discovery» из <code>composer.json</code> пакета.</li>
      </ul>
      <p class="text">Все три &mdash; одни и те же базовые классы; различие &mdash; в наличии метода <code>provides()</code> и в способе регистрации.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: модульная структура приложения через провайдеры</div>
    <p class="text">Рассмотрим организацию крупного приложения как набора независимых модулей: <code>Catalog</code>, <code>Orders</code>, <code>Billing</code>, <code>Notifications</code>. Каждый модуль &mdash; набор сервисов, моделей, маршрутов, миграций, замкнутых на своей предметной области. Каждый модуль имеет один Service Provider, отвечающий за его инициализацию.</p>

<pre><code><span class="c-key">namespace</span> <span class="c-type">App\Modules\Catalog\Providers</span>;

<span class="c-key">use</span> <span class="c-type">App\Modules\Catalog\Contracts\ProductRepository</span>;
<span class="c-key">use</span> <span class="c-type">App\Modules\Catalog\Repositories\EloquentProductRepository</span>;
<span class="c-key">use</span> <span class="c-type">App\Modules\Catalog\Services\PriceCalculator</span>;
<span class="c-key">use</span> <span class="c-type">App\Modules\Catalog\Observers\ProductObserver</span>;
<span class="c-key">use</span> <span class="c-type">App\Modules\Catalog\Models\Product</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Route</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\ServiceProvider</span>;

<span class="c-key">class</span> <span class="c-type">CatalogServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// Слияние конфига модуля с пользовательской настройкой.</span>
        <span class="c-var">$this</span>-><span class="c-fn">mergeConfigFrom</span>(
            <span class="c-fn">__DIR__</span> . <span class="c-str">'/../config/catalog.php'</span>, <span class="c-str">'catalog'</span>
        );

        <span class="c-comment">// Регистрация контрактов и реализаций.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">bind</span>(<span class="c-type">ProductRepository</span>::<span class="c-key">class</span>, <span class="c-type">EloquentProductRepository</span>::<span class="c-key">class</span>);
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">PriceCalculator</span>::<span class="c-key">class</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// Маршруты модуля.</span>
        <span class="c-type">Route</span>::<span class="c-fn">middleware</span>(<span class="c-str">'web'</span>)
            -><span class="c-fn">prefix</span>(<span class="c-str">'catalog'</span>)
            -><span class="c-fn">group</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../routes/web.php'</span>);

        <span class="c-comment">// Миграции и шаблоны.</span>
        <span class="c-var">$this</span>-><span class="c-fn">loadMigrationsFrom</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../database/migrations'</span>);
        <span class="c-var">$this</span>-><span class="c-fn">loadViewsFrom</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../resources/views'</span>, <span class="c-str">'catalog'</span>);

        <span class="c-comment">// Observer для модели.</span>
        <span class="c-type">Product</span>::<span class="c-fn">observe</span>(<span class="c-type">ProductObserver</span>::<span class="c-key">class</span>);

        <span class="c-comment">// Publishable: конфиг можно скопировать в config/ командой vendor:publish.</span>
        <span class="c-var">$this</span>-><span class="c-fn">publishes</span>([
            <span class="c-fn">__DIR__</span> . <span class="c-str">'/../config/catalog.php'</span> =&gt; <span class="c-fn">config_path</span>(<span class="c-str">'catalog.php'</span>),
        ], <span class="c-str">'catalog-config'</span>);
    }
}
</code></pre>

    <p class="text">Структура файлов модуля:</p>
    <div class="diagram" style="background:#1E1E2D;color:#ABB2BF;border-radius:var(--radius);padding:18px;font-family:'JetBrains Mono',monospace;font-size:12px;line-height:1.5;white-space:pre;margin-bottom:14px;">app/Modules/Catalog/
├── config/catalog.php
├── database/migrations/2024_01_01_create_products.php
├── routes/web.php
├── resources/views/index.blade.php
├── Models/Product.php
├── Repositories/EloquentProductRepository.php
├── Contracts/ProductRepository.php
├── Services/PriceCalculator.php
├── Observers/ProductObserver.php
└── Providers/CatalogServiceProvider.php</div>

    <p class="text">Подключение модуля сводится к одной строке в <code>bootstrap/providers.php</code>:</p>
<pre><code><span class="c-key">return</span> [
    <span class="c-type">App\Providers\AppServiceProvider</span>::<span class="c-key">class</span>,
    <span class="c-type">App\Modules\Catalog\Providers\CatalogServiceProvider</span>::<span class="c-key">class</span>,
    <span class="c-type">App\Modules\Orders\Providers\OrdersServiceProvider</span>::<span class="c-key">class</span>,
    <span class="c-type">App\Modules\Billing\Providers\BillingServiceProvider</span>::<span class="c-key">class</span>,
    <span class="c-type">App\Modules\Notifications\Providers\NotificationsServiceProvider</span>::<span class="c-key">class</span>,
];
</code></pre>

    <p class="text">Преимущества такой структуры:</p>
    <ul class="bullets">
      <li>Каждый модуль автономен: его можно отключить (закомментировав провайдер) или перенести в отдельный пакет;</li>
      <li>Зависимости между модулями явные &mdash; через интерфейсы и контейнер, без прямых импортов классов другого модуля;</li>
      <li>Тестирование модуля отдельно от остальной системы упрощается;</li>
      <li>В крупных командах разные модули можно развивать параллельно без конфликтов в namespace.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. Регистрация в неверном методе.</strong> Самая частая ошибка &mdash; вызов <code>bind/singleton</code> в <code>boot()</code> или, наоборот, использование других сервисов в <code>register()</code>. В <code>register()</code> доступен только контейнер и binding-методы; остальные сервисы могут быть ещё не зарегистрированы. В <code>boot()</code> контейнер уже полностью собран. Подробнее &mdash; в подразделе «register vs boot».
    </div>
    <div class="pitfall">
      <strong>2. Циклические зависимости между провайдерами.</strong> Если провайдер A в <code>boot</code> использует сервис из провайдера B, который ещё не загрузился &mdash; <code>BindingResolutionException</code>. Решение &mdash; перенести регистрацию в <code>register</code> (выполняется раньше у всех провайдеров) или использовать события <code>booted</code>.
    </div>
    <div class="pitfall">
      <strong>3. Тяжёлая работа в <code>register</code>.</strong> Провайдер вызывается на каждый запрос. Длительные операции (чтение файлов, обращения к сети, инициализация ресурсов) в <code>register</code> замедляют каждый запрос приложения. Откладывайте такую работу либо в <code>boot</code> (если только при первой надобности), либо в Deferred Provider.
    </div>
    <div class="pitfall">
      <strong>4. Провайдер не зарегистрирован в <code>providers.php</code>.</strong> Класс создан, метод <code>register</code> написан, но ничего не работает &mdash; первая проверка: добавлен ли провайдер в массив. Без регистрации Laravel о нём не знает.
    </div>
    <div class="pitfall">
      <strong>5. Состояние в провайдере.</strong> Провайдер не предназначен для хранения состояния. Свойства класса провайдера используются только для конфигурации (<code>$defer</code>, <code>$bindings</code>, <code>$singletons</code>); пользовательские данные хранятся в сервисах, регистрируемых через контейнер.
    </div>
    <div class="pitfall">
      <strong>6. Регистрация observer-классов в <code>register</code>.</strong> Метод <code>Product::observe()</code> требует, чтобы класс модели был уже загружен и Eloquent был инициализирован. В <code>register()</code> это не гарантируется. Регистрация observer'ов должна выполняться в <code>boot()</code>.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     LIFECYCLE register vs boot
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-lifecycle" class="section">
  <div class="section-title">register vs boot vs booted</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Жизненный цикл загрузки приложения Laravel состоит из двух фаз: <strong>фаза регистрации</strong> и <strong>фаза boot</strong>. Каждый ServiceProvider может участвовать в обеих фазах, реализуя методы <code>register()</code> и <code>boot()</code>. Понимание разделения между ними критично: размещение кода в неправильной фазе приводит к ошибкам, неочевидным для начинающих, но прозрачным после знакомства с алгоритмом.</p>
    <p class="text">Принцип разделения: в фазе регистрации <strong>нельзя</strong> предполагать, что другие сервисы уже доступны &mdash; они могут быть зарегистрированы более поздними провайдерами. В фазе boot контейнер полностью собран &mdash; можно использовать любой сервис, регистрировать обработчики событий, маршруты, наблюдателей моделей.</p>
    <p class="text">Метод <code>booted()</code> &mdash; третья опция, выполняющаяся после <strong>всех</strong> <code>boot()</code> всех провайдеров. Используется для финальных инициализаций, требующих полной готовности приложения.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Алгоритм загрузки</div>

    <div class="card">
      <h3>Фаза 1: register</h3>
      <p class="text">Laravel поочерёдно создаёт все провайдеры и вызывает у каждого метод <code>register()</code>. В этой фазе:</p>
      <ul class="bullets">
        <li>Доступно только свойство <code>$this-&gt;app</code> (контейнер) и методы binding (<code>bind</code>, <code>singleton</code>, <code>when</code>, <code>tag</code>);</li>
        <li>Запрещено разрешать другие сервисы через <code>app()-&gt;make()</code> &mdash; они могут быть ещё не зарегистрированы;</li>
        <li>Запрещены вызовы фасадов (<code>Route</code>, <code>Event</code>, <code>Storage</code> и др.), потому что их базовые сервисы зарегистрированы в системных провайдерах, порядок которых не гарантирован;</li>
        <li>Можно регистрировать множество биндингов любых сервисов &mdash; они будут «отложены», их создание произойдёт позже.</li>
      </ul>
<pre><code><span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
{
    <span class="c-comment">// ✓ Допустимо: регистрация связки.</span>
    <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>, <span class="c-type">StripeGateway</span>::<span class="c-key">class</span>);

    <span class="c-comment">// ✓ Допустимо: контекстный binding.</span>
    <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">when</span>(<span class="c-type">PhotoController</span>::<span class="c-key">class</span>)
        -><span class="c-fn">needs</span>(<span class="c-type">Filesystem</span>::<span class="c-key">class</span>)
        -><span class="c-fn">give</span>(<span class="c-key">fn</span> () =&gt; <span class="c-type">Storage</span>::<span class="c-fn">disk</span>(<span class="c-str">'photos'</span>));
        <span class="c-comment">// Здесь Storage::disk() в замыкании — выполнится при разрешении PhotoController,</span>
        <span class="c-comment">// а не сейчас. Это безопасно.</span>

    <span class="c-comment">// ✗ Опасно: попытка использовать другие сервисы прямо сейчас.</span>
    <span class="c-comment">// $config = $this->app->make('config'); ← может быть не зарегистрирован.</span>
    <span class="c-comment">// Route::get(...);  ← фасад работает с сервисом router, которого может не быть.</span>
}
</code></pre>
    </div>

    <div class="card">
      <h3>Фаза 2: boot</h3>
      <p class="text">После регистрации всех провайдеров Laravel снова обходит их по очереди и вызывает <code>boot()</code>. В этой фазе:</p>
      <ul class="bullets">
        <li>Контейнер полностью собран &mdash; любой сервис доступен через <code>app()-&gt;make()</code> или фасады;</li>
        <li>Можно регистрировать маршруты, observers моделей, Blade-директивы, event listeners;</li>
        <li>Можно вызывать <code>$this-&gt;loadMigrationsFrom()</code>, <code>$this-&gt;loadViewsFrom()</code>, <code>$this-&gt;publishes()</code>;</li>
        <li>Метод <code>boot</code> поддерживает <strong>method injection</strong>: параметры можно типизировать, контейнер их разрешит автоматически.</li>
      </ul>
<pre><code><span class="c-key">public function</span> <span class="c-fn">boot</span>(<span class="c-type">EventBus</span> <span class="c-var">$events</span>, <span class="c-type">CacheManager</span> <span class="c-var">$cache</span>): <span class="c-key">void</span>
{
    <span class="c-comment">// ✓ Все сервисы доступны.</span>
    <span class="c-type">Route</span>::<span class="c-fn">prefix</span>(<span class="c-str">'api'</span>)-><span class="c-fn">group</span>(<span class="c-fn">base_path</span>(<span class="c-str">'routes/api.php'</span>));
    <span class="c-type">Product</span>::<span class="c-fn">observe</span>(<span class="c-type">ProductObserver</span>::<span class="c-key">class</span>);
    <span class="c-type">Blade</span>::<span class="c-fn">directive</span>(<span class="c-str">'money'</span>, <span class="c-key">fn</span> (<span class="c-var">$expr</span>) =&gt; <span class="c-str">"&lt;?php echo number_format($expr, 2); ?&gt;"</span>);

    <span class="c-comment">// ✓ Параметры boot() разрешаются через method injection.</span>
    <span class="c-var">$events</span>-><span class="c-fn">listen</span>(<span class="c-type">OrderPlaced</span>::<span class="c-key">class</span>, <span class="c-type">SendOrderConfirmation</span>::<span class="c-key">class</span>);

    <span class="c-comment">// ✓ Можно делать переменную, влияющую на runtime-поведение.</span>
    <span class="c-key">if</span> (<span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">isProduction</span>()) {
        <span class="c-type">Model</span>::<span class="c-fn">preventLazyLoading</span>(<span class="c-key">false</span>);
    } <span class="c-key">else</span> {
        <span class="c-type">Model</span>::<span class="c-fn">preventLazyLoading</span>();
    }
}
</code></pre>
    </div>

    <div class="card">
      <h3>Фаза 3: booted</h3>
      <p class="text">После того как у всех провайдеров отработал <code>boot()</code>, Laravel вызывает <code>booted</code>-колбэки. Это удобный способ выполнить код, требующий полностью загруженного приложения.</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
{
    <span class="c-comment">// Регистрируем колбэк, который выполнится после всех boot.</span>
    <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">booted</span>(<span class="c-key">function</span> (<span class="c-type">Application</span> <span class="c-var">$app</span>) {
        <span class="c-comment">// На этот момент все провайдеры уже отработали boot.</span>
        <span class="c-comment">// Все маршруты, observers, listeners зарегистрированы.</span>
        <span class="c-var">$schedule</span> = <span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">Schedule</span>::<span class="c-key">class</span>);
        <span class="c-var">$schedule</span>-><span class="c-fn">command</span>(<span class="c-str">'app:custom-cleanup'</span>)-><span class="c-fn">daily</span>();
    });
}
</code></pre>
    </div>

    <div class="card">
      <h3>Свойства-сокращения: <code>$bindings</code>, <code>$singletons</code></h3>
      <p class="text">Для простых регистраций (без замыканий) можно использовать массивы-свойства провайдера. Laravel автоматически выполнит соответствующие <code>bind</code> и <code>singleton</code>.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">AppServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-key">public</span> <span class="c-key">array</span> <span class="c-var">$bindings</span> = [
        <span class="c-type">UserRepository</span>::<span class="c-key">class</span> =&gt; <span class="c-type">EloquentUserRepository</span>::<span class="c-key">class</span>,
        <span class="c-type">Mailer</span>::<span class="c-key">class</span>         =&gt; <span class="c-type">SmtpMailer</span>::<span class="c-key">class</span>,
    ];

    <span class="c-key">public</span> <span class="c-key">array</span> <span class="c-var">$singletons</span> = [
        <span class="c-type">PaymentGateway</span>::<span class="c-key">class</span> =&gt; <span class="c-type">StripeGateway</span>::<span class="c-key">class</span>,
        <span class="c-type">CacheManager</span>::<span class="c-key">class</span>   =&gt; <span class="c-type">RedisCacheManager</span>::<span class="c-key">class</span>,
    ];

    <span class="c-comment">// register() и boot() не обязательно определять, если используются массивы.</span>
}
</code></pre>
      <p class="text">Эта форма годится для простых ассоциаций «интерфейс &rarr; класс». Для замыканий-фабрик и сложной логики &mdash; обычные <code>register/boot</code>.</p>
    </div>

    <div class="card">
      <h3>Сводная таблица</h3>
      <table class="data-table">
        <tr><th>Метод</th><th>Когда выполняется</th><th>Что можно</th><th>Что нельзя</th></tr>
        <tr><td><code>register()</code></td><td>Первая фаза, до загрузки всех провайдеров</td><td>bind/singleton, контекст, теги, deferred-метаданные</td><td>Использовать другие сервисы, фасады, маршруты</td></tr>
        <tr><td><code>boot()</code></td><td>Вторая фаза, после регистрации всех</td><td>Использовать любые сервисы, регистрировать маршруты, observers, listeners, директивы</td><td>(всё доступно)</td></tr>
        <tr><td><code>booted()</code> колбэк</td><td>После завершения всех boot</td><td>Финальные инициализации, требующие полностью готового приложения</td><td>(всё доступно)</td></tr>
        <tr><td><code>$bindings</code>/<code>$singletons</code></td><td>Автоматически выполняются в register</td><td>Простые «интерфейс &rarr; класс» ассоциации</td><td>Замыкания, сложная логика, контекстные binding</td></tr>
      </table>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: правильное распределение кода между фазами</div>
    <p class="text">Рассмотрим провайдер модуля Notifications с разными типами инициализации, и покажем, какой код в какой фазе должен находиться.</p>

<pre><code><span class="c-key">namespace</span> <span class="c-type">App\Modules\Notifications\Providers</span>;

<span class="c-key">use</span> <span class="c-type">App\Modules\Notifications\Channels\PushChannel</span>;
<span class="c-key">use</span> <span class="c-type">App\Modules\Notifications\Channels\SlackChannel</span>;
<span class="c-key">use</span> <span class="c-type">App\Modules\Notifications\Channels\SmsChannel</span>;
<span class="c-key">use</span> <span class="c-type">App\Modules\Notifications\Contracts\NotificationChannel</span>;
<span class="c-key">use</span> <span class="c-type">App\Modules\Notifications\Listeners\BroadcastUserEvent</span>;
<span class="c-key">use</span> <span class="c-type">App\Modules\Notifications\Models\NotificationLog</span>;
<span class="c-key">use</span> <span class="c-type">App\Modules\Notifications\Observers\NotificationLogObserver</span>;
<span class="c-key">use</span> <span class="c-type">App\Modules\Notifications\Routes</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Contracts\Events\Dispatcher</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Blade</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Route</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\ServiceProvider</span>;

<span class="c-key">class</span> <span class="c-type">NotificationsServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-comment">// Простые ассоциации.</span>
    <span class="c-key">public</span> <span class="c-key">array</span> <span class="c-var">$singletons</span> = [
        <span class="c-type">PushChannel</span>::<span class="c-key">class</span>  =&gt; <span class="c-type">PushChannel</span>::<span class="c-key">class</span>,
        <span class="c-type">SlackChannel</span>::<span class="c-key">class</span> =&gt; <span class="c-type">SlackChannel</span>::<span class="c-key">class</span>,
        <span class="c-type">SmsChannel</span>::<span class="c-key">class</span>   =&gt; <span class="c-type">SmsChannel</span>::<span class="c-key">class</span>,
    ];

    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// ✓ Контекстный binding — выполняется при разрешении.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">when</span>([<span class="c-type">SmsChannel</span>::<span class="c-key">class</span>])
            -><span class="c-fn">needs</span>(<span class="c-str">'$apiKey'</span>)
            -><span class="c-fn">giveConfig</span>(<span class="c-str">'notifications.sms.api_key'</span>);

        <span class="c-comment">// ✓ Слияние дефолтной конфигурации.</span>
        <span class="c-var">$this</span>-><span class="c-fn">mergeConfigFrom</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../config/notifications.php'</span>, <span class="c-str">'notifications'</span>);

        <span class="c-comment">// ✓ Tagging — пометки в контейнере, не вызов сервисов.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">tag</span>([
            <span class="c-type">PushChannel</span>::<span class="c-key">class</span>,
            <span class="c-type">SlackChannel</span>::<span class="c-key">class</span>,
            <span class="c-type">SmsChannel</span>::<span class="c-key">class</span>,
        ], <span class="c-str">'notification-channels'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">boot</span>(<span class="c-type">Dispatcher</span> <span class="c-var">$events</span>): <span class="c-key">void</span>
    {
        <span class="c-comment">// ✓ Маршруты — фасад Route доступен.</span>
        <span class="c-type">Route</span>::<span class="c-fn">middleware</span>(<span class="c-str">'web'</span>)
            -><span class="c-fn">prefix</span>(<span class="c-str">'notifications'</span>)
            -><span class="c-fn">group</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../routes/web.php'</span>);

        <span class="c-comment">// ✓ Миграции и шаблоны.</span>
        <span class="c-var">$this</span>-><span class="c-fn">loadMigrationsFrom</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../database/migrations'</span>);
        <span class="c-var">$this</span>-><span class="c-fn">loadViewsFrom</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../resources/views'</span>, <span class="c-str">'notifications'</span>);

        <span class="c-comment">// ✓ Observers — модель уже загружена и Eloquent готов.</span>
        <span class="c-type">NotificationLog</span>::<span class="c-fn">observe</span>(<span class="c-type">NotificationLogObserver</span>::<span class="c-key">class</span>);

        <span class="c-comment">// ✓ Event listeners через method-injected dispatcher.</span>
        <span class="c-var">$events</span>-><span class="c-fn">listen</span>(
            \<span class="c-type">App\Events\UserRegistered</span>::<span class="c-key">class</span>,
            <span class="c-type">BroadcastUserEvent</span>::<span class="c-key">class</span>,
        );

        <span class="c-comment">// ✓ Blade-директива.</span>
        <span class="c-type">Blade</span>::<span class="c-fn">directive</span>(<span class="c-str">'notify'</span>, <span class="c-key">fn</span> (<span class="c-var">$expr</span>) =&gt;
            <span class="c-str">"&lt;?php echo notify($expr); ?&gt;"</span>);

        <span class="c-comment">// ✓ Финальная инициализация, когда все провайдеры загружены.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">booted</span>(<span class="c-key">function</span> () {
            <span class="c-comment">// Здесь гарантированно все сервисы готовы.</span>
            \<span class="c-type">Illuminate\Notifications\ChannelManager</span>::<span class="c-fn">macro</span>(<span class="c-str">'allOf'</span>, <span class="c-key">function</span> (<span class="c-key">array</span> <span class="c-var">$channels</span>) {
                <span class="c-comment">// macro для удобного API.</span>
            });
        });
    }
}
</code></pre>

    <p class="text">Сводно: <strong>register</strong> &mdash; декларация (что есть в контейнере); <strong>boot</strong> &mdash; реализация (что приложение делает при старте); <strong>booted</strong> &mdash; финальные коррекции, требующие готовности всех модулей.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. Вызов фасада в <code>register()</code>.</strong> Конструкция <code>Route::get(...)</code> или <code>Storage::disk(...)</code> в <code>register()</code> часто завершается ошибкой «Target class [router] does not exist» или подобной. Причина &mdash; базовый сервис фасада ещё не зарегистрирован. Перенесите вызов в <code>boot()</code> либо в замыкание-фабрику binding'а (которое выполнится при разрешении, а не сейчас).
    </div>
    <div class="pitfall">
      <strong>2. <code>app()-&gt;make($otherService)</code> в <code>register()</code>.</strong> Если <code>$otherService</code> регистрируется в провайдере, который ещё не отработал <code>register</code>, попытка <code>make</code> вернёт несконфигурированный сервис или выкинет исключение. Зависимости провайдеров через <code>make</code> в <code>register</code> &mdash; антипаттерн; используйте конструктор инстанса (где зависимости разрешатся при первом обращении) или перенос в <code>boot</code>.
    </div>
    <div class="pitfall">
      <strong>3. Регистрация observer'ов в <code>register()</code>.</strong> Eloquent инициализируется в системных провайдерах; в <code>register</code> модели могут быть ещё не готовы. <code>Model::observe()</code> в <code>register</code> может работать на одних версиях Laravel и падать на других. Корректное место &mdash; <code>boot()</code>.
    </div>
    <div class="pitfall">
      <strong>4. Загрузка маршрутов в <code>register</code>.</strong> <code>Route::group()</code> требует доступа к маршрутизатору. В <code>register</code> доступ может быть некорректным или маршруты не будут видны другим компонентам. Маршруты &mdash; только в <code>boot()</code>.
    </div>
    <div class="pitfall">
      <strong>5. Method injection в <code>register</code> запрещён.</strong> В отличие от <code>boot</code>, параметры <code>register()</code> не разрешаются автоматически &mdash; контейнер не готов гарантированно разрешать что-либо в этот момент. Используйте <code>$this-&gt;app</code> внутри метода.
    </div>
    <div class="pitfall">
      <strong>6. Долгая регистрация в <code>register()</code>.</strong> <code>register</code> провайдеров вызывается на каждом запросе. Дорогая работа в нём (чтение файлов, разбор больших конфигов, обращения к сети) накапливается. Тяжёлая инициализация &mdash; либо в <code>boot</code> с проверкой условий, либо в Deferred Provider.
    </div>
    <div class="pitfall">
      <strong>7. Порядок провайдеров в <code>providers.php</code>.</strong> Провайдеры регистрируются в порядке перечисления. Если провайдер B зависит от того, что A зарегистрировал, A должен идти раньше в списке. Это редко становится проблемой при правильном разделении register/boot, но в edge-cases &mdash; источник трудно отлавливаемых багов.
    </div>
    <div class="pitfall">
      <strong>8. Использование <code>booted</code> для критичного кода.</strong> Колбэки <code>booted</code> срабатывают после всех <code>boot</code> &mdash; то есть очень поздно в жизненном цикле. Если внутри <code>booted</code> регистрируется маршрут или middleware, они уже могут быть слишком поздно для текущего запроса. Используйте <code>booted</code> для дополнительных настроек, не для базовой регистрации.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     DEFERRED PROVIDERS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-deferred" class="section">
  <div class="section-title">Deferred Providers</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Deferred Provider &mdash; провайдер, регистрация которого откладывается до момента, когда впервые понадобится один из зарегистрированных им сервисов. Это оптимизация холодного старта: вместо того чтобы инициализировать все модули на каждом запросе, фреймворк загружает только тот, чьи сервисы реально были запрошены.</p>
    <p class="text">Применяется для тяжёлых пакетов, используемых эпизодически: PDF-генератор, аналитический пайплайн, интеграция с внешним API, импорт/экспорт. На веб-запросах, где эти сервисы не нужны, провайдер вообще не выполняется &mdash; экономится время и ресурсы.</p>
    <p class="text">В обмен на оптимизацию deferred-провайдер обязан декларативно объявить, какие abstracts он будет регистрировать. Laravel хранит этот список в кеше (<code>bootstrap/cache/services.php</code>) и при запросе одного из этих abstracts знает, какой провайдер нужно загрузить.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Реализация и поведение</div>

    <div class="card">
      <h3>Интерфейс <code>DeferrableProvider</code></h3>
      <p class="text">Для пометки провайдера как deferred класс должен реализовать интерфейс <code>Illuminate\Contracts\Support\DeferrableProvider</code>. Это маркерный интерфейс без методов &mdash; его наличие говорит фреймворку «загружать только по требованию». Дополнительно класс реализует метод <code>provides()</code>, возвращающий массив abstracts, которые регистрирует провайдер.</p>
<pre><code><span class="c-key">namespace</span> <span class="c-type">App\Providers</span>;

<span class="c-key">use</span> <span class="c-type">App\Services\PdfRenderer</span>;
<span class="c-key">use</span> <span class="c-type">App\Services\PdfTemplateCompiler</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Contracts\Support\DeferrableProvider</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\ServiceProvider</span>;

<span class="c-key">class</span> <span class="c-type">PdfServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span> <span class="c-key">implements</span> <span class="c-type">DeferrableProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">PdfRenderer</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">Container</span> <span class="c-var">$app</span>) {
            <span class="c-key">return new</span> <span class="c-type">PdfRenderer</span>(
                compiler: <span class="c-var">$app</span>-><span class="c-fn">make</span>(<span class="c-type">PdfTemplateCompiler</span>::<span class="c-key">class</span>),
                fontPath: <span class="c-fn">config</span>(<span class="c-str">'pdf.fonts.path'</span>),
                tempDir:  <span class="c-fn">storage_path</span>(<span class="c-str">'pdf/tmp'</span>),
            );
        });

        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">PdfTemplateCompiler</span>::<span class="c-key">class</span>);
    }

    <span class="c-comment">// Обязательный метод для DeferrableProvider.</span>
    <span class="c-key">public function</span> <span class="c-fn">provides</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-type">PdfRenderer</span>::<span class="c-key">class</span>,
            <span class="c-type">PdfTemplateCompiler</span>::<span class="c-key">class</span>,
        ];
    }
}
</code></pre>
    </div>

    <div class="card">
      <h3>Поведение во время запроса</h3>
      <p class="text">Laravel при старте приложения:</p>
      <ol class="bullets" style="list-style:decimal;">
        <li>Загружает кеш <code>services.php</code> (если не существует &mdash; пересоздаёт через <code>provides()</code> каждого DeferrableProvider).</li>
        <li>Для обычных провайдеров &mdash; немедленно вызывает <code>register()</code>, потом <code>boot()</code>.</li>
        <li>Для DeferrableProvider &mdash; запоминает соответствие «abstract &rarr; provider», но <code>register()</code> не вызывает.</li>
        <li>Когда код запрашивает <code>app()-&gt;make($abstract)</code>, и <code>$abstract</code> числится в списке отложенных, фреймворк сначала вызывает <code>register()</code> соответствующего провайдера, а затем выполняет разрешение.</li>
      </ol>
    </div>

    <div class="card">
      <h3>Кеш сервисов и <code>php artisan config:cache</code></h3>
      <p class="text">При выполнении <code>php artisan optimize</code> или <code>php artisan config:cache</code> Laravel вызывает <code>provides()</code> у всех deferrable-провайдеров и записывает результат в <code>bootstrap/cache/services.php</code>. На production этот кеш переиспользуется между запросами, что и даёт реальную экономию.</p>
      <p class="text">В development-окружении без кеша Laravel вызывает <code>provides()</code> на каждом запросе; экономия от deferred-провайдеров ограничена самим деферированным <code>register</code>. Поэтому критичный эффект deferred-провайдеры дают именно в production.</p>
<pre><code><span class="c-comment"># Создать кеш сервисов на production.</span>
php artisan config:cache
<span class="c-comment"># Создаст bootstrap/cache/services.php с массивом deferred-провайдеров.</span>

<span class="c-comment"># Очистить при обновлении кода.</span>
php artisan config:clear
</code></pre>
    </div>

    <div class="card">
      <h3>Ограничения deferred-провайдеров</h3>
      <p class="text">Не любой провайдер можно сделать deferred. Чтобы провайдер был корректно deferrable:</p>
      <ul class="bullets">
        <li>Все его действия по инициализации должны быть в <code>register()</code> &mdash; deferred провайдеры <strong>не</strong> вызывают <code>boot()</code> «как обычно». Точнее, <code>boot()</code> вызывается только в момент первого запроса сервиса из <code>provides()</code>, а не в общем boot-цикле приложения. Это означает: маршруты, observers моделей, event listeners из <code>boot()</code> deferred-провайдера могут не сработать, если ни один из сервисов так и не был запрошен в течение запроса;</li>
        <li>Метод <code>provides()</code> должен точно перечислять все abstracts, регистрируемые в <code>register()</code>;</li>
        <li>Провайдер не должен иметь побочных эффектов, нужных «всегда» (например, регистрация event-listener на общую модель приложения).</li>
      </ul>
      <p class="text">Если эти условия не выполнены &mdash; провайдер должен быть обычным, не deferred.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: deferred-провайдер для PDF-генерации</div>
    <p class="text">Веб-приложение использует PDF-генерацию только в одной фиче (формирование счёт-фактур) и в одной Artisan-команде (массовая отправка отчётов). На остальных запросах эта подсистема не нужна. Делаем её deferred.</p>

<pre><code><span class="c-key">namespace</span> <span class="c-type">App\Providers</span>;

<span class="c-key">use</span> <span class="c-type">App\Pdf\PdfEngine</span>;
<span class="c-key">use</span> <span class="c-type">App\Pdf\Compilers\BladePdfCompiler</span>;
<span class="c-key">use</span> <span class="c-type">App\Pdf\Renderers\DompdfRenderer</span>;
<span class="c-key">use</span> <span class="c-type">App\Pdf\Storage\PdfStorage</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Contracts\Container\Container</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Contracts\Support\DeferrableProvider</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\ServiceProvider</span>;

<span class="c-key">class</span> <span class="c-type">PdfServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span> <span class="c-key">implements</span> <span class="c-type">DeferrableProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// Компилятор Blade-шаблонов в HTML.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">BladePdfCompiler</span>::<span class="c-key">class</span>);

        <span class="c-comment">// Renderer на базе Dompdf — тяжёлая инициализация.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">DompdfRenderer</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">Container</span> <span class="c-var">$app</span>) {
            <span class="c-var">$config</span> = <span class="c-fn">config</span>(<span class="c-str">'pdf'</span>);
            <span class="c-key">return new</span> <span class="c-type">DompdfRenderer</span>(
                paperSize: <span class="c-var">$config</span>[<span class="c-str">'paper_size'</span>] ?? <span class="c-str">'A4'</span>,
                fontPath:  <span class="c-var">$config</span>[<span class="c-str">'font_path'</span>],
                enableRemote: <span class="c-var">$config</span>[<span class="c-str">'enable_remote'</span>] ?? <span class="c-key">false</span>,
            );
        });

        <span class="c-comment">// Хранилище сгенерированных PDF.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">PdfStorage</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">Container</span> <span class="c-var">$app</span>) {
            <span class="c-key">return new</span> <span class="c-type">PdfStorage</span>(
                disk: <span class="c-fn">app</span>(<span class="c-str">'filesystem'</span>)-><span class="c-fn">disk</span>(<span class="c-str">'pdf'</span>),
                retention: <span class="c-fn">config</span>(<span class="c-str">'pdf.retention_days'</span>, <span class="c-num">30</span>),
            );
        });

        <span class="c-comment">// Высокоуровневый сервис, объединяющий всё.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">PdfEngine</span>::<span class="c-key">class</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">provides</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-type">BladePdfCompiler</span>::<span class="c-key">class</span>,
            <span class="c-type">DompdfRenderer</span>::<span class="c-key">class</span>,
            <span class="c-type">PdfStorage</span>::<span class="c-key">class</span>,
            <span class="c-type">PdfEngine</span>::<span class="c-key">class</span>,
        ];
    }
}
</code></pre>

    <p class="text">Использование &mdash; обычное. Контроллер счёта-фактуры объявляет в конструкторе <code>PdfEngine</code>, и фреймворк прозрачно загружает PdfServiceProvider при первом запросе:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">InvoiceController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private readonly</span> <span class="c-type">PdfEngine</span> <span class="c-var">$pdf</span>) {}
    <span class="c-comment">// При первом обращении к /invoices/{id}/download:</span>
    <span class="c-comment">// 1. Laravel ищет PdfEngine в кеше services.php → находит PdfServiceProvider.</span>
    <span class="c-comment">// 2. Вызывает PdfServiceProvider::register().</span>
    <span class="c-comment">// 3. Разрешает все зависимости PdfEngine рекурсивно.</span>
    <span class="c-comment">// 4. Передаёт готовый engine в конструктор контроллера.</span>

    <span class="c-key">public function</span> <span class="c-fn">download</span>(<span class="c-type">Invoice</span> <span class="c-var">$invoice</span>): <span class="c-type">StreamedResponse</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-><span class="c-var">pdf</span>-><span class="c-fn">render</span>(<span class="c-str">'invoices.print'</span>, [<span class="c-str">'invoice'</span> =&gt; <span class="c-var">$invoice</span>]);
    }
}
</code></pre>

    <p class="text">На всех остальных запросах PdfServiceProvider не выполняется. На страницах списка товаров, поиска, корзины &mdash; нет инициализации Dompdf, не загружается несколько мегабайт классов, не создаётся временная директория. Это становится особенно заметным с десятком тяжёлых модулей в одном приложении.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. <code>provides()</code> неполный или устаревший.</strong> Если в провайдере регистрируется сервис, не указанный в <code>provides()</code>, обращение к нему через <code>make</code> не запустит провайдер &mdash; abstract будет считаться неизвестным, и Laravel попытается autowire или выкинет исключение. Всегда поддерживайте <code>provides()</code> в актуальном состоянии при добавлении новых binding'ов.
    </div>
    <div class="pitfall">
      <strong>2. <code>boot()</code> в deferred-провайдере.</strong> Метод <code>boot()</code> в deferred-провайдере вызывается только когда первый сервис из <code>provides()</code> разрешён. На запросах, где сервисы не нужны, <code>boot()</code> не выполняется. Если в <code>boot()</code> регистрируются маршруты, observers, event listeners &mdash; они не сработают на «холодных» запросах. Решение &mdash; не делать провайдер deferred, либо вынести инициализацию маршрутов и т.п. в обычный провайдер.
    </div>
    <div class="pitfall">
      <strong>3. Кеш сервисов не обновлён.</strong> После добавления нового deferred-провайдера или изменения <code>provides()</code> необходимо очистить кеш через <code>php artisan optimize:clear</code> или <code>config:clear</code>. Иначе Laravel будет использовать устаревший список deferred-провайдеров. На production это особенно важно: deploy-скрипты обычно вызывают <code>config:cache</code> для пересоздания кеша.
    </div>
    <div class="pitfall">
      <strong>4. Преждевременная оптимизация.</strong> Делать deferred-провайдером каждый небольшой сервис &mdash; преждевременная оптимизация. Реальная экономия от deferred &mdash; десятки миллисекунд для тяжёлых пакетов. Если провайдер компактный (несколько binding'ов простых классов), сложность сопровождения <code>provides()</code> может превышать выигрыш.
    </div>
    <div class="pitfall">
      <strong>5. Тестирование deferred-провайдера.</strong> В тестах легко не заметить, что deferred-провайдер не отработал, потому что сервисы из него не были запрошены. Если тест проверяет регистрацию binding'а в <code>register()</code>, но в самом тесте этот сервис не используется, провайдер не запустится. Принудительный запуск: <code>app(SomeServiceFromProvides::class)</code> или <code>app()-&gt;register(PdfServiceProvider::class)</code>.
    </div>
    <div class="pitfall">
      <strong>6. Несколько deferred-провайдеров регистрируют один abstract.</strong> Если два провайдера в <code>provides()</code> упомянули один и тот же abstract, поведение зависит от порядка в <code>services.php</code> &mdash; и не гарантируется. Один и тот же abstract должен быть «закреплён» за единственным провайдером.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PACKAGE PROVIDERS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-packages" class="section">
  <div class="section-title">Package Providers</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Package Provider &mdash; ServiceProvider, поставляемый в составе Composer-пакета. По функциональности не отличается от приложенческого провайдера, но имеет ряд дополнительных задач: автоматическая регистрация через mechanism Laravel auto-discovery, публикация ресурсов (конфиги, миграции, assets, views) в приложение пользователя пакета, слияние дефолтной конфигурации с пользовательской переопределённой.</p>
    <p class="text">Package Providers &mdash; основной механизм расширения Laravel: spatie-пакеты, Nova, Sanctum, Telescope, Pulse &mdash; всё это пакеты со своими провайдерами. Понимание устройства таких провайдеров критично для двух задач: использования сторонних пакетов с осознанным выбором (включить только нужное, не зарегистрировать всё подряд) и написания собственных пакетов под нужды команды.</p>
    <p class="text">Provider пакета должен быть «вежливым»: не перетирать пользовательские настройки, давать возможность точечной публикации только нужных частей, поддерживать <code>config:cache</code> в production, не делать heavy work на каждом запросе. Эти ожидания формируют конкретные паттерны кода в <code>register()</code> и <code>boot()</code>.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Компоненты пакета</div>

    <div class="card">
      <h3>Auto-discovery через <code>composer.json</code></h3>
      <p class="text">В <code>composer.json</code> пакета объявляется секция <code>extra.laravel</code> с перечислением провайдеров и aliases. Когда пакет устанавливается через <code>composer require</code>, Laravel автоматически регистрирует его провайдер &mdash; пользователю не нужно править <code>bootstrap/providers.php</code>.</p>
<pre><code><span class="c-comment">// composer.json пакета</span>
{
    <span class="c-str">"name"</span>: <span class="c-str">"acme/payment-kit"</span>,
    <span class="c-str">"description"</span>: <span class="c-str">"Unified payment gateway abstraction"</span>,
    <span class="c-str">"require"</span>: { <span class="c-str">"php"</span>: <span class="c-str">"^8.2"</span>, <span class="c-str">"illuminate/support"</span>: <span class="c-str">"^11.0|^12.0"</span> },
    <span class="c-str">"autoload"</span>: {
        <span class="c-str">"psr-4"</span>: { <span class="c-str">"Acme\\PaymentKit\\\\"</span>: <span class="c-str">"src/"</span> }
    },
    <span class="c-str">"extra"</span>: {
        <span class="c-str">"laravel"</span>: {
            <span class="c-str">"providers"</span>: [
                <span class="c-str">"Acme\\PaymentKit\\PaymentKitServiceProvider"</span>
            ],
            <span class="c-str">"aliases"</span>: {
                <span class="c-str">"Payment"</span>: <span class="c-str">"Acme\\PaymentKit\\Facades\\Payment"</span>
            }
        }
    }
}
</code></pre>
      <p class="text">Пользователь, отказавшийся от автозагрузки конкретного пакета, добавляет его в <code>extra.laravel.dont-discover</code> своего <code>composer.json</code>:</p>
<pre><code>{
    <span class="c-str">"extra"</span>: {
        <span class="c-str">"laravel"</span>: {
            <span class="c-str">"dont-discover"</span>: [<span class="c-str">"acme/payment-kit"</span>]
        }
    }
}
</code></pre>
    </div>

    <div class="card">
      <h3>Слияние конфигурации: <code>mergeConfigFrom</code></h3>
      <p class="text">Пакет должен предоставлять разумные дефолты, но позволять пользователю их переопределять. Метод <code>mergeConfigFrom</code> в <code>register()</code> сливает дефолтный конфиг пакета с пользовательским (если последний существует) &mdash; пользовательские значения побеждают.</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
{
    <span class="c-comment">// Подгружает config/payment-kit.php приложения, если есть,</span>
    <span class="c-comment">// и сливает с дефолтами пакета.</span>
    <span class="c-var">$this</span>-><span class="c-fn">mergeConfigFrom</span>(
        path: <span class="c-fn">__DIR__</span> . <span class="c-str">'/../config/payment-kit.php'</span>,
        key:  <span class="c-str">'payment-kit'</span>,
    );
}
</code></pre>
      <p class="text">Дефолтный <code>config/payment-kit.php</code> внутри пакета содержит все ключи с разумными значениями. Пользователь публикует его в своё приложение (см. ниже) и переопределяет только то, что нужно.</p>
    </div>

    <div class="card">
      <h3>Публикация ресурсов: <code>publishes</code></h3>
      <p class="text">Через <code>publishes()</code> провайдер пакета объявляет, какие файлы могут быть скопированы в приложение пользователя командой <code>php artisan vendor:publish</code>. Файлы группируются по тегам, что позволяет публиковать только нужные части.</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
{
    <span class="c-comment">// Конфиг.</span>
    <span class="c-var">$this</span>-><span class="c-fn">publishes</span>([
        <span class="c-fn">__DIR__</span> . <span class="c-str">'/../config/payment-kit.php'</span> =&gt; <span class="c-fn">config_path</span>(<span class="c-str">'payment-kit.php'</span>),
    ], <span class="c-str">'payment-kit-config'</span>);

    <span class="c-comment">// Миграции (с timestamp в имени файла).</span>
    <span class="c-var">$this</span>-><span class="c-fn">publishes</span>([
        <span class="c-fn">__DIR__</span> . <span class="c-str">'/../database/migrations/'</span> =&gt; <span class="c-fn">database_path</span>(<span class="c-str">'migrations'</span>),
    ], <span class="c-str">'payment-kit-migrations'</span>);

    <span class="c-comment">// Views.</span>
    <span class="c-var">$this</span>-><span class="c-fn">publishes</span>([
        <span class="c-fn">__DIR__</span> . <span class="c-str">'/../resources/views'</span> =&gt; <span class="c-fn">resource_path</span>(<span class="c-str">'views/vendor/payment-kit'</span>),
    ], <span class="c-str">'payment-kit-views'</span>);

    <span class="c-comment">// Assets (CSS/JS).</span>
    <span class="c-var">$this</span>-><span class="c-fn">publishes</span>([
        <span class="c-fn">__DIR__</span> . <span class="c-str">'/../public'</span> =&gt; <span class="c-fn">public_path</span>(<span class="c-str">'vendor/payment-kit'</span>),
    ], <span class="c-str">'payment-kit-assets'</span>);
}
</code></pre>

      <p class="text">Пользователь публикует выборочно:</p>
<pre><code><span class="c-comment"># Только конфиг.</span>
php artisan vendor:publish --tag=payment-kit-config

<span class="c-comment"># Только миграции.</span>
php artisan vendor:publish --tag=payment-kit-migrations

<span class="c-comment"># Всё разом (все теги пакета).</span>
php artisan vendor:publish --provider=<span class="c-str">"Acme\\PaymentKit\\PaymentKitServiceProvider"</span>
</code></pre>
    </div>

    <div class="card">
      <h3>Загрузка ресурсов без публикации</h3>
      <p class="text">Многие ресурсы пакета не требуют публикации &mdash; они подгружаются непосредственно из директорий пакета. Это касается миграций (если пользователь готов получать их обновления автоматически), views (с собственным namespace), translations, маршрутов.</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
{
    <span class="c-comment">// Миграции работают «из пакета» — обновляются автоматически с обновлением пакета.</span>
    <span class="c-var">$this</span>-><span class="c-fn">loadMigrationsFrom</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../database/migrations'</span>);

    <span class="c-comment">// Views с namespace pkg::view-name.</span>
    <span class="c-var">$this</span>-><span class="c-fn">loadViewsFrom</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../resources/views'</span>, <span class="c-str">'payment-kit'</span>);
    <span class="c-comment">// Использование в Blade: @extends('payment-kit::layouts.app')</span>

    <span class="c-comment">// Translations с namespace pkg::group.key.</span>
    <span class="c-var">$this</span>-><span class="c-fn">loadTranslationsFrom</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../resources/lang'</span>, <span class="c-str">'payment-kit'</span>);
    <span class="c-comment">// Использование: __('payment-kit::messages.charge_failed')</span>

    <span class="c-comment">// Routes.</span>
    <span class="c-var">$this</span>-><span class="c-fn">loadRoutesFrom</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../routes/web.php'</span>);
}
</code></pre>
    </div>

    <div class="card">
      <h3>Регистрация фасадов и Artisan-команд</h3>
      <p class="text">Если пакет предоставляет фасад, сам класс фасада объявляется в коде пакета (наследует <code>Illuminate\Support\Facades\Facade</code>), а его alias регистрируется через <code>composer.json</code> (см. выше) или явно через <code>AliasLoader</code> в провайдере.</p>
      <p class="text">Artisan-команды регистрируются в <code>boot()</code> с проверкой <code>$this-&gt;app-&gt;runningInConsole()</code>, чтобы не загружать их на веб-запросах.</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
{
    <span class="c-key">if</span> (<span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">runningInConsole</span>()) {
        <span class="c-var">$this</span>-><span class="c-fn">commands</span>([
            \<span class="c-type">Acme\PaymentKit\Console\SyncTransactionsCommand</span>::<span class="c-key">class</span>,
            \<span class="c-type">Acme\PaymentKit\Console\ReconcileBalancesCommand</span>::<span class="c-key">class</span>,
        ]);
    }
}
</code></pre>
    </div>

    <div class="card">
      <h3>Чек-лист провайдера пакета</h3>
      <table class="data-table">
        <tr><th>Действие</th><th>Где</th><th>Зачем</th></tr>
        <tr><td><code>mergeConfigFrom(...)</code></td><td>register</td><td>Дефолты + пользовательские override</td></tr>
        <tr><td><code>bind/singleton</code> сервисов</td><td>register</td><td>Регистрация контейнерных биндингов</td></tr>
        <tr><td><code>publishes(...)</code></td><td>boot</td><td>Объявить, что можно публиковать</td></tr>
        <tr><td><code>loadMigrationsFrom(...)</code></td><td>boot</td><td>Миграции «из пакета»</td></tr>
        <tr><td><code>loadViewsFrom(..., 'ns')</code></td><td>boot</td><td>Blade-templates с namespace</td></tr>
        <tr><td><code>loadTranslationsFrom(...)</code></td><td>boot</td><td>Переводы</td></tr>
        <tr><td><code>loadRoutesFrom(...)</code></td><td>boot</td><td>Маршруты пакета</td></tr>
        <tr><td><code>$this-&gt;commands(...)</code></td><td>boot + runningInConsole</td><td>Artisan-команды</td></tr>
        <tr><td><code>Model::observe(...)</code></td><td>boot</td><td>Observers моделей пакета</td></tr>
      </table>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сквозной пример: минимальный пакет аудита</div>
    <p class="text">Рассмотрим небольшой пакет <code>acme/audit-log</code> &mdash; журналирование операций с прокрутки моделей. Он содержит: одну модель <code>AuditEntry</code>, миграцию, фасад <code>Audit</code>, конфиг с настройкой подключения и retention-политикой, две Artisan-команды для очистки.</p>

<pre><code><span class="c-comment">// composer.json пакета</span>
{
    <span class="c-str">"name"</span>: <span class="c-str">"acme/audit-log"</span>,
    <span class="c-str">"description"</span>: <span class="c-str">"Domain-agnostic audit logging for Laravel"</span>,
    <span class="c-str">"autoload"</span>: { <span class="c-str">"psr-4"</span>: { <span class="c-str">"Acme\\AuditLog\\\\"</span>: <span class="c-str">"src/"</span> } },
    <span class="c-str">"extra"</span>: {
        <span class="c-str">"laravel"</span>: {
            <span class="c-str">"providers"</span>: [<span class="c-str">"Acme\\AuditLog\\AuditLogServiceProvider"</span>],
            <span class="c-str">"aliases"</span>:  { <span class="c-str">"Audit"</span>: <span class="c-str">"Acme\\AuditLog\\Facades\\Audit"</span> }
        }
    }
}
</code></pre>

<pre><code><span class="c-comment">// src/AuditLogServiceProvider.php</span>
<span class="c-key">namespace</span> <span class="c-type">Acme\AuditLog</span>;

<span class="c-key">use</span> <span class="c-type">Acme\AuditLog\Console\PruneAuditCommand</span>;
<span class="c-key">use</span> <span class="c-type">Acme\AuditLog\Console\ExportAuditCommand</span>;
<span class="c-key">use</span> <span class="c-type">Acme\AuditLog\Contracts\AuditRecorder</span>;
<span class="c-key">use</span> <span class="c-type">Acme\AuditLog\Services\DatabaseAuditRecorder</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Contracts\Container\Container</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\ServiceProvider</span>;

<span class="c-key">class</span> <span class="c-type">AuditLogServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// 1. Сливаем дефолтный конфиг пакета.</span>
        <span class="c-var">$this</span>-><span class="c-fn">mergeConfigFrom</span>(
            <span class="c-fn">__DIR__</span> . <span class="c-str">'/../config/audit.php'</span>, <span class="c-str">'audit'</span>
        );

        <span class="c-comment">// 2. Связываем контракт с реализацией. Singleton — recorder stateless.</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">singleton</span>(<span class="c-type">AuditRecorder</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">Container</span> <span class="c-var">$app</span>) {
            <span class="c-key">return new</span> <span class="c-type">DatabaseAuditRecorder</span>(
                connection: <span class="c-fn">config</span>(<span class="c-str">'audit.connection'</span>) ?? <span class="c-fn">config</span>(<span class="c-str">'database.default'</span>),
                table:      <span class="c-fn">config</span>(<span class="c-str">'audit.table'</span>, <span class="c-str">'audit_entries'</span>),
            );
        });

        <span class="c-comment">// 3. Регистрируем alias для удобства: app('audit').</span>
        <span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">alias</span>(<span class="c-type">AuditRecorder</span>::<span class="c-key">class</span>, <span class="c-str">'audit'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// 4. Объявляем публикуемые ресурсы с раздельными тегами.</span>
        <span class="c-var">$this</span>-><span class="c-fn">publishes</span>([
            <span class="c-fn">__DIR__</span> . <span class="c-str">'/../config/audit.php'</span> =&gt; <span class="c-fn">config_path</span>(<span class="c-str">'audit.php'</span>),
        ], <span class="c-str">'audit-config'</span>);

        <span class="c-var">$this</span>-><span class="c-fn">publishes</span>([
            <span class="c-fn">__DIR__</span> . <span class="c-str">'/../database/migrations'</span> =&gt; <span class="c-fn">database_path</span>(<span class="c-str">'migrations'</span>),
        ], <span class="c-str">'audit-migrations'</span>);

        <span class="c-comment">// 5. Загружаем миграции «из пакета» — обновляются с пакетом.</span>
        <span class="c-comment">// (Альтернатива: пусть пользователь публикует и контролирует сам.)</span>
        <span class="c-var">$this</span>-><span class="c-fn">loadMigrationsFrom</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../database/migrations'</span>);

        <span class="c-comment">// 6. Регистрируем Artisan-команды только в CLI-окружении.</span>
        <span class="c-key">if</span> (<span class="c-var">$this</span>-><span class="c-fn">app</span>-><span class="c-fn">runningInConsole</span>()) {
            <span class="c-var">$this</span>-><span class="c-fn">commands</span>([
                <span class="c-type">PruneAuditCommand</span>::<span class="c-key">class</span>,
                <span class="c-type">ExportAuditCommand</span>::<span class="c-key">class</span>,
            ]);
        }
    }
}
</code></pre>

    <p class="text">Использование на стороне пользователя:</p>
<pre><code><span class="c-comment"># Установка</span>
composer require acme/audit-log

<span class="c-comment"># Опционально: опубликовать конфиг для кастомизации.</span>
php artisan vendor:publish --tag=audit-config

<span class="c-comment"># Миграции уже автоматически подхватятся следующим artisan migrate.</span>
php artisan migrate
</code></pre>

<pre><code><span class="c-comment">// В коде пользователя</span>
<span class="c-key">use</span> <span class="c-type">Acme\AuditLog\Contracts\AuditRecorder</span>;

<span class="c-key">class</span> <span class="c-type">OrderController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private readonly</span> <span class="c-type">AuditRecorder</span> <span class="c-var">$audit</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">cancel</span>(<span class="c-type">Order</span> <span class="c-var">$order</span>): <span class="c-type">Response</span>
    {
        <span class="c-var">$order</span>-><span class="c-fn">cancel</span>();

        <span class="c-var">$this</span>-><span class="c-var">audit</span>-><span class="c-fn">record</span>(<span class="c-str">'order.cancelled'</span>, [
            <span class="c-str">'order_id'</span> =&gt; <span class="c-var">$order</span>-><span class="c-var">id</span>,
            <span class="c-str">'reason'</span>   =&gt; <span class="c-fn">request</span>(<span class="c-str">'reason'</span>),
        ]);

        <span class="c-key">return</span> <span class="c-fn">response</span>(...);
    }
}

<span class="c-comment">// Или через фасад:</span>
<span class="c-type">Audit</span>::<span class="c-fn">record</span>(<span class="c-str">'order.cancelled'</span>, [...]);
</code></pre>

    <p class="text">Достоинства пакетной структуры: возможность переиспользования между проектами без копипасты, версионирование через Composer, понятная история обновлений, явные публичные контракты в виде интерфейсов.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. Регистрация маршрутов без проверки кеша.</strong> Если пользователь применяет <code>php artisan route:cache</code>, маршруты пакета должны быть включены в кеш. Метод <code>loadRoutesFrom</code> корректно интегрируется с механизмом кеширования; ручная регистрация через <code>Route::get</code> в провайдере &mdash; нет.
    </div>
    <div class="pitfall">
      <strong>2. <code>publishes</code> для не существующих файлов.</strong> Если путь источника в <code>publishes</code> указан неверно или файл не существует на момент выполнения, <code>vendor:publish</code> молча проигнорирует его. Тестируйте публикацию на чистой установке.
    </div>
    <div class="pitfall">
      <strong>3. Дублирующиеся имена тегов.</strong> Если два пакета используют одинаковый тег для <code>publishes</code> (например, <code>'config'</code>), при <code>vendor:publish --tag=config</code> опубликуются оба &mdash; иногда нежелательно. Используйте уникальные префиксы: <code>audit-config</code>, <code>payment-kit-config</code>.
    </div>
    <div class="pitfall">
      <strong>4. <code>mergeConfigFrom</code> и глубокий merge.</strong> Стандартный <code>mergeConfigFrom</code> делает shallow merge: пользовательские значения первого уровня перезаписывают дефолтные, но вложенные ключи &mdash; нет. Это часто приводит к тому, что пользователь, переопределяя один параметр в массиве, теряет остальные. Решение &mdash; рекурсивный merge через <code>array_replace_recursive</code> в провайдере, либо документировать как должен выглядеть полный конфиг.
    </div>
    <div class="pitfall">
      <strong>5. Конфликт версий зависимостей.</strong> Пакет должен корректно указывать допустимые версии Laravel в <code>composer.json</code>. Использование <code>illuminate/support: "^11.0"</code> исключает поддержку 12.x &mdash; пользователь не сможет обновиться. Тестируйте на нескольких версиях, расширяйте constraints по мере подтверждения совместимости.
    </div>
    <div class="pitfall">
      <strong>6. Тяжёлая работа в <code>register</code> пакета.</strong> Пакет может быть deferred, чтобы не загружаться на запросах, где он не нужен. Это особенно важно для пакетов уровня инфраструктуры (PDF, аналитика, отчёты), которые включаются в большинство проектов, но используются редко.
    </div>
    <div class="pitfall">
      <strong>7. Auto-discovery как зависимость.</strong> Если пакет полагается на auto-discovery и пользователь его отключил (<code>dont-discover</code>), провайдер не загрузится. Документируйте, что в этом случае пользователю нужно вручную добавить провайдер в <code>bootstrap/providers.php</code>.
    </div>
    <div class="pitfall">
      <strong>8. Изменение публикуемых файлов между версиями.</strong> Если пакет публикует миграцию или конфиг, и в новой версии этот файл изменился &mdash; пользователь не получит обновление автоматически. <code>vendor:publish</code> по умолчанию не перезаписывает существующие файлы. Документация и опция <code>--force</code> &mdash; единственные средства уведомить пользователя.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PRACTICE — сквозной сценарий
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-practice" class="section">
  <div class="section-title">Практика: модуль биллинга от контракта до пакета</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> Постановка задачи</div>
    <p class="text">Задача &mdash; собрать модуль <code>Billing</code>, демонстрирующий все рассмотренные техники контейнера в одном сценарии. Требования к модулю:</p>
    <ul class="bullets">
      <li>контракт <code>PaymentGateway</code> с двумя реализациями: <strong>StripeGateway</strong> (продакшен) и <strong>FakeGateway</strong> (тесты, локальная разработка);</li>
      <li>сервис <code>SubscriptionService</code> работает только со Stripe (фиксированно по бизнес-требованию);</li>
      <li>сервис <code>CheckoutService</code> выбирает реализацию по конфигурации мерчанта (контекстуально на уровне арендатора);</li>
      <li>набор <strong>правил риска</strong> (<code>RiskRule</code>) подключается через теги &mdash; их количество растёт независимо от ядра;</li>
      <li>в рамках одного HTTP-запроса используется общий <code>BillingContext</code> (идемпотентность операций) &mdash; <code>scoped</code> биндинг;</li>
      <li>провайдер модуля &mdash; <strong>deferred</strong>, потому что биллинг затрагивает только маршруты checkout/subscription;</li>
      <li>модуль оформлен как <strong>отдельный пакет</strong> <code>acme/billing</code> с auto-discovery, публикацией конфигурации и миграциями.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="folder-tree"></i> Структура пакета</div>
<pre><code>packages/acme/billing/
├── composer.json
├── config/
│   └── billing.php
├── database/
│   └── migrations/
│       └── 2026_05_22_000001_create_billing_charges_table.php
├── routes/
│   └── web.php
├── src/
│   ├── Contracts/
│   │   └── PaymentGateway.php
│   ├── Gateways/
│   │   ├── StripeGateway.php
│   │   └── FakeGateway.php
│   ├── Risk/
│   │   ├── RiskRule.php
│   │   ├── VelocityRule.php
│   │   ├── GeoMismatchRule.php
│   │   ├── BlocklistRule.php
│   │   └── RiskEngine.php
│   ├── Services/
│   │   ├── BillingContext.php
│   │   ├── CheckoutService.php
│   │   └── SubscriptionService.php
│   └── Providers/
│       └── BillingServiceProvider.php
└── tests/
    └── ...
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-code"></i> Контракт и реализации</div>

<pre><code><span class="c-comment">// packages/acme/billing/src/Contracts/PaymentGateway.php</span>
<span class="c-key">namespace</span> <span class="c-type">Acme\Billing\Contracts</span>;

<span class="c-key">interface</span> <span class="c-type">PaymentGateway</span>
{
    <span class="c-key">public function</span> <span class="c-fn">charge</span>(<span class="c-key">int</span> <span class="c-var">$amountMinor</span>, <span class="c-key">string</span> <span class="c-var">$currency</span>, <span class="c-key">string</span> <span class="c-var">$idempotencyKey</span>): <span class="c-key">string</span>;
    <span class="c-key">public function</span> <span class="c-fn">refund</span>(<span class="c-key">string</span> <span class="c-var">$chargeId</span>, <span class="c-key">?int</span> <span class="c-var">$amountMinor</span> = <span class="c-key">null</span>): <span class="c-key">void</span>;
}
</code></pre>

<pre><code><span class="c-comment">// packages/acme/billing/src/Gateways/StripeGateway.php</span>
<span class="c-key">namespace</span> <span class="c-type">Acme\Billing\Gateways</span>;

<span class="c-key">use</span> <span class="c-type">Acme\Billing\Contracts\PaymentGateway</span>;
<span class="c-key">use</span> <span class="c-type">Stripe\StripeClient</span>;

<span class="c-key">final class</span> <span class="c-type">StripeGateway</span> <span class="c-key">implements</span> <span class="c-type">PaymentGateway</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private</span> <span class="c-type">StripeClient</span> <span class="c-var">$stripe</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">charge</span>(<span class="c-key">int</span> <span class="c-var">$amountMinor</span>, <span class="c-key">string</span> <span class="c-var">$currency</span>, <span class="c-key">string</span> <span class="c-var">$idempotencyKey</span>): <span class="c-key">string</span>
    {
        <span class="c-var">$intent</span> = <span class="c-var">$this</span>-><span class="c-var">stripe</span>-><span class="c-var">paymentIntents</span>-><span class="c-fn">create</span>(
            [<span class="c-str">'amount'</span> =&gt; <span class="c-var">$amountMinor</span>, <span class="c-str">'currency'</span> =&gt; <span class="c-var">$currency</span>],
            [<span class="c-str">'idempotency_key'</span> =&gt; <span class="c-var">$idempotencyKey</span>],
        );

        <span class="c-key">return</span> <span class="c-var">$intent</span>-&gt;<span class="c-var">id</span>;
    }

    <span class="c-key">public function</span> <span class="c-fn">refund</span>(<span class="c-key">string</span> <span class="c-var">$chargeId</span>, <span class="c-key">?int</span> <span class="c-var">$amountMinor</span> = <span class="c-key">null</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$this</span>-><span class="c-var">stripe</span>-><span class="c-var">refunds</span>-><span class="c-fn">create</span>([<span class="c-str">'payment_intent'</span> =&gt; <span class="c-var">$chargeId</span>, <span class="c-str">'amount'</span> =&gt; <span class="c-var">$amountMinor</span>]);
    }
}
</code></pre>

<pre><code><span class="c-comment">// packages/acme/billing/src/Gateways/FakeGateway.php — детерминированная реализация для тестов</span>
<span class="c-key">namespace</span> <span class="c-type">Acme\Billing\Gateways</span>;

<span class="c-key">use</span> <span class="c-type">Acme\Billing\Contracts\PaymentGateway</span>;

<span class="c-key">final class</span> <span class="c-type">FakeGateway</span> <span class="c-key">implements</span> <span class="c-type">PaymentGateway</span>
{
    <span class="c-key">public array</span> <span class="c-var">$calls</span> = [];

    <span class="c-key">public function</span> <span class="c-fn">charge</span>(<span class="c-key">int</span> <span class="c-var">$amountMinor</span>, <span class="c-key">string</span> <span class="c-var">$currency</span>, <span class="c-key">string</span> <span class="c-var">$idempotencyKey</span>): <span class="c-key">string</span>
    {
        <span class="c-var">$this</span>-><span class="c-var">calls</span>[] = <span class="c-fn">compact</span>(<span class="c-str">'amountMinor'</span>, <span class="c-str">'currency'</span>, <span class="c-str">'idempotencyKey'</span>);
        <span class="c-key">return</span> <span class="c-str">'fake_'</span> . <span class="c-fn">substr</span>(<span class="c-fn">sha1</span>(<span class="c-var">$idempotencyKey</span>), <span class="c-num">0</span>, <span class="c-num">12</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">refund</span>(<span class="c-key">string</span> <span class="c-var">$chargeId</span>, <span class="c-key">?int</span> <span class="c-var">$amountMinor</span> = <span class="c-key">null</span>): <span class="c-key">void</span> {}
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield"></i> Правила риска через теги</div>
    <p class="text">Каждое правило риска реализует общий контракт. Новое правило добавляется без правок ядра &mdash; провайдер тегирует его, а <code>RiskEngine</code> получает все теги одной выборкой.</p>

<pre><code><span class="c-comment">// packages/acme/billing/src/Risk/RiskRule.php</span>
<span class="c-key">namespace</span> <span class="c-type">Acme\Billing\Risk</span>;

<span class="c-key">interface</span> <span class="c-type">RiskRule</span>
{
    <span class="c-key">public function</span> <span class="c-fn">code</span>(): <span class="c-key">string</span>;
    <span class="c-key">public function</span> <span class="c-fn">evaluate</span>(<span class="c-key">array</span> <span class="c-var">$payload</span>): <span class="c-key">int</span>; <span class="c-comment">// 0..100 — вклад в общий риск-скор</span>
}
</code></pre>

<pre><code><span class="c-comment">// packages/acme/billing/src/Risk/RiskEngine.php</span>
<span class="c-key">namespace</span> <span class="c-type">Acme\Billing\Risk</span>;

<span class="c-key">final class</span> <span class="c-type">RiskEngine</span>
{
    <span class="c-comment">/** @param iterable&lt;RiskRule&gt; $rules */</span>
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private</span> <span class="c-key">iterable</span> <span class="c-var">$rules</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">score</span>(<span class="c-key">array</span> <span class="c-var">$payload</span>): <span class="c-key">int</span>
    {
        <span class="c-var">$total</span> = <span class="c-num">0</span>;
        <span class="c-key">foreach</span> (<span class="c-var">$this</span>-><span class="c-var">rules</span> <span class="c-key">as</span> <span class="c-var">$rule</span>) {
            <span class="c-var">$total</span> += <span class="c-var">$rule</span>-&gt;<span class="c-fn">evaluate</span>(<span class="c-var">$payload</span>);
        }
        <span class="c-key">return</span> <span class="c-fn">min</span>(<span class="c-num">100</span>, <span class="c-var">$total</span>);
    }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Scoped-контекст запроса</div>

<pre><code><span class="c-comment">// packages/acme/billing/src/Services/BillingContext.php</span>
<span class="c-key">namespace</span> <span class="c-type">Acme\Billing\Services</span>;

<span class="c-key">final class</span> <span class="c-type">BillingContext</span>
{
    <span class="c-key">public string</span> <span class="c-var">$correlationId</span>;
    <span class="c-key">public array</span>  <span class="c-var">$idempotencyKeys</span> = [];

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>()
    {
        <span class="c-var">$this</span>-&gt;<span class="c-var">correlationId</span> = <span class="c-fn">bin2hex</span>(<span class="c-fn">random_bytes</span>(<span class="c-num">8</span>));
    }

    <span class="c-key">public function</span> <span class="c-fn">keyFor</span>(<span class="c-key">string</span> <span class="c-var">$operation</span>): <span class="c-key">string</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-var">idempotencyKeys</span>[<span class="c-var">$operation</span>] ??= <span class="c-fn">bin2hex</span>(<span class="c-fn">random_bytes</span>(<span class="c-num">16</span>));
    }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="plug"></i> Сервис-провайдер: вся механика контейнера в одном файле</div>

<pre><code><span class="c-comment">// packages/acme/billing/src/Providers/BillingServiceProvider.php</span>
<span class="c-key">namespace</span> <span class="c-type">Acme\Billing\Providers</span>;

<span class="c-key">use</span> <span class="c-type">Acme\Billing\Contracts\PaymentGateway</span>;
<span class="c-key">use</span> <span class="c-type">Acme\Billing\Gateways\FakeGateway</span>;
<span class="c-key">use</span> <span class="c-type">Acme\Billing\Gateways\StripeGateway</span>;
<span class="c-key">use</span> <span class="c-type">Acme\Billing\Risk\BlocklistRule</span>;
<span class="c-key">use</span> <span class="c-type">Acme\Billing\Risk\GeoMismatchRule</span>;
<span class="c-key">use</span> <span class="c-type">Acme\Billing\Risk\RiskEngine</span>;
<span class="c-key">use</span> <span class="c-type">Acme\Billing\Risk\VelocityRule</span>;
<span class="c-key">use</span> <span class="c-type">Acme\Billing\Services\BillingContext</span>;
<span class="c-key">use</span> <span class="c-type">Acme\Billing\Services\CheckoutService</span>;
<span class="c-key">use</span> <span class="c-type">Acme\Billing\Services\SubscriptionService</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Contracts\Support\DeferrableProvider</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\ServiceProvider</span>;
<span class="c-key">use</span> <span class="c-type">Stripe\StripeClient</span>;

<span class="c-key">final class</span> <span class="c-type">BillingServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span> <span class="c-key">implements</span> <span class="c-type">DeferrableProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-var">$this</span>-&gt;<span class="c-fn">mergeConfigFrom</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../../config/billing.php'</span>, <span class="c-str">'billing'</span>);

        <span class="c-comment">// 1. Stripe-клиент — singleton, чтобы переиспользовать соединение.</span>
        <span class="c-var">$this</span>-&gt;<span class="c-var">app</span>-&gt;<span class="c-fn">singleton</span>(<span class="c-type">StripeClient</span>::<span class="c-key">class</span>, <span class="c-key">fn</span> () =&gt;
            <span class="c-key">new</span> <span class="c-type">StripeClient</span>(<span class="c-fn">config</span>(<span class="c-str">'billing.stripe.secret'</span>)));

        <span class="c-comment">// 2. Дефолтная реализация контракта зависит от окружения.</span>
        <span class="c-var">$this</span>-&gt;<span class="c-var">app</span>-&gt;<span class="c-fn">singleton</span>(<span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-var">$app</span>) {
            <span class="c-key">return</span> <span class="c-var">$app</span>-&gt;<span class="c-fn">environment</span>(<span class="c-str">'testing'</span>, <span class="c-str">'local'</span>)
                ? <span class="c-key">new</span> <span class="c-type">FakeGateway</span>()
                : <span class="c-var">$app</span>-&gt;<span class="c-fn">make</span>(<span class="c-type">StripeGateway</span>::<span class="c-key">class</span>);
        });

        <span class="c-comment">// 3. Подписки всегда обслуживает Stripe — независимо от настроек мерчанта.</span>
        <span class="c-var">$this</span>-&gt;<span class="c-var">app</span>-&gt;<span class="c-fn">when</span>(<span class="c-type">SubscriptionService</span>::<span class="c-key">class</span>)
            -&gt;<span class="c-fn">needs</span>(<span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>)
            -&gt;<span class="c-fn">give</span>(<span class="c-type">StripeGateway</span>::<span class="c-key">class</span>);

        <span class="c-comment">// 4. Контекст запроса — scoped, общий для всех потребителей в рамках запроса.</span>
        <span class="c-var">$this</span>-&gt;<span class="c-var">app</span>-&gt;<span class="c-fn">scoped</span>(<span class="c-type">BillingContext</span>::<span class="c-key">class</span>);

        <span class="c-comment">// 5. Правила риска тегируем — RiskEngine получит iterable через все теги.</span>
        <span class="c-var">$this</span>-&gt;<span class="c-var">app</span>-&gt;<span class="c-fn">tag</span>([
            <span class="c-type">VelocityRule</span>::<span class="c-key">class</span>,
            <span class="c-type">GeoMismatchRule</span>::<span class="c-key">class</span>,
            <span class="c-type">BlocklistRule</span>::<span class="c-key">class</span>,
        ], <span class="c-str">'billing.risk-rules'</span>);

        <span class="c-var">$this</span>-&gt;<span class="c-var">app</span>-&gt;<span class="c-fn">singleton</span>(<span class="c-type">RiskEngine</span>::<span class="c-key">class</span>, <span class="c-key">fn</span> (<span class="c-var">$app</span>) =&gt;
            <span class="c-key">new</span> <span class="c-type">RiskEngine</span>(<span class="c-var">$app</span>-&gt;<span class="c-fn">tagged</span>(<span class="c-str">'billing.risk-rules'</span>)));
    }

    <span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
    {
        <span class="c-var">$this</span>-&gt;<span class="c-fn">loadMigrationsFrom</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../../database/migrations'</span>);
        <span class="c-var">$this</span>-&gt;<span class="c-fn">loadRoutesFrom</span>(<span class="c-fn">__DIR__</span> . <span class="c-str">'/../../routes/web.php'</span>);

        <span class="c-key">if</span> (<span class="c-var">$this</span>-&gt;<span class="c-fn">app</span>()-&gt;<span class="c-fn">runningInConsole</span>()) {
            <span class="c-var">$this</span>-&gt;<span class="c-fn">publishes</span>([
                <span class="c-fn">__DIR__</span> . <span class="c-str">'/../../config/billing.php'</span> =&gt; <span class="c-fn">config_path</span>(<span class="c-str">'billing.php'</span>),
            ], <span class="c-str">'billing-config'</span>);
        }
    }

    <span class="c-key">public function</span> <span class="c-fn">provides</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>,
            <span class="c-type">StripeClient</span>::<span class="c-key">class</span>,
            <span class="c-type">BillingContext</span>::<span class="c-key">class</span>,
            <span class="c-type">RiskEngine</span>::<span class="c-key">class</span>,
        ];
    }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle-2"></i> Что демонстрирует этот провайдер</div>
    <ul class="bullets">
      <li><strong>singleton</strong> для <code>StripeClient</code> &mdash; дорогой ресурс с состоянием соединения, переиспользуется в рамках процесса;</li>
      <li><strong>зависимая фабрика</strong> для <code>PaymentGateway</code> &mdash; реализация выбирается на основании окружения, контейнер прячет ветвление от потребителей;</li>
      <li><strong>contextual</strong> переопределение для <code>SubscriptionService</code> &mdash; жёстко гарантирует одну реализацию вне зависимости от глобального дефолта;</li>
      <li><strong>scoped</strong> биндинг <code>BillingContext</code> &mdash; единый <code>correlationId</code> по всем потребителям одного запроса, в очередях контекст создаётся заново;</li>
      <li><strong>tag/tagged</strong> &mdash; <code>RiskEngine</code> расширяется новыми правилами без правки конструктора и без указания провайдера-агрегатора;</li>
      <li><strong>DeferrableProvider</strong> &mdash; модуль не загружается на запросах, не затрагивающих биллинг, что снижает накладные расходы на «холодных» маршрутах;</li>
      <li><strong>publishes</strong> с уникальным тегом <code>billing-config</code> &mdash; конфиг можно опубликовать, не задевая другие пакеты;</li>
      <li><strong>composer.json + auto-discovery</strong> &mdash; провайдер регистрируется автоматически после <code>composer require acme/billing</code>.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-square"></i> Использование сервисов</div>

<pre><code><span class="c-comment">// app/Http/Controllers/CheckoutController.php — потребитель пакета</span>
<span class="c-key">final class</span> <span class="c-type">CheckoutController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">store</span>(
        <span class="c-type">CheckoutRequest</span> <span class="c-var">$request</span>,
        <span class="c-type">CheckoutService</span> <span class="c-var">$checkout</span>,
        <span class="c-type">RiskEngine</span> <span class="c-var">$risk</span>,
        <span class="c-type">BillingContext</span> <span class="c-var">$ctx</span>,
    ) {
        <span class="c-var">$score</span> = <span class="c-var">$risk</span>-&gt;<span class="c-fn">score</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());
        <span class="c-fn">abort_if</span>(<span class="c-var">$score</span> &gt;= <span class="c-num">80</span>, <span class="c-num">422</span>, <span class="c-str">'High-risk transaction'</span>);

        <span class="c-var">$chargeId</span> = <span class="c-var">$checkout</span>-&gt;<span class="c-fn">charge</span>(
            amountMinor:    <span class="c-var">$request</span>-&gt;<span class="c-fn">integer</span>(<span class="c-str">'amount_minor'</span>),
            currency:       <span class="c-var">$request</span>-&gt;<span class="c-fn">string</span>(<span class="c-str">'currency'</span>),
            idempotencyKey: <span class="c-var">$ctx</span>-&gt;<span class="c-fn">keyFor</span>(<span class="c-str">'checkout'</span>),
        );

        <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>([<span class="c-str">'charge_id'</span> =&gt; <span class="c-var">$chargeId</span>, <span class="c-str">'correlation'</span> =&gt; <span class="c-var">$ctx</span>-&gt;<span class="c-var">correlationId</span>]);
    }
}
</code></pre>

    <p class="text">В тестах <code>app()-&gt;instance(PaymentGateway::class, $fake)</code> подменяет шлюз на изолированный мок без модификации провайдера. Запросный <code>BillingContext</code> и <code>RiskEngine</code> остаются собственными &mdash; именно так контейнер делает тестируемыми даже сложные модули.</p>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PITFALLS — сводный дайджест
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-pitfalls" class="section">
  <div class="section-title">Сводные подводные камни контейнера и провайдеров</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Топ ошибок, встречающихся в продакшен-коде</div>
    <p class="text">Каждый из камней относится к одной из подсекций KB_13 и приведён здесь в дайджест-форме для быстрого аудита провайдеров и сервисов.</p>

    <div class="pitfall">
      <strong>1. Утечка scoped в синглтоны.</strong> Singleton получает scoped-сервис в конструкторе и удерживает ссылку после <code>forgetScopedInstances</code>. Запросные данные предыдущего пользователя остаются доступны следующему. Решение &mdash; не инжектить scoped в singleton; принимать его в методе или через <code>app(BillingContext::class)</code> по требованию.
    </div>
    <div class="pitfall">
      <strong>2. Длинные цепочки <code>app()-&gt;make()</code> в коде.</strong> Каждый <code>make</code> &mdash; явный вызов сервис-локатора, скрывающий настоящие зависимости класса. Чем больше <code>make</code>, тем сложнее тестировать и рефакторить. Используйте конструкторное внедрение, оставляя <code>make</code> для фабрик и фасадов.
    </div>
    <div class="pitfall">
      <strong>3. Тяжёлая работа в <code>register()</code>.</strong> Чтение файлов, HTTP-запросы, разрешение зависимостей через <code>make</code> в <code>register</code> выполняются на каждом запросе и до того, как контейнер полностью готов. Дорогая инициализация &mdash; в <code>boot</code>, ещё лучше &mdash; в deferred-провайдер.
    </div>
    <div class="pitfall">
      <strong>4. Регистрация фасадов и роутов в <code>register()</code>.</strong> <code>Route::get</code>, <code>Schedule::command</code>, <code>Gate::define</code> в <code>register</code> часто падают с <em>Target class does not exist</em>: соответствующий сервис ещё не зарегистрирован. Любое использование фасадов &mdash; в <code>boot()</code>.
    </div>
    <div class="pitfall">
      <strong>5. <code>singleton</code> для сервисов с состоянием запроса.</strong> Корзина, авторизованный пользователь, мультитенантный контекст должны быть <code>scoped</code>, не <code>singleton</code>. Singleton переживёт несколько запросов в long-running окружениях (Octane, RoadRunner) и приведёт к утечке данных.
    </div>
    <div class="pitfall">
      <strong>6. Tagged через <code>collect($container-&gt;tagged(...))-&gt;all()</code>.</strong> Метод <code>tagged</code> возвращает <code>iterable</code> с ленивой инициализацией. Принудительное приведение к массиву через <code>collect()-&gt;all()</code> или <code>iterator_to_array</code> заставляет инстанцировать все сервисы тега даже если используется один. Принимайте <code>iterable</code> и пробегайте <code>foreach</code>.
    </div>
    <div class="pitfall">
      <strong>7. Deferred-провайдер с дорогой работой в <code>boot</code>.</strong> Идея deferred &mdash; не платить за модуль до первого обращения. Если в <code>boot</code> провайдера тяжёлая инициализация, она ударит по производительности именно того запроса, который первым активировал модуль. Минимизируйте <code>boot</code> deferred-провайдера; держите в <code>register</code> только биндинги.
    </div>
    <div class="pitfall">
      <strong>8. Изменение состояния через свойство-сокращение <code>$singletons</code>.</strong> Свойство пригодно только для простых ассоциаций <em>abstract → concrete</em>. Любая нестандартная инициализация (зависит от конфига, окружения, условий) &mdash; через <code>$this-&gt;app-&gt;singleton(...)</code> с замыканием в <code>register()</code>.
    </div>
    <div class="pitfall">
      <strong>9. Использование <code>instance()</code> вместо <code>singleton()</code>.</strong> <code>instance($value)</code> кладёт уже созданный объект, ломая ленивую инициализацию. Если объект не нужен сейчас &mdash; <code>singleton</code> с фабрикой. <code>instance</code> уместен для тестовых моков и для разрешения циклов вручную.
    </div>
    <div class="pitfall">
      <strong>10. <code>contextual</code> без <code>singleton</code> в дефолте.</strong> Если базовая абстракция не имеет binding'а, contextual binding для одного потребителя сработает, а другие получат ошибку разрешения. Всегда регистрируйте дефолт через <code>singleton</code>/<code>bind</code> и переопределяйте контекстно по требованию.
    </div>
    <div class="pitfall">
      <strong>11. <code>resolving</code>-колбэки без <code>after</code>.</strong> <code>resolving</code> вызывается до того, как контейнер закончил инжекцию зависимостей. Для безопасного пост-настройки (например, добавление подписчиков события) используйте <code>afterResolving</code>.
    </div>
    <div class="pitfall">
      <strong>12. Auto-discovery как обязательное условие.</strong> Если пакет полагается на auto-discovery, а у пользователя он отключён (<code>dont-discover</code>), провайдер не подхватится. Документируйте альтернативу &mdash; ручное добавление в <code>bootstrap/providers.php</code>.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     INTERVIEW QUESTIONS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-interview" class="section">
  <div class="section-title">Вопросы на собеседование (middle / senior)</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="brain"></i> Базовые понятия</div>

    <div class="card">
      <h3>1. Чем Inversion of Control отличается от Dependency Injection?</h3>
      <p class="text"><strong>IoC</strong> &mdash; общий архитектурный принцип: управление потоком (создание объектов, вызов методов, реакция на события) передаётся внешнему компоненту. <strong>DI</strong> &mdash; конкретный приём реализации IoC: зависимости класса передаются ему извне, а не создаются им самим. DI без IoC-контейнера возможен &mdash; ручное конструирование через <code>new</code>. IoC-контейнер автоматизирует DI и решает задачу разрешения графа зависимостей.</p>
    </div>

    <div class="card">
      <h3>2. Что произойдёт, если внедрить в конструктор сервиса несуществующий контракт без binding'а?</h3>
      <p class="text">Auto-wiring пробует инстанцировать класс/интерфейс. Для конкретного класса &mdash; вызовет <code>new</code>, рекурсивно разрешая параметры. Для интерфейса без binding'а контейнер бросит <code>BindingResolutionException</code> с сообщением о невозможности разрешить абстракцию. Решение &mdash; зарегистрировать реализацию через <code>bind</code>/<code>singleton</code>.</p>
    </div>

    <div class="card">
      <h3>3. Чем <code>bind</code> отличается от <code>singleton</code>?</h3>
      <p class="text"><code>bind</code> создаёт новый экземпляр на каждое <code>make</code>; <code>singleton</code> создаёт один и кеширует его до завершения процесса. <code>singleton</code> уместен для сервисов без запросного состояния (репозитории, клиенты внешних API, кеш-абстракции); <code>bind</code> &mdash; для сервисов с per-resolution состоянием.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Жизненный цикл и провайдеры</div>

    <div class="card">
      <h3>4. Зачем в провайдере две фазы: <code>register</code> и <code>boot</code>?</h3>
      <p class="text"><code>register</code> исполняется первым у всех провайдеров &mdash; в этой фазе нельзя зависеть от других сервисов, доступен только <code>$this-&gt;app</code> для регистрации binding'ов. <code>boot</code> вызывается после того, как все провайдеры завершили <code>register</code> &mdash; гарантированно доступен фасад любого зарегистрированного сервиса. Разделение исключает циклические зависимости при загрузке.</p>
    </div>

    <div class="card">
      <h3>5. Как работает <code>DeferrableProvider</code> и когда он оправдан?</h3>
      <p class="text">Deferred-провайдер не вызывается на каждом запросе &mdash; вместо этого Laravel сохраняет карту <em>сервис → провайдер</em> в <code>bootstrap/cache/services.php</code>. При первом обращении к сервису через контейнер провайдер регистрируется. Оправдан для модулей, которые активны только на части маршрутов (биллинг, генерация отчётов, интеграция с внешним API). Не подходит, если в <code>boot</code> нужна логика, выполняющаяся всегда (регистрация глобальных middleware, scheduled-задач).</p>
    </div>

    <div class="card">
      <h3>6. Что делает <code>$this-&gt;app-&gt;booted(fn)</code> и чем отличается от <code>boot()</code>?</h3>
      <p class="text"><code>booted</code> ставит колбэк в очередь, исполняемую после того, как все провайдеры завершили <code>boot</code>. В этот момент гарантированно доступны все сервисы, маршруты, миддлвары, события. Уместно для логики, которой нужно «свести все провайдеры вместе» (например, регистрация macro у класса, который определяется в другом пакете). В сам <code>boot()</code> это нельзя положить безопасно, поскольку порядок <code>boot</code>-методов между провайдерами зависит от порядка регистрации.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-fork"></i> Контекстные и тегированные биндинги</div>

    <div class="card">
      <h3>7. Когда применять contextual binding вместо отдельных контрактов?</h3>
      <p class="text">Когда два потребителя реализуют одну и ту же концепцию (например, <code>Filesystem</code>), но должны работать с разными конкретными реализациями (один &mdash; локальный диск, другой &mdash; S3). Вводить два разных интерфейса означало бы дублировать абстракцию ради конфигурации &mdash; вместо этого contextual binding оставляет общий контракт и переопределяет реализацию для конкретного класса.</p>
    </div>

    <div class="card">
      <h3>8. Чем <code>tagged</code>-сервисы отличаются от инжекта массива?</h3>
      <p class="text"><code>tagged</code> возвращает <code>iterable</code> с ленивой инициализацией &mdash; сервис создаётся только в момент итерации. Это критично, если в теге много сервисов, а используется один. Инжект массива (<code>[ServiceA::class, ServiceB::class]</code>) требует немедленного разрешения всех элементов. Кроме того, через tagged можно добавлять новых участников из других провайдеров (например, пакетов-расширений) без модификации потребителя.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="recycle"></i> Жизненный цикл сервисов</div>

    <div class="card">
      <h3>9. Что такое scoped binding и когда он необходим?</h3>
      <p class="text"><code>scoped</code> &mdash; binding, который ведёт себя как singleton в пределах одного «scope» (HTTP-запрос или Job в очереди), но сбрасывается между scope'ами. Необходим в long-running окружениях (Laravel Octane, RoadRunner, FrankenPHP), где singleton переживает запросы и протекает запросное состояние между пользователями. В стандартном PHP-FPM scoped и singleton ведут себя одинаково, поскольку процесс умирает после запроса.</p>
    </div>

    <div class="card">
      <h3>10. Как Laravel разрешает конфликт между интерфейсом и его реализацией при auto-wiring?</h3>
      <p class="text">Контейнер использует имя типа из аргумента конструктора. Если это интерфейс &mdash; ищет binding в <code>$bindings</code>/<code>$instances</code>/<code>$contextual</code>. При отсутствии &mdash; <code>BindingResolutionException</code>. Если конкретный класс &mdash; пытается инстанцировать его рекурсивно. Если binding объявлен и не подходит по сигнатуре (например, реализация не имплементирует интерфейс), возникает <code>TypeError</code>, а не ошибка контейнера.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package"></i> Пакеты и расширяемость</div>

    <div class="card">
      <h3>11. Что включает в себя auto-discovery провайдера в Laravel-пакете?</h3>
      <p class="text">В <code>composer.json</code> пакета указывается секция <code>extra.laravel.providers</code> и (опционально) <code>extra.laravel.aliases</code>. При <code>composer require</code> Laravel парсит эти данные, добавляет провайдер в кеш загружаемых провайдеров и регистрирует фасады. Пользователь может отключить auto-discovery для конкретного пакета через <code>extra.laravel.dont-discover</code> в своём <code>composer.json</code>.</p>
    </div>

    <div class="card">
      <h3>12. Чем <code>mergeConfigFrom</code> отличается от <code>publishes</code> для конфигурации?</h3>
      <p class="text"><code>mergeConfigFrom</code> накладывает дефолты пакета на конфиг пользователя &mdash; пользовательские значения первого уровня перекрывают пакетные. Работает в рантайме, без модификации файлов проекта. <code>publishes</code> копирует файл конфига в <code>config/</code> проекта при <code>vendor:publish</code> &mdash; пользователь получает полный файл, который можно редактировать. Часто эти подходы используют вместе: <code>mergeConfigFrom</code> обеспечивает работу из коробки, <code>publishes</code> &mdash; для тонкой настройки.</p>
    </div>

    <div class="card">
      <h3>13. Какие потенциальные проблемы возникают, если положить логику в свойство <code>$singletons</code> провайдера?</h3>
      <p class="text">Свойство принимает только ассоциации <em>abstract → concrete</em> &mdash; никакой логики, замыканий или зависимости от конфига. Если binding нужно строить с условиями (по окружению, по фиче-флагу, по версии PHP), такая логика обязательно должна быть в <code>register()</code>. Кроме того, <code>$singletons</code> подразумевает разрешение без явного <code>singleton()</code> &mdash; что усложняет отладку, если кто-то ищет регистрацию по grep в коде.</p>
    </div>

    <div class="card">
      <h3>14. Как контейнер взаимодействует с PSR-11?</h3>
      <p class="text">Laravel'овский <code>Container</code> имплементирует <code>Psr\Container\ContainerInterface</code> &mdash; методы <code>get($id)</code> и <code>has($id)</code> являются обёртками над <code>make</code> и <code>bound</code>. Это позволяет интегрировать контейнер в библиотеки, ожидающие PSR-11 (Slim, ReactPHP-based фреймворки). Обратное направление &mdash; передать PSR-11-контейнер в качестве источника resolve &mdash; в Laravel напрямую не поддерживается.</p>
    </div>

    <div class="card">
      <h3>15. Как тестировать сервис, использующий <code>app()</code> внутри метода вместо инжекта в конструктор?</h3>
      <p class="text">В тесте до вызова метода подменяется binding: <code>app()-&gt;instance(SomeService::class, $fake)</code> или <code>$this-&gt;swap(SomeService::class, $fake)</code>. После этого внутренний <code>app(SomeService::class)</code> вернёт mock. Подход рабочий, но менее предпочтителен, чем конструкторная инъекция: зависимости неявны, IDE не подсказывает их, рефакторинг сложнее. Используйте <code>app()</code> внутри метода только для редких, ситуативных зависимостей.</p>
    </div>
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
  if (sec) sec.classList.add('active');
  if (el) el.classList.add('active');
  window.scrollTo(0, 0);
  lucide.createIcons();
}
</script>
</body>
</html>

@endverbatim
