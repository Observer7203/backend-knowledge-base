@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SQL и базы данных — продвинутый разбор</title>
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
  <div class="sidebar-title">SQL &amp; Database</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">Основы</div>
  <a class="nav-item" onclick="showSection('db-types',this)"><i data-lucide="database"></i> Типы БД: SQL / NoSQL / OLAP</a>
  <a class="nav-item" onclick="showSection('relational',this)"><i data-lucide="table-2"></i> Реляционная модель</a>
  <a class="nav-item" onclick="showSection('types',this)"><i data-lucide="braces"></i> Типы данных</a>
  <a class="nav-item" onclick="showSection('ddl',this)"><i data-lucide="file-plus"></i> DDL: CREATE/ALTER</a>
  <a class="nav-item" onclick="showSection('normalization',this)"><i data-lucide="git-commit-horizontal"></i> Нормализация</a>
  <a class="nav-item" onclick="showSection('joins',this)"><i data-lucide="git-merge"></i> JOIN-ы</a>

  <div class="nav-group-label">Производительность</div>
  <a class="nav-item" onclick="showSection('indexes',this)"><i data-lucide="search"></i> Индексы</a>
  <a class="nav-item" onclick="showSection('indexes-laravel',this)"><i data-lucide="hammer"></i> Индексы в Laravel</a>
  <a class="nav-item" onclick="showSection('explain',this)"><i data-lucide="file-search"></i> EXPLAIN</a>
  <a class="nav-item" onclick="showSection('subqueries',this)"><i data-lucide="brackets"></i> Subqueries: corr/uncorr</a>
  <a class="nav-item" onclick="showSection('nplus1',this)"><i data-lucide="alert-triangle"></i> N+1 и решения</a>

  <div class="nav-group-label">Транзакции</div>
  <a class="nav-item" onclick="showSection('acid',this)"><i data-lucide="shield-check"></i> ACID и изоляция</a>
  <a class="nav-item" onclick="showSection('engines',this)"><i data-lucide="cpu"></i> Engines и InnoDB</a>
  <a class="nav-item" onclick="showSection('locking',this)"><i data-lucide="lock"></i> Блокировки и MVCC</a>

  <div class="nav-group-label">Продвинуто</div>
  <a class="nav-item" onclick="showSection('window',this)"><i data-lucide="rows-3"></i> Window-функции и CTE</a>
  <a class="nav-item" onclick="showSection('vendor',this)"><i data-lucide="git-compare"></i> MySQL vs PG vs MSSQL</a>
  <a class="nav-item" onclick="showSection('advanced-opt',this)"><i data-lucide="zap"></i> Hints, Partitioning, MV</a>
  <a class="nav-item" onclick="showSection('pdo',this)"><i data-lucide="code-2"></i> PDO в PHP</a>

  <div class="nav-group-label">Применение</div>
  <a class="nav-item" onclick="showSection('practice',this)"><i data-lucide="hammer"></i> Практика</a>
  <a class="nav-item" onclick="showSection('pitfalls',this)"><i data-lucide="alert-octagon"></i> Подводные камни</a>
  <a class="nav-item" onclick="showSection('interview',this)"><i data-lucide="brain"></i> На собеседование</a>
</div>

<div class="main">
<div class="page-header">
  <h1>SQL и базы данных</h1>
  <p>Реляционная модель, индексы, EXPLAIN, транзакции и MVCC, оконные функции, отличия MySQL и PostgreSQL, паттерны запросов. Глубокий разбор middle/senior уровня с примерами и подводными камнями каждого механизма.</p>
  <div class="badge-row">
    <span class="badge">MySQL</span>
    <span class="badge">PostgreSQL</span>
    <span class="badge">PDO</span>
    <span class="badge badge-success">Middle / Senior</span>
  </div>
</div>

<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>
  <p class="text">База данных &mdash; единственный коллаборатор приложения, который пишет данные надолго: упасть может всё что угодно, но в реляционной БД останется следствие сегодняшней работы. Поэтому стоимость ошибки в БД-коде выше стоимости ошибки в любом другом слое: неверный индекс деградирует все читающие запросы, неверная транзакция теряет данные, неверный <code>EXPLAIN</code> заставляет масштабировать &laquo;железом&raquo; то, что лечится правкой одного запроса.</p>

  <div class="info-box primary">
    <strong>Что разбирается в разделе:</strong>
    <ul class="bullets" style="margin-top:6px;margin-bottom:0;color:#404357;">
      <li>Структуры данных под капотом индексов и почему B-Tree победил;</li>
      <li>Как читать <code>EXPLAIN ANALYZE</code> и видеть, на каком шаге запрос &laquo;ломается&raquo;;</li>
      <li>Уровни изоляции: что реально происходит при Read Committed, Repeatable Read, Serializable;</li>
      <li>MVCC и почему чтения в Postgres не блокируют записи;</li>
      <li>Окна и CTE как замена самописных циклов в коде;</li>
      <li>Различия MySQL и PostgreSQL, влияющие на дизайн схемы и запросов;</li>
      <li>PDO: prepared statements, типизация, безопасность от инъекций.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Пререквизиты</div>
    <ul class="bullets">
      <li>Базовый SQL: SELECT/INSERT/UPDATE/DELETE, WHERE, GROUP BY, ORDER BY;</li>
      <li>KB_1 раздел про типы данных PHP &mdash; для понимания касстов в PDO;</li>
      <li>Понимание основ HTTP-запросов в Laravel.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map"></i> Карта раздела</div>
    <table class="data-table">
      <tr><th>Блок</th><th>Что узнаешь</th></tr>
      <tr><td><strong>Основы</strong></td><td>Реляционная модель, нормализация vs денормализация, JOIN-ы и их семантика</td></tr>
      <tr><td><strong>Производительность</strong></td><td>Индексы (типы, leftmost, covering), чтение EXPLAIN, борьба с N+1</td></tr>
      <tr><td><strong>Транзакции</strong></td><td>ACID и уровни изоляции, MVCC, блокировки, deadlock'и</td></tr>
      <tr><td><strong>Продвинуто</strong></td><td>Окна, CTE, отличия MySQL/Postgres, PDO в PHP</td></tr>
      <tr><td><strong>Практика</strong></td><td>Сквозная оптимизация запроса: от 4 секунд до 40 мс</td></tr>
    </table>
  </div>
</div>

<div id="sec-db-types" class="section">
  <div class="section-title">Типы баз данных: SQL / NoSQL / OLTP / OLAP</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Развеиваем путаницу</div>
    <p class="text">Часто путают три ортогональных признака: <strong>модель данных</strong> (реляционная / документная / key-value / графовая), <strong>ориентация хранения</strong> (строчная / колоночная) и <strong>назначение</strong> (OLTP оперативные транзакции / OLAP аналитика). Это <em>независимые оси</em> — одна БД может быть «реляционная + строчная + OLTP» (PostgreSQL), другая «реляционная + колоночная + OLAP» (ClickHouse), третья «документная + строчная + OLTP» (MongoDB).</p>
    <div class="pitfall"><strong>Реляционная ≠ key-value.</strong> Key-value — это NoSQL-модель, где на один ключ приходится одно значение (например, <code>user:1 → "{name:Alice}"</code>). Реляционная модель — таблицы со строками и столбцами + связи через foreign key + SQL как язык запросов. У них разные назначения.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="table-2"></i> Ось 1: Модель данных</div>

    <table class="data-table">
      <tr><th>Модель</th><th>Как хранит</th><th>Кто</th><th>Когда применять</th></tr>
      <tr>
        <td><strong>Реляционная (SQL)</strong></td>
        <td>Таблицы + строки + связи FK. Строгая схема.</td>
        <td>PostgreSQL, MySQL, SQLite, MariaDB, Oracle, SQL Server</td>
        <td>По умолчанию. Транзакции, связанные данные, отчёты.</td>
      </tr>
      <tr>
        <td><strong>Документная (NoSQL)</strong></td>
        <td>JSON/BSON документы в коллекциях. Схема гибкая.</td>
        <td>MongoDB, CouchDB, Firestore</td>
        <td>Данные с изменчивой структурой, вложенные объекты без JOIN.</td>
      </tr>
      <tr>
        <td><strong>Key-Value (NoSQL)</strong></td>
        <td>Ключ → значение (обычно строка/JSON). Никакой схемы.</td>
        <td>Redis, DynamoDB, Memcached, Riak</td>
        <td>Кеш, сессии, счётчики, rate limiting, очереди.</td>
      </tr>
      <tr>
        <td><strong>Column-family (NoSQL)</strong></td>
        <td>Разреженные таблицы с миллионами колонок, sharding.</td>
        <td>Cassandra, HBase, ScyllaDB</td>
        <td>Огромные объёмы, писать чаще чем читать (логи, метрики).</td>
      </tr>
      <tr>
        <td><strong>Graph (NoSQL)</strong></td>
        <td>Узлы + рёбра со свойствами. Обход графа.</td>
        <td>Neo4j, ArangoDB, TigerGraph, AWS Neptune</td>
        <td>Соцсети, рекомендации, fraud detection.</td>
      </tr>
      <tr>
        <td><strong>Time-series</strong></td>
        <td>Оптимизирована под append-only с timestamp.</td>
        <td>InfluxDB, TimescaleDB, Prometheus</td>
        <td>Метрики, IoT, финансовые тики.</td>
      </tr>
      <tr>
        <td><strong>Search-engine</strong></td>
        <td>Инвертированные индексы для полнотекстового поиска.</td>
        <td>Elasticsearch, Meilisearch, OpenSearch</td>
        <td>Поиск, аналитика логов, автодополнение.</td>
      </tr>
      <tr>
        <td><strong>Vector</strong></td>
        <td>Многомерные векторы для similarity search.</td>
        <td>Pinecone, Weaviate, Milvus, pgvector</td>
        <td>Semantic search, embeddings, RAG для LLM.</td>
      </tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="rows-3"></i> Ось 2: Ориентация хранения — строчная vs колоночная</div>
    <p class="text">Даже среди реляционных БД (одна и та же модель — таблицы) физическое хранение может быть разным. Это <strong>не про модель данных</strong>, а про то, как байты лежат на диске.</p>

    <div class="card">
      <h3><i data-lucide="table"></i> Row-oriented (строчная) — MySQL, PostgreSQL</h3>
      <p class="text">Одна строка лежит на диске подряд: <code>[id=1|name='Alice'|email='a@x.kz'|age=25]</code>. Идеально когда нужны <strong>все поля одной строки</strong>: <code>SELECT * FROM users WHERE id=1</code>.</p>
    </div>

    <div class="card">
      <h3><i data-lucide="columns-3"></i> Column-oriented (колоночная) — ClickHouse, Redshift, BigQuery, Snowflake, DuckDB</h3>
      <p class="text">Каждая колонка хранится отдельно: <code>[1,2,3,...]</code> для id, <code>['Alice','Bob','Cena',...]</code> для name. Идеально для <strong>агрегаций по одному-двум полям через миллионы строк</strong>: <code>SELECT AVG(age) FROM users</code> — читает только колонку <code>age</code>, минуя все остальные.</p>
    </div>

    <table class="data-table">
      <tr><th>Аспект</th><th>Row-oriented</th><th>Column-oriented</th></tr>
      <tr><td>Чтение <code>SELECT *</code> одной строки</td><td>⚡ 1 seek</td><td>N seeks (по одному на колонку)</td></tr>
      <tr><td>Агрегация <code>SUM/AVG</code> одной колонки</td><td>Читает ВСЕ колонки</td><td>⚡ Читает только нужную</td></tr>
      <tr><td>INSERT одной строки</td><td>⚡ Быстро</td><td>Медленнее (запись в N файлов)</td></tr>
      <tr><td>UPDATE / DELETE</td><td>⚡ Норм</td><td>Дорого (некоторые вообще запрещают)</td></tr>
      <tr><td>Сжатие</td><td>Хуже (разные типы вперемешку)</td><td>⚡ Отличное (одинаковые данные подряд)</td></tr>
      <tr><td>Индексы нужны часто?</td><td>Да, много</td><td>Реже — скан быстрый</td></tr>
      <tr><td>Типичная задача</td><td>OLTP (транзакции)</td><td>OLAP (аналитика)</td></tr>
    </table>

    <div class="pitfall"><strong>ClickHouse — реляционная колоночная БД.</strong> Умеет SQL с JOIN, GROUP BY, но заточена под аналитику. Для веб-приложения (заказы, юзеры) она плохой выбор — INSERT одной строки в 100 раз медленнее MySQL. Используй для: аналитики логов, метрик, dashboard'ов с миллиардами строк.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="split"></i> Ось 3: Назначение — OLTP vs OLAP</div>
    <table class="data-table">
      <tr><th></th><th>OLTP (Online Transaction Processing)</th><th>OLAP (Online Analytical Processing)</th></tr>
      <tr><td>Что делает</td><td>Оперативные транзакции: заказы, юзеры, платежи</td><td>Аналитика: отчёты, dashboards, BI</td></tr>
      <tr><td>Запись / чтение</td><td>Много мелких транзакций (create order)</td><td>Мало запросов, но огромных (SUM за год)</td></tr>
      <tr><td>Модель данных</td><td>Нормализованная (3NF)</td><td>Денормализованная (star / snowflake schema)</td></tr>
      <tr><td>Обычно</td><td>Row-oriented (MySQL, PostgreSQL)</td><td>Column-oriented (ClickHouse, Redshift)</td></tr>
      <tr><td>Индексы</td><td>Много, часто</td><td>Мало (полный скан быстрый)</td></tr>
      <tr><td>Пользователи</td><td>Сайт, приложение</td><td>Аналитики, менеджеры, BI-tools</td></tr>
      <tr><td>Пример</td><td><code>INSERT INTO orders VALUES(...)</code></td><td><code>SELECT month, SUM(amount) FROM orders GROUP BY month</code></td></tr>
    </table>

    <div class="pitfall"><strong>На практике часто держат обе.</strong> OLTP-база (PostgreSQL) — production. Ночью данные ETL-скриптом переливают в OLAP (ClickHouse / Snowflake). Аналитики смотрят отчёты в OLAP без нагрузки на прод.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="sparkles"></i> Специальные категории</div>

    <div class="card">
      <h3><i data-lucide="scale"></i> NewSQL — распределенная реляционная</h3>
      <p class="text">CockroachDB, YugabyteDB, TiDB, Google Spanner. Реляционная модель + SQL + ACID + горизонтальное масштабирование (шардирование). Появились когда MySQL/PostgreSQL стали упираться в один сервер. Дороже и сложнее классических.</p>
    </div>

    <div class="card">
      <h3><i data-lucide="hard-drive"></i> Embedded — в процесс приложения</h3>
      <p class="text">SQLite, LevelDB, RocksDB, DuckDB. Живут в файле рядом с приложением, без сетевого сервера. SQLite — самая распространённая БД в мире (каждый iPhone, Android, браузер). Идеально для локального dev, mobile, тестов, KB как у нас.</p>
    </div>

    <div class="card">
      <h3><i data-lucide="link-2"></i> Гибриды — PostgreSQL как «универсал»</h3>
      <p class="text">Современный PostgreSQL умеет одновременно: реляционные таблицы + <code>JSONB</code> (документная модель) + <code>hstore</code> (key-value) + <code>full-text search</code> + <code>pgvector</code> (векторный поиск) + <code>PostGIS</code> (гео). В 90% проектов PostgreSQL закрывает всё — не нужно 5 разных БД.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle-2"></i> Правило выбора</div>
    <table class="data-table">
      <tr><th>Задача</th><th>Что брать</th></tr>
      <tr><td>Веб-приложение / e-commerce / любой стандартный проект</td><td><strong>PostgreSQL</strong> или MySQL</td></tr>
      <tr><td>Кеш, сессии, счётчики, очереди</td><td><strong>Redis</strong></td></tr>
      <tr><td>Данные без чёткой схемы, вложенные документы</td><td>MongoDB (или JSONB в PostgreSQL)</td></tr>
      <tr><td>Аналитика на миллиарды строк, dashboards</td><td>ClickHouse / BigQuery / Snowflake</td></tr>
      <tr><td>Полнотекстовый поиск, автодополнение</td><td>Elasticsearch / Meilisearch (или FTS в PG)</td></tr>
      <tr><td>Соц.граф, рекомендации</td><td>Neo4j</td></tr>
      <tr><td>Метрики, IoT, финансовые тики</td><td>InfluxDB / TimescaleDB</td></tr>
      <tr><td>Semantic search для LLM</td><td>pgvector / Pinecone / Weaviate</td></tr>
      <tr><td>Mobile app, embedded, KB, dev-локалка</td><td>SQLite</td></tr>
    </table>
    <div class="remember-box"><strong>На собесе спросят:</strong> «SQL vs NoSQL когда что». Правильный ответ — <em>«зависит от паттерна доступа»</em>. NoSQL быстрее для конкретной модели, но реляционная гибче. Начинай с PostgreSQL — переходи на NoSQL только когда конкретный кейс требует.</div>
  </div>
</div>

<div id="sec-relational" class="section">
  <div class="section-title">Реляционная модель</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Реляционная модель, предложенная Эдгаром Коддом в 1970 году, &mdash; математически строгий способ описать данные через <strong>отношения</strong> (relations). Каждое отношение &mdash; это множество кортежей (tuples) одинаковой структуры (схемы). Этот фундамент определяет, почему SQL такой какой есть: декларативный язык запросов, работающий с множествами, а не с итерациями. Понимание модели позволяет читать SQL как алгебру, а не как набор инструкций.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Базовые понятия</div>
    <div class="card">
      <h3>Отношение, атрибуты, кортежи</h3>
      <p class="text">Отношение в реляционной модели &mdash; математически множество кортежей с фиксированной схемой. На практике в SQL &mdash; <strong>таблица</strong> (хотя строго говоря, таблица в SQL допускает дубликаты, а отношение &mdash; нет). <strong>Атрибут</strong> &mdash; столбец. <strong>Кортеж</strong> &mdash; строка. <strong>Степень отношения</strong> &mdash; количество атрибутов; <strong>мощность</strong> &mdash; количество кортежей.</p>
    </div>
    <div class="card">
      <h3>Ключи: primary, candidate, foreign, surrogate</h3>
      <p class="text"><strong>Candidate key</strong> &mdash; минимальный набор атрибутов, однозначно идентифицирующий кортеж. <strong>Primary key</strong> &mdash; выбранный candidate key, на котором строится физическое размещение строк (clustered index в InnoDB). <strong>Surrogate key</strong> &mdash; искусственный (auto-increment id, UUID), не имеющий бизнес-смысла. <strong>Foreign key</strong> &mdash; ссылка на primary key другой таблицы.</p>
    </div>
    <div class="card">
      <h3>Целостность: domain, entity, referential</h3>
      <p class="text"><strong>Domain integrity</strong> &mdash; значение каждого атрибута соответствует допустимому домену (типу, ограничениям CHECK). <strong>Entity integrity</strong> &mdash; каждая строка уникально идентифицируема (NOT NULL на PK). <strong>Referential integrity</strong> &mdash; FK либо ссылается на существующую строку, либо NULL. Эти три уровня &mdash; контракт БД с приложением.</p>
    </div>
    <div class="card">
      <h3>NULL &mdash; признак &laquo;неизвестно&raquo;</h3>
      <p class="text">NULL в SQL имеет тройную логику: <code>NULL = NULL</code> возвращает не <code>true</code>, а <code>NULL</code> (unknown). Это источник тонких багов: <code>WHERE x &lt;&gt; 5</code> не вернёт строки с <code>x = NULL</code>. Для проверки NULL используется <code>IS NULL</code>/<code>IS NOT NULL</code>. Агрегаты (<code>COUNT</code>, <code>SUM</code>) игнорируют NULL, кроме <code>COUNT(*)</code>.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: схема магазина</div>
<pre><code><span class="c-key">CREATE TABLE</span> <span class="c-type">users</span> (
    <span class="c-var">id</span>          <span class="c-type">BIGINT</span>      <span class="c-key">PRIMARY KEY AUTO_INCREMENT</span>,
    <span class="c-var">email</span>       <span class="c-type">VARCHAR</span>(<span class="c-num">255</span>) <span class="c-key">NOT NULL UNIQUE</span>,
    <span class="c-var">created_at</span>  <span class="c-type">TIMESTAMP</span>   <span class="c-key">NOT NULL DEFAULT CURRENT_TIMESTAMP</span>
);

<span class="c-key">CREATE TABLE</span> <span class="c-type">orders</span> (
    <span class="c-var">id</span>          <span class="c-type">BIGINT</span>      <span class="c-key">PRIMARY KEY AUTO_INCREMENT</span>,
    <span class="c-var">user_id</span>     <span class="c-type">BIGINT</span>      <span class="c-key">NOT NULL</span>,
    <span class="c-var">status</span>      <span class="c-type">VARCHAR</span>(<span class="c-num">32</span>)  <span class="c-key">NOT NULL</span>,
    <span class="c-var">total_minor</span> <span class="c-type">INT</span>          <span class="c-key">NOT NULL CHECK</span> (<span class="c-var">total_minor</span> &gt;= <span class="c-num">0</span>),
    <span class="c-key">FOREIGN KEY</span> (<span class="c-var">user_id</span>) <span class="c-key">REFERENCES</span> <span class="c-type">users</span>(<span class="c-var">id</span>) <span class="c-key">ON DELETE RESTRICT</span>
);
</code></pre>
    <p class="text">Здесь видны все три типа целостности: <code>NOT NULL</code> и <code>UNIQUE</code> для entity, <code>CHECK</code> для domain, <code>FOREIGN KEY</code> для referential.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Surrogate key как единственный.</strong> Таблица с одним id и без natural-уникальных ограничений позволяет вставить дубликаты бизнес-сущностей. Surrogate key полезен для индексации, но не отменяет необходимость уникальных ограничений на бизнес-атрибуты.</div>
    <div class="pitfall"><strong>2. NULL в FK.</strong> NULL разрешён в FK по умолчанию &mdash; часто «временное» решение, превращающееся в постоянное и порождающее ветви <code>IS NULL</code> в каждом запросе.</div>
    <div class="pitfall"><strong>3. <code>ON DELETE CASCADE</code> бездумно.</strong> Удобен для слабых сущностей (<code>order_items</code> при удалении <code>orders</code>), но опасен для сильных (удаление user'а сносит весь профиль, заказы, платежи).</div>
    <div class="pitfall"><strong>4. UUID v4 как PK.</strong> Случайные значения приводят к фрагментации clustered B-Tree. Используйте UUIDv7 (упорядоченный по времени) либо BIGINT + UUID как secondary.</div>
    <div class="pitfall"><strong>5. <code>CHECK</code> на MySQL до 8.0.16.</strong> В старых версиях <code>CHECK</code> парсился, но не применялся &mdash; ограничения молча игнорировались.</div>
    <div class="pitfall"><strong>6. Денормализованные дубликаты без синхронизации.</strong> Часто «для скорости» копируют <code>user_name</code> в <code>orders</code>. Если имя меняется, в заказах остаётся старое.</div>
    <div class="pitfall"><strong>7. Хранение денег как FLOAT.</strong> <code>FLOAT</code> приблизительный; <code>0.1 + 0.2 != 0.3</code>. Деньги хранятся как <code>INT</code> в минорных единицах или <code>DECIMAL(p, s)</code>.</div>
    <div class="pitfall"><strong>8. <code>ENUM</code> для растущего списка.</strong> Добавить значение &mdash; ALTER TABLE с переписыванием. Используйте FK на справочную таблицу для растущих доменов.</div>
  </div>
</div>

<div id="sec-types" class="section">
  <div class="section-title">Типы данных</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Выбор типа данных &mdash; первое архитектурное решение в схеме. Тип определяет диапазон значений, размер на диске, скорость операций, поведение в индексах и совместимость между СУБД. Неверный тип приводит к двум классам проблем: <strong>тихая потеря данных</strong> (округление FLOAT для денег, переполнение TINYINT) и <strong>деградация производительности</strong> (CHAR(255) вместо VARCHAR, BLOB в часто читаемых строках).</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hash"></i> Целочисленные типы (MySQL)</div>
    <table class="data-table">
      <tr><th>Тип</th><th>Байт</th><th>Signed диапазон</th><th>Unsigned диапазон</th></tr>
      <tr><td><code>TINYINT</code></td><td>1</td><td>&minus;128..127</td><td>0..255</td></tr>
      <tr><td><code>SMALLINT</code></td><td>2</td><td>&minus;32 768..32 767</td><td>0..65 535</td></tr>
      <tr><td><code>MEDIUMINT</code></td><td>3</td><td>~&minus;8.4M..8.4M</td><td>0..16 777 215</td></tr>
      <tr><td><code>INT</code></td><td>4</td><td>~&minus;2.1B..2.1B</td><td>0..4 294 967 295</td></tr>
      <tr><td><code>BIGINT</code></td><td>8</td><td>~&plusmn;9.2&times;10<sup>18</sup></td><td>0..1.8&times;10<sup>19</sup></td></tr>
    </table>
    <p class="text">Эмпирика: <code>id BIGINT UNSIGNED</code> для PK всегда; <code>price_minor INT UNSIGNED</code> для денег в копейках (хватит до ~$42M); <code>quantity SMALLINT UNSIGNED</code> для штук товара. Не используйте больше, чем нужно &mdash; на миллионе строк лишний байт = МБ. PostgreSQL: <code>SMALLINT</code> (2b), <code>INTEGER</code> (4b), <code>BIGINT</code> (8b), <code>SERIAL/BIGSERIAL</code> &mdash; auto-increment.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="dollar-sign"></i> Деньги: DECIMAL, не FLOAT</div>
<pre><code><span class="c-comment">-- ❌ Никогда. FLOAT/DOUBLE — приблизительные.</span>
<span class="c-key">CREATE TABLE</span> <span class="c-type">orders</span> (<span class="c-var">total</span> <span class="c-type">FLOAT</span>);
<span class="c-comment">-- SELECT 0.1 + 0.2; → 0.30000000000000004</span>

<span class="c-comment">-- ✓ INT в минорных единицах (центы/копейки)</span>
<span class="c-key">CREATE TABLE</span> <span class="c-type">orders</span> (<span class="c-var">total_minor</span> <span class="c-type">INT UNSIGNED</span>);

<span class="c-comment">-- ✓ DECIMAL(precision, scale) — точное хранение</span>
<span class="c-key">CREATE TABLE</span> <span class="c-type">products</span> (<span class="c-var">price</span> <span class="c-type">DECIMAL</span>(<span class="c-num">10</span>, <span class="c-num">2</span>)); <span class="c-comment">-- до 99 999 999.99</span>
</code></pre>
    <p class="text">Если <em>обязаны</em> сравнить FLOAT'ы &mdash; через эпсилон: <code>ABS(a - b) &lt; 0.0001</code>, никогда <code>a = b</code>. Для финансовых сумм правило строгое &mdash; только DECIMAL или INT в минорных единицах.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="calendar"></i> Дата и время</div>
    <table class="data-table">
      <tr><th>Тип</th><th>Размер</th><th>Диапазон / особенности</th></tr>
      <tr><td><code>DATE</code></td><td>3 байта</td><td>1000-01-01 .. 9999-12-31</td></tr>
      <tr><td><code>TIME</code></td><td>3 байта</td><td>&minus;838:59:59 .. 838:59:59</td></tr>
      <tr><td><code>DATETIME</code></td><td>8 байт</td><td>1000-01-01 .. 9999-12-31, без TZ</td></tr>
      <tr><td><code>TIMESTAMP</code></td><td>4 байта</td><td>1970-01-01 .. <strong>2038-01-19</strong>, хранит UTC</td></tr>
      <tr><td><code>YEAR</code></td><td>1 байт</td><td>1901..2155</td></tr>
    </table>
    <p class="text"><strong>Проблема 2038</strong>: 32-битный TIMESTAMP переполнится в январе 2038. Для долговременных дат (контракты, договоры) &mdash; <code>DATETIME</code>. PostgreSQL: <code>TIMESTAMP WITH TIME ZONE</code> (<code>timestamptz</code>) &mdash; хранит UTC и конвертирует в TZ клиента; <code>TIMESTAMP WITHOUT TIME ZONE</code> &mdash; «голое» значение.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="type"></i> Строки: CHAR vs VARCHAR vs TEXT</div>
    <table class="data-table">
      <tr><th>Тип</th><th>Хранение</th><th>Когда применять</th></tr>
      <tr><td><code>CHAR(n)</code></td><td>Фиксированная длина, дополняется пробелами</td><td>Заведомо фиксированные строки: MD5 (<code>CHAR(32)</code>), bcrypt (<code>CHAR(60)</code>), коды стран (<code>CHAR(2)</code>)</td></tr>
      <tr><td><code>VARCHAR(n)</code></td><td>Переменная + 1-2 байта оверхеда</td><td>Имена, email, заголовки. Дефолт для большинства строк.</td></tr>
      <tr><td><code>TINYTEXT</code></td><td>До 255 байт</td><td>Короткие комментарии</td></tr>
      <tr><td><code>TEXT</code></td><td>До 64 КБ</td><td>Описания, комментарии</td></tr>
      <tr><td><code>MEDIUMTEXT</code></td><td>До 16 МБ</td><td>Статьи, документация</td></tr>
      <tr><td><code>LONGTEXT</code></td><td>До 4 ГБ</td><td>Огромные документы (редко в SQL, лучше S3)</td></tr>
    </table>
    <p class="text">TEXT-семейство хранится <strong>off-page</strong> (отдельно от строки) &mdash; полный JOIN/SELECT * становится медленнее. PostgreSQL: <code>TEXT</code> без ограничения длины как универсальный тип.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="braces"></i> Специальные: JSON, ENUM, SET, ARRAY</div>
    <div class="card">
      <h3>JSON / JSONB</h3>
      <p class="text">MySQL: <code>JSON</code> &mdash; бинарный, поддерживает частичные обновления (<code>JSON_SET</code>, <code>JSON_REMOVE</code>), валидирует синтаксис. Индексирование &mdash; через generated columns. PostgreSQL: <code>JSONB</code> &mdash; бинарный с GIN-индексированием (<code>WHERE data @&gt; '{"key":"x"}'</code>). Применять для гибких атрибутов, не для частых WHERE.</p>
    </div>
    <div class="card">
      <h3>ENUM (MySQL)</h3>
      <p class="text">Одно из заранее заданного набора значений: <code>status ENUM('pending', 'paid', 'cancelled')</code>. 1-2 байта на хранение. Минус: расширение списка &mdash; ALTER TABLE с перезаписью. Для растущих доменов &mdash; справочная таблица + FK.</p>
    </div>
    <div class="card">
      <h3>SET (MySQL)</h3>
      <p class="text">Битовая маска нескольких значений: <code>tags SET('php', 'mysql', 'redis')</code>. До 64 значений, 1-8 байт. На практике редко &mdash; лучше отдельная таблица-связь.</p>
    </div>
    <div class="card">
      <h3>ARRAY (PostgreSQL)</h3>
      <p class="text">Нативные массивы: <code>tags TEXT[]</code>, <code>scores INT[]</code>. Индексирование через GIN: <code>WHERE tags @&gt; ARRAY['php']</code>. Удобно, но ломает переносимость на MySQL.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>FLOAT</code> для денег.</strong> Тихая потеря копеек. Только <code>DECIMAL</code> или <code>INT</code> в минорных единицах.</div>
    <div class="pitfall"><strong>2. <code>TIMESTAMP</code> для будущих дат.</strong> Переполнение в 2038. <code>DATETIME</code> или <code>BIGINT</code> в Unix-секундах.</div>
    <div class="pitfall"><strong>3. <code>VARCHAR(255)</code> по привычке.</strong> Если поле точно &le; 32 символа &mdash; <code>VARCHAR(32)</code>. На больших таблицах байты складываются.</div>
    <div class="pitfall"><strong>4. <code>BLOB</code>/<code>TEXT</code> в часто читаемых строках.</strong> Off-page хранение замедляет SELECT *. Выносите большие поля в отдельную таблицу 1:1.</div>
    <div class="pitfall"><strong>5. MySQL <code>utf8</code> вместо <code>utf8mb4</code>.</strong> Старый <code>utf8</code> &mdash; 3-байтный, не вмещает эмодзи и редкие символы. Всегда <code>utf8mb4</code>.</div>
    <div class="pitfall"><strong>6. <code>ENUM</code> для статусов с авторазвитием.</strong> Каждое добавление статуса &mdash; ALTER на миллион строк. Используйте справочную таблицу.</div>
    <div class="pitfall"><strong>7. PostgreSQL <code>TIMESTAMP</code> без TZ для UTC-данных.</strong> Используйте <code>TIMESTAMPTZ</code> &mdash; конвертация в TZ клиента автоматическая.</div>
    <div class="pitfall"><strong>8. <code>BIGINT</code> для всего по умолчанию.</strong> 8 байт vs 4 (INT). На таблице в 100M строк это 400 МБ разницы только в PK + столько же на каждый FK.</div>
  </div>
</div>

<div id="sec-ddl" class="section">
  <div class="section-title">DDL: CREATE, ALTER, DROP</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">DDL (Data Definition Language) &mdash; команды управления схемой: создание, изменение, удаление таблиц и ограничений. На проде это самая опасная категория операций &mdash; ALTER на гигабайтной таблице может блокировать чтение на минуты, DROP TABLE &mdash; необратим. Понимание тонкостей DDL и стратегий безопасного применения отделяет производственный опыт от учебного.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="plus"></i> CREATE TABLE с constraints</div>
<pre><code><span class="c-key">CREATE TABLE IF NOT EXISTS</span> <span class="c-type">users</span> (
    <span class="c-var">id</span>          <span class="c-type">BIGINT UNSIGNED</span> <span class="c-key">PRIMARY KEY AUTO_INCREMENT</span>,
    <span class="c-var">email</span>       <span class="c-type">VARCHAR</span>(<span class="c-num">255</span>)    <span class="c-key">NOT NULL UNIQUE</span>,
    <span class="c-var">age</span>         <span class="c-type">TINYINT UNSIGNED</span> <span class="c-key">CHECK</span> (<span class="c-var">age</span> <span class="c-key">BETWEEN</span> <span class="c-num">0</span> <span class="c-key">AND</span> <span class="c-num">150</span>),
    <span class="c-var">status</span>      <span class="c-type">VARCHAR</span>(<span class="c-num">32</span>)     <span class="c-key">NOT NULL DEFAULT</span> <span class="c-str">'pending'</span>,
    <span class="c-var">created_at</span>  <span class="c-type">TIMESTAMP</span>       <span class="c-key">NOT NULL DEFAULT CURRENT_TIMESTAMP</span>,
    <span class="c-key">CONSTRAINT</span> <span class="c-var">chk_status</span> <span class="c-key">CHECK</span> (<span class="c-var">status</span> <span class="c-key">IN</span> (<span class="c-str">'pending'</span>, <span class="c-str">'active'</span>, <span class="c-str">'banned'</span>))
) <span class="c-key">ENGINE</span>=<span class="c-type">InnoDB</span> <span class="c-key">DEFAULT CHARSET</span>=<span class="c-type">utf8mb4</span> <span class="c-key">COLLATE</span>=<span class="c-type">utf8mb4_unicode_ci</span>;
</code></pre>
    <p class="text"><strong>CHECK</strong> в MySQL до 8.0.16 парсился, но не применялся &mdash; ограничения молча игнорировались. С 8.0.16+ &mdash; работают. PostgreSQL &mdash; работают всегда. Именованные constraints (<code>CONSTRAINT chk_status</code>) удобнее для последующего DROP/изменения.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="copy"></i> CREATE TABLE AS SELECT (быстрый бэкап / снапшот)</div>
<pre><code><span class="c-comment">-- Полная копия с данными</span>
<span class="c-key">CREATE TABLE</span> <span class="c-type">users_backup_20260523</span> <span class="c-key">AS SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">users</span>;

<span class="c-comment">-- Только структура без данных</span>
<span class="c-key">CREATE TABLE</span> <span class="c-type">users_empty</span> <span class="c-key">AS SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">users</span> <span class="c-key">WHERE</span> <span class="c-num">1</span>=<span class="c-num">0</span>;

<span class="c-comment">-- Подмножество по условию (миграция данных)</span>
<span class="c-key">CREATE TABLE</span> <span class="c-type">archived_orders</span> <span class="c-key">AS</span>
  <span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">orders</span> <span class="c-key">WHERE</span> <span class="c-var">created_at</span> &lt; <span class="c-str">'2020-01-01'</span>;
</code></pre>
    <p class="text">Важно: <code>CREATE TABLE AS SELECT</code> копирует данные, но <strong>не копирует</strong> PK, индексы, FK, AUTO_INCREMENT. После создания нужно добавить вручную. PostgreSQL: <code>CREATE TABLE ... (LIKE source INCLUDING ALL)</code> &mdash; копирует и ограничения.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="edit"></i> ALTER TABLE: безопасные и опасные операции</div>
<pre><code><span class="c-comment">-- Добавить колонку</span>
<span class="c-key">ALTER TABLE</span> <span class="c-type">users</span> <span class="c-key">ADD COLUMN</span> <span class="c-var">phone</span> <span class="c-type">VARCHAR</span>(<span class="c-num">20</span>) <span class="c-key">NULL</span> <span class="c-key">AFTER</span> <span class="c-var">email</span>;

<span class="c-comment">-- Изменить тип колонки (потенциально долго)</span>
<span class="c-key">ALTER TABLE</span> <span class="c-type">orders</span> <span class="c-key">MODIFY COLUMN</span> <span class="c-var">total_minor</span> <span class="c-type">BIGINT UNSIGNED NOT NULL</span>;

<span class="c-comment">-- Переименовать колонку (MySQL 8+)</span>
<span class="c-key">ALTER TABLE</span> <span class="c-type">users</span> <span class="c-key">RENAME COLUMN</span> <span class="c-var">name</span> <span class="c-key">TO</span> <span class="c-var">full_name</span>;

<span class="c-comment">-- Добавить индекс</span>
<span class="c-key">ALTER TABLE</span> <span class="c-type">orders</span> <span class="c-key">ADD INDEX</span> <span class="c-var">idx_user_created</span> (<span class="c-var">user_id</span>, <span class="c-var">created_at</span>);

<span class="c-comment">-- Добавить FK с именем</span>
<span class="c-key">ALTER TABLE</span> <span class="c-type">orders</span> <span class="c-key">ADD CONSTRAINT</span> <span class="c-var">fk_orders_user</span>
  <span class="c-key">FOREIGN KEY</span> (<span class="c-var">user_id</span>) <span class="c-key">REFERENCES</span> <span class="c-type">users</span>(<span class="c-var">id</span>) <span class="c-key">ON DELETE RESTRICT</span>;
</code></pre>
    <p class="text"><strong>Цена операций:</strong> до MySQL 8.0 большинство ALTER требовало полной перезаписи таблицы (создание копии, копирование строк, переименование). С 8.0+ многие операции instant: добавление колонки в конец, переименование колонки, добавление виртуальной колонки. Для DROP COLUMN, изменения типа &mdash; всё равно перезапись.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="search"></i> DESC / SHOW: интроспекция</div>
<pre><code><span class="c-comment">-- MySQL</span>
<span class="c-key">DESC</span> <span class="c-type">users</span>;                       <span class="c-comment">-- структура таблицы</span>
<span class="c-key">SHOW CREATE TABLE</span> <span class="c-type">users</span>;          <span class="c-comment">-- полный CREATE</span>
<span class="c-key">SHOW INDEX FROM</span> <span class="c-type">users</span>;            <span class="c-comment">-- список индексов</span>
<span class="c-key">SHOW TABLE STATUS LIKE</span> <span class="c-str">'users'</span>;     <span class="c-comment">-- размер, кол-во строк, engine</span>

<span class="c-comment">-- PostgreSQL (psql)</span>
\d <span class="c-type">users</span>            <span class="c-comment">-- структура + индексы + FK</span>
\d+ <span class="c-type">users</span>           <span class="c-comment">-- расширенная</span>
\di              <span class="c-comment">-- все индексы</span>
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>ALTER TABLE</code> на проде без online-tool.</strong> На таблице в 10M строк ALTER блокирует чтение/запись на десятки минут. Используйте <code>pt-online-schema-change</code>, <code>gh-ost</code> либо <code>pg_repack</code>.</div>
    <div class="pitfall"><strong>2. <code>CREATE TABLE AS SELECT</code> без индексов.</strong> Копирует данные, но не PK/индексы/FK. Добавляйте отдельным ALTER после.</div>
    <div class="pitfall"><strong>3. <code>DROP TABLE</code> без бэкапа.</strong> Необратимо. Перед удалением &mdash; <code>RENAME</code> в <code>_archive</code> на несколько дней, затем DROP.</div>
    <div class="pitfall"><strong>4. <code>ALTER</code> в одной транзакции с DML на MySQL до 8.0.</strong> MySQL InnoDB &lt; 8.0 неявно коммитит транзакцию перед DDL. Postgres &mdash; DDL транзакционный.</div>
    <div class="pitfall"><strong>5. Default <code>ENGINE=MyISAM</code>.</strong> На MySQL до 5.5 дефолт &mdash; MyISAM (без транзакций, table-level locks). Явно: <code>ENGINE=InnoDB</code>.</div>
    <div class="pitfall"><strong>6. Дефолтный collation утечкой регистра.</strong> <code>utf8mb4_unicode_ci</code> &mdash; case-insensitive; <code>WHERE email = 'A'</code> найдёт <code>'a'</code>. Для строгого сравнения &mdash; <code>utf8mb4_bin</code> или <code>COLLATE</code> в WHERE.</div>
    <div class="pitfall"><strong>7. Безымянный constraint.</strong> <code>FOREIGN KEY ... REFERENCES ...</code> без CONSTRAINT-имени &mdash; MySQL генерирует имя автоматически. Удалять/менять потом &mdash; нужно сначала найти имя через <code>SHOW CREATE TABLE</code>.</div>
    <div class="pitfall"><strong>8. <code>CHECK</code> в MySQL &lt; 8.0.16.</strong> Парсился без ошибки, но не применялся. Если поддерживаете старые БД &mdash; дублируйте проверки в приложении.</div>
  </div>
</div>

<div id="sec-normalization" class="section">
  <div class="section-title">Нормализация и денормализация</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Нормализация &mdash; процесс декомпозиции таблиц для устранения аномалий обновления, вставки и удаления. Формы нормализации (1НФ, 2НФ, 3НФ, БКНФ) &mdash; последовательно более строгие критерии. Знание форм нужно не для механического применения, а для понимания, какую аномалию устраняет каждый уровень и в каких случаях <strong>осознанная денормализация</strong> оправдана.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Формы по нарастанию</div>
    <div class="card">
      <h3>1НФ &mdash; атомарность</h3>
      <p class="text">Каждый атрибут содержит атомарное значение, без списков и вложенных структур. Колонка <code>phones VARCHAR</code> со значением <code>"+7-700-1234, +7-700-5678"</code> нарушает 1НФ &mdash; декомпозируется в отдельную таблицу <code>user_phones</code>.</p>
    </div>
    <div class="card">
      <h3>2НФ &mdash; полная зависимость от PK</h3>
      <p class="text">Каждый неключевой атрибут зависит от всего PK, а не от его части. Актуально при составном PK. Пример нарушения: <code>order_items(order_id, sku, sku_name, quantity)</code>, где <code>sku_name</code> зависит только от <code>sku</code>.</p>
    </div>
    <div class="card">
      <h3>3НФ &mdash; отсутствие транзитивных зависимостей</h3>
      <p class="text">Ни один неключевой атрибут не зависит от другого неключевого. Нарушение: <code>employees(id, department_id, department_name)</code> &mdash; <code>department_name</code> зависит от <code>department_id</code>. 3НФ &mdash; практический потолок для OLTP-схем.</p>
    </div>
    <div class="card">
      <h3>БКНФ &mdash; усиление 3НФ</h3>
      <p class="text">Каждая нетривиальная функциональная зависимость имеет в левой части суперключ. Решает редкий случай множественных перекрывающихся candidate keys.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Когда денормализация оправдана</div>
    <table class="data-table">
      <tr><th>Сценарий</th><th>Решение</th></tr>
      <tr><td>Read-heavy агрегат (<code>users.orders_count</code>)</td><td>Денормализованный счётчик, обновляемый триггером или job'ом</td></tr>
      <tr><td>Исторический срез (имя пользователя на момент заказа)</td><td>Денормализованная копия в <code>orders.user_name_snapshot</code></td></tr>
      <tr><td>Tree/иерархия с частыми чтениями</td><td>Materialized path или nested set</td></tr>
      <tr><td>Аналитические витрины</td><td>Отдельная схема (warehouse) с денормализацией под отчёты</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Денормализация «на всякий случай».</strong> Копия колонки нужна только когда измерена конкретная проблема и принято решение о её цене.</div>
    <div class="pitfall"><strong>2. Тройная отрицательная логика.</strong> Колонка <code>is_not_inactive BOOLEAN</code> &mdash; читать невозможно. Используйте позитивные имена.</div>
    <div class="pitfall"><strong>3. JSON-колонка как ленивая денормализация.</strong> Если поле часто фигурирует в WHERE/JOIN &mdash; вынесите его в отдельный столбец.</div>
    <div class="pitfall"><strong>4. EAV (Entity-Attribute-Value).</strong> Схема превращает любой запрос в десяток self-JOIN'ов. Антипаттерн в общем случае.</div>
    <div class="pitfall"><strong>5. Полиморфные FK без проверки.</strong> Колонка <code>commentable_type</code> + <code>commentable_id</code> без FK не имеет гарантий целостности на уровне БД.</div>
    <div class="pitfall"><strong>6. Triggers как способ синхронизации.</strong> Триггеры легко проглядеть при чтении кода. Документируйте или используйте observers/events.</div>
    <div class="pitfall"><strong>7. Хранение списков в TEXT через разделитель.</strong> <code>tags = 'php,mysql'</code> ломает поиск, индекс не работает.</div>
    <div class="pitfall"><strong>8. Универсальная таблица «logs».</strong> Одна таблица для всех логов всех модулей быстро становится узким местом.</div>
  </div>
</div>

<div id="sec-joins" class="section">
  <div class="section-title">JOIN-ы: семантика и применение</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">JOIN &mdash; операция комбинирования строк двух (и более) отношений на основе условия. Несмотря на единый синтаксис, разные виды JOIN-ов имеют принципиально разную семантику: один из них (INNER) фильтрует, другой (LEFT) дополняет, третий (CROSS) умножает. Неправильный JOIN &mdash; одна из самых частых причин ложных данных в отчётах.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Виды JOIN-ов</div>
    <div class="card"><h3>INNER JOIN</h3><p class="text">Возвращает только строки, для которых условие соединения истинно. Если в левой таблице есть пользователь без заказов &mdash; в результат он не попадёт. INNER JOIN &mdash; это <em>фильтр</em>.</p></div>
    <div class="card"><h3>LEFT (OUTER) JOIN</h3><p class="text">Возвращает все строки левой таблицы; для строк без соответствия в правой &mdash; правые колонки заполняются NULL. Используется, когда правая сторона &mdash; <em>дополняющая</em> информация.</p></div>
    <div class="card"><h3>RIGHT JOIN</h3><p class="text">Зеркальная версия LEFT. Практически не используется &mdash; переписывается как LEFT с перестановкой таблиц и читается понятнее.</p></div>
    <div class="card"><h3>FULL OUTER JOIN</h3><p class="text">Возвращает все строки обеих таблиц; для несоответствий с любой стороны &mdash; NULL. MySQL до 8.0 не поддерживает &mdash; обходят через UNION двух LEFT JOIN-ов.</p></div>
    <div class="card"><h3>CROSS JOIN</h3><p class="text">Декартово произведение &mdash; каждая строка левой комбинируется с каждой правой. Полезно для построения календарных таблиц через CROSS JOIN с числовой последовательностью.</p></div>
    <div class="card"><h3>SELF JOIN</h3><p class="text">Таблица соединяется сама с собой по алиасу. Применяется для иерархий (<code>employees.manager_id =&gt; employees.id</code>), сравнений пар строк.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="filter"></i> ON vs WHERE: критичная разница для OUTER JOIN</div>
    <p class="text">Условие в <code>ON</code> применяется <strong>до</strong> JOIN-а &mdash; контролирует, какие строки соединяются. Условие в <code>WHERE</code> применяется <strong>после</strong> JOIN-а &mdash; фильтрует результат. Для INNER JOIN разницы нет; для OUTER &mdash; разница принципиальная.</p>

<pre><code><span class="c-comment">-- ❌ WHERE на правую таблицу превращает LEFT JOIN в INNER</span>
<span class="c-key">SELECT</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-var">u</span>.<span class="c-var">email</span>, <span class="c-var">o</span>.<span class="c-var">id</span> <span class="c-key">AS</span> <span class="c-var">order_id</span>
<span class="c-key">FROM</span> <span class="c-type">users</span> <span class="c-var">u</span>
<span class="c-key">LEFT JOIN</span> <span class="c-type">orders</span> <span class="c-var">o</span> <span class="c-key">ON</span> <span class="c-var">o</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>
<span class="c-key">WHERE</span> <span class="c-var">o</span>.<span class="c-var">status</span> = <span class="c-str">'paid'</span>;
<span class="c-comment">-- Пользователи без заказов выпадут: их status = NULL, NULL = 'paid' → false</span>

<span class="c-comment">-- ✓ Условие в ON: LEFT JOIN сохранён</span>
<span class="c-key">SELECT</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-var">u</span>.<span class="c-var">email</span>, <span class="c-var">o</span>.<span class="c-var">id</span> <span class="c-key">AS</span> <span class="c-var">order_id</span>
<span class="c-key">FROM</span> <span class="c-type">users</span> <span class="c-var">u</span>
<span class="c-key">LEFT JOIN</span> <span class="c-type">orders</span> <span class="c-var">o</span> <span class="c-key">ON</span> <span class="c-var">o</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span> <span class="c-key">AND</span> <span class="c-var">o</span>.<span class="c-var">status</span> = <span class="c-str">'paid'</span>;
<span class="c-comment">-- Все пользователи в результате; у тех, без оплаченных заказов, order_id = NULL</span>
</code></pre>

    <p class="text">Правило: <strong>условия на «правую» сторону OUTER JOIN всегда в ON, не в WHERE</strong>. Если условие надо в WHERE &mdash; вы фактически хотите INNER JOIN; запишите его явно.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Conditional JOINs: несколько условий в ON</div>
<pre><code><span class="c-comment">-- Книги с рейтингом &gt;= 4, доставленные в срок</span>
<span class="c-key">SELECT</span> <span class="c-var">b</span>.<span class="c-var">title</span>, <span class="c-var">o</span>.<span class="c-var">quantity</span>, <span class="c-var">d</span>.<span class="c-var">delivery_status</span>
<span class="c-key">FROM</span> <span class="c-type">books</span> <span class="c-var">b</span>
<span class="c-key">JOIN</span> <span class="c-type">orders</span> <span class="c-var">o</span>
  <span class="c-key">ON</span> <span class="c-var">o</span>.<span class="c-var">book_id</span> = <span class="c-var">b</span>.<span class="c-var">id</span>
  <span class="c-key">AND</span> <span class="c-var">o</span>.<span class="c-var">quantity</span> &gt;= <span class="c-num">2</span>
<span class="c-key">JOIN</span> <span class="c-type">deliveries</span> <span class="c-var">d</span>
  <span class="c-key">ON</span> <span class="c-var">d</span>.<span class="c-var">order_id</span> = <span class="c-var">o</span>.<span class="c-var">id</span>
  <span class="c-key">AND</span> <span class="c-var">d</span>.<span class="c-var">delivery_status</span> <span class="c-key">IN</span> (<span class="c-str">'delivered'</span>, <span class="c-str">'in-transit'</span>)
<span class="c-key">WHERE</span> <span class="c-var">b</span>.<span class="c-var">rating</span> &gt;= <span class="c-num">4</span>;
</code></pre>
    <p class="text">Несколько условий в ON через AND/OR/IN &mdash; нормальная практика. Это читается лучше, чем громоздкий WHERE на «склейку».</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-pull-request"></i> COALESCE и NULLIF</div>
    <p class="text">При OUTER JOIN правая сторона может быть NULL. <code>COALESCE</code> возвращает первое не-NULL значение &mdash; стандартный способ подставить дефолт.</p>

<pre><code><span class="c-key">SELECT</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-var">u</span>.<span class="c-var">name</span>,
       <span class="c-fn">COALESCE</span>(<span class="c-fn">SUM</span>(<span class="c-var">o</span>.<span class="c-var">total_minor</span>), <span class="c-num">0</span>) <span class="c-key">AS</span> <span class="c-var">total_spent</span>,
       <span class="c-fn">COALESCE</span>(<span class="c-var">p</span>.<span class="c-var">phone</span>, <span class="c-str">'не указан'</span>)  <span class="c-key">AS</span> <span class="c-var">phone</span>
<span class="c-key">FROM</span> <span class="c-type">users</span> <span class="c-var">u</span>
<span class="c-key">LEFT JOIN</span> <span class="c-type">orders</span>   <span class="c-var">o</span> <span class="c-key">ON</span> <span class="c-var">o</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>
<span class="c-key">LEFT JOIN</span> <span class="c-type">profiles</span> <span class="c-var">p</span> <span class="c-key">ON</span> <span class="c-var">p</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>
<span class="c-key">GROUP BY</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-var">u</span>.<span class="c-var">name</span>, <span class="c-var">p</span>.<span class="c-var">phone</span>;

<span class="c-comment">-- NULLIF — наоборот: если первое = второму, вернуть NULL</span>
<span class="c-comment">-- Защита от деления на 0:</span>
<span class="c-key">SELECT</span> <span class="c-var">amount</span> / <span class="c-fn">NULLIF</span>(<span class="c-var">quantity</span>, <span class="c-num">0</span>) <span class="c-key">AS</span> <span class="c-var">unit_price</span> <span class="c-key">FROM</span> <span class="c-type">items</span>;
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: дублирование строк</div>
<pre><code><span class="c-comment">-- ❌ Двойной JOIN ломает SUM: каждый платёж умножается на количество заказов</span>
<span class="c-key">SELECT</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-fn">COUNT</span>(<span class="c-var">o</span>.<span class="c-var">id</span>) <span class="c-key">AS</span> <span class="c-var">orders_count</span>, <span class="c-fn">SUM</span>(<span class="c-var">p</span>.<span class="c-var">amount</span>) <span class="c-key">AS</span> <span class="c-var">total_paid</span>
<span class="c-key">FROM</span>      <span class="c-type">users</span>    <span class="c-var">u</span>
<span class="c-key">LEFT JOIN</span> <span class="c-type">orders</span>   <span class="c-var">o</span> <span class="c-key">ON</span> <span class="c-var">o</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>
<span class="c-key">LEFT JOIN</span> <span class="c-type">payments</span> <span class="c-var">p</span> <span class="c-key">ON</span> <span class="c-var">p</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>
<span class="c-key">GROUP BY</span> <span class="c-var">u</span>.<span class="c-var">id</span>;
</code></pre>
<pre><code><span class="c-comment">-- ✓ Агрегировать каждую сторону отдельно через подзапросы</span>
<span class="c-key">SELECT</span> <span class="c-var">u</span>.<span class="c-var">id</span>,
       <span class="c-fn">COALESCE</span>(<span class="c-var">o</span>.<span class="c-var">orders_count</span>, <span class="c-num">0</span>) <span class="c-key">AS</span> <span class="c-var">orders_count</span>,
       <span class="c-fn">COALESCE</span>(<span class="c-var">p</span>.<span class="c-var">total_paid</span>,  <span class="c-num">0</span>) <span class="c-key">AS</span> <span class="c-var">total_paid</span>
<span class="c-key">FROM</span> <span class="c-type">users</span> <span class="c-var">u</span>
<span class="c-key">LEFT JOIN</span> (<span class="c-key">SELECT</span> <span class="c-var">user_id</span>, <span class="c-fn">COUNT</span>(*) <span class="c-key">AS</span> <span class="c-var">orders_count</span> <span class="c-key">FROM</span> <span class="c-type">orders</span>   <span class="c-key">GROUP BY</span> <span class="c-var">user_id</span>) <span class="c-var">o</span> <span class="c-key">ON</span> <span class="c-var">o</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>
<span class="c-key">LEFT JOIN</span> (<span class="c-key">SELECT</span> <span class="c-var">user_id</span>, <span class="c-fn">SUM</span>(<span class="c-var">amount</span>) <span class="c-key">AS</span> <span class="c-var">total_paid</span>   <span class="c-key">FROM</span> <span class="c-type">payments</span> <span class="c-key">GROUP BY</span> <span class="c-var">user_id</span>) <span class="c-var">p</span> <span class="c-key">ON</span> <span class="c-var">p</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>;
</code></pre>
    <p class="text">В первом запросе пользователь с 3 заказами и 5 платежами породит 15 строк, и каждый платёж попадёт в SUM трижды. Это математика декартова произведения, в которое мы сами загнали запрос.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>WHERE</code> убивает LEFT JOIN.</strong> Условие <code>WHERE right_table.col = 'X'</code> отфильтрует строки, где правая часть NULL &mdash; превращая LEFT JOIN в INNER. Условия на правую таблицу выносите в <code>ON</code>.</div>
    <div class="pitfall"><strong>2. <code>NOT IN</code> с NULL.</strong> Если подзапрос вернёт хотя бы один NULL, весь предикат становится UNKNOWN, и запрос вернёт пустоту. Используйте <code>NOT EXISTS</code>.</div>
    <div class="pitfall"><strong>3. CROSS JOIN по ошибке.</strong> Забытое условие <code>ON</code> превращает запрос в декартово произведение.</div>
    <div class="pitfall"><strong>4. JOIN с подзапросом без индекса.</strong> СУБД материализует подзапрос как временную таблицу без индексов; JOIN становится медленным.</div>
    <div class="pitfall"><strong>5. Несовпадение типов в JOIN.</strong> BIGINT vs VARCHAR &mdash; неявное приведение типов на каждой строке, индекс не используется.</div>
    <div class="pitfall"><strong>6. <code>USING(col)</code> vs <code>ON</code>.</strong> <code>USING</code> требует одинаковых имён столбцов в обеих таблицах и ломается при переименовании.</div>
    <div class="pitfall"><strong>7. Самосоединение без алиасов.</strong> Каждое вхождение таблицы в JOIN требует уникального алиаса.</div>
    <div class="pitfall"><strong>8. RIGHT JOIN в чужом коде.</strong> Обычно исторический артефакт; переписывание на LEFT JOIN делает запрос читаемее.</div>
  </div>
</div>

<div id="sec-indexes" class="section">
  <div class="section-title">Индексы: типы, leftmost rule, covering</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Индекс &mdash; вспомогательная структура данных, позволяющая СУБД находить строки по значениям атрибутов без полного сканирования таблицы. Без индексов запрос <code>WHERE email = ?</code> на таблице в миллион строк требует прочитать миллион строк. С индексом &mdash; ~20 операций обращения к B-Tree. Понимание индексов отличает middle от junior и определяет, почему один запрос выполняется за 20 мс, а похожий &mdash; за 4 секунды.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Виды индексов</div>
    <div class="card"><h3>B-Tree (B+Tree)</h3><p class="text">Самый распространённый тип. Сбалансированное дерево с листьями, хранящими ключи и указатели. Поддерживает поиск по равенству, диапазон, сортировку, LIKE с фиксированным префиксом. Не работает для <code>LIKE '%foo'</code>.</p></div>
    <div class="card"><h3>Hash</h3><p class="text">Хеш-таблица: O(1) для поиска по равенству, не поддерживает диапазон и сортировку. MySQL InnoDB &mdash; adaptive hash index автоматически. PostgreSQL HASH index &mdash; редко используется.</p></div>
    <div class="card"><h3>GIN (Postgres)</h3><p class="text">Индекс по содержимому составных значений: массив, JSON, tsvector. Подходит для <code>WHERE tags @&gt; ARRAY['php']</code> или <code>WHERE jsonb_col @&gt; '{"status":"active"}'</code>.</p></div>
    <div class="card"><h3>GiST / BRIN / SP-GiST (Postgres)</h3><p class="text">GiST &mdash; для геоданных и full-text. BRIN &mdash; для очень больших таблиц с естественным порядком (временные ряды): хранит min/max по блокам.</p></div>
    <div class="card"><h3>Partial index</h3><p class="text">Индекс с условием: <code>CREATE INDEX ON orders(user_id) WHERE status = 'pending'</code>. Хранит только строки, удовлетворяющие условию.</p></div>
    <div class="card"><h3>Covering index</h3><p class="text">Содержит все колонки, нужные запросу &mdash; и WHERE, и SELECT. СУБД отвечает только данными из индекса, не обращаясь к таблице. Postgres: <code>INCLUDE</code>, MySQL: широкий композит.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Leftmost prefix rule</div>
    <p class="text">Композитный индекс <code>INDEX (a, b, c)</code> используется при запросах, фильтрующих по <code>a</code>, <code>(a, b)</code>, <code>(a, b, c)</code>. Не работает для <code>(b)</code>, <code>(c)</code>, <code>(b, c)</code>. Из этого следует основа дизайна композитных индексов: первой ставится колонка, по которой чаще всего идёт точная фильтрация.</p>
<pre><code><span class="c-key">CREATE INDEX</span> <span class="c-var">idx</span> <span class="c-key">ON</span> <span class="c-type">orders</span> (<span class="c-var">user_id</span>, <span class="c-var">status</span>, <span class="c-var">created_at</span>);

<span class="c-comment">-- ✓ Используется полностью</span>
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">orders</span> <span class="c-key">WHERE</span> <span class="c-var">user_id</span> = <span class="c-num">42</span> <span class="c-key">AND</span> <span class="c-var">status</span> = <span class="c-str">'paid'</span> <span class="c-key">ORDER BY</span> <span class="c-var">created_at</span>;
<span class="c-comment">-- ✓ Используется по первой колонке</span>
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">orders</span> <span class="c-key">WHERE</span> <span class="c-var">user_id</span> = <span class="c-num">42</span>;
<span class="c-comment">-- ✗ НЕ используется: нет фильтра по user_id</span>
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">orders</span> <span class="c-key">WHERE</span> <span class="c-var">status</span> = <span class="c-str">'paid'</span>;
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Индексы на каждую колонку.</strong> Каждый INSERT/UPDATE обновляет все индексы &mdash; запись на широких таблицах с 20 индексами становится в разы медленнее.</div>
    <div class="pitfall"><strong>2. Низкоселективный индекс.</strong> Индекс по <code>gender</code> или <code>status</code> почти бесполезен. Эффективен только в композите с более селективной колонкой.</div>
    <div class="pitfall"><strong>3. Функция от колонки убивает индекс.</strong> <code>WHERE LOWER(email) = ?</code> &mdash; индекс по <code>email</code> не используется. Решение: функциональный индекс.</div>
    <div class="pitfall"><strong>4. Композит в неправильном порядке.</strong> Индекс <code>(created_at, user_id)</code> для <code>WHERE user_id = ?</code> не работает по leftmost rule.</div>
    <div class="pitfall"><strong>5. Индекс по большому VARCHAR.</strong> Огромный, медленный. Используйте префиксный индекс или функциональный hash.</div>
    <div class="pitfall"><strong>6. Дублирующиеся индексы.</strong> <code>(a)</code> и <code>(a, b)</code> &mdash; первый избыточен. Периодическая чистка экономит место и ускоряет запись.</div>
    <div class="pitfall"><strong>7. Индекс на FK без подумать.</strong> InnoDB создаёт автоматически, Postgres &mdash; нет. Удаление родителя становится full scan'ом дочерней таблицы.</div>
    <div class="pitfall"><strong>8. <code>FORCE INDEX</code> вместо понимания.</strong> Чинит симптом, скрывает причину. Через полгода изменения статистики сделают подсказку вредной.</div>
  </div>
</div>

<div id="sec-indexes-laravel" class="section">
  <div class="section-title">Индексы в Laravel: миграции и диагностика</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Eloquent-миграции абстрагируют создание индексов под все три основных СУБД одним DSL. На практике почти все индексы в Laravel-проектах объявляются именно через Schema Builder. Параллельно нужно уметь читать индексы со стороны БД и находить неиспользуемые/дубликаты &mdash; чистка таких индексов даёт ускорение записи без потерь для чтения.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Создание индексов в миграциях</div>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Database\Schema\Blueprint</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Schema</span>;

<span class="c-type">Schema</span>::<span class="c-fn">create</span>(<span class="c-str">'orders'</span>, <span class="c-key">function</span> (<span class="c-type">Blueprint</span> <span class="c-var">$table</span>) {
    <span class="c-var">$table</span>-&gt;<span class="c-fn">id</span>();
    <span class="c-var">$table</span>-&gt;<span class="c-fn">foreignId</span>(<span class="c-str">'user_id'</span>)-&gt;<span class="c-fn">constrained</span>()-&gt;<span class="c-fn">cascadeOnDelete</span>();
    <span class="c-var">$table</span>-&gt;<span class="c-fn">string</span>(<span class="c-str">'status'</span>, <span class="c-num">32</span>);
    <span class="c-var">$table</span>-&gt;<span class="c-fn">unsignedInteger</span>(<span class="c-str">'total_minor'</span>);
    <span class="c-var">$table</span>-&gt;<span class="c-fn">timestamps</span>();

    <span class="c-comment">// Одинокий индекс</span>
    <span class="c-var">$table</span>-&gt;<span class="c-fn">index</span>(<span class="c-str">'status'</span>);

    <span class="c-comment">// Композитный индекс</span>
    <span class="c-var">$table</span>-&gt;<span class="c-fn">index</span>([<span class="c-str">'user_id'</span>, <span class="c-str">'created_at'</span>], <span class="c-str">'idx_orders_user_created'</span>);

    <span class="c-comment">// Уникальный (одна колонка или композит)</span>
    <span class="c-var">$table</span>-&gt;<span class="c-fn">unique</span>([<span class="c-str">'user_id'</span>, <span class="c-str">'external_ref'</span>]);

    <span class="c-comment">// Full-text (MySQL)</span>
    <span class="c-var">$table</span>-&gt;<span class="c-fn">fullText</span>([<span class="c-str">'title'</span>, <span class="c-str">'description'</span>]);
});

<span class="c-comment">// Добавить индекс в существующую таблицу</span>
<span class="c-type">Schema</span>::<span class="c-fn">table</span>(<span class="c-str">'orders'</span>, <span class="c-key">fn</span> (<span class="c-type">Blueprint</span> <span class="c-var">$t</span>) =&gt;
    <span class="c-var">$t</span>-&gt;<span class="c-fn">index</span>(<span class="c-str">'paid_at'</span>));

<span class="c-comment">// Удалить — по имени (всегда работает) или по колонкам</span>
<span class="c-type">Schema</span>::<span class="c-fn">table</span>(<span class="c-str">'orders'</span>, <span class="c-key">function</span> (<span class="c-type">Blueprint</span> <span class="c-var">$t</span>) {
    <span class="c-var">$t</span>-&gt;<span class="c-fn">dropIndex</span>(<span class="c-str">'idx_orders_user_created'</span>);   <span class="c-comment">// по имени</span>
    <span class="c-var">$t</span>-&gt;<span class="c-fn">dropIndex</span>([<span class="c-str">'user_id'</span>, <span class="c-str">'created_at'</span>]); <span class="c-comment">// Laravel сгенерирует имя</span>
    <span class="c-var">$t</span>-&gt;<span class="c-fn">dropUnique</span>(<span class="c-str">'orders_user_id_external_ref_unique'</span>);
    <span class="c-var">$t</span>-&gt;<span class="c-fn">dropForeign</span>([<span class="c-str">'user_id'</span>]);
});
</code></pre>

    <table class="data-table">
      <tr><th>Метод</th><th>Что делает</th></tr>
      <tr><td><code>$t-&gt;index($cols)</code></td><td>Обычный B-Tree</td></tr>
      <tr><td><code>$t-&gt;unique($cols)</code></td><td>Уникальный + индекс одновременно</td></tr>
      <tr><td><code>$t-&gt;fullText($cols)</code></td><td>FULLTEXT (MySQL/PG)</td></tr>
      <tr><td><code>$t-&gt;spatialIndex($col)</code></td><td>Для геоданных (MySQL)</td></tr>
      <tr><td><code>$t-&gt;foreignId('x')-&gt;constrained()</code></td><td>FK + индекс автоматически</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="search"></i> Диагностика: какие индексы есть, какие не используются</div>

    <p class="text"><strong>MySQL</strong>:</p>
<pre><code><span class="c-comment">-- Все индексы таблицы</span>
<span class="c-key">SHOW INDEX FROM</span> <span class="c-type">orders</span>;

<span class="c-comment">-- Неиспользуемые индексы (требуется sys schema)</span>
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">sys</span>.<span class="c-var">schema_unused_indexes</span>
<span class="c-key">WHERE</span> <span class="c-var">object_schema</span> = <span class="c-str">'shop'</span>;

<span class="c-comment">-- Дубликаты/избыточные</span>
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">sys</span>.<span class="c-var">schema_redundant_indexes</span>
<span class="c-key">WHERE</span> <span class="c-var">table_schema</span> = <span class="c-str">'shop'</span>;

<span class="c-comment">-- Размеры индексов</span>
<span class="c-key">SELECT</span> <span class="c-var">database_name</span>, <span class="c-var">table_name</span>, <span class="c-var">index_name</span>,
       <span class="c-fn">SUM</span>(<span class="c-var">stat_value</span>) * <span class="c-num">16</span> <span class="c-key">AS</span> <span class="c-var">size_kb</span>
<span class="c-key">FROM</span> <span class="c-type">mysql</span>.<span class="c-var">innodb_index_stats</span>
<span class="c-key">WHERE</span> <span class="c-var">stat_name</span> = <span class="c-str">'size'</span>
<span class="c-key">GROUP BY</span> <span class="c-var">database_name</span>, <span class="c-var">table_name</span>, <span class="c-var">index_name</span>;
</code></pre>

    <p class="text"><strong>PostgreSQL</strong>:</p>
<pre><code><span class="c-comment">-- Все индексы таблицы</span>
\d <span class="c-type">orders</span>

<span class="c-comment">-- Статистика использования</span>
<span class="c-key">SELECT</span> <span class="c-var">schemaname</span>, <span class="c-var">tablename</span>, <span class="c-var">indexname</span>,
       <span class="c-var">idx_scan</span>,                  <span class="c-comment">-- сколько раз использовался</span>
       <span class="c-var">idx_tup_read</span>, <span class="c-var">idx_tup_fetch</span>
<span class="c-key">FROM</span> <span class="c-var">pg_stat_user_indexes</span>
<span class="c-key">WHERE</span> <span class="c-var">schemaname</span> = <span class="c-str">'public'</span>
<span class="c-key">ORDER BY</span> <span class="c-var">idx_scan</span> <span class="c-key">ASC</span>; <span class="c-comment">-- наверху — самые неиспользуемые</span>

<span class="c-comment">-- Размер индексов</span>
<span class="c-key">SELECT</span> <span class="c-var">indexname</span>, <span class="c-fn">pg_size_pretty</span>(<span class="c-fn">pg_relation_size</span>(<span class="c-var">indexname</span>::<span class="c-key">regclass</span>)) <span class="c-key">AS</span> <span class="c-var">size</span>
<span class="c-key">FROM</span> <span class="c-var">pg_indexes</span>
<span class="c-key">WHERE</span> <span class="c-var">schemaname</span> = <span class="c-str">'public'</span>
<span class="c-key">ORDER BY</span> <span class="c-fn">pg_relation_size</span>(<span class="c-var">indexname</span>::<span class="c-key">regclass</span>) <span class="c-key">DESC</span>;
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> EXPLAIN через Laravel</div>
<pre><code><span class="c-comment">// Включить лог всех запросов</span>
<span class="c-type">DB</span>::<span class="c-fn">enableQueryLog</span>();

<span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'email'</span>, <span class="c-str">'a@example.com'</span>)-&gt;<span class="c-fn">first</span>();

<span class="c-fn">dd</span>(<span class="c-type">DB</span>::<span class="c-fn">getQueryLog</span>());
<span class="c-comment">// [['query' =&gt; 'select * from users where email = ?', 'bindings' =&gt; ['a@...'], 'time' =&gt; 0.3]]</span>

<span class="c-comment">// EXPLAIN для конкретного запроса</span>
<span class="c-var">$plan</span> = <span class="c-type">DB</span>::<span class="c-fn">select</span>(<span class="c-str">'EXPLAIN SELECT * FROM users WHERE email = ?'</span>, [<span class="c-str">'a@example.com'</span>]);
<span class="c-fn">dump</span>(<span class="c-var">$plan</span>);

<span class="c-comment">// Получить SQL из Eloquent без выполнения</span>
<span class="c-var">$sql</span> = <span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'active'</span>)-&gt;<span class="c-fn">toSql</span>();
<span class="c-comment">// "select * from `users` where `status` = ?"</span>
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="trending-up"></i> Trade-off: read vs write</div>
    <table class="data-table">
      <tr><th>Тип проекта</th><th>Read/Write</th><th>Индексы</th></tr>
      <tr><td>E-commerce, блог, CMS</td><td>Чтение &gt;&gt; запись</td><td>Много индексов; читателю &mdash; всё нужное</td></tr>
      <tr><td>Логирование, аналитика insert-only</td><td>Запись доминирует</td><td>Минимум индексов: один PK + 1-2 для редких запросов</td></tr>
      <tr><td>OLTP (заказы, платежи)</td><td>~50/50</td><td>Узкие точечные индексы под конкретные запросы</td></tr>
      <tr><td>IoT, телеметрия</td><td>Write-heavy</td><td>BRIN-индексы на timestamp + partitioning</td></tr>
      <tr><td>Биржи, real-time</td><td>Высокая запись, частое чтение последнего</td><td>Минимальные индексы + специальные структуры (Redis sorted sets)</td></tr>
    </table>
    <p class="text">Эмпирика: добавление каждого индекса замедляет INSERT/UPDATE/DELETE на 5-15%. На таблице с 10 индексами запись в 2-3 раза медленнее, чем без индексов. Перед добавлением индекса задайте вопрос: «какой <em>конкретный</em> запрос он ускоряет?» Если ответа нет &mdash; индекс не нужен.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>foreignId()-&gt;constrained()</code> и lock на ALTER.</strong> Создание FK на большой таблице блокирует обе. Делайте отдельной миграцией ночью либо используйте <code>NOCHECK</code>.</div>
    <div class="pitfall"><strong>2. Миграция с <code>index</code> на проде.</strong> Создание индекса на 100M строк блокирует таблицу. <code>CREATE INDEX CONCURRENTLY</code> в Postgres или <code>pt-osc</code> для MySQL.</div>
    <div class="pitfall"><strong>3. <code>dropIndex</code> по массиву колонок и переименование.</strong> Если индекс был создан с явным именем, удаление по колонкам не сработает. Удаляйте по имени.</div>
    <div class="pitfall"><strong>4. <code>down()</code> миграции без обратного индекса.</strong> При откате индекс остаётся. Всегда зеркальный <code>down()</code>.</div>
    <div class="pitfall"><strong>5. <code>DB::enableQueryLog</code> на проде.</strong> Лог копится в памяти на каждом запросе. Включайте локально или временно с осторожностью.</div>
    <div class="pitfall"><strong>6. <code>fullText</code> только в MyISAM до MySQL 5.6.</strong> Если получили ошибку &mdash; обновите MySQL или переходите на ElasticSearch/Meilisearch.</div>
    <div class="pitfall"><strong>7. Удаление неиспользуемого индекса в спешке.</strong> Прежде чем удалять &mdash; проверьте, что <code>idx_scan = 0</code> в течение месяца, а не часа. Сезонные запросы (отчёты раз в квартал) тоже используют индексы.</div>
    <div class="pitfall"><strong>8. Дублирующиеся индексы из-за <code>unique</code>.</strong> <code>$t-&gt;unique(['a'])</code> создаёт уникальный индекс по a. <code>$t-&gt;index('a')</code> рядом &mdash; избыточный. Уникальный уже покрывает.</div>
  </div>
</div>

<div id="sec-explain" class="section">
  <div class="section-title">EXPLAIN: чтение плана запроса</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text"><code>EXPLAIN</code> показывает план выполнения запроса. <code>EXPLAIN ANALYZE</code> дополнительно реально исполняет запрос и показывает <em>фактическое</em> время и количество строк. Расхождение ожидаемого и фактического указывает на устаревшую статистику или неверные оценки.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Что искать в плане</div>
    <div class="card"><h3>Тип сканирования</h3><p class="text">MySQL: <code>const</code> &lt; <code>ref</code> &lt; <code>range</code> &lt; <code>index</code> &lt; <code>ALL</code>. Postgres: Index Scan, Index Only Scan, Bitmap Heap Scan, Seq Scan. Seq Scan на большой таблице &mdash; первый кандидат на индекс.</p></div>
    <div class="card"><h3>Количество строк</h3><p class="text">Расхождение оценки и фактического в 10+ раз указывает на устаревшую статистику &mdash; запустите <code>ANALYZE table_name</code>.</p></div>
    <div class="card"><h3>Использование индекса</h3><p class="text">MySQL <code>key = NULL</code> &mdash; индекс не используется. Postgres <code>Filter</code> &mdash; что фильтруется после индексного скана.</p></div>
    <div class="card"><h3>JOIN-стратегия</h3><p class="text">Nested Loop &mdash; быстрый для маленькой внутренней таблицы. Hash Join &mdash; для больших таблиц без индексов. Merge Join &mdash; обе стороны отсортированы.</p></div>
    <div class="card"><h3>Лишние операции</h3><p class="text"><code>Using filesort</code>, <code>Sort</code> в плане &mdash; СУБД сортирует на лету без подходящего индекса. <code>Using temporary</code> &mdash; материализация. На больших данных оба &mdash; красный флаг.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="bar-chart-3"></i> Иерархия <code>type</code> в MySQL (от худшего к лучшему)</div>
    <table class="data-table">
      <tr><th>type</th><th>Что значит</th><th>Хорошо/плохо</th></tr>
      <tr><td><code>ALL</code></td><td>Full table scan &mdash; все строки</td><td>❌ Плохо на больших таблицах</td></tr>
      <tr><td><code>index</code></td><td>Full index scan &mdash; все строки индекса</td><td>❌ Не быстрее ALL</td></tr>
      <tr><td><code>range</code></td><td>Диапазон по индексу (<code>BETWEEN</code>, <code>&gt;</code>, <code>IN</code>)</td><td>✓ Приемлемо</td></tr>
      <tr><td><code>ref</code></td><td>Поиск по неуникальному индексу (несколько строк)</td><td>✓ Хорошо</td></tr>
      <tr><td><code>eq_ref</code></td><td>Поиск по уникальному индексу для JOIN (одна строка)</td><td>✓✓ Отлично</td></tr>
      <tr><td><code>const</code></td><td>Найдена ровно одна строка через PK/UNIQUE</td><td>✓✓✓ Идеал</td></tr>
      <tr><td><code>system</code></td><td>Таблица с одной строкой</td><td>Особый случай</td></tr>
    </table>
    <p class="text">Правило: если в плане <code>type=ALL</code> или <code>type=index</code> на большой таблице &mdash; вы ещё не закончили оптимизацию. Стремитесь к <code>ref</code> или лучше для всех «горячих» запросов.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="history"></i> Старый SQL-89 синтаксис vs ANSI JOIN</div>
<pre><code><span class="c-comment">-- Старый стиль (SQL-89): запятая в FROM, условия в WHERE</span>
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">users</span>, <span class="c-type">orders</span>
<span class="c-key">WHERE</span> <span class="c-var">orders</span>.<span class="c-var">user_id</span> = <span class="c-var">users</span>.<span class="c-var">id</span>;

<span class="c-comment">-- Современный (ANSI): явный JOIN</span>
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">users</span>
<span class="c-key">JOIN</span> <span class="c-type">orders</span> <span class="c-key">ON</span> <span class="c-var">orders</span>.<span class="c-var">user_id</span> = <span class="c-var">users</span>.<span class="c-var">id</span>;
</code></pre>
    <p class="text">Опасность старого синтаксиса: <strong>забыл условие в WHERE</strong> → CROSS JOIN. Запрос <code>FROM users, orders</code> без WHERE на миллион пользователей и миллион заказов вернёт триллион строк. ANSI JOIN требует явный ON &mdash; забыть невозможно.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: чтение плана</div>
<pre><code><span class="c-key">EXPLAIN ANALYZE</span>
<span class="c-key">SELECT</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-fn">SUM</span>(<span class="c-var">o</span>.<span class="c-var">total_minor</span>) <span class="c-key">AS</span> <span class="c-var">total</span>
<span class="c-key">FROM</span> <span class="c-type">users</span> <span class="c-var">u</span>
<span class="c-key">JOIN</span> <span class="c-type">orders</span> <span class="c-var">o</span> <span class="c-key">ON</span> <span class="c-var">o</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>
<span class="c-key">WHERE</span> <span class="c-var">o</span>.<span class="c-var">created_at</span> &gt;= <span class="c-str">'2026-04-01'</span>
<span class="c-key">GROUP BY</span> <span class="c-var">u</span>.<span class="c-var">id</span>
<span class="c-key">ORDER BY</span> <span class="c-var">total</span> <span class="c-key">DESC</span>
<span class="c-key">LIMIT</span> <span class="c-num">10</span>;

<span class="c-comment">-- Postgres plan (упрощённо):</span>
Limit  (actual time=<span class="c-num">120.4</span>..<span class="c-num">120.5</span>)
  -&gt;  Sort
        -&gt;  HashAggregate
              -&gt;  Hash Join
                    Hash Cond: (o.user_id = u.id)
                    -&gt;  Index Scan using idx_orders_created_at on orders o
                    -&gt;  Seq Scan on users u  ← полное сканирование users
</code></pre>
    <p class="text">План говорит: индекс по <code>orders.created_at</code> подобран, но затем для JOIN сделан Seq Scan по 100к users. Решение &mdash; убедиться, что <code>users.id</code> &mdash; PK (всегда индексирован), либо подсказать оптимизатору через <code>SET enable_seqscan = off</code> для сравнения.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. EXPLAIN без ANALYZE.</strong> Чистый <code>EXPLAIN</code> &mdash; оценка; ANALYZE &mdash; факт. На production-данных оценка может расходиться на порядки.</div>
    <div class="pitfall"><strong>2. ANALYZE для UPDATE/DELETE.</strong> Реально выполнит UPDATE. Оберните в <code>BEGIN; ... ROLLBACK;</code>.</div>
    <div class="pitfall"><strong>3. Устаревшая статистика.</strong> После массового импорта/удаления запустите <code>ANALYZE table_name</code>.</div>
    <div class="pitfall"><strong>4. План отличается между prod и staging.</strong> Объёмы данных разные &mdash; оптимизатор выбирает разные планы. Анализируйте на реальных объёмах.</div>
    <div class="pitfall"><strong>5. <code>type=index</code> в MySQL.</strong> Это full scan индекса, не быстрее <code>type=ALL</code>. Реально быстрые: <code>const</code>, <code>ref</code>, <code>range</code>.</div>
    <div class="pitfall"><strong>6. Filter после Index Scan.</strong> СУБД нашла строки через индекс, но фильтрует по условию, которое индекс не покрывает. Рассмотрите расширение индекса.</div>
    <div class="pitfall"><strong>7. <code>Materialize</code> в Postgres.</strong> Часто свидетельство неоптимального плана. Перепишите через JOIN.</div>
    <div class="pitfall"><strong>8. План в production меняется со временем.</strong> Объёмы растут, оптимизатор переключается. Мониторьте slow query log.</div>
  </div>
</div>

<div id="sec-subqueries" class="section">
  <div class="section-title">Подзапросы: correlated vs uncorrelated</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Подзапрос &mdash; SELECT внутри SELECT. На вид одно и то же, но за этим скрыты два принципиально разных механизма: <strong>uncorrelated</strong> (независимый, выполняется один раз) и <strong>correlated</strong> (зависит от строки внешнего запроса, выполняется N раз). Непонимание разницы превращает безобидный запрос в N+1 на уровне SQL.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Два вида подзапросов</div>

    <div class="card">
      <h3>Uncorrelated &mdash; независимый</h3>
      <p class="text">Подзапрос не ссылается на колонки внешнего. СУБД выполняет его <strong>один раз</strong>, результат используется во внешнем.</p>
<pre><code><span class="c-comment">-- Один SELECT для подзапроса, один для внешнего</span>
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">orders</span>
<span class="c-key">WHERE</span> <span class="c-var">user_id</span> <span class="c-key">IN</span> (
    <span class="c-key">SELECT</span> <span class="c-var">id</span> <span class="c-key">FROM</span> <span class="c-type">users</span> <span class="c-key">WHERE</span> <span class="c-var">country</span> = <span class="c-str">'KZ'</span>
);
</code></pre>
    </div>

    <div class="card">
      <h3>Correlated &mdash; зависимый (опасный)</h3>
      <p class="text">Подзапрос ссылается на колонку внешнего. СУБД выполняет его <strong>для каждой строки</strong> внешнего. На 1000 строк &mdash; 1001 SELECT.</p>
<pre><code><span class="c-comment">-- ❌ N+1 на уровне SQL: SELECT users — 1, SELECT MAX — для каждого user</span>
<span class="c-key">SELECT</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-var">u</span>.<span class="c-var">email</span>,
       (<span class="c-key">SELECT</span> <span class="c-fn">MAX</span>(<span class="c-var">created_at</span>) <span class="c-key">FROM</span> <span class="c-type">orders</span> <span class="c-key">WHERE</span> <span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>) <span class="c-key">AS</span> <span class="c-var">last_order</span>
<span class="c-key">FROM</span> <span class="c-type">users</span> <span class="c-var">u</span>;
</code></pre>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Три способа оптимизации correlated</div>

    <p class="text"><strong>1. JOIN + GROUP BY</strong> &mdash; одна сортировка вместо N запросов:</p>
<pre><code><span class="c-key">SELECT</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-var">u</span>.<span class="c-var">email</span>, <span class="c-fn">MAX</span>(<span class="c-var">o</span>.<span class="c-var">created_at</span>) <span class="c-key">AS</span> <span class="c-var">last_order</span>
<span class="c-key">FROM</span> <span class="c-type">users</span> <span class="c-var">u</span>
<span class="c-key">LEFT JOIN</span> <span class="c-type">orders</span> <span class="c-var">o</span> <span class="c-key">ON</span> <span class="c-var">o</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>
<span class="c-key">GROUP BY</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-var">u</span>.<span class="c-var">email</span>;
</code></pre>

    <p class="text"><strong>2. CTE с предварительной агрегацией</strong> &mdash; читается лучше:</p>
<pre><code><span class="c-key">WITH</span> <span class="c-var">last_orders</span> <span class="c-key">AS</span> (
    <span class="c-key">SELECT</span> <span class="c-var">user_id</span>, <span class="c-fn">MAX</span>(<span class="c-var">created_at</span>) <span class="c-key">AS</span> <span class="c-var">ts</span>
    <span class="c-key">FROM</span> <span class="c-type">orders</span> <span class="c-key">GROUP BY</span> <span class="c-var">user_id</span>
)
<span class="c-key">SELECT</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-var">u</span>.<span class="c-var">email</span>, <span class="c-var">lo</span>.<span class="c-var">ts</span> <span class="c-key">AS</span> <span class="c-var">last_order</span>
<span class="c-key">FROM</span> <span class="c-type">users</span> <span class="c-var">u</span> <span class="c-key">LEFT JOIN</span> <span class="c-var">last_orders</span> <span class="c-var">lo</span> <span class="c-key">ON</span> <span class="c-var">lo</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>;
</code></pre>

    <p class="text"><strong>3. Window function</strong> &mdash; если нужна не только агрегация, а вся строка последнего заказа:</p>
<pre><code><span class="c-key">SELECT</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-var">u</span>.<span class="c-var">email</span>, <span class="c-var">o</span>.<span class="c-var">id</span> <span class="c-key">AS</span> <span class="c-var">last_order_id</span>, <span class="c-var">o</span>.<span class="c-var">total_minor</span>
<span class="c-key">FROM</span> <span class="c-type">users</span> <span class="c-var">u</span>
<span class="c-key">LEFT JOIN</span> (
    <span class="c-key">SELECT</span> *, <span class="c-fn">ROW_NUMBER</span>() <span class="c-key">OVER</span> (<span class="c-key">PARTITION BY</span> <span class="c-var">user_id</span> <span class="c-key">ORDER BY</span> <span class="c-var">created_at</span> <span class="c-key">DESC</span>) <span class="c-key">AS</span> <span class="c-var">rn</span>
    <span class="c-key">FROM</span> <span class="c-type">orders</span>
) <span class="c-var">o</span> <span class="c-key">ON</span> <span class="c-var">o</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span> <span class="c-key">AND</span> <span class="c-var">o</span>.<span class="c-var">rn</span> = <span class="c-num">1</span>;
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> EXISTS vs IN</div>
    <p class="text">Оба проверяют «есть ли совпадение», но реализованы по-разному. <code>IN</code> вычисляет полный список и сравнивает; <code>EXISTS</code> останавливается на первом совпадении.</p>

<pre><code><span class="c-comment">-- IN: подзапрос материализует все user_id, потом проверяет членство</span>
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">users</span>
<span class="c-key">WHERE</span> <span class="c-var">id</span> <span class="c-key">IN</span> (<span class="c-key">SELECT</span> <span class="c-var">user_id</span> <span class="c-key">FROM</span> <span class="c-type">orders</span>);

<span class="c-comment">-- EXISTS: для каждой строки внешнего ищет хотя бы одно совпадение, выходит на первом</span>
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">users</span> <span class="c-var">u</span>
<span class="c-key">WHERE EXISTS</span> (<span class="c-key">SELECT</span> <span class="c-num">1</span> <span class="c-key">FROM</span> <span class="c-type">orders</span> <span class="c-key">WHERE</span> <span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>);
</code></pre>

    <p class="text">Современные оптимизаторы часто приводят эти запросы к одному плану, но есть два кейса, где разница остаётся:</p>
    <ul class="bullets">
      <li><code>NOT IN</code> с NULL &mdash; ломается (см. JOIN-pitfalls); <code>NOT EXISTS</code> корректно;</li>
      <li>Большой подзапрос &mdash; <code>EXISTS</code> часто эффективнее, поскольку не материализует весь список.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="link"></i> Цепочки CTE</div>
    <p class="text">CTE можно последовательно цепочкой &mdash; каждый шаг видит результат предыдущего. Это лучший способ записать многошаговую логику читаемо.</p>

<pre><code><span class="c-key">WITH</span>
<span class="c-var">recent_orders</span> <span class="c-key">AS</span> (
    <span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">orders</span> <span class="c-key">WHERE</span> <span class="c-var">created_at</span> &gt;= <span class="c-fn">NOW</span>() - <span class="c-key">INTERVAL</span> <span class="c-str">'30 days'</span>
),
<span class="c-var">user_totals</span> <span class="c-key">AS</span> (
    <span class="c-key">SELECT</span> <span class="c-var">user_id</span>, <span class="c-fn">SUM</span>(<span class="c-var">total_minor</span>) <span class="c-key">AS</span> <span class="c-var">total</span>, <span class="c-fn">COUNT</span>(*) <span class="c-key">AS</span> <span class="c-var">cnt</span>
    <span class="c-key">FROM</span> <span class="c-var">recent_orders</span> <span class="c-key">GROUP BY</span> <span class="c-var">user_id</span>
),
<span class="c-var">ranked</span> <span class="c-key">AS</span> (
    <span class="c-key">SELECT</span> *, <span class="c-fn">RANK</span>() <span class="c-key">OVER</span> (<span class="c-key">ORDER BY</span> <span class="c-var">total</span> <span class="c-key">DESC</span>) <span class="c-key">AS</span> <span class="c-var">rk</span>
    <span class="c-key">FROM</span> <span class="c-var">user_totals</span>
)
<span class="c-key">SELECT</span> <span class="c-var">u</span>.<span class="c-var">email</span>, <span class="c-var">r</span>.<span class="c-var">total</span>, <span class="c-var">r</span>.<span class="c-var">cnt</span>, <span class="c-var">r</span>.<span class="c-var">rk</span>
<span class="c-key">FROM</span> <span class="c-var">ranked</span> <span class="c-var">r</span> <span class="c-key">JOIN</span> <span class="c-type">users</span> <span class="c-var">u</span> <span class="c-key">ON</span> <span class="c-var">u</span>.<span class="c-var">id</span> = <span class="c-var">r</span>.<span class="c-var">user_id</span>
<span class="c-key">WHERE</span> <span class="c-var">r</span>.<span class="c-var">rk</span> &lt;= <span class="c-num">10</span>;
</code></pre>

    <p class="text">До Postgres 12 каждый CTE был «оптимизационным барьером» &mdash; план не оптимизировался сквозь него. С 12+ &mdash; inline по умолчанию; явная материализация через <code>WITH foo AS MATERIALIZED (...)</code>.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Correlated в SELECT.</strong> Самый частый случай: подзапрос в выводе столбца &mdash; почти всегда correlated. Переписывайте на JOIN.</div>
    <div class="pitfall"><strong>2. <code>NOT IN</code> с NULL.</strong> Если подзапрос вернёт хотя бы один NULL, весь предикат становится UNKNOWN; внешний запрос вернёт пусто. <code>NOT EXISTS</code> работает корректно.</div>
    <div class="pitfall"><strong>3. <code>SELECT * FROM (...) AS sub WHERE rn = 1</code> &mdash; дёшево только с индексом.</strong> Window-функция требует сортировки внутри партиции. На больших данных без подходящего индекса &mdash; всё равно дорого.</div>
    <div class="pitfall"><strong>4. CTE как замена View.</strong> CTE существует только в рамках одного запроса. Для повторно используемого &mdash; <code>CREATE VIEW</code> или <code>MATERIALIZED VIEW</code>.</div>
    <div class="pitfall"><strong>5. Рекурсивный CTE без терминатора.</strong> Цикл в данных (категория → родитель → ... → она же) &mdash; бесконечная рекурсия. Защита: <code>WHERE depth &lt; 10</code>.</div>
    <div class="pitfall"><strong>6. <code>WHERE col IN (SELECT ... ORDER BY ... LIMIT 10)</code>.</strong> Многие СУБД игнорируют LIMIT в подзапросе IN. Используйте JOIN с подзапросом.</div>
    <div class="pitfall"><strong>7. Подзапрос в JOIN без индекса на соединяющую колонку.</strong> Материализуется во временную таблицу без индексов. На больших данных &mdash; full scan.</div>
    <div class="pitfall"><strong>8. EXISTS в IF.</strong> <code>IF EXISTS (SELECT ...)</code> в PL/pgSQL/T-SQL &mdash; быстро. В обычном SELECT EXISTS используется как булев предикат WHERE.</div>
  </div>
</div>

<div id="sec-nplus1" class="section">
  <div class="section-title">N+1 и стратегии решения</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">N+1 &mdash; антипаттерн, когда вместо одного запроса с JOIN-ом приложение делает 1 запрос на список родителей и N запросов на связанные данные. Типичный сценарий в Laravel: выборка 50 заказов и цикл с обращением к <code>$order-&gt;user</code> &mdash; 1 + 50 запросов. Каждый запрос &mdash; round-trip к БД, суммарно тысячи мс там, где могло быть 20.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Стратегии решения</div>
    <div class="card"><h3>Eager loading: <code>with(...)</code></h3><p class="text">Eloquent делает 2 запроса: SELECT родителей, затем SELECT детей <code>WHERE parent_id IN (...)</code>. Вместо N+1 &mdash; 2.</p></div>
    <div class="card"><h3>JOIN на уровне SQL</h3><p class="text">Один запрос с JOIN. Один round-trip, но при HasMany строки родителя дублируются.</p></div>
    <div class="card"><h3>Window functions для агрегатов</h3><p class="text">«Топ-N по группе» &mdash; одним запросом через <code>ROW_NUMBER() OVER (PARTITION BY ...)</code>.</p></div>
    <div class="card"><h3>Денормализованный кеш</h3><p class="text">Агрегат (<code>orders_count</code>) на родителе. Чтение за одно обращение; запись дороже.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: четыре подхода</div>
<pre><code><span class="c-comment">// ❌ Классический N+1: 51 запрос</span>
<span class="c-var">$orders</span> = <span class="c-type">Order</span>::<span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'paid'</span>)-&gt;<span class="c-fn">limit</span>(<span class="c-num">50</span>)-&gt;<span class="c-fn">get</span>();
<span class="c-key">foreach</span> (<span class="c-var">$orders</span> <span class="c-key">as</span> <span class="c-var">$order</span>) {
    <span class="c-fn">echo</span> <span class="c-var">$order</span>-&gt;<span class="c-var">user</span>-&gt;<span class="c-var">name</span>; <span class="c-comment">// каждое обращение — SQL-запрос</span>
}

<span class="c-comment">// ✓ Eager loading: 2 запроса</span>
<span class="c-var">$orders</span> = <span class="c-type">Order</span>::<span class="c-fn">with</span>(<span class="c-str">'user'</span>)-&gt;<span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'paid'</span>)-&gt;<span class="c-fn">limit</span>(<span class="c-num">50</span>)-&gt;<span class="c-fn">get</span>();

<span class="c-comment">// ✓ Через JOIN (query builder): 1 запрос</span>
<span class="c-var">$orders</span> = <span class="c-type">DB</span>::<span class="c-fn">table</span>(<span class="c-str">'orders'</span>)
    -&gt;<span class="c-fn">join</span>(<span class="c-str">'users'</span>, <span class="c-str">'users.id'</span>, <span class="c-str">'orders.user_id'</span>)
    -&gt;<span class="c-fn">select</span>(<span class="c-str">'orders.*'</span>, <span class="c-str">'users.name as user_name'</span>)
    -&gt;<span class="c-fn">get</span>();
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. N+1 в Resource/Transformer.</strong> Eloquent API Resource обращается к relationships &mdash; если не загружены, тихо генерирует N+1. Используйте <code>Model::preventLazyLoading()</code>.</div>
    <div class="pitfall"><strong>2. <code>preventLazyLoading</code> в проде.</strong> Включайте только в <code>local</code>/<code>testing</code>, либо <code>handleLazyLoadingViolationUsing</code> для логирования без падения.</div>
    <div class="pitfall"><strong>3. Eager loading огромных relationships.</strong> <code>Post::with('comments')</code> на 100 постах с 200 комментариями &mdash; 20к в памяти. Используйте <code>with(['comments' =&gt; fn ($q) =&gt; $q-&gt;limit(5)])</code>.</div>
    <div class="pitfall"><strong>4. JOIN вместо with без агрегации.</strong> JOIN дублирует строки родителя; для HasMany используйте with.</div>
    <div class="pitfall"><strong>5. Eager loading не работает после Get.</strong> Используйте <code>$orders-&gt;load('user')</code> для lazy eager load.</div>
    <div class="pitfall"><strong>6. Денормализованный счётчик без триггера.</strong> Между обновлениями &mdash; рассинхрон. Либо триггер, либо явное observer-обновление.</div>
    <div class="pitfall"><strong>7. N+1 в GraphQL.</strong> Каждое поле в резолвере может породить запрос. Решение &mdash; DataLoader (батчинг + кеш на запрос).</div>
    <div class="pitfall"><strong>8. <code>withWhereHas</code>.</strong> Метод в Laravel 9+ совмещает <code>whereHas</code> и <code>with</code> с одинаковым условием. Без него либо дублируете условие, либо получаете несогласованные данные.</div>
  </div>
</div>

<div id="sec-acid" class="section">
  <div class="section-title">ACID и уровни изоляции</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">ACID &mdash; набор гарантий, которые транзакционная СУБД даёт приложению: Atomicity (всё или ничего), Consistency (БД переходит между корректными состояниями), Isolation (параллельные транзакции не «видят» промежуточных результатов друг друга), Durability (commit &mdash; навсегда). Самая нетривиальная буква &mdash; <strong>Isolation</strong>: за неё отвечают уровни изоляции.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Уровни изоляции</div>
    <div class="card"><h3>READ UNCOMMITTED</h3><p class="text">Может читать незакоммиченные данные (dirty read). На практике почти не используется. Postgres не реализует &mdash; работает как READ COMMITTED.</p></div>
    <div class="card"><h3>READ COMMITTED</h3><p class="text">Видит только закоммиченные данные. Один SELECT внутри транзакции может возвращать разные результаты (non-repeatable read). Дефолт в Postgres.</p></div>
    <div class="card"><h3>REPEATABLE READ</h3><p class="text">Все чтения видят snapshot на момент начала транзакции. Phantom reads по стандарту допускаются, но Postgres исключает их через SSI. Дефолт в MySQL InnoDB.</p></div>
    <div class="card"><h3>SERIALIZABLE</h3><p class="text">Транзакции исполняются так, как если бы шли строго последовательно. В Postgres &mdash; через SSI; транзакции могут быть отменены с ошибкой <code>could_not_serialize</code>, требует retry-логики.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: lost update</div>
<pre><code><span class="c-comment">-- T1                              T2</span>
<span class="c-key">BEGIN</span>;                          <span class="c-key">BEGIN</span>;
<span class="c-key">SELECT</span> <span class="c-var">balance</span>...               <span class="c-key">SELECT</span> <span class="c-var">balance</span>...
<span class="c-comment">-- balance = 1000</span>             <span class="c-comment">-- balance = 1000</span>
<span class="c-key">UPDATE</span> <span class="c-key">SET</span> <span class="c-var">balance</span>=<span class="c-num">800</span>;       <span class="c-key">UPDATE</span> <span class="c-key">SET</span> <span class="c-var">balance</span>=<span class="c-num">900</span>;
<span class="c-key">COMMIT</span>;                          <span class="c-key">COMMIT</span>;
<span class="c-comment">-- T2 затёр T1: balance = 900 вместо 700</span>
</code></pre>
    <p class="text">Решения:</p>
    <ul class="bullets">
      <li><strong>Pessimistic locking</strong>: <code>SELECT ... FOR UPDATE</code> &mdash; блокировка строки до COMMIT.</li>
      <li><strong>Atomic UPDATE</strong>: <code>UPDATE SET balance = balance - 200 WHERE balance &gt;= 200</code>.</li>
      <li><strong>Optimistic locking</strong>: колонка <code>version</code>, <code>WHERE version = ?</code>, retry при конфликте.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Долгие транзакции.</strong> Удерживают блокировки и копят версии в MVCC. Postgres раздувается (bloat); MySQL копит row-level locks.</div>
    <div class="pitfall"><strong>2. SERIALIZABLE без retry.</strong> Ошибка <code>40001</code> без retry &mdash; пользователь видит 500. Оборачивайте критичные транзакции в retry-цикл.</div>
    <div class="pitfall"><strong>3. <code>DB::transaction()</code> в Laravel.</strong> Делает 1 попытку retry. Передавайте: <code>DB::transaction($fn, 3)</code>.</div>
    <div class="pitfall"><strong>4. Forgotten COMMIT.</strong> Открытая транзакция без COMMIT при exception оставляет блокировки. Используйте <code>DB::transaction()</code>.</div>
    <div class="pitfall"><strong>5. SELECT в транзакции REPEATABLE READ.</strong> Данные «замораживаются» до конца. Внешние изменения видны только после COMMIT.</div>
    <div class="pitfall"><strong>6. DDL внутри транзакции.</strong> Postgres &mdash; транзакционно. MySQL InnoDB до 8.0 &mdash; неявно коммитит перед DDL.</div>
    <div class="pitfall"><strong>7. Вложенные транзакции.</strong> Реализуются через savepoints. Внутренний ROLLBACK откатывает только до savepoint, внешний COMMIT может пройти.</div>
    <div class="pitfall"><strong>8. Read replicas и изоляция.</strong> Реплика отстаёт на секунды. Чтение с реплики видит устаревшие данные даже на SERIALIZABLE.</div>
  </div>
</div>

<div id="sec-engines" class="section">
  <div class="section-title">Движки хранения и InnoDB-внутренности</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">MySQL уникальна тем, что позволяет хранить разные таблицы в одной БД через разные «движки» (storage engines). У каждого &mdash; свои свойства: транзакции или нет, row-level или table-level locks, indexing, durability. Для современного приложения дефолт &mdash; InnoDB; понимание других движков нужно для редких специальных задач и для интервью.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Основные движки MySQL</div>
    <table class="data-table">
      <tr><th>Движок</th><th>Транзакции</th><th>Locks</th><th>Применение</th></tr>
      <tr><td><strong>InnoDB</strong></td><td>Да (ACID)</td><td>Row-level + MVCC</td><td>Дефолт; всё, что требует надёжности</td></tr>
      <tr><td><strong>MyISAM</strong></td><td>Нет</td><td>Table-level</td><td>Только legacy; до 5.5 был дефолтом, FULLTEXT</td></tr>
      <tr><td><strong>Memory</strong> (HEAP)</td><td>Нет</td><td>Table-level</td><td>Временные таблицы в RAM; сессии (но Redis лучше)</td></tr>
      <tr><td><strong>Archive</strong></td><td>Нет</td><td>Row-level</td><td>Write-only логи: сжатие, без UPDATE/DELETE</td></tr>
      <tr><td><strong>CSV</strong></td><td>Нет</td><td>Table-level</td><td>Обмен данными через CSV-файлы напрямую</td></tr>
      <tr><td><strong>Blackhole</strong></td><td>Нет</td><td>&mdash;</td><td>Принимает INSERT и выкидывает; для репликации/тестов</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cpu"></i> InnoDB-внутренности</div>

    <div class="card">
      <h3>Buffer Pool</h3>
      <p class="text">Главная кеш-структура InnoDB. Хранит в RAM страницы данных и индексов, недавно прочитанные/изменённые. Размер &mdash; <code>innodb_buffer_pool_size</code>, обычно 50-80% RAM сервера БД. Чем больше попадает в buffer pool, тем меньше I/O на диск.</p>
    </div>

    <div class="card">
      <h3>Change Buffer</h3>
      <p class="text">Оптимизация для записи: изменения в secondary-индексы (не PK) откладываются в специальный буфер, а не пишутся сразу на диск. Слияние происходит позже, в фоне, при чтении или периодически. Резко ускоряет INSERT/UPDATE на таблицах с многими индексами. Не работает для UNIQUE индексов (нужна немедленная проверка).</p>
    </div>

    <div class="card">
      <h3>Doublewrite Buffer</h3>
      <p class="text">Защита от «частичной записи» (torn page): перед записью страницы в основное место она сначала пишется в doublewrite-буфер. Если процесс упадёт посередине записи &mdash; при восстановлении страница берётся из doublewrite. Жертва: каждая запись делается дважды (но на быстром SSD это незаметно).</p>
    </div>

    <div class="card">
      <h3>Redo log (WAL)</h3>
      <p class="text">Write-ahead log: все изменения сначала пишутся в redo log, потом &mdash; в основные файлы. При краше БД проигрывает redo log с последнего checkpoint, восстанавливая закоммиченные транзакции. Размер &mdash; <code>innodb_log_file_size</code>, должен быть достаточным для буферизации хотя бы часа записи.</p>
    </div>

    <div class="card">
      <h3>Undo log</h3>
      <p class="text">Хранит предыдущие версии строк для MVCC и rollback. Активные транзакции читают свой snapshot через undo log. Если транзакция долгая &mdash; undo log растёт, БД распухает.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: проверить, что используется InnoDB</div>
<pre><code><span class="c-comment">-- Текущий дефолтный движок</span>
<span class="c-key">SHOW VARIABLES LIKE</span> <span class="c-str">'default_storage_engine'</span>;

<span class="c-comment">-- Движок конкретной таблицы</span>
<span class="c-key">SELECT</span> <span class="c-var">table_name</span>, <span class="c-var">engine</span>
<span class="c-key">FROM</span> <span class="c-type">information_schema</span>.<span class="c-var">tables</span>
<span class="c-key">WHERE</span> <span class="c-var">table_schema</span> = <span class="c-str">'shop'</span>;

<span class="c-comment">-- Размер buffer pool и hit rate</span>
<span class="c-key">SHOW VARIABLES LIKE</span> <span class="c-str">'innodb_buffer_pool_size'</span>;
<span class="c-key">SHOW STATUS LIKE</span> <span class="c-str">'Innodb_buffer_pool_reads%'</span>;
<span class="c-comment">-- hit rate = 1 - (reads / read_requests); чем ближе к 1, тем лучше</span>

<span class="c-comment">-- Конвертация MyISAM → InnoDB</span>
<span class="c-key">ALTER TABLE</span> <span class="c-var">old_table</span> <span class="c-key">ENGINE</span>=<span class="c-type">InnoDB</span>;
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. MyISAM в новом проекте.</strong> Дефолт MySQL до 5.5; иногда в старых tutorials встречается. Никогда не используйте: нет транзакций, нет FK, table-level locks убивают concurrency.</div>
    <div class="pitfall"><strong>2. Memory-таблица переживает рестарт?</strong> Нет. Содержимое теряется при рестарте mysqld. Только для временных данных.</div>
    <div class="pitfall"><strong>3. <code>innodb_buffer_pool_size</code> мал.</strong> Если меньше размера активных данных &mdash; постоянные I/O на диск. На сервере с 32 GB RAM ставьте 16-24 GB.</div>
    <div class="pitfall"><strong>4. Doublewrite отключён.</strong> <code>innodb_doublewrite = 0</code> ускоряет запись, но при краше можно потерять данные. На critical-системах &mdash; никогда не отключайте.</div>
    <div class="pitfall"><strong>5. Долгая транзакция и undo log.</strong> Транзакция, открытая на 5 минут, держит undo log для всех изменений вокруг. На write-heavy таблицах это распухает в десятки GB.</div>
    <div class="pitfall"><strong>6. Конвертация без проверки FK.</strong> ALTER MyISAM → InnoDB на таблице, ссылающейся на не-InnoDB &mdash; FK не создадутся. Конвертируйте всю схему.</div>
    <div class="pitfall"><strong>7. <code>innodb_flush_log_at_trx_commit = 0</code>.</strong> Логи сбрасываются на диск раз в секунду, не на каждый commit. Быстро, но при краше теряются последние секунды. Дефолт 1 &mdash; ACID-совместимо.</div>
    <div class="pitfall"><strong>8. PostgreSQL не имеет «движков».</strong> Только heap-tables и Foreign Data Wrappers (FDW) для внешних источников. Не пытайтесь найти аналог MyISAM &mdash; PG monolithic by design.</div>
  </div>
</div>

<div id="sec-locking" class="section">
  <div class="section-title">Блокировки и MVCC</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Блокировки &mdash; механизм управления конкурентным доступом. MVCC (Multi-Version Concurrency Control) &mdash; альтернативный подход с версионированием. Современные СУБД используют гибрид: MVCC для чтений, row-level locks для записей. Понимание необходимо для диагностики deadlock'ов и проектирования схем без лишней конкуренции.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Виды блокировок</div>
    <div class="card"><h3>Shared (S) и Exclusive (X)</h3><p class="text">S-lock &mdash; для чтения, несколько одновременно. X-lock &mdash; для записи, исключает любые другие. <code>SELECT FOR SHARE</code> &rarr; S, <code>SELECT FOR UPDATE</code> &rarr; X.</p></div>
    <div class="card"><h3>Row-level vs Table-level</h3><p class="text">Row-level &mdash; высокая параллельность, дефолт в InnoDB и Postgres. Table-level &mdash; при ALTER TABLE и явных <code>LOCK TABLES</code>.</p></div>
    <div class="card"><h3>Intention locks</h3><p class="text">Перед взятием row-lock ставится intention lock на таблицу (IS/IX). Позволяет table-level операциям быстро узнать о существующих row-locks без перебора.</p></div>
    <div class="card"><h3>Gap и Next-Key locks (MySQL InnoDB)</h3><p class="text">Для предотвращения phantom reads на REPEATABLE READ. Блокировка «промежутков» между строками снижает параллельность INSERT.</p></div>
    <div class="card"><h3>MVCC</h3><p class="text">Каждое изменение создаёт новую версию строки с txid. Читающие транзакции видят только версии на момент начала. Postgres &mdash; физически; MySQL &mdash; через undo-log.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Deadlock</div>
    <p class="text">Две транзакции взаимно ждут блокировки друг друга. СУБД детектирует и отменяет одну с ошибкой (MySQL: <code>40001</code>, Postgres: <code>40P01</code>).</p>
<pre><code><span class="c-comment">-- T1</span>                          <span class="c-comment">-- T2</span>
<span class="c-key">UPDATE</span> <span class="c-var">id</span>=<span class="c-num">1</span>;                    <span class="c-key">UPDATE</span> <span class="c-var">id</span>=<span class="c-num">2</span>;
<span class="c-key">UPDATE</span> <span class="c-var">id</span>=<span class="c-num">2</span>;                    <span class="c-key">UPDATE</span> <span class="c-var">id</span>=<span class="c-num">1</span>;
<span class="c-comment">-- T1 ждёт T2, T2 ждёт T1 → DEADLOCK</span>
</code></pre>
    <p class="text">Решение &mdash; всегда брать блокировки в одном порядке (например, по возрастанию id).</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>SELECT FOR UPDATE</code> без транзакции.</strong> Снимается с COMMIT/ROLLBACK. Без транзакции (autocommit ON) защиты нет.</div>
    <div class="pitfall"><strong>2. <code>UPDATE</code> по нескольким строкам в случайном порядке.</strong> Разный порядок захвата блокировок &mdash; deadlock. Используйте <code>ORDER BY id</code>.</div>
    <div class="pitfall"><strong>3. Gap locks убивают параллельность INSERT.</strong> На REPEATABLE READ InnoDB ставит gap-locks при range-условии в SELECT FOR UPDATE. Переходите на READ COMMITTED для high-throughput.</div>
    <div class="pitfall"><strong>4. MVCC bloat в Postgres.</strong> Долгие транзакции мешают autovacuum очистить старые версии. БД распухает.</div>
    <div class="pitfall"><strong>5. <code>SKIP LOCKED</code> для очередей.</strong> Пропускает заблокированные строки. Идеально для воркеров очереди. MySQL 8+, Postgres 9.5+.</div>
    <div class="pitfall"><strong>6. <code>NOWAIT</code> вместо ожидания.</strong> Мгновенно бросает ошибку. Лучше показать «занято», чем висеть 30 секунд.</div>
    <div class="pitfall"><strong>7. Транзакция держит соединение.</strong> Длинные транзакции = занятые соединения из пула.</div>
    <div class="pitfall"><strong>8. ALTER TABLE на проде.</strong> Требует table-lock. Используйте <code>pt-online-schema-change</code>, <code>gh-ost</code>.</div>
  </div>
</div>

<div id="sec-window" class="section">
  <div class="section-title">Window-функции и CTE</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Оконные функции и CTE &mdash; декларативные конструкции, заменяющие самописные циклы и временные таблицы. Многие задачи «возьмём данные и пройдём в коде» решаются одним запросом &mdash; быстрее, меньше round-trip'ов. Поддержка: MySQL 8+, Postgres &mdash; полный включая рекурсивные CTE.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Оконные функции</div>
    <div class="card"><h3><code>ROW_NUMBER()</code></h3><p class="text">Уникальный последовательный номер внутри партиции. Используется для «первый/последний на группу»: <code>ROW_NUMBER() OVER (PARTITION BY user_id ORDER BY created_at DESC) = 1</code>.</p></div>
    <div class="card"><h3><code>RANK()</code> и <code>DENSE_RANK()</code></h3><p class="text"><code>RANK</code> &mdash; с пропусками; <code>DENSE_RANK</code> &mdash; без пропусков.</p></div>
    <div class="card"><h3><code>LAG</code> и <code>LEAD</code></h3><p class="text">Значение из предыдущей/следующей строки в окне. Идеально для сравнения с предыдущим состоянием.</p></div>
    <div class="card"><h3>Aggregate over window</h3><p class="text"><code>SUM(amount) OVER (PARTITION BY user_id ORDER BY created_at)</code> &mdash; накопительный итог. <code>AVG(price) OVER (ROWS BETWEEN 6 PRECEDING AND CURRENT ROW)</code> &mdash; скользящее среднее.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: последний заказ каждого пользователя</div>
<pre><code><span class="c-key">SELECT</span> <span class="c-var">user_id</span>, <span class="c-var">id</span>, <span class="c-var">created_at</span>, <span class="c-var">total_minor</span>
<span class="c-key">FROM</span> (
    <span class="c-key">SELECT</span> *,
           <span class="c-fn">ROW_NUMBER</span>() <span class="c-key">OVER</span> (<span class="c-key">PARTITION BY</span> <span class="c-var">user_id</span> <span class="c-key">ORDER BY</span> <span class="c-var">created_at</span> <span class="c-key">DESC</span>) <span class="c-key">AS</span> <span class="c-var">rn</span>
    <span class="c-key">FROM</span> <span class="c-type">orders</span>
) <span class="c-var">latest</span>
<span class="c-key">WHERE</span> <span class="c-var">rn</span> = <span class="c-num">1</span>;

<span class="c-comment">-- Рекурсивный CTE: иерархия категорий</span>
<span class="c-key">WITH RECURSIVE</span> <span class="c-var">tree</span> <span class="c-key">AS</span> (
    <span class="c-key">SELECT</span> <span class="c-var">id</span>, <span class="c-var">name</span>, <span class="c-var">parent_id</span>, <span class="c-num">0</span> <span class="c-key">AS</span> <span class="c-var">depth</span>
    <span class="c-key">FROM</span> <span class="c-type">categories</span> <span class="c-key">WHERE</span> <span class="c-var">parent_id</span> <span class="c-key">IS NULL</span>
    <span class="c-key">UNION ALL</span>
    <span class="c-key">SELECT</span> <span class="c-var">c</span>.<span class="c-var">id</span>, <span class="c-var">c</span>.<span class="c-var">name</span>, <span class="c-var">c</span>.<span class="c-var">parent_id</span>, <span class="c-var">t</span>.<span class="c-var">depth</span> + <span class="c-num">1</span>
    <span class="c-key">FROM</span> <span class="c-type">categories</span> <span class="c-var">c</span> <span class="c-key">JOIN</span> <span class="c-var">tree</span> <span class="c-var">t</span> <span class="c-key">ON</span> <span class="c-var">c</span>.<span class="c-var">parent_id</span> = <span class="c-var">t</span>.<span class="c-var">id</span>
)
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-var">tree</span>;
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Window function в WHERE.</strong> Запрещено: вычисляются после WHERE. Используйте подзапрос или CTE с <code>WHERE rn = 1</code>.</div>
    <div class="pitfall"><strong>2. CTE как оптимизационная граница.</strong> До Postgres 12 CTE были барьером. С 12+ &mdash; inline; явная материализация через <code>WITH foo AS MATERIALIZED</code>.</div>
    <div class="pitfall"><strong>3. Рекурсивный CTE без терминатора.</strong> Бесконечная рекурсия при цикле в данных. Защита: <code>WHERE depth &lt; 10</code>.</div>
    <div class="pitfall"><strong>4. <code>ORDER BY</code> без <code>ROWS BETWEEN</code>.</strong> Дефолт &mdash; <code>RANGE BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW</code> (накопительный итог).</div>
    <div class="pitfall"><strong>5. NULL в LAG/LEAD.</strong> На первой строке возвращает NULL. Указывайте default: <code>LAG(value, 1, 0)</code>.</div>
    <div class="pitfall"><strong>6. Window function на больших данных.</strong> Партиция требует сортировки. Партицируйте таблицу физически.</div>
    <div class="pitfall"><strong>7. MySQL 5.7 и ниже.</strong> Window functions добавлены в 8. На старых &mdash; имитация через self-join, хрупкая.</div>
    <div class="pitfall"><strong>8. CTE как замена View.</strong> CTE &mdash; только в одном запросе. Для повторно используемых &mdash; материализованное представление.</div>
  </div>
</div>

<div id="sec-vendor" class="section">
  <div class="section-title">MySQL vs PostgreSQL vs SQL Server</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Три доминирующих СУБД в enterprise: MySQL, PostgreSQL, Microsoft SQL Server. На базовом SQL похожи; на уровне типов, продвинутых индексов, репликации и оптимизатора &mdash; разные. Понимание различий критично для интеграционных задач, миграций между СУБД, переносимых ORM-запросов и для интервью на senior-позиции.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Сводная таблица</div>
    <table class="data-table">
      <tr><th>Аспект</th><th>MySQL (InnoDB)</th><th>PostgreSQL</th><th>SQL Server</th></tr>
      <tr><td><strong>Дефолт изоляция</strong></td><td>REPEATABLE READ</td><td>READ COMMITTED</td><td>READ COMMITTED</td></tr>
      <tr><td><strong>Auto-increment</strong></td><td><code>AUTO_INCREMENT</code></td><td><code>SERIAL</code> / <code>GENERATED</code></td><td><code>IDENTITY(1,1)</code></td></tr>
      <tr><td><strong>Limit</strong></td><td><code>LIMIT 10</code></td><td><code>LIMIT 10</code></td><td><code>TOP 10</code> / <code>OFFSET FETCH</code></td></tr>
      <tr><td><strong>Конкатенация</strong></td><td><code>CONCAT(a, b)</code></td><td><code>a || b</code></td><td><code>a + b</code> / <code>CONCAT</code></td></tr>
      <tr><td><strong>Текущее время</strong></td><td><code>NOW()</code></td><td><code>NOW()</code> / <code>CURRENT_TIMESTAMP</code></td><td><code>GETDATE()</code></td></tr>
      <tr><td><strong>Кавычки</strong></td><td>Обратные <code>`col`</code></td><td>Двойные <code>"col"</code></td><td>Квадратные <code>[col]</code></td></tr>
      <tr><td><strong>Clustered index</strong></td><td>Автоматически по PK</td><td>Heap (CLUSTER явно)</td><td>Автоматически по PK, либо явно <code>CLUSTERED</code></td></tr>
      <tr><td><strong>JSON</strong></td><td>JSON, индекс через generated cols</td><td>JSONB + GIN</td><td>JSON (как NVARCHAR + функции)</td></tr>
      <tr><td><strong>Массивы</strong></td><td>Нет</td><td>Да, нативно</td><td>Нет</td></tr>
      <tr><td><strong>Индексы</strong></td><td>B-Tree, FULLTEXT, RTREE</td><td>B-Tree, GIN, GiST, BRIN, Hash, SP-GiST</td><td>CLUSTERED, NONCLUSTERED, INCLUDE, filtered, FULLTEXT</td></tr>
      <tr><td><strong>Partial index</strong></td><td>Нет (workaround &mdash; generated cols)</td><td>Да</td><td>Да (filtered index)</td></tr>
      <tr><td><strong>Covering index</strong></td><td>Широкий композит</td><td><code>INCLUDE</code></td><td><code>INCLUDE</code></td></tr>
      <tr><td><strong>DDL транзакционно</strong></td><td>Ограниченно (atomic DDL 8+)</td><td>Да</td><td>Да</td></tr>
      <tr><td><strong>Параллельные запросы</strong></td><td>Нет</td><td>Да (9.6+)</td><td>Да</td></tr>
      <tr><td><strong>RETURNING</strong></td><td>Нет</td><td>Да: <code>INSERT ... RETURNING id</code></td><td><code>OUTPUT INSERTED.id</code></td></tr>
      <tr><td><strong>UPSERT</strong></td><td><code>ON DUPLICATE KEY UPDATE</code></td><td><code>ON CONFLICT DO UPDATE</code></td><td><code>MERGE</code></td></tr>
      <tr><td><strong>Online schema change</strong></td><td><code>pt-osc</code>, <code>gh-ost</code></td><td><code>pg_repack</code>, <code>CONCURRENTLY</code></td><td><code>ALTER TABLE ... WITH (ONLINE = ON)</code></td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="code-2"></i> Как Laravel абстрагирует диалекты</div>
    <p class="text">Eloquent и Query Builder генерируют разный SQL под разные драйверы. <code>DB::table('users')-&gt;limit(10)</code> на MySQL/PG превратится в <code>LIMIT 10</code>, на SQL Server &mdash; в <code>SELECT TOP 10</code> или <code>OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY</code>. <code>upsert()</code> — соответствующий синтаксис каждой СУБД. Quoting идентификаторов автоматически: backtick/двойные/квадратные.</p>

<pre><code><span class="c-comment">// Один код — три разных SQL под капотом</span>
<span class="c-type">User</span>::<span class="c-fn">upsert</span>(
    [[<span class="c-str">'email'</span> =&gt; <span class="c-str">'a@example.com'</span>, <span class="c-str">'name'</span> =&gt; <span class="c-str">'Anna'</span>]],
    [<span class="c-str">'email'</span>],   <span class="c-comment">// уникальный ключ</span>
    [<span class="c-str">'name'</span>]     <span class="c-comment">// что обновить при конфликте</span>
);
<span class="c-comment">// MySQL: INSERT INTO users (...) VALUES (...) ON DUPLICATE KEY UPDATE name = VALUES(name)</span>
<span class="c-comment">// PG:    INSERT INTO users (...) VALUES (...) ON CONFLICT (email) DO UPDATE SET name = excluded.name</span>
<span class="c-comment">// MSSQL: MERGE INTO users ...</span>
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="search"></i> Full-Text Search: внутри СУБД или специальный движок?</div>
    <table class="data-table">
      <tr><th>Решение</th><th>Когда подходит</th></tr>
      <tr><td><strong>MySQL FULLTEXT</strong></td><td>Простой поиск по тексту, нативно. Ограничения: только InnoDB 5.6+, ограниченная фильтрация, средние результаты ранжирования.</td></tr>
      <tr><td><strong>PostgreSQL tsvector + GIN</strong></td><td>Мощный нативный full-text: морфология, ранжирование, фасеты. Достаточно для большинства проектов.</td></tr>
      <tr><td><strong>SQL Server FULLTEXT</strong></td><td>Есть, но требует настройки FT-сервиса. Уровень PG.</td></tr>
      <tr><td><strong>Elasticsearch</strong></td><td>Большие объёмы (миллионы документов), сложные агрегации, faceted search, autocomplete. Отдельная инфраструктура.</td></tr>
      <tr><td><strong>Meilisearch / Typesense</strong></td><td>Малые/средние проекты, нужна простота и скорость, typo-tolerance.</td></tr>
      <tr><td><strong>Manticore / Sphinx</strong></td><td>Альтернатива ES с упором на скорость для текстового поиска.</td></tr>
    </table>
    <p class="text">Эмпирика: до 100к документов &mdash; нативный FULLTEXT/tsvector. От 100к до 10М &mdash; Meilisearch/Typesense. Свыше &mdash; Elasticsearch с отдельной командой эксплуатации.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. JSON-операции непереносимы.</strong> Синтаксис разный: MySQL <code>JSON_EXTRACT(col, '$.path')</code>; Postgres <code>col-&gt;'path'</code>.</div>
    <div class="pitfall"><strong>2. Регистронезависимость.</strong> MySQL по умолчанию нечувствителен к регистру (<code>utf8mb4_unicode_ci</code>); Postgres &mdash; чувствителен.</div>
    <div class="pitfall"><strong>3. UUID хранение.</strong> Postgres &mdash; нативный <code>uuid</code>. MySQL &mdash; CHAR(36) или BINARY(16).</div>
    <div class="pitfall"><strong>4. <code>BOOLEAN</code> в MySQL.</strong> Синоним TINYINT(1); TRUE/FALSE = 1/0.</div>
    <div class="pitfall"><strong>5. Default sort order.</strong> Без <code>ORDER BY</code> порядок не гарантирован. Никогда не полагайтесь.</div>
    <div class="pitfall"><strong>6. Connection pooling.</strong> PgBouncer (Postgres), ProxySQL (MySQL) решают разные проблемы по-разному.</div>
    <div class="pitfall"><strong>7. <code>EXPLAIN</code> формат.</strong> Совершенно разный синтаксис и колонки.</div>
    <div class="pitfall"><strong>8. Online schema changes.</strong> MySQL: <code>pt-online-schema-change</code>, <code>gh-ost</code>. Postgres: <code>pg_repack</code>, <code>ALTER TABLE</code> с осторожностью.</div>
  </div>
</div>

<div id="sec-advanced-opt" class="section">
  <div class="section-title">Hints, Partitioning, Materialized Views, Stored Procedures</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Большинство оптимизаций решаются индексами и переписыванием запроса. Когда этого не хватает &mdash; в арсенале остаются продвинутые механизмы: подсказки оптимизатору, физическое партиционирование, материализованные представления, хранимые процедуры. Каждый имеет цену &mdash; либо в сложности кода, либо в стоимости поддержки. Использовать их нужно только когда обычные средства исчерпаны.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="lightbulb"></i> Database hints</div>
    <p class="text">Подсказки оптимизатору о том, как выполнять запрос. Помогают, когда оптимизатор выбирает плохой план из-за устаревшей статистики или необычного распределения данных.</p>

<pre><code><span class="c-comment">-- MySQL: принудительный индекс</span>
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">orders</span> <span class="c-key">FORCE INDEX</span> (<span class="c-var">idx_user_created</span>)
<span class="c-key">WHERE</span> <span class="c-var">user_id</span> = <span class="c-num">42</span>;

<span class="c-comment">-- MySQL: подсказка JOIN-стратегии</span>
<span class="c-key">SELECT</span> /*+ <span class="c-key">JOIN_ORDER</span>(<span class="c-var">u</span>, <span class="c-var">o</span>) */ *
<span class="c-key">FROM</span> <span class="c-type">users</span> <span class="c-var">u</span> <span class="c-key">JOIN</span> <span class="c-type">orders</span> <span class="c-var">o</span> <span class="c-key">ON</span> ...

<span class="c-comment">-- SQL Server: тип JOIN, локи</span>
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">orders</span> <span class="c-key">WITH</span> (<span class="c-key">NOLOCK</span>)
<span class="c-key">OPTION</span> (<span class="c-key">LOOP JOIN</span>, <span class="c-key">MAXDOP</span> <span class="c-num">4</span>);

<span class="c-comment">-- PostgreSQL: hints — через расширение pg_hint_plan, не нативно</span>
/*+ <span class="c-key">IndexScan</span>(<span class="c-var">orders</span> <span class="c-var">idx_user_id</span>) */
<span class="c-key">SELECT</span> * <span class="c-key">FROM</span> <span class="c-type">orders</span> <span class="c-key">WHERE</span> <span class="c-var">user_id</span> = <span class="c-num">42</span>;
</code></pre>

    <div class="info-box warning"><strong>Когда оправдано:</strong> аварийный случай, нужно срочно ускорить запрос на проде. <strong>Долгосрочно:</strong> устаревшая статистика (исправьте через <code>ANALYZE</code>), плохая селективность (исправьте индексом), плохая форма запроса (перепишите). Hints скрывают проблему &mdash; через полгода они становятся вредными.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="bar-chart-3"></i> Database statistics: ANALYZE и автообновление</div>
    <p class="text">Оптимизатор принимает решения на основании статистики: сколько строк в таблице, как распределены значения колонок, селективность индексов. Если статистика устарела (после массового импорта/удаления) &mdash; план может быть в разы хуже оптимального.</p>

<pre><code><span class="c-comment">-- MySQL: обновить статистику таблицы</span>
<span class="c-key">ANALYZE TABLE</span> <span class="c-type">orders</span>;

<span class="c-comment">-- PostgreSQL: обновить статистику</span>
<span class="c-type">ANALYZE</span> <span class="c-var">orders</span>;
<span class="c-comment">-- VACUUM ANALYZE — очистка bloat + статистика</span>
<span class="c-type">VACUUM ANALYZE</span> <span class="c-var">orders</span>;

<span class="c-comment">-- SQL Server</span>
<span class="c-key">UPDATE STATISTICS</span> <span class="c-var">orders</span>;
<span class="c-comment">-- С полной выборкой:</span>
<span class="c-key">UPDATE STATISTICS</span> <span class="c-var">orders</span> <span class="c-key">WITH FULLSCAN</span>;
</code></pre>

    <p class="text">PostgreSQL запускает <strong>autovacuum</strong> автоматически &mdash; обычно настройка по умолчанию подходит. На write-heavy таблицах может отставать, нужно тюнить <code>autovacuum_vacuum_scale_factor</code>. MySQL обновляет статистику InnoDB лениво при изменении 10% таблицы.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="grid-3x3"></i> Partitioning и Sharding</div>

    <div class="card">
      <h3>Partitioning &mdash; одна БД, физически разделённая таблица</h3>
      <p class="text">Таблица бьётся на несколько частей по правилу: <strong>RANGE</strong> (по диапазону, типично по дате), <strong>LIST</strong> (по списку значений), <strong>HASH</strong> (равномерно). Каждая партиция &mdash; отдельный файл. Запрос с фильтром по ключу партиционирования читает только одну партицию (partition pruning).</p>
<pre><code><span class="c-comment">-- MySQL: партиции по году</span>
<span class="c-key">CREATE TABLE</span> <span class="c-type">orders</span> (
    <span class="c-var">id</span> <span class="c-type">BIGINT</span>, <span class="c-var">created_at</span> <span class="c-type">DATETIME</span>, ...
) <span class="c-key">PARTITION BY RANGE</span> (<span class="c-fn">YEAR</span>(<span class="c-var">created_at</span>)) (
    <span class="c-key">PARTITION</span> <span class="c-var">p2024</span> <span class="c-key">VALUES LESS THAN</span> (<span class="c-num">2025</span>),
    <span class="c-key">PARTITION</span> <span class="c-var">p2025</span> <span class="c-key">VALUES LESS THAN</span> (<span class="c-num">2026</span>),
    <span class="c-key">PARTITION</span> <span class="c-var">p2026</span> <span class="c-key">VALUES LESS THAN</span> (<span class="c-num">2027</span>)
);
</code></pre>
      <p class="text">Удаление старых данных через <code>DROP PARTITION</code> &mdash; мгновенное (просто отвязывается файл), вместо DELETE на миллион строк.</p>
    </div>

    <div class="card">
      <h3>Sharding &mdash; разные БД на разных серверах</h3>
      <p class="text">Данные разнесены по нескольким независимым БД (shards). Запрос идёт в конкретный shard по ключу (например, <code>user_id % shards_count</code>). Цена: JOIN между shards становится сложным/невозможным, транзакции через shards требуют distributed transactions (или их избегания). Применяется на масштабах, где одна БД не вмещает данные или не вытягивает нагрузку.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="image"></i> Materialized Views</div>
    <p class="text">View &mdash; виртуальная таблица, запрос которой выполняется при каждом обращении. Materialized View &mdash; физически сохранённый результат запроса, обновляемый по расписанию. Идеален для тяжёлых аналитических агрегатов, читаемых часто, обновляемых редко.</p>

<pre><code><span class="c-comment">-- PostgreSQL</span>
<span class="c-key">CREATE MATERIALIZED VIEW</span> <span class="c-var">daily_sales</span> <span class="c-key">AS</span>
<span class="c-key">SELECT</span> <span class="c-fn">DATE</span>(<span class="c-var">created_at</span>) <span class="c-key">AS</span> <span class="c-var">day</span>, <span class="c-fn">SUM</span>(<span class="c-var">total_minor</span>) <span class="c-key">AS</span> <span class="c-var">total</span>
<span class="c-key">FROM</span> <span class="c-type">orders</span> <span class="c-key">WHERE</span> <span class="c-var">status</span> = <span class="c-str">'paid'</span> <span class="c-key">GROUP BY</span> <span class="c-fn">DATE</span>(<span class="c-var">created_at</span>);

<span class="c-comment">-- Создать индекс на view (как на обычной таблице)</span>
<span class="c-key">CREATE UNIQUE INDEX</span> <span class="c-var">idx_daily_sales_day</span> <span class="c-key">ON</span> <span class="c-var">daily_sales</span> (<span class="c-var">day</span>);

<span class="c-comment">-- Обновить — по расписанию (cron / Laravel Scheduler)</span>
<span class="c-key">REFRESH MATERIALIZED VIEW CONCURRENTLY</span> <span class="c-var">daily_sales</span>;

<span class="c-comment">-- SQL Server (Indexed View)</span>
<span class="c-key">CREATE VIEW</span> <span class="c-var">daily_sales</span> <span class="c-key">WITH SCHEMABINDING AS</span> ...;
<span class="c-key">CREATE UNIQUE CLUSTERED INDEX</span> <span class="c-var">idx</span> <span class="c-key">ON</span> <span class="c-var">daily_sales</span>(<span class="c-var">day</span>);

<span class="c-comment">-- MySQL не имеет нативно — workaround через summary tables + триггеры/events</span>
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="terminal-square"></i> Stored Procedures</div>
    <p class="text">Хранимая процедура &mdash; код на процедурном расширении SQL (PL/pgSQL, T-SQL), живущий внутри БД. Преимущества: меньше round-trips, доступ к данным без передачи в приложение, можно вызывать из триггеров. Недостатки: язык БД (а не язык приложения), сложнее версионировать, тестировать, отлаживать.</p>

<pre><code><span class="c-comment">-- PostgreSQL: процедура с транзакцией</span>
<span class="c-key">CREATE OR REPLACE PROCEDURE</span> <span class="c-fn">transfer_funds</span>(
    <span class="c-var">from_id</span> <span class="c-type">BIGINT</span>, <span class="c-var">to_id</span> <span class="c-type">BIGINT</span>, <span class="c-var">amount</span> <span class="c-type">INT</span>
)
<span class="c-key">LANGUAGE</span> <span class="c-type">plpgsql</span> <span class="c-key">AS</span> $$
<span class="c-key">BEGIN</span>
    <span class="c-key">UPDATE</span> <span class="c-var">accounts</span> <span class="c-key">SET</span> <span class="c-var">balance</span> = <span class="c-var">balance</span> - <span class="c-var">amount</span> <span class="c-key">WHERE</span> <span class="c-var">id</span> = <span class="c-var">from_id</span>;
    <span class="c-key">UPDATE</span> <span class="c-var">accounts</span> <span class="c-key">SET</span> <span class="c-var">balance</span> = <span class="c-var">balance</span> + <span class="c-var">amount</span> <span class="c-key">WHERE</span> <span class="c-var">id</span> = <span class="c-var">to_id</span>;
    <span class="c-key">COMMIT</span>;
<span class="c-key">END</span>;
$$;

<span class="c-comment">-- Вызов</span>
<span class="c-key">CALL</span> <span class="c-fn">transfer_funds</span>(<span class="c-num">1</span>, <span class="c-num">2</span>, <span class="c-num">500</span>);
</code></pre>

    <p class="text">Современная практика: <strong>избегать</strong> stored procedures в новых проектах. Логика принадлежит приложению, БД должна оставаться «хранилищем». Исключения: критичные операции с миллионами row-операций (где избегание round-trip даёт x10 выигрыш), legacy-проекты с уже сложившейся практикой.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> UNION vs UNION ALL</div>
    <p class="text"><code>UNION</code> убирает дубликаты (требует сортировки/хеширования всего результата). <code>UNION ALL</code> &mdash; просто склеивает строки. На больших объёмах разница огромная: <code>UNION ALL</code> в 5-10 раз быстрее.</p>

<pre><code><span class="c-comment">-- ❌ UNION без необходимости — лишний overhead</span>
<span class="c-key">SELECT</span> <span class="c-var">id</span> <span class="c-key">FROM</span> <span class="c-type">active_users</span>
<span class="c-key">UNION</span>
<span class="c-key">SELECT</span> <span class="c-var">id</span> <span class="c-key">FROM</span> <span class="c-type">archived_users</span>;
<span class="c-comment">-- СУБД проверяет на дубли даже если они невозможны</span>

<span class="c-comment">-- ✓ UNION ALL — если дубли невозможны/неважны</span>
<span class="c-key">SELECT</span> <span class="c-var">id</span> <span class="c-key">FROM</span> <span class="c-type">active_users</span>
<span class="c-key">UNION ALL</span>
<span class="c-key">SELECT</span> <span class="c-var">id</span> <span class="c-key">FROM</span> <span class="c-type">archived_users</span>;
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>FORCE INDEX</code> как лекарство.</strong> Чинит сейчас, ломает через полгода (статистика изменилась). Сначала <code>ANALYZE</code>, потом &mdash; если не помогло &mdash; разбираться с дизайном индекса.</div>
    <div class="pitfall"><strong>2. Партиционирование без partition pruning.</strong> Если ключ партиционирования не используется в WHERE, СУБД сканирует все партиции &mdash; хуже одной таблицы. Партиционировать только если ключ всегда в фильтре.</div>
    <div class="pitfall"><strong>3. Materialized View и stale data.</strong> Между REFRESH данные могут устареть. Пользователь видит вчерашнее. Декларируйте SLA явно или используйте <code>CONCURRENTLY</code> + scheduled refresh каждые N минут.</div>
    <div class="pitfall"><strong>4. Stored procedures как полная логика приложения.</strong> Сложно версионировать, тестировать, отлаживать; нельзя писать unit-тесты на PHP. Используйте только для критичных по производительности операций.</div>
    <div class="pitfall"><strong>5. <code>UNION</code> вместо <code>UNION ALL</code>.</strong> Дефолтная привычка из туториалов. На больших данных &mdash; кратное замедление. Используйте ALL, если не нужна явная дедупликация.</div>
    <div class="pitfall"><strong>6. <code>ANALYZE</code> на проде в час пик.</strong> Захватывает statistics-lock; на больших таблицах может затормозить запросы. На write-heavy &mdash; запускайте ночью или с лимитом sample rate.</div>
    <div class="pitfall"><strong>7. Sharding без ясной стратегии.</strong> Резкое усложнение архитектуры. Сначала: вертикальное масштабирование, read replicas, материализованные views &mdash; всё это решает проблемы до объёмов в десятки TB.</div>
    <div class="pitfall"><strong>8. <code>WHERE YEAR(date) = 2024</code>.</strong> Функция вокруг колонки убивает индекс. Перепишите как range: <code>WHERE date BETWEEN '2024-01-01' AND '2024-12-31'</code>.</div>
  </div>
</div>

<div id="sec-pdo" class="section">
  <div class="section-title">PDO в PHP</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">PDO &mdash; унифицированный интерфейс работы с реляционными БД, прозрачный между MySQL/PostgreSQL/SQLite/MSSQL. Laravel оборачивает PDO в Eloquent/Query Builder; знание PDO нужно для понимания, что происходит под капотом, безопасной обработки пограничных случаев и грамотных ответов на интервью.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Базовые компоненты</div>
    <div class="card"><h3>Connection (PDO instance)</h3><p class="text">Объект подключения с DSN, credentials и опциями. Laravel держит один PDO-инстанс на connection.</p></div>
    <div class="card"><h3>Prepared statements</h3><p class="text">Запрос компилируется один раз с placeholder'ами, исполняется N раз. Безопасность от инъекций, кеширование плана, переиспользование. PHP поддерживает <code>?</code> и <code>:name</code>.</p></div>
    <div class="card"><h3>Fetch modes</h3><p class="text"><code>FETCH_ASSOC</code>, <code>FETCH_OBJ</code>, <code>FETCH_CLASS</code>, <code>FETCH_KEY_PAIR</code>. Eloquent &mdash; кастомный fetch с гидрацией моделей.</p></div>
    <div class="card"><h3>Error mode</h3><p class="text"><code>ATTR_ERRMODE</code>: SILENT, WARNING, EXCEPTION. С PHP 8.0+ EXCEPTION &mdash; дефолт.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: безопасный запрос</div>
<pre><code><span class="c-key">use</span> <span class="c-type">PDO</span>;

<span class="c-var">$pdo</span> = <span class="c-key">new</span> <span class="c-type">PDO</span>(<span class="c-str">'mysql:host=127.0.0.1;dbname=shop;charset=utf8mb4'</span>, <span class="c-str">'user'</span>, <span class="c-str">'pass'</span>, [
    <span class="c-type">PDO</span>::<span class="c-var">ATTR_ERRMODE</span>             =&gt; <span class="c-type">PDO</span>::<span class="c-var">ERRMODE_EXCEPTION</span>,
    <span class="c-type">PDO</span>::<span class="c-var">ATTR_DEFAULT_FETCH_MODE</span>  =&gt; <span class="c-type">PDO</span>::<span class="c-var">FETCH_ASSOC</span>,
    <span class="c-type">PDO</span>::<span class="c-var">ATTR_EMULATE_PREPARES</span>    =&gt; <span class="c-key">false</span>, <span class="c-comment">// настоящие prepared, не эмулированные</span>
]);

<span class="c-var">$stmt</span> = <span class="c-var">$pdo</span>-&gt;<span class="c-fn">prepare</span>(<span class="c-str">'SELECT id, email FROM users WHERE status = :status LIMIT :limit'</span>);
<span class="c-var">$stmt</span>-&gt;<span class="c-fn">bindValue</span>(<span class="c-str">':status'</span>, <span class="c-str">'active'</span>, <span class="c-type">PDO</span>::<span class="c-var">PARAM_STR</span>);
<span class="c-var">$stmt</span>-&gt;<span class="c-fn">bindValue</span>(<span class="c-str">':limit'</span>,  <span class="c-num">10</span>,       <span class="c-type">PDO</span>::<span class="c-var">PARAM_INT</span>);
<span class="c-var">$stmt</span>-&gt;<span class="c-fn">execute</span>();

<span class="c-key">foreach</span> (<span class="c-var">$stmt</span> <span class="c-key">as</span> <span class="c-var">$row</span>) {
    <span class="c-fn">echo</span> <span class="c-var">$row</span>[<span class="c-str">'email'</span>];
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>ATTR_EMULATE_PREPARES = true</code>.</strong> PDO эмулирует prepared в PHP, посылая полный SQL. Защита сохраняется, но типы &mdash; всегда строки (LIMIT :n превращается в строку, MySQL ругается). Включайте <code>false</code>.</div>
    <div class="pitfall"><strong>2. <code>bindParam</code> vs <code>bindValue</code>.</strong> <code>bindParam</code> привязывает <em>ссылку</em>. В цикле &mdash; баг «все строки одинаковые».</div>
    <div class="pitfall"><strong>3. Положительные числа как строки.</strong> Параметр из <code>$_GET</code> &mdash; строка. Для LIMIT в MySQL: <code>(int) $_GET['limit']</code> + PARAM_INT.</div>
    <div class="pitfall"><strong>4. <code>LIKE</code> с пользовательским вводом.</strong> Prepared защищает от инъекций, не от метасимволов LIKE. Экранируйте <code>%</code> и <code>_</code>.</div>
    <div class="pitfall"><strong>5. Имена таблиц не параметризируются.</strong> PDO привязывает только значения. Динамическая таблица &mdash; через whitelist.</div>
    <div class="pitfall"><strong>6. Незакрытый cursor на MySQL.</strong> Следующий запрос бросит ошибку. <code>$stmt-&gt;closeCursor()</code> или buffered queries.</div>
    <div class="pitfall"><strong>7. Утечка соединения.</strong> PDO-объект, держимый в синглтоне, удерживает соединение до конца процесса. В long-running &mdash; накапливается.</div>
    <div class="pitfall"><strong>8. <code>lastInsertId()</code> и replication lag.</strong> На read replica только что вставленная строка не видна. Читайте из мастера.</div>
  </div>
</div>

<div id="sec-practice" class="section">
  <div class="section-title">Практика: оптимизация медленного запроса</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> Постановка</div>
    <p class="text">Аналитический запрос на дашборде «топ-10 пользователей по сумме платежей за последний месяц с количеством заказов» работает 4.2 секунды на проде. Таблицы: <code>users</code> (1.2 млн), <code>orders</code> (8 млн), <code>payments</code> (15 млн). Задача &mdash; довести время до &lt; 50 мс без архитектурных изменений.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="bug"></i> Шаг 1: исходный запрос (4.2 с)</div>
<pre><code><span class="c-key">SELECT</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-var">u</span>.<span class="c-var">email</span>,
       <span class="c-fn">COUNT</span>(<span class="c-key">DISTINCT</span> <span class="c-var">o</span>.<span class="c-var">id</span>)  <span class="c-key">AS</span> <span class="c-var">orders_count</span>,
       <span class="c-fn">SUM</span>(<span class="c-var">p</span>.<span class="c-var">amount_minor</span>)   <span class="c-key">AS</span> <span class="c-var">total_paid</span>
<span class="c-key">FROM</span>      <span class="c-type">users</span>    <span class="c-var">u</span>
<span class="c-key">LEFT JOIN</span> <span class="c-type">orders</span>   <span class="c-var">o</span> <span class="c-key">ON</span> <span class="c-var">o</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>
<span class="c-key">LEFT JOIN</span> <span class="c-type">payments</span> <span class="c-var">p</span> <span class="c-key">ON</span> <span class="c-var">p</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>
<span class="c-key">WHERE</span> <span class="c-var">p</span>.<span class="c-var">created_at</span> &gt;= <span class="c-fn">NOW</span>() - <span class="c-key">INTERVAL</span> <span class="c-str">'30 days'</span>
<span class="c-key">GROUP BY</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-var">u</span>.<span class="c-var">email</span>
<span class="c-key">ORDER BY</span> <span class="c-var">total_paid</span> <span class="c-key">DESC</span>
<span class="c-key">LIMIT</span> <span class="c-num">10</span>;
</code></pre>
    <p class="text">Проблемы: (1) WHERE по <code>p.created_at</code> с LEFT JOIN превращает его в INNER; (2) двойной JOIN дублирует строки, COUNT(DISTINCT) и SUM работают на дублированном множестве; (3) полное сканирование 8M orders + 15M payments + 1.2M users.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="wrench"></i> Шаг 2: исправить семантику (1.8 с)</div>
<pre><code><span class="c-key">SELECT</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-var">u</span>.<span class="c-var">email</span>,
       <span class="c-fn">COALESCE</span>(<span class="c-var">o</span>.<span class="c-var">orders_count</span>, <span class="c-num">0</span>) <span class="c-key">AS</span> <span class="c-var">orders_count</span>, <span class="c-var">p</span>.<span class="c-var">total_paid</span>
<span class="c-key">FROM</span> <span class="c-type">users</span> <span class="c-var">u</span>
<span class="c-key">JOIN</span> (<span class="c-key">SELECT</span> <span class="c-var">user_id</span>, <span class="c-fn">SUM</span>(<span class="c-var">amount_minor</span>) <span class="c-key">AS</span> <span class="c-var">total_paid</span>
       <span class="c-key">FROM</span> <span class="c-type">payments</span>
       <span class="c-key">WHERE</span> <span class="c-var">created_at</span> &gt;= <span class="c-fn">NOW</span>() - <span class="c-key">INTERVAL</span> <span class="c-str">'30 days'</span>
       <span class="c-key">GROUP BY</span> <span class="c-var">user_id</span>) <span class="c-var">p</span> <span class="c-key">ON</span> <span class="c-var">p</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>
<span class="c-key">LEFT JOIN</span> (<span class="c-key">SELECT</span> <span class="c-var">user_id</span>, <span class="c-fn">COUNT</span>(*) <span class="c-key">AS</span> <span class="c-var">orders_count</span> <span class="c-key">FROM</span> <span class="c-type">orders</span> <span class="c-key">GROUP BY</span> <span class="c-var">user_id</span>) <span class="c-var">o</span> <span class="c-key">ON</span> <span class="c-var">o</span>.<span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>
<span class="c-key">ORDER BY</span> <span class="c-var">p</span>.<span class="c-var">total_paid</span> <span class="c-key">DESC</span>
<span class="c-key">LIMIT</span> <span class="c-num">10</span>;
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="search"></i> Шаг 3: добавить индексы (180 мс)</div>
<pre><code><span class="c-key">CREATE INDEX</span> <span class="c-var">idx_payments_created_user_amount</span>
  <span class="c-key">ON</span> <span class="c-type">payments</span> (<span class="c-var">created_at</span>, <span class="c-var">user_id</span>) <span class="c-key">INCLUDE</span> (<span class="c-var">amount_minor</span>);
<span class="c-key">CREATE INDEX</span> <span class="c-var">idx_orders_user_id</span> <span class="c-key">ON</span> <span class="c-type">orders</span> (<span class="c-var">user_id</span>);
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Шаг 4: сузить выборку до топ-10 (40 мс)</div>
<pre><code><span class="c-key">WITH</span> <span class="c-var">top_payers</span> <span class="c-key">AS</span> (
    <span class="c-key">SELECT</span> <span class="c-var">user_id</span>, <span class="c-fn">SUM</span>(<span class="c-var">amount_minor</span>) <span class="c-key">AS</span> <span class="c-var">total_paid</span>
    <span class="c-key">FROM</span> <span class="c-type">payments</span>
    <span class="c-key">WHERE</span> <span class="c-var">created_at</span> &gt;= <span class="c-fn">NOW</span>() - <span class="c-key">INTERVAL</span> <span class="c-str">'30 days'</span>
    <span class="c-key">GROUP BY</span> <span class="c-var">user_id</span>
    <span class="c-key">ORDER BY</span> <span class="c-var">total_paid</span> <span class="c-key">DESC</span>
    <span class="c-key">LIMIT</span> <span class="c-num">10</span>
)
<span class="c-key">SELECT</span> <span class="c-var">u</span>.<span class="c-var">id</span>, <span class="c-var">u</span>.<span class="c-var">email</span>, <span class="c-var">tp</span>.<span class="c-var">total_paid</span>,
       (<span class="c-key">SELECT</span> <span class="c-fn">COUNT</span>(*) <span class="c-key">FROM</span> <span class="c-type">orders</span> <span class="c-key">WHERE</span> <span class="c-var">user_id</span> = <span class="c-var">u</span>.<span class="c-var">id</span>) <span class="c-key">AS</span> <span class="c-var">orders_count</span>
<span class="c-key">FROM</span> <span class="c-var">top_payers</span> <span class="c-var">tp</span> <span class="c-key">JOIN</span> <span class="c-type">users</span> <span class="c-var">u</span> <span class="c-key">ON</span> <span class="c-var">u</span>.<span class="c-var">id</span> = <span class="c-var">tp</span>.<span class="c-var">user_id</span>
<span class="c-key">ORDER BY</span> <span class="c-var">tp</span>.<span class="c-var">total_paid</span> <span class="c-key">DESC</span>;
</code></pre>
    <p class="text">CTE сужает множество до 10 user_id за один Index Scan по payments. Дальше &mdash; точечные lookup'ы по индексам. Итог: 4200 мс &rarr; 40 мс. Архитектура не менялась, кэш не добавлен.</p>
  </div>
</div>

<div id="sec-pitfalls" class="section">
  <div class="section-title">Сводные подводные камни</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Топ ошибок</div>
    <div class="pitfall"><strong>1. <code>SELECT *</code> в продакшен-коде.</strong> Тянет все столбцы, ломает covering index, делает запрос хрупким к ALTER TABLE.</div>
    <div class="pitfall"><strong>2. ORDER BY RAND().</strong> Сортирует всю таблицу случайно. Используйте <code>OFFSET random()</code> или столбец с pre-generated random.</div>
    <div class="pitfall"><strong>3. OFFSET для пагинации.</strong> <code>OFFSET 100000</code> заставляет прочитать первые 100к и отбросить. Keyset pagination: <code>WHERE id &gt; last_id ORDER BY id LIMIT 10</code>.</div>
    <div class="pitfall"><strong>4. <code>COUNT(*)</code> на большой таблице.</strong> Postgres &mdash; full scan. Приближённо: <code>pg_stat_user_tables.n_live_tup</code>.</div>
    <div class="pitfall"><strong>5. <code>UPDATE</code> без <code>WHERE</code> на проде.</strong> Включите <code>SET SQL_SAFE_UPDATES = 1</code>.</div>
    <div class="pitfall"><strong>6. <code>TRUNCATE</code> в транзакции MySQL.</strong> Неявно коммитит; rollback не вернёт данные. На Postgres &mdash; транзакционный.</div>
    <div class="pitfall"><strong>7. Hard-coded <code>'utf8'</code>.</strong> MySQL <code>utf8</code> &mdash; 3-байтная подделка. Всегда <code>utf8mb4</code>.</div>
    <div class="pitfall"><strong>8. Долгие транзакции с пользовательским вводом.</strong> Открыли транзакцию, ждём ответа API &mdash; соединение и блокировки висят. Внешние вызовы &mdash; вне транзакции.</div>
    <div class="pitfall"><strong>9. Игнорирование NULL в UNIQUE.</strong> Два NULL не равны &mdash; уникальный индекс не предотвращает дубли NULL. Partial index <code>WHERE col IS NOT NULL</code>.</div>
    <div class="pitfall"><strong>10. <code>JSON_EXTRACT</code> в WHERE без индекса.</strong> Полное сканирование. Используйте GIN на JSONB.</div>
    <div class="pitfall"><strong>11. <code>ENUM</code> с большим количеством значений.</strong> Расширение &mdash; ALTER с перезаписью. Используйте справочную таблицу + FK.</div>
    <div class="pitfall"><strong>12. Replication lag в read-modify-write.</strong> Запись на мастер, чтение со slave &mdash; видим устаревшее. Читайте с мастера после критичных записей.</div>
    <div class="pitfall"><strong>13. <code>WHERE YEAR(col) = 2024</code> убивает индекс.</strong> Функция вокруг колонки делает индекс неприменимым. Перепишите как range: <code>WHERE col BETWEEN '2024-01-01' AND '2024-12-31'</code>.</div>
    <div class="pitfall"><strong>14. <code>LEFT JOIN + WHERE IS NOT NULL</code> = INNER JOIN.</strong> Если условие на правой стороне идёт в WHERE &mdash; вы фактически отфильтровываете строки, где правая сторона NULL, превращая LEFT в INNER. Если хотели INNER &mdash; пишите явно.</div>
    <div class="pitfall"><strong>15. Correlated subquery в SELECT.</strong> <code>SELECT u.*, (SELECT MAX(...) FROM orders WHERE user_id = u.id) FROM users</code> &mdash; N+1 на уровне SQL. Перепишите через JOIN + GROUP BY или CTE.</div>
    <div class="pitfall"><strong>16. Забытое условие при старом SQL-89 синтаксисе.</strong> <code>FROM users, orders</code> без WHERE = CROSS JOIN на триллион строк. Используйте только ANSI JOIN с явным ON.</div>
    <div class="pitfall"><strong>17. <code>UNION</code> вместо <code>UNION ALL</code>.</strong> UNION неявно делает DISTINCT &mdash; сортирует/хеширует весь результат. Если дубли невозможны/неважны &mdash; UNION ALL быстрее в разы.</div>
    <div class="pitfall"><strong>18. <code>FORCE INDEX</code> как «решение».</strong> Маскирует устаревшую статистику или плохой дизайн индекса. Через полгода данные изменятся и hint станет вредным.</div>
  </div>
</div>

<div id="sec-interview" class="section">
  <div class="section-title">Вопросы на собеседование (middle / senior)</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="brain"></i> Основы и индексы</div>
    <div class="card"><h3>1. Почему B-Tree по умолчанию?</h3><p class="text">B-Tree поддерживает поиск по равенству, диапазон и сортировку с одной структурой; Hash &mdash; только равенство. Большинство запросов комбинируют эти операции, поэтому B-Tree универсальнее.</p></div>
    <div class="card"><h3>2. Что такое leftmost prefix rule?</h3><p class="text">Композитный индекс <code>(a, b, c)</code> используется при фильтре по a, (a,b), (a,b,c). Только по b или c &mdash; не работает. Из этого: первой ставится колонка с точной фильтрацией; следующие &mdash; по убыванию селективности.</p></div>
    <div class="card"><h3>3. Что такое covering index?</h3><p class="text">Индекс содержит все столбцы, нужные запросу (и WHERE, и SELECT). СУБД отвечает только из индекса. Postgres &mdash; через <code>INCLUDE</code>; MySQL &mdash; широким композитом.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Транзакции</div>
    <div class="card"><h3>4. Чем отличаются READ COMMITTED и REPEATABLE READ?</h3><p class="text">При READ COMMITTED один SELECT может возвращать разные результаты (non-repeatable read). При REPEATABLE READ &mdash; snapshot на момент начала транзакции, non-repeatable невозможен. Postgres дополнительно исключает phantom reads на REPEATABLE READ.</p></div>
    <div class="card"><h3>5. Как избежать lost update?</h3><p class="text">Три подхода: (а) атомарный UPDATE с условием; (б) pessimistic locking через <code>SELECT FOR UPDATE</code>; (в) optimistic locking через <code>version</code> + retry при конфликте.</p></div>
    <div class="card"><h3>6. Что такое deadlock и как его избежать?</h3><p class="text">Две транзакции взаимно ждут блокировки друг друга. СУБД детектирует и отменяет одну. Профилактика: всегда захватывать блокировки в одном порядке, избегать долгих транзакций, использовать <code>SKIP LOCKED</code> для очередей.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Производительность</div>
    <div class="card"><h3>7. Как искать причину медленного запроса?</h3><p class="text">(1) включить slow query log; (2) <code>EXPLAIN ANALYZE</code>; (3) искать Seq Scan на больших таблицах, Filter после Index Scan, Sort/filesort; (4) проверить актуальность статистики (<code>ANALYZE</code>); (5) при расхождении оценки и факта &mdash; устаревшая статистика; (6) добавить индекс или переписать запрос.</p></div>
    <div class="card"><h3>8. Что такое N+1 и способы решения?</h3><p class="text">Один запрос на родителей + N запросов на детей. В Eloquent &mdash; eager loading (<code>with('relation')</code>): 2 запроса вместо N+1. Альтернативы: JOIN, денормализованные счётчики, window functions, GraphQL DataLoader.</p></div>
    <div class="card"><h3>9. Что покажет EXPLAIN для <code>WHERE LOWER(email) = ?</code>?</h3><p class="text">Полное сканирование, даже если есть индекс по <code>email</code>. Функция вокруг колонки делает индекс неприменимым. Решения: функциональный индекс или нормализация регистра при вставке.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Продвинутое</div>
    <div class="card"><h3>10. JSONB в Postgres vs JSON в MySQL?</h3><p class="text">JSONB &mdash; бинарный с GIN-индексированием (<code>WHERE data @&gt; '{"status":"paid"}'</code> работает за O(log n)). MySQL JSON &mdash; индексирование через generated columns. На больших JSON-запросах Postgres удобнее.</p></div>
    <div class="card"><h3>11. Когда window function вместо self-JOIN?</h3><p class="text">Когда нужно значение по соседним строкам в окне (предыдущая, накопительный итог, ранг). Window &mdash; одно сканирование; self-JOIN &mdash; квадратичная сложность. На тысячах строк разница на порядки.</p></div>
    <div class="card"><h3>12. Что такое prepared statement?</h3><p class="text">Запрос с placeholder'ами, компилируемый раз, исполняемый N раз. Безопасность от инъекций (значения не парсятся как SQL), кешируемый план. На MySQL включайте <code>ATTR_EMULATE_PREPARES = false</code> для настоящих серверных prepared.</p></div>
    <div class="card"><h3>13. UPSERT в MySQL vs Postgres?</h3><p class="text">MySQL: <code>INSERT ... ON DUPLICATE KEY UPDATE</code>. Postgres: <code>INSERT ... ON CONFLICT (col) DO UPDATE SET col = EXCLUDED.col</code>. Postgres требует указать колонку конфликта явно &mdash; точнее.</p></div>
    <div class="card"><h3>14. Что такое MVCC и почему чтения не блокируют записи?</h3><p class="text">Каждое изменение строки создаёт новую версию с txid. Читающие транзакции видят только версии на момент начала. SELECT никогда не ждёт UPDATE. Цена: bloat от старых версий, очищаемых через autovacuum.</p></div>
    <div class="card"><h3>15. Как сделать пагинацию на 100к-ю страницу без O(N)?</h3><p class="text">Keyset pagination: <code>WHERE id &gt; :last_id ORDER BY id LIMIT 10</code>. СУБД делает Index Seek в нужное место. Минус: нельзя перепрыгивать на «страницу 500».</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cpu"></i> Внутренности и продвинутые механизмы</div>
    <div class="card"><h3>16. Чем correlated subquery отличается от uncorrelated?</h3><p class="text">Uncorrelated не ссылается на колонки внешнего запроса — выполняется один раз. Correlated ссылается — выполняется для каждой строки внешнего, что эквивалентно N+1 на уровне SQL. Лечение: переписать через JOIN + GROUP BY, CTE или window function.</p></div>
    <div class="card"><h3>17. Чем EXISTS отличается от IN и когда они дают разный результат?</h3><p class="text">EXISTS останавливается на первом совпадении; IN материализует полный список. Дают разный результат при NULL: <code>NOT IN (...)</code> с NULL в подзапросе вернёт пусто (UNKNOWN-логика); <code>NOT EXISTS</code> работает корректно. На больших подзапросах EXISTS обычно эффективнее.</p></div>
    <div class="card"><h3>18. Что такое buffer pool в InnoDB и почему его размер критичен?</h3><p class="text">Главный in-memory кеш страниц данных и индексов. Все чтения и записи сначала идут через него. Если активные данные не помещаются в buffer pool — постоянные I/O на диск. Дефолт <code>innodb_buffer_pool_size = 128MB</code> подходит только для разработки; в проде ставится 50-80% RAM сервера БД.</p></div>
    <div class="card"><h3>19. Когда применять partitioning и в чём отличие от sharding?</h3><p class="text"><strong>Partitioning</strong> — одна БД, физическое разделение таблицы на части по правилу (RANGE/LIST/HASH). Запрос с фильтром по ключу читает только нужную партицию (pruning). Хорош для time-series и архивации. <strong>Sharding</strong> — данные на разных серверах; ключ определяет, к какому шарду идти. Цена: сложность JOIN/транзакций между шардами. Sharding применяется когда одной БД не хватает.</p></div>
    <div class="card"><h3>20. Materialized View vs обычный View — практическая разница?</h3><p class="text">Обычный View — синоним сохранённого SELECT, выполняется при каждом обращении. Materialized View — физически сохранённый результат, обновляется по команде <code>REFRESH</code>. MV даёт мгновенный ответ на тяжёлые агрегаты (отчёты, дашборды), цена — данные могут быть устаревшими между обновлениями. Хорошая стратегия — schedule refresh каждые 5-15 минут или после критичных событий.</p></div>
    <div class="card"><h3>21. Почему стоит избегать stored procedures в современных проектах?</h3><p class="text">Логика приложения уезжает в БД — сложнее версионировать (нет git-аналога для процедур, кроме миграций), сложнее тестировать (нельзя обычный unit-test на PHP), сложнее отлаживать. Альтернативные языки (PL/pgSQL, T-SQL) ограничены. Исключение: критичные по производительности операции с миллионами row-операций, где избегание round-trip даёт x10 выигрыш.</p></div>
    <div class="card"><h3>22. Какая разница между <code>SERIAL</code>, <code>AUTO_INCREMENT</code> и <code>IDENTITY</code>?</h3><p class="text">Семантически одно — auto-incrementing PK. Реализации разные: PostgreSQL <code>SERIAL</code> создаёт sequence + default; MySQL <code>AUTO_INCREMENT</code> хранит next-value в metadata; SQL Server <code>IDENTITY(1,1)</code> — встроенное свойство колонки. Поведение при rollback: gap (PG/MySQL пропускают значения), что не критично, но удивляет джунов.</p></div>
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
