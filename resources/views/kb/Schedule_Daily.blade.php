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

  .app { width:100%; padding:24px 40px 60px; }

  /* Back */
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
    padding:40px 24px 36px;
    margin-bottom:26px;
    background:var(--sf);
    border-radius:14px;
    border:1px solid var(--bd);
    box-shadow:var(--shadow);
  }
  .header h1{font-size:1.9rem;font-weight:800;margin-bottom:6px;color:var(--tx);letter-spacing:-0.3px;}
  .header h1 span{color:var(--ac);}
  .header p{color:var(--tx2);font-size:0.9rem;}

  /* Progress */
  .progress-wrap{margin-bottom:26px;background:var(--sf);border:1px solid var(--bd);border-radius:var(--radius);padding:16px 20px;box-shadow:var(--shadow);}
  .progress-bar{width:100%;height:8px;background:var(--sf2);border-radius:5px;overflow:hidden;}
  .progress-fill{height:100%;background:linear-gradient(90deg,var(--ac),#74C0FC);border-radius:5px;transition:width 0.5s;}
  .progress-label{display:flex;justify-content:space-between;margin-top:8px;font-size:0.78rem;color:var(--tx2);font-weight:500;}

  /* Controls */
  .controls{display:flex;gap:8px;margin-bottom:18px;flex-wrap:wrap;align-items:center;}
  .week-btn{
    padding:8px 16px;border-radius:8px;cursor:pointer;font-size:0.82rem;font-weight:600;
    background:var(--sf);border:1px solid var(--bd);color:var(--tx2);
    transition:all 0.18s;font-family:'Inter',-apple-system,sans-serif;
  }
  .week-btn:hover{background:var(--bg);border-color:var(--ac);color:var(--ac);}
  .week-btn.active{background:var(--ac);color:#fff;border-color:var(--ac);}
  .week-btn.done{background:var(--gr2);color:var(--gr3);border-color:rgba(80,205,137,0.4);}

  .week-panel{display:none;}
  .week-panel.active{display:block;}

  .week-header{
    background:var(--sf);border:1px solid var(--bd);border-radius:12px;
    padding:18px 22px;margin-bottom:14px;box-shadow:var(--shadow);
  }
  .week-header h2{font-size:1.2rem;font-weight:700;margin-bottom:3px;color:var(--tx);}
  .week-header .theme{color:var(--ac);font-size:0.93rem;font-weight:600;}
  .week-header .goal{color:var(--tx2);font-size:0.83rem;margin-top:6px;line-height:1.6;}
  .week-header .review-tag{
    display:inline-block;background:var(--yl2);color:var(--yl3);
    padding:3px 10px;border-radius:6px;font-size:0.76rem;font-weight:700;margin-top:8px;
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

  .tip-box{
    background:var(--bl2);border:1px solid rgba(0,158,247,0.25);
    border-radius:8px;padding:12px 16px;margin:12px 0;
    font-size:0.81rem;color:var(--bl);line-height:1.55;
  }

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
  <h1>Расписание <span>по дням</span></h1>
  <p>16 недель · 1.5–2 часа/день · Старт: 26 апреля 2026 (воскресенье)</p>
  <p style="font-size:0.8rem;color:var(--tx2);margin-top:6px;">Каждая задача привязана к конкретному разделу в KB файлах. Отмечай выполненные ✓</p>
</div>

<div class="progress-wrap">
  <div class="progress-bar"><div class="progress-fill" id="main-progress" style="width:0%"></div></div>
  <div class="progress-label"><span id="prog-text">0 / 112 дней</span><span id="prog-pct">0%</span></div>
</div>

<div class="controls" id="week-tabs"></div>
<div id="panels"></div>

</div>

<script>
const START = new Date(2026, 3, 26); // April 26, 2026

const weeks = [
  // ====== WEEK 1 ======
  { title: "Неделя 1: PHP — Основы и типы", theme: "PHP Core — фундамент", review: "",
    goal: "Повторить и закрепить основы PHP: типы данных, строки, массивы, управляющие конструкции. Если уже знаешь — пробеги быстро и сосредоточься на квизах.",
    days: [
      { label: "Вс", tasks: [
        { t: "Прочитать: Типы данных PHP", d: "KB_1 → раздел 1. Все типы, type juggling, strict_types, casting.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Квиз: Проверь себя по типам", d: "Ответь на вопросы в конце раздела БЕЗ подглядывания. Запиши в чём ошибся.", type: "quiz" },
        { t: "Практика: напиши функцию с strict_types", d: "Создай файл strict_test.php — функция которая принимает int и возвращает float. Проверь что TypeError работает.", type: "code" },
      ]},
      { label: "Пн", tasks: [
        { t: "Прочитать: Строки", d: "KB_1 → раздел 2. mb_string, str_contains, sprintf, heredoc, regex.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: 5 задач на строки", d: "1) Извлечь домен из email. 2) Заменить все URL в тексте на ссылки. 3) sprintf для форматирования цены. 4) mb_strtolower для кириллицы. 5) preg_match для валидации телефона.", type: "code" },
      ]},
      { label: "Вт", tasks: [
        { t: "Прочитать: Массивы углублённо", d: "KB_1 → раздел 3. array_map, filter, reduce, usort, destructuring.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: трансформация данных", d: "Массив пользователей [{name, age, city}]. 1) Отфильтруй по возрасту. 2) Сгруппируй по городу. 3) Посчитай средний возраст через array_reduce. 4) usort по имени.", type: "code" },
      ]},
      { label: "Ср", tasks: [
        { t: "Прочитать: ООП — Классы и наследование", d: "KB_1 → раздел 4. Конструкторы, promotion, static, late static binding.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Квиз: Что выведет static:: vs self::?", d: "Напиши пример с parent/child классом и предскажи вывод static::method() и self::method().", type: "quiz" },
      ]},
      { label: "Чт", tasks: [
        { t: "Прочитать: Абстрактные классы vs Интерфейсы", d: "KB_1 → раздел 5. Когда что, multiple interfaces, примеры.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: создай систему оплаты", d: "PaymentInterface (process, refund). Два класса: StripePayment, PayPalPayment. Покажи полиморфизм — вызови через тип интерфейса.", type: "code" },
      ]},
      { label: "Пт", tasks: [
        { t: "Прочитать: Traits", d: "KB_1 → раздел 6. Syntax, conflicts, abstract methods, real cases.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Прочитать: Магические методы", d: "KB_1 → раздел 7. __get/__set, __call, __toString, __invoke.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Квиз: все квизы разделов 4-7", d: "Пройди 'Проверь себя' по всем 4 разделам. Отметь слабые места.", type: "quiz" },
      ]},
      { label: "Сб", tasks: [
        { t: "ПОВТОРЕНИЕ НЕДЕЛИ: пересказ вслух", d: "Открой пустой файл. Напиши своими словами: типы PHP, разница == и ===, abstract vs interface, зачем traits, 3 магических метода. Без подсматривания.", type: "review" },
        { t: "Мини-проект: класс Collection", d: "Создай свой мини-Collection класс: __construct(array), add(), filter(callback), map(callback), first(), count(). Используй traits для сериализации в JSON.", type: "project" },
      ]},
    ]
  },

  // ====== WEEK 2 ======
  { title: "Неделя 2: PHP — Modern & Advanced", theme: "Namespaces, PHP 8.x, Closures, Error Handling", review: "Повтор: типы данных, ООП основы (нед.1)",
    goal: "Закрыть все продвинутые темы PHP. После этой недели PHP Core закрыт.",
    days: [
      { label: "Вс", tasks: [
        { t: "Прочитать: Namespaces & PSR-4", d: "KB_1 → раздел 8. namespace, use, Composer autoload, PSR-4 стандарт.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: структура проекта PSR-4", d: "Создай мини-проект: src/Models/User.php, src/Services/UserService.php с правильными namespace и composer.json autoload.", type: "code" },
      ]},
      { label: "Пн", tasks: [
        { t: "Прочитать: Обработка ошибок", d: "KB_1 → раздел 9. try/catch/finally, custom exceptions, Error vs Exception.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: цепочка exceptions", d: "Создай ValidationException, NotFoundException, DatabaseException. В сервисе ловишь PDOException → выбрасываешь свой DatabaseException с previous.", type: "code" },
      ]},
      { label: "Вт", tasks: [
        { t: "Прочитать: PHP 8.x фичи", d: "KB_1 → раздел 10. match, enums, named args, readonly, nullsafe, constructor promotion.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: перепиши старый код на PHP 8", d: "Возьми switch → замени на match. Массив констант → enum. Конструктор с присвоением → constructor promotion. Цепочка проверок → nullsafe ?->.", type: "code" },
      ]},
      { label: "Ср", tasks: [
        { t: "Прочитать: Генераторы", d: "KB_1 → раздел 11. yield, yield from, memory efficiency.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Прочитать: Closures", d: "KB_1 → раздел 12. Anonymous functions, use, arrow functions, binding.", file: "KB_1_PHP_Core.html", type: "read" },
        { t: "Практика: генератор для CSV", d: "Напиши генератор который читает CSV файл построчно. Сравни memory_get_usage() с file_get_contents vs generator.", type: "code" },
      ]},
      { label: "Чт", tasks: [
        { t: "🔄 ПОВТОРЕНИЕ: PHP основы (нед.1)", d: "Перечитай квизы разделов 1-7 из KB_1. Ответь заново. Прошла неделя — проверь что помнишь.", file: "KB_1_PHP_Core.html", type: "review" },
        { t: "Квиз: все квизы KB_1 разделы 8-12", d: "Проверь себя по новым темам этой недели.", type: "quiz" },
      ]},
      { label: "Пт", tasks: [
        { t: "Мини-проект: CLI утилита на PHP 8", d: "Создай console-утилиту: парсит аргументы (named args), enum для команд (list, search, add), generator для чтения логов, custom exceptions для ошибок.", type: "project" },
      ]},
      { label: "Сб", tasks: [
        { t: "ИТОГ: Пересказ PHP Core", d: "Напиши шпаргалку своими словами: 15 ключевых тем PHP которые спросят на собеседовании. Это твоя Anki-колода.", type: "review" },
        { t: "Отдых или дополнительная практика", d: "Если чувствуешь уверенность — отдохни. Если нет — повтори слабые места.", type: "review" },
      ]},
    ]
  },

  // ====== WEEK 3 ======
  { title: "Неделя 3: SQL — Основы и JOIN'ы", theme: "SQL фундамент, JOIN'ы, агрегатные функции", review: "Повтор: PHP OOP (нед.1-2)",
    goal: "Освоить SQL на уровне собеседования. JOIN'ы — must know, спрашивают почти всегда.",
    days: [
      { label: "Вс", tasks: [
        { t: "Прочитать: SQL основы", d: "KB_2 → раздел 1. SELECT, INSERT, UPDATE, DELETE, WHERE, ORDER BY, LIMIT.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Практика: 10 запросов к тестовой БД", d: "Открой phpMyAdmin или TablePlus. Создай таблицы users, orders, products. Напиши 10 разных SELECT запросов.", type: "code" },
      ]},
      { label: "Пн", tasks: [
        { t: "Прочитать: JOIN'ы глубоко", d: "KB_2 → раздел 2. INNER, LEFT, RIGHT, CROSS, SELF JOIN. Визуальные диаграммы.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Практика: все типы JOIN", d: "На своих таблицах users/orders/products — напиши запрос с каждым типом JOIN. Объясни себе вслух зачем LEFT а не INNER.", type: "code" },
      ]},
      { label: "Вт", tasks: [
        { t: "Прочитать: Агрегатные функции", d: "KB_2 → раздел 3. COUNT, SUM, AVG, GROUP BY, HAVING.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Прочитать: Подзапросы", d: "KB_2 → раздел 4. Correlated vs non-correlated, EXISTS, IN.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Практика: сложные запросы", d: "1) Топ-5 клиентов по сумме заказов. 2) Товары которые никто не заказывал (LEFT JOIN + IS NULL). 3) Средний чек по месяцам.", type: "code" },
      ]},
      { label: "Ср", tasks: [
        { t: "Прочитать: Индексы глубоко", d: "KB_2 → раздел 5. B-tree, Clustered/Non-clustered, Composite, Covering, leftmost prefix rule.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Квиз: Проверь себя по индексам", d: "Ответь: зачем composite index, что такое leftmost prefix rule, когда НЕ нужен индекс?", type: "quiz" },
      ]},
      { label: "Чт", tasks: [
        { t: "Прочитать: EXPLAIN и оптимизация", d: "KB_2 → раздел 6. Чтение EXPLAIN output, типы сканирования, bottleneck.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Практика: EXPLAIN на своих запросах", d: "Возьми 5 запросов из вторника. Прогони EXPLAIN. Добавь индексы и сравни.", type: "code" },
      ]},
      { label: "Пт", tasks: [
        { t: "🔄 ПОВТОРЕНИЕ: PHP ООП (нед.1-2)", d: "Открой KB_1 разделы 4-7. Перечитай квизы. Ответь без подглядывания. 30 мин.", file: "KB_1_PHP_Core.html", type: "review" },
        { t: "Квиз: SQL разделы 1-6", d: "Пройди все 'Проверь себя' из KB_2.", file: "KB_2_SQL_Database.html", type: "quiz" },
      ]},
      { label: "Сб", tasks: [
        { t: "ПОВТОРЕНИЕ: напиши 10 SQL задач и реши", d: "Придумай себе 10 SQL задач разной сложности. Реши. Проверь через EXPLAIN.", type: "review" },
      ]},
    ]
  },

  // ====== WEEK 4 ======
  { title: "Неделя 4: SQL — Advanced + PDO", theme: "Транзакции, ACID, нормализация, проектирование БД", review: "Повтор: PHP Core (нед.1)",
    goal: "Закрыть SQL полностью. Транзакции и ACID — обязательно на собеседовании.",
    days: [
      { label: "Вс", tasks: [
        { t: "Прочитать: Транзакции и ACID", d: "KB_2 → раздел 7. BEGIN/COMMIT/ROLLBACK, SAVEPOINT, deadlocks.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Прочитать: Уровни изоляции", d: "KB_2 → раздел 8. Read Uncommitted → Serializable. Dirty/phantom reads.", file: "KB_2_SQL_Database.html", type: "read" },
      ]},
      { label: "Пн", tasks: [
        { t: "Практика: транзакции", d: "Напиши SQL транзакцию: перевод денег между счетами. Попробуй ROLLBACK. Покажи deadlock сценарий.", type: "code" },
        { t: "Квиз: ACID и уровни изоляции", d: "Объясни каждую букву ACID. Назови 4 уровня изоляции и какие проблемы каждый решает.", type: "quiz" },
      ]},
      { label: "Вт", tasks: [
        { t: "Прочитать: Нормализация", d: "KB_2 → раздел 9. 1NF, 2NF, 3NF, BCNF. Before/after примеры.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Практика: нормализуй таблицу", d: "Возьми ненормализованную таблицу заказов (всё в одной). Разбей на 1NF → 2NF → 3NF.", type: "code" },
      ]},
      { label: "Ср", tasks: [
        { t: "Прочитать: Проектирование БД", d: "KB_2 → раздел 10. ER, связи 1:1/1:N/N:M, pivot tables, polymorphic.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Практика: спроектируй БД для блога", d: "Users, Posts, Comments, Tags (many-to-many), Categories. Нарисуй ER-диаграмму. Напиши CREATE TABLE.", type: "code" },
      ]},
      { label: "Чт", tasks: [
        { t: "Прочитать: MySQL vs PostgreSQL", d: "KB_2 → раздел 11. Различия, InnoDB, JSONB, full-text.", file: "KB_2_SQL_Database.html", type: "read" },
        { t: "Прочитать: PDO в PHP", d: "KB_2 → раздел 12. Prepared statements, fetch modes, transactions в PDO.", file: "KB_2_SQL_Database.html", type: "read" },
      ]},
      { label: "Пт", tasks: [
        { t: "🔄 ПОВТОРЕНИЕ: PHP Core (нед.1)", d: "Прошло 4 недели. Открой шпаргалку из нед.2. Дополни. Проверь что помнишь enums, generators, closures.", type: "review" },
        { t: "Квиз: все SQL квизы", d: "Пройди ВСЕ 'Проверь себя' из KB_2. Отметь ошибки.", file: "KB_2_SQL_Database.html", type: "quiz" },
      ]},
      { label: "Сб", tasks: [
        { t: "ИТОГ SQL: шпаргалка", d: "Напиши своими словами: JOIN'ы, ACID, нормализация, composite index, leftmost prefix. Это Anki-колода SQL.", type: "review" },
      ]},
    ]
  },

  // ====== WEEK 5 ======
  { title: "Неделя 5: Laravel — Fundamentals 1", theme: "Lifecycle, Routing, Controllers, Blade", review: "Повтор: SQL JOIN'ы (нед.3), PHP OOP (нед.2)",
    goal: "Пройти ядро Laravel. Ты уже это знаешь — задача углубить и закрепить для собеседования.",
    days: [
      { label: "Вс", tasks: [
        { t: "Прочитать: Жизненный цикл запроса", d: "KB_3 → раздел 1. index.php → bootstrap → kernel → middleware → router → controller. MUST KNOW.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Квиз: расскажи lifecycle наизусть", d: "Закрой KB. Напиши по памяти все шаги request lifecycle. Проверь.", type: "quiz" },
      ]},
      { label: "Пн", tasks: [
        { t: "Прочитать: Service Container & DI", d: "KB_3 → раздел 2. Auto-resolution, bind, singleton, interface binding.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Практика: bind интерфейса", d: "Создай PaymentInterface, StripePayment. Забинди в AppServiceProvider. Инжектируй в контроллер.", type: "code" },
      ]},
      { label: "Вт", tasks: [
        { t: "Прочитать: Service Providers", d: "KB_3 → раздел 3. register() vs boot(), deferred, custom providers.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Прочитать: Middleware Deep Dive", d: "KB_3 → раздел 13. Before/after, terminate, parameters.", file: "KB_3_Laravel.html", type: "read" },
      ]},
      { label: "Ср", tasks: [
        { t: "Прочитать: Eloquent Advanced", d: "KB_3 → раздел 4. Scopes, accessors/mutators, casts, observers.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Практика: refactor модели", d: "Возьми модель из своего проекта. Добавь local scope, accessor, custom cast.", type: "code" },
      ]},
      { label: "Чт", tasks: [
        { t: "Прочитать: N+1 Problem & Eager Loading", d: "KB_3 → раздел 5. with(), load(), withCount(), preventLazyLoading(). INTERVIEW MUST.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Практика: найди N+1 в своём проекте", d: "Установи Debugbar. Открой страницу со списком. Посчитай запросы. Добавь with(). Сравни.", type: "code" },
      ]},
      { label: "Пт", tasks: [
        { t: "🔄 ПОВТОРЕНИЕ: SQL JOIN'ы (нед.3)", d: "Напиши 5 JOIN запросов по памяти. Объясни разницу LEFT и INNER.", type: "review" },
        { t: "🔄 ПОВТОРЕНИЕ: PHP OOP (нед.1-2)", d: "abstract vs interface — объясни вслух. traits — зачем. 3 магических метода — какие.", type: "review" },
      ]},
      { label: "Сб", tasks: [
        { t: "Квиз: Laravel разделы 1-5", d: "Пройди все 'Проверь себя' из KB_3.", file: "KB_3_Laravel.html", type: "quiz" },
      ]},
    ]
  },

  // ====== WEEK 6 ======
  { title: "Неделя 6: Laravel — Fundamentals 2", theme: "Transactions, API Resources, Pagination, Auth", review: "Повтор: Eloquent, N+1 (нед.5)",
    goal: "Закрыть оставшиеся core-темы Laravel.",
    days: [
      { label: "Вс", tasks: [
        { t: "Прочитать: Database Transactions в Laravel", d: "KB_3 → раздел 6. DB::transaction(), savepoints, deadlock retry.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Практика: транзакция для перевода", d: "Напиши сервис TransferService с DB::transaction. Обработай исключение и rollback.", type: "code" },
      ]},
      { label: "Пн", tasks: [
        { t: "Прочитать: API Resources & Pagination", d: "KB_3 → раздел 12. JsonResource, ResourceCollection, paginate, cursorPaginate.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Практика: API endpoint с ресурсами", d: "GET /api/posts — PostResource, PostCollection, pagination в JSON ответе.", type: "code" },
      ]},
      { label: "Вт", tasks: [
        { t: "Прочитать: Sanctum Authentication", d: "KB_3 → раздел 14. SPA auth, API token, abilities, revoke.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Прочитать: Gates & Policies", d: "KB_3 → раздел 15. Gates, Policy classes, @can, authorize().", file: "KB_3_Laravel.html", type: "read" },
      ]},
      { label: "Ср", tasks: [
        { t: "Практика: полный auth flow", d: "Register → Login (token) → Protected route → Logout. С Sanctum. Проверь в Postman.", type: "code" },
        { t: "Практика: Policy для постов", d: "PostPolicy: view (все), update/delete (только автор). Применй в контроллере.", type: "code" },
      ]},
      { label: "Чт", tasks: [
        { t: "Прочитать: Queues & Jobs", d: "KB_3 → раздел 7. dispatch, drivers, workers, failed jobs, retries.", file: "KB_3_Laravel.html", type: "read" },
        { t: "Практика: фоновая задача", d: "Создай SendWelcomeEmail job. dispatch() при регистрации. Запусти worker.", type: "code" },
      ]},
      { label: "Пт", tasks: [
        { t: "Прочитать: Events & Listeners", d: "KB_3 → раздел 8. Events, listeners, subscribers, async.", file: "KB_3_Laravel.html", type: "read" },
        { t: "🔄 ПОВТОРЕНИЕ: Eloquent + N+1 (нед.5)", d: "Объясни вслух: что такое N+1, как решить, preventLazyLoading.", type: "review" },
      ]},
      { label: "Сб", tasks: [
        { t: "Прочитать: Caching + Task Scheduling", d: "KB_3 → разделы 9, 10. Cache::remember, tags, schedule().", file: "KB_3_Laravel.html", type: "read" },
        { t: "Квиз: Laravel разделы 6-15", d: "Пройди все оставшиеся квизы KB_3.", file: "KB_3_Laravel.html", type: "quiz" },
      ]},
    ]
  },

  // ====== WEEK 7 ======
  { title: "Неделя 7: Безопасность — часть 1", theme: "Token Rotation, OAuth, JWT, Session Security", review: "Повтор: Service Container (нед.5), Queues (нед.6)",
    goal: "Закрыть ту тему что спросили на собеседовании. Token Rotation, OAuth, JWT — после этой недели будешь знать уверенно.",
    days: [
      { label: "Вс", tasks: [
        { t: "Прочитать: Ротация токенов (Token Rotation)", d: "KB_4 → раздел 1. Access + Refresh flow, reuse detection, Laravel implementation. ЭТО ТО ЧТО СПРОСИЛИ.", file: "KB_4_Security.html", type: "read" },
        { t: "Квиз + Задание из раздела", d: "Ответь на квиз в конце. Выполни практическое задание — реализуй refresh endpoint.", type: "quiz" },
      ]},
      { label: "Пн", tasks: [
        { t: "Прочитать: OAuth 2.0 & OpenID Connect", d: "KB_4 → раздел 2. Authorization Code, PKCE, Client Credentials, Passport.", file: "KB_4_Security.html", type: "read" },
        { t: "Квиз: назови 4 OAuth flow", d: "Без подглядывания: какие 4 flow в OAuth 2.0, какие 2 deprecated, что такое PKCE.", type: "quiz" },
      ]},
      { label: "Вт", tasks: [
        { t: "Прочитать: JWT", d: "KB_4 → раздел 3. Header.Payload.Signature, HS256 vs RS256, claims, когда JWT vs Session.", file: "KB_4_Security.html", type: "read" },
        { t: "Практика: создай и декодируй JWT", d: "Используй firebase/php-jwt. Создай токен с claims. Декодируй. Проверь expiration.", type: "code" },
      ]},
      { label: "Ср", tasks: [
        { t: "Прочитать: Session Security", d: "KB_4 → раздел 4. Fixation, hijacking, HttpOnly, SameSite, regeneration.", file: "KB_4_Security.html", type: "read" },
        { t: "🔄 ПОВТОРЕНИЕ: Service Container (нед.5)", d: "Объясни вслух: что делает Service Container, зачем DI, как bind интерфейс.", type: "review" },
      ]},
      { label: "Чт", tasks: [
        { t: "Квиз: все разделы 1-4 KB_4", d: "Пройди все 'Проверь себя'. Token rotation flow — нарисуй на бумаге.", file: "KB_4_Security.html", type: "quiz" },
        { t: "Задания: все практические из разделов 1-4", d: "Если не сделал задания из концов разделов — сделай сейчас.", type: "code" },
      ]},
      { label: "Пт", tasks: [
        { t: "INTERVIEW DRILL: Security вопросы", d: "Открой Backend_Learning_Program.html → вкладка Собеседование → Security. Ответь на ВСЕ вопросы.", file: "Backend_Learning_Program.html", type: "quiz" },
      ]},
      { label: "Сб", tasks: [
        { t: "🔄 ПОВТОРЕНИЕ: Queues & Events (нед.6)", d: "Объясни: зачем очереди, как dispatch job, что делает worker, как обработать failed job.", type: "review" },
        { t: "Шпаргалка Security ч.1", d: "Напиши: Token Rotation flow, JWT структура, OAuth flows, session security flags.", type: "review" },
      ]},
    ]
  },

  // ====== WEEK 8 ======
  { title: "Неделя 8: Безопасность — часть 2", theme: "CSRF, XSS, SQL Injection, CORS, Rate Limiting, Headers", review: "Повтор: Auth (нед.6), Token Rotation (нед.7)",
    goal: "Закрыть Security полностью. После этой недели — уверенный ответ на любой вопрос по безопасности.",
    days: [
      { label: "Вс", tasks: [
        { t: "Прочитать: CSRF Protection", d: "KB_4 → раздел 5. Attack scenario, STP, @csrf, SameSite cookies.", file: "KB_4_Security.html", type: "read" },
        { t: "Прочитать: XSS", d: "KB_4 → раздел 6. Stored, Reflected, DOM-based, CSP headers.", file: "KB_4_Security.html", type: "read" },
      ]},
      { label: "Пн", tasks: [
        { t: "Прочитать: SQL Injection", d: "KB_4 → раздел 7. Classic, blind, second-order. Prepared statements.", file: "KB_4_Security.html", type: "read" },
        { t: "Прочитать: CORS", d: "KB_4 → раздел 8. Same-Origin, preflight, config/cors.php.", file: "KB_4_Security.html", type: "read" },
      ]},
      { label: "Вт", tasks: [
        { t: "Прочитать: Rate Limiting", d: "KB_4 → раздел 9. Token bucket, throttle middleware, brute force.", file: "KB_4_Security.html", type: "read" },
        { t: "Прочитать: Password Security", d: "KB_4 → раздел 10. bcrypt vs argon2, NIST рекомендации.", file: "KB_4_Security.html", type: "read" },
      ]},
      { label: "Ср", tasks: [
        { t: "Прочитать: HTTPS & TLS", d: "KB_4 → раздел 11. TLS handshake, HSTS, Let's Encrypt.", file: "KB_4_Security.html", type: "read" },
        { t: "Прочитать: Security Headers", d: "KB_4 → раздел 12. CSP, X-Frame-Options, Referrer-Policy.", file: "KB_4_Security.html", type: "read" },
      ]},
      { label: "Чт", tasks: [
        { t: "🔄 ПОВТОРЕНИЕ: Auth + Token Rotation", d: "Расскажи вслух: flow Sanctum auth, token rotation step by step, JWT vs Session когда что.", type: "review" },
        { t: "Квиз: все KB_4", d: "Пройди ВСЕ квизы и задания KB_4. Отметь слабые места.", file: "KB_4_Security.html", type: "quiz" },
      ]},
      { label: "Пт", tasks: [
        { t: "INTERVIEW DRILL: все вопросы Security", d: "Backend_Learning_Program → Собеседование. Ответь на каждый вопрос по Security вслух.", file: "Backend_Learning_Program.html", type: "quiz" },
      ]},
      { label: "Сб", tasks: [
        { t: "ИТОГ Security: полная шпаргалка", d: "Напиши: CSRF, XSS, SQL Injection, CORS, Token Rotation, OAuth, JWT, Rate Limiting — по 2 предложения каждый.", type: "review" },
      ]},
    ]
  },

  // ====== WEEK 9-10 ======
  { title: "Неделя 9-10: Архитектура & Паттерны", theme: "SOLID, Repository, Service, Factory, Strategy, DDD", review: "Повтор: Security (нед.7-8), Laravel Fundamentals (нед.5-6)",
    goal: "Самый важный блок для собеседований на middle+. SOLID спрашивают ВСЕГДА.",
    days: [
      { label: "Нед 9 · Вс-Пн", tasks: [
        { t: "Прочитать: SOLID — все 5 принципов", d: "KB_5 → раздел 1. Аналогии + BAD/GOOD код для каждого. Самый важный раздел.", file: "KB_5_Architecture.html", type: "read" },
        { t: "Квиз: объясни каждый принцип с примером", d: "Без KB: S — ..., O — ..., L — ..., I — ..., D — ... Каждый с примером на PHP.", type: "quiz" },
      ]},
      { label: "Нед 9 · Вт-Ср", tasks: [
        { t: "Прочитать: Repository Pattern", d: "KB_5 → раздел 2. Interface + Implementation + ServiceProvider binding.", file: "KB_5_Architecture.html", type: "read" },
        { t: "Прочитать: Service Layer", d: "KB_5 → раздел 3. Controller → Service → Repository. Thin controllers.", file: "KB_5_Architecture.html", type: "read" },
        { t: "Практика: рефактор контроллера", d: "Возьми толстый контроллер из своего проекта. Вынеси логику в Service, данные в Repository.", type: "code" },
      ]},
      { label: "Нед 9 · Чт-Пт", tasks: [
        { t: "Прочитать: Factory, Observer, Strategy", d: "KB_5 → разделы 4, 5, 6. Три ключевых GoF паттерна для Laravel.", file: "KB_5_Architecture.html", type: "read" },
        { t: "Практика: Strategy для экспорта", d: "ExportInterface → PdfExport, CsvExport, ExcelExport. Контроллер выбирает стратегию по параметру.", type: "code" },
      ]},
      { label: "Нед 9 · Сб", tasks: [
        { t: "🔄 ПОВТОРЕНИЕ: Security highlights", d: "Token Rotation flow, CSRF vs XSS, CORS — по памяти.", type: "review" },
      ]},
      { label: "Нед 10 · Вс-Пн", tasks: [
        { t: "Прочитать: DTO + Action Pattern", d: "KB_5 → разделы 7, 8. Data Transfer Objects, Single Action Classes.", file: "KB_5_Architecture.html", type: "read" },
        { t: "Прочитать: DI Deep Dive", d: "KB_5 → раздел 9. Constructor/method/property injection, testing.", file: "KB_5_Architecture.html", type: "read" },
      ]},
      { label: "Нед 10 · Вт-Ср", tasks: [
        { t: "Прочитать: MVC variations + DDD basics", d: "KB_5 → разделы 10, 11. Fat controller problem, DDD concepts.", file: "KB_5_Architecture.html", type: "read" },
        { t: "Прочитать: Clean Architecture", d: "KB_5 → раздел 12. Layers, Dependency Rule, Hexagonal.", file: "KB_5_Architecture.html", type: "read" },
      ]},
      { label: "Нед 10 · Чт-Пт", tasks: [
        { t: "Квиз: все KB_5", d: "Пройди ВСЕ квизы. SOLID — обязательно наизусть.", file: "KB_5_Architecture.html", type: "quiz" },
        { t: "INTERVIEW DRILL: Architecture вопросы", d: "Backend_Learning_Program → Собеседование → Architecture. Ответь вслух.", file: "Backend_Learning_Program.html", type: "quiz" },
      ]},
      { label: "Нед 10 · Сб", tasks: [
        { t: "🔄 ПОВТОРЕНИЕ: Laravel Fundamentals (нед.5-6)", d: "Lifecycle, N+1, Queues, Sanctum — по памяти.", type: "review" },
        { t: "ИТОГ: шпаргалка Architecture", d: "SOLID 5 принципов, Repository vs Service, Strategy, DTO — своими словами.", type: "review" },
      ]},
    ]
  },

  // ====== WEEK 11-12 ======
  { title: "Неделя 11-12: Тестирование", theme: "PHPUnit, Unit/Feature тесты, TDD, Mocking, Pest", review: "Повтор: SOLID (нед.9), Паттерны (нед.10)",
    goal: "Научиться писать тесты. На собеседовании спрашивают 'пишете ли тесты' — ответ должен быть уверенным.",
    days: [
      { label: "Нед 11 · Вс-Пн", tasks: [
        { t: "Прочитать: PHPUnit + Unit тесты", d: "KB_6 → разделы 1, 2. Assertions, setUp, data providers, Mockery.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Практика: 5 unit тестов", d: "Протестируй свой Service класс (из нед.9). Mock зависимости через Mockery.", type: "code" },
      ]},
      { label: "Нед 11 · Вт-Ср", tasks: [
        { t: "Прочитать: Feature тесты", d: "KB_6 → раздел 3. HTTP testing, assertStatus, actingAs, RefreshDatabase.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Практика: тесты для API", d: "Напиши feature тесты: POST /api/register, POST /api/login, GET /api/posts (auth required).", type: "code" },
      ]},
      { label: "Нед 11 · Чт-Пт", tasks: [
        { t: "Прочитать: Mocking & Fakes + TDD", d: "KB_6 → разделы 4, 5. Event::fake(), Queue::fake(), Red→Green→Refactor.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Практика: TDD — новая фича", d: "Напиши СНАЧАЛА тест, потом код. Фича: 'пользователь может лайкнуть пост'. Test → Code → Refactor.", type: "code" },
      ]},
      { label: "Нед 11 · Сб", tasks: [
        { t: "🔄 ПОВТОРЕНИЕ: SOLID", d: "5 принципов — объясни каждый с примером. Без подсматривания.", type: "review" },
      ]},
      { label: "Нед 12 · Вс-Пн", tasks: [
        { t: "Прочитать: Pest PHP + Testing Pyramid", d: "KB_6 → разделы 6, 7. Modern syntax, arch testing, pyramid.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Практика: перепиши тесты на Pest", d: "Возьми PHPUnit тесты из нед.11. Перепиши на Pest синтаксис.", type: "code" },
      ]},
      { label: "Нед 12 · Вт-Ср", tasks: [
        { t: "Квиз: Testing", d: "Unit vs Feature — разница. TDD цикл. Fakes — назови 5. Testing pyramid.", file: "KB_6_Testing_DevOps.html", type: "quiz" },
        { t: "🔄 ПОВТОРЕНИЕ: Паттерны (нед.9-10)", d: "Repository vs Service, Factory, Strategy, DTO — по памяти.", type: "review" },
      ]},
      { label: "Нед 12 · Чт-Сб", tasks: [
        { t: "Мини-проект: покрой тестами API", d: "Возьми свой Laravel проект. Напиши минимум 10 тестов: 5 unit + 5 feature. Покрытие ключевых путей.", type: "project" },
      ]},
    ]
  },

  // ====== WEEK 13-14 ======
  { title: "Неделя 13-14: DevOps & Docker", theme: "Docker, Git Advanced, CI/CD, Linux, Nginx, Deploy", review: "Повтор: Тестирование (нед.11-12), Security (нед.7-8)",
    goal: "Закрыть DevOps. Docker и CI/CD спрашивают на каждом втором собеседовании.",
    days: [
      { label: "Нед 13 · Вс-Пн", tasks: [
        { t: "Прочитать: Docker Fundamentals", d: "KB_6 → раздел 8. Images, containers, Dockerfile, layers, multi-stage.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Прочитать: Docker Compose для Laravel", d: "KB_6 → раздел 9. PHP-FPM + Nginx + MySQL + Redis.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Практика: запусти проект в Docker", d: "Создай docker-compose.yml для своего Laravel проекта. Запусти. Проверь что всё работает.", type: "code" },
      ]},
      { label: "Нед 13 · Вт-Ср", tasks: [
        { t: "Прочитать: Git Advanced", d: "KB_6 → раздел 10. GitFlow, trunk-based, rebase vs merge, stash.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Прочитать: CI/CD GitHub Actions", d: "KB_6 → раздел 11. Workflow, triggers, test matrix, deploy.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Практика: создай GitHub Actions workflow", d: ".github/workflows/ci.yml — install deps, run tests, lint. Запушь и проверь.", type: "code" },
      ]},
      { label: "Нед 13 · Чт-Пт", tasks: [
        { t: "Прочитать: Linux Basics", d: "KB_6 → раздел 12. Essential commands, permissions, SSH, cron, systemd.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Прочитать: Nginx Configuration", d: "KB_6 → раздел 13. Server blocks, PHP-FPM, SSL, gzip.", file: "KB_6_Testing_DevOps.html", type: "read" },
      ]},
      { label: "Нед 13 · Сб", tasks: [
        { t: "🔄 ПОВТОРЕНИЕ: Тестирование", d: "Unit vs Feature, TDD цикл, назови 5 fakes, testing pyramid.", type: "review" },
      ]},
      { label: "Нед 14 · Вс-Пн", tasks: [
        { t: "Прочитать: Laravel Deployment", d: "KB_6 → раздел 14. Zero-downtime, Deployer, post-deploy commands.", file: "KB_6_Testing_DevOps.html", type: "read" },
        { t: "Прочитать: Monitoring & Debugging", d: "KB_6 → раздел 15. Telescope, Debugbar, Sentry, N+1 detection.", file: "KB_6_Testing_DevOps.html", type: "read" },
      ]},
      { label: "Нед 14 · Вт-Ср", tasks: [
        { t: "Квиз: все DevOps", d: "Все квизы KB_6 часть 2.", file: "KB_6_Testing_DevOps.html", type: "quiz" },
        { t: "🔄 ПОВТОРЕНИЕ: Security (нед.7-8)", d: "Token Rotation, OAuth flows, JWT structure, CORS, CSRF — быстро по памяти.", type: "review" },
      ]},
      { label: "Нед 14 · Чт-Сб", tasks: [
        { t: "Проект: полный pipeline", d: "Docker + GitHub Actions + тесты + деплой на VPS или DigitalOcean. End-to-end.", type: "project" },
      ]},
    ]
  },

  // ====== WEEK 15-16 ======
  { title: "Неделя 15-16: Финальное повторение & Mock-собеседования", theme: "Полный обзор всех тем, mock interviews, слабые места", review: "ВСЁ",
    goal: "Собрать всё вместе. Mock-собеседования. Уверенность на 100%.",
    days: [
      { label: "Нед 15 · Вс", tasks: [
        { t: "🔄 FULL REVIEW: PHP Core", d: "Все квизы KB_1. Шпаргалка нед.2 — обнови.", file: "KB_1_PHP_Core.html", type: "review" },
      ]},
      { label: "Нед 15 · Пн", tasks: [
        { t: "🔄 FULL REVIEW: SQL & Database", d: "Все квизы KB_2. JOIN'ы, ACID, нормализация, индексы — по памяти.", file: "KB_2_SQL_Database.html", type: "review" },
      ]},
      { label: "Нед 15 · Вт", tasks: [
        { t: "🔄 FULL REVIEW: Laravel", d: "Все квизы KB_3. Lifecycle, N+1, Queues, Sanctum, Policies.", file: "KB_3_Laravel.html", type: "review" },
      ]},
      { label: "Нед 15 · Ср", tasks: [
        { t: "🔄 FULL REVIEW: Security", d: "Все квизы KB_4. Token Rotation, OAuth, JWT, CSRF, XSS, CORS.", file: "KB_4_Security.html", type: "review" },
      ]},
      { label: "Нед 15 · Чт", tasks: [
        { t: "🔄 FULL REVIEW: Architecture", d: "Все квизы KB_5. SOLID наизусть. Repository, Service, Strategy.", file: "KB_5_Architecture.html", type: "review" },
      ]},
      { label: "Нед 15 · Пт", tasks: [
        { t: "🔄 FULL REVIEW: Testing & DevOps", d: "Все квизы KB_6. PHPUnit, Docker, CI/CD.", file: "KB_6_Testing_DevOps.html", type: "review" },
      ]},
      { label: "Нед 15 · Сб", tasks: [
        { t: "MOCK INTERVIEW #1: PHP + SQL", d: "Открой Backend_Learning_Program → Собеседование. Ответь на ВСЕ вопросы PHP + Database. Таймер: 2 мин на вопрос.", file: "Backend_Learning_Program.html", type: "quiz" },
      ]},
      { label: "Нед 16 · Вс", tasks: [
        { t: "MOCK INTERVIEW #2: Laravel + Security", d: "Все вопросы Laravel + Security из программы. Вслух, как на собеседовании.", file: "Backend_Learning_Program.html", type: "quiz" },
      ]},
      { label: "Нед 16 · Пн", tasks: [
        { t: "MOCK INTERVIEW #3: Architecture + Testing", d: "SOLID, паттерны, тестирование, DevOps — все вопросы.", file: "Backend_Learning_Program.html", type: "quiz" },
      ]},
      { label: "Нед 16 · Вт-Ср", tasks: [
        { t: "Слабые места: закрой пробелы", d: "Из mock interviews определи слабые темы. Перечитай соответствующие разделы KB. Пройди квизы заново.", type: "review" },
      ]},
      { label: "Нед 16 · Чт-Пт", tasks: [
        { t: "Финальный проект: README для портфолио", d: "Напиши краткое описание всех своих проектов. Укажи технологии, паттерны, архитектуру.", type: "project" },
      ]},
      { label: "Нед 16 · Сб", tasks: [
        { t: "🎉 ФИНАЛ: полный mock interview", d: "24 вопроса за 48 минут. 2 мин на каждый. Запиши на диктофон. Прослушай.", type: "quiz" },
      ]},
    ]
  },
];

// ====== RENDER ======
function render() {
  const tabsEl = document.getElementById('week-tabs');
  const panelsEl = document.getElementById('panels');
  let dayCounter = 0;
  const today = new Date();

  weeks.forEach((w, wi) => {
    // Tab
    const btn = document.createElement('div');
    btn.className = 'week-btn' + (wi === 0 ? ' active' : '');
    btn.textContent = `Нед ${wi + 1}${wi >= 8 ? '-' + (wi + 2 > 16 ? 16 : wi + 2) : ''}`;
    btn.onclick = () => switchWeek(wi);
    tabsEl.appendChild(btn);

    // Panel
    const panel = document.createElement('div');
    panel.className = 'week-panel' + (wi === 0 ? ' active' : '');
    panel.id = 'week-' + wi;

    let html = `<div class="week-header">
      <h2>${w.title}</h2>
      <div class="theme">${w.theme}</div>
      <div class="goal">${w.goal}</div>
      ${w.review ? `<div class="review-tag">🔄 ${w.review}</div>` : ''}
    </div>`;

    w.days.forEach((day, di) => {
      const dayDate = new Date(START);
      dayDate.setDate(dayDate.getDate() + dayCounter);
      const isToday = dayDate.toDateString() === today.toDateString();
      const dateStr = dayDate.toLocaleDateString('ru-RU', { day: 'numeric', month: 'short' });
      const dayName = day.label;

      html += `<div class="day-card ${isToday ? 'today-marker open' : ''}" data-day="${dayCounter}">
        <div class="day-head" onclick="this.parentElement.classList.toggle('open')">
          <div class="day-label">${dayName}<span class="date">${dateStr}</span>${isToday ? ' <span style="color:var(--ac2);font-weight:700;">← СЕГОДНЯ</span>' : ''}</div>
          <div class="day-dur">~${day.tasks.length * 30}-${day.tasks.length * 40} мин</div>
        </div>
        <div class="day-body">`;

      day.tasks.forEach((task, ti) => {
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
      dayCounter++;
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

// Auto-open current week
const today = new Date();
const daysSinceStart = Math.floor((today - START) / (1000*60*60*24));
if (daysSinceStart >= 0) {
  let cumDays = 0;
  for (let i = 0; i < weeks.length; i++) {
    cumDays += weeks[i].days.length;
    if (daysSinceStart < cumDays) { switchWeek(i); break; }
  }
}
</script>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>lucide.createIcons();</script>
</body>
</html>
@endverbatim