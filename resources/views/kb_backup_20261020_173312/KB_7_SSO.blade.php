@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SSO / OAuth 2.0 + OIDC — am.eabr.org</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
  --bg:           #F5F8FA;
  --surface:      #FFFFFF;
  --border:       #E4E6EF;
  --text:         #181C32;
  --text2:        #7E8299;
  --text3:        #A1A5B7;
  --primary:      #404357;
  --primary-light:#EFF2F5;
  --purple:       #7239EA;
  --purple-light: #F8F5FF;
  --success:      #50CD89;
  --success-light:#E8FFF3;
  --success-dark: #0D7D53;
  --warning:      #FFC700;
  --warning-light:#FFF8DD;
  --warning-dark: #B45309;
  --danger:       #F1416C;
  --danger-light: #FFF5F8;
  --teal:         #20C9D5;
  --teal-light:   #EAFCFD;
  --orange:       #E65100;
  --orange-light: #FFF3E0;
  --shadow:       0 2px 10px rgba(24,28,50,0.07);
  --radius:       10px;
  --code-bg:      #1E1E2D;
  --code-border:  #2D3347;
}
* { margin:0; padding:0; box-sizing:border-box; }
body {
  background: var(--bg);
  color: var(--text);
  font-family: 'Inter', -apple-system, sans-serif;
  font-size: 14px;
  line-height: 1.6;
  -webkit-font-smoothing: antialiased;
}
.container {
  width: 100%;
  display: grid;
  grid-template-columns: 260px 1fr;
  min-height: 100vh;
}
/* ── Sidebar ── */
.sidebar {
  background: var(--surface);
  padding: 24px 14px;
  position: fixed;
  width: 260px;
  height: 100vh;
  overflow-y: auto;
  border-right: 1px solid var(--border);
  box-shadow: 2px 0 8px rgba(24,28,50,0.04);
}
.sidebar-back {
  display: flex;
  align-items: center;
  gap: 7px;
  padding: 8px 10px;
  margin-bottom: 14px;
  color: var(--primary);
  text-decoration: none;
  border-radius: 7px;
  font-size: 12px;
  font-weight: 600;
  transition: background 0.2s;
}
.sidebar-back:hover { background: var(--primary-light); }
.sidebar-back svg { width: 14px; height: 14px; }
.sidebar-title {
  font-size: 11px;
  font-weight: 800;
  color: var(--text3);
  text-transform: uppercase;
  letter-spacing: 1.2px;
  margin-bottom: 10px;
  padding-bottom: 12px;
  border-bottom: 1px solid var(--border);
}
.nav-group-label {
  font-size: 10px;
  font-weight: 700;
  color: var(--text3);
  text-transform: uppercase;
  letter-spacing: 0.8px;
  padding: 10px 12px 4px;
}
.nav-item {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 8px 12px;
  margin-bottom: 2px;
  color: var(--text2);
  text-decoration: none;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.18s;
  font-size: 13px;
  font-weight: 500;
  border: 1px solid transparent;
}
.nav-item svg { width: 14px; height: 14px; flex-shrink: 0; }
.nav-item:hover { background: var(--bg); color: var(--primary); border-color: var(--border); }
.nav-item.active { background: var(--primary-light); color: var(--primary); font-weight: 600; border-color: rgba(64,67,87,0.25); }
/* ── Main ── */
.main {
  margin-left: 260px;
  padding: 40px 48px;
  min-width: 0;
  width: calc(100vw - 260px);
}
.page-header {
  margin-bottom: 32px;
  padding-bottom: 24px;
  border-bottom: 1px solid var(--border);
}
.page-header h1 { font-size: 26px; font-weight: 800; margin-bottom: 8px; color: var(--text); letter-spacing: -0.3px; }
.page-header p { color: var(--text2); font-size: 14px; }
.badge-row { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 12px; }
.badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 600;
}
.badge-blue, .badge-purple, .badge-success, .badge-warning, .badge-teal {
  background: #EFF2F5;
  color: #5E6278;
}

.section { display: none; animation: fadeIn 0.25s ease; }
.section.active { display: block; }
@keyframes fadeIn { from { opacity:0; transform:translateY(4px); } to { opacity:1; transform:none; } }

.section-title {
  font-size: 20px;
  font-weight: 700;
  margin-bottom: 24px;
  color: var(--text);
  padding-bottom: 14px;
  border-bottom: 2px solid var(--border);
  display: flex;
  align-items: center;
  gap: 10px;
}
.section-title::before {
  content: '';
  width: 4px; height: 22px;
  background: var(--primary);
  border-radius: 2px;
  flex-shrink: 0;
}
.subsection { margin-bottom: 36px; }
.subsection-title {
  font-size: 15px;
  font-weight: 700;
  color: var(--text);
  margin-bottom: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.subsection-title svg { width: 16px; height: 16px; }

p.text { color: var(--text2); line-height: 1.8; margin-bottom: 12px; font-size: 14px; }
p.text strong { color: var(--text); font-weight: 600; }

/* Info boxes */
.info-box {
  border-radius: var(--radius);
  padding: 14px 16px;
  margin-bottom: 16px;
  border-left: 4px solid;
  font-size: 13px;
  line-height: 1.7;
}
.info-box.blue, .info-box.purple, .info-box.success { background: var(--primary-light); border-color: var(--primary); color: #404357; }
.info-box.warning { background: #FFF8E1; border-color: #E0A000; color: #7B5000; }
.info-box.danger { background: #FFF3F5; border-color: #D0404E; color: #7B1C2A; }
.info-box strong { font-weight: 700; }

/* Cards */
.card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 20px;
  margin-bottom: 16px;
  box-shadow: var(--shadow);
}
.card-title {
  font-size: 13px;
  font-weight: 700;
  color: var(--text);
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.card-title svg { width: 15px; height: 15px; }

/* Code */
pre {
  background: var(--code-bg);
  border: 1px solid var(--code-border);
  border-radius: var(--radius);
  padding: 20px;
  overflow-x: auto;
  margin-bottom: 16px;
  font-size: 12.5px;
  line-height: 1.7;
}
pre code { color: #ABB2BF; font-family: 'JetBrains Mono', 'Fira Code', Consolas, monospace; }
.c-comment { color: #5C6370; }
.c-key { color: #C678DD; }
.c-str { color: #98C379; }
.c-fn { color: #61AFEF; }
.c-var { color: #E5C07B; }
.c-num { color: #D19A66; }
.c-type { color: #E06C75; }

/* Flow diagram */
.flow-diagram {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 24px;
  margin-bottom: 20px;
  overflow-x: auto;
}
.flow-table {
  width: 100%;
  min-width: 700px;
  border-collapse: separate;
  border-spacing: 0;
}
.flow-actor {
  background: var(--primary);
  color: white;
  font-weight: 700;
  font-size: 12px;
  padding: 10px 16px;
  border-radius: 8px;
  text-align: center;
  white-space: nowrap;
}
.flow-step {
  padding: 10px 0;
  font-size: 13px;
  color: var(--text2);
  text-align: center;
}
.flow-arrow {
  display: flex;
  align-items: center;
  gap: 8px;
  background: var(--bg);
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 10px 14px;
  margin: 6px 0;
  font-size: 12.5px;
}
.flow-arrow .step-num {
  background: var(--primary);
  color: white;
  font-size: 10px;
  font-weight: 700;
  border-radius: 50%;
  width: 20px; height: 20px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.flow-arrow .step-dir {
  color: var(--primary);
  font-weight: 700;
  font-size: 16px;
  flex-shrink: 0;
}
.flow-arrow .step-label { color: var(--text); font-weight: 600; }
.flow-arrow .step-detail { color: var(--text2); font-size: 11.5px; margin-top: 1px; }

/* Table */
.data-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; font-size: 13px; }
.data-table th {
  background: var(--bg);
  padding: 10px 14px;
  text-align: left;
  font-weight: 700;
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: var(--text2);
  border-bottom: 1px solid var(--border);
}
.data-table td {
  padding: 10px 14px;
  border-bottom: 1px solid var(--border);
  color: var(--text2);
  vertical-align: top;
}
.data-table td strong { color: var(--text); font-weight: 600; }
.data-table td code {
  background: var(--bg);
  border: 1px solid var(--border);
  border-radius: 4px;
  padding: 1px 6px;
  font-size: 11.5px;
  font-family: monospace;
  color: var(--primary);
}
.data-table tr:last-child td { border-bottom: none; }

/* Q&A */
.qa-item {
  border: 1px solid var(--border);
  border-radius: var(--radius);
  margin-bottom: 10px;
  overflow: hidden;
}
.qa-q {
  padding: 14px 16px;
  font-weight: 600;
  font-size: 13.5px;
  cursor: pointer;
  display: flex;
  align-items: flex-start;
  gap: 10px;
  transition: background 0.15s;
}
.qa-q:hover { background: var(--bg); }
.qa-q .q-icon { color: var(--primary); flex-shrink: 0; margin-top: 2px; }
.qa-q .q-icon svg { width: 14px; height: 14px; }
.qa-a {
  padding: 0 16px 14px 40px;
  color: var(--text2);
  font-size: 13px;
  line-height: 1.75;
  display: none;
}
.qa-a.open { display: block; }
.qa-a code {
  background: var(--code-bg);
  color: #98C379;
  border-radius: 4px;
  padding: 1px 6px;
  font-size: 11.5px;
  font-family: monospace;
}

/* Token display */
.token-parts {
  display: flex;
  gap: 6px;
  flex-wrap: wrap;
  margin-bottom: 12px;
}
.token-part {
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 11px;
  font-family: monospace;
  font-weight: 600;
}
.token-part.header { background: #3D4152; color: white; }
.token-part.payload { background: var(--primary); color: white; }
.token-part.signature { background: #7E8299; color: white; }

/* File path */
.file-path {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: var(--code-bg);
  color: #E5C07B;
  border-radius: 6px;
  padding: 4px 10px;
  font-size: 11.5px;
  font-family: monospace;
  margin-bottom: 14px;
}
.file-path svg { width: 12px; height: 12px; color: #5C6370; }

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

<!-- ── SIDEBAR ── -->
<div class="sidebar">
  <a href="/" class="sidebar-back">
    <i data-lucide="arrow-left"></i> На главную
  </a>
  <div class="sidebar-title">SSO / OAuth 2.0</div>

  <div class="nav-group-label">Теория</div>
  <a class="nav-item active" onclick="showSection('overview',this)">
    <i data-lucide="info"></i> Что такое SSO
  </a>
  <a class="nav-item" onclick="showSection('flow',this)">
    <i data-lucide="git-branch"></i> Flow авторизации
  </a>

  <div class="nav-group-label">Конфиг и маршруты</div>
  <a class="nav-item" onclick="showSection('endpoints',this)">
    <i data-lucide="route"></i> Эндпоинты (routes/oauth.php)
  </a>
  <a class="nav-item" onclick="showSection('config',this)">
    <i data-lucide="settings"></i> Конфиг (config/oauth.php)
  </a>

  <div class="nav-group-label">Контроллеры</div>
  <a class="nav-item" onclick="showSection('auth-controller',this)">
    <i data-lucide="log-in"></i> AuthorizationController
  </a>
  <a class="nav-item" onclick="showSection('token-controller',this)">
    <i data-lucide="key"></i> TokenController
  </a>
  <a class="nav-item" onclick="showSection('other-controllers',this)">
    <i data-lucide="layers"></i> UserInfo / JWKS / Revoke / Logout
  </a>
  <a class="nav-item" onclick="showSection('provision',this)">
    <i data-lucide="user-plus"></i> UserProvisionController
  </a>

  <div class="nav-group-label">Сервисы</div>
  <a class="nav-item" onclick="showSection('jwt-service',this)">
    <i data-lucide="file-key"></i> JwtService
  </a>
  <a class="nav-item" onclick="showSection('token-service',this)">
    <i data-lucide="refresh-cw"></i> TokenService
  </a>
  <a class="nav-item" onclick="showSection('pkce',this)">
    <i data-lucide="shield-check"></i> PkceService
  </a>

  <div class="nav-group-label">Структура</div>
  <a class="nav-item" onclick="showSection('database',this)">
    <i data-lucide="database"></i> Таблицы БД
  </a>
  <a class="nav-item" onclick="showSection('app-integration',this)">
    <i data-lucide="smartphone"></i> Взаимодействие с приложением
  </a>
  <a class="nav-item" onclick="showSection('todo',this)">
    <i data-lucide="list-checks"></i> Что нужно доделать
  </a>
  <a class="nav-item" onclick="showSection('questions',this)">
    <i data-lucide="message-circle"></i> Вопросы разработчику
  </a>
</div>

<!-- ── MAIN ── -->
<div class="main">
  <div class="page-header">
    <h1>SSO — Single Sign-On</h1>
    <p>OAuth 2.0 + OpenID Connect | Кастомная реализация для мобильного приложения ЕАБР</p>
    <div class="badge-row">
      <span class="badge badge-blue"><i data-lucide="shield" style="width:10px;height:10px"></i> OAuth 2.0</span>
      <span class="badge badge-purple">OpenID Connect</span>
      <span class="badge badge-success">PKCE S256</span>
      <span class="badge badge-warning">JWT RS256</span>
      <span class="badge badge-teal">Authorization Code Flow</span>
    </div>
  </div>

  <!-- ── SECTION: OVERVIEW ── -->
  <div id="overview" class="section active">
    <div class="section-title">Что такое SSO в этом проекте</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="lightbulb"></i> Простыми словами</div>
      <p class="text"><strong>SSO (Single Sign-On)</strong> — единый вход. Пользователь вводит логин/пароль один раз на сайте <code>am.eabr.org</code>, и мобильное приложение ЕАБР автоматически получает доступ к его данным. Как "Войти через Google" — только здесь <strong>наш сайт является провайдером авторизации</strong>.</p>

      <div class="info-box blue">
        <strong>Аналогия:</strong> Сайт am.eabr.org — это как Google. Мобильное приложение — это как сторонний сервис, который говорит "Войдите через am.eabr.org". Пользователь вводит данные на сайте, сайт даёт приложению разрешение.
      </div>

      <p class="text"><strong>Протокол:</strong> OAuth 2.0 + OpenID Connect (OIDC). OAuth даёт <em>доступ</em> к ресурсам, OIDC добавляет <em>идентификацию</em> пользователя (кто он такой).</p>
      <p class="text"><strong>Flow:</strong> Authorization Code + PKCE — стандарт для мобильных приложений. PKCE защищает от перехвата кода авторизации.</p>
      <p class="text"><strong>Реализация:</strong> Кастомная — без Passport, без Sanctum. Всё написано с нуля в <code>app/Http/Controllers/OAuth/</code> и <code>app/Services/OAuth/</code>.</p>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="layers"></i> Архитектура</div>

      <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:16px">
        <div class="card">
          <div class="card-title"><i data-lucide="smartphone"></i> Мобильное приложение</div>
          <p style="color:var(--text2);font-size:12.5px;line-height:1.7">Публичный клиент (без секрета). Открывает WebView с формой логина сайта. После входа получает токены.</p>
        </div>
        <div class="card">
          <div class="card-title" style="color:var(--primary)"><i data-lucide="server"></i> am.eabr.org (Сервер)</div>
          <p style="color:var(--text2);font-size:12.5px;line-height:1.7">Authorization Server + Resource Server. Аутентифицирует пользователя, выдаёт токены, возвращает данные.</p>
        </div>
        <div class="card">
          <div class="card-title"><i data-lucide="user"></i> Пользователь (SiteUser)</div>
          <p style="color:var(--text2);font-size:12.5px;line-height:1.7">Зарегистрирован на сайте. Входит в форму логина. Данные берутся из таблицы <code>site_users</code>.</p>
        </div>
      </div>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="package"></i> Три вида токенов</div>
      <table class="data-table">
        <thead><tr><th>Токен</th><th>Назначение</th><th>Время жизни</th><th>Хранение в БД</th></tr></thead>
        <tbody>
          <tr><td><strong>access_token</strong></td><td>Доступ к API (GET /oidc/userinfo)</td><td>60 минут</td><td>SHA-256 хеш</td></tr>
          <tr><td><strong>refresh_token</strong></td><td>Получение нового access_token</td><td>30 дней</td><td>SHA-256 хеш</td></tr>
          <tr><td><strong>id_token</strong></td><td>Идентификация пользователя (JWT)</td><td>1 час</td><td>Не хранится</td></tr>
        </tbody>
      </table>

      <div class="info-box success">
        <strong>Почему хеш в БД?</strong> access_token и refresh_token хранятся как <code>hash('sha256', $token)</code>. Даже если злоумышленник получит доступ к БД — токены бесполезны. Клиенту отдаётся оригинал, в БД — хеш.
      </div>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="file-tree"></i> Структура файлов</div>
      <pre><code><span class="c-comment">// Controllers</span>
app/Http/Controllers/OAuth/
  ├── AuthorizationController.php   <span class="c-comment">// Форма входа + генерация code</span>
  ├── TokenController.php           <span class="c-comment">// Обмен code → токены, refresh</span>
  ├── UserInfoController.php        <span class="c-comment">// GET /oidc/userinfo</span>
  ├── DiscoveryController.php       <span class="c-comment">// OIDC метаданные</span>
  ├── JwksController.php            <span class="c-comment">// Публичные ключи RSA</span>
  ├── RevokeController.php          <span class="c-comment">// Отзыв токенов</span>
  ├── LogoutController.php          <span class="c-comment">// Завершение сессии</span>
  └── UserProvisionController.php   <span class="c-comment">// Создание профиля</span>

<span class="c-comment">// Services</span>
app/Services/OAuth/
  ├── JwtService.php                <span class="c-comment">// Генерация/верификация JWT</span>
  ├── TokenService.php              <span class="c-comment">// Управление токенами</span>
  └── PkceService.php               <span class="c-comment">// PKCE верификация</span>

<span class="c-comment">// Models</span>
app/Models/OAuth/
  ├── OAuthClient.php               <span class="c-comment">// Зарегистрированные клиенты</span>
  ├── OAuthAuthCode.php             <span class="c-comment">// Временные коды авторизации</span>
  ├── OAuthAccessToken.php          <span class="c-comment">// Access токены</span>
  └── OAuthRefreshToken.php         <span class="c-comment">// Refresh токены</span>

<span class="c-comment">// Routes + Config</span>
routes/oauth.php
config/oauth.php</code></pre>
    </div>
  </div>

  <!-- ── SECTION: FLOW ── -->
  <div id="flow" class="section">
    <div class="section-title">Flow авторизации — шаг за шагом</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="git-branch"></i> Authorization Code + PKCE Flow</div>
      <p class="text">Полный цикл от открытия приложения до получения данных пользователя:</p>

      <div class="flow-diagram">
        <div class="flow-arrow"><span class="step-num">1</span><span class="step-dir">→</span><div><div class="step-label">Мобильное приложение открывает WebView</div><div class="step-detail">GET /oauth2/authorize?client_id=APP&redirect_uri=myapp://callback&response_type=code&code_challenge=BASE64URL(SHA256(verifier))&code_challenge_method=S256&state=random</div></div></div>
        <div class="flow-arrow"><span class="step-num">2</span><span class="step-dir">→</span><div><div class="step-label">Сервер проверяет параметры и редиректит на форму входа</div><div class="step-detail">AuthorizationController::handleAuthorize() — проверяет client_id, redirect_uri, PKCE. Сохраняет в сессии. Редирект на /oauth/login</div></div></div>
        <div class="flow-arrow"><span class="step-num">3</span><span class="step-dir">→</span><div><div class="step-label">Пользователь вводит логин и пароль</div><div class="step-detail">Форма входа: view('oauth.login'). Показывает имя клиента и запрошенные права.</div></div></div>
        <div class="flow-arrow"><span class="step-num">4</span><span class="step-dir">→</span><div><div class="step-label">POST /oauth/login — сервер аутентифицирует пользователя</div><div class="step-detail">AuthorizationController::login() — ищет в AuthCredentials, проверяет Hash::check(password), вызывает Auth::guard('site')->login($user)</div></div></div>
        <div class="flow-arrow"><span class="step-num">5</span><span class="step-dir">←</span><div><div class="step-label">Сервер редиректит в приложение с кодом</div><div class="step-detail">myapp://callback?code=RANDOM_64_CHARS&state=random — Authorization Code, живёт 10 минут</div></div></div>
        <div class="flow-arrow"><span class="step-num">6</span><span class="step-dir">→</span><div><div class="step-label">POST /oauth2/token — обмен code на токены</div><div class="step-detail">grant_type=authorization_code&code=CODE&code_verifier=VERIFIER&client_id=APP&redirect_uri=myapp://callback</div></div></div>
        <div class="flow-arrow"><span class="step-num">7</span><span class="step-dir">→</span><div><div class="step-label">Сервер проверяет PKCE и выдаёт токены</div><div class="step-detail">SHA256(code_verifier) == code_challenge? ✓ Создаёт access_token (60 мин), refresh_token (30 дней), id_token (JWT)</div></div></div>
        <div class="flow-arrow"><span class="step-num">8</span><span class="step-dir">←</span><div><div class="step-label">Ответ с токенами</div><div class="step-detail">{"access_token":"...","token_type":"Bearer","expires_in":3600,"refresh_token":"...","id_token":"JWT..."}</div></div></div>
        <div class="flow-arrow"><span class="step-num">9</span><span class="step-dir">→</span><div><div class="step-label">GET /oidc/userinfo — получение данных пользователя</div><div class="step-detail">Authorization: Bearer ACCESS_TOKEN</div></div></div>
        <div class="flow-arrow"><span class="step-num">10</span><span class="step-dir">←</span><div><div class="step-label">Данные пользователя</div><div class="step-detail">{"sub":"ext-id","email":"user@mail.ru","first_name":"Иван",...}</div></div></div>
      </div>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="refresh-cw"></i> Обновление токена (Refresh)</div>
      <div class="flow-diagram">
        <div class="flow-arrow"><span class="step-num">1</span><span class="step-dir">→</span><div><div class="step-label">Access token истёк — приложение шлёт refresh</div><div class="step-detail">POST /oauth2/token — grant_type=refresh_token&refresh_token=TOKEN&client_id=APP</div></div></div>
        <div class="flow-arrow"><span class="step-num">2</span><span class="step-dir">→</span><div><div class="step-label">Сервер отзывает старые токены и создаёт новые</div><div class="step-detail">Ротация: старый refresh_token становится недействительным. Создаются новые пара access+refresh</div></div></div>
        <div class="flow-arrow"><span class="step-num">3</span><span class="step-dir">←</span><div><div class="step-label">Новые токены</div><div class="step-detail">{"access_token":"NEW...","refresh_token":"NEW..."} — старые уже не работают!</div></div></div>
      </div>
      <div class="info-box warning">
        <strong>Важно — ротация токенов!</strong> При каждом refresh создаётся <em>новая пара</em> токенов, а старые отзываются. Если refresh_token украли и использовали до приложения — приложение получит ошибку и пользователь должен заново войти.
      </div>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="shield-check"></i> Что такое PKCE и зачем</div>
      <p class="text"><strong>PKCE (Proof Key for Code Exchange)</strong> — защита от перехвата authorization code. Без PKCE злоумышленник мог перехватить code и обменять его на токены вместо приложения.</p>
      <pre><code><span class="c-comment">// Мобильное приложение генерирует:</span>
<span class="c-var">code_verifier</span> = random_bytes(64)  <span class="c-comment">// секретная строка, 43-128 символов</span>
<span class="c-var">code_challenge</span> = BASE64URL(<span class="c-fn">SHA256</span>(code_verifier))  <span class="c-comment">// хеш verifier</span>

<span class="c-comment">// Шаг 1: отправляем только code_challenge (хеш)</span>
<span class="c-comment">// Перехватчик видит challenge, но не может получить verifier</span>

<span class="c-comment">// Шаг 6: отправляем code_verifier</span>
<span class="c-comment">// Сервер проверяет: SHA256(verifier) == challenge? ✓</span>
<span class="c-comment">// Перехватчик не знает verifier → не может получить токены</span></code></pre>
    </div>
  </div>

  <!-- ── SECTION: ENDPOINTS ── -->
  <div id="endpoints" class="section">
    <div class="section-title">Эндпоинты (routes/oauth.php)</div>
    <div class="file-path"><i data-lucide="file-code"></i> routes/oauth.php</div>

    <table class="data-table">
      <thead><tr><th>Метод</th><th>URL</th><th>Контроллер</th><th>Назначение</th></tr></thead>
      <tbody>
        <tr><td><code>GET</code></td><td><code>/.well-known/openid-configuration</code></td><td>DiscoveryController</td><td>OIDC метаданные — все эндпоинты, поддерживаемые scopes, алгоритмы</td></tr>
        <tr><td><code>GET</code></td><td><code>/oauth2/authorize</code></td><td>AuthorizationController</td><td>Начало авторизации — проверка клиента, редирект на логин</td></tr>
        <tr><td><code>GET</code></td><td><code>/oauth/login</code></td><td>AuthorizationController</td><td>Форма входа (HTML страница)</td></tr>
        <tr><td><code>POST</code></td><td><code>/oauth/login</code></td><td>AuthorizationController</td><td>Обработка логина — аутентификация + редирект с code</td></tr>
        <tr><td><code>POST</code></td><td><code>/oauth2/token</code></td><td>TokenController</td><td>Обмен code на токены / обновление через refresh</td></tr>
        <tr><td><code>POST</code></td><td><code>/oauth2/revoke</code></td><td>RevokeController</td><td>Отзыв access или refresh токена</td></tr>
        <tr><td><code>GET</code></td><td><code>/oidc/userinfo</code></td><td>UserInfoController</td><td>Данные авторизованного пользователя (нужен Bearer token)</td></tr>
        <tr><td><code>GET</code></td><td><code>/oidc/jwks</code></td><td>JwksController</td><td>Публичные RSA ключи для верификации JWT</td></tr>
        <tr><td><code>GET/POST</code></td><td><code>/oidc/logout</code></td><td>LogoutController</td><td>Завершение сессии</td></tr>
        <tr><td><code>POST</code></td><td><code>/api/v1/users/provision</code></td><td>UserProvisionController</td><td>Создание/обновление профиля (сервисный токен)</td></tr>
      </tbody>
    </table>

    <div class="info-box blue">
      <strong>Разница OAuth2 и OIDC эндпоинтов:</strong> Всё под <code>/oauth2/</code> — это OAuth 2.0 (авторизация). Всё под <code>/oidc/</code> — это OIDC расширение (идентификация пользователя). <code>/.well-known/</code> — стандартный путь для метаданных.
    </div>
  </div>

  <!-- ── SECTION: CONFIG ── -->
  <div id="config" class="section">
    <div class="section-title">Конфигурация (config/oauth.php)</div>
    <div class="file-path"><i data-lucide="file-code"></i> config/oauth.php</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="clock"></i> Время жизни токенов</div>
      <table class="data-table">
        <thead><tr><th>Настройка</th><th>.env переменная</th><th>По умолчанию</th><th>Где используется</th></tr></thead>
        <tbody>
          <tr><td><code>tokens.access_token_ttl</code></td><td><code>OAUTH_ACCESS_TOKEN_TTL</code></td><td><strong>60 минут</strong></td><td>TokenService::createAccessToken()</td></tr>
          <tr><td><code>tokens.refresh_token_ttl</code></td><td><code>OAUTH_REFRESH_TOKEN_TTL</code></td><td><strong>30 дней</strong></td><td>TokenService::createRefreshToken()</td></tr>
          <tr><td><code>tokens.auth_code_ttl</code></td><td><code>OAUTH_AUTH_CODE_TTL</code></td><td><strong>10 минут</strong></td><td>TokenService::createAuthCode()</td></tr>
          <tr><td><code>id_token.ttl</code></td><td><code>OAUTH_ID_TOKEN_TTL</code></td><td><strong>3600 сек</strong></td><td>JwtService::generateIdToken()</td></tr>
        </tbody>
      </table>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="key"></i> RSA ключи</div>
      <pre><code><span class="c-key">'keys'</span> => [
    <span class="c-str">'private'</span> => <span class="c-fn">storage_path</span>(<span class="c-str">'oauth-private.key'</span>),  <span class="c-comment">// Подпись токенов</span>
    <span class="c-str">'public'</span>  => <span class="c-fn">storage_path</span>(<span class="c-str">'oauth-public.key'</span>),   <span class="c-comment">// Верификация токенов</span>
],</code></pre>
      <div class="info-box warning">
        <strong>На проде нужно:</strong> Генерация ключей: <code>php artisan oauth:keys</code> (команда OAuthKeysGenerateCommand). Приватный ключ — chmod 600 (только owner). Публичный — chmod 644 (все могут читать для верификации).
      </div>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="list"></i> Scopes (права доступа)</div>
      <table class="data-table">
        <thead><tr><th>Scope</th><th>Описание</th></tr></thead>
        <tbody>
          <tr><td><code>openid</code></td><td>Базовый OIDC scope — обязателен, включает id_token</td></tr>
          <tr><td><code>profile</code></td><td>Доступ к имени/фамилии пользователя</td></tr>
          <tr><td><code>email</code></td><td>Доступ к email</td></tr>
          <tr><td><code>phone</code></td><td>Доступ к номеру телефона</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ── SECTION: AUTH CONTROLLER ── -->
  <div id="auth-controller" class="section">
    <div class="section-title">AuthorizationController</div>
    <div class="file-path"><i data-lucide="file-code"></i> app/Http/Controllers/OAuth/AuthorizationController.php</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="function-square"></i> handleAuthorize() — GET /oauth2/authorize</div>
      <p class="text">Первый запрос от мобильного приложения. Метод выполняет 5 проверок и сохраняет состояние авторизации в сессии.</p>
      <pre><code><span class="c-comment">// 1. Валидация обязательных параметров</span>
<span class="c-var">$validator</span> = Validator::make(<span class="c-var">$request</span>->all(), [
    <span class="c-str">'client_id'</span>              => <span class="c-str">'required|string'</span>,
    <span class="c-str">'redirect_uri'</span>           => <span class="c-str">'required|url'</span>,
    <span class="c-str">'response_type'</span>          => <span class="c-str">'required|in:code'</span>,    <span class="c-comment">// только code</span>
    <span class="c-str">'code_challenge'</span>         => <span class="c-str">'required|string'</span>,        <span class="c-comment">// PKCE обязателен</span>
    <span class="c-str">'code_challenge_method'</span>  => <span class="c-str">'required|in:S256'</span>,      <span class="c-comment">// только SHA-256</span>
]);

<span class="c-comment">// 2. Поиск клиента в БД</span>
<span class="c-var">$client</span> = OAuthClient::findByClientId(<span class="c-var">$request</span>->input(<span class="c-str">'client_id'</span>));
<span class="c-comment">// Проверяет: is_active = true</span>

<span class="c-comment">// 3. Проверка redirect_uri (должен быть в списке разрешённых)</span>
<span class="c-var">$client</span>->isValidRedirectUri(<span class="c-var">$request</span>->input(<span class="c-str">'redirect_uri'</span>));

<span class="c-comment">// 4. Проверка PKCE (формат base64url, длина 43-128)</span>
<span class="c-var">$this</span>->pkceService->isValidChallenge(<span class="c-var">$request</span>->input(<span class="c-str">'code_challenge'</span>));

<span class="c-comment">// 5. Сохранение запроса в сессии (понадобится после логина)</span>
<span class="c-fn">session</span>([<span class="c-str">'oauth_authorize'</span> => [
    <span class="c-str">'client_id'</span>            => <span class="c-var">$client</span>->id,
    <span class="c-str">'code_challenge'</span>       => <span class="c-var">$request</span>->input(<span class="c-str">'code_challenge'</span>),
    <span class="c-str">'redirect_uri'</span>         => <span class="c-var">$request</span>->input(<span class="c-str">'redirect_uri'</span>),
    <span class="c-str">'nonce'</span>                => <span class="c-var">$request</span>->input(<span class="c-str">'nonce'</span>),  <span class="c-comment">// для защиты от replay</span>
    <span class="c-str">'state'</span>                => <span class="c-var">$request</span>->input(<span class="c-str">'state'</span>),  <span class="c-comment">// CSRF защита</span>
    ...
]]);

<span class="c-comment">// Если уже авторизован — сразу выдать code</span>
<span class="c-key">if</span> (Auth::guard(<span class="c-str">'site'</span>)->check()) {
    <span class="c-key">return</span> <span class="c-var">$this</span>->approveAuthorization(<span class="c-var">$request</span>);
}

<span class="c-comment">// Иначе — на форму логина</span>
<span class="c-key">return</span> <span class="c-fn">redirect</span>()->route(<span class="c-str">'oauth.login'</span>);</code></pre>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="function-square"></i> login() — POST /oauth/login</div>
      <p class="text">Обрабатывает форму входа. Важно: пользователи ищутся через таблицу <code>auth_credentials</code>, не напрямую через <code>site_users</code>.</p>
      <pre><code><span class="c-comment">// Поиск по AuthCredentials (email/login)</span>
<span class="c-var">$authCredential</span> = AuthCredentials::query()
    ->where(<span class="c-str">'credential'</span>, <span class="c-var">$credentials</span>[<span class="c-str">'login'</span>])
    ->first();

<span class="c-comment">// Проверка пароля</span>
Hash::check(<span class="c-var">$credentials</span>[<span class="c-str">'password'</span>], <span class="c-var">$authCredential</span>->validation)

<span class="c-comment">// Получение пользователя через relation</span>
<span class="c-var">$user</span> = <span class="c-var">$authCredential</span>->user;  <span class="c-comment">// SiteUser модель</span>

<span class="c-comment">// Вход через guard 'site' (не 'web'!)</span>
Auth::guard(<span class="c-str">'site'</span>)->login(<span class="c-var">$user</span>);</code></pre>
      <div class="info-box purple">
        <strong>Guard 'site':</strong> В проекте используется кастомный guard <code>'site'</code>, не стандартный <code>'web'</code>. Настроен в <code>config/auth.php</code>. Работает с моделью <code>SiteUser</code> из таблицы <code>site_users</code>.
      </div>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="function-square"></i> approveAuthorization() — создание code</div>
      <pre><code><span class="c-comment">// Читаем сохранённый запрос из сессии</span>
<span class="c-var">$authRequest</span> = <span class="c-fn">session</span>(<span class="c-str">'oauth_authorize'</span>);

<span class="c-comment">// Генерация authorization code (64 случайных символа, 10 минут)</span>
<span class="c-var">$authCode</span> = <span class="c-var">$this</span>->tokenService->createAuthCode(
    <span class="c-var">$user</span>, <span class="c-var">$client</span>, <span class="c-var">$authRequest</span>[<span class="c-str">'redirect_uri'</span>],
    <span class="c-var">$authRequest</span>[<span class="c-str">'scope'</span>], <span class="c-var">$authRequest</span>[<span class="c-str">'code_challenge'</span>], ...
);

<span class="c-comment">// Очистка сессии (одноразовый запрос)</span>
<span class="c-fn">session</span>()->forget(<span class="c-str">'oauth_authorize'</span>);

<span class="c-comment">// Редирект в приложение с кодом</span>
<span class="c-key">return</span> <span class="c-fn">redirect</span>(<span class="c-str">"myapp://callback?code="</span> . <span class="c-var">$authCode</span>->code . <span class="c-str">"&state=..."</span>);</code></pre>
    </div>
  </div>

  <!-- ── SECTION: TOKEN CONTROLLER ── -->
  <div id="token-controller" class="section">
    <div class="section-title">TokenController</div>
    <div class="file-path"><i data-lucide="file-code"></i> app/Http/Controllers/OAuth/TokenController.php</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="function-square"></i> issueToken() — POST /oauth2/token</div>
      <p class="text">Единственный публичный метод. Роутит на нужный обработчик по <code>grant_type</code>:</p>
      <pre><code><span class="c-key">switch</span> (<span class="c-var">$grantType</span>) {
    <span class="c-key">case</span> <span class="c-str">'authorization_code'</span>: <span class="c-key">return</span> <span class="c-var">$this</span>->handleAuthorizationCode(<span class="c-var">$request</span>);
    <span class="c-key">case</span> <span class="c-str">'refresh_token'</span>:      <span class="c-key">return</span> <span class="c-var">$this</span>->handleRefreshToken(<span class="c-var">$request</span>);
    <span class="c-key">default</span>: <span class="c-key">return</span> <span class="c-fn">response</span>()->json([<span class="c-str">'error'</span> => <span class="c-str">'unsupported_grant_type'</span>], 400);
}</code></pre>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="function-square"></i> handleAuthorizationCode() — обмен code на токены</div>
      <pre><code><span class="c-comment">// 1. Валидация (code, redirect_uri, client_id, code_verifier)</span>
<span class="c-comment">// 2. Поиск клиента</span>
<span class="c-var">$client</span> = OAuthClient::findByClientId(<span class="c-var">$request</span>->input(<span class="c-str">'client_id'</span>));

<span class="c-comment">// 3. Поиск code (не истёк, не использован)</span>
<span class="c-var">$authCode</span> = OAuthAuthCode::findValidCode(<span class="c-var">$request</span>->input(<span class="c-str">'code'</span>));

<span class="c-comment">// 4. Проверки соответствия</span>
<span class="c-var">$authCode</span>->client_id !== <span class="c-var">$client</span>->id  <span class="c-comment">// client mismatch</span>
<span class="c-var">$authCode</span>->redirect_uri !== <span class="c-var">$request</span>->input(<span class="c-str">'redirect_uri'</span>)  <span class="c-comment">// URI mismatch</span>

<span class="c-comment">// 5. Обмен (проверка PKCE внутри)</span>
<span class="c-var">$tokens</span> = <span class="c-var">$this</span>->tokenService->exchangeAuthCode(
    <span class="c-var">$authCode</span>,
    <span class="c-var">$request</span>->input(<span class="c-str">'code_verifier'</span>)  <span class="c-comment">// сервер проверяет: SHA256(verifier) == challenge</span>
);

<span class="c-comment">// Ответ:</span>
<span class="c-comment">// { "access_token": "...", "token_type": "Bearer", "expires_in": 3600,</span>
<span class="c-comment">//   "refresh_token": "...", "id_token": "eyJ...", "scope": "openid profile" }</span></code></pre>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="function-square"></i> handleRefreshToken() — ротация токенов</div>
      <pre><code><span class="c-comment">// Параметры: grant_type=refresh_token, refresh_token=TOKEN, client_id=APP</span>

<span class="c-var">$refreshToken</span> = OAuthRefreshToken::findValidToken(<span class="c-var">$request</span>->input(<span class="c-str">'refresh_token'</span>));
<span class="c-comment">// Проверяет по SHA256 хешу, смотрит expires_at и revoked_at</span>

<span class="c-comment">// Проверка клиента</span>
<span class="c-var">$refreshToken</span>->accessToken->client_id !== <span class="c-var">$client</span>->id

<span class="c-comment">// Обновление (ротация!)</span>
<span class="c-var">$tokens</span> = <span class="c-var">$this</span>->tokenService->refreshAccessToken(<span class="c-var">$refreshToken</span>);
<span class="c-comment">// Внутри: старые токены отзываются, создаются новые</span></code></pre>
    </div>
  </div>

  <!-- ── SECTION: OTHER CONTROLLERS ── -->
  <div id="other-controllers" class="section">
    <div class="section-title">UserInfo / JWKS / Revoke / Logout</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="user"></i> UserInfoController — GET /oidc/userinfo</div>
      <div class="file-path"><i data-lucide="file-code"></i> app/Http/Controllers/OAuth/UserInfoController.php</div>
      <pre><code><span class="c-comment">// Извлечение Bearer токена из заголовка</span>
<span class="c-var">$authHeader</span> = <span class="c-var">$request</span>->header(<span class="c-str">'Authorization'</span>);  <span class="c-comment">// "Bearer abc123..."</span>
<span class="c-var">$token</span> = <span class="c-fn">substr</span>(<span class="c-var">$authHeader</span>, 7);  <span class="c-comment">// убираем "Bearer "</span>

<span class="c-comment">// Валидация токена + получение пользователя</span>
<span class="c-var">$user</span> = <span class="c-var">$this</span>->tokenService->validateAccessToken(<span class="c-var">$token</span>);
<span class="c-comment">// Ищет по SHA256(token) в oauth_access_tokens, проверяет expires_at и revoked_at</span>

<span class="c-comment">// Возврат OIDC claims</span>
<span class="c-key">return</span> response()->json(<span class="c-var">$user</span>->getOidcUserInfo());</code></pre>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="key-square"></i> JwksController — GET /oidc/jwks</div>
      <div class="file-path"><i data-lucide="file-code"></i> app/Http/Controllers/OAuth/JwksController.php</div>
      <p class="text">Возвращает публичные RSA ключи в формате JWK (JSON Web Key). Мобильное приложение использует их для локальной верификации id_token без обращения к серверу.</p>
      <pre><code><span class="c-comment">// Ответ /oidc/jwks:</span>
{
  <span class="c-str">"keys"</span>: [{
    <span class="c-str">"kty"</span>: <span class="c-str">"RSA"</span>,
    <span class="c-str">"kid"</span>: <span class="c-str">"eabr-key-1"</span>,
    <span class="c-str">"use"</span>: <span class="c-str">"sig"</span>,
    <span class="c-str">"alg"</span>: <span class="c-str">"RS256"</span>,
    <span class="c-str">"n"</span>: <span class="c-str">"BASE64URL(modulus)"</span>,  <span class="c-comment">// модуль RSA ключа</span>
    <span class="c-str">"e"</span>: <span class="c-str">"BASE64URL(exponent)"</span>  <span class="c-comment">// экспонента RSA ключа</span>
  }]
}</code></pre>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="x-circle"></i> RevokeController — POST /oauth2/revoke</div>
      <div class="file-path"><i data-lucide="file-code"></i> app/Http/Controllers/OAuth/RevokeController.php</div>
      <p class="text">Инвалидирует токен. Параметр <code>token_type_hint</code> подсказывает тип (access или refresh). По RFC 7009 всегда возвращает 200 — даже если токен невалидный.</p>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="log-out"></i> LogoutController — GET/POST /oidc/logout</div>
      <div class="file-path"><i data-lucide="file-code"></i> app/Http/Controllers/OAuth/LogoutController.php</div>
      <pre><code><span class="c-comment">// Выход из сессии guard 'site'</span>
Auth::guard(<span class="c-str">'site'</span>)->logout();

<span class="c-comment">// Инвалидация сессии (важно!)</span>
<span class="c-var">$request</span>->session()->invalidate();
<span class="c-var">$request</span>->session()->regenerateToken();

<span class="c-comment">// Опциональный редирект в приложение</span>
<span class="c-var">$redirectUri</span> = <span class="c-var">$request</span>->input(<span class="c-str">'post_logout_redirect_uri'</span>);</code></pre>
      <div class="info-box danger">
        <strong>TODO в коде:</strong> Logout не валидирует <code>post_logout_redirect_uri</code> — потенциальная уязвимость Open Redirect. В продакшн нужно добавить проверку по зарегистрированным URI клиента.
      </div>
    </div>
  </div>

  <!-- ── SECTION: PROVISION ── -->
  <div id="provision" class="section">
    <div class="section-title">UserProvisionController</div>
    <div class="file-path"><i data-lucide="file-code"></i> app/Http/Controllers/OAuth/UserProvisionController.php</div>

    <p class="text"><strong>Назначение:</strong> Мобильное приложение может заранее создать профиль пользователя на сайте до того, как пользователь зарегистрируется. Защищён сервисным токеном (<code>OAUTH_SERVICE_TOKEN</code> из .env).</p>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="git-merge"></i> Логика — 4 сценария</div>
      <table class="data-table">
        <thead><tr><th>Ситуация</th><th>Действие</th><th>HTTP ответ</th></tr></thead>
        <tbody>
          <tr><td>Пользователь с <code>external_id</code> уже есть</td><td>Обновить данные (идемпотентность)</td><td>200 + <code>created:false</code></td></tr>
          <tr><td>Email занят другим <code>external_id</code></td><td>Конфликт</td><td>409 Conflict</td></tr>
          <tr><td>Email есть без <code>external_id</code></td><td>Привязать external_id к существующему</td><td>200 + <code>linked:true</code></td></tr>
          <tr><td>Нового пользователя нет</td><td>Создать (<code>status=0, is_registered=0</code>)</td><td>201 Created</td></tr>
        </tbody>
      </table>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="phone"></i> Нормализация телефона</div>
      <pre><code><span class="c-comment">// Удаляет всё кроме цифр и +</span>
<span class="c-var">$cleaned</span> = <span class="c-fn">preg_replace</span>(<span class="c-str">'/[^\d+]/'</span>, <span class="c-str">''</span>, <span class="c-var">$phone</span>);

<span class="c-comment">// Казахстан: если начинается с 7 или 8</span>
<span class="c-str">"+7"</span> . <span class="c-fn">substr</span>(<span class="c-var">$cleaned</span>, 1)

<span class="c-comment">// "87771234567" → "+77771234567"</span>
<span class="c-comment">// "77771234567" → "+77771234567"</span></code></pre>
    </div>
  </div>

  <!-- ── SECTION: JWT SERVICE ── -->
  <div id="jwt-service" class="section">
    <div class="section-title">JwtService</div>
    <div class="file-path"><i data-lucide="file-code"></i> app/Services/OAuth/JwtService.php</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="layers"></i> Структура JWT токена</div>
      <div class="token-parts">
        <div class="token-part header">HEADER (алгоритм)</div>
        <div style="font-size:20px;line-height:1;padding-top:4px">.</div>
        <div class="token-part payload">PAYLOAD (данные)</div>
        <div style="font-size:20px;line-height:1;padding-top:4px">.</div>
        <div class="token-part signature">SIGNATURE (RSA подпись)</div>
      </div>
      <pre><code><span class="c-comment">// Header</span>
{ <span class="c-str">"alg"</span>: <span class="c-str">"RS256"</span>, <span class="c-str">"kid"</span>: <span class="c-str">"eabr-key-1"</span>, <span class="c-str">"typ"</span>: <span class="c-str">"JWT"</span> }

<span class="c-comment">// Payload (ID Token)</span>
{
  <span class="c-str">"iss"</span>: <span class="c-str">"https://am.eabr.org"</span>,         <span class="c-comment">// издатель</span>
  <span class="c-str">"sub"</span>: <span class="c-str">"ext-user-uuid"</span>,              <span class="c-comment">// ID пользователя (external_id)</span>
  <span class="c-str">"aud"</span>: <span class="c-str">"mobile-app-client-id"</span>,       <span class="c-comment">// для кого (client_id)</span>
  <span class="c-str">"exp"</span>: 1700000000,                   <span class="c-comment">// истекает (unix timestamp)</span>
  <span class="c-str">"iat"</span>: 1699996400,                   <span class="c-comment">// создан</span>
  <span class="c-str">"auth_time"</span>: 1699996400,            <span class="c-comment">// время аутентификации</span>
  <span class="c-str">"nonce"</span>: <span class="c-str">"random-nonce"</span>             <span class="c-comment">// защита от replay атак</span>
}</code></pre>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="key"></i> RSA ключи — как работают</div>
      <p class="text"><strong>RS256</strong> = RSA + SHA-256. Асимметричная криптография: подписываем приватным ключом, проверяем публичным.</p>
      <table class="data-table">
        <thead><tr><th>Ключ</th><th>Где хранится</th><th>Кто имеет доступ</th><th>Для чего</th></tr></thead>
        <tbody>
          <tr><td><code>oauth-private.key</code></td><td>storage/ (chmod 600)</td><td>Только сервер</td><td>Подпись токенов (generateIdToken)</td></tr>
          <tr><td><code>oauth-public.key</code></td><td>storage/ (chmod 644)</td><td>Все (через /oidc/jwks)</td><td>Верификация токенов</td></tr>
        </tbody>
      </table>
      <pre><code><span class="c-comment">// Если ключи не существуют — генерируются автоматически</span>
<span class="c-key">if</span> (!<span class="c-fn">file_exists</span>(<span class="c-var">$this</span>->privateKeyPath)) {
    <span class="c-var">$this</span>->generateKeyPair();  <span class="c-comment">// RSA 2048 bit</span>
}

<span class="c-comment">// Генерация через openssl:</span>
<span class="c-var">$resource</span> = <span class="c-fn">openssl_pkey_new</span>([
    <span class="c-str">'private_key_bits'</span> => 2048,
    <span class="c-str">'private_key_type'</span> => OPENSSL_KEYTYPE_RSA,
]);</code></pre>
    </div>
  </div>

  <!-- ── SECTION: TOKEN SERVICE ── -->
  <div id="token-service" class="section">
    <div class="section-title">TokenService</div>
    <div class="file-path"><i data-lucide="file-code"></i> app/Services/OAuth/TokenService.php</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="shield"></i> Безопасное хранение токенов</div>
      <pre><code><span class="c-fn">public function</span> <span class="c-fn">createAccessToken</span>(SiteUser <span class="c-var">$user</span>, ...): OAuthAccessToken
{
    <span class="c-var">$tokenString</span> = Str::random(80);  <span class="c-comment">// оригинальный токен (клиенту)</span>

    OAuthAccessToken::create([
        <span class="c-str">'token'</span> => <span class="c-fn">hash</span>(<span class="c-str">'sha256'</span>, <span class="c-var">$tokenString</span>),  <span class="c-comment">// В БД хранится только хеш!</span>
        ...
    ]);

    <span class="c-var">$token</span>->token = <span class="c-var">$tokenString</span>;  <span class="c-comment">// Перезаписываем для ответа клиенту</span>
    <span class="c-key">return</span> <span class="c-var">$token</span>;
}

<span class="c-comment">// При валидации: ищем по hash('sha256', $incomingToken)</span>
<span class="c-fn">public function</span> <span class="c-fn">validateAccessToken</span>(string <span class="c-var">$token</span>): ?SiteUser
{
    <span class="c-var">$accessToken</span> = OAuthAccessToken::findValidToken(<span class="c-var">$token</span>);
    <span class="c-comment">// findValidToken внутри: where('token', hash('sha256', $token))</span>
}</code></pre>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="refresh-cw"></i> exchangeAuthCode() — ключевой метод</div>
      <pre><code><span class="c-fn">public function</span> <span class="c-fn">exchangeAuthCode</span>(OAuthAuthCode <span class="c-var">$authCode</span>, string <span class="c-var">$codeVerifier</span>): ?array
{
    <span class="c-comment">// 1. Проверка PKCE</span>
    <span class="c-key">if</span> (!<span class="c-var">$authCode</span>->verifyCodeVerifier(<span class="c-var">$codeVerifier</span>)) {
        <span class="c-key">return</span> null;  <span class="c-comment">// 400 invalid_grant</span>
    }

    <span class="c-comment">// 2. Отзыв code (одноразовый!)</span>
    <span class="c-var">$authCode</span>->revoke();

    <span class="c-comment">// 3. Создание access + refresh токенов</span>
    <span class="c-var">$accessToken</span>  = <span class="c-var">$this</span>->createAccessToken(<span class="c-var">$authCode</span>->user, ...);
    <span class="c-var">$refreshToken</span> = <span class="c-var">$this</span>->createRefreshToken(<span class="c-var">$accessToken</span>);

    <span class="c-comment">// 4. ID Token только если scope содержит 'openid'</span>
    <span class="c-var">$idToken</span> = null;
    <span class="c-key">if</span> (<span class="c-fn">str_contains</span>(<span class="c-var">$authCode</span>->scopes, <span class="c-str">'openid'</span>)) {
        <span class="c-var">$idToken</span> = <span class="c-var">$this</span>->jwtService->generateIdToken(...);
    }

    <span class="c-key">return</span> [<span class="c-str">'access_token'</span> => ..., <span class="c-str">'refresh_token'</span> => ..., <span class="c-str">'id_token'</span> => <span class="c-var">$idToken</span>];
}</code></pre>
    </div>
  </div>

  <!-- ── SECTION: PKCE ── -->
  <div id="pkce" class="section">
    <div class="section-title">PkceService</div>
    <div class="file-path"><i data-lucide="file-code"></i> app/Services/OAuth/PkceService.php</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="shield-check"></i> verifyCodeVerifier() — главная проверка</div>
      <pre><code><span class="c-fn">public function</span> <span class="c-fn">verifyCodeVerifier</span>(string <span class="c-var">$codeVerifier</span>, string <span class="c-var">$codeChallenge</span>, string <span class="c-var">$method</span> = <span class="c-str">'S256'</span>): bool
{
    <span class="c-comment">// Требование: code_verifier 43-128 символов</span>
    <span class="c-var">$length</span> = <span class="c-fn">strlen</span>(<span class="c-var">$codeVerifier</span>);
    <span class="c-key">if</span> (<span class="c-var">$length</span> < 43 || <span class="c-var">$length</span> > 128) <span class="c-key">return</span> false;

    <span class="c-comment">// Вычисление: BASE64URL(SHA256(code_verifier))</span>
    <span class="c-var">$hash</span> = <span class="c-fn">hash</span>(<span class="c-str">'sha256'</span>, <span class="c-var">$codeVerifier</span>, <span class="c-key">true</span>);  <span class="c-comment">// raw bytes</span>
    <span class="c-var">$computedChallenge</span> = <span class="c-fn">rtrim</span>(<span class="c-fn">strtr</span>(<span class="c-fn">base64_encode</span>(<span class="c-var">$hash</span>), <span class="c-str">'+/'</span>, <span class="c-str">'-_'</span>), <span class="c-str">'='</span>);

    <span class="c-comment">// Сравнение (hash_equals защищает от timing attacks)</span>
    <span class="c-key">return</span> <span class="c-fn">hash_equals</span>(<span class="c-var">$codeChallenge</span>, <span class="c-var">$computedChallenge</span>);
}</code></pre>
      <div class="info-box blue">
        <strong>hash_equals() vs ===</strong>: Обычное сравнение строк (===) уязвимо к timing attacks — злоумышленник может угадать challenge по времени ответа. <code>hash_equals()</code> всегда сравнивает за одинаковое время.
      </div>
    </div>
  </div>

  <!-- ── SECTION: DATABASE ── -->
  <div id="database" class="section">
    <div class="section-title">Структура таблиц БД</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="table"></i> oauth_clients</div>
      <table class="data-table">
        <thead><tr><th>Колонка</th><th>Тип</th><th>Описание</th></tr></thead>
        <tbody>
          <tr><td><code>id</code></td><td>bigint PK</td><td>Внутренний ID</td></tr>
          <tr><td><code>client_id</code></td><td>varchar unique</td><td>Публичный идентификатор (отправляет приложение)</td></tr>
          <tr><td><code>name</code></td><td>varchar</td><td>Название (например "EABR Mobile App")</td></tr>
          <tr><td><code>secret</code></td><td>varchar nullable</td><td>Секрет (null для публичных клиентов)</td></tr>
          <tr><td><code>redirect_uris</code></td><td>json</td><td>Разрешённые redirect URI (массив)</td></tr>
          <tr><td><code>is_confidential</code></td><td>boolean</td><td>Конфиденциальный клиент</td></tr>
          <tr><td><code>is_active</code></td><td>boolean</td><td>Активен ли клиент</td></tr>
        </tbody>
      </table>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="table"></i> oauth_auth_codes</div>
      <table class="data-table">
        <thead><tr><th>Колонка</th><th>Описание</th></tr></thead>
        <tbody>
          <tr><td><code>code</code></td><td>Str::random(64) — одноразовый, 10 минут</td></tr>
          <tr><td><code>user_id</code></td><td>FK → site_users.id</td></tr>
          <tr><td><code>client_id</code></td><td>FK → oauth_clients.id</td></tr>
          <tr><td><code>scopes</code></td><td>Строка "openid profile email"</td></tr>
          <tr><td><code>code_challenge</code></td><td>BASE64URL(SHA256(verifier)) — для PKCE проверки</td></tr>
          <tr><td><code>code_challenge_method</code></td><td>S256</td></tr>
          <tr><td><code>state</code></td><td>CSRF protection (генерирует приложение)</td></tr>
          <tr><td><code>nonce</code></td><td>Replay protection (включается в id_token)</td></tr>
          <tr><td><code>expires_at</code></td><td>now() + 10 минут</td></tr>
          <tr><td><code>revoked_at</code></td><td>Время отзыва (null = активен)</td></tr>
        </tbody>
      </table>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="table"></i> oauth_access_tokens и oauth_refresh_tokens</div>
      <table class="data-table">
        <thead><tr><th>Колонка</th><th>Access Token</th><th>Refresh Token</th></tr></thead>
        <tbody>
          <tr><td><code>token</code></td><td>hash('sha256', random(80))</td><td>hash('sha256', random(80))</td></tr>
          <tr><td><code>user_id / access_token_id</code></td><td>FK → site_users</td><td>FK → oauth_access_tokens</td></tr>
          <tr><td><code>client_id</code></td><td>FK → oauth_clients</td><td>–</td></tr>
          <tr><td><code>scopes</code></td><td>"openid profile email"</td><td>–</td></tr>
          <tr><td><code>expires_at</code></td><td>60 минут</td><td>30 дней</td></tr>
          <tr><td><code>revoked_at</code></td><td>nullable</td><td>nullable</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ── SECTION: APP INTEGRATION ── -->
  <div id="app-integration" class="section">
    <div class="section-title">Взаимодействие с мобильным приложением</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="smartphone"></i> Что передаётся между сайтом и приложением</div>
      <table class="data-table">
        <thead><tr><th>Направление</th><th>Данные</th><th>Когда</th><th>Реализовано</th></tr></thead>
        <tbody>
          <tr><td><strong>Приложение → Сайт</strong></td><td>Создание профиля (external_id, name, email, phone)</td><td>До регистрации — provision</td><td>✅ UserProvisionController</td></tr>
          <tr><td><strong>Сайт → Приложение</strong></td><td>SSO токены (access_token, id_token)</td><td>При входе через SSO</td><td>✅ TokenController</td></tr>
          <tr><td><strong>Сайт → Приложение</strong></td><td>Данные профиля (OIDC userinfo)</td><td>После первого апрува</td><td>⚠️ Только при запросе /oidc/userinfo</td></tr>
          <tr><td><strong>Сайт → Приложение</strong></td><td>Программа мероприятия</td><td>По запросу приложения</td><td>❌ Не реализовано</td></tr>
        </tbody>
      </table>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="shield-check"></i> Согласие на передачу данных</div>
      <p class="text">По схеме: <strong>"Согласие на передачу данных в приложение и отображение этих данных в приложении, без согласия не передаём"</strong></p>
      <div class="info-box warning">
        <strong>Что нужно сделать:</strong> При регистрации добавить чекбокс согласия на передачу данных в мобильное приложение. Только если дал согласие — передаём через UserProvision API.
      </div>
      <pre><code><span class="c-comment">// Вопрос разработчику сайта:</span>
<span class="c-comment">// Есть ли поле consent_app в site_users?</span>
<span class="c-comment">// Передаётся ли consent из формы регистрации?</span>

<span class="c-comment">// Что должно быть:</span>
site_users.consent_app_transfer = true/false
<span class="c-comment">// Если false — не вызывать UserProvisionController</span></code></pre>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="book-open"></i> API программы мероприятия</div>
      <p class="text">По схеме приложение должно получать программу мероприятия с сайта: <strong>"на сайте заполняется программа, по API отдаём в приложение"</strong>.</p>
      <div class="info-box blue">
        <strong>Это отдельный endpoint которого пока нет.</strong> Нужно создать API для получения программы мероприятия (расписание сессий, спикеры, локации).
      </div>
      <pre><code><span class="c-comment">// Что нужно создать:</span>
GET /api/v1/program          <span class="c-comment">// Вся программа</span>
GET /api/v1/program/{day}    <span class="c-comment">// Программа за день</span>
GET /api/v1/speakers         <span class="c-comment">// Спикеры</span>

<span class="c-comment">// Модели уже есть в проекте:</span>
app/Models/ForumProgram.php      <span class="c-comment">// ✅ Есть</span>
app/Models/ForumSpeaker.php      <span class="c-comment">// ✅ Есть</span>
app/Models/ProgramSpeaker.php    <span class="c-comment">// ✅ Есть</span>

<span class="c-comment">// Нужно: создать API контроллер и роуты</span></code></pre>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="message-square"></i> Как говорить с разработчиками приложения</div>
      <div class="card" style="border-left:4px solid var(--primary);margin-bottom:12px">
        <div class="card-title"><i data-lucide="message-circle"></i> Про SSO</div>
        <p style="color:var(--text2);font-size:13px;line-height:1.8"><em>"SSO реализован по стандарту OAuth 2.0 + OIDC с PKCE. Discovery endpoint: <code>/.well-known/openid-configuration</code> — там все URL автоматически. Для авторизации нужен Authorization Code flow. Какой redirect_uri будет у вашего приложения?"</em></p>
      </div>
      <div class="card" style="border-left:4px solid var(--primary)">
        <div class="card-title"><i data-lucide="message-circle"></i> Про API программы</div>
        <p style="color:var(--text2);font-size:13px;line-height:1.8"><em>"Модели ForumProgram и ForumSpeaker уже есть в коде. Нужно создать API endpoint для получения программы приложением. Какой формат данных вам нужен и нужна ли авторизация на этих endpoint'ах?"</em></p>
      </div>
    </div>
  </div>

  <!-- ── SECTION: TODO ── -->
  <div id="todo" class="section">
    <div class="section-title">Что нужно доделать по схеме</div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="list-checks"></i> Список задач</div>
      <table class="data-table">
        <thead><tr><th>#</th><th>Задача</th><th>Файлы</th><th>Кому</th><th>Приоритет</th></tr></thead>
        <tbody>
          <tr>
            <td>1</td>
            <td><strong>Добавить согласие на передачу данных в приложение</strong><br><small>Чекбокс в регистрации + поле consent_app в site_users</small></td>
            <td>RegisterStepOneRequest, SiteUser, Registration view</td>
            <td>Разработчик сайта</td>
            <td style="color:var(--danger);font-weight:700">HIGH</td>
          </tr>
          <tr>
            <td>2</td>
            <td><strong>API программы мероприятия для приложения</strong><br><small>GET /api/v1/program — использовать ForumProgram модель</small></td>
            <td>Новый ForumController, routes/api.php</td>
            <td>Разработчик сайта</td>
            <td style="color:var(--danger);font-weight:700">HIGH</td>
          </tr>
          <tr>
            <td>3</td>
            <td><strong>Передача профиля в приложение после апрува</strong><br><small>При UserConfirmedEvent вызывать UserProvision API</small></td>
            <td>SendConfirmedNotification или новый listener</td>
            <td>Разработчик сайта</td>
            <td style="color:var(--danger);font-weight:700">HIGH</td>
          </tr>
          <tr>
            <td>4</td>
            <td><strong>Валидация redirect_uri при logout</strong><br><small>TODO в LogoutController — open redirect уязвимость</small></td>
            <td>LogoutController.php</td>
            <td>Разработчик сайта</td>
            <td style="color:var(--warning-dark);font-weight:700">MEDIUM</td>
          </tr>
          <tr>
            <td>5</td>
            <td><strong>Очистка истёкших токенов</strong><br><small>Scheduler: удалять oauth_auth_codes, tokens старше TTL</small></td>
            <td>Console/Kernel.php — новая команда</td>
            <td>Разработчик сайта</td>
            <td style="color:var(--warning-dark);font-weight:700">MEDIUM</td>
          </tr>
          <tr>
            <td>6</td>
            <td><strong>Уточнить у приложенцев client_id и redirect_uri</strong></td>
            <td>oauth_clients таблица в БД</td>
            <td>Мобильные разработчики</td>
            <td style="color:var(--danger);font-weight:700">HIGH</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="subsection">
      <div class="subsection-title"><i data-lucide="users"></i> Скрипт разговора с мобильными разработчиками</div>
      <div class="info-box success">
        <strong>Встреча с приложенцами — что обсудить:</strong><br><br>
        1. <strong>SSO:</strong> "Мы реализовали OAuth 2.0 + PKCE. Вам нужно зарегистрировать client_id и redirect_uri. Какой redirect_uri у вашего приложения?"<br><br>
        2. <strong>Согласие:</strong> "По требованию — передаём данные только с согласия пользователя. Нужно добавить чекбокс при регистрации."<br><br>
        3. <strong>Программа:</strong> "ForumProgram модель в БД есть. Создадим API endpoint. Какие поля программы вам нужны? Нужна авторизация?"<br><br>
        4. <strong>После апрува:</strong> "Когда организаторы одобряют участника — сайт вызывает /api/v1/users/provision с данными. Как вы понимаете что пользователь одобрен?"<br><br>
        5. <strong>Документация:</strong> "Запрашиваем документацию по вашему API — какие данные вы ждёте от сайта и в каком формате."
      </div>
    </div>
  </div>

  <!-- ── SECTION: QUESTIONS ── -->
  <div id="questions" class="section">
    <div class="section-title">Вопросы разработчику</div>
    <p class="text">Вопросы которые нужно задать когда будешь общаться с разработчиками о SSO:</p>

    <div class="qa-item">
      <div class="qa-q" onclick="toggleQa(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span>Какой client_id у мобильного приложения и какой redirect_uri зарегистрирован?</div>
      <div class="qa-a"><strong>Зачем:</strong> Без этого приложение получит ошибку <code>invalid_client</code>. Redirect URI должен точно совпадать с зарегистрированным.<br><strong>Где смотреть:</strong> Таблица <code>oauth_clients</code>. Поля <code>client_id</code> и <code>redirect_uris</code> (JSON массив).</div>
    </div>

    <div class="qa-item">
      <div class="qa-q" onclick="toggleQa(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span>Сгенерированы ли RSA ключи на production сервере?</div>
      <div class="qa-a"><strong>Зачем:</strong> Без ключей JwtService их сгенерирует автоматически. Но при рестарте сервера или смене папки storage — ключи могут поменяться, и все старые id_token станут невалидны.<br><strong>Команда:</strong> <code>php artisan oauth:keys</code><br><strong>Где:</strong> <code>storage/oauth-private.key</code>, <code>storage/oauth-public.key</code></div>
    </div>

    <div class="qa-item">
      <div class="qa-q" onclick="toggleQa(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span>Что такое OAUTH_SERVICE_TOKEN и где он используется?</div>
      <div class="qa-a"><strong>Ответ:</strong> Статичный токен в .env для защиты endpoint <code>/api/v1/users/provision</code>. Мобильное приложение отправляет его в заголовке для создания профилей пользователей.<br><strong>Middleware:</strong> <code>ServiceTokenAuthenticate</code> проверяет заголовок <code>Authorization: Bearer SERVICE_TOKEN</code></div>
    </div>

    <div class="qa-item">
      <div class="qa-q" onclick="toggleQa(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span>Метод AuthCredentials — что в таблице credential? Email или что-то ещё?</div>
      <div class="qa-a"><strong>Зачем:</strong> Пользователи ищутся через <code>AuthCredentials</code>, не через SiteUser напрямую. Важно понять, что именно хранится в поле <code>credential</code> (email? phone? username?). Это влияет на то, что пользователь вводит в форму.</div>
    </div>

    <div class="qa-item">
      <div class="qa-q" onclick="toggleQa(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span>Есть ли очистка истёкших токенов и codes в БД?</div>
      <div class="qa-a"><strong>Зачем:</strong> С каждым входом создаются записи в <code>oauth_auth_codes</code>, <code>oauth_access_tokens</code>, <code>oauth_refresh_tokens</code>. Без очистки таблицы будут расти.<br><strong>Что спросить:</strong> Есть ли Laravel Scheduler с задачей удаления истёкших токенов? (Команда в app/Console/Kernel.php)</div>
    </div>

    <div class="qa-item">
      <div class="qa-q" onclick="toggleQa(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span>Как мобильное приложение хранит токены? SecureStorage?</div>
      <div class="qa-a"><strong>Зачем:</strong> Если приложение хранит access_token в обычном storage — токен могут украсть. Правильно: iOS Keychain, Android Keystore (SecureStorage во Flutter/React Native).<br><strong>Риск:</strong> Refresh token особенно важно защитить — он живёт 30 дней.</div>
    </div>

    <div class="qa-item">
      <div class="qa-q" onclick="toggleQa(this)"><span class="q-icon"><i data-lucide="help-circle"></i></span>Что возвращает $user->getOidcUserInfo()? Какие поля в ответе?</div>
      <div class="qa-a"><strong>Зачем:</strong> Мобильное приложение использует эти данные для профиля. Нужно знать структуру ответа: <code>sub</code>, <code>email</code>, <code>first_name</code>, <code>last_name</code>, <code>phone</code> и что ещё.<br><strong>Где:</strong> Метод <code>getOidcUserInfo()</code> в модели <code>SiteUser</code>.</div>
    </div>

    <div class="info-box success" style="margin-top:20px">
      <strong>Как говорить с разработчиком:</strong> "Я изучаю SSO реализацию. Вижу что TokenService хранит токены как SHA-256 хеши в БД. Правильно понимаю что при refresh_token происходит ротация — создаётся новая пара токенов и старые отзываются?" — Такие вопросы показывают что ты читал код.
    </div>
  </div>

</div><!-- /main -->
</div><!-- /container -->

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>
function showSection(id, el) {
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  el.classList.add('active');
}
function toggleQa(el) {
  const ans = el.nextElementSibling;
  ans.classList.toggle('open');
}
lucide.createIcons();
</script>
</body>
</html>

@endverbatim