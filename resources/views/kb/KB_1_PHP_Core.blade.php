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

  /* ═══ Data tables (Шпаргалка) ═══ */
  .data-table {
    width: 100%;
    border-collapse: collapse;
    margin: 14px 0 22px;
    background: #fff;
    box-shadow: 0 1px 2px rgba(0,0,0,0.04);
    border-radius: 6px;
    overflow: hidden;
  }
  .data-table th {
    background: #F3F4F6;
    color: #1F2937;
    text-align: left;
    padding: 10px 14px;
    font-size: 13px;
    font-weight: 700;
    border-bottom: 2px solid #D1D5DB;
  }
  .data-table td {
    padding: 9px 14px;
    font-size: 13px;
    color: #374151;
    border-bottom: 1px solid #E5E7EB;
    vertical-align: top;
    line-height: 1.55;
  }
  .data-table tr:last-child td { border-bottom: none; }
  .data-table tr:hover td { background: #F9FAFB; }
  .data-table code {
    background: #EFF6FF; color: #1D4ED8;
    padding: 1px 6px; border-radius: 3px; font-size: 12px;
  }

  /* ═══ Q&A items (Вопросник) ═══ */
  .qa-item {
    background: #fff;
    border: 1px solid #E5E7EB;
    border-radius: 6px;
    margin-bottom: 10px;
    overflow: hidden;
    transition: box-shadow 0.15s;
  }
  .qa-item:hover { box-shadow: 0 2px 6px rgba(0,0,0,0.05); }
  .qa-q {
    padding: 13px 18px;
    font-weight: 600;
    font-size: 14px;
    color: #1F2937;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
    user-select: none;
  }
  .qa-q::before {
    content: '▸';
    color: #9CA3AF;
    font-size: 12px;
    transition: transform 0.18s;
    flex-shrink: 0;
  }
  .qa-item.open .qa-q::before { transform: rotate(90deg); }
  .qa-q .q-num {
    background: #EFF6FF; color: #1D4ED8;
    padding: 2px 8px; border-radius: 4px;
    font-size: 11px; font-weight: 700;
    margin-right: 2px;
  }
  .qa-a {
    max-height: 0;
    overflow: hidden;
    padding: 0 18px;
    color: #374151;
    font-size: 13.5px;
    line-height: 1.7;
    border-top: 1px solid transparent;
    transition: max-height 0.25s ease, padding 0.2s ease;
  }
  .qa-item.open .qa-a {
    max-height: 800px;
    padding: 14px 18px 16px;
    border-top-color: #E5E7EB;
  }
  .qa-a code {
    background: #F3F4F6; color: #DC2626;
    padding: 1px 5px; border-radius: 3px; font-size: 12.5px;
  }
  .qa-a p { margin: 0 0 8px; }
  .qa-a p:last-child { margin-bottom: 0; }

  /* ═══ Practice tasks ═══ */
  .practice-task {
    background: #fff;
    border: 1px solid #E5E7EB;
    border-left: 4px solid var(--primary);
    border-radius: 6px;
    padding: 18px 20px;
    margin-bottom: 18px;
  }
  .practice-task-title {
    font-size: 15px;
    font-weight: 700;
    color: #1F2937;
    margin: 0 0 6px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .practice-task-meta {
    display: inline-block;
    background: #F3F4F6;
    color: #6B7280;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    margin-left: 6px;
  }
  .practice-step-label {
    display: inline-block;
    background: #EFF6FF;
    color: #1D4ED8;
    padding: 3px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 700;
    margin: 12px 0 6px;
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }
  .practice-pitfalls {
    background: #FEF2F2;
    border-left: 3px solid #DC2626;
    padding: 10px 14px;
    margin-top: 12px;
    border-radius: 4px;
    font-size: 13px;
    color: #7F1D1D;
  }
  .practice-pitfalls strong { color: #991B1B; }

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
            <a class="nav-item" onclick="showSection('cheatsheet')" style="margin-top:18px;border-top:1px solid #E5E7EB;padding-top:14px">📋 Шпаргалка PHP</a>
            <a class="nav-item" onclick="showSection('interview')">❓ Вопросник для собеса</a>
            <a class="nav-item" onclick="showSection('practice')">🛠 Практика руками</a>
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

                    <div class="example-label">Type Juggling в сравнениях — поведение зависит от версии PHP</div>
                    <pre><code><span class="comment">// === PHP 8.0+ (актуальное поведение) ===</span>
<span class="function">var_dump</span>(<span class="string">"10"</span> == <span class="number">10</span>);    <span class="comment">// true   (строка ЧИСЛОВАЯ → сравнение как числа)</span>
<span class="function">var_dump</span>(<span class="string">"10"</span> === <span class="number">10</span>);   <span class="comment">// false  (строгое: типы разные)</span>

<span class="function">var_dump</span>(<span class="string">""</span> == <span class="number">0</span>);        <span class="comment">// false  ← было true до PHP 8.0!</span>
<span class="function">var_dump</span>(<span class="string">"abc"</span> == <span class="number">0</span>);     <span class="comment">// false  ← было true до PHP 8.0!</span>
<span class="function">var_dump</span>(<span class="string">"1abc"</span> == <span class="number">1</span>);    <span class="comment">// false  ← было true до PHP 8.0!</span>
<span class="function">var_dump</span>(<span class="string">"0"</span> == <span class="number">0</span>);       <span class="comment">// true   (строка числовая, значение 0)</span>
<span class="function">var_dump</span>(<span class="string">"100"</span> == <span class="string">"1e2"</span>); <span class="comment">// true   (обе строки числовые: 100 == 100)</span></code></pre>

                    <div class="content-block" style="background:#FEF2F2;border-left:3px solid #DC2626;padding:14px 18px;margin:10px 0;border-radius:4px">
                        <strong>⚠ Что изменилось в PHP 8.0 (RFC: "Saner string to number comparisons"):</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><strong>До 8.0:</strong> сравнение строки с числом → <strong>строка приводится к числу</strong>. Нечисловая строка → <code>0</code>. Поэтому <code>"abc" == 0</code> было <code>true</code> — источник классических багов в безопасности.</li>
                            <li><strong>С 8.0+:</strong> если строка <strong>нечисловая</strong> — <strong>число приводится к строке</strong>, сравниваются две строки. Если строка <strong>числовая</strong> (<code>"10"</code>, <code>"1e2"</code>) — по-прежнему сравниваются как числа.</li>
                            <li><strong>Запоминать одно правило:</strong> числовая строка ↔ число — как числа; нечисловая ↔ число — как строки.</li>
                        </ul>
                    </div>

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

                    <div class="example-label">Разбор вывода <code>var_dump($obj)</code> построчно</div>
                    <pre><code><span class="function">var_dump</span>(<span class="variable">$obj</span>);

<span class="comment">// Вывод:
//   object(stdClass)#1 (2) {
//     ["a"]=> int(1)
//     ["b"]=> int(2)
//   }

// Что значит каждая часть:
//
// object        — тип значения: объект (не array, не string)
// (stdClass)    — имя класса экземпляра
// #1            — внутренний ID объекта в этом дампе (для отслеживания
//                 рекурсивных ссылок: если объект появится дважды,
//                 во второй раз увидишь "#1" повторно — это та же сущность)
// (2)           — количество свойств у объекта
// ["a"]=> int(1) — свойство "a" типа int со значением 1
// ["b"]=> int(2) — свойство "b" типа int со значением 2</span></code></pre>

                    <div class="content-block" style="background:#EFF6FF;border-left:3px solid #3B82F6;padding:14px 18px;margin:10px 0;border-radius:4px">
                        <strong>Что такое <code>stdClass</code>?</strong>
                        <p style="margin:6px 0 0"><code>stdClass</code> — это <strong>встроенный пустой класс PHP</strong>. Не имеет методов, свойств, констант. Используется как «универсальный контейнер» когда нужен объект без определения своего класса.</p>
                        <p style="margin:8px 0 0">PHP автоматически создаёт <code>stdClass</code> в трёх случаях:</p>
                        <ul style="margin:6px 0 0 20px;line-height:1.7">
                            <li><code>new stdClass()</code> — явно</li>
                            <li><code>(object)$array</code> — приведение массива к объекту</li>
                            <li><code>json_decode($json)</code> без второго аргумента <code>true</code> — JSON-объекты становятся <code>stdClass</code></li>
                        </ul>
                    </div>

                    <div class="example-label">Объект vs ассоциативный массив — сравнение</div>
                    <table class="data-table">
                        <thead>
                            <tr><th>Аспект</th><th>Ассоциативный массив</th><th>Объект</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Что это</td><td>Упорядоченная коллекция пар «ключ → значение»</td><td>Экземпляр класса с свойствами (и методами)</td></tr>
                            <tr><td>Доступ к данным</td><td><code>$person["name"]</code></td><td><code>$person-&gt;name</code></td></tr>
                            <tr><td>Создание</td><td><code>['name' =&gt; 'Иван', 'age' =&gt; 30]</code></td><td><code>(object)['name'=&gt;'Иван']</code> или <code>new stdClass()</code></td></tr>
                            <tr><td>Добавить поле</td><td><code>$arr['email'] = 'a@b.ru'</code></td><td><code>$obj-&gt;email = 'a@b.ru'</code></td></tr>
                            <tr><td>Методы / поведение</td><td>❌ Нет (только функции работают с массивом снаружи)</td><td>✅ Можно добавить через свой класс</td></tr>
                            <tr><td>Передача в функцию</td><td>Копирование (CoW под капотом)</td><td>По ссылке (одна сущность в памяти)</td></tr>
                            <tr><td>Проверка поля</td><td><code>isset($arr['name'])</code> / <code>array_key_exists</code></td><td><code>isset($obj-&gt;name)</code> / <code>property_exists</code></td></tr>
                            <tr><td><code>var_dump</code></td><td><code>array(2) { ["name"]=&gt; ... }</code></td><td><code>object(stdClass)#1 (2) { ["name"]=&gt; ... }</code></td></tr>
                            <tr><td>Сериализация в JSON</td><td><code>json_encode</code> — JSON-объект</td><td><code>json_encode</code> — тоже JSON-объект</td></tr>
                            <tr><td>Тип в type-hint</td><td><code>array</code></td><td><code>object</code> / конкретный класс</td></tr>
                            <tr><td>Производительность</td><td>Чуть быстрее</td><td>Чуть медленнее, но разница не критична</td></tr>
                        </tbody>
                    </table>

                    <div class="remember-box">
                        <strong>Когда что использовать:</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><strong>Ассоциативный массив</strong> — конфиги, простые DTO без поведения, передача данных «как есть», быстрые трансформации (<code>array_map</code>, <code>array_filter</code>, <code>ksort</code>).</li>
                            <li><strong>Объект (свой класс)</strong> — сущности с поведением (User с <code>register()</code>, Order с <code>calculateTotal()</code>), важна типизация (type-hints, IDE-подсказки), наследование, инкапсуляция.</li>
                            <li><strong><code>stdClass</code></strong> — временный «контейнер» когда не хочется создавать класс: результат <code>json_decode</code>, быстрый DTO для шаблона (удобнее <code>$item-&gt;name</code> чем <code>$item['name']</code>). В production-коде лучше явный класс — больше контроля.</li>
                        </ul>
                    </div>

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
                    <h3 class="subsection-title">Логические операторы (<code>&amp;&amp;</code>, <code>||</code>, <code>!</code>, <code>and</code>, <code>or</code>, <code>xor</code>)</h3>
                    <div class="content-block">
                        Объединяют булевы выражения. Используются в <code>if</code>, <code>while</code>, тернарных выражениях, <code>match</code>. PHP имеет <strong>два набора</strong>: символьные (<code>&amp;&amp;</code>, <code>||</code>) и словесные (<code>and</code>, <code>or</code>). Они почти эквивалентны, но <strong>разный приоритет</strong> — это критично.
                    </div>

                    <div class="example-label">Все логические операторы</div>
                    <table class="data-table">
                        <thead>
                            <tr><th>Оператор</th><th>Что делает</th><th>Пример</th><th>Приоритет</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><code>!</code> (NOT)</td><td>Инвертирование</td><td><code>!is_numeric($x)</code> → true если НЕ число</td><td>Высокий</td></tr>
                            <tr><td><code>&amp;&amp;</code> (AND)</td><td>true если ОБА</td><td><code>$a &gt; 0 &amp;&amp; $a &lt; 10</code></td><td>Высокий</td></tr>
                            <tr><td><code>||</code> (OR)</td><td>true если ХОТЯ БЫ ОДИН</td><td><code>$role === 'admin' || $isOwner</code></td><td>Высокий</td></tr>
                            <tr><td><code>and</code></td><td>То же что <code>&amp;&amp;</code>, но НИЖЕ приоритет</td><td><code>$x = $a and $b</code> → <code>($x = $a) and $b</code></td><td>Низкий</td></tr>
                            <tr><td><code>or</code></td><td>То же что <code>||</code>, но НИЖЕ приоритет</td><td>см. ловушку ниже</td><td>Низкий</td></tr>
                            <tr><td><code>xor</code></td><td>true если РОВНО ОДИН</td><td><code>$a xor $b</code> — взаимоисключающее ИЛИ</td><td>Низкий</td></tr>
                        </tbody>
                    </table>

                    <div class="example-label">Таблица истинности AND, OR, XOR</div>
                    <table class="data-table">
                        <thead><tr><th>A</th><th>B</th><th>A &amp;&amp; B</th><th>A || B</th><th>A xor B</th></tr></thead>
                        <tbody>
                            <tr><td>true</td><td>true</td><td><code>true</code></td><td><code>true</code></td><td><code>false</code></td></tr>
                            <tr><td>true</td><td>false</td><td><code>false</code></td><td><code>true</code></td><td><code>true</code></td></tr>
                            <tr><td>false</td><td>true</td><td><code>false</code></td><td><code>true</code></td><td><code>true</code></td></tr>
                            <tr><td>false</td><td>false</td><td><code>false</code></td><td><code>false</code></td><td><code>false</code></td></tr>
                        </tbody>
                    </table>

                    <div class="example-label">Короткое замыкание (short-circuit evaluation)</div>
                    <pre><code><span class="comment">// PHP вычисляет операнды СЛЕВА НАПРАВО и останавливается
// как только результат уже известен.

// && — если ЛЕВЫЙ false, правый НЕ вычисляется:</span>
<span class="variable">$user</span> = <span class="keyword">null</span>;
<span class="keyword">if</span> (<span class="variable">$user</span> !== <span class="keyword">null</span> &amp;&amp; <span class="variable">$user</span>-><span class="function">isAdmin</span>()) { ... }
<span class="comment">// $user->isAdmin() НЕ вызовется на null — нет Error.

// || — если ЛЕВЫЙ true, правый НЕ вычисляется:</span>
<span class="variable">$result</span> = <span class="variable">$cached</span> ?: <span class="function">expensive_lookup</span>();
<span class="comment">// expensive_lookup() не вызовется, если $cached истинно.

// Практическое применение: guard clauses</span>
<span class="keyword">if</span> (!<span class="function">is_numeric</span>(<span class="variable">$amount</span>) || !<span class="function">is_numeric</span>(<span class="variable">$quantity</span>)) {
    <span class="keyword">throw</span> <span class="keyword">new</span> <span class="function">InvalidArgumentException</span>(<span class="string">'Numeric expected'</span>);
}
<span class="comment">// Если первое условие true (amount не число) — второе даже не проверяется.</span></code></pre>

                    <div class="example-label">⚠ Ловушка приоритета: <code>||</code> vs <code>or</code></div>
                    <pre><code><span class="comment">// Эти две строки выглядят одинаково — но РАБОТАЮТ ПО-РАЗНОМУ:</span>

<span class="variable">$result</span> = <span class="keyword">false</span> || <span class="keyword">true</span>;
<span class="comment">// Скобки: $result = (false || true) → $result = true</span>

<span class="variable">$result</span> = <span class="keyword">false</span> <span class="keyword">or</span> <span class="keyword">true</span>;
<span class="comment">// Скобки: ($result = false) or true → $result = FALSE !!!
// Потому что = имеет ВЫШЕ приоритет чем or, но НИЖЕ чем ||.

// ПРАВИЛО: в новом коде всегда используй && и ||.
// or / and / xor оставлены для совместимости — почти не применяются.</span></code></pre>

                    <div class="example-label">Реальные паттерны</div>
                    <pre><code><span class="comment">// 1. Несколько guard-условий перед основной логикой</span>
<span class="keyword">public</span> <span class="keyword">function</span> <span class="function">register</span>(<span class="function">User</span> <span class="variable">$user</span>): <span class="keyword">void</span>
{
    <span class="keyword">if</span> (!<span class="variable">$user</span>-><span class="function">isVerified</span>() || <span class="variable">$user</span>-><span class="function">isBanned</span>() || <span class="variable">$user</span>-><span class="variable">age</span> &lt; <span class="number">18</span>) {
        <span class="keyword">throw</span> <span class="keyword">new</span> <span class="function">RuntimeException</span>(<span class="string">'Cannot register'</span>);
    }
    <span class="comment">// ... основная логика</span>
}

<span class="comment">// 2. Проверка любого из ролей (OR)</span>
<span class="keyword">if</span> (<span class="variable">$user</span>-><span class="function">hasRole</span>(<span class="string">'admin'</span>) || <span class="variable">$user</span>-><span class="function">hasRole</span>(<span class="string">'manager'</span>)) {
    <span class="comment">// доступ разрешён хотя бы одной из ролей</span>
}

<span class="comment">// 3. Range check (AND)</span>
<span class="keyword">if</span> (<span class="variable">$age</span> &gt;= <span class="number">18</span> &amp;&amp; <span class="variable">$age</span> &lt;= <span class="number">65</span>) {
    <span class="comment">// возраст в диапазоне</span>
}

<span class="comment">// 4. Сложные условия со скобками</span>
<span class="keyword">if</span> ((<span class="variable">$role</span> === <span class="string">'admin'</span> &amp;&amp; <span class="variable">$user</span>-><span class="variable">active</span>) || <span class="variable">$user</span>-><span class="variable">id</span> === <span class="variable">$ownerId</span>) {
    <span class="comment">// (active админ) ИЛИ (владелец) — скобки явно фиксируют логику</span>
}</code></pre>

                    <div class="remember-box">
                        <strong>Главное:</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><strong>Используй <code>&amp;&amp;</code> и <code>||</code></strong> — не <code>and</code>/<code>or</code>. Разница только в приоритете, и приоритет у них коварный.</li>
                            <li><strong>Short-circuit — это не оптимизация, это инструмент.</strong> Активно применяют для безопасной проверки nullable объектов: <code>$user !== null &amp;&amp; $user-&gt;isAdmin()</code>.</li>
                            <li><strong>В сложных условиях — скобки.</strong> Не полагайся на приоритет <code>&amp;&amp;</code> выше <code>||</code> — это работает, но читателю надо вспоминать. Скобки делают код самодокументируемым.</li>
                        </ul>
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Тернарный, Elvis, null coalescing (<code>?:</code>, <code>??</code>, <code>?-&gt;</code>)</h3>
                    <div class="content-block">
                        Группа коротких операторов для условных выражений. Все используют <code>?</code>, но семантика разная. На собесе часто путают — особенно тернарный vs <code>??</code>.
                    </div>

                    <div class="example-label">1. Тернарный <code>условие ? a : b</code></div>
                    <pre><code><span class="comment">// Тернарный — сокращённый if/else в виде выражения (возвращает значение).
// Синтаксис: условие ? значение_если_true : значение_если_false</span>

<span class="variable">$age</span> = <span class="number">18</span>;
<span class="variable">$status</span> = <span class="variable">$age</span> >= <span class="number">18</span> ? <span class="string">'adult'</span> : <span class="string">'minor'</span>;
<span class="comment">// $status = 'adult'

// Эквивалентно:
// if ($age >= 18) { $status = 'adult'; } else { $status = 'minor'; }

// Вложенные — читаются плохо, лучше match:</span>
<span class="variable">$tier</span> = <span class="variable">$score</span> > <span class="number">90</span> ? <span class="string">'gold'</span> : (<span class="variable">$score</span> > <span class="number">50</span> ? <span class="string">'silver'</span> : <span class="string">'bronze'</span>);</code></pre>

                    <div class="example-label">2. Elvis <code>?:</code> — сокращённый тернарный</div>
                    <pre><code><span class="comment">// Если средняя часть тернарного — то же что условие, можно её опустить:</span>

<span class="comment">// Длинная форма:</span>
<span class="variable">$name</span> = <span class="variable">$input</span> ? <span class="variable">$input</span> : <span class="string">'Anonymous'</span>;

<span class="comment">// Elvis (сокращённая):</span>
<span class="variable">$name</span> = <span class="variable">$input</span> ?: <span class="string">'Anonymous'</span>;
<span class="comment">// Если $input истинно — вернёт $input, иначе 'Anonymous'.

// ⚠ Работает по TRUTHY: '0', '', 0, null, [] — все вернут 'Anonymous'.
// Если нужно проверять именно null — используй ??.</span></code></pre>

                    <div class="example-label">3. Null coalescing <code>??</code> (PHP 7+)</div>
                    <pre><code><span class="comment">// $a ?? $b — вернёт $a, если оно НЕ null (и определено),
//             иначе $b.

// Отличие от Elvis: ?? проверяет ТОЛЬКО null/undefined,
// не учитывает '0', '', 0 как пустоту.</span>

<span class="variable">$page</span> = <span class="variable">$_GET</span>[<span class="string">'page'</span>] ?? <span class="number">1</span>;
<span class="comment">// Если $_GET['page'] = '0' → $page = '0' (НЕ 1!)
// Если $_GET['page'] не задан → $page = 1.

// Цепочки:</span>
<span class="variable">$value</span> = <span class="variable">$config</span>[<span class="string">'override'</span>] ?? <span class="variable">$config</span>[<span class="string">'default'</span>] ?? <span class="string">'fallback'</span>;
<span class="comment">// первое непустое значение, по цепочке.

// ??= — присвоение если null (PHP 7.4+):</span>
<span class="variable">$config</span>[<span class="string">'timeout'</span>] ??= <span class="number">30</span>;
<span class="comment">// если ключа нет / null — положит 30. Иначе оставит как есть.</span></code></pre>

                    <div class="example-label">4. Nullsafe <code>?-&gt;</code> (PHP 8+)</div>
                    <pre><code><span class="comment">// Цепочка обращений к свойствам/методам, безопасная для null.
// Если любая часть цепочки null — вся выражение возвращает null,
// БЕЗ Error и без NullPointerException.</span>

<span class="comment">// Без nullsafe — стандартная проверка:</span>
<span class="variable">$avatar</span> = (<span class="variable">$user</span> !== <span class="keyword">null</span> &amp;&amp; <span class="variable">$user</span>-><span class="variable">profile</span> !== <span class="keyword">null</span>)
    ? <span class="variable">$user</span>-><span class="variable">profile</span>-><span class="variable">avatar</span>
    : <span class="keyword">null</span>;

<span class="comment">// С nullsafe — короче:</span>
<span class="variable">$avatar</span> = <span class="variable">$user</span>?-><span class="variable">profile</span>?-><span class="variable">avatar</span>;
<span class="comment">// Если $user null → весь результат null.
// Если $user-&gt;profile null → результат null.
// Иначе — значение avatar.

// ⚠ Работает только на ЧТЕНИЕ. Нельзя писать через ?->:
// $user?->profile = $p;   // SYNTAX ERROR</span></code></pre>

                    <div class="example-label">Сводная таблица — что выбрать</div>
                    <table class="data-table">
                        <thead>
                            <tr><th>Оператор</th><th>Версия</th><th>Что проверяет</th><th>Когда применять</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><code>? :</code> (тернарный)</td><td>любая</td><td>Truthy/falsy условие</td><td>Простой выбор из двух значений</td></tr>
                            <tr><td><code>?:</code> (Elvis)</td><td>5.3+</td><td>Truthy левого операнда</td><td>«Значение или дефолт» когда дефолт нужен для всех falsy</td></tr>
                            <tr><td><code>??</code></td><td>7.0+</td><td><strong>Только</strong> null / undefined</td><td>«Значение или дефолт» когда <code>0</code>/<code>''</code> — валидные значения</td></tr>
                            <tr><td><code>??=</code></td><td>7.4+</td><td>null / undefined</td><td>Лениво задать дефолт в массиве настроек</td></tr>
                            <tr><td><code>?-&gt;</code></td><td>8.0+</td><td>null в середине цепочки</td><td>Цепочка обращений к опциональным объектам</td></tr>
                        </tbody>
                    </table>

                    <div class="remember-box">
                        <strong>Главный вопрос на собесе:</strong> в чём разница <code>?:</code> и <code>??</code>?
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><code>?:</code> срабатывает на <strong>любое falsy</strong> (<code>0</code>, <code>''</code>, <code>'0'</code>, <code>null</code>, <code>[]</code>).</li>
                            <li><code>??</code> срабатывает <strong>ТОЛЬКО на <code>null</code> или undefined ключ</strong>.</li>
                            <li>Для дефолтов из <code>$_GET</code> / API → используй <code>??</code> (иначе <code>?page=0</code> заменится на дефолт).</li>
                            <li>Для дефолтов «когда строка непустая» → <code>?:</code> ок.</li>
                        </ul>
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Двоеточие <code>:</code> — все контексты использования</h3>
                    <div class="content-block">
                        Символ <code>:</code> встречается в PHP в <strong>5 разных контекстах</strong>. Главный — return type declaration в функциях. На собесе спрашивают «что значит <code>: float</code>» — точный ответ ниже.
                    </div>

                    <div class="example-label">1. Return type declaration — двоеточие перед типом</div>
                    <pre><code><span class="keyword">function</span> <span class="function">calculate</span>(<span class="keyword">int</span> <span class="variable">$a</span>, <span class="keyword">int</span> <span class="variable">$b</span>): <span class="keyword">float</span>
{
    <span class="keyword">return</span> <span class="variable">$a</span> * <span class="variable">$b</span> / <span class="number">2</span>;
}
<span class="comment">//                                     ↑
//                              двоеточие перед типом

// : float означает: "эта функция ОБЯЗАНА вернуть float
// (число с плавающей точкой)".

// Если функция вернёт другой тип, PHP попытается привести:
//   return 42       → 42.0  ✓ (int → float)
//   return "3.14"   → 3.14  ✓ (numeric string → float)
//   return "abc"    → TypeError ❌

// Со strict_types=1 автоматического приведения нет —
// возврат int вместо float тоже выбросит TypeError.</span></code></pre>

                    <div class="example-label">Поддерживаемые return type-hints</div>
                    <table class="data-table">
                        <thead><tr><th>Тип</th><th>Что означает</th><th>Версия</th></tr></thead>
                        <tbody>
                            <tr><td><code>: void</code></td><td>Функция НИЧЕГО не возвращает (нельзя <code>return $x</code>)</td><td>7.1+</td></tr>
                            <tr><td><code>: int</code> / <code>: float</code> / <code>: string</code> / <code>: bool</code> / <code>: array</code></td><td>Скалярные / массив</td><td>7.0+</td></tr>
                            <tr><td><code>: ?int</code></td><td>Nullable: int или null</td><td>7.1+</td></tr>
                            <tr><td><code>: self</code> / <code>: static</code></td><td>Возврат текущего класса (для fluent)</td><td>7.0+ / 8.0+</td></tr>
                            <tr><td><code>: User</code></td><td>Объект класса <code>User</code></td><td>7.0+</td></tr>
                            <tr><td><code>: iterable</code></td><td>array или объект <code>Traversable</code></td><td>7.1+</td></tr>
                            <tr><td><code>: never</code></td><td>Функция НЕ возвращает управление (throw / exit)</td><td>8.1+</td></tr>
                            <tr><td><code>: int|string</code> (union)</td><td>Несколько типов на выбор</td><td>8.0+</td></tr>
                            <tr><td><code>: Countable&amp;Iterator</code> (intersection)</td><td>Реализует ВСЕ перечисленные</td><td>8.1+</td></tr>
                        </tbody>
                    </table>

                    <div class="example-label">2-5. Другие контексты двоеточия</div>
                    <pre><code><span class="comment">// 2. Альтернативный синтаксис if/foreach/while — для Blade-like шаблонов</span>
&lt;?<span class="keyword">php</span> <span class="keyword">if</span> (<span class="variable">$user</span>): ?&gt;
    &lt;p&gt;Hello, &lt;?= <span class="variable">$user</span>-&gt;<span class="variable">name</span> ?&gt;&lt;/p&gt;
&lt;?<span class="keyword">php</span> <span class="keyword">else</span>: ?&gt;
    &lt;p&gt;Please log in.&lt;/p&gt;
&lt;?<span class="keyword">php</span> <span class="keyword">endif</span>; ?&gt;
<span class="comment">// Аналогично: foreach: endforeach;  while: endwhile;  switch: endswitch;

// 3. switch / case</span>
<span class="keyword">switch</span> (<span class="variable">$status</span>) {
    <span class="keyword">case</span> <span class="number">200</span>: <span class="keyword">echo</span> <span class="string">'OK'</span>; <span class="keyword">break</span>;
    <span class="keyword">default</span>: <span class="keyword">echo</span> <span class="string">'unknown'</span>;
}

<span class="comment">// 4. Тернарный оператор — двоеточие разделяет true/false ветки</span>
<span class="variable">$x</span> = <span class="variable">$age</span> >= <span class="number">18</span> ? <span class="string">'adult'</span> : <span class="string">'minor'</span>;
<span class="comment">//                            ↑ это двоеточие, не return type

// 5. Двойное двоеточие :: (scope resolution) — это уже ДРУГОЙ оператор:</span>
<span class="function">User</span>::<span class="constant">MAX_AGE</span>;        <span class="comment">// константа класса</span>
<span class="function">User</span>::<span class="function">create</span>(...);    <span class="comment">// статический метод</span>
<span class="keyword">parent</span>::<span class="function">__construct</span>(); <span class="comment">// вызов родительского метода
// ↑ это два символа подряд (T_PAAMAYIM_NEKUDOTAYIM), не одинарное :</span></code></pre>

                    <div class="remember-box">
                        <strong>Главное:</strong> когда видишь <code>:</code> в функции — это <strong>return type</strong>. <code>: void</code> = ничего не возвращает, <code>: float</code> = float, <code>: ?int</code> = int или null. Двоеточие — <strong>метка типа возврата</strong>, не оператор.
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
                    <h3 class="subsection-title">Что такое массив. Индексированный vs ассоциативный</h3>
                    <div class="content-block">
                        В PHP массив — это <strong>упорядоченная коллекция пар «ключ → значение»</strong>. В отличие от других языков (где разные структуры — list, dict, tuple), в PHP один тип <code>array</code> для всего: и список, и словарь. Различают <strong>индексированный</strong> и <strong>ассоциативный</strong> по тому, какие ключи использованы.
                    </div>

                    <div class="example-label">Индексированный массив — ключи числовые автоматически</div>
                    <pre><code><span class="variable">$list</span> = [<span class="string">"яблоко"</span>, <span class="string">"банан"</span>, <span class="string">"апельсин"</span>];

<span class="comment">// PHP под капотом сгенерировал ключи 0, 1, 2:
// [ 0 => "яблоко", 1 => "банан", 2 => "апельсин" ]</span>

<span class="keyword">echo</span> <span class="variable">$list</span>[<span class="number">0</span>];  <span class="comment">// "яблоко"</span>
<span class="keyword">echo</span> <span class="variable">$list</span>[<span class="number">1</span>];  <span class="comment">// "банан"</span>

<span class="comment">// Использование: списки, упорядоченные коллекции, где
// позиция элемента имеет значение (история, очередь, лог).</span></code></pre>

                    <div class="example-label">Ассоциативный массив — ключи явно заданы (часто строки)</div>
                    <pre><code><span class="variable">$person</span> = [
    <span class="string">"name"</span> =&gt; <span class="string">"Иван"</span>,
    <span class="string">"age"</span>  =&gt; <span class="number">30</span>,
    <span class="string">"city"</span> =&gt; <span class="string">"Москва"</span>,
];

<span class="keyword">echo</span> <span class="variable">$person</span>[<span class="string">"name"</span>];  <span class="comment">// "Иван"
// Ключ — это имя, оно несёт смысл. Не позиция.</span>

<span class="comment">// Ключи могут быть смешанными:</span>
<span class="variable">$mixed</span> = [<span class="number">1</span> =&gt; <span class="string">"один"</span>, <span class="string">"key"</span> =&gt; <span class="string">"value"</span>];

<span class="comment">// Использование: конфиги, DTO, данные из формы/БД/JSON,
// где у каждого поля есть осмысленное имя.</span></code></pre>

                    <div class="content-block" style="background:#EFF6FF;border-left:3px solid #3B82F6;padding:14px 18px;margin:10px 0;border-radius:4px">
                        <strong>Откуда слово «ассоциативный»?</strong>
                        <p style="margin:6px 0 0">От «<strong>ассоциация</strong>» — связь, соответствие между двумя объектами. В ассоциативном массиве каждый ключ явно <strong>связан (ассоциирован)</strong> со своим значением — ключ означает что-то <em>содержательное</em>, а не просто порядковый номер.</p>
                        <p style="margin:8px 0 0"><strong>Сравнение:</strong></p>
                        <ul style="margin:6px 0 0 20px;line-height:1.7">
                            <li><strong>Индексированный:</strong> <code>0 → "яблоко"</code>, <code>1 → "банан"</code> — связь только по порядку.</li>
                            <li><strong>Ассоциативный:</strong> <code>"name" → "Иван"</code> — ключ <code>"name"</code> ассоциирован со значением <code>"Иван"</code>.</li>
                        </ul>
                        <p style="margin:10px 0 0">В других языках ассоциативные массивы называются: <strong>словарь</strong> (Python <code>dict</code>), <strong>хеш</strong> (Ruby <code>Hash</code>), <strong>map</strong> (Java <code>HashMap</code>), <strong>объект</strong> (JavaScript <code>{}</code>).</p>
                    </div>

                    <div class="example-label">Под капотом в PHP — один тип <code>array</code></div>
                    <pre><code><span class="comment">// PHP внутри хранит массив как упорядоченную hash-таблицу.
// Поэтому ИНДЕКСИРОВАННЫЙ массив — это всего лишь
// ассоциативный с автогенерированными числовыми ключами.</span>

<span class="variable">$a</span> = [<span class="string">"x"</span>, <span class="string">"y"</span>, <span class="string">"z"</span>];
<span class="comment">// Эквивалентно:</span>
<span class="variable">$a</span> = [<span class="number">0</span> =&gt; <span class="string">"x"</span>, <span class="number">1</span> =&gt; <span class="string">"y"</span>, <span class="number">2</span> =&gt; <span class="string">"z"</span>];

<span class="comment">// Поэтому функции типа array_keys, array_values, foreach
// работают одинаково для обоих видов:</span>
<span class="function">array_keys</span>(<span class="variable">$a</span>);       <span class="comment">// [0, 1, 2]</span>
<span class="function">array_keys</span>(<span class="variable">$person</span>);  <span class="comment">// ["name", "age", "city"]</span>

<span class="comment">// Проверить, "индексированный" массив (PHP 8.1+):</span>
<span class="function">array_is_list</span>(<span class="variable">$a</span>);      <span class="comment">// true (ключи 0..n-1 по порядку)</span>
<span class="function">array_is_list</span>(<span class="variable">$person</span>); <span class="comment">// false</span></code></pre>

                    <div class="remember-box">
                        <strong>Когда что:</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><strong>Индексированный</strong> — последовательность однотипных элементов: <code>$users = [User1, User2, User3]</code>, лог-записи, результаты выборки.</li>
                            <li><strong>Ассоциативный</strong> — структурированные данные с именованными полями: ответ API, ряд из БД, конфиг.</li>
                        </ul>
                        <p style="margin:10px 0 0"><strong>Ловушка JSON:</strong> при <code>json_encode</code> индексированный массив становится JSON-массивом <code>[...]</code>, ассоциативный — JSON-объектом <code>{...}</code>. Если случайно «продырявить» индексированный (<code>unset($a[1])</code>) — он станет ассоциативным <code>[0=>"x", 2=>"z"]</code> и JSON будет уже объектом, а не массивом. Лечится <code>array_values()</code>.</p>
                    </div>
                </div>

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

                    <div class="content-block" style="background:#FEF3C7;border-left:3px solid #F59E0B;padding:14px 18px;margin:10px 0;border-radius:4px">
                        <strong>⚠ Частая ошибка: путают <code>=&gt;</code> внутри литерала vs <code>=</code> при добавлении в массив.</strong>
                        <p style="margin:8px 0 0">Это <strong>два разных синтаксиса</strong> для разных операций:</p>
                    </div>

                    <div class="example-label">Различие: создание массива vs добавление элемента</div>
                    <pre><code><span class="comment">// ─── Создание массива (литерал) — внутри [...] нужен => ───</span>
<span class="variable">$arr</span> = [<span class="string">'name'</span> =&gt; <span class="string">'Иван'</span>, <span class="string">'age'</span> =&gt; <span class="number">30</span>];

<span class="comment">// ─── Добавление элемента в существующий массив — снаружи [...] нужен = ───</span>
<span class="variable">$arr</span>[<span class="string">'email'</span>] = <span class="string">'ivan@x.kz'</span>;       <span class="comment">// ✓ ключ в [], значение через =</span>
<span class="variable">$arr</span>[<span class="number">5</span>] = <span class="string">'пять'</span>;                 <span class="comment">// ✓</span>

<span class="comment">// ─── ❌ Синтаксические ошибки ───</span>
<span class="variable">$arr</span>[<span class="string">'name'</span> =&gt; <span class="string">'Иван'</span>];        <span class="comment">// SYNTAX ERROR: внутри [] только ключ</span>
<span class="variable">$arr</span>[<span class="string">'name'</span>] =&gt; <span class="string">'Иван'</span>;        <span class="comment">// SYNTAX ERROR: => не оператор присваивания</span></code></pre>

                    <div class="example-label">Сводная таблица — где какой оператор</div>
                    <table class="data-table">
                        <thead>
                            <tr><th>Конструкция</th><th>Что делает</th><th>Валидно?</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><code>[1, 2, 3]</code></td><td>Литерал массива без ключей</td><td>✅</td></tr>
                            <tr><td><code>['a' =&gt; 1, 'b' =&gt; 2]</code></td><td>Литерал с ключами (<code>=&gt;</code> ВНУТРИ <code>[]</code>)</td><td>✅</td></tr>
                            <tr><td><code>$arr[$key] = $value</code></td><td>Присваивание элементу (<code>=</code> СНАРУЖИ <code>[]</code>)</td><td>✅</td></tr>
                            <tr><td><code>$arr[] = $value</code></td><td>Добавление в конец (PHP сам генерит ключ)</td><td>✅</td></tr>
                            <tr><td><code>$arr[$key] =&gt; $value</code></td><td>Попытка использовать <code>=&gt;</code> как оператор присваивания</td><td>❌ syntax error</td></tr>
                            <tr><td><code>$arr[$key =&gt; $value]</code></td><td>Попытка втиснуть пару в индексатор</td><td>❌ syntax error</td></tr>
                        </tbody>
                    </table>

                    <div class="remember-box">
                        <strong>Запомнить одной строкой:</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><strong>Внутри <code>[ ]</code> при создании литерала</strong> → пишется <code>=&gt;</code> (связка ключ-значение).</li>
                            <li><strong>Снаружи <code>[ ]</code> при добавлении/изменении</strong> → пишется <code>=</code> (присваивание).</li>
                        </ul>
                        <p style="margin:10px 0 0">Типичный кейс в <code>array_reduce</code>: <code>$carry[$user['id']] = $user['name']</code> — добавляем элемент в накапливаемый массив <code>$carry</code>. Не <code>$carry[$user['id'] =&gt; $user['name']]</code> — это попытка создать литерал внутри индексатора, что синтаксически невозможно.</p>
                    </div>

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

                    <div class="example-label">Бонус: как работает <code>(object)["a"=>1, "b"=>2]</code></div>
                    <pre><code><span class="comment">// Это два шага:
// 1. Сначала [] с => создаёт ассоциативный массив:
//    ["a" => 1, "b" => 2]
// 2. (object) приводит массив к объекту — получается stdClass,
//    где ключи становятся публичными свойствами:</span>

<span class="variable">$obj</span> = (<span class="keyword">object</span>)[<span class="string">"a"</span> =&gt; <span class="number">1</span>, <span class="string">"b"</span> =&gt; <span class="number">2</span>];

<span class="comment">// Эквивалентно:</span>
<span class="variable">$obj</span> = <span class="keyword">new</span> <span class="keyword">stdClass</span>();
<span class="variable">$obj</span>-&gt;<span class="variable">a</span> = <span class="number">1</span>;
<span class="variable">$obj</span>-&gt;<span class="variable">b</span> = <span class="number">2</span>;

<span class="comment">// Доступ:</span>
<span class="keyword">echo</span> <span class="variable">$obj</span>-&gt;<span class="variable">a</span>;  <span class="comment">// 1
// (через -> потому что это объект, не массив)</span>

<span class="comment">// ⚠ Ключи с пробелами или цифровые становятся "магическими":</span>
<span class="variable">$obj</span> = (<span class="keyword">object</span>)[<span class="string">"first name"</span> =&gt; <span class="string">"Alice"</span>, <span class="number">0</span> =&gt; <span class="string">"zero"</span>];
<span class="keyword">echo</span> <span class="variable">$obj</span>-&gt;{<span class="string">"first name"</span>};  <span class="comment">// "Alice" — через {} для невалидных имён
// $obj->0 — SYNTAX ERROR, тоже только через $obj->{0}</span></code></pre>

                    <div class="content-block">
                        <strong>Когда используется такой каст:</strong> быстро создать <code>stdClass</code> для DTO/конфига без объявления класса; работа с JSON (<code>json_decode($json)</code> без <code>true</code> возвращает именно <code>stdClass</code> — структура та же); миграция данных между разными API. Для production-кода лучше явные классы — IDE подсказывает поля, видны опечатки.
                    </div>

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

                    <div class="example-label">Краткая памятка — все контексты <code>=&gt;</code></div>
                    <table class="data-table">
                        <thead>
                            <tr><th>Контекст</th><th>Пример</th><th>Семантика</th><th>Версия PHP</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Ассоциативный массив</td><td><code>['key' =&gt; 'value']</code></td><td>Связывает ключ со значением</td><td>любая</td></tr>
                            <tr><td><code>foreach</code> с ключами</td><td><code>foreach ($arr as $k =&gt; $v)</code></td><td>Перебор: ключ и значение</td><td>любая</td></tr>
                            <tr><td>Стрелочная функция</td><td><code>fn($x) =&gt; $x * 2</code></td><td>Заменяет <code>return</code> + <code>{}</code></td><td>7.4+</td></tr>
                            <tr><td><code>match</code>-выражение</td><td><code>match($x) { 1 =&gt; 'one' }</code></td><td>Разделитель проверяемого и результата</td><td>8.0+</td></tr>
                            <tr><td><code>yield</code> в генераторе</td><td><code>yield $key =&gt; $value</code></td><td>Выдача пары ключ-значение</td><td>5.5+</td></tr>
                            <tr><td>Деструктуризация по ключам</td><td><code>['key' =&gt; $var] = $arr</code></td><td>Извлечение по имени ключа</td><td>7.1+</td></tr>
                        </tbody>
                    </table>

                    <div class="remember-box">
                        <strong>Запомни:</strong> <code>=&gt;</code> — это <strong>ассоциация / связь</strong> (ключ ↔ значение, аргумент ↔ результат). Не путать с:
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><code>-&gt;</code> — обращение к свойству/методу объекта: <code>$user-&gt;name</code>, <code>$db-&gt;query()</code></li>
                            <li><code>::</code> — обращение к статике/классу: <code>User::all()</code>, <code>self::CONST</code></li>
                            <li><code>==</code> / <code>===</code> — сравнение (loose / strict)</li>
                            <li><code>=&lt;</code> / <code>&gt;=</code> — операторы сравнения «меньше или равно» / «больше или равно»</li>
                        </ul>
                    </div>

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
<span class="comment">// [11, 22, 33]
// При разной длине массивов — берётся длина САМОГО ДЛИННОГО,
// недостающие элементы дополняются null (часто источник багов).</span></code></pre>

                    <div class="example-label">Поведение с ключами — тонкость</div>
                    <pre><code><span class="comment">// 1. Один массив + ассоциативный → КЛЮЧИ СОХРАНЯЮТСЯ</span>
<span class="variable">$users</span> = [<span class="string">'a'</span> => <span class="number">100</span>, <span class="string">'b'</span> => <span class="number">200</span>];
<span class="variable">$doubled</span> = <span class="function">array_map</span>(<span class="keyword">fn</span>(<span class="variable">$n</span>) => <span class="variable">$n</span> * <span class="number">2</span>, <span class="variable">$users</span>);
<span class="comment">// ['a' => 200, 'b' => 400] — ключи a, b сохранились

// 2. Несколько массивов → КЛЮЧИ СБРАСЫВАЮТСЯ на 0, 1, 2...</span>
<span class="variable">$result</span> = <span class="function">array_map</span>(<span class="keyword">fn</span>(<span class="variable">$x</span>, <span class="variable">$y</span>) => <span class="variable">$x</span> + <span class="variable">$y</span>, [<span class="string">'a'</span> => <span class="number">1</span>], [<span class="string">'b'</span> => <span class="number">2</span>]);
<span class="comment">// [0 => 3] — оба ключа потеряны!

// 3. callback = null + один массив → ПРОСТО КОПИРУЕТ значения</span>
<span class="variable">$copy</span> = <span class="function">array_map</span>(<span class="keyword">null</span>, [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>]);
<span class="comment">// [1, 2, 3]

// 4. callback = null + несколько массивов → ZIP (склейка попарно)</span>
<span class="variable">$zipped</span> = <span class="function">array_map</span>(<span class="keyword">null</span>, [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>], [<span class="string">'a'</span>, <span class="string">'b'</span>, <span class="string">'c'</span>]);
<span class="comment">// [[1,'a'], [2,'b'], [3,'c']] — как Python zip()</span></code></pre>

                    <div class="example-label">Эквивалент через foreach (что под капотом)</div>
                    <pre><code><span class="comment">// array_map "под капотом":</span>
<span class="variable">$result</span> = [];
<span class="keyword">foreach</span> (<span class="variable">$numbers</span> <span class="keyword">as</span> <span class="variable">$key</span> => <span class="variable">$value</span>) {
    <span class="variable">$result</span>[<span class="variable">$key</span>] = <span class="variable">$callback</span>(<span class="variable">$value</span>);
}

<span class="comment">// Когда foreach лучше:
//   — нужны побочные эффекты (логирование, запись в БД)
//   — внутри тела > 1 строки кода
//   — нужно прервать цикл (break/continue) — у array_map нельзя</span></code></pre>

                    <div class="example-label">array_map + array_sum vs array_reduce — какой выбрать</div>
                    <pre><code><span class="comment">// Вариант 1: array_map + array_sum (2 прохода по массиву)</span>
<span class="variable">$total</span> = <span class="function">array_sum</span>(<span class="function">array_map</span>(
    <span class="keyword">fn</span>(<span class="function">Item</span> <span class="variable">$i</span>) => <span class="variable">$i</span>-><span class="function">price</span>(),
    <span class="variable">$this</span>-><span class="variable">items</span>
));

<span class="comment">// Вариант 2: array_reduce (1 проход)</span>
<span class="variable">$total</span> = <span class="function">array_reduce</span>(
    <span class="variable">$this</span>-><span class="variable">items</span>,
    <span class="keyword">fn</span>(<span class="keyword">float</span> <span class="variable">$carry</span>, <span class="function">Item</span> <span class="variable">$i</span>) => <span class="variable">$carry</span> + <span class="variable">$i</span>-><span class="function">price</span>(),
    <span class="number">0.0</span>
);

<span class="comment">// На малых данных (≤ 1000) разницы нет — выбирай по читаемости.
// На больших — reduce 2× быстрее (1 проход + нет промежуточного массива).</span></code></pre>

                    <table class="data-table">
                        <thead>
                            <tr><th>Сценарий</th><th>Лучший выбор</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Просто преобразовать массив (новый из старого)</td><td><code>array_map</code></td></tr>
                            <tr><td>Свернуть в одно значение (sum/max/build assoc)</td><td><code>array_reduce</code></td></tr>
                            <tr><td>map + sum/max/min</td><td><strong>Сразу <code>array_reduce</code></strong> (1 проход)</td></tr>
                            <tr><td>Простая сумма чисел</td><td><code>array_sum</code> (не нужны map/reduce)</td></tr>
                            <tr><td>Побочные эффекты (log/insert)</td><td><code>foreach</code></td></tr>
                            <tr><td>Нужен <code>break</code> / прерывание</td><td><code>foreach</code> (у <code>array_map</code> нельзя)</td></tr>
                            <tr><td>Изменить массив in-place (по ссылке)</td><td><code>array_walk</code> с <code>&amp;$item</code></td></tr>
                        </tbody>
                    </table>

                    <div class="remember-box">
                        <strong>Главные ловушки <code>array_map</code>:</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><strong>Ключи теряются при multi-array</strong> — если работаешь с assoc-массивом, проверь что используешь один массив.</li>
                            <li><strong>Разная длина массивов</strong> → дополняется <code>null</code>. Если ожидал что массив будет короче — баг.</li>
                            <li><strong>Нельзя прервать</strong> — `break` не работает. Если нужно остановить итерацию — <code>foreach</code> или генератор.</li>
                            <li><strong>Создаёт промежуточный массив</strong> — для дальнейшего <code>sum/max</code> предпочти <code>array_reduce</code>.</li>
                        </ul>
                    </div>
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

                    <div class="example-label">⚡ Когда НЕ нужен array_reduce — есть встроенные функции</div>
                    <pre><code><span class="comment">// Для типовых операций PHP предоставляет специализированные функции —
// они короче, читаемее и БЫСТРЕЕ array_reduce (реализованы на C).</span>

<span class="comment">// ❌ Избыточно — переизобретаешь array_sum:</span>
<span class="variable">$sum</span> = <span class="function">array_reduce</span>(<span class="variable">$numbers</span>, <span class="keyword">fn</span>(<span class="variable">$c</span>, <span class="variable">$i</span>) => <span class="variable">$c</span> + <span class="variable">$i</span>, <span class="number">0</span>);

<span class="comment">// ✅ Идиоматично:</span>
<span class="variable">$sum</span> = <span class="function">array_sum</span>(<span class="variable">$numbers</span>);

<span class="comment">// Полный список:</span>
<span class="function">array_sum</span>(<span class="variable">$arr</span>);              <span class="comment">// сумма</span>
<span class="function">array_product</span>(<span class="variable">$arr</span>);          <span class="comment">// произведение</span>
<span class="function">count</span>(<span class="variable">$arr</span>);                  <span class="comment">// количество элементов</span>
<span class="function">max</span>(<span class="variable">$arr</span>);                    <span class="comment">// максимум</span>
<span class="function">min</span>(<span class="variable">$arr</span>);                    <span class="comment">// минимум</span>
<span class="function">array_unique</span>(<span class="variable">$arr</span>);           <span class="comment">// убрать дубли</span>
<span class="function">implode</span>(<span class="string">','</span>, <span class="variable">$arr</span>);            <span class="comment">// склеить в строку</span>

<span class="comment">// Среднее (avg) встроенной нет, но просто:</span>
<span class="variable">$avg</span> = <span class="function">array_sum</span>(<span class="variable">$arr</span>) / <span class="function">count</span>(<span class="variable">$arr</span>);  <span class="comment">// защити count > 0!</span></code></pre>

                    <div class="example-label">Когда нужен array_reduce</div>
                    <table class="data-table">
                        <thead>
                            <tr><th>Задача</th><th>Использовать</th><th>Почему</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Сумма</td><td><code>array_sum($arr)</code></td><td>Встроено, быстро, читаемо</td></tr>
                            <tr><td>Произведение</td><td><code>array_product($arr)</code></td><td>Встроено</td></tr>
                            <tr><td>Max / Min</td><td><code>max($arr)</code> / <code>min($arr)</code></td><td>Встроено</td></tr>
                            <tr><td>Среднее (avg)</td><td><code>array_sum / count</code></td><td>Двух функций достаточно</td></tr>
                            <tr><td>Сумма + count + avg <strong>за один проход</strong></td><td><code>array_reduce</code></td><td>1 итерация вместо 2-3</td></tr>
                            <tr><td>Построить assoc <code>[id =&gt; name]</code></td><td><code>array_reduce</code> или <code>array_column</code></td><td>Reduce — гибче, column — короче</td></tr>
                            <tr><td>Сложная агрегация (sum чётных + max нечётных)</td><td><code>array_reduce</code></td><td>Своя логика в callback</td></tr>
                            <tr><td>Любая нестандартная свёртка</td><td><code>array_reduce</code></td><td>Универсальный инструмент</td></tr>
                        </tbody>
                    </table>

                    <div class="remember-box">
                        <strong>Правило для собеса:</strong> когда видишь задачу «свернуть массив в одно значение» — сначала проверь, есть ли встроенная функция. Если есть (<code>sum</code>/<code>product</code>/<code>max</code>/<code>min</code>/<code>count</code>) — используй её. <code>array_reduce</code> — это <strong>универсальный fallback</strong> для случаев когда встроенной нет или нужно несколько метрик за один проход.
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
                    <h3 class="subsection-title">Класс vs Объект. Создание объекта через <code>new</code></h3>
                    <div class="content-block">
                        Это первая концепция ООП, на которой спотыкаются — путают <strong>класс</strong> и <strong>объект</strong>. Класс — это описание (тип). Объект — это конкретный экземпляр в памяти, созданный по этому описанию. Создаётся объект оператором <code>new</code>.
                    </div>

                    <div class="example-label">Аналогия — чертёж и дом</div>
                    <pre><code><span class="comment">// КЛАСС — это чертёж (описание): какие свойства и методы будут.
// Сам по себе класс не занимает память для хранения данных.
// Это просто текст программы.</span>

<span class="keyword">class</span> <span class="function">User</span> {
    <span class="keyword">public</span> <span class="keyword">string</span> <span class="variable">$name</span>;
    <span class="keyword">protected</span> <span class="keyword">int</span> <span class="variable">$id</span>;
}

<span class="comment">// ОБЪЕКТ — это конкретный дом, построенный по чертежу.
// В памяти выделено место под его свойства, в нём хранятся реальные значения.</span>

<span class="variable">$user1</span> = <span class="keyword">new</span> <span class="function">User</span>();   <span class="comment">// первый объект класса User</span>
<span class="variable">$user2</span> = <span class="keyword">new</span> <span class="function">User</span>();   <span class="comment">// второй объект — независимый</span>

<span class="comment">// $user1 и $user2 — РАЗНЫЕ объекты в памяти,
// хотя оба построены по одному и тому же классу User.</span></code></pre>

                    <div class="content-block" style="background:#EFF6FF;border-left:3px solid #3B82F6;padding:14px 18px;margin:10px 0;border-radius:4px">
                        <strong>Что делает <code>new ClassName()</code> под капотом:</strong>
                        <ol style="margin:6px 0 0 20px;line-height:1.7">
                            <li>Выделяет память для нового объекта (с местом под все объявленные свойства + служебная информация).</li>
                            <li>Запускает <code>__construct()</code>, если он определён в классе.</li>
                            <li>Возвращает <strong>ссылку</strong> на созданный объект (PHP всегда работает с объектами по ссылке, не по значению).</li>
                        </ol>
                    </div>

                    <div class="example-label">Почему <code>new User()</code>, а не просто <code>User</code>?</div>
                    <pre><code><span class="variable">$array</span> = (<span class="keyword">array</span>)<span class="keyword">new</span> <span class="function">User</span>();   <span class="comment">// ✓ объект → массив</span>
<span class="variable">$array</span> = (<span class="keyword">array</span>)<span class="function">User</span>;          <span class="comment">// ✗ ошибка: класс не значение</span>

<span class="comment">// Почему так:
// User — это ИМЯ КЛАССА (тип данных), как int или string.
// Его нельзя использовать как переменную или значение.
// Это просто метка для PHP: "вот по такому описанию строить объекты".

// new User() — это ВЫРАЖЕНИЕ, которое возвращает объект.
// А с объектом уже можно делать что угодно: кастить, передавать, сохранять.</span>

<span class="comment">// Аналогично с другими операциями над типом:</span>
<span class="function">var_dump</span>(<span class="function">User</span>);            <span class="comment">// ✗ ошибка</span>
<span class="function">var_dump</span>(<span class="keyword">new</span> <span class="function">User</span>());      <span class="comment">// ✓ дамп объекта</span>

<span class="comment">// Имя класса как СТРОКА — можно (через ::class или просто "User"):</span>
<span class="keyword">echo</span> <span class="function">User</span>::<span class="keyword">class</span>;        <span class="comment">// "User" — это уже строка, не класс</span>
<span class="keyword">echo</span> <span class="function">get_class</span>(<span class="keyword">new</span> <span class="function">User</span>()); <span class="comment">// "User"</span></code></pre>

                    <div class="example-label">Пример с конструктором — задаём начальные значения</div>
                    <pre><code><span class="keyword">class</span> <span class="function">User</span> {
    <span class="keyword">public</span> <span class="keyword">string</span> <span class="variable">$name</span>;
    <span class="keyword">public</span> <span class="keyword">int</span> <span class="variable">$age</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">string</span> <span class="variable">$name</span>, <span class="keyword">int</span> <span class="variable">$age</span>)
    {
        <span class="variable">$this</span>-&gt;<span class="variable">name</span> = <span class="variable">$name</span>;
        <span class="variable">$this</span>-&gt;<span class="variable">age</span>  = <span class="variable">$age</span>;
    }
}

<span class="comment">// Конструктор вызывается автоматически — поля сразу заполнены</span>
<span class="variable">$user</span> = <span class="keyword">new</span> <span class="function">User</span>(<span class="string">"Alice"</span>, <span class="number">30</span>);

<span class="keyword">echo</span> <span class="variable">$user</span>-&gt;<span class="variable">name</span>;  <span class="comment">// "Alice"
// Без конструктора пришлось бы заполнять руками после new:
// $user = new User();
// $user->name = "Alice";
// $user->age  = 30;</span></code></pre>

                    <div class="example-label">Сравнение: класс vs объект</div>
                    <table class="data-table">
                        <thead>
                            <tr><th>Аспект</th><th>Класс</th><th>Объект</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Что это</td><td>Описание (чертёж, рецепт, тип)</td><td>Экземпляр (конкретный дом, пирог) в памяти</td></tr>
                            <tr><td>Память</td><td>Не выделена под данные</td><td>Выделена — хранит реальные значения свойств</td></tr>
                            <tr><td>Как «создать»</td><td><code>class User { ... }</code></td><td><code>new User(...)</code></td></tr>
                            <tr><td>Сколько может быть</td><td>Один (в namespace)</td><td>Сколько угодно из одного класса</td></tr>
                            <tr><td>Доступ к свойству</td><td>Нельзя (нет свойств у класса)</td><td><code>$user-&gt;name</code></td></tr>
                            <tr><td>Static-член</td><td><code>User::CONST</code>, <code>User::method()</code></td><td>принадлежит классу, не объекту</td></tr>
                            <tr><td>Тип в PHP</td><td>—</td><td><code>object</code> (можно type-hint <code>User</code>)</td></tr>
                            <tr><td>В <code>var_dump</code></td><td>не дампится</td><td><code>object(User)#1 (2) {...}</code></td></tr>
                        </tbody>
                    </table>

                    <div class="remember-box">
                        <strong>Главное:</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><strong>Класс</strong> ≠ <strong>объект</strong>. Это первая ловушка для тех, кто пришёл из процедурного программирования.</li>
                            <li><strong>Оператор <code>new</code></strong> — единственный стандартный способ создать объект (есть ещё рефлексия через <code>ReflectionClass::newInstance()</code>, но это специфика).</li>
                            <li><strong>Объект в PHP всегда передаётся по ссылке</strong>: <code>$b = $a</code> делает <code>$b</code> и <code>$a</code> ссылками на ОДИН объект. Изменение одного видно в другом. Для копии — <code>clone $a</code>.</li>
                            <li>Аналогия для запоминания: <strong>класс — рецепт пирога</strong>, <strong>объект — испечённый пирог</strong>. Рецепт можно прочитать, но съесть нельзя. Пирог можно есть, взвешивать, разрезать.</li>
                        </ul>
                    </div>
                </div>

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
                    <h3 class="subsection-title">Когда писать <code>$</code>, а когда нет — все формы доступа к свойствам</h3>
                    <div class="content-block">
                        Главная путаница новичков в PHP: <strong>«почему <code>private $items</code> с долларом, а <code>$this->items</code> без?»</strong>. PHP имеет 5 разных синтаксических форм работы с именем свойства/переменной. Разберём каждую.
                    </div>

                    <table class="data-table">
                        <thead>
                            <tr><th>Форма</th><th>Что это</th><th>Где используется</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><code>$items</code></td><td>Локальная переменная</td><td>Внутри функции/метода. Существует только в этом scope.</td></tr>
                            <tr><td><code>private array $items = []</code></td><td><strong>Объявление</strong> свойства класса</td><td>Тело класса. <code>$</code> здесь — часть имени переменной.</td></tr>
                            <tr><td><code>$this->items</code></td><td><strong>Доступ</strong> к свойству объекта</td><td>Внутри нестатического метода. <code>$</code> только у <code>$this</code>, у <code>items</code> нет.</td></tr>
                            <tr><td><code>$this->$varName</code></td><td><strong>Variable property</strong> — имя свойства в переменной</td><td>Редкая магия / опасный паттерн. Если <code>$varName = 'items'</code>, то <code>$this-&gt;$varName</code> = <code>$this-&gt;items</code>.</td></tr>
                            <tr><td><code>self::$items</code></td><td>Static свойство</td><td>Внутри методов класса. У static свойств <code>$</code> остаётся (отличие от обычных!).</td></tr>
                            <tr><td><code>items</code> (без <code>$</code> и без <code>-&gt;</code>)</td><td><strong>Константа</strong></td><td>PHP ищет <code>const items</code>. Если нет — warning + строка <code>'items'</code> (deprecated, в PHP 8.0 → Error).</td></tr>
                        </tbody>
                    </table>

                    <div class="example-label">Все 6 форм в одном файле</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Cart</span>
{
    <span class="keyword">private</span> <span class="keyword">array</span> <span class="variable">$items</span> = [];           <span class="comment">// 1. ОБЪЯВЛЕНИЕ — $ есть (часть синтаксиса)</span>
    <span class="keyword">public static</span> <span class="keyword">int</span> <span class="variable">$totalCarts</span> = <span class="number">0</span>;     <span class="comment">// 2. static — $ есть и тут</span>

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">addItem</span>(<span class="function">Item</span> <span class="variable">$item</span>): <span class="keyword">void</span>
    {
        <span class="variable">$this</span>-><span class="variable">items</span>[] = <span class="variable">$item</span>;          <span class="comment">// 3. ДОСТУП — items БЕЗ $ (после ->)</span>

        <span class="keyword">self</span>::<span class="variable">$totalCarts</span>++;             <span class="comment">// 4. static — $ ОСТАЁТСЯ после ::</span>

        <span class="variable">$localCount</span> = <span class="function">count</span>(<span class="variable">$this</span>-><span class="variable">items</span>);  <span class="comment">// 5. локальная переменная — $ есть</span>

        <span class="comment">// 6. Variable property — магия (редко)</span>
        <span class="variable">$field</span> = <span class="string">'items'</span>;
        <span class="keyword">echo</span> <span class="function">count</span>(<span class="variable">$this</span>-><span class="variable">$field</span>);     <span class="comment">// = $this->items, два $ намеренно</span>
    }
}</code></pre>

                    <div class="content-block" style="background:#EFF6FF;border-left:3px solid #3B82F6;padding:14px 18px;margin:10px 0;border-radius:4px">
                        <strong>Почему <code>items</code> без <code>$</code> после <code>-&gt;</code> — логика языка</strong>
                        <p style="margin:6px 0 0">У <code>$this</code> уже есть <code>$</code> — это переменная, ссылающаяся на объект. Дальше идёт <strong>оператор <code>-&gt;</code></strong>, который говорит PHP: «следующий идентификатор — это имя свойства/метода объекта». Имя свойства — это просто <strong>идентификатор</strong> (как имя функции <code>str_contains</code>), <code>$</code> не нужен.</p>
                        <p style="margin:8px 0 0"><strong>Аналогия:</strong></p>
                        <ul style="margin:6px 0 0 20px;line-height:1.7">
                            <li><code>strlen('hello')</code> — имя функции <code>strlen</code> без <code>$</code> (это идентификатор)</li>
                            <li><code>$this-&gt;items</code> — имя свойства <code>items</code> без <code>$</code> (это идентификатор)</li>
                            <li><code>self::$count</code> — у static <code>$</code> остаётся (исторически, для отличия от константы класса <code>self::COUNT</code>)</li>
                        </ul>
                    </div>

                    <div class="content-block" style="background:#FEE2E2;border-left:3px solid #DC2626;padding:14px 18px;margin:10px 0;border-radius:4px">
                        <strong>⚠ Классическая ловушка: <code>$this-&gt;$field</code> с двумя <code>$</code></strong>
                        <p style="margin:6px 0 0">Это <strong>не опечатка, а variable property</strong> — обращение к свойству, имя которого хранится в переменной <code>$field</code>.</p>
                        <pre style="background:#1F2937;color:#F3F4F6;padding:10px 14px;border-radius:4px;font-size:12px;margin:8px 0;overflow-x:auto"><span style="color:#A5B4FC">$this-&gt;items</span>     <span style="color:#9CA3AF">// обращение к свойству items</span>
<span style="color:#FCA5A5">$this-&gt;$items</span>    <span style="color:#9CA3AF">// variable property — ищет свойство с именем из $items
                  // (если $items = 'name', то это = $this-&gt;name)</span></pre>
                        <p style="margin:8px 0 0"><strong>В реальном коде встречается редко</strong> (динамические DTO, рефлексия). 99% случаев — это <strong>опечатка</strong>: программист случайно написал лишний <code>$</code>. Поведение: если переменная не определена / содержит несуществующее имя — fatal error.</p>
                    </div>

                    <div class="remember-box">
                        <strong>Запомнить таблицей-мнемоникой:</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li>Объявление свойства: <code>private $x</code> → <code>$</code> ЕСТЬ</li>
                            <li>Доступ через объект: <code>$this-&gt;x</code> → <code>$</code> НЕТ (после <code>-&gt;</code>)</li>
                            <li>Доступ к static: <code>self::$x</code> → <code>$</code> ЕСТЬ (после <code>::</code>)</li>
                            <li>Через переменную (variable property): <code>$this-&gt;$x</code> → ДВА <code>$</code> — редко, обычно опечатка</li>
                            <li>Локальная переменная в методе: <code>$x</code> → <code>$</code> ЕСТЬ (это обычная переменная)</li>
                        </ul>
                        <p style="margin:10px 0 0"><strong>На собесе спросят:</strong> «что значит <code>$this-&gt;$x</code> с двумя долларами?» — это variable property. 90% разработчиков забывают про это.</p>
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

                    <div class="example-label">Как видимость выглядит в <code>var_dump</code></div>
                    <pre><code><span class="function">var_dump</span>(<span class="variable">$user</span>);

<span class="comment">// Вывод:
//   object(User)#1 (3) {
//     ["name"]=> string(5) "Alice"                    ← public, обычное имя
//     ["email":protected]=> string(11) "alice@ex.com" ← protected помечен
//     ["password":"User":private]=> string(6) "secret" ← private + ИМЯ КЛАССА
//   }

// Формат ключа в var_dump:
//   "имя"                    — public
//   "имя":protected          — protected
//   "имя":"ИмяКласса":private — private (привязан к конкретному классу!)</span></code></pre>

                    <div class="content-block" style="background:#EFF6FF;border-left:3px solid #3B82F6;padding:14px 18px;margin:10px 0;border-radius:4px">
                        <strong>Почему у <code>private</code> в формате есть имя класса?</strong>
                        <p style="margin:6px 0 0">Потому что приватные свойства <strong>привязаны к конкретному классу</strong>, не к экземпляру. Если <code>Admin extends User</code> и у обоих есть <code>private $id</code> — это <strong>два разных свойства</strong> с одним именем. <code>var_dump</code> покажет оба: <code>["id":"User":private]</code> и <code>["id":"Admin":private]</code>. Поэтому имя класса в формате — обязательно.</p>
                    </div>

                    <div class="remember-box">
                        <strong>Связь с (array)$object:</strong> когда кастишь объект в массив через <code>(array)$user</code>, получаешь те же ключи, но с <strong>null-байтами</strong>: <code>"\0*\0email"</code> (protected) и <code>"\0User\0password"</code> (private). Подробно — в разделе 1, подсекция «(array)$object с разной видимостью». <code>var_dump</code> показывает в человекочитаемой нотации (<code>:protected</code>, <code>:"Class":private</code>), а внутри объекта PHP хранит именно через null-байты.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Типизированные свойства (PHP 7.4+)</h3>
                    <div class="content-block">
                        С PHP 7.4 свойства можно типизировать прямо в объявлении. До этого тип проверялся только в сеттерах/конструкторе вручную. После — PHP сам выкинет TypeError при попытке записать неправильный тип.
                    </div>

                    <div class="example-label">Синтаксис: видимость + тип + имя + дефолт</div>
                    <pre><code><span class="keyword">class</span> <span class="function">User</span>
{
    <span class="keyword">private</span> <span class="keyword">int</span> <span class="variable">$id</span>;                    <span class="comment">// без дефолта — должен быть инициализирован до доступа</span>
    <span class="keyword">private</span> <span class="keyword">string</span> <span class="variable">$name</span> = <span class="string">'unknown'</span>;    <span class="comment">// с дефолтом</span>
    <span class="keyword">private</span> ?<span class="keyword">int</span> <span class="variable">$age</span> = <span class="keyword">null</span>;             <span class="comment">// nullable (?int = int|null)</span>
    <span class="keyword">private</span> <span class="keyword">array</span> <span class="variable">$items</span> = [];              <span class="comment">// массив, дефолт — пустой</span>
    <span class="keyword">private</span> <span class="function">DateTime</span> <span class="variable">$createdAt</span>;            <span class="comment">// объект</span>
    <span class="keyword">private</span> <span class="keyword">readonly</span> <span class="keyword">int</span> <span class="variable">$constId</span>;       <span class="comment">// readonly (PHP 8.1+): записать можно ОДИН раз</span>
}</code></pre>

                    <div class="example-label">⚠ Ловушка: доступ до инициализации</div>
                    <pre><code><span class="keyword">class</span> <span class="function">User</span>
{
    <span class="keyword">private</span> <span class="keyword">int</span> <span class="variable">$id</span>;  <span class="comment">// нет дефолта</span>
}

<span class="variable">$user</span> = <span class="keyword">new</span> <span class="function">User</span>();
<span class="keyword">echo</span> <span class="variable">$user</span>-><span class="variable">id</span>;
<span class="comment">// Error: Typed property User::$id must not be accessed before initialization

// Без типа было бы просто null (warning), но с типом — fatal Error.
// Решение: задать дефолт ИЛИ инициализировать в конструкторе.</span></code></pre>

                    <div class="remember-box">
                        <strong>Правило:</strong> с типизированными свойствами <strong>либо ставь дефолт</strong> (<code>$x = 0</code>, <code>$arr = []</code>), <strong>либо обязательно инициализируй в конструкторе</strong>. Иначе runtime ошибка при первом доступе. Это не баг — это явная семантика «свойство объявлено но не задано».
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Naming conventions (PSR-12) — что писать с большой буквы</h3>
                    <div class="content-block">
                        Стандарт PSR-12 — общепринятый в Laravel, Symfony, всех приличных PHP-проектах. PHP сам **case-insensitive** к именам функций и методов (<code>$user->AddItem()</code> и <code>$user->addItem()</code> одинаково работают), но IDE / линтер / collega на code review подсветят несоответствие стандарту.
                    </div>

                    <table class="data-table">
                        <thead>
                            <tr><th>Что</th><th>Стиль</th><th>Пример</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Класс / Интерфейс / Trait / Enum</td><td><strong>PascalCase</strong></td><td><code>User</code>, <code>OrderRepository</code>, <code>PaymentInterface</code>, <code>HasFactory</code></td></tr>
                            <tr><td>Метод / функция</td><td><strong>camelCase</strong></td><td><code>addItem()</code>, <code>getTotal()</code>, <code>findByEmail()</code></td></tr>
                            <tr><td>Свойство / переменная</td><td><strong>camelCase</strong></td><td><code>$items</code>, <code>$totalAmount</code>, <code>$createdAt</code></td></tr>
                            <tr><td>Константа класса</td><td><strong>UPPER_SNAKE</strong></td><td><code>MAX_ITEMS</code>, <code>STATUS_ACTIVE</code></td></tr>
                            <tr><td>Файл с классом</td><td><strong>PascalCase</strong> (как класс)</td><td><code>User.php</code>, <code>OrderRepository.php</code></td></tr>
                            <tr><td>Namespace</td><td><strong>PascalCase</strong> по сегментам</td><td><code>App\Models</code>, <code>Illuminate\Support</code></td></tr>
                            <tr><td>Маршрут / URL</td><td><strong>kebab-case</strong></td><td><code>/user-profile</code>, <code>/order-details/{id}</code></td></tr>
                            <tr><td>База: таблица / колонка</td><td><strong>snake_case</strong></td><td><code>users</code>, <code>created_at</code>, <code>email_verified_at</code></td></tr>
                        </tbody>
                    </table>

                    <div class="example-label">Типичные ошибки которые увидишь на code review</div>
                    <pre><code><span class="comment">// ❌ Метод в PascalCase — путают с классом</span>
<span class="keyword">public</span> <span class="keyword">function</span> <span class="function">AddItem</span>(<span class="variable">$item</span>) {}

<span class="comment">// ✓ Метод в camelCase</span>
<span class="keyword">public</span> <span class="keyword">function</span> <span class="function">addItem</span>(<span class="variable">$item</span>) {}


<span class="comment">// ❌ Метод множественного числа когда добавляет ОДНО</span>
<span class="keyword">public</span> <span class="keyword">function</span> <span class="function">addItems</span>(<span class="variable">$item</span>) {}

<span class="comment">// ✓ Соответствие имени и действия</span>
<span class="keyword">public</span> <span class="keyword">function</span> <span class="function">addItem</span>(<span class="variable">$item</span>) {}      <span class="comment">// один</span>
<span class="keyword">public</span> <span class="keyword">function</span> <span class="function">addItems</span>(<span class="keyword">array</span> <span class="variable">$items</span>) {} <span class="comment">// несколько</span>


<span class="comment">// ❌ Класс в lowercase</span>
<span class="keyword">class</span> <span class="function">user</span> {}

<span class="comment">// ✓ Класс в PascalCase</span>
<span class="keyword">class</span> <span class="function">User</span> {}</code></pre>

                    <div class="remember-box">
                        <strong>На собесе:</strong> если назовёшь метод PascalCase или класс lowercase — это **первый звоночек что код не пишешь в production**. Не сразу зарежут, но запомнят. Инструмент защиты — <strong>php-cs-fixer</strong> или <strong>laravel-pint</strong> автоматически приведёт к PSR-12 при коммите.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">⚠ <code>echo</code> — языковая конструкция, не функция</h3>
                    <div class="content-block">
                        <code>echo</code> в PHP — это <strong>языковая конструкция</strong> (как <code>if</code>, <code>return</code>, <code>break</code>), а не функция. Поэтому со скобками вокруг аргумента она ведёт себя необычно — и это источник тонких багов.
                    </div>

                    <div class="example-label">Правильный синтаксис</div>
                    <pre><code><span class="keyword">echo</span> <span class="string">"Hello"</span>;                <span class="comment">// ✓ без скобок</span>
<span class="keyword">echo</span> <span class="string">"a"</span>, <span class="string">"b"</span>, <span class="string">"c"</span>;          <span class="comment">// ✓ несколько аргументов через запятую</span>
<span class="keyword">echo</span> <span class="variable">$user</span>-><span class="function">summary</span>();      <span class="comment">// ✓ цепочка методов — БЕЗ скобок</span></code></pre>

                    <div class="example-label">Ловушка: <code>echo($x)->method()</code> работает «случайно»</div>
                    <pre><code><span class="comment">// Это часто пишут думая что echo — функция:</span>
<span class="keyword">echo</span>(<span class="variable">$user</span>)-><span class="function">summary</span>();

<span class="comment">// PHP парсит это как:
//   echo  ( ($user)->summary() );
//        ↑ echo принимает ОДНО выражение
//          ($user) — это просто группировка
//          ->summary() — вызов метода на User объекте
//          результат: строка → echo выводит

// Работает СЛУЧАЙНО. Но если попробовать несколько аргументов:</span>
<span class="keyword">echo</span>(<span class="variable">$a</span>, <span class="variable">$b</span>);
<span class="comment">// Parse error! Скобки заставляют PHP интерпретировать как функцию,
// которая не принимает несколько аргументов через запятую.

// Без скобок — работает:</span>
<span class="keyword">echo</span> <span class="variable">$a</span>, <span class="variable">$b</span>;  <span class="comment">// ✓</span></code></pre>

                    <div class="example-label">Различие <code>echo</code> и <code>print</code></div>
                    <table class="data-table">
                        <thead>
                            <tr><th>Что</th><th><code>echo</code></th><th><code>print</code></th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Тип</td><td>Языковая конструкция</td><td>Языковая конструкция</td></tr>
                            <tr><td>Возвращает</td><td>Ничего (void)</td><td>Всегда <code>1</code> (можно использовать в выражении)</td></tr>
                            <tr><td>Несколько аргументов</td><td>✅ <code>echo $a, $b, $c</code></td><td>❌ только один</td></tr>
                            <tr><td>Скорость</td><td>Чуть быстрее</td><td>Чуть медленнее (из-за return)</td></tr>
                        </tbody>
                    </table>

                    <div class="remember-box">
                        <strong>Правило:</strong> для вывода используй <code>echo</code> <strong>без скобок</strong>. Для вывода объекта через метод — <code>echo $obj-&gt;method();</code>. Скобки вокруг <code>echo</code> создают иллюзию функции и могут сломать код через год (например, при добавлении второго аргумента).
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Глоссарий: Инкапсуляция, Инвариант, DDD, Aggregate Root</h3>
                    <div class="content-block">
                        Эти 4 термина часто путают, особенно <strong>«инкапсуляция = private»</strong>. На самом деле это разные уровни абстракции: язык → принцип → паттерн → методология. Разберём по уровням.
                    </div>

                    <table class="data-table">
                        <thead>
                            <tr><th>Термин</th><th>Уровень</th><th>Определение</th><th>Пример</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>private</strong> / protected / readonly</td>
                                <td>Инструмент языка</td>
                                <td>Модификаторы видимости PHP, технически запрещающие доступ извне.</td>
                                <td><code>private array $items = []</code></td>
                            </tr>
                            <tr>
                                <td><strong>Encapsulation</strong> (инкапсуляция)</td>
                                <td>Принцип ООП</td>
                                <td>Объект <strong>сам управляет своим состоянием</strong>. Внутренние данные скрыты, доступ только через методы. <code>private</code> — один из способов, не единственный.</td>
                                <td>Контролируемый <code>addItem($x)</code> вместо прямой записи в массив</td>
                            </tr>
                            <tr>
                                <td><strong>Invariant</strong> (инвариант)</td>
                                <td>Бизнес-правило</td>
                                <td>Условие, которое <strong>всегда</strong> должно соблюдаться у объекта (до операции, во время, после). Защищается инкапсуляцией.</td>
                                <td>«Корзина не может содержать &gt; 50 товаров»</td>
                            </tr>
                            <tr>
                                <td><strong>Aggregate Root</strong></td>
                                <td>Паттерн DDD</td>
                                <td>Корневой класс группы связанных сущностей. <strong>Единственная точка входа</strong> для изменений всего агрегата.</td>
                                <td><code>Order</code> владеет <code>OrderItem[]</code>; менять <code>OrderItem</code> можно только через <code>Order</code></td>
                            </tr>
                            <tr>
                                <td><strong>DDD</strong> (Domain-Driven Design)</td>
                                <td>Методология</td>
                                <td>Подход к проектированию сложных систем, где модель отражает <strong>бизнес-домен</strong>, а не структуру БД. Включает паттерны: Entity, Value Object, Aggregate, Repository, Domain Service.</td>
                                <td>Класс <code>Order</code> с методами <code>place()</code>, <code>cancel()</code> вместо CRUD-таблиц</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="content-block" style="background:#EFF6FF;border-left:3px solid #3B82F6;padding:14px 18px;margin:10px 0;border-radius:4px">
                        <strong>Главный вопрос: «крутится ли всё вокруг <code>private</code>?»</strong>
                        <p style="margin:6px 0 0"><strong>Нет.</strong> <code>private</code> — это <strong>популярный инструмент</strong> для реализации инкапсуляции в PHP, но не сама инкапсуляция.</p>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li>В Python нет «настоящего» <code>private</code>, но инкапсуляция реализуется через соглашение <code>_underscore</code> и <code>property</code> декораторы.</li>
                            <li>В Go нет ключевого слова <code>private</code> — используется регистр имени (lowercase = пакетная видимость).</li>
                            <li>В PHP можно использовать <code>readonly</code> (PHP 8.1+) — свойство публично читается, но запись запрещена. Тоже инкапсуляция.</li>
                        </ul>
                        <p style="margin:10px 0 0"><strong>Правильно сказать:</strong> «<code>private</code> — это удобный инструмент защиты состояния, а инкапсуляция — это <em>ответственность класса самому управлять своим состоянием</em>». Без понимания инвариантов <code>private</code> бесполезен.</p>
                    </div>

                    <div class="example-label">Контрпример: <code>private</code> есть, инкапсуляция слабая</div>
                    <pre><code><span class="keyword">class</span> <span class="function">Cart</span>
{
    <span class="keyword">private</span> <span class="keyword">array</span> <span class="variable">$items</span> = [];

    <span class="comment">// ❌ Геттер возвращает ССЫЛКУ на массив — внешний код может менять</span>
    <span class="keyword">public</span> <span class="keyword">function</span> &<span class="function">getItems</span>(): <span class="keyword">array</span>
    {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">items</span>;
    }
}

<span class="variable">$cart</span> = <span class="keyword">new</span> <span class="function">Cart</span>();
<span class="variable">$items</span> = &<span class="variable">$cart</span>-><span class="function">getItems</span>();
<span class="variable">$items</span>[] = <span class="string">'обход проверок!'</span>;
<span class="comment">// $items в Cart изменён напрямую, addItem() обойдён.
// private есть, но инвариант не защищён → инкапсуляция СЛАБАЯ.</span></code></pre>

                    <div class="example-label">Aggregate Root в реальном коде Laravel</div>
                    <pre><code><span class="keyword">final class</span> <span class="function">Order</span>
{
    <span class="keyword">private</span> <span class="keyword">array</span> <span class="variable">$items</span> = [];

    <span class="comment">// ─── Команды защищают инварианты ───</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">addItem</span>(<span class="function">Item</span> <span class="variable">$item</span>): <span class="keyword">void</span>
    {
        <span class="comment">// Инвариант 1: не больше 100 товаров</span>
        <span class="keyword">if</span> (<span class="function">count</span>(<span class="variable">$this</span>-><span class="variable">items</span>) >= <span class="number">100</span>) {
            <span class="keyword">throw</span> <span class="keyword">new</span> <span class="function">DomainException</span>(<span class="string">'Лимит товаров'</span>);
        }

        <span class="comment">// Инвариант 2: товар должен быть в каталоге</span>
        <span class="keyword">if</span> (!<span class="variable">$item</span>-><span class="function">isAvailable</span>()) {
            <span class="keyword">throw</span> <span class="keyword">new</span> <span class="function">DomainException</span>(<span class="string">'Товар недоступен'</span>);
        }

        <span class="variable">$this</span>-><span class="variable">items</span>[] = <span class="variable">$item</span>;
    }

    <span class="comment">// ─── Query возвращает COPY, не reference ───</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">items</span>(): <span class="keyword">array</span>
    {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">items</span>;  <span class="comment">// PHP передаст копию (CoW для массивов)</span>
    }
}</code></pre>

                    <div class="remember-box">
                        <strong>3 признака настоящего Aggregate Root:</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><strong>1. Encapsulation</strong> — состояние private, нет обхода через геттеры по ссылке.</li>
                            <li><strong>2. Invariants</strong> — проверки внутри команд явно защищают бизнес-правила.</li>
                            <li><strong>3. Transactional boundary</strong> — один <code>save()</code> атомарно сохраняет весь агрегат (Order + все OrderItem за раз).</li>
                        </ul>
                        <p style="margin:10px 0 0"><strong>Cross-ref:</strong> подробнее про DDD, паттерны Entity / Value Object / Repository — <a href="/KB_5_Architecture#sec-architectural" style="color:#1D4ED8">KB_5 Architecture → DDD basics</a>.</p>
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Aggregate Root — паттерн «инкапсулированное состояние»</h3>
                    <div class="content-block">
                        Когда у класса есть <strong>private $items / $children / $orders</strong> и единственный способ их менять — через свои методы (<code>addItem()</code>, <code>removeItem()</code>), это паттерн <strong>Aggregate Root</strong> из DDD. Класс владеет коллекцией и защищает её инварианты.
                    </div>

                    <div class="example-label">Шаблон Aggregate Root</div>
                    <pre><code><span class="keyword">final class</span> <span class="function">ShoppingCart</span>
{
    <span class="keyword">private</span> <span class="keyword">array</span> <span class="variable">$items</span> = [];          <span class="comment">// ← ИНКАПСУЛИРОВАННОЕ состояние</span>

    <span class="comment">// ─── Команды: МЕНЯЮТ состояние, возвращают void ───</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">addItem</span>(<span class="function">Item</span> <span class="variable">$item</span>): <span class="keyword">void</span>
    {
        <span class="comment">// инварианты проверяются ЗДЕСЬ — не дать положить дубль/невалидное</span>
        <span class="keyword">if</span> (<span class="function">count</span>(<span class="variable">$this</span>-><span class="variable">items</span>) >= <span class="number">50</span>) {
            <span class="keyword">throw</span> <span class="keyword">new</span> <span class="function">DomainException</span>(<span class="string">'Cart full'</span>);
        }
        <span class="variable">$this</span>-><span class="variable">items</span>[] = <span class="variable">$item</span>;
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">removeItem</span>(<span class="keyword">int</span> <span class="variable">$index</span>): <span class="keyword">void</span>
    {
        <span class="function">unset</span>(<span class="variable">$this</span>-><span class="variable">items</span>[<span class="variable">$index</span>]);
        <span class="variable">$this</span>-><span class="variable">items</span> = <span class="function">array_values</span>(<span class="variable">$this</span>-><span class="variable">items</span>);  <span class="comment">// переиндексация</span>
    }

    <span class="comment">// ─── Query: ЧИТАЮТ состояние, не меняют ───</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">total</span>(): <span class="keyword">float</span>
    {
        <span class="keyword">return</span> <span class="function">array_sum</span>(<span class="function">array_map</span>(
            <span class="keyword">fn</span>(<span class="function">Item</span> <span class="variable">$i</span>): <span class="keyword">float</span> => <span class="variable">$i</span>-><span class="function">price</span>(),
            <span class="variable">$this</span>-><span class="variable">items</span>
        ));
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">isEmpty</span>(): <span class="keyword">bool</span>
    {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">items</span> === [];
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">itemCount</span>(): <span class="keyword">int</span>
    {
        <span class="keyword">return</span> <span class="function">count</span>(<span class="variable">$this</span>-><span class="variable">items</span>);
    }
}</code></pre>

                    <div class="remember-box">
                        <strong>3 признака правильного Aggregate Root:</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><strong>State в private</strong> — никто снаружи не может написать <code>$cart-&gt;items[] = $bad</code> в обход проверок.</li>
                            <li><strong>Commands vs Queries разделены</strong> (CQS): команды меняют состояние и возвращают <code>void</code>, queries только читают и возвращают данные.</li>
                            <li><strong>Инварианты защищены</strong> — проверки внутри команд (<code>count &lt; max</code>, валидация и т.п.), не дают создать «невалидное» состояние.</li>
                        </ul>
                        <p style="margin:10px 0 0">На собесе на middle+ спросят «как ты защищаешь инварианты» — этот паттерн и есть ответ. См. также KB_5 Architecture → DDD basics.</p>
                    </div>

                    <div class="example-label">Derived value: Cached vs Computed — два пути для <code>total()</code></div>
                    <pre><code><span class="comment">// ─── Подход 1: Cached / Materialized — хранить и обновлять ───</span>
<span class="keyword">final class</span> <span class="function">CartCached</span>
{
    <span class="keyword">private</span> <span class="keyword">array</span> <span class="variable">$items</span> = [];
    <span class="keyword">private</span> <span class="keyword">float</span> <span class="variable">$total</span> = <span class="number">0.0</span>;  <span class="comment">// ← храним сумму</span>

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">addItem</span>(<span class="function">Item</span> <span class="variable">$item</span>): <span class="keyword">void</span>
    {
        <span class="variable">$this</span>-><span class="variable">items</span>[] = <span class="variable">$item</span>;
        <span class="variable">$this</span>-><span class="variable">total</span> += <span class="variable">$item</span>-><span class="function">price</span>();  <span class="comment">// синхронизируем</span>
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">removeItem</span>(<span class="keyword">int</span> <span class="variable">$i</span>): <span class="keyword">void</span>
    {
        <span class="variable">$this</span>-><span class="variable">total</span> -= <span class="variable">$this</span>-><span class="variable">items</span>[<span class="variable">$i</span>]-><span class="function">price</span>();  <span class="comment">// НЕ ЗАБЫТЬ</span>
        <span class="function">unset</span>(<span class="variable">$this</span>-><span class="variable">items</span>[<span class="variable">$i</span>]);
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">total</span>(): <span class="keyword">float</span>
    {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">total</span>;  <span class="comment">// O(1) — мгновенно</span>
    }
}

<span class="comment">// ─── Подход 2: Computed / Derived — считать каждый раз ───</span>
<span class="keyword">final class</span> <span class="function">CartComputed</span>
{
    <span class="keyword">private</span> <span class="keyword">array</span> <span class="variable">$items</span> = [];

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">addItem</span>(<span class="function">Item</span> <span class="variable">$item</span>): <span class="keyword">void</span>
    {
        <span class="variable">$this</span>-><span class="variable">items</span>[] = <span class="variable">$item</span>;
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">total</span>(): <span class="keyword">float</span>
    {
        <span class="comment">// O(n) — проходим по items каждый вызов</span>
        <span class="keyword">return</span> <span class="function">array_sum</span>(<span class="function">array_map</span>(
            <span class="keyword">fn</span>(<span class="function">Item</span> <span class="variable">$i</span>): <span class="keyword">float</span> => <span class="variable">$i</span>-><span class="function">price</span>(),
            <span class="variable">$this</span>-><span class="variable">items</span>
        ));
    }
}</code></pre>

                    <div class="example-label">Trade-off — что выбрать</div>
                    <table class="data-table">
                        <thead>
                            <tr><th>Аспект</th><th>Cached (хранить)</th><th>Computed (считать)</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Чтение total()</td><td><strong>O(1)</strong> ⚡</td><td>O(n) — пройти весь массив</td></tr>
                            <tr><td>Запись (add/remove)</td><td>O(1) + обновить total</td><td>O(1)</td></tr>
                            <tr><td>Риск рассинхрона</td><td><strong>⚠ ВЫСОКИЙ</strong> — добавили метод <code>updatePrice()</code> и забыли пересчитать total → баг</td><td>✅ <strong>Нет</strong> — total всегда актуален</td></tr>
                            <tr><td>Сложность кода</td><td>Выше — синхронизация в каждом mutator</td><td>Ниже — одно место расчёта</td></tr>
                            <tr><td>Тестируемость</td><td>Хуже — скрытое state</td><td>Лучше — pure function</td></tr>
                            <tr><td>Sserialization</td><td>В JSON попадёт «лишний» total</td><td>Только items, total на лету</td></tr>
                        </tbody>
                    </table>

                    <div class="remember-box">
                        <strong>Правило большого пальца:</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><strong>Начинай с Computed</strong> — проще, безопаснее, баги типа «забыл обновить» невозможны.</li>
                            <li><strong>Перепиши на Cached</strong> только когда профайлер показал что <code>total()</code> вызывается тысячи раз и это узкое место.</li>
                            <li><strong>Гибрид (lazy cache):</strong> поле <code>private ?float $cachedTotal = null</code>. В <code>total()</code> если null — считаем и кэшируем. В <code>addItem/removeItem</code> сбрасываем <code>$cachedTotal = null</code>. Получаем O(1) на повторных чтениях + автоматическую инвалидацию.</li>
                        </ul>
                        <p style="margin:10px 0 0"><strong>Анти-паттерн:</strong> <code>$total = $items $item++</code> — синтаксически невалидно. PHP не имеет «магической связки» массив+оператор. Каждая операция явная: <code>$this-&gt;items[] = $item;</code> и (опционально) <code>$this-&gt;total += $item-&gt;price();</code>.</p>
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
                    <h3 class="subsection-title">Trait vs Abstract Class vs Interface — сравнение</h3>
                    <div class="content-block">
                        Эти три инструмента решают разные задачи и часто комбинируются. Главная ошибка — путать их назначение и выбирать неподходящий.
                    </div>

                    <table class="data-table" style="width:100%;border-collapse:collapse;margin:12px 0">
                        <thead>
                            <tr style="background:#F3F4F6">
                                <th style="text-align:left;padding:10px 12px;border:1px solid #E5E7EB">Характеристика</th>
                                <th style="text-align:left;padding:10px 12px;border:1px solid #E5E7EB">Abstract Class</th>
                                <th style="text-align:left;padding:10px 12px;border:1px solid #E5E7EB">Interface</th>
                                <th style="text-align:left;padding:10px 12px;border:1px solid #E5E7EB">Trait</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB"><strong>Концепция</strong></td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">«Является чем-то» (is-a)</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">«Умеет что-то» (can-do)</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">«Копипаст методов» (горизонталь)</td>
                            </tr>
                            <tr>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB"><strong>Множественное использование</strong></td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">❌ Один родитель</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">✅ Сколько угодно</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">✅ Сколько угодно</td>
                            </tr>
                            <tr>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB"><strong>Свойства (поля)</strong></td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">✅ Да, любая видимость</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">❌ Только константы</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">✅ Да, любая видимость</td>
                            </tr>
                            <tr>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB"><strong>Реализация методов</strong></td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">✅ Смесь abstract + concrete</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">❌ Только сигнатуры</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">✅ Полные методы</td>
                            </tr>
                            <tr>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB"><strong>Конструктор</strong></td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">✅ Да</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">❌ Нет</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">⚠️ Технически да, но опасно</td>
                            </tr>
                            <tr>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB"><strong>Можно ли создать инстанс</strong></td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">❌ Нет (только наследник)</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">❌ Нет</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">❌ Нет (только через <code>use</code>)</td>
                            </tr>
                            <tr>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB"><strong>Приоритет при конфликте</strong></td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">Класс переопределяет родителя</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">—</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">Класс &gt; Trait &gt; Parent class</td>
                            </tr>
                            <tr>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB"><strong>Полиморфизм через type-hint</strong></td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">✅ Да</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">✅ Да (рекомендовано)</td>
                                <td style="padding:8px 12px;border:1px solid #E5E7EB">❌ Нет (trait — не тип)</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="example-label">Когда что использовать</div>
                    <pre><code><span class="comment">// ABSTRACT CLASS — общий родитель с базовой логикой и данными</span>
<span class="comment">// Используй когда: есть иерархия "is-a" и общее состояние</span>
<span class="keyword">abstract</span> <span class="keyword">class</span> <span class="function">Animal</span> {
    <span class="keyword">protected</span> <span class="keyword">string</span> <span class="variable">$name</span>;            <span class="comment">// общее состояние</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">eat</span>() { <span class="comment">/* общее поведение */</span> }
    <span class="keyword">abstract</span> <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">sound</span>(): <span class="keyword">string</span>;  <span class="comment">// подкласс ОБЯЗАН</span>
}

<span class="comment">// INTERFACE — контракт способностей, без реализации</span>
<span class="comment">// Используй когда: нужно описать capability для type-hint</span>
<span class="keyword">interface</span> <span class="function">Trainable</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">learn</span>(<span class="keyword">string</span> <span class="variable">$command</span>): <span class="keyword">void</span>;
}

<span class="comment">// TRAIT — переиспользуемое поведение для классов разных веток</span>
<span class="comment">// Используй когда: один и тот же метод нужен в неродственных классах</span>
<span class="keyword">trait</span> <span class="function">Loggable</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">log</span>(<span class="keyword">string</span> <span class="variable">$msg</span>): <span class="keyword">void</span> {
        <span class="function">error_log</span>(<span class="function">static</span>::<span class="keyword">class</span> . <span class="string">": $msg"</span>);
    }
}

<span class="comment">// КОМБИНАЦИЯ — реальный код часто использует все три</span>
<span class="keyword">class</span> <span class="function">Dog</span> <span class="keyword">extends</span> <span class="function">Animal</span> <span class="keyword">implements</span> <span class="function">Trainable</span> {
    <span class="keyword">use</span> <span class="function">Loggable</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">sound</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="string">"Woof"</span>; }
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">learn</span>(<span class="keyword">string</span> <span class="variable">$cmd</span>): <span class="keyword">void</span> { <span class="variable">$this</span>-><span class="function">log</span>(<span class="string">"Learned $cmd"</span>); }
}</code></pre>

                    <div class="remember-box">
                        <strong>Правило большого пальца:</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><strong>Abstract</strong> — когда есть "is-a" иерархия и общее состояние (BaseController, BaseModel)</li>
                            <li><strong>Interface</strong> — когда нужен контракт для DI / полиморфизма (PaymentGatewayInterface)</li>
                            <li><strong>Trait</strong> — когда один и тот же код нужен в неродственных классах (Loggable, Cacheable, Notifiable)</li>
                        </ul>
                    </div>
                </div>

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

                <!-- ═══ Пояснялка-сноска по Traits ═══ -->
                <div class="subsection" style="margin-top:48px;padding:20px 22px;background:#FAFAF7;border-top:1px solid #D1D5DB;border-left:3px solid #9CA3AF;color:#374151;font-size:14px;line-height:1.7">
                    <h3 style="font-size:13px;font-weight:700;letter-spacing:.04em;text-transform:uppercase;color:#6B7280;margin:0 0 14px">📖 Пояснялка — частые вопросы по разделу</h3>

                    <p style="margin:0 0 12px"><strong>① Что такое <code>isset</code> в trait Cacheable?</strong><br>
                    В фрагменте кода <code>if (isset($this->cache[$key]))</code> — это <strong>встроенная языковая конструкция PHP</strong> (не часть trait). Она проверяет, что элемент массива <code>$this->cache</code> с ключом <code>$key</code> существует <strong>И не равен <code>null</code></strong>. В контексте трейта <code>Cacheable</code> логика такая: если ключ есть → вернуть закэшированное значение (без повторного вычисления); если нет → вызвать <code>$callback()</code>, сохранить результат в <code>$cache[$key]</code> и вернуть.</p>

                    <p style="margin:0 0 12px"><strong>② Почему именно <code>isset</code>, а не <code>array_key_exists</code>?</strong><br>
                    <code>isset($this->cache[$key])</code> вернёт <code>true</code>, только если элемент существует <strong>и его значение не <code>null</code></strong>. Если кэшируемая функция может вернуть <code>null</code>, то <code>isset</code> ошибочно решит, что кэша нет, и вызовет <code>$callback()</code> повторно. В таких случаях лучше <code>array_key_exists($key, $this->cache)</code> — он проверяет <em>только</em> наличие ключа. Автор трейта, вероятно, исходит из того, что <code>$callback()</code> никогда не возвращает <code>null</code>, либо такое поведение допустимо.</p>

                    <p style="margin:0 0 12px"><strong>③ Метод <code>validate()</code> из trait — обязательно реализовывать в классе?</strong><br>
                    <strong>Нет.</strong> <code>validate()</code> в trait уже имеет <strong>готовую реализацию</strong> — она «вмешивается» в класс через <code>use Validatable</code>. Класс <code>UserForm</code> получает её бесплатно и может вызвать <code>$form->validate($data)</code> без переопределения. <strong>Обязателен только <code>rules()</code></strong> — у него <code>abstract</code> модификатор. Trait декларирует: «я умею валидировать, но правила задаёт класс-пользователь». Если класс не реализует <code>rules()</code> — fatal error:</p>
                    <pre style="background:#1F2937;color:#F3F4F6;padding:10px 14px;border-radius:4px;font-size:12px;margin:0 0 12px;overflow-x:auto">Fatal error: Class UserForm contains 1 abstract method
and must therefore be declared abstract or implement
the remaining methods (Validatable::rules)</pre>
                    <p style="margin:0 0 12px"><strong>Возможные сценарии</strong> для класса с trait:</p>
                    <ul style="margin:0 0 12px 20px;padding:0;line-height:1.7">
                        <li><strong>Abstract метод trait</strong> (<code>rules()</code>) — <em>обязан</em> реализовать класс.</li>
                        <li><strong>Concrete метод trait</strong> (<code>validate()</code>) — <em>не обязан</em>, наследует as-is. Может переопределить, если хочет другую логику.</li>
                        <li><strong>Свойство trait</strong> (<code>$cache</code>) — попадает в класс автоматически.</li>
                    </ul>
                    <p style="margin:0 0 12px"><em>Это та же логика, что у abstract class:</em> abstract method = контракт, concrete method = бесплатное наследство.</p>

                    <p style="margin:0 0 12px"><strong>④ Интерфейсы могут хранить свойства?</strong><br>
                    <strong>Нет</strong> — интерфейс не может содержать свойства (поля). Только сигнатуры методов (и, в некоторых случаях, константы). Он говорит: «Класс, который меня реализует, обязан иметь такие-то методы», но как эти методы будут работать и какие внутренние свойства для этого понадобятся — решает сам класс.</p>
                    <pre style="background:#1F2937;color:#F3F4F6;padding:10px 14px;border-radius:4px;font-size:12px;margin:0 0 12px;overflow-x:auto">interface CacheableInterface {
    public function remember($key, callable $callback);
}

// Класс сам решает, хранить ли кэш в свойстве $cache, в БД, в Redis и т.д.
class UserService implements CacheableInterface {
    private $cache = []; // ← свойство придумал класс, интерфейс его не требует
    public function remember($key, callable $callback) { /* ... */ }
}</pre>

                    <p style="margin:0 0 12px"><strong>⑤ Трейты могут хранить свойства? Можно ли их изменить в классе?</strong><br>
                    <strong>Да</strong> — трейт может определять свойства (поля) с любым модификатором (<code>public</code>, <code>protected</code>, <code>private</code>). Когда класс подключает трейт через <code>use</code>, все эти свойства становятся частью класса, как будто они были написаны прямо в классе.</p>
                    <p style="margin:0 0 12px"><strong>Что значит «класс может изменить их»?</strong></p>
                    <ul style="margin:0 0 12px 20px;padding:0;line-height:1.7">
                        <li><strong>Изменить значения свойств</strong> — да, легко. Класс может перезаписать <code>$this->cache = []</code> в своём методе.</li>
                        <li><strong>Изменить само объявление</strong> (видимость <code>private</code> на <code>protected</code>, тип или значение по умолчанию) — так просто не выйдет. Если класс повторно объявит свойство с тем же именем, PHP выдаст ошибку, если объявления несовместимы. Можно переопределить метод, который работает со свойством, или использовать механизм <code>insteadof / as</code> — но для свойств это редко и сложно.</li>
                    </ul>
                    <p style="margin:0 0 12px"><em>Правильнее сказать: трейт даёт классу готовые свойства, а класс может использовать и модифицировать их значения, но не может «отменить» или «изменить сигнатуру» самого свойства без конфликта.</em></p>

                    <p style="margin:0 0 12px"><strong>⑥ ⚠ Ограничения trait Cacheable</strong></p>
                    <ul style="margin:0;padding:0 0 0 20px;line-height:1.7">
                        <li><strong>Свойство <code>private $cache</code></strong> — область видимости <code>private</code> внутри трейта, но оно становится частью класса, использующего трейт. Если в классе уже есть свойство <code>$cache</code> — конфликт (его можно разрешить в классе).</li>
                        <li><strong>Кэш живёт только в пределах одного запроса</strong> (in-memory, не сохраняется между HTTP-запросами).</li>
                        <li><strong>Для долговременного кэширования</strong> (Redis, memcached) — этот трейт не подходит. Используй <code>Cache::remember()</code>.</li>
                    </ul>
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
        <span class="variable">$this</span>-><span class="variable">connection</span> = <span class="function">mysqli_connect</span>(<span class="variable">$host</span>, <span class="variable">$user</span>);
        <span class="keyword">echo</span> <span class="string">"Connected"</span>;
    }

    <span class="comment">// __destruct вызывается при удалении объекта</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__destruct</span>() {
        <span class="function">mysqli_close</span>(<span class="variable">$this</span>-><span class="variable">connection</span>);
        <span class="keyword">echo</span> <span class="string">"Disconnected"</span>;
    }
}

<span class="variable">$db</span> = <span class="keyword">new</span> <span class="function">Database</span>(<span class="string">"localhost"</span>, <span class="string">"root"</span>);
<span class="comment">// Output: "Connected"</span>
<span class="variable">$db</span> = <span class="keyword">null</span>;  <span class="comment">// или выход из области видимости</span>
<span class="comment">// Output: "Disconnected"</span></code></pre>

                    <div class="content-block" style="background:#F3F4F6;padding:10px 14px;border-radius:6px;font-size:13px;margin:10px 0">
                        <em>📖 Откуда берутся <code>$host</code>, <code>$user</code>, <code>$connection</code>, что такое RAII, когда деструктор не подходит — см. <strong>«❓ Вопросник / Объяснялка» в конце раздела</strong>.</em>
                    </div>

                    <div class="example-label">RAII — реальные сценарии __construct + __destruct</div>
                    <pre><code><span class="comment">// 1. FileHandler — открыть/закрыть файл автоматически</span>
<span class="keyword">class</span> <span class="function">FileHandler</span> {
    <span class="keyword">private</span> <span class="variable">$handle</span>;
    <span class="keyword">private</span> <span class="keyword">string</span> <span class="variable">$path</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">string</span> <span class="variable">$path</span>, <span class="keyword">string</span> <span class="variable">$mode</span> = <span class="string">'r'</span>) {
        <span class="variable">$this</span>-><span class="variable">path</span> = <span class="variable">$path</span>;
        <span class="variable">$this</span>-><span class="variable">handle</span> = <span class="function">fopen</span>(<span class="variable">$path</span>, <span class="variable">$mode</span>);
        <span class="keyword">if</span> (!<span class="variable">$this</span>-><span class="variable">handle</span>) <span class="keyword">throw</span> <span class="keyword">new</span> <span class="function">Exception</span>(<span class="string">"Cannot open file"</span>);
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">read</span>(): <span class="keyword">string</span> {
        <span class="keyword">return</span> <span class="function">fread</span>(<span class="variable">$this</span>-><span class="variable">handle</span>, <span class="function">filesize</span>(<span class="variable">$this</span>-><span class="variable">path</span>));
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__destruct</span>() {
        <span class="keyword">if</span> (<span class="variable">$this</span>-><span class="variable">handle</span>) <span class="function">fclose</span>(<span class="variable">$this</span>-><span class="variable">handle</span>);  <span class="comment">// гарантированно закроется</span>
    }
}

<span class="comment">// 2. FileLock — захват/освобождение файловой блокировки</span>
<span class="keyword">class</span> <span class="function">FileLock</span> {
    <span class="keyword">private</span> <span class="variable">$handle</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">string</span> <span class="variable">$file</span>) {
        <span class="variable">$this</span>-><span class="variable">handle</span> = <span class="function">fopen</span>(<span class="variable">$file</span>, <span class="string">'c'</span>);
        <span class="function">flock</span>(<span class="variable">$this</span>-><span class="variable">handle</span>, <span class="constant">LOCK_EX</span>);  <span class="comment">// эксклюзивная блокировка</span>
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__destruct</span>() {
        <span class="function">flock</span>(<span class="variable">$this</span>-><span class="variable">handle</span>, <span class="constant">LOCK_UN</span>);
        <span class="function">fclose</span>(<span class="variable">$this</span>-><span class="variable">handle</span>);
    }
}

<span class="comment">// 3. Logger — открыть лог, дописать стартовую/финальную запись</span>
<span class="keyword">class</span> <span class="function">Logger</span> {
    <span class="keyword">private</span> <span class="variable">$logFile</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">string</span> <span class="variable">$filename</span>) {
        <span class="variable">$this</span>-><span class="variable">logFile</span> = <span class="function">fopen</span>(<span class="variable">$filename</span>, <span class="string">'a'</span>);
        <span class="variable">$this</span>-><span class="function">write</span>(<span class="string">"Logger started"</span>);
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">write</span>(<span class="keyword">string</span> <span class="variable">$message</span>): <span class="keyword">void</span> {
        <span class="function">fwrite</span>(<span class="variable">$this</span>-><span class="variable">logFile</span>, <span class="function">date</span>(<span class="string">'Y-m-d H:i:s'</span>) . <span class="string">" - $message\n"</span>);
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__destruct</span>() {
        <span class="variable">$this</span>-><span class="function">write</span>(<span class="string">"Logger finished"</span>);
        <span class="function">fclose</span>(<span class="variable">$this</span>-><span class="variable">logFile</span>);
    }
}

<span class="comment">// 4. TransactionGuard — гарантированный rollback при сбое</span>
<span class="keyword">class</span> <span class="function">TransactionGuard</span> {
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">private</span> <span class="function">PDO</span> <span class="variable">$db</span>) {
        <span class="variable">$this</span>-><span class="variable">db</span>-><span class="function">beginTransaction</span>();
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">commit</span>(): <span class="keyword">void</span> { <span class="variable">$this</span>-><span class="variable">db</span>-><span class="function">commit</span>(); }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__destruct</span>() {
        <span class="comment">// если commit не был вызван — откатываем</span>
        <span class="keyword">if</span> (<span class="variable">$this</span>-><span class="variable">db</span>-><span class="function">inTransaction</span>()) <span class="variable">$this</span>-><span class="variable">db</span>-><span class="function">rollBack</span>();
    }
}

<span class="comment">// Использование:</span>
<span class="keyword">function</span> <span class="function">transfer</span>(<span class="function">PDO</span> <span class="variable">$db</span>): <span class="keyword">void</span> {
    <span class="variable">$tx</span> = <span class="keyword">new</span> <span class="function">TransactionGuard</span>(<span class="variable">$db</span>);
    <span class="comment">// ... любой throw здесь автоматически откатит транзакцию через __destruct</span>
    <span class="variable">$tx</span>-><span class="function">commit</span>();
}</code></pre>

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
        <span class="function">unset</span>(<span class="variable">$this</span>-><span class="variable">data</span>[<span class="variable">$name</span>]);  <span class="comment">// удалить ключ из внутреннего массива</span>
    }
}

<span class="variable">$user</span> = <span class="keyword">new</span> <span class="function">User</span>();
<span class="variable">$user</span>-><span class="variable">name</span> = <span class="string">"Alice"</span>;      <span class="comment">// Вызовет __set</span>
<span class="keyword">echo</span> <span class="variable">$user</span>-><span class="variable">name</span>;          <span class="comment">// Вызовет __get</span>
<span class="keyword">isset</span>(<span class="variable">$user</span>-><span class="variable">name</span>);        <span class="comment">// Вызовет __isset</span></code></pre>

                    <div class="content-block" style="background:#F3F4F6;padding:10px 14px;border-radius:6px;font-size:13px;margin:10px 0">
                        <em>📖 Что такое «несуществующее свойство», два кейса срабатывания магии, цена за магию, что такое <code>unset()</code> — см. <strong>«❓ Вопросник / Объяснялка» в конце раздела</strong>.</em>
                    </div>

                    <div class="example-label">Поток вызовов магических методов</div>
                    <pre><code><span class="variable">$user</span> = <span class="keyword">new</span> <span class="function">User</span>();

<span class="variable">$user</span>-><span class="variable">name</span> = <span class="string">"Alice"</span>;
<span class="comment">// PHP: нет свойства $name → __set('name', 'Alice') → $data['name'] = 'Alice'</span>

<span class="keyword">echo</span> <span class="variable">$user</span>-><span class="variable">name</span>;
<span class="comment">// PHP: нет свойства $name → __get('name') → return $data['name'] = 'Alice'</span>

<span class="function">var_dump</span>(<span class="function">isset</span>(<span class="variable">$user</span>-><span class="variable">name</span>));
<span class="comment">// PHP: нет свойства $name → __isset('name') → isset($data['name']) = true</span>

<span class="function">unset</span>(<span class="variable">$user</span>-><span class="variable">name</span>);
<span class="comment">// PHP: нет свойства $name → __unset('name') → unset($data['name'])</span>

<span class="function">var_dump</span>(<span class="function">isset</span>(<span class="variable">$user</span>-><span class="variable">name</span>));
<span class="comment">// PHP: → __isset('name') → false (ключ удалён из $data)</span></code></pre>

                    <div class="remember-box">
                        <strong>__get/__set</strong> отлично подходят для ленивой загрузки данных, валидации, логирования доступа к свойствам. Это использует <strong>Laravel Eloquent</strong> — поля модели хранятся в <code>$attributes</code>, и обращение <code>$user->name</code> идёт через <code>__get</code>, который читает из <code>$attributes['name']</code> и применяет accessor/cast.
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

                <!-- ═══ Пояснялка-сноска по Магическим методам ═══ -->
                <div class="subsection" style="margin-top:48px;padding:20px 22px;background:#FAFAF7;border-top:1px solid #D1D5DB;border-left:3px solid #9CA3AF;color:#374151;font-size:14px;line-height:1.7">
                    <h3 style="font-size:13px;font-weight:700;letter-spacing:.04em;text-transform:uppercase;color:#6B7280;margin:0 0 14px">📖 Пояснялка — частые вопросы по разделу</h3>

                    <p style="margin:0 0 12px"><strong>① Откуда в примере <code>Database</code> берутся <code>$host</code>, <code>$user</code> и <code>$connection</code>?</strong><br>
                    Распространённое замешательство: в коде класса нет видимого определения <code>$host</code> и <code>$user</code>. Они не являются полями класса — они приходят извне.</p>
                    <ul style="margin:0 0 12px 20px;padding:0;line-height:1.7">
                        <li><code>$host</code>, <code>$user</code> — <strong>параметры конструктора</strong>. Не определены где-то заранее. Получают значения в момент создания объекта: <code>$db = new Database("localhost", "root")</code> — «localhost» становится <code>$host</code>, «root» становится <code>$user</code>.</li>
                        <li><code>$connection</code> — <strong>свойство класса</strong> (<code>private $connection;</code>). Внутри конструктора выполняется <code>$this->connection = mysqli_connect($host, $user)</code>. Функция <code>mysqli_connect()</code> открывает реальное TCP-соединение с сервером MySQL и аутентифицируется. Возвращает объект-ссылку на соединение, который сохраняется в свойстве.</li>
                        <li><strong>Связь с БД:</strong> <code>mysqli_connect()</code> внутри устанавливает TCP-соединение с MySQL по указанному хосту (<code>localhost</code> = сокет или <code>127.0.0.1:3306</code>) и аутентифицируется с указанным пользователем. Если пароль не передан, PHP попытается подключиться без пароля — сработает только если у пользователя действительно нет пароля.</li>
                        <li><strong>В реальных проектах</strong> параметры обычно читаются из <code>.env</code> / <code>config.php</code> и передаются в конструктор. Это стандартный приём: класс не знает, какой именно хост и пользователь будут использоваться — это решает тот, кто создаёт объект.</li>
                        <li><strong>⚠ Опечатка-капкан:</strong> в исходном коде было написано <code>$this->$connection</code> (с двумя <code>$</code>). Правильно: <code>$this->connection</code> (без лишнего <code>$</code> после <code>-&gt;</code>). <code>$this->$connection</code> — это обращение к свойству, имя которого хранится в переменной <code>$connection</code> (variable property). Если переменная не определена — fatal error.</li>
                    </ul>

                    <p style="margin:0 0 12px"><strong>② Что значит «несуществующее свойство» для <code>__get/__set/__isset/__unset</code>?</strong><br>
                    Это свойство, которое <strong>явно не объявлено</strong> в классе (нет ни <code>public $name</code>, ни <code>protected $name</code>, ни <code>private $name</code>). В примере класса <code>User</code> есть только <code>private $data</code> — свойства <code>$name</code> у класса нет, но обращение <code>$user->name = "Alice"</code> работает благодаря <code>__set</code>.</p>
                    <p style="margin:0 0 12px">Магические методы срабатывают в <strong>двух случаях</strong>:</p>
                    <ol style="margin:0 0 12px 20px;padding:0;line-height:1.7">
                        <li><strong>Свойство не объявлено вообще</strong> — как <code>$user->name</code> в примере. PHP не находит свойство → вызывает <code>__set() / __get()</code> и не выдаёт ошибку.</li>
                        <li><strong>Свойство объявлено, но недоступно в текущем контексте</strong> — например, <code>private $name</code>, а вы пытаетесь обратиться к нему извне класса. В этом случае <code>__get / __set</code> тоже будут вызваны.</li>
                    </ol>
                    <p style="margin:0 0 12px"><strong>Почему в примере используется <code>private $data = []</code>?</strong> Вместо реальных свойств объектов автор использует «виртуальные» свойства, которые хранятся внутри массива <code>$data</code>. Это позволяет:</p>
                    <ul style="margin:0 0 12px 20px;padding:0;line-height:1.7">
                        <li>Динамически создавать любые поля без их предварительного объявления.</li>
                        <li>Контролировать доступ через геттеры/сеттеры.</li>
                        <li>Легко преобразовывать объект в массив или JSON (достаточно вернуть <code>$data</code>).</li>
                    </ul>
                    <p style="margin:0 0 12px"><strong>Поток вызовов:</strong></p>
                    <pre style="background:#1F2937;color:#F3F4F6;padding:10px 14px;border-radius:4px;font-size:12px;margin:0 0 12px;overflow-x:auto">$user = new User();
$user->name = "Alice";       // нет свойства $name → __set('name', 'Alice')
echo $user->name;            // нет свойства $name → __get('name') → 'Alice'
var_dump(isset($user->name));// __isset('name') → true
unset($user->name);          // __unset('name')
var_dump(isset($user->name));// __isset('name') → false</pre>
                    <p style="margin:0 0 12px"><strong>Где применяется в реальном коде:</strong> прокси-объекты, ORM (например, Eloquent — поля модели соответствуют столбцам БД), реализация «ленивого» чтения свойств, декораторы и обёртки.</p>

                    <p style="margin:0 0 12px"><strong>③ Что такое <code>unset()</code> внутри <code>__unset</code>?</strong><br>
                    <code>unset()</code> — это <strong>встроенная языковая конструкция PHP</strong> (не функция, как <code>strlen()</code>). Делает одно из трёх в зависимости от аргумента:</p>
                    <ul style="margin:0 0 12px 20px;padding:0;line-height:1.7">
                        <li><code>unset($var)</code> — уничтожает переменную (помечает память для GC, но не мгновенно).</li>
                        <li><code>unset($array[$key])</code> — удаляет элемент массива по ключу. После этого <code>isset($array[$key])</code> = <code>false</code> и <code>array_key_exists()</code> = <code>false</code>.</li>
                        <li><code>unset($obj->prop)</code> — удаляет свойство объекта (либо вызывает <code>__unset</code>, если свойства нет).</li>
                    </ul>
                    <p style="margin:0 0 12px"><strong>В нашем коде:</strong> <code>unset($this->data[$name])</code> удаляет ключ <code>$name</code> из приватного массива <code>$data</code>. Это нужно, чтобы виртуальное свойство «исчезло» — в следующий раз <code>isset($user->name)</code> вернёт <code>false</code>.</p>
                    <p style="margin:0 0 12px"><strong>⚠ Важный нюанс:</strong> для индексированных массивов (<code>[1,2,3]</code>) <code>unset</code> <em>не</em> переиндексирует числовые ключи. После <code>unset($arr[1])</code> массив станет <code>[0 =&gt; 1, 2 =&gt; 3]</code> — пропуск в ключах. Чтобы переиндексировать, используй <code>array_values($arr)</code>.</p>
                    <p style="margin:0 0 12px"><em>Разница для переменных:</em> <code>unset</code> переменной уничтожает её, освобождая память. Для массива — удаляет элемент.</p>

                    <p style="margin:0 0 12px"><strong>④ Что такое RAII? Зачем <code>__construct</code> + <code>__destruct</code>?</strong><br>
                    <strong>RAII (Resource Acquisition Is Initialization)</strong> — паттерн родом из C++: <strong>конструктор захватывает ресурс, деструктор освобождает его</strong>. Применим и в PHP, Python, Ruby. Позволяет избежать утечек и забытого освобождения ресурсов даже если код упал с exception.</p>
                    <p style="margin:0 0 12px"><strong>Частые сценарии:</strong></p>
                    <ul style="margin:0 0 12px 20px;padding:0;line-height:1.7">
                        <li><strong>Файлы:</strong> <code>FileHandler</code> — <code>fopen</code> в конструкторе, <code>fclose</code> в деструкторе. Гарантировано закроется даже если <code>read()</code> бросил исключение.</li>
                        <li><strong>Сокеты:</strong> <code>SocketClient</code> — <code>fsockopen</code> → <code>fclose</code>. Авто-закрытие сетевых соединений.</li>
                        <li><strong>Блокировки файла / семафоры:</strong> <code>FileLock</code> — <code>flock LOCK_EX</code> → <code>flock LOCK_UN</code>. Блокировка автоматически снимется при выходе из scope.</li>
                        <li><strong>Транзакции БД:</strong> <code>TransactionGuard</code> — <code>beginTransaction</code> в конструкторе, в деструкторе <code>if (inTransaction()) rollBack()</code>. Защита от незакрытых транзакций при сбое.</li>
                        <li><strong>GD-изображения / тяжёлые ресурсы:</strong> <code>ImageResource</code> — <code>imagecreatefromjpeg</code> → <code>imagedestroy</code>. Освобождение памяти не дожидаясь GC.</li>
                        <li><strong>Логирование:</strong> <code>Logger</code> — открыть лог в конструкторе с записью «Logger started», в деструкторе — «Logger finished» и <code>fclose</code>.</li>
                    </ul>

                    <p style="margin:0 0 12px"><strong>⑤ Когда деструктор НЕ подходит?</strong></p>
                    <ul style="margin:0 0 12px 20px;padding:0;line-height:1.7">
                        <li><strong>Завершение работы с БД</strong> — обычно <em>не</em> требует закрытия в деструкторе, т.к. соединение PDO закрывается автоматически при уничтожении объекта или в конце скрипта.</li>
                        <li><strong>Сложная логика очистки</strong> — деструктор вызывается при сборке мусора, <strong>порядок не гарантирован</strong>, могут быть зависимости на другие объекты, которые уже были уничтожены.</li>
                        <li><strong>Критические операции</strong> — нельзя полагаться на деструктор, чтобы сохранить данные или отправить подтверждение. Например, в long-running процессах (queue workers, daemons) лучше явно вызывать метод <code>close()</code>.</li>
                        <li><strong>PDO / Redis</strong> — обычно закрываются автоматически при уничтожении объекта, явный close в <code>__destruct</code> избыточен.</li>
                    </ul>

                    <p style="margin:0"><strong>⑥ Какова цена за магические методы?</strong><br>
                    Магические методы <strong>медленнее</strong> прямого доступа к свойству (lookup + вызов метода) и <strong>усложняют IDE-автодополнение</strong>. Их используют для прокси-объектов (например, ORM, где поля соответствуют столбцам БД), реализации «ленивого» чтения свойств, декораторов и обёрток. В большинстве простых классов лучше явно объявлять свойства и писать обычные геттеры/сеттеры (<code>getName()</code>, <code>setName()</code>) — код понятнее и быстрее.</p>
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
                    <h3 class="subsection-title">Разбор <code>throw new InvalidArgumentException(...)</code> построчно</h3>
                    <div class="content-block">
                        Эта конструкция объединяет 4 концепции PHP. Если разобрать каждое слово — становится очевидно, что код делает и почему.
                    </div>

                    <div class="example-label">Что значит каждое слово</div>
                    <pre><code><span class="keyword">throw</span> <span class="keyword">new</span> <span class="function">InvalidArgumentException</span>(<span class="string">'Numeric expected'</span>);
<span class="comment">//  ↑     ↑              ↑                                ↑
//  1     2              3                                4

// 1. throw  — оператор "выбросить исключение"
//             Останавливает нормальное выполнение и передаёт управление
//             ближайшему catch-блоку выше по стеку. Если catch нет —
//             необработанное исключение → fatal error, скрипт умирает.

// 2. new    — оператор создания объекта (см. раздел 4 "ООП")
//             Создаёт ЭКЗЕМПЛЯР указанного класса. throw принимает
//             только объекты-исключения, не классы и не строки.

// 3. InvalidArgumentException — встроенный класс PHP, потомок Exception.
//             По соглашению выбрасывается когда аргумент функции/метода
//             имеет неправильный тип или значение. Сигнализирует
//             "программист передал плохие данные".

// 4. 'Numeric expected' — аргумент конструктора (сообщение об ошибке).
//             Произвольная строка, доступна потом через $e->getMessage().
//             Можно дополнительно передать код ошибки и предыдущее исключение:
//             new InvalidArgumentException($msg, $code, $previousException)</span></code></pre>

                    <div class="example-label">Полный поток: throw → try/catch/finally</div>
                    <pre><code><span class="keyword">function</span> <span class="function">calculate</span>(<span class="variable">$amount</span>, <span class="variable">$quantity</span>): <span class="keyword">float</span>
{
    <span class="keyword">if</span> (!<span class="function">is_numeric</span>(<span class="variable">$amount</span>) || !<span class="function">is_numeric</span>(<span class="variable">$quantity</span>)) {
        <span class="comment">// ← throw остановит функцию, никакого return уже не будет</span>
        <span class="keyword">throw</span> <span class="keyword">new</span> <span class="function">InvalidArgumentException</span>(<span class="string">'Numeric expected'</span>);
    }
    <span class="keyword">return</span> (<span class="keyword">float</span>)<span class="variable">$amount</span> * (<span class="keyword">float</span>)<span class="variable">$quantity</span>;
}

<span class="keyword">try</span> {
    <span class="comment">// Код который МОЖЕТ выбросить исключение</span>
    <span class="keyword">echo</span> <span class="function">calculate</span>(<span class="string">'abc'</span>, <span class="number">5</span>);  <span class="comment">// бросит исключение
                                  // — следующая строка НЕ выполнится</span>
    <span class="keyword">echo</span> <span class="string">"Этот код не выполнится"</span>;
} <span class="keyword">catch</span> (<span class="function">InvalidArgumentException</span> <span class="variable">$e</span>) {
    <span class="comment">// Сюда попадаем если throw сработал.
    // $e — пойманный объект исключения, у него методы:
    //   $e->getMessage()  — наше "Numeric expected"
    //   $e->getFile()     — файл где брошено
    //   $e->getLine()     — строка
    //   $e->getTrace()    — стек вызовов
    //   $e->getCode()     — код ошибки (опц.)</span>
    <span class="keyword">echo</span> <span class="string">"Ошибка: "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>();
} <span class="keyword">finally</span> {
    <span class="comment">// finally выполнится ВСЕГДА:
    // — после try (если исключения не было)
    // — после catch (если было обработано)
    // — даже если в catch новый throw (перед его дальнейшим распространением)
    // Используется для очистки ресурсов (закрыть файл, отпустить блокировку).</span>
    <span class="keyword">echo</span> <span class="string">"Финал"</span>;
}</code></pre>

                    <div class="content-block" style="background:#EFF6FF;border-left:3px solid #3B82F6;padding:14px 18px;margin:10px 0;border-radius:4px">
                        <strong>Зачем выбрасывать исключение вместо <code>return false</code> или <code>echo "error"</code>?</strong>
                        <ul style="margin:6px 0 0 20px;line-height:1.7">
                            <li><strong>Невозможно проигнорировать</strong> — <code>return false</code> вызывающий может забыть проверить. Исключение либо ловят, либо весь скрипт падает.</li>
                            <li><strong>Разделение нормального и аварийного пути</strong> — основной поток функции остаётся чистым (<code>return $result</code>), исключения уходят в <code>catch</code> отдельно.</li>
                            <li><strong>Контекст ошибки</strong> — кроме сообщения автоматически сохраняется стек вызовов: где, в каком файле, в какой строке, кто вызвал.</li>
                            <li><strong>Иерархия — можно ловить по типу</strong> — <code>catch (InvalidArgumentException)</code> отдельно от <code>catch (DatabaseException)</code>. Разная реакция на разные ошибки.</li>
                        </ul>
                    </div>

                    <div class="example-label">Встроенные классы исключений — что когда выбрасывать</div>
                    <table class="data-table">
                        <thead>
                            <tr><th>Класс</th><th>Когда выбрасывать</th><th>Пример</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><code>InvalidArgumentException</code></td><td>Плохой аргумент — тип или значение</td><td>В <code>calculate()</code> пришла строка вместо числа</td></tr>
                            <tr><td><code>OutOfRangeException</code></td><td>Индекс вне границ</td><td>Доступ к <code>$arr[100]</code> в массиве из 10</td></tr>
                            <tr><td><code>LengthException</code></td><td>Неверная длина строки/массива</td><td>Пароль короче 8 символов</td></tr>
                            <tr><td><code>RuntimeException</code></td><td>Сбой во время выполнения (не баг)</td><td>API не отвечает, БД недоступна</td></tr>
                            <tr><td><code>LogicException</code></td><td>Программная ошибка (баг)</td><td>Метод вызван в неправильном порядке</td></tr>
                            <tr><td><code>DomainException</code></td><td>Значение вне допустимого набора</td><td>Передан статус <code>'unknown'</code>, ожидались <code>active/paused</code></td></tr>
                            <tr><td><code>UnexpectedValueException</code></td><td>Полученное значение не соответствует ожиданиям</td><td>API вернул JSON вместо XML</td></tr>
                        </tbody>
                    </table>

                    <div class="remember-box">
                        <strong>Правило большого пальца:</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><strong>throw</strong> — для аварийных ситуаций, которые не часть нормального выполнения.</li>
                            <li><strong>return false / null</strong> — для нормального «не нашлось»: <code>User::find($id)</code> при отсутствии возвращает <code>null</code>, это не повод для throw.</li>
                            <li><strong>Имя класса исключения = тип проблемы</strong>. На собесе спрашивают разницу <code>InvalidArgumentException</code> vs <code>RuntimeException</code> — первое значит «программист передал плохие данные», второе значит «среда подвела (БД упала)».</li>
                            <li><strong>Не лови <code>Exception</code> огульно</strong> — лови конкретный тип. Иначе скроешь баги, которые надо чинить.</li>
                        </ul>
                    </div>
                </div>

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

            <!-- ═══════════ SECTION 13: CHEATSHEET ═══════════ -->
            <div id="cheatsheet" class="section">
                <h2 class="section-title">📋 Шпаргалка PHP — всё в одной таблице</h2>

                <div class="content-block">
                    Финальная распечатка перед собеседованием. Все ключевые темы в виде таблиц с примерами. Используй как Anki-колоду или как референс «один взгляд — освежил память».
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Типы данных и операторы сравнения</h3>
                    <table class="data-table">
                        <thead>
                            <tr><th>Конструкция</th><th>Как работает</th><th>Пример</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><code>==</code> (loose)</td><td>Type juggling: приводит типы перед сравнением</td><td><code>'0' == false</code> → <code>true</code></td></tr>
                            <tr><td><code>===</code> (strict)</td><td>Сравнение типа И значения</td><td><code>'1' === 1</code> → <code>false</code></td></tr>
                            <tr><td><code>&lt;=&gt;</code> (spaceship)</td><td>Возвращает -1 / 0 / 1</td><td><code>1 &lt;=&gt; 2</code> → <code>-1</code></td></tr>
                            <tr><td><code>??</code> (null coalescing)</td><td>Значение если null/undefined</td><td><code>$a ?? 'default'</code></td></tr>
                            <tr><td><code>?-&gt;</code> (nullsafe)</td><td>Цепочка вызовов без NPE (PHP 8)</td><td><code>$user?-&gt;profile?-&gt;avatar</code></td></tr>
                            <tr><td><code>declare(strict_types=1)</code></td><td>Требует точный тип в аргументах</td><td>Кидает <code>TypeError</code> при несовпадении</td></tr>
                            <tr><td><code>(array)object</code></td><td>Cast объекта в массив</td><td>private → <code>"\0ClassName\0prop"</code> (null-байты!)</td></tr>
                        </tbody>
                    </table>

                    <div class="example-label">False-y значения PHP — ВСЁ что превращается в false</div>
                    <pre><code><span class="comment">// 6 значений (все остальные — true):</span>
<span class="keyword">false</span>, <span class="number">0</span>, <span class="number">0.0</span>, <span class="string">""</span>, <span class="string">"0"</span>, <span class="keyword">null</span>, []

<span class="comment">// ⚠ Ловушки:
// "0.0"  → true (это строка не пустая!)
// "false" → true (это строка не пустая!)
// [0] → true (массив не пустой)</span></code></pre>

                    <div class="example-label" style="background:#DC2626">⚠ PHP 8.0 — ИЗМЕНЕНИЕ сравнения строка vs число (RFC)</div>
                    <div class="content-block" style="background:#FEF2F2;border-left:3px solid #DC2626;padding:14px 18px;margin:10px 0;border-radius:4px">
                        <p style="margin:0 0 8px"><strong>Старое поведение (PHP &lt; 8.0):</strong> при <code>==</code> между строкой и числом — <strong>строка приводилась к числу</strong>. Нечисловая строка → <code>0</code>. Поэтому <code>"abc" == 0</code> было <code>true</code> — источник классических уязвимостей.</p>
                        <p style="margin:0 0 8px"><strong>Новое поведение (PHP 8.0+):</strong> если строка <strong>нечисловая</strong> — наоборот, <strong>число приводится к строке</strong>, сравниваются две строки. Если строка <strong>числовая</strong> (<code>"10"</code>, <code>"1e2"</code>) — по-прежнему сравниваются как числа.</p>
                    </div>

                    <table class="data-table">
                        <thead>
                            <tr><th>Выражение</th><th>PHP &lt; 8.0</th><th>PHP 8.0+</th><th>Почему</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><code>"10" == 10</code></td><td><code>true</code></td><td><code>true</code></td><td>Строка <strong>числовая</strong>, сравнение как числа (не изменилось)</td></tr>
                            <tr><td><code>"10" === 10</code></td><td><code>false</code></td><td><code>false</code></td><td>Strict: <code>string</code> ≠ <code>int</code> (не изменилось)</td></tr>
                            <tr><td><code>"" == 0</code></td><td><code>true</code></td><td><strong style="color:#DC2626">false</strong></td><td>Нечисловая (пустая) строка. PHP 8: <code>0</code> → <code>"0"</code>, <code>""</code> ≠ <code>"0"</code></td></tr>
                            <tr><td><code>"abc" == 0</code></td><td><code>true</code></td><td><strong style="color:#DC2626">false</strong></td><td>Нечисловая строка. PHP 8: <code>0</code> → <code>"0"</code>, <code>"abc"</code> ≠ <code>"0"</code></td></tr>
                            <tr><td><code>"0" == 0</code></td><td><code>true</code></td><td><code>true</code></td><td>Строка числовая (значение 0)</td></tr>
                            <tr><td><code>"1abc" == 1</code></td><td><code>true</code></td><td><strong style="color:#DC2626">false</strong></td><td>«Полу-числовая» — раньше парсилась до <code>1</code>, в PHP 8: nonnumeric → сравнение строк</td></tr>
                            <tr><td><code>"100" == "1e2"</code></td><td><code>true</code></td><td><code>true</code></td><td>Обе строки числовые: 100 == 100</td></tr>
                            <tr><td><code>'0' == false</code></td><td><code>true</code></td><td><code>true</code></td><td>Сравнение с <code>bool</code> — другие правила (приведение к bool)</td></tr>
                        </tbody>
                    </table>

                    <div class="remember-box">
                        <strong>Правило для шпаргалки (PHP 8.0+):</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.7">
                            <li><strong>Строка ЧИСЛОВАЯ + число</strong> → сравнение как числа (<code>"10" == 10</code> → true)</li>
                            <li><strong>Строка НЕчисловая + число</strong> → число приводится к строке (<code>"abc" == 0</code> → false)</li>
                            <li><strong>Безопасное правило:</strong> в production-коде используй ТОЛЬКО <code>===</code>. На собесе говорить «всегда <code>===</code>, изменение PHP 8 знаю наизусть».</li>
                        </ul>
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Массивы — ключевые функции</h3>
                    <table class="data-table">
                        <thead>
                            <tr><th>Функция</th><th>Что делает</th><th>Возвращает</th><th>Ключи</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><code>array_map</code></td><td>Трансформация каждого элемента</td><td>Новый массив</td><td>Сбрасывает (числовые) или сохраняет (assoc)</td></tr>
                            <tr><td><code>array_filter</code></td><td>Фильтрация по callback</td><td>Новый массив</td><td><strong>Сохраняются!</strong> (часто баг)</td></tr>
                            <tr><td><code>array_reduce</code></td><td>Свёртка в одно значение</td><td>Любой тип</td><td>—</td></tr>
                            <tr><td><code>array_walk</code></td><td>Мутация in-place (по ссылке <code>&amp;</code>)</td><td><code>bool</code></td><td>—</td></tr>
                            <tr><td><code>array_merge</code></td><td>Сложение, числовые переиндексируются</td><td>Новый массив</td><td>String-ключи перезаписываются</td></tr>
                            <tr><td><code>+</code> (объединение)</td><td>Левый имеет приоритет</td><td>Новый массив</td><td>Сохраняются (без переиндексации)</td></tr>
                            <tr><td><code>usort</code></td><td>Сортировка с callback (spaceship)</td><td><code>bool</code> (in-place)</td><td>Сбрасываются</td></tr>
                            <tr><td><code>array_column</code></td><td>Вытащить столбец из массива объектов</td><td>Массив значений</td><td>—</td></tr>
                            <tr><td><code>array_key_exists</code></td><td>Ключ есть (даже если value = <code>null</code>)</td><td><code>bool</code></td><td>—</td></tr>
                            <tr><td><code>isset</code></td><td>Ключ есть <strong>И</strong> не <code>null</code></td><td><code>bool</code></td><td>—</td></tr>
                        </tbody>
                    </table>

                    <div class="example-label">Флаги array_filter</div>
                    <table class="data-table">
                        <thead><tr><th>Флаг</th><th>Сигнатура callback</th><th>Когда применять</th></tr></thead>
                        <tbody>
                            <tr><td>по умолчанию</td><td><code>fn($value)</code></td><td>Стандартная фильтрация по значению</td></tr>
                            <tr><td><code>ARRAY_FILTER_USE_KEY</code></td><td><code>fn($key)</code></td><td>Фильтрация по ключу (префикс/суффикс ключа)</td></tr>
                            <tr><td><code>ARRAY_FILTER_USE_BOTH</code></td><td><code>fn($value, $key)</code></td><td>Когда условие зависит от обоих</td></tr>
                        </tbody>
                    </table>

                    <div class="remember-box">
                        <strong>array_reduce порядок аргументов callback:</strong> <code>fn($carry, $item)</code> — 1-й аккумулятор, 2-й текущий элемент. <strong>Имена НЕ важны</strong>, важен <strong>порядок</strong>. Это зашито в реализацию PHP.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">ООП — abstract vs interface vs trait</h3>
                    <table class="data-table">
                        <thead>
                            <tr><th>Характеристика</th><th>Abstract Class</th><th>Interface</th><th>Trait</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Множественное использование</td><td>❌ один родитель</td><td>✅ сколько угодно</td><td>✅ сколько угодно</td></tr>
                            <tr><td>Свойства (поля)</td><td>✅ любая видимость</td><td>❌ только константы</td><td>✅ любая видимость</td></tr>
                            <tr><td>Реализация методов</td><td>микс abstract+concrete</td><td>❌ только сигнатуры</td><td>✅ полные методы</td></tr>
                            <tr><td>Конструктор</td><td>✅ да</td><td>❌ нет</td><td>⚠ технически да, опасно</td></tr>
                            <tr><td>Создать инстанс</td><td>❌ нет</td><td>❌ нет</td><td>❌ только через <code>use</code></td></tr>
                            <tr><td>Type-hint в функциях</td><td>✅ да</td><td>✅ да (рекомендовано)</td><td>❌ trait — не тип</td></tr>
                            <tr><td>Семантика</td><td>«is-a»</td><td>«can-do»</td><td>«копипаст методов»</td></tr>
                            <tr><td>Когда выбирать</td><td>иерархия + общее состояние</td><td>контракт для DI / полиморфизма</td><td>код для разных веток</td></tr>
                        </tbody>
                    </table>

                    <div class="example-label">Late Static Binding — static:: vs self::</div>
                    <table class="data-table">
                        <thead><tr><th>Конструкция</th><th>Резолвится в</th><th>Использовать когда</th></tr></thead>
                        <tbody>
                            <tr><td><code>self::</code></td><td>Класс где написано (compile-time)</td><td>Нужен именно ЭТОТ класс, без подмены</td></tr>
                            <tr><td><code>static::</code></td><td>Реальный вызываемый класс (runtime)</td><td>Полиморфизм через статику (фабрики, ORM)</td></tr>
                            <tr><td><code>parent::</code></td><td>Родительский класс</td><td>Вызов родителя из переопределённого метода</td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Магические методы</h3>
                    <table class="data-table">
                        <thead>
                            <tr><th>Метод</th><th>Когда вызывается</th><th>Типичный use case</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><code>__construct</code></td><td><code>new Class(...)</code></td><td>Инициализация, RAII захват ресурса</td></tr>
                            <tr><td><code>__destruct</code></td><td><code>$obj = null</code> / выход из scope</td><td>RAII освобождение ресурса</td></tr>
                            <tr><td><code>__get($name)</code></td><td>Чтение несуществующего/<code>private</code></td><td>ORM атрибуты, прокси</td></tr>
                            <tr><td><code>__set($name, $value)</code></td><td>Запись несуществующего/<code>private</code></td><td>ORM атрибуты, валидация в сеттере</td></tr>
                            <tr><td><code>__isset($name)</code></td><td><code>isset($obj-&gt;prop)</code> на магическом</td><td>Поддержка <code>isset</code> для виртуальных свойств</td></tr>
                            <tr><td><code>__unset($name)</code></td><td><code>unset($obj-&gt;prop)</code> на магическом</td><td>Удаление виртуального свойства</td></tr>
                            <tr><td><code>__call($name, $args)</code></td><td>Вызов несущ. метода</td><td>Fluent Builder, Query Builder</td></tr>
                            <tr><td><code>__callStatic($n, $a)</code></td><td>Вызов несущ. static метода</td><td>Facade pattern (Laravel)</td></tr>
                            <tr><td><code>__toString()</code></td><td><code>(string)$obj</code>, <code>echo $obj</code></td><td>Value Objects (Money → "$100")</td></tr>
                            <tr><td><code>__invoke($args)</code></td><td><code>$obj()</code> — объект как функция</td><td>Single Action Classes (Laravel)</td></tr>
                            <tr><td><code>__clone()</code></td><td><code>clone $obj</code></td><td>Глубокое клонирование (deep copy)</td></tr>
                            <tr><td><code>__debugInfo()</code></td><td><code>var_dump / print_r</code></td><td>Скрыть password, секреты из дампа</td></tr>
                            <tr><td><code>__serialize() / __unserialize</code></td><td><code>serialize($obj)</code></td><td>Контроль сериализации, защита secrets</td></tr>
                        </tbody>
                    </table>

                    <div class="remember-box">
                        <strong>RAII (Resource Acquisition Is Initialization):</strong> конструктор захватывает ресурс, деструктор освобождает. Применимо к: <strong>файлам</strong>, <strong>сокетам</strong>, <strong>блокировкам</strong>, <strong>транзакциям</strong>, <strong>GD-изображениям</strong>.
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">PHP 8.x — ключевые фичи</h3>
                    <table class="data-table">
                        <thead>
                            <tr><th>Фича</th><th>Версия</th><th>Пример</th><th>Зачем</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><code>match</code></td><td>8.0</td><td><code>match($x) { 1, 2 =&gt; 'a' }</code></td><td>Строгое сравнение (vs <code>switch</code>), возвращает значение</td></tr>
                            <tr><td><code>enum</code></td><td>8.1</td><td><code>enum Status { case Active; }</code></td><td>Типизированные константы, методы</td></tr>
                            <tr><td><code>readonly</code></td><td>8.1</td><td><code>public readonly int $id;</code></td><td>Иммутабельность (Value Objects, DTO)</td></tr>
                            <tr><td>Constructor promotion</td><td>8.0</td><td><code>__construct(private int $id)</code></td><td>Меньше boilerplate в DTO</td></tr>
                            <tr><td>Named arguments</td><td>8.0</td><td><code>foo(name: 'Alice', age: 30)</code></td><td>Читаемость, можно пропускать опц. параметры</td></tr>
                            <tr><td><code>?-&gt;</code> nullsafe</td><td>8.0</td><td><code>$user?-&gt;profile?-&gt;avatar</code></td><td>Цепочка без NullPointerException</td></tr>
                            <tr><td>First-class callable</td><td>8.1</td><td><code>strlen(...)</code></td><td>Передача функции как closure без обёртки</td></tr>
                            <tr><td>Attributes</td><td>8.0</td><td><code>#[Route('/path')]</code></td><td>Декларативная конфигурация (Symfony Routes)</td></tr>
                            <tr><td>Fibers</td><td>8.1</td><td><code>new Fiber(fn() =&gt; ...)</code></td><td>Корутины, основа Amphp/ReactPHP</td></tr>
                            <tr><td>Intersection types</td><td>8.1</td><td><code>Countable&amp;Iterator $x</code></td><td>Множественные требования к типу</td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Top-30 тем — что спросят на собеседовании</h3>
                    <table class="data-table">
                        <thead>
                            <tr><th>#</th><th>Тема</th><th>Уровень</th><th>Раздел KB</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>1</td><td><code>==</code> vs <code>===</code> (type juggling)</td><td>Junior+</td><td>1. Типы данных</td></tr>
                            <tr><td>2</td><td>False-y значения (что превращается в <code>false</code>)</td><td>Junior+</td><td>1. Типы данных</td></tr>
                            <tr><td>3</td><td><code>abstract</code> vs <code>interface</code> vs <code>trait</code></td><td>Middle</td><td>5. ООП Abstract, 6. Traits</td></tr>
                            <tr><td>4</td><td><code>self::</code> vs <code>static::</code> (Late Static Binding)</td><td>Middle</td><td>4. ООП Основы</td></tr>
                            <tr><td>5</td><td>RAII: <code>__construct</code> + <code>__destruct</code></td><td>Middle</td><td>7. Магические методы</td></tr>
                            <tr><td>6</td><td><code>array_map</code> vs <code>filter</code> vs <code>reduce</code></td><td>Junior+</td><td>3. Массивы</td></tr>
                            <tr><td>7</td><td><code>&amp;</code> в <code>array_walk</code> — by reference</td><td>Middle</td><td>3. Массивы</td></tr>
                            <tr><td>8</td><td>Lifecycle PHP-запроса (index.php → response)</td><td>Middle</td><td>cross-ref KB_3</td></tr>
                            <tr><td>9</td><td>PSR-4 autoloading</td><td>Middle</td><td>8. Namespaces</td></tr>
                            <tr><td>10</td><td><code>composer.json</code> sections</td><td>Junior+</td><td>8. Namespaces</td></tr>
                            <tr><td>11</td><td>Exception hierarchy (<code>Error</code> vs <code>Exception</code>)</td><td>Middle</td><td>9. Обработка ошибок</td></tr>
                            <tr><td>12</td><td>Generators <code>yield</code> — когда, зачем</td><td>Middle</td><td>11. Генераторы</td></tr>
                            <tr><td>13</td><td>Closures: <code>use()</code> vs arrow fn</td><td>Middle</td><td>12. Closures</td></tr>
                            <tr><td>14</td><td>Магические методы — цена за магию</td><td>Middle</td><td>7. Магические методы</td></tr>
                            <tr><td>15</td><td>PDO prepared statements (защита от SQLi)</td><td>Junior+</td><td>cross-ref KB_2/KB_4</td></tr>
                            <tr><td>16</td><td><code>password_hash</code> vs <code>md5</code></td><td>Junior+</td><td>cross-ref KB_4</td></tr>
                            <tr><td>17</td><td>Spread operator <code>...</code> в массивах и аргументах</td><td>Middle</td><td>3. Массивы</td></tr>
                            <tr><td>18</td><td>Union types <code>int|string</code></td><td>Middle</td><td>1. Типы данных</td></tr>
                            <tr><td>19</td><td>Nullable <code>?int</code></td><td>Junior+</td><td>1. Типы данных</td></tr>
                            <tr><td>20</td><td>Constructor promotion (PHP 8)</td><td>Middle</td><td>10. PHP 8+</td></tr>
                            <tr><td>21</td><td><code>match</code> vs <code>switch</code></td><td>Middle</td><td>10. PHP 8+</td></tr>
                            <tr><td>22</td><td><code>enum</code> (PHP 8.1)</td><td>Middle</td><td>10. PHP 8+</td></tr>
                            <tr><td>23</td><td><code>readonly</code> свойства</td><td>Middle</td><td>4. ООП Основы</td></tr>
                            <tr><td>24</td><td>Attributes (PHP 8) — Laravel routes/validation</td><td>Senior</td><td>10. PHP 8+</td></tr>
                            <tr><td>25</td><td>Fibers — корутины</td><td>Senior</td><td>10. PHP 8+</td></tr>
                            <tr><td>26</td><td>opcache / JIT</td><td>Senior</td><td>cross-ref KB_6</td></tr>
                            <tr><td>27</td><td>Copy-on-Write для массивов</td><td>Senior</td><td>3. Массивы</td></tr>
                            <tr><td>28</td><td><code>SplObjectStorage</code>, <code>WeakMap</code></td><td>Senior</td><td>—</td></tr>
                            <tr><td>29</td><td><code>Iterator</code> vs <code>Generator</code></td><td>Middle</td><td>11. Генераторы</td></tr>
                            <tr><td>30</td><td><code>__invoke</code> — Single Action Classes</td><td>Middle</td><td>7. Магические методы, cross-ref KB_5</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ═══════════ SECTION 14: INTERVIEW QUESTIONS ═══════════ -->
            <div id="interview" class="section">
                <h2 class="section-title">❓ Вопросник для собеседования (PHP Core)</h2>

                <div class="content-block">
                    Реальные вопросы, которые задают на middle PHP / Laravel собеседованиях. <strong>Сначала отвечай вслух</strong>, потом кликни вопрос — увидишь развёрнутый ответ. Если запнулся — открой соответствующий раздел KB. На собесе важен не дословный ответ, а понимание сути.
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Уровень 1 — Junior+ ($1500-2000) · 10 вопросов</h3>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">1</span> В чём разница <code>==</code> и <code>===</code>? Приведи пример где результат отличается.</div>
                        <div class="qa-a">
                            <p><code>==</code> (loose) приводит типы перед сравнением — это <strong>type juggling</strong>. <code>===</code> (strict) сравнивает <strong>и тип, и значение</strong>.</p>
                            <p>Пример: <code>'0' == false</code> → <code>true</code> (PHP сначала привёл к bool, получил false, сравнил с false). Но <code>'0' === false</code> → <code>false</code> (тип строки и тип bool — разные).</p>
                            <p><strong>⚠ PHP 8.0 изменил правила:</strong> сравнение нечисловой строки с числом раньше было <code>"abc" == 0</code> → <code>true</code> (строка → 0). С PHP 8.0 наоборот — <strong>число приводится к строке</strong>, поэтому <code>"abc" == 0</code> → <code>false</code> (т.к. <code>"abc"</code> ≠ <code>"0"</code>). Подробнее — в Шпаргалке, раздел «Типы».</p>
                            <p>На собесе <strong>всегда говори, что используешь <code>===</code></strong>. Loose-сравнение даёт неочевидные баги.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">2</span> Что выведет: <code>var_dump('0' == false)</code>? А <code>var_dump('0' === false)</code>?</div>
                        <div class="qa-a">
                            <p><code>'0' == false</code> → <code>bool(true)</code>. Строка <code>'0'</code> в bool-контексте превращается в <code>false</code>, потому сравнение <code>false == false</code> = true.</p>
                            <p><code>'0' === false</code> → <code>bool(false)</code>. Тип <code>string</code> ≠ тип <code>bool</code>.</p>
                            <p><strong>⚠ Ловушка:</strong> <code>'0.0' == false</code> → <code>false</code> (это непустая строка, не равна '0'). Поэтому <code>filter_var</code> в PHP осторожнее.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">3</span> Что такое type juggling? Где он опасен?</div>
                        <div class="qa-a">
                            <p><strong>Type juggling</strong> — автоматическое приведение типов при сравнении или операциях. PHP пытается «угадать» что ты хотел.</p>
                            <p>Опасен в трёх местах: <strong>1)</strong> сравнения паролей — <code>$hash == $userInput</code> может магически совпасть с <code>0</code>; используй <code>hash_equals()</code>. <strong>2)</strong> <code>in_array($needle, $haystack)</code> без 3-го параметра <code>true</code> — найдёт <code>"foo"</code> если в массиве есть <code>0</code>. <strong>3)</strong> ключи массивов — числовые строки <code>"5"</code> и числа <code>5</code> резолвятся в один ключ.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">4</span> Назови 6 false-y значений в PHP.</div>
                        <div class="qa-a">
                            <p><strong>6 значений</strong>, которые в bool-контексте становятся <code>false</code>: <code>false</code>, <code>0</code>, <code>0.0</code>, <code>""</code>, <code>"0"</code>, <code>null</code>, <code>[]</code> (пустой массив).</p>
                            <p><strong>Ловушки:</strong> <code>"0.0"</code> → <code>true</code> (непустая строка!), <code>"false"</code> → <code>true</code> (строка), <code>[0]</code> → <code>true</code> (непустой массив).</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">5</span> В чём разница между <code>isset</code> и <code>array_key_exists</code>?</div>
                        <div class="qa-a">
                            <p><code>isset($arr[$key])</code> — true если ключ есть <strong>И</strong> значение не <code>null</code>.</p>
                            <p><code>array_key_exists($key, $arr)</code> — true если ключ есть, <strong>даже если значение null</strong>.</p>
                            <p>Когда применять <code>array_key_exists</code>: если <code>null</code> — валидное значение в твоём массиве (например, кэш может закэшировать <code>null</code> как результат).</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">6</span> Что делает <code>declare(strict_types=1)</code>?</div>
                        <div class="qa-a">
                            <p>Включает <strong>строгую типизацию</strong> для скалярных type-hints в текущем файле. Должен быть первым оператором в файле.</p>
                            <p>Без него: <code>function add(int $a, int $b)</code> примет <code>add('5', 3)</code> — PHP приведёт строку к int. Со <code>strict_types=1</code> — выкинет <code>TypeError</code>.</p>
                            <p>На собесе говорить: «использую <code>strict_types=1</code> во всех файлах, это требование PSR-12 для production-кода».</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">7</span> В чём разница между <code>fn</code> (arrow) и <code>function</code> (anonymous)?</div>
                        <div class="qa-a">
                            <p><strong>Arrow function <code>fn($x) =&gt; $x*2</code></strong> — короткий синтаксис, автоматически захватывает переменные из родительского scope <strong>по значению</strong>. Только одно выражение, без <code>{}</code>.</p>
                            <p><strong>Anonymous function <code>function($x) use ($y) { ... }</code></strong> — нужен явный <code>use</code> для захвата. Может содержать любое тело. По умолчанию захват по значению (по ссылке — <code>use (&amp;$y)</code>).</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">8</span> Чем отличается <code>private</code> от <code>protected</code>?</div>
                        <div class="qa-a">
                            <p><code>private</code> — доступно <strong>только в самом классе</strong>. Даже наследник не видит.</p>
                            <p><code>protected</code> — доступно в классе <strong>и во всех наследниках</strong>.</p>
                            <p>На практике: используй <code>private</code> по умолчанию (инкапсуляция). <code>protected</code> — только когда осознанно проектируешь расширяемость через наследование.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">9</span> Что такое <code>$this</code>? Когда нельзя использовать?</div>
                        <div class="qa-a">
                            <p><code>$this</code> — <strong>ссылка на текущий экземпляр объекта</strong> внутри метода класса.</p>
                            <p><strong>Нельзя использовать:</strong> в <code>static</code> методах (нет инстанса — есть только класс); в обычных функциях вне класса; в <code>__destruct</code> после уничтожения других полей.</p>
                            <p>В static-методе вместо <code>$this</code> — <code>self::</code> (текущий класс) или <code>static::</code> (Late Static Binding).</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">10</span> Что выведет <code>echo "Hello $name"</code> vs <code>echo 'Hello $name'</code>?</div>
                        <div class="qa-a">
                            <p><strong>Double quotes <code>"..."</code></strong> — интерполируют переменные: <code>echo "Hello $name"</code> → <code>"Hello Alice"</code> (если <code>$name = 'Alice'</code>).</p>
                            <p><strong>Single quotes <code>'...'</code></strong> — литералы, переменные НЕ интерполируются: <code>echo 'Hello $name'</code> → <code>"Hello $name"</code> буквально.</p>
                            <p>Также в double quotes работают escape-последовательности: <code>"\n"</code> = перенос строки, в single — буквально 2 символа.</p>
                        </div>
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Уровень 2 — Middle ($2500-3000) · 20 вопросов</h3>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">11</span> В чём разница abstract class и interface? Когда что?</div>
                        <div class="qa-a">
                            <p><strong>Abstract class</strong> — частичная реализация. Может иметь свойства, конкретные методы, абстрактные методы. Один родитель.</p>
                            <p><strong>Interface</strong> — только контракт (сигнатуры). Свойств нет, только константы. Можно реализовать сколько угодно.</p>
                            <p><strong>Когда:</strong> abstract — если есть общее состояние и «is-a» иерархия (BaseController); interface — если нужен контракт для DI / полиморфизма (PaymentInterface). На практике часто комбинируют: <code>class Dog extends Animal implements Trainable</code>.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">12</span> Зачем нужен trait? Чем отличается от abstract class?</div>
                        <div class="qa-a">
                            <p><strong>Trait</strong> — горизонтальное переиспользование кода. Класс может подключить сколько угодно трейтов через <code>use</code>. Решает проблему отсутствия множественного наследования.</p>
                            <p><strong>Отличие от abstract:</strong> abstract — это <strong>«is-a»</strong> (Animal → Dog). Trait — это <strong>«has-behavior»</strong> (Loggable, Cacheable, Notifiable). Используй trait когда метод нужен в неродственных классах.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">13</span> Может ли trait хранить свойства? А интерфейс? А abstract?</div>
                        <div class="qa-a">
                            <p><strong>Abstract class:</strong> ✅ да, любые свойства любой видимости.</p>
                            <p><strong>Interface:</strong> ❌ только константы (<code>const</code>), свойств нет.</p>
                            <p><strong>Trait:</strong> ✅ да, любые свойства. При <code>use</code> попадают в класс как родные. Если в классе уже есть свойство с тем же именем — fatal error при несовместимом объявлении.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">14</span> Что такое Late Static Binding? Чем <code>static::</code> отличается от <code>self::</code>?</div>
                        <div class="qa-a">
                            <p><code>self::</code> — резолвится в класс, где <strong>написан</strong> код (compile-time). <code>static::</code> — резолвится в <strong>реально вызванный</strong> класс (runtime).</p>
                            <p><strong>Пример:</strong> <code>class A { static function make() { return new static(); } }</code>. Если <code>B extends A</code>, то <code>B::make()</code> с <code>self::</code> вернёт <code>A</code>, а с <code>static::</code> — <code>B</code>.</p>
                            <p>Применение: фабричные методы, Eloquent <code>Model::create()</code> возвращает экземпляр конкретной модели.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">15</span> Что делает <code>final</code>? А <code>readonly</code>?</div>
                        <div class="qa-a">
                            <p><strong><code>final class</code></strong> — нельзя унаследоваться. <strong><code>final method</code></strong> — нельзя переопределить в наследниках.</p>
                            <p><strong><code>readonly</code></strong> (PHP 8.1) — свойство можно проинициализировать ОДИН раз (в конструкторе), потом — fatal error при попытке записи. Применяется в Value Objects, DTO.</p>
                            <p>Разница: <code>final</code> запрещает <em>переопределение</em>, <code>readonly</code> запрещает <em>изменение значения</em>.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">16</span> Назови 5 магических методов и когда они вызываются.</div>
                        <div class="qa-a">
                            <p><strong><code>__construct</code></strong> — при <code>new Class(...)</code>.</p>
                            <p><strong><code>__destruct</code></strong> — при <code>$obj = null</code> или выходе из scope (RAII).</p>
                            <p><strong><code>__get($name)</code></strong> — при чтении несуществующего/недоступного свойства (Eloquent attributes).</p>
                            <p><strong><code>__call($name, $args)</code></strong> — при вызове несуществующего метода (fluent builders, facades).</p>
                            <p><strong><code>__toString()</code></strong> — при <code>(string)$obj</code> или <code>echo $obj</code> (Value Objects, Money → "$100").</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">17</span> Что такое RAII? Приведи 3 примера применения <code>__construct/__destruct</code>.</div>
                        <div class="qa-a">
                            <p><strong>RAII (Resource Acquisition Is Initialization)</strong> — паттерн из C++: конструктор захватывает ресурс, деструктор освобождает. Гарантирует освобождение даже при <code>throw</code>.</p>
                            <p><strong>Примеры:</strong></p>
                            <ul style="margin:8px 0 0 20px">
                                <li><strong>FileHandler</strong> — <code>fopen</code> в конструкторе, <code>fclose</code> в деструкторе.</li>
                                <li><strong>TransactionGuard</strong> — <code>beginTransaction</code> → <code>rollBack</code> если не было <code>commit()</code>.</li>
                                <li><strong>FileLock</strong> — <code>flock LOCK_EX</code> → <code>LOCK_UN</code>. Блокировка снимется при выходе из scope.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">18</span> Что происходит при <code>$user->name = 'X'</code>, если в классе нет свойства <code>$name</code>?</div>
                        <div class="qa-a">
                            <p>PHP не находит свойство <code>$name</code> → проверяет, есть ли в классе <code>__set()</code>.</p>
                            <p>Если <code>__set</code> есть → вызывается с аргументами <code>('name', 'X')</code>. Без ошибки.</p>
                            <p>Если <code>__set</code> нет → создаётся <strong>динамическое публичное свойство</strong> <code>$user-&gt;name = 'X'</code>. В PHP 8.2+ — deprecated warning. В PHP 9 — будет fatal error без <code>#[AllowDynamicProperties]</code>.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">19</span> Что такое PSR-4? Зачем нужен autoload?</div>
                        <div class="qa-a">
                            <p><strong>PSR-4</strong> — стандарт autoloading. Маппит namespace на путь к файлу: <code>App\Models\User</code> → <code>app/Models/User.php</code>. Composer генерирует автозагрузчик.</p>
                            <p><strong>Autoload</strong> избавляет от ручных <code>require</code>: PHP сам подгрузит файл при первом использовании класса. Без него — гора <code>require</code> в каждом файле.</p>
                            <p>Настройка в <code>composer.json</code>: <code>"autoload": { "psr-4": { "App\\\\": "app/" } }</code>.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">20</span> Чем отличается <code>require</code>, <code>require_once</code> и autoload?</div>
                        <div class="qa-a">
                            <p><strong><code>require</code></strong> — подгружает файл, fatal error если файла нет. Каждый раз заново.</p>
                            <p><strong><code>require_once</code></strong> — подгружает только если ещё не подгружен (отслеживается на уровне PHP).</p>
                            <p><strong>Autoload</strong> — PHP сам вызывает функцию (зарегистрированную через <code>spl_autoload_register</code>) когда видит неизвестный класс. Composer регистрирует PSR-4 автозагрузчик.</p>
                            <p>В современном коде <code>require</code>/<code>require_once</code> почти не пишут — всё через Composer autoload.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">21</span> Объясни как работает <code>array_reduce</code>. Что такое аккумулятор?</div>
                        <div class="qa-a">
                            <p><code>array_reduce($arr, $callback, $initial)</code> — <strong>сворачивает</strong> массив в одно значение, последовательно применяя callback.</p>
                            <p><strong>Аккумулятор</strong> — промежуточный результат. На каждой итерации callback получает <code>($accumulator, $currentItem)</code> и возвращает новый аккумулятор.</p>
                            <p><strong>Пример:</strong> сумма массива <code>[1,2,3,4]</code> с initial <code>0</code> → 0+1=1, 1+2=3, 3+3=6, 6+4=10. Возвращает 10.</p>
                            <p>PHP жёстко зашил <strong>порядок аргументов callback</strong>: 1-й — аккумулятор, 2-й — текущий элемент. Имена переменных не важны.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">22</span> В чём разница <code>array_map</code>, <code>array_filter</code>, <code>array_walk</code>?</div>
                        <div class="qa-a">
                            <p><strong><code>array_map($cb, $arr)</code></strong> — трансформирует, возвращает <strong>новый</strong> массив. Ключи сбрасываются для числовых массивов.</p>
                            <p><strong><code>array_filter($arr, $cb)</code></strong> — фильтрует, возвращает <strong>новый</strong> массив. <strong>Ключи сохраняются</strong> (это частый сюрприз — после фильтрации могут быть «дырки» в индексах).</p>
                            <p><strong><code>array_walk($arr, $cb)</code></strong> — мутирует массив <strong>in-place</strong>. Callback принимает <code>&amp;$value</code> по ссылке. Возвращает <code>bool</code>.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">23</span> Зачем нужен <code>&amp;</code> в <code>array_walk(&$item)</code>?</div>
                        <div class="qa-a">
                            <p><code>&amp;</code> — <strong>передача по ссылке</strong>. Без неё callback получит копию значения и не сможет изменить элемент массива.</p>
                            <p>С <code>&amp;</code> любые изменения <code>$item</code> внутри callback меняют сам массив (in-place mutation).</p>
                            <p><strong>Контраст с <code>array_map</code>:</strong> map создаёт новый массив (без мутации), walk — мутирует исходный.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">24</span> Что делает <code>ARRAY_FILTER_USE_KEY</code>?</div>
                        <div class="qa-a">
                            <p>Флаг для <code>array_filter</code> — меняет что приходит в callback: вместо <strong>значения</strong> приходит <strong>ключ</strong>.</p>
                            <p><strong>Без флага:</strong> <code>array_filter($arr, fn($value) =&gt; ...)</code>.</p>
                            <p><strong>С <code>USE_KEY</code>:</strong> <code>array_filter($arr, fn($key) =&gt; str_ends_with($key, '_id'), ARRAY_FILTER_USE_KEY)</code> — фильтрация по ключу.</p>
                            <p><strong>Есть ещё <code>ARRAY_FILTER_USE_BOTH</code></strong> — в callback приходят оба: <code>fn($value, $key)</code>.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">25</span> Что такое spread operator <code>...</code> в массивах? В аргументах?</div>
                        <div class="qa-a">
                            <p><strong>В аргументах:</strong> <code>function sum(...$nums)</code> — variadic, собирает аргументы в массив.</p>
                            <p><strong>При вызове:</strong> <code>sum(...[1,2,3])</code> — распаковывает массив в отдельные аргументы.</p>
                            <p><strong>В массивах (PHP 7.4+):</strong> <code>$merged = [...$arr1, ...$arr2, 'extra']</code> — расширение массивов. Быстрее чем <code>array_merge</code>.</p>
                            <p><strong>С string-ключами (PHP 8.1+):</strong> <code>[...$assoc1, ...$assoc2]</code> — работает, дубликаты ключей перезаписываются справа.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">26</span> Когда нужен generator (<code>yield</code>)? Чем отличается от обычной функции?</div>
                        <div class="qa-a">
                            <p><strong>Generator</strong> — функция, которая «лениво» возвращает значения через <code>yield</code> вместо <code>return</code>. Не загружает весь массив в память.</p>
                            <p><strong>Когда нужен:</strong> чтение больших файлов построчно (миллионы строк), обработка потоков, бесконечные последовательности.</p>
                            <p><strong>Пример:</strong> чтение CSV — <code>file_get_contents</code> загружает 10 GB в память → OOM. Generator с <code>fgets</code> → 1 строка за раз, постоянное потребление памяти.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">27</span> Что такое closure? Зачем <code>use ($var)</code>? Можно ли менять переменную в closure?</div>
                        <div class="qa-a">
                            <p><strong>Closure</strong> — анонимная функция, которая «захватывает» переменные из внешнего scope.</p>
                            <p><strong><code>use ($var)</code></strong> — явный список переменных для захвата. По умолчанию <strong>по значению</strong> (копия). Для захвата по ссылке: <code>use (&amp;$var)</code>.</p>
                            <p><strong>Менять переменную:</strong> по значению — изменения внутри closure не видны снаружи. По ссылке — видны.</p>
                            <p><strong>Arrow function</strong> (<code>fn</code>) автоматически захватывает всё нужное по значению, без <code>use</code>.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">28</span> Объясни разницу между <code>Error</code> и <code>Exception</code>.</div>
                        <div class="qa-a">
                            <p>Оба наследуют <code>Throwable</code>, оба ловятся через <code>catch</code>.</p>
                            <p><strong><code>Exception</code></strong> — бизнес/доменные ошибки (validation, not found, unauthorized). Их <strong>ловят</strong> и обрабатывают.</p>
                            <p><strong><code>Error</code></strong> — системные/программные (<code>TypeError</code>, <code>ParseError</code>, <code>OutOfMemoryError</code>). Обычно <strong>НЕ ловят</strong> — это баг, чинить код, а не глотать.</p>
                            <p>Иерархия: <code>Throwable</code> ← <code>Error</code> / <code>Exception</code>. Чтобы поймать всё: <code>catch (\Throwable $t)</code>.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">29</span> Что такое <code>match</code>? Чем отличается от <code>switch</code>?</div>
                        <div class="qa-a">
                            <p><code>match</code> (PHP 8) — выражение, возвращает значение. Использует <strong>строгое сравнение <code>===</code></strong>. Не нужен <code>break</code>. Если ни одна ветка не подошла — <code>UnhandledMatchError</code>.</p>
                            <p><code>switch</code> — оператор (не выражение). Использует <strong>loose <code>==</code></strong>. Нужен <code>break</code>, иначе fall-through. Если ничего не подошло и нет <code>default</code> — молча идёт дальше.</p>
                            <p>В новом коде — <code>match</code> предпочтительнее: безопаснее, короче.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">30</span> Зачем нужен enum (PHP 8.1)? Чем отличается от констант?</div>
                        <div class="qa-a">
                            <p><strong>Enum</strong> — типизированный набор значений. Можно использовать как type-hint: <code>function setStatus(Status $s)</code>.</p>
                            <p><strong>Преимущества над <code>const</code></strong>: 1) защита от случайных значений (<code>'active' </code>vs typo); 2) можно добавлять методы; 3) IDE подсказывает все варианты; 4) <code>Status::cases()</code> вернёт все значения.</p>
                            <p><strong>Виды:</strong> Pure enum (без значений) и Backed enum (<code>enum Status: string { case Active = 'active'; }</code>) для сериализации в БД.</p>
                        </div>
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">Уровень 3 — Middle+/Senior ($3000+) · 15 вопросов</h3>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">31</span> Что такое attributes (PHP 8)? Приведи пример из Laravel/Symfony.</div>
                        <div class="qa-a">
                            <p><strong>Attributes</strong> — нативный механизм декларативной метаинформации над классами/методами/свойствами. До PHP 8 жили в doc-комментариях как аннотации.</p>
                            <p><strong>Пример Symfony:</strong> <code>#[Route('/users/{id}', methods: ['GET'])] public function show(int $id) {...}</code>.</p>
                            <p><strong>Laravel:</strong> <code>#[Route]</code> в роутинге PHP 8 style, <code>#[Validate('email')]</code> в формах.</p>
                            <p>Читаются через рефлексию (<code>ReflectionClass::getAttributes()</code>).</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">32</span> Объясни fibers (PHP 8.1). В чём отличие от generators?</div>
                        <div class="qa-a">
                            <p><strong>Fibers</strong> — корутины с явным управлением. Можно <code>suspend</code> в середине выполнения и <code>resume</code> снаружи.</p>
                            <p><strong>Отличие от generators:</strong> generator может только <code>yield</code> вверх по стеку (своему caller). Fiber может suspend/resume произвольно — это основа для async-фреймворков (AmpHP, ReactPHP).</p>
                            <p>На практике: писать fibers напрямую почти не приходится — используют поверх async-библиотек.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">33</span> Как работает opcache? Что такое JIT (PHP 8)?</div>
                        <div class="qa-a">
                            <p><strong>opcache</strong> — кэширует <strong>скомпилированный bytecode</strong> PHP в shared memory. Без него каждый запрос парсит .php файлы заново.</p>
                            <p><strong>JIT (Just-In-Time)</strong> — компиляция «горячего» bytecode в нативный машинный код. Включается в opcache (<code>opcache.jit=tracing</code>).</p>
                            <p><strong>Эффект:</strong> на типичных веб-задачах (ввод/вывод) JIT даёт ~3-5%. На вычислительных (math, image processing) — до 2-3x.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">34</span> Что такое weak references (<code>WeakMap</code>)? Зачем нужны?</div>
                        <div class="qa-a">
                            <p><strong>WeakReference / WeakMap</strong> — хранят объект, но <strong>не мешают GC</strong> его удалить. Если объект больше нигде не используется — он удаляется, ссылка обнуляется.</p>
                            <p><strong>Зачем:</strong> кэш по объектам, observers/listeners (чтобы listener не удерживал объект в памяти бесконечно), object identity maps в ORM.</p>
                            <p>До PHP 7.4 пришлось бы хранить ID + использовать обычный массив — но это утечка памяти.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">35</span> Как PHP управляет памятью? Что такое circular reference?</div>
                        <div class="qa-a">
                            <p>PHP использует <strong>reference counting</strong> + <strong>cycle collector</strong>. Каждый объект имеет счётчик ссылок (<code>refcount</code>). При <code>refcount=0</code> — удаляется.</p>
                            <p><strong>Circular reference</strong> — два объекта ссылаются друг на друга (<code>$a-&gt;b = $b; $b-&gt;a = $a</code>). Refcount никогда не станет 0. Cycle collector периодически их находит и удаляет.</p>
                            <p>В коде это можно увидеть через <code>gc_collect_cycles()</code>. В long-running процессах (queue workers) важно следить за memory leaks.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">36</span> Объясни Copy-on-Write для массивов в PHP.</div>
                        <div class="qa-a">
                            <p>Когда массив присваивается другой переменной (<code>$b = $a</code>) — PHP <strong>не копирует данные сразу</strong>. Обе переменные ссылаются на одни данные с <code>refcount=2</code>.</p>
                            <p>Копия создаётся <strong>только при первой модификации</strong> одной из них (<code>$b[] = 1</code>). Это и есть Copy-on-Write.</p>
                            <p>Эффект: передача массива в функцию by-value — бесплатна, пока никто не пишет. Поэтому immutable-стиль в PHP не такой дорогой как кажется.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">37</span> В чём проблема <code>serialize</code> объектов? Как её решает <code>__serialize</code>?</div>
                        <div class="qa-a">
                            <p><code>serialize($obj)</code> сериализует <strong>все свойства</strong> объекта, включая приватные. Проблема: <strong>secrets / passwords / API tokens</strong> попадают в сериализованный вид. Если такой объект сохраняется в кэш — leak.</p>
                            <p><strong><code>__serialize()</code></strong> (PHP 7.4+) — позволяет вернуть <code>array</code> с тем, что <strong>хочешь</strong> сохранить. Полный контроль.</p>
                            <p><strong><code>__unserialize($data)</code></strong> — восстанавливает объект из этого массива.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">38</span> Что такое <code>SplObjectStorage</code>? Зачем нужен?</div>
                        <div class="qa-a">
                            <p><strong>SplObjectStorage</strong> — структура «массив, где ключ — объект, значение — любые данные».</p>
                            <p>В обычном массиве PHP ключ может быть только string/int — объект использовать нельзя. <code>SplObjectStorage</code> работает по <code>spl_object_hash($obj)</code>.</p>
                            <p>Применение: object identity maps в ORM, observer registries, dependency graphs.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">39</span> Как реализовать <code>iterable</code> через <code>Iterator</code> vs <code>Generator</code>?</div>
                        <div class="qa-a">
                            <p><strong>Iterator</strong> — интерфейс с 5 методами: <code>current()</code>, <code>key()</code>, <code>next()</code>, <code>rewind()</code>, <code>valid()</code>. Полный контроль над итерацией. Можно несколько раз пройти.</p>
                            <p><strong>Generator</strong> — функция с <code>yield</code>. Короче, но <strong>одноразовый</strong>: после прохождения нельзя rewind (бросает исключение).</p>
                            <p>В Laravel <code>LazyCollection</code> — обёртка над Generator с возможностью «обернуть в Iterator» при необходимости.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">40</span> Что такое <code>Stringable</code> interface (PHP 8)?</div>
                        <div class="qa-a">
                            <p><strong>Stringable</strong> — интерфейс с одним методом <code>__toString(): string</code>. Любой класс с <code>__toString</code> автоматически считается <code>Stringable</code> (это <strong>implicit interface</strong>).</p>
                            <p><strong>Применение:</strong> type-hint <code>function log(string|Stringable $msg)</code> — принимает и строки, и объекты с <code>__toString</code> (например, <code>Money</code>, <code>Url</code>).</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">41</span> Объясни поведение <code>static</code> переменных в функциях.</div>
                        <div class="qa-a">
                            <p><code>function f() { static $count = 0; $count++; return $count; }</code> — <code>$count</code> сохраняется между вызовами, инициализируется один раз.</p>
                            <p>Это не глобальная переменная — она видна только внутри функции. Полезно для счётчиков, мемоизации (хотя для серьёзной мемоизации лучше делать отдельный объект-кэш).</p>
                            <p>⚠ Не работает с recursion-эффектами в parallel testing — статика общая на процесс.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">42</span> Что такое <code>__invoke</code>? Зачем делать класс callable?</div>
                        <div class="qa-a">
                            <p><code>__invoke($args)</code> — магический метод, позволяющий вызвать объект как функцию: <code>$obj($arg1, $arg2)</code>.</p>
                            <p><strong>Зачем:</strong> Single Action Classes в Laravel (<code>class RegisterUser { public function __invoke(RegisterUserData $data) {...} }</code>). Контроллер делает <code>$action($data)</code>.</p>
                            <p>Преимущество над обычным методом <code>handle()</code>: можно DI-инжектить как callable, передавать в pipeline, использовать как value-object для команды.</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">43</span> Чем отличается <code>::class</code> от <code>get_class($obj)</code>?</div>
                        <div class="qa-a">
                            <p><strong><code>User::class</code></strong> — резолвится в <strong>compile-time</strong> в полное имя класса с namespace (<code>"App\\Models\\User"</code>). Работает с use-импортами, IDE подсказывает.</p>
                            <p><strong><code>get_class($obj)</code></strong> — резолвится в <strong>runtime</strong>, возвращает класс конкретного экземпляра. Без аргумента (внутри метода) — текущий класс.</p>
                            <p><strong>Когда что:</strong> <code>::class</code> — для типов в сигнатурах, биндингов DI, attributes. <code>get_class</code> — когда нужно знать реальный класс instance (например, для логирования).</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">44</span> В чём опасность <code>extract()</code> и <code>compact()</code>?</div>
                        <div class="qa-a">
                            <p><strong><code>extract($arr)</code></strong> — создаёт переменные в текущем scope из ключей массива. Опасность: <strong>может перезаписать существующие переменные</strong>. Если массив от пользователя — security hole.</p>
                            <p><strong><code>compact('a', 'b')</code></strong> — обратная операция: создаёт массив из переменных по их именам. Менее опасно, но IDE не подсказывает.</p>
                            <p>В современном коде их избегают: extract — почти никогда, compact — иногда в передаче в Blade-views (хотя Laravel рекомендует именованные массивы).</p>
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="qa-q" onclick="toggleQA(this)"><span class="q-num">45</span> Как реализовать singleton без global state? Какие альтернативы?</div>
                        <div class="qa-a">
                            <p><strong>Классический singleton</strong> — статический <code>getInstance()</code> с <code>private __construct</code>. Проблема: global state, плохо тестируется (нельзя mockать), скрытая зависимость.</p>
                            <p><strong>Альтернатива №1 — Service Container (DI):</strong> класс просто требует через конструктор: <code>__construct(private Cache $cache)</code>. Container даёт всем нужным <strong>один и тот же</strong> экземпляр через <code>singleton()</code> биндинг.</p>
                            <p><strong>Альтернатива №2 — параметризация:</strong> вместо «всегда один» — передавать инстанс явно. Тогда тесты могут передать mock.</p>
                            <p>В Laravel singleton почти всегда означает «singleton scope в контейнере», а не GoF-singleton.</p>
                        </div>
                    </div>

                    <div class="remember-box">
                        <strong>💡 Тактика на собесе:</strong> если не знаешь точно — скажи «не помню точно, но логика была примерно такая...» и рассуждай. Лучше ошибиться рассуждая, чем молчать. На большинстве middle-собесов оценивают не только знание, но и способ думания.
                    </div>
                </div>
            </div>

            <!-- ═══════════ SECTION 15: PRACTICE ═══════════ -->
            <div id="practice" class="section">
                <h2 class="section-title">🛠 Практика руками (PHP Core)</h2>

                <div class="content-block">
                    Без практики теория не приклеивается. Здесь — задания трёх уровней: <strong>микро-задачи</strong> (15 мин) для разогрева, <strong>готовые задания</strong> (30-60 мин) с полным разбором и эталонным кодом, <strong>мини-проекты</strong> (1-2 часа) в стиле LeetCode. Каждое задание — Постановка → Шаги → Эталонный код → Тесты → Подводные камни. Не подсматривай решение до первой попытки.
                </div>

                <!-- ─────── Микро-задачи ─────── -->
                <div class="subsection">
                    <h3 class="subsection-title">📌 Микро-задачи (15 мин каждая) — разогрев</h3>
                    <div class="content-block">
                        Каждая задача с эталонным решением. Сначала пиши сам, потом сверяй.
                    </div>

                    <div class="practice-task">
                        <div class="practice-task-title">Задача 1: <code>isTruthy($x)</code> <span class="practice-task-meta">~15 мин · type juggling</span></div>
                        <p style="font-size:13.5px;color:#374151;margin:6px 0 8px"><strong>Постановка:</strong> Функция возвращает <code>true</code> только если <code>$x</code> НЕ входит в 6 false-y значений PHP. Покрой 10 тестами.</p>

                        <div class="practice-step-label">Эталонное решение</div>
                        <pre><code><span class="keyword">declare</span>(<span class="function">strict_types</span>=<span class="number">1</span>);

<span class="keyword">function</span> <span class="function">isTruthy</span>(<span class="keyword">mixed</span> <span class="variable">$x</span>): <span class="keyword">bool</span>
{
    <span class="comment">// Самый простой и корректный способ — bool-cast</span>
    <span class="keyword">return</span> (<span class="keyword">bool</span>) <span class="variable">$x</span>;
}</code></pre>

                        <div class="practice-step-label">Тесты (PHPUnit)</div>
                        <pre><code><span class="keyword">use</span> <span class="function">PHPUnit\Framework\TestCase</span>;

<span class="keyword">class</span> <span class="function">IsTruthyTest</span> <span class="keyword">extends</span> <span class="function">TestCase</span>
{
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">testFalsyValues</span>(): <span class="keyword">void</span>
    {
        <span class="keyword">foreach</span> ([<span class="keyword">false</span>, <span class="number">0</span>, <span class="number">0.0</span>, <span class="string">""</span>, <span class="string">"0"</span>, <span class="keyword">null</span>, []] <span class="keyword">as</span> <span class="variable">$x</span>) {
            <span class="variable">$this</span>-><span class="function">assertFalse</span>(<span class="function">isTruthy</span>(<span class="variable">$x</span>));
        }
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">testTruthyTraps</span>(): <span class="keyword">void</span>
    {
        <span class="comment">// Ловушки — должны быть true</span>
        <span class="variable">$this</span>-><span class="function">assertTrue</span>(<span class="function">isTruthy</span>(<span class="string">"0.0"</span>));    <span class="comment">// непустая строка!</span>
        <span class="variable">$this</span>-><span class="function">assertTrue</span>(<span class="function">isTruthy</span>(<span class="string">"false"</span>));  <span class="comment">// строка!</span>
        <span class="variable">$this</span>-><span class="function">assertTrue</span>(<span class="function">isTruthy</span>([<span class="number">0</span>]));      <span class="comment">// непустой массив</span>
        <span class="variable">$this</span>-><span class="function">assertTrue</span>(<span class="function">isTruthy</span>(<span class="number">-1</span>));        <span class="comment">// любое не-ноль</span>
    }
}</code></pre>

                        <div class="practice-pitfalls">
                            <strong>⚠ Подводные камни:</strong> <code>"0.0"</code>, <code>"false"</code>, <code>[0]</code> — НЕ false-y (это всегда вопрос на собесе). Не пиши свой список — <code>(bool)$x</code> точнее и короче.
                        </div>
                    </div>

                    <div class="practice-task">
                        <div class="practice-task-title">Задача 2: <code>strict_types</code> и TypeError <span class="practice-task-meta">~15 мин · типы</span></div>
                        <p style="font-size:13.5px;color:#374151;margin:6px 0 8px"><strong>Постановка:</strong> Напиши функцию <code>add(int $a, int $b): int</code>. Вызови с <code>'5'</code> и <code>'3'</code> в двух режимах — со <code>strict_types=1</code> и без. Объясни разницу.</p>

                        <div class="practice-step-label">Эталонное решение</div>
                        <pre><code><span class="comment">// === файл strict.php ===</span>
<span class="keyword">declare</span>(<span class="function">strict_types</span>=<span class="number">1</span>);

<span class="keyword">function</span> <span class="function">add</span>(<span class="keyword">int</span> <span class="variable">$a</span>, <span class="keyword">int</span> <span class="variable">$b</span>): <span class="keyword">int</span>
{
    <span class="keyword">return</span> <span class="variable">$a</span> + <span class="variable">$b</span>;
}

<span class="keyword">try</span> {
    <span class="keyword">echo</span> <span class="function">add</span>(<span class="string">'5'</span>, <span class="string">'3'</span>);
} <span class="keyword">catch</span> (<span class="function">TypeError</span> <span class="variable">$e</span>) {
    <span class="keyword">echo</span> <span class="string">"Caught: "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>();
    <span class="comment">// "add(): Argument #1 ($a) must be of type int, string given"</span>
}

<span class="comment">// === файл loose.php (БЕЗ declare) ===</span>
<span class="keyword">function</span> <span class="function">add</span>(<span class="keyword">int</span> <span class="variable">$a</span>, <span class="keyword">int</span> <span class="variable">$b</span>): <span class="keyword">int</span>
{
    <span class="keyword">return</span> <span class="variable">$a</span> + <span class="variable">$b</span>;
}
<span class="keyword">echo</span> <span class="function">add</span>(<span class="string">'5'</span>, <span class="string">'3'</span>);  <span class="comment">// 8 (PHP молча привёл '5' и '3' к int)</span></code></pre>

                        <div class="practice-pitfalls">
                            <strong>⚠ Подводные камни:</strong> <code>declare(strict_types=1)</code> работает <strong>только в файле, где написан</strong>. Не наследуется по include/autoload. Должен быть <strong>первым оператором</strong> файла (после <code>&lt;?php</code>).
                        </div>
                    </div>

                    <div class="practice-task">
                        <div class="practice-task-title">Задача 3: <code>extractEmails($text)</code> <span class="practice-task-meta">~15 мин · regex</span></div>
                        <p style="font-size:13.5px;color:#374151;margin:6px 0 8px"><strong>Постановка:</strong> Через regex извлеки все email-адреса из произвольного текста. Возврат — массив уникальных email в нижнем регистре.</p>

                        <div class="practice-step-label">Эталонное решение</div>
                        <pre><code><span class="keyword">function</span> <span class="function">extractEmails</span>(<span class="keyword">string</span> <span class="variable">$text</span>): <span class="keyword">array</span>
{
    <span class="comment">// Упрощённый regex (RFC 5322 — гораздо сложнее, но в 99% хватает)</span>
    <span class="variable">$pattern</span> = <span class="string">'/[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}/i'</span>;

    <span class="function">preg_match_all</span>(<span class="variable">$pattern</span>, <span class="variable">$text</span>, <span class="variable">$matches</span>);

    <span class="keyword">return</span> <span class="function">array_values</span>(<span class="function">array_unique</span>(
        <span class="function">array_map</span>(<span class="string">'strtolower'</span>, <span class="variable">$matches</span>[<span class="number">0</span>])
    ));
}

<span class="comment">// Использование</span>
<span class="variable">$text</span> = <span class="string">'Пиши на Alice@Example.com или bob@test.io. Дубль: alice@example.com'</span>;
<span class="function">print_r</span>(<span class="function">extractEmails</span>(<span class="variable">$text</span>));
<span class="comment">// ['alice@example.com', 'bob@test.io']</span></code></pre>

                        <div class="practice-pitfalls">
                            <strong>⚠ Подводные камни:</strong> для прода — <code>filter_var($email, FILTER_VALIDATE_EMAIL)</code> точнее regex. <code>array_unique</code> сохраняет ключи — оборачивай в <code>array_values</code>. Флаг <code>/i</code> — case-insensitive, но в результат вернётся оригинальный регистр.
                        </div>
                    </div>

                    <div class="practice-task">
                        <div class="practice-task-title">Задача 4: <code>formatPrice($amount, $currency)</code> <span class="practice-task-meta">~15 мин · sprintf</span></div>
                        <p style="font-size:13.5px;color:#374151;margin:6px 0 8px"><strong>Постановка:</strong> Форматирование цены в виде <code>"$1,234.56 USD"</code>. Использовать <code>number_format</code> + <code>sprintf</code>.</p>

                        <div class="practice-step-label">Эталонное решение</div>
                        <pre><code><span class="keyword">function</span> <span class="function">formatPrice</span>(<span class="keyword">float</span> <span class="variable">$amount</span>, <span class="keyword">string</span> <span class="variable">$currency</span>): <span class="keyword">string</span>
{
    <span class="variable">$symbol</span> = <span class="keyword">match</span>(<span class="variable">$currency</span>) {
        <span class="string">'USD'</span> => <span class="string">'$'</span>,
        <span class="string">'EUR'</span> => <span class="string">'€'</span>,
        <span class="string">'KZT'</span> => <span class="string">'₸'</span>,
        <span class="keyword">default</span> => <span class="string">''</span>,
    };

    <span class="comment">// number_format($n, decimals=2, decSep='.', thousandsSep=',')</span>
    <span class="variable">$formatted</span> = <span class="function">number_format</span>(<span class="variable">$amount</span>, <span class="number">2</span>, <span class="string">'.'</span>, <span class="string">','</span>);

    <span class="keyword">return</span> <span class="function">sprintf</span>(<span class="string">'%s%s %s'</span>, <span class="variable">$symbol</span>, <span class="variable">$formatted</span>, <span class="variable">$currency</span>);
}

<span class="keyword">echo</span> <span class="function">formatPrice</span>(<span class="number">1234.5</span>, <span class="string">'USD'</span>);   <span class="comment">// "$1,234.50 USD"</span>
<span class="keyword">echo</span> <span class="function">formatPrice</span>(<span class="number">99.99</span>, <span class="string">'EUR'</span>);    <span class="comment">// "€99.99 EUR"</span>
<span class="keyword">echo</span> <span class="function">formatPrice</span>(<span class="number">5500</span>, <span class="string">'KZT'</span>);     <span class="comment">// "₸5,500.00 KZT"</span></code></pre>

                        <div class="practice-pitfalls">
                            <strong>⚠ Подводные камни:</strong> для локализации (русские числа: «1 234,56») — использовать <code>NumberFormatter::CURRENCY</code> из ext-intl. В JSON-API лучше отдавать <strong>цена + валюта отдельно</strong> (минимальные единицы — копейки/центы), а форматировать на фронте.
                        </div>
                    </div>

                    <div class="practice-task">
                        <div class="practice-task-title">Задачи 5-10: микро-разогрев <span class="practice-task-meta">~10 мин каждая</span></div>
                        <p style="font-size:13.5px;color:#374151;margin:6px 0 8px"><strong>Постановка и эталонные one-liner'ы</strong> (сделай свой вариант, потом сверь):</p>

                        <div class="practice-step-label">5. array_map — массив пользователей → массив имён</div>
                        <pre><code><span class="variable">$users</span> = [[<span class="string">'name'</span>=><span class="string">'A'</span>], [<span class="string">'name'</span>=><span class="string">'B'</span>], [<span class="string">'name'</span>=><span class="string">'C'</span>]];
<span class="variable">$names</span> = <span class="function">array_map</span>(<span class="keyword">fn</span>(<span class="variable">$u</span>) => <span class="variable">$u</span>[<span class="string">'name'</span>], <span class="variable">$users</span>);
<span class="comment">// ['A', 'B', 'C']</span>

<span class="comment">// Через array_column короче:</span>
<span class="variable">$names</span> = <span class="function">array_column</span>(<span class="variable">$users</span>, <span class="string">'name'</span>);</code></pre>

                        <div class="practice-step-label">6. array_filter с USE_KEY</div>
                        <pre><code><span class="variable">$data</span> = [<span class="string">'user_id'</span>=><span class="number">1</span>, <span class="string">'admin_id'</span>=><span class="number">2</span>, <span class="string">'name'</span>=><span class="string">'X'</span>];
<span class="variable">$ids</span> = <span class="function">array_filter</span>(
    <span class="variable">$data</span>,
    <span class="keyword">fn</span>(<span class="variable">$k</span>) => <span class="function">str_ends_with</span>(<span class="variable">$k</span>, <span class="string">'_id'</span>),
    <span class="keyword">ARRAY_FILTER_USE_KEY</span>
);
<span class="comment">// ['user_id'=>1, 'admin_id'=>2]</span></code></pre>

                        <div class="practice-step-label">7. array_reduce — статистика заказов</div>
                        <pre><code><span class="variable">$orders</span> = [[<span class="string">'amount'</span>=><span class="number">100</span>], [<span class="string">'amount'</span>=><span class="number">200</span>], [<span class="string">'amount'</span>=><span class="number">150</span>]];
<span class="variable">$stats</span> = <span class="function">array_reduce</span>(<span class="variable">$orders</span>, <span class="keyword">function</span>(<span class="variable">$carry</span>, <span class="variable">$o</span>) {
    <span class="variable">$carry</span>[<span class="string">'total'</span>] += <span class="variable">$o</span>[<span class="string">'amount'</span>];
    <span class="variable">$carry</span>[<span class="string">'count'</span>]++;
    <span class="variable">$carry</span>[<span class="string">'avg'</span>] = <span class="variable">$carry</span>[<span class="string">'total'</span>] / <span class="variable">$carry</span>[<span class="string">'count'</span>];
    <span class="keyword">return</span> <span class="variable">$carry</span>;
}, [<span class="string">'total'</span>=><span class="number">0</span>, <span class="string">'count'</span>=><span class="number">0</span>, <span class="string">'avg'</span>=><span class="number">0</span>]);
<span class="comment">// ['total'=>450, 'count'=>3, 'avg'=>150]</span></code></pre>

                        <div class="practice-step-label">8. array_walk с &amp; — 10% налог in-place</div>
                        <pre><code><span class="variable">$prices</span> = [<span class="number">100</span>, <span class="number">200</span>, <span class="number">300</span>];
<span class="function">array_walk</span>(<span class="variable">$prices</span>, <span class="keyword">fn</span>(&<span class="variable">$p</span>) => <span class="variable">$p</span> *= <span class="number">1.1</span>);
<span class="comment">// [110, 220, 330] — массив изменён in-place</span></code></pre>

                        <div class="practice-step-label">9. usort с spaceship — сортировка объектов</div>
                        <pre><code><span class="variable">$users</span> = [
    (<span class="keyword">object</span>)[<span class="string">'name'</span>=><span class="string">'C'</span>, <span class="string">'age'</span>=><span class="number">30</span>],
    (<span class="keyword">object</span>)[<span class="string">'name'</span>=><span class="string">'A'</span>, <span class="string">'age'</span>=><span class="number">25</span>],
    (<span class="keyword">object</span>)[<span class="string">'name'</span>=><span class="string">'B'</span>, <span class="string">'age'</span>=><span class="number">28</span>],
];
<span class="function">usort</span>(<span class="variable">$users</span>, <span class="keyword">fn</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) => <span class="variable">$a</span>-><span class="variable">age</span> &lt;=&gt; <span class="variable">$b</span>-><span class="variable">age</span>);
<span class="comment">// отсортировано по возрасту: 25, 28, 30</span></code></pre>

                        <div class="practice-step-label">10. Destructuring ассоциативного массива</div>
                        <pre><code><span class="variable">$arr</span> = [<span class="string">'name'</span>=><span class="string">'Alice'</span>, <span class="string">'age'</span>=><span class="number">30</span>, <span class="string">'city'</span>=><span class="string">'NYC'</span>];

[<span class="string">'name'</span> => <span class="variable">$n</span>, <span class="string">'age'</span> => <span class="variable">$a</span>] = <span class="variable">$arr</span>;
<span class="comment">// $n = 'Alice', $a = 30 (без city)</span>

<span class="comment">// В function-signature (PHP 8.0+):</span>
<span class="keyword">function</span> <span class="function">process</span>([<span class="string">'name'</span> => <span class="variable">$name</span>]) { <span class="comment">/* ... */</span> }</code></pre>
                    </div>
                </div>

                <!-- ─────── Готовые задания ─────── -->
                <div class="subsection">
                    <h3 class="subsection-title">📦 Готовые задания — полный разбор (30-60 мин)</h3>

                    <div class="practice-task">
                        <div class="practice-task-title">Задание 1: trait <code>Cacheable</code> с защитой от <code>null</code> <span class="practice-task-meta">~30 мин</span></div>
                        <p style="font-size:13.5px;color:#374151;margin:6px 0 8px"><strong>Постановка:</strong> Реализуй trait <code>Cacheable</code> со свойством <code>$cache</code> и методом <code>remember($key, callable $cb)</code>. <strong>Acceptance:</strong> кэш работает даже когда callback возвращает <code>null</code> (большинство наивных реализаций ломаются именно тут).</p>

                        <div class="practice-step-label">Шаги</div>
                        <ol style="margin:0 0 10px 22px;line-height:1.7;font-size:13.5px">
                            <li>Объяви trait, добавь <code>private array $cache = []</code>.</li>
                            <li>Метод <code>remember</code>: проверь наличие ключа через <code>array_key_exists</code> (НЕ <code>isset</code>!).</li>
                            <li>Если есть — верни закэшированное. Если нет — вызови callback, сохрани, верни.</li>
                            <li>Подключи в <code>UserService</code> через <code>use Cacheable</code>.</li>
                            <li>Напиши тест с callback, возвращающим <code>null</code>: убедись что callback вызывается ровно 1 раз.</li>
                        </ol>

                        <div class="practice-step-label">Эталонное решение</div>
                        <pre><code><span class="keyword">trait</span> <span class="function">Cacheable</span>
{
    <span class="keyword">private</span> <span class="keyword">array</span> <span class="variable">$cache</span> = [];

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">remember</span>(<span class="keyword">string</span> <span class="variable">$key</span>, <span class="keyword">callable</span> <span class="variable">$callback</span>): <span class="keyword">mixed</span>
    {
        <span class="comment">// array_key_exists вместо isset — корректно работает с null</span>
        <span class="keyword">if</span> (<span class="function">array_key_exists</span>(<span class="variable">$key</span>, <span class="variable">$this</span>-><span class="variable">cache</span>)) {
            <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">cache</span>[<span class="variable">$key</span>];
        }

        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">cache</span>[<span class="variable">$key</span>] = <span class="variable">$callback</span>();
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">forget</span>(<span class="keyword">string</span> <span class="variable">$key</span>): <span class="keyword">void</span>
    {
        <span class="function">unset</span>(<span class="variable">$this</span>-><span class="variable">cache</span>[<span class="variable">$key</span>]);
    }
}

<span class="keyword">class</span> <span class="function">UserService</span>
{
    <span class="keyword">use</span> <span class="function">Cacheable</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">findById</span>(<span class="keyword">int</span> <span class="variable">$id</span>): ?<span class="keyword">array</span>
    {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="function">remember</span>(<span class="string">"user.$id"</span>, <span class="keyword">function</span>() <span class="keyword">use</span> (<span class="variable">$id</span>) {
            <span class="comment">// Может вернуть null если пользователь не найден</span>
            <span class="keyword">return</span> <span class="function">DB</span>::<span class="function">find</span>(<span class="variable">$id</span>);
        });
    }
}</code></pre>

                        <div class="practice-step-label">Тесты — критический кейс null</div>
                        <pre><code><span class="keyword">class</span> <span class="function">CacheableTest</span> <span class="keyword">extends</span> <span class="function">TestCase</span>
{
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">testCachesNullResult</span>(): <span class="keyword">void</span>
    {
        <span class="variable">$service</span> = <span class="keyword">new</span> <span class="function">UserService</span>();
        <span class="variable">$callCount</span> = <span class="number">0</span>;

        <span class="variable">$callback</span> = <span class="keyword">function</span>() <span class="keyword">use</span> (&<span class="variable">$callCount</span>) {
            <span class="variable">$callCount</span>++;
            <span class="keyword">return</span> <span class="keyword">null</span>;  <span class="comment">// валидное значение</span>
        };

        <span class="variable">$service</span>-><span class="function">remember</span>(<span class="string">'k'</span>, <span class="variable">$callback</span>);
        <span class="variable">$service</span>-><span class="function">remember</span>(<span class="string">'k'</span>, <span class="variable">$callback</span>);  <span class="comment">// должно взять из кэша</span>
        <span class="variable">$service</span>-><span class="function">remember</span>(<span class="string">'k'</span>, <span class="variable">$callback</span>);

        <span class="variable">$this</span>-><span class="function">assertEquals</span>(<span class="number">1</span>, <span class="variable">$callCount</span>);  <span class="comment">// callback вызван только 1 раз</span>
    }
}</code></pre>

                        <div class="practice-pitfalls">
                            <strong>⚠ Подводные камни:</strong> наивная реализация с <code>isset</code> — НЕ сработает для <code>null</code>: <code>isset($cache['k'])</code> вернёт <code>false</code> если значение null, и callback вызовется снова (классический баг). Также если в классе уже есть <code>$cache</code> с другой видимостью — fatal error при <code>use Cacheable</code>.
                        </div>
                    </div>

                    <div class="practice-task">
                        <div class="practice-task-title">Задание 2: <code>TransactionGuard</code> через RAII <span class="practice-task-meta">~45 мин</span></div>
                        <p style="font-size:13.5px;color:#374151;margin:6px 0 8px"><strong>Постановка:</strong> Класс автоматически откатывает транзакцию, если не было явного <code>commit()</code>. Защита от забытого rollback при exception.</p>

                        <div class="practice-step-label">Шаги</div>
                        <ol style="margin:0 0 10px 22px;line-height:1.7;font-size:13.5px">
                            <li>Класс принимает <code>PDO</code> в конструкторе. Сразу вызывает <code>beginTransaction()</code>.</li>
                            <li>Свойство <code>$committed = false</code>.</li>
                            <li>Метод <code>commit()</code>: вызвать <code>$pdo->commit()</code>, поставить <code>$committed = true</code>.</li>
                            <li>Деструктор: если <code>!$committed</code> и <code>$pdo->inTransaction()</code> — <code>rollBack()</code>.</li>
                            <li>Тест: внутри функции с <code>TransactionGuard</code> кидаем exception, проверяем что транзакция откатилась.</li>
                        </ol>

                        <div class="practice-step-label">Эталонное решение</div>
                        <pre><code><span class="keyword">final class</span> <span class="function">TransactionGuard</span>
{
    <span class="keyword">private</span> <span class="keyword">bool</span> <span class="variable">$committed</span> = <span class="keyword">false</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">private</span> <span class="function">PDO</span> <span class="variable">$db</span>)
    {
        <span class="variable">$this</span>-><span class="variable">db</span>-><span class="function">beginTransaction</span>();
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">commit</span>(): <span class="keyword">void</span>
    {
        <span class="variable">$this</span>-><span class="variable">db</span>-><span class="function">commit</span>();
        <span class="variable">$this</span>-><span class="variable">committed</span> = <span class="keyword">true</span>;
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__destruct</span>()
    {
        <span class="comment">// если не было commit() и транзакция активна — откатываем</span>
        <span class="keyword">if</span> (!<span class="variable">$this</span>-><span class="variable">committed</span> && <span class="variable">$this</span>-><span class="variable">db</span>-><span class="function">inTransaction</span>()) {
            <span class="variable">$this</span>-><span class="variable">db</span>-><span class="function">rollBack</span>();
        }
    }
}

<span class="comment">// Использование</span>
<span class="keyword">function</span> <span class="function">transferMoney</span>(<span class="function">PDO</span> <span class="variable">$db</span>, <span class="keyword">int</span> <span class="variable">$fromId</span>, <span class="keyword">int</span> <span class="variable">$toId</span>, <span class="keyword">int</span> <span class="variable">$amount</span>): <span class="keyword">void</span>
{
    <span class="variable">$tx</span> = <span class="keyword">new</span> <span class="function">TransactionGuard</span>(<span class="variable">$db</span>);

    <span class="variable">$db</span>-><span class="function">prepare</span>(<span class="string">'UPDATE accounts SET balance = balance - ? WHERE id = ?'</span>)
        -><span class="function">execute</span>([<span class="variable">$amount</span>, <span class="variable">$fromId</span>]);

    <span class="variable">$db</span>-><span class="function">prepare</span>(<span class="string">'UPDATE accounts SET balance = balance + ? WHERE id = ?'</span>)
        -><span class="function">execute</span>([<span class="variable">$amount</span>, <span class="variable">$toId</span>]);

    <span class="comment">// Любой throw здесь — транзакция откатится автоматически в __destruct</span>
    <span class="variable">$tx</span>-><span class="function">commit</span>();
}</code></pre>

                        <div class="practice-step-label">Тест — auto-rollback при exception</div>
                        <pre><code><span class="keyword">public</span> <span class="keyword">function</span> <span class="function">testAutoRollbackOnException</span>(): <span class="keyword">void</span>
{
    <span class="variable">$db</span> = <span class="keyword">new</span> <span class="function">PDO</span>(<span class="string">'sqlite::memory:'</span>);
    <span class="variable">$db</span>-><span class="function">exec</span>(<span class="string">'CREATE TABLE t (v INT)'</span>);

    <span class="keyword">try</span> {
        <span class="variable">$tx</span> = <span class="keyword">new</span> <span class="function">TransactionGuard</span>(<span class="variable">$db</span>);
        <span class="variable">$db</span>-><span class="function">exec</span>(<span class="string">'INSERT INTO t VALUES (1)'</span>);
        <span class="keyword">throw</span> <span class="keyword">new</span> <span class="function">RuntimeException</span>(<span class="string">'oops'</span>);
        <span class="variable">$tx</span>-><span class="function">commit</span>();  <span class="comment">// сюда не дойдёт</span>
    } <span class="keyword">catch</span> (<span class="function">RuntimeException</span>) {
        <span class="comment">// $tx уничтожен → __destruct → rollBack</span>
    }

    <span class="variable">$count</span> = <span class="variable">$db</span>-><span class="function">query</span>(<span class="string">'SELECT COUNT(*) FROM t'</span>)-><span class="function">fetchColumn</span>();
    <span class="variable">$this</span>-><span class="function">assertEquals</span>(<span class="number">0</span>, <span class="variable">$count</span>);  <span class="comment">// данных нет — rollback сработал</span>
}</code></pre>

                        <div class="practice-pitfalls">
                            <strong>⚠ Подводные камни:</strong> деструктор вызывается при GC — порядок не гарантирован. Если <code>TransactionGuard</code> ссылается на другие объекты, которые тоже на GC — могут быть проблемы. В long-running процессах лучше явный <code>finally { $tx-&gt;rollBackIfNeeded(); }</code>. Также проверка <code>$db-&gt;inTransaction()</code> важна — без неё <code>rollBack</code> на уже зафиксированной транзакции бросит exception.
                        </div>
                    </div>

                    <div class="practice-task">
                        <div class="practice-task-title">Задание 3: Магический <code>QueryBuilder</code> через <code>__call</code> <span class="practice-task-meta">~45 мин</span></div>
                        <p style="font-size:13.5px;color:#374151;margin:6px 0 8px"><strong>Постановка:</strong> Fluent API через магический <code>__call</code>. <code>$qb->where(...)->orderBy(...)->limit(10)->toSql()</code> — собирает SQL без явного объявления методов.</p>

                        <div class="practice-step-label">Эталонное решение</div>
                        <pre><code><span class="keyword">final class</span> <span class="function">QueryBuilder</span>
{
    <span class="keyword">private</span> <span class="keyword">array</span> <span class="variable">$wheres</span> = [];
    <span class="keyword">private</span> <span class="keyword">array</span> <span class="variable">$orders</span> = [];
    <span class="keyword">private</span> ?<span class="keyword">int</span> <span class="variable">$limit</span> = <span class="keyword">null</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">private</span> <span class="keyword">string</span> <span class="variable">$table</span>) {}

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__call</span>(<span class="keyword">string</span> <span class="variable">$name</span>, <span class="keyword">array</span> <span class="variable">$args</span>): <span class="keyword">self</span>
    {
        <span class="keyword">match</span>(<span class="variable">$name</span>) {
            <span class="string">'where'</span>   => <span class="variable">$this</span>-><span class="variable">wheres</span>[] = <span class="function">sprintf</span>(<span class="string">'%s %s %s'</span>,
                <span class="variable">$args</span>[<span class="number">0</span>], <span class="variable">$args</span>[<span class="number">1</span>], <span class="variable">$this</span>-><span class="function">quote</span>(<span class="variable">$args</span>[<span class="number">2</span>])),
            <span class="string">'orderBy'</span> => <span class="variable">$this</span>-><span class="variable">orders</span>[] = <span class="variable">$args</span>[<span class="number">0</span>] . <span class="string">' '</span> . (<span class="variable">$args</span>[<span class="number">1</span>] ?? <span class="string">'ASC'</span>),
            <span class="string">'limit'</span>   => <span class="variable">$this</span>-><span class="variable">limit</span> = (<span class="keyword">int</span>) <span class="variable">$args</span>[<span class="number">0</span>],
            <span class="keyword">default</span>   => <span class="keyword">throw</span> <span class="keyword">new</span> <span class="function">BadMethodCallException</span>(<span class="string">"Unknown method: $name"</span>),
        };

        <span class="keyword">return</span> <span class="variable">$this</span>;  <span class="comment">// fluent chain</span>
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">toSql</span>(): <span class="keyword">string</span>
    {
        <span class="variable">$sql</span> = <span class="string">"SELECT * FROM {<span class="variable">$this</span>-><span class="variable">table</span>}"</span>;

        <span class="keyword">if</span> (<span class="variable">$this</span>-><span class="variable">wheres</span>) {
            <span class="variable">$sql</span> .= <span class="string">' WHERE '</span> . <span class="function">implode</span>(<span class="string">' AND '</span>, <span class="variable">$this</span>-><span class="variable">wheres</span>);
        }
        <span class="keyword">if</span> (<span class="variable">$this</span>-><span class="variable">orders</span>) {
            <span class="variable">$sql</span> .= <span class="string">' ORDER BY '</span> . <span class="function">implode</span>(<span class="string">', '</span>, <span class="variable">$this</span>-><span class="variable">orders</span>);
        }
        <span class="keyword">if</span> (<span class="variable">$this</span>-><span class="variable">limit</span> !== <span class="keyword">null</span>) {
            <span class="variable">$sql</span> .= <span class="string">" LIMIT {<span class="variable">$this</span>-><span class="variable">limit</span>}"</span>;
        }

        <span class="keyword">return</span> <span class="variable">$sql</span>;
    }

    <span class="keyword">private</span> <span class="keyword">function</span> <span class="function">quote</span>(<span class="keyword">mixed</span> <span class="variable">$v</span>): <span class="keyword">string</span>
    {
        <span class="keyword">return</span> <span class="function">is_int</span>(<span class="variable">$v</span>) ? (<span class="keyword">string</span>) <span class="variable">$v</span> : <span class="string">"'"</span> . <span class="function">addslashes</span>(<span class="variable">$v</span>) . <span class="string">"'"</span>;
    }
}

<span class="comment">// Использование</span>
<span class="variable">$sql</span> = (<span class="keyword">new</span> <span class="function">QueryBuilder</span>(<span class="string">'users'</span>))
    -><span class="function">where</span>(<span class="string">'age'</span>, <span class="string">'>'</span>, <span class="number">18</span>)
    -><span class="function">where</span>(<span class="string">'country'</span>, <span class="string">'='</span>, <span class="string">'KZ'</span>)
    -><span class="function">orderBy</span>(<span class="string">'name'</span>)
    -><span class="function">limit</span>(<span class="number">10</span>)
    -><span class="function">toSql</span>();

<span class="comment">// "SELECT * FROM users WHERE age > 18 AND country = 'KZ' ORDER BY name ASC LIMIT 10"</span></code></pre>

                        <div class="practice-pitfalls">
                            <strong>⚠ Подводные камни:</strong> <code>addslashes</code> в реальном коде — НЕ защита от SQLi! Используй prepared statements (<code>PDO::prepare</code> с параметрами). Магия через <code>__call</code> ломает IDE-автодополнение — поэтому Laravel <code>QueryBuilder</code> уже добавил явные методы. Магия хороша для прототипов / DSL, но в production хочется явных сигнатур.
                        </div>
                    </div>

                    <div class="practice-task">
                        <div class="practice-task-title">Задание 4: <code>PaymentInterface</code> с двумя реализациями <span class="practice-task-meta">~45 мин</span></div>
                        <p style="font-size:13.5px;color:#374151;margin:6px 0 8px"><strong>Постановка:</strong> Интерфейс + Stripe и PayPal реализации. Функция <code>processOrder</code> работает с любой через type-hint интерфейса.</p>

                        <div class="practice-step-label">Эталонное решение</div>
                        <pre><code><span class="keyword">interface</span> <span class="function">PaymentInterface</span>
{
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">charge</span>(<span class="keyword">int</span> <span class="variable">$amountCents</span>, <span class="keyword">string</span> <span class="variable">$currency</span>): <span class="keyword">string</span>;  <span class="comment">// возвращает transactionId</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">refund</span>(<span class="keyword">string</span> <span class="variable">$transactionId</span>): <span class="keyword">bool</span>;
}

<span class="keyword">final class</span> <span class="function">StripePayment</span> <span class="keyword">implements</span> <span class="function">PaymentInterface</span>
{
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">private</span> <span class="keyword">string</span> <span class="variable">$apiKey</span>) {}

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">charge</span>(<span class="keyword">int</span> <span class="variable">$amountCents</span>, <span class="keyword">string</span> <span class="variable">$currency</span>): <span class="keyword">string</span>
    {
        <span class="comment">// Реальный код: \Stripe\Charge::create(...)</span>
        <span class="keyword">return</span> <span class="string">'stripe_ch_'</span> . <span class="function">uniqid</span>();
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">refund</span>(<span class="keyword">string</span> <span class="variable">$transactionId</span>): <span class="keyword">bool</span>
    {
        <span class="keyword">return</span> <span class="function">str_starts_with</span>(<span class="variable">$transactionId</span>, <span class="string">'stripe_'</span>);
    }
}

<span class="keyword">final class</span> <span class="function">PayPalPayment</span> <span class="keyword">implements</span> <span class="function">PaymentInterface</span>
{
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">charge</span>(<span class="keyword">int</span> <span class="variable">$amountCents</span>, <span class="keyword">string</span> <span class="variable">$currency</span>): <span class="keyword">string</span>
    {
        <span class="keyword">return</span> <span class="string">'paypal_TX_'</span> . <span class="function">strtoupper</span>(<span class="function">uniqid</span>());
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">refund</span>(<span class="keyword">string</span> <span class="variable">$transactionId</span>): <span class="keyword">bool</span>
    {
        <span class="keyword">return</span> <span class="function">str_starts_with</span>(<span class="variable">$transactionId</span>, <span class="string">'paypal_'</span>);
    }
}

<span class="comment">// Полиморфизм — функция работает с ЛЮБОЙ реализацией</span>
<span class="keyword">function</span> <span class="function">processOrder</span>(<span class="function">PaymentInterface</span> <span class="variable">$gateway</span>, <span class="keyword">int</span> <span class="variable">$cents</span>): <span class="keyword">string</span>
{
    <span class="keyword">return</span> <span class="variable">$gateway</span>-><span class="function">charge</span>(<span class="variable">$cents</span>, <span class="string">'USD'</span>);
}

<span class="comment">// Один и тот же код — две разные платёжки</span>
<span class="variable">$stripeId</span> = <span class="function">processOrder</span>(<span class="keyword">new</span> <span class="function">StripePayment</span>(<span class="string">'sk_test_...'</span>), <span class="number">1000</span>);
<span class="variable">$paypalId</span> = <span class="function">processOrder</span>(<span class="keyword">new</span> <span class="function">PayPalPayment</span>(), <span class="number">1000</span>);</code></pre>

                        <div class="practice-pitfalls">
                            <strong>⚠ Подводные камни:</strong> <strong>сумма в центах</strong> (<code>int</code>) — никогда <code>float</code>! <code>0.1 + 0.2 !== 0.3</code> в плавающей точке. Reusable check: интерфейс должен быть достаточно широким (Stripe и PayPal оба умеют refund, capture, partial refund, idempotency_key — учти на проектировании).
                        </div>
                    </div>

                    <div class="practice-task">
                        <div class="practice-task-title">Задание 5: Abstract <code>BaseRepository</code> через PDO <span class="practice-task-meta">~50 мин</span></div>
                        <p style="font-size:13.5px;color:#374151;margin:6px 0 8px"><strong>Постановка:</strong> Abstract класс с готовыми <code>find($id)</code>, <code>all()</code>. Наследники определяют только <code>table()</code>. Демонстрация шаблонного метода.</p>

                        <div class="practice-step-label">Эталонное решение</div>
                        <pre><code><span class="keyword">abstract class</span> <span class="function">BaseRepository</span>
{
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">protected</span> <span class="function">PDO</span> <span class="variable">$db</span>) {}

    <span class="comment">// Подкласс ОБЯЗАН реализовать — какая таблица</span>
    <span class="keyword">abstract</span> <span class="keyword">protected</span> <span class="keyword">function</span> <span class="function">table</span>(): <span class="keyword">string</span>;

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">find</span>(<span class="keyword">int</span> <span class="variable">$id</span>): ?<span class="keyword">array</span>
    {
        <span class="variable">$stmt</span> = <span class="variable">$this</span>-><span class="variable">db</span>-><span class="function">prepare</span>(
            <span class="string">"SELECT * FROM {<span class="variable">$this</span>-><span class="function">table</span>()} WHERE id = :id"</span>
        );
        <span class="variable">$stmt</span>-><span class="function">execute</span>([<span class="string">'id'</span> => <span class="variable">$id</span>]);

        <span class="variable">$row</span> = <span class="variable">$stmt</span>-><span class="function">fetch</span>(<span class="function">PDO</span>::<span class="constant">FETCH_ASSOC</span>);
        <span class="keyword">return</span> <span class="variable">$row</span> ?: <span class="keyword">null</span>;
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">all</span>(<span class="keyword">int</span> <span class="variable">$limit</span> = <span class="number">100</span>): <span class="keyword">array</span>
    {
        <span class="variable">$stmt</span> = <span class="variable">$this</span>-><span class="variable">db</span>-><span class="function">prepare</span>(
            <span class="string">"SELECT * FROM {<span class="variable">$this</span>-><span class="function">table</span>()} LIMIT :limit"</span>
        );
        <span class="variable">$stmt</span>-><span class="function">bindValue</span>(<span class="string">':limit'</span>, <span class="variable">$limit</span>, <span class="function">PDO</span>::<span class="constant">PARAM_INT</span>);
        <span class="variable">$stmt</span>-><span class="function">execute</span>();
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">fetchAll</span>(<span class="function">PDO</span>::<span class="constant">FETCH_ASSOC</span>);
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">delete</span>(<span class="keyword">int</span> <span class="variable">$id</span>): <span class="keyword">bool</span>
    {
        <span class="variable">$stmt</span> = <span class="variable">$this</span>-><span class="variable">db</span>-><span class="function">prepare</span>(
            <span class="string">"DELETE FROM {<span class="variable">$this</span>-><span class="function">table</span>()} WHERE id = :id"</span>
        );
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">execute</span>([<span class="string">'id'</span> => <span class="variable">$id</span>]);
    }
}

<span class="comment">// Наследники определяют ОДИН метод</span>
<span class="keyword">final class</span> <span class="function">UserRepository</span> <span class="keyword">extends</span> <span class="function">BaseRepository</span>
{
    <span class="keyword">protected</span> <span class="keyword">function</span> <span class="function">table</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="string">'users'</span>; }
}

<span class="keyword">final class</span> <span class="function">OrderRepository</span> <span class="keyword">extends</span> <span class="function">BaseRepository</span>
{
    <span class="keyword">protected</span> <span class="keyword">function</span> <span class="function">table</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="string">'orders'</span>; }
}

<span class="comment">// Использование — find/all/delete бесплатно во всех</span>
<span class="variable">$users</span> = <span class="keyword">new</span> <span class="function">UserRepository</span>(<span class="variable">$pdo</span>);
<span class="variable">$user</span> = <span class="variable">$users</span>-><span class="function">find</span>(<span class="number">1</span>);
<span class="variable">$all</span> = <span class="variable">$users</span>-><span class="function">all</span>(<span class="number">50</span>);</code></pre>

                        <div class="practice-pitfalls">
                            <strong>⚠ Подводные камни:</strong> <strong>имя таблицы в SQL через интерполяцию</strong> — НЕ через prepared params (PDO не позволяет биндить идентификаторы). Поэтому критично, чтобы <code>table()</code> возвращал <strong>литерал</strong>, а не user input. <code>LIMIT</code> в PDO с MySQL надо биндить через <code>PARAM_INT</code> — иначе lexer воспримет число как строку и SQL сломается.
                        </div>
                    </div>
                </div>

                <!-- ─────── Мини-проекты ─────── -->
                <div class="subsection">
                    <h3 class="subsection-title">🚀 Мини-проекты в стиле LeetCode (1-2 часа)</h3>

                    <div class="practice-task">
                        <div class="practice-task-title">Mini Project 1: Свой <code>my_array_reduce</code> <span class="practice-task-meta">~60 мин</span></div>
                        <p style="font-size:13.5px;color:#374151;margin:6px 0 8px"><strong>Постановка:</strong> Реализуй <code>my_array_reduce(array $arr, callable $cb, $initial)</code>. Поведение должно совпасть со встроенной 1-в-1 на 5 кейсах.</p>

                        <div class="practice-step-label">Скелет + ключевая идея</div>
                        <pre><code><span class="keyword">function</span> <span class="function">my_array_reduce</span>(<span class="keyword">array</span> <span class="variable">$arr</span>, <span class="keyword">callable</span> <span class="variable">$callback</span>, <span class="keyword">mixed</span> <span class="variable">$initial</span> = <span class="keyword">null</span>): <span class="keyword">mixed</span>
{
    <span class="variable">$accumulator</span> = <span class="variable">$initial</span>;

    <span class="keyword">foreach</span> (<span class="variable">$arr</span> <span class="keyword">as</span> <span class="variable">$item</span>) {
        <span class="comment">// Жёстко зашитый порядок: 1-й arg = аккумулятор, 2-й = элемент</span>
        <span class="variable">$accumulator</span> = <span class="variable">$callback</span>(<span class="variable">$accumulator</span>, <span class="variable">$item</span>);
    }

    <span class="keyword">return</span> <span class="variable">$accumulator</span>;
}</code></pre>

                        <div class="practice-step-label">Тесты — 5 кейсов</div>
                        <pre><code><span class="comment">// 1. Сумма</span>
<span class="function">assert</span>(<span class="function">my_array_reduce</span>([<span class="number">1</span>,<span class="number">2</span>,<span class="number">3</span>,<span class="number">4</span>], <span class="keyword">fn</span>(<span class="variable">$a</span>,<span class="variable">$b</span>) => <span class="variable">$a</span>+<span class="variable">$b</span>, <span class="number">0</span>) === <span class="number">10</span>);

<span class="comment">// 2. Произведение</span>
<span class="function">assert</span>(<span class="function">my_array_reduce</span>([<span class="number">1</span>,<span class="number">2</span>,<span class="number">3</span>,<span class="number">4</span>], <span class="keyword">fn</span>(<span class="variable">$a</span>,<span class="variable">$b</span>) => <span class="variable">$a</span>*<span class="variable">$b</span>, <span class="number">1</span>) === <span class="number">24</span>);

<span class="comment">// 3. Max</span>
<span class="function">assert</span>(<span class="function">my_array_reduce</span>([<span class="number">3</span>,<span class="number">7</span>,<span class="number">2</span>,<span class="number">9</span>,<span class="number">5</span>], <span class="keyword">fn</span>(<span class="variable">$a</span>,<span class="variable">$b</span>) => <span class="variable">$a</span> > <span class="variable">$b</span> ? <span class="variable">$a</span> : <span class="variable">$b</span>, <span class="number">0</span>) === <span class="number">9</span>);

<span class="comment">// 4. Построение assoc-массива</span>
<span class="variable">$users</span> = [[<span class="string">'id'</span>=><span class="number">1</span>,<span class="string">'name'</span>=><span class="string">'A'</span>], [<span class="string">'id'</span>=><span class="number">2</span>,<span class="string">'name'</span>=><span class="string">'B'</span>]];
<span class="variable">$indexed</span> = <span class="function">my_array_reduce</span>(<span class="variable">$users</span>, <span class="keyword">function</span>(<span class="variable">$c</span>, <span class="variable">$u</span>) {
    <span class="variable">$c</span>[<span class="variable">$u</span>[<span class="string">'id'</span>]] = <span class="variable">$u</span>[<span class="string">'name'</span>];
    <span class="keyword">return</span> <span class="variable">$c</span>;
}, []);
<span class="function">assert</span>(<span class="variable">$indexed</span> === [<span class="number">1</span>=><span class="string">'A'</span>, <span class="number">2</span>=><span class="string">'B'</span>]);

<span class="comment">// 5. Пустой массив → возвращает initial</span>
<span class="function">assert</span>(<span class="function">my_array_reduce</span>([], <span class="keyword">fn</span>(<span class="variable">$a</span>,<span class="variable">$b</span>) => <span class="variable">$a</span>+<span class="variable">$b</span>, <span class="number">99</span>) === <span class="number">99</span>);</code></pre>

                        <div class="practice-pitfalls">
                            <strong>⚠ Подводные камни:</strong> убедись что callback получает аккумулятор <strong>1-м аргументом</strong>. Если перевернёшь — все assert упадут. Это и есть ответ на собесе «как PHP понимает порядок»: <em>зашито в реализации функции</em>.
                        </div>
                    </div>

                    <div class="practice-task">
                        <div class="practice-task-title">Mini Project 2: Свой <code>Collection</code> (immutable) <span class="practice-task-meta">~90 мин</span></div>
                        <p style="font-size:13.5px;color:#374151;margin:6px 0 8px"><strong>Постановка:</strong> Класс с методами <code>map / filter / reduce / first / count / toArray / toJson</code>. <code>filter</code> и <code>map</code> возвращают <strong>новую</strong> Collection (immutable).</p>

                        <div class="practice-step-label">Эталонная структура</div>
                        <pre><code><span class="keyword">final class</span> <span class="function">Collection</span> <span class="keyword">implements</span> <span class="function">Countable</span>, <span class="function">IteratorAggregate</span>
{
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">__construct</span>(<span class="keyword">private</span> <span class="keyword">readonly</span> <span class="keyword">array</span> <span class="variable">$items</span> = []) {}

    <span class="keyword">public static</span> <span class="keyword">function</span> <span class="function">of</span>(<span class="keyword">array</span> <span class="variable">$items</span>): <span class="keyword">self</span>
    {
        <span class="keyword">return</span> <span class="keyword">new</span> <span class="keyword">self</span>(<span class="variable">$items</span>);
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">map</span>(<span class="keyword">callable</span> <span class="variable">$fn</span>): <span class="keyword">self</span>
    {
        <span class="keyword">return</span> <span class="keyword">new</span> <span class="keyword">self</span>(<span class="function">array_map</span>(<span class="variable">$fn</span>, <span class="variable">$this</span>-><span class="variable">items</span>));
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">filter</span>(<span class="keyword">callable</span> <span class="variable">$fn</span>): <span class="keyword">self</span>
    {
        <span class="keyword">return</span> <span class="keyword">new</span> <span class="keyword">self</span>(<span class="function">array_values</span>(<span class="function">array_filter</span>(<span class="variable">$this</span>-><span class="variable">items</span>, <span class="variable">$fn</span>)));
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">reduce</span>(<span class="keyword">callable</span> <span class="variable">$fn</span>, <span class="keyword">mixed</span> <span class="variable">$initial</span>): <span class="keyword">mixed</span>
    {
        <span class="keyword">return</span> <span class="function">array_reduce</span>(<span class="variable">$this</span>-><span class="variable">items</span>, <span class="variable">$fn</span>, <span class="variable">$initial</span>);
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">first</span>(): <span class="keyword">mixed</span>
    {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">items</span>[<span class="function">array_key_first</span>(<span class="variable">$this</span>-><span class="variable">items</span>)] ?? <span class="keyword">null</span>;
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">count</span>(): <span class="keyword">int</span>
    {
        <span class="keyword">return</span> <span class="function">count</span>(<span class="variable">$this</span>-><span class="variable">items</span>);
    }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">toArray</span>(): <span class="keyword">array</span> { <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">items</span>; }
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">toJson</span>(): <span class="keyword">string</span> { <span class="keyword">return</span> <span class="function">json_encode</span>(<span class="variable">$this</span>-><span class="variable">items</span>); }

    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">getIterator</span>(): <span class="function">ArrayIterator</span>
    {
        <span class="keyword">return</span> <span class="keyword">new</span> <span class="function">ArrayIterator</span>(<span class="variable">$this</span>-><span class="variable">items</span>);
    }
}

<span class="comment">// Acceptance-тест</span>
<span class="variable">$result</span> = <span class="function">Collection</span>::<span class="function">of</span>([<span class="number">1</span>,<span class="number">2</span>,<span class="number">3</span>])
    -><span class="function">map</span>(<span class="keyword">fn</span>(<span class="variable">$x</span>) => <span class="variable">$x</span> * <span class="number">2</span>)
    -><span class="function">filter</span>(<span class="keyword">fn</span>(<span class="variable">$x</span>) => <span class="variable">$x</span> > <span class="number">2</span>)
    -><span class="function">toArray</span>();

<span class="function">assert</span>(<span class="variable">$result</span> === [<span class="number">4</span>, <span class="number">6</span>]);</code></pre>

                        <div class="practice-pitfalls">
                            <strong>⚠ Подводные камни:</strong> <code>readonly array</code> — иммутабельный, но если в массиве лежат объекты, они НЕ становятся readonly. Это <em>shallow immutability</em>. <code>array_filter</code> сохраняет ключи — оборачиваем в <code>array_values</code> чтобы collection всегда была sequential.
                        </div>
                    </div>

                    <div class="practice-task">
                        <div class="practice-task-title">Mini Project 3-5: краткие постановки <span class="practice-task-meta">по 1-2 часа</span></div>

                        <p style="font-size:13.5px;color:#374151;margin:6px 0"><strong>Mini Project 3: Свой Validator</strong><br>
                        <code>Validator::make($data, ['email' =&gt; 'required|email', 'age' =&gt; 'required|int|min:18'])</code> → массив ошибок или пусто. Реализуй 5 правил: <code>required, email, int, min, max</code>. <strong>Архитектура:</strong> правила = классы, реализующие <code>RuleInterface</code> с методом <code>passes($value): bool</code>. Validator парсит строку правил → создаёт массив объектов → прогоняет каждое. <strong>Тесты:</strong> 5 кейсов (ок / невалидный email / возраст &lt;18 / отсутствует поле / тип не int).</p>

                        <p style="font-size:13.5px;color:#374151;margin:6px 0"><strong>Mini Project 4: Свой DI-контейнер</strong><br>
                        Класс <code>Container</code> с <code>bind(string $abstract, callable $factory)</code>, <code>singleton(...)</code>, <code>resolve(string $abstract)</code>. Поддержи <strong>auto-resolution через рефлексию</strong>: если <code>resolve('App\Service')</code> и в конструкторе зависимость — рекурсивно резолвится. <strong>Acceptance:</strong> <code>$c-&gt;bind('Logger', fn() =&gt; new FileLogger())</code>, <code>$c-&gt;resolve('Service')</code> создаёт сервис с инжектированным Logger.</p>

                        <p style="font-size:13.5px;color:#374151;margin:6px 0"><strong>Mini Project 5: Mini-ORM (Active Record)</strong><br>
                        Abstract <code>Model</code> со static <code>find($id) / all()</code>, instance <code>save() / delete()</code>. Использует <code>__get/__set</code> для динамических атрибутов из БД (магия!). Наследник <code>User extends Model</code> определяет только <code>protected static $table = 'users'</code>. <strong>Acceptance:</strong> <code>$u = User::find(1); $u-&gt;name = 'X'; $u-&gt;save();</code> работает. <strong>Это упрощённая модель Eloquent</strong> — поймёшь Laravel «изнутри».</p>
                    </div>
                </div>

                <!-- ─────── План применения ─────── -->
                <div class="subsection">
                    <h3 class="subsection-title">🎯 План применения на 2 недели</h3>
                    <div class="remember-box">
                        <strong>Перед собесом на $2500-3000:</strong>
                        <ul style="margin:8px 0 0 20px;line-height:1.8">
                            <li><strong>Неделя 1:</strong> Все 10 микро-задач (по 2/день) + готовые задания 1-2 (Cacheable + TransactionGuard).</li>
                            <li><strong>Неделя 2:</strong> Готовые задания 3-5 (Builder + PaymentInterface + BaseRepository) + Mini Project 2 (Collection).</li>
                            <li><strong>За 3 дня до собеса:</strong> прогон 45 вопросов из «❓ Вопросник» вслух, таймер 90 сек.</li>
                            <li><strong>День перед:</strong> распечатать Шпаргалку, ещё раз пробежать ключевые таблицы.</li>
                        </ul>
                        <p style="margin:10px 0 0">Это задания напрямую отрабатывают то, что спросят. Mini Project 2 (Collection) — про неё спрашивают на собесе через Eloquent Collection: «как реализована filter?» — ты будешь знать на собственном коде.</p>
                    </div>
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

        // Toggle Q&A answers
        function toggleQA(el) {
            el.parentElement.classList.toggle('open');
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