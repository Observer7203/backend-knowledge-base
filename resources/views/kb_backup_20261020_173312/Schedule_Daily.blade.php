@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Расписание обучения — Backend PHP/Laravel</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

  :root {
    --bg:    #F5F8FA;
    --sf:    #FFFFFF;
    --sf2:   #F9FAFB;
    --bd:    #E4E6EF;
    --tx:    #181C32;
    --tx2:   #7E8299;
    --tx3:   #A1A5B7;
    --ac:    #404357;
    --ac2:   #EFF2F5;
    --gr:    #50CD89;
    --gr2:   #E8FFF3;
    --gr3:   #0D7D53;
    --yl:    #FFC700;
    --yl2:   #FFF8DD;
    --yl3:   #B45309;
    --rd:    #F1416C;
    --rd2:   #FFF5F8;
    --bl:    #009EF7;
    --bl2:   #EEF7FF;
    --or:    #E65100;
    --or2:   #FFF3E0;
    --pu:    #7239EA;
    --pu2:   #F8F5FF;
    --shadow: 0 2px 10px rgba(24,28,50,0.07);
    --shadow-h: 0 6px 20px rgba(24,28,50,0.11);
    --radius: 10px;
  }

  *{margin:0;padding:0;box-sizing:border-box;}

  body {
    font-family:'Inter',-apple-system,sans-serif;
    background: var(--bg);
    color: var(--tx);
    line-height:1.6;
    -webkit-font-smoothing: antialiased;
  }

  .app { width:100%; padding:24px 40px 60px; max-width:1200px; margin:0 auto; }

  .back-link {
    display:inline-flex; align-items:center; gap:7px;
    color:var(--ac); text-decoration:none; font-size:13px; font-weight:600;
    padding:7px 12px; border-radius:7px; margin-bottom:14px;
    transition:background 0.2s;
  }
  .back-link:hover { background:var(--ac2); }
  .back-link svg { width:14px; height:14px; }

  .header {
    text-align:center;
    padding:40px 24px 32px;
    margin-bottom:22px;
    background:var(--sf);
    border-radius:14px;
    border:1px solid var(--bd);
    box-shadow:var(--shadow);
  }
  .header h1{font-size:1.9rem;font-weight:800;margin-bottom:6px;color:var(--tx);letter-spacing:-0.3px;}
  .header h1 span{color:var(--ac);}
  .header p{color:var(--tx2);font-size:0.9rem;}
  .header .target{
    display:inline-block;margin-top:14px;padding:8px 18px;
    background:linear-gradient(135deg,var(--gr2),var(--bl2));
    border-radius:8px;font-weight:700;color:var(--tx);font-size:0.88rem;
    border:1px solid rgba(80,205,137,0.3);
  }
  .header .target strong{color:var(--gr3);}

  .progress-wrap{margin-bottom:22px;background:var(--sf);border:1px solid var(--bd);border-radius:var(--radius);padding:16px 20px;box-shadow:var(--shadow);}
  .progress-bar{width:100%;height:8px;background:var(--sf2);border-radius:5px;overflow:hidden;}
  .progress-fill{height:100%;background:linear-gradient(90deg,var(--ac),#74C0FC);border-radius:5px;transition:width 0.5s;}
  .progress-label{display:flex;justify-content:space-between;margin-top:8px;font-size:0.78rem;color:var(--tx2);font-weight:500;}

  .controls{display:flex;gap:6px;margin-bottom:18px;flex-wrap:wrap;align-items:center;}
  .week-btn{
    padding:8px 14px;border-radius:8px;cursor:pointer;font-size:0.82rem;font-weight:600;
    background:var(--sf);border:1px solid var(--bd);color:var(--tx2);
    transition:all 0.18s;font-family:'Inter',-apple-system,sans-serif;
    position:relative;
  }
  .week-btn:hover{background:var(--bg);border-color:var(--ac);color:var(--ac);}
  .week-btn.active{background:var(--ac);color:#fff;border-color:var(--ac);}
  .week-btn.done{background:var(--gr2);color:var(--gr3);border-color:rgba(80,205,137,0.4);}
  .week-btn.milestone::after{
    content:'★';position:absolute;top:-7px;right:-7px;
    background:var(--yl);color:#fff;width:18px;height:18px;
    border-radius:50%;font-size:10px;line-height:18px;text-align:center;
  }

  .week-panel{display:none;}
  .week-panel.active{display:block;}

  .week-header{
    background:var(--sf);border:1px solid var(--bd);border-radius:12px;
    padding:20px 24px;margin-bottom:14px;box-shadow:var(--shadow);
  }
  .week-header h2{font-size:1.2rem;font-weight:700;margin-bottom:4px;color:var(--tx);}
  .week-header .theme{color:var(--ac);font-size:0.93rem;font-weight:600;}
  .week-header .goal{color:var(--tx2);font-size:0.83rem;margin-top:8px;line-height:1.6;}
  .week-header .review-tag{
    display:inline-block;background:var(--yl2);color:var(--yl3);
    padding:3px 10px;border-radius:6px;font-size:0.76rem;font-weight:700;margin-top:10px;margin-right:6px;
  }
  .week-header .milestone-tag{
    display:inline-block;background:linear-gradient(135deg,var(--gr2),var(--bl2));
    color:var(--gr3);
    padding:6px 14px;border-radius:6px;font-size:0.8rem;font-weight:700;margin-top:10px;
    border:1px solid rgba(80,205,137,0.35);
  }

  .day-card{
    background:var(--sf);border:1px solid var(--bd);border-radius:var(--radius);
    margin-bottom:10px;box-shadow:var(--shadow);transition:all 0.18s;
  }
  .day-card:hover{border-color:var(--ac);box-shadow:var(--shadow-h);}
  .today-marker{border-color:var(--ac)!important;box-shadow:0 0 0 2px rgba(64,67,87,0.15)!important;}

  .day-head{padding:13px 20px;display:flex;justify-content:space-between;align-items:center;cursor:pointer;}
  .day-head:hover{background:var(--bg);border-radius:var(--radius) var(--radius) 0 0;}
  .day-label{font-weight:700;font-size:0.93rem;color:var(--tx);}
  .day-label .date{color:var(--tx2);font-weight:400;font-size:0.8rem;margin-left:8px;}
  .day-dur{color:var(--tx3);font-size:0.78rem;font-weight:500;}
  .day-body{padding:0 20px 14px;display:none;border-top:1px solid var(--bd);}
  .day-card.open .day-body{display:block;}

  .task{display:flex;gap:10px;padding:10px 0;border-bottom:1px solid var(--bd);align-items:flex-start;}
  .task:last-child{border:none;}
  .task-check{
    width:20px;height:20px;border-radius:5px;border:2px solid var(--bd);
    cursor:pointer;flex-shrink:0;margin-top:2px;
    display:flex;align-items:center;justify-content:center;
    transition:all 0.18s;font-size:0.7rem;
  }
  .task-check.done{background:var(--gr);border-color:var(--gr);}
  .task-check.done::after{content:'✓';color:#fff;font-weight:700;}
  .task-info{flex:1;}
  .task-title{font-weight:600;font-size:0.88rem;color:var(--tx);}
  .task-title.struck{text-decoration:line-through;opacity:0.4;}
  .task-detail{color:var(--tx2);font-size:0.8rem;margin-top:2px;line-height:1.5;}
  .task-file{
    display:inline-block;background:var(--ac2);color:var(--ac);
    padding:2px 8px;border-radius:4px;font-size:0.7rem;font-weight:600;
    margin-top:4px;text-decoration:none;transition:background 0.2s;
  }
  .task-file:hover{background:rgba(64,67,87,0.2);}

  .task-type{display:inline-block;padding:2px 8px;border-radius:4px;font-size:0.68rem;font-weight:700;margin-top:4px;margin-right:4px;}
  .type-read   {background:var(--bl2);color:var(--bl);}
  .type-quiz   {background:var(--yl2);color:var(--yl3);}
  .type-code   {background:var(--gr2);color:var(--gr3);}
  .type-review {background:var(--or2);color:var(--or);}
  .type-project{background:var(--rd2);color:var(--rd);}

  @media(max-width:768px){
    .app{padding:14px 16px 40px;}
    .header h1{font-size:1.4rem;}
    .controls{gap:5px;}
    .week-btn{padding:6px 12px;font-size:0.76rem;}
  }
</style>
</head>
<body>
<div class="app">

  <a class="back-link" href="/"><i data-lucide="arrow-left"></i> На главную</a>

  <div class="header">
    <h1>Расписание <span>под собес $2500-3000</span></h1>
    <p>13 недель · Пн-Пт без выходных · 1.5-2 часа/день · ~3 секции/день</p>
    <p style="font-size:0.8rem;color:var(--tx2);margin-top:6px;">Старт: 1 июня 2026 (понедельник). Каждая задача привязана к разделу в KB.</p>
    <div class="target">🎯 Цель: <strong>Middle PHP/Laravel</strong> · $2500-3000 после 8-9 недели</div>
  </div>

  <div class="progress-wrap">
    <div class="progress-bar"><div class="progress-fill" id="main-progress" style="width:0%"></div></div>
    <div class="progress-label"><span id="prog-text">0 / 0 задач</span><span id="prog-pct">0%</span></div>
  </div>

  <div class="controls" id="week-tabs"></div>
  <div id="panels"></div>

</div>

<script>
const START = new Date(2026, 5, 1); // 1 June 2026 (Monday)
const DAY_LABELS = ['Пн','Вт','Ср','Чт','Пт'];

const weeks = [
  // ═══════════════════ МЕСЯЦ 1 — ФУНДАМЕНТ ═══════════════════
  // ───── НЕДЕЛЯ 1 ─────
  { title: "Неделя 1: PHP Core — часть 1", theme: "Типы, строки, массивы, базовая ООП",
    goal: "Закрепить фундамент PHP. KB_1 разделы 1-7. После недели — уверенно по типам, type juggling, базовому ООП.",
    days: [
      { tasks: [
        { t: "Типы данных PHP", d: "KB_1 разд.1 — int/float/string/bool/null, type juggling, strict_types, cast (array)object.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Операторы сравнения == vs === vs <=>", d: "Pitfalls juggling, '0'==false, [] == null, spaceship.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: 5 strict_types кейсов", d: "Файл strict_test.php — функции с TypeError, json decode, cast объектов с null-байтами.", type: "code" },
      ]},
      { tasks: [
        { t: "Строки + regex", d: "KB_1 разд.2 — mb_string, str_contains, sprintf, heredoc, preg_match.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: regex задачи", d: "1) валидация email/телефона. 2) extract URL. 3) replace HTML tags. 4) split CSV. 5) named groups.", type: "code" },
      ]},
      { tasks: [
        { t: "Массивы углублённо", d: "KB_1 разд.3 — array_map/filter/reduce, usort, => оператор, destructuring, compound операторы.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "array_walk + & (передача по ссылке)", d: "KB_1 — как & работает, отличие от array_map.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: трансформация данных", d: "Массив users [{name,age,city}]. Фильтр по возрасту, группировка по городу, средний возраст через reduce.", type: "code" },
      ]},
      { tasks: [
        { t: "ООП — Классы, $this, конструкторы", d: "KB_1 разд.4 — $this, constructor property promotion, visibility.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "static/self/parent + Late Static Binding", d: "KB_1 — обращение к классовым членам, static:: vs self::.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Квиз: что выведет static:: vs self::", d: "Напиши пример с Parent/Child. Предскажи вывод. Проверь.", type: "quiz" },
      ]},
      { tasks: [
        { t: "Абстрактные классы и интерфейсы", d: "KB_1 разд.5 — abstract, interface, разница, 5 реальных примеров (Animal/CrudController/NotificationService/BaseEntity/FilterIterator).", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "final vs readonly + когда override невозможен", d: "KB_1 — 6 ситуаций где переопределение невозможно.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: PaymentInterface", d: "Stripe/PayPal реализации, полиморфизм через type-hint интерфейса.", type: "code" },
      ]},
    ]
  },

  // ───── НЕДЕЛЯ 2 ─────
  { title: "Неделя 2: PHP Core — часть 2", theme: "Traits, magic, PHP 8.x, namespaces, generators, closures", review: "Повтор: типы, ООП (нед.1)",
    goal: "Закрыть KB_1 разделы 6-12. После недели — PHP Core полностью пройден.",
    days: [
      { tasks: [
        { t: "Traits", d: "KB_1 разд.6 — синтаксис, конфликты, abstract methods в trait, реальные кейсы.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Магические методы", d: "KB_1 разд.7 — __get/__set, __call, __toString, __invoke, __isset.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: Collection trait", d: "Trait Serializable с toJson(). Класс Collection использует. __toString показывает count.", type: "code" },
      ]},
      { tasks: [
        { t: "Namespaces & PSR-4", d: "KB_1 разд.8 — namespace, use, alias, composer autoload.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Обработка ошибок", d: "KB_1 разд.9 — try/catch/finally, custom exceptions, Error vs Exception, previous chain.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: цепочка exceptions", d: "ValidationException → NotFoundException → DatabaseException. Сервис ловит PDOException и оборачивает.", type: "code" },
      ]},
      { tasks: [
        { t: "PHP 8.x фичи", d: "KB_1 разд.10 — match, enums, named args, readonly, nullsafe, attributes.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: рефактор на PHP 8", d: "switch → match. Константы → enum. Конструктор → property promotion. Цепочки → nullsafe.", type: "code" },
      ]},
      { tasks: [
        { t: "Генераторы и Closures", d: "KB_1 разд.11-12 — yield, yield from, anonymous functions, arrow fn, binding.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: CSV генератор", d: "Generator читает CSV построчно. Сравни memory_get_usage с file_get_contents.", type: "code" },
        { t: "🔄 Повтор: квизы нед.1 разд.1-5", d: "Без подглядывания: типы, == vs ===, $this, static::, final vs readonly.", type: "review" },
      ]},
      { tasks: [
        { t: "Мини-проект: CLI утилита", d: "Парсит named args, enum для команд, generator для логов, custom exceptions.", type: "project" },
        { t: "📋 Открой Шпаргалку PHP в KB_1", d: "KB_1 → раздел 'Шпаргалка PHP'. Прочитай все сводные таблицы (типы, массивы, ООП, magic, PHP 8). Распечатай или сохрани.", file: "KB_1_PHP_Core.html", type: "review" },
        { t: "🛠 Практика руками — микро-задачи 1-5", d: "KB_1 → раздел 'Практика руками'. Сделай первые 5 микро-задач по 15 мин каждая (type juggling, strict_types, regex, sprintf, array_map).", file: "KB_1_PHP_Core.html", type: "code" },
      ]},
    ]
  },

  // ───── НЕДЕЛЯ 3 ─────
  { title: "Неделя 3: SQL — часть 1", theme: "SELECT, JOIN, агрегаты, подзапросы, индексы", review: "Повтор: PHP ООП (нед.1-2)",
    goal: "KB_2 разделы 1-10. JOIN'ы и индексы — самое спрашиваемое.",
    days: [
      { tasks: [
        { t: "SQL основы", d: "KB_2 разд.1 — SELECT, INSERT, UPDATE, DELETE, WHERE, ORDER BY, LIMIT.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "DDL: CREATE/ALTER/DROP", d: "KB_2 разд.2 — структура таблиц, PRIMARY KEY, FOREIGN KEY, constraints.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Типы данных MySQL/PG", d: "KB_2 разд.3 — INT/BIGINT, DECIMAL vs FLOAT, VARCHAR vs TEXT, JSON, TIMESTAMP.", file: "KB_2_SQL_Database.html", type: "read" },
      ]},
      { tasks: [
        { t: "JOIN'ы глубоко", d: "KB_2 разд.4 — INNER, LEFT, RIGHT, FULL, CROSS, SELF. Визуальные диаграммы.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Практика: все типы JOIN", d: "users/orders/products. Каждый тип JOIN. Объясни вслух разницу LEFT и INNER.", type: "code" },
      ]},
      { tasks: [
        { t: "Агрегатные функции + GROUP BY", d: "KB_2 разд.5 — COUNT, SUM, AVG, MIN, MAX, GROUP BY, HAVING.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Подзапросы", d: "KB_2 разд.6 — correlated vs non-correlated, EXISTS, IN, ANY/ALL.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Практика: сложные запросы", d: "1) Топ-5 клиентов по сумме. 2) Товары без заказов (LEFT JOIN NULL). 3) Средний чек по месяцам.", type: "code" },
      ]},
      { tasks: [
        { t: "Индексы глубоко", d: "KB_2 разд.7 — B-tree, Clustered/Non-clustered, Composite, Covering, leftmost prefix rule.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Storage engines + Partitioning", d: "KB_2 разд.8-9 — InnoDB vs MyISAM, partitioning стратегии.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Квиз: индексы", d: "Зачем composite index, leftmost prefix rule, когда НЕ нужен индекс?", type: "quiz" },
      ]},
      { tasks: [
        { t: "EXPLAIN и оптимизация", d: "KB_2 разд.10 — чтение EXPLAIN, типы сканирования, hints.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Практика: EXPLAIN своих запросов", d: "5 запросов вторника. EXPLAIN. Добавь индексы. Сравни.", type: "code" },
        { t: "🔄 Повтор: PHP traits + magic", d: "KB_1 разд.6-7 — без подглядывания.", type: "review" },
      ]},
    ]
  },

  // ───── НЕДЕЛЯ 4 ─────
  { title: "Неделя 4: SQL — часть 2 + Laravel старт", theme: "Транзакции, ACID, нормализация, PDO + начало Laravel", review: "Повтор: JOIN'ы, индексы (нед.3)",
    milestone: "🎯 Конец Месяца 1: пробные собесы на $1800-2200 (junior+)",
    goal: "Закрыть SQL полностью + начать Laravel. ACID — обязательно на собесе.",
    days: [
      { tasks: [
        { t: "Транзакции и ACID", d: "KB_2 разд.11 — BEGIN/COMMIT/ROLLBACK, SAVEPOINT, deadlocks.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Уровни изоляции", d: "KB_2 разд.12 — Read Uncommitted → Serializable. Dirty/non-repeatable/phantom reads.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Практика: транзакция перевода", d: "BEGIN, два UPDATE, COMMIT. Покажи ROLLBACK. Сценарий deadlock.", type: "code" },
      ]},
      { tasks: [
        { t: "Нормализация", d: "KB_2 разд.13-14 — 1NF, 2NF, 3NF, BCNF. Before/after примеры. Денормализация когда.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Проектирование БД", d: "KB_2 разд.15-16 — ER-диаграммы, 1:1/1:N/N:M, pivot, polymorphic relations.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Практика: БД для блога", d: "Users, Posts, Comments, Tags (N:M), Categories. CREATE TABLE с FK.", type: "code" },
      ]},
      { tasks: [
        { t: "MySQL vs PostgreSQL + Materialized Views", d: "KB_2 разд.17-18 — различия, JSONB, FULLTEXT, MV.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "PDO в PHP", d: "KB_2 разд.19 — prepared statements, fetch modes, transactions, биндинг параметров.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "SQL Server / Vendor specific", d: "KB_2 разд.20 — обзор T-SQL отличий (по диагонали).", file: "KB_2_SQL_Database.html", type: "read" },
      ]},
      { tasks: [
        { t: "Laravel — Lifecycle запроса", d: "KB_3 разд.1 — index.php → bootstrap → kernel → middleware → router → controller. MUST KNOW.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Квиз: lifecycle наизусть", d: "Закрой KB. Напиши все шаги request lifecycle. Проверь.", type: "quiz" },
        { t: "Routing глубоко", d: "KB_3 разд.2 — Route::get/post, parameters, constraints, named routes, groups, prefix.", file: "KB_3_Laravel.html", type: "read" },
      ]},
      { tasks: [
        { t: "Контроллеры + Middleware basics", d: "KB_3 разд.3-4 — Resource controllers, invokable, middleware before/after.", file: "KB_3_Laravel.html", type: "read" },
        { t: "🔄 Повтор: SQL квизы все", d: "JOIN'ы, ACID, нормализация, индексы — без подглядывания.", type: "review" },
        { t: "❓ Вопросник KB_1 — Уровень 1 (Junior+)", d: "KB_1 → раздел 'Вопросник для собеса'. Пройди 10 вопросов Уровня 1. Отвечай ВСЛУХ. Запиши слабые места.", file: "KB_1_PHP_Core.html", type: "quiz" },
        { t: "Шпаргалка SQL", d: "JOIN'ы, ACID 4 буквы, нормализация 1-3NF, composite index, leftmost prefix.", type: "review" },
      ]},
    ]
  },

  // ═══════════════════ МЕСЯЦ 2 — LARAVEL + DI + SECURITY ═══════════════════
  // ───── НЕДЕЛЯ 5 ─────
  { title: "Неделя 5: Laravel Core — Eloquent, Queues, Auth", theme: "Eloquent, N+1, Queues, Events, Sanctum, Policies", review: "Повтор: SQL JOIN (нед.3)",
    goal: "KB_3 разделы 5-14. Главные темы для middle Laravel-собеса.",
    days: [
      { tasks: [
        { t: "Eloquent основы", d: "KB_3 разд.5 — модели, casts, accessors/mutators, scopes, observers.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Eloquent relationships", d: "KB_3 разд.6 — hasOne, hasMany, belongsTo, belongsToMany, polymorphic.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Практика: рефактор модели", d: "Модель из своего проекта. Добавь local scope, accessor, custom cast.", type: "code" },
      ]},
      { tasks: [
        { t: "N+1 Problem & Eager Loading", d: "KB_3 разд.7 — with(), load(), withCount(), preventLazyLoading. INTERVIEW MUST.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Практика: найди и исправь N+1", d: "Telescope/Debugbar в своём проекте. Список → посчитай запросы → with() → сравни.", type: "code" },
      ]},
      { tasks: [
        { t: "FormRequest + Validation", d: "KB_3 разд.8 — rules(), authorize(), prepareForValidation, custom messages.", file: "KB_3_Laravel.html", type: "read" },
        { t: "API Resources + Pagination", d: "KB_3 разд.9 — JsonResource, Collection, paginate vs cursorPaginate.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Практика: API endpoint", d: "GET /api/posts с PostResource + pagination + filter через FormRequest.", type: "code" },
      ]},
      { tasks: [
        { t: "Queues & Jobs", d: "KB_3 разд.10 — dispatch, drivers, workers, failed jobs, retries.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Events & Listeners", d: "KB_3 разд.11 — events, listeners, subscribers, async через ShouldQueue.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Практика: SendWelcomeEmail job", d: "Job с retry, dispatch при регистрации, worker запуск, failed handler.", type: "code" },
      ]},
      { tasks: [
        { t: "Sanctum + Policies/Gates", d: "KB_3 разд.12-13 — token auth, abilities, Policy classes, authorize(), @can.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Cache + Scheduler", d: "KB_3 разд.14 — Cache::remember, tags, schedule(), withoutOverlapping.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Практика: полный auth flow", d: "Register → Login (token) → Protected route → Logout с Sanctum. Postman.", type: "code" },
      ]},
    ]
  },

  // ───── НЕДЕЛЯ 6 ─────
  { title: "Неделя 6: Laravel Inheritance — что наследуешь и зачем", theme: "Базовые классы, интерфейсы, трейты, фасады, Contracts", review: "Повтор: Eloquent + N+1 (нед.5)",
    goal: "KB_9 — 22 секции. Что даёт каждый родительский класс. На собесе спрашивают 'что наследует FormRequest' — после недели ответишь сходу.",
    days: [
      { tasks: [
        { t: "Controller + Model базовые", d: "KB_9 — что наследует Controller, что даёт Model (HasFactory, attributes, timestamps).", file: "KB_9_Laravel_Inheritance.html", type: "read" },
        { t: "FormRequest", d: "KB_9 — что умеет родитель, какие методы переопределяешь.", file: "KB_9_Laravel_Inheritance.html", type: "read" },
        { t: "Middleware + Job + Command", d: "KB_9 — структура наследников, какие методы Laravel вызывает.", file: "KB_9_Laravel_Inheritance.html", type: "read" },
        { t: "Практика: PostFormRequest", d: "Создай FormRequest с rules + authorize + prepareForValidation + messages.", type: "code" },
      ]},
      { tasks: [
        { t: "Notification + Mailable", d: "KB_9 — channels, toMail/toDatabase/toSlack, Mailable build.", file: "KB_9_Laravel_Inheritance.html", type: "read" },
        { t: "Event + Listener + Policy", d: "KB_9 — какие методы родители дают, как Laravel разрешает.", file: "KB_9_Laravel_Inheritance.html", type: "read" },
        { t: "Практика: Notification + Listener", d: "Event OrderCreated → Listener SendNotification → Notification по mail+db.", type: "code" },
      ]},
      { tasks: [
        { t: "Seeder/Factory + Rule + Resource", d: "KB_9 — Faker, custom rules, JsonResource поля.", file: "KB_9_Laravel_Inheritance.html", type: "read" },
        { t: "Exception Handler + ServiceProvider", d: "KB_9 — render/report, register vs boot, ServiceProvider lifecycle.", file: "KB_9_Laravel_Inheritance.html", type: "read" },
        { t: "Migration базовый", d: "KB_9 — Schema::create/table, up/down, foreign().", file: "KB_9_Laravel_Inheritance.html", type: "read" },
      ]},
      { tasks: [
        { t: "Интерфейсы Laravel (Contracts)", d: "KB_9 — какие интерфейсы важные, как реализовывать свои.", file: "KB_9_Laravel_Inheritance.html", type: "read" },
        { t: "Трейты Laravel", d: "KB_9 — HasFactory, SoftDeletes, Notifiable, AuthorizesRequests.", file: "KB_9_Laravel_Inheritance.html", type: "read" },
        { t: "Фасады vs Contracts", d: "KB_9 — как работает фасад под капотом, когда лучше Contract.", file: "KB_9_Laravel_Inheritance.html", type: "read" },
      ]},
      { tasks: [
        { t: "Шпаргалка: всё в одной таблице", d: "KB_9 — посмотри финальную шпаргалку всех 22 классов.", file: "KB_9_Laravel_Inheritance.html", type: "review" },
        { t: "Проверь себя", d: "KB_9 quiz — какой класс что даёт. Без подглядывания.", type: "quiz" },
        { t: "🔄 Повтор: N+1 + Queues (нед.5)", d: "Объясни вслух: что такое N+1, как решить, как работает worker.", type: "review" },
      ]},
    ]
  },

  // ───── НЕДЕЛЯ 7 ─────
  { title: "Неделя 7: Eloquent Advanced — часть 1", theme: "Relationships глубоко, scopes, polymorphic, pivot", review: "Повтор: Laravel Inheritance (нед.6)",
    goal: "KB_12 первые ~12 секций. Eloquent — самая объёмная тема (126 подсекций). Темп размеренный.",
    days: [
      { tasks: [
        { t: "Eloquent: model events + observers", d: "KB_12 — creating/created/updating/deleting events, observers, lifecycle.", file: "KB_12_Eloquent_Advanced.html", type: "read" },
        { t: "Casts custom + Value Objects", d: "KB_12 — Castable interface, encrypted casts, custom cast Money/Address.", file: "KB_12_Eloquent_Advanced.html", type: "read" },
        { t: "Практика: ObserverPattern", d: "PostObserver: при created — отправить уведомление автору. При deleting — очистка related.", type: "code" },
      ]},
      { tasks: [
        { t: "Relationships глубоко: hasMany/belongsTo", d: "KB_12 — foreign keys, default models, withDefault, chunk, lazy.", file: "KB_12_Eloquent_Advanced.html", type: "read" },
        { t: "belongsToMany + pivot", d: "KB_12 — pivot fields, withPivot, withTimestamps, custom pivot model, sync/attach/detach.", file: "KB_12_Eloquent_Advanced.html", type: "read" },
        { t: "Практика: Tags для постов", d: "Post belongsToMany Tag with pivot 'order'. sync с {tagId: ['order'=>1]}. Получи Tag и закажи.", type: "code" },
      ]},
      { tasks: [
        { t: "Polymorphic relationships", d: "KB_12 — morphTo, morphMany, morphedByMany. Когда применять (Comments на Post/Video).", file: "KB_12_Eloquent_Advanced.html", type: "read" },
        { t: "Has-many-through + Distance relations", d: "KB_12 — Country → User → Post через hasManyThrough.", file: "KB_12_Eloquent_Advanced.html", type: "read" },
        { t: "Практика: Comments полиморф", d: "Post hasMany morphedComments. Video hasMany morphedComments. Один Comment model.", type: "code" },
      ]},
      { tasks: [
        { t: "Scopes — local + global", d: "KB_12 — scopeActive, GlobalScope::apply, withoutGlobalScope.", file: "KB_12_Eloquent_Advanced.html", type: "read" },
        { t: "Query Builder advanced", d: "KB_12 — whereHas + counts, subqueries, raw expressions, addSelect with subquery.", file: "KB_12_Eloquent_Advanced.html", type: "read" },
        { t: "Практика: TenantScope", d: "GlobalScope авто-фильтр по current tenant_id. Тест что user одного tenant не видит другого.", type: "code" },
      ]},
      { tasks: [
        { t: "Collections deep", d: "KB_12 — все методы Collection (groupBy, mapWithKeys, partition, zip, flatMap).", file: "KB_12_Eloquent_Advanced.html", type: "read" },
        { t: "Lazy Collections + chunking", d: "KB_12 — обработка миллионов записей, chunkById vs chunk, lazy() vs cursor().", file: "KB_12_Eloquent_Advanced.html", type: "read" },
        { t: "🔄 Повтор: Inheritance (нед.6)", d: "Назови 10 базовых классов Laravel и что они дают.", type: "review" },
      ]},
    ]
  },

  // ───── НЕДЕЛЯ 8 ─────
  { title: "Неделя 8: Eloquent Advanced ч.2 + Service Container & DI", theme: "Mass assignment, N+1 deep, DI, bindings, contextual", review: "Повтор: Relationships (нед.7)",
    goal: "Добить KB_12 (вторая половина) + пройти KB_13 (DI глубоко).",
    days: [
      { tasks: [
        { t: "Mass assignment + fillable/guarded", d: "KB_12 — security риски, $fillable vs $guarded, unguard для seeders.", file: "KB_12_Eloquent_Advanced.html", type: "read" },
        { t: "Updates + bulk operations", d: "KB_12 — update vs save, upsert, increment/decrement, mass updates без events.", file: "KB_12_Eloquent_Advanced.html", type: "read" },
        { t: "Soft Deletes + Pruning", d: "KB_12 — SoftDeletes trait, restore, forceDelete, Prunable.", file: "KB_12_Eloquent_Advanced.html", type: "read" },
      ]},
      { tasks: [
        { t: "Eloquent + N+1 deep", d: "KB_12 — preventLazyLoading, model::resolveRelationUsing, with closure, withCount/withAvg.", file: "KB_12_Eloquent_Advanced.html", type: "read" },
        { t: "Database optimization", d: "KB_12 — индексы для Eloquent, slow query log, scout/full-text.", file: "KB_12_Eloquent_Advanced.html", type: "read" },
        { t: "Финал KB_12: pitfalls + quiz", d: "Пройди все pitfalls + quiz последних секций.", file: "KB_12_Eloquent_Advanced.html", type: "quiz" },
      ]},
      { tasks: [
        { t: "Service Container — концепция", d: "KB_13 разд.1-3 — что это, зачем, auto-resolution, make() vs build().", file: "KB_13_Service_Container_DI.html", type: "read" },
        { t: "Bindings — bind/singleton/scoped", d: "KB_13 разд.4-5 — отличия, когда что, instance().", file: "KB_13_Service_Container_DI.html", type: "read" },
        { t: "Практика: bind interface", d: "PaymentInterface → StripePayment в AppServiceProvider. Inject в контроллер.", type: "code" },
      ]},
      { tasks: [
        { t: "Contextual bindings", d: "KB_13 разд.6 — when()->needs()->give(), разные реализации для разных контроллеров.", file: "KB_13_Service_Container_DI.html", type: "read" },
        { t: "Tagged services", d: "KB_13 разд.7 — tag() + tagged(), use case (handlers, processors).", file: "KB_13_Service_Container_DI.html", type: "read" },
        { t: "Autowiring + Method injection", d: "KB_13 разд.8-9 — type-hint в конструкторах и методах, resolve().", file: "KB_13_Service_Container_DI.html", type: "read" },
      ]},
      { tasks: [
        { t: "Service Providers глубоко", d: "KB_13 разд.10-12 — register vs boot, order, package providers.", file: "KB_13_Service_Container_DI.html", type: "read" },
        { t: "Deferred Providers + Package dev", d: "KB_13 разд.13-15 — defer для lazy load, разработка пакетов.", file: "KB_13_Service_Container_DI.html", type: "read" },
        { t: "🔄 Повтор: Eloquent основы (нед.7)", d: "Relationships, scopes, polymorphic — по памяти.", type: "review" },
      ]},
    ]
  },

  // ───── НЕДЕЛЯ 9 ─────
  { title: "Неделя 9: Security — Token Rotation, OAuth, JWT, XSS, CSRF", theme: "Аутентификация и веб-атаки", review: "Повтор: Sanctum + DI (нед.5,8)",
    milestone: "🎯 Конец Месяца 2: РЕАЛЬНО ИДТИ НА СОБЕС $2500-3000",
    goal: "KB_4 — 16 секций. Token Rotation, OAuth, JWT, XSS, CSRF, SQLi, CORS. Spectre на собесе.",
    days: [
      { tasks: [
        { t: "Token Rotation (Access + Refresh)", d: "KB_4 разд.1 — flow, reuse detection, Laravel implementation. ЧАСТО СПРАШИВАЮТ.", file: "KB_4_Security.html", type: "read" },
        { t: "OAuth 2.0 + OpenID Connect", d: "KB_4 разд.2 — Auth Code, PKCE, Client Credentials, deprecated flows, Passport.", file: "KB_4_Security.html", type: "read" },
        { t: "Квиз: OAuth flows", d: "Без KB: 4 flow OAuth 2.0, 2 deprecated, что такое PKCE и зачем.", type: "quiz" },
      ]},
      { tasks: [
        { t: "JWT", d: "KB_4 разд.3 — структура Header.Payload.Signature, HS256 vs RS256, claims.", file: "KB_4_Security.html", type: "read" },
        { t: "Session Security", d: "KB_4 разд.4 — fixation, hijacking, HttpOnly, SameSite, regeneration.", file: "KB_4_Security.html", type: "read" },
        { t: "Практика: JWT", d: "firebase/php-jwt — создай токен с claims, декодируй, проверь exp.", type: "code" },
      ]},
      { tasks: [
        { t: "CSRF Protection", d: "KB_4 разд.5 — attack scenario, Synchronizer Token Pattern, @csrf, SameSite.", file: "KB_4_Security.html", type: "read" },
        { t: "XSS (Stored/Reflected/DOM) + CSP", d: "KB_4 разд.6 — типы, sanitization, CSP headers nonce.", file: "KB_4_Security.html", type: "read" },
        { t: "SQL Injection", d: "KB_4 разд.7 — classic, blind, second-order, prepared statements.", file: "KB_4_Security.html", type: "read" },
      ]},
      { tasks: [
        { t: "CORS", d: "KB_4 разд.8 — same-origin policy, preflight, config/cors.php, credentials.", file: "KB_4_Security.html", type: "read" },
        { t: "Rate Limiting + Brute force", d: "KB_4 разд.9 — token bucket, throttle middleware, login throttling.", file: "KB_4_Security.html", type: "read" },
        { t: "Password security + bcrypt/argon2", d: "KB_4 разд.10 — Hash::make, cost factor, NIST 2024 рекомендации.", file: "KB_4_Security.html", type: "read" },
      ]},
      { tasks: [
        { t: "HTTPS/TLS + Headers + Secrets + RBAC/ABAC", d: "KB_4 разд.11-16 — TLS handshake, HSTS, CSP/X-Frame, env management, role/attribute access.", file: "KB_4_Security.html", type: "read" },
        { t: "Финал KB_4: все квизы + INTERVIEW DRILL", d: "Ответь на все Security вопросы из Backend_Learning_Program вслух.", file: "Backend_Learning_Program.html", type: "quiz" },
        { t: "❓ Вопросник KB_1 — Уровень 2 (Middle, $2500-3000)", d: "KB_1 → раздел 'Вопросник для собеса'. Пройди 20 вопросов Уровня 2 ВСЛУХ. Это ровно те вопросы что спросят на твоём собесе.", file: "KB_1_PHP_Core.html", type: "quiz" },
        { t: "Шпаргалка Security", d: "Token Rotation flow, JWT structure, OAuth flows, CSRF/XSS/CORS — по 2 предложения.", type: "review" },
      ]},
    ]
  },

  // ═══════════════════ МЕСЯЦ 3 — ARCHITECTURE + TESTING + DEVOPS + PRACTICE ═══════════════════
  // ───── НЕДЕЛЯ 10 ─────
  { title: "Неделя 10: Architecture & Design Patterns", theme: "SOLID, GRASP, Repository, Service, GoF, DDD, Clean Architecture", review: "Повтор: Security (нед.9)",
    goal: "KB_5 — 12 секций. SOLID спрашивают ВСЕГДА. Паттерны — must have для middle.",
    days: [
      { tasks: [
        { t: "SOLID — все 5 принципов", d: "KB_5 разд.1 — SRP, OCP, LSP, ISP, DIP с BAD/GOOD кодом. Самый важный раздел.", file: "KB_5_Architecture.html", type: "read" },
        { t: "GRASP + DRY/KISS/YAGNI", d: "KB_5 разд.2 — High Cohesion, Low Coupling, Information Expert.", file: "KB_5_Architecture.html", type: "read" },
        { t: "Квиз: SOLID наизусть", d: "Без KB: каждый принцип — что значит + пример нарушения и исправления.", type: "quiz" },
      ]},
      { tasks: [
        { t: "Creational patterns (GoF)", d: "KB_5 разд.3 — Factory Method, Abstract Factory, Builder, Singleton, Prototype.", file: "KB_5_Architecture.html", type: "read" },
        { t: "Structural patterns (GoF)", d: "KB_5 разд.4 — Adapter, Decorator, Facade, Proxy, Composite.", file: "KB_5_Architecture.html", type: "read" },
        { t: "Практика: Decorator для кеша", d: "RepositoryInterface → DbRepository → CachedRepository(decorator) wraps DbRepository.", type: "code" },
      ]},
      { tasks: [
        { t: "Behavioral patterns (GoF)", d: "KB_5 разд.5 — Strategy, Observer, Command, Template Method, Chain of Responsibility.", file: "KB_5_Architecture.html", type: "read" },
        { t: "Repository pattern", d: "KB_5 разд.6 — interface + impl + binding, плюсы/минусы для Laravel, когда не нужен.", file: "KB_5_Architecture.html", type: "read" },
        { t: "Практика: Strategy для экспорта", d: "ExportInterface → Pdf/Csv/Excel реализации. Контроллер выбирает по параметру.", type: "code" },
      ]},
      { tasks: [
        { t: "Service Layer + DTO + Action classes", d: "KB_5 разд.7-9 — Controller → Service → Repository, single-action invokable, DTO.", file: "KB_5_Architecture.html", type: "read" },
        { t: "Практика: рефактор fat controller", d: "Большой метод контроллера → ActionClass + Service + DTO. Тесты сохраняются.", type: "code" },
      ]},
      { tasks: [
        { t: "DDD basics + Clean/Hexagonal Architecture", d: "KB_5 разд.10-13 — Entity/VO/Aggregate, Bounded Context, layers, dependency rule.", file: "KB_5_Architecture.html", type: "read" },
        { t: "Финал KB_5: квизы + INTERVIEW DRILL", d: "Все Architecture квизы + вопросы из Backend_Learning_Program.", file: "Backend_Learning_Program.html", type: "quiz" },
        { t: "🔄 Повтор: Security + JWT + Token Rotation", d: "Объясни вслух flow Token Rotation step by step.", type: "review" },
      ]},
    ]
  },

  // ───── НЕДЕЛЯ 11 ─────
  { title: "Неделя 11: Testing Deep — PHPUnit, Pest, Mocks, TDD", theme: "Test doubles, design тестов, DB strategies, mutation testing", review: "Повтор: SOLID + паттерны (нед.10)",
    goal: "KB_14 (13 секций) + KB_6 testing-часть. На собесе должен уверенно сказать 'пишу тесты'.",
    days: [
      { tasks: [
        { t: "PHPUnit + Pest синтаксис", d: "KB_6 разд.1-2 — assertions, setUp/tearDown, data providers, Pest expectation API.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Unit vs Feature vs Integration", d: "KB_14 — определения, разница, когда что писать.", file: "KB_14_Testing_Deep.html", type: "read" },
        { t: "Практика: 5 unit тестов сервиса", d: "Возьми Service из нед.10 рефактора. 5 unit тестов с mock зависимостей.", type: "code" },
      ]},
      { tasks: [
        { t: "Test Doubles deep", d: "KB_14 — Stub vs Mock vs Spy vs Fake vs Dummy. Mockery vs PHPUnit createMock.", file: "KB_14_Testing_Deep.html", type: "read" },
        { t: "Feature тесты в Laravel", d: "KB_6 разд.3 — HTTP testing, assertStatus, actingAs, RefreshDatabase, withoutMiddleware.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Практика: API тесты", d: "POST /register, POST /login, GET /posts (auth). RefreshDatabase. assertJson структура.", type: "code" },
      ]},
      { tasks: [
        { t: "Database стратегии в тестах", d: "KB_14 — RefreshDatabase vs DatabaseTransactions vs DatabaseMigrations vs in-memory SQLite.", file: "KB_14_Testing_Deep.html", type: "read" },
        { t: "Mocking фасадов + Time/Queue/Event::fake", d: "KB_6 разд.4 — Event::fake, Queue::fake, Mail::fake, Carbon::setTestNow.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Практика: Queue::fake + время", d: "Тест что job dispatched при действии. Карбон travel в будущее для scheduler.", type: "code" },
      ]},
      { tasks: [
        { t: "TDD цикл", d: "KB_6 разд.5 — Red → Green → Refactor. Когда TDD реально работает.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Test architecture + parallel testing", d: "KB_14 — структура тестов, paratest, изоляция, shared state pitfalls.", file: "KB_14_Testing_Deep.html", type: "read" },
        { t: "Практика: TDD новая фича", d: "СНАЧАЛА тест: 'user может лайкнуть пост'. Потом код. Refactor.", type: "code" },
      ]},
      { tasks: [
        { t: "Mutation testing + Coverage + Snapshot", d: "KB_14 — Infection PHP, как читать coverage report, snapshot testing.", file: "KB_14_Testing_Deep.html", type: "read" },
        { t: "Pest arch testing + Testing pyramid", d: "KB_6 разд.6-7 — arch::expect для архитектурных правил, пропорции unit/feature/e2e.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "🛠 Практика KB_1: готовые задания 1-3", d: "KB_1 → 'Практика руками' → готовые задания. Сделай trait Cacheable + TransactionGuard + Магический Builder. Тесты обязательно.", file: "KB_1_PHP_Core.html", type: "code" },
        { t: "🔄 Повтор: SOLID + паттерны", d: "Repository vs Service, Strategy, Decorator — без подсмотра.", type: "review" },
      ]},
    ]
  },

  // ───── НЕДЕЛЯ 12 ─────
  { title: "Неделя 12: DevOps + Helpers + Networking", theme: "Docker, Git, CI/CD, Nginx, Linux, Laravel Helpers, Networking", review: "Повтор: Testing (нед.11)",
    goal: "KB_6 devops + KB_10 Helpers + KB_11 обзор. Docker и CI/CD спрашивают на каждом 2-м собесе.",
    days: [
      { tasks: [
        { t: "Docker Fundamentals", d: "KB_6 разд.8 — images, containers, Dockerfile, layers, multi-stage.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Docker Compose для Laravel", d: "KB_6 разд.9 — PHP-FPM + Nginx + MySQL + Redis + Mailpit.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Практика: подними проект в Docker", d: "docker-compose.yml для своего Laravel. Volumes, networks, healthcheck.", type: "code" },
      ]},
      { tasks: [
        { t: "Git advanced + workflows", d: "KB_6 разд.10 — GitFlow vs trunk-based, rebase vs merge, cherry-pick, interactive rebase.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "CI/CD GitHub Actions", d: "KB_6 разд.11 — workflow, triggers, matrix, secrets, deploy steps.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Практика: GH Actions workflow", d: ".github/workflows/ci.yml — composer install, phpunit, php-cs-fixer. Запушь и проверь.", type: "code" },
      ]},
      { tasks: [
        { t: "Linux basics + Nginx", d: "KB_6 разд.12-13 — essential commands, permissions, SSH, cron, server blocks, FastCGI, SSL.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Deployment + Monitoring", d: "KB_6 разд.14-15 — zero-downtime, Deployer, Telescope, Sentry, N+1 detection.", file: "KB_6_Testing_DevOps.html", type: "read" },
      ]},
      { tasks: [
        { t: "Laravel Helpers (обзор)", d: "KB_10 — обзор helper-функций (str_*, arr_*, data_get, tap, retry, throw_if).", file: "KB_10_Laravel_Helpers.html", type: "read" },
        { t: "Помощники для коллекций и строк", d: "KB_10 — Str::, Arr::, when(), tap(), pipe() — основные кейсы.", file: "KB_10_Laravel_Helpers.html", type: "read" },
        { t: "Практика: рефактор с helpers", d: "Возьми кусок кода с if-else цепочкой. Перепиши через tap/when/retry.", type: "code" },
      ]},
      { tasks: [
        { t: "Networking — TCP/IP, HTTP, DNS, DHCP (обзор)", d: "KB_11 — OSI, TCP handshake, HTTP методы и коды, DNS records, DHCP DORA.", file: "KB_11_Cloud_DevOps_Networking.html", type: "read" },
        { t: "TLS + REST principles + Cloud basics", d: "KB_11 — TLS handshake, REST constraints, AWS/GCP/Azure базовые сервисы.", file: "KB_11_Cloud_DevOps_Networking.html", type: "read" },
        { t: "🔄 Повтор: Testing (нед.11)", d: "Unit vs Feature, Mock vs Stub, RefreshDatabase, TDD цикл.", type: "review" },
      ]},
    ]
  },

  // ───── НЕДЕЛЯ 13 ─────
  { title: "Неделя 13: Mock-собесы + слабые места + pet-project", theme: "FULL REVIEW, mock interviews, портфолио", review: "ВСЁ",
    milestone: "🎯 Конец Месяца 3: Middle confident, готов на $3000+",
    goal: "Собрать всё вместе. Mock-собеседования. Закрыть пробелы.",
    days: [
      { tasks: [
        { t: "🔄 FULL REVIEW: PHP Core + SQL", d: "Все квизы KB_1 + KB_2. Шпаргалки нед.2 и нед.4 — обнови. LeetCode 1 задача easy.", file: "KB_1_PHP_Core.html", type: "review" },
      ]},
      { tasks: [
        { t: "🔄 FULL REVIEW: Laravel + Eloquent", d: "KB_3 + KB_9 + KB_12 квизы. Lifecycle, N+1, relationships, scopes. LeetCode 1 medium.", file: "KB_3_Laravel.html", type: "review" },
      ]},
      { tasks: [
        { t: "🔄 FULL REVIEW: DI + Security", d: "KB_13 + KB_4 квизы. Bindings, Token Rotation, OAuth, CSRF/XSS. LeetCode 1 medium.", file: "KB_13_Service_Container_DI.html", type: "review" },
      ]},
      { tasks: [
        { t: "🔄 FULL REVIEW: Architecture + Testing + DevOps", d: "KB_5 + KB_14 + KB_6 квизы. SOLID наизусть, паттерны, TDD цикл, Docker.", file: "KB_5_Architecture.html", type: "review" },
      ]},
      { tasks: [
        { t: "❓ Финальный прогон KB_1 Вопросник — все 45 вопросов", d: "KB_1 → 'Вопросник для собеса'. Уровни 1+2+3 подряд. Таймер 90 сек на вопрос. Запиши на диктофон. Слушай и оценивай.", file: "KB_1_PHP_Core.html", type: "quiz" },
        { t: "🛠 Мини-проект на выбор", d: "KB_1 → 'Практика руками' → мини-проекты. Сделай 1 на выбор: Свой Collection / Validator / DI-контейнер / Mini-ORM. Это сильный аргумент на собесе.", file: "KB_1_PHP_Core.html", type: "project" },
        { t: "MOCK INTERVIEW: полный", d: "24 вопроса × 2 мин = 48 мин. Запиши на диктофон. Прослушай и оцени.", file: "Backend_Learning_Program.html", type: "quiz" },
        { t: "Финал: README портфолио + резюме", d: "am.eabr.org (SSO+MegaRega) + pet-project + KB как proof. Резюме с этим стеком.", type: "project" },
      ]},
    ]
  },
];

// ====== RENDER ======
function render() {
  const tabsEl = document.getElementById('week-tabs');
  const panelsEl = document.getElementById('panels');
  const today = new Date();
  const MILESTONE_WEEKS = new Set();
  weeks.forEach((w, i) => { if (w.milestone) MILESTONE_WEEKS.add(i); });

  weeks.forEach((w, wi) => {
    const btn = document.createElement('div');
    btn.className = 'week-btn' + (wi === 0 ? ' active' : '') + (MILESTONE_WEEKS.has(wi) ? ' milestone' : '');
    btn.textContent = `Нед ${wi + 1}`;
    btn.title = w.title;
    btn.onclick = () => switchWeek(wi);
    tabsEl.appendChild(btn);

    const panel = document.createElement('div');
    panel.className = 'week-panel' + (wi === 0 ? ' active' : '');
    panel.id = 'week-' + wi;

    let html = `<div class="week-header">
      <h2>${w.title}</h2>
      <div class="theme">${w.theme}</div>
      <div class="goal">${w.goal}</div>
      ${w.review ? `<div class="review-tag">🔄 ${w.review}</div>` : ''}
      ${w.milestone ? `<div class="milestone-tag">${w.milestone}</div>` : ''}
    </div>`;

    const weekStart = new Date(START);
    weekStart.setDate(weekStart.getDate() + wi * 7);

    w.days.forEach((day, di) => {
      const dayDate = new Date(weekStart);
      dayDate.setDate(weekStart.getDate() + di);
      const isToday = dayDate.toDateString() === today.toDateString();
      const dateStr = dayDate.toLocaleDateString('ru-RU', { day: 'numeric', month: 'short' });
      const dayName = DAY_LABELS[di] || ('Д'+di);

      html += `<div class="day-card ${isToday ? 'today-marker open' : ''}">
        <div class="day-head" onclick="this.parentElement.classList.toggle('open')">
          <div class="day-label">${dayName}<span class="date">${dateStr}</span>${isToday ? ' <span style="color:var(--ac);font-weight:700;">← СЕГОДНЯ</span>' : ''}</div>
          <div class="day-dur">~${day.tasks.length * 30}-${day.tasks.length * 40} мин</div>
        </div>
        <div class="day-body">`;

      day.tasks.forEach((task) => {
        const typeClass = {read:'type-read',quiz:'type-quiz',code:'type-code',review:'type-review',project:'type-project'}[task.type]||'type-read';
        const typeLabel = {read:'📖 Чтение',quiz:'🧠 Квиз',code:'💻 Код',review:'🔄 Повтор',project:'🚀 Проект'}[task.type]||'';
        const fileLink = task.file ? `<a class="task-file" href="${task.file}" target="_blank">📄 ${task.file}</a>` : '';

        html += `<div class="task">
          <div class="task-check" onclick="toggleTask(this)"></div>
          <div class="task-info">
            <div class="task-title">${task.t}</div>
            <div class="task-detail">${task.d}</div>
            <span class="task-type ${typeClass}">${typeLabel}</span>
            ${fileLink}
          </div>
        </div>`;
      });

      html += `</div></div>`;
    });

    panel.innerHTML = html;
    panelsEl.appendChild(panel);
  });

  updateProgress();
}

function switchWeek(i) {
  document.querySelectorAll('.week-btn').forEach((b,idx) => b.classList.toggle('active', idx===i));
  document.querySelectorAll('.week-panel').forEach((p,idx) => p.classList.toggle('active', idx===i));
}

function toggleTask(el) {
  el.classList.toggle('done');
  el.nextElementSibling.querySelector('.task-title').classList.toggle('struck');
  updateProgress();
}

function updateProgress() {
  const total = document.querySelectorAll('.task-check').length;
  const done = document.querySelectorAll('.task-check.done').length;
  const pct = total ? Math.round((done/total)*100) : 0;
  document.getElementById('main-progress').style.width = pct+'%';
  document.getElementById('prog-text').textContent = `${done} / ${total} задач`;
  document.getElementById('prog-pct').textContent = pct+'%';
}

render();

// Auto-open current week (по календарю Пн-Пт)
const today = new Date();
const daysSinceStart = Math.floor((today - START) / (1000*60*60*24));
if (daysSinceStart >= 0) {
  const weekIndex = Math.floor(daysSinceStart / 7);
  if (weekIndex < weeks.length) switchWeek(weekIndex);
}
</script>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>lucide.createIcons();</script>
</body>
</html>
@endverbatim
