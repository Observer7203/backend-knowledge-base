@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Тестирование — продвинутый разбор</title>
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
  <div class="sidebar-title">Testing Deep</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">Концепции</div>
  <a class="nav-item" onclick="showSection('doubles',this)"><i data-lucide="users"></i> Test Doubles</a>
  <a class="nav-item" onclick="showSection('design',this)"><i data-lucide="pen-tool"></i> Дизайн тестов</a>
  <a class="nav-item" onclick="showSection('architecture',this)"><i data-lucide="layers"></i> Архитектура тестов</a>

  <div class="nav-group-label">Laravel</div>
  <a class="nav-item" onclick="showSection('db',this)"><i data-lucide="database"></i> DB-стратегии</a>
  <a class="nav-item" onclick="showSection('parallel',this)"><i data-lucide="split"></i> Параллельные тесты</a>
  <a class="nav-item" onclick="showSection('time',this)"><i data-lucide="clock"></i> Время и очереди</a>
  <a class="nav-item" onclick="showSection('http',this)"><i data-lucide="globe"></i> Http и внешние API</a>

  <div class="nav-group-label">Качество</div>
  <a class="nav-item" onclick="showSection('mutation',this)"><i data-lucide="bug"></i> Mutation testing</a>
  <a class="nav-item" onclick="showSection('coverage',this)"><i data-lucide="percent"></i> Coverage честно</a>
  <a class="nav-item" onclick="showSection('snapshot',this)"><i data-lucide="camera"></i> Snapshot tests</a>

  <div class="nav-group-label">Применение</div>
  <a class="nav-item" onclick="showSection('practice',this)"><i data-lucide="hammer"></i> Практика</a>
  <a class="nav-item" onclick="showSection('pitfalls',this)"><i data-lucide="alert-octagon"></i> Подводные камни</a>
  <a class="nav-item" onclick="showSection('interview',this)"><i data-lucide="brain"></i> На собеседование</a>
</div>

<div class="main">
<div class="page-header">
  <h1>Тестирование — продвинутый разбор</h1>
  <p>Что отличает зрелую тест-сюту от набора зелёных галочек: таксономия дублей, базовые стратегии для БД, параллельное исполнение, детерминизм времени и очередей, mutation testing, контракт vs реализация. Раздел дополняет KB_6 (основы PHPUnit/Pest), не повторяет его.</p>
  <div class="badge-row">
    <span class="badge">PHPUnit</span>
    <span class="badge">Pest</span>
    <span class="badge">Laravel</span>
    <span class="badge">Mutation Testing</span>
    <span class="badge badge-success">Middle / Senior</span>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     OVERVIEW
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>

  <p class="text">KB_6 даёт основу: как запустить PHPUnit, что такое unit и feature тесты, как мокать. Этого достаточно, чтобы написать осмысленный тест и пройти первое собеседование. Однако реальные кодобазы быстро упираются в задачи, не решаемые поверхностным знанием: тесты становятся медленными, флакают, ложно зелёные, дорогими в поддержке. Этот раздел &mdash; о том, что отделяет middle-инженера от senior'а в части тестирования.</p>

  <div class="info-box primary">
    <strong>Что разбирается в разделе:</strong>
    <ul class="bullets" style="margin-top:6px;margin-bottom:0;color:#404357;">
      <li>Точная терминология test doubles &mdash; и почему путать mock со stub'ом дорого;</li>
      <li>Стратегии управления состоянием БД: транзакции, миграции, ленивые миграции, in-memory SQLite vs реальный движок;</li>
      <li>Параллельное исполнение тестов и изоляция данных между процессами;</li>
      <li>Детерминизм: фиксация времени, контролируемые очереди, изолированные внешние вызовы;</li>
      <li>Mutation testing &mdash; как измерять качество тестов, а не их количество;</li>
      <li>Какие тесты ломаться при рефакторинге не должны и почему так часто ломаются.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Пререквизиты</div>
    <ul class="bullets">
      <li>KB_6 &mdash; основы PHPUnit/Pest, базовые fakes, TDD;</li>
      <li>KB_3 &mdash; Service Container и DI (без понимания DI инжектирование моков превращается в магию);</li>
      <li>KB_12 &mdash; Eloquent (для DB-стратегий полезно понимать observers, transactions, factories).</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map"></i> Карта раздела</div>
    <table class="data-table">
      <tr><th>Блок</th><th>Что узнаешь</th></tr>
      <tr><td><strong>Концепции</strong></td><td>Test doubles по Мезаросу, AAA/GWT, пирамида/трофей/соты, контракт-тесты</td></tr>
      <tr><td><strong>Laravel</strong></td><td>DB-стратегии, параллельность, время, очереди, Http</td></tr>
      <tr><td><strong>Качество</strong></td><td>Mutation testing, честный coverage, snapshot, антипаттерны</td></tr>
      <tr><td><strong>Практика</strong></td><td>Перевод legacy-модуля на тестируемый код шаг за шагом</td></tr>
    </table>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     TEST DOUBLES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-doubles" class="section">
  <div class="section-title">Test Doubles — таксономия и применение</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">«Test double» &mdash; общий зонтичный термин Жерара Мезароса для любых объектов, заменяющих реальные коллабораторы в тесте. Различие между подтипами &mdash; не педантизм: путаница mock'а со stub'ом приводит к тестам, которые ломаются при безобидном рефакторинге и не ловят настоящие баги. В отличие от популярного «всё это моки», точная таксономия даёт язык для проектирования тестов и обсуждения их в ревью.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Пять типов дублей</div>

    <div class="card">
      <h3>1. Dummy</h3>
      <p class="text">Объект, который передаётся ради соблюдения сигнатуры, но не используется. Часто &mdash; <code>new \stdClass()</code> или <code>$this-&gt;createMock(SomeInterface::class)</code> без настройки. Если тест случайно начнёт вызывать его методы &mdash; PHPUnit выкинет <em>"Trying to perform method call on null"</em>, что укажет на несоответствие предположению.</p>
    </div>

    <div class="card">
      <h3>2. Stub</h3>
      <p class="text">Возвращает фиксированные данные на вызовы методов. Не проверяет, что вызовы были &mdash; только <strong>отвечает</strong> на них. Использует <code>method(...)-&gt;willReturn(...)</code>. Stub полезен, когда тестируемый код запрашивает информацию у коллаборатора, и нам важно <em>что</em> придёт обратно, а не <em>что</em> было запрошено.</p>
    </div>

    <div class="card">
      <h3>3. Spy</h3>
      <p class="text">Stub, который дополнительно записывает все вызовы. Проверка вызовов происходит <strong>после</strong> исполнения тестируемого кода (post-condition), а не как ожидание (Mockery: <code>shouldHaveReceived</code>). Удобно, когда нужно проверить факт вызова, но не хочется блокировать произвольные внутренние вызовы.</p>
    </div>

    <div class="card">
      <h3>4. Mock</h3>
      <p class="text">Объект с <strong>заранее заданными ожиданиями</strong>: какие методы будут вызваны, с какими аргументами, сколько раз. Проверка происходит <strong>в момент вызова</strong> или при разрушении объекта. PHPUnit: <code>$mock-&gt;expects($this-&gt;once())-&gt;method('foo')</code>. Mockery: <code>$mock-&gt;shouldReceive('foo')-&gt;once()</code>. Превращает тест в спецификацию <em>протокола взаимодействия</em>.</p>
    </div>

    <div class="card">
      <h3>5. Fake</h3>
      <p class="text">Рабочая (но упрощённая) реализация контракта. Хранит данные в памяти вместо БД, держит in-memory массив вместо очереди. Не пишет на диск, не делает сетевых вызовов. Laravel'овские <code>Storage::fake()</code>, <code>Queue::fake()</code>, <code>Event::fake()</code> &mdash; типичные fakes. Принципиально отличается от stub'а тем, что у него <strong>есть поведение</strong>: если сохранить и прочитать &mdash; вернётся то же значение.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика на примере: сервис рассылки</div>
    <p class="text">Дано: <code>NotificationDispatcher</code> с зависимостями &mdash; <code>UserRepository</code> (читает получателей), <code>RateLimiter</code> (ограничивает частоту), <code>MailGateway</code> (отправляет почту), <code>AuditLogger</code> (пишет аудит). Каждую зависимость подменим уместным типом дубля.</p>

<pre><code><span class="c-key">final class</span> <span class="c-type">NotificationDispatcher</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private</span> <span class="c-type">UserRepository</span> <span class="c-var">$users</span>,
        <span class="c-key">private</span> <span class="c-type">RateLimiter</span>     <span class="c-var">$limiter</span>,
        <span class="c-key">private</span> <span class="c-type">MailGateway</span>     <span class="c-var">$mail</span>,
        <span class="c-key">private</span> <span class="c-type">AuditLogger</span>     <span class="c-var">$audit</span>,
    ) {}

    <span class="c-key">public function</span> <span class="c-fn">send</span>(<span class="c-key">string</span> <span class="c-var">$campaignId</span>): <span class="c-key">int</span>
    {
        <span class="c-var">$users</span> = <span class="c-var">$this</span>-&gt;<span class="c-var">users</span>-&gt;<span class="c-fn">subscribed</span>();
        <span class="c-var">$sent</span> = <span class="c-num">0</span>;
        <span class="c-key">foreach</span> (<span class="c-var">$users</span> <span class="c-key">as</span> <span class="c-var">$user</span>) {
            <span class="c-key">if</span> (!<span class="c-var">$this</span>-&gt;<span class="c-var">limiter</span>-&gt;<span class="c-fn">allow</span>(<span class="c-var">$user</span>-&gt;<span class="c-var">id</span>)) <span class="c-key">continue</span>;
            <span class="c-var">$this</span>-&gt;<span class="c-var">mail</span>-&gt;<span class="c-fn">send</span>(<span class="c-var">$user</span>-&gt;<span class="c-var">email</span>, <span class="c-var">$campaignId</span>);
            <span class="c-var">$this</span>-&gt;<span class="c-var">audit</span>-&gt;<span class="c-fn">record</span>(<span class="c-str">'sent'</span>, <span class="c-var">$user</span>-&gt;<span class="c-var">id</span>);
            <span class="c-var">$sent</span>++;
        }
        <span class="c-key">return</span> <span class="c-var">$sent</span>;
    }
}
</code></pre>

<pre><code><span class="c-comment">// Тест: «при двух подписчиках, оба прошли лимит — обе почты ушли»</span>
<span class="c-key">public function</span> <span class="c-fn">test_sends_email_to_each_allowed_user</span>(): <span class="c-key">void</span>
{
    <span class="c-comment">// Stub — отвечает на запрос подписчиков:</span>
    <span class="c-var">$users</span> = <span class="c-var">$this</span>-&gt;<span class="c-fn">createStub</span>(<span class="c-type">UserRepository</span>::<span class="c-key">class</span>);
    <span class="c-var">$users</span>-&gt;<span class="c-fn">method</span>(<span class="c-str">'subscribed'</span>)-&gt;<span class="c-fn">willReturn</span>([
        <span class="c-key">new</span> <span class="c-type">User</span>(<span class="c-num">1</span>, <span class="c-str">'a@example.com'</span>),
        <span class="c-key">new</span> <span class="c-type">User</span>(<span class="c-num">2</span>, <span class="c-str">'b@example.com'</span>),
    ]);

    <span class="c-comment">// Stub с фиксированным «да» от лимитера:</span>
    <span class="c-var">$limiter</span> = <span class="c-var">$this</span>-&gt;<span class="c-fn">createStub</span>(<span class="c-type">RateLimiter</span>::<span class="c-key">class</span>);
    <span class="c-var">$limiter</span>-&gt;<span class="c-fn">method</span>(<span class="c-str">'allow'</span>)-&gt;<span class="c-fn">willReturn</span>(<span class="c-key">true</span>);

    <span class="c-comment">// Mock — фиксируем ожидание именно двух вызовов с конкретными аргументами:</span>
    <span class="c-var">$mail</span> = <span class="c-var">$this</span>-&gt;<span class="c-fn">createMock</span>(<span class="c-type">MailGateway</span>::<span class="c-key">class</span>);
    <span class="c-var">$mail</span>-&gt;<span class="c-fn">expects</span>(<span class="c-var">$this</span>-&gt;<span class="c-fn">exactly</span>(<span class="c-num">2</span>))
         -&gt;<span class="c-fn">method</span>(<span class="c-str">'send'</span>)
         -&gt;<span class="c-fn">willReturnCallback</span>(<span class="c-key">function</span> (<span class="c-key">string</span> <span class="c-var">$to</span>, <span class="c-key">string</span> <span class="c-var">$campaign</span>) {
             <span class="c-var">$this</span>-&gt;<span class="c-fn">assertContains</span>(<span class="c-var">$to</span>, [<span class="c-str">'a@example.com'</span>, <span class="c-str">'b@example.com'</span>]);
             <span class="c-var">$this</span>-&gt;<span class="c-fn">assertSame</span>(<span class="c-str">'spring-sale'</span>, <span class="c-var">$campaign</span>);
         });

    <span class="c-comment">// Dummy — нам безразлично, что аудит-логгер делает в этом тесте:</span>
    <span class="c-var">$audit</span> = <span class="c-var">$this</span>-&gt;<span class="c-fn">createStub</span>(<span class="c-type">AuditLogger</span>::<span class="c-key">class</span>);

    <span class="c-var">$dispatcher</span> = <span class="c-key">new</span> <span class="c-type">NotificationDispatcher</span>(<span class="c-var">$users</span>, <span class="c-var">$limiter</span>, <span class="c-var">$mail</span>, <span class="c-var">$audit</span>);
    <span class="c-var">$sent</span> = <span class="c-var">$dispatcher</span>-&gt;<span class="c-fn">send</span>(<span class="c-str">'spring-sale'</span>);

    <span class="c-var">$this</span>-&gt;<span class="c-fn">assertSame</span>(<span class="c-num">2</span>, <span class="c-var">$sent</span>);
}
</code></pre>

    <p class="text">Когда уместен <strong>fake</strong> вместо mock? Если бы <code>AuditLogger</code> хранил факт записи и далее использовался в проверках, fake (например, in-memory имплементация) был бы предпочтительнее: тест проверял бы итоговое состояние (state-based), а не цепочку вызовов (interaction-based). Это устойчивее к рефакторингу.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Когда какой тип</div>
    <table class="data-table">
      <tr><th>Тип</th><th>Применяется когда</th><th>Цена</th></tr>
      <tr><td><strong>Dummy</strong></td><td>Параметр нужен по сигнатуре, не используется</td><td>Нулевая</td></tr>
      <tr><td><strong>Stub</strong></td><td>Тест проверяет реакцию на входные данные</td><td>Низкая: устойчив к рефакторингу</td></tr>
      <tr><td><strong>Spy</strong></td><td>Нужно зафиксировать факт вызова без жёстких ожиданий</td><td>Средняя: post-check, гибче mock'а</td></tr>
      <tr><td><strong>Mock</strong></td><td>Тестируется протокол взаимодействия (последовательность, количество)</td><td>Высокая: ломается при безопасном рефакторинге внутренностей</td></tr>
      <tr><td><strong>Fake</strong></td><td>Нужно реалистичное поведение коллаборатора без побочек</td><td>Средняя: требует поддержки fake-имплементации</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. Mock на каждый коллаборатор.</strong> Тест с пятью моками описывает не поведение, а внутреннее устройство класса. При любой реструктуризации (перенос вызова из метода A в метод B, объединение двух вызовов в один) тест краснеет, хотя поведение не изменилось. Это называется «over-mocking» и приводит к тому, что разработчики начинают избегать рефакторинга.
    </div>
    <div class="pitfall">
      <strong>2. Mock на собственные value-objects.</strong> Если <code>Money</code> или <code>Email</code> &mdash; иммутабельный value object без зависимостей, мокать его бессмысленно: используйте реальный конструктор. Мок переусложняет тест и теряет проверку, что value-объект правильно собран.
    </div>
    <div class="pitfall">
      <strong>3. Stub без strict-режима.</strong> По умолчанию stub возвращает <code>null</code> на любой неконфигурированный метод. Если код потребует <code>->getId()</code> а stub его не настроен, получим <code>null</code>, который тихо просочится дальше и сломает тест в случайном месте. В PHPUnit 10+ stub'ы по умолчанию строгие &mdash; неконфигурированные методы бросают исключение. Включите аналог в более старых версиях через <code>willThrowException</code>.
    </div>
    <div class="pitfall">
      <strong>4. Mock'ание final-класса.</strong> PHPUnit не может расширить <code>final</code> класс. Решения: <strong>(а)</strong> ввести интерфейс и мокать его; <strong>(б)</strong> использовать <code>bovigo/assert</code> или Mockery с <code>shouldAllowMockingFinalClasses</code> (медленнее); <strong>(в)</strong> переосмыслить, нужен ли тут double вообще &mdash; возможно, нужен fake.
    </div>
    <div class="pitfall">
      <strong>5. <code>willReturnOnConsecutiveCalls</code> для итерации.</strong> Этот метод возвращает значения по порядку для каждого следующего вызова. Если вызов сделан N+1 раз, последний вернёт <code>null</code> молча. Используйте <code>willReturnCallback</code> с явной логикой или принципиально другой дизайн, если порядок вызовов критичен.
    </div>
    <div class="pitfall">
      <strong>6. Мокаем то, чего не владеем.</strong> Мокать внешние SDK (Stripe, AWS) напрямую &mdash; путь к хрупким тестам: их API меняется, моки нет. Оборачивайте чужие SDK в собственный интерфейс (<code>PaymentGateway</code>) и мокайте свой контракт. Это правило &laquo;don't mock what you don't own&raquo; (Steve Freeman / Nat Pryce).
    </div>
    <div class="pitfall">
      <strong>7. Подсчёт вызовов вместо проверки результата.</strong> Тест вида «метод <code>save</code> был вызван ровно один раз» &mdash; слабый: он не подтверждает, что данные сохранены корректно. Предпочтительнее использовать fake-репозиторий и проверять реальное состояние: <code>$this-&gt;assertNotNull($repository-&gt;find($id))</code>.
    </div>
    <div class="pitfall">
      <strong>8. <code>partialMock</code> как костыль.</strong> Частичный mock (когда часть методов реальные, часть подменены) почти всегда сигнал, что класс делает слишком много. Разделите его на два &mdash; и каждый тестируйте отдельно с настоящими (или мокированными) зависимостями.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     DESIGN — AAA, GWT, naming
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-design" class="section">
  <div class="section-title">Дизайн отдельного теста</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Тест &mdash; код, который читают чаще, чем пишут: при поломке его открывают в спешке, чтобы понять, что именно сломалось. Структура теста определяет, насколько быстро это понимание достигается. Хороший тест читается как параграф: задана ситуация &rarr; выполнено действие &rarr; проверен результат. Плохой &mdash; читается как клубок настроек.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Структурные подходы</div>

    <div class="card">
      <h3>AAA &mdash; Arrange / Act / Assert</h3>
      <p class="text">Три блока с пустой строкой между ними. <strong>Arrange</strong> создаёт окружение и входные данные. <strong>Act</strong> &mdash; <em>одно</em> действие, чьё поведение тестируется. <strong>Assert</strong> &mdash; проверки результата и состояния. Если act-блок занимает больше одной строки или содержит вспомогательную логику &mdash; его пора извлекать в helper-метод.</p>
    </div>

    <div class="card">
      <h3>GWT &mdash; Given / When / Then</h3>
      <p class="text">Вариант AAA из BDD: <strong>Given</strong> &mdash; контекст, <strong>When</strong> &mdash; событие, <strong>Then</strong> &mdash; ожидаемая реакция. Pest и Behat используют это естественно (<code>it('orders should ship when paid', ...)</code>). На уровне unit-тестов GWT и AAA взаимозаменяемы &mdash; разница в словаре, не в структуре.</p>
    </div>

    <div class="card">
      <h3>Naming: <code>methodUnderTest_state_expected</code></h3>
      <p class="text">Имя теста &mdash; это первая строка сообщения о падении. Хорошее имя описывает три вещи: <strong>что тестируется</strong>, <strong>в каком состоянии</strong>, <strong>чего ожидаем</strong>. Примеры: <code>charge_whenCardDeclined_throwsPaymentException</code>, <code>store_withDuplicateEmail_returns422</code>. В Pest то же достигается через <code>it</code>: <code>it('throws PaymentException when card is declined')</code>.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Сравнение: одно действие vs один assert на тест</div>
    <p class="text">Популярный принцип «один assert на тест» нередко уродует тест: вместо одного логичного действия &mdash; десять методов, повторяющих setup. Точнее формулировать: <strong>одно действие</strong> и столько assert'ов, сколько нужно для полной проверки исхода этого действия. Если действий два &mdash; разделите на два теста.</p>

<pre><code><span class="c-comment">// ❌ Anti-pattern: act-блок выполняет два независимых действия</span>
<span class="c-key">public function</span> <span class="c-fn">test_user_lifecycle</span>(): <span class="c-key">void</span>
{
    <span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">factory</span>()-&gt;<span class="c-fn">create</span>();
    <span class="c-var">$user</span>-&gt;<span class="c-fn">activate</span>();             <span class="c-comment">// действие 1</span>
    <span class="c-var">$this</span>-&gt;<span class="c-fn">assertTrue</span>(<span class="c-var">$user</span>-&gt;<span class="c-fn">isActive</span>());

    <span class="c-var">$user</span>-&gt;<span class="c-fn">block</span>(<span class="c-str">'spam'</span>);          <span class="c-comment">// действие 2</span>
    <span class="c-var">$this</span>-&gt;<span class="c-fn">assertSame</span>(<span class="c-str">'spam'</span>, <span class="c-var">$user</span>-&gt;<span class="c-var">block_reason</span>);
}
</code></pre>

<pre><code><span class="c-comment">// ✓ Два теста, по одному действию каждый</span>
<span class="c-key">public function</span> <span class="c-fn">test_activate_marks_user_active</span>(): <span class="c-key">void</span>
{
    <span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">factory</span>()-&gt;<span class="c-fn">create</span>();

    <span class="c-var">$user</span>-&gt;<span class="c-fn">activate</span>();

    <span class="c-var">$this</span>-&gt;<span class="c-fn">assertTrue</span>(<span class="c-var">$user</span>-&gt;<span class="c-fn">isActive</span>());
    <span class="c-var">$this</span>-&gt;<span class="c-fn">assertNotNull</span>(<span class="c-var">$user</span>-&gt;<span class="c-var">activated_at</span>);
}

<span class="c-key">public function</span> <span class="c-fn">test_block_stores_reason</span>(): <span class="c-key">void</span>
{
    <span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">factory</span>()-&gt;<span class="c-fn">active</span>()-&gt;<span class="c-fn">create</span>();

    <span class="c-var">$user</span>-&gt;<span class="c-fn">block</span>(<span class="c-str">'spam'</span>);

    <span class="c-var">$this</span>-&gt;<span class="c-fn">assertFalse</span>(<span class="c-var">$user</span>-&gt;<span class="c-fn">isActive</span>());
    <span class="c-var">$this</span>-&gt;<span class="c-fn">assertSame</span>(<span class="c-str">'spam'</span>, <span class="c-var">$user</span>-&gt;<span class="c-var">block_reason</span>);
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. <code>setUp</code> вместо явного Arrange.</strong> Большой <code>setUp</code>, готовящий весь мир, заставляет читателя теста скакать между методами. Предпочтительнее явный Arrange в теле каждого теста с helper-методами вида <code>$user = $this-&gt;activeUser()</code> &mdash; единственная зависимость остаётся явной.
    </div>
    <div class="pitfall">
      <strong>2. Логика в assert-блоке.</strong> <code>if ($order-&gt;total &gt; 100) $this-&gt;assertTrue(...)</code> &mdash; ветвление в assert означает, что тест проверяет одно поведение в одном случае и другое в другом. Это два теста, замаскированные под один. Разделите.
    </div>
    <div class="pitfall">
      <strong>3. Магические данные.</strong> Использование <code>42</code>, <code>'foo'</code>, <code>'2020-01-01'</code> без объяснения смысла затрудняет понимание. Дайте константам имена: <code>const VALID_AGE = 21;</code> или <code>const PAID_AMOUNT_USD = 100;</code> &mdash; даже на уровне теста.
    </div>
    <div class="pitfall">
      <strong>4. Условные expects.</strong> Конструкция <code>$mock-&gt;expects($this-&gt;atLeastOnce())</code> неявно говорит «не важно, сколько раз вызывали». Это нечеткое ожидание скрывает баги &mdash; разработчик может случайно увеличить количество вызовов в N раз и не заметить. Используйте точное <code>exactly($n)</code> или вовсе откажитесь от подсчёта.
    </div>
    <div class="pitfall">
      <strong>5. Тест зависит от другого теста.</strong> PHPUnit/Pest исполняют тесты в фиксированном порядке (но запретить опираться на это нужно жёстко). Тест, требующий состояния от предыдущего, рассыпется при параллельном запуске или фильтрации. Каждый тест должен быть самостоятельным.
    </div>
    <div class="pitfall">
      <strong>6. Имя <code>test_works</code>.</strong> Бесполезное имя &mdash; ничего не говорит о падении. Хорошее имя теста заменяет половину комментариев и описывает контракт. Если придумать имя сложно &mdash; вероятно, тест проверяет слишком много или слишком мало.
    </div>
    <div class="pitfall">
      <strong>7. Перебор data provider'ов.</strong> Запихнуть 50 кейсов в data provider, не назвав их &mdash; превратить отчёт о падении в загадку. Используйте именованные ключи: <code>'expired card' =&gt; [...]</code> &mdash; имя кейса попадёт в отчёт о падении.
    </div>
    <div class="pitfall">
      <strong>8. Зависимость от текущего времени.</strong> <code>assertEquals(Carbon::now(), $order-&gt;created_at)</code> сравнивает значения по микросекундам &mdash; в реальности время чуть-чуть разное. Зафиксируйте время через <code>Carbon::setTestNow()</code> или сравнивайте по дате.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     ARCHITECTURE — pyramid, trophy, contract tests
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-architecture" class="section">
  <div class="section-title">Архитектура тест-сюты</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Тест-сюта &mdash; это система: соотношение её слоёв определяет общую скорость, надёжность и стоимость поддержки. Слишком много медленных интеграционных тестов &mdash; CI занимает 40 минут. Слишком мало &mdash; зелёная сюта не ловит баги интеграции. Архитектурные модели (пирамида, трофей, соты) &mdash; способ обсудить эти соотношения с командой.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Три модели</div>

    <div class="card">
      <h3>Пирамида (Mike Cohn)</h3>
      <p class="text">Классика. Основание &mdash; много быстрых unit-тестов; середина &mdash; меньше integration; вершина &mdash; единицы E2E. Работает, когда логика сосредоточена внутри сервисов и слабо зависит от рамок (фреймворк, БД). На сильно зависимых от фреймворка проектах (типичные Laravel-CRUD'ы) пирамида деформируется &mdash; integration-тестов нужно больше, потому что бизнес-логика «размазана» по модели + контроллеру + middleware.</p>
    </div>

    <div class="card">
      <h3>Трофей (Kent C. Dodds)</h3>
      <p class="text">Сверху узко (E2E), внизу узко (статический анализ + типы), посередине &mdash; <strong>широкий integration-блок</strong>. Идея: интеграционные тесты дают наилучшее соотношение «уверенность / стоимость», поскольку тестируют поведение через настоящие границы (БД, очередь). Адекватная модель для веб-проектов с богатой инфраструктурой.</p>
    </div>

    <div class="card">
      <h3>Соты (Spotify)</h3>
      <p class="text">Для микросервисов: интеграционные тесты &mdash; основная масса, unit'ов меньше (микросервис как «тонкий слой» поверх библиотек), E2E &mdash; редко и кратко. Контракт-тесты заменяют большую часть E2E. Если ваш сервис &mdash; адаптер между двумя API, эта модель уместнее пирамиды.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="link-2"></i> Контракт-тесты</div>
    <p class="text">Между двумя сервисами договорённость о формате запросов и ответов называется контрактом. <strong>Consumer-driven contract testing</strong> (Pact) переворачивает подход: потребитель пишет ожидаемые взаимодействия, эти ожидания передаются провайдеру, провайдер при сборке проверяет, что его реализация удовлетворяет контракту. Преимущество перед E2E: не нужно поднимать всю инфраструктуру; падение чётко локализовано в одну сторону взаимодействия.</p>

<pre><code><span class="c-comment">// Псевдокод consumer-side test (Pact PHP):</span>
<span class="c-var">$builder</span> = <span class="c-key">new</span> <span class="c-type">InteractionBuilder</span>(<span class="c-var">$config</span>);
<span class="c-var">$builder</span>
    -&gt;<span class="c-fn">given</span>(<span class="c-str">'user 42 exists'</span>)
    -&gt;<span class="c-fn">uponReceiving</span>(<span class="c-str">'a request for user 42'</span>)
    -&gt;<span class="c-fn">with</span>([<span class="c-str">'method'</span> =&gt; <span class="c-str">'GET'</span>, <span class="c-str">'path'</span> =&gt; <span class="c-str">'/users/42'</span>])
    -&gt;<span class="c-fn">willRespondWith</span>([
        <span class="c-str">'status'</span> =&gt; <span class="c-num">200</span>,
        <span class="c-str">'body'</span>   =&gt; [<span class="c-str">'id'</span> =&gt; <span class="c-num">42</span>, <span class="c-str">'email'</span> =&gt; <span class="c-str">'a@example.com'</span>],
    ]);

<span class="c-comment">// Pact записывает контракт в pact.json и публикует в Pact Broker.</span>
<span class="c-comment">// На стороне провайдера CI поднимает API и проигрывает все контракты.</span>
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. Пирамида с гнилым основанием.</strong> 5000 unit-тестов с моками всего вокруг &mdash; формально пирамида, фактически она ничего не проверяет. Каждый тест тестирует ровно один мок-сценарий. Замените часть на integration-тесты с реальной БД и реальным контейнером &mdash; ловится больше реальных багов.
    </div>
    <div class="pitfall">
      <strong>2. E2E как единственный уровень.</strong> Стартапная классика: «у нас есть Cypress, нам unit не нужны». E2E ловит только баги, проявляющиеся через UI; разваливается на каждом редизайне; диагностика падения занимает часы. E2E дополняет, а не заменяет нижние уровни.
    </div>
    <div class="pitfall">
      <strong>3. Integration-тесты вместо unit'ов из-за инфраструктурной лени.</strong> Если бизнес-логику легче тестировать через HTTP-запрос (потому что лень настраивать unit-окружение), значит у вас сильная связанность с фреймворком. Это симптом, не решение. Извлекайте логику в чистые сервисы.
    </div>
    <div class="pitfall">
      <strong>4. Контракт-тесты без Pact Broker.</strong> Без брокера контракты живут отдельно у каждой стороны и расходятся. Pact Broker (или Pactflow) хранит контракты централизованно и сигнализирует, когда провайдер собирается ломающим изменением. Без брокера контракт-тесты быстро превращаются в спецификацию-фантом.
    </div>
    <div class="pitfall">
      <strong>5. Соты для монолита.</strong> Модель сот предполагает много мелких сервисов, у каждого &mdash; узкая ответственность. Применять её к монолиту бессмысленно &mdash; в монолите нет границ, на которых интеграция чем-то отличается от unit'а.
    </div>
    <div class="pitfall">
      <strong>6. Игнорирование времени исполнения.</strong> Сюита из 3000 тестов, бегающая 25 минут на CI, делает feedback-петлю болезненной. Целевая отметка: вся сюта на pull request'е &mdash; 5 минут. Если выше &mdash; разделяйте на быстрый блок (unit) для каждого PR и полный (integration + E2E) для main.
    </div>
    <div class="pitfall">
      <strong>7. Дублирование между уровнями.</strong> Если бизнес-правило тестируется и в unit, и в feature, и в E2E &mdash; вы платите за поддержку трижды, а ловите одну и ту же ошибку трижды. Каждое правило тестируется на самом дешёвом уровне, где оно полностью проверяемо.
    </div>
    <div class="pitfall">
      <strong>8. Ice-cream cone (перевёрнутая пирамида).</strong> Много E2E, мало unit &mdash; самый дорогой и медленный профиль сюты. Часто возникает в legacy: «unit'ы написать невозможно, потому что всё связано». Признак фундаментальной проблемы архитектуры, а не плохой стратегии тестирования.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     DB STRATEGIES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-db" class="section">
  <div class="section-title">Базы данных в тестах: стратегии и компромиссы</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">База данных &mdash; почти всегда самый медленный коллаборатор. Правильно выбранная стратегия изоляции состояния между тестами определяет, сколько секунд (или минут) занимает прогон всей сюты. Laravel предлагает несколько готовых трейтов; каждый имеет своё применение, и неправильный выбор бьёт по производительности или корректности.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Стратегии очистки БД</div>

    <div class="card">
      <h3><code>RefreshDatabase</code></h3>
      <p class="text">Стандартный выбор. При первом тесте &mdash; <code>migrate:fresh</code>, далее каждый тест оборачивается в транзакцию, откатываемую в <code>tearDown</code>. Быстрый, корректный, требует, чтобы тестируемый код <strong>не открывал собственных транзакций верхнего уровня</strong> и не выполнял <code>DDL</code> (Laravel автоматически использует savepoints для вложенных транзакций, поэтому вложенные операции работают).</p>
    </div>

    <div class="card">
      <h3><code>DatabaseTransactions</code></h3>
      <p class="text">То же оборачивание в транзакцию, но <strong>без</strong> <code>migrate:fresh</code> перед сюитой. Подходит, если миграции запускаются отдельно (например, в CI отдельным шагом), и БД уже подготовлена. Чуть быстрее <code>RefreshDatabase</code> на первом тесте, идентичен далее.</p>
    </div>

    <div class="card">
      <h3><code>DatabaseMigrations</code></h3>
      <p class="text">Полный <code>migrate:fresh</code> перед <strong>каждым</strong> тестом. Медленный (драматически на больших схемах), но единственный корректный вариант, если тестируемый код выполняет собственный <code>DDL</code> (например, шардирующий код, создающий таблицы динамически), или если тестируется код, у которого <code>BEGIN</code> в собственной логике конфликтует с обёрткой.</p>
    </div>

    <div class="card">
      <h3><code>LazilyRefreshDatabase</code> (Laravel 9+)</h3>
      <p class="text">Откладывает <code>migrate:fresh</code> до первого реального обращения к БД из теста. Если в тесте БД не используется (например, тест чистой логики), миграция не происходит вовсе. Особенно полезно в сюитах со смесью unit и feature тестов: чистые unit-тесты не платят за инициализацию БД.</p>
    </div>

    <div class="card">
      <h3>In-memory SQLite</h3>
      <p class="text"><code>DB_CONNECTION=sqlite</code>, <code>DB_DATABASE=:memory:</code>. БД живёт в памяти процесса, миграции мгновенные, тесты летают. Цена: SQLite не поддерживает многих фич реального MySQL/PostgreSQL (CHECK-ограничения работают по-другому, нет FULLTEXT, разные правила NULL в UNIQUE, нет array/jsonb типов). Тесты могут проходить на SQLite и падать на проде. Применимо, если код заведомо не использует специфичных фич, либо как быстрый смоук-уровень рядом с медленной но «настоящей» интеграционной сюитой.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: матрица выбора</div>
    <table class="data-table">
      <tr><th>Случай</th><th>Стратегия</th><th>Почему</th></tr>
      <tr><td>Обычная CRUD-сюта на MySQL/Postgres</td><td><code>RefreshDatabase</code> + реальный движок в контейнере</td><td>Поведение совпадает с продом, время приемлемое</td></tr>
      <tr><td>Большая сюта с смесью unit/feature</td><td><code>LazilyRefreshDatabase</code></td><td>Unit-тесты не платят за БД</td></tr>
      <tr><td>Код управляет схемой динамически</td><td><code>DatabaseMigrations</code></td><td>Транзакции конфликтуют с DDL</td></tr>
      <tr><td>CI с медленным Postgres, нужна максимальная скорость PR</td><td>SQLite in-memory для PR, Postgres для main</td><td>Двухуровневая защита: быстрая для PR, точная для main</td></tr>
      <tr><td>Параллельные тесты с <code>paratest</code></td><td><code>RefreshDatabase</code> + per-process DB</td><td>Каждый процесс работает в своей БД, нет конфликтов</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. <code>RefreshDatabase</code> и собственные <code>BEGIN/COMMIT</code> в коде.</strong> Если код вызывает <code>DB::beginTransaction()</code> и <code>DB::commit()</code>, при работе под <code>RefreshDatabase</code> commit на верхнем уровне не делает реальный commit (мы внутри оборачивающей транзакции), а ошибки внутри откатывают только savepoint. Тесты проходят, в проде же поведение отличается. Решение &mdash; <code>DatabaseMigrations</code> для такого кода.
    </div>
    <div class="pitfall">
      <strong>2. <code>truncate</code> вместо транзакций.</strong> Некоторые проекты используют ручной <code>DB::table('users')-&gt;truncate()</code> в <code>tearDown</code>. На таблицах с FK &mdash; падает. На больших таблицах &mdash; медленно. На MySQL <code>TRUNCATE</code> вне транзакции и не может быть откачен. Транзакционная стратегия Laravel почти всегда быстрее и корректнее.
    </div>
    <div class="pitfall">
      <strong>3. Кэширование внутри теста.</strong> Если тестируемый код кеширует значения (Redis, file cache), кеш переживает <code>tearDown</code> и протекает между тестами. Добавьте <code>Cache::flush()</code> в setUp/тестовый <code>boot</code>, либо используйте <code>array</code> драйвер кеша в <code>phpunit.xml</code>.
    </div>
    <div class="pitfall">
      <strong>4. Автоматические <code>observed</code> хуки моделей.</strong> <code>Observer::created</code> может писать в другие таблицы, отправлять уведомления, генерировать события. В тесте это создаёт неявные побочные эффекты. Либо отключайте observer'ы в тестах (<code>User::flushEventListeners()</code>), либо принимайте, что тест &mdash; integration.
    </div>
    <div class="pitfall">
      <strong>5. <code>seed</code> в <code>RefreshDatabase</code>.</strong> Если включить <code>protected bool $seed = true;</code>, seed выполняется на каждом тесте. На крупных seed'ах &mdash; десятки секунд накладных расходов. Лучше выносить общий setup в фабрики или явные helper'ы и сидить только нужное для теста.
    </div>
    <div class="pitfall">
      <strong>6. SQLite строгий vs нестрогий.</strong> До PHP 8.4 SQLite-драйвер Laravel автоматически нестрогий: вставка <code>INSERT</code> в колонку с лишним полем не падает, а тихо игнорирует поле. На проде с MySQL/Postgres &mdash; ошибка. Включите <code>foreign_key_constraints =&gt; true</code> и периодически прогоняйте сюту на «настоящем» движке.
    </div>
    <div class="pitfall">
      <strong>7. Зависимость от порядка autoincrement.</strong> Тест проверяет, что у первого созданного пользователя <code>id = 1</code>. На SQLite (с reset) проходит; на Postgres c gap'ами (после неудачных вставок) &mdash; падает. Не опирайтесь на конкретные значения ID, используйте ссылки на объекты: <code>$this-&gt;assertSame($user-&gt;id, $order-&gt;user_id)</code>.
    </div>
    <div class="pitfall">
      <strong>8. Миграции в тестах vs миграции в проде.</strong> Если в проде применяете zero-downtime миграции (через <code>pt-osc</code>, <code>gh-ost</code>), а в тестах &mdash; обычные Laravel-миграции, окно расхождения возможно. Прогоняйте боевые миграции на staging БД с реальными данными как отдельный CI-шаг.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PARALLEL TESTING
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-parallel" class="section">
  <div class="section-title">Параллельные тесты</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Тестов становится больше каждый месяц; время &laquo;зелёного PR&raquo; растёт линейно от их числа, если ничего не предпринимать. Параллельное исполнение &mdash; первое и самое дешёвое средство удержать feedback-петлю короткой. Laravel 8+ поставляет встроенную интеграцию с ParaTest через <code>php artisan test --parallel</code>; Pest имеет собственный параллельный режим. Главное в обоих &mdash; изоляция: процессы не должны мешать друг другу через общие БД, файлы, кеш и порты.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Как Laravel изолирует параллельные тесты</div>

    <div class="card">
      <h3>Отдельная БД на процесс</h3>
      <p class="text">При <code>--parallel</code> Laravel создаёт N тестовых БД по шаблону <code>{db_name}_test_{token}</code>, где <code>{token}</code> &mdash; идентификатор процесса (1..N). Каждый процесс получает <code>ParallelTesting::resolveDatabaseTokenUsing</code>, который подменяет имя БД на свою копию. Миграции прогоняются для каждой БД отдельно при первом тесте процесса.</p>
    </div>

    <div class="card">
      <h3>Хуки <code>ParallelTesting::setUp*</code></h3>
      <p class="text">Регистрируются в <code>AppServiceProvider::boot</code> или в <code>tests/CreatesApplication.php</code>. Доступны: <code>setUpProcess</code>, <code>setUpTestCase</code>, <code>setUpTestDatabase</code>, <code>tearDownProcess</code>. Здесь готовится shared-инфраструктура (например, отдельный Redis DB index на процесс) и убирается на выходе.</p>
    </div>

    <div class="card">
      <h3>Per-process Redis / Cache / Queue</h3>
      <p class="text">Без явной настройки два процесса будут писать в один Redis DB и затирать друг друга. В тестовой конфигурации задайте <code>config(['cache.stores.redis.database' =&gt; $token])</code> в setUp процесса или используйте драйвер <code>array</code> для кеша/очереди в тестах &mdash; он живёт в памяти процесса и автоматически изолирован.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: настройка параллельного запуска</div>

<pre><code><span class="c-comment">// tests/CreatesApplication.php — настройка изоляции</span>
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\ParallelTesting</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Redis</span>;

<span class="c-key">trait</span> <span class="c-type">CreatesApplication</span>
{
    <span class="c-key">public function</span> <span class="c-fn">createApplication</span>(): <span class="c-key">\Illuminate\Foundation\Application</span>
    {
        <span class="c-var">$app</span> = <span class="c-key">require</span> <span class="c-fn">__DIR__</span> . <span class="c-str">'/../bootstrap/app.php'</span>;
        <span class="c-var">$app</span>-&gt;<span class="c-fn">make</span>(<span class="c-type">\Illuminate\Contracts\Console\Kernel</span>::<span class="c-key">class</span>)-&gt;<span class="c-fn">bootstrap</span>();

        <span class="c-type">ParallelTesting</span>::<span class="c-fn">setUpProcess</span>(<span class="c-key">function</span> (<span class="c-key">int</span> <span class="c-var">$token</span>) {
            <span class="c-comment">// Каждый процесс получает собственный Redis DB index.</span>
            <span class="c-fn">config</span>([<span class="c-str">'database.redis.cache.database'</span> =&gt; <span class="c-var">$token</span>]);
            <span class="c-fn">config</span>([<span class="c-str">'database.redis.default.database'</span> =&gt; <span class="c-var">$token</span>]);
        });

        <span class="c-type">ParallelTesting</span>::<span class="c-fn">setUpTestDatabase</span>(<span class="c-key">function</span> (<span class="c-key">string</span> <span class="c-var">$database</span>, <span class="c-key">int</span> <span class="c-var">$token</span>) {
            <span class="c-comment">// Сюда можно положить общие seed'ы, нужные каждому процессу.</span>
        });

        <span class="c-type">ParallelTesting</span>::<span class="c-fn">tearDownProcess</span>(<span class="c-key">function</span> (<span class="c-key">int</span> <span class="c-var">$token</span>) {
            <span class="c-type">Redis</span>::<span class="c-fn">connection</span>()-&gt;<span class="c-fn">flushdb</span>();
        });

        <span class="c-key">return</span> <span class="c-var">$app</span>;
    }
}
</code></pre>

    <p class="text">Запуск: <code>php artisan test --parallel --processes=8 --recreate-databases</code>. Флаг <code>--recreate-databases</code> пересоздаёт все шарды; на CI &mdash; обязателен (предыдущая сюита могла оставить БД в неконсистентном состоянии).</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. Файловая система не изолирована.</strong> Тесты, пишущие в <code>storage/app/exports/</code>, конфликтуют между процессами. Используйте <code>Storage::fake('exports')</code> &mdash; драйвер fake создаёт уникальный временный каталог для каждого процесса.
    </div>
    <div class="pitfall">
      <strong>2. Общий внешний сервис (ClickHouse, Elastic).</strong> Параллельные тесты могут гасить друг другу индексы. Решение: per-process index name (<code>orders_test_{$token}</code>) или один процесс на такой класс тестов через group/филтрацию.
    </div>
    <div class="pitfall">
      <strong>3. Глобальные php-настройки.</strong> Изменение <code>ini_set</code> в тесте утекает между тестами одного процесса. При параллельном запуске это удваивается. Используйте <code>ini_restore</code> или явный setUp/tearDown, восстанавливающий значения.
    </div>
    <div class="pitfall">
      <strong>4. Порты.</strong> Если тест поднимает HTTP-стуб на фиксированном порту, параллельные процессы будут драться за порт. Используйте <code>0</code> (любой свободный) и читайте назначенный порт обратно.
    </div>
    <div class="pitfall">
      <strong>5. Параллельность ради параллельности.</strong> На крошечной сюите (50 тестов) параллельный запуск может оказаться медленнее последовательного из-за оверхеда на forks и копирование БД. Замеряйте до и после.
    </div>
    <div class="pitfall">
      <strong>6. Random seed.</strong> Тест, использующий <code>fake()-&gt;randomElement(...)</code> без фиксированного seed, может проходить на одной машине и падать на другой. Зафиксируйте seed в <code>setUp</code>: <code>fake()-&gt;seed(1234)</code>.
    </div>
    <div class="pitfall">
      <strong>7. Расход памяти.</strong> Каждый параллельный процесс &mdash; полноценный PHP-процесс с приложением в памяти. 8 процессов = 8 × ~150&nbsp;MB. На небольших CI-раннерах это превышает доступную RAM и приводит к swap'у, делая тесты медленнее, чем при последовательном запуске.
    </div>
    <div class="pitfall">
      <strong>8. Стресс на БД.</strong> 8 процессов = 8 одновременных миграций на старте. На небольшой dev-БД это вызывает блокировки. Прогрейте БД заранее или используйте схему «один процесс инициализирует, остальные клонируют».
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     TIME & QUEUES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-time" class="section">
  <div class="section-title">Время и очереди: детерминизм</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Источники недетерминизма ломают тесты предсказуемо &mdash; не сегодня, так через неделю. Главные виновники: текущее время, случайные числа, асинхронные задачи. Каждый из них &mdash; контролируемая сущность в Laravel; правильное использование инструментов превращает потенциально флакающий тест в воспроизводимый.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Инструменты контроля</div>

    <div class="card">
      <h3>Фиксация времени: <code>Carbon::setTestNow()</code> / <code>travel*</code></h3>
      <p class="text">В Laravel: <code>$this-&gt;travelTo($specific)</code>, <code>$this-&gt;travel(5)-&gt;hours()</code>, <code>$this-&gt;freezeTime()</code>. Под капотом &mdash; <code>Carbon::setTestNow()</code>. Все вызовы <code>now()</code>, <code>Carbon::now()</code>, <code>Date::now()</code>, <code>CURRENT_TIMESTAMP</code> на стороне ORM (через <code>$timestamps</code>) и в Eloquent касты возвращают зафиксированное время.</p>
    </div>

    <div class="card">
      <h3>Очереди: <code>Queue::fake()</code></h3>
      <p class="text">Подменяет драйвер очереди на in-memory массив. Задания не исполняются, но фиксируются: <code>Queue::assertPushed(SendInvoice::class)</code>, <code>Queue::assertPushedOn('mail', SendInvoice::class)</code>, <code>Queue::assertNotPushed(...)</code>. Это идеально подходит для феичр-тестов, где важно проверить факт постановки задачи, но не её исполнение.</p>
    </div>

    <div class="card">
      <h3>Синхронное исполнение: драйвер <code>sync</code></h3>
      <p class="text">Альтернатива &mdash; <code>QUEUE_CONNECTION=sync</code> в <code>phpunit.xml</code>. Задание исполняется сразу в текущем процессе. Удобно, когда нужно протестировать <em>побочные эффекты</em> исполнения (job записал в БД, отправил письмо), а не сам факт постановки.</p>
    </div>

    <div class="card">
      <h3>События: <code>Event::fake()</code> и партиал-фейк</h3>
      <p class="text"><code>Event::fake()</code> &mdash; все слушатели отключены, события только записываются. <code>Event::fake([OrderPaid::class])</code> &mdash; фейк только для конкретного события (остальные доходят до слушателей). Полезно, когда нужно изолировать одно событие, не отключая всю шину.</p>
    </div>

    <div class="card">
      <h3>HTTP: <code>Http::fake</code> и <code>Http::preventStrayRequests</code></h3>
      <p class="text"><code>Http::fake([...])</code> подменяет ответы для указанных URL. <code>Http::preventStrayRequests()</code> делает тест строгим: любой реальный HTTP-вызов в тесте бросит исключение. Включите в базовом TestCase &mdash; это поймает «забытые» внешние вызовы, которые иначе ходят в реальный API на CI.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: тест задачи с задержкой</div>

<pre><code><span class="c-comment">// Тестируем, что подписка истечёт через 30 дней и тогда отправится напоминание.</span>
<span class="c-key">public function</span> <span class="c-fn">test_renewal_reminder_sent_one_day_before_expiry</span>(): <span class="c-key">void</span>
{
    <span class="c-type">Queue</span>::<span class="c-fn">fake</span>();

    <span class="c-comment">// Замораживаем время на «сегодня в 10:00 UTC».</span>
    <span class="c-var">$this</span>-&gt;<span class="c-fn">travelTo</span>(<span class="c-fn">now</span>()-&gt;<span class="c-fn">setTime</span>(<span class="c-num">10</span>, <span class="c-num">0</span>));

    <span class="c-var">$subscription</span> = <span class="c-type">Subscription</span>::<span class="c-fn">factory</span>()-&gt;<span class="c-fn">create</span>([
        <span class="c-str">'expires_at'</span> =&gt; <span class="c-fn">now</span>()-&gt;<span class="c-fn">addDays</span>(<span class="c-num">30</span>),
    ]);

    <span class="c-comment">// Перемещаемся в момент за день до истечения.</span>
    <span class="c-var">$this</span>-&gt;<span class="c-fn">travel</span>(<span class="c-num">29</span>)-&gt;<span class="c-fn">days</span>();

    (<span class="c-key">new</span> <span class="c-type">ScheduleRenewalReminders</span>())-&gt;<span class="c-fn">__invoke</span>();

    <span class="c-type">Queue</span>::<span class="c-fn">assertPushed</span>(<span class="c-type">SendRenewalReminder</span>::<span class="c-key">class</span>,
        <span class="c-key">fn</span> (<span class="c-type">SendRenewalReminder</span> <span class="c-var">$job</span>) =&gt; <span class="c-var">$job</span>-&gt;<span class="c-var">subscriptionId</span> === <span class="c-var">$subscription</span>-&gt;<span class="c-var">id</span>);
}
</code></pre>

    <p class="text">Тест полностью детерминирован: <code>now()</code> зафиксирован, очередь &mdash; in-memory, никакой реальной отправки. То же поведение можно проверить и через <code>Queue::sync</code> + <code>Mail::fake()</code>, если важна проверка финального письма, а не задачи в очереди.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. <code>travel</code> и БД CURRENT_TIMESTAMP.</strong> Laravel перехватывает только PHP-сторону. Если в SQL стоит <code>DEFAULT CURRENT_TIMESTAMP</code>, БД возьмёт реальное время. Это разъезжается с замороженным PHP-временем. Заполняйте поля явно в фабриках через <code>now()</code>.
    </div>
    <div class="pitfall">
      <strong>2. <code>Queue::fake()</code> и встроенные асинхронные нотификации.</strong> <code>Notification::fake()</code> и <code>Mail::fake()</code> могут конфликтовать с <code>Queue::fake()</code>, поскольку нотификация ставится в очередь и потом fake-очередь рапортует «pushed», а тесты пишутся через assertSent. Используйте либо один уровень fake, либо понимайте, на каком уровне будете проверять.
    </div>
    <div class="pitfall">
      <strong>3. <code>RefreshDatabase</code> + <code>QUEUE_CONNECTION=sync</code>.</strong> Если job в синхронной очереди делает запись в БД и далее тест проверяет состояние через другую транзакцию &mdash; запись не видна (она внутри обёрточной транзакции). Либо используйте fake, либо настраивайте отдельную «фоновую» транзакционную стратегию.
    </div>
    <div class="pitfall">
      <strong>4. Случайные числа в тесте.</strong> <code>random_int</code>, <code>fake()-&gt;name()</code>, <code>Str::random()</code> &mdash; источник флакающих тестов. Зафиксируйте seed (<code>mt_srand(1234)</code>, <code>fake()-&gt;seed(1234)</code>) либо избегайте случайностей в тестах вовсе.
    </div>
    <div class="pitfall">
      <strong>5. <code>Carbon::setTestNow(null)</code> в setUp следующего теста.</strong> Если <code>setTestNow</code> вызван и не сброшен, оно утечёт в следующий тест. Laravel'овский <code>travelBack</code> вызывается автоматически в <code>tearDown</code> &mdash; используйте его, а не голый Carbon, чтобы не забывать.
    </div>
    <div class="pitfall">
      <strong>6. Таймзоны.</strong> Тест может проходить в UTC и падать на машине разработчика в Asia/Almaty: даты, рассчитываемые через локальную TZ, отличаются. Зафиксируйте <code>date.timezone = UTC</code> в <code>phpunit.xml</code> и в <code>app.timezone</code>.
    </div>
    <div class="pitfall">
      <strong>7. <code>Http::fake</code> для не-await вызовов.</strong> Если код использует <code>Http::async</code>, а fake настроен синхронно, поведение разъезжается. Используйте <code>Http::fakeSequence</code> и явные ожидания.
    </div>
    <div class="pitfall">
      <strong>8. Использование <code>sleep()</code> в тесте.</strong> Любая физическая пауза &mdash; запах. Если тест ждёт условия, выражайте это явно (<code>retry(5, fn() =&gt; ...)</code>) и фиксируйте время через <code>travel</code>.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     HTTP CLIENT
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-http" class="section">
  <div class="section-title">Тестирование внешних API</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Любое взаимодействие с внешним сервисом &mdash; источник недетерминизма, нестабильности и затрат: API может быть медленным, недоступным, лимитированным по запросам или платным. Laravel'овский <code>Http</code>-клиент предоставляет встроенный fake, который покрывает 90% случаев; для оставшихся применяются recorded-сценарии и WireMock-подобные сервисы.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Способы изоляции</div>

    <div class="card">
      <h3><code>Http::fake([URL =&gt; Response])</code></h3>
      <p class="text">Самый прямой способ: декларируем мок-ответ для конкретного URL или шаблона. Поддерживает wildcard'ы (<code>api.example.com/*</code>), последовательности ответов (<code>Http::sequence()</code>), функциональные обработчики (<code>fn ($request) =&gt; ...</code>). Все настоящие HTTP-вызовы блокируются.</p>
    </div>

    <div class="card">
      <h3><code>Http::preventStrayRequests()</code></h3>
      <p class="text">Включается в базовом TestCase. Любой запрос, не покрытый <code>Http::fake</code>, бросает исключение с описанием URL. Это страхует от ситуации &laquo;разработчик добавил новый внешний вызов и забыл его замокать&raquo;, которая иначе бьёт по CI.</p>
    </div>

    <div class="card">
      <h3>Recorded fixtures</h3>
      <p class="text">Для сложных ответов (большой JSON, бинарный contentent) удобно сохранить настоящий ответ один раз и проигрывать его в тестах. В Laravel есть пакеты типа <code>spatie/test-time</code> и <code>spatie/laravel-snapshot-tests</code>; рукотворный вариант &mdash; <code>Storage::disk('fixtures')-&gt;get('stripe-charge.json')</code>.</p>
    </div>

    <div class="card">
      <h3>WireMock / Mockoon как отдельный процесс</h3>
      <p class="text">Когда тестируется поведение, зависящее от тонкостей HTTP (заголовки, retry, redirect), полезен внешний mock-сервер. WireMock крутится в Docker, отвечает по своим правилам, и приложение общается с ним по обычному HTTP. Дороже в setup'е, но даёт максимальную точность.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: retry, timeout, idempotency</div>

<pre><code><span class="c-key">public function</span> <span class="c-fn">test_charge_retries_on_502_and_succeeds_on_third_attempt</span>(): <span class="c-key">void</span>
{
    <span class="c-type">Http</span>::<span class="c-fn">preventStrayRequests</span>();
    <span class="c-type">Http</span>::<span class="c-fn">fake</span>([
        <span class="c-str">'api.stripe.com/*'</span> =&gt; <span class="c-type">Http</span>::<span class="c-fn">sequence</span>()
            -&gt;<span class="c-fn">push</span>([<span class="c-str">'error'</span> =&gt; <span class="c-str">'bad_gateway'</span>], <span class="c-num">502</span>)
            -&gt;<span class="c-fn">push</span>([<span class="c-str">'error'</span> =&gt; <span class="c-str">'bad_gateway'</span>], <span class="c-num">502</span>)
            -&gt;<span class="c-fn">push</span>([<span class="c-str">'id'</span> =&gt; <span class="c-str">'ch_123'</span>, <span class="c-str">'amount'</span> =&gt; <span class="c-num">1000</span>], <span class="c-num">200</span>),
    ]);

    <span class="c-var">$gateway</span> = <span class="c-fn">app</span>(<span class="c-type">StripeGateway</span>::<span class="c-key">class</span>);
    <span class="c-var">$result</span>  = <span class="c-var">$gateway</span>-&gt;<span class="c-fn">charge</span>(<span class="c-num">1000</span>, <span class="c-str">'USD'</span>, <span class="c-str">'idem_42'</span>);

    <span class="c-var">$this</span>-&gt;<span class="c-fn">assertSame</span>(<span class="c-str">'ch_123'</span>, <span class="c-var">$result</span>-&gt;<span class="c-var">id</span>);

    <span class="c-type">Http</span>::<span class="c-fn">assertSentCount</span>(<span class="c-num">3</span>);
    <span class="c-type">Http</span>::<span class="c-fn">assertSent</span>(<span class="c-key">fn</span> (<span class="c-type">Request</span> <span class="c-var">$req</span>) =&gt;
        <span class="c-var">$req</span>-&gt;<span class="c-fn">header</span>(<span class="c-str">'Idempotency-Key'</span>)[<span class="c-num">0</span>] === <span class="c-str">'idem_42'</span>);
}
</code></pre>

    <p class="text">Тест декларирует ожидаемое поведение (две неудачи и успех на третьей попытке), проверяет результат и подтверждает, что idempotency-key передан во всех попытках &mdash; это критично для финансовых операций.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. Fake без <code>preventStrayRequests</code>.</strong> <code>Http::fake([])</code> молча пропускает реальные запросы для URL, не указанных в массиве. Один забытый URL &mdash; и тест ходит на боевой API. Всегда включайте <code>preventStrayRequests</code> в базовом TestCase.
    </div>
    <div class="pitfall">
      <strong>2. <code>Http::sequence</code> исчерпался.</strong> Если код сделал больше запросов, чем настроено в sequence, fake вернёт пустой 200 OK молча (без явной настройки). Используйте <code>whenEmpty</code> для явного поведения по исчерпанию.
    </div>
    <div class="pitfall">
      <strong>3. Мок отвечает медленнее реального API.</strong> Fake возвращает мгновенно &mdash; тест не проверяет timeout-сценарии. Если retry/timeout важны (а в платежах &mdash; почти всегда), отдельно тестируйте код таймаута через подмену клиента на тот, что выбрасывает <code>ConnectionException</code>.
    </div>
    <div class="pitfall">
      <strong>4. Wildcard слишком широкий.</strong> <code>Http::fake(['*' =&gt; ...])</code> ловит всё, включая случайные домены. Указывайте конкретный хост: <code>'api.stripe.com/*'</code>.
    </div>
    <div class="pitfall">
      <strong>5. Тест не проверяет тело запроса.</strong> <code>assertSent</code> с одним только URL не подтверждает, что мы послали правильный payload. В платежах это критично: тест может проходить, отправляя $0 вместо $1000. Проверяйте <code>$req-&gt;data()</code>.
    </div>
    <div class="pitfall">
      <strong>6. Recorded fixture не обновлён.</strong> Записанный когда-то ответ со временем устаревает (изменилась структура API). Без процесса периодической перезаписи fixture'ов тесты дают ложную уверенность. Лучше: contract tests + Pact.
    </div>
    <div class="pitfall">
      <strong>7. Утечка реального API-ключа в fake-режим.</strong> Если <code>Http::fake</code> не закрывает все вызовы, реальный запрос уйдёт с боевым ключом. Обнулите <code>STRIPE_SECRET</code> в <code>phpunit.xml</code> и убедитесь, что код корректно реагирует на отсутствие ключа.
    </div>
    <div class="pitfall">
      <strong>8. Зависимость от порядка assert'ов.</strong> <code>Http::assertSent</code> проходит по всем запросам в порядке отправки. Если меняется порядок (например, параллельные HTTP-вызовы через <code>Http::pool</code>), хрупкие проверки порядка ломаются. Используйте <code>assertSent</code> с предикатом, не зависящим от порядка.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     MUTATION TESTING
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-mutation" class="section">
  <div class="section-title">Mutation testing — измеряем качество тестов</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Coverage отвечает на вопрос «исполнялась ли строка кода во время тестов» &mdash; это слабое утверждение. Mutation testing отвечает на сильнее: «обнаружит ли сюта, если этот код изменится?». Инструмент (для PHP &mdash; <strong>Infection</strong>) делает множество мелких изменений в исходниках (мутаций) и прогоняет тесты на каждой. Если все тесты проходят на мутации &mdash; значит, сюта эту строку не реально проверяет; такая мутация называется <em>survived</em>. Если хотя бы один тест падает &mdash; мутация <em>killed</em>. Отношение убитых к общему числу &mdash; mutation score.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Что Infection меняет в коде</div>
    <ul class="bullets">
      <li><strong>Арифметика</strong>: <code>+</code> &harr; <code>-</code>, <code>*</code> &harr; <code>/</code>;</li>
      <li><strong>Сравнения</strong>: <code>&gt;</code> &harr; <code>&gt;=</code>, <code>==</code> &harr; <code>!=</code>, <code>&lt;</code> &harr; <code>&lt;=</code>;</li>
      <li><strong>Возвращаемые значения</strong>: <code>return $x</code> &rarr; <code>return null</code>, <code>return true</code> &rarr; <code>return false</code>;</li>
      <li><strong>Условия циклов</strong>: <code>foreach ($items)</code> &rarr; <code>foreach ([])</code>;</li>
      <li><strong>Логические операторы</strong>: <code>&amp;&amp;</code> &harr; <code>||</code>, <code>!</code> убирается;</li>
      <li><strong>Удаление вызовов методов</strong> с типом возврата <code>void</code>.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: настройка Infection</div>

<pre><code><span class="c-comment">// composer require --dev infection/infection</span>

<span class="c-comment">// infection.json5</span>
{
    <span class="c-str">"$schema"</span>: <span class="c-str">"vendor/infection/infection/resources/schema.json"</span>,
    <span class="c-str">"source"</span>: {
        <span class="c-str">"directories"</span>: [<span class="c-str">"app"</span>],
        <span class="c-str">"excludes"</span>:    [<span class="c-str">"app/Http/Controllers"</span>, <span class="c-str">"app/Console"</span>]
    },
    <span class="c-str">"timeout"</span>: <span class="c-num">10</span>,
    <span class="c-str">"logs"</span>: {
        <span class="c-str">"text"</span>:    <span class="c-str">"build/infection.log"</span>,
        <span class="c-str">"summary"</span>: <span class="c-str">"build/infection-summary.log"</span>
    },
    <span class="c-str">"mutators"</span>: {
        <span class="c-str">"@default"</span>: <span class="c-key">true</span>,
        <span class="c-str">"@function_signature"</span>: <span class="c-key">false</span>
    }
}
</code></pre>

<pre><code><span class="c-comment"># Прогон. --threads берёт N процессов; --min-msi — минимальный mutation score</span>
vendor/bin/infection --threads=<span class="c-num">8</span> --min-msi=<span class="c-num">80</span> --min-covered-msi=<span class="c-num">90</span>
</code></pre>

    <p class="text">Параметры <code>--min-msi</code> и <code>--min-covered-msi</code> ставят пороги: первый &mdash; общий mutation score, второй &mdash; mutation score только по покрытым строкам. На CI Infection валит сборку, если пороги не достигнуты &mdash; это превращает качество тестов в измеряемую величину, как и обычное coverage.</p>

    <p class="text">Типичный профиль: Infection прогоняет в 30-100 раз дольше обычной сюты (на каждой мутации &mdash; полный тест-ран). Не запускайте на каждом PR &mdash; запускайте ночью или вручную перед релизом.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. Equivalent mutations.</strong> Некоторые мутации семантически эквивалентны оригиналу (например, <code>x &lt; 10</code> и <code>x &lt;= 9</code> для целых). Они помечены как survived, хотя тест корректен. Доля equivalent &mdash; шум, не свидетельство плохих тестов; научитесь распознавать.
    </div>
    <div class="pitfall">
      <strong>2. Mutation score 100%.</strong> Звучит как идеал, на практике &mdash; красный флаг over-testing. Каждый сценарий проверен с избытком; малейший рефакторинг ломает десятки тестов. Реалистичный таргет &mdash; 70-85% для важной логики, ниже для glue-кода.
    </div>
    <div class="pitfall">
      <strong>3. Мутация контроллеров.</strong> Контроллер &mdash; тонкий слой; полезной логики для мутации мало. Исключайте <code>app/Http/Controllers</code> и аналогичные thin layers из source &mdash; иначе Infection тратит время на мутации, которые ничего не доказывают.
    </div>
    <div class="pitfall">
      <strong>4. Долгий тайм-аут.</strong> На медленных integration-тестах Infection может зависать. Установите <code>"timeout": 10</code> и снимите тяжёлые тесты с участка кода, тестируемого мутациями.
    </div>
    <div class="pitfall">
      <strong>5. Параллельные тесты в Infection.</strong> <code>--threads=N</code> &mdash; параллельные мутации, не параллельные тесты. Это N процессов Infection, каждый запускает обычную последовательную сюту. Параллельные тесты внутри (<code>--parallel</code>) могут конфликтовать; чаще проще использовать только Infection threads.
    </div>
    <div class="pitfall">
      <strong>6. Mutation score падает после рефакторинга.</strong> Это нормально и информативно: рефакторинг ввёл новую логику, которую старые тесты не покрывают. Добавьте тесты, score восстановится.
    </div>
    <div class="pitfall">
      <strong>7. Бегать на каждой ветке.</strong> На большом проекте Infection занимает часы. Бегайте только на main/develop по расписанию, а на PR проверяйте только <code>--git-diff-base</code> &mdash; мутации только изменённых файлов.
    </div>
    <div class="pitfall">
      <strong>8. Игнорирование @infection-ignore.</strong> Можно пометить участок кода как игнорируемый для Infection (комментарий <code>@infection-ignore-all</code>). Использование оправдано (примеры: вспомогательная статистика, нечеткая логика), но обильное применение &mdash; способ скрыть низкое качество тестов.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     COVERAGE
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-coverage" class="section">
  <div class="section-title">Coverage честно: что измеряют метрики</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Coverage &mdash; популярная, но опасно неточная метрика. Менеджмент часто требует «80% coverage», команда подгоняет цифру тестами, которые ничего не проверяют. Чтобы метрика была полезной, важно понимать: что именно она измеряет, чем отличаются её разновидности и почему 100% line coverage не равно «всё протестировано».</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Виды coverage</div>

    <div class="card">
      <h3>Line coverage</h3>
      <p class="text">Доля строк кода, исполненных хотя бы раз во время тестов. Самая распространённая и самая слабая метрика. Тест, который вызывает функцию, но не проверяет результат, даёт 100% line coverage функции.</p>
    </div>

    <div class="card">
      <h3>Branch coverage</h3>
      <p class="text">Доля ветвей условий, пройденных тестами. Для <code>if ($a &amp;&amp; $b)</code> требует, чтобы и <code>true</code>, и <code>false</code> ветви были покрыты. Сильнее line, но не покрывает все комбинации short-circuit.</p>
    </div>

    <div class="card">
      <h3>Path coverage</h3>
      <p class="text">Доля уникальных путей через граф управления функции. Самая сильная из «обычных» метрик; экспоненциально дорогая в достижении. На практике замеряется редко.</p>
    </div>

    <div class="card">
      <h3>MC/DC (Modified Condition / Decision Coverage)</h3>
      <p class="text">Каждое условие в составном выражении должно независимо менять итоговое решение. Стандарт для авиационного и медицинского ПО; для веба избыточен, но концептуально полезен для критичных модулей (платежи, ауф).</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: настройка coverage</div>

<pre><code><span class="c-comment">// phpunit.xml — включаем coverage, добавляем фильтр</span>
&lt;<span class="c-type">coverage</span>&gt;
    &lt;<span class="c-type">include</span>&gt;
        &lt;<span class="c-type">directory</span> suffix=<span class="c-str">".php"</span>&gt;app&lt;/<span class="c-type">directory</span>&gt;
    &lt;/<span class="c-type">include</span>&gt;
    &lt;<span class="c-type">exclude</span>&gt;
        &lt;<span class="c-type">directory</span>&gt;app/Console&lt;/<span class="c-type">directory</span>&gt;
        &lt;<span class="c-type">file</span>&gt;app/Providers/RouteServiceProvider.php&lt;/<span class="c-type">file</span>&gt;
    &lt;/<span class="c-type">exclude</span>&gt;
&lt;/<span class="c-type">coverage</span>&gt;
</code></pre>

<pre><code><span class="c-comment"># XDebug медленный, для скорости используйте PCOV:</span>
pecl install pcov
php -d pcov.enabled=<span class="c-num">1</span> vendor/bin/phpunit --coverage-html=build/coverage --coverage-clover=build/clover.xml
</code></pre>

    <p class="text">Coverage пригоден как индикатор «вот эта папка ни разу не тронута», не как мера качества. Сочетайте с mutation testing для адекватной картины.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. Coverage как KPI.</strong> Если разработчик премируется за процент coverage &mdash; он напишет много пустых тестов. KPI на coverage всегда дегенерирует в KPI на «количество вызовов в исходниках». Метрика должна быть индикатором, не целью.
    </div>
    <div class="pitfall">
      <strong>2. Coverage Eloquent-моделей.</strong> Модели &mdash; в основном декларация (атрибуты, relations). Coverage 100% достигается тривиально, не доказывая ничего. Считайте coverage только для слоя с логикой (Services, Actions, Domain).
    </div>
    <div class="pitfall">
      <strong>3. Coverage и dead code.</strong> Если есть код, не вызванный никаким тестом и при этом не используемый в проде &mdash; это dead code, а не «не покрытая ветка». Используйте инструменты типа <code>icanhazstring/composer-unused</code> и <code>phpstan</code> для поиска dead code; coverage только покажет последствия.
    </div>
    <div class="pitfall">
      <strong>4. Coverage exception-веток.</strong> Тестировать обработку <code>catch</code> часто непропорционально дорого: нужно подменить зависимость так, чтобы она выкинула исключение. Если ошибка корректно прокидывается выше &mdash; иногда достаточно интеграционного теста на пограничном уровне.
    </div>
    <div class="pitfall">
      <strong>5. Coverage абстрактных классов.</strong> Abstract-методы не имеют тела и не учитываются в line coverage. Сам абстрактный класс &mdash; неисполняемый. Это не проблема, но может вводить в заблуждение при первом анализе отчёта.
    </div>
    <div class="pitfall">
      <strong>6. Xdebug vs PCOV.</strong> Xdebug снимает coverage в 10-20 раз медленнее, чем PCOV. Для CI на больших сюитах разница в полчаса каждый PR. PCOV не работает в обычных debug-сценариях &mdash; ставьте его как отдельное расширение для CI.
    </div>
    <div class="pitfall">
      <strong>7. Coverage по строкам vs по выражениям.</strong> Несколько выражений на одной строке (<code>$a = foo(); $b = bar();</code>) считаются как одна строка. Coverage 100% не означает, что оба выражения исполнены.
    </div>
    <div class="pitfall">
      <strong>8. Кеширование coverage между тестами.</strong> Если в CI кешируется отчёт coverage, изменения тестов могут не отразиться в финальном проценте. Сбрасывайте кеш coverage при каждом запуске.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     SNAPSHOT
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-snapshot" class="section">
  <div class="section-title">Snapshot-тесты</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Snapshot-тестирование &mdash; запись «снимка» вывода (JSON, HTML, текст) при первом прогоне и сравнение с ним на последующих. Цель &mdash; быстро ловить <strong>непредвиденные изменения</strong> в выводе сложной структуры (рендеринг шаблона, сериализация модели в JSON, ответ API). Используется парами: snapshot фиксирует факт, code review подтверждает легитимность обновлённого snapshot'а.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Когда snapshot подходит и когда нет</div>

    <div class="card">
      <h3>Подходит</h3>
      <ul class="bullets">
        <li>API-ответы с большой стабильной структурой (JSON Resource);</li>
        <li>Рендеринг HTML-писем;</li>
        <li>Сериализация сложных value-объектов в текст;</li>
        <li>Конфигурационные дампы.</li>
      </ul>
    </div>

    <div class="card">
      <h3>Не подходит</h3>
      <ul class="bullets">
        <li>Бизнес-логика с конкретными правилами (snapshot не объясняет, <em>что именно</em> правильно);</li>
        <li>Выход с временными метками или случайными ID без нормализации;</li>
        <li>Очень нестабильный вывод (UI с динамической компоновкой);</li>
        <li>Когда «обновить snapshot» становится автоматическим жестом &mdash; теряется смысл фиксации.</li>
      </ul>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: snapshot API-ответа</div>

<pre><code><span class="c-comment">// composer require --dev spatie/phpunit-snapshot-assertions</span>

<span class="c-key">use</span> <span class="c-type">Spatie\Snapshots\MatchesSnapshots</span>;

<span class="c-key">final class</span> <span class="c-type">ProductApiTest</span> <span class="c-key">extends</span> <span class="c-type">TestCase</span>
{
    <span class="c-key">use</span> <span class="c-type">MatchesSnapshots</span>;

    <span class="c-key">public function</span> <span class="c-fn">test_product_show_response_shape</span>(): <span class="c-key">void</span>
    {
        <span class="c-var">$product</span> = <span class="c-type">Product</span>::<span class="c-fn">factory</span>()-&gt;<span class="c-fn">create</span>([
            <span class="c-str">'id'</span>         =&gt; <span class="c-num">42</span>,
            <span class="c-str">'name'</span>       =&gt; <span class="c-str">'Test SKU'</span>,
            <span class="c-str">'created_at'</span> =&gt; <span class="c-str">'2026-01-01 00:00:00'</span>,
        ]);

        <span class="c-var">$response</span> = <span class="c-var">$this</span>-&gt;<span class="c-fn">getJson</span>(<span class="c-str">"/api/products/{$product-&gt;id}"</span>);

        <span class="c-var">$this</span>-&gt;<span class="c-fn">assertMatchesJsonSnapshot</span>(<span class="c-var">$response</span>-&gt;<span class="c-fn">json</span>());
    }
}
</code></pre>

    <p class="text">Первый прогон создаёт файл <code>__snapshots__/ProductApiTest__test_product_show_response_shape.json</code>. Последующие сравнивают &mdash; любое отклонение валит тест. Если изменение легитимно (новое поле в ответе) &mdash; обновить snapshot командой: <code>vendor/bin/phpunit -d --update-snapshots</code> и зафиксировать в коммите.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall">
      <strong>1. Snapshot с временными метками.</strong> Если ответ содержит <code>created_at</code> от <code>now()</code> &mdash; snapshot будет валиться при каждом прогоне. Нормализуйте через <code>$this-&gt;travelTo(specific)</code> или замените временные значения placeholder'ом перед assert.
    </div>
    <div class="pitfall">
      <strong>2. Бездумное «update».</strong> Когда «обновить snapshot» становится привычкой при каждом красном тесте, snapshot перестаёт что-либо защищать. Обновление snapshot'а &mdash; <em>обязательная</em> позиция для code review.
    </div>
    <div class="pitfall">
      <strong>3. Размер snapshot'а.</strong> Snapshot на 800 строк &mdash; нечитаемый. Дробите на несколько меньших, проверяющих отдельные части ответа.
    </div>
    <div class="pitfall">
      <strong>4. Snapshot не на JSON.</strong> Текстовые snapshot'ы (например, HTML письма) ловят пробелы, переносы строк. Изменение шаблона из-за форматирования рушит snapshot, хотя суть не изменилась. Нормализуйте whitespace перед сравнением.
    </div>
    <div class="pitfall">
      <strong>5. Snapshot для бизнес-правила.</strong> Snapshot {<code>discount: 15</code>} не объясняет, <em>почему</em> скидка 15. Бизнес-правила тестируются явными assert'ами: <code>$this-&gt;assertSame(15, $price-&gt;discount(), 'New customer 15% rule')</code>.
    </div>
    <div class="pitfall">
      <strong>6. Snapshot в локали.</strong> Если ответ зависит от <code>App::setLocale</code>, snapshot, снятый в <code>en</code>, не пройдёт под <code>ru</code>. Фиксируйте локаль в setUp.
    </div>
    <div class="pitfall">
      <strong>7. Snapshot и factories с случайными значениями.</strong> Если <code>Product::factory()</code> создаёт случайное имя, snapshot будет уникальным каждый прогон. Указывайте детерминированные значения для каждого тестируемого поля.
    </div>
    <div class="pitfall">
      <strong>8. Snapshot вместо contract test.</strong> Snapshot для публичного API проверяет совместимость с самим собой. Если внешний потребитель ожидает определённую структуру, snapshot не защитит от изменений в его сторону. Используйте OpenAPI-валидацию или contract tests.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PRACTICE — миграция legacy
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-practice" class="section">
  <div class="section-title">Практика: миграция legacy-модуля на тестируемый код</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> Постановка</div>
    <p class="text">Дано: модуль <code>InvoiceGenerator</code>, написанный одним статическим методом, который читает заказ из БД, считает налоги по сложной таблице, генерирует PDF, отправляет письмо, пишет аудит-лог. Покрыто двумя feature-тестами, дающими 22% line coverage. Любая правка ломает один из них непредсказуемо. Задача &mdash; пошагово привести к тестируемому виду.</p>

<pre><code><span class="c-comment">// Исходник: всё в одном методе, ничего не тестируется отдельно.</span>
<span class="c-key">final class</span> <span class="c-type">InvoiceGenerator</span>
{
    <span class="c-key">public static function</span> <span class="c-fn">generate</span>(<span class="c-key">int</span> <span class="c-var">$orderId</span>): <span class="c-key">string</span>
    {
        <span class="c-var">$order</span> = <span class="c-type">DB</span>::<span class="c-fn">table</span>(<span class="c-str">'orders'</span>)-&gt;<span class="c-fn">find</span>(<span class="c-var">$orderId</span>);
        <span class="c-var">$tax</span> = <span class="c-num">0</span>;
        <span class="c-key">if</span> (<span class="c-var">$order</span>-&gt;<span class="c-var">country</span> === <span class="c-str">'KZ'</span>) <span class="c-var">$tax</span> = <span class="c-var">$order</span>-&gt;<span class="c-var">total</span> * <span class="c-num">0.12</span>;
        <span class="c-key">elseif</span> (<span class="c-var">$order</span>-&gt;<span class="c-var">country</span> === <span class="c-str">'DE'</span>) <span class="c-var">$tax</span> = <span class="c-var">$order</span>-&gt;<span class="c-var">total</span> * <span class="c-num">0.19</span>;
        <span class="c-comment">// ... ещё 18 стран ...</span>

        <span class="c-var">$pdf</span> = (<span class="c-key">new</span> <span class="c-type">Dompdf</span>())-&gt;<span class="c-fn">loadHtml</span>(<span class="c-fn">view</span>(<span class="c-str">'invoices.show'</span>, <span class="c-fn">compact</span>(<span class="c-str">'order'</span>, <span class="c-str">'tax'</span>))-&gt;<span class="c-fn">render</span>());
        <span class="c-var">$pdf</span>-&gt;<span class="c-fn">render</span>();
        <span class="c-var">$path</span> = <span class="c-fn">storage_path</span>(<span class="c-str">"invoices/{$orderId}.pdf"</span>);
        <span class="c-fn">file_put_contents</span>(<span class="c-var">$path</span>, <span class="c-var">$pdf</span>-&gt;<span class="c-fn">output</span>());

        <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$order</span>-&gt;<span class="c-var">email</span>)-&gt;<span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">InvoiceMail</span>(<span class="c-var">$path</span>));
        <span class="c-type">DB</span>::<span class="c-fn">table</span>(<span class="c-str">'audit'</span>)-&gt;<span class="c-fn">insert</span>([<span class="c-str">'action'</span> =&gt; <span class="c-str">'invoice'</span>, <span class="c-str">'order_id'</span> =&gt; <span class="c-var">$orderId</span>]);

        <span class="c-key">return</span> <span class="c-var">$path</span>;
    }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Шаги рефакторинга</div>

    <div class="card">
      <h3>Шаг 1: characterization test</h3>
      <p class="text">До любого рефакторинга &mdash; покрываем существующее поведение «как есть». Это <em>characterization test</em>: цель &mdash; не доказать правильность, а зафиксировать текущее поведение, чтобы рефакторинг ничего не сломал. Пишем feature-тест на <code>InvoiceGenerator::generate(...)</code> для 3-4 типичных стран и проверяем выходной PDF (через хеш) и факт письма.</p>
    </div>

    <div class="card">
      <h3>Шаг 2: извлечь расчёт налога</h3>
      <p class="text">Налоговая таблица &mdash; чистая функция: страна и сумма &rarr; налог. Извлекаем в отдельный класс <code>TaxCalculator</code> с одним публичным методом <code>calculate(string $country, int $totalMinor): int</code>. Пишем unit-тесты на каждую страну. Этот блок тестируется без БД, моков, файлов &mdash; быстро и точно.</p>
    </div>

    <div class="card">
      <h3>Шаг 3: ввести контракты на инфраструктуру</h3>
      <p class="text">PDF-генерация, отправка письма, аудит-лог &mdash; каждый получает контракт: <code>PdfRenderer</code>, <code>InvoiceMailer</code>, <code>AuditLogger</code>. <code>InvoiceGenerator</code> принимает их в конструктор. Static-метод превращается в обычный, регистрируется в контейнере. Существующие feature-тесты остаются зелёными (DI прозрачен для них).</p>
    </div>

    <div class="card">
      <h3>Шаг 4: написать unit-тесты на оркестрацию</h3>
      <p class="text">Теперь <code>InvoiceGenerator</code> тестируется с моками своих коллабораторов: <code>TaxCalculator</code> вернёт фиксированное значение (stub), <code>PdfRenderer</code> подменён fake'ом, который пишет в memory, <code>InvoiceMailer</code> &mdash; mock с ожиданием <code>send</code>. Каждый тест проверяет конкретное взаимодействие.</p>
    </div>

    <div class="card">
      <h3>Шаг 5: удалить «лишние» feature-тесты</h3>
      <p class="text">Часть characterization-тестов из шага 1 теперь дублирует unit-тесты с шага 2-4. Удаляем дублирующие, оставляем 1-2 широких feature-теста как «smoke»: проверка, что вся цепочка собирается и работает на реальных коллабораторах. Сюта становится быстрее, тесты точечнее.</p>
    </div>

    <div class="card">
      <h3>Шаг 6: mutation testing</h3>
      <p class="text">Запускаем Infection на <code>app/Invoices</code>. Survived мутации указывают на оставшиеся «дыры»: например, <code>$totalMinor * 0.12</code> &harr; <code>$totalMinor + 0.12</code> &mdash; если survived, значит наш тест проверяет «вернуть какое-то число», а не «правильный налог». Добавляем точечные assert'ы.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle-2"></i> Результат</div>
    <ul class="bullets">
      <li>До: 2 медленных feature-теста, 22% line coverage, любая правка &mdash; рулетка;</li>
      <li>После: 24 unit-теста (мгновенные), 3 feature-теста (smoke), 86% line coverage, 78% mutation score;</li>
      <li>Время рефакторинга &mdash; ~4-6 часов; экономия времени поддержки &mdash; десятки часов в год.</li>
    </ul>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PITFALLS — сводный дайджест
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-pitfalls" class="section">
  <div class="section-title">Сводные подводные камни тестирования</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Топ ошибок в реальных сюитах</div>

    <div class="pitfall">
      <strong>1. Тестирование реализации, а не поведения.</strong> Тест, опирающийся на конкретные приватные методы или последовательность вызовов внутри класса, ломается при безопасном рефакторинге. Тестируйте через публичный API и результат.
    </div>
    <div class="pitfall">
      <strong>2. Флакающие тесты в режиме «retry до зелёного».</strong> CI с настройкой «прогнать упавший тест 3 раза» прячет реальные баги. Флак &mdash; это всегда сигнал недетерминизма (время, порядок, race), который проявится в проде. Чините, не маскируйте.
    </div>
    <div class="pitfall">
      <strong>3. Тесты, повторяющие логику.</strong> Если в тесте вычисляется ожидаемое значение той же формулой, что в продукте &mdash; тест проверяет, что формула вернёт сама себя. Жёстко прописывайте ожидаемые значения, не вычисляйте.
    </div>
    <div class="pitfall">
      <strong>4. <code>assertTrue(condition)</code> вместо специфичных assert'ов.</strong> Сообщение «expected true, got false» бесполезно. Используйте <code>assertSame</code>, <code>assertEquals</code>, <code>assertCount</code>, <code>assertDatabaseHas</code> &mdash; они дают понятное диагностическое сообщение при падении.
    </div>
    <div class="pitfall">
      <strong>5. Скрытые зависимости через глобальное состояние.</strong> Тест случайно опирается на конфиг, переменную окружения, кэш, оставленные предыдущим тестом. На CI с другим порядком &mdash; падает. Делайте тесты гермитичными.
    </div>
    <div class="pitfall">
      <strong>6. Огромные фабрики «на все случаи».</strong> <code>Order::factory()</code> создаёт заказ с 20 связанными моделями &laquo;на всякий случай&raquo;. 80% тестов используют только заказ, но получают целое дерево. Делайте минимальные фабрики и наращивайте через states (<code>->withPayments()</code>, <code>->withItems()</code>).
    </div>
    <div class="pitfall">
      <strong>7. Тест зависит от значения по умолчанию из <code>.env</code>.</strong> Тест проходит локально (где <code>APP_DEBUG=true</code>) и падает в CI (где <code>false</code>). Зафиксируйте критичные настройки в <code>phpunit.xml</code> &mdash; они переопределят окружение.
    </div>
    <div class="pitfall">
      <strong>8. Параллельный запуск без проверки.</strong> Сюита проходит последовательно и падает параллельно &mdash; есть скрытые зависимости через FS, Redis, БД. Лечится не отключением <code>--parallel</code>, а изоляцией состояний.
    </div>
    <div class="pitfall">
      <strong>9. Логика в <code>setUp</code>, отличающаяся между тестами.</strong> Большой <code>setUp</code> с ветвлениями по типу теста &mdash; запах. Каждый тест должен явно объявлять свой Arrange; общее &mdash; через помощники, не через ветвящийся setUp.
    </div>
    <div class="pitfall">
      <strong>10. Тесты только на happy path.</strong> Сюта проверяет 5 «правильных» сценариев и игнорирует ошибки, граничные значения, конкуренцию. На код вида <code>if ($x &gt; 0)</code> должно быть как минимум 3 теста: меньше, ровно, больше.
    </div>
    <div class="pitfall">
      <strong>11. Coverage без mutation testing.</strong> 90% line coverage и 30% mutation score &mdash; типичная картина: тесты «трогают» код, но не проверяют его. Сочетайте метрики.
    </div>
    <div class="pitfall">
      <strong>12. E2E как способ покрыть всё.</strong> Selenium-тест на «оформление заказа» проходит, и команда считает оформление покрытым. На самом деле сценарий проверен один; остальные 19 граничных случаев не покрыты. E2E дополняет, не заменяет.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     INTERVIEW
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-interview" class="section">
  <div class="section-title">Вопросы на собеседование (middle / senior)</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="users"></i> Test doubles и дизайн</div>

    <div class="card">
      <h3>1. Чем mock отличается от stub'а?</h3>
      <p class="text"><strong>Stub</strong> возвращает заранее настроенные значения на вызовы &mdash; используется, чтобы подать тестируемому коду нужные входные данные. <strong>Mock</strong> заранее объявляет ожидания (какие методы будут вызваны, с какими аргументами, сколько раз) &mdash; используется, чтобы проверить протокол взаимодействия. Тесты со stub'ами устойчивее к рефакторингу; тесты с моками строже, но хрупче.</p>
    </div>

    <div class="card">
      <h3>2. Когда уместен fake вместо mock'а?</h3>
      <p class="text">Когда нужно реалистичное поведение коллаборатора (in-memory репозиторий, который сохраняет и читает данные), но без побочек реальной реализации. Fake позволяет писать <strong>state-based</strong> тесты: проверять итоговое состояние, а не цепочку вызовов. Это устойчивее к изменениям внутренней реализации &mdash; пока контракт fake'а соответствует продакшен-реализации.</p>
    </div>

    <div class="card">
      <h3>3. Что такое over-mocking и чем он опасен?</h3>
      <p class="text>Когда тест мокает почти всех коллабораторов класса, он перестаёт проверять поведение и начинает проверять внутреннюю структуру. Любой рефакторинг &mdash; перемещение вызова, объединение методов, изменение порядка &mdash; ломает тест, хотя видимое поведение не изменилось. Команда начинает избегать рефакторинга, код деградирует.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> Laravel: БД и параллельность</div>

    <div class="card">
      <h3>4. Когда выбрать <code>DatabaseMigrations</code> вместо <code>RefreshDatabase</code>?</h3>
      <p class="text">Когда тестируемый код выполняет <strong>собственный DDL</strong> (например, динамически создаёт таблицы), либо когда код управляет верхнеуровневыми транзакциями (<code>DB::beginTransaction</code>/<code>commit</code>), которые конфликтуют с обёртывающей транзакцией от <code>RefreshDatabase</code>. В остальных случаях <code>RefreshDatabase</code> предпочтителен из-за скорости.</p>
    </div>

    <div class="card">
      <h3>5. Как Laravel изолирует БД при параллельных тестах?</h3>
      <p class="text">При <code>--parallel</code> Laravel создаёт N копий тестовой БД с суффиксом <code>_test_{token}</code>, где <code>{token}</code> &mdash; идентификатор процесса. Каждый процесс получает свою копию через <code>ParallelTesting::resolveDatabaseTokenUsing</code>. Миграции прогоняются для каждой копии независимо. Изоляция Redis, кеша, файловой системы делается через хуки <code>ParallelTesting::setUpProcess</code>.</p>
    </div>

    <div class="card">
      <h3>6. Почему SQLite in-memory может давать ложно зелёную сюту?</h3>
      <p class="text">SQLite поддерживает не все фичи реального MySQL/Postgres: иначе работают CHECK-ограничения, UNIQUE с NULL, FULLTEXT отсутствует, нет array/jsonb типов, autoincrement начинается с нуля. Тест, проходящий на SQLite, может падать на проде. Поэтому SQLite уместен как «быстрый смоук», но реальная сюта должна периодически прогоняться на боевом движке.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="clock"></i> Детерминизм</div>

    <div class="card">
      <h3>7. Как зафиксировать время в тесте и что это не покроет?</h3>
      <p class="text"><code>$this-&gt;travelTo($specific)</code> или <code>Carbon::setTestNow()</code> подменяют PHP-уровень: <code>now()</code>, <code>Carbon::now()</code>, Eloquent timestamps через <code>updated_at</code>. Не покрывает: SQL <code>DEFAULT CURRENT_TIMESTAMP</code> &mdash; БД берёт реальное время. Решение &mdash; заполнять временные поля явно через <code>now()</code> в фабриках или коде.</p>
    </div>

    <div class="card">
      <h3>8. В чём разница между <code>Queue::fake()</code> и <code>QUEUE_CONNECTION=sync</code>?</h3>
      <p class="text"><code>Queue::fake()</code> &mdash; задания регистрируются, но <strong>не исполняются</strong>; тест проверяет факт постановки. <code>sync</code> &mdash; задание исполняется немедленно в текущем процессе; тест проверяет побочные эффекты исполнения. Выбор зависит от уровня изоляции: fake для тестов на бизнес-логику с очередью, sync &mdash; для интеграционного тестирования всей цепочки.</p>
    </div>

    <div class="card">
      <h3>9. Что делает <code>Http::preventStrayRequests()</code> и зачем включать в базовом TestCase?</h3>
      <p class="text">Любой HTTP-запрос в тесте, не покрытый <code>Http::fake</code>, бросит исключение. Без этого &laquo;забытый&raquo; внешний вызов уйдёт в реальный API на CI &mdash; медленно, ненадёжно, иногда дорого. Включение в базовом TestCase делает строгий режим по умолчанию для всей сюты.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="bug"></i> Качество тестов</div>

    <div class="card">
      <h3>10. Чем mutation testing полезнее coverage?</h3>
      <p class="text">Coverage показывает, исполнялся ли код во время тестов &mdash; это слабая метрика, легко обманывается тестами без assert'ов. Mutation testing меняет код мелкими шагами и проверяет, ловит ли это сюта &mdash; даёт прямую метрику «насколько тесты реально проверяют поведение». 100% coverage и 30% mutation score &mdash; типичная картина «есть тесты, проверяющие мало».</p>
    </div>

    <div class="card">
      <h3>11. Когда snapshot-тестирование уместно, а когда нет?</h3>
      <p class="text"><strong>Уместно</strong>: API-ответы с большой стабильной структурой, HTML-письма, сериализация сложных value-объектов &mdash; всё, что не нужно проверять побитово, а важна стабильность вывода. <strong>Не уместно</strong>: бизнес-правила, где важно <em>почему</em> результат именно такой; нестабильный вывод (UI, временные метки без нормализации); ситуации, где «обновить snapshot» превращается в рефлекс.</p>
    </div>

    <div class="card">
      <h3>12. Объясните разницу между line coverage и branch coverage.</h3>
      <p class="text><strong>Line coverage</strong> &mdash; доля строк, исполненных тестами хотя бы раз. <strong>Branch coverage</strong> &mdash; доля ветвей условий (true/false), пройденных тестами. Для <code>if ($a &amp;&amp; $b)</code> line coverage 100% достигается одним вызовом; branch coverage требует пройти и истинную, и ложную ветвь. Branch строже, но всё ещё не покрывает все комбинации условий внутри составного выражения.</p>
    </div>

    <div class="card">
      <h3>13. Что такое characterization test и когда он применяется?</h3>
      <p class="text">Тест, фиксирующий <strong>текущее</strong> поведение системы &laquo;как есть&raquo;, без суждения о правильности. Применяется перед рефакторингом legacy-кода: покрываем существующее поведение, потом меняем структуру; если тесты падают &mdash; значит поведение изменилось, и нужно либо вернуть, либо подтвердить осознанное изменение. Термин из книги Michael Feathers «Working Effectively with Legacy Code».</p>
    </div>

    <div class="card">
      <h3>14. Что такое ice-cream cone в тестировании?</h3>
      <p class="text">Перевёрнутая пирамида тестов: много медленных E2E, мало быстрых unit'ов. Симптом архитектуры с сильной связанностью &mdash; «unit-тесты невозможно написать, потому что всё связано со всем». Бьёт по скорости feedback'а и стоимости поддержки. Лечится не дополнительными E2E, а рефакторингом архитектуры в сторону извлечения тестируемых модулей.</p>
    </div>

    <div class="card">
      <h3>15. Как тестировать код с retry и timeout?</h3>
      <p class="text">Retry: <code>Http::fake</code> с <code>sequence</code> &mdash; первая попытка возвращает 5xx, вторая успех. Тест проверяет финальный результат и количество попыток через <code>Http::assertSentCount(2)</code>. Timeout: подменить HTTP-клиента на тот, который выбрасывает <code>ConnectionException</code>, и проверить, что код корректно реагирует (логирует, возвращает fallback). Тестирование реальных timeout'ов через ожидание времени &mdash; антипаттерн; всегда подменяйте источник ошибки явно.</p>
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
