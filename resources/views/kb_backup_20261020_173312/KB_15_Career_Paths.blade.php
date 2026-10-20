@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Карьерные пути: PHP, Python, AI/LLM</title>
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
  <div class="sidebar-title">Career Paths</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">Языки и стек</div>
  <a class="nav-item" onclick="showSection('languages',this)"><i data-lucide="git-compare"></i> Python vs PHP</a>
  <a class="nav-item" onclick="showSection('performance',this)"><i data-lucide="gauge"></i> Производительность</a>

  <div class="nav-group-label">Рынок и AI</div>
  <a class="nav-item" onclick="showSection('ai-future',this)"><i data-lucide="brain-circuit"></i> AI и роль разработчика</a>
  <a class="nav-item" onclick="showSection('market',this)"><i data-lucide="trending-up"></i> Рынок труда 2024-2025</a>
  <a class="nav-item" onclick="showSection('safe-zones',this)"><i data-lucide="shield"></i> Безопасные специализации</a>

  <div class="nav-group-label">LLM Engineering</div>
  <a class="nav-item" onclick="showSection('llm-engineering',this)"><i data-lucide="cpu"></i> Что такое LLM Eng</a>
  <a class="nav-item" onclick="showSection('roadmap',this)"><i data-lucide="map"></i> Roadmap (4 фазы)</a>
  <a class="nav-item" onclick="showSection('python-stack',this)"><i data-lucide="package"></i> Python-стек для AI</a>

  <div class="nav-group-label">Практика</div>
  <a class="nav-item" onclick="showSection('hybrid',this)"><i data-lucide="git-merge"></i> Гибридный подход PHP+AI</a>
  <a class="nav-item" onclick="showSection('specializations',this)"><i data-lucide="briefcase"></i> Senior/Staff/Architect</a>
  <a class="nav-item" onclick="showSection('resources',this)"><i data-lucide="book-open"></i> Ресурсы</a>

  <div class="nav-group-label">Сводно</div>
  <a class="nav-item" onclick="showSection('pitfalls',this)"><i data-lucide="alert-octagon"></i> Заблуждения</a>
  <a class="nav-item" onclick="showSection('interview',this)"><i data-lucide="message-square"></i> Карьерные вопросы</a>
</div>

<div class="main">
<div class="page-header">
  <h1>Карьерные пути: PHP, Python, AI/LLM</h1>
  <p>Сравнение Python и PHP без религии, реалистичная картина рынка труда 2024-2025, влияние AI на роль разработчика, какие специализации защищены от автоматизации, roadmap для перехода в LLM Engineering, как комбинировать backend-навыки с AI.</p>
  <div class="badge-row">
    <span class="badge">Python</span>
    <span class="badge">PHP</span>
    <span class="badge">AI / LLM</span>
    <span class="badge">Career</span>
    <span class="badge badge-success">Все уровни</span>
  </div>
</div>

<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>
  <p class="text">Раздел отличается от остальных в KB &mdash; он не про конкретный технический навык, а про <strong>выбор направления</strong>. Backend-разработчик в 2025 году находится в точке развилки: рынок изменился под давлением AI, спрос на junior сократился, появилась новая роль (LLM Engineer / AI Engineer), которая платит на 30-50% больше типичного backend-сеньора. Этот раздел собирает данные и рассуждения, чтобы сделать осознанный выбор: оставаться в чистом backend, расти в архитекторы/staff, или пересесть на AI-направление.</p>

  <div class="info-box primary">
    <strong>Источники данных в разделе:</strong>
    <ul class="bullets" style="margin-top:6px;margin-bottom:0;color:#404357;">
      <li>Stack Overflow Developer Survey 2024;</li>
      <li>JetBrains The State of Developer Ecosystem 2024;</li>
      <li>Stripe Atlas «Hire Senior Engineers» отчёт 2024;</li>
      <li>Morgan Stanley AI &amp; Software Engineering исследование;</li>
      <li>HackerRank Developer Skills Report;</li>
      <li>W3Techs Statistics (распространённость языков в вебе);</li>
      <li>Hugging Face Open LLM Leaderboard для актуальной картины моделей.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map"></i> Структура раздела</div>
    <table class="data-table">
      <tr><th>Блок</th><th>Что разбирается</th></tr>
      <tr><td><strong>Языки и стек</strong></td><td>Python vs PHP по фактам, производительность сейчас</td></tr>
      <tr><td><strong>Рынок и AI</strong></td><td>Что меняет AI, состояние найма, защищённые специализации</td></tr>
      <tr><td><strong>LLM Engineering</strong></td><td>Что входит в роль, roadmap входа, Python-стек</td></tr>
      <tr><td><strong>Практика</strong></td><td>Гибридный подход (PHP + Python для AI), рост в senior/staff</td></tr>
      <tr><td><strong>Сводно</strong></td><td>Заблуждения, вопросы на собеседовании по карьере</td></tr>
    </table>
  </div>
</div>

<div id="sec-languages" class="section">
  <div class="section-title">Python vs PHP — что под капотом</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Вопрос «Python или PHP» неправильный по форме &mdash; оба языка живы, развиваются, занимают разные ниши. Правильнее: «какой язык подходит для моей задачи и направления». Сравнение ниже &mdash; по фактическим характеристикам, без религиозных аргументов.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Сравнение по фактам</div>
    <table class="data-table">
      <tr><th>Параметр</th><th>PHP</th><th>Python</th></tr>
      <tr><td><strong>Парадигма</strong></td><td>Веб-ориентированный, ООП с traits, динамическая типизация + опциональная статика (PHP 8+)</td><td>Универсальный, ООП + функциональный, динамическая + type hints</td></tr>
      <tr><td><strong>Синтаксис</strong></td><td>C-подобный с <code>$</code> для переменных, точка с запятой, фигурные скобки</td><td>Чистый, отступы вместо скобок, без <code>$</code></td></tr>
      <tr><td><strong>Ключевая ниша</strong></td><td>Веб-разработка: CMS (WordPress, Drupal), e-commerce, корпоративные порталы, SaaS-бэкенды</td><td>Data Science, ML/AI, автоматизация, научные вычисления, веб (вторично)</td></tr>
      <tr><td><strong>Веб-фреймворки</strong></td><td>Laravel, Symfony, Yii, CakePHP</td><td>Django, Flask, FastAPI</td></tr>
      <tr><td><strong>ML-фреймворки</strong></td><td>Нет (PHP-ML &mdash; маргинален)</td><td>PyTorch, TensorFlow, scikit-learn, JAX</td></tr>
      <tr><td><strong>Доминирование в нише</strong></td><td>70%+ публичных сайтов (W3Techs)</td><td>Доминирует в AI/ML, Data Science, скриптинге</td></tr>
      <tr><td><strong>Перформанс (web)</strong></td><td>PHP 8+ с JIT: близко к Python 3.12</td><td>Сравним с PHP 8 в веб-задачах</td></tr>
      <tr><td><strong>Перформанс (CPU-bound)</strong></td><td>Хорош только для веб-цикла запросов</td><td>Не лучший для CPU-bound; для AI &mdash; через C-extensions (numpy, torch)</td></tr>
      <tr><td><strong>Сообщество</strong></td><td>Зрелое, веб-сфокусированное (Laracon, PHP Internals)</td><td>Огромное, многоотраслевое (PyCon, NeurIPS)</td></tr>
      <tr><td><strong>Кривая обучения</strong></td><td>Лёгкое начало, особенно для веба</td><td>Лёгкое начало, особенно для скриптов и анализа данных</td></tr>
      <tr><td><strong>Зарплаты (мидл, 2024)</strong></td><td>В среднем чуть ниже Python в US/EU</td><td>Чуть выше PHP; в AI-нише &mdash; значительно выше</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Когда выбирать PHP</div>
    <ul class="bullets">
      <li>Проект &mdash; веб-сайт, e-commerce, корпоративный портал, SaaS-бэкенд;</li>
      <li>Нужно быстро запустить с минимумом инфраструктуры;</li>
      <li>Хостинг должен быть дешёвым (shared hosting, классические VPS);</li>
      <li>Команда уже работает с Laravel/Symfony &mdash; миграция стоит дороже выгоды;</li>
      <li>Интеграция с CMS (WordPress, Drupal) или большой PHP-экосистемой пакетов.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Когда выбирать Python</div>
    <ul class="bullets">
      <li>Проект включает ML/AI: рекомендательные системы, чат-боты, анализ данных;</li>
      <li>Нужна сложная автоматизация: скрейпинг, ETL, бизнес-аналитика;</li>
      <li>Backend для data-heavy продукта (BI-системы, аналитика);</li>
      <li>Микросервис в гетерогенной архитектуре, где другие сервисы уже на Python;</li>
      <li>Долгосрочная стратегия включает движение в AI/Data направление.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. «Python быстрее PHP».</strong> Зависит от задачи. На веб-цикле запросов современные версии сопоставимы. На CPU-bound &mdash; оба медленнее Go/Rust/Java.</div>
    <div class="pitfall"><strong>2. «PHP только для WordPress».</strong> Устаревший стереотип. Laravel, Symfony, Slim, FrankenPHP сделали PHP полноценным backend-стеком уровня Node.js/Python.</div>
    <div class="pitfall"><strong>3. «Python подходит для всего».</strong> Для high-throughput сетевых сервисов часто проигрывает Go. Для real-time mobile backend &mdash; Node.js удобнее. Универсальность не равно оптимальность.</div>
    <div class="pitfall"><strong>4. Выбор языка ≠ выбор карьеры.</strong> Через 5-10 лет вы будете писать архитектуру, ревью, бизнес-логику. Синтаксис языка &mdash; меньше 20% работы.</div>
    <div class="pitfall"><strong>5. «Python проще PHP для junior».</strong> Преувеличение. Оба элементарны на уровне «Hello World». Сложность начинается на уровне ООП, конкурентности, асинхронности &mdash; и здесь Python с GIL/asyncio не проще PHP.</div>
    <div class="pitfall"><strong>6. Двойной стек без причины.</strong> Учить и PHP, и Python одновременно для джуниора &mdash; растрата времени. Сфокусируйтесь на одном до уверенного middle, потом расширяйте.</div>
    <div class="pitfall"><strong>7. Игнорирование TypeScript/Node.js.</strong> Если выбираете между Python и PHP, посмотрите и на Node.js &mdash; полный stack на TypeScript часто проще для team-разработки.</div>
    <div class="pitfall"><strong>8. Зарплата как единственный критерий.</strong> AI/ML действительно платит больше, но порог входа выше (PhD-уровень математики). Senior PHP в крупной компании может зарабатывать как junior ML-инженер с большим стрессом.</div>
  </div>
</div>

<div id="sec-performance" class="section">
  <div class="section-title">Производительность и масштабируемость</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">«Какой язык быстрее» &mdash; популярный вопрос с устаревшим ответом. PHP 8.x с JIT-компиляцией и OPcache работает в 2-3 раза быстрее, чем PHP 5.6. Python 3.12+ улучшил производительность интерпретатора на ~25%. Современные оба &mdash; быстрее, чем большинство задач требуют. Реальная проблема масштабирования сейчас в архитектуре, не в языке.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Что определяет производительность веб-приложения</div>
    <div class="card">
      <h3>1. База данных и I/O (90% бутылочных горлышек)</h3>
      <p class="text">N+1 запросы, отсутствие индексов, синхронные обращения к внешним API. Решается архитектурой (кеш, очереди), не выбором языка. См. KB_2 (SQL) и KB_3 (Laravel queues).</p>
    </div>
    <div class="card">
      <h3>2. Архитектурный выбор</h3>
      <p class="text">Монолит vs микросервисы, синхронные vs асинхронные обработчики, классический PHP-FPM vs Octane/RoadRunner. Тот же PHP-код в Octane работает в 5-10 раз быстрее, чем в FPM.</p>
    </div>
    <div class="card">
      <h3>3. Инфраструктура</h3>
      <p class="text">CDN, кеширование на edge, read replicas, connection pooling. На пиковых нагрузках инфраструктура важнее языка.</p>
    </div>
    <div class="card">
      <h3>4. Сам язык (10-20% разницы)</h3>
      <p class="text">PHP 8 vs Python 3.12 на типичных веб-задачах &mdash; разница в пределах одного диапазона. Эффект Go/Rust &mdash; в 2-5 раз быстрее, но цена &mdash; сложнее разработка.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="bar-chart-3"></i> Когда язык становится узким местом</div>
    <ul class="bullets">
      <li><strong>Real-time</strong>: миллионы WebSocket-соединений, низкая задержка &mdash; уход на Go, Erlang, Rust;</li>
      <li><strong>Системное программирование</strong>: драйверы, embedded, kernel &mdash; C, C++, Rust;</li>
      <li><strong>Численные вычисления</strong>: симуляции, обработка изображений в реальном времени &mdash; C++, Julia, или Python с C-extensions;</li>
      <li><strong>Игровые движки</strong>: AAA-разработка &mdash; C++, Rust, C#;</li>
      <li><strong>Mobile UI</strong>: нативные iOS/Android &mdash; Swift, Kotlin.</li>
    </ul>
    <p class="text">Для 95% веб-задач (CRUD, SaaS, e-commerce, API) PHP/Python/Node.js сопоставимы по производительности и достаточны. Различия проявляются на верхних 5% нагрузки, и решаются обычно архитектурно, а не сменой языка.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. «Перейдём на Go и всё будет быстро».</strong> Если в коде N+1 запросы и кеша нет &mdash; смена языка добавит 20% к скорости, но не решит проблему. Сначала &mdash; профайлинг.</div>
    <div class="pitfall"><strong>2. Бенчмарки на «Hello World».</strong> Замер скорости пустого фреймворка не отражает реальную работу. Тестируйте на собственных endpoint'ах с реальными данными.</div>
    <div class="pitfall"><strong>3. JIT в PHP 8 не работает без OPcache.</strong> JIT включается через <code>opcache.jit_buffer_size</code> &mdash; на дефолтных настройках выгода теряется.</div>
    <div class="pitfall"><strong>4. Python GIL и многопоточность.</strong> Один интерпретатор не использует несколько ядер для CPU-задач. Решение &mdash; multiprocessing или async (для I/O). PHP в этом плане проще: каждый процесс &mdash; своё ядро.</div>
    <div class="pitfall"><strong>5. Octane/Swoole утечки памяти.</strong> Long-running PHP-процесс копит память. Регулярный рестарт воркеров обязателен.</div>
    <div class="pitfall"><strong>6. Игнорирование cold-start в serverless.</strong> PHP/Python на Lambda &mdash; cold-start от 300мс до 2с. Go/Rust &mdash; десятки мс. Если критично &mdash; учитывайте.</div>
    <div class="pitfall"><strong>7. Прямое сравнение «PHP vs Python» без указания версии.</strong> PHP 5 и PHP 8 &mdash; кратная разница. Python 3.8 и 3.12 &mdash; +25%. Всегда уточняйте версии.</div>
    <div class="pitfall"><strong>8. Микросервисы для маленького проекта.</strong> Накладные расходы (сеть, сериализация, distributed tracing) часто съедают выигрыш. Монолит на 5-10к запросов в секунду на одном сервере &mdash; нормально для среднего бизнеса.</div>
  </div>
</div>

<div id="sec-ai-future" class="section">
  <div class="section-title">AI и переопределение роли разработчика</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Страх «ИИ заменит программистов» популярен с 2022 года (выход ChatGPT) и усилился к 2024 (Copilot Workspace, Devin, Cursor). Реальность сложнее. По исследованиям Morgan Stanley, GitHub State of Octoverse и Stack Overflow Survey: AI не сокращает спрос на инженеров &mdash; он <strong>перераспределяет</strong> где этот спрос. Junior-позиции сократились, senior &mdash; стабильны или растут, новая роль (LLM Engineer) формирует отдельный рынок.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Что AI реально автоматизирует</div>
    <div class="card">
      <h3>Шаблонный код</h3>
      <p class="text">CRUD-эндпоинты, валидация, типовые миграции, базовые тесты. AI пишет это за минуты, что раньше занимало часы. Это уровень «junior-задач».</p>
    </div>
    <div class="card">
      <h3>Документация и комментарии</h3>
      <p class="text">Генерация docstring, README, объяснение существующего кода. Качество &mdash; от приемлемого до хорошего.</p>
    </div>
    <div class="card">
      <h3>Boilerplate-рефакторинг</h3>
      <p class="text">Переименование, извлечение методов, добавление type hints. Cursor/Copilot делают это уверенно.</p>
    </div>
    <div class="card">
      <h3>Поиск примеров и debugging hints</h3>
      <p class="text">Раньше &mdash; Stack Overflow + Google. Теперь &mdash; диалог с AI быстрее и точнее. Время на поиск решения сократилось в разы.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="x-circle"></i> Что AI пока не делает (или делает плохо)</div>
    <div class="card">
      <h3>Архитектурные решения</h3>
      <p class="text">Выбор между микросервисами и монолитом, дизайн системы под бизнес-требования, баланс trade-offs &mdash; требует контекста, который AI не имеет.</p>
    </div>
    <div class="card">
      <h3>Дебаг сложных проблем</h3>
      <p class="text">Race conditions, memory leaks под нагрузкой, эфемерные баги в распределённых системах. AI помогает гипотезами, не финальным ответом.</p>
    </div>
    <div class="card">
      <h3>Понимание бизнес-контекста</h3>
      <p class="text">«Почему этот сервис не может упасть в пятницу вечером», «как наши пользователи реально используют этот feature» &mdash; знание команды, которое AI не получит.</p>
    </div>
    <div class="card">
      <h3>Ревью и менторство</h3>
      <p class="text">Code review с фокусом на долгосрочную поддерживаемость, обучение junior, разрешение технических споров в команде &mdash; человеческая работа.</p>
    </div>
    <div class="card">
      <h3>Production-инциденты</h3>
      <p class="text">Прод упал в 3 утра, нужно за 30 минут диагностировать и починить, не сломав другое. AI может предлагать гипотезы; решение и принятие риска &mdash; человек.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="trending-up"></i> Прогноз численности (Morgan Stanley, GitHub)</div>
    <ul class="bullets">
      <li>2024: ~30 миллионов профессиональных разработчиков в мире;</li>
      <li>2029: прогноз ~50 миллионов;</li>
      <li>AI не <em>сокращает</em> рынок &mdash; он меняет состав ролей и навыков;</li>
      <li>Спрос на «AI-leveraged» инженеров (умеющих эффективно использовать AI) опережает спрос на чистых coder'ов.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. «Я никогда не буду пользоваться AI».</strong> Конкурент пользуется и делает за 2 часа то, что у вас занимает день. Это вопрос производительности, не идеологии.</div>
    <div class="pitfall"><strong>2. «AI пишет за меня, мне не нужно думать».</strong> AI-код требует проверки. Слепое доверие &mdash; источник production-багов, которые потом разбирать дольше, чем написать вручную.</div>
    <div class="pitfall"><strong>3. Слепое копирование суждений из соцсетей.</strong> «AI уже на уровне senior» &mdash; маркетинговый шум. Объективная картина &mdash; в research-отчётах, не в твитах.</div>
    <div class="pitfall"><strong>4. Игнорирование изменения роли junior.</strong> Если вы junior &mdash; путь «писать боилерплейт под надзором» исчез. Нужно сразу учиться архитектуре, ревью, дебагу.</div>
    <div class="pitfall"><strong>5. Переход в AI «на хайпе».</strong> Большинство «AI-инженеров» в LinkedIn делают prompt engineering, не fine-tuning. Это другая ниша, с меньшим барьером, но и с другой зарплатой.</div>
    <div class="pitfall"><strong>6. Недооценка инфраструктурной работы.</strong> DevOps, SRE, платформенная инженерия &mdash; роли с растущим спросом. AI пишет код, кто-то должен его деплоить и эксплуатировать.</div>
    <div class="pitfall"><strong>7. Сфокусированность только на LLM.</strong> ML включает классические задачи (recommender, fraud detection, anomaly detection) &mdash; не менее востребованные, чем LLM.</div>
    <div class="pitfall"><strong>8. Откладывание изучения AI «до завтра».</strong> Скорость развития поля &mdash; полгода = устаревшие знания. Учиться нужно непрерывно, не разовым курсом.</div>
  </div>
</div>

<div id="sec-market" class="section">
  <div class="section-title">Рынок труда: что происходит в 2024-2025</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Картина рынка сейчас неоднородная: в одних сегментах массовые увольнения, в других &mdash; острая нехватка. Понимание этого расклада &mdash; основа для решения «куда двигаться». Данные ниже агрегированы из Stack Overflow Survey 2024, levels.fyi, LinkedIn Workforce Report, HackerRank Skills Report.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="trending-down"></i> Что сократилось</div>
    <div class="card">
      <h3>Найм junior'ов (entry-level)</h3>
      <p class="text">Сократился на 30-50% в крупных компаниях по сравнению с 2021. Причина &mdash; AI закрывает простые задачи; обучать стажёра дороже, чем заплатить за Copilot. Junior без opensource-проектов, pet-projects, real опыта &mdash; в сложном положении.</p>
    </div>
    <div class="card">
      <h3>Чистые «coder»-роли</h3>
      <p class="text">Должности «писать код по тикетам без архитектурных решений» сжимаются. Спрос сместился к ролям с большей долей дизайна, ревью, дебага.</p>
    </div>
    <div class="card">
      <h3>Базовая мобильная разработка</h3>
      <p class="text">Junior iOS/Android &mdash; падающая категория. Кросс-платформа (React Native, Flutter) частично перебирает рынок; AI закрывает шаблонные экраны.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="trending-up"></i> Что растёт</div>
    <div class="card">
      <h3>ML / AI инженеры</h3>
      <p class="text">Самая горячая ниша. Spread зарплат от $150k до $500k+ в US (senior, FAANG-аналоги). В России/EU $80k-200k. Дефицит на 2-3 года вперёд.</p>
    </div>
    <div class="card">
      <h3>LLM Engineer / AI Engineer</h3>
      <p class="text">Новая роль (2023-2024): не PhD-исследователь, а инженер, применяющий готовые LLM (fine-tuning, RAG, agentic workflows). Барьер входа ниже, чем у классического ML, но рынок переполняется быстро.</p>
    </div>
    <div class="card">
      <h3>Senior backend / staff engineers</h3>
      <p class="text">Спрос стабильный. Архитектурный опыт, оптимизация под нагрузку, миграции legacy &mdash; не автоматизируется.</p>
    </div>
    <div class="card">
      <h3>DevOps / SRE / Platform Engineering</h3>
      <p class="text">Растёт быстро. AI пишет код &mdash; кто-то должен его деплоить, мониторить, держать SLO. Зарплаты сравнимы с backend-сеньорами, часто выше.</p>
    </div>
    <div class="card">
      <h3>Data Engineering</h3>
      <p class="text">Данные для AI &mdash; новая нефть. Инженеры, строящие пайплайны (Airflow, dbt, Snowflake) &mdash; в дефиците.</p>
    </div>
    <div class="card">
      <h3>Security Engineering</h3>
      <p class="text">Регуляторное давление (GDPR, SOC2), увеличение поверхности атак &mdash; стабильный рост.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map-pin"></i> Региональные различия</div>
    <table class="data-table">
      <tr><th>Регион</th><th>Тренд</th></tr>
      <tr><td><strong>США (FAANG-уровень)</strong></td><td>Massive layoffs 2022-2023, восстановление к 2024 в AI/Infrastructure</td></tr>
      <tr><td><strong>США (стартапы)</strong></td><td>Найм оживился к 2024 после охлаждения; фокус на AI-стартапах</td></tr>
      <tr><td><strong>EU</strong></td><td>Стабильнее, чем US; меньше layoffs, меньше рост</td></tr>
      <tr><td><strong>Восточная Европа</strong></td><td>Снижение спроса от западных компаний (геополитика, релокации), рост локальных и азиатских заказчиков</td></tr>
      <tr><td><strong>Казахстан / СНГ</strong></td><td>Местные компании активно нанимают; зарплаты растут на 20-30% год к году в Алматы/Астане</td></tr>
      <tr><td><strong>Азия (Сингапур, Дубай)</strong></td><td>Hub-регионы для AI-стартапов; высокие зарплаты, низкие налоги</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Зависимость от FAANG-зарплат.</strong> Цифры в LinkedIn-постах ($300k+) &mdash; верх 1%, не норма. Медиана сильно ниже.</div>
    <div class="pitfall"><strong>2. Игнорирование локального рынка.</strong> Удалёнка в западные компании затрудняется. Локальный рынок (тех же СНГ) часто стабильнее.</div>
    <div class="pitfall"><strong>3. «AI-роли проще».</strong> Зарплаты выше, но порог входа &mdash; математика, ML-фундамент, инфраструктура GPU. Полный путь от backend до AI Engineer &mdash; 1.5-2 года интенсивного обучения.</div>
    <div class="pitfall"><strong>4. Junior без портфолио в 2025.</strong> Без open-source/pet-projects шансы низкие. Стартуйте с GitHub-репозиториев, не только курсов.</div>
    <div class="pitfall"><strong>5. «Senior на пять лет вперёд».</strong> Технологии меняются. Senior без обновления навыков рискует через 5-7 лет оказаться в категории «дорогой и устаревший».</div>
    <div class="pitfall"><strong>6. Игнорирование soft-skills.</strong> Senior &mdash; это в равной мере коммуникация, ревью, наставничество. Только технические навыки не достаточны.</div>
    <div class="pitfall"><strong>7. Слепая вера в курсы.</strong> Курс не равен опыту. Работодатель смотрит на projects, contributions, способность решать задачи под давлением.</div>
    <div class="pitfall"><strong>8. Откладывание собеседований.</strong> Лучший способ понять рынок &mdash; собеседования. Даже без цели сменить работу &mdash; раз в год пройти 3-5 интервью для калибровки.</div>
  </div>
</div>

<div id="sec-safe-zones" class="section">
  <div class="section-title">Безопасные специализации</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">«Безопасная» = устойчивая к автоматизации в 5-7-летней перспективе. AI пока не справляется с глубоким контекстом, ответственностью за production, дизайном системы под бизнес-цели. Области, где этих требований много, сохраняют человеческую работу.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield"></i> Топ-7 защищённых направлений</div>
    <div class="card">
      <h3>1. Системная архитектура</h3>
      <p class="text">Дизайн крупных систем, баланс trade-offs, оценка стоимости решения на 3-5 лет вперёд. AI помогает с описанием паттернов; решение &mdash; человек со знанием бизнеса.</p>
    </div>
    <div class="card">
      <h3>2. DevOps / SRE / Platform Engineering</h3>
      <p class="text">Production-инциденты, наладка инфраструктуры под нагрузку, runbooks, capacity planning. Требует глубокого понимания всей системы и быстрых решений под стрессом.</p>
    </div>
    <div class="card">
      <h3>3. Security Engineering</h3>
      <p class="text">Threat modeling, audit логов, расследование инцидентов, compliance. Ошибка стоит дорого, ответственность серьёзная &mdash; AI не возьмёт.</p>
    </div>
    <div class="card">
      <h3>4. AI / ML Engineer (не researcher)</h3>
      <p class="text">Не PhD-исследователь, а инженер, доводящий ML до продакшена: data pipelines, training infrastructure, monitoring, drift detection. Растёт быстрее всех.</p>
    </div>
    <div class="card">
      <h3>5. Embedded / Systems</h3>
      <p class="text">Драйверы, RTOS, IoT firmware. Низкий уровень, требует глубокой экспертизы. AI пока слабо помогает.</p>
    </div>
    <div class="card">
      <h3>6. Product Engineering (Tech Lead, Staff)</h3>
      <p class="text">На границе разработки и продукта: понимание пользователей, бизнес-метрик, влияние на revenue. Чисто технических навыков недостаточно.</p>
    </div>
    <div class="card">
      <h3>7. Compliance &amp; Critical Systems</h3>
      <p class="text">Медицина, авиация, финтех под регулятором, оборонка. Не из-за сложности кода, а из-за цены ошибки и регуляторного барьера.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="x-circle"></i> Под давлением автоматизации</div>
    <ul class="bullets">
      <li>Junior frontend (типовые экраны на React/Vue);</li>
      <li>Junior backend (CRUD-эндпоинты, базовые миграции);</li>
      <li>Тестировщики уровня manual QA без автоматизации;</li>
      <li>Базовый WordPress/Joomla развёртывание (заменяется CMS-конструкторами);</li>
      <li>«Перевод требований в код» без участия в дизайне.</li>
    </ul>
    <p class="text">Это не значит «не нанимают» &mdash; нанимают, но меньше и с большими требованиями к проактивности и обучаемости.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. «Безопасно &mdash; на всю жизнь».</strong> Защита от автоматизации &mdash; на 5-7 лет. Через 10 AI может научиться debug под нагрузкой. Учитесь постоянно.</div>
    <div class="pitfall"><strong>2. Уход в нишу без интереса.</strong> Embedded или security &laquo;для безопасности&raquo; без интереса &mdash; путь к выгоранию. Совпадение интереса и востребованности &mdash; идеал.</div>
    <div class="pitfall"><strong>3. Игнорирование AI в «защищённой» специализации.</strong> Architect, использующий AI для скетчей, в 2-3 раза продуктивнее. Не пренебрегайте инструментами.</div>
    <div class="pitfall"><strong>4. Junior в защищённую нишу напрямую.</strong> Security/Architecture требуют опыта 5+ лет. Стартуйте с обычного backend, постепенно специализируйтесь.</div>
    <div class="pitfall"><strong>5. Иллюзия что архитектор «не пишет код».</strong> Architect, не пишущий код 3+ года, теряет понимание реальности. Лучшие &mdash; пишут 10-30% времени.</div>
    <div class="pitfall"><strong>6. «AI безопасно, learning curve пройдёт».</strong> Войти в AI Engineering требует год+ интенсивной работы. Не «прочитать книжку».</div>
    <div class="pitfall"><strong>7. Уход в management «от стресса разработки».</strong> Management имеет другой стресс (people, политика, ответственность за результаты команды). Не lighter path.</div>
    <div class="pitfall"><strong>8. Универсал без специализации.</strong> «Я знаю всё понемногу» &mdash; junior-навык. Senior =&nbsp;экспертиза в одной области + базовое понимание соседних.</div>
  </div>
</div>

<div id="sec-llm-engineering" class="section">
  <div class="section-title">LLM Engineering &mdash; что это такое</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">LLM Engineer (или AI Engineer) &mdash; роль, выросшая в 2023-2024 годах. Отличается от классического ML Researcher: не изобретает новые модели и не пишет с нуля архитектуры; берёт готовые open-source/коммерческие LLM и применяет их к бизнес-задачам через fine-tuning, RAG, prompt engineering, agentic workflows.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> LLM Engineer vs ML Researcher vs Data Scientist</div>
    <table class="data-table">
      <tr><th>Роль</th><th>Что делает</th><th>Образование</th></tr>
      <tr><td><strong>ML Researcher</strong></td><td>Изобретает новые архитектуры, публикует статьи (NeurIPS, ICML)</td><td>PhD, типично из CS / Math</td></tr>
      <tr><td><strong>Data Scientist</strong></td><td>Анализ данных, классические ML-модели (regression, classification), бизнес-метрики</td><td>Master+ или сильный self-taught с математикой</td></tr>
      <tr><td><strong>ML Engineer</strong></td><td>Production-ML: training pipelines, model serving, monitoring, drift</td><td>Backend-инженер с ML-курсами или Master</td></tr>
      <tr><td><strong>LLM / AI Engineer</strong></td><td>Применение готовых LLM: RAG, fine-tuning через LoRA, agentic systems, deployment</td><td>Backend-инженер с интенсивным переучиванием 1-1.5 года</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Типовые задачи LLM Engineer</div>
    <ul class="bullets">
      <li><strong>RAG (Retrieval-Augmented Generation)</strong>: построить систему, где LLM отвечает на основе ваших документов;</li>
      <li><strong>Fine-tuning</strong> существующих моделей (Llama, Mistral) под доменные задачи через LoRA/QLoRA;</li>
      <li><strong>Agentic systems</strong>: ИИ-агенты с инструментами (browse, search, run code), решающие сложные задачи итеративно;</li>
      <li><strong>Prompt engineering</strong>: систематическое улучшение качества ответов через подбор промптов;</li>
      <li><strong>Evaluation</strong>: построение метрик качества LLM-ответов, A/B-тестирование моделей;</li>
      <li><strong>Cost optimization</strong>: выбор модели (GPT-4 vs Claude vs Llama локально) под задачу и бюджет;</li>
      <li><strong>Safety &amp; alignment</strong>: фильтры галлюцинаций, защита от prompt injection.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. «LLM Engineer = prompt engineer».</strong> Prompt engineering &mdash; одна из задач, не вся роль. Без знания PyTorch, transformers, инфраструктуры &mdash; ограниченная карьера.</div>
    <div class="pitfall"><strong>2. Только OpenAI/Claude API в работе.</strong> Если задача &mdash; интеграция API в чат-бот, это разработчик с LLM-навыком, не LLM Engineer. Реальная роль включает локальные модели, fine-tuning, инфраструктуру.</div>
    <div class="pitfall"><strong>3. Без математической базы.</strong> Линейная алгебра, основы вероятности, gradient descent &mdash; нужны для понимания, что происходит в моделях. Без этого &mdash; «магия».</div>
    <div class="pitfall"><strong>4. GPU как требование.</strong> Современные методы (LoRA, QLoRA) позволяют fine-tune на потребительских GPU (RTX 4090, M3 Mac). Cloud (RunPod, Lambda Labs) &mdash; от $0.5/час.</div>
    <div class="pitfall"><strong>5. Игнорирование оценки качества.</strong> Без метрик (BLEU, ROUGE, custom benchmarks) невозможно сказать, стал ли fine-tuned model лучше базового.</div>
    <div class="pitfall"><strong>6. «Я научусь за 3 месяца».</strong> Базовое RAG-приложение &mdash; за неделю. Уверенный fine-tuning, evaluation, production-deploy &mdash; 6-12 месяцев плотной работы.</div>
    <div class="pitfall"><strong>7. Только локальные модели или только API.</strong> Сильный LLM Engineer работает с обоими: API для прототипа, локальная модель для production-стоимости.</div>
    <div class="pitfall"><strong>8. Игнорирование cost.</strong> Один запрос к GPT-4 = $0.01-0.10. При 1M запросов/день &mdash; $10k-100k/мес. Стоимость &mdash; первый вопрос архитектуры.</div>
  </div>
</div>

<div id="sec-roadmap" class="section">
  <div class="section-title">Roadmap для входа в LLM Engineering</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Дорожная карта для backend-инженера (PHP/Laravel опыт), желающего перейти в LLM Engineering. Реалистичный срок &mdash; 12-18 месяцев интенсивной работы по 10-15 часов в неделю в дополнение к основной работе.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Фаза 1: Фундамент (2-3 месяца)</div>
    <div class="card">
      <h3>Python на уровне backend-разработки</h3>
      <p class="text">Если уже знаете PHP, синтаксис Python &mdash; быстро. Цель: писать код качества как на PHP. Книги: «Fluent Python» (Luciano Ramalho), официальный туториал python.org.</p>
    </div>
    <div class="card">
      <h3>Numpy, Pandas, Matplotlib</h3>
      <p class="text">Инструменты обработки данных. Без них &mdash; невозможно работать с ML-данными. Kaggle-курсы (бесплатные) дают практику.</p>
    </div>
    <div class="card">
      <h3>Основы математики</h3>
      <p class="text">Линейная алгебра (векторы, матрицы, dot product), производные, основы вероятности. Курс «Mathematics for Machine Learning» (Imperial College London) на Coursera.</p>
    </div>
    <div class="card">
      <h3>Базовый ML</h3>
      <p class="text">Что такое модель, training, loss, gradient descent, overfitting. Курс «Machine Learning Specialization» Andrew Ng (Coursera). Не углубляйтесь &mdash; общая картина.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cpu"></i> Фаза 2: Сердце LLM &mdash; Transformer (1-2 месяца)</div>
    <div class="card">
      <h3>Архитектура Transformer</h3>
      <p class="text">Attention mechanism, multi-head attention, позиционное кодирование, encoder/decoder. Статья «Attention Is All You Need» (Vaswani et al., 2017) + объяснения в YouTube (Andrej Karpathy, Jay Alammar).</p>
    </div>
    <div class="card">
      <h3>Тренировка маленького Transformer'а с нуля</h3>
      <p class="text">Курс Karpathy «Neural Networks: Zero to Hero» (бесплатный на YouTube): пишете GPT с нуля на чистом PyTorch. После него понимаете, как LLM работают изнутри.</p>
    </div>
    <div class="card">
      <h3>PyTorch на уровне свободного владения</h3>
      <p class="text">Тензоры, автоград, оптимизаторы, dataloaders, обучение моделей. Официальный туториал pytorch.org + проектные задания.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Фаза 3: Практика с LLM (3-4 месяца)</div>
    <div class="card">
      <h3>Hugging Face Transformers</h3>
      <p class="text">Главная библиотека работы с готовыми моделями. Загрузка, inference, генерация текста. Бесплатный курс «Hugging Face NLP Course».</p>
    </div>
    <div class="card">
      <h3>Fine-tuning через LoRA / QLoRA</h3>
      <p class="text">Эффективное дообучение моделей: обновляем малую часть параметров, помещаемся на потребительском GPU. Pakcт <code>peft</code> от Hugging Face. Практика: fine-tune Llama-3-8B на собственном датасете.</p>
    </div>
    <div class="card">
      <h3>Evaluation моделей</h3>
      <p class="text">Метрики: perplexity, BLEU, ROUGE, custom benchmarks. Инструменты: <code>lm-evaluation-harness</code>. Без оценки fine-tuning &mdash; гадание.</p>
    </div>
    <div class="card">
      <h3>Квантизация</h3>
      <p class="text">Модель в 16-bit vs 8-bit vs 4-bit. <code>bitsandbytes</code>, <code>llama.cpp</code>, GGUF-формат. Позволяет запускать 7B-13B модели локально на CPU/потребительском GPU.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="rocket"></i> Фаза 4: Реальные приложения (3-5 месяцев)</div>
    <div class="card">
      <h3>RAG-пайплайны</h3>
      <p class="text">Архитектура: документы → chunks → embeddings → vector DB → retrieval → LLM. Стек: LangChain или LlamaIndex, Qdrant/Pinecone/pgvector. Проект: бот, отвечающий по вашей документации.</p>
    </div>
    <div class="card">
      <h3>Agentic AI</h3>
      <p class="text">Многоагентные системы: ИИ с инструментами (browse, search, run code), которые планируют и итерируют. Стек: LangGraph, AutoGen, CrewAI. Сложная и быстро меняющаяся область.</p>
    </div>
    <div class="card">
      <h3>Production deployment</h3>
      <p class="text">FastAPI для API, Docker для упаковки, Kubernetes или Cloud Run для деплоя. Мониторинг: Langfuse, Helicone. Cost tracking, rate limiting, fallbacks между моделями.</p>
    </div>
    <div class="card">
      <h3>Open-source портфолио</h3>
      <p class="text">2-3 полных проекта на GitHub: RAG-бот, fine-tuned модель с evaluation, agentic-приложение. README с архитектурой, примерами, метриками. Это будет ваш «диплом» при поиске работы.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle-2"></i> К концу пути</div>
    <ul class="bullets">
      <li>Уверенный Python + PyTorch + Hugging Face;</li>
      <li>Понимание Transformer'ов и attention изнутри;</li>
      <li>Fine-tuning через LoRA на собственных датасетах;</li>
      <li>Production RAG-системы и базовые agentic-приложения;</li>
      <li>Понимание стоимости моделей и тонкостей deployment;</li>
      <li>3+ open-source проекта в портфолио;</li>
      <li>Готовность к собеседованиям на позиции AI Engineer / LLM Engineer.</li>
    </ul>
  </div>
</div>

<div id="sec-python-stack" class="section">
  <div class="section-title">Python-стек для AI работы</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Сводный обзор библиотек и инструментов, которыми пользуется LLM Engineer ежедневно. Знание этого стека &mdash; рабочий минимум для собеседований.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package"></i> Базовый слой</div>
    <table class="data-table">
      <tr><th>Инструмент</th><th>Назначение</th></tr>
      <tr><td><code>numpy</code></td><td>N-мерные массивы, линейная алгебра. Базис под всё ML</td></tr>
      <tr><td><code>pandas</code></td><td>Табличные данные, DataFrame, ETL</td></tr>
      <tr><td><code>matplotlib</code> / <code>seaborn</code></td><td>Визуализация данных, построение графиков</td></tr>
      <tr><td><code>scipy</code></td><td>Научные вычисления (статистика, оптимизация)</td></tr>
      <tr><td><code>scikit-learn</code></td><td>Классический ML: regression, classification, clustering, preprocessing</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cpu"></i> Deep Learning</div>
    <table class="data-table">
      <tr><th>Инструмент</th><th>Назначение</th></tr>
      <tr><td><code>pytorch</code></td><td>Главный DL-фреймворк для исследований и продакшена</td></tr>
      <tr><td><code>tensorflow</code> + Keras</td><td>Альтернатива PyTorch, чаще в enterprise/Google</td></tr>
      <tr><td><code>jax</code></td><td>Высокопроизводительный фреймворк (Google), для исследований</td></tr>
      <tr><td><code>lightning</code> (ex PyTorch Lightning)</td><td>Высокоуровневая обёртка над PyTorch для трейнинга</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book"></i> LLM-специфика</div>
    <table class="data-table">
      <tr><th>Инструмент</th><th>Назначение</th></tr>
      <tr><td><code>transformers</code> (HF)</td><td>Главная библиотека для работы с LLM: загрузка моделей, токенизация, generation</td></tr>
      <tr><td><code>datasets</code> (HF)</td><td>Загрузка и обработка датасетов, потоковая обработка большого объёма</td></tr>
      <tr><td><code>peft</code> (HF)</td><td>Parameter-Efficient Fine-Tuning: LoRA, QLoRA, Prefix Tuning</td></tr>
      <tr><td><code>trl</code> (HF)</td><td>Transformer Reinforcement Learning: RLHF, DPO для alignment</td></tr>
      <tr><td><code>accelerate</code> (HF)</td><td>Multi-GPU и distributed training из коробки</td></tr>
      <tr><td><code>bitsandbytes</code></td><td>Квантизация моделей (4-bit, 8-bit) для запуска на потребительском железе</td></tr>
      <tr><td><code>vllm</code> / <code>sglang</code></td><td>Высокопроизводительный inference (production-уровень)</td></tr>
      <tr><td><code>llama-cpp-python</code></td><td>Inference квантизованных моделей на CPU/Metal через llama.cpp</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Applications-уровень</div>
    <table class="data-table">
      <tr><th>Инструмент</th><th>Назначение</th></tr>
      <tr><td><code>langchain</code></td><td>Composable framework для LLM-приложений (промпты, цепочки, агенты, retrievers)</td></tr>
      <tr><td><code>llama-index</code></td><td>RAG-фреймворк с фокусом на индексирование документов</td></tr>
      <tr><td><code>langgraph</code></td><td>Граф-based многоагентные системы поверх LangChain</td></tr>
      <tr><td><code>autogen</code> (Microsoft)</td><td>Multi-agent conversations</td></tr>
      <tr><td><code>crewai</code></td><td>Role-based агенты с делегацией задач</td></tr>
      <tr><td><code>dspy</code></td><td>Программирование LLM как функций (декларативно, не промптами)</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> Vector databases</div>
    <table class="data-table">
      <tr><th>Инструмент</th><th>Назначение</th></tr>
      <tr><td><code>pgvector</code></td><td>Расширение PostgreSQL &mdash; вектора в обычной БД, проще для существующих стеков</td></tr>
      <tr><td><code>qdrant</code></td><td>Specialized vector DB, открытый код, production-ready</td></tr>
      <tr><td><code>pinecone</code></td><td>Managed cloud vector DB</td></tr>
      <tr><td><code>weaviate</code></td><td>Vector DB с GraphQL API</td></tr>
      <tr><td><code>milvus</code></td><td>Scalable vector DB, enterprise</td></tr>
      <tr><td><code>faiss</code> (Meta)</td><td>Библиотека для approximate nearest neighbor search, не самостоятельная БД</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="line-chart"></i> Observability</div>
    <table class="data-table">
      <tr><th>Инструмент</th><th>Назначение</th></tr>
      <tr><td><code>langfuse</code></td><td>Open-source LLM observability: traces, evaluations, prompt management</td></tr>
      <tr><td><code>langsmith</code></td><td>Коммерческое решение от LangChain</td></tr>
      <tr><td><code>helicone</code></td><td>Прокси-логирование вызовов к LLM API</td></tr>
      <tr><td><code>wandb</code> (Weights &amp; Biases)</td><td>Experiment tracking для training-pipelines</td></tr>
      <tr><td><code>mlflow</code></td><td>Open-source experiment tracking + model registry</td></tr>
    </table>
  </div>
</div>

<div id="sec-hybrid" class="section">
  <div class="section-title">Гибридный подход: PHP backend + Python AI</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Многие стартапы и компании в 2025 году используют двойной стек: основной backend на PHP/Laravel (быстро, надёжно, дешёво в хостинге), AI-функции на Python-микросервисах. Это снимает выбор «или-или», даёт развиваться обеим направлениям, и позволяет постепенно перейти на AI-сторону, не теряя существующих навыков.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-merge"></i> Типовая архитектура</div>
<pre><code><span class="c-comment">┌────────────────────────────────────────────────────────────┐
│                       Browser / Mobile                      │
└──────────────────────────┬──────────────────────────────────┘
                           │ HTTPS
                           ▼
┌────────────────────────────────────────────────────────────┐
│            Laravel API (PHP 8.x + Sanctum)                  │
│  - Auth, users, billing, business logic                     │
│  - Eloquent + PostgreSQL                                    │
│  - Queue jobs, scheduled tasks                              │
└──────────────────────────┬──────────────────────────────────┘
                           │ HTTP (internal)
                           ▼
┌────────────────────────────────────────────────────────────┐
│        Python AI Microservice (FastAPI + LangChain)         │
│  - RAG endpoint: POST /chat                                 │
│  - Embeddings generation: POST /embed                       │
│  - Fine-tuned model inference: POST /classify               │
└──────────┬──────────────────────────────────────┬───────────┘
           │                                      │
           ▼                                      ▼
┌──────────────────────┐                ┌─────────────────────┐
│  pgvector / Qdrant   │                │  Hosted LLM API     │
│  (semantic search)   │                │  (OpenAI / Claude)  │
└──────────────────────┘                └─────────────────────┘</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: вызов Python-сервиса из Laravel</div>
<pre><code><span class="c-comment">// PHP/Laravel сторона</span>
<span class="c-key">final class</span> <span class="c-type">AiService</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private</span> <span class="c-type">PendingRequest</span> <span class="c-var">$http</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">chat</span>(<span class="c-key">string</span> <span class="c-var">$question</span>, <span class="c-key">array</span> <span class="c-var">$context</span> = []): <span class="c-key">string</span>
    {
        <span class="c-var">$response</span> = <span class="c-var">$this</span>-&gt;<span class="c-var">http</span>
            -&gt;<span class="c-fn">timeout</span>(<span class="c-num">30</span>)
            -&gt;<span class="c-fn">retry</span>(<span class="c-num">2</span>, <span class="c-num">100</span>)
            -&gt;<span class="c-fn">post</span>(<span class="c-fn">config</span>(<span class="c-str">'ai.url'</span>) . <span class="c-str">'/chat'</span>, [
                <span class="c-str">'question'</span> =&gt; <span class="c-var">$question</span>,
                <span class="c-str">'context'</span>  =&gt; <span class="c-var">$context</span>,
            ]);

        <span class="c-key">return</span> <span class="c-var">$response</span>-&gt;<span class="c-fn">throw</span>()-&gt;<span class="c-fn">json</span>(<span class="c-str">'answer'</span>);
    }
}

<span class="c-comment"># Python/FastAPI сторона</span>
<span class="c-key">from</span> <span class="c-type">fastapi</span> <span class="c-key">import</span> <span class="c-type">FastAPI</span>
<span class="c-key">from</span> <span class="c-type">pydantic</span> <span class="c-key">import</span> <span class="c-type">BaseModel</span>
<span class="c-key">from</span> <span class="c-type">langchain.chains</span> <span class="c-key">import</span> <span class="c-type">RetrievalQA</span>

app = <span class="c-type">FastAPI</span>()

<span class="c-key">class</span> <span class="c-type">ChatRequest</span>(<span class="c-type">BaseModel</span>):
    question: <span class="c-key">str</span>
    context: <span class="c-key">list</span>[<span class="c-key">str</span>] = []

<span class="c-fn">@app.post</span>(<span class="c-str">"/chat"</span>)
<span class="c-key">def</span> <span class="c-fn">chat</span>(req: <span class="c-type">ChatRequest</span>):
    qa = <span class="c-type">RetrievalQA</span>.from_chain_type(llm=llm, retriever=retriever)
    answer = qa.run(req.question)
    <span class="c-key">return</span> {<span class="c-str">"answer"</span>: answer}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Преимущества гибрида</div>
    <ul class="bullets">
      <li>Не нужно переписывать рабочий продукт с PHP на Python;</li>
      <li>Команда продолжает работать в привычном стеке для основной логики;</li>
      <li>AI-функции изолированы в отдельном сервисе &mdash; можно эксперементировать без риска;</li>
      <li>Скейлится отдельно (AI на GPU-нодах, основной API на обычных);</li>
      <li>Найм Python-инженеров на отдельный сервис, без требования знать ваш PHP-стек.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Микросервис без чёткого API-контракта.</strong> Изменения в Python ломают PHP. Используйте OpenAPI/JSON Schema, версионирование endpoint'ов.</div>
    <div class="pitfall"><strong>2. Синхронные long-running запросы.</strong> Inference LLM может занимать 5-30 сек. Используйте очередь (RabbitMQ/Redis) и асинхронный паттерн.</div>
    <div class="pitfall"><strong>3. Отсутствие fallback.</strong> Python-сервис упал &mdash; вся AI-функциональность недоступна. Реализуйте graceful degradation (показать заглушку, не падать).</div>
    <div class="pitfall"><strong>4. Дублирование auth-логики.</strong> Python должен проверять JWT/токены, выданные Laravel. Используйте общий secret + RS256 JWT.</div>
    <div class="pitfall"><strong>5. Дорогая инференс на каждом запросе.</strong> Кешируйте embeddings и ответы. LLM call &mdash; деньги; повторный вопрос &mdash; кеш.</div>
    <div class="pitfall"><strong>6. Без observability.</strong> AI-сервис &mdash; чёрный ящик: непонятно, почему ответ плохой. Добавляйте Langfuse/Helicone с первого дня.</div>
    <div class="pitfall"><strong>7. Vector DB в одном процессе.</strong> На объёмах от миллиона документов pgvector упирается в производительность. Переходите на Qdrant/Weaviate.</div>
    <div class="pitfall"><strong>8. Игнорирование стоимости.</strong> 1 пользователь × 50 вопросов в день × $0.02/запрос = $30/месяц только на LLM. На 10к пользователей &mdash; $300к. Бизнес-модель должна это покрывать.</div>
  </div>
</div>

<div id="sec-specializations" class="section">
  <div class="section-title">Senior, Staff, Architect &mdash; куда расти из middle</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Из middle (3-5 лет опыта) есть три классических вектора роста: technical (Staff/Principal engineer), management (Tech Lead, Engineering Manager, Director), product (Tech-savvy PM, Founder). Каждый требует разных навыков и даёт разное удовольствие от работы.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Технический путь (IC track)</div>
    <div class="card">
      <h3>Senior Engineer (5-8 лет)</h3>
      <p class="text">Уверенный технический эксперт. Самостоятельно решает сложные задачи, делает дизайн системы для одного-двух модулей. Менторит junior-middle. Не требует постоянного контроля.</p>
    </div>
    <div class="card">
      <h3>Staff Engineer (8-12 лет)</h3>
      <p class="text">Влияние на несколько команд. Решает технические проблемы, затрагивающие весь продукт. Участвует в найме, технических стратегиях. В FAANG часто переход от senior &mdash; это не повышение, а изменение роли (больше дизайна, меньше кода).</p>
    </div>
    <div class="card">
      <h3>Principal / Distinguished Engineer (12+ лет)</h3>
      <p class="text">Технический лидер уровня директора. Стратегия технологического стека всей компании. Редкая роль, обычно 1-3 на 1000 инженеров.</p>
    </div>
    <div class="card">
      <h3>Architect</h3>
      <p class="text">Фокус на системный дизайн. Может быть Solutions Architect (под клиентов), Enterprise Architect (под организацию). В разных компаниях разные значения &mdash; иногда synonyms для Staff.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="users"></i> Менеджерский путь</div>
    <div class="card">
      <h3>Tech Lead (5-7 лет, гибрид)</h3>
      <p class="text">Не формальный менеджер, но ведёт команду 2-5 инженеров. Распределяет задачи, делает архитектуру, ревью. Сохраняет 50%+ времени на код.</p>
    </div>
    <div class="card">
      <h3>Engineering Manager (7-10 лет)</h3>
      <p class="text">Формальный менеджер 5-10 человек. People management, 1:1, performance reviews, hiring, цели команды. Код &mdash; 0-20% времени.</p>
    </div>
    <div class="card">
      <h3>Senior Manager / Director (10-15 лет)</h3>
      <p class="text">Manage Managers. Бюджеты, стратегия департамента, кросс-командная работа. Технического кода нет.</p>
    </div>
    <div class="card">
      <h3>VP Engineering / CTO</h3>
      <p class="text">Высший технический руководитель. Стратегия компании, общение с C-level, инвесторами. Не для всех &mdash; нужны навыки бизнеса, не только инженерии.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="rocket"></i> Продуктовый путь</div>
    <div class="card">
      <h3>Tech-savvy Product Manager</h3>
      <p class="text">PM с глубоким техническим бэкграундом &mdash; ценится в B2B-продуктах с API, dev-tools, инфраструктурных стартапах. Зарплата сопоставима с Senior Engineer.</p>
    </div>
    <div class="card">
      <h3>Developer Advocate / DevRel</h3>
      <p class="text">Работа с сообществом разработчиков: написание контента, доклады, опен-сорс, поддержка пользователей. Гибрид технического и публичного.</p>
    </div>
    <div class="card">
      <h3>Solutions Engineer / Pre-sales</h3>
      <p class="text">Технический партнёр sales-команды. Помогает enterprise-клиентам интегрировать продукт. Высокие зарплаты (часто с bonus от продаж).</p>
    </div>
    <div class="card">
      <h3>Founder / CTO стартапа</h3>
      <p class="text">Высокий риск, высокая потенциальная награда. Технические навыки &mdash; одна из двадцати компетенций (нужны продажи, маркетинг, найм, фандрейзинг).</p>
    </div>
  </div>
</div>

<div id="sec-resources" class="section">
  <div class="section-title">Ресурсы для изучения</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Подборка проверенных ресурсов по областям. Только то, что использовали реальные инженеры &mdash; не маркетинговые курсы.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cpu"></i> AI / ML / LLM</div>
    <ul class="bullets">
      <li><strong>Andrej Karpathy &mdash; «Neural Networks: Zero to Hero»</strong> (YouTube, бесплатно). Лучший курс для понимания, как работают LLM изнутри. Пишете GPT с нуля на чистом PyTorch.</li>
      <li><strong>Hugging Face NLP Course</strong> (бесплатно). Практическое введение в transformers и работу с готовыми моделями.</li>
      <li><strong>Coursera &mdash; «Machine Learning Specialization»</strong> Andrew Ng. Классика для ML-основ.</li>
      <li><strong>fast.ai &mdash; «Practical Deep Learning»</strong>. Practical-first подход, хорошо для уже опытных программистов.</li>
      <li><strong>«Build a Large Language Model From Scratch»</strong> Sebastian Raschka (книга 2024). Полный путь от токенизации до fine-tuning, на PyTorch.</li>
      <li><strong>«Mathematics for Machine Learning»</strong> Imperial College London (Coursera). Математическая база.</li>
      <li><strong>The Illustrated Transformer</strong> Jay Alammar (блог). Лучшее визуальное объяснение архитектуры.</li>
      <li><strong>LangChain Docs + Cookbook</strong>. Практические рецепты для RAG, agents, integrations.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="code-2"></i> Backend / Architecture</div>
    <ul class="bullets">
      <li><strong>«Designing Data-Intensive Applications»</strong> Martin Kleppmann. Обязательная книга для backend-сеньора.</li>
      <li><strong>«Software Engineering at Google»</strong> бесплатно онлайн. Практики масштабной разработки.</li>
      <li><strong>«The Phoenix Project» / «The Unicorn Project»</strong> Gene Kim. Романы про DevOps-культуру.</li>
      <li><strong>System Design Primer</strong> (GitHub donnemartin). Бесплатная подготовка к собеседованиям по системному дизайну.</li>
      <li><strong>Laracasts</strong> для углубления в Laravel.</li>
      <li><strong>«Modern PHP»</strong> Josh Lockhart. Современный PHP без мифов из 2010-х.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="briefcase"></i> Карьера и софт-скиллы</div>
    <ul class="bullets">
      <li><strong>«The Pragmatic Programmer»</strong> Andy Hunt, Dave Thomas (20th anniversary edition).</li>
      <li><strong>«Staff Engineer: Leadership Beyond Management»</strong> Will Larson. Путь без перехода в менеджмент.</li>
      <li><strong>«The Manager's Path»</strong> Camille Fournier. Если рассматриваете менеджерский трек.</li>
      <li><strong>«An Elegant Puzzle: Systems of Engineering Management»</strong> Will Larson.</li>
      <li><strong>levels.fyi</strong> &mdash; реальные данные о компенсациях по компаниям и уровням.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="newspaper"></i> Регулярное чтение</div>
    <ul class="bullets">
      <li><strong>Hacker News</strong> &mdash; пульс индустрии;</li>
      <li><strong>InfoQ</strong>, <strong>ACM Queue</strong> &mdash; глубокие технические статьи;</li>
      <li><strong>Latent Space</strong>, <strong>The Batch</strong> &mdash; рассылки про AI;</li>
      <li><strong>Pragmatic Engineer</strong> Гергели Орос &mdash; о реальности big tech и стартапов;</li>
      <li><strong>r/MachineLearning</strong>, <strong>r/LocalLLaMA</strong> &mdash; subreddit'ы с практикой.</li>
    </ul>
  </div>
</div>

<div id="sec-pitfalls" class="section">
  <div class="section-title">Заблуждения о карьере в разработке</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Топ-15 ловушек</div>
    <div class="pitfall"><strong>1. «AI заменит всех программистов через 2 года».</strong> Прогнозы 2023 года не сбылись. Реальность сложнее: меняется состав работы, не общее количество.</div>
    <div class="pitfall"><strong>2. «Если выучу 3 фреймворка &mdash; буду востребованным».</strong> Глубина важнее ширины. Senior в одном стеке + базовое знание соседних &mdash; ценнее «список из 20 технологий в резюме».</div>
    <div class="pitfall"><strong>3. «PHP/Laravel мёртв, надо срочно учить Python».</strong> Laravel &mdash; растёт. Дефицит сеньоров Laravel в Европе и СНГ. Эмоциональное решение под влиянием соцсетей.</div>
    <div class="pitfall"><strong>4. «AI-инженером можно стать за полгода».</strong> Реальный путь &mdash; 12-18 месяцев интенсивной работы при наличии backend-опыта. Меньше &mdash; «знаю промпт-инженеринг».</div>
    <div class="pitfall"><strong>5. «Senior &mdash; это просто middle с большим стажем».</strong> Нет. Senior &mdash; качественное изменение: способность к архитектурным решениям, наставничеству, кросс-командной работе. Не происходит автоматически.</div>
    <div class="pitfall"><strong>6. «Менеджмент &mdash; это легче кода».</strong> Управление людьми &mdash; другой стресс. People-проблемы сложнее технических. Многие IC возвращаются из менеджмента обратно.</div>
    <div class="pitfall"><strong>7. «Только большие компании платят хорошо».</strong> Стартапы B-series и выше с equity дают сопоставимо или больше. Risk выше, но и upside.</div>
    <div class="pitfall"><strong>8. «Полная удалёнка &mdash; норма навсегда».</strong> С 2023 многие big tech вернули в офис. Полная удалёнка &mdash; не гарантирована.</div>
    <div class="pitfall"><strong>9. «Если работаю &gt;50 часов, я лучше».</strong> Burnout снижает продуктивность. Лучшие инженеры &mdash; работают сфокусированно 4-6 часов в день high-leverage задач.</div>
    <div class="pitfall"><strong>10. «Сертификаты помогут».</strong> Для отдельных областей (AWS, GCP, Kubernetes) &mdash; полезны. В целом meaningful меньше, чем GitHub-проекты и реальный опыт.</div>
    <div class="pitfall"><strong>11. «Pet-project &mdash; для junior».</strong> Open-source contribution и собственные проекты ценятся на всех уровнях. Senior без активной разработки в свободное время &mdash; рискует устареть.</div>
    <div class="pitfall"><strong>12. «Зарплата &mdash; единственная метрика».</strong> Учитывайте: качество команды, learning opportunities, тип задач, work-life balance. Через 3 года в скучной компании потеряете в долгосрочной зарплате больше, чем сэкономили сейчас.</div>
    <div class="pitfall"><strong>13. «Стек важнее команды».</strong> Хорошая команда на скучном стеке развивает быстрее, чем плохая на модном.</div>
    <div class="pitfall"><strong>14. «LinkedIn &mdash; источник правды».</strong> Большая часть постов &mdash; маркетинг или эхо-камера. Реальная картина &mdash; от собеседований, друзей в индустрии, тематических подкастов.</div>
    <div class="pitfall"><strong>15. «Я уже стар для нового языка/области».</strong> Возраст не критичен. Критично &mdash; время и энергия на обучение. Можно стать AI-инженером в 45, если уделять 15 часов в неделю.</div>
  </div>
</div>

<div id="sec-interview" class="section">
  <div class="section-title">Карьерные вопросы на собеседованиях</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="message-square"></i> Что спрашивают senior'ов и staff-инженеров</div>
    <div class="card"><h3>1. «Расскажите о самом сложном техническом решении, которое приняли»</h3><p class="text">Готовьте 2-3 истории: контекст, что решали, какие альтернативы рассмотрели, что выбрали и почему, какой был результат, чему научились. STAR-формат (Situation, Task, Action, Result) работает.</p></div>
    <div class="card"><h3>2. «Как вы оцениваете сложность задачи перед началом?»</h3><p class="text">Декомпозиция, известное vs неизвестное, риски (внешние зависимости, миграция данных, нагрузка). Если задача оценена в неделю, что в ней может занять месяц.</p></div>
    <div class="card"><h3>3. «Как вы менторите junior'ов?»</h3><p class="text">Code review с обучающим компонентом, парное программирование, постановка задач с разным уровнем подсказок, ретроспективы. Не «делаю за них».</p></div>
    <div class="card"><h3>4. «Опишите case, когда не согласились с архитектурным решением команды»</h3><p class="text">Disagree &amp; commit. Что предложили взамен, как обосновали, как разрешился спор. Не «настоял на своём», а «нашли компромисс».</p></div>
    <div class="card"><h3>5. «Что бы изменили в текущем коде вашего проекта?»</h3><p class="text">Конкретные технические долги, понимание trade-offs (быстрее vs правильнее), приоритезация (что починить первым).</p></div>
    <div class="card"><h3>6. «Как поддерживаете актуальность знаний?»</h3><p class="text">Конкретные источники (книги, podcasts, conferences), pet-projects, contribution в open-source. Не «слежу за трендами», а «прочитал такую-то книгу, попробовал такой-то инструмент».</p></div>
    <div class="card"><h3>7. «Опишите идеальную команду для вас»</h3><p class="text">Без штампов «талантливая и дружная». Конкретно: размер, ratio senior/junior, частота релизов, code review культура, async vs sync коммуникация.</p></div>
    <div class="card"><h3>8. «Что мотивирует вас в работе?»</h3><p class="text">Честный ответ: технические вызовы, влияние на бизнес, обучение, влияние на команду, спокойствие. Разные компании ищут разные мотиваторы.</p></div>
    <div class="card"><h3>9. «Расскажите о неудачном проекте»</h3><p class="text">Что случилось, ваша роль, что было упущено, какие выводы. Senior &mdash; человек, у которого есть и провалы, не только успехи. Игнорирование вопроса &mdash; красный флаг для интервьюера.</p></div>
    <div class="card"><h3>10. «Где видите себя через 5 лет?»</h3><p class="text">Конкретный направление (Staff IC, EM, AI Engineer, Founder), осознанное обоснование. Не «вырасту в компании» &mdash; пустой ответ.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="search"></i> Что спрашивать у работодателя</div>
    <ul class="bullets">
      <li>«Расскажите о последнем production-инциденте» &mdash; покажет реальную культуру post-mortem;</li>
      <li>«Как у вас устроено on-call?» &mdash; узнать про work-life balance;</li>
      <li>«Кто из инженеров получил продвижение в последние 6 месяцев и за что?» &mdash; критерии роста;</li>
      <li>«Сколько времени уходит на review одного PR в среднем?» &mdash; скорость и качество ревью;</li>
      <li>«Когда в последний раз отменяли feature после прототипа?» &mdash; культура product discovery;</li>
      <li>«Какой ratio of new features vs technical debt?» &mdash; инвестиции в платформу;</li>
      <li>«Как принимаются технические решения?» &mdash; RFC, ad-hoc, hierarchy;</li>
      <li>«Какой главный challenge команды сейчас?» &mdash; honest answer показывает зрелость.</li>
    </ul>
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
