@verbatim
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Core Knowledge Base - Interview Guide</title>
    <style>
  :root {
    --bg:           #F5F8FA;
    --surface:      #FFFFFF;
    --surface-light:#F5F8FA;
    --border:       #E4E6EF;
    --text:         #181C32;
    --text2:        #7E8299;
    --text3:        #A1A5B7;
    --primary:      #404357;
    --primary-light:#EFF2F5;
    --purple:       #7239EA;
    --purple-light: #F8F5FF;
    --success:      #50CD89;
    --success-light:#E8FFF3;
    --warning:      #FFC700;
    --warning-light:#FFF8DD;
    --danger:       #F1416C;
    --danger-light: #FFF5F8;
    --shadow:       0 2px 10px rgba(24,28,50,0.07);
    --code-bg:      #1E1E2D;
    --code-border:  #2D3347;
  }

  * { margin:0; padding:0; box-sizing:border-box; }

  body {
    background: var(--bg);
    color: var(--text);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    line-height: 1.6;
    font-size: 14px;
    -webkit-font-smoothing: antialiased;
  }

  .container {
    width: 100%;
    display: grid;
    grid-template-columns: 260px 1fr;
    min-height: 100vh;
  }

  /* ── Sidebar ── */
  .sidebar {
    background: var(--surface);
    padding: 24px 14px;
    position: fixed;
    width: 260px;
    height: 100vh;
    overflow-y: auto;
    border-right: 1px solid var(--border);
    box-shadow: 2px 0 8px rgba(24,28,50,0.04);
  }
  .sidebar-back {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 8px 10px;
    margin-bottom: 14px;
    color: var(--primary);
    text-decoration: none;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 600;
    transition: background 0.2s;
  }
  .sidebar-back:hover { background: var(--primary-light); }
  .sidebar-back svg { width: 14px; height: 14px; }
  .sidebar-title {
    font-size: 11px;
    font-weight: 800;
    color: var(--text3);
    text-transform: uppercase;
    letter-spacing: 1.2px;
    margin-bottom: 10px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--border);
  }
  .nav-item {
    display: block;
    padding: 9px 12px;
    margin-bottom: 3px;
    color: var(--text2);
    text-decoration: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.18s;
    font-size: 13px;
    font-weight: 500;
    border: 1px solid transparent;
  }
  .nav-item:hover {
    background: var(--bg);
    color: var(--primary);
    border-color: var(--border);
  }
  .nav-item.active {
    background: var(--primary-light);
    color: var(--primary);
    font-weight: 600;
    border-color: rgba(64,67,87,0.25);
  }

  /* ── Main ── */
  .main {
    margin-left: 260px;
    padding: 40px 48px;
    min-width: 0;
    width: calc(100vw - 260px);
  }
  .header {
    margin-bottom: 36px;
    padding-bottom: 22px;
    border-bottom: 1px solid var(--border);
  }
  .header h1 {
    font-size: 26px;
    font-weight: 800;
    margin-bottom: 8px;
    color: var(--text);
    letter-spacing: -0.3px;
    background: none;
    -webkit-text-fill-color: unset;
  }
  .header p { color: var(--text2); font-size: 14px; }

  .section { display: none; animation: fadeIn 0.25s ease; }
  .section.active { display: block; }
  @keyframes fadeIn { from { opacity:0; transform:translateY(4px); } to { opacity:1; transform:none; } }

  .section-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 22px;
    color: var(--text);
    padding-bottom: 14px;
    border-bottom: 2px solid var(--border);
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .section-title::before {
    content: '';
    width: 4px; height: 22px;
    background: var(--primary);
    border-radius: 2px;
    flex-shrink: 0;
  }

  .subsection { margin-bottom: 34px; }
  .subsection-title {
    font-size: 15px;
    margin-bottom: 12px;
    color: var(--text);
    font-weight: 700;
  }
  .content-block {
    margin-bottom: 16px;
    color: var(--text2);
    line-height: 1.75;
    font-size: 14px;
  }
  .content-block strong { color: var(--text); }

  /* Code — dark for readability */
  pre {
    background: var(--code-bg);
    border: 1px solid var(--code-border);
    border-radius: 10px;
    padding: 20px;
    overflow-x: auto;
    margin: 16px 0;
    line-height: 1.55;
    font-size: 13px;
    font-family: 'JetBrains Mono','Fira Code','Monaco','Courier New',monospace;
  }
  code { font-family: 'JetBrains Mono','Fira Code','Monaco',monospace; }
  pre code { color: #ABB2BF; }  /* дефолтный цвет для операторов, скобок, ;, → */
  .keyword  { color: #82AAFF; font-weight:600; }
  .string   { color: #C3E88D; }
  .comment  { color: #637777; font-style:italic; }
  .variable { color: #F78C6C; }
  .function { color: #82AAFF; }
  .number   { color: #F78C6C; }

  /* Remember box */
  .remember-box {
    background: var(--primary-light);
    border-left: 4px solid var(--primary);
    padding: 14px 18px;
    margin: 20px 0;
    border-radius: 0 8px 8px 0;
    font-size: 13.5px;
    line-height: 1.65;
    color: var(--text);
  }
  .remember-box::before {
    content: '✎ Запомни:';
    font-weight: 700;
    color: #B45309;
    display: block;
    margin-bottom: 6px;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
  }

  /* Collapsible */
  .collapsible {
    background: var(--surface);
    color: var(--text);
    cursor: pointer;
    padding: 12px 16px;
    width: 100%;
    border: 1px solid var(--border);
    border-radius: 8px;
    text-align: left;
    outline: none;
    font-size: 13.5px;
    font-weight: 600;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.18s;
    margin-bottom: 8px;
    font-family: 'Inter',-apple-system,sans-serif;
  }
  .collapsible:hover { background: var(--bg); border-color: var(--primary); color: var(--primary); }
  .collapsible.active { background: var(--primary-light); border-color: var(--primary); color: var(--primary); }
  .toggle-icon { transition: transform 0.3s; font-size: 11px; }
  .collapsible.active .toggle-icon { transform: rotate(180deg); }
  .collapse-content {
    display: none;
    padding: 16px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-top: none;
    border-radius: 0 0 8px 8px;
    margin-bottom: 12px;
    color: var(--text2);
    font-size: 13.5px;
    line-height: 1.7;
  }
  .collapse-content.active { display: block; }

  /* Tables */
  table { width:100%; border-collapse:collapse; margin:16px 0; font-size:13px; }
  th, td { padding:11px 14px; text-align:left; border-bottom:1px solid var(--border); }
  th { background: var(--bg); color: var(--text); font-weight:700; font-size:11px; text-transform:uppercase; letter-spacing:0.5px; }
  tr:hover td { background: var(--bg); }

  /* Lists */
  ul { margin-left:20px; margin-top:10px; margin-bottom:14px; }
  li { margin-bottom:7px; color: var(--text2); font-size:13.5px; line-height:1.65; }
  li strong { color: var(--text); }

  .example-label {
    display:inline-block;
    background: var(--primary);
    color:#fff;
    padding:3px 10px;
    border-radius:5px;
    font-size:11px;
    font-weight:700;
    margin-bottom:10px;
  }
  .type-badge {
    display:inline-block;
    background: var(--primary-light);
    color: var(--primary);
    padding:2px 8px;
    border-radius:4px;
    font-size:11px;
    font-weight:700;
    margin-right:4px;
  }

  @media (max-width:768px) {
    .container { grid-template-columns:1fr; }
    .sidebar { position:static; width:100%; height:auto; border-right:none; border-bottom:1px solid var(--border); }
    .main { margin-left:0; padding:24px 18px; }
    .header h1 { font-size:20px; }
    .section-title { font-size:17px; }
  }

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
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <a class="sidebar-back" href="/"><i data-lucide="arrow-left"></i> На главную</a>
            <div class="sidebar-title">PHP Core</div>
            <a class="nav-item active" onclick="showSection('types')">Типы данных</a>
            <a class="nav-item" onclick="showSection('strings')">Строки</a>
            <a class="nav-item" onclick="showSection('arrays')">Массивы</a>
            <a class="nav-item" onclick="showSection('oop-basics')">ООП: Основы</a>
            <a class="nav-item" onclick="showSection('oop-abstract')">ООП: Абстрактные</a>
            <a class="nav-item" onclick="showSection('traits')">Traits</a>
            <a class="nav-item" onclick="showSection('magic')">Магические методы</a>
            <a class="nav-item" onclick="showSection('namespaces')">Namespaces</a>
            <a class="nav-item" onclick="showSection('errors')">Обработка ошибок</a>
            <a class="nav-item" onclick="showSection('php8')">PHP 8+ фичи</a>
            <a class="nav-item" onclick="showSection('generators')">Генераторы</a>
            <a class="nav-item" onclick="showSection('closures')">Closures</a>
        </div>

        <!-- Main Content -->
        <div class="main">
            <div class="header">
                <h1>PHP Core Knowledge Base</h1>
                <p>Comprehensive study guide for PHP backend developers preparing for interviews</p>
            </div>

            <!-- SECTION 1: ТИПЫ ДАННЫХ -->
            <div id="types" class="section active">
                <h2 class="section-title">1. Типы данных PHP</h2>

                <div class="subsection">
                    <h3 class="subsection-title">Основные типы (Basic Types)</h3>
                    <div class="content-block">
                        В PHP существует 8 основных типов данных. Каждый тип имеет свои особенности и правила преобразования.
                    </div>
                    <table>
                        <tr>
                            <th>Тип</th>
                            <th>Описание</th>
                            <th>Примеры</th>
                        </tr>
                        <tr>
                            <td><span class="type-badge">int</span></td>
                            <td>Целое число (64-bit на современных системах)</td>
                            <td>42, -100, 0x1A</td>
                        </tr>
                        <tr>
                            <td><span class="type-badge">float</span></td>
                            <td>Число с плавающей точкой (double)</td>
                            <td>3.14, 1.2e-3</td>
                        </tr>
                        <tr>
                            <td><span class="type-badge">string</span></td>
                            <td>Строка символов</td>
                            <td>"Hello", 'World'</td>
                        </tr>
                        <tr>
                            <td><span class="type-badge">bool</span></td>
                            <td>true или false</td>
                            <td>true, false</td>
                        </tr>
                        <tr>
                            <td><span class="type-badge">array</span></td>
                            <td>Коллекция элементов с ключами</td>
                            <td>[1, 2, 3], ['a' => 1]</td>
                        </tr>
                        <tr>
                            <td><span class="type-badge">object</span></td>
                            <td>Экземпляр класса</td>
                            <td>new User()</td>
                        </tr>
                        <tr>
                            <td><span class="type-badge">null</span></td>
                            <td>Отсутствие значения</td>
                            <td>null</td>
                        </tr>
                        <tr>
                            <td><span class="type-badge">resource</span></td>
                            <td>Ссылка на внешний ресурс</td>
                            <td>файлы, БД соединения</td>
                        </tr>
                    </table>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Type Juggling и Type Casting</h3>
                    <div class="content-block">
                        PHP &mdash; язык с динамической типизацией: тип переменной определяется значением, а не объявлением. Преобразования типов происходят двумя путями. <strong>Type Juggling</strong> &mdash; PHP сам конвертирует типы &laquo;на лету&raquo; (при арифметике, сравнении, логических операциях). <strong>Type Casting</strong> &mdash; разработчик явно указывает целевой тип через <code>(тип)$value</code>. Различие в инициаторе и контроле: juggling непредсказуем в сложных выражениях, casting даёт полный контроль.
                    </div>

                    <div class="example-label">Type Juggling в арифметике</div>
                    <pre><code><span class="comment">// Строка + число — строка превращается в число</span>
<span class="keyword">echo</span> <span class="string">"5"</span> + <span class="number">3</span>;          <span class="comment">// 8 (string "5" → int 5)</span>

<span class="comment">// Ведущие цифры строки превращаются в число, остальное отбрасывается</span>
<span class="keyword">echo</span> <span class="string">"10 apples"</span> + <span class="number">5</span>;  <span class="comment">// 15</span>

<span class="comment">// Нечисловая строка превращается в 0</span>
<span class="keyword">echo</span> <span class="string">"hello"</span> + <span class="number">5</span>;      <span class="comment">// 5 ("hello" → 0)</span>

<span class="comment">// Оператор конкатенации (точка) — наоборот, число становится строкой</span>
<span class="keyword">echo</span> <span class="number">5</span> . <span class="string">" apples"</span>;     <span class="comment">// "5 apples"</span></code></pre>

                    <div class="example-label">Type Juggling в сравнениях (скрытые баги)</div>
                    <pre><code><span class="function">var_dump</span>(<span class="string">"10"</span> == <span class="number">10</span>);    <span class="comment">// true  (juggling: строка → число)</span>
<span class="function">var_dump</span>(<span class="string">"10"</span> === <span class="number">10</span>);   <span class="comment">// false (строгое сравнение, типы разные)</span>

<span class="function">var_dump</span>(<span class="string">""</span> == <span class="number">0</span>);        <span class="comment">// true  (пустая строка → 0)</span>
<span class="function">var_dump</span>(<span class="string">"abc"</span> == <span class="number">0</span>);     <span class="comment">// true  (нечисловая строка → 0) — до PHP 8.0</span>
<span class="function">var_dump</span>(<span class="string">"1abc"</span> == <span class="number">1</span>);    <span class="comment">// true  ("1abc" → 1)</span>

<span class="comment">// PHP 8.0+ изменил поведение для строк, не содержащих чисел:</span>
<span class="comment">// "abc" == 0 теперь false (сравнение идёт как строки)</span></code></pre>

                    <div class="content-block">
                        <strong>Правило:</strong> для надёжности сравнения используйте <code>===</code> и <code>!==</code> &mdash; они проверяют и тип, и значение. Это особенно критично при работе с данными из форм, JSON, БД, где тип может приходить неожиданным.
                    </div>

                    <div class="content-block">
                        <strong>Синтаксис оператора приведения типа.</strong> Конструкция <code>(int)</code>, <code>(float)</code>, <code>(bool)</code> — это <em>встроенный оператор</em> языка, не функция. Общая форма: <code>(тип) выражение</code>. Скобки обязательны: они отделяют имя типа от остального кода. PHP вычисляет выражение справа и приводит результат к указанному типу. В отличие от функции, оператор не имеет вызывающих скобок вокруг аргумента: <code>(int)$x</code> работает, <code>(int)($x)</code> — тоже, но скобки вокруг x — это просто группировка выражения, не часть синтаксиса оператора. Доступные операторы: <code>(int)</code>/<code>(integer)</code>, <code>(float)</code>/<code>(double)</code>, <code>(string)</code>, <code>(bool)</code>/<code>(boolean)</code>, <code>(array)</code>, <code>(object)</code>, <code>(unset)</code> (deprecated с PHP 7.2).
                    </div>

                    <div class="example-label">Type Casting — явное приведение</div>
                    <pre><code><span class="comment">// (int) — отбрасывает дробную часть, не округляет</span>
<span class="variable">$int</span> = (<span class="keyword">int</span>)<span class="string">"42.99"</span>;     <span class="comment">// 42</span>
<span class="variable">$int</span> = (<span class="keyword">int</span>)<span class="string">"123hello"</span>;   <span class="comment">// 123</span>
<span class="variable">$int</span> = (<span class="keyword">int</span>)<span class="keyword">true</span>;          <span class="comment">// 1</span>

<span class="comment">// (float) — целое становится дробью</span>
<span class="variable">$float</span> = (<span class="keyword">float</span>)<span class="string">"3.14"</span>;  <span class="comment">// 3.14</span>
<span class="variable">$float</span> = (<span class="keyword">float</span>)<span class="string">"5"</span>;     <span class="comment">// 5.0</span>

<span class="comment">// (bool) — falsy значения: 0, "", "0", [], null</span>
<span class="variable">$bool</span> = (<span class="keyword">bool</span>)<span class="number">0</span>;          <span class="comment">// false</span>
<span class="variable">$bool</span> = (<span class="keyword">bool</span>)<span class="string">""</span>;         <span class="comment">// false</span>
<span class="variable">$bool</span> = (<span class="keyword">bool</span>)<span class="string">"0"</span>;        <span class="comment">// false (важная ловушка!)</span>
<span class="variable">$bool</span> = (<span class="keyword">bool</span>)[];          <span class="comment">// false</span>
<span class="variable">$bool</span> = (<span class="keyword">bool</span>)<span class="string">"hello"</span>;    <span class="comment">// true</span>
<span class="variable">$bool</span> = (<span class="keyword">bool</span>)<span class="string">"false"</span>;    <span class="comment">// true (любая непустая строка кроме "0")</span>

<span class="comment">// (string)</span>
<span class="variable">$string</span> = (<span class="keyword">string</span>)<span class="number">123</span>;     <span class="comment">// "123"</span>
<span class="variable">$string</span> = (<span class="keyword">string</span>)<span class="keyword">true</span>;    <span class="comment">// "1"</span>
<span class="variable">$string</span> = (<span class="keyword">string</span>)<span class="keyword">false</span>;   <span class="comment">// ""  (пустая строка, не "false"!)</span>
<span class="variable">$string</span> = (<span class="keyword">string</span>)<span class="keyword">null</span>;    <span class="comment">// ""</span>

<span class="comment">// (array)</span>
<span class="variable">$array</span> = (<span class="keyword">array</span>)<span class="number">42</span>;        <span class="comment">// [42] — скаляр становится массивом с одним элементом</span>
<span class="variable">$array</span> = (<span class="keyword">array</span>)<span class="variable">$object</span>;   <span class="comment">// свойства объекта → элементы массива</span>

<span class="comment">// (object)</span>
<span class="variable">$obj</span> = (<span class="keyword">object</span>)[<span class="string">"a"</span> =&gt; <span class="number">1</span>, <span class="string">"b"</span> =&gt; <span class="number">2</span>];
<span class="comment">// stdClass с $obj-&gt;a = 1, $obj-&gt;b = 2</span></code></pre>

                    <div class="content-block">
                        <strong>Объект → массив: правила видимости свойств.</strong> При <code>(array)$object</code> ключами становятся имена свойств, значениями — их значения. Но видимость (public/protected/private) меняет формат ключа: PHP добавляет служебные null-байты для скрытия инкапсуляции.
                    </div>

                    <div class="example-label">(array)$object с разной видимостью</div>
                    <pre><code><span class="comment">// 1. Public — обычные ключи</span>
<span class="variable">$obj</span> = <span class="keyword">new</span> <span class="keyword">stdClass</span>();
<span class="variable">$obj</span>-&gt;<span class="variable">name</span> = <span class="string">"Alice"</span>;
<span class="variable">$obj</span>-&gt;<span class="variable">age</span>  = <span class="number">30</span>;
<span class="variable">$array</span> = (<span class="keyword">array</span>)<span class="variable">$obj</span>;
<span class="comment">// [ "name" =&gt; "Alice", "age" =&gt; 30 ]</span>


<span class="comment">// 2. Protected — ключ "\0*\0имя"  (null-байт + звёздочка + null-байт)</span>
<span class="keyword">class</span> <span class="keyword">User</span> {
    <span class="keyword">protected</span> <span class="variable">$id</span>   = <span class="number">123</span>;
    <span class="keyword">public</span>    <span class="variable">$name</span> = <span class="string">"Bob"</span>;
}
<span class="variable">$array</span> = (<span class="keyword">array</span>)<span class="keyword">new</span> <span class="keyword">User</span>();
<span class="comment">// [ "\0*\0id" =&gt; 123, "name" =&gt; "Bob" ]</span>


<span class="comment">// 3. Private — ключ "\0ИмяКласса\0имя"  (null-байт + имя класса + null-байт)</span>
<span class="keyword">class</span> <span class="keyword">Person</span> {
    <span class="keyword">private</span> <span class="variable">$ssn</span>  = <span class="string">"123-45-6789"</span>;
    <span class="keyword">public</span>  <span class="variable">$city</span> = <span class="string">"London"</span>;
}
<span class="variable">$array</span> = (<span class="keyword">array</span>)<span class="keyword">new</span> <span class="keyword">Person</span>();
<span class="comment">// [ "\0Person\0ssn" =&gt; "123-45-6789", "city" =&gt; "London" ]


// 4. Пустой объект → пустой массив</span>
<span class="variable">$array</span> = (<span class="keyword">array</span>)<span class="keyword">new</span> <span class="keyword">stdClass</span>(); <span class="comment">// []


// 5. Что НЕ попадает:
//   - методы объекта (только данные)
//   - статические свойства (принадлежат классу, не экземпляру)
//   - константы класса</span></code></pre>

                    <div class="example-label">Сводная таблица форматирования ключей</div>
                    <pre><code><span class="comment">+------------------+-------------------------+
| Видимость        | Формат ключа в массиве  |
+------------------+-------------------------+
| public           | "имя"                   |
| protected        | "\0*\0имя"              |
| private          | "\0ИмяКласса\0имя"      |
+------------------+-------------------------+

// \0 — это NULL-байт (ASCII 0), непечатный символ.
// var_dump покажет его как \0, print_r — как пустоту.
// Обращение через $array["\0*\0id"] технически работает,
// но нарушает инкапсуляцию — не используйте в нормальном коде.</span></code></pre>

                    <div class="remember-box">
                        Для безопасной сериализации объектов в массив используйте <strong>геттеры</strong>, <strong>Reflection API</strong>, либо <strong><code>get_object_vars()</code></strong> (вернёт только видимые из текущей области свойства, без null-байтов). Прямое <code>(array)</code> подходит только для <code>stdClass</code> или внутри тех же классов.
                    </div>

                    <div class="example-label">__toString для объектов</div>
                    <pre><code><span class="comment">// (string) на объект сработает только если в классе есть __toString()</span>
<span class="keyword">class</span> <span class="keyword">User</span> {
    <span class="keyword">public string</span> <span class="variable">$name</span> = <span class="string">'unknown'</span>;

    <span class="keyword">public function</span> <span class="function">__toString</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="variable">$this</span>-&gt;<span class="variable">name</span>;
    }
}

<span class="variable">$user</span> = <span class="keyword">new</span> <span class="keyword">User</span>();
<span class="keyword">echo</span> (<span class="keyword">string</span>)<span class="variable">$user</span>;     <span class="comment">// "unknown"</span>
<span class="keyword">echo</span> <span class="string">"Hello, {$user}"</span>; <span class="comment">// "Hello, unknown" — тоже использует __toString</span>

<span class="comment">// Без __toString — Error: Object of class User could not be converted to string</span></code></pre>

                    <div class="example-label">Сравнение подходов</div>
                    <pre><code><span class="comment">+----------------+--------------------------+--------------------------+</span>
<span class="comment">| Характеристика | Type Juggling            | Type Casting             |</span>
<span class="comment">+----------------+--------------------------+--------------------------+</span>
<span class="comment">| Инициатор      | PHP автоматически        | Разработчик явно         |</span>
<span class="comment">| Контроль       | Низкий, скрытые правила  | Полный                   |</span>
<span class="comment">| Безопасность   | Маскирует ошибки         | Видно что происходит     |</span>
<span class="comment">|                | "abc" + 2 → 2            |                          |</span>
<span class="comment">| Применимость   | Простые скрипты, формы   | Валидация, бизнес-логика |</span>
<span class="comment">| Рекомендация   | Избегать в продакшене    | Использовать всегда      |</span>
<span class="comment">+----------------+--------------------------+--------------------------+</span></code></pre>

                    <div class="example-label">Подводные камни</div>
                    <pre><code><span class="comment">// 1. Числовая строка с "мусором" — PHP молча берёт цифры</span>
<span class="variable">$value</span> = <span class="string">"12.34 руб."</span>;
<span class="keyword">echo</span> <span class="variable">$value</span> + <span class="number">10</span>;  <span class="comment">// 22.34 — работает, но непредсказуемо для других строк</span>

<span class="comment">// 2. Строка "0" — единственная непустая falsy-строка</span>
<span class="keyword">if</span> (<span class="string">"0"</span>) { <span class="comment">/* НЕ выполнится */</span> }
<span class="keyword">if</span> (<span class="string">"false"</span>) { <span class="comment">/* выполнится (любая другая строка — truthy) */</span> }

<span class="comment">// 3. Логические операции с небулевыми значениями</span>
<span class="function">var_dump</span>(<span class="string">"a"</span> &amp;&amp; <span class="string">"b"</span>);  <span class="comment">// true (обе truthy)</span>
<span class="function">var_dump</span>(<span class="string">"0"</span> &amp;&amp; <span class="string">"b"</span>);  <span class="comment">// false ("0" → false)</span>

<span class="comment">// 4. (int) от float с погрешностью</span>
<span class="keyword">echo</span> (<span class="keyword">int</span>)((<span class="number">0.1</span> + <span class="number">0.7</span>) * <span class="number">10</span>);  <span class="comment">// 7, а не 8! (0.1 + 0.7 = 0.7999...)</span>

<span class="comment">// 5. Массив в bool — пустой массив false, любой непустой true</span>
<span class="function">var_dump</span>((<span class="keyword">bool</span>)[<span class="number">0</span>]);  <span class="comment">// true (массив непуст, хотя элемент 0)</span>

<span class="comment">// 6. NULL в сравнениях</span>
<span class="function">var_dump</span>(<span class="keyword">null</span> == <span class="keyword">false</span>);  <span class="comment">// true</span>
<span class="function">var_dump</span>(<span class="keyword">null</span> === <span class="keyword">false</span>); <span class="comment">// false</span>
<span class="function">var_dump</span>(<span class="keyword">null</span> == <span class="number">0</span>);      <span class="comment">// true</span>
<span class="function">var_dump</span>(<span class="keyword">null</span> == <span class="string">""</span>);     <span class="comment">// true</span></code></pre>

                    <div class="example-label">Безопасные альтернативы автопреобразованию</div>
                    <pre><code><span class="comment">// ❌ Опасно — полагаемся на juggling</span>
<span class="keyword">function</span> <span class="function">calculate</span>(<span class="variable">$amount</span>, <span class="variable">$quantity</span>) {
    <span class="keyword">return</span> <span class="variable">$amount</span> * <span class="variable">$quantity</span>;  <span class="comment">// "abc" * "2" = 0</span>
}

<span class="comment">// ✓ Безопасно — явная проверка типов</span>
<span class="keyword">function</span> <span class="function">calculate</span>(<span class="variable">$amount</span>, <span class="variable">$quantity</span>): <span class="keyword">float</span> {
    <span class="keyword">if</span> (!<span class="function">is_numeric</span>(<span class="variable">$amount</span>) || !<span class="function">is_numeric</span>(<span class="variable">$quantity</span>)) {
        <span class="keyword">throw</span> <span class="keyword">new</span> <span class="keyword">InvalidArgumentException</span>(<span class="string">'Numeric expected'</span>);
    }
    <span class="keyword">return</span> (<span class="keyword">float</span>)<span class="variable">$amount</span> * (<span class="keyword">int</span>)<span class="variable">$quantity</span>;
}

<span class="comment">// ✓ Безопасные парсеры строк → числа</span>
<span class="variable">$int</span>   = <span class="function">intval</span>(<span class="variable">$str</span>, <span class="number">10</span>);   <span class="comment">// явное основание 10 — защита от "077" → 7 (octal)</span>
<span class="variable">$float</span> = <span class="function">floatval</span>(<span class="variable">$str</span>);
<span class="variable">$value</span> = <span class="function">filter_var</span>(<span class="variable">$str</span>, <span class="keyword">FILTER_VALIDATE_INT</span>);   <span class="comment">// вернёт false если не int</span>
<span class="variable">$value</span> = <span class="function">filter_var</span>(<span class="variable">$str</span>, <span class="keyword">FILTER_VALIDATE_FLOAT</span>); <span class="comment">// вернёт false если не float</span></code></pre>

                    <div class="remember-box">
                        <strong>Шесть правил безопасной работы с типами:</strong><br>
                        1. Используйте <code>===</code> / <code>!==</code> вместо <code>==</code> / <code>!=</code> &mdash; всегда.<br>
                        2. Приводите типы явно через <code>(int)</code>, <code>(float)</code>, не надейтесь на juggling.<br>
                        3. Проверяйте тип перед операцией: <code>is_numeric()</code>, <code>is_string()</code>, <code>is_array()</code>.<br>
                        4. Для парсинга чисел из строк используйте <code>filter_var($v, FILTER_VALIDATE_INT)</code>.<br>
                        5. Включите <code>declare(strict_types=1);</code> в начале каждого файла (см. следующую подсекцию).<br>
                        6. Помните про <code>__toString()</code>: <code>(string)$object</code> упадёт, если метод не определён.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Операторы сравнения и присваивания (=, ==, ===, !=, !==)</h3>
                    <div class="content-block">
                        Пять операторов, которые часто путают и которые &mdash; источник скрытых багов в PHP. Один из них (<code>=</code>) вообще не сравнение, остальные различаются в том, приводит ли PHP типы перед сравнением. Правильный выбор между ними определяет, сработает ли ваше условие так, как вы думаете.
                    </div>

                    <div class="example-label">1. <code>=</code> — присваивание (assignment)</div>
                    <pre><code><span class="comment">// Действие, не сравнение: кладёт значение справа в переменную слева</span>
<span class="variable">$x</span> = <span class="number">5</span>;             <span class="comment">// $x теперь равно 5</span>

<span class="comment">// Возвращаемое значение присваивания = присвоенное значение</span>
<span class="keyword">if</span> (<span class="variable">$x</span> = <span class="number">10</span>) {     <span class="comment">// ОПАСНО! Присваивает 10, не сравнивает.</span>
                    <span class="comment">// Условие всегда true (10 — truthy).</span>
                    <span class="comment">// Большинство IDE/линтеров подсветят это как warning.</span>
}</code></pre>

                    <div class="content-block">
                        Использовать <code>=</code> внутри условий допустимо только осознанно (например, для inline-присваивания: <code>while (($row = $stmt-&gt;fetch()) !== false) { ... }</code>). Обычная ошибка &mdash; написать <code>=</code> вместо <code>==</code>/<code>===</code>.
                    </div>

                    <div class="example-label">2. <code>==</code> — нестрогое равенство</div>
                    <pre><code><span class="comment">// Сравнивает значения после приведения типов (type juggling)</span>
<span class="function">var_dump</span>(<span class="number">5</span>   == <span class="string">"5"</span>);          <span class="comment">// true  (строка "5" → число 5)</span>
<span class="function">var_dump</span>(<span class="number">5</span>   == <span class="string">"6"</span>);          <span class="comment">// false ("6" → 6, 5 != 6)</span>
<span class="function">var_dump</span>(<span class="number">0</span>   == <span class="keyword">false</span>);        <span class="comment">// true  (false → 0)</span>
<span class="function">var_dump</span>(<span class="string">""</span>  == <span class="number">0</span>);            <span class="comment">// true  (пустая строка → 0)</span>
<span class="function">var_dump</span>(<span class="string">"abc"</span> == <span class="number">0</span>);         <span class="comment">// до PHP 8.0: true; с 8.0+: false</span>
<span class="function">var_dump</span>(<span class="number">42</span>  == <span class="string">"42 apples"</span>);   <span class="comment">// true  ("42 apples" → 42)</span></code></pre>

                    <div class="example-label">3. <code>===</code> — строгое равенство (рекомендуется по умолчанию)</div>
                    <pre><code><span class="comment">// Сравнивает И значение, И тип — без приведения</span>
<span class="function">var_dump</span>(<span class="number">5</span>    === <span class="string">"5"</span>);          <span class="comment">// false (int vs string)</span>
<span class="function">var_dump</span>(<span class="number">5</span>    === <span class="number">5</span>);            <span class="comment">// true</span>
<span class="function">var_dump</span>(<span class="number">0</span>    === <span class="keyword">false</span>);        <span class="comment">// false (int vs bool)</span>
<span class="function">var_dump</span>(<span class="keyword">null</span> === <span class="keyword">null</span>);         <span class="comment">// true</span>
<span class="function">var_dump</span>(<span class="keyword">null</span> === <span class="keyword">false</span>);        <span class="comment">// false (null vs bool)</span></code></pre>

                    <div class="example-label">4. <code>!=</code> и <code>&lt;&gt;</code> — нестрогое неравенство</div>
                    <pre><code><span class="comment">// Противоположность == — true, если значения НЕ равны после приведения</span>
<span class="function">var_dump</span>(<span class="number">5</span> != <span class="string">"5"</span>);              <span class="comment">// false (равны после juggling)</span>
<span class="function">var_dump</span>(<span class="number">5</span> != <span class="string">"6"</span>);              <span class="comment">// true</span>
<span class="function">var_dump</span>(<span class="number">0</span> != <span class="keyword">false</span>);            <span class="comment">// false (равны)</span>
<span class="function">var_dump</span>(<span class="number">0</span> != <span class="string">"abc"</span>);            <span class="comment">// до PHP 8.0: false; с 8.0+: true</span>

<span class="comment">// &lt;&gt; — синоним != (тот же оператор)</span>
<span class="function">var_dump</span>(<span class="number">5</span> &lt;&gt; <span class="string">"5"</span>);              <span class="comment">// false</span></code></pre>

                    <div class="example-label">5. <code>!==</code> — строгое неравенство</div>
                    <pre><code><span class="comment">// Противоположность === — true, если значения ИЛИ типы различаются</span>
<span class="function">var_dump</span>(<span class="number">5</span>    !== <span class="string">"5"</span>);          <span class="comment">// true  (разные типы)</span>
<span class="function">var_dump</span>(<span class="number">5</span>    !== <span class="number">5</span>);            <span class="comment">// false</span>
<span class="function">var_dump</span>(<span class="number">0</span>    !== <span class="keyword">false</span>);        <span class="comment">// true  (int vs bool)</span>
<span class="function">var_dump</span>(<span class="keyword">null</span> !== <span class="keyword">null</span>);         <span class="comment">// false</span></code></pre>

                    <div class="example-label">Сводная таблица</div>
                    <pre><code><span class="comment">+-----------+---------------------+------------------+--------------------+
| Оператор  | Название            | Приводит типы?   | Пример: 5 op "5"   |
+-----------+---------------------+------------------+--------------------+
| =         | Присваивание        | N/A (не сравн.)  | присвоит "5"       |
| ==        | Нестрогое равенство | да (juggling)    | true               |
| ===       | Строгое равенство   | нет              | false              |
| != / &lt;&gt;   | Нестрогое неравен.  | да (juggling)    | false              |
| !==       | Строгое неравенство | нет              | true               |
+-----------+---------------------+------------------+--------------------+</span></code></pre>

                    <div class="example-label">Частые ловушки</div>
                    <pre><code><span class="comment">// 1. Пропущенный знак в условии</span>
<span class="keyword">if</span> (<span class="variable">$x</span> = <span class="number">5</span>) { ... }       <span class="comment">// присваивание (всегда true)</span>
<span class="keyword">if</span> (<span class="variable">$x</span> == <span class="number">5</span>) { ... }      <span class="comment">// нестрогое сравнение</span>
<span class="keyword">if</span> (<span class="variable">$x</span> === <span class="number">5</span>) { ... }     <span class="comment">// строгое (правильно)</span>

<span class="comment">// 2. Сравнение со строкой через ==</span>
<span class="keyword">if</span> (<span class="variable">$str</span> == <span class="number">0</span>) { ... }
<span class="comment">// сработает для "", "abc", "0" и null — почти наверняка не то, что нужно</span>
<span class="keyword">if</span> (<span class="variable">$str</span> === <span class="string">"0"</span>) { ... }
<span class="comment">// только для конкретной строки "0"</span>

<span class="comment">// 3. Возврат функции false vs 0 vs ""</span>
<span class="variable">$result</span> = <span class="function">strpos</span>(<span class="string">"hello"</span>, <span class="string">"h"</span>); <span class="comment">// 0 (позиция первого символа)</span>
<span class="keyword">if</span> (!<span class="variable">$result</span>) { ... }      <span class="comment">// СРАБОТАЕТ: 0 → false. Баг!</span>
<span class="keyword">if</span> (<span class="variable">$result</span> === <span class="keyword">false</span>) {  <span class="comment">// правильно — strpos вернёт false если не найдено</span>
}

<span class="comment">// 4. in_array без strict mode</span>
<span class="function">in_array</span>(<span class="number">0</span>, [<span class="string">"a"</span>, <span class="string">"b"</span>, <span class="string">"c"</span>]);          <span class="comment">// true в PHP &lt; 8.0 ("a" → 0)</span>
<span class="function">in_array</span>(<span class="number">0</span>, [<span class="string">"a"</span>, <span class="string">"b"</span>, <span class="string">"c"</span>], <span class="keyword">true</span>);    <span class="comment">// false (строгий режим)</span>

<span class="comment">// 5. NULL и пустые значения</span>
<span class="function">var_dump</span>(<span class="keyword">null</span> == <span class="keyword">false</span>);    <span class="comment">// true</span>
<span class="function">var_dump</span>(<span class="keyword">null</span> == <span class="number">0</span>);        <span class="comment">// true</span>
<span class="function">var_dump</span>(<span class="keyword">null</span> == <span class="string">""</span>);       <span class="comment">// true</span>
<span class="function">var_dump</span>(<span class="keyword">null</span> == <span class="string">"0"</span>);      <span class="comment">// false  (важно: "0" != null)</span></code></pre>

                    <div class="remember-box">
                        <strong>Короткое запоминание:</strong><br>
                        <code>=</code> &mdash; положить (присвоить).<br>
                        <code>==</code> &mdash; «похожи» после приведения типов.<br>
                        <code>===</code> &mdash; абсолютно идентичны (тип + значение).<br>
                        <code>!=</code> &mdash; «не похожи» после приведения.<br>
                        <code>!==</code> &mdash; не идентичны (либо тип, либо значение, либо оба).<br><br>
                        <strong>По умолчанию используйте <code>===</code> и <code>!==</code></strong>. Нестрогое сравнение оправдано только когда осознанно нужно приведение типов (например, сравнение пользовательского ввода с числом) &mdash; и даже тогда лучше явно: <code>(int)$input === 5</code>.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Compound операторы (+=, -=, *=, /=, %=, .=)</h3>
                    <div class="content-block">
                        Это <strong>составные операторы присваивания</strong> (compound assignment operators): сокращённая запись для «применить операцию и записать результат обратно в ту же переменную». Стандартный синтаксис в PHP, C, JavaScript, Python и большинстве С-подобных языков.
                    </div>

                    <div class="example-label">Все compound операторы PHP</div>
                    <pre><code><span class="comment">// Каждая пара эквивалентна:

// += (сложение / конкатенация чисел)</span>
<span class="variable">$x</span> = <span class="number">5</span>;
<span class="variable">$x</span> += <span class="number">3</span>;          <span class="comment">// эквивалент: $x = $x + 3 → $x теперь 8</span>

<span class="comment">// -= (вычитание)</span>
<span class="variable">$x</span> -= <span class="number">2</span>;          <span class="comment">// $x = $x - 2 → 6</span>

<span class="comment">// *= (умножение)</span>
<span class="variable">$x</span> *= <span class="number">10</span>;         <span class="comment">// $x = $x * 10 → 60</span>

<span class="comment">// /= (деление)</span>
<span class="variable">$x</span> /= <span class="number">4</span>;          <span class="comment">// $x = $x / 4 → 15</span>

<span class="comment">// %= (остаток от деления)</span>
<span class="variable">$x</span> %= <span class="number">7</span>;          <span class="comment">// $x = $x % 7 → 1  (15 % 7 = 1)</span>

<span class="comment">// **= (возведение в степень, PHP 5.6+)</span>
<span class="variable">$y</span> = <span class="number">2</span>;
<span class="variable">$y</span> **= <span class="number">3</span>;         <span class="comment">// $y = $y ** 3 → 8</span>

<span class="comment">// .= (конкатенация строк)</span>
<span class="variable">$s</span> = <span class="string">"Hello"</span>;
<span class="variable">$s</span> .= <span class="string">", World"</span>;  <span class="comment">// $s = $s . ", World" → "Hello, World"</span>

<span class="comment">// Битовые: &amp;=, |=, ^=, &lt;&lt;=, &gt;&gt;= — используются реже, в бизнес-логике почти не встречаются</span>
<span class="variable">$flags</span> = <span class="number">0b1010</span>;
<span class="variable">$flags</span> |= <span class="number">0b0001</span>;   <span class="comment">// побитовое ИЛИ → 0b1011</span>
<span class="variable">$flags</span> &amp;= <span class="number">0b1100</span>;   <span class="comment">// побитовое И → 0b1000</span></code></pre>

                    <div class="example-label">Где встречается чаще всего</div>
                    <pre><code><span class="comment">// 1. Аккумуляция суммы / счётчика</span>
<span class="variable">$total</span> = <span class="number">0</span>;
<span class="keyword">foreach</span> (<span class="variable">$orders</span> <span class="keyword">as</span> <span class="variable">$order</span>) {
    <span class="variable">$total</span> += <span class="variable">$order</span>[<span class="string">'amount'</span>];      <span class="comment">// прирост total на сумму заказа</span>
}

<span class="comment">// 2. Внутри array_reduce — изменение полей аккумулятора</span>
<span class="function">array_reduce</span>(<span class="variable">$items</span>, <span class="keyword">function</span>(<span class="variable">$carry</span>, <span class="variable">$item</span>) {
    <span class="variable">$carry</span>[<span class="string">'sum'</span>] += <span class="variable">$item</span>;
    <span class="variable">$carry</span>[<span class="string">'count'</span>]++;          <span class="comment">// ++ — это +=1 для целых</span>
    <span class="keyword">return</span> <span class="variable">$carry</span>;
}, [<span class="string">'sum'</span> => <span class="number">0</span>, <span class="string">'count'</span> => <span class="number">0</span>]);

<span class="comment">// 3. Построение строки по частям</span>
<span class="variable">$html</span> = <span class="string">''</span>;
<span class="keyword">foreach</span> (<span class="variable">$rows</span> <span class="keyword">as</span> <span class="variable">$row</span>) {
    <span class="variable">$html</span> .= <span class="string">"&lt;tr&gt;&lt;td&gt;{<span class="variable">$row</span>[<span class="string">'name'</span>]}&lt;/td&gt;&lt;/tr&gt;"</span>;
}

<span class="comment">// 4. Декремент через -=1 (то же что --)</span>
<span class="variable">$retries</span> = <span class="number">3</span>;
<span class="keyword">while</span> (<span class="variable">$retries</span> > <span class="number">0</span>) {
    <span class="comment">// ... попытка ...</span>
    <span class="variable">$retries</span> -= <span class="number">1</span>;        <span class="comment">// эквивалент: $retries-- или --$retries</span>
}</code></pre>

                    <div class="example-label">Сводная таблица</div>
                    <pre><code><span class="comment">+----------+---------------------------+-----------------------+
| Оператор | Эквивалент                | Применение            |
+----------+---------------------------+-----------------------+
| +=       | $a = $a + $b              | сумма, счётчик        |
| -=       | $a = $a - $b              | вычитание, декремент  |
| *=       | $a = $a * $b              | умножение             |
| /=       | $a = $a / $b              | деление               |
| %=       | $a = $a % $b              | остаток               |
| **=      | $a = $a ** $b             | степень (PHP 5.6+)    |
| .=       | $a = $a . $b              | конкатенация строк    |
| &amp;=       | $a = $a &amp; $b              | битовое И             |
| |=       | $a = $a | $b              | битовое ИЛИ           |
| ^=       | $a = $a ^ $b              | битовое XOR           |
| ??=      | $a = $a ?? $b             | null-coalescing (PHP 7.4+) |
+----------+---------------------------+-----------------------+</span></code></pre>

                    <div class="remember-box">
                        <strong>Особый случай: <code>??=</code></strong> (PHP 7.4+) &mdash; присваивает значение только если переменная сейчас null или не определена. Удобно для дефолтов: <code>$config['timeout'] ??= 30;</code> положит 30, только если ключ ещё не задан. Полезно при работе с массивами настроек.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">strict_types Декларация</h3>
                    <div class="content-block">
                        <strong>strict_types=1</strong> требует точное совпадение типов при передаче аргументов. Это должно быть первым оператором в файле!
                    </div>
                    <div class="example-label">Strict Types</div>
                    <pre><code><span class="keyword">declare</span>(<span class="string">strict_types</span>=<span class="number">1</span>);

<span class="keyword">function</span> <span class="function">processAge</span>(<span class="keyword">int</span> <span class="variable">$age</span>): <span class="keyword">string</span> {
    <span class="keyword">return</span> <span class="string">"Age: "</span> . <span class="variable">$age</span>;
}

<span class="comment">// С strict_types=1 это выбросит TypeError</span>
<span class="function">processAge</span>(<span class="string">"25"</span>);  <span class="comment">// ERROR! Требуется int, не string</span>

<span class="comment">// Нужно явно преобразовать</span>
<span class="function">processAge</span>((<span class="keyword">int</span>)<span class="string">"25"</span>);  <span class="comment">// OK</span></code></pre>

                    <div class="remember-box">
                        В Laravel и современных проектах ВСЕГДА используй declare(strict_types=1) для типобезопасности!
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Union Types и Nullable (PHP 8+)</h3>
                    <div class="content-block">
                        PHP 8+ позволяет указывать несколько возможных типов и явно маркировать nullable значения.
                    </div>
                    <div class="example-label">Union Types</div>
                    <pre><code><span class="keyword">declare</span>(<span class="string">strict_types</span>=<span class="number">1</span>);

<span class="comment">// Union Types - функция может принять int или string</span>
<span class="keyword">function</span> <span class="function">getUserId</span>(<span class="keyword">int</span>|<span class="keyword">string</span> <span class="variable">$id</span>): <span class="keyword">int</span> {
    <span class="keyword">if</span> (<span class="keyword">is_string</span>(<span class="variable">$id</span>)) {
        <span class="variable">$id</span> = (<span class="keyword">int</span>)<span class="variable">$id</span>;
    }
    <span class="keyword">return</span> <span class="variable">$id</span>;
}

<span class="comment">// Nullable типы</span>
<span class="keyword">function</span> <span class="function">findUser</span>(<span class="keyword">int</span> <span class="variable">$id</span>): ?<span class="keyword">User</span> {
    <span class="comment">// Может вернуть User или null</span>
    <span class="keyword">return</span> <span class="variable">$user</span> ?? <span class="keyword">null</span>;
}

<span class="comment">// Эквивалентно: User|null</span></code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Intersection Types (PHP 8.1+)</h3>
                    <div class="content-block">
                        Intersection типы требуют чтобы объект реализовал ВСЕ указанные интерфейсы.
                    </div>
                    <div class="example-label">Intersection Types</div>
                    <pre><code><span class="keyword">interface</span> <span class="function">Serializable</span> {}
<span class="keyword">interface</span> <span class="function">Countable</span> {}

<span class="comment">// Параметр должен реализовать ОБА интерфейса</span>
<span class="keyword">function</span> <span class="function">processCollection</span>(<span class="keyword">Serializable</span>&<span class="keyword">Countable</span> <span class="variable">$data</span>): <span class="keyword">void</span> {
    <span class="keyword">echo</span> <span class="function">count</span>(<span class="variable">$data</span>);
}</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Проверка типов</h3>
                    <div class="example-label">Функции проверки типов</div>
                    <pre><code><span class="function">is_int</span>(<span class="variable">$var</span>);        <span class="comment">// Целое число?</span>
<span class="function">is_float</span>(<span class="variable">$var</span>);      <span class="comment">// Число с плавающей точкой?</span>
<span class="function">is_string</span>(<span class="variable">$var</span>);     <span class="comment">// Строка?</span>
<span class="function">is_bool</span>(<span class="variable">$var</span>);      <span class="comment">// Boolean?</span>
<span class="function">is_array</span>(<span class="variable">$var</span>);     <span class="comment">// Массив?</span>
<span class="function">is_object</span>(<span class="variable">$var</span>);    <span class="comment">// Объект?</span>
<span class="function">is_null</span>(<span class="variable">$var</span>);     <span class="comment">// null?</span>
<span class="function">is_numeric</span>(<span class="variable">$var</span>);   <span class="comment">// Числовое значение или строка с числом?</span>
<span class="function">is_callable</span>(<span class="variable">$var</span>);  <span class="comment">// Можно вызвать как функцию?</span>
<span class="function">isset</span>(<span class="variable">$var</span>);      <span class="comment">// Переменная установлена и не null?</span>
<span class="function">empty</span>(<span class="variable">$var</span>);     <span class="comment">// Переменная пуста? (0, "", false, null)</span>
<span class="function">gettype</span>(<span class="variable">$var</span>);   <span class="comment">// Возвращает строку с типом</span></code></pre>

                    <div class="remember-box">
                        isset() возвращает false если переменной нет или она null. empty() также возвращает true для 0, "", false, null. Используй !isset() или ?? оператор для более точных проверок.
                    </div>
                </div>
            </div>

            <!-- SECTION 2: СТРОКИ -->
            <div id="strings" class="section">
                <h2 class="section-title">2. Строки</h2>

                <div class="subsection">
                    <h3 class="subsection-title">Синтаксис строк: Double vs Single Quote</h3>
                    <div class="example-label">Различия</div>
                    <pre><code><span class="comment">// Single quotes - буквальные строки, никакой интерпретации</span>
<span class="string">'Hello $name'</span>  <span class="comment">// Выведет: Hello $name</span>

<span class="comment">// Double quotes - интерпретирует переменные и экранирующие символы</span>
<span class="string">"Hello $name"</span>  <span class="comment">// Выведет: Hello John (если $name = 'John')</span>
<span class="string">"Line1\nLine2"</span>  <span class="comment">// Новая строка работает</span>

<span class="comment">// Heredoc - многострочная строка с интерпретацией</span>
<span class="variable">$text</span> = <<<EOT
Hello <span class="variable">$name</span>,
This is a multiline string.
EOT;

<span class="comment">// Nowdoc - многострочная строка БЕЗ интерпретации (как single quotes)</span>
<span class="variable">$text</span> = <<<'EOT'
Hello <span class="variable">$name</span>,
This is literal.
EOT;</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Строковая интерполяция (String Interpolation)</h3>
                    <div class="example-label">Способы интерполяции</div>
                    <pre><code><span class="variable">$name</span> = <span class="string">"Alice"</span>;
<span class="variable">$data</span> = [<span class="string">'age'</span> => <span class="number">30</span>];

<span class="comment">// Простая переменная</span>
<span class="string">"Hello $name"</span>

<span class="comment">// Через фигурные скобки для сложных выражений</span>
<span class="string">"Age: {$data['age']}"</span>  <span class="comment">// Правильно</span>
<span class="string">"Age: $data['age']"</span>    <span class="comment">// ОШИБКА - неправильная интерпретация</span>

<span class="comment">// Использование {} для явности</span>
<span class="string">"{$name}'s age is {$data['age']}"</span></code></pre>

                    <div class="remember-box">
                        Для доступа к элементам массива в строке используй {$array['key']}, иначе PHP не поймёт синтаксис!
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Heredoc и Nowdoc — многострочные строки</h3>
                    <div class="content-block">
                        Два способа создавать многострочные строки в PHP. Удобны, когда нужно написать большой текст с кавычками или переменными без конкатенации и экранирования. Различаются только одним: <strong>Heredoc интерпретирует переменные</strong> (ведёт себя как двойные кавычки), <strong>Nowdoc &mdash; нет</strong> (ведёт себя как одинарные).
                    </div>

                    <div class="example-label">Heredoc — с интерпретацией</div>
                    <pre><code><span class="comment">// Синтаксис: &lt;&lt;&lt;ИДЕНТИФИКАТОР (без пробелов после &lt;&lt;&lt;)</span>
<span class="variable">$name</span> = <span class="string">"Анна"</span>;
<span class="variable">$text</span> = &lt;&lt;&lt;EOT
Привет, <span class="variable">$name</span>!
Это многострочный текст.
Поддерживает переносы и "кавычки" без экранирования.
EOT;

<span class="keyword">echo</span> <span class="variable">$text</span>;
<span class="comment">// Вывод:
// Привет, Анна!
// Это многострочный текст.
// Поддерживает переносы и "кавычки" без экранирования.</span></code></pre>

                    <div class="example-label">Nowdoc — без интерпретации (литерально)</div>
                    <pre><code><span class="comment">// Синтаксис: &lt;&lt;&lt;'ИДЕНТИФИКАТОР' (в одинарных кавычках)</span>
<span class="variable">$name</span> = <span class="string">"Анна"</span>;
<span class="variable">$text</span> = &lt;&lt;&lt;<span class="string">'EOT'</span>
Привет, <span class="variable">$name</span>!
Здесь <span class="variable">$name</span> не заменится на "Анна".
\n и \t останутся как текст.
EOT;

<span class="keyword">echo</span> <span class="variable">$text</span>;
<span class="comment">// Вывод:
// Привет, $name!
// Здесь $name не заменится на "Анна".
// \n и \t останутся как текст.</span></code></pre>

                    <div class="example-label">Правила синтаксиса</div>
                    <pre><code><span class="comment">// ✓ Идентификатор: любой (EOT, HTML, SQL, JSON), любые буквы/цифры/подчёркивания,
//   не должен начинаться с цифры. Принято — UPPERCASE.

// ✓ Heredoc: без кавычек вокруг идентификатора</span>
<span class="variable">$x</span> = &lt;&lt;&lt;HTML
&lt;<span class="keyword">div</span>&gt;<span class="variable">$content</span>&lt;/<span class="keyword">div</span>&gt;
HTML;

<span class="comment">// ✓ Nowdoc: с одинарными кавычками</span>
<span class="variable">$x</span> = &lt;&lt;&lt;<span class="string">'HTML'</span>
&lt;<span class="keyword">div</span>&gt;<span class="variable">$content</span>&lt;/<span class="keyword">div</span>&gt;
HTML;

<span class="comment">// ❌ Распространённая ошибка — пробелы и переменная после &lt;&lt;&lt;</span>
<span class="variable">$x</span> = &lt;&lt; <span class="variable">$name</span>     <span class="comment">// SYNTAX ERROR — нужен идентификатор без пробела</span>
text
EOT;

<span class="comment">// PHP 7.3+ — закрывающий идентификатор может иметь отступ
// (отступ автоматически удалится из всех строк):</span>
<span class="variable">$x</span> = &lt;&lt;&lt;EOT
    Первая строка
    Вторая строка
    EOT;
<span class="comment">// Содержимое будет "Первая строка\nВторая строка" — без ведущих пробелов</span></code></pre>

                    <div class="example-label">Сравнительная таблица</div>
                    <pre><code><span class="comment">+--------------------------------+--------------+--------------+
| Особенность                    | Heredoc      | Nowdoc       |
+--------------------------------+--------------+--------------+
| Синтаксис открытия             | &lt;&lt;&lt;EOT       | &lt;&lt;&lt;'EOT'     |
| Интерпретация переменных       | да           | нет          |
| Escape-последовательности      | да (\n, \t)  | нет          |
| Аналог в обычных строках       | " "          | ' '          |
| Когда использовать             | шаблоны с    | литеральный  |
|                                | подстановкой | код, SQL,    |
|                                |              | regex        |
+--------------------------------+--------------+--------------+</span></code></pre>

                    <div class="example-label">Когда что использовать</div>
                    <pre><code><span class="comment">// 1. Heredoc для шаблонов с переменными — HTML, SQL с параметрами, письма</span>
<span class="variable">$body</span> = &lt;&lt;&lt;HTML
&lt;<span class="keyword">h1</span>&gt;Привет, <span class="variable">$userName</span>!&lt;/<span class="keyword">h1</span>&gt;
&lt;<span class="keyword">p</span>&gt;Ваш заказ #<span class="variable">$orderId</span> на сумму <span class="variable">$total</span> руб.&lt;/<span class="keyword">p</span>&gt;
HTML;

<span class="comment">// 2. Nowdoc для литерального текста — примеры кода, regex, тексты с $</span>
<span class="variable">$exampleCode</span> = &lt;&lt;&lt;<span class="string">'PHP'</span>
&lt;?php
<span class="variable">$user</span> = User::find(1);
<span class="keyword">echo</span> <span class="string">"Hello, <span class="variable">$user</span>->name!"</span>;
PHP;
<span class="comment">// Все $ останутся как есть, для документации/туториалов — идеально</span>

<span class="comment">// 3. SQL — обычно Heredoc с параметрами или Nowdoc для статичного запроса</span>
<span class="variable">$query</span> = &lt;&lt;&lt;<span class="string">'SQL'</span>
SELECT u.id, u.email
FROM users u
WHERE u.status = 'active'
  AND u.created_at &gt; '2024-01-01'
SQL;
<span class="comment">// Не нужно экранировать одинарные кавычки строки SQL!</span>

<span class="comment">// 4. JSON-шаблон</span>
<span class="variable">$json</span> = &lt;&lt;&lt;<span class="string">'JSON'</span>
{
  "name": "value",
  "nested": {"key": 123}
}
JSON;</code></pre>

                    <div class="example-label">Подводные камни</div>
                    <pre><code><span class="comment">// 1. Закрывающий идентификатор в начале строки (до PHP 7.3)
//    Любые пробелы или табы перед ним — Parse error
//    С 7.3+ — отступ разрешён, но автоматически удаляется</span>
<span class="variable">$x</span> = &lt;&lt;&lt;EOT
text
    EOT;   <span class="comment">// 7.2: SYNTAX ERROR; 7.3+: OK</span>

<span class="comment">// 2. После закрывающего идентификатора — только ; или ничего</span>
<span class="variable">$x</span> = &lt;&lt;&lt;EOT
text
EOT . <span class="string">"more"</span>;  <span class="comment">// ❌ SYNTAX ERROR в PHP &lt; 7.3</span>

<span class="variable">$x</span> = &lt;&lt;&lt;EOT
text
EOT;
<span class="variable">$x</span> .= <span class="string">"more"</span>;       <span class="comment">// ✓ — конкатенация после</span>

<span class="comment">// 3. Идентификатор содержится в тексте — закроется раньше времени</span>
<span class="variable">$x</span> = &lt;&lt;&lt;EOT
Сообщение содержит слово EOT внутри текста
EOT;
<span class="comment">// Текст оборвётся на первом EOT в начале строки.
// Решение: использовать уникальный идентификатор, не встречающийся в тексте.</span>

<span class="comment">// 4. Heredoc внутри функции/массива до PHP 7.3 требовал ; в конце</span>
<span class="variable">$arr</span> = [&lt;&lt;&lt;EOT
text
EOT
];  <span class="comment">// 7.2: SYNTAX ERROR; 7.3+: OK (трейлинг ; можно опустить)</span>

<span class="comment">// 5. $ в Nowdoc — не нужно экранировать (в отличие от Heredoc)</span>
<span class="variable">$h</span> = &lt;&lt;&lt;EOT
Цена: \<span class="variable">$100</span>   <span class="comment">// нужно экранировать $, иначе PHP попытается найти $100</span>
EOT;
<span class="variable">$n</span> = &lt;&lt;&lt;<span class="string">'EOT'</span>
Цена: <span class="variable">$100</span>     <span class="comment">// в Nowdoc — экранировать не нужно</span>
EOT;</code></pre>

                    <div class="remember-box">
                        <strong>Правило выбора:</strong> если в тексте <strong>есть переменные</strong> &mdash; <code>&lt;&lt;&lt;EOT</code> (Heredoc). Если текст &mdash; <strong>литеральный код, regex, пример с $</strong> &mdash; <code>&lt;&lt;&lt;'EOT'</code> (Nowdoc). Идентификатор &mdash; UPPERCASE, уникальный для содержимого (HTML, SQL, JSON, EOT). С PHP 7.3+ закрывающий маркер можно делать с отступом &mdash; используйте это для читаемости в методах классов.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">PHP 8+ Функции строк</h3>
                    <div class="content-block">
                        PHP 8 добавил удобные функции для работы со строками вместо preg_match.
                    </div>
                    <div class="example-label">str_contains, str_starts_with, str_ends_with</div>
                    <pre><code><span class="comment">// Проверить содержит ли строка подстроку</span>
<span class="function">str_contains</span>(<span class="string">"Hello World"</span>, <span class="string">"World"</span>);  <span class="comment">// true</span>

<span class="comment">// Проверить начало строки</span>
<span class="function">str_starts_with</span>(<span class="string">"https://example.com"</span>, <span class="string">"https"</span>);  <span class="comment">// true</span>

<span class="comment">// Проверить конец строки</span>
<span class="function">str_ends_with</span>(<span class="string">"file.pdf"</span>, <span class="string">".pdf"</span>);  <span class="comment">// true</span>

<span class="comment">// Практический пример - валидация URL в Laravel контроллере</span>
<span class="keyword">if</span> (!<span class="function">str_starts_with</span>(<span class="variable">$url</span>, <span class="string">"https://"</span>)) {
    <span class="keyword">return</span> <span class="function">response</span>()-><span class="function">json</span>([<span class="string">'error'</span> => <span class="string">'Invalid URL'</span>]);
}</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Многобайтовые строки (mb_string)</h3>
                    <div class="content-block">
                        Для работы с Unicode и не-ASCII символами используй mb_string функции вместо обычных str функций.
                    </div>
                    <div class="example-label">mb_string функции</div>
                    <pre><code><span class="variable">$text</span> = <span class="string">"Привет мир"</span>;

<span class="comment">// Обычные функции работают с БАЙТАМИ, не с символами!</span>
<span class="function">strlen</span>(<span class="string">"Привет"</span>);      <span class="comment">// 12 (3 байта на каждый кириллический символ)</span>

<span class="comment">// mb функции работают с СИМВОЛАМИ</span>
<span class="function">mb_strlen</span>(<span class="string">"Привет"</span>);     <span class="comment">// 6 (6 символов, UTF-8)</span>
<span class="function">mb_substr</span>(<span class="variable">$text</span>, <span class="number">0</span>, <span class="number">3</span>);   <span class="comment">// "При" (3 символа, не байта)</span>
<span class="function">mb_strtoupper</span>(<span class="variable">$text</span>);     <span class="comment">// "ПРИВЕТ МИР"</span>
<span class="function">mb_strtolower</span>(<span class="variable">$text</span>);     <span class="comment">// "привет мир"</span>
<span class="function">mb_convert_case</span>(<span class="variable">$text</span>, <span class="keyword">MB_CASE_TITLE</span>);  <span class="comment">// Первая буква заглавная</span></code></pre>

                    <div class="remember-box">
                        ВСЕГДА используй mb_* функции при работе с пользовательским вводом, особенно если это может быть не-ASCII! Это критично для интернациональных приложений.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Регулярные выражения (Regex)</h3>
                    <div class="example-label">preg_match и preg_replace</div>
                    <pre><code><span class="comment">// preg_match - найти первое совпадение</span>
<span class="keyword">if</span> (<span class="function">preg_match</span>(<span class="string">'/<span class="function">^\d</span>{3}-<span class="function">\d</span>{3}-<span class="function">\d</span>{4}$/'</span>, <span class="variable">$phone</span>)) {
    <span class="comment">// Телефон в формате XXX-XXX-XXXX</span>
}

<span class="comment">// preg_match с захватывающими группами</span>
<span class="function">preg_match</span>(<span class="string">'/(\w+)@(\w+\.\w+)/'</span>, <span class="string">"test@example.com"</span>, <span class="variable">$matches</span>);
<span class="comment">// $matches[0] = "test@example.com" (полное совпадение)</span>
<span class="comment">// $matches[1] = "test" (первая группа)</span>
<span class="comment">// $matches[2] = "example.com" (вторая группа)</span>

<span class="comment">// preg_match_all - найти ВСЕ совпадения</span>
<span class="function">preg_match_all</span>(<span class="string">'/\d+/'</span>, <span class="string">"1 2 3 4 5"</span>, <span class="variable">$numbers</span>);
<span class="comment">// $numbers[0] = ["1", "2", "3", "4", "5"]</span>

<span class="comment">// preg_replace - замена по паттерну</span>
<span class="variable">$clean</span> = <span class="function">preg_replace</span>(<span class="string">'/[^a-zA-Z0-9]/'</span>, <span class="string">''</span>, <span class="variable">$input</span>);
<span class="comment">// Удаляет все символы кроме букв и цифр</span>

<span class="comment">// Практический пример - валидация email в Laravel</span>
<span class="keyword">if</span> (!<span class="function">preg_match</span>(<span class="string">'/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'</span>, <span class="variable">$email</span>)) {
    <span class="comment">// Некорректный email</span>
}</code></pre>

                    <div class="content-block">
                        <strong>Разбор регулярки для email по символам.</strong> Регулярное выражение <code>/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/</code> проверяет, похож ли текст в переменной <code>$email</code> на стандартный email-адрес вида <code>username@domain.zone</code>. Проверяет только формат, не существование ящика на сервере.
                    </div>

                    <div class="example-label">Что значит каждая часть</div>
                    <pre><code><span class="comment">/                  — начало и конец регулярки (разделитель)
^                  — начало строки: проверка с первого символа
[a-zA-Z0-9._%+-]+  — локальная часть (то, что ДО @):
                     любые буквы, цифры, точки, подчёркивания, плюс, процент, дефис
                     + означает «один или более раз»
                     примеры: ivan, i.van, ivan+spam, ivan_123
@                  — символ @ (ровно один)
[a-zA-Z0-9.-]+     — имя домена (после @ до точки): gmail, yandex, my-site
\.                 — ЭКРАНИРОВАННАЯ точка — буквальный символ "."
[a-zA-Z]{2,}       — доменная зона: только буквы, минимум 2 (com, ru, org)
$                  — конец строки: после доменной зоны ничего быть не должно
/                  — закрытие регулярки</span></code></pre>

                    <div class="content-block">
                        <strong>Что такое экранированная точка.</strong> В регулярках символ <code>.</code> особый &mdash; он означает «любой символ» (кроме перевода строки). Чтобы искать настоящую точку (как между <code>example</code> и <code>com</code>), её экранируют обратным слешем: <code>\.</code>
                        <br><br>
                        <strong>Разница:</strong>
                        <ul class="bullets" style="margin-top:6px;">
                          <li><code>\.</code> &mdash; ищет именно символ <code>.</code></li>
                          <li><code>.</code> &mdash; ищет любой символ: букву, цифру, запятую и т.д.</li>
                        </ul>
                    </div>

                    <div class="example-label">Как работает выражение на примере</div>
                    <pre><code><span class="variable">$email</span> = <span class="string">"john.doe@example.com"</span>;

<span class="comment">// Пошаговое сопоставление:
// ^                     → начинаем с первого символа: j
// [a-zA-Z0-9._%+-]+     → берёт "john.doe" (точка внутри локальной части разрешена)
// @                     → находит символ @
// [a-zA-Z0-9.-]+        → берёт "example"
// \.                    → находит буквальную точку
// [a-zA-Z]{2,}          → берёт "com" (3 буквы, минимум 2)
// $                     → строка закончилась → match
// → preg_match вернёт 1 (true)</span></code></pre>

                    <div class="example-label">Почему if (!preg_match(...))</div>
                    <pre><code><span class="comment">// preg_match() возвращает:
//   1     — строка соответствует шаблону
//   0     — НЕ соответствует
//   false — ошибка в самом шаблоне

// ! инвертирует результат:</span>
<span class="keyword">if</span> (!<span class="function">preg_match</span>(<span class="string">'/.../'</span>, <span class="variable">$email</span>)) {
    <span class="comment">// сюда попадаем, когда email НЕ соответствует формату
    // → можно бросить ValidationException</span>
}</code></pre>

                    <div class="example-label">Что НЕ пройдёт валидацию</div>
                    <pre><code><span class="comment">// ivan@example       — нет точки и доменной зоны (\. не найден)
// ivan@.com          — домен пустой (между @ и точкой ничего нет)
// ivan@example.c     — доменная зона "c" короче 2 символов
// ivan@example.com.  — лишняя точка в конце (нарушает $)
// ivan#example.com   — нет символа @</span></code></pre>

                    <div class="remember-box">
                        Эта regex покрывает 99% случаев, но <strong>не валидирует email на 100% по RFC 5321/5322</strong>. Для боевой валидации в Laravel используйте <code>'email' =&gt; 'required|email:rfc,dns'</code> &mdash; правило <code>email:rfc</code> проверяет полную спецификацию, <code>dns</code> ещё и резолвит домен.
                    </div>

                    <div class="example-label">preg_match_all — найти ВСЕ совпадения</div>
                    <pre><code><span class="function">preg_match_all</span>(<span class="string">'/\d+/'</span>, <span class="string">"1 2 3 4 5"</span>, <span class="variable">$numbers</span>);

<span class="comment">// Разбор паттерна:
// \d  — один любой цифровой символ (0-9)
// +   — один или более раз подряд
// \d+ — последовательность из одной или нескольких цифр

// Функция идёт по строке слева направо и берёт куски, подходящие под \d+:
//   "1" — пробел — стоп → совпадение
//   "2" — пробел — стоп → совпадение
//   "3", "4", "5" — то же

// Результат в $numbers (двумерный массив):</span>
<span class="variable">$numbers</span>[<span class="number">0</span>] === [<span class="string">"1"</span>, <span class="string">"2"</span>, <span class="string">"3"</span>, <span class="string">"4"</span>, <span class="string">"5"</span>];

<span class="comment">// Функция возвращает количество совпадений (целое число):</span>
<span class="variable">$count</span> = <span class="function">preg_match_all</span>(<span class="string">'/\d+/'</span>, <span class="string">"1 2 3 4 5"</span>, <span class="variable">$numbers</span>);
<span class="keyword">echo</span> <span class="variable">$count</span>;  <span class="comment">// 5</span></code></pre>

                    <div class="content-block">
                        <strong>Структура массива результата.</strong>
                        <ul class="bullets" style="margin-top:6px;">
                          <li><code>$numbers[0]</code> &mdash; массив всех полных совпадений</li>
                          <li><code>$numbers[1]</code>, <code>$numbers[2]</code>... &mdash; подсовпадения захватывающих групп (скобок) <code>(...)</code>. Если групп в паттерне нет &mdash; этих индексов тоже нет.</li>
                        </ul>
                    </div>

                    <div class="example-label">Пример со смешанным текстом</div>
                    <pre><code><span class="function">preg_match_all</span>(<span class="string">'/\d+/'</span>, <span class="string">"abc 123 def 45 6"</span>, <span class="variable">$numbers</span>);
<span class="comment">// $numbers[0] = ["123", "45", "6"]
// Пробелы и буквы проигнорированы; "123" — три цифры подряд считаются одним совпадением.</span></code></pre>

                    <div class="example-label">С захватывающими группами</div>
                    <pre><code><span class="function">preg_match_all</span>(<span class="string">'/(\w+)@(\w+\.\w+)/'</span>, <span class="string">"a@x.com b@y.org"</span>, <span class="variable">$m</span>);
<span class="comment">// $m[0] = ["a@x.com", "b@y.org"]     — полные совпадения
// $m[1] = ["a", "b"]                  — первая группа (то, что в первых скобках)
// $m[2] = ["x.com", "y.org"]          — вторая группа</span></code></pre>

                    <div class="remember-box">
                        <strong>Шпаргалка спецсимволов regex:</strong><br>
                        <code>\d</code> &mdash; цифра, <code>\D</code> &mdash; не цифра<br>
                        <code>\w</code> &mdash; буква/цифра/подчёркивание, <code>\W</code> &mdash; всё остальное<br>
                        <code>\s</code> &mdash; пробельный символ (пробел/таб/перевод), <code>\S</code> &mdash; не пробельный<br>
                        <code>.</code> &mdash; любой символ, <code>\.</code> &mdash; буквальная точка<br>
                        <code>+</code> &mdash; 1 или больше, <code>*</code> &mdash; 0 или больше, <code>?</code> &mdash; 0 или 1<br>
                        <code>{n}</code> &mdash; ровно n раз, <code>{n,m}</code> &mdash; от n до m, <code>{n,}</code> &mdash; n или больше<br>
                        <code>^</code> &mdash; начало строки, <code>$</code> &mdash; конец строки<br>
                        <code>[...]</code> &mdash; набор символов, <code>[^...]</code> &mdash; кроме набора<br>
                        <code>(...)</code> &mdash; захватывающая группа, <code>(?:...)</code> &mdash; группа без захвата
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">sprintf и форматирование строк</h3>
                    <div class="example-label">sprintf</div>
                    <pre><code><span class="comment">// sprintf возвращает отформатированную строку</span>
<span class="variable">$formatted</span> = <span class="function">sprintf</span>(<span class="string">"Hello %s, you are %d years old"</span>, <span class="string">"Alice"</span>, <span class="number">30</span>);
<span class="comment">// "Hello Alice, you are 30 years old"</span>

<span class="comment">// printf выводит прямо</span>
<span class="function">printf</span>(<span class="string">"Price: $%.2f"</span>, <span class="number">19.5</span>);  <span class="comment">// "Price: $19.50"</span>

<span class="comment">// Форматы:</span>
<span class="comment">// %s - string</span>
<span class="comment">// %d - integer</span>
<span class="comment">// %f - float (по умолчанию 6 знаков после запятой)</span>
<span class="comment">// %.2f - float с 2 знаками после запятой</span>
<span class="comment">// %x - hex</span>
<span class="comment">// %b - binary</span>

<span class="comment">// Практический пример - форматирование цены</span>
<span class="variable">$price</span> = <span class="function">sprintf</span>(<span class="string">"$%.2f"</span>, <span class="number">99.5</span>);  <span class="comment">// "$99.50"</span></code></pre>
                </div>
            </div>

            <!-- SECTION 3: МАССИВЫ -->
            <div id="arrays" class="section">
                <h2 class="section-title">3. Массивы углублённо</h2>

                <div class="subsection">
                    <h3 class="subsection-title">Оператор => — все 6 контекстов использования</h3>
                    <div class="content-block">
                        В PHP оператор <code>=&gt;</code> (его внутреннее имя &mdash; <code>T_DOUBLE_ARROW</code>) встречается в шести разных контекстах. Это <strong>не оператор сравнения</strong> (для этого <code>==</code>, <code>===</code>) и не общая «стрелка» как в JavaScript. Семантика в каждом контексте разная, но синтаксис один.
                    </div>

                    <div class="example-label">1. Массивы — пара «ключ =&gt; значение»</div>
                    <pre><code><span class="variable">$arr</span> = [
    <span class="string">'name'</span> =&gt; <span class="string">'Иван'</span>,
    <span class="string">'age'</span>  =&gt; <span class="number">30</span>,
    <span class="number">5</span>      =&gt; <span class="string">'пятый'</span>,   <span class="comment">// ключ может быть числом</span>
];</code></pre>

                    <div class="example-label">2. foreach — перебор с ключами</div>
                    <pre><code><span class="keyword">foreach</span> (<span class="variable">$arr</span> <span class="keyword">as</span> <span class="variable">$key</span> =&gt; <span class="variable">$value</span>) {
    <span class="keyword">echo</span> <span class="string">"<span class="variable">$key</span> => <span class="variable">$value</span>"</span>;
}
<span class="comment">// Без => получили бы только значения:
// foreach ($arr as $value) { ... }</span></code></pre>

                    <div class="example-label">3. Стрелочные функции (fn) — PHP 7.4+</div>
                    <pre><code><span class="comment">// fn($x) => выражение  — короткая запись анонимной функции.
// => здесь заменяет return и фигурные скобки.</span>

<span class="comment">// Длинная форма:</span>
<span class="variable">$squared</span> = <span class="function">array_map</span>(<span class="keyword">function</span>(<span class="variable">$n</span>) {
    <span class="keyword">return</span> <span class="variable">$n</span> * <span class="variable">$n</span>;
}, <span class="variable">$numbers</span>);

<span class="comment">// Стрелочная (короткая):</span>
<span class="variable">$squared</span> = <span class="function">array_map</span>(<span class="keyword">fn</span>(<span class="variable">$n</span>) =&gt; <span class="variable">$n</span> * <span class="variable">$n</span>, <span class="variable">$numbers</span>);

<span class="comment">// Особенности стрелочных функций:
// — тело только ОДНО выражение (не несколько строк, не {})
// — автоматически захватывают внешние переменные (без use)</span>
<span class="variable">$multiplier</span> = <span class="number">3</span>;
<span class="variable">$tripled</span> = <span class="function">array_map</span>(<span class="keyword">fn</span>(<span class="variable">$n</span>) =&gt; <span class="variable">$n</span> * <span class="variable">$multiplier</span>, <span class="variable">$numbers</span>);
<span class="comment">// $multiplier "пойман" автоматически — в обычной function требовался бы use ($multiplier)</span></code></pre>

                    <div class="example-label">4. match-выражение — PHP 8.0+</div>
                    <pre><code><span class="comment">// => разделяет проверяемое значение и возвращаемый результат</span>
<span class="variable">$result</span> = <span class="keyword">match</span>(<span class="variable">$status</span>) {
    <span class="number">200</span>           =&gt; <span class="string">'OK'</span>,
    <span class="number">404</span>           =&gt; <span class="string">'Not Found'</span>,
    <span class="number">500</span>, <span class="number">502</span>, <span class="number">503</span> =&gt; <span class="string">'Server Error'</span>,
    <span class="keyword">default</span>       =&gt; <span class="string">'Unknown'</span>,
};

<span class="comment">// В отличие от switch:
//   — строгое сравнение (===), не нестрогое
//   — возвращает значение (можно присвоить в переменную)
//   — обязателен default или match попадание (иначе UnhandledMatchError)</span></code></pre>

                    <div class="example-label">5. Генераторы (yield) — выдача пар ключ-значение</div>
                    <pre><code><span class="keyword">function</span> <span class="function">gen</span>(): <span class="keyword">Generator</span> {
    <span class="keyword">yield</span> <span class="string">'a'</span> =&gt; <span class="number">1</span>;
    <span class="keyword">yield</span> <span class="string">'b'</span> =&gt; <span class="number">2</span>;
    <span class="keyword">yield</span> <span class="string">'c'</span> =&gt; <span class="number">3</span>;
}

<span class="keyword">foreach</span> (<span class="function">gen</span>() <span class="keyword">as</span> <span class="variable">$k</span> =&gt; <span class="variable">$v</span>) {
    <span class="keyword">echo</span> <span class="string">"<span class="variable">$k</span>: <span class="variable">$v</span>\n"</span>;
}
<span class="comment">// Без => в yield генератор выдаёт автоматические числовые ключи 0, 1, 2...</span></code></pre>

                    <div class="example-label">6. Симметричная деструктуризация массива — PHP 7.1+</div>
                    <pre><code><span class="comment">// Распаковка ассоциативного массива в переменные с указанием ключей</span>
<span class="variable">$user</span> = [<span class="string">'name'</span> =&gt; <span class="string">'Анна'</span>, <span class="string">'age'</span> =&gt; <span class="number">25</span>, <span class="string">'role'</span> =&gt; <span class="string">'admin'</span>];

[<span class="string">'name'</span> =&gt; <span class="variable">$name</span>, <span class="string">'age'</span> =&gt; <span class="variable">$age</span>] = <span class="variable">$user</span>;
<span class="comment">// $name = 'Анна', $age = 25 (role игнорируется)

// До PHP 7.1 — только позиционная (без ключей):
// [$first, $second, $third] = $array;</span></code></pre>

                    <div class="example-label">Что => НЕ значит в PHP</div>
                    <pre><code><span class="comment">// ❌ Не оператор сравнения — для этого == или ===
$a => $b   <span class="comment">// SYNTAX ERROR</span>

<span class="comment">// ❌ Не стрелочный метод классов (в PHP такого синтаксиса нет)
class User {
    public name => "default";   <span class="comment">// SYNTAX ERROR</span>
}

<span class="comment">// ❌ Не используется в enum для задания значения — там просто =
enum Status: string {
    case DRAFT = 'черновик';     <span class="comment">// = (одно равно), не =></span>
    case DRAFT => 'черновик';    <span class="comment">// SYNTAX ERROR</span>
}</span></code></pre>

                    <div class="example-label">Краткая памятка</div>
                    <pre><code><span class="comment">+--------------------------+------------------------------------+
| Контекст                 | Пример                             |
+--------------------------+------------------------------------+
| Массив                   | ['key' => 'value']                 |
| foreach                  | foreach ($arr as $k => $v)         |
| Стрелочная функция       | fn($x) => $x * 2                   |
| match (PHP 8+)           | match($x) { 1 => 'one' }           |
| yield в генераторе       | yield $key => $value               |
| Деструктуризация (7.1+)  | ['key' => $var] = $arr             |
+--------------------------+------------------------------------+</span></code></pre>

                    <div class="remember-box">
                        <strong>Мнемоника:</strong> <code>=&gt;</code> всегда обозначает <strong>связь между двумя сторонами</strong>: «ключ ↔ значение» (в массивах, foreach, yield, деструктуризации) либо «вход ↔ выход» (в стрелочных функциях и match). Левая часть &mdash; что подаём, правая &mdash; что получаем или какое значение хранится.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">array_map - Преобразование элементов</h3>
                    <div class="example-label">array_map примеры</div>
                    <pre><code><span class="comment">// Применить функцию к каждому элементу</span>
<span class="variable">$numbers</span> = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>, <span class="number">4</span>];
<span class="variable">$squared</span> = <span class="function">array_map</span>(<span class="keyword">fn</span>(<span class="variable">$n</span>) => <span class="variable">$n</span> * <span class="variable">$n</span>, <span class="variable">$numbers</span>);
<span class="comment">// [1, 4, 9, 16]</span>

<span class="comment">// Преобразование пользователей в массив ID</span>
<span class="variable">$users</span> = [
    [<span class="string">'id'</span> => <span class="number">1</span>, <span class="string">'name'</span> => <span class="string">'Alice'</span>],
    [<span class="string">'id'</span> => <span class="number">2</span>, <span class="string">'name'</span> => <span class="string">'Bob'</span>]
];
<span class="variable">$ids</span> = <span class="function">array_map</span>(<span class="keyword">fn</span>(<span class="variable">$u</span>) => <span class="variable">$u</span>[<span class="string">'id'</span>], <span class="variable">$users</span>);
<span class="comment">// [1, 2]</span>

<span class="comment">// С объектами</span>
<span class="variable">$users</span> = <span class="function">User</span>::<span class="function">all</span>();  <span class="comment">// Laravel Collection</span>
<span class="variable">$names</span> = <span class="function">array_map</span>(<span class="keyword">fn</span>(<span class="variable">$user</span>) => <span class="variable">$user</span>-><span class="function">name</span>, <span class="variable">$users</span>-><span class="function">toArray</span>());

<span class="comment">// Применить функцию к нескольким массивам одновременно</span>
<span class="variable">$a</span> = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="variable">$b</span> = [<span class="number">10</span>, <span class="number">20</span>, <span class="number">30</span>];
<span class="variable">$result</span> = <span class="function">array_map</span>(<span class="keyword">fn</span>(<span class="variable">$x</span>, <span class="variable">$y</span>) => <span class="variable">$x</span> + <span class="variable">$y</span>, <span class="variable">$a</span>, <span class="variable">$b</span>);
<span class="comment">// [11, 22, 33]</span></code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">array_filter - Фильтрация элементов</h3>
                    <div class="example-label">array_filter примеры</div>
                    <pre><code><span class="comment">// Фильтровать массив по условию</span>
<span class="variable">$numbers</span> = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>, <span class="number">4</span>, <span class="number">5</span>];
<span class="variable">$evens</span> = <span class="function">array_filter</span>(<span class="variable">$numbers</span>, <span class="keyword">fn</span>(<span class="variable">$n</span>) => <span class="variable">$n</span> % <span class="number">2</span> == <span class="number">0</span>);
<span class="comment">// [2, 4] (ключи сохранены!)</span>

<span class="comment">// Удалить null и пустые значения</span>
<span class="variable">$data</span> = [<span class="string">'name'</span> => <span class="string">'Alice'</span>, <span class="string">'age'</span> => <span class="keyword">null</span>, <span class="string">'city'</span> => <span class="string">'NYC'</span>];
<span class="variable">$filtered</span> = <span class="function">array_filter</span>(<span class="variable">$data</span>);
<span class="comment">// ['name' => 'Alice', 'city' => 'NYC']</span>

<span class="comment">// Фильтровать только ключи</span>
<span class="variable">$data</span> = [<span class="string">'user_id'</span> => <span class="number">1</span>, <span class="string">'admin_id'</span> => <span class="number">2</span>, <span class="string">'name'</span> => <span class="string">'Test'</span>];
<span class="variable">$ids</span> = <span class="function">array_filter</span>(<span class="variable">$data</span>, <span class="keyword">fn</span>(<span class="variable">$k</span>) => <span class="function">str_ends_with</span>(<span class="variable">$k</span>, <span class="string">'_id'</span>), <span class="keyword">ARRAY_FILTER_USE_KEY</span>);
<span class="comment">// ['user_id' => 1, 'admin_id' => 2]</span>

<span class="comment">// Практический пример - получить активных пользователей из БД</span>
<span class="variable">$users</span> = <span class="function">User</span>::<span class="function">all</span>();
<span class="variable">$active</span> = <span class="function">array_filter</span>(
    <span class="variable">$users</span>-><span class="function">toArray</span>(),
    <span class="keyword">fn</span>(<span class="variable">$user</span>) => <span class="variable">$user</span>[<span class="string">'is_active'</span>] === <span class="keyword">true</span>
);</code></pre>

                    <div class="content-block">
                        <strong>Что значит <code>$n % 2 == 0</code>.</strong> Оператор <code>%</code> (modulo) &mdash; остаток от деления. <code>$n % 2</code> вернёт <code>0</code> для чётных чисел и <code>1</code> для нечётных. Поэтому <code>$n % 2 == 0</code> &mdash; проверка чётности. Аналогично <code>$n % 3 == 0</code> &mdash; делится ли на 3; <code>$n % 10</code> &mdash; последняя цифра числа.
                    </div>

                    <div class="example-label">Три режима array_filter — флаги USE_KEY и USE_BOTH</div>
                    <pre><code><span class="variable">$data</span> = [<span class="string">'user_id'</span> => <span class="number">1</span>, <span class="string">'admin_id'</span> => <span class="number">2</span>, <span class="string">'name'</span> => <span class="string">'Test'</span>];

<span class="comment">// 1. По умолчанию — в callback передаётся только ЗНАЧЕНИЕ</span>
<span class="function">array_filter</span>(<span class="variable">$data</span>, <span class="keyword">fn</span>(<span class="variable">$value</span>) => <span class="function">is_numeric</span>(<span class="variable">$value</span>));
<span class="comment">// ['user_id' => 1, 'admin_id' => 2]  — оставляет только числовые значения</span>

<span class="comment">// 2. ARRAY_FILTER_USE_KEY — в callback передаётся только КЛЮЧ</span>
<span class="function">array_filter</span>(<span class="variable">$data</span>, <span class="keyword">fn</span>(<span class="variable">$k</span>) => <span class="function">str_ends_with</span>(<span class="variable">$k</span>, <span class="string">'_id'</span>), <span class="keyword">ARRAY_FILTER_USE_KEY</span>);
<span class="comment">// ['user_id' => 1, 'admin_id' => 2]  — оставляет ключи, заканчивающиеся на _id</span>

<span class="comment">// 3. ARRAY_FILTER_USE_BOTH — в callback передаются ОБА: value, key (именно в таком порядке!)</span>
<span class="function">array_filter</span>(<span class="variable">$data</span>, <span class="keyword">fn</span>(<span class="variable">$v</span>, <span class="variable">$k</span>) => <span class="function">str_starts_with</span>(<span class="variable">$k</span>, <span class="string">'user'</span>) && <span class="function">is_numeric</span>(<span class="variable">$v</span>), <span class="keyword">ARRAY_FILTER_USE_BOTH</span>);
<span class="comment">// ['user_id' => 1]  — ключ начинается с "user" И значение числовое</span></code></pre>

                    <div class="content-block">
                        <strong>Зачем нужны эти флаги.</strong> Без них фильтрация только по значению; для фильтрации по ключу пришлось бы городить с <code>array_keys</code> + цикл. <code>ARRAY_FILTER_USE_KEY</code> упрощает паттерны вида «оставить только поля с префиксом» (часто &mdash; для очистки FormRequest от лишних ключей). <code>USE_BOTH</code> &mdash; когда условие зависит и от ключа, и от значения одновременно.
                    </div>

                    <div class="example-label">toArray() — это метод коллекции, не хелпер</div>
                    <pre><code><span class="comment">// В строке $users->toArray() метод toArray() — это НЕ глобальная функция (хелпер).
// Это метод экземпляра класса Illuminate\Support\Collection (или Eloquent\Model).</span>

<span class="variable">$users</span> = <span class="function">User</span>::<span class="function">all</span>();     <span class="comment">// возвращает Collection (объект)</span>
<span class="variable">$users</span>-><span class="function">toArray</span>();          <span class="comment">// рекурсивно превращает коллекцию в обычный массив PHP</span>

<span class="comment">// Зачем .toArray()? array_filter — встроенная функция PHP, она принимает массив,
// а не Laravel-коллекцию. Поэтому коллекцию приводят к массиву.

// Но если вы остаётесь в мире Laravel — у Collection есть СВОИ методы filter() и where(),
// которые умнее и идиоматичнее:</span>

<span class="comment">// ❌ Менее идиоматично — выйти из Collection, использовать PHP-функцию:</span>
<span class="variable">$active</span> = <span class="function">array_filter</span>(<span class="variable">$users</span>-><span class="function">toArray</span>(), <span class="keyword">fn</span>(<span class="variable">$u</span>) => <span class="variable">$u</span>[<span class="string">'is_active'</span>]);

<span class="comment">// ✓ Лучше — остаться в Collection:</span>
<span class="variable">$active</span> = <span class="variable">$users</span>-><span class="function">filter</span>(<span class="keyword">fn</span>(<span class="variable">$u</span>) => <span class="variable">$u</span>-><span class="variable">is_active</span>);

<span class="comment">// ✓ Ещё лучше — where() для простых проверок:</span>
<span class="variable">$active</span> = <span class="variable">$users</span>-><span class="function">where</span>(<span class="string">'is_active'</span>, <span class="keyword">true</span>);

<span class="comment">// Если в итоге нужен массив — в конце .toArray():</span>
<span class="variable">$activeArray</span> = <span class="variable">$users</span>-><span class="function">where</span>(<span class="string">'is_active'</span>, <span class="keyword">true</span>)-><span class="function">toArray</span>();</code></pre>

                    <div class="remember-box">
                        <strong>Хелпер vs метод в Laravel:</strong><br>
                        — <strong>Хелперы</strong> &mdash; глобальные функции: <code>collect()</code>, <code>dd()</code>, <code>view()</code>, <code>config()</code>, <code>route()</code>, <code>now()</code>, <code>auth()</code>. Вызываются без объекта.<br>
                        — <strong>Методы</strong> &mdash; определены в классах, вызываются через <code>-&gt;</code>: <code>$users-&gt;toArray()</code>, <code>$user-&gt;save()</code>, <code>$collection-&gt;filter()</code>.<br>
                        Полный справочник хелперов &mdash; в KB_10 «Хелперы &amp; методы».
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">array_reduce - Свёртка массива</h3>
                    <div class="example-label">array_reduce примеры</div>
                    <pre><code><span class="comment">// Свернуть массив в одно значение (сумма)</span>
<span class="variable">$numbers</span> = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>, <span class="number">4</span>];
<span class="variable">$sum</span> = <span class="function">array_reduce</span>(<span class="variable">$numbers</span>, <span class="keyword">fn</span>(<span class="variable">$carry</span>, <span class="variable">$item</span>) => <span class="variable">$carry</span> + <span class="variable">$item</span>, <span class="number">0</span>);
<span class="comment">// 10</span>

<span class="comment">// Построить ассоциативный массив из списка</span>
<span class="variable">$users</span> = [
    [<span class="string">'id'</span> => <span class="number">1</span>, <span class="string">'name'</span> => <span class="string">'Alice'</span>],
    [<span class="string">'id'</span> => <span class="number">2</span>, <span class="string">'name'</span> => <span class="string">'Bob'</span>]
];
<span class="variable">$indexed</span> = <span class="function">array_reduce</span>(<span class="variable">$users</span>, <span class="keyword">function</span>(<span class="variable">$carry</span>, <span class="variable">$user</span>) {
    <span class="variable">$carry</span>[<span class="variable">$user</span>[<span class="string">'id'</span>]] = <span class="variable">$user</span>[<span class="string">'name'</span>];
    <span class="keyword">return</span> <span class="variable">$carry</span>;
}, []);
<span class="comment">// [1 => 'Alice', 2 => 'Bob']</span>

<span class="comment">// Вычислить статистику</span>
<span class="variable">$orders</span> = [
    [<span class="string">'id'</span> => <span class="number">1</span>, <span class="string">'amount'</span> => <span class="number">100</span>],
    [<span class="string">'id'</span> => <span class="number">2</span>, <span class="string">'amount'</span> => <span class="number">200</span>],
    [<span class="string">'id'</span> => <span class="number">3</span>, <span class="string">'amount'</span> => <span class="number">150</span>]
];
<span class="variable">$stats</span> = <span class="function">array_reduce</span>(<span class="variable">$orders</span>, <span class="keyword">function</span>(<span class="variable">$carry</span>, <span class="variable">$order</span>) {
    <span class="variable">$carry</span>[<span class="string">'total'</span>] += <span class="variable">$order</span>[<span class="string">'amount'</span>];
    <span class="variable">$carry</span>[<span class="string">'count'</span>]++;
    <span class="variable">$carry</span>[<span class="string">'avg'</span>] = <span class="variable">$carry</span>[<span class="string">'total'</span>] / <span class="variable">$carry</span>[<span class="string">'count'</span>];
    <span class="keyword">return</span> <span class="variable">$carry</span>;
}, [<span class="string">'total'</span> => <span class="number">0</span>, <span class="string">'count'</span> => <span class="number">0</span>, <span class="string">'avg'</span> => <span class="number">0</span>]);</code></pre>

                    <div class="content-block">
                        <strong>Разбор примера со статистикой.</strong> Здесь аккумулятор &mdash; не одно число, а <strong>ассоциативный массив с тремя полями</strong> (<code>total</code>, <code>count</code>, <code>avg</code>). Начальное значение задано сразу со всеми ключами и нулями, чтобы при первом обращении (<code>$carry['total'] += ...</code>, <code>$carry['count']++</code>) PHP не выдал warning «Undefined index».
                    </div>

                    <div class="example-label">Пошаговая трассировка для $orders = [100, 200, 150]</div>
                    <pre><code><span class="comment">+------+---------+-------------+------------------------------------------+
| Шаг  | $order  | До $carry   | После $carry                              |
+------+---------+-------------+------------------------------------------+
| init | —       | —           | total=0, count=0, avg=0                  |
| 1    | 100     | t=0, c=0    | t=0+100=100, c=1, avg=100/1=100          |
| 2    | 200     | t=100, c=1  | t=100+200=300, c=2, avg=300/2=150        |
| 3    | 150     | t=300, c=2  | t=300+150=450, c=3, avg=450/3=150        |
+------+---------+-------------+------------------------------------------+

Результат $stats:
[
    'total' => 450,
    'count' => 3,
    'avg'   => 150,
]</span></code></pre>

                    <div class="content-block">
                        <strong>Почему `avg` пересчитывается на каждой итерации?</strong> Технически &mdash; излишне: достаточно посчитать его один раз после цикла (<code>$total / $count</code>). В коде выше он пересчитывается каждый шаг, чтобы <strong>после любой итерации в <code>$carry['avg']</code> было актуальное текущее среднее</strong>. Полезно, если callback вызывается не только array_reduce'ом, или если нужна промежуточная статистика для логирования.
                    </div>

                    <div class="example-label">Эквивалент с обычным циклом</div>
                    <pre><code><span class="variable">$total</span> = <span class="number">0</span>;
<span class="variable">$count</span> = <span class="number">0</span>;
<span class="keyword">foreach</span> (<span class="variable">$orders</span> <span class="keyword">as</span> <span class="variable">$order</span>) {
    <span class="variable">$total</span> += <span class="variable">$order</span>[<span class="string">'amount'</span>];
    <span class="variable">$count</span>++;
}
<span class="variable">$avg</span> = <span class="variable">$count</span> > <span class="number">0</span> ? <span class="variable">$total</span> / <span class="variable">$count</span> : <span class="number">0</span>;  <span class="comment">// защита от деления на ноль</span>
<span class="variable">$stats</span> = [<span class="string">'total'</span> => <span class="variable">$total</span>, <span class="string">'count'</span> => <span class="variable">$count</span>, <span class="string">'avg'</span> => <span class="variable">$avg</span>];

<span class="comment">// Результат идентичен. Разница только в стиле:
// array_reduce — функциональный, всё внутри одного выражения
// foreach — императивный, легче дебажить</span></code></pre>

                    <div class="remember-box">
                        <strong>Защита от деления на 0:</strong> в array_reduce варианте, если массив <code>$orders</code> пустой, цикл не пройдёт, callback не вызовется &mdash; <code>$stats['avg']</code> останется <code>0</code> из начального значения. В foreach-варианте без проверки <code>$count &gt; 0</code> произошло бы <code>DivisionByZeroError</code>. Это редкий случай, когда array_reduce «бесплатно» защищает от пограничного бага.
                    </div>

                    <div class="content-block">
                        <strong>Пошаговый разбор `$sum = array_reduce($numbers, fn($carry, $item) =&gt; $carry + $item, 0)`</strong> для <code>[1, 2, 3, 4]</code>:
                    </div>

                    <div class="example-label">Что происходит на каждом шаге</div>
                    <pre><code><span class="comment">+------+--------------+-------------------------+-------------+
| Шаг  | $item       | Вычисление $carry+$item | Новый $carry|
+------+--------------+-------------------------+-------------+
| init | —            | — (начальное = 0)       | 0           |
| 1    | 1            | 0 + 1 = 1               | 1           |
| 2    | 2            | 1 + 2 = 3               | 3           |
| 3    | 3            | 3 + 3 = 6               | 6           |
| 4    | 4            | 6 + 4 = 10              | 10          |
+------+--------------+-------------------------+-------------+

После последнего элемента array_reduce возвращает $carry → 10.</span></code></pre>

                    <div class="content-block">
                        <strong>Как PHP «понимает» что первый параметр &mdash; аккумулятор, а второй &mdash; элемент?</strong> Не по именам переменных. <code>$carry</code> и <code>$item</code> &mdash; имена, придуманные разработчиком, они могут быть любыми (<code>$x</code>, <code>$y</code>, <code>$a</code>, <code>$b</code>). Важен <strong>порядок</strong>: первым аргументом callback всегда получает аккумулятор, вторым &mdash; текущий элемент. Это <strong>зашито в реализацию</strong> <code>array_reduce</code> на уровне ядра PHP.
                    </div>

                    <div class="example-label">Псевдо-реализация array_reduce (что внутри функции)</div>
                    <pre><code><span class="keyword">function</span> <span class="function">my_array_reduce</span>(<span class="keyword">array</span> <span class="variable">$array</span>, <span class="keyword">callable</span> <span class="variable">$callback</span>, <span class="variable">$initial</span> = <span class="keyword">null</span>) {
    <span class="variable">$accumulator</span> = <span class="variable">$initial</span>;

    <span class="keyword">foreach</span> (<span class="variable">$array</span> <span class="keyword">as</span> <span class="variable">$item</span>) {
        <span class="comment">// Жёстко зашитый порядок: 1-й arg = аккумулятор, 2-й = элемент</span>
        <span class="variable">$accumulator</span> = <span class="variable">$callback</span>(<span class="variable">$accumulator</span>, <span class="variable">$item</span>);
    }

    <span class="keyword">return</span> <span class="variable">$accumulator</span>;
}</code></pre>

                    <div class="example-label">Эквивалент с обычным foreach</div>
                    <pre><code><span class="variable">$sum</span> = <span class="number">0</span>;
<span class="keyword">foreach</span> (<span class="variable">$numbers</span> <span class="keyword">as</span> <span class="variable">$item</span>) {
    <span class="variable">$sum</span> += <span class="variable">$item</span>;
}
<span class="comment">// результат тот же: 10
// array_reduce — более декларативный способ, особенно для построения структур</span></code></pre>

                    <div class="remember-box">
                        <strong>Зачем начальное значение (3-й параметр)?</strong><br>
                        — Если массив пустой → <code>array_reduce</code> вернёт начальное значение (для <code>0</code> это логичная сумма, для <code>1</code> &mdash; произведение).<br>
                        — Если массив не пустой → начальное значение участвует в первом вычислении (<code>0 + 1 = 1</code> в нашем примере).<br>
                        Без начального значения по умолчанию — <code>null</code>, что часто ломает callback (<code>null + 1</code> = warning + 1).
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">array_walk - Изменение элементов с побочными эффектами</h3>
                    <div class="example-label">array_walk примеры</div>
                    <pre><code><span class="comment">// array_walk изменяет массив IN-PLACE (по ссылке!)</span>
<span class="variable">$data</span> = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="function">array_walk</span>(<span class="variable">$data</span>, <span class="keyword">function</span>(&<span class="variable">$item</span>) {
    <span class="variable">$item</span> *= <span class="number">2</span>;
});
<span class="comment">// $data = [2, 4, 6]</span>

<span class="comment">// С дополнительным параметром (userdata)</span>
<span class="variable">$prices</span> = [<span class="number">10</span>, <span class="number">20</span>, <span class="number">30</span>];
<span class="variable">$tax</span> = <span class="number">0.1</span>;
<span class="function">array_walk</span>(<span class="variable">$prices</span>, <span class="keyword">function</span>(&<span class="variable">$price</span>, <span class="variable">$key</span>, <span class="variable">$taxRate</span>) {
    <span class="variable">$price</span> = <span class="variable">$price</span> * (<span class="number">1</span> + <span class="variable">$taxRate</span>);
}, <span class="variable">$tax</span>);
<span class="comment">// $prices = [11, 22, 33]</span>

<span class="comment">// ВАЖНО: & влияет ТОЛЬКО на тот параметр, перед которым стоит.
// В этом примере:
//   &$price  — изменение мутирует значение в исходном массиве
//   $key     — копия ключа; изменить его внутри функции невозможно
//   $taxRate — копия userdata; присвоение внутри не повлияет на $tax снаружи

// Что меняется в исходном $prices:
//   ✓ значения элементов (11, 22, 33)
//   ✗ ключи остаются прежними (0, 1, 2) — их вообще нельзя поменять через array_walk
//   ✗ структура массива (количество элементов, порядок) не меняется</span></code></pre>
                    <pre><code><span class="comment">// Сигнатура callback для array_walk:
//   function(&$value, $key, $userdata)
//   позиция 1: значение (можно с & для мутации)
//   позиция 2: ключ (всегда копия)
//   позиция 3+: $userdata из 3-го аргумента array_walk (опционально)

// Если поставить & перед $key — будет WARNING, потому что array_walk
// передаёт ключ всегда по значению:</span>
<span class="function">array_walk</span>(<span class="variable">$arr</span>, <span class="keyword">function</span>(<span class="variable">$value</span>, &<span class="variable">$key</span>) {
    <span class="variable">$key</span> = <span class="string">"new_key"</span>;   <span class="comment">// бесполезно, ключи не меняются</span>
});
<span class="comment">// Чтобы изменить ключи — используйте array_combine + array_map или явный foreach.</span></code></pre>
                    <pre><code><span class="comment">// Отправить письма всем пользователям</span>
<span class="variable">$users</span> = [
    [<span class="string">'name'</span> => <span class="string">'Alice'</span>, <span class="string">'email'</span> => <span class="string">'alice@ex.com'</span>],
    [<span class="string">'name'</span> => <span class="string">'Bob'</span>, <span class="string">'email'</span> => <span class="string">'bob@ex.com'</span>]
];
<span class="function">array_walk</span>(<span class="variable">$users</span>, <span class="keyword">function</span>(<span class="variable">$user</span>) {
    <span class="function">Mail</span>::<span class="function">to</span>(<span class="variable">$user</span>[<span class="string">'email'</span>])-><span class="function">send</span>(<span class="keyword">new</span> <span class="function">WelcomeMail</span>(<span class="variable">$user</span>[<span class="string">'name'</span>]));
});</code></pre>

                    <div class="content-block">
                        <strong>Что значит <code>&amp;</code> перед параметром (как в <code>&amp;$item</code>).</strong> Символ <code>&amp;</code> называется <strong>амперсанд</strong>, в PHP он означает <strong>передачу по ссылке</strong> (by reference). Без него параметр &mdash; это копия значения; изменения внутри функции не затронут оригинал. Со <code>&amp;</code> &mdash; параметр становится псевдонимом самого исходного элемента; всё, что делается с переменной внутри функции, изменяет исходные данные.
                    </div>

                    <div class="example-label">Разница: с & vs без &</div>
                    <pre><code><span class="comment">// ❌ Без & — копия, оригинал не меняется</span>
<span class="variable">$data</span> = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="function">array_walk</span>(<span class="variable">$data</span>, <span class="keyword">function</span>(<span class="variable">$item</span>) {
    <span class="variable">$item</span> *= <span class="number">10</span>;            <span class="comment">// меняем КОПИЮ — бесполезно</span>
});
<span class="function">print_r</span>(<span class="variable">$data</span>);              <span class="comment">// [1, 2, 3] — без изменений</span>

<span class="comment">// ✓ С & — ссылка, оригинал изменяется</span>
<span class="variable">$data</span> = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="function">array_walk</span>(<span class="variable">$data</span>, <span class="keyword">function</span>(&<span class="variable">$item</span>) {
    <span class="variable">$item</span> *= <span class="number">10</span>;            <span class="comment">// меняем САМ элемент массива</span>
});
<span class="function">print_r</span>(<span class="variable">$data</span>);              <span class="comment">// [10, 20, 30] — массив реально изменился</span></code></pre>

                    <div class="example-label">& работает в любой функции, не только array_walk</div>
                    <pre><code><span class="comment">// Без & — без эффекта</span>
<span class="keyword">function</span> <span class="function">addOneCopy</span>(<span class="variable">$num</span>) {
    <span class="variable">$num</span>++;
}
<span class="variable">$x</span> = <span class="number">5</span>;
<span class="function">addOneCopy</span>(<span class="variable">$x</span>);
<span class="keyword">echo</span> <span class="variable">$x</span>;    <span class="comment">// 5 — $x не изменился</span>

<span class="comment">// С & — функция мутирует переданную переменную</span>
<span class="keyword">function</span> <span class="function">addOneRef</span>(&<span class="variable">$num</span>) {
    <span class="variable">$num</span>++;
}
<span class="variable">$x</span> = <span class="number">5</span>;
<span class="function">addOneRef</span>(<span class="variable">$x</span>);
<span class="keyword">echo</span> <span class="variable">$x</span>;    <span class="comment">// 6 — $x изменился, потому что передан по ссылке</span></code></pre>

                    <div class="example-label">Где ещё встречается & в PHP</div>
                    <pre><code><span class="comment">// 1. Параметр функции по ссылке (как выше)</span>
<span class="keyword">function</span> <span class="function">f</span>(&<span class="variable">$arg</span>) { ... }

<span class="comment">// 2. Возврат по ссылке (редко используется)</span>
<span class="keyword">function</span> &<span class="function">getRef</span>() { <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">data</span>; }

<span class="comment">// 3. Присваивание по ссылке — создание псевдонима</span>
<span class="variable">$a</span> = <span class="number">10</span>;
<span class="variable">$b</span> = &<span class="variable">$a</span>;                     <span class="comment">// $b — это другое имя для $a</span>
<span class="variable">$b</span> = <span class="number">20</span>;
<span class="keyword">echo</span> <span class="variable">$a</span>;                      <span class="comment">// 20 — изменилось через $b</span>

<span class="comment">// 4. foreach по ссылке — изменение массива во время перебора</span>
<span class="variable">$arr</span> = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="keyword">foreach</span> (<span class="variable">$arr</span> <span class="keyword">as</span> &<span class="variable">$val</span>) {
    <span class="variable">$val</span> *= <span class="number">10</span>;
}
<span class="comment">// $arr = [10, 20, 30]</span>

<span class="comment">// 5. Битовое И (другой контекст — оператор &amp; между значениями, не префикс)</span>
<span class="variable">$flags</span> = <span class="number">0b1010</span> & <span class="number">0b1100</span>;   <span class="comment">// 0b1000</span></code></pre>

                    <div class="example-label">Классический pitfall — забытая ссылка после foreach</div>
                    <pre><code><span class="variable">$arr</span> = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];

<span class="comment">// Первый foreach по ссылке — изменяем массив</span>
<span class="keyword">foreach</span> (<span class="variable">$arr</span> <span class="keyword">as</span> &<span class="variable">$val</span>) {
    <span class="variable">$val</span> *= <span class="number">10</span>;
}
<span class="comment">// После цикла $val ОСТАЁТСЯ ссылкой на последний элемент массива!</span>

<span class="comment">// Второй foreach — без &, но переиспользует ту же $val</span>
<span class="keyword">foreach</span> (<span class="variable">$arr</span> <span class="keyword">as</span> <span class="variable">$val</span>) {
    <span class="comment">// каждая итерация ПЕРЕЗАПИСЫВАЕТ $arr[2] (последний элемент!)</span>
    <span class="comment">// в результате: $arr = [10, 20, &$val=10], затем [10, 20, 20], затем [10, 20, 20]</span>
}
<span class="function">print_r</span>(<span class="variable">$arr</span>);    <span class="comment">// [10, 20, 20] вместо ожидаемого [10, 20, 30]</span>

<span class="comment">// ✓ Решение: после foreach по ссылке всегда unset:</span>
<span class="keyword">foreach</span> (<span class="variable">$arr</span> <span class="keyword">as</span> &<span class="variable">$val</span>) { <span class="variable">$val</span> *= <span class="number">10</span>; }
<span class="keyword">unset</span>(<span class="variable">$val</span>);    <span class="comment">// разорвать ссылку</span></code></pre>

                    <div class="remember-box">
                        <strong>Когда использовать <code>&amp;</code>:</strong> когда явно нужно мутировать оригинал (array_walk, реализация Stack/Queue, оптимизация для огромных строк/массивов чтобы не копировать).<br>
                        <strong>Когда НЕ использовать:</strong> в чистых функциях (вход → выход, без побочек), в API-границах вашего модуля, при работе с объектами (объекты в PHP и так передаются «по handle» — ссылка не нужна), и всегда когда читателю кода будет неочевидно что переменная мутируется.<br>
                        <strong>Правило большого пальца:</strong> явные мутации через возврат значения (<code>$arr = array_map(...)</code>) почти всегда читаются лучше, чем неявные через <code>&amp;</code>. Ссылку оставляйте для тех случаев, где return неудобен.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">usort и сортировка массивов</h3>
                    <div class="example-label">usort примеры</div>
                    <pre><code><span class="comment">// usort - сортирует массив с пользовательским компаратором</span>
<span class="variable">$users</span> = [
    [<span class="string">'name'</span> => <span class="string">'Charlie'</span>, <span class="string">'age'</span> => <span class="number">25</span>],
    [<span class="string">'name'</span> => <span class="string">'Alice'</span>, <span class="string">'age'</span> => <span class="number">30</span>],
    [<span class="string">'name'</span> => <span class="string">'Bob'</span>, <span class="string">'age'</span> => <span class="number">28</span>]
];

<span class="comment">// Сортировать по возрасту (возрастающе)</span>
<span class="function">usort</span>(<span class="variable">$users</span>, <span class="keyword">fn</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) => <span class="variable">$a</span>[<span class="string">'age'</span>] <=> <span class="variable">$b</span>[<span class="string">'age'</span>]);
<span class="comment">// [Charlie, Bob, Alice] (25, 28, 30)</span>

<span class="comment">// Сортировать по возрасту (убывающе)</span>
<span class="function">usort</span>(<span class="variable">$users</span>, <span class="keyword">fn</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) => <span class="variable">$b</span>[<span class="string">'age'</span>] <=> <span class="variable">$a</span>[<span class="string">'age'</span>]);

<span class="comment">// Сортировать по нескольким параметрам (сначала возраст, потом имя)</span>
<span class="function">usort</span>(<span class="variable">$users</span>, <span class="keyword">function</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) {
    <span class="variable">$ageCompare</span> = <span class="variable">$a</span>[<span class="string">'age'</span>] <=> <span class="variable">$b</span>[<span class="string">'age'</span>];
    <span class="keyword">if</span> (<span class="variable">$ageCompare</span> !== <span class="number">0</span>) {
        <span class="keyword">return</span> <span class="variable">$ageCompare</span>;
    }
    <span class="keyword">return</span> <span class="variable">$a</span>[<span class="string">'name'</span>] <=> <span class="variable">$b</span>[<span class="string">'name'</span>];
});

<span class="comment">// Сортировать объекты (Laravel Model)</span>
<span class="variable">$users</span> = <span class="function">User</span>::<span class="function">all</span>();
<span class="function">usort</span>(<span class="variable">$users</span>-><span class="function">toArray</span>(), <span class="keyword">fn</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) => <span class="variable">$a</span>[<span class="string">'created_at'</span>] <=> <span class="variable">$b</span>[<span class="string">'created_at'</span>]);</code></pre>

                    <div class="content-block">
                        <strong>Оператор <code>&lt;=&gt;</code> — «spaceship» (космический корабль), PHP 7+.</strong> Трёхзначный оператор сравнения: возвращает целое число, показывающее <em>как</em> левая часть относится к правой. Это именно то, что хотят функции вроде <code>usort</code>, <code>uasort</code>, <code>uksort</code>, <code>SplPriorityQueue</code> и любые алгоритмы сортировки: «дай мне -1/0/1 и я разберусь».
                    </div>

                    <div class="example-label">Что возвращает $a &lt;=&gt; $b</div>
                    <pre><code><span class="comment">// -1 — $a меньше $b
// 0  — $a равно $b
// 1  — $a больше $b</span>

<span class="function">var_dump</span>(<span class="number">5</span> <=> <span class="number">10</span>);    <span class="comment">// int(-1)</span>
<span class="function">var_dump</span>(<span class="number">5</span> <=> <span class="number">5</span>);     <span class="comment">// int(0)</span>
<span class="function">var_dump</span>(<span class="number">10</span> <=> <span class="number">5</span>);    <span class="comment">// int(1)</span>

<span class="comment">// Работает не только с числами:</span>
<span class="function">var_dump</span>(<span class="string">"apple"</span> <=> <span class="string">"banana"</span>);  <span class="comment">// int(-1) — строки сравниваются лексикографически</span>
<span class="function">var_dump</span>(<span class="string">"banana"</span> <=> <span class="string">"apple"</span>);  <span class="comment">// int(1)</span>

<span class="comment">// С массивами — поэлементно (size, потом keys, потом values):</span>
<span class="function">var_dump</span>([<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>] <=> [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>]);  <span class="comment">// int(0)</span>
<span class="function">var_dump</span>([<span class="number">1</span>, <span class="number">2</span>] <=> [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>]);     <span class="comment">// int(-1) — меньше размер</span>

<span class="comment">// С объектами — обычно через __toString() или магию класса</span></code></pre>

                    <div class="example-label">Зачем нужны именно -1/0/1 для usort</div>
                    <pre><code><span class="comment">// usort требует от callback вернуть:
//   отрицательное число — если $a должен идти ПЕРЕД $b
//   ноль                — если порядок неважен (равны)
//   положительное       — если $a должен идти ПОСЛЕ $b

// До PHP 7 без &lt;=&gt; писали так:</span>
<span class="function">usort</span>(<span class="variable">$users</span>, <span class="keyword">function</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) {
    <span class="keyword">if</span> (<span class="variable">$a</span>[<span class="string">'age'</span>] < <span class="variable">$b</span>[<span class="string">'age'</span>]) <span class="keyword">return</span> -<span class="number">1</span>;
    <span class="keyword">if</span> (<span class="variable">$a</span>[<span class="string">'age'</span>] > <span class="variable">$b</span>[<span class="string">'age'</span>]) <span class="keyword">return</span> <span class="number">1</span>;
    <span class="keyword">return</span> <span class="number">0</span>;
});

<span class="comment">// С &lt;=&gt; — одна строка:</span>
<span class="function">usort</span>(<span class="variable">$users</span>, <span class="keyword">fn</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) => <span class="variable">$a</span>[<span class="string">'age'</span>] <=> <span class="variable">$b</span>[<span class="string">'age'</span>]);

<span class="comment">// ❌ ВАЖНО: НЕ используйте $a - $b как компаратор!
// Работает для int, но ломается для float (теряется точность дробей)
// и для больших чисел (integer overflow). &lt;=&gt; — безопасно всегда.</span>
<span class="function">usort</span>(<span class="variable">$arr</span>, <span class="keyword">fn</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) => <span class="variable">$a</span> - <span class="variable">$b</span>);    <span class="comment">// ❌ хрупко</span>
<span class="function">usort</span>(<span class="variable">$arr</span>, <span class="keyword">fn</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) => <span class="variable">$a</span> <=> <span class="variable">$b</span>);   <span class="comment">// ✓ правильно</span></code></pre>

                    <div class="example-label">Сортировка по возрастанию и убыванию — поменять операнды</div>
                    <pre><code><span class="comment">// По возрастанию (ASC): $a слева, $b справа</span>
<span class="function">usort</span>(<span class="variable">$users</span>, <span class="keyword">fn</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) => <span class="variable">$a</span>[<span class="string">'age'</span>] <=> <span class="variable">$b</span>[<span class="string">'age'</span>]);
<span class="comment">// 25, 28, 30</span>

<span class="comment">// По убыванию (DESC): поменять местами $a и $b</span>
<span class="function">usort</span>(<span class="variable">$users</span>, <span class="keyword">fn</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) => <span class="variable">$b</span>[<span class="string">'age'</span>] <=> <span class="variable">$a</span>[<span class="string">'age'</span>]);
<span class="comment">// 30, 28, 25

// Альтернатива — умножить результат на -1 (читается хуже):</span>
<span class="function">usort</span>(<span class="variable">$users</span>, <span class="keyword">fn</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) => -(<span class="variable">$a</span>[<span class="string">'age'</span>] <=> <span class="variable">$b</span>[<span class="string">'age'</span>]));</code></pre>

                    <div class="example-label">Multi-criteria сортировка через цепочку &lt;=&gt; и ?:</div>
                    <pre><code><span class="comment">// Сортировать сначала по возрасту, потом по имени.
// Идея: первое не-нулевое &lt;=&gt; и есть итоговый результат.
// ?: — короткий тернарный (Elvis): если левая часть truthy — её, иначе правую.</span>

<span class="function">usort</span>(<span class="variable">$users</span>, <span class="keyword">fn</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) =>
    (<span class="variable">$a</span>[<span class="string">'age'</span>] <=> <span class="variable">$b</span>[<span class="string">'age'</span>])
    ?: (<span class="variable">$a</span>[<span class="string">'name'</span>] <=> <span class="variable">$b</span>[<span class="string">'name'</span>])
);

<span class="comment">// Логика:
// — если возрасты разные (&lt;=&gt; вернёт -1 или 1) — итог это значение
// — если равны (&lt;=&gt; вернёт 0, что falsy) — переходим к сравнению имён

// Для трёх критериев и больше:</span>
<span class="function">usort</span>(<span class="variable">$users</span>, <span class="keyword">fn</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) =>
    (<span class="variable">$a</span>[<span class="string">'department'</span>] <=> <span class="variable">$b</span>[<span class="string">'department'</span>])
    ?: (<span class="variable">$b</span>[<span class="string">'salary'</span>] <=> <span class="variable">$a</span>[<span class="string">'salary'</span>])    <span class="comment">// salary DESC (b vs a)</span>
    ?: (<span class="variable">$a</span>[<span class="string">'name'</span>] <=> <span class="variable">$b</span>[<span class="string">'name'</span>])
);
<span class="comment">// Сначала по отделу (ASC), внутри отдела по зарплате (DESC), внутри по имени (ASC)</span></code></pre>

                    <div class="remember-box">
                        <strong>Связанные функции сортировки в PHP:</strong><br>
                        <code>usort</code> &mdash; пользовательский компаратор, теряет ключи (переиндексирует 0..N).<br>
                        <code>uasort</code> &mdash; то же, но <strong>сохраняет ключи</strong> (Associative).<br>
                        <code>uksort</code> &mdash; сортирует <strong>по ключам</strong>, не по значениям.<br>
                        <code>sort</code> / <code>rsort</code> &mdash; быстрая сортировка без callback (ASC/DESC).<br>
                        <code>ksort</code> / <code>krsort</code> &mdash; по ключам без callback.<br>
                        В Laravel Collection: <code>$c-&gt;sortBy('age')</code>, <code>$c-&gt;sortByDesc('age')</code>, <code>$c-&gt;sortBy(fn($u) =&gt; ...)</code> &mdash; идиоматично, сохраняет ключи.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">array_column, array_combine и другие</h3>
                    <div class="example-label">Полезные функции</div>
                    <pre><code><span class="comment">// array_column - извлечь столбец из многомерного массива</span>
<span class="variable">$users</span> = [
    [<span class="string">'id'</span> => <span class="number">1</span>, <span class="string">'name'</span> => <span class="string">'Alice'</span>, <span class="string">'age'</span> => <span class="number">30</span>],
    [<span class="string">'id'</span> => <span class="number">2</span>, <span class="string">'name'</span> => <span class="string">'Bob'</span>, <span class="string">'age'</span> => <span class="number">28</span>]
];
<span class="variable">$names</span> = <span class="function">array_column</span>(<span class="variable">$users</span>, <span class="string">'name'</span>);
<span class="comment">// ['Alice', 'Bob']</span>

<span class="variable">$indexed</span> = <span class="function">array_column</span>(<span class="variable">$users</span>, <span class="string">'name'</span>, <span class="string">'id'</span>);
<span class="comment">// [1 => 'Alice', 2 => 'Bob']</span>

<span class="comment">// array_combine - создать массив с ключами и значениями</span>
<span class="variable">$keys</span> = [<span class="string">'a'</span>, <span class="string">'b'</span>, <span class="string">'c'</span>];
<span class="variable">$values</span> = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="variable">$result</span> = <span class="function">array_combine</span>(<span class="variable">$keys</span>, <span class="variable">$values</span>);
<span class="comment">// ['a' => 1, 'b' => 2, 'c' => 3]</span>

<span class="comment">// array_merge - объединить массивы</span>
<span class="variable">$arr1</span> = [<span class="string">'a'</span> => <span class="number">1</span>];
<span class="variable">$arr2</span> = [<span class="string">'b'</span> => <span class="number">2</span>];
<span class="variable">$merged</span> = <span class="function">array_merge</span>(<span class="variable">$arr1</span>, <span class="variable">$arr2</span>);
<span class="comment">// ['a' => 1, 'b' => 2]</span>

<span class="comment">// array_values и array_keys</span>
<span class="variable">$data</span> = [<span class="string">'name'</span> => <span class="string">'Alice'</span>, <span class="string">'age'</span> => <span class="number">30</span>];
<span class="variable">$values</span> = <span class="function">array_values</span>(<span class="variable">$data</span>);  <span class="comment">// ['Alice', 30]</span>
<span class="variable">$keys</span> = <span class="function">array_keys</span>(<span class="variable">$data</span>);    <span class="comment">// ['name', 'age']</span></code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Spread Operator и Destructuring</h3>
                    <div class="example-label">Spread Operator и распаковка</div>
                    <pre><code><span class="comment">// Spread operator ... для распаковки массива</span>
<span class="variable">$arr1</span> = [<span class="number">1</span>, <span class="number">2</span>];
<span class="variable">$arr2</span> = [<span class="number">3</span>, <span class="number">4</span>];
<span class="variable">$merged</span> = [...<span class="variable">$arr1</span>, ...<span class="variable">$arr2</span>];
<span class="comment">// [1, 2, 3, 4]</span>

<span class="comment">// Распаковка в функцию</span>
<span class="keyword">function</span> <span class="function">sum</span>(<span class="variable">$a</span>, <span class="variable">$b</span>, <span class="variable">$c</span>) {
    <span class="keyword">return</span> <span class="variable">$a</span> + <span class="variable">$b</span> + <span class="variable">$c</span>;
}
<span class="variable">$numbers</span> = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="keyword">echo</span> <span class="function">sum</span>(...<span class="variable">$numbers</span>);  <span class="comment">// 6</span>

<span class="comment">// Array destructuring (распаковка в переменные)</span>
[<span class="variable">$first</span>, <span class="variable">$second</span>] = [<span class="number">10</span>, <span class="number">20</span>];
<span class="comment">// $first = 10, $second = 20</span>

<span class="comment">// С ассоциативными массивами</span>
[<span class="string">'name'</span> => <span class="variable">$name</span>, <span class="string">'age'</span> => <span class="variable">$age</span>] = [<span class="string">'name'</span> => <span class="string">'Alice'</span>, <span class="string">'age'</span> => <span class="number">30</span>];
<span class="comment">// $name = 'Alice', $age = 30</span>

<span class="comment">// Пропустить элементы</span>
[<span class="variable">$first</span>, , <span class="variable">$third</span>] = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="comment">// $first = 1, $third = 3 (второй элемент пропущен)</span>

<span class="comment">// Практический пример - распаковать функцию в параметры</span>
<span class="variable">$userIds</span> = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="function">User</span>::<span class="function">whereIn</span>(<span class="string">'id'</span>, <span class="variable">$userIds</span>)-><span class="function">get</span>();</code></pre>
                </div>
            </div>

            <!-- SECTION 4: ООП BASICS -->
            <div id="oop-basics" class="section">
                <h2 class="section-title">4. ООП: Классы, Наследование, Полиморфизм</h2>

                <div class="subsection">
                    <h3 class="subsection-title">$this — ссылка на текущий объект</h3>
                    <div class="content-block">
                        <code>$this</code> &mdash; <strong>псевдо-переменная</strong>, доступная внутри любого нестатического метода класса. Она ссылается на <strong>тот объект, у которого сейчас вызывается метод</strong>. Через <code>$this-&gt;имя</code> читаются и записываются свойства, через <code>$this-&gt;метод()</code> вызываются другие методы того же объекта.
                    </div>

                    <div class="example-label">Простой пример с конструктором</div>
                    <pre><code><span class="keyword">class</span> <span class="function">User</span> {
    <span class="keyword">public</span> <span class="variable">$name</span>;
    <span class="keyword">public</span> <span class="variable">$email</span>;

    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="variable">$name</span>, <span class="variable">$email</span>) {
        <span class="variable">$this</span>-><span class="variable">name</span>  = <span class="variable">$name</span>;     <span class="comment">// свойство объекта = аргумент</span>
        <span class="variable">$this</span>-><span class="variable">email</span> = <span class="variable">$email</span>;
    }
}

<span class="variable">$user</span> = <span class="keyword">new</span> <span class="function">User</span>(<span class="string">"Alice"</span>, <span class="string">"alice@ex.com"</span>);
<span class="comment">// Внутри __construct $this === $user (тот объект, который создаётся)</span></code></pre>

                    <div class="content-block">
                        <strong>Зачем нужен $this</strong>: без него PHP не различит локальную переменную метода и свойство объекта. <code>$name</code> &mdash; локальная переменная (аргумент или просто объявленная в методе). <code>$this-&gt;name</code> &mdash; свойство объекта. Это разные сущности с одинаковым именем.
                    </div>

                    <div class="example-label">$name vs $this->name — разные вещи</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Greeter</span> {
    <span class="keyword">public</span> <span class="variable">$name</span> = <span class="string">"Default"</span>;

    <span class="keyword">public function</span> <span class="function">test</span>(<span class="variable">$name</span>) {
        <span class="keyword">echo</span> <span class="variable">$name</span>;          <span class="comment">// локальная переменная-аргумент</span>
        <span class="keyword">echo</span> <span class="variable">$this</span>-><span class="variable">name</span>;    <span class="comment">// свойство объекта ("Default")</span>

        <span class="variable">$this</span>-><span class="variable">name</span> = <span class="variable">$name</span>;  <span class="comment">// присвоить аргумент в свойство</span>
    }
}

<span class="variable">$g</span> = <span class="keyword">new</span> <span class="function">Greeter</span>();
<span class="variable">$g</span>-><span class="function">test</span>(<span class="string">"Alice"</span>);   <span class="comment">// выведет "AliceDefault", потом установит свойство</span></code></pre>

                    <div class="example-label">$this для вызова других методов того же объекта</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Order</span> {
    <span class="keyword">private</span> <span class="keyword">array</span> <span class="variable">$items</span> = [];

    <span class="keyword">public function</span> <span class="function">addItem</span>(<span class="variable">$item</span>): <span class="keyword">void</span> {
        <span class="variable">$this</span>-><span class="variable">items</span>[] = <span class="variable">$item</span>;
    }

    <span class="keyword">public function</span> <span class="function">total</span>(): <span class="keyword">int</span> {
        <span class="keyword">return</span> <span class="function">array_sum</span>(<span class="variable">$this</span>-><span class="variable">items</span>);
    }

    <span class="keyword">public function</span> <span class="function">summary</span>(): <span class="keyword">string</span> {
        <span class="comment">// $this-&gt;total() — вызов другого метода ЭТОГО ЖЕ объекта</span>
        <span class="keyword">return</span> <span class="string">"Items: "</span> . <span class="function">count</span>(<span class="variable">$this</span>-><span class="variable">items</span>) . <span class="string">", total: "</span> . <span class="variable">$this</span>-><span class="function">total</span>();
    }
}</code></pre>

                    <div class="example-label">return $this — fluent interface (method chaining)</div>
                    <pre><code><span class="keyword">class</span> <span class="function">QueryBuilder</span> {
    <span class="keyword">private array</span> <span class="variable">$where</span> = [];
    <span class="keyword">private</span> <span class="keyword">?int</span> <span class="variable">$limit</span> = <span class="keyword">null</span>;

    <span class="keyword">public function</span> <span class="function">where</span>(<span class="keyword">string</span> <span class="variable">$col</span>, <span class="variable">$value</span>): <span class="keyword">self</span> {
        <span class="variable">$this</span>-><span class="variable">where</span>[<span class="variable">$col</span>] = <span class="variable">$value</span>;
        <span class="keyword">return</span> <span class="variable">$this</span>;          <span class="comment">// ← возвращаем сам объект</span>
    }

    <span class="keyword">public function</span> <span class="function">limit</span>(<span class="keyword">int</span> <span class="variable">$n</span>): <span class="keyword">self</span> {
        <span class="variable">$this</span>-><span class="variable">limit</span> = <span class="variable">$n</span>;
        <span class="keyword">return</span> <span class="variable">$this</span>;
    }
}

<span class="comment">// Благодаря return $this — можно цепочкой:</span>
<span class="variable">$users</span> = (<span class="keyword">new</span> <span class="function">QueryBuilder</span>())
    -><span class="function">where</span>(<span class="string">'status'</span>, <span class="string">'active'</span>)
    -><span class="function">where</span>(<span class="string">'age'</span>, <span class="number">18</span>)
    -><span class="function">limit</span>(<span class="number">10</span>);

<span class="comment">// Так работают Laravel Query Builder, Eloquent, Collection, и пр.:
// User::where('id', 1)->with('orders')->first() — каждый метод возвращает $this</span></code></pre>

                    <div class="example-label">Где $this НЕ доступен</div>
                    <pre><code><span class="comment">// 1. В static-методах — нет «текущего объекта», метод принадлежит классу</span>
<span class="keyword">class</span> <span class="function">Calculator</span> {
    <span class="keyword">public static function</span> <span class="function">add</span>(<span class="keyword">int</span> <span class="variable">$a</span>, <span class="keyword">int</span> <span class="variable">$b</span>): <span class="keyword">int</span> {
        <span class="keyword">return</span> <span class="variable">$a</span> + <span class="variable">$b</span>;
        <span class="comment">// $this здесь — fatal error "Using $this when not in object context"</span>
    }
}
<span class="function">Calculator</span>::<span class="function">add</span>(<span class="number">2</span>, <span class="number">3</span>);   <span class="comment">// вызов без объекта</span>

<span class="comment">// 2. В обычных функциях вне класса</span>
<span class="keyword">function</span> <span class="function">helper</span>() {
    <span class="keyword">echo</span> <span class="variable">$this</span>;        <span class="comment">// fatal error</span>
}

<span class="comment">// 3. В замыканиях по умолчанию — но можно через Closure::bind</span>
<span class="variable">$closure</span> = <span class="keyword">function</span>() { <span class="keyword">echo</span> <span class="variable">$this</span>-><span class="variable">name</span>; };
<span class="variable">$closure</span>();   <span class="comment">// undefined $this

// Решение — bind замыкания к объекту:</span>
<span class="variable">$bound</span> = <span class="type">Closure</span>::<span class="function">bind</span>(<span class="variable">$closure</span>, <span class="variable">$user</span>, <span class="function">User</span>::<span class="keyword">class</span>);
<span class="variable">$bound</span>();    <span class="comment">// "Alice"</span></code></pre>

                    <div class="example-label">Альтернатива в современном PHP — constructor property promotion (8.0+)</div>
                    <pre><code><span class="comment">// До PHP 8.0 — boilerplate с $this в конструкторе:</span>
<span class="keyword">class</span> <span class="function">User</span> {
    <span class="keyword">public</span> <span class="variable">$name</span>;
    <span class="keyword">public</span> <span class="variable">$email</span>;

    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="variable">$name</span>, <span class="variable">$email</span>) {
        <span class="variable">$this</span>-><span class="variable">name</span>  = <span class="variable">$name</span>;     <span class="comment">// повторение 3 раза:</span>
        <span class="variable">$this</span>-><span class="variable">email</span> = <span class="variable">$email</span>;   <span class="comment">// объявление, аргумент, присвоение</span>
    }
}

<span class="comment">// С PHP 8.0+ — promoted properties (объявление + присвоение в одной строке):</span>
<span class="keyword">class</span> <span class="function">User</span> {
    <span class="keyword">public function</span> <span class="function">__construct</span>(
        <span class="keyword">public string</span> <span class="variable">$name</span>,
        <span class="keyword">public string</span> <span class="variable">$email</span>,
    ) {}    <span class="comment">// тело пустое — PHP сам делает $this-&gt;name = $name</span>
}

<span class="comment">// Можно совмещать с readonly (PHP 8.1+) — иммутабельные DTO:</span>
<span class="keyword">final class</span> <span class="function">UserDto</span> {
    <span class="keyword">public function</span> <span class="function">__construct</span>(
        <span class="keyword">public readonly string</span> <span class="variable">$name</span>,
        <span class="keyword">public readonly string</span> <span class="variable">$email</span>,
    ) {}
}</code></pre>

                    <div class="remember-box">
                        <strong>Чек-лист по $this:</strong><br>
                        ✓ Внутри нестатических методов класса &mdash; обращайтесь к свойствам и методам через <code>$this-&gt;</code>.<br>
                        ✓ В конструкторе &mdash; <code>$this-&gt;поле = $аргумент</code> присваивает значение свойству объекта.<br>
                        ✓ <code>return $this</code> в setter'ах &mdash; даёт fluent interface (method chaining).<br>
                        ✗ В static-методах <code>$this</code> отсутствует &mdash; используйте <code>self::</code> или <code>static::</code> для доступа к классу.<br>
                        ✗ В замыканиях по умолчанию нет &mdash; используйте <code>Closure::bind</code> или стрелочные функции (<code>fn() =&gt; $this-&gt;x</code> внутри метода захватят <code>$this</code> автоматически).<br>
                        💡 С PHP 8.0+ для конструкторов используйте <strong>promoted properties</strong> &mdash; короче и без повторов.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Static, self, static:: — классовые члены</h3>
                    <div class="content-block">
                        <strong>Static</strong> (статические свойства и методы) принадлежат <strong>самому классу</strong>, а не отдельным объектам. Они существуют в единственном экземпляре независимо от того, сколько объектов создано. Вызываются через оператор <code>::</code> без <code>new</code>.
                        <br><br>
                        <code>self</code> и <code>static</code> &mdash; два способа сослаться на класс изнутри его кода. Разница между ними проявляется при наследовании.
                    </div>

                    <div class="example-label">Базовый пример: счётчик через static</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Counter</span> {
    <span class="keyword">public static</span> <span class="variable">$count</span> = <span class="number">0</span>;       <span class="comment">// статическое свойство</span>

    <span class="keyword">public static function</span> <span class="function">increment</span>(): <span class="keyword">void</span> {
        <span class="keyword">self</span>::<span class="variable">$count</span>++;                     <span class="comment">// доступ через self::</span>
    }

    <span class="keyword">public static function</span> <span class="function">getCount</span>(): <span class="keyword">int</span> {
        <span class="keyword">return</span> <span class="keyword">self</span>::<span class="variable">$count</span>;
    }
}

<span class="comment">// Вызов через :: без new — объект не создаётся</span>
<span class="function">Counter</span>::<span class="function">increment</span>();
<span class="function">Counter</span>::<span class="function">increment</span>();
<span class="keyword">echo</span> <span class="function">Counter</span>::<span class="function">getCount</span>();    <span class="comment">// 2

// Counter::$count живёт на уровне класса.
// Если бы это было обычное свойство — у каждого объекта свой счётчик.
// Со static — один счётчик на всё приложение.</span></code></pre>

                    <div class="example-label">Оператор :: (Scope Resolution Operator, «Paamayim Nekudotayim»)</div>
                    <pre><code><span class="comment">// Доступ через :: применяется для:

// 1. Статических методов и свойств</span>
<span class="function">ClassName</span>::<span class="function">staticMethod</span>();
<span class="function">ClassName</span>::<span class="variable">$staticProperty</span>;

<span class="comment">// 2. Констант класса (всегда через ::, даже у объекта)</span>
<span class="function">ClassName</span>::<span class="variable">CONSTANT_NAME</span>;
<span class="function">User</span>::<span class="variable">STATUS_ACTIVE</span>;

<span class="comment">// 3. Псевдо-классов: self::, parent::, static::</span>
<span class="keyword">self</span>::<span class="function">method</span>();        <span class="comment">// текущий класс (раннее связывание)</span>
<span class="keyword">parent</span>::<span class="function">method</span>();      <span class="comment">// родительский класс</span>
<span class="keyword">static</span>::<span class="function">method</span>();      <span class="comment">// фактический класс при вызове (LSB)</span>

<span class="comment">// 4. ::class — получить полное имя класса как строку (PHP 5.5+)</span>
<span class="keyword">echo</span> <span class="function">User</span>::<span class="keyword">class</span>;        <span class="comment">// "App\Models\User"</span>

<span class="comment">// Историческое название "::" — Paamayim Nekudotayim (ивр. «двойное двоеточие»);
// если PHP выдаст ошибку "Paamayim Nekudotayim" — это синтаксическая ошибка с ::</span></code></pre>

                    <div class="example-label">self:: vs static:: — главное отличие (Late Static Binding)</div>
                    <pre><code><span class="keyword">class</span> <span class="function">ParentClass</span> {
    <span class="keyword">public static function</span> <span class="function">testSelf</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="keyword">self</span>::<span class="function">who</span>();      <span class="comment">// раннее связывание</span>
    }

    <span class="keyword">public static function</span> <span class="function">testStatic</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="keyword">static</span>::<span class="function">who</span>();    <span class="comment">// позднее (Late Static Binding)</span>
    }

    <span class="keyword">public static function</span> <span class="function">who</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="variable">__CLASS__</span>;        <span class="comment">// магическая константа: имя текущего класса</span>
    }
}

<span class="keyword">class</span> <span class="function">ChildClass</span> <span class="keyword">extends</span> <span class="function">ParentClass</span> {
    <span class="keyword">public static function</span> <span class="function">who</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="variable">__CLASS__</span>;
    }
}

<span class="keyword">echo</span> <span class="function">ChildClass</span>::<span class="function">testSelf</span>();    <span class="comment">// "ParentClass"  ← зафиксировано в parent</span>
<span class="keyword">echo</span> <span class="function">ChildClass</span>::<span class="function">testStatic</span>();  <span class="comment">// "ChildClass"   ← фактический класс вызова</span>

<span class="comment">// Объяснение:
// self::who() в ParentClass — намертво привязано к ParentClass.
//   Кто бы ни вызывал — всегда parent's who().
// static::who() — динамически определяется во время выполнения.
//   Если вызвано через ChildClass:: — найдёт ChildClass::who().
// Это и есть Late Static Binding (LSB), появился в PHP 5.3.</span></code></pre>

                    <div class="content-block">
                        <strong>Пошаговый трейс &mdash; что именно происходит при <code>ChildClass::testSelf()</code>.</strong> Метод <code>testSelf()</code> определён <em>только</em> в <code>ParentClass</code>. Внутри него &mdash; вызов <code>self::who()</code>. <code>self</code> &mdash; это «класс, в котором физически написан этот код», то есть <code>ParentClass</code>. Поэтому PHP идёт в <code>ParentClass</code> и берёт <code>who()</code> именно оттуда (возвращает <code>'Parent'</code>), <strong>игнорируя</strong> переопределённый <code>who()</code> в <code>ChildClass</code>.
                    </div>

                    <div class="example-label">Шаги выполнения ChildClass::testSelf()</div>
                    <pre><code><span class="comment">┌─────────────────────────────────────────────────────────────┐
│ 1. PHP видит вызов: ChildClass::testSelf()                  │
│ 2. Ищет метод testSelf() в ChildClass — НЕТ                 │
│ 3. Поднимается к родителю ParentClass — НАШЁЛ               │
│ 4. Выполняет код тела: return self::who();                  │
│ 5. self → ParentClass (класс ГДЕ ЭТОТ КОД написан)          │
│ 6. Вызывает ParentClass::who() → возвращает 'Parent'        │
│ 7. Итог: echo выводит "Parent"                              │
└─────────────────────────────────────────────────────────────┘

Ключевая мысль: self смотрит на ТЕКСТ кода (где написано),
              а не на КЛАСС, через который сделан вызов.

Метод "переехал" в ChildClass через наследование, но self
по-прежнему указывает на ParentClass — потому что строчка
self::who() физически находится в файле ParentClass.</span></code></pre>

                    <div class="example-label">Для контраста — шаги ChildClass::testStatic()</div>
                    <pre><code><span class="comment">┌─────────────────────────────────────────────────────────────┐
│ 1. Вызов: ChildClass::testStatic()                          │
│ 2. testStatic() найден в ParentClass (унаследован)          │
│ 3. Выполняется: return static::who();                       │
│ 4. static → ЧТО было слева от :: при вызове = ChildClass    │
│ 5. Ищет who() в ChildClass — НАШЁЛ (переопределён)          │
│ 6. Вызывает ChildClass::who() → возвращает 'Child'          │
│ 7. Итог: echo выводит "Child"                               │
└─────────────────────────────────────────────────────────────┘

Ключевая разница: static — это «класс, через который начался вызов»,
                  а не класс, где написан код.
                  PHP запоминает ChildClass с шага 1
                  и подставляет его в static:: на шаге 4.</span></code></pre>

                    <div class="content-block">
                        <strong>Аналогия:</strong>
                        <ul class="bullets" style="margin-top:6px;">
                          <li><code>self</code> &mdash; как <em>почтовый адрес отправителя</em> на конверте: указан автором письма, не меняется кто бы письмо ни читал. Адрес = «где я писал».</li>
                          <li><code>static</code> &mdash; как <em>каждый раз заново звонящий курьер</em>: смотрит на наклейку «кому» прямо сейчас. Адрес = «кто вызвал».</li>
                        </ul>
                    </div>

                    <div class="example-label">Что было бы, если бы testSelf() был объявлен в ChildClass</div>
                    <pre><code><span class="keyword">class</span> <span class="function">ChildClass</span> <span class="keyword">extends</span> <span class="function">ParentClass</span> {
    <span class="comment">// Если переопределить testSelf() здесь:</span>
    <span class="keyword">public static function</span> <span class="function">testSelf</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="keyword">self</span>::<span class="function">who</span>();    <span class="comment">// теперь self = ChildClass!</span>
    }

    <span class="keyword">public static function</span> <span class="function">who</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="string">'Child'</span>;
    }
}

<span class="keyword">echo</span> <span class="function">ChildClass</span>::<span class="function">testSelf</span>();   <span class="comment">// "Child"
// Потому что self::who() теперь написан внутри ChildClass.
// Главное правило: self указывает на класс, где БУКВАЛЬНО лежит строчка с self.</span></code></pre>

                    <div class="content-block">
                        <strong>Что значит «полиморфный» в контексте <code>static::</code>.</strong> Метод <code>getTableLate()</code> ведёт себя <em>по-разному в зависимости от того, через какой класс его вызвали</em>, даже если сам определён в родителе. Достигается за счёт <code>static::</code> &mdash; он указывает на класс, через который произошёл вызов во время выполнения (Late Static Binding). С обычным <code>self::</code> такого эффекта нет: значение всегда берётся из класса, где написан код.
                    </div>

                    <div class="example-label">Полиморфизм через static:: на переопределяемом свойстве</div>
                    <pre><code><span class="keyword">class</span> <span class="function">BaseModel</span> {
    <span class="keyword">public static</span> <span class="variable">$table</span> = <span class="string">'base'</span>;

    <span class="keyword">public static function</span> <span class="function">getTable</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="keyword">self</span>::<span class="variable">$table</span>;     <span class="comment">// self → всегда BaseModel</span>
    }

    <span class="keyword">public static function</span> <span class="function">getTableLate</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="keyword">static</span>::<span class="variable">$table</span>;   <span class="comment">// static → класс, через который вызвано</span>
    }
}

<span class="keyword">class</span> <span class="function">UserModel</span> <span class="keyword">extends</span> <span class="function">BaseModel</span> {
    <span class="keyword">public static</span> <span class="variable">$table</span> = <span class="string">'users'</span>;    <span class="comment">// переопределили</span>
}

<span class="keyword">echo</span> <span class="function">BaseModel</span>::<span class="function">getTable</span>();      <span class="comment">// "base"  — self::$table → BaseModel::$table</span>
<span class="keyword">echo</span> <span class="function">BaseModel</span>::<span class="function">getTableLate</span>();  <span class="comment">// "base"  — static = BaseModel (вызвали от BaseModel)</span>

<span class="keyword">echo</span> <span class="function">UserModel</span>::<span class="function">getTable</span>();      <span class="comment">// "base"  ⚠ self заблокирован на BaseModel</span>
<span class="keyword">echo</span> <span class="function">UserModel</span>::<span class="function">getTableLate</span>();  <span class="comment">// "users" ✓ static подхватил UserModel::$table</span></code></pre>

                    <div class="example-label">Что именно происходит — таблица</div>
                    <pre><code><span class="comment">+--------------------------------+------+--------------+----------+
| Вызов                          | self | static       | Результат|
+--------------------------------+------+--------------+----------+
| BaseModel::getTable()          | Base | (не использ) | "base"   |
| BaseModel::getTableLate()      | —    | BaseModel    | "base"   |
| UserModel::getTable()          | Base | (не использ) | "base" ⚠ |
| UserModel::getTableLate()      | —    | UserModel    | "users" ✓|
+--------------------------------+------+--------------+----------+

Колонка "self" — какой класс PHP подставляет под self при выполнении
                 (всегда тот, где написан код = BaseModel).
Колонка "static" — какой класс подставляется под static
                  (тот, через который начали вызов).

⚠ UserModel::getTable() возвращает "base" — частая ловушка.
   Программист переопределил $table в UserModel, ожидая что метод
   подхватит новое значение. Но getTable() жёстко смотрит на
   BaseModel::$table из-за self.
✓ Чтобы наследники работали полиморфно — пишите static:: в базовом
   классе для всего, что наследники могут переопределять.</span></code></pre>

                    <div class="content-block">
                        <strong>Связь с Eloquent.</strong> Именно поэтому Laravel <code>Model::find($id)</code> внутри использует <code>new static()</code>, а свойства типа <code>$table</code>, <code>$primaryKey</code>, <code>$fillable</code> читаются через <code>static::</code>. Это позволяет наследникам (<code>User extends Model</code>) переопределить <code>$table = 'users'</code> &mdash; и базовые методы родителя автоматически начинают работать с правильной таблицей. Без LSB пришлось бы переопределять <em>каждый</em> метод в каждом наследнике.
                    </div>

                    <div class="example-label">Краткая формула</div>
                    <pre><code><span class="comment">self::    → НЕ полиморфно: всегда берёт из класса, где написан код.
            Удобно когда вы УВЕРЕНЫ что наследники не переопределят.

static::  → ПОЛИМОРФНО: берёт из класса, через который вызвали.
            Используйте в базовом классе для всего, что наследники
            могут менять: $table, $primaryKey, фабричные new static(),
            override-методы вроде find/all/firstOrFail.</span></code></pre>

                    <div class="example-label">Практический пример: Factory method в Laravel Eloquent</div>
                    <pre><code><span class="comment">// В Eloquent почти все статические методы используют static:: чтобы работать с наследниками</span>

<span class="keyword">class</span> <span class="function">Model</span> {
    <span class="keyword">public static function</span> <span class="function">find</span>(<span class="keyword">int</span> <span class="variable">$id</span>): <span class="keyword">?</span><span class="keyword">static</span> {
        <span class="comment">// псевдо-код: достать из БД</span>
        <span class="variable">$row</span> = <span class="function">DB</span>::<span class="function">findRow</span>(<span class="variable">$id</span>);
        <span class="keyword">return</span> <span class="variable">$row</span> ? <span class="keyword">new</span> <span class="keyword">static</span>(<span class="variable">$row</span>) : <span class="keyword">null</span>;
        <span class="comment">//          ↑ new static() — создаёт экземпляр фактического класса</span>
    }
}

<span class="keyword">class</span> <span class="function">User</span> <span class="keyword">extends</span> <span class="function">Model</span> {}
<span class="keyword">class</span> <span class="function">Admin</span> <span class="keyword">extends</span> <span class="function">User</span> {}

<span class="variable">$user</span>  = <span class="function">User</span>::<span class="function">find</span>(<span class="number">1</span>);      <span class="comment">// возвращает User</span>
<span class="variable">$admin</span> = <span class="function">Admin</span>::<span class="function">find</span>(<span class="number">5</span>);     <span class="comment">// возвращает Admin (не User!)</span>

<span class="comment">// Если бы в find() было new self() — всегда бы возвращался Model.
// new static() работает полиморфно — это ключ к Eloquent-фабрикам.</span></code></pre>

                    <div class="example-label">parent:: — вызов метода родителя</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Animal</span> {
    <span class="keyword">public function</span> <span class="function">describe</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="string">"Animal"</span>;
    }
}

<span class="keyword">class</span> <span class="function">Dog</span> <span class="keyword">extends</span> <span class="function">Animal</span> {
    <span class="keyword">public function</span> <span class="function">describe</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="keyword">parent</span>::<span class="function">describe</span>() . <span class="string">" → Dog"</span>;
        <span class="comment">// parent:: — явный вызов реализации родителя
        // Полезно когда переопределяешь метод, но хочешь сохранить базовое поведение</span>
    }
}

(<span class="keyword">new</span> <span class="function">Dog</span>())-><span class="function">describe</span>();   <span class="comment">// "Animal → Dog"

// В конструкторах parent::__construct() — стандартный способ
// инициализировать родителя перед своей логикой:</span>
<span class="keyword">class</span> <span class="function">SpecialUser</span> <span class="keyword">extends</span> <span class="function">User</span> {
    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="keyword">string</span> <span class="variable">$name</span>, <span class="keyword">int</span> <span class="variable">$level</span>) {
        <span class="keyword">parent</span>::<span class="function">__construct</span>(<span class="variable">$name</span>);   <span class="comment">// инициализация родителя</span>
        <span class="variable">$this</span>-><span class="variable">level</span> = <span class="variable">$level</span>;
    }
}</code></pre>

                    <div class="example-label">Константы класса — всегда через ::</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Order</span> {
    <span class="keyword">const</span> <span class="variable">STATUS_PENDING</span> = <span class="string">'pending'</span>;
    <span class="keyword">const</span> <span class="variable">STATUS_PAID</span>    = <span class="string">'paid'</span>;

    <span class="comment">// PHP 7.1+ — у констант есть видимость:</span>
    <span class="keyword">private const</span> <span class="variable">MAX_RETRIES</span> = <span class="number">3</span>;

    <span class="comment">// PHP 8.3+ — typed constants:</span>
    <span class="keyword">const int</span> <span class="variable">VERSION</span> = <span class="number">2</span>;
}

<span class="comment">// Доступ через :: (даже у объекта — не через ->):</span>
<span class="keyword">echo</span> <span class="function">Order</span>::<span class="variable">STATUS_PENDING</span>;     <span class="comment">// "pending"</span>

<span class="variable">$order</span> = <span class="keyword">new</span> <span class="function">Order</span>();
<span class="keyword">echo</span> <span class="variable">$order</span>::<span class="variable">STATUS_PAID</span>;       <span class="comment">// "paid" (тоже через :: после объекта)
// echo $order->STATUS_PAID;       — ❌ ошибка, через -> только свойства</span></code></pre>

                    <div class="example-label">Когда использовать static вообще</div>
                    <pre><code><span class="comment">// ✓ Утилитарные функции без состояния</span>
<span class="keyword">class</span> <span class="function">StringHelper</span> {
    <span class="keyword">public static function</span> <span class="function">slugify</span>(<span class="keyword">string</span> <span class="variable">$text</span>): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="function">strtolower</span>(<span class="function">str_replace</span>(<span class="string">' '</span>, <span class="string">'-'</span>, <span class="variable">$text</span>));
    }
}

<span class="comment">// ✓ Фабричные методы (named constructors)</span>
<span class="keyword">class</span> <span class="function">Date</span> {
    <span class="keyword">public static function</span> <span class="function">today</span>(): <span class="keyword">static</span> { <span class="keyword">return new</span> <span class="keyword">static</span>(<span class="function">date</span>(<span class="string">'Y-m-d'</span>)); }
    <span class="keyword">public static function</span> <span class="function">fromString</span>(<span class="keyword">string</span> <span class="variable">$s</span>): <span class="keyword">static</span> { <span class="keyword">return new</span> <span class="keyword">static</span>(<span class="variable">$s</span>); }
}

<span class="comment">// ✓ Константы (как enum-замена до PHP 8.1)</span>
<span class="keyword">class</span> <span class="function">HttpStatus</span> {
    <span class="keyword">const</span> <span class="variable">OK</span>        = <span class="number">200</span>;
    <span class="keyword">const</span> <span class="variable">NOT_FOUND</span> = <span class="number">404</span>;
}

<span class="comment">// ❌ НЕ для сервисов с состоянием — таблица плюсов/минусов:
// Static-сервис:                  Обычный сервис через DI:
//   — невозможно мокать в тестах    + легко мокать
//   — глобальное состояние          + изолированный state
//   — нельзя подменить реализацию   + interface + DI
//   + не надо передавать через DI   — нужно DI-контейнер

// В Laravel почти НИКОГДА не используют свои static-сервисы — все через
// контейнер. Static резервируется для фабрик (Model::find), хелперов
// и фасадов (хотя фасады тоже под капотом обращаются к контейнеру).</span></code></pre>

                    <div class="example-label">Подводные камни</div>
                    <pre><code><span class="comment">// 1. $this в static-методе → Fatal Error</span>
<span class="keyword">class</span> <span class="function">X</span> {
    <span class="keyword">public static function</span> <span class="function">f</span>() {
        <span class="keyword">echo</span> <span class="variable">$this</span>-><span class="variable">name</span>;   <span class="comment">// Fatal: Using $this when not in object context</span>
    }
}

<span class="comment">// 2. Свойства через -> вместо ::</span>
<span class="function">Counter</span>::<span class="variable">$count</span>++;     <span class="comment">// ✓ правильно</span>
<span class="variable">$counter</span> = <span class="keyword">new</span> <span class="function">Counter</span>();
<span class="variable">$counter</span>-><span class="variable">count</span>++;     <span class="comment">// ❌ ошибка — у объекта нет такого свойства,
                       //    статическое живёт на классе</span>

<span class="comment">// 3. Static в Octane / RoadRunner / Swoole — утечка состояния
// В обычном PHP-FPM статика сбрасывается с окончанием процесса.
// В long-running (Octane) статика живёт между запросами:</span>
<span class="keyword">class</span> <span class="function">UserCache</span> {
    <span class="keyword">private static array</span> <span class="variable">$cache</span> = [];   <span class="comment">// под Octane накапливается!</span>
}
<span class="comment">// Подробнее в KB_3 (Laravel → Octane).

// 4. self vs static в final-классах
// Если класс final (нельзя наследовать) — self и static идентичны.
// Разница только при наследовании.

// 5. Тестирование static — почти невозможно мокать
// StringHelper::slugify($x) в коде → в тестах нельзя подменить.
// Решение: сделать обычный сервис + interface, инжектить через DI.</span></code></pre>

                    <div class="example-label">Сравнительная таблица</div>
                    <pre><code><span class="comment">+----------------+-------------------------------+--------------------------+
| Конструкция    | Связывание                     | Когда использовать       |
+----------------+-------------------------------+--------------------------+
| self::         | Раннее (класс, где написано)  | Точно знаем класс,       |
|                |                                | не ждём подмены          |
| static::       | Позднее (LSB, класс вызова)   | Наследуемые статические  |
|                |                                | методы, фабрики          |
| parent::       | Родительский класс            | Вызов реализации parent  |
|                |                                | при переопределении      |
| $this->        | Текущий объект                 | Обычные методы           |
| ClassName::    | Явно указанный класс          | Из внешнего кода         |
+----------------+-------------------------------+--------------------------+</span></code></pre>

                    <div class="remember-box">
                        <strong>Короткие правила:</strong><br>
                        ✓ <code>self::</code> &mdash; когда вы пишете код, который не будет переопределяться в наследниках. Гарантия что вызывается именно этот класс.<br>
                        ✓ <code>static::</code> &mdash; в фабриках (<code>new static()</code>) и методах, которые наследники могут переопределить. Это Late Static Binding.<br>
                        ✓ <code>parent::</code> &mdash; чтобы дополнить (а не заменить) реализацию родителя; типично <code>parent::__construct()</code>.<br>
                        ✓ <code>ClassName::CONSTANT</code> &mdash; константы класса всегда через <code>::</code>, даже если у вас есть объект.<br>
                        ✗ Избегайте static-сервисов с состоянием &mdash; они не мокаются в тестах и текут под Octane.<br>
                        💡 С PHP 8.0+ <code>new static()</code> можно типизировать как <code>: static</code> в return type &mdash; явный полиморфизм для фабрик.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Видимость: public, protected, private</h3>
                    <div class="example-label">Access Modifiers</div>
                    <pre><code><span class="keyword">class</span> <span class="function">User</span> {
    <span class="comment">// public - доступно отовсюду (из класса, подклассов, и снаружи)</span>
    <span class="keyword">public</span> <span class="variable">$name</span>;

    <span class="comment">// protected - доступно в классе и подклассах, но НЕ снаружи</span>
    <span class="keyword">protected</span> <span class="variable">$email</span>;

    <span class="comment">// private - доступно ТОЛЬКО в этом классе</span>
    <span class="keyword">private</span> <span class="variable">$password</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="variable">$name</span>, <span class="variable">$email</span>, <span class="variable">$password</span>) {
        <span class="variable">$this</span>-><span class="variable">name</span> = <span class="variable">$name</span>;
        <span class="variable">$this</span>-><span class="variable">email</span> = <span class="variable">$email</span>;
        <span class="variable">$this</span>-><span class="variable">password</span> = <span class="variable">$password</span>;
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">getEmail</span>() {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">email</span>;  <span class="comment">// OK - внутри класса</span>
    }

    <span class="keyword">protected</span> <span class="keyword">function</span> <span class="function">verifyPassword</span>(<span class="variable">$pwd</span>) {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">password</span> === <span class="variable">$pwd</span>;  <span class="comment">// OK</span>
    }
}

<span class="variable">$user</span> = <span class="keyword">new</span> <span class="function">User</span>(<span class="string">"Alice"</span>, <span class="string">"alice@ex.com"</span>, <span class="string">"secret"</span>);
<span class="keyword">echo</span> <span class="variable">$user</span>-><span class="variable">name</span>;  <span class="comment">// OK - public</span>
<span class="keyword">echo</span> <span class="variable">$user</span>-><span class="variable">email</span>;  <span class="comment">// ERROR - protected</span>
<span class="keyword">echo</span> <span class="variable">$user</span>-><span class="variable">password</span>;  <span class="comment">// ERROR - private</span></code></pre>

                    <div class="remember-box">
                        Используй protected для данных которые должны быть доступны подклассам. Используй private для внутреннего состояния класса. Это важно для инкапсуляции и безопасности!
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Constructor Promotion (PHP 8)</h3>
                    <div class="example-label">Сокращенный синтаксис конструктора</div>
                    <pre><code><span class="comment">// Старый способ (PHP 7)</span>
<span class="keyword">class</span> <span class="function">User</span> {
    <span class="keyword">private</span> <span class="variable">$id</span>;
    <span class="keyword">private</span> <span class="variable">$name</span>;
    <span class="keyword">private</span> <span class="variable">$email</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">int</span> <span class="variable">$id</span>, <span class="keyword">string</span> <span class="variable">$name</span>, <span class="keyword">string</span> <span class="variable">$email</span>) {
        <span class="variable">$this</span>-><span class="variable">id</span> = <span class="variable">$id</span>;
        <span class="variable">$this</span>-><span class="variable">name</span> = <span class="variable">$name</span>;
        <span class="variable">$this</span>-><span class="variable">email</span> = <span class="variable">$email</span>;
    }
}

<span class="comment">// Новый способ (PHP 8 - Constructor Promotion)</span>
<span class="keyword">class</span> <span class="function">User</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(
        <span class="keyword">private</span> <span class="keyword">int</span> <span class="variable">$id</span>,
        <span class="keyword">private</span> <span class="keyword">string</span> <span class="variable">$name</span>,
        <span class="keyword">private</span> <span class="keyword">string</span> <span class="variable">$email</span>
    ) {}
}

<span class="comment">// Автоматически создает private свойства и присваивает их!</span>
<span class="variable">$user</span> = <span class="keyword">new</span> <span class="function">User</span>(<span class="number">1</span>, <span class="string">"Alice"</span>, <span class="string">"alice@ex.com"</span>);</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Static методы и свойства</h3>
                    <div class="example-label">Static в классах</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Counter</span> {
    <span class="keyword">public</span> <span class="keyword">static</span> <span class="variable">$count</span> = <span class="number">0</span>;

    <span class="keyword">public</span> <span class="keyword">static</span> <span class="keyword">function</span> <span class="function">increment</span>() {
        <span class="keyword">self</span>::<span class="variable">$count</span>++;
    }

    <span class="keyword">public</span> <span class="keyword">static</span> <span class="keyword">function</span> <span class="function">getCount</span>() {
        <span class="keyword">return</span> <span class="keyword">self</span>::<span class="variable">$count</span>;
    }
}

<span class="comment">// Вызывается через :: оператор, БЕЗ new</span>
<span class="function">Counter</span>::<span class="function">increment</span>();
<span class="function">Counter</span>::<span class="function">increment</span>();
<span class="keyword">echo</span> <span class="function">Counter</span>::<span class="function">getCount</span>();  <span class="comment">// 2</span>

<span class="comment">// Практический пример - Factory method в Laravel</span>
<span class="keyword">class</span> <span class="function">User</span> <span class="keyword">extends</span> <span class="function">Model</span> {
    <span class="keyword">public</span> <span class="keyword">static</span> <span class="keyword">function</span> <span class="function">findById</span>(<span class="keyword">int</span> <span class="variable">$id</span>) {
        <span class="keyword">return</span> <span class="variable">static</span>::<span class="function">find</span>(<span class="variable">$id</span>);
    }
}

<span class="comment">// Вызов</span>
<span class="variable">$user</span> = <span class="function">User</span>::<span class="function">findById</span>(<span class="number">1</span>);</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Late Static Binding: static:: vs self::</h3>
                    <div class="example-label">static:: и self::</div>
                    <pre><code><span class="keyword">class</span> <span class="function">BaseModel</span> {
    <span class="keyword">public</span> <span class="keyword">static</span> <span class="variable">$table</span> = <span class="string">'base'</span>;

    <span class="keyword">public</span> <span class="keyword">static</span> <span class="keyword">function</span> <span class="function">getTable</span>() {
        <span class="keyword">return</span> <span class="keyword">self</span>::<span class="variable">$table</span>;  <span class="comment">// ВСЕГДА вернет 'base'</span>
    }

    <span class="keyword">public</span> <span class="keyword">static</span> <span class="keyword">function</span> <span class="function">getTableLate</span>() {
        <span class="keyword">return</span> <span class="variable">static</span>::<span class="variable">$table</span>;  <span class="comment">// Полиморфно! Вернет значение вызывающего класса</span>
    }
}

<span class="keyword">class</span> <span class="function">User</span> <span class="keyword">extends</span> <span class="function">BaseModel</span> {
    <span class="keyword">public</span> <span class="keyword">static</span> <span class="variable">$table</span> = <span class="string">'users'</span>;
}

<span class="keyword">class</span> <span class="function">Post</span> <span class="keyword">extends</span> <span class="function">BaseModel</span> {
    <span class="keyword">public</span> <span class="keyword">static</span> <span class="variable">$table</span> = <span class="string">'posts'</span>;
}

<span class="function">User</span>::<span class="function">getTable</span>();      <span class="comment">// 'base' (self:: всегда указывает на BaseModel)</span>
<span class="function">User</span>::<span class="function">getTableLate</span>();  <span class="comment">// 'users' (static:: указывает на User)</span>

<span class="function">Post</span>::<span class="function">getTableLate</span>();  <span class="comment">// 'posts' (static:: указывает на Post)</span></code></pre>

                    <div class="remember-box">
                        Используй static:: для полиморфного поведения в подклассах, self:: когда нужно явно указать текущий класс. Это особенно важно в laravel Models и Factory паттернах!
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">final и readonly (PHP 8.1+)</h3>
                    <div class="example-label">final и readonly</div>
                    <pre><code><span class="keyword">class</span> <span class="function">BaseEntity</span> {
    <span class="comment">// final метод НЕ МОЖЕТ быть переопределен подклассом</span>
    <span class="keyword">final</span> <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">getId</span>() {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">id</span>;
    }
}

<span class="keyword">class</span> <span class="function">User</span> <span class="keyword">extends</span> <span class="function">BaseEntity</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">getId</span>() {  <span class="comment">// ERROR!</span>
    }
}

<span class="comment">// readonly свойства могут быть установлены ТОЛЬКО в конструкторе</span>
<span class="keyword">class</span> <span class="function">Product</span> {
    <span class="keyword">public</span> <span class="keyword">readonly</span> <span class="keyword">string</span> <span class="variable">$sku</span>;
    <span class="keyword">public</span> <span class="keyword">readonly</span> <span class="keyword">float</span> <span class="variable">$price</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">string</span> <span class="variable">$sku</span>, <span class="keyword">float</span> <span class="variable">$price</span>) {
        <span class="variable">$this</span>-><span class="variable">sku</span> = <span class="variable">$sku</span>;
        <span class="variable">$this</span>-><span class="variable">price</span> = <span class="variable">$price</span>;
    }
}

<span class="variable">$product</span> = <span class="keyword">new</span> <span class="function">Product</span>(<span class="string">"SKU123"</span>, <span class="number">99.99</span>);
<span class="variable">$product</span>-><span class="variable">price</span> = <span class="number">50</span>;  <span class="comment">// ERROR! readonly свойство</span></code></pre>

                    <div class="content-block">
                        <strong>final ≠ readonly &mdash; это разные концепции.</strong> Их часто путают, потому что оба «запрещают что-то менять». Но:
                        <ul class="bullets" style="margin-top:6px;">
                          <li><code>final</code> &mdash; запрещает <strong>переопределение в подклассе</strong> (для метода или класса целиком);</li>
                          <li><code>readonly</code> &mdash; запрещает <strong>изменение значения свойства</strong> после первой записи (обычно в конструкторе).</li>
                        </ul>
                        Они применяются к разным сущностям и решают разные задачи.
                    </div>

                    <div class="example-label">Сравнение в одной таблице</div>
                    <pre><code><span class="comment">+-------------+--------------------+------------------------------+
| Ключ. слово | К чему применяется | Что запрещает                |
+-------------+--------------------+------------------------------+
| final       | методы, классы     | переопределение метода       |
|             |                    | или наследование класса      |
| readonly    | свойства           | изменение свойства           |
|             |                    | после инициализации          |
+-------------+--------------------+------------------------------+

final НЕ влияет на свойства (нельзя сделать значения "неизменяемыми").
readonly НЕ влияет на методы (нельзя сделать "нельзя переопределить").</span></code></pre>

                    <div class="example-label">final class — нельзя даже наследовать</div>
                    <pre><code><span class="keyword">final class</span> <span class="function">Money</span> {           <span class="comment">// весь класс final</span>
    <span class="keyword">public function</span> <span class="function">__construct</span>(
        <span class="keyword">public readonly int</span>    <span class="variable">$amount</span>,
        <span class="keyword">public readonly string</span> <span class="variable">$currency</span>,
    ) {}
}

<span class="keyword">class</span> <span class="function">SpecialMoney</span> <span class="keyword">extends</span> <span class="function">Money</span> { }
<span class="comment">// Fatal error: Class SpecialMoney cannot extend final class Money

// Зачем final class:
// — Value Object (Money, Email, Date) — гарантия что никто не наследует и не сломает инвариант
// — Service classes в DDD/Hexagonal — явная декларация что класс закрыт для расширения
// — Защита от хрупких иерархий: лучше явный отказ от наследования, чем глубокое дерево классов</span></code></pre>

                    <div class="example-label">readonly можно «обойти» переопределением в подклассе</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Base</span> {
    <span class="keyword">public readonly int</span> <span class="variable">$id</span>;

    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="keyword">int</span> <span class="variable">$id</span>) {
        <span class="variable">$this</span>-><span class="variable">id</span> = <span class="variable">$id</span>;
    }
}

<span class="keyword">class</span> <span class="function">Child</span> <span class="keyword">extends</span> <span class="function">Base</span> {
    <span class="keyword">public int</span> <span class="variable">$id</span>;            <span class="comment">// переобъявили БЕЗ readonly</span>

    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="keyword">int</span> <span class="variable">$id</span>) {
        <span class="keyword">parent</span>::<span class="function">__construct</span>(<span class="variable">$id</span>);
        <span class="variable">$this</span>-><span class="variable">id</span> = <span class="number">999</span>;       <span class="comment">// ✓ теперь меняется, наследник убрал readonly</span>
    }
}

<span class="comment">// PHP 8.4+ ужесточил это правило: readonly свойство в дочернем классе
// обязательно должно остаться readonly. Полный обход через переобъявление
// в большинстве версий работает, но это запах архитектуры.

// Чтобы гарантированно защитить — комбинируйте:</span>
<span class="keyword">final class</span> <span class="function">UserId</span> {           <span class="comment">// final class — нельзя наследовать вообще</span>
    <span class="keyword">public function</span> <span class="function">__construct</span>(
        <span class="keyword">public readonly int</span> <span class="variable">$value</span>,   <span class="comment">// readonly — нельзя изменить</span>
    ) {}
}
<span class="comment">// Никто не сможет ни унаследовать, ни обойти readonly через переобъявление.</span></code></pre>

                    <div class="example-label">readonly class — PHP 8.2+</div>
                    <pre><code><span class="comment">// Помечает ВСЕ свойства класса как readonly одной декларацией:</span>
<span class="keyword">readonly class</span> <span class="function">Order</span> {
    <span class="keyword">public function</span> <span class="function">__construct</span>(
        <span class="keyword">public int</span>    <span class="variable">$id</span>,         <span class="comment">// автоматически readonly</span>
        <span class="keyword">public string</span> <span class="variable">$status</span>,     <span class="comment">// автоматически readonly</span>
        <span class="keyword">public int</span>    <span class="variable">$totalMinor</span>, <span class="comment">// автоматически readonly</span>
    ) {}
}

<span class="comment">// Эквивалентно:
// class Order {
//     public function __construct(
//         public readonly int $id,
//         public readonly string $status,
//         public readonly int $totalMinor,
//     ) {}
// }

// Удобно для immutable DTO. Часто комбинируют с final:</span>
<span class="keyword">final readonly class</span> <span class="function">OrderData</span> { ... }</code></pre>

                    <div class="remember-box">
                        <strong>Какое слово зачем:</strong><br>
                        — Хочешь, чтобы метод нельзя было переопределить → <code>final public function ...</code><br>
                        — Хочешь, чтобы весь класс нельзя было наследовать → <code>final class ...</code><br>
                        — Хочешь, чтобы значение свойства нельзя было изменить → <code>public readonly type $prop</code><br>
                        — Хочешь, чтобы ВСЕ свойства были readonly (PHP 8.2+) → <code>readonly class ...</code><br>
                        — Хочешь immutable DTO без наследования → <code>final readonly class ...</code><br>
                        <br>
                        Они не взаимозаменяемы. <code>readonly</code> не запрещает override метода, <code>final</code> не запрещает изменение свойства.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Наследование и полиморфизм</h3>

                    <div class="content-block">
                        <strong>Зачем нужно переопределение (override).</strong> Это возможность дочернего класса <em>заменить или дополнить</em> реализацию метода, унаследованного от родителя. Без переопределения вся иерархия была бы обречена на одинаковое поведение &mdash; смысла наследовать почти не было бы. Четыре основные причины:
                        <ul class="bullets" style="margin-top:6px;">
                          <li><strong>Расширение</strong> &mdash; делаем то же, что родитель, плюс что-то своё (через <code>parent::method()</code>);</li>
                          <li><strong>Замена</strong> &mdash; полностью переписываем логику под нужды наследника;</li>
                          <li><strong>Специализация</strong> &mdash; общий алгоритм подстраивается под конкретный случай;</li>
                          <li><strong>Полиморфизм</strong> &mdash; код, работающий с родительским типом, автоматически получает поведение наследника.</li>
                        </ul>
                    </div>

                    <div class="example-label">Классический пример: Animal / Dog / Cat</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Animal</span> {
    <span class="keyword">public function</span> <span class="function">makeSound</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="string">"Какой-то звук"</span>;
    }
}

<span class="keyword">class</span> <span class="function">Dog</span> <span class="keyword">extends</span> <span class="function">Animal</span> {
    <span class="keyword">public function</span> <span class="function">makeSound</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="string">"Гав!"</span>;       <span class="comment">// замена реализации родителя</span>
    }
}

<span class="keyword">class</span> <span class="function">Cat</span> <span class="keyword">extends</span> <span class="function">Animal</span> {
    <span class="keyword">public function</span> <span class="function">makeSound</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="string">"Мяу!"</span>;
    }
}

<span class="variable">$animals</span> = [<span class="keyword">new</span> <span class="function">Dog</span>(), <span class="keyword">new</span> <span class="function">Cat</span>(), <span class="keyword">new</span> <span class="function">Animal</span>()];
<span class="keyword">foreach</span> (<span class="variable">$animals</span> <span class="keyword">as</span> <span class="variable">$animal</span>) {
    <span class="keyword">echo</span> <span class="variable">$animal</span>-><span class="function">makeSound</span>() . <span class="string">"\n"</span>;
}
<span class="comment">// Гав!
// Мяу!
// Какой-то звук

// Это и есть полиморфизм: foreach работает с типом Animal,
// но каждый объект "звучит" по-своему. Без override — все три
// вывели бы "Какой-то звук" (поведение родителя).</span></code></pre>

                    <div class="example-label">Расширение через parent:: — не замена, а дополнение</div>
                    <pre><code><span class="keyword">class</span> <span class="function">User</span> {
    <span class="keyword">public function</span> <span class="function">save</span>(): <span class="keyword">void</span> {
        <span class="comment">// базовое сохранение в БД</span>
        <span class="type">DB</span>::<span class="function">insert</span>(<span class="string">'users'</span>, [<span class="string">'name'</span> =&gt; <span class="variable">$this</span>-&gt;<span class="variable">name</span>]);
    }
}

<span class="keyword">class</span> <span class="function">AuditedUser</span> <span class="keyword">extends</span> <span class="function">User</span> {
    <span class="keyword">public function</span> <span class="function">save</span>(): <span class="keyword">void</span> {
        <span class="keyword">parent</span>::<span class="function">save</span>();           <span class="comment">// сначала обычное сохранение</span>
        <span class="type">AuditLog</span>::<span class="function">record</span>(<span class="string">'user.saved'</span>, <span class="variable">$this</span>-&gt;<span class="variable">id</span>);  <span class="comment">// потом аудит</span>
    }
}

<span class="comment">// Логика родителя сохранена + добавлено своё.
// Если бы написали без parent::save() — забыли бы сохранение в БД.</span></code></pre>

                    <div class="example-label">Специализация: переопределение под частный случай (Laravel)</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Controller</span> {
    <span class="keyword">protected function</span> <span class="function">authorize</span>(<span class="keyword">string</span> <span class="variable">$ability</span>): <span class="keyword">void</span> {
        <span class="function">abort</span>(<span class="number">403</span>);        <span class="comment">// базовая логика: всегда запрещаем</span>
    }
}

<span class="keyword">class</span> <span class="function">PostController</span> <span class="keyword">extends</span> <span class="function">Controller</span> {
    <span class="keyword">protected function</span> <span class="function">authorize</span>(<span class="keyword">string</span> <span class="variable">$ability</span>): <span class="keyword">void</span> {
        <span class="comment">// специализация: админам можно update</span>
        <span class="keyword">if</span> (<span class="variable">$ability</span> === <span class="string">'update'</span> &amp;&amp; <span class="function">auth</span>()-&gt;<span class="function">user</span>()-&gt;<span class="function">isAdmin</span>()) {
            <span class="keyword">return</span>;
        }
        <span class="keyword">parent</span>::<span class="function">authorize</span>(<span class="variable">$ability</span>);  <span class="comment">// остальное — по правилам родителя</span>
    }
}</code></pre>

                    <div class="example-label">Когда переопределение НЕ нужно — final</div>
                    <pre><code><span class="comment">// Если автор базового класса уверен, что метод НЕ должен меняться
// в наследниках — помечает его final:</span>
<span class="keyword">class</span> <span class="function">Database</span> {
    <span class="keyword">final public function</span> <span class="function">connect</span>(): <span class="keyword">void</span> {
        <span class="comment">// жёсткая последовательность подключения, менять опасно
        // (порядок: SSL handshake → auth → set names → setup)</span>
    }
}

<span class="keyword">class</span> <span class="function">MysqlDatabase</span> <span class="keyword">extends</span> <span class="function">Database</span> {
    <span class="keyword">public function</span> <span class="function">connect</span>(): <span class="keyword">void</span> { }   <span class="comment">// Fatal: Cannot override final method</span>
}

<span class="comment">// final — способ сказать: "Этот алгоритм критичен, не трогай."</span></code></pre>

                    <div class="example-label">Полиморфизм в production-коде (Strategy pattern)</div>
                    <pre><code><span class="keyword">interface</span> <span class="function">PaymentGateway</span> {
    <span class="keyword">public function</span> <span class="function">charge</span>(<span class="keyword">int</span> <span class="variable">$amount</span>): <span class="keyword">string</span>;
}

<span class="keyword">class</span> <span class="function">StripeGateway</span> <span class="keyword">implements</span> <span class="function">PaymentGateway</span> {
    <span class="keyword">public function</span> <span class="function">charge</span>(<span class="keyword">int</span> <span class="variable">$amount</span>): <span class="keyword">string</span> { <span class="comment">/* Stripe API */</span> }
}

<span class="keyword">class</span> <span class="function">PaddleGateway</span> <span class="keyword">implements</span> <span class="function">PaymentGateway</span> {
    <span class="keyword">public function</span> <span class="function">charge</span>(<span class="keyword">int</span> <span class="variable">$amount</span>): <span class="keyword">string</span> { <span class="comment">/* Paddle API */</span> }
}

<span class="keyword">class</span> <span class="function">CheckoutService</span> {
    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="keyword">private</span> <span class="function">PaymentGateway</span> <span class="variable">$gateway</span>) {}

    <span class="keyword">public function</span> <span class="function">processOrder</span>(<span class="function">Order</span> <span class="variable">$order</span>): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="variable">$this</span>-&gt;<span class="variable">gateway</span>-&gt;<span class="function">charge</span>(<span class="variable">$order</span>-&gt;<span class="variable">total</span>);
    }
}

<span class="comment">// CheckoutService не знает, Stripe это или Paddle.
// Он работает с КОНТРАКТОМ PaymentGateway, а конкретная реализация
// (полиморфно) определяется тем, что инжектировано через DI.
// Сменили Stripe на Paddle — CheckoutService не трогается ВООБЩЕ.
// Это основа SOLID/DI/тестируемого кода.</span></code></pre>

                    <div class="remember-box">
                        <strong>Когда переопределять — да:</strong><br>
                        ✓ Когда поведение наследника логически отличается (Dog::makeSound vs Animal::makeSound).<br>
                        ✓ Когда нужно добавить логику до/после родительской (parent::save + audit).<br>
                        ✓ Когда реализуете интерфейс/абстрактный метод &mdash; обязаны переопределить.<br>
                        ✓ Для специализации (admin-bypass в authorize).<br>
                        <br>
                        <strong>Когда переопределять — нет:</strong><br>
                        ✗ Если метод критичный для контракта (тогда автор пометит <code>final</code>).<br>
                        ✗ Просто чтобы «было своё» без реальной разницы поведения.<br>
                        ✗ Когда лучше композиция: вместо <code>extends</code> &mdash; инжектировать зависимость с другой реализацией интерфейса (Strategy pattern, см. KB_5).
                    </div>

                    <div class="content-block">
                        <strong>Когда переопределение невозможно — 6 ситуаций.</strong> Override работает только когда метод родителя <em>виден</em> подклассу и <em>разрешён</em> к изменению. Любое из условий ниже блокирует override.
                    </div>

                    <div class="example-label">1. Метод объявлен как final</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Database</span> {
    <span class="keyword">final public function</span> <span class="function">connect</span>(): <span class="keyword">void</span> { ... }
}

<span class="keyword">class</span> <span class="function">MysqlDatabase</span> <span class="keyword">extends</span> <span class="function">Database</span> {
    <span class="keyword">public function</span> <span class="function">connect</span>(): <span class="keyword">void</span> { }    <span class="comment">// Fatal error: Cannot override final method</span>
}
<span class="comment">// final — явное запрещение от автора базового класса.</span></code></pre>

                    <div class="example-label">2. Класс родителя объявлен как final</div>
                    <pre><code><span class="keyword">final class</span> <span class="function">Money</span> { ... }

<span class="keyword">class</span> <span class="function">SpecialMoney</span> <span class="keyword">extends</span> <span class="function">Money</span> { }
<span class="comment">// Fatal: Class SpecialMoney cannot extend final class Money

// Невозможно даже создать подкласс — значит и override невозможен.
// Часто применяется для Value Object: Money, Email, UserId.</span></code></pre>

                    <div class="example-label">3. private метод — это НЕ override, это новый метод</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Base</span> {
    <span class="keyword">private function</span> <span class="function">hidden</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="string">"base"</span>; }

    <span class="keyword">public function</span> <span class="function">callHidden</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="variable">$this</span>-&gt;<span class="function">hidden</span>();   <span class="comment">// всегда вызовет Base::hidden(), не Child!</span>
    }
}

<span class="keyword">class</span> <span class="function">Child</span> <span class="keyword">extends</span> <span class="function">Base</span> {
    <span class="keyword">private function</span> <span class="function">hidden</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="string">"child"</span>; }
    <span class="comment">// Синтаксически разрешено, но это ОТДЕЛЬНЫЙ метод в Child.
    // Base::callHidden() о нём не знает.</span>
}

<span class="keyword">echo</span> (<span class="keyword">new</span> <span class="function">Child</span>())-&gt;<span class="function">callHidden</span>();   <span class="comment">// "base" — не "child"!

// Это частая ловушка: private методы НЕ наследуются по-настоящему.
// Они "приватны для класса", где объявлены. Подкласс может только
// СОЗДАТЬ свой private-метод с тем же именем — но это не override.
// Решение: используйте protected, если хотите чтобы наследники могли подменить.</span></code></pre>

                    <div class="example-label">4. Несовместимые сигнатуры — Liskov violations</div>
                    <pre><code><span class="comment">// Даже если метод не final и не private, PHP проверяет совместимость сигнатуры.
// Правила (часть LSP — Liskov Substitution Principle):
//   — visibility можно РАСШИРИТЬ (protected → public), но НЕ СУЗИТЬ
//   — параметры: contravariant (тот же или шире/менее строгий тип)
//   — return type: covariant (тот же или уже/более строгий тип)
//   — нельзя поменять static/non-static</span>

<span class="keyword">class</span> <span class="function">Animal</span> {
    <span class="keyword">public function</span> <span class="function">eat</span>(<span class="function">Food</span> <span class="variable">$f</span>): <span class="function">Food</span> { ... }
}

<span class="keyword">class</span> <span class="function">Dog</span> <span class="keyword">extends</span> <span class="function">Animal</span> {
    <span class="comment">// ❌ Сужение видимости — Fatal Error</span>
    <span class="keyword">protected function</span> <span class="function">eat</span>(<span class="function">Food</span> <span class="variable">$f</span>): <span class="function">Food</span> { ... }

    <span class="comment">// ❌ Несовместимый тип параметра (более узкий, не contravariant)</span>
    <span class="keyword">public function</span> <span class="function">eat</span>(<span class="function">DogFood</span> <span class="variable">$f</span>): <span class="function">Food</span> { ... }

    <span class="comment">// ❌ Меняем static на не-static</span>
    <span class="keyword">public static function</span> <span class="function">eat</span>(<span class="function">Food</span> <span class="variable">$f</span>): <span class="function">Food</span> { ... }

    <span class="comment">// ✓ Уточнение return type (covariant) — разрешено</span>
    <span class="keyword">public function</span> <span class="function">eat</span>(<span class="function">Food</span> <span class="variable">$f</span>): <span class="function">DogFood</span> { ... }

    <span class="comment">// ✓ Расширение visibility — разрешено</span>
    <span class="keyword">public function</span> <span class="function">eat</span>(<span class="function">Food</span> <span class="variable">$f</span>): <span class="function">Food</span> { ... }  <span class="comment">// если в Animal был protected</span>
}</code></pre>

                    <div class="example-label">5. static методы — переопределить можно, но это другое</div>
                    <pre><code><span class="keyword">class</span> <span class="function">A</span> {
    <span class="keyword">public static function</span> <span class="function">test</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="string">"A"</span>; }
}

<span class="keyword">class</span> <span class="function">B</span> <span class="keyword">extends</span> <span class="function">A</span> {
    <span class="keyword">public static function</span> <span class="function">test</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="string">"B"</span>; }   <span class="comment">// разрешено</span>
}

<span class="function">B</span>::<span class="function">test</span>();   <span class="comment">// "B"

// Технически разрешено. НО это не классический полиморфизм — нет $this,
// связывание ранее (через self::) идёт к классу, где метод написан.
// Для полиморфизма со static-методами используйте static:: (Late Static Binding,
// см. предыдущую подсекцию про self/static).

// ❌ А вот final static — переопределить нельзя:</span>
<span class="keyword">class</span> <span class="function">A</span> {
    <span class="keyword">final public static function</span> <span class="function">test</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="string">"A"</span>; }
}
<span class="keyword">class</span> <span class="function">B</span> <span class="keyword">extends</span> <span class="function">A</span> {
    <span class="keyword">public static function</span> <span class="function">test</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="string">"B"</span>; }   <span class="comment">// Fatal</span>
}</code></pre>

                    <div class="example-label">6. Метод НЕ существует в родителе — это просто добавление, не override</div>
                    <pre><code><span class="keyword">class</span> <span class="function">User</span> { }

<span class="keyword">class</span> <span class="function">Admin</span> <span class="keyword">extends</span> <span class="function">User</span> {
    <span class="keyword">public function</span> <span class="function">banUser</span>(): <span class="keyword">void</span> { ... }   <span class="comment">// в User такого метода нет — это новый метод, не override</span>
}

<span class="comment">// PHP не выдаёт ошибки, но семантически — это extension, не overriding.
// Иногда в IDE/линтерах настраивают атрибут #[\Override] (PHP 8.3+):</span>

<span class="keyword">class</span> <span class="function">Cat</span> <span class="keyword">extends</span> <span class="function">Animal</span> {
    <span class="comment">#[\Override]</span>
    <span class="keyword">public function</span> <span class="function">makeSound</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="string">"Мяу"</span>; }   <span class="comment">// ✓ если в Animal есть makeSound</span>

    <span class="comment">#[\Override]
    public function makesSound(): string { ... }   ⚠ опечатка!
    // PHP кинет Fatal — метода makesSound нет в родителе.
    // Атрибут #[\Override] защищает от случайных опечаток и от ситуаций,
    // когда родитель переименовал метод, а наследник остался со старым именем.</span>
}</code></pre>

                    <div class="example-label">Сводная таблица — что блокирует override</div>
                    <pre><code><span class="comment">+-----------------------------------+----------------------+--------------------+
| Условие                           | Можно ли override?   | Что произойдёт     |
+-----------------------------------+----------------------+--------------------+
| Метод final в родителе            | ❌ нет                | Fatal Error        |
| Класс final                       | ❌ нельзя наследовать | Fatal Error        |
| Метод private                     | ⚠ синтаксически да,  | НЕ override —      |
|                                   |   но это не override | новый метод в      |
|                                   |                      | дочернем           |
| Сужение visibility                | ❌ нет                | Fatal Error        |
| Несовместимый тип параметра       | ❌ нет                | Fatal Error        |
| Несовместимый return type         | ❌ нет (без covariance)| Fatal Error       |
| Меняем static/non-static          | ❌ нет                | Fatal Error        |
| Метод protected/public, не final  | ✓ да                  | работает           |
| static (не final)                 | ✓ да, но не полиморф | работает           |
| Метода нет в родителе             | ✓ да, но это новый,  | предупреждение     |
|                                   |   не override        | если #[\Override]  |
+-----------------------------------+----------------------+--------------------+</span></code></pre>

                    <div class="remember-box">
                        <strong>Главное правило:</strong> override работает когда метод в родителе <code>protected</code> или <code>public</code>, не помечен <code>final</code>, и сигнатура совместима по LSP (visibility не сужается, параметры contravariant, return type covariant). Используйте <code>#[\Override]</code> (PHP 8.3+) на методах-наследниках, чтобы PHP проверял что override реально происходит &mdash; это спасёт от опечаток и refactor-разногласий.
                    </div>

                    <div class="example-label">Наследование и переопределение методов</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Animal</span> {
    <span class="keyword">protected</span> <span class="variable">$name</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">string</span> <span class="variable">$name</span>) {
        <span class="variable">$this</span>-><span class="variable">name</span> = <span class="variable">$name</span>;
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">sound</span>() {
        <span class="keyword">return</span> <span class="string">"Some sound"</span>;
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">introduce</span>() {
        <span class="keyword">return</span> <span class="string">"I am "</span> . <span class="variable">$this</span>-><span class="variable">name</span>;
    }
}

<span class="keyword">class</span> <span class="function">Dog</span> <span class="keyword">extends</span> <span class="function">Animal</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">sound</span>() {
        <span class="keyword">return</span> <span class="string">"Woof!"</span>;  <span class="comment">// Переопределение</span>
    }
}

<span class="keyword">class</span> <span class="function">Cat</span> <span class="keyword">extends</span> <span class="function">Animal</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">sound</span>() {
        <span class="keyword">return</span> <span class="string">"Meow!"</span>;  <span class="comment">// Переопределение</span>
    }
}

<span class="comment">// Полиморфизм - один интерфейс, разные поведения</span>
<span class="function">makeSound</span>(<span class="keyword">new</span> <span class="function">Dog</span>(<span class="string">"Rex"</span>));  <span class="comment">// "Woof!"</span>
<span class="function">makeSound</span>(<span class="keyword">new</span> <span class="function">Cat</span>(<span class="string">"Whiskers"</span>));  <span class="comment">// "Meow!"</span>

<span class="keyword">function</span> <span class="function">makeSound</span>(<span class="function">Animal</span> <span class="variable">$animal</span>) {
    <span class="keyword">echo</span> <span class="variable">$animal</span>-><span class="function">sound</span>();
}

<span class="comment">// Вызов родительского метода через parent::</span>
<span class="keyword">class</span> <span class="function">Dog</span> <span class="keyword">extends</span> <span class="function">Animal</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">introduce</span>() {
        <span class="keyword">return</span> <span class="keyword">parent</span>::<span class="function">introduce</span>() . <span class="string">" and I'm a dog!"</span>;
    }
}</code></pre>
                </div>
            </div>

            <!-- SECTION 5: OOP ABSTRACT & INTERFACES -->
            <div id="oop-abstract" class="section">
                <h2 class="section-title">5. ООП: Абстрактные классы vs Интерфейсы</h2>

                <div class="subsection">
                    <h3 class="subsection-title">Абстрактные классы</h3>
                    <div class="content-block">
                        <strong>Абстрактный класс</strong> не может быть инстанцирован. Служит базисом для подклассов. Может содержать реализованные и абстрактные методы.
                    </div>
                    <div class="example-label">Абстрактные классы</div>
                    <pre><code><span class="keyword">abstract</span> <span class="keyword">class</span> <span class="function">Repository</span> {
    <span class="keyword">protected</span> <span class="variable">$db</span>;

    <span class="comment">// Конкретный метод - имеет реализацию</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">setDb</span>(<span class="variable">$db</span>) {
        <span class="variable">$this</span>-><span class="variable">db</span> = <span class="variable">$db</span>;
    }

    <span class="comment">// Абстрактный метод - должен быть реализован подклассом</span>
    <span class="keyword">abstract</span> <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">findById</span>(<span class="keyword">int</span> <span class="variable">$id</span>);

    <span class="comment">// Абстрактный метод</span>
    <span class="keyword">abstract</span> <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">getAll</span>();
}

<span class="keyword">class</span> <span class="function">UserRepository</span> <span class="keyword">extends</span> <span class="function">Repository</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">findById</span>(<span class="keyword">int</span> <span class="variable">$id</span>) {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">$db</span>-><span class="function">query</span>(<span class="string">"SELECT * FROM users WHERE id = ?"</span>, [<span class="variable">$id</span>]);
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">getAll</span>() {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">$db</span>-><span class="function">query</span>(<span class="string">"SELECT * FROM users"</span>);
    }
}

<span class="variable">$repo</span> = <span class="keyword">new</span> <span class="function">Repository</span>();  <span class="comment">// ERROR! Cannot instantiate abstract class</span>
<span class="variable">$repo</span> = <span class="keyword">new</span> <span class="function">UserRepository</span>();  <span class="comment">// OK</span></code></pre>

                    <div class="content-block">
                        <strong>Ключевые признаки абстрактного класса:</strong>
                        <ul class="bullets" style="margin-top:6px;">
                          <li>Объявляется ключевым словом <code>abstract</code> перед <code>class</code>;</li>
                          <li>Может содержать <strong>абстрактные методы</strong> &mdash; только сигнатура без тела: <code>abstract public function foo();</code> (заканчивается точкой с запятой, без <code>{}</code>);</li>
                          <li>Любой наследник <strong>обязан реализовать</strong> все абстрактные методы (или сам стать абстрактным);</li>
                          <li>Может содержать <strong>обычные методы с реализацией</strong> &mdash; они переиспользуются всеми наследниками;</li>
                          <li>Может иметь свойства, конструктор, константы &mdash; всё как в обычном классе;</li>
                          <li><strong>Нельзя создать объект</strong> через <code>new</code> &mdash; только через подкласс.</li>
                        </ul>
                    </div>

                    <div class="example-label">Реальный пример 1: Animal / Dog / Cat — основа полиморфизма</div>
                    <pre><code><span class="keyword">abstract class</span> <span class="function">Animal</span> {
    <span class="keyword">protected string</span> <span class="variable">$name</span>;

    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="keyword">string</span> <span class="variable">$name</span>) {
        <span class="variable">$this</span>-><span class="variable">name</span> = <span class="variable">$name</span>;
    }

    <span class="comment">// Готовый метод — все наследники получают бесплатно</span>
    <span class="keyword">public function</span> <span class="function">getName</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">name</span>;
    }

    <span class="comment">// Абстрактный — каждый наследник обязан реализовать по-своему</span>
    <span class="keyword">abstract public function</span> <span class="function">makeSound</span>(): <span class="keyword">string</span>;
}

<span class="keyword">class</span> <span class="function">Dog</span> <span class="keyword">extends</span> <span class="function">Animal</span> {
    <span class="keyword">public function</span> <span class="function">makeSound</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="string">"Гав!"</span>; }
}

<span class="keyword">class</span> <span class="function">Cat</span> <span class="keyword">extends</span> <span class="function">Animal</span> {
    <span class="keyword">public function</span> <span class="function">makeSound</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="string">"Мяу!"</span>; }
}

<span class="comment">// $animal = new Animal("Test");   // Fatal: Cannot instantiate abstract class</span>

<span class="variable">$dog</span> = <span class="keyword">new</span> <span class="function">Dog</span>(<span class="string">"Бобик"</span>);
<span class="keyword">echo</span> <span class="variable">$dog</span>-><span class="function">getName</span>();     <span class="comment">// "Бобик" — унаследовано</span>
<span class="keyword">echo</span> <span class="variable">$dog</span>-><span class="function">makeSound</span>();   <span class="comment">// "Гав!"  — собственная реализация</span></code></pre>

                    <div class="example-label">Реальный пример 2: Template Method — общий CRUD-контроллер</div>
                    <pre><code><span class="comment">// Каркас алгоритма фиксирован в родителе; шаги — в наследниках</span>

<span class="keyword">abstract class</span> <span class="function">CrudController</span> <span class="keyword">extends</span> <span class="function">Controller</span> {
    <span class="comment">// Наследники обязаны указать модель и правила</span>
    <span class="keyword">abstract protected function</span> <span class="function">modelClass</span>(): <span class="keyword">string</span>;
    <span class="keyword">abstract protected function</span> <span class="function">validationRules</span>(<span class="function">Request</span> <span class="variable">$r</span>): <span class="keyword">array</span>;

    <span class="comment">// Общая логика для всех CRUD-контроллеров — пишется один раз</span>
    <span class="keyword">public function</span> <span class="function">store</span>(<span class="function">Request</span> <span class="variable">$request</span>): <span class="function">JsonResponse</span> {
        <span class="variable">$validated</span> = <span class="variable">$request</span>-&gt;<span class="function">validate</span>(<span class="variable">$this</span>-&gt;<span class="function">validationRules</span>(<span class="variable">$request</span>));
        <span class="variable">$item</span> = (<span class="variable">$this</span>-&gt;<span class="function">modelClass</span>())::<span class="function">create</span>(<span class="variable">$validated</span>);
        <span class="keyword">return</span> <span class="function">response</span>()-&gt;<span class="function">json</span>(<span class="variable">$item</span>, <span class="number">201</span>);
    }

    <span class="keyword">public function</span> <span class="function">index</span>(): <span class="function">JsonResponse</span> {
        <span class="keyword">return</span> <span class="function">response</span>()-&gt;<span class="function">json</span>((<span class="variable">$this</span>-&gt;<span class="function">modelClass</span>())::<span class="function">all</span>());
    }
}

<span class="keyword">class</span> <span class="function">UserController</span> <span class="keyword">extends</span> <span class="function">CrudController</span> {
    <span class="keyword">protected function</span> <span class="function">modelClass</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="function">User</span>::<span class="keyword">class</span>; }

    <span class="keyword">protected function</span> <span class="function">validationRules</span>(<span class="function">Request</span> <span class="variable">$r</span>): <span class="keyword">array</span> {
        <span class="keyword">return</span> [<span class="string">'name'</span> =&gt; <span class="string">'required|string'</span>, <span class="string">'email'</span> =&gt; <span class="string">'required|email|unique:users'</span>];
    }
}

<span class="keyword">class</span> <span class="function">ProductController</span> <span class="keyword">extends</span> <span class="function">CrudController</span> {
    <span class="keyword">protected function</span> <span class="function">modelClass</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="function">Product</span>::<span class="keyword">class</span>; }

    <span class="keyword">protected function</span> <span class="function">validationRules</span>(<span class="function">Request</span> <span class="variable">$r</span>): <span class="keyword">array</span> {
        <span class="keyword">return</span> [<span class="string">'title'</span> =&gt; <span class="string">'required|string|max:100'</span>, <span class="string">'price'</span> =&gt; <span class="string">'required|numeric|min:0'</span>];
    }
}

<span class="comment">// Зачем абстрактный: store() и index() пишутся ОДИН раз в CrudController.
// Каждый наследник лишь указывает модель и правила. Если завтра добавится
// логирование запросов — добавляется в одном месте, работает для всех.</span></code></pre>

                    <div class="example-label">Реальный пример 3: NotificationService — каркас + контракт send()</div>
                    <pre><code><span class="keyword">abstract class</span> <span class="function">NotificationService</span> {
    <span class="keyword">public function</span> <span class="function">__construct</span>(
        <span class="keyword">protected string</span> <span class="variable">$recipient</span>,
        <span class="keyword">protected string</span> <span class="variable">$message</span>,
    ) {}

    <span class="comment">// Каркас: каждый наследник делает свой send()</span>
    <span class="keyword">abstract public function</span> <span class="function">send</span>(): <span class="keyword">bool</span>;

    <span class="comment">// Общая утилита — все наследники переиспользуют</span>
    <span class="keyword">protected function</span> <span class="function">log</span>(<span class="keyword">string</span> <span class="variable">$status</span>): <span class="keyword">void</span> {
        <span class="function">Log</span>::<span class="function">info</span>(<span class="string">"[<span class="variable">$status</span>] Sent to <span class="variable">$this</span>-&gt;<span class="variable">recipient</span>"</span>);
    }
}

<span class="keyword">class</span> <span class="function">EmailService</span> <span class="keyword">extends</span> <span class="function">NotificationService</span> {
    <span class="keyword">public function</span> <span class="function">send</span>(): <span class="keyword">bool</span> {
        <span class="variable">$ok</span> = <span class="function">Mail</span>::<span class="function">to</span>(<span class="variable">$this</span>-&gt;<span class="variable">recipient</span>)-&gt;<span class="function">send</span>(<span class="keyword">new</span> <span class="function">GenericMail</span>(<span class="variable">$this</span>-&gt;<span class="variable">message</span>));
        <span class="variable">$this</span>-&gt;<span class="function">log</span>(<span class="variable">$ok</span> ? <span class="string">'OK'</span> : <span class="string">'FAIL'</span>);
        <span class="keyword">return</span> <span class="variable">$ok</span>;
    }
}

<span class="keyword">class</span> <span class="function">SmsService</span> <span class="keyword">extends</span> <span class="function">NotificationService</span> {
    <span class="keyword">public function</span> <span class="function">send</span>(): <span class="keyword">bool</span> {
        <span class="variable">$ok</span> = <span class="function">Http</span>::<span class="function">post</span>(<span class="string">'https://sms.api/send'</span>, [...])-&gt;<span class="function">successful</span>();
        <span class="variable">$this</span>-&gt;<span class="function">log</span>(<span class="variable">$ok</span> ? <span class="string">'OK'</span> : <span class="string">'FAIL'</span>);
        <span class="keyword">return</span> <span class="variable">$ok</span>;
    }
}

<span class="comment">// Полиморфное использование — код не знает, какой именно сервис</span>
<span class="variable">$notifications</span> = [
    <span class="keyword">new</span> <span class="function">EmailService</span>(<span class="string">'a@ex.com'</span>, <span class="string">'Hi'</span>),
    <span class="keyword">new</span> <span class="function">SmsService</span>(<span class="string">'+1234'</span>, <span class="string">'Hi'</span>),
];
<span class="keyword">foreach</span> (<span class="variable">$notifications</span> <span class="keyword">as</span> <span class="variable">$n</span>) {
    <span class="variable">$n</span>-&gt;<span class="function">send</span>();   <span class="comment">// каждый отрабатывает по-своему, логирование общее</span>
}</code></pre>

                    <div class="example-label">Реальный пример 4: BaseEntity — общая модельная логика</div>
                    <pre><code><span class="keyword">use</span> <span class="function">Illuminate\Database\Eloquent\Model</span>;

<span class="keyword">abstract class</span> <span class="function">BaseEntity</span> <span class="keyword">extends</span> <span class="function">Model</span> {
    <span class="comment">// Наследник указывает по какому полю искать (slug, username, etc.)</span>
    <span class="keyword">abstract public function</span> <span class="function">searchField</span>(): <span class="keyword">string</span>;

    <span class="comment">// Универсальный поиск — работает для всех наследников</span>
    <span class="keyword">public static function</span> <span class="function">findByUnique</span>(<span class="keyword">string</span> <span class="variable">$value</span>): <span class="keyword">?</span><span class="keyword">static</span> {
        <span class="variable">$instance</span> = <span class="keyword">new</span> <span class="keyword">static</span>();
        <span class="keyword">return</span> <span class="keyword">static</span>::<span class="function">where</span>(<span class="variable">$instance</span>-&gt;<span class="function">searchField</span>(), <span class="variable">$value</span>)-&gt;<span class="function">first</span>();
    }

    <span class="comment">// Общий аксессор для формата даты — у всех моделей</span>
    <span class="keyword">public function</span> <span class="function">createdAtShort</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="variable">$this</span>-&gt;<span class="variable">created_at</span>-&gt;<span class="function">format</span>(<span class="string">'d.m.Y'</span>);
    }
}

<span class="keyword">class</span> <span class="function">Article</span> <span class="keyword">extends</span> <span class="function">BaseEntity</span> {
    <span class="keyword">public function</span> <span class="function">searchField</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="string">'slug'</span>; }
}

<span class="keyword">class</span> <span class="function">User</span> <span class="keyword">extends</span> <span class="function">BaseEntity</span> {
    <span class="keyword">public function</span> <span class="function">searchField</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="string">'username'</span>; }
}

<span class="comment">// Полиморфно — Article ищется по slug, User по username</span>
<span class="variable">$article</span> = <span class="function">Article</span>::<span class="function">findByUnique</span>(<span class="string">'hello-world'</span>);
<span class="variable">$user</span>    = <span class="function">User</span>::<span class="function">findByUnique</span>(<span class="string">'john_doe'</span>);

<span class="comment">// findByUnique() написан 1 раз; каждый наследник без копипасты получает поиск.</span></code></pre>

                    <div class="example-label">Реальный пример 5: SPL FilterIterator — встроенная PHP-абстракция</div>
                    <pre><code><span class="comment">// PHP в SPL даёт абстрактный FilterIterator — пишешь свой class extends...
// и обязательно реализуешь accept().</span>

<span class="keyword">abstract class</span> <span class="function">FilterIterator</span> <span class="keyword">extends</span> <span class="function">IteratorIterator</span> {
    <span class="comment">// Этот метод сам PHP вызывает на каждой итерации,
    // и наследник ОБЯЗАН его реализовать</span>
    <span class="keyword">abstract public function</span> <span class="function">accept</span>(): <span class="keyword">bool</span>;
}

<span class="comment">// Свой фильтр — оставляет только строки длиннее N символов</span>
<span class="keyword">class</span> <span class="function">MinLengthFilter</span> <span class="keyword">extends</span> <span class="function">FilterIterator</span> {
    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="function">Iterator</span> <span class="variable">$it</span>, <span class="keyword">private int</span> <span class="variable">$min</span>) {
        <span class="keyword">parent</span>::<span class="function">__construct</span>(<span class="variable">$it</span>);
    }

    <span class="keyword">public function</span> <span class="function">accept</span>(): <span class="keyword">bool</span> {
        <span class="keyword">return</span> <span class="function">strlen</span>((<span class="keyword">string</span>) <span class="variable">$this</span>-&gt;<span class="function">current</span>()) &gt;= <span class="variable">$this</span>-&gt;<span class="variable">min</span>;
    }
}

<span class="variable">$words</span>    = <span class="keyword">new</span> <span class="function">ArrayIterator</span>([<span class="string">'a'</span>, <span class="string">'hi'</span>, <span class="string">'apple'</span>, <span class="string">'no'</span>, <span class="string">'banana'</span>]);
<span class="variable">$filtered</span> = <span class="keyword">new</span> <span class="function">MinLengthFilter</span>(<span class="variable">$words</span>, <span class="number">3</span>);

<span class="keyword">foreach</span> (<span class="variable">$filtered</span> <span class="keyword">as</span> <span class="variable">$w</span>) <span class="keyword">echo</span> <span class="variable">$w</span> . <span class="string">"\n"</span>;
<span class="comment">// apple
// banana
// (короткие отфильтрованы PHP-движком, мы дали только правило)</span></code></pre>

                    <div class="content-block">
                        <strong>Когда выбирать абстрактный класс</strong> (а не интерфейс или обычный класс):
                        <ul class="bullets" style="margin-top:6px;">
                          <li>Есть <strong>общая логика</strong> для группы классов (поля, конструктор, готовые методы), которую глупо дублировать;</li>
                          <li>Часть деталей нужно <strong>обязательно</strong> реализовать в каждом наследнике (абстрактные методы как контракт);</li>
                          <li>Семантически «нет смысла создавать сам родитель» &mdash; <code>Animal</code> вообще, <code>NotificationService</code> вообще, <code>Repository</code> вообще не существуют как объекты;</li>
                          <li>Нужно реализовать <strong>паттерн Template Method</strong> &mdash; общий алгоритм с переопределяемыми шагами.</li>
                        </ul>
                        <strong>Когда НЕ абстрактный класс:</strong>
                        <ul class="bullets" style="margin-top:6px;">
                          <li>Если общей реализации нет, есть только контракт &rarr; <strong>interface</strong>;</li>
                          <li>Если нужно реализовать <em>несколько</em> контрактов &rarr; интерфейсы (PHP не имеет множественного наследования классов);</li>
                          <li>Если родитель сам по себе осмыслен и может существовать как объект &rarr; обычный класс + наследование без <code>abstract</code>.</li>
                        </ul>
                    </div>

                    <div class="example-label">Отличия от обычного класса и интерфейса (для быстрого выбора)</div>
                    <pre><code><span class="comment">+-------------------------+--------+--------+----------+
| Характеристика          | Class  | Abstr. | Interface|
+-------------------------+--------+--------+----------+
| new ClassName()         | ✓      | ❌     | ❌       |
| Готовые методы          | ✓      | ✓      | ❌ (PHP&lt;8.1)|
| Абстрактные методы      | ❌     | ✓      | ✓ (по сути)|
| Свойства/поля           | ✓      | ✓      | ❌       |
| Конструктор             | ✓      | ✓      | ❌       |
| Множественное наследов. | 1 родит| 1 родит| много    |
| Константы               | ✓      | ✓      | ✓        |
| Тип в type hint         | ✓      | ✓      | ✓        |
+-------------------------+--------+--------+----------+</span></code></pre>

                    <div class="remember-box">
                        <strong>Правило большого пальца:</strong><br>
                        — Если хочется <strong>дать каркас</strong> с готовой реализацией части методов + обязать наследников доделать остальное → <code>abstract class</code>.<br>
                        — Если нужен только <strong>контракт</strong> (без общего кода) → <code>interface</code>.<br>
                        — Если нужна <strong>и реализация, и множественное наследование</strong> поведения → <code>trait</code> (см. KB_9).<br>
                        <br>
                        Абстрактный класс &mdash; полуфабрикат: даёт заготовку и правила, но требует доделки. Хорошо работает в связке с Strategy/Template Method патернами (см. KB_5).
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Интерфейсы (Interfaces)</h3>
                    <div class="content-block">
                        <strong>Интерфейс</strong> - контракт (договор). Определяет методы, но НЕ реализацию. Класс может имплементировать НЕСКОЛЬКО интерфейсов.
                    </div>
                    <div class="example-label">Интерфейсы</div>
                    <pre><code><span class="keyword">interface</span> <span class="function">Loggable</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">log</span>(<span class="keyword">string</span> <span class="variable">$message</span>);
}

<span class="keyword">interface</span> <span class="function">Cacheable</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">cache</span>(<span class="keyword">string</span> <span class="variable">$key</span>, <span class="variable">$value</span>);
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">getCache</span>(<span class="keyword">string</span> <span class="variable">$key</span>);
}

<span class="comment">// Класс может имплементировать несколько интерфейсов</span>
<span class="keyword">class</span> <span class="function">UserService</span> <span class="keyword">implements</span> <span class="function">Loggable</span>, <span class="function">Cacheable</span> {
    <span class="keyword">private</span> <span class="variable">$cache</span> = [];

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">log</span>(<span class="keyword">string</span> <span class="variable">$message</span>) {
        <span class="keyword">echo</span> <span class="string">"LOG: "</span> . <span class="variable">$message</span>;
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">cache</span>(<span class="keyword">string</span> <span class="variable">$key</span>, <span class="variable">$value</span>) {
        <span class="variable">$this</span>-><span class="variable">$cache</span>[<span class="variable">$key</span>] = <span class="variable">$value</span>;
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">getCache</span>(<span class="keyword">string</span> <span class="variable">$key</span>) {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">$cache</span>[<span class="variable">$key</span>] ?? <span class="keyword">null</span>;
    }
}

<span class="variable">$service</span> = <span class="keyword">new</span> <span class="function">UserService</span>();
<span class="variable">$service</span>-><span class="function">log</span>(<span class="string">"User created"</span>);
<span class="variable">$service</span>-><span class="function">cache</span>(<span class="string">"user:1"</span>, <span class="string">"John"</span>);</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Когда использовать Абстрактные классы vs Интерфейсы</h3>
                    <table>
                        <tr>
                            <th>Абстрактный класс</th>
                            <th>Интерфейс</th>
                        </tr>
                        <tr>
                            <td>Общая функциональность для подклассов</td>
                            <td>Контракт для несвязанных классов</td>
                        </tr>
                        <tr>
                            <td>Может иметь свойства и приватные методы</td>
                            <td>Только публичные методы (PHP 8.1+)</td>
                        </tr>
                        <tr>
                            <td>Один класс может наследовать только один</td>
                            <td>Класс может имплементировать много</td>
                        </tr>
                        <tr>
                            <td>"IS-A" отношение (Dog IS-A Animal)</td>
                            <td>"CAN-DO" отношение (User CAN-DO Loggable)</td>
                        </tr>
                        <tr>
                            <td>Иерархия классов (специализация)</td>
                            <td>Набор способностей (миксины функциональности)</td>
                        </tr>
                    </table>

                    <div class="example-label">Практический пример</div>
                    <pre><code><span class="comment">// Абстрактный класс для иерархии: Animal -> Dog -> GoldenRetriever</span>
<span class="keyword">abstract</span> <span class="keyword">class</span> <span class="function">Animal</span> {}
<span class="keyword">class</span> <span class="function">Dog</span> <span class="keyword">extends</span> <span class="function">Animal</span> {}
<span class="keyword">class</span> <span class="function">GoldenRetriever</span> <span class="keyword">extends</span> <span class="function">Dog</span> {}

<span class="comment">// Интерфейсы для способностей</span>
<span class="keyword">interface</span> <span class="function">Trainable</span> {}
<span class="keyword">interface</span> <span class="function">Loveable</span> {}

<span class="comment">// Dog может быть Trainable И Loveable</span>
<span class="keyword">class</span> <span class="function">Dog</span> <span class="keyword">extends</span> <span class="function">Animal</span> <span class="keyword">implements</span> <span class="function">Trainable</span>, <span class="function">Loveable</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">train</span>() {}
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">love</span>() {}
}</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Default Methods в интерфейсах (PHP 8.1+)</h3>
                    <div class="example-label">Default методы</div>
                    <pre><code><span class="keyword">interface</span> <span class="function">Repository</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">findById</span>(<span class="keyword">int</span> <span class="variable">$id</span>);

    <span class="comment">// Default реализация метода в интерфейсе</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">count</span>() {
        <span class="keyword">return</span> <span class="function">count</span>(<span class="variable">$this</span>-><span class="function">getAll</span>());
    }
}

<span class="keyword">class</span> <span class="function">UserRepository</span> <span class="keyword">implements</span> <span class="function">Repository</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">findById</span>(<span class="keyword">int</span> <span class="variable">$id</span>) {
        <span class="comment">// реализация</span>
    }

    <span class="comment">// count() унаследуется с default реализацией</span>
}</code></pre>
                </div>
            </div>

            <!-- SECTION 6: TRAITS -->
            <div id="traits" class="section">
                <h2 class="section-title">6. ООП: Traits</h2>

                <div class="subsection">
                    <h3 class="subsection-title">Основы Traits</h3>
                    <div class="content-block">
                        <strong>Trait</strong> - способ повторного использования кода в классах. Это как "горизонтальное наследование". Класс может использовать несколько traits, но может наследовать только один класс.
                    </div>
                    <div class="example-label">Базовые Traits</div>
                    <pre><code><span class="keyword">trait</span> <span class="function">Timestamp</span> {
    <span class="keyword">public</span> <span class="variable">$createdAt</span>;
    <span class="keyword">public</span> <span class="variable">$updatedAt</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">setTimestamps</span>() {
        <span class="variable">$this</span>-><span class="variable">createdAt</span> = <span class="keyword">new</span> <span class="function">DateTime</span>();
        <span class="variable">$this</span>-><span class="variable">updatedAt</span> = <span class="keyword">new</span> <span class="function">DateTime</span>();
    }
}

<span class="keyword">trait</span> <span class="function">SoftDelete</span> {
    <span class="keyword">public</span> <span class="variable">$deletedAt</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">softDelete</span>() {
        <span class="variable">$this</span>-><span class="variable">deletedAt</span> = <span class="keyword">new</span> <span class="function">DateTime</span>();
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">restore</span>() {
        <span class="variable">$this</span>-><span class="variable">deletedAt</span> = <span class="keyword">null</span>;
    }
}

<span class="keyword">class</span> <span class="function">Post</span> {
    <span class="keyword">use</span> <span class="function">Timestamp</span>, <span class="function">SoftDelete</span>;

    <span class="keyword">private</span> <span class="variable">$title</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">string</span> <span class="variable">$title</span>) {
        <span class="variable">$this</span>-><span class="variable">title</span> = <span class="variable">$title</span>;
        <span class="variable">$this</span>-><span class="function">setTimestamps</span>();  <span class="comment">// From Timestamp trait</span>
    }
}

<span class="variable">$post</span> = <span class="keyword">new</span> <span class="function">Post</span>(<span class="string">"Hello"</span>);
<span class="variable">$post</span>-><span class="function">softDelete</span>();  <span class="comment">// From SoftDelete trait</span></code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Разрешение конфликтов: insteadof и as</h3>
                    <div class="content-block">
                        Если несколько traits имеют методы с одинаковым именем, нужно явно указать какой использовать.
                    </div>
                    <div class="example-label">Конфликты методов</div>
                    <pre><code><span class="keyword">trait</span> <span class="function">A</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">handle</span>() {
        <span class="keyword">echo</span> <span class="string">"Trait A"</span>;
    }
}

<span class="keyword">trait</span> <span class="function">B</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">handle</span>() {
        <span class="keyword">echo</span> <span class="string">"Trait B"</span>;
    }
}

<span class="keyword">class</span> <span class="function">MyClass</span> {
    <span class="keyword">use</span> <span class="function">A</span>, <span class="function">B</span> {
        <span class="comment">// insteadof - выбрать один метод, другой игнорировать</span>
        <span class="function">B</span>::<span class="function">handle</span> <span class="keyword">insteadof</span> <span class="function">A</span>;
        <span class="comment">// as - создать алиас для метода A (переименовать)</span>
        <span class="function">A</span>::<span class="function">handle</span> <span class="keyword">as</span> <span class="function">handleA</span>;
    }
}

<span class="variable">$obj</span> = <span class="keyword">new</span> <span class="function">MyClass</span>();
<span class="variable">$obj</span>-><span class="function">handle</span>();   <span class="comment">// "Trait B"</span>
<span class="variable">$obj</span>-><span class="function">handleA</span>();  <span class="comment">// "Trait A"</span></code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Абстрактные методы в Traits</h3>
                    <div class="example-label">Traits с абстрактными методами</div>
                    <pre><code><span class="keyword">trait</span> <span class="function">Validatable</span> {
    <span class="comment">// Абстрактный метод - подклассы ДОЛЖНЫ реализовать</span>
    <span class="keyword">abstract</span> <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">rules</span>();

    <span class="comment">// Конкретный метод, который использует абстрактный</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">validate</span>(<span class="variable">$data</span>) {
        <span class="variable">$rules</span> = <span class="variable">$this</span>-><span class="function">rules</span>();
        <span class="comment">// Валидировать $data против $rules</span>
    }
}

<span class="keyword">class</span> <span class="function">UserForm</span> {
    <span class="keyword">use</span> <span class="function">Validatable</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">rules</span>() {
        <span class="keyword">return</span> [
            <span class="string">'email'</span> => <span class="string">'required|email'</span>,
            <span class="string">'password'</span> => <span class="string">'required|min:8'</span>
        ];
    }
}</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Реальные use cases Traits</h3>
                    <div class="example-label">Практические примеры</div>
                    <pre><code><span class="comment">// 1. Логирование для разных классов</span>
<span class="keyword">trait</span> <span class="function">Loggable</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">log</span>(<span class="variable">$msg</span>) {
        <span class="keyword">echo</span> <span class="function">date</span>(<span class="string">'Y-m-d H:i:s'</span>) . <span class="string">": "</span> . <span class="variable">$msg</span>;
    }
}

<span class="keyword">class</span> <span class="function">UserService</span> { <span class="keyword">use</span> <span class="function">Loggable</span>; }
<span class="keyword">class</span> <span class="function">OrderService</span> { <span class="keyword">use</span> <span class="function">Loggable</span>; }

<span class="comment">// 2. Кэширование для модели</span>
<span class="keyword">trait</span> <span class="function">Cacheable</span> {
    <span class="keyword">private</span> <span class="variable">$cache</span> = [];

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">remember</span>(<span class="variable">$key</span>, <span class="keyword">callable</span> <span class="variable">$callback</span>) {
        <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$this</span>-><span class="variable">cache</span>[<span class="variable">$key</span>])) {
            <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">cache</span>[<span class="variable">$key</span>];
        }
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">cache</span>[<span class="variable">$key</span>] = <span class="variable">$callback</span>();
    }
}

<span class="comment">// 3. JSON сериализация</span>
<span class="keyword">trait</span> <span class="function">JsonSerializable</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">toJson</span>() {
        <span class="keyword">return</span> <span class="function">json_encode</span>(<span class="variable">$this</span>-><span class="function">toArray</span>());
    }

    <span class="keyword">abstract</span> <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">toArray</span>();
}</code></pre>

                    <div class="remember-box">
                        Traits отлично подходят для кроссэффективности, которая НЕ является частью иерархии. Используй их для логирования, кэширования, валидации и других "горизонтальных" обязанностей!
                    </div>
                </div>
            </div>

            <!-- SECTION 7: MAGIC METHODS -->
            <div id="magic" class="section">
                <h2 class="section-title">7. Магические методы</h2>

                <div class="subsection">
                    <h3 class="subsection-title">__construct и __destruct</h3>
                    <div class="example-label">Конструктор и деструктор</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Database</span> {
    <span class="keyword">private</span> <span class="variable">$connection</span>;

    <span class="comment">// __construct вызывается при создании объекта</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">string</span> <span class="variable">$host</span>, <span class="keyword">string</span> <span class="variable">$user</span>) {
        <span class="variable">$this</span>-><span class="variable">$connection</span> = <span class="function">mysqli_connect</span>(<span class="variable">$host</span>, <span class="variable">$user</span>);
        <span class="keyword">echo</span> <span class="string">"Connected"</span>;
    }

    <span class="comment">// __destruct вызывается при удалении объекта</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__destruct</span>() {
        <span class="function">mysqli_close</span>(<span class="variable">$this</span>-><span class="variable">$connection</span>);
        <span class="keyword">echo</span> <span class="string">"Disconnected"</span>;
    }
}

<span class="variable">$db</span> = <span class="keyword">new</span> <span class="function">Database</span>(<span class="string">"localhost"</span>, <span class="string">"root"</span>);
<span class="comment">// Output: "Connected"</span>
<span class="variable">$db</span> = <span class="keyword">null</span>;  <span class="comment">// или выход из области видимости</span>
<span class="comment">// Output: "Disconnected"</span></code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">__get, __set, __isset, __unset</h3>
                    <div class="example-label">Динамический доступ к свойствам</div>
                    <pre><code><span class="keyword">class</span> <span class="function">User</span> {
    <span class="keyword">private</span> <span class="variable">$data</span> = [];

    <span class="comment">// Вызывается при доступе к приватному/несуществующему свойству</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__get</span>(<span class="keyword">string</span> <span class="variable">$name</span>) {
        <span class="keyword">echo</span> <span class="string">"Getting $name"</span>;
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">data</span>[<span class="variable">$name</span>] ?? <span class="keyword">null</span>;
    }

    <span class="comment">// Вызывается при установке приватного/несуществующего свойства</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__set</span>(<span class="keyword">string</span> <span class="variable">$name</span>, <span class="variable">$value</span>) {
        <span class="keyword">echo</span> <span class="string">"Setting $name to $value"</span>;
        <span class="variable">$this</span>-><span class="variable">data</span>[<span class="variable">$name</span>] = <span class="variable">$value</span>;
    }

    <span class="comment">// Вызывается при isset() на приватном свойстве</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__isset</span>(<span class="keyword">string</span> <span class="variable">$name</span>) {
        <span class="keyword">return</span> <span class="function">isset</span>(<span class="variable">$this</span>-><span class="variable">data</span>[<span class="variable">$name</span>]);
    }

    <span class="comment">// Вызывается при unset() на приватном свойстве</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__unset</span>(<span class="keyword">string</span> <span class="variable">$name</span>) {
        <span class="function">unset</span>(<span class="variable">$this</span>-><span class="variable">data</span>[<span class="variable">$name</span>]);
    }
}

<span class="variable">$user</span> = <span class="keyword">new</span> <span class="function">User</span>();
<span class="variable">$user</span>-><span class="variable">name</span> = <span class="string">"Alice"</span>;      <span class="comment">// Вызовет __set</span>
<span class="keyword">echo</span> <span class="variable">$user</span>-><span class="variable">name</span>;          <span class="comment">// Вызовет __get</span>
<span class="keyword">isset</span>(<span class="variable">$user</span>-><span class="variable">name</span>);        <span class="comment">// Вызовет __isset</span></code></pre>

                    <div class="remember-box">
                        __get/__set отлично подходят для ленивой загрузки данных, валидации, или логирования доступа к свойствам. Это использует Laravel Models!
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">__call и __callStatic</h3>
                    <div class="example-label">Динамические методы</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Builder</span> {
    <span class="keyword">private</span> <span class="variable">$query</span> = [];

    <span class="comment">// __call - вызывается для приватных/несуществующих методов</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__call</span>(<span class="keyword">string</span> <span class="variable">$name</span>, <span class="variable">$args</span>) {
        <span class="variable">$this</span>-><span class="variable">query</span>[<span class="variable">$name</span>] = <span class="variable">$args</span>[<span class="number">0</span>] ?? <span class="keyword">null</span>;
        <span class="keyword">return</span> <span class="variable">$this</span>;  <span class="comment">// Fluent interface</span>
    }

    <span class="comment">// __callStatic - статический вызов несуществующего метода</span>
    <span class="keyword">public</span> <span class="keyword">static</span> <span class="keyword">function</span> <span class="function">__callStatic</span>(<span class="keyword">string</span> <span class="variable">$name</span>, <span class="variable">$args</span>) {
        <span class="keyword">return</span> <span class="new">new</span> <span class="keyword">self</span>()-><span class="function">__call</span>(<span class="variable">$name</span>, <span class="variable">$args</span>);
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">get</span>() {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">query</span>;
    }
}

<span class="comment">// Создается dynamic методы: select, where, orderBy</span>
<span class="variable">$builder</span> = <span class="keyword">new</span> <span class="function">Builder</span>();
<span class="variable">$builder</span>-><span class="function">select</span>(<span class="string">'*'</span>)-><span class="function">where</span>(<span class="string">'id = 1'</span>)-><span class="function">orderBy</span>(<span class="string">'name'</span>);
<span class="keyword">print_r</span>(<span class="variable">$builder</span>-><span class="function">get</span>());
<span class="comment">// ['select' => '*', 'where' => 'id = 1', 'orderBy' => 'name']</span></code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">__toString, __invoke, __clone</h3>
                    <div class="example-label">Прочие магические методы</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Price</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">float</span> <span class="variable">$amount</span>) {
        <span class="variable">$this</span>-><span class="variable">amount</span> = <span class="variable">$amount</span>;
    }

    <span class="comment">// __toString - преобразование объекта в строку</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__toString</span>() {
        <span class="keyword">return</span> <span class="function">sprintf</span>(<span class="string">'$%.2f'</span>, <span class="variable">$this</span>-><span class="variable">amount</span>);
    }

    <span class="comment">// __invoke - позволяет вызвать объект как функцию</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__invoke</span>(<span class="keyword">float</span> <span class="variable">$percent</span>) {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">amount</span> * (<span class="number">1</span> + <span class="variable">$percent</span> / <span class="number">100</span>);
    }

    <span class="comment">// __clone - вызывается при клонировании объекта</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__clone</span>() {
        <span class="keyword">echo</span> <span class="string">"Cloning price object"</span>;
    }
}

<span class="variable">$price</span> = <span class="keyword">new</span> <span class="function">Price</span>(<span class="number">99.99</span>);
<span class="keyword">echo</span> <span class="variable">$price</span>;  <span class="comment">// "$99.99" (вызовет __toString)</span>
<span class="keyword">echo</span> <span class="variable">$price</span>(<span class="number">10</span>);  <span class="comment">// 109.989 (вызовет __invoke с 10% скидка)</span>
<span class="variable">$copy</span> = <span class="keyword">clone</span> <span class="variable">$price</span>;  <span class="comment">// Вызовет __clone</span></code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">__debugInfo и __serialize</h3>
                    <div class="example-label">Отладка и сериализация</div>
                    <pre><code><span class="keyword">class</span> <span class="function">User</span> {
    <span class="keyword">private</span> <span class="variable">$id</span> = <span class="number">1</span>;
    <span class="keyword">private</span> <span class="variable">$password</span> = <span class="string">'secret'</span>;
    <span class="keyword">public</span> <span class="variable">$name</span> = <span class="string">'Alice'</span>;

    <span class="comment">// __debugInfo - контролирует что показывается в var_dump/print_r</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__debugInfo</span>() {
        <span class="keyword">return</span> [
            <span class="string">'id'</span> => <span class="variable">$this</span>-><span class="variable">id</span>,
            <span class="string">'name'</span> => <span class="variable">$this</span>-><span class="variable">name</span>,
            <span class="comment">// password скрыт!</span>
        ];
    }

    <span class="comment">// __serialize - контролирует сериализацию (PHP 7.4+)</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__serialize</span>() {
        <span class="keyword">return</span> [
            <span class="string">'id'</span> => <span class="variable">$this</span>-><span class="variable">id</span>,
            <span class="string">'name'</span> => <span class="variable">$this</span>-><span class="variable">name</span>
            <span class="comment">// password НЕ сериализуется</span>
        ];
    }

    <span class="comment">// __unserialize - восстановление из сериализации</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__unserialize</span>(<span class="variable">$data</span>) {
        <span class="variable">$this</span>-><span class="variable">id</span> = <span class="variable">$data</span>[<span class="string">'id'</span>];
        <span class="variable">$this</span>-><span class="variable">name</span> = <span class="variable">$data</span>[<span class="string">'name'</span>];
    }
}</code></pre>

                    <div class="remember-box">
                        __debugInfo и __serialize очень полезны для безопасности - скрывают чувствительные данные от отладки и сохранения. Используй их для password, API tokens, и прочих secrets!
                    </div>
                </div>
            </div>

            <!-- SECTION 8: NAMESPACES -->
            <div id="namespaces" class="section">
                <h2 class="section-title">8. Namespaces & PSR-4 Autoloading</h2>

                <div class="subsection">
                    <h3 class="subsection-title">Синтаксис Namespaces</h3>
                    <div class="content-block">
                        Namespaces избегают конфликты имен и организуют код логически. Объявление должно быть первым оператором в файле!
                    </div>
                    <div class="example-label">Базовые namespaces</div>
                    <pre><code><span class="comment">// app/Models/User.php</span>
<span class="keyword">namespace</span> <span class="variable">App\Models</span>;

<span class="keyword">class</span> <span class="function">User</span> {
    <span class="keyword">public</span> <span class="variable">$name</span> = <span class="string">'Alice'</span>;
}

<span class="comment">// app/Services/UserService.php</span>
<span class="keyword">namespace</span> <span class="variable">App\Services</span>;

<span class="keyword">use</span> <span class="variable">App\Models\User</span>;  <span class="comment">// Import</span>

<span class="keyword">class</span> <span class="function">UserService</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">getUser</span>() {
        <span class="keyword">return</span> <span class="keyword">new</span> <span class="function">User</span>();  <span class="comment">// Используем импортированный User</span>
    }
}

<span class="comment">// index.php или другой файл</span>
<span class="keyword">use</span> <span class="variable">App\Services\UserService</span>;
<span class="keyword">use</span> <span class="variable">App\Models\User</span> <span class="keyword">as</span> <span class="variable">UserModel</span>;  <span class="comment">// Alias</span>

<span class="variable">$service</span> = <span class="keyword">new</span> <span class="function">UserService</span>();</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">PSR-4 Autoloading с Composer</h3>
                    <div class="content-block">
                        PSR-4 - стандарт для автозагрузки классов. Composer автоматически генерирует автолоадер на основе конфигурации.
                    </div>
                    <div class="example-label">composer.json пример</div>
                    <pre><code>{
    <span class="string">"name"</span>: <span class="string">"myapp/core"</span>,
    <span class="string">"autoload"</span>: {
        <span class="string">"psr-4"</span>: {
            <span class="string">"App\\"</span>: <span class="string">"app/"</span>,
            <span class="string">"App\\Models\\"</span>: <span class="string">"app/models/"</span>,
            <span class="string">"App\\Services\\"</span>: <span class="string">"app/services/"</span>,
            <span class="string">"App\\Http\\Controllers\\"</span>: <span class="string">"app/http/controllers/"</span>,
            <span class="string">"Tests\\"</span>: <span class="string">"tests/"</span>
        }
    },
    <span class="string">"require"</span>: {
        <span class="string">"php"</span>: <span class="string">">=8.0"</span>
    }
}</code></pre>

                    <div class="content-block" style="margin-top: 20px;">
                        <strong>PSR-4 правило:</strong> Namespace должна соответствовать директории. Например:
                    </div>
                    <pre><code><span class="comment">// Файл: app/Models/User.php</span>
<span class="keyword">namespace</span> <span class="variable">App\Models</span>;  <span class="comment">// Namespace соответствует пути</span>

<span class="comment">// Файл: app/Http/Controllers/UserController.php</span>
<span class="keyword">namespace</span> <span class="variable">App\Http\Controllers</span>;  <span class="comment">// Полный путь в namespace</span></code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Использование Namespaces</h3>
                    <div class="example-label">Различные способы использования</div>
                    <pre><code><span class="comment">// Полное имя (fully qualified)</span>
<span class="variable">$user</span> = <span class="keyword">new</span> <span class="variable">App\Models\User</span>();

<span class="comment">// С use - более читаемо</span>
<span class="keyword">use</span> <span class="variable">App\Models\User</span>;
<span class="variable">$user</span> = <span class="keyword">new</span> <span class="function">User</span>();

<span class="comment">// Alias (as)</span>
<span class="keyword">use</span> <span class="variable">App\Models\User</span> <span class="keyword">as</span> <span class="variable">UserModel</span>;
<span class="variable">$user</span> = <span class="keyword">new</span> <span class="function">UserModel</span>();

<span class="comment">// Множественные import</span>
<span class="keyword">use</span> <span class="variable">App\Models\User</span>;
<span class="keyword">use</span> <span class="variable">App\Models\Post</span>;
<span class="keyword">use</span> <span class="variable">App\Services\UserService</span>;

<span class="comment">// Или с группировкой (PHP 7.1+)</span>
<span class="keyword">use</span> <span class="variable">App\Models\{User, Post}</span>;
<span class="keyword">use</span> <span class="variable">App\Services\{UserService, PostService</span> <span class="keyword">as</span> <span class="variable">PostHandler}</span>;

<span class="comment">// Относительное использование (для классов в текущей namespace)</span>
<span class="keyword">namespace</span> <span class="variable">App\Models</span>;

<span class="keyword">class</span> <span class="function">User</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">getPosts</span>() {
        <span class="keyword">return</span> <span class="keyword">new</span> <span class="function">Post</span>();  <span class="comment">// App\Models\Post автоматически</span>
    }
}</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Автоматическая загрузка классов</h3>
                    <div class="example-label">Как работает autoloader</div>
                    <pre><code><span class="comment">// После composer install, подключи автолоадер</span>
<span class="keyword">require</span> <span class="string">'vendor/autoload.php'</span>;  <span class="comment">// Composer автолоадер</span>

<span class="comment">// Теперь можешь использовать любой класс из конфигурации</span>
<span class="keyword">use</span> <span class="variable">App\Models\User</span>;
<span class="keyword">use</span> <span class="variable">App\Services\UserService</span>;

<span class="variable">$user</span> = <span class="keyword">new</span> <span class="function">User</span>();  <span class="comment">// Автолоадер загружает app/Models/User.php</span>
<span class="variable">$service</span> = <span class="keyword">new</span> <span class="function">UserService</span>();  <span class="comment">// Загружает app/Services/UserService.php</span></code></pre>

                    <div class="remember-box">
                        Когда создаешь новый класс, убедись что его namespace соответствует директории. Composer автоматически найдет и загрузит класс по имени!
                    </div>
                </div>
            </div>

            <!-- SECTION 9: ERROR HANDLING -->
            <div id="errors" class="section">
                <h2 class="section-title">9. Обработка ошибок</h2>

                <div class="subsection">
                    <h3 class="subsection-title">Exception Hierarchy</h3>
                    <div class="content-block">
                        PHP имеет иерархию исключений. Все исключения наследуют от Throwable (PHP 7+).
                    </div>
                    <table>
                        <tr>
                            <th>Тип</th>
                            <th>Описание</th>
                            <th>Примеры</th>
                        </tr>
                        <tr>
                            <td><strong>Throwable</strong></td>
                            <td>Базовый интерфейс для всех</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td><strong>Exception</strong></td>
                            <td>Обычные исключения (код ошибка)</td>
                            <td>InvalidArgumentException</td>
                        </tr>
                        <tr>
                            <td><strong>Error</strong></td>
                            <td>Ошибки PHP (не всегда ловятся)</td>
                            <td>TypeError, DivisionByZeroError</td>
                        </tr>
                        <tr>
                            <td><strong>ParseError</strong></td>
                            <td>Синтаксическая ошибка</td>
                            <td>eval() с плохим синтаксисом</td>
                        </tr>
                    </table>

                    <div class="example-label">Try-Catch-Finally</div>
                    <pre><code><span class="keyword">try</span> {
    <span class="variable">$file</span> = <span class="function">fopen</span>(<span class="string">'/nonexistent/file.txt'</span>, <span class="string">'r'</span>);
    <span class="keyword">if</span> (!<span class="variable">$file</span>) {
        <span class="keyword">throw</span> <span class="keyword">new</span> <span class="function">Exception</span>(<span class="string">'File not found'</span>);
    }
} <span class="keyword">catch</span> (<span class="function">Exception</span> <span class="variable">$e</span>) {
    <span class="keyword">echo</span> <span class="string">"Error: "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>();
} <span class="keyword">finally</span> {
    <span class="comment">// Выполняется ВСЕГДА, даже если есть исключение</span>
    <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$file</span>)) {
        <span class="function">fclose</span>(<span class="variable">$file</span>);
    }
}</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Множественные catch блоки</h3>
                    <div class="example-label">Обработка разных исключений</div>
                    <pre><code><span class="keyword">try</span> {
    <span class="variable">$user</span> = <span class="function">getUserById</span>(<span class="number">1</span>);
    <span class="variable">$age</span> = <span class="function">processAge</span>(<span class="variable">$user</span>[<span class="string">'age'</span>]);
} <span class="keyword">catch</span> (<span class="function">UserNotFoundException</span> <span class="variable">$e</span>) {
    <span class="keyword">echo</span> <span class="string">"User not found"</span>;
    <span class="function">log</span>(<span class="variable">$e</span>);
} <span class="keyword">catch</span> (<span class="function">InvalidAgeException</span> <span class="variable">$e</span>) {
    <span class="keyword">echo</span> <span class="string">"Invalid age"</span>;
} <span class="keyword">catch</span> (<span class="function">Exception</span> <span class="variable">$e</span>) {
    <span class="comment">// Ловим все остальные Exception-ы</span>
    <span class="keyword">echo</span> <span class="string">"Something went wrong"</span>;
} <span class="keyword">catch</span> (<span class="function">Throwable</span> <span class="variable">$e</span>) {
    <span class="comment">// Ловим и Exception и Error</span>
    <span class="keyword">echo</span> <span class="string">"Critical error"</span>;
}</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Пользовательские исключения</h3>
                    <div class="example-label">Custom exceptions</div>
                    <pre><code><span class="keyword">class</span> <span class="function">InvalidEmailException</span> <span class="keyword">extends</span> <span class="function">Exception</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">string</span> <span class="variable">$email</span>) {
        <span class="variable">$message</span> = <span class="string">"Invalid email: $email"</span>;
        <span class="keyword">parent</span>::<span class="function">__construct</span>(<span class="variable">$message</span>);
    }
}

<span class="keyword">class</span> <span class="function">ValidationException</span> <span class="keyword">extends</span> <span class="function">Exception</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">array</span> <span class="variable">$errors</span>) {
        <span class="variable">$this</span>-><span class="variable">errors</span> = <span class="variable">$errors</span>;
        <span class="keyword">parent</span>::<span class="function">__construct</span>(<span class="function">json_encode</span>(<span class="variable">$errors</span>));
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">getErrors</span>() {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">errors</span>;
    }
}

<span class="keyword">function</span> <span class="function">validateEmail</span>(<span class="keyword">string</span> <span class="variable">$email</span>) {
    <span class="keyword">if</span> (!<span class="function">filter_var</span>(<span class="variable">$email</span>, <span class="keyword">FILTER_VALIDATE_EMAIL</span>)) {
        <span class="keyword">throw</span> <span class="keyword">new</span> <span class="function">InvalidEmailException</span>(<span class="variable">$email</span>);
    }
}

<span class="keyword">try</span> {
    <span class="function">validateEmail</span>(<span class="string">"invalid"</span>);
} <span class="keyword">catch</span> (<span class="function">InvalidEmailException</span> <span class="variable">$e</span>) {
    <span class="keyword">echo</span> <span class="variable">$e</span>-><span class="function">getMessage</span>();
}</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Error Reporting и set_exception_handler</h3>
                    <div class="example-label">Глобальная обработка ошибок</div>
                    <pre><code><span class="comment">// Установить уровень ошибок</span>
<span class="function">error_reporting</span>(<span class="keyword">E_ALL</span>);  <span class="comment">// Все ошибки</span>
<span class="function">ini_set</span>(<span class="string">'display_errors'</span>, <span class="number">1</span>);  <span class="comment">// Показывать ошибки (development)</span>
<span class="function">ini_set</span>(<span class="string">'log_errors'</span>, <span class="number">1</span>);  <span class="comment">// Логировать ошибки</span>
<span class="function">ini_set</span>(<span class="string">'error_log'</span>, <span class="string">'/var/log/php-errors.log'</span>);

<span class="comment">// Глобальный обработчик исключений</span>
<span class="function">set_exception_handler</span>(<span class="keyword">function</span>(<span class="variable">$e</span>) {
    <span class="keyword">echo</span> <span class="string">"Exception caught: "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>();
    <span class="function">log_error</span>(<span class="variable">$e</span>);
    <span class="function">http_response_code</span>(<span class="number">500</span>);
});

<span class="comment">// Глобальный обработчик ошибок</span>
<span class="function">set_error_handler</span>(<span class="keyword">function</span>(<span class="variable">$errno</span>, <span class="variable">$errstr</span>, <span class="variable">$errfile</span>, <span class="variable">$errline</span>) {
    <span class="keyword">if</span> (<span class="variable">$errno</span> === <span class="keyword">E_USER_ERROR</span>) {
        <span class="keyword">throw</span> <span class="keyword">new</span> <span class="function">Exception</span>(<span class="variable">$errstr</span>);
    }
    <span class="keyword">return</span> <span class="keyword">false</span>;  <span class="comment">// Позволить стандартному обработчику работать</span>
});

<span class="comment">// Вызови пользовательскую ошибку</span>
<span class="function">trigger_error</span>(<span class="string">"Something bad"</span>, <span class="keyword">E_USER_WARNING</span>);</code></pre>

                    <div class="remember-box">
                        Используй try/catch для предсказуемых ошибок. Используй set_exception_handler для ловли всех необработанных исключений. В production, логируй все ошибки в файл, не показывай пользователю!
                    </div>
                </div>
            </div>

            <!-- SECTION 10: PHP 8+ FEATURES -->
            <div id="php8" class="section">
                <h2 class="section-title">10. PHP 8.x Новые фичи</h2>

                <div class="subsection">
                    <h3 class="subsection-title">Named Arguments</h3>
                    <div class="example-label">Именованные аргументы</div>
                    <pre><code><span class="keyword">function</span> <span class="function">createUser</span>(<span class="keyword">string</span> <span class="variable">$name</span>, <span class="keyword">string</span> <span class="variable">$email</span>, <span class="keyword">int</span> <span class="variable">$age</span>, <span class="keyword">bool</span> <span class="variable">$active</span> = <span class="keyword">true</span>) {
    <span class="keyword">return</span> [<span class="string">'name'</span> => <span class="variable">$name</span>, <span class="string">'email'</span> => <span class="variable">$email</span>, <span class="string">'age'</span> => <span class="variable">$age</span>, <span class="string">'active'</span> => <span class="variable">$active</span>];
}

<span class="comment">// Позиционные аргументы (старый способ)</span>
<span class="function">createUser</span>(<span class="string">"Alice"</span>, <span class="string">"alice@ex.com"</span>, <span class="number">30</span>, <span class="keyword">false</span>);

<span class="comment">// Именованные аргументы (PHP 8)</span>
<span class="function">createUser</span>(
    <span class="string">name:</span> <span class="string">"Alice"</span>,
    <span class="string">email:</span> <span class="string">"alice@ex.com"</span>,
    <span class="string">age:</span> <span class="number">30</span>,
    <span class="string">active:</span> <span class="keyword">false</span>
);

<span class="comment">// Можно менять порядок!</span>
<span class="function">createUser</span>(
    <span class="string">email:</span> <span class="string">"alice@ex.com"</span>,
    <span class="string">age:</span> <span class="number">30</span>,
    <span class="string">name:</span> <span class="string">"Alice"</span>
);

<span class="comment">// Смешивать позиционные и именованные</span>
<span class="function">createUser</span>(<span class="string">"Alice"</span>, <span class="string">"alice@ex.com"</span>, <span class="string">age:</span> <span class="number">30</span>);</code></pre>

                    <div class="remember-box">
                        Named arguments делают код более читаемым и защищают от ошибок при изменении порядка параметров. Отлично подходят для конфигурационных функций!
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Match Expression</h3>
                    <div class="example-label">Match выражение вместо switch</div>
                    <pre><code><span class="comment">// Старый способ (switch)</span>
<span class="variable">$status</span> = <span class="string">"pending"</span>;
<span class="keyword">switch</span> (<span class="variable">$status</span>) {
    <span class="keyword">case</span> <span class="string">"pending"</span>:
        <span class="variable">$label</span> = <span class="string">"Pending Review"</span>;
        <span class="keyword">break</span>;
    <span class="keyword">case</span> <span class="string">"approved"</span>:
        <span class="variable">$label</span> = <span class="string">"Approved"</span>;
        <span class="keyword">break</span>;
    <span class="keyword">default</span>:
        <span class="variable">$label</span> = <span class="string">"Unknown"</span>;
}

<span class="comment">// Новый способ (match - PHP 8)</span>
<span class="variable">$label</span> = <span class="keyword">match</span>(<span class="variable">$status</span>) {
    <span class="string">"pending"</span> => <span class="string">"Pending Review"</span>,
    <span class="string">"approved"</span> => <span class="string">"Approved"</span>,
    <span class="string">"rejected"</span> => <span class="string">"Rejected"</span>,
    <span class="keyword">default</span> => <span class="string">"Unknown"</span>
};

<span class="comment">// Match с несколькими условиями</span>
<span class="variable">$message</span> = <span class="keyword">match</span>(<span class="variable">$statusCode</span>) {
    <span class="number">200</span>, <span class="number">201</span> => <span class="string">"Success"</span>,
    <span class="number">400</span>, <span class="number">401</span>, <span class="number">403</span> => <span class="string">"Client error"</span>,
    <span class="number">500</span>, <span class="number">502</span>, <span class="number">503</span> => <span class="string">"Server error"</span>,
    <span class="keyword">default</span> => <span class="string">"Unknown"</span>
};

<span class="comment">// Match обычно приносит условие</span>
<span class="variable">$price</span> = <span class="keyword">match</span>(<span class="keyword">true</span>) {
    <span class="variable">$quantity</span> > <span class="number">100</span> => <span class="number">50</span>,
    <span class="variable">$quantity</span> > <span class="number">50</span> => <span class="number">75</span>,
    <span class="keyword">default</span> => <span class="number">100</span>
};</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Enums (PHP 8.1+)</h3>
                    <div class="example-label">Перечисления</div>
                    <pre><code><span class="comment">// Pure Enum (без значений)</span>
<span class="keyword">enum</span> <span class="function">Status</span> {
    <span class="keyword">case</span> <span class="variable">PENDING</span>;
    <span class="keyword">case</span> <span class="variable">APPROVED</span>;
    <span class="keyword">case</span> <span class="variable">REJECTED</span>;
}

<span class="comment">// Backed Enum (с значениями)</span>
<span class="keyword">enum</span> <span class="function">HttpStatus</span>: <span class="keyword">int</span> {
    <span class="keyword">case</span> <span class="variable">OK</span> = <span class="number">200</span>;
    <span class="keyword">case</span> <span class="variable">CREATED</span> = <span class="number">201</span>;
    <span class="keyword">case</span> <span class="variable">BAD_REQUEST</span> = <span class="number">400</span>;
    <span class="keyword">case</span> <span class="variable">NOT_FOUND</span> = <span class="number">404</span>;
    <span class="keyword">case</span> <span class="variable">SERVER_ERROR</span> = <span class="number">500</span>;
}

<span class="comment">// Enum с методами</span>
<span class="keyword">enum</span> <span class="function">Role</span>: <span class="keyword">string</span> {
    <span class="keyword">case</span> <span class="variable">ADMIN</span> = <span class="string">'admin'</span>;
    <span class="keyword">case</span> <span class="variable">USER</span> = <span class="string">'user'</span>;
    <span class="keyword">case</span> <span class="variable">GUEST</span> = <span class="string">'guest'</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">label</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="keyword">match</span>(<span class="variable">$this</span>) {
            <span class="keyword">self</span>::<span class="variable">ADMIN</span> => <span class="string">'Administrator'</span>,
            <span class="keyword">self</span>::<span class="variable">USER</span> => <span class="string">'Regular User'</span>,
            <span class="keyword">self</span>::<span class="variable">GUEST</span> => <span class="string">'Guest User'</span>,
        };
    }
}

<span class="comment">// Использование</span>
<span class="variable">$role</span> = <span class="function">Role</span>::<span class="variable">ADMIN</span>;
<span class="keyword">echo</span> <span class="variable">$role</span>-><span class="function">value</span>;   <span class="comment">// "admin"</span>
<span class="keyword">echo</span> <span class="variable">$role</span>-><span class="function">label</span>();  <span class="comment">// "Administrator"</span>

<span class="comment">// Получить enum по значению</span>
<span class="variable">$status</span> = <span class="function">HttpStatus</span>::<span class="function">tryFrom</span>(<span class="number">404</span>);  <span class="comment">// HttpStatus::NOT_FOUND</span></code></pre>

                    <div class="remember-box">
                        Enums обеспечивают type-safe способ работать с ограниченным набором значений. Используй их вместо констант или строк для лучшей типобезопасности!
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Nullsafe Operator</h3>
                    <div class="example-label">?-> оператор</div>
                    <pre><code><span class="comment">// Старый способ (много проверок)</span>
<span class="variable">$name</span> = <span class="keyword">null</span>;
<span class="keyword">if</span> (<span class="variable">$user</span> !== <span class="keyword">null</span> && <span class="variable">$user</span>-><span class="variable">profile</span> !== <span class="keyword">null</span>) {
    <span class="variable">$name</span> = <span class="variable">$user</span>-><span class="variable">profile</span>-><span class="variable">name</span>;
}

<span class="comment">// Новый способ (PHP 8 nullsafe)</span>
<span class="variable">$name</span> = <span class="variable">$user</span>?-><span class="variable">profile</span>?-><span class="variable">name</span>;

<span class="comment">// Если $user null, весь результат null</span>
<span class="keyword">echo</span> <span class="variable">$name</span> ?? <span class="string">"No name"</span>;

<span class="comment">// С методами</span>
<span class="variable">$result</span> = <span class="variable">$user</span>?-><span class="variable">profile</span>?-><span class="function">getName</span>();</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">First-class Callable Syntax (PHP 8.1+)</h3>
                    <div class="example-label">Функции как значения</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Math</span> {
    <span class="keyword">public</span> <span class="keyword">static</span> <span class="keyword">function</span> <span class="function">add</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) {
        <span class="keyword">return</span> <span class="variable">$a</span> + <span class="variable">$b</span>;
    }
}

<span class="comment">// Старый способ</span>
<span class="variable">$adder</span> = [<span class="function">Math</span>::<span class="keyword">class</span>, <span class="string">'add'</span>];
<span class="keyword">echo</span> <span class="variable">$adder</span>(<span class="number">5</span>, <span class="number">3</span>);

<span class="comment">// Новый способ (PHP 8.1)</span>
<span class="variable">$adder</span> = <span class="function">Math</span>::<span class="function">add</span>(...);  <span class="comment">// Синтаксис ...() делает функцию объектом</span>
<span class="keyword">echo</span> <span class="variable">$adder</span>(<span class="number">5</span>, <span class="number">3</span>);

<span class="comment">// С методами</span>
<span class="variable">$user</span> = <span class="keyword">new</span> <span class="function">User</span>();
<span class="variable">$getName</span> = <span class="variable">$user</span>-><span class="function">getName</span>(...);
<span class="keyword">echo</span> <span class="variable">$getName</span>();

<span class="comment">// Передать в функцию высшего порядка</span>
<span class="variable">$numbers</span> = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="variable">$result</span> = <span class="function">array_map</span>(<span class="function">intval</span>(...), <span class="variable">$numbers</span>);</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Readonly Properties и Classes (PHP 8.1+)</h3>
                    <div class="example-label">Неизменяемые свойства</div>
                    <pre><code><span class="keyword">class</span> <span class="function">ImmutableUser</span> {
    <span class="keyword">public</span> <span class="keyword">readonly</span> <span class="keyword">int</span> <span class="variable">$id</span>;
    <span class="keyword">public</span> <span class="keyword">readonly</span> <span class="keyword">string</span> <span class="variable">$email</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">int</span> <span class="variable">$id</span>, <span class="keyword">string</span> <span class="variable">$email</span>) {
        <span class="variable">$this</span>-><span class="variable">id</span> = <span class="variable">$id</span>;
        <span class="variable">$this</span>-><span class="variable">email</span> = <span class="variable">$email</span>;
    }
}

<span class="variable">$user</span> = <span class="keyword">new</span> <span class="function">ImmutableUser</span>(<span class="number">1</span>, <span class="string">"test@ex.com"</span>);
<span class="variable">$user</span>-><span class="variable">email</span> = <span class="string">"new@ex.com"</span>;  <span class="comment">// ERROR! readonly свойство</span>

<span class="comment">// Readonly класс (PHP 8.2) - все свойства readonly</span>
<span class="keyword">readonly</span> <span class="keyword">class</span> <span class="function">Point</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(
        <span class="keyword">public</span> <span class="keyword">int</span> <span class="variable">$x</span>,
        <span class="keyword">public</span> <span class="keyword">int</span> <span class="variable">$y</span>
    ) {}
}</code></pre>
                </div>
            </div>

            <!-- SECTION 11: GENERATORS -->
            <div id="generators" class="section">
                <h2 class="section-title">11. Генераторы (Generators)</h2>

                <div class="subsection">
                    <h3 class="subsection-title">yield ключевое слово</h3>
                    <div class="example-label">Основы генераторов</div>
                    <pre><code><span class="comment">// Обычная функция (загружает все в память)</span>
<span class="keyword">function</span> <span class="function">getNumbers</span>(<span class="variable">$start</span>, <span class="variable">$end</span>) {
    <span class="variable">$result</span> = [];
    <span class="keyword">for</span> (<span class="variable">$i</span> = <span class="variable">$start</span>; <span class="variable">$i</span> <= <span class="variable">$end</span>; <span class="variable">$i</span>++) {
        <span class="variable">$result</span>[] = <span class="variable">$i</span> * <span class="variable">$i</span>;
    }
    <span class="keyword">return</span> <span class="variable">$result</span>;
}

<span class="variable">$numbers</span> = <span class="function">getNumbers</span>(<span class="number">1</span>, <span class="number">1000000</span>);  <span class="comment">// Создает массив из 1M элементов в памяти!</span>

<span class="comment">// Генератор (ленивое вычисление, по одному элементу за раз)</span>
<span class="keyword">function</span> <span class="function">yieldNumbers</span>(<span class="variable">$start</span>, <span class="variable">$end</span>) {
    <span class="keyword">for</span> (<span class="variable">$i</span> = <span class="variable">$start</span>; <span class="variable">$i</span> <= <span class="variable">$end</span>; <span class="variable">$i</span>++) {
        <span class="keyword">yield</span> <span class="variable">$i</span> * <span class="variable">$i</span>;  <span class="comment">// Возвращает значение, сохраняет состояние</span>
    }
}

<span class="comment">// Использование генератора</span>
<span class="keyword">foreach</span> (<span class="function">yieldNumbers</span>(<span class="number">1</span>, <span class="number">1000000</span>) <span class="keyword">as</span> <span class="variable">$number</span>) {
    <span class="keyword">echo</span> <span class="variable">$number</span> . <span class="string">"\n"</span>;  <span class="comment">// Обрабатывает по одному элементу, минимум памяти</span>
}</code></pre>

                    <div class="remember-box">
                        Генераторы экономят память! Используй их для больших наборов данных, чтения файлов, результатов БД. Они возвращают по одному элементу за раз вместо загрузки всего в массив.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Ключи и yield с массивами</h3>
                    <div class="example-label">yield с ключами</div>
                    <pre><code><span class="comment">// yield с ключами (для ассоциативных данных)</span>
<span class="keyword">function</span> <span class="function">readCsvFile</span>(<span class="keyword">string</span> <span class="variable">$file</span>) {
    <span class="variable">$fp</span> = <span class="function">fopen</span>(<span class="variable">$file</span>, <span class="string">'r'</span>);
    <span class="variable">$header</span> = <span class="function">fgetcsv</span>(<span class="variable">$fp</span>);
    <span class="variable">$line</span> = <span class="number">1</span>;

    <span class="keyword">while</span> ((<span class="variable">$row</span> = <span class="function">fgetcsv</span>(<span class="variable">$fp</span>)) !== <span class="keyword">false</span>) {
        <span class="variable">$data</span> = <span class="function">array_combine</span>(<span class="variable">$header</span>, <span class="variable">$row</span>);
        <span class="keyword">yield</span> <span class="variable">$line</span> => <span class="variable">$data</span>;  <span class="comment">// yield с ключом</span>
        <span class="variable">$line</span>++;
    }
    <span class="function">fclose</span>(<span class="variable">$fp</span>);
}

<span class="comment">// Использование - читает файл построчно</span>
<span class="keyword">foreach</span> (<span class="function">readCsvFile</span>(<span class="string">'data.csv'</span>) <span class="keyword">as</span> <span class="variable">$lineNum</span> => <span class="variable">$row</span>) {
    <span class="keyword">echo</span> <span class="string">"Line $lineNum: "</span> . <span class="variable">$row</span>[<span class="string">'email'</span>];
}</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">yield from (делегирование)</h3>
                    <div class="example-label">yield from для генераторов</div>
                    <pre><code><span class="keyword">function</span> <span class="function">innerGenerator</span>() {
    <span class="keyword">yield</span> <span class="number">1</span>;
    <span class="keyword">yield</span> <span class="number">2</span>;
    <span class="keyword">yield</span> <span class="number">3</span>;
}

<span class="keyword">function</span> <span class="function">outerGenerator</span>() {
    <span class="keyword">yield</span> <span class="number">0</span>;
    <span class="keyword">yield from</span> <span class="function">innerGenerator</span>();  <span class="comment">// Делегирует всем значениям</span>
    <span class="keyword">yield</span> <span class="number">4</span>;
}

<span class="keyword">foreach</span> (<span class="function">outerGenerator</span>() <span class="keyword">as</span> <span class="variable">$value</span>) {
    <span class="keyword">echo</span> <span class="variable">$value</span>;  <span class="comment">// 0 1 2 3 4</span>
}</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Практический пример: Пагинация</h3>
                    <div class="example-label">Генератор для пагинации</div>
                    <pre><code><span class="comment">// Получить пользователей в батчах (для пагинации в БД)</span>
<span class="keyword">function</span> <span class="function">getUsersInBatches</span>(<span class="keyword">int</span> <span class="variable">$batchSize</span> = <span class="number">100</span>) {
    <span class="variable">$page</span> = <span class="number">1</span>;

    <span class="keyword">while</span> (<span class="keyword">true</span>) {
        <span class="variable">$users</span> = <span class="function">User</span>::<span class="function">paginate</span>(<span class="variable">$batchSize</span>, <span class="variable">$page</span>);

        <span class="keyword">if</span> (<span class="variable">$users</span>-><span class="function">isEmpty</span>()) {
            <span class="keyword">break</span>;
        }

        <span class="keyword">foreach</span> (<span class="variable">$users</span> <span class="keyword">as</span> <span class="variable">$user</span>) {
            <span class="keyword">yield</span> <span class="variable">$user</span>;
        }

        <span class="variable">$page</span>++;
    }
}

<span class="comment">// Обрабатывать всех пользователей БЕЗ загрузки всех в памяти</span>
<span class="keyword">foreach</span> (<span class="function">getUsersInBatches</span>(<span class="number">1000</span>) <span class="keyword">as</span> <span class="variable">$user</span>) {
    <span class="variable">$user</span>-><span class="function">sendNotification</span>();
}</code></pre>
                </div>
            </div>

            <!-- SECTION 12: CLOSURES -->
            <div id="closures" class="section">
                <h2 class="section-title">12. Closures и Anonymous Functions</h2>

                <div class="subsection">
                    <h3 class="subsection-title">Базовые Closures</h3>
                    <div class="example-label">Анонимные функции</div>
                    <pre><code><span class="comment">// Анонимная функция (Closure)</span>
<span class="variable">$greeting</span> = <span class="keyword">function</span>(<span class="variable">$name</span>) {
    <span class="keyword">return</span> <span class="string">"Hello, $name!"</span>;
};

<span class="keyword">echo</span> <span class="variable">$greeting</span>(<span class="string">"Alice"</span>);  <span class="comment">// "Hello, Alice!"</span>

<span class="comment">// Передать closure как параметр</span>
<span class="keyword">function</span> <span class="function">processUsers</span>(<span class="keyword">array</span> <span class="variable">$users</span>, <span class="keyword">callable</span> <span class="variable">$callback</span>) {
    <span class="keyword">foreach</span> (<span class="variable">$users</span> <span class="keyword">as</span> <span class="variable">$user</span>) {
        <span class="variable">$callback</span>(<span class="variable">$user</span>);
    }
}

<span class="variable">$users</span> = [
    [<span class="string">'name'</span> => <span class="string">'Alice'</span>],
    [<span class="string">'name'</span> => <span class="string">'Bob'</span>]
];

<span class="function">processUsers</span>(<span class="variable">$users</span>, <span class="keyword">function</span>(<span class="variable">$user</span>) {
    <span class="keyword">echo</span> <span class="string">"Processing "</span> . <span class="variable">$user</span>[<span class="string">'name'</span>];
});</code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">use Keyword - Захват переменных</h3>
                    <div class="example-label">Closure и область видимости</div>
                    <pre><code><span class="variable">$multiplier</span> = <span class="number">3</span>;

<span class="comment">// Closure по умолчанию НЕ имеет доступа к переменным снаружи</span>
<span class="variable">$multiply</span> = <span class="keyword">function</span>(<span class="variable">$x</span>) {
    <span class="keyword">return</span> <span class="variable">$x</span> * <span class="variable">$multiplier</span>;  <span class="comment">// ERROR! $multiplier не доступна</span>
};

<span class="comment">// use - захватить переменную из внешней области</span>
<span class="variable">$multiply</span> = <span class="keyword">function</span>(<span class="variable">$x</span>) <span class="keyword">use</span> (<span class="variable">$multiplier</span>) {
    <span class="keyword">return</span> <span class="variable">$x</span> * <span class="variable">$multiplier</span>;
};
<span class="keyword">echo</span> <span class="variable">$multiply</span>(<span class="number">5</span>);  <span class="comment">// 15</span>

<span class="comment">// use по ссылке (&) - захватить переменную и позволить изменять</span>
<span class="variable">$counter</span> = <span class="number">0</span>;
<span class="variable">$increment</span> = <span class="keyword">function</span>() <span class="keyword">use</span> (&<span class="variable">$counter</span>) {
    <span class="variable">$counter</span>++;
};

<span class="variable">$increment</span>();
<span class="variable">$increment</span>();
<span class="keyword">echo</span> <span class="variable">$counter</span>;  <span class="comment">// 2</span>

<span class="comment">// Несколько переменных в use</span>
<span class="variable">$tax</span> = <span class="number">0.1</span>;
<span class="variable">$discount</span> = <span class="number">0.05</span>;
<span class="variable">$calculatePrice</span> = <span class="keyword">function</span>(<span class="variable">$price</span>) <span class="keyword">use</span> (<span class="variable">$tax</span>, <span class="variable">$discount</span>) {
    <span class="keyword">return</span> <span class="variable">$price</span> * (<span class="number">1</span> + <span class="variable">$tax</span>) * (<span class="number">1</span> - <span class="variable">$discount</span>);
};</code></pre>

                    <div class="remember-box">
                        use() захватывает значение в момент определения функции. Используй use(&$var) для захвата по ссылке, если нужны изменения!
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Arrow Functions (PHP 7.4+)</h3>
                    <div class="example-label">Краткий синтаксис fn =></div>
                    <pre><code><span class="comment">// Старый способ (анонимная функция)</span>
<span class="variable">$numbers</span> = [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="variable">$squared</span> = <span class="function">array_map</span>(<span class="keyword">function</span>(<span class="variable">$n</span>) {
    <span class="keyword">return</span> <span class="variable">$n</span> * <span class="variable">$n</span>;
}, <span class="variable">$numbers</span>);

<span class="comment">// Новый способ (arrow function)</span>
<span class="variable">$squared</span> = <span class="function">array_map</span>(<span class="keyword">fn</span>(<span class="variable">$n</span>) => <span class="variable">$n</span> * <span class="variable">$n</span>, <span class="variable">$numbers</span>);

<span class="comment">// Arrow functions автоматически захватывают переменные!</span>
<span class="variable">$multiplier</span> = <span class="number">5</span>;
<span class="variable">$multiply</span> = <span class="keyword">fn</span>(<span class="variable">$x</span>) => <span class="variable">$x</span> * <span class="variable">$multiplier</span>;  <span class="comment">// $multiplier захвачена автоматически</span>
<span class="keyword">echo</span> <span class="variable">$multiply</span>(<span class="number">3</span>);  <span class="comment">// 15</span>

<span class="comment">// Arrow functions - один выражение, автоматически возвращает</span>
<span class="variable">$getFullName</span> = <span class="keyword">fn</span>(<span class="variable">$user</span>) => <span class="variable">$user</span>[<span class="string">'first'</span>] . <span class="string">" "</span> . <span class="variable">$user</span>[<span class="string">'last'</span>];

<span class="comment">// С несколькими параметрами</span>
<span class="variable">$sum</span> = <span class="keyword">fn</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) => <span class="variable">$a</span> + <span class="variable">$b</span>;
<span class="keyword">echo</span> <span class="variable">$sum</span>(<span class="number">5</span>, <span class="number">3</span>);  <span class="comment">// 8</span></code></pre>

                    <div class="remember-box">
                        Arrow functions идеальны для простых операций! Они автоматически захватывают переменные, поэтому не нужно use(). Но они могут содержать только ОДНО выражение!
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Binding и $this в Closures</h3>
                    <div class="example-label">Closure и объекты</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Calculator</span> {
    <span class="keyword">private</span> <span class="variable">$value</span> = <span class="number">10</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">getAdder</span>() {
        <span class="comment">// Closure может использовать $this если определена в методе класса</span>
        <span class="keyword">return</span> <span class="keyword">function</span>(<span class="variable">$x</span>) {
            <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">value</span> + <span class="variable">$x</span>;  <span class="comment">// Доступ к $this</span>
        };
    }
}

<span class="variable">$calc</span> = <span class="keyword">new</span> <span class="function">Calculator</span>();
<span class="variable">$adder</span> = <span class="variable">$calc</span>-><span class="function">getAdder</span>();
<span class="keyword">echo</span> <span class="variable">$adder</span>(<span class="number">5</span>);  <span class="comment">// 15</span>

<span class="comment">// bindTo - привязать closure к другому объекту</span>
<span class="keyword">class</span> <span class="function">Price</span> {
    <span class="keyword">private</span> <span class="variable">$amount</span> = <span class="number">100</span>;
}

<span class="variable">$getClosure</span> = <span class="keyword">function</span>() {
    <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">amount</span>;
};

<span class="variable">$price</span> = <span class="keyword">new</span> <span class="function">Price</span>();
<span class="variable">$bound</span> = <span class="variable">$getClosure</span>-><span class="function">bindTo</span>(<span class="variable">$price</span>, <span class="function">Price</span>::<span class="keyword">class</span>);
<span class="keyword">echo</span> <span class="variable">$bound</span>();  <span class="comment">// 100</span></code></pre>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Практический пример: Middleware</h3>
                    <div class="example-label">Closure для middleware</div>
                    <pre><code><span class="comment">// Middleware как closures</span>
<span class="variable">$request</span> = [<span class="string">'method'</span> => <span class="string">'POST'</span>, <span class="string">'path'</span> => <span class="string">'/api/users'</span>];
<span class="variable">$response</span> = [<span class="string">'status'</span> => <span class="number">200</span>];

<span class="comment">// Middleware для логирования</span>
<span class="variable">$logger</span> = <span class="keyword">function</span>(<span class="variable">$next</span>) {
    <span class="keyword">return</span> <span class="keyword">function</span>(<span class="variable">$req</span>) <span class="keyword">use</span> (<span class="variable">$next</span>) {
        <span class="keyword">echo</span> <span class="string">"Request: "</span> . <span class="variable">$req</span>[<span class="string">'method'</span>] . <span class="string">" "</span> . <span class="variable">$req</span>[<span class="string">'path'</span>];
        <span class="variable">$response</span> = <span class="variable">$next</span>(<span class="variable">$req</span>);
        <span class="keyword">echo</span> <span class="string">"Response: "</span> . <span class="variable">$response</span>[<span class="string">'status'</span>];
        <span class="keyword">return</span> <span class="variable">$response</span>;
    };
};

<span class="comment">// Middleware для авторизации</span>
<span class="variable">$auth</span> = <span class="keyword">function</span>(<span class="variable">$next</span>) {
    <span class="keyword">return</span> <span class="keyword">function</span>(<span class="variable">$req</span>) <span class="keyword">use</span> (<span class="variable">$next</span>) {
        <span class="keyword">if</span> (!<span class="function">isset</span>(<span class="variable">$req</span>[<span class="string">'token'</span>])) {
            <span class="keyword">return</span> [<span class="string">'status'</span> => <span class="number">401</span>];
        }
        <span class="keyword">return</span> <span class="variable">$next</span>(<span class="variable">$req</span>);
    };
};

<span class="comment">// Основной обработчик</span>
<span class="variable">$handler</span> = <span class="keyword">function</span>(<span class="variable">$req</span>) {
    <span class="keyword">return</span> [<span class="string">'status'</span> => <span class="number">200</span>, <span class="string">'body'</span> => <span class="string">'Success'</span>];
};

<span class="comment">// Compose middleware</span>
<span class="variable">$pipeline</span> = <span class="variable">$logger</span>(<span class="variable">$auth</span>(<span class="variable">$handler</span>));
<span class="variable">$result</span> = <span class="variable">$pipeline</span>(<span class="variable">$request</span>);</code></pre>
                </div>
            </div>

        </div>
    </div>

    <script>
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(el => {
                el.classList.remove('active');
            });

            // Show selected section
            document.getElementById(sectionId).classList.add('active');

            // Update nav items
            document.querySelectorAll('.nav-item').forEach(el => {
                el.classList.remove('active');
            });
            event.target.classList.add('active');
        }

        // Collapsible functionality
        document.querySelectorAll('.collapsible').forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('active');
                const content = this.nextElementSibling;
                if (content && content.classList.contains('collapse-content')) {
                    content.classList.toggle('active');
                }
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + number to navigate sections
            if ((e.ctrlKey || e.metaKey) && !isNaN(e.key)) {
                const navItems = document.querySelectorAll('.nav-item');
                const index = parseInt(e.key) - 1;
                if (index >= 0 && index < navItems.length) {
                    navItems[index].click();
                }
            }
        });
    </script>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>lucide.createIcons();</script>
</body>
</html>
@endverbatim