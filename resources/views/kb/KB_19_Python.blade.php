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
  <a class="nav-item" onclick="showSection('pandas',this)"><i data-lucide="table"></i> Pandas базово</a>

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
  <div class="section-title">Строки + f-strings</div>
  <div class="stub"><strong>В разработке.</strong> f-strings (Python 3.6+), <code>.format()</code>, <code>%</code>-форматирование, методы str (upper/lower/split/join/strip/replace), regex через <code>re</code>, encoding UTF-8, bytes vs str.</div>
</div>

<div id="sec-control" class="section">
  <div class="section-title">Условия + циклы</div>
  <div class="stub"><strong>В разработке.</strong> <code>if/elif/else</code>, тернарник <code>x if cond else y</code>, <code>for x in iterable</code>, <code>range()</code>, <code>enumerate()</code>, <code>zip()</code>, <code>while</code>, <code>break/continue</code>, <code>else</code> в цикле (сработает если <code>break</code> не было), <code>match/case</code> (Python 3.10+).</div>
</div>

<div id="sec-functions" class="section">
  <div class="section-title">Функции + lambda</div>
  <div class="stub"><strong>В разработке.</strong> <code>def</code>, позиционные vs keyword аргументы, <code>*args</code> / <code>**kwargs</code>, default values, <code>lambda</code>, closures, аннотации типов, docstrings, чистые функции vs с side-effects.</div>
</div>

<div id="sec-collections" class="section">
  <div class="section-title">list / dict / set comprehensions</div>
  <div class="stub"><strong>В разработке.</strong> Питоничный способ трансформации коллекций: <code>[x*2 for x in nums]</code>, <code>[x for x in nums if x &gt; 0]</code>, <code>{k: v.upper() for k, v in d.items()}</code>, <code>{x for x in nums}</code>, вложенные comprehensions, generator expressions <code>(x*2 for x in nums)</code>.</div>
</div>

<div id="sec-oop" class="section">
  <div class="section-title">ООП + классы + dunder-методы</div>
  <div class="stub"><strong>В разработке.</strong> <code>class</code>, <code>__init__</code> (конструктор), <code>self</code>, атрибуты instance vs class, наследование, <code>super()</code>, множественное наследование + MRO, <code>@property</code>, <code>@staticmethod</code>, <code>@classmethod</code>, dunder-методы (<code>__str__</code>, <code>__eq__</code>, <code>__hash__</code>, <code>__len__</code>, <code>__iter__</code>), <code>@dataclass</code>.</div>
</div>

<div id="sec-modules" class="section">
  <div class="section-title">Модули + импорты</div>
  <div class="stub"><strong>В разработке.</strong> <code>import module</code> vs <code>from module import x</code>, aliasing <code>as</code>, пакеты и <code>__init__.py</code>, <code>__name__ == "__main__"</code>, относительные импорты, <code>sys.path</code>, circular imports (и как избежать).</div>
</div>

<div id="sec-venv" class="section">
  <div class="section-title">Виртуальные окружения — venv, pip, poetry, uv</div>
  <div class="stub"><strong>В разработке.</strong> Зачем venv (изоляция зависимостей), <code>python -m venv .venv</code>, активация, <code>requirements.txt</code>, современные альтернативы: <code>poetry</code> (pyproject.toml + lock), <code>pipenv</code>, <code>uv</code> (10-100x быстрее). Сравнительная таблица + рекомендации.</div>
</div>

<div id="sec-exceptions" class="section">
  <div class="section-title">Исключения — try / except / finally / raise</div>
  <div class="stub"><strong>В разработке.</strong> Иерархия <code>Exception</code>, <code>try/except/else/finally</code>, множественные <code>except</code>, кастомные исключения, <code>raise ... from e</code> (chaining), context managers <code>with</code>, EAFP vs LBYL стиль.</div>
</div>

<div id="sec-files" class="section">
  <div class="section-title">Работа с файлами + JSON + CSV</div>
  <div class="stub"><strong>В разработке.</strong> <code>open()</code> и <code>with</code>, режимы <code>r/w/a/rb/wb</code>, encoding, <code>json.load/dump</code>, <code>csv.reader/writer</code>, <code>pathlib.Path</code> (современный способ работы с путями), stream vs read all.</div>
</div>

<div id="sec-decorators" class="section">
  <div class="section-title">Декораторы <code>@</code></div>
  <div class="stub"><strong>В разработке.</strong> Функция как first-class объект, простой декоратор, <code>@functools.wraps</code>, декораторы с аргументами, декораторы классов, встроенные (<code>@property</code>, <code>@staticmethod</code>, <code>@classmethod</code>, <code>@dataclass</code>, <code>@cache</code>). Пример: логирование, retry, кеш.</div>
</div>

<div id="sec-typing" class="section">
  <div class="section-title">Type hints + mypy</div>
  <div class="stub"><strong>В разработке.</strong> Синтаксис аннотаций, <code>Optional[X]</code> / <code>X | None</code> (3.10+), <code>Union[X, Y]</code> / <code>X | Y</code>, <code>List</code>/<code>Dict</code>/<code>Tuple</code> (legacy) vs <code>list</code>/<code>dict</code> (3.9+), <code>TypedDict</code>, <code>Protocol</code> (structural typing), <code>Literal</code>, <code>Final</code>. Настройка mypy, pytest-mypy, интеграция с IDE.</div>
</div>

<div id="sec-async" class="section">
  <div class="section-title">async / await + asyncio</div>
  <div class="stub"><strong>В разработке.</strong> Coroutines, event loop, <code>async def</code> и <code>await</code>, <code>asyncio.run</code>, <code>asyncio.gather</code> (параллельно), <code>asyncio.create_task</code>, aiohttp / httpx для HTTP, asyncpg / SQLAlchemy async. FastAPI как пример async-first фреймворка.</div>
</div>

<div id="sec-generators" class="section">
  <div class="section-title">Генераторы + iterators</div>
  <div class="stub"><strong>В разработке.</strong> Iterator protocol (<code>__iter__</code> + <code>__next__</code>), генератор через <code>yield</code>, generator expressions, ленивые вычисления (для больших файлов/потоков), <code>itertools</code> (chain, islice, cycle, groupby).</div>
</div>

<div id="sec-django" class="section">
  <div class="section-title">Django — обзор</div>
  <div class="stub"><strong>В разработке.</strong> Django как «Python Laravel»: batteries included (ORM, admin, auth, templates, migrations). <code>django-admin startproject</code>, структура apps, MVT-паттерн (Model-View-Template), Django ORM с примерами, миграции, Django REST Framework для API. Где Django лучше FastAPI (сайты с админкой) и хуже (микросервисы, real-time).</div>
</div>

<div id="sec-fastapi" class="section">
  <div class="section-title">FastAPI — обзор</div>
  <div class="stub"><strong>В разработке.</strong> Современный async-first фреймворк на type hints. Автогенерация OpenAPI и Swagger UI. <code>FastAPI()</code>, декораторы роутов, Pydantic-модели для валидации входа и сериализации выхода, Depends() для DI, async endpoints. Полный пример CRUD с PostgreSQL. Почему сейчас топ-1 для нового Python-backend.</div>
</div>

<div id="sec-flask" class="section">
  <div class="section-title">Flask — обзор</div>
  <div class="stub"><strong>В разработке.</strong> Микрофреймворк для маленьких сервисов и прототипов. <code>Flask(__name__)</code>, роуты, Jinja2 (аналог Blade), Flask-SQLAlchemy, Flask-Login. Где Flask ещё живёт: legacy, микро-скрипты, обучение основам WSGI. Для нового кода чаще выбирают FastAPI.</div>
</div>

<div id="sec-framework-compare" class="section">
  <div class="section-title">Django vs FastAPI vs Flask — что выбрать</div>
  <div class="stub"><strong>В разработке.</strong> Полная сравнительная таблица (батарейки, скорость, async, экосистема, кривая обучения). Выбор в зависимости от задачи: сайт с админкой → Django, HTTP-API/микросервис → FastAPI, микро-скрипт/легаси → Flask.</div>
</div>

<div id="sec-db" class="section">
  <div class="section-title">Работа с БД — psycopg2 / SQLAlchemy / Django ORM</div>
  <div class="stub"><strong>В разработке.</strong> Три уровня: <code>psycopg2</code> (сырые SQL для PostgreSQL, аналог PDO), SQLAlchemy (query builder + ORM, аналог Doctrine), Django ORM (тесная интеграция с Django). Async-варианты: <code>asyncpg</code>, SQLAlchemy 2.0 async. Alembic для миграций.</div>
</div>

<div id="sec-http" class="section">
  <div class="section-title">HTTP-клиенты — requests / httpx</div>
  <div class="stub"><strong>В разработке.</strong> <code>requests</code> — де-факто стандарт для sync (аналог Guzzle). <code>httpx</code> — современный, поддерживает и sync, и async, тот же API. Retry, timeout, session, авторизация, JSON и form-data, streaming большие ответы, mocking для тестов (<code>respx</code>).</div>
</div>

<div id="sec-pandas" class="section">
  <div class="section-title">Pandas — базово</div>
  <div class="stub"><strong>В разработке.</strong> DataFrame и Series, чтение CSV/Excel/JSON, фильтрация, groupby + агрегация, слияние (merge/join), обработка NaN. Практический минимум для backend-разработчика: конвертация форматов, разовые ETL-задачи, генерация отчётов.</div>
</div>

<div id="sec-testing" class="section">
  <div class="section-title">pytest + fixtures</div>
  <div class="stub"><strong>В разработке.</strong> Почему pytest, а не unittest. Простой тест — обычная функция <code>test_*</code>. Fixtures (аналог setUp), параметризация <code>@pytest.mark.parametrize</code>, mocking через <code>unittest.mock</code>, тестирование async, coverage через <code>pytest-cov</code>. Пример pytest на FastAPI-приложении.</div>
</div>

<div id="sec-logging" class="section">
  <div class="section-title">Логирование</div>
  <div class="stub"><strong>В разработке.</strong> Модуль <code>logging</code> из stdlib: loggers, handlers, formatters, levels. Настройка через <code>dictConfig</code>. Структурированные логи (JSON) через <code>python-json-logger</code>. Rich как красивый вывод в консоль для разработки. Сборка в ELK/Loki.</div>
</div>

<div id="sec-tools" class="section">
  <div class="section-title">ruff / black / mypy — инструменты качества</div>
  <div class="stub"><strong>В разработке.</strong> <code>black</code> — автоформатирование (без обсуждений). <code>ruff</code> — линтер + форматтер, супербыстрый (на Rust), в 2026 заменяет flake8/isort/pylint/pyupgrade. <code>mypy</code> — статический типизатор. Настройка в <code>pyproject.toml</code>, интеграция pre-commit hooks, GitHub Actions.</div>
</div>

<div id="sec-interview" class="section">
  <div class="section-title">FAQ на собеседовании (Python для backend)</div>
  <div class="stub"><strong>В разработке.</strong> Топ-30 вопросов: GIL, mutable vs immutable, разница dict/list/set, list vs tuple, декораторы, генераторы vs list, ==/is/is not, args/kwargs, closures + late binding, __init__ vs __new__, MRO при множественном наследовании, async vs threading vs multiprocessing, type hints и когда мешают, dataclass vs namedtuple vs Pydantic.</div>
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
