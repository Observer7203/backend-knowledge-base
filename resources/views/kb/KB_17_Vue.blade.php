@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vue.js — база</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
  --bg:#F5F8FA;--surface:#FFFFFF;--border:#E4E6EF;--text:#181C32;--text2:#7E8299;--text3:#A1A5B7;
  --primary:#41B883;--primary-light:#E6F7EF;
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
.nav-item.active{background:var(--primary-light);color:var(--primary);font-weight:600;border-color:rgba(65,184,131,0.25);}
.main{margin-left:260px;padding:40px 48px;min-width:0;width:calc(100vw - 260px);}
.page-header{margin-bottom:32px;padding-bottom:24px;border-bottom:1px solid var(--border);}
.page-header h1{font-size:26px;font-weight:800;margin-bottom:8px;letter-spacing:-0.3px;}
.page-header p{color:var(--text2);font-size:14px;}
.badge-row{display:flex;gap:8px;flex-wrap:wrap;margin-top:12px;}
.badge{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;background:#EFF2F5;color:#5E6278;}
.badge-warning{background:var(--warning-light);color:var(--warning-dark);}
.badge-info{background:var(--info-light);color:var(--info);}
.badge-success{background:var(--success-light);color:var(--success-dark);}
.badge-vue{background:var(--primary-light);color:var(--primary);}
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
code{color:#0D7D53;padding:1px 4px;border-radius:4px;font-family:'SF Mono',monospace;font-size:12.5px;background:rgba(13,125,83,0.08);}
pre code{background:transparent;color:inherit;padding:0;border-radius:0;font-size:inherit;}
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:16px 18px;margin-bottom:12px;}
.card h3{font-size:13.5px;font-weight:700;margin-bottom:6px;}
.card p{color:var(--text2);font-size:13px;line-height:1.65;}
.data-table{width:100%;border-collapse:collapse;margin:12px 0 18px;background:var(--surface);border-radius:6px;overflow:hidden;font-size:13px;}
.data-table th{background:#F3F4F6;color:#1F2937;text-align:left;padding:9px 12px;border-bottom:2px solid #D1D5DB;font-weight:700;font-size:12.5px;}
.data-table td{padding:8px 12px;border-bottom:1px solid #E5E7EB;color:#374151;vertical-align:top;line-height:1.5;}
.data-table tr:hover td{background:#F9FAFB;}
.data-table code{background:#E6F7EF;color:#0D7D53;padding:1px 5px;border-radius:3px;font-size:11.5px;}
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
  <div class="sidebar-title">Vue.js — база</div>

  <a class="nav-item active" onclick="showSection('overview',this)"> Обзор</a>

  <div class="nav-group-label">Основы</div>
  <a class="nav-item" onclick="showSection('setup',this)">Установка + подключение</a>
  <a class="nav-item" onclick="showSection('options-api',this)">Options API</a>
  <a class="nav-item" onclick="showSection('composition-api',this)">Composition API + &lt;script setup&gt;</a>
  <a class="nav-item" onclick="showSection('reactivity',this)">Реактивность: ref / reactive</a>
  <a class="nav-item" onclick="showSection('computed-watch',this)">computed + watch</a>
  <a class="nav-item" onclick="showSection('template',this)">Template syntax</a>
  <a class="nav-item" onclick="showSection('directives',this)">Директивы v-if / v-for / v-model</a>
  <a class="nav-item" onclick="showSection('methods',this)">Methods + обработчики</a>
  <a class="nav-item" onclick="showSection('lifecycle',this)">Lifecycle hooks</a>
  <a class="nav-item" onclick="showSection('components',this)">Компоненты: props / emit / slots</a>
  <a class="nav-item" onclick="showSection('composables',this)">Composables (переиспользуемая логика)</a>

  <div class="nav-group-label">Экосистема</div>
  <a class="nav-item" onclick="showSection('router',this)">Vue Router</a>
  <a class="nav-item" onclick="showSection('pinia',this)">Pinia (state management)</a>
  <a class="nav-item" onclick="showSection('http',this)">HTTP запросы (axios / fetch)</a>

  <div class="nav-group-label">Под капотом</div>
  <a class="nav-item" onclick="showSection('under-hood-proxy',this)">Как работает реактивность (Proxy)</a>
  <a class="nav-item" onclick="showSection('under-hood-vdom',this)">Virtual DOM</a>

  <div class="nav-group-label">Интеграция с Laravel</div>
  <a class="nav-item" onclick="showSection('laravel-blade',this)">Blade + Vue</a>
  <a class="nav-item" onclick="showSection('laravel-csrf',this)">CSRF в Vue+Laravel</a>
  <a class="nav-item" onclick="showSection('laravel-full',this)">Полный поток: форма → API</a>

  <div class="nav-group-label">Сравнение и вопросы</div>
  <a class="nav-item" onclick="showSection('vue-vs',this)">Vue vs React vs jQuery</a>
  <a class="nav-item" onclick="showSection('options-vs-comp',this)">Options vs Composition API</a>
  <a class="nav-item" onclick="showSection('faq',this)">Частые вопросы</a>
</div>

<div class="main">
  <div class="page-header">
    <h1>Vue.js — база</h1>
    <p>Базовые конструкции Vue 3: реактивность, компоненты, роутинг, стейт, интеграция с Laravel. Advanced-темы (SSR, Suspense, кастомные рендереры) не входят.</p>
    <div class="badge-row">
      <span class="badge badge-vue">Vue 3</span>
      <span class="badge badge-info">Composition API</span>
      <span class="badge">Options API</span>
      <span class="badge badge-success">Laravel интеграция</span>
    </div>
  </div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-overview" class="section active">
  <div class="section-title">Обзор Vue.js</div>

  <div class="subsection">
    <p class="text">
      <strong>Vue.js</strong> — прогрессивный JS-фреймворк для построения UI. Создан Evan You в 2014. В отличие от Angular (полный фреймворк) и React (только view-слой) — Vue балансирует между ними: включает базу (реактивность, компоненты, роутер, стейт), но не навязывает архитектуру всего проекта.
    </p>
    <p class="text">
      Основная идея: <strong>реактивные данные</strong> + <strong>декларативные шаблоны</strong>. Меняешь данные — DOM обновляется сам. Не нужно вручную дёргать <code>element.innerHTML</code> или <code>$('.el').text()</code>.
    </p>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Vue 2 vs Vue 3</h3>
    <table class="data-table">
      <thead><tr><th></th><th>Vue 2 (2016)</th><th>Vue 3 (2020, актуально)</th></tr></thead>
      <tbody>
        <tr><td>Реактивность</td><td><code>Object.defineProperty</code> — не видит новые ключи объекта</td><td><code>Proxy</code> — видит любые изменения</td></tr>
        <tr><td>API</td><td>Options API (<code>data</code>, <code>methods</code>, <code>computed</code>)</td><td>Options + <strong>Composition API</strong> (setup, ref, reactive)</td></tr>
        <tr><td>TypeScript</td><td>Кривая поддержка</td><td>Полная нативная</td></tr>
        <tr><td>Скорость</td><td>Медленнее</td><td>~2× быстрее, легче</td></tr>
        <tr><td>Multiple root nodes</td><td>Только один корень</td><td>Fragments — любое количество</td></tr>
        <tr><td>Поддержка</td><td>End-of-life 2024</td><td>Активная разработка</td></tr>
      </tbody>
    </table>
    <div class="tip">Все новые проекты — на Vue 3. Vue 2 остаётся только в legacy. Этот раздел покрывает Vue 3.</div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Где используется</h3>
    <ul style="line-height:1.9;margin-left:20px">
      <li><strong>SPA</strong> (Single Page Applications) — админки, дашборды, приложения</li>
      <li><strong>Виджеты внутри Blade / WordPress</strong> — заменяет jQuery-плагины</li>
      <li><strong>Nuxt.js</strong> — Vue-based фреймворк для SSR / SSG (аналог Next.js для React)</li>
      <li><strong>Laravel + Inertia.js</strong> — SPA без REST API, Laravel-контроллеры отдают Vue-компоненты напрямую</li>
      <li><strong>Мобильные приложения</strong> через NativeScript / Ionic Vue</li>
    </ul>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-setup" class="section">
  <div class="section-title">Установка + подключение</div>

  <div class="subsection">
    <h3 class="subsection-title">Способ 1 — CDN (для виджетов внутри blade)</h3>
    <p class="text">Подходит когда Vue нужен только на одной странице как замена jQuery-виджета. Никакой сборки не требуется.</p>
    <pre><code>&lt;<span class="c-key">script</span> <span class="c-var">src</span>=<span class="c-str">"https://unpkg.com/vue@3/dist/vue.global.js"</span>&gt;&lt;/<span class="c-key">script</span>&gt;

&lt;<span class="c-key">div</span> <span class="c-var">id</span>=<span class="c-str">"app"</span>&gt;
    &lt;<span class="c-key">h1</span>&gt;{{ message }}&lt;/<span class="c-key">h1</span>&gt;
    &lt;<span class="c-key">button</span> @<span class="c-var">click</span>=<span class="c-str">"count++"</span>&gt;{{ count }}&lt;/<span class="c-key">button</span>&gt;
&lt;/<span class="c-key">div</span>&gt;

&lt;<span class="c-key">script</span>&gt;
    <span class="c-key">const</span> { <span class="c-var">createApp</span> } = <span class="c-type">Vue</span>;
    <span class="c-fn">createApp</span>({
        <span class="c-fn">data</span>() {
            <span class="c-key">return</span> { <span class="c-var">message</span>: <span class="c-str">'Привет'</span>, <span class="c-var">count</span>: <span class="c-num">0</span> };
        },
    }).<span class="c-fn">mount</span>(<span class="c-str">'#app'</span>);
&lt;/<span class="c-key">script</span>&gt;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Способ 2 — Vite (SPA / production)</h3>
    <pre><code><span class="c-comment"># Создать новый проект</span>
npm create vue@latest my-app
cd my-app
npm install
npm run dev              <span class="c-comment"># dev-сервер с hot reload</span>
npm run build            <span class="c-comment"># production билд в dist/</span></code></pre>
    <p class="text">Мастер создания задаст вопросы: TypeScript? Vue Router? Pinia? Vitest? — можно выбрать что нужно.</p>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Способ 3 — Laravel + Vite + Vue</h3>
    <p class="text">В Laravel-проекте:</p>
    <pre><code>npm install vue@latest @vitejs/plugin-vue</code></pre>
    <pre><code><span class="c-comment">// vite.config.js</span>
<span class="c-key">import</span> vue <span class="c-key">from</span> <span class="c-str">'@vitejs/plugin-vue'</span>;

<span class="c-key">export default</span> <span class="c-fn">defineConfig</span>({
    <span class="c-var">plugins</span>: [
        <span class="c-fn">laravel</span>({ <span class="c-var">input</span>: [<span class="c-str">'resources/js/app.js'</span>] }),
        <span class="c-fn">vue</span>(),
    ],
});</code></pre>
    <pre><code><span class="c-comment">// resources/js/app.js</span>
<span class="c-key">import</span> { <span class="c-var">createApp</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;
<span class="c-key">import</span> <span class="c-type">App</span> <span class="c-key">from</span> <span class="c-str">'./App.vue'</span>;

<span class="c-fn">createApp</span>(<span class="c-type">App</span>).<span class="c-fn">mount</span>(<span class="c-str">'#app'</span>);</code></pre>
    <pre><code><span class="c-comment">// resources/views/layouts/app.blade.php</span>
&lt;<span class="c-key">head</span>&gt;
    @vite([<span class="c-str">'resources/js/app.js'</span>])
&lt;/<span class="c-key">head</span>&gt;
&lt;<span class="c-key">body</span>&gt;
    &lt;<span class="c-key">div</span> <span class="c-var">id</span>=<span class="c-str">"app"</span>&gt;&lt;/<span class="c-key">div</span>&gt;
&lt;/<span class="c-key">body</span>&gt;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Способ 4 — Nuxt.js (полный фреймворк с SSR)</h3>
    <pre><code>npx nuxi@latest init my-app
cd my-app
npm install
npm run dev</code></pre>
    <p class="text">Nuxt даёт файловый роутинг (папка <code>pages/</code>), SSR/SSG из коробки, аналогично Next.js для React.</p>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-options-api" class="section">
  <div class="section-title">Options API — классический стиль</div>

  <div class="subsection">
    <p class="text">Options API — «классический» способ описания компонентов Vue: код разбит на <strong>секции</strong> (<code>data</code>, <code>methods</code>, <code>computed</code>, <code>watch</code>, <code>mounted</code>). Проще для новичков, чётко видно «где что».</p>

    <pre><code>&lt;<span class="c-key">template</span>&gt;
    &lt;<span class="c-key">div</span>&gt;
        &lt;<span class="c-key">h1</span>&gt;{{ title }}&lt;/<span class="c-key">h1</span>&gt;
        &lt;<span class="c-key">p</span>&gt;Возраст: {{ age }} ({{ ageCategory }})&lt;/<span class="c-key">p</span>&gt;
        &lt;<span class="c-key">button</span> @<span class="c-var">click</span>=<span class="c-str">"increment"</span>&gt;+1 год&lt;/<span class="c-key">button</span>&gt;
    &lt;/<span class="c-key">div</span>&gt;
&lt;/<span class="c-key">template</span>&gt;

&lt;<span class="c-key">script</span>&gt;
<span class="c-key">export default</span> {
    <span class="c-fn">data</span>() {
        <span class="c-key">return</span> {
            <span class="c-var">title</span>: <span class="c-str">'Профиль пользователя'</span>,
            <span class="c-var">age</span>: <span class="c-num">25</span>,
        };
    },
    <span class="c-var">computed</span>: {
        <span class="c-fn">ageCategory</span>() {
            <span class="c-key">return</span> <span class="c-key">this</span>.<span class="c-var">age</span> &gt;= <span class="c-num">18</span> ? <span class="c-str">'взрослый'</span> : <span class="c-str">'несовершеннолетний'</span>;
        },
    },
    <span class="c-var">methods</span>: {
        <span class="c-fn">increment</span>() {
            <span class="c-key">this</span>.<span class="c-var">age</span>++;
        },
    },
    <span class="c-fn">mounted</span>() {
        <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'Компонент смонтирован'</span>);
    },
};
&lt;/<span class="c-key">script</span>&gt;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Основные секции</h3>
    <table class="data-table">
      <thead><tr><th>Опция</th><th>Что содержит</th></tr></thead>
      <tbody>
        <tr><td><code>data()</code></td><td>Функция возвращает объект — реактивные данные компонента</td></tr>
        <tr><td><code>props</code></td><td>Входные параметры от родителя</td></tr>
        <tr><td><code>computed</code></td><td>Вычисляемые свойства (кешируются, пересчитываются при изменении зависимостей)</td></tr>
        <tr><td><code>methods</code></td><td>Обычные функции — вызываются вручную (клик, submit)</td></tr>
        <tr><td><code>watch</code></td><td>Наблюдатели за изменением конкретных данных</td></tr>
        <tr><td><code>mounted</code>, <code>updated</code>...</td><td>Lifecycle хуки</td></tr>
        <tr><td><code>components</code></td><td>Локально зарегистрированные дочерние компоненты</td></tr>
      </tbody>
    </table>
    <div class="pitfall">
      <strong>⚠ <code>this</code> критично:</strong> в Options API везде обращение через <code>this.age</code>, <code>this.title</code>. Именно поэтому <strong>methods нельзя писать через arrow functions</strong> — arrow не имеет своего <code>this</code>, потеряется контекст компонента.
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-composition-api" class="section">
  <div class="section-title">Composition API + <code>&lt;script setup&gt;</code></div>

  <div class="subsection">
    <p class="text">Composition API — современный способ (Vue 3). Вместо разделения по «типам кода» (data/methods/computed) — код группируется <strong>по фиче</strong>. Плюс лучшая типизация TypeScript и переиспользование логики через composables.</p>
    <p class="text"><code>&lt;script setup&gt;</code> — синтаксический сахар: автоматически возвращает всё что объявлено в блоке setup. Стандарт для Vue 3.</p>

    <pre><code>&lt;<span class="c-key">template</span>&gt;
    &lt;<span class="c-key">div</span>&gt;
        &lt;<span class="c-key">h1</span>&gt;{{ title }}&lt;/<span class="c-key">h1</span>&gt;
        &lt;<span class="c-key">p</span>&gt;Возраст: {{ age }} ({{ ageCategory }})&lt;/<span class="c-key">p</span>&gt;
        &lt;<span class="c-key">button</span> @<span class="c-var">click</span>=<span class="c-str">"increment"</span>&gt;+1 год&lt;/<span class="c-key">button</span>&gt;
    &lt;/<span class="c-key">div</span>&gt;
&lt;/<span class="c-key">template</span>&gt;

&lt;<span class="c-key">script</span> <span class="c-var">setup</span>&gt;
<span class="c-key">import</span> { <span class="c-var">ref</span>, <span class="c-var">computed</span>, <span class="c-var">onMounted</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;

<span class="c-key">const</span> <span class="c-var">title</span> = <span class="c-fn">ref</span>(<span class="c-str">'Профиль пользователя'</span>);
<span class="c-key">const</span> <span class="c-var">age</span> = <span class="c-fn">ref</span>(<span class="c-num">25</span>);

<span class="c-key">const</span> <span class="c-var">ageCategory</span> = <span class="c-fn">computed</span>(() =&gt;
    <span class="c-var">age</span>.<span class="c-var">value</span> &gt;= <span class="c-num">18</span> ? <span class="c-str">'взрослый'</span> : <span class="c-str">'несовершеннолетний'</span>
);

<span class="c-key">function</span> <span class="c-fn">increment</span>() {
    <span class="c-var">age</span>.<span class="c-var">value</span>++;
}

<span class="c-fn">onMounted</span>(() =&gt; {
    <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-str">'Компонент смонтирован'</span>);
});
&lt;/<span class="c-key">script</span>&gt;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Ключевые импорты Composition API</h3>
    <table class="data-table">
      <thead><tr><th>Функция</th><th>Что делает</th></tr></thead>
      <tbody>
        <tr><td><code>ref(value)</code></td><td>Реактивная переменная (примитив или объект). Доступ через <code>.value</code></td></tr>
        <tr><td><code>reactive(obj)</code></td><td>Реактивный объект (без <code>.value</code>, доступ напрямую)</td></tr>
        <tr><td><code>computed(() =&gt; ...)</code></td><td>Вычисляемое свойство</td></tr>
        <tr><td><code>watch(source, cb)</code></td><td>Наблюдатель за изменением</td></tr>
        <tr><td><code>watchEffect(cb)</code></td><td>Автоматически отслеживает все реактивные значения в callback</td></tr>
        <tr><td><code>onMounted(cb)</code></td><td>Lifecycle: после монтирования</td></tr>
        <tr><td><code>onUnmounted(cb)</code></td><td>Перед размонтированием</td></tr>
        <tr><td><code>defineProps</code>, <code>defineEmits</code></td><td>Макросы для props/emit в <code>&lt;script setup&gt;</code></td></tr>
        <tr><td><code>inject</code>, <code>provide</code></td><td>Dependency injection между компонентами</td></tr>
      </tbody>
    </table>
    <div class="remember-box">
      <strong>Ключевое отличие:</strong> в Composition API нет <code>this</code>. Всё через импорты и <code>.value</code>. Arrow functions работают везде без проблем.
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-reactivity" class="section">
  <div class="section-title">Реактивность: ref vs reactive</div>

  <div class="subsection">
    <p class="text">Два основных способа сделать данные реактивными: <code>ref()</code> и <code>reactive()</code>.</p>
  </div>

  <div class="subsection">
    <h3 class="subsection-title"><code>ref()</code> — универсальный (примитивы и объекты)</h3>
    <pre><code><span class="c-key">import</span> { <span class="c-var">ref</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;

<span class="c-key">const</span> <span class="c-var">count</span> = <span class="c-fn">ref</span>(<span class="c-num">0</span>);
<span class="c-key">const</span> <span class="c-var">name</span> = <span class="c-fn">ref</span>(<span class="c-str">'Alice'</span>);
<span class="c-key">const</span> <span class="c-var">user</span> = <span class="c-fn">ref</span>({ <span class="c-var">id</span>: <span class="c-num">1</span>, <span class="c-var">name</span>: <span class="c-str">'Alice'</span> });

<span class="c-comment">// В JS — доступ через .value</span>
<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">count</span>.<span class="c-var">value</span>);   <span class="c-comment">// 0</span>
<span class="c-var">count</span>.<span class="c-var">value</span>++;
<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">count</span>.<span class="c-var">value</span>);   <span class="c-comment">// 1</span>

<span class="c-var">user</span>.<span class="c-var">value</span>.<span class="c-var">name</span> = <span class="c-str">'Bob'</span>;    <span class="c-comment">// мутация внутри объекта — работает</span>
<span class="c-var">user</span>.<span class="c-var">value</span> = { <span class="c-var">id</span>: <span class="c-num">2</span> };    <span class="c-comment">// замена всего объекта — тоже работает</span>

<span class="c-comment">// В template — БЕЗ .value, Vue сам разворачивает</span>
<span class="c-comment">// &lt;p&gt;{{ count }}&lt;/p&gt;   ← видит 1, не .value</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title"><code>reactive()</code> — только для объектов</h3>
    <pre><code><span class="c-key">import</span> { <span class="c-var">reactive</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;

<span class="c-key">const</span> <span class="c-var">state</span> = <span class="c-fn">reactive</span>({
    <span class="c-var">count</span>: <span class="c-num">0</span>,
    <span class="c-var">user</span>: { <span class="c-var">name</span>: <span class="c-str">'Alice'</span> },
});

<span class="c-comment">// Доступ БЕЗ .value</span>
<span class="c-var">state</span>.<span class="c-var">count</span>++;
<span class="c-var">state</span>.<span class="c-var">user</span>.<span class="c-var">name</span> = <span class="c-str">'Bob'</span>;

<span class="c-comment">// ⚠ НЕЛЬЗЯ заменить весь объект — потеряется реактивность</span>
<span class="c-comment">// state = {} — теряется связь с Vue</span>

<span class="c-comment">// ⚠ НЕЛЬЗЯ деструктурировать — теряется реактивность</span>
<span class="c-key">const</span> { <span class="c-var">count</span> } = <span class="c-var">state</span>;  <span class="c-comment">// count — обычная переменная, не реактивная!</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">ref vs reactive — что выбрать</h3>
    <table class="data-table">
      <thead><tr><th></th><th>ref</th><th>reactive</th></tr></thead>
      <tbody>
        <tr><td>Что можно</td><td>Любое: примитивы + объекты</td><td>Только объекты (массив тоже — объект)</td></tr>
        <tr><td>Доступ в JS</td><td>Через <code>.value</code></td><td>Напрямую</td></tr>
        <tr><td>Доступ в template</td><td>Без <code>.value</code> (auto-unwrap)</td><td>Напрямую</td></tr>
        <tr><td>Замена целиком</td><td>Можно: <code>myRef.value = newObj</code></td><td>Нельзя — потеряет реактивность</td></tr>
        <tr><td>Деструктуризация</td><td>Через <code>toRefs</code></td><td>Ломает реактивность</td></tr>
      </tbody>
    </table>
    <div class="remember-box">
      <strong>Практическое правило:</strong> используй <code>ref</code> везде. Он универсальный и работает с любыми типами. <code>reactive</code> — только если чётко нужен объект с несколькими связанными полями (например, форма).
    </div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title"><code>toRefs</code> — как деструктуризировать reactive</h3>
    <pre><code><span class="c-key">import</span> { <span class="c-var">reactive</span>, <span class="c-var">toRefs</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;

<span class="c-key">const</span> <span class="c-var">state</span> = <span class="c-fn">reactive</span>({ <span class="c-var">count</span>: <span class="c-num">0</span>, <span class="c-var">name</span>: <span class="c-str">'Alice'</span> });

<span class="c-comment">// ❌ Ломает реактивность</span>
<span class="c-key">const</span> { <span class="c-var">count</span>, <span class="c-var">name</span> } = <span class="c-var">state</span>;

<span class="c-comment">// ✓ Сохраняет реактивность — каждое поле оборачивается в ref</span>
<span class="c-key">const</span> { <span class="c-var">count</span>, <span class="c-var">name</span> } = <span class="c-fn">toRefs</span>(<span class="c-var">state</span>);
<span class="c-var">count</span>.<span class="c-var">value</span>++;   <span class="c-comment">// работает, обновляет state.count</span></code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-computed-watch" class="section">
  <div class="section-title">computed + watch</div>

  <div class="subsection">
    <h3 class="subsection-title"><code>computed()</code> — вычисляемые значения</h3>
    <p class="text">Вычисляется от других реактивных данных. <strong>Кешируется</strong> — пересчитывается только когда меняются зависимости. Используй когда результат зависит от других данных.</p>
    <pre><code><span class="c-key">import</span> { <span class="c-var">ref</span>, <span class="c-var">computed</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;

<span class="c-key">const</span> <span class="c-var">firstName</span> = <span class="c-fn">ref</span>(<span class="c-str">'Alice'</span>);
<span class="c-key">const</span> <span class="c-var">lastName</span> = <span class="c-fn">ref</span>(<span class="c-str">'Ivanova'</span>);

<span class="c-key">const</span> <span class="c-var">fullName</span> = <span class="c-fn">computed</span>(() =&gt; <span class="c-str">`${firstName.value} ${lastName.value}`</span>);

<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">fullName</span>.<span class="c-var">value</span>);   <span class="c-comment">// 'Alice Ivanova'</span>

<span class="c-var">firstName</span>.<span class="c-var">value</span> = <span class="c-str">'Bob'</span>;
<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">fullName</span>.<span class="c-var">value</span>);   <span class="c-comment">// 'Bob Ivanova' — пересчиталось</span></code></pre>

    <h3 class="subsection-title" style="margin-top:14px">Computed vs Method</h3>
    <table class="data-table">
      <thead><tr><th></th><th>computed</th><th>method</th></tr></thead>
      <tbody>
        <tr><td>Кеширование</td><td>Да — пересчёт только когда зависимости меняются</td><td>Нет — вызывается каждый раз при рендере</td></tr>
        <tr><td>Синтаксис</td><td><code>computed(() =&gt; ...)</code></td><td>Обычная функция</td></tr>
        <tr><td>Когда использовать</td><td>Значения от реактивных данных</td><td>Обработчики событий, разовые вызовы</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <h3 class="subsection-title"><code>watch()</code> — наблюдатель за изменением</h3>
    <p class="text">Реагирует на изменение конкретного реактивного значения. Используй для <strong>side effects</strong>: сохранить в localStorage, отправить API-запрос, показать уведомление.</p>
    <pre><code><span class="c-key">import</span> { <span class="c-var">ref</span>, <span class="c-var">watch</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;

<span class="c-key">const</span> <span class="c-var">searchQuery</span> = <span class="c-fn">ref</span>(<span class="c-str">''</span>);
<span class="c-key">const</span> <span class="c-var">results</span> = <span class="c-fn">ref</span>([]);

<span class="c-fn">watch</span>(<span class="c-var">searchQuery</span>, <span class="c-key">async</span> (<span class="c-var">newQuery</span>, <span class="c-var">oldQuery</span>) =&gt; {
    <span class="c-key">if</span> (<span class="c-var">newQuery</span>.<span class="c-var">length</span> &lt; <span class="c-num">3</span>) <span class="c-key">return</span>;

    <span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">`/api/search?q=${newQuery}`</span>);
    <span class="c-var">results</span>.<span class="c-var">value</span> = <span class="c-key">await</span> <span class="c-var">res</span>.<span class="c-fn">json</span>();
});</code></pre>

    <h3 class="subsection-title" style="margin-top:14px">Опции watch</h3>
    <pre><code><span class="c-fn">watch</span>(<span class="c-var">source</span>, <span class="c-var">callback</span>, {
    <span class="c-var">immediate</span>: <span class="c-key">true</span>,     <span class="c-comment">// вызвать сразу при создании (не только при изменении)</span>
    <span class="c-var">deep</span>: <span class="c-key">true</span>,          <span class="c-comment">// глубокое наблюдение за вложенными полями объекта</span>
    <span class="c-var">flush</span>: <span class="c-str">'post'</span>,      <span class="c-comment">// вызвать после обновления DOM ('pre' — до, 'sync' — синхронно)</span>
});

<span class="c-comment">// Несколько источников</span>
<span class="c-fn">watch</span>([<span class="c-var">firstName</span>, <span class="c-var">lastName</span>], ([<span class="c-var">newF</span>, <span class="c-var">newL</span>], [<span class="c-var">oldF</span>, <span class="c-var">oldL</span>]) =&gt; {
    <span class="c-comment">// ...</span>
});</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title"><code>watchEffect()</code> — автоматическое отслеживание</h3>
    <pre><code><span class="c-key">import</span> { <span class="c-var">ref</span>, <span class="c-var">watchEffect</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;

<span class="c-key">const</span> <span class="c-var">userId</span> = <span class="c-fn">ref</span>(<span class="c-num">1</span>);

<span class="c-fn">watchEffect</span>(<span class="c-key">async</span> () =&gt; {
    <span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">`/api/users/${userId.value}`</span>);
    <span class="c-comment">// Vue сам заметил что использовал userId.value → следит за ним</span>
});

<span class="c-comment">// Меняем userId → callback вызывается автоматически</span>
<span class="c-var">userId</span>.<span class="c-var">value</span> = <span class="c-num">2</span>;</code></pre>
    <div class="tip">
      <strong>watch vs watchEffect:</strong> в <code>watch</code> ты явно указываешь за чем следить. В <code>watchEffect</code> — Vue автоматически определяет по использованию внутри callback.
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-template" class="section">
  <div class="section-title">Template syntax</div>

  <div class="subsection">
    <h3 class="subsection-title">Интерполяция <code>{{ }}</code></h3>
    <pre><code>&lt;<span class="c-key">p</span>&gt;Привет, {{ user.name }}!&lt;/<span class="c-key">p</span>&gt;
&lt;<span class="c-key">p</span>&gt;Возраст: {{ user.age + <span class="c-num">1</span> }}&lt;/<span class="c-key">p</span>&gt;                <span class="c-comment">// выражения работают</span>
&lt;<span class="c-key">p</span>&gt;{{ user.age &gt;= <span class="c-num">18</span> ? <span class="c-str">'adult'</span> : <span class="c-str">'minor'</span> }}&lt;/<span class="c-key">p</span>&gt;   <span class="c-comment">// тернарный</span>
&lt;<span class="c-key">p</span>&gt;{{ names.<span class="c-fn">join</span>(<span class="c-str">', '</span>) }}&lt;/<span class="c-key">p</span>&gt;                       <span class="c-comment">// методы</span>

<span class="c-comment">&lt;!-- ❌ НЕЛЬЗЯ statements (if, for, var) --&gt;</span>
&lt;<span class="c-key">p</span>&gt;{{ <span class="c-key">if</span> (<span class="c-var">x</span>) <span class="c-key">return</span> <span class="c-str">'yes'</span> }}&lt;/<span class="c-key">p</span>&gt;   <span class="c-comment">// ошибка</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">v-bind — динамические атрибуты</h3>
    <pre><code><span class="c-comment">&lt;!-- Полная форма --&gt;</span>
&lt;<span class="c-key">img</span> <span class="c-var">v-bind:src</span>=<span class="c-str">"user.avatar"</span> <span class="c-var">v-bind:alt</span>=<span class="c-str">"user.name"</span>&gt;

<span class="c-comment">&lt;!-- Сокращённо через двоеточие --&gt;</span>
&lt;<span class="c-key">img</span> <span class="c-var">:src</span>=<span class="c-str">"user.avatar"</span> <span class="c-var">:alt</span>=<span class="c-str">"user.name"</span>&gt;

<span class="c-comment">&lt;!-- Динамический класс --&gt;</span>
&lt;<span class="c-key">div</span> <span class="c-var">:class</span>=<span class="c-str">"{ active: isActive, disabled: !isEnabled }"</span>&gt;
&lt;<span class="c-key">div</span> <span class="c-var">:class</span>=<span class="c-str">"[baseClass, extraClass]"</span>&gt;

<span class="c-comment">&lt;!-- Динамический стиль --&gt;</span>
&lt;<span class="c-key">div</span> <span class="c-var">:style</span>=<span class="c-str">"{ color: textColor, fontSize: size + 'px' }"</span>&gt;

<span class="c-comment">&lt;!-- Весь объект атрибутов сразу --&gt;</span>
&lt;<span class="c-key">input</span> <span class="c-var">v-bind</span>=<span class="c-str">"{ type: 'email', name: 'email', required: true }"</span>&gt;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">v-on — обработчики событий</h3>
    <pre><code><span class="c-comment">&lt;!-- Полная форма --&gt;</span>
&lt;<span class="c-key">button</span> <span class="c-var">v-on:click</span>=<span class="c-str">"handleClick"</span>&gt;

<span class="c-comment">&lt;!-- Сокращённо через @ --&gt;</span>
&lt;<span class="c-key">button</span> @<span class="c-var">click</span>=<span class="c-str">"handleClick"</span>&gt;

<span class="c-comment">&lt;!-- Инлайн выражение --&gt;</span>
&lt;<span class="c-key">button</span> @<span class="c-var">click</span>=<span class="c-str">"count++"</span>&gt;+1&lt;/<span class="c-key">button</span>&gt;

<span class="c-comment">&lt;!-- С аргументами --&gt;</span>
&lt;<span class="c-key">button</span> @<span class="c-var">click</span>=<span class="c-str">"deleteUser(user.id)"</span>&gt;

<span class="c-comment">&lt;!-- С event объектом --&gt;</span>
&lt;<span class="c-key">button</span> @<span class="c-var">click</span>=<span class="c-str">"handleClick($event)"</span>&gt;

<span class="c-comment">&lt;!-- Модификаторы событий --&gt;</span>
&lt;<span class="c-key">form</span> @<span class="c-var">submit.prevent</span>=<span class="c-str">"handleSubmit"</span>&gt;    <span class="c-comment">// event.preventDefault()</span>
&lt;<span class="c-key">div</span> @<span class="c-var">click.stop</span>=<span class="c-str">"handleClick"</span>&gt;         <span class="c-comment">// event.stopPropagation()</span>
&lt;<span class="c-key">a</span> @<span class="c-var">click.prevent.stop</span>=<span class="c-str">"..."</span>&gt;            <span class="c-comment">// цепочка модификаторов</span>
&lt;<span class="c-key">input</span> @<span class="c-var">keyup.enter</span>=<span class="c-str">"submit"</span>&gt;             <span class="c-comment">// только Enter</span>
&lt;<span class="c-key">input</span> @<span class="c-var">keyup.esc</span>=<span class="c-str">"close"</span>&gt;                <span class="c-comment">// только Esc</span></code></pre>

    <h3 class="subsection-title" style="margin-top:14px">Модификаторы событий</h3>
    <table class="data-table">
      <thead><tr><th>Модификатор</th><th>Что делает</th></tr></thead>
      <tbody>
        <tr><td><code>.prevent</code></td><td><code>event.preventDefault()</code></td></tr>
        <tr><td><code>.stop</code></td><td><code>event.stopPropagation()</code></td></tr>
        <tr><td><code>.self</code></td><td>Сработает только если target === элемент</td></tr>
        <tr><td><code>.once</code></td><td>Сработает 1 раз, потом отвяжется</td></tr>
        <tr><td><code>.capture</code></td><td>capture-фаза вместо bubbling</td></tr>
        <tr><td><code>.passive</code></td><td>Для scroll — оптимизация</td></tr>
        <tr><td><code>.enter</code>, <code>.esc</code>, <code>.tab</code>...</td><td>Клавиши для keyup/keydown</td></tr>
        <tr><td><code>.ctrl</code>, <code>.alt</code>, <code>.shift</code>, <code>.meta</code></td><td>Модификаторы клавиш</td></tr>
      </tbody>
    </table>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-directives" class="section">
  <div class="section-title">Директивы: v-if / v-for / v-model</div>

  <div class="subsection">
    <h3 class="subsection-title">v-if / v-else-if / v-else</h3>
    <pre><code>&lt;<span class="c-key">div</span> <span class="c-var">v-if</span>=<span class="c-str">"user.role === 'admin'"</span>&gt;Админ&lt;/<span class="c-key">div</span>&gt;
&lt;<span class="c-key">div</span> <span class="c-var">v-else-if</span>=<span class="c-str">"user.role === 'editor'"</span>&gt;Редактор&lt;/<span class="c-key">div</span>&gt;
&lt;<span class="c-key">div</span> <span class="c-var">v-else</span>&gt;Обычный юзер&lt;/<span class="c-key">div</span>&gt;

<span class="c-comment">&lt;!-- Группировать без лишнего wrapper — через &lt;template&gt; --&gt;</span>
&lt;<span class="c-key">template</span> <span class="c-var">v-if</span>=<span class="c-str">"isLoggedIn"</span>&gt;
    &lt;<span class="c-key">h1</span>&gt;Привет&lt;/<span class="c-key">h1</span>&gt;
    &lt;<span class="c-key">p</span>&gt;Ты вошёл&lt;/<span class="c-key">p</span>&gt;
&lt;/<span class="c-key">template</span>&gt;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">v-show — скрытие через CSS</h3>
    <pre><code>&lt;<span class="c-key">div</span> <span class="c-var">v-show</span>=<span class="c-str">"isVisible"</span>&gt;Скрою через display:none&lt;/<span class="c-key">div</span>&gt;</code></pre>
    <table class="data-table">
      <thead><tr><th></th><th>v-if</th><th>v-show</th></tr></thead>
      <tbody>
        <tr><td>Что делает</td><td>Удаляет / вставляет элемент в DOM</td><td>Меняет <code>display: none/block</code></td></tr>
        <tr><td>Стоимость переключения</td><td>Высокая (перерисовка)</td><td>Низкая (только CSS)</td></tr>
        <tr><td>Стоимость первого рендера</td><td>Низкая (не рендерит если false)</td><td>Высокая (всегда рендерит)</td></tr>
        <tr><td>Использовать когда</td><td>Условие редко меняется</td><td>Часто toggle-ится (табы, аккордеон)</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">v-for — циклы</h3>
    <pre><code><span class="c-comment">&lt;!-- По массиву --&gt;</span>
&lt;<span class="c-key">li</span> <span class="c-var">v-for</span>=<span class="c-str">"item in items"</span> <span class="c-var">:key</span>=<span class="c-str">"item.id"</span>&gt;
    {{ item.name }}
&lt;/<span class="c-key">li</span>&gt;

<span class="c-comment">&lt;!-- С индексом --&gt;</span>
&lt;<span class="c-key">li</span> <span class="c-var">v-for</span>=<span class="c-str">"(item, index) in items"</span> <span class="c-var">:key</span>=<span class="c-str">"item.id"</span>&gt;
    {{ index + <span class="c-num">1</span> }}. {{ item.name }}
&lt;/<span class="c-key">li</span>&gt;

<span class="c-comment">&lt;!-- По объекту --&gt;</span>
&lt;<span class="c-key">li</span> <span class="c-var">v-for</span>=<span class="c-str">"(value, key, index) in user"</span> <span class="c-var">:key</span>=<span class="c-str">"key"</span>&gt;
    {{ key }}: {{ value }}
&lt;/<span class="c-key">li</span>&gt;

<span class="c-comment">&lt;!-- По числу --&gt;</span>
&lt;<span class="c-key">span</span> <span class="c-var">v-for</span>=<span class="c-str">"n in 10"</span> <span class="c-var">:key</span>=<span class="c-str">"n"</span>&gt;{{ n }} &lt;/<span class="c-key">span</span>&gt;</code></pre>
    <div class="pitfall">
      <strong>⚠ ВСЕГДА <code>:key</code>:</strong> Vue использует key для эффективного обновления. Без key будут баги при вставке / удалении элементов. <strong>Не используй index как key</strong> если список меняет порядок — используй уникальный id из данных.
    </div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">v-model — двусторонняя привязка</h3>
    <p class="text">Синтаксический сахар: <code>:value + @input</code> одной директивой. Работает с формами.</p>
    <pre><code>&lt;<span class="c-key">input</span> <span class="c-var">v-model</span>=<span class="c-str">"searchQuery"</span> <span class="c-var">type</span>=<span class="c-str">"text"</span>&gt;
&lt;<span class="c-key">p</span>&gt;Введено: {{ searchQuery }}&lt;/<span class="c-key">p</span>&gt;

<span class="c-comment">&lt;!-- Это эквивалент: --&gt;</span>
&lt;<span class="c-key">input</span> <span class="c-var">:value</span>=<span class="c-str">"searchQuery"</span> @<span class="c-var">input</span>=<span class="c-str">"searchQuery = $event.target.value"</span>&gt;

<span class="c-comment">&lt;!-- Разные типы полей --&gt;</span>
&lt;<span class="c-key">textarea</span> <span class="c-var">v-model</span>=<span class="c-str">"description"</span>&gt;&lt;/<span class="c-key">textarea</span>&gt;
&lt;<span class="c-key">input</span> <span class="c-var">v-model</span>=<span class="c-str">"isChecked"</span> <span class="c-var">type</span>=<span class="c-str">"checkbox"</span>&gt;   <span class="c-comment">// bool</span>
&lt;<span class="c-key">input</span> <span class="c-var">v-model</span>=<span class="c-str">"selectedRole"</span> <span class="c-var">type</span>=<span class="c-str">"radio"</span> <span class="c-var">value</span>=<span class="c-str">"admin"</span>&gt;
&lt;<span class="c-key">select</span> <span class="c-var">v-model</span>=<span class="c-str">"selectedCity"</span>&gt;
    &lt;<span class="c-key">option</span> <span class="c-var">value</span>=<span class="c-str">"almaty"</span>&gt;Алматы&lt;/<span class="c-key">option</span>&gt;
    &lt;<span class="c-key">option</span> <span class="c-var">value</span>=<span class="c-str">"astana"</span>&gt;Астана&lt;/<span class="c-key">option</span>&gt;
&lt;/<span class="c-key">select</span>&gt;

<span class="c-comment">&lt;!-- Массив checkbox --&gt;</span>
&lt;<span class="c-key">input</span> <span class="c-var">v-model</span>=<span class="c-str">"tags"</span> <span class="c-var">type</span>=<span class="c-str">"checkbox"</span> <span class="c-var">value</span>=<span class="c-str">"php"</span>&gt;
&lt;<span class="c-key">input</span> <span class="c-var">v-model</span>=<span class="c-str">"tags"</span> <span class="c-var">type</span>=<span class="c-str">"checkbox"</span> <span class="c-var">value</span>=<span class="c-str">"vue"</span>&gt;

<span class="c-comment">&lt;!-- Модификаторы v-model --&gt;</span>
&lt;<span class="c-key">input</span> <span class="c-var">v-model.trim</span>=<span class="c-str">"name"</span>&gt;         <span class="c-comment">// автоматом trim</span>
&lt;<span class="c-key">input</span> <span class="c-var">v-model.number</span>=<span class="c-str">"age"</span>&gt;         <span class="c-comment">// каст в Number</span>
&lt;<span class="c-key">input</span> <span class="c-var">v-model.lazy</span>=<span class="c-str">"query"</span>&gt;         <span class="c-comment">// синхронизация на change (не input)</span></code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">v-html — вставить сырой HTML</h3>
    <pre><code>&lt;<span class="c-key">div</span> <span class="c-var">v-html</span>=<span class="c-str">"htmlContent"</span>&gt;&lt;/<span class="c-key">div</span>&gt;</code></pre>
    <div class="pitfall">
      <strong>⚠ XSS-риск:</strong> <code>v-html</code> не экранирует. Никогда не подставляй туда user-input без санитизации.
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-methods" class="section">
  <div class="section-title">Methods + обработчики</div>

  <div class="subsection">
    <p class="text">В Composition API методы — обычные функции. В Options API — секция <code>methods: {}</code>.</p>

    <pre><code>&lt;<span class="c-key">template</span>&gt;
    &lt;<span class="c-key">form</span> @<span class="c-var">submit.prevent</span>=<span class="c-str">"handleSubmit"</span>&gt;
        &lt;<span class="c-key">input</span> <span class="c-var">v-model</span>=<span class="c-str">"email"</span>&gt;
        &lt;<span class="c-key">button</span> <span class="c-var">type</span>=<span class="c-str">"submit"</span> <span class="c-var">:disabled</span>=<span class="c-str">"loading"</span>&gt;
            {{ loading ? <span class="c-str">'Отправка...'</span> : <span class="c-str">'Войти'</span> }}
        &lt;/<span class="c-key">button</span>&gt;
        &lt;<span class="c-key">p</span> <span class="c-var">v-if</span>=<span class="c-str">"error"</span> <span class="c-var">class</span>=<span class="c-str">"error"</span>&gt;{{ error }}&lt;/<span class="c-key">p</span>&gt;
    &lt;/<span class="c-key">form</span>&gt;
&lt;/<span class="c-key">template</span>&gt;

&lt;<span class="c-key">script</span> <span class="c-var">setup</span>&gt;
<span class="c-key">import</span> { <span class="c-var">ref</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;

<span class="c-key">const</span> <span class="c-var">email</span> = <span class="c-fn">ref</span>(<span class="c-str">''</span>);
<span class="c-key">const</span> <span class="c-var">loading</span> = <span class="c-fn">ref</span>(<span class="c-key">false</span>);
<span class="c-key">const</span> <span class="c-var">error</span> = <span class="c-fn">ref</span>(<span class="c-str">''</span>);

<span class="c-key">async function</span> <span class="c-fn">handleSubmit</span>() {
    <span class="c-var">loading</span>.<span class="c-var">value</span> = <span class="c-key">true</span>;
    <span class="c-var">error</span>.<span class="c-var">value</span> = <span class="c-str">''</span>;

    <span class="c-key">try</span> {
        <span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">'/api/login'</span>, {
            <span class="c-var">method</span>: <span class="c-str">'POST'</span>,
            <span class="c-var">body</span>: <span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>({ <span class="c-var">email</span>: <span class="c-var">email</span>.<span class="c-var">value</span> }),
        });
        <span class="c-key">if</span> (!<span class="c-var">res</span>.<span class="c-var">ok</span>) <span class="c-key">throw</span> <span class="c-key">new</span> <span class="c-fn">Error</span>(<span class="c-str">'Ошибка'</span>);
    } <span class="c-key">catch</span> (<span class="c-var">e</span>) {
        <span class="c-var">error</span>.<span class="c-var">value</span> = <span class="c-var">e</span>.<span class="c-var">message</span>;
    } <span class="c-key">finally</span> {
        <span class="c-var">loading</span>.<span class="c-var">value</span> = <span class="c-key">false</span>;
    }
}
&lt;/<span class="c-key">script</span>&gt;</code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-lifecycle" class="section">
  <div class="section-title">Lifecycle hooks</div>

  <div class="subsection">
    <p class="text">Хуки, которые Vue вызывает в определённые моменты жизни компонента: создание, монтирование в DOM, обновление, удаление.</p>

    <table class="data-table">
      <thead><tr><th>Composition API</th><th>Options API</th><th>Когда вызывается</th></tr></thead>
      <tbody>
        <tr><td><code>onBeforeMount</code></td><td><code>beforeMount</code></td><td>Перед добавлением в DOM</td></tr>
        <tr><td><code>onMounted</code></td><td><code>mounted</code></td><td> После добавления в DOM (можно работать с DOM, делать API-запросы)</td></tr>
        <tr><td><code>onBeforeUpdate</code></td><td><code>beforeUpdate</code></td><td>Перед перерисовкой из-за изменения данных</td></tr>
        <tr><td><code>onUpdated</code></td><td><code>updated</code></td><td>После перерисовки</td></tr>
        <tr><td><code>onBeforeUnmount</code></td><td><code>beforeUnmount</code></td><td>Перед удалением из DOM (очистка timer, listener, subscription)</td></tr>
        <tr><td><code>onUnmounted</code></td><td><code>unmounted</code></td><td>После удаления</td></tr>
        <tr><td><code>onActivated</code></td><td><code>activated</code></td><td>Для kept-alive компонентов при активации</td></tr>
        <tr><td><code>onDeactivated</code></td><td><code>deactivated</code></td><td>Для kept-alive при деактивации</td></tr>
        <tr><td><code>onErrorCaptured</code></td><td><code>errorCaptured</code></td><td>Ошибка в дочернем компоненте</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Типичный сценарий — загрузка данных + очистка</h3>
    <pre><code>&lt;<span class="c-key">script</span> <span class="c-var">setup</span>&gt;
<span class="c-key">import</span> { <span class="c-var">ref</span>, <span class="c-var">onMounted</span>, <span class="c-var">onUnmounted</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;

<span class="c-key">const</span> <span class="c-var">users</span> = <span class="c-fn">ref</span>([]);
<span class="c-key">let</span> <span class="c-var">intervalId</span>;

<span class="c-fn">onMounted</span>(<span class="c-key">async</span> () =&gt; {
    <span class="c-comment">// Загружаем данные при появлении компонента</span>
    <span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">'/api/users'</span>);
    <span class="c-var">users</span>.<span class="c-var">value</span> = <span class="c-key">await</span> <span class="c-var">res</span>.<span class="c-fn">json</span>();

    <span class="c-comment">// Ставим таймер</span>
    <span class="c-var">intervalId</span> = <span class="c-fn">setInterval</span>(() =&gt; <span class="c-fn">refresh</span>(), <span class="c-num">10000</span>);

    <span class="c-comment">// Глобальный listener</span>
    <span class="c-fn">window</span>.<span class="c-fn">addEventListener</span>(<span class="c-str">'resize'</span>, <span class="c-fn">handleResize</span>);
});

<span class="c-fn">onUnmounted</span>(() =&gt; {
    <span class="c-comment">//  Обязательно очищаем таймеры / listeners чтобы не было утечек памяти</span>
    <span class="c-fn">clearInterval</span>(<span class="c-var">intervalId</span>);
    <span class="c-fn">window</span>.<span class="c-fn">removeEventListener</span>(<span class="c-str">'resize'</span>, <span class="c-fn">handleResize</span>);
});
&lt;/<span class="c-key">script</span>&gt;</code></pre>
    <div class="remember-box">
      <strong>Правило:</strong> всё что подписал в <code>onMounted</code> — отпиши в <code>onUnmounted</code>. Иначе утечка памяти + странные баги когда компонент «мёртв» но listener всё ещё слушает.
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-components" class="section">
  <div class="section-title">Компоненты: props / emit / slots</div>

  <div class="subsection">
    <h3 class="subsection-title">Props — данные от родителя к ребёнку</h3>
    <pre><code><span class="c-comment">// UserCard.vue — ребёнок</span>
&lt;<span class="c-key">template</span>&gt;
    &lt;<span class="c-key">div</span> <span class="c-var">class</span>=<span class="c-str">"card"</span>&gt;
        &lt;<span class="c-key">h3</span>&gt;{{ user.name }}&lt;/<span class="c-key">h3</span>&gt;
        &lt;<span class="c-key">p</span>&gt;{{ user.email }}&lt;/<span class="c-key">p</span>&gt;
    &lt;/<span class="c-key">div</span>&gt;
&lt;/<span class="c-key">template</span>&gt;

&lt;<span class="c-key">script</span> <span class="c-var">setup</span>&gt;
<span class="c-key">const</span> <span class="c-var">props</span> = <span class="c-fn">defineProps</span>({
    <span class="c-var">user</span>: {
        <span class="c-var">type</span>: <span class="c-type">Object</span>,
        <span class="c-var">required</span>: <span class="c-key">true</span>,
    },
    <span class="c-var">showEmail</span>: {
        <span class="c-var">type</span>: <span class="c-type">Boolean</span>,
        <span class="c-var">default</span>: <span class="c-key">true</span>,
    },
    <span class="c-var">size</span>: {
        <span class="c-var">type</span>: <span class="c-type">String</span>,
        <span class="c-var">validator</span>: (<span class="c-var">v</span>) =&gt; [<span class="c-str">'sm'</span>, <span class="c-str">'md'</span>, <span class="c-str">'lg'</span>].<span class="c-fn">includes</span>(<span class="c-var">v</span>),
        <span class="c-var">default</span>: <span class="c-str">'md'</span>,
    },
});
&lt;/<span class="c-key">script</span>&gt;

<span class="c-comment">// UsersList.vue — родитель</span>
&lt;<span class="c-key">template</span>&gt;
    &lt;<span class="c-key">UserCard</span>
        <span class="c-var">v-for</span>=<span class="c-str">"u in users"</span>
        <span class="c-var">:key</span>=<span class="c-str">"u.id"</span>
        <span class="c-var">:user</span>=<span class="c-str">"u"</span>
        <span class="c-var">:show-email</span>=<span class="c-str">"true"</span>
        <span class="c-var">size</span>=<span class="c-str">"lg"</span>
    /&gt;
&lt;/<span class="c-key">template</span>&gt;</code></pre>
    <div class="pitfall">
      <strong>⚠ Props нельзя мутировать в ребёнке:</strong> Vue выдаст warning. Правильно — эмитить событие родителю, чтобы он поменял данные.
    </div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Emit — события от ребёнка к родителю</h3>
    <pre><code><span class="c-comment">// DeleteButton.vue — ребёнок</span>
&lt;<span class="c-key">template</span>&gt;
    &lt;<span class="c-key">button</span> @<span class="c-var">click</span>=<span class="c-str">"handleDelete"</span>&gt;Удалить&lt;/<span class="c-key">button</span>&gt;
&lt;/<span class="c-key">template</span>&gt;

&lt;<span class="c-key">script</span> <span class="c-var">setup</span>&gt;
<span class="c-key">const</span> <span class="c-var">props</span> = <span class="c-fn">defineProps</span>([<span class="c-str">'itemId'</span>]);
<span class="c-key">const</span> <span class="c-var">emit</span> = <span class="c-fn">defineEmits</span>([<span class="c-str">'delete'</span>, <span class="c-str">'error'</span>]);

<span class="c-key">function</span> <span class="c-fn">handleDelete</span>() {
    <span class="c-key">if</span> (<span class="c-fn">confirm</span>(<span class="c-str">'Уверен?'</span>)) {
        <span class="c-fn">emit</span>(<span class="c-str">'delete'</span>, <span class="c-var">props</span>.<span class="c-var">itemId</span>);   <span class="c-comment">// событие + payload</span>
    }
}
&lt;/<span class="c-key">script</span>&gt;

<span class="c-comment">// Родитель</span>
&lt;<span class="c-key">DeleteButton</span> <span class="c-var">:item-id</span>=<span class="c-str">"user.id"</span> @<span class="c-var">delete</span>=<span class="c-str">"removeUser"</span> /&gt;

&lt;<span class="c-key">script</span> <span class="c-var">setup</span>&gt;
<span class="c-key">function</span> <span class="c-fn">removeUser</span>(<span class="c-var">id</span>) {
    <span class="c-var">users</span>.<span class="c-var">value</span> = <span class="c-var">users</span>.<span class="c-var">value</span>.<span class="c-fn">filter</span>(<span class="c-var">u</span> =&gt; <span class="c-var">u</span>.<span class="c-var">id</span> !== <span class="c-var">id</span>);
}
&lt;/<span class="c-key">script</span>&gt;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Slots — вставка контента в компонент</h3>
    <pre><code><span class="c-comment">// Card.vue — компонент с местом для контента</span>
&lt;<span class="c-key">template</span>&gt;
    &lt;<span class="c-key">div</span> <span class="c-var">class</span>=<span class="c-str">"card"</span>&gt;
        &lt;<span class="c-key">header</span>&gt;
            &lt;<span class="c-key">slot</span> <span class="c-var">name</span>=<span class="c-str">"header"</span>&gt;Заголовок по умолчанию&lt;/<span class="c-key">slot</span>&gt;
        &lt;/<span class="c-key">header</span>&gt;
        &lt;<span class="c-key">main</span>&gt;
            &lt;<span class="c-key">slot</span>&gt;Дефолтный слот&lt;/<span class="c-key">slot</span>&gt;
        &lt;/<span class="c-key">main</span>&gt;
        &lt;<span class="c-key">footer</span>&gt;
            &lt;<span class="c-key">slot</span> <span class="c-var">name</span>=<span class="c-str">"footer"</span>&gt;&lt;/<span class="c-key">slot</span>&gt;
        &lt;/<span class="c-key">footer</span>&gt;
    &lt;/<span class="c-key">div</span>&gt;
&lt;/<span class="c-key">template</span>&gt;

<span class="c-comment">// Родитель — заполняет слоты</span>
&lt;<span class="c-key">Card</span>&gt;
    &lt;<span class="c-key">template</span> #<span class="c-var">header</span>&gt;
        &lt;<span class="c-key">h2</span>&gt;Мой профиль&lt;/<span class="c-key">h2</span>&gt;
    &lt;/<span class="c-key">template</span>&gt;

    &lt;<span class="c-key">p</span>&gt;Основной контент&lt;/<span class="c-key">p</span>&gt;      <span class="c-comment">// попадёт в default slot</span>

    &lt;<span class="c-key">template</span> #<span class="c-var">footer</span>&gt;
        &lt;<span class="c-key">button</span>&gt;Сохранить&lt;/<span class="c-key">button</span>&gt;
    &lt;/<span class="c-key">template</span>&gt;
&lt;/<span class="c-key">Card</span>&gt;</code></pre>

    <h3 class="subsection-title" style="margin-top:14px">Scoped slots — передать данные из ребёнка в слот</h3>
    <pre><code><span class="c-comment">// DataList.vue — компонент</span>
&lt;<span class="c-key">template</span>&gt;
    &lt;<span class="c-key">ul</span>&gt;
        &lt;<span class="c-key">li</span> <span class="c-var">v-for</span>=<span class="c-str">"item in items"</span> <span class="c-var">:key</span>=<span class="c-str">"item.id"</span>&gt;
            &lt;<span class="c-key">slot</span> <span class="c-var">:item</span>=<span class="c-str">"item"</span> <span class="c-var">:index</span>=<span class="c-str">"index"</span>&gt;
                {{ item.name }}    <span class="c-comment">// fallback</span>
            &lt;/<span class="c-key">slot</span>&gt;
        &lt;/<span class="c-key">li</span>&gt;
    &lt;/<span class="c-key">ul</span>&gt;
&lt;/<span class="c-key">template</span>&gt;

<span class="c-comment">// Родитель — принимает данные из слота</span>
&lt;<span class="c-key">DataList</span> <span class="c-var">:items</span>=<span class="c-str">"users"</span>&gt;
    &lt;<span class="c-key">template</span> #<span class="c-var">default</span>=<span class="c-str">"{ item, index }"</span>&gt;
        &lt;<span class="c-key">strong</span>&gt;{{ index + <span class="c-num">1</span> }}.&lt;/<span class="c-key">strong</span>&gt; {{ item.name }} — {{ item.email }}
    &lt;/<span class="c-key">template</span>&gt;
&lt;/<span class="c-key">DataList</span>&gt;</code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-composables" class="section">
  <div class="section-title">Composables — переиспользуемая логика</div>

  <div class="subsection">
    <p class="text">Composable — функция которая инкапсулирует реактивную логику и может быть переиспользована в разных компонентах. Аналог React hooks. Имя обычно начинается с <code>use</code>.</p>

    <h3 class="subsection-title">Пример: useCounter</h3>
    <pre><code><span class="c-comment">// composables/useCounter.js</span>
<span class="c-key">import</span> { <span class="c-var">ref</span>, <span class="c-var">computed</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;

<span class="c-key">export function</span> <span class="c-fn">useCounter</span>(<span class="c-var">initial</span> = <span class="c-num">0</span>) {
    <span class="c-key">const</span> <span class="c-var">count</span> = <span class="c-fn">ref</span>(<span class="c-var">initial</span>);
    <span class="c-key">const</span> <span class="c-var">isEven</span> = <span class="c-fn">computed</span>(() =&gt; <span class="c-var">count</span>.<span class="c-var">value</span> % <span class="c-num">2</span> === <span class="c-num">0</span>);

    <span class="c-key">function</span> <span class="c-fn">increment</span>() { <span class="c-var">count</span>.<span class="c-var">value</span>++; }
    <span class="c-key">function</span> <span class="c-fn">decrement</span>() { <span class="c-var">count</span>.<span class="c-var">value</span>--; }
    <span class="c-key">function</span> <span class="c-fn">reset</span>() { <span class="c-var">count</span>.<span class="c-var">value</span> = <span class="c-var">initial</span>; }

    <span class="c-key">return</span> { <span class="c-var">count</span>, <span class="c-var">isEven</span>, <span class="c-var">increment</span>, <span class="c-var">decrement</span>, <span class="c-var">reset</span> };
}</code></pre>
    <pre><code><span class="c-comment">// Компонент</span>
&lt;<span class="c-key">script</span> <span class="c-var">setup</span>&gt;
<span class="c-key">import</span> { <span class="c-fn">useCounter</span> } <span class="c-key">from</span> <span class="c-str">'@/composables/useCounter'</span>;

<span class="c-key">const</span> { <span class="c-var">count</span>, <span class="c-var">isEven</span>, <span class="c-var">increment</span> } = <span class="c-fn">useCounter</span>(<span class="c-num">10</span>);
&lt;/<span class="c-key">script</span>&gt;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Полезный composable: useFetch</h3>
    <pre><code><span class="c-comment">// composables/useFetch.js</span>
<span class="c-key">import</span> { <span class="c-var">ref</span>, <span class="c-var">watchEffect</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;

<span class="c-key">export function</span> <span class="c-fn">useFetch</span>(<span class="c-var">url</span>) {
    <span class="c-key">const</span> <span class="c-var">data</span> = <span class="c-fn">ref</span>(<span class="c-key">null</span>);
    <span class="c-key">const</span> <span class="c-var">error</span> = <span class="c-fn">ref</span>(<span class="c-key">null</span>);
    <span class="c-key">const</span> <span class="c-var">loading</span> = <span class="c-fn">ref</span>(<span class="c-key">true</span>);

    <span class="c-fn">watchEffect</span>(<span class="c-key">async</span> () =&gt; {
        <span class="c-var">loading</span>.<span class="c-var">value</span> = <span class="c-key">true</span>;
        <span class="c-var">error</span>.<span class="c-var">value</span> = <span class="c-key">null</span>;
        <span class="c-key">try</span> {
            <span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-fn">unref</span>(<span class="c-var">url</span>));
            <span class="c-var">data</span>.<span class="c-var">value</span> = <span class="c-key">await</span> <span class="c-var">res</span>.<span class="c-fn">json</span>();
        } <span class="c-key">catch</span> (<span class="c-var">e</span>) {
            <span class="c-var">error</span>.<span class="c-var">value</span> = <span class="c-var">e</span>;
        } <span class="c-key">finally</span> {
            <span class="c-var">loading</span>.<span class="c-var">value</span> = <span class="c-key">false</span>;
        }
    });

    <span class="c-key">return</span> { <span class="c-var">data</span>, <span class="c-var">error</span>, <span class="c-var">loading</span> };
}

<span class="c-comment">// Использование в любом компоненте</span>
<span class="c-key">const</span> { <span class="c-var">data</span>: <span class="c-var">users</span>, <span class="c-var">loading</span>, <span class="c-var">error</span> } = <span class="c-fn">useFetch</span>(<span class="c-str">'/api/users'</span>);</code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-router" class="section">
  <div class="section-title">Vue Router — навигация в SPA</div>

  <div class="subsection">
    <h3 class="subsection-title">Установка + конфигурация</h3>
    <pre><code>npm install vue-router@<span class="c-num">4</span></code></pre>
    <pre><code><span class="c-comment">// router/index.js</span>
<span class="c-key">import</span> { <span class="c-var">createRouter</span>, <span class="c-var">createWebHistory</span> } <span class="c-key">from</span> <span class="c-str">'vue-router'</span>;
<span class="c-key">import</span> <span class="c-type">Home</span> <span class="c-key">from</span> <span class="c-str">'@/views/Home.vue'</span>;
<span class="c-key">import</span> <span class="c-type">UserProfile</span> <span class="c-key">from</span> <span class="c-str">'@/views/UserProfile.vue'</span>;

<span class="c-key">const</span> <span class="c-var">routes</span> = [
    { <span class="c-var">path</span>: <span class="c-str">'/'</span>,             <span class="c-var">name</span>: <span class="c-str">'home'</span>,    <span class="c-var">component</span>: <span class="c-type">Home</span> },
    { <span class="c-var">path</span>: <span class="c-str">'/about'</span>,        <span class="c-var">name</span>: <span class="c-str">'about'</span>,   <span class="c-var">component</span>: () =&gt; <span class="c-key">import</span>(<span class="c-str">'@/views/About.vue'</span>) },  <span class="c-comment">// lazy load</span>
    { <span class="c-var">path</span>: <span class="c-str">'/users/:id'</span>,   <span class="c-var">name</span>: <span class="c-str">'user'</span>,    <span class="c-var">component</span>: <span class="c-type">UserProfile</span>, <span class="c-var">props</span>: <span class="c-key">true</span> },
    { <span class="c-var">path</span>: <span class="c-str">'/:pathMatch(.*)*'</span>, <span class="c-var">name</span>: <span class="c-str">'404'</span>, <span class="c-var">component</span>: () =&gt; <span class="c-key">import</span>(<span class="c-str">'@/views/NotFound.vue'</span>) },
];

<span class="c-key">export default</span> <span class="c-fn">createRouter</span>({
    <span class="c-var">history</span>: <span class="c-fn">createWebHistory</span>(),
    <span class="c-var">routes</span>,
});</code></pre>
    <pre><code><span class="c-comment">// main.js</span>
<span class="c-key">import</span> router <span class="c-key">from</span> <span class="c-str">'./router'</span>;
<span class="c-fn">createApp</span>(<span class="c-type">App</span>).<span class="c-fn">use</span>(<span class="c-var">router</span>).<span class="c-fn">mount</span>(<span class="c-str">'#app'</span>);</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Использование в компонентах</h3>
    <pre><code>&lt;<span class="c-key">template</span>&gt;
    <span class="c-comment">&lt;!-- Ссылки --&gt;</span>
    &lt;<span class="c-key">router-link</span> <span class="c-var">to</span>=<span class="c-str">"/"</span>&gt;Главная&lt;/<span class="c-key">router-link</span>&gt;
    &lt;<span class="c-key">router-link</span> <span class="c-var">:to</span>=<span class="c-str">"{ name: 'user', params: { id: 42 } }"</span>&gt;Профиль&lt;/<span class="c-key">router-link</span>&gt;

    <span class="c-comment">&lt;!-- Место где рендерится активный компонент --&gt;</span>
    &lt;<span class="c-key">router-view</span> /&gt;
&lt;/<span class="c-key">template</span>&gt;

&lt;<span class="c-key">script</span> <span class="c-var">setup</span>&gt;
<span class="c-key">import</span> { <span class="c-var">useRoute</span>, <span class="c-var">useRouter</span> } <span class="c-key">from</span> <span class="c-str">'vue-router'</span>;

<span class="c-key">const</span> <span class="c-var">route</span> = <span class="c-fn">useRoute</span>();     <span class="c-comment">// текущий роут (params, query, ...)</span>
<span class="c-key">const</span> <span class="c-var">router</span> = <span class="c-fn">useRouter</span>();  <span class="c-comment">// программная навигация</span>

<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">route</span>.<span class="c-var">params</span>.<span class="c-var">id</span>);        <span class="c-comment">// 42</span>
<span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">route</span>.<span class="c-var">query</span>.<span class="c-var">page</span>);       <span class="c-comment">// ?page=2 → 2</span>

<span class="c-key">function</span> <span class="c-fn">goToLogin</span>() {
    <span class="c-var">router</span>.<span class="c-fn">push</span>({ <span class="c-var">name</span>: <span class="c-str">'login'</span> });    <span class="c-comment">// или router.push('/login')</span>
}
&lt;/<span class="c-key">script</span>&gt;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Navigation guards — защита роутов</h3>
    <pre><code><span class="c-comment">// В роутере — beforeEach</span>
<span class="c-var">router</span>.<span class="c-fn">beforeEach</span>((<span class="c-var">to</span>, <span class="c-var">from</span>, <span class="c-var">next</span>) =&gt; {
    <span class="c-key">if</span> (<span class="c-var">to</span>.<span class="c-var">meta</span>.<span class="c-var">requiresAuth</span> &amp;&amp; !<span class="c-fn">isAuthenticated</span>()) {
        <span class="c-var">next</span>({ <span class="c-var">name</span>: <span class="c-str">'login'</span> });
    } <span class="c-key">else</span> {
        <span class="c-var">next</span>();
    }
});

<span class="c-comment">// В роутах</span>
{ <span class="c-var">path</span>: <span class="c-str">'/dashboard'</span>, <span class="c-var">component</span>: <span class="c-type">Dashboard</span>, <span class="c-var">meta</span>: { <span class="c-var">requiresAuth</span>: <span class="c-key">true</span> } }</code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-pinia" class="section">
  <div class="section-title">Pinia — state management</div>

  <div class="subsection">
    <p class="text"><strong>Pinia</strong> — официальный стейт-менеджер для Vue 3 (замена Vuex). Хранит данные которые нужны нескольким компонентам: пользователь, корзина, настройки.</p>

    <pre><code>npm install pinia</code></pre>

    <pre><code><span class="c-comment">// main.js</span>
<span class="c-key">import</span> { <span class="c-var">createPinia</span> } <span class="c-key">from</span> <span class="c-str">'pinia'</span>;
<span class="c-fn">createApp</span>(<span class="c-type">App</span>).<span class="c-fn">use</span>(<span class="c-fn">createPinia</span>()).<span class="c-fn">mount</span>(<span class="c-str">'#app'</span>);</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Store — Composition API стиль</h3>
    <pre><code><span class="c-comment">// stores/user.js</span>
<span class="c-key">import</span> { <span class="c-var">defineStore</span> } <span class="c-key">from</span> <span class="c-str">'pinia'</span>;
<span class="c-key">import</span> { <span class="c-var">ref</span>, <span class="c-var">computed</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;

<span class="c-key">export const</span> <span class="c-var">useUserStore</span> = <span class="c-fn">defineStore</span>(<span class="c-str">'user'</span>, () =&gt; {
    <span class="c-comment">// state</span>
    <span class="c-key">const</span> <span class="c-var">user</span> = <span class="c-fn">ref</span>(<span class="c-key">null</span>);
    <span class="c-key">const</span> <span class="c-var">token</span> = <span class="c-fn">ref</span>(<span class="c-fn">localStorage</span>.<span class="c-fn">getItem</span>(<span class="c-str">'token'</span>));

    <span class="c-comment">// getters (computed)</span>
    <span class="c-key">const</span> <span class="c-var">isLoggedIn</span> = <span class="c-fn">computed</span>(() =&gt; !!<span class="c-var">user</span>.<span class="c-var">value</span>);
    <span class="c-key">const</span> <span class="c-var">isAdmin</span> = <span class="c-fn">computed</span>(() =&gt; <span class="c-var">user</span>.<span class="c-var">value</span>?.<span class="c-var">role</span> === <span class="c-str">'admin'</span>);

    <span class="c-comment">// actions</span>
    <span class="c-key">async function</span> <span class="c-fn">login</span>(<span class="c-var">email</span>, <span class="c-var">password</span>) {
        <span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-fn">fetch</span>(<span class="c-str">'/api/login'</span>, {
            <span class="c-var">method</span>: <span class="c-str">'POST'</span>,
            <span class="c-var">body</span>: <span class="c-fn">JSON</span>.<span class="c-fn">stringify</span>({ <span class="c-var">email</span>, <span class="c-var">password</span> }),
        });
        <span class="c-key">const</span> <span class="c-var">data</span> = <span class="c-key">await</span> <span class="c-var">res</span>.<span class="c-fn">json</span>();
        <span class="c-var">user</span>.<span class="c-var">value</span> = <span class="c-var">data</span>.<span class="c-var">user</span>;
        <span class="c-var">token</span>.<span class="c-var">value</span> = <span class="c-var">data</span>.<span class="c-var">token</span>;
        <span class="c-fn">localStorage</span>.<span class="c-fn">setItem</span>(<span class="c-str">'token'</span>, <span class="c-var">data</span>.<span class="c-var">token</span>);
    }

    <span class="c-key">function</span> <span class="c-fn">logout</span>() {
        <span class="c-var">user</span>.<span class="c-var">value</span> = <span class="c-key">null</span>;
        <span class="c-var">token</span>.<span class="c-var">value</span> = <span class="c-key">null</span>;
        <span class="c-fn">localStorage</span>.<span class="c-fn">removeItem</span>(<span class="c-str">'token'</span>);
    }

    <span class="c-key">return</span> { <span class="c-var">user</span>, <span class="c-var">token</span>, <span class="c-var">isLoggedIn</span>, <span class="c-var">isAdmin</span>, <span class="c-var">login</span>, <span class="c-var">logout</span> };
});</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Использование в компонентах</h3>
    <pre><code>&lt;<span class="c-key">script</span> <span class="c-var">setup</span>&gt;
<span class="c-key">import</span> { <span class="c-fn">useUserStore</span> } <span class="c-key">from</span> <span class="c-str">'@/stores/user'</span>;
<span class="c-key">import</span> { <span class="c-var">storeToRefs</span> } <span class="c-key">from</span> <span class="c-str">'pinia'</span>;

<span class="c-key">const</span> <span class="c-var">userStore</span> = <span class="c-fn">useUserStore</span>();

<span class="c-comment">// ⚠ storeToRefs — чтобы деструктуризация сохранила реактивность</span>
<span class="c-key">const</span> { <span class="c-var">user</span>, <span class="c-var">isLoggedIn</span> } = <span class="c-fn">storeToRefs</span>(<span class="c-var">userStore</span>);

<span class="c-comment">// Actions можно деструктурировать как обычно</span>
<span class="c-key">const</span> { <span class="c-var">login</span>, <span class="c-var">logout</span> } = <span class="c-var">userStore</span>;
&lt;/<span class="c-key">script</span>&gt;

&lt;<span class="c-key">template</span>&gt;
    &lt;<span class="c-key">div</span> <span class="c-var">v-if</span>=<span class="c-str">"isLoggedIn"</span>&gt;
        &lt;<span class="c-key">p</span>&gt;Привет, {{ user.name }}!&lt;/<span class="c-key">p</span>&gt;
        &lt;<span class="c-key">button</span> @<span class="c-var">click</span>=<span class="c-str">"logout"</span>&gt;Выйти&lt;/<span class="c-key">button</span>&gt;
    &lt;/<span class="c-key">div</span>&gt;
&lt;/<span class="c-key">template</span>&gt;</code></pre>
    <div class="pitfall">
      <strong>⚠ storeToRefs обязателен</strong> при деструктуризации state/getters. Обычная деструктуризация ломает реактивность. Actions деструктуризировать можно нормально.
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-http" class="section">
  <div class="section-title">HTTP запросы — axios vs fetch</div>

  <div class="subsection">
    <h3 class="subsection-title">axios — стандарт в Vue-мире</h3>
    <pre><code>npm install axios</code></pre>
    <pre><code><span class="c-comment">// api/http.js — глобальная конфигурация</span>
<span class="c-key">import</span> axios <span class="c-key">from</span> <span class="c-str">'axios'</span>;

<span class="c-key">const</span> <span class="c-var">http</span> = axios.<span class="c-fn">create</span>({
    <span class="c-var">baseURL</span>: <span class="c-str">'/api'</span>,
    <span class="c-var">timeout</span>: <span class="c-num">10000</span>,
    <span class="c-var">headers</span>: {
        <span class="c-str">'Accept'</span>: <span class="c-str">'application/json'</span>,
        <span class="c-str">'Content-Type'</span>: <span class="c-str">'application/json'</span>,
    },
});

<span class="c-comment">// Interceptor — добавить токен ко всем запросам</span>
<span class="c-var">http</span>.<span class="c-var">interceptors</span>.<span class="c-var">request</span>.<span class="c-fn">use</span>((<span class="c-var">config</span>) =&gt; {
    <span class="c-key">const</span> <span class="c-var">token</span> = <span class="c-fn">localStorage</span>.<span class="c-fn">getItem</span>(<span class="c-str">'token'</span>);
    <span class="c-key">if</span> (<span class="c-var">token</span>) <span class="c-var">config</span>.<span class="c-var">headers</span>.<span class="c-var">Authorization</span> = <span class="c-str">`Bearer ${token}`</span>;
    <span class="c-key">return</span> <span class="c-var">config</span>;
});

<span class="c-comment">// Interceptor — глобальная обработка 401</span>
<span class="c-var">http</span>.<span class="c-var">interceptors</span>.<span class="c-var">response</span>.<span class="c-fn">use</span>(
    (<span class="c-var">response</span>) =&gt; <span class="c-var">response</span>,
    (<span class="c-var">error</span>) =&gt; {
        <span class="c-key">if</span> (<span class="c-var">error</span>.<span class="c-var">response</span>?.<span class="c-var">status</span> === <span class="c-num">401</span>) {
            <span class="c-fn">window</span>.<span class="c-fn">location</span>.<span class="c-var">href</span> = <span class="c-str">'/login'</span>;
        }
        <span class="c-key">return</span> <span class="c-fn">Promise</span>.<span class="c-fn">reject</span>(<span class="c-var">error</span>);
    }
);

<span class="c-key">export default</span> <span class="c-var">http</span>;</code></pre>

    <pre><code><span class="c-comment">// Использование в компоненте</span>
&lt;<span class="c-key">script</span> <span class="c-var">setup</span>&gt;
<span class="c-key">import</span> http <span class="c-key">from</span> <span class="c-str">'@/api/http'</span>;
<span class="c-key">import</span> { <span class="c-var">ref</span>, <span class="c-var">onMounted</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;

<span class="c-key">const</span> <span class="c-var">users</span> = <span class="c-fn">ref</span>([]);

<span class="c-fn">onMounted</span>(<span class="c-key">async</span> () =&gt; {
    <span class="c-key">try</span> {
        <span class="c-key">const</span> { <span class="c-var">data</span> } = <span class="c-key">await</span> <span class="c-var">http</span>.<span class="c-fn">get</span>(<span class="c-str">'/users'</span>);
        <span class="c-var">users</span>.<span class="c-var">value</span> = <span class="c-var">data</span>;
    } <span class="c-key">catch</span> (<span class="c-var">e</span>) {
        <span class="c-fn">console</span>.<span class="c-fn">error</span>(<span class="c-var">e</span>.<span class="c-var">response</span>?.<span class="c-var">data</span>?.<span class="c-var">message</span>);
    }
});

<span class="c-key">async function</span> <span class="c-fn">createUser</span>(<span class="c-var">data</span>) {
    <span class="c-key">const</span> <span class="c-var">res</span> = <span class="c-key">await</span> <span class="c-var">http</span>.<span class="c-fn">post</span>(<span class="c-str">'/users'</span>, <span class="c-var">data</span>);
    <span class="c-key">return</span> <span class="c-var">res</span>.<span class="c-var">data</span>;
}
&lt;/<span class="c-key">script</span>&gt;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">axios vs fetch</h3>
    <table class="data-table">
      <thead><tr><th></th><th>axios</th><th>fetch</th></tr></thead>
      <tbody>
        <tr><td>JSON parsing</td><td>Автоматически</td><td>Вручную <code>res.json()</code></td></tr>
        <tr><td>Ошибки 4xx/5xx</td><td>Бросает</td><td>Не бросает — надо <code>res.ok</code></td></tr>
        <tr><td>Interceptors</td><td>Есть (для auth, logging)</td><td>Нет — надо оборачивать</td></tr>
        <tr><td>Отмена запроса</td><td><code>CancelToken</code></td><td><code>AbortController</code></td></tr>
        <tr><td>Timeout</td><td>Есть встроенный</td><td>Только через AbortController</td></tr>
        <tr><td>Размер</td><td>~13 KB</td><td>Встроен в браузер</td></tr>
      </tbody>
    </table>
    <div class="tip">Для больших Vue-приложений — <strong>axios</strong> (interceptors для auth критичны). Для маленьких виджетов — <strong>fetch</strong> достаточно.</div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-under-hood-proxy" class="section">
  <div class="section-title">Под капотом: реактивность через Proxy</div>

  <div class="subsection">
    <p class="text">Реактивность Vue 3 построена на JS <code>Proxy</code> — прокси-объекте, который перехватывает все операции доступа к свойствам объекта. Это ключевая причина почему Vue 3 работает быстрее Vue 2 и не имеет ограничений <code>Vue.set</code>.</p>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Упрощённая реализация reactive()</h3>
    <pre><code><span class="c-comment">// Примерно так работает reactive() внутри Vue</span>
<span class="c-key">function</span> <span class="c-fn">reactive</span>(<span class="c-var">target</span>) {
    <span class="c-key">return</span> <span class="c-key">new</span> <span class="c-fn">Proxy</span>(<span class="c-var">target</span>, {
        <span class="c-fn">get</span>(<span class="c-var">obj</span>, <span class="c-var">key</span>) {
            <span class="c-fn">track</span>(<span class="c-var">obj</span>, <span class="c-var">key</span>);              <span class="c-comment">// запомнить кто читал (для computed/watch)</span>
            <span class="c-key">return</span> <span class="c-fn">Reflect</span>.<span class="c-fn">get</span>(<span class="c-var">obj</span>, <span class="c-var">key</span>);
        },
        <span class="c-fn">set</span>(<span class="c-var">obj</span>, <span class="c-var">key</span>, <span class="c-var">value</span>) {
            <span class="c-key">const</span> <span class="c-var">result</span> = <span class="c-fn">Reflect</span>.<span class="c-fn">set</span>(<span class="c-var">obj</span>, <span class="c-var">key</span>, <span class="c-var">value</span>);
            <span class="c-fn">trigger</span>(<span class="c-var">obj</span>, <span class="c-var">key</span>);            <span class="c-comment">// уведомить всех кто читал — пересчитаться</span>
            <span class="c-key">return</span> <span class="c-var">result</span>;
        },
        <span class="c-fn">deleteProperty</span>(<span class="c-var">obj</span>, <span class="c-var">key</span>) {
            <span class="c-key">const</span> <span class="c-var">result</span> = <span class="c-fn">Reflect</span>.<span class="c-fn">deleteProperty</span>(<span class="c-var">obj</span>, <span class="c-var">key</span>);
            <span class="c-fn">trigger</span>(<span class="c-var">obj</span>, <span class="c-var">key</span>);
            <span class="c-key">return</span> <span class="c-var">result</span>;
        },
    });
}</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Зависимости (dep tracking)</h3>
    <pre><code><span class="c-comment">// Упрощённо:</span>
<span class="c-key">const</span> <span class="c-var">targetMap</span> = <span class="c-key">new</span> <span class="c-fn">WeakMap</span>();  <span class="c-comment">// объект → Map ключей → Set эффектов</span>
<span class="c-key">let</span> <span class="c-var">activeEffect</span> = <span class="c-key">null</span>;

<span class="c-key">function</span> <span class="c-fn">track</span>(<span class="c-var">obj</span>, <span class="c-var">key</span>) {
    <span class="c-key">if</span> (!<span class="c-var">activeEffect</span>) <span class="c-key">return</span>;
    <span class="c-key">let</span> <span class="c-var">depsMap</span> = <span class="c-var">targetMap</span>.<span class="c-fn">get</span>(<span class="c-var">obj</span>);
    <span class="c-key">if</span> (!<span class="c-var">depsMap</span>) <span class="c-var">targetMap</span>.<span class="c-fn">set</span>(<span class="c-var">obj</span>, <span class="c-var">depsMap</span> = <span class="c-key">new</span> <span class="c-fn">Map</span>());
    <span class="c-key">let</span> <span class="c-var">dep</span> = <span class="c-var">depsMap</span>.<span class="c-fn">get</span>(<span class="c-var">key</span>);
    <span class="c-key">if</span> (!<span class="c-var">dep</span>) <span class="c-var">depsMap</span>.<span class="c-fn">set</span>(<span class="c-var">key</span>, <span class="c-var">dep</span> = <span class="c-key">new</span> <span class="c-fn">Set</span>());
    <span class="c-var">dep</span>.<span class="c-fn">add</span>(<span class="c-var">activeEffect</span>);
}

<span class="c-key">function</span> <span class="c-fn">trigger</span>(<span class="c-var">obj</span>, <span class="c-var">key</span>) {
    <span class="c-key">const</span> <span class="c-var">dep</span> = <span class="c-var">targetMap</span>.<span class="c-fn">get</span>(<span class="c-var">obj</span>)?.<span class="c-fn">get</span>(<span class="c-var">key</span>);
    <span class="c-var">dep</span>?.<span class="c-fn">forEach</span>(<span class="c-var">effect</span> =&gt; <span class="c-var">effect</span>());
}

<span class="c-comment">// effect — то что вызовется при изменении. Компонент, computed, watchEffect — всё это эффекты.</span>
<span class="c-key">function</span> <span class="c-fn">effect</span>(<span class="c-var">fn</span>) {
    <span class="c-var">activeEffect</span> = <span class="c-var">fn</span>;
    <span class="c-var">fn</span>();
    <span class="c-var">activeEffect</span> = <span class="c-key">null</span>;
}</code></pre>
    <div class="tip">
      <strong>Vue 2 использовал <code>Object.defineProperty</code></strong> — работало только на существующих свойствах. Добавить новое поле было нельзя, приходилось использовать <code>Vue.set(obj, key, value)</code>. Proxy решил эту проблему полностью — он видит любые операции с объектом.
    </div>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Ограничения Proxy</h3>
    <ul style="line-height:1.9;margin-left:20px">
      <li><strong>Не работает на примитивах</strong> — <code>Proxy</code> оборачивает только объекты. Поэтому для строк/чисел есть <code>ref()</code> с <code>.value</code></li>
      <li><strong>Не работает в старых браузерах</strong> — Proxy требует ES6+. Vue 3 не поддерживает IE11 (в Vue 2 была поддержка через defineProperty)</li>
      <li><strong>Не отследит замену корня</strong> — <code>state = {}</code> потеряет реактивность, всегда мутировать поля</li>
    </ul>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-under-hood-vdom" class="section">
  <div class="section-title">Под капотом: Virtual DOM</div>

  <div class="subsection">
    <p class="text">Vue не обновляет DOM напрямую при каждом изменении данных. Вместо этого:</p>
    <ol style="line-height:1.9;margin-left:20px">
      <li><strong>Шаблон</strong> компилируется в <strong>render функцию</strong>, которая возвращает Virtual DOM tree — обычные JS-объекты, описывающие DOM</li>
      <li>При изменении реактивных данных Vue вызывает render → новое VDOM дерево</li>
      <li>Алгоритм <strong>diff</strong> сравнивает старое и новое дерево, находит минимальный набор изменений</li>
      <li>Vue применяет только эти изменения к реальному DOM (patch)</li>
    </ol>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Пример трансформации шаблона</h3>
    <pre><code>&lt;<span class="c-key">template</span>&gt;
    &lt;<span class="c-key">div</span> <span class="c-var">class</span>=<span class="c-str">"container"</span>&gt;
        &lt;<span class="c-key">h1</span>&gt;{{ title }}&lt;/<span class="c-key">h1</span>&gt;
        &lt;<span class="c-key">p</span>&gt;{{ count }}&lt;/<span class="c-key">p</span>&gt;
    &lt;/<span class="c-key">div</span>&gt;
&lt;/<span class="c-key">template</span>&gt;</code></pre>
    <p class="text">Компилируется в примерно такую render-функцию:</p>
    <pre><code><span class="c-key">function</span> <span class="c-fn">render</span>() {
    <span class="c-key">return</span> <span class="c-fn">h</span>(<span class="c-str">'div'</span>, { <span class="c-var">class</span>: <span class="c-str">'container'</span> }, [
        <span class="c-fn">h</span>(<span class="c-str">'h1'</span>, <span class="c-key">this</span>.<span class="c-var">title</span>),
        <span class="c-fn">h</span>(<span class="c-str">'p'</span>, <span class="c-key">this</span>.<span class="c-var">count</span>),
    ]);
}
<span class="c-comment">// h() — сокращение от hyperscript. Создаёт VNode — объект вида
// { type: 'div', props: {...}, children: [...] }</span></code></pre>
    <div class="tip">
      Vue 3 умеет <strong>optimize compile</strong>: помечает статические части (то что не меняется) и пропускает их при diff. Это делает Vue 3 в разы быстрее Vue 2.
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-laravel-blade" class="section">
  <div class="section-title">Blade + Vue — как совместить</div>

  <div class="subsection">
    <h3 class="subsection-title">Проблема: {{ }} есть и в Blade и в Vue</h3>
    <p class="text">Blade использует <code>{{ }}</code> для интерполяции. Vue тоже. При компиляции blade сначала подставляет свои значения — Vue-выражения ломаются.</p>

    <h3 class="subsection-title">Решение 1 — <code>@{{ }}</code> экранирование</h3>
    <pre><code>&lt;<span class="c-key">div</span> <span class="c-var">id</span>=<span class="c-str">"app"</span>&gt;
    <span class="c-comment">&lt;!-- @{{ }} говорит Blade: НЕ трогай, отдай Vue как есть --&gt;</span>
    &lt;<span class="c-key">p</span>&gt;@{{ message }}&lt;/<span class="c-key">p</span>&gt;
&lt;/<span class="c-key">div</span>&gt;</code></pre>

    <h3 class="subsection-title">Решение 2 — <code>&commat;verbatim</code> для больших блоков</h3>
    <pre><code>&commat;verbatim
&lt;<span class="c-key">div</span> <span class="c-var">id</span>=<span class="c-str">"app"</span>&gt;
    &lt;<span class="c-key">h1</span>&gt;{{ title }}&lt;/<span class="c-key">h1</span>&gt;
    &lt;<span class="c-key">p</span> <span class="c-var">v-for</span>=<span class="c-str">"user in users"</span>&gt;{{ user.name }}&lt;/<span class="c-key">p</span>&gt;
&lt;/<span class="c-key">div</span>&gt;
&commat;endverbatim</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Передача данных из Blade в Vue</h3>
    <p class="text"><strong>Способ 1 — props компонента</strong></p>
    <pre><code>&lt;<span class="c-key">div</span> <span class="c-var">id</span>=<span class="c-str">"app"</span>&gt;
    &lt;<span class="c-key">user-card</span>
        <span class="c-var">:user</span>=<span class="c-str">'@json($user)'</span>
        <span class="c-var">:token</span>=<span class="c-str">"'{{ csrf_token() }}'"</span>
    &gt;&lt;/<span class="c-key">user-card</span>&gt;
&lt;/<span class="c-key">div</span>&gt;</code></pre>
    <p class="text"><strong>Способ 2 — глобальная window переменная</strong></p>
    <pre><code>&lt;<span class="c-key">script</span>&gt;
    <span class="c-fn">window</span>.<span class="c-var">APP_CONFIG</span> = @json([
        <span class="c-str">'user'</span> =&gt; <span class="c-fn">auth</span>()-&gt;<span class="c-fn">user</span>(),
        <span class="c-str">'locale'</span> =&gt; <span class="c-fn">app</span>()-&gt;<span class="c-fn">getLocale</span>(),
        <span class="c-str">'csrfToken'</span> =&gt; <span class="c-fn">csrf_token</span>(),
    ]);
&lt;/<span class="c-key">script</span>&gt;

@vite([<span class="c-str">'resources/js/app.js'</span>])</code></pre>
    <p class="text">В Vue-коде: <code>window.APP_CONFIG.user</code></p>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-laravel-csrf" class="section">
  <div class="section-title">CSRF в Vue + Laravel</div>

  <div class="subsection">
    <p class="text">Laravel требует CSRF-токен для всех POST/PUT/DELETE. Без токена — <code>419 Page Expired</code>.</p>

    <h3 class="subsection-title">Способ 1 — Sanctum + SPA (рекомендуется)</h3>
    <p class="text">Laravel Sanctum поддерживает cookie-based auth для SPA. Правильная последовательность:</p>
    <ol style="line-height:1.9;margin-left:20px">
      <li>Из Vue делаешь <code>GET /sanctum/csrf-cookie</code> — Laravel устанавливает <code>XSRF-TOKEN</code> в cookie</li>
      <li>axios автоматически читает эту cookie и добавляет header <code>X-XSRF-TOKEN</code> на всех запросах</li>
      <li>Laravel сверяет header с cookie</li>
    </ol>
    <pre><code><span class="c-comment">// api/http.js</span>
<span class="c-key">import</span> axios <span class="c-key">from</span> <span class="c-str">'axios'</span>;

<span class="c-key">const</span> <span class="c-var">http</span> = axios.<span class="c-fn">create</span>({
    <span class="c-var">baseURL</span>: <span class="c-str">'http://localhost:8000'</span>,
    <span class="c-var">withCredentials</span>: <span class="c-key">true</span>,     <span class="c-comment">//  обязательно! cookies с запросами</span>
    <span class="c-var">withXSRFToken</span>: <span class="c-key">true</span>,        <span class="c-comment">// axios 1.6+: авто-добавление X-XSRF-TOKEN</span>
});

<span class="c-comment">// Перед login — получить csrf-cookie</span>
<span class="c-key">async function</span> <span class="c-fn">login</span>(<span class="c-var">email</span>, <span class="c-var">password</span>) {
    <span class="c-key">await</span> <span class="c-var">http</span>.<span class="c-fn">get</span>(<span class="c-str">'/sanctum/csrf-cookie'</span>);
    <span class="c-key">return</span> <span class="c-var">http</span>.<span class="c-fn">post</span>(<span class="c-str">'/login'</span>, { <span class="c-var">email</span>, <span class="c-var">password</span> });
}</code></pre>

    <h3 class="subsection-title" style="margin-top:14px">Способ 2 — Blade + meta tag (для встроенных Vue)</h3>
    <pre><code>&lt;<span class="c-key">head</span>&gt;
    &lt;<span class="c-key">meta</span> <span class="c-var">name</span>=<span class="c-str">"csrf-token"</span> <span class="c-var">content</span>=<span class="c-str">"{{ csrf_token() }}"</span>&gt;
&lt;/<span class="c-key">head</span>&gt;

<span class="c-comment">// В Vue-коде</span>
<span class="c-key">const</span> <span class="c-var">csrf</span> = <span class="c-fn">document</span>.<span class="c-fn">querySelector</span>(<span class="c-str">'meta[name="csrf-token"]'</span>).<span class="c-var">content</span>;
axios.<span class="c-var">defaults</span>.<span class="c-var">headers</span>.<span class="c-var">common</span>[<span class="c-str">'X-CSRF-TOKEN'</span>] = <span class="c-var">csrf</span>;</code></pre>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-laravel-full" class="section">
  <div class="section-title">Полный поток: форма Vue → Laravel API</div>

  <div class="subsection">
    <h3 class="subsection-title">Frontend — Vue компонент</h3>
    <pre><code>&lt;<span class="c-key">template</span>&gt;
    &lt;<span class="c-key">form</span> @<span class="c-var">submit.prevent</span>=<span class="c-str">"submit"</span>&gt;
        &lt;<span class="c-key">input</span> <span class="c-var">v-model</span>=<span class="c-str">"form.email"</span> <span class="c-var">type</span>=<span class="c-str">"email"</span> <span class="c-var">placeholder</span>=<span class="c-str">"Email"</span>&gt;
        &lt;<span class="c-key">span</span> <span class="c-var">v-if</span>=<span class="c-str">"errors.email"</span> <span class="c-var">class</span>=<span class="c-str">"error"</span>&gt;{{ errors.email[<span class="c-num">0</span>] }}&lt;/<span class="c-key">span</span>&gt;

        &lt;<span class="c-key">input</span> <span class="c-var">v-model</span>=<span class="c-str">"form.password"</span> <span class="c-var">type</span>=<span class="c-str">"password"</span>&gt;
        &lt;<span class="c-key">span</span> <span class="c-var">v-if</span>=<span class="c-str">"errors.password"</span> <span class="c-var">class</span>=<span class="c-str">"error"</span>&gt;{{ errors.password[<span class="c-num">0</span>] }}&lt;/<span class="c-key">span</span>&gt;

        &lt;<span class="c-key">button</span> <span class="c-var">:disabled</span>=<span class="c-str">"loading"</span>&gt;{{ loading ? <span class="c-str">'...'</span> : <span class="c-str">'Login'</span> }}&lt;/<span class="c-key">button</span>&gt;
    &lt;/<span class="c-key">form</span>&gt;
&lt;/<span class="c-key">template</span>&gt;

&lt;<span class="c-key">script</span> <span class="c-var">setup</span>&gt;
<span class="c-key">import</span> { <span class="c-var">reactive</span>, <span class="c-var">ref</span> } <span class="c-key">from</span> <span class="c-str">'vue'</span>;
<span class="c-key">import</span> { <span class="c-fn">useRouter</span> } <span class="c-key">from</span> <span class="c-str">'vue-router'</span>;
<span class="c-key">import</span> http <span class="c-key">from</span> <span class="c-str">'@/api/http'</span>;

<span class="c-key">const</span> <span class="c-var">router</span> = <span class="c-fn">useRouter</span>();
<span class="c-key">const</span> <span class="c-var">form</span> = <span class="c-fn">reactive</span>({ <span class="c-var">email</span>: <span class="c-str">''</span>, <span class="c-var">password</span>: <span class="c-str">''</span> });
<span class="c-key">const</span> <span class="c-var">errors</span> = <span class="c-fn">ref</span>({});
<span class="c-key">const</span> <span class="c-var">loading</span> = <span class="c-fn">ref</span>(<span class="c-key">false</span>);

<span class="c-key">async function</span> <span class="c-fn">submit</span>() {
    <span class="c-var">errors</span>.<span class="c-var">value</span> = {};
    <span class="c-var">loading</span>.<span class="c-var">value</span> = <span class="c-key">true</span>;

    <span class="c-key">try</span> {
        <span class="c-key">await</span> <span class="c-var">http</span>.<span class="c-fn">get</span>(<span class="c-str">'/sanctum/csrf-cookie'</span>);
        <span class="c-key">const</span> { <span class="c-var">data</span> } = <span class="c-key">await</span> <span class="c-var">http</span>.<span class="c-fn">post</span>(<span class="c-str">'/login'</span>, <span class="c-var">form</span>);
        <span class="c-var">router</span>.<span class="c-fn">push</span>({ <span class="c-var">name</span>: <span class="c-str">'dashboard'</span> });
    } <span class="c-key">catch</span> (<span class="c-var">e</span>) {
        <span class="c-key">if</span> (<span class="c-var">e</span>.<span class="c-var">response</span>?.<span class="c-var">status</span> === <span class="c-num">422</span>) {
            <span class="c-var">errors</span>.<span class="c-var">value</span> = <span class="c-var">e</span>.<span class="c-var">response</span>.<span class="c-var">data</span>.<span class="c-var">errors</span>;   <span class="c-comment">// Laravel validation errors</span>
        } <span class="c-key">else</span> {
            <span class="c-fn">alert</span>(<span class="c-str">'Ошибка сервера'</span>);
        }
    } <span class="c-key">finally</span> {
        <span class="c-var">loading</span>.<span class="c-var">value</span> = <span class="c-key">false</span>;
    }
}
&lt;/<span class="c-key">script</span>&gt;</code></pre>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Backend — Laravel controller</h3>
    <pre><code><span class="c-key">public function</span> <span class="c-fn">login</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>): <span class="c-type">JsonResponse</span>
{
    <span class="c-var">$validated</span> = <span class="c-var">$request</span>-&gt;<span class="c-fn">validate</span>([
        <span class="c-str">'email'</span>    =&gt; <span class="c-str">'required|email'</span>,
        <span class="c-str">'password'</span> =&gt; <span class="c-str">'required|min:8'</span>,
    ]);

    <span class="c-key">if</span> (! <span class="c-type">Auth</span>::<span class="c-fn">attempt</span>(<span class="c-var">$validated</span>)) {
        <span class="c-key">throw</span> <span class="c-type">ValidationException</span>::<span class="c-fn">withMessages</span>([
            <span class="c-str">'email'</span> =&gt; <span class="c-str">'Неверный email или пароль'</span>,
        ]);
    }

    <span class="c-var">$request</span>-&gt;<span class="c-fn">session</span>()-&gt;<span class="c-fn">regenerate</span>();

    <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>([
        <span class="c-str">'user'</span> =&gt; <span class="c-type">Auth</span>::<span class="c-fn">user</span>(),
    ]);
}</code></pre>
    <div class="remember-box">
      <strong>Ключевое:</strong> Laravel возвращает validation errors со статусом <strong>422</strong>. Vue ловит через <code>catch</code>, читает <code>e.response.data.errors</code> — это объект <code>{ email: ['...'], password: ['...'] }</code>, где каждое поле = массив ошибок.
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-vue-vs" class="section">
  <div class="section-title">Vue vs React vs jQuery — сравнение</div>

  <div class="subsection">
    <table class="data-table">
      <thead><tr><th></th><th>Vue 3</th><th>React 18+</th><th>jQuery</th></tr></thead>
      <tbody>
        <tr>
          <td><strong>Тип</strong></td>
          <td>Прогрессивный фреймворк</td>
          <td>Библиотека для UI</td>
          <td>Библиотека для DOM/AJAX</td>
        </tr>
        <tr>
          <td><strong>Реактивность</strong></td>
          <td>Автоматическая (Proxy)</td>
          <td>Ручная через setState/useState</td>
          <td>Ручная — ты сам меняешь DOM</td>
        </tr>
        <tr>
          <td><strong>Шаблоны</strong></td>
          <td>HTML-шаблоны + директивы</td>
          <td>JSX (JS + HTML в коде)</td>
          <td>Строки HTML или DOM manipulation</td>
        </tr>
        <tr>
          <td><strong>Порог входа</strong></td>
          <td>Низкий — HTML/CSS почти как обычно</td>
          <td>Средний — надо знать JSX + hooks</td>
          <td>Очень низкий — вставил script и работаешь</td>
        </tr>
        <tr>
          <td><strong>SSR</strong></td>
          <td>Nuxt.js</td>
          <td>Next.js</td>
          <td>—</td>
        </tr>
        <tr>
          <td><strong>State management</strong></td>
          <td>Pinia (Vuex устарел)</td>
          <td>Redux / Zustand / Context API</td>
          <td>Обычные переменные / localStorage</td>
        </tr>
        <tr>
          <td><strong>Роутинг</strong></td>
          <td>Vue Router</td>
          <td>React Router</td>
          <td>Ручной hashchange или полная перезагрузка</td>
        </tr>
        <tr>
          <td><strong>Bundle size</strong></td>
          <td>~34 KB</td>
          <td>~45 KB (React + ReactDOM)</td>
          <td>~30 KB (jQuery slim)</td>
        </tr>
        <tr>
          <td><strong>Экосистема</strong></td>
          <td>Меньше, но централизованно (Router/Pinia официальные)</td>
          <td>Огромная, много альтернатив на каждую задачу</td>
          <td>Огромная legacy — плагины на всё</td>
        </tr>
        <tr>
          <td><strong>TypeScript</strong></td>
          <td>Полная нативная поддержка</td>
          <td>Полная нативная</td>
          <td>Плохо</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Когда что выбирать</h3>
    <ul style="line-height:1.9;margin-left:20px">
      <li><strong>Vue</strong> — новые проекты, команда с backend-опытом, быстрый старт SPA</li>
      <li><strong>React</strong> — большие enterprise-проекты, много готовых библиотек, React Native</li>
      <li><strong>jQuery</strong> — legacy, разовые виджеты, WordPress-плагины</li>
    </ul>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-options-vs-comp" class="section">
  <div class="section-title">Options API vs Composition API</div>

  <div class="subsection">
    <table class="data-table">
      <thead><tr><th></th><th>Options API</th><th>Composition API</th></tr></thead>
      <tbody>
        <tr>
          <td><strong>Синтаксис</strong></td>
          <td><code>export default { data(), methods, computed }</code></td>
          <td><code>&lt;script setup&gt;</code> с ref/reactive/computed</td>
        </tr>
        <tr>
          <td><strong>Организация кода</strong></td>
          <td>По типу (data / methods / watch)</td>
          <td>По фиче (весь код одной фичи рядом)</td>
        </tr>
        <tr>
          <td><strong>this</strong></td>
          <td>Есть, критично — <code>this.count++</code></td>
          <td>Нет — просто <code>count.value++</code></td>
        </tr>
        <tr>
          <td><strong>TypeScript</strong></td>
          <td>Тяжелее типизировать</td>
          <td>Отличная типизация из коробки</td>
        </tr>
        <tr>
          <td><strong>Переиспользование логики</strong></td>
          <td>Через mixins (проблемные)</td>
          <td>Через composables (чистые функции)</td>
        </tr>
        <tr>
          <td><strong>Порог входа</strong></td>
          <td>Ниже для начинающих</td>
          <td>Требует понимания реактивности</td>
        </tr>
        <tr>
          <td><strong>Bundle</strong></td>
          <td>Больше — включает всё что описано в опциях</td>
          <td>Меньше — tree-shakable, импортируешь только нужное</td>
        </tr>
        <tr>
          <td><strong>Когда использовать</strong></td>
          <td>Простые компоненты, легаси Vue 2 → 3, обучение</td>
          <td>Всё новое, крупные проекты, TypeScript</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <div class="remember-box">
      <strong>Рекомендация Vue team:</strong> Composition API + <code>&lt;script setup&gt;</code> для новых проектов. Options остаётся для совместимости и обучения. Смешивать в одном проекте — можно, но лучше выбрать один стиль.
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════ -->
<div id="sec-faq" class="section">
  <div class="section-title">Частые вопросы</div>

  <div class="subsection">
    <h3 class="subsection-title">15 базовых вопросов по Vue 3</h3>
    <ol style="line-height:2">
      <li><strong>Vue 2 vs Vue 3 главное отличие</strong> → Vue 3 использует <code>Proxy</code> вместо <code>Object.defineProperty</code> — реактивность работает для любых новых полей, не нужен <code>Vue.set</code>. Плюс Composition API.</li>
      <li><strong>ref vs reactive</strong> → <code>ref</code> универсально (примитивы + объекты, доступ через <code>.value</code>). <code>reactive</code> только для объектов, без <code>.value</code>. По умолчанию — <code>ref</code>.</li>
      <li><strong>Почему нельзя деструктуризировать reactive</strong> → потеряется реактивность, потому что деструктуризация создаёт обычные переменные. Решение — <code>toRefs()</code>.</li>
      <li><strong>computed vs method</strong> → computed кешируется, пересчитывается только при изменении зависимостей. Method вызывается каждый раз при рендере.</li>
      <li><strong>watch vs watchEffect</strong> → watch явно указывает за чем следить. watchEffect автоматически определяет по использованию внутри callback.</li>
      <li><strong>v-if vs v-show</strong> → v-if удаляет/вставляет DOM (дорого при toggle, дёшево если условие редко); v-show меняет CSS display (дёшево при toggle).</li>
      <li><strong>Зачем :key в v-for</strong> → чтобы Vue правильно отслеживал элементы при изменениях списка (вставка/удаление/reorder). Без key будут баги. Не использовать index как key.</li>
      <li><strong>v-model — что делает под капотом</strong> → эквивалент <code>:value="x" @input="x = $event.target.value"</code>. Двусторонняя привязка.</li>
      <li><strong>Как передать данные от ребёнка к родителю</strong> → через <code>emit</code>. Props идут только вниз, события — только вверх (one-way data flow).</li>
      <li><strong>Composition API — зачем нужен</strong> → лучше типизация TS, переиспользование логики через composables, группировка кода по фичам, меньше bundle.</li>
      <li><strong>onMounted vs mounted</strong> → одно и то же, разные API. <code>onMounted</code> — Composition, <code>mounted</code> — Options.</li>
      <li><strong>Как работает реактивность</strong> → Proxy перехватывает get/set свойств. При get — регистрирует зависимость. При set — уведомляет всех кто зависит.</li>
      <li><strong>Что такое Virtual DOM</strong> → JS-объекты описывающие DOM. Vue делает diff между старым и новым, применяет минимум изменений к реальному DOM.</li>
      <li><strong>Pinia vs Vuex</strong> → Pinia — новый официальный. Проще API, лучше TS-поддержка, меньше boilerplate. Vuex устарел, только для старых проектов.</li>
      <li><strong>Как отправить CSRF в Laravel</strong> → axios с <code>withCredentials: true</code> + вызвать <code>/sanctum/csrf-cookie</code> перед POST. Или meta-tag <code>csrf-token</code> + header <code>X-CSRF-TOKEN</code>.</li>
    </ol>
  </div>

  <div class="subsection">
    <h3 class="subsection-title">Типичные ошибки новичков</h3>
    <ul style="line-height:1.9;margin-left:20px">
      <li><strong>Забыл <code>.value</code></strong> на <code>ref</code> в JS-коде — данные не меняются</li>
      <li><strong>Деструктуризация reactive</strong> — теряется реактивность</li>
      <li><strong>Мутация props</strong> в дочернем компоненте — warning в консоли</li>
      <li><strong>Забыл <code>:key</code></strong> в v-for — глюки при обновлении списка</li>
      <li><strong>Забыл <code>onUnmounted</code></strong> для очистки timer/listener — утечка памяти</li>
      <li><strong>v-html с user-input</strong> — XSS</li>
      <li><strong>v-if + v-for на одном элементе</strong> — Vue 3 бросит ошибку (используй computed или template с v-if внутри)</li>
      <li><strong>Arrow function в methods (Options API)</strong> — теряется <code>this</code></li>
      <li><strong>reactive со строкой/числом</strong> — не работает, только объекты</li>
      <li><strong>Забыл <code>storeToRefs</code></strong> при деструктуризации Pinia state — теряется реактивность</li>
    </ul>
  </div>
</div>

</div>
</div>

<script>
function showSection(id, el) {
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    document.getElementById('sec-' + id).classList.add('active');
    if (el) el.classList.add('active');
    window.scrollTo(0, 0);
}
</script>
</body>
</html>
@endverbatim
