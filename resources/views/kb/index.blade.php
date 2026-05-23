@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Backend Knowledge Hub — Sanzhar</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --bg:       #F5F8FA;
    --surface:  #FFFFFF;
    --surface2: #F9FAFB;
    --border:   #E4E6EF;
    --text:     #181C32;
    --text2:    #7E8299;
    --text3:    #A1A5B7;

    --primary:       #404357;
    --primary-light: #EFF2F5;
    --purple:        #7239EA;
    --purple-light:  #F8F5FF;
    --success:       #50CD89;
    --success-light: #E8FFF3;
    --success-dark:  #0D7D53;
    --warning:       #FFC700;
    --warning-light: #FFF8DD;
    --warning-dark:  #B45309;
    --danger:        #F1416C;
    --danger-light:  #FFF5F8;
    --teal:          #009EF7;
    --teal-light:    #EEF7FF;
    --orange:        #E65100;
    --orange-light:  #FFF3E0;

    --shadow:       0 2px 10px rgba(24,28,50,0.07);
    --shadow-hover: 0 8px 28px rgba(24,28,50,0.13);
    --radius:       12px;
  }

  * { margin:0; padding:0; box-sizing:border-box; }

  body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    font-size: 14px;
    line-height: 1.5;
    -webkit-font-smoothing: antialiased;
  }

  .hub { max-width: 1100px; margin: 0 auto; padding: 40px 24px 60px; }

  /* ── Header ─────────────────────────────────────────── */
  .header {
    text-align: center;
    padding: 52px 40px 48px;
    margin-bottom: 32px;
    background: var(--surface);
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
  }
  .header-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--primary-light);
    color: var(--primary);
    border-radius: 20px;
    padding: 5px 14px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.6px;
    text-transform: uppercase;
    margin-bottom: 18px;
  }
  .header-badge svg { width: 13px; height: 13px; }
  .header h1 {
    font-size: 2.3rem;
    font-weight: 800;
    margin-bottom: 14px;
    color: var(--text);
    letter-spacing: -0.5px;
    line-height: 1.2;
  }
  .header h1 span { color: var(--primary); }
  .header p {
    color: var(--text2);
    font-size: 0.95rem;
    line-height: 1.75;
    max-width: 560px;
    margin: 0 auto;
  }

  /* ── Stats ───────────────────────────────────────────── */
  .stats-row {
    display: flex;
    gap: 10px;
    justify-content: center;
    margin-bottom: 36px;
    flex-wrap: wrap;
  }
  .stat {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 14px 22px;
    text-align: center;
    box-shadow: var(--shadow);
    min-width: 88px;
    transition: box-shadow 0.2s;
  }
  .stat:hover { box-shadow: var(--shadow-hover); }
  .stat .n {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--primary);
    line-height: 1;
    margin-bottom: 5px;
    display: block;
  }
  .stat .l {
    color: var(--text3);
    font-size: 0.68rem;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    font-weight: 600;
  }

  /* ── Section title ───────────────────────────────────── */
  .section-title {
    font-size: 1.05rem;
    font-weight: 700;
    margin: 0 0 16px;
    color: var(--text);
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .section-title::before {
    content: '';
    width: 3px;
    height: 18px;
    background: var(--primary);
    border-radius: 2px;
    flex-shrink: 0;
  }

  /* ── Module Cards ────────────────────────────────────── */
  .grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 14px;
    margin-bottom: 40px;
  }
  .card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 22px 22px 20px;
    text-decoration: none;
    color: var(--text);
    transition: all 0.22s ease;
    position: relative;
    box-shadow: var(--shadow);
    display: block;
  }
  .card:hover {
    transform: translateY(-3px);
    border-color: var(--primary);
    box-shadow: var(--shadow-hover);
  }
  .card-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 14px;
  }
  .card-icon svg { width: 21px; height: 21px; stroke-width: 1.8; }
  .card h3 { font-size: 0.97rem; font-weight: 700; margin-bottom: 7px; color: var(--text); }
  .card p  { color: var(--text2); font-size: 0.83rem; line-height: 1.65; }
  .card .badge {
    position: absolute;
    top: 14px;
    right: 14px;
    padding: 3px 9px;
    border-radius: 6px;
    font-size: 0.67rem;
    font-weight: 700;
    letter-spacing: 0.4px;
  }

  /* icon colour variants — neutral */
  .ic-purple, .ic-blue, .ic-teal, .ic-orange, .ic-danger, .ic-warning, .ic-success {
    background: #EFF2F5;
    color: #7E8299;
  }

  /* badge colour variants — neutral */
  .badge-program, .badge-php, .badge-sql, .badge-laravel, .badge-security, .badge-arch, .badge-devops {
    background: #EFF2F5;
    color: #5E6278;
  }

  /* ── Methodology ─────────────────────────────────────── */
  .intro-text {
    color: var(--text2);
    font-size: 0.87rem;
    margin-bottom: 14px;
    line-height: 1.7;
  }

  .method {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px 22px;
    margin-bottom: 10px;
    box-shadow: var(--shadow);
    display: flex;
    gap: 16px;
    align-items: flex-start;
    transition: border-color 0.2s;
  }
  .method:hover { border-color: var(--primary); }
  .method-icon {
    width: 40px;
    height: 40px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .method-icon svg { width: 19px; height: 19px; stroke-width: 1.8; }
  .method h4 { font-size: 0.92rem; font-weight: 700; margin-bottom: 3px; color: var(--text); }
  .method .source { color: var(--primary); font-size: 0.76rem; font-weight: 600; margin-bottom: 6px; }
  .method p { color: var(--text2); font-size: 0.83rem; line-height: 1.65; }
  .method .tag {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 5px;
    font-size: 0.68rem;
    font-weight: 700;
    margin-top: 9px;
    letter-spacing: 0.3px;
  }
  .tag-research, .tag-practice { background: #EFF2F5; color: #7E8299; }

  /* ── Academic sources ────────────────────────────────── */
  .academic {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 16px 20px;
    margin-bottom: 10px;
    display: flex;
    gap: 14px;
    align-items: flex-start;
    box-shadow: var(--shadow);
    transition: border-color 0.2s;
  }
  .academic:hover { border-color: var(--primary); }
  .acad-icon {
    width: 38px;
    height: 38px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .acad-icon svg { width: 18px; height: 18px; stroke-width: 1.8; }
  .academic h4 { font-size: 0.9rem; font-weight: 700; margin-bottom: 3px; color: var(--text); }
  .academic .inst { color: var(--text2); font-size: 0.76rem; font-weight: 600; margin-bottom: 4px; }
  .academic p { color: var(--text2); font-size: 0.81rem; line-height: 1.55; }
  .academic a {
    color: var(--primary);
    font-size: 0.79rem;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    margin-top: 4px;
  }
  .academic a:hover { text-decoration: underline; }
  .academic a svg { width: 11px; height: 11px; }

  /* ── Footer ──────────────────────────────────────────── */
  .footer {
    text-align: center;
    margin-top: 50px;
    padding: 20px;
    color: var(--text3);
    font-size: 0.76rem;
    border-top: 1px solid var(--border);
    line-height: 1.8;
  }

  @media (max-width: 768px) {
    .grid { grid-template-columns: 1fr; }
    .header { padding: 36px 20px 32px; }
    .header h1 { font-size: 1.65rem; }
    .hub { padding: 20px 16px 40px; }
    .stats-row { gap: 8px; }
    .stat { padding: 12px 16px; }
  }
</style>
</head>
<body>
<div class="hub">

  <!-- ── Header ── -->
  <div class="header">
    <div class="header-badge">
      <i data-lucide="zap"></i>
      Backend Knowledge Hub
    </div>
    <h1>PHP / Laravel / <span>Backend</span></h1>
    <p>Полная база знаний построена на методологиях Laracasts, Harvard CS50, Bloom's Taxonomy и Spaced Repetition. Академические источники: MIT OCW, Stanford, OWASP, RFC.</p>
  </div>

  <!-- ── Stats ── -->
  <div class="stats-row">
    <div class="stat"><span class="n">7</span><span class="l">Модулей</span></div>
    <div class="stat"><span class="n">117</span><span class="l">Тем</span></div>
    <div class="stat"><span class="n">90+</span><span class="l">Примеров кода</span></div>
    <div class="stat"><span class="n">50+</span><span class="l">Квизов</span></div>
    <div class="stat"><span class="n">24</span><span class="l">Interview Q&A</span></div>
    <div class="stat"><span class="n">19</span><span class="l">Курсов</span></div>
  </div>

  @endverbatim
  @php
      $modulePages   = ($pagesByGroup['Modules'] ?? collect());
      $advancedPages = ($pagesByGroup['Advanced'] ?? collect());
  @endphp

  {{-- ── Modules ── --}}
  @if($modulePages->isNotEmpty())
    <div class="section-title">База Знаний — Модули</div>
    <div class="grid">
      @foreach($modulePages as $page)
        <a class="card" href="{{ url('/' . $page->slug) }}">
          <div class="badge {{ $page->badge_class ?? 'badge-program' }}">{{ $page->badge }}</div>
          <div class="card-icon {{ $page->icon_class ?? 'ic-purple' }}"><i data-lucide="{{ $page->icon }}"></i></div>
          <h3>{!! $page->title !!}</h3>
          <p>{{ $page->description }}</p>
        </a>
      @endforeach
    </div>
  @endif

  {{-- ── Advanced ── --}}
  @if($advancedPages->isNotEmpty())
    <div class="section-title" style="margin-top:40px;">Advanced (middle/senior)</div>
    <div class="grid">
      @foreach($advancedPages as $page)
        <a class="card" href="{{ url('/' . $page->slug) }}">
          <div class="badge {{ $page->badge_class ?? 'badge-program' }}">{{ $page->badge }}</div>
          <div class="card-icon {{ $page->icon_class ?? 'ic-purple' }}"><i data-lucide="{{ $page->icon }}"></i></div>
          <h3>{!! $page->title !!}</h3>
          <p>{{ $page->description }}</p>
        </a>
      @endforeach
    </div>
  @endif
  @verbatim

  <!-- ── Methodology ── -->
  <div class="section-title">Методология обучения</div>
  <p class="intro-text">Каждый модуль построен на доказательных методиках обучения программированию — тех же, что используют лучшие курсы мира:</p>

  <div class="method">
    <div class="method-icon ic-purple"><i data-lucide="brain"></i></div>
    <div>
      <h4>1. Bloom's Taxonomy (Таксономия Блума)</h4>
      <div class="source">Grand Canyon University · Фундамент педагогики CS</div>
      <p>Каждая тема структурирована по уровням: <strong>Помню</strong> (определения) → <strong>Понимаю</strong> (объяснения своими словами) → <strong>Применяю</strong> (код) → <strong>Анализирую</strong> (сравнение подходов) → <strong>Создаю</strong> (свой проект). Это та же модель что используют MIT и Stanford в CS-курсах.</p>
      <span class="tag tag-research">Академический стандарт</span>
    </div>
  </div>

  <div class="method">
    <div class="method-icon ic-teal"><i data-lucide="eye"></i></div>
    <div>
      <h4>2. Active Recall (Активное вспоминание)</h4>
      <div class="source">Исследование: забывается 13% vs 50% при пассивном чтении</div>
      <p>В каждом разделе — блоки "Проверь себя" с скрытыми ответами. Сначала пробуешь ответить сам, потом проверяешь. Это в 3-4 раза эффективнее чем перечитывание конспектов. Используется в Codecademy и freeCodeCamp.</p>
      <span class="tag tag-research">Доказано исследованиями</span>
    </div>
  </div>

  <div class="method">
    <div class="method-icon ic-blue"><i data-lucide="repeat-2"></i></div>
    <div>
      <h4>3. Spaced Repetition (Интервальное повторение)</h4>
      <div class="source">Derek Sivers: 87% запоминания vs 50% при зубрёжке · 5-10 мин/день</div>
      <p>16-недельное расписание (в модуле Roadmap) спроектировано с нарастающими интервалами повторения: тема возвращается через 1, 3, 7, 14 дней. Тот же принцип что в Anki и SuperMemo. Создай Anki-карточки из блоков "Запомни".</p>
      <span class="tag tag-practice">Laracasts + Anki</span>
    </div>
  </div>

  <div class="method">
    <div class="method-icon ic-warning"><i data-lucide="hammer"></i></div>
    <div>
      <h4>4. Project-Based Learning (Обучение через проекты)</h4>
      <div class="source">Frontiers in Education, 2025 · Laracasts · freeCodeCamp</div>
      <p>Каждый раздел заканчивается практическим заданием ("Задание"). Строишь реальные фичи: платёжная система, API аутентификация, Docker-деплой. Исследования показывают рост мотивации и переноса знаний на реальные проекты.</p>
      <span class="tag tag-practice">Доказанная эффективность</span>
    </div>
  </div>

  <div class="method">
    <div class="method-icon ic-orange"><i data-lucide="play-circle"></i></div>
    <div>
      <h4>5. Laracasts-метод: Bite-Sized Modules</h4>
      <div class="source">Jeffrey Way · 200+ курсов · лучший преподаватель Laravel</div>
      <p>Разделы короткие и фокусированные (один паттерн = один модуль). Не стены текста, а концентрированные блоки: определение → код → ключевой факт → квиз. Так мозг усваивает информацию порциями без перегрузки.</p>
      <span class="tag tag-practice">Методика Laracasts</span>
    </div>
  </div>

  <div class="method">
    <div class="method-icon ic-success"><i data-lucide="git-compare"></i></div>
    <div>
      <h4>6. BAD/GOOD Code Comparison</h4>
      <div class="source">Clean Code · Robert C. Martin</div>
      <p>В модуле Архитектура каждый паттерн показан через антипаттерн (плохой код) → паттерн (хороший код). Контрастное обучение помогает понять ЗАЧЕМ нужен паттерн, а не просто КАК его написать.</p>
      <span class="tag tag-practice">Clean Code методика</span>
    </div>
  </div>

  <!-- ── Academic sources ── -->
  <div class="section-title">Академические и аккредитованные источники</div>
  <p class="intro-text">Материалы базы знаний основаны на этих авторитетных источниках:</p>

  <div class="academic">
    <div class="acad-icon ic-blue"><i data-lucide="graduation-cap"></i></div>
    <div>
      <h4>Harvard CS50's Web Programming</h4>
      <div class="inst">Harvard University · edX</div>
      <p>Python, JavaScript, SQL, Django, React, безопасность, масштабируемость. Один из лучших бесплатных CS-курсов в мире.</p>
      <a href="https://cs50.harvard.edu/web/" target="_blank">cs50.harvard.edu/web <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-blue"><i data-lucide="graduation-cap"></i></div>
    <div>
      <h4>MIT OpenCourseWare — Software Engineering for Web Applications</h4>
      <div class="inst">Massachusetts Institute of Technology</div>
      <p>Архитектура надёжных интернет-приложений. Бесплатные лекции и материалы от MIT.</p>
      <a href="https://ocw.mit.edu/" target="_blank">ocw.mit.edu <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-blue"><i data-lucide="graduation-cap"></i></div>
    <div>
      <h4>Stanford — Databases (Prof. Jennifer Widom)</h4>
      <div class="inst">Stanford University</div>
      <p>5 самостоятельных курсов: Relational DB, SQL, Advanced SQL, Modeling &amp; Theory. Академический стандарт баз данных.</p>
      <a href="https://online.stanford.edu/courses/soe-ydatabases" target="_blank">online.stanford.edu <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-purple"><i data-lucide="book-open"></i></div>
    <div>
      <h4>Database System Concepts (7th ed.)</h4>
      <div class="inst">Silberschatz, Korth, Sudarshan · Academic Textbook</div>
      <p>Стандартный университетский учебник по базам данных. SQL, транзакции, нормализация, распределённые БД.</p>
      <a href="https://www.db-book.com/" target="_blank">db-book.com <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-purple"><i data-lucide="book-open"></i></div>
    <div>
      <h4>Design Patterns — Gang of Four</h4>
      <div class="inst">Gamma, Helm, Johnson, Vlissides · 500K+ copies</div>
      <p>23 фундаментальных паттерна проектирования (Creational, Structural, Behavioral). Основа модуля Архитектура.</p>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-purple"><i data-lucide="book-open"></i></div>
    <div>
      <h4>Clean Code &amp; Clean Architecture</h4>
      <div class="inst">Robert C. Martin ("Uncle Bob")</div>
      <p>Индустриальный стандарт качества кода и архитектуры. SOLID принципы, слоистая архитектура, Dependency Rule.</p>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-danger"><i data-lucide="shield"></i></div>
    <div>
      <h4>OWASP Cheat Sheets</h4>
      <div class="inst">Open Web Application Security Project · Некоммерческая организация</div>
      <p>Авторитетный источник по веб-безопасности. CSRF, XSS, SQL Injection, Authentication — всё для модуля Security.</p>
      <a href="https://cheatsheetseries.owasp.org/" target="_blank">cheatsheetseries.owasp.org <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-teal"><i data-lucide="scroll-text"></i></div>
    <div>
      <h4>RFC Documents (IETF)</h4>
      <div class="inst">Internet Engineering Task Force · Стандарты интернета</div>
      <p>RFC 6749 (OAuth 2.0), RFC 7519 (JWT), RFC 7636 (PKCE) — первоисточники протоколов безопасности.</p>
      <a href="https://datatracker.ietf.org/" target="_blank">datatracker.ietf.org <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-warning"><i data-lucide="award"></i></div>
    <div>
      <h4>Zend Certified PHP Engineer</h4>
      <div class="inst">Zend Technologies · Pearson VUE</div>
      <p>Индустриальная сертификация PHP (через 8.4). Создана core-контрибьюторами PHP. 4000+ центров тестирования.</p>
      <a href="https://www.zend.com/training/php-certification-exam" target="_blank">zend.com <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-success"><i data-lucide="building-2"></i></div>
    <div>
      <h4>ИТМО — Backend Developer</h4>
      <div class="inst">Санкт-Петербургский государственный университет информационных технологий</div>
      <p>Профессиональная переподготовка: PHP, MySQL, веб-технологии. Аккредитованный российский вуз.</p>
      <a href="https://profi.ifmo.ru/backend-developer/" target="_blank">profi.ifmo.ru <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-success"><i data-lucide="building-2"></i></div>
    <div>
      <h4>МФТИ — IT Product Development (Online Master's)</h4>
      <div class="inst">Московский физико-технический институт</div>
      <p>Магистратура онлайн: 50% практики, разработка реальных приложений. Один из топ вузов России по CS.</p>
      <a href="https://mipt.online/masters/development" target="_blank">mipt.online <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <!-- ── Footer ── -->
  <div class="footer">
    Built with proven pedagogical methods · Last updated: April 2026<br>
    Sources: Harvard, MIT, Stanford, OWASP, IETF RFC, Laracasts, Frontiers in Education
  </div>

</div>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>lucide.createIcons();</script>
</body>
</html>

@endverbatim