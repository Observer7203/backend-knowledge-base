# Словарь терминов: русская база → английская версия

Файл задаёт, как переводить повторяющиеся вещи. Нужен он ровно для одного:
чтобы один и тот же термин везде выглядел одинаково, а английский текст читался
как написанный по-английски, а не переведённый.

## Главное правило

**Большая часть терминов в базе — это английские слова, записанные кириллицей.**
«Миграция», «каст», «хелпер», «мидлварь» — не требуют перевода, им требуется
возврат к оригиналу: `migration`, `cast`, `helper`, `middleware`. Там, где
русский текст объясняет английский термин, в переводе объяснение часто
становится лишним и его убирают.

Обратное тоже верно: русские обороты, выросшие из разговора («разъедутся»,
«тяп-ляп», «сами собой»), в английском переводятся смыслом, а не словами.

## Названия технологий

Пишутся так, как пишет их производитель, и никогда не переводятся:

| Правильно | Неправильно |
|---|---|
| Laravel, Eloquent, Blade, Artisan | laravel, Artisan console |
| Node.js, NestJS, npm | NodeJS, Node JS, NPM |
| PostgreSQL, MySQL, MariaDB, SQLite | Postgres SQL, My SQL |
| Nginx, Docker, Docker Compose | NGINX (кроме логотипа), docker-compose (это команда, не продукт) |
| PHP, JavaScript, TypeScript, Python | Php, Javascript, JS (в заголовках) |
| Composer, Git, Bash | composer (в начале предложения), GIT |

Имена классов, методов, команд и колонок не переводятся **никогда** —
ни в коде, ни в тексте: `foreignId`, `cascadeOnDelete`, `parent_id`,
`php artisan migrate`.

## Термины предметной области

| Русский | English | Не писать |
|---|---|---|
| миграция | migration | |
| внешний ключ | foreign key | external key |
| первичный ключ | primary key | |
| ограничение (в базе) | constraint | limitation |
| индекс | index (мн. ч. **indexes**) | indices |
| каскадное удаление | cascading delete | cascade removal |
| висячая ссылка | dangling reference | hanging link |
| целостность данных | referential integrity | data wholeness |
| перечисление (PHP enum) | enum | enumeration |
| случай перечисления | enum case | enum variant |
| приведение типа (Eloquent) | cast | type conversion |
| отношение, связь | relationship | relation (кроме «relational model») |
| жадная загрузка | eager loading | greedy loading |
| запрос (к базе) | query | request |
| запрос (HTTP) | request | query |
| ответ (HTTP) | response | answer |
| промежуточный слой | middleware | intermediate layer |
| поставщик услуг | service provider | services supplier |
| контейнер | container | |
| внедрение зависимостей | dependency injection | dependencies implementation |
| привязка (в контейнере) | binding | linking |
| очередь | queue | turn |
| задача (в очереди) | job | task (task — это что-то другое) |
| слушатель события | listener | hearer |
| наблюдатель модели | observer | watcher |
| фабрика | factory | |
| сидер | seeder | filler |
| посредник (в шаблоне) | placeholder | |
| мягкое удаление | soft delete | gentle delete |
| блокировка строки | row lock | string blocking |
| гонка, состояние гонки | race condition | racing |
| транзакция | transaction | |
| откат | rollback | roll back (как сущ.) |
| срез, выборка | subset / selection | slice (кроме массивов) |
| подводные камни | pitfalls | underwater stones |
| ловушка | pitfall / gotcha | trap |
| шпаргалка | cheat sheet | crib |
| разбор, разбор по шагам | walkthrough | parsing |
| обзор | overview | review |
| настройка | configuration / setting | tuning |
| окружение | environment | surrounding |
| развёртывание, деплой | deployment | |
| сборка | build | assembly |
| зависимость | dependency | |
| автозагрузка | autoloading | autoload (как сущ.) |

## Структурные элементы базы

| Русский | English |
|---|---|
| раздел | section |
| подраздел | subsection |
| модуль | module |
| выноска «Запомнить» | **Worth remembering** |
| выноска «Ловушка» | **Pitfall** |
| выноска «Зачем это нужно» | **Why this matters** |
| «Что спросят по этой теме» | **What you will be asked** |
| «Разбор на практике» | **Worked example** |
| «Короткий ответ» | **The short answer** |
| «Как это работает на практике» | **How it works in practice** |

## Стиль английского текста

1. **Британская орфография**, как в документации Laravel: `behaviour`,
   `normalise`, `serialise`. Исключение — имена из кода: `serialize()`,
   `normalizer`, они остаются как есть.
2. **Без буквализма.** Русская фраза «данные разъедутся» — это
   `the two copies will drift apart`, а не `the data will drive apart`.
3. **Второе лицо**, как в документации: `you add`, `your migration`. Не
   `we add`, не безличное `one adds`.
4. **Активный залог** там, где в русском безличное: «миграция создаётся
   командой» → `the command creates the migration`.
5. **Никаких эмодзи** — то же правило, что и в русской версии.
6. Длинное тире `—` в русском становится либо запятой, либо двоеточием, либо
   точкой. Английский текст с обилием тире читается как перевод.
7. Числа и единицы: `12 KB`, `64 characters`, `0.12 s`. Неразрывные пробелы не
   нужны.

## Код внутри примеров

Переводятся **только комментарии и строки, которые видит пользователь**:

```php
// nullable обязателен: у корневых категорий родителя нет
$table->foreignId('parent_id')->nullable();
```
становится
```php
// nullable is required: root categories have no parent
$table->foreignId('parent_id')->nullable();
```

Не переводятся: имена переменных, методов, колонок, значения перечислений,
ключи массивов, имена файлов и команды. `'pending_payment'` остаётся
`'pending_payment'` — это значение в базе, а не текст для чтения.

Строки, которые реально видит пользователь, переводятся:
`'Ожидает оплаты'` → `'Awaiting payment'`.

## Технические требования к переведённому файлу

1. Файл кладётся в `resources/views/kb/en/` под тем же именем. Контроллер
   подхватывает его сам; если файла нет, отдаётся русский оригинал.
2. **`<html lang="en">`** обязателен. По этому атрибуту `kb.js` понимает, что
   перевода нет, и показывает полосу сверху. Забытый `lang="ru"` в переведённом
   файле выдаст полосу на готовой странице.
3. Ссылка «на главную» в боковой панели ведёт на `/en`.
4. Идентификаторы разделов (`id="sec-..."`, `showSection('...')`,
   `showSub('...')`) **не переводятся**: по ним работают якоря, поиск и
   переключение языка на той же странице.
5. После перевода модуля пересобрать индекс:
   `php artisan kb:search-index --locale=en`.

## Что делать с непереводимым

Если русский текст опирается на игру слов или на русскую грамматику
(например, объяснение, почему `children`, а не `childs`), в английской версии
пример остаётся, но объяснение переписывается под англоязычного читателя: для
него ошибка `childs` очевидна, поэтому акцент смещается на то, что фреймворк
имя отношения не проверяет.
