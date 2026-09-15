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
  <div class="section-title">list / dict / set comprehensions</div>
  <div class="stub"><strong>В разработке.</strong> Питоничный способ трансформации коллекций: <code>[x*2 for x in nums]</code>, <code>[x for x in nums if x &gt; 0]</code>, <code>{k: v.upper() for k, v in d.items()}</code>, <code>{x for x in nums}</code>, вложенные comprehensions, generator expressions <code>(x*2 for x in nums)</code>.</div>
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
  <div class="section-title">Работа с файлами + JSON + CSV</div>
  <div class="stub"><strong>В разработке.</strong> <code>open()</code> и <code>with</code>, режимы <code>r/w/a/rb/wb</code>, encoding, <code>json.load/dump</code>, <code>csv.reader/writer</code>, <code>pathlib.Path</code> (современный способ работы с путями), stream vs read all.</div>
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
  <div class="section-title">Генераторы + iterators</div>
  <div class="stub"><strong>В разработке.</strong> Iterator protocol (<code>__iter__</code> + <code>__next__</code>), генератор через <code>yield</code>, generator expressions, ленивые вычисления (для больших файлов/потоков), <code>itertools</code> (chain, islice, cycle, groupby).</div>
</div>

<div id="sec-django" class="section">
  <div class="section-title">Django — обзор</div>
  <div class="stub"><strong>В разработке.</strong> Django как «Python Laravel»: batteries included (ORM, admin, auth, templates, migrations). <code>django-admin startproject</code>, структура apps, MVT-паттерн (Model-View-Template), Django ORM с примерами, миграции, Django REST Framework для API. Где Django лучше FastAPI (сайты с админкой) и хуже (микросервисы, real-time).</div>
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
