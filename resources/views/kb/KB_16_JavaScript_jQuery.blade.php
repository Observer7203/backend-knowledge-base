@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>JavaScript + jQuery — база</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
  --bg:#F5F8FA;--surface:#FFFFFF;--border:#E4E6EF;--text:#181C32;--text2:#7E8299;--text3:#A1A5B7;
  --primary:#404357;--primary-light:#EFF2F5;
  --success:#50CD89;--success-light:#E8FFF3;--success-dark:#0D7D53;
  --warning:#FFC700;--warning-light:#FFF8DD;--warning-dark:#B45309;
  --danger:#F1416C;--danger-light:#FFF5F8;
  --info:#009EF7;--info-light:#EEF7FF;
  --shadow:0 2px 10px rgba(24,28,50,0.07);--radius:10px;
  --code-bg:#1E1E2D;--code-border:#2D3347;
}
*{margin:0;padding:0;box-sizing:border-box;}
body{background:var(--bg);color:var(--text);font-family:'Inter',-apple-system,sans-serif;font-size:14px;line-height:1.6;-webkit-font-smoothing:antialiased;}
.container{width:100%;display:grid;grid-template-columns:260px 1fr;min-height:100vh;}
.sidebar{background:var(--surface);padding:24px 14px;position:fixed;width:260px;height:100vh;overflow-y:auto;border-right:1px solid var(--border);}
.sidebar-back{display:flex;align-items:center;gap:7px;padding:8px 10px;margin-bottom:14px;color:var(--primary);text-decoration:none;border-radius:7px;font-size:12px;font-weight:600;transition:background 0.2s;}
.sidebar-back:hover{background:var(--primary-light);}
.sidebar-title{font-size:11px;font-weight:800;color:var(--text3);text-transform:uppercase;letter-spacing:1.2px;margin-bottom:10px;padding-bottom:12px;border-bottom:1px solid var(--border);}
.nav-group-label{font-size:10px;font-weight:700;color:var(--text3);text-transform:uppercase;letter-spacing:0.8px;padding:10px 12px 4px;}
.nav-item{display:flex;align-items:center;gap:8px;padding:8px 12px;margin-bottom:2px;color:var(--text2);text-decoration:none;border-radius:8px;cursor:pointer;transition:all 0.18s;font-size:13px;font-weight:500;border:1px solid transparent;}
.nav-item:hover{background:var(--bg);color:var(--primary);border-color:var(--border);}
.nav-item.active{background:var(--primary-light);color:var(--primary);font-weight:600;border-color:rgba(64,67,87,0.25);}
.main{margin-left:260px;padding:40px 48px;min-width:0;width:calc(100vw - 260px);}
.page-header{margin-bottom:32px;padding-bottom:24px;border-bottom:1px solid var(--border);}
.page-header h1{font-size:26px;font-weight:800;margin-bottom:8px;letter-spacing:-0.3px;}
.page-header p{color:var(--text2);font-size:14px;}
.badge-row{display:flex;gap:8px;flex-wrap:wrap;margin-top:12px;}
.badge{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;background:#EFF2F5;color:#5E6278;}
.badge-warning{background:var(--warning-light);color:var(--warning-dark);}
.badge-info{background:var(--info-light);color:var(--info);}
.badge-success{background:var(--success-light);color:var(--success-dark);}
.section{display:none;animation:fadeIn 0.25s ease;}
.section.active{display:block;}
@keyframes fadeIn{from{opacity:0;transform:translateY(4px);}to{opacity:1;transform:none;}}
.section-title{font-size:20px;font-weight:700;margin-bottom:24px;padding-bottom:14px;border-bottom:2px solid var(--border);display:flex;align-items:center;gap:10px;}
.section-title::before{content:'';width:4px;height:22px;background:var(--primary);border-radius:2px;flex-shrink:0;}
.subsection{margin-bottom:36px;}
.subsection-title{font-size:15px;font-weight:700;color:var(--text);margin-bottom:14px;}
p.text{color:var(--text2);line-height:1.8;margin-bottom:12px;}
p.text strong{color:var(--text);font-weight:600;}
pre{background:var(--code-bg);border:1px solid var(--code-border);border-radius:8px;padding:16px 18px;overflow-x:auto;margin:10px 0 16px;color:#E4E6EF;font-family:'SF Mono',Menlo,Monaco,monospace;font-size:12.5px;line-height:1.55;}
pre .c-key{color:#c084fc;} pre .c-str{color:#a5f3a2;} pre .c-num{color:#fbbf24;}
pre .c-comment{color:#7e8299;font-style:italic;} pre .c-fn{color:#60a5fa;}
pre .c-var{color:#e4e6ef;} pre .c-type{color:#5eead4;}
code{color:#1E40AF;padding:1px 4px;border-radius:4px;font-family:'SF Mono',monospace;font-size:12.5px;background:rgba(29,78,216,0.08);}
pre code{background:transparent;color:inherit;padding:0;border-radius:0;font-size:inherit;}
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:16px 18px;margin-bottom:12px;}
.card h3{font-size:13.5px;font-weight:700;margin-bottom:6px;}
.card p{color:var(--text2);font-size:13px;line-height:1.65;}
.data-table{width:100%;border-collapse:collapse;margin:12px 0 18px;background:var(--surface);border-radius:6px;overflow:hidden;font-size:13px;}
.data-table th{background:#F3F4F6;color:#1F2937;text-align:left;padding:9px 12px;border-bottom:2px solid #D1D5DB;font-weight:700;font-size:12.5px;}
.data-table td{padding:8px 12px;border-bottom:1px solid #E5E7EB;color:#374151;vertical-align:top;line-height:1.5;}
.data-table tr:hover td{background:#F9FAFB;}
.data-table code{background:#EFF6FF;color:#1D4ED8;padding:1px 5px;border-radius:3px;font-size:11.5px;}
.remember-box{background:linear-gradient(135deg,#FFF8DD,#FEF3C7);border-left:4px solid var(--warning);padding:14px 18px;border-radius:6px;margin:14px 0;color:#78350F;font-size:13.5px;}
.remember-box strong{color:#78350F;font-weight:700;}
.pitfall{background:var(--danger-light);border-left:3px solid var(--danger);padding:12px 16px;border-radius:4px;margin:12px 0;color:#7F1D1D;font-size:13px;}
.pitfall strong{color:#991B1B;}
.tip{background:var(--info-light);border-left:3px solid var(--info);padding:12px 16px;border-radius:4px;margin:12px 0;color:#075985;font-size:13px;}

@media (max-width:900px){
  .container{display:block;grid-template-columns:1fr;}
  .sidebar{position:static;width:100%;height:auto;max-height:280px;border-right:none;border-bottom:1px solid var(--border);}
  .main{margin-left:0;width:100%;padding:24px 18px;}
}
</style>
</head>
<body>
<div class="container">

<div class="sidebar">
  <a href="/" class="sidebar-back">← На главную</a>
  <div class="sidebar-title">JavaScript + jQuery</div>

  <a class="nav-item active" onclick="showSection('overview',this)"> Обзор</a>

  <div class="nav-group-label">JavaScript база</div>
  <a class="nav-item" onclick="showSection('js-types',this)">Типы, var/let/const</a>
  <a class="nav-item" onclick="showSection('js-operators',this)">Операторы, == vs ===</a>
  <a class="nav-item" onclick="showSection('js-operators-full',this)">Все операторы (таблица)</a>
  <a class="nav-item" onclick="showSection('js-keywords',this)">Ключевые слова / команды</a>
  <a class="nav-item" onclick="showSection('js-control',this)">if / switch / циклы</a>
  <a class="nav-item" onclick="showSection('js-functions',this)">Функции + arrow fn</a>
  <a class="nav-item" onclick="showSection('js-arrays',this)">Массивы + методы</a>
  <a class="nav-item" onclick="showSection('js-objects',this)">Объекты + destructuring</a>
  <a class="nav-item" onclick="showSection('js-dom',this)">DOM manipulation</a>
  <a class="nav-item" onclick="showSection('js-events',this)">Events + форма</a>
  <a class="nav-item" onclick="showSection('js-async',this)">Async: Promise / async-await</a>
  <a class="nav-item" onclick="showSection('js-fetch',this)">Fetch / AJAX</a>
  <a class="nav-item" onclick="showSection('js-json',this)">JSON.parse / JSON.stringify</a>

  <div class="nav-group-label">jQuery база</div>
  <a class="nav-item" onclick="showSection('jq-intro',this)">Что такое, актуальность</a>
  <a class="nav-item" onclick="showSection('jq-selectors',this)">Selectors</a>
  <a class="nav-item" onclick="showSection('jq-dom',this)">DOM: html/text/val/append</a>
  <a class="nav-item" onclick="showSection('jq-css',this)">CSS / classes</a>
  <a class="nav-item" onclick="showSection('jq-events',this)">Events + delegated</a>
  <a class="nav-item" onclick="showSection('jq-ajax',this)">$.get / $.post / $.ajax</a>
  <a class="nav-item" onclick="showSection('jq-vs-js',this)">jQuery vs vanilla JS</a>

  <div class="nav-group-label">Интеграция с PHP</div>
  <a class="nav-item" onclick="showSection('php-form',this)">Форма → PHP (без AJAX)</a>
  <a class="nav-item" onclick="showSection('php-fetch',this)">Fetch → PHP → JSON</a>
  <a class="nav-item" onclick="showSection('php-jquery',this)">jQuery AJAX → PHP</a>
  <a class="nav-item" onclick="showSection('php-upload',this)">Загрузка файлов</a>
  <a class="nav-item" onclick="showSection('php-embed',this)">PHP → JS (передача данных)</a>
  <a class="nav-item" onclick="showSection('php-csrf',this)">CSRF без Laravel</a>

  <div class="nav-group-label">Интеграция с Laravel</div>
  <a class="nav-item" onclick="showSection('fs-ajax-laravel',this)">jQuery AJAX ↔ Laravel</a>
  <a class="nav-item" onclick="showSection('fs-csrf',this)">CSRF token в AJAX</a>
  <a class="nav-item" onclick="showSection('fs-interview',this)">Частые вопросы</a>
</div>

<div class="main">
  <div class="page-header">
    <h1>JavaScript + jQuery — база</h1>
    <p>Базовые конструкции JS и jQuery. Advanced (React, TypeScript) в этот раздел не входит.</p>
    <div class="badge-row">
      <span class="badge badge-info">JS ES6+</span>
      <span class="badge">jQuery 3.x</span>
      <span class="badge badge-success">Laravel интеграция</span>
    </div>
  </div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-overview" class="section active">
  <div class="section-title">Обзор</div>

  <div class="subsection">
    <p class="text">
      Раздел покрывает базовые конструкции <strong>JavaScript</strong> и <strong>jQuery</strong> которые нужны для работы
      с фронтом Laravel-проектов. Advanced-темы (React, TypeScript, генераторы, worker'ы, service worker) намеренно вынесены за рамки.
    </p>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Ключевые темы раздела</h3>
    <table class="data-table">
      <thead><tr><th>Тема</th><th>Раздел</th></tr></thead>
      <tbody>
        <tr><td><code>var</code> vs <code>let</code> vs <code>const</code></td><td>Типы</td></tr>
        <tr><td><code>==</code> vs <code>===</code></td><td>Операторы</td></tr>
        <tr><td>Function declaration vs arrow function</td><td>Функции</td></tr>
        <tr><td><code>this</code> в arrow vs обычной</td><td>Функции</td></tr>
        <tr><td>Array methods: <code>map/filter/reduce/forEach</code></td><td>Массивы</td></tr>
        <tr><td>Destructuring + spread</td><td>Объекты</td></tr>
        <tr><td><code>querySelector</code> + <code>addEventListener</code></td><td>DOM/Events</td></tr>
        <tr><td>Promise / async-await</td><td>Async</td></tr>
        <tr><td>fetch API / AJAX</td><td>Fetch</td></tr>
        <tr><td>jQuery <code>$(...)</code> selectors</td><td>jQuery</td></tr>
        <tr><td>jQuery events + delegated</td><td>jQuery</td></tr>
        <tr><td><code>$.ajax</code> / <code>$.post</code></td><td>jQuery AJAX</td></tr>
        <tr><td>CSRF token в Laravel AJAX</td><td>Интеграция</td></tr>
      </tbody>
    </table>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-js-types" class="section">
  <div class="section-title">JavaScript: типы, var / let / const</div>

  <div class="subsection">
    <h3 class="subsection-title">Примитивы (7 типов) + Object</h3>
    <table class="data-table">
      <thead><tr><th>Тип</th><th>Пример</th><th>typeof</th></tr></thead>
      <tbody>
        <tr><td>number</td><td><code>42</code>, <code>3.14</code>, <code>NaN</code>, <code>Infinity</code></td><td><code>'number'</code></td></tr>
        <tr><td>bigint</td><td><code>9007199254740992n</code></td><td><code>'bigint'</code></td></tr>
        <tr><td>string</td><td><code>'hello'</code>, <code>"a"</code>, <code>`template ${x}`</code></td><td><code>'string'</code></td></tr>
        <tr><td>boolean</td><td><code>true</code> / <code>false</code></td><td><code>'boolean'</code></td></tr>
        <tr><td>null</td><td><code>null</code></td><td><code>'object'</code> ← классический баг</td></tr>
        <tr><td>undefined</td><td><code>undefined</code></td><td><code>'undefined'</code></td></tr>
        <tr><td>symbol</td><td><code>Symbol('id')</code></td><td><code>'symbol'</code></td></tr>
        <tr><td>object</td><td><code>{}</code>, <code>[]</code>, <code>new Date()</code></td><td><code>'object'</code> / <code>'function'</code> для fn</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong>⚠ typeof null === 'object'</strong> — известный баг JS с 1995 года. Не исправят из соображений совместимости.</div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">var / let / const — главное отличие</h3>
    <table class="data-table">
      <thead><tr><th></th><th><code>var</code></th><th><code>let</code></th><th><code>const</code></th></tr></thead>
      <tbody>
        <tr><td>Область видимости</td><td>Функция (function scope)</td><td>Блок <code>{}</code> (block scope)</td><td>Блок <code>{}</code></td></tr>
        <tr><td>Hoisting</td><td>Да, с <code>undefined</code></td><td>Да, но TDZ (temporal dead zone) → ReferenceError</td><td>Да, но TDZ</td></tr>
        <tr><td>Переопределение</td><td>Можно</td><td>Нельзя в том же scope</td><td>Нельзя</td></tr>
        <tr><td>Переприсваивание</td><td>Можно</td><td>Можно</td><td>❌ Нельзя (но объекты можно мутировать!)</td></tr>
        <tr><td>Когда использовать</td><td>Никогда (legacy)</td><td>Если значение меняется</td><td>По умолчанию, всегда</td></tr>
      </tbody>
    </table>
    <pre><code><span class="c-comment">// Правило современного JS: const по умолчанию, let если реассигн, var никогда</span>
<span class="c-key">const</span> <span class="c-var">name</span> = <span class="c-str">'Alice'</span>;       <span class="c-comment">// не меняется</span>
<span class="c-key">let</span> <span class="c-var">counter</span> = <span class="c-num">0</span>;
<span class="c-var">counter</span>++;                     <span class="c-comment">// ok — let разрешает</span>

<span class="c-comment">// ⚠ const массив/объект — ссылка неизменяема, содержимое — можно менять!</span>
<span class="c-key">const</span> <span class="c-var">arr</span> = [<span class="c-num">1</span>, <span class="c-num">2</span>];
<span class="c-var">arr</span>.<span class="c-fn">push</span>(<span class="c-num">3</span>);                <span class="c-comment">// OK — мутация массива</span>
<span class="c-var">arr</span> = [<span class="c-num">4</span>, <span class="c-num">5</span>];              <span class="c-comment">// ❌ TypeError: Assignment to constant</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Truthy / Falsy — 6 значений false</h3>
    <pre><code><span class="c-comment">// Все эти → false в bool-контексте:</span>
<span class="c-key">false</span>, <span class="c-num">0</span>, <span class="c-num">-0</span>, <span class="c-num">0n</span>, <span class="c-str">""</span>, <span class="c-key">null</span>, <span class="c-key">undefined</span>, <span class="c-num">NaN</span>

<span class="c-comment">// Все остальные → true, включая ловушки:</span>
<span class="c-fn">Boolean</span>(<span class="c-str">'0'</span>);         <span class="c-comment">// true — строка "0" непустая!</span>
<span class="c-fn">Boolean</span>(<span class="c-str">'false'</span>);     <span class="c-comment">// true — строка "false" непустая</span>
<span class="c-fn">Boolean</span>([]);            <span class="c-comment">// true — пустой массив truthy (!)</span>
<span class="c-fn">Boolean</span>({});            <span class="c-comment">// true — пустой объект truthy (!)</span></code></pre>
    <div class="pitfall"><strong>⚠ Внимание PHP vs JS:</strong> в PHP <code>[]</code> falsy. В JS <code>[]</code> truthy. Часто путают.</div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-js-operators" class="section">
  <div class="section-title">JavaScript: операторы, == vs ===</div>

  <div class="subsection">
    <h3 class="subsection-title">Ключевое отличие: <code>==</code> vs <code>===</code></h3>
    <p class="text"><code>==</code> — loose (нестрогое), делает type coercion. <code>===</code> — strict, сравнение типа И значения. <strong>В production всегда <code>===</code></strong>.</p>
    <pre><code><span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-num">1</span> == <span class="c-str">'1'</span>);       <span class="c-comment">// true — строка приведена к числу</span>
<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-num">1</span> === <span class="c-str">'1'</span>);      <span class="c-comment">// false — разные типы</span>
<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-key">null</span> == <span class="c-key">undefined</span>);  <span class="c-comment">// true — специальный случай (только между собой!)</span>
<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-key">null</span> === <span class="c-key">undefined</span>); <span class="c-comment">// false — разные типы</span>
<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-key">NaN</span> === <span class="c-key">NaN</span>);        <span class="c-comment">// false — NaN не равен ничему, даже себе</span>
<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-fn">Number</span>.<span class="c-fn">isNaN</span>(<span class="c-key">NaN</span>));  <span class="c-comment">// true — правильная проверка NaN</span></code></pre>
    <div class="remember-box"><strong>Правило:</strong> всегда <code>===</code>. Единственное исключение — <code>value == null</code> для проверки одновременно на null И undefined (короткая запись).</div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Логические операторы (short-circuit)</h3>
    <pre><code><span class="c-comment">// &amp;&amp; возвращает первое falsy или последнее (не всегда bool!)</span>
<span class="c-str">'a'</span> &amp;&amp; <span class="c-str">'b'</span>;        <span class="c-comment">// 'b' — оба truthy → последнее</span>
<span class="c-num">0</span> &amp;&amp; <span class="c-str">'b'</span>;          <span class="c-comment">// 0 — первое falsy</span>

<span class="c-comment">// || возвращает первое truthy или последнее</span>
<span class="c-key">null</span> || <span class="c-str">'default'</span>; <span class="c-comment">// 'default'</span>
<span class="c-str">'a'</span> || <span class="c-str">'b'</span>;        <span class="c-comment">// 'a'</span>

<span class="c-comment">// ?? — Nullish Coalescing (ES2020) — только null/undefined, не falsy</span>
<span class="c-num">0</span> ?? <span class="c-num">10</span>;             <span class="c-comment">// 0 — 0 не null/undefined</span>
<span class="c-num">0</span> || <span class="c-num">10</span>;             <span class="c-comment">// 10 — 0 falsy</span>
<span class="c-key">null</span> ?? <span class="c-str">'default'</span>; <span class="c-comment">// 'default'</span>

<span class="c-comment">// ?. — Optional Chaining (ES2020) — короткая проверка null</span>
<span class="c-key">const</span> <span class="c-var">avatar</span> = <span class="c-var">user</span>?.<span class="c-var">profile</span>?.<span class="c-var">avatar</span>;  <span class="c-comment">// undefined если хоть где-то null</span></code></pre>
    <div class="tip">В PHP есть аналогичные <code>??</code> и <code>?-&gt;</code> — эти концепции одинаково работают.</div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Тернарный + spread + rest</h3>
    <pre><code><span class="c-comment">// Тернарный</span>
<span class="c-key">const</span> <span class="c-var">status</span> = <span class="c-var">age</span> &gt;= <span class="c-num">18</span> ? <span class="c-str">'adult'</span> : <span class="c-str">'minor'</span>;

<span class="c-comment">// Spread ... для массивов</span>
<span class="c-key">const</span> <span class="c-var">a</span> = [<span class="c-num">1</span>, <span class="c-num">2</span>];
<span class="c-key">const</span> <span class="c-var">b</span> = [...<span class="c-var">a</span>, <span class="c-num">3</span>, <span class="c-num">4</span>];      <span class="c-comment">// [1, 2, 3, 4]</span>

<span class="c-comment">// Spread ... для объектов</span>
<span class="c-key">const</span> <span class="c-var">user</span> = { <span class="c-var">name</span>: <span class="c-str">'Alice'</span> };
<span class="c-key">const</span> <span class="c-var">extended</span> = { ...<span class="c-var">user</span>, <span class="c-var">age</span>: <span class="c-num">30</span> };  <span class="c-comment">// { name:'Alice', age:30 }</span>

<span class="c-comment">// Rest ... в параметрах</span>
<span class="c-key">function</span> <span class="c-fn">sum</span>(...<span class="c-var">nums</span>) {         <span class="c-comment">// nums = [1,2,3,4]</span>
    <span class="c-key">return</span> <span class="c-var">nums</span>.<span class="c-fn">reduce</span>((<span class="c-var">a</span>, <span class="c-var">b</span>) =&gt; <span class="c-var">a</span> + <span class="c-var">b</span>, <span class="c-num">0</span>);
}
<span class="c-fn">sum</span>(<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>, <span class="c-num">4</span>);              <span class="c-comment">// 10</span></code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-js-operators-full" class="section">
  <div class="section-title">Все операторы (таблица)</div>

  <div class="subsection">
    <h3 class="subsection-title">Арифметические</h3>
    <table class="data-table">
      <thead><tr><th>Оператор</th><th>Что делает</th><th>Пример</th><th>Результат</th></tr></thead>
      <tbody>
        <tr><td><code>+</code></td><td>Сложение (или конкатенация строк)</td><td><code>5 + 3</code></td><td>8</td></tr>
        <tr><td><code>-</code></td><td>Вычитание</td><td><code>5 - 3</code></td><td>2</td></tr>
        <tr><td><code>*</code></td><td>Умножение</td><td><code>5 * 3</code></td><td>15</td></tr>
        <tr><td><code>/</code></td><td>Деление</td><td><code>10 / 3</code></td><td>3.333...</td></tr>
        <tr><td><code>%</code></td><td>Остаток от деления</td><td><code>10 % 3</code></td><td>1</td></tr>
        <tr><td><code>**</code></td><td>Возведение в степень</td><td><code>2 ** 8</code></td><td>256</td></tr>
        <tr><td><code>++</code></td><td>Инкремент (+1)</td><td><code>x++</code></td><td>x = x + 1</td></tr>
        <tr><td><code>--</code></td><td>Декремент (-1)</td><td><code>x--</code></td><td>x = x - 1</td></tr>
        <tr><td><code>+x</code></td><td>Приведение к числу</td><td><code>+"42"</code></td><td>42</td></tr>
        <tr><td><code>-x</code></td><td>Смена знака</td><td><code>-5</code></td><td>-5</td></tr>
      </tbody>
    </table>
    <div class="pitfall">
      <strong>⚠ <code>+</code> со строкой = конкатенация:</strong> <code>1 + "2"</code> = <code>"12"</code> (не 3). А <code>1 - "2"</code> = <code>-1</code> — минус приводит к числу.
    </div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Сравнения</h3>
    <table class="data-table">
      <thead><tr><th>Оператор</th><th>Значение</th><th>Пример</th></tr></thead>
      <tbody>
        <tr><td><code>==</code></td><td>Равно (loose, приводит типы)</td><td><code>1 == "1"</code> → true</td></tr>
        <tr><td><code>===</code></td><td>Строго равно (тип + значение)</td><td><code>1 === "1"</code> → false</td></tr>
        <tr><td><code>!=</code></td><td>Не равно (loose)</td><td><code>1 != "2"</code> → true</td></tr>
        <tr><td><code>!==</code></td><td>Строго не равно</td><td><code>1 !== "1"</code> → true</td></tr>
        <tr><td><code>&gt;</code>, <code>&lt;</code></td><td>Больше / меньше</td><td><code>5 &gt; 3</code> → true</td></tr>
        <tr><td><code>&gt;=</code>, <code>&lt;=</code></td><td>Больше/меньше или равно</td><td><code>5 &gt;= 5</code> → true</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Логические</h3>
    <table class="data-table">
      <thead><tr><th>Оператор</th><th>Значение</th><th>Пример</th></tr></thead>
      <tbody>
        <tr><td><code>&amp;&amp;</code></td><td>И — все true</td><td><code>a &amp;&amp; b</code></td></tr>
        <tr><td><code>||</code></td><td>ИЛИ — хотя бы один true</td><td><code>a || b</code></td></tr>
        <tr><td><code>!</code></td><td>НЕ — инверсия</td><td><code>!true</code> → false</td></tr>
        <tr><td><code>??</code></td><td>Nullish — дефолт только для null/undefined</td><td><code>val ?? "def"</code></td></tr>
        <tr><td><code>?.</code></td><td>Optional chaining — безопасный доступ</td><td><code>user?.profile?.name</code></td></tr>
        <tr><td><code>? :</code></td><td>Тернарный — короткий if/else</td><td><code>age &gt; 18 ? "adult" : "minor"</code></td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Присваивания</h3>
    <table class="data-table">
      <thead><tr><th>Оператор</th><th>Эквивалент</th></tr></thead>
      <tbody>
        <tr><td><code>x = 5</code></td><td>Простое присваивание</td></tr>
        <tr><td><code>x += 3</code></td><td><code>x = x + 3</code></td></tr>
        <tr><td><code>x -= 3</code></td><td><code>x = x - 3</code></td></tr>
        <tr><td><code>x *= 3</code></td><td><code>x = x * 3</code></td></tr>
        <tr><td><code>x /= 3</code></td><td><code>x = x / 3</code></td></tr>
        <tr><td><code>x %= 3</code></td><td><code>x = x % 3</code></td></tr>
        <tr><td><code>x **= 3</code></td><td><code>x = x ** 3</code></td></tr>
        <tr><td><code>x ||= y</code></td><td><code>x = x || y</code> (если x falsy)</td></tr>
        <tr><td><code>x &amp;&amp;= y</code></td><td><code>x = x &amp;&amp; y</code> (если x truthy)</td></tr>
        <tr><td><code>x ??= y</code></td><td><code>x = x ?? y</code> (если x null/undefined)</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Специальные</h3>
    <table class="data-table">
      <thead><tr><th>Оператор</th><th>Значение</th><th>Пример</th></tr></thead>
      <tbody>
        <tr><td><code>...</code></td><td>Spread / Rest</td><td><code>[...arr, 4]</code> / <code>function f(...args)</code></td></tr>
        <tr><td><code>,</code></td><td>Comma — вычисляет несколько, возвращает последнее</td><td><code>let x = (1, 2, 3);</code> → x=3</td></tr>
        <tr><td><code>typeof</code></td><td>Тип значения (строкой)</td><td><code>typeof 42</code> → <code>"number"</code></td></tr>
        <tr><td><code>instanceof</code></td><td>Является ли экземпляром класса</td><td><code>[] instanceof Array</code> → true</td></tr>
        <tr><td><code>in</code></td><td>Есть ли ключ в объекте</td><td><code>"name" in user</code> → bool</td></tr>
        <tr><td><code>delete</code></td><td>Удалить свойство объекта</td><td><code>delete obj.name</code></td></tr>
        <tr><td><code>new</code></td><td>Создать экземпляр класса</td><td><code>new Date()</code></td></tr>
        <tr><td><code>void</code></td><td>Всегда возвращает undefined</td><td><code>void 0</code> → undefined</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Битовые (редко)</h3>
    <table class="data-table">
      <thead><tr><th>Оператор</th><th>Значение</th></tr></thead>
      <tbody>
        <tr><td><code>&amp;</code></td><td>Битовое И</td></tr>
        <tr><td><code>|</code></td><td>Битовое ИЛИ</td></tr>
        <tr><td><code>^</code></td><td>Битовое XOR</td></tr>
        <tr><td><code>~</code></td><td>Битовое НЕ</td></tr>
        <tr><td><code>&lt;&lt;</code></td><td>Сдвиг влево</td></tr>
        <tr><td><code>&gt;&gt;</code></td><td>Сдвиг вправо</td></tr>
        <tr><td><code>&gt;&gt;&gt;</code></td><td>Сдвиг вправо без знака</td></tr>
      </tbody>
    </table>
    <div class="tip">
      Используются редко: работа с бинарными флагами (permissions), низкоуровневые оптимизации, битмаски. В повседневной разработке почти не встречаются.
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-js-keywords" class="section">
  <div class="section-title">Ключевые слова / команды (statements)</div>

  <div class="subsection">
    <p class="text">Зарезервированные слова языка. Строят структуру программы.</p>

    <h3 class="subsection-title">Объявление</h3>
    <table class="data-table">
      <thead><tr><th>Слово</th><th>Что</th></tr></thead>
      <tbody>
        <tr><td><code>var</code></td><td>Переменная (function scope, legacy)</td></tr>
        <tr><td><code>let</code></td><td>Переменная (block scope, можно менять)</td></tr>
        <tr><td><code>const</code></td><td>Константа (block scope, нельзя переприсвоить)</td></tr>
        <tr><td><code>function</code></td><td>Объявить функцию</td></tr>
        <tr><td><code>class</code></td><td>Объявить класс</td></tr>
        <tr><td><code>async</code></td><td>Асинхронная функция</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Управление потоком</h3>
    <table class="data-table">
      <thead><tr><th>Слово</th><th>Что</th></tr></thead>
      <tbody>
        <tr><td><code>if</code> / <code>else</code></td><td>Условие</td></tr>
        <tr><td><code>switch</code> / <code>case</code> / <code>default</code></td><td>Множественный выбор</td></tr>
        <tr><td><code>for</code></td><td>Цикл со счётчиком</td></tr>
        <tr><td><code>while</code> / <code>do</code></td><td>Цикл по условию</td></tr>
        <tr><td><code>for...of</code></td><td>Цикл по значениям iterable</td></tr>
        <tr><td><code>for...in</code></td><td>Цикл по ключам объекта</td></tr>
        <tr><td><code>break</code></td><td>Прервать цикл / switch</td></tr>
        <tr><td><code>continue</code></td><td>Следующая итерация цикла</td></tr>
        <tr><td><code>return</code></td><td>Вернуть значение из функции</td></tr>
        <tr><td><code>yield</code></td><td>Отдать значение из генератора</td></tr>
        <tr><td><code>await</code></td><td>Ждать Promise (внутри async)</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Ошибки</h3>
    <table class="data-table">
      <thead><tr><th>Слово</th><th>Что</th></tr></thead>
      <tbody>
        <tr><td><code>try</code></td><td>Блок с потенциальной ошибкой</td></tr>
        <tr><td><code>catch (err)</code></td><td>Обработчик ошибки</td></tr>
        <tr><td><code>finally</code></td><td>Всегда выполняется (успех или ошибка)</td></tr>
        <tr><td><code>throw</code></td><td>Бросить ошибку</td></tr>
      </tbody>
    </table>
    <pre><code><span class="c-key">try</span> {
    <span class="c-key">const</span> <span class="c-var">data</span> = <span class="c-fn">JSON</span>.<span class="c-fn">parse</span>(<span class="c-var">badStr</span>);
} <span class="c-key">catch</span> (<span class="c-var">err</span>) {
    <span class="c-fn">console</span>.<span class="c-fn">error</span>(<span class="c-var">err</span>.<span class="c-var">message</span>);
    <span class="c-key">throw</span> <span class="c-key">new</span> <span class="c-fn">Error</span>(<span class="c-str">'Не смогли распарсить'</span>);
} <span class="c-key">finally</span> {
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'Всегда сработает'</span>);
}</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Модули (ES6)</h3>
    <table class="data-table">
      <thead><tr><th>Слово</th><th>Что</th></tr></thead>
      <tbody>
        <tr><td><code>import</code></td><td>Импортировать из другого файла</td></tr>
        <tr><td><code>export</code></td><td>Экспортировать переменную/функцию/класс</td></tr>
        <tr><td><code>export default</code></td><td>Экспорт по умолчанию (один на файл)</td></tr>
        <tr><td><code>from</code></td><td>Откуда импортировать</td></tr>
        <tr><td><code>as</code></td><td>Переименовать при импорте</td></tr>
      </tbody>
    </table>
    <pre><code><span class="c-comment">// utils.js</span>
<span class="c-key">export const</span> <span class="c-var">PI</span> = <span class="c-num">3.14</span>;
<span class="c-key">export function</span> <span class="c-fn">sum</span>(<span class="c-var">a</span>, <span class="c-var">b</span>) { <span class="c-key">return</span> <span class="c-var">a</span> + <span class="c-var">b</span>; }
<span class="c-key">export default class</span> <span class="c-type">User</span> {}

<span class="c-comment">// main.js</span>
<span class="c-key">import</span> <span class="c-type">User</span>, { <span class="c-var">PI</span>, <span class="c-fn">sum</span> } <span class="c-key">from</span> <span class="c-str">'./utils.js'</span>;
<span class="c-key">import</span> { <span class="c-fn">sum</span> <span class="c-key">as</span> <span class="c-fn">add</span> } <span class="c-key">from</span> <span class="c-str">'./utils.js'</span>;   <span class="c-comment">// переименовать</span></code></pre>

    <h3 class="subsection-title" style="margin-top:18px">Named vs Default import — <em>фигурные скобки vs без</em></h3>
    <p style="color:var(--text2);line-height:1.75;margin-bottom:10px;font-size:13.5px">
      Правило простое: <strong>фигурные скобки = именованный экспорт</strong>. Без скобок — default. Именно поэтому <code>import { useI18n } from 'vue-i18n'</code> — в скобках: <code>useI18n</code> объявлен как <code>export</code> (не <code>export default</code>).
    </p>
    <table class="data-table">
      <thead><tr><th>В модуле экспорт</th><th>Импорт</th></tr></thead>
      <tbody>
        <tr><td><code>export default X</code></td><td><code>import X from 'mod'</code> — <strong>без скобок</strong>, имя произвольное</td></tr>
        <tr><td><code>export const X = ...</code></td><td><code>import { X } from 'mod'</code> — <strong>в скобках</strong>, имя должно совпадать</td></tr>
        <tr><td>оба одновременно</td><td><code>import Def, { X, Y } from 'mod'</code></td></tr>
        <tr><td>переименовать при импорте</td><td><code>import { X as MyX } from 'mod'</code></td></tr>
        <tr><td>всё сразу как namespace</td><td><code>import * as M from 'mod'</code> → <code>M.X</code>, <code>M.Y</code></td></tr>
      </tbody>
    </table>

    <p style="color:var(--text2);line-height:1.75;margin:10px 0;font-size:13.5px">
      <strong>Ключевое отличие:</strong> у default-экспорта имя при импорте <em>произвольное</em> — модуль не знает как ты его называешь. У named — имя <em>обязательно совпадает</em> с экспортом (иначе — <code>as</code>).
    </p>

    <pre><code><span class="c-comment">// Реальный пример: vue-i18n</span>
<span class="c-comment">// Внутри библиотеки: export function useI18n() { ... }</span>
<span class="c-comment">//                    export function createI18n() { ... }</span>
<span class="c-comment">// Оба — named-экспорты, поэтому:</span>

<span class="c-key">import</span> { <span class="c-fn">useI18n</span> } <span class="c-key">from</span> <span class="c-str">'vue-i18n'</span>;              <span class="c-comment">// ✓ в скобках</span>
<span class="c-key">import</span> { <span class="c-fn">useI18n</span>, <span class="c-fn">createI18n</span> } <span class="c-key">from</span> <span class="c-str">'vue-i18n'</span>;  <span class="c-comment">// несколько сразу</span>
<span class="c-key">import</span> { <span class="c-fn">useI18n</span> <span class="c-key">as</span> <span class="c-fn">useLocale</span> } <span class="c-key">from</span> <span class="c-str">'vue-i18n'</span>; <span class="c-comment">// переименовали</span>

<span class="c-comment">// Если бы vue-i18n делал `export default useI18n` — было бы:</span>
<span class="c-key">import</span> <span class="c-fn">useI18n</span> <span class="c-key">from</span> <span class="c-str">'vue-i18n'</span>;                <span class="c-comment">// без скобок</span></code></pre>

    <p style="color:var(--text2);line-height:1.75;margin:10px 0;font-size:13.5px">
      <strong>Как узнать, что именно экспортирует модуль?</strong> Три способа:
    </p>
    <ul style="margin:8px 0 12px 22px;color:var(--text2);font-size:13px;line-height:1.85">
      <li>Официальная документация — там пишут <code>import { X } from 'lib'</code>.</li>
      <li><code>node_modules/имя-пакета/dist/</code> — открыть <code>.d.ts</code> файл, там видны все <code>export</code>.</li>
      <li>В консоли (для установленного пакета): <code>import * as M from 'lib'; console.log(M)</code> — все именованные экспорты как поля объекта.</li>
    </ul>

    <div class="pitfall"><strong>⚠ Классическая ошибка:</strong> <code>import useI18n from 'vue-i18n'</code> (без скобок) → в переменной <code>useI18n</code> окажется <code>undefined</code> либо весь модуль-объект (зависит от bundler'а). Вылезет ошибка типа <em>«useI18n is not a function»</em>. Проверяй скобки первым делом.</div>

    <h3 class="subsection-title" style="margin-top:18px">Откуда вообще берётся имя <code>useI18n</code></h3>
    <p style="color:var(--text2);line-height:1.75;margin-bottom:10px;font-size:13.5px">
      Имя <strong>задаёт автор библиотеки</strong>, когда пишет <code>export</code>. У <code>vue-i18n</code> в исходниках буквально лежит:
    </p>
<pre><code><span class="c-comment">// где-то в node_modules/vue-i18n/dist/vue-i18n.mjs</span>
<span class="c-key">export function</span> <span class="c-fn">useI18n</span>(<span class="c-var">options</span>) { ... }</code></pre>
    <p style="color:var(--text2);line-height:1.75;margin:10px 0;font-size:13.5px">
      Слово <code>useI18n</code> они <em>сами придумали</em> и записали в коде. Могли назвать <code>useLang</code>, <code>translate</code> — но выбрали именно так. Ты как потребитель обязан импортить <strong>с точно таким именем</strong>, потому что оно жёстко зашито в их экспортах.
    </p>

    <p style="color:var(--text2);line-height:1.75;margin:10px 0;font-size:13.5px">
      <strong>Как посмотреть список экспортов реальной библиотеки:</strong>
    </p>
<pre><code><span class="c-comment"># Ищем строки export в скомпилированном dist</span>
grep -rn <span class="c-str">'^export'</span> node_modules/vue-i18n/dist/*.mjs | head -3</code></pre>
    <p style="color:var(--text2);line-height:1.75;margin:10px 0;font-size:13.5px">
      В конце файла будет строка вида:
    </p>
<pre><code><span class="c-key">export</span> { <span class="c-fn">DatetimeFormat</span>, <span class="c-fn">I18nD</span>, <span class="c-fn">I18nInjectionKey</span>, <span class="c-fn">I18nN</span>, <span class="c-fn">I18nT</span>,
         <span class="c-fn">NumberFormat</span>, <span class="c-fn">Translation</span>, <span class="c-var">VERSION</span>,
         <span class="c-fn">createI18n</span>, <span class="c-fn">useI18n</span>, <span class="c-fn">vTDirective</span> };</code></pre>
    <p style="color:var(--text2);line-height:1.75;margin:10px 0;font-size:13.5px">
      Это <strong>список всего, что библиотека отдаёт наружу</strong>. Каждое имя можно импортить в скобках: <code>import { createI18n }</code>, <code>import { useI18n }</code>, <code>import { Translation }</code>. Чего в списке нет — <em>импортить нельзя</em>, ошибка будет.
    </p>

    <div class="info-box success">
      <strong>Мнемоника:</strong> «имя = договор двух сторон». Автор написал <code>export const X</code> — назначил имя. Ты пишешь <code>import { X }</code> — цитируешь его буквально. Хочешь по-своему? Только через <code>as</code>: <code>import { X as MyX }</code>.
    </div>

    <h3 class="subsection-title" style="margin-top:18px"><code>import</code> / <code>export</code> — это <em>не функции</em>, а ключевые слова</h3>
    <p style="color:var(--text2);line-height:1.75;margin-bottom:10px;font-size:13.5px">
      Частая путаница: «это функции же?». <strong>Нет.</strong> Это <em>ключевые слова синтаксиса</em> ES-модулей — как <code>if</code>, <code>for</code>, <code>const</code>, <code>class</code>. Часть самого языка.
    </p>
    <table class="data-table">
      <thead><tr><th></th><th>Функция</th><th><code>import</code> / <code>export</code></th></tr></thead>
      <tbody>
        <tr><td>Скобки при вызове</td><td><code>fn(x)</code></td><td>Нет — <code>import X from 'y'</code> без <code>(...)</code></td></tr>
        <tr><td>Где можно писать</td><td>Где угодно</td><td><strong>Только на верхнем уровне файла</strong> (не в <code>if</code>, не в функции)</td></tr>
        <tr><td>Когда работает</td><td>В момент вызова, в runtime</td><td>В <em>фазе загрузки</em>, до запуска кода — движок парсит и строит граф зависимостей</td></tr>
        <tr><td>Динамические имена</td><td><code>fn(variable)</code></td><td>Нельзя — путь к модулю должен быть <em>литералом</em>: <code>from './x.js'</code>, не <code>from variable</code></td></tr>
      </tbody>
    </table>

    <p style="color:var(--text2);line-height:1.75;margin:10px 0;font-size:13.5px">
      <strong>Что это значит на практике:</strong> нельзя написать <code>if (условие) import X from 'y'</code>. Импорты всегда наверху файла, до любого кода. Bundler (Vite / webpack) читает их <em>до</em> запуска, чтобы понять «какой файл от какого зависит», склеить всё в бандл, вырезать неиспользуемое (tree-shaking).
    </p>

    <h3 class="subsection-title" style="margin-top:18px">Динамический <code>import()</code> — <em>единственный случай</em>, когда import похож на функцию</h3>
    <p style="color:var(--text2);line-height:1.75;margin-bottom:10px;font-size:13.5px">
      Отдельная штука: <code>import('./x.js')</code> со скобками — это <em>функция</em>, возвращает Promise. Используется для <strong>code splitting</strong>: подгрузить модуль не сразу, а по требованию (например, только когда пользователь открыл окно чата).
    </p>
<pre><code><span class="c-comment">// Обычный (статический) — сразу при загрузке страницы</span>
<span class="c-key">import</span> { <span class="c-fn">useI18n</span> } <span class="c-key">from</span> <span class="c-str">'vue-i18n'</span>;

<span class="c-comment">// Динамический — грузим только когда нужно</span>
<span class="c-fn">button</span>.<span class="c-fn">addEventListener</span>(<span class="c-str">'click'</span>, <span class="c-key">async</span> () =&gt; {
    <span class="c-key">const</span> { <span class="c-fn">openChat</span> } = <span class="c-key">await</span> <span class="c-fn">import</span>(<span class="c-str">'./chat.js'</span>);
    <span class="c-fn">openChat</span>();
});</code></pre>
    <p style="color:var(--text2);line-height:1.75;margin:10px 0;font-size:13.5px">
      Здесь <code>import(...)</code> — это <em>функция</em> (со скобками), возвращающая Promise с объектом-модулем. Bundler на этой точке разрежет бандл на два файла: главный и «chat-chunk». Пользователь скачает второй только при клике.
    </p>

    <h3 class="subsection-title" style="margin-top:18px">ESM vs CommonJS — короткая история</h3>
    <p style="color:var(--text2);line-height:1.75;margin-bottom:10px;font-size:13.5px">
      <code>import</code> / <code>export</code> появились в <strong>ES6 (2015)</strong> — это <strong>ESM</strong> (ECMAScript Modules). До этого 10+ лет Node.js жил на <strong>CommonJS</strong> — свой формат с <code>require()</code> и <code>module.exports</code>. Обе системы до сих пор встречаются.
    </p>
    <table class="data-table">
      <thead><tr><th></th><th>CommonJS (старое, Node.js)</th><th>ESM (современное, стандарт)</th></tr></thead>
      <tbody>
        <tr>
          <td>Импорт</td>
          <td><code>const X = require('mod')</code></td>
          <td><code>import X from 'mod'</code></td>
        </tr>
        <tr>
          <td>Named</td>
          <td><code>const { X } = require('mod')</code> (деструктуризация из объекта)</td>
          <td><code>import { X } from 'mod'</code></td>
        </tr>
        <tr>
          <td>Экспорт</td>
          <td><code>module.exports = X</code> / <code>exports.foo = 1</code></td>
          <td><code>export default X</code> / <code>export const foo = 1</code></td>
        </tr>
        <tr>
          <td>Динамика</td>
          <td>Обычная функция — можно везде</td>
          <td>Статический наверху, динамический через <code>import()</code></td>
        </tr>
        <tr>
          <td>Файловое расширение</td>
          <td><code>.js</code> (по умолчанию в старых Node)</td>
          <td><code>.mjs</code> или <code>.js</code> в <code>"type": "module"</code> проекте</td>
        </tr>
      </tbody>
    </table>

    <div class="pitfall"><strong>⚠ Смесь двух форматов.</strong> В Node-мире бывает: пакет опубликован в CommonJS, а ты в проекте пишешь ESM (или наоборот). Отсюда ошибки вида <code>Cannot use import statement outside a module</code> или <code>ERR_REQUIRE_ESM</code>. Лечится: в <code>package.json</code> поставить <code>"type": "module"</code> (весь проект ESM), или использовать динамический <code>import()</code> для загрузки ESM-пакета из CJS-кода.</div>

    <div class="remember-box">
      <strong>Итог по модулям:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li><code>import { X } from 'mod'</code> — <em>named</em>, имя должно совпадать с <code>export</code> автора</li>
        <li><code>import X from 'mod'</code> — <em>default</em>, имя произвольное</li>
        <li>Имена задаёт автор библиотеки — проверить можно <code>grep '^export' node_modules/pkg/dist/*.mjs</code></li>
        <li><code>import</code>/<code>export</code> — ключевые слова, работают только на верхнем уровне, парсятся до запуска кода</li>
        <li>Динамический <code>import('...')</code> — единственная «функциональная» форма, для code splitting</li>
        <li>CommonJS (<code>require</code>) — старый Node-формат, до 2015. Сейчас — постепенно вытесняется ESM</li>
      </ul>
    </div>

    <h3 class="subsection-title" style="margin-top:18px"><code>import.meta</code> — метаданные ES-модуля</h3>
    <p style="color:var(--text2);line-height:1.75;margin-bottom:10px;font-size:13.5px">
      <code>import.meta</code> — специальный <strong>объект</strong>, доступный внутри любого ES-модуля. Содержит метаданные о текущем файле. Часть стандарта JS. Не путать со <em>ключевым словом</em> <code>import</code> — здесь <code>import</code> используется как <em>именной префикс</em>, а <code>.meta</code> — свойство.
    </p>
<pre><code><span class="c-comment">// В любом ESM-файле</span>
<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-fn">import</span>.<span class="c-var">meta</span>);
<span class="c-comment">// { url: 'file:///project/src/api.js', env: {...} }</span>

<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-fn">import</span>.<span class="c-var">meta</span>.<span class="c-var">url</span>);
<span class="c-comment">// путь к самому файлу — в браузере URL, в Node — file://...</span></code></pre>

    <p style="color:var(--text2);line-height:1.75;margin:10px 0;font-size:13.5px">
      Стандарт определяет только <code>import.meta.url</code>. Всё остальное — <strong>расширения от рантайма / бандлера</strong>:
    </p>
    <table class="data-table">
      <thead><tr><th>Свойство</th><th>Кто добавляет</th><th>Зачем</th></tr></thead>
      <tbody>
        <tr><td><code>import.meta.url</code></td><td>Стандарт JS</td><td>Путь к модулю (аналог <code>__filename</code> в CommonJS)</td></tr>
        <tr><td><code>import.meta.env</code></td><td><strong>Vite</strong> (не стандарт)</td><td>Переменные из <code>.env</code>-файлов</td></tr>
        <tr><td><code>import.meta.hot</code></td><td>Vite / HMR</td><td>API для hot module replacement</td></tr>
        <tr><td><code>import.meta.glob</code></td><td>Vite</td><td>Массовый импорт файлов по glob-паттерну</td></tr>
        <tr><td><code>import.meta.resolve</code></td><td>Node.js 20+</td><td>Резолвить URL модуля</td></tr>
      </tbody>
    </table>

    <h3 class="subsection-title" style="margin-top:18px"><code>import.meta.env.VITE_*</code> — переменные окружения в Vite</h3>
    <p style="color:var(--text2);line-height:1.75;margin-bottom:10px;font-size:13.5px">
      Vite при сборке собирает <strong>все переменные</strong> из <code>.env</code>-файлов проекта, у которых имя начинается с префикса <code>VITE_</code>, и делает их доступными через <code>import.meta.env</code>. Это способ хранить настройки (URL API, публичные ключи, флаги фичей) вне кода — легко менять между dev / staging / prod без правки исходников.
    </p>
<pre><code><span class="c-comment"># .env.development</span>
<span class="c-var">VITE_API_URL</span>=https://kazchess-develop.silentsoft.kz
<span class="c-var">VITE_APP_NAME</span>=KazChess Dev

<span class="c-comment"># .env.production</span>
<span class="c-var">VITE_API_URL</span>=https://api.kazchess.kz
<span class="c-var">VITE_APP_NAME</span>=KazChess</code></pre>

<pre><code><span class="c-comment">// api_public.js</span>
<span class="c-key">import</span> axios <span class="c-key">from</span> <span class="c-str">'axios'</span>;

<span class="c-key">const</span> <span class="c-var">api</span> = axios.<span class="c-fn">create</span>({
    <span class="c-var">baseURL</span>: <span class="c-fn">import</span>.<span class="c-var">meta</span>.<span class="c-var">env</span>.<span class="c-var">VITE_API_URL</span>,
});

<span class="c-key">export default</span> <span class="c-var">api</span>;</code></pre>

    <p style="color:var(--text2);line-height:1.75;margin:10px 0;font-size:13.5px">
      <strong>Как это работает:</strong> Vite при сборке <em>подставляет строку в код напрямую</em>. Итоговый JS после билда выглядит так:
    </p>
<pre><code><span class="c-key">const</span> <span class="c-var">api</span> = axios.<span class="c-fn">create</span>({
    <span class="c-var">baseURL</span>: <span class="c-str">'https://api.kazchess.kz'</span>,   <span class="c-comment">// ← подставилось при сборке</span>
});</code></pre>

    <p style="color:var(--text2);line-height:1.75;margin:10px 0;font-size:13.5px">
      Дефолтные поля <code>import.meta.env</code>:
    </p>
    <table class="data-table">
      <thead><tr><th>Поле</th><th>Что</th></tr></thead>
      <tbody>
        <tr><td><code>import.meta.env.MODE</code></td><td><code>'development'</code> / <code>'production'</code> / <code>'test'</code> — режим сборки</td></tr>
        <tr><td><code>import.meta.env.DEV</code></td><td><code>true</code> в dev, <code>false</code> в prod</td></tr>
        <tr><td><code>import.meta.env.PROD</code></td><td><code>true</code> в prod-сборке</td></tr>
        <tr><td><code>import.meta.env.BASE_URL</code></td><td>Base path приложения (из <code>vite.config.js</code>)</td></tr>
        <tr><td><code>import.meta.env.VITE_*</code></td><td>Всё, что ты определил сам в <code>.env</code></td></tr>
      </tbody>
    </table>

    <div class="pitfall"><strong>⚠ Только префикс <code>VITE_</code>.</strong> Переменные без префикса — <em>не попадут</em> в клиентский бандл (это защита: <code>DB_PASSWORD</code> не должен утечь в браузер). Хочешь чтобы клиент видел — префикс <code>VITE_</code>. Хочешь скрыть — оставляй без префикса, использовать только на сервере.</div>

    <div class="pitfall"><strong>⚠ <code>import.meta.env</code> — фича Vite, не стандарт JS.</strong> В обычном Node.js без Vite её нет. Аналог в webpack — <code>process.env.REACT_APP_*</code> (Create React App), в Next.js — <code>process.env.NEXT_PUBLIC_*</code>. Идея та же: префикс = «можно в клиент».</div>

    <div class="pitfall"><strong>⚠ Значения подставляются <em>при сборке</em>, не в рантайме.</strong> Изменил <code>.env</code> — надо пересобрать (<code>npm run build</code>) или перезапустить dev-сервер. Хочешь менять URL API без пересборки — читай его через отдельный runtime-конфиг (<code>/config.json</code>, загружаемый через fetch при старте).</div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Специальные значения / слова</h3>
    <table class="data-table">
      <thead><tr><th>Слово</th><th>Что</th></tr></thead>
      <tbody>
        <tr><td><code>true</code> / <code>false</code></td><td>Булевые</td></tr>
        <tr><td><code>null</code></td><td>Явное «пусто»</td></tr>
        <tr><td><code>undefined</code></td><td>Не присвоено</td></tr>
        <tr><td><code>NaN</code></td><td>Not a Number</td></tr>
        <tr><td><code>this</code></td><td>Контекст вызова</td></tr>
        <tr><td><code>super</code></td><td>Родительский класс</td></tr>
        <tr><td><code>new.target</code></td><td>Был ли вызов через <code>new</code></td></tr>
        <tr><td><code>debugger</code></td><td>Точка останова в DevTools</td></tr>
      </tbody>
    </table>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-js-control" class="section">
  <div class="section-title">JavaScript: if / switch / циклы</div>

  <div class="subsection">
    <h3 class="subsection-title">Условия — стандартно</h3>
    <pre><code><span class="c-key">if</span> (<span class="c-var">age</span> &gt;= <span class="c-num">18</span>) {
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'adult'</span>);
} <span class="c-key">else if</span> (<span class="c-var">age</span> &gt;= <span class="c-num">13</span>) {
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'teen'</span>);
} <span class="c-key">else</span> {
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'child'</span>);
}

<span class="c-comment">// switch — использует ===</span>
<span class="c-key">switch</span> (<span class="c-var">status</span>) {
    <span class="c-key">case</span> <span class="c-str">'active'</span>:
    <span class="c-key">case</span> <span class="c-str">'pending'</span>:              <span class="c-comment">// fall-through — оба обрабатываются одинаково</span>
        <span class="c-fn">handleActive</span>();
        <span class="c-key">break</span>;                    <span class="c-comment">// ⚠ обязателен break, иначе идёт дальше</span>
    <span class="c-key">case</span> <span class="c-str">'blocked'</span>:
        <span class="c-fn">handleBlocked</span>();
        <span class="c-key">break</span>;
    <span class="c-key">default</span>:
        <span class="c-fn">throw</span> <span class="c-key">new</span> <span class="c-fn">Error</span>(<span class="c-str">'unknown status'</span>);
}</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Циклы — 5 видов, когда что</h3>
    <table class="data-table">
      <thead><tr><th>Цикл</th><th>Использовать когда</th></tr></thead>
      <tbody>
        <tr><td><code>for (let i=0; i&lt;n; i++)</code></td><td>Классика — контроль индекса, можно break/continue</td></tr>
        <tr><td><code>for (const item of arr)</code></td><td>Массивы / iterable — по значениям</td></tr>
        <tr><td><code>for (const key in obj)</code></td><td>Только по объектам! Для массивов НЕ используй (даст индексы как строки + prototype-цепочку)</td></tr>
        <tr><td><code>arr.forEach(fn)</code></td><td>Массивы — короткий синтаксис, но НЕТ break/continue</td></tr>
        <tr><td><code>while / do-while</code></td><td>Пока условие true, число итераций неизвестно</td></tr>
      </tbody>
    </table>
    <pre><code><span class="c-comment">// for...of — идиоматично для массивов</span>
<span class="c-key">for</span> (<span class="c-key">const</span> <span class="c-var">user</span> <span class="c-key">of</span> <span class="c-var">users</span>) {
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">user</span>.<span class="c-var">name</span>);
}

<span class="c-comment">// for...of + entries для индексов</span>
<span class="c-key">for</span> (<span class="c-key">const</span> [<span class="c-var">i</span>, <span class="c-var">user</span>] <span class="c-key">of</span> <span class="c-var">users</span>.<span class="c-fn">entries</span>()) {
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">i</span>, <span class="c-var">user</span>.<span class="c-var">name</span>);
}

<span class="c-comment">// Object.entries / keys / values</span>
<span class="c-key">for</span> (<span class="c-key">const</span> [<span class="c-var">key</span>, <span class="c-var">value</span>] <span class="c-key">of</span> <span class="c-fn">Object</span>.<span class="c-fn">entries</span>(<span class="c-var">user</span>)) {
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">key</span>, <span class="c-var">value</span>);
}</code></pre>
    <div class="pitfall"><strong>⚠ forEach нельзя прервать</strong> — <code>break</code>/<code>continue</code>/<code>return</code> НЕ работают как ожидаешь. Если нужен break — используй <code>for...of</code> или <code>some()</code>/<code>find()</code>.</div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-js-functions" class="section">
  <div class="section-title">JavaScript: функции + arrow functions</div>

  <div class="subsection">
    <h3 class="subsection-title">4 способа объявить функцию</h3>
    <pre><code><span class="c-comment">// 1. Function Declaration — hoisted (можно вызвать до объявления)</span>
<span class="c-key">function</span> <span class="c-fn">sum</span>(<span class="c-var">a</span>, <span class="c-var">b</span>) { <span class="c-key">return</span> <span class="c-var">a</span> + <span class="c-var">b</span>; }

<span class="c-comment">// 2. Function Expression — не hoisted</span>
<span class="c-key">const</span> <span class="c-var">sum</span> = <span class="c-key">function</span>(<span class="c-var">a</span>, <span class="c-var">b</span>) { <span class="c-key">return</span> <span class="c-var">a</span> + <span class="c-var">b</span>; };

<span class="c-comment">// 3. Arrow Function (ES6) — короткая + свой this</span>
<span class="c-key">const</span> <span class="c-var">sum</span> = (<span class="c-var">a</span>, <span class="c-var">b</span>) =&gt; <span class="c-var">a</span> + <span class="c-var">b</span>;           <span class="c-comment">// одно выражение — return неявный</span>
<span class="c-key">const</span> <span class="c-var">double</span> = <span class="c-var">x</span> =&gt; <span class="c-var">x</span> * <span class="c-num">2</span>;                  <span class="c-comment">// 1 параметр — скобки не нужны</span>
<span class="c-key">const</span> <span class="c-var">log</span> = <span class="c-var">x</span> =&gt; { <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">x</span>); };      <span class="c-comment">// с {} return нужен явно</span>

<span class="c-comment">// 4. Метод класса (краткий синтаксис)</span>
<span class="c-key">class</span> <span class="c-type">Calc</span> {
    <span class="c-fn">sum</span>(<span class="c-var">a</span>, <span class="c-var">b</span>) { <span class="c-key">return</span> <span class="c-var">a</span> + <span class="c-var">b</span>; }
}</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title"> Главное отличие arrow: <code>this</code></h3>
    <p class="text">Arrow не имеет своего <code>this</code> — берёт из окружающего scope (<strong>lexical this</strong>). Обычная function имеет свой <code>this</code> зависящий от того <em>как</em> её вызвали.</p>
    <pre><code><span class="c-key">class</span> <span class="c-type">User</span> {
    <span class="c-fn">constructor</span>(<span class="c-var">name</span>) { <span class="c-key">this</span>.<span class="c-var">name</span> = <span class="c-var">name</span>; }

    <span class="c-comment">// ❌ Обычная function теряет this в setTimeout</span>
    <span class="c-fn">greetBad</span>() {
        <span class="c-fn">setTimeout</span>(<span class="c-key">function</span>() {
            <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-key">this</span>.<span class="c-var">name</span>);      <span class="c-comment">// undefined! this = window/undefined</span>
        }, <span class="c-num">100</span>);
    }

    <span class="c-comment">// ✅ Arrow function захватывает this из класса</span>
    <span class="c-fn">greetGood</span>() {
        <span class="c-fn">setTimeout</span>(() =&gt; {
            <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-key">this</span>.<span class="c-var">name</span>);      <span class="c-comment">// 'Alice' ✓</span>
        }, <span class="c-num">100</span>);
    }
}</code></pre>
    <div class="remember-box">
      <strong>Когда что использовать:</strong>
      <ul style="margin:6px 0 0 20px">
        <li><strong>Arrow</strong> — callbacks, короткие функции, когда нужен this из окружения</li>
        <li><strong>Обычная</strong> — методы класса, объекты, конструкторы (нельзя new с arrow)</li>
      </ul>
    </div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Дефолтные параметры + destructuring</h3>
    <pre><code><span class="c-key">function</span> <span class="c-fn">greet</span>(<span class="c-var">name</span> = <span class="c-str">'Гость'</span>, <span class="c-var">greeting</span> = <span class="c-str">'Привет'</span>) {
    <span class="c-key">return</span> <span class="c-str">`${greeting}, ${name}!`</span>;
}
<span class="c-fn">greet</span>();                     <span class="c-comment">// "Привет, Гость!"</span>
<span class="c-fn">greet</span>(<span class="c-str">'Alice'</span>);              <span class="c-comment">// "Привет, Alice!"</span>

<span class="c-comment">// Destructuring в параметрах — как named args в PHP 8</span>
<span class="c-key">function</span> <span class="c-fn">createUser</span>({ <span class="c-var">name</span>, <span class="c-var">email</span>, <span class="c-var">age</span> = <span class="c-num">18</span> }) {
    <span class="c-key">return</span> { <span class="c-var">name</span>, <span class="c-var">email</span>, <span class="c-var">age</span> };
}
<span class="c-fn">createUser</span>({ <span class="c-var">name</span>: <span class="c-str">'Alice'</span>, <span class="c-var">email</span>: <span class="c-str">'a@x.kz'</span> });</code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-js-arrays" class="section">
  <div class="section-title">JavaScript: массивы + методы</div>

  <div class="subsection">
    <h3 class="subsection-title"> Топ-8 методов массивов (аналоги PHP)</h3>
    <table class="data-table">
      <thead><tr><th>JS метод</th><th>Что делает</th><th>PHP аналог</th></tr></thead>
      <tbody>
        <tr><td><code>arr.map(fn)</code></td><td>Трансформация — новый массив</td><td><code>array_map</code></td></tr>
        <tr><td><code>arr.filter(fn)</code></td><td>Фильтр — новый массив</td><td><code>array_filter</code></td></tr>
        <tr><td><code>arr.reduce(fn, init)</code></td><td>Свёртка в 1 значение</td><td><code>array_reduce</code></td></tr>
        <tr><td><code>arr.forEach(fn)</code></td><td>Обход, ничего не возвращает</td><td><code>foreach</code> без результата</td></tr>
        <tr><td><code>arr.find(fn)</code></td><td>Первый совпавший элемент или <code>undefined</code></td><td><code>array_filter + [0]</code></td></tr>
        <tr><td><code>arr.some(fn)</code></td><td>Есть ли ХОТЯ БЫ ОДИН по условию → bool</td><td>цикл</td></tr>
        <tr><td><code>arr.every(fn)</code></td><td>ВСЕ ли по условию → bool</td><td>цикл</td></tr>
        <tr><td><code>arr.includes(val)</code></td><td>Есть ли значение → bool</td><td><code>in_array</code></td></tr>
      </tbody>
    </table>
    <pre><code><span class="c-key">const</span> <span class="c-var">users</span> = [
    { <span class="c-var">id</span>: <span class="c-num">1</span>, <span class="c-var">name</span>: <span class="c-str">'Alice'</span>, <span class="c-var">age</span>: <span class="c-num">30</span>, <span class="c-var">active</span>: <span class="c-key">true</span> },
    { <span class="c-var">id</span>: <span class="c-num">2</span>, <span class="c-var">name</span>: <span class="c-str">'Bob'</span>,   <span class="c-var">age</span>: <span class="c-num">15</span>, <span class="c-var">active</span>: <span class="c-key">false</span> },
    { <span class="c-var">id</span>: <span class="c-num">3</span>, <span class="c-var">name</span>: <span class="c-str">'Cena'</span>,  <span class="c-var">age</span>: <span class="c-num">45</span>, <span class="c-var">active</span>: <span class="c-key">true</span> },
];

<span class="c-comment">// map — только имена</span>
<span class="c-key">const</span> <span class="c-var">names</span> = <span class="c-var">users</span>.<span class="c-fn">map</span>(<span class="c-var">u</span> =&gt; <span class="c-var">u</span>.<span class="c-var">name</span>);         <span class="c-comment">// ['Alice', 'Bob', 'Cena']</span>

<span class="c-comment">// filter — только active</span>
<span class="c-key">const</span> <span class="c-var">active</span> = <span class="c-var">users</span>.<span class="c-fn">filter</span>(<span class="c-var">u</span> =&gt; <span class="c-var">u</span>.<span class="c-var">active</span>);      <span class="c-comment">// [Alice, Cena]</span>

<span class="c-comment">// reduce — сумма возрастов</span>
<span class="c-key">const</span> <span class="c-var">totalAge</span> = <span class="c-var">users</span>.<span class="c-fn">reduce</span>((<span class="c-var">sum</span>, <span class="c-var">u</span>) =&gt; <span class="c-var">sum</span> + <span class="c-var">u</span>.<span class="c-var">age</span>, <span class="c-num">0</span>);  <span class="c-comment">// 90</span>

<span class="c-comment">// find — первый совпавший</span>
<span class="c-key">const</span> <span class="c-var">bob</span> = <span class="c-var">users</span>.<span class="c-fn">find</span>(<span class="c-var">u</span> =&gt; <span class="c-var">u</span>.<span class="c-var">name</span> === <span class="c-str">'Bob'</span>);

<span class="c-comment">// some / every</span>
<span class="c-var">users</span>.<span class="c-fn">some</span>(<span class="c-var">u</span> =&gt; <span class="c-var">u</span>.<span class="c-var">age</span> &lt; <span class="c-num">18</span>);     <span class="c-comment">// true — Bob 15</span>
<span class="c-var">users</span>.<span class="c-fn">every</span>(<span class="c-var">u</span> =&gt; <span class="c-var">u</span>.<span class="c-var">age</span> &gt; <span class="c-num">10</span>);    <span class="c-comment">// true — все старше 10</span>

<span class="c-comment">// Цепочка методов — очень идиоматично</span>
<span class="c-key">const</span> <span class="c-var">adultNames</span> = <span class="c-var">users</span>
    .<span class="c-fn">filter</span>(<span class="c-var">u</span> =&gt; <span class="c-var">u</span>.<span class="c-var">age</span> &gt;= <span class="c-num">18</span>)
    .<span class="c-fn">map</span>(<span class="c-var">u</span> =&gt; <span class="c-var">u</span>.<span class="c-var">name</span>)
    .<span class="c-fn">sort</span>();                                            <span class="c-comment">// ['Alice', 'Cena']</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Мутирующие vs немутирующие</h3>
    <table class="data-table">
      <thead><tr><th>Мутирует исходный</th><th>Возвращает новый</th></tr></thead>
      <tbody>
        <tr><td><code>push</code>, <code>pop</code>, <code>shift</code>, <code>unshift</code></td><td><code>map</code>, <code>filter</code>, <code>slice</code></td></tr>
        <tr><td><code>splice</code>, <code>sort</code>, <code>reverse</code>, <code>fill</code></td><td><code>concat</code>, <code>flat</code>, <code>flatMap</code></td></tr>
      </tbody>
    </table>
    <pre><code><span class="c-comment">// slice — не мутирует, возвращает копию</span>
<span class="c-key">const</span> <span class="c-var">copy</span> = <span class="c-var">arr</span>.<span class="c-fn">slice</span>();               <span class="c-comment">// или [...arr]</span>

<span class="c-comment">// splice — мутирует, извлекает/вставляет</span>
<span class="c-var">arr</span>.<span class="c-fn">splice</span>(<span class="c-num">1</span>, <span class="c-num">2</span>);                    <span class="c-comment">// удалить 2 элемента начиная с индекса 1</span>
<span class="c-var">arr</span>.<span class="c-fn">splice</span>(<span class="c-num">1</span>, <span class="c-num">0</span>, <span class="c-str">'new'</span>);             <span class="c-comment">// вставить 'new' на индекс 1</span>

<span class="c-comment">// sort — мутирует! Всегда делай копию:</span>
<span class="c-key">const</span> <span class="c-var">sorted</span> = [...<span class="c-var">arr</span>].<span class="c-fn">sort</span>();       <span class="c-comment">// исходный arr не тронут</span></code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-js-objects" class="section">
  <div class="section-title">JavaScript: объекты + destructuring</div>

  <div class="subsection">
    <h3 class="subsection-title">Object literal + доступ</h3>
    <pre><code><span class="c-key">const</span> <span class="c-var">user</span> = {
    <span class="c-var">name</span>: <span class="c-str">'Alice'</span>,
    <span class="c-var">age</span>: <span class="c-num">30</span>,
    <span class="c-fn">greet</span>() { <span class="c-key">return</span> <span class="c-str">`Hi, ${</span><span class="c-key">this</span><span class="c-str">.name}`</span>; },        <span class="c-comment">// short-hand method</span>
    [<span class="c-str">'dynamic_' + key</span>]: <span class="c-key">true</span>,                       <span class="c-comment">// computed property</span>
};

<span class="c-comment">// Доступ: dot и bracket notation</span>
<span class="c-var">user</span>.<span class="c-var">name</span>;                       <span class="c-comment">// dot — для валидных имён</span>
<span class="c-var">user</span>[<span class="c-str">'name'</span>];                    <span class="c-comment">// bracket — для динамических ключей / пробелов</span>
<span class="c-var">user</span>[<span class="c-var">key</span>];                       <span class="c-comment">// bracket — из переменной</span>

<span class="c-comment">// Проверка наличия ключа</span>
<span class="c-str">'name'</span> <span class="c-key">in</span> <span class="c-var">user</span>;                  <span class="c-comment">// true — есть key (даже если undefined)</span>
<span class="c-var">user</span>.<span class="c-fn">hasOwnProperty</span>(<span class="c-str">'name'</span>);      <span class="c-comment">// true — только own props, не prototype</span>
<span class="c-fn">Object</span>.<span class="c-fn">hasOwn</span>(<span class="c-var">user</span>, <span class="c-str">'name'</span>);     <span class="c-comment">// современный вариант (ES2022)</span>

<span class="c-comment">// Удаление ключа</span>
<span class="c-key">delete</span> <span class="c-var">user</span>.<span class="c-var">age</span>;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Destructuring — извлечение полей</h3>
    <pre><code><span class="c-comment">// Из объекта</span>
<span class="c-key">const</span> { <span class="c-var">name</span>, <span class="c-var">age</span> } = <span class="c-var">user</span>;
<span class="c-key">const</span> { <span class="c-var">name</span>: <span class="c-var">userName</span> } = <span class="c-var">user</span>;                <span class="c-comment">// переименование</span>
<span class="c-key">const</span> { <span class="c-var">name</span>, <span class="c-var">age</span> = <span class="c-num">18</span> } = <span class="c-var">user</span>;                <span class="c-comment">// дефолт если undefined</span>
<span class="c-key">const</span> { <span class="c-var">profile</span>: { <span class="c-var">avatar</span> } } = <span class="c-var">user</span>;               <span class="c-comment">// вложенное</span>

<span class="c-comment">// Из массива — по позиции</span>
<span class="c-key">const</span> [<span class="c-var">first</span>, <span class="c-var">second</span>, ...<span class="c-var">rest</span>] = [<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>, <span class="c-num">4</span>, <span class="c-num">5</span>];
<span class="c-comment">// first=1, second=2, rest=[3,4,5]</span>

<span class="c-comment">// Обмен переменных</span>
[<span class="c-var">a</span>, <span class="c-var">b</span>] = [<span class="c-var">b</span>, <span class="c-var">a</span>];</code></pre>

    <h3 class="subsection-title" style="margin-top:18px">Практический паттерн: деструктуризация <em>возвращаемого объекта функции</em></h3>
    <p style="color:var(--text2);line-height:1.75;margin-bottom:10px;font-size:13.5px">
      Библиотеки часто возвращают из функции <strong>объект с кучей полей</strong>, и ты вытаскиваешь <em>только нужные</em>. Классический пример — Vue-композаблы (<code>useI18n</code>, <code>useRoute</code>, <code>useStore</code>), React-хуки (<code>useState</code>), <code>fetch()</code>, чтение <code>.env</code>.
    </p>
    <pre><code><span class="c-comment">// vue-i18n возвращает { t, locale, tm, te, d, n, ... }</span>
<span class="c-key">const</span> { <span class="c-var">t</span>, <span class="c-var">locale</span> } = <span class="c-fn">useI18n</span>();

<span class="c-comment">// эквивалентно (без деструктуризации):</span>
<span class="c-key">const</span> <span class="c-var">i18n</span> = <span class="c-fn">useI18n</span>();
<span class="c-key">const</span> <span class="c-var">t</span> = <span class="c-var">i18n</span>.<span class="c-var">t</span>;
<span class="c-key">const</span> <span class="c-var">locale</span> = <span class="c-var">i18n</span>.<span class="c-var">locale</span>;

<span class="c-comment">// Только одно поле — так же нормально:</span>
<span class="c-key">const</span> { <span class="c-var">t</span> } = <span class="c-fn">useI18n</span>();

<span class="c-comment">// Переименовать:</span>
<span class="c-key">const</span> { <span class="c-var">t</span>: <span class="c-var">translate</span> } = <span class="c-fn">useI18n</span>();
<span class="c-fn">translate</span>(<span class="c-str">'hello'</span>);   <span class="c-comment">// теперь через новое имя</span></code></pre>

    <p style="color:var(--text2);line-height:1.75;margin:10px 0;font-size:13.5px">
      <strong>Что там за поля</strong> в примере с <code>vue-i18n</code>:
    </p>
    <table class="data-table">
      <thead><tr><th>Поле</th><th>Что это</th></tr></thead>
      <tbody>
        <tr><td><code>t</code></td><td>Функция перевода — <code>t('interface.hello')</code> → «Привет»</td></tr>
        <tr><td><code>locale</code></td><td>Реактивная ссылка на текущий язык (<code>'ru'</code> / <code>'en'</code> / <code>'kz'</code>). В шаблоне видна как <code>locale</code>, менять как <code>locale.value = 'en'</code></td></tr>
        <tr><td><code>tm</code></td><td>Перевод массива-сообщений</td></tr>
        <tr><td><code>d</code>, <code>n</code></td><td>Форматирование даты / числа под текущий locale</td></tr>
      </tbody>
    </table>

    <div class="pitfall"><strong>⚠ Vue-специфика:</strong> реактивные значения (<code>ref</code> / <code>reactive</code>) при <em>обычной</em> деструктуризации <strong>теряют реактивность</strong>. Решения — <code>toRefs()</code> для reactive-объектов, <code>storeToRefs()</code> для Pinia. Подробно — в разделе Vue → Реактивность.</div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Копирование / слияние объектов</h3>
    <pre><code><span class="c-comment">// Shallow copy — spread</span>
<span class="c-key">const</span> <span class="c-var">copy</span> = { ...<span class="c-var">user</span> };
<span class="c-key">const</span> <span class="c-var">merged</span> = { ...<span class="c-var">defaults</span>, ...<span class="c-var">overrides</span> };      <span class="c-comment">// последний побеждает</span>

<span class="c-comment">// Или Object.assign</span>
<span class="c-key">const</span> <span class="c-var">copy2</span> = <span class="c-fn">Object</span>.<span class="c-fn">assign</span>({}, <span class="c-var">user</span>);
<span class="c-fn">Object</span>.<span class="c-fn">assign</span>(<span class="c-var">target</span>, <span class="c-var">src1</span>, <span class="c-var">src2</span>);           <span class="c-comment">// мутирует target</span>

<span class="c-comment">// Deep copy — structuredClone (современно)</span>
<span class="c-key">const</span> <span class="c-var">deep</span> = <span class="c-fn">structuredClone</span>(<span class="c-var">user</span>);          <span class="c-comment">// работает с nested объектами</span>

<span class="c-comment">// Старый способ deep copy (потеряет функции, Date):</span>
<span class="c-key">const</span> <span class="c-var">deep2</span> = <span class="c-fn">JSON</span>.<span class="c-fn">parse</span>(<span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">user</span>));</code></pre>
    <div class="pitfall"><strong>⚠ spread делает shallow copy.</strong> Вложенные объекты остаются по ссылке — мутация вложенного затронет оригинал!</div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-js-dom" class="section">
  <div class="section-title">DOM manipulation — vanilla JS</div>

  <div class="subsection">
    <h3 class="subsection-title">Поиск элементов</h3>
    <pre><code><span class="c-comment">// По ID — один элемент</span>
<span class="c-key">const</span> <span class="c-var">el</span> = <span class="c-fn">document</span>.<span class="c-fn">getElementById</span>(<span class="c-str">'header'</span>);

<span class="c-comment">// querySelector — CSS-селектор, первый совпавший</span>
<span class="c-key">const</span> <span class="c-var">btn</span> = <span class="c-fn">document</span>.<span class="c-fn">querySelector</span>(<span class="c-str">'.btn-primary'</span>);
<span class="c-key">const</span> <span class="c-var">input</span> = <span class="c-fn">document</span>.<span class="c-fn">querySelector</span>(<span class="c-str">'input[name="email"]'</span>);
<span class="c-key">const</span> <span class="c-var">first</span> = <span class="c-fn">document</span>.<span class="c-fn">querySelector</span>(<span class="c-str">'ul li:first-child'</span>);

<span class="c-comment">// querySelectorAll — все совпавшие (NodeList)</span>
<span class="c-key">const</span> <span class="c-var">items</span> = <span class="c-fn">document</span>.<span class="c-fn">querySelectorAll</span>(<span class="c-str">'.item'</span>);
<span class="c-var">items</span>.<span class="c-fn">forEach</span>(<span class="c-var">item</span> =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">item</span>));

<span class="c-comment">// Устаревшие (медленнее, HTMLCollection живой):</span>
<span class="c-fn">document</span>.<span class="c-fn">getElementsByClassName</span>(<span class="c-str">'btn'</span>);
<span class="c-fn">document</span>.<span class="c-fn">getElementsByTagName</span>(<span class="c-str">'div'</span>);</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Изменение элемента</h3>
    <pre><code><span class="c-comment">// Текст vs HTML</span>
<span class="c-var">el</span>.<span class="c-var">textContent</span> = <span class="c-str">'Привет'</span>;             <span class="c-comment">// безопасно (экранирует HTML)</span>
<span class="c-var">el</span>.<span class="c-var">innerHTML</span> = <span class="c-str">'&lt;strong&gt;Привет&lt;/strong&gt;'</span>;  <span class="c-comment">// ⚠ XSS если данные от юзера!</span>

<span class="c-comment">// Атрибуты</span>
<span class="c-var">el</span>.<span class="c-fn">setAttribute</span>(<span class="c-str">'data-id'</span>, <span class="c-str">'42'</span>);
<span class="c-var">el</span>.<span class="c-fn">getAttribute</span>(<span class="c-str">'data-id'</span>);
<span class="c-var">el</span>.<span class="c-var">dataset</span>.<span class="c-var">id</span>;                        <span class="c-comment">// удобный доступ к data-* атрибутам</span>
<span class="c-var">el</span>.<span class="c-fn">removeAttribute</span>(<span class="c-str">'disabled'</span>);

<span class="c-comment">// Классы</span>
<span class="c-var">el</span>.<span class="c-var">classList</span>.<span class="c-fn">add</span>(<span class="c-str">'active'</span>);
<span class="c-var">el</span>.<span class="c-var">classList</span>.<span class="c-fn">remove</span>(<span class="c-str">'hidden'</span>);
<span class="c-var">el</span>.<span class="c-var">classList</span>.<span class="c-fn">toggle</span>(<span class="c-str">'open'</span>);
<span class="c-var">el</span>.<span class="c-var">classList</span>.<span class="c-fn">contains</span>(<span class="c-str">'active'</span>);           <span class="c-comment">// bool</span>

<span class="c-comment">// Стили inline</span>
<span class="c-var">el</span>.<span class="c-var">style</span>.<span class="c-var">color</span> = <span class="c-str">'red'</span>;
<span class="c-var">el</span>.<span class="c-var">style</span>.<span class="c-var">backgroundColor</span> = <span class="c-str">'#f0f0f0'</span>;      <span class="c-comment">// camelCase!</span>

<span class="c-comment">// Формы</span>
<span class="c-var">input</span>.<span class="c-var">value</span>;                            <span class="c-comment">// значение input</span>
<span class="c-var">checkbox</span>.<span class="c-var">checked</span>;                       <span class="c-comment">// bool для checkbox</span>
<span class="c-var">select</span>.<span class="c-var">value</span>;                           <span class="c-comment">// выбранная option</span></code></pre>
    <div class="pitfall"><strong>⚠ innerHTML + user input = XSS.</strong> Всегда используй <code>textContent</code> для user-generated текста.</div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Создание / вставка / удаление</h3>
    <pre><code><span class="c-comment">// Создать</span>
<span class="c-key">const</span> <span class="c-var">div</span> = <span class="c-fn">document</span>.<span class="c-fn">createElement</span>(<span class="c-str">'div'</span>);
<span class="c-var">div</span>.<span class="c-var">textContent</span> = <span class="c-str">'Hello'</span>;
<span class="c-var">div</span>.<span class="c-var">className</span> = <span class="c-str">'msg'</span>;

<span class="c-comment">// Вставить</span>
<span class="c-fn">document</span>.<span class="c-var">body</span>.<span class="c-fn">append</span>(<span class="c-var">div</span>);                <span class="c-comment">// в конец (можно несколько)</span>
<span class="c-fn">document</span>.<span class="c-var">body</span>.<span class="c-fn">prepend</span>(<span class="c-var">div</span>);               <span class="c-comment">// в начало</span>
<span class="c-var">parent</span>.<span class="c-fn">insertBefore</span>(<span class="c-var">newEl</span>, <span class="c-var">referenceEl</span>);   <span class="c-comment">// перед конкретным</span>
<span class="c-var">el</span>.<span class="c-fn">insertAdjacentHTML</span>(<span class="c-str">'beforeend'</span>, <span class="c-str">'&lt;p&gt;x&lt;/p&gt;'</span>);  <span class="c-comment">// быстрая вставка HTML</span>

<span class="c-comment">// Удалить</span>
<span class="c-var">el</span>.<span class="c-fn">remove</span>();                             <span class="c-comment">// современно (IE не поддерживает)</span>
<span class="c-var">el</span>.<span class="c-var">parentNode</span>.<span class="c-fn">removeChild</span>(<span class="c-var">el</span>);            <span class="c-comment">// старый способ</span>

<span class="c-comment">// Клонировать</span>
<span class="c-key">const</span> <span class="c-var">clone</span> = <span class="c-var">el</span>.<span class="c-fn">cloneNode</span>(<span class="c-key">true</span>);            <span class="c-comment">// true = deep (с потомками)</span></code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-js-events" class="section">
  <div class="section-title">Events + обработка форм</div>

  <div class="subsection">
    <h3 class="subsection-title">addEventListener — основной способ</h3>
    <pre><code><span class="c-key">const</span> <span class="c-var">btn</span> = <span class="c-fn">document</span>.<span class="c-fn">querySelector</span>(<span class="c-str">'#submit'</span>);

<span class="c-var">btn</span>.<span class="c-fn">addEventListener</span>(<span class="c-str">'click'</span>, (<span class="c-var">event</span>) =&gt; {
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'Clicked!'</span>);
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">event</span>.<span class="c-var">target</span>);            <span class="c-comment">// на чём кликнули</span>
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">event</span>.<span class="c-var">currentTarget</span>);     <span class="c-comment">// к чему привязан listener</span>
});

<span class="c-comment">// Удалить listener — нужна ссылка на ту же функцию!</span>
<span class="c-key">const</span> <span class="c-var">handler</span> = () =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'once'</span>);
<span class="c-var">btn</span>.<span class="c-fn">addEventListener</span>(<span class="c-str">'click'</span>, <span class="c-var">handler</span>);
<span class="c-var">btn</span>.<span class="c-fn">removeEventListener</span>(<span class="c-str">'click'</span>, <span class="c-var">handler</span>);

<span class="c-comment">// Опции: once, capture, passive</span>
<span class="c-var">btn</span>.<span class="c-fn">addEventListener</span>(<span class="c-str">'click'</span>, <span class="c-var">handler</span>, { <span class="c-var">once</span>: <span class="c-key">true</span> });     <span class="c-comment">// сработает 1 раз</span>
<span class="c-var">scrollEl</span>.<span class="c-fn">addEventListener</span>(<span class="c-str">'scroll'</span>, <span class="c-var">h</span>, { <span class="c-var">passive</span>: <span class="c-key">true</span> });   <span class="c-comment">// оптимизация scroll</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Ключевые события</h3>
    <table class="data-table">
      <thead><tr><th>Событие</th><th>Когда</th></tr></thead>
      <tbody>
        <tr><td><code>click</code>, <code>dblclick</code></td><td>Клик / двойной</td></tr>
        <tr><td><code>submit</code></td><td>Форма submit</td></tr>
        <tr><td><code>change</code></td><td>Значение input изменилось (после blur)</td></tr>
        <tr><td><code>input</code></td><td>Каждое нажатие клавиши в input</td></tr>
        <tr><td><code>focus</code>, <code>blur</code></td><td>Фокус в/из элемента</td></tr>
        <tr><td><code>keydown</code>, <code>keyup</code></td><td>Клавиатура</td></tr>
        <tr><td><code>mouseenter</code>, <code>mouseleave</code></td><td>Наведение мыши (без bubbling)</td></tr>
        <tr><td><code>DOMContentLoaded</code></td><td>DOM готов (аналог <code>$(document).ready()</code>)</td></tr>
        <tr><td><code>load</code></td><td>Страница полностью загружена + assets</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Обработка формы + preventDefault</h3>
    <pre><code><span class="c-key">const</span> <span class="c-var">form</span> = <span class="c-fn">document</span>.<span class="c-fn">querySelector</span>(<span class="c-str">'#login-form'</span>);

<span class="c-var">form</span>.<span class="c-fn">addEventListener</span>(<span class="c-str">'submit'</span>, <span class="c-key">async</span> (<span class="c-var">event</span>) =&gt; {
    <span class="c-var">event</span>.<span class="c-fn">preventDefault</span>();                              <span class="c-comment">// не перезагружать страницу</span>

    <span class="c-comment">// Извлечь данные формы</span>
    <span class="c-key">const</span> <span class="c-var">formData</span> = <span class="c-key">new</span> <span class="c-fn">FormData</span>(<span class="c-var">form</span>);
    <span class="c-key">const</span> <span class="c-var">data</span> = <span class="c-fn">Object</span>.<span class="c-fn">fromEntries</span>(<span class="c-var">formData</span>);          <span class="c-comment">// {email:'a@x', password:'123'}</span>

    <span class="c-comment">// Валидация на клиенте</span>
    <span class="c-key">if</span> (!<span class="c-var">data</span>.<span class="c-var">email</span>.<span class="c-fn">includes</span>(<span class="c-str">'@'</span>)) {
        <span class="c-key">return</span> <span class="c-fn">alert</span>(<span class="c-str">'Некорректный email'</span>);
    }

    <span class="c-comment">// Отправка</span>
    <span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">'/api/login'</span>, {
        <span class="c-var">method</span>: <span class="c-str">'POST'</span>,
        <span class="c-var">headers</span>: { <span class="c-str">'Content-Type'</span>: <span class="c-str">'application/json'</span> },
        <span class="c-var">body</span>: <span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">data</span>),
    });
    <span class="c-key">const</span> <span class="c-var">result</span> = <span class="c-key">await</span> <span class="c-var">res</span>.<span class="c-fn">json</span>();
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">result</span>);
});</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Event bubbling + delegation</h3>
    <p class="text">Bubbling — событие идёт от target вверх по DOM. Delegation — вешаем listener на родителя, а не на каждый child.</p>
    <pre><code><span class="c-comment">// ❌ Плохо: listener на каждую кнопку (100 listeners для 100 кнопок)</span>
<span class="c-fn">document</span>.<span class="c-fn">querySelectorAll</span>(<span class="c-str">'.delete-btn'</span>).<span class="c-fn">forEach</span>(<span class="c-var">btn</span> =&gt; {
    <span class="c-var">btn</span>.<span class="c-fn">addEventListener</span>(<span class="c-str">'click'</span>, <span class="c-fn">handleDelete</span>);
});

<span class="c-comment">// ✅ Хорошо: 1 listener на родителя (delegation)</span>
<span class="c-fn">document</span>.<span class="c-fn">querySelector</span>(<span class="c-str">'#user-list'</span>).<span class="c-fn">addEventListener</span>(<span class="c-str">'click'</span>, (<span class="c-var">e</span>) =&gt; {
    <span class="c-key">if</span> (<span class="c-var">e</span>.<span class="c-var">target</span>.<span class="c-fn">matches</span>(<span class="c-str">'.delete-btn'</span>)) {
        <span class="c-fn">handleDelete</span>(<span class="c-var">e</span>);
    }
});
<span class="c-comment">// Плюс: работает для НОВЫХ элементов добавленных после — не нужно перепривязывать</span></code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-js-async" class="section">
  <div class="section-title">Async: Promise + async/await</div>

  <div class="subsection">
    <h3 class="subsection-title">Promise — 3 состояния</h3>
    <table class="data-table">
      <thead><tr><th>Состояние</th><th>Что значит</th></tr></thead>
      <tbody>
        <tr><td><code>pending</code></td><td>Ожидание — операция ещё идёт</td></tr>
        <tr><td><code>fulfilled</code></td><td>Успех — есть результат</td></tr>
        <tr><td><code>rejected</code></td><td>Ошибка — есть причина</td></tr>
      </tbody>
    </table>
    <pre><code><span class="c-comment">// Создание Promise</span>
<span class="c-key">const</span> <span class="c-var">promise</span> = <span class="c-key">new</span> <span class="c-fn">Promise</span>((<span class="c-var">resolve</span>, <span class="c-var">reject</span>) =&gt; {
    <span class="c-fn">setTimeout</span>(() =&gt; {
        <span class="c-key">const</span> <span class="c-var">success</span> = <span class="c-fn">Math</span>.<span class="c-fn">random</span>() &gt; <span class="c-num">0.5</span>;
        <span class="c-key">if</span> (<span class="c-var">success</span>) <span class="c-fn">resolve</span>(<span class="c-str">'OK'</span>);
        <span class="c-key">else</span> <span class="c-fn">reject</span>(<span class="c-key">new</span> <span class="c-fn">Error</span>(<span class="c-str">'Failed'</span>));
    }, <span class="c-num">1000</span>);
});

<span class="c-comment">// Использование через then / catch / finally</span>
<span class="c-var">promise</span>
    .<span class="c-fn">then</span>(<span class="c-var">result</span> =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'Success:'</span>, <span class="c-var">result</span>))
    .<span class="c-fn">catch</span>(<span class="c-var">err</span> =&gt; <span class="c-fn">console</span>.<span class="c-fn">error</span>(<span class="c-str">'Error:'</span>, <span class="c-var">err</span>.<span class="c-var">message</span>))
    .<span class="c-fn">finally</span>(() =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'Done'</span>));                <span class="c-comment">// всегда выполнится</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">async / await — синтаксический сахар над Promise</h3>
    <pre><code><span class="c-comment">// async функция ВСЕГДА возвращает Promise</span>
<span class="c-key">async function</span> <span class="c-fn">loadUser</span>(<span class="c-var">id</span>) {
    <span class="c-key">try</span> {
        <span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">`/api/users/${id}`</span>);   <span class="c-comment">// ждёт Promise</span>
        <span class="c-key">if</span> (!<span class="c-var">res</span>.<span class="c-var">ok</span>) <span class="c-key">throw</span> <span class="c-key">new</span> <span class="c-fn">Error</span>(<span class="c-str">`HTTP ${res.status}`</span>);
        <span class="c-key">const</span> <span class="c-var">user</span> = <span class="c-key">await</span> <span class="c-var">res</span>.<span class="c-fn">json</span>();
        <span class="c-key">return</span> <span class="c-var">user</span>;
    } <span class="c-key">catch</span> (<span class="c-var">err</span>) {
        <span class="c-fn">console</span>.<span class="c-fn">error</span>(<span class="c-str">'Load failed:'</span>, <span class="c-var">err</span>);
        <span class="c-key">throw</span> <span class="c-var">err</span>;
    }
}

<span class="c-comment">// Вызов — либо .then, либо await в другой async</span>
<span class="c-fn">loadUser</span>(<span class="c-num">1</span>).<span class="c-fn">then</span>(<span class="c-var">user</span> =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">user</span>));

<span class="c-comment">// Или</span>
(<span class="c-key">async</span> () =&gt; {
    <span class="c-key">const</span> <span class="c-var">user</span> = <span class="c-key">await</span> <span class="c-fn">loadUser</span>(<span class="c-num">1</span>);
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">user</span>);
})();</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Promise.all / race / allSettled</h3>
    <pre><code><span class="c-comment">// Promise.all — параллельно + ждёт ВСЕ. Если один упал — весь rejected.</span>
<span class="c-key">const</span> [<span class="c-var">user</span>, <span class="c-var">posts</span>, <span class="c-var">comments</span>] = <span class="c-key">await</span> <span class="c-fn">Promise</span>.<span class="c-fn">all</span>([
    <span class="c-fn">fetch</span>(<span class="c-str">'/api/user'</span>),
    <span class="c-fn">fetch</span>(<span class="c-str">'/api/posts'</span>),
    <span class="c-fn">fetch</span>(<span class="c-str">'/api/comments'</span>),
]);

<span class="c-comment">// Promise.allSettled — не падает, возвращает все результаты (успехи + ошибки)</span>
<span class="c-key">const</span> <span class="c-var">results</span> = <span class="c-key">await</span> <span class="c-fn">Promise</span>.<span class="c-fn">allSettled</span>([<span class="c-var">p1</span>, <span class="c-var">p2</span>, <span class="c-var">p3</span>]);
<span class="c-comment">// [{status:'fulfilled', value:...}, {status:'rejected', reason:...}]</span>

<span class="c-comment">// Promise.race — кто первый — того и результат</span>
<span class="c-key">const</span> <span class="c-var">fastest</span> = <span class="c-key">await</span> <span class="c-fn">Promise</span>.<span class="c-fn">race</span>([<span class="c-var">p1</span>, <span class="c-var">p2</span>, <span class="c-fn">timeout</span>(<span class="c-num">5000</span>)]);</code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-js-fetch" class="section">
  <div class="section-title">Fetch API / AJAX / JSON</div>

  <div class="subsection">
    <h3 class="subsection-title">GET запрос</h3>
    <pre><code><span class="c-comment">// Простой GET</span>
<span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">'/api/users'</span>);
<span class="c-key">const</span> <span class="c-var">users</span> = <span class="c-key">await</span> <span class="c-var">res</span>.<span class="c-fn">json</span>();

<span class="c-comment">// С параметрами через URLSearchParams</span>
<span class="c-key">const</span> <span class="c-var">params</span> = <span class="c-key">new</span> <span class="c-fn">URLSearchParams</span>({ <span class="c-var">page</span>: <span class="c-num">2</span>, <span class="c-var">limit</span>: <span class="c-num">10</span> });
<span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">`/api/users?${params}`</span>);</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">POST / PUT / DELETE — JSON body</h3>
    <pre><code><span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">'/api/users'</span>, {
    <span class="c-var">method</span>: <span class="c-str">'POST'</span>,
    <span class="c-var">headers</span>: {
        <span class="c-str">'Content-Type'</span>: <span class="c-str">'application/json'</span>,
        <span class="c-str">'Accept'</span>: <span class="c-str">'application/json'</span>,
        <span class="c-str">'X-CSRF-TOKEN'</span>: <span class="c-fn">document</span>.<span class="c-fn">querySelector</span>(<span class="c-str">'meta[name="csrf-token"]'</span>).<span class="c-var">content</span>,
    },
    <span class="c-var">body</span>: <span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>({ <span class="c-var">name</span>: <span class="c-str">'Alice'</span>, <span class="c-var">email</span>: <span class="c-str">'a@x.kz'</span> }),
});

<span class="c-comment">// Обработка</span>
<span class="c-key">if</span> (!<span class="c-var">res</span>.<span class="c-var">ok</span>) {
    <span class="c-key">throw</span> <span class="c-key">new</span> <span class="c-fn">Error</span>(<span class="c-str">`HTTP ${res.status}: ${res.statusText}`</span>);
}
<span class="c-key">const</span> <span class="c-var">data</span> = <span class="c-key">await</span> <span class="c-var">res</span>.<span class="c-fn">json</span>();</code></pre>
    <div class="pitfall">
      <strong>⚠ fetch НЕ бросает error на 4xx/5xx!</strong> Только на network fail. Всегда проверяй <code>res.ok</code> вручную.
    </div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">FormData — файлы + multipart/form-data</h3>
    <pre><code><span class="c-comment">// Из существующей формы</span>
<span class="c-key">const</span> <span class="c-var">formData</span> = <span class="c-key">new</span> <span class="c-fn">FormData</span>(<span class="c-var">form</span>);

<span class="c-comment">// Или собрать вручную</span>
<span class="c-key">const</span> <span class="c-var">fd</span> = <span class="c-key">new</span> <span class="c-fn">FormData</span>();
<span class="c-var">fd</span>.<span class="c-fn">append</span>(<span class="c-str">'name'</span>, <span class="c-str">'Alice'</span>);
<span class="c-var">fd</span>.<span class="c-fn">append</span>(<span class="c-str">'avatar'</span>, <span class="c-var">fileInput</span>.<span class="c-var">files</span>[<span class="c-num">0</span>]);     <span class="c-comment">// файл</span>

<span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">'/api/upload'</span>, {
    <span class="c-var">method</span>: <span class="c-str">'POST'</span>,
    <span class="c-var">body</span>: <span class="c-var">fd</span>,        <span class="c-comment">// НЕ ставь Content-Type — браузер сам поставит multipart/form-data с boundary</span>
});</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">JSON — parse / stringify</h3>
    <pre><code><span class="c-key">const</span> <span class="c-var">json</span> = <span class="c-str">'{"name":"Alice","age":30}'</span>;

<span class="c-comment">// Строка → объект</span>
<span class="c-key">const</span> <span class="c-var">obj</span> = <span class="c-fn">JSON</span>.<span class="c-fn">parse</span>(<span class="c-var">json</span>);          <span class="c-comment">// { name: 'Alice', age: 30 }</span>

<span class="c-comment">// Объект → строка</span>
<span class="c-key">const</span> <span class="c-var">str</span> = <span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">obj</span>);
<span class="c-key">const</span> <span class="c-var">pretty</span> = <span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">obj</span>, <span class="c-key">null</span>, <span class="c-num">2</span>);  <span class="c-comment">// с отступами 2 пробела</span>

<span class="c-comment">// Ошибки — try/catch</span>
<span class="c-key">try</span> {
    <span class="c-key">const</span> <span class="c-var">obj</span> = <span class="c-fn">JSON</span>.<span class="c-fn">parse</span>(<span class="c-var">badJson</span>);
} <span class="c-key">catch</span> (<span class="c-var">e</span>) {
    <span class="c-fn">console</span>.<span class="c-fn">error</span>(<span class="c-str">'Invalid JSON:'</span>, <span class="c-var">e</span>.<span class="c-var">message</span>);
}</code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-js-json" class="section">
  <div class="section-title">JSON.parse / JSON.stringify</div>

  <div class="subsection">
    <p class="text">JSON — текстовый формат обмена данными. Два глобальных метода в JS: <code>JSON.parse</code> и <code>JSON.stringify</code>.</p>

    <h3 class="subsection-title">Формат JSON — что можно и нельзя</h3>
    <table class="data-table">
      <thead><tr><th>Можно</th><th>Нельзя</th></tr></thead>
      <tbody>
        <tr><td>string, number, boolean, null</td><td>undefined, function, Symbol, BigInt</td></tr>
        <tr><td>Объект <code>{ }</code> и массив <code>[ ]</code></td><td>Date (превращается в строку)</td></tr>
        <tr><td>Вложенность любой глубины</td><td>Циклические ссылки (TypeError)</td></tr>
        <tr><td>Ключи только в двойных кавычках</td><td>Одинарные кавычки — невалидно</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">JSON.stringify — объект → строка</h3>
    <pre><code><span class="c-key">const</span> <span class="c-var">user</span> = { <span class="c-var">name</span>: <span class="c-str">'Alice'</span>, <span class="c-var">age</span>: <span class="c-num">30</span>, <span class="c-var">active</span>: <span class="c-key">true</span> };

<span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">user</span>);
<span class="c-comment">// '{"name":"Alice","age":30,"active":true}'</span>

<span class="c-comment">// С форматированием — 2 пробела отступ</span>
<span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">user</span>, <span class="c-key">null</span>, <span class="c-num">2</span>);
<span class="c-comment">// '{
//   "name": "Alice",
//   "age": 30,
//   "active": true
// }'</span>

<span class="c-comment">// Фильтр — только эти поля</span>
<span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">user</span>, [<span class="c-str">'name'</span>, <span class="c-str">'age'</span>]);
<span class="c-comment">// '{"name":"Alice","age":30}'  — active пропущено</span>

<span class="c-comment">// Функция-replacer — трансформация каждого значения</span>
<span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">user</span>, (<span class="c-var">key</span>, <span class="c-var">value</span>) =&gt; {
    <span class="c-key">if</span> (<span class="c-var">key</span> === <span class="c-str">'age'</span>) <span class="c-key">return</span> <span class="c-key">undefined</span>;   <span class="c-comment">// undefined = убрать поле</span>
    <span class="c-key">return</span> <span class="c-var">value</span>;
});
<span class="c-comment">// '{"name":"Alice","active":true}'</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">JSON.parse — строка → объект</h3>
    <pre><code><span class="c-key">const</span> <span class="c-var">json</span> = <span class="c-str">'{"name":"Alice","age":30}'</span>;

<span class="c-key">const</span> <span class="c-var">obj</span> = <span class="c-fn">JSON</span>.<span class="c-fn">parse</span>(<span class="c-var">json</span>);
<span class="c-comment">// { name: 'Alice', age: 30 }</span>

<span class="c-comment">// Функция-reviver — трансформация значений при парсинге</span>
<span class="c-key">const</span> <span class="c-var">obj2</span> = <span class="c-fn">JSON</span>.<span class="c-fn">parse</span>(<span class="c-var">json</span>, (<span class="c-var">key</span>, <span class="c-var">value</span>) =&gt; {
    <span class="c-key">if</span> (<span class="c-var">key</span> === <span class="c-str">'age'</span>) <span class="c-key">return</span> <span class="c-var">value</span> + <span class="c-num">1</span>;
    <span class="c-key">return</span> <span class="c-var">value</span>;
});
<span class="c-comment">// { name: 'Alice', age: 31 }</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title"> Ошибки — обязательно try/catch</h3>
    <pre><code><span class="c-comment">// JSON.parse БРОСАЕТ SyntaxError если строка невалидна</span>
<span class="c-key">try</span> {
    <span class="c-key">const</span> <span class="c-var">obj</span> = <span class="c-fn">JSON</span>.<span class="c-fn">parse</span>(<span class="c-var">userInput</span>);
} <span class="c-key">catch</span> (<span class="c-var">e</span>) {
    <span class="c-fn">console</span>.<span class="c-fn">error</span>(<span class="c-str">'Invalid JSON:'</span>, <span class="c-var">e</span>.<span class="c-var">message</span>);
    <span class="c-comment">// SyntaxError: Unexpected token ... in JSON at position ...</span>
}

<span class="c-comment">// stringify тоже может бросить — циклическая ссылка или BigInt</span>
<span class="c-key">const</span> <span class="c-var">obj</span> = {};
<span class="c-var">obj</span>.<span class="c-var">self</span> = <span class="c-var">obj</span>;                     <span class="c-comment">// объект ссылается на себя</span>
<span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">obj</span>);              <span class="c-comment">// ❌ TypeError: Converting circular structure to JSON</span>

<span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>({ <span class="c-var">n</span>: <span class="c-num">10n</span> });     <span class="c-comment">// ❌ TypeError: Do not know how to serialize a BigInt</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Практические приёмы</h3>
    <pre><code><span class="c-comment">// 1. Клонировать объект (deep clone)</span>
<span class="c-key">const</span> <span class="c-var">clone</span> = <span class="c-fn">JSON</span>.<span class="c-fn">parse</span>(<span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">obj</span>));
<span class="c-comment">// ⚠ Теряет функции, Date превращается в строку, Symbol теряется
// Для полного клона — structuredClone(obj) (современно)</span>

<span class="c-comment">// 2. Сохранить в localStorage</span>
<span class="c-fn">localStorage</span>.<span class="c-fn">setItem</span>(<span class="c-str">'user'</span>, <span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">user</span>));
<span class="c-key">const</span> <span class="c-var">saved</span> = <span class="c-fn">JSON</span>.<span class="c-fn">parse</span>(<span class="c-fn">localStorage</span>.<span class="c-fn">getItem</span>(<span class="c-str">'user'</span>));

<span class="c-comment">// 3. Body для fetch POST</span>
<span class="c-fn">fetch</span>(<span class="c-str">'/api/users'</span>, {
    <span class="c-var">method</span>: <span class="c-str">'POST'</span>,
    <span class="c-var">headers</span>: { <span class="c-str">'Content-Type'</span>: <span class="c-str">'application/json'</span> },
    <span class="c-var">body</span>: <span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">user</span>),
});

<span class="c-comment">// 4. Разбор ответа сервера</span>
<span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">'/api/user'</span>);
<span class="c-key">const</span> <span class="c-var">data</span> = <span class="c-key">await</span> <span class="c-var">res</span>.<span class="c-fn">json</span>();       <span class="c-comment">// fetch сам делает JSON.parse внутри</span>

<span class="c-comment">// 5. Сравнить два объекта поверхностно</span>
<span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">a</span>) === <span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">b</span>);
<span class="c-comment">// ⚠ Порядок ключей важен, работает не всегда идеально</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">toJSON — кастомизация сериализации класса</h3>
    <pre><code><span class="c-key">class</span> <span class="c-type">User</span> {
    <span class="c-fn">constructor</span>(<span class="c-var">name</span>, <span class="c-var">password</span>) {
        <span class="c-key">this</span>.<span class="c-var">name</span> = <span class="c-var">name</span>;
        <span class="c-key">this</span>.<span class="c-var">password</span> = <span class="c-var">password</span>;
    }

    <span class="c-fn">toJSON</span>() {                             <span class="c-comment">// вызывается автоматически при JSON.stringify</span>
        <span class="c-key">return</span> { <span class="c-var">name</span>: <span class="c-key">this</span>.<span class="c-var">name</span> };  <span class="c-comment">// не сериализуем password</span>
    }
}

<span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-key">new</span> <span class="c-fn">User</span>(<span class="c-str">'Alice'</span>, <span class="c-str">'secret'</span>));
<span class="c-comment">// '{"name":"Alice"}' — password не попал</span></code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-jq-intro" class="section">
  <div class="section-title">jQuery — что это, актуальность</div>

  <div class="subsection">
    <h3 class="subsection-title">Что такое jQuery</h3>
    <p class="text">
      Библиотека JS созданная в 2006 (John Resig). Основная цель — <strong>устранить кросс-браузерные несовместимости</strong> (IE6-8) и упростить DOM-операции. Один глобальный объект <code>$</code> (или <code>jQuery</code>) даёт удобное API.
    </p>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Актуальность в 2026</h3>
    <table class="data-table">
      <thead><tr><th>Аспект</th><th>Статус</th></tr></thead>
      <tbody>
        <tr><td>Новые проекты</td><td>❌ Не используют — vanilla JS + fetch API покрывают всё</td></tr>
        <tr><td>Legacy проекты</td><td>✅ Активно поддерживаются, замена стоит миллионы</td></tr>
        <tr><td>WordPress и другие CMS</td><td>✅ Встроены — при работе с плагинами jQuery неизбежен</td></tr>
      </tbody>
    </table>
    <div class="remember-box">
      <strong>Итог:</strong> на новых проектах — vanilla JS + fetch API. На legacy — jQuery, потому что переписывать существующий код часто нецелесообразно. jQuery закрыл проблему кроссбраузерности эпохи IE 6-8; современные браузеры это решили в стандарте.
    </div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Как подключить</h3>
    <pre><code><span class="c-comment">&lt;!-- CDN — стандартный способ подключить jQuery --&gt;</span>
&lt;<span class="c-key">script</span> <span class="c-var">src</span>=<span class="c-str">"https://code.jquery.com/jquery-3.7.1.min.js"</span>&gt;&lt;/<span class="c-key">script</span>&gt;

<span class="c-comment">&lt;!-- Проверка версии --&gt;</span>
&lt;<span class="c-key">script</span>&gt;
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-fn">$</span>.<span class="c-fn">fn</span>.<span class="c-var">jquery</span>);   <span class="c-comment">// "3.7.1"</span>
&lt;/<span class="c-key">script</span>&gt;</code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-jq-selectors" class="section">
  <div class="section-title">jQuery Selectors</div>

  <div class="subsection">
    <h3 class="subsection-title"><code>$()</code> = <code>document.querySelectorAll</code></h3>
    <p class="text">Основа jQuery — функция <code>$()</code>. Принимает CSS-селектор, возвращает jQuery-объект (обёртку над NodeList).</p>
    <pre><code><span class="c-fn">$</span>(<span class="c-str">'#header'</span>);                        <span class="c-comment">// по ID</span>
<span class="c-fn">$</span>(<span class="c-str">'.btn'</span>);                           <span class="c-comment">// по классу (все)</span>
<span class="c-fn">$</span>(<span class="c-str">'div'</span>);                            <span class="c-comment">// по тегу</span>
<span class="c-fn">$</span>(<span class="c-str">'input[type="checkbox"]'</span>);          <span class="c-comment">// по атрибуту</span>
<span class="c-fn">$</span>(<span class="c-str">'ul li:first-child'</span>);              <span class="c-comment">// любой CSS3 селектор</span>
<span class="c-fn">$</span>(<span class="c-str">'a[href^="https"]'</span>);                <span class="c-comment">// href начинается с "https"</span>

<span class="c-comment">// Специфичные jQuery-селекторы (не в CSS):</span>
<span class="c-fn">$</span>(<span class="c-str">':checked'</span>);                       <span class="c-comment">// отмеченные checkbox/radio</span>
<span class="c-fn">$</span>(<span class="c-str">':selected'</span>);                      <span class="c-comment">// выбранные option</span>
<span class="c-fn">$</span>(<span class="c-str">':visible'</span>);                       <span class="c-comment">// видимые элементы</span>
<span class="c-fn">$</span>(<span class="c-str">':hidden'</span>);
<span class="c-fn">$</span>(<span class="c-str">':contains("Hello")'</span>);              <span class="c-comment">// с текстом "Hello"</span>

<span class="c-comment">// Контекст поиска — 2-й параметр</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>, <span class="c-str">'#container'</span>);            <span class="c-comment">// .item ТОЛЬКО внутри #container</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Traversal — навигация по дереву</h3>
    <pre><code><span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">parent</span>();               <span class="c-comment">// прямой родитель</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">parents</span>(<span class="c-str">'.wrapper'</span>);      <span class="c-comment">// все предки совпадающие с селектором</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">closest</span>(<span class="c-str">'form'</span>);          <span class="c-comment">// ближайший предок (или сам)</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">children</span>();             <span class="c-comment">// прямые дети</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">find</span>(<span class="c-str">'.btn'</span>);            <span class="c-comment">// потомки любого уровня</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">siblings</span>();             <span class="c-comment">// соседи</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">next</span>();                 <span class="c-comment">// следующий сосед</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">prev</span>();                 <span class="c-comment">// предыдущий сосед</span>

<span class="c-comment">// Первый / последний / по индексу</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">first</span>();
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">last</span>();
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">eq</span>(<span class="c-num">2</span>);                  <span class="c-comment">// 3-й элемент (индекс с 0)</span></code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-jq-dom" class="section">
  <div class="section-title">jQuery: DOM manipulation</div>

  <div class="subsection">
    <h3 class="subsection-title">Текст / HTML / value</h3>
    <pre><code><span class="c-comment">// Getter (без аргументов) / Setter (с аргументом)</span>
<span class="c-fn">$</span>(<span class="c-str">'.msg'</span>).<span class="c-fn">text</span>();                       <span class="c-comment">// прочитать текст</span>
<span class="c-fn">$</span>(<span class="c-str">'.msg'</span>).<span class="c-fn">text</span>(<span class="c-str">'Привет'</span>);              <span class="c-comment">// установить (безопасно, экранирует HTML)</span>

<span class="c-fn">$</span>(<span class="c-str">'.msg'</span>).<span class="c-fn">html</span>();                       <span class="c-comment">// прочитать HTML</span>
<span class="c-fn">$</span>(<span class="c-str">'.msg'</span>).<span class="c-fn">html</span>(<span class="c-str">'&lt;b&gt;Bold&lt;/b&gt;'</span>);          <span class="c-comment">// ⚠ XSS если данные от юзера</span>

<span class="c-fn">$</span>(<span class="c-str">'input'</span>).<span class="c-fn">val</span>();                      <span class="c-comment">// значение input</span>
<span class="c-fn">$</span>(<span class="c-str">'input'</span>).<span class="c-fn">val</span>(<span class="c-str">'new value'</span>);           <span class="c-comment">// установить</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Атрибуты + data</h3>
    <pre><code><span class="c-fn">$</span>(<span class="c-str">'.link'</span>).<span class="c-fn">attr</span>(<span class="c-str">'href'</span>);                  <span class="c-comment">// прочитать</span>
<span class="c-fn">$</span>(<span class="c-str">'.link'</span>).<span class="c-fn">attr</span>(<span class="c-str">'href'</span>, <span class="c-str">'/x'</span>);            <span class="c-comment">// установить</span>
<span class="c-fn">$</span>(<span class="c-str">'.link'</span>).<span class="c-fn">removeAttr</span>(<span class="c-str">'disabled'</span>);

<span class="c-comment">// data-* атрибуты</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">data</span>(<span class="c-str">'id'</span>);                   <span class="c-comment">// читает data-id</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">data</span>(<span class="c-str">'id'</span>, <span class="c-num">42</span>);               <span class="c-comment">// ⚠ ставит в кеш jQuery, не в DOM! attr() лучше для DOM</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Вставка / удаление</h3>
    <pre><code><span class="c-fn">$</span>(<span class="c-str">'#list'</span>).<span class="c-fn">append</span>(<span class="c-str">'&lt;li&gt;New&lt;/li&gt;'</span>);          <span class="c-comment">// в конец родителя</span>
<span class="c-fn">$</span>(<span class="c-str">'#list'</span>).<span class="c-fn">prepend</span>(<span class="c-str">'&lt;li&gt;First&lt;/li&gt;'</span>);      <span class="c-comment">// в начало</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">after</span>(<span class="c-str">'&lt;p&gt;After&lt;/p&gt;'</span>);         <span class="c-comment">// после элемента</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">before</span>(<span class="c-str">'&lt;p&gt;Before&lt;/p&gt;'</span>);       <span class="c-comment">// перед элементом</span>

<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">remove</span>();                     <span class="c-comment">// удалить полностью</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">empty</span>();                      <span class="c-comment">// очистить содержимое (сам остаётся)</span>
<span class="c-fn">$</span>(<span class="c-str">'.item'</span>).<span class="c-fn">detach</span>();                     <span class="c-comment">// удалить но сохранить в памяти (можно вернуть)</span>

<span class="c-comment">// Замена</span>
<span class="c-fn">$</span>(<span class="c-str">'.old'</span>).<span class="c-fn">replaceWith</span>(<span class="c-str">'&lt;div&gt;New&lt;/div&gt;'</span>);</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title"> Chaining — визитка jQuery</h3>
    <pre><code><span class="c-comment">// Каждый метод возвращает jQuery-объект → можно цепочку</span>
<span class="c-fn">$</span>(<span class="c-str">'#user'</span>)
    .<span class="c-fn">addClass</span>(<span class="c-str">'active'</span>)
    .<span class="c-fn">removeClass</span>(<span class="c-str">'hidden'</span>)
    .<span class="c-fn">attr</span>(<span class="c-str">'title'</span>, <span class="c-str">'Selected'</span>)
    .<span class="c-fn">text</span>(<span class="c-str">'Alice'</span>)
    .<span class="c-fn">css</span>(<span class="c-str">'color'</span>, <span class="c-str">'red'</span>)
    .<span class="c-fn">fadeIn</span>();</code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-jq-css" class="section">
  <div class="section-title">jQuery: CSS / классы</div>

  <div class="subsection">
    <pre><code><span class="c-comment">// Классы</span>
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">addClass</span>(<span class="c-str">'active'</span>);
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">removeClass</span>(<span class="c-str">'hidden'</span>);
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">toggleClass</span>(<span class="c-str">'open'</span>);
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">hasClass</span>(<span class="c-str">'active'</span>);          <span class="c-comment">// bool</span>

<span class="c-comment">// Несколько классов</span>
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">addClass</span>(<span class="c-str">'a b c'</span>);            <span class="c-comment">// добавить несколько</span>
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">removeClass</span>();                <span class="c-comment">// удалить ВСЕ классы</span>

<span class="c-comment">// CSS inline</span>
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">css</span>(<span class="c-str">'color'</span>);                 <span class="c-comment">// читать</span>
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">css</span>(<span class="c-str">'color'</span>, <span class="c-str">'red'</span>);
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">css</span>({                          <span class="c-comment">// несколько сразу — объектом</span>
    <span class="c-str">'color'</span>: <span class="c-str">'red'</span>,
    <span class="c-str">'background-color'</span>: <span class="c-str">'#f0f0f0'</span>,           <span class="c-comment">// с дефисами — в кавычках</span>
    <span class="c-var">fontSize</span>: <span class="c-str">'16px'</span>,                     <span class="c-comment">// или camelCase без кавычек</span>
});

<span class="c-comment">// Показать / скрыть</span>
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">show</span>();
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">hide</span>();
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">toggle</span>();

<span class="c-comment">// С анимацией — базовые</span>
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">fadeIn</span>(<span class="c-num">300</span>);
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">fadeOut</span>(<span class="c-num">300</span>);
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">slideDown</span>();
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">slideUp</span>();
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">slideToggle</span>();</code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-jq-events" class="section">
  <div class="section-title">jQuery Events</div>

  <div class="subsection">
    <h3 class="subsection-title">$(document).ready() — аналог DOMContentLoaded</h3>
    <pre><code><span class="c-comment">// Полный синтаксис</span>
<span class="c-fn">$</span>(<span class="c-fn">document</span>).<span class="c-fn">ready</span>(<span class="c-key">function</span>() {
    <span class="c-comment">// DOM готов, можно работать</span>
});

<span class="c-comment">// Короткая форма (используется чаще)</span>
<span class="c-fn">$</span>(<span class="c-key">function</span>() {
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'ready!'</span>);
});</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Прямая привязка событий</h3>
    <pre><code><span class="c-comment">// Короткие методы для популярных событий</span>
<span class="c-fn">$</span>(<span class="c-str">'#btn'</span>).<span class="c-fn">click</span>(<span class="c-key">function</span>(<span class="c-var">e</span>) {
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'clicked'</span>);
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-fn">$</span>(<span class="c-key">this</span>));                <span class="c-comment">// this = HTML element, $(this) = jQuery объект</span>
});

<span class="c-fn">$</span>(<span class="c-str">'#form'</span>).<span class="c-fn">submit</span>(<span class="c-key">function</span>(<span class="c-var">e</span>) {
    <span class="c-var">e</span>.<span class="c-fn">preventDefault</span>();
    <span class="c-comment">// ...</span>
});

<span class="c-fn">$</span>(<span class="c-str">'input'</span>).<span class="c-fn">change</span>(<span class="c-fn">handler</span>);
<span class="c-fn">$</span>(<span class="c-str">'input'</span>).<span class="c-fn">focus</span>(<span class="c-fn">handler</span>);
<span class="c-fn">$</span>(<span class="c-str">'input'</span>).<span class="c-fn">blur</span>(<span class="c-fn">handler</span>);
<span class="c-fn">$</span>(<span class="c-str">'input'</span>).<span class="c-fn">keyup</span>(<span class="c-fn">handler</span>);
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">hover</span>(<span class="c-fn">enterFn</span>, <span class="c-fn">leaveFn</span>);         <span class="c-comment">// mouseenter + mouseleave</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title"> <code>.on()</code> — универсальный + delegated events</h3>
    <pre><code><span class="c-comment">// Стандартная привязка</span>
<span class="c-fn">$</span>(<span class="c-str">'#btn'</span>).<span class="c-fn">on</span>(<span class="c-str">'click'</span>, <span class="c-fn">handler</span>);

<span class="c-comment">// Несколько событий сразу</span>
<span class="c-fn">$</span>(<span class="c-str">'input'</span>).<span class="c-fn">on</span>(<span class="c-str">'focus blur'</span>, <span class="c-fn">handler</span>);

<span class="c-comment">// С namespace — удобно для удаления только своих listener</span>
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">on</span>(<span class="c-str">'click.myapp'</span>, <span class="c-fn">handler</span>);
<span class="c-fn">$</span>(<span class="c-str">'.el'</span>).<span class="c-fn">off</span>(<span class="c-str">'.myapp'</span>);                    <span class="c-comment">// удалить только с namespace myapp</span>

<span class="c-comment">//  DELEGATED events — критично для динамических элементов
// Событие вешается на РОДИТЕЛЯ но срабатывает только на потомках с селектором</span>
<span class="c-fn">$</span>(<span class="c-str">'#user-list'</span>).<span class="c-fn">on</span>(<span class="c-str">'click'</span>, <span class="c-str">'.delete-btn'</span>, <span class="c-key">function</span>(<span class="c-var">e</span>) {
    <span class="c-key">const</span> <span class="c-var">id</span> = <span class="c-fn">$</span>(<span class="c-key">this</span>).<span class="c-fn">data</span>(<span class="c-str">'id'</span>);
    <span class="c-fn">deleteUser</span>(<span class="c-var">id</span>);
});
<span class="c-comment">// Плюс: работает для НОВЫХ .delete-btn добавленных после привязки — критично при AJAX-подгрузке</span>

<span class="c-comment">// Удалить</span>
<span class="c-fn">$</span>(<span class="c-str">'#btn'</span>).<span class="c-fn">off</span>(<span class="c-str">'click'</span>);
<span class="c-fn">$</span>(<span class="c-str">'#btn'</span>).<span class="c-fn">off</span>();                            <span class="c-comment">// все события</span></code></pre>
    <div class="remember-box">
      <strong> Ключевое отличие</strong> <code>.click()</code> и <code>.on('click', ...)</code>: <br>
      <code>.click()</code> — сокращённая версия, работает ТОЛЬКО на существующих элементах. <code>.on('click', '.selector', ...)</code> с делегацией — работает на элементах добавленных ПОСЛЕ (важно при AJAX-подгрузке).
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-jq-ajax" class="section">
  <div class="section-title">jQuery: AJAX</div>

  <div class="subsection">
    <h3 class="subsection-title">$.get / $.post — короткие формы</h3>
    <pre><code><span class="c-comment">// GET</span>
<span class="c-fn">$</span>.<span class="c-fn">get</span>(<span class="c-str">'/api/users'</span>, <span class="c-key">function</span>(<span class="c-var">data</span>) {
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">data</span>);   <span class="c-comment">// уже распарсенный JSON (если сервер вернул application/json)</span>
});

<span class="c-comment">// POST</span>
<span class="c-fn">$</span>.<span class="c-fn">post</span>(<span class="c-str">'/api/users'</span>, {
    <span class="c-var">name</span>: <span class="c-str">'Alice'</span>,
    <span class="c-var">email</span>: <span class="c-str">'a@x.kz'</span>,
}, <span class="c-key">function</span>(<span class="c-var">response</span>) {
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'Created:'</span>, <span class="c-var">response</span>);
});

<span class="c-comment">// getJSON — синоним $.get с dataType:'json'</span>
<span class="c-fn">$</span>.<span class="c-fn">getJSON</span>(<span class="c-str">'/api/users'</span>, <span class="c-fn">handleUsers</span>);</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title"> $.ajax() — полный контроль</h3>
    <pre><code><span class="c-fn">$</span>.<span class="c-fn">ajax</span>({
    <span class="c-var">url</span>: <span class="c-str">'/api/users'</span>,
    <span class="c-var">method</span>: <span class="c-str">'POST'</span>,                                    <span class="c-comment">// или type в старых версиях</span>
    <span class="c-var">data</span>: <span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>({ <span class="c-var">name</span>: <span class="c-str">'Alice'</span> }),
    <span class="c-var">contentType</span>: <span class="c-str">'application/json'</span>,                    <span class="c-comment">// что ОТПРАВЛЯЕМ</span>
    <span class="c-var">dataType</span>: <span class="c-str">'json'</span>,                                  <span class="c-comment">// что ОЖИДАЕМ</span>
    <span class="c-var">headers</span>: {
        <span class="c-str">'X-CSRF-TOKEN'</span>: <span class="c-fn">$</span>(<span class="c-str">'meta[name="csrf-token"]'</span>).<span class="c-fn">attr</span>(<span class="c-str">'content'</span>),
    },
    <span class="c-var">success</span>: <span class="c-key">function</span>(<span class="c-var">data</span>, <span class="c-var">textStatus</span>, <span class="c-var">jqXHR</span>) {
        <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'OK'</span>, <span class="c-var">data</span>);
    },
    <span class="c-var">error</span>: <span class="c-key">function</span>(<span class="c-var">jqXHR</span>, <span class="c-var">textStatus</span>, <span class="c-var">errorThrown</span>) {
        <span class="c-fn">console</span>.<span class="c-fn">error</span>(<span class="c-str">'Failed:'</span>, <span class="c-var">jqXHR</span>.<span class="c-var">status</span>, <span class="c-var">errorThrown</span>);
    },
    <span class="c-var">complete</span>: <span class="c-key">function</span>() {
        <span class="c-comment">// Всегда — успех или ошибка</span>
    },
});

<span class="c-comment">// Или через Promise-стиль (jQuery 1.5+)</span>
<span class="c-fn">$</span>.<span class="c-fn">ajax</span>({ <span class="c-var">url</span>: <span class="c-str">'/api/users'</span> })
    .<span class="c-fn">done</span>(<span class="c-var">data</span> =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">data</span>))
    .<span class="c-fn">fail</span>(<span class="c-var">err</span> =&gt; <span class="c-fn">console</span>.<span class="c-fn">error</span>(<span class="c-var">err</span>))
    .<span class="c-fn">always</span>(() =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'done'</span>));</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Отправка формы через AJAX + serialize</h3>
    <pre><code><span class="c-fn">$</span>(<span class="c-str">'#login-form'</span>).<span class="c-fn">on</span>(<span class="c-str">'submit'</span>, <span class="c-key">function</span>(<span class="c-var">e</span>) {
    <span class="c-var">e</span>.<span class="c-fn">preventDefault</span>();

    <span class="c-fn">$</span>.<span class="c-fn">ajax</span>({
        <span class="c-var">url</span>: <span class="c-fn">$</span>(<span class="c-key">this</span>).<span class="c-fn">attr</span>(<span class="c-str">'action'</span>),
        <span class="c-var">method</span>: <span class="c-fn">$</span>(<span class="c-key">this</span>).<span class="c-fn">attr</span>(<span class="c-str">'method'</span>),
        <span class="c-var">data</span>: <span class="c-fn">$</span>(<span class="c-key">this</span>).<span class="c-fn">serialize</span>(),                    <span class="c-comment">// "name=Alice&amp;email=a@x.kz"</span>
        <span class="c-var">success</span>: <span class="c-key">function</span>(<span class="c-var">response</span>) {
            <span class="c-fn">$</span>(<span class="c-str">'#status'</span>).<span class="c-fn">text</span>(<span class="c-str">'Успех!'</span>);
        },
    });
});

<span class="c-comment">// Или serializeArray → массив объектов</span>
<span class="c-fn">$</span>(<span class="c-str">'#form'</span>).<span class="c-fn">serializeArray</span>();
<span class="c-comment">// [{name:'email', value:'a@x.kz'}, {name:'password', value:'123'}]</span></code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-jq-vs-js" class="section">
  <div class="section-title">jQuery vs vanilla JS — сравнение</div>

  <div class="subsection">
    <p class="text">Ключевые операции — что уходит если убрать jQuery. Полезно знать оба, чтобы <strong>переводить legacy код в современный</strong>.</p>

    <table class="data-table">
      <thead><tr><th>Задача</th><th>jQuery</th><th>Vanilla JS</th></tr></thead>
      <tbody>
        <tr>
          <td>Найти по ID</td>
          <td><code>$('#header')</code></td>
          <td><code>document.getElementById('header')</code></td>
        </tr>
        <tr>
          <td>Найти по классу</td>
          <td><code>$('.btn')</code></td>
          <td><code>document.querySelectorAll('.btn')</code></td>
        </tr>
        <tr>
          <td>Клик listener</td>
          <td><code>$('.b').click(fn)</code></td>
          <td><code>el.addEventListener('click', fn)</code></td>
        </tr>
        <tr>
          <td>Delegated event</td>
          <td><code>$('#p').on('click', '.b', fn)</code></td>
          <td><code>p.addEventListener('click', e =&gt; e.target.matches('.b') &amp;&amp; fn(e))</code></td>
        </tr>
        <tr>
          <td>Добавить класс</td>
          <td><code>$('.el').addClass('a')</code></td>
          <td><code>el.classList.add('a')</code></td>
        </tr>
        <tr>
          <td>Скрыть</td>
          <td><code>$('.el').hide()</code></td>
          <td><code>el.style.display = 'none'</code></td>
        </tr>
        <tr>
          <td>Установить HTML</td>
          <td><code>$('.el').html('...')</code></td>
          <td><code>el.innerHTML = '...'</code></td>
        </tr>
        <tr>
          <td>Установить текст</td>
          <td><code>$('.el').text('...')</code></td>
          <td><code>el.textContent = '...'</code></td>
        </tr>
        <tr>
          <td>Атрибут</td>
          <td><code>$('.el').attr('href', '/x')</code></td>
          <td><code>el.setAttribute('href', '/x')</code></td>
        </tr>
        <tr>
          <td>AJAX GET</td>
          <td><code>$.get('/api', fn)</code></td>
          <td><code>fetch('/api').then(r =&gt; r.json()).then(fn)</code></td>
        </tr>
        <tr>
          <td>AJAX POST</td>
          <td><code>$.post('/api', data, fn)</code></td>
          <td><code>fetch('/api', {method:'POST', body:JSON.stringify(data)})</code></td>
        </tr>
        <tr>
          <td>DOM ready</td>
          <td><code>$(function(){...})</code></td>
          <td><code>document.addEventListener('DOMContentLoaded', fn)</code></td>
        </tr>
        <tr>
          <td>Итерация</td>
          <td><code>$('.item').each((i, el) =&gt; ...)</code></td>
          <td><code>document.querySelectorAll('.item').forEach(el =&gt; ...)</code></td>
        </tr>
      </tbody>
    </table>

    <div class="remember-box">
      <strong>Что даёт jQuery уникального:</strong>
      <ul style="margin:6px 0 0 20px">
        <li><strong>Delegated events</strong> в одну строку (в vanilla нужно писать вручную)</li>
        <li><strong>Кросс-браузерность</strong> для древних IE (сейчас не актуально)</li>
        <li><strong>Chaining</strong> — <code>.addClass().attr().fadeIn()</code></li>
        <li><strong>Анимации</strong> из коробки — <code>fadeIn</code>, <code>slideDown</code></li>
        <li><strong>Плагины</strong> — тысячи готовых компонентов (slider, datepicker и т.п.)</li>
      </ul>
    </div>
  </div>
</div>

<!-- ═══════════ PHP INTEGRATION ═══════════ -->
<div id="sec-php-form" class="section">
  <div class="section-title">Форма → PHP (классика, без AJAX)</div>

  <div class="subsection">
    <p class="text">Самый базовый способ: HTML-форма отправляет данные, страница перезагружается, PHP обрабатывает.</p>

    <h3 class="subsection-title">HTML</h3>
    <pre><code>&lt;<span class="c-key">form</span> <span class="c-var">action</span>=<span class="c-str">"/save.php"</span> <span class="c-var">method</span>=<span class="c-str">"POST"</span>&gt;
    &lt;<span class="c-key">input</span> <span class="c-var">name</span>=<span class="c-str">"name"</span> <span class="c-var">type</span>=<span class="c-str">"text"</span>&gt;
    &lt;<span class="c-key">input</span> <span class="c-var">name</span>=<span class="c-str">"email"</span> <span class="c-var">type</span>=<span class="c-str">"email"</span>&gt;
    &lt;<span class="c-key">button</span> <span class="c-var">type</span>=<span class="c-str">"submit"</span>&gt;Save&lt;/<span class="c-key">button</span>&gt;
&lt;/<span class="c-key">form</span>&gt;</code></pre>

    <h3 class="subsection-title">save.php</h3>
    <pre><code>&lt;?<span class="c-key">php</span>
<span class="c-comment">// Данные приходят в $_POST (для method="POST")</span>
<span class="c-var">$name</span>  = <span class="c-var">$_POST</span>[<span class="c-str">'name'</span>]  ?? <span class="c-str">''</span>;
<span class="c-var">$email</span> = <span class="c-var">$_POST</span>[<span class="c-str">'email'</span>] ?? <span class="c-str">''</span>;

<span class="c-comment">// Валидация</span>
<span class="c-key">if</span> (!<span class="c-fn">filter_var</span>(<span class="c-var">$email</span>, <span class="c-constant">FILTER_VALIDATE_EMAIL</span>)) {
    <span class="c-fn">http_response_code</span>(<span class="c-num">400</span>);
    <span class="c-key">exit</span>(<span class="c-str">'Invalid email'</span>);
}

<span class="c-comment">// Сохранение (пример через PDO)</span>
<span class="c-var">$stmt</span> = <span class="c-var">$pdo</span>-&gt;<span class="c-fn">prepare</span>(<span class="c-str">'INSERT INTO users (name, email) VALUES (?, ?)'</span>);
<span class="c-var">$stmt</span>-&gt;<span class="c-fn">execute</span>([<span class="c-var">$name</span>, <span class="c-var">$email</span>]);

<span class="c-comment">// Redirect назад</span>
<span class="c-fn">header</span>(<span class="c-str">'Location: /users.php'</span>);
<span class="c-key">exit</span>;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Суперглобальные массивы PHP — куда попадают данные</h3>
    <table class="data-table">
      <thead><tr><th>Массив</th><th>Источник</th></tr></thead>
      <tbody>
        <tr><td><code>$_GET</code></td><td>Query string (<code>?name=x</code>) — для method="GET"</td></tr>
        <tr><td><code>$_POST</code></td><td>Тело POST-запроса (form-urlencoded или multipart)</td></tr>
        <tr><td><code>$_FILES</code></td><td>Загруженные файлы через <code>&lt;input type="file"&gt;</code></td></tr>
        <tr><td><code>$_REQUEST</code></td><td>GET + POST + COOKIE (не надёжно, лучше явно)</td></tr>
        <tr><td><code>$_COOKIE</code></td><td>Cookie от браузера</td></tr>
        <tr><td><code>$_SESSION</code></td><td>Данные сессии (после <code>session_start()</code>)</td></tr>
        <tr><td><code>$_SERVER</code></td><td>Заголовки, метод, путь и т.п.</td></tr>
        <tr><td><code>file_get_contents('php://input')</code></td><td> Сырое тело — для JSON POST (см. следующий раздел)</td></tr>
      </tbody>
    </table>
    <div class="pitfall">
      <strong>⚠</strong> <code>$_POST</code> заполняется только для <code>Content-Type: application/x-www-form-urlencoded</code> или <code>multipart/form-data</code>. Если фронт шлёт JSON (<code>application/json</code>) — <code>$_POST</code> будет ПУСТ, нужно читать через <code>php://input</code>.
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-php-fetch" class="section">
  <div class="section-title">Fetch (vanilla JS) → PHP → JSON</div>

  <div class="subsection">
    <h3 class="subsection-title">Frontend — vanilla JS</h3>
    <pre><code><span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">'/api/user.php'</span>, {
    <span class="c-var">method</span>: <span class="c-str">'POST'</span>,
    <span class="c-var">headers</span>: { <span class="c-str">'Content-Type'</span>: <span class="c-str">'application/json'</span> },
    <span class="c-var">body</span>: <span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>({ <span class="c-var">name</span>: <span class="c-str">'Alice'</span>, <span class="c-var">email</span>: <span class="c-str">'a@x.kz'</span> }),
});

<span class="c-key">if</span> (!<span class="c-var">res</span>.<span class="c-var">ok</span>) {
    <span class="c-key">throw</span> <span class="c-key">new</span> <span class="c-fn">Error</span>(<span class="c-str">`HTTP ${res.status}`</span>);
}

<span class="c-key">const</span> <span class="c-var">data</span> = <span class="c-key">await</span> <span class="c-var">res</span>.<span class="c-fn">json</span>();
<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">data</span>);   <span class="c-comment">// { success: true, id: 42 }</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Backend — user.php</h3>
    <pre><code>&lt;?<span class="c-key">php</span>
<span class="c-fn">header</span>(<span class="c-str">'Content-Type: application/json; charset=utf-8'</span>);

<span class="c-comment">//  JSON приходит в raw body — читаем через php://input</span>
<span class="c-var">$input</span> = <span class="c-fn">json_decode</span>(<span class="c-fn">file_get_contents</span>(<span class="c-str">'php://input'</span>), <span class="c-key">true</span>);

<span class="c-key">if</span> (!<span class="c-var">$input</span>) {
    <span class="c-fn">http_response_code</span>(<span class="c-num">400</span>);
    <span class="c-key">echo</span> <span class="c-fn">json_encode</span>([<span class="c-str">'error'</span> =&gt; <span class="c-str">'Invalid JSON'</span>]);
    <span class="c-key">exit</span>;
}

<span class="c-var">$name</span>  = <span class="c-var">$input</span>[<span class="c-str">'name'</span>]  ?? <span class="c-str">''</span>;
<span class="c-var">$email</span> = <span class="c-var">$input</span>[<span class="c-str">'email'</span>] ?? <span class="c-str">''</span>;

<span class="c-comment">// Валидация</span>
<span class="c-key">if</span> (!<span class="c-fn">filter_var</span>(<span class="c-var">$email</span>, <span class="c-constant">FILTER_VALIDATE_EMAIL</span>)) {
    <span class="c-fn">http_response_code</span>(<span class="c-num">422</span>);
    <span class="c-key">echo</span> <span class="c-fn">json_encode</span>([<span class="c-str">'error'</span> =&gt; <span class="c-str">'Invalid email'</span>]);
    <span class="c-key">exit</span>;
}

<span class="c-comment">// Сохранение</span>
<span class="c-var">$stmt</span> = <span class="c-var">$pdo</span>-&gt;<span class="c-fn">prepare</span>(<span class="c-str">'INSERT INTO users (name, email) VALUES (?, ?)'</span>);
<span class="c-var">$stmt</span>-&gt;<span class="c-fn">execute</span>([<span class="c-var">$name</span>, <span class="c-var">$email</span>]);

<span class="c-comment">// Ответ</span>
<span class="c-key">echo</span> <span class="c-fn">json_encode</span>([
    <span class="c-str">'success'</span> =&gt; <span class="c-key">true</span>,
    <span class="c-str">'id'</span> =&gt; <span class="c-var">$pdo</span>-&gt;<span class="c-fn">lastInsertId</span>(),
], <span class="c-constant">JSON_UNESCAPED_UNICODE</span>);</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title"> Ключевые правила</h3>
    <ul style="line-height:1.9;margin-left:20px">
      <li><strong>PHP всегда шлёт <code>Content-Type: application/json</code></strong> первой строкой — иначе браузер посчитает ответ HTML</li>
      <li><strong>JSON приходит через <code>php://input</code></strong>, не через <code>$_POST</code></li>
      <li><strong>Статусы:</strong> 200 OK, 400 плохой запрос, 401 нет авторизации, 403 доступ запрещён, 404 не найдено, 422 ошибка валидации, 500 ошибка сервера</li>
      <li><strong>Всегда <code>exit</code> после <code>echo json_encode</code></strong> — чтобы не примешать случайный текст ниже</li>
      <li><strong><code>JSON_UNESCAPED_UNICODE</code></strong> — чтобы русские буквы не превращались в <code>А</code></li>
    </ul>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-php-jquery" class="section">
  <div class="section-title">jQuery AJAX → PHP</div>

  <div class="subsection">
    <h3 class="subsection-title">Вариант 1 — form-urlencoded (проще, PHP читает $_POST)</h3>
    <pre><code><span class="c-fn">$</span>.<span class="c-fn">ajax</span>({
    <span class="c-var">url</span>: <span class="c-str">'/api/save.php'</span>,
    <span class="c-var">method</span>: <span class="c-str">'POST'</span>,
    <span class="c-var">data</span>: { <span class="c-var">name</span>: <span class="c-str">'Alice'</span>, <span class="c-var">email</span>: <span class="c-str">'a@x.kz'</span> },
    <span class="c-comment">// contentType не указан → jQuery шлёт application/x-www-form-urlencoded</span>
    <span class="c-var">dataType</span>: <span class="c-str">'json'</span>,                    <span class="c-comment">// ждём JSON в ответ</span>
    <span class="c-var">success</span>: <span class="c-key">function</span>(<span class="c-var">res</span>) {
        <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">res</span>);
    },
    <span class="c-var">error</span>: <span class="c-key">function</span>(<span class="c-var">jqXHR</span>) {
        <span class="c-fn">console</span>.<span class="c-fn">error</span>(<span class="c-var">jqXHR</span>.<span class="c-var">responseJSON</span>);
    },
});</code></pre>

    <pre><code>&lt;?<span class="c-key">php</span>
<span class="c-comment">// save.php — данные УЖЕ в $_POST</span>
<span class="c-fn">header</span>(<span class="c-str">'Content-Type: application/json'</span>);
<span class="c-var">$name</span>  = <span class="c-var">$_POST</span>[<span class="c-str">'name'</span>]  ?? <span class="c-str">''</span>;
<span class="c-var">$email</span> = <span class="c-var">$_POST</span>[<span class="c-str">'email'</span>] ?? <span class="c-str">''</span>;
<span class="c-key">echo</span> <span class="c-fn">json_encode</span>([<span class="c-str">'ok'</span> =&gt; <span class="c-key">true</span>, <span class="c-str">'received'</span> =&gt; <span class="c-fn">compact</span>(<span class="c-str">'name'</span>, <span class="c-str">'email'</span>)]);</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Вариант 2 — JSON body (нужно php://input в PHP)</h3>
    <pre><code><span class="c-fn">$</span>.<span class="c-fn">ajax</span>({
    <span class="c-var">url</span>: <span class="c-str">'/api/save.php'</span>,
    <span class="c-var">method</span>: <span class="c-str">'POST'</span>,
    <span class="c-var">contentType</span>: <span class="c-str">'application/json'</span>,          <span class="c-comment">// ← ЯВНО указываем что шлём JSON</span>
    <span class="c-var">data</span>: <span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>({ <span class="c-var">name</span>: <span class="c-str">'Alice'</span> }),  <span class="c-comment">// ← ОБЯЗАТЕЛЬНО stringify</span>
    <span class="c-var">dataType</span>: <span class="c-str">'json'</span>,
});</code></pre>
    <div class="pitfall">
      <strong>Частая ошибка:</strong> указали <code>contentType: 'application/json'</code>, но забыли <code>JSON.stringify</code> — jQuery отправит <code>[object Object]</code>. Оба параметра идут в паре.
    </div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Отправка формы через jQuery — самое короткое</h3>
    <pre><code><span class="c-fn">$</span>(<span class="c-str">'#user-form'</span>).<span class="c-fn">on</span>(<span class="c-str">'submit'</span>, <span class="c-key">function</span>(<span class="c-var">e</span>) {
    <span class="c-var">e</span>.<span class="c-fn">preventDefault</span>();

    <span class="c-fn">$</span>.<span class="c-fn">ajax</span>({
        <span class="c-var">url</span>: <span class="c-fn">$</span>(<span class="c-key">this</span>).<span class="c-fn">attr</span>(<span class="c-str">'action'</span>),
        <span class="c-var">method</span>: <span class="c-fn">$</span>(<span class="c-key">this</span>).<span class="c-fn">attr</span>(<span class="c-str">'method'</span>),
        <span class="c-var">data</span>: <span class="c-fn">$</span>(<span class="c-key">this</span>).<span class="c-fn">serialize</span>(),   <span class="c-comment">// "name=Alice&email=a@x.kz"</span>
        <span class="c-var">dataType</span>: <span class="c-str">'json'</span>,
    })
    .<span class="c-fn">done</span>(<span class="c-var">res</span> =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'OK'</span>, <span class="c-var">res</span>))
    .<span class="c-fn">fail</span>(<span class="c-var">err</span> =&gt; <span class="c-fn">console</span>.<span class="c-fn">error</span>(<span class="c-str">'FAIL'</span>, <span class="c-var">err</span>));
});</code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-php-upload" class="section">
  <div class="section-title">Загрузка файлов: JS/jQuery → PHP</div>

  <div class="subsection">
    <h3 class="subsection-title">Vanilla JS — FormData</h3>
    <pre><code>&lt;<span class="c-key">input</span> <span class="c-var">type</span>=<span class="c-str">"file"</span> <span class="c-var">id</span>=<span class="c-str">"avatar"</span>&gt;
&lt;<span class="c-key">button</span> <span class="c-var">id</span>=<span class="c-str">"upload"</span>&gt;Upload&lt;/<span class="c-key">button</span>&gt;

&lt;<span class="c-key">script</span>&gt;
<span class="c-fn">document</span>.<span class="c-fn">querySelector</span>(<span class="c-str">'#upload'</span>).<span class="c-fn">addEventListener</span>(<span class="c-str">'click'</span>, <span class="c-key">async</span> () =&gt; {
    <span class="c-key">const</span> <span class="c-var">file</span> = <span class="c-fn">document</span>.<span class="c-fn">querySelector</span>(<span class="c-str">'#avatar'</span>).<span class="c-var">files</span>[<span class="c-num">0</span>];
    <span class="c-key">if</span> (!<span class="c-var">file</span>) <span class="c-key">return</span>;

    <span class="c-key">const</span> <span class="c-var">fd</span> = <span class="c-key">new</span> <span class="c-fn">FormData</span>();
    <span class="c-var">fd</span>.<span class="c-fn">append</span>(<span class="c-str">'avatar'</span>, <span class="c-var">file</span>);
    <span class="c-var">fd</span>.<span class="c-fn">append</span>(<span class="c-str">'user_id'</span>, <span class="c-num">42</span>);

    <span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">'/upload.php'</span>, {
        <span class="c-var">method</span>: <span class="c-str">'POST'</span>,
        <span class="c-var">body</span>: <span class="c-var">fd</span>,     <span class="c-comment">// ⚠ Content-Type НЕ указываем — браузер сам поставит multipart/form-data с boundary</span>
    });
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-key">await</span> <span class="c-var">res</span>.<span class="c-fn">json</span>());
});
&lt;/<span class="c-key">script</span>&gt;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">jQuery — тоже FormData</h3>
    <pre><code><span class="c-key">const</span> <span class="c-var">fd</span> = <span class="c-key">new</span> <span class="c-fn">FormData</span>();
<span class="c-var">fd</span>.<span class="c-fn">append</span>(<span class="c-str">'avatar'</span>, <span class="c-fn">$</span>(<span class="c-str">'#avatar'</span>)[<span class="c-num">0</span>].<span class="c-var">files</span>[<span class="c-num">0</span>]);

<span class="c-fn">$</span>.<span class="c-fn">ajax</span>({
    <span class="c-var">url</span>: <span class="c-str">'/upload.php'</span>,
    <span class="c-var">method</span>: <span class="c-str">'POST'</span>,
    <span class="c-var">data</span>: <span class="c-var">fd</span>,
    <span class="c-var">processData</span>: <span class="c-key">false</span>,    <span class="c-comment">// ⚠ иначе jQuery попробует преобразовать FormData в query string</span>
    <span class="c-var">contentType</span>: <span class="c-key">false</span>,    <span class="c-comment">// ⚠ иначе jQuery поставит свой, а нужен multipart с boundary</span>
    <span class="c-var">success</span>: <span class="c-key">function</span>(<span class="c-var">res</span>) { <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">res</span>); },
});</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">upload.php</h3>
    <pre><code>&lt;?<span class="c-key">php</span>
<span class="c-fn">header</span>(<span class="c-str">'Content-Type: application/json'</span>);

<span class="c-comment">// $_FILES — заполняется автоматически при multipart/form-data</span>
<span class="c-key">if</span> (!<span class="c-fn">isset</span>(<span class="c-var">$_FILES</span>[<span class="c-str">'avatar'</span>]) || <span class="c-var">$_FILES</span>[<span class="c-str">'avatar'</span>][<span class="c-str">'error'</span>] !== <span class="c-constant">UPLOAD_ERR_OK</span>) {
    <span class="c-fn">http_response_code</span>(<span class="c-num">400</span>);
    <span class="c-key">echo</span> <span class="c-fn">json_encode</span>([<span class="c-str">'error'</span> =&gt; <span class="c-str">'Upload failed'</span>]);
    <span class="c-key">exit</span>;
}

<span class="c-var">$file</span> = <span class="c-var">$_FILES</span>[<span class="c-str">'avatar'</span>];
<span class="c-comment">// Структура $_FILES['avatar']:
// name        — оригинальное имя
// type        — MIME (не доверять, определять серверно)
// size        — размер в байтах
// tmp_name    — временный путь
// error       — код ошибки (UPLOAD_ERR_OK = 0)</span>

<span class="c-comment">// Валидация размера</span>
<span class="c-key">if</span> (<span class="c-var">$file</span>[<span class="c-str">'size'</span>] &gt; <span class="c-num">5</span> * <span class="c-num">1024</span> * <span class="c-num">1024</span>) {
    <span class="c-fn">http_response_code</span>(<span class="c-num">413</span>);
    <span class="c-key">echo</span> <span class="c-fn">json_encode</span>([<span class="c-str">'error'</span> =&gt; <span class="c-str">'File too large'</span>]);
    <span class="c-key">exit</span>;
}

<span class="c-comment">// Валидация типа — по СОДЕРЖИМОМУ, не по $file['type']</span>
<span class="c-var">$mime</span> = <span class="c-fn">mime_content_type</span>(<span class="c-var">$file</span>[<span class="c-str">'tmp_name'</span>]);
<span class="c-key">if</span> (!<span class="c-fn">in_array</span>(<span class="c-var">$mime</span>, [<span class="c-str">'image/jpeg'</span>, <span class="c-str">'image/png'</span>, <span class="c-str">'image/webp'</span>], <span class="c-key">true</span>)) {
    <span class="c-fn">http_response_code</span>(<span class="c-num">415</span>);
    <span class="c-key">echo</span> <span class="c-fn">json_encode</span>([<span class="c-str">'error'</span> =&gt; <span class="c-str">'Only JPG/PNG/WebP'</span>]);
    <span class="c-key">exit</span>;
}

<span class="c-comment">// Безопасное имя (нельзя доверять оригинальному имени!)</span>
<span class="c-var">$ext</span>  = <span class="c-fn">pathinfo</span>(<span class="c-var">$file</span>[<span class="c-str">'name'</span>], <span class="c-constant">PATHINFO_EXTENSION</span>);
<span class="c-var">$name</span> = <span class="c-fn">bin2hex</span>(<span class="c-fn">random_bytes</span>(<span class="c-num">16</span>)) . <span class="c-str">'.'</span> . <span class="c-var">$ext</span>;
<span class="c-var">$dest</span> = <span class="c-fn">__DIR__</span> . <span class="c-str">'/uploads/'</span> . <span class="c-var">$name</span>;

<span class="c-comment">// Переместить из tmp в постоянное место</span>
<span class="c-fn">move_uploaded_file</span>(<span class="c-var">$file</span>[<span class="c-str">'tmp_name'</span>], <span class="c-var">$dest</span>);

<span class="c-key">echo</span> <span class="c-fn">json_encode</span>([<span class="c-str">'url'</span> =&gt; <span class="c-str">'/uploads/'</span> . <span class="c-var">$name</span>]);</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Лимиты в php.ini</h3>
    <table class="data-table">
      <thead><tr><th>Директива</th><th>Что</th><th>Дефолт</th></tr></thead>
      <tbody>
        <tr><td><code>upload_max_filesize</code></td><td>Макс размер одного файла</td><td>2M</td></tr>
        <tr><td><code>post_max_size</code></td><td>Общий размер POST-запроса (должен быть &gt; upload_max_filesize)</td><td>8M</td></tr>
        <tr><td><code>max_file_uploads</code></td><td>Сколько файлов за один запрос</td><td>20</td></tr>
        <tr><td><code>file_uploads</code></td><td>Разрешена ли загрузка вообще</td><td>On</td></tr>
      </tbody>
    </table>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-php-embed" class="section">
  <div class="section-title">PHP → JS (передача данных из бэка во фронт)</div>

  <div class="subsection">
    <h3 class="subsection-title">Способ 1 — inline через <code>&lt;?= json_encode() ?&gt;</code></h3>
    <p class="text">Самый частый способ — сгенерировать JS-переменную прямо в HTML.</p>
    <pre><code>&lt;?<span class="c-key">php</span>
<span class="c-var">$user</span> = [<span class="c-str">'id'</span> =&gt; <span class="c-num">42</span>, <span class="c-str">'name'</span> =&gt; <span class="c-str">'Alice'</span>, <span class="c-str">'is_admin'</span> =&gt; <span class="c-key">true</span>];
?&gt;

&lt;<span class="c-key">script</span>&gt;
    <span class="c-comment">// json_encode превращает PHP-массив в JS-объект</span>
    <span class="c-key">const</span> <span class="c-var">CURRENT_USER</span> = &lt;?= <span class="c-fn">json_encode</span>(<span class="c-var">$user</span>, <span class="c-constant">JSON_UNESCAPED_UNICODE</span> | <span class="c-constant">JSON_HEX_TAG</span>) ?&gt;;
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">CURRENT_USER</span>.<span class="c-var">name</span>);   <span class="c-comment">// 'Alice'</span>
&lt;/<span class="c-key">script</span>&gt;</code></pre>

    <div class="pitfall">
      <strong>⚠ XSS-риск:</strong> если <code>$user</code> содержит строку типа <code>&lt;/script&gt;&lt;script&gt;alert(1)&lt;/script&gt;</code> — она разорвёт твой скрипт. <br>
      Флаги <code>JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT</code> экранируют опасные символы.
    </div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Способ 2 — data-атрибуты HTML</h3>
    <p class="text">Данные привязаны к конкретному DOM-элементу — чище, безопаснее.</p>
    <pre><code>&lt;<span class="c-key">div</span>
    <span class="c-var">id</span>=<span class="c-str">"user-card"</span>
    <span class="c-var">data-user-id</span>=<span class="c-str">"&lt;?= (int)$user['id'] ?&gt;"</span>
    <span class="c-var">data-user-name</span>=<span class="c-str">"&lt;?= htmlspecialchars($user['name']) ?&gt;"</span>
&gt;
    ...
&lt;/<span class="c-key">div</span>&gt;

&lt;<span class="c-key">script</span>&gt;
    <span class="c-key">const</span> <span class="c-var">card</span> = <span class="c-fn">document</span>.<span class="c-fn">querySelector</span>(<span class="c-str">'#user-card'</span>);
    <span class="c-key">const</span> <span class="c-var">userId</span>   = <span class="c-var">card</span>.<span class="c-var">dataset</span>.<span class="c-var">userId</span>;
    <span class="c-key">const</span> <span class="c-var">userName</span> = <span class="c-var">card</span>.<span class="c-var">dataset</span>.<span class="c-var">userName</span>;

    <span class="c-comment">// jQuery</span>
    <span class="c-key">const</span> <span class="c-var">id</span> = <span class="c-fn">$</span>(<span class="c-str">'#user-card'</span>).<span class="c-fn">data</span>(<span class="c-str">'user-id'</span>);
&lt;/<span class="c-key">script</span>&gt;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Способ 3 — отдельный JSON endpoint (лучший для SPA)</h3>
    <pre><code><span class="c-comment">// current-user.php</span>
&lt;?<span class="c-key">php</span>
<span class="c-fn">header</span>(<span class="c-str">'Content-Type: application/json'</span>);
<span class="c-key">echo</span> <span class="c-fn">json_encode</span>(<span class="c-var">$_SESSION</span>[<span class="c-str">'user'</span>] ?? <span class="c-key">null</span>);</code></pre>
    <pre><code><span class="c-comment">// index.html</span>
&lt;<span class="c-key">script</span>&gt;
    <span class="c-key">const</span> <span class="c-var">user</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">'/current-user.php'</span>).<span class="c-fn">then</span>(<span class="c-var">r</span> =&gt; <span class="c-var">r</span>.<span class="c-fn">json</span>());
&lt;/<span class="c-key">script</span>&gt;</code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-php-csrf" class="section">
  <div class="section-title">CSRF без Laravel — своими руками</div>

  <div class="subsection">
    <p class="text">Laravel даёт CSRF из коробки. На чистом PHP делаем сами через session.</p>

    <h3 class="subsection-title">1. Генерация токена + вставка в HTML</h3>
    <pre><code>&lt;?<span class="c-key">php</span>
<span class="c-fn">session_start</span>();

<span class="c-comment">// Токен на всю сессию (или регенерить на каждый запрос — параноидальнее)</span>
<span class="c-key">if</span> (<span class="c-fn">empty</span>(<span class="c-var">$_SESSION</span>[<span class="c-str">'csrf'</span>])) {
    <span class="c-var">$_SESSION</span>[<span class="c-str">'csrf'</span>] = <span class="c-fn">bin2hex</span>(<span class="c-fn">random_bytes</span>(<span class="c-num">32</span>));
}
?&gt;

&lt;<span class="c-key">meta</span> <span class="c-var">name</span>=<span class="c-str">"csrf-token"</span> <span class="c-var">content</span>=<span class="c-str">"&lt;?= $_SESSION['csrf'] ?&gt;"</span>&gt;

&lt;<span class="c-key">form</span> <span class="c-var">action</span>=<span class="c-str">"/save.php"</span> <span class="c-var">method</span>=<span class="c-str">"POST"</span>&gt;
    &lt;<span class="c-key">input</span> <span class="c-var">type</span>=<span class="c-str">"hidden"</span> <span class="c-var">name</span>=<span class="c-str">"_csrf"</span> <span class="c-var">value</span>=<span class="c-str">"&lt;?= $_SESSION['csrf'] ?&gt;"</span>&gt;
    ...
&lt;/<span class="c-key">form</span>&gt;</code></pre>

    <h3 class="subsection-title">2. Проверка в PHP-обработчике</h3>
    <pre><code>&lt;?<span class="c-key">php</span>
<span class="c-fn">session_start</span>();

<span class="c-comment">// Токен может прийти либо из формы, либо из header (для AJAX)</span>
<span class="c-var">$token</span> = <span class="c-var">$_POST</span>[<span class="c-str">'_csrf'</span>]
    ?? <span class="c-var">$_SERVER</span>[<span class="c-str">'HTTP_X_CSRF_TOKEN'</span>]
    ?? <span class="c-str">''</span>;

<span class="c-comment">// hash_equals — защита от timing attack, НЕЛЬЗЯ использовать ===</span>
<span class="c-key">if</span> (!<span class="c-fn">hash_equals</span>(<span class="c-var">$_SESSION</span>[<span class="c-str">'csrf'</span>] ?? <span class="c-str">''</span>, <span class="c-var">$token</span>)) {
    <span class="c-fn">http_response_code</span>(<span class="c-num">419</span>);
    <span class="c-key">exit</span>(<span class="c-str">'CSRF token mismatch'</span>);
}

<span class="c-comment">// ... обработка</span></code></pre>

    <h3 class="subsection-title">3. Frontend — отправка токена</h3>
    <pre><code><span class="c-comment">// jQuery — глобально для всех AJAX</span>
<span class="c-fn">$</span>.<span class="c-fn">ajaxSetup</span>({
    <span class="c-var">headers</span>: {
        <span class="c-str">'X-CSRF-Token'</span>: <span class="c-fn">$</span>(<span class="c-str">'meta[name="csrf-token"]'</span>).<span class="c-fn">attr</span>(<span class="c-str">'content'</span>),
    },
});

<span class="c-comment">// Vanilla JS — руками для каждого fetch</span>
<span class="c-key">const</span> <span class="c-var">csrf</span> = <span class="c-fn">document</span>.<span class="c-fn">querySelector</span>(<span class="c-str">'meta[name="csrf-token"]'</span>).<span class="c-var">content</span>;
<span class="c-fn">fetch</span>(<span class="c-str">'/save.php'</span>, {
    <span class="c-var">method</span>: <span class="c-str">'POST'</span>,
    <span class="c-var">headers</span>: {
        <span class="c-str">'Content-Type'</span>: <span class="c-str">'application/json'</span>,
        <span class="c-str">'X-CSRF-Token'</span>: <span class="c-var">csrf</span>,
    },
    <span class="c-var">body</span>: <span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">data</span>),
});</code></pre>

    <div class="remember-box">
      <strong>Ключевое:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Токен хранится в <code>$_SESSION</code> — недоступен для JS с другого домена</li>
        <li>При каждом запросе фронт шлёт токен → PHP сверяет с сессией</li>
        <li>Атакующий с другого сайта не может узнать токен → не сможет подделать запрос</li>
        <li>Сравнение через <code>hash_equals()</code>, не через <code>===</code> — защита от timing attack</li>
        <li>Cookie сессии — обязательно с <code>httponly=true</code>, <code>samesite=Lax/Strict</code></li>
      </ul>
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-fs-ajax-laravel" class="section">
  <div class="section-title">Интеграция: jQuery AJAX ↔ Laravel</div>

  <div class="subsection">
    <h3 class="subsection-title">Полный поток — форма логина</h3>

    <p class="text"><strong>1. Frontend (blade + jQuery)</strong></p>
    <pre><code>&lt;<span class="c-key">meta</span> <span class="c-var">name</span>=<span class="c-str">"csrf-token"</span> <span class="c-var">content</span>=<span class="c-str">"{{ csrf_token() }}"</span>&gt;

&lt;<span class="c-key">form</span> <span class="c-var">id</span>=<span class="c-str">"login-form"</span>&gt;
    &lt;<span class="c-key">input</span> <span class="c-var">name</span>=<span class="c-str">"email"</span> <span class="c-var">type</span>=<span class="c-str">"email"</span>&gt;
    &lt;<span class="c-key">input</span> <span class="c-var">name</span>=<span class="c-str">"password"</span> <span class="c-var">type</span>=<span class="c-str">"password"</span>&gt;
    &lt;<span class="c-key">button</span> <span class="c-var">type</span>=<span class="c-str">"submit"</span>&gt;Login&lt;/<span class="c-key">button</span>&gt;
    &lt;<span class="c-key">div</span> <span class="c-var">id</span>=<span class="c-str">"errors"</span>&gt;&lt;/<span class="c-key">div</span>&gt;
&lt;/<span class="c-key">form</span>&gt;

&lt;<span class="c-key">script</span>&gt;
<span class="c-fn">$</span>(<span class="c-key">function</span>() {
    <span class="c-fn">$</span>.<span class="c-fn">ajaxSetup</span>({                                        <span class="c-comment">// Один раз глобально</span>
        <span class="c-var">headers</span>: {
            <span class="c-str">'X-CSRF-TOKEN'</span>: <span class="c-fn">$</span>(<span class="c-str">'meta[name="csrf-token"]'</span>).<span class="c-fn">attr</span>(<span class="c-str">'content'</span>),
        },
    });

    <span class="c-fn">$</span>(<span class="c-str">'#login-form'</span>).<span class="c-fn">on</span>(<span class="c-str">'submit'</span>, <span class="c-key">function</span>(<span class="c-var">e</span>) {
        <span class="c-var">e</span>.<span class="c-fn">preventDefault</span>();
        <span class="c-fn">$</span>(<span class="c-str">'#errors'</span>).<span class="c-fn">empty</span>();

        <span class="c-fn">$</span>.<span class="c-fn">ajax</span>({
            <span class="c-var">url</span>: <span class="c-str">'/api/login'</span>,
            <span class="c-var">method</span>: <span class="c-str">'POST'</span>,
            <span class="c-var">data</span>: <span class="c-fn">$</span>(<span class="c-key">this</span>).<span class="c-fn">serialize</span>(),
            <span class="c-var">dataType</span>: <span class="c-str">'json'</span>,
            <span class="c-var">success</span>: <span class="c-key">function</span>(<span class="c-var">res</span>) {
                <span class="c-fn">window</span>.<span class="c-fn">location</span>.<span class="c-var">href</span> = <span class="c-str">'/dashboard'</span>;
            },
            <span class="c-var">error</span>: <span class="c-key">function</span>(<span class="c-var">jqXHR</span>) {
                <span class="c-key">if</span> (<span class="c-var">jqXHR</span>.<span class="c-var">status</span> === <span class="c-num">422</span>) {                    <span class="c-comment">// Laravel validation errors</span>
                    <span class="c-key">const</span> <span class="c-var">errors</span> = <span class="c-var">jqXHR</span>.<span class="c-var">responseJSON</span>.<span class="c-var">errors</span>;
                    <span class="c-fn">$</span>.<span class="c-fn">each</span>(<span class="c-var">errors</span>, <span class="c-key">function</span>(<span class="c-var">field</span>, <span class="c-var">msgs</span>) {
                        <span class="c-fn">$</span>(<span class="c-str">'#errors'</span>).<span class="c-fn">append</span>(<span class="c-str">`&lt;p&gt;${msgs[0]}&lt;/p&gt;`</span>);
                    });
                } <span class="c-key">else</span> {
                    <span class="c-fn">alert</span>(<span class="c-str">'Ошибка: '</span> + <span class="c-var">jqXHR</span>.<span class="c-var">status</span>);
                }
            },
        });
    });
});
&lt;/<span class="c-key">script</span>&gt;</code></pre>

    <p class="text"><strong>2. Backend (Laravel Controller)</strong></p>
    <pre><code><span class="c-key">public function</span> <span class="c-fn">login</span>(<span class="c-type">LoginRequest</span> <span class="c-var">$request</span>): <span class="c-type">JsonResponse</span>
{
    <span class="c-key">if</span> (! <span class="c-type">Auth</span>::<span class="c-fn">attempt</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>())) {
        <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>([
            <span class="c-str">'message'</span> =&gt; <span class="c-str">'Invalid credentials'</span>,
        ], <span class="c-num">401</span>);
    }

    <span class="c-var">$request</span>-&gt;<span class="c-fn">session</span>()-&gt;<span class="c-fn">regenerate</span>();

    <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>([
        <span class="c-str">'user'</span> =&gt; <span class="c-type">Auth</span>::<span class="c-fn">user</span>(),
        <span class="c-str">'redirect'</span> =&gt; <span class="c-str">'/dashboard'</span>,
    ]);
}

<span class="c-key">public function</span> <span class="c-fn">rules</span>(): <span class="c-key">array</span>
{
    <span class="c-key">return</span> [
        <span class="c-str">'email'</span> =&gt; <span class="c-str">'required|email'</span>,
        <span class="c-str">'password'</span> =&gt; <span class="c-str">'required|min:8'</span>,
    ];
}</code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-fs-csrf" class="section">
  <div class="section-title">CSRF token в AJAX (Laravel)</div>

  <div class="subsection">
    <p class="text">
      Laravel по умолчанию требует CSRF-токен для всех POST/PUT/DELETE. Если не отправишь — <code>419 Page Expired</code>.
    </p>

    <h3 class="subsection-title">3 способа передать CSRF</h3>

    <p class="text"><strong>Способ 1 — meta тег + $.ajaxSetup (jQuery, глобально)</strong></p>
    <pre><code><span class="c-comment">&lt;!-- в &lt;head&gt; layout --&gt;</span>
&lt;<span class="c-key">meta</span> <span class="c-var">name</span>=<span class="c-str">"csrf-token"</span> <span class="c-var">content</span>=<span class="c-str">"{{ csrf_token() }}"</span>&gt;

<span class="c-comment">// в JS — один раз при загрузке страницы</span>
<span class="c-fn">$</span>.<span class="c-fn">ajaxSetup</span>({
    <span class="c-var">headers</span>: {
        <span class="c-str">'X-CSRF-TOKEN'</span>: <span class="c-fn">$</span>(<span class="c-str">'meta[name="csrf-token"]'</span>).<span class="c-fn">attr</span>(<span class="c-str">'content'</span>),
    },
});

<span class="c-comment">// Все последующие $.ajax / $.post будут отправлять токен автоматически</span></code></pre>

    <p class="text"><strong>Способ 2 — hidden input в форме (@csrf blade директива)</strong></p>
    <pre><code>&lt;<span class="c-key">form</span> <span class="c-var">method</span>=<span class="c-str">"POST"</span>&gt;
    @csrf
    <span class="c-comment">&lt;!-- Blade вставит: &lt;input type="hidden" name="_token" value="..."&gt; --&gt;</span>
    ...
&lt;/<span class="c-key">form</span>&gt;

<span class="c-comment">// при $.serialize() — _token пойдёт вместе с формой</span></code></pre>

    <p class="text"><strong>Способ 3 — vanilla fetch API</strong></p>
    <pre><code><span class="c-key">const</span> <span class="c-var">csrf</span> = <span class="c-fn">document</span>.<span class="c-fn">querySelector</span>(<span class="c-str">'meta[name="csrf-token"]'</span>).<span class="c-var">content</span>;

<span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">'/api/x'</span>, {
    <span class="c-var">method</span>: <span class="c-str">'POST'</span>,
    <span class="c-var">headers</span>: {
        <span class="c-str">'X-CSRF-TOKEN'</span>: <span class="c-var">csrf</span>,
        <span class="c-str">'Content-Type'</span>: <span class="c-str">'application/json'</span>,
        <span class="c-str">'Accept'</span>: <span class="c-str">'application/json'</span>,
    },
    <span class="c-var">body</span>: <span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>(<span class="c-var">data</span>),
});</code></pre>

    <div class="pitfall">
      <strong>⚠ После длительного простоя</strong> — token может протухнуть (session expired). Правильно ловить 419 и делать <code>window.location.reload()</code> для получения нового.
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-fs-interview" class="section">
  <div class="section-title">Частые вопросы</div>

  <div class="subsection">
    <h3 class="subsection-title">15 базовых вопросов JS + jQuery</h3>

    <ol style="line-height:2">
      <li><strong>Разница <code>var</code> / <code>let</code> / <code>const</code></strong> → block vs function scope, hoisting, TDZ, реассигн.</li>
      <li><strong><code>==</code> vs <code>===</code></strong> → strict сравнивает тип+значение, loose приводит типы. В production всегда <code>===</code>.</li>
      <li><strong><code>this</code> в arrow vs обычной function</strong> → arrow берёт lexical <code>this</code>, обычная — зависит от вызова.</li>
      <li><strong>Как работает event delegation</strong> → listener на родителе + <code>e.target.matches()</code>. В jQuery: <code>$('#p').on('click', '.b', fn)</code>. Плюс: работает для новых элементов.</li>
      <li><strong>Promise 3 состояния</strong> → pending / fulfilled / rejected. Один раз переходит и всё.</li>
      <li><strong>async/await vs .then/.catch</strong> → сахар над Promise. Async всегда возвращает Promise. await разворачивает.</li>
      <li><strong>fetch vs $.ajax</strong> → fetch native, jQuery — обёртка + автоопределение JSON. fetch не бросает на 4xx/5xx — надо <code>res.ok</code>.</li>
      <li><strong>Разница <code>textContent</code> и <code>innerHTML</code></strong> → text безопасен, HTML экранируется. innerHTML — риск XSS от user input.</li>
      <li><strong>Как передать CSRF в Laravel через AJAX</strong> → meta[name=csrf-token] + <code>X-CSRF-TOKEN</code> header. Через <code>$.ajaxSetup</code> глобально.</li>
      <li><strong>jQuery <code>.click()</code> vs <code>.on('click', ...)</code></strong> → <code>.click()</code> только на существующие. <code>.on()</code> с делегацией — работает на новые.</li>
      <li><strong>Как отправить форму AJAX'ом</strong> → <code>e.preventDefault()</code> + <code>$(form).serialize()</code> + <code>$.ajax()</code>.</li>
      <li><strong>Что даёт jQuery что в vanilla сложно</strong> → delegated events, chaining, cross-browser (тогда), animation shortcuts.</li>
      <li><strong>Truthy/Falsy</strong> → 6 falsy: false, 0, '', null, undefined, NaN. Всё остальное truthy (включая <code>[]</code> и <code>{}</code>).</li>
      <li><strong>Destructuring + spread</strong> → извлечение полей, дефолты, переименование. Spread для copy/merge.</li>
      <li><strong>Promise.all vs Promise.allSettled</strong> → all падает если один rejected. allSettled ждёт все, возвращает статусы.</li>
    </ol>

  </div>
</div>

</div>
</div>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>
function showSection(id, el) {
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    document.getElementById('sec-' + id).classList.add('active');
    if (el) el.classList.add('active');
    window.scrollTo(0, 0);
    if (window.lucide) lucide.createIcons();
}
if (window.lucide) lucide.createIcons();
</script>
</body>
</html>
@endverbatim
