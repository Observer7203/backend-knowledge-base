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
</head>
<body>
<div class="container">
<div class="sidebar">
  <a href="/" class="sidebar-back"><i data-lucide="arrow-left"></i> На главную</a>
  <div class="sidebar-title">React · TypeScript · Tailwind</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">React</div>
  <a class="nav-item" onclick="showSection('hooks',this)"><i data-lucide="anchor"></i> useState и useEffect</a>
  <a class="nav-item" onclick="showSection('rerender',this)"><i data-lucide="refresh-cw"></i> Перерисовки и мемоизация</a>
  <a class="nav-item" onclick="showSection('state-where',this)"><i data-lucide="layers"></i> Где хранить состояние</a>
  <a class="nav-item" onclick="showSection('custom-hooks',this)"><i data-lucide="puzzle"></i> Свои хуки</a>

  <div class="nav-group-label">TypeScript</div>
  <a class="nav-item" onclick="showSection('ts-base',this)"><i data-lucide="type"></i> interface, type, дженерики</a>
  <a class="nav-item" onclick="showSection('ts-utils',this)"><i data-lucide="wrench"></i> Утилитарные типы</a>
  <a class="nav-item" onclick="showSection('ts-narrowing',this)"><i data-lucide="filter"></i> Сужение типов</a>
  <a class="nav-item" onclick="showSection('ts-runtime',this)"><i data-lucide="shield-alert"></i> Типы против валидации</a>
  <a class="nav-item" onclick="showSection('ts-react',this)"><i data-lucide="component"></i> TypeScript в React</a>

  <div class="nav-group-label">Tailwind</div>
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
<div id="sec-hooks" class="section">
  <div class="section-title">useState и useEffect</div>
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
