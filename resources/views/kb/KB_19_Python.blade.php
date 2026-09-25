@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Python — база, ООП, веб, DevOps</title>
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
.c-op{color:#56B6C2;}
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
  <div class="sidebar-title">Python</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">Основы</div>
  <a class="nav-item" onclick="showSection('install',this)"><i data-lucide="download"></i> Установка + версии + pip</a>
  <a class="nav-item" onclick="showSection('syntax',this)"><i data-lucide="code"></i> Синтаксис + отступы</a>
  <a class="nav-item" onclick="showSection('types',this)"><i data-lucide="braces"></i> Типы данных</a>
  <a class="nav-item" onclick="showSection('strings',this)"><i data-lucide="type"></i> Строки + f-strings</a>
  <a class="nav-item" onclick="showSection('control',this)"><i data-lucide="git-branch"></i> Условия + циклы</a>
  <a class="nav-item" onclick="showSection('functions',this)"><i data-lucide="function-square"></i> Функции + lambda</a>
  <a class="nav-item" onclick="showSection('collections',this)"><i data-lucide="list"></i> list/dict/set comprehensions</a>
  <a class="nav-item" onclick="showSection('builtins',this)"><i data-lucide="library"></i> Встроенные функции</a>

  <div class="nav-group-label">Продвинуто</div>
  <a class="nav-item" onclick="showSection('oop',this)"><i data-lucide="boxes"></i> ООП + классы + dunder</a>
  <a class="nav-item" onclick="showSection('modules',this)"><i data-lucide="package"></i> Модули + импорты</a>
  <a class="nav-item" onclick="showSection('venv',this)"><i data-lucide="folder-tree"></i> venv + pip vs poetry vs uv</a>
  <a class="nav-item" onclick="showSection('exceptions',this)"><i data-lucide="alert-triangle"></i> Исключения try/except</a>
  <a class="nav-item" onclick="showSection('files',this)"><i data-lucide="file-text"></i> Работа с файлами + JSON/CSV</a>
  <a class="nav-item" onclick="showSection('decorators',this)"><i data-lucide="at-sign"></i> Декораторы @</a>
  <a class="nav-item" onclick="showSection('typing',this)"><i data-lucide="check-check"></i> Type hints + mypy</a>
  <a class="nav-item" onclick="showSection('async',this)"><i data-lucide="zap"></i> async/await + asyncio</a>
  <a class="nav-item" onclick="showSection('generators',this)"><i data-lucide="repeat"></i> Генераторы + iterators</a>

  <div class="nav-group-label">Веб-фреймворки</div>
  <a class="nav-item" onclick="showSection('django',this)"><i data-lucide="layout"></i> Django — обзор</a>
  <a class="nav-item" onclick="showSection('fastapi',this)"><i data-lucide="rocket"></i> FastAPI — обзор</a>
  <a class="nav-item" onclick="showSection('flask',this)"><i data-lucide="beaker"></i> Flask — обзор</a>
  <a class="nav-item" onclick="showSection('framework-compare',this)"><i data-lucide="git-compare"></i> Django vs FastAPI vs Flask</a>

  <div class="nav-group-label">Данные и HTTP</div>
  <a class="nav-item" onclick="showSection('db',this)"><i data-lucide="database"></i> БД: psycopg2 / SQLAlchemy</a>
  <a class="nav-item" onclick="showSection('http',this)"><i data-lucide="globe"></i> HTTP: requests / httpx</a>

  <div class="nav-group-label">ML / Data-стек</div>
  <a class="nav-item" onclick="showSection('numpy',this)"><i data-lucide="grid-3x3"></i> NumPy — фундамент</a>
  <a class="nav-item" onclick="showSection('pandas',this)"><i data-lucide="table"></i> Pandas — всерьёз</a>
  <a class="nav-item" onclick="showSection('plotting',this)"><i data-lucide="line-chart"></i> matplotlib / seaborn</a>
  <a class="nav-item" onclick="showSection('jupyter',this)"><i data-lucide="notebook-pen"></i> Jupyter Notebooks</a>
  <a class="nav-item" onclick="showSection('algorithms',this)"><i data-lucide="workflow"></i> Алгопаттерны на массивах</a>

  <div class="nav-group-final">Инструменты</div>
  <a class="nav-item" onclick="showSection('testing',this)"><i data-lucide="test-tube"></i> pytest + fixtures</a>
  <a class="nav-item" onclick="showSection('logging',this)"><i data-lucide="scroll-text"></i> Логирование</a>
  <a class="nav-item" onclick="showSection('tools',this)"><i data-lucide="wrench"></i> ruff / black / mypy</a>

  <div class="nav-group-label">Для PHP-разработчика</div>
  <a class="nav-item" onclick="showSection('python-vs-php',this)"><i data-lucide="git-compare-arrows"></i> Python vs PHP — мосты</a>
  <a class="nav-item" onclick="showSection('interview',this)"><i data-lucide="brain"></i> FAQ на собеседовании</a>
</div>

<div class="main">
<div class="page-header">
  <h1>Python — база, ООП, веб, DevOps</h1>
  <p>Практический раздел для backend-разработчика (PHP/Laravel) — быстрый вход в Python: синтаксис, ООП, веб-фреймворки (Django/FastAPI/Flask), инструменты. С акцентом на «что здесь по-другому чем в PHP» и «где Python сегодня реально используют».</p>
  <div class="badge-row">
    <span class="badge">Python 3.11+</span>
    <span class="badge">Backend</span>
    <span class="badge">Web</span>
    <span class="badge badge-success">Практика</span>
    <span class="badge badge-warning">Живой</span>
  </div>
</div>

<!-- ═══════════════════════════ OVERVIEW ═══════════════════════════ -->
<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>

  <p class="text">Python — второй по популярности язык backend-мира после JavaScript/PHP. Для PHP-разработчика это <strong>дешёвая инвестиция</strong>: половина концепций (ООП, ассоциативные массивы, интерполяция строк, декораторы, замыкания) уже знакомы, различия в основном в синтаксисе. Дальнейшие 20% — асинхронность, type hints и pythonic-стиль — усваиваются за пару недель практики.</p>

  <div class="info-box primary">
    <strong>Цель раздела:</strong> дать <em>рабочее</em> знание Python для backend-задач — не язык на собес по алгоритмам, а практический инструмент: развернул FastAPI, подключился к БД, положил в Docker, задеплоил. Плюс ориентирование в экосистеме: pip vs poetry, Django vs FastAPI, requests vs httpx.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map"></i> Карта раздела</div>
    <table class="data-table">
      <tr><th>Блок</th><th>Что внутри</th></tr>
      <tr><td><strong>Основы</strong></td><td>Установка, синтаксис, типы, строки, условия, циклы, функции, comprehensions.</td></tr>
      <tr><td><strong>Продвинуто</strong></td><td>ООП + dunder, модули, venv/poetry, исключения, файлы, декораторы, type hints, async, генераторы.</td></tr>
      <tr><td><strong>Веб-фреймворки</strong></td><td>Django (батарейки в комплекте), FastAPI (современный async), Flask (микро), сравнение.</td></tr>
      <tr><td><strong>Данные и HTTP</strong></td><td>psycopg2 / SQLAlchemy, requests / httpx, Pandas базово.</td></tr>
      <tr><td><strong>Инструменты</strong></td><td>pytest, logging, ruff/black/mypy.</td></tr>
      <tr><td><strong>Для PHP-разработчика</strong></td><td>Мосты Python ↔ PHP по типовым задачам, FAQ на собес.</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> Где Python сегодня реально используется</div>
    <div class="card">
      <h3><i data-lucide="brain"></i> ML / AI / Data Science</h3>
      <p class="text">Абсолютный монополист. NumPy, Pandas, scikit-learn, PyTorch, TensorFlow, LangChain, Anthropic SDK. Если ты пишешь что-то с AI — почти наверняка это Python (или JavaScript-обёртка вокруг Python-модели на сервере).</p>
    </div>
    <div class="card">
      <h3><i data-lucide="server"></i> Backend web / API</h3>
      <p class="text">Django (Instagram, Pinterest, Reddit — начинали с него), FastAPI (Netflix, Uber — для новых сервисов), Flask (маленькие сервисы, прототипы). Для микросервисов и AI-бэков — FastAPI сейчас де-факто стандарт.</p>
    </div>
    <div class="card">
      <h3><i data-lucide="terminal"></i> DevOps + автоматизация</h3>
      <p class="text">Ansible, SaltStack, скрипты деплоя, обёртки над AWS/GCP CLI, парсинг логов, генерация конфигов. В любой команде DevOps — Python как «второй bash».</p>
    </div>
    <div class="card">
      <h3><i data-lucide="database"></i> Data engineering + ETL</h3>
      <p class="text">Airflow, dbt, Prefect. Загрузка данных из десятков источников в хранилище — почти всегда Python-пайплайны.</p>
    </div>
    <div class="card">
      <h3><i data-lucide="cog"></i> Скрипты, парсеры, крон-задачи</h3>
      <p class="text">Beautiful Soup, Scrapy, requests. Небольшие «одноразовые» задачи — почти всегда Python, потому что быстрее написать, чем на любом другом языке.</p>
    </div>
  </div>

  <div class="analogy">
    <strong>Одной фразой:</strong> Python — это <em>PHP без скобок и с отступами вместо <code>{}</code></em>, плюс лучшая экосистема для AI/Data и async-первый веб через FastAPI. Синтаксис читается как псевдокод. Порог входа для PHP-разработчика — 2 недели чтобы стать продуктивным.
  </div>
</div>

<!-- ═══════════════════════════ INSTALL ═══════════════════════════ -->
<div id="sec-install" class="section">
  <div class="section-title">Установка Python + версии + pip</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="download"></i> Что ставить в 2026</div>
    <p class="text">Актуальная стабильная — <strong>Python 3.13</strong> (вышла в 2024). Минимум для нового кода — <strong>3.11</strong> (значительный прирост скорости + улучшенные ошибки). Всё что 3.10 и старше — legacy. <strong>Python 2</strong> мёртв с 2020 — не трогай, если только не поддерживаешь очень старый код.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="apple"></i> macOS</div>
<pre><code><span class="c-comment"># Через Homebrew</span>
brew install python@3.13
python3 --version           <span class="c-comment"># Python 3.13.x</span>

<span class="c-comment"># Или через pyenv — если нужно держать несколько версий</span>
brew install pyenv
pyenv install 3.13.1
pyenv install 3.11.9
pyenv global 3.13.1         <span class="c-comment"># default для системы</span>
pyenv local 3.11.9          <span class="c-comment"># для конкретного проекта (создаст .python-version)</span></code></pre>

    <div class="info-box warning">
      <strong>Системный Python в macOS</strong> (<code>/usr/bin/python3</code>) не трогай — это OS-owned интерпретатор для скриптов Apple. Всегда ставь свой через <code>brew</code> / <code>pyenv</code>.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="terminal"></i> Linux (Ubuntu/Debian)</div>
<pre><code><span class="c-comment"># Ubuntu 24.04 — уже есть Python 3.12 из коробки</span>
python3 --version

<span class="c-comment"># Если нужна другая версия — PPA от deadsnakes</span>
sudo add-apt-repository ppa:deadsnakes/ppa -y
sudo apt update
sudo apt install python3.13 python3.13-venv python3.13-dev -y</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package-2"></i> pip — менеджер пакетов</div>
    <p class="text"><code>pip</code> — Python-аналог <code>composer</code> в PHP или <code>npm</code> в JS. Ставит библиотеки из <a href="https://pypi.org" style="color:var(--primary)">PyPI</a> (Python Package Index).</p>
<pre><code><span class="c-comment"># Установить пакет</span>
pip install requests

<span class="c-comment"># Конкретная версия</span>
pip install django==5.0.1

<span class="c-comment"># Список установленных</span>
pip list

<span class="c-comment"># Заморозить зависимости → requirements.txt</span>
pip freeze &gt; requirements.txt

<span class="c-comment"># Восстановить из requirements.txt</span>
pip install -r requirements.txt

<span class="c-comment"># Обновить сам pip</span>
python -m pip install --upgrade pip</code></pre>

    <div class="pitfall"><strong>⚠ Не ставь пакеты в глобальный Python.</strong> Разные проекты — разные версии зависимостей. Ставь через <a href="#" onclick="showSection('venv', document.querySelector('[onclick*=venv]')); return false;">venv</a> (виртуальные окружения) — это как <code>vendor/</code> в PHP, только на уровне интерпретатора. В Ubuntu 24.04 <code>pip install</code> в глобал вообще запрещён по умолчанию (<code>externally-managed-environment</code>).</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-fork"></i> Мгновенная альтернатива: <code>uv</code></div>
    <p class="text"><code>uv</code> — новый (2024) менеджер от Astral (авторы <code>ruff</code>). Написан на Rust, в 10-100 раз быстрее <code>pip</code>. Заменяет <code>pip</code> + <code>venv</code> + <code>pip-tools</code> одной утилитой. Стандарт де-факто в новых проектах.</p>
<pre><code><span class="c-comment"># Установка</span>
curl -LsSf https://astral.sh/uv/install.sh | sh

<span class="c-comment"># Создать проект</span>
uv init my-app &amp;&amp; cd my-app

<span class="c-comment"># Добавить зависимость (сам создаст venv, обновит pyproject.toml)</span>
uv add fastapi uvicorn

<span class="c-comment"># Запустить</span>
uv run python main.py
uv run uvicorn main:app --reload</code></pre>

    <div class="remember-box">
      <strong>Итог по установке:</strong> ставь Python через <code>brew</code>/<code>pyenv</code> (macOS) или <code>apt</code>/<code>deadsnakes</code> (Linux). Для проектов используй <code>uv</code> в новых, <code>venv</code>+<code>pip</code> в старых. Никогда не ставь пакеты в глобальный интерпретатор.
    </div>
  </div>
</div>

<!-- ═══════════════════════════ SYNTAX ═══════════════════════════ -->
<div id="sec-syntax" class="section">
  <div class="section-title">Синтаксис Python + отступы вместо скобок</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Главное отличие от PHP: <em>отступы</em> вместо <code>{ }</code></div>
    <p class="text">В Python <strong>отступы — часть синтаксиса</strong>. Блок кода определяется одинаковым уровнем отступа. Классические <code>{ }</code> отсутствуют. Стандарт: <strong>4 пробела</strong> (не таб, никогда не смешивай).</p>
<pre><code><span class="c-comment"># Python</span>
<span class="c-key">if</span> user.age &gt;= <span class="c-num">18</span>:
    <span class="c-fn">print</span>(<span class="c-str">"adult"</span>)
    <span class="c-fn">send_email</span>(user)
<span class="c-key">else</span>:
    <span class="c-fn">print</span>(<span class="c-str">"minor"</span>)

<span class="c-comment"># Аналог в PHP</span>
<span class="c-comment"># if ($user-&gt;age &gt;= 18) {</span>
<span class="c-comment">#     echo "adult";</span>
<span class="c-comment">#     send_email($user);</span>
<span class="c-comment"># } else {</span>
<span class="c-comment">#     echo "minor";</span>
<span class="c-comment"># }</span></code></pre>

    <div class="pitfall"><strong>⚠ Смешал tab и spaces</strong> — получишь <code>TabError: inconsistent use of tabs and spaces</code>. Настрой IDE, чтобы Tab превращался в 4 пробела. В PyCharm/VS Code с плагином Python — по умолчанию так.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="type"></i> Переменные — <em>без объявления</em></div>
<pre><code><span class="c-comment"># Просто присваиваем — тип выводится автоматически</span>
name = <span class="c-str">"Alice"</span>       <span class="c-comment"># str</span>
age = <span class="c-num">30</span>              <span class="c-comment"># int</span>
salary = <span class="c-num">1500.50</span>      <span class="c-comment"># float</span>
is_admin = <span class="c-key">True</span>       <span class="c-comment"># bool (с большой буквы!)</span>
tags = [<span class="c-str">"php"</span>, <span class="c-str">"python"</span>]      <span class="c-comment"># list</span>
user = {<span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>, <span class="c-str">"age"</span>: <span class="c-num">30</span>}   <span class="c-comment"># dict</span>

<span class="c-comment"># Constants — просто UPPER_CASE конвенция, языком не защищено</span>
MAX_RETRIES = <span class="c-num">3</span>

<span class="c-comment"># Type hints (опционально, для читаемости и mypy)</span>
name: <span class="c-type">str</span> = <span class="c-str">"Alice"</span>
age: <span class="c-type">int</span> = <span class="c-num">30</span></code></pre>

    <p class="text"><strong>Ключевые отличия от PHP:</strong></p>
    <ul class="bullets">
      <li>Нет <code>$</code> перед именем — просто <code>name</code>, не <code>$name</code>.</li>
      <li><code>True</code>/<code>False</code>/<code>None</code> — <em>с большой буквы</em>. В PHP было <code>true</code>/<code>false</code>/<code>null</code>.</li>
      <li>Нет объявления типа обязательно — можно опционально через <code>:</code> (type hints).</li>
      <li>Констант в языке нет — только конвенция <code>UPPER_CASE</code>. Реальную неизменяемость даёт только <code>Final[int]</code> из <code>typing</code> (проверяется mypy, но не runtime).</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="printer"></i> <code>print()</code> — вывод в консоль</div>
<pre><code><span class="c-fn">print</span>(<span class="c-str">"Hello"</span>)                          <span class="c-comment"># Hello</span>
<span class="c-fn">print</span>(<span class="c-str">"Hello"</span>, name)                    <span class="c-comment"># Hello Alice (через пробел)</span>
<span class="c-fn">print</span>(<span class="c-str">"a"</span>, <span class="c-str">"b"</span>, <span class="c-str">"c"</span>, sep=<span class="c-str">"-"</span>)          <span class="c-comment"># a-b-c</span>
<span class="c-fn">print</span>(<span class="c-str">"no newline"</span>, end=<span class="c-str">""</span>)          <span class="c-comment"># без переноса строки</span>
<span class="c-fn">print</span>(<span class="c-fn">f</span><span class="c-str">"Name: {name}, age: {age}"</span>)      <span class="c-comment"># f-string — интерполяция</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="edit-3"></i> Комментарии</div>
<pre><code><span class="c-comment"># Однострочный (как // в PHP)</span>

<span class="c-str">"""
Многострочный (docstring).
Стандарт для документации функций и классов.
"""</span>

<span class="c-key">def</span> <span class="c-fn">divide</span>(a, b):
    <span class="c-str">"""Делит a на b. Бросает ZeroDivisionError если b == 0."""</span>
    <span class="c-key">return</span> a / b</code></pre>
    <p class="text">Тройные кавычки — не «многострочный комментарий» (такого понятия нет), а обычная строка, которую можно не присваивать. Стандартное использование — как первая строка функции/класса — <em>docstring</em>. IDE и <code>help(func)</code> его показывают.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Операторы — что по-другому</div>
    <table class="data-table">
      <tr><th>PHP</th><th>Python</th><th>Заметка</th></tr>
      <tr><td><code>.</code> (конкатенация)</td><td><code>+</code></td><td><code>"a" + "b"</code>. Только для одинаковых типов — <code>"a" + 1</code> упадёт.</td></tr>
      <tr><td><code>===</code>, <code>!==</code></td><td><code>==</code>, <code>!=</code></td><td>В Python нет loose comparison — обычные операторы уже строгие</td></tr>
      <tr><td><code>&amp;&amp;</code>, <code>||</code>, <code>!</code></td><td><code>and</code>, <code>or</code>, <code>not</code></td><td>Буквенные ключевые слова</td></tr>
      <tr><td><code>/</code> (int div)</td><td><code>//</code></td><td><code>7 // 2 == 3</code>. Обычный <code>/</code> всегда возвращает float: <code>7 / 2 == 3.5</code></td></tr>
      <tr><td><code>**</code> (power)</td><td><code>**</code></td><td><code>2 ** 10 == 1024</code></td></tr>
      <tr><td><code>%</code> (mod)</td><td><code>%</code></td><td>Так же</td></tr>
      <tr><td>—</td><td><code>in</code></td><td><code>"a" in ["a", "b"]</code> → <code>True</code>. Работает для list/dict/str/set</td></tr>
      <tr><td>—</td><td><code>is</code></td><td>Сравнение по идентичности (тот же объект). <code>a is None</code> — правильная проверка на None</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-check"></i> Truthy / falsy</div>
    <p class="text">В Python «пустое» = <code>False</code>:</p>
<pre><code><span class="c-key">if not</span> users:                <span class="c-comment"># True если users — пустой list, dict, str, 0, None, False</span>
    <span class="c-fn">print</span>(<span class="c-str">"nothing to do"</span>)

<span class="c-comment"># Явно проверить на None (правильный питонический способ)</span>
<span class="c-key">if</span> user <span class="c-key">is not None</span>:
    ...</code></pre>

    <div class="pitfall"><strong>⚠ <code>if x == None</code> — работает, но не питонично.</strong> Правильно: <code>if x is None</code>. Причина: <code>is</code> сравнивает идентичность (быстрее и точнее для singletons), <code>None</code> — синглтон.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="terminal"></i> Первая программа</div>
<pre><code><span class="c-comment"># hello.py</span>
<span class="c-key">def</span> <span class="c-fn">main</span>():
    name = <span class="c-fn">input</span>(<span class="c-str">"Твоё имя: "</span>)
    <span class="c-fn">print</span>(<span class="c-fn">f</span><span class="c-str">"Привет, {name}!"</span>)

<span class="c-key">if</span> __name__ == <span class="c-str">"__main__"</span>:
    <span class="c-fn">main</span>()</code></pre>
<pre><code>$ python hello.py
Твоё имя: Санжар
Привет, Санжар!</code></pre>

    <p class="text">Конструкция <code>if __name__ == "__main__":</code> — <em>питонический шаблон</em>. Она выполняется, только когда файл запущен напрямую как скрипт, но не при <code>import</code>. Подробнее — в секции <a href="#" onclick="showSection('modules', document.querySelector('[onclick*=modules]')); return false;">Модули + импорты</a>.</p>
  </div>
</div>

<!-- ═══════════════════════════ TYPES ═══════════════════════════ -->
<div id="sec-types" class="section">
  <div class="section-title">Типы данных Python</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> 7 базовых типов + их PHP-аналоги</div>
    <table class="data-table">
      <tr><th>Python</th><th>Пример</th><th>PHP-аналог</th></tr>
      <tr><td><code>int</code></td><td><code>42</code></td><td><code>int</code></td></tr>
      <tr><td><code>float</code></td><td><code>3.14</code></td><td><code>float</code></td></tr>
      <tr><td><code>str</code></td><td><code>"hello"</code></td><td><code>string</code></td></tr>
      <tr><td><code>bool</code></td><td><code>True</code> / <code>False</code></td><td><code>bool</code></td></tr>
      <tr><td><code>None</code></td><td><code>None</code></td><td><code>null</code></td></tr>
      <tr><td><code>list</code></td><td><code>[1, 2, 3]</code></td><td>Индексированный <code>array</code></td></tr>
      <tr><td><code>tuple</code></td><td><code>(1, 2, 3)</code></td><td>Неизменяемый <code>array</code> (нет прямого аналога)</td></tr>
      <tr><td><code>dict</code></td><td><code>{"a": 1, "b": 2}</code></td><td>Ассоциативный <code>array</code></td></tr>
      <tr><td><code>set</code></td><td><code>{1, 2, 3}</code></td><td>Нет прямого — используют <code>array_unique</code></td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list-ordered"></i> <code>list</code> — упорядоченный, изменяемый</div>
<pre><code>users = [<span class="c-str">"alice"</span>, <span class="c-str">"bob"</span>, <span class="c-str">"charlie"</span>]

<span class="c-comment"># Доступ по индексу</span>
users[<span class="c-num">0</span>]                          <span class="c-comment"># "alice"</span>
users[-<span class="c-num">1</span>]                         <span class="c-comment"># "charlie" (с конца)</span>

<span class="c-comment"># Slicing — срезы</span>
users[<span class="c-num">1</span>:<span class="c-num">3</span>]                        <span class="c-comment"># ["bob", "charlie"]</span>
users[:<span class="c-num">2</span>]                         <span class="c-comment"># ["alice", "bob"]</span>
users[::<span class="c-num">2</span>]                        <span class="c-comment"># каждый второй → ["alice", "charlie"]</span>
users[::-<span class="c-num">1</span>]                       <span class="c-comment"># reverse</span>

<span class="c-comment"># Модификация</span>
users.<span class="c-fn">append</span>(<span class="c-str">"dave"</span>)              <span class="c-comment"># в конец</span>
users.<span class="c-fn">insert</span>(<span class="c-num">0</span>, <span class="c-str">"zoe"</span>)           <span class="c-comment"># в начало</span>
users.<span class="c-fn">remove</span>(<span class="c-str">"bob"</span>)              <span class="c-comment"># удалить по значению</span>
<span class="c-key">del</span> users[<span class="c-num">0</span>]                     <span class="c-comment"># удалить по индексу</span>
users.<span class="c-fn">pop</span>()                        <span class="c-comment"># удалить и вернуть последний</span>

<span class="c-comment"># Проверка</span>
<span class="c-str">"alice"</span> <span class="c-key">in</span> users                 <span class="c-comment"># True</span>
<span class="c-fn">len</span>(users)                       <span class="c-comment"># 3</span>

<span class="c-comment"># Сортировка</span>
users.<span class="c-fn">sort</span>()                       <span class="c-comment"># in-place, вернёт None</span>
<span class="c-fn">sorted</span>(users)                    <span class="c-comment"># возвращает НОВЫЙ отсортированный, не меняет</span>
<span class="c-fn">sorted</span>(users, reverse=<span class="c-key">True</span>)</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="lock"></i> <code>tuple</code> — упорядоченный, <em>неизменяемый</em></div>
<pre><code>coords = (<span class="c-num">55.75</span>, <span class="c-num">37.61</span>)
x, y = coords                     <span class="c-comment"># unpacking — очень частый паттерн</span>

<span class="c-comment"># Неизменяемый:</span>
coords[<span class="c-num">0</span>] = <span class="c-num">99</span>                    <span class="c-comment"># TypeError</span>

<span class="c-comment"># Функции часто возвращают tuple — сразу распаковываем:</span>
name, age = <span class="c-fn">get_user</span>()

<span class="c-comment"># Именованные — namedtuple (легковесная замена классу)</span>
<span class="c-key">from</span> collections <span class="c-key">import</span> namedtuple
<span class="c-type">Point</span> = <span class="c-fn">namedtuple</span>(<span class="c-str">"Point"</span>, [<span class="c-str">"x"</span>, <span class="c-str">"y"</span>])
p = <span class="c-type">Point</span>(<span class="c-num">1</span>, <span class="c-num">2</span>)
<span class="c-fn">print</span>(p.x, p.y)                   <span class="c-comment"># 1 2</span></code></pre>

    <p class="text"><strong>Зачем tuple, если есть list:</strong> tuple немного быстрее, может быть ключом словаря (list — нельзя), и семантически говорит «эти данные вместе, порядок фиксирован» (координаты, RGB-цвет, дата разбитая на y/m/d).</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="braces"></i> <code>dict</code> — ассоциативный массив (hash map)</div>
<pre><code>user = {
    <span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>,
    <span class="c-str">"age"</span>: <span class="c-num">30</span>,
    <span class="c-str">"roles"</span>: [<span class="c-str">"admin"</span>, <span class="c-str">"editor"</span>],
}

<span class="c-comment"># Доступ</span>
user[<span class="c-str">"name"</span>]                      <span class="c-comment"># "Alice"</span>
user[<span class="c-str">"phone"</span>]                     <span class="c-comment"># KeyError!</span>
user.<span class="c-fn">get</span>(<span class="c-str">"phone"</span>)                <span class="c-comment"># None — безопасно</span>
user.<span class="c-fn">get</span>(<span class="c-str">"phone"</span>, <span class="c-str">"unknown"</span>)     <span class="c-comment"># дефолт если нет</span>

<span class="c-comment"># Модификация</span>
user[<span class="c-str">"email"</span>] = <span class="c-str">"a@b.c"</span>          <span class="c-comment"># добавили</span>
<span class="c-key">del</span> user[<span class="c-str">"age"</span>]                 <span class="c-comment"># удалили</span>

<span class="c-comment"># Обход</span>
<span class="c-key">for</span> key <span class="c-key">in</span> user:                  <span class="c-comment"># обход ключей</span>
    <span class="c-fn">print</span>(key, user[key])
<span class="c-key">for</span> key, value <span class="c-key">in</span> user.<span class="c-fn">items</span>():  <span class="c-comment"># pythonic — пара сразу</span>
    <span class="c-fn">print</span>(key, value)
<span class="c-key">for</span> value <span class="c-key">in</span> user.<span class="c-fn">values</span>():
    <span class="c-fn">print</span>(value)

<span class="c-comment"># Слияние — Python 3.9+</span>
merged = defaults | overrides     <span class="c-comment"># справа побеждает</span>

<span class="c-comment"># Проверка ключа</span>
<span class="c-str">"name"</span> <span class="c-key">in</span> user                  <span class="c-comment"># True — работает по ключам</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="circle"></i> <code>set</code> — множество без дубликатов</div>
<pre><code>tags = {<span class="c-str">"php"</span>, <span class="c-str">"python"</span>, <span class="c-str">"js"</span>, <span class="c-str">"php"</span>}
<span class="c-fn">print</span>(tags)                       <span class="c-comment"># {"php", "python", "js"} — дубликат ушёл</span>

<span class="c-comment"># Операции над множествами (математические!)</span>
a = {<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>}
b = {<span class="c-num">2</span>, <span class="c-num">3</span>, <span class="c-num">4</span>}
a | b                             <span class="c-comment"># объединение → {1, 2, 3, 4}</span>
a &amp; b                             <span class="c-comment"># пересечение → {2, 3}</span>
a - b                             <span class="c-comment"># разность → {1}</span>
a ^ b                             <span class="c-comment"># симметрическая разность → {1, 4}</span>

<span class="c-comment"># Убрать дубликаты из списка</span>
unique_users = <span class="c-fn">list</span>(<span class="c-fn">set</span>(users))</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="repeat-1"></i> Изменяемость (mutable vs immutable)</div>
    <table class="data-table">
      <tr><th>Тип</th><th>Изменяемый?</th></tr>
      <tr><td><code>int</code>, <code>float</code>, <code>str</code>, <code>bool</code>, <code>None</code>, <code>tuple</code>, <code>frozenset</code></td><td>❌ Immutable</td></tr>
      <tr><td><code>list</code>, <code>dict</code>, <code>set</code></td><td>✅ Mutable</td></tr>
    </table>
    <p class="text">Immutable-объекты нельзя менять «на месте» — методы возвращают <em>новую</em> копию. У str: <code>s.upper()</code> вернёт новую строку, оригинал не тронется. Это как в PHP: str — value type.</p>

    <div class="pitfall"><strong>⚠ Классический баг: mutable default argument.</strong>
<pre style="margin-top:6px"><code><span class="c-key">def</span> <span class="c-fn">add_item</span>(item, items=[]):    <span class="c-comment"># ← []  создаётся ОДИН раз при определении функции!</span>
    items.<span class="c-fn">append</span>(item)
    <span class="c-key">return</span> items

<span class="c-fn">add_item</span>(<span class="c-str">"a"</span>)   <span class="c-comment"># ["a"]</span>
<span class="c-fn">add_item</span>(<span class="c-str">"b"</span>)   <span class="c-comment"># ["a", "b"] !!! копится между вызовами</span></code></pre>
      Правильно: <code>items=None</code> и внутри <code>if items is None: items = []</code>.
    </div>
  </div>
</div>

<!-- ═══════════════════════════ PYTHON VS PHP ═══════════════════════════ -->
<div id="sec-python-vs-php" class="section">
  <div class="section-title">Python vs PHP — мосты для перехода</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare-arrows"></i> Основные соответствия</div>
    <table class="data-table">
      <tr><th>PHP</th><th>Python</th><th>Комментарий</th></tr>
      <tr><td><code>&lt;?php</code></td><td>Ничего</td><td>Python-файл — сразу код, без открывающего тега</td></tr>
      <tr><td><code>$name</code></td><td><code>name</code></td><td>Без <code>$</code></td></tr>
      <tr><td><code>echo</code>, <code>print</code></td><td><code>print()</code></td><td>Функция, всегда со скобками</td></tr>
      <tr><td><code>{ ... }</code></td><td>Отступы (4 пробела)</td><td>Отступ — часть синтаксиса</td></tr>
      <tr><td><code>;</code> в конце</td><td>—</td><td>Не нужен</td></tr>
      <tr><td><code>true</code>/<code>false</code>/<code>null</code></td><td><code>True</code>/<code>False</code>/<code>None</code></td><td>С большой буквы!</td></tr>
      <tr><td><code>&amp;&amp;</code>, <code>||</code>, <code>!</code></td><td><code>and</code>, <code>or</code>, <code>not</code></td><td>Буквенные</td></tr>
      <tr><td><code>.</code> (concat)</td><td><code>+</code></td><td>Только для одинаковых типов</td></tr>
      <tr><td><code>foreach ($arr as $v)</code></td><td><code>for v in arr:</code></td><td>Прямой обход значений</td></tr>
      <tr><td><code>foreach ($arr as $k =&gt; $v)</code></td><td><code>for k, v in arr.items():</code></td><td>Для dict — метод <code>.items()</code></td></tr>
      <tr><td><code>function</code></td><td><code>def</code></td><td></td></tr>
      <tr><td><code>use</code>, <code>namespace</code></td><td><code>import</code>, <code>from ... import</code></td><td></td></tr>
      <tr><td><code>class Foo extends Bar</code></td><td><code>class Foo(Bar):</code></td><td>Скобки вместо <code>extends</code></td></tr>
      <tr><td><code>$this-&gt;name</code></td><td><code>self.name</code></td><td><code>self</code> — первый аргумент метода <em>явно</em></td></tr>
      <tr><td><code>__construct</code></td><td><code>__init__</code></td><td></td></tr>
      <tr><td><code>const FOO = 1</code></td><td><code>FOO = 1</code> (конвенция)</td><td>Реальных констант нет</td></tr>
      <tr><td><code>?string $name</code></td><td><code>name: str | None</code></td><td>Type hints</td></tr>
      <tr><td><code>array_map</code></td><td>list comprehension / <code>map()</code></td><td><code>[x*2 for x in arr]</code></td></tr>
      <tr><td><code>array_filter</code></td><td>list comprehension</td><td><code>[x for x in arr if x &gt; 0]</code></td></tr>
      <tr><td><code>compact('user')</code></td><td><code>{"user": user}</code></td><td>Аналога нет — dict вручную</td></tr>
      <tr><td><code>json_encode</code>, <code>json_decode</code></td><td><code>json.dumps</code>, <code>json.loads</code></td><td>Из stdlib <code>import json</code></td></tr>
      <tr><td><code>composer</code></td><td><code>pip</code> / <code>uv</code> / <code>poetry</code></td><td></td></tr>
      <tr><td><code>vendor/</code></td><td><code>.venv/</code> или <code>site-packages/</code></td><td></td></tr>
      <tr><td><code>composer.json</code></td><td><code>requirements.txt</code> / <code>pyproject.toml</code></td><td></td></tr>
      <tr><td><code>artisan</code></td><td><code>manage.py</code> (Django) / скрипты</td><td></td></tr>
      <tr><td>Laravel</td><td>Django (batteries included) / FastAPI (микро+async)</td><td></td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Что <em>серьёзно</em> отличается</div>
    <div class="card">
      <h3>1. Всё — объект, всё передаётся по <em>ссылке на объект</em></h3>
      <p class="text">В PHP массив передаётся <em>по значению</em> (копируется). В Python <code>list</code> и <code>dict</code> — mutable объекты, передаются как ссылки. Функция может <em>изменить</em> исходный список. Похоже на объекты в PHP, но касается вообще всех collections.</p>
    </div>
    <div class="card">
      <h3>2. Асинхронность — первого класса</h3>
      <p class="text">В PHP <code>async/await</code> — экзотика (Swoole, ReactPHP). В Python — стандарт стандартной библиотеки: <code>asyncio</code>, <code>aiohttp</code>, FastAPI полностью на нём построен. Изучить сразу, если планируешь микросервисы.</p>
    </div>
    <div class="card">
      <h3>3. Type hints — опциональные, но важные</h3>
      <p class="text">В PHP 7.4+ типы обязательны для сериозного кода. В Python — <em>опциональны</em>, работают через отдельный tool (<code>mypy</code>), рантайм их игнорирует. Но в новом коде почти всегда пишут — читаемость и IDE-подсказки в разы лучше.</p>
    </div>
    <div class="card">
      <h3>4. Duck typing и «easier to ask forgiveness than permission»</h3>
      <p class="text">В PHP чаще проверяют «есть ли метод» через <code>method_exists</code>. В Python — идиома «просто вызови, и обработай исключение». <code>try: obj.method(); except AttributeError: ...</code>. Это питонично.</p>
    </div>
    <div class="card">
      <h3>5. Один способ сделать вещь</h3>
      <p class="text">Zen of Python: «There should be one — and preferably only one — obvious way to do it». В PHP часто 3-4 способа (<code>array_map</code> / <code>foreach</code> / <code>array_walk</code>). В Python — почти всегда один канонический (list comprehension), остальные — «можно, но обычно не нужно».</p>
    </div>
    <div class="card">
      <h3>6. Многопоточность и GIL</h3>
      <p class="text">У Python есть Global Interpreter Lock (GIL) — только один поток выполняет Python-код в один момент. Для CPU-bound нагрузки → <code>multiprocessing</code> (отдельные процессы). Для I/O-bound → <code>asyncio</code>. С Python 3.13+ GIL постепенно ослабляется, но пока правило работает.</p>
    </div>
  </div>

  <div class="remember-box">
    <strong>Стратегия перехода PHP→Python:</strong> первую неделю — синтаксис, list/dict/comprehensions. Вторую — ООП, модули, venv. Третью — сделать что-то полезное на FastAPI + PostgreSQL. Дальше уже глубина: async, type hints, тестирование. За месяц становишься продуктивным.
  </div>
</div>

<!-- ═══════════════════════════ STUB SECTIONS ═══════════════════════════ -->

<div id="sec-strings" class="section">
  <div class="section-title">Строки + f-strings + regex</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="type"></i> Литералы строк</div>
<pre><code>a = <span class="c-str">"hello"</span>              <span class="c-comment"># двойные</span>
b = <span class="c-str">'hello'</span>              <span class="c-comment"># одинарные — эквивалентны</span>
c = <span class="c-str">"""multi
line string"""</span>          <span class="c-comment"># тройные — многострочная</span>
d = <span class="c-str">r"C:\path\file"</span>     <span class="c-comment"># raw — не экранирует \n \t \</span>
e = <span class="c-str">b"bytes"</span>             <span class="c-comment"># bytes (не str)</span>
f = <span class="c-fn">f</span><span class="c-str">"Hi {name}"</span>         <span class="c-comment"># f-string — интерполяция</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="sparkles"></i> f-strings — стандарт (Python 3.6+)</div>
<pre><code>name = <span class="c-str">"Alice"</span>
age = <span class="c-num">30</span>
price = <span class="c-num">1234.5678</span>

<span class="c-fn">f</span><span class="c-str">"Hi, {name}!"</span>                       <span class="c-comment"># "Hi, Alice!"</span>
<span class="c-fn">f</span><span class="c-str">"{name} is {age} years old"</span>          <span class="c-comment"># подстановка нескольких</span>
<span class="c-fn">f</span><span class="c-str">"{name.upper()}"</span>                    <span class="c-comment"># выражения — не только имена</span>
<span class="c-fn">f</span><span class="c-str">"total: {a + b}"</span>                    <span class="c-comment"># арифметика внутри</span>

<span class="c-comment"># Форматирование</span>
<span class="c-fn">f</span><span class="c-str">"{price:.2f}"</span>                       <span class="c-comment"># "1234.57" — округление до 2</span>
<span class="c-fn">f</span><span class="c-str">"{price:,.2f}"</span>                      <span class="c-comment"># "1,234.57" — с разделителем</span>
<span class="c-fn">f</span><span class="c-str">"{price:10.2f}"</span>                     <span class="c-comment"># "   1234.57" — ширина 10, padding</span>
<span class="c-fn">f</span><span class="c-str">"{price:&gt;10}"</span>                       <span class="c-comment"># выравнивание вправо</span>
<span class="c-fn">f</span><span class="c-str">"{price:&lt;10}"</span>                       <span class="c-comment"># влево</span>
<span class="c-fn">f</span><span class="c-str">"{price:^10}"</span>                       <span class="c-comment"># по центру</span>
<span class="c-fn">f</span><span class="c-str">"{age:03d}"</span>                         <span class="c-comment"># "030" — паддинг нулями</span>
<span class="c-fn">f</span><span class="c-str">"{price:.0%}"</span>                       <span class="c-comment"># проценты</span>
<span class="c-fn">f</span><span class="c-str">"{now:%Y-%m-%d %H:%M}"</span>              <span class="c-comment"># дата (datetime)</span>

<span class="c-comment"># Debug (Python 3.8+) — печатает имя + значение</span>
<span class="c-fn">f</span><span class="c-str">"{name=}"</span>                            <span class="c-comment"># "name='Alice'"</span>
<span class="c-fn">f</span><span class="c-str">"{price=:.2f}"</span>                      <span class="c-comment"># "price=1234.57"</span>

<span class="c-comment"># repr vs str внутри f-string</span>
<span class="c-fn">f</span><span class="c-str">"{name!r}"</span>                          <span class="c-comment"># "'Alice'" — через repr()</span>
<span class="c-fn">f</span><span class="c-str">"{name!s}"</span>                          <span class="c-comment"># "Alice"</span></code></pre>

    <div class="info-box success">
      <strong>Правило:</strong> в новом коде — только f-strings. <code>.format()</code> и <code>%</code>-форматирование — устаревшее, встречается только в legacy. f-strings быстрее (в 2-3 раза), читаемее, поддерживают все выражения.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="wrench"></i> Основные методы <code>str</code></div>
    <table class="data-table">
      <tr><th>Метод</th><th>Что делает</th><th>Пример</th></tr>
      <tr><td><code>.upper()</code>, <code>.lower()</code>, <code>.title()</code>, <code>.capitalize()</code></td><td>Регистр</td><td><code>"hello".upper()</code> → <code>"HELLO"</code></td></tr>
      <tr><td><code>.strip()</code>, <code>.lstrip()</code>, <code>.rstrip()</code></td><td>Убрать whitespace (или указанные символы)</td><td><code>"  hi  ".strip()</code> → <code>"hi"</code></td></tr>
      <tr><td><code>.split(sep)</code></td><td>Разбить на list по разделителю</td><td><code>"a,b,c".split(",")</code> → <code>["a","b","c"]</code></td></tr>
      <tr><td><code>sep.join(iterable)</code></td><td>Собрать iterable в строку</td><td><code>",".join(["a","b"])</code> → <code>"a,b"</code></td></tr>
      <tr><td><code>.replace(old, new)</code></td><td>Заменить подстроку</td><td><code>"a-b".replace("-", "_")</code></td></tr>
      <tr><td><code>.startswith(x)</code>, <code>.endswith(x)</code></td><td>Проверка префикса/суффикса</td><td><code>"file.jpg".endswith(".jpg")</code></td></tr>
      <tr><td><code>.find(x)</code>, <code>.index(x)</code></td><td>Позиция первого вхождения (find → -1, index → ValueError)</td><td><code>"hello".find("l")</code> → <code>2</code></td></tr>
      <tr><td><code>x in string</code></td><td>Проверка вхождения</td><td><code>"lo" in "hello"</code> → <code>True</code></td></tr>
      <tr><td><code>.count(x)</code></td><td>Число вхождений</td><td><code>"aaa".count("a")</code> → <code>3</code></td></tr>
      <tr><td><code>.isdigit()</code>, <code>.isalpha()</code>, <code>.isalnum()</code></td><td>Проверка типа</td><td><code>"123".isdigit()</code> → <code>True</code></td></tr>
      <tr><td><code>.zfill(n)</code>, <code>.center(n)</code>, <code>.ljust(n)</code>, <code>.rjust(n)</code></td><td>Паддинг</td><td><code>"5".zfill(3)</code> → <code>"005"</code></td></tr>
      <tr><td><code>.splitlines()</code></td><td>Разбить по \n / \r\n</td><td>Кросс-платформенно</td></tr>
      <tr><td><code>.encode(enc)</code></td><td>str → bytes</td><td><code>"hi".encode("utf-8")</code></td></tr>
    </table>

    <p class="text"><strong>Все методы возвращают НОВУЮ строку</strong> — str immutable. <code>s.upper()</code> не меняет <code>s</code>, а возвращает новую.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="scissors"></i> Slicing (срезы)</div>
<pre><code>s = <span class="c-str">"hello world"</span>

s[<span class="c-num">0</span>]                    <span class="c-comment"># "h"</span>
s[-<span class="c-num">1</span>]                   <span class="c-comment"># "d"</span>
s[<span class="c-num">0</span>:<span class="c-num">5</span>]                  <span class="c-comment"># "hello"</span>
s[:<span class="c-num">5</span>]                   <span class="c-comment"># "hello" — с начала</span>
s[<span class="c-num">6</span>:]                   <span class="c-comment"># "world" — до конца</span>
s[::-<span class="c-num">1</span>]                 <span class="c-comment"># "dlrow olleh" — reverse</span>
s[::<span class="c-num">2</span>]                  <span class="c-comment"># "hlowrd" — каждый второй</span>
<span class="c-fn">len</span>(s)                 <span class="c-comment"># 11</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="regex"></i> Regex — модуль <code>re</code></div>
<pre><code><span class="c-key">import</span> re

<span class="c-comment"># Основные функции</span>
re.<span class="c-fn">search</span>(pattern, string)     <span class="c-comment"># найти первое → Match | None</span>
re.<span class="c-fn">match</span>(pattern, string)      <span class="c-comment"># только с НАЧАЛА строки</span>
re.<span class="c-fn">fullmatch</span>(pattern, string)  <span class="c-comment"># вся строка целиком</span>
re.<span class="c-fn">findall</span>(pattern, string)    <span class="c-comment"># все совпадения → list</span>
re.<span class="c-fn">finditer</span>(pattern, string)   <span class="c-comment"># все → iterator Match'ей (для больших текстов)</span>
re.<span class="c-fn">sub</span>(pattern, repl, string)  <span class="c-comment"># замена</span>
re.<span class="c-fn">split</span>(pattern, string)     <span class="c-comment"># split по regex</span>

<span class="c-comment"># Пример: проверить email</span>
<span class="c-key">if</span> re.<span class="c-fn">fullmatch</span>(<span class="c-fn">r</span><span class="c-str">"[\w.+-]+@[\w-]+\.[\w.-]+"</span>, email):
    <span class="c-fn">print</span>(<span class="c-str">"looks like email"</span>)

<span class="c-comment"># Захват групп</span>
m = re.<span class="c-fn">search</span>(<span class="c-fn">r</span><span class="c-str">"(\d+)-(\d+)"</span>, <span class="c-str">"order 42-100"</span>)
<span class="c-key">if</span> m:
    <span class="c-fn">print</span>(m.<span class="c-fn">group</span>(<span class="c-num">0</span>))         <span class="c-comment"># "42-100" — вся сматченная строка</span>
    <span class="c-fn">print</span>(m.<span class="c-fn">group</span>(<span class="c-num">1</span>))         <span class="c-comment"># "42"</span>
    <span class="c-fn">print</span>(m.<span class="c-fn">group</span>(<span class="c-num">2</span>))         <span class="c-comment"># "100"</span>
    <span class="c-fn">print</span>(m.<span class="c-fn">groups</span>())         <span class="c-comment"># ("42", "100")</span>

<span class="c-comment"># Именованные группы</span>
m = re.<span class="c-fn">search</span>(<span class="c-fn">r</span><span class="c-str">"(?P&lt;year&gt;\d{4})-(?P&lt;month&gt;\d{2})"</span>, <span class="c-str">"2026-09"</span>)
m.<span class="c-fn">group</span>(<span class="c-str">"year"</span>)              <span class="c-comment"># "2026"</span>

<span class="c-comment"># Компиляция для повторного использования (быстрее)</span>
EMAIL_RE = re.<span class="c-fn">compile</span>(<span class="c-fn">r</span><span class="c-str">"[\w.+-]+@[\w-]+\.[\w.-]+"</span>)
EMAIL_RE.<span class="c-fn">fullmatch</span>(email)</code></pre>

    <div class="info-box primary">
      <strong>Правило:</strong> паттерны — всегда <em>raw strings</em> (<code>r"..."</code>), иначе <code>\d</code>, <code>\s</code>, <code>\n</code> будут интерпретироваться Python-ом до regex-движка. Флаг <code>re.IGNORECASE</code> для case-insensitive, <code>re.MULTILINE</code> — <code>^</code>/<code>$</code> на каждой строке.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="binary"></i> str vs bytes — кодировки</div>
    <p class="text">В Python 3 <code>str</code> — это <strong>Unicode</strong> (последовательность code point'ов). <code>bytes</code> — <strong>сырые байты</strong>. Между ними — явная конвертация через кодировку.</p>
<pre><code>s = <span class="c-str">"Привет"</span>                    <span class="c-comment"># str (unicode)</span>
b = s.<span class="c-fn">encode</span>(<span class="c-str">"utf-8"</span>)             <span class="c-comment"># bytes: b'\xd0\x9f\xd1\x80\xd0\xb8...'</span>
s2 = b.<span class="c-fn">decode</span>(<span class="c-str">"utf-8"</span>)            <span class="c-comment"># обратно в str</span>

<span class="c-comment"># Файлы</span>
<span class="c-key">with</span> <span class="c-fn">open</span>(<span class="c-str">"file.txt"</span>, encoding=<span class="c-str">"utf-8"</span>) <span class="c-key">as</span> f:  <span class="c-comment"># явно всегда utf-8</span>
    text = f.<span class="c-fn">read</span>()

<span class="c-comment"># Бинарные — bytes</span>
<span class="c-key">with</span> <span class="c-fn">open</span>(<span class="c-str">"image.png"</span>, <span class="c-str">"rb"</span>) <span class="c-key">as</span> f:
    data = f.<span class="c-fn">read</span>()             <span class="c-comment"># bytes</span></code></pre>

    <div class="pitfall"><strong>⚠ Никогда не полагайся на дефолтный encoding.</strong> <code>open("f.txt")</code> без явного <code>encoding="utf-8"</code> — на Windows возьмёт cp1251, на Linux — utf-8. Один и тот же код будет ломаться на разных ОС.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Конкатенация <code>+</code> в цикле — медленно.</strong> Каждый <code>+</code> создаёт новую строку. Для N-строк — <code>"".join(list_of_strings)</code>, работает за O(n) вместо O(n²).</div>
    <div class="pitfall"><strong>2. <code>.replace()</code> не regex.</strong> Убрать все пробелы — <code>s.replace(" ", "")</code>; но убрать любые whitespace — <code>re.sub(r"\s+", "", s)</code>.</div>
    <div class="pitfall"><strong>3. Split пустой строки.</strong> <code>"".split(",")</code> → <code>[""]</code>, не <code>[]</code>. Проверяй <code>if s</code> перед split.</div>
    <div class="pitfall"><strong>4. <code>str.format()</code> с dict — точки не работают.</strong> <code>"{d.name}".format(d=obj)</code> — обращение по атрибуту, не по ключу dict. Используй f-string.</div>
    <div class="pitfall"><strong>5. Regex без raw string.</strong> <code>"\d+"</code> в Python 3.12+ выдаёт <code>DeprecationWarning</code>. Всегда <code>r"\d+"</code>.</div>
  </div>
</div>

<div id="sec-control" class="section">
  <div class="section-title">Условия + циклы + match/case</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-branch"></i> if / elif / else + тернарник</div>
<pre><code><span class="c-key">if</span> age &gt;= <span class="c-num">18</span>:
    status = <span class="c-str">"adult"</span>
<span class="c-key">elif</span> age &gt;= <span class="c-num">13</span>:
    status = <span class="c-str">"teen"</span>
<span class="c-key">else</span>:
    status = <span class="c-str">"child"</span>

<span class="c-comment"># Тернарник: value_if_true if condition else value_if_false</span>
status = <span class="c-str">"adult"</span> <span class="c-key">if</span> age &gt;= <span class="c-num">18</span> <span class="c-key">else</span> <span class="c-str">"minor"</span>

<span class="c-comment"># Не путать с C-style — синтаксис Python другой:</span>
<span class="c-comment"># ❌ status = age &gt;= 18 ? "adult" : "minor"   — SyntaxError</span>

<span class="c-comment"># Chained comparisons — красивая питоническая фича</span>
<span class="c-key">if</span> <span class="c-num">18</span> &lt;= age &lt; <span class="c-num">65</span>:                <span class="c-comment"># эквивалент age &gt;= 18 and age &lt; 65</span>
    ...

<span class="c-comment"># Walrus operator := (Python 3.8+) — присвоить внутри выражения</span>
<span class="c-key">if</span> (n := <span class="c-fn">len</span>(items)) &gt; <span class="c-num">10</span>:
    <span class="c-fn">print</span>(<span class="c-fn">f</span><span class="c-str">"too many: {n}"</span>)</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="repeat"></i> Циклы <code>for</code> и <code>while</code></div>
<pre><code><span class="c-comment"># for — обход iterable (list/tuple/dict/str/set/generator)</span>
<span class="c-key">for</span> user <span class="c-key">in</span> users:
    <span class="c-fn">print</span>(user)

<span class="c-comment"># range(start, stop, step)</span>
<span class="c-key">for</span> i <span class="c-key">in</span> <span class="c-fn">range</span>(<span class="c-num">10</span>):           <span class="c-comment"># 0..9</span>
    ...
<span class="c-key">for</span> i <span class="c-key">in</span> <span class="c-fn">range</span>(<span class="c-num">1</span>, <span class="c-num">11</span>):        <span class="c-comment"># 1..10</span>
    ...
<span class="c-key">for</span> i <span class="c-key">in</span> <span class="c-fn">range</span>(<span class="c-num">0</span>, <span class="c-num">100</span>, <span class="c-num">10</span>):    <span class="c-comment"># 0, 10, 20, ..., 90</span>
    ...

<span class="c-comment"># while — пока условие true</span>
<span class="c-key">while</span> queue:
    task = queue.<span class="c-fn">pop</span>()
    <span class="c-fn">process</span>(task)

<span class="c-comment"># break / continue — как везде</span>
<span class="c-key">for</span> item <span class="c-key">in</span> items:
    <span class="c-key">if</span> item.is_bad:
        <span class="c-key">continue</span>
    <span class="c-key">if</span> item.is_stop:
        <span class="c-key">break</span>
    <span class="c-fn">process</span>(item)</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list-checks"></i> Питонические паттерны обхода</div>
<pre><code><span class="c-comment"># enumerate — индекс + значение</span>
<span class="c-key">for</span> i, user <span class="c-key">in</span> <span class="c-fn">enumerate</span>(users):
    <span class="c-fn">print</span>(<span class="c-fn">f</span><span class="c-str">"{i}: {user}"</span>)

<span class="c-key">for</span> i, user <span class="c-key">in</span> <span class="c-fn">enumerate</span>(users, start=<span class="c-num">1</span>):    <span class="c-comment"># с 1</span>
    ...

<span class="c-comment"># zip — параллельный обход двух iterables</span>
names = [<span class="c-str">"Alice"</span>, <span class="c-str">"Bob"</span>]
ages  = [<span class="c-num">30</span>, <span class="c-num">25</span>]
<span class="c-key">for</span> name, age <span class="c-key">in</span> <span class="c-fn">zip</span>(names, ages):
    <span class="c-fn">print</span>(name, age)

<span class="c-comment"># dict — .items(), .keys(), .values()</span>
<span class="c-key">for</span> key, value <span class="c-key">in</span> user.<span class="c-fn">items</span>():
    ...

<span class="c-comment"># reversed — обход в обратном порядке</span>
<span class="c-key">for</span> item <span class="c-key">in</span> <span class="c-fn">reversed</span>(items):
    ...

<span class="c-comment"># sorted — обход отсортированного</span>
<span class="c-key">for</span> user <span class="c-key">in</span> <span class="c-fn">sorted</span>(users, key=<span class="c-key">lambda</span> u: u.age):
    ...</code></pre>

    <div class="pitfall"><strong>⚠ Не используй <code>for i in range(len(items))</code></strong> — это анти-паттерн. Питонично:
      <ul style="margin-top:6px">
        <li>нужно только значение → <code>for item in items</code></li>
        <li>нужен индекс + значение → <code>for i, item in enumerate(items)</code></li>
        <li>обход двух списков — <code>for a, b in zip(list1, list2)</code></li>
      </ul>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="corner-down-left"></i> <code>else</code> в цикле — редкая, но живая конструкция</div>
<pre><code><span class="c-comment"># else срабатывает если цикл завершился БЕЗ break</span>
<span class="c-key">for</span> item <span class="c-key">in</span> items:
    <span class="c-key">if</span> item.is_target:
        <span class="c-fn">print</span>(<span class="c-str">"found!"</span>)
        <span class="c-key">break</span>
<span class="c-key">else</span>:
    <span class="c-fn">print</span>(<span class="c-str">"not found"</span>)   <span class="c-comment"># сработает только если target не встретился</span></code></pre>
    <p class="text">Кто это придумал — вопрос философский. Практика — заменяют flag-переменной для читаемости.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="split"></i> <code>match / case</code> — pattern matching (Python 3.10+)</div>
    <p class="text">Мощная замена switch — не просто сравнение по значению, а <em>деструктуризация</em>:</p>
<pre><code><span class="c-comment"># Простой — как switch</span>
<span class="c-key">match</span> status:
    <span class="c-key">case</span> <span class="c-str">"active"</span>:
        <span class="c-fn">handle_active</span>()
    <span class="c-key">case</span> <span class="c-str">"paused"</span> | <span class="c-str">"stopped"</span>:      <span class="c-comment"># несколько значений</span>
        <span class="c-fn">handle_off</span>()
    <span class="c-key">case</span> _:                          <span class="c-comment"># default</span>
        <span class="c-fn">handle_unknown</span>()

<span class="c-comment"># Деструктуризация — вот где magic</span>
<span class="c-key">match</span> event:
    <span class="c-key">case</span> {<span class="c-str">"type"</span>: <span class="c-str">"order.created"</span>, <span class="c-str">"data"</span>: {<span class="c-str">"id"</span>: order_id}}:
        <span class="c-fn">process_order</span>(order_id)
    <span class="c-key">case</span> {<span class="c-str">"type"</span>: <span class="c-str">"payment.received"</span>, <span class="c-str">"data"</span>: {<span class="c-str">"amount"</span>: amount, <span class="c-str">"currency"</span>: cur}}:
        <span class="c-fn">record_payment</span>(amount, cur)
    <span class="c-key">case</span> {<span class="c-str">"type"</span>: <span class="c-str">"error"</span>, <span class="c-str">"message"</span>: msg}:
        logger.<span class="c-fn">error</span>(msg)

<span class="c-comment"># Классы + деструктуризация</span>
<span class="c-key">match</span> shape:
    <span class="c-key">case</span> <span class="c-type">Circle</span>(radius=r):
        <span class="c-key">return</span> <span class="c-num">3.14</span> * r ** <span class="c-num">2</span>
    <span class="c-key">case</span> <span class="c-type">Rectangle</span>(width=w, height=h):
        <span class="c-key">return</span> w * h

<span class="c-comment"># Guard — доп условие</span>
<span class="c-key">match</span> point:
    <span class="c-key">case</span> (x, y) <span class="c-key">if</span> x == y:
        <span class="c-fn">print</span>(<span class="c-str">"on diagonal"</span>)</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Модификация коллекции во время обхода.</strong> <code>for x in list: list.remove(x)</code> — пропустит элементы. Обходи копию (<code>list[:]</code>) или собери в новый.</div>
    <div class="pitfall"><strong>2. <code>range()</code> — не список.</strong> В Python 3 это ленивый iterator. Хочешь список — <code>list(range(10))</code>. Для миллионных диапазонов важно.</div>
    <div class="pitfall"><strong>3. <code>zip()</code> обрезает до самого короткого.</strong> Для строгой проверки — <code>zip(a, b, strict=True)</code> (Python 3.10+), кинет <code>ValueError</code>.</div>
    <div class="pitfall"><strong>4. <code>match</code> ≠ switch.</strong> <code>case &lt;VAR&gt;:</code> без точки — это захват (bind), а не сравнение. <code>case value:</code> просто присвоит <em>что угодно</em> в <code>value</code>. Для сравнения с константой класса — <code>case Color.RED:</code>.</div>
  </div>
</div>

<div id="sec-functions" class="section">
  <div class="section-title">Функции + lambda + замыкания</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="function-square"></i> Определение — <code>def</code></div>
<pre><code><span class="c-key">def</span> <span class="c-fn">greet</span>(name):
    <span class="c-str">"""Docstring — первая строка, доступна через help(greet)."""</span>
    <span class="c-key">return</span> <span class="c-fn">f</span><span class="c-str">"Hello, {name}!"</span>

<span class="c-fn">greet</span>(<span class="c-str">"Alice"</span>)              <span class="c-comment"># "Hello, Alice!"</span>

<span class="c-comment"># С type hints (рекомендуется в новом коде)</span>
<span class="c-key">def</span> <span class="c-fn">greet</span>(name: <span class="c-type">str</span>) -&gt; <span class="c-type">str</span>:
    <span class="c-key">return</span> <span class="c-fn">f</span><span class="c-str">"Hello, {name}!"</span>

<span class="c-comment"># Без явного return — функция вернёт None</span>
<span class="c-key">def</span> <span class="c-fn">log_it</span>(msg):
    <span class="c-fn">print</span>(msg)         <span class="c-comment"># возвращает None автоматически</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="align-left"></i> Аргументы — позиционные vs keyword</div>
<pre><code><span class="c-key">def</span> <span class="c-fn">create_user</span>(name, age, role=<span class="c-str">"user"</span>, active=<span class="c-key">True</span>):
    <span class="c-key">return</span> {<span class="c-str">"name"</span>: name, <span class="c-str">"age"</span>: age, <span class="c-str">"role"</span>: role, <span class="c-str">"active"</span>: active}

<span class="c-comment"># Позиционные — по порядку</span>
<span class="c-fn">create_user</span>(<span class="c-str">"Alice"</span>, <span class="c-num">30</span>)

<span class="c-comment"># Keyword — по имени, порядок не важен</span>
<span class="c-fn">create_user</span>(age=<span class="c-num">30</span>, name=<span class="c-str">"Alice"</span>, role=<span class="c-str">"admin"</span>)

<span class="c-comment"># Смешанно — сначала позиционные, потом keyword</span>
<span class="c-fn">create_user</span>(<span class="c-str">"Alice"</span>, <span class="c-num">30</span>, role=<span class="c-str">"admin"</span>)

<span class="c-comment"># Keyword-only — принудительно через *</span>
<span class="c-key">def</span> <span class="c-fn">create_order</span>(items, *, currency=<span class="c-str">"USD"</span>, express=<span class="c-key">False</span>):
    ...
<span class="c-fn">create_order</span>([...], currency=<span class="c-str">"EUR"</span>)   <span class="c-comment"># ✅</span>
<span class="c-fn">create_order</span>([...], <span class="c-str">"EUR"</span>)             <span class="c-comment"># ❌ TypeError</span>

<span class="c-comment"># Positional-only — до /</span>
<span class="c-key">def</span> <span class="c-fn">divmod_</span>(a, b, /):     <span class="c-comment"># a и b нельзя передать как keyword</span>
    <span class="c-key">return</span> a // b, a % b</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="expand"></i> <code>*args</code> и <code>**kwargs</code> — переменное число аргументов</div>
<pre><code><span class="c-key">def</span> <span class="c-fn">sum_all</span>(*args):             <span class="c-comment"># args — tuple</span>
    <span class="c-key">return</span> <span class="c-fn">sum</span>(args)

<span class="c-fn">sum_all</span>(<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>, <span class="c-num">4</span>)            <span class="c-comment"># 10</span>

<span class="c-key">def</span> <span class="c-fn">make_dict</span>(**kwargs):        <span class="c-comment"># kwargs — dict</span>
    <span class="c-key">return</span> kwargs

<span class="c-fn">make_dict</span>(name=<span class="c-str">"Alice"</span>, age=<span class="c-num">30</span>)  <span class="c-comment"># {"name": "Alice", "age": 30}</span>

<span class="c-comment"># Комбинация — всё сразу</span>
<span class="c-key">def</span> <span class="c-fn">log</span>(level, *messages, **extras):
    <span class="c-fn">print</span>(level, messages, extras)

<span class="c-fn">log</span>(<span class="c-str">"INFO"</span>, <span class="c-str">"user"</span>, <span class="c-str">"created"</span>, user_id=<span class="c-num">42</span>, ip=<span class="c-str">"1.1.1.1"</span>)

<span class="c-comment"># Unpacking при ВЫЗОВЕ — обратная операция</span>
args = [<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>]
<span class="c-fn">sum_all</span>(*args)                <span class="c-comment"># раскроет list в аргументы</span>

kwargs = {<span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>, <span class="c-str">"age"</span>: <span class="c-num">30</span>}
<span class="c-fn">create_user</span>(**kwargs)         <span class="c-comment"># раскроет dict в keyword args</span></code></pre>

    <div class="pitfall"><strong>⚠ Mutable default argument — классический баг.</strong>
<pre style="margin-top:6px"><code><span class="c-key">def</span> <span class="c-fn">add</span>(item, items=[]):    <span class="c-comment"># [] создаётся ОДИН раз при определении!</span>
    items.<span class="c-fn">append</span>(item)
    <span class="c-key">return</span> items

<span class="c-fn">add</span>(<span class="c-str">"a"</span>)     <span class="c-comment"># ["a"]</span>
<span class="c-fn">add</span>(<span class="c-str">"b"</span>)     <span class="c-comment"># ["a", "b"] — не пустой!</span>

<span class="c-comment"># ✅ Правильно:</span>
<span class="c-key">def</span> <span class="c-fn">add</span>(item, items=<span class="c-key">None</span>):
    <span class="c-key">if</span> items <span class="c-key">is None</span>:
        items = []
    items.<span class="c-fn">append</span>(item)
    <span class="c-key">return</span> items</code></pre>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="corner-up-left"></i> Возврат нескольких значений</div>
<pre><code><span class="c-key">def</span> <span class="c-fn">divmod_</span>(a, b):
    <span class="c-key">return</span> a // b, a % b       <span class="c-comment"># на самом деле — tuple (a//b, a%b)</span>

quotient, remainder = <span class="c-fn">divmod_</span>(<span class="c-num">10</span>, <span class="c-num">3</span>)   <span class="c-comment"># unpacking</span>

<span class="c-comment"># Часто возвращают dict / dataclass для читаемости</span>
<span class="c-key">def</span> <span class="c-fn">get_user_stats</span>(user_id):
    <span class="c-key">return</span> {<span class="c-str">"orders"</span>: <span class="c-num">42</span>, <span class="c-str">"total"</span>: <span class="c-num">1500.0</span>, <span class="c-str">"last_order_at"</span>: ...}</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> <code>lambda</code> — анонимные функции</div>
    <p class="text">Однострочные функции без имени. Полезны для <code>sorted</code>, <code>map</code>, <code>filter</code>. Не для сложной логики — там обычная <code>def</code>.</p>
<pre><code><span class="c-comment"># Сортировка по полю</span>
users = [{<span class="c-str">"name"</span>: <span class="c-str">"Bob"</span>, <span class="c-str">"age"</span>: <span class="c-num">25</span>}, {<span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>, <span class="c-str">"age"</span>: <span class="c-num">30</span>}]
<span class="c-fn">sorted</span>(users, key=<span class="c-key">lambda</span> u: u[<span class="c-str">"age"</span>])

<span class="c-comment"># Максимум по критерию</span>
<span class="c-fn">max</span>(users, key=<span class="c-key">lambda</span> u: u[<span class="c-str">"age"</span>])

<span class="c-comment"># Фильтр</span>
<span class="c-fn">list</span>(<span class="c-fn">filter</span>(<span class="c-key">lambda</span> u: u[<span class="c-str">"age"</span>] &gt;= <span class="c-num">18</span>, users))
<span class="c-comment"># Питоничнее — comprehension:</span>
[u <span class="c-key">for</span> u <span class="c-key">in</span> users <span class="c-key">if</span> u[<span class="c-str">"age"</span>] &gt;= <span class="c-num">18</span>]</code></pre>

    <div class="info-box primary">
      <strong>Правило:</strong> lambda хорош для <em>одноразовой</em> функции-выражения. Если логика в 2+ строки — делай <code>def</code>. Читаемость важнее краткости.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="link"></i> Замыкания (closures)</div>
    <p class="text">Внутренняя функция запоминает переменные внешней. Классический паттерн — фабрика функций:</p>
<pre><code><span class="c-key">def</span> <span class="c-fn">make_multiplier</span>(factor):
    <span class="c-key">def</span> <span class="c-fn">multiply</span>(x):
        <span class="c-key">return</span> x * factor       <span class="c-comment"># factor — из внешней области</span>
    <span class="c-key">return</span> multiply

double = <span class="c-fn">make_multiplier</span>(<span class="c-num">2</span>)
triple = <span class="c-fn">make_multiplier</span>(<span class="c-num">3</span>)
<span class="c-fn">double</span>(<span class="c-num">5</span>)                        <span class="c-comment"># 10</span>
<span class="c-fn">triple</span>(<span class="c-num">5</span>)                        <span class="c-comment"># 15</span>

<span class="c-comment"># Изменение внешней переменной — через nonlocal</span>
<span class="c-key">def</span> <span class="c-fn">counter</span>():
    count = <span class="c-num">0</span>
    <span class="c-key">def</span> <span class="c-fn">inc</span>():
        <span class="c-key">nonlocal</span> count       <span class="c-comment"># без этого count = local, будет UnboundLocalError</span>
        count += <span class="c-num">1</span>
        <span class="c-key">return</span> count
    <span class="c-key">return</span> inc

next_id = <span class="c-fn">counter</span>()
<span class="c-fn">next_id</span>(), <span class="c-fn">next_id</span>(), <span class="c-fn">next_id</span>()   <span class="c-comment"># 1, 2, 3</span></code></pre>

    <div class="pitfall"><strong>⚠ Late binding в закрытии по циклу — классическая ловушка.</strong>
<pre style="margin-top:6px"><code>funcs = [<span class="c-key">lambda</span>: i <span class="c-key">for</span> i <span class="c-key">in</span> <span class="c-fn">range</span>(<span class="c-num">3</span>)]
[f() <span class="c-key">for</span> f <span class="c-key">in</span> funcs]           <span class="c-comment"># [2, 2, 2] — не [0, 1, 2]!</span>
<span class="c-comment"># Все lambda ссылаются на ОДНУ и ту же i, к моменту вызова = 2</span>

<span class="c-comment"># ✅ Фикс через default:</span>
funcs = [<span class="c-key">lambda</span> i=i: i <span class="c-key">for</span> i <span class="c-key">in</span> <span class="c-fn">range</span>(<span class="c-num">3</span>)]
[f() <span class="c-key">for</span> f <span class="c-key">in</span> funcs]           <span class="c-comment"># [0, 1, 2]</span></code></pre>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Функция первого класса.</strong> Функцию можно присвоить переменной, положить в list/dict, передать как аргумент, вернуть из другой функции. Это фундамент декораторов и функционального стиля.</div>
    <div class="pitfall"><strong>2. Scope — LEGB.</strong> Local → Enclosing (closure) → Global → Built-in. Имя ищется в этом порядке. <code>global x</code> и <code>nonlocal x</code> — модификаторы «пиши в верхний scope».</div>
    <div class="pitfall"><strong>3. Docstring — стандарт индустрии.</strong> Первая строка функции в тройных кавычках. IDE, <code>help()</code>, документация (Sphinx) используют её. Пиши всегда для публичных функций.</div>
    <div class="pitfall"><strong>4. Return типов — рекомендуется явно.</strong> <code>-&gt; None</code> для void, <code>-&gt; list[str]</code> для типизированной коллекции. mypy проверит.</div>
    <div class="pitfall"><strong>5. Не мутируй входные аргументы без предупреждения.</strong> <code>def append_id(items, id): items.append(id)</code> — сюрприз для вызывающего. Возвращай новый список либо явно назови <code>*_inplace</code>.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> <code>def</code> — стандарт, <code>lambda</code> — для одноразовых key-функций. <code>*args</code>/<code>**kwargs</code> для гибких API. Никогда mutable default arg — только <code>None</code> + проверка. Closures работают, но осторожно с late binding.
  </div>
</div>

<div id="sec-collections" class="section">
  <div class="section-title">Comprehensions — list / dict / set / generator</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="wand-2"></i> List comprehension — питоничная замена map/filter</div>
<pre><code><span class="c-comment"># [expression for item in iterable if condition]</span>

<span class="c-comment"># Простое преобразование</span>
squared = [x ** <span class="c-num">2</span> <span class="c-key">for</span> x <span class="c-key">in</span> <span class="c-fn">range</span>(<span class="c-num">10</span>)]
<span class="c-comment"># [0, 1, 4, 9, 16, 25, 36, 49, 64, 81]</span>

<span class="c-comment"># С фильтром</span>
positives = [x <span class="c-key">for</span> x <span class="c-key">in</span> nums <span class="c-key">if</span> x &gt; <span class="c-num">0</span>]

<span class="c-comment"># Оба сразу</span>
even_squares = [x ** <span class="c-num">2</span> <span class="c-key">for</span> x <span class="c-key">in</span> <span class="c-fn">range</span>(<span class="c-num">20</span>) <span class="c-key">if</span> x % <span class="c-num">2</span> == <span class="c-num">0</span>]

<span class="c-comment"># Извлечение из объектов</span>
emails = [user.email <span class="c-key">for</span> user <span class="c-key">in</span> users <span class="c-key">if</span> user.is_active]

<span class="c-comment"># if/else в expression — тернарник (тогда if НЕ фильтр, а часть выражения)</span>
labels = [<span class="c-str">"adult"</span> <span class="c-key">if</span> u.age &gt;= <span class="c-num">18</span> <span class="c-key">else</span> <span class="c-str">"minor"</span> <span class="c-key">for</span> u <span class="c-key">in</span> users]</code></pre>

    <div class="info-box success">
      <strong>Правило:</strong> comprehension короче, быстрее и питоничнее чем <code>map()</code>/<code>filter()</code>. В новом коде — только comprehensions. <code>map</code>/<code>filter</code> остались в лямбда-мире функционального программирования.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="braces"></i> Dict comprehension</div>
<pre><code><span class="c-comment"># {key_expr: value_expr for item in iterable if condition}</span>

<span class="c-comment"># Из пары списков</span>
names = [<span class="c-str">"Alice"</span>, <span class="c-str">"Bob"</span>, <span class="c-str">"Charlie"</span>]
ages  = [<span class="c-num">30</span>, <span class="c-num">25</span>, <span class="c-num">35</span>]
user_ages = {n: a <span class="c-key">for</span> n, a <span class="c-key">in</span> <span class="c-fn">zip</span>(names, ages)}
<span class="c-comment"># {"Alice": 30, "Bob": 25, "Charlie": 35}</span>

<span class="c-comment"># Инверсия dict</span>
inverted = {v: k <span class="c-key">for</span> k, v <span class="c-key">in</span> d.<span class="c-fn">items</span>()}

<span class="c-comment"># Трансформация значений</span>
upper_d = {k: v.<span class="c-fn">upper</span>() <span class="c-key">for</span> k, v <span class="c-key">in</span> d.<span class="c-fn">items</span>()}

<span class="c-comment"># Индекс по id</span>
users_by_id = {u.id: u <span class="c-key">for</span> u <span class="c-key">in</span> users}

<span class="c-comment"># С фильтром</span>
active = {k: v <span class="c-key">for</span> k, v <span class="c-key">in</span> d.<span class="c-fn">items</span>() <span class="c-key">if</span> v.is_active}</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="circle"></i> Set comprehension</div>
<pre><code>unique_tags = {tag <span class="c-key">for</span> post <span class="c-key">in</span> posts <span class="c-key">for</span> tag <span class="c-key">in</span> post.tags}

<span class="c-comment"># Уникальные домены email-ов</span>
domains = {email.<span class="c-fn">split</span>(<span class="c-str">"@"</span>)[<span class="c-num">1</span>] <span class="c-key">for</span> email <span class="c-key">in</span> emails}</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Generator expression — <em>ленивая</em> версия</div>
    <p class="text">Просто скобки <code>(...)</code> вместо <code>[...]</code> — но получается <strong>генератор</strong>, а не список. Не занимает память под все элементы сразу, вычисляет по одному.</p>
<pre><code><span class="c-comment"># List — сразу все 10^9 чисел в памяти. Убьёт RAM.</span>
<span class="c-fn">sum</span>([x ** <span class="c-num">2</span> <span class="c-key">for</span> x <span class="c-key">in</span> <span class="c-fn">range</span>(<span class="c-num">10</span> ** <span class="c-num">9</span>)])

<span class="c-comment"># Generator — по одному, память O(1)</span>
<span class="c-fn">sum</span>(x ** <span class="c-num">2</span> <span class="c-key">for</span> x <span class="c-key">in</span> <span class="c-fn">range</span>(<span class="c-num">10</span> ** <span class="c-num">9</span>))

<span class="c-comment"># При передаче в функцию скобки comprehension'а можно опустить</span>
<span class="c-fn">any</span>(u.is_admin <span class="c-key">for</span> u <span class="c-key">in</span> users)
<span class="c-fn">max</span>(o.total <span class="c-key">for</span> o <span class="c-key">in</span> orders)</code></pre>

    <div class="info-box primary">
      <strong>Правило:</strong> результат нужен как список (обход несколько раз, индексация, <code>len</code>) → list comprehension. Однократный обход + большая последовательность → generator expression.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Вложенные comprehensions</div>
<pre><code><span class="c-comment"># Уплощение matrix — 2D → 1D</span>
matrix = [[<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>], [<span class="c-num">4</span>, <span class="c-num">5</span>, <span class="c-num">6</span>], [<span class="c-num">7</span>, <span class="c-num">8</span>, <span class="c-num">9</span>]]
flat = [x <span class="c-key">for</span> row <span class="c-key">in</span> matrix <span class="c-key">for</span> x <span class="c-key">in</span> row]
<span class="c-comment"># [1, 2, 3, 4, 5, 6, 7, 8, 9]</span>
<span class="c-comment"># Читай как: for row in matrix: for x in row: yield x</span>

<span class="c-comment"># Комбинации</span>
pairs = [(a, b) <span class="c-key">for</span> a <span class="c-key">in</span> <span class="c-fn">range</span>(<span class="c-num">3</span>) <span class="c-key">for</span> b <span class="c-key">in</span> <span class="c-fn">range</span>(<span class="c-num">3</span>) <span class="c-key">if</span> a != b]</code></pre>

    <div class="pitfall"><strong>⚠ Три уровня вложенности — уже нечитабельно.</strong> Разбивай на обычные циклы или вспомогательные функции.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> PHP-аналоги</div>
    <table class="data-table">
      <tr><th>PHP</th><th>Python</th></tr>
      <tr><td><code>array_map(fn($x) =&gt; $x * 2, $nums)</code></td><td><code>[x * 2 for x in nums]</code></td></tr>
      <tr><td><code>array_filter($nums, fn($x) =&gt; $x &gt; 0)</code></td><td><code>[x for x in nums if x &gt; 0]</code></td></tr>
      <tr><td><code>array_combine($keys, $values)</code></td><td><code>{k: v for k, v in zip(keys, values)}</code></td></tr>
      <tr><td><code>array_column($users, 'email')</code></td><td><code>[u["email"] for u in users]</code></td></tr>
      <tr><td><code>array_unique($items)</code></td><td><code>list({x for x in items})</code></td></tr>
    </table>
  </div>
</div>

<!-- ═══════════════════════════ BUILTINS ═══════════════════════════ -->
<div id="sec-builtins" class="section">
  <div class="section-title">Встроенные функции Python — справочник</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Что это и зачем</div>
    <p class="text">Python предоставляет ~70 функций <em>без импорта</em> — они всегда доступны из любого модуля. Живут в модуле <code>builtins</code>, автоматически загружаемом. Полный список: <code>dir(__builtins__)</code> (там ~150 имён, включая исключения типа <code>ValueError</code>).</p>

    <div class="info-box success">
      <strong>Правило:</strong> не зубри всё. Реально в 90% кода нужны 15: <code>print</code>, <code>input</code>, <code>len</code>, <code>range</code>, <code>enumerate</code>, <code>zip</code>, <code>sorted</code>, <code>min</code>, <code>max</code>, <code>sum</code>, <code>int</code>, <code>str</code>, <code>list</code>, <code>isinstance</code>, <code>open</code>. Остальные — по мере необходимости.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="printer"></i> Ввод / вывод</div>
    <table class="data-table">
      <tr><th>Функция</th><th>Что делает</th><th>Пример</th></tr>
      <tr><td><code>print(*args, sep=' ', end='\n')</code></td><td>Вывод в консоль</td><td><code>print("a", "b", sep="-")</code> → <code>a-b</code></td></tr>
      <tr><td><code>input(prompt="")</code></td><td>Читает строку от пользователя (всегда <code>str</code>)</td><td><code>name = input("Имя: ")</code></td></tr>
      <tr><td><code>open(path, mode, encoding)</code></td><td>Открыть файл (использовать через <code>with</code>)</td><td><code>with open("f.txt", "r", encoding="utf-8") as f:</code></td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="ruler"></i> Длина, тип, проверка</div>
    <table class="data-table">
      <tr><th>Функция</th><th>Что делает</th><th>Пример</th></tr>
      <tr><td><code>len(x)</code></td><td>Длина коллекции / строки</td><td><code>len("hello")</code> → <code>5</code></td></tr>
      <tr><td><code>type(x)</code></td><td>Класс объекта</td><td><code>type(42)</code> → <code>&lt;class 'int'&gt;</code></td></tr>
      <tr><td><code>isinstance(x, T)</code></td><td>Экземпляр класса <code>T</code> (учитывает наследников) — <strong>предпочтительнее</strong> <code>type(x) == T</code></td><td><code>isinstance(42, (int, str))</code> → <code>True</code> (можно кортеж типов)</td></tr>
      <tr><td><code>callable(x)</code></td><td>Можно ли вызвать <code>x()</code></td><td><code>callable(print)</code> → <code>True</code>; <code>callable(42)</code> → <code>False</code></td></tr>
      <tr><td><code>issubclass(A, B)</code></td><td><code>A</code> — подкласс <code>B</code></td><td><code>issubclass(bool, int)</code> → <code>True</code></td></tr>
    </table>

    <div class="pitfall"><strong>⚠ Правило:</strong> <code>isinstance(x, T)</code> — <em>всегда</em> вместо <code>type(x) == T</code>. Первое учитывает наследование (<code>isinstance(True, int)</code> → <code>True</code>, потому что <code>bool</code> — наследник <code>int</code>). Второе — строгое сравнение классов.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="repeat-2"></i> Приведение типов (конструкторы)</div>
    <table class="data-table">
      <tr><th>Функция</th><th>Что делает</th><th>Пример</th></tr>
      <tr><td><code>int(x)</code></td><td>В целое (обрезает дробь, НЕ округляет)</td><td><code>int("42")</code> → <code>42</code>; <code>int(3.9)</code> → <code>3</code></td></tr>
      <tr><td><code>int(x, base)</code></td><td>Парсинг с системой счисления</td><td><code>int("ff", 16)</code> → <code>255</code></td></tr>
      <tr><td><code>float(x)</code></td><td>В float</td><td><code>float("3.14")</code> → <code>3.14</code></td></tr>
      <tr><td><code>str(x)</code></td><td>В строку (через <code>__str__</code>)</td><td><code>str([1, 2])</code> → <code>"[1, 2]"</code></td></tr>
      <tr><td><code>bool(x)</code></td><td>В True/False (falsy: 0, "", [], {}, None)</td><td><code>bool([])</code> → <code>False</code>; <code>bool("hi")</code> → <code>True</code></td></tr>
      <tr><td><code>list(x)</code></td><td>Список из iterable</td><td><code>list("abc")</code> → <code>['a', 'b', 'c']</code></td></tr>
      <tr><td><code>tuple(x)</code></td><td>Кортеж</td><td><code>tuple([1, 2])</code> → <code>(1, 2)</code></td></tr>
      <tr><td><code>set(x)</code></td><td>Множество (уникальные)</td><td><code>set([1, 1, 2])</code> → <code>{1, 2}</code></td></tr>
      <tr><td><code>dict(x)</code></td><td>Словарь</td><td><code>dict(a=1, b=2)</code> → <code>{'a': 1, 'b': 2}</code></td></tr>
      <tr><td><code>bytes(x)</code>, <code>bytearray(x)</code></td><td>Бинарные типы</td><td><code>bytes("hi", "utf-8")</code></td></tr>
      <tr><td><code>frozenset(x)</code></td><td>Неизменяемое множество (hashable — можно как ключ dict)</td><td><code>frozenset([1, 2])</code></td></tr>
    </table>

    <div class="pitfall"><strong>⚠ <code>int(3.9)</code> = <code>3</code>, не <code>4</code></strong> — обрезает к нулю. Для правильного округления — <code>round(3.9)</code>.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="repeat"></i> Итерация</div>
    <table class="data-table">
      <tr><th>Функция</th><th>Что делает</th><th>Пример</th></tr>
      <tr><td><code>range(stop)</code>, <code>range(start, stop, step)</code></td><td>Ленивая последовательность чисел</td><td><code>list(range(0, 10, 2))</code> → <code>[0, 2, 4, 6, 8]</code></td></tr>
      <tr><td><code>enumerate(x, start=0)</code></td><td>Пары <code>(index, value)</code></td><td><code>list(enumerate("ab"))</code> → <code>[(0, 'a'), (1, 'b')]</code></td></tr>
      <tr><td><code>zip(a, b, ..., strict=False)</code></td><td>Параллельный обход. <code>strict=True</code> (3.10+) кинет ошибку при разной длине</td><td><code>list(zip([1, 2], ["a", "b"]))</code> → <code>[(1, 'a'), (2, 'b')]</code></td></tr>
      <tr><td><code>reversed(x)</code></td><td>Итератор в обратном порядке (без изменения оригинала)</td><td><code>list(reversed([1, 2, 3]))</code> → <code>[3, 2, 1]</code></td></tr>
      <tr><td><code>iter(x)</code></td><td>Получить iterator</td><td><code>it = iter([1, 2, 3]); next(it)</code> → <code>1</code></td></tr>
      <tr><td><code>next(it, default)</code></td><td>Следующий элемент или <code>default</code> вместо <code>StopIteration</code></td><td><code>next(it, "!")</code> → <code>"!"</code></td></tr>
      <tr><td><code>map(f, x)</code></td><td>Применить <code>f</code> к каждому (ленивый)</td><td><code>list(map(str, [1, 2, 3]))</code> → <code>['1', '2', '3']</code></td></tr>
      <tr><td><code>filter(f, x)</code></td><td>Оставить элементы, где <code>f(x)</code> истинно</td><td><code>list(filter(lambda n: n &gt; 0, [1, -2, 3]))</code> → <code>[1, 3]</code></td></tr>
    </table>

    <div class="info-box primary">
      <strong>Питоничнее:</strong> <code>map</code>/<code>filter</code> в новом коде обычно заменяют <a href="#" onclick="showSection('collections', document.querySelector('[onclick*=collections]')); return false;">comprehension</a> — короче и читаемее:
      <br><code>list(map(str, nums))</code> → <code>[str(n) for n in nums]</code>
      <br><code>list(filter(lambda n: n &gt; 0, nums))</code> → <code>[n for n in nums if n &gt; 0]</code>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-up-down"></i> Сортировка и границы</div>
    <table class="data-table">
      <tr><th>Функция</th><th>Что делает</th><th>Пример</th></tr>
      <tr><td><code>sorted(x, key=None, reverse=False)</code></td><td>Отсортированная <em>копия</em> (в отличие от <code>list.sort()</code>)</td><td><code>sorted(users, key=lambda u: u.age)</code></td></tr>
      <tr><td><code>min(x, key=None, default=...)</code></td><td>Минимум</td><td><code>min(users, key=lambda u: u.age)</code></td></tr>
      <tr><td><code>max(x, key=None, default=...)</code></td><td>Максимум</td><td><code>max([1, 2, 3])</code> → <code>3</code></td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="calculator"></i> Математика</div>
    <table class="data-table">
      <tr><th>Функция</th><th>Что делает</th><th>Пример</th></tr>
      <tr><td><code>sum(x, start=0)</code></td><td>Сумма</td><td><code>sum([1, 2, 3])</code> → <code>6</code>; <code>sum([1, 2], 10)</code> → <code>13</code></td></tr>
      <tr><td><code>abs(x)</code></td><td>Модуль</td><td><code>abs(-5)</code> → <code>5</code></td></tr>
      <tr><td><code>round(x, ndigits=None)</code></td><td>Округление (bankers' rounding — половина к чётному)</td><td><code>round(3.14159, 2)</code> → <code>3.14</code>; <code>round(2.5)</code> → <code>2</code> (!!!) </td></tr>
      <tr><td><code>pow(base, exp, mod=None)</code></td><td>Степень. С <code>mod</code> — эффективно для больших чисел (крипта)</td><td><code>pow(2, 10, 100)</code> → <code>24</code></td></tr>
      <tr><td><code>divmod(a, b)</code></td><td>Частное + остаток одним вызовом</td><td><code>divmod(7, 2)</code> → <code>(3, 1)</code></td></tr>
      <tr><td><code>bin(x)</code>, <code>oct(x)</code>, <code>hex(x)</code></td><td>В строковое представление системы счисления</td><td><code>hex(255)</code> → <code>'0xff'</code></td></tr>
      <tr><td><code>ord(char)</code></td><td>Char → int (Unicode code point)</td><td><code>ord("A")</code> → <code>65</code></td></tr>
      <tr><td><code>chr(n)</code></td><td>Int → char (Unicode)</td><td><code>chr(65)</code> → <code>'A'</code></td></tr>
    </table>

    <div class="pitfall"><strong>⚠ <code>round(2.5)</code> → <code>2</code>, не <code>3</code>.</strong> Python использует <em>bankers' rounding</em> (half to even) — половина округляется к чётному. Это стандарт IEEE 754 для избежания статистического смещения. Не баг — фича.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-check"></i> Логика</div>
    <table class="data-table">
      <tr><th>Функция</th><th>Что делает</th><th>Пример</th></tr>
      <tr><td><code>all(x)</code></td><td>Все элементы truthy? Пустой → <code>True</code></td><td><code>all([True, True])</code> → <code>True</code>; <code>all([])</code> → <code>True</code></td></tr>
      <tr><td><code>any(x)</code></td><td>Хоть один truthy? Пустой → <code>False</code></td><td><code>any([False, True])</code> → <code>True</code>; <code>any([])</code> → <code>False</code></td></tr>
    </table>

    <p class="text"><strong>Реальный use-case:</strong></p>
<pre><code><span class="c-comment"># Все users имеют email?</span>
<span class="c-key">if</span> <span class="c-fn">all</span>(u.email <span class="c-key">for</span> u <span class="c-key">in</span> users):
    <span class="c-fn">send_bulk</span>(users)

<span class="c-comment"># Есть хоть один админ?</span>
<span class="c-key">if</span> <span class="c-fn">any</span>(u.is_admin <span class="c-key">for</span> u <span class="c-key">in</span> users):
    ...

<span class="c-comment"># Ленивое короткое замыкание — как в SQL EXISTS</span>
<span class="c-comment"># При первом True в any / False в all — обход прекращается</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="search"></i> Отладка и интроспекция</div>
    <table class="data-table">
      <tr><th>Функция</th><th>Что делает</th><th>Пример</th></tr>
      <tr><td><code>help(x)</code></td><td>Показать docstring / документацию</td><td><code>help(str.split)</code></td></tr>
      <tr><td><code>dir(x)</code></td><td>Список атрибутов и методов объекта</td><td><code>dir("hi")</code> → <code>[..., 'split', 'upper', ...]</code></td></tr>
      <tr><td><code>repr(x)</code></td><td>«Отладочное» представление (видны escape-символы, кавычки)</td><td><code>repr("hi\n")</code> → <code>"'hi\\n'"</code></td></tr>
      <tr><td><code>id(x)</code></td><td>Адрес объекта в памяти (для <code>is</code>)</td><td><code>id(42)</code></td></tr>
      <tr><td><code>hash(x)</code></td><td>Хеш immutable-объекта. Для list — ошибка (unhashable)</td><td><code>hash((1, 2))</code> ✓; <code>hash([1, 2])</code> ✗</td></tr>
      <tr><td><code>getattr(obj, name, default)</code></td><td>Атрибут по имени (динамически), с дефолтом</td><td><code>getattr(user, "email", "none")</code></td></tr>
      <tr><td><code>setattr(obj, name, value)</code></td><td>Установить атрибут по имени</td><td><code>setattr(user, "role", "admin")</code></td></tr>
      <tr><td><code>hasattr(obj, name)</code></td><td>Есть ли атрибут</td><td><code>hasattr(user, "email")</code></td></tr>
      <tr><td><code>delattr(obj, name)</code></td><td>Удалить атрибут</td><td>—</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="globe"></i> Область видимости</div>
    <table class="data-table">
      <tr><th>Функция</th><th>Что делает</th><th>Пример</th></tr>
      <tr><td><code>vars(x)</code></td><td><code>__dict__</code> объекта (атрибуты как словарь)</td><td><code>vars(user)</code> → <code>{'name': 'Alice', ...}</code></td></tr>
      <tr><td><code>vars()</code> (без аргумента)</td><td>То же что <code>locals()</code></td><td>—</td></tr>
      <tr><td><code>globals()</code></td><td>Словарь глобальных переменных модуля</td><td>Отладка, метапрограммирование</td></tr>
      <tr><td><code>locals()</code></td><td>Словарь локальных переменных (для чтения; изменения не сохранятся)</td><td>Отладка</td></tr>
    </table>

    <p class="text"><strong>Используются редко</strong> — в основном для отладки и метапрограммирования (декораторы, ORM, тестовые фреймворки).</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="skull"></i> Опасное: <code>eval</code> / <code>exec</code></div>
<pre><code><span class="c-fn">eval</span>(<span class="c-str">"2 + 3"</span>)              <span class="c-comment"># 5 — выполнить ВЫРАЖЕНИЕ, вернуть значение</span>
<span class="c-fn">eval</span>(<span class="c-str">"len('hi')"</span>)          <span class="c-comment"># 2</span>

<span class="c-fn">exec</span>(<span class="c-str">"x = 5\nprint(x)"</span>)     <span class="c-comment"># выполнить ИНСТРУКЦИИ, вернуть None</span></code></pre>

    <div class="pitfall"><strong>⚠ КРИТИЧНО:</strong> <code>eval</code>/<code>exec</code> на пользовательских данных = RCE. <code>eval(user_input)</code> с вводом <code>"__import__('os').system('rm -rf /')"</code> — уничтожит сервер. Использовать <strong>только</strong> для доверенных строк (свои шаблоны, тесты), никогда для внешнего ввода.</div>

    <p class="text"><strong>Безопасные альтернативы:</strong></p>
    <ul class="bullets">
      <li>Парсинг чисел из строки → <code>int(s)</code> / <code>float(s)</code>, а не <code>eval(s)</code></li>
      <li>Парсинг литералов (числа, строки, списки, dict) → <code>ast.literal_eval(s)</code> — <em>только литералы</em>, никаких вызовов функций</li>
      <li>Парсинг математических выражений → библиотека <code>sympy</code> или свой AST-парсер</li>
      <li>Динамическое выполнение кода из БД → крайне пересматривай архитектуру, обычно есть безопасное решение</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="grid-3x3"></i> Полная картина по категориям</div>
    <table class="data-table">
      <tr><th>Категория</th><th>Функции</th></tr>
      <tr><td>Ввод/вывод</td><td><code>print</code>, <code>input</code>, <code>open</code></td></tr>
      <tr><td>Длина / тип</td><td><code>len</code>, <code>type</code>, <code>isinstance</code>, <code>issubclass</code>, <code>callable</code></td></tr>
      <tr><td>Приведение</td><td><code>int</code>, <code>float</code>, <code>str</code>, <code>bool</code>, <code>list</code>, <code>tuple</code>, <code>set</code>, <code>dict</code>, <code>bytes</code>, <code>frozenset</code></td></tr>
      <tr><td>Итерация</td><td><code>range</code>, <code>enumerate</code>, <code>zip</code>, <code>reversed</code>, <code>iter</code>, <code>next</code>, <code>map</code>, <code>filter</code></td></tr>
      <tr><td>Сортировка</td><td><code>sorted</code>, <code>min</code>, <code>max</code></td></tr>
      <tr><td>Математика</td><td><code>sum</code>, <code>abs</code>, <code>round</code>, <code>pow</code>, <code>divmod</code>, <code>bin</code>, <code>hex</code>, <code>oct</code>, <code>ord</code>, <code>chr</code></td></tr>
      <tr><td>Логика</td><td><code>all</code>, <code>any</code></td></tr>
      <tr><td>Интроспекция</td><td><code>help</code>, <code>dir</code>, <code>repr</code>, <code>id</code>, <code>hash</code>, <code>getattr</code>/<code>setattr</code>/<code>hasattr</code>, <code>vars</code>, <code>globals</code>, <code>locals</code></td></tr>
      <tr><td>Опасное</td><td><code>eval</code>, <code>exec</code>, <code>compile</code></td></tr>
    </table>
  </div>

  <div class="remember-box">
    <strong>Что запомнить:</strong>
    <ul style="margin:6px 0 0 20px;line-height:1.7">
      <li><strong>90% кода</strong> использует ~15 функций: <code>print</code>, <code>input</code>, <code>len</code>, <code>range</code>, <code>enumerate</code>, <code>zip</code>, <code>sorted</code>, <code>min</code>/<code>max</code>/<code>sum</code>, <code>int</code>/<code>str</code>/<code>list</code>, <code>isinstance</code>, <code>open</code></li>
      <li><code>iter</code>/<code>next</code>/<code>map</code>/<code>filter</code> — низкоуровневые, чаще заменяются <a href="#" onclick="showSection('collections', document.querySelector('[onclick*=collections]')); return false;">comprehensions</a></li>
      <li><code>eval</code>/<code>exec</code> — почти никогда не нужны и <strong>опасны</strong>; для литералов — <code>ast.literal_eval</code></li>
      <li><code>vars</code>/<code>globals</code>/<code>locals</code>/<code>getattr</code>/<code>setattr</code> — метапрограммирование и отладка</li>
      <li>Полный список — <code>dir(__builtins__)</code>, ~150 имён с исключениями (ValueError, TypeError...)</li>
    </ul>
  </div>
</div>

<div id="sec-oop" class="section">
  <div class="section-title">ООП — классы, наследование, dunder, dataclass</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="box"></i> Базовый класс</div>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span>:
    <span class="c-comment"># Class-атрибут — общий для всех экземпляров</span>
    role = <span class="c-str">"guest"</span>

    <span class="c-comment"># Конструктор — __init__</span>
    <span class="c-key">def</span> <span class="c-fn">__init__</span>(<span class="c-key">self</span>, name: <span class="c-type">str</span>, age: <span class="c-type">int</span>):
        <span class="c-key">self</span>.name = name           <span class="c-comment"># instance-атрибуты</span>
        <span class="c-key">self</span>.age = age

    <span class="c-comment"># Обычный метод — первый аргумент всегда self</span>
    <span class="c-key">def</span> <span class="c-fn">greet</span>(<span class="c-key">self</span>) -&gt; <span class="c-type">str</span>:
        <span class="c-key">return</span> <span class="c-fn">f</span><span class="c-str">"Hi, I'm {self.name}"</span>

user = <span class="c-type">User</span>(<span class="c-str">"Alice"</span>, <span class="c-num">30</span>)
user.<span class="c-fn">greet</span>()                    <span class="c-comment"># "Hi, I'm Alice"
user.name                       <span class="c-comment"># "Alice"</span>
user.role                       <span class="c-comment"># "guest" (из class-атрибута)</span></code></pre>

    <div class="info-box primary">
      <strong>Отличия от PHP:</strong> <code>self</code> — <em>явный первый аргумент</em> каждого метода (в PHP было неявное <code>$this</code>). Никаких <code>public/private/protected</code> в языке — только конвенция: <code>_name</code> = «внутреннее» (soft), <code>__name</code> = name-mangling (hard, редко). Всё по умолчанию публично.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Наследование + <code>super()</code></div>
<pre><code><span class="c-key">class</span> <span class="c-type">Admin</span>(<span class="c-type">User</span>):                    <span class="c-comment"># extends User</span>
    role = <span class="c-str">"admin"</span>                       <span class="c-comment"># переопределили class-атрибут</span>

    <span class="c-key">def</span> <span class="c-fn">__init__</span>(<span class="c-key">self</span>, name, age, permissions):
        <span class="c-fn">super</span>().<span class="c-fn">__init__</span>(name, age)      <span class="c-comment"># вызов конструктора родителя</span>
        <span class="c-key">self</span>.permissions = permissions

    <span class="c-key">def</span> <span class="c-fn">greet</span>(<span class="c-key">self</span>) -&gt; <span class="c-type">str</span>:
        base = <span class="c-fn">super</span>().<span class="c-fn">greet</span>()             <span class="c-comment"># вызов метода родителя</span>
        <span class="c-key">return</span> <span class="c-fn">f</span><span class="c-str">"{base} (admin)"</span>

admin = <span class="c-type">Admin</span>(<span class="c-str">"Bob"</span>, <span class="c-num">40</span>, [<span class="c-str">"read"</span>, <span class="c-str">"write"</span>])
admin.<span class="c-fn">greet</span>()                       <span class="c-comment"># "Hi, I'm Bob (admin)"</span>
<span class="c-fn">isinstance</span>(admin, <span class="c-type">User</span>)            <span class="c-comment"># True — Admin наследник User</span></code></pre>

    <p class="text"><strong>Множественное наследование</strong> возможно (в отличие от PHP). Порядок разрешения — <strong>MRO (Method Resolution Order)</strong> по алгоритму C3:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">A</span>: <span class="c-key">def</span> <span class="c-fn">hi</span>(<span class="c-key">self</span>): <span class="c-fn">print</span>(<span class="c-str">"A"</span>)
<span class="c-key">class</span> <span class="c-type">B</span>(<span class="c-type">A</span>): <span class="c-key">def</span> <span class="c-fn">hi</span>(<span class="c-key">self</span>): <span class="c-fn">print</span>(<span class="c-str">"B"</span>)
<span class="c-key">class</span> <span class="c-type">C</span>(<span class="c-type">A</span>): <span class="c-key">def</span> <span class="c-fn">hi</span>(<span class="c-key">self</span>): <span class="c-fn">print</span>(<span class="c-str">"C"</span>)
<span class="c-key">class</span> <span class="c-type">D</span>(<span class="c-type">B</span>, <span class="c-type">C</span>): <span class="c-key">pass</span>

<span class="c-type">D</span>().<span class="c-fn">hi</span>()               <span class="c-comment"># "B" — MRO: D → B → C → A → object</span>
<span class="c-type">D</span>.<span class="c-fn">__mro__</span>              <span class="c-comment"># покажет полный порядок</span></code></pre>

    <div class="pitfall"><strong>⚠ Множественное наследование — редко.</strong> В 95% кода одиночное наследование или композиция. Multiple inheritance используется в основном для <em>mixin</em>-паттерна (класс с одним методом, добавляется как «примесь»).</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="lock"></i> <code>@property</code> — getter/setter без синтаксиса скобок</div>
<pre><code><span class="c-key">class</span> <span class="c-type">Circle</span>:
    <span class="c-key">def</span> <span class="c-fn">__init__</span>(<span class="c-key">self</span>, radius):
        <span class="c-key">self</span>._radius = radius

    <span class="c-key">@property</span>
    <span class="c-key">def</span> <span class="c-fn">radius</span>(<span class="c-key">self</span>) -&gt; <span class="c-type">float</span>:
        <span class="c-key">return</span> <span class="c-key">self</span>._radius

    <span class="c-key">@radius.setter</span>
    <span class="c-key">def</span> <span class="c-fn">radius</span>(<span class="c-key">self</span>, value):
        <span class="c-key">if</span> value &lt; <span class="c-num">0</span>:
            <span class="c-key">raise</span> <span class="c-type">ValueError</span>(<span class="c-str">"radius must be positive"</span>)
        <span class="c-key">self</span>._radius = value

    <span class="c-key">@property</span>
    <span class="c-key">def</span> <span class="c-fn">area</span>(<span class="c-key">self</span>) -&gt; <span class="c-type">float</span>:            <span class="c-comment"># вычисляемое поле</span>
        <span class="c-key">return</span> <span class="c-num">3.14159</span> * <span class="c-key">self</span>._radius ** <span class="c-num">2</span>

c = <span class="c-type">Circle</span>(<span class="c-num">5</span>)
c.radius                        <span class="c-comment"># 5 (вызовет getter, но выглядит как атрибут)</span>
c.radius = <span class="c-num">10</span>                   <span class="c-comment"># вызовет setter</span>
c.radius = -<span class="c-num">1</span>                   <span class="c-comment"># ValueError</span>
c.area                          <span class="c-comment"># 314.159 — без скобок!</span></code></pre>
    <p class="text">Питоническое решение: начинай с обычного публичного атрибута; когда потребуется валидация/вычисление — превращай в <code>@property</code>, интерфейс наружу не меняется.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="tags"></i> <code>@classmethod</code> и <code>@staticmethod</code></div>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span>:
    <span class="c-key">def</span> <span class="c-fn">__init__</span>(<span class="c-key">self</span>, name, age):
        <span class="c-key">self</span>.name = name
        <span class="c-key">self</span>.age = age

    <span class="c-key">@classmethod</span>
    <span class="c-key">def</span> <span class="c-fn">from_dict</span>(<span class="c-fn">cls</span>, data: <span class="c-type">dict</span>) -&gt; <span class="c-str">"User"</span>:
        <span class="c-comment"># cls = сам класс. Работает и в наследниках.</span>
        <span class="c-key">return</span> <span class="c-fn">cls</span>(data[<span class="c-str">"name"</span>], data[<span class="c-str">"age"</span>])

    <span class="c-key">@staticmethod</span>
    <span class="c-key">def</span> <span class="c-fn">is_valid_email</span>(email: <span class="c-type">str</span>) -&gt; <span class="c-type">bool</span>:
        <span class="c-comment"># Ни self, ни cls — обычная функция в namespace класса</span>
        <span class="c-key">return</span> <span class="c-str">"@"</span> <span class="c-key">in</span> email

user = <span class="c-type">User</span>.<span class="c-fn">from_dict</span>({<span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>, <span class="c-str">"age"</span>: <span class="c-num">30</span>})
<span class="c-type">User</span>.<span class="c-fn">is_valid_email</span>(<span class="c-str">"a@b.c"</span>)   <span class="c-comment"># True</span></code></pre>
    <p class="text"><strong>Различие:</strong> <code>@classmethod</code> получает класс — используется для <em>альтернативных конструкторов</em> (from_dict, from_json). <code>@staticmethod</code> — просто функция, помещённая в namespace класса для семантики.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="wand-2"></i> Dunder-методы (magic methods)</div>
    <p class="text">Специальные методы с двойным подчёркиванием — «крючки» в поведение языка. Питон вызывает их сам при определённых операциях.</p>
    <table class="data-table">
      <tr><th>Dunder</th><th>Когда вызывается</th><th>Пример</th></tr>
      <tr><td><code>__init__</code></td><td>Создание объекта</td><td>Конструктор</td></tr>
      <tr><td><code>__str__</code></td><td><code>str(obj)</code>, <code>print(obj)</code>, <code>f"{obj}"</code></td><td>Человекочитаемое представление</td></tr>
      <tr><td><code>__repr__</code></td><td><code>repr(obj)</code>, в REPL, в debug</td><td>Однозначное представление для разработчика</td></tr>
      <tr><td><code>__eq__</code>, <code>__ne__</code></td><td><code>a == b</code>, <code>a != b</code></td><td>Сравнение на равенство</td></tr>
      <tr><td><code>__lt__</code>, <code>__le__</code>, <code>__gt__</code>, <code>__ge__</code></td><td><code>&lt;</code>, <code>&lt;=</code>, <code>&gt;</code>, <code>&gt;=</code></td><td>Для сортировки</td></tr>
      <tr><td><code>__hash__</code></td><td><code>hash(obj)</code>, использование в set/dict-ключах</td><td>Обязателен если <code>__eq__</code></td></tr>
      <tr><td><code>__len__</code></td><td><code>len(obj)</code></td><td>Для коллекций</td></tr>
      <tr><td><code>__iter__</code>, <code>__next__</code></td><td><code>for x in obj:</code></td><td>Iterator protocol</td></tr>
      <tr><td><code>__getitem__</code>, <code>__setitem__</code></td><td><code>obj[key]</code>, <code>obj[key] = v</code></td><td>Индексация</td></tr>
      <tr><td><code>__call__</code></td><td><code>obj(...)</code></td><td>Объект как функция</td></tr>
      <tr><td><code>__enter__</code>, <code>__exit__</code></td><td><code>with obj as x:</code></td><td>Context manager</td></tr>
    </table>

<pre><code><span class="c-key">class</span> <span class="c-type">Money</span>:
    <span class="c-key">def</span> <span class="c-fn">__init__</span>(<span class="c-key">self</span>, amount, currency):
        <span class="c-key">self</span>.amount = amount
        <span class="c-key">self</span>.currency = currency

    <span class="c-key">def</span> <span class="c-fn">__repr__</span>(<span class="c-key">self</span>) -&gt; <span class="c-type">str</span>:
        <span class="c-key">return</span> <span class="c-fn">f</span><span class="c-str">"Money({self.amount}, {self.currency!r})"</span>

    <span class="c-key">def</span> <span class="c-fn">__str__</span>(<span class="c-key">self</span>) -&gt; <span class="c-type">str</span>:
        <span class="c-key">return</span> <span class="c-fn">f</span><span class="c-str">"{self.amount} {self.currency}"</span>

    <span class="c-key">def</span> <span class="c-fn">__eq__</span>(<span class="c-key">self</span>, other) -&gt; <span class="c-type">bool</span>:
        <span class="c-key">return</span> <span class="c-key">self</span>.amount == other.amount <span class="c-key">and</span> <span class="c-key">self</span>.currency == other.currency

    <span class="c-key">def</span> <span class="c-fn">__hash__</span>(<span class="c-key">self</span>) -&gt; <span class="c-type">int</span>:
        <span class="c-key">return</span> <span class="c-fn">hash</span>((<span class="c-key">self</span>.amount, <span class="c-key">self</span>.currency))

    <span class="c-key">def</span> <span class="c-fn">__add__</span>(<span class="c-key">self</span>, other):
        <span class="c-key">if</span> <span class="c-key">self</span>.currency != other.currency:
            <span class="c-key">raise</span> <span class="c-type">ValueError</span>(<span class="c-str">"cannot add different currencies"</span>)
        <span class="c-key">return</span> <span class="c-type">Money</span>(<span class="c-key">self</span>.amount + other.amount, <span class="c-key">self</span>.currency)

<span class="c-type">Money</span>(<span class="c-num">100</span>, <span class="c-str">"USD"</span>) + <span class="c-type">Money</span>(<span class="c-num">50</span>, <span class="c-str">"USD"</span>)   <span class="c-comment"># Money(150, 'USD')</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="sparkles"></i> <code>@dataclass</code> — DTO без boilerplate (must-have Python 3.7+)</div>
<pre><code><span class="c-key">from</span> dataclasses <span class="c-key">import</span> dataclass, field

<span class="c-key">@dataclass</span>
<span class="c-key">class</span> <span class="c-type">User</span>:
    name: <span class="c-type">str</span>
    age: <span class="c-type">int</span>
    role: <span class="c-type">str</span> = <span class="c-str">"user"</span>
    tags: <span class="c-type">list</span>[<span class="c-type">str</span>] = <span class="c-fn">field</span>(default_factory=<span class="c-fn">list</span>)   <span class="c-comment"># для mutable default</span>

user = <span class="c-type">User</span>(<span class="c-str">"Alice"</span>, <span class="c-num">30</span>)
<span class="c-fn">print</span>(user)                    <span class="c-comment"># User(name='Alice', age=30, role='user', tags=[])</span>
user == <span class="c-type">User</span>(<span class="c-str">"Alice"</span>, <span class="c-num">30</span>)      <span class="c-comment"># True — __eq__ автоматом</span>

<span class="c-comment"># Опции:</span>
<span class="c-key">@dataclass</span>(frozen=<span class="c-key">True</span>)          <span class="c-comment"># иммутабельный</span>
<span class="c-key">@dataclass</span>(slots=<span class="c-key">True</span>)           <span class="c-comment"># меньше памяти, быстрее (3.10+)</span>
<span class="c-key">@dataclass</span>(kw_only=<span class="c-key">True</span>)         <span class="c-comment"># только keyword-arguments</span></code></pre>
    <p class="text">Автоматически генерирует <code>__init__</code>, <code>__repr__</code>, <code>__eq__</code>. Аналог PHP <code>readonly class</code> или Java records. Используй <em>по умолчанию</em> для всех классов-DTO. Для валидации данных из внешнего мира (API/форм) — <a href="#" onclick="showSection('fastapi', document.querySelector('[onclick*=fastapi]')); return false;">Pydantic</a>.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>self</code> — не ключевое слово.</strong> Можно назвать хоть <code>this</code>, но <em>никогда так не делай</em> — это конвенция сообщества. IDE и линтеры на неё завязаны.</div>
    <div class="pitfall"><strong>2. Class-атрибуты shared между экземплярами.</strong> Если class-атрибут — mutable (list, dict), изменение через <code>instance.attr</code> без переприсваивания повлияет на всех.</div>
    <div class="pitfall"><strong>3. Нет реального private.</strong> <code>_x</code> — «руками не трогать». <code>__x</code> — name-mangling (внутри класса Foo превращается в <code>_Foo__x</code>), только для избежания коллизий в наследовании. Не защита.</div>
    <div class="pitfall"><strong>4. <code>__eq__</code> без <code>__hash__</code> — объект становится unhashable.</strong> После переопределения <code>__eq__</code> обязательно определи <code>__hash__</code> (или <code>@dataclass(frozen=True)</code> сделает автоматом).</div>
    <div class="pitfall"><strong>5. Не наследуйся от dict/list.</strong> Хочешь свою коллекцию — наследуйся от <code>collections.UserDict</code> / <code>UserList</code>, иначе внутренние методы могут не звать твои переопределения.</div>
    <div class="pitfall"><strong>6. Abstract Base Class — через <code>abc</code>.</strong> <code>from abc import ABC, abstractmethod</code>; <code>class Repo(ABC): @abstractmethod def save(self): ...</code>. Экземпляр создать нельзя, пока не реализуешь метод.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> для DTO — <code>@dataclass</code>. Для сервисов — обычный класс с DI через <code>__init__</code>. Для валидации внешних данных — Pydantic. Наследование — сдержанно, композиция чаще лучше. Dunder-методы — при необходимости (<code>__eq__</code>, <code>__hash__</code>, <code>__repr__</code> — почти всегда стоит). Множественное наследование — только для mixin.
  </div>
</div>

<div id="sec-modules" class="section">
  <div class="section-title">Модули и импорты</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file"></i> Модуль = файл</div>
    <p class="text">Любой <code>.py</code>-файл — модуль. Импорт делает его переменные/функции/классы доступными в другом файле.</p>
<pre><code><span class="c-comment"># math_utils.py</span>
PI = <span class="c-num">3.14159</span>
<span class="c-key">def</span> <span class="c-fn">area</span>(radius): <span class="c-key">return</span> PI * radius ** <span class="c-num">2</span>

<span class="c-comment"># app.py</span>
<span class="c-key">import</span> math_utils                      <span class="c-comment"># модуль целиком</span>
math_utils.<span class="c-fn">area</span>(<span class="c-num">5</span>)
math_utils.PI

<span class="c-key">from</span> math_utils <span class="c-key">import</span> area, PI       <span class="c-comment"># только нужное</span>
<span class="c-fn">area</span>(<span class="c-num">5</span>)

<span class="c-key">from</span> math_utils <span class="c-key">import</span> area <span class="c-key">as</span> circle_area   <span class="c-comment"># переименовать</span>
<span class="c-fn">circle_area</span>(<span class="c-num">5</span>)

<span class="c-key">from</span> math_utils <span class="c-key">import</span> *                    <span class="c-comment"># ❌ анти-паттерн, засоряет namespace</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="folder-tree"></i> Пакет = директория с <code>__init__.py</code></div>
<pre><code>myapp/
├── __init__.py            <span class="c-comment"># делает директорию пакетом</span>
├── main.py
├── users/
│   ├── __init__.py
│   ├── models.py          <span class="c-comment"># class User</span>
│   └── service.py         <span class="c-comment"># def register(...)</span>
└── orders/
    ├── __init__.py
    └── models.py

<span class="c-comment"># В main.py — абсолютные импорты (рекомендуется)</span>
<span class="c-key">from</span> myapp.users.models <span class="c-key">import</span> User
<span class="c-key">from</span> myapp.users.service <span class="c-key">import</span> register

<span class="c-comment"># Внутри users/service.py — относительные (только между модулями пакета)</span>
<span class="c-key">from</span> .models <span class="c-key">import</span> User         <span class="c-comment"># тот же пакет</span>
<span class="c-key">from</span> ..orders.models <span class="c-key">import</span> Order  <span class="c-comment"># родительский пакет</span></code></pre>

    <p class="text"><code>__init__.py</code> может быть пустым (просто маркер пакета) или содержать re-exports:</p>
<pre><code><span class="c-comment"># myapp/users/__init__.py</span>
<span class="c-key">from</span> .models <span class="c-key">import</span> User
<span class="c-key">from</span> .service <span class="c-key">import</span> register

<span class="c-comment"># Теперь можно короче:</span>
<span class="c-key">from</span> myapp.users <span class="c-key">import</span> User, register</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="play"></i> <code>if __name__ == "__main__":</code></div>
    <p class="text">Каждый модуль имеет специальную переменную <code>__name__</code>:</p>
    <ul class="bullets">
      <li>Если файл <em>запущен напрямую</em> (<code>python app.py</code>) → <code>__name__ == "__main__"</code></li>
      <li>Если файл <em>импортирован</em> (<code>import app</code>) → <code>__name__ == "app"</code></li>
    </ul>
<pre><code><span class="c-comment"># cli.py</span>
<span class="c-key">def</span> <span class="c-fn">main</span>():
    <span class="c-fn">print</span>(<span class="c-str">"Running CLI"</span>)

<span class="c-key">if</span> __name__ == <span class="c-str">"__main__"</span>:
    <span class="c-fn">main</span>()      <span class="c-comment"># сработает только при `python cli.py`,
                    # не при `import cli`</span></code></pre>
    <p class="text">Позволяет один файл использовать и как скрипт, и как импортируемый модуль без побочных эффектов при импорте.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Circular imports.</strong> <code>a.py</code> импортирует <code>b</code>, <code>b.py</code> импортирует <code>a</code> → <code>ImportError</code>. Решения: разбить общий код в третий модуль <code>c.py</code>; отложенный импорт внутри функции; type hints через <code>TYPE_CHECKING</code>.</div>
    <div class="pitfall"><strong>2. Модуль импортируется один раз.</strong> Python кеширует в <code>sys.modules</code>. Повторный <code>import</code> — no-op. Перезагрузка — <code>importlib.reload(m)</code> (редко нужно, только для интерактивной разработки).</div>
    <div class="pitfall"><strong>3. Код на верхнем уровне модуля исполняется при первом импорте.</strong> Не пиши там тяжёлые операции (запросы к БД, HTTP), только определения. Инициализация — в <code>if __name__ == "__main__":</code>.</div>
    <div class="pitfall"><strong>4. <code>from X import *</code> — не используй.</strong> Ломает читаемость (непонятно откуда символ), может перекрыть built-ins. Исключение — <code>__all__</code> в <code>__init__.py</code> пакета, если сам это контролируешь.</div>
    <div class="pitfall"><strong>5. Абсолютные vs относительные.</strong> Абсолютные (<code>from myapp.users.models import User</code>) — <em>предпочтительнее</em>. Относительные (<code>from ..models import User</code>) — только внутри пакета, экономят на длине.</div>
  </div>
</div>

<div id="sec-venv" class="section">
  <div class="section-title">venv, pip, poetry, uv — управление зависимостями</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package"></i> Зачем venv</div>
    <p class="text">Проект A требует Django 4.2, проект B — Django 5.1. Оба ставить глобально нельзя. <strong>Virtual environment</strong> — изолированная копия интерпретатора со своим <code>site-packages/</code>. Аналог <code>vendor/</code> в PHP, но на уровне интерпретатора.</p>

    <div class="pitfall"><strong>Ubuntu 24.04 запрещает <code>pip install</code> глобально по умолчанию</strong> (PEP 668, <code>externally-managed-environment</code>). Только через venv или <code>--break-system-packages</code> (не делай так). macOS через brew — та же ситуация.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="terminal"></i> Классика: <code>venv</code> + <code>pip</code></div>
<pre><code><span class="c-comment"># Создать окружение в текущей директории</span>
python -m venv .venv

<span class="c-comment"># Активировать</span>
<span class="c-fn">source</span> .venv/bin/activate         <span class="c-comment"># macOS/Linux</span>
.venv\Scripts\activate            <span class="c-comment"># Windows PowerShell</span>

<span class="c-comment"># Теперь python/pip = из .venv/</span>
<span class="c-fn">which</span> python                     <span class="c-comment"># /path/to/project/.venv/bin/python</span>
pip install fastapi uvicorn sqlalchemy

<span class="c-comment"># Заморозить</span>
pip freeze &gt; requirements.txt

<span class="c-comment"># Восстановить в новом окружении</span>
pip install -r requirements.txt

<span class="c-comment"># Деактивировать</span>
deactivate</code></pre>

    <p class="text"><strong>Добавь <code>.venv/</code> в <code>.gitignore</code></strong> — окружение локально, восстанавливается из <code>requirements.txt</code>. По той же логике, что <code>vendor/</code> в PHP.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="rocket"></i> Современно (2026): <code>uv</code></div>
    <p class="text"><strong>uv</strong> (Astral, 2024) — Rust-based замена <code>pip + venv + pip-tools</code>. В 10-100 раз быстрее. Управляет всем через <code>pyproject.toml</code> + <code>uv.lock</code> — воспроизводимые сборки как <code>composer.lock</code>.</p>
<pre><code><span class="c-comment"># Установка (один раз)</span>
curl -LsSf https://astral.sh/uv/install.sh | sh

<span class="c-comment"># Создать проект</span>
uv init my-api &amp;&amp; <span class="c-fn">cd</span> my-api

<span class="c-comment"># Установить конкретную версию Python (если её нет — скачает)</span>
uv python install 3.13

<span class="c-comment"># Добавить зависимости — сам создаст .venv, обновит pyproject.toml + uv.lock</span>
uv add fastapi uvicorn sqlalchemy
uv add --dev pytest ruff mypy

<span class="c-comment"># Запустить — не нужно `source .venv/bin/activate`</span>
uv run python app.py
uv run uvicorn main:app --reload

<span class="c-comment"># Установить из lock-файла (для CI/деплоя)</span>
uv sync                           <span class="c-comment"># reproducible install</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="briefcase"></i> Poetry — старый стандарт (уходит)</div>
    <p class="text"><strong>Poetry</strong> (2018) — до <code>uv</code> был стандартом. Тот же принцип (pyproject.toml + lock), но написан на Python и в 100 раз медленнее.</p>
<pre><code>poetry init
poetry add fastapi
poetry install
poetry run pytest</code></pre>
    <p class="text">Для нового проекта в 2026 — <code>uv</code>. Poetry — только если проект уже на нём.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Сравнение инструментов</div>
    <table class="data-table">
      <tr><th>Инструмент</th><th>Скорость</th><th>Lock-файл</th><th>Управляет Python-версией</th><th>Когда выбирать</th></tr>
      <tr><td><code>pip + venv</code></td><td>Медленно</td><td><code>requirements.txt</code> (плоский)</td><td>Нет</td><td>Legacy, простые скрипты</td></tr>
      <tr><td><code>pip-tools</code></td><td>Медленно</td><td><code>requirements.lock</code></td><td>Нет</td><td>Есть <code>pip</code>, нужен lock</td></tr>
      <tr><td><code>Poetry</code></td><td>Медленно</td><td>Да</td><td>Нет (нужен pyenv)</td><td>Существующие проекты</td></tr>
      <tr><td><code>pipenv</code></td><td>Очень медленно</td><td>Да</td><td>Нет</td><td>❌ Не выбирать</td></tr>
      <tr><td><strong><code>uv</code></strong></td><td><strong>Мгновенно</strong></td><td>Да</td><td><strong>Да</strong></td><td><strong>Новые проекты (2026)</strong></td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-cog"></i> <code>pyproject.toml</code> — современный конфиг</div>
<pre><code><span class="c-comment"># pyproject.toml — как composer.json в PHP</span>
[project]
name = <span class="c-str">"my-api"</span>
version = <span class="c-str">"0.1.0"</span>
requires-python = <span class="c-str">"&gt;=3.11"</span>
dependencies = [
    <span class="c-str">"fastapi&gt;=0.110"</span>,
    <span class="c-str">"sqlalchemy&gt;=2.0"</span>,
    <span class="c-str">"asyncpg"</span>,
]

[project.optional-dependencies]
dev = [<span class="c-str">"pytest"</span>, <span class="c-str">"ruff"</span>, <span class="c-str">"mypy"</span>]

[tool.ruff]
line-length = <span class="c-num">100</span>
target-version = <span class="c-str">"py313"</span>

[tool.mypy]
strict = <span class="c-key">true</span></code></pre>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> для нового проекта в 2026 — <code>uv</code>. Для legacy/скриптов — <code>venv + pip</code>. Всегда <code>.venv/</code> в <code>.gitignore</code>. Файл <code>pyproject.toml</code> с pin-версиями + lock-файл в git — воспроизводимая сборка на CI и в проде.
  </div>
</div>

<div id="sec-exceptions" class="section">
  <div class="section-title">Исключения — try / except / raise / with</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield"></i> Базовый синтаксис</div>
<pre><code><span class="c-key">try</span>:
    data = <span class="c-fn">json</span>.<span class="c-fn">loads</span>(payload)
    result = data[<span class="c-str">"user"</span>][<span class="c-str">"id"</span>]
<span class="c-key">except</span> <span class="c-type">json</span>.<span class="c-type">JSONDecodeError</span> <span class="c-key">as</span> e:
    logger.<span class="c-fn">error</span>(<span class="c-fn">f</span><span class="c-str">"Invalid JSON: {e}"</span>)
    result = <span class="c-key">None</span>
<span class="c-key">except</span> <span class="c-type">KeyError</span> <span class="c-key">as</span> e:
    logger.<span class="c-fn">warning</span>(<span class="c-fn">f</span><span class="c-str">"Missing key: {e}"</span>)
    result = <span class="c-key">None</span>
<span class="c-key">except</span> <span class="c-type">Exception</span>:
    logger.<span class="c-fn">exception</span>(<span class="c-str">"Unexpected"</span>)   <span class="c-comment"># exception() = error() + traceback</span>
    <span class="c-key">raise</span>                              <span class="c-comment"># перебросить дальше</span>
<span class="c-key">else</span>:
    <span class="c-comment"># выполнится только если НЕ было исключения в try</span>
    logger.<span class="c-fn">info</span>(<span class="c-fn">f</span><span class="c-str">"Got user_id={result}"</span>)
<span class="c-key">finally</span>:
    <span class="c-comment"># выполнится ВСЕГДА — успех, исключение или return/break</span>
    connection.<span class="c-fn">close</span>()</code></pre>

    <div class="info-box primary">
      <strong>Правило:</strong> лови только те исключения, которые знаешь как обработать. <code>except Exception</code> без <code>raise</code> — почти всегда баг: скрывает реальные ошибки.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-branch"></i> Иерархия — во что кастовать</div>
    <div class="diagram">BaseException                    ← не ловить (SystemExit, KeyboardInterrupt)
 └── Exception                   ← ловить ВСЁ остальное
      ├── ValueError             ← неверное ЗНАЧЕНИЕ (int('abc'))
      ├── TypeError              ← неверный ТИП (len(5))
      ├── KeyError               ← нет ключа в dict
      ├── IndexError             ← индекс за пределами list
      ├── AttributeError         ← нет атрибута у объекта
      ├── FileNotFoundError      ← файл не найден (subclass OSError)
      ├── ZeroDivisionError
      ├── StopIteration          ← конец итератора
      └── RuntimeError           ← generic "что-то пошло не так"</div>
    <p class="text"><strong>Не ловить</strong> <code>BaseException</code> напрямую — там <code>KeyboardInterrupt</code> (Ctrl+C) и <code>SystemExit</code>. Пользователь не сможет прервать программу.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="upload"></i> <code>raise</code> — бросить исключение</div>
<pre><code><span class="c-key">def</span> <span class="c-fn">divide</span>(a, b):
    <span class="c-key">if</span> b == <span class="c-num">0</span>:
        <span class="c-key">raise</span> <span class="c-type">ValueError</span>(<span class="c-str">"cannot divide by zero"</span>)
    <span class="c-key">return</span> a / b

<span class="c-comment"># Перебросить с сохранением контекста</span>
<span class="c-key">try</span>:
    <span class="c-fn">do_something</span>()
<span class="c-key">except</span> <span class="c-type">Exception</span> <span class="c-key">as</span> e:
    <span class="c-key">raise</span> <span class="c-type">RuntimeError</span>(<span class="c-str">"failed"</span>) <span class="c-key">from</span> e
    <span class="c-comment"># traceback покажет ОБА — оригинал не потерян</span>

<span class="c-comment"># Голый raise — только внутри except, перебрасывает текущее</span>
<span class="c-key">try</span>:
    ...
<span class="c-key">except</span> <span class="c-type">Exception</span>:
    <span class="c-fn">log</span>(<span class="c-str">"got exception"</span>)
    <span class="c-key">raise</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="plus-circle"></i> Кастомные исключения</div>
<pre><code><span class="c-key">class</span> <span class="c-type">OrderError</span>(<span class="c-type">Exception</span>):
    <span class="c-str">"""Base для всех доменных ошибок заказов."""</span>

<span class="c-key">class</span> <span class="c-type">OrderNotFound</span>(<span class="c-type">OrderError</span>):
    <span class="c-key">pass</span>

<span class="c-key">class</span> <span class="c-type">InsufficientStock</span>(<span class="c-type">OrderError</span>):
    <span class="c-key">def</span> <span class="c-fn">__init__</span>(<span class="c-key">self</span>, sku, requested, available):
        <span class="c-key">super</span>().<span class="c-fn">__init__</span>(<span class="c-fn">f</span><span class="c-str">"SKU {sku}: need {requested}, have {available}"</span>)
        <span class="c-key">self</span>.sku = sku
        <span class="c-key">self</span>.requested = requested
        <span class="c-key">self</span>.available = available

<span class="c-comment"># Ловим одним except по базовому классу</span>
<span class="c-key">try</span>:
    <span class="c-fn">place_order</span>(...)
<span class="c-key">except</span> <span class="c-type">OrderError</span> <span class="c-key">as</span> e:
    logger.<span class="c-fn">error</span>(<span class="c-fn">f</span><span class="c-str">"Order failed: {e}"</span>)</code></pre>
    <p class="text">Свой класс — когда обработчик выше по стеку должен различать типы ошибок. Внутри одного модуля обычные <code>ValueError</code>/<code>RuntimeError</code> сойдут.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="box"></i> <code>with</code> — context managers</div>
    <p class="text">Гарантированное освобождение ресурсов даже при исключении. Аналог <code>try/finally</code>, только короче:</p>
<pre><code><span class="c-comment"># ❌ Без with — легко забыть закрыть</span>
f = <span class="c-fn">open</span>(<span class="c-str">"data.txt"</span>)
data = f.<span class="c-fn">read</span>()
f.<span class="c-fn">close</span>()                          <span class="c-comment"># не выполнится если read() кинет</span>

<span class="c-comment"># ✅ С with — close автоматически</span>
<span class="c-key">with</span> <span class="c-fn">open</span>(<span class="c-str">"data.txt"</span>) <span class="c-key">as</span> f:
    data = f.<span class="c-fn">read</span>()

<span class="c-comment"># Несколько ресурсов сразу</span>
<span class="c-key">with</span> <span class="c-fn">open</span>(<span class="c-str">"in.txt"</span>) <span class="c-key">as</span> src, <span class="c-fn">open</span>(<span class="c-str">"out.txt"</span>, <span class="c-str">"w"</span>) <span class="c-key">as</span> dst:
    dst.<span class="c-fn">write</span>(src.<span class="c-fn">read</span>())</code></pre>

    <p class="text">Свой context manager — через декоратор <code>@contextmanager</code>:</p>
<pre><code><span class="c-key">from</span> contextlib <span class="c-key">import</span> contextmanager

<span class="c-key">@contextmanager</span>
<span class="c-key">def</span> <span class="c-fn">db_transaction</span>(conn):
    conn.<span class="c-fn">begin</span>()
    <span class="c-key">try</span>:
        <span class="c-key">yield</span> conn
        conn.<span class="c-fn">commit</span>()
    <span class="c-key">except</span>:
        conn.<span class="c-fn">rollback</span>()
        <span class="c-key">raise</span>

<span class="c-key">with</span> <span class="c-fn">db_transaction</span>(conn) <span class="c-key">as</span> tx:
    tx.<span class="c-fn">execute</span>(...)</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="lightbulb"></i> EAFP vs LBYL — питоничный подход</div>
    <p class="text">Два подхода к «а вдруг что-то пойдёт не так»:</p>
    <table class="data-table">
      <tr><th></th><th>LBYL (PHP-стиль)</th><th>EAFP (питонично)</th></tr>
      <tr><td>Расшифровка</td><td>Look Before You Leap</td><td>Easier to Ask Forgiveness than Permission</td></tr>
      <tr><td>Подход</td><td>Проверить условие ДО операции</td><td>Попробовать, поймать исключение</td></tr>
      <tr>
        <td>Пример</td>
        <td><pre style="margin:0;padding:6px 8px;font-size:11px"><code><span class="c-key">if</span> <span class="c-str">"key"</span> <span class="c-key">in</span> d:
    v = d[<span class="c-str">"key"</span>]</code></pre></td>
        <td><pre style="margin:0;padding:6px 8px;font-size:11px"><code><span class="c-key">try</span>:
    v = d[<span class="c-str">"key"</span>]
<span class="c-key">except</span> <span class="c-type">KeyError</span>:
    v = <span class="c-key">None</span></code></pre></td>
      </tr>
    </table>
    <p class="text"><strong>Питоничнее — EAFP</strong>, но не догматично. <code>d.get("key")</code> ещё короче. Правило: EAFP когда «в обычном случае получится, ошибка — редкая»; LBYL когда «проверка дешёвая, ошибка ожидаема».</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>except: pass</code> — почти всегда баг.</strong> Проглатывает всё, включая <code>KeyboardInterrupt</code>. Минимум — <code>except Exception: logger.exception(...)</code>.</div>
    <div class="pitfall"><strong>2. Порядок <code>except</code> имеет значение.</strong> Специфичные — выше, общие — ниже. <code>except Exception</code> первым съест всё.</div>
    <div class="pitfall"><strong>3. Исключения — не для управления потоком.</strong> <code>for/break</code> лучше, чем <code>try/except StopIteration</code>.</div>
    <div class="pitfall"><strong>4. Не использовать исключения как return.</strong> Функция <code>get_user_or_raise()</code> ок; но не <code>find_user()</code> которая <em>всегда</em> кидает при отсутствии — верни <code>None</code>.</div>
    <div class="pitfall"><strong>5. <code>raise ... from None</code></strong> — скрывает оригинальный контекст. Используй только когда специально хочешь заменить traceback (redacting чувствительных данных).</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> лови <em>конкретные</em> исключения, не <code>Exception</code>. Используй <code>raise ... from e</code> для chaining. <code>with</code> для ресурсов — файлы, БД-соединения, блокировки. EAFP — питоничный дефолт.
  </div>
</div>

<div id="sec-files" class="section">
  <div class="section-title">Файлы + JSON + CSV + pathlib</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-text"></i> <code>open()</code> и режимы</div>
<pre><code><span class="c-comment"># Всегда через with — гарантированное закрытие</span>
<span class="c-key">with</span> <span class="c-fn">open</span>(<span class="c-str">"data.txt"</span>, encoding=<span class="c-str">"utf-8"</span>) <span class="c-key">as</span> f:
    content = f.<span class="c-fn">read</span>()

<span class="c-comment"># Режимы</span>
<span class="c-fn">open</span>(path, <span class="c-str">"r"</span>)                <span class="c-comment"># чтение (default) — если файла нет, FileNotFoundError</span>
<span class="c-fn">open</span>(path, <span class="c-str">"w"</span>)                <span class="c-comment"># запись — создаст / ПЕРЕЗАПИШЕТ</span>
<span class="c-fn">open</span>(path, <span class="c-str">"a"</span>)                <span class="c-comment"># append — создаст / допишет в конец</span>
<span class="c-fn">open</span>(path, <span class="c-str">"x"</span>)                <span class="c-comment"># exclusive create — упадёт если файл есть</span>
<span class="c-fn">open</span>(path, <span class="c-str">"r+"</span>)               <span class="c-comment"># чтение + запись</span>
<span class="c-fn">open</span>(path, <span class="c-str">"rb"</span>)               <span class="c-comment"># binary read (для картинок, PDF)</span>
<span class="c-fn">open</span>(path, <span class="c-str">"wb"</span>)               <span class="c-comment"># binary write</span>

<span class="c-comment"># Три способа чтения</span>
<span class="c-key">with</span> <span class="c-fn">open</span>(<span class="c-str">"log.txt"</span>) <span class="c-key">as</span> f:
    all_at_once = f.<span class="c-fn">read</span>()          <span class="c-comment"># одна строка</span>
    <span class="c-comment"># или</span>
    lines = f.<span class="c-fn">readlines</span>()           <span class="c-comment"># список строк (все в память)</span>
    <span class="c-comment"># или (лучший для больших файлов) — построчно</span>
    <span class="c-key">for</span> line <span class="c-key">in</span> f:
        <span class="c-fn">process</span>(line.<span class="c-fn">rstrip</span>())        <span class="c-comment"># O(1) память</span>

<span class="c-comment"># Запись</span>
<span class="c-key">with</span> <span class="c-fn">open</span>(<span class="c-str">"out.txt"</span>, <span class="c-str">"w"</span>, encoding=<span class="c-str">"utf-8"</span>) <span class="c-key">as</span> f:
    f.<span class="c-fn">write</span>(<span class="c-str">"one line\n"</span>)
    f.<span class="c-fn">writelines</span>([<span class="c-str">"a\n"</span>, <span class="c-str">"b\n"</span>])   <span class="c-comment"># не добавит \n сам!</span></code></pre>

    <div class="pitfall"><strong>⚠ Всегда указывай <code>encoding="utf-8"</code>.</strong> Без него берётся дефолтный OS — на Windows это cp1251, на Linux utf-8. Один код будет ломаться на разных ОС.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="folder-tree"></i> <code>pathlib.Path</code> — современная работа с путями</div>
    <p class="text">Забудь про <code>os.path.join</code>, <code>os.path.exists</code>, <code>os.listdir</code>. <code>pathlib</code> (Python 3.4+) — ООП-обёртка, чище и переносимо.</p>
<pre><code><span class="c-key">from</span> pathlib <span class="c-key">import</span> Path

p = <span class="c-fn">Path</span>(<span class="c-str">"/var/log/app.log"</span>)
p = <span class="c-fn">Path</span>(<span class="c-str">"data"</span>) / <span class="c-str">"users.json"</span>       <span class="c-comment"># склейка через /</span>
p = <span class="c-type">Path</span>.<span class="c-fn">home</span>() / <span class="c-str">".config"</span> / <span class="c-str">"app"</span>     <span class="c-comment"># $HOME/.config/app</span>

<span class="c-comment"># Свойства</span>
p.name                          <span class="c-comment"># "app.log"</span>
p.stem                          <span class="c-comment"># "app" (без расширения)</span>
p.suffix                        <span class="c-comment"># ".log"</span>
p.parent                        <span class="c-comment"># Path("/var/log")</span>
p.parts                         <span class="c-comment"># ("/", "var", "log", "app.log")</span>
p.absolute()                    <span class="c-comment"># абсолютный путь</span>

<span class="c-comment"># Проверки</span>
p.<span class="c-fn">exists</span>()
p.<span class="c-fn">is_file</span>()
p.<span class="c-fn">is_dir</span>()

<span class="c-comment"># Операции</span>
p.<span class="c-fn">mkdir</span>(parents=<span class="c-key">True</span>, exist_ok=<span class="c-key">True</span>)     <span class="c-comment"># создать директорию (рекурсивно, no-op если есть)</span>
p.<span class="c-fn">unlink</span>(missing_ok=<span class="c-key">True</span>)                <span class="c-comment"># удалить файл</span>
p.<span class="c-fn">rename</span>(<span class="c-fn">Path</span>(<span class="c-str">"new_name.log"</span>))
p.<span class="c-fn">rmdir</span>()                                <span class="c-comment"># удалить пустую директорию</span>

<span class="c-comment"># Обход директории</span>
<span class="c-key">for</span> item <span class="c-key">in</span> <span class="c-fn">Path</span>(<span class="c-str">"."</span>).<span class="c-fn">iterdir</span>():           <span class="c-comment"># прямые потомки</span>
    <span class="c-fn">print</span>(item)

<span class="c-key">for</span> py <span class="c-key">in</span> <span class="c-fn">Path</span>(<span class="c-str">"src"</span>).<span class="c-fn">rglob</span>(<span class="c-str">"*.py"</span>):       <span class="c-comment">// рекурсивно по glob</span>
    <span class="c-fn">print</span>(py)

<span class="c-comment"># Чтение / запись — методы прямо на Path</span>
text = <span class="c-fn">Path</span>(<span class="c-str">"config.txt"</span>).<span class="c-fn">read_text</span>(encoding=<span class="c-str">"utf-8"</span>)
<span class="c-fn">Path</span>(<span class="c-str">"out.txt"</span>).<span class="c-fn">write_text</span>(<span class="c-str">"hello"</span>, encoding=<span class="c-str">"utf-8"</span>)
data = <span class="c-fn">Path</span>(<span class="c-str">"image.png"</span>).<span class="c-fn">read_bytes</span>()</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="braces"></i> JSON — модуль <code>json</code></div>
<pre><code><span class="c-key">import</span> json

<span class="c-comment"># Из строки → Python-объект</span>
data = <span class="c-fn">json</span>.<span class="c-fn">loads</span>(<span class="c-str">'{"name": "Alice", "age": 30}'</span>)
<span class="c-comment"># data = {"name": "Alice", "age": 30}</span>

<span class="c-comment"># Python-объект → строку</span>
s = <span class="c-fn">json</span>.<span class="c-fn">dumps</span>(data)
s = <span class="c-fn">json</span>.<span class="c-fn">dumps</span>(data, indent=<span class="c-num">2</span>, ensure_ascii=<span class="c-key">False</span>)
<span class="c-comment"># ensure_ascii=False — не эскейпить кириллицу в \uXXXX</span>

<span class="c-comment"># Из / в файл — load/dump без "s"</span>
<span class="c-key">with</span> <span class="c-fn">open</span>(<span class="c-str">"data.json"</span>, encoding=<span class="c-str">"utf-8"</span>) <span class="c-key">as</span> f:
    data = <span class="c-fn">json</span>.<span class="c-fn">load</span>(f)

<span class="c-key">with</span> <span class="c-fn">open</span>(<span class="c-str">"out.json"</span>, <span class="c-str">"w"</span>, encoding=<span class="c-str">"utf-8"</span>) <span class="c-key">as</span> f:
    <span class="c-fn">json</span>.<span class="c-fn">dump</span>(data, f, indent=<span class="c-num">2</span>, ensure_ascii=<span class="c-key">False</span>)

<span class="c-comment"># Соответствия типов</span>
<span class="c-comment"># JSON     → Python</span>
<span class="c-comment"># object   → dict</span>
<span class="c-comment"># array    → list</span>
<span class="c-comment"># string   → str</span>
<span class="c-comment"># number   → int / float</span>
<span class="c-comment"># true     → True</span>
<span class="c-comment"># null     → None</span>

<span class="c-comment"># Ошибки</span>
<span class="c-key">try</span>:
    data = <span class="c-fn">json</span>.<span class="c-fn">loads</span>(payload)
<span class="c-key">except</span> <span class="c-type">json</span>.<span class="c-type">JSONDecodeError</span> <span class="c-key">as</span> e:
    logger.<span class="c-fn">error</span>(<span class="c-fn">f</span><span class="c-str">"bad JSON: {e}"</span>)</code></pre>

    <div class="pitfall"><strong>⚠ <code>datetime</code> не сериализуется по умолчанию.</strong> <code>json.dumps({"created": datetime.now()})</code> → <code>TypeError</code>. Решения: конвертировать в строку заранее (<code>.isoformat()</code>), либо <code>json.dumps(..., default=str)</code>, либо использовать Pydantic.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="table"></i> CSV — модуль <code>csv</code></div>
<pre><code><span class="c-key">import</span> csv

<span class="c-comment"># Чтение — обычные списки-строки</span>
<span class="c-key">with</span> <span class="c-fn">open</span>(<span class="c-str">"users.csv"</span>, encoding=<span class="c-str">"utf-8"</span>) <span class="c-key">as</span> f:
    reader = <span class="c-fn">csv</span>.<span class="c-fn">reader</span>(f)
    header = <span class="c-fn">next</span>(reader)          <span class="c-comment"># первая строка — обычно шапка</span>
    <span class="c-key">for</span> row <span class="c-key">in</span> reader:
        <span class="c-fn">print</span>(row)              <span class="c-comment"># ['Alice', '30', 'a@b.c']</span>

<span class="c-comment"># Чтение как dict — DictReader (питоничнее)</span>
<span class="c-key">with</span> <span class="c-fn">open</span>(<span class="c-str">"users.csv"</span>, encoding=<span class="c-str">"utf-8"</span>) <span class="c-key">as</span> f:
    <span class="c-key">for</span> row <span class="c-key">in</span> <span class="c-fn">csv</span>.<span class="c-fn">DictReader</span>(f):
        <span class="c-fn">print</span>(row[<span class="c-str">"name"</span>], row[<span class="c-str">"email"</span>])

<span class="c-comment"># Запись</span>
<span class="c-key">with</span> <span class="c-fn">open</span>(<span class="c-str">"out.csv"</span>, <span class="c-str">"w"</span>, encoding=<span class="c-str">"utf-8"</span>, newline=<span class="c-str">""</span>) <span class="c-key">as</span> f:
    <span class="c-comment"># newline="" — обязательно, иначе на Windows \r\r\n</span>
    writer = <span class="c-fn">csv</span>.<span class="c-fn">DictWriter</span>(f, fieldnames=[<span class="c-str">"name"</span>, <span class="c-str">"age"</span>])
    writer.<span class="c-fn">writeheader</span>()
    writer.<span class="c-fn">writerow</span>({<span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>, <span class="c-str">"age"</span>: <span class="c-num">30</span>})
    writer.<span class="c-fn">writerows</span>([{<span class="c-str">"name"</span>: <span class="c-str">"Bob"</span>, <span class="c-str">"age"</span>: <span class="c-num">25</span>}])

<span class="c-comment"># Кастомный разделитель — TSV, semicolon</span>
reader = <span class="c-fn">csv</span>.<span class="c-fn">reader</span>(f, delimiter=<span class="c-str">";"</span>)</code></pre>

    <div class="pitfall"><strong>⚠ Excel «съедает» leading zeros.</strong> Если открываешь CSV в Excel — <code>"00123"</code> станет <code>123</code>. Не проблема Python, но пользователи ругаются. Для reliable выгрузки в Excel — <code>.xlsx</code> через <code>openpyxl</code>.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Забыл <code>with</code>.</strong> <code>f = open(path)</code> без <code>close()</code> — файл висит открытым, на Windows его нельзя переименовать, на Linux — деcкриптор течёт.</div>
    <div class="pitfall"><strong>2. Загрузка гигабайтного файла в память.</strong> <code>f.read()</code> прочтёт всё сразу. Для больших — <code>for line in f</code> или чтение чанками <code>f.read(8192)</code>.</div>
    <div class="pitfall"><strong>3. <code>json.dumps</code> без <code>ensure_ascii=False</code>.</strong> Кириллица превратится в <code>При...</code> — читабельно, но раздутый файл. Всегда <code>ensure_ascii=False</code> для внутреннего использования.</div>
    <div class="pitfall"><strong>4. <code>csv</code> без <code>newline=""</code>.</strong> На Windows будут двойные переносы строк.</div>
    <div class="pitfall"><strong>5. Относительные пути.</strong> <code>open("data.txt")</code> откроет от <em>текущей рабочей директории</em>, а не от файла со скриптом. Лучше: <code>Path(__file__).parent / "data.txt"</code>.</div>
  </div>
</div>

<div id="sec-decorators" class="section">
  <div class="section-title">Декораторы <code>@</code></div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Что такое декоратор</div>
    <p class="text"><strong>Декоратор</strong> — функция, принимающая другую функцию и возвращающая новую (обычно с дополнительным поведением до/после вызова). Синтаксис <code>@decorator</code> — просто сахар над <code>func = decorator(func)</code>.</p>
<pre><code><span class="c-comment"># Простой декоратор — измеряет время выполнения</span>
<span class="c-key">import</span> time
<span class="c-key">from</span> functools <span class="c-key">import</span> wraps

<span class="c-key">def</span> <span class="c-fn">timed</span>(func):
    <span class="c-key">@wraps</span>(func)                     <span class="c-comment"># сохраняет __name__/__doc__ оригинала</span>
    <span class="c-key">def</span> <span class="c-fn">wrapper</span>(*args, **kwargs):
        start = time.<span class="c-fn">perf_counter</span>()
        result = <span class="c-fn">func</span>(*args, **kwargs)
        elapsed = time.<span class="c-fn">perf_counter</span>() - start
        <span class="c-fn">print</span>(<span class="c-fn">f</span><span class="c-str">"{func.__name__} took {elapsed:.3f}s"</span>)
        <span class="c-key">return</span> result
    <span class="c-key">return</span> wrapper

<span class="c-key">@timed</span>
<span class="c-key">def</span> <span class="c-fn">slow_calc</span>(n):
    time.<span class="c-fn">sleep</span>(<span class="c-num">1</span>)
    <span class="c-key">return</span> n * <span class="c-num">2</span>

<span class="c-fn">slow_calc</span>(<span class="c-num">5</span>)
<span class="c-comment"># slow_calc took 1.001s</span>
<span class="c-comment"># 10</span></code></pre>

    <p class="text">Эквивалент без синтаксиса <code>@</code>:</p>
<pre><code><span class="c-key">def</span> <span class="c-fn">slow_calc</span>(n): ...
slow_calc = <span class="c-fn">timed</span>(slow_calc)   <span class="c-comment"># ровно то же самое</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="settings-2"></i> Декоратор с аргументами</div>
<pre><code><span class="c-comment"># Retry с настраиваемым числом попыток</span>
<span class="c-key">def</span> <span class="c-fn">retry</span>(times=<span class="c-num">3</span>, delay=<span class="c-num">1.0</span>):
    <span class="c-key">def</span> <span class="c-fn">decorator</span>(func):
        <span class="c-key">@wraps</span>(func)
        <span class="c-key">def</span> <span class="c-fn">wrapper</span>(*args, **kwargs):
            last_error = <span class="c-key">None</span>
            <span class="c-key">for</span> attempt <span class="c-key">in</span> <span class="c-fn">range</span>(times):
                <span class="c-key">try</span>:
                    <span class="c-key">return</span> <span class="c-fn">func</span>(*args, **kwargs)
                <span class="c-key">except</span> <span class="c-type">Exception</span> <span class="c-key">as</span> e:
                    last_error = e
                    time.<span class="c-fn">sleep</span>(delay)
            <span class="c-key">raise</span> last_error
        <span class="c-key">return</span> wrapper
    <span class="c-key">return</span> decorator

<span class="c-key">@retry</span>(times=<span class="c-num">5</span>, delay=<span class="c-num">0.5</span>)
<span class="c-key">def</span> <span class="c-fn">fetch_url</span>(url):
    <span class="c-key">return</span> requests.<span class="c-fn">get</span>(url)</code></pre>
    <p class="text">Три уровня функций: <code>retry(times=3)</code> возвращает <code>decorator</code>, тот принимает <code>func</code>, а <code>wrapper</code> уже делает работу. Синтаксический сахар разворачивается в <code>fetch_url = retry(times=5, delay=0.5)(fetch_url)</code>.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="library"></i> Встроенные / stdlib декораторы</div>
    <table class="data-table">
      <tr><th>Декоратор</th><th>Что делает</th></tr>
      <tr><td><code>@property</code></td><td>Getter, вызываемый как атрибут</td></tr>
      <tr><td><code>@staticmethod</code></td><td>Метод без <code>self</code>/<code>cls</code></td></tr>
      <tr><td><code>@classmethod</code></td><td>Метод, получающий <code>cls</code> вместо <code>self</code></td></tr>
      <tr><td><code>@dataclass</code></td><td>Автогенерирует <code>__init__</code>/<code>__repr__</code>/<code>__eq__</code></td></tr>
      <tr><td><code>@functools.cache</code></td><td>Мемоизация — кеш результата по аргументам</td></tr>
      <tr><td><code>@functools.lru_cache(maxsize=128)</code></td><td>Мемоизация с ограничением размера</td></tr>
      <tr><td><code>@functools.wraps(func)</code></td><td>Сохраняет метаданные оригинала — используй в своих</td></tr>
      <tr><td><code>@abstractmethod</code></td><td>Абстрактный метод (в <code>ABC</code>-классе)</td></tr>
      <tr><td><code>@contextmanager</code></td><td>Превращает генератор в context manager</td></tr>
    </table>

<pre><code><span class="c-key">from</span> functools <span class="c-key">import</span> cache

<span class="c-key">@cache</span>
<span class="c-key">def</span> <span class="c-fn">fib</span>(n):
    <span class="c-key">if</span> n &lt; <span class="c-num">2</span>: <span class="c-key">return</span> n
    <span class="c-key">return</span> <span class="c-fn">fib</span>(n-<span class="c-num">1</span>) + <span class="c-fn">fib</span>(n-<span class="c-num">2</span>)

<span class="c-fn">fib</span>(<span class="c-num">100</span>)     <span class="c-comment"># мгновенно — благодаря кешу</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="server"></i> Декораторы во фреймворках</div>
<pre><code><span class="c-comment"># Flask</span>
<span class="c-key">@app</span>.<span class="c-fn">route</span>(<span class="c-str">"/users/&lt;int:id&gt;"</span>)
<span class="c-key">def</span> <span class="c-fn">get_user</span>(id): ...

<span class="c-comment"># FastAPI</span>
<span class="c-key">@app</span>.<span class="c-fn">get</span>(<span class="c-str">"/users/{id}"</span>)
<span class="c-key">def</span> <span class="c-fn">get_user</span>(id: <span class="c-type">int</span>): ...

<span class="c-comment"># pytest — параметризация тестов</span>
<span class="c-key">@pytest</span>.<span class="c-fn">mark</span>.<span class="c-fn">parametrize</span>(<span class="c-str">"a, expected"</span>, [(<span class="c-num">1</span>, <span class="c-num">2</span>), (<span class="c-num">2</span>, <span class="c-num">4</span>)])
<span class="c-key">def</span> <span class="c-fn">test_double</span>(a, expected):
    <span class="c-key">assert</span> <span class="c-fn">double</span>(a) == expected

<span class="c-comment"># Django — авторизация</span>
<span class="c-key">@login_required</span>
<span class="c-key">def</span> <span class="c-fn">profile</span>(request): ...</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Забыл <code>@wraps</code>.</strong> <code>wrapper.__name__</code> станет <code>"wrapper"</code>, а не имя оригинальной функции. Ломает <code>help()</code>, debug, некоторые фреймворки (Flask ругается на конфликт имён при регистрации роутов).</div>
    <div class="pitfall"><strong>2. Порядок декораторов важен.</strong> <code>@a @b def f()</code> = <code>f = a(b(f))</code>. Ближний к функции — применяется первым. Для маршрутов часто важно: <code>@app.route @login_required</code> — сначала auth-check.</div>
    <div class="pitfall"><strong>3. Декоратор с/без аргументов — разные функции.</strong> <code>@retry</code> и <code>@retry()</code> — не одно и то же. Первый передаст <code>retry(func)</code>, второй — <code>retry()(func)</code>.</div>
    <div class="pitfall"><strong>4. Type hints оригинала теряются</strong> если декоратор не типизирован через <code>ParamSpec</code>. Для нового кода — <code>ParamSpec</code> из <code>typing</code> (Python 3.10+).</div>
    <div class="pitfall"><strong>5. Не переусердствуй.</strong> Стек из 4-5 декораторов на одной функции — сложно отлаживать. Логики много — сделай явный класс.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> декоратор = функция, оборачивающая функцию. <code>@wraps</code> — обязательно. Встроенные (<code>@property</code>, <code>@dataclass</code>, <code>@cache</code>) — используй сразу. Свои — для сквозных обязанностей: логирование, retry, кеш, auth-check в фреймворке.
  </div>
</div>

<div id="sec-typing" class="section">
  <div class="section-title">Type hints + mypy</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-check"></i> Базовый синтаксис</div>
<pre><code><span class="c-comment"># Переменные</span>
name: <span class="c-type">str</span> = <span class="c-str">"Alice"</span>
age: <span class="c-type">int</span> = <span class="c-num">30</span>
is_active: <span class="c-type">bool</span> = <span class="c-key">True</span>
tags: <span class="c-type">list</span>[<span class="c-type">str</span>] = [<span class="c-str">"php"</span>, <span class="c-str">"python"</span>]
user: <span class="c-type">dict</span>[<span class="c-type">str</span>, <span class="c-type">int</span>] = {<span class="c-str">"age"</span>: <span class="c-num">30</span>}

<span class="c-comment"># Функции</span>
<span class="c-key">def</span> <span class="c-fn">greet</span>(name: <span class="c-type">str</span>, times: <span class="c-type">int</span> = <span class="c-num">1</span>) -&gt; <span class="c-type">str</span>:
    <span class="c-key">return</span> (<span class="c-fn">f</span><span class="c-str">"Hi {name}! "</span>) * times

<span class="c-comment"># Возврат None (void в других языках)</span>
<span class="c-key">def</span> <span class="c-fn">log_it</span>(msg: <span class="c-type">str</span>) -&gt; <span class="c-key">None</span>:
    <span class="c-fn">print</span>(msg)

<span class="c-comment"># Классы</span>
<span class="c-key">class</span> <span class="c-type">User</span>:
    name: <span class="c-type">str</span>
    age: <span class="c-type">int</span>

    <span class="c-key">def</span> <span class="c-fn">__init__</span>(<span class="c-key">self</span>, name: <span class="c-type">str</span>, age: <span class="c-type">int</span>) -&gt; <span class="c-key">None</span>:
        <span class="c-key">self</span>.name = name
        <span class="c-key">self</span>.age = age</code></pre>

    <div class="info-box primary">
      <strong>Ключевое:</strong> type hints — <em>подсказки</em>, не enforcement. Python <em>не проверяет</em> их в рантайме. Проверяет отдельный tool — <code>mypy</code>. IDE использует их для автокомплита и подсветки ошибок.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-merge"></i> Опциональные и объединения — <code>|</code></div>
<pre><code><span class="c-comment"># X | None — может быть X или None (Python 3.10+)</span>
<span class="c-key">def</span> <span class="c-fn">find_user</span>(id: <span class="c-type">int</span>) -&gt; <span class="c-type">User</span> | <span class="c-key">None</span>:
    ...

<span class="c-comment"># Legacy до 3.10 (ещё встречается)</span>
<span class="c-key">from</span> typing <span class="c-key">import</span> Optional
<span class="c-key">def</span> <span class="c-fn">find_user</span>(id: <span class="c-type">int</span>) -&gt; <span class="c-type">Optional</span>[<span class="c-type">User</span>]:
    ...

<span class="c-comment"># Union — X или Y или Z</span>
<span class="c-key">def</span> <span class="c-fn">parse</span>(value: <span class="c-type">str</span> | <span class="c-type">int</span> | <span class="c-type">float</span>) -&gt; <span class="c-type">float</span>:
    ...

<span class="c-comment"># Коллекции с несколькими типами внутри</span>
users: <span class="c-type">list</span>[<span class="c-type">User</span> | <span class="c-type">Admin</span>] = [...]</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package-open"></i> Коллекции — новый vs старый синтаксис</div>
    <table class="data-table">
      <tr><th>Legacy (до Python 3.9)</th><th>Modern (3.9+)</th></tr>
      <tr><td><code>List[int]</code></td><td><code>list[int]</code></td></tr>
      <tr><td><code>Dict[str, int]</code></td><td><code>dict[str, int]</code></td></tr>
      <tr><td><code>Tuple[int, str]</code></td><td><code>tuple[int, str]</code></td></tr>
      <tr><td><code>Set[int]</code></td><td><code>set[int]</code></td></tr>
      <tr><td><code>Optional[X]</code></td><td><code>X | None</code> (3.10+)</td></tr>
      <tr><td><code>Union[X, Y]</code></td><td><code>X | Y</code> (3.10+)</td></tr>
    </table>
    <p class="text">В новом коде — только <code>list</code>/<code>dict</code>/<code>|</code>. Импорты из <code>typing</code> для этих типов больше не нужны.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> Специальные типы</div>
<pre><code><span class="c-key">from</span> typing <span class="c-key">import</span> Any, Callable, Literal, Final, TypedDict, Protocol

<span class="c-comment"># Any — «выключить» type-check (использовать в крайних случаях)</span>
<span class="c-key">def</span> <span class="c-fn">parse_json</span>(s: <span class="c-type">str</span>) -&gt; <span class="c-type">Any</span>:
    <span class="c-key">return</span> <span class="c-fn">json</span>.<span class="c-fn">loads</span>(s)

<span class="c-comment"># Callable — функция как аргумент</span>
<span class="c-key">def</span> <span class="c-fn">apply</span>(func: <span class="c-type">Callable</span>[[<span class="c-type">int</span>, <span class="c-type">int</span>], <span class="c-type">int</span>], a: <span class="c-type">int</span>, b: <span class="c-type">int</span>) -&gt; <span class="c-type">int</span>:
    <span class="c-key">return</span> <span class="c-fn">func</span>(a, b)

<span class="c-comment"># Literal — конкретные значения</span>
<span class="c-key">def</span> <span class="c-fn">set_status</span>(status: <span class="c-type">Literal</span>[<span class="c-str">"active"</span>, <span class="c-str">"paused"</span>, <span class="c-str">"stopped"</span>]) -&gt; <span class="c-key">None</span>:
    ...
<span class="c-fn">set_status</span>(<span class="c-str">"active"</span>)     <span class="c-comment"># ✅</span>
<span class="c-fn">set_status</span>(<span class="c-str">"deleted"</span>)    <span class="c-comment"># ❌ mypy error</span>

<span class="c-comment"># Final — константа, mypy запретит перезаписать</span>
MAX_RETRIES: <span class="c-type">Final</span>[<span class="c-type">int</span>] = <span class="c-num">3</span>

<span class="c-comment"># TypedDict — структура словаря</span>
<span class="c-key">class</span> <span class="c-type">UserDict</span>(<span class="c-type">TypedDict</span>):
    name: <span class="c-type">str</span>
    age: <span class="c-type">int</span>
    email: <span class="c-type">str</span> | <span class="c-key">None</span>

<span class="c-key">def</span> <span class="c-fn">save_user</span>(u: <span class="c-type">UserDict</span>) -&gt; <span class="c-key">None</span>: ...

<span class="c-comment"># Protocol — duck typing со статической проверкой</span>
<span class="c-key">class</span> <span class="c-type">HasName</span>(<span class="c-type">Protocol</span>):
    name: <span class="c-type">str</span>

<span class="c-key">def</span> <span class="c-fn">greet</span>(obj: <span class="c-type">HasName</span>) -&gt; <span class="c-type">str</span>:
    <span class="c-key">return</span> <span class="c-fn">f</span><span class="c-str">"Hi {obj.name}"</span>
<span class="c-comment"># Работает с любым классом у которого есть поле name — независимо от наследования</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="wrench"></i> mypy — статическая проверка</div>
<pre><code><span class="c-comment"># Установка</span>
uv add --dev mypy

<span class="c-comment"># Запуск</span>
mypy app.py
mypy src/

<span class="c-comment"># Конфиг — pyproject.toml</span>
[tool.mypy]
python_version = <span class="c-str">"3.13"</span>
strict = <span class="c-key">true</span>                    <span class="c-comment"># все проверки на максимум</span>
warn_unused_ignores = <span class="c-key">true</span>
disallow_untyped_defs = <span class="c-key">true</span>

<span class="c-comment"># Игнорировать одну строку</span>
result = <span class="c-fn">something_weird</span>()  <span class="c-comment"># type: ignore[assignment]</span>

<span class="c-comment"># Игнорировать модуль без типов</span>
[[tool.mypy.overrides]]
module = <span class="c-str">"legacy_lib.*"</span>
ignore_missing_imports = <span class="c-key">true</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Type hints — не enforcement.</strong> <code>x: int = "hello"</code> запустится без ошибки в рантайме. Только mypy заметит. Для проверки в рантайме — Pydantic (см. <a href="#" onclick="showSection('fastapi', document.querySelector('[onclick*=fastapi]')); return false;">FastAPI</a>).</div>
    <div class="pitfall"><strong>2. Forward reference — в кавычках.</strong> Если типизируешь классом, который ещё не определён (self-reference или взаимные ссылки) — используй строку: <code>def foo(self) -&gt; "User"</code> или <code>from __future__ import annotations</code> в начале файла.</div>
    <div class="pitfall"><strong>3. <code>Any</code> — «выключение» типизации.</strong> Использовать как крайнюю меру. mypy пропускает через <code>Any</code> любые операции.</div>
    <div class="pitfall"><strong>4. Legacy импорты <code>List</code>/<code>Dict</code>.</strong> В новом коде — <code>list</code>/<code>dict</code>. Не смешивай.</div>
    <div class="pitfall"><strong>5. mypy strict сразу — больно.</strong> На существующем проекте включай постепенно: сначала для новых модулей, потом расширяй.</div>
    <div class="pitfall"><strong>6. Runtime access к аннотациям.</strong> <code>func.__annotations__</code> — dict имя→тип. Используется Pydantic, FastAPI, dataclasses для генерации кода.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> в новом Python-коде <em>всегда</em> пиши type hints — читаемость + IDE + mypy окупают дополнительные символы. Модерн: <code>list[int]</code>, <code>X | None</code>, <code>TypedDict</code>, <code>Protocol</code>. Настрой mypy strict в pyproject.toml и запусти в CI.
  </div>
</div>

<div id="sec-async" class="section">
  <div class="section-title">async / await + asyncio</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Зачем async в backend</div>
    <p class="text">HTTP-запрос к БД, вызов внешнего API, чтение файла — во всех случаях процесс <em>ждёт I/O</em>. Синхронный код в этот момент <strong>блокирует поток</strong>. Async позволяет одному потоку обслуживать сотни одновременных операций I/O — пока один запрос ждёт БД, поток обрабатывает другие.</p>

    <div class="analogy">
      <strong>Аналогия:</strong> синхронный официант обслуживает один столик — приняв заказ, стоит рядом и ждёт пока клиент выберет десерт. Async-официант — принял заказ, пошёл к следующему столику; вернётся, когда клиент помашет рукой.
    </div>

    <p class="text"><strong>Когда нужен async:</strong></p>
    <ul class="bullets">
      <li>HTTP API с тысячами RPS (FastAPI async — стандарт)</li>
      <li>WebSocket-серверы, real-time</li>
      <li>Web-scrapers — тысячи параллельных запросов</li>
      <li>Микросервисы с множеством внешних вызовов</li>
    </ul>
    <p class="text"><strong>Когда НЕ нужен:</strong> CPU-heavy вычисления (тут async не помогает — нужен <code>multiprocessing</code>), простые CRUD с 5 RPS, скрипты. Не тащить async туда, где он не нужен — иначе получишь сложный код без выигрыша.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="code-2"></i> Базовый синтаксис</div>
<pre><code><span class="c-key">import</span> asyncio

<span class="c-comment"># async def создаёт корутину, не исполняет функцию сразу</span>
<span class="c-key">async def</span> <span class="c-fn">fetch_user</span>(id: <span class="c-type">int</span>) -&gt; <span class="c-type">dict</span>:
    <span class="c-key">await</span> asyncio.<span class="c-fn">sleep</span>(<span class="c-num">1</span>)          <span class="c-comment"># эмуляция I/O</span>
    <span class="c-key">return</span> {<span class="c-str">"id"</span>: id, <span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>}

<span class="c-comment"># Обычный вызов вернёт корутину, не результат:</span>
<span class="c-fn">fetch_user</span>(<span class="c-num">1</span>)         <span class="c-comment"># &lt;coroutine object fetch_user at 0x...&gt;</span>

<span class="c-comment"># Правильный запуск — только через event loop:</span>
result = asyncio.<span class="c-fn">run</span>(<span class="c-fn">fetch_user</span>(<span class="c-num">1</span>))

<span class="c-comment"># await — только внутри async def</span>
<span class="c-key">async def</span> <span class="c-fn">main</span>():
    user = <span class="c-key">await</span> <span class="c-fn">fetch_user</span>(<span class="c-num">1</span>)      <span class="c-comment"># дождались, получили dict</span>
    <span class="c-fn">print</span>(user)

asyncio.<span class="c-fn">run</span>(<span class="c-fn">main</span>())</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="split"></i> Параллельное выполнение — <code>gather</code></div>
<pre><code><span class="c-key">async def</span> <span class="c-fn">fetch_user</span>(id):
    <span class="c-key">await</span> asyncio.<span class="c-fn">sleep</span>(<span class="c-num">1</span>)
    <span class="c-key">return</span> {<span class="c-str">"id"</span>: id}

<span class="c-comment"># ❌ Последовательно — 3 секунды</span>
<span class="c-key">async def</span> <span class="c-fn">bad</span>():
    a = <span class="c-key">await</span> <span class="c-fn">fetch_user</span>(<span class="c-num">1</span>)
    b = <span class="c-key">await</span> <span class="c-fn">fetch_user</span>(<span class="c-num">2</span>)
    c = <span class="c-key">await</span> <span class="c-fn">fetch_user</span>(<span class="c-num">3</span>)

<span class="c-comment"># ✅ Параллельно — 1 секунда</span>
<span class="c-key">async def</span> <span class="c-fn">good</span>():
    a, b, c = <span class="c-key">await</span> asyncio.<span class="c-fn">gather</span>(
        <span class="c-fn">fetch_user</span>(<span class="c-num">1</span>),
        <span class="c-fn">fetch_user</span>(<span class="c-num">2</span>),
        <span class="c-fn">fetch_user</span>(<span class="c-num">3</span>),
    )

<span class="c-comment"># Обработка ошибок в gather</span>
results = <span class="c-key">await</span> asyncio.<span class="c-fn">gather</span>(*tasks, return_exceptions=<span class="c-key">True</span>)
<span class="c-comment"># исключения будут В списке, не бросят весь gather</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="clock"></i> Таймауты и отмена</div>
<pre><code><span class="c-comment"># Timeout — Python 3.11+</span>
<span class="c-key">async def</span> <span class="c-fn">get_with_timeout</span>():
    <span class="c-key">async with</span> asyncio.<span class="c-fn">timeout</span>(<span class="c-num">5.0</span>):
        <span class="c-key">return</span> <span class="c-key">await</span> <span class="c-fn">slow_operation</span>()

<span class="c-comment"># Legacy до 3.11 — wait_for</span>
result = <span class="c-key">await</span> asyncio.<span class="c-fn">wait_for</span>(<span class="c-fn">slow_operation</span>(), timeout=<span class="c-num">5.0</span>)

<span class="c-comment"># Создать задачу в фоне — не блокировать текущую функцию</span>
task = asyncio.<span class="c-fn">create_task</span>(<span class="c-fn">background_job</span>())
<span class="c-fn">print</span>(<span class="c-str">"main continues..."</span>)
<span class="c-key">await</span> task                       <span class="c-comment"># дождаться когда потребуется</span>
task.<span class="c-fn">cancel</span>()                    <span class="c-comment"># можно отменить</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="globe"></i> Async в реальном коде — HTTP, БД</div>
<pre><code><span class="c-comment"># HTTP через httpx (async-first, поддерживает и sync)</span>
<span class="c-key">import</span> httpx

<span class="c-key">async def</span> <span class="c-fn">fetch_all</span>(urls):
    <span class="c-key">async with</span> httpx.<span class="c-type">AsyncClient</span>() <span class="c-key">as</span> client:
        tasks = [client.<span class="c-fn">get</span>(url) <span class="c-key">for</span> url <span class="c-key">in</span> urls]
        responses = <span class="c-key">await</span> asyncio.<span class="c-fn">gather</span>(*tasks)
        <span class="c-key">return</span> [r.<span class="c-fn">json</span>() <span class="c-key">for</span> r <span class="c-key">in</span> responses]

<span class="c-comment"># БД через asyncpg (PostgreSQL)</span>
<span class="c-key">import</span> asyncpg

<span class="c-key">async def</span> <span class="c-fn">get_users</span>():
    conn = <span class="c-key">await</span> asyncpg.<span class="c-fn">connect</span>(<span class="c-str">"postgresql://..."</span>)
    rows = <span class="c-key">await</span> conn.<span class="c-fn">fetch</span>(<span class="c-str">"SELECT id, name FROM users"</span>)
    <span class="c-key">await</span> conn.<span class="c-fn">close</span>()
    <span class="c-key">return</span> rows

<span class="c-comment"># SQLAlchemy 2.0 async</span>
<span class="c-key">from</span> sqlalchemy.ext.asyncio <span class="c-key">import</span> create_async_engine, AsyncSession

engine = <span class="c-fn">create_async_engine</span>(<span class="c-str">"postgresql+asyncpg://..."</span>)
<span class="c-key">async with</span> <span class="c-type">AsyncSession</span>(engine) <span class="c-key">as</span> session:
    result = <span class="c-key">await</span> session.<span class="c-fn">execute</span>(<span class="c-fn">select</span>(<span class="c-type">User</span>))
    users = result.<span class="c-fn">scalars</span>().<span class="c-fn">all</span>()</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare-arrows"></i> asyncio vs threading vs multiprocessing</div>
    <table class="data-table">
      <tr><th></th><th>asyncio</th><th>threading</th><th>multiprocessing</th></tr>
      <tr><td>Для чего</td><td>I/O-bound (HTTP, БД)</td><td>I/O-bound + legacy code</td><td>CPU-bound</td></tr>
      <tr><td>GIL мешает?</td><td>Нет (один поток)</td><td>Да, но I/O освобождает</td><td>Нет (разные процессы)</td></tr>
      <tr><td>Overhead</td><td>Минимальный</td><td>Средний</td><td>Высокий</td></tr>
      <tr><td>Общая память</td><td>Да (тот же процесс)</td><td>Да, нужны locks</td><td>Нет (IPC)</td></tr>
      <tr><td>Тысячи задач</td><td>✅ Легко</td><td>❌ Кончится память</td><td>❌ Overhead убьёт</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Забыл <code>await</code>.</strong> <code>result = fetch_user(1)</code> — в <code>result</code> корутина, а не dict. IDE подсветит; при запуске упадёт с <code>RuntimeWarning: coroutine was never awaited</code>.</div>
    <div class="pitfall"><strong>2. Sync-вызов в async функции блокирует event loop.</strong> <code>time.sleep(5)</code> внутри <code>async def</code> — заблокирует ВЕСЬ сервер на 5 секунд. Используй <code>await asyncio.sleep(5)</code>. Синхронный <code>requests.get()</code> — тоже блокирует; вместо него <code>httpx.AsyncClient</code>.</div>
    <div class="pitfall"><strong>3. CPU-bound в async — бессмысленно.</strong> Тяжёлый цикл в корутине блокирует loop. Выноси в <code>asyncio.to_thread(func)</code> или в отдельный процесс.</div>
    <div class="pitfall"><strong>4. Смешение sync + async кода.</strong> Из sync-функции нельзя <code>await</code>. Приходится <code>asyncio.run(async_func())</code>, но нельзя вложенно (если уже в event loop). Правило: если проект async — весь стек async.</div>
    <div class="pitfall"><strong>5. GIL не касается asyncio.</strong> Async работает в одном потоке — GIL не влияет. Но всё что не I/O — блокирует.</div>
    <div class="pitfall"><strong>6. Отладка сложнее.</strong> Traceback без имён async-функций (частично лечится в Python 3.12+). Используй <code>logger.exception</code> внутри corountine.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> <code>async def</code> + <code>await</code> = concurrent I/O в одном потоке. Для тысяч одновременных операций — идеально. Для CPU — не поможет (нужен multiprocessing). Правило проекта: либо весь стек async, либо весь sync — смешивание болит. FastAPI + httpx + asyncpg/SQLAlchemy async — стандартная async-связка backend 2026.
  </div>
</div>

<div id="sec-generators" class="section">
  <div class="section-title">Генераторы + iterators + itertools</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Iterator protocol</div>
    <p class="text"><strong>Iterable</strong> — объект, у которого есть <code>__iter__()</code>. Возвращает <strong>iterator</strong>. Iterator — объект с <code>__next__()</code>, возвращает следующий элемент, кидает <code>StopIteration</code> когда всё кончилось. <code>for x in obj:</code> — сахар над этим протоколом.</p>
<pre><code><span class="c-comment"># Внутри for крутится примерно вот это:</span>
it = <span class="c-fn">iter</span>(users)          <span class="c-comment"># получить iterator из iterable</span>
<span class="c-key">while</span> <span class="c-key">True</span>:
    <span class="c-key">try</span>:
        user = <span class="c-fn">next</span>(it)     <span class="c-comment"># next() зовёт __next__()</span>
    <span class="c-key">except</span> <span class="c-type">StopIteration</span>:
        <span class="c-key">break</span>
    <span class="c-fn">process</span>(user)

<span class="c-comment"># Свой iterator — редко, обычно используем генератор (см. ниже)</span>
<span class="c-key">class</span> <span class="c-type">Counter</span>:
    <span class="c-key">def</span> <span class="c-fn">__init__</span>(<span class="c-key">self</span>, limit): <span class="c-key">self</span>.n, <span class="c-key">self</span>.limit = <span class="c-num">0</span>, limit
    <span class="c-key">def</span> <span class="c-fn">__iter__</span>(<span class="c-key">self</span>): <span class="c-key">return</span> <span class="c-key">self</span>
    <span class="c-key">def</span> <span class="c-fn">__next__</span>(<span class="c-key">self</span>):
        <span class="c-key">if</span> <span class="c-key">self</span>.n &gt;= <span class="c-key">self</span>.limit: <span class="c-key">raise</span> <span class="c-type">StopIteration</span>
        <span class="c-key">self</span>.n += <span class="c-num">1</span>
        <span class="c-key">return</span> <span class="c-key">self</span>.n

<span class="c-key">for</span> i <span class="c-key">in</span> <span class="c-fn">Counter</span>(<span class="c-num">3</span>): <span class="c-fn">print</span>(i)     <span class="c-comment"># 1, 2, 3</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="repeat"></i> Генератор через <code>yield</code></div>
    <p class="text">Функция с <code>yield</code> — <strong>генератор</strong>. При вызове не выполняется сразу, возвращает generator-объект. Каждый <code>next()</code> исполняет до следующего <code>yield</code>, потом заморозит состояние.</p>
<pre><code><span class="c-key">def</span> <span class="c-fn">count_up_to</span>(limit):
    n = <span class="c-num">1</span>
    <span class="c-key">while</span> n &lt;= limit:
        <span class="c-key">yield</span> n
        n += <span class="c-num">1</span>

gen = <span class="c-fn">count_up_to</span>(<span class="c-num">3</span>)   <span class="c-comment"># НИЧЕГО не выполнилось; gen — генератор-объект</span>
<span class="c-fn">next</span>(gen)               <span class="c-comment"># 1</span>
<span class="c-fn">next</span>(gen)               <span class="c-comment"># 2</span>
<span class="c-fn">next</span>(gen)               <span class="c-comment"># 3</span>
<span class="c-fn">next</span>(gen)               <span class="c-comment"># StopIteration</span>

<span class="c-comment"># Обычно через for</span>
<span class="c-key">for</span> n <span class="c-key">in</span> <span class="c-fn">count_up_to</span>(<span class="c-num">10</span>):
    <span class="c-fn">print</span>(n)

<span class="c-comment"># Или превратить в list (загрузит всё в память)</span>
<span class="c-fn">list</span>(<span class="c-fn">count_up_to</span>(<span class="c-num">100</span>))</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Зачем это надо — ленивость</div>
    <p class="text"><strong>Главный use-case</strong>: обработка больших потоков данных без загрузки всего в память.</p>
<pre><code><span class="c-comment"># ❌ Загрузим весь 10GB лог в память — OOM</span>
<span class="c-key">def</span> <span class="c-fn">read_all</span>(path):
    <span class="c-key">with</span> <span class="c-fn">open</span>(path) <span class="c-key">as</span> f:
        <span class="c-key">return</span> f.<span class="c-fn">readlines</span>()      <span class="c-comment"># list всех строк</span>

<span class="c-comment"># ✅ Читаем по строке, память O(1)</span>
<span class="c-key">def</span> <span class="c-fn">read_lazy</span>(path):
    <span class="c-key">with</span> <span class="c-fn">open</span>(path) <span class="c-key">as</span> f:
        <span class="c-key">for</span> line <span class="c-key">in</span> f:
            <span class="c-key">yield</span> line.<span class="c-fn">rstrip</span>()

<span class="c-comment"># Пайплайн — можно накладывать фильтры/преобразования лениво</span>
<span class="c-key">def</span> <span class="c-fn">errors_only</span>(lines):
    <span class="c-key">for</span> line <span class="c-key">in</span> lines:
        <span class="c-key">if</span> <span class="c-str">"ERROR"</span> <span class="c-key">in</span> line:
            <span class="c-key">yield</span> line

<span class="c-key">def</span> <span class="c-fn">parse_json</span>(lines):
    <span class="c-key">for</span> line <span class="c-key">in</span> lines:
        <span class="c-key">yield</span> <span class="c-fn">json</span>.<span class="c-fn">loads</span>(line)

<span class="c-comment"># Читаем 10GB, фильтруем, парсим — всё лениво, память O(1)</span>
<span class="c-key">for</span> event <span class="c-key">in</span> <span class="c-fn">parse_json</span>(<span class="c-fn">errors_only</span>(<span class="c-fn">read_lazy</span>(<span class="c-str">"app.log"</span>))):
    <span class="c-fn">save_to_db</span>(event)</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-fork"></i> <code>yield from</code> — делегирование</div>
<pre><code><span class="c-key">def</span> <span class="c-fn">flatten</span>(matrix):
    <span class="c-key">for</span> row <span class="c-key">in</span> matrix:
        <span class="c-key">yield from</span> row              <span class="c-comment"># yield каждого элемента row</span>

<span class="c-comment"># Эквивалент:</span>
<span class="c-comment"># for row in matrix:</span>
<span class="c-comment">#     for x in row:</span>
<span class="c-comment">#         yield x</span>

<span class="c-fn">list</span>(<span class="c-fn">flatten</span>([[<span class="c-num">1</span>, <span class="c-num">2</span>], [<span class="c-num">3</span>, <span class="c-num">4</span>]]))   <span class="c-comment"># [1, 2, 3, 4]</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="library"></i> <code>itertools</code> — стандартная библиотека</div>
    <table class="data-table">
      <tr><th>Функция</th><th>Что делает</th></tr>
      <tr><td><code>chain(a, b, c)</code></td><td>Соединяет несколько iterables в один</td></tr>
      <tr><td><code>islice(it, start, stop, step)</code></td><td>Срез iterator'а (нельзя срезать generator обычным <code>[:]</code>)</td></tr>
      <tr><td><code>count(start, step)</code></td><td>Бесконечный счётчик <code>start, start+step, ...</code></td></tr>
      <tr><td><code>cycle(iterable)</code></td><td>Бесконечно повторяет</td></tr>
      <tr><td><code>repeat(x, n)</code></td><td>Повторяет <code>x</code> N раз (или бесконечно)</td></tr>
      <tr><td><code>groupby(iterable, key)</code></td><td>Группировка <em>подряд идущих</em> одинаковых (не как SQL GROUP BY)</td></tr>
      <tr><td><code>combinations(it, r)</code></td><td>Все сочетания по r элементов</td></tr>
      <tr><td><code>permutations(it, r)</code></td><td>Все перестановки</td></tr>
      <tr><td><code>product(a, b)</code></td><td>Декартово произведение</td></tr>
      <tr><td><code>batched(it, n)</code> (Python 3.12+)</td><td>Разбить на батчи размером n</td></tr>
      <tr><td><code>takewhile(pred, it)</code>, <code>dropwhile</code></td><td>Пока условие true / после того как false</td></tr>
    </table>

<pre><code><span class="c-key">from</span> itertools <span class="c-key">import</span> chain, islice, batched

<span class="c-comment"># Соединить несколько источников</span>
<span class="c-key">for</span> item <span class="c-key">in</span> <span class="c-fn">chain</span>(users_db, users_api, users_cache):
    ...

<span class="c-comment"># Взять первые 100 из бесконечного generator</span>
<span class="c-key">for</span> line <span class="c-key">in</span> <span class="c-fn">islice</span>(read_lazy(<span class="c-str">"huge.log"</span>), <span class="c-num">100</span>):
    ...

<span class="c-comment"># Батчи по 100 — для bulk-INSERT в БД</span>
<span class="c-key">for</span> chunk <span class="c-key">in</span> <span class="c-fn">batched</span>(records, <span class="c-num">100</span>):
    User.bulk_create(chunk)</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Генератор — <em>одноразовый</em>.</strong> После полного обхода — пустой. <code>list(gen)</code> дважды — второй раз получишь <code>[]</code>. Хочешь повторный обход — заверни в list.</div>
    <div class="pitfall"><strong>2. Нельзя <code>len(generator)</code>.</strong> Длина неизвестна. <code>sum(1 for _ in gen)</code> посчитает (но выпьет генератор).</div>
    <div class="pitfall"><strong>3. Нельзя индексировать <code>gen[5]</code>.</strong> Только последовательный доступ. Для 5-го элемента — <code>next(islice(gen, 5, 6))</code>.</div>
    <div class="pitfall"><strong>4. Забыл, что generator ленивый.</strong> <code>gen = (fn(x) for x in items)</code> — <code>fn</code> ещё не вызвана. Ошибки внутри <code>fn</code> вылезут только при обходе, не при создании.</div>
    <div class="pitfall"><strong>5. <code>yield</code> внутри <code>with</code>-блока и досрочный exit.</strong> Если генератор бросили не дочитав — <code>__exit__</code> вызовется через GC (не сразу). Для файлов/соединений лучше <code>contextmanager</code> обёртка.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> генератор через <code>yield</code> — стандартный питонический способ обработки потоков без загрузки в память. Read → filter → transform → save — пайплайн из генераторов. Для обычных задач хватает <code>yield</code> в def + <code>for</code>; <code>itertools</code> — когда нужны chain/batched/groupby.
  </div>
</div>

<div id="sec-django" class="section">
  <div class="section-title">Django — «Python Laravel»</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Что это</div>
    <p class="text"><strong>Django</strong> (с 2005) — full-stack framework: ORM, миграции, admin-панель, auth, templates, sessions, forms, i18n. По философии — <em>batteries included</em>: почти всё что нужно для сайта, уже внутри.</p>

    <div class="analogy">
      <strong>Аналогия для PHP-разработчика:</strong> Django ≈ Laravel в мире Python. ORM ≈ Eloquent, миграции ≈ Laravel migrations, admin ≈ Nova/Filament (только из коробки), templates ≈ Blade, forms ≈ FormRequest. Философия «convention over configuration» тоже похожа.
    </div>

    <p class="text"><strong>На чём построены:</strong> Instagram, Pinterest, Disqus, Bitbucket, Mozilla, Washington Post. К 2026 — по-прежнему стандарт для «сайта с админкой», но для чистых API проиграл FastAPI.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="download"></i> Быстрый старт</div>
<pre><code>uv add django
uv run django-admin startproject myapp .
uv run python manage.py startapp users
uv run python manage.py migrate
uv run python manage.py runserver
<span class="c-comment"># http://localhost:8000</span></code></pre>
    <p class="text">Структура:</p>
<pre><code>myapp/
├── manage.py                <span class="c-comment"># CLI как artisan</span>
├── myapp/
│   ├── settings.py          <span class="c-comment"># конфиг всего</span>
│   ├── urls.py              <span class="c-comment"># роуты</span>
│   ├── wsgi.py / asgi.py    <span class="c-comment"># entry points для сервера</span>
├── users/                   <span class="c-comment"># app</span>
│   ├── models.py            <span class="c-comment"># модели БД</span>
│   ├── views.py             <span class="c-comment"># контроллеры</span>
│   ├── urls.py
│   ├── admin.py             <span class="c-comment"># регистрация в admin-панели</span>
│   ├── migrations/
│   └── templates/</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> MVT-паттерн (Model — View — Template)</div>
    <p class="text">Django-версия MVC. «View» здесь — не то же, что вью в Laravel: это <em>контроллер</em>. «Template» — HTML-шаблон (Blade-аналог).</p>
<pre><code><span class="c-comment"># users/models.py</span>
<span class="c-key">from</span> django.db <span class="c-key">import</span> models

<span class="c-key">class</span> <span class="c-type">User</span>(models.<span class="c-type">Model</span>):
    name = models.<span class="c-fn">CharField</span>(max_length=<span class="c-num">100</span>)
    email = models.<span class="c-fn">EmailField</span>(unique=<span class="c-key">True</span>)
    created_at = models.<span class="c-fn">DateTimeField</span>(auto_now_add=<span class="c-key">True</span>)

    <span class="c-key">def</span> <span class="c-fn">__str__</span>(<span class="c-key">self</span>):
        <span class="c-key">return</span> <span class="c-key">self</span>.name

<span class="c-comment"># users/views.py</span>
<span class="c-key">from</span> django.shortcuts <span class="c-key">import</span> render, get_object_or_404
<span class="c-key">from</span> .models <span class="c-key">import</span> User

<span class="c-key">def</span> <span class="c-fn">user_list</span>(request):
    users = User.objects.<span class="c-fn">all</span>()
    <span class="c-key">return</span> <span class="c-fn">render</span>(request, <span class="c-str">"users/list.html"</span>, {<span class="c-str">"users"</span>: users})

<span class="c-key">def</span> <span class="c-fn">user_detail</span>(request, pk):
    user = <span class="c-fn">get_object_or_404</span>(User, pk=pk)
    <span class="c-key">return</span> <span class="c-fn">render</span>(request, <span class="c-str">"users/detail.html"</span>, {<span class="c-str">"user"</span>: user})

<span class="c-comment"># users/urls.py</span>
<span class="c-key">from</span> django.urls <span class="c-key">import</span> path
<span class="c-key">from</span> . <span class="c-key">import</span> views

urlpatterns = [
    <span class="c-fn">path</span>(<span class="c-str">""</span>, views.user_list, name=<span class="c-str">"user_list"</span>),
    <span class="c-fn">path</span>(<span class="c-str">"&lt;int:pk&gt;/"</span>, views.user_detail, name=<span class="c-str">"user_detail"</span>),
]</code></pre>

    <p class="text">Template (аналог Blade):</p>
<pre><code>&lt;!-- users/templates/users/list.html --&gt;
&#123;% extends "base.html" %&#125;

&#123;% block content %&#125;
&lt;ul&gt;
    &#123;% for user in users %&#125;
        &lt;li&gt;&lt;a href="&#123;% url 'user_detail' user.pk %&#125;"&gt;&#123;&#123; user.name &#125;&#125;&lt;/a&gt;&lt;/li&gt;
    &#123;% empty %&#125;
        &lt;li&gt;Пользователей нет&lt;/li&gt;
    &#123;% endfor %&#125;
&lt;/ul&gt;
&#123;% endblock %&#125;</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> Django ORM — сила фреймворка</div>
<pre><code><span class="c-comment"># CRUD</span>
u = User.objects.<span class="c-fn">create</span>(name=<span class="c-str">"Alice"</span>, email=<span class="c-str">"a@b.c"</span>)
User.objects.<span class="c-fn">get</span>(pk=<span class="c-num">1</span>)                             <span class="c-comment"># найти один или DoesNotExist</span>
User.objects.<span class="c-fn">filter</span>(name__startswith=<span class="c-str">"A"</span>)             <span class="c-comment"># QuerySet</span>
User.objects.<span class="c-fn">exclude</span>(is_active=<span class="c-key">False</span>)
User.objects.<span class="c-fn">filter</span>(age__gte=<span class="c-num">18</span>, name__icontains=<span class="c-str">"ali"</span>)

<span class="c-comment"># Обновление</span>
u.name = <span class="c-str">"Bob"</span>
u.<span class="c-fn">save</span>()

<span class="c-comment"># Bulk update</span>
User.objects.<span class="c-fn">filter</span>(is_active=<span class="c-key">False</span>).<span class="c-fn">update</span>(archived=<span class="c-key">True</span>)

<span class="c-comment"># Удаление</span>
u.<span class="c-fn">delete</span>()

<span class="c-comment"># Связи (аналог relations в Eloquent)</span>
<span class="c-key">class</span> <span class="c-type">Post</span>(models.<span class="c-type">Model</span>):
    author = models.<span class="c-fn">ForeignKey</span>(User, on_delete=models.CASCADE, related_name=<span class="c-str">"posts"</span>)
    title = models.<span class="c-fn">CharField</span>(max_length=<span class="c-num">200</span>)

<span class="c-comment"># Обход:</span>
user.posts.<span class="c-fn">all</span>()                    <span class="c-comment"># все посты юзера</span>
post.author.name                    <span class="c-comment"># автор поста</span>

<span class="c-comment"># Оптимизация N+1</span>
User.objects.<span class="c-fn">prefetch_related</span>(<span class="c-str">"posts"</span>)          <span class="c-comment"># посты одним запросом</span>
Post.objects.<span class="c-fn">select_related</span>(<span class="c-str">"author"</span>)             <span class="c-comment"># join с author</span>

<span class="c-comment"># Агрегация</span>
<span class="c-key">from</span> django.db.models <span class="c-key">import</span> Count, Sum, Avg
User.objects.<span class="c-fn">annotate</span>(posts_count=<span class="c-fn">Count</span>(<span class="c-str">"posts"</span>))
User.objects.<span class="c-fn">aggregate</span>(total_age=<span class="c-fn">Sum</span>(<span class="c-str">"age"</span>))</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-branch"></i> Миграции</div>
<pre><code><span class="c-comment"># Сгенерировать по изменениям в models.py</span>
python manage.py makemigrations
<span class="c-comment"># Migrations for 'users':</span>
<span class="c-comment">#   users/migrations/0002_user_phone.py</span>

<span class="c-comment"># Применить</span>
python manage.py migrate

<span class="c-comment"># Откатить</span>
python manage.py migrate users <span class="c-num">0001</span>

<span class="c-comment"># SQL который выполнится</span>
python manage.py sqlmigrate users <span class="c-num">0002</span></code></pre>
    <p class="text">В отличие от Laravel — <em>ORM автогенерит миграции сам</em>. Меняешь <code>models.py</code>, запускаешь <code>makemigrations</code> — Django поймёт диф и напишет миграцию.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield"></i> Admin-панель — killer feature</div>
<pre><code><span class="c-comment"># users/admin.py</span>
<span class="c-key">from</span> django.contrib <span class="c-key">import</span> admin
<span class="c-key">from</span> .models <span class="c-key">import</span> User

<span class="c-key">@admin</span>.<span class="c-fn">register</span>(User)
<span class="c-key">class</span> <span class="c-type">UserAdmin</span>(admin.<span class="c-type">ModelAdmin</span>):
    list_display = [<span class="c-str">"name"</span>, <span class="c-str">"email"</span>, <span class="c-str">"created_at"</span>]
    list_filter = [<span class="c-str">"is_active"</span>]
    search_fields = [<span class="c-str">"name"</span>, <span class="c-str">"email"</span>]
    ordering = [<span class="c-str">"-created_at"</span>]</code></pre>
    <p class="text">Одна регистрация — и в <code>/admin/</code> получаешь готовую CRUD-панель с фильтрами, поиском, пермишенами. Это причина почему Django до сих пор берут для внутренних систем и админок.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="rocket"></i> Django REST Framework (DRF)</div>
    <p class="text">Для API поверх Django ставят <strong>DRF</strong> — отдельный пакет:</p>
<pre><code>uv add djangorestframework

<span class="c-comment"># users/serializers.py — аналог Pydantic-моделей</span>
<span class="c-key">from</span> rest_framework <span class="c-key">import</span> serializers
<span class="c-key">from</span> .models <span class="c-key">import</span> User

<span class="c-key">class</span> <span class="c-type">UserSerializer</span>(serializers.<span class="c-type">ModelSerializer</span>):
    <span class="c-key">class</span> <span class="c-type">Meta</span>:
        model = User
        fields = [<span class="c-str">"id"</span>, <span class="c-str">"name"</span>, <span class="c-str">"email"</span>, <span class="c-str">"created_at"</span>]

<span class="c-comment"># users/views.py</span>
<span class="c-key">from</span> rest_framework <span class="c-key">import</span> viewsets
<span class="c-key">from</span> .models <span class="c-key">import</span> User
<span class="c-key">from</span> .serializers <span class="c-key">import</span> UserSerializer

<span class="c-key">class</span> <span class="c-type">UserViewSet</span>(viewsets.<span class="c-type">ModelViewSet</span>):
    queryset = User.objects.<span class="c-fn">all</span>()
    serializer_class = UserSerializer
<span class="c-comment"># Всё — 5 CRUD endpoints готовы (GET list, POST create, GET/PUT/DELETE detail)</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Django vs FastAPI — когда что</div>
    <table class="data-table">
      <tr><th>Задача</th><th>Django</th><th>FastAPI</th></tr>
      <tr><td>Сайт с админкой</td><td>✅ Идеально</td><td>Не подходит</td></tr>
      <tr><td>Внутренняя система с CRUD-формами</td><td>✅ Огромная экономия времени</td><td>Больше кода писать</td></tr>
      <tr><td>Публичный REST API</td><td>DRF — работает, но многословно</td><td>✅ Стандарт 2026</td></tr>
      <tr><td>Микросервис / AI-backend</td><td>Тяжеловат</td><td>✅ Быстро и легко</td></tr>
      <tr><td>WebSocket / real-time</td><td>Django Channels — через костыли</td><td>✅ Async из коробки</td></tr>
      <tr><td>Стартап-прототип с сайтом</td><td>✅ Мгновенно рабочий MVP</td><td>Придётся собирать всё</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Django async частичный.</strong> В 4.1+ async views есть, но большинство ORM и middleware — sync. Для полноценного async — FastAPI.</div>
    <div class="pitfall"><strong>2. Fat models vs fat views.</strong> В Django принято класть бизнес-логику в модель (<code>User.register(...)</code>), а не в view. Обратно от Laravel «тонкий контроллер + Service».</div>
    <div class="pitfall"><strong>3. Signals — глобальный event bus.</strong> Мощно, но приводит к «магии» — трудно отладить кто на что подписан. Использовать умеренно.</div>
    <div class="pitfall"><strong>4. N+1 — легко получить.</strong> <code>for post in posts: print(post.author.name)</code> — запрос на каждый автор. Спасение — <code>select_related</code>/<code>prefetch_related</code>.</div>
    <div class="pitfall"><strong>5. <code>QuerySet</code> ленивый.</strong> <code>qs = User.objects.filter(...)</code> — SQL ещё не выполнен. Вызовется при <code>for</code>, <code>list()</code>, <code>len()</code>. Кешируется после первого обхода.</div>
  </div>
</div>

<div id="sec-fastapi" class="section">
  <div class="section-title">FastAPI — must-know backend-фреймворк 2026</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="rocket"></i> Что это и зачем</div>
    <p class="text"><strong>FastAPI</strong> — современный async-first веб-фреймворк на type hints (Python 3.7+, актив с 2018, к 2026 — #1 выбор для нового Python-API). Основан на Starlette (ASGI) + Pydantic (валидация). Даёт из коробки: async endpoints, автоматическая валидация вход/выхода по type hints, автогенерация OpenAPI и Swagger UI, DI через <code>Depends()</code>.</p>

    <div class="analogy">
      <strong>Аналогия для PHP-разработчика:</strong> FastAPI ≈ Laravel-контроллер + FormRequest + JsonResource + автогенерация Swagger — <em>в одной функции</em>. Type hint параметра = валидация, Pydantic-модель = FormRequest, return type = JsonResource.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="download"></i> Минимальный старт</div>
<pre><code>uv init my-api &amp;&amp; <span class="c-fn">cd</span> my-api
uv add fastapi uvicorn[standard]

<span class="c-comment"># main.py</span>
<span class="c-key">from</span> fastapi <span class="c-key">import</span> FastAPI

app = <span class="c-fn">FastAPI</span>()

<span class="c-key">@app</span>.<span class="c-fn">get</span>(<span class="c-str">"/"</span>)
<span class="c-key">async def</span> <span class="c-fn">root</span>():
    <span class="c-key">return</span> {<span class="c-str">"status"</span>: <span class="c-str">"ok"</span>}

<span class="c-key">@app</span>.<span class="c-fn">get</span>(<span class="c-str">"/users/{user_id}"</span>)
<span class="c-key">async def</span> <span class="c-fn">get_user</span>(user_id: <span class="c-type">int</span>):
    <span class="c-key">return</span> {<span class="c-str">"id"</span>: user_id}</code></pre>
<pre><code>uv run uvicorn main:app --reload
<span class="c-comment"># http://localhost:8000</span>
<span class="c-comment"># http://localhost:8000/docs — Swagger UI автоматом</span>
<span class="c-comment"># http://localhost:8000/redoc — ReDoc</span></code></pre>

    <div class="info-box success">
      <strong>Магия:</strong> <code>user_id: int</code> — не просто аннотация. FastAPI сам конвертирует path-параметр в int, валидирует, при ошибке возвращает 422 с понятным JSON. Никакого <code>(int)$request-&gt;input()</code> и валидатора руками.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield-check"></i> Pydantic — валидация входа</div>
<pre><code><span class="c-key">from</span> pydantic <span class="c-key">import</span> BaseModel, Field, EmailStr

<span class="c-key">class</span> <span class="c-type">CreateUserRequest</span>(<span class="c-type">BaseModel</span>):
    name: <span class="c-type">str</span> = <span class="c-fn">Field</span>(min_length=<span class="c-num">2</span>, max_length=<span class="c-num">50</span>)
    email: <span class="c-type">EmailStr</span>
    age: <span class="c-type">int</span> = <span class="c-fn">Field</span>(ge=<span class="c-num">18</span>, le=<span class="c-num">120</span>)
    role: <span class="c-type">Literal</span>[<span class="c-str">"user"</span>, <span class="c-str">"admin"</span>] = <span class="c-str">"user"</span>

<span class="c-key">class</span> <span class="c-type">UserResponse</span>(<span class="c-type">BaseModel</span>):
    id: <span class="c-type">int</span>
    name: <span class="c-type">str</span>
    email: <span class="c-type">str</span>

<span class="c-key">@app</span>.<span class="c-fn">post</span>(<span class="c-str">"/users"</span>, response_model=<span class="c-type">UserResponse</span>, status_code=<span class="c-num">201</span>)
<span class="c-key">async def</span> <span class="c-fn">create_user</span>(payload: <span class="c-type">CreateUserRequest</span>) -&gt; <span class="c-type">UserResponse</span>:
    <span class="c-comment"># payload — уже провалидирован, все типы правильные</span>
    user = <span class="c-key">await</span> user_service.<span class="c-fn">create</span>(payload)
    <span class="c-key">return</span> user      <span class="c-comment"># автоматом сериализуется по UserResponse (hide-hostile поля)</span></code></pre>

    <p class="text"><strong>Что делает Pydantic:</strong></p>
    <ul class="bullets">
      <li>Приходит <code>{"age": "30"}</code> (string) → сконвертит в <code>int</code> автоматически</li>
      <li>Приходит <code>{"age": "abc"}</code> → 422 с <code>"value is not a valid integer"</code></li>
      <li>Приходит <code>{"email": "not-email"}</code> → 422 с <code>"value is not a valid email"</code></li>
      <li>Приходит лишние поля — <em>игнорируются</em> (или бросается ошибка если <code>model_config = {"extra": "forbid"}</code>)</li>
      <li><code>response_model</code> обрезает вывод — <code>password</code> не утечёт даже если в объекте есть</li>
    </ul>

    <p class="text"><strong>Laravel-аналог:</strong> Pydantic-модель ≈ FormRequest (валидация) + Eloquent (типы) + JsonResource (сериализация) в одном классе.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package"></i> Query params, path params, body</div>
<pre><code><span class="c-key">from</span> fastapi <span class="c-key">import</span> Query, Path

<span class="c-key">@app</span>.<span class="c-fn">get</span>(<span class="c-str">"/users/{user_id}/orders"</span>)
<span class="c-key">async def</span> <span class="c-fn">list_orders</span>(
    user_id: <span class="c-type">int</span> = <span class="c-fn">Path</span>(gt=<span class="c-num">0</span>),                <span class="c-comment"># из URL</span>
    limit: <span class="c-type">int</span> = <span class="c-fn">Query</span>(<span class="c-num">10</span>, ge=<span class="c-num">1</span>, le=<span class="c-num">100</span>),      <span class="c-comment"># ?limit=10</span>
    status: <span class="c-type">str</span> | <span class="c-key">None</span> = <span class="c-key">None</span>,                <span class="c-comment"># ?status=paid (опц.)</span>
    tag: <span class="c-type">list</span>[<span class="c-type">str</span>] = <span class="c-fn">Query</span>(default_factory=<span class="c-fn">list</span>),  <span class="c-comment"># ?tag=a&amp;tag=b</span>
):
    ...

<span class="c-key">@app</span>.<span class="c-fn">post</span>(<span class="c-str">"/orders"</span>)
<span class="c-key">async def</span> <span class="c-fn">create_order</span>(payload: <span class="c-type">OrderRequest</span>):     <span class="c-comment"># Pydantic — из body</span>
    ...</code></pre>

    <p class="text"><strong>Правило</strong>: FastAPI сам различает по типу. Path-параметр {user_id} в URL — берёт оттуда. Простые типы (int, str, bool) — из query. Pydantic-модель — из body JSON.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="link-2"></i> Depends — Dependency Injection</div>
<pre><code><span class="c-key">from</span> fastapi <span class="c-key">import</span> Depends, HTTPException, status

<span class="c-comment"># Общий provider — сессия БД</span>
<span class="c-key">async def</span> <span class="c-fn">get_db</span>() -&gt; <span class="c-type">AsyncSession</span>:
    <span class="c-key">async with</span> <span class="c-type">AsyncSession</span>(engine) <span class="c-key">as</span> session:
        <span class="c-key">yield</span> session

<span class="c-comment"># Auth-проверка</span>
<span class="c-key">async def</span> <span class="c-fn">current_user</span>(
    token: <span class="c-type">str</span> = <span class="c-fn">Depends</span>(oauth2_scheme),
    db: <span class="c-type">AsyncSession</span> = <span class="c-fn">Depends</span>(get_db),
) -&gt; <span class="c-type">User</span>:
    user = <span class="c-key">await</span> <span class="c-fn">verify_jwt</span>(token, db)
    <span class="c-key">if</span> <span class="c-key">not</span> user:
        <span class="c-key">raise</span> <span class="c-fn">HTTPException</span>(status.HTTP_401_UNAUTHORIZED)
    <span class="c-key">return</span> user

<span class="c-comment"># Использование — DI по типу параметра</span>
<span class="c-key">@app</span>.<span class="c-fn">get</span>(<span class="c-str">"/me"</span>)
<span class="c-key">async def</span> <span class="c-fn">read_me</span>(user: <span class="c-type">User</span> = <span class="c-fn">Depends</span>(current_user)) -&gt; <span class="c-type">User</span>:
    <span class="c-key">return</span> user

<span class="c-comment"># Depends можно повесить на роут — auth ко всем эндпоинтам роутера</span>
router = <span class="c-fn">APIRouter</span>(dependencies=[<span class="c-fn">Depends</span>(current_user)])</code></pre>

    <p class="text"><strong>Как это работает:</strong> FastAPI смотрит на аннотации параметров и рекурсивно резолвит зависимости. <code>get_db</code> возвращает через <code>yield</code> → это context manager, сессия закроется после ответа. Кешируется в рамках запроса (одна БД-сессия на весь request).</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="folder-tree"></i> Структура реального проекта</div>
<pre><code>myapi/
├── pyproject.toml
├── uv.lock
├── .env                       <span class="c-comment"># DATABASE_URL, SECRET_KEY, ...</span>
├── main.py                    <span class="c-comment"># FastAPI() + include_router</span>
├── src/
│   ├── config.py              <span class="c-comment"># pydantic-settings — типизированный env</span>
│   ├── database.py            <span class="c-comment"># engine, get_db()</span>
│   ├── auth/
│   │   ├── router.py          <span class="c-comment"># /login, /register</span>
│   │   ├── schemas.py         <span class="c-comment"># Pydantic-модели входа/выхода</span>
│   │   ├── service.py         <span class="c-comment"># бизнес-логика</span>
│   │   ├── models.py          <span class="c-comment"># SQLAlchemy-модели</span>
│   │   └── deps.py            <span class="c-comment"># current_user, etc</span>
│   ├── users/
│   │   └── ...
│   └── orders/
│       └── ...
└── tests/
    └── ...</code></pre>

<pre><code><span class="c-comment"># main.py</span>
<span class="c-key">from</span> fastapi <span class="c-key">import</span> FastAPI
<span class="c-key">from</span> src.auth.router <span class="c-key">import</span> router <span class="c-key">as</span> auth_router
<span class="c-key">from</span> src.users.router <span class="c-key">import</span> router <span class="c-key">as</span> users_router

app = <span class="c-fn">FastAPI</span>(title=<span class="c-str">"My API"</span>, version=<span class="c-str">"1.0"</span>)
app.<span class="c-fn">include_router</span>(auth_router, prefix=<span class="c-str">"/auth"</span>, tags=[<span class="c-str">"auth"</span>])
app.<span class="c-fn">include_router</span>(users_router, prefix=<span class="c-str">"/users"</span>, tags=[<span class="c-str">"users"</span>])</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Обработка ошибок</div>
<pre><code><span class="c-key">from</span> fastapi <span class="c-key">import</span> HTTPException

<span class="c-key">@app</span>.<span class="c-fn">get</span>(<span class="c-str">"/users/{id}"</span>)
<span class="c-key">async def</span> <span class="c-fn">get_user</span>(id: <span class="c-type">int</span>):
    user = <span class="c-key">await</span> <span class="c-fn">find</span>(id)
    <span class="c-key">if</span> <span class="c-key">not</span> user:
        <span class="c-key">raise</span> <span class="c-fn">HTTPException</span>(status_code=<span class="c-num">404</span>, detail=<span class="c-str">"User not found"</span>)
    <span class="c-key">return</span> user

<span class="c-comment"># Глобальный обработчик кастомного исключения</span>
<span class="c-key">from</span> fastapi.responses <span class="c-key">import</span> JSONResponse

<span class="c-key">@app</span>.<span class="c-fn">exception_handler</span>(<span class="c-type">OrderError</span>)
<span class="c-key">async def</span> <span class="c-fn">order_error_handler</span>(request, exc: <span class="c-type">OrderError</span>):
    <span class="c-key">return</span> <span class="c-fn">JSONResponse</span>(
        status_code=<span class="c-num">400</span>,
        content={<span class="c-str">"error"</span>: <span class="c-fn">str</span>(exc), <span class="c-str">"type"</span>: exc.<span class="c-fn">__class__</span>.__name__},
    )</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> FastAPI vs Django vs Flask — выбор</div>
    <table class="data-table">
      <tr><th></th><th>FastAPI</th><th>Django</th><th>Flask</th></tr>
      <tr><td>Тип</td><td>Micro/API-first, async</td><td>Batteries-included</td><td>Micro</td></tr>
      <tr><td>Async</td><td>✅ Первого класса</td><td>Частично (3.1+)</td><td>Нет (только через расширения)</td></tr>
      <tr><td>ORM</td><td>Нет — свой выбор (SQLAlchemy)</td><td>Свой мощный ORM</td><td>Нет — Flask-SQLAlchemy</td></tr>
      <tr><td>Admin panel</td><td>Нет из коробки</td><td>✅ Мощная</td><td>Нет</td></tr>
      <tr><td>Валидация</td><td>Pydantic — на type hints</td><td>Django Forms / DRF Serializers</td><td>Отдельные libs</td></tr>
      <tr><td>OpenAPI/Swagger</td><td>✅ Автоматически</td><td>Через DRF + пакеты</td><td>Нужны пакеты</td></tr>
      <tr><td>Кривая обучения</td><td>Быстро — type hints и всё</td><td>Долго — много концепций</td><td>Быстро — но всё собирать</td></tr>
      <tr><td>Когда выбирать</td><td><strong>HTTP-API, микросервис, AI-backend</strong></td><td><strong>Сайт с админкой, монолит</strong></td><td>Скрипт, прототип, legacy</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. sync-запросы в async endpoint блокируют loop.</strong> <code>requests.get()</code>, <code>time.sleep()</code>, синхронный SQLAlchemy — все убивают производительность. Используй <code>httpx.AsyncClient</code>, <code>await asyncio.sleep</code>, SQLAlchemy async.</div>
    <div class="pitfall"><strong>2. Тяжёлые CPU-операции в endpoint.</strong> Хеш паролей (bcrypt), генерация PDF, resizing картинок — всё блокирует event loop. Вынести в <code>await asyncio.to_thread(func)</code> или в отдельный воркер (Celery/RQ).</div>
    <div class="pitfall"><strong>3. Возврат SQLAlchemy-модели напрямую.</strong> Может утечь лишнее, ленивые relations кинут <code>MissingGreenlet</code>. Используй <code>response_model</code> с Pydantic-схемой или <code>model.model_dump()</code>.</div>
    <div class="pitfall"><strong>4. <code>@app.on_event</code> устарел.</strong> В новых версиях FastAPI — lifespan context manager: <code>app = FastAPI(lifespan=my_lifespan)</code>.</div>
    <div class="pitfall"><strong>5. <code>Depends</code> — не singleton по умолчанию.</strong> Кешируется в рамках одного запроса. Хочешь real singleton — оборачивай в <code>@lru_cache</code>.</div>
    <div class="pitfall"><strong>6. CORS.</strong> Из коробки не разрешён. Для SPA-фронта — <code>app.add_middleware(CORSMiddleware, allow_origins=[...])</code>.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> FastAPI — стандарт для нового Python-API-бекенда. Type hint = валидация + документация. Pydantic — сердце. <code>Depends()</code> — DI. Deploy — uvicorn в Docker + reverse-proxy Nginx. Для сайта с админкой — Django; для микросервиса/AI-бэка/API — FastAPI.
  </div>
</div>

<div id="sec-flask" class="section">
  <div class="section-title">Flask — микрофреймворк</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="beaker"></i> Что это</div>
    <p class="text"><strong>Flask</strong> (с 2010) — микрофреймворк: даёт роутинг + шаблоны + <code>request</code>/<code>response</code>. Всё остальное (ORM, форма, auth) — плагины по выбору. Долгое время был «PHP для Python» — быстро написать что-то маленькое.</p>

    <p class="text"><strong>К 2026:</strong> уступает FastAPI. Для нового кода выбирают FastAPI (async + type hints + автодоки). Flask остался в: legacy-системах, обучении (простой для входа), небольших скриптах-веб-инструментах.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Минимальный старт</div>
<pre><code>uv add flask

<span class="c-comment"># app.py</span>
<span class="c-key">from</span> flask <span class="c-key">import</span> Flask, request, jsonify

app = <span class="c-fn">Flask</span>(__name__)

<span class="c-key">@app</span>.<span class="c-fn">route</span>(<span class="c-str">"/"</span>)
<span class="c-key">def</span> <span class="c-fn">home</span>():
    <span class="c-key">return</span> <span class="c-str">"Hello!"</span>

<span class="c-key">@app</span>.<span class="c-fn">route</span>(<span class="c-str">"/users/&lt;int:user_id&gt;"</span>, methods=[<span class="c-str">"GET"</span>])
<span class="c-key">def</span> <span class="c-fn">get_user</span>(user_id):
    <span class="c-key">return</span> <span class="c-fn">jsonify</span>({<span class="c-str">"id"</span>: user_id, <span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>})

<span class="c-key">@app</span>.<span class="c-fn">route</span>(<span class="c-str">"/users"</span>, methods=[<span class="c-str">"POST"</span>])
<span class="c-key">def</span> <span class="c-fn">create_user</span>():
    data = request.<span class="c-fn">get_json</span>()          <span class="c-comment"># ручной парсинг</span>
    <span class="c-key">if</span> <span class="c-key">not</span> data <span class="c-key">or</span> <span class="c-str">"name"</span> <span class="c-key">not in</span> data:
        <span class="c-key">return</span> <span class="c-fn">jsonify</span>({<span class="c-str">"error"</span>: <span class="c-str">"name required"</span>}), <span class="c-num">400</span>
    <span class="c-key">return</span> <span class="c-fn">jsonify</span>({<span class="c-str">"created"</span>: data}), <span class="c-num">201</span>

<span class="c-key">if</span> __name__ == <span class="c-str">"__main__"</span>:
    app.<span class="c-fn">run</span>(debug=<span class="c-key">True</span>)</code></pre>
<pre><code>python app.py
<span class="c-comment"># http://localhost:5000</span></code></pre>

    <p class="text">Обрати внимание — валидация вручную (сравни с <code>Pydantic</code> в FastAPI, где просто аннотация типа). Это основной минус.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="puzzle"></i> Экосистема плагинов</div>
    <table class="data-table">
      <tr><th>Задача</th><th>Плагин</th></tr>
      <tr><td>ORM</td><td>Flask-SQLAlchemy</td></tr>
      <tr><td>Миграции</td><td>Flask-Migrate (Alembic)</td></tr>
      <tr><td>Формы + CSRF</td><td>Flask-WTF</td></tr>
      <tr><td>Auth (сессии)</td><td>Flask-Login</td></tr>
      <tr><td>JWT</td><td>Flask-JWT-Extended</td></tr>
      <tr><td>REST</td><td>Flask-RESTful, Flask-Smorest</td></tr>
      <tr><td>Admin-панель</td><td>Flask-Admin</td></tr>
    </table>
    <p class="text">В сумме получается тот же Django, только собираешь его сам из кубиков.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Когда сегодня стоит выбрать Flask</div>
    <ul class="bullets">
      <li>Мини-скрипт с 3-5 endpoint'ами (webhook receiver, health-check server)</li>
      <li>Проект на legacy Python 2 / 3.6 (FastAPI требует 3.7+)</li>
      <li>Обучение — синтаксис проще чем у FastAPI, меньше «магии»</li>
      <li>Работаешь в существующем Flask-проекте</li>
    </ul>
    <p class="text"><strong>Для нового REST-API в 2026 — берут FastAPI</strong>, не Flask. Скорость разработки выше за счёт Pydantic и автодоки.</p>
  </div>
</div>

<div id="sec-framework-compare" class="section">
  <div class="section-title">Django vs FastAPI vs Flask — итоговое сравнение</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Полная таблица</div>
    <table class="data-table">
      <tr><th>Аспект</th><th>Django</th><th>FastAPI</th><th>Flask</th></tr>
      <tr><td>Тип</td><td>Full-stack</td><td>Micro / API-first</td><td>Micro</td></tr>
      <tr><td>Год</td><td>2005</td><td>2018</td><td>2010</td></tr>
      <tr><td>Философия</td><td>Batteries included</td><td>Type-driven, async-first</td><td>Do-it-yourself</td></tr>
      <tr><td>Async</td><td>Частично (4.1+)</td><td>✅ Первого класса</td><td>❌ (только Quart-fork)</td></tr>
      <tr><td>ORM в комплекте</td><td>✅ Django ORM</td><td>❌ (SQLAlchemy отдельно)</td><td>❌ (Flask-SQLAlchemy отдельно)</td></tr>
      <tr><td>Admin-панель</td><td>✅ Из коробки</td><td>❌</td><td>Flask-Admin (отдельно)</td></tr>
      <tr><td>Auth-система</td><td>✅ Полная</td><td>Собирать (FastAPI Users / OAuth2)</td><td>Flask-Login</td></tr>
      <tr><td>Валидация</td><td>Django Forms / DRF Serializers</td><td>✅ Pydantic на type hints</td><td>Вручную / Flask-WTF</td></tr>
      <tr><td>Автодоки OpenAPI</td><td>Через DRF + drf-spectacular</td><td>✅ Автоматически</td><td>Через плагин Flask-Smorest</td></tr>
      <tr><td>Templates</td><td>✅ Django templates</td><td>Jinja2 через Starlette</td><td>✅ Jinja2</td></tr>
      <tr><td>Миграции</td><td>✅ Автогенерация</td><td>Alembic отдельно</td><td>Flask-Migrate</td></tr>
      <tr><td>Скорость (RPS)</td><td>Средняя</td><td>✅ Высокая (async)</td><td>Средняя</td></tr>
      <tr><td>Кривая обучения</td><td>Крутая — много концепций</td><td>Пологая, но нужны type hints</td><td>Очень пологая</td></tr>
      <tr><td>Комьюнити 2026</td><td>Огромное, зрелое</td><td>Взрывной рост, активное</td><td>Стабильное, но растёт медленно</td></tr>
      <tr><td>Кто использует</td><td>Instagram, Pinterest, Reddit</td><td>Netflix, Uber, Microsoft</td><td>Небольшие сервисы, скрипты</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> Правило выбора</div>
    <div class="card">
      <h3>Сайт с админкой, внутренняя система, e-commerce</h3>
      <p class="text">→ <strong>Django</strong>. Batteries included окупятся за 1-2 недели: admin, auth, ORM, миграции — всё уже настроено. Не изобретай стек.</p>
    </div>
    <div class="card">
      <h3>Публичный REST API, микросервис, AI-backend</h3>
      <p class="text">→ <strong>FastAPI</strong>. Async из коробки, Pydantic для валидации, автогенерация OpenAPI. Стандарт нового Python-backend в 2026.</p>
    </div>
    <div class="card">
      <h3>Мини-скрипт, webhook receiver, prototype</h3>
      <p class="text">→ <strong>Flask</strong> — если проект действительно <em>минимальный</em> (3-5 endpoints, никаких перспектив роста). Иначе всё равно FastAPI.</p>
    </div>
    <div class="card">
      <h3>Работа с существующим кодом</h3>
      <p class="text">→ <strong>что уже стоит</strong>. Переписывать legacy Flask на FastAPI ради «модно» — редко того стоит. Мигрируй только новые модули.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="lightbulb"></i> Гибридный подход в реальности</div>
    <p class="text">Крупные компании часто <em>смешивают</em>:</p>
    <ul class="bullets">
      <li><strong>Django</strong> — «основной сайт» с админкой + бизнес-логика</li>
      <li><strong>FastAPI</strong> — новые публичные API-эндпоинты, микросервисы, ML-inference</li>
      <li>Общая база данных через одну ORM (обычно SQLAlchemy)</li>
    </ul>
    <p class="text">Так на разные задачи используется правильный инструмент, без религиозных войн.</p>
  </div>

  <div class="remember-box">
    <strong>Итог одной фразой:</strong> Django для сайтов, FastAPI для API, Flask для мини-задач. В 2026 доля FastAPI растёт быстрее всех остальных Python-фреймворков вместе взятых.
  </div>
</div>

<div id="sec-db" class="section">
  <div class="section-title">БД в Python — psycopg / SQLAlchemy / Alembic</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers-3"></i> Три уровня работы с БД</div>
    <table class="data-table">
      <tr><th>Уровень</th><th>Инструменты</th><th>PHP-аналог</th></tr>
      <tr><td>1. Сырые SQL</td><td><code>psycopg</code> (PG), <code>mysql-connector</code>, <code>sqlite3</code> (stdlib)</td><td>PDO</td></tr>
      <tr><td>2. Query Builder + Core ORM</td><td>SQLAlchemy Core</td><td>Laravel Query Builder</td></tr>
      <tr><td>3. Full ORM</td><td>SQLAlchemy ORM, Django ORM</td><td>Eloquent, Doctrine</td></tr>
    </table>
    <p class="text">Для нового backend-проекта на FastAPI — стандарт <strong>SQLAlchemy 2.0 async</strong>. Для Django-проекта — Django ORM (входит).</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="terminal"></i> Сырые SQL — <code>psycopg</code></div>
    <p class="text"><code>psycopg</code> (v3, 2021) — актуальный драйвер PostgreSQL. Старая версия <code>psycopg2</code> — legacy, но ещё популярна. Аналог PDO — прямой доступ к SQL.</p>
<pre><code>uv add "psycopg[binary]"

<span class="c-key">import</span> psycopg

<span class="c-key">with</span> psycopg.<span class="c-fn">connect</span>(<span class="c-str">"postgresql://user:pass@localhost/mydb"</span>) <span class="c-key">as</span> conn:
    <span class="c-key">with</span> conn.<span class="c-fn">cursor</span>() <span class="c-key">as</span> cur:
        <span class="c-comment"># SELECT с параметрами (защита от SQL-injection)</span>
        cur.<span class="c-fn">execute</span>(<span class="c-str">"SELECT id, name FROM users WHERE age &gt; %s"</span>, (<span class="c-num">18</span>,))
        rows = cur.<span class="c-fn">fetchall</span>()          <span class="c-comment"># list of tuples</span>
        <span class="c-key">for</span> id, name <span class="c-key">in</span> rows:
            <span class="c-fn">print</span>(id, name)

        <span class="c-comment"># INSERT + RETURNING</span>
        cur.<span class="c-fn">execute</span>(
            <span class="c-str">"INSERT INTO users (name, email) VALUES (%s, %s) RETURNING id"</span>,
            (<span class="c-str">"Alice"</span>, <span class="c-str">"a@b.c"</span>),
        )
        new_id = cur.<span class="c-fn">fetchone</span>()[<span class="c-num">0</span>]

    conn.<span class="c-fn">commit</span>()

<span class="c-comment"># Row factory — получить dict вместо tuple</span>
<span class="c-key">from</span> psycopg.rows <span class="c-key">import</span> dict_row
<span class="c-key">with</span> psycopg.<span class="c-fn">connect</span>(DSN, row_factory=dict_row) <span class="c-key">as</span> conn:
    <span class="c-key">with</span> conn.<span class="c-fn">cursor</span>() <span class="c-key">as</span> cur:
        cur.<span class="c-fn">execute</span>(<span class="c-str">"SELECT id, name FROM users"</span>)
        <span class="c-key">for</span> row <span class="c-key">in</span> cur:
            <span class="c-fn">print</span>(row[<span class="c-str">"name"</span>])</code></pre>

    <div class="pitfall"><strong>⚠ Только параметризация через <code>%s</code>, никогда f-string / concat.</strong> <code>cur.execute(f"SELECT ... WHERE id = {user_input}")</code> — SQL-инъекция. Всегда <code>cur.execute("... WHERE id = %s", (user_input,))</code> — драйвер эскейпит.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> SQLAlchemy 2.0 — стандарт для FastAPI</div>
    <p class="text">SQLAlchemy — de-facto ORM в Python-экосистеме (кроме Django-проектов). Версия 2.0 (2023) кардинально переработана: новый API, полноценный async, отличные type hints.</p>
<pre><code>uv add "sqlalchemy[asyncio]" "asyncpg"

<span class="c-comment"># models.py — декларация моделей</span>
<span class="c-key">from</span> sqlalchemy.orm <span class="c-key">import</span> DeclarativeBase, Mapped, mapped_column
<span class="c-key">from</span> sqlalchemy <span class="c-key">import</span> String, ForeignKey
<span class="c-key">from</span> datetime <span class="c-key">import</span> datetime

<span class="c-key">class</span> <span class="c-type">Base</span>(<span class="c-type">DeclarativeBase</span>): <span class="c-key">pass</span>

<span class="c-key">class</span> <span class="c-type">User</span>(<span class="c-type">Base</span>):
    __tablename__ = <span class="c-str">"users"</span>

    id: <span class="c-type">Mapped</span>[<span class="c-type">int</span>] = <span class="c-fn">mapped_column</span>(primary_key=<span class="c-key">True</span>)
    name: <span class="c-type">Mapped</span>[<span class="c-type">str</span>] = <span class="c-fn">mapped_column</span>(<span class="c-fn">String</span>(<span class="c-num">100</span>))
    email: <span class="c-type">Mapped</span>[<span class="c-type">str</span>] = <span class="c-fn">mapped_column</span>(<span class="c-fn">String</span>(<span class="c-num">200</span>), unique=<span class="c-key">True</span>)
    created_at: <span class="c-type">Mapped</span>[<span class="c-type">datetime</span>] = <span class="c-fn">mapped_column</span>(default=<span class="c-type">datetime</span>.utcnow)</code></pre>

<pre><code><span class="c-comment"># database.py — async engine + session</span>
<span class="c-key">from</span> sqlalchemy.ext.asyncio <span class="c-key">import</span> create_async_engine, AsyncSession, async_sessionmaker

engine = <span class="c-fn">create_async_engine</span>(<span class="c-str">"postgresql+asyncpg://user:pass@localhost/mydb"</span>)
AsyncSessionLocal = <span class="c-fn">async_sessionmaker</span>(engine, expire_on_commit=<span class="c-key">False</span>)

<span class="c-key">async def</span> <span class="c-fn">get_db</span>():                     <span class="c-comment"># для FastAPI Depends()</span>
    <span class="c-key">async with</span> <span class="c-fn">AsyncSessionLocal</span>() <span class="c-key">as</span> session:
        <span class="c-key">yield</span> session</code></pre>

<pre><code><span class="c-comment"># Использование в FastAPI</span>
<span class="c-key">from</span> sqlalchemy <span class="c-key">import</span> select, insert, update, delete

<span class="c-key">@app</span>.<span class="c-fn">get</span>(<span class="c-str">"/users/{id}"</span>)
<span class="c-key">async def</span> <span class="c-fn">get_user</span>(id: <span class="c-type">int</span>, db: <span class="c-type">AsyncSession</span> = <span class="c-fn">Depends</span>(get_db)):
    <span class="c-comment"># SELECT one</span>
    user = <span class="c-key">await</span> db.<span class="c-fn">get</span>(User, id)
    <span class="c-key">if</span> <span class="c-key">not</span> user:
        <span class="c-key">raise</span> <span class="c-fn">HTTPException</span>(<span class="c-num">404</span>)
    <span class="c-key">return</span> user

<span class="c-key">@app</span>.<span class="c-fn">get</span>(<span class="c-str">"/users"</span>)
<span class="c-key">async def</span> <span class="c-fn">list_users</span>(db: <span class="c-type">AsyncSession</span> = <span class="c-fn">Depends</span>(get_db)):
    <span class="c-comment"># SELECT many</span>
    stmt = <span class="c-fn">select</span>(User).<span class="c-fn">where</span>(User.name.<span class="c-fn">ilike</span>(<span class="c-str">"a%"</span>)).<span class="c-fn">limit</span>(<span class="c-num">100</span>)
    result = <span class="c-key">await</span> db.<span class="c-fn">execute</span>(stmt)
    <span class="c-key">return</span> result.<span class="c-fn">scalars</span>().<span class="c-fn">all</span>()

<span class="c-key">@app</span>.<span class="c-fn">post</span>(<span class="c-str">"/users"</span>)
<span class="c-key">async def</span> <span class="c-fn">create_user</span>(payload: <span class="c-type">CreateUserRequest</span>, db: <span class="c-type">AsyncSession</span> = <span class="c-fn">Depends</span>(get_db)):
    user = <span class="c-type">User</span>(name=payload.name, email=payload.email)
    db.<span class="c-fn">add</span>(user)
    <span class="c-key">await</span> db.<span class="c-fn">commit</span>()
    <span class="c-key">await</span> db.<span class="c-fn">refresh</span>(user)                <span class="c-comment"># подтянуть id, created_at</span>
    <span class="c-key">return</span> user</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="link-2"></i> Связи и оптимизация N+1</div>
<pre><code><span class="c-comment"># Связь один-ко-многим</span>
<span class="c-key">class</span> <span class="c-type">Post</span>(<span class="c-type">Base</span>):
    __tablename__ = <span class="c-str">"posts"</span>
    id: <span class="c-type">Mapped</span>[<span class="c-type">int</span>] = <span class="c-fn">mapped_column</span>(primary_key=<span class="c-key">True</span>)
    author_id: <span class="c-type">Mapped</span>[<span class="c-type">int</span>] = <span class="c-fn">mapped_column</span>(<span class="c-fn">ForeignKey</span>(<span class="c-str">"users.id"</span>))
    title: <span class="c-type">Mapped</span>[<span class="c-type">str</span>]
    author: <span class="c-type">Mapped</span>[<span class="c-str">"User"</span>] = <span class="c-fn">relationship</span>(back_populates=<span class="c-str">"posts"</span>)

<span class="c-key">class</span> <span class="c-type">User</span>(<span class="c-type">Base</span>):
    ...
    posts: <span class="c-type">Mapped</span>[<span class="c-type">list</span>[<span class="c-str">"Post"</span>]] = <span class="c-fn">relationship</span>(back_populates=<span class="c-str">"author"</span>)

<span class="c-comment"># Оптимизация — selectinload = prefetch, joinedload = JOIN</span>
<span class="c-key">from</span> sqlalchemy.orm <span class="c-key">import</span> selectinload

stmt = <span class="c-fn">select</span>(User).<span class="c-fn">options</span>(<span class="c-fn">selectinload</span>(User.posts))
<span class="c-comment"># Один запрос за юзерами + один за всеми постами (через IN)</span>

<span class="c-comment"># Без — N+1: SELECT users, потом на каждого — SELECT posts</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-branch"></i> Alembic — миграции</div>
    <p class="text">Стандарт для миграций SQLAlchemy. Работает как <code>artisan migrate</code> в Laravel — генерация SQL по diff моделей.</p>
<pre><code>uv add alembic

alembic init migrations              <span class="c-comment"># создать конфиг</span>

<span class="c-comment"># Настроить alembic/env.py — указать target_metadata = Base.metadata</span>

<span class="c-comment"># Автогенерация по diff моделей</span>
alembic revision --autogenerate -m <span class="c-str">"add users table"</span>

<span class="c-comment"># Применить все миграции</span>
alembic upgrade head

<span class="c-comment"># Откатить одну</span>
alembic downgrade -<span class="c-num">1</span>

<span class="c-comment"># Показать текущую версию</span>
alembic current

<span class="c-comment"># История</span>
alembic history</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Смешивание sync и async в SQLAlchemy.</strong> Sync-код (<code>session.query(...)</code>) не работает в async-сессии. Один стек — либо весь sync, либо весь async.</div>
    <div class="pitfall"><strong>2. Забыл <code>await db.commit()</code>.</strong> Изменения не сохранятся. В отличие от Django/Laravel, где транзакция автозакрывается — SQLAlchemy требует явного commit.</div>
    <div class="pitfall"><strong>3. Ленивая загрузка в async.</strong> <code>user.posts</code> без предварительной <code>selectinload</code> в async — <code>MissingGreenlet</code> exception. Async не умеет ленивую подгрузку — грузи заранее.</div>
    <div class="pitfall"><strong>4. Возврат SQLAlchemy-модели напрямую из FastAPI.</strong> Утечка полей + ленивые relations. Используй Pydantic-схему через <code>response_model</code>.</div>
    <div class="pitfall"><strong>5. Одна сессия на весь запрос.</strong> Не создавай <code>AsyncSession()</code> в каждой функции — используй Depends() и один shared через request. Иначе connection pool не окупится.</div>
    <div class="pitfall"><strong>6. Alembic autogenerate — не серебряная пуля.</strong> Не увидит переименование колонки (сгенерит DROP + CREATE — потеряет данные). Проверяй сгенерённые миграции перед применением.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> для FastAPI-стека — SQLAlchemy 2.0 async + Alembic + asyncpg. Для Django — Django ORM. Для мини-скрипта — <code>psycopg</code> напрямую. Всегда параметризованные запросы. В async — <code>selectinload</code> для relations, чтобы избежать <code>MissingGreenlet</code>.
  </div>
</div>

<div id="sec-http" class="section">
  <div class="section-title">HTTP-клиенты — requests / httpx</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> requests vs httpx — что выбрать</div>
    <table class="data-table">
      <tr><th></th><th><code>requests</code></th><th><code>httpx</code></th></tr>
      <tr><td>Год</td><td>2011</td><td>2019</td></tr>
      <tr><td>API</td><td>Простой, стандартный</td><td>Такой же — можно мигрировать с sed</td></tr>
      <tr><td>Async</td><td>❌ Нет</td><td>✅ Sync + Async в одном пакете</td></tr>
      <tr><td>HTTP/2</td><td>❌ Нет</td><td>✅ Да</td></tr>
      <tr><td>Timeout по умолчанию</td><td>❌ Нет (висит навсегда)</td><td>✅ 5 секунд</td></tr>
      <tr><td>Проверка типов</td><td>Слабая</td><td>Полные type hints</td></tr>
    </table>
    <p class="text"><strong>Для нового кода — <code>httpx</code></strong>. <code>requests</code> — для legacy или совсем маленьких скриптов.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="download"></i> Базовый GET / POST</div>
<pre><code>uv add httpx

<span class="c-key">import</span> httpx

<span class="c-comment"># GET</span>
r = httpx.<span class="c-fn">get</span>(<span class="c-str">"https://api.example.com/users/1"</span>)
r.status_code                       <span class="c-comment"># 200</span>
r.text                              <span class="c-comment"># raw body как строка</span>
r.<span class="c-fn">json</span>()                            <span class="c-comment"># JSON → dict</span>
r.headers[<span class="c-str">"content-type"</span>]

<span class="c-comment"># Query params</span>
r = httpx.<span class="c-fn">get</span>(<span class="c-str">"https://api.ex.com/search"</span>, params={<span class="c-str">"q"</span>: <span class="c-str">"python"</span>, <span class="c-str">"limit"</span>: <span class="c-num">10</span>})
<span class="c-comment"># автосклейка → ?q=python&amp;limit=10</span>

<span class="c-comment"># POST JSON</span>
r = httpx.<span class="c-fn">post</span>(<span class="c-str">"https://api.ex.com/users"</span>, json={<span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>})
<span class="c-comment"># Content-Type: application/json автоматически</span>

<span class="c-comment"># POST form-data</span>
r = httpx.<span class="c-fn">post</span>(url, data={<span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>})
<span class="c-comment"># Content-Type: application/x-www-form-urlencoded</span>

<span class="c-comment"># POST file (multipart)</span>
<span class="c-key">with</span> <span class="c-fn">open</span>(<span class="c-str">"img.png"</span>, <span class="c-str">"rb"</span>) <span class="c-key">as</span> f:
    r = httpx.<span class="c-fn">post</span>(url, files={<span class="c-str">"image"</span>: f})

<span class="c-comment"># Headers</span>
r = httpx.<span class="c-fn">get</span>(url, headers={<span class="c-str">"Authorization"</span>: <span class="c-fn">f</span><span class="c-str">"Bearer {token}"</span>})

<span class="c-comment"># Timeout</span>
r = httpx.<span class="c-fn">get</span>(url, timeout=<span class="c-num">10.0</span>)     <span class="c-comment"># обязательно ставить!</span>

<span class="c-comment"># Обработка ошибок HTTP-статусов</span>
r.<span class="c-fn">raise_for_status</span>()                <span class="c-comment"># бросит HTTPStatusError если 4xx/5xx</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package"></i> Client — переиспользование соединений</div>
    <p class="text">Прямой вызов <code>httpx.get()</code> — каждый раз новое TCP-соединение. Для 10+ запросов к одному хосту используй <strong>Client</strong>:</p>
<pre><code><span class="c-comment"># Sync client</span>
<span class="c-key">with</span> httpx.<span class="c-fn">Client</span>(
    base_url=<span class="c-str">"https://api.example.com"</span>,
    headers={<span class="c-str">"Authorization"</span>: <span class="c-fn">f</span><span class="c-str">"Bearer {token}"</span>},
    timeout=<span class="c-num">10.0</span>,
) <span class="c-key">as</span> client:
    r1 = client.<span class="c-fn">get</span>(<span class="c-str">"/users/1"</span>)
    r2 = client.<span class="c-fn">get</span>(<span class="c-str">"/users/2"</span>)
    r3 = client.<span class="c-fn">post</span>(<span class="c-str">"/users"</span>, json={...})
<span class="c-comment"># Соединение переиспользуется, ~10× быстрее</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Async — <code>AsyncClient</code></div>
<pre><code><span class="c-key">import</span> asyncio, httpx

<span class="c-key">async def</span> <span class="c-fn">fetch_all</span>(urls):
    <span class="c-key">async with</span> httpx.<span class="c-type">AsyncClient</span>(timeout=<span class="c-num">10.0</span>) <span class="c-key">as</span> client:
        tasks = [client.<span class="c-fn">get</span>(u) <span class="c-key">for</span> u <span class="c-key">in</span> urls]
        responses = <span class="c-key">await</span> asyncio.<span class="c-fn">gather</span>(*tasks)
        <span class="c-key">return</span> [r.<span class="c-fn">json</span>() <span class="c-key">for</span> r <span class="c-key">in</span> responses]

data = asyncio.<span class="c-fn">run</span>(<span class="c-fn">fetch_all</span>([<span class="c-str">"url1"</span>, <span class="c-str">"url2"</span>, <span class="c-str">"url3"</span>]))
<span class="c-comment"># Три запроса параллельно</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="repeat-2"></i> Retry с tenacity</div>
    <p class="text">В <code>httpx</code>/<code>requests</code> нет retry из коробки. Стандарт — библиотека <code>tenacity</code>:</p>
<pre><code>uv add tenacity

<span class="c-key">from</span> tenacity <span class="c-key">import</span> retry, stop_after_attempt, wait_exponential

<span class="c-key">@retry</span>(
    stop=<span class="c-fn">stop_after_attempt</span>(<span class="c-num">3</span>),
    wait=<span class="c-fn">wait_exponential</span>(multiplier=<span class="c-num">1</span>, min=<span class="c-num">2</span>, max=<span class="c-num">10</span>),
)
<span class="c-key">def</span> <span class="c-fn">fetch</span>(url):
    r = httpx.<span class="c-fn">get</span>(url, timeout=<span class="c-num">5.0</span>)
    r.<span class="c-fn">raise_for_status</span>()
    <span class="c-key">return</span> r.<span class="c-fn">json</span>()</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="test-tube"></i> Mocking в тестах — respx</div>
<pre><code>uv add --dev respx pytest

<span class="c-key">import</span> respx, httpx, pytest

<span class="c-key">@respx</span>.<span class="c-fn">mock</span>
<span class="c-key">def</span> <span class="c-fn">test_fetch_user</span>():
    route = respx.<span class="c-fn">get</span>(<span class="c-str">"https://api.ex.com/users/1"</span>).<span class="c-fn">mock</span>(
        return_value=httpx.<span class="c-fn">Response</span>(<span class="c-num">200</span>, json={<span class="c-str">"id"</span>: <span class="c-num">1</span>, <span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>})
    )
    result = <span class="c-fn">fetch_user</span>(<span class="c-num">1</span>)
    <span class="c-key">assert</span> result[<span class="c-str">"name"</span>] == <span class="c-str">"Alice"</span>
    <span class="c-key">assert</span> route.<span class="c-fn">called</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Забыл <code>timeout</code>.</strong> В <code>requests</code> нет дефолта — запрос висит навсегда. В <code>httpx</code> дефолт 5 сек. Всегда указывай явно.</div>
    <div class="pitfall"><strong>2. Ошибки HTTP-статусов не бросаются автоматически.</strong> <code>r = httpx.get(...)</code> с 500 не выкинет exception, только <code>r.status_code == 500</code>. Явно — <code>r.raise_for_status()</code>.</div>
    <div class="pitfall"><strong>3. <code>r.text</code> может не быть JSON.</strong> Сначала проверь <code>r.headers.get("content-type")</code>, потом <code>r.json()</code>. Или <code>try/except JSONDecodeError</code>.</div>
    <div class="pitfall"><strong>4. Sync-клиент в async endpoint (FastAPI).</strong> <code>httpx.get()</code> внутри <code>async def</code> блокирует event loop. Используй <code>httpx.AsyncClient</code>.</div>
    <div class="pitfall"><strong>5. Большие ответы в память.</strong> <code>r.content</code> прочитает весь response. Для 10GB-файла — <code>httpx.stream("GET", url) as r: for chunk in r.iter_bytes()</code>.</div>
    <div class="pitfall"><strong>6. Verify SSL.</strong> <code>httpx.get(url, verify=False)</code> — отключает проверку сертификата. НИКОГДА в проде, только для тестового localhost.</div>
  </div>
</div>

<!-- ═══════════════════════════ NUMPY ═══════════════════════════ -->
<div id="sec-numpy" class="section">
  <div class="section-title">NumPy — фундамент ML/Data-стека</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Что это и зачем</div>
    <p class="text"><strong>NumPy</strong> — библиотека для работы с многомерными массивами (<code>ndarray</code>) и векторизованных вычислений. На нём построены Pandas, scikit-learn, PyTorch, TensorFlow, SciPy. Для ML — <em>обязательный</em> фундамент.</p>

    <div class="analogy">
      <strong>Аналогия:</strong> Python-список — «универсальная тележка» (в неё можно положить любую вещь, но проверять тип и обрабатывать каждый элемент нужно вручную). NumPy-массив — «промышленный конвейер»: все элементы одного типа, операции применяются <em>ко всем сразу</em> в C-коде, минуя интерпретатор. Векторизованный <code>a * 2</code> в 50-100 раз быстрее <code>[x*2 for x in list]</code>.
    </div>

    <div class="why-box">
      <strong>Почему это критично:</strong> в ML данные — это матрицы (features × samples), тензоры (batch × height × width × channels). Обучение = миллионы умножений/сложений на массивах. Без векторизации вычисления медленнее в 100+ раз. PyTorch/TensorFlow — та же идея, только с автодифференцированием и GPU.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="download"></i> Установка</div>
<pre><code>uv add numpy

<span class="c-key">import</span> numpy <span class="c-key">as</span> np      <span class="c-comment"># общепринятый alias, всегда np</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="grid-3x3"></i> Создание массивов (<code>ndarray</code>)</div>
<pre><code><span class="c-comment"># Из Python-списка</span>
a = np.<span class="c-fn">array</span>([<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>, <span class="c-num">4</span>])                <span class="c-comment"># 1D — вектор</span>
b = np.<span class="c-fn">array</span>([[<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>], [<span class="c-num">4</span>, <span class="c-num">5</span>, <span class="c-num">6</span>]])     <span class="c-comment"># 2D — матрица</span>
c = np.<span class="c-fn">array</span>([[[<span class="c-num">1</span>], [<span class="c-num">2</span>]], [[<span class="c-num">3</span>], [<span class="c-num">4</span>]]]) <span class="c-comment"># 3D — тензор</span>

<span class="c-comment"># Из «шаблонов»</span>
np.<span class="c-fn">zeros</span>((<span class="c-num">3</span>, <span class="c-num">4</span>))                       <span class="c-comment"># матрица 3×4 из нулей</span>
np.<span class="c-fn">ones</span>((<span class="c-num">2</span>, <span class="c-num">3</span>))                        <span class="c-comment"># из единиц</span>
np.<span class="c-fn">full</span>((<span class="c-num">2</span>, <span class="c-num">2</span>), <span class="c-num">7</span>)                     <span class="c-comment"># заполнить константой</span>
np.<span class="c-fn">eye</span>(<span class="c-num">3</span>)                              <span class="c-comment"># единичная 3×3</span>
np.<span class="c-fn">arange</span>(<span class="c-num">0</span>, <span class="c-num">10</span>, <span class="c-num">2</span>)                    <span class="c-comment"># [0, 2, 4, 6, 8] — как range</span>
np.<span class="c-fn">linspace</span>(<span class="c-num">0</span>, <span class="c-num">1</span>, <span class="c-num">11</span>)                  <span class="c-comment"># 11 точек от 0 до 1</span>

<span class="c-comment"># Случайные</span>
np.random.<span class="c-fn">rand</span>(<span class="c-num">3</span>, <span class="c-num">4</span>)                    <span class="c-comment"># uniform [0, 1)</span>
np.random.<span class="c-fn">randn</span>(<span class="c-num">3</span>, <span class="c-num">4</span>)                   <span class="c-comment"># normal (0, 1)</span>
np.random.<span class="c-fn">randint</span>(<span class="c-num">0</span>, <span class="c-num">10</span>, size=(<span class="c-num">2</span>, <span class="c-num">3</span>))    <span class="c-comment"># целые</span>

<span class="c-comment"># Свойства</span>
a.shape                             <span class="c-comment"># (4,) — размеры</span>
b.shape                             <span class="c-comment"># (2, 3)</span>
a.ndim                              <span class="c-comment"># 1 — размерность</span>
b.ndim                              <span class="c-comment"># 2</span>
a.dtype                             <span class="c-comment"># int64 — тип элементов</span>
a.size                              <span class="c-comment"># 4 — общее число элементов</span></code></pre>

    <div class="pitfall"><strong>⚠ Массивы одного типа.</strong> В отличие от list, ndarray хранит элементы <em>одного dtype</em>. <code>np.array([1, "hello"])</code> сконвертит всё в строки. Задавать явно: <code>np.array([1, 2], dtype=np.float32)</code>.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Векторизация — главная идея</div>
<pre><code>a = np.<span class="c-fn">array</span>([<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>, <span class="c-num">4</span>])

<span class="c-comment"># Арифметика — поэлементно, БЕЗ циклов</span>
a * <span class="c-num">2</span>              <span class="c-comment"># [2, 4, 6, 8]</span>
a + <span class="c-num">10</span>             <span class="c-comment"># [11, 12, 13, 14]</span>
a ** <span class="c-num">2</span>             <span class="c-comment"># [1, 4, 9, 16]</span>
a &gt; <span class="c-num">2</span>              <span class="c-comment"># [False, False, True, True]  — булева маска</span>

<span class="c-comment"># Между массивами — тоже поэлементно</span>
b = np.<span class="c-fn">array</span>([<span class="c-num">10</span>, <span class="c-num">20</span>, <span class="c-num">30</span>, <span class="c-num">40</span>])
a + b               <span class="c-comment"># [11, 22, 33, 44]</span>
a * b               <span class="c-comment"># [10, 40, 90, 160]  — НЕ матричное умножение</span>
a @ b               <span class="c-comment"># 300 — скалярное произведение (dot product)</span>

<span class="c-comment"># Универсальные функции (ufuncs) — векторизованные</span>
np.<span class="c-fn">sqrt</span>(a)          <span class="c-comment"># [1., 1.41, 1.73, 2.]</span>
np.<span class="c-fn">exp</span>(a)           <span class="c-comment"># e^x</span>
np.<span class="c-fn">log</span>(a)           <span class="c-comment"># ln</span>
np.<span class="c-fn">sin</span>(a)
np.<span class="c-fn">abs</span>(a)</code></pre>

    <div class="info-box success">
      <strong>Скорость:</strong> цикл Python по массиву из 1млн — ~200ms. Векторизованный <code>a * 2</code> — ~2ms. Разница <strong>100×</strong>. Не пиши <code>for i in range(len(a)): a[i] += 1</code> — пиши <code>a += 1</code>.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="expand"></i> Broadcasting — арифметика массивов разной формы</div>
    <p class="text">NumPy автоматически «растягивает» меньший массив, если операция это допускает. Одно из самых мощных свойств.</p>
<pre><code>a = np.<span class="c-fn">array</span>([[<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>],       <span class="c-comment"># shape (2, 3)</span>
              [<span class="c-num">4</span>, <span class="c-num">5</span>, <span class="c-num">6</span>]])
row = np.<span class="c-fn">array</span>([<span class="c-num">10</span>, <span class="c-num">20</span>, <span class="c-num">30</span>])       <span class="c-comment"># shape (3,)</span>

a + row
<span class="c-comment"># [[11, 22, 33],</span>
<span class="c-comment">#  [14, 25, 36]]</span>
<span class="c-comment"># row «растянут» на 2 строки, потом поэлементно</span>

<span class="c-comment"># Классический use-case: нормализация features</span>
<span class="c-comment"># X shape (n_samples, n_features), mean shape (n_features,)</span>
X_normalized = (X - X.<span class="c-fn">mean</span>(axis=<span class="c-num">0</span>)) / X.<span class="c-fn">std</span>(axis=<span class="c-num">0</span>)</code></pre>

    <p class="text"><strong>Правила broadcasting</strong> (упрощённо):</p>
    <ol class="numbered">
      <li>Сравнивают формы <em>с конца</em>.</li>
      <li>Размерности совпадают → ок.</li>
      <li>Одна из размерностей = 1 → «растягивается» до другой.</li>
      <li>Иначе — ошибка.</li>
    </ol>
<pre><code><span class="c-comment"># Совместимые</span>
(<span class="c-num">3</span>, <span class="c-num">4</span>) + (<span class="c-num">4</span>,)       <span class="c-comment"># (3,4) + (1,4) → (3,4) ✓</span>
(<span class="c-num">3</span>, <span class="c-num">4</span>) + (<span class="c-num">3</span>, <span class="c-num">1</span>)     <span class="c-comment">→ (3,4) ✓</span>
(<span class="c-num">2</span>, <span class="c-num">1</span>, <span class="c-num">4</span>) + (<span class="c-num">3</span>, <span class="c-num">4</span>)  <span class="c-comment">→ (2,3,4) ✓</span>

<span class="c-comment"># Несовместимые — ValueError</span>
(<span class="c-num">3</span>, <span class="c-num">4</span>) + (<span class="c-num">3</span>,)       <span class="c-comment">❌ операнды не совпадают</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="scissors"></i> Индексация и срезы</div>
<pre><code>a = np.<span class="c-fn">arange</span>(<span class="c-num">10</span>).<span class="c-fn">reshape</span>(<span class="c-num">2</span>, <span class="c-num">5</span>)
<span class="c-comment"># [[0, 1, 2, 3, 4],</span>
<span class="c-comment">#  [5, 6, 7, 8, 9]]</span>

<span class="c-comment"># Обычный slicing</span>
a[<span class="c-num">0</span>]                <span class="c-comment"># [0, 1, 2, 3, 4] — вся строка 0</span>
a[<span class="c-num">0</span>, <span class="c-num">2</span>]             <span class="c-comment"># 2 — элемент (row 0, col 2)</span>
a[:, <span class="c-num">1</span>]             <span class="c-comment"># [1, 6] — колонка 1 целиком</span>
a[:, <span class="c-num">1</span>:<span class="c-num">3</span>]           <span class="c-comment"># колонки 1..2</span>
a[<span class="c-num">0</span>, ::<span class="c-num">2</span>]           <span class="c-comment"># [0, 2, 4] — каждый второй в строке 0</span>

<span class="c-comment"># Fancy indexing — по массиву индексов</span>
a[[<span class="c-num">0</span>, <span class="c-num">1</span>], [<span class="c-num">2</span>, <span class="c-num">3</span>]]     <span class="c-comment"># [2, 8] — a[0,2], a[1,3]</span>

<span class="c-comment"># Булева маска — самый частый паттерн</span>
mask = a &gt; <span class="c-num">3</span>            <span class="c-comment"># маска той же формы, что и a</span>
a[mask]                <span class="c-comment"># все элементы &gt; 3 — [4, 5, 6, 7, 8, 9]</span>
a[a % <span class="c-num">2</span> == <span class="c-num">0</span>]         <span class="c-comment"># все чётные</span>

<span class="c-comment"># Модификация через маску</span>
a[a &lt; <span class="c-num">5</span>] = <span class="c-num">0</span>           <span class="c-comment"># все &lt; 5 → 0</span></code></pre>

    <div class="pitfall"><strong>⚠ Срез — это VIEW, не копия.</strong> <code>b = a[:, 1:3]; b[0, 0] = 99</code> изменит <em>оригинал</em> <code>a</code>. Хочешь копию — явно <code>a[:, 1:3].copy()</code>. В Pandas та же ловушка (SettingWithCopyWarning).</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="axis-3d"></i> Оси (axis) и агрегации</div>
    <p class="text">Ось (axis) — направление, вдоль которого агрегируем. Для 2D-матрицы: <code>axis=0</code> — по столбцам (сжимает строки), <code>axis=1</code> — по строкам (сжимает столбцы). Классическая путаница — запоминай: <em>axis = «размерность, которая исчезает»</em>.</p>
<pre><code>a = np.<span class="c-fn">array</span>([[<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>],
              [<span class="c-num">4</span>, <span class="c-num">5</span>, <span class="c-num">6</span>]])            <span class="c-comment"># shape (2, 3)</span>

a.<span class="c-fn">sum</span>()                              <span class="c-comment"># 21 — сумма всего</span>
a.<span class="c-fn">sum</span>(axis=<span class="c-num">0</span>)                        <span class="c-comment"># [5, 7, 9] — по столбцам (shape (3,))</span>
a.<span class="c-fn">sum</span>(axis=<span class="c-num">1</span>)                        <span class="c-comment"># [6, 15] — по строкам (shape (2,))</span>

<span class="c-comment"># Все агрегации имеют axis</span>
a.<span class="c-fn">mean</span>(axis=<span class="c-num">0</span>)                       <span class="c-comment"># среднее по столбцам</span>
a.<span class="c-fn">max</span>(axis=<span class="c-num">1</span>)                        <span class="c-comment"># max в каждой строке</span>
a.<span class="c-fn">std</span>(axis=<span class="c-num">0</span>)                        <span class="c-comment"># стандартное отклонение</span>
a.<span class="c-fn">argmax</span>(axis=<span class="c-num">1</span>)                     <span class="c-comment"># индекс максимума в строке</span>
a.<span class="c-fn">cumsum</span>(axis=<span class="c-num">0</span>)                     <span class="c-comment"># накопительная сумма</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shuffle"></i> Reshape и manipulation</div>
<pre><code>a = np.<span class="c-fn">arange</span>(<span class="c-num">12</span>)                    <span class="c-comment"># [0, 1, ..., 11]</span>

a.<span class="c-fn">reshape</span>(<span class="c-num">3</span>, <span class="c-num">4</span>)                    <span class="c-comment"># (3, 4)</span>
a.<span class="c-fn">reshape</span>(<span class="c-num">2</span>, <span class="c-num">2</span>, <span class="c-num">3</span>)                 <span class="c-comment"># (2, 2, 3)</span>
a.<span class="c-fn">reshape</span>(-<span class="c-num">1</span>, <span class="c-num">3</span>)                   <span class="c-comment"># -1 = «посчитай сам» → (4, 3)</span>

<span class="c-comment"># Транспонирование</span>
b = a.<span class="c-fn">reshape</span>(<span class="c-num">3</span>, <span class="c-num">4</span>)
b.T                                <span class="c-comment"># shape (4, 3)</span>

<span class="c-comment"># Уплощение</span>
b.<span class="c-fn">flatten</span>()                          <span class="c-comment"># копия, 1D</span>
b.<span class="c-fn">ravel</span>()                            <span class="c-comment"># view, 1D (быстрее)</span>

<span class="c-comment"># Добавить размерность</span>
a[np.newaxis, :]                   <span class="c-comment"># (12,) → (1, 12)</span>
a[:, np.newaxis]                   <span class="c-comment"># (12,) → (12, 1)</span>
a[<span class="c-key">None</span>, :]                          <span class="c-comment"># то же — None = np.newaxis</span>

<span class="c-comment"># Склейка</span>
np.<span class="c-fn">concatenate</span>([a, a], axis=<span class="c-num">0</span>)       <span class="c-comment"># по оси 0</span>
np.<span class="c-fn">vstack</span>([a, a])                    <span class="c-comment"># вертикально (по строкам)</span>
np.<span class="c-fn">hstack</span>([a, a])                    <span class="c-comment"># горизонтально (по столбцам)</span>
np.<span class="c-fn">stack</span>([a, a])                     <span class="c-comment"># добавляет новую ось</span>

<span class="c-comment"># Split — обратная операция</span>
np.<span class="c-fn">split</span>(a, <span class="c-num">3</span>)                      <span class="c-comment"># на 3 равные части</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="calculator"></i> Линейная алгебра</div>
<pre><code>A = np.<span class="c-fn">array</span>([[<span class="c-num">1</span>, <span class="c-num">2</span>], [<span class="c-num">3</span>, <span class="c-num">4</span>]])
B = np.<span class="c-fn">array</span>([[<span class="c-num">5</span>, <span class="c-num">6</span>], [<span class="c-num">7</span>, <span class="c-num">8</span>]])

A @ B                              <span class="c-comment"># матричное умножение (Python 3.5+)</span>
np.<span class="c-fn">dot</span>(A, B)                        <span class="c-comment"># то же, для legacy</span>
A * B                              <span class="c-comment"># поэлементно (Hadamard), НЕ матричное</span>

np.linalg.<span class="c-fn">inv</span>(A)                    <span class="c-comment"># обратная матрица</span>
np.linalg.<span class="c-fn">det</span>(A)                    <span class="c-comment"># определитель</span>
np.linalg.<span class="c-fn">solve</span>(A, b)                <span class="c-comment"># решить систему A·x = b</span>
np.linalg.<span class="c-fn">eig</span>(A)                    <span class="c-comment"># собственные значения/векторы</span>
np.linalg.<span class="c-fn">norm</span>(a)                   <span class="c-comment"># норма (по умолчанию L2)</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практический пример: нормализация данных</div>
<pre><code><span class="c-key">import</span> numpy <span class="c-key">as</span> np

<span class="c-comment"># 100 samples × 4 features</span>
X = np.random.<span class="c-fn">rand</span>(<span class="c-num">100</span>, <span class="c-num">4</span>)

<span class="c-comment"># Z-score normalization: (x - mean) / std</span>
X_norm = (X - X.<span class="c-fn">mean</span>(axis=<span class="c-num">0</span>)) / X.<span class="c-fn">std</span>(axis=<span class="c-num">0</span>)
<span class="c-comment"># mean/std shape (4,) → broadcasting до (100, 4)</span>

<span class="c-comment"># Min-max normalization: (x - min) / (max - min)</span>
X_scaled = (X - X.<span class="c-fn">min</span>(axis=<span class="c-num">0</span>)) / (X.<span class="c-fn">max</span>(axis=<span class="c-num">0</span>) - X.<span class="c-fn">min</span>(axis=<span class="c-num">0</span>))

<span class="c-comment"># Проверка</span>
X_norm.<span class="c-fn">mean</span>(axis=<span class="c-num">0</span>)                 <span class="c-comment"># ≈ [0, 0, 0, 0]</span>
X_norm.<span class="c-fn">std</span>(axis=<span class="c-num">0</span>)                  <span class="c-comment"># ≈ [1, 1, 1, 1]</span>

<span class="c-comment"># Разделение на train/test</span>
np.random.<span class="c-fn">seed</span>(<span class="c-num">42</span>)
indices = np.random.<span class="c-fn">permutation</span>(<span class="c-fn">len</span>(X))
train_idx = indices[:<span class="c-num">80</span>]
test_idx = indices[<span class="c-num">80</span>:]

X_train = X[train_idx]
X_test = X[test_idx]</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Срез — view, не копия.</strong> Модификация среза меняет оригинал. Явно <code>.copy()</code> если нужен независимый массив.</div>
    <div class="pitfall"><strong>2. <code>a * b</code> vs <code>a @ b</code>.</strong> Первое — поэлементное умножение (Hadamard product), второе — матричное. Классическая ошибка при переходе с MATLAB.</div>
    <div class="pitfall"><strong>3. Целочисленное переполнение.</strong> <code>np.int8</code> вмещает -128..127. <code>np.array([120], dtype=np.int8) + 100</code> → <code>-36</code>. В ML обычно <code>float32</code>/<code>float64</code>.</div>
    <div class="pitfall"><strong>4. <code>axis=0</code> vs <code>axis=1</code>.</strong> Путаница почти у всех новичков. Запомни: axis = «размерность, которая исчезает». <code>axis=0</code> в матрице (rows, cols) — исчезают rows, остаются cols.</div>
    <div class="pitfall"><strong>5. Python-цикл по ndarray = убийство производительности.</strong> Всегда ищи векторизованное решение. Если реально нужен цикл — используй <code>numba</code> с <code>@jit</code>.</div>
    <div class="pitfall"><strong>6. NaN распространяется.</strong> <code>np.array([1, np.nan, 3]).sum()</code> → <code>nan</code>. Для игнорирования: <code>np.nansum</code>, <code>np.nanmean</code>, <code>np.nanstd</code>.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> NumPy — <em>обязательный</em> первый шаг перед ML. Ключевые понятия: <code>ndarray</code>, <code>shape</code>/<code>dtype</code>/<code>axis</code>, векторизация (<code>a * 2</code> вместо цикла), broadcasting (<code>a + row</code>), reshape/transpose. Pandas и PyTorch — надстройки над этим фундаментом.
  </div>
</div>

<!-- ═══════════════════════════ PANDAS ═══════════════════════════ -->
<div id="sec-pandas" class="section">
  <div class="section-title">Pandas — от базы до реальных задач</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Зачем нужен Pandas</div>
    <p class="text"><strong>Pandas</strong> — DataFrame (таблица) + Series (колонка) на основе NumPy. Стандарт для анализа данных, ETL, подготовки датасетов под ML. Умеет читать всё (CSV/Excel/JSON/SQL/Parquet), фильтровать, группировать, объединять, обрабатывать пропуски. Обязательный инструмент data-стека.</p>
    <ul class="bullets">
      <li>Backend-разработчику: конвертация CSV↔JSON↔Excel, разовый ETL, отчёты, миграции</li>
      <li><strong>Для ML: подготовка признаков перед обучением</strong> — очистка, преобразование, agrgегация, объединение источников</li>
      <li>Data-инженеру: пайплайны обработки, Airflow-задачи</li>
    </ul>
    <p class="text"><strong>Когда НЕ Pandas:</strong> production real-time API (тяжёлая инициализация), потоки &gt;RAM (используй Polars / Dask / DuckDB / чанки).</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Зачем backend-разработчику Pandas</div>
    <p class="text">Полноценный курс по Pandas — отдельная тема (это data-science стандарт). Для backend-разработчика полезно знать <em>минимум</em> — для разовых задач:</p>
    <ul class="bullets">
      <li>«Конвертнуть CSV в JSON / из Excel в БД / из БД в отчёт»</li>
      <li>Быстрое исследование данных перед миграцией</li>
      <li>Мини-ETL — раз в сутки достать данные, обработать, сохранить</li>
      <li>Ad-hoc отчёты — «сгруппируй по клиенту, посчитай сумму, отсортируй»</li>
    </ul>
    <p class="text"><strong>Не для</strong>: production real-time API — pandas тяжёлый, для этого SQL/SQLAlchemy.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="download"></i> Установка + первый DataFrame</div>
<pre><code>uv add pandas openpyxl                <span class="c-comment"># openpyxl — для xlsx</span>

<span class="c-key">import</span> pandas <span class="c-key">as</span> pd

<span class="c-comment"># Из dict / list</span>
df = pd.<span class="c-fn">DataFrame</span>({
    <span class="c-str">"name"</span>: [<span class="c-str">"Alice"</span>, <span class="c-str">"Bob"</span>, <span class="c-str">"Charlie"</span>],
    <span class="c-str">"age"</span>: [<span class="c-num">30</span>, <span class="c-num">25</span>, <span class="c-num">35</span>],
    <span class="c-str">"city"</span>: [<span class="c-str">"NY"</span>, <span class="c-str">"LA"</span>, <span class="c-str">"NY"</span>],
})

<span class="c-comment"># Из файлов</span>
df = pd.<span class="c-fn">read_csv</span>(<span class="c-str">"data.csv"</span>)
df = pd.<span class="c-fn">read_excel</span>(<span class="c-str">"data.xlsx"</span>, sheet_name=<span class="c-str">"Users"</span>)
df = pd.<span class="c-fn">read_json</span>(<span class="c-str">"data.json"</span>)
df = pd.<span class="c-fn">read_sql</span>(<span class="c-str">"SELECT * FROM users"</span>, connection)

<span class="c-comment"># Выгрузка</span>
df.<span class="c-fn">to_csv</span>(<span class="c-str">"out.csv"</span>, index=<span class="c-key">False</span>)
df.<span class="c-fn">to_excel</span>(<span class="c-str">"out.xlsx"</span>, index=<span class="c-key">False</span>)
df.<span class="c-fn">to_json</span>(<span class="c-str">"out.json"</span>, orient=<span class="c-str">"records"</span>)
df.<span class="c-fn">to_sql</span>(<span class="c-str">"users"</span>, connection, if_exists=<span class="c-str">"append"</span>)</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="eye"></i> Просмотр данных</div>
<pre><code>df.<span class="c-fn">head</span>(<span class="c-num">10</span>)                    <span class="c-comment"># первые 10</span>
df.<span class="c-fn">tail</span>(<span class="c-num">5</span>)                     <span class="c-comment"># последние 5</span>
df.<span class="c-fn">sample</span>(<span class="c-num">3</span>)                   <span class="c-comment"># случайные 3</span>
df.shape                        <span class="c-comment"># (rows, cols) — (3, 3)</span>
df.columns                      <span class="c-comment"># Index(['name', 'age', 'city'])</span>
df.dtypes                       <span class="c-comment"># типы колонок</span>
df.<span class="c-fn">info</span>()                     <span class="c-comment"># сводка + типы + non-null count</span>
df.<span class="c-fn">describe</span>()                 <span class="c-comment"># статистика по числовым колонкам</span>
<span class="c-fn">len</span>(df)                        <span class="c-comment"># число строк</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="filter"></i> Фильтрация и выборка</div>
<pre><code><span class="c-comment"># Выбрать колонку → Series</span>
df[<span class="c-str">"age"</span>]

<span class="c-comment"># Несколько колонок → DataFrame</span>
df[[<span class="c-str">"name"</span>, <span class="c-str">"age"</span>]]

<span class="c-comment"># Фильтр по условию — как WHERE в SQL</span>
df[df[<span class="c-str">"age"</span>] &gt; <span class="c-num">30</span>]
df[(df[<span class="c-str">"age"</span>] &gt; <span class="c-num">25</span>) &amp; (df[<span class="c-str">"city"</span>] == <span class="c-str">"NY"</span>)]        <span class="c-comment"># &amp; — AND</span>
df[df[<span class="c-str">"city"</span>].<span class="c-fn">isin</span>([<span class="c-str">"NY"</span>, <span class="c-str">"LA"</span>])]                    <span class="c-comment"># IN</span>
df[df[<span class="c-str">"name"</span>].<span class="c-fn">str</span>.<span class="c-fn">startswith</span>(<span class="c-str">"A"</span>)]                <span class="c-comment"># LIKE</span>

<span class="c-comment"># .query() — SQL-подобный синтаксис</span>
df.<span class="c-fn">query</span>(<span class="c-str">"age &gt; 25 and city == 'NY'"</span>)

<span class="c-comment"># Доступ по индексу</span>
df.<span class="c-fn">iloc</span>[<span class="c-num">0</span>]              <span class="c-comment"># первая строка (по позиции)</span>
df.<span class="c-fn">loc</span>[<span class="c-num">0</span>, <span class="c-str">"name"</span>]       <span class="c-comment"># cell — строка 0, колонка name</span>

<span class="c-comment"># Сортировка</span>
df.<span class="c-fn">sort_values</span>(<span class="c-str">"age"</span>, ascending=<span class="c-key">False</span>)</code></pre>

    <div class="pitfall"><strong>⚠ Логические операторы — <code>&amp;</code>/<code>|</code>/<code>~</code>, не <code>and</code>/<code>or</code>/<code>not</code>.</strong> Из-за перегрузки операторов Pandas. И скобки вокруг каждого условия обязательны.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-merge"></i> Группировка и агрегация — как SQL GROUP BY</div>
<pre><code><span class="c-comment"># Сколько людей в каждом городе</span>
df.<span class="c-fn">groupby</span>(<span class="c-str">"city"</span>).<span class="c-fn">size</span>()
<span class="c-comment"># city</span>
<span class="c-comment"># LA    1</span>
<span class="c-comment"># NY    2</span>

<span class="c-comment"># Средний возраст по городам</span>
df.<span class="c-fn">groupby</span>(<span class="c-str">"city"</span>)[<span class="c-str">"age"</span>].<span class="c-fn">mean</span>()

<span class="c-comment"># Несколько агрегатов сразу</span>
df.<span class="c-fn">groupby</span>(<span class="c-str">"city"</span>).<span class="c-fn">agg</span>({
    <span class="c-str">"age"</span>: [<span class="c-str">"mean"</span>, <span class="c-str">"max"</span>, <span class="c-str">"count"</span>],
    <span class="c-str">"name"</span>: <span class="c-str">"count"</span>,
})

<span class="c-comment"># Двойная группировка</span>
df.<span class="c-fn">groupby</span>([<span class="c-str">"city"</span>, <span class="c-str">"department"</span>])[<span class="c-str">"salary"</span>].<span class="c-fn">sum</span>()</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="link"></i> Merge — как JOIN</div>
<pre><code>users = pd.<span class="c-fn">DataFrame</span>({<span class="c-str">"id"</span>: [<span class="c-num">1</span>, <span class="c-num">2</span>], <span class="c-str">"name"</span>: [<span class="c-str">"Alice"</span>, <span class="c-str">"Bob"</span>]})
orders = pd.<span class="c-fn">DataFrame</span>({<span class="c-str">"user_id"</span>: [<span class="c-num">1</span>, <span class="c-num">1</span>, <span class="c-num">2</span>], <span class="c-str">"total"</span>: [<span class="c-num">100</span>, <span class="c-num">200</span>, <span class="c-num">300</span>]})

<span class="c-comment"># INNER JOIN</span>
pd.<span class="c-fn">merge</span>(users, orders, left_on=<span class="c-str">"id"</span>, right_on=<span class="c-str">"user_id"</span>)

<span class="c-comment"># LEFT JOIN</span>
pd.<span class="c-fn">merge</span>(users, orders, left_on=<span class="c-str">"id"</span>, right_on=<span class="c-str">"user_id"</span>, how=<span class="c-str">"left"</span>)

<span class="c-comment"># Все виды: 'inner' (default), 'left', 'right', 'outer', 'cross'</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="edit"></i> Работа с NaN и колонками</div>
<pre><code><span class="c-comment"># NaN — как NULL в SQL</span>
df.<span class="c-fn">isna</span>()                    <span class="c-comment"># булевая маска — где NaN</span>
df.<span class="c-fn">isna</span>().<span class="c-fn">sum</span>()              <span class="c-comment"># сколько NaN по каждой колонке</span>
df.<span class="c-fn">dropna</span>()                  <span class="c-comment"># удалить строки с NaN</span>
df.<span class="c-fn">fillna</span>(<span class="c-num">0</span>)                 <span class="c-comment"># заменить на 0</span>
df[<span class="c-str">"age"</span>].<span class="c-fn">fillna</span>(df[<span class="c-str">"age"</span>].<span class="c-fn">mean</span>())    <span class="c-comment"># заменить на среднее</span>

<span class="c-comment"># Новая колонка на основе других</span>
df[<span class="c-str">"is_adult"</span>] = df[<span class="c-str">"age"</span>] &gt;= <span class="c-num">18</span>
df[<span class="c-str">"full"</span>] = df[<span class="c-str">"name"</span>] + <span class="c-str">" ("</span> + df[<span class="c-str">"city"</span>] + <span class="c-str">")"</span>

<span class="c-comment"># apply — применить функцию</span>
df[<span class="c-str">"age_group"</span>] = df[<span class="c-str">"age"</span>].<span class="c-fn">apply</span>(<span class="c-key">lambda</span> x: <span class="c-str">"adult"</span> <span class="c-key">if</span> x &gt;= <span class="c-num">18</span> <span class="c-key">else</span> <span class="c-str">"minor"</span>)

<span class="c-comment"># Удалить колонку</span>
df = df.<span class="c-fn">drop</span>(columns=[<span class="c-str">"city"</span>])
df = df.<span class="c-fn">drop</span>([<span class="c-num">0</span>, <span class="c-num">2</span>])                        <span class="c-comment"># удалить строки 0 и 2</span>

<span class="c-comment"># Переименовать</span>
df = df.<span class="c-fn">rename</span>(columns={<span class="c-str">"age"</span>: <span class="c-str">"years"</span>})</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. SettingWithCopyWarning.</strong> <code>df[df.age &gt; 18]["name"] = "X"</code> — модифицирует копию, не оригинал. Пиши через <code>.loc</code>: <code>df.loc[df.age &gt; 18, "name"] = "X"</code>.</div>
    <div class="pitfall"><strong>2. Pandas в памяти держит всё сразу.</strong> Для 10GB CSV — не влезет. Читай кусками: <code>pd.read_csv(..., chunksize=100_000)</code> — генератор по чанкам.</div>
    <div class="pitfall"><strong>3. <code>df.iterrows()</code> — медленно.</strong> Обход по строкам в 100 раз медленнее векторных операций. Используй <code>apply</code> или векторизацию.</div>
    <div class="pitfall"><strong>4. Не используй Pandas в HTTP-endpoint.</strong> 200MB импорт + инициализация — не для request-response. Для API — SQL/SQLAlchemy.</div>
    <div class="pitfall"><strong>5. Даты — <code>pd.to_datetime()</code>.</strong> После <code>read_csv</code> даты часто строки. Явно приведи: <code>df["date"] = pd.to_datetime(df["date"])</code>.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> для backend — Pandas это «SQL для CSV/Excel/JSON». Знать <code>read_csv</code>/<code>to_csv</code>, фильтрацию, <code>groupby</code>, <code>merge</code>, <code>fillna</code>. Хватит на 95% разовых задач. Для ML — обязательно + <code>concat</code>, <code>pivot</code>, работа с датами, оптимизация типов. Для production real-time — оставь Pandas data-инженерам.
  </div>
</div>

<!-- ═══════════════════════════ PLOTTING ═══════════════════════════ -->
<div id="sec-plotting" class="section">
  <div class="section-title">matplotlib и seaborn — визуализация</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Что и зачем</div>
    <p class="text">В ML/DS <strong>90% работы — понимать данные</strong>. Гистограмма распределения, scatter корреляций, heatmap важностей, learning curves — без графиков вслепую. Стандартные библиотеки:</p>
    <ul class="bullets">
      <li><strong>matplotlib</strong> (с 2003) — фундамент, низкоуровневый API, полный контроль. Все другие библиотеки под капотом рисуют через matplotlib.</li>
      <li><strong>seaborn</strong> — обёртка над matplotlib, красивые дефолты, статистические графики (regplot, boxplot, heatmap) из коробки.</li>
      <li><strong>plotly</strong> — интерактивные графики (zoom, hover), для веба и дашбордов.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="download"></i> Установка</div>
<pre><code>uv add matplotlib seaborn

<span class="c-key">import</span> matplotlib.pyplot <span class="c-key">as</span> plt      <span class="c-comment"># стандартный alias</span>
<span class="c-key">import</span> seaborn <span class="c-key">as</span> sns
<span class="c-key">import</span> numpy <span class="c-key">as</span> np</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="line-chart"></i> Базовые графики matplotlib</div>
<pre><code><span class="c-comment"># Простой line-plot</span>
x = np.<span class="c-fn">linspace</span>(<span class="c-num">0</span>, <span class="c-num">10</span>, <span class="c-num">100</span>)
y = np.<span class="c-fn">sin</span>(x)

plt.<span class="c-fn">plot</span>(x, y)
plt.<span class="c-fn">xlabel</span>(<span class="c-str">"x"</span>)
plt.<span class="c-fn">ylabel</span>(<span class="c-str">"sin(x)"</span>)
plt.<span class="c-fn">title</span>(<span class="c-str">"Sine wave"</span>)
plt.<span class="c-fn">grid</span>(<span class="c-key">True</span>)
plt.<span class="c-fn">show</span>()

<span class="c-comment"># Несколько линий</span>
plt.<span class="c-fn">plot</span>(x, np.<span class="c-fn">sin</span>(x), label=<span class="c-str">"sin"</span>)
plt.<span class="c-fn">plot</span>(x, np.<span class="c-fn">cos</span>(x), label=<span class="c-str">"cos"</span>)
plt.<span class="c-fn">legend</span>()

<span class="c-comment"># Гистограмма — распределение</span>
data = np.random.<span class="c-fn">randn</span>(<span class="c-num">1000</span>)
plt.<span class="c-fn">hist</span>(data, bins=<span class="c-num">30</span>, edgecolor=<span class="c-str">"black"</span>)

<span class="c-comment"># Scatter — корреляции</span>
plt.<span class="c-fn">scatter</span>(x, y, c=<span class="c-str">"red"</span>, alpha=<span class="c-num">0.5</span>, s=<span class="c-num">30</span>)

<span class="c-comment"># Bar chart</span>
plt.<span class="c-fn">bar</span>([<span class="c-str">"A"</span>, <span class="c-str">"B"</span>, <span class="c-str">"C"</span>], [<span class="c-num">10</span>, <span class="c-num">20</span>, <span class="c-num">15</span>])</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layout-grid"></i> Subplot — несколько графиков</div>
<pre><code>fig, axes = plt.<span class="c-fn">subplots</span>(<span class="c-num">2</span>, <span class="c-num">2</span>, figsize=(<span class="c-num">10</span>, <span class="c-num">8</span>))

axes[<span class="c-num">0</span>, <span class="c-num">0</span>].<span class="c-fn">plot</span>(x, np.<span class="c-fn">sin</span>(x))
axes[<span class="c-num">0</span>, <span class="c-num">0</span>].<span class="c-fn">set_title</span>(<span class="c-str">"sin"</span>)

axes[<span class="c-num">0</span>, <span class="c-num">1</span>].<span class="c-fn">plot</span>(x, np.<span class="c-fn">cos</span>(x))
axes[<span class="c-num">0</span>, <span class="c-num">1</span>].<span class="c-fn">set_title</span>(<span class="c-str">"cos"</span>)

axes[<span class="c-num">1</span>, <span class="c-num">0</span>].<span class="c-fn">hist</span>(data)
axes[<span class="c-num">1</span>, <span class="c-num">1</span>].<span class="c-fn">scatter</span>(x, y)

plt.<span class="c-fn">tight_layout</span>()             <span class="c-comment"># auto-spacing</span>
plt.<span class="c-fn">savefig</span>(<span class="c-str">"plots.png"</span>, dpi=<span class="c-num">150</span>)
plt.<span class="c-fn">show</span>()</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="palette"></i> seaborn — статистика из коробки</div>
<pre><code><span class="c-key">import</span> seaborn <span class="c-key">as</span> sns
<span class="c-key">import</span> pandas <span class="c-key">as</span> pd

sns.<span class="c-fn">set_theme</span>(style=<span class="c-str">"whitegrid"</span>)      <span class="c-comment"># красивая сетка</span>

<span class="c-comment"># Данные</span>
tips = sns.<span class="c-fn">load_dataset</span>(<span class="c-str">"tips"</span>)          <span class="c-comment"># встроенный dataset</span>

<span class="c-comment"># Scatter с регрессией одной строкой</span>
sns.<span class="c-fn">regplot</span>(data=tips, x=<span class="c-str">"total_bill"</span>, y=<span class="c-str">"tip"</span>)

<span class="c-comment"># Boxplot — распределение по категориям</span>
sns.<span class="c-fn">boxplot</span>(data=tips, x=<span class="c-str">"day"</span>, y=<span class="c-str">"total_bill"</span>)

<span class="c-comment"># Violin plot — boxplot + KDE</span>
sns.<span class="c-fn">violinplot</span>(data=tips, x=<span class="c-str">"day"</span>, y=<span class="c-str">"tip"</span>, hue=<span class="c-str">"sex"</span>)

<span class="c-comment"># Heatmap — корреляция признаков (ML-must)</span>
sns.<span class="c-fn">heatmap</span>(df.<span class="c-fn">corr</span>(), annot=<span class="c-key">True</span>, cmap=<span class="c-str">"coolwarm"</span>, fmt=<span class="c-str">".2f"</span>)

<span class="c-comment"># Pairplot — все пары признаков сразу</span>
sns.<span class="c-fn">pairplot</span>(tips, hue=<span class="c-str">"sex"</span>)

<span class="c-comment"># Гистограмма + KDE</span>
sns.<span class="c-fn">histplot</span>(tips, x=<span class="c-str">"total_bill"</span>, kde=<span class="c-key">True</span>, bins=<span class="c-num">30</span>)

<span class="c-comment"># Countplot — счёт по категориям (как bar от Pandas)</span>
sns.<span class="c-fn">countplot</span>(data=tips, x=<span class="c-str">"day"</span>, hue=<span class="c-str">"sex"</span>)</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> ML-must-know: 4 графика для EDA</div>
    <table class="data-table">
      <tr><th>График</th><th>Зачем в ML</th></tr>
      <tr><td><strong>Histogram / KDE</strong></td><td>Распределение признака. Гауссово? Skewed? Нужна ли нормализация / логарифмирование?</td></tr>
      <tr><td><strong>Heatmap correlations</strong> (<code>df.corr()</code>)</td><td>Найти мультиколлинеарность — если два признака сильно коррелируют, один можно выкинуть</td></tr>
      <tr><td><strong>Scatter target vs feature</strong></td><td>Есть ли линейная зависимость? Выбросы?</td></tr>
      <tr><td><strong>Learning curves</strong> (train/val loss vs epoch)</td><td>Overfit? Underfit? Пора остановить обучение?</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практический пример: EDA</div>
<pre><code><span class="c-key">import</span> pandas <span class="c-key">as</span> pd
<span class="c-key">import</span> seaborn <span class="c-key">as</span> sns
<span class="c-key">import</span> matplotlib.pyplot <span class="c-key">as</span> plt

df = pd.<span class="c-fn">read_csv</span>(<span class="c-str">"data.csv"</span>)

<span class="c-comment"># 1. Обзор данных</span>
df.<span class="c-fn">info</span>()
df.<span class="c-fn">describe</span>()

<span class="c-comment"># 2. Распределения всех числовых</span>
df.<span class="c-fn">hist</span>(figsize=(<span class="c-num">12</span>, <span class="c-num">8</span>), bins=<span class="c-num">30</span>)
plt.<span class="c-fn">tight_layout</span>()

<span class="c-comment"># 3. Heatmap корреляций</span>
plt.<span class="c-fn">figure</span>(figsize=(<span class="c-num">10</span>, <span class="c-num">8</span>))
sns.<span class="c-fn">heatmap</span>(df.<span class="c-fn">corr</span>(numeric_only=<span class="c-key">True</span>), annot=<span class="c-key">True</span>, cmap=<span class="c-str">"coolwarm"</span>, center=<span class="c-num">0</span>)

<span class="c-comment"># 4. Отношения target ↔ признаки</span>
sns.<span class="c-fn">pairplot</span>(df, hue=<span class="c-str">"target"</span>, diag_kind=<span class="c-str">"kde"</span>)

<span class="c-comment"># 5. Проверка баланса классов</span>
sns.<span class="c-fn">countplot</span>(data=df, x=<span class="c-str">"target"</span>)</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>plt.show()</code> в скрипте / <code>%matplotlib inline</code> в ноутбуке.</strong> В Jupyter графики рендерятся inline автоматически с 3+, показ <code>plt.show()</code> необязателен.</div>
    <div class="pitfall"><strong>2. Не забывай <code>plt.figure(figsize=...)</code></strong> — иначе всё будет квадратные микро-графики 6×4.</div>
    <div class="pitfall"><strong>3. Легенды и подписи осей.</strong> Без них график непонятен спустя неделю. Дисциплина: всегда xlabel + ylabel + title.</div>
    <div class="pitfall"><strong>4. Не смешивай plt и axes API</strong> в одной ячейке. Или plt.plot()/plt.title() (state-based), или fig, ax = plt.subplots(); ax.plot(); ax.set_title() (object-based). Второй чище для сложных фигур.</div>
    <div class="pitfall"><strong>5. plt.close("all")</strong> в конце скриптов — иначе память с figures копится, особенно в цикле.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> для EDA в ML — seaborn (быстрые красивые графики) поверх matplotlib. Must-know: <code>hist</code>, <code>scatter</code>, <code>heatmap</code>, <code>pairplot</code>. Для production-дашбордов — plotly. Инлайн-графики в Jupyter — стандартный workflow ML.
  </div>
</div>

<!-- ═══════════════════════════ JUPYTER ═══════════════════════════ -->
<div id="sec-jupyter" class="section">
  <div class="section-title">Jupyter Notebooks — рабочая среда ML</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Что это и зачем</div>
    <p class="text"><strong>Jupyter Notebook</strong> — интерактивная среда, где код разбит на <em>ячейки</em>, каждая выполняется отдельно, состояние переменных сохраняется между ячейками. Файл <code>.ipynb</code> — JSON с ячейками (код + markdown + результаты выполнения). Для ML — стандартная среда, а не <code>.py</code>-скрипты.</p>

    <div class="analogy">
      <strong>Аналогия:</strong> обычный Python-скрипт — «спектакль», который прогоняешь от начала до конца. Jupyter — <em>«ремонтная мастерская»</em>: разложил детали на верстаке, вертишь каждую, смотришь, правишь. Загрузил датасет один раз, потом 50 ячеек экспериментов с ним.
    </div>

    <p class="text"><strong>Почему в ML именно так:</strong></p>
    <ul class="bullets">
      <li>Загрузка данных занимает 10-60 секунд — глупо перезапускать при каждой правке</li>
      <li>Обучение модели — минуты/часы, тоже не хочешь повторять при исследовании результата</li>
      <li>Графики видны сразу под кодом, легко сравнивать эксперименты</li>
      <li>Комбинация кода + markdown + графиков = живой отчёт для команды</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="download"></i> Установка + запуск</div>
<pre><code>uv add jupyter

<span class="c-comment"># Классический Jupyter</span>
uv run jupyter notebook

<span class="c-comment"># JupyterLab (современный UI)</span>
uv add jupyterlab
uv run jupyter lab

<span class="c-comment"># Или просто открой .ipynb в VS Code — встроенная поддержка</span>
<span class="c-comment"># PyCharm Professional тоже умеет</span></code></pre>

    <p class="text"><strong>Cloud-варианты</strong> (без установки):</p>
    <ul class="bullets">
      <li><strong>Google Colab</strong> (colab.research.google.com) — бесплатно, GPU/TPU по подписке. Стандарт для learning.</li>
      <li><strong>Kaggle Notebooks</strong> — с встроенным доступом к датасетам</li>
      <li><strong>Deepnote</strong>, <strong>Databricks</strong> — enterprise-платформы</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="mouse-pointer-click"></i> Основные горячие клавиши</div>
    <table class="data-table">
      <tr><th>Клавиша</th><th>Что делает</th></tr>
      <tr><td><code>Shift + Enter</code></td><td>Выполнить ячейку, перейти к следующей</td></tr>
      <tr><td><code>Ctrl + Enter</code></td><td>Выполнить, остаться на этой</td></tr>
      <tr><td><code>Alt + Enter</code></td><td>Выполнить + вставить новую ячейку снизу</td></tr>
      <tr><td><code>Esc</code></td><td>Выйти из режима редактирования (command mode)</td></tr>
      <tr><td><code>A</code> / <code>B</code> (в command mode)</td><td>Вставить ячейку выше / ниже</td></tr>
      <tr><td><code>DD</code></td><td>Удалить ячейку</td></tr>
      <tr><td><code>M</code> / <code>Y</code></td><td>Переключить в markdown / в code</td></tr>
      <tr><td><code>Z</code></td><td>Undo удаления ячейки</td></tr>
      <tr><td><code>Ctrl + /</code></td><td>Комментировать/раскомментировать строку</td></tr>
      <tr><td><code>Tab</code></td><td>Автокомплит</td></tr>
      <tr><td><code>Shift + Tab</code></td><td>Показать docstring функции под курсором</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="percent"></i> Магические команды (magics)</div>
<pre><code><span class="c-comment"># %% — cell magic, применяется к всей ячейке</span>
<span class="c-comment"># % — line magic, к одной строке</span>

%time         <span class="c-fn">expensive_function</span>()      <span class="c-comment"># замерить время одной операции</span>
%%time                                    <span class="c-comment"># замерить время ВСЕЙ ячейки</span>
<span class="c-fn">stuff</span>()
<span class="c-fn">more_stuff</span>()

%timeit <span class="c-fn">expensive</span>()                      <span class="c-comment"># усреднение по N запусков (для микро-бенчей)</span>

%matplotlib inline                        <span class="c-comment"># графики inline (default в новых Jupyter)</span>
%matplotlib widget                        <span class="c-comment"># интерактивные</span>

%load_ext autoreload                      <span class="c-comment"># авто-перезагрузка своих модулей</span>
%autoreload <span class="c-num">2</span>

%who                                      <span class="c-comment"># список переменных в namespace</span>
%whos                                     <span class="c-comment"># с типами и деталями</span>
%reset                                    <span class="c-comment"># очистить весь namespace</span>

<span class="c-comment"># Запуск shell-команд — префикс !</span>
!ls -la
!pip list
!git status

<span class="c-comment"># Присвоить результат shell в переменную</span>
files = !ls *.csv</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="clipboard-list"></i> Типичный workflow ML-исследования</div>
<pre><code><span class="c-comment"># Ячейка 1 — импорты (один раз)</span>
<span class="c-key">import</span> pandas <span class="c-key">as</span> pd
<span class="c-key">import</span> numpy <span class="c-key">as</span> np
<span class="c-key">import</span> matplotlib.pyplot <span class="c-key">as</span> plt
<span class="c-key">import</span> seaborn <span class="c-key">as</span> sns

<span class="c-comment"># Ячейка 2 — загрузка данных (тяжёлая, один раз)</span>
df = pd.<span class="c-fn">read_csv</span>(<span class="c-str">"train.csv"</span>)
df.shape

<span class="c-comment"># Ячейка 3 — беглый обзор</span>
df.<span class="c-fn">head</span>()

<span class="c-comment"># Ячейка 4 — распределения</span>
df.<span class="c-fn">hist</span>(figsize=(<span class="c-num">12</span>, <span class="c-num">8</span>))
plt.<span class="c-fn">tight_layout</span>()

<span class="c-comment"># Ячейка 5 — корреляции</span>
sns.<span class="c-fn">heatmap</span>(df.<span class="c-fn">corr</span>(numeric_only=<span class="c-key">True</span>), annot=<span class="c-key">True</span>)

<span class="c-comment"># Ячейка 6 — feature engineering</span>
df[<span class="c-str">"age_group"</span>] = pd.<span class="c-fn">cut</span>(df[<span class="c-str">"age"</span>], bins=[<span class="c-num">0</span>, <span class="c-num">18</span>, <span class="c-num">65</span>, <span class="c-num">100</span>])

<span class="c-comment"># Ячейка 7 — обучение модели</span>
<span class="c-key">from</span> sklearn.ensemble <span class="c-key">import</span> RandomForestClassifier
model = <span class="c-fn">RandomForestClassifier</span>()
model.<span class="c-fn">fit</span>(X_train, y_train)

<span class="c-comment"># Ячейка 8 — оценка</span>
score = model.<span class="c-fn">score</span>(X_test, y_test)
<span class="c-fn">print</span>(<span class="c-fn">f</span><span class="c-str">"Accuracy: {score:.3f}"</span>)</code></pre>
    <p class="text">Данные загружены один раз (ячейка 2). Экспериментируешь в ячейках 4-8 без повторной загрузки. Обучил модель раз — тестируешь на разных данных, не переобучая.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Скрытое состояние.</strong> Ячейки можно выполнять в любом порядке — переменная <code>x</code> может быть от ячейки 5, а не от ячейки 3. Заканчивая работу: <em>Kernel → Restart &amp; Run All</em> — проверить что notebook воспроизводим сверху вниз.</div>
    <div class="pitfall"><strong>2. Утечка памяти при переменных.</strong> Тяжёлый DataFrame в переменной живёт до перезапуска kernel. <code>del df; import gc; gc.collect()</code> — если нужно освободить.</div>
    <div class="pitfall"><strong>3. Git diff нечитаем.</strong> .ipynb — JSON с outputs. Diff в PR — ад. Решения: <code>nbstripout</code> (убирает outputs при commit), <code>jupytext</code> (парная .py-версия для diff), <code>ReviewNB</code>.</div>
    <div class="pitfall"><strong>4. Notebook — не production.</strong> Для реального deploy — переноси код в <code>.py</code>-модули, notebook оставь для experiments. Не запускать <code>jupyter nbconvert --execute prod.ipynb</code> в cron — хрупко.</div>
    <div class="pitfall"><strong>5. Долгие вычисления без прогресса.</strong> Для циклов используй <code>from tqdm.auto import tqdm; for x in tqdm(items):</code> — прогресс-бар.</div>
    <div class="pitfall"><strong>6. Секреты в ноутбуке.</strong> API-ключ прямо в ячейке = утечёт в git. Читай из <code>.env</code>: <code>from dotenv import load_dotenv; load_dotenv(); os.getenv("API_KEY")</code>.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> для ML — Jupyter Notebook (или Colab) стандарт. Ячейки + <code>Shift+Enter</code>, magic-команды (<code>%time</code>, <code>%matplotlib inline</code>), <code>tqdm</code> для прогресса. Для production — переноси в модули. Git через <code>nbstripout</code> / <code>jupytext</code>.
  </div>
</div>

<!-- ═══════════════════════════ ALGORITHMS ═══════════════════════════ -->
<div id="sec-algorithms" class="section">
  <div class="section-title">Алгоритмические паттерны на массивах</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Зачем это знать</div>
    <p class="text">На собеседованиях (особенно ML/DS) и в тестах — <em>обязательный</em> навык. Задача: «найди пару чисел с суммой X», «максимальную подстроку без повторов», «скользящее окно из K чисел». Без знания паттернов пишешь O(n²) там, где нужен O(n).</p>

    <div class="analogy">
      <strong>Ключевая идея:</strong> вместо вложенных циклов держи <em>дополнительное состояние</em> (индекс, сумму, счётчик, словарь) и обрабатывай массив за <em>один</em> проход.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-right"></i> 1. Проход с накоплением (running sum)</div>
    <p class="text">Считать что-то по мере прохода: сумму, произведение, максимум, счётчик.</p>
<pre><code><span class="c-comment"># Задача: сумма всех положительных</span>
<span class="c-key">def</span> <span class="c-fn">sum_positive</span>(nums):
    total = <span class="c-num">0</span>
    <span class="c-key">for</span> n <span class="c-key">in</span> nums:
        <span class="c-key">if</span> n &gt; <span class="c-num">0</span>:
            total += n
    <span class="c-key">return</span> total

<span class="c-comment"># Задача: максимальная сумма подряд идущих (Kadane's algorithm)</span>
<span class="c-key">def</span> <span class="c-fn">max_subarray_sum</span>(nums):
    max_sum = current = nums[<span class="c-num">0</span>]
    <span class="c-key">for</span> n <span class="c-key">in</span> nums[<span class="c-num">1</span>:]:
        current = <span class="c-fn">max</span>(n, current + n)
        max_sum = <span class="c-fn">max</span>(max_sum, current)
    <span class="c-key">return</span> max_sum

<span class="c-fn">max_subarray_sum</span>([-<span class="c-num">2</span>, <span class="c-num">1</span>, -<span class="c-num">3</span>, <span class="c-num">4</span>, -<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">1</span>, -<span class="c-num">5</span>, <span class="c-num">4</span>])   <span class="c-comment"># 6 (от [4,-1,2,1])</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare-arrows"></i> 2. Два указателя (two pointers)</div>
    <p class="text">Два индекса, движущиеся навстречу или в одном направлении. Заменяет вложенный цикл O(n²) на O(n).</p>
<pre><code><span class="c-comment"># Задача: есть ли в отсортированном массиве пара с суммой = target</span>
<span class="c-key">def</span> <span class="c-fn">has_pair_sum</span>(nums, target):
    left, right = <span class="c-num">0</span>, <span class="c-fn">len</span>(nums) - <span class="c-num">1</span>
    <span class="c-key">while</span> left &lt; right:
        s = nums[left] + nums[right]
        <span class="c-key">if</span> s == target:
            <span class="c-key">return</span> <span class="c-key">True</span>
        <span class="c-key">elif</span> s &lt; target:
            left += <span class="c-num">1</span>        <span class="c-comment"># нужна большая сумма → сдвиг вправо</span>
        <span class="c-key">else</span>:
            right -= <span class="c-num">1</span>       <span class="c-comment"># нужна меньшая → сдвиг влево</span>
    <span class="c-key">return</span> <span class="c-key">False</span>

<span class="c-fn">has_pair_sum</span>([<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">4</span>, <span class="c-num">7</span>, <span class="c-num">11</span>, <span class="c-num">15</span>], <span class="c-num">9</span>)     <span class="c-comment"># True (2 + 7)</span>

<span class="c-comment"># Задача: удалить дубликаты in-place</span>
<span class="c-key">def</span> <span class="c-fn">remove_duplicates</span>(nums):
    <span class="c-key">if</span> <span class="c-key">not</span> nums:
        <span class="c-key">return</span> <span class="c-num">0</span>
    write = <span class="c-num">1</span>
    <span class="c-key">for</span> read <span class="c-key">in</span> <span class="c-fn">range</span>(<span class="c-num">1</span>, <span class="c-fn">len</span>(nums)):
        <span class="c-key">if</span> nums[read] != nums[read - <span class="c-num">1</span>]:
            nums[write] = nums[read]
            write += <span class="c-num">1</span>
    <span class="c-key">return</span> write

<span class="c-comment"># Задача: разворот массива in-place</span>
<span class="c-key">def</span> <span class="c-fn">reverse</span>(nums):
    left, right = <span class="c-num">0</span>, <span class="c-fn">len</span>(nums) - <span class="c-num">1</span>
    <span class="c-key">while</span> left &lt; right:
        nums[left], nums[right] = nums[right], nums[left]
        left += <span class="c-num">1</span>
        right -= <span class="c-num">1</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="scan"></i> 3. Скользящее окно (sliding window)</div>
    <p class="text">Два указателя движутся в <em>одном</em> направлении, поддерживая «окно» — подмассив/подстроку. Классика для «максимум/минимум/сумма подмассива длины K», «подстрока с условием».</p>
<pre><code><span class="c-comment"># Задача: максимальная сумма подмассива длины K</span>
<span class="c-key">def</span> <span class="c-fn">max_sum_window</span>(nums, k):
    window = <span class="c-fn">sum</span>(nums[:k])
    max_sum = window
    <span class="c-key">for</span> i <span class="c-key">in</span> <span class="c-fn">range</span>(k, <span class="c-fn">len</span>(nums)):
        window += nums[i] - nums[i - k]     <span class="c-comment"># сдвинули окно на 1</span>
        max_sum = <span class="c-fn">max</span>(max_sum, window)
    <span class="c-key">return</span> max_sum

<span class="c-fn">max_sum_window</span>([<span class="c-num">1</span>, <span class="c-num">4</span>, <span class="c-num">2</span>, <span class="c-num">10</span>, <span class="c-num">23</span>, <span class="c-num">3</span>, <span class="c-num">1</span>, <span class="c-num">0</span>, <span class="c-num">20</span>], <span class="c-num">4</span>)   <span class="c-comment"># 39</span>

<span class="c-comment"># Задача: длина максимальной подстроки без повторов</span>
<span class="c-key">def</span> <span class="c-fn">longest_unique</span>(s):
    seen = {}                       <span class="c-comment"># char → last index</span>
    left = <span class="c-num">0</span>
    best = <span class="c-num">0</span>
    <span class="c-key">for</span> right, ch <span class="c-key">in</span> <span class="c-fn">enumerate</span>(s):
        <span class="c-key">if</span> ch <span class="c-key">in</span> seen <span class="c-key">and</span> seen[ch] &gt;= left:
            left = seen[ch] + <span class="c-num">1</span>     <span class="c-comment"># сдвинуть окно после дубликата</span>
        seen[ch] = right
        best = <span class="c-fn">max</span>(best, right - left + <span class="c-num">1</span>)
    <span class="c-key">return</span> best

<span class="c-fn">longest_unique</span>(<span class="c-str">"abcabcbb"</span>)         <span class="c-comment"># 3 (abc)</span>
<span class="c-fn">longest_unique</span>(<span class="c-str">"pwwkew"</span>)           <span class="c-comment"># 3 (wke)</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="table-2"></i> 4. Prefix sum — предвычисление префиксных сумм</div>
    <p class="text">Заранее считаем массив префиксных сумм. Потом сумма любого подмассива [i..j] — за O(1) вместо O(j-i).</p>
<pre><code>nums = [<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>, <span class="c-num">4</span>, <span class="c-num">5</span>]
prefix = [<span class="c-num">0</span>]                       <span class="c-comment"># prefix[i] = sum(nums[:i])</span>
<span class="c-key">for</span> n <span class="c-key">in</span> nums:
    prefix.<span class="c-fn">append</span>(prefix[-<span class="c-num">1</span>] + n)
<span class="c-comment"># prefix = [0, 1, 3, 6, 10, 15]</span>

<span class="c-comment"># Сумма nums[1..3] (индексы включительно) — за O(1)</span>
prefix[<span class="c-num">4</span>] - prefix[<span class="c-num">1</span>]              <span class="c-comment"># 10 - 1 = 9 (2+3+4)</span>

<span class="c-comment"># Полезно если запросов сумм МНОГО — предвычислили один раз</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hash"></i> 5. Hash-map + один проход</div>
    <p class="text">Классический паттерн «two sum» — за один проход через словарь. Меняет O(n²) на O(n) за счёт O(n) памяти.</p>
<pre><code><span class="c-comment"># Задача: индексы двух чисел с суммой = target (LeetCode #1)</span>
<span class="c-key">def</span> <span class="c-fn">two_sum</span>(nums, target):
    seen = {}                       <span class="c-comment"># value → index</span>
    <span class="c-key">for</span> i, n <span class="c-key">in</span> <span class="c-fn">enumerate</span>(nums):
        need = target - n
        <span class="c-key">if</span> need <span class="c-key">in</span> seen:
            <span class="c-key">return</span> [seen[need], i]
        seen[n] = i
    <span class="c-key">return</span> []

<span class="c-fn">two_sum</span>([<span class="c-num">2</span>, <span class="c-num">7</span>, <span class="c-num">11</span>, <span class="c-num">15</span>], <span class="c-num">9</span>)      <span class="c-comment"># [0, 1]</span>

<span class="c-comment"># Задача: подсчёт частот</span>
<span class="c-key">from</span> collections <span class="c-key">import</span> Counter
freq = <span class="c-fn">Counter</span>([<span class="c-str">"a"</span>, <span class="c-str">"b"</span>, <span class="c-str">"a"</span>, <span class="c-str">"c"</span>, <span class="c-str">"a"</span>])
<span class="c-comment"># Counter({'a': 3, 'b': 1, 'c': 1})</span>
freq.<span class="c-fn">most_common</span>(<span class="c-num">2</span>)              <span class="c-comment"># [('a', 3), ('b', 1)]</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="split"></i> 6. Fast/slow pointers (заяц и черепаха)</div>
    <p class="text">Два указателя с разной скоростью. Найти середину списка, обнаружить цикл в связном списке, найти дубликат в массиве.</p>
<pre><code><span class="c-comment"># Задача: найти дубликат в массиве где числа 1..n, размер n+1</span>
<span class="c-key">def</span> <span class="c-fn">find_duplicate</span>(nums):
    slow = fast = nums[<span class="c-num">0</span>]
    <span class="c-key">while</span> <span class="c-key">True</span>:
        slow = nums[slow]
        fast = nums[nums[fast]]
        <span class="c-key">if</span> slow == fast:
            <span class="c-key">break</span>
    <span class="c-comment"># Найти вход в цикл</span>
    slow = nums[<span class="c-num">0</span>]
    <span class="c-key">while</span> slow != fast:
        slow = nums[slow]
        fast = nums[fast]
    <span class="c-key">return</span> slow

<span class="c-fn">find_duplicate</span>([<span class="c-num">1</span>, <span class="c-num">3</span>, <span class="c-num">4</span>, <span class="c-num">2</span>, <span class="c-num">2</span>])   <span class="c-comment"># 2</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> 7. Бинарный поиск</div>
<pre><code><span class="c-comment"># Индекс в отсортированном массиве</span>
<span class="c-key">def</span> <span class="c-fn">bsearch</span>(nums, target):
    left, right = <span class="c-num">0</span>, <span class="c-fn">len</span>(nums) - <span class="c-num">1</span>
    <span class="c-key">while</span> left &lt;= right:
        mid = (left + right) // <span class="c-num">2</span>
        <span class="c-key">if</span> nums[mid] == target:
            <span class="c-key">return</span> mid
        <span class="c-key">elif</span> nums[mid] &lt; target:
            left = mid + <span class="c-num">1</span>
        <span class="c-key">else</span>:
            right = mid - <span class="c-num">1</span>
    <span class="c-key">return</span> -<span class="c-num">1</span>

<span class="c-comment"># Готовое из stdlib — bisect</span>
<span class="c-key">import</span> bisect
bisect.<span class="c-fn">bisect_left</span>([<span class="c-num">1</span>, <span class="c-num">3</span>, <span class="c-num">5</span>, <span class="c-num">7</span>], <span class="c-num">3</span>)      <span class="c-comment"># 1 — куда вставить 3</span>
bisect.<span class="c-fn">insort</span>(a, x)                             <span class="c-comment"># вставить с сохранением сортировки</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-square"></i> Cheatsheet: какой паттерн под какую задачу</div>
    <table class="data-table">
      <tr><th>Задача</th><th>Паттерн</th><th>Сложность</th></tr>
      <tr><td>«Есть ли пара с суммой X» (сортированный)</td><td>Два указателя</td><td>O(n)</td></tr>
      <tr><td>«Есть ли пара с суммой X» (произвольный)</td><td>Hash-map</td><td>O(n) time, O(n) memory</td></tr>
      <tr><td>«Максимум/минимум подмассива длины K»</td><td>Sliding window</td><td>O(n)</td></tr>
      <tr><td>«Подстрока/подмассив с условием»</td><td>Sliding window + hash</td><td>O(n)</td></tr>
      <tr><td>«Сумма любого подмассива» (много запросов)</td><td>Prefix sum</td><td>O(n) prep + O(1) query</td></tr>
      <tr><td>«Топ-K частых»</td><td><code>Counter.most_common</code></td><td>O(n log k)</td></tr>
      <tr><td>«Индекс в сортированном»</td><td>Binary search / <code>bisect</code></td><td>O(log n)</td></tr>
      <tr><td>«Цикл в связном списке / дубликат»</td><td>Fast/slow pointers</td><td>O(n) time, O(1) memory</td></tr>
      <tr><td>«Максимальная сумма подряд»</td><td>Kadane (running max)</td><td>O(n)</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="lightbulb"></i> Питоничные trick'и</div>
<pre><code><span class="c-comment"># Обмен переменных без временной</span>
a, b = b, a

<span class="c-comment"># Развёртка сложных данных</span>
first, *rest = [<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>, <span class="c-num">4</span>]     <span class="c-comment"># first=1, rest=[2,3,4]</span>
first, *middle, last = <span class="c-fn">range</span>(<span class="c-num">10</span>)    <span class="c-comment"># first=0, middle=[1..8], last=9</span>

<span class="c-comment"># Одна строка для условной вставки</span>
result = [x <span class="c-key">if</span> x &gt; <span class="c-num">0</span> <span class="c-key">else</span> <span class="c-num">0</span> <span class="c-key">for</span> x <span class="c-key">in</span> nums]

<span class="c-comment"># zip для параллельного обхода</span>
<span class="c-key">for</span> a, b <span class="c-key">in</span> <span class="c-fn">zip</span>(nums, nums[<span class="c-num">1</span>:]):     <span class="c-comment"># пары соседей</span>
    ...

<span class="c-comment"># Обход в обратном</span>
<span class="c-key">for</span> i <span class="c-key">in</span> <span class="c-fn">range</span>(<span class="c-fn">len</span>(nums) - <span class="c-num">1</span>, -<span class="c-num">1</span>, -<span class="c-num">1</span>):
    ...
<span class="c-comment"># или</span>
<span class="c-key">for</span> x <span class="c-key">in</span> <span class="c-fn">reversed</span>(nums):
    ...

<span class="c-comment"># Проверка на палиндром одной строкой</span>
s == s[::-<span class="c-num">1</span>]

<span class="c-comment"># Уникальные + отсортированные + сохранить порядок первых вхождений</span>
<span class="c-key">from</span> collections <span class="c-key">import</span> OrderedDict
<span class="c-fn">list</span>(<span class="c-fn">OrderedDict</span>.<span class="c-fn">fromkeys</span>([<span class="c-num">3</span>, <span class="c-num">1</span>, <span class="c-num">3</span>, <span class="c-num">2</span>, <span class="c-num">1</span>]))   <span class="c-comment"># [3, 1, 2]

<span class="c-comment"># Инициализация словаря значениями по умолчанию</span>
<span class="c-key">from</span> collections <span class="c-key">import</span> defaultdict
counts = <span class="c-fn">defaultdict</span>(<span class="c-fn">int</span>)              <span class="c-comment"># без KeyError</span>
groups = <span class="c-fn">defaultdict</span>(<span class="c-fn">list</span>)             <span class="c-comment"># группировка</span>
<span class="c-key">for</span> item <span class="c-key">in</span> items:
    groups[item.category].<span class="c-fn">append</span>(item)</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Слайс — копия.</strong> <code>nums[:]</code> создаёт новый список. Для больших массивов дорого. Итерируй через индексы или используй view (numpy).</div>
    <div class="pitfall"><strong>2. Модификация массива при итерации.</strong> <code>for x in nums: nums.remove(x)</code> — пропустит элементы. Итерируй по копии либо строй новый список.</div>
    <div class="pitfall"><strong>3. Целочисленное деление.</strong> <code>mid = (l + r) // 2</code> — <em>двойной</em> слэш. Одинарный <code>/</code> в Python 3 всегда float.</div>
    <div class="pitfall"><strong>4. Переполнение — нет.</strong> Python int безграничен. В отличие от C/Java <code>(l + r) / 2</code> не переполнится. Всё равно пиши <code>l + (r - l) // 2</code> для переноса кода на другие языки.</div>
    <div class="pitfall"><strong>5. Пустой массив.</strong> Всегда проверяй edge case: <code>if not nums: return</code>. Ошибки типа <code>max([])</code> = <code>ValueError</code>.</div>
    <div class="pitfall"><strong>6. Комментировать сложность.</strong> На собесе в решении пиши <code># Time: O(n), Space: O(1)</code>. Показывает что понимаешь что написал.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> запомни 6 паттернов и когда каждый применять — покрывает 80% алгоритмических задач на массивах / строках. Ключевая мысль: <em>вместо вложенных циклов — одно дополнительное состояние (указатель, словарь, окно)</em>. Питонические trick'и (<code>zip</code>, <code>enumerate</code>, <code>Counter</code>, <code>defaultdict</code>, <code>bisect</code>) экономят строки и делают решение читаемее.
  </div>
</div>

<div id="sec-testing" class="section">
  <div class="section-title">pytest + fixtures</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Почему pytest, а не unittest</div>
    <p class="text><code>unittest</code> в stdlib — как JUnit: класс наследуется от <code>TestCase</code>, методы <code>test_*</code>, ассерты через <code>self.assertEqual(...)</code>. Многословно. <strong>pytest</strong> (внешний, но де-факто стандарт) — тесты пишутся как <em>обычные функции</em> с обычным <code>assert</code>, плюс мощная система fixtures.</p>
<pre><code><span class="c-comment"># unittest — многословно</span>
<span class="c-key">import</span> unittest

<span class="c-key">class</span> <span class="c-type">TestMath</span>(unittest.<span class="c-type">TestCase</span>):
    <span class="c-key">def</span> <span class="c-fn">test_add</span>(<span class="c-key">self</span>):
        <span class="c-key">self</span>.<span class="c-fn">assertEqual</span>(<span class="c-num">1</span> + <span class="c-num">1</span>, <span class="c-num">2</span>)

<span class="c-comment"># pytest — просто</span>
<span class="c-key">def</span> <span class="c-fn">test_add</span>():
    <span class="c-key">assert</span> <span class="c-num">1</span> + <span class="c-num">1</span> == <span class="c-num">2</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="download"></i> Установка + структура</div>
<pre><code>uv add --dev pytest pytest-cov

<span class="c-comment"># Структура проекта</span>
myapp/
├── src/
│   └── calc.py
└── tests/
    ├── test_calc.py           <span class="c-comment"># файлы test_*.py или *_test.py</span>
    └── conftest.py            <span class="c-comment"># общие fixtures</span>

<span class="c-comment"># Запуск</span>
uv run pytest                    <span class="c-comment"># все тесты</span>
uv run pytest tests/test_calc.py <span class="c-comment"># конкретный файл</span>
uv run pytest -k <span class="c-str">"test_add"</span>       <span class="c-comment"># по имени</span>
uv run pytest -v                 <span class="c-comment"># verbose</span>
uv run pytest -x                 <span class="c-comment"># остановиться на первой ошибке</span>
uv run pytest --pdb              <span class="c-comment"># дебаггер при падении</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-square"></i> Тесты и assert</div>
<pre><code><span class="c-comment"># tests/test_calc.py</span>
<span class="c-key">from</span> src.calc <span class="c-key">import</span> add, divide

<span class="c-key">def</span> <span class="c-fn">test_add_positive</span>():
    <span class="c-key">assert</span> <span class="c-fn">add</span>(<span class="c-num">2</span>, <span class="c-num">3</span>) == <span class="c-num">5</span>

<span class="c-key">def</span> <span class="c-fn">test_add_negative</span>():
    <span class="c-key">assert</span> <span class="c-fn">add</span>(-<span class="c-num">2</span>, <span class="c-num">3</span>) == <span class="c-num">1</span>

<span class="c-comment"># Ожидание исключения</span>
<span class="c-key">import</span> pytest

<span class="c-key">def</span> <span class="c-fn">test_divide_by_zero</span>():
    <span class="c-key">with</span> pytest.<span class="c-fn">raises</span>(<span class="c-type">ZeroDivisionError</span>):
        <span class="c-fn">divide</span>(<span class="c-num">10</span>, <span class="c-num">0</span>)

<span class="c-key">def</span> <span class="c-fn">test_divide_by_zero_message</span>():
    <span class="c-key">with</span> pytest.<span class="c-fn">raises</span>(<span class="c-type">ValueError</span>, match=<span class="c-str">"cannot divide"</span>):
        <span class="c-fn">divide</span>(<span class="c-num">10</span>, <span class="c-num">0</span>)

<span class="c-comment"># Приблизительное сравнение float</span>
<span class="c-key">def</span> <span class="c-fn">test_float</span>():
    <span class="c-key">assert</span> <span class="c-num">0.1</span> + <span class="c-num">0.2</span> == pytest.<span class="c-fn">approx</span>(<span class="c-num">0.3</span>)

<span class="c-comment"># Пропуск тестов</span>
<span class="c-key">@pytest</span>.<span class="c-fn">mark</span>.<span class="c-fn">skip</span>(reason=<span class="c-str">"not implemented yet"</span>)
<span class="c-key">def</span> <span class="c-fn">test_todo</span>(): ...

<span class="c-key">@pytest</span>.<span class="c-fn">mark</span>.<span class="c-fn">skipif</span>(sys.version_info &lt; (<span class="c-num">3</span>, <span class="c-num">11</span>), reason=<span class="c-str">"needs 3.11+"</span>)
<span class="c-key">def</span> <span class="c-fn">test_new_syntax</span>(): ...</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package"></i> Fixtures — заменяют setUp/tearDown</div>
<pre><code><span class="c-comment"># tests/conftest.py — общие fixtures</span>
<span class="c-key">import</span> pytest

<span class="c-key">@pytest</span>.<span class="c-fn">fixture</span>
<span class="c-key">def</span> <span class="c-fn">sample_user</span>():
    <span class="c-key">return</span> {<span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>, <span class="c-str">"age"</span>: <span class="c-num">30</span>}

<span class="c-key">@pytest</span>.<span class="c-fn">fixture</span>
<span class="c-key">def</span> <span class="c-fn">db_session</span>():
    <span class="c-comment"># setup</span>
    engine = <span class="c-fn">create_engine</span>(<span class="c-str">"sqlite:///:memory:"</span>)
    <span class="c-type">Base</span>.metadata.<span class="c-fn">create_all</span>(engine)
    session = <span class="c-fn">Session</span>(engine)

    <span class="c-key">yield</span> session               <span class="c-comment"># тут выполняется тест</span>

    <span class="c-comment"># teardown</span>
    session.<span class="c-fn">close</span>()
    engine.<span class="c-fn">dispose</span>()

<span class="c-comment"># Тест получает fixture через параметр — DI</span>
<span class="c-key">def</span> <span class="c-fn">test_user_name</span>(sample_user):
    <span class="c-key">assert</span> sample_user[<span class="c-str">"name"</span>] == <span class="c-str">"Alice"</span>

<span class="c-key">def</span> <span class="c-fn">test_db</span>(db_session):
    user = <span class="c-type">User</span>(name=<span class="c-str">"Bob"</span>)
    db_session.<span class="c-fn">add</span>(user)
    db_session.<span class="c-fn">commit</span>()
    <span class="c-key">assert</span> user.id <span class="c-key">is not None</span>

<span class="c-comment"># Scope — как долго живёт fixture</span>
<span class="c-key">@pytest</span>.<span class="c-fn">fixture</span>(scope=<span class="c-str">"function"</span>)   <span class="c-comment"># default — на каждый тест</span>
<span class="c-key">@pytest</span>.<span class="c-fn">fixture</span>(scope=<span class="c-str">"module"</span>)     <span class="c-comment"># один раз на модуль</span>
<span class="c-key">@pytest</span>.<span class="c-fn">fixture</span>(scope=<span class="c-str">"session"</span>)    <span class="c-comment"># один раз на всю сессию</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="repeat"></i> Параметризация</div>
<pre><code><span class="c-key">@pytest</span>.<span class="c-fn">mark</span>.<span class="c-fn">parametrize</span>(<span class="c-str">"a, b, expected"</span>, [
    (<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">3</span>),
    (<span class="c-num">0</span>, <span class="c-num">0</span>, <span class="c-num">0</span>),
    (-<span class="c-num">1</span>, <span class="c-num">1</span>, <span class="c-num">0</span>),
    (<span class="c-num">100</span>, <span class="c-num">200</span>, <span class="c-num">300</span>),
])
<span class="c-key">def</span> <span class="c-fn">test_add</span>(a, b, expected):
    <span class="c-key">assert</span> <span class="c-fn">add</span>(a, b) == expected

<span class="c-comment"># Запустится 4 раза, каждый — отдельный тест в отчёте</span>

<span class="c-comment"># С id для читаемых имён</span>
<span class="c-key">@pytest</span>.<span class="c-fn">mark</span>.<span class="c-fn">parametrize</span>(<span class="c-str">"email, valid"</span>, [
    (<span class="c-str">"a@b.c"</span>, <span class="c-key">True</span>),
    (<span class="c-str">"nope"</span>, <span class="c-key">False</span>),
    (<span class="c-str">""</span>, <span class="c-key">False</span>),
], ids=[<span class="c-str">"valid"</span>, <span class="c-str">"no-at"</span>, <span class="c-str">"empty"</span>])
<span class="c-key">def</span> <span class="c-fn">test_email</span>(email, valid):
    <span class="c-key">assert</span> <span class="c-fn">is_valid_email</span>(email) == valid</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="tag"></i> Mocking через <code>unittest.mock</code></div>
<pre><code><span class="c-key">from</span> unittest.mock <span class="c-key">import</span> Mock, MagicMock, patch

<span class="c-comment"># Простой mock</span>
mock = <span class="c-fn">Mock</span>()
mock.<span class="c-fn">some_method</span>.return_value = <span class="c-str">"hello"</span>
mock.<span class="c-fn">some_method</span>()                <span class="c-comment"># "hello"</span>
mock.<span class="c-fn">some_method</span>.<span class="c-fn">assert_called_once_with</span>()

<span class="c-comment"># patch — подменить объект в модуле</span>
<span class="c-key">@patch</span>(<span class="c-str">"src.services.email.send"</span>)
<span class="c-key">def</span> <span class="c-fn">test_register</span>(mock_send):
    mock_send.return_value = <span class="c-key">True</span>
    <span class="c-fn">register_user</span>(<span class="c-str">"Alice"</span>)
    mock_send.<span class="c-fn">assert_called_once</span>()

<span class="c-comment"># patch как context manager</span>
<span class="c-key">def</span> <span class="c-fn">test_register_ctx</span>():
    <span class="c-key">with</span> <span class="c-fn">patch</span>(<span class="c-str">"src.services.email.send"</span>) <span class="c-key">as</span> mock_send:
        <span class="c-fn">register_user</span>(<span class="c-str">"Alice"</span>)
        mock_send.<span class="c-fn">assert_called_once</span>()</code></pre>

    <div class="pitfall"><strong>⚠ Патчить надо там где ИСПОЛЬЗУЕТСЯ, не где ОБЪЯВЛЕНО.</strong> <code>register_user</code> внутри делает <code>from src.email import send; send(...)</code> — <code>@patch("src.email.send")</code> НЕ сработает. Патчи <code>@patch("src.users.send")</code> — там где импортировано.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Async-тесты и FastAPI</div>
<pre><code>uv add --dev pytest-asyncio httpx

<span class="c-comment"># tests/test_api.py</span>
<span class="c-key">import</span> pytest
<span class="c-key">from</span> httpx <span class="c-key">import</span> AsyncClient
<span class="c-key">from</span> main <span class="c-key">import</span> app

<span class="c-key">@pytest</span>.<span class="c-fn">mark</span>.<span class="c-fn">asyncio</span>
<span class="c-key">async def</span> <span class="c-fn">test_create_user</span>():
    <span class="c-key">async with</span> <span class="c-fn">AsyncClient</span>(app=app, base_url=<span class="c-str">"http://test"</span>) <span class="c-key">as</span> client:
        r = <span class="c-key">await</span> client.<span class="c-fn">post</span>(<span class="c-str">"/users"</span>, json={<span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>, <span class="c-str">"email"</span>: <span class="c-str">"a@b.c"</span>})
        <span class="c-key">assert</span> r.status_code == <span class="c-num">201</span>
        <span class="c-key">assert</span> r.<span class="c-fn">json</span>()[<span class="c-str">"name"</span>] == <span class="c-str">"Alice"</span></code></pre>

    <p class="text">В <code>pyproject.toml</code>:</p>
<pre><code>[tool.pytest.ini_options]
asyncio_mode = <span class="c-str">"auto"</span>              <span class="c-comment"># тогда @mark.asyncio не нужен</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="percent"></i> Coverage</div>
<pre><code>uv run pytest --cov=src --cov-report=term-missing
<span class="c-comment"># покажет процент покрытия + строки без тестов</span>

uv run pytest --cov=src --cov-report=html
<span class="c-comment"># сгенерит htmlcov/ с интерактивным HTML-отчётом</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>test_</code> префикс обязателен.</strong> pytest автоматически находит функции <code>test_*</code>. Опечатался в <code>tests_*</code> — тест не запустится.</div>
    <div class="pitfall"><strong>2. Fixture без параметра — не вызовется.</strong> <code>def test_x():</code> без параметра <code>sample_user</code> — fixture не будет использована.</div>
    <div class="pitfall"><strong>3. Тесты должны быть независимы.</strong> Один тест не должен полагаться на состояние от другого. Fixtures с правильным scope сбрасывают состояние.</div>
    <div class="pitfall"><strong>4. Не тестировать реальные внешние API.</strong> Медленно, flaky. Мокируй через <code>respx</code> для HTTP, <code>@patch</code> для остального.</div>
    <div class="pitfall"><strong>5. <code>tmp_path</code> fixture</strong> — встроенная в pytest, даёт временную директорию, автоматически чистится. Не создавай файлы в <code>/tmp</code> руками.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> pytest — простой синтаксис, мощные fixtures. Файлы <code>test_*.py</code>, функции <code>test_*</code>, обычный <code>assert</code>. <code>@parametrize</code> для табличных тестов. <code>@patch</code>/<code>respx</code> для моков. Плюс <code>pytest-cov</code> для покрытия.
  </div>
</div>

<div id="sec-logging" class="section">
  <div class="section-title">Логирование — модуль <code>logging</code></div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Забудь про <code>print()</code> в проде</div>
    <p class="text"><code>print()</code> ходит в stdout без метаданных (когда? что за модуль? какой уровень?). В проде — обязательно <code>logging</code>: уровни, timestamps, форматирование, разные handlers (файл + консоль + Sentry), config без правки кода.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Базовое использование</div>
<pre><code><span class="c-key">import</span> logging

logger = logging.<span class="c-fn">getLogger</span>(__name__)      <span class="c-comment"># имя = имя модуля</span>

logger.<span class="c-fn">debug</span>(<span class="c-str">"detailed info"</span>)                   <span class="c-comment"># 10 — только для разработки</span>
logger.<span class="c-fn">info</span>(<span class="c-str">"user created"</span>)                    <span class="c-comment"># 20 — обычные события</span>
logger.<span class="c-fn">warning</span>(<span class="c-str">"deprecated call"</span>)              <span class="c-comment"># 30 — стоит обратить внимание</span>
logger.<span class="c-fn">error</span>(<span class="c-str">"failed to save"</span>)                 <span class="c-comment"># 40 — операция провалилась</span>
logger.<span class="c-fn">critical</span>(<span class="c-str">"db down"</span>)                    <span class="c-comment"># 50 — сервис умирает</span>

<span class="c-comment"># Форматирование через параметры (не f-string!)</span>
logger.<span class="c-fn">info</span>(<span class="c-str">"user %s created with id %d"</span>, name, user_id)

<span class="c-comment"># Исключение — с traceback</span>
<span class="c-key">try</span>:
    <span class="c-fn">something</span>()
<span class="c-key">except</span> <span class="c-type">Exception</span>:
    logger.<span class="c-fn">exception</span>(<span class="c-str">"unexpected"</span>)     <span class="c-comment"># == error() + traceback</span></code></pre>

    <div class="pitfall"><strong>⚠ Не используй f-string в логах.</strong> <code>logger.info(f"user {name}")</code> сформирует строку ВСЕГДА, даже если этот уровень отключён. <code>logger.info("user %s", name)</code> — форматирование только когда handler решил залогировать. На горячем пути экономия времени.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="settings"></i> Настройка через <code>dictConfig</code></div>
<pre><code><span class="c-key">import</span> logging.config

LOGGING = {
    <span class="c-str">"version"</span>: <span class="c-num">1</span>,
    <span class="c-str">"disable_existing_loggers"</span>: <span class="c-key">False</span>,
    <span class="c-str">"formatters"</span>: {
        <span class="c-str">"standard"</span>: {
            <span class="c-str">"format"</span>: <span class="c-str">"%(asctime)s [%(levelname)s] %(name)s: %(message)s"</span>,
        },
        <span class="c-str">"json"</span>: {
            <span class="c-str">"()"</span>: <span class="c-str">"pythonjsonlogger.jsonlogger.JsonFormatter"</span>,
            <span class="c-str">"format"</span>: <span class="c-str">"%(asctime)s %(levelname)s %(name)s %(message)s"</span>,
        },
    },
    <span class="c-str">"handlers"</span>: {
        <span class="c-str">"console"</span>: {
            <span class="c-str">"class"</span>: <span class="c-str">"logging.StreamHandler"</span>,
            <span class="c-str">"formatter"</span>: <span class="c-str">"standard"</span>,
            <span class="c-str">"level"</span>: <span class="c-str">"INFO"</span>,
        },
        <span class="c-str">"file"</span>: {
            <span class="c-str">"class"</span>: <span class="c-str">"logging.handlers.RotatingFileHandler"</span>,
            <span class="c-str">"filename"</span>: <span class="c-str">"/var/log/app.log"</span>,
            <span class="c-str">"maxBytes"</span>: <span class="c-num">10</span> * <span class="c-num">1024</span> * <span class="c-num">1024</span>,   <span class="c-comment"># 10 MB</span>
            <span class="c-str">"backupCount"</span>: <span class="c-num">5</span>,                    <span class="c-comment"># хранить 5 файлов</span>
            <span class="c-str">"formatter"</span>: <span class="c-str">"json"</span>,
            <span class="c-str">"level"</span>: <span class="c-str">"WARNING"</span>,
        },
    },
    <span class="c-str">"loggers"</span>: {
        <span class="c-str">""</span>: {                                <span class="c-comment"># root logger</span>
            <span class="c-str">"handlers"</span>: [<span class="c-str">"console"</span>, <span class="c-str">"file"</span>],
            <span class="c-str">"level"</span>: <span class="c-str">"INFO"</span>,
        },
        <span class="c-str">"myapp.db"</span>: {                        <span class="c-comment"># специфичный логгер</span>
            <span class="c-str">"level"</span>: <span class="c-str">"DEBUG"</span>,
        },
    },
}

logging.config.<span class="c-fn">dictConfig</span>(LOGGING)</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="braces"></i> Структурированные логи (JSON)</div>
    <p class="text">Для сборки в ELK / Loki / Datadog — логи в JSON. Каждая строка — валидный JSON, поля удобно фильтровать.</p>
<pre><code>uv add python-json-logger

<span class="c-comment"># Уже настроен в LOGGING выше (formatters.json)</span>
<span class="c-comment"># Дополнительные поля — через extra:</span>
logger.<span class="c-fn">info</span>(<span class="c-str">"user created"</span>, extra={<span class="c-str">"user_id"</span>: <span class="c-num">42</span>, <span class="c-str">"ip"</span>: <span class="c-str">"1.1.1.1"</span>})
<span class="c-comment"># {"asctime": "...", "levelname": "INFO", "name": "myapp", </span>
<span class="c-comment">#  "message": "user created", "user_id": 42, "ip": "1.1.1.1"}</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="palette"></i> Красивый вывод для разработки — <code>rich</code></div>
<pre><code>uv add rich

<span class="c-key">from</span> rich.logging <span class="c-key">import</span> RichHandler

logging.<span class="c-fn">basicConfig</span>(
    level=<span class="c-str">"INFO"</span>,
    format=<span class="c-str">"%(message)s"</span>,
    handlers=[<span class="c-fn">RichHandler</span>()],
)
<span class="c-comment"># В консоли — цветные уровни, красивые traceback, таблицы для extra полей</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>logger = logging.getLogger(__name__)</code></strong> — во ВСЕХ модулях. Так каждый модуль пишет со своим именем, и можно фильтровать в конфиге <code>myapp.users.service</code>.</div>
    <div class="pitfall"><strong>2. Не логгировать secrets.</strong> Пароли, токены, номера карт — никогда в логи. Middleware / фильтр должен вырезать.</div>
    <div class="pitfall"><strong>3. Не крутить <code>logger.debug()</code> на горячем пути.</strong> Даже если DEBUG отключён — Python вычислит аргументы. Оборачивай в <code>if logger.isEnabledFor(logging.DEBUG):</code>.</div>
    <div class="pitfall"><strong>4. <code>RotatingFileHandler</code> и Docker.</strong> В контейнерах пиши в stdout/stderr — Docker/K8s сами соберут. Файлы = нет reproducibility.</div>
    <div class="pitfall"><strong>5. FastAPI/Django — свой logger.</strong> Uvicorn пишет свой access-log, Django свой. Настраивай их отдельно, не переопределяй root грубо.</div>
  </div>
</div>

<div id="sec-tools" class="section">
  <div class="section-title">ruff / black / mypy — инструменты качества</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="rocket"></i> Стандартный tooling 2026</div>
    <table class="data-table">
      <tr><th>Инструмент</th><th>Роль</th></tr>
      <tr><td><code>ruff</code></td><td>Линтер + форматтер. На Rust, 10-100× быстрее flake8. К 2026 <strong>заменил</strong> flake8, isort, pylint, pyupgrade.</td></tr>
      <tr><td><code>mypy</code></td><td>Статический тайп-чекер. Проверяет type hints, находит ошибки до runtime.</td></tr>
      <tr><td><code>black</code></td><td>Автоформатирование «no options». Стандарт много лет — но ruff format его вытесняет (совместимый).</td></tr>
      <tr><td><code>pre-commit</code></td><td>Хуки для запуска ruff/mypy/black перед git commit.</td></tr>
    </table>
    <p class="text"><strong>Мнемоника:</strong> <code>ruff</code> — стилистика + мелкие баги; <code>mypy</code> — типы; <code>black</code>/<code>ruff format</code> — форматирование.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Ruff — линтер + форматтер</div>
<pre><code>uv add --dev ruff

<span class="c-comment"># Линт</span>
uv run ruff check src/
uv run ruff check src/ --fix          <span class="c-comment"># автофиксы</span>

<span class="c-comment"># Форматирование (замена black)</span>
uv run ruff format src/

<span class="c-comment"># Конфиг — pyproject.toml</span>
[tool.ruff]
line-length = <span class="c-num">100</span>
target-version = <span class="c-str">"py313"</span>
extend-exclude = [<span class="c-str">"migrations"</span>]

[tool.ruff.lint]
select = [
    <span class="c-str">"E"</span>,      <span class="c-comment"># pycodestyle errors</span>
    <span class="c-str">"F"</span>,      <span class="c-comment"># pyflakes</span>
    <span class="c-str">"I"</span>,      <span class="c-comment"># isort — сортировка импортов</span>
    <span class="c-str">"UP"</span>,     <span class="c-comment"># pyupgrade — новый синтаксис</span>
    <span class="c-str">"B"</span>,      <span class="c-comment"># bugbear — типовые баги</span>
    <span class="c-str">"SIM"</span>,    <span class="c-comment"># simplify</span>
    <span class="c-str">"N"</span>,      <span class="c-comment"># PEP 8 naming</span>
]
ignore = [<span class="c-str">"E501"</span>]                <span class="c-comment"># line too long — ruff format сам разрулит</span>

[tool.ruff.lint.per-file-ignores]
<span class="c-str">"tests/*"</span> = [<span class="c-str">"S101"</span>]           <span class="c-comment"># asserts разрешены в тестах</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-check"></i> mypy — статические типы</div>
<pre><code>uv add --dev mypy

uv run mypy src/                       <span class="c-comment"># проверить</span>

<span class="c-comment"># Конфиг — pyproject.toml</span>
[tool.mypy]
python_version = <span class="c-str">"3.13"</span>
strict = <span class="c-key">true</span>                        <span class="c-comment"># включает все проверки</span>
warn_unused_ignores = <span class="c-key">true</span>
warn_return_any = <span class="c-key">true</span>

<span class="c-comment"># Для сторонних библиотек без стабов</span>
[[tool.mypy.overrides]]
module = [<span class="c-str">"legacy_lib.*"</span>, <span class="c-str">"untyped_pkg.*"</span>]
ignore_missing_imports = <span class="c-key">true</span></code></pre>
    <p class="text">На существующем проекте <code>strict = true</code> сразу — больно. Включай постепенно: сначала для новых модулей через <code>per-module</code> overrides, потом расширяй.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-branch"></i> pre-commit — автоматизация</div>
<pre><code>uv add --dev pre-commit

<span class="c-comment"># .pre-commit-config.yaml</span>
repos:
  - repo: https://github.com/astral-sh/ruff-pre-commit
    rev: v0.6.0
    hooks:
      - id: ruff
        args: [--fix]
      - id: ruff-format

  - repo: https://github.com/pre-commit/mirrors-mypy
    rev: v1.10.0
    hooks:
      - id: mypy

<span class="c-comment"># Установить хуки</span>
uv run pre-commit install

<span class="c-comment"># Теперь при каждом `git commit` — прогонятся автоматом</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cog"></i> В CI (GitHub Actions)</div>
<pre><code><span class="c-comment"># .github/workflows/lint.yml</span>
name: lint
on: [push, pull_request]

jobs:
  lint:
    runs-on: ubuntu-latest
    steps:
      - <span class="c-fn">uses</span>: actions/checkout@v4
      - <span class="c-fn">uses</span>: astral-sh/setup-uv@v3
      - <span class="c-fn">run</span>: uv sync --dev
      - <span class="c-fn">run</span>: uv run ruff check src/
      - <span class="c-fn">run</span>: uv run ruff format --check src/
      - <span class="c-fn">run</span>: uv run mypy src/
      - <span class="c-fn">run</span>: uv run pytest --cov</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Не конфликтуют ли ruff и black?</strong> Нет — <code>ruff format</code> написан как замена black с той же логикой. Держи одно (лучше ruff).</div>
    <div class="pitfall"><strong>2. mypy strict на legacy проекте — фиаско.</strong> Могут выпасть тысячи ошибок за час. Включай постепенно, файл за файлом.</div>
    <div class="pitfall"><strong>3. Игнорировать надо явно.</strong> <code># noqa: E501</code> для ruff, <code># type: ignore[assignment]</code> для mypy. Всегда указывай КОД ошибки, не голое <code>noqa</code> — иначе спрячешь новые баги.</div>
    <div class="pitfall"><strong>4. <code>ruff --fix</code> — автозамены.</strong> Просмотри diff перед commit — иногда меняет семантику (например, <code>UP</code>-правила модернизирующие синтаксис).</div>
    <div class="pitfall"><strong>5. IDE интеграция.</strong> VS Code — расширения Ruff и Pylance. PyCharm — встроено. Настрой format-on-save.</div>
  </div>

  <div class="remember-box">
    <strong>Итог:</strong> для нового проекта — <code>ruff</code> + <code>mypy</code> + <code>pre-commit</code> в <code>pyproject.toml</code>. В CI — те же три команды. Всё быстро (ruff на Rust), настройка в одном файле, стандарт индустрии 2026.
  </div>
</div>

<div id="sec-interview" class="section">
  <div class="section-title">FAQ на собеседовании — Python для backend</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="brain"></i> Топ-25 вопросов на middle/senior Python-backend</div>
    <div class="card">
      <h3>1. Что такое GIL?</h3>
      <p class="text">Global Interpreter Lock — mutex в CPython, разрешающий выполнять Python-bytecode только одному потоку в один момент. Из-за него <code>threading</code> не даёт истинного параллелизма для CPU-bound задач (для этого — <code>multiprocessing</code>). Для I/O-bound работает (поток отпускает GIL на I/O). В Python 3.13 экспериментально можно собирать без GIL, но production ещё далеко.</p>
    </div>
    <div class="card">
      <h3>2. Mutable vs immutable — почему важно</h3>
      <p class="text">Immutable: <code>int</code>, <code>float</code>, <code>str</code>, <code>tuple</code>, <code>bool</code>, <code>None</code>, <code>frozenset</code>. Mutable: <code>list</code>, <code>dict</code>, <code>set</code>. Immutable — можно использовать как ключи в dict/set (потому что есть <code>__hash__</code>). Mutable default arg в функции — <em>классический баг</em> (создаётся ОДИН раз при определении, разделяется между вызовами).</p>
    </div>
    <div class="card">
      <h3>3. <code>list</code> vs <code>tuple</code></h3>
      <p class="text">Tuple неизменяем, немного быстрее, может быть ключом dict. Семантически — «фиксированный набор» (координаты, RGB). List — «однородная коллекция, длина меняется» (список пользователей).</p>
    </div>
    <div class="card">
      <h3>4. <code>==</code> vs <code>is</code></h3>
      <p class="text"><code>==</code> — сравнение значений (<code>__eq__</code>). <code>is</code> — сравнение идентичности (<em>тот же объект в памяти</em>). Для None — только <code>x is None</code>. Small int'ы (-5..256) и короткие строки кешируются, поэтому <code>a = 5; b = 5; a is b</code> — <code>True</code>, но это implementation detail.</p>
    </div>
    <div class="card">
      <h3>5. <code>*args</code> и <code>**kwargs</code></h3>
      <p class="text">Переменное число аргументов. <code>*args</code> — tuple позиционных, <code>**kwargs</code> — dict именованных. Также используются для «прозрачного прокси»: <code>def wrapper(*a, **kw): return func(*a, **kw)</code>.</p>
    </div>
    <div class="card">
      <h3>6. Что такое декоратор</h3>
      <p class="text">Функция, оборачивающая другую функцию. <code>@decorator</code> — сахар над <code>func = decorator(func)</code>. Внутри своего декоратора обязательно <code>@functools.wraps(func)</code> — сохраняет метаданные оригинала. Используется для сквозных обязанностей: логирование, retry, кеш, auth.</p>
    </div>
    <div class="card">
      <h3>7. Генератор vs list — когда что</h3>
      <p class="text">Генератор ленивый — не хранит все элементы в памяти. Для миллионных потоков (лог-файлы, БД-выборки) — генератор. Для повторного обхода / индексации / <code>len()</code> — list. <code>yield</code> в функции превращает её в генератор.</p>
    </div>
    <div class="card">
      <h3>8. Замыкания (closures) и late binding</h3>
      <p class="text">Внутренняя функция запоминает переменные внешней. Late binding: <code>[lambda: i for i in range(3)]</code> — все lambda ссылаются на ОДНУ <code>i</code>, к моменту вызова = 2. Фикс: <code>lambda i=i: i</code> (захват через default).</p>
    </div>
    <div class="card">
      <h3>9. <code>__init__</code> vs <code>__new__</code></h3>
      <p class="text"><code>__new__</code> — создаёт объект (возвращает instance). <code>__init__</code> — инициализирует уже созданный. 95% времени пишешь только <code>__init__</code>. <code>__new__</code> нужен для immutable-типов (наследники <code>str</code>/<code>tuple</code>) и метаклассов.</p>
    </div>
    <div class="card">
      <h3>10. MRO и множественное наследование</h3>
      <p class="text">Method Resolution Order — порядок, в котором Python ищет метод в родителях. Алгоритм <strong>C3 linearization</strong>. Проверить: <code>ClassName.__mro__</code>. При diamond inheritance (D наследует B и C, обе наследуют A) — MRO гарантирует, что A встретится один раз.</p>
    </div>
    <div class="card">
      <h3>11. asyncio vs threading vs multiprocessing</h3>
      <p class="text"><strong>asyncio</strong> — concurrent I/O в одном потоке, тысячи «задач» без overhead. <strong>threading</strong> — I/O-bound + legacy, GIL мешает CPU. <strong>multiprocessing</strong> — отдельные процессы, обходит GIL, для CPU-heavy (обработка изображений, ML-inference).</p>
    </div>
    <div class="card">
      <h3>12. <code>@classmethod</code> vs <code>@staticmethod</code></h3>
      <p class="text"><code>@classmethod</code> — первый аргумент <code>cls</code>, знает свой класс. Используется для альтернативных конструкторов (<code>User.from_dict(...)</code>). <code>@staticmethod</code> — обычная функция в namespace класса, ни <code>self</code>, ни <code>cls</code>.</p>
    </div>
    <div class="card">
      <h3>13. <code>@property</code></h3>
      <p class="text">Метод, вызываемый как атрибут. Позволяет добавить валидацию/вычисление без изменения интерфейса. Питонический подход: начинай с публичного атрибута, при необходимости — превращай в property.</p>
    </div>
    <div class="card">
      <h3>14. <code>dataclass</code> vs <code>namedtuple</code> vs <code>Pydantic</code></h3>
      <p class="text"><strong>dataclass</strong> — стандартный способ создать DTO с <code>__init__</code>/<code>__eq__</code>/<code>__repr__</code>. <strong>namedtuple</strong> — легковесный immutable, доступ по атрибуту и по индексу. <strong>Pydantic</strong> — тот же dataclass + <em>валидация в runtime</em>, конвертация типов, JSON serialization. Для внешних данных (API-вход) — Pydantic.</p>
    </div>
    <div class="card">
      <h3>15. Type hints — enforcement?</h3>
      <p class="text">Нет. Python <em>не проверяет</em> их в runtime — только подсказки. Проверяет отдельный tool (<code>mypy</code>). В runtime валидацию делает Pydantic (использует те же аннотации).</p>
    </div>
    <div class="card">
      <h3>16. Оптимизация N+1 в SQLAlchemy / Django</h3>
      <p class="text">SQLAlchemy: <code>selectinload</code> (2 запроса через IN) / <code>joinedload</code> (JOIN одним запросом). Django: <code>prefetch_related</code> / <code>select_related</code>. Правило: <code>selectinload</code>/<code>prefetch_related</code> для 1-N, <code>joinedload</code>/<code>select_related</code> для N-1 (FK).</p>
    </div>
    <div class="card">
      <h3>17. EAFP vs LBYL</h3>
      <p class="text">Easier to Ask Forgiveness than Permission — попробуй, поймай исключение. Look Before You Leap — проверь условие ДО. Питонично — EAFP. Пример: <code>try: v = d[k] except KeyError: ...</code> вместо <code>if k in d: v = d[k]</code>. Но <code>d.get(k)</code> ещё лучше.</p>
    </div>
    <div class="card">
      <h3>18. Context manager — <code>with</code></h3>
      <p class="text">Гарантированное освобождение ресурсов через <code>__enter__</code>/<code>__exit__</code>. Свой — либо класс с этими методами, либо декоратор <code>@contextmanager</code> над функцией с <code>yield</code>.</p>
    </div>
    <div class="card">
      <h3>19. <code>venv</code> зачем — если можно ставить пакеты глобально</h3>
      <p class="text">Разные проекты требуют разных версий одних и тех же библиотек. venv — изолированный интерпретатор со своим <code>site-packages/</code>. С 2024 Ubuntu 24.04 глобально ставить <em>вообще запрещено</em> (PEP 668). В 2026 — стандарт <code>uv</code>.</p>
    </div>
    <div class="card">
      <h3>20. FastAPI vs Django — когда что</h3>
      <p class="text">Django — сайт с админкой, batteries included. FastAPI — REST API / микросервис / AI-backend, async first, автогенерация OpenAPI. Flask — legacy или мини-скрипт. Гибрид тоже норма: Django для сайта + FastAPI для новых API.</p>
    </div>
    <div class="card">
      <h3>21. Duck typing и Protocol</h3>
      <p class="text">«Если крякает как утка — то утка». Не проверяется <code>isinstance</code>, работает если у объекта есть нужные методы. <code>typing.Protocol</code> — «структурный интерфейс», проверяемый статически (mypy) без наследования.</p>
    </div>
    <div class="card">
      <h3>22. Как сериализовать datetime в JSON</h3>
      <p class="text"><code>json.dumps({"created": datetime.now()})</code> кинет <code>TypeError</code>. Решения: <code>default=str</code> в <code>dumps</code>, или предварительно <code>.isoformat()</code>, или использовать Pydantic (сам сериализует).</p>
    </div>
    <div class="card">
      <h3>23. Разница между <code>Exception</code> и <code>BaseException</code></h3>
      <p class="text"><code>BaseException</code> — корень всей иерархии, содержит <code>KeyboardInterrupt</code> и <code>SystemExit</code>. <code>Exception</code> — базовый для обычных ошибок. <strong>Никогда не ловить <code>BaseException</code></strong> — заблокируешь Ctrl+C.</p>
    </div>
    <div class="card">
      <h3>24. Что такое <code>__slots__</code></h3>
      <p class="text">Класс-атрибут, ограничивающий разрешённые instance-атрибуты. Экономит память (нет <code>__dict__</code>), быстрее доступ. Полезно для классов с миллионами инстансов. Ломает multiple inheritance и dynamic attributes. В <code>@dataclass(slots=True)</code> — из коробки.</p>
    </div>
    <div class="card">
      <h3>25. WSGI vs ASGI</h3>
      <p class="text">WSGI (2003) — sync-интерфейс для веб-серверов (Flask, Django до 3.0). ASGI (2018) — async-версия (FastAPI, Django 3+). ASGI умеет WebSocket, long-polling, HTTP/2. Uvicorn — популярный ASGI-сервер, gunicorn+uvicorn workers — производственная связка.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="lightbulb"></i> Общие советы на собес</div>
    <ul class="bullets">
      <li>«Как проверить» → всегда пишу тест на pytest, для API — <code>httpx.AsyncClient(app=app)</code>.</li>
      <li>«Как деплоить» → Docker с multi-stage build; runtime — Python slim, зависимости через uv.</li>
      <li>«Где хранить конфиг» → <code>pydantic-settings</code>: типизированный класс, читает <code>.env</code> и env-переменные.</li>
      <li>«Как логировать» → <code>logging.getLogger(__name__)</code>, JSON-formatter для сбора в ELK/Loki.</li>
      <li>«Что улучшить в существующем коде» → type hints, ruff+mypy, замена <code>requests</code>→<code>httpx</code>, sync-код блокирующий event loop.</li>
    </ul>
  </div>

  <div class="remember-box">
    <strong>Финальный итог по KB_19:</strong> для PHP-разработчика Python — за 2-4 недели становится продуктивным. Стек 2026: <code>uv</code> + <code>ruff</code> + <code>mypy</code> + <code>FastAPI</code> + <code>SQLAlchemy 2 async</code> + <code>Pydantic</code> + <code>pytest</code> + <code>httpx</code> + <code>Docker</code>. Django — если нужен сайт с админкой. AI/ML — отдельная тропа (PyTorch, LangChain, Anthropic SDK).
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
