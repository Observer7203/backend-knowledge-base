@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MegaRega Integration — am.eabr.org</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
  --bg:#F5F8FA;--surface:#FFFFFF;--border:#E4E6EF;--text:#181C32;--text2:#7E8299;--text3:#A1A5B7;
  --primary:#404357;--primary-light:#EFF2F5;--purple:#7239EA;--purple-light:#F8F5FF;
  --success:#50CD89;--success-light:#E8FFF3;--success-dark:#0D7D53;
  --warning:#FFC700;--warning-light:#FFF8DD;--warning-dark:#B45309;
  --danger:#F1416C;--danger-light:#FFF5F8;--teal:#20C9D5;--teal-light:#EAFCFD;
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
.badge{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;}
.badge-blue,.badge-success,.badge-warning,.badge-teal{background:#EFF2F5;color:#5E6278;}
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
.info-box{border-radius:var(--radius);padding:14px 16px;margin-bottom:16px;border-left:4px solid;font-size:13px;line-height:1.7;}
.info-box.blue,.info-box.purple,.info-box.success{background:var(--primary-light);border-color:var(--primary);color:#404357;}
.info-box.warning{background:#FFF8E1;border-color:#E0A000;color:#7B5000;}
.info-box.danger{background:#FFF3F5;border-color:#D0404E;color:#7B1C2A;}
.info-box strong{font-weight:700;}
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:20px;margin-bottom:16px;box-shadow:var(--shadow);}
.card-title{font-size:13px;font-weight:700;color:var(--text);margin-bottom:10px;display:flex;align-items:center;gap:8px;}
pre{background:var(--code-bg);border:1px solid var(--code-border);border-radius:var(--radius);padding:20px;overflow-x:auto;margin-bottom:16px;font-size:12.5px;line-height:1.7;}
pre code{color:#ABB2BF;font-family:'JetBrains Mono','Fira Code',Consolas,monospace;}
.c-comment{color:#5C6370;}.c-key{color:#C678DD;}.c-str{color:#98C379;}.c-fn{color:#61AFEF;}.c-var{color:#E5C07B;}.c-type{color:#E06C75;}
.data-table{width:100%;border-collapse:collapse;margin-bottom:16px;font-size:13px;}
.data-table th{background:var(--bg);padding:10px 14px;text-align:left;font-weight:700;font-size:11px;text-transform:uppercase;letter-spacing:0.5px;color:var(--text2);border-bottom:1px solid var(--border);}
.data-table td{padding:10px 14px;border-bottom:1px solid var(--border);color:var(--text2);vertical-align:top;}
.data-table td strong{color:var(--text);font-weight:600;}
.data-table td code{background:var(--bg);border:1px solid var(--border);border-radius:4px;padding:1px 6px;font-size:11.5px;font-family:monospace;color:var(--primary);}
.data-table tr:last-child td{border-bottom:none;}
.flow-diagram{background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:24px;margin-bottom:20px;}
.flow-arrow{display:flex;align-items:flex-start;gap:8px;background:var(--bg);border:1px solid var(--border);border-radius:8px;padding:10px 14px;margin:6px 0;font-size:12.5px;}
.flow-arrow .step-num{background:var(--primary);color:white;font-size:10px;font-weight:700;border-radius:50%;width:20px;height:20px;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;}
.flow-arrow .step-dir{color:var(--primary);font-weight:700;font-size:16px;flex-shrink:0;}
.flow-arrow .step-label{color:var(--text);font-weight:600;}
.flow-arrow .step-detail{color:var(--text2);font-size:11.5px;margin-top:2px;}
.file-path{display:inline-flex;align-items:center;gap:6px;background:var(--code-bg);color:#E5C07B;border-radius:6px;padding:4px 10px;font-size:11.5px;font-family:monospace;margin-bottom:14px;}
.qa-item{border:1px solid var(--border);border-radius:var(--radius);margin-bottom:10px;overflow:hidden;}
.qa-q{padding:14px 16px;font-weight:600;font-size:13.5px;cursor:pointer;display:flex;align-items:flex-start;gap:10px;transition:background 0.15s;}
.qa-q:hover{background:var(--bg);}
.qa-q .q-icon svg{width:14px;height:14px;color:var(--primary);}
.qa-a{padding:0 16px 14px 40px;color:var(--text2);font-size:13px;line-height:1.75;display:none;}
.qa-a.open{display:block;}

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
  <div class="sidebar-title">MegaRega</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> Что такое MegaRega</a>
  <a class="nav-item" onclick="showSection('architecture',this)"><i data-lucide="layout-dashboard"></i> Полная схема</a>
  <a class="nav-item" onclick="showSection('flow',this)"><i data-lucide="git-branch"></i> Flow регистрации</a>
  <a class="nav-item" onclick="showSection('statuses',this)"><i data-lucide="circle-dot"></i> Статусы ЛК + Апрув</a>
  <a class="nav-item" onclick="showSection('approvals',this)"><i data-lucide="check-circle"></i> Апрув/Отказ письма</a>
  <a class="nav-item" onclick="showSection('event',this)"><i data-lucide="zap"></i> Event + Listener</a>
  <a class="nav-item" onclick="showSection('config',this)"><i data-lucide="settings"></i> config/megarega.php</a>
  <a class="nav-item" onclick="showSection('api',this)"><i data-lucide="globe"></i> MegaRegaApi.php</a>
  <a class="nav-item" onclick="showSection('form',this)"><i data-lucide="file-text"></i> RegisterForm.php</a>
  <a class="nav-item" onclick="showSection('service',this)"><i data-lucide="layers"></i> MegaRegaService.php</a>
  <a class="nav-item" onclick="showSection('fields',this)"><i data-lucide="list"></i> Маппинг полей</a>
  <a class="nav-item" onclick="showSection('todo',this)"><i data-lucide="list-checks"></i> Что нужно доделать</a>
  <a class="nav-item" onclick="showSection('questions',this)"><i data-lucide="message-circle"></i> Вопросы разработчику</a>
</div>

<div class="main">
  <div class="page-header">
    <h1>MegaRega — Интеграция регистрации</h1>
    <p>Автоматическая отправка данных участников в систему управления мероприятием</p>
    <div class="badge-row">
      <span class="badge badge-blue">MegaRega API</span>
      <span class="badge badge-success">Guzzle HTTP</span>
      <span class="badge badge-warning">Laravel Events</span>
      <span class="badge badge-teal">be.megarega.ru</span>
    </div>
  </div>

  <!-- ARCHITECTURE -->
  <div id="architecture" class="section">
    <div class="section-title">Полная схема интеграции</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="layout-dashboard"></i> Все участники системы</div>
      <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:20px">
        <div class="card">
          <div class="card-title"><i data-lucide="globe"></i> Бэк Сайт (am.eabr.org)</div>
          <p style="color:var(--text2);font-size:12.5px;line-height:1.7">Центральный узел. Принимает регистрации, управляет статусами ЛК, передаёт данные в MegaRega и в приложение.</p>
        </div>
        <div class="card">
          <div class="card-title"><i data-lucide="database"></i> MegaRega (be.megarega.ru)</div>
          <p style="color:var(--text2);font-size:12.5px;line-height:1.7">Система управления мероприятием. Получает участников, проверяет их, отправляет апрув или отказ обратно на сайт.</p>
        </div>
        <div class="card">
          <div class="card-title"><i data-lucide="smartphone"></i> Мобильное Приложение</div>
          <p style="color:var(--text2);font-size:12.5px;line-height:1.7">Получает данные профиля от сайта через SSO/API после первого апрува. Только одобренные участники имеют доступ.</p>
        </div>
      </div>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="arrow-right-left"></i> Все API взаимодействия</div>
      <table class="data-table">
        <thead><tr><th>Направление</th><th>Что передаётся</th><th>Когда</th><th>Статус</th></tr></thead>
        <tbody>
          <tr><td><strong>Сайт → MegaRega</strong></td><td>Данные участника при регистрации</td><td>После UserRegisteredEvent</td><td>✅ Реализовано</td></tr>
          <tr><td><strong>MegaRega → Сайт</strong></td><td>Апрув или отказ участника</td><td>После проверки организаторами</td><td>⚠️ Нужно реализовать</td></tr>
          <tr><td><strong>Сайт → MegaRega</strong></td><td>Обновление данных при дозаполнении в ЛК</td><td>При корректировке данных участником</td><td>⚠️ Нужно реализовать</td></tr>
          <tr><td><strong>Сайт → Приложение</strong></td><td>Данные профиля пользователя</td><td>После первого апрува (SSO)</td><td>✅ UserProvisionController</td></tr>
          <tr><td><strong>Сайт → Приложение</strong></td><td>Программа мероприятия</td><td>По запросу приложения</td><td>⚠️ Нужно уточнить API</td></tr>
          <tr><td><strong>Приложение → Сайт</strong></td><td>Создание профиля</td><td>До регистрации (provision)</td><td>✅ /api/v1/users/provision</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- OVERVIEW -->
  <div id="overview" class="section active">
    <div class="section-title">Что такое MegaRega</div>
    <div class="subsection">
      <div class="subsection-title"><i data-lucide="lightbulb"></i> Простыми словами</div>
      <p class="text"><strong>MegaRega</strong> (be.megarega.ru) — внешняя система управления мероприятиями (Event Management System). Когда человек регистрируется на сайте am.eabr.org, его данные автоматически отправляются в MegaRega, чтобы организаторы видели всех участников в одном месте.</p>
      <div class="info-box blue">
        <strong>Аналогия:</strong> Сайт — это форма регистрации. MegaRega — это CRM организаторов мероприятия. При регистрации данные копируются туда автоматически, не нужно вручную вносить каждого участника.
      </div>
      <p class="text"><strong>Важно:</strong> Интеграция работает через события Laravel (Event + Listener). Это значит отправка в MegaRega происходит <em>асинхронно</em> после регистрации — пользователь уже получил ответ, а в фоне идёт отправка данных.</p>
    </div>
    <div class="subsection">
      <div class="subsection-title"><i data-lucide="file-tree"></i> Файлы интеграции</div>
      <pre><code><span class="c-comment">// Конфиг</span>
config/megarega.php                     <span class="c-comment">// UUID форм для dev и prod</span>

<span class="c-comment">// API клиент</span>
app/Services/Megarega/MegaRegaApi.php   <span class="c-comment">// HTTP запросы к be.megarega.ru</span>

<span class="c-comment">// Построитель формы</span>
app/Services/Megarega/RegisterForm.php  <span class="c-comment">// маппинг SiteUser → поля MegaRega</span>

<span class="c-comment">// Оркестратор</span>
app/Services/MegaRegaService.php        <span class="c-comment">// координирует Api + Form</span>

<span class="c-comment">// Вызывается из</span>
app/Listeners/SendRegisteredNotification.php  <span class="c-comment">// после UserRegisteredEvent</span>
app/Providers/EventServiceProvider.php        <span class="c-comment">// привязка Event → Listener</span></code></pre>
    </div>
  </div>

  <!-- STATUSES -->
  <div id="statuses" class="section">
    <div class="section-title">Статусы ЛК + Логика апрува</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="circle-dot"></i> Статусы в личном кабинете</div>
      <p class="text">После подачи заявки пользователь видит статус своей регистрации. Статус меняется через API от MegaRega или вручную организаторами.</p>
      <table class="data-table">
        <thead><tr><th>Статус</th><th>Что означает</th><th>Что видит пользователь</th><th>Доступ в приложение</th></tr></thead>
        <tbody>
          <tr><td><strong style="color:var(--warning-dark)">на проверке</strong></td><td>Данные отправлены в MegaRega, ждём решения</td><td>Форма заблокирована, статус "Заявка на рассмотрении"</td><td>❌ Нет</td></tr>
          <tr><td><strong style="color:var(--success-dark)">одобрено</strong></td><td>MegaRega или организатор одобрил участника</td><td>✅ Одобрено — получайте бейдж</td><td>✅ Есть</td></tr>
          <tr><td><strong style="color:var(--danger)">отказано</strong></td><td>Заявка отклонена</td><td>❌ Отказ — письмо с причиной</td><td>❌ Нет</td></tr>
          <tr><td><strong style="color:var(--primary)">на корректировки</strong></td><td>Данные неверные, нужно исправить</td><td>⚠️ Перепроверьте данные и отправьте повторно</td><td>❌ Нет</td></tr>
        </tbody>
      </table>

      <div class="info-box warning">
        <strong>Важно:</strong> После первой отправки данных — редактирование формы <strong>заблокировано</strong>. Пользователь не может менять данные самостоятельно (только если получил статус "на корректировки"). Это нужно реализовать на фронтенде.
      </div>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="check-circle"></i> 2 апрува от MegaRega</div>
      <p class="text">MegaRega даёт два разных разрешения, они независимы:</p>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:16px">
        <div class="card" style="border-left:4px solid var(--primary)">
          <div class="card-title"><i data-lucide="log-in"></i> Апрув 1 — Доступ в ЛК</div>
          <p style="color:var(--text2);font-size:12.5px;line-height:1.7">Участник может войти в личный кабинет, видеть программу мероприятия. Также открывает доступ в мобильное приложение.</p>
        </div>
        <div class="card" style="border-color:var(--primary);border-left:4px solid var(--primary)">
          <div class="card-title" style="color:var(--primary)"><i data-lucide="award"></i> Апрув 2 — Получение бейджа</div>
          <p style="color:var(--text2);font-size:12.5px;line-height:1.7">Физический бейдж участника на мероприятии. Отдельное подтверждение что участник будет присутствовать лично.</p>
        </div>
      </div>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="zap"></i> Что нужно сделать в коде</div>
      <div class="info-box danger">
        <strong>❌ Сейчас не реализовано:</strong> Сайт умеет <em>отправлять</em> данные в MegaRega, но не умеет <em>получать</em> апрув/отказ обратно. Нужно добавить:
      </div>
      <pre><code><span class="c-comment">// 1. Добавить поле статуса в site_users</span>
<span class="c-comment">// Миграция: php artisan make:migration add_approval_status_to_site_users</span>
ALTER TABLE site_users ADD COLUMN approval_status VARCHAR(50) DEFAULT 'pending';
<span class="c-comment">// Значения: pending | approved | rejected | correction_needed</span>

<span class="c-comment">// 2. Создать endpoint для приёма апрува от MegaRega</span>
<span class="c-comment">// POST /api/v1/megarega/webhook</span>
<span class="c-comment">// Или: MegaRega звонит на URL который мы им дадим</span>

<span class="c-comment">// 3. При апруве — разблокировать доступ в приложение</span>
<span class="c-comment">// UserProvisionController или EventServiceProvider</span>

<span class="c-comment">// 4. При отказе — отправить письмо пользователю</span>
<span class="c-comment">// event(new UserRejectedEvent($user))</span></code></pre>
    </div>
  </div>

  <!-- APPROVALS -->
  <div id="approvals" class="section">
    <div class="section-title">Письма Апрув / Отказ</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="alert-triangle"></i> TODO — найти тексты писем</div>
      <div class="info-box danger">
        <strong>Задача из схемы:</strong><br>
        1) Найти текст письма <strong>отказа</strong> — актуализировать на двух языках (RU + EN)<br>
        2) Найти текст письма <strong>апрува</strong> — актуализировать на двух языках (RU + EN)
      </div>
      <p class="text">Письма скорее всего лежат в папке <code>resources/views/emails/</code>. Нужно найти их и проверить актуальность текста.</p>
      <pre><code><span class="c-comment">// Где искать письма:</span>
resources/views/emails/
  ├── register-form.blade.php       <span class="c-comment">// письмо заказчику при регистрации</span>
  ├── user-confirmed-ru.blade.php   <span class="c-comment">// апрув (RU)</span>
  ├── user-confirmed-en.blade.php   <span class="c-comment">// апрув (EN)</span>
  └── ?rejection?.blade.php         <span class="c-comment">// письмо отказа (найти файл)</span>

<span class="c-comment">// Проверить в SendConfirmedNotification.php что используется:</span>
view("emails.user-confirmed-$locale")  <span class="c-comment">// locale = 'ru' или 'en'</span></code></pre>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="mail"></i> Структура письма апрува (SendConfirmedNotification)</div>
      <pre><code><span class="c-comment">// app/Listeners/SendConfirmedNotification.php</span>
<span class="c-comment">// Вызывается на UserConfirmedEvent</span>

<span class="c-var">$mailEntity</span>->sendTo = <span class="c-var">$report</span>->email . <span class="c-str">', registration@eabr.org, zhukov_ia@eabr.org'</span>;
<span class="c-var">$mailEntity</span>->subject = (<span class="c-var">$locale</span> == <span class="c-str">'ru'</span>)
    ? <span class="c-str">'eabr.org: Доступ к личному кабинету участника Бизнес-Форума ЕАБР'</span>
    : <span class="c-str">'eabr.org: Access to the personal account of the EDB Business Forum participant'</span>;

<span class="c-comment">// Шаблон: resources/views/emails/user-confirmed-{locale}.blade.php</span>
<span class="c-comment">// ← Этот файл нужно найти и проверить текст!</span></code></pre>

      <div class="info-box purple">
        <strong>Где искать locale пользователя:</strong> <code>$report->getData('locale')</code> — значит у SiteUser есть JSON поле data с ключом locale. Если locale не задан — по умолчанию 'ru'.
      </div>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="message-square"></i> Как говорить с разработчиком про письма</div>
      <div class="card" style="border-left:4px solid var(--primary)">
        <div class="card-title"><i data-lucide="message-circle"></i> Фраза для разработчика</div>
        <p style="color:var(--text2);font-size:13px;line-height:1.8">
          <em>"Нужно найти шаблоны писем для апрува и отказа в папке resources/views/emails/. У нас два языка — ru и en. Покажи какие файлы используются в SendConfirmedNotification — нужно обновить тексты. И есть ли вообще письмо при отказе или его нужно создать?"</em>
        </p>
      </div>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="webhook"></i> Как MegaRega отправляет апрув на сайт</div>
      <p class="text">Нужно уточнить у MegaRega: как именно они уведомляют о решении — через webhook (HTTP запрос на наш URL) или мы должны сами polling делать (опрашивать их API).</p>
      <table class="data-table">
        <thead><tr><th>Вариант</th><th>Как работает</th><th>Что нужно сделать</th></tr></thead>
        <tbody>
          <tr><td><strong>Webhook</strong></td><td>MegaRega сама делает POST на наш URL при решении</td><td>Создать endpoint POST /api/v1/megarega/webhook, защитить токеном</td></tr>
          <tr><td><strong>Polling</strong></td><td>Наш сайт периодически проверяет статус через их API</td><td>Создать команду artisan + scheduler, endpoint в MegaRegaApi</td></tr>
        </tbody>
      </table>
      <div class="info-box blue">
        <strong>Вопрос разработчику MegaRega:</strong> "Как вы уведомляете о решении по участнику — вы делаете webhook на наш endpoint или мы должны сами опрашивать вашу систему? Если webhook — какой формат данных и как авторизуетесь?"
      </div>
    </div>
  </div>

  <!-- TODO SECTION -->
  <div id="todo" class="section">
    <div class="section-title">Что нужно доделать</div>
    <div class="subsection">
      <div class="subsection-title"><i data-lucide="list-checks"></i> Задачи по схеме</div>
      <table class="data-table">
        <thead><tr><th>#</th><th>Задача</th><th>Кому говорить</th><th>Приоритет</th></tr></thead>
        <tbody>
          <tr><td>1</td><td>Найти письма апрув/отказ, обновить текст на RU+EN</td><td>Разработчик сайта</td><td style="color:var(--danger);font-weight:700">HIGH</td></tr>
          <tr><td>2</td><td>Добавить статусы ЛК (pending/approved/rejected/correction)</td><td>Разработчик сайта</td><td style="color:var(--danger);font-weight:700">HIGH</td></tr>
          <tr><td>3</td><td>Заблокировать форму после отправки</td><td>Разработчик сайта</td><td style="color:var(--danger);font-weight:700">HIGH</td></tr>
          <tr><td>4</td><td>Получить апрув/отказ от MegaRega (webhook или polling)</td><td>Разработчик сайта + MegaRega</td><td style="color:var(--danger);font-weight:700">HIGH</td></tr>
          <tr><td>5</td><td>MegaRega endpoint для редактирования при дозаполнении в ЛК</td><td>Разработчик сайта</td><td style="color:var(--warning-dark);font-weight:700">MEDIUM</td></tr>
          <tr><td>6</td><td>Endpoint получения всех регистраций с сайта</td><td>Разработчик сайта</td><td style="color:var(--warning-dark);font-weight:700">MEDIUM</td></tr>
          <tr><td>7</td><td>После апрува — отдать данные профиля в приложение</td><td>Разработчик сайта + мобильщики</td><td style="color:var(--danger);font-weight:700">HIGH</td></tr>
          <tr><td>8</td><td>Согласие на передачу данных в приложение</td><td>Разработчик сайта</td><td style="color:var(--warning-dark);font-weight:700">MEDIUM</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- FLOW -->
  <div id="flow" class="section">
    <div class="section-title">Как работает интеграция</div>
    <div class="subsection">
      <div class="subsection-title"><i data-lucide="git-branch"></i> Полный flow</div>
      <div class="flow-diagram">
        <div class="flow-arrow"><span class="step-num">1</span><span class="step-dir">→</span><div><div class="step-label">Пользователь завершает регистрацию</div><div class="step-detail">ProfileController или аналогичный — сохраняет SiteUser в БД</div></div></div>
        <div class="flow-arrow"><span class="step-num">2</span><span class="step-dir">→</span><div><div class="step-label">Срабатывает событие UserRegisteredEvent</div><div class="step-detail">event(new UserRegisteredEvent($user)) — Laravel Event</div></div></div>
        <div class="flow-arrow"><span class="step-num">3</span><span class="step-dir">→</span><div><div class="step-label">EventServiceProvider запускает SendRegisteredNotification</div><div class="step-detail">UserRegisteredEvent::class → [SendRegisteredNotification::class]</div></div></div>
        <div class="flow-arrow"><span class="step-num">4</span><span class="step-dir">→</span><div><div class="step-label">SendRegisteredNotification::handle() — три действия</div><div class="step-detail">1. Отправить email заказчику (организаторы) 2. Отправить email клиенту (участник) 3. Отправить в MegaRega</div></div></div>
        <div class="flow-arrow"><span class="step-num">5</span><span class="step-dir">→</span><div><div class="step-label">MegaRegaService::sendRegisterForm($user)</div><div class="step-detail">Получает UUID формы из конфига, забирает field_groups, строит форму, отправляет</div></div></div>
        <div class="flow-arrow"><span class="step-num">6</span><span class="step-dir">→</span><div><div class="step-label">GET /api/v1/ems/forms/{uuid}/field_groups/</div><div class="step-detail">MegaRegaApi::getFieldGroups() — узнаём какие доп. поля есть в форме</div></div></div>
        <div class="flow-arrow"><span class="step-num">7</span><span class="step-dir">→</span><div><div class="step-label">RegisterForm строит данные участника</div><div class="step-detail">Маппинг: SiteUser.name → first_name, emails → [$user->email], и доп. поля</div></div></div>
        <div class="flow-arrow"><span class="step-num">8</span><span class="step-dir">→</span><div><div class="step-label">POST /api/v1/ems/forms/{uuid}/</div><div class="step-detail">MegaRegaApi::fillForm() — отправляем данные участника</div></div></div>
        <div class="flow-arrow"><span class="step-num">9</span><span class="step-dir">←</span><div><div class="step-label">MegaRega возвращает {uuid: "...участника..."}</div><div class="step-detail">Этот UUID сохраняется в site_users.uuid — идентификатор в MegaRega</div></div></div>
      </div>
      <div class="info-box warning">
        <strong>Обработка ошибок:</strong> Весь MegaRega блок обёрнут в try/catch. Если API недоступен — ошибка записывается в Log::debug и регистрация продолжается. Пользователь не видит проблемы, но данные не попали в MegaRega.
      </div>
    </div>
  </div>

  <!-- EVENT -->
  <div id="event" class="section">
    <div class="section-title">Event + Listener</div>
    <div class="subsection">
      <div class="subsection-title"><i data-lucide="zap"></i> EventServiceProvider.php</div>
      <div class="file-path"><i data-lucide="file-code"></i> app/Providers/EventServiceProvider.php</div>
      <pre><code><span class="c-var">$listen</span> = [
    UserRegisteredEvent::class => [
        SendRegisteredNotification::class   <span class="c-comment">// Здесь вызывается MegaRega</span>
    ],
    UserConfirmedEvent::class => [
        SendConfirmedNotification::class    <span class="c-comment">// МП (мобильное приложение)</span>
    ],
];</code></pre>
    </div>
    <div class="subsection">
      <div class="subsection-title"><i data-lucide="bell"></i> SendRegisteredNotification::handle()</div>
      <div class="file-path"><i data-lucide="file-code"></i> app/Listeners/SendRegisteredNotification.php</div>
      <pre><code><span class="c-key">public function</span> <span class="c-fn">handle</span>(UserRegisteredEvent <span class="c-var">$event</span>)
{
    <span class="c-comment">// 1. Email организаторам (заказчику)</span>
    <span class="c-var">$customerEntity</span> = <span class="c-var">$this</span>->getCustomerEntity(<span class="c-var">$event</span>->user);
    <span class="c-var">$this</span>->mailService->send(<span class="c-var">$customerEntity</span>);

    <span class="c-comment">// 2. Email участнику (клиенту)</span>
    <span class="c-var">$clientEntity</span> = <span class="c-var">$this</span>->getClientEntity(<span class="c-var">$event</span>->user);
    <span class="c-var">$this</span>->mailService->send(<span class="c-var">$clientEntity</span>);

    <span class="c-comment">// 3. Отправка в MegaRega (обёрнуто в try/catch!)</span>
    <span class="c-key">try</span> {
        <span class="c-var">$this</span>->apiService->sendRegisterForm(<span class="c-var">$event</span>->user);
    } <span class="c-key">catch</span> (Exception <span class="c-var">$exception</span>) {
        Log::debug(<span class="c-str">"Не удалось отправить в MegaRega.\n"</span>. <span class="c-var">$exception</span>->getMessage());
        <span class="c-comment">// Не пробрасываем исключение — регистрация продолжается</span>
    }
}</code></pre>
      <p class="text"><strong>Email типы по типу пользователя:</strong></p>
      <pre><code><span class="c-comment">// Заказчику — разные email для СМИ и обычных участников</span>
<span class="c-var">$mailEntity</span>->sendTo = <span class="c-var">$report</span>->type == <span class="c-str">'media'</span>
    ? <span class="c-var">$mailEntity</span>->sendTo_smi     <span class="c-comment">// email для СМИ</span>
    : <span class="c-var">$mailEntity</span>->sendTo;         <span class="c-comment">// email для участников</span>

<span class="c-var">$mailEntity</span>->subject = <span class="c-str">'eabr.org: Регистрация '</span>
    . (<span class="c-var">$report</span>->type == <span class="c-str">'media'</span> ? <span class="c-str">'СМИ'</span> : <span class="c-str">'участника'</span>)
    . <span class="c-str">' №'</span> . <span class="c-var">$report</span>->id;</code></pre>
    </div>
  </div>

  <!-- CONFIG -->
  <div id="config" class="section">
    <div class="section-title">config/megarega.php</div>
    <div class="file-path"><i data-lucide="file-code"></i> config/megarega.php</div>
    <div class="subsection">
      <div class="subsection-title"><i data-lucide="settings"></i> Содержимое</div>
      <pre><code><span class="c-key">return</span> [
    <span class="c-str">'local'</span> => [
        <span class="c-str">'register_form_id'</span> => <span class="c-str">'b91b7887-292b-4bc4-a137-5a7f55be8504'</span>,
    ],
    <span class="c-str">'production'</span> => [
        <span class="c-str">'register_form_id'</span> => <span class="c-str">'af5e4468-c8c7-49a9-98ae-36b62d7507cb'</span>,
    ],
];</code></pre>
      <div class="info-box blue">
        <strong>Два UUID:</strong> Для local и production — разные формы. Это потому что в MegaRega обычно есть тестовая и боевая среды. UUID формы — это идентификатор конкретной формы регистрации в их системе.
      </div>
      <div class="subsection-title" style="margin-top:20px"><i data-lucide="code"></i> Как читается в коде</div>
      <pre><code><span class="c-comment">// MegaRegaService.php</span>
<span class="c-key">private function</span> <span class="c-fn">getConfigData</span>(string <span class="c-var">$key</span>)
{
    <span class="c-comment">// Берёт блок по текущему environment (local/production)</span>
    <span class="c-var">$configData</span> = <span class="c-fn">config</span>(<span class="c-str">'megarega.'</span> . <span class="c-fn">config</span>(<span class="c-str">'app.env'</span>)) ?? [];
    <span class="c-key">return</span> Arr::get(<span class="c-var">$configData</span>, <span class="c-var">$key</span>);
}

<span class="c-comment">// Вызов: $this->getConfigData('register_form_id')</span>
<span class="c-comment">// На local  → 'b91b7887-...'</span>
<span class="c-comment">// На production → 'af5e4468-...'</span></code></pre>
    </div>
  </div>

  <!-- API -->
  <div id="api" class="section">
    <div class="section-title">MegaRegaApi.php</div>
    <div class="file-path"><i data-lucide="file-code"></i> app/Services/Megarega/MegaRegaApi.php</div>
    <div class="subsection">
      <div class="subsection-title"><i data-lucide="globe"></i> HTTP клиент (Guzzle)</div>
      <p class="text">Простой HTTP клиент на Guzzle. Два метода — получить поля формы и заполнить форму.</p>
      <pre><code><span class="c-key">const</span> API_URL     = <span class="c-str">'https://be.megarega.ru/'</span>;
<span class="c-key">const</span> METHOD_FIELDS = <span class="c-str">'api/v1/ems/forms'</span>;

<span class="c-comment">// Guzzle клиент с базовыми настройками</span>
<span class="c-var">$this</span>->_client = <span class="c-key">new</span> Client([
    <span class="c-str">'base_uri'</span> => self::API_URL,
    <span class="c-str">'timeout'</span>  => 15.0,   <span class="c-comment">// 15 секунд таймаут</span>
    <span class="c-str">'headers'</span>  => [<span class="c-str">'Content-Type'</span> => <span class="c-str">'application/json'</span>]
]);</code></pre>
      <table class="data-table">
        <thead><tr><th>Метод</th><th>HTTP</th><th>URL</th><th>Назначение</th></tr></thead>
        <tbody>
          <tr><td><code>getFieldGroups($uuid)</code></td><td>GET</td><td>/api/v1/ems/forms/{uuid}/field_groups/</td><td>Получить список дополнительных полей формы</td></tr>
          <tr><td><code>fillForm($uuid, $data)</code></td><td>POST</td><td>/api/v1/ems/forms/{uuid}/</td><td>Отправить данные участника</td></tr>
        </tbody>
      </table>
      <pre><code><span class="c-key">public function</span> <span class="c-fn">getFieldGroups</span>(string <span class="c-var">$uuid</span>)
{
    <span class="c-var">$response</span> = <span class="c-var">$this</span>->_client->get(self::METHOD_FIELDS . <span class="c-str">"/$uuid/field_groups/"</span>);
    <span class="c-key">return</span> <span class="c-var">$this</span>->getResult(<span class="c-var">$response</span>);  <span class="c-comment">// json_decode ответа</span>
}

<span class="c-key">public function</span> <span class="c-fn">fillForm</span>(string <span class="c-var">$uuid</span>, array <span class="c-var">$data</span>)
{
    <span class="c-var">$response</span> = <span class="c-var">$this</span>->_client->post(self::METHOD_FIELDS . <span class="c-str">"/$uuid/"</span>, [
        RequestOptions::BODY => <span class="c-fn">json_encode</span>(<span class="c-var">$data</span>, JSON_UNESCAPED_SLASHES)
    ]);
    <span class="c-key">return</span> <span class="c-var">$this</span>->getResult(<span class="c-var">$response</span>);  <span class="c-comment">// {uuid: "participant-uuid"}</span>
}</code></pre>
      <div class="info-box warning">
        <strong>Нет аутентификации в коде:</strong> Guzzle клиент не передаёт API-ключ или токен. Либо MegaRega не требует аутентификацию для этих endpoint'ов, либо она настроена на уровне IP-whitelist. Уточни у разработчика.
      </div>
    </div>
  </div>

  <!-- FORM -->
  <div id="form" class="section">
    <div class="section-title">RegisterForm.php</div>
    <div class="file-path"><i data-lucide="file-code"></i> app/Services/Megarega/RegisterForm.php</div>
    <div class="subsection">
      <div class="subsection-title"><i data-lucide="file-text"></i> getFormData() — итоговый payload</div>
      <pre><code><span class="c-key">public function</span> <span class="c-fn">getFormData</span>(): array
{
    <span class="c-key">return</span> [
        <span class="c-str">'first_name'</span> => <span class="c-var">$this</span>->_user->name,         <span class="c-comment">// Имя</span>
        <span class="c-str">'last_name'</span>  => <span class="c-var">$this</span>->_user->surname,      <span class="c-comment">// Фамилия</span>
        <span class="c-str">'patronymic'</span> => <span class="c-var">$this</span>->_user->patronymic,   <span class="c-comment">// Отчество</span>
        <span class="c-str">'full_name'</span>  => <span class="c-var">$this</span>->getFullName(),       <span class="c-comment">// "Иван Иванов Иванович"</span>
        <span class="c-str">'emails'</span>     => [<span class="c-var">$this</span>->_user->email],     <span class="c-comment">// Массив email</span>
        <span class="c-str">'phones'</span>     => [<span class="c-var">$this</span>->_user->phone],     <span class="c-comment">// Массив телефонов</span>
    ] + <span class="c-var">$this</span>->getAdditionalFields();  <span class="c-comment">// Merge с доп. полями</span>
}</code></pre>
    </div>
    <div class="subsection">
      <div class="subsection-title"><i data-lucide="plus"></i> Дополнительные поля (динамические)</div>
      <p class="text">MegaRega API сначала возвращает список кастомных полей формы (<code>field_groups</code>). RegisterForm маппирует эти поля из данных пользователя:</p>
      <pre><code><span class="c-key">private function</span> <span class="c-fn">getAdditionalAttributes</span>(): array
{
    <span class="c-key">return</span> [
        <span class="c-str">"category"</span>     => <span class="c-var">$this</span>->_user->type == <span class="c-str">'media'</span> ? <span class="c-str">'СМИ'</span> : <span class="c-str">'Участник'</span>,
        <span class="c-str">"org_name"</span>     => <span class="c-var">$this</span>->_user->getLegalInfo(<span class="c-str">'org'</span>),        <span class="c-comment">// Организация</span>
        <span class="c-str">"org_position"</span> => <span class="c-var">$this</span>->_user->getLegalInfo(<span class="c-str">'position'</span>),  <span class="c-comment">// Должность</span>
        <span class="c-str">"org_website"</span>  => <span class="c-var">$this</span>->_user->getLegalInfo(<span class="c-str">'website'</span>),   <span class="c-comment">// Сайт</span>
        <span class="c-str">"how_find_out"</span> => <span class="c-var">$this</span>->_user->getLegalInfo(<span class="c-str">'hear'</span>),      <span class="c-comment">// Как узнал</span>
        <span class="c-str">"agreement"</span>    => <span class="c-key">true</span>                                         <span class="c-comment">// Согласие</span>
    ];
}

<span class="c-comment">// Для select полей — значение конвертируется в ID из MegaRega</span>
<span class="c-key">if</span> (<span class="c-var">$attribute</span>->type == <span class="c-str">'select'</span>) {
    <span class="c-var">$columns</span> = <span class="c-fn">array_column</span>(<span class="c-var">$attribute</span>->select_values, <span class="c-str">'value'</span>);
    <span class="c-key">if</span> ((<span class="c-var">$searchKey</span> = <span class="c-fn">array_search</span>(<span class="c-var">$value</span>, <span class="c-var">$columns</span>)) !== false) {
        <span class="c-var">$value</span> = <span class="c-var">$attribute</span>->select_values[<span class="c-var">$searchKey</span>]->id;
        <span class="c-comment">// "Участник" → 3 (ID в MegaRega)</span>
    }
}</code></pre>
    </div>
  </div>

  <!-- SERVICE -->
  <div id="service" class="section">
    <div class="section-title">MegaRegaService.php</div>
    <div class="file-path"><i data-lucide="file-code"></i> app/Services/MegaRegaService.php</div>
    <div class="subsection">
      <div class="subsection-title"><i data-lucide="layers"></i> Оркестратор — координирует всё</div>
      <pre><code><span class="c-key">public function</span> <span class="c-fn">sendRegisterForm</span>(SiteUser <span class="c-var">$user</span>)
{
    <span class="c-comment">// 1. UUID формы из конфига (local/production)</span>
    <span class="c-var">$uuid</span> = <span class="c-var">$this</span>->getConfigData(<span class="c-str">'register_form_id'</span>);

    <span class="c-comment">// 2. Получить поля формы (что MegaRega ожидает)</span>
    <span class="c-var">$field_groups</span> = <span class="c-var">$this</span>->api->getFieldGroups(<span class="c-var">$uuid</span>) ?: [];

    <span class="c-comment">// 3. Построить форму с данными пользователя</span>
    <span class="c-var">$register_form</span> = <span class="c-key">new</span> RegisterForm(<span class="c-var">$user</span>);
    <span class="c-var">$register_form</span>->setAdditionalFields(<span class="c-var">$field_groups</span>);

    <span class="c-comment">// 4. Отправить в MegaRega</span>
    <span class="c-var">$response_data</span> = <span class="c-var">$this</span>->api->fillForm(<span class="c-var">$uuid</span>, <span class="c-var">$register_form</span>->getFormData());

    <span class="c-comment">// 5. Сохранить UUID участника от MegaRega</span>
    <span class="c-key">if</span> (!empty(<span class="c-var">$response_data</span>)) {
        <span class="c-var">$user</span>->query()
            ->where(<span class="c-str">'id'</span>, <span class="c-var">$user</span>->id)
            ->update([<span class="c-str">'uuid'</span> => <span class="c-var">$response_data</span>->uuid]);
        <span class="c-comment">// site_users.uuid теперь = ID этого участника в MegaRega</span>
    }
}</code></pre>
    </div>
  </div>

  <!-- FIELDS -->
  <div id="fields" class="section">
    <div class="section-title">Маппинг полей</div>
    <div class="subsection">
      <div class="subsection-title"><i data-lucide="arrow-right-left"></i> SiteUser → MegaRega</div>
      <table class="data-table">
        <thead><tr><th>Поле MegaRega</th><th>Источник в SiteUser</th><th>Примечание</th></tr></thead>
        <tbody>
          <tr><td><code>first_name</code></td><td><code>$user->name</code></td><td>Имя</td></tr>
          <tr><td><code>last_name</code></td><td><code>$user->surname</code></td><td>Фамилия</td></tr>
          <tr><td><code>patronymic</code></td><td><code>$user->patronymic</code></td><td>Отчество (если есть)</td></tr>
          <tr><td><code>full_name</code></td><td>name + " " + surname [+ " " + patronymic]</td><td>Собирается в getFullName()</td></tr>
          <tr><td><code>emails</code></td><td><code>[$user->email]</code></td><td>Массив (может быть несколько)</td></tr>
          <tr><td><code>phones</code></td><td><code>[$user->phone]</code></td><td>Массив</td></tr>
          <tr><td><code>category</code></td><td>type == 'media' ? 'СМИ' : 'Участник'</td><td>Дополнительное поле</td></tr>
          <tr><td><code>org_name</code></td><td><code>$user->getLegalInfo('org')</code></td><td>Организация</td></tr>
          <tr><td><code>org_position</code></td><td><code>$user->getLegalInfo('position')</code></td><td>Должность</td></tr>
          <tr><td><code>org_website</code></td><td><code>$user->getLegalInfo('website')</code></td><td>Сайт организации</td></tr>
          <tr><td><code>how_find_out</code></td><td><code>$user->getLegalInfo('hear')</code></td><td>Как узнал о мероприятии</td></tr>
          <tr><td><code>agreement</code></td><td><code>true</code></td><td>Всегда true (дал согласие при регистрации)</td></tr>
        </tbody>
      </table>
      <div class="info-box purple">
        <strong>getLegalInfo($key)</strong> — метод модели SiteUser. Видимо читает дополнительные данные пользователя (JSON поле или отдельная таблица). Нужно уточнить у разработчика где хранится org/position/website/hear.
      </div>
    </div>
    <div class="subsection">
      <div class="subsection-title"><i data-lucide="database"></i> Что сохраняется назад</div>
      <p class="text">После успешной отправки MegaRega возвращает UUID участника в их системе. Он сохраняется в <code>site_users.uuid</code>:</p>
      <pre><code><span class="c-comment">// До регистрации:</span>
site_users.uuid = null

<span class="c-comment">// После успешной отправки в MegaRega:</span>
site_users.uuid = "megarega-participant-uuid-here"

<span class="c-comment">// Зачем: можно ссылаться на участника в MegaRega по этому UUID</span>
<span class="c-comment">// Например, для обновления данных или проверки статуса</span></code></pre>
    </div>
  </div>

  <!-- QUESTIONS -->
  <div id="questions" class="section">
    <div class="section-title">Вопросы разработчику</div>
    <p class="text">Вопросы для разговора с разработчиками о MegaRega:</p>
    <div class="qa-item">
      <div class="qa-q" onclick="toggleQa(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span>MegaRega API требует аутентификацию? Где токен/ключ?</div>
      <div class="qa-a"><strong>Зачем спрашивать:</strong> В коде MegaRegaApi нет авторизационных заголовков. Либо IP-whitelist, либо забыли добавить токен. На production это важно проверить — иначе любой может слать данные.</div>
    </div>
    <div class="qa-item">
      <div class="qa-q" onclick="toggleQa(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span>Что такое getLegalInfo() и где хранятся org/position/website/hear?</div>
      <div class="qa-a"><strong>Зачем:</strong> RegisterForm берёт данные из $user->getLegalInfo('org') и т.д. Нужно понять — это JSON поле в site_users, отдельная таблица, или ещё что-то. Влияет на то, откуда эти данные берутся при регистрации.</div>
    </div>
    <div class="qa-item">
      <div class="qa-q" onclick="toggleQa(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span>Что делать если MegaRega вернула ошибку? Есть ли ретрай?</div>
      <div class="qa-a"><strong>Ответ:</strong> Сейчас ошибка просто пишется в Log::debug и игнорируется. Данные в MegaRega не попадают, но никто об этом не знает. Нужно спросить: есть ли мониторинг этих ошибок? Нужен ли ретрай через Queue?</div>
    </div>
    <div class="qa-item">
      <div class="qa-q" onclick="toggleQa(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span>UUID формы (register_form_id) — как получить новый если форма в MegaRega изменилась?</div>
      <div class="qa-a"><strong>Ответ:</strong> UUID формы берётся из config/megarega.php. Если организаторы создали новую форму в MegaRega — нужно обновить этот UUID в конфиге и задеплоить. Спроси: кто ответственен за обновление формы в MegaRega?</div>
    </div>
    <div class="qa-item">
      <div class="qa-q" onclick="toggleQa(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span>Listener синхронный или асинхронный (Queue)?</div>
      <div class="qa-a"><strong>Как проверить:</strong> Если SendRegisteredNotification implements ShouldQueue — асинхронный через Queue. Если нет — синхронный, и медленный MegaRega API задержит ответ пользователю на 15 секунд (таймаут Guzzle). Рекомендую перевести на Queue.</div>
    </div>
    <div class="info-box success" style="margin-top:20px">
      <strong>Как говорить с разработчиком:</strong> "Вижу что MegaRegaService вызывается в SendRegisteredNotification listener после UserRegisteredEvent. Правильно понимаю что при ошибке API данные просто теряются и нет ретрая? Как мониторим такие случаи?"
    </div>
  </div>
</div>
</div>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>
function showSection(id,el){
  document.querySelectorAll('.section').forEach(s=>s.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n=>n.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  el.classList.add('active');
}
function toggleQa(el){el.nextElementSibling.classList.toggle('open');}
lucide.createIcons();
</script>
</body>
</html>

@endverbatim