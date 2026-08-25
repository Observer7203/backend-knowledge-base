@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laravel — продвинутый разбор</title>
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
.nav-subgroup{margin:2px 0 4px 22px;border-left:1px solid var(--border);padding-left:8px;}
.nav-subitem{display:block;padding:5px 8px;color:var(--text2);text-decoration:none;font-size:12px;cursor:pointer;border-radius:5px;transition:all 0.15s;}
.nav-subitem:hover{background:var(--bg);color:var(--primary);}
.nav-subitem.active{color:var(--primary);font-weight:600;background:var(--primary-light,#EFF2F5);}
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
  <div class="sidebar-title">Laravel</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">Ядро</div>
  <a class="nav-item" onclick="showSection('lifecycle',this)"><i data-lucide="rotate-cw"></i> Request Lifecycle</a>
  <a class="nav-item" onclick="showSection('bootstrap-deep',this)"><i data-lucide="package"></i> Bootstrap: providers &amp; app.php</a>
  <a class="nav-item" onclick="showSection('routing',this)"><i data-lucide="route"></i> Routing</a>
  <a class="nav-item" onclick="showSection('controllers',this)"><i data-lucide="git-pull-request"></i> Controllers</a>
  <div class="nav-subgroup">
    <a class="nav-subitem" onclick="showSub('controllers','ctrl-overview',this)">Обзор + структура папки</a>
    <a class="nav-subitem" onclick="showSub('controllers','ctrl-thin-fat',this)">Тонкий vs толстый контроллер</a>
    <a class="nav-subitem" onclick="showSub('controllers','ctrl-resource',this)">Resource Controllers (7 методов)</a>
    <a class="nav-subitem" onclick="showSub('controllers','ctrl-api-resource',this)">apiResource — для API</a>
    <a class="nav-subitem" onclick="showSub('controllers','ctrl-nested',this)">Nested / Shallow resources</a>
    <a class="nav-subitem" onclick="showSub('controllers','ctrl-middleware',this)">Middleware в контроллере (L10/L11)</a>
    <a class="nav-subitem" onclick="showSub('controllers','ctrl-invokable',this)">Single Action / Invokable</a>
    <a class="nav-subitem" onclick="showSub('controllers','ctrl-responses',this)">Возврат ответов</a>
  </div>
  <a class="nav-item" onclick="showSection('actions-services',this)"><i data-lucide="package-plus"></i> Actions &amp; Services</a>
  <div class="nav-subgroup">
    <a class="nav-subitem" onclick="showSub('actions-services','as-overview',this)">Обзор: тонкий контроллер</a>
    <a class="nav-subitem" onclick="showSub('actions-services','as-service',this)">Service Layer (что это, где)</a>
    <a class="nav-subitem" onclick="showSub('actions-services','as-action',this)">Action-паттерн (single-purpose)</a>
    <a class="nav-subitem" onclick="showSub('actions-services','as-compare',this)">Service vs Action vs UseCase</a>
    <a class="nav-subitem" onclick="showSub('actions-services','as-repository',this)">Repository pattern</a>
    <a class="nav-subitem" onclick="showSub('actions-services','as-folders',this)">Куда положить: app/Services vs app/Actions</a>
    <a class="nav-subitem" onclick="showSub('actions-services','as-testing',this)">Тестирование отдельно от контроллера</a>
    <a class="nav-subitem" onclick="showSub('actions-services','as-practice',this)">Практика: PlaceOrder Action</a>
  </div>
  <a class="nav-item" onclick="showSection('middleware',this)"><i data-lucide="filter"></i> Middleware</a>
  <div class="nav-subgroup">
    <a class="nav-subitem" onclick="showSub('middleware','mw-purpose',this)">Назначение</a>
    <a class="nav-subitem" onclick="showSub('middleware','mw-types',this)">Виды и порядок</a>
    <a class="nav-subitem" onclick="showSub('middleware','mw-chain',this)">Как работает цепочка + $next</a>
    <a class="nav-subitem" onclick="showSub('middleware','mw-reverse',this)">Обратный проход</a>
    <a class="nav-subitem" onclick="showSub('middleware','mw-terminate',this)">Фаза terminate</a>
    <a class="nav-subitem" onclick="showSub('middleware','mw-practice',this)">Практика: пример кода</a>
    <a class="nav-subitem" onclick="showSub('middleware','mw-pitfalls',this)">Особые случаи</a>
    <a class="nav-subitem" onclick="showSub('middleware','mw-global',this)">Глобальные middleware</a>
    <a class="nav-subitem" onclick="showSub('middleware','mw-groups',this)">Кастомизация групп web/api</a>
    <a class="nav-subitem" onclick="showSub('middleware','mw-aliases',this)">Middleware Aliases</a>
    <a class="nav-subitem" onclick="showSub('middleware','mw-params',this)">Параметризованный middleware</a>
    <a class="nav-subitem" onclick="showSub('middleware','mw-cors',this)">CORS</a>
  </div>
  <a class="nav-item" onclick="showSection('http-objects',this)"><i data-lucide="package"></i> HTTP-объекты Laravel</a>
  <div class="nav-subgroup">
    <a class="nav-subitem" onclick="showSub('http-objects','ho-overview',this)">Обзор: Symfony HttpFoundation</a>
    <a class="nav-subitem" onclick="showSub('http-objects','ho-request',this)">Request — входящий запрос</a>
    <a class="nav-subitem" onclick="showSub('http-objects','ho-response',this)">Response — базовый ответ</a>
    <a class="nav-subitem" onclick="showSub('http-objects','ho-json',this)">JsonResponse</a>
    <a class="nav-subitem" onclick="showSub('http-objects','ho-redirect',this)">RedirectResponse (withErrors, withInput)</a>
    <a class="nav-subitem" onclick="showSub('http-objects','ho-collection',this)">Collection</a>
    <a class="nav-subitem" onclick="showSub('http-objects','ho-http-client',this)">Http Client Response</a>
    <a class="nav-subitem" onclick="showSub('http-objects','ho-app',this)">Application (container)</a>
  </div>
  <a class="nav-item" onclick="showSection('validation',this)"><i data-lucide="check-circle"></i> Validation &amp; FormRequest</a>
  <div class="nav-subgroup">
    <a class="nav-subitem" onclick="showSub('validation','val-purpose',this)">Зачем нужна валидация</a>
    <a class="nav-subitem" onclick="showSub('validation','val-what',this)">Что валидируют</a>
    <a class="nav-subitem" onclick="showSub('validation','val-lifecycle',this)">Место в цикле запроса</a>
    <a class="nav-subitem" onclick="showSub('validation','val-formrequest',this)">Компоненты FormRequest</a>
    <a class="nav-subitem" onclick="showSub('validation','val-compare',this)">FormRequest vs inline vs Validator::make</a>
    <a class="nav-subitem" onclick="showSub('validation','val-practice',this)">Практика: пример кода</a>
    <a class="nav-subitem" onclick="showSub('validation','val-pitfalls',this)">Особые случаи</a>
  </div>

  <div class="nav-group-label">Данные</div>
  <a class="nav-item" onclick="showSection('api-resources',this)"><i data-lucide="file-json"></i> API Resources</a>
  <div class="nav-subgroup">
    <a class="nav-subitem" onclick="showSub('api-resources','ar-overview',this)">Зачем нужны API Resources</a>
    <a class="nav-subitem" onclick="showSub('api-resources','ar-jsonresource',this)">JsonResource — один ресурс</a>
    <a class="nav-subitem" onclick="showSub('api-resources','ar-collection',this)">Collection — список ресурсов</a>
    <a class="nav-subitem" onclick="showSub('api-resources','ar-conditional',this)">Условные поля (when / whenLoaded)</a>
    <a class="nav-subitem" onclick="showSub('api-resources','ar-meta',this)">Meta / links / additional</a>
    <a class="nav-subitem" onclick="showSub('api-resources','ar-pagination',this)">Пагинация в ресурсах</a>
    <a class="nav-subitem" onclick="showSub('api-resources','ar-wrapping',this)">Wrapping (обёртка data)</a>
    <a class="nav-subitem" onclick="showSub('api-resources','ar-status',this)">Кастомный статус и заголовки</a>
  </div>
  <a class="nav-item" onclick="showSection('eloquent',this)"><i data-lucide="database"></i> Eloquent (базовое)</a>
  <div class="nav-subgroup">
    <a class="nav-subitem" onclick="showSub('eloquent','el-purpose',this)">Назначение</a>
    <a class="nav-subitem" onclick="showSub('eloquent','el-features',this)">Основные возможности</a>
    <a class="nav-subitem" onclick="showSub('eloquent','el-mass-assignment',this)">Mass Assignment ($fillable / $guarded)</a>
    <a class="nav-subitem" onclick="showSub('eloquent','el-casts',this)">Casts — типы атрибутов</a>
    <a class="nav-subitem" onclick="showSub('eloquent','el-scopes',this)">Scopes — переиспользуемые фильтры</a>
    <a class="nav-subitem" onclick="showSub('eloquent','el-accessors',this)">Accessors / Mutators</a>
    <a class="nav-subitem" onclick="showSub('eloquent','el-observers',this)">Observers — наблюдатели за событиями</a>
    <a class="nav-subitem" onclick="showSub('eloquent','el-relations',this)">Связи: hasOne / hasMany / belongsTo / belongsToMany</a>
    <a class="nav-subitem" onclick="showSub('eloquent','el-practice',this)">Практика: модель заказа</a>
    <a class="nav-subitem" onclick="showSub('eloquent','el-pitfalls',this)">Особые случаи</a>
  </div>
  <a class="nav-item" onclick="showSection('cache',this)"><i data-lucide="zap"></i> Cache</a>
  <div class="nav-subgroup">
    <a class="nav-subitem" onclick="showSub('cache','cache-purpose',this)">Назначение + инвалидация</a>
    <a class="nav-subitem" onclick="showSub('cache','cache-drivers',this)">Драйверы (file/db/redis/memcached/...)</a>
    <a class="nav-subitem" onclick="showSub('cache','cache-stores',this)">Multiple Stores — несколько хранилищ</a>
    <a class="nav-subitem" onclick="showSub('cache','cache-features',this)">Возможности (tags/locks/stores)</a>
    <a class="nav-subitem" onclick="showSub('cache','cache-basics',this)">Базовые операции (put/get/remember/pull)</a>
    <a class="nav-subitem" onclick="showSub('cache','cache-return-types',this)">Что возвращают методы (для переменной)</a>
    <a class="nav-subitem" onclick="showSub('cache','cache-tags',this)">Cache Tags — групповая инвалидация</a>
    <a class="nav-subitem" onclick="showSub('cache','cache-locks',this)">Atomic Locks — распределённые блокировки</a>
    <a class="nav-subitem" onclick="showSub('cache','cache-pull',this)">pull() — get + forget за один вызов</a>
    <a class="nav-subitem" onclick="showSub('cache','cache-db-table',this)">Таблица для database-драйвера</a>
  </div>

  <div class="nav-group-label">Асинхронность</div>
  <a class="nav-item" onclick="showSection('queues',this)"><i data-lucide="list-checks"></i> Queues</a>
  <div class="nav-subgroup">
    <a class="nav-subitem" onclick="showSub('queues','q-purpose',this)">Назначение</a>
    <a class="nav-subitem" onclick="showSub('queues','q-drivers',this)">Драйверы (sync/database/redis/sqs/beanstalkd)</a>
    <a class="nav-subitem" onclick="showSub('queues','q-jobs',this)">Job-классы (tries/timeout/backoff)</a>
    <a class="nav-subitem" onclick="showSub('queues','q-chains-batches',this)">Chains и Batches (группы задач)</a>
    <a class="nav-subitem" onclick="showSub('queues','q-rate-limit',this)">Rate Limiting для Job</a>
    <a class="nav-subitem" onclick="showSub('queues','q-unique',this)">Unique Jobs — защита от дублирования</a>
    <a class="nav-subitem" onclick="showSub('queues','q-features',this)">Возможности (jobs/retry/chains/batches)</a>
    <a class="nav-subitem" onclick="showSub('queues','q-practice',this)">Практика: job с retry + idempotency</a>
    <a class="nav-subitem" onclick="showSub('queues','q-pitfalls',this)">Особые случаи</a>
  </div>
  <a class="nav-item" onclick="showSection('events',this)"><i data-lucide="activity"></i> Events &amp; Listeners</a>
  <div class="nav-subgroup">
    <a class="nav-subitem" onclick="showSub('events','ev-purpose',this)">Назначение</a>
    <a class="nav-subitem" onclick="showSub('events','ev-components',this)">Компоненты (Event/Listener/Subscriber)</a>
    <a class="nav-subitem" onclick="showSub('events','ev-event-class',this)">Event Class — DTO + Broadcasting</a>
    <a class="nav-subitem" onclick="showSub('events','ev-listener-class',this)">Listener Class — обработчик события</a>
    <a class="nav-subitem" onclick="showSub('events','ev-subscriber',this)">Subscriber — группировка listeners</a>
    <a class="nav-subitem" onclick="showSub('events','ev-listen',this)">Регистрация: $listen формат</a>
    <a class="nav-subitem" onclick="showSub('events','ev-queue-config',this)">Queue-config для Listeners</a>
    <a class="nav-subitem" onclick="showSub('events','ev-event-vs-job',this)">Event vs Job — когда что</a>
    <a class="nav-subitem" onclick="showSub('events','ev-practice',this)">Практика: событие + асинхронный listener</a>
    <a class="nav-subitem" onclick="showSub('events','ev-pitfalls',this)">Особые случаи</a>
  </div>
  <a class="nav-item" onclick="showSection('scheduler',this)"><i data-lucide="calendar-clock"></i> Scheduler</a>
  <div class="nav-subgroup">
    <a class="nav-subitem" onclick="showSub('scheduler','sch-purpose',this)">Назначение</a>
    <a class="nav-subitem" onclick="showSub('scheduler','sch-versions',this)">Где определяется (L10 vs L11+)</a>
    <a class="nav-subitem" onclick="showSub('scheduler','sch-features',this)">Возможности (overlap/oneServer/output)</a>
    <a class="nav-subitem" onclick="showSub('scheduler','sch-overlapping',this)">withoutOverlapping — параллельность</a>
    <a class="nav-subitem" onclick="showSub('scheduler','sch-oneserver',this)">onOneServer — на одном сервере в кластере</a>
    <a class="nav-subitem" onclick="showSub('scheduler','sch-methods',this)">Все методы расписания (таблица)</a>
    <a class="nav-subitem" onclick="showSub('scheduler','sch-output',this)">Output Handling — вывод задач</a>
    <a class="nav-subitem" onclick="showSub('scheduler','sch-cron',this)">Запуск через cron</a>
    <a class="nav-subitem" onclick="showSub('scheduler','sch-practice',this)">Практика: расписание для отчётов</a>
    <a class="nav-subitem" onclick="showSub('scheduler','sch-pitfalls',this)">Особые случаи</a>
  </div>

  <div class="nav-group-label">Безопасность</div>
  <a class="nav-item" onclick="showSection('auth',this)"><i data-lucide="key"></i> Auth, Gates &amp; Policies</a>
  <div class="nav-subgroup">
    <a class="nav-subitem" onclick="showSub('auth','auth-purpose',this)">Назначение</a>
    <a class="nav-subitem" onclick="showSub('auth','auth-components',this)">Компоненты (Guards/Providers/Gates/Policies)</a>
    <a class="nav-subitem" onclick="showSub('auth','auth-guards',this)">Guards — глубокий разбор</a>
    <a class="nav-subitem" onclick="showSub('auth','auth-providers',this)">Providers — источники пользователей</a>
    <a class="nav-subitem" onclick="showSub('auth','auth-spa',this)">SPA и Sanctum</a>
    <a class="nav-subitem" onclick="showSub('auth','auth-practice',this)">Практика: policy для модели</a>
    <a class="nav-subitem" onclick="showSub('auth','auth-pitfalls',this)">Особые случаи</a>
  </div>

  <div class="nav-group-label">Производительность</div>
  <a class="nav-item" onclick="showSection('octane',this)"><i data-lucide="rocket"></i> Octane / long-running</a>

  <div class="nav-group-label">Применение</div>
  <a class="nav-item" onclick="showSection('practice',this)"><i data-lucide="hammer"></i> Практика</a>
  <a class="nav-item" onclick="showSection('pitfalls',this)"><i data-lucide="alert-octagon"></i> Подводные камни</a>
  <a class="nav-item" onclick="showSection('interview',this)"><i data-lucide="brain"></i> На собеседование</a>
</div>

<div class="main">
<div class="page-header">
  <h1>Laravel</h1>
  <p>Цикл запроса, роутинг, middleware, валидация, Eloquent, кеш, очереди, события, scheduler, авторизация, Octane и long-running окружения. Глубокий middle/senior разбор с примерами и pitfalls каждого механизма.</p>
  <div class="badge-row">
    <span class="badge">Laravel 11/12</span>
    <span class="badge">Eloquent</span>
    <span class="badge">Queues</span>
    <span class="badge">Octane</span>
    <span class="badge badge-success">Middle / Senior</span>
  </div>
</div>

<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>
  <p class="text">Laravel — фреймворк, чьё освоение в глубину занимает годы. Поверхностное знание (роуты, контроллеры, миграции) хватает на CRUD'ы, но любая нетривиальная задача — расширяемый модуль, тонкая авторизация, надёжная асинхронность, Octane-окружение — требует понимания, как фреймворк устроен изнутри. Этот раздел даёт средне-старший уровень: что происходит при HTTP-запросе, как middleware вмешивается в pipeline, как очереди гарантируют доставку, чем gate отличается от policy, и какие ловушки ждут в long-running режиме.</p>

  <div class="info-box primary">
    <strong>Что разбирается:</strong>
    <ul class="bullets" style="margin-top:6px;margin-bottom:0;color:#404357;">
      <li>Полный цикл HTTP-запроса от <code>public/index.php</code> до response;</li>
      <li>Routing с привязкой моделей, scoped bindings, route caching;</li>
      <li>Middleware: handle/terminate, parameters, groups, before/after;</li>
      <li>Eloquent (базовое; deep — в KB_12), Cache c тегами и locks;</li>
      <li>Queues: драйверы, retry, batching, chains, rate limiting, race conditions;</li>
      <li>Events &amp; Listeners, Scheduler с overlapping и withoutOverlapping;</li>
      <li>Auth: guards, providers, gates и policies, before-хуки;</li>
      <li>Octane: state leaks, request-scope, что ломается и как лечить.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Пререквизиты</div>
    <ul class="bullets">
      <li>KB_1 — PHP OOP, конструкторы, интерфейсы;</li>
      <li>KB_2 — SQL и индексы (для Eloquent и Queues на БД-драйвере);</li>
      <li>Поверхностное знакомство с Laravel — что такое контроллер, миграция, фабрика.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map"></i> Связь с другими разделами</div>
    <table class="data-table">
      <tr><th>Тема</th><th>Где глубокий разбор</th></tr>
      <tr><td>Service Container, DI, providers</td><td>KB_13</td></tr>
      <tr><td>Eloquent advanced (полиморфизм, observers, race)</td><td>KB_12</td></tr>
      <tr><td>Хелперы и фасады</td><td>KB_10</td></tr>
      <tr><td>Наследование Controller/Model/FormRequest</td><td>KB_9</td></tr>
      <tr><td>Тестирование Laravel-приложений</td><td>KB_6 + KB_14</td></tr>
    </table>
  </div>
</div>

<div id="sec-lifecycle" class="section">
  <div class="section-title">Request Lifecycle</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Понимание цикла запроса — основа диагностики любого «магического» поведения Laravel. От ошибки 500 до неожиданного middleware-эффекта: всё лечится тем, что разработчик знает, в какой момент запускается какая часть фреймворка. Цикл одинаков и для классического PHP-FPM, и (с оговорками) для Octane — отличие в том, что в Octane bootstrap-фаза происходит один раз на процесс, а не на запрос.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="terminal"></i> Что такое «Bootstrap»</div>
    <p class="text"><strong>Bootstrap</strong> = «загрузка / инициализация». Термин из идиомы <em>«pull yourself up by your bootstraps»</em> — «поднять себя за шнурки собственных ботинок». В контексте фреймворка это код, который выполняется <strong>до того</strong>, как приложение начнёт обрабатывать запрос.</p>
    <p class="text">Bootstrap собирает объект <code>Application</code> (DI-контейнер), регистрирует сервис-провайдеры, читает конфиги, вешает middleware — и только потом отдаёт управление роутеру.</p>
    <p class="text"><strong>Точка входа:</strong> <code>public/index.php</code> → подключает <code>bootstrap/app.php</code> → получает готовое приложение → <code>$app-&gt;handle($request)</code>.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-code"></i> Пример <code>bootstrap/app.php</code> (Laravel 11+)</div>
    <p class="text">С Laravel 11 конфигурация приложения переехала из <code>app/Http/Kernel.php</code>, <code>app/Console/Kernel.php</code> и <code>app/Exceptions/Handler.php</code> в один декларативный файл <code>bootstrap/app.php</code>.</p>
    <pre><code><span class="c-key">return</span> <span class="c-type">Application</span>::<span class="c-fn">configure</span>(<span class="c-var">basePath</span>: <span class="c-fn">dirname</span>(<span class="c-fn">__DIR__</span>))
    -&gt;<span class="c-fn">withRouting</span>(
        <span class="c-var">web</span>:      <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/web.php'</span>,
        <span class="c-var">api</span>:      <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/api.php'</span>,
        <span class="c-var">commands</span>: <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/console.php'</span>,
        <span class="c-var">health</span>:   <span class="c-str">'/up'</span>,
    )
    -&gt;<span class="c-fn">withMiddleware</span>(<span class="c-key">function</span> (<span class="c-type">Middleware</span> <span class="c-var">$middleware</span>) {
        <span class="c-var">$middleware</span>-&gt;<span class="c-fn">append</span>(<span class="c-type">EnsureUserIsActive</span>::<span class="c-key">class</span>);
        <span class="c-var">$middleware</span>-&gt;<span class="c-fn">alias</span>([<span class="c-str">'admin'</span> =&gt; <span class="c-type">AdminOnly</span>::<span class="c-key">class</span>]);
    })
    -&gt;<span class="c-fn">withExceptions</span>(<span class="c-key">function</span> (<span class="c-type">Exceptions</span> <span class="c-var">$exceptions</span>) {
        <span class="c-var">$exceptions</span>-&gt;<span class="c-fn">render</span>(<span class="c-key">function</span> (<span class="c-type">ApiException</span> <span class="c-var">$e</span>) {
            <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>([<span class="c-str">'error'</span> =&gt; <span class="c-var">$e</span>-&gt;<span class="c-fn">getMessage</span>()], <span class="c-num">422</span>);
        });
    })
    -&gt;<span class="c-fn">create</span>();</code></pre>

    <div class="subsection-title" style="margin-top:14px"><i data-lucide="check-square"></i> Что тут происходит</div>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Что настраивает</th></tr></thead>
      <tbody>
        <tr><td><code>configure(basePath: ...)</code></td><td>Стартует построение <code>Application</code>. <code>basePath</code> — корень проекта.</td></tr>
        <tr><td><code>withRouting</code></td><td>Пути к файлам маршрутов: <code>web</code> (с сессией/CSRF), <code>api</code> (без), <code>commands</code> (artisan). <code>health: '/up'</code> — авто-эндпоинт для healthcheck.</td></tr>
        <tr><td><code>withMiddleware</code></td><td>Регистрирует глобальные middleware, группы и алиасы. Пример: <code>append()</code> добавляет в конец глобального стека; <code>alias()</code> создаёт короткое имя для роутов.</td></tr>
        <tr><td><code>withExceptions</code></td><td>Кастомная обработка исключений. Пример: <code>ApiException</code> → JSON-ответ 422.</td></tr>
        <tr><td><code>create()</code></td><td>Финализирует и возвращает готовый <code>Application</code>. Дальше его подхватит <code>public/index.php</code>.</td></tr>
      </tbody>
    </table>

    <div class="remember-box">
      <strong>Отличие Laravel 11+ от 10 и ниже:</strong> раньше эти настройки лежали в 3 разных файлах (<code>Http/Kernel.php</code>, <code>Console/Kernel.php</code>, <code>Exceptions/Handler.php</code>). Теперь всё в одном месте — <code>bootstrap/app.php</code> — как декларативная цепочка вызовов.
    </div>

    <div class="subsection-title" style="margin-top:14px"><i data-lucide="info"></i> Термины, которые встретились выше</div>

    <div class="card">
      <h3>DI (Dependency Injection)</h3>
      <p class="text"><strong>Внедрение зависимостей</strong> — зависимости не создаются <em>внутри</em> класса, а передаются <em>извне</em>. Класс перестаёт «знать», как строить свои сервисы — он их только принимает и использует.</p>
      <pre><code><span class="c-comment">// ❌ Без DI — класс сам создаёт зависимость</span>
<span class="c-key">class</span> <span class="c-type">UserService</span> {
    <span class="c-key">public function</span> <span class="c-fn">save</span>() {
        <span class="c-var">$db</span> = <span class="c-key">new</span> <span class="c-type">PDO</span>(<span class="c-str">'mysql:...'</span>);   <span class="c-comment">// жёстко привязан к PDO</span>
        <span class="c-var">$db</span>-&gt;<span class="c-fn">exec</span>(...);
    }
}

<span class="c-comment">// ✓ С DI — зависимость передаётся снаружи</span>
<span class="c-key">class</span> <span class="c-type">UserService</span> {
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private</span> <span class="c-type">PDO</span> <span class="c-var">$db</span>) {}
    <span class="c-key">public function</span> <span class="c-fn">save</span>() {
        <span class="c-key">$this</span>-&gt;<span class="c-var">db</span>-&gt;<span class="c-fn">exec</span>(...);
    }
}</code></pre>
      <p class="text">Laravel-контейнер сам разрешает эти зависимости при вызове: увидит <code>PDO $db</code> в конструкторе → сам создаст или подставит singleton. Подробнее — в KB_13 Service Container.</p>
    </div>

    <div class="card">
      <h3>Декларативный vs Императивный</h3>
      <table class="data-table">
        <thead><tr><th></th><th>Императивный</th><th>Декларативный</th></tr></thead>
        <tbody>
          <tr>
            <td><strong>Что описываешь</strong></td>
            <td><em>Как</em> сделать — пошаговые инструкции</td>
            <td><em>Что</em> хочешь получить — фреймворк решает как</td>
          </tr>
          <tr>
            <td><strong>Кто собирает</strong></td>
            <td>Ты — руками через <code>new</code>, <code>if</code>, циклы</td>
            <td>Фреймворк — по твоей конфигурации</td>
          </tr>
          <tr>
            <td><strong>Пример</strong></td>
            <td><code>for ($i=0;$i&lt;10;$i++) echo $i;</code></td>
            <td><code>SELECT * FROM users WHERE age &gt; 18</code></td>
          </tr>
        </tbody>
      </table>
      <p class="text"><strong>Пример в Laravel:</strong> старый Laravel 10 требовал императивно править 3 файла — регистрируй middleware в <code>$middleware</code>, обработчик в <code>Handler::register()</code>. Laravel 11+ — декларативно: «мои middleware — вот эти, мои исключения — вот такие», а <em>как</em> это подключить — забота фреймворка.</p>
    </div>

    <div class="card">
      <h3>Провайдеры (Service Providers)</h3>
      <p class="text">Классы, где ты <strong>регистрируешь свои сервисы</strong> в контейнере и <strong>бутстрапишь</strong> их. Два ключевых метода:</p>
      <ul style="line-height:1.9;margin:6px 0 0 20px">
        <li><code>register()</code> — <strong>только биндинги</strong> в контейнер: <code>$this-&gt;app-&gt;bind(PaymentGateway::class, StripeGateway::class)</code>. Никаких обращений к другим сервисам — они могут быть ещё не зарегистрированы.</li>
        <li><code>boot()</code> — вызывается, когда <strong>всё зарегистрировано</strong>: сюда вешаешь Blade-директивы, observers, policies, кастомные валидаторы, макросы для коллекций/query builder.</li>
      </ul>
      <pre><code><span class="c-key">class</span> <span class="c-type">AppServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// Только биндинги — другие сервисы ещё могут быть не готовы</span>
        <span class="c-key">$this</span>-&gt;<span class="c-var">app</span>-&gt;<span class="c-fn">bind</span>(<span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>, <span class="c-type">StripeGateway</span>::<span class="c-key">class</span>);
        <span class="c-key">$this</span>-&gt;<span class="c-var">app</span>-&gt;<span class="c-fn">singleton</span>(<span class="c-type">Cache</span>::<span class="c-key">class</span>, <span class="c-key">fn</span>() =&gt; <span class="c-key">new</span> <span class="c-type">RedisCache</span>());
    }

    <span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// Всё зарегистрировано — можно вешать хуки, макросы, директивы</span>
        <span class="c-type">Blade</span>::<span class="c-fn">directive</span>(<span class="c-str">'money'</span>, <span class="c-key">fn</span>(<span class="c-var">$amount</span>) =&gt; <span class="c-str">"&lt;?= number_format($amount, 2) ?&gt;"</span>);
        <span class="c-type">User</span>::<span class="c-fn">observe</span>(<span class="c-type">UserObserver</span>::<span class="c-key">class</span>);
        <span class="c-type">Validator</span>::<span class="c-fn">extend</span>(<span class="c-str">'phone_kz'</span>, [<span class="c-type">PhoneRule</span>::<span class="c-key">class</span>, <span class="c-str">'validate'</span>]);
    }
}</code></pre>
      <div class="remember-box">
        <strong>Laravel 11+:</strong> список провайдеров переехал в <code>bootstrap/providers.php</code> (раньше — массив <code>'providers'</code> в <code>config/app.php</code>). Пример:
        <pre style="margin-top:8px"><code><span class="c-comment">// bootstrap/providers.php</span>
<span class="c-key">return</span> [
    <span class="c-type">App</span>\<span class="c-type">Providers</span>\<span class="c-type">AppServiceProvider</span>::<span class="c-key">class</span>,
    <span class="c-type">App</span>\<span class="c-type">Providers</span>\<span class="c-type">PaymentServiceProvider</span>::<span class="c-key">class</span>,
];</code></pre>
      </div>
      <p class="text"><strong>Порядок выполнения:</strong> Laravel сначала вызывает <code>register()</code> у ВСЕХ провайдеров, затем <code>boot()</code> у ВСЕХ. Отсюда правило «в register — только биндинги, в boot — всё что использует другие сервисы».</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cpu"></i> Что такое Kernel (Ядро)</div>
    <p class="text"><strong>Ядро (Kernel)</strong> в Laravel — центральный диспетчер, через который проходят все запросы к приложению. Как «дирижёр оркестра», который решает, какие инструменты (middleware, сервис-провайдеры, маршруты) должны быть задействованы для обработки каждого конкретного запроса.</p>

    <h4 style="margin:16px 0 8px;font-size:14px;font-weight:700"><i data-lucide="split" style="width:14px;height:14px;vertical-align:-2px"></i> Два типа ядер</h4>
    <p class="text">В Laravel существует два ядра, каждое отвечает за свой тип входящих запросов.</p>

    <div class="card">
      <h3>1. HTTP-ядро — <code>Illuminate\Foundation\Http\Kernel</code></h3>
      <p><strong>Назначение:</strong> обрабатывает все веб-запросы, поступающие через <code>public/index.php</code>.</p>
      <p><strong>Точка входа:</strong> <code>public/index.php</code> вызывает метод <code>handleRequest()</code> у <code>Application</code> (Laravel 11+), который внутри дёргает <code>Http\Kernel::handle($request)</code>.</p>
      <pre><code><span class="c-comment">// public/index.php (Laravel 11+)</span>
<span class="c-var">$app</span> = <span class="c-key">require</span> <span class="c-fn">__DIR__</span>.<span class="c-str">'/../bootstrap/app.php'</span>;
<span class="c-var">$app</span>-&gt;<span class="c-fn">handleRequest</span>(<span class="c-type">Request</span>::<span class="c-fn">capture</span>());</code></pre>
    </div>

    <div class="card">
      <h3>2. Консольное ядро — <code>Illuminate\Foundation\Console\Kernel</code></h3>
      <p><strong>Назначение:</strong> обрабатывает все команды Artisan, запускаемые из терминала (<code>php artisan migrate</code>, <code>php artisan queue:work</code>, etc).</p>
      <p><strong>Точка входа:</strong> файл <code>artisan</code> в корне проекта вызывает метод <code>handleCommand()</code>.</p>
      <pre><code><span class="c-comment">// artisan (Laravel 11+)</span>
<span class="c-var">$app</span> = <span class="c-key">require_once</span> <span class="c-fn">__DIR__</span>.<span class="c-str">'/bootstrap/app.php'</span>;
<span class="c-var">$status</span> = <span class="c-var">$app</span>-&gt;<span class="c-fn">handleCommand</span>(<span class="c-key">new</span> <span class="c-type">ArgvInput</span>);
<span class="c-key">exit</span>(<span class="c-var">$status</span>);</code></pre>
    </div>

    <h4 style="margin:20px 0 8px;font-size:14px;font-weight:700"><i data-lucide="settings" style="width:14px;height:14px;vertical-align:-2px"></i>  Основные задачи ядра</h4>
    <p class="text">Независимо от типа, ядро выполняет <strong>две ключевые функции</strong>.</p>

    <div class="card">
      <h3>1. Запуск загрузчиков (Bootstrappers)</h3>
      <p>Перед обработкой запроса ядро выполняет серию подготовительных задач:</p>
      <ul style="margin:6px 0 0 20px;line-height:1.7;color:var(--text2)">
        <li>Настройка <strong>обработки ошибок</strong> — регистрирует Whoops / Handler</li>
        <li>Настройка <strong>логирования</strong> — конфигурация каналов Monolog</li>
        <li>Определение <strong>окружения</strong> — читает <code>APP_ENV</code> из <code>.env</code> (<code>local</code>, <code>production</code>, <code>testing</code>)</li>
        <li> Загрузка <strong>всех сервис-провайдеров</strong> — самый важный шаг: они регистрируют и настраивают базу данных, очереди, валидацию, маршрутизацию, кеш и всё остальное</li>
      </ul>
    </div>

    <div class="card">
      <h3>2. Управление промежуточным слоем (Middleware)</h3>
      <p>Ядро отвечает за то, чтобы запрос прошёл через <strong>стек middleware</strong> до того, как попадёт в контроллер. Эти middleware решают критически важные задачи, общие для всех или многих запросов:</p>
      <ul style="margin:6px 0 0 20px;line-height:1.7;color:var(--text2)">
        <li>Чтение и запись <strong>HTTP-сессий</strong> (<code>StartSession</code>)</li>
        <li>Проверка <strong>CSRF-токена</strong> для защиты от межсайтовых подделок запросов (<code>ValidateCsrfToken</code>)</li>
        <li>Проверка, не находится ли приложение в <strong>режиме обслуживания</strong> (<code>PreventRequestsDuringMaintenance</code>)</li>
        <li>Trim пробелов, конвертация пустых строк в null, обработка CORS, доверие прокси, шифрование cookies</li>
      </ul>
    </div>

    <h4 style="margin:20px 0 8px;font-size:14px;font-weight:700"><i data-lucide="table" style="width:14px;height:14px;vertical-align:-2px"></i> Сравнительная таблица</h4>
    <table class="data-table">
      <thead><tr><th></th><th>HTTP Kernel</th><th>Console Kernel</th></tr></thead>
      <tbody>
        <tr>
          <td><strong>Класс</strong></td>
          <td><code>Illuminate\Foundation\Http\Kernel</code></td>
          <td><code>Illuminate\Foundation\Console\Kernel</code></td>
        </tr>
        <tr>
          <td><strong>Точка входа</strong></td>
          <td><code>public/index.php</code> → <code>handleRequest()</code></td>
          <td><code>artisan</code> → <code>handleCommand()</code></td>
        </tr>
        <tr>
          <td><strong>Что обрабатывает</strong></td>
          <td>HTTP-запросы: браузер, API, webhooks</td>
          <td>CLI-команды: <code>migrate</code>, <code>queue:work</code>, cron</td>
        </tr>
        <tr>
          <td><strong>Middleware</strong></td>
          <td>Полный стек (CSRF, session, cors, throttle...)</td>
          <td>Нет (нет HTTP-запроса)</td>
        </tr>
        <tr>
          <td><strong>Регистрация в L11+</strong></td>
          <td><code>withMiddleware()</code> в <code>bootstrap/app.php</code></td>
          <td><code>withCommands()</code>, <code>withSchedule()</code></td>
        </tr>
        <tr>
          <td><strong>Особая фаза</strong></td>
          <td><code>terminate()</code> после отправки ответа клиенту</td>
          <td>Возвращает exit-code для shell</td>
        </tr>
      </tbody>
    </table>

    <div class="remember-box">
      <strong>Общее у обоих:</strong>
      <ol style="margin:6px 0 0 20px;line-height:1.7">
        <li>Запускают bootstrappers (env, config, facades, service providers)</li>
        <li>Регистрируют exception handler</li>
        <li>Отдают управление роутеру / командному диспетчеру</li>
        <li>После обработки — вызывают <code>terminate()</code> для пост-хуков</li>
      </ol>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Этапы цикла</div>
    <div class="card"><h3>1. <code>public/index.php</code> — точка входа</h3><p class="text">Веб-сервер (nginx/Apache/built-in artisan serve) направляет любой URL в <code>public/index.php</code>. Этот файл загружает автозагрузчик Composer и <code>bootstrap/app.php</code>, который создаёт экземпляр <code>Application</code> (наследник IoC-контейнера).</p></div>
    <div class="card"><h3>2. Bootstrap: <code>bootstrap/app.php</code></h3><p class="text">Конфигурируется ядро: список middleware, провайдеров, обработчик исключений, маршруты. В Laravel 11 это стало декларативной API в одном файле (раньше — отдельные классы в <code>app/Http/Kernel.php</code>).</p></div>
    <div class="card"><h3>3. Kernel handle</h3><p class="text"><code>Http\Kernel::handle($request)</code> прогоняет запрос через <code>bootstrappers</code> (загрузка <code>.env</code>, конфига, фасадов, провайдеров) — это происходит <strong>один раз</strong> в начале запроса.</p></div>
    <div class="card"><h3>4. Service Providers: register → boot</h3><p class="text">Все провайдеры сначала проходят <code>register()</code> (только биндинги в контейнер), потом <code>boot()</code> (всё остальное: маршруты, события, фасады, observers). Подробно — в KB_13.</p></div>
    <div class="card"><h3>5. Pipeline: глобальные middleware</h3><p class="text">Запрос идёт через очередь глобальных middleware (TrustProxies, HandleCors, PreventRequestsDuringMaintenance, ValidatePostSize, TrimStrings, ConvertEmptyStringsToNull). Каждый может либо передать запрос дальше, либо вернуть response самостоятельно.</p></div>
    <div class="card"><h3>6. Router: подбор маршрута</h3><p class="text">Router находит маршрут по методу + URL, прогоняет через middleware группы (web/api), затем route-specific middleware. Привязки моделей (route model binding) разрешаются на этом шаге.</p></div>
    <div class="card"><h3>7. Controller / Closure</h3><p class="text">Вызывается обработчик с разрешёнными зависимостями через контейнер. Возвращает <code>Response</code> или то, что фреймворк превратит в Response (массив → JSON, view → HTML, модель → JSON).</p></div>
    <div class="card"><h3>8. Pipeline в обратном порядке + <code>terminate</code></h3><p class="text">Response поднимается обратно по middleware (теперь после <code>$next($request)</code>). После отправки клиенту вызываются <code>terminate</code> у middleware, поддерживающих такую фазу — здесь делается долгая работа (логирование, аналитика), не влияющая на время ответа.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Эволюция <code>public/index.php</code>: Laravel 10 vs 11+</div>
    <p class="text">Точка входа для веб-запросов эволюционировала между версиями. Смысл тот же (запрос → ядро → ответ → клиент), но синтаксис в Laravel 11 стал значительно лаконичнее.</p>

    <div class="card">
      <h3>Laravel 10 и ниже — явное создание ядра</h3>
      <p>Здесь виден полный цикл: получить ядро из контейнера, передать ему запрос, отправить ответ, вызвать <code>terminate()</code>.</p>
<pre><code><span class="c-comment">// public/index.php</span>

<span class="c-var">$kernel</span> = <span class="c-var">$app</span>-&gt;<span class="c-fn">make</span>(<span class="c-type">Illuminate</span>\<span class="c-type">Contracts</span>\<span class="c-type">Http</span>\<span class="c-type">Kernel</span>::<span class="c-key">class</span>);

<span class="c-var">$response</span> = <span class="c-var">$kernel</span>-&gt;<span class="c-fn">handle</span>(
    <span class="c-var">$request</span> = <span class="c-type">Illuminate</span>\<span class="c-type">Http</span>\<span class="c-type">Request</span>::<span class="c-fn">capture</span>()
);

<span class="c-var">$response</span>-&gt;<span class="c-fn">send</span>();

<span class="c-var">$kernel</span>-&gt;<span class="c-fn">terminate</span>(<span class="c-var">$request</span>, <span class="c-var">$response</span>);</code></pre>
    </div>

    <div class="card">
      <h3>Laravel 11+ — цепочка вызовов через <code>handleRequest()</code></h3>
      <p>С Laravel 11 код в <code>index.php</code> стал ещё более лаконичным. Вместо явного создания ядра и вызова <code>handle()</code> используется «цепочка» вызовов, которая заканчивается методом <code>handleRequest()</code>.</p>
<pre><code><span class="c-comment">// public/index.php</span>

(<span class="c-key">require_once</span> <span class="c-fn">__DIR__</span>.<span class="c-str">'/../bootstrap/app.php'</span>)
    -&gt;<span class="c-fn">handleRequest</span>(<span class="c-type">Request</span>::<span class="c-fn">capture</span>());</code></pre>
      <p>Метод <code>handleRequest()</code> внутри <code>Application</code> сам делает то же самое: получает Kernel из контейнера, передаёт запрос, отправляет ответ, вызывает <code>terminate</code>. Просто скрыто под красивую цепочку.</p>
    </div>

    <div class="remember-box">
      В обоих случаях результат один и тот же: запрос передаётся в ядро для дальнейшей обработки, а полученный ответ отправляется клиенту. Разница только в уровне абстракции — Laravel 11 прячет boilerplate внутрь фреймворка.
    </div>

    <p class="text"><strong>Аналогично для <code>artisan</code> (консольные команды):</strong></p>
<pre><code><span class="c-comment">// artisan — Laravel 11+</span>

<span class="c-var">$status</span> = (<span class="c-key">require_once</span> <span class="c-fn">__DIR__</span>.<span class="c-str">'/bootstrap/app.php'</span>)
    -&gt;<span class="c-fn">handleCommand</span>(<span class="c-key">new</span> <span class="c-type">Symfony</span>\<span class="c-type">Component</span>\<span class="c-type">Console</span>\<span class="c-type">Input</span>\<span class="c-type">ArgvInput</span>);

<span class="c-key">exit</span>(<span class="c-var">$status</span>);</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: трассировка запроса</div>
<pre><code><span class="c-comment">// Простой способ увидеть, что происходит — расширить базовый middleware</span>
<span class="c-key">final class</span> <span class="c-type">TraceRequest</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>, <span class="c-type">Closure</span> <span class="c-var">$next</span>): <span class="c-type">Response</span>
    {
        <span class="c-var">$start</span> = <span class="c-fn">microtime</span>(<span class="c-key">true</span>);
        <span class="c-type">Log</span>::<span class="c-fn">debug</span>(<span class="c-str">'request.before'</span>, [<span class="c-str">'url'</span> =&gt; <span class="c-var">$request</span>-&gt;<span class="c-fn">fullUrl</span>()]);

        <span class="c-var">$response</span> = <span class="c-var">$next</span>(<span class="c-var">$request</span>); <span class="c-comment">// уходим в следующий middleware → controller → обратно</span>

        <span class="c-type">Log</span>::<span class="c-fn">debug</span>(<span class="c-str">'request.after'</span>, [
            <span class="c-str">'status'</span>      =&gt; <span class="c-var">$response</span>-&gt;<span class="c-fn">getStatusCode</span>(),
            <span class="c-str">'duration_ms'</span> =&gt; <span class="c-fn">round</span>((<span class="c-fn">microtime</span>(<span class="c-key">true</span>) - <span class="c-var">$start</span>) * <span class="c-num">1000</span>, <span class="c-num">2</span>),
        ]);

        <span class="c-key">return</span> <span class="c-var">$response</span>;
    }

    <span class="c-key">public function</span> <span class="c-fn">terminate</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>, <span class="c-type">Response</span> <span class="c-var">$response</span>): <span class="c-key">void</span>
    {
        <span class="c-comment">// Здесь — после отправки клиенту. Дорогая отправка в аналитику.</span>
        <span class="c-type">Analytics</span>::<span class="c-fn">track</span>(<span class="c-var">$request</span>, <span class="c-var">$response</span>);
    }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Тяжёлая работа в <code>boot()</code> провайдера.</strong> <code>boot()</code> выполняется на каждом запросе. Тяжёлый код (загрузка большого JSON, обращение к API) накапливается. Используйте deferred providers или ленивую инициализацию.</div>
    <div class="pitfall"><strong>2. Глобальный middleware вместо группового.</strong> Если middleware нужен только для web, его регистрация глобально замедлит и API. Используйте middleware groups (<code>web</code>/<code>api</code>).</div>
    <div class="pitfall"><strong>3. <code>terminate</code> без поддержки.</strong> Метод <code>terminate</code> вызывается только если веб-сервер поддерживает <code>fastcgi_finish_request</code> (FPM да; built-in <code>artisan serve</code> — нет). На built-in сервере terminate работает синхронно, удлиняя ответ.</div>
    <div class="pitfall"><strong>4. Подсчёт SQL-запросов в middleware.</strong> Включение <code>DB::enableQueryLog()</code> на проде раздувает память: каждый запрос хранится в массиве до конца запроса.</div>
    <div class="pitfall"><strong>5. <code>config()</code> без <code>config:cache</code>.</strong> Без <code>php artisan config:cache</code> Laravel перечитывает все конфиги с диска на каждом запросе (десятки файлов). На проде <code>config:cache</code> обязателен.</div>
    <div class="pitfall"><strong>6. Логи в <code>storage/logs/laravel.log</code> при больших объёмах.</strong> Один файл, отсутствует ротация по умолчанию — за неделю несколько ГБ. Используйте <code>daily</code> канал или внешний агрегатор.</div>
    <div class="pitfall"><strong>7. Утечка в обработчике exception.</strong> Кастомный <code>Handler::render</code> может вернуть response, но забыть закрыть транзакцию или освободить ресурс. <code>Handler::report</code> и <code>render</code> разделены неспроста: report для логов, render для ответа клиенту.</div>
    <div class="pitfall"><strong>8. Lifecycle в Octane.</strong> Bootstrap-фаза в Octane выполняется один раз на воркер. Состояние, оставленное в singleton'ах между запросами, утечёт. Подробно — в разделе Octane.</div>
  </div>
</div>

<!-- ═════════════════════════════════════════════════════════════════════════
     BOOTSTRAP DEEP — отдельный раздел про providers, app.php, autowiring
     ═════════════════════════════════════════════════════════════════════════ -->
<div id="sec-bootstrap-deep" class="section">
  <div class="section-title">Bootstrap: providers.php &amp; app.php — глубоко</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Важная поправка про Laravel 11+</div>
    <p class="text">Список провайдеров лежит <strong>не</strong> в <code>bootstrap/app.php</code>, а в отдельном файле <code>bootstrap/providers.php</code>. Это просто массив:</p>
    <pre><code><span class="c-comment">// bootstrap/providers.php</span>
<span class="c-key">return</span> [
    <span class="c-type">App</span>\<span class="c-type">Providers</span>\<span class="c-type">AppServiceProvider</span>::<span class="c-key">class</span>,
    <span class="c-type">App</span>\<span class="c-type">Providers</span>\<span class="c-type">HorizonServiceProvider</span>::<span class="c-key">class</span>,
];</code></pre>
    <p class="text">В <code>bootstrap/app.php</code> тоже есть метод <code>withProviders()</code>, но он для особых случаев (например, подгрузить провайдеры из другой директории). Дефолтный путь — <code>providers.php</code>.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="settings"></i> Провайдер — тот, кто объясняет контейнеру, как собрать сервис</div>
    <pre><code><span class="c-comment">// app/Providers/SmsServiceProvider.php</span>
<span class="c-key">class</span> <span class="c-type">SmsServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-key">$this</span>-&gt;<span class="c-var">app</span>-&gt;<span class="c-fn">singleton</span>(<span class="c-type">SmsSender</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-var">$app</span>) {
            <span class="c-key">return</span> <span class="c-key">new</span> <span class="c-type">MobizonSender</span>(
                <span class="c-fn">config</span>(<span class="c-str">'services.mobizon.key'</span>),
                <span class="c-var">$app</span>-&gt;<span class="c-fn">make</span>(<span class="c-type">HttpClient</span>::<span class="c-key">class</span>),
            );
        });
    }
}</code></pre>
    <p class="text">Тут нет логики. Ни одной SMS не отправлено. Это <strong>инструкция</strong>: «когда кто-то попросит <code>SmsSender</code> — вот рецепт, как его собрать».</p>

    <div class="subsection-title" style="margin-top:14px"><i data-lucide="help-circle"></i> Зачем эта прослойка вообще нужна</div>
    <p class="text">Смотри на конструктор <code>MobizonSender</code>. Ему нужен <code>string $apiKey</code>. Контейнер про строки ничего не знает — он не может угадать, какую строку туда подставить. <strong>Автоматика ломается.</strong></p>
    <p class="text">Плюс <code>SmsSender</code> — <strong>интерфейс</strong>. Его вообще нельзя инстанцировать, <code>new SmsSender()</code> невозможен.</p>
    <p class="text">Поэтому и нужен провайдер: он закрывает оба этих пробела.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-right-circle"></i> Что происходит в коде дальше</div>
    <pre><code><span class="c-key">class</span> <span class="c-type">OrderController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private</span> <span class="c-type">SmsSender</span> <span class="c-var">$sms</span>) {}   <span class="c-comment">// просит интерфейс</span>

    <span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>)
    {
        <span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">create</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());
        <span class="c-key">$this</span>-&gt;<span class="c-var">sms</span>-&gt;<span class="c-fn">send</span>(<span class="c-var">$order</span>-&gt;<span class="c-var">phone</span>, <span class="c-str">"Заказ №{$order-&gt;id} принят"</span>);
    }
}</code></pre>
    <p class="text">Контроллер просит <code>SmsSender</code>. Контейнер лезет в свой реестр, находит запись, которую положил туда провайдер, выполняет замыкание, отдаёт готовый <code>MobizonSender</code>.</p>
    <div class="tip">
      Представь: при старте приложения нужно выполнить, скажем, 200 подготовительных действий. Свалить их в один файл — каша. Поэтому Laravel говорит: разложи по классам, каждый класс = один блок подготовки, и дай мне список этих классов.
    </div>
    <p class="text">Если провайдер не зарегистрирован в <code>bootstrap/providers.php</code> — его <code>register()</code> никогда не выполнится, в реестре пусто, и ты получишь:</p>
    <pre><code><span class="c-comment">Target [App\Contracts\SmsSender] is not instantiable.</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="minus-circle"></i> Когда провайдер вообще НЕ нужен</div>
    <pre><code><span class="c-comment">// app/Services/OrderService.php</span>
<span class="c-key">class</span> <span class="c-type">OrderService</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private</span> <span class="c-type">OrderRepository</span> <span class="c-var">$repo</span>,     <span class="c-comment">// конкретный класс</span>
        <span class="c-key">private</span> <span class="c-type">SmsSender</span> <span class="c-var">$sms</span>,             <span class="c-comment">// интерфейс, но он уже забинден выше</span>
    ) {}

    <span class="c-key">public function</span> <span class="c-fn">complete</span>(<span class="c-type">Order</span> <span class="c-var">$order</span>): <span class="c-key">void</span>
    {
        <span class="c-key">$this</span>-&gt;<span class="c-var">repo</span>-&gt;<span class="c-fn">markCompleted</span>(<span class="c-var">$order</span>);
        <span class="c-key">$this</span>-&gt;<span class="c-var">sms</span>-&gt;<span class="c-fn">send</span>(<span class="c-var">$order</span>-&gt;<span class="c-var">phone</span>, <span class="c-str">'Заказ выполнен'</span>);
    }
}</code></pre>
    <p class="text">Это тоже сервис. Но <strong>регистрировать его нигде не надо</strong> — контейнер соберёт его сам: <code>OrderRepository</code> это конкретный класс (autowiring справится), <code>SmsSender</code> уже описан провайдером.</p>
    <p class="text">Просто пишешь в контроллере <code>public function __construct(private OrderService $service)</code> — и всё работает. Ноль конфигурации.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Финальный контраст: Сервис vs Провайдер</div>
    <table class="data-table">
      <thead><tr><th></th><th>Сервис</th><th>Провайдер</th></tr></thead>
      <tbody>
        <tr><td><strong>Что делает</strong></td><td>Бизнес-логику</td><td>Настраивает контейнер</td></tr>
        <tr><td><strong>Когда выполняется</strong></td><td>Когда ты его вызвал</td><td>Один раз при старте приложения, всегда</td></tr>
        <tr><td><strong>Сколько раз в проекте</strong></td><td>Десятки-сотни классов</td><td>Обычно 1-5</td></tr>
        <tr><td><strong>Где лежит</strong></td><td><code>app/Services</code>, <code>app/Actions</code>, где угодно</td><td><code>app/Providers</code></td></tr>
        <tr><td><strong>Регистрация</strong></td><td>Не нужна (autowiring)</td><td>Обязательна, в <code>bootstrap/providers.php</code></td></tr>
        <tr><td><strong>Нужен, если...</strong></td><td>Есть логика, которую надо где-то держать</td><td>Контейнер сам не догадается, как собрать объект</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Что вообще НЕ надо нигде регистрировать</div>
    <p class="text">Большая часть классов подключается сама, и это главное, что стоит понять:</p>
    <table class="data-table">
      <thead><tr><th>Что</th><th>Как находится</th></tr></thead>
      <tbody>
        <tr><td>Контроллеры</td><td>По имени в роуте + autowiring контейнера</td></tr>
        <tr><td>Модели Eloquent</td><td>Просто <code>new User</code> / через контейнер</td></tr>
        <tr><td>Middleware-классы</td><td>Указываешь в роуте или в <code>withMiddleware()</code></td></tr>
        <tr><td>Jobs, Events, Listeners, Notifications</td><td>Автодискавери по неймспейсу</td></tr>
        <tr><td>Form Requests</td><td>Type-hint в методе контроллера</td></tr>
        <tr><td>Console-команды</td><td>Автосканирование <code>app/Console/Commands</code></td></tr>
        <tr><td>Миграции, сидеры, фабрики</td><td>По конвенции путей</td></tr>
        <tr><td>Policies</td><td>Автодискавери по имени (<code>Post</code> → <code>PostPolicy</code>)</td></tr>
      </tbody>
    </table>
    <p class="text">Работает это на конвенциях + Composer autoload (PSR-4). Composer знает, что <code>App\</code> → <code>app/</code>, поэтому <code>App\Services\OrderService</code> находится по пути <code>app/Services/OrderService.php</code> без единой строчки конфига.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="key"></i> Почему тогда провайдеры — исключение</div>
    <p class="text">Ключевая разница: у всех перечисленных выше классов есть <strong>триггер</strong>, по которому Laravel понимает, когда их создавать. Роут пришёл → создай контроллер. Событие вылетело → найди слушателя.</p>
    <p class="text">У провайдера триггера нет. Провайдер — это код, который должен выполниться <strong>безусловно</strong>, на каждом старте приложения, до всего остального. Laravel не может «догадаться», что тебе нужно зарегистрировать биндинг — он должен получить явный список: вот эти классы прогони через <code>register()</code>, потом через <code>boot()</code>.</p>
    <p class="text">Плюс <strong>порядок важен</strong>: <code>register()</code> у всех провайдеров вызывается раньше, чем <code>boot()</code> у любого из них — именно поэтому в <code>register()</code> нельзя дёргать чужие сервисы. Автодискавери такой порядок не гарантирует.</p>
    <div class="tip">
      <strong>Побочный бонус</strong> явного списка: провайдер можно закомментировать одной строкой и вырубить целый блок функциональности.
    </div>
    <p class="text"><strong>Пакеты из vendor</strong> свои провайдеры регистрируют сами — через <code>extra.laravel.providers</code> в своём <code>composer.json</code> (package auto-discovery). Поэтому после <code>composer require</code> обычно ничего руками прописывать не надо.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="settings-2"></i> Что реально настраивается в <code>bootstrap/app.php</code></div>
    <p class="text">Полная картина методов:</p>
    <pre><code><span class="c-key">return</span> <span class="c-type">Application</span>::<span class="c-fn">configure</span>(<span class="c-var">basePath</span>: <span class="c-fn">dirname</span>(<span class="c-fn">__DIR__</span>))
    -&gt;<span class="c-fn">withRouting</span>(...)
    -&gt;<span class="c-fn">withMiddleware</span>(...)
    -&gt;<span class="c-fn">withExceptions</span>(...)
    -&gt;<span class="c-fn">withCommands</span>(...)
    -&gt;<span class="c-fn">withSchedule</span>(...)
    -&gt;<span class="c-fn">withEvents</span>(...)
    -&gt;<span class="c-fn">withBindings</span>(...)
    -&gt;<span class="c-fn">withSingletons</span>(...)
    -&gt;<span class="c-fn">withProviders</span>(...)
    -&gt;<span class="c-fn">create</span>();</code></pre>
    <p class="text">Основные, которые реально трогают в проектах:</p>

    <div class="card">
      <h3>1. <code>withRouting()</code> — точки входа</h3>
      <pre><code>-&gt;<span class="c-fn">withRouting</span>(
    <span class="c-var">web</span>:      <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/web.php'</span>,
    <span class="c-var">api</span>:      <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/api.php'</span>,
    <span class="c-var">commands</span>: <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/console.php'</span>,
    <span class="c-var">health</span>:   <span class="c-str">'/up'</span>,                    <span class="c-comment">// готовый эндпоинт для healthcheck</span>
    <span class="c-var">apiPrefix</span>: <span class="c-str">'api/v1'</span>,
    <span class="c-var">then</span>: <span class="c-key">function</span> () {               <span class="c-comment">// свои файлы роутов</span>
        <span class="c-type">Route</span>::<span class="c-fn">middleware</span>(<span class="c-str">'web'</span>)
            -&gt;<span class="c-fn">prefix</span>(<span class="c-str">'admin'</span>)
            -&gt;<span class="c-fn">group</span>(<span class="c-fn">base_path</span>(<span class="c-str">'routes/admin.php'</span>));
    },
)</code></pre>
    </div>

    <div class="card">
      <h3>2. <code>withMiddleware()</code> — глобальный конвейер запроса</h3>
      <pre><code>-&gt;<span class="c-fn">withMiddleware</span>(<span class="c-key">function</span> (<span class="c-type">Middleware</span> <span class="c-var">$middleware</span>) {
    <span class="c-var">$middleware</span>-&gt;<span class="c-fn">append</span>(<span class="c-type">SetLocale</span>::<span class="c-key">class</span>);              <span class="c-comment">// в конец глобального стека</span>
    <span class="c-var">$middleware</span>-&gt;<span class="c-fn">prepend</span>(<span class="c-type">TrustProxies</span>::<span class="c-key">class</span>);          <span class="c-comment">// в начало</span>
    <span class="c-var">$middleware</span>-&gt;<span class="c-fn">web</span>(<span class="c-var">append</span>: [<span class="c-type">EnsureProfileComplete</span>::<span class="c-key">class</span>]);  <span class="c-comment">// в группу web</span>
    <span class="c-var">$middleware</span>-&gt;<span class="c-fn">api</span>(<span class="c-var">prepend</span>: [<span class="c-type">ForceJsonResponse</span>::<span class="c-key">class</span>]);
    <span class="c-var">$middleware</span>-&gt;<span class="c-fn">alias</span>([<span class="c-str">'admin'</span> =&gt; <span class="c-type">AdminOnly</span>::<span class="c-key">class</span>]);  <span class="c-comment">// короткое имя для роутов</span>
    <span class="c-var">$middleware</span>-&gt;<span class="c-fn">remove</span>(<span class="c-type">ValidateCsrfToken</span>::<span class="c-key">class</span>);      <span class="c-comment">// выкинуть дефолтный</span>
    <span class="c-var">$middleware</span>-&gt;<span class="c-fn">throttleApi</span>(<span class="c-str">'60,1'</span>);
    <span class="c-var">$middleware</span>-&gt;<span class="c-fn">trustProxies</span>(<span class="c-var">at</span>: <span class="c-str">'*'</span>);
    <span class="c-var">$middleware</span>-&gt;<span class="c-fn">validateCsrfTokens</span>(<span class="c-var">except</span>: [<span class="c-str">'webhooks/*'</span>]);
})</code></pre>
    </div>

    <div class="card">
      <h3>3. <code>withExceptions()</code> — что делать с ошибками</h3>
      <pre><code>-&gt;<span class="c-fn">withExceptions</span>(<span class="c-key">function</span> (<span class="c-type">Exceptions</span> <span class="c-var">$exceptions</span>) {
    <span class="c-var">$exceptions</span>-&gt;<span class="c-fn">dontReport</span>(<span class="c-type">BusinessRuleException</span>::<span class="c-key">class</span>);

    <span class="c-var">$exceptions</span>-&gt;<span class="c-fn">render</span>(<span class="c-key">function</span> (<span class="c-type">ModelNotFoundException</span> <span class="c-var">$e</span>, <span class="c-type">Request</span> <span class="c-var">$request</span>) {
        <span class="c-key">if</span> (<span class="c-var">$request</span>-&gt;<span class="c-fn">expectsJson</span>()) {
            <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>([<span class="c-str">'message'</span> =&gt; <span class="c-str">'Не найдено'</span>], <span class="c-num">404</span>);
        }
    });

    <span class="c-var">$exceptions</span>-&gt;<span class="c-fn">report</span>(<span class="c-key">function</span> (<span class="c-type">PaymentFailed</span> <span class="c-var">$e</span>) {
        <span class="c-type">Sentry</span>::<span class="c-fn">captureException</span>(<span class="c-var">$e</span>);
    });

    <span class="c-var">$exceptions</span>-&gt;<span class="c-fn">context</span>(<span class="c-key">fn</span> () =&gt; [<span class="c-str">'tenant_id'</span> =&gt; <span class="c-fn">tenant</span>()?-&gt;<span class="c-var">id</span>]);
})</code></pre>
    </div>

    <div class="card">
      <h3>4. <code>withSchedule()</code> — крон-задачи</h3>
      <pre><code>-&gt;<span class="c-fn">withSchedule</span>(<span class="c-key">function</span> (<span class="c-type">Schedule</span> <span class="c-var">$schedule</span>) {
    <span class="c-var">$schedule</span>-&gt;<span class="c-fn">command</span>(<span class="c-str">'reports:daily'</span>)-&gt;<span class="c-fn">dailyAt</span>(<span class="c-str">'03:00'</span>);
})</code></pre>
      <p class="text">Хотя чаще их пишут в <code>routes/console.php</code>.</p>
    </div>

    <div class="card">
      <h3>5. <code>withBindings()</code> / <code>withSingletons()</code> — быстрые биндинги без провайдера</h3>
      <pre><code>-&gt;<span class="c-fn">withSingletons</span>([
    <span class="c-type">PaymentGateway</span>::<span class="c-key">class</span> =&gt; <span class="c-type">StripeGateway</span>::<span class="c-key">class</span>,
])</code></pre>
      <p class="text">Удобно для мелочи, но для чего-то серьёзного всё равно лучше провайдер — там есть <code>boot()</code> и логика группируется по смыслу.</p>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map"></i> Итоговая карта: куда что класть</div>
    <table class="data-table">
      <thead><tr><th>Место</th><th>Что там</th></tr></thead>
      <tbody>
        <tr><td><code>bootstrap/app.php</code></td><td>Конфигурация ядра: middleware, роуты, обработка исключений</td></tr>
        <tr><td><code>bootstrap/providers.php</code></td><td>Список провайдеров</td></tr>
        <tr><td><code>config/*.php</code></td><td>Значения: параметры БД, кеша, почты, сторонних сервисов</td></tr>
        <tr><td><code>.env</code></td><td>Секреты и то, что различается между dev/prod</td></tr>
        <tr><td><code>routes/*.php</code></td><td>Маршруты</td></tr>
        <tr><td>Всё остальное в <code>app/</code></td><td>Само подхватывается по PSR-4 и конвенциям</td></tr>
      </tbody>
    </table>
    <div class="remember-box">
      <strong>Мнемоника (обычно заходит на собесе):</strong> <code>bootstrap/</code> отвечает на вопрос «<em>как собрать</em> приложение», <code>config/</code> — «<em>с какими параметрами</em> оно работает».
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="split"></i> Где чьё место: Middleware vs Service Provider</div>
    <p class="text">Обе сущности «подключаются к жизненному циклу», но решают разные задачи. Важно не путать: провайдер — про <em>подготовку приложения</em>, middleware — про <em>обработку конкретного запроса</em>.</p>
    <table class="data-table">
      <thead><tr><th>Сущность</th><th>Когда выполняется</th><th>Что делает</th><th>Пример</th></tr></thead>
      <tbody>
        <tr>
          <td><strong>Middleware</strong></td>
          <td>На <strong>каждый HTTP-запрос</strong> — в цепочке до и после контроллера</td>
          <td>Обрабатывает входящий запрос и исходящий ответ (модифицирует, проверяет, логирует)</td>
          <td>Проверка CSRF, CORS, сжатие ответа (gzip), логирование времени, throttle rate limit</td>
        </tr>
        <tr>
          <td><strong>Service Provider</strong></td>
          <td>Один раз при старте приложения (<code>register()</code> + <code>boot()</code> для каждого запроса, но <em>до</em> роутинга)</td>
          <td>Регистрирует сервисы в контейнере, загружает маршруты, события, observers, конфиги, Blade-директивы, макросы</td>
          <td><code>EventServiceProvider</code>, <code>RouteServiceProvider</code>, кастомный провайдер для платёжного шлюза</td>
        </tr>
      </tbody>
    </table>
    <div class="tip">
      <strong>Быстрый тест:</strong> нужно ли что-то делать <em>только для этого запроса</em>? — Middleware. Нужно ли <em>настроить приложение</em> так, чтобы потом все запросы работали правильно? — Provider.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="order-lower-first"></i> Service Providers: <code>register()</code> и <code>boot()</code> подробно</div>
    <p class="text">В Laravel каждый провайдер имеет два ключевых метода, которые вызываются в <strong>строгом порядке</strong>.</p>

    <div class="card">
      <h3><code>register()</code> — только привязки в контейнер</h3>
      <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
        <li>Здесь <strong>запрещено</strong> использовать какие-либо другие сервисы (БД, кеш, конфиги, роутинг) — они ещё не загружены.</li>
        <li>Единственное, что можно — это <code>$this-&gt;app-&gt;bind(...)</code> или <code>$this-&gt;app-&gt;singleton(...)</code>.</li>
        <li>Выполняется <strong>для всех провайдеров</strong> (в порядке их перечисления) <em>прежде чем</em> у какого-либо провайдера вызовется <code>boot()</code>.</li>
      </ul>
    </div>

    <div class="card">
      <h3><code>boot()</code> — всё остальное</h3>
      <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
        <li>Здесь уже <strong>зарегистрированы все провайдеры</strong>, поэтому можно использовать любые сервисы.</li>
        <li>Маршруты, события, Blade-директивы, observers, валидационные правила, макросы для Collection / Query Builder, gate policies.</li>
        <li>Выполняется <strong>после того</strong>, как у всех провайдеров отработал <code>register()</code>.</li>
      </ul>
    </div>

    <p class="text"><strong>Почему порядок именно такой — пример:</strong></p>
<pre><code><span class="c-comment">// Provider A</span>
<span class="c-key">class</span> <span class="c-type">LoggerServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">register</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// Биндим интерфейс к реализации</span>
        <span class="c-var">$this</span>-&gt;<span class="c-var">app</span>-&gt;<span class="c-fn">bind</span>(<span class="c-type">LoggerInterface</span>::<span class="c-key">class</span>, <span class="c-type">FileLogger</span>::<span class="c-key">class</span>);
    }
}

<span class="c-comment">// Provider B</span>
<span class="c-key">class</span> <span class="c-type">AuditServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">boot</span>(<span class="c-type">LoggerInterface</span> <span class="c-var">$logger</span>): <span class="c-key">void</span>
    {
        <span class="c-comment">// Пытаемся использовать LoggerInterface, забинденный в Provider A.
        // Работает, ПОТОМУ ЧТО:
        //   1. У ВСЕХ провайдеров сначала выполнился register()
        //   2. Только потом Laravel начал вызывать boot()
        // Если бы порядок был другой (register+boot по одному провайдеру),
        // Provider B мог бы попытаться использовать LoggerInterface
        // раньше чем Provider A его забиндил → ошибка.</span>
        <span class="c-var">$logger</span>-&gt;<span class="c-fn">info</span>(<span class="c-str">'Audit provider booted'</span>);
    }
}</code></pre>

    <div class="remember-box">
      <strong>Ключевое правило:</strong> «<em>сначала весь register(), потом весь boot()</em>» — гарантирует что к моменту <code>boot()</code> любого провайдера все биндинги от других провайдеров уже доступны. Никогда не обращайтесь к другим сервисам из <code>register()</code>.
    </div>

    <div class="pitfall">
      <strong>⚠ Типичная ошибка:</strong> вызвать <code>Route::get(...)</code> или <code>DB::table(...)</code> в <code>register()</code>. Роутер и БД ещё не зарегистрированы → <code>BindingResolutionException</code> или тихая поломка. Всё что использует другие сервисы — только в <code>boot()</code>.
    </div>
  </div>
</div>

<div id="sec-routing" class="section">
  <div class="section-title">Routing</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Router связывает входящий URL с обработчиком. На простом уровне — это таблица «URL → callable». На продвинутом — механизм с route model binding, scoped bindings, route caching, проверкой подписей, привязкой по типам и сложной системой middleware groups. Понимание этих возможностей даёт компактный читаемый routing и предсказуемое поведение под нагрузкой.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Возможности роутера</div>
    <div class="card"><h3>Route model binding (implicit)</h3><p class="text"><code>Route::get('/users/{user}', fn (User $user) =&gt; ...)</code> — Laravel автоматически делает <code>User::find($id)</code> и кидает 404 если нет. По умолчанию ищет по PK; для другого ключа — <code>$user:slug</code> или <code>getRouteKeyName()</code> на модели.</p></div>
    <div class="card"><h3>Explicit binding</h3><p class="text">В <code>RouteServiceProvider::boot</code>: <code>Route::bind('user', fn ($value) =&gt; User::where(...)-&gt;firstOrFail())</code> — кастомная логика разрешения. Полезно для мультитенантности, scope'ов.</p></div>
    <div class="card"><h3>Scoped bindings</h3><p class="text"><code>Route::get('/users/{user}/posts/{post:slug}', ...)-&gt;scopeBindings()</code> — <code>Post</code> ищется в <em>контексте</em> <code>User</code> (через relation). Гарантирует, что <code>/users/1/posts/foo</code> не вернёт пост, принадлежащий другому пользователю.</p></div>
    <div class="card"><h3>Middleware на маршруте/группе</h3><p class="text">Маршрут получает middleware из своей группы (web/api), плюс заявленные через <code>-&gt;middleware('auth')</code>. Порядок: глобальные → групповые → маршрутные. Параметры middleware: <code>auth:sanctum</code>, <code>throttle:60,1</code>.</p></div>
    <div class="card"><h3>Route caching</h3><p class="text"><code>php artisan route:cache</code> компилирует все маршруты в единый PHP-файл — кратно ускоряет startup. Не работает с closure-маршрутами (только контроллеры/инвокабельные классы).</p></div>
    <div class="card"><h3>Signed routes</h3><p class="text"><code>URL::signedRoute('verify', ['user' =&gt; $id])</code> — URL с подписью, защищающей от подмены параметров. Используется для подтверждения email, magic-link login и пр. Middleware <code>signed</code> проверяет.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: scoped bindings vs ручная проверка</div>
<pre><code><span class="c-comment">// ❌ Уязвимо: пользователь может прочитать чужой пост, подменив slug</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/users/{user}/posts/{post:slug}'</span>, <span class="c-key">function</span> (<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-type">Post</span> <span class="c-var">$post</span>) {
    <span class="c-comment">// $post найдётся по любому slug, не обязательно у $user</span>
    <span class="c-key">return</span> <span class="c-var">$post</span>;
});

<span class="c-comment">// ✓ Безопасно: scoped binding ищет post через $user-&gt;posts()</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/users/{user}/posts/{post:slug}'</span>, <span class="c-key">function</span> (<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-type">Post</span> <span class="c-var">$post</span>) {
    <span class="c-key">return</span> <span class="c-var">$post</span>;
})-&gt;<span class="c-fn">scopeBindings</span>();
<span class="c-comment">// Если post.slug существует, но не принадлежит $user — 404 автоматически</span>
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-marked"></i> Route Binding + виды обработчиков — детально</div>

    <div class="card">
      <h3>Implicit Binding (неявная привязка)</h3>
      <p>Laravel сам догадывается, как найти модель по ID в URL. Указываешь в параметре роута имя переменной, совпадающее с именем модели, и Laravel делает <code>Model::find($id)</code>. Если не находит — автоматически 404.</p>
<pre><code><span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/users/{user}'</span>, <span class="c-key">function</span> (<span class="c-type">User</span> <span class="c-var">$user</span>) {
    <span class="c-key">return</span> <span class="c-var">$user</span>;   <span class="c-comment">// Laravel сам вызывает User::find($user)</span>
});</code></pre>
      <p>По умолчанию ищет по <strong>первичному ключу</strong> (<code>id</code>). Чтобы искать по другому полю (например, <code>slug</code>) — либо в модели определить <code>getRouteKeyName()</code>, либо передать в параметре <code>{user:slug}</code>.</p>
<pre><code><span class="c-comment">// Способ 1: параметр в URL</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/users/{user:slug}'</span>, <span class="c-key">fn</span> (<span class="c-type">User</span> <span class="c-var">$user</span>) =&gt; <span class="c-var">$user</span>);

<span class="c-comment">// Способ 2: на уровне модели — глобально</span>
<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">getRouteKeyName</span>(): <span class="c-key">string</span>
    {
        <span class="c-key">return</span> <span class="c-str">'slug'</span>;
    }
}</code></pre>
    </div>

    <div class="card">
      <h3>Explicit Binding (явная привязка)</h3>
      <p>Ты сам говоришь, как именно доставать модель. Нужно, если логика сложнее чем просто <code>find()</code>: мультитенантность, скоуп по владельцу, дополнительные условия.</p>
<pre><code><span class="c-comment">// В RouteServiceProvider::boot() или bootstrap/app.php (L11)</span>
<span class="c-type">Route</span>::<span class="c-fn">bind</span>(<span class="c-str">'user'</span>, <span class="c-key">function</span> (<span class="c-var">$value</span>) {
    <span class="c-key">return</span> <span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'tenant_id'</span>, <span class="c-fn">auth</span>()-&gt;<span class="c-fn">id</span>())
               -&gt;<span class="c-fn">where</span>(<span class="c-str">'id'</span>, <span class="c-var">$value</span>)
               -&gt;<span class="c-fn">firstOrFail</span>();
});

<span class="c-comment">// Теперь при каждом /users/{user} — используется твоя логика</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/users/{user}'</span>, <span class="c-key">fn</span> (<span class="c-type">User</span> <span class="c-var">$user</span>) =&gt; <span class="c-var">$user</span>);
<span class="c-comment">// Юзер чужого tenant → 404</span></code></pre>
    </div>

    <div class="card">
      <h3>Scoped Bindings (привязка с контекстом)</h3>
      <p>Частный случай implicit binding, но с <strong>дополнительным условием</strong>: модель ищется в рамках отношения с другой моделью. Пример: у пользователя есть посты. URL <code>/users/{user}/posts/{post}</code>. Без scoped binding Laravel найдёт пост по slug <em>глобально</em>, даже если он не принадлежит этому пользователю.</p>
<pre><code><span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/users/{user}/posts/{post:slug}'</span>, <span class="c-key">function</span> (<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-type">Post</span> <span class="c-var">$post</span>) {
    <span class="c-key">return</span> <span class="c-var">$post</span>;
})-&gt;<span class="c-fn">scopeBindings</span>();
<span class="c-comment">// С scopeBindings() Laravel строит запрос через отношение $user-&gt;posts():
// Post::where('user_id', $user-&gt;id)-&gt;where('slug', $post)-&gt;firstOrFail()
// Если поста с таким slug у данного пользователя нет — 404</span></code></pre>
    </div>

    <div class="card">
      <h3>Closure Routes (замыкание вместо контроллера)</h3>
      <p>Closure — анонимная функция, которая прямо в роуте обрабатывает запрос. Удобно для быстрых тестов, health-check эндпоинтов, роутов на 1 строчку.</p>
<pre><code><span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/hello'</span>, <span class="c-key">function</span> () {
    <span class="c-key">return</span> <span class="c-str">'Hello, world!'</span>;
});</code></pre>
      <div class="pitfall">
        <strong>⚠ Не кешируются</strong> командой <code>php artisan route:cache</code> — closure нельзя сериализовать. В production их лучше избегать или заменять на контроллеры/invokable-классы.
      </div>
    </div>

    <div class="card">
      <h3>Invokable Classes (инвокабельные классы)</h3>
      <p>Классы с единственным методом <code>__invoke()</code>. Используются как обработчики роута вместо контроллеров с несколькими методами. Выглядит чище для простых действий (Single Action Controllers).</p>
<pre><code><span class="c-comment">// app/Http/Controllers/ShowProfile.php</span>
<span class="c-key">class</span> <span class="c-type">ShowProfile</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__invoke</span>(<span class="c-var">$id</span>)
    {
        <span class="c-key">return</span> <span class="c-fn">view</span>(<span class="c-str">'profile'</span>, [<span class="c-str">'user'</span> =&gt; <span class="c-type">User</span>::<span class="c-fn">findOrFail</span>(<span class="c-var">$id</span>)]);
    }
}

<span class="c-comment">// routes/web.php</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/profile/{id}'</span>, <span class="c-type">ShowProfile</span>::<span class="c-key">class</span>);
<span class="c-comment">// Laravel сам создаст экземпляр и вызовет __invoke()
// ✓ Кешируется при route:cache (не содержит closure)</span></code></pre>
    </div>

    <div class="card">
      <h3>Signed Routes (подписанные маршруты)</h3>
      <p>URL с добавленной криптографической подписью (хеш) — защищает параметры от подмены. Используются для подтверждения email, ссылок для сброса пароля, magic login.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Support</span>\<span class="c-type">Facades</span>\<span class="c-type">URL</span>;

<span class="c-comment">// Создаёшь подписанный URL</span>
<span class="c-var">$url</span> = <span class="c-type">URL</span>::<span class="c-fn">signedRoute</span>(<span class="c-str">'verify'</span>, [<span class="c-str">'user'</span> =&gt; <span class="c-num">1</span>]);
<span class="c-comment">// https://yourapp.com/verify?user=1&signature=abc123...</span>

<span class="c-comment">// Временный (с истечением) — предпочтительно для magic-link</span>
<span class="c-var">$url</span> = <span class="c-type">URL</span>::<span class="c-fn">temporarySignedRoute</span>(<span class="c-str">'verify'</span>, <span class="c-fn">now</span>()-&gt;<span class="c-fn">addMinutes</span>(<span class="c-num">15</span>), [<span class="c-str">'user'</span> =&gt; <span class="c-num">1</span>]);

<span class="c-comment">// В роуте применяешь middleware signed</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/verify'</span>, <span class="c-key">function</span> (<span class="c-type">Request</span> <span class="c-var">$request</span>) {
    <span class="c-comment">// Подпись валидна, параметры не подменены</span>
})-&gt;<span class="c-fn">name</span>(<span class="c-str">'verify'</span>)-&gt;<span class="c-fn">middleware</span>(<span class="c-str">'signed'</span>);
<span class="c-comment">// Если кто-то изменит user=1 на user=2 — подпись невалидна, middleware вернёт 403</span></code></pre>
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="table"></i> Итоговая таблица — коротко о каждом термине</div>
    <table class="data-table">
      <thead><tr><th>Термин</th><th>Суть</th></tr></thead>
      <tbody>
        <tr><td><strong>Implicit binding</strong></td><td>Автоматический поиск модели по ID из URL. Laravel сам делает <code>Model::find()</code> и кидает 404 если нет.</td></tr>
        <tr><td><strong>Explicit binding</strong></td><td>Твоя кастомная логика поиска модели, регистрируется через <code>Route::bind()</code> в провайдере или <code>bootstrap/app.php</code>.</td></tr>
        <tr><td><strong>Scoped binding</strong></td><td>Implicit binding + дополнительное условие через отношение — чтобы нельзя было достать чужую запись. Активируется <code>-&gt;scopeBindings()</code>.</td></tr>
        <tr><td><strong>Closure route</strong></td><td>Роут с обработчиком в виде анонимной функции. Просто, но не кешируется <code>route:cache</code>.</td></tr>
        <tr><td><strong>Invokable class</strong></td><td>Класс с методом <code>__invoke()</code> — альтернатива контроллеру с одним действием. Кешируется.</td></tr>
        <tr><td><strong>Signed route</strong></td><td>URL с криптоподписью, защищает параметры от подмены. Проверяется middleware <code>signed</code>.</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Closure-маршруты ломают <code>route:cache</code>.</strong> На проде с кешем закрытий routing не закешируется. Используйте контроллеры или invokable классы.</div>
    <div class="pitfall"><strong>2. Конфликт маршрутов.</strong> <code>/users/{user}</code> и <code>/users/me</code> — первый поймает <code>me</code> как параметр. Объявляйте конкретные маршруты <strong>раньше</strong> параметризованных.</div>
    <div class="pitfall"><strong>3. Implicit binding без <code>findOrFail</code>.</strong> Если параметр маршрута не существует, Laravel вернёт 404 автоматически. Но если в кастомной логике написать <code>where(...)-&gt;first()</code> — может вернуть null. Используйте <code>firstOrFail</code>.</div>
    <div class="pitfall"><strong>4. Подписанные ссылки без таймаута.</strong> <code>signedRoute</code> без <code>temporarySignedRoute</code> валиден вечно. Для magic-link нужен короткий expiry (15 минут).</div>
    <div class="pitfall"><strong>5. Throttle без identifier.</strong> <code>throttle:60,1</code> без указания ключа ограничивает по IP. За NAT пользователь может «съесть» лимит для всех. Используйте throttle на user_id для аутентифицированных.</div>
    <div class="pitfall"><strong>6. Группа maintenance в route файле.</strong> Если включить <code>php artisan down</code>, доступ к маршрутам блокируется. Исключения — через <code>--secret</code> и middleware <code>preventDuringMaintenance</code>.</div>
    <div class="pitfall"><strong>7. Cross-route data leakage.</strong> Использование <code>request()-&gt;input(...)</code> вместо параметров маршрута: значение тянется из тела, query или route — приоритет неочевиден. Явно типизируйте через FormRequest.</div>
    <div class="pitfall"><strong>8. <code>fallback</code> ловит всё.</strong> <code>Route::fallback(...)</code> срабатывает на любой не-matched URL. Если в нём опечатка в check'е — пользователь может попасть на код, не предназначенный для публичного доступа.</div>
  </div>
</div>

<div id="sec-controllers" class="section">
  <div class="section-title">Controllers</div>

  <div class="subsection" id="ctrl-overview">
    <div class="subsection-title"><i data-lucide="book-open"></i> Обзор + структура папки</div>
    <p class="text">Контроллер — класс, который группирует связанные обработчики HTTP-запросов. По конвенции живёт в <code>app/Http/Controllers/</code>. Роутер вызывает нужный метод контроллера, передавая туда <code>Request</code> и параметры маршрута.</p>

    <p class="text"><strong>Типичная структура:</strong></p>
<pre><code>app/Http/Controllers/
├── Controller.php                  <span class="c-comment"># базовый — от него наследуются все</span>
├── HomeController.php              <span class="c-comment"># для веба</span>
├── PostController.php              <span class="c-comment"># resource controller</span>
├── Auth/
│   ├── LoginController.php
│   └── RegisterController.php
├── Api/
│   ├── V1/
│   │   ├── PostController.php      <span class="c-comment"># API resource</span>
│   │   └── UserController.php
│   └── V2/...
└── Admin/
    └── DashboardController.php</code></pre>

    <p class="text"><strong>Создание через artisan:</strong></p>
<pre><code>php artisan make:controller <span class="c-type">PostController</span>                    <span class="c-comment"># пустой</span>
php artisan make:controller <span class="c-type">PostController</span> --resource         <span class="c-comment"># 7 методов CRUD</span>
php artisan make:controller <span class="c-type">PostController</span> --api              <span class="c-comment"># 5 методов (без create/edit)</span>
php artisan make:controller <span class="c-type">PostController</span> --resource --model=<span class="c-type">Post</span>   <span class="c-comment"># + type-hints модели</span>
php artisan make:controller <span class="c-type">ShowProfile</span> --invokable            <span class="c-comment"># один __invoke</span>
php artisan make:controller <span class="c-type">Api/V1/PostController</span>              <span class="c-comment"># в подпапку</span></code></pre>

    <div class="remember-box">
      Разбивайте контроллеры по <strong>ресурсу</strong> (<code>PostController</code>, <code>UserController</code>), а не по «функциям». Один контроллер = одна сущность / одна тема. Веб и API — обычно отдельно (<code>Api/V1/</code>).
    </div>
  </div>

  <div class="subsection" id="ctrl-thin-fat">
    <div class="subsection-title"><i data-lucide="feather"></i> Тонкий vs толстый контроллер</div>
    <p class="text">Ключевой архитектурный принцип: <strong>контроллер должен быть тонким</strong>. Его задача — <em>принять запрос, делегировать работу, вернуть ответ</em>. Всю бизнес-логику вынести в отдельные классы (Actions / Services).</p>

    <p class="text"><strong>❌ Толстый контроллер</strong> — плохо: логика размазана, тяжело тестировать, невозможно переиспользовать:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">OrderController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>)
    {
        <span class="c-var">$data</span> = <span class="c-var">$request</span>-&gt;<span class="c-fn">validate</span>([<span class="c-comment">/* ... */</span>]);

        <span class="c-comment">// Валидация бизнес-правил</span>
        <span class="c-key">if</span> (<span class="c-type">Cart</span>::<span class="c-fn">total</span>() &lt; <span class="c-num">100</span>) { <span class="c-fn">abort</span>(<span class="c-num">422</span>, <span class="c-str">'Мин. сумма 100'</span>); }

        <span class="c-comment">// Создание заказа</span>
        <span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">create</span>(<span class="c-var">$data</span>);

        <span class="c-comment">// Списание товаров со склада</span>
        <span class="c-key">foreach</span> (<span class="c-var">$data</span>[<span class="c-str">'items'</span>] <span class="c-key">as</span> <span class="c-var">$item</span>) {
            <span class="c-type">Inventory</span>::<span class="c-fn">reserve</span>(<span class="c-var">$item</span>[<span class="c-str">'sku'</span>], <span class="c-var">$item</span>[<span class="c-str">'qty'</span>]);
        }

        <span class="c-comment">// Оплата</span>
        <span class="c-var">$payment</span> = <span class="c-key">new</span> <span class="c-type">StripeGateway</span>(<span class="c-fn">config</span>(<span class="c-str">'stripe.key'</span>));
        <span class="c-var">$payment</span>-&gt;<span class="c-fn">charge</span>(<span class="c-var">$order</span>-&gt;<span class="c-var">total</span>);

        <span class="c-comment">// Уведомление</span>
        <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$order</span>-&gt;<span class="c-var">email</span>)-&gt;<span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">OrderPlaced</span>(<span class="c-var">$order</span>));

        <span class="c-key">return</span> <span class="c-fn">redirect</span>()-&gt;<span class="c-fn">route</span>(<span class="c-str">'orders.show'</span>, <span class="c-var">$order</span>);
    }
}</code></pre>

    <p class="text"><strong>✅ Тонкий контроллер</strong> — хорошо: только оркестрация, вся логика в Action:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">OrderController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">StoreOrderRequest</span> <span class="c-var">$request</span>, <span class="c-type">PlaceOrder</span> <span class="c-var">$action</span>)
    {
        <span class="c-var">$order</span> = <span class="c-var">$action</span>-&gt;<span class="c-fn">handle</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());

        <span class="c-key">return</span> <span class="c-fn">redirect</span>()-&gt;<span class="c-fn">route</span>(<span class="c-str">'orders.show'</span>, <span class="c-var">$order</span>);
    }
}</code></pre>

    <p class="text"><strong>Что контроллер делает</strong>, а что нет:</p>
    <table class="data-table">
      <thead><tr><th>✅ Контроллер должен</th><th>❌ Контроллер НЕ должен</th></tr></thead>
      <tbody>
        <tr><td>Принимать запрос через FormRequest</td><td>Валидировать бизнес-правила («сумма &gt; 100»)</td></tr>
        <tr><td>Вызвать Action / Service</td><td>Работать с БД напрямую (кроме простых <code>Model::find</code>)</td></tr>
        <tr><td>Формировать ответ (view/json/redirect)</td><td>Отправлять email / SMS / push</td></tr>
        <tr><td>Возвращать HTTP-статус</td><td>Вызывать внешние API</td></tr>
        <tr><td></td><td>Транзакции БД</td></tr>
        <tr><td></td><td>Хешировать пароли, генерировать токены</td></tr>
      </tbody>
    </table>
    <p class="text">Подробно про Actions / Services — в KB_13 Service Container и в отдельном разделе «Actions & Services» (см. sidebar).</p>
  </div>

  <div class="subsection" id="ctrl-resource">
    <div class="subsection-title"><i data-lucide="grip"></i> Resource Controllers — 7 методов CRUD</div>
    <p class="text"><strong>Resource Controller</strong> — стандартный паттерн Laravel для CRUD-ресурса. Одна команда генерирует контроллер с 7 методами, одна строка в роутере — 7 маршрутов.</p>

    <p class="text"><strong>Генерация:</strong></p>
<pre><code>php artisan make:controller <span class="c-type">PostController</span> --resource --model=<span class="c-type">Post</span></code></pre>

    <p class="text"><strong>Регистрация в роутах:</strong></p>
<pre><code><span class="c-type">Route</span>::<span class="c-fn">resource</span>(<span class="c-str">'posts'</span>, <span class="c-type">PostController</span>::<span class="c-key">class</span>);</code></pre>

    <p class="text">Одна строка создаст следующие 7 маршрутов:</p>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>URL</th><th>Действие</th><th>Route name</th></tr></thead>
      <tbody>
        <tr><td>GET</td><td><code>/posts</code></td><td><code>index</code> — список</td><td><code>posts.index</code></td></tr>
        <tr><td>GET</td><td><code>/posts/create</code></td><td><code>create</code> — форма создания</td><td><code>posts.create</code></td></tr>
        <tr><td>POST</td><td><code>/posts</code></td><td><code>store</code> — сохранить новый</td><td><code>posts.store</code></td></tr>
        <tr><td>GET</td><td><code>/posts/{post}</code></td><td><code>show</code> — показать один</td><td><code>posts.show</code></td></tr>
        <tr><td>GET</td><td><code>/posts/{post}/edit</code></td><td><code>edit</code> — форма редактирования</td><td><code>posts.edit</code></td></tr>
        <tr><td>PUT/PATCH</td><td><code>/posts/{post}</code></td><td><code>update</code> — обновить</td><td><code>posts.update</code></td></tr>
        <tr><td>DELETE</td><td><code>/posts/{post}</code></td><td><code>destroy</code> — удалить</td><td><code>posts.destroy</code></td></tr>
      </tbody>
    </table>

    <p class="text"><strong>Частичная регистрация</strong> — если не все 7 методов нужны:</p>
<pre><code><span class="c-comment">// Только эти</span>
<span class="c-type">Route</span>::<span class="c-fn">resource</span>(<span class="c-str">'posts'</span>, <span class="c-type">PostController</span>::<span class="c-key">class</span>)-&gt;<span class="c-fn">only</span>([<span class="c-str">'index'</span>, <span class="c-str">'show'</span>]);

<span class="c-comment">// Все кроме этих</span>
<span class="c-type">Route</span>::<span class="c-fn">resource</span>(<span class="c-str">'posts'</span>, <span class="c-type">PostController</span>::<span class="c-key">class</span>)-&gt;<span class="c-fn">except</span>([<span class="c-str">'create'</span>, <span class="c-str">'edit'</span>]);</code></pre>

    <p class="text"><strong>Пример скелета контроллера</strong> с Route Model Binding + FormRequest:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">PostController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-key">public function</span> <span class="c-fn">index</span>() {
        <span class="c-key">return</span> <span class="c-fn">view</span>(<span class="c-str">'posts.index'</span>, [<span class="c-str">'posts'</span> =&gt; <span class="c-type">Post</span>::<span class="c-fn">latest</span>()-&gt;<span class="c-fn">paginate</span>(<span class="c-num">15</span>)]);
    }

    <span class="c-key">public function</span> <span class="c-fn">create</span>() {
        <span class="c-key">return</span> <span class="c-fn">view</span>(<span class="c-str">'posts.create'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">StorePostRequest</span> <span class="c-var">$request</span>) {
        <span class="c-var">$post</span> = <span class="c-type">Post</span>::<span class="c-fn">create</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());
        <span class="c-key">return</span> <span class="c-fn">redirect</span>()-&gt;<span class="c-fn">route</span>(<span class="c-str">'posts.show'</span>, <span class="c-var">$post</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">show</span>(<span class="c-type">Post</span> <span class="c-var">$post</span>) {   <span class="c-comment">// Route Model Binding</span>
        <span class="c-key">return</span> <span class="c-fn">view</span>(<span class="c-str">'posts.show'</span>, <span class="c-fn">compact</span>(<span class="c-str">'post'</span>));
    }

    <span class="c-key">public function</span> <span class="c-fn">edit</span>(<span class="c-type">Post</span> <span class="c-var">$post</span>) {
        <span class="c-key">return</span> <span class="c-fn">view</span>(<span class="c-str">'posts.edit'</span>, <span class="c-fn">compact</span>(<span class="c-str">'post'</span>));
    }

    <span class="c-key">public function</span> <span class="c-fn">update</span>(<span class="c-type">UpdatePostRequest</span> <span class="c-var">$request</span>, <span class="c-type">Post</span> <span class="c-var">$post</span>) {
        <span class="c-var">$post</span>-&gt;<span class="c-fn">update</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());
        <span class="c-key">return</span> <span class="c-fn">redirect</span>()-&gt;<span class="c-fn">route</span>(<span class="c-str">'posts.show'</span>, <span class="c-var">$post</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">destroy</span>(<span class="c-type">Post</span> <span class="c-var">$post</span>) {
        <span class="c-var">$post</span>-&gt;<span class="c-fn">delete</span>();
        <span class="c-key">return</span> <span class="c-fn">redirect</span>()-&gt;<span class="c-fn">route</span>(<span class="c-str">'posts.index'</span>);
    }
}</code></pre>

    <p class="text">Проверить все маршруты одной командой:</p>
<pre><code>php artisan route:list --path=posts</code></pre>
  </div>

  <div class="subsection" id="ctrl-api-resource">
    <div class="subsection-title"><i data-lucide="cloud"></i> <code>apiResource</code> — то же самое, но для API</div>
    <p class="text">Для API-роутов методы <code>create</code> и <code>edit</code> не нужны — они возвращают HTML-формы. Для этого есть <code>apiResource</code>:</p>
<pre><code><span class="c-type">Route</span>::<span class="c-fn">apiResource</span>(<span class="c-str">'posts'</span>, <span class="c-type">Api</span>\<span class="c-type">V1</span>\<span class="c-type">PostController</span>::<span class="c-key">class</span>);</code></pre>

    <p class="text">Регистрирует только <strong>5 методов</strong>: <code>index</code>, <code>store</code>, <code>show</code>, <code>update</code>, <code>destroy</code>. Без <code>create</code> и <code>edit</code>.</p>

    <p class="text"><strong>Массовая регистрация нескольких API-ресурсов:</strong></p>
<pre><code><span class="c-type">Route</span>::<span class="c-fn">apiResources</span>([
    <span class="c-str">'posts'</span>    =&gt; <span class="c-type">Api</span>\<span class="c-type">V1</span>\<span class="c-type">PostController</span>::<span class="c-key">class</span>,
    <span class="c-str">'comments'</span> =&gt; <span class="c-type">Api</span>\<span class="c-type">V1</span>\<span class="c-type">CommentController</span>::<span class="c-key">class</span>,
    <span class="c-str">'tags'</span>     =&gt; <span class="c-type">Api</span>\<span class="c-type">V1</span>\<span class="c-type">TagController</span>::<span class="c-key">class</span>,
]);</code></pre>

    <p class="text">Генерация контроллера сразу под API — с 5 методами:</p>
<pre><code>php artisan make:controller <span class="c-type">Api/V1/PostController</span> --api --model=<span class="c-type">Post</span></code></pre>
  </div>

  <div class="subsection" id="ctrl-nested">
    <div class="subsection-title"><i data-lucide="git-branch"></i> Nested / Shallow resources</div>
    <p class="text"><strong>Nested resource</strong> — вложенные ресурсы через точку. Полезно когда URL отражает иерархию: комментарии принадлежат посту.</p>
<pre><code><span class="c-type">Route</span>::<span class="c-fn">resource</span>(<span class="c-str">'posts.comments'</span>, <span class="c-type">CommentController</span>::<span class="c-key">class</span>);</code></pre>

    <p class="text">Регистрирует маршруты вида:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>GET /posts/{post}/comments</code></li>
      <li><code>POST /posts/{post}/comments</code></li>
      <li><code>GET /posts/{post}/comments/{comment}</code> — <strong>оба параметра</strong> в URL</li>
      <li><code>PUT /posts/{post}/comments/{comment}</code></li>
      <li><code>DELETE /posts/{post}/comments/{comment}</code></li>
    </ul>

    <p class="text"><strong>Shallow nested</strong> — для операций над конкретным комментарием (<code>show</code>, <code>edit</code>, <code>update</code>, <code>destroy</code>) не нужен ID поста, потому что ID комментария уже уникален. Делаем URL короче:</p>
<pre><code><span class="c-type">Route</span>::<span class="c-fn">resource</span>(<span class="c-str">'posts.comments'</span>, <span class="c-type">CommentController</span>::<span class="c-key">class</span>)-&gt;<span class="c-fn">shallow</span>();</code></pre>

    <p class="text">Получаем:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>GET /posts/{post}/comments</code> — вложено (список комментов к посту)</li>
      <li><code>POST /posts/{post}/comments</code> — вложено (создать)</li>
      <li><code>GET /comments/{comment}</code> — <strong>не вложено</strong></li>
      <li><code>PUT /comments/{comment}</code> — не вложено</li>
      <li><code>DELETE /comments/{comment}</code> — не вложено</li>
    </ul>

    <div class="tip">
      Для безопасности с nested resources — <code>-&gt;scopeBindings()</code> (см. раздел Routing), чтобы комментарий искался только среди комментариев конкретного поста, а не глобально.
    </div>
  </div>

  <div class="subsection" id="ctrl-middleware">
    <div class="subsection-title"><i data-lucide="filter"></i> Middleware в контроллере (Laravel 10 vs 11+)</div>

    <p class="text"><strong>В Laravel 10 и ниже</strong> — middleware назначались в конструкторе контроллера:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">PostController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>()
    {
        <span class="c-var">$this</span>-&gt;<span class="c-fn">middleware</span>(<span class="c-str">'auth'</span>);
        <span class="c-var">$this</span>-&gt;<span class="c-fn">middleware</span>(<span class="c-str">'admin'</span>)-&gt;<span class="c-fn">only</span>([<span class="c-str">'destroy'</span>]);
        <span class="c-var">$this</span>-&gt;<span class="c-fn">middleware</span>(<span class="c-str">'verified'</span>)-&gt;<span class="c-fn">except</span>([<span class="c-str">'index'</span>, <span class="c-str">'show'</span>]);
    }
}</code></pre>

    <p class="text"><strong>В Laravel 11+</strong> — метод <code>middleware()</code> в контроллере <strong>убран</strong>. Middleware назначаются в роутах:</p>
<pre><code><span class="c-type">Route</span>::<span class="c-fn">resource</span>(<span class="c-str">'posts'</span>, <span class="c-type">PostController</span>::<span class="c-key">class</span>)
    -&gt;<span class="c-fn">middleware</span>([<span class="c-str">'auth'</span>])
    -&gt;<span class="c-fn">middleware</span>(<span class="c-str">'admin'</span>)-&gt;<span class="c-fn">only</span>([<span class="c-str">'destroy'</span>]);

<span class="c-comment">// Или через группы</span>
<span class="c-type">Route</span>::<span class="c-fn">middleware</span>([<span class="c-str">'auth'</span>, <span class="c-str">'verified'</span>])-&gt;<span class="c-fn">group</span>(<span class="c-key">function</span> () {
    <span class="c-type">Route</span>::<span class="c-fn">resource</span>(<span class="c-str">'posts'</span>, <span class="c-type">PostController</span>::<span class="c-key">class</span>);
    <span class="c-type">Route</span>::<span class="c-fn">resource</span>(<span class="c-str">'comments'</span>, <span class="c-type">CommentController</span>::<span class="c-key">class</span>);
});</code></pre>

    <p class="text">Если хочется <strong>сохранить старый стиль</strong> в Laravel 11+ — контроллер должен реализовать интерфейс <code>HasMiddleware</code>:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Routing</span>\<span class="c-type">Controllers</span>\<span class="c-type">HasMiddleware</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Routing</span>\<span class="c-type">Controllers</span>\<span class="c-type">Middleware</span>;

<span class="c-key">class</span> <span class="c-type">PostController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span> <span class="c-key">implements</span> <span class="c-type">HasMiddleware</span>
{
    <span class="c-key">public static function</span> <span class="c-fn">middleware</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'auth'</span>,
            <span class="c-key">new</span> <span class="c-type">Middleware</span>(<span class="c-str">'admin'</span>, <span class="c-var">only</span>: [<span class="c-str">'destroy'</span>]),
            <span class="c-key">new</span> <span class="c-type">Middleware</span>(<span class="c-str">'verified'</span>, <span class="c-var">except</span>: [<span class="c-str">'index'</span>, <span class="c-str">'show'</span>]),
        ];
    }
}</code></pre>

    <div class="remember-box">
      В новых проектах на Laravel 11+ рекомендуется назначать middleware <strong>в роутах</strong> (группы или <code>-&gt;middleware()</code>). Это делает конфигурацию явной — открыл <code>routes/web.php</code> и сразу видишь всю картину доступа.
    </div>
  </div>

  <div class="subsection" id="ctrl-invokable">
    <div class="subsection-title"><i data-lucide="zap"></i> Single Action Controllers — <code>__invoke</code></div>
    <p class="text">Когда контроллер выполняет <strong>одно действие</strong> — не нужно раздувать класс до 7 методов. Используется класс с методом <code>__invoke()</code>.</p>

<pre><code>php artisan make:controller <span class="c-type">ShowProfile</span> --invokable</code></pre>

<pre><code><span class="c-key">class</span> <span class="c-type">ShowProfile</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__invoke</span>(<span class="c-type">User</span> <span class="c-var">$user</span>)
    {
        <span class="c-key">return</span> <span class="c-fn">view</span>(<span class="c-str">'profile'</span>, <span class="c-fn">compact</span>(<span class="c-str">'user'</span>));
    }
}

<span class="c-comment">// routes/web.php</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/users/{user}/profile'</span>, <span class="c-type">ShowProfile</span>::<span class="c-key">class</span>);
<span class="c-comment">// Никакого второго параметра — не нужно указывать имя метода</span></code></pre>

    <div class="tip">
      Подробнее — в разделе <strong>Routing → Invokable Classes</strong>. Такие классы кешируются <code>route:cache</code> и хорошо ложатся на паттерн Action (один класс = одно действие).
    </div>
  </div>

  <div class="subsection" id="ctrl-responses">
    <div class="subsection-title"><i data-lucide="send"></i> Возврат ответов из контроллера</div>
    <p class="text">Laravel автоматически превращает возвращаемое значение в HTTP-ответ. Что можно вернуть из метода контроллера:</p>

    <table class="data-table">
      <thead><tr><th>Что вернуть</th><th>Что получится</th><th>Пример</th></tr></thead>
      <tbody>
        <tr><td>Строка</td><td><code>Content-Type: text/html</code></td><td><code>return 'Hello';</code></td></tr>
        <tr><td>Массив / коллекция</td><td>Автоматически JSON</td><td><code>return ['status' =&gt; 'ok'];</code></td></tr>
        <tr><td>Eloquent-модель</td><td>Автоматически JSON (через <code>toArray</code>)</td><td><code>return User::find(1);</code></td></tr>
        <tr><td><code>view(...)</code></td><td>Отрендеренный HTML</td><td><code>return view('posts.show', compact('post'));</code></td></tr>
        <tr><td><code>response()-&gt;json(...)</code></td><td>Явный JSON с control</td><td><code>return response()-&gt;json($data, 201);</code></td></tr>
        <tr><td><code>redirect(...)</code></td><td>HTTP 302 + <code>Location</code></td><td><code>return redirect()-&gt;route('home');</code></td></tr>
        <tr><td><code>back()</code></td><td>Редирект на предыдущую страницу</td><td><code>return back()-&gt;withErrors($errors);</code></td></tr>
        <tr><td><code>response()-&gt;download(...)</code></td><td>Файл с <code>Content-Disposition: attachment</code></td><td><code>return response()-&gt;download('/path/file.pdf');</code></td></tr>
        <tr><td><code>response()-&gt;streamDownload(fn())</code></td><td>Стрим — файл создаётся на лету</td><td>Для больших CSV / отчётов</td></tr>
        <tr><td><code>response()-&gt;noContent()</code></td><td>HTTP 204 без тела</td><td>После <code>destroy</code> в API</td></tr>
        <tr><td><code>JsonResource</code></td><td>Форматированный JSON через API Resource</td><td><code>return new PostResource($post);</code></td></tr>
      </tbody>
    </table>

    <p class="text"><strong>Примеры типичных возвратов:</strong></p>
<pre><code><span class="c-comment">// Web — форма после создания</span>
<span class="c-key">return</span> <span class="c-fn">redirect</span>()-&gt;<span class="c-fn">route</span>(<span class="c-str">'posts.show'</span>, <span class="c-var">$post</span>)-&gt;<span class="c-fn">with</span>(<span class="c-str">'status'</span>, <span class="c-str">'Пост создан'</span>);

<span class="c-comment">// API — JSON с статусом 201 Created</span>
<span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>([<span class="c-str">'data'</span> =&gt; <span class="c-var">$post</span>], <span class="c-num">201</span>);

<span class="c-comment">// API — через ресурс с автоматическим 201</span>
<span class="c-key">return</span> (<span class="c-key">new</span> <span class="c-type">PostResource</span>(<span class="c-var">$post</span>))-&gt;<span class="c-fn">response</span>()-&gt;<span class="c-fn">setStatusCode</span>(<span class="c-num">201</span>);

<span class="c-comment">// API — успешное удаление, ничего не возвращаем</span>
<span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">noContent</span>();       <span class="c-comment">// HTTP 204</span>

<span class="c-comment">// Скачать файл отчёта</span>
<span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">download</span>(<span class="c-fn">storage_path</span>(<span class="c-str">'reports/report.pdf'</span>));

<span class="c-comment">// Стрим большого CSV — генерируется на лету, не хранится в памяти</span>
<span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">streamDownload</span>(<span class="c-key">function</span> () {
    <span class="c-var">$handle</span> = <span class="c-fn">fopen</span>(<span class="c-str">'php://output'</span>, <span class="c-str">'w'</span>);
    <span class="c-type">Order</span>::<span class="c-fn">chunk</span>(<span class="c-num">1000</span>, <span class="c-key">fn</span> (<span class="c-var">$orders</span>) =&gt;
        <span class="c-var">$orders</span>-&gt;<span class="c-fn">each</span>(<span class="c-key">fn</span> (<span class="c-var">$o</span>) =&gt; <span class="c-fn">fputcsv</span>(<span class="c-var">$handle</span>, <span class="c-var">$o</span>-&gt;<span class="c-fn">toArray</span>()))
    );
}, <span class="c-str">'orders.csv'</span>);</code></pre>

    <p class="text">Подробно про HTTP-объекты (<code>RedirectResponse</code>, <code>JsonResponse</code>, <code>Response</code>) — в разделе <strong>HTTP-объекты Laravel</strong>.</p>
  </div>
</div>

<div id="sec-actions-services" class="section">
  <div class="section-title">Actions &amp; Services — архитектура бизнес-логики</div>

  <div class="subsection" id="as-overview">
    <div class="subsection-title"><i data-lucide="book-open"></i> Обзор: почему тонкий контроллер</div>
    <p class="text">Контроллер отвечает только за приём HTTP-запроса и формирование HTTP-ответа. Всё что «внутри» — бизнес-логика, транзакции, работа с внешними сервисами, отправка писем — должно жить в <strong>отдельных классах</strong>. Их называют по-разному: Services, Actions, UseCases, Interactors. Все они делают одно и то же — <em>инкапсулируют операцию</em>, чтобы её можно было переиспользовать, тестировать и менять независимо от HTTP-слоя.</p>

    <p class="text"><strong>Проблемы толстого контроллера:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Дублирование.</strong> Если ту же логику нужно вызвать из консольной команды / очереди / другого контроллера — придётся копировать.</li>
      <li><strong>Сложное тестирование.</strong> Юнит-тест логики требует поднимать HTTP-контекст (<code>$request</code>, роутер, middleware).</li>
      <li><strong>Смешение слоёв.</strong> Контроллер знает про SQL, транзакции, отправку email, платёжный шлюз — нарушение SRP.</li>
      <li><strong>Невозможно переиспользовать между веб/API.</strong> Веб-контроллер редиректит, API-контроллер отдаёт JSON, а логика одна и та же — не выносится.</li>
    </ul>

    <p class="text"><strong>Что даёт вынесение в Actions/Services:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Один класс — одна операция, легко читать и найти в коде.</li>
      <li>Тестируется без HTTP-контекста, зависимости мокаются через DI.</li>
      <li>Переиспользуется из контроллера, job, artisan-команды, теста, listener.</li>
      <li>Контроллер становится <em>оркестратором</em>: принял запрос → делегировал → вернул ответ.</li>
    </ul>

    <div class="remember-box">
      <strong>Мантра.</strong> «Контроллер — <em>тонкий</em>, бизнес-логика — <em>снаружи</em>». Всё что не про HTTP — вон из контроллера. Контроллер не должен знать про транзакции, платёжные шлюзы, email, кеш, внешние API.
    </div>
  </div>

  <div class="subsection" id="as-service">
    <div class="subsection-title"><i data-lucide="briefcase"></i> Service Layer — сервисный слой</div>
    <p class="text"><strong>Service</strong> — класс, объединяющий <strong>несколько связанных операций</strong> одной темы. Один сервис = одна доменная область (пользователи, заказы, платежи, отчёты).</p>

    <p class="text"><strong>Типичный сервис:</strong></p>
<pre><code><span class="c-comment">// app/Services/UserService.php</span>
<span class="c-key">class</span> <span class="c-type">UserService</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private</span> <span class="c-type">UserRepository</span> <span class="c-var">$users</span>,
        <span class="c-key">private</span> <span class="c-type">Mailer</span> <span class="c-var">$mailer</span>,
    ) {}

    <span class="c-key">public function</span> <span class="c-fn">register</span>(<span class="c-key">array</span> <span class="c-var">$data</span>): <span class="c-type">User</span>
    {
        <span class="c-var">$user</span> = <span class="c-var">$this</span>-&gt;<span class="c-var">users</span>-&gt;<span class="c-fn">create</span>(<span class="c-var">$data</span>);
        <span class="c-var">$this</span>-&gt;<span class="c-var">mailer</span>-&gt;<span class="c-fn">sendWelcome</span>(<span class="c-var">$user</span>);
        <span class="c-key">return</span> <span class="c-var">$user</span>;
    }

    <span class="c-key">public function</span> <span class="c-fn">changePassword</span>(<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-key">string</span> <span class="c-var">$newPassword</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$user</span>-&gt;<span class="c-fn">update</span>([<span class="c-str">'password'</span> =&gt; <span class="c-fn">bcrypt</span>(<span class="c-var">$newPassword</span>)]);
        <span class="c-var">$this</span>-&gt;<span class="c-var">mailer</span>-&gt;<span class="c-fn">sendPasswordChanged</span>(<span class="c-var">$user</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">deactivate</span>(<span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$user</span>-&gt;<span class="c-fn">update</span>([<span class="c-str">'active'</span> =&gt; <span class="c-key">false</span>]);
        <span class="c-type">Auth</span>::<span class="c-fn">logoutOtherDevices</span>(...);
    }
}

<span class="c-comment">// Контроллер — тонкий</span>
<span class="c-key">public function</span> <span class="c-fn">register</span>(<span class="c-type">RegisterRequest</span> <span class="c-var">$request</span>, <span class="c-type">UserService</span> <span class="c-var">$users</span>)
{
    <span class="c-var">$user</span> = <span class="c-var">$users</span>-&gt;<span class="c-fn">register</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());
    <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>(<span class="c-var">$user</span>, <span class="c-num">201</span>);
}</code></pre>

    <p class="text"><strong>Признаки хорошего сервиса:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Все зависимости объявлены в конструкторе (DI, а не <code>app()</code>/<code>new</code>).</li>
      <li>Методы возвращают доменные объекты (модели, DTO), а не <code>Response</code>.</li>
      <li>Не знает про HTTP: не принимает <code>Request</code>, не возвращает <code>Response</code>, не делает <code>redirect</code>.</li>
      <li>Не работает с сессиями, кукисами, заголовками.</li>
      <li>Может быть вызван из любого места: контроллера, job'а, artisan-команды, теста.</li>
    </ul>

    <div class="pitfall">
      <strong>Антипаттерн:</strong> «God Service» на 40 методов и 3000 строк. Признак — в конструкторе 8+ зависимостей. Разбивайте на несколько сервисов по под-темам (например, <code>UserRegistrationService</code>, <code>UserProfileService</code>, <code>UserSecurityService</code>) или переходите на Actions (одна операция = один класс).
    </div>
  </div>

  <div class="subsection" id="as-action">
    <div class="subsection-title"><i data-lucide="zap"></i> Action-паттерн — single-purpose класс</div>
    <p class="text"><strong>Action</strong> — класс, инкапсулирующий <strong>одну операцию</strong> (одно бизнес-действие). Единственный публичный метод, обычно <code>handle()</code> или <code>execute()</code>. Часто применяется вместо Service, когда операция сложная и не нуждается в объединении с другими.</p>

    <p class="text"><strong>Типичный Action:</strong></p>
<pre><code><span class="c-comment">// app/Actions/PlaceOrder.php</span>
<span class="c-key">class</span> <span class="c-type">PlaceOrder</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private</span> <span class="c-type">PaymentGateway</span> <span class="c-var">$payment</span>,
        <span class="c-key">private</span> <span class="c-type">Inventory</span> <span class="c-var">$inventory</span>,
        <span class="c-key">private</span> <span class="c-type">EventDispatcher</span> <span class="c-var">$events</span>,
    ) {}

    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-key">array</span> <span class="c-var">$items</span>): <span class="c-type">Order</span>
    {
        <span class="c-key">return</span> <span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$user</span>, <span class="c-var">$items</span>) {
            <span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">create</span>([<span class="c-str">'user_id'</span> =&gt; <span class="c-var">$user</span>-&gt;<span class="c-var">id</span>]);
            <span class="c-var">$this</span>-&gt;<span class="c-var">inventory</span>-&gt;<span class="c-fn">reserve</span>(<span class="c-var">$items</span>);
            <span class="c-var">$this</span>-&gt;<span class="c-var">payment</span>-&gt;<span class="c-fn">charge</span>(<span class="c-var">$user</span>, <span class="c-var">$order</span>-&gt;<span class="c-var">total</span>);
            <span class="c-var">$this</span>-&gt;<span class="c-var">events</span>-&gt;<span class="c-fn">dispatch</span>(<span class="c-key">new</span> <span class="c-type">OrderPlaced</span>(<span class="c-var">$order</span>));
            <span class="c-key">return</span> <span class="c-var">$order</span>;
        });
    }
}

<span class="c-comment">// Контроллер</span>
<span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">StoreOrderRequest</span> <span class="c-var">$request</span>, <span class="c-type">PlaceOrder</span> <span class="c-var">$action</span>)
{
    <span class="c-var">$order</span> = <span class="c-var">$action</span>-&gt;<span class="c-fn">handle</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">user</span>(), <span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>()[<span class="c-str">'items'</span>]);
    <span class="c-key">return</span> <span class="c-fn">redirect</span>()-&gt;<span class="c-fn">route</span>(<span class="c-str">'orders.show'</span>, <span class="c-var">$order</span>);
}</code></pre>

    <p class="text"><strong>Признаки Action:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Один</strong> публичный метод (<code>handle</code> / <code>execute</code> / <code>__invoke</code>).</li>
      <li>Имя класса — <strong>глагол в императиве</strong>: <code>PlaceOrder</code>, <code>CancelSubscription</code>, <code>SendPasswordReset</code>, <code>PublishPost</code>.</li>
      <li>Зависимости через конструктор (DI).</li>
      <li>Возвращает результат операции (модель, DTO, void).</li>
      <li>Атомарен: всё что нужно для завершения одной бизнес-операции — внутри одного класса.</li>
    </ul>

    <div class="tip">
      Как <strong>invokable action</strong> — можно использовать <code>__invoke()</code> вместо <code>handle()</code>, тогда вызов сокращается до <code>$action($user, $items)</code>. Также подходит для <code>Route::get(..., PlaceOrder::class)</code> — Laravel сам вызовет <code>__invoke</code>.
    </div>
  </div>

  <div class="subsection" id="as-compare">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Service vs Action vs UseCase — терминология</div>
    <p class="text">Разные команды используют разные названия для одной и той же идеи. Ниже — как различаются на практике:</p>

    <table class="data-table">
      <thead><tr><th></th><th>Service</th><th>Action / UseCase / Interactor</th></tr></thead>
      <tbody>
        <tr>
          <td><strong>Гранулярность</strong></td>
          <td>Один класс — несколько связанных методов</td>
          <td>Один класс — одна операция</td>
        </tr>
        <tr>
          <td><strong>Метод</strong></td>
          <td><code>register()</code>, <code>changePassword()</code>, <code>deactivate()</code>...</td>
          <td>Один <code>handle()</code> / <code>execute()</code> / <code>__invoke()</code></td>
        </tr>
        <tr>
          <td><strong>Именование класса</strong></td>
          <td>Существительное (тема): <code>UserService</code>, <code>OrderService</code></td>
          <td>Глагол (действие): <code>RegisterUser</code>, <code>PlaceOrder</code>, <code>CancelSubscription</code></td>
        </tr>
        <tr>
          <td><strong>Размер класса</strong></td>
          <td>Обычно 100-400 строк, 5-15 методов</td>
          <td>30-150 строк, 1 метод</td>
        </tr>
        <tr>
          <td><strong>Когда подходит</strong></td>
          <td>Простой домен, несколько операций одной темы</td>
          <td>Сложная операция с транзакцией, многими шагами, событиями</td>
        </tr>
        <tr>
          <td><strong>Проблема при росте</strong></td>
          <td>«God Service» на 40 методов</td>
          <td>Взрыв количества файлов (100+ actions)</td>
        </tr>
      </tbody>
    </table>

    <p class="text"><strong>Названия в разных школах:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Service</strong> — Laravel-community, DDD старой школы, .NET</li>
      <li><strong>Action</strong> — Laravel-community (популяризировано Spatie), Rails, Django</li>
      <li><strong>UseCase</strong> — Clean Architecture (Robert Martin), DDD</li>
      <li><strong>Interactor</strong> — Ruby (Trailblazer, Interactor gem)</li>
    </ul>
    <p class="text">Разница чисто в названии и гранулярности. По сути — все они <em>инкапсулируют бизнес-операцию</em>. Выбирайте <strong>Actions</strong> когда операции сложные и хочется единый метод-контракт, <strong>Services</strong> когда операции лёгкие и логично группируются по теме.</p>
  </div>

  <div class="subsection" id="as-repository">
    <div class="subsection-title"><i data-lucide="database"></i> Repository pattern — абстракция над БД</div>
    <p class="text"><strong>Repository</strong> — класс, инкапсулирующий работу с хранилищем данных (обычно БД). Идея: сервис не знает про Eloquent — он вызывает <code>UserRepository::findByEmail($email)</code>, а тот уже делает <code>User::where('email', $email)-&gt;first()</code>.</p>

<pre><code><span class="c-comment">// app/Repositories/UserRepository.php</span>
<span class="c-key">class</span> <span class="c-type">UserRepository</span>
{
    <span class="c-key">public function</span> <span class="c-fn">find</span>(<span class="c-key">int</span> <span class="c-var">$id</span>): ?<span class="c-type">User</span>
    {
        <span class="c-key">return</span> <span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-var">$id</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">findByEmail</span>(<span class="c-key">string</span> <span class="c-var">$email</span>): ?<span class="c-type">User</span>
    {
        <span class="c-key">return</span> <span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'email'</span>, <span class="c-var">$email</span>)-&gt;<span class="c-fn">first</span>();
    }

    <span class="c-key">public function</span> <span class="c-fn">create</span>(<span class="c-key">array</span> <span class="c-var">$data</span>): <span class="c-type">User</span>
    {
        <span class="c-key">return</span> <span class="c-type">User</span>::<span class="c-fn">create</span>(<span class="c-var">$data</span>);
    }
}</code></pre>

    <div class="pitfall">
      <strong>⚠ В Laravel Repository часто избыточен.</strong> Eloquent сам по себе — Active Record, и уже даёт удобное API. Оборачивать <code>User::find()</code> в <code>UserRepository::find()</code> — часто <em>писать один класс поверх другого</em> без выгоды.
      <p style="margin-top:8px"><strong>Когда Repository оправдан:</strong></p>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Планируется реальная замена БД (не гипотетическая): Postgres → MongoDB, БД → внешний API.</li>
        <li>Сложные query нужно переиспользовать (можно и через Query Scope в модели).</li>
        <li>Строгий DDD с полной изоляцией доменной модели от Eloquent.</li>
        <li>Тесты — но mockаются модели легко и без Repository через <code>Model::factory()-&gt;make()</code>.</li>
      </ul>
      В 90% Laravel-проектов Repository не нужен — Eloquent используется напрямую в Actions/Services.
    </div>

    <div class="remember-box">
      <strong>Правило:</strong> добавляй Repository только когда есть <em>конкретная</em> причина. «Может пригодится» — не причина. Начинайте с прямого использования Eloquent в Actions/Services; если станет реально сложно — вынесите в Repository потом.
    </div>
  </div>

  <div class="subsection" id="as-folders">
    <div class="subsection-title"><i data-lucide="folder-tree"></i> Куда положить: структура папок</div>
    <p class="text">Laravel не навязывает структуру для Services/Actions — можете класть куда удобно. Типичные варианты:</p>

<pre><code>app/
├── Actions/                            <span class="c-comment"># популярный вариант</span>
│   ├── Users/
│   │   ├── RegisterUser.php
│   │   ├── DeactivateUser.php
│   │   └── ChangePassword.php
│   ├── Orders/
│   │   ├── PlaceOrder.php
│   │   ├── CancelOrder.php
│   │   └── RefundOrder.php
│   └── Notifications/
│       └── SendPasswordReset.php
│
├── Services/                            <span class="c-comment"># альтернатива / дополнение</span>
│   ├── PaymentGateway.php
│   ├── SmsSender.php
│   └── ReportGenerator.php
│
├── Repositories/                        <span class="c-comment"># опционально, если реально нужен</span>
│   └── UserRepository.php
│
└── Http/
    └── Controllers/
        └── OrderController.php          <span class="c-comment"># тонкий, вызывает Actions</span></code></pre>

    <p class="text"><strong>Практические правила именования:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Actions</strong> — глагол в императиве: <code>PlaceOrder</code>, <code>SendInvoice</code>, <code>PublishPost</code>.</li>
      <li><strong>Services</strong> — существительное: <code>PaymentGateway</code>, <code>SmsSender</code>, <code>ReportGenerator</code>.</li>
      <li><strong>Группировать по доменной области</strong>: <code>Actions/Users/</code>, <code>Actions/Orders/</code> — легче найти всё связанное.</li>
      <li>Если у вас модульная структура (например, <code>modules/Billing/</code>) — Actions/Services живут внутри модуля, а не в глобальной <code>app/</code>.</li>
    </ul>

    <p class="text"><strong>Разница подходов:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>app/Actions/</code> — один класс = одна операция (single-purpose).</li>
      <li><code>app/Services/</code> — один класс = набор связанных методов (multi-purpose) или интеграция с внешним сервисом.</li>
      <li>Часто <strong>используют оба</strong>: Actions для бизнес-операций (PlaceOrder), Services для инфраструктуры (PaymentGateway).</li>
    </ul>
  </div>

  <div class="subsection" id="as-testing">
    <div class="subsection-title"><i data-lucide="test-tube"></i> Тестирование отдельно от контроллера</div>
    <p class="text">Главная выгода Actions/Services — они <strong>тестируются как обычные классы</strong>, без HTTP-контекста.</p>

    <p class="text"><strong>Юнит-тест Action:</strong></p>
<pre><code><span class="c-key">class</span> <span class="c-type">PlaceOrderTest</span> <span class="c-key">extends</span> <span class="c-type">TestCase</span>
{
    <span class="c-key">use</span> <span class="c-type">RefreshDatabase</span>;

    <span class="c-key">public function</span> <span class="c-fn">test_places_order_and_charges_payment</span>()
    {
        <span class="c-var">$user</span>  = <span class="c-type">User</span>::<span class="c-fn">factory</span>()-&gt;<span class="c-fn">create</span>();
        <span class="c-var">$items</span> = [[<span class="c-str">'sku'</span> =&gt; <span class="c-str">'ABC'</span>, <span class="c-str">'qty'</span> =&gt; <span class="c-num">2</span>]];

        <span class="c-comment">// Мокаем внешнюю зависимость — платёжный шлюз</span>
        <span class="c-var">$payment</span> = <span class="c-type">Mockery</span>::<span class="c-fn">mock</span>(<span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>);
        <span class="c-var">$payment</span>-&gt;<span class="c-fn">shouldReceive</span>(<span class="c-str">'charge'</span>)-&gt;<span class="c-fn">once</span>()-&gt;<span class="c-fn">andReturn</span>(<span class="c-key">true</span>);
        <span class="c-var">$this</span>-&gt;<span class="c-fn">app</span>-&gt;<span class="c-fn">instance</span>(<span class="c-type">PaymentGateway</span>::<span class="c-key">class</span>, <span class="c-var">$payment</span>);

        <span class="c-comment">// Разрешаем Action через контейнер — зависимости подставятся</span>
        <span class="c-var">$order</span> = <span class="c-fn">app</span>(<span class="c-type">PlaceOrder</span>::<span class="c-key">class</span>)-&gt;<span class="c-fn">handle</span>(<span class="c-var">$user</span>, <span class="c-var">$items</span>);

        <span class="c-var">$this</span>-&gt;<span class="c-fn">assertInstanceOf</span>(<span class="c-type">Order</span>::<span class="c-key">class</span>, <span class="c-var">$order</span>);
        <span class="c-var">$this</span>-&gt;<span class="c-fn">assertEquals</span>(<span class="c-var">$user</span>-&gt;<span class="c-var">id</span>, <span class="c-var">$order</span>-&gt;<span class="c-var">user_id</span>);
    }
}</code></pre>

    <p class="text"><strong>Зачем это важно:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Не нужен <code>$this-&gt;post('/orders', ...)</code> — быстрее (миллисекунды vs сотни мс).</li>
      <li>Не нужны CSRF, session, middleware — тестируется чистая логика.</li>
      <li>Можно мокать любую зависимость через контейнер: <code>$this-&gt;app-&gt;instance(...)</code>.</li>
      <li>Один и тот же Action покрыт unit-тестами один раз — и работает одинаково из контроллера, job, artisan-команды.</li>
    </ul>

    <div class="tip">
      Feature-тесты (через <code>$this-&gt;post()</code>) остаются — проверяют интеграцию контроллер + Action + middleware + validation. Но <em>основную</em> бизнес-логику тестируйте юнит-тестами Actions/Services — их проще писать и они на порядок быстрее.
    </div>
  </div>

  <div class="subsection" id="as-practice">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: PlaceOrder Action с транзакцией + Event</div>
    <p class="text">Полный пример реальной бизнес-операции: разместить заказ. Валидация в FormRequest, тонкий контроллер, вся логика в Action, транзакция БД, событие для side-effects.</p>

<pre><code><span class="c-comment">// 1. FormRequest — только валидация</span>
<span class="c-key">class</span> <span class="c-type">StoreOrderRequest</span> <span class="c-key">extends</span> <span class="c-type">FormRequest</span>
{
    <span class="c-key">public function</span> <span class="c-fn">rules</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'items'</span>       =&gt; <span class="c-str">'required|array|min:1'</span>,
            <span class="c-str">'items.*.sku'</span> =&gt; <span class="c-str">'required|string|exists:products,sku'</span>,
            <span class="c-str">'items.*.qty'</span> =&gt; <span class="c-str">'required|integer|min:1'</span>,
        ];
    }
}

<span class="c-comment">// 2. Action — вся бизнес-логика</span>
<span class="c-key">class</span> <span class="c-type">PlaceOrder</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private</span> <span class="c-type">PaymentGateway</span> <span class="c-var">$payment</span>,
        <span class="c-key">private</span> <span class="c-type">Inventory</span> <span class="c-var">$inventory</span>,
    ) {}

    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-key">array</span> <span class="c-var">$items</span>): <span class="c-type">Order</span>
    {
        <span class="c-key">return</span> <span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$user</span>, <span class="c-var">$items</span>) {
            <span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">create</span>([
                <span class="c-str">'user_id'</span> =&gt; <span class="c-var">$user</span>-&gt;<span class="c-var">id</span>,
                <span class="c-str">'status'</span>  =&gt; <span class="c-str">'pending'</span>,
            ]);

            <span class="c-var">$order</span>-&gt;<span class="c-var">items</span>()-&gt;<span class="c-fn">createMany</span>(<span class="c-var">$items</span>);
            <span class="c-var">$this</span>-&gt;<span class="c-var">inventory</span>-&gt;<span class="c-fn">reserve</span>(<span class="c-var">$items</span>);
            <span class="c-var">$this</span>-&gt;<span class="c-var">payment</span>-&gt;<span class="c-fn">charge</span>(<span class="c-var">$user</span>, <span class="c-var">$order</span>-&gt;<span class="c-fn">total</span>());
            <span class="c-var">$order</span>-&gt;<span class="c-fn">update</span>([<span class="c-str">'status'</span> =&gt; <span class="c-str">'paid'</span>]);

            <span class="c-comment">// Событие вне транзакции гарантированно после commit</span>
            <span class="c-type">OrderPaid</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>)-&gt;<span class="c-fn">afterCommit</span>();

            <span class="c-key">return</span> <span class="c-var">$order</span>;
        });
    }
}

<span class="c-comment">// 3. Контроллер — тонкий, только оркестрация</span>
<span class="c-key">class</span> <span class="c-type">OrderController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">StoreOrderRequest</span> <span class="c-var">$request</span>, <span class="c-type">PlaceOrder</span> <span class="c-var">$action</span>)
    {
        <span class="c-var">$order</span> = <span class="c-var">$action</span>-&gt;<span class="c-fn">handle</span>(
            <span class="c-var">$request</span>-&gt;<span class="c-fn">user</span>(),
            <span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>()[<span class="c-str">'items'</span>]
        );

        <span class="c-key">return</span> <span class="c-fn">redirect</span>()-&gt;<span class="c-fn">route</span>(<span class="c-str">'orders.show'</span>, <span class="c-var">$order</span>);
    }
}

<span class="c-comment">// 4. Listener подписан на OrderPaid — асинхронный, отправляется в очередь</span>
<span class="c-key">class</span> <span class="c-type">SendOrderConfirmation</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">OrderPaid</span> <span class="c-var">$event</span>)
    {
        <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$event</span>-&gt;<span class="c-var">order</span>-&gt;<span class="c-var">user</span>-&gt;<span class="c-var">email</span>)
            -&gt;<span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">OrderConfirmationMail</span>(<span class="c-var">$event</span>-&gt;<span class="c-var">order</span>));
    }
}</code></pre>

    <p class="text"><strong>Что происходит:</strong> FormRequest валидирует и авторизует; Controller остаётся тонким; Action — единица бизнес-логики; транзакция оборачивает все БД-операции; <code>afterCommit</code> гарантирует что событие уйдёт после commit'а; событие <code>OrderPaid</code> подключает listener'ов без правок Action; каждый слой можно тестировать отдельно; логику можно переиспользовать из job / artisan / другого контроллера.</p>

    <div class="remember-box">
      <strong>Итог:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li><strong>Service Layer</strong> — сервисы с несколькими методами по теме (<code>UserService</code>).</li>
        <li><strong>Action</strong> — один класс, одна операция, метод <code>handle()</code> / <code>execute()</code> / <code>__invoke()</code> (<code>PlaceOrder</code>).</li>
        <li><strong>UseCase / Interactor</strong> — то же что Action, только терминология из Clean Architecture / Ruby.</li>
        <li><strong>Repository</strong> — оправдан только когда есть конкретная причина, в 90% Laravel-проектов Eloquent используется напрямую.</li>
        <li><strong>Куда класть</strong> — <code>app/Actions/{Domain}/</code>, <code>app/Services/</code>, группировать по доменной области.</li>
        <li><strong>Тесты</strong> — юнит-тестируйте Actions/Services напрямую, feature-тесты покрывают интеграцию через контроллер.</li>
      </ul>
    </div>
  </div>
</div>

<div id="sec-middleware" class="section">
  <div class="section-title">Middleware</div>
  <div class="subsection" id="mw-purpose">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Middleware — слой между HTTP-запросом и обработчиком. Каждый middleware может: (а) изменить запрос, (б) вернуть ответ напрямую (не доходя до controller), (в) вмешаться в response после controller, (г) сделать дорогую работу после отправки ответа (<code>terminate</code>). Это основа кросс-cutting concerns: аутентификация, CORS, rate limiting, логирование, локализация.</p>
  </div>

  <div class="subsection" id="mw-types">
    <div class="subsection-title"><i data-lucide="list"></i> Виды и порядок</div>
    <div class="card"><h3>Global</h3><p class="text">Применяются ко всем запросам. Регистрируются в <code>bootstrap/app.php</code> (Laravel 11+) или <code>app/Http/Kernel.php::$middleware</code>. Типичные: <code>TrustProxies</code>, <code>HandleCors</code>, <code>TrimStrings</code>.</p></div>
    <div class="card"><h3>Group (web / api)</h3><p class="text">Применяются ко всем маршрутам группы. <code>web</code>: session, CSRF, cookies. <code>api</code>: throttle, без session. Группы кастомизируются через <code>$middlewareGroups</code>.</p></div>
    <div class="card"><h3>Route-specific</h3><p class="text">Через <code>-&gt;middleware(['auth', 'verified'])</code> или alias <code>-&gt;middleware('auth:sanctum')</code>. Aliases объявляются в <code>$middlewareAliases</code>.</p></div>
    <div class="card"><h3>Параметризованный middleware</h3><p class="text"><code>throttle:60,1</code> — middleware <code>ThrottleRequests</code> с параметрами 60 запросов в 1 минуту. Параметры приходят в <code>handle($request, $next, ...$params)</code>.</p></div>
    <div class="card"><h3><code>terminate</code></h3><p class="text">Метод вызывается <em>после</em> отправки response клиенту. Здесь дорогая работа (логи в БД, отправка метрик), не влияющая на TTFB. Работает только под FPM с <code>fastcgi_finish_request</code>.</p></div>
  </div>

  <div class="subsection" id="mw-chain">
    <div class="subsection-title"><i data-lucide="git-fork"></i> Как работает цепочка middleware</div>
    <p class="text">Каждый middleware в Laravel — это <strong>слой</strong>, через который проходит запрос. Все middleware собраны в <strong>конвейер (Pipeline)</strong>. Схематично:</p>
<pre><code><span class="c-comment">// Упрощённо</span>
<span class="c-var">$request</span> → middleware1 → middleware2 → middleware3 → контроллер → ответ</code></pre>
    <p class="text">Каждый middleware получает два аргумента: <code>$request</code> и замыкание <code>$next</code>. Когда вы вызываете <code>$next($request)</code>, вы говорите: «передай запрос следующему middleware в цепочке».</p>
<pre><code><span class="c-key">final class</span> <span class="c-type">ExampleMiddleware</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>, <span class="c-type">Closure</span> <span class="c-var">$next</span>): <span class="c-type">Response</span>
    {
        <span class="c-comment">// ── Код ДО $next: выполнится на пути к контроллеру ──</span>
        <span class="c-var">$start</span> = <span class="c-fn">microtime</span>(<span class="c-key">true</span>);

        <span class="c-var">$response</span> = <span class="c-var">$next</span>(<span class="c-var">$request</span>);   <span class="c-comment">// ← передать дальше по цепочке</span>

        <span class="c-comment">// ── Код ПОСЛЕ $next: выполнится на обратном пути ──</span>
        <span class="c-var">$duration</span> = <span class="c-fn">microtime</span>(<span class="c-key">true</span>) - <span class="c-var">$start</span>;
        <span class="c-var">$response</span>-&gt;<span class="c-fn">headers</span>-&gt;<span class="c-fn">set</span>(<span class="c-str">'X-Duration'</span>, <span class="c-var">$duration</span>);

        <span class="c-key">return</span> <span class="c-var">$response</span>;
    }
}</code></pre>
  </div>

  <div class="subsection" id="mw-reverse">
    <div class="subsection-title"><i data-lucide="undo-2"></i> Зачем нужен обратный проход (код после <code>$next</code>)</div>
    <p class="text">После того как запрос прошёл все middleware и достиг контроллера, тот возвращает ответ. Теперь ответ «поднимается» обратно по цепочке — каждый middleware получает уже готовый <code>$response</code> и может его модифицировать.</p>
    <p class="text"><strong>Основные сценарии обратного прохода:</strong></p>
    <ul style="line-height:1.9;margin-left:20px;color:var(--text2)">
      <li><strong>Добавление HTTP-заголовков</strong> — CORS, кеширование (<code>Cache-Control</code>), безопасность (<code>X-Frame-Options</code>, <code>Strict-Transport-Security</code>).</li>
      <li><strong>Сжатие ответа</strong> — gzip / brotli перед отправкой.</li>
      <li><strong>Логирование времени выполнения</strong> — засекли время до <code>$next</code>, вычли после.</li>
      <li><strong>Преобразование формата</strong> — например, JSON → XML, или обёртка ответа в <code>{ data: ..., meta: ... }</code>.</li>
      <li><strong>Обработка ошибок</strong> — если в контроллере выброшено исключение, middleware может перехватить его через <code>try/catch</code> и вернуть красивый JSON вместо стандартной страницы 500.</li>
    </ul>
    <div class="remember-box">
      <strong>Ключевое:</strong> без обратного прохода все эти задачи пришлось бы делать <em>до</em> <code>$next</code> — а это невозможно, потому что ответ ещё не сгенерирован. Обратный проход даёт middleware второй шанс уже с готовым response.
    </div>
  </div>

  <div class="subsection" id="mw-terminate">
    <div class="subsection-title"><i data-lucide="fast-forward"></i> Фаза <code>terminate</code> — что это и зачем</div>
    <p class="text">Некоторые middleware реализуют метод <code>terminate()</code>:</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">terminate</span>(<span class="c-var">$request</span>, <span class="c-var">$response</span>)
{
    <span class="c-comment">// Тяжёлая работа: логирование в БД, аналитика, очистка ресурсов</span>
}</code></pre>
    <p class="text"><strong>Важнейшая особенность:</strong> <code>terminate</code> вызывается <strong>после того, как ответ уже отправлен клиенту</strong>. Это значит, что время выполнения этого метода <strong>не влияет на скорость загрузки страницы для пользователя</strong>.</p>

    <p class="text"><strong>Зачем это нужно:</strong></p>
    <ul style="line-height:1.9;margin-left:20px;color:var(--text2)">
      <li>Логирование деталей запроса — запись в БД (медленная операция).</li>
      <li>Отправка метрик в мониторинговые системы (Prometheus, Datadog, Sentry).</li>
      <li>Закрытие соединений, очистка временных файлов.</li>
      <li>Всё, что требует времени, но не критично для пользователя.</li>
    </ul>

    <h4 style="margin:14px 0 8px;font-size:14px;font-weight:700">Как это работает технически</h4>
    <p class="text">В <strong>PHP-FPM</strong> (и некоторых других SAPI) есть возможность выполнить код после отправки ответа. Laravel использует механизм <code>fastcgi_finish_request()</code> (если доступен) или просто вызывает <code>terminate</code> синхронно после <code>$response-&gt;send()</code>.</p>
    <table class="data-table">
      <thead><tr><th>SAPI</th><th>Как работает <code>terminate</code></th><th>Пользователь ждёт?</th></tr></thead>
      <tbody>
        <tr><td>PHP-FPM (nginx/apache prod)</td><td>Асинхронно через <code>fastcgi_finish_request()</code> — response уходит клиенту, PHP-процесс продолжает работать</td><td>❌ Нет</td></tr>
        <tr><td>Apache mod_php</td><td>Обычно синхронно — <code>fastcgi_finish_request()</code> недоступен</td><td>✅ Да</td></tr>
        <tr><td><code>php artisan serve</code> (built-in)</td><td>Синхронно — нет асинхронности</td><td>✅ Да</td></tr>
        <tr><td>Laravel Octane (Swoole/RoadRunner)</td><td>Свои события <code>RequestTerminated</code>, поведение зависит от драйвера</td><td>Обычно нет</td></tr>
      </tbody>
    </table>
    <div class="pitfall">
      <strong>⚠</strong> На <code>artisan serve</code> и в тестах <code>terminate</code> удлиняет ответ — не полагайтесь на «незаметность» тяжёлой работы. В production под FPM всё нормально.
    </div>
  </div>

  <div class="subsection" id="mw-practice">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: middleware с проверкой и логированием</div>
<pre><code><span class="c-key">final class</span> <span class="c-type">EnsureFeatureEnabled</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>, <span class="c-type">Closure</span> <span class="c-var">$next</span>, <span class="c-key">string</span> <span class="c-var">$feature</span>): <span class="c-type">Response</span>
    {
        <span class="c-key">if</span> (! <span class="c-type">Features</span>::<span class="c-fn">enabled</span>(<span class="c-var">$feature</span>, <span class="c-var">$request</span>-&gt;<span class="c-fn">user</span>())) {
            <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>([<span class="c-str">'error'</span> =&gt; <span class="c-str">'Feature disabled'</span>], <span class="c-num">403</span>);
        }
        <span class="c-key">return</span> <span class="c-var">$next</span>(<span class="c-var">$request</span>);
    }
}

<span class="c-comment">// Маршрут</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/beta'</span>, <span class="c-type">BetaController</span>::<span class="c-key">class</span>)
    -&gt;<span class="c-fn">middleware</span>(<span class="c-str">'feature:beta-dashboard'</span>);
</code></pre>
  </div>

  <div class="subsection" id="mw-pitfalls">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Изменение request в <code>handle</code>.</strong> <code>$request-&gt;merge(['foo' =&gt; 'bar'])</code> работает, но следующие middleware и controller получат изменённый объект. Это может ломать тесты, ожидающие исходный запрос.</div>
    <div class="pitfall"><strong>2. Возврат response из <code>handle</code> без <code>$next</code>.</strong> Если middleware вернул response, дальнейшие middleware и controller не выполняются — это используется для редиректов, авторизации. Удобно, но легко создать «невидимый» branch в логике.</div>
    <div class="pitfall"><strong>3. <code>terminate</code> на built-in сервере.</strong> <code>php artisan serve</code> не поддерживает <code>fastcgi_finish_request</code> — terminate работает синхронно, удлиняя ответ.</div>
    <div class="pitfall"><strong>4. Порядок middleware.</strong> Глобальные → групповые → маршрутные. Внутри каждой категории — в порядке объявления. <code>throttle</code> перед <code>auth</code> — IP-throttle; после <code>auth</code> — user-throttle.</div>
    <div class="pitfall"><strong>5. Middleware без типизированного <code>$request</code>.</strong> <code>$request</code> может быть <code>Symfony\HttpFoundation\Request</code> или <code>Illuminate\Http\Request</code>. Типизируйте <code>Request</code> для доступа к Laravel-методам.</div>
    <div class="pitfall"><strong>6. CSRF и AJAX.</strong> JS-фреймворки отправляют CSRF через заголовок <code>X-CSRF-TOKEN</code> или <code>X-XSRF-TOKEN</code>. Без него POST/PUT/DELETE возвращают 419.</div>
    <div class="pitfall"><strong>7. Middleware ловит session, для API не нужно.</strong> <code>StartSession</code> в API-группе — лишняя нагрузка. По умолчанию в группе <code>api</code> session отключена; если включили — выключите.</div>
    <div class="pitfall"><strong>8. Утечка состояния в Octane.</strong> Middleware-инстанс переиспользуется между запросами в Octane. Свойства middleware с per-request состоянием утекут. Не храните состояние; всё — через параметры handle.</div>
  </div>

  <div class="subsection" id="mw-global">
    <div class="subsection-title"><i data-lucide="layers"></i> Глобальные middleware — стандартный набор Laravel</div>

    <p class="text"><strong>Что такое глобальные middleware.</strong> Глобальные middleware применяются к каждому HTTP-запросу, независимо от маршрута. Они выполняются <em>до</em> групповых (<code>web</code>, <code>api</code>) и маршрутных (<code>-&gt;middleware('...')</code>). В Laravel 11+ регистрируются в <code>bootstrap/app.php</code> через <code>-&gt;withMiddleware(...)</code>, в более старых версиях — в свойстве <code>$middleware</code> класса <code>app/Http/Kernel.php</code>.</p>

    <p class="text">Стандартный набор, включённый по умолчанию, состоит из семи middleware. Ниже — назначение каждого из них.</p>

    <p class="text"><strong>TrustProxies.</strong> Настраивает доверенные прокси-серверы (например, Nginx, Cloudflare, AWS ELB). Исправляет заголовки <code>X-Forwarded-*</code>, чтобы Laravel правильно определял реальный IP-адрес клиента, протокол (https/http) и хост, если приложение работает за обратным прокси.</p>

    <p class="text"><strong>HandleCors.</strong> Обрабатывает CORS-заголовки (Cross-Origin Resource Sharing). Добавляет в ответы <code>Access-Control-Allow-Origin</code>, <code>Access-Control-Allow-Methods</code> и др., а также автоматически отвечает на OPTIONS-запросы (preflight). Конфигурация — в <code>config/cors.php</code>.</p>

    <p class="text"><strong>PreventRequestsDuringMaintenance.</strong> Проверяет, включён ли режим обслуживания (флаг <code>down</code>). Если да — возвращает страницу «503 Service Unavailable» (или кастомное представление) для всех запросов, кроме IP-адресов, разрешённых в <code>php artisan down --allow=...</code>.</p>

    <p class="text"><strong>ValidatePostSize.</strong> Проверяет, не превышает ли размер входящего POST-запроса максимально допустимый лимит, заданный в <code>php.ini</code> (<code>post_max_size</code> и <code>upload_max_filesize</code>). Если превышает — прерывает запрос с ошибкой.</p>

    <p class="text"><strong>TrimStrings.</strong> Автоматически обрезает пробелы в начале и конце всех входящих строковых полей (<code>$request-&gt;all()</code>), кроме полей, перечисленных в свойстве <code>$except</code> (например, пароли, чтобы не обрезать пробелы, если они значимы).</p>

    <p class="text"><strong>ConvertEmptyStringsToNull.</strong> Преобразует пустые строки (<code>''</code>) в <code>null</code> во всех входящих данных запроса. Это помогает единообразно работать с отсутствующими значениями в БД (особенно для полей, которые могут быть <code>NULL</code>).</p>

    <p class="text"><strong>TrustHosts (обычно закомментирован).</strong> Ограничивает допустимые значения заголовка <code>Host</code>, чтобы предотвратить атаки подделки хоста. По умолчанию отключён, но может быть активирован для продакшена.</p>

    <p class="text"><strong>Порядок выполнения.</strong> Глобальные middleware выполняются в том порядке, в котором они перечислены в массиве. Это важно, потому что, например, <code>TrimStrings</code> и <code>ConvertEmptyStringsToNull</code> должны отработать до того, как данные попадут в контроллер.</p>

    <p class="text"><strong>Полный пример</strong> <code>bootstrap/app.php</code> со всеми стандартными глобальными middleware (для Laravel 11+):</p>
<pre><code>&lt;?<span class="c-key">php</span>

<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Foundation</span>\<span class="c-type">Application</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Foundation</span>\<span class="c-type">Configuration</span>\<span class="c-type">Middleware</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">HandleCors</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Foundation</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">ValidatePostSize</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Foundation</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">ConvertEmptyStringsToNull</span>;
<span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">TrimStrings</span>;
<span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">TrustProxies</span>;
<span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">PreventRequestsDuringMaintenance</span>;
<span class="c-comment">// use Illuminate\Foundation\Http\Middleware\TrustHosts; // обычно закомментирован</span>

<span class="c-key">return</span> <span class="c-type">Application</span>::<span class="c-fn">configure</span>(<span class="c-var">basePath</span>: <span class="c-fn">dirname</span>(<span class="c-fn">__DIR__</span>))
    -&gt;<span class="c-fn">withRouting</span>(
        <span class="c-var">web</span>:      <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/web.php'</span>,
        <span class="c-var">api</span>:      <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/api.php'</span>,
        <span class="c-var">commands</span>: <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/console.php'</span>,
        <span class="c-var">health</span>:   <span class="c-str">'/up'</span>,
    )
    -&gt;<span class="c-fn">withMiddleware</span>(<span class="c-key">function</span> (<span class="c-type">Middleware</span> <span class="c-var">$middleware</span>) {
        <span class="c-comment">// Глобальные middleware — применяются к каждому запросу.
        // Порядок важен: они выполняются сверху вниз.</span>
        <span class="c-var">$middleware</span>-&gt;<span class="c-fn">append</span>([
            <span class="c-type">TrustProxies</span>::<span class="c-key">class</span>,                       <span class="c-comment">// доверенные прокси (IP, протокол)</span>
            <span class="c-type">HandleCors</span>::<span class="c-key">class</span>,                         <span class="c-comment">// CORS-заголовки и OPTIONS</span>
            <span class="c-type">PreventRequestsDuringMaintenance</span>::<span class="c-key">class</span>,   <span class="c-comment">// проверка режима обслуживания</span>
            <span class="c-type">ValidatePostSize</span>::<span class="c-key">class</span>,                   <span class="c-comment">// проверка размера POST-запроса</span>
            <span class="c-type">TrimStrings</span>::<span class="c-key">class</span>,                        <span class="c-comment">// обрезка пробелов (кроме исключённых)</span>
            <span class="c-type">ConvertEmptyStringsToNull</span>::<span class="c-key">class</span>,          <span class="c-comment">// пустые строки → null</span>
        ]);

        <span class="c-comment">// TrustHosts — ограничение допустимых хостов (по умолчанию отключён):
        // $middleware-&gt;trustHosts(at: ['example.com', '*.example.com']);

        // Свой глобальный middleware:
        // $middleware-&gt;append(MyCustomGlobalMiddleware::class);</span>
    })
    -&gt;<span class="c-fn">withExceptions</span>(<span class="c-key">function</span> (<span class="c-var">$exceptions</span>) {
        <span class="c-comment">//</span>
    })
    -&gt;<span class="c-fn">create</span>();</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="table" style="width:14px;height:14px"></i> Сводная таблица назначений</div>
    <table class="data-table">
      <thead><tr><th>Класс</th><th>Назначение</th></tr></thead>
      <tbody>
        <tr><td><code>TrustProxies</code></td><td>Корректирует IP, протокол и хост, если приложение за прокси (Nginx, Cloudflare).</td></tr>
        <tr><td><code>HandleCors</code></td><td>Добавляет CORS-заголовки и отвечает на OPTIONS-запросы. Настройки в <code>config/cors.php</code>.</td></tr>
        <tr><td><code>PreventRequestsDuringMaintenance</code></td><td>Если сайт в режиме обслуживания (<code>php artisan down</code>), возвращает 503 для всех, кроме разрешённых IP.</td></tr>
        <tr><td><code>ValidatePostSize</code></td><td>Проверяет, что размер POST-данных не превышает лимиты PHP (<code>post_max_size</code>, <code>upload_max_filesize</code>).</td></tr>
        <tr><td><code>TrimStrings</code></td><td>Обрезает пробелы с начала и конца всех строковых полей ввода (кроме перечисленных в <code>$except</code>).</td></tr>
        <tr><td><code>ConvertEmptyStringsToNull</code></td><td>Превращает пустые строки (<code>''</code>) в <code>null</code> — удобно для БД с nullable-полями.</td></tr>
        <tr><td><code>TrustHosts</code></td><td>Ограничивает допустимые значения заголовка <code>Host</code> — защита от атак подделки хоста.</td></tr>
      </tbody>
    </table>

    <p class="text"><strong>Если нужно изменить порядок или список:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>$middleware-&gt;append(...)</code> — добавляет в конец списка</li>
      <li><code>$middleware-&gt;prepend(...)</code> — добавляет в начало</li>
      <li><code>$middleware-&gt;use([...])</code> — полностью заменяет список глобальных middleware. Используйте осторожно: можно случайно отключить стандартную обработку CORS, trim, maintenance mode и других критичных вещей.</li>
    </ul>
  </div>

  <div class="subsection" id="mw-groups">
    <div class="subsection-title"><i data-lucide="group"></i> Кастомизация middleware-групп (web / api)</div>

    <p class="text"><strong>Что такое группы.</strong> Middleware-группы — это наборы middleware, которые применяются к маршрутам, объединённым в группы (обычно через <code>Route::group(['middleware' =&gt; 'web'])</code> или автоматически в <code>routes/web.php</code> и <code>routes/api.php</code>). Группы позволяют не перечислять каждый middleware в каждом маршруте, а применять их оптом.</p>

    <p class="text"><strong>Где регистрируются.</strong> В Laravel 11+ — в файле <code>bootstrap/app.php</code> с помощью метода <code>-&gt;withMiddleware()</code>. В Laravel 10 и ниже — в классе <code>App\Http\Kernel</code> в свойстве <code>$middlewareGroups</code>.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="table" style="width:14px;height:14px"></i> Стандартные группы по умолчанию</div>
    <table class="data-table">
      <thead><tr><th>Группа</th><th>Назначение</th><th>Входящие middleware (стандарт)</th></tr></thead>
      <tbody>
        <tr>
          <td><code>web</code></td>
          <td>Для веб-интерфейса (с сессиями, CSRF, куками)</td>
          <td><code>EncryptCookies</code>, <code>AddQueuedCookiesToResponse</code>, <code>StartSession</code>, <code>ShareErrorsFromSession</code>, <code>VerifyCsrfToken</code>, <code>SubstituteBindings</code></td>
        </tr>
        <tr>
          <td><code>api</code></td>
          <td>Для API-маршрутов (без сессий, с ограничениями)</td>
          <td><code>throttle:api</code>, <code>SubstituteBindings</code> (иногда добавляют <code>EnsureFrontendRequestsAreStateful</code> для Sanctum)</td>
        </tr>
      </tbody>
    </table>

    <p class="text"><strong>Кастомизация в <code>bootstrap/app.php</code> (Laravel 11+).</strong> В <code>bootstrap/app.php</code> вы можете добавлять или удалять middleware из существующих групп, а также создавать свои.</p>
<pre><code>&lt;?<span class="c-key">php</span>

<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Foundation</span>\<span class="c-type">Application</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Foundation</span>\<span class="c-type">Configuration</span>\<span class="c-type">Middleware</span>;
<span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">LogRequest</span>;
<span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">CheckApiVersion</span>;

<span class="c-key">return</span> <span class="c-type">Application</span>::<span class="c-fn">configure</span>(<span class="c-var">basePath</span>: <span class="c-fn">dirname</span>(<span class="c-fn">__DIR__</span>))
    -&gt;<span class="c-fn">withRouting</span>(
        <span class="c-var">web</span>:      <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/web.php'</span>,
        <span class="c-var">api</span>:      <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/api.php'</span>,
        <span class="c-var">commands</span>: <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/console.php'</span>,
        <span class="c-var">health</span>:   <span class="c-str">'/up'</span>,
    )
    -&gt;<span class="c-fn">withMiddleware</span>(<span class="c-key">function</span> (<span class="c-type">Middleware</span> <span class="c-var">$middleware</span>) {
        <span class="c-comment">// 1. Добавление своих middleware в группу web (в конец)</span>
        <span class="c-var">$middleware</span>-&gt;<span class="c-fn">web</span>(<span class="c-var">append</span>: [
            <span class="c-type">LogRequest</span>::<span class="c-key">class</span>,
        ]);

        <span class="c-comment">// 2. Добавление в группу api (в начало)</span>
        <span class="c-var">$middleware</span>-&gt;<span class="c-fn">api</span>(<span class="c-var">prepend</span>: [
            <span class="c-type">CheckApiVersion</span>::<span class="c-key">class</span>,      <span class="c-comment">// проверка Accept-Version</span>
        ]);

        <span class="c-comment">// 3. Полностью переопределить группу — заменить стандартные:
        // $middleware-&gt;web(use: [ /* новый список */ ]);</span>

        <span class="c-comment">// 4. Создание собственной группы</span>
        <span class="c-var">$middleware</span>-&gt;<span class="c-fn">group</span>(<span class="c-str">'custom'</span>, [
            <span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">CustomMiddleware</span>::<span class="c-key">class</span>,
        ]);

        <span class="c-comment">// 5. Удаление из группы напрямую не поддерживается,
        //    но можно переопределить через use, например убрать throttle из api:
        // $middleware-&gt;api(use: [
        //     Illuminate\Routing\Middleware\SubstituteBindings::class,
        // ]);</span>
    })
    -&gt;<span class="c-fn">withExceptions</span>(<span class="c-key">function</span> (<span class="c-var">$exceptions</span>) {
        <span class="c-comment">//</span>
    })
    -&gt;<span class="c-fn">create</span>();</code></pre>

    <p class="text"><strong>Аналогично для Laravel 10 и ниже.</strong> В <code>app/Http/Kernel.php</code> редактируется свойство <code>$middlewareGroups</code>:</p>
<pre><code><span class="c-key">protected</span> <span class="c-var">$middlewareGroups</span> = [
    <span class="c-str">'web'</span> =&gt; [
        \<span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">EncryptCookies</span>::<span class="c-key">class</span>,
        \<span class="c-type">Illuminate</span>\<span class="c-type">Cookie</span>\<span class="c-type">Middleware</span>\<span class="c-type">AddQueuedCookiesToResponse</span>::<span class="c-key">class</span>,
        \<span class="c-type">Illuminate</span>\<span class="c-type">Session</span>\<span class="c-type">Middleware</span>\<span class="c-type">StartSession</span>::<span class="c-key">class</span>,
        <span class="c-comment">// ... стандартные ...</span>
        \<span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">LogRequest</span>::<span class="c-key">class</span>,   <span class="c-comment">// добавляем свой</span>
    ],

    <span class="c-str">'api'</span> =&gt; [
        \<span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">CheckApiVersion</span>::<span class="c-key">class</span>,   <span class="c-comment">// в начало</span>
        \<span class="c-type">Laravel</span>\<span class="c-type">Sanctum</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">EnsureFrontendRequestsAreStateful</span>::<span class="c-key">class</span>,
        <span class="c-str">'throttle:api'</span>,
        \<span class="c-type">Illuminate</span>\<span class="c-type">Routing</span>\<span class="c-type">Middleware</span>\<span class="c-type">SubstituteBindings</span>::<span class="c-key">class</span>,
    ],
];</code></pre>

    <p class="text"><strong>Важные нюансы:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Порядок важен</strong> — middleware выполняются в том порядке, в котором перечислены в массиве. Например, <code>StartSession</code> должен быть до <code>VerifyCsrfToken</code>, иначе CSRF не сможет прочитать токен из сессии.</li>
      <li><strong>Группы в маршрутах</strong> — <code>Route::middleware('web')-&gt;group(...)</code> или <code>Route::group(['middleware' =&gt; ['web', 'auth']], ...)</code>.</li>
      <li><strong><code>use</code> удаляет стандартные</strong> — если вы переопределяете группу через <code>use</code>, вы теряете все дефолтные middleware. Обычно лучше <code>append</code>/<code>prepend</code>.</li>
      <li><strong>API-специфика</strong> — часто добавляют <code>throttle</code> с лимитами, а также <code>EnsureFrontendRequestsAreStateful</code> для SPA-авторизации через Sanctum.</li>
    </ul>

    <div class="remember-box">
      <strong>Итог.</strong> Группы кастомизируются в <code>bootstrap/app.php</code> (Laravel 11+) или в <code>Kernel.php</code> (Laravel ≤10). Используйте методы <code>web()</code>, <code>api()</code> и <code>group()</code> для добавления своих middleware в существующие или новые группы. Изменения в группах применяются ко всем маршрутам, которые используют эту группу.
    </div>
  </div>

  <div class="subsection" id="mw-aliases">
    <div class="subsection-title"><i data-lucide="tag"></i> Middleware Aliases (псевдонимы)</div>

    <p class="text"><strong>Что это.</strong> Middleware Aliases — это короткие имена для классов middleware. Они нужны, чтобы в роутах писать не полное имя класса, а краткий alias — например <code>'auth'</code> вместо <code>\App\Http\Middleware\Authenticate::class</code>.</p>

    <p class="text"><strong>Где объявляются.</strong> В зависимости от версии Laravel место отличается:</p>
    <table class="data-table">
      <thead><tr><th>Версия</th><th>Файл</th><th>Свойство / метод</th></tr></thead>
      <tbody>
        <tr>
          <td>Laravel 11+</td>
          <td><code>bootstrap/app.php</code></td>
          <td><code>$middleware-&gt;alias([...])</code> внутри <code>withMiddleware()</code></td>
        </tr>
        <tr>
          <td>Laravel 10 и ниже</td>
          <td><code>app/Http/Kernel.php</code></td>
          <td>Свойство <code>protected $middlewareAliases = [...]</code></td>
        </tr>
      </tbody>
    </table>

    <p class="text"><strong>Как объявляются в Laravel 11+</strong> (в <code>bootstrap/app.php</code>):</p>
<pre><code>&lt;?<span class="c-key">php</span>

<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Foundation</span>\<span class="c-type">Application</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Foundation</span>\<span class="c-type">Configuration</span>\<span class="c-type">Middleware</span>;
<span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">RoleMiddleware</span>;
<span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">CheckAge</span>;

<span class="c-key">return</span> <span class="c-type">Application</span>::<span class="c-fn">configure</span>(<span class="c-var">basePath</span>: <span class="c-fn">dirname</span>(<span class="c-fn">__DIR__</span>))
    -&gt;<span class="c-fn">withRouting</span>(
        <span class="c-var">web</span>: <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/web.php'</span>,
        <span class="c-comment">// ...</span>
    )
    -&gt;<span class="c-fn">withMiddleware</span>(<span class="c-key">function</span> (<span class="c-type">Middleware</span> <span class="c-var">$middleware</span>) {
        <span class="c-comment">// Регистрируем алиасы</span>
        <span class="c-var">$middleware</span>-&gt;<span class="c-fn">alias</span>([
            <span class="c-str">'role'</span> =&gt; <span class="c-type">RoleMiddleware</span>::<span class="c-key">class</span>,
            <span class="c-str">'age'</span>  =&gt; <span class="c-type">CheckAge</span>::<span class="c-key">class</span>,
        ]);
    })
    -&gt;<span class="c-fn">withExceptions</span>(<span class="c-key">function</span> (<span class="c-var">$exceptions</span>) { <span class="c-comment">//</span> })
    -&gt;<span class="c-fn">create</span>();</code></pre>

    <p class="text"><strong>Как объявляются в Laravel 10 и ниже</strong> (в <code>app/Http/Kernel.php</code>):</p>
<pre><code>&lt;?<span class="c-key">php</span>

<span class="c-key">namespace</span> <span class="c-type">App</span>\<span class="c-type">Http</span>;

<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Foundation</span>\<span class="c-type">Http</span>\<span class="c-type">Kernel</span> <span class="c-key">as</span> <span class="c-type">HttpKernel</span>;
<span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">RoleMiddleware</span>;
<span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">CheckAge</span>;

<span class="c-key">class</span> <span class="c-type">Kernel</span> <span class="c-key">extends</span> <span class="c-type">HttpKernel</span>
{
    <span class="c-comment">// ...</span>

    <span class="c-key">protected</span> <span class="c-var">$middlewareAliases</span> = [
        <span class="c-str">'auth'</span>             =&gt; \<span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">Authenticate</span>::<span class="c-key">class</span>,
        <span class="c-str">'auth.basic'</span>       =&gt; \<span class="c-type">Illuminate</span>\<span class="c-type">Auth</span>\<span class="c-type">Middleware</span>\<span class="c-type">AuthenticateWithBasicAuth</span>::<span class="c-key">class</span>,
        <span class="c-str">'cache.headers'</span>    =&gt; \<span class="c-type">Illuminate</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">SetCacheHeaders</span>::<span class="c-key">class</span>,
        <span class="c-str">'can'</span>              =&gt; \<span class="c-type">Illuminate</span>\<span class="c-type">Auth</span>\<span class="c-type">Middleware</span>\<span class="c-type">Authorize</span>::<span class="c-key">class</span>,
        <span class="c-str">'guest'</span>            =&gt; \<span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">RedirectIfAuthenticated</span>::<span class="c-key">class</span>,
        <span class="c-str">'password.confirm'</span> =&gt; \<span class="c-type">Illuminate</span>\<span class="c-type">Auth</span>\<span class="c-type">Middleware</span>\<span class="c-type">RequirePassword</span>::<span class="c-key">class</span>,
        <span class="c-str">'signed'</span>           =&gt; \<span class="c-type">Illuminate</span>\<span class="c-type">Routing</span>\<span class="c-type">Middleware</span>\<span class="c-type">ValidateSignature</span>::<span class="c-key">class</span>,
        <span class="c-str">'throttle'</span>         =&gt; \<span class="c-type">Illuminate</span>\<span class="c-type">Routing</span>\<span class="c-type">Middleware</span>\<span class="c-type">ThrottleRequests</span>::<span class="c-key">class</span>,
        <span class="c-str">'verified'</span>         =&gt; \<span class="c-type">Illuminate</span>\<span class="c-type">Auth</span>\<span class="c-type">Middleware</span>\<span class="c-type">EnsureEmailIsVerified</span>::<span class="c-key">class</span>,

        <span class="c-comment">// Свои алиасы — сюда:</span>
        <span class="c-str">'role'</span> =&gt; <span class="c-type">RoleMiddleware</span>::<span class="c-key">class</span>,
        <span class="c-str">'age'</span>  =&gt; <span class="c-type">CheckAge</span>::<span class="c-key">class</span>,
    ];
}</code></pre>

    <p class="text"><strong>Как использовать алиас в роуте.</strong> После регистрации алиаса просто указываете его в <code>-&gt;middleware()</code>:</p>
<pre><code><span class="c-comment">// routes/web.php или routes/api.php</span>

<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/admin'</span>, [<span class="c-type">AdminController</span>::<span class="c-key">class</span>, <span class="c-str">'index'</span>])
    -&gt;<span class="c-fn">middleware</span>([<span class="c-str">'auth'</span>, <span class="c-str">'role:admin'</span>]);   <span class="c-comment">// auth и role — это алиасы</span>

<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/restricted'</span>, <span class="c-key">function</span> () {
    <span class="c-key">return</span> <span class="c-str">'Только для взрослых'</span>;
})-&gt;<span class="c-fn">middleware</span>(<span class="c-str">'age:18'</span>);              <span class="c-comment">// алиас age с параметром</span></code></pre>

    <p class="text"><strong>Важные нюансы:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Алиасы с параметрами работают так же, как и с полными именами классов: <code>'role:admin'</code> передаст параметр <code>admin</code> в метод <code>handle()</code> middleware.</li>
      <li>Встроенные алиасы (<code>auth</code>, <code>guest</code>, <code>verified</code>, <code>throttle</code> и др.) уже зарегистрированы по умолчанию — их не нужно объявлять вручную.</li>
      <li>Если алиас не зарегистрирован, Laravel выдаст ошибку <code>Target class [alias] does not exist</code>.</li>
      <li>В Laravel 11 файла <code>Kernel.php</code> больше нет — вся конфигурация middleware перенесена в <code>bootstrap/app.php</code>.</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="table" style="width:14px;height:14px"></i> Итог сравнения по версиям</div>
    <table class="data-table">
      <thead><tr><th>Действие</th><th>Laravel 11+</th><th>Laravel ≤10</th></tr></thead>
      <tbody>
        <tr>
          <td><strong>Где</strong></td>
          <td><code>bootstrap/app.php</code></td>
          <td><code>app/Http/Kernel.php</code></td>
        </tr>
        <tr>
          <td><strong>Как</strong></td>
          <td><code>$middleware-&gt;alias(['alias' =&gt; Class::class])</code></td>
          <td><code>protected $middlewareAliases = ['alias' =&gt; Class::class]</code></td>
        </tr>
        <tr>
          <td><strong>Использование</strong></td>
          <td><code>-&gt;middleware('alias')</code></td>
          <td><code>-&gt;middleware('alias')</code></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="subsection" id="mw-params">
    <div class="subsection-title"><i data-lucide="sliders"></i> Параметризованный middleware — throttle:60,1 и подобные</div>

    <p class="text"><strong>Что это.</strong> Параметризованный middleware — это middleware, которое принимает дополнительные параметры в строке вызова, например <code>'throttle:60,1'</code>. Эти параметры передаются в метод <code>handle()</code> после <code>$next</code> как переменное число аргументов (<code>...$params</code>).</p>

    <p class="text"><strong>Как это работает внутри.</strong> В классе middleware метод <code>handle</code> имеет такую сигнатуру:</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-var">$request</span>, <span class="c-type">Closure</span> <span class="c-var">$next</span>, ...<span class="c-var">$params</span>)
{
    <span class="c-comment">// $params — массив переданных параметров
    // для 'throttle:60,1' это будет [60, 1]</span>
}</code></pre>
    <p class="text">При вызове <code>-&gt;middleware('throttle:60,1')</code> Laravel парсит строку: разделяет её по двоеточию (отделяя имя middleware от параметров) и запятым (между параметрами), после чего передаёт значения как отдельные аргументы.</p>

    <p class="text"><strong>Как использовать в роутах:</strong></p>
<pre><code><span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/api/data'</span>, [<span class="c-type">DataController</span>::<span class="c-key">class</span>, <span class="c-str">'index'</span>])
    -&gt;<span class="c-fn">middleware</span>(<span class="c-str">'throttle:60,1'</span>);   <span class="c-comment">// 60 запросов в минуту</span>

<span class="c-comment">// Несколько middleware сразу — через массив</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/admin/dashboard'</span>, <span class="c-type">DashboardController</span>::<span class="c-key">class</span>)
    -&gt;<span class="c-fn">middleware</span>([<span class="c-str">'auth:sanctum'</span>, <span class="c-str">'throttle:60,1'</span>, <span class="c-str">'verified'</span>]);</code></pre>

    <p class="text"><strong>Где настраивается throttle.</strong> Стандартный <code>ThrottleRequests</code> уже зарегистрирован в алиасах под именем <code>throttle</code>. Его параметры можно задавать двумя способами:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Напрямую в роуте</strong> — как в примере выше (<code>throttle:60,1</code>).</li>
      <li><strong>Через именованные лимиты</strong> — в файле <code>app/Http/Kernel.php</code> (для Laravel ≤10) или через <code>bootstrap/app.php</code> (Laravel 11+) можно определить глобальные лимиты для групп API и использовать их как <code>throttle:api</code>.</li>
    </ul>

    <p class="text"><strong>Именованные лимиты в Laravel ≤10</strong> — в <code>App\Providers\RouteServiceProvider</code>:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Cache</span>\<span class="c-type">RateLimiting</span>\<span class="c-type">Limit</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Support</span>\<span class="c-type">Facades</span>\<span class="c-type">RateLimiter</span>;

<span class="c-key">protected function</span> <span class="c-fn">configureRateLimiting</span>()
{
    <span class="c-type">RateLimiter</span>::<span class="c-fn">for</span>(<span class="c-str">'api'</span>, <span class="c-key">function</span> (<span class="c-var">$request</span>) {
        <span class="c-key">return</span> <span class="c-type">Limit</span>::<span class="c-fn">perMinute</span>(<span class="c-num">60</span>)
            -&gt;<span class="c-fn">by</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">user</span>()?-&gt;<span class="c-var">id</span> ?: <span class="c-var">$request</span>-&gt;<span class="c-fn">ip</span>());
    });
}</code></pre>

    <p class="text"><strong>Именованные лимиты в Laravel 11+</strong> — через <code>bootstrap/app.php</code>:</p>
<pre><code>-&gt;<span class="c-fn">withRouting</span>(
    <span class="c-var">api</span>: <span class="c-fn">__DIR__</span>.<span class="c-str">'/../routes/api.php'</span>,
    <span class="c-comment">// ...</span>
    <span class="c-var">using</span>: <span class="c-key">function</span> () {
        <span class="c-type">RateLimiter</span>::<span class="c-fn">for</span>(<span class="c-str">'api'</span>, <span class="c-key">fn</span> (<span class="c-var">$request</span>) =&gt;
            <span class="c-type">Limit</span>::<span class="c-fn">perMinute</span>(<span class="c-num">60</span>)-&gt;<span class="c-fn">by</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">user</span>()?-&gt;<span class="c-var">id</span> ?: <span class="c-var">$request</span>-&gt;<span class="c-fn">ip</span>())
        );
    }
)</code></pre>
    <p class="text">Тогда в роуте достаточно писать <code>'throttle:api'</code> — будет использоваться заданный лимит.</p>

    <p class="text"><strong>Создание своего параметризованного middleware.</strong> Класс <code>CheckAge</code> с двумя параметрами (<code>$minAge</code> и опциональный <code>$maxAge</code>):</p>
<pre><code><span class="c-key">namespace</span> <span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>;

<span class="c-key">use</span> <span class="c-type">Closure</span>;

<span class="c-key">class</span> <span class="c-type">CheckAge</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-var">$request</span>, <span class="c-type">Closure</span> <span class="c-var">$next</span>, <span class="c-var">$minAge</span>, <span class="c-var">$maxAge</span> = <span class="c-key">null</span>)
    {
        <span class="c-var">$age</span> = <span class="c-var">$request</span>-&gt;<span class="c-fn">input</span>(<span class="c-str">'age'</span>);
        <span class="c-key">if</span> (<span class="c-var">$age</span> &lt; <span class="c-var">$minAge</span> || (<span class="c-var">$maxAge</span> &amp;&amp; <span class="c-var">$age</span> &gt; <span class="c-var">$maxAge</span>)) {
            <span class="c-fn">abort</span>(<span class="c-num">403</span>, <span class="c-str">'Возраст не подходит.'</span>);
        }
        <span class="c-key">return</span> <span class="c-var">$next</span>(<span class="c-var">$request</span>);
    }
}</code></pre>

    <p class="text">Зарегистрируйте алиас — в <code>bootstrap/app.php</code> (Laravel 11+) или в <code>Kernel.php</code> (Laravel ≤10):</p>
<pre><code><span class="c-comment">// Laravel 11+</span>
-&gt;<span class="c-fn">withMiddleware</span>(<span class="c-key">function</span> (<span class="c-type">Middleware</span> <span class="c-var">$middleware</span>) {
    <span class="c-var">$middleware</span>-&gt;<span class="c-fn">alias</span>([
        <span class="c-str">'age'</span> =&gt; \<span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">CheckAge</span>::<span class="c-key">class</span>,
    ]);
})

<span class="c-comment">// Laravel ≤10</span>
<span class="c-key">protected</span> <span class="c-var">$middlewareAliases</span> = [
    <span class="c-comment">// ...</span>
    <span class="c-str">'age'</span> =&gt; \<span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Middleware</span>\<span class="c-type">CheckAge</span>::<span class="c-key">class</span>,
];</code></pre>

    <p class="text">Используйте в роуте — параметры идут после двоеточия через запятую, в порядке аргументов метода <code>handle</code>:</p>
<pre><code><span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/adults-only'</span>, <span class="c-key">function</span> () {
    <span class="c-key">return</span> <span class="c-str">'Добро пожаловать!'</span>;
})-&gt;<span class="c-fn">middleware</span>(<span class="c-str">'age:18,30'</span>);   <span class="c-comment">// minAge=18, maxAge=30</span></code></pre>

    <p class="text"><strong>Особенности throttle:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Стандартный <code>throttle</code> использует кеш (по умолчанию <code>file</code>) для подсчёта количества запросов.</li>
      <li>Можно передавать два параметра: <code>throttle:attempts,decayMinutes</code>.</li>
      <li>Если опустить параметры, будет использоваться значение по умолчанию (обычно 60 и 1), но лучше явно указывать.</li>
      <li>Для API-роутов часто используют <code>throttle:api</code>, где лимит настраивается централизованно, чтобы не дублировать число в каждом роуте.</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="table" style="width:14px;height:14px"></i> Итоговая таблица</div>
    <table class="data-table">
      <thead><tr><th>Действие</th><th>Где регистрируется</th><th>Как использовать</th></tr></thead>
      <tbody>
        <tr>
          <td>Параметризованный middleware</td>
          <td>В алиасах (<code>$middlewareAliases</code> или <code>bootstrap/app.php</code>)</td>
          <td><code>-&gt;middleware('alias:param1,param2')</code></td>
        </tr>
        <tr>
          <td>Стандартный throttle</td>
          <td>Уже зарегистрирован</td>
          <td><code>'throttle:60,1'</code> или <code>'throttle:api'</code> (с настройкой через <code>RateLimiter</code>)</td>
        </tr>
        <tr>
          <td>Кастомный параметризованный</td>
          <td>Регистрируете свой класс и алиас</td>
          <td><code>'age:18,30'</code> — параметры придут в <code>handle()</code> как <code>$minAge, $maxAge</code></td>
        </tr>
      </tbody>
    </table>

    <div class="remember-box">
      <strong>Главное правило:</strong> параметры передаются в метод <code>handle</code> в том порядке, в котором они перечислены через запятую после двоеточия.
    </div>
  </div>

  <div class="subsection" id="mw-cors">
    <div class="subsection-title"><i data-lucide="globe"></i> CORS — практический разбор для middleware</div>

    <p class="text"><strong>Что такое CORS.</strong> CORS (Cross-Origin Resource Sharing) — механизм, который позволяет веб-страницам, загруженным с одного домена (origin), запрашивать ресурсы с другого домена, отличного от того, с которого была загружена страница. Без CORS браузеры блокируют такие запросы из соображений безопасности.</p>

    <p class="text"><strong>Почему он нужен.</strong> Браузеры реализуют политику одного источника (Same-Origin Policy). Она запрещает скриптам на странице выполнять HTTP-запросы к другому источнику (домену, порту или протоколу), если только сервер явно не разрешит это с помощью CORS-заголовков. Пример: ваш фронтенд работает на <code>https://myfrontend.com</code>, а API — на <code>https://api.myapp.com</code>. Если фронтенд попытается отправить AJAX-запрос на API, браузер заблокирует его, потому что источники разные. Чтобы разрешить, API должен вернуть заголовок <code>Access-Control-Allow-Origin: https://myfrontend.com</code>.</p>

    <p class="text"><strong>Как работает CORS.</strong> Для простого запроса (GET, POST с некоторыми Content-Type) браузер сам добавляет заголовок <code>Origin: https://myfrontend.com</code>. Если сервер в ответе вернёт <code>Access-Control-Allow-Origin: https://myfrontend.com</code> (или <code>*</code>), браузер разрешит запрос.</p>

    <p class="text">Для сложных запросов (PATCH, DELETE, с кастомными заголовками, с <code>Content-Type: application/json</code>) браузер сначала отправляет предварительный запрос (Preflight) методом OPTIONS, чтобы узнать, разрешён ли основной запрос. Сервер должен ответить заголовками:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>Access-Control-Allow-Origin</code></li>
      <li><code>Access-Control-Allow-Methods</code> — какие HTTP-методы разрешены</li>
      <li><code>Access-Control-Allow-Headers</code> — какие заголовки можно передавать</li>
      <li><code>Access-Control-Max-Age</code> — сколько кешировать ответ preflight</li>
    </ul>
    <p class="text">Если сервер не отвечает на OPTIONS или отвечает без нужных заголовков, браузер блокирует основной запрос.</p>

    <p class="text"><strong>Настройка в Laravel.</strong> В Laravel управление CORS вынесено в конфигурацию и middleware. Файл конфигурации <code>config/cors.php</code> (по умолчанию есть в Laravel 7+, в более ранних нужно установить пакет <code>fruitcake/laravel-cors</code>):</p>
<pre><code><span class="c-key">return</span> [
    <span class="c-str">'paths'</span> =&gt; [<span class="c-str">'api/*'</span>, <span class="c-str">'sanctum/csrf-cookie'</span>],   <span class="c-comment">// пути, для которых применяется CORS</span>
    <span class="c-str">'allowed_methods'</span>         =&gt; [<span class="c-str">'*'</span>],       <span class="c-comment">// или ['GET', 'POST', ...]</span>
    <span class="c-str">'allowed_origins'</span>         =&gt; [<span class="c-str">'https://myfrontend.com'</span>, <span class="c-str">'http://localhost:3000'</span>],
    <span class="c-str">'allowed_origins_patterns'</span>=&gt; [],
    <span class="c-str">'allowed_headers'</span>         =&gt; [<span class="c-str">'*'</span>],
    <span class="c-str">'exposed_headers'</span>         =&gt; [],
    <span class="c-str">'max_age'</span>                =&gt; <span class="c-num">0</span>,
    <span class="c-str">'supports_credentials'</span>   =&gt; <span class="c-key">false</span>,
];</code></pre>

    <p class="text">Далее middleware — в глобальный стек <code>App\Http\Kernel</code> (или в <code>bootstrap/app.php</code> для Laravel 11+) добавляется <code>\App\Http\Middleware\HandleCors::class</code> (или из пакета). Он автоматически обрабатывает OPTIONS-запросы и добавляет нужные заголовки в ответы. Важно понимать: CORS настраивается на стороне сервера. Если ваш API обслуживается Laravel, вам нужно правильно сконфигурировать его, чтобы браузер разрешал кросс-доменные запросы.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="alert-circle" style="width:14px;height:14px"></i> Типичные ошибки и их решение</div>
    <table class="data-table">
      <thead><tr><th>Ошибка в консоли браузера</th><th>Причина</th><th>Решение</th></tr></thead>
      <tbody>
        <tr>
          <td><code>No 'Access-Control-Allow-Origin' header is present</code></td>
          <td>Сервер не вернул разрешающий заголовок</td>
          <td>Добавить <code>allowed_origins</code> с доменом фронтенда</td>
        </tr>
        <tr>
          <td><code>Request header field X-Requested-With is not allowed by Access-Control-Allow-Headers</code></td>
          <td>В preflight сервер не разрешил кастомный заголовок</td>
          <td>Указать его в <code>allowed_headers</code></td>
        </tr>
        <tr>
          <td><code>Method DELETE is not allowed by Access-Control-Allow-Methods</code></td>
          <td>Метод не разрешён</td>
          <td>Добавить <code>DELETE</code> в <code>allowed_methods</code></td>
        </tr>
      </tbody>
    </table>

    <div class="remember-box">
      <strong>Важно помнить.</strong> CORS — это браузерная защита; она не мешает запросам из Postman, curl или мобильных приложений. Для публичных API часто используют <code>allowed_origins = ['*']</code>, но это небезопасно для API, работающих с авторизацией — с credentials-режимом такую настройку использовать нельзя. При включении <code>credentials: true</code> (например, для отправки cookies) нельзя ставить <code>*</code> в <code>allowed_origins</code> — нужно указывать конкретный домен и добавить <code>supports_credentials =&gt; true</code>.
    </div>

    <p class="text"><strong>Итог.</strong> CORS — это механизм, который даёт веб-приложениям возможность безопасно запрашивать данные с других доменов, при этом сервер должен явно разрешить такие запросы через специальные HTTP-заголовки. В Laravel настройка CORS сводится к редактированию <code>config/cors.php</code> и подключению соответствующего middleware.</p>
  </div>
</div>

<div id="sec-http-objects" class="section">
  <div class="section-title">HTTP-объекты Laravel</div>

  <div class="subsection" id="ho-overview">
    <div class="subsection-title"><i data-lucide="book-open"></i> Обзор: экосистема на Symfony HttpFoundation</div>
    <p class="text">Все объекты Laravel типа <code>RedirectResponse</code>, <code>Response</code>, <code>Request</code>, <code>JsonResponse</code> — это не просто «шаблоны», а стандартизированные объекты, которые Laravel использует для представления всего, что связано с HTTP-запросом и ответом. Они живут в пространстве имён <code>Illuminate\Http\*</code> и построены на фундаменте <strong>Symfony HttpFoundation Component</strong>. Laravel берёт этот компонент, расширяет его и добавляет свои удобные методы.</p>

    <p class="text"><strong>Ключевые объекты, с которыми работают постоянно:</strong></p>
    <table class="data-table">
      <thead><tr><th>Класс</th><th>Что представляет</th></tr></thead>
      <tbody>
        <tr><td><code>Illuminate\Http\Request</code></td><td>Входящий HTTP-запрос. Содержит <code>$_GET</code>, <code>$_POST</code>, <code>$_COOKIE</code>, <code>$_FILES</code>, заголовки. Получаете в контроллере: <code>store(Request $request)</code>.</td></tr>
        <tr><td><code>Illuminate\Http\Response</code></td><td>Базовый HTTP-ответ. Контент + статус + заголовки. Возвращается из контроллера: <code>return response('Hello', 200);</code></td></tr>
        <tr><td><code>Illuminate\Http\JsonResponse</code></td><td>Специализированный ответ для API. Автопреобразование в JSON и <code>Content-Type: application/json</code>. Пример: <code>return response()-&gt;json(['user' =&gt; $user]);</code></td></tr>
        <tr><td><code>Illuminate\Http\RedirectResponse</code></td><td>Перенаправление на другой URL. Генерирует HTTP-заголовок <code>Location</code>. Имеет цепочку методов для работы с сессией: <code>withErrors</code>, <code>withInput</code>, <code>with</code>.</td></tr>
        <tr><td><code>Illuminate\Support\Collection</code></td><td>Не HTTP-объект, но используется повсеместно. Обёртка над массивом с фильтрацией, трансформацией, агрегацией.</td></tr>
        <tr><td><code>Illuminate\Http\Client\Response</code></td><td>Ответ при <strong>исходящих</strong> HTTP-запросах через <code>Http::get(...)</code>. Тело, заголовки, методы <code>-&gt;json()</code>, <code>-&gt;body()</code>.</td></tr>
        <tr><td><code>Illuminate\Foundation\Application</code></td><td>Главный объект приложения (контейнер). Регистрация сервисов, разрешение зависимостей, доступ к конфигурации.</td></tr>
      </tbody>
    </table>
    <div class="remember-box">
      Весь этот механизм называется <strong>«Объекты HTTP-запроса и ответа»</strong> (HTTP Request &amp; Response Objects) — стандартный способ представления HTTP-взаимодействия в современных PHP-фреймворках (Laravel, Symfony, Slim).
    </div>
  </div>

  <div class="subsection" id="ho-request">
    <div class="subsection-title"><i data-lucide="download"></i> <code>Illuminate\Http\Request</code> — входящий запрос</div>
    <p class="text">Представляет входящий HTTP-запрос. Именно его вы получаете в контроллере: <code>public function store(Request $request)</code>.</p>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Что делает</th><th>Пример</th></tr></thead>
      <tbody>
        <tr><td><code>input($key, $default)</code></td><td>Получить значение поля из GET, POST или JSON</td><td><code>$request-&gt;input('name', 'guest')</code></td></tr>
        <tr><td><code>all()</code></td><td>Получить все входные данные как массив</td><td><code>$request-&gt;all()</code></td></tr>
        <tr><td><code>only($keys)</code></td><td>Только указанные поля</td><td><code>$request-&gt;only(['name', 'email'])</code></td></tr>
        <tr><td><code>except($keys)</code></td><td>Все, кроме указанных</td><td><code>$request-&gt;except(['_token'])</code></td></tr>
        <tr><td><code>has($key)</code></td><td>Существует ли поле</td><td><code>if ($request-&gt;has('file'))</code></td></tr>
        <tr><td><code>filled($key)</code></td><td>Существует и не пустое</td><td><code>if ($request-&gt;filled('name'))</code></td></tr>
        <tr><td><code>file($key)</code></td><td>Получить загруженный файл</td><td><code>$request-&gt;file('avatar')</code></td></tr>
        <tr><td><code>header($key, $default)</code></td><td>Получить заголовок</td><td><code>$request-&gt;header('Authorization')</code></td></tr>
        <tr><td><code>ip()</code></td><td>IP-адрес клиента</td><td><code>$request-&gt;ip()</code></td></tr>
        <tr><td><code>url()</code></td><td>Текущий URL без query</td><td>—</td></tr>
        <tr><td><code>fullUrl()</code></td><td>Полный URL с query</td><td>—</td></tr>
        <tr><td><code>method()</code></td><td>HTTP-метод (GET, POST...)</td><td>—</td></tr>
        <tr><td><code>route($key)</code></td><td>Параметры маршрута</td><td><code>$request-&gt;route('user')</code></td></tr>
        <tr><td><code>user()</code></td><td>Аутентифицированный пользователь</td><td><code>$request-&gt;user()</code></td></tr>
        <tr><td><code>validate($rules)</code></td><td>Запустить валидацию, вернуть массив проверенных данных</td><td><code>$request-&gt;validate([...])</code></td></tr>
        <tr><td><code>merge($data)</code></td><td>Добавить/перезаписать данные (используется в <code>prepareForValidation</code>)</td><td><code>$request-&gt;merge(['foo' =&gt; 'bar'])</code></td></tr>
        <tr><td><code>replace($data)</code></td><td>Полностью заменить входные данные</td><td>—</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection" id="ho-response">
    <div class="subsection-title"><i data-lucide="send"></i> <code>Illuminate\Http\Response</code> — базовый ответ</div>
    <p class="text">Создаётся через хелпер <code>response()</code>. Обычный HTTP-ответ с контентом, статусом и заголовками.</p>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Что делает</th><th>Пример</th></tr></thead>
      <tbody>
        <tr><td><code>content()</code></td><td>Получить тело ответа</td><td>—</td></tr>
        <tr><td><code>status()</code></td><td>Получить статус-код</td><td>—</td></tr>
        <tr><td><code>header($key, $value)</code></td><td>Установить один заголовок</td><td><code>response('Hello')-&gt;header('X-Foo', 'Bar')</code></td></tr>
        <tr><td><code>withHeaders($headers)</code></td><td>Установить несколько заголовков</td><td><code>-&gt;withHeaders(['X-A' =&gt; '1', 'X-B' =&gt; '2'])</code></td></tr>
        <tr><td><code>cookie($cookie)</code></td><td>Добавить cookie</td><td><code>-&gt;cookie('name', 'value', 60)</code></td></tr>
        <tr><td><code>setStatusCode($code)</code></td><td>Установить статус-код</td><td>—</td></tr>
        <tr><td><code>throwResponse()</code></td><td>Выбросить исключение с этим ответом (редко)</td><td>—</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection" id="ho-json">
    <div class="subsection-title"><i data-lucide="braces"></i> <code>Illuminate\Http\JsonResponse</code></div>
    <p class="text">Создаётся через <code>response()-&gt;json($data, $status, $headers)</code>. Автоматически ставит <code>Content-Type: application/json</code>.</p>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Что делает</th></tr></thead>
      <tbody>
        <tr><td><code>setData($data)</code></td><td>Установить данные, которые будут преобразованы в JSON</td></tr>
        <tr><td><code>getData($assoc = false)</code></td><td>Получить данные (как объект или массив)</td></tr>
        <tr><td><code>setStatusCode($code)</code></td><td>Установить HTTP-код</td></tr>
        <tr><td><code>header($key, $value)</code></td><td>Добавить заголовок</td></tr>
        <tr><td><code>withHeader($key, $value)</code></td><td>Алиас для <code>header</code></td></tr>
        <tr><td><code>setEncodingOptions($options)</code></td><td>Опции <code>json_encode</code> (например, <code>JSON_PRETTY_PRINT</code>, <code>JSON_UNESCAPED_UNICODE</code>)</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection" id="ho-redirect">
    <div class="subsection-title"><i data-lucide="corner-up-right"></i> <code>Illuminate\Http\RedirectResponse</code> + <code>withErrors</code> / <code>withInput</code></div>

    <p class="text">Этот объект отвечает за перенаправление пользователя на другой URL. Вместо контента он генерирует HTTP-заголовок <code>Location</code>, который говорит браузеру перейти на новый адрес. Класс предоставляет цепочку удобных методов для работы с сессией во время редиректа.</p>

    <p class="text"><strong>Что такое <code>withErrors()</code> и <code>withInput()</code>.</strong> Это не хелперы (глобальные функции), а <strong>методы объекта <code>RedirectResponse</code></strong>. Они используются для управления данными, которые сохраняются в сессии при редиректе:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>withErrors($validator)</code> — сохраняет ошибки валидации в сессию, чтобы они были доступны на странице, на которую происходит редирект, через переменную <code>$errors</code> в Blade.</li>
      <li><code>withInput()</code> — сохраняет в сессию введённые пользователем данные из запроса. Позволяет отобразить их обратно в полях формы через хелпер <code>old()</code>, чтобы пользователь не вводил всё заново.</li>
    </ul>

    <p class="text"><strong>Классический паттерн ручной валидации:</strong></p>
<pre><code><span class="c-key">if</span> (<span class="c-var">$validator</span>-&gt;<span class="c-fn">fails</span>()) {
    <span class="c-key">return</span> <span class="c-fn">redirect</span>()-&gt;<span class="c-fn">back</span>()
        -&gt;<span class="c-fn">withErrors</span>(<span class="c-var">$validator</span>)   <span class="c-comment">// 1. Сохраняем ошибки в сессию</span>
        -&gt;<span class="c-fn">withInput</span>();               <span class="c-comment">// 2. Сохраняем введённые данные</span>
}</code></pre>
    <p class="text">Что происходит: перенаправляете пользователя обратно на предыдущую страницу, передаёте в сессию ошибки валидации, передаёте в сессию введённые данные. На форме Blade автоматически покажет <code>$errors</code> и <code>old('field')</code>.</p>

    <p class="text"><strong>Отличие от хелперов.</strong> Хелперы — это глобальные функции: <code>old()</code>, <code>session()</code>, <code>redirect()</code>. <code>withErrors()</code> и <code>withInput()</code> — это методы, которые вызываются у объекта редиректа, возвращённого хелпером <code>redirect()</code>. Метод <code>withErrors()</code> может принимать не только валидатор, но и массив с сообщениями или строку.</p>

    <p class="text"><strong>Все ключевые методы RedirectResponse:</strong></p>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Что делает</th></tr></thead>
      <tbody>
        <tr><td><code>withErrors($provider)</code></td><td>Сохраняет ошибки в сессию. Принимает валидатор, MessageBag или массив.</td></tr>
        <tr><td><code>withInput()</code></td><td>Сохраняет текущие входные данные в сессию — читаются через <code>old()</code>.</td></tr>
        <tr><td><code>with($key, $value)</code></td><td>Сохраняет произвольные flash-данные в сессию.</td></tr>
        <tr><td><code>withCookie($cookie)</code></td><td>Добавляет cookie к ответу.</td></tr>
        <tr><td><code>header($key, $value)</code></td><td>Добавляет произвольный заголовок к редиректу.</td></tr>
        <tr><td><code>route($route, $parameters, $status)</code></td><td>Редирект на именованный маршрут.</td></tr>
        <tr><td><code>action($action, $parameters, $status)</code></td><td>Редирект на экшен контроллера.</td></tr>
        <tr><td><code>away($url, $status)</code></td><td>Редирект на внешний URL.</td></tr>
        <tr><td><code>back($status, $headers)</code></td><td>Редирект на предыдущую страницу.</td></tr>
        <tr><td><code>to($path, $status, $headers)</code></td><td>Редирект на произвольный путь.</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection" id="ho-collection">
    <div class="subsection-title"><i data-lucide="layers"></i> <code>Illuminate\Support\Collection</code></div>
    <p class="text">Создаётся через <code>collect($array)</code>. Обёртка над массивом с fluent-интерфейсом для фильтрации, трансформации и агрегации.</p>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Что делает</th><th>Пример</th></tr></thead>
      <tbody>
        <tr><td><code>all()</code></td><td>Все элементы как массив</td><td>—</td></tr>
        <tr><td><code>map($cb)</code></td><td>Преобразовать каждый элемент</td><td><code>-&gt;map(fn($x) =&gt; $x * 2)</code></td></tr>
        <tr><td><code>filter($cb)</code></td><td>Отфильтровать элементы</td><td><code>-&gt;filter(fn($x) =&gt; $x &gt; 10)</code></td></tr>
        <tr><td><code>pluck($key)</code></td><td>Извлечь колонку из вложенных массивов/объектов</td><td><code>-&gt;pluck('name')</code></td></tr>
        <tr><td><code>first($cb)</code> / <code>last($cb)</code></td><td>Первый / последний элемент</td><td>—</td></tr>
        <tr><td><code>count()</code></td><td>Количество элементов</td><td>—</td></tr>
        <tr><td><code>isEmpty()</code> / <code>isNotEmpty()</code></td><td>Проверка пустоты</td><td>—</td></tr>
        <tr><td><code>toArray()</code> / <code>toJson()</code></td><td>Преобразовать в массив / JSON</td><td>—</td></tr>
        <tr><td><code>keys()</code> / <code>values()</code></td><td>Получить ключи / сбросить ключи и получить значения</td><td>—</td></tr>
        <tr><td><code>unique($key)</code></td><td>Убрать дубликаты</td><td>—</td></tr>
        <tr><td><code>sortBy($cb)</code></td><td>Сортировать</td><td>—</td></tr>
        <tr><td><code>groupBy($key)</code></td><td>Сгруппировать по ключу</td><td>—</td></tr>
        <tr><td><code>reduce($cb, $init)</code></td><td>Свернуть в одно значение</td><td>—</td></tr>
        <tr><td><code>sum($key)</code> / <code>avg($key)</code></td><td>Сумма / среднее</td><td>—</td></tr>
        <tr><td><code>chunk($size)</code></td><td>Разбить на части</td><td>—</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection" id="ho-http-client">
    <div class="subsection-title"><i data-lucide="upload"></i> <code>Illuminate\Http\Client\Response</code></div>
    <p class="text">Возвращается при <strong>исходящих</strong> HTTP-запросах через <code>Http::get(...)</code>, <code>Http::post(...)</code> и т.д. Не путать с <code>Illuminate\Http\Response</code> (там — <em>входящие</em>).</p>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Что делает</th><th>Пример</th></tr></thead>
      <tbody>
        <tr><td><code>body()</code></td><td>Тело ответа как строка</td><td>—</td></tr>
        <tr><td><code>json($key, $default)</code></td><td>Разобранный JSON (опционально по ключу)</td><td><code>$response-&gt;json('data')</code></td></tr>
        <tr><td><code>object()</code></td><td>Вернуть JSON как <code>stdClass</code></td><td>—</td></tr>
        <tr><td><code>collect($key)</code></td><td>Вернуть JSON как Collection</td><td><code>$response-&gt;collect('items')-&gt;pluck('id')</code></td></tr>
        <tr><td><code>status()</code></td><td>HTTP-статус код</td><td>—</td></tr>
        <tr><td><code>ok()</code> / <code>successful()</code></td><td><code>true</code>, если 200–299</td><td>—</td></tr>
        <tr><td><code>redirect()</code></td><td><code>true</code>, если статус 30x</td><td>—</td></tr>
        <tr><td><code>clientError()</code> / <code>serverError()</code></td><td><code>true</code>, если 4xx / 5xx</td><td>—</td></tr>
        <tr><td><code>header($header)</code> / <code>headers()</code></td><td>Заголовок / все заголовки</td><td>—</td></tr>
        <tr><td><code>cookies()</code></td><td>Объект с куками</td><td>—</td></tr>
        <tr><td><code>transferStats()</code></td><td>Статистика передачи (время, TLS и т.д.)</td><td>—</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection" id="ho-app">
    <div class="subsection-title"><i data-lucide="box"></i> <code>Illuminate\Foundation\Application</code> (контейнер)</div>
    <p class="text">Главный объект приложения. Доступен через <code>app()</code>. Отвечает за разрешение зависимостей и регистрацию сервисов.</p>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Что делает</th><th>Пример</th></tr></thead>
      <tbody>
        <tr><td><code>make($abstract, $parameters)</code></td><td>Разрешить класс из контейнера</td><td><code>app()-&gt;make(SomeService::class)</code></td></tr>
        <tr><td><code>bind($abstract, $concrete, $shared)</code></td><td>Зарегистрировать привязку</td><td><code>app()-&gt;bind(Interface::class, Implementation::class)</code></td></tr>
        <tr><td><code>singleton($abstract, $concrete)</code></td><td>Зарегистрировать синглтон</td><td>—</td></tr>
        <tr><td><code>instance($abstract, $instance)</code></td><td>Зарегистрировать готовый объект</td><td>—</td></tr>
        <tr><td><code>call($callback, $parameters)</code></td><td>Вызвать функцию/метод с разрешёнными зависимостями</td><td>—</td></tr>
        <tr><td><code>environment()</code></td><td>Имя окружения (<code>local</code>, <code>production</code>...)</td><td>—</td></tr>
        <tr><td><code>runningInConsole()</code></td><td><code>true</code>, если запущено из консоли</td><td>—</td></tr>
        <tr><td><code>isDownForMaintenance()</code></td><td>Проверить, включён ли режим обслуживания</td><td>—</td></tr>
        <tr><td><code>configure($name)</code></td><td>Загрузить конфигурационный файл</td><td>—</td></tr>
      </tbody>
    </table>
    <p class="text">Подробно про контейнер и DI — см. отдельный раздел <strong>KB_13 Service Container</strong>.</p>
  </div>
</div>

<div id="sec-validation" class="section">
  <div class="section-title">Validation и FormRequest</div>
  <div class="subsection" id="val-purpose">
    <div class="subsection-title"><i data-lucide="book-open"></i> Зачем нужна валидация</div>
    <p class="text">Валидация — это процесс проверки данных, которые приходят от клиента (браузер, мобильное приложение, внешнее API), на соответствие определённым правилам. Это защитный барьер между внешним миром и вашей бизнес-логикой.</p>

    <p class="text"><strong>Основные цели валидации:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Безопасность.</strong> Защита от вредоносных данных (SQL-инъекции, XSS, подделка параметров). Проверяя тип, длину и формат, вы снижаете риск атак.</li>
      <li><strong>Целостность данных.</strong> Гарантия, что в базу попадут только корректные значения: email действительно является email-адресом, а <code>age</code> — целым числом в разумном диапазоне.</li>
      <li><strong>Удобство пользователя.</strong> Если пользователь ошибся в форме, вы можете сразу показать понятное сообщение, а не отдавать непонятный сбой.</li>
      <li><strong>Соблюдение бизнес-правил.</strong> Например, заказ должен содержать хотя бы один товар, скидка не может быть больше 50%. Это логика приложения, которую тоже проверяют на уровне валидации.</li>
    </ul>

    <p class="text">Laravel предлагает три уровня валидации: inline (<code>$request-&gt;validate(...)</code>), <code>Validator::make(...)</code>, и FormRequest как отдельный класс. FormRequest — предпочтительный путь для контроллеров: правила, кастомные сообщения, авторизация и подготовка данных собраны в одном месте, контроллер остаётся тонким.</p>
  </div>

  <div class="subsection" id="val-what">
    <div class="subsection-title"><i data-lucide="target"></i> Что именно валидируют</div>
    <p class="text">В веб-приложениях чаще всего валидируют:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Входящие данные запроса</strong> — параметры URL (<code>/users/{id}</code>), query-строку (<code>?page=2</code>), тело POST/PUT/PATCH-запроса (JSON, form-data, x-www-form-urlencoded).</li>
      <li><strong>Загруженные файлы</strong> — размер, тип MIME, наличие вирусов, размерности изображения.</li>
      <li><strong>Данные сессии/куки</strong> — реже, обычно уже проверены middleware и не требуют явной валидации.</li>
      <li><strong>Внешние данные</strong> — от сторонних API. Иногда их тоже проверяют перед использованием, если формат может измениться.</li>
    </ul>
    <p class="text">Валидация выполняется до контроллера (через FormRequest), либо внутри контроллера через <code>$request-&gt;validate()</code>. Вы определяете правила для каждого поля, и если данные не проходят проверку, Laravel автоматически возвращает ответ с ошибками: редирект назад для веб-форм или JSON со статусом <strong>422 Unprocessable Entity</strong> для API-запросов.</p>
  </div>

  <div class="subsection" id="val-lifecycle">
    <div class="subsection-title"><i data-lucide="rotate-cw"></i> Место валидации в жизненном цикле запроса</div>
    <p class="text">FormRequest подключается к контроллеру через внедрение зависимости (type-hint) в методе контроллера. Валидация происходит <strong>до вызова метода контроллера</strong>, на этапе разрешения зависимостей, сразу после того, как запрос прошёл все middleware.</p>

    <p class="text"><strong>Полная цепочка запроса до момента валидации:</strong></p>
    <ol style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Входящий запрос → <code>public/index.php</code> → Ядро (Kernel).</li>
      <li>Глобальные middleware (<code>TrustProxies</code>, <code>HandleCors</code>, <code>TrimStrings</code> и др.).</li>
      <li>Групповые middleware (<code>web</code> или <code>api</code>) — сессии, CSRF, throttle и т.д.</li>
      <li>Маршрутные middleware (указанные в <code>-&gt;middleware(...)</code>).</li>
      <li>Диспетчер роутера определяет контроллер и метод.</li>
      <li>Контейнер DI начинает разрешать зависимости для метода контроллера.</li>
      <li>Если среди параметров есть FormRequest — контейнер создаёт его экземпляр.</li>
      <li>В процессе создания <strong>автоматически запускается валидация</strong> (через интерфейс <code>ValidatesWhenResolved</code>).</li>
      <li>Если валидация провалена — выбрасывается <code>ValidationException</code>, которое перехватывается и превращается в ответ 422 Unprocessable Entity (или редирект с ошибками для веб-запросов).</li>
      <li>Если валидация успешна — экземпляр FormRequest передаётся в контроллер, выполнение продолжается.</li>
      <li>Контроллер получает уже провалидированные данные и выполняет бизнес-логику.</li>
    </ol>

    <div class="remember-box">
      <strong>Ключевое:</strong> валидация происходит <em>до</em> начала выполнения контроллера, на этапе разрешения зависимостей в контейнере. Это удобно — в контроллере вы уже уверены в корректности данных. Технически это достигается тем, что <code>FormRequest</code> реализует интерфейс <code>ValidatesWhenResolved</code>, и контейнер после создания вызывает у него метод <code>validateResolved()</code>.
    </div>
  </div>

  <div class="subsection" id="val-formrequest">
    <div class="subsection-title"><i data-lucide="list"></i> Компоненты FormRequest</div>
    <div class="card"><h3><code>authorize()</code></h3><p class="text">Возвращает bool. Если false — 403 без обращения к контроллеру. Сюда — авторизация на уровне действия (не аутентификация: для неё middleware).</p></div>
    <div class="card"><h3><code>rules()</code></h3><p class="text">Массив правил: ключ — имя поля, значение — pipe-string или массив правил. <code>'email' =&gt; ['required', 'email', Rule::unique('users')-&gt;ignore($this-&gt;user)]</code>. Доступ к маршрутным параметрам — через <code>$this-&gt;route('user')</code>.</p></div>
    <div class="card"><h3><code>messages()</code> и <code>attributes()</code></h3><p class="text">Кастомизация: <code>messages()</code> — переопределение текста; <code>attributes()</code> — человекочитаемые имена полей в сообщениях.</p></div>
    <div class="card"><h3><code>prepareForValidation()</code></h3><p class="text">Хук перед валидацией: можно изменить данные запроса (<code>$this-&gt;merge([...])</code>). Полезно для нормализации (trim, lowercase, конвертация типов).</p></div>
    <div class="card"><h3><code>passedValidation()</code></h3><p class="text">Хук после успешной валидации, перед возвратом в контроллер. Здесь — побочные действия, требующие валидных данных (логирование, dispatch event).</p></div>
    <div class="card"><h3>Доступ к валидным данным</h3><p class="text"><code>$request-&gt;validated()</code> — только валидные поля. <code>$request-&gt;safe()</code> — то же, но с методами <code>only/except/collect</code>. Не используйте <code>$request-&gt;all()</code> в контроллере после валидации — попадут невалидные поля.</p></div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="git-branch" style="width:14px;height:14px"></i> Почему <code>prepareForValidation()</code> без <code>return</code>, а остальные с <code>return</code></div>
    <p class="text">Всё просто: разные методы выполняют разные задачи, и их сигнатуры (возвращаемые типы) отражают их предназначение.</p>

    <p class="text"><strong>Методы с <code>return</code> — это геттеры.</strong> Они возвращают данные, которые Laravel использует, но ничего не меняют — просто отдают информацию:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>authorize()</code> — возвращает <code>bool</code>, чтобы фреймворк понял: разрешено или запрещено действие.</li>
      <li><code>rules()</code> — возвращает <code>array</code> правил, которые нужно применить к данным.</li>
      <li><code>messages()</code> — возвращает <code>array</code> кастомных сообщений об ошибках.</li>
      <li><code>attributes()</code> — возвращает <code>array</code> человекочитаемых имён полей.</li>
    </ul>

    <p class="text"><strong>Метод <code>prepareForValidation()</code> без <code>return</code> — это действие (mutator).</strong> Он мутирует (изменяет) данные запроса до запуска валидации. Задача — привести данные к нужному виду: обрезать пробелы, привести email к нижнему регистру, преобразовать типы, удалить лишние символы.</p>

    <p class="text">Ему не нужно ничего возвращать, потому что он работает с объектом <code>$this</code> напрямую — изменяет его свойства через <code>$this-&gt;merge()</code> или <code>$this-&gt;replace()</code>. Laravel после вызова <code>prepareForValidation()</code> продолжит работать с тем же объектом <code>$request</code>, но уже с изменёнными данными. Поэтому метод объявлен как <code>void</code> — он не возвращает значение, а выполняет побочное действие.</p>

    <div class="remember-box">
      <strong>Правило:</strong> если метод <em>отдаёт</em> данные фреймворку — <code>return array/bool</code>. Если <em>меняет</em> состояние объекта — <code>void</code>. Это правило работает не только в FormRequest, но и в целом в объектно-ориентированном дизайне.
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="lock" style="width:14px;height:14px"></i> Что такое <code>can()</code> в <code>authorize()</code></div>

    <p class="text">В типичном примере <code>authorize()</code> часто встречается такая проверка:</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">authorize</span>(): <span class="c-key">bool</span>
{
    <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">user</span>()-&gt;<span class="c-fn">can</span>(<span class="c-str">'update'</span>, <span class="c-var">$this</span>-&gt;<span class="c-fn">route</span>(<span class="c-str">'user'</span>));
}</code></pre>
    <p class="text">Это проверка, может ли текущий аутентифицированный пользователь выполнить действие <code>update</code> над конкретным объектом <code>User</code>. Разбор по частям:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>$this-&gt;user()</code> — возвращает текущего аутентифицированного пользователя (эквивалент <code>auth()-&gt;user()</code>).</li>
      <li><code>can('update', $user)</code> — вызывает механизм авторизации Laravel, который проверяет, есть ли у этого пользователя право на действие <code>update</code> над переданной моделью.</li>
      <li><code>$this-&gt;route('user')</code> — получает модель <code>User</code>, автоматически подставленную в маршрут через Route Model Binding. Для маршрута <code>/users/{user}</code> это объект пользователя, найденный по ID.</li>
    </ul>

    <p class="text"><strong>Откуда берётся логика проверки.</strong> Laravel ищет определение разрешения <code>update</code> для модели <code>User</code> в двух местах:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Политики (Policies)</strong> — классы, группирующие разрешения для конкретной модели. Создаются командой <code>php artisan make:policy UserPolicy</code>. Внутри определяются методы <code>view</code>, <code>create</code>, <code>update</code>, <code>delete</code> и др., каждый возвращает <code>bool</code>.</li>
      <li><strong>Gates</strong> — замыкания, зарегистрированные в <code>App\Providers\AuthServiceProvider</code> (или в <code>bootstrap/app.php</code> в L11+).</li>
    </ul>

    <p class="text">Пример политики:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">UserPolicy</span>
{
    <span class="c-key">public function</span> <span class="c-fn">update</span>(<span class="c-type">User</span> <span class="c-var">$currentUser</span>, <span class="c-type">User</span> <span class="c-var">$targetUser</span>)
    {
        <span class="c-key">return</span> <span class="c-var">$currentUser</span>-&gt;<span class="c-var">id</span> === <span class="c-var">$targetUser</span>-&gt;<span class="c-var">id</span>
            || <span class="c-var">$currentUser</span>-&gt;<span class="c-fn">isAdmin</span>();
    }
}</code></pre>
    <p class="text">Если такой политики нет — Laravel вернёт <code>false</code> (по умолчанию запрещено).</p>

    <p class="text"><strong>Зачем это нужно в <code>authorize()</code>.</strong> Метод <code>authorize()</code> в FormRequest вызывается <em>до</em> валидации. Если он возвращает <code>false</code> — Laravel сразу возвращает ответ <strong>403 Forbidden</strong>, даже не запуская проверку правил. Это даёт:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Разделение ответственности:</strong> авторизация (кто может делать) и валидация (что можно отправлять) живут отдельно.</li>
      <li><strong>Не дублировать логику:</strong> проверка прав вынесена в политики, и её можно использовать в контроллерах, Blade-представлениях, middleware.</li>
      <li><strong>Чистый код:</strong> в контроллере вы уже уверены, что пользователь имеет право на действие, и не пишете лишних <code>if</code>.</li>
    </ul>

    <div class="pitfall">
      <strong>Важно:</strong> <code>authorize()</code> — это <em>авторизация</em> (разрешение делать), а не <em>аутентификация</em> (вход в систему). За аутентификацию отвечает middleware <code>auth</code>. В FormRequest <code>$this-&gt;user()</code> вернёт объект только если пользователь уже аутентифицирован — иначе будет ошибка, поэтому ставьте middleware <code>auth</code> на маршрут. Если метод <code>authorize()</code> отсутствует или всегда возвращает <code>true</code> — проверка прав не выполняется вовсе, будьте осторожны.
    </div>

    <div class="remember-box">
      <strong>Итог:</strong> <code>can()</code> — встроенный метод Laravel для проверки прав, использующий политики или gates. Вместе с <code>authorize()</code> в FormRequest он даёт удобный способ централизованно управлять доступом к действиям, не засоряя контроллер.
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="check-check" style="width:14px;height:14px"></i> Пример <code>passedValidation()</code> — пост-валидационный хук</div>

    <p class="text">Этот хук вызывается <em>после</em> успешной валидации, но <em>до</em> того, как контроллер получит запрос. Полезен для действий, которые должны произойти только если данные прошли проверку, но не относятся к бизнес-логике самого контроллера — логирование, аудит, отправка событий.</p>

    <p class="text"><strong>Пример: логирование успешной валидации.</strong></p>
<pre><code><span class="c-key">class</span> <span class="c-type">UpdateUserRequest</span> <span class="c-key">extends</span> <span class="c-type">FormRequest</span>
{
    <span class="c-key">public function</span> <span class="c-fn">authorize</span>(): <span class="c-key">bool</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">user</span>()-&gt;<span class="c-fn">can</span>(<span class="c-str">'update'</span>, <span class="c-var">$this</span>-&gt;<span class="c-fn">route</span>(<span class="c-str">'user'</span>));
    }

    <span class="c-key">public function</span> <span class="c-fn">rules</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'email'</span> =&gt; <span class="c-str">'required|email|unique:users,email,'</span> . <span class="c-var">$this</span>-&gt;<span class="c-fn">route</span>(<span class="c-str">'user'</span>)-&gt;<span class="c-var">id</span>,
            <span class="c-str">'name'</span>  =&gt; <span class="c-str">'required|string|max:255'</span>,
        ];
    }

    <span class="c-comment">// Этот метод вызывается, если валидация прошла успешно</span>
    <span class="c-key">protected function</span> <span class="c-fn">passedValidation</span>(): <span class="c-key">void</span>
    {
        <span class="c-comment">// Логируем событие (кто и когда пытался обновить профиль)</span>
        <span class="c-type">Log</span>::<span class="c-fn">info</span>(<span class="c-str">'User profile update validated'</span>, [
            <span class="c-str">'user_id'</span>     =&gt; <span class="c-var">$this</span>-&gt;<span class="c-fn">user</span>()-&gt;<span class="c-var">id</span>,
            <span class="c-str">'target_user'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-fn">route</span>(<span class="c-str">'user'</span>)-&gt;<span class="c-var">id</span>,
            <span class="c-str">'data'</span>        =&gt; <span class="c-var">$this</span>-&gt;<span class="c-fn">validated</span>(),   <span class="c-comment">// доступны только валидные поля</span>
        ]);

        <span class="c-comment">// Можно отправить событие (например, админу о важном изменении)
        // event(new UserProfileValidated($this-&gt;user(), $this-&gt;validated()));</span>
    }
}</code></pre>

    <p class="text"><strong>Что здесь происходит.</strong> После того как правила проверены и ошибок нет, Laravel автоматически вызывает <code>passedValidation()</code>. Внутри вы имеете доступ ко всем валидным данным через <code>$this-&gt;validated()</code> или <code>$this-&gt;safe()</code>. Выполняются побочные действия — логирование, отправка событий, запись в кеш, уведомления. Эти действия не влияют на ответ контроллера, но выполняются в том же запросе.</p>

    <p class="text"><strong>Важные нюансы:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>passedValidation()</code> не должен возвращать значение (<code>void</code>) — он просто выполняет действия, как и <code>prepareForValidation()</code>.</li>
      <li>Если нужно <em>модифицировать</em> данные после валидации (например, добавить поле) — можно использовать <code>$this-&gt;merge()</code> и здесь, хотя обычно это делают в <code>prepareForValidation()</code>.</li>
      <li>В контроллере вы всё равно получите тот же объект <code>$request</code>, который уже содержит все изменения, сделанные в хуках.</li>
    </ul>

    <p class="text"><strong>Альтернативы.</strong> Вместо <code>passedValidation()</code> можно делать аналогичные действия прямо в контроллере после <code>$request-&gt;validated()</code>. Но вынос их в FormRequest делает контроллер тоньше и централизует логику, связанную именно с этим запросом. Если действия требуют асинхронности (отправка email, тяжёлые вычисления) — лучше использовать события или очереди, а не делать это синхронно в HTTP-запросе.</p>

    <div class="remember-box">
      <strong>Итог.</strong> <code>passedValidation()</code> — пост-валидационный хук, который выполняется только при успешной проверке. Идеально подходит для логирования, отправки уведомлений, побочных действий, зависящих от валидных данных. Для <em>изменения</em> данных перед валидацией — используйте <code>prepareForValidation()</code>, для <em>реакции</em> на валидные данные — <code>passedValidation()</code>.
    </div>
  </div>

  <div class="subsection" id="val-compare">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Сравнение способов валидации</div>
    <table class="data-table">
      <thead><tr><th>Способ</th><th>Где происходит</th><th>Преимущества</th><th>Недостатки</th></tr></thead>
      <tbody>
        <tr>
          <td><strong>FormRequest</strong></td>
          <td>До контроллера (на этапе DI)</td>
          <td>Всё в одном классе, переиспользуемость, чистота контроллера, авторизация и подготовка данных встроены</td>
          <td>Требуется создавать отдельные классы под каждый endpoint</td>
        </tr>
        <tr>
          <td><strong>Inline</strong> <code>$request-&gt;validate()</code></td>
          <td>Внутри контроллера</td>
          <td>Быстро, не требует отдельного класса — удобно для мелких endpoint'ов</td>
          <td>Загромождает контроллер, сложно переиспользовать между экшенами</td>
        </tr>
        <tr>
          <td><strong><code>Validator::make()</code></strong></td>
          <td>Где угодно (вручную)</td>
          <td>Полный контроль, можно использовать не только в контроллерах (jobs, commands, сервисы)</td>
          <td>Много ручного кода, нужно самому обрабатывать ошибки и решать что делать при провале</td>
        </tr>
      </tbody>
    </table>

    <p class="text"><strong>Важный нюанс.</strong> FormRequest наследуется от <code>Illuminate\Http\Request</code>, поэтому в контроллере вы также можете получать данные через <code>$request-&gt;input()</code>, <code>$request-&gt;file()</code> и т.д. После успешной валидации отфильтрованные данные доступны через <code>validated()</code>. Есть хуки <code>prepareForValidation()</code> для модификации данных <em>перед</em> валидацией и <code>passedValidation()</code> для действий <em>после</em> успешной проверки.</p>

    <div class="remember-box">
      <strong>Резюме.</strong> FormRequest — рекомендуемый способ для контроллеров: отделяет логику валидации и авторизации от бизнес-логики, делает контроллер тонким, а код — чистым и переиспользуемым. Inline подходит для одноразовых endpoint'ov, <code>Validator::make()</code> — когда валидация нужна вне контроллера.
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="code" style="width:14px;height:14px"></i> Все 3 способа — код и где брать данные</div>

    <p class="text"><strong>1. Inline — <code>$request-&gt;validate()</code></strong></p>
    <p class="text"><strong>Где:</strong> внутри метода контроллера. <strong>Паттерн:</strong> вызываешь <code>validate()</code> у объекта <code>$request</code>, передаёшь массив правил. <strong>Что на выходе:</strong> если ошибок нет — возвращает массив (<code>array</code>) проверенных данных. Если есть ошибки — автоматически выбрасывает <code>ValidationException</code> (редирект назад для web, JSON 422 для API).</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Http</span>\<span class="c-type">Request</span>;

<span class="c-key">class</span> <span class="c-type">PostController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>)
    {
        <span class="c-comment">// 1. Валидация</span>
        <span class="c-var">$validated</span> = <span class="c-var">$request</span>-&gt;<span class="c-fn">validate</span>([
            <span class="c-str">'title'</span> =&gt; <span class="c-str">'required|string|max:255'</span>,
            <span class="c-str">'body'</span>  =&gt; <span class="c-str">'required|string'</span>,
        ]);

        <span class="c-comment">// 2. Использование данных (массив)</span>
        <span class="c-type">Post</span>::<span class="c-fn">create</span>(<span class="c-var">$validated</span>);   <span class="c-comment">// ['title' =&gt; '...', 'body' =&gt; '...']</span>

        <span class="c-key">return</span> <span class="c-fn">redirect</span>()-&gt;<span class="c-fn">route</span>(<span class="c-str">'posts.index'</span>);
    }
}</code></pre>
    <p class="text"><strong>Где брать данные:</strong> переменная <code>$validated</code> (массив).</p>

    <p class="text" style="margin-top:14px"><strong>2. Вручную — <code>Validator::make()</code></strong></p>
    <p class="text"><strong>Где:</strong> где угодно — контроллер, сервисный класс, команда Artisan, очередь. <strong>Паттерн:</strong> создаёшь экземпляр валидатора через фасад <code>Validator</code>, передаёшь данные и правила. Ошибки не выбрасываются автоматически — их нужно проверять вручную через <code>fails()</code> или <code>validate()</code>.</p>

    <p class="text"><strong>Полная сигнатура</strong> — принимает 4 аргумента: данные, правила, сообщения, атрибуты:</p>
<pre><code><span class="c-var">$validator</span> = <span class="c-type">Validator</span>::<span class="c-fn">make</span>(<span class="c-var">$data</span>, <span class="c-var">$rules</span>, <span class="c-var">$messages</span>, <span class="c-var">$attributes</span>);
<span class="c-key">if</span> (<span class="c-var">$validator</span>-&gt;<span class="c-fn">fails</span>()) { <span class="c-comment">/* ... */</span> }
<span class="c-var">$validated</span> = <span class="c-var">$validator</span>-&gt;<span class="c-fn">validated</span>();</code></pre>

    <p class="text"><strong>Пример 1 — ручная проверка ошибок:</strong></p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Support</span>\<span class="c-type">Facades</span>\<span class="c-type">Validator</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Http</span>\<span class="c-type">Request</span>;

<span class="c-key">class</span> <span class="c-type">UserController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-key">public function</span> <span class="c-fn">import</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>)
    {
        <span class="c-var">$validator</span> = <span class="c-type">Validator</span>::<span class="c-fn">make</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">all</span>(), [
            <span class="c-str">'file'</span>    =&gt; <span class="c-str">'required|file|mimes:csv'</span>,
            <span class="c-str">'columns'</span> =&gt; <span class="c-str">'required|array|min:1'</span>,
        ]);

        <span class="c-comment">// Проверяем вручную</span>
        <span class="c-key">if</span> (<span class="c-var">$validator</span>-&gt;<span class="c-fn">fails</span>()) {
            <span class="c-key">return</span> <span class="c-fn">redirect</span>()-&gt;<span class="c-fn">back</span>()
                -&gt;<span class="c-fn">withErrors</span>(<span class="c-var">$validator</span>)
                -&gt;<span class="c-fn">withInput</span>();
        }

        <span class="c-comment">// Данные — через validated()</span>
        <span class="c-var">$validated</span> = <span class="c-var">$validator</span>-&gt;<span class="c-fn">validated</span>();   <span class="c-comment">// массив</span>

        <span class="c-comment">// Логика импорта...</span>
    }
}</code></pre>

    <p class="text"><strong>Пример 2 — принудительный выброс исключения</strong> (если хочешь чтобы вело себя как <code>$request-&gt;validate()</code>):</p>
<pre><code><span class="c-var">$validated</span> = <span class="c-type">Validator</span>::<span class="c-fn">make</span>(<span class="c-var">$data</span>, <span class="c-var">$rules</span>)-&gt;<span class="c-fn">validate</span>();
<span class="c-comment">// Теперь $validated — массив, либо исключение при ошибке</span></code></pre>
    <p class="text"><strong>Где брать данные:</strong> <code>$validator-&gt;validated()</code> (массив).</p>

    <p class="text" style="margin-top:14px"><strong>3. Отдельный класс — FormRequest</strong></p>
    <p class="text"><strong>Где:</strong> создаётся отдельный класс (например, <code>app/Http/Requests/StorePostRequest.php</code>), подключается в контроллере через type-hint. <strong>Паттерн:</strong> валидация и авторизация происходят ДО контроллера (на этапе DI). Если ошибка — контроллер даже не вызывается (редирект или 422). <strong>Что на выходе:</strong> в контроллере вызывается <code>validated()</code> или <code>safe()</code>, которые возвращают массив или объект.</p>
<pre><code><span class="c-comment">// 1. Класс запроса</span>
<span class="c-key">class</span> <span class="c-type">StorePostRequest</span> <span class="c-key">extends</span> <span class="c-type">FormRequest</span>
{
    <span class="c-key">public function</span> <span class="c-fn">authorize</span>() { <span class="c-key">return</span> <span class="c-key">true</span>; }

    <span class="c-key">public function</span> <span class="c-fn">rules</span>() {
        <span class="c-key">return</span> [
            <span class="c-str">'title'</span> =&gt; <span class="c-str">'required|string|max:255'</span>,
            <span class="c-str">'body'</span>  =&gt; <span class="c-str">'required|string'</span>,
        ];
    }
}

<span class="c-comment">// 2. Контроллер</span>
<span class="c-key">class</span> <span class="c-type">PostController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-comment">// Внедряем FormRequest, а не Request</span>
    <span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">StorePostRequest</span> <span class="c-var">$request</span>)
    {
        <span class="c-comment">// Валидация уже пройдена!

        // Вариант 1: массив проверенных данных</span>
        <span class="c-var">$data</span> = <span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>();       <span class="c-comment">// array</span>

        <span class="c-comment">// Вариант 2: объект с методами only/except</span>
        <span class="c-var">$safe</span> = <span class="c-var">$request</span>-&gt;<span class="c-fn">safe</span>();             <span class="c-comment">// Collection-подобный объект</span>
        <span class="c-var">$only</span> = <span class="c-var">$request</span>-&gt;<span class="c-fn">safe</span>()-&gt;<span class="c-fn">only</span>([<span class="c-str">'title'</span>]);   <span class="c-comment">// ['title' =&gt; '...']</span>

        <span class="c-type">Post</span>::<span class="c-fn">create</span>(<span class="c-var">$data</span>);
    }
}</code></pre>
    <p class="text"><strong>Где брать данные:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>$request-&gt;validated()</code> — массив.</li>
      <li><code>$request-&gt;safe()</code> — объект (позволяет цепочки <code>-&gt;only()</code>, <code>-&gt;except()</code>, <code>-&gt;all()</code>).</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="table" style="width:14px;height:14px"></i> Итоговая таблица «Где брать данные и ошибки»</div>
    <table class="data-table">
      <thead><tr><th>Способ</th><th>Сбор данных</th><th>Обработка ошибок</th></tr></thead>
      <tbody>
        <tr>
          <td>Inline (<code>$request-&gt;validate()</code>)</td>
          <td>Возвращает массив напрямую</td>
          <td>Автоматически (редирект / JSON 422)</td>
        </tr>
        <tr>
          <td><code>Validator::make()</code></td>
          <td><code>$validator-&gt;validated()</code> — массив</td>
          <td>Вручную через <code>fails()</code> или принудительно через <code>-&gt;validate()</code></td>
        </tr>
        <tr>
          <td>FormRequest</td>
          <td><code>$request-&gt;validated()</code> — массив;<br><code>$request-&gt;safe()</code> — объект</td>
          <td>Автоматически (до контроллера)</td>
        </tr>
      </tbody>
    </table>

    <div class="pitfall">
      <strong>Важное предостережение:</strong> не используйте <code>$request-&gt;all()</code> в контроллере после валидации — в <code>all()</code> могут попасть лишние (невалидные) поля, которые злоумышленник подсунул в запрос. Это открытая mass-assignment уязвимость. Всегда берите только те данные, которые прошли проверку — через <code>validated()</code> или <code>safe()</code>.
    </div>

    <div class="tip">
      В примере <code>Validator::make()</code> использованы <code>-&gt;withErrors($validator)-&gt;withInput()</code> — это <strong>не хелперы, а методы объекта <code>RedirectResponse</code></strong>. Подробный разбор в разделе <strong>HTTP-объекты Laravel → RedirectResponse</strong> (см. sidebar).
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="alert-triangle" style="width:14px;height:14px"></i> Что можно использовать везде, а что только в FormRequest</div>
    <p class="text"><strong>Саму валидацию</strong> (проверку данных по правилам) можно использовать почти везде — в контроллерах, сервисных классах, jobs, консольных командах, даже в моделях (хотя в моделях не рекомендуется — там место бизнес-логики, а не проверки входа).</p>

    <p class="text">А вот <strong>специфические методы</strong> — это эксклюзивные возможности класса <code>FormRequest</code>. Они <em>не работают</em> в <code>$request-&gt;validate()</code> или <code>Validator::make()</code>:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>authorize()</code> — авторизация до валидации, возврат 403 если false</li>
      <li><code>rules()</code> — массив правил</li>
      <li><code>messages()</code> — кастомные сообщения об ошибках</li>
      <li><code>attributes()</code> — человекочитаемые имена полей</li>
      <li><code>prepareForValidation()</code> — хук перед валидацией (нормализация данных)</li>
      <li><code>passedValidation()</code> — хук после успешной валидации</li>
    </ul>
    <p class="text">Если нужны эти хуки — только FormRequest. Если нужна просто проверка правил — подойдёт любой из трёх способов.</p>
  </div>

  <div class="subsection" id="val-practice">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: FormRequest с авторизацией и нормализацией</div>
<pre><code><span class="c-key">final class</span> <span class="c-type">UpdateUserRequest</span> <span class="c-key">extends</span> <span class="c-type">FormRequest</span>
{
    <span class="c-key">public function</span> <span class="c-fn">authorize</span>(): <span class="c-key">bool</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">user</span>()-&gt;<span class="c-fn">can</span>(<span class="c-str">'update'</span>, <span class="c-var">$this</span>-&gt;<span class="c-fn">route</span>(<span class="c-str">'user'</span>));
    }

    <span class="c-key">public function</span> <span class="c-fn">prepareForValidation</span>(): <span class="c-key">void</span>
    {
        <span class="c-var">$this</span>-&gt;<span class="c-fn">merge</span>([
            <span class="c-str">'email'</span> =&gt; <span class="c-fn">strtolower</span>(<span class="c-fn">trim</span>(<span class="c-var">$this</span>-&gt;<span class="c-fn">input</span>(<span class="c-str">'email'</span>, <span class="c-str">''</span>))),
        ]);
    }

    <span class="c-key">public function</span> <span class="c-fn">rules</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'email'</span> =&gt; [<span class="c-str">'required'</span>, <span class="c-str">'email'</span>,
                          <span class="c-type">Rule</span>::<span class="c-fn">unique</span>(<span class="c-str">'users'</span>)-&gt;<span class="c-fn">ignore</span>(<span class="c-var">$this</span>-&gt;<span class="c-fn">route</span>(<span class="c-str">'user'</span>))],
            <span class="c-str">'name'</span>  =&gt; [<span class="c-str">'required'</span>, <span class="c-str">'string'</span>, <span class="c-str">'max:255'</span>],
        ];
    }

    <span class="c-key">public function</span> <span class="c-fn">messages</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'email.unique'</span> =&gt; <span class="c-str">'Этот email уже занят'</span>,
        ];
    }
}

<span class="c-comment">// Контроллер — тонкий</span>
<span class="c-key">public function</span> <span class="c-fn">update</span>(<span class="c-type">UpdateUserRequest</span> <span class="c-var">$request</span>, <span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-type">JsonResponse</span>
{
    <span class="c-var">$user</span>-&gt;<span class="c-fn">update</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());
    <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>(<span class="c-var">$user</span>);
}
</code></pre>
  </div>

  <div class="subsection" id="val-pitfalls">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>$request-&gt;all()</code> вместо <code>validated()</code>.</strong> Получите всё, включая невалидные поля. Mass-assignment на модель — потенциальная дыра безопасности.</div>
    <div class="pitfall"><strong>2. <code>required</code> и пустые строки.</strong> <code>required</code> считает пустую строку валидной. Для строгости — <code>required|string|min:1</code>.</div>
    <div class="pitfall"><strong>3. <code>nullable</code> + другие правила.</strong> <code>nullable</code> отключает все последующие правила, если значение null. Без <code>nullable</code> — null приведёт к ошибке валидации.</div>
    <div class="pitfall"><strong>4. <code>sometimes</code> правило.</strong> <code>'name' =&gt; 'sometimes|required|string'</code> — проверять только если поле присутствует. Полезно для PATCH-запросов.</div>
    <div class="pitfall"><strong>5. <code>unique</code> без ignore при update.</strong> Без <code>Rule::unique('users')-&gt;ignore($this-&gt;user)</code> валидация падает на собственном email пользователя.</div>
    <div class="pitfall"><strong>6. Кастомное правило без <code>$fail()</code>.</strong> В Laravel 10+ кастомное правило через invokable использует <code>$fail($message)</code>; забывание этого вызова делает правило всегда проходящим.</div>
    <div class="pitfall"><strong>7. Массивы и dot-notation.</strong> <code>'items.*.sku' =&gt; 'required'</code> валидирует каждый элемент массива. Без <code>*</code> — только наличие массива как поля.</div>
    <div class="pitfall"><strong>8. <code>FormRequest::after()</code>.</strong> Laravel 11+ ввёл <code>after()</code> для дополнительных проверок после правил. Полезно для меж-полевой логики (например, <code>start_date &lt; end_date</code>), которую неудобно выразить простыми правилами.</div>
  </div>
</div>

<div id="sec-api-resources" class="section">
  <div class="section-title">API Resources — форматирование JSON-ответов</div>

  <div class="subsection" id="ar-overview">
    <div class="subsection-title"><i data-lucide="book-open"></i> Зачем нужны API Resources</div>
    <p class="text"><strong>API Resource</strong> — трансформационный слой между моделью Eloquent и JSON-ответом клиенту. Задача: единообразно форматировать данные, скрывать чувствительные поля, включать связанные ресурсы по необходимости, добавлять meta-информацию.</p>

    <p class="text"><strong>Проблема без ресурсов.</strong> Возврат <code>User::find($id)</code> напрямую отдаёт все атрибуты как есть — включая <code>password</code>, <code>remember_token</code>, timestamps, служебные поля. Форматирование дат, преобразование enum-ов, вложенные связи — всё это придётся делать вручную в контроллере или в модели через <code>toArray()</code>. Быстро превращается в кашу.</p>

<pre><code><span class="c-comment">// ❌ Без ресурса — контроллер отдаёт всё</span>
<span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>(<span class="c-type">User</span>::<span class="c-fn">with</span>(<span class="c-str">'posts'</span>)-&gt;<span class="c-fn">find</span>(<span class="c-var">$id</span>));
<span class="c-comment">// В JSON попадут: password, remember_token, email_verified_at,
// created_at/updated_at, все поля постов включая user_id...</span>

<span class="c-comment">// ✅ Через ресурс — контроль над форматом</span>
<span class="c-key">return</span> <span class="c-key">new</span> <span class="c-type">UserResource</span>(<span class="c-type">User</span>::<span class="c-fn">with</span>(<span class="c-str">'posts'</span>)-&gt;<span class="c-fn">find</span>(<span class="c-var">$id</span>));</code></pre>

    <p class="text"><strong>Что дают API Resources:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Явно контролируешь какие поля попадут в JSON.</li>
      <li>Единообразный формат ответов для всего API.</li>
      <li>Скрытие чувствительных полей (пароль, токены, внутренние ID).</li>
      <li>Форматирование дат, enum, sums (валюты, размеры).</li>
      <li>Условные поля — включаются только если явно загружены (защита от N+1).</li>
      <li>Meta-информация — пагинация, версия API, permissions.</li>
      <li>Легкое версионирование API (<code>V1\UserResource</code> vs <code>V2\UserResource</code>).</li>
    </ul>

    <p class="text"><strong>Создание:</strong></p>
<pre><code>php artisan make:resource <span class="c-type">UserResource</span>                    <span class="c-comment"># один ресурс</span>
php artisan make:resource <span class="c-type">UserCollection</span>                <span class="c-comment"># коллекция ресурсов</span>
php artisan make:resource <span class="c-type">Api/V1/PostResource</span>             <span class="c-comment"># в подпапке</span></code></pre>
    <p class="text">Файлы создаются в <code>app/Http/Resources/</code>.</p>
  </div>

  <div class="subsection" id="ar-jsonresource">
    <div class="subsection-title"><i data-lucide="file"></i> <code>JsonResource</code> — один ресурс</div>
    <p class="text">Наследуемся от <code>Illuminate\Http\Resources\Json\JsonResource</code>, метод <code>toArray()</code> возвращает массив, который станет JSON.</p>

<pre><code><span class="c-key">namespace</span> <span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Resources</span>;

<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Http</span>\<span class="c-type">Request</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Http</span>\<span class="c-type">Resources</span>\<span class="c-type">Json</span>\<span class="c-type">JsonResource</span>;

<span class="c-key">class</span> <span class="c-type">UserResource</span> <span class="c-key">extends</span> <span class="c-type">JsonResource</span>
{
    <span class="c-key">public function</span> <span class="c-fn">toArray</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'id'</span>         =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">id</span>,
            <span class="c-str">'name'</span>       =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">name</span>,
            <span class="c-str">'email'</span>      =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">email</span>,
            <span class="c-str">'role'</span>       =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">role</span>-&gt;<span class="c-var">value</span>,          <span class="c-comment">// enum</span>
            <span class="c-str">'created_at'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">created_at</span>-&gt;<span class="c-fn">toIso8601String</span>(),
        ];
    }
}</code></pre>

    <p class="text"><strong>Использование в контроллере:</strong></p>
<pre><code><span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Resources</span>\<span class="c-type">UserResource</span>;

<span class="c-key">public function</span> <span class="c-fn">show</span>(<span class="c-type">User</span> <span class="c-var">$user</span>)
{
    <span class="c-key">return</span> <span class="c-key">new</span> <span class="c-type">UserResource</span>(<span class="c-var">$user</span>);
}</code></pre>

    <p class="text"><strong>Результирующий JSON</strong> (автоматически оборачивается в <code>data</code>):</p>
<pre><code>{
    <span class="c-str">"data"</span>: {
        <span class="c-str">"id"</span>: <span class="c-num">1</span>,
        <span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>,
        <span class="c-str">"email"</span>: <span class="c-str">"alice@example.com"</span>,
        <span class="c-str">"role"</span>: <span class="c-str">"admin"</span>,
        <span class="c-str">"created_at"</span>: <span class="c-str">"2026-01-15T10:30:00+00:00"</span>
    }
}</code></pre>

    <div class="tip">
      Внутри <code>toArray</code> обращение к <code>$this</code> проксируется к самой модели — <code>$this-&gt;id</code>, <code>$this-&gt;email</code> и т.д. Это работает через магический <code>__get</code>: ресурс делегирует доступ к атрибутам исходной модели.
    </div>
  </div>

  <div class="subsection" id="ar-collection">
    <div class="subsection-title"><i data-lucide="list"></i> Collection — список ресурсов</div>
    <p class="text">Для массива объектов есть 2 способа.</p>

    <p class="text"><strong>Способ 1 — <code>::collection()</code></strong> (простой, для 90% случаев):</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">index</span>()
{
    <span class="c-key">return</span> <span class="c-type">UserResource</span>::<span class="c-fn">collection</span>(<span class="c-type">User</span>::<span class="c-fn">all</span>());
}</code></pre>
    <p class="text">Каждый <code>User</code> прогонится через <code>UserResource::toArray()</code>, получится массив в <code>data</code>:</p>
<pre><code>{
    <span class="c-str">"data"</span>: [
        {<span class="c-str">"id"</span>: <span class="c-num">1</span>, <span class="c-str">"name"</span>: <span class="c-str">"Alice"</span>, ...},
        {<span class="c-str">"id"</span>: <span class="c-num">2</span>, <span class="c-str">"name"</span>: <span class="c-str">"Bob"</span>, ...}
    ]
}</code></pre>

    <p class="text"><strong>Способ 2 — отдельный ResourceCollection</strong> (когда нужна кастомизация коллекции):</p>
<pre><code>php artisan make:resource <span class="c-type">UserCollection</span></code></pre>
<pre><code><span class="c-key">namespace</span> <span class="c-type">App</span>\<span class="c-type">Http</span>\<span class="c-type">Resources</span>;

<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Http</span>\<span class="c-type">Resources</span>\<span class="c-type">Json</span>\<span class="c-type">ResourceCollection</span>;

<span class="c-key">class</span> <span class="c-type">UserCollection</span> <span class="c-key">extends</span> <span class="c-type">ResourceCollection</span>
{
    <span class="c-key">public function</span> <span class="c-fn">toArray</span>(<span class="c-var">$request</span>): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'data'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-fn">collection</span>,
            <span class="c-str">'meta'</span> =&gt; [
                <span class="c-str">'total'</span>        =&gt; <span class="c-var">$this</span>-&gt;<span class="c-fn">collection</span>-&gt;<span class="c-fn">count</span>(),
                <span class="c-str">'active_count'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-fn">collection</span>-&gt;<span class="c-fn">where</span>(<span class="c-str">'active'</span>, <span class="c-key">true</span>)-&gt;<span class="c-fn">count</span>(),
            ],
        ];
    }
}

<span class="c-comment">// Использование</span>
<span class="c-key">return</span> <span class="c-key">new</span> <span class="c-type">UserCollection</span>(<span class="c-type">User</span>::<span class="c-fn">all</span>());</code></pre>

    <div class="tip">
      Обычно <code>::collection()</code> достаточно. <code>ResourceCollection</code> нужен только когда хотите добавить кастомные meta-поля или изменить структуру ответа для списка.
    </div>
  </div>

  <div class="subsection" id="ar-conditional">
    <div class="subsection-title"><i data-lucide="git-branch"></i> Условные поля — <code>when</code> / <code>whenLoaded</code></div>
    <p class="text">Не все поля нужны всегда. Ресурсы дают методы для условного включения полей.</p>

    <p class="text"><strong><code>when()</code></strong> — включить поле если условие истинно:</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">toArray</span>(<span class="c-var">$request</span>): <span class="c-key">array</span>
{
    <span class="c-key">return</span> [
        <span class="c-str">'id'</span>    =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">id</span>,
        <span class="c-str">'name'</span>  =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">name</span>,

        <span class="c-comment">// email виден только владельцу или админу</span>
        <span class="c-str">'email'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-fn">when</span>(
            <span class="c-var">$request</span>-&gt;<span class="c-fn">user</span>()?-&gt;<span class="c-fn">can</span>(<span class="c-str">'view-email'</span>, <span class="c-var">$this</span>-&gt;<span class="c-fn">resource</span>),
            <span class="c-var">$this</span>-&gt;<span class="c-var">email</span>
        ),

        <span class="c-comment">// admin_notes только если запросчик — админ</span>
        <span class="c-str">'admin_notes'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-fn">when</span>(
            <span class="c-var">$request</span>-&gt;<span class="c-fn">user</span>()?-&gt;<span class="c-fn">isAdmin</span>(),
            <span class="c-var">$this</span>-&gt;<span class="c-var">admin_notes</span>
        ),
    ];
}</code></pre>
    <p class="text">Если условие <code>false</code> — поле <em>не попадает в JSON вообще</em> (нет ключа).</p>

    <p class="text"><strong>🔥 <code>whenLoaded()</code></strong> — включить связь только если она загружена (защита от N+1):</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">toArray</span>(<span class="c-var">$request</span>): <span class="c-key">array</span>
{
    <span class="c-key">return</span> [
        <span class="c-str">'id'</span>    =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">id</span>,
        <span class="c-str">'title'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">title</span>,

        <span class="c-comment">// author включается ТОЛЬКО если ->with('author') был в query</span>
        <span class="c-str">'author'</span>   =&gt; <span class="c-key">new</span> <span class="c-type">UserResource</span>(<span class="c-var">$this</span>-&gt;<span class="c-fn">whenLoaded</span>(<span class="c-str">'author'</span>)),

        <span class="c-comment">// comments — тоже</span>
        <span class="c-str">'comments'</span> =&gt; <span class="c-type">CommentResource</span>::<span class="c-fn">collection</span>(<span class="c-var">$this</span>-&gt;<span class="c-fn">whenLoaded</span>(<span class="c-str">'comments'</span>)),

        <span class="c-comment">// pivot-атрибуты BelongsToMany</span>
        <span class="c-str">'assigned_at'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-fn">whenPivotLoaded</span>(<span class="c-str">'role_user'</span>, <span class="c-key">fn</span> () =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">pivot</span>-&gt;<span class="c-var">created_at</span>),
    ];
}</code></pre>

    <p class="text"><strong>Как это работает:</strong></p>
<pre><code><span class="c-comment">// Запрос БЕЗ загруженной связи</span>
<span class="c-key">return</span> <span class="c-key">new</span> <span class="c-type">PostResource</span>(<span class="c-type">Post</span>::<span class="c-fn">find</span>(<span class="c-num">1</span>));
<span class="c-comment">// JSON: { "id": 1, "title": "..." }  — author НЕ включён</span>

<span class="c-comment">// Запрос С загруженной связью</span>
<span class="c-key">return</span> <span class="c-key">new</span> <span class="c-type">PostResource</span>(<span class="c-type">Post</span>::<span class="c-fn">with</span>(<span class="c-str">'author'</span>)-&gt;<span class="c-fn">find</span>(<span class="c-num">1</span>));
<span class="c-comment">// JSON: { "id": 1, "title": "...", "author": {...} }  — author включён</span></code></pre>

    <div class="remember-box">
      <strong>Почему это критично.</strong> Если писать <code>'author' =&gt; new UserResource($this-&gt;author)</code> — на каждый Post будет отдельный SELECT к users (проблема N+1). <code>whenLoaded</code> исключает случай — если разработчик забыл <code>-&gt;with('author')</code>, поле просто не попадёт в JSON, а не сделает N запросов.
    </div>

    <p class="text"><strong>Другие условные методы:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>whenNotNull($this-&gt;phone)</code> — включить если не null.</li>
      <li><code>whenLoaded('posts', fn() =&gt; $this-&gt;posts-&gt;count(), 0)</code> — with default при не-загруженном.</li>
      <li><code>mergeWhen($condition, ['field1' =&gt; ..., 'field2' =&gt; ...])</code> — включить <em>несколько</em> полей одновременно.</li>
      <li><code>whenCounted('posts', $this-&gt;posts_count)</code> — если использовали <code>withCount('posts')</code>.</li>
    </ul>
  </div>

  <div class="subsection" id="ar-meta">
    <div class="subsection-title"><i data-lucide="info"></i> Meta / links / additional</div>
    <p class="text">Часто нужно вернуть не только основной ресурс, но и дополнительную мета-информацию: версия API, пагинация, права пользователя, ссылки.</p>

    <p class="text"><strong>Способ 1 — метод <code>with()</code>:</strong></p>
<pre><code><span class="c-key">class</span> <span class="c-type">UserResource</span> <span class="c-key">extends</span> <span class="c-type">JsonResource</span>
{
    <span class="c-key">public function</span> <span class="c-fn">toArray</span>(<span class="c-var">$request</span>): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [<span class="c-str">'id'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">id</span>, <span class="c-str">'name'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">name</span>];
    }

    <span class="c-comment">// Добавляется на верхний уровень JSON (рядом с data)</span>
    <span class="c-key">public function</span> <span class="c-fn">with</span>(<span class="c-var">$request</span>): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'meta'</span> =&gt; [
                <span class="c-str">'api_version'</span> =&gt; <span class="c-str">'1.0'</span>,
                <span class="c-str">'server_time'</span> =&gt; <span class="c-fn">now</span>()-&gt;<span class="c-fn">toIso8601String</span>(),
            ],
            <span class="c-str">'links'</span> =&gt; [
                <span class="c-str">'self'</span>  =&gt; <span class="c-fn">route</span>(<span class="c-str">'users.show'</span>, <span class="c-var">$this</span>-&gt;<span class="c-var">id</span>),
                <span class="c-str">'posts'</span> =&gt; <span class="c-fn">route</span>(<span class="c-str">'users.posts.index'</span>, <span class="c-var">$this</span>-&gt;<span class="c-var">id</span>),
            ],
        ];
    }
}</code></pre>
    <p class="text">Результат:</p>
<pre><code>{
    <span class="c-str">"data"</span>: { <span class="c-str">"id"</span>: <span class="c-num">1</span>, <span class="c-str">"name"</span>: <span class="c-str">"Alice"</span> },
    <span class="c-str">"meta"</span>: { <span class="c-str">"api_version"</span>: <span class="c-str">"1.0"</span>, ... },
    <span class="c-str">"links"</span>: { <span class="c-str">"self"</span>: <span class="c-str">"/api/users/1"</span>, ... }
}</code></pre>

    <p class="text"><strong>Способ 2 — <code>additional()</code></strong> при возврате:</p>
<pre><code><span class="c-key">return</span> (<span class="c-key">new</span> <span class="c-type">UserResource</span>(<span class="c-var">$user</span>))-&gt;<span class="c-fn">additional</span>([
    <span class="c-str">'meta'</span> =&gt; [<span class="c-str">'request_id'</span> =&gt; <span class="c-var">$request</span>-&gt;<span class="c-fn">header</span>(<span class="c-str">'X-Request-Id'</span>)],
]);</code></pre>
    <p class="text">Разница: <code>with()</code> — постоянные мета для этого ресурса. <code>additional()</code> — точечно для конкретного запроса.</p>
  </div>

  <div class="subsection" id="ar-pagination">
    <div class="subsection-title"><i data-lucide="rows-3"></i> Пагинация в ресурсах</div>
    <p class="text">Если модель пагинируется через <code>paginate()</code> — ресурс автоматически добавит поля <code>meta</code> и <code>links</code>:</p>

<pre><code><span class="c-key">public function</span> <span class="c-fn">index</span>()
{
    <span class="c-key">return</span> <span class="c-type">UserResource</span>::<span class="c-fn">collection</span>(<span class="c-type">User</span>::<span class="c-fn">paginate</span>(<span class="c-num">15</span>));
}</code></pre>

    <p class="text">Ответ:</p>
<pre><code>{
    <span class="c-str">"data"</span>: [
        { <span class="c-str">"id"</span>: <span class="c-num">1</span>, <span class="c-str">"name"</span>: <span class="c-str">"Alice"</span> },
        ...15 юзеров
    ],
    <span class="c-str">"links"</span>: {
        <span class="c-str">"first"</span>: <span class="c-str">"http://.../users?page=1"</span>,
        <span class="c-str">"last"</span>:  <span class="c-str">"http://.../users?page=10"</span>,
        <span class="c-str">"prev"</span>:  <span class="c-str">null</span>,
        <span class="c-str">"next"</span>:  <span class="c-str">"http://.../users?page=2"</span>
    },
    <span class="c-str">"meta"</span>: {
        <span class="c-str">"current_page"</span>: <span class="c-num">1</span>,
        <span class="c-str">"from"</span>:  <span class="c-num">1</span>,
        <span class="c-str">"last_page"</span>: <span class="c-num">10</span>,
        <span class="c-str">"path"</span>:  <span class="c-str">"http://.../users"</span>,
        <span class="c-str">"per_page"</span>: <span class="c-num">15</span>,
        <span class="c-str">"to"</span>:    <span class="c-num">15</span>,
        <span class="c-str">"total"</span>: <span class="c-num">150</span>
    }
}</code></pre>

    <p class="text">Работает и с <code>simplePaginate()</code> (без общего <code>total</code>) и с <code>cursorPaginate()</code> (курсорная пагинация — быстрее для больших таблиц).</p>
  </div>

  <div class="subsection" id="ar-wrapping">
    <div class="subsection-title"><i data-lucide="package"></i> Wrapping — обёртка <code>data</code></div>
    <p class="text">По умолчанию все ресурсы оборачиваются в <code>{ "data": ... }</code>. Иногда это не нужно.</p>

    <p class="text"><strong>Отключить обёртку для конкретного ресурса:</strong></p>
<pre><code><span class="c-key">class</span> <span class="c-type">UserResource</span> <span class="c-key">extends</span> <span class="c-type">JsonResource</span>
{
    <span class="c-key">public static</span> <span class="c-var">$wrap</span> = <span class="c-key">null</span>;   <span class="c-comment">// убрать обёртку</span>
}

<span class="c-comment">// или переименовать</span>
<span class="c-key">public static</span> <span class="c-var">$wrap</span> = <span class="c-str">'user'</span>;   <span class="c-comment">// вместо data — user</span></code></pre>

    <p class="text"><strong>Глобально отключить</strong> для всех ресурсов — в <code>AppServiceProvider::boot()</code>:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Http</span>\<span class="c-type">Resources</span>\<span class="c-type">Json</span>\<span class="c-type">JsonResource</span>;

<span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
{
    <span class="c-type">JsonResource</span>::<span class="c-fn">withoutWrapping</span>();
}</code></pre>

    <div class="pitfall">
      <strong>Не убирайте data-обёртку без причины.</strong> Она — стандарт REST API (JSON:API, JSend). Даёт место для <code>meta</code>, <code>links</code>, <code>errors</code> на верхнем уровне. Убирать оправдано если API имитирует контракт третьей стороны или используется старым клиентом.
    </div>
  </div>

  <div class="subsection" id="ar-status">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Кастомный статус и заголовки</div>
    <p class="text">Ресурс автоматически имеет HTTP-статус 200. Для 201 Created / 202 Accepted / других — используйте <code>-&gt;response()</code>:</p>

<pre><code><span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">StoreUserRequest</span> <span class="c-var">$request</span>)
{
    <span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">create</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());

    <span class="c-key">return</span> (<span class="c-key">new</span> <span class="c-type">UserResource</span>(<span class="c-var">$user</span>))
        -&gt;<span class="c-fn">response</span>()
        -&gt;<span class="c-fn">setStatusCode</span>(<span class="c-num">201</span>)
        -&gt;<span class="c-fn">header</span>(<span class="c-str">'Location'</span>, <span class="c-fn">route</span>(<span class="c-str">'users.show'</span>, <span class="c-var">$user</span>));
}</code></pre>

    <p class="text">Или через хук <code>withResponse</code> в самом ресурсе (для стандартного изменения):</p>
<pre><code><span class="c-key">class</span> <span class="c-type">UserResource</span> <span class="c-key">extends</span> <span class="c-type">JsonResource</span>
{
    <span class="c-key">public function</span> <span class="c-fn">toArray</span>(<span class="c-var">$request</span>): <span class="c-key">array</span> { <span class="c-comment">/* ... */</span> }

    <span class="c-key">public function</span> <span class="c-fn">withResponse</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>, <span class="c-type">JsonResponse</span> <span class="c-var">$response</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$response</span>-&gt;<span class="c-fn">header</span>(<span class="c-str">'X-API-Version'</span>, <span class="c-str">'1.0'</span>);
    }
}</code></pre>

    <div class="remember-box">
      <strong>Итог по API Resources:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li><code>JsonResource</code> — трансформация одной модели в JSON (метод <code>toArray</code>).</li>
        <li><code>::collection()</code> — для массива объектов, автопагинация через <code>-&gt;paginate()</code>.</li>
        <li><code>ResourceCollection</code> — когда нужна кастомная структура коллекции с meta.</li>
        <li><code>when()</code> / <code>whenLoaded()</code> — условные поля, критично для защиты от N+1.</li>
        <li><code>with()</code> и <code>additional()</code> — метаданные на верхнем уровне JSON.</li>
        <li>Пагинация работает автоматически (<code>links</code> + <code>meta</code>).</li>
        <li>Wrap в <code>data</code> — стандарт, отключайте только с причиной.</li>
        <li><code>-&gt;response()-&gt;setStatusCode(201)</code> — для custom HTTP-статуса.</li>
      </ul>
    </div>
  </div>
</div>

<div id="sec-eloquent" class="section">
  <div class="section-title">Eloquent — базовое</div>
  <div class="subsection" id="el-purpose">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Eloquent — реализация Active Record. Модель = таблица; экземпляр модели = строка. Удобство — мгновенный CRUD без boilerplate. Цена — лёгкость написания неоптимальных запросов (N+1, mass assignment) и сильная связанность бизнес-логики с инфраструктурой. Глубокий разбор (полиморфизм, observers, race conditions, chunk vs cursor) — в KB_12. Здесь — основа и базовые паттерны.</p>
  </div>

  <div class="subsection" id="el-features">
    <div class="subsection-title"><i data-lucide="list"></i> Основные возможности</div>
    <div class="card"><h3>Relations: hasOne / hasMany / belongsTo / belongsToMany</h3><p class="text">Decларация связей в модели. Eloquent создаёт магические геттеры (<code>$user-&gt;orders</code>) и query-методы (<code>$user-&gt;orders()</code>). Первое — collection после lazy load, второе — query builder для дальнейшей фильтрации.</p></div>
    <div class="card"><h3>Mass assignment: <code>$fillable</code> / <code>$guarded</code></h3><p class="text"><code>$fillable</code> — whitelist полей для <code>create</code>/<code>update</code> через массив. <code>$guarded = []</code> — открытый список (опасно). Без правильного списка <code>User::create($request-&gt;all())</code> пропустит <code>is_admin</code> в insert.</p></div>
    <div class="card"><h3>Casts</h3><p class="text">Автоматическое приведение типов: <code>'is_active' =&gt; 'boolean'</code>, <code>'meta' =&gt; 'array'</code>, <code>'paid_at' =&gt; 'datetime'</code>. Кастомные касты — реализация интерфейса <code>CastsAttributes</code>.</p></div>
    <div class="card"><h3>Scopes</h3><p class="text"><code>scopeActive($q) { $q-&gt;where('status', 'active'); }</code> — переиспользуемые куски запроса. Использование: <code>User::active()-&gt;get()</code>. Глобальные scopes автоматически применяются ко всем запросам модели.</p></div>
    <div class="card"><h3>Accessors / Mutators</h3><p class="text">Laravel 9+: <code>protected function name(): Attribute { return Attribute::make(get: ..., set: ...); }</code> — преобразование при чтении и записи. Кеш через <code>shouldCache()</code>.</p></div>
    <div class="card"><h3>Observers</h3><p class="text">Хуки жизненного цикла: <code>created</code>, <code>updated</code>, <code>deleted</code>, <code>retrieved</code>. Регистрация в Service Provider. Подробно — в KB_12.</p></div>
  </div>

  <div class="subsection" id="el-mass-assignment">
    <div class="subsection-title"><i data-lucide="shield-alert"></i> Mass Assignment — <code>$fillable</code> vs <code>$guarded</code></div>

    <p class="text"><strong>Что это.</strong> Mass assignment (массовое присваивание) — это возможность заполнить модель данными из массива одним вызовом:</p>
<pre><code><span class="c-type">User</span>::<span class="c-fn">create</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">all</span>());   <span class="c-comment">// все поля из запроса</span>
<span class="c-var">$user</span>-&gt;<span class="c-fn">update</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">all</span>());</code></pre>
    <p class="text">Это удобно, но <strong>опасно</strong>, если злоумышленник добавит в запрос лишние поля (например, <code>is_admin</code>, <code>role</code>, <code>password</code>). Без защиты он сможет изменить поля, которые не должен был трогать. Для контроля Laravel предоставляет два свойства модели.</p>

    <div class="card">
      <h3><code>$fillable</code> — белый список (whitelist)</h3>
      <p>Указывает, какие поля <em>разрешено</em> заполнять массово. Всё остальное игнорируется.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$fillable</span> = [<span class="c-str">'name'</span>, <span class="c-str">'email'</span>, <span class="c-str">'password'</span>];
}</code></pre>
      <p>Вызов <code>User::create($request-&gt;all())</code> заполнит только эти три поля. Если в запросе есть <code>is_admin</code> — он будет проигнорирован.</p>
    </div>

    <div class="card">
      <h3><code>$guarded</code> — чёрный список (blacklist)</h3>
      <p>Указывает, какие поля <em>запрещено</em> заполнять массово. Все остальные разрешены.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$guarded</span> = [<span class="c-str">'is_admin'</span>, <span class="c-str">'id'</span>];
}</code></pre>
      <p><code>User::create($request-&gt;all())</code> заполнит все поля, кроме <code>is_admin</code> и <code>id</code>.</p>
    </div>

    <div class="pitfall">
      <strong>Опасный вариант: <code>$guarded = []</code>.</strong> Если оставить пустой guarded (или не указать ничего в некоторых старых версиях) — <strong>все поля становятся разрешёнными</strong>. Тогда <code>User::create($request-&gt;all())</code> позволит злоумышленнику передать <code>is_admin=1</code> и стать администратором.
    </div>

    <div class="remember-box">
      <strong>Лучшая практика:</strong> всегда использовать <code>$fillable</code> с явным перечислением разрешённых полей. <code>$guarded</code> лучше не использовать, чтобы случайно не забыть защитить новое поле при добавлении колонки в таблицу.
    </div>

    <p class="text"><strong>Пример безопасного использования</strong> — валидация + <code>$fillable</code>:</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>)
{
    <span class="c-comment">// 1. Валидация</span>
    <span class="c-var">$validated</span> = <span class="c-var">$request</span>-&gt;<span class="c-fn">validate</span>([
        <span class="c-str">'name'</span>     =&gt; <span class="c-str">'required|string'</span>,
        <span class="c-str">'email'</span>    =&gt; <span class="c-str">'required|email|unique:users'</span>,
        <span class="c-str">'password'</span> =&gt; <span class="c-str">'required|min:8'</span>,
        <span class="c-str">'is_admin'</span> =&gt; <span class="c-str">'sometimes|boolean'</span>,   <span class="c-comment">// не дадим через mass assignment</span>
    ]);

    <span class="c-comment">// 2. Создание — только поля из $fillable</span>
    <span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">create</span>(<span class="c-var">$validated</span>);

    <span class="c-comment">// Или явно ограничить массив:
    // $user = User::create($request-&gt;only(['name', 'email', 'password']));</span>

    <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>(<span class="c-var">$user</span>);
}

<span class="c-comment">// Update — то же правило</span>
<span class="c-var">$user</span>-&gt;<span class="c-fn">update</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">only</span>([<span class="c-str">'name'</span>, <span class="c-str">'email'</span>]));</code></pre>

    <p class="text"><strong>Итог правил безопасности:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>$fillable</code> — явное разрешение (рекомендуется).</li>
      <li><code>$guarded</code> — явное запрещение (используйте с осторожностью, не оставлять пустым).</li>
      <li>Всегда ограничивайте массив данных, передаваемых в <code>create</code>/<code>update</code>: используйте <code>$request-&gt;validated()</code> (из FormRequest) или <code>$request-&gt;only(...)</code>, а не <code>$request-&gt;all()</code>.</li>
      <li>Никогда не доверяйте входящим данным без контроля — это фундаментальное правило безопасности.</li>
      <li>В Laravel 11+ и во всех современных версиях рекомендуется явно указывать <code>$fillable</code>, чтобы избежать случайных уязвимостей.</li>
    </ul>
  </div>

  <div class="subsection" id="el-casts">
    <div class="subsection-title"><i data-lucide="repeat"></i> Casts — типы атрибутов модели</div>

    <p class="text"><strong>Что это.</strong> Casts — простое указание типов для атрибутов модели. В массиве <code>$casts</code> перечисляете, к какому типу приводить каждое поле. Laravel <strong>автоматически преобразует данные при получении из БД и обратно при сохранении</strong>.</p>

    <p class="text"><strong>Как это выглядит:</strong></p>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$casts</span> = [
        <span class="c-str">'is_active'</span>  =&gt; <span class="c-str">'boolean'</span>,      <span class="c-comment">// в БД tinyint(1) → PHP bool</span>
        <span class="c-str">'meta'</span>       =&gt; <span class="c-str">'array'</span>,        <span class="c-comment">// JSON в БД → PHP массив</span>
        <span class="c-str">'paid_at'</span>    =&gt; <span class="c-str">'datetime'</span>,     <span class="c-comment">// строка в БД → Carbon</span>
        <span class="c-str">'settings'</span>   =&gt; <span class="c-str">'object'</span>,       <span class="c-comment">// JSON → stdClass</span>
        <span class="c-str">'age'</span>        =&gt; <span class="c-str">'integer'</span>,      <span class="c-comment">// всегда int</span>
        <span class="c-str">'price'</span>      =&gt; <span class="c-str">'float'</span>,        <span class="c-comment">// всегда float</span>
        <span class="c-str">'tags'</span>       =&gt; <span class="c-str">'collection'</span>,   <span class="c-comment">// JSON → Collection</span>
        <span class="c-str">'created_at'</span> =&gt; <span class="c-str">'timestamp'</span>,    <span class="c-comment">// дата → Unix timestamp</span>
    ];
}</code></pre>

    <p class="text">Теперь при обращении к этим полям — они уже будут нужного типа:</p>
<pre><code><span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-num">1</span>);
<span class="c-var">$isActive</span> = <span class="c-var">$user</span>-&gt;<span class="c-var">is_active</span>;   <span class="c-comment">// bool (true/false)</span>
<span class="c-var">$meta</span>     = <span class="c-var">$user</span>-&gt;<span class="c-var">meta</span>;        <span class="c-comment">// массив (не строка JSON)</span>
<span class="c-var">$paidAt</span>   = <span class="c-var">$user</span>-&gt;<span class="c-var">paid_at</span>;     <span class="c-comment">// Carbon (можно ->diffForHumans())</span>
<span class="c-var">$settings</span> = <span class="c-var">$user</span>-&gt;<span class="c-var">settings</span>;    <span class="c-comment">// stdClass</span></code></pre>
    <p class="text">А при сохранении они сами преобразуются обратно в формат БД.</p>

    <p class="text"><strong>Зачем это нужно:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Удобство</strong> — вместо ручного приведения типов в каждом месте, делаете один раз в модели.</li>
      <li><strong>Безопасность</strong> — всегда знаете, с каким типом работаете.</li>
      <li><strong>Работа с датами</strong> — автоматически получаете объект <code>Carbon</code>, можно сразу форматировать, сравнивать, вычитать.</li>
      <li><strong>JSON-поля</strong> — если храните данные в JSON, работаете с массивами/объектами напрямую, без ручного <code>json_decode</code>.</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="alert-triangle" style="width:14px;height:14px"></i> Важно: касты ≠ PHP-приведение типов</div>

    <p class="text">Касты в Laravel — это <strong>не</strong> приведение типов в смысле PHP-оператора <code>(int)</code> или <code>(bool)</code>. Это <strong>преобразование значения при чтении из БД и при записи в БД</strong>. Они не меняют тип переменной в момент присвоения — они меняют то, как значение <em>интерпретируется моделью</em> при доступе к атрибуту.</p>

    <p class="text"><strong>Как это работает на практике.</strong> Допустим, в модели указано:</p>
<pre><code><span class="c-key">protected</span> <span class="c-var">$casts</span> = [
    <span class="c-str">'is_active'</span> =&gt; <span class="c-str">'boolean'</span>,
    <span class="c-str">'meta'</span>      =&gt; <span class="c-str">'array'</span>,
];</code></pre>

    <p class="text"><strong>При чтении из БД:</strong> поле <code>is_active</code> хранится как <code>tinyint(1)</code> (0 или 1). Когда получаете модель через <code>User::find(1)</code> — Laravel приводит это значение к <code>bool</code>. Поэтому <code>$user-&gt;is_active</code> будет <code>true</code>/<code>false</code>, а не <code>0</code>/<code>1</code>.</p>

    <p class="text"><strong>При записи в БД:</strong> присваиваете <code>$user-&gt;is_active = 'yes'</code> (строка). При <code>$user-&gt;save()</code> Laravel преобразует её в <code>1</code> или <code>0</code> в зависимости от boolean-каста. В БД сохранится <code>1</code>.</p>

    <p class="text"><strong>Пример:</strong></p>
<pre><code><span class="c-var">$user</span> = <span class="c-key">new</span> <span class="c-type">User</span>();
<span class="c-var">$user</span>-&gt;<span class="c-var">is_active</span> = <span class="c-str">'anything'</span>;   <span class="c-comment">// это строка, но каст есть</span>
<span class="c-var">$user</span>-&gt;<span class="c-fn">save</span>();                     <span class="c-comment">// в БД сохранится 1, потому что 'anything' → true</span>

<span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-num">1</span>);
<span class="c-fn">var_dump</span>(<span class="c-var">$user</span>-&gt;<span class="c-var">is_active</span>);    <span class="c-comment">// bool(true)</span></code></pre>

    <p class="text"><strong>Тонкий момент.</strong> Каст применяется только при обращении к <strong>атрибуту модели</strong>, а не к переменной. Если сделать <code>$value = $user-&gt;is_active</code>, то <code>$value</code> получит уже bool (потому что доступ к атрибуту вернул bool). Если присвоил значение и сразу прочитал до сохранения — каст уже применится:</p>
<pre><code><span class="c-var">$user</span>-&gt;<span class="c-var">is_active</span> = <span class="c-num">0</span>;
<span class="c-fn">var_dump</span>(<span class="c-var">$user</span>-&gt;<span class="c-var">is_active</span>);   <span class="c-comment">// bool(false) — каст сработал сразу</span></code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="git-compare" style="width:14px;height:14px"></i> Сравнение с PHP-приведением</div>
    <table class="data-table">
      <thead><tr><th>PHP-приведение (например, <code>(int) $var</code>)</th><th>Laravel Casts</th></tr></thead>
      <tbody>
        <tr>
          <td>Меняет тип переменной в момент выполнения</td>
          <td>Меняет значение при доступе к атрибуту модели</td>
        </tr>
        <tr>
          <td>Глобально для всей программы</td>
          <td>Ограничено моделью Eloquent</td>
        </tr>
        <tr>
          <td>Не сохраняется в БД автоматически</td>
          <td>Применяется при сохранении в БД</td>
        </tr>
      </tbody>
    </table>

    <div class="remember-box">
      <strong>Итог по природе кастов.</strong> Касты — это не оператор приведения, а автоматическое преобразование данных на <em>границе</em> между БД и моделью. Они не меняют тип самой переменной в PHP-смысле, а лишь определяют, как значение будет интерпретироваться при доступе к атрибуту. Удобно чтобы всегда работать с данными в нужном формате, не заботясь о ручном преобразовании.
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="settings" style="width:14px;height:14px"></i> Кастомные касты (если стандартных мало)</div>
    <p class="text">Для преобразований со сложной логикой реализуйте интерфейс <code>CastsAttributes</code>:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Contracts</span>\<span class="c-type">Database</span>\<span class="c-type">Eloquent</span>\<span class="c-type">CastsAttributes</span>;

<span class="c-key">class</span> <span class="c-type">PasswordHashCast</span> <span class="c-key">implements</span> <span class="c-type">CastsAttributes</span>
{
    <span class="c-key">public function</span> <span class="c-fn">get</span>(<span class="c-var">$model</span>, <span class="c-var">$key</span>, <span class="c-var">$value</span>, <span class="c-var">$attributes</span>)
    {
        <span class="c-comment">// из БД → значение для модели</span>
        <span class="c-key">return</span> <span class="c-var">$value</span>;
    }

    <span class="c-key">public function</span> <span class="c-fn">set</span>(<span class="c-var">$model</span>, <span class="c-var">$key</span>, <span class="c-var">$value</span>, <span class="c-var">$attributes</span>)
    {
        <span class="c-comment">// перед сохранением → хешируем</span>
        <span class="c-key">return</span> <span class="c-fn">bcrypt</span>(<span class="c-var">$value</span>);
    }
}</code></pre>
    <p class="text">В модели:</p>
<pre><code><span class="c-key">protected</span> <span class="c-var">$casts</span> = [
    <span class="c-str">'password'</span> =&gt; <span class="c-type">PasswordHashCast</span>::<span class="c-key">class</span>,
];</code></pre>
    <p class="text">Теперь при присвоении <code>$user-&gt;password = 'secret'</code> значение автоматически хешируется при сохранении.</p>

    <div class="pitfall">
      <strong>Чего не стоит делать:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Не путайте <code>$casts</code> с <code>$fillable</code> — это разные вещи. Первое — про типы, второе — про mass assignment.</li>
        <li>Для <code>array</code>/<code>object</code>/<code>collection</code> полей в БД должен быть тип <code>json</code> (или <code>text</code>). Иначе данные не сохранятся корректно.</li>
      </ul>
    </div>

    <div class="remember-box">
      <strong>Резюме.</strong> <code>$casts</code> — простой способ задать типы для атрибутов модели. Поддерживает множество стандартных типов (<code>boolean</code>, <code>integer</code>, <code>float</code>, <code>string</code>, <code>datetime</code>, <code>date</code>, <code>timestamp</code>, <code>array</code>, <code>object</code>, <code>collection</code>, <code>encrypted</code>, <code>enum</code>). Для сложной логики — кастомные касты через <code>CastsAttributes</code>. Делает код чище, а работу с данными — предсказуемой и безопасной.
    </div>
  </div>

  <div class="subsection" id="el-scopes">
    <div class="subsection-title"><i data-lucide="filter"></i> Scopes — переиспользуемые фильтры для запросов</div>

    <p class="text"><strong>Что это.</strong> Scopes — методы в модели, которые позволяют выносить часто используемые условия в отдельные, переиспользуемые куски запросов. Делают код чище, а запросы — более читаемыми.</p>

    <div class="card">
      <h3>Локальные скоупы (Local Scopes)</h3>
      <p>Определяются методом с префиксом <code>scope</code>. Например, <code>scopeActive($query)</code>. При вызове возвращают <code>$query</code> с добавленными условиями.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">scopeActive</span>(<span class="c-var">$query</span>)
    {
        <span class="c-key">return</span> <span class="c-var">$query</span>-&gt;<span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'active'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">scopeRecentlyUpdated</span>(<span class="c-var">$query</span>)
    {
        <span class="c-key">return</span> <span class="c-var">$query</span>-&gt;<span class="c-fn">where</span>(<span class="c-str">'updated_at'</span>, <span class="c-str">'&gt;='</span>, <span class="c-fn">now</span>()-&gt;<span class="c-fn">subDays</span>(<span class="c-num">7</span>));
    }
}</code></pre>
      <p>Использование — префикс <code>scope</code> при вызове опускается, скоупы можно цеплять цепочкой:</p>
<pre><code><span class="c-var">$activeUsers</span>  = <span class="c-type">User</span>::<span class="c-fn">active</span>()-&gt;<span class="c-fn">get</span>();                        <span class="c-comment">// все активные</span>
<span class="c-var">$recentActive</span> = <span class="c-type">User</span>::<span class="c-fn">active</span>()-&gt;<span class="c-fn">recentlyUpdated</span>()-&gt;<span class="c-fn">get</span>();     <span class="c-comment">// цепочка</span></code></pre>
      <p>Внутри Laravel просто вызывает метод и добавляет условия в Query Builder.</p>
    </div>

    <div class="card">
      <h3>Глобальные скоупы (Global Scopes)</h3>
      <p>Применяются <strong>автоматически</strong> к каждому запросу модели, без явного указания. Например, всегда исключать удалённые записи (soft delete) или фильтровать по текущему пользователю / тенанту.</p>

      <p>Регистрация глобального скоупа:</p>
<pre><code><span class="c-comment">// В методе booted() модели</span>
<span class="c-key">protected static function</span> <span class="c-fn">booted</span>()
{
    <span class="c-key">static</span>::<span class="c-fn">addGlobalScope</span>(<span class="c-str">'active'</span>, <span class="c-key">function</span> (<span class="c-var">$query</span>) {
        <span class="c-var">$query</span>-&gt;<span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'active'</span>);
    });
}</code></pre>

      <p><strong>Автоматически применяется ко ВСЕМ типам запросов</strong> — <code>all()</code>, <code>find()</code>, <code>where()</code>, любые цепочки. Не нужно указывать его явно, он добавляется сам:</p>
<pre><code><span class="c-comment">// Все эти запросы автоматически получат WHERE status = 'active'</span>
<span class="c-type">User</span>::<span class="c-fn">all</span>();
<span class="c-comment">// SQL:  SELECT * FROM users WHERE status = 'active'</span>

<span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-num">5</span>);
<span class="c-comment">// SQL:  SELECT * FROM users WHERE status = 'active' AND id = 5</span>

<span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'age'</span>, <span class="c-num">30</span>)-&gt;<span class="c-fn">get</span>();
<span class="c-comment">// SQL:  SELECT * FROM users WHERE status = 'active' AND age = 30</span></code></pre>
      <p>То есть ты даже не указываешь глобальный скоуп явно — он применяется сам, во всех запросах модели.</p>

      <p>Отключение глобального скоупа:</p>
<pre><code><span class="c-type">User</span>::<span class="c-fn">withoutGlobalScope</span>(<span class="c-str">'status'</span>)-&gt;<span class="c-fn">get</span>();
<span class="c-comment">// или</span>
<span class="c-type">User</span>::<span class="c-fn">withoutGlobalScopes</span>()-&gt;<span class="c-fn">get</span>();</code></pre>
    </div>

    <p class="text"><strong>Зачем это нужно:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Сухость (DRY):</strong> условия не дублируются в каждом запросе.</li>
      <li><strong>Читаемость:</strong> <code>User::active()-&gt;get()</code> гораздо понятнее, чем <code>User::where('status', 'active')-&gt;get()</code>.</li>
      <li><strong>Глобальные скоупы</strong> полезны для многопользовательских систем (например, всегда фильтровать по текущей компании/тенанту).</li>
    </ul>

    <p class="text"><strong>Важные нюансы:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Локальные скоупы не изменяют существующий экземпляр <code>$query</code>, а возвращают новый с добавленными условиями.</li>
      <li>Глобальные скоупы могут мешать при выполнении сложных запросов — поэтому их можно отключать через <code>withoutGlobalScope</code> или <code>withoutGlobalScopes</code>.</li>
      <li>При использовании <code>SoftDeletes</code> уже есть встроенный глобальный скоуп, который отфильтровывает удалённые записи. Обход — <code>withTrashed()</code>, <code>onlyTrashed()</code>.</li>
    </ul>

    <div class="remember-box">
      <strong>Итог.</strong> <strong>Локальный</strong> скоуп — вызывается вручную (<code>User::active()-&gt;...</code>). <strong>Глобальный</strong> — применяется автоматически ко всем запросам модели. Используйте скоупы для выноса повторяющейся логики фильтрации, чтобы запросы были лаконичнее, а код — поддерживаемее.
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="wrench" style="width:14px;height:14px"></i> Что такое <code>Builder $query</code> в параметре скоупа</div>

    <p class="text">В методе скоупа вроде <code>scopePaid(Builder $q)</code> параметр <code>$q</code> — это экземпляр класса <code>Illuminate\Database\Eloquent\Builder</code>. Это тот самый объект-построитель запросов, который позволяет собирать SQL через цепочки методов:</p>
<pre><code><span class="c-var">$q</span>-&gt;<span class="c-fn">where</span>(...)-&gt;<span class="c-fn">orderBy</span>(...)-&gt;<span class="c-fn">limit</span>(...);</code></pre>
    <p class="text">Когда вы пишете <code>User::where(...)-&gt;get()</code>, каждый метод возвращает всё тот же <code>Builder</code> (или его модифицированную копию), что позволяет строить запрос пошагово.</p>

    <p class="text"><strong>Зачем он в скоупе.</strong> Скоуп получает этот билдер, чтобы добавить к нему дополнительные условия. После этого билдер возвращается в основной запрос, и выполнение продолжается.</p>

    <p class="text"><strong>Аналогия.</strong> Builder — это чертёж SQL-запроса. Постепенно добавляете детали: <code>WHERE</code>, <code>ORDER BY</code>, <code>LIMIT</code>. Скоуп добавляет свои детали, не создавая новый чертёж, а дополняя существующий.</p>

    <div class="tip">
      <strong>Уточнение про <code>: void</code>.</strong> В новых версиях Laravel принято указывать возвращаемый тип <code>void</code> у методов-скоупов — метод ничего не возвращает, а только изменяет переданный объект. Объект <code>$q</code> передаётся <em>по ссылке</em>, поэтому все изменения применяются к тому же экземпляру билдера. Писать <code>return $q</code> не нужно.
<pre style="margin-top:8px"><code><span class="c-key">public function</span> <span class="c-fn">scopePaid</span>(<span class="c-type">Builder</span> <span class="c-var">$q</span>): <span class="c-key">void</span>
{
    <span class="c-var">$q</span>-&gt;<span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'paid'</span>)-&gt;<span class="c-fn">whereNotNull</span>(<span class="c-str">'paid_at'</span>);
    <span class="c-comment">// return не нужен — $q уже модифицирован</span>
}</code></pre>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="lock" style="width:14px;height:14px"></i> Локальные скоупы работают только на чтение (для построения запросов)</div>

    <p class="text">Локальные скоупы (<code>scopeActive</code>, <code>scopePaid</code> и т.п.) <strong>не используются для установки или изменения данных</strong>. Они предназначены исключительно для фильтрации при <em>выборке</em> данных из БД.</p>

    <p class="text"><strong>Что делают скоупы:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Добавляют условия (<code>where</code>, <code>orderBy</code>, <code>limit</code> и т.д.) в запрос.</li>
      <li>Возвращают построитель запросов (<code>Builder</code>) с добавленными условиями.</li>
      <li>Вызываются в цепочке <em>перед</em> финальными методами (<code>get()</code>, <code>first()</code>, <code>paginate()</code>).</li>
    </ul>
<pre><code><span class="c-comment">// Скоуп добавляет условие WHERE status = 'active'</span>
<span class="c-key">public function</span> <span class="c-fn">scopeActive</span>(<span class="c-var">$query</span>)
{
    <span class="c-key">return</span> <span class="c-var">$query</span>-&gt;<span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'active'</span>);
}

<span class="c-comment">// Использование — только для выборки</span>
<span class="c-var">$activeUsers</span> = <span class="c-type">User</span>::<span class="c-fn">active</span>()-&gt;<span class="c-fn">get</span>();</code></pre>

    <p class="text"><strong>Для изменения данных при записи используются мутаторы или касты:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Мутатор (setter)</strong> — преобразует значение перед сохранением в БД.</li>
      <li><strong>Каст</strong> (<code>$casts</code>) — тоже влияет на сохранение (приводит к нужному типу).</li>
    </ul>
<pre><code><span class="c-comment">// Мутатор: перед сохранением приводит статус к нижнему регистру</span>
<span class="c-key">public function</span> <span class="c-fn">setStatusAttribute</span>(<span class="c-var">$value</span>)
{
    <span class="c-var">$this</span>-&gt;<span class="c-var">attributes</span>[<span class="c-str">'status'</span>] = <span class="c-fn">strtolower</span>(<span class="c-var">$value</span>);
}

<span class="c-comment">// Каст: гарантирует, что поле status всегда будет строкой</span>
<span class="c-key">protected</span> <span class="c-var">$casts</span> = [
    <span class="c-str">'status'</span> =&gt; <span class="c-str">'string'</span>,
];</code></pre>

    <div class="remember-box">
      <strong>Скоупы не имеют отношения к записи:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Не вызываются автоматически при <code>save()</code> или <code>create()</code>.</li>
        <li>Не влияют на мутаторы или касты.</li>
        <li>Их задача — только формировать SQL-запросы для <em>чтения</em>.</li>
      </ul>
    </div>
  </div>

  <div class="subsection" id="el-accessors">
    <div class="subsection-title"><i data-lucide="function-square"></i> Accessors и Mutators — преобразование на входе и выходе</div>

    <p class="text"><strong>Что это.</strong> Accessors и Mutators — методы в модели, которые позволяют преобразовывать атрибуты <strong>при чтении</strong> (accessor) и <strong>при записи</strong> (mutator). Работают на уровне модели, автоматически применяются при обращении к атрибуту через <code>$user-&gt;name</code>.</p>

    <div class="card">
      <h3>Accessor (геттер) — преобразование при чтении</h3>
      <p>Позволяет изменить значение поля, когда вы получаете его из модели. Синтаксис Laravel 9+ через <code>Attribute::make()</code>:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Database</span>\<span class="c-type">Eloquent</span>\<span class="c-type">Casts</span>\<span class="c-type">Attribute</span>;

<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-comment">// Получаем полное имя: first_name + last_name</span>
    <span class="c-key">protected function</span> <span class="c-fn">fullName</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">make</span>(
            <span class="c-var">get</span>: <span class="c-key">fn</span> (<span class="c-var">$value</span>, <span class="c-var">$attributes</span>)
                =&gt; <span class="c-var">$attributes</span>[<span class="c-str">'first_name'</span>] . <span class="c-str">' '</span> . <span class="c-var">$attributes</span>[<span class="c-str">'last_name'</span>]
        );
    }

    <span class="c-comment">// Приводим поле status к человекочитаемому виду</span>
    <span class="c-key">protected function</span> <span class="c-fn">statusText</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">make</span>(
            <span class="c-var">get</span>: <span class="c-key">fn</span> (<span class="c-var">$value</span>, <span class="c-var">$attributes</span>) =&gt; <span class="c-key">match</span> (<span class="c-var">$attributes</span>[<span class="c-str">'status'</span>]) {
                <span class="c-num">0</span>       =&gt; <span class="c-str">'Неактивен'</span>,
                <span class="c-num">1</span>       =&gt; <span class="c-str">'Активен'</span>,
                <span class="c-key">default</span> =&gt; <span class="c-str">'Неизвестно'</span>,
            }
        );
    }
}</code></pre>
      <p>Использование — обращение по имени метода в snake_case:</p>
<pre><code><span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-num">1</span>);
<span class="c-key">echo</span> <span class="c-var">$user</span>-&gt;<span class="c-var">full_name</span>;    <span class="c-comment">// "Иван Петров"</span>
<span class="c-key">echo</span> <span class="c-var">$user</span>-&gt;<span class="c-var">status_text</span>;  <span class="c-comment">// "Активен"</span></code></pre>
    </div>

    <div class="card">
      <h3>Mutator (сеттер) — преобразование при записи</h3>
      <p>Позволяет изменить значение перед сохранением в БД:</p>
<pre><code><span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-comment">// Перед сохранением хешируем пароль</span>
    <span class="c-key">protected function</span> <span class="c-fn">password</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">make</span>(
            <span class="c-var">set</span>: <span class="c-key">fn</span> (<span class="c-var">$value</span>) =&gt; <span class="c-fn">bcrypt</span>(<span class="c-var">$value</span>)
        );
    }

    <span class="c-comment">// Перед сохранением обрезаем пробелы и приводим к нижнему регистру</span>
    <span class="c-key">protected function</span> <span class="c-fn">email</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">make</span>(
            <span class="c-var">set</span>: <span class="c-key">fn</span> (<span class="c-var">$value</span>) =&gt; <span class="c-fn">strtolower</span>(<span class="c-fn">trim</span>(<span class="c-var">$value</span>))
        );
    }
}</code></pre>
      <p>Использование:</p>
<pre><code><span class="c-var">$user</span> = <span class="c-key">new</span> <span class="c-type">User</span>();
<span class="c-var">$user</span>-&gt;<span class="c-var">password</span> = <span class="c-str">'secret123'</span>;            <span class="c-comment">// будет захеширован при сохранении</span>
<span class="c-var">$user</span>-&gt;<span class="c-var">email</span>    = <span class="c-str">'  TEST@MAIL.COM '</span>;      <span class="c-comment">// станет 'test@mail.com'</span>
<span class="c-var">$user</span>-&gt;<span class="c-fn">save</span>();</code></pre>
    </div>

    <div class="card">
      <h3>Совмещение get и set в одном методе</h3>
      <p>Можно одновременно определить геттер и сеттер:</p>
<pre><code><span class="c-key">protected function</span> <span class="c-fn">name</span>(): <span class="c-type">Attribute</span>
{
    <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">make</span>(
        <span class="c-var">get</span>: <span class="c-key">fn</span> (<span class="c-var">$value</span>) =&gt; <span class="c-fn">ucfirst</span>(<span class="c-var">$value</span>),   <span class="c-comment">// при чтении — с большой буквы</span>
        <span class="c-var">set</span>: <span class="c-key">fn</span> (<span class="c-var">$value</span>) =&gt; <span class="c-fn">trim</span>(<span class="c-var">$value</span>)         <span class="c-comment">// при записи — убираем пробелы</span>
    );
}</code></pre>
    </div>

    <div class="card">
      <h3>Кеширование через <code>shouldCache()</code></h3>
      <p>Если аксессор выполняет тяжёлые вычисления (обращение к API, сложная обработка), можно закешировать результат на время жизни запроса:</p>
<pre><code><span class="c-key">protected function</span> <span class="c-fn">expensiveComputation</span>(): <span class="c-type">Attribute</span>
{
    <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">make</span>(
        <span class="c-var">get</span>: <span class="c-key">fn</span> () =&gt; <span class="c-var">$this</span>-&gt;<span class="c-fn">runHeavyCalculation</span>(),
    )-&gt;<span class="c-fn">shouldCache</span>();   <span class="c-comment">// результат сохраняется в памяти на время запроса</span>
}</code></pre>
      <p>При повторном обращении к <code>$user-&gt;expensive_computation</code> результат не будет вычисляться заново.</p>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="archive" style="width:14px;height:14px"></i> Старый синтаксис (до Laravel 9)</div>
    <p class="text">Раньше использовались методы <code>getXxxAttribute()</code> и <code>setXxxAttribute()</code>:</p>
<pre><code><span class="c-comment">// Accessor</span>
<span class="c-key">public function</span> <span class="c-fn">getFullNameAttribute</span>()
{
    <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-var">first_name</span> . <span class="c-str">' '</span> . <span class="c-var">$this</span>-&gt;<span class="c-var">last_name</span>;
}

<span class="c-comment">// Mutator</span>
<span class="c-key">public function</span> <span class="c-fn">setPasswordAttribute</span>(<span class="c-var">$value</span>)
{
    <span class="c-var">$this</span>-&gt;<span class="c-var">attributes</span>[<span class="c-str">'password'</span>] = <span class="c-fn">bcrypt</span>(<span class="c-var">$value</span>);
}</code></pre>
    <p class="text">Это всё ещё работает, но новый синтаксис через <code>Attribute::make()</code> предпочтительнее — даёт больше гибкости (кеширование, доступ ко всем атрибутам, объединение get + set в одном методе).</p>

    <p class="text"><strong>Когда использовать:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Accessor</strong> — когда нужно отдавать данные в другом формате, чем в БД (дата в другом формате, объединение полей, статус в виде текста).</li>
      <li><strong>Mutator</strong> — когда нужно подготовить данные перед сохранением (хеширование, нормализация, очистка).</li>
      <li><strong>Кеширование</strong> — когда вычисления дорогие или повторяются в течение одного запроса.</li>
    </ul>

    <div class="pitfall">
      <strong>Важные нюансы:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Accessors и mutators работают только при обращении к атрибуту через объект модели (<code>$user-&gt;name</code>). Если использовать <code>$user-&gt;getAttributes()</code> или напрямую массив <code>attributes</code> — они не применяются.</li>
        <li>При массовом присваивании (<code>create</code>, <code>update</code>) мутаторы срабатывают автоматически, если поля переданы через <code>$fillable</code>.</li>
        <li>Для производительности не используйте аксессоры внутри циклов без кеширования — это может породить много запросов или вычислений.</li>
      </ul>
    </div>

    <div class="remember-box">
      <strong>Итог.</strong> <strong>Accessor</strong> — преобразует значение при чтении. <strong>Mutator</strong> — преобразует значение при записи. <code>Attribute::make()</code> — основной способ в Laravel 9+. <code>shouldCache()</code> — кеширование результата аксессора на время запроса.
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="filter" style="width:14px;height:14px"></i> Ментальная модель: перехватчики на границе модели</div>
    <p class="text">Accessor и Mutator удобнее всего представлять как <strong>«перехватчики» данных на границе модели</strong>:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Accessor</strong> берёт сырое значение из БД и возвращает преобразованное — форматирование дат, объединение полей, перевод статусов в текст, приведение типов.</li>
      <li><strong>Mutator</strong> берёт входящее значение и преобразует его перед сохранением — хеширование, очистка, нормализация, приведение к нужному формату.</li>
    </ul>
    <p class="text">Они позволяют централизованно управлять тем, как данные выглядят на выходе и входе, без размазывания логики по контроллерам и представлениям. Типичные применения — объединение полей (<code>first_name + last_name → full_name</code>), хеширование паролей, нормализация email/телефонов, преобразование JSON/массивов, форматирование дат и валют.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="factory" style="width:14px;height:14px"></i> <code>Attribute::make()</code> — статический фабричный метод</div>
    <p class="text"><code>Attribute::make()</code> — это <strong>статический метод</strong> класса <code>Illuminate\Database\Eloquent\Casts\Attribute</code>. Он создаёт и возвращает экземпляр объекта <code>Attribute</code>, который используется для определения аксессора и/или мутатора.</p>
    <p class="text"><strong>Как это работает под капотом.</strong> Когда вы пишете:</p>
<pre><code><span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">make</span>(
    <span class="c-var">get</span>: <span class="c-key">fn</span> (<span class="c-var">$value</span>, <span class="c-var">$attributes</span>) =&gt; ...,
    <span class="c-var">set</span>: <span class="c-key">fn</span> (<span class="c-var">$value</span>) =&gt; ...
);</code></pre>
    <p class="text">на самом деле происходит вызов статического метода <code>make</code>, который принимает параметры с именами <code>get</code> и <code>set</code> (named arguments, доступные с PHP 8.0). Внутри метод создаёт объект <code>Attribute</code> и возвращает его. Этот объект Laravel сохраняет в кэш модели, и при обращении к атрибуту вызывает соответствующий колбэк.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="zap" style="width:14px;height:14px"></i> Работают автоматически — в контроллере ничего вызывать не надо</div>
    <p class="text">Вы не вызываете аксессоры и мутаторы отдельно в контроллере. Они срабатывают сами, когда вы обращаетесь к свойству модели или присваиваете значение. Контроллер просто работает с объектом модели, а аксессоры и мутаторы действуют как <em>перехватчики</em>.</p>

    <p class="text"><strong>Как это выглядит в контроллере:</strong></p>
<pre><code><span class="c-comment">// Модель User с аксессором fullName и мутатором password</span>
<span class="c-key">class</span> <span class="c-type">UserController</span> <span class="c-key">extends</span> <span class="c-type">Controller</span>
{
    <span class="c-key">public function</span> <span class="c-fn">show</span>(<span class="c-var">$id</span>)
    {
        <span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-var">$id</span>);

        <span class="c-comment">// Аксессор срабатывает автоматически при чтении поля full_name</span>
        <span class="c-key">return</span> <span class="c-fn">view</span>(<span class="c-str">'profile'</span>, [
            <span class="c-str">'fullName'</span> =&gt; <span class="c-var">$user</span>-&gt;<span class="c-var">full_name</span>,   <span class="c-comment">// вернёт "Иван Петров"</span>
        ]);
    }

    <span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>)
    {
        <span class="c-var">$user</span> = <span class="c-key">new</span> <span class="c-type">User</span>();
        <span class="c-var">$user</span>-&gt;<span class="c-var">password</span> = <span class="c-var">$request</span>-&gt;<span class="c-fn">input</span>(<span class="c-str">'password'</span>);   <span class="c-comment">// мутатор хеширует его автоматически</span>
        <span class="c-var">$user</span>-&gt;<span class="c-fn">save</span>();
        <span class="c-comment">// $user->password уже захеширован в БД</span>
    }
}</code></pre>

    <div class="remember-box">
      <strong>Где определять и кто вызывает.</strong> Аксессоры и мутаторы определяются только в <strong>модели</strong> (класс <code>User</code>, <code>Post</code> и т.д.). Контроллер просто использует модель — ему не нужно знать о преобразованиях. Всё происходит прозрачно: вы читаете <code>$user-&gt;full_name</code> — а там уже готовая строка.
    </div>
  </div>

  <div class="subsection" id="el-observers">
    <div class="subsection-title"><i data-lucide="eye"></i> Observers — наблюдатели за событиями модели</div>

    <p class="text"><strong>Что это.</strong> Observers (наблюдатели) — это классы, которые позволяют централизованно обрабатывать события жизненного цикла модели Eloquent (создание, обновление, удаление, восстановление). Вместо того чтобы писать логику в самой модели или размазывать её по контроллерам, выносите её в отдельный класс-наблюдатель.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="bell" style="width:14px;height:14px"></i> Какие события можно перехватывать</div>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Когда срабатывает</th></tr></thead>
      <tbody>
        <tr><td><code>retrieved</code></td><td>После того как модель извлечена из БД (<code>find</code>, <code>get</code>, <code>first</code>...)</td></tr>
        <tr><td><code>creating</code></td><td>Перед созданием новой записи (до <code>INSERT</code>)</td></tr>
        <tr><td><code>created</code></td><td>После создания записи (после <code>INSERT</code>)</td></tr>
        <tr><td><code>updating</code></td><td>Перед обновлением (до <code>UPDATE</code>)</td></tr>
        <tr><td><code>updated</code></td><td>После обновления</td></tr>
        <tr><td><code>saving</code></td><td>Перед сохранением — и для создания, и для обновления</td></tr>
        <tr><td><code>saved</code></td><td>После сохранения — и для создания, и для обновления</td></tr>
        <tr><td><code>deleting</code></td><td>Перед удалением</td></tr>
        <tr><td><code>deleted</code></td><td>После удаления</td></tr>
        <tr><td><code>restoring</code></td><td>Перед восстановлением (если используется <code>SoftDeletes</code>)</td></tr>
        <tr><td><code>restored</code></td><td>После восстановления</td></tr>
      </tbody>
    </table>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="hammer" style="width:14px;height:14px"></i> Как создать и использовать Observer</div>

    <p class="text"><strong>1. Создать класс через artisan:</strong></p>
<pre><code>php artisan make:observer <span class="c-type">UserObserver</span> --model=<span class="c-type">User</span></code></pre>

    <p class="text"><strong>2. Определить логику в методах:</strong></p>
<pre><code><span class="c-comment">// app/Observers/UserObserver.php</span>
<span class="c-key">class</span> <span class="c-type">UserObserver</span>
{
    <span class="c-key">public function</span> <span class="c-fn">created</span>(<span class="c-type">User</span> <span class="c-var">$user</span>)
    {
        <span class="c-comment">// Отправляем приветственное письмо</span>
        <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$user</span>-&gt;<span class="c-var">email</span>)-&gt;<span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">WelcomeMail</span>(<span class="c-var">$user</span>));
    }

    <span class="c-key">public function</span> <span class="c-fn">deleted</span>(<span class="c-type">User</span> <span class="c-var">$user</span>)
    {
        <span class="c-comment">// Удаляем аватарку пользователя из файловой системы</span>
        <span class="c-type">Storage</span>::<span class="c-fn">delete</span>(<span class="c-var">$user</span>-&gt;<span class="c-var">avatar_path</span>);
    }
}</code></pre>

    <p class="text"><strong>3. Зарегистрировать в сервис-провайдере</strong> (например, <code>App\Providers\AppServiceProvider</code>):</p>
<pre><code><span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Models</span>\<span class="c-type">User</span>;
<span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Observers</span>\<span class="c-type">UserObserver</span>;

<span class="c-key">public function</span> <span class="c-fn">boot</span>()
{
    <span class="c-type">User</span>::<span class="c-fn">observe</span>(<span class="c-type">UserObserver</span>::<span class="c-key">class</span>);
}</code></pre>

    <p class="text"><strong>Зачем это нужно:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Разделение ответственности:</strong> модель занимается только данными, а побочные действия (отправка писем, логирование, очистка кеша) вынесены в отдельный класс.</li>
      <li><strong>Переиспользуемость:</strong> логика не дублируется в контроллерах.</li>
      <li><strong>Тестируемость:</strong> Observer легко тестировать отдельно от контроллеров.</li>
      <li><strong>Чистота модели:</strong> модель не перегружена событиями.</li>
    </ul>

    <p class="text"><strong>Альтернативы:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Model Events</strong> — можно объявить через свойство <code>$dispatchesEvents</code> в модели.</li>
      <li><strong>Event Listeners</strong> — можно связать с моделью через события, но Observer — более высокоуровневый и удобный подход, когда все хуки для одной модели.</li>
    </ul>

    <div class="remember-box">
      <strong>Итог.</strong> Observer — класс, который слушает события модели и выполняет код в ответ. Позволяет держать модель тонкой, а побочную логику — в отдельном классе, что улучшает поддерживаемость и читаемость проекта. Регистрация: <code>User::observe(UserObserver::class)</code> в <code>AppServiceProvider::boot()</code>.
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="git-merge" style="width:14px;height:14px"></i> Зачем регистрировать Observers в провайдерах</div>
    <p class="text">Observers нужно регистрировать в Service Provider (например, <code>App\Providers\AppServiceProvider</code>), потому что:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Централизованное управление</strong> — все подписки на события моделей собираются в одном месте, что упрощает поддержку и поиск.</li>
      <li><strong>Гарантированное выполнение при старте</strong> — метод <code>boot()</code> провайдера вызывается после того, как все сервисы зарегистрированы, и модели уже доступны. Если зарегистрировать Observer прямо в модели или в контроллере, это может привести к дублированию или выполнению в неподходящий момент.</li>
      <li><strong>Единая точка входа</strong> — при смене логики или добавлении новых наблюдателей вы правите только провайдер, не разыскивая вызовы по всему коду.</li>
    </ul>
    <p class="text">Пример регистрации в <code>AppServiceProvider</code>:</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">boot</span>()
{
    <span class="c-type">User</span>::<span class="c-fn">observe</span>(<span class="c-type">UserObserver</span>::<span class="c-key">class</span>);
    <span class="c-type">Post</span>::<span class="c-fn">observe</span>(<span class="c-type">PostObserver</span>::<span class="c-key">class</span>);
}</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="clipboard-list" style="width:14px;height:14px"></i> Частые сценарии использования Observers</div>
    <p class="text">Observers идеально подходят для <strong>побочных действий (side-effects)</strong>, которые не являются основной бизнес-логикой, но должны происходить при определённых событиях модели.</p>
    <table class="data-table">
      <thead><tr><th>Событие</th><th>Типичные действия</th></tr></thead>
      <tbody>
        <tr>
          <td><code>created</code></td>
          <td>Отправка приветственного письма или SMS · создание связанных записей (например, профиля) · уведомление администратору · запись в лог регистрации · генерация реферальной ссылки · отправка события в очередь для аналитики</td>
        </tr>
        <tr>
          <td><code>updated</code></td>
          <td>Уведомление об изменении профиля (email/push) · инвалидация кеша (сброс списка пользователей) · логирование изменений (аудит) · синхронизация с CRM / внешним API · пересчёт агрегированных данных (рейтинг)</td>
        </tr>
        <tr>
          <td><code>deleted</code></td>
          <td>Удаление связанных файлов (аватары, документы) · очистка кеша · логирование удаления · уведомление о удалении (админу) · удаление зависимых записей (если нет каскадного удаления в БД)</td>
        </tr>
        <tr>
          <td><code>restored</code> (SoftDeletes)</td>
          <td>Восстановление файлов, если они были удалены · уведомление о восстановлении · обновление индексов поиска</td>
        </tr>
        <tr>
          <td><code>retrieved</code></td>
          <td>Логирование доступа к данным (редко, обычно для аудита чтения — GDPR, ISO)</td>
        </tr>
        <tr>
          <td><code>creating</code> / <code>updating</code></td>
          <td>Автоматическая установка значений (например, <code>slug</code>) · валидация, не охваченная стандартной · преобразование данных перед записью</td>
        </tr>
        <tr>
          <td><code>saving</code></td>
          <td>Общая обработка перед любым сохранением. Осторожно: срабатывает и при создании, и при обновлении.</td>
        </tr>
      </tbody>
    </table>

    <div class="remember-box">
      <strong>Почему это важно.</strong> Observers позволяют отделить побочные действия от кода контроллера и модели. Вместо того чтобы писать <code>Mail::send(...)</code> в контроллере каждый раз при создании пользователя — выносите это в Observer. Контроллеры становятся тоньше, код — переиспользуемым, тестирование — проще. Основные применения: уведомления, логирование, кеширование, очистка данных, синхронизация с внешними системами, генерация данных, аудит.
    </div>
  </div>

  <div class="subsection" id="el-relations">
    <div class="subsection-title"><i data-lucide="link"></i> Связи Eloquent — примеры всех типов</div>
    <p class="text">Eloquent позволяет описывать связи между моделями с помощью простых методов. Ниже — примеры для каждого из четырёх основных типов.</p>

    <div class="card">
      <h3>1. <code>hasOne</code> — один к одному</h3>
      <p>Модель <code>User</code> имеет один <code>Profile</code>.</p>
<pre><code><span class="c-comment">// app/Models/User.php</span>
<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">profile</span>(): <span class="c-type">HasOne</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">hasOne</span>(<span class="c-type">Profile</span>::<span class="c-key">class</span>);
    }
}</code></pre>
      <p>Использование:</p>
<pre><code><span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-num">1</span>);
<span class="c-var">$profile</span> = <span class="c-var">$user</span>-&gt;<span class="c-var">profile</span>;           <span class="c-comment">// динамическое свойство — экземпляр Profile</span>
<span class="c-var">$profile</span> = <span class="c-var">$user</span>-&gt;<span class="c-fn">profile</span>()-&gt;<span class="c-fn">first</span>();  <span class="c-comment">// через метод — Query Builder</span></code></pre>
    </div>

    <div class="card">
      <h3>2. <code>belongsTo</code> — обратная сторона hasOne / hasMany</h3>
      <p>Модель <code>Profile</code> принадлежит <code>User</code>.</p>
<pre><code><span class="c-comment">// app/Models/Profile.php</span>
<span class="c-key">class</span> <span class="c-type">Profile</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">user</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">belongsTo</span>(<span class="c-type">User</span>::<span class="c-key">class</span>);
    }
}</code></pre>
      <p>Использование:</p>
<pre><code><span class="c-var">$profile</span> = <span class="c-type">Profile</span>::<span class="c-fn">find</span>(<span class="c-num">1</span>);
<span class="c-var">$user</span> = <span class="c-var">$profile</span>-&gt;<span class="c-var">user</span>;           <span class="c-comment">// объект User</span>
<span class="c-var">$user</span> = <span class="c-var">$profile</span>-&gt;<span class="c-fn">user</span>()-&gt;<span class="c-fn">first</span>();  <span class="c-comment">// Query Builder</span></code></pre>
    </div>

    <div class="card">
      <h3>3. <code>hasMany</code> — один ко многим</h3>
      <p>Модель <code>User</code> имеет много <code>Post</code>.</p>
<pre><code><span class="c-comment">// app/Models/User.php</span>
<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">posts</span>(): <span class="c-type">HasMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">hasMany</span>(<span class="c-type">Post</span>::<span class="c-key">class</span>);
    }
}</code></pre>
      <p>Использование:</p>
<pre><code><span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-num">1</span>);
<span class="c-var">$posts</span> = <span class="c-var">$user</span>-&gt;<span class="c-var">posts</span>;                              <span class="c-comment">// Collection (все посты)</span>
<span class="c-var">$recent</span> = <span class="c-var">$user</span>-&gt;<span class="c-fn">posts</span>()-&gt;<span class="c-fn">latest</span>()-&gt;<span class="c-fn">limit</span>(<span class="c-num">5</span>)-&gt;<span class="c-fn">get</span>();   <span class="c-comment">// с условиями</span></code></pre>
    </div>

    <div class="card">
      <h3>4. <code>belongsToMany</code> — многие ко многим</h3>
      <p>Модель <code>User</code> может иметь много <code>Role</code>, и наоборот. Используется <strong>промежуточная таблица</strong> <code>role_user</code>.</p>
<pre><code><span class="c-comment">// app/Models/User.php</span>
<span class="c-key">class</span> <span class="c-type">User</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">roles</span>(): <span class="c-type">BelongsToMany</span>
    {
        <span class="c-comment">// второй параметр — имя pivot-таблицы</span>
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">belongsToMany</span>(<span class="c-type">Role</span>::<span class="c-key">class</span>, <span class="c-str">'role_user'</span>);
    }
}

<span class="c-comment">// app/Models/Role.php</span>
<span class="c-key">class</span> <span class="c-type">Role</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">public function</span> <span class="c-fn">users</span>(): <span class="c-type">BelongsToMany</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">belongsToMany</span>(<span class="c-type">User</span>::<span class="c-key">class</span>, <span class="c-str">'role_user'</span>);
    }
}</code></pre>
      <p>Использование:</p>
<pre><code><span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-num">1</span>);
<span class="c-var">$roles</span> = <span class="c-var">$user</span>-&gt;<span class="c-var">roles</span>;                                     <span class="c-comment">// Collection моделей Role</span>
<span class="c-var">$roles</span> = <span class="c-var">$user</span>-&gt;<span class="c-fn">roles</span>()-&gt;<span class="c-fn">where</span>(<span class="c-str">'name'</span>, <span class="c-str">'admin'</span>)-&gt;<span class="c-fn">get</span>();     <span class="c-comment">// Query Builder</span></code></pre>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="git-compare" style="width:14px;height:14px"></i> Динамическое свойство vs Query-метод</div>
    <table class="data-table">
      <thead><tr><th>Динамическое свойство (<code>$user-&gt;posts</code>)</th><th>Query-метод (<code>$user-&gt;posts()</code>)</th></tr></thead>
      <tbody>
        <tr>
          <td>Возвращает Collection — все записи уже загружены</td>
          <td>Возвращает Query Builder — можно дальше добавлять условия</td>
        </tr>
        <tr>
          <td>Выполняет запрос сразу при обращении к свойству (lazy loading)</td>
          <td>Запрос выполняется только при вызове <code>get()</code>, <code>first()</code>, <code>paginate()</code></td>
        </tr>
        <tr>
          <td>Удобно для вывода данных в представлениях</td>
          <td>Удобно для фильтрации, сортировки, пагинации</td>
        </tr>
        <tr>
          <td>Может привести к <strong>N+1 проблеме</strong></td>
          <td>Позволяет контролировать запросы, использовать <code>with()</code> для eager-загрузки</td>
        </tr>
      </tbody>
    </table>

    <p class="text"><strong>Пример метода для дополнительной фильтрации:</strong></p>
<pre><code><span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-num">1</span>);
<span class="c-var">$recentPosts</span> = <span class="c-var">$user</span>-&gt;<span class="c-fn">posts</span>()
    -&gt;<span class="c-fn">where</span>(<span class="c-str">'published_at'</span>, <span class="c-str">'&gt;='</span>, <span class="c-fn">now</span>()-&gt;<span class="c-fn">subMonth</span>())
    -&gt;<span class="c-fn">get</span>();</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="link-2" style="width:14px;height:14px"></i> Промежуточные таблицы (pivot) для <code>belongsToMany</code></div>
    <p class="text">Для <code>belongsToMany</code> можно получить промежуточные данные через свойство <code>pivot</code>:</p>
<pre><code><span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-num">1</span>);
<span class="c-key">foreach</span> (<span class="c-var">$user</span>-&gt;<span class="c-var">roles</span> <span class="c-key">as</span> <span class="c-var">$role</span>) {
    <span class="c-key">echo</span> <span class="c-var">$role</span>-&gt;<span class="c-var">pivot</span>-&gt;<span class="c-var">created_at</span>;   <span class="c-comment">// если в pivot есть поле created_at</span>
}</code></pre>
    <p class="text">Если нужно достать дополнительные атрибуты pivot — укажите их через <code>withPivot()</code>:</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">roles</span>(): <span class="c-type">BelongsToMany</span>
{
    <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">belongsToMany</span>(<span class="c-type">Role</span>::<span class="c-key">class</span>)-&gt;<span class="c-fn">withPivot</span>(<span class="c-str">'expires_at'</span>);
}</code></pre>

    <div class="remember-box">
      <strong>Итог по типам связей:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li><code>hasOne</code> — один к одному</li>
        <li><code>hasMany</code> — один ко многим</li>
        <li><code>belongsTo</code> — обратная сторона <code>hasOne</code> или <code>hasMany</code></li>
        <li><code>belongsToMany</code> — многие ко многим (с pivot-таблицей)</li>
      </ul>
      Связи описываются в моделях и дают удобный доступ к связанным данным через динамические свойства (Collection) или Query Builder для сложных запросов. Более сложные типы (<code>hasManyThrough</code>, <code>morphTo</code>, <code>morphMany</code>) — в KB_12 Eloquent Advanced.
    </div>
  </div>

  <div class="subsection" id="el-practice">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: модель заказа</div>
<pre><code><span class="c-key">final class</span> <span class="c-type">Order</span> <span class="c-key">extends</span> <span class="c-type">Model</span>
{
    <span class="c-key">protected</span> <span class="c-var">$fillable</span> = [<span class="c-str">'user_id'</span>, <span class="c-str">'status'</span>, <span class="c-str">'total_minor'</span>, <span class="c-str">'currency'</span>];

    <span class="c-key">protected function</span> <span class="c-fn">casts</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'total_minor'</span> =&gt; <span class="c-str">'integer'</span>,
            <span class="c-str">'paid_at'</span>     =&gt; <span class="c-str">'datetime'</span>,
            <span class="c-str">'meta'</span>        =&gt; <span class="c-type">AsArrayObject</span>::<span class="c-key">class</span>,
        ];
    }

    <span class="c-key">public function</span> <span class="c-fn">user</span>(): <span class="c-type">BelongsTo</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">belongsTo</span>(<span class="c-type">User</span>::<span class="c-key">class</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">scopePaid</span>(<span class="c-type">Builder</span> <span class="c-var">$q</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$q</span>-&gt;<span class="c-fn">where</span>(<span class="c-str">'status'</span>, <span class="c-str">'paid'</span>)-&gt;<span class="c-fn">whereNotNull</span>(<span class="c-str">'paid_at'</span>);
    }

    <span class="c-key">protected function</span> <span class="c-fn">totalMajor</span>(): <span class="c-type">Attribute</span>
    {
        <span class="c-key">return</span> <span class="c-type">Attribute</span>::<span class="c-fn">get</span>(<span class="c-key">fn</span> () =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">total_minor</span> / <span class="c-num">100</span>);
    }
}

<span class="c-comment">// Использование</span>
<span class="c-type">Order</span>::<span class="c-fn">paid</span>()-&gt;<span class="c-fn">where</span>(<span class="c-str">'currency'</span>, <span class="c-str">'USD'</span>)-&gt;<span class="c-fn">with</span>(<span class="c-str">'user'</span>)-&gt;<span class="c-fn">get</span>();
</code></pre>
  </div>

  <div class="subsection" id="el-pitfalls">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>$guarded = []</code> в проде.</strong> Открывает все колонки для mass assignment. <code>User::create($request-&gt;all())</code> пропустит <code>is_admin</code> в insert. Используйте явный <code>$fillable</code>.</div>
    <div class="pitfall"><strong>2. <code>save()</code> на свежей коллекции.</strong> <code>$orders = $user-&gt;orders; $orders-&gt;each(fn($o) =&gt; $o-&gt;save())</code> — N запросов вместо одного. Используйте <code>$user-&gt;orders()-&gt;update([...])</code>.</div>
    <div class="pitfall"><strong>3. <code>relation</code> vs <code>relation()</code>.</strong> <code>$user-&gt;orders</code> — collection (lazy-loaded). <code>$user-&gt;orders()</code> — query builder. Путаница приводит к лишним запросам или ошибкам.</div>
    <div class="pitfall"><strong>4. <code>updated_at</code> при <code>update</code> массивом.</strong> Laravel автоматически обновит <code>updated_at</code>. Если нужно избежать (миграция данных) — <code>$model-&gt;timestamps = false</code> или <code>DB::table()</code>.</div>
    <div class="pitfall"><strong>5. JSON-каст и dirty detection.</strong> Изменение вложенного значения в JSON: <code>$model-&gt;meta['key'] = 'x'</code> не пометит модель dirty. Используйте <code>AsArrayObject</code> или <code>AsCollection</code>.</div>
    <div class="pitfall"><strong>6. <code>find</code> с массивом не возвращает ошибку.</strong> <code>User::find([1, 2, 99])</code> — вернёт только существующих, без warning'а. Если важно полное соответствие — проверяйте count.</div>
    <div class="pitfall"><strong>7. Tinker и dirty state.</strong> В tinker отредактированная модель не сохраняется автоматически; забыли <code>save()</code> — изменения теряются.</div>
    <div class="pitfall"><strong>8. <code>chunk</code> с <code>update</code>.</strong> <code>User::chunk(100, fn($users) =&gt; $users-&gt;each-&gt;update(...))</code> — после первого chunk PK сдвигается, следующий chunk пропускает строки. Используйте <code>chunkById</code>.</div>
  </div>
</div>

<div id="sec-cache" class="section">
  <div class="section-title">Cache</div>
  <div class="subsection" id="cache-purpose">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Кеш — способ обменять память на CPU/IO. Laravel предлагает единый интерфейс над несколькими бэкендами: <code>file</code>, <code>database</code>, <code>redis</code>, <code>memcached</code>, <code>array</code> (in-memory, для тестов). Понимание различий между бэкендами, паттернов инвалидации и потенциальных race conditions — обязательное знание для middle.</p>

    <div class="tip">
      <strong>Термин: инвалидация.</strong> <strong>Инвалидация</strong> — это процесс объявления данных или объектов недействительными и их последующего удаления или обновления, потому что исходная информация изменилась. В контексте кеша: если в БД изменился <code>User::find(1)</code>, старая закешированная версия становится «недействительной» — её надо удалить (<code>Cache::forget('user:1')</code>) или перезаписать, иначе пользователь будет видеть устаревшие данные. Инвалидация — одна из самых сложных задач в кешировании («There are only two hard things in Computer Science: cache invalidation and naming things»).
    </div>
  </div>

  <div class="subsection" id="cache-drivers">
    <div class="subsection-title"><i data-lucide="hard-drive"></i> Драйверы кеширования — не только Redis</div>

    <p class="text">Redis — это не единственное и даже не стандартное кеширование в Laravel. Это один из многих вариантов (<strong>драйверов</strong>), которые фреймворк поддерживает «из коробки». Laravel предоставляет <strong>единый API</strong> для работы с разными системами хранения — код одинаковый, меняется только конфигурация.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="table" style="width:14px;height:14px"></i> Поддерживаемые драйверы</div>
    <table class="data-table">
      <thead><tr><th>Драйвер</th><th>Где хранит</th><th>Когда использовать</th></tr></thead>
      <tbody>
        <tr>
          <td><code>file</code></td>
          <td>Файлы на сервере в <code>storage/framework/cache/data</code></td>
          <td>Самый простой вариант. Локальная разработка, маленькие проекты без внешних сервисов.</td>
        </tr>
        <tr>
          <td><code>database</code></td>
          <td>Таблица в БД (создаётся через <code>php artisan cache:table</code> + migrate)</td>
          <td>Когда нельзя поднять Redis/Memcached. В актуальных версиях Laravel (11.x) — по умолчанию.</td>
        </tr>
        <tr>
          <td><code>redis</code></td>
          <td>In-memory хранилище Redis</td>
          <td>Продакшен, высокая нагрузка. Богатый функционал: структуры данных, pub/sub, atomic ops.</td>
        </tr>
        <tr>
          <td><code>memcached</code></td>
          <td>In-memory хранилище Memcached</td>
          <td>Тоже продакшен. Проще Redis, только ключ-значение — но очень быстрый.</td>
        </tr>
        <tr>
          <td><code>dynamodb</code></td>
          <td>AWS DynamoDB</td>
          <td>Проекты в экосистеме Amazon, serverless на Lambda.</td>
        </tr>
        <tr>
          <td><code>array</code></td>
          <td>Массив PHP в памяти запроса</td>
          <td>Только для тестов — данные не сохраняются между запросами.</td>
        </tr>
        <tr>
          <td><code>null</code></td>
          <td>Ничего не сохраняет</td>
          <td>Драйвер-заглушка. Также для тестов, когда нужно отключить кеширование.</td>
        </tr>
        <tr>
          <td><code>apc</code> / <code>apcu</code></td>
          <td>PHP APCu (in-memory на процесс)</td>
          <td>Устаревшие драйверы. Иногда упоминаются в старой документации.</td>
        </tr>
      </tbody>
    </table>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="settings" style="width:14px;height:14px"></i> Какой драйвер по умолчанию</div>
    <p class="text">Драйвер по умолчанию определяется в файле <code>config/cache.php</code> через переменную окружения <code>CACHE_DRIVER</code>. В разных версиях Laravel настройки по умолчанию могут отличаться, но в актуальных версиях (например, 11.x) по умолчанию используется <code>database</code>.</p>
<pre><code><span class="c-comment"># .env</span>
CACHE_DRIVER=redis</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="rocket" style="width:14px;height:14px"></i> Что выбирать в продакшене</div>
    <p class="text">Для высоконагруженных проектов рекомендуется использовать <strong>in-memory драйверы</strong> — <code>redis</code> или <code>memcached</code>. Они хранят данные в оперативной памяти и дают максимальную скорость.</p>
    <p class="text">Выбор между Redis и Memcached обычно сводится к тому, что <strong>Redis предлагает более богатый функционал</strong>: поддержку структур данных (списки, хеши, отсортированные множества), pub/sub, atomic locks, persistence — оставаясь при этом очень быстрым. Memcached — минималистичнее, чуть быстрее на простом ключ-значении, но не умеет ничего кроме этого.</p>

    <div class="pitfall">
      <strong>Ограничение <code>Cache::tags()</code>.</strong> Метод для групповой работы с кешем через теги <strong>работает только с драйверами <code>redis</code> и <code>memcached</code></strong>. При использовании <code>file</code>, <code>database</code> или других драйверов вызов <code>tags()</code> выбросит исключение.
    </div>

    <div class="remember-box">
      <strong>Итог.</strong> У вас есть полная свобода выбора — от простого файлового кеша для разработки до высокопроизводительных Redis / Memcached в продакшене. Всё настраивается через конфигурационный файл и переменную окружения <code>CACHE_DRIVER</code>. Единый API <code>Cache::put()</code>/<code>Cache::get()</code> работает одинаково независимо от драйвера — можно менять хранилище без переписывания кода.
    </div>
  </div>

  <div class="subsection" id="cache-stores">
    <div class="subsection-title"><i data-lucide="layers-3"></i> Multiple Stores — несколько хранилищ в одном проекте</div>

    <p class="text"><strong>Что это.</strong> Multiple stores — это возможность объявить <strong>несколько независимых конфигураций кеша</strong> в <code>config/cache.php</code> и использовать их по имени через <code>Cache::store('название')</code>. Позволяет гибко управлять хранением, распределяя разные типы данных по разным драйверам или серверам.</p>

    <p class="text"><strong>Как это выглядит в конфиге:</strong></p>
<pre><code><span class="c-comment">// config/cache.php</span>
<span class="c-str">'stores'</span> =&gt; [
    <span class="c-str">'redis'</span> =&gt; [
        <span class="c-str">'driver'</span>     =&gt; <span class="c-str">'redis'</span>,
        <span class="c-str">'connection'</span> =&gt; <span class="c-str">'default'</span>,
    ],
    <span class="c-str">'redis_fast'</span> =&gt; [
        <span class="c-str">'driver'</span>     =&gt; <span class="c-str">'redis'</span>,
        <span class="c-str">'connection'</span> =&gt; <span class="c-str">'fast'</span>,        <span class="c-comment">// отдельное соединение Redis (другой сервер)</span>
    ],
    <span class="c-str">'file_slow'</span> =&gt; [
        <span class="c-str">'driver'</span> =&gt; <span class="c-str">'file'</span>,
        <span class="c-str">'path'</span>   =&gt; <span class="c-fn">storage_path</span>(<span class="c-str">'framework/cache/slow'</span>),
    ],
    <span class="c-str">'database'</span> =&gt; [
        <span class="c-str">'driver'</span> =&gt; <span class="c-str">'database'</span>,
        <span class="c-str">'table'</span>  =&gt; <span class="c-str">'cache'</span>,
    ],
],</code></pre>

    <p class="text"><strong>Как использовать:</strong></p>
<pre><code><span class="c-comment">// Стандартное хранилище (указанное в CACHE_DRIVER)</span>
<span class="c-type">Cache</span>::<span class="c-fn">put</span>(<span class="c-str">'key'</span>, <span class="c-str">'value'</span>, <span class="c-num">60</span>);

<span class="c-comment">// Конкретное хранилище по имени</span>
<span class="c-type">Cache</span>::<span class="c-fn">store</span>(<span class="c-str">'redis_fast'</span>)-&gt;<span class="c-fn">put</span>(<span class="c-str">'hot'</span>, <span class="c-str">'data'</span>, <span class="c-num">60</span>);
<span class="c-type">Cache</span>::<span class="c-fn">store</span>(<span class="c-str">'file_slow'</span>)-&gt;<span class="c-fn">put</span>(<span class="c-str">'big_report'</span>, <span class="c-var">$report</span>, <span class="c-num">3600</span>);</code></pre>

    <p class="text"><strong>Зачем это нужно:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Разделение горячего и холодного кеша.</strong> Горячий — часто запрашиваемые данные (Redis, высокопроизводительный). Холодный — редко используемые или большие данные (файлы, БД), чтобы не засорять оперативную память.</li>
      <li><strong>Изоляция по функциональности.</strong> Например, кеш для сессий отдельно, для API-ответов отдельно, для отчётов отдельно. Упрощает мониторинг и очистку.</li>
      <li><strong>Разные драйверы для разных задач.</strong> Можно комбинировать Redis для быстрых операций и файлы для огромных кешей, где скорость не критична.</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="switch-camera" style="width:14px;height:14px"></i> Смена хранилища для фасада</div>
    <p class="text">Если нужно временно переключить стандартное хранилище для всех вызовов <code>Cache::</code>, есть <code>shouldUse()</code>:</p>
<pre><code><span class="c-type">Cache</span>::<span class="c-fn">shouldUse</span>(<span class="c-str">'redis_fast'</span>);
<span class="c-comment">// теперь все вызовы без store() идут в redis_fast</span></code></pre>
    <p class="text">Обычно так делать не рекомендуется — усложняет код и делает поведение неявным. Явный <code>store('name')</code> в каждом месте предсказуемее.</p>

    <div class="pitfall">
      <strong>Важно:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Каждое хранилище использует свои настройки (драйвер, соединение, таблицу, путь).</li>
        <li>Хранилища <strong>не пересекаются</strong> — ключи в одном не видны в другом.</li>
        <li>Для <code>Cache::tags()</code> нужно чтобы драйвер поддерживал теги (Redis/Memcached) — <code>store('redis')-&gt;tags(...)</code> работает, но <code>store('file')-&gt;tags(...)</code> — нет.</li>
      </ul>
    </div>

    <div class="remember-box">
      <strong>Итог.</strong> Multiple stores — механизм для создания нескольких независимых кешей с разными конфигурациями. Оптимизация производительности (горячий кеш в Redis, холодный в файлах), разделение по смыслу (сессии/API/отчёты), лёгкое переключение через <code>Cache::store('name')</code>. Полезно в крупных проектах, где разные части системы имеют разные требования к скорости и объёму кеширования.
    </div>
  </div>

  <div class="subsection" id="cache-features">
    <div class="subsection-title"><i data-lucide="list"></i> Возможности</div>
    <div class="card"><h3>Базовые операции</h3><p class="text"><code>Cache::put(key, value, ttl)</code>, <code>get</code>, <code>has</code>, <code>forget</code>, <code>increment</code>, <code>decrement</code>. <code>remember(key, ttl, fn() =&gt; ...)</code> — get или compute.</p></div>
    <div class="card"><h3>Tags (только Redis/Memcached)</h3><p class="text"><code>Cache::tags(['users', 'orders'])-&gt;put(...)</code> — групповая инвалидация: <code>Cache::tags(['users'])-&gt;flush()</code>. Не работает с <code>file</code>/<code>database</code> бэкендами.</p></div>
    <div class="card"><h3>Atomic locks</h3><p class="text"><code>Cache::lock('process-order', 10)-&gt;get(fn() =&gt; ...)</code> — распределённая блокировка. Защищает от двух одновременных обработчиков одной задачи. Lock автоматически освобождается через 10 сек.</p></div>
    <div class="card"><h3>Multiple stores</h3><p class="text">В <code>config/cache.php</code> можно объявить несколько стораджей и использовать по имени: <code>Cache::store('redis-fast')-&gt;put(...)</code>. Полезно для разделения горячего и холодного кеша.</p></div>
  </div>

  <div class="subsection" id="cache-basics">
    <div class="subsection-title"><i data-lucide="terminal"></i> Базовые операции с кешем</div>
    <p class="text">Laravel предоставляет единый интерфейс для работы с кешем через фасад <code>Cache</code>. Ниже основные методы с примерами.</p>

    <div class="card">
      <h3>1. <code>put()</code> — сохранить значение</h3>
<pre><code><span class="c-type">Cache</span>::<span class="c-fn">put</span>(<span class="c-str">'key'</span>, <span class="c-str">'value'</span>, <span class="c-var">$ttl</span>);   <span class="c-comment">// $ttl в секундах (или DateTime)</span>
<span class="c-type">Cache</span>::<span class="c-fn">put</span>(<span class="c-str">'user_1'</span>, <span class="c-var">$user</span>, <span class="c-num">3600</span>);   <span class="c-comment">// на 60 минут</span></code></pre>
    </div>

    <div class="card">
      <h3>2. <code>get()</code> — получить значение</h3>
<pre><code><span class="c-var">$value</span> = <span class="c-type">Cache</span>::<span class="c-fn">get</span>(<span class="c-str">'key'</span>);
<span class="c-var">$value</span> = <span class="c-type">Cache</span>::<span class="c-fn">get</span>(<span class="c-str">'key'</span>, <span class="c-str">'default'</span>);           <span class="c-comment">// со значением по умолчанию</span>
<span class="c-var">$value</span> = <span class="c-type">Cache</span>::<span class="c-fn">get</span>(<span class="c-str">'key'</span>, <span class="c-key">fn</span> () =&gt; <span class="c-str">'default'</span>);   <span class="c-comment">// lazy default</span></code></pre>
    </div>

    <div class="card">
      <h3>3. <code>has()</code> — проверить существование</h3>
<pre><code><span class="c-key">if</span> (<span class="c-type">Cache</span>::<span class="c-fn">has</span>(<span class="c-str">'key'</span>)) { <span class="c-comment">/* ... */</span> }</code></pre>
    </div>

    <div class="card">
      <h3>4. <code>forget()</code> — удалить</h3>
<pre><code><span class="c-type">Cache</span>::<span class="c-fn">forget</span>(<span class="c-str">'key'</span>);</code></pre>
    </div>

    <div class="card">
      <h3>5. <code>increment()</code> / <code>decrement()</code> — для числовых значений</h3>
<pre><code><span class="c-type">Cache</span>::<span class="c-fn">increment</span>(<span class="c-str">'counter'</span>);        <span class="c-comment">// +1</span>
<span class="c-type">Cache</span>::<span class="c-fn">increment</span>(<span class="c-str">'counter'</span>, <span class="c-num">5</span>);     <span class="c-comment">// +5</span>
<span class="c-type">Cache</span>::<span class="c-fn">decrement</span>(<span class="c-str">'counter'</span>, <span class="c-num">3</span>);     <span class="c-comment">// -3</span></code></pre>
      <p>Атомарные операции — безопасны в конкурентной среде.</p>
    </div>

    <div class="card">
      <h3>6. <code>remember()</code> — получить или вычислить и сохранить</h3>
<pre><code><span class="c-comment">// Если ключ есть — вернуть.
// Если нет — выполнить callback, сохранить результат и вернуть.</span>
<span class="c-var">$users</span> = <span class="c-type">Cache</span>::<span class="c-fn">remember</span>(<span class="c-str">'active_users'</span>, <span class="c-num">3600</span>, <span class="c-key">function</span> () {
    <span class="c-key">return</span> <span class="c-type">User</span>::<span class="c-fn">active</span>()-&gt;<span class="c-fn">get</span>();   <span class="c-comment">// тяжёлый запрос</span>
});</code></pre>
      <p>Есть вариант <code>rememberForever()</code> — без TTL, хранится до явного удаления.</p>

      <p><strong>Откуда <code>remember</code> берёт данные.</strong> Источник данных определяется <em>внутри колбэка</em>, который вы передаёте вторым параметром. Колбэк выполняется <em>только</em> тогда, когда данных по ключу нет в кеше или они истекли, и его результат сохраняется в кеш. Внутри колбэка вы сами пишете логику — Eloquent-запрос, вызов внешнего API, сложные вычисления, чтение из файла. Никакой магии.</p>
<pre><code><span class="c-var">$products</span> = <span class="c-type">Cache</span>::<span class="c-fn">remember</span>(<span class="c-str">'popular_products'</span>, <span class="c-num">300</span>, <span class="c-key">function</span> () {
    <span class="c-key">return</span> <span class="c-type">Product</span>::<span class="c-fn">with</span>(<span class="c-str">'category'</span>)
        -&gt;<span class="c-fn">where</span>(<span class="c-str">'views'</span>, <span class="c-str">'&gt;'</span>, <span class="c-num">1000</span>)
        -&gt;<span class="c-fn">orderBy</span>(<span class="c-str">'sales'</span>, <span class="c-str">'desc'</span>)
        -&gt;<span class="c-fn">limit</span>(<span class="c-num">10</span>)
        -&gt;<span class="c-fn">get</span>();
});
<span class="c-comment">// При первом запросе — тяжёлый SQL, результат в кеш на 5 минут.
// Следующие 5 минут все запросы получают данные из кеша без обращения к БД.</span></code></pre>
      <p>Переменная <code>$users</code>/<code>$products</code> — обычная PHP-переменная, содержит либо результат из кеша, либо результат выполнения колбэка. Никакой дополнительной регистрации не требуется. Если колбэк возвращает <code>null</code> или пустой массив — они тоже кешируются (в зависимости от драйвера).</p>
    </div>

    <div class="card">
      <h3>7. <code>pull()</code> — получить и удалить за один вызов</h3>
<pre><code><span class="c-var">$value</span> = <span class="c-type">Cache</span>::<span class="c-fn">pull</span>(<span class="c-str">'key'</span>);   <span class="c-comment">// вернёт значение и удалит ключ</span></code></pre>
      <p>Подробнее — в отдельной подсекции ниже.</p>
    </div>

    <div class="card">
      <h3>8. <code>store()</code> — выбрать другой драйвер</h3>
<pre><code><span class="c-type">Cache</span>::<span class="c-fn">store</span>(<span class="c-str">'redis'</span>)-&gt;<span class="c-fn">put</span>(...);</code></pre>
    </div>

    <div class="remember-box">
      <strong>Итог по методам:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li><code>put</code> — запись</li>
        <li><code>get</code> — чтение</li>
        <li><code>has</code> — проверка</li>
        <li><code>forget</code> — удаление</li>
        <li><code>increment</code> / <code>decrement</code> — атомарный счётчик</li>
        <li><code>remember</code> — «верни, если есть, а если нет — вычисли и сохрани» (самый удобный)</li>
        <li><code>pull</code> — прочитать + удалить за один вызов</li>
      </ul>
      Кеш используется для ускорения работы (результаты запросов, сложные вычисления, данные из внешних API) и разгрузки БД.
    </div>
  </div>

  <div class="subsection" id="cache-return-types">
    <div class="subsection-title"><i data-lucide="corner-down-left"></i> Что возвращают методы кеша (для переменной)</div>

    <p class="text">В API кеша Laravel есть методы, которые <strong>возвращают значение</strong> (его можно присвоить переменной), и методы, которые <strong>ничего не возвращают</strong> или возвращают <code>bool</code>. Правило простое: смотрите на возвращаемый тип метода — если <code>mixed</code> или <code>bool</code>, значение можно сохранить в переменную; если <code>void</code> — нельзя.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="download" style="width:14px;height:14px"></i> Возвращают значение (можно присвоить переменной)</div>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Что возвращает</th><th>Пример</th></tr></thead>
      <tbody>
        <tr><td><code>get($key, $default = null)</code></td><td>значение или <code>$default</code></td><td><code>$value = Cache::get('key', 'default');</code></td></tr>
        <tr><td><code>remember($key, $ttl, $cb)</code></td><td>значение из кеша или результат колбэка</td><td><code>$users = Cache::remember('users', 60, fn() =&gt; User::all());</code></td></tr>
        <tr><td><code>rememberForever($key, $cb)</code></td><td>то же, но без TTL</td><td><code>$config = Cache::rememberForever('cfg', fn() =&gt; ...);</code></td></tr>
        <tr><td><code>pull($key)</code></td><td>значение и удаляет ключ</td><td><code>$token = Cache::pull('token');</code></td></tr>
        <tr><td><code>many(array $keys)</code></td><td>массив значений для нескольких ключей</td><td><code>$values = Cache::many(['key1', 'key2']);</code></td></tr>
        <tr><td><code>increment($key, $amount = 1)</code></td><td>новое значение счётчика</td><td><code>$newCount = Cache::increment('counter', 5);</code></td></tr>
        <tr><td><code>decrement($key, $amount = 1)</code></td><td>новое значение счётчика</td><td><code>$newCount = Cache::decrement('counter');</code></td></tr>
      </tbody>
    </table>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="upload" style="width:14px;height:14px"></i> Ничего не возвращают или возвращают bool</div>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Что возвращает</th><th>Пример</th></tr></thead>
      <tbody>
        <tr><td><code>put($key, $value, $ttl)</code></td><td>ничего (или <code>true</code>) — обычно результат игнорируют</td><td><code>Cache::put('key', 'value', 60);</code></td></tr>
        <tr><td><code>add($key, $value, $ttl)</code></td><td><code>bool</code> — было ли добавление успешным</td><td><code>$added = Cache::add('key', 'value', 60);</code></td></tr>
        <tr><td><code>forget($key)</code></td><td><code>bool</code> — удалён ли ключ</td><td><code>$deleted = Cache::forget('key');</code></td></tr>
        <tr><td><code>flush()</code></td><td><code>bool</code> — очистка всего</td><td><code>$cleared = Cache::flush();</code></td></tr>
      </tbody>
    </table>

    <div class="remember-box">
      <strong>Итог.</strong> Если метод возвращает данные (<code>get</code>, <code>pull</code>, <code>remember</code>, <code>increment</code>) — присваиваете переменной. Если ничего не возвращает (<code>put</code>, <code>forget</code>, <code>flush</code>) — просто выполняете действие. Методы возвращающие <code>bool</code> (<code>add</code>, <code>forget</code>, <code>flush</code>) можно присвоить, но обычно результат используют только для проверки успешности операции.
    </div>
  </div>

  <div class="subsection" id="cache-tags">
    <div class="subsection-title"><i data-lucide="tags"></i> Cache Tags — групповая инвалидация</div>

    <p class="text"><strong>Что это.</strong> Теги позволяют объединять несколько ключей кеша в логические группы и очищать всю группу разом. Удобно, когда у вас много связанных данных (например, все кеши, зависящие от пользователя или заказов).</p>

    <p class="text"><strong>Как использовать:</strong></p>
<pre><code><span class="c-comment">// Сохраняем значение с тегами</span>
<span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'users'</span>, <span class="c-str">'profile'</span>])-&gt;<span class="c-fn">put</span>(<span class="c-str">'user_123'</span>, <span class="c-var">$userData</span>, <span class="c-num">3600</span>);

<span class="c-comment">// Несколько ключей в одной группе</span>
<span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'orders'</span>])-&gt;<span class="c-fn">put</span>(<span class="c-str">'order_456'</span>, <span class="c-var">$orderData</span>, <span class="c-num">3600</span>);
<span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'orders'</span>, <span class="c-str">'invoices'</span>])-&gt;<span class="c-fn">put</span>(<span class="c-str">'invoice_789'</span>, <span class="c-var">$invoiceData</span>, <span class="c-num">3600</span>);

<span class="c-comment">// Получаем значение по ключу с тегами</span>
<span class="c-var">$user</span> = <span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'users'</span>])-&gt;<span class="c-fn">get</span>(<span class="c-str">'user_123'</span>);

<span class="c-comment">// Очищаем все ключи с тегом 'users'</span>
<span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'users'</span>])-&gt;<span class="c-fn">flush</span>();

<span class="c-comment">// Очищаем несколько тегов сразу</span>
<span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'orders'</span>, <span class="c-str">'invoices'</span>])-&gt;<span class="c-fn">flush</span>();</code></pre>

    <p class="text"><strong>Зачем это нужно:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Групповая инвалидация</strong> — если обновили данные пользователя, можно очистить весь кеш связанный с этим пользователем, не думая о том, какие ключи были созданы.</li>
      <li><strong>Упрощение управления</strong> — вместо запоминания всех ключей вы просто помечаете их тегами и сбрасываете группу.</li>
      <li><strong>Повышение производительности</strong> — избавление от устаревших данных без перебора всех ключей по отдельности.</li>
    </ul>

    <div class="pitfall">
      <strong>Ограничения:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Работает только с драйверами <strong>Redis</strong> и <strong>Memcached</strong>. Для <code>file</code>, <code>database</code>, <code>array</code> теги не поддерживаются.</li>
        <li>При использовании <code>Cache::tags()</code> нужен правильный порядок вызовов: сначала <code>tags()</code>, затем <code>put()</code>/<code>get()</code>/<code>flush()</code>.</li>
        <li>Теги хранятся отдельно от ключей, поэтому инвалидация группы происходит быстро и атомарно.</li>
      </ul>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="cpu" style="width:14px;height:14px"></i> Как теги работают под капотом</div>

    <p class="text"><strong>Разберём вызов</strong> <code>Cache::tags(['users', 'profile'])-&gt;put('user_123', $userData, 3600)</code>:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>'user_123'</code> — <strong>строковый ключ</strong>, по которому будете получать данные. Вы сами его придумываете (например, для пользователя с ID = 123 удобно использовать <code>"user_123"</code>).</li>
      <li><code>$userData</code> — сами данные (массив, объект, строка — что угодно).</li>
      <li><code>['users', 'profile']</code> — <strong>метки</strong>, которые присваиваются ключу. Хранятся <em>отдельно</em> и позволяют группировать ключи.</li>
    </ul>

    <p class="text"><strong>Как Laravel понимает связь тегов и ключей.</strong> Под капотом (для Redis/Memcached) Laravel создаёт отдельные структуры:</p>
    <ol style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Сохраняет основное значение по ключу <code>'user_123'</code> — как обычно.</li>
      <li>Для каждого тега (<code>users</code> и <code>profile</code>) создаёт список ключей, которые относятся к этому тегу. Например, в Redis есть отдельный ключ <code>"tag:users:keys"</code>, внутри которого хранится список <code>['user_123', 'user_456', ...]</code>.</li>
      <li>При <code>Cache::tags(['users'])-&gt;flush()</code> Laravel проходит по списку ключей тега <code>users</code> и удаляет их один за другим.</li>
    </ol>
    <p class="text">Таким образом, теги не встраиваются в основной ключ — они хранятся отдельно в <strong>индексах</strong>. Поэтому один и тот же ключ можно привязать к нескольким тегам, и он будет удалён при очистке любого из них.</p>

    <p class="text"><strong>Пример с несколькими тегами:</strong></p>
<pre><code><span class="c-comment">// Сохраняем профиль пользователя с двумя тегами</span>
<span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'users'</span>, <span class="c-str">'profile'</span>])-&gt;<span class="c-fn">put</span>(<span class="c-str">'user_123'</span>, <span class="c-var">$userData</span>, <span class="c-num">3600</span>);

<span class="c-comment">// Сохраняем настройки пользователя только с тегом 'users'</span>
<span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'users'</span>])-&gt;<span class="c-fn">put</span>(<span class="c-str">'user_settings_123'</span>, <span class="c-var">$settings</span>, <span class="c-num">3600</span>);

<span class="c-comment">// Получаем данные (нужно указывать теги, если они были при сохранении)</span>
<span class="c-var">$profile</span>  = <span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'users'</span>])-&gt;<span class="c-fn">get</span>(<span class="c-str">'user_123'</span>);           <span class="c-comment">// работает</span>
<span class="c-var">$settings</span> = <span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'users'</span>])-&gt;<span class="c-fn">get</span>(<span class="c-str">'user_settings_123'</span>);   <span class="c-comment">// работает</span>

<span class="c-comment">// А вот так — вернёт null, ключ хранится в отдельном пространстве:</span>
<span class="c-comment">// Cache::get('user_123');   // null!</span>

<span class="c-comment">// Очищаем всё с тегом 'users' — удалится и user_123, и user_settings_123</span>
<span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'users'</span>])-&gt;<span class="c-fn">flush</span>();

<span class="c-comment">// Если очистить только 'profile' — удалится только user_123 (у него есть тег profile)</span>
<span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'profile'</span>])-&gt;<span class="c-fn">flush</span>();</code></pre>

    <p class="text"><strong>Практический сценарий — управление кешем пользователя:</strong></p>
<pre><code><span class="c-comment">// При сохранении разных частей данных пользователя</span>
<span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'user_'</span> . <span class="c-var">$userId</span>])-&gt;<span class="c-fn">put</span>(<span class="c-str">'profile'</span>, <span class="c-var">$profile</span>, <span class="c-num">3600</span>);
<span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'user_'</span> . <span class="c-var">$userId</span>])-&gt;<span class="c-fn">put</span>(<span class="c-str">'settings'</span>, <span class="c-var">$settings</span>, <span class="c-num">3600</span>);

<span class="c-comment">// При обновлении профиля — одним вызовом очищаем всё связанное</span>
<span class="c-type">Cache</span>::<span class="c-fn">tags</span>([<span class="c-str">'user_'</span> . <span class="c-var">$userId</span>])-&gt;<span class="c-fn">flush</span>();</code></pre>

    <div class="pitfall">
      <strong>Ключевое.</strong> Если сохранили значение с тегами — получить его можно <em>только</em> через <code>Cache::tags(...)-&gt;get(...)</code>. Обычный <code>Cache::get()</code> без тегов вернёт <code>null</code>, потому что ключ физически хранится в отдельном пространстве.
    </div>

    <div class="remember-box">
      <strong>Итог по механике тегов:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Ключ (<code>user_123</code>) — произвольная строка, которую вы придумываете.</li>
        <li>Теги — отдельные индексы, хранящие списки ключей.</li>
        <li>При <code>put()</code> Laravel добавляет ключ в индексы тегов.</li>
        <li>При <code>flush()</code> удаляет все ключи из индекса тега.</li>
        <li>При <code>get()</code> проверяет наличие ключа в указанном индексе и возвращает данные.</li>
        <li>Работает только с Redis/Memcached — для file/database теги недоступны.</li>
      </ul>
    </div>
  </div>

  <div class="subsection" id="cache-locks">
    <div class="subsection-title"><i data-lucide="lock-keyhole"></i> Atomic Locks — распределённые блокировки</div>

    <p class="text"><strong>Что это.</strong> Atomic lock — это <strong>распределённая блокировка</strong>, которая гарантирует, что определённый участок кода или задача выполняется только одним процессом или сервером одновременно. Критично важно в распределённых системах, где несколько экземпляров приложения могут попытаться выполнить одну и ту же работу параллельно — обработать один заказ, запустить крон-задачу, обновить баланс.</p>

    <p class="text"><strong>Как работает <code>Cache::lock()</code>:</strong></p>
<pre><code><span class="c-type">Cache</span>::<span class="c-fn">lock</span>(<span class="c-str">'process-order'</span>, <span class="c-num">10</span>)-&gt;<span class="c-fn">get</span>(<span class="c-key">function</span> () {
    <span class="c-comment">// выполняем критическую операцию</span>
});</code></pre>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>'process-order'</code> — уникальный идентификатор блокировки (например, ID заказа).</li>
      <li><code>10</code> — максимальное время удержания в секундах (TTL). Если колбэк займёт больше 10 секунд, блокировка автоматически освободится — защита от зависших задач.</li>
      <li><code>get(callback)</code> — пытается захватить блокировку. Если успешно — выполняет колбэк и автоматически освобождает. Если не удалось (уже занята) — сразу вернёт <code>false</code>/<code>null</code>, колбэк не выполнится.</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="alert-circle" style="width:14px;height:14px"></i> Зачем это нужно</div>
    <p class="text"><strong>Проблема.</strong> В веб-приложении два параллельных запроса от одного пользователя могут одновременно попытаться оплатить один и тот же заказ. Без блокировки они дважды спишут деньги, дважды обновят статус — несогласованность данных.</p>
    <p class="text"><strong>Решение.</strong> Блокировка на уровне заказа — первый запрос захватывает блокировку, выполняет обработку, освобождает. Второй запрос видит, что блокировка занята, и либо завершается с ошибкой, либо ждёт.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="hand" style="width:14px;height:14px"></i> Ручное управление блокировкой</div>
    <p class="text">Иногда нужно больше контроля — используются методы <code>acquire()</code> и <code>release()</code>:</p>
<pre><code><span class="c-var">$lock</span> = <span class="c-type">Cache</span>::<span class="c-fn">lock</span>(<span class="c-str">'process-order'</span>, <span class="c-num">10</span>);

<span class="c-key">if</span> (<span class="c-var">$lock</span>-&gt;<span class="c-fn">acquire</span>()) {
    <span class="c-key">try</span> {
        <span class="c-comment">// выполняем работу</span>
    } <span class="c-key">finally</span> {
        <span class="c-var">$lock</span>-&gt;<span class="c-fn">release</span>();   <span class="c-comment">// обязательно освободить!</span>
    }
} <span class="c-key">else</span> {
    <span class="c-comment">// блокировка уже занята</span>
}</code></pre>
    <p class="text">Метод <code>get()</code> делает это автоматически — удобнее и безопаснее (не забыть <code>release</code>).</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="clock" style="width:14px;height:14px"></i> Автоматическое освобождение</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Если колбэк внутри <code>get()</code> выполнился успешно — блокировка освобождается после выхода из колбэка.</li>
      <li>Если колбэк выбросил исключение — блокировка всё равно освободится (гарантируется механизмом).</li>
      <li>Если выполнение превысило TTL (10 секунд) — блокировка автоматически удаляется драйвером кеша, чтобы не блокировать другие процессы. При этом ваш код <em>продолжит</em> выполняться — это может привести к одновременной работе двух процессов, если первый ещё не завершился, а второй уже захватил освободившуюся блокировку. Поэтому <strong>TTL должен быть больше</strong> ожидаемого времени выполнения.</li>
    </ul>

    <div class="pitfall">
      <strong>Какие драйверы поддерживают.</strong> Блокировки доступны для драйверов кеша с атомарными операциями: <code>redis</code>, <code>memcached</code>, <code>database</code> (начиная с определённых версий), <code>dynamodb</code>. Для <code>file</code> и <code>array</code> — не работают или с ограничениями. Laravel использует атомарные операции (например, Redis <code>SET NX EX</code>) для реализации блокировок.
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="target" style="width:14px;height:14px"></i> Типичные сценарии</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Обработка платежей</strong> — блокировка по ID заказа, чтобы не списать дважды.</li>
      <li><strong>Крон-задача</strong> — блокировка по имени задачи, чтобы не запустилась повторно если предыдущий запуск ещё не завершился.</li>
      <li><strong>Обновление ресурса</strong> — генерация отчёта, кеширование тяжёлого набора данных: несколько запросов не запустят одну и ту же операцию.</li>
      <li><strong>Rate-limiting на уровне ресурса</strong> — ограничение одновременных запросов к внешнему API.</li>
    </ul>

    <div class="remember-box">
      <strong>Итог.</strong> <code>Cache::lock()</code> — распределённая блокировка с автоматическим управлением. <code>get(callback)</code> — пытается захватить, выполняет колбэк, освобождает. TTL — защита от зависаний. Критична для согласованности данных в конкурентных средах. Поддерживается Redis, Memcached, Database. Используйте когда нужно гарантировать, что операция выполняется только одним экземпляром приложения одновременно.
    </div>
  </div>

  <div class="subsection" id="cache-pull">
    <div class="subsection-title"><i data-lucide="download-cloud"></i> <code>pull()</code> — get + forget за один вызов</div>

    <p class="text">Метод <code>pull()</code> делает две вещи одновременно: <strong>возвращает значение по ключу</strong> (если оно существует и не истекло) и <strong>удаляет этот ключ из кеша сразу после извлечения</strong>. Значение при этом сохраняется в переменную и используется в коде — оно не «теряется», просто больше не хранится в кеше.</p>

    <p class="text">Время жизни (TTL) не имеет значения для самого удаления — <code>pull</code> удаляет ключ немедленно, независимо от того, сколько времени оставалось до истечения. Если ключ уже истёк, то <code>pull</code> вернёт <code>null</code> (или значение по умолчанию) и не станет ничего удалять — ключ уже удалён драйвером автоматически.</p>

    <p class="text"><strong>Простой пример:</strong></p>
<pre><code><span class="c-comment">// Сохраняем значение на 10 минут</span>
<span class="c-type">Cache</span>::<span class="c-fn">put</span>(<span class="c-str">'temp'</span>, <span class="c-str">'data'</span>, <span class="c-num">600</span>);

<span class="c-comment">// Через 2 минуты делаем pull</span>
<span class="c-var">$value</span> = <span class="c-type">Cache</span>::<span class="c-fn">pull</span>(<span class="c-str">'temp'</span>);   <span class="c-comment">// 'data' — вернулось, и ключ удалён</span>

<span class="c-comment">// Повторная попытка</span>
<span class="c-var">$value</span> = <span class="c-type">Cache</span>::<span class="c-fn">get</span>(<span class="c-str">'temp'</span>);    <span class="c-comment">// null — ключа больше нет</span></code></pre>

    <p class="text"><strong>Когда использовать:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Одноразовые данные — например, токен для сброса пароля, код подтверждения. После использования хранить не нужно, чтобы никто не использовал его повторно.</li>
      <li>Флаги выполнения — например, <code>Cache::pull('import_in_progress')</code>: если существует, значит импорт идёт; после проверки удаляем, чтобы не блокировать следующий запуск.</li>
      <li>Счётчики-индикаторы — прочитать, использовать для логики, удалить чтобы сбросить.</li>
      <li>Атомарное чтение с очисткой — гарантирует, что значение будет прочитано и удалено за одну операцию, без гонок между несколькими запросами.</li>
    </ul>

    <p class="text"><strong>Практический пример — одноразовая ссылка активации:</strong></p>
<pre><code><span class="c-comment">// Сохраняем одноразовую ссылку для активации</span>
<span class="c-type">Cache</span>::<span class="c-fn">put</span>(<span class="c-str">'activation_123'</span>, <span class="c-str">'user@mail.com'</span>, <span class="c-num">3600</span>);

<span class="c-comment">// Когда пользователь переходит по ссылке</span>
<span class="c-var">$email</span> = <span class="c-type">Cache</span>::<span class="c-fn">pull</span>(<span class="c-str">'activation_123'</span>);   <span class="c-comment">// 'user@mail.com'</span>

<span class="c-key">if</span> (<span class="c-var">$email</span>) {
    <span class="c-comment">// активируем пользователя</span>
    <span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'email'</span>, <span class="c-var">$email</span>)-&gt;<span class="c-fn">update</span>([<span class="c-str">'active'</span> =&gt; <span class="c-key">true</span>]);
} <span class="c-key">else</span> {
    <span class="c-comment">// ссылка уже использована или истекла</span>
}</code></pre>
    <p class="text">После <code>pull()</code> ключ удалён, и ту же ссылку нельзя использовать повторно.</p>

    <div class="tip">
      <strong>Важно про поведение:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Если ключ не существует — <code>pull()</code> вернёт <code>null</code> или переданное значение по умолчанию.</li>
        <li><code>pull()</code> удаляет ключ только если он был найден и активен. Если истёк — считается отсутствующим, удаления не происходит (ключа уже нет).</li>
        <li>Значение <strong>сохраняется в переменную и используется в коде</strong>. Удаление не мешает использованию — значение уже скопировано.</li>
      </ul>
    </div>

    <div class="remember-box">
      <strong>Итог.</strong> <code>pull()</code> = <code>get()</code> + <code>forget()</code> за один вызов. Не зависит от оставшегося TTL — удаляет сразу после чтения. Полезен для извлечения и очистки одноразовых данных (токены, коды, флаги), чтобы они не могли быть прочитаны повторно.
    </div>
  </div>

  <div class="subsection" id="cache-db-table">
    <div class="subsection-title"><i data-lucide="database"></i> Таблица для database-драйвера — <code>make:cache-table</code></div>

    <p class="text">Если вы используете драйвер <code>database</code> — Laravel хранит кеш в таблице БД, и её нужно создать. Для этого есть Artisan-команда:</p>
<pre><code>php artisan make:cache-table</code></pre>
    <p class="text">Команда создаёт файл миграции в <code>database/migrations/</code>. Далее её нужно применить:</p>
<pre><code>php artisan migrate</code></pre>

    <div class="tip">
      <strong>В новых проектах Laravel</strong> (начиная с версии 11) миграция для cache-таблицы обычно уже <em>присутствует по умолчанию</em>. Скорее всего вам не придётся создавать её вручную — достаточно выполнить <code>php artisan migrate</code>. Если по каким-то причинам её нет — команда <code>make:cache-table</code> создаст.
    </div>

    <div class="pitfall">
      <strong>Старая команда.</strong> В более старых версиях документации и сторонних источниках можно встретить <code>php artisan cache:table</code>. В актуальных версиях Laravel (11.x и выше) используется именно <code>make:cache-table</code>. Обе команды делают одно и то же — создают миграцию для таблицы кеша.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: cache stampede</div>
    <p class="text">Cache stampede — ситуация, когда ключ устарел и сразу 100 запросов пытаются его пересоздать одновременно, перегружая БД. Решение — атомарный lock.</p>

<pre><code><span class="c-comment">// ❌ Под нагрузкой — N запросов одновременно регенерируют один ключ</span>
<span class="c-key">return</span> <span class="c-type">Cache</span>::<span class="c-fn">remember</span>(<span class="c-str">'dashboard:stats'</span>, <span class="c-num">300</span>, <span class="c-key">fn</span> () =&gt;
    <span class="c-type">Stats</span>::<span class="c-fn">expensive</span>());

<span class="c-comment">// ✓ Только один запрос регенерирует, остальные ждут</span>
<span class="c-key">return</span> <span class="c-type">Cache</span>::<span class="c-fn">remember</span>(<span class="c-str">'dashboard:stats'</span>, <span class="c-num">300</span>, <span class="c-key">function</span> () {
    <span class="c-key">return</span> <span class="c-type">Cache</span>::<span class="c-fn">lock</span>(<span class="c-str">'lock:dashboard:stats'</span>, <span class="c-num">10</span>)-&gt;<span class="c-fn">block</span>(<span class="c-num">5</span>, <span class="c-key">fn</span> () =&gt;
        <span class="c-type">Stats</span>::<span class="c-fn">expensive</span>());
});
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>Cache::remember</code> и null.</strong> Если callable вернул null, Laravel <em>не</em> кеширует. Каждый запрос пересоздаёт. Используйте <code>rememberForever</code> с sentinel, либо проверяйте на null отдельно.</div>
    <div class="pitfall"><strong>2. Tags с file driver.</strong> <code>Cache::tags(...)</code> на file/database driver выбросит исключение. Проверяйте драйвер или используйте только tags-capable бэкенды.</div>
    <div class="pitfall"><strong>3. Lock не освобождён.</strong> Если процесс упал между захватом lock и выполнением, lock держится до TTL. Сделайте TTL разумным (5-30 сек), не «на всякий случай 5 минут».</div>
    <div class="pitfall"><strong>4. Кеш модели с relations.</strong> Кеширование <code>$user-&gt;with('orders')-&gt;get()</code> в Cache::put — relations сериализуются. При десериализации связи могут не работать корректно. Кешируйте plain данные, не Eloquent-модели.</div>
    <div class="pitfall"><strong>5. Префиксы в Redis.</strong> Несколько приложений на одном Redis-инстансе — конфликт ключей. Указывайте <code>CACHE_PREFIX</code> в <code>.env</code>.</div>
    <div class="pitfall"><strong>6. Cache::flush() в проде.</strong> Сбрасывает <em>всё</em>. На общем Redis с другими приложениями — снесёт чужие данные. Используйте <code>tags()-&gt;flush()</code>.</div>
    <div class="pitfall"><strong>7. <code>session</code>, <code>queue</code>, <code>cache</code> на одном Redis.</strong> Дефолт. Если flush — сбрасываются и сессии, и очереди. Разделяйте по DB index'ам.</div>
    <div class="pitfall"><strong>8. Stale-while-revalidate.</strong> Laravel не имеет встроенного SWR. Реализуется вручную: вернуть устаревший кеш, регенерировать в фоне через job.</div>
  </div>
</div>

<div id="sec-queues" class="section">
  <div class="section-title">Queues</div>
  <div class="subsection" id="q-purpose">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Очереди — механизм отложенного выполнения задач. Web-запрос ставит job в очередь и возвращает ответ; воркер забирает job и исполняет. Это разгружает HTTP-обработчики, обеспечивает retry при сбоях, позволяет масштабировать воркеры независимо. Понимание драйверов, retry-логики, batching и race conditions — обязательно для всего, что выходит за рамки «отправить письмо».</p>
  </div>

  <div class="subsection" id="q-drivers">
    <div class="subsection-title"><i data-lucide="hard-drive"></i> Драйверы очередей — где хранятся jobs</div>

    <p class="text">Очереди в Laravel позволяют выполнять ресурсоёмкие задачи (отправка писем, обработка изображений, вызов API) <strong>асинхронно</strong>, чтобы не тормозить ответ пользователю. Драйвер определяет, где и как хранятся и обрабатываются задания (jobs). Настраивается через <code>QUEUE_CONNECTION</code> в <code>.env</code>.</p>

    <div class="card">
      <h3>1. <code>sync</code> — синхронное выполнение (отладка / тесты)</h3>
      <p>Задание выполняется <strong>немедленно</strong> в том же процессе, что и запрос — не попадает в очередь вообще.</p>
      <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
        <li>Используется для локальной разработки и тестов, чтобы видеть ошибки сразу.</li>
        <li>Не подходит для продакшена — блокирует ответ клиенту.</li>
      </ul>
<pre><code>QUEUE_CONNECTION=sync</code></pre>
    </div>

    <div class="card">
      <h3>2. <code>database</code> — таблица в БД (просто, надёжно)</h3>
      <p>Задания сохраняются в таблицу <code>jobs</code> в вашей БД (MySQL/PostgreSQL). Работник (<code>php artisan queue:work</code>) периодически забирает новые задания.</p>
      <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
        <li><strong>Плюсы:</strong> не требует внешних сервисов, легко настраивается.</li>
        <li><strong>Минусы:</strong> медленнее in-memory решений, создаёт нагрузку на БД.</li>
      </ul>
<pre><code>QUEUE_CONNECTION=database

<span class="c-comment"># Создать таблицу jobs (в L11+ обычно уже есть по умолчанию)</span>
php artisan queue:table
php artisan migrate</code></pre>
    </div>

    <div class="card">
      <h3>3. <code>redis</code> — Redis (быстро, для продакшена)</h3>
      <p>Использует структуру данных <strong>list</strong> в Redis для хранения заданий.</p>
      <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
        <li>Очень быстрый, хорошо масштабируется, подходит для высоких нагрузок.</li>
        <li>Требует установленного и настроенного Redis-сервера.</li>
        <li>Совместим с <strong>Laravel Horizon</strong> — дашборд + мониторинг очередей.</li>
      </ul>
<pre><code>QUEUE_CONNECTION=redis</code></pre>
    </div>

    <div class="card">
      <h3>4. <code>sqs</code> — Amazon SQS (облачный)</h3>
      <p>Использует очередь <strong>AWS Simple Queue Service</strong>. Подходит для приложений, работающих в облаке AWS — высокая надёжность, автомасштабирование.</p>
      <p>Настройка требует ключей доступа и региона (<code>AWS_ACCESS_KEY_ID</code>, <code>AWS_SECRET_ACCESS_KEY</code>, <code>SQS_QUEUE</code>, <code>AWS_DEFAULT_REGION</code>).</p>
    </div>

    <div class="card">
      <h3>5. <code>beanstalkd</code> — легковесный внешний сервис</h3>
      <p>Использует протокол <strong>Beanstalkd</strong> — очень простой и быстрый. Требует установки и запуска beanstalkd-сервера.</p>
      <p>Хорош для небольших и средних проектов, где Redis избыточен, но database слишком медленный.</p>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="git-compare" style="width:14px;height:14px"></i> Как выбрать драйвер</div>
    <table class="data-table">
      <thead><tr><th>Сценарий</th><th>Драйвер</th></tr></thead>
      <tbody>
        <tr><td>Разработка / тестирование (видеть ошибки сразу)</td><td><code>sync</code></td></tr>
        <tr><td>Проект без внешних сервисов, малая нагрузка</td><td><code>database</code></td></tr>
        <tr><td>Проект с высокой нагрузкой, нужна скорость</td><td><code>redis</code> (+ Horizon)</td></tr>
        <tr><td>Проект в облаке AWS</td><td><code>sqs</code></td></tr>
        <tr><td>Минимальные требования к инфраструктуре, средний трафик</td><td><code>beanstalkd</code></td></tr>
      </tbody>
    </table>

    <div class="remember-box">
      <strong>Ключевое:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Драйвер указывается в <code>.env</code>: <code>QUEUE_CONNECTION=...</code>.</li>
        <li>Запуск воркера: <code>php artisan queue:work</code> (или <code>queue:listen</code> для разработки — перезапускается при изменении кода).</li>
        <li>Для каждого драйвера настройки в <code>config/queue.php</code> (соединение, имя очереди, retry, block_for и т.д.).</li>
        <li>Можно объявить <strong>несколько соединений</strong> и обращаться по имени: <code>Job::dispatch()-&gt;onConnection('redis-fast')</code>.</li>
      </ul>
      Очереди — важная часть архитектуры Laravel, позволяющая асинхронно обрабатывать задачи и улучшать отзывчивость приложения.
    </div>
  </div>

  <div class="subsection" id="q-jobs">
    <div class="subsection-title"><i data-lucide="box"></i> Job-классы — отложенные задачи</div>

    <p class="text"><strong>Что это.</strong> Job — класс, который инкапсулирует работу, которую нужно выполнить асинхронно (в очереди). Он содержит всю логику в методе <code>handle()</code> и настраивается через свойства.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="layers" style="width:14px;height:14px"></i> Структура Job-класса</div>
<pre><code><span class="c-key">namespace</span> <span class="c-type">App</span>\<span class="c-type">Jobs</span>;

<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Bus</span>\<span class="c-type">Queueable</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Contracts</span>\<span class="c-type">Queue</span>\<span class="c-type">ShouldQueue</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Foundation</span>\<span class="c-type">Bus</span>\<span class="c-type">Dispatchable</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Queue</span>\<span class="c-type">InteractsWithQueue</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Queue</span>\<span class="c-type">SerializesModels</span>;

<span class="c-key">class</span> <span class="c-type">ProcessPodcast</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">use</span> <span class="c-type">Dispatchable</span>, <span class="c-type">InteractsWithQueue</span>, <span class="c-type">Queueable</span>, <span class="c-type">SerializesModels</span>;

    <span class="c-key">public</span> <span class="c-var">$podcast</span>;

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-var">$podcast</span>)
    {
        <span class="c-var">$this</span>-&gt;<span class="c-var">podcast</span> = <span class="c-var">$podcast</span>;
    }

    <span class="c-key">public function</span> <span class="c-fn">handle</span>()
    {
        <span class="c-comment">// основная логика: обработка подкаста, конвертация, уведомление и т.д.</span>
    }
}</code></pre>

    <p class="text"><strong>Что каждая часть делает:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>handle()</code> — вызывается когда задание извлекается из очереди и выполняется работником. Здесь вся бизнес-логика.</li>
      <li><code>ShouldQueue</code> — интерфейс-маркер, указывающий, что задание должно быть <em>поставлено в очередь</em>, а не выполняться синхронно.</li>
      <li><code>Dispatchable</code> — трейт, позволяет вызывать <code>ProcessPodcast::dispatch(...)</code>.</li>
      <li><code>InteractsWithQueue</code> — методы работы с очередью изнутри job (удалить, освободить, delete, release).</li>
      <li><code>Queueable</code> — задать очередь, соединение, задержку через <code>onQueue()</code>, <code>onConnection()</code>, <code>delay()</code>.</li>
      <li><code>SerializesModels</code> — автоматически превращает Eloquent-модели в ID при сериализации, при десериализации — восстанавливает через <code>findOrFail</code>.</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="sliders" style="width:14px;height:14px"></i> Свойства для управления выполнением</div>
    <table class="data-table">
      <thead><tr><th>Свойство</th><th>Назначение</th><th>Пример</th></tr></thead>
      <tbody>
        <tr>
          <td><code>$tries</code></td>
          <td>Максимальное количество попыток выполнения при ошибках</td>
          <td><code>public $tries = 3;</code></td>
        </tr>
        <tr>
          <td><code>$timeout</code></td>
          <td>Максимальное время выполнения в секундах. Если превышено — задание провалено</td>
          <td><code>public $timeout = 120;</code></td>
        </tr>
        <tr>
          <td><code>$maxExceptions</code></td>
          <td>Максимальное число исключений, после которого задание провалено. Позволяет делать несколько повторных попыток до лимита</td>
          <td><code>public $maxExceptions = 3;</code></td>
        </tr>
        <tr>
          <td><code>$backoff</code></td>
          <td>Задержка между повторными попытками (сек). Может быть числом или массивом (экспоненциальная задержка)</td>
          <td><code>public $backoff = [10, 30, 60];</code></td>
        </tr>
      </tbody>
    </table>
    <p class="text">Эти свойства задаются прямо в классе или через метод <code>retryUntil()</code> для динамической задержки.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="hammer" style="width:14px;height:14px"></i> Пример с настройками</div>
<pre><code><span class="c-key">class</span> <span class="c-type">SendOrderConfirmation</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">use</span> <span class="c-type">Dispatchable</span>, <span class="c-type">InteractsWithQueue</span>, <span class="c-type">Queueable</span>, <span class="c-type">SerializesModels</span>;

    <span class="c-key">public</span> <span class="c-var">$order</span>;
    <span class="c-key">public</span> <span class="c-var">$tries</span>   = <span class="c-num">5</span>;
    <span class="c-key">public</span> <span class="c-var">$timeout</span> = <span class="c-num">60</span>;
    <span class="c-key">public</span> <span class="c-var">$backoff</span> = [<span class="c-num">15</span>, <span class="c-num">30</span>, <span class="c-num">60</span>];   <span class="c-comment">// после 1-й ошибки — 15с, 2-й — 30с, 3-й — 60с</span>

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-type">Order</span> <span class="c-var">$order</span>)
    {
        <span class="c-var">$this</span>-&gt;<span class="c-var">order</span> = <span class="c-var">$order</span>;
    }

    <span class="c-key">public function</span> <span class="c-fn">handle</span>()
    {
        <span class="c-comment">// Отправляем подтверждение заказа</span>
        <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$this</span>-&gt;<span class="c-var">order</span>-&gt;<span class="c-var">user</span>-&gt;<span class="c-var">email</span>)
            -&gt;<span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">OrderConfirmation</span>(<span class="c-var">$this</span>-&gt;<span class="c-var">order</span>));
    }
}</code></pre>

    <p class="text"><strong>Запуск job</strong> — в контроллере или где угодно:</p>
<pre><code><span class="c-type">SendOrderConfirmation</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);</code></pre>

    <div class="pitfall">
      <strong>Важные моменты:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Если задание выбрасывает исключение, количество попыток уменьшается. После исчерпания <code>$tries</code> — задание помещается в таблицу <code>failed_jobs</code>.</li>
        <li><code>$timeout</code> должен быть меньше, чем таймаут воркера <code>queue:work</code> (по умолчанию 60 секунд). Иначе воркер может убить задание раньше срабатывания собственного timeout.</li>
        <li>Для <em>динамического</em> таймаута — метод <code>retryUntil()</code>, возвращающий <code>Carbon</code>-объект «до этого момента ретраить».</li>
        <li><code>$backoff</code> принимает массив — каждый элемент это задержка перед N+1 попыткой. Если указано одно число — задержка одинаковая для всех попыток.</li>
      </ul>
    </div>

    <div class="remember-box">
      <strong>Зачем эти настройки:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li><strong>Надёжность</strong> — автоматические повторные попытки при временных сбоях (сеть, внешний API).</li>
        <li><strong>Контроль времени</strong> — не даём заданию зависнуть навсегда.</li>
        <li><strong>Гибкость</strong> — разные задачи могут иметь разные стратегии повторных попыток.</li>
      </ul>
      <strong>Итог.</strong> Job-классы — основа асинхронной обработки в Laravel. Они определяют работу (<code>handle()</code>), а свойства (<code>$tries</code>, <code>$timeout</code>, <code>$backoff</code>) управляют поведением при ошибках, делая систему устойчивой и предсказуемой.
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="workflow" style="width:14px;height:14px"></i> Как это работает: асинхронность и параллельность</div>

    <p class="text">Job-классы с интерфейсом <code>ShouldQueue</code> — это <strong>асинхронные задачи</strong>, которые выполняются параллельно, не блокируя основной процесс (поток выполнения, который обрабатывает запрос пользователя).</p>

    <p class="text"><strong>Полный поток выполнения:</strong></p>
    <ol style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Основной процесс (контроллер, команда) создаёт задачу и вызывает <code>dispatch()</code>.</li>
      <li>Задача <em>немедленно</em> помещается в очередь (в драйвер: БД, Redis, SQS и т.д.).</li>
      <li>Основной процесс продолжает выполнение — отправляет ответ пользователю, не дожидаясь завершения задачи.</li>
      <li>Отдельный воркер (<code>php artisan queue:work</code>) в фоновом режиме забирает задачи из очереди и выполняет их одновременно с другими запросами и другими воркерами.</li>
    </ol>
    <p class="text">Таким образом, пока пользователь получает мгновенный ответ, тяжёлая обработка (отправка писем, генерация PDF, импорт данных) происходит за кадром, не замедляя работу приложения.</p>

    <p class="text"><strong>Про параллельность:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Один воркер обрабатывает только <strong>одну задачу за раз</strong>.</li>
      <li>Чтобы обрабатывать задачи <strong>параллельно</strong>, нужно запустить несколько воркеров (или использовать <code>supervisor</code> для управления процессами).</li>
      <li>Воркеры могут быть запущены на <strong>разных серверах</strong> — это распределённая обработка.</li>
    </ul>

    <p class="text"><strong>Пример:</strong></p>
<pre><code><span class="c-comment">// В контроллере</span>
<span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>)
{
    <span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">create</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());

    <span class="c-comment">// Отправляем задачу в очередь — займёт миллисекунды</span>
    <span class="c-type">SendOrderConfirmation</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);

    <span class="c-comment">// Ответ пользователю возвращается сразу, без ожидания письма</span>
    <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>([<span class="c-str">'message'</span> =&gt; <span class="c-str">'Order placed, confirmation will be sent'</span>], <span class="c-num">201</span>);
}</code></pre>
    <p class="text">Пользователь получает ответ сразу, а письмо отправляется <em>параллельно</em> в фоне.</p>

    <div class="pitfall">
      <strong>Важно:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li><strong>Не все Job-классы асинхронны.</strong> Если не добавить <code>implements ShouldQueue</code>, задача выполняется <em>синхронно</em> прямо в момент <code>dispatch()</code>.</li>
        <li>Параллельность ограничена количеством запущенных воркеров и настройками очереди (например, <code>php artisan queue:work --queue=high,default</code>).</li>
        <li>Даже с <strong>одним воркером</strong> задачи выполняются последовательно, но всё равно <em>асинхронно</em> — не блокируют основной процесс. Параллельность — это уже вопрос масштабирования.</li>
      </ul>
    </div>

    <div class="remember-box">
      <strong>Итог по параллельности.</strong> Job-классы с <code>ShouldQueue</code> — способ выполнять тяжёлые операции фоново, не блокируя пользовательские запросы. Обрабатываются параллельно при наличии нескольких воркеров и значительно повышают отзывчивость приложения. Формула: <em>больше воркеров → выше пропускная способность обработки очереди</em>.
    </div>
  </div>

  <div class="subsection" id="q-chains-batches">
    <div class="subsection-title"><i data-lucide="git-merge"></i> Chains и Batches — управление группами задач</div>

    <p class="text">Chains и Batches — это способы организовать выполнение <strong>нескольких задач (jobs)</strong> скоординированно. Отличаются порядком, поведением при ошибках и возможностью отслеживать прогресс.</p>

    <div class="card">
      <h3>Chain (Цепочка) — последовательное выполнение</h3>
      <p>Задачи выполняются <strong>одна за другой</strong>, строго по порядку. Если какая-то задача в цепочке завершается с ошибкой (исключение), выполнение <em>всей цепочки прерывается</em> — остальные задачи не запускаются.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Support</span>\<span class="c-type">Facades</span>\<span class="c-type">Bus</span>;

<span class="c-type">Bus</span>::<span class="c-fn">chain</span>([
    <span class="c-key">new</span> <span class="c-type">DownloadFileJob</span>(<span class="c-var">$fileId</span>),
    <span class="c-key">new</span> <span class="c-type">ProcessFileJob</span>(<span class="c-var">$fileId</span>),
    <span class="c-key">new</span> <span class="c-type">NotifyUserJob</span>(<span class="c-var">$userId</span>),
])-&gt;<span class="c-fn">dispatch</span>();</code></pre>
      <p><strong>Применение:</strong> когда следующая задача зависит от результата предыдущей (скачать → обработать → уведомить). В таком случае нельзя запускать их одновременно.</p>
    </div>

    <div class="card">
      <h3>Batch (Пакет) — параллельное выполнение</h3>
      <p>Задачи выполняются <strong>параллельно</strong> (одновременно), независимо друг от друга. Можно добавить финальные колбэки:</p>
      <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
        <li><code>then</code> — вызывается, когда все задачи <em>успешно</em> завершены.</li>
        <li><code>catch</code> — вызывается, если хотя бы одна задача упала (исключение).</li>
        <li><code>finally</code> — вызывается в любом случае, после выполнения всех задач.</li>
      </ul>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Support</span>\<span class="c-type">Facades</span>\<span class="c-type">Bus</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Bus</span>\<span class="c-type">Batch</span>;
<span class="c-key">use</span> <span class="c-type">Throwable</span>;

<span class="c-var">$batch</span> = <span class="c-type">Bus</span>::<span class="c-fn">batch</span>([
    <span class="c-key">new</span> <span class="c-type">SendEmailToUser</span>(<span class="c-var">$user1</span>),
    <span class="c-key">new</span> <span class="c-type">SendEmailToUser</span>(<span class="c-var">$user2</span>),
    <span class="c-key">new</span> <span class="c-type">SendEmailToUser</span>(<span class="c-var">$user3</span>),
])-&gt;<span class="c-fn">then</span>(<span class="c-key">function</span> (<span class="c-type">Batch</span> <span class="c-var">$batch</span>) {
    <span class="c-comment">// все успешно</span>
})-&gt;<span class="c-fn">catch</span>(<span class="c-key">function</span> (<span class="c-type">Batch</span> <span class="c-var">$batch</span>, <span class="c-type">Throwable</span> <span class="c-var">$e</span>) {
    <span class="c-comment">// что-то упало</span>
})-&gt;<span class="c-fn">finally</span>(<span class="c-key">function</span> (<span class="c-type">Batch</span> <span class="c-var">$batch</span>) {
    <span class="c-comment">// всегда</span>
})-&gt;<span class="c-fn">dispatch</span>();</code></pre>
      <p><strong>Применение:</strong> когда задачи независимы и их можно выполнять одновременно для ускорения (отправка нескольких писем, обработка независимых файлов, параллельные API-запросы).</p>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="settings" style="width:14px;height:14px"></i> Важные особенности</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Для <strong>Batches</strong> нужна таблица <code>job_batches</code> для хранения состояния пакетов. Создаётся командой:
<pre style="margin-top:6px"><code>php artisan queue:batches-table
php artisan migrate</code></pre>
      </li>
      <li>В <strong>цепочках</strong> нельзя получить доступ к состоянию промежуточных задач (только через передачу данных, например, через общий объект или кеш).</li>
      <li>В <strong>батчах</strong> можно отслеживать прогресс через <code>$batch-&gt;progress()</code> (0–100), или отменить через <code>$batch-&gt;cancel()</code>.</li>
      <li>Цепочки <strong>не требуют дополнительной таблицы</strong> и поддерживаются даже в драйвере <code>sync</code>.</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="git-compare" style="width:14px;height:14px"></i> Сравнение Chain vs Batch</div>
    <table class="data-table">
      <thead><tr><th>Характеристика</th><th>Chain</th><th>Batch</th></tr></thead>
      <tbody>
        <tr>
          <td><strong>Порядок выполнения</strong></td>
          <td>Строго последовательный</td>
          <td>Параллельный</td>
        </tr>
        <tr>
          <td><strong>При ошибке</strong></td>
          <td>Прерывается вся цепочка</td>
          <td>Продолжается выполнение остальных задач</td>
        </tr>
        <tr>
          <td><strong>Финальные колбэки</strong></td>
          <td>Нет (можно добавить свою задачу в конце)</td>
          <td><code>then</code>, <code>catch</code>, <code>finally</code></td>
        </tr>
        <tr>
          <td><strong>Отслеживание прогресса</strong></td>
          <td>Нет</td>
          <td>Есть — <code>$batch-&gt;progress()</code></td>
        </tr>
        <tr>
          <td><strong>Отмена</strong></td>
          <td>Нет</td>
          <td><code>$batch-&gt;cancel()</code></td>
        </tr>
        <tr>
          <td><strong>Дополнительная таблица</strong></td>
          <td>Не нужна</td>
          <td>Нужна (<code>job_batches</code>)</td>
        </tr>
        <tr>
          <td><strong>Работает с драйвером <code>sync</code></strong></td>
          <td>Да</td>
          <td>Только с БД-совместимыми (нужен доступ к job_batches)</td>
        </tr>
      </tbody>
    </table>

    <div class="remember-box">
      <strong>Итог.</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li><strong>Chain</strong> — для последовательных задач, где важен порядок и зависимость (скачать → обработать → уведомить).</li>
        <li><strong>Batch</strong> — для параллельных независимых задач, с возможностью реагировать на успех/ошибку всех или одной из них (массовая рассылка писем, параллельная обработка файлов).</li>
      </ul>
    </div>
  </div>

  <div class="subsection" id="q-rate-limit">
    <div class="subsection-title"><i data-lucide="gauge"></i> Rate Limiting для Job — защита от перегрузки внешних API</div>

    <p class="text">В Laravel можно ограничивать частоту выполнения заданий очереди (jobs), чтобы не перегружать внешние сервисы (API, БД, сторонние сервисы) слишком большим количеством запросов.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="help-circle" style="width:14px;height:14px"></i> Зачем это нужно</div>
    <p class="text">Если приложение отправляет тысячи писем через внешний SMTP, вызывает API (Telegram, Google Maps, платёжки) или выполняет действия с ограничениями по частоте — легко превысить лимиты, получить <code>429 Too Many Requests</code> или быть заблокированным. Очереди позволяют <em>замедлить</em> выполнение таких задач, соблюдая квоты.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="split" style="width:14px;height:14px"></i> Как работает — 2 подхода</div>

    <div class="card">
      <h3>1. Middleware <code>RateLimited</code> (рекомендуемый способ)</h3>
      <p>Применяем специальный middleware к job-классу — он проверяет лимит и при необходимости откладывает выполнение.</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Queue</span>\<span class="c-type">Middleware</span>\<span class="c-type">RateLimited</span>;

<span class="c-key">class</span> <span class="c-type">ProcessExternalApiJob</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">public function</span> <span class="c-fn">middleware</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-key">new</span> <span class="c-type">RateLimited</span>(<span class="c-str">'api-calls'</span>),   <span class="c-comment">// идентификатор лимита</span>
        ];
    }

    <span class="c-key">public function</span> <span class="c-fn">handle</span>()
    {
        <span class="c-comment">// Вызов внешнего API</span>
    }
}</code></pre>

      <p>Лимит <code>'api-calls'</code> определяется в <code>App\Providers\AppServiceProvider</code> (в <code>boot()</code>) через фасад <code>RateLimiter</code>:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Cache</span>\<span class="c-type">RateLimiting</span>\<span class="c-type">Limit</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Support</span>\<span class="c-type">Facades</span>\<span class="c-type">RateLimiter</span>;

<span class="c-type">RateLimiter</span>::<span class="c-fn">for</span>(<span class="c-str">'api-calls'</span>, <span class="c-key">function</span> (<span class="c-var">$job</span>) {
    <span class="c-key">return</span> <span class="c-type">Limit</span>::<span class="c-fn">perMinute</span>(<span class="c-num">100</span>);   <span class="c-comment">// 100 вызовов в минуту</span>
});</code></pre>
      <p>Когда лимит превышен, Laravel автоматически <code>release()</code>-ит задание с задержкой (по умолчанию — до следующего окна). Задание повторно попытается выполниться позже, когда лимит будет доступен.</p>

      <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="info" style="width:14px;height:14px"></i> Почему <code>middleware()</code> возвращает <code>new RateLimited('api-calls')</code>, а не сам лимит</div>

      <p>Ключевой момент, который вызывает путаницу: <code>middleware()</code> — это <strong>не обычный метод для обработки запроса</strong>, а метод для <em>регистрации промежуточного слоя</em>, который будет применён к job перед выполнением.</p>

      <p><strong>Как это работает на самом деле.</strong> В классе Job вы определяете метод <code>middleware()</code>, который возвращает массив <em>объектов middleware</em>. Этот метод вызывается при сериализации/десериализации Job для определения, какие middleware применить.</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">middleware</span>(): <span class="c-key">array</span>
{
    <span class="c-key">return</span> [
        <span class="c-key">new</span> <span class="c-type">RateLimited</span>(<span class="c-str">'api-calls'</span>),
    ];
}</code></pre>
      <p>Здесь <code>'api-calls'</code> — это <strong>идентификатор (имя) лимита</strong>, который связывает job с соответствующей конфигурацией в <code>RateLimiter</code>.</p>

      <p><strong>Где задаётся сам лимит.</strong> В <code>App\Providers\AppServiceProvider</code> (или другом сервис-провайдере) определяете правила для этого идентификатора через <code>RateLimiter::for()</code>:</p>
<pre><code><span class="c-type">RateLimiter</span>::<span class="c-fn">for</span>(<span class="c-str">'api-calls'</span>, <span class="c-key">function</span> (<span class="c-var">$job</span>) {
    <span class="c-key">return</span> <span class="c-type">Limit</span>::<span class="c-fn">perMinute</span>(<span class="c-num">100</span>);
});</code></pre>
      <p>Лимит настраивается <em>отдельно</em> от job и может быть легко изменён без правки самого Job-класса.</p>

      <p><strong>Что делает Laravel при выполнении Job:</strong></p>
      <ol style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
        <li>Берёт задание из очереди.</li>
        <li>Проверяет, есть ли зарегистрированные middleware через метод <code>middleware()</code>.</li>
        <li>Если есть, оборачивает выполнение задания в стек этих middleware.</li>
        <li>Middleware <code>RateLimited</code> проверяет через <code>RateLimiter</code>, превышен ли лимит для <code>'api-calls'</code>. Если да — вызывает <code>$this-&gt;release($delay)</code>: задание освобождается обратно в очередь с задержкой (по умолчанию — до восстановления лимита через <code>availableIn()</code>), воркер переходит к следующему заданию.</li>
      </ol>

      <p><strong>Почему так сделано:</strong></p>
      <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
        <li><strong>Разделение ответственности:</strong> Job содержит бизнес-логику, а ограничения частоты вынесены в отдельную настройку.</li>
        <li><strong>Гибкость:</strong> лимиты (100 → 200 запросов в минуту) меняются без пересборки Job-классов — правится только провайдер.</li>
        <li><strong>Переиспользование:</strong> один <code>RateLimited</code> middleware применяется к разным Job-классам с разными идентификаторами, и для каждого задан свой лимит.</li>
      </ul>

      <div class="pitfall">
        <strong>Важный нюанс.</strong> Метод <code>middleware()</code> <em>не вызывается</em> в момент выполнения бизнес-логики. Он вызывается при сериализации/десериализации Job для определения списка применяемых middleware. Поэтому он должен быть лёгким и не содержать логики, зависящей от текущего состояния приложения (запросов к БД, чтения кеша и т.д.).
      </div>

      <p><strong>Полный цикл в одном примере:</strong></p>
<pre><code><span class="c-comment">// app/Jobs/ProcessExternalApiJob.php</span>
<span class="c-key">class</span> <span class="c-type">ProcessExternalApiJob</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">use</span> <span class="c-type">Dispatchable</span>, <span class="c-type">InteractsWithQueue</span>, <span class="c-type">Queueable</span>, <span class="c-type">SerializesModels</span>;

    <span class="c-key">public function</span> <span class="c-fn">middleware</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [<span class="c-key">new</span> <span class="c-type">RateLimited</span>(<span class="c-str">'api-calls'</span>)];
    }

    <span class="c-key">public function</span> <span class="c-fn">handle</span>()
    {
        <span class="c-comment">// внешний API запрос</span>
    }
}

<span class="c-comment">// App\Providers\AppServiceProvider::boot()</span>
<span class="c-type">RateLimiter</span>::<span class="c-fn">for</span>(<span class="c-str">'api-calls'</span>, <span class="c-key">function</span> (<span class="c-var">$job</span>) {
    <span class="c-key">return</span> <span class="c-type">Limit</span>::<span class="c-fn">perMinute</span>(<span class="c-num">100</span>)-&gt;<span class="c-fn">by</span>(<span class="c-var">$job</span>-&gt;<span class="c-var">user</span>?-&gt;<span class="c-var">id</span> ?? <span class="c-str">'global'</span>);
});</code></pre>
      <p>Порядок работы: <code>dispatch()</code> → job в очереди → воркер берёт → middleware <code>RateLimited</code> проверяет лимит для <code>'api-calls'</code> (с учётом <code>by(...)</code>) → если превышен: <code>release()</code> с задержкой (повтор позже); если не превышен: выполняется <code>handle()</code>.</p>

      <div class="remember-box">
        <strong>Резюме.</strong> <code>middleware()</code> возвращает <em>объекты middleware</em> для последующей обработки задания. Сам лимит настраивается вне Job — через <code>RateLimiter::for()</code>. <code>RateLimited</code> — это инструмент, который проверяет лимит и при необходимости откладывает выполнение (не возвращает HTTP-ответ, как в web-middleware). Такой подход централизованно управляет нагрузкой на внешние ресурсы, сохраняя код чистым и гибким.
      </div>
    </div>

    <div class="card">
      <h3>2. Через <code>RateLimiter</code> вручную внутри <code>handle()</code></h3>
      <p>Более гранулярный контроль — сами проверяем лимит и вызываем <code>release()</code>.</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">handle</span>()
{
    <span class="c-var">$key</span>     = <span class="c-str">'api-calls:'</span> . <span class="c-var">$this</span>-&gt;<span class="c-var">id</span>;
    <span class="c-var">$limiter</span> = <span class="c-fn">app</span>(<span class="c-type">RateLimiter</span>::<span class="c-key">class</span>);

    <span class="c-key">if</span> (<span class="c-var">$limiter</span>-&gt;<span class="c-fn">tooManyAttempts</span>(<span class="c-var">$key</span>, <span class="c-num">100</span>)) {
        <span class="c-var">$this</span>-&gt;<span class="c-fn">release</span>(<span class="c-var">$limiter</span>-&gt;<span class="c-fn">availableIn</span>(<span class="c-var">$key</span>));
        <span class="c-key">return</span>;
    }

    <span class="c-comment">// выполняем запрос</span>
    <span class="c-var">$limiter</span>-&gt;<span class="c-fn">hit</span>(<span class="c-var">$key</span>, <span class="c-num">60</span>);   <span class="c-comment">// учитываем попытку (60 сек окно)</span>

    <span class="c-comment">// ... сам вызов API</span>
}</code></pre>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="settings-2" style="width:14px;height:14px"></i> Настройка поведения</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>Limit::perMinute()</code>, <code>perHour()</code>, <code>perSecond()</code> — задают временные окна.</li>
      <li><code>-&gt;by(...)</code> — ключ для дифференциации лимита (по ID пользователя, IP, внешнему ключу).</li>
      <li><code>-&gt;releaseAfter(N)</code> — время задержки при освобождении задания.</li>
      <li><code>-&gt;response()</code> — кастомный ответ при превышении (для HTTP throttle, не для Job).</li>
    </ul>

    <p class="text"><strong>Пример с разными лимитами для разных пользователей:</strong></p>
<pre><code><span class="c-type">RateLimiter</span>::<span class="c-fn">for</span>(<span class="c-str">'api-calls'</span>, <span class="c-key">function</span> (<span class="c-var">$job</span>) {
    <span class="c-key">return</span> <span class="c-var">$job</span>-&gt;<span class="c-var">user</span>
        ? <span class="c-type">Limit</span>::<span class="c-fn">perMinute</span>(<span class="c-num">100</span>)-&gt;<span class="c-fn">by</span>(<span class="c-var">$job</span>-&gt;<span class="c-var">user</span>-&gt;<span class="c-var">id</span>)
        : <span class="c-type">Limit</span>::<span class="c-fn">perMinute</span>(<span class="c-num">10</span>)-&gt;<span class="c-fn">by</span>(<span class="c-var">$job</span>-&gt;<span class="c-var">ip</span>);
});</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="target" style="width:14px;height:14px"></i> Где применяется</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Отправка email через внешние SMTP</strong> (SendGrid, Mailgun) — у них часто жёсткие лимиты.</li>
      <li><strong>API соцсетей</strong> (Twitter/X, Facebook, Instagram) — строгие ограничения по OAuth-токену.</li>
      <li><strong>Платёжные системы</strong> (Stripe, PayPal) — избегаем ошибок из-за rate limit.</li>
      <li><strong>Парсинг сайтов</strong> — чтобы не заблокировали за слишком частые запросы.</li>
      <li><strong>Пуш-уведомления</strong> (FCM, APNs) — Google и Apple тоже ограничивают.</li>
    </ul>

    <div class="remember-box">
      <strong>Итог.</strong> Rate limiting для Job — механизм контроля частоты выполнения заданий, чтобы не превысить лимиты внешних сервисов. Реализуется через middleware <code>RateLimited</code> (рекомендуемый способ) или вручную с фасадом <code>RateLimiter</code>. При превышении job освобождается с задержкой и повторяется позже — очередь сама регулирует нагрузку. Обязательный инструмент для надёжных интеграций с внешними API.
    </div>
  </div>

  <div class="subsection" id="q-unique">
    <div class="subsection-title"><i data-lucide="fingerprint"></i> Unique Jobs — защита от дублирования</div>

    <p class="text">Иногда одно и то же задание может быть поставлено в очередь несколько раз — из-за повторных кликов пользователя, повторных вызовов API или ошибок в коде. Это приводит к двойной обработке одного заказа, повторной отправке письма или другим проблемам.</p>

    <p class="text"><strong>Unique Jobs</strong> гарантируют, что в очереди одновременно находится <strong>не более одного</strong> задания с заданным уникальным идентификатором. Если попытаться поставить такое же задание повторно — оно будет проигнорировано.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="wrench" style="width:14px;height:14px"></i> Как реализовать</div>
    <p class="text">Добавьте интерфейс <code>ShouldBeUnique</code> к Job-классу и определите метод <code>uniqueId()</code>, возвращающий строковый идентификатор уникальности:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Contracts</span>\<span class="c-type">Queue</span>\<span class="c-type">ShouldBeUnique</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Contracts</span>\<span class="c-type">Queue</span>\<span class="c-type">ShouldQueue</span>;

<span class="c-key">class</span> <span class="c-type">ProcessOrder</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>, <span class="c-type">ShouldBeUnique</span>
{
    <span class="c-key">public</span> <span class="c-var">$orderId</span>;

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-var">$orderId</span>)
    {
        <span class="c-var">$this</span>-&gt;<span class="c-var">orderId</span> = <span class="c-var">$orderId</span>;
    }

    <span class="c-key">public function</span> <span class="c-fn">handle</span>()
    {
        <span class="c-comment">// обработка заказа</span>
    }

    <span class="c-comment">// Уникальный идентификатор — ID заказа</span>
    <span class="c-key">public function</span> <span class="c-fn">uniqueId</span>()
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-var">orderId</span>;
    }
}</code></pre>
    <p class="text">Теперь, если вызвать <code>ProcessOrder::dispatch($orderId)</code> дважды, пока первое задание ещё не обработано — второе будет проигнорировано (не попадёт в очередь).</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="settings-2" style="width:14px;height:14px"></i> Дополнительные настройки</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>$uniqueFor</code> — время (в секундах), в течение которого блокировка считается активной. По умолчанию — время удержания задания (обычно 24 часа).
<pre style="margin-top:6px"><code><span class="c-key">public</span> <span class="c-var">$uniqueFor</span> = <span class="c-num">3600</span>;   <span class="c-comment">// блокировка на 1 час</span></code></pre>
      </li>
      <li><code>uniqueVia()</code> — метод, определяющий драйвер для хранения блокировок (по умолчанию — кеш):
<pre style="margin-top:6px"><code><span class="c-key">public function</span> <span class="c-fn">uniqueVia</span>()
{
    <span class="c-key">return</span> <span class="c-type">Cache</span>::<span class="c-fn">driver</span>(<span class="c-str">'redis'</span>);
}</code></pre>
      </li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="cpu" style="width:14px;height:14px"></i> Как это работает под капотом</div>
    <p class="text">При попытке поставить задание в очередь Laravel:</p>
    <ol style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Вычисляет уникальный идентификатор через <code>uniqueId()</code>.</li>
      <li>Пытается создать блокировку в хранилище (по умолчанию — кеш) с этим идентификатором.</li>
      <li>Если блокировка успешно создана — задание ставится в очередь.</li>
      <li>Если блокировка уже существует — задание не ставится, при <code>dispatch()</code> возвращается <code>null</code>/<code>false</code>.</li>
      <li>По завершению задания (или его неудаче) блокировка автоматически снимается.</li>
    </ol>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="target" style="width:14px;height:14px"></i> Когда это полезно</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Обработка заказов</strong> — не обработать один заказ дважды.</li>
      <li><strong>Отправка email</strong> — не отправить письмо повторно.</li>
      <li><strong>Синхронизация с внешним API</strong> — не слать дублирующиеся запросы.</li>
      <li><strong>Импорт данных</strong> — не запускать импорт повторно, пока идёт предыдущий.</li>
    </ul>

    <div class="pitfall">
      <strong>Важные нюансы:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Если задание выполняется и падает с ошибкой, оно может быть повторно поставлено в очередь (в зависимости от <code>$tries</code> и <code>$backoff</code>). Уникальность действует на протяжении всего времени, пока задание в очереди или выполняется.</li>
        <li>Для работы Unique Jobs нужен драйвер кеша, поддерживающий блокировки: <code>redis</code>, <code>memcached</code>, <code>database</code>. Драйверы <code>file</code> и <code>array</code> <em>не подходят</em>.</li>
        <li>Если задание по какой-то причине не было удалено из очереди (воркер упал), блокировка может остаться — в этом случае поможет <code>$uniqueFor</code>.</li>
      </ul>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="hammer" style="width:14px;height:14px"></i> Полный пример</div>
<pre><code><span class="c-key">class</span> <span class="c-type">UpdateUserCache</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>, <span class="c-type">ShouldBeUnique</span>
{
    <span class="c-key">public</span> <span class="c-var">$userId</span>;
    <span class="c-key">public</span> <span class="c-var">$uniqueFor</span> = <span class="c-num">600</span>;   <span class="c-comment">// блокировка на 10 минут</span>

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-var">$userId</span>)
    {
        <span class="c-var">$this</span>-&gt;<span class="c-var">userId</span> = <span class="c-var">$userId</span>;
    }

    <span class="c-key">public function</span> <span class="c-fn">uniqueId</span>()
    {
        <span class="c-key">return</span> <span class="c-str">'user-cache:'</span> . <span class="c-var">$this</span>-&gt;<span class="c-var">userId</span>;
    }

    <span class="c-key">public function</span> <span class="c-fn">handle</span>()
    {
        <span class="c-type">Cache</span>::<span class="c-fn">put</span>(<span class="c-str">'user_'</span> . <span class="c-var">$this</span>-&gt;<span class="c-var">userId</span>, <span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-var">$this</span>-&gt;<span class="c-var">userId</span>));
    }
}</code></pre>
    <p class="text">Если за 10 минут поступит два вызова <code>UpdateUserCache::dispatch($userId)</code> для одного пользователя, второй будет проигнорирован — первое задание ещё в очереди или выполняется.</p>

    <div class="remember-box">
      <strong>Итог:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li><code>ShouldBeUnique</code> — интерфейс для предотвращения дублирования заданий.</li>
        <li><code>uniqueId()</code> — метод, возвращающий строку, по которой определяется уникальность.</li>
        <li>Блокировка работает через кеш и автоматически снимается после выполнения или сбоя.</li>
        <li>Защищает от двойной постановки, дублирующей обработки и избыточной нагрузки.</li>
      </ul>
    </div>
  </div>

  <div class="subsection" id="q-features">
    <div class="subsection-title"><i data-lucide="list"></i> Возможности</div>
    <div class="card"><h3>Драйверы</h3><p class="text"><code>sync</code> — исполнение в текущем процессе (тесты). <code>database</code> — таблица jobs в БД (просто, медленно). <code>redis</code> — Redis-list, быстрый. <code>sqs</code>, <code>beanstalkd</code> — внешние. Подробнее — в подразделе <strong>Драйверы</strong> выше.</p></div>
    <div class="card"><h3>Job-классы</h3><p class="text">Класс с <code>handle()</code> методом. Имплементирует <code>ShouldQueue</code>. Свойства: <code>$tries</code>, <code>$timeout</code>, <code>$maxExceptions</code>, <code>$backoff</code>.</p></div>
    <div class="card"><h3>Retry и backoff</h3><p class="text">При исключении job ставится обратно в очередь до <code>$tries</code> раз. <code>$backoff = [10, 30, 60]</code> — задержки между попытками. После исчерпания — таблица <code>failed_jobs</code>.</p></div>
    <div class="card"><h3>Chains, Batches</h3><p class="text">Chain — последовательное исполнение нескольких jobs (если один упал — остальные не идут). Batch — параллельное с финальным callback, когда все завершились (или хотя бы один упал).</p></div>
    <div class="card"><h3>Rate limiting</h3><p class="text"><code>RateLimited::for('api-calls')</code> middleware на job. Откладывает исполнение, если лимит превышен. Защищает от перегрузки внешних API.</p></div>
    <div class="card"><h3>Unique jobs</h3><p class="text"><code>ShouldBeUnique</code> — гарантия, что в очереди не более одного job этого типа с тем же <code>$uniqueId</code>. Защита от двойной постановки.</p></div>
  </div>

  <div class="subsection" id="q-practice">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: job с retry и idempotency</div>
<pre><code><span class="c-key">final class</span> <span class="c-type">SendInvoice</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">use</span> <span class="c-type">Queueable</span>;

    <span class="c-key">public int</span> <span class="c-var">$tries</span>     = <span class="c-num">5</span>;
    <span class="c-key">public int</span> <span class="c-var">$timeout</span>   = <span class="c-num">120</span>;
    <span class="c-key">public array</span> <span class="c-var">$backoff</span> = [<span class="c-num">10</span>, <span class="c-num">30</span>, <span class="c-num">60</span>, <span class="c-num">300</span>];

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">public</span> <span class="c-key">int</span> <span class="c-var">$orderId</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">InvoiceMailer</span> <span class="c-var">$mailer</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">findOrFail</span>(<span class="c-var">$this</span>-&gt;<span class="c-var">orderId</span>);

        <span class="c-comment">// Идемпотентность: если invoice уже отправлен — выходим</span>
        <span class="c-key">if</span> (<span class="c-var">$order</span>-&gt;<span class="c-var">invoice_sent_at</span>) <span class="c-key">return</span>;

        <span class="c-var">$mailer</span>-&gt;<span class="c-fn">send</span>(<span class="c-var">$order</span>);
        <span class="c-var">$order</span>-&gt;<span class="c-fn">update</span>([<span class="c-str">'invoice_sent_at'</span> =&gt; <span class="c-fn">now</span>()]);
    }

    <span class="c-key">public function</span> <span class="c-fn">failed</span>(<span class="c-type">Throwable</span> <span class="c-var">$e</span>): <span class="c-key">void</span>
    {
        <span class="c-comment">// Финальный обработчик после исчерпания retries</span>
        <span class="c-type">Log</span>::<span class="c-fn">error</span>(<span class="c-str">'invoice.failed'</span>, [<span class="c-str">'order_id'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">orderId</span>, <span class="c-str">'error'</span> =&gt; <span class="c-var">$e</span>-&gt;<span class="c-fn">getMessage</span>()]);
    }
}
</code></pre>
  </div>

  <div class="subsection" id="q-pitfalls">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Job без идемпотентности.</strong> Retry означает, что handle вызовется N раз при сбоях. Если job отправляет письмо без проверки факта — пользователь получит N писем. Делайте handle идемпотентным.</div>
    <div class="pitfall"><strong>2. Передача Eloquent-модели в job.</strong> Модель сериализуется через <code>SerializesModels</code> — в БД хранится <code>['id' =&gt; 42]</code>, а в handle снова загружается через <code>findOrFail</code>. Если строка удалена между постановкой и исполнением — <code>ModelNotFoundException</code>.</div>
    <div class="pitfall"><strong>3. Транзакция вокруг dispatch.</strong> <code>DB::transaction(fn () =&gt; { ... ; SendInvoice::dispatch($order); })</code> — job отправлен до commit'а; воркер пытается найти order, которого ещё нет в БД. Используйте <code>dispatch()-&gt;afterCommit()</code> или <code>$afterCommit = true</code> в job.</div>
    <div class="pitfall"><strong>4. Долгий handle, превышающий timeout.</strong> Воркер убивает процесс через <code>$timeout</code> сек, job остаётся в БД как «в обработке». В таком случае увеличьте timeout или разбейте на несколько jobs.</div>
    <div class="pitfall"><strong>5. <code>$tries = 0</code>.</strong> Означает «бесконечные попытки». Если job всегда падает, воркер крутится в цикле. Лучше явное число.</div>
    <div class="pitfall"><strong>6. <code>maxExceptions</code> vs <code>tries</code>.</strong> <code>tries</code> — общее число запусков (включая успешные). <code>maxExceptions</code> — только неуспешных. Для jobs, которые часто timeout-ят без exception, нужно следить за обоими.</div>
    <div class="pitfall"><strong>7. Failed jobs без мониторинга.</strong> Таблица <code>failed_jobs</code> копится молча. Без алерта или дашборда (Horizon) проблемы обнаруживаются через жалобы пользователей.</div>
    <div class="pitfall"><strong>8. Воркер без <code>--max-time</code>.</strong> Долгоживущий воркер копит память (особенно в Laravel без Octane). Перезапуск через <code>--max-time=3600</code> освобождает память.</div>
  </div>
</div>

<div id="sec-events" class="section">
  <div class="section-title">Events &amp; Listeners</div>
  <div class="subsection" id="ev-purpose">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">События — механизм слабого связывания: код «эмитит» событие, не зная, кто на него подпишется. Несколько listeners могут реагировать независимо. Это основной способ организации side-effects (отправка письма после регистрации, audit-лог, обновление аналитики) без раздувания основного кода.</p>
  </div>

  <div class="subsection" id="ev-components">
    <div class="subsection-title"><i data-lucide="list"></i> Компоненты</div>
    <div class="card"><h3>Event class</h3><p class="text">DTO с публичными свойствами. Имплементирует ничего особого (или <code>ShouldBroadcast</code>, если транслируется). Создание: <code>php artisan make:event OrderPaid</code>.</p></div>
    <div class="card"><h3>Listener class</h3><p class="text">Класс с <code>handle(Event $event)</code>. Может имплементировать <code>ShouldQueue</code> — тогда исполнение асинхронно через очередь. Регистрация — в <code>EventServiceProvider::$listen</code> или через <code>Event::listen(...)</code>.</p></div>
    <div class="card"><h3>Auto-discovery</h3><p class="text">С Laravel 8+ Listeners автоматически обнаруживаются по типу аргумента <code>handle</code>. Включается через <code>$shouldDiscoverEvents</code>. Удобно, но усложняет grep — найти всех слушателей события через явный массив проще.</p></div>
    <div class="card"><h3>Subscriber</h3><p class="text">Класс, объявляющий несколько листенеров через <code>subscribe(Dispatcher $events)</code>. Полезно для группировки логически связанных слушателей.</p></div>
    <div class="card"><h3>Eloquent events</h3><p class="text"><code>created</code>, <code>updated</code>, <code>deleted</code>, <code>retrieved</code> — события моделей. Подписка через observers или <code>static::created(fn ($model) =&gt; ...)</code> в boot модели.</p></div>
  </div>

  <div class="subsection" id="ev-event-class">
    <div class="subsection-title"><i data-lucide="file-code"></i> Event Class — DTO для сигнализации о событиях</div>

    <p class="text"><strong>Что это.</strong> Event — это <strong>класс-контейнер (DTO)</strong>, который инкапсулирует информацию о произошедшем действии («заказ оплачен», «пользователь зарегистрирован»). Он не содержит бизнес-логики — только передаёт данные слушателям (Listeners).</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="layers" style="width:14px;height:14px"></i> Структура Event-класса</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Публичные свойства</strong> — данные, доступные слушателям (модель заказа, ID пользователя, доп. параметры).</li>
      <li><strong>Конструктор</strong> — принимает данные и инициализирует свойства.</li>
      <li><strong>Интерфейсы</strong> — обычно ничего не имплементирует; если событие транслируется через WebSockets — реализует <code>ShouldBroadcast</code>.</li>
    </ul>

    <p class="text"><strong>Создание через artisan:</strong></p>
<pre><code>php artisan make:event <span class="c-type">OrderPaid</span></code></pre>

    <p class="text">Создаётся класс в <code>app/Events/OrderPaid.php</code>:</p>
<pre><code><span class="c-key">namespace</span> <span class="c-type">App</span>\<span class="c-type">Events</span>;

<span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Models</span>\<span class="c-type">Order</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Foundation</span>\<span class="c-type">Events</span>\<span class="c-type">Dispatchable</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Queue</span>\<span class="c-type">SerializesModels</span>;

<span class="c-key">class</span> <span class="c-type">OrderPaid</span>
{
    <span class="c-key">use</span> <span class="c-type">Dispatchable</span>, <span class="c-type">SerializesModels</span>;

    <span class="c-key">public</span> <span class="c-type">Order</span> <span class="c-var">$order</span>;

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-type">Order</span> <span class="c-var">$order</span>)
    {
        <span class="c-var">$this</span>-&gt;<span class="c-var">order</span> = <span class="c-var">$order</span>;
    }
}</code></pre>

    <p class="text"><strong>Разбор трейтов:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>Dispatchable</code> — даёт метод <code>dispatch()</code> для вызова события (<code>OrderPaid::dispatch($order)</code> вместо <code>event(new OrderPaid($order))</code>).</li>
      <li><code>SerializesModels</code> — позволяет корректно сериализовать модели Eloquent при передаче в очередь (если listener асинхронный). Сохраняется только <code>id</code>, при выполнении происходит <code>findOrFail</code>.</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="send" style="width:14px;height:14px"></i> Диспатч события</div>
<pre><code><span class="c-comment">// 2 равнозначных способа</span>
<span class="c-fn">event</span>(<span class="c-key">new</span> <span class="c-type">OrderPaid</span>(<span class="c-var">$order</span>));

<span class="c-type">OrderPaid</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);</code></pre>
    <p class="text">После диспатча все зарегистрированные listeners получают экземпляр события и выполняют свои действия (синхронно или через очередь если реализуют <code>ShouldQueue</code>).</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="target" style="width:14px;height:14px"></i> Для чего нужны события</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Разделение ответственности</strong> — код, который инициирует событие, не знает о том, что с ним будет сделано.</li>
      <li><strong>Гибкость</strong> — можно добавлять новые listeners без изменения исходного кода (например, добавить отправку SMS при оплате, не трогая контроллер).</li>
      <li><strong>Асинхронность</strong> — listeners могут реализовать <code>ShouldQueue</code> и выполняться в очереди, не замедляя основной запрос.</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="radio" style="width:14px;height:14px"></i> Broadcasting — трансляция в реальном времени</div>
    <p class="text">Если событие реализует <code>ShouldBroadcast</code> — оно автоматически транслируется через WebSockets (Pusher, Laravel Reverb, Ably). Тогда фронтенд (через Laravel Echo) может получать уведомления о событиях <strong>без перезагрузки страницы</strong>.</p>

<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Contracts</span>\<span class="c-type">Broadcasting</span>\<span class="c-type">ShouldBroadcast</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Broadcasting</span>\<span class="c-type">Channel</span>;

<span class="c-key">class</span> <span class="c-type">OrderPaid</span> <span class="c-key">implements</span> <span class="c-type">ShouldBroadcast</span>
{
    <span class="c-key">use</span> <span class="c-type">Dispatchable</span>, <span class="c-type">SerializesModels</span>;

    <span class="c-key">public</span> <span class="c-type">Order</span> <span class="c-var">$order</span>;

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-type">Order</span> <span class="c-var">$order</span>)
    {
        <span class="c-var">$this</span>-&gt;<span class="c-var">order</span> = <span class="c-var">$order</span>;
    }

    <span class="c-comment">// На какой канал транслировать</span>
    <span class="c-key">public function</span> <span class="c-fn">broadcastOn</span>(): <span class="c-type">Channel</span>
    {
        <span class="c-key">return</span> <span class="c-key">new</span> <span class="c-type">Channel</span>(<span class="c-str">'orders'</span>);
    }

    <span class="c-comment">// (опционально) — данные для WebSocket-подписчиков</span>
    <span class="c-key">public function</span> <span class="c-fn">broadcastWith</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [<span class="c-str">'id'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">order</span>-&gt;<span class="c-var">id</span>, <span class="c-str">'total'</span> =&gt; <span class="c-var">$this</span>-&gt;<span class="c-var">order</span>-&gt;<span class="c-var">total</span>];
    }
}</code></pre>

    <p class="text"><strong>Типы каналов:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>Channel('orders')</code> — публичный, слушать может кто угодно.</li>
      <li><code>PrivateChannel('user.'.$userId)</code> — приватный, требует авторизации.</li>
      <li><code>PresenceChannel('room.42')</code> — приватный + отслеживает кто онлайн.</li>
    </ul>

    <div class="tip">
      По умолчанию <code>ShouldBroadcast</code> ставит трансляцию в очередь (это правильно — не блокирует основной поток). <code>ShouldBroadcastNow</code> — синхронная трансляция, только когда критично.
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="workflow" style="width:14px;height:14px"></i> Как это работает end-to-end: сервер → WebSocket → фронт</div>

    <p class="text"><strong>Важно понимать:</strong> <code>broadcastOn()</code> — <em>не</em> метод, который ты вызываешь напрямую. Это <strong>метод-описание</strong>. Он нужен, чтобы сообщить Laravel <em>по какому каналу</em> транслировать событие. Ты вызываешь <code>OrderPaid::dispatch($order)</code>, а фреймворк сам «спрашивает» у события — какой канал вернёт <code>broadcastOn()</code>.</p>

    <p class="text"><strong>Полный процесс по шагам:</strong></p>

    <div class="card">
      <h3>1. Создаёшь событие с <code>ShouldBroadcast</code></h3>
      <p>Класс реализует интерфейс — маркер для Laravel, что это событие нужно не только обработать внутри, но и отправить на фронтенд.</p>
    </div>

    <div class="card">
      <h3>2. Определяешь канал в <code>broadcastOn()</code></h3>
      <p>Канал — как «комната» или «тема», на которую можно подписаться. Метод возвращает <code>Channel</code> / <code>PrivateChannel</code> / <code>PresenceChannel</code>.</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">broadcastOn</span>(): <span class="c-key">array</span>
{
    <span class="c-key">return</span> [
        <span class="c-key">new</span> <span class="c-type">PrivateChannel</span>(<span class="c-str">'orders.'</span> . <span class="c-var">$this</span>-&gt;<span class="c-var">order</span>-&gt;<span class="c-var">id</span>),
    ];
}</code></pre>
    </div>

    <div class="card">
      <h3>3. Инициируешь событие в коде</h3>
      <p>В контроллере / Action / где угодно:</p>
<pre><code><span class="c-type">OrderPaid</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);
<span class="c-comment">// или event(new OrderPaid($order));</span></code></pre>
      <p>В этот момент Laravel понимает: событие нужно транслировать через WebSocket.</p>
    </div>

    <div class="card">
      <h3>4. Laravel кладёт трансляцию в очередь</h3>
      <p>Трансляция происходит <em>асинхронно</em>, чтобы не тормозить основной ответ сервера. Событие попадает в отдельный job на трансляцию.</p>
    </div>

    <div class="card">
      <h3>5. Воркер транслирует событие</h3>
      <p>Воркер очереди (<code>queue:work</code>) забирает job и отправляет данные события (все public свойства) в твой WebSocket-сервис — <strong>Pusher</strong>, <strong>Ably</strong> или <strong>Laravel Reverb</strong>.</p>
    </div>

    <div class="card">
      <h3>6. Фронтенд получает событие через Laravel Echo</h3>
      <p><strong>Laravel Echo</strong> — клиентская JS-библиотека для WebSockets. Настроена на фронтенде, постоянно слушает указанные каналы. Получив событие — выполняет твой JS-колбэк:</p>
<pre><code><span class="c-comment">// resources/js/app.js</span>
<span class="c-type">Echo</span>.<span class="c-fn">private</span>(<span class="c-str">`orders.${orderId}`</span>)
    .<span class="c-fn">listen</span>(<span class="c-str">'OrderPaid'</span>, (<span class="c-var">e</span>) =&gt; {
        <span class="c-fn">console</span>.<span class="c-fn">log</span>(<span class="c-var">e</span>.<span class="c-var">order</span>);   <span class="c-comment">// данные события</span>
        <span class="c-comment">// Обновляем UI: показать уведомление, изменить статус, ...</span>
    });</code></pre>
    </div>

    <div class="remember-box">
      <strong>Последовательность действий:</strong>
      <ol style="margin:6px 0 0 20px;line-height:1.7">
        <li><strong>Сервер:</strong> ты создаёшь и диспатчишь событие (<code>OrderPaid::dispatch($order)</code>).</li>
        <li><strong>Laravel:</strong> использует <code>broadcastOn()</code> твоего события, чтобы узнать куда отправлять.</li>
        <li><strong>Очередь / Воркер:</strong> отправляет данные события в WebSocket-сервис.</li>
        <li><strong>Фронтенд:</strong> Laravel Echo, подписанный на этот канал, получает событие и выполняет колбэк.</li>
      </ol>
      Таким образом, <code>broadcastOn()</code> — <em>не прямой вызов</em>, а инструкция для фреймворка, часть автоматического механизма доставки событий на клиент.
    </div>

    <div class="remember-box">
      <strong>Итог по Event Class:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Event — DTO, описывающий <em>факт</em> в прошедшем времени.</li>
        <li>Создаётся через <code>php artisan make:event</code>.</li>
        <li>Диспатчится через <code>event()</code> или <code>::dispatch()</code>.</li>
        <li>Трейты <code>Dispatchable</code> + <code>SerializesModels</code> — стандарт.</li>
        <li>Listeners реагируют — синхронно или асинхронно.</li>
        <li>Через <code>ShouldBroadcast</code> транслируется в real-time (Pusher/Reverb + Echo).</li>
        <li>Класс события <em>не содержит логики</em> — только данные.</li>
      </ul>
    </div>
  </div>

  <div class="subsection" id="ev-listener-class">
    <div class="subsection-title"><i data-lucide="ear"></i> Listener Class — обработчик события</div>

    <p class="text"><strong>Что это.</strong> Listener — класс, который содержит <em>логику</em>, реагирующую на определённое событие. Получает экземпляр события в методе <code>handle()</code> и выполняет нужные действия (отправить письмо, обновить кеш, залогировать).</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="layers" style="width:14px;height:14px"></i> Структура слушателя</div>
<pre><code><span class="c-key">namespace</span> <span class="c-type">App</span>\<span class="c-type">Listeners</span>;

<span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Events</span>\<span class="c-type">OrderPaid</span>;

<span class="c-key">class</span> <span class="c-type">SendOrderConfirmation</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">OrderPaid</span> <span class="c-var">$event</span>)
    {
        <span class="c-comment">// отправка письма</span>
        <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$event</span>-&gt;<span class="c-var">order</span>-&gt;<span class="c-var">user</span>-&gt;<span class="c-var">email</span>)
            -&gt;<span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">OrderConfirmation</span>(<span class="c-var">$event</span>-&gt;<span class="c-var">order</span>));
    }
}</code></pre>

    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Метод <code>handle</code> вызывается автоматически, когда событие диспатчится.</li>
      <li>В параметре указывается <strong>конкретный класс события</strong>, на которое подписан слушатель.</li>
      <li>Внутри доступны все публичные свойства события (<code>$event-&gt;order</code>).</li>
      <li>Создание через artisan: <code>php artisan make:listener SendOrderConfirmation --event=OrderPaid</code></li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="link"></i> Регистрация слушателя</div>
    <p class="text">Связь между событием и слушателем регистрируется в <code>App\Providers\EventServiceProvider</code>, в свойстве <code>$listen</code>:</p>
<pre><code><span class="c-key">protected</span> <span class="c-var">$listen</span> = [
    <span class="c-type">OrderPaid</span>::<span class="c-key">class</span> =&gt; [
        <span class="c-type">SendOrderConfirmation</span>::<span class="c-key">class</span>,
        <span class="c-type">UpdateInventory</span>::<span class="c-key">class</span>,
        <span class="c-type">LogPayment</span>::<span class="c-key">class</span>,
    ],
];</code></pre>
    <p class="text">Одно событие может иметь <strong>несколько слушателей</strong> — они выполняются в порядке перечисления. Альтернативно через фасад <code>Event</code> в <code>boot()</code> провайдера:</p>
<pre><code><span class="c-type">Event</span>::<span class="c-fn">listen</span>(<span class="c-type">OrderPaid</span>::<span class="c-key">class</span>, <span class="c-type">SendOrderConfirmation</span>::<span class="c-key">class</span>);</code></pre>
    <p class="text">Подробнее про все 3 способа регистрации — в подсекции <strong>Регистрация: $listen формат</strong>.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="fast-forward" style="width:14px;height:14px"></i> Асинхронное выполнение (очередь)</div>
    <p class="text">Если слушатель должен выполняться <em>асинхронно</em>, не блокируя основной поток — он реализует интерфейс <code>ShouldQueue</code>:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Contracts</span>\<span class="c-type">Queue</span>\<span class="c-type">ShouldQueue</span>;

<span class="c-key">class</span> <span class="c-type">SendOrderConfirmation</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">OrderPaid</span> <span class="c-var">$event</span>)
    {
        <span class="c-comment">// ...</span>
    }
}</code></pre>
    <p class="text">После реализации интерфейса слушатель автоматически помещается в очередь при диспатче события. Воркер очереди выполняет его независимо от основного запроса.</p>

    <p class="text">Можно настраивать очередь, задержку, попытки через свойства класса:</p>
<pre><code><span class="c-key">public</span> <span class="c-key">string</span> <span class="c-var">$queue</span> = <span class="c-str">'emails'</span>;
<span class="c-key">public int</span>    <span class="c-var">$delay</span> = <span class="c-num">60</span>;
<span class="c-key">public int</span>    <span class="c-var">$tries</span> = <span class="c-num">3</span>;</code></pre>
    <p class="text">Полный список свойств (<code>$connection</code>, <code>$queue</code>, <code>$delay</code>, <code>$tries</code>, <code>$maxExceptions</code>, <code>$timeout</code>, <code>$backoff</code>, <code>$deleteWhenMissingModels</code>) и метод <code>failed()</code> — в подсекции <strong>Queue-config для Listeners</strong>.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="repeat" style="width:14px;height:14px"></i> Жизненный цикл</div>
    <ol style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Событие диспатчится через <code>event()</code> или <code>::dispatch()</code>.</li>
      <li><code>EventServiceProvider</code> определяет список слушателей для этого события.</li>
      <li>Для каждого слушателя:
        <ul style="margin-top:4px">
          <li>Если имплементирует <code>ShouldQueue</code> — ставится в очередь.</li>
          <li>Если нет — вызывается синхронно, прямо в текущем процессе.</li>
        </ul>
      </li>
      <li>Асинхронные слушатели выполняются воркером позже.</li>
    </ol>

    <div class="pitfall">
      <strong>Важные нюансы:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>При очереди <strong>данные события должны быть сериализуемы</strong>. Модели Eloquent сериализуются через ID благодаря трейту <code>SerializesModels</code>.</li>
        <li>Если слушатель <strong>выбрасывает исключение</strong> — оно обрабатывается по настройкам очереди (retry, <code>failed()</code>, таблица <code>failed_jobs</code>).</li>
        <li>Можно <strong>отменить дальнейшую обработку</strong> слушателей возвратом <code>false</code> из <code>handle()</code>. В современных версиях <em>не рекомендуется</em> — лучше бросать исключение или использовать conditional-логику.</li>
      </ul>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="hammer" style="width:14px;height:14px"></i> Полный пример</div>
    <p class="text"><strong>Событие:</strong></p>
<pre><code><span class="c-key">class</span> <span class="c-type">OrderPaid</span>
{
    <span class="c-key">use</span> <span class="c-type">Dispatchable</span>, <span class="c-type">SerializesModels</span>;

    <span class="c-key">public</span> <span class="c-type">Order</span> <span class="c-var">$order</span>;

    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-type">Order</span> <span class="c-var">$order</span>)
    {
        <span class="c-var">$this</span>-&gt;<span class="c-var">order</span> = <span class="c-var">$order</span>;
    }
}</code></pre>

    <p class="text"><strong>Слушатель:</strong></p>
<pre><code><span class="c-key">class</span> <span class="c-type">SendOrderConfirmation</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">OrderPaid</span> <span class="c-var">$event</span>)
    {
        <span class="c-comment">/* отправка письма */</span>
    }
}</code></pre>

    <p class="text"><strong>Регистрация:</strong></p>
<pre><code><span class="c-comment">// EventServiceProvider</span>
<span class="c-key">protected</span> <span class="c-var">$listen</span> = [
    <span class="c-type">OrderPaid</span>::<span class="c-key">class</span> =&gt; [<span class="c-type">SendOrderConfirmation</span>::<span class="c-key">class</span>],
];</code></pre>

    <p class="text"><strong>Диспатч:</strong></p>
<pre><code><span class="c-type">OrderPaid</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);</code></pre>
    <p class="text">Теперь при оплате заказа слушатель ставится в очередь и отправляет письмо в фоне, не задерживая ответ пользователю.</p>

    <div class="remember-box">
      <strong>Итог по Listener:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Класс с методом <code>handle(EventClass $event)</code> — вызывается автоматически.</li>
        <li>Регистрируется в <code>EventServiceProvider::$listen</code> или через <code>Event::listen()</code>.</li>
        <li>Один event → 0..N listeners, порядок выполнения = порядок в массиве.</li>
        <li><code>ShouldQueue</code> → асинхронно через очередь. Свойства <code>$queue</code>/<code>$delay</code>/<code>$tries</code> настраивают поведение.</li>
        <li>Синхронный без <code>ShouldQueue</code> — выполняется в том же процессе что и <code>dispatch()</code>.</li>
        <li>Данные event должны быть сериализуемы для очереди — модели через <code>SerializesModels</code>.</li>
      </ul>
    </div>
  </div>

  <div class="subsection" id="ev-subscriber">
    <div class="subsection-title"><i data-lucide="users"></i> Subscriber — группировка логически связанных listeners</div>

    <p class="text"><strong>Что это.</strong> Subscriber (подписчик) — класс, который позволяет объединить <strong>несколько слушателей</strong> (методов-обработчиков) для различных событий в одном месте. В отличие от обычного класса-слушателя (одно событие = один класс), подписчик содержит <em>несколько методов</em>, каждый из которых реагирует на своё событие.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="layers" style="width:14px;height:14px"></i> Структура подписчика</div>
    <p class="text">Класс должен содержать метод <code>subscribe()</code>, получающий экземпляр <code>Dispatcher</code>. Внутри регистрируешь слушателей через <code>$events-&gt;listen()</code> для каждого события.</p>

<pre><code><span class="c-key">namespace</span> <span class="c-type">App</span>\<span class="c-type">Listeners</span>;

<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Events</span>\<span class="c-type">Dispatcher</span>;

<span class="c-key">class</span> <span class="c-type">UserEventSubscriber</span>
{
    <span class="c-comment">// Обработчик события регистрации</span>
    <span class="c-key">public function</span> <span class="c-fn">handleUserRegistered</span>(<span class="c-var">$event</span>)
    {
        <span class="c-comment">// логика</span>
    }

    <span class="c-comment">// Обработчик события обновления профиля</span>
    <span class="c-key">public function</span> <span class="c-fn">handleUserUpdated</span>(<span class="c-var">$event</span>)
    {
        <span class="c-comment">// логика</span>
    }

    <span class="c-comment">// Метод регистрации listeners</span>
    <span class="c-key">public function</span> <span class="c-fn">subscribe</span>(<span class="c-type">Dispatcher</span> <span class="c-var">$events</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$events</span>-&gt;<span class="c-fn">listen</span>(
            <span class="c-str">'App\Events\UserRegistered'</span>,
            [<span class="c-type">UserEventSubscriber</span>::<span class="c-key">class</span>, <span class="c-str">'handleUserRegistered'</span>]
        );

        <span class="c-var">$events</span>-&gt;<span class="c-fn">listen</span>(
            <span class="c-str">'App\Events\UserUpdated'</span>,
            [<span class="c-type">UserEventSubscriber</span>::<span class="c-key">class</span>, <span class="c-str">'handleUserUpdated'</span>]
        );
    }
}</code></pre>
    <p class="text">Вместо строковых имён можно использовать <code>Event::class</code> — синтаксис <code>[класс, метод]</code> остаётся.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="link" style="width:14px;height:14px"></i> Регистрация подписчика</div>
    <p class="text">2 способа — как и с обычными listeners:</p>

<pre><code><span class="c-comment">// 1. Через свойство $subscribe в EventServiceProvider</span>
<span class="c-key">protected</span> <span class="c-var">$subscribe</span> = [
    <span class="c-type">UserEventSubscriber</span>::<span class="c-key">class</span>,
];

<span class="c-comment">// 2. Программно в boot()</span>
<span class="c-type">Event</span>::<span class="c-fn">subscribe</span>(<span class="c-type">UserEventSubscriber</span>::<span class="c-key">class</span>);</code></pre>
    <p class="text">После регистрации диспетчер вызывает <code>subscribe()</code> у подписчика — тот сам регистрирует все связи.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="target" style="width:14px;height:14px"></i> Зачем использовать подписчики</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Группировка по смыслу</strong> — все обработчики одной сущности (например, пользователя) в одном классе.</li>
      <li><strong>Снижение дублирования</strong> — если несколько listeners используют общие зависимости, их можно внедрить через конструктор подписчика.</li>
      <li><strong>Упрощение регистрации</strong> — не перечислять каждую пару <em>событие → слушатель</em> в <code>$listen</code>; всё объявлено внутри подписчика.</li>
      <li><strong>Удобство для большой логики</strong> — при большом числе listeners подписчик уменьшает количество файлов.</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="git-compare" style="width:14px;height:14px"></i> Отличия от обычных Listeners</div>
    <table class="data-table">
      <thead><tr><th>Характеристика</th><th>Обычный Listener</th><th>Subscriber</th></tr></thead>
      <tbody>
        <tr>
          <td><strong>Количество событий</strong></td>
          <td>Одно</td>
          <td>Множество</td>
        </tr>
        <tr>
          <td><strong>Метод обработки</strong></td>
          <td><code>handle(Event $event)</code></td>
          <td>Любой пользовательский метод</td>
        </tr>
        <tr>
          <td><strong>Регистрация</strong></td>
          <td>В <code>$listen</code> или <code>Event::listen()</code></td>
          <td>В <code>$subscribe</code> или <code>Event::subscribe()</code></td>
        </tr>
        <tr>
          <td><strong>Структура</strong></td>
          <td>Простая, один класс = одно событие</td>
          <td>Группирует связанные обработчики</td>
        </tr>
        <tr>
          <td><strong>Поддержка очереди</strong></td>
          <td>Да (<code>ShouldQueue</code>)</td>
          <td>Да, но с оговоркой (см. ниже)</td>
        </tr>
      </tbody>
    </table>

    <div class="pitfall">
      <strong>Subscriber + очередь.</strong> Если нужно чтобы методы подписчика выполнялись асинхронно — можно имплементировать <code>ShouldQueue</code> на уровне подписчика, <em>но это повлияет на все методы</em>. Более гибко — использовать <code>InteractsWithQueue</code> и устанавливать очередь для отдельных методов через свойства. На практике подписчики чаще используют <strong>синхронно</strong>, а для асинхронных задач — отдельные listeners с <code>ShouldQueue</code>.
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="hammer" style="width:14px;height:14px"></i> Полный пример цикла</div>

    <p class="text"><strong>События:</strong></p>
<pre><code><span class="c-key">namespace</span> <span class="c-type">App</span>\<span class="c-type">Events</span>;

<span class="c-key">class</span> <span class="c-type">UserRegistered</span> { <span class="c-key">public</span> <span class="c-var">$user</span>; <span class="c-comment">/* ... */</span> }
<span class="c-key">class</span> <span class="c-type">UserUpdated</span>    { <span class="c-key">public</span> <span class="c-var">$user</span>; <span class="c-comment">/* ... */</span> }</code></pre>

    <p class="text"><strong>Подписчик:</strong></p>
<pre><code><span class="c-key">namespace</span> <span class="c-type">App</span>\<span class="c-type">Listeners</span>;

<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Events</span>\<span class="c-type">Dispatcher</span>;
<span class="c-key">use</span> <span class="c-type">App</span>\<span class="c-type">Events</span>\{<span class="c-type">UserRegistered</span>, <span class="c-type">UserUpdated</span>};

<span class="c-key">class</span> <span class="c-type">UserEventSubscriber</span>
{
    <span class="c-key">public function</span> <span class="c-fn">sendWelcomeEmail</span>(<span class="c-var">$event</span>) { <span class="c-comment">/* ... */</span> }
    <span class="c-key">public function</span> <span class="c-fn">clearCache</span>(<span class="c-var">$event</span>)      { <span class="c-comment">/* ... */</span> }

    <span class="c-key">public function</span> <span class="c-fn">subscribe</span>(<span class="c-type">Dispatcher</span> <span class="c-var">$events</span>): <span class="c-key">void</span>
    {
        <span class="c-var">$events</span>-&gt;<span class="c-fn">listen</span>(<span class="c-type">UserRegistered</span>::<span class="c-key">class</span>, [<span class="c-key">self</span>::<span class="c-key">class</span>, <span class="c-str">'sendWelcomeEmail'</span>]);
        <span class="c-var">$events</span>-&gt;<span class="c-fn">listen</span>(<span class="c-type">UserUpdated</span>::<span class="c-key">class</span>,    [<span class="c-key">self</span>::<span class="c-key">class</span>, <span class="c-str">'clearCache'</span>]);
    }
}</code></pre>

    <p class="text"><strong>Регистрация в EventServiceProvider:</strong></p>
<pre><code><span class="c-key">protected</span> <span class="c-var">$subscribe</span> = [
    <span class="c-type">UserEventSubscriber</span>::<span class="c-key">class</span>,
];</code></pre>

    <p class="text"><strong>Диспатч:</strong></p>
<pre><code><span class="c-fn">event</span>(<span class="c-key">new</span> <span class="c-type">UserRegistered</span>(<span class="c-var">$user</span>));</code></pre>
    <p class="text">При диспатче сработает метод <code>sendWelcomeEmail</code> подписчика.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="lightbulb" style="width:14px;height:14px"></i> Рекомендации по использованию</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Используй подписчиков, когда есть <strong>несколько событий</strong>, связанных с одной моделью или модулем.</li>
      <li>Для простых проектов достаточно обычных listeners — проще для поиска.</li>
      <li>Для <strong>критически важных</strong> событий, требующих асинхронности — отдельные listeners с <code>ShouldQueue</code>, явно регистрируемые в <code>$listen</code>.</li>
      <li>Подписчики удобны для <strong>аудита, логирования, очистки кеша</strong> — действий, выполняемых синхронно при разных событиях.</li>
    </ul>

    <div class="remember-box">
      <strong>Итог.</strong> Subscriber — инструмент <em>организации кода</em>, а не замена обычным listeners. Улучшает читаемость и поддерживаемость когда количество связанных обработчиков растёт. Один класс → несколько событий → несколько методов + один <code>subscribe()</code>.
    </div>
  </div>

  <div class="subsection" id="ev-listen">
    <div class="subsection-title"><i data-lucide="link"></i> Регистрация — <code>$listen</code> формат</div>

    <p class="text">Чтобы Laravel знал, какой listener подписан на какое событие, есть 3 способа:</p>

    <div class="card">
      <h3>1. Массив <code>$listen</code> в EventServiceProvider (классика L10 и ниже)</h3>
      <p>В <code>app/Providers/EventServiceProvider.php</code> — свойство <code>$listen</code>: ключ = класс события, значение = массив классов listener'ов.</p>
<pre><code><span class="c-key">class</span> <span class="c-type">EventServiceProvider</span> <span class="c-key">extends</span> <span class="c-type">ServiceProvider</span>
{
    <span class="c-key">protected</span> <span class="c-var">$listen</span> = [
        <span class="c-comment">// Один event → несколько listeners</span>
        <span class="c-type">OrderPaid</span>::<span class="c-key">class</span> =&gt; [
            <span class="c-type">SendOrderConfirmation</span>::<span class="c-key">class</span>,
            <span class="c-type">UpdateSalesStats</span>::<span class="c-key">class</span>,
            <span class="c-type">NotifyWarehouse</span>::<span class="c-key">class</span>,
        ],

        <span class="c-comment">// Одно событие → один listener</span>
        <span class="c-type">UserRegistered</span>::<span class="c-key">class</span> =&gt; [
            <span class="c-type">SendWelcomeEmail</span>::<span class="c-key">class</span>,
        ],

        <span class="c-comment">// Ключ можно как строку — для стандартных Laravel-событий</span>
        <span class="c-str">'Illuminate\Auth\Events\Login'</span> =&gt; [
            <span class="c-type">LogSuccessfulLogin</span>::<span class="c-key">class</span>,
        ],
    ];
}</code></pre>
      <p>Каждый listener получит один и тот же экземпляр события. Порядок выполнения — как в массиве (сверху вниз), но не гарантируется, если listeners асинхронные (ShouldQueue).</p>
    </div>

    <div class="card">
      <h3>2. <code>Event::listen()</code> в boot() провайдера</h3>
      <p>Программная регистрация — полезно если listener определяется в runtime:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Support</span>\<span class="c-type">Facades</span>\<span class="c-type">Event</span>;

<span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
{
    <span class="c-comment">// Класс + метод</span>
    <span class="c-type">Event</span>::<span class="c-fn">listen</span>(
        <span class="c-type">OrderPaid</span>::<span class="c-key">class</span>,
        [<span class="c-type">SendOrderConfirmation</span>::<span class="c-key">class</span>, <span class="c-str">'handle'</span>]
    );

    <span class="c-comment">// Замыкание (inline listener)</span>
    <span class="c-type">Event</span>::<span class="c-fn">listen</span>(<span class="c-type">OrderPaid</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">OrderPaid</span> <span class="c-var">$event</span>) {
        <span class="c-type">Log</span>::<span class="c-fn">info</span>(<span class="c-str">'Order paid: '</span> . <span class="c-var">$event</span>-&gt;<span class="c-var">order</span>-&gt;<span class="c-var">id</span>);
    });

    <span class="c-comment">// Wildcard — слушать все события с префиксом</span>
    <span class="c-type">Event</span>::<span class="c-fn">listen</span>(<span class="c-str">'order.*'</span>, <span class="c-key">function</span> (<span class="c-key">string</span> <span class="c-var">$eventName</span>, <span class="c-key">array</span> <span class="c-var">$data</span>) {
        <span class="c-comment">// $eventName = 'order.paid', 'order.cancelled' и т.п.</span>
    });
}</code></pre>
    </div>

    <div class="card">
      <h3>3. Auto-discovery (Laravel 8+)</h3>
      <p>Laravel может сам находить listeners сканируя <code>app/Listeners</code> — по типу аргумента <code>handle()</code>. Включается в EventServiceProvider:</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">shouldDiscoverEvents</span>(): <span class="c-key">bool</span>
{
    <span class="c-key">return</span> <span class="c-key">true</span>;
}</code></pre>
      <p>Теперь <code>SendOrderConfirmation::handle(OrderPaid $event)</code> будет автоматически подписан на <code>OrderPaid</code> — регистрация в <code>$listen</code> не нужна.</p>
      <div class="pitfall">
        <strong>Осторожно:</strong> auto-discovery работает через сканирование папки. Найти всех слушателей события grep'ом уже сложнее — надо смотреть type-hint каждого файла. Явный <code>$listen</code> проще для больших проектов.
      </div>
    </div>

    <p class="text"><strong>Кеширование:</strong> в production для скорости — <code>php artisan event:cache</code>. Compiles массив в один файл. Сброс — <code>event:clear</code>. Auto-discovery без кеша — дорого.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="search" style="width:14px;height:14px"></i> Auto-discovery — глубже</div>
    <p class="text">Механизм работает на основе <strong>сигнатуры метода <code>handle()</code></strong> в классе слушателя: Laravel анализирует тип параметра и сопоставляет его с соответствующим событием.</p>

    <p class="text"><strong>Включение — 2 способа:</strong></p>
<pre><code><span class="c-comment">// 1. Свойство $shouldDiscoverEvents (классика, Laravel 8+)</span>
<span class="c-key">protected</span> <span class="c-var">$shouldDiscoverEvents</span> = <span class="c-key">true</span>;

<span class="c-comment">// 2. Метод в boot() (иногда используется в Laravel 11)</span>
<span class="c-key">public function</span> <span class="c-fn">boot</span>(): <span class="c-key">void</span>
{
    <span class="c-type">Event</span>::<span class="c-fn">shouldDiscoverEvents</span>();
}</code></pre>

    <p class="text">После включения Laravel сканирует <code>app/Listeners</code> (по умолчанию) и автоматически подписывает каждый слушатель на событие, указанное в типе параметра <code>handle()</code>.</p>

    <p class="text"><strong>Пример:</strong></p>
<pre><code><span class="c-comment">// app/Events/OrderShipped.php</span>
<span class="c-key">class</span> <span class="c-type">OrderShipped</span>
{
    <span class="c-key">public</span> <span class="c-var">$order</span>;
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-var">$order</span>) { <span class="c-var">$this</span>-&gt;<span class="c-var">order</span> = <span class="c-var">$order</span>; }
}

<span class="c-comment">// app/Listeners/SendShipmentNotification.php</span>
<span class="c-comment">// автоматически подпишется на OrderShipped — тип параметра</span>
<span class="c-key">class</span> <span class="c-type">SendShipmentNotification</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">OrderShipped</span> <span class="c-var">$event</span>)
    {
        <span class="c-comment">// ...</span>
    }
}</code></pre>
    <p class="text">Не нужно ничего добавлять в <code>$listen</code>.</p>

    <p class="text"><strong>Плюсы:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Меньше шаблонного кода — не дублируешь имена событий и слушателей.</li>
      <li>Удобно для быстрой разработки: создал слушатель — и он уже работает.</li>
      <li>Меньше шанс забыть зарегистрировать слушатель при рефакторинге.</li>
    </ul>

    <p class="text"><strong>Минусы:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Усложняет поиск</strong> — grep'ом найти всех слушателей события труднее, связь неявная.</li>
      <li><strong>Меньше контроля над порядком</strong> — порядок не гарантируется без свойства <code>$priority</code>.</li>
      <li>Для больших проектов сканирование папки замедляет загрузку (только при обновлении кеша).</li>
    </ul>

    <div class="tip">
      <strong>Практические рекомендации:</strong> для небольших/средних проектов — auto-discovery. Для больших проектов, где важна явность — оставить ручную регистрацию в <code>$listen</code>. Комбинировать можно, но вносит путаницу. Для критических мест (аудит, логирование) — явно.
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="code-2" style="width:14px;height:14px"></i> Программная регистрация через <code>Event::listen()</code> — глубже</div>

    <p class="text">Программная регистрация выполняется в коде, обычно в методе <code>boot()</code> любого сервис-провайдера (чаще всего <code>EventServiceProvider</code>). Называется «программной», потому что явно вызываешь <code>Event::listen()</code> в рантайме (на этапе загрузки приложения) для каждой связи событие → слушатель.</p>

    <p class="text"><strong>Когда использовать программную регистрацию:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Связь должна определяться <strong>динамически</strong>, в зависимости от условий (feature flag, env-переменная).</li>
      <li>Слушатель — <strong>замыкание</strong> (анонимная функция), а не отдельный класс.</li>
      <li>Нужен <strong>wildcard-обработчик</strong> для группы событий (общий префикс).</li>
      <li>Регистрация в провайдере, отличном от <code>EventServiceProvider</code> (например, доменный провайдер модуля).</li>
    </ul>

    <p class="text"><strong>Все варианты вызова:</strong></p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Support</span>\<span class="c-type">Facades</span>\<span class="c-type">Event</span>;

<span class="c-key">public function</span> <span class="c-fn">boot</span>()
{
    <span class="c-comment">// 1. Класс-слушатель с указанием метода (обычно 'handle')</span>
    <span class="c-type">Event</span>::<span class="c-fn">listen</span>(
        <span class="c-type">OrderPaid</span>::<span class="c-key">class</span>,
        [<span class="c-type">SendOrderConfirmation</span>::<span class="c-key">class</span>, <span class="c-str">'handle'</span>]
    );

    <span class="c-comment">// 2. Замыкание (inline-слушатель)</span>
    <span class="c-type">Event</span>::<span class="c-fn">listen</span>(<span class="c-type">OrderPaid</span>::<span class="c-key">class</span>, <span class="c-key">function</span> (<span class="c-type">OrderPaid</span> <span class="c-var">$event</span>) {
        <span class="c-type">Log</span>::<span class="c-fn">info</span>(<span class="c-str">'Order paid: '</span> . <span class="c-var">$event</span>-&gt;<span class="c-var">order</span>-&gt;<span class="c-var">id</span>);
    });

    <span class="c-comment">// 3. Wildcard-обработчик для всех событий с префиксом 'order.'</span>
    <span class="c-type">Event</span>::<span class="c-fn">listen</span>(<span class="c-str">'order.*'</span>, <span class="c-key">function</span> (<span class="c-key">string</span> <span class="c-var">$eventName</span>, <span class="c-key">array</span> <span class="c-var">$data</span>) {
        <span class="c-comment">// $eventName = 'order.paid', 'order.cancelled' и т.д.
        // $data — массив данных (для событий без объекта)</span>
    });

    <span class="c-comment">// 4. Условная регистрация</span>
    <span class="c-key">if</span> (<span class="c-fn">config</span>(<span class="c-str">'features.audit_log'</span>)) {
        <span class="c-type">Event</span>::<span class="c-fn">listen</span>(<span class="c-type">OrderPaid</span>::<span class="c-key">class</span>, <span class="c-type">LogPaymentToAudit</span>::<span class="c-key">class</span>);
    }
}</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="git-compare" style="width:14px;height:14px"></i> <code>$listen</code> массив vs <code>Event::listen()</code></div>
    <table class="data-table">
      <thead><tr><th>Характеристика</th><th><code>$listen</code> массив</th><th><code>Event::listen()</code></th></tr></thead>
      <tbody>
        <tr>
          <td><strong>Место</strong></td>
          <td>Свойство класса EventServiceProvider</td>
          <td>Вызов в <code>boot()</code> провайдера</td>
        </tr>
        <tr>
          <td><strong>Гибкость</strong></td>
          <td>Статичен, не зависит от условий</td>
          <td>Условная логика (<code>if/else</code>, конфиги)</td>
        </tr>
        <tr>
          <td><strong>Тип слушателя</strong></td>
          <td>Только классы</td>
          <td>Классы, замыкания, wildcard-обработчики</td>
        </tr>
        <tr>
          <td><strong>Скорость при загрузке</strong></td>
          <td>Быстрее (кешируется через <code>event:cache</code>)</td>
          <td>Медленнее, но разница незначительна</td>
        </tr>
        <tr>
          <td><strong>Поддерживаемость</strong></td>
          <td>Все связи в одном месте — легко найти</td>
          <td>Может быть разбросано по разным провайдерам</td>
        </tr>
      </tbody>
    </table>

    <p class="text"><strong>Что значит «в runtime».</strong> Регистрация происходит во <em>время выполнения</em> загрузочного кода приложения, а не на уровне статической конфигурации. Но это всё равно происходит <em>один раз</em> при старте приложения, а не на каждый запрос. Метод <code>boot()</code> выполняется на старте приложения, и <code>Event::listen()</code> — это просто добавление слушателя в глобальный реестр. Термин «runtime» здесь означает: связь создаётся <em>кодом</em>, который может использовать логику, доступную только во время выполнения (значение env-переменной, конфига, результат вызова метода).</p>

    <p class="text"><strong>В Laravel 11+.</strong> Структура упростилась, но <code>EventServiceProvider</code> и метод <code>boot()</code> по-прежнему доступны и работают одинаково. Многие переехали в декларативные замыкания в <code>bootstrap/app.php</code>, но <code>Event::listen()</code> — по-прежнему рабочий подход. Работает одинаково во всех версиях Laravel, начиная с 5.0.</p>

    <div class="remember-box">
      <strong>Итог по программной регистрации:</strong> <code>Event::listen()</code> — гибкий способ, полезный когда:
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Не хочешь создавать отдельный класс-слушатель (замыкания).</li>
        <li>Нужно привязать слушателя только при определённых условиях (feature flag).</li>
        <li>Нужен wildcard для группы событий.</li>
        <li>Предпочитаешь явный код, а не статический массив.</li>
      </ul>
      Не заменяет <code>$listen</code>, а дополняет его.
    </div>
  </div>

  <div class="subsection" id="ev-queue-config">
    <div class="subsection-title"><i data-lucide="sliders"></i> Queue-config для Listeners</div>

    <p class="text">Если listener реализует <code>ShouldQueue</code> — исполнение переносится в очередь и <em>всё поведение job'а</em> становится доступно. Свойства и методы — те же что у Job.</p>

    <p class="text"><strong>Свойства настройки:</strong></p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Contracts</span>\<span class="c-type">Queue</span>\<span class="c-type">ShouldQueue</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Queue</span>\<span class="c-type">InteractsWithQueue</span>;

<span class="c-key">class</span> <span class="c-type">SendOrderConfirmation</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">use</span> <span class="c-type">InteractsWithQueue</span>;

    <span class="c-comment">// Куда положить job</span>
    <span class="c-key">public</span> <span class="c-key">string</span> <span class="c-var">$connection</span> = <span class="c-str">'redis'</span>;         <span class="c-comment">// какое соединение</span>
    <span class="c-key">public</span> <span class="c-key">string</span> <span class="c-var">$queue</span>      = <span class="c-str">'emails'</span>;        <span class="c-comment">// какая очередь</span>
    <span class="c-key">public int</span>    <span class="c-var">$delay</span>      = <span class="c-num">60</span>;              <span class="c-comment">// задержка в секундах</span>

    <span class="c-comment">// Retry-логика</span>
    <span class="c-key">public int</span>    <span class="c-var">$tries</span>          = <span class="c-num">3</span>;
    <span class="c-key">public int</span>    <span class="c-var">$maxExceptions</span>  = <span class="c-num">2</span>;
    <span class="c-key">public int</span>    <span class="c-var">$timeout</span>        = <span class="c-num">120</span>;
    <span class="c-key">public array</span>  <span class="c-var">$backoff</span>        = [<span class="c-num">10</span>, <span class="c-num">30</span>, <span class="c-num">60</span>];   <span class="c-comment">// экспоненциальная задержка</span>

    <span class="c-comment">// Автоудаление при отсутствии модели</span>
    <span class="c-key">public bool</span>   <span class="c-var">$deleteWhenMissingModels</span> = <span class="c-key">true</span>;

    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">OrderPaid</span> <span class="c-var">$event</span>): <span class="c-key">void</span>
    {
        <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$event</span>-&gt;<span class="c-var">order</span>-&gt;<span class="c-var">user</span>)-&gt;<span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">OrderConfirmationMail</span>(<span class="c-var">$event</span>-&gt;<span class="c-var">order</span>));
    }

    <span class="c-comment">// Хук после исчерпания $tries</span>
    <span class="c-key">public function</span> <span class="c-fn">failed</span>(<span class="c-type">OrderPaid</span> <span class="c-var">$event</span>, <span class="c-type">Throwable</span> <span class="c-var">$e</span>): <span class="c-key">void</span>
    {
        <span class="c-type">Log</span>::<span class="c-fn">error</span>(<span class="c-str">'Order confirmation failed'</span>, [
            <span class="c-str">'order_id'</span> =&gt; <span class="c-var">$event</span>-&gt;<span class="c-var">order</span>-&gt;<span class="c-var">id</span>,
            <span class="c-str">'error'</span>    =&gt; <span class="c-var">$e</span>-&gt;<span class="c-fn">getMessage</span>(),
        ]);

        <span class="c-comment">// Уведомить админа что письмо не отправилось после всех попыток</span>
        <span class="c-type">AdminAlert</span>::<span class="c-fn">dispatch</span>(<span class="c-str">'Confirmation email failed'</span>);
    }
}</code></pre>

    <p class="text"><strong>Разбор свойств:</strong></p>
    <table class="data-table">
      <thead><tr><th>Свойство</th><th>Что делает</th></tr></thead>
      <tbody>
        <tr><td><code>$connection</code></td><td>Соединение очереди (из <code>config/queue.php</code>): redis / database / sqs...</td></tr>
        <tr><td><code>$queue</code></td><td>Имя очереди внутри соединения (для приоритизации: <code>queue:work --queue=high,default</code>)</td></tr>
        <tr><td><code>$delay</code></td><td>Задержка перед первой попыткой выполнения (секунды)</td></tr>
        <tr><td><code>$tries</code></td><td>Максимальное количество попыток (после — job попадает в <code>failed_jobs</code>)</td></tr>
        <tr><td><code>$maxExceptions</code></td><td>Максимум исключений (не то же самое что tries — timeout не считается исключением)</td></tr>
        <tr><td><code>$timeout</code></td><td>Таймаут выполнения одной попытки (секунды)</td></tr>
        <tr><td><code>$backoff</code></td><td>Задержка между попытками — <code>[10, 30, 60]</code> экспоненциально или число для константной</td></tr>
        <tr><td><code>$deleteWhenMissingModels</code></td><td>Если модель в <code>SerializesModels</code> не найдена (удалена) — удалить job вместо ошибки</td></tr>
      </tbody>
    </table>

    <p class="text"><strong>Динамическая конфигурация — методы вместо свойств:</strong></p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">viaConnection</span>(): <span class="c-key">string</span>
{
    <span class="c-key">return</span> <span class="c-fn">app</span>()-&gt;<span class="c-fn">environment</span>(<span class="c-str">'production'</span>) ? <span class="c-str">'redis'</span> : <span class="c-str">'sync'</span>;
}

<span class="c-key">public function</span> <span class="c-fn">viaQueue</span>(): <span class="c-key">string</span>
{
    <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">event</span>-&gt;<span class="c-fn">isUrgent</span>() ? <span class="c-str">'high'</span> : <span class="c-str">'default'</span>;
}

<span class="c-key">public function</span> <span class="c-fn">backoff</span>(): <span class="c-key">array</span>
{
    <span class="c-key">return</span> [<span class="c-fn">rand</span>(<span class="c-num">10</span>, <span class="c-num">30</span>), <span class="c-fn">rand</span>(<span class="c-num">60</span>, <span class="c-num">120</span>)];
}</code></pre>

    <p class="text"><strong>Метод <code>failed()</code></strong> — хук после исчерпания попыток. Вызывается ровно один раз. Полезно для:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Логирования в БД (запись в audit-таблицу вместо только <code>failed_jobs</code>)</li>
      <li>Уведомления админа / Slack / Sentry</li>
      <li>Компенсирующего действия (откатить статус, вернуть на модерацию)</li>
      <li>Метрики (increment failure counter)</li>
    </ul>

    <div class="remember-box">
      <strong>Всё то же самое работает и в Jobs.</strong> Разница только в контексте: у Job аргумент <code>__construct</code>, у Listener'а — <code>handle(EventClass $event)</code>. Свойства (<code>$tries</code>, <code>$backoff</code>, <code>$queue</code>, <code>$connection</code>) — идентичны.
    </div>
  </div>

  <div class="subsection" id="ev-event-vs-job">
    <div class="subsection-title"><i data-lucide="git-compare"></i> Event vs Job — когда что использовать</div>

    <p class="text">Внешне похожи: и Event, и Job можно поставить в очередь, оба выполняют бизнес-действие асинхронно. Разница — в <strong>семантике связи</strong> отправителя с получателем.</p>

    <table class="data-table">
      <thead><tr><th></th><th>Event</th><th>Job</th></tr></thead>
      <tbody>
        <tr>
          <td><strong>Отношение</strong></td>
          <td>1 → N (отправитель, N слушателей)</td>
          <td>1 → 1 (отправитель, один обработчик)</td>
        </tr>
        <tr>
          <td><strong>Отправитель знает получателя</strong></td>
          <td>❌ Нет. Просто эмитит «случилось X»</td>
          <td>✅ Да. Явно: «сделай Y»</td>
        </tr>
        <tr>
          <td><strong>Смысл</strong></td>
          <td>«Что случилось» (факт в прошедшем времени: <code>OrderPaid</code>, <code>UserRegistered</code>)</td>
          <td>«Что сделать» (императив: <code>SendConfirmation</code>, <code>GenerateReport</code>)</td>
        </tr>
        <tr>
          <td><strong>Кол-во обработчиков</strong></td>
          <td>Любое (0..N listeners)</td>
          <td>Ровно один (<code>handle()</code>)</td>
        </tr>
        <tr>
          <td><strong>Добавить нового получателя</strong></td>
          <td>Просто зарегистрировать новый listener в <code>$listen</code></td>
          <td>Нужно вызвать <code>OtherJob::dispatch()</code> в коде</td>
        </tr>
        <tr>
          <td><strong>Хорошо когда</strong></td>
          <td>Много независимых side-effects (письмо, аналитика, лог, уведомление)</td>
          <td>Одно конкретное действие (отправить письмо, конвертировать видео)</td>
        </tr>
      </tbody>
    </table>

    <p class="text"><strong>Пример на одной задаче — «пользователь оплатил заказ»:</strong></p>

    <p class="text"><strong>Вариант A — через Event</strong> (правильно, когда действий несколько):</p>
<pre><code><span class="c-comment">// В контроллере / Action</span>
<span class="c-type">OrderPaid</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);
<span class="c-comment">// Отправитель не знает, что произойдёт дальше.</span>

<span class="c-comment">// В EventServiceProvider</span>
<span class="c-key">protected</span> <span class="c-var">$listen</span> = [
    <span class="c-type">OrderPaid</span>::<span class="c-key">class</span> =&gt; [
        <span class="c-type">SendOrderConfirmation</span>::<span class="c-key">class</span>,   <span class="c-comment">// письмо клиенту</span>
        <span class="c-type">UpdateSalesStats</span>::<span class="c-key">class</span>,        <span class="c-comment">// аналитика</span>
        <span class="c-type">NotifyWarehouse</span>::<span class="c-key">class</span>,         <span class="c-comment">// уведомить склад</span>
        <span class="c-type">SyncToCrm</span>::<span class="c-key">class</span>,               <span class="c-comment">// CRM</span>
    ],
];
<span class="c-comment">// Через полгода добавили ещё SendSlackNotification —
// зарегистрировали в $listen, код Order-логики не тронули.</span></code></pre>

    <p class="text"><strong>Вариант B — напрямую через Jobs</strong> (правильно, когда действие одно и конкретное):</p>
<pre><code><span class="c-comment">// В контроллере / Action</span>
<span class="c-type">SendOrderConfirmation</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);
<span class="c-comment">// Явно: «отправь письмо-подтверждение».</span></code></pre>

    <p class="text"><strong>Плохой Job (замаскированный Event):</strong></p>
<pre><code><span class="c-comment">// ❌ Такой job слишком много берёт на себя</span>
<span class="c-key">class</span> <span class="c-type">ProcessOrderPayment</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>()
    {
        <span class="c-var">$this</span>-&gt;<span class="c-fn">sendConfirmation</span>();
        <span class="c-var">$this</span>-&gt;<span class="c-fn">updateStats</span>();
        <span class="c-var">$this</span>-&gt;<span class="c-fn">notifyWarehouse</span>();
        <span class="c-var">$this</span>-&gt;<span class="c-fn">syncCrm</span>();
    }
}
<span class="c-comment">// Если один шаг упал — упадёт весь job. Retry прогонит все шаги снова.
// Добавить новое действие = править этот класс. Тестировать сложнее.</span></code></pre>

    <p class="text"><strong>Хороший подход — Event + отдельные Listeners:</strong></p>
<pre><code><span class="c-comment">// ✅ Каждое действие — независимый listener</span>
<span class="c-type">OrderPaid</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);
<span class="c-comment">// Каждый listener retry-ится независимо.
// Один упал — остальные отработали.
// Добавить новое — просто новый listener.</span></code></pre>

    <div class="remember-box">
      <strong>Правило выбора:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li><strong>Одно конкретное действие</strong> — <code>Job</code>. Пример: сгенерировать PDF по ID заказа.</li>
        <li><strong>Факт «что-то случилось» → много реакций</strong> — <code>Event</code>. Пример: OrderPaid → 5 разных listener'ов.</li>
        <li><strong>Один listener сегодня, но может быть больше завтра</strong> — <code>Event</code>. Гибкость без переписывания.</li>
        <li><strong>Тонкий контроллер</strong> хорош оба варианта — главное вынести из <code>__invoke</code> контроллера.</li>
      </ul>
    </div>

    <div class="tip">
      <strong>Часто на собесе:</strong> «Чем отличается Event от Job?». Короткий ответ: <em>Event — «случилось X», может быть 0..N слушателей, слабая связь. Job — «сделай Y», один обработчик, явный вызов. Event хорош когда одна причина → много следствий.</em>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="help-circle" style="width:14px;height:14px"></i> Частые вопросы про Jobs / Events</div>

    <div class="card">
      <h3>Правильно ли, что Job — для расписания, а Events/Listeners — реакция на событие?</h3>
      <p><strong>В целом да, но с нюансами:</strong></p>
      <ul style="margin:6px 0 0 20px;line-height:1.7;color:var(--text2)">
        <li>Jobs — <strong>не только для расписания.</strong> Для расписания есть <code>Scheduler</code>. Jobs — общий механизм для выноса тяжёлых операций из основного потока в очередь.</li>
        <li>Events/Listeners — механизм <strong>реакции на факт</strong>: объявляешь событие (<code>OrderPlaced</code>), один или несколько listeners реагируют.</li>
        <li>Могут пересекаться: listener может задиспатчить Job, Job может выбросить event.</li>
      </ul>
      <p><strong>Мнемоника:</strong> Jobs = «работа», Events/Listeners = «реакция на событие».</p>
    </div>

    <div class="card">
      <h3>Почему у Jobs нет «времени выполнения»?</h3>
      <p>Ни у Jobs, ни у Events нет <em>встроенного</em> времени. Оба выполняются в момент когда их вызывают. Но есть разница:</p>
      <ul style="margin:6px 0 0 20px;line-height:1.7;color:var(--text2)">
        <li><strong>Event</strong> — выбрасывается и <em>сразу</em> вызывает listeners (синхронно; асинхронно если <code>ShouldQueue</code>). Время выполнения = время вызова.</li>
        <li><strong>Job</strong> — ставится в очередь и выполняется <em>позже</em>, когда воркер её заберёт. Точное время неизвестно — зависит от загрузки очереди, количества воркеров, задержек.</li>
      </ul>
      <p><strong>Как задать конкретное время</strong> Job'у:</p>
<pre><code><span class="c-comment">// Задержка на 5 минут</span>
<span class="c-type">ProcessOrder</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>)-&gt;<span class="c-fn">delay</span>(<span class="c-fn">now</span>()-&gt;<span class="c-fn">addMinutes</span>(<span class="c-num">5</span>));

<span class="c-comment">// Точное время</span>
<span class="c-type">ProcessOrder</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>)-&gt;<span class="c-fn">delay</span>(<span class="c-fn">now</span>()-&gt;<span class="c-fn">setTime</span>(<span class="c-num">15</span>, <span class="c-num">0</span>));

<span class="c-comment">// Или через $delay свойство в самом job</span>
<span class="c-key">public</span> <span class="c-key">int</span> <span class="c-var">$delay</span> = <span class="c-num">60</span>;   <span class="c-comment">// секунд</span></code></pre>
      <p>Для <em>регулярного</em> запуска Job (крон-задача) — используется <strong>Scheduler</strong>, который вызывает <code>dispatch()</code> по расписанию.</p>
    </div>

    <div class="card">
      <h3>Job вызывается в контроллере после действия?</h3>
      <p><strong>Да.</strong> Типичный поток: контроллер выполнил основное действие (сохранил заказ) → диспатчит Job → возвращает ответ пользователю. Job выполняется в фоне.</p>
<pre><code><span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">OrderRequest</span> <span class="c-var">$request</span>)
{
    <span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">create</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());

    <span class="c-comment">// Отправляем задачу в очередь после сохранения</span>
    <span class="c-type">ProcessOrder</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);

    <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>([
        <span class="c-str">'message'</span> =&gt; <span class="c-str">'Order placed, processing in background'</span>,
    ], <span class="c-num">201</span>);
}</code></pre>
      <p><strong>Что происходит:</strong></p>
      <ol style="margin:6px 0 0 20px;line-height:1.7;color:var(--text2)">
        <li>Заказ сохраняется в БД (синхронно).</li>
        <li>Job <code>ProcessOrder</code> ставится в очередь (миллисекунды).</li>
        <li>Ответ пользователю уходит сразу, без ожидания обработки.</li>
        <li>Воркер в фоне забирает job и выполняет — независимо от HTTP-запроса.</li>
      </ol>
      <p><strong>Где ещё можно вызывать:</strong></p>
      <ul style="margin:6px 0 0 20px;line-height:1.7;color:var(--text2)">
        <li>Из контроллера (самый частый случай)</li>
        <li>Из Action / Service (тонкий контроллер, вся логика включая dispatch — в Action)</li>
        <li>Из другого Job (chain / batch)</li>
        <li>Из Event Listener'а</li>
        <li>Из artisan-команды</li>
        <li>Из Scheduler'а</li>
      </ul>
      <div class="tip">
        <strong>Нюансы диспатча:</strong>
        <ul style="margin:6px 0 0 20px;line-height:1.5">
          <li>Если Job не имплементирует <code>ShouldQueue</code> — выполняется <em>синхронно</em> прямо в момент <code>dispatch()</code>.</li>
          <li><code>dispatchSync()</code> — принудительно синхронно, даже с <code>ShouldQueue</code> (для тестов).</li>
          <li><code>dispatch()-&gt;afterCommit()</code> — job уйдёт в очередь только после commit транзакции (защита от гонки, когда воркер ищет ещё несохранённый заказ).</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="subsection" id="ev-practice">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: событие и асинхронный listener</div>
<pre><code><span class="c-comment">// app/Events/OrderPaid.php</span>
<span class="c-key">final class</span> <span class="c-type">OrderPaid</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">public</span> <span class="c-type">Order</span> <span class="c-var">$order</span>) {}
}

<span class="c-comment">// app/Listeners/SendOrderConfirmation.php</span>
<span class="c-key">final class</span> <span class="c-type">SendOrderConfirmation</span> <span class="c-key">implements</span> <span class="c-type">ShouldQueue</span>
{
    <span class="c-key">public string</span> <span class="c-var">$queue</span> = <span class="c-str">'mail'</span>;
    <span class="c-key">public int</span> <span class="c-var">$tries</span> = <span class="c-num">3</span>;

    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">OrderPaid</span> <span class="c-var">$event</span>): <span class="c-key">void</span>
    {
        <span class="c-type">Mail</span>::<span class="c-fn">to</span>(<span class="c-var">$event</span>-&gt;<span class="c-var">order</span>-&gt;<span class="c-fn">user</span>)
            -&gt;<span class="c-fn">send</span>(<span class="c-key">new</span> <span class="c-type">OrderConfirmationMail</span>(<span class="c-var">$event</span>-&gt;<span class="c-var">order</span>));
    }
}

<span class="c-comment">// Эмит из кода</span>
<span class="c-type">OrderPaid</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);
</code></pre>
  </div>

  <div class="subsection" id="ev-pitfalls">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Eloquent-модель в свойстве event.</strong> При <code>ShouldQueue</code> listener сериализуется через <code>SerializesModels</code> — сохраняется только id. Между dispatch и handle строка может измениться или удалиться.</div>
    <div class="pitfall"><strong>2. <code>Event::fake()</code> в тестах не вызывает listeners.</strong> Если тесту нужно проверить side-effect listener'а — не используйте fake, либо отдельно тестируйте listener.</div>
    <div class="pitfall"><strong>3. Sync listener бросает exception.</strong> Если listener синхронный и упал — основная операция rollback'нется (если в транзакции). Подумайте, нужна ли такая жёсткая связь.</div>
    <div class="pitfall"><strong>4. Auto-discovery и shared classes.</strong> Auto-discovery сканирует <code>app/Listeners</code> и регистрирует всё. Лишние классы (helpers, тесты) могут случайно зарегистрироваться как listeners.</div>
    <div class="pitfall"><strong>5. Listeners в EventServiceProvider не отсортированы.</strong> Порядок исполнения не гарантирован. Если порядок важен — используйте chain через subscriber.</div>
    <div class="pitfall"><strong>6. Eloquent observer + Event listener.</strong> Дублирование. Если observer пишет audit-лог на <code>created</code>, listener на <code>OrderCreated</code> делает то же — два лога. Выберите один уровень.</div>
    <div class="pitfall"><strong>7. <code>Event::dispatch()</code> в job.</strong> Job сам делает <code>SerializesModels</code>. Если event тоже имеет модель — двойная сериализация. Передавайте ids явно.</div>
    <div class="pitfall"><strong>8. Broadcast event без queue.</strong> <code>ShouldBroadcast</code> по умолчанию транслируется синхронно. На большом объёме событий это блокирует. Имплементируйте <code>ShouldBroadcastNow</code> только когда уверены; иначе — оставляйте через очередь.</div>
  </div>
</div>

<div id="sec-scheduler" class="section">
  <div class="section-title">Scheduler</div>
  <div class="subsection" id="sch-purpose">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Laravel scheduler — встроенный планировщик задач, заменяющий ручное редактирование crontab. Одна cron-запись (<code>* * * * * php artisan schedule:run</code>) запускает Laravel, который сам решает, что запустить в эту минуту. Это убирает разрыв между приложением и cron-конфигурацией: расписание лежит в коде, версионируется, тестируется.</p>

    <p class="text">Позволяет декларативно определять периодически выполняемые задачи (отправка отчётов, очистка временных файлов, синхронизация с внешними API) без необходимости писать отдельные cron-записи для каждой задачи.</p>
  </div>

  <div class="subsection" id="sch-versions">
    <div class="subsection-title"><i data-lucide="git-branch"></i> Где определяется расписание — L10 vs L11+</div>

    <div class="card">
      <h3>До Laravel 11 (включая 10, 9 и раньше)</h3>
      <p>Расписание определяется в классе <code>App\Console\Kernel</code> в методе <code>schedule()</code>. Класс находится в <code>app/Console/Kernel.php</code>.</p>
<pre><code><span class="c-key">namespace</span> <span class="c-type">App</span>\<span class="c-type">Console</span>;

<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Console</span>\<span class="c-type">Scheduling</span>\<span class="c-type">Schedule</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Foundation</span>\<span class="c-type">Console</span>\<span class="c-type">Kernel</span> <span class="c-key">as</span> <span class="c-type">ConsoleKernel</span>;

<span class="c-key">class</span> <span class="c-type">Kernel</span> <span class="c-key">extends</span> <span class="c-type">ConsoleKernel</span>
{
    <span class="c-key">protected function</span> <span class="c-fn">schedule</span>(<span class="c-type">Schedule</span> <span class="c-var">$schedule</span>)
    {
        <span class="c-comment">// Ежедневный отчёт в 8:00 утра</span>
        <span class="c-var">$schedule</span>-&gt;<span class="c-fn">command</span>(<span class="c-str">'reports:send'</span>)-&gt;<span class="c-fn">dailyAt</span>(<span class="c-str">'08:00'</span>);

        <span class="c-comment">// Каждые 5 минут очистка кеша</span>
        <span class="c-var">$schedule</span>-&gt;<span class="c-fn">command</span>(<span class="c-str">'cache:clear'</span>)-&gt;<span class="c-fn">everyFiveMinutes</span>();

        <span class="c-comment">// Замыкание каждый час</span>
        <span class="c-var">$schedule</span>-&gt;<span class="c-fn">call</span>(<span class="c-key">function</span> () {
            <span class="c-comment">// некоторая логика</span>
        })-&gt;<span class="c-fn">hourly</span>();

        <span class="c-comment">// exec — запуск shell-команды</span>
        <span class="c-var">$schedule</span>-&gt;<span class="c-fn">exec</span>(<span class="c-str">'php artisan queue:work --stop-when-empty'</span>)-&gt;<span class="c-fn">daily</span>();
    }
}</code></pre>
      <p>В этом же классе можно определить Artisan-команды, вызываемые из расписания или вручную.</p>
    </div>

    <div class="card">
      <h3>Laravel 11 и новее</h3>
      <p>Начиная с Laravel 11, файл <code>App\Console\Kernel</code> больше не создаётся по умолчанию. Всё расписание планируется в файле <code>routes/console.php</code>. Этот файл, ранее используемый только для регистрации консольных маршрутов (Artisan-команд), теперь также содержит методы для определения расписания через фасад <code>Schedule</code>.</p>
<pre><code><span class="c-comment">// routes/console.php</span>
<span class="c-key">use</span> <span class="c-type">Illuminate</span>\<span class="c-type">Support</span>\<span class="c-type">Facades</span>\<span class="c-type">Schedule</span>;

<span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'reports:send'</span>)-&gt;<span class="c-fn">dailyAt</span>(<span class="c-str">'08:00'</span>);
<span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'cache:clear'</span>)-&gt;<span class="c-fn">everyFiveMinutes</span>();
<span class="c-type">Schedule</span>::<span class="c-fn">call</span>(<span class="c-key">function</span> () {
    <span class="c-comment">// некоторая логика</span>
})-&gt;<span class="c-fn">hourly</span>();</code></pre>
      <p>Структура стала более плоской и унифицированной: все маршруты (HTTP и консольные) и расписания — в директории <code>routes</code>.</p>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="arrow-right"></i> Миграция с Laravel 10 на 11</div>
    <p class="text">Если обновляете проект с L10 → L11:</p>
    <ol style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Удалить класс <code>App\Console\Kernel</code> (или оставить, но он не будет использоваться).</li>
      <li>Перенести всё расписание из <code>schedule()</code> в <code>routes/console.php</code>.</li>
      <li>Убедиться, что <code>routes/console.php</code> есть и в нём используется фасад <code>Schedule</code>.</li>
    </ol>

    <p class="text"><strong>Пример переноса:</strong></p>
<pre><code><span class="c-comment">// Было в Kernel::schedule()</span>
<span class="c-var">$schedule</span>-&gt;<span class="c-fn">command</span>(<span class="c-str">'backup:run'</span>)-&gt;<span class="c-fn">daily</span>();

<span class="c-comment">// Стало в routes/console.php</span>
<span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'backup:run'</span>)-&gt;<span class="c-fn">daily</span>();</code></pre>
    <p class="text">Замыкания в расписании переносятся без изменений.</p>
  </div>

  <div class="subsection" id="sch-features">
    <div class="subsection-title"><i data-lucide="list"></i> Возможности</div>
    <div class="card"><h3>Декларация в <code>routes/console.php</code></h3><p class="text">С Laravel 11+ расписание лежит в <code>routes/console.php</code> через <code>Schedule::command(...)-&gt;daily()</code>. До 11 — в <code>App\Console\Kernel::schedule()</code>.</p></div>
    <div class="card"><h3>Периоды и фильтры</h3><p class="text"><code>-&gt;everyMinute()</code>, <code>-&gt;hourly()</code>, <code>-&gt;dailyAt('14:30')</code>, <code>-&gt;weekly()</code>, <code>-&gt;cron('*/5 * * * *')</code>. Фильтры: <code>-&gt;weekdays()</code>, <code>-&gt;between('9:00', '17:00')</code>, <code>-&gt;when(fn () =&gt; ...)</code>.</p></div>
    <div class="card"><h3>withoutOverlapping</h3><p class="text"><code>-&gt;withoutOverlapping(10)</code> — не запускать, если предыдущий ещё не завершился. TTL 10 минут — защита от случая, когда процесс упал и lock не освобождён.</p></div>
    <div class="card"><h3>onOneServer</h3><p class="text">При горизонтальном масштабировании (несколько серверов) job выполняется ровно на одном. Требует драйвер кеша, поддерживающий atomic lock (Redis, Memcached, DB).</p></div>
    <div class="card"><h3>Output handling</h3><p class="text"><code>-&gt;sendOutputTo($file)</code>, <code>-&gt;emailOutputOnFailure($email)</code>. Удобно для разовых отчётов; для регулярного логирования &mdash; внешние агрегаторы.</p></div>
  </div>

  <div class="subsection" id="sch-overlapping">
    <div class="subsection-title"><i data-lucide="lock"></i> <code>withoutOverlapping()</code> — предотвращение параллельного выполнения</div>

    <p class="text">Метод <code>withoutOverlapping()</code> гарантирует, что одновременно выполняется <strong>только один экземпляр задачи</strong>. Если новый запуск задачи происходит, пока предыдущий ещё выполняется — новый запуск будет пропущен.</p>

    <p class="text">Полезно для задач, которые могут работать <em>дольше интервала запуска</em> — резервное копирование, обработка больших файлов, синхронизация с внешним API — чтобы избежать конфликтов, дублирования данных или перегрузки ресурсов.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="code" style="width:14px;height:14px"></i> Синтаксис</div>
<pre><code><span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'backup:run'</span>)-&gt;<span class="c-fn">daily</span>()-&gt;<span class="c-fn">withoutOverlapping</span>(<span class="c-num">10</span>);

<span class="c-comment">// или для замыкания</span>
<span class="c-type">Schedule</span>::<span class="c-fn">call</span>(<span class="c-key">function</span> () {
    <span class="c-comment">// длительная операция</span>
})-&gt;<span class="c-fn">everyFiveMinutes</span>()-&gt;<span class="c-fn">withoutOverlapping</span>(<span class="c-num">5</span>);</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="clock" style="width:14px;height:14px"></i> Аргумент <code>$expiresAt</code></div>
    <p class="text">Метод принимает один <strong>необязательный параметр</strong> — <code>$expiresAt</code> в <strong>минутах</strong>. Это TTL блокировки: через сколько минут она автоматически истекает. По умолчанию — <strong>1440 минут (24 часа)</strong>.</p>

    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Если передать <code>0</code> или отрицательное число — блокировка <em>никогда не истекает</em> автоматически. Крайне не рекомендуется: при падении процесса блокировка останется навсегда и задача никогда не запустится снова.</li>
      <li>Без параметра (<code>-&gt;withoutOverlapping()</code>) — TTL 24 часа.</li>
      <li><strong>Рекомендуемое значение</strong> — время, заведомо <em>превышающее максимальное ожидаемое время выполнения</em> задачи, но не слишком большое, чтобы разблокировка произошла в случае сбоя.</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="cpu" style="width:14px;height:14px"></i> Как работает под капотом</div>
    <p class="text">Laravel использует <strong>драйвер кеша</strong> (по умолчанию — тот же, что настроен в <code>config/cache.php</code>) для хранения <strong>блокировки (lock)</strong>. При старте задачи создаётся ключ кеша, обычно содержащий имя задачи. Если ключ уже существует (задача выполняется) — текущий запуск отменяется.</p>

    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>После <em>успешного</em> завершения задачи блокировка снимается автоматически (<code>release()</code> в <code>finally</code>).</li>
      <li>Если задача упала с ошибкой или процесс принудительно остановлен — блокировка может остаться. Для этого и нужен <code>$expiresAt</code>: по истечении срока блокировка автоматически удаляется.</li>
    </ul>

    <div class="pitfall">
      <strong>Важные особенности:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li><strong>Имя задачи для блокировки</strong> — по умолчанию формируется из командной строки или замыкания. Через <code>-&gt;name('unique-name')</code> можно явно задать имя, что удобно если несколько задач могут иметь одинаковый идентификатор.</li>
        <li><strong>С <code>-&gt;runInBackground()</code></strong> — блокировка всё равно действует, так как основана на кеше.</li>
        <li><strong>Если задача выполняется дольше <code>$expiresAt</code></strong> — блокировка освободится автоматически, и запустится <em>вторая копия</em> задачи, даже если первая ещё работает. Поэтому <code>$expiresAt</code> должно быть строго <strong>больше</strong> ожидаемого времени выполнения.</li>
      </ul>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="hammer" style="width:14px;height:14px"></i> Пример с cron и TTL</div>
<pre><code><span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'emails:send-bulk'</span>)
    -&gt;<span class="c-fn">everyThirtyMinutes</span>()
    -&gt;<span class="c-fn">withoutOverlapping</span>(<span class="c-num">15</span>);   <span class="c-comment">// блокировка истекает через 15 минут</span></code></pre>
    <p class="text">Если задача выполняется в среднем 10 минут — 15 минут безопасный запас. Если задача зависнет на 20 минут, блокировка освободится через 15, и запустится новый экземпляр (может привести к дублированию). Оценивайте время выполнения адекватно.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="target" style="width:14px;height:14px"></i> Когда использовать</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Операции с внешними API, которые могут долго отвечать.</li>
      <li>Пакетная обработка данных, которая может занять больше времени чем интервал расписания.</li>
      <li>Генерация больших отчётов или экспорт данных.</li>
      <li>Резервное копирование.</li>
    </ul>

    <div class="tip">
      <strong>Альтернативы.</strong> Если требуется более сложная координация (блокировка на уровне модели или по кастомному ключу) — используй <code>Cache::lock()</code> внутри самой задачи (см. Cache → Atomic Locks). <code>withoutOverlapping</code> — встроенное простое решение для типовых сценариев в планировщике.
    </div>

    <div class="remember-box">
      <strong>Итог.</strong> <code>withoutOverlapping()</code> — удобный и надёжный способ предотвратить параллельное выполнение периодических задач. Главное — правильно подобрать TTL: чтобы блокировка не зависала навсегда, но и не сбрасывалась слишком рано. Правило: <strong>TTL &gt; максимальное ожидаемое время выполнения задачи</strong> с запасом.
    </div>
  </div>

  <div class="subsection" id="sch-oneserver">
    <div class="subsection-title"><i data-lucide="server"></i> <code>onOneServer()</code> — выполнение только на одном сервере в кластере</div>

    <p class="text">При <strong>горизонтальном масштабировании</strong> (несколько экземпляров приложения, работающих параллельно) каждая запланированная задача будет запускаться на <em>каждом сервере</em> — если не принять меры. Это приводит к дублированию: повторная отправка писем, двойная обработка данных, N бэкапов вместо одного.</p>

    <p class="text">Метод <code>onOneServer()</code> гарантирует, что задача выполняется <strong>ровно на одном узле</strong> кластера, независимо от количества запущенных экземпляров.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="code" style="width:14px;height:14px"></i> Синтаксис</div>
<pre><code><span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'reports:generate'</span>)-&gt;<span class="c-fn">daily</span>()-&gt;<span class="c-fn">onOneServer</span>();

<span class="c-comment">// Комбинация с withoutOverlapping — максимальная защита</span>
<span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'backup:run'</span>)
    -&gt;<span class="c-fn">daily</span>()
    -&gt;<span class="c-fn">onOneServer</span>()
    -&gt;<span class="c-fn">withoutOverlapping</span>();</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="cpu" style="width:14px;height:14px"></i> Принцип работы</div>
    <p class="text">Использует <strong>атомарные блокировки</strong> в общем хранилище кеша. При старте задачи:</p>
    <ol style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li>Планировщик пытается создать <strong>lock</strong> с уникальным именем для этой задачи.</li>
      <li>Если блокировку удалось захватить — задача выполняется на текущем сервере.</li>
      <li>Если блокировка уже занята другим сервером — задача пропускается на этом узле.</li>
      <li>Блокировка автоматически снимается после завершения задачи или в случае ошибки.</li>
    </ol>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="atom" style="width:14px;height:14px"></i> Что такое «атомарная операция захвата»</div>
    <p class="text"><strong>Атомарная операция</strong> — операция, которая выполняется как <em>единое целое</em>: либо полностью успешно, либо не выполняется вообще, без промежуточных состояний. В контексте распределённых блокировок это означает, что <strong>проверка наличия блокировки и её создание</strong> (если её нет) происходит за один неделимый шаг — исключая ситуацию, когда два сервера одновременно попытаются создать блокировку и оба её получат.</p>

    <p class="text"><strong>Как реализовано в каждом драйвере:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Redis:</strong> команда <code>SET key value NX EX seconds</code> — устанавливает ключ <em>только если его нет</em>, с истечением через заданное время.</li>
      <li><strong>Memcached:</strong> метод <code>add()</code> — добавляет элемент <em>только если его нет</em>.</li>
      <li><strong>Database:</strong> используется <code>INSERT</code> с уникальным индексом или блокировка строки через <code>SELECT ... FOR UPDATE</code> в транзакции.</li>
    </ul>

    <p class="text">Эти механизмы гарантируют, что <em>только один процесс</em> сможет захватить блокировку, остальные получат отказ. <strong>Без атомарности</strong> два сервера могли бы одновременно проверить, что блокировки нет, и оба создать её — что привело бы к дублированию задачи (гонка данных).</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="hard-drive" style="width:14px;height:14px"></i> Требования к драйверу кеша</div>
    <p class="text">Нужен драйвер кеша, поддерживающий атомарные операции захвата/освобождения блокировок:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>redis</code> — предпочтительный вариант (встроенные атомарные команды <code>SET NX EX</code>).</li>
      <li><code>memcached</code> — тоже поддерживает атомарные операции.</li>
      <li><code>database</code> — использует таблицу кеша с атомарными блокировками (начиная с определённых версий Laravel).</li>
    </ul>

    <div class="pitfall">
      <strong>Не поддерживаются:</strong> <code>file</code>, <code>array</code>, <code>null</code> — они не обеспечивают распределённую блокировку. С такими драйверами <code>onOneServer()</code> либо выбросит исключение, либо просто не сработает (задача будет выполняться на всех серверах).
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="settings" style="width:14px;height:14px"></i> Отдельный драйвер для блокировок</div>
    <p class="text">По умолчанию используется драйвер из <code>CACHE_DRIVER</code>. Можно явно указать другой драйвер для блокировок:</p>
<pre><code><span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'backup:run'</span>)
    -&gt;<span class="c-fn">daily</span>()
    -&gt;<span class="c-fn">onOneServer</span>()
    -&gt;<span class="c-fn">useCacheDriver</span>(<span class="c-str">'redis'</span>);</code></pre>
    <p class="text">Полезно, если основной кеш используется для других целей (например, <code>file</code> для данных, <code>redis</code> для блокировок).</p>

    <div class="pitfall">
      <strong>Важные моменты и ограничения:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li><strong>TTL блокировки</strong> — по умолчанию 24 часа. Если задача выполняется дольше, блокировка истечёт, и другой сервер может её захватить — параллельное выполнение. В стандартном API <code>onOneServer()</code> <em>не принимает параметры</em> — TTL фиксирован (24 часа).</li>
        <li><strong>Падение сервера</strong> — если процесс упал без освобождения блокировки, она автоматически истечёт через TTL, задача снова станет доступной другим узлам.</li>
        <li><strong>Имя блокировки</strong> — строится по идентификатору задачи. Можно задать своё через <code>-&gt;name('unique-name')</code>.</li>
        <li><strong>Совместимость с <code>withoutOverlapping()</code></strong> — использовать вместе. <code>withoutOverlapping</code> предотвращает параллельный запуск на <em>одном</em> сервере, <code>onOneServer</code> — на <em>разных</em>. Вместе = максимальная защита.</li>
        <li><strong>Скорость</strong> — проверка блокировки добавляет незначительную задержку.</li>
      </ul>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="target" style="width:14px;height:14px"></i> Когда использовать</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Резервное копирование</strong> — не нужно делать одно и то же на каждом сервере.</li>
      <li><strong>Генерация глобальных отчётов</strong> — достаточно одного экземпляра.</li>
      <li><strong>Очистка временных файлов</strong> — не удалять одновременно с разных серверов.</li>
      <li><strong>Отправка массовых уведомлений</strong> — избежать дублирования.</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="git-branch" style="width:14px;height:14px"></i> Альтернативы</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Уникальные jobs</strong> (<code>ShouldBeUnique</code>) через централизованную очередь (Redis/SQS) — но только для асинхронных задач, не для планировщика.</li>
      <li><strong>Ручная <code>Cache::lock()</code></strong> внутри самой задачи — больше гибкости, сложнее.</li>
      <li><strong>Kubernetes CronJob</strong> — переносит управление на уровень инфраструктуры.</li>
    </ul>

    <div class="remember-box">
      <strong>Итог.</strong> <code>onOneServer()</code> — простой и эффективный способ избежать дублирования периодических задач в кластерной среде. Опирается на общий кеш с атомарными блокировками (Redis/Memcached/DB). Для большинства сценариев где критично, чтобы задача выполнялась только один раз глобально. Комбинация <code>-&gt;onOneServer()-&gt;withoutOverlapping()</code> даёт максимальную защиту: один сервер + один экземпляр.
    </div>
  </div>

  <div class="subsection" id="sch-methods">
    <div class="subsection-title"><i data-lucide="clock"></i> Все методы расписания — таблица</div>

    <p class="text">Полный набор методов для задания частоты и фильтров:</p>

    <p class="text"><strong>Периоды (интервалы запуска)</strong> — методы задания частоты. Все они возвращают тот же экземпляр <code>Schedule</code> для цепочки вызовов.</p>

    <table class="data-table">
      <thead><tr><th>Метод</th><th>Описание</th></tr></thead>
      <tbody>
        <tr><td><code>-&gt;cron('* * * * *')</code></td><td>Произвольное cron-выражение, напр. <code>->cron('*/5 * * * *')</code></td></tr>
        <tr><td><code>-&gt;everyMinute()</code></td><td>Каждую минуту</td></tr>
        <tr><td><code>-&gt;everyTwoMinutes()</code></td><td>Каждые 2 минуты</td></tr>
        <tr><td><code>-&gt;everyFiveMinutes()</code></td><td>Каждые 5 минут</td></tr>
        <tr><td><code>-&gt;everyTenMinutes()</code></td><td>Каждые 10 минут</td></tr>
        <tr><td><code>-&gt;everyFifteenMinutes()</code></td><td>Каждые 15 минут</td></tr>
        <tr><td><code>-&gt;everyThirtyMinutes()</code></td><td>Каждые 30 минут</td></tr>
        <tr><td><code>-&gt;hourly()</code></td><td>Каждый час (в 00 минут)</td></tr>
        <tr><td><code>-&gt;hourlyAt(17)</code></td><td>Каждый час в 17 минут</td></tr>
        <tr><td><code>-&gt;everyTwoHours()</code></td><td>Каждые 2 часа</td></tr>
        <tr><td><code>-&gt;everyThreeHours()</code></td><td>Каждые 3 часа</td></tr>
        <tr><td><code>-&gt;everyFourHours()</code></td><td>Каждые 4 часа</td></tr>
        <tr><td><code>-&gt;everySixHours()</code></td><td>Каждые 6 часов</td></tr>
        <tr><td><code>-&gt;daily()</code></td><td>Ежедневно в полночь (00:00)</td></tr>
        <tr><td><code>-&gt;dailyAt('13:30')</code></td><td>Ежедневно в 13:30</td></tr>
        <tr><td><code>-&gt;twiceDaily(1, 13)</code></td><td>Дважды в день: в 1:00 и 13:00</td></tr>
        <tr><td><code>-&gt;twiceDailyAt(3, 15, 30)</code></td><td>Дважды в день в 3:30 и 15:30 (часы, минуты)</td></tr>
        <tr><td><code>-&gt;weekly()</code></td><td>Еженедельно в полночь воскресенья</td></tr>
        <tr><td><code>-&gt;weeklyOn(1, '8:00')</code></td><td>Еженедельно в понедельник (1 = Monday) в 8:00</td></tr>
        <tr><td><code>-&gt;monthly()</code></td><td>Ежемесячно 1-го числа в полночь</td></tr>
        <tr><td><code>-&gt;monthlyOn(4, '15:00')</code></td><td>4-го числа каждого месяца в 15:00</td></tr>
        <tr><td><code>-&gt;twiceMonthly(1, 16, '13:00')</code></td><td>1-го и 16-го числа каждого месяца в 13:00</td></tr>
        <tr><td><code>-&gt;quarterly()</code></td><td>Каждый квартал: 1 января, 1 апреля, 1 июля, 1 октября в полночь</td></tr>
        <tr><td><code>-&gt;yearly()</code></td><td>Ежегодно 1 января в полночь</td></tr>
        <tr><td><code>-&gt;days([1, 3, 5])</code></td><td>Запускать в определённые дни недели (0=воскресенье)</td></tr>
      </tbody>
    </table>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="filter" style="width:14px;height:14px"></i> Фильтры (условия выполнения)</div>
    <p class="text">Фильтры задают дополнительные условия. Если условие не выполнено — задача <strong>пропускается</strong>.</p>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Описание</th></tr></thead>
      <tbody>
        <tr><td><code>-&gt;weekdays()</code></td><td>Только по рабочим дням (пн–пт)</td></tr>
        <tr><td><code>-&gt;weekends()</code></td><td>Только по выходным (сб–вс)</td></tr>
        <tr><td><code>-&gt;sundays()</code></td><td>Только по воскресеньям</td></tr>
        <tr><td><code>-&gt;mondays()</code></td><td>Только по понедельникам</td></tr>
        <tr><td><code>-&gt;tuesdays()</code></td><td>Только по вторникам</td></tr>
        <tr><td><code>-&gt;wednesdays()</code></td><td>Только по средам</td></tr>
        <tr><td><code>-&gt;thursdays()</code></td><td>Только по четвергам</td></tr>
        <tr><td><code>-&gt;fridays()</code></td><td>Только по пятницам</td></tr>
        <tr><td><code>-&gt;saturdays()</code></td><td>Только по субботам</td></tr>
        <tr><td><code>-&gt;between('9:00', '17:00')</code></td><td>Запускать только в указанном интервале (включительно)</td></tr>
        <tr><td><code>-&gt;unlessBetween('22:00', '6:00')</code></td><td><em>Не</em> запускать между указанными временами</td></tr>
        <tr><td><code>-&gt;when(fn () =&gt; ...)</code></td><td>Запускать, если замыкание вернуло <code>true</code></td></tr>
        <tr><td><code>-&gt;skip(fn () =&gt; ...)</code></td><td>Пропустить, если замыкание вернуло <code>true</code> (обратное <code>when</code>)</td></tr>
        <tr><td><code>-&gt;environments(['production'])</code></td><td>Запускать только в указанных окружениях</td></tr>
        <tr><td><code>-&gt;evenInMaintenanceMode()</code></td><td>Выполнять даже в режиме обслуживания (по умолчанию задачи не запускаются)</td></tr>
        <tr><td><code>-&gt;timezone('Asia/Almaty')</code></td><td>Таймзона для расписания</td></tr>
      </tbody>
    </table>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="link-2" style="width:14px;height:14px"></i> Комбинирование в цепочке</div>
    <p class="text">Методы можно комбинировать — <strong>все условия</strong> применяются одновременно (AND-логика). Например:</p>
<pre><code><span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'reports:generate'</span>)
    -&gt;<span class="c-fn">dailyAt</span>(<span class="c-str">'02:00'</span>)
    -&gt;<span class="c-fn">weekdays</span>()
    -&gt;<span class="c-fn">between</span>(<span class="c-str">'01:00'</span>, <span class="c-str">'04:00'</span>)
    -&gt;<span class="c-fn">when</span>(<span class="c-key">fn</span>() =&gt; <span class="c-var">$this</span>-&gt;<span class="c-fn">shouldRun</span>())
    -&gt;<span class="c-fn">onOneServer</span>();
</code></pre>
    <p class="text">Задача выполнится <em>каждый будний день в 2:00 ночи</em>, но только если сервер захватит блокировку и замыкание <code>shouldRun()</code> вернёт <code>true</code>. Все фильтры проверяются в момент, когда наступает время запуска.</p>

    <div class="tip">
      <strong>Важно:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Фильтры <code>weekdays()</code>, <code>between()</code>, <code>when()</code> проверяются <em>непосредственно перед запуском</em> задачи.</li>
        <li>Для точного контроля используйте <code>->cron()</code> и комбинируйте с <code>->when()</code> для сложной логики.</li>
        <li>При <code>->onOneServer()</code> фильтры всё равно применяются <em>на каждом сервере</em>, но задача выполнится только на том, кто успешно захватит блокировку.</li>
      </ul>
    </div>
  </div>

  <div class="subsection" id="sch-output">
    <div class="subsection-title"><i data-lucide="file-output"></i> Output Handling — обработка вывода задач</div>

    <p class="text">При выполнении запланированных задач (команд, замыканий, исполняемых файлов) часто нужно <strong>сохранить вывод</strong> (stdout/stderr) в файл, отправить результат по email или иначе обработать. Laravel даёт цепочку методов для управления выводом задачи <em>после её выполнения</em>.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="file-text" style="width:14px;height:14px"></i> <code>-&gt;sendOutputTo($filePath)</code> — перезапись файла</div>
    <p class="text">Перенаправляет весь вывод (stdout + stderr) в указанный файл. <strong>Файл перезаписывается</strong> при каждом запуске задачи.</p>
<pre><code><span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'reports:generate'</span>)
    -&gt;<span class="c-fn">daily</span>()
    -&gt;<span class="c-fn">sendOutputTo</span>(<span class="c-fn">storage_path</span>(<span class="c-str">'logs/report.log'</span>));
</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="file-plus" style="width:14px;height:14px"></i> <code>-&gt;appendOutputTo($filePath)</code> — дописывание</div>
    <p class="text">То же, что <code>sendOutputTo</code>, но вывод <strong>дописывается в конец</strong> файла. Полезно для накопления логов за длительное время.</p>
<pre><code><span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'backup:run'</span>)
    -&gt;<span class="c-fn">daily</span>()
    -&gt;<span class="c-fn">appendOutputTo</span>(<span class="c-fn">storage_path</span>(<span class="c-str">'logs/backup.log'</span>));
</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="mail" style="width:14px;height:14px"></i> <code>-&gt;emailOutputTo($email, $subject = null)</code> — всегда на email</div>
    <p class="text">Отправляет вывод задачи на email <strong>после каждого выполнения</strong>. Если вывод <em>пустой</em> — письмо не отправляется.</p>
<pre><code><span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'reports:generate'</span>)
    -&gt;<span class="c-fn">weekly</span>()
    -&gt;<span class="c-fn">emailOutputTo</span>(<span class="c-str">'admin@example.com'</span>, <span class="c-str">'Weekly Report Output'</span>);
</code></pre>
    <p class="text">Можно комбинировать с <code>sendOutputTo()</code> — тогда вывод одновременно и сохранён в файл, и отправлен по почте. Также поддерживает <strong>массив адресов</strong>:</p>
<pre><code>-&gt;<span class="c-fn">emailOutputTo</span>([<span class="c-str">'admin@example.com'</span>, <span class="c-str">'manager@example.com'</span>]);
</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="mail-warning" style="width:14px;height:14px"></i> <code>-&gt;emailOutputOnFailure($email, $subject = null)</code> — только при ошибке</div>
    <p class="text">Отправляет вывод <strong>только если задача завершилась с ошибкой</strong> (ненулевой код возврата). При успехе письмо не приходит — удобно для мониторинга без спама.</p>
<pre><code><span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'critical:task'</span>)
    -&gt;<span class="c-fn">everyFiveMinutes</span>()
    -&gt;<span class="c-fn">emailOutputOnFailure</span>(<span class="c-str">'devops@example.com'</span>, <span class="c-str">'Critical Task Failed'</span>);
</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="git-branch" style="width:14px;height:14px"></i> <code>-&gt;onSuccess()</code> / <code>-&gt;onFailure()</code> — колбэки</div>
    <p class="text">Замыкания для произвольного кода при успехе или неудаче задачи. Даёт максимальную гибкость: Slack-нотификация, отдельный лог, обновление метрик и т.д.</p>
<pre><code><span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'backup:run'</span>)
    -&gt;<span class="c-fn">daily</span>()
    -&gt;<span class="c-fn">onSuccess</span>(<span class="c-key">function</span> () {
        <span class="c-comment">// Отправить уведомление в Slack</span>
    })
    -&gt;<span class="c-fn">onFailure</span>(<span class="c-key">function</span> () {
        <span class="c-comment">// Записать в отдельный лог ошибку</span>
    });
</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="table-2" style="width:14px;height:14px"></i> Сводка методов</div>
    <table class="data-table">
      <thead><tr><th>Метод</th><th>Что делает</th><th>Когда срабатывает</th></tr></thead>
      <tbody>
        <tr><td><code>-&gt;sendOutputTo(path)</code></td><td>Записать вывод в файл (перезапись)</td><td>После каждого запуска</td></tr>
        <tr><td><code>-&gt;appendOutputTo(path)</code></td><td>Дописать вывод в конец файла</td><td>После каждого запуска</td></tr>
        <tr><td><code>-&gt;emailOutputTo(email)</code></td><td>Отправить вывод на email (можно массив)</td><td>После каждого запуска, если вывод не пустой</td></tr>
        <tr><td><code>-&gt;emailOutputOnFailure(email)</code></td><td>Отправить вывод на email</td><td>Только при exit code ≠ 0</td></tr>
        <tr><td><code>-&gt;onSuccess(Closure)</code></td><td>Произвольный код</td><td>При exit code = 0</td></tr>
        <tr><td><code>-&gt;onFailure(Closure)</code></td><td>Произвольный код</td><td>При exit code ≠ 0</td></tr>
      </tbody>
    </table>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="lightbulb" style="width:14px;height:14px"></i> Рекомендации по использованию</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Регулярные отчёты</strong> — <code>sendOutputTo()</code> + ротация через <code>logrotate</code> либо перенаправление в агрегатор (ELK, Graylog, Datadog).</li>
      <li><strong>Критичные задачи</strong> — <code>emailOutputOnFailure()</code> или <code>onFailure()</code> для оперативного оповещения без «шума» при успехе.</li>
      <li><strong>Большие объёмы вывода</strong> — не отправляйте email'ом, сохраняйте в файл и обрабатывайте внешними инструментами.</li>
      <li><strong>Парсинг/анализ</strong> — сохраняйте в файл и обрабатывайте другой запланированной задачей.</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="hammer" style="width:14px;height:14px"></i> Пример полной настройки</div>
<pre><code><span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'sales:aggregate'</span>)
    -&gt;<span class="c-fn">dailyAt</span>(<span class="c-str">'01:00'</span>)
    -&gt;<span class="c-fn">sendOutputTo</span>(<span class="c-fn">storage_path</span>(<span class="c-str">'logs/sales.log'</span>))
    -&gt;<span class="c-fn">emailOutputOnFailure</span>(<span class="c-str">'team@example.com'</span>, <span class="c-str">'Sales Aggregation Failed'</span>)
    -&gt;<span class="c-fn">onSuccess</span>(<span class="c-key">fn</span>() =&gt; <span class="c-type">Log</span>::<span class="c-fn">info</span>(<span class="c-str">'Sales aggregation succeeded'</span>));
</code></pre>
    <p class="text">В сумме: вывод сохранён локально, при ошибке команда получает email с логом, при успехе — запись в лог Laravel. Классическая схема для «серьёзной» задачи без внешних инструментов.</p>

    <div class="pitfall"><strong>1. Захватывается только stdout/stderr задачи.</strong> Методы работают с выводом, который команда пишет в консоль (<code>echo</code>, <code>print</code>, <code>$this-&gt;info()</code> в Artisan). Вывод внутренних исключений тоже перехватывается.</div>
    <div class="pitfall"><strong>2. <code>Log::info()</code> не попадает в <code>sendOutputTo</code>.</strong> Стандартный <code>Log</code>-фасад пишет напрямую в <code>storage/logs/laravel.log</code> через файловые каналы — этот вывод <em>не</em> захватывается планировщиком. Для захвата логов задачи — используйте отдельный канал (напр. <code>stderr</code>) или пишите в консоль явно.</div>
    <div class="pitfall"><strong>3. Пустой вывод = нет письма.</strong> <code>emailOutputTo()</code> ничего не отправит, если команда не произвела вывод. Это часто <em>желаемое поведение</em>, но иногда путает — «почему письмо не пришло, задача же выполнилась?».</div>
    <div class="pitfall"><strong>4. <code>sendOutputTo</code> перезаписывает.</strong> Если нужно накопление истории — <code>appendOutputTo</code>, иначе увидите только последний запуск.</div>
    <div class="pitfall"><strong>5. Права на файл.</strong> Файл создаётся под юзером cron (обычно <code>www-data</code> или тот, кто запускает <code>schedule:run</code>). Директория должна быть доступна на запись.</div>
    <div class="pitfall"><strong>6. Email через <code>MAIL_MAILER=log</code> на dev.</strong> Локально письмо «уйдёт» в лог, а не на реальный адрес — легко подумать, что фича не работает.</div>

    <div class="remember-box">
      <strong>Короткая шпаргалка:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li>Нужно сохранить один лог → <code>sendOutputTo()</code></li>
        <li>Нужна история запусков → <code>appendOutputTo()</code></li>
        <li>Отчёт каждый раз в почту → <code>emailOutputTo()</code></li>
        <li>Оповещение <em>только при падении</em> → <code>emailOutputOnFailure()</code></li>
        <li>Кастомная логика (Slack/метрики) → <code>onSuccess()</code> / <code>onFailure()</code></li>
      </ul>
    </div>
  </div>

  <div class="subsection" id="sch-cron">
    <div class="subsection-title"><i data-lucide="terminal"></i> Запуск планировщика через cron</div>

    <p class="text">Чтобы планировщик работал, нужно добавить <strong>одну запись</strong> в системный cron, которая будет вызывать Artisan-команду <code>schedule:run</code> <em>каждую минуту</em>. Эта команда проверяет, какие задачи должны быть запущены в текущую минуту, и выполняет их.</p>

    <p class="text"><strong>Запись в cron</strong> (обычно через <code>crontab -e</code>):</p>
<pre><code>* * * * * cd /path-to-your-project && php artisan schedule:run &gt;&gt; /dev/null 2&gt;&amp;1</code></pre>

    <p class="text"><strong>Что делает каждая часть:</strong></p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>* * * * *</code> — cron-выражение «каждую минуту» (min hour day month day_of_week).</li>
      <li><code>cd /path-to-your-project</code> — переход в директорию проекта.</li>
      <li><code>php artisan schedule:run</code> — запуск планировщика Laravel.</li>
      <li><code>&gt;&gt; /dev/null 2&gt;&amp;1</code> — подавить вывод и ошибки (иначе cron пришлёт email на локального юзера).</li>
    </ul>

    <div class="tip">
      В некоторых средах (Laravel Forge, Vapor, Envoyer, платформы с поддержкой очередей) cron-запись <strong>настраивается автоматически</strong>. Проверять в UI платформы.
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="test-tube" style="width:14px;height:14px"></i> Тестирование расписания</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>php artisan schedule:list</code> — показать все зарегистрированные задачи и когда они запустятся.</li>
      <li><code>php artisan schedule:test</code> (Laravel 9+) — интерактивно выбрать задачу и запустить её сейчас.</li>
      <li><code>php artisan schedule:run</code> — запустить то, что должно запуститься <em>прямо сейчас</em> согласно расписанию.</li>
      <li><code>php artisan schedule:work</code> — запустить schedule:run каждую минуту в фоне (для локальной разработки, замена cron).</li>
    </ul>
  </div>

  <div class="subsection" id="sch-practice">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: расписание для отчётов</div>
<pre><code><span class="c-comment">// routes/console.php</span>
<span class="c-key">use</span> <span class="c-type">Illuminate\Support\Facades\Schedule</span>;

<span class="c-type">Schedule</span>::<span class="c-fn">command</span>(<span class="c-str">'reports:daily'</span>)
    -&gt;<span class="c-fn">dailyAt</span>(<span class="c-str">'08:00'</span>)
    -&gt;<span class="c-fn">timezone</span>(<span class="c-str">'Asia/Almaty'</span>)
    -&gt;<span class="c-fn">withoutOverlapping</span>(<span class="c-num">30</span>)
    -&gt;<span class="c-fn">onOneServer</span>()
    -&gt;<span class="c-fn">emailOutputOnFailure</span>(<span class="c-str">'devops@example.com'</span>);

<span class="c-type">Schedule</span>::<span class="c-fn">job</span>(<span class="c-key">new</span> <span class="c-type">CleanupOldExports</span>())
    -&gt;<span class="c-fn">weekly</span>()
    -&gt;<span class="c-fn">sundays</span>()
    -&gt;<span class="c-fn">at</span>(<span class="c-str">'03:00'</span>);
</code></pre>
  </div>

  <div class="subsection" id="sch-pitfalls">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Cron-запись не настроена.</strong> Без <code>* * * * * php artisan schedule:run</code> в crontab расписание не работает. Заверьте на проде первой проверкой.</div>
    <div class="pitfall"><strong>2. <code>withoutOverlapping</code> без TTL.</strong> Дефолтный TTL — 24 часа. Если процесс упал, lock держится сутки. Указывайте явный таймаут.</div>
    <div class="pitfall"><strong>3. <code>onOneServer</code> на file cache.</strong> File cache локален для сервера — atomic lock не работает между серверами. Используйте Redis.</div>
    <div class="pitfall"><strong>4. <code>->daily()</code> в UTC.</strong> Дефолтная таймзона — <code>app.timezone</code>. Если она UTC, а ожидание «Asia/Almaty 8:00» — расписание сработает в 13:00 по Алматы. Указывайте <code>timezone()</code>.</div>
    <div class="pitfall"><strong>5. Долгие задачи блокируют scheduler.</strong> <code>schedule:run</code> сам по себе быстрый, но <code>->command(...)</code> может занять минуты. Используйте <code>->runInBackground()</code> или <code>->job(...)</code> для постановки в очередь.</div>
    <div class="pitfall"><strong>6. Pingback URL на dead server.</strong> <code>->thenPing('https://hc.example.com/ok')</code> — pingback после успеха. Если URL мёртв (Healthchecks.io не обновлён) — false alarm.</div>
    <div class="pitfall"><strong>7. Тестирование scheduler.</strong> <code>php artisan schedule:run</code> запустит то, что должно запуститься сейчас. Чтобы протестировать без ожидания — <code>schedule:test</code> (Laravel 9+).</div>
    <div class="pitfall"><strong>8. Несколько <code>schedule:run</code> в crontab.</strong> Две записи cron — два процесса каждую минуту. Tasks с <code>withoutOverlapping</code> справятся, без — выполнятся дважды.</div>
  </div>
</div>

<div id="sec-auth" class="section">
  <div class="section-title">Auth, Gates и Policies</div>
  <div class="subsection" id="auth-purpose">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Аутентификация (auth) и авторизация (authorization) — два разных слоя. Auth отвечает «кто этот пользователь». Authorization — «может ли он сделать это действие». Laravel разделяет их явно: guards/providers для аутентификации, gates и policies — для авторизации. Понимание разницы и взаимодействия — основа безопасной архитектуры.</p>
  </div>

  <div class="subsection" id="auth-components">
    <div class="subsection-title"><i data-lucide="list"></i> Компоненты</div>
    <div class="card"><h3>Guards</h3><p class="text">Способ аутентификации: <code>session</code>, <code>token</code>, <code>sanctum</code>, <code>passport</code>, кастомный. Один guard на один способ. <code>auth('api')-&gt;user()</code> — пользователь из guard <code>api</code>.</p></div>
    <div class="card"><h3>Providers</h3><p class="text">Источник пользователей: <code>eloquent</code> (модель User), <code>database</code> (таблица напрямую). Гибкость — кастомный провайдер для LDAP, SSO.</p></div>
    <div class="card"><h3>Gates</h3><p class="text">Глобальная функция авторизации: <code>Gate::define('admin-area', fn ($user) =&gt; $user-&gt;is_admin)</code>. Использование: <code>Gate::allows('admin-area')</code>. Для «сквозных» проверок, не привязанных к модели.</p></div>
    <div class="card"><h3>Policies</h3><p class="text">Класс с методами авторизации по модели: <code>UserPolicy::update(User $admin, User $target)</code>. Регистрация — <code>AuthServiceProvider::$policies</code>. Использование: <code>$user-&gt;can('update', $target)</code>.</p></div>
    <div class="card"><h3>Gate::before / after</h3><p class="text">Глобальные хуки: <code>Gate::before(fn ($user) =&gt; $user-&gt;is_root ? true : null)</code> — root проходит везде. Возврат null — продолжать проверку обычным путём.</p></div>
  </div>

  <div class="subsection" id="auth-guards">
    <div class="subsection-title"><i data-lucide="shield"></i> Guards — глубокий разбор</div>

    <p class="text"><strong>Guard</strong> — механизм, определяющий, <em>как</em> аутентифицировать пользователя для конкретного запроса: через сессии, токены, API-ключи, JWT и т.д. Каждый guard реализует <strong>один способ</strong> проверки подлинности. В Laravel можно использовать <em>несколько guards одновременно</em> для разных частей приложения (например, <code>web</code> для веб-интерфейса и <code>api</code> для API).</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="file-cog" style="width:14px;height:14px"></i> Где определяются</div>
    <p class="text">Все guards настраиваются в <code>config/auth.php</code> в массиве <code>guards</code>. По умолчанию:</p>
<pre><code><span class="c-str">'guards'</span> =&gt; [
    <span class="c-str">'web'</span> =&gt; [
        <span class="c-str">'driver'</span>   =&gt; <span class="c-str">'session'</span>,
        <span class="c-str">'provider'</span> =&gt; <span class="c-str">'users'</span>,
    ],
    <span class="c-str">'api'</span> =&gt; [
        <span class="c-str">'driver'</span>   =&gt; <span class="c-str">'token'</span>,
        <span class="c-str">'provider'</span> =&gt; <span class="c-str">'users'</span>,
        <span class="c-str">'hash'</span>     =&gt; <span class="c-key">false</span>,
    ],
],
</code></pre>
    <p class="text">Каждый guard содержит два ключа:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>driver</code> — <em>механизм</em> аутентификации (session, token, sanctum, passport, custom)</li>
      <li><code>provider</code> — <em>источник</em> пользователей (обычно <code>users</code> = модель <code>App\Models\User</code>; можно определить свой для LDAP/SSO)</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="cpu" style="width:14px;height:14px"></i> Типы драйверов</div>
    <table class="data-table">
      <thead><tr><th>Драйвер</th><th>Описание</th><th>Типичное использование</th></tr></thead>
      <tbody>
        <tr>
          <td><code>session</code></td>
          <td>Хранит состояние в сессии (куки). Требует middleware <code>StartSession</code>.</td>
          <td>Веб-интерфейс, стандартный вход через форму.</td>
        </tr>
        <tr>
          <td><code>token</code></td>
          <td>Проверяет API-токен в заголовке <code>Authorization</code> или параметре запроса. Токен хранится в поле <code>users.api_token</code>. <strong>Устарел.</strong></td>
          <td>Простые API без сложной логики. <em>Не рекомендуется для новых проектов.</em></td>
        </tr>
        <tr>
          <td><code>sanctum</code></td>
          <td>Гибкий: поддерживает и сессии (через куки), и токены (через заголовок).</td>
          <td>Современные SPA (Vue/React) и мобильные клиенты.</td>
        </tr>
        <tr>
          <td><code>passport</code></td>
          <td>Полноценный OAuth2-сервер: access-токены, refresh-токены, scopes.</td>
          <td>API для сторонних приложений, микросервисы, сложные системы с разделением прав.</td>
        </tr>
        <tr>
          <td><code>jwt</code> (кастомный)</td>
          <td>JWT-токены. Не в ядре — требует <code>tymon/jwt-auth</code>.</td>
          <td>Безсессионная аутентификация с компактными токенами.</td>
        </tr>
        <tr>
          <td><code>custom</code></td>
          <td>Собственный драйвер под специфические нужды (сертификаты, внешний сервис).</td>
          <td>Нестандартные протоколы, интеграции.</td>
        </tr>
      </tbody>
    </table>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="user-check" style="width:14px;height:14px"></i> Получение текущего пользователя</div>
<pre><code><span class="c-comment">// Пользователь из guard 'web' (по умолчанию)</span>
<span class="c-var">$user</span> = <span class="c-fn">auth</span>()-&gt;<span class="c-fn">user</span>();

<span class="c-comment">// Пользователь из guard 'api'</span>
<span class="c-var">$user</span> = <span class="c-fn">auth</span>(<span class="c-str">'api'</span>)-&gt;<span class="c-fn">user</span>();

<span class="c-comment">// Через фасад — явно указываем guard</span>
<span class="c-var">$user</span> = <span class="c-type">Auth</span>::<span class="c-fn">guard</span>(<span class="c-str">'api'</span>)-&gt;<span class="c-fn">user</span>();

<span class="c-comment">// Проверка аутентификации в определённом guard</span>
<span class="c-key">if</span> (<span class="c-fn">auth</span>(<span class="c-str">'api'</span>)-&gt;<span class="c-fn">check</span>()) {
    <span class="c-comment">// ...</span>
}
</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="log-in" style="width:14px;height:14px"></i> Принудительная аутентификация</div>
<pre><code><span class="c-key">if</span> (<span class="c-type">Auth</span>::<span class="c-fn">guard</span>(<span class="c-str">'web'</span>)-&gt;<span class="c-fn">attempt</span>(<span class="c-var">$credentials</span>)) {
    <span class="c-comment">// вход для web — создаётся сессия</span>
}

<span class="c-key">if</span> (<span class="c-type">Auth</span>::<span class="c-fn">guard</span>(<span class="c-str">'api'</span>)-&gt;<span class="c-fn">attempt</span>(<span class="c-var">$credentials</span>)) {
    <span class="c-comment">// вход для api-token — обычно не используется,</span>
    <span class="c-comment">// т.к. токены не создаются через attempt (нужен createToken)</span>
}
</code></pre>
    <p class="text">Для <code>sanctum</code> и <code>passport</code> — обычно <code>attempt</code> с последующей выдачей токена (<code>$user-&gt;createToken(...)</code>).</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="route" style="width:14px;height:14px"></i> Привязка guard к маршрутам</div>
<pre><code><span class="c-comment">// Использовать guard 'api'</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/user'</span>, <span class="c-key">function</span> () {
    <span class="c-key">return</span> <span class="c-fn">auth</span>(<span class="c-str">'api'</span>)-&gt;<span class="c-fn">user</span>();
})-&gt;<span class="c-fn">middleware</span>(<span class="c-str">'auth:api'</span>);

<span class="c-comment">// Несколько guards — проверяются по очереди</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/profile'</span>, <span class="c-key">function</span> () {
    <span class="c-comment">// ...</span>
})-&gt;<span class="c-fn">middleware</span>(<span class="c-str">'auth:web,api'</span>);
</code></pre>
    <p class="text">Если guard не указан — используется <code>defaults.guard</code> из <code>config/auth.php</code> (обычно <code>web</code>).</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="wrench" style="width:14px;height:14px"></i> Кастомные guards</div>
    <p class="text">Если стандартные драйверы не подходят — реализуйте <code>Illuminate\Contracts\Auth\Guard</code> и зарегистрируйте через сервис-провайдер:</p>
<pre><code><span class="c-comment">// AppServiceProvider::boot()</span>
<span class="c-type">Auth</span>::<span class="c-fn">extend</span>(<span class="c-str">'custom'</span>, <span class="c-key">function</span> (<span class="c-var">$app</span>, <span class="c-var">$name</span>, <span class="c-var">$config</span>) {
    <span class="c-key">return new</span> <span class="c-type">CustomGuard</span>(
        <span class="c-var">$app</span>-&gt;<span class="c-fn">make</span>(<span class="c-type">YourUserProvider</span>::<span class="c-key">class</span>),
        <span class="c-var">$app</span>-&gt;<span class="c-fn">make</span>(<span class="c-type">Request</span>::<span class="c-key">class</span>)
    );
});
</code></pre>
    <p class="text">После этого в <code>config/auth.php</code> добавляйте guard с драйвером <code>custom</code>.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="info" style="width:14px;height:14px"></i> Особенности драйверов</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong><code>session</code></strong> — сессии + куки, требует <code>StartSession</code> в middleware-группе <code>web</code>.</li>
      <li><strong><code>token</code></strong> — устаревший. Вместо него — <code>sanctum</code> или <code>passport</code>.</li>
      <li><strong><code>sanctum</code></strong> — для SPA использует куки (сессии), для мобильных — токены в заголовке. Может работать полностью без сессий.</li>
      <li><strong><code>passport</code></strong> — OAuth2-сервер, требует установки пакета и настройки RSA-ключей.</li>
    </ul>

    <div class="tip">
      <strong>Практические рекомендации:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li><strong>Веб-сайт</strong> → <code>web</code> с драйвером <code>session</code>.</li>
        <li><strong>API</strong> → <code>sanctum</code> (простой) или <code>passport</code> (OAuth2).</li>
        <li><strong>Микросервисы / внешние интеграции</strong> → <code>passport</code> или кастомный JWT.</li>
        <li><strong>Несколько способов входа в одном проекте</strong> (админы через сессии, пользователи через токены) → отдельные guards, привязанные к нужным маршрутам.</li>
      </ul>
    </div>

    <div class="remember-box">
      <strong>Итог:</strong> Guard = «как проверяем пользователя». Provider = «где хранятся пользователи». Один guard — один способ проверки, но в одном приложении их может быть много. <code>auth('guard')-&gt;user()</code> для получения, <code>middleware('auth:guard')</code> для защиты маршрутов.
    </div>
  </div>

  <div class="subsection" id="auth-providers">
    <div class="subsection-title"><i data-lucide="database"></i> Providers — источники пользователей</div>

    <p class="text"><strong>Provider (провайдер)</strong> — компонент, отвечающий за <em>извлечение пользователей из хранилища</em> (БД, LDAP, внешний API и т.д.) на основе переданных данных (email/пароль/токен). Он определяет, <strong>откуда берутся пользователи</strong>, в то время как <a href="#" onclick="showSub('auth','auth-guards',this.parentElement.parentElement); return false;">Guard</a> определяет, <em>как их проверять</em>. Эти два понятия работают вместе: <strong>Guard использует Provider</strong> для получения пользователя.</p>

    <div class="tip">
      <strong>Guard vs Provider — одной фразой:</strong> Guard — «как проверяем» (session/token/…), Provider — «откуда достаём» (Eloquent/DB/LDAP). Один Guard всегда ссылается на один Provider.
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="file-cog" style="width:14px;height:14px"></i> Где определяются</div>
    <p class="text">Все провайдеры настраиваются в <code>config/auth.php</code> в массиве <code>providers</code>. По умолчанию:</p>
<pre><code><span class="c-str">'providers'</span> =&gt; [
    <span class="c-str">'users'</span> =&gt; [
        <span class="c-str">'driver'</span> =&gt; <span class="c-str">'eloquent'</span>,
        <span class="c-str">'model'</span>  =&gt; <span class="c-type">App\Models\User</span>::<span class="c-key">class</span>,
    ],
],
</code></pre>
    <p class="text">Каждый провайдер содержит:</p>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><code>driver</code> — <em>тип</em> провайдера (способ получения пользователей)</li>
      <li><code>model</code> — Eloquent-модель (для <code>eloquent</code>-драйвера)</li>
      <li><code>table</code> — имя таблицы (для <code>database</code>-драйвера)</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="cpu" style="width:14px;height:14px"></i> Типы драйверов</div>
    <table class="data-table">
      <thead><tr><th>Драйвер</th><th>Описание</th><th>Когда использовать</th></tr></thead>
      <tbody>
        <tr>
          <td><code>eloquent</code></td>
          <td>Использует Eloquent-модель для поиска пользователя. По умолчанию — <code>App\Models\User</code>.</td>
          <td>Стандартный выбор. Пользователи в БД, нужны отношения Eloquent, mutators, casts.</td>
        </tr>
        <tr>
          <td><code>database</code></td>
          <td>Использует Query Builder для прямого обращения к таблице БД (без модели).</td>
          <td>Простые системы без Eloquent, либо когда модель не нужна.</td>
        </tr>
      </tbody>
    </table>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="hammer" style="width:14px;height:14px"></i> Пример настройки</div>
    <p class="text"><strong>Eloquent-провайдер</strong> с двумя моделями (пользователи + администраторы):</p>
<pre><code><span class="c-str">'providers'</span> =&gt; [
    <span class="c-str">'users'</span> =&gt; [
        <span class="c-str">'driver'</span> =&gt; <span class="c-str">'eloquent'</span>,
        <span class="c-str">'model'</span>  =&gt; <span class="c-type">App\Models\User</span>::<span class="c-key">class</span>,
    ],
    <span class="c-str">'admins'</span> =&gt; [
        <span class="c-str">'driver'</span> =&gt; <span class="c-str">'eloquent'</span>,
        <span class="c-str">'model'</span>  =&gt; <span class="c-type">App\Models\Admin</span>::<span class="c-key">class</span>,
    ],
],
</code></pre>

    <p class="text"><strong>Database-провайдер</strong> (без модели):</p>
<pre><code><span class="c-str">'providers'</span> =&gt; [
    <span class="c-str">'users'</span> =&gt; [
        <span class="c-str">'driver'</span> =&gt; <span class="c-str">'database'</span>,
        <span class="c-str">'table'</span>  =&gt; <span class="c-str">'users'</span>,
    ],
],
</code></pre>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="link-2" style="width:14px;height:14px"></i> Как Provider связан с Guard</div>
    <p class="text">Каждый Guard ссылается на <em>конкретный Provider</em> через ключ <code>provider</code>:</p>
<pre><code><span class="c-str">'guards'</span> =&gt; [
    <span class="c-str">'web'</span> =&gt; [
        <span class="c-str">'driver'</span>   =&gt; <span class="c-str">'session'</span>,
        <span class="c-str">'provider'</span> =&gt; <span class="c-str">'users'</span>,
    ],
    <span class="c-str">'api'</span> =&gt; [
        <span class="c-str">'driver'</span>   =&gt; <span class="c-str">'token'</span>,
        <span class="c-str">'provider'</span> =&gt; <span class="c-str">'users'</span>,
    ],
    <span class="c-str">'admin'</span> =&gt; [
        <span class="c-str">'driver'</span>   =&gt; <span class="c-str">'session'</span>,
        <span class="c-str">'provider'</span> =&gt; <span class="c-str">'admins'</span>,
    ],
],
</code></pre>
    <p class="text">Теперь guard <code>admin</code> использует провайдер <code>admins</code>, который ссылается на модель <code>Admin</code>. <code>web</code> и <code>api</code> используют один и тот же провайдер <code>users</code>, но разные способы проверки.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="wrench" style="width:14px;height:14px"></i> Кастомные провайдеры (LDAP, SSO, внешние API)</div>
    <p class="text">Если стандартные провайдеры не подходят (пользователи в LDAP, Active Directory, внешнем API) — реализуйте интерфейс <code>Illuminate\Contracts\Auth\UserProvider</code>:</p>
<pre><code><span class="c-key">use</span> <span class="c-type">Illuminate\Contracts\Auth\UserProvider</span>;
<span class="c-key">use</span> <span class="c-type">Illuminate\Contracts\Auth\Authenticatable</span>;

<span class="c-key">class</span> <span class="c-type">LdapUserProvider</span> <span class="c-key">implements</span> <span class="c-type">UserProvider</span>
{
    <span class="c-key">public function</span> <span class="c-fn">retrieveById</span>(<span class="c-var">$identifier</span>) { <span class="c-comment">/* найти по ID */</span> }
    <span class="c-key">public function</span> <span class="c-fn">retrieveByToken</span>(<span class="c-var">$identifier</span>, <span class="c-var">$token</span>) { <span class="c-comment">/* remember-me */</span> }
    <span class="c-key">public function</span> <span class="c-fn">updateRememberToken</span>(<span class="c-type">Authenticatable</span> <span class="c-var">$user</span>, <span class="c-var">$token</span>) { <span class="c-comment">/* сохранить токен */</span> }
    <span class="c-key">public function</span> <span class="c-fn">retrieveByCredentials</span>(<span class="c-key">array</span> <span class="c-var">$credentials</span>) { <span class="c-comment">/* найти по email/username */</span> }
    <span class="c-key">public function</span> <span class="c-fn">validateCredentials</span>(<span class="c-type">Authenticatable</span> <span class="c-var">$user</span>, <span class="c-key">array</span> <span class="c-var">$credentials</span>) { <span class="c-comment">/* проверить пароль */</span> }
}
</code></pre>

    <p class="text">Регистрация в сервис-провайдере через <code>Auth::provider()</code>:</p>
<pre><code><span class="c-comment">// AppServiceProvider::boot()</span>
<span class="c-type">Auth</span>::<span class="c-fn">provider</span>(<span class="c-str">'ldap'</span>, <span class="c-key">function</span> (<span class="c-var">$app</span>, <span class="c-key">array</span> <span class="c-var">$config</span>) {
    <span class="c-key">return new</span> <span class="c-type">LdapUserProvider</span>();
});
</code></pre>

    <p class="text">После этого в <code>config/auth.php</code>:</p>
<pre><code><span class="c-str">'providers'</span> =&gt; [
    <span class="c-str">'ldap_users'</span> =&gt; [
        <span class="c-str">'driver'</span> =&gt; <span class="c-str">'ldap'</span>,
        <span class="c-comment">// дополнительные настройки (host, base_dn, ...)</span>
    ],
],
</code></pre>
    <p class="text">Теперь любой guard может использовать этот провайдер для аутентификации из LDAP.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="lightbulb" style="width:14px;height:14px"></i> Зачем нужна гибкость providers</div>
    <div class="card">
      <h3>Разделение данных</h3>
      <p class="text">Одна таблица — для обычных пользователей, другая — для администраторов. У каждой своя модель, свои поля, свои relations.</p>
    </div>
    <div class="card">
      <h3>Интеграция с внешними системами</h3>
      <p class="text">Корпоративные пользователи — через Active Directory. Внешние клиенты — через обычную БД. Один Laravel обслуживает обе группы.</p>
    </div>
    <div class="card">
      <h3>Миграция</h3>
      <p class="text">При переходе с одной системы на другую можно <em>заменить провайдер</em> без изменения логики аутентификации выше по стеку.</p>
    </div>
    <div class="card">
      <h3>Тестирование</h3>
      <p class="text">Фейковый провайдер, возвращающий предопределённых пользователей — простой способ протестировать flow без реальной БД.</p>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="split" style="width:14px;height:14px"></i> Пример: два разных провайдера в одном приложении</div>
<pre><code><span class="c-comment">// config/auth.php</span>
<span class="c-str">'providers'</span> =&gt; [
    <span class="c-str">'users'</span> =&gt; [
        <span class="c-str">'driver'</span> =&gt; <span class="c-str">'eloquent'</span>,
        <span class="c-str">'model'</span>  =&gt; <span class="c-type">App\Models\User</span>::<span class="c-key">class</span>,
    ],
    <span class="c-str">'api_clients'</span> =&gt; [
        <span class="c-str">'driver'</span> =&gt; <span class="c-str">'database'</span>,
        <span class="c-str">'table'</span>  =&gt; <span class="c-str">'api_clients'</span>,
    ],
],

<span class="c-str">'guards'</span> =&gt; [
    <span class="c-str">'web'</span> =&gt; [
        <span class="c-str">'driver'</span>   =&gt; <span class="c-str">'session'</span>,
        <span class="c-str">'provider'</span> =&gt; <span class="c-str">'users'</span>,
    ],
    <span class="c-str">'api'</span> =&gt; [
        <span class="c-str">'driver'</span>   =&gt; <span class="c-str">'passport'</span>,
        <span class="c-str">'provider'</span> =&gt; <span class="c-str">'api_clients'</span>,
    ],
],
</code></pre>
    <p class="text">Веб-часть использует модель <code>User</code>, а API — таблицу <code>api_clients</code>. Никаких пересечений: разные модели, разные способы проверки, но одна общая инфраструктура Laravel.</p>

    <div class="remember-box">
      <strong>Итог:</strong>
      <ul style="margin:6px 0 0 20px;line-height:1.7">
        <li><strong>Provider</strong> = источник данных пользователей (Eloquent, БД-таблица, LDAP, внешнее API).</li>
        <li><strong>Драйверы:</strong> <code>eloquent</code> (стандарт) и <code>database</code> (простой без модели).</li>
        <li><strong>Кастомные</strong> — <code>Auth::provider(...)</code> в <code>boot()</code> для интеграции с внешними системами.</li>
        <li><strong>Связь:</strong> Guard (как) использует Provider (откуда) для поиска и проверки учётных данных.</li>
        <li><strong>Гибкость:</strong> разные части приложения — разные провайдеры (админы из одной таблицы, пользователи из другой).</li>
      </ul>
    </div>
  </div>

  <div class="subsection" id="auth-spa">
    <div class="subsection-title"><i data-lucide="app-window"></i> SPA и Sanctum</div>

    <p class="text"><strong>SPA (Single Page Application)</strong> — одностраничное веб-приложение. В отличие от классических многостраничных сайтов (MPA), где каждый клик по ссылке загружает новую HTML-страницу с сервера, SPA работает иначе.</p>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="layers" style="width:14px;height:14px"></i> Как устроена SPA</div>
    <ul style="line-height:1.9;margin:6px 0 0 20px;color:var(--text2)">
      <li><strong>Один раз загружает всю «оболочку».</strong> При первом посещении браузер получает одну HTML-страницу + все CSS/JS-бандлы.</li>
      <li><strong>Дальше работает в браузере.</strong> Вся навигация и отрисовка интерфейса — в браузере. При переходе по ссылке JavaScript перехватывает событие, запрашивает у сервера только <em>данные</em> (обычно JSON) и динамически обновляет уже загруженную страницу.</li>
      <li><strong>Никаких перезагрузок.</strong> Нет мерцаний и белых экранов, характерных для перезагрузки. Интерфейс обновляется плавно и мгновенно — по ощущениям близко к нативным приложениям.</li>
    </ul>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="split" style="width:14px;height:14px"></i> SPA + Laravel: типичная схема</div>
    <div class="card">
      <h3>Бэкенд (API)</h3>
      <p class="text">Laravel работает как <strong>API-сервер</strong>: отдаёт только данные (JSON), не занимается отрисовкой HTML. Роуты в <code>routes/api.php</code>, контроллеры возвращают <code>JsonResource</code>/массивы.</p>
    </div>
    <div class="card">
      <h3>Фронтенд (SPA)</h3>
      <p class="text">Клиентская часть на JS-фреймворке: <strong>React / Vue.js / Angular / Svelte</strong>. Развёртывается отдельно (Vite/Webpack) либо инжектится в единственный blade-шаблон Laravel.</p>
    </div>
    <div class="card">
      <h3>Аутентификация: Laravel Sanctum</h3>
      <p class="text">Для защиты API — <strong>Laravel Sanctum</strong>. Даёт лёгкий механизм аутентификации: <em>для SPA на том же домене</em> — через куки-сессии (безопасно, без хранения токена в JS), <em>для мобильных клиентов</em> — через токены в заголовке <code>Authorization</code>.</p>
    </div>

    <div class="subsection-title" style="margin-top:14px;font-size:14px"><i data-lucide="hammer" style="width:14px;height:14px"></i> Sanctum для SPA — коротко</div>
<pre><code><span class="c-comment">// 1. Установка</span>
composer require laravel/sanctum
php artisan vendor:publish --provider=<span class="c-str">"Laravel\Sanctum\SanctumServiceProvider"</span>
php artisan migrate

<span class="c-comment">// 2. config/sanctum.php — указать домены SPA</span>
<span class="c-str">'stateful'</span> =&gt; [<span class="c-str">'localhost:3000'</span>, <span class="c-str">'app.example.com'</span>],

<span class="c-comment">// 3. Защищаем routes/api.php</span>
<span class="c-type">Route</span>::<span class="c-fn">middleware</span>(<span class="c-str">'auth:sanctum'</span>)-&gt;<span class="c-fn">get</span>(<span class="c-str">'/user'</span>, <span class="c-key">fn</span>(<span class="c-type">Request</span> <span class="c-var">$r</span>) =&gt; <span class="c-var">$r</span>-&gt;<span class="c-fn">user</span>());

<span class="c-comment">// 4. Со стороны SPA (пример на Axios):</span>
<span class="c-comment">// - сначала GET /sanctum/csrf-cookie (получить XSRF-TOKEN)</span>
<span class="c-comment">// - потом POST /login с credentials (создаётся сессия)</span>
<span class="c-comment">// - все последующие запросы автоматически несут куки</span>
</code></pre>

    <div class="tip">
      <strong>Итог:</strong> SPA + Laravel — это способ строить веб-приложения, которые по скорости и плавности интерфейса максимально приближены к нативным программам. Стандартная связка — <em>Laravel как JSON API + Vue/React как SPA + Sanctum для auth</em>.
    </div>
  </div>

  <div class="subsection" id="auth-practice">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: policy для модели</div>
<pre><code><span class="c-key">final class</span> <span class="c-type">PostPolicy</span>
{
    <span class="c-key">public function</span> <span class="c-fn">viewAny</span>(<span class="c-key">?</span><span class="c-type">User</span> <span class="c-var">$user</span>): <span class="c-key">bool</span>
    {
        <span class="c-key">return</span> <span class="c-key">true</span>; <span class="c-comment">// публичный список</span>
    }

    <span class="c-key">public function</span> <span class="c-fn">update</span>(<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-type">Post</span> <span class="c-var">$post</span>): <span class="c-key">bool</span>
    {
        <span class="c-key">return</span> <span class="c-var">$user</span>-&gt;<span class="c-var">id</span> === <span class="c-var">$post</span>-&gt;<span class="c-var">user_id</span> || <span class="c-var">$user</span>-&gt;<span class="c-fn">hasRole</span>(<span class="c-str">'editor'</span>);
    }

    <span class="c-key">public function</span> <span class="c-fn">delete</span>(<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-type">Post</span> <span class="c-var">$post</span>): <span class="c-key">bool</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">update</span>(<span class="c-var">$user</span>, <span class="c-var">$post</span>) &amp;&amp; ! <span class="c-var">$post</span>-&gt;<span class="c-fn">isPublished</span>();
    }
}

<span class="c-comment">// Контроллер</span>
<span class="c-key">public function</span> <span class="c-fn">update</span>(<span class="c-type">UpdatePostRequest</span> <span class="c-var">$request</span>, <span class="c-type">Post</span> <span class="c-var">$post</span>): <span class="c-type">RedirectResponse</span>
{
    <span class="c-var">$this</span>-&gt;<span class="c-fn">authorize</span>(<span class="c-str">'update'</span>, <span class="c-var">$post</span>); <span class="c-comment">// бросит 403 если не разрешено</span>
    <span class="c-var">$post</span>-&gt;<span class="c-fn">update</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());
    <span class="c-key">return</span> <span class="c-fn">redirect</span>(<span class="c-var">$post</span>-&gt;<span class="c-fn">url</span>());
}

<span class="c-comment">// Auto-discovery: policy для Post автоматически находится, если</span>
<span class="c-comment">// PostPolicy лежит в app/Policies/. Иначе — регистрация явно.</span>
</code></pre>
  </div>

  <div class="subsection" id="auth-pitfalls">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>auth()-&gt;user()</code> возвращает null.</strong> Если запрос не прошёл через <code>auth</code> middleware, <code>user()</code> вернёт null. Code <code>auth()-&gt;user()-&gt;id</code> упадёт. Используйте <code>auth()-&gt;id()</code> или явные проверки.</div>
    <div class="pitfall"><strong>2. Policy <code>before</code> и <code>after</code>.</strong> Можно объявить методы <code>before</code>/<code>after</code> прямо в policy. <code>before</code> возвращает true/false/null — null означает «продолжить обычную проверку».</div>
    <div class="pitfall"><strong>3. Policy с null user (guest).</strong> Если метод принимает <code>?User $user</code> — guest пройдёт. Если просто <code>User</code> — Laravel сразу вернёт false для guest без вызова метода.</div>
    <div class="pitfall"><strong>4. Multiple guards и confusion.</strong> На странице с двумя guards (admin и user) <code>auth()-&gt;user()</code> возьмёт default guard. Уточняйте: <code>auth('admin')-&gt;user()</code>.</div>
    <div class="pitfall"><strong>5. Gate::define после регистрации.</strong> Если <code>Gate::define</code> вызван в <code>register()</code> провайдера — Gate ещё не готов. Только в <code>boot()</code>.</div>
    <div class="pitfall"><strong>6. <code>can</code> на Eloquent-модели.</strong> <code>$user-&gt;can('update', $post)</code> требует, чтобы у User был трейт <code>Authorizable</code> (он есть по умолчанию).</div>
    <div class="pitfall"><strong>7. Policy и lazy loading.</strong> <code>PostPolicy::update($user, $post)</code> может обращаться к <code>$post-&gt;owner</code> — N+1 на странице со списком постов. Eager load relations перед проверкой policy.</div>
    <div class="pitfall"><strong>8. Подмена user в тестах.</strong> <code>actingAs($user)</code> ставит user в default guard. Для API: <code>Sanctum::actingAs($user, ['*'])</code> или <code>actingAs($user, 'api')</code>.</div>
  </div>
</div>

<div id="sec-octane" class="section">
  <div class="section-title">Octane и long-running окружения</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Laravel Octane — обёртка над Swoole / RoadRunner / FrankenPHP, превращающая Laravel в long-running процесс. Bootstrap выполняется один раз на воркер, запросы обрабатываются без переинициализации фреймворка. Это даёт x5-x10 ускорение. Цена — изменение модели жизненного цикла: то, что в PHP-FPM «само очищается» между запросами, в Octane живёт между ними и приводит к утечкам состояния.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Что меняется</div>
    <div class="card"><h3>Singleton переживает запросы</h3><p class="text">В FPM singleton живёт до конца запроса. В Octane — до перезапуска воркера (десятки тысяч запросов). Состояние, накопленное в singleton, утечёт.</p></div>
    <div class="card"><h3>Static-свойства</h3><p class="text">То же: <code>static $cache = []</code> в классе остаётся между запросами. Не используйте static для request-scope данных.</p></div>
    <div class="card"><h3>Scoped bindings</h3><p class="text">Решение для request-scope: <code>$app-&gt;scoped(...)</code> — singleton на запрос, сбрасывается между запросами через <code>Octane::flushApplicationState()</code>.</p></div>
    <div class="card"><h3>Concurrent tasks</h3><p class="text"><code>Octane::concurrently([fn () =&gt; ..., fn () =&gt; ...])</code> — параллельное выполнение в отдельных воркерах. Полезно для агрегации данных из разных источников.</p></div>
    <div class="card"><h3>Ticks</h3><p class="text"><code>Octane::tick('foo', fn () =&gt; ..., 60)</code> — периодическое выполнение раз в N секунд в каждом воркере. Кеш в памяти, прогрев данных.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: безопасный сервис под Octane</div>
<pre><code><span class="c-comment">// ❌ Singleton с request-state — утечка</span>
<span class="c-var">$app</span>-&gt;<span class="c-fn">singleton</span>(<span class="c-type">RequestContext</span>::<span class="c-key">class</span>);

<span class="c-comment">// ✓ Scoped — сбрасывается между запросами</span>
<span class="c-var">$app</span>-&gt;<span class="c-fn">scoped</span>(<span class="c-type">RequestContext</span>::<span class="c-key">class</span>);

<span class="c-comment">// ❌ Static с per-request данными — утечка</span>
<span class="c-key">final class</span> <span class="c-type">UserCache</span>
{
    <span class="c-key">private static array</span> <span class="c-var">$loaded</span> = []; <span class="c-comment">// растёт между запросами</span>
}

<span class="c-comment">// ✓ Зависимость от scoped-кеша или нормального Cache</span>
<span class="c-key">final class</span> <span class="c-type">UserCache</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private</span> <span class="c-type">CacheRepository</span> <span class="c-var">$cache</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">get</span>(<span class="c-key">int</span> <span class="c-var">$id</span>): <span class="c-type">User</span>
    {
        <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-var">cache</span>-&gt;<span class="c-fn">remember</span>(<span class="c-str">"user:{$id}"</span>, <span class="c-num">300</span>, <span class="c-key">fn</span> () =&gt; <span class="c-type">User</span>::<span class="c-fn">findOrFail</span>(<span class="c-var">$id</span>));
    }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Auth-state в singleton.</strong> Если ваш guard кешируется в singleton — следующий запрос увидит предыдущего пользователя. Тестируйте под Octane перед деплоем.</div>
    <div class="pitfall"><strong>2. Конфиг, изменённый рантайм.</strong> <code>config(['key' =&gt; 'value'])</code> в FPM сбросится с концом запроса. В Octane — переживёт. Все вызовы должны быть только чтение.</div>
    <div class="pitfall"><strong>3. PDO-соединение и pool.</strong> Постоянное PDO-соединение в воркере дольше, чем в FPM. Если БД рестартанула, воркер падает с broken pipe. Octane reconnect помогает, но проверяйте.</div>
    <div class="pitfall"><strong>4. Memory leaks.</strong> Утечки PHP-память накапливаются. Перезапуск воркера через <code>--max-requests=500</code> освобождает.</div>
    <div class="pitfall"><strong>5. Event listeners в singleton.</strong> Listeners, регистрируемые на ходу через <code>Event::listen</code>, копятся между запросами. Регистрация — только в Service Provider.</div>
    <div class="pitfall"><strong>6. Eloquent global scopes.</strong> Глобальные scopes на модели — нормально, поскольку определены в коде. Но <code>Model::addGlobalScope(...)</code> в коде запроса добавит scope для всех воркеров до перезапуска.</div>
    <div class="pitfall"><strong>7. Долгий handle с большим объёмом данных.</strong> Загрузка 100MB в память остаётся в воркере. Используйте <code>cursor()</code> или <code>chunk()</code> вместо <code>get()</code>.</div>
    <div class="pitfall"><strong>8. Octane-specific хуки.</strong> Octane имеет <code>RequestReceived</code>, <code>RequestHandled</code>, <code>RequestTerminated</code> события. Регистрируйте сброс состояния через них, не через middleware terminate.</div>
  </div>
</div>

<div id="sec-practice" class="section">
  <div class="section-title">Практика: фича заказа от запроса до доставки</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> Постановка</div>
    <p class="text">Реализуем endpoint <code>POST /api/orders</code>: пользователь оформляет заказ, мы списываем платёж, ставим в очередь отправку invoice, эмитим событие, обновляем счётчики. Покажем интеграцию всех слоёв Laravel и где встречаются knock-on эффекты.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Слои</div>

<pre><code><span class="c-comment">// 1. FormRequest — валидация и авторизация</span>
<span class="c-key">final class</span> <span class="c-type">StoreOrderRequest</span> <span class="c-key">extends</span> <span class="c-type">FormRequest</span>
{
    <span class="c-key">public function</span> <span class="c-fn">authorize</span>(): <span class="c-key">bool</span> { <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">user</span>() !== <span class="c-key">null</span>; }

    <span class="c-key">public function</span> <span class="c-fn">rules</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'items'</span>            =&gt; [<span class="c-str">'required'</span>, <span class="c-str">'array'</span>, <span class="c-str">'min:1'</span>],
            <span class="c-str">'items.*.sku'</span>     =&gt; [<span class="c-str">'required'</span>, <span class="c-str">'exists:products,sku'</span>],
            <span class="c-str">'items.*.quantity'</span>=&gt; [<span class="c-str">'required'</span>, <span class="c-str">'integer'</span>, <span class="c-str">'min:1'</span>],
            <span class="c-str">'currency'</span>         =&gt; [<span class="c-str">'required'</span>, <span class="c-str">'in:USD,KZT,EUR'</span>],
        ];
    }
}

<span class="c-comment">// 2. Controller — тонкий, делегирует</span>
<span class="c-key">final class</span> <span class="c-type">OrderController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">store</span>(<span class="c-type">StoreOrderRequest</span> <span class="c-var">$request</span>, <span class="c-type">CreateOrder</span> <span class="c-var">$action</span>): <span class="c-type">JsonResponse</span>
    {
        <span class="c-var">$order</span> = <span class="c-var">$action</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">user</span>(), <span class="c-var">$request</span>-&gt;<span class="c-fn">validated</span>());

        <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>(<span class="c-key">new</span> <span class="c-type">OrderResource</span>(<span class="c-var">$order</span>), <span class="c-num">201</span>);
    }
}

<span class="c-comment">// 3. Action — оркестрация бизнес-логики</span>
<span class="c-key">final class</span> <span class="c-type">CreateOrder</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(
        <span class="c-key">private</span> <span class="c-type">PaymentGateway</span> <span class="c-var">$gateway</span>,
        <span class="c-key">private</span> <span class="c-type">RiskEngine</span>     <span class="c-var">$risk</span>,
    ) {}

    <span class="c-key">public function</span> <span class="c-fn">__invoke</span>(<span class="c-type">User</span> <span class="c-var">$user</span>, <span class="c-key">array</span> <span class="c-var">$data</span>): <span class="c-type">Order</span>
    {
        <span class="c-key">if</span> (<span class="c-var">$this</span>-&gt;<span class="c-var">risk</span>-&gt;<span class="c-fn">score</span>(<span class="c-var">$data</span>) &gt;= <span class="c-num">80</span>) {
            <span class="c-key">throw new</span> <span class="c-type">HighRiskException</span>();
        }

        <span class="c-key">return</span> <span class="c-type">DB</span>::<span class="c-fn">transaction</span>(<span class="c-key">function</span> () <span class="c-key">use</span> (<span class="c-var">$user</span>, <span class="c-var">$data</span>) {
            <span class="c-var">$order</span> = <span class="c-type">Order</span>::<span class="c-fn">create</span>([
                <span class="c-str">'user_id'</span>     =&gt; <span class="c-var">$user</span>-&gt;<span class="c-var">id</span>,
                <span class="c-str">'status'</span>      =&gt; <span class="c-str">'pending'</span>,
                <span class="c-str">'currency'</span>    =&gt; <span class="c-var">$data</span>[<span class="c-str">'currency'</span>],
                <span class="c-str">'total_minor'</span> =&gt; <span class="c-type">OrderTotal</span>::<span class="c-fn">calculate</span>(<span class="c-var">$data</span>[<span class="c-str">'items'</span>]),
            ]);
            <span class="c-var">$order</span>-&gt;<span class="c-fn">items</span>()-&gt;<span class="c-fn">createMany</span>(<span class="c-var">$data</span>[<span class="c-str">'items'</span>]);

            <span class="c-var">$chargeId</span> = <span class="c-var">$this</span>-&gt;<span class="c-var">gateway</span>-&gt;<span class="c-fn">charge</span>(<span class="c-var">$order</span>-&gt;<span class="c-var">total_minor</span>, <span class="c-var">$order</span>-&gt;<span class="c-var">currency</span>, <span class="c-str">"ord_{$order-&gt;id}"</span>);
            <span class="c-var">$order</span>-&gt;<span class="c-fn">update</span>([<span class="c-str">'status'</span> =&gt; <span class="c-str">'paid'</span>, <span class="c-str">'charge_id'</span> =&gt; <span class="c-var">$chargeId</span>, <span class="c-str">'paid_at'</span> =&gt; <span class="c-fn">now</span>()]);

            <span class="c-comment">// dispatch'аем после commit транзакции</span>
            <span class="c-type">SendInvoice</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>-&gt;<span class="c-var">id</span>)-&gt;<span class="c-fn">afterCommit</span>();
            <span class="c-type">OrderPaid</span>::<span class="c-fn">dispatch</span>(<span class="c-var">$order</span>);

            <span class="c-key">return</span> <span class="c-var">$order</span>;
        });
    }
}
</code></pre>

    <p class="text">Что демонстрирует пример: FormRequest валидирует и авторизует; Controller остаётся тонким; Action — единица бизнес-логики; транзакция оборачивает все БД-операции; <code>afterCommit</code> гарантирует, что job не отправится раньше commit'а; событие <code>OrderPaid</code> подключает дополнительные слушатели без правок Action. Все слои Laravel работают в паре, каждый отвечает за своё.</p>
  </div>
</div>

<div id="sec-pitfalls" class="section">
  <div class="section-title">Сводные подводные камни</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Топ ошибок Laravel-приложений</div>
    <div class="pitfall"><strong>1. <code>config:cache</code> с динамическими значениями.</strong> Кеш собирается раз; вызовы <code>env()</code> в коде после кеша вернут null. <code>env()</code> только в конфиге, в коде — <code>config()</code>.</div>
    <div class="pitfall"><strong>2. Mass assignment без <code>$fillable</code>.</strong> <code>User::create($request-&gt;all())</code> с <code>$guarded = []</code> пропустит <code>is_admin</code>. Используйте FormRequest и явный whitelist.</div>
    <div class="pitfall"><strong>3. N+1 в API Resource.</strong> Resource обращается к relations &mdash; если не загружены, N+1. <code>Model::preventLazyLoading()</code> в локальной разработке.</div>
    <div class="pitfall"><strong>4. Транзакция без <code>afterCommit</code> для job.</strong> Job уйдёт в очередь до commit; воркер не найдёт строку. Используйте <code>->afterCommit()</code>.</div>
    <div class="pitfall"><strong>5. Eloquent в Octane без scoped.</strong> Singleton хранит state &mdash; следующий запрос видит чужие данные. <code>$app-&gt;scoped(...)</code> для request-state.</div>
    <div class="pitfall"><strong>6. Полагание на <code>session()</code> в API.</strong> API-маршруты обычно без session middleware &mdash; <code>session()-&gt;get()</code> вернёт null. Для stateless API используйте jwt/Sanctum tokens.</div>
    <div class="pitfall"><strong>7. <code>->orWhere</code> без скобок.</strong> <code>where(...)-&gt;orWhere(...)-&gt;where(...)</code> &mdash; <code>or</code> теряет приоритет. Группируйте: <code>where(fn ($q) =&gt; $q-&gt;where(...)-&gt;orWhere(...))</code>.</div>
    <div class="pitfall"><strong>8. <code>updated_at</code> при импорте.</strong> Mass import через Eloquent обновляет timestamps &mdash; теряется исходная дата. Используйте <code>DB::table()</code> или <code>$model-&gt;timestamps = false</code>.</div>
    <div class="pitfall"><strong>9. <code>findOrFail</code> в API без exception handler.</strong> Дефолт &mdash; 404, но без явного JSON ответа &mdash; HTML страница. Кастомизируйте в <code>App\Exceptions\Handler</code>.</div>
    <div class="pitfall"><strong>10. <code>Mail::send</code> синхронно.</strong> Блокирует request на отправку. Используйте <code>Mail::queue</code> или <code>ShouldQueue</code> на Mailable.</div>
    <div class="pitfall"><strong>11. <code>config('app.url')</code> для генерации ссылок.</strong> Без правильной настройки <code>APP_URL</code> ссылки в письмах ведут на <code>http://localhost</code>. Проверяйте в проде.</div>
    <div class="pitfall"><strong>12. <code>DB::raw</code> с пользовательским вводом.</strong> Защита prepared statements теряется. Только параметризованные значения через <code>?</code> binding.</div>
  </div>
</div>

<div id="sec-interview" class="section">
  <div class="section-title">Вопросы на собеседование (middle / senior)</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="rotate-cw"></i> Lifecycle и Container</div>
    <div class="card"><h3>1. Опишите цикл HTTP-запроса в Laravel</h3><p class="text">(1) <code>public/index.php</code> загружает Composer и <code>bootstrap/app.php</code>. (2) <code>Application</code> создаётся, конфигурируется ядро. (3) <code>Kernel::handle</code> прогоняет bootstrappers (env, config, providers). (4) Провайдеры: все <code>register()</code>, потом все <code>boot()</code>. (5) Pipeline глобальных middleware. (6) Router: подбор маршрута, групповые/маршрутные middleware, route model binding. (7) Controller с DI. (8) Response поднимается через middleware. (9) <code>terminate()</code> после отправки клиенту.</p></div>
    <div class="card"><h3>2. Чем <code>register()</code> отличается от <code>boot()</code> в Service Provider?</h3><p class="text"><code>register()</code> вызывается первым у всех провайдеров — можно только добавлять binding'и в контейнер, нельзя использовать другие сервисы (их ещё нет). <code>boot()</code> — после того как все провайдеры завершили <code>register()</code>, доступны все сервисы и фасады. Регистрация маршрутов, observer'ов, событий — в <code>boot()</code>.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="route"></i> Routing и Middleware</div>
    <div class="card"><h3>3. Что делает <code>scopeBindings()</code> и зачем?</h3><p class="text">Если в маршруте два параметра-модели через relation (<code>/users/{user}/posts/{post:slug}</code>), без <code>scopeBindings</code> Laravel найдёт пост по slug в любой таблице. С <code>scopeBindings</code> — только среди постов конкретного user. Защита от чтения чужих данных через подмену slug.</p></div>
    <div class="card"><h3>4. Когда middleware-метод <code>terminate</code> не работает?</h3><p class="text">Требует поддержки <code>fastcgi_finish_request</code> или эквивалента в SAPI. PHP-FPM — поддерживает. Built-in <code>artisan serve</code> — нет; на нём <code>terminate</code> работает синхронно, удлиняя ответ. Также в Octane модель другая.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> Eloquent и Cache</div>
    <div class="card"><h3>5. Чем <code>$user-&gt;orders</code> отличается от <code>$user-&gt;orders()</code>?</h3><p class="text"><code>$user-&gt;orders</code> — magic-property, возвращает <code>Collection</code> заказов, lazy-loaded при первом обращении. <code>$user-&gt;orders()</code> — метод, возвращает <code>HasMany</code> query builder для дальнейшей фильтрации: <code>$user-&gt;orders()-&gt;where('status', 'paid')-&gt;get()</code>.</p></div>
    <div class="card"><h3>6. Что такое cache stampede и как с ним бороться?</h3><p class="text">Когда дорогой ключ устаревает, множество одновременных запросов начинают его регенерировать параллельно, перегружая БД. Решение — atomic lock через <code>Cache::lock(key)-&gt;block(timeout, fn() =&gt; ...)</code>: только один запрос пересоздаёт, остальные ждут или возвращают stale-значение.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list-checks"></i> Очереди и события</div>
    <div class="card"><h3>7. Что произойдёт, если job в очереди dispatched внутри транзакции, а транзакция откатится?</h3><p class="text">Без специальных мер job уже в очереди и будет выполнен — обработчик попробует найти строку, которой нет (rollback). Решение: <code>dispatch()-&gt;afterCommit()</code> или <code>public bool $afterCommit = true;</code> в job. Job попадает в очередь только после успешного commit.</p></div>
    <div class="card"><h3>8. Почему job должен быть идемпотентным?</h3><p class="text">При retry handle() вызывается N раз при сбоях. Без идемпотентности (например, отправка письма без проверки факта отправки) пользователь получит N писем. Решение: проверка флага в начале handle (<code>if ($order-&gt;invoice_sent_at) return;</code>) или использование уникальных идентификаторов на стороне внешнего сервиса (idempotency key).</p></div>
    <div class="card"><h3>9. В чём разница между Event и Job?</h3><p class="text">Event — декларация факта (что-то произошло), Job — задача (что нужно сделать). Event может иметь несколько listeners, каждый — отдельная единица работы. Job — единичная задача. Подписка на Event можно добавить без правок основного кода; новый Job требует явного dispatch. Используйте Events для slojnoy логики; Jobs — для атомарных действий.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="key"></i> Auth и безопасность</div>
    <div class="card"><h3>10. Чем gate отличается от policy?</h3><p class="text">Gate — глобальная функция авторизации, не привязанная к модели: <code>Gate::define('admin-area', fn ($user) =&gt; ...)</code>. Policy — класс с методами авторизации <em>для конкретной модели</em>: <code>UserPolicy::update($admin, $target)</code>. Policy лучше масштабируется на CRUD-операции; Gate — для абстрактных разрешений (доступ к админке, право видеть метрики).</p></div>
    <div class="card"><h3>11. Что делает <code>Gate::before</code> и когда уместен?</h3><p class="text">Глобальный хук перед любой проверкой. Возврат <code>true</code> — разрешает всё; <code>false</code> — запрещает всё; <code>null</code> — обычная проверка. Уместен для super-admin: <code>Gate::before(fn ($user) =&gt; $user-&gt;is_root ? true : null)</code>. Опасно использовать для основной логики — скрывает правила.</p></div>
    <div class="card"><h3>12. Как разделить аутентификацию для web и для API?</h3><p class="text">Через guards в <code>config/auth.php</code>. <code>web</code> — session-based (cookies). <code>api</code> — token-based (sanctum/passport). Доступ: <code>auth('api')-&gt;user()</code>. Маршруты группируются: <code>Route::middleware('auth:web')</code> или <code>auth:sanctum</code>. Default guard — для запросов без явного указания.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="rocket"></i> Octane и производительность</div>
    <div class="card"><h3>13. Почему singleton может быть опасен в Octane?</h3><p class="text">В классическом PHP-FPM процесс умирает после запроса &mdash; singleton сбрасывается. В Octane процесс живёт между запросами; singleton с per-request state (например, корзина, контекст пользователя) утечёт следующему пользователю. Решение: <code>$app-&gt;scoped(...)</code> &mdash; singleton на запрос, сбрасывается через <code>Octane::flushApplicationState()</code>.</p></div>
    <div class="card"><h3>14. Что делает <code>Octane::concurrently()</code>?</h3><p class="text">Выполняет несколько callable параллельно в отдельных воркерах. Возвращает массив результатов в том же порядке. Идеально для агрегации данных из разных источников: <code>[$users, $orders, $stats] = Octane::concurrently([fn () =&gt; User::count(), fn () =&gt; Order::sum('total'), fn () =&gt; Stats::current()])</code>.</p></div>
    <div class="card"><h3>15. Как мониторить производительность Laravel-приложения?</h3><p class="text">(1) Slow query log БД. (2) Laravel Telescope (только в dev/staging — он сам тяжёлый). (3) Внешние APM: New Relic, Datadog, Tideways &mdash; видят time-per-request с разбивкой по уровням (контроллер, БД, внешние API). (4) Horizon для очередей &mdash; throughput, failed jobs, wait time. (5) Метрики из приложения через middleware: timing, status codes, размер ответа &mdash; в Prometheus/Datadog.</p></div>
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
  document.querySelectorAll('.nav-subitem').forEach(n => n.classList.remove('active'));
  const sec = document.getElementById('sec-' + id);
  if (sec) sec.classList.add('active');
  if (el) el.classList.add('active');
  window.scrollTo(0, 0);
  lucide.createIcons();
}

function showSub(sectionId, anchorId, el) {
  // Активируем секцию (если ещё не активна) без сброса подсветки sub-item
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.nav-subitem').forEach(n => n.classList.remove('active'));
  const sec = document.getElementById('sec-' + sectionId);
  if (sec) sec.classList.add('active');
  // Подсветить родительский nav-item
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  const parentNav = document.querySelector(`.nav-item[onclick*="showSection('${sectionId}'"]`);
  if (parentNav) parentNav.classList.add('active');
  // Подсветить подпункт и скроллить
  if (el) el.classList.add('active');
  const anchor = document.getElementById(anchorId);
  if (anchor) {
    // Небольшая задержка чтобы секция успела показаться
    setTimeout(() => anchor.scrollIntoView({ behavior: 'smooth', block: 'start' }), 50);
  }
  lucide.createIcons();
}
</script>
</body>
</html>
@endverbatim
