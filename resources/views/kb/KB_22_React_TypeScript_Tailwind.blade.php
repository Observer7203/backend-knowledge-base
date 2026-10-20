@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>React · TypeScript · Tailwind</title>
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
<script>(function(){try{var d=document.documentElement;var t=localStorage.getItem('kb-theme')||(window.matchMedia&&matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light');d.setAttribute('data-theme',t);if(localStorage.getItem('kb-accent')==='blue')d.setAttribute('data-accent','blue');}catch(e){}})();</script>
<script src="/js/kb.js" defer></script>
</head>
<body>
<div class="container">
<div class="sidebar">
  <a href="/" class="sidebar-back"><i data-lucide="arrow-left"></i> На главную</a>
  <div class="sidebar-title">React · TypeScript · Tailwind</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">React</div>
  <a class="nav-item" onclick="showSection('jsx',this)"><i data-lucide="file-code"></i> JSX и рендеринг</a>
  <a class="nav-item" onclick="showSection('hooks',this)"><i data-lucide="anchor"></i> useState и useEffect</a>
  <a class="nav-item" onclick="showSection('rerender',this)"><i data-lucide="refresh-cw"></i> Перерисовки и мемоизация</a>
  <a class="nav-item" onclick="showSection('state-where',this)"><i data-lucide="layers"></i> Где хранить состояние</a>
  <a class="nav-item" onclick="showSection('custom-hooks',this)"><i data-lucide="puzzle"></i> Свои хуки</a>
  <a class="nav-item" onclick="showSection('lists-forms',this)"><i data-lucide="list"></i> Списки, ключи и формы</a>
  <a class="nav-item" onclick="showSection('context-reducer',this)"><i data-lucide="share-2"></i> Контекст, reducer, ref</a>
  <a class="nav-item" onclick="showSection('data-fetching',this)"><i data-lucide="download-cloud"></i> Загрузка данных</a>

  <div class="nav-group-label">TypeScript</div>
  <a class="nav-item" onclick="showSection('ts-config',this)"><i data-lucide="settings-2"></i> tsconfig и strict</a>
  <a class="nav-item" onclick="showSection('ts-base',this)"><i data-lucide="type"></i> interface, type, дженерики</a>
  <a class="nav-item" onclick="showSection('ts-utils',this)"><i data-lucide="wrench"></i> Утилитарные типы</a>
  <a class="nav-item" onclick="showSection('ts-narrowing',this)"><i data-lucide="filter"></i> Сужение типов</a>
  <a class="nav-item" onclick="showSection('ts-unions',this)"><i data-lucide="git-merge"></i> Размеченные объединения</a>
  <a class="nav-item" onclick="showSection('ts-runtime',this)"><i data-lucide="shield-alert"></i> Типы против валидации</a>
  <a class="nav-item" onclick="showSection('ts-react',this)"><i data-lucide="component"></i> TypeScript в React</a>

  <div class="nav-group-label">Tailwind</div>
  <a class="nav-item" onclick="showSection('tw-config',this)"><i data-lucide="palette"></i> Токены и тёмная тема</a>
  <a class="nav-item" onclick="showSection('tw-base',this)"><i data-lucide="palette"></i> Утилитарный подход</a>
  <a class="nav-item" onclick="showSection('tw-responsive',this)"><i data-lucide="smartphone"></i> Адаптив и состояния</a>
  <a class="nav-item" onclick="showSection('tw-organize',this)"><i data-lucide="boxes"></i> Как не утонуть в классах</a>

  <div class="nav-group-label">Применение</div>
  <a class="nav-item" onclick="showSection('pitfalls',this)"><i data-lucide="alert-octagon"></i> Подводные камни</a>
</div>

<div class="main">
<div class="page-header">
  <h1>React · TypeScript · Tailwind</h1>
  <p>Фронтенд-минимум для backend-разработчика: хуки и причины перерисовок, где какое состояние держать, система типов TypeScript и её граница с рантайм-валидацией, утилитарные классы Tailwind.</p>
  <div class="badge-row">
    <span class="badge">React</span>
    <span class="badge">TypeScript</span>
    <span class="badge">Tailwind</span>
    <span class="badge badge-success">Frontend</span>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>
  <div class="subsection">
    <p class="text">Три технологии, которые почти всегда идут вместе. Разбор сосредоточен на том, что чаще всего ломается: зависимости эффектов, лишние перерисовки, граница между типами и рантаймом, разрастание классов в разметке.</p>
    <div class="remember-box"><strong>Параллель для тех, кто знает Vue.</strong> <code>useState</code> ≈ <code>ref</code>, <code>useEffect</code> ≈ <code>watch</code> + <code>onMounted</code>, <code>useMemo</code> ≈ <code>computed</code>. Главное отличие: во Vue реактивность отслеживается автоматически, в React зависимости перечисляются руками — отсюда почти все баги с устаревшими данными.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-jsx" class="section">
  <div class="section-title">JSX и как React рисует экран</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-code"></i> JSX — это вызовы функций, а не шаблон</div>
    <p class="text">JSX не является частью JavaScript. Сборщик (Vite, esbuild, tsc) превращает его в обычные вызовы функции. Понимать это важно: отсюда следуют все правила — почему атрибут называется <code>className</code>, почему нельзя вернуть два элемента подряд и почему условие пишется выражением, а не оператором.</p>
<pre><code><span class="c-comment">// Что вы пишете</span>
<span class="c-key">const</span> el = &lt;<span class="c-type">button</span> className=<span class="c-str">"btn"</span> onClick={save}&gt;Сохранить&lt;/<span class="c-type">button</span>&gt;;

<span class="c-comment">// Во что это превращается (новый JSX-трансформ, React 17+)</span>
<span class="c-key">import</span> { jsx <span class="c-key">as</span> _jsx } <span class="c-key">from</span> <span class="c-str">'react/jsx-runtime'</span>;
<span class="c-key">const</span> el = <span class="c-fn">_jsx</span>(<span class="c-str">'button'</span>, { className: <span class="c-str">'btn'</span>, onClick: save, children: <span class="c-str">'Сохранить'</span> });

<span class="c-comment">// Результат — обычный объект, описание того, что нужно нарисовать:</span>
<span class="c-comment">// { type: 'button', props: { className: 'btn', onClick: f, children: 'Сохранить' } }</span></code></pre>
    <div class="remember-box"><strong>Ключевая мысль.</strong> Компонент не рисует DOM. Он возвращает <strong>описание</strong> желаемого результата, а React сам решает, какие узлы DOM создать, обновить или удалить. Поэтому один и тот же компонент работает и в браузере, и при серверном рендеринге, и в React Native.</div>
    <table class="data-table">
      <thead><tr><th>В HTML</th><th>В JSX</th><th>Почему</th></tr></thead>
      <tbody>
        <tr><td><code>class</code></td><td><code>className</code></td><td><code>class</code> — зарезервированное слово JavaScript</td></tr>
        <tr><td><code>for</code></td><td><code>htmlFor</code></td><td><code>for</code> — оператор цикла</td></tr>
        <tr><td><code>onclick="..."</code></td><td><code>onClick={fn}</code></td><td>Передаётся функция, а не строка кода</td></tr>
        <tr><td><code>style="color:red"</code></td><td><code>style={{ color: 'red' }}</code></td><td>Объект свойств, имена в camelCase</td></tr>
        <tr><td><code>&lt;!-- … --&gt;</code></td><td><code>{/* … */}</code></td><td>Комментарий — это выражение JavaScript</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="braces"></i> Фигурные скобки: только выражения</div>
    <p class="text">В <code>{}</code> подставляется <strong>выражение</strong> — то, что имеет значение. Оператор <code>if</code> или цикл <code>for</code> значения не имеют, поэтому внутри JSX используют тернарный оператор, <code>&amp;&amp;</code> и <code>map</code>.</p>
<pre><code><span class="c-key">function</span> <span class="c-fn">OrderStatus</span>({ order, user }) {
  <span class="c-key">return</span> (
    &lt;<span class="c-type">div</span>&gt;
      <span class="c-comment">{/* тернарный — когда нужны обе ветки */}</span>
      {order.paid ? &lt;<span class="c-type">Badge</span> kind=<span class="c-str">"ok"</span>&gt;Оплачен&lt;/<span class="c-type">Badge</span>&gt; : &lt;<span class="c-type">Badge</span>&gt;Ожидает оплаты&lt;/<span class="c-type">Badge</span>&gt;}

      <span class="c-comment">{/* && — когда ветка одна */}</span>
      {user.isAdmin &amp;&amp; &lt;<span class="c-type">AdminPanel</span> orderId={order.id} /&gt;}

      <span class="c-comment">{/* список — через map, не через for */}</span>
      &lt;<span class="c-type">ul</span>&gt;
        {order.items.<span class="c-fn">map</span>(item =&gt; &lt;<span class="c-type">li</span> key={item.id}&gt;{item.title}&lt;/<span class="c-type">li</span>&gt;)}
      &lt;/<span class="c-type">ul</span>&gt;
    &lt;/<span class="c-type">div</span>&gt;
  );
}</code></pre>
    <div class="pitfall"><strong>Ноль вместо пустоты.</strong> <code>{items.length &amp;&amp; &lt;List /&gt;}</code> при пустом массиве выведет на экран <code>0</code>: <code>0 &amp;&amp; x</code> возвращает <code>0</code>, а React печатает числа. React не рисует только <code>false</code>, <code>null</code> и <code>undefined</code>. Пишите <code>items.length &gt; 0 &amp;&amp; …</code>.</div>
    <div class="pitfall"><strong>Объект в разметке.</strong> <code>{user}</code>, где <code>user</code> — объект, роняет рендер с «Objects are not valid as a React child». Нужно выбрать поле: <code>{user.name}</code>.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="corner-down-right"></i> Один корень и фрагменты</div>
    <p class="text">Функция возвращает одно значение, поэтому и компонент возвращает один элемент. Когда лишняя обёртка <code>&lt;div&gt;</code> ломает вёрстку (например, внутри grid или таблицы), используют фрагмент.</p>
<pre><code><span class="c-comment">// ❌ Ошибка сборки: два корневых элемента</span>
<span class="c-key">return</span> (
  &lt;<span class="c-type">td</span>&gt;{row.name}&lt;/<span class="c-type">td</span>&gt;
  &lt;<span class="c-type">td</span>&gt;{row.total}&lt;/<span class="c-type">td</span>&gt;
);

<span class="c-comment">// ✅ Фрагмент — не создаёт узла в DOM</span>
<span class="c-key">return</span> (
  &lt;&gt;
    &lt;<span class="c-type">td</span>&gt;{row.name}&lt;/<span class="c-type">td</span>&gt;
    &lt;<span class="c-type">td</span>&gt;{row.total}&lt;/<span class="c-type">td</span>&gt;
  &lt;/&gt;
);

<span class="c-comment">// Если нужен key — только полная форма</span>
{rows.<span class="c-fn">map</span>(row =&gt; (
  &lt;<span class="c-type">React.Fragment</span> key={row.id}&gt;
    &lt;<span class="c-type">dt</span>&gt;{row.name}&lt;/<span class="c-type">dt</span>&gt;
    &lt;<span class="c-type">dd</span>&gt;{row.total}&lt;/<span class="c-type">dd</span>&gt;
  &lt;/<span class="c-type">React.Fragment</span>&gt;
))}</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="repeat-2"></i> Что происходит при обновлении</div>
    <p class="text">Когда состояние меняется, React вызывает компонент заново, получает новое описание и сравнивает его с предыдущим. В DOM уходят только отличия — это и называют согласованием (reconciliation).</p>
    <div class="diagram">setState(…)
   │
   ├─ 1. React помечает компонент как требующий обновления
   │
   ├─ 2. Вызывает функцию компонента → получает новое дерево описаний
   │
   ├─ 3. Сравнивает с предыдущим деревом:
   │      • тип узла изменился  → старый узел удаляется, создаётся новый
   │      • тип тот же          → обновляются только изменившиеся атрибуты
   │      • узлы списка         → сопоставляются по key
   │
   └─ 4. Применяет минимальный набор правок к настоящему DOM
          (эта фаза называется commit)</div>
    <p class="text">Сравнение идёт по позиции в дереве и по типу элемента. Именно поэтому <code>key</code> в списках так важен — он подсказывает React, какой элемент какому соответствует, когда порядок меняется. Подробнее — в разделе <strong>Списки, ключи и формы</strong>.</p>
    <div class="pitfall"><strong>Условная обёртка сбрасывает состояние.</strong> Если один и тот же <code>&lt;Form /&gt;</code> в одной ветке условия обёрнут в <code>&lt;div&gt;</code>, а в другой нет — React видит разный тип на этой позиции, уничтожает старое поддерево и создаёт новое. Всё внутреннее состояние формы теряется.</div>
  </div>
</div>
@endverbatim
@verbatim
<div id="sec-hooks" class="section">
  <div class="section-title">useState и useEffect</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="anchor"></i> Что такое хук и почему правила именно такие</div>
    <p class="text">Хук — функция, которая даёт компоненту доступ к возможностям React: памяти между рендерами, побочным эффектам, контексту. Все они начинаются с <code>use</code>.</p>
    <p class="text">React не знает имён ваших переменных. Он хранит состояние компонента <strong>списком</strong> и на каждом рендере выдаёт значения по порядку вызовов. Отсюда и единственное жёсткое правило: порядок вызовов хуков должен быть одинаковым при каждом рендере.</p>
    <div class="diagram">Первый рендер                     Второй рендер
──────────────────────            ──────────────────────
useState('')   → ячейка 0         useState('')   → ячейка 0  ✅
useState(0)    → ячейка 1         useState(0)    → ячейка 1  ✅
useEffect(...) → ячейка 2         useEffect(...) → ячейка 2  ✅

А если хук спрятан в условии:

if (isOpen) useState('');   ← на первом рендере ячейка 0 занята,
useState(0);                   на втором — сдвиг, и значения
                               разъезжаются по чужим ячейкам</div>
    <table class="data-table">
      <thead><tr><th>Правило</th><th>Что произойдёт при нарушении</th></tr></thead>
      <tbody>
        <tr><td>Только на верхнем уровне функции</td><td>Хук в <code>if</code>, цикле или после раннего <code>return</code> сдвигает нумерацию — React выбрасывает ошибку о изменившемся порядке</td></tr>
        <tr><td>Только из компонента или другого хука</td><td>Вызов из обычной функции или обработчика события: React не поймёт, какому компоненту принадлежит состояние</td></tr>
        <tr><td>Имя начинается с <code>use</code></td><td>Формально не обязательно, но линтер перестанет проверять зависимости и правила</td></tr>
      </tbody>
    </table>
    <div class="remember-box"><strong>Для разработчика на PHP.</strong> Привычка «объявлю переменную внутри <code>if</code>» здесь не работает. Компонент вызывается заново десятки раз, а состояние живёт <em>снаружи</em> него — в React. Хуки и есть способ дотянуться до этой внешней памяти, и дотягиваться нужно всегда в одном порядке.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> useState: снимок, а не переменная</div>
    <p class="text">Значение состояния в конкретном рендере — это <strong>снимок</strong>. Вызов функции-установщика не меняет уже существующую переменную, а просит React отрисовать компонент заново с новым значением.</p>
<pre><code><span class="c-key">const</span> [count, setCount] = <span class="c-fn">useState</span>(<span class="c-num">0</span>);

<span class="c-key">function</span> <span class="c-fn">handleClick</span>() {
  <span class="c-fn">setCount</span>(count + <span class="c-num">1</span>);
  <span class="c-fn">setCount</span>(count + <span class="c-num">1</span>);
  <span class="c-fn">setCount</span>(count + <span class="c-num">1</span>);
  <span class="c-comment">// count здесь всё ещё 0 — это снимок текущего рендера.</span>
  <span class="c-comment">// Результат: 1, а не 3.</span>
}

<span class="c-key">function</span> <span class="c-fn">handleClickRight</span>() {
  <span class="c-fn">setCount</span>(c =&gt; c + <span class="c-num">1</span>);
  <span class="c-fn">setCount</span>(c =&gt; c + <span class="c-num">1</span>);
  <span class="c-fn">setCount</span>(c =&gt; c + <span class="c-num">1</span>);
  <span class="c-comment">// Функциональная форма: каждая получает актуальное значение. Результат: 3.</span>
}</code></pre>
    <p class="text">Несколько вызовов подряд React объединяет в одну перерисовку — это называют пакетированием (batching). Начиная с React 18 оно работает и внутри промисов, и в таймерах, а не только в обработчиках событий.</p>
<pre><code><span class="c-comment">// Тяжёлое начальное значение: так функция выполняется на каждом рендере</span>
<span class="c-key">const</span> [rows, setRows] = <span class="c-fn">useState</span>(<span class="c-fn">parseHugeCsv</span>(raw));

<span class="c-comment">// Ленивая инициализация: функция выполнится ровно один раз</span>
<span class="c-key">const</span> [rows, setRows] = <span class="c-fn">useState</span>(() =&gt; <span class="c-fn">parseHugeCsv</span>(raw));</code></pre>
    <div class="pitfall"><strong>Чтение состояния сразу после установки.</strong> <code>setCount(5); console.log(count);</code> выведет старое значение. Новое появится только в следующем рендере — это не задержка, а то же самое свойство снимка.</div>
    <div class="pitfall"><strong>Мутация вместо замены.</strong> <code>items.push(x); setItems(items)</code> не перерисует компонент: ссылка на массив прежняя. Нужен новый массив — <code>setItems([...items, x])</code>.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="circle-slash"></i> Когда useEffect не нужен</div>
    <p class="text">Самый частый источник запутанного кода у начинающих — эффекты там, где они не требуются. Эффект нужен для <strong>синхронизации с внешним миром</strong>: сеть, подписки, таймеры, прямая работа с DOM. Всё остальное считается во время рендера.</p>
    <table class="data-table">
      <thead><tr><th>Задача</th><th>Через эффект</th><th>Как правильно</th></tr></thead>
      <tbody>
        <tr><td>Значение выводится из props или состояния</td><td>Лишний рендер и риск рассинхрона</td><td>Посчитать прямо при рендере</td></tr>
        <tr><td>Расчёт дорогой</td><td>—</td><td><code>useMemo</code></td></tr>
        <tr><td>Реакция на действие пользователя</td><td>Логика размазана между кликом и эффектом</td><td>Прямо в обработчике события</td></tr>
        <tr><td>Сбросить состояние при смене сущности</td><td><code>useEffect</code> со сравнением id</td><td>Передать <code>key</code> компоненту — React пересоздаст его</td></tr>
      </tbody>
    </table>
<pre><code><span class="c-comment">// ❌ Лишний эффект: два рендера и состояние, которое может разъехаться</span>
<span class="c-key">const</span> [fullName, setFullName] = <span class="c-fn">useState</span>(<span class="c-str">''</span>);
<span class="c-fn">useEffect</span>(() =&gt; { <span class="c-fn">setFullName</span>(first + <span class="c-str">' '</span> + last); }, [first, last]);

<span class="c-comment">// ✅ Обычное вычисление — всегда согласовано</span>
<span class="c-key">const</span> fullName = first + <span class="c-str">' '</span> + last;

<span class="c-comment">// ❌ Сброс формы эффектом при смене пользователя</span>
<span class="c-fn">useEffect</span>(() =&gt; { <span class="c-fn">setDraft</span>(<span class="c-str">''</span>); }, [userId]);

<span class="c-comment">// ✅ Новый key — новый экземпляр компонента со свежим состоянием</span>
&lt;<span class="c-type">ProfileForm</span> key={userId} userId={userId} /&gt;</code></pre>
    <div class="pitfall"><strong>Два вызова эффекта в разработке.</strong> В строгом режиме React монтирует компонент, размонтирует и монтирует снова, чтобы проверить корректность очистки. Это не ошибка: если эффект нельзя запустить дважды без последствий, в нём не хватает очистки.</div>
  </div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="anchor"></i> Зависимости и очистка</div>
    <p class="text">Эффект перезапускается при изменении зависимостей. Возвращаемая функция — <strong>очистка</strong>: отписка от сокета, <code>clearInterval</code>, <code>AbortController</code> для <code>fetch</code>.</p>
<pre><code><span class="c-fn">useEffect</span>(() =&gt; {
  <span class="c-key">const</span> controller = <span class="c-key">new</span> <span class="c-type">AbortController</span>();

  <span class="c-fn">fetch</span>(`/api/chats/${chatId}`, { signal: controller.signal })
    .<span class="c-fn">then</span>(r =&gt; r.<span class="c-fn">json</span>())
    .<span class="c-fn">then</span>(setMessages)
    .<span class="c-fn">catch</span>(e =&gt; { <span class="c-key">if</span> (e.name !== <span class="c-str">'AbortError'</span>) <span class="c-fn">report</span>(e); });

  <span class="c-key">return</span> () =&gt; controller.<span class="c-fn">abort</span>();   <span class="c-comment">// очистка при смене chatId или размонтировании</span>
}, [chatId]);</code></pre>
    <table class="data-table">
      <thead><tr><th>Массив зависимостей</th><th>Когда запускается</th></tr></thead>
      <tbody>
        <tr><td><code>[]</code></td><td>Только при монтировании</td></tr>
        <tr><td><code>[a, b]</code></td><td>При монтировании и при изменении <code>a</code> или <code>b</code></td></tr>
        <tr><td>Не указан</td><td>После <strong>каждой</strong> перерисовки — почти всегда ошибка</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong>Устаревшее замыкание (stale closure).</strong> Эффект или колбэк захватывает <code>state</code> того рендера, в котором был создан. Если зависимость не указана, внутри останется старое значение — и код будет работать «через раз». Лечится честными зависимостями или функциональной формой: <code>setCount(c =&gt; c + 1)</code> вместо <code>setCount(count + 1)</code>.</div>
    <div class="pitfall"><strong>Гонка запросов.</strong> Быстро переключили чат — ответ по старому <code>chatId</code> придёт позже нового и перетрёт данные. Отмена через <code>AbortController</code> в очистке решает это.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-rerender" class="section">
  <div class="section-title">Перерисовки и мемоизация</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="refresh-cw"></i> Почему компонент перерисовывается</div>
    <ul style="margin:8px 0 14px 22px;color:var(--text2);font-size:13px;line-height:1.85">
      <li>Изменился его <code>state</code></li>
      <li>Изменились <code>props</code></li>
      <li>Изменилось значение контекста, который он читает</li>
      <li><strong>Перерисовался родитель</strong> — даже если props те же</li>
    </ul>
    <table class="data-table">
      <thead><tr><th>Инструмент</th><th>Что делает</th></tr></thead>
      <tbody>
        <tr><td><code>React.memo</code></td><td>Пропускает перерисовку, если props не изменились по поверхностному сравнению</td></tr>
        <tr><td><code>useMemo</code></td><td>Кеширует результат вычисления</td></tr>
        <tr><td><code>useCallback</code></td><td>Сохраняет ссылку на функцию между рендерами</td></tr>
        <tr><td>Разделение контекстов</td><td>Часто меняющееся значение не тянет за собой всех потребителей</td></tr>
        <tr><td>Ключи в списках</td><td>Стабильный <code>key</code> позволяет переиспользовать узлы, а не пересоздавать</td></tr>
      </tbody>
    </table>
    <div class="why-box"><strong>Почему <code>React.memo</code> часто не срабатывает.</strong> Сравнение поверхностное, а объекты и функции создаются заново на каждом рендере родителя. Передали <code>style={{ margin: 8 }}</code> или инлайновый обработчик — и memo бесполезен: ссылка каждый раз новая. Поэтому <code>memo</code> работает в паре с <code>useCallback</code> и <code>useMemo</code>, а не сам по себе.</div>
    <div class="pitfall"><strong>Сначала мерить, потом мемоизировать.</strong> Мемоизация не бесплатна: хранение значения, сравнение зависимостей, усложнение кода. Профилировать в React Profiler и оптимизировать найденное — дешевле, чем обвешивать <code>useMemo</code> всё подряд.</div>
  </div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="eye"></i> Перерисовка — это не обновление DOM</div>
    <p class="text">Главное заблуждение при оптимизации. «Компонент перерисовался» означает лишь, что React вызвал функцию компонента и сравнил результат с прошлым. Если разметка не изменилась, в DOM не уйдёт ни одной правки — а именно работа с DOM и стоит дорого.</p>
    <div class="diagram">setState
   │
   ├─ render-фаза: вызов функций компонентов, сравнение деревьев
   │                дёшево — обычный JavaScript
   │
   └─ commit-фаза: применение правок к DOM
                    дорого — пересчёт стилей, перерасклад, отрисовка</div>
    <p class="text">Поэтому сотня «лишних» вызовов простых компонентов обычно не влияет ни на что. Проблемой перерисовки становятся в трёх случаях:</p>
    <table class="data-table">
      <thead><tr><th>Случай</th><th>Почему больно</th></tr></thead>
      <tbody>
        <tr><td>Длинные списки</td><td>Тысяча строк пересобирается при каждом нажатии клавиши в фильтре</td></tr>
        <tr><td>Тяжёлый расчёт при рендере</td><td>Сортировка или разбор данных повторяется без надобности</td></tr>
        <tr><td>Частые события</td><td>Движение мыши, скролл, ввод текста — десятки рендеров в секунду</td></tr>
      </tbody>
    </table>
    <div class="remember-box"><strong>Порядок действий при тормозах.</strong> Сначала измерить профайлером, какой компонент занимает время. Потом проверить, нет ли дорогого расчёта в теле компонента. И только потом тянуться к <code>memo</code>. Мемоизация сама по себе не бесплатна: сравнение props и хранение кэша тоже стоят времени и памяти.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="gauge"></i> Как найти настоящую причину</div>
    <table class="data-table">
      <thead><tr><th>Инструмент</th><th>Что показывает</th></tr></thead>
      <tbody>
        <tr><td>React DevTools → вкладка Profiler</td><td>Запись сеанса: какие компоненты рендерились, сколько заняли и почему</td></tr>
        <tr><td>Настройка «Highlight updates»</td><td>Подсвечивает перерисовываемые области прямо на странице — сразу видно лишнее</td></tr>
        <tr><td>Вкладка Performance в браузере</td><td>Разделяет время на скрипт, пересчёт стилей и отрисовку — видно, где именно узкое место</td></tr>
      </tbody>
    </table>
    <p class="text">Типичная находка: тормозит не тот компонент, который перерисовывается часто, а тот, что делает тяжёлую работу в теле.</p>
<pre><code><span class="c-comment">// ❌ Сортировка на каждом рендере, даже когда менялся только фильтр</span>
<span class="c-key">function</span> <span class="c-fn">Table</span>({ rows, query }) {
  <span class="c-key">const</span> sorted = [...rows].<span class="c-fn">sort</span>(byDate);        <span class="c-comment">// 10 000 элементов</span>
  <span class="c-key">const</span> shown  = sorted.<span class="c-fn">filter</span>(r =&gt; r.name.<span class="c-fn">includes</span>(query));
  <span class="c-key">return</span> &lt;<span class="c-type">List</span> items={shown} /&gt;;
}

<span class="c-comment">// ✅ Дорогое закэшировано по своим зависимостям, дешёвое считается всегда</span>
<span class="c-key">function</span> <span class="c-fn">Table</span>({ rows, query }) {
  <span class="c-key">const</span> sorted = <span class="c-fn">useMemo</span>(() =&gt; [...rows].<span class="c-fn">sort</span>(byDate), [rows]);
  <span class="c-key">const</span> shown  = sorted.<span class="c-fn">filter</span>(r =&gt; r.name.<span class="c-fn">includes</span>(query));
  <span class="c-key">return</span> &lt;<span class="c-type">List</span> items={shown} /&gt;;
}</code></pre>
    <div class="pitfall"><strong>Мемоизация всего подряд.</strong> Обернуть каждую функцию в <code>useCallback</code>, а каждое значение в <code>useMemo</code> — распространённая ошибка. Код становится труднее читать, зависимостей больше, а выигрыша нет: для дешёвых значений сравнение стоит дороже пересчёта.</div>
    <div class="pitfall"><strong>Компилятор меняет правила.</strong> React Compiler расставляет мемоизацию автоматически. Там, где он подключён, ручные <code>memo</code>, <code>useMemo</code> и <code>useCallback</code> в большинстве случаев становятся не нужны — но проверять выигрыш всё равно профайлером.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-state-where" class="section">
  <div class="section-title">Где хранить состояние</div>
  <div class="subsection">
    <table class="data-table">
      <thead><tr><th>Вид состояния</th><th>Чем держать</th><th>Примеры</th></tr></thead>
      <tbody>
        <tr><td><strong>Локальное</strong></td><td><code>useState</code>, <code>useReducer</code></td><td>Открыт ли дропдаун, значение поля ввода</td></tr>
        <tr><td><strong>Серверное</strong></td><td>TanStack Query, RTK Query</td><td>Данные с API: кеш, ретраи, инвалидация</td></tr>
        <tr><td><strong>Глобальное клиентское</strong></td><td>Zustand, Redux Toolkit, Context</td><td>Текущий пользователь, тема, выбранный чат</td></tr>
      </tbody>
    </table>
    <div class="remember-box"><strong>Ключевое различие.</strong> Серверное состояние — это <em>кеш чужих данных</em>: оно устаревает, его надо перезапрашивать и инвалидировать. Класть его в Redux руками означает переписать половину TanStack Query самому.</div>
    <div class="why-box"><strong>Когда Context — плохая идея.</strong> Любое изменение значения контекста перерисовывает <em>всех</em> потребителей. Для часто меняющихся данных это дорого. Context хорош для редко меняющегося: тема, локаль, текущий пользователь.</div>
  </div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-up-from-line"></i> Подъём состояния</div>
    <p class="text">Когда двум компонентам нужно одно значение, оно переносится в ближайшего общего родителя, а вниз уходят само значение и функция его изменения. Это базовый приём, из которого вырастают все остальные.</p>
<pre><code><span class="c-comment">// Фильтр и список должны видеть одну строку поиска</span>
<span class="c-key">function</span> <span class="c-fn">OrdersPage</span>() {
  <span class="c-key">const</span> [query, setQuery] = <span class="c-fn">useState</span>(<span class="c-str">''</span>);   <span class="c-comment">// состояние поднято сюда</span>
  <span class="c-key">return</span> (
    &lt;&gt;
      &lt;<span class="c-type">SearchBox</span> value={query} onChange={setQuery} /&gt;
      &lt;<span class="c-type">OrderList</span> query={query} /&gt;
    &lt;/&gt;
  );
}</code></pre>
    <p class="text">Если передавать значение приходится через четыре-пять этажей, это сигнал: либо нужен контекст, либо промежуточные компоненты стоит перестроить так, чтобы содержимое передавалось через <code>children</code>.</p>
<pre><code><span class="c-comment">// Передача через children: Layout не знает ничего о данных,</span>
<span class="c-comment">// поэтому и props через него тянуть не нужно</span>
&lt;<span class="c-type">Layout</span>&gt;
  &lt;<span class="c-type">OrderList</span> query={query} /&gt;
&lt;/<span class="c-type">Layout</span>&gt;</code></pre>
    <div class="pitfall"><strong>Дублирование вместо подъёма.</strong> Копия значения в двух компонентах рано или поздно разойдётся: один обновился, другой нет. У каждого факта должен быть ровно один владелец.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="link"></i> Адресная строка как хранилище</div>
    <p class="text">Часть состояния правильнее держать не в памяти, а в URL. Признак простой: нужно ли, чтобы это пережило перезагрузку страницы и чтобы ссылкой можно было поделиться.</p>
    <table class="data-table">
      <thead><tr><th>Хранить в URL</th><th>Хранить в памяти</th></tr></thead>
      <tbody>
        <tr><td>Фильтры и поиск в таблице</td><td>Открыт ли выпадающий список</td></tr>
        <tr><td>Номер страницы и сортировка</td><td>Текст, который ещё печатают</td></tr>
        <tr><td>Активная вкладка раздела</td><td>Позиция прокрутки</td></tr>
        <tr><td>Идентификатор открытой карточки</td><td>Наведение мыши</td></tr>
      </tbody>
    </table>
<pre><code><span class="c-comment">// react-router: параметры запроса ведут себя как состояние</span>
<span class="c-key">const</span> [params, setParams] = <span class="c-fn">useSearchParams</span>();
<span class="c-key">const</span> status = params.<span class="c-fn">get</span>(<span class="c-str">'status'</span>) ?? <span class="c-str">'all'</span>;

<span class="c-fn">setParams</span>(prev =&gt; {
  prev.<span class="c-fn">set</span>(<span class="c-str">'status'</span>, <span class="c-str">'paid'</span>);
  <span class="c-key">return</span> prev;
});
<span class="c-comment">// Теперь кнопка «назад» работает ожидаемо, а ссылку можно отправить коллеге</span></code></pre>
    <div class="remember-box"><strong>Привычное сравнение.</strong> Это ровно та же логика, что и с GET-параметрами на сервере: состояние списка задаётся запросом, а не сессией. В одностраничном приложении легко про это забыть и спрятать фильтры в память — после чего ссылка на «отфильтрованный список» перестаёт существовать.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers-2"></i> Когда нужно глобальное хранилище</div>
    <p class="text">Браться за Redux Toolkit или Zustand стоит, когда клиентское состояние действительно общее и меняется из разных мест: корзина, подключение к сокету, права текущего пользователя.</p>
    <table class="data-table">
      <thead><tr><th></th><th>Context</th><th>Zustand</th><th>Redux Toolkit</th></tr></thead>
      <tbody>
        <tr><td>Объём кода</td><td>Минимальный</td><td>Небольшой</td><td>Заметный</td></tr>
        <tr><td>Подписка на часть состояния</td><td>Нет, обновляются все</td><td>Да, по селектору</td><td>Да, по селектору</td></tr>
        <tr><td>Инструменты отладки</td><td>Нет</td><td>Есть</td><td>Полная история действий</td></tr>
        <tr><td>Где уместен</td><td>Тема, локаль, пользователь</td><td>Среднее приложение</td><td>Большая команда, сложные правила</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong>Глобальное хранилище «на всякий случай».</strong> Состояние, которое используется одним экраном, в глобальном хранилище только мешает: его нужно чистить при уходе со страницы, иначе следующий заход покажет чужие данные.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-custom-hooks" class="section">
  <div class="section-title">Свои хуки</div>
  <div class="subsection">
    <p class="text">Кастомный хук — обычная функция, которая вызывает другие хуки. Нужен, чтобы вынести повторяющуюся логику из компонентов.</p>
<pre><code><span class="c-comment">// Типизированные обёртки над Redux — чтобы не писать дженерики в каждом компоненте</span>
<span class="c-key">export const</span> useAppDispatch = () =&gt; <span class="c-fn">useDispatch</span>&lt;<span class="c-type">AppDispatch</span>&gt;();
<span class="c-key">export const</span> useAppSelector: <span class="c-type">TypedUseSelectorHook</span>&lt;<span class="c-type">RootState</span>&gt; = useSelector;</code></pre>
<pre><code><span class="c-comment">// Хук с жизненным циклом: запускает поллинг и отменяет при размонтировании</span>
<span class="c-key">export function</span> <span class="c-fn">useNotifications</span>(enabled: <span class="c-key">boolean</span>) {
  <span class="c-key">const</span> dispatch = <span class="c-fn">useAppDispatch</span>();

  <span class="c-fn">useEffect</span>(() =&gt; {
    <span class="c-key">if</span> (!enabled) <span class="c-key">return</span>;
    <span class="c-key">const</span> controller = <span class="c-key">new</span> <span class="c-type">AbortController</span>();
    <span class="c-fn">poll</span>({ signal: controller.signal, dispatch });
    <span class="c-key">return</span> () =&gt; controller.<span class="c-fn">abort</span>();
  }, [enabled, dispatch]);
}</code></pre>
    <div class="remember-box">Два правила хуков: вызывать только на верхнем уровне компонента или другого хука (не в условиях и циклах) и только из React-функций. Имя обязано начинаться с <code>use</code> — по нему работает линтер.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="scissors"></i> Что выносить в хук, а что оставить</div>
    <p class="text">Хук оправдан, когда повторяется <strong>логика с состоянием или эффектами</strong>. Чистую функцию без хуков внутри выносить в хук не нужно — это просто функция.</p>
    <table class="data-table">
      <thead><tr><th>В хук</th><th>В обычную функцию</th></tr></thead>
      <tbody>
        <tr><td>Подписка и отписка от события</td><td>Форматирование даты или суммы</td></tr>
        <tr><td>Загрузка данных с отменой</td><td>Сортировка и фильтрация массива</td></tr>
        <tr><td>Работа с <code>localStorage</code> плюс состояние</td><td>Валидация строки</td></tr>
        <tr><td>Таймеры и интервалы с очисткой</td><td>Подсчёт итогов по списку</td></tr>
      </tbody>
    </table>
<pre><code><span class="c-comment">// Типовой хук: значение в localStorage, синхронизированное с состоянием</span>
<span class="c-key">function</span> <span class="c-fn">useStored</span>&lt;<span class="c-type">T</span>&gt;(key: <span class="c-type">string</span>, initial: <span class="c-type">T</span>) {
  <span class="c-key">const</span> [value, setValue] = <span class="c-fn">useState</span>&lt;<span class="c-type">T</span>&gt;(() =&gt; {
    <span class="c-key">try</span> {
      <span class="c-key">const</span> raw = localStorage.<span class="c-fn">getItem</span>(key);
      <span class="c-key">return</span> raw ? <span class="c-type">JSON</span>.<span class="c-fn">parse</span>(raw) <span class="c-key">as</span> <span class="c-type">T</span> : initial;
    } <span class="c-key">catch</span> {
      <span class="c-key">return</span> initial;   <span class="c-comment">// приватный режим или испорченное значение</span>
    }
  });

  <span class="c-fn">useEffect</span>(() =&gt; {
    <span class="c-key">try</span> { localStorage.<span class="c-fn">setItem</span>(key, <span class="c-type">JSON</span>.<span class="c-fn">stringify</span>(value)); } <span class="c-key">catch</span> {}
  }, [key, value]);

  <span class="c-key">return</span> [value, setValue] <span class="c-key">as const</span>;   <span class="c-comment">// as const — чтобы вышел кортеж, а не массив</span>
}</code></pre>
    <div class="pitfall"><strong>Хук не разделяет состояние.</strong> Два компонента, вызвавшие один и тот же хук, получат <em>независимые</em> копии состояния. Хук переиспользует логику, а не данные. Общие данные — это контекст или хранилище.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-left-right"></i> Кортеж или объект</div>
    <p class="text">Небольшая деталь, заметно влияющая на удобство: что именно хук возвращает.</p>
<pre><code><span class="c-comment">// Кортеж — когда значений два и имена даёт вызывающий</span>
<span class="c-key">const</span> [isOpen, setOpen] = <span class="c-fn">useToggle</span>(<span class="c-key">false</span>);
<span class="c-key">const</span> [isDark, setDark] = <span class="c-fn">useToggle</span>(<span class="c-key">true</span>);   <span class="c-comment">// переименовать легко</span>

<span class="c-comment">// Объект — когда значений много и часть не нужна</span>
<span class="c-key">const</span> { data, isPending, refetch } = <span class="c-fn">useOrders</span>(userId);
<span class="c-comment">// порядок не важен, лишнее можно не доставать</span></code></pre>
    <div class="remember-box"><strong>Правило.</strong> Два значения — кортеж, больше трёх — объект. Именно поэтому <code>useState</code> возвращает пару, а библиотеки запросов — объект с десятком полей.</div>
  </div>

</div>

@endverbatim
@verbatim
<div id="sec-lists-forms" class="section">
  <div class="section-title">Списки, ключи и формы</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="key-round"></i> Зачем нужен key</div>
    <p class="text">При обновлении списка React сопоставляет старые и новые элементы. Без <code>key</code> сопоставление идёт по порядковому номеру, и если элементы переставили, вставили или удалили, React решит, что изменилось <em>содержимое</em> каждой позиции, а не порядок.</p>
    <div class="diagram">Было:  [ Анна ] [ Борис ] [ Вера ]
Стало: [ Борис ] [ Вера ]          ← удалили Анну

Без key — сопоставление по позиции:
  позиция 0: Анна  → Борис   «текст изменился»
  позиция 1: Борис → Вера    «текст изменился»
  позиция 2: Вера  → нет     «удалить»
  Итог: переписаны все узлы; состояние внутри строк уехало на соседей.

С key — сопоставление по идентификатору:
  key=2 Борис → остался на месте
  key=3 Вера  → остался на месте
  key=1 Анна  → удалён
  Итог: удалён один узел, остальные не тронуты.</div>
<pre><code><span class="c-comment">// ❌ Индекс как key — ломается при вставке, удалении и сортировке</span>
{users.<span class="c-fn">map</span>((u, i) =&gt; &lt;<span class="c-type">UserRow</span> key={i} user={u} /&gt;)}

<span class="c-comment">// ✅ Стабильный идентификатор из данных</span>
{users.<span class="c-fn">map</span>(u =&gt; &lt;<span class="c-type">UserRow</span> key={u.id} user={u} /&gt;)}</code></pre>
    <div class="pitfall"><strong>Самый заметный симптом.</strong> В списке с полями ввода и <code>key={i}</code> удалите первую строку — введённый текст «съедет» на соседнюю строку. Состояние осталось привязано к позиции, а не к записи.</div>
    <div class="pitfall"><strong>Индекс допустим,</strong> только если список неизменяемый: не сортируется, не фильтруется, элементы не добавляются и не удаляются. Такие списки встречаются редко.</div>
    <div class="pitfall"><strong>key уникален среди соседей,</strong> а не глобально. Два разных списка на странице могут содержать одинаковые ключи — это нормально. И <code>key</code> не попадает в props: прочитать его внутри компонента нельзя, нужно передать отдельным атрибутом.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="text-cursor-input"></i> Управляемые и неуправляемые поля</div>
    <p class="text">У поля ввода есть собственное состояние в DOM. Вопрос в том, кто считается источником истины — React или сам браузер.</p>
    <table class="data-table">
      <thead><tr><th></th><th>Управляемое</th><th>Неуправляемое</th></tr></thead>
      <tbody>
        <tr><td>Источник истины</td><td>Состояние React</td><td>Сам DOM-узел</td></tr>
        <tr><td>Как пишется</td><td><code>value</code> + <code>onChange</code></td><td><code>defaultValue</code> + <code>ref</code></td></tr>
        <tr><td>Перерисовка</td><td>На каждое нажатие клавиши</td><td>Не происходит</td></tr>
        <tr><td>Когда удобно</td><td>Валидация на лету, зависимые поля, форматирование ввода</td><td>Большие формы, файлы, интеграция со сторонним кодом</td></tr>
      </tbody>
    </table>
<pre><code><span class="c-comment">// Управляемое: React знает значение в любой момент</span>
<span class="c-key">const</span> [email, setEmail] = <span class="c-fn">useState</span>(<span class="c-str">''</span>);
&lt;<span class="c-type">input</span> value={email} onChange={e =&gt; <span class="c-fn">setEmail</span>(e.target.value)} /&gt;

<span class="c-comment">// Неуправляемое: значение читаем в момент отправки</span>
<span class="c-key">const</span> emailRef = <span class="c-fn">useRef</span>(<span class="c-key">null</span>);
&lt;<span class="c-type">input</span> defaultValue=<span class="c-str">""</span> ref={emailRef} /&gt;
<span class="c-comment">// ... emailRef.current.value</span></code></pre>
    <div class="pitfall"><strong>value без onChange.</strong> Поле станет доступным только для чтения, а в консоли появится предупреждение. Если значение задаётся один раз — нужен <code>defaultValue</code>.</div>
    <div class="pitfall"><strong>undefined как начальное значение.</strong> <code>useState()</code> без аргумента делает поле неуправляемым, а первый ввод переключает его в управляемое. React предупреждает об этом в консоли. Начинайте с пустой строки.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="send"></i> Отправка формы</div>
    <p class="text">Браузер по умолчанию перезагружает страницу при отправке. Это нужно отменить и обязательно блокировать повторную отправку, пока запрос в пути.</p>
<pre><code><span class="c-key">function</span> <span class="c-fn">LoginForm</span>() {
  <span class="c-key">const</span> [form, setForm] = <span class="c-fn">useState</span>({ email: <span class="c-str">''</span>, password: <span class="c-str">''</span> });
  <span class="c-key">const</span> [sending, setSending] = <span class="c-fn">useState</span>(<span class="c-key">false</span>);
  <span class="c-key">const</span> [error, setError] = <span class="c-fn">useState</span>(<span class="c-key">null</span>);

  <span class="c-comment">// одна функция на все поля — по атрибуту name</span>
  <span class="c-key">const</span> <span class="c-fn">change</span> = e =&gt;
    <span class="c-fn">setForm</span>(f =&gt; ({ ...f, [e.target.name]: e.target.value }));

  <span class="c-key">async function</span> <span class="c-fn">submit</span>(e) {
    e.<span class="c-fn">preventDefault</span>();        <span class="c-comment">// без этого страница перезагрузится</span>
    <span class="c-key">if</span> (sending) <span class="c-key">return</span>;       <span class="c-comment">// защита от двойного клика</span>
    <span class="c-fn">setSending</span>(<span class="c-key">true</span>); <span class="c-fn">setError</span>(<span class="c-key">null</span>);
    <span class="c-key">try</span> {
      <span class="c-key">await</span> <span class="c-fn">login</span>(form);
    } <span class="c-key">catch</span> (err) {
      <span class="c-fn">setError</span>(err.message);
    } <span class="c-key">finally</span> {
      <span class="c-fn">setSending</span>(<span class="c-key">false</span>);     <span class="c-comment">// finally — иначе форма зависнет после ошибки</span>
    }
  }

  <span class="c-key">return</span> (
    &lt;<span class="c-type">form</span> onSubmit={submit}&gt;
      &lt;<span class="c-type">input</span> name=<span class="c-str">"email"</span> value={form.email} onChange={change} /&gt;
      &lt;<span class="c-type">input</span> name=<span class="c-str">"password"</span> type=<span class="c-str">"password"</span> value={form.password} onChange={change} /&gt;
      {error &amp;&amp; &lt;<span class="c-type">p</span> role=<span class="c-str">"alert"</span>&gt;{error}&lt;/<span class="c-type">p</span>&gt;}
      &lt;<span class="c-type">button</span> disabled={sending}&gt;{sending ? <span class="c-str">'Входим…'</span> : <span class="c-str">'Войти'</span>}&lt;/<span class="c-type">button</span>&gt;
    &lt;/<span class="c-type">form</span>&gt;
  );
}</code></pre>
    <div class="pitfall"><strong>Мутация состояния.</strong> <code>form.email = v; setForm(form)</code> не вызовет перерисовку: ссылка на объект не изменилась, а React сравнивает именно ссылки. Всегда создавайте новый объект через расширение.</div>
    <div class="pitfall"><strong>Сброс sending без finally.</strong> Если сбрасывать флаг только в удачной ветке, после первой же ошибки кнопка останется заблокированной навсегда.</div>
  </div>
</div>
@endverbatim
@verbatim
<div id="sec-context-reducer" class="section">
  <div class="section-title">Контекст, useReducer и useRef</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="share-2"></i> Контекст: против передачи props через этажи</div>
    <p class="text">Когда значение нужно глубоко внизу дерева, его приходится передавать через все промежуточные компоненты, которым оно не нужно (это называют prop drilling). Контекст позволяет положить значение наверху и прочитать внизу напрямую.</p>
<pre><code><span class="c-comment">// 1. Создаём контекст со значением по умолчанию</span>
<span class="c-key">const</span> ThemeContext = <span class="c-fn">createContext</span>(<span class="c-str">'light'</span>);

<span class="c-comment">// 2. Отдаём значение поддереву</span>
<span class="c-key">function</span> <span class="c-fn">App</span>() {
  <span class="c-key">const</span> [theme, setTheme] = <span class="c-fn">useState</span>(<span class="c-str">'light'</span>);
  <span class="c-comment">// объект создаётся заново на каждом рендере — мемоизируем,</span>
  <span class="c-comment">// иначе все потребители перерисуются даже без реальных изменений</span>
  <span class="c-key">const</span> value = <span class="c-fn">useMemo</span>(() =&gt; ({ theme, setTheme }), [theme]);
  <span class="c-key">return</span> &lt;<span class="c-type">ThemeContext.Provider</span> value={value}&gt;&lt;<span class="c-type">Layout</span> /&gt;&lt;/<span class="c-type">ThemeContext.Provider</span>&gt;;
}

<span class="c-comment">// 3. Читаем на любой глубине</span>
<span class="c-key">function</span> <span class="c-fn">ThemeToggle</span>() {
  <span class="c-key">const</span> { theme, setTheme } = <span class="c-fn">useContext</span>(ThemeContext);
  <span class="c-key">return</span> &lt;<span class="c-type">button</span> onClick={() =&gt; <span class="c-fn">setTheme</span>(theme === <span class="c-str">'light'</span> ? <span class="c-str">'dark'</span> : <span class="c-str">'light'</span>)}&gt;{theme}&lt;/<span class="c-type">button</span>&gt;;
}</code></pre>
    <div class="pitfall"><strong>Контекст — не замена состоянию приложения.</strong> Любое изменение значения перерисовывает <em>всех</em> потребителей, даже тех, кому нужна лишь часть объекта. Для часто меняющихся данных (позиция курсора, ввод в поле) это заметно. Решения: разделить на несколько контекстов или взять внешнее хранилище.</div>
    <div class="pitfall"><strong>Новый объект в value.</strong> <code>value={{ user, logout }}</code> создаёт новую ссылку на каждом рендере родителя — потребители обновятся всегда. Отсюда <code>useMemo</code> в примере.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-branch"></i> useReducer: когда useState перестаёт помогать</div>
    <p class="text">Признак, что пора переходить: несколько <code>useState</code> меняются вместе, а правила перехода между состояниями размазаны по обработчикам. Редьюсер собирает эти правила в одном месте и делает невозможные комбинации невыразимыми.</p>
<pre><code><span class="c-comment">// Было: три состояния, которые нужно держать согласованными вручную</span>
<span class="c-key">const</span> [loading, setLoading] = <span class="c-fn">useState</span>(<span class="c-key">false</span>);
<span class="c-key">const</span> [data, setData]       = <span class="c-fn">useState</span>(<span class="c-key">null</span>);
<span class="c-key">const</span> [error, setError]     = <span class="c-fn">useState</span>(<span class="c-key">null</span>);
<span class="c-comment">// ничто не мешает получить loading: true и error: 'сбой' одновременно</span>

<span class="c-comment">// Стало: одно состояние, переходы описаны явно</span>
<span class="c-key">function</span> <span class="c-fn">reducer</span>(state, action) {
  <span class="c-key">switch</span> (action.type) {
    <span class="c-key">case</span> <span class="c-str">'load'</span>:    <span class="c-key">return</span> { status: <span class="c-str">'loading'</span> };
    <span class="c-key">case</span> <span class="c-str">'success'</span>: <span class="c-key">return</span> { status: <span class="c-str">'ready'</span>, data: action.payload };
    <span class="c-key">case</span> <span class="c-str">'failure'</span>: <span class="c-key">return</span> { status: <span class="c-str">'error'</span>, message: action.error };
    <span class="c-key">default</span>:        <span class="c-key">return</span> state;
  }
}

<span class="c-key">const</span> [state, dispatch] = <span class="c-fn">useReducer</span>(reducer, { status: <span class="c-str">'idle'</span> });
<span class="c-comment">// dispatch({ type: 'load' }) — компонент не знает, как устроен переход</span></code></pre>
    <table class="data-table">
      <thead><tr><th>Берите useState</th><th>Берите useReducer</th></tr></thead>
      <tbody>
        <tr><td>Одно-два независимых значения</td><td>Несколько значений меняются согласованно</td></tr>
        <tr><td>Переход очевиден из места вызова</td><td>Переходы образуют конечный автомат</td></tr>
        <tr><td>Логика помещается в обработчик</td><td>Логику хочется покрыть тестами отдельно от компонента</td></tr>
      </tbody>
    </table>
    <div class="remember-box"><strong>Редьюсер — чистая функция.</strong> Никаких запросов, таймеров и <code>Math.random()</code> внутри. Те же аргументы — тот же результат. Это делает его тестируемым без React и предсказуемым в строгом режиме, который вызывает редьюсер дважды.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="pin"></i> useRef: значение, которое переживает рендер</div>
    <p class="text">У <code>useRef</code> две разные работы, и обе сводятся к одному: это изменяемая ячейка, которая не вызывает перерисовку.</p>
<pre><code><span class="c-comment">// 1. Доступ к узлу DOM</span>
<span class="c-key">const</span> inputRef = <span class="c-fn">useRef</span>(<span class="c-key">null</span>);
<span class="c-fn">useEffect</span>(() =&gt; { inputRef.current?.<span class="c-fn">focus</span>(); }, []);
&lt;<span class="c-type">input</span> ref={inputRef} /&gt;

<span class="c-comment">// 2. Хранилище между рендерами: таймеры, предыдущее значение, флаги</span>
<span class="c-key">const</span> timerRef = <span class="c-fn">useRef</span>(<span class="c-key">null</span>);
<span class="c-key">function</span> <span class="c-fn">start</span>() {
  timerRef.current = <span class="c-fn">setInterval</span>(tick, <span class="c-num">1000</span>);
}
<span class="c-fn">useEffect</span>(() =&gt; () =&gt; <span class="c-fn">clearInterval</span>(timerRef.current), []); <span class="c-comment">// очистка</span></code></pre>
    <table class="data-table">
      <thead><tr><th></th><th>useState</th><th>useRef</th></tr></thead>
      <tbody>
        <tr><td>Изменение вызывает рендер</td><td>Да</td><td>Нет</td></tr>
        <tr><td>Значение между рендерами</td><td>Сохраняется</td><td>Сохраняется</td></tr>
        <tr><td>Чтение во время рендера</td><td>Можно</td><td>Нежелательно</td></tr>
        <tr><td>Для чего</td><td>Данные, влияющие на разметку</td><td>Всё, что на разметку не влияет</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong>Ref не для данных на экране.</strong> Записали в <code>ref.current</code> и ждёте обновления интерфейса — его не будет, React о записи не знает. Если значение видно пользователю, это состояние.</div>
  </div>
</div>
@endverbatim
@verbatim
<div id="sec-data-fetching" class="section">
  <div class="section-title">Загрузка данных и состояния экрана</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list-checks"></i> Четыре состояния, а не одно</div>
    <p class="text">Самая частая ошибка новичка — рисовать только удачный случай. У любого экрана с запросом к серверу состояний как минимум четыре, и каждое должно быть нарисовано.</p>
    <table class="data-table">
      <thead><tr><th>Состояние</th><th>Что видит пользователь</th><th>Что забывают</th></tr></thead>
      <tbody>
        <tr><td>Загрузка</td><td>Скелетон или индикатор</td><td>Прыжок вёрстки, когда данные пришли</td></tr>
        <tr><td>Ошибка</td><td>Текст и кнопка «Повторить»</td><td>Экран остаётся пустым навсегда</td></tr>
        <tr><td>Пусто</td><td>«Пока ничего нет» и подсказка</td><td>Выглядит как поломка</td></tr>
        <tr><td>Данные</td><td>Собственно содержимое</td><td>—</td></tr>
      </tbody>
    </table>
<pre><code><span class="c-key">if</span> (status === <span class="c-str">'loading'</span>) <span class="c-key">return</span> &lt;<span class="c-type">Skeleton</span> rows={5} /&gt;;
<span class="c-key">if</span> (status === <span class="c-str">'error'</span>)   <span class="c-key">return</span> &lt;<span class="c-type">ErrorBox</span> message={message} onRetry={reload} /&gt;;
<span class="c-key">if</span> (!items.length)         <span class="c-key">return</span> &lt;<span class="c-type">Empty</span> hint=<span class="c-str">"Добавьте первый заказ"</span> /&gt;;
<span class="c-key">return</span> &lt;<span class="c-type">OrderList</span> items={items} /&gt;;</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="download-cloud"></i> Запрос в useEffect: полный вариант</div>
    <p class="text">Если писать загрузку руками, необходимы две вещи: отмена устаревшего запроса и защита от записи в размонтированный компонент.</p>
<pre><code><span class="c-key">function</span> <span class="c-fn">useOrders</span>(userId) {
  <span class="c-key">const</span> [state, setState] = <span class="c-fn">useState</span>({ status: <span class="c-str">'loading'</span> });

  <span class="c-fn">useEffect</span>(() =&gt; {
    <span class="c-key">const</span> ac = <span class="c-key">new</span> <span class="c-type">AbortController</span>();
    <span class="c-fn">setState</span>({ status: <span class="c-str">'loading'</span> });

    <span class="c-fn">fetch</span>(`/api/users/${userId}/orders`, { signal: ac.signal })
      .<span class="c-fn">then</span>(r =&gt; {
        <span class="c-comment">// fetch не считает 404 и 500 ошибкой — проверяем сами</span>
        <span class="c-key">if</span> (!r.ok) <span class="c-key">throw</span> <span class="c-key">new</span> <span class="c-type">Error</span>(`HTTP ${r.status}`);
        <span class="c-key">return</span> r.<span class="c-fn">json</span>();
      })
      .<span class="c-fn">then</span>(data =&gt; <span class="c-fn">setState</span>({ status: <span class="c-str">'ready'</span>, data }))
      .<span class="c-fn">catch</span>(err =&gt; {
        <span class="c-key">if</span> (err.name === <span class="c-str">'AbortError'</span>) <span class="c-key">return</span>;  <span class="c-comment">// это мы сами отменили</span>
        <span class="c-fn">setState</span>({ status: <span class="c-str">'error'</span>, message: err.message });
      });

    <span class="c-key">return</span> () =&gt; ac.<span class="c-fn">abort</span>();   <span class="c-comment">// userId сменился или компонент ушёл</span>
  }, [userId]);

  <span class="c-key">return</span> state;
}</code></pre>
    <div class="pitfall"><strong>Гонка ответов.</strong> Без отмены быстрое переключение между пользователями приведёт к тому, что медленный ответ по старому <code>userId</code> придёт последним и перетрёт правильные данные. Экран покажет чужие заказы.</div>
    <div class="pitfall"><strong>fetch не бросает на 4xx и 5xx.</strong> Промис отклоняется только при сетевом сбое. Без проверки <code>r.ok</code> страница HTML с ошибкой уедет в <code>r.json()</code> и упадёт уже там, с непонятным сообщением про синтаксис.</div>
    <div class="pitfall"><strong>async прямо в useEffect.</strong> <code>useEffect(async () =&gt; …)</code> вернёт промис вместо функции очистки, и React предупредит об этом. Объявляйте асинхронную функцию внутри и вызывайте её.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package-check"></i> Почему в проектах берут библиотеку</div>
    <p class="text">Приведённый хук решает один экран. В приложении появляются кэш, повторные попытки, обновление в фоне, инвалидация после изменения данных — и это уже отдельная задача. Её закрывают TanStack Query (React Query) или RTK Query.</p>
<pre><code><span class="c-comment">// То же самое через TanStack Query</span>
<span class="c-key">const</span> { data, isPending, isError, refetch } = <span class="c-fn">useQuery</span>({
  queryKey: [<span class="c-str">'orders'</span>, userId],   <span class="c-comment">// ключ кэша: сменился userId — новый запрос</span>
  queryFn: ({ signal }) =&gt; <span class="c-fn">fetch</span>(`/api/users/${userId}/orders`, { signal })
    .<span class="c-fn">then</span>(r =&gt; r.ok ? r.<span class="c-fn">json</span>() : <span class="c-type">Promise</span>.<span class="c-fn">reject</span>(<span class="c-key">new</span> <span class="c-type">Error</span>(r.status))),
  staleTime: <span class="c-num">30_000</span>,            <span class="c-comment">// 30 секунд данные считаются свежими</span>
});</code></pre>
    <table class="data-table">
      <thead><tr><th>Что даёт библиотека</th><th>Что придётся писать руками</th></tr></thead>
      <tbody>
        <tr><td>Кэш по ключу и дедупликация одинаковых запросов</td><td>Свой словарь запросов и проверка «уже грузим»</td></tr>
        <tr><td>Повтор при сбое и обновление при возврате на вкладку</td><td>Счётчик попыток, подписка на <code>visibilitychange</code></td></tr>
        <tr><td>Инвалидация после отправки формы</td><td>Ручной перезапрос во всех местах, где показаны данные</td></tr>
        <tr><td>Единое состояние загрузки для всего приложения</td><td>Свой флаг в каждом компоненте</td></tr>
      </tbody>
    </table>
    <div class="remember-box"><strong>Разделение, которое стоит усвоить.</strong> Состояние сервера (пришло по сети, может устареть, принадлежит не вам) и состояние интерфейса (открыт ли модал, какая вкладка активна) — разные вещи. Первое удобно отдать библиотеке запросов, второе оставить в <code>useState</code>. Попытка хранить и то и другое в одном глобальном хранилище — источник большей части сложности в старых проектах на Redux.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield-alert"></i> Чтобы одна ошибка не гасила страницу</div>
    <p class="text">Исключение при рендере размонтирует всё дерево — пользователь увидит белый экран. Граница ошибок перехватывает сбой поддерева и рисует запасной интерфейс.</p>
<pre><code>&lt;<span class="c-type">ErrorBoundary</span> fallback={&lt;<span class="c-type">p</span>&gt;Виджет временно недоступен&lt;/<span class="c-type">p</span>&gt;}&gt;
  &lt;<span class="c-type">RevenueChart</span> /&gt;
&lt;/<span class="c-type">ErrorBoundary</span>&gt;</code></pre>
    <div class="pitfall"><strong>Что граница не ловит:</strong> ошибки в обработчиках событий, в асинхронном коде, при серверном рендеринге и внутри самой границы. Обработчик клика нужно оборачивать в <code>try/catch</code> самостоятельно.</div>
  </div>
</div>
@endverbatim
@verbatim
<div id="sec-ts-config" class="section">
  <div class="section-title">tsconfig и строгий режим</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="settings-2"></i> Что вообще делает компилятор</div>
    <p class="text">TypeScript не выполняется. Он проверяет типы и <strong>стирает</strong> их, оставляя обычный JavaScript. Отсюда главное следствие: ни одна аннотация не существует во время работы программы — проверить тип данных, пришедших с сервера, типами нельзя.</p>
<pre><code><span class="c-comment">// Исходник на TypeScript</span>
<span class="c-key">interface</span> <span class="c-type">User</span> { id: <span class="c-type">number</span>; name: <span class="c-type">string</span>; }
<span class="c-key">function</span> <span class="c-fn">greet</span>(u: <span class="c-type">User</span>): <span class="c-type">string</span> { <span class="c-key">return</span> `Привет, ${u.name}`; }

<span class="c-comment">// Что останется после компиляции — интерфейс исчез целиком</span>
<span class="c-key">function</span> <span class="c-fn">greet</span>(u) { <span class="c-key">return</span> `Привет, ${u.name}`; }</code></pre>
    <div class="remember-box"><strong>Разделение, которое снимает большинство вопросов.</strong> Типы живут во время сборки, данные — во время работы. Всё, что приходит извне (ответ API, параметр адреса, содержимое localStorage), нужно проверять настоящим кодом. Подробнее — в разделе <strong>Типы против валидации</strong>.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield"></i> strict: ради чего всё затевалось</div>
    <p class="text"><code>"strict": true</code> включает набор проверок разом. Без него TypeScript теряет большую часть пользы: <code>null</code> проходит всюду, а необъявленные типы молча становятся <code>any</code>.</p>
    <table class="data-table">
      <thead><tr><th>Флаг внутри strict</th><th>Что ловит</th></tr></thead>
      <tbody>
        <tr><td><code>strictNullChecks</code></td><td>Главный. Без него <code>null</code> и <code>undefined</code> допустимы в любом типе, и обращение к полю отсутствующего объекта не будет ошибкой</td></tr>
        <tr><td><code>noImplicitAny</code></td><td>Параметр без аннотации, тип которого вывести не удалось</td></tr>
        <tr><td><code>strictFunctionTypes</code></td><td>Несовместимую подстановку функции вместо другой функции</td></tr>
        <tr><td><code>strictPropertyInitialization</code></td><td>Поле класса, которое объявлено, но никогда не присваивается</td></tr>
        <tr><td><code>useUnknownInCatchVariables</code></td><td>Переменная в <code>catch</code> получает <code>unknown</code>, а не <code>any</code> — исключение придётся проверить</td></tr>
      </tbody>
    </table>
    <p class="text">Полезны и те, что в <code>strict</code> не входят:</p>
    <table class="data-table">
      <thead><tr><th>Флаг</th><th>Зачем</th></tr></thead>
      <tbody>
        <tr><td><code>noUncheckedIndexedAccess</code></td><td>Доступ по индексу даёт <code>T | undefined</code>. Снимает целый класс ошибок с массивами и словарями</td></tr>
        <tr><td><code>noImplicitOverride</code></td><td>Переопределение метода родителя требует слова <code>override</code></td></tr>
        <tr><td><code>exactOptionalPropertyTypes</code></td><td>Различает «поля нет» и «поле равно undefined»</td></tr>
        <tr><td><code>verbatimModuleSyntax</code></td><td>Требует <code>import type</code> для импорта только типов — важно для корректной сборки</td></tr>
      </tbody>
    </table>
<pre><code><span class="c-comment">// Чем помогает noUncheckedIndexedAccess</span>
<span class="c-key">const</span> ids: <span class="c-type">number</span>[] = [];
<span class="c-key">const</span> first = ids[<span class="c-num">0</span>];
<span class="c-comment">// без флага: number  → first.toFixed() компилируется и падает в рантайме</span>
<span class="c-comment">// с флагом:  number | undefined → компилятор требует проверку</span>
<span class="c-key">if</span> (first !== <span class="c-key">undefined</span>) first.<span class="c-fn">toFixed</span>();</code></pre>
    <div class="pitfall"><strong>Перевод старого проекта.</strong> Включать <code>strict</code> разом на большой кодовой базе — тысячи ошибок и соблазн всё отключить. Включают по одному флагу, начиная с <code>noImplicitAny</code>, либо держат строгость только для новых файлов.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="ban"></i> any, unknown и never</div>
    <table class="data-table">
      <thead><tr><th>Тип</th><th>Смысл</th><th>Когда уместен</th></tr></thead>
      <tbody>
        <tr><td><code>any</code></td><td>Проверки отключены. Любая операция разрешена</td><td>Почти никогда. Точечно при переводе старого кода</td></tr>
        <tr><td><code>unknown</code></td><td>Значение есть, но тип неизвестен. Ничего делать нельзя, пока не проверите</td><td>Ответ сети, <code>JSON.parse</code>, переменная в <code>catch</code></td></tr>
        <tr><td><code>never</code></td><td>Значения не бывает в принципе</td><td>Функция, которая всегда бросает; проверка полноты <code>switch</code></td></tr>
      </tbody>
    </table>
<pre><code><span class="c-comment">// any заражает всё вокруг — ошибка всплывёт далеко от причины</span>
<span class="c-key">const</span> data: <span class="c-type">any</span> = <span class="c-type">JSON</span>.<span class="c-fn">parse</span>(raw);
data.user.profile.name.<span class="c-fn">trim</span>();   <span class="c-comment">// компилируется; падает в рантайме</span>

<span class="c-comment">// unknown заставляет проверить</span>
<span class="c-key">const</span> data: <span class="c-type">unknown</span> = <span class="c-type">JSON</span>.<span class="c-fn">parse</span>(raw);
<span class="c-key">if</span> (<span class="c-key">typeof</span> data === <span class="c-str">'object'</span> &amp;&amp; data !== <span class="c-key">null</span> &amp;&amp; <span class="c-str">'user'</span> <span class="c-key">in</span> data) {
  <span class="c-comment">// здесь TypeScript уже знает, что поле есть</span>
}

<span class="c-comment">// never ловит забытую ветку при добавлении нового варианта</span>
<span class="c-key">function</span> <span class="c-fn">assertNever</span>(x: <span class="c-type">never</span>): <span class="c-type">never</span> { <span class="c-key">throw</span> <span class="c-key">new</span> <span class="c-type">Error</span>(<span class="c-str">'Необработанный вариант: '</span> + x); }</code></pre>
    <div class="pitfall"><strong>Утверждение типа — не проверка.</strong> <code>value as User</code> ничего не проверяет, а лишь приказывает компилятору замолчать. Если данные другие, ошибка просто переедет дальше по коду и станет труднее для поиска.</div>
  </div>
</div>
@endverbatim
@verbatim
<div id="sec-ts-base" class="section">
  <div class="section-title">TypeScript: interface, type, дженерики</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="type"></i> interface против type</div>
    <table class="data-table">
      <thead><tr><th></th><th><code>interface</code></th><th><code>type</code></th></tr></thead>
      <tbody>
        <tr><td><strong>Расширение</strong></td><td><code>extends</code></td><td>Пересечение <code>&amp;</code></td></tr>
        <tr><td><strong>Слияние объявлений</strong></td><td>Да — два одноимённых объединяются</td><td>Нет, будет ошибка</td></tr>
        <tr><td><strong>Union</strong></td><td>Нет</td><td><strong>Да</strong> — <code>'a' | 'b'</code></td></tr>
        <tr><td><strong>Примитивы, кортежи</strong></td><td>Нет</td><td>Да</td></tr>
      </tbody>
    </table>
    <div class="remember-box">Практическое правило: <code>interface</code> для формы объекта, который могут расширять; <code>type</code> для union, кортежей и вычисляемых типов. Слияние объявлений у <code>interface</code> — то, чем пользуются библиотеки, чтобы дать тебе дописать их типы.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="box"></i> Дженерики</div>
<pre><code><span class="c-comment">// T выводится из аргумента — возвращаемый тип совпадёт с типом элементов</span>
<span class="c-key">function</span> <span class="c-fn">first</span>&lt;<span class="c-type">T</span>&gt;(arr: <span class="c-type">T</span>[]): <span class="c-type">T</span> | <span class="c-key">undefined</span> {
  <span class="c-key">return</span> arr[<span class="c-num">0</span>];
}

<span class="c-fn">first</span>([<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>]);        <span class="c-comment">// number | undefined</span>
<span class="c-fn">first</span>([<span class="c-str">'a'</span>, <span class="c-str">'b'</span>]);       <span class="c-comment">// string | undefined</span>

<span class="c-comment">// Ограничение: принимать только то, у чего есть id</span>
<span class="c-key">function</span> <span class="c-fn">byId</span>&lt;<span class="c-type">T</span> <span class="c-key">extends</span> { id: <span class="c-key">string</span> }&gt;(items: <span class="c-type">T</span>[]): <span class="c-type">Record</span>&lt;<span class="c-key">string</span>, <span class="c-type">T</span>&gt; {
  <span class="c-key">return</span> <span class="c-type">Object</span>.<span class="c-fn">fromEntries</span>(items.<span class="c-fn">map</span>(i =&gt; [i.id, i]));
}</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="wand-2"></i> Вывод типов: писать меньше, проверять столько же</div>
    <p class="text">TypeScript выводит тип сам, и дублировать очевидное не нужно. Аннотация нужна там, где вывод невозможен или где вы хотите <em>зафиксировать</em> контракт.</p>
<pre><code><span class="c-comment">// Избыточно — тип и так ясен</span>
<span class="c-key">const</span> name: <span class="c-type">string</span> = <span class="c-str">'Иван'</span>;

<span class="c-comment">// Нужно: аргументы функции вывести неоткуда</span>
<span class="c-key">function</span> <span class="c-fn">total</span>(items: <span class="c-type">Item</span>[], rate: <span class="c-type">number</span>) { … }

<span class="c-comment">// Нужно: фиксируем возвращаемый тип, чтобы случайная правка</span>
<span class="c-comment">// внутри функции не изменила её контракт незаметно</span>
<span class="c-key">function</span> <span class="c-fn">toDto</span>(u: <span class="c-type">User</span>): <span class="c-type">UserDto</span> { … }

<span class="c-comment">// Разница, о которую спотыкаются: let расширяет литеральный тип</span>
<span class="c-key">let</span> status = <span class="c-str">'idle'</span>;        <span class="c-comment">// string</span>
<span class="c-key">const</span> status2 = <span class="c-str">'idle'</span>;      <span class="c-comment">// 'idle' — литеральный тип</span>

<span class="c-comment">// as const фиксирует всю структуру целиком</span>
<span class="c-key">const</span> config = { mode: <span class="c-str">'dark'</span>, retries: <span class="c-num">3</span> } <span class="c-key">as const</span>;
<span class="c-comment">// { readonly mode: 'dark'; readonly retries: 3 }</span></code></pre>
    <div class="pitfall"><strong>Объект, переданный в функцию.</strong> <code>const opts = { mode: 'dark' }</code> имеет тип <code>{ mode: string }</code>, и передать его туда, где ждут <code>{ mode: 'dark' | 'light' }</code>, не получится. Лечится через <code>as const</code> или аннотацией переменной.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="lock"></i> Ограничения дженериков</div>
    <p class="text">Без ограничения параметр типа — это «что угодно», и внутри функции с ним ничего нельзя сделать. <code>extends</code> сужает допустимые типы, сохраняя при этом конкретику на выходе.</p>
<pre><code><span class="c-comment">// Без ограничения: обратиться к .length нельзя — вдруг это число</span>
<span class="c-key">function</span> <span class="c-fn">first</span>&lt;<span class="c-type">T</span>&gt;(x: <span class="c-type">T</span>) { <span class="c-key">return</span> x.length; }   <span class="c-comment">// ошибка</span>

<span class="c-comment">// С ограничением: требуем наличие length</span>
<span class="c-key">function</span> <span class="c-fn">first</span>&lt;<span class="c-type">T</span> <span class="c-key">extends</span> { length: <span class="c-type">number</span> }&gt;(x: <span class="c-type">T</span>) { <span class="c-key">return</span> x.length; }

<span class="c-comment">// keyof — ключ точно существует у объекта, а тип значения выводится</span>
<span class="c-key">function</span> <span class="c-fn">pluck</span>&lt;<span class="c-type">T</span>, <span class="c-type">K</span> <span class="c-key">extends keyof</span> <span class="c-type">T</span>&gt;(obj: <span class="c-type">T</span>, key: <span class="c-type">K</span>): <span class="c-type">T</span>[<span class="c-type">K</span>] {
  <span class="c-key">return</span> obj[key];
}

<span class="c-key">const</span> user = { id: <span class="c-num">1</span>, name: <span class="c-str">'Иван'</span> };
<span class="c-key">const</span> id = <span class="c-fn">pluck</span>(user, <span class="c-str">'id'</span>);       <span class="c-comment">// number</span>
<span class="c-key">const</span> no = <span class="c-fn">pluck</span>(user, <span class="c-str">'email'</span>);    <span class="c-comment">// ошибка компиляции: такого ключа нет</span></code></pre>
    <div class="remember-box"><strong>Зачем это на практике.</strong> Так типизируют функции работы с данными: <code>sortBy(rows, 'createdAt')</code> проверит, что поле существует, и сам выведет его тип. Без ограничений пришлось бы писать <code>any</code> и потерять проверку.</div>
  </div>

</div>

@endverbatim
@verbatim
<div id="sec-ts-utils" class="section">
  <div class="section-title">TypeScript: утилитарные типы</div>
  <div class="subsection">
    <table class="data-table">
      <thead><tr><th>Тип</th><th>Что делает</th><th>Пример применения</th></tr></thead>
      <tbody>
        <tr><td><code>Partial&lt;T&gt;</code></td><td>Все поля необязательные</td><td>DTO для PATCH-запроса</td></tr>
        <tr><td><code>Required&lt;T&gt;</code></td><td>Все поля обязательные</td><td>Конфиг после применения дефолтов</td></tr>
        <tr><td><code>Pick&lt;T, K&gt;</code></td><td>Взять перечисленные поля</td><td>Публичный профиль из модели пользователя</td></tr>
        <tr><td><code>Omit&lt;T, K&gt;</code></td><td>Убрать перечисленные</td><td>Модель без <code>password</code> и <code>id</code></td></tr>
        <tr><td><code>Record&lt;K, V&gt;</code></td><td>Словарь с заданными ключами</td><td>Нормализованный стор: <code>Record&lt;string, Chat&gt;</code></td></tr>
        <tr><td><code>ReturnType&lt;F&gt;</code></td><td>Тип возврата функции</td><td><code>RootState = ReturnType&lt;typeof store.getState&gt;</code></td></tr>
        <tr><td><code>Awaited&lt;T&gt;</code></td><td>Тип внутри промиса</td><td>Результат асинхронной функции</td></tr>
      </tbody>
    </table>
    <div class="why-box"><strong>Зачем это нужно на практике.</strong> Утилитарные типы позволяют держать <strong>один источник правды</strong>. Описал модель один раз — а DTO на создание, на обновление и публичный ответ выводятся из неё через <code>Omit</code> и <code>Partial</code>. Иначе три похожих интерфейса разъезжаются при первой же правке.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cog"></i> Как они устроены внутри</div>
    <p class="text">Утилитарные типы — не магия компилятора, а обычные обобщённые типы, написанные на том же языке типов. Понимание их устройства позволяет писать свои.</p>
<pre><code><span class="c-comment">// Так объявлены Partial и Readonly в стандартной библиотеке</span>
<span class="c-key">type</span> <span class="c-type">Partial</span>&lt;<span class="c-type">T</span>&gt;  = { [<span class="c-type">K</span> <span class="c-key">in keyof</span> <span class="c-type">T</span>]?: <span class="c-type">T</span>[<span class="c-type">K</span>] };
<span class="c-key">type</span> <span class="c-type">Readonly</span>&lt;<span class="c-type">T</span>&gt; = { <span class="c-key">readonly</span> [<span class="c-type">K</span> <span class="c-key">in keyof</span> <span class="c-type">T</span>]: <span class="c-type">T</span>[<span class="c-type">K</span>] };

<span class="c-comment">// Pick перебирает только указанные ключи</span>
<span class="c-key">type</span> <span class="c-type">Pick</span>&lt;<span class="c-type">T</span>, <span class="c-type">K</span> <span class="c-key">extends keyof</span> <span class="c-type">T</span>&gt; = { [<span class="c-type">P</span> <span class="c-key">in</span> <span class="c-type">K</span>]: <span class="c-type">T</span>[<span class="c-type">P</span>] };

<span class="c-comment">// Условный тип: ветвление на уровне типов</span>
<span class="c-key">type</span> <span class="c-type">Unwrap</span>&lt;<span class="c-type">T</span>&gt; = <span class="c-type">T</span> <span class="c-key">extends</span> <span class="c-type">Promise</span>&lt;<span class="c-key">infer</span> <span class="c-type">U</span>&gt; ? <span class="c-type">U</span> : <span class="c-type">T</span>;
<span class="c-key">type</span> <span class="c-type">A</span> = <span class="c-type">Unwrap</span>&lt;<span class="c-type">Promise</span>&lt;<span class="c-type">User</span>&gt;&gt;;   <span class="c-comment">// User</span>
<span class="c-key">type</span> <span class="c-type">B</span> = <span class="c-type">Unwrap</span>&lt;<span class="c-type">number</span>&gt;;            <span class="c-comment">// number</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Свои типы под задачи проекта</div>
<pre><code><span class="c-comment">// Сделать часть полей обязательными, остальные оставить как есть</span>
<span class="c-key">type</span> <span class="c-type">RequireFields</span>&lt;<span class="c-type">T</span>, <span class="c-type">K</span> <span class="c-key">extends keyof</span> <span class="c-type">T</span>&gt; = <span class="c-type">T</span> &amp; <span class="c-type">Required</span>&lt;<span class="c-type">Pick</span>&lt;<span class="c-type">T</span>, <span class="c-type">K</span>&gt;&gt;;

<span class="c-comment">// Черновик заказа, у которого точно есть идентификатор клиента</span>
<span class="c-key">type</span> <span class="c-type">DraftOrder</span> = <span class="c-type">RequireFields</span>&lt;<span class="c-type">Partial</span>&lt;<span class="c-type">Order</span>&gt;, <span class="c-str">'customerId'</span>&gt;;

<span class="c-comment">// Глубокая неизменяемость — для конфигов и замороженных данных</span>
<span class="c-key">type</span> <span class="c-type">DeepReadonly</span>&lt;<span class="c-type">T</span>&gt; = {
  <span class="c-key">readonly</span> [<span class="c-type">K</span> <span class="c-key">in keyof</span> <span class="c-type">T</span>]: <span class="c-type">T</span>[<span class="c-type">K</span>] <span class="c-key">extends</span> <span class="c-type">object</span> ? <span class="c-type">DeepReadonly</span>&lt;<span class="c-type">T</span>[<span class="c-type">K</span>]&gt; : <span class="c-type">T</span>[<span class="c-type">K</span>];
};</code></pre>
    <div class="pitfall"><strong>Увлечение типами.</strong> Многоэтажная конструкция из условных типов решает задачу, но через полгода её не прочитает никто, включая автора. Если тип занял десяток строк — чаще всего стоит упростить структуру данных, а не изощряться в типах.</div>
  </div>

</div>

@endverbatim
@verbatim
<div id="sec-ts-narrowing" class="section">
  <div class="section-title">TypeScript: сужение типов</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="filter"></i> Три способа</div>
<pre><code><span class="c-comment">// 1. typeof — для примитивов</span>
<span class="c-key">if</span> (<span class="c-key">typeof</span> value === <span class="c-str">'string'</span>) { value.<span class="c-fn">toUpperCase</span>(); }

<span class="c-comment">// 2. in — по наличию поля</span>
<span class="c-key">if</span> (<span class="c-str">'error'</span> <span class="c-key">in</span> result) { <span class="c-fn">report</span>(result.error); }

<span class="c-comment">// 3. Discriminated union — поле-дискриминатор</span>
<span class="c-key">type</span> <span class="c-type">Result</span> =
  | { status: <span class="c-str">'ok'</span>;    data: <span class="c-type">User</span> }
  | { status: <span class="c-str">'error'</span>; message: <span class="c-key">string</span> };

<span class="c-key">if</span> (res.status === <span class="c-str">'ok'</span>) {
  res.data;      <span class="c-comment">// TypeScript знает: здесь есть data</span>
} <span class="c-key">else</span> {
  res.message;   <span class="c-comment">// а здесь message</span>
}</code></pre>
    <div class="remember-box"><strong>Discriminated union — главный инструмент.</strong> Один литеральный ключ (<code>status</code>, <code>kind</code>, <code>type</code>) разводит ветки, и компилятор сам понимает, какие поля доступны в каждой. Это же позволяет проверять полноту <code>switch</code> через <code>never</code>.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="ban"></i> unknown вместо any</div>
<pre><code><span class="c-key">const</span> raw: <span class="c-key">any</span> = <span class="c-type">JSON</span>.<span class="c-fn">parse</span>(body);
raw.user.name.<span class="c-fn">toUpperCase</span>();     <span class="c-comment">// компилируется, падает в рантайме</span>

<span class="c-key">const</span> raw: <span class="c-key">unknown</span> = <span class="c-type">JSON</span>.<span class="c-fn">parse</span>(body);
raw.user;                          <span class="c-comment">// ошибка компиляции — заставит проверить</span></code></pre>
    <div class="pitfall"><strong><code>any</code> отключает проверки молча и заразно.</strong> Любое выражение с <code>any</code> тоже становится <code>any</code>, и дыра расползается по коду. <code>unknown</code> безопасен: с ним ничего нельзя сделать, пока не сузишь тип.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="filter"></i> Предикаты типов: научить компилятор своей проверке</div>
    <p class="text">Встроенные <code>typeof</code> и <code>in</code> покрывают не всё. Для собственных проверок есть предикат — функция, чей возвращаемый тип записан как <code>arg is Type</code>.</p>
<pre><code><span class="c-comment">// Обычная функция: вернула true, но компилятор ничего нового не узнал</span>
<span class="c-key">function</span> <span class="c-fn">isUser</span>(x: <span class="c-type">unknown</span>): <span class="c-type">boolean</span> { … }

<span class="c-comment">// Предикат: после проверки тип сужается</span>
<span class="c-key">function</span> <span class="c-fn">isUser</span>(x: <span class="c-type">unknown</span>): x <span class="c-key">is</span> <span class="c-type">User</span> {
  <span class="c-key">return</span> <span class="c-key">typeof</span> x === <span class="c-str">'object'</span> &amp;&amp; x !== <span class="c-key">null</span>
    &amp;&amp; <span class="c-str">'id'</span> <span class="c-key">in</span> x &amp;&amp; <span class="c-key">typeof</span> (x <span class="c-key">as</span> <span class="c-type">User</span>).id === <span class="c-str">'number'</span>;
}

<span class="c-key">if</span> (<span class="c-fn">isUser</span>(data)) {
  data.id;   <span class="c-comment">// здесь это User</span>
}

<span class="c-comment">// Частый случай: отфильтровать пустые значения из массива</span>
<span class="c-key">const</span> clean = list.<span class="c-fn">filter</span>((x): x <span class="c-key">is</span> <span class="c-type">string</span> =&gt; x != <span class="c-key">null</span>);
<span class="c-comment">// без предиката тип остался бы (string | null)[]</span></code></pre>
    <div class="pitfall"><strong>Предикат — обещание под вашу ответственность.</strong> Компилятор не проверяет, что тело функции действительно устанавливает заявленное. Неполная проверка внутри означает неверное сужение снаружи — и ошибка проявится далеко от этого места.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="unlink"></i> Где сужение теряется</div>
    <p class="text">Сужение живёт до тех пор, пока компилятор уверен, что значение не могло измениться. Есть несколько мест, где эта уверенность пропадает.</p>
<pre><code><span class="c-key">interface</span> <span class="c-type">Box</span> { value?: <span class="c-type">string</span> }

<span class="c-key">function</span> <span class="c-fn">bad</span>(box: <span class="c-type">Box</span>) {
  <span class="c-key">if</span> (box.value) {
    <span class="c-fn">setTimeout</span>(() =&gt; box.value.<span class="c-fn">trim</span>(), <span class="c-num">0</span>);
    <span class="c-comment">// ошибка: между проверкой и вызовом поле могли обнулить</span>
  }
}

<span class="c-key">function</span> <span class="c-fn">good</span>(box: <span class="c-type">Box</span>) {
  <span class="c-key">const</span> value = box.value;          <span class="c-comment">// копия в константу</span>
  <span class="c-key">if</span> (value) {
    <span class="c-fn">setTimeout</span>(() =&gt; value.<span class="c-fn">trim</span>(), <span class="c-num">0</span>);   <span class="c-comment">// сужение сохраняется</span>
  }
}</code></pre>
    <table class="data-table">
      <thead><tr><th>Где теряется</th><th>Почему</th></tr></thead>
      <tbody>
        <tr><td>Внутри колбэка или замыкания</td><td>Код выполнится позже, поле могли изменить</td></tr>
        <tr><td>После вызова любой функции</td><td>Компилятор считает, что она могла поменять объект</td></tr>
        <tr><td>У свойства изменяемого объекта</td><td>Надёжно сужаются локальные константы, а не поля</td></tr>
        <tr><td>После <code>await</code></td><td>За время ожидания состояние могло измениться</td></tr>
      </tbody>
    </table>
  </div>

</div>

@endverbatim
@verbatim
<div id="sec-ts-unions" class="section">
  <div class="section-title">Размеченные объединения</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-merge"></i> Сделать невозможное состояние невыразимым</div>
    <p class="text">Это главный приём, ради которого стоит переходить на TypeScript всерьёз. Вместо набора независимых полей — перечисление допустимых вариантов, где у каждого свой набор данных. Невозможная комбинация перестаёт компилироваться.</p>
<pre><code><span class="c-comment">// ❌ Четыре поля дают 16 комбинаций, осмысленных — три</span>
<span class="c-key">interface</span> <span class="c-type">State</span> {
  loading: <span class="c-type">boolean</span>;
  data?: <span class="c-type">Order</span>[];
  error?: <span class="c-type">string</span>;
}
<span class="c-comment">// { loading: true, error: 'сбой', data: [...] } — тип это допускает</span>

<span class="c-comment">// ✅ Размеченное объединение: поле-метка status различает варианты</span>
<span class="c-key">type</span> <span class="c-type">State</span> =
  | { status: <span class="c-str">'idle'</span> }
  | { status: <span class="c-str">'loading'</span> }
  | { status: <span class="c-str">'ready'</span>; data: <span class="c-type">Order</span>[] }
  | { status: <span class="c-str">'error'</span>; message: <span class="c-type">string</span> };</code></pre>
    <p class="text">Теперь компилятор сам проводит по веткам и в каждой знает, какие поля доступны:</p>
<pre><code><span class="c-key">function</span> <span class="c-fn">render</span>(state: <span class="c-type">State</span>) {
  <span class="c-key">switch</span> (state.status) {
    <span class="c-key">case</span> <span class="c-str">'idle'</span>:
    <span class="c-key">case</span> <span class="c-str">'loading'</span>: <span class="c-key">return</span> &lt;<span class="c-type">Skeleton</span> /&gt;;
    <span class="c-key">case</span> <span class="c-str">'ready'</span>:   <span class="c-key">return</span> &lt;<span class="c-type">List</span> items={state.data} /&gt;;      <span class="c-comment">// data точно есть</span>
    <span class="c-key">case</span> <span class="c-str">'error'</span>:   <span class="c-key">return</span> &lt;<span class="c-type">Error</span> text={state.message} /&gt;;   <span class="c-comment">// message точно есть</span>
  }
}
<span class="c-comment">// state.data в ветке 'error' — ошибка компиляции, а не падение у пользователя</span></code></pre>
    <div class="remember-box"><strong>Признак, что приём нужен.</strong> В коде встречается <code>data!</code> с восклицательным знаком или <code>as</code> — значит, вы знаете о данных больше, чем тип. Почти всегда это означает, что тип описан через необязательные поля там, где нужно объединение.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-check"></i> Проверка полноты</div>
    <p class="text">Через год в объединение добавят новый вариант. Нужно, чтобы компилятор показал все места, которые его не обрабатывают, — иначе ошибка найдётся на проде.</p>
<pre><code><span class="c-key">type</span> <span class="c-type">Payment</span> =
  | { kind: <span class="c-str">'card'</span>; last4: <span class="c-type">string</span> }
  | { kind: <span class="c-str">'cash'</span> }
  | { kind: <span class="c-str">'crypto'</span>; chain: <span class="c-type">string</span> };   <span class="c-comment">// ← добавили позже</span>

<span class="c-key">function</span> <span class="c-fn">label</span>(p: <span class="c-type">Payment</span>): <span class="c-type">string</span> {
  <span class="c-key">switch</span> (p.kind) {
    <span class="c-key">case</span> <span class="c-str">'card'</span>: <span class="c-key">return</span> `Карта •••• ${p.last4}`;
    <span class="c-key">case</span> <span class="c-str">'cash'</span>: <span class="c-key">return</span> <span class="c-str">'Наличные'</span>;
    <span class="c-key">default</span>: {
      <span class="c-comment">// если какой-то вариант не обработан, он «дотечёт» сюда</span>
      <span class="c-comment">// и не подойдёт под never — будет ошибка компиляции</span>
      <span class="c-key">const</span> rest: <span class="c-type">never</span> = p;
      <span class="c-key">throw</span> <span class="c-key">new</span> <span class="c-type">Error</span>(`Неизвестный способ оплаты: ${<span class="c-type">JSON</span>.<span class="c-fn">stringify</span>(rest)}`);
    }
  }
}
<span class="c-comment">// Ошибка: Type '{ kind: "crypto"; chain: string; }' is not assignable to type 'never'</span></code></pre>
    <div class="pitfall"><strong>Метка должна быть литералом.</strong> Если поле объявлено как <code>kind: string</code>, сужение не работает — TypeScript не может различить варианты. Нужны именно строковые литералы.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="box"></i> Объединение вместо enum</div>
    <p class="text">В TypeScript есть <code>enum</code>, но в современном коде чаще берут объединение строковых литералов: оно не оставляет следа после компиляции, проще сериализуется и лучше читается в отладчике.</p>
    <table class="data-table">
      <thead><tr><th></th><th>enum</th><th>Объединение литералов</th></tr></thead>
      <tbody>
        <tr><td>Код после сборки</td><td>Создаёт объект в бандле</td><td>Исчезает полностью</td></tr>
        <tr><td>Значение в отладчике</td><td>Число, если не строковый enum</td><td>Читаемая строка</td></tr>
        <tr><td>Сравнение с данными API</td><td>Нужно приводить</td><td>Напрямую</td></tr>
        <tr><td>Перебор вариантов</td><td>Встроенный</td><td>Через массив <code>as const</code></td></tr>
      </tbody>
    </table>
<pre><code><span class="c-key">const</span> ROLES = [<span class="c-str">'admin'</span>, <span class="c-str">'editor'</span>, <span class="c-str">'viewer'</span>] <span class="c-key">as const</span>;
<span class="c-key">type</span> <span class="c-type">Role</span> = <span class="c-key">typeof</span> ROLES[<span class="c-type">number</span>];   <span class="c-comment">// 'admin' | 'editor' | 'viewer'</span>

<span class="c-comment">// Массив можно перебирать, тип выводится из него — источник один</span>
ROLES.<span class="c-fn">forEach</span>(r =&gt; <span class="c-fn">console</span>.<span class="c-fn">log</span>(r));</code></pre>
    <div class="pitfall"><strong>const enum</strong> ведёт себя иначе при раздельной сборке модулей и ломается с <code>isolatedModules</code>, который включён в сборщиках на основе esbuild (Vite). В новом коде его лучше не использовать.</div>
  </div>
</div>
@endverbatim
@verbatim
<div id="sec-ts-runtime" class="section">
  <div class="section-title">TypeScript: типы против валидации</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield-alert"></i> Граница компиляции и рантайма</div>
    <div class="info-box danger"><strong>Типы исчезают при компиляции.</strong> В собранном JS их нет вообще. Тип не защищает от данных, которые пришли снаружи: от клиента, из API, из localStorage. Объявление <code>const user: User = await res.json()</code> — это <em>обещание</em>, а не проверка.</div>
    <table class="data-table">
      <thead><tr><th></th><th>Типы</th><th>Валидация</th></tr></thead>
      <tbody>
        <tr><td><strong>Когда работает</strong></td><td>Компиляция</td><td>Рантайм</td></tr>
        <tr><td><strong>От чего защищает</strong></td><td>От ошибок в <em>своём</em> коде</td><td>От неверных <em>внешних</em> данных</td></tr>
        <tr><td><strong>Инструменты</strong></td><td><code>tsc</code></td><td><code>zod</code>, <code>class-validator</code>, DTO</td></tr>
      </tbody>
    </table>
<pre><code><span class="c-comment">// zod: схема одновременно проверяет и ВЫВОДИТ тип</span>
<span class="c-key">const</span> <span class="c-type">UserSchema</span> = z.<span class="c-fn">object</span>({
  id:    z.<span class="c-fn">string</span>().<span class="c-fn">uuid</span>(),
  email: z.<span class="c-fn">string</span>().<span class="c-fn">email</span>(),
  age:   z.<span class="c-fn">number</span>().<span class="c-fn">int</span>().<span class="c-fn">min</span>(<span class="c-num">0</span>),
});

<span class="c-key">type</span> <span class="c-type">User</span> = z.<span class="c-fn">infer</span>&lt;<span class="c-key">typeof</span> <span class="c-type">UserSchema</span>&gt;;   <span class="c-comment">// тип из схемы, не дублируем</span>

<span class="c-key">const</span> user = <span class="c-type">UserSchema</span>.<span class="c-fn">parse</span>(<span class="c-key">await</span> res.<span class="c-fn">json</span>());  <span class="c-comment">// бросит, если данные не те</span></code></pre>
    <div class="remember-box">На бэкенде ту же роль играют DTO с <code>class-validator</code>: тип описывает форму, декораторы проверяют значение в рантайме. Одно без другого неполно.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield-check"></i> Где проходит граница проверки</div>
    <p class="text">Валидировать всё подряд дорого и неудобно. Практичный подход: проверять данные ровно один раз — на входе в приложение, — а дальше работать с уже доверенными типами.</p>
    <div class="diagram">внешний мир          граница              внутренности приложения
─────────────        ─────────            ───────────────────────
ответ API       →    схема (zod)     →    типизированные данные
формы           →    схема           →    команда или запрос
localStorage    →    схема           →    состояние
параметры URL   →    схема           →    фильтры

За границей — unknown. Внутри — типы, которым можно верить.</div>
    <table class="data-table">
      <thead><tr><th>Проверять обязательно</th><th>Проверять не нужно</th></tr></thead>
      <tbody>
        <tr><td>Ответы внешних сервисов</td><td>Данные, которые вы только что сами и составили</td></tr>
        <tr><td>Тело запроса от клиента</td><td>Внутренние вызовы между своими функциями</td></tr>
        <tr><td><code>localStorage</code> и cookie</td><td>Константы в коде</td></tr>
        <tr><td>Параметры адреса</td><td>Результат уже провалидированной схемы</td></tr>
      </tbody>
    </table>
    <div class="remember-box"><strong>Знакомая аналогия.</strong> Это та же роль, что у FormRequest в Laravel: до него — сырые данные запроса, после — проверенные. Разница лишь в том, что на фронтенде такую границу приходится ставить самому, и чаще всего её ставят вокруг слоя запросов к API.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-check"></i> Один источник истины для типа и проверки</div>
    <p class="text">Описывать форму данных дважды — отдельно интерфейс и отдельно проверку — верный способ получить расхождение. Схема решает обе задачи сразу: проверяет и выводит тип.</p>
<pre><code><span class="c-key">import</span> { z } <span class="c-key">from</span> <span class="c-str">'zod'</span>;

<span class="c-key">const</span> OrderSchema = z.<span class="c-fn">object</span>({
  id: z.<span class="c-fn">number</span>().<span class="c-fn">int</span>().<span class="c-fn">positive</span>(),
  status: z.<span class="c-fn">enum</span>([<span class="c-str">'new'</span>, <span class="c-str">'paid'</span>, <span class="c-str">'shipped'</span>]),
  total: z.<span class="c-fn">number</span>().<span class="c-fn">nonnegative</span>(),
  comment: z.<span class="c-fn">string</span>().<span class="c-fn">optional</span>(),
});

<span class="c-comment">// Тип выводится из схемы — второго описания не существует</span>
<span class="c-key">type</span> <span class="c-type">Order</span> = z.<span class="c-fn">infer</span>&lt;<span class="c-key">typeof</span> OrderSchema&gt;;

<span class="c-key">async function</span> <span class="c-fn">loadOrder</span>(id: <span class="c-type">number</span>): <span class="c-type">Promise</span>&lt;<span class="c-type">Order</span>&gt; {
  <span class="c-key">const</span> res = <span class="c-key">await</span> <span class="c-fn">fetch</span>(`/api/orders/${id}`);
  <span class="c-key">if</span> (!res.ok) <span class="c-key">throw</span> <span class="c-key">new</span> <span class="c-type">Error</span>(`HTTP ${res.status}`);

  <span class="c-comment">// safeParse не бросает — удобно показать понятную ошибку</span>
  <span class="c-key">const</span> parsed = OrderSchema.<span class="c-fn">safeParse</span>(<span class="c-key">await</span> res.<span class="c-fn">json</span>());
  <span class="c-key">if</span> (!parsed.success) {
    <span class="c-fn">report</span>(parsed.error);                  <span class="c-comment">// бэкенд изменил контракт</span>
    <span class="c-key">throw</span> <span class="c-key">new</span> <span class="c-type">Error</span>(<span class="c-str">'Неверный формат ответа'</span>);
  }
  <span class="c-key">return</span> parsed.data;                      <span class="c-comment">// здесь данным уже можно верить</span>
}</code></pre>
    <div class="pitfall"><strong>Молчаливое падение без схемы.</strong> <code>const o = await res.json() as Order</code> компилируется всегда. Если сервер переименовал поле, ошибка вылезет в компоненте при отрисовке — в месте, по которому причину уже не найти.</div>
  </div>

</div>

@endverbatim
@verbatim
<div id="sec-ts-react" class="section">
  <div class="section-title">TypeScript в React</div>
  <div class="subsection">
<pre><code><span class="c-comment">// Пропсы компонента</span>
<span class="c-key">interface</span> <span class="c-type">ButtonProps</span> <span class="c-key">extends</span> <span class="c-type">React</span>.<span class="c-type">ButtonHTMLAttributes</span>&lt;<span class="c-type">HTMLButtonElement</span>&gt; {
  variant?: <span class="c-str">'primary'</span> | <span class="c-str">'ghost'</span>;
  loading?: <span class="c-key">boolean</span>;
}

<span class="c-key">export function</span> <span class="c-fn">Button</span>({ variant = <span class="c-str">'primary'</span>, loading, ...rest }: <span class="c-type">ButtonProps</span>) {
  <span class="c-key">return</span> &lt;button disabled={loading} {...rest} /&gt;;
}</code></pre>
<pre><code><span class="c-comment">// Состояние: явный тип нужен, когда начальное значение не описывает форму</span>
<span class="c-key">const</span> [user, setUser] = <span class="c-fn">useState</span>&lt;<span class="c-type">User</span> | <span class="c-key">null</span>&gt;(<span class="c-key">null</span>);
<span class="c-key">const</span> [items, setItems] = <span class="c-fn">useState</span>&lt;<span class="c-type">Item</span>[]&gt;([]);

<span class="c-comment">// Ссылка на DOM-узел</span>
<span class="c-key">const</span> inputRef = <span class="c-fn">useRef</span>&lt;<span class="c-type">HTMLInputElement</span>&gt;(<span class="c-key">null</span>);

<span class="c-comment">// Событие</span>
<span class="c-key">const</span> <span class="c-fn">onChange</span> = (e: <span class="c-type">React</span>.<span class="c-type">ChangeEvent</span>&lt;<span class="c-type">HTMLInputElement</span>&gt;) =&gt; <span class="c-fn">setText</span>(e.target.value);</code></pre>
    <div class="remember-box">Расширение нативных атрибутов (<code>ButtonHTMLAttributes</code>) даёт компоненту все стандартные пропсы — <code>onClick</code>, <code>disabled</code>, <code>type</code> — без ручного перечисления.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="mouse-pointer-click"></i> События и ссылки на узлы</div>
    <p class="text">Типы событий React именованы по виду события и типу элемента. Проще всего не писать их вручную, а дать вывести из места использования.</p>
<pre><code><span class="c-comment">// Обработчик объявлен прямо в разметке — тип выводится сам</span>
&lt;<span class="c-type">input</span> onChange={e =&gt; <span class="c-fn">setValue</span>(e.target.value)} /&gt;

<span class="c-comment">// Вынесли в отдельную функцию — тип нужно указать</span>
<span class="c-key">function</span> <span class="c-fn">handleChange</span>(e: <span class="c-type">React.ChangeEvent</span>&lt;<span class="c-type">HTMLInputElement</span>&gt;) {
  <span class="c-fn">setValue</span>(e.target.value);
}

<span class="c-key">function</span> <span class="c-fn">handleSubmit</span>(e: <span class="c-type">React.FormEvent</span>&lt;<span class="c-type">HTMLFormElement</span>&gt;) {
  e.<span class="c-fn">preventDefault</span>();
}

<span class="c-comment">// Ссылки на узлы: начальное значение null, отсюда и проверка перед обращением</span>
<span class="c-key">const</span> inputRef = <span class="c-fn">useRef</span>&lt;<span class="c-type">HTMLInputElement</span>&gt;(<span class="c-key">null</span>);
inputRef.current?.<span class="c-fn">focus</span>();</code></pre>
    <table class="data-table">
      <thead><tr><th>Что типизируем</th><th>Тип</th></tr></thead>
      <tbody>
        <tr><td>Содержимое компонента</td><td><code>React.ReactNode</code></td></tr>
        <tr><td>Обработчик без параметров</td><td><code>() =&gt; void</code></td></tr>
        <tr><td>Клик по кнопке</td><td><code>React.MouseEvent&lt;HTMLButtonElement&gt;</code></td></tr>
        <tr><td>Все атрибуты элемента</td><td><code>React.ComponentProps&lt;'button'&gt;</code></td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong>React.FC.</strong> Этот тип долго был привычным, но он навязывает <code>children</code> даже компонентам, которые их не принимают, и мешает дженерикам. Сейчас рекомендуют обычную функцию с типизированным объектом props — как в примерах выше.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="boxes"></i> Дженерик-компоненты</div>
    <p class="text">Компонент списка, который должен работать с любыми данными и при этом сохранять их тип в колбэках, объявляется обобщённым.</p>
<pre><code><span class="c-key">interface</span> <span class="c-type">ListProps</span>&lt;<span class="c-type">T</span>&gt; {
  items: <span class="c-type">T</span>[];
  getKey: (item: <span class="c-type">T</span>) =&gt; <span class="c-type">string</span> | <span class="c-type">number</span>;
  renderItem: (item: <span class="c-type">T</span>) =&gt; <span class="c-type">React.ReactNode</span>;
}

<span class="c-key">export function</span> <span class="c-fn">List</span>&lt;<span class="c-type">T</span>&gt;({ items, getKey, renderItem }: <span class="c-type">ListProps</span>&lt;<span class="c-type">T</span>&gt;) {
  <span class="c-key">return</span> &lt;<span class="c-type">ul</span>&gt;{items.<span class="c-fn">map</span>(i =&gt; &lt;<span class="c-type">li</span> key={<span class="c-fn">getKey</span>(i)}&gt;{<span class="c-fn">renderItem</span>(i)}&lt;/<span class="c-type">li</span>&gt;)}&lt;/<span class="c-type">ul</span>&gt;;
}

<span class="c-comment">// T выводится из items — внутри renderItem доступны поля Order</span>
&lt;<span class="c-type">List</span>
  items={orders}
  getKey={o =&gt; o.id}
  renderItem={o =&gt; &lt;<span class="c-type">b</span>&gt;{o.total}&lt;/<span class="c-type">b</span>&gt;}
/&gt;</code></pre>
    <div class="remember-box"><strong>Что это даёт.</strong> Один компонент списка на всё приложение — и при этом полная проверка полей внутри каждого использования. Без дженерика пришлось бы писать <code>any</code> и потерять подсказки редактора ровно там, где они нужнее всего.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-tw-config" class="section">
  <div class="section-title">Токены, тема и тёмный режим</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="palette"></i> Откуда берутся классы</div>
    <p class="text">Tailwind не даёт готовых компонентов. Он берёт набор значений — цвета, отступы, размеры шрифта, радиусы — и генерирует из них классы. Этот набор называют дизайн-токенами, и именно его настраивают под проект.</p>
<pre><code><span class="c-comment">/* Tailwind v4: конфигурация прямо в CSS, отдельный tailwind.config.js не нужен */</span>
<span class="c-key">@import</span> <span class="c-str">"tailwindcss"</span>;

<span class="c-key">@theme</span> {
  <span class="c-comment">/* имя токена определяет имя класса: --color-brand → bg-brand, text-brand */</span>
  --color-brand: <span class="c-str">#ea2845</span>;
  --color-surface: <span class="c-str">#fdfdfd</span>;
  --font-display: <span class="c-str">"Manrope"</span>, sans-serif;
  --radius-card: <span class="c-num">14px</span>;
}</code></pre>
<pre><code><span class="c-comment">// Tailwind v3: привычный файл конфигурации</span>
<span class="c-comment">// extend добавляет к стандартной палитре, без него она заменяется целиком</span>
<span class="c-key">export default</span> {
  content: [<span class="c-str">'./src/**/*.{ts,tsx}'</span>],
  theme: {
    extend: {
      colors: { brand: <span class="c-str">'#ea2845'</span> },
      borderRadius: { card: <span class="c-str">'14px'</span> },
    },
  },
};</code></pre>
    <div class="remember-box"><strong>Почему это важнее, чем кажется.</strong> Пока цвета и отступы берутся из токенов, интерфейс остаётся согласованным сам собой: нельзя случайно поставить «почти такой же» оттенок. Как только в разметке появляются произвольные значения вроде <code>bg-[#e82746]</code>, это свойство теряется.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="moon"></i> Тёмная тема</div>
    <p class="text">Вариант <code>dark:</code> применяет класс в тёмном режиме. Вопрос лишь в том, откуда берётся признак темноты.</p>
    <table class="data-table">
      <thead><tr><th>Стратегия</th><th>Как включается</th><th>Когда подходит</th></tr></thead>
      <tbody>
        <tr><td>По системной настройке</td><td>Поведение по умолчанию, через медиазапрос</td><td>Переключателя в интерфейсе нет</td></tr>
        <tr><td>По классу или атрибуту</td><td><code>&lt;html class="dark"&gt;</code> и своё правило варианта</td><td>Пользователь выбирает тему сам</td></tr>
      </tbody>
    </table>
<pre><code><span class="c-comment">/* v4: объявляем, что тёмная тема включается атрибутом на html */</span>
<span class="c-key">@custom-variant</span> dark (&amp;:where([data-theme=<span class="c-str">"dark"</span>], [data-theme=<span class="c-str">"dark"</span>] *));</code></pre>
<pre><code>&lt;<span class="c-type">div</span> className=<span class="c-str">"bg-white text-slate-900 dark:bg-slate-900 dark:text-slate-100"</span>&gt;
  Карточка, которая умеет обе темы
&lt;/<span class="c-type">div</span>&gt;</code></pre>
    <div class="pitfall"><strong>Мигание при загрузке.</strong> Если тема читается из <code>localStorage</code> после загрузки React, страница сначала покажется светлой, а потом перекрасится. Лечится маленьким скриптом в <code>&lt;head&gt;</code>, который выставляет атрибут до первой отрисовки — ровно так сделано в этой базе знаний.</div>
    <div class="pitfall"><strong>Удвоение классов.</strong> Писать <code>dark:</code> у каждого элемента утомительно и легко забыть. Надёжнее описать цвета переменными CSS, переопределить их для тёмной темы один раз и ссылаться на токены.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="search-x"></i> Почему класс не применился</div>
    <p class="text">Сборщик ищет имена классов <strong>текстом</strong> по исходникам. Он не выполняет код, поэтому собранное из кусков имя в сборку не попадёт — класс просто не будет существовать.</p>
<pre><code><span class="c-comment">// ❌ Класса не окажется в CSS: такой строки в исходнике нет</span>
<span class="c-key">const</span> cls = `text-${color}-500`;

<span class="c-comment">// ✅ Полные имена классов записаны явно</span>
<span class="c-key">const</span> COLORS = {
  danger: <span class="c-str">'text-red-500'</span>,
  success: <span class="c-str">'text-green-500'</span>,
} <span class="c-key">as const</span>;
<span class="c-key">const</span> cls = COLORS[kind];</code></pre>
    <table class="data-table">
      <thead><tr><th>Симптом</th><th>Обычная причина</th></tr></thead>
      <tbody>
        <tr><td>Класс не работает только в проде</td><td>Имя собиралось из кусков; в разработке спасал полный набор классов</td></tr>
        <tr><td>Не работает в новой папке</td><td>Путь не попал в <code>content</code> (v3) или не просматривается сборщиком (v4)</td></tr>
        <tr><td>Классы из библиотеки не применяются</td><td>Её файлы лежат в <code>node_modules</code> и не просматриваются</td></tr>
        <tr><td>Два класса конфликтуют</td><td>Порядок в атрибуте не решает ничего — выигрывает тот, что идёт позже в CSS. Нужен <code>tailwind-merge</code></td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="combine"></i> Склейка классов в компонентах</div>
    <p class="text">Когда компонент принимает <code>className</code> снаружи, простая конкатенация даёт конфликт: в разметке будут оба класса, а применится не тот, который ожидали.</p>
<pre><code><span class="c-key">import</span> { twMerge } <span class="c-key">from</span> <span class="c-str">'tailwind-merge'</span>;
<span class="c-key">import</span> { clsx } <span class="c-key">from</span> <span class="c-str">'clsx'</span>;

<span class="c-comment">// clsx — собирает классы по условиям</span>
<span class="c-comment">// twMerge — убирает конфликтующие, оставляя последний</span>
<span class="c-key">export function</span> <span class="c-fn">Button</span>({ variant = <span class="c-str">'primary'</span>, className, ...rest }) {
  <span class="c-key">return</span> (
    &lt;<span class="c-type">button</span>
      className={<span class="c-fn">twMerge</span>(<span class="c-fn">clsx</span>(
        <span class="c-str">'rounded-card px-4 py-2 font-semibold transition'</span>,
        variant === <span class="c-str">'primary'</span> &amp;&amp; <span class="c-str">'bg-brand text-white hover:opacity-90'</span>,
        variant === <span class="c-str">'ghost'</span>   &amp;&amp; <span class="c-str">'bg-transparent text-brand'</span>,
      ), className)}
      {...rest}
    /&gt;
  );
}

<span class="c-comment">// &lt;Button className="px-6" /&gt; → останется px-6, а не оба px-4 и px-6</span></code></pre>
    <div class="remember-box"><strong>Для разработчика на бэкенде.</strong> Это та же задача, что и с конфликтом CSS-правил по специфичности, только решённая на уровне сборки строки классов, а не каскада. Класс в атрибуте — лишь имя; какое правило победит, решает порядок в итоговом файле CSS.</div>
  </div>
</div>
@endverbatim
@verbatim
<div id="sec-tw-base" class="section">
  <div class="section-title">Tailwind: утилитарный подход</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="palette"></i> Классы вместо отдельных стилей</div>
    <p class="text">Вместо написания CSS для каждого блока — готовые утилитарные классы прямо в разметке. Один класс делает одну вещь.</p>
<pre><code>&lt;button class=<span class="c-str">"px-4 py-2 rounded-lg bg-indigo-600 text-white font-medium
               hover:bg-indigo-700 disabled:opacity-50"</span>&gt;
  Отправить
&lt;/button&gt;</code></pre>
    <table class="data-table">
      <thead><tr><th>Плюс</th><th>Минус</th></tr></thead>
      <tbody>
        <tr><td>Не нужно придумывать имена классов</td><td>Разметка становится шумной</td></tr>
        <tr><td>Стиль виден прямо в разметке</td><td>Трудно читать длинные строки классов</td></tr>
        <tr><td>Нет мёртвого CSS — в сборку попадает только использованное</td><td>Повторы, если не выносить в компоненты</td></tr>
        <tr><td>Нет конфликтов специфичности</td><td>Порог входа: надо выучить названия</td></tr>
      </tbody>
    </table>
    <div class="why-box"><strong>Конфиг темы — источник правды.</strong> Цвета, отступы, шрифты и брейкпоинты задаются один раз в конфиге, а классы из него генерируются. Поэтому <code>bg-brand-500</code> везде означает один и тот же цвет, и поменять его можно в одном месте.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="ruler"></i> Почему шкала, а не произвольные числа</div>
    <p class="text">Классы отступов и размеров берутся из шкалы, где шаг равен 0.25rem. Это выглядит ограничением, но именно оно даёт согласованный ритм: в интерфейсе не появятся отступы 13px, 14px и 15px рядом.</p>
    <table class="data-table">
      <thead><tr><th>Класс</th><th>Значение</th><th>В пикселях при корне 16px</th></tr></thead>
      <tbody>
        <tr><td><code>p-1</code></td><td>0.25rem</td><td>4px</td></tr>
        <tr><td><code>p-2</code></td><td>0.5rem</td><td>8px</td></tr>
        <tr><td><code>p-4</code></td><td>1rem</td><td>16px</td></tr>
        <tr><td><code>p-6</code></td><td>1.5rem</td><td>24px</td></tr>
        <tr><td><code>p-[13px]</code></td><td>произвольное</td><td>13px — выпадает из шкалы</td></tr>
      </tbody>
    </table>
    <p class="text">Произвольные значения в квадратных скобках существуют для редких случаев: подгонка под фон-картинку, чужой виджет, точный размер иконки. Если они встречаются часто — значение стоит добавить в тему как токен.</p>
    <div class="pitfall"><strong>Произвольные значения вместо токенов.</strong> <code>bg-[#ea2845]</code> в двадцати местах означает, что смена фирменного цвета превратится в поиск по проекту. Токен <code>bg-brand</code> меняется в одном файле.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-diff"></i> Сравнение с привычными подходами</div>
    <table class="data-table">
      <thead><tr><th></th><th>Обычный CSS и БЭМ</th><th>CSS-модули</th><th>Tailwind</th></tr></thead>
      <tbody>
        <tr><td>Имена классов</td><td>Придумываете сами</td><td>Придумываете, уникальность автоматом</td><td>Не придумываете вовсе</td></tr>
        <tr><td>Риск конфликта стилей</td><td>Высокий, каскад глобальный</td><td>Нет</td><td>Нет</td></tr>
        <tr><td>Мёртвый код</td><td>Копится незаметно</td><td>Копится</td><td>Невозможен: в сборку идёт использованное</td></tr>
        <tr><td>Где смотреть стиль</td><td>В другом файле</td><td>В другом файле</td><td>Прямо в разметке</td></tr>
        <tr><td>Чем платите</td><td>Именованием и каскадом</td><td>Переключением между файлами</td><td>Длинными строками классов</td></tr>
      </tbody>
    </table>
    <div class="remember-box"><strong>Суть выбора.</strong> Tailwind меняет проблему «придумать имя и не сломать каскад» на проблему «разметка стала шумной». Первая со временем усложняется, вторая решается выделением компонентов — поэтому в больших проектах обмен обычно считают выгодным.</div>
  </div>

</div>

@endverbatim
@verbatim
<div id="sec-tw-responsive" class="section">
  <div class="section-title">Tailwind: адаптив и состояния</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="smartphone"></i> Префиксы</div>
<pre><code>&lt;div class=<span class="c-str">"grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4"</span>&gt;</code></pre>
    <table class="data-table">
      <thead><tr><th>Группа</th><th>Префиксы</th><th>Смысл</th></tr></thead>
      <tbody>
        <tr><td>Адаптив</td><td><code>sm:</code> <code>md:</code> <code>lg:</code> <code>xl:</code></td><td>Применить <strong>от</strong> этой ширины и выше</td></tr>
        <tr><td>Состояния</td><td><code>hover:</code> <code>focus:</code> <code>active:</code> <code>disabled:</code></td><td>По состоянию элемента</td></tr>
        <tr><td>Тёмная тема</td><td><code>dark:</code></td><td>При включённой тёмной теме</td></tr>
        <tr><td>От родителя</td><td><code>group-hover:</code> <code>peer-checked:</code></td><td>Реакция на состояние соседа или родителя</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong>Tailwind — mobile first.</strong> Класс без префикса действует на <em>всех</em> ширинах, а <code>md:</code> — от средней и выше. Поэтому базовые стили пишут для мобильного, а префиксами расширяют. Попытка сделать наоборот приводит к войне с каскадом.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="maximize"></i> Контейнерные запросы</div>
    <p class="text">Обычные префиксы смотрят на ширину окна. Но компоненту чаще важна ширина <em>его места</em>: одна и та же карточка в широкой колонке и в узкой боковой панели должна выглядеть по-разному, хотя окно одно.</p>
<pre><code>&lt;<span class="c-type">div</span> className=<span class="c-str">"@container"</span>&gt;
  <span class="c-comment">&lt;!-- смотрит на ширину родителя с @container, а не окна --&gt;</span>
  &lt;<span class="c-type">article</span> className=<span class="c-str">"flex flex-col @md:flex-row @md:items-center gap-4"</span>&gt;
    &lt;<span class="c-type">img</span> className=<span class="c-str">"w-full @md:w-32 rounded-lg"</span> /&gt;
    &lt;<span class="c-type">div</span>&gt;…&lt;/<span class="c-type">div</span>&gt;
  &lt;/<span class="c-type">article</span>&gt;
&lt;/<span class="c-type">div</span>&gt;</code></pre>
    <div class="remember-box"><strong>Когда что брать.</strong> Ширина окна — для общей раскладки страницы: количество колонок, показывать ли боковое меню. Ширина контейнера — для компонентов, которые переиспользуются в разных по размеру местах.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="link-2"></i> Реакция на состояние соседа и родителя</div>
    <p class="text">Два механизма закрывают случаи, ради которых раньше писали JavaScript: <code>group</code> — реакция на состояние родителя, <code>peer</code> — на состояние соседнего элемента.</p>
<pre><code><span class="c-comment">&lt;!-- group: стрелка реагирует на наведение всей карточки --&gt;</span>
&lt;<span class="c-type">a</span> className=<span class="c-str">"group flex items-center gap-2 rounded-lg p-4 hover:bg-slate-50"</span>&gt;
  &lt;<span class="c-type">span</span>&gt;Открыть раздел&lt;/<span class="c-type">span</span>&gt;
  &lt;<span class="c-type">Arrow</span> className=<span class="c-str">"transition group-hover:translate-x-1"</span> /&gt;
&lt;/<span class="c-type">a</span>&gt;

<span class="c-comment">&lt;!-- peer: подсказка показывается, когда поле не прошло проверку --&gt;</span>
&lt;<span class="c-type">input</span> type=<span class="c-str">"email"</span> required className=<span class="c-str">"peer border rounded px-3 py-2"</span> /&gt;
&lt;<span class="c-type">p</span> className=<span class="c-str">"hidden peer-invalid:block text-sm text-red-600"</span>&gt;
  Введите корректный адрес
&lt;/<span class="c-type">p</span>&gt;</code></pre>
    <div class="pitfall"><strong>peer работает только вперёд.</strong> Селектор опирается на «следующего соседа», поэтому реагирующий элемент должен идти в разметке <em>после</em> того, за кем следит. Если расположить наоборот, стиль просто не применится.</div>
  </div>

</div>

@endverbatim
@verbatim
<div id="sec-tw-organize" class="section">
  <div class="section-title">Tailwind: как не утонуть в классах</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="boxes"></i> Повторы выносятся в компоненты</div>
    <div class="info-box success"><strong>Главное правило.</strong> Повторяющиеся наборы классов выносят <strong>в компоненты</strong>, а не в <code>@apply</code> повсюду. Компонент — естественная единица переиспользования; <code>@apply</code> возвращает ровно ту проблему именованных классов, от которой уходили.</div>
<pre><code><span class="c-comment">// Вместо копирования классов по всему проекту — один компонент</span>
<span class="c-key">export function</span> <span class="c-fn">Card</span>({ children }: { children: <span class="c-type">React</span>.<span class="c-type">ReactNode</span> }) {
  <span class="c-key">return</span> (
    &lt;div className=<span class="c-str">"rounded-xl border border-slate-200 bg-white p-5 shadow-sm"</span>&gt;
      {children}
    &lt;/div&gt;
  );
}</code></pre>
<pre><code><span class="c-comment">// Условные классы — через clsx, а не конкатенацию строк</span>
&lt;button className={<span class="c-fn">clsx</span>(
  <span class="c-str">'px-4 py-2 rounded-lg'</span>,
  variant === <span class="c-str">'primary'</span> &amp;&amp; <span class="c-str">'bg-indigo-600 text-white'</span>,
  variant === <span class="c-str">'ghost'</span>   &amp;&amp; <span class="c-str">'bg-transparent text-indigo-600'</span>,
  disabled &amp;&amp; <span class="c-str">'opacity-50 cursor-not-allowed'</span>,
)} /&gt;</code></pre>
    <div class="pitfall"><strong>Классы нельзя собирать из кусков строк.</strong> Запись <code>`bg-${color}-500`</code> не сработает: сборщик сканирует исходники по полным именам классов и такой класс просто не попадёт в CSS. Нужны полные имена в коде — в объекте-карте или в условиях.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list-tree"></i> Варианты компонента без лесенки условий</div>
    <p class="text">Когда у кнопки появляются вид, размер и состояние, условные выражения в <code>clsx</code> превращаются в кашу. Для этого есть class-variance-authority: варианты описываются таблицей.</p>
<pre><code><span class="c-key">import</span> { cva, <span class="c-key">type</span> <span class="c-type">VariantProps</span> } <span class="c-key">from</span> <span class="c-str">'class-variance-authority'</span>;

<span class="c-key">const</span> button = <span class="c-fn">cva</span>(
  <span class="c-str">'inline-flex items-center justify-center rounded-lg font-medium transition'</span>,
  {
    variants: {
      intent: {
        primary: <span class="c-str">'bg-brand text-white hover:opacity-90'</span>,
        ghost:   <span class="c-str">'bg-transparent text-brand hover:bg-brand/10'</span>,
      },
      size: { sm: <span class="c-str">'h-8 px-3 text-sm'</span>, md: <span class="c-str">'h-10 px-4'</span> },
    },
    defaultVariants: { intent: <span class="c-str">'primary'</span>, size: <span class="c-str">'md'</span> },
  },
);

<span class="c-key">type</span> <span class="c-type">Props</span> = <span class="c-type">React.ComponentProps</span>&lt;<span class="c-str">'button'</span>&gt; &amp; <span class="c-type">VariantProps</span>&lt;<span class="c-key">typeof</span> button&gt;;

<span class="c-key">export function</span> <span class="c-fn">Button</span>({ intent, size, className, ...rest }: <span class="c-type">Props</span>) {
  <span class="c-key">return</span> &lt;<span class="c-type">button</span> className={<span class="c-fn">twMerge</span>(<span class="c-fn">button</span>({ intent, size }), className)} {...rest} /&gt;;
}
<span class="c-comment">// Типы вариантов выводятся из описания — опечатка в intent не скомпилируется</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-square"></i> Когда @apply всё-таки уместен</div>
    <p class="text">Общее правило — выносить повторы в компоненты. Но есть случаи, где компонента не существует и директива оправдана.</p>
    <table class="data-table">
      <thead><tr><th>Уместно</th><th>Не уместно</th></tr></thead>
      <tbody>
        <tr><td>Базовые стили документа: типографика, фокус, выделение</td><td>Воссоздание «своего» фреймворка из <code>.btn</code> и <code>.card</code></td></tr>
        <tr><td>Разметка из стороннего HTML, который нельзя править</td><td>Всё, что можно оформить компонентом</td></tr>
        <tr><td>Содержимое из Markdown или редактора</td><td>Сокращение «слишком длинной строки классов»</td></tr>
      </tbody>
    </table>
<pre><code><span class="c-key">@layer</span> base {
  <span class="c-comment">/* оправданно: применяется ко всем ссылкам в статьях */</span>
  .prose a { <span class="c-key">@apply</span> text-brand underline underline-offset-2; }
}</code></pre>
    <div class="pitfall"><strong>Главная ловушка <code>@apply</code>.</strong> Создавая <code>.btn</code> из утилит, вы возвращаетесь ровно к тому, от чего уходили: имя нужно придумать, стиль снова в другом файле, а мёртвый CSS опять копится. Разница лишь в том, что теперь это написано утилитами.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-pitfalls" class="section">
  <div class="section-title">Подводные камни</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="component"></i> React</div>
    <div class="pitfall"><strong>Устаревшее замыкание.</strong> Колбэк держит <code>state</code> старого рендера. Лечится честными зависимостями или <code>setState(prev =&gt; ...)</code>.</div>
    <div class="pitfall"><strong><code>useEffect</code> без массива зависимостей.</strong> Запускается после каждой перерисовки — и часто сам же её и вызывает.</div>
    <div class="pitfall"><strong>Гонка асинхронных запросов.</strong> Старый ответ перетирает новый. Нужна отмена в очистке эффекта.</div>
    <div class="pitfall"><strong><code>key</code> по индексу массива.</strong> При вставке в середину React переиспользует не те узлы — состояние элементов списка «съезжает».</div>
    <div class="pitfall"><strong>Мемоизация без замеров.</strong> <code>useMemo</code> на всём подряд усложняет код и может быть дороже самого вычисления.</div>
  </div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="type"></i> TypeScript</div>
    <div class="pitfall"><strong><code>any</code> как способ «починить» ошибку.</strong> Отключает проверки и расползается дальше по коду. Используй <code>unknown</code> и сужение.</div>
    <div class="pitfall"><strong>Вера в типы на границе приложения.</strong> <code>await res.json()</code> возвращает что угодно. Внешние данные проверяются в рантайме.</div>
    <div class="pitfall"><strong>Приведение через <code>as</code> вместо проверки.</strong> <code>as User</code> ничего не проверяет — это указание компилятору замолчать.</div>
    <div class="pitfall"><strong>Дублирование типов DTO и модели.</strong> Три похожих интерфейса разъедутся. Выводи их друг из друга через <code>Omit</code>, <code>Partial</code>, <code>Pick</code>.</div>
  </div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="palette"></i> Tailwind</div>
    <div class="pitfall"><strong>Динамическая сборка имён классов.</strong> <code>`text-${size}`</code> не попадёт в сборку — сканер ищет полные имена.</div>
    <div class="pitfall"><strong><code>@apply</code> вместо компонентов.</strong> Возвращает именованные классы и их проблемы, ради которых Tailwind и брали.</div>
    <div class="pitfall"><strong>Произвольные значения вместо темы.</strong> <code>p-[13px]</code> и <code>bg-[#1a2b3c]</code> в каждом файле ломают единообразие. Место таких значений — в конфиге.</div>
    <div class="pitfall"><strong>Попытка писать desktop first.</strong> Tailwind mobile first: класс без префикса — база для всех ширин.</div>
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
