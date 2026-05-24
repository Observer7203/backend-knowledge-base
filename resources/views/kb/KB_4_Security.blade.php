@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Безопасность — продвинутый разбор</title>
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
  <div class="sidebar-title">Security</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>
  <a class="nav-item" onclick="showSection('owasp',this)"><i data-lucide="shield-alert"></i> OWASP Top 10</a>

  <div class="nav-group-label">Аутентификация</div>
  <a class="nav-item" onclick="showSection('passwords',this)"><i data-lucide="lock-keyhole"></i> Пароли и хеширование</a>
  <a class="nav-item" onclick="showSection('tokens',this)"><i data-lucide="ticket"></i> Tokens & Sessions</a>
  <a class="nav-item" onclick="showSection('oauth',this)"><i data-lucide="key"></i> OAuth 2.0 + OIDC</a>
  <a class="nav-item" onclick="showSection('authz',this)"><i data-lucide="user-check"></i> Authorization (RBAC/ABAC)</a>

  <div class="nav-group-label">Атаки и защита</div>
  <a class="nav-item" onclick="showSection('csrf',this)"><i data-lucide="cookie"></i> CSRF</a>
  <a class="nav-item" onclick="showSection('xss',this)"><i data-lucide="code"></i> XSS</a>
  <a class="nav-item" onclick="showSection('sqli',this)"><i data-lucide="database"></i> SQL Injection</a>
  <a class="nav-item" onclick="showSection('cors',this)"><i data-lucide="globe"></i> CORS</a>
  <a class="nav-item" onclick="showSection('ratelimit',this)"><i data-lucide="gauge"></i> Rate Limiting</a>

  <div class="nav-group-label">Транспорт</div>
  <a class="nav-item" onclick="showSection('tls',this)"><i data-lucide="lock"></i> HTTPS / TLS</a>
  <a class="nav-item" onclick="showSection('headers',this)"><i data-lucide="shield"></i> Security Headers</a>
  <a class="nav-item" onclick="showSection('secrets',this)"><i data-lucide="key-square"></i> Secrets Management</a>

  <div class="nav-group-label">Применение</div>
  <a class="nav-item" onclick="showSection('practice',this)"><i data-lucide="hammer"></i> Практика: security review</a>
  <a class="nav-item" onclick="showSection('pitfalls',this)"><i data-lucide="alert-octagon"></i> Подводные камни</a>
  <a class="nav-item" onclick="showSection('interview',this)"><i data-lucide="brain"></i> На собеседование</a>
</div>

<div class="main">
<div class="page-header">
  <h1>Безопасность</h1>
  <p>OWASP Top 10, аутентификация (пароли, токены, OAuth 2.0), авторизация (RBAC/ABAC), CSRF/XSS/SQL Injection, CORS, rate limiting, TLS, security headers, secrets management. Middle/senior уровень с практическими сценариями.</p>
  <div class="badge-row">
    <span class="badge">OWASP</span>
    <span class="badge">OAuth 2.0</span>
    <span class="badge">JWT</span>
    <span class="badge">TLS</span>
    <span class="badge badge-success">Middle / Senior</span>
  </div>
</div>

<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>
  <p class="text">Безопасность отличается от других слоёв тем, что цена ошибки <strong>асимметрична</strong>: один пропущенный validation на endpoint вашего приложения может стоить компании репутации, штрафов GDPR и судебных исков. Большинство разработчиков знают о SQL Injection и XSS на уровне определения, но не знают, как именно работает CSP, чем JWT отличается от session cookie, какие конкретно атаки лечит SameSite=Strict. Этот раздел даёт операционное понимание угроз и их митигаций &mdash; не теорию, а то, что нужно делать руками.</p>

  <div class="info-box danger">
    <strong>Принципы, на которых построен раздел:</strong>
    <ul class="bullets" style="margin-top:6px;margin-bottom:0;color:#7B1C2A;">
      <li><strong>Defense in depth</strong>: ни один слой защиты не считается достаточным;</li>
      <li><strong>Принцип наименьших привилегий</strong>: каждый компонент имеет минимальные права;</li>
      <li><strong>Fail securely</strong>: при ошибке система не открывает доступ;</li>
      <li><strong>Никогда не доверять клиенту</strong>: вся валидация на сервере;</li>
      <li><strong>Mark, not patch</strong>: security баги &mdash; не «технический долг», а инциденты.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map"></i> Карта раздела</div>
    <table class="data-table">
      <tr><th>Блок</th><th>Что разбирается</th></tr>
      <tr><td><strong>Обзор</strong></td><td>OWASP Top 10 2021 &mdash; что входит и почему</td></tr>
      <tr><td><strong>Аутентификация</strong></td><td>Пароли, хеширование (bcrypt/argon2), tokens, OAuth 2.0/OIDC</td></tr>
      <tr><td><strong>Авторизация</strong></td><td>RBAC, ABAC, Gates/Policies в Laravel</td></tr>
      <tr><td><strong>Атаки</strong></td><td>CSRF, XSS (3 типа), SQL Injection, CORS, brute-force</td></tr>
      <tr><td><strong>Транспорт</strong></td><td>TLS, HSTS, CSP, Security Headers</td></tr>
      <tr><td><strong>Operations</strong></td><td>Secrets management, audit logging</td></tr>
    </table>
  </div>
</div>

<div id="sec-owasp" class="section">
  <div class="section-title">OWASP Top 10 (2021)</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">OWASP Top 10 &mdash; индустриальный стандарт классификации самых критичных уязвимостей веб-приложений, обновляемый раз в 3-4 года. Это не исчерпывающий список (есть OWASP Top 10 API, OWASP ASVS), но это первый чек-лист, который должен проходить любой production-проект. Знание Top 10 на интервью &mdash; маст-хэв для middle и senior.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Десять категорий (2021)</div>
    <table class="data-table">
      <tr><th>#</th><th>Категория</th><th>Что внутри</th></tr>
      <tr><td><strong>A01</strong></td><td>Broken Access Control</td><td>Обход авторизации, IDOR, отсутствие проверки на endpoint</td></tr>
      <tr><td><strong>A02</strong></td><td>Cryptographic Failures</td><td>Слабое хеширование, MD5/SHA1 для паролей, HTTP вместо HTTPS</td></tr>
      <tr><td><strong>A03</strong></td><td>Injection</td><td>SQL, NoSQL, LDAP, OS command, ORM injection</td></tr>
      <tr><td><strong>A04</strong></td><td>Insecure Design</td><td>Архитектурные дыры: race conditions, бизнес-логика без проверок</td></tr>
      <tr><td><strong>A05</strong></td><td>Security Misconfiguration</td><td>Дефолтные пароли, открытые admin-панели, debug=true в проде</td></tr>
      <tr><td><strong>A06</strong></td><td>Vulnerable Components</td><td>Старые зависимости с известными CVE</td></tr>
      <tr><td><strong>A07</strong></td><td>Identification &amp; Auth Failures</td><td>Brute-force без защиты, слабые сессии, отсутствие 2FA</td></tr>
      <tr><td><strong>A08</strong></td><td>Software &amp; Data Integrity Failures</td><td>Доверие к unsigned-данным, supply chain атаки</td></tr>
      <tr><td><strong>A09</strong></td><td>Security Logging &amp; Monitoring Failures</td><td>Отсутствие логов, поздно замеченные инциденты</td></tr>
      <tr><td><strong>A10</strong></td><td>Server-Side Request Forgery (SSRF)</td><td>Сервер делает запросы к URL, контролируемому атакующим</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. «Мы делаем код-ревью, OWASP не нужен.»</strong> Code review ловит логические ошибки, не системные угрозы. SSRF в обработчике картинок легко пропустить.</div>
    <div class="pitfall"><strong>2. WAF как панацея.</strong> Web Application Firewall (CloudFlare, AWS WAF) фильтрует известные паттерны. Уникальные уязвимости вашего приложения WAF не видит.</div>
    <div class="pitfall"><strong>3. «У нас закрытый API, инъекции не страшны.»</strong> Внутренний API через PostMessage из браузера &mdash; всё ещё HTTP-endpoint. Внутренний трафик не значит безопасный.</div>
    <div class="pitfall"><strong>4. Пентест раз в год.</strong> Уязвимости появляются с каждым релизом. Нужен SAST в CI, регулярный dependency scan, не раз в год.</div>
    <div class="pitfall"><strong>5. Top 10 покрывает 100%.</strong> Top 10 &mdash; верхушка. Полный список &mdash; OWASP ASVS (Application Security Verification Standard), сотни требований по уровням.</div>
    <div class="pitfall"><strong>6. Старая редакция Top 10.</strong> 2017 → 2021: появились «Insecure Design», «Software Integrity», «SSRF». Старые туториалы могут не покрывать.</div>
    <div class="pitfall"><strong>7. Бэкенд-разработчик игнорирует фронтенд-угрозы.</strong> XSS и CSP конфигурируются на бэкенде (заголовки, escape в шаблонах). Это совместная зона ответственности.</div>
    <div class="pitfall"><strong>8. Уязвимости в dev-зависимостях.</strong> <code>composer audit</code>, <code>npm audit</code> &mdash; запускать в CI. Уязвимая dev-зависимость может попасть в build (особенно через build scripts).</div>
  </div>
</div>

<div id="sec-passwords" class="section">
  <div class="section-title">Пароли: хеширование и хранение</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Хранение паролей &mdash; первый и самый частый источник катастрофических утечек. Все известные мега-утечки последних 10 лет (LinkedIn, Adobe, Yahoo) случились с базами, где пароли хранились в plain text или с устаревшим хешированием. Современный стандарт &mdash; <strong>adaptive hashing</strong>: bcrypt или argon2id, с медленностью, рассчитанной так, чтобы перебор стоил миллиарды лет.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Правила</div>
    <div class="card"><h3>Никогда: MD5, SHA1, SHA256 для паролей</h3><p class="text">Эти алгоритмы спроектированы <em>быстрыми</em>. На GPU перебор 100 миллионов SHA256-хешей в секунду. База из 1M юзеров с SHA256-паролями вскрывается за часы.</p></div>
    <div class="card"><h3>Используйте: bcrypt или argon2id</h3><p class="text">bcrypt &mdash; проверенный временем; argon2id &mdash; современнее, защищён от GPU/ASIC-атак. Оба <strong>медленные</strong> (100ms на хеш), что делает перебор экономически невыгодным.</p></div>
    <div class="card"><h3>Salt автоматический</h3><p class="text">bcrypt/argon2 включают salt в результат. Не нужно вручную &laquo;добавлять соль&raquo; &mdash; библиотека делает это за вас. Использование одного salt для всех (pepper) &mdash; антипаттерн.</p></div>
    <div class="card"><h3>Cost factor: подстраивайте под железо</h3><p class="text">bcrypt cost=12 в 2026 году = ~250 мс на современном CPU. Каждые 2-3 года увеличивайте cost на 1. Цель: вход юзера &le; 500 мс, перебор &mdash; невозможен.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика в Laravel</div>
<pre><code><span class="c-comment">// config/hashing.php — драйвер и cost</span>
<span class="c-key">return</span> [
    <span class="c-str">'driver'</span> =&gt; <span class="c-str">'bcrypt'</span>, <span class="c-comment">// или 'argon2id'</span>
    <span class="c-str">'bcrypt'</span> =&gt; [<span class="c-str">'rounds'</span> =&gt; <span class="c-fn">env</span>(<span class="c-str">'BCRYPT_ROUNDS'</span>, <span class="c-num">12</span>)],
    <span class="c-str">'argon'</span>  =&gt; [<span class="c-str">'memory'</span> =&gt; <span class="c-num">65536</span>, <span class="c-str">'threads'</span> =&gt; <span class="c-num">1</span>, <span class="c-str">'time'</span> =&gt; <span class="c-num">4</span>],
];

<span class="c-comment">// Хеширование при регистрации</span>
<span class="c-var">$user</span>-&gt;<span class="c-var">password</span> = <span class="c-type">Hash</span>::<span class="c-fn">make</span>(<span class="c-var">$request</span>-&gt;<span class="c-var">password</span>);

<span class="c-comment">// Проверка при логине</span>
<span class="c-key">if</span> (<span class="c-type">Hash</span>::<span class="c-fn">check</span>(<span class="c-var">$request</span>-&gt;<span class="c-var">password</span>, <span class="c-var">$user</span>-&gt;<span class="c-var">password</span>)) {
    <span class="c-comment">// аутентифицирован</span>
}

<span class="c-comment">// Rehash при изменении cost — после успешного входа</span>
<span class="c-key">if</span> (<span class="c-type">Hash</span>::<span class="c-fn">needsRehash</span>(<span class="c-var">$user</span>-&gt;<span class="c-var">password</span>)) {
    <span class="c-var">$user</span>-&gt;<span class="c-fn">update</span>([<span class="c-str">'password'</span> =&gt; <span class="c-type">Hash</span>::<span class="c-fn">make</span>(<span class="c-var">$request</span>-&gt;<span class="c-var">password</span>)]);
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Хранение пароля в логах.</strong> <code>Log::info('login', $request-&gt;all())</code> запишет пароль в plain text. Используйте <code>$request-&gt;except('password')</code>.</div>
    <div class="pitfall"><strong>2. Возврат password_hash в API.</strong> Eloquent по умолчанию сериализует все поля. Добавьте <code>protected $hidden = ['password', 'remember_token']</code>.</div>
    <div class="pitfall"><strong>3. Timing attack при сравнении.</strong> <code>$password === $stored</code> сравнивает посимвольно; время выполнения зависит от позиции расхождения. <code>Hash::check</code> использует <code>hash_equals</code> &mdash; constant time.</div>
    <div class="pitfall"><strong>4. <code>md5(password . salt)</code> — самопальное хеширование.</strong> Любая самописная функция хеширования = катастрофа. Только проверенные библиотеки.</div>
    <div class="pitfall"><strong>5. Минимальная длина 6 символов.</strong> Бессмысленно: <code>123456</code>. Современная рекомендация NIST &mdash; min 8 без принудительной сложности (потому что пользователи всё равно ставят <code>P@ssw0rd1!</code>). Лучше &mdash; passphrase 12+ символов.</div>
    <div class="pitfall"><strong>6. Принудительная смена пароля каждые 90 дней.</strong> NIST отказался от этого в 2017: пользователи делают <code>Pass1</code>, <code>Pass2</code>, <code>Pass3</code>. Меняйте только при подозрении на компрометацию.</div>
    <div class="pitfall"><strong>7. Запрет паролей с известных утечек.</strong> Используйте Have I Been Pwned API (k-anonymity, не отправляет полный пароль). Запретите пароли из top-N утечек.</div>
    <div class="pitfall"><strong>8. Password reset с предсказуемым токеном.</strong> Токен сброса = <code>md5(email . time())</code> предсказуем. Используйте <code>Str::random(60)</code>, храните хеш токена в БД.</div>
  </div>
</div>

<div id="sec-tokens" class="section">
  <div class="section-title">Tokens, Sessions, JWT, Sanctum</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">После проверки пароля приложение должно «помнить», что пользователь аутентифицирован. Способа три: server-side sessions с cookie, stateless JWT, opaque tokens. У каждого свой профиль безопасности, удобства, масштабируемости. Правильный выбор зависит от архитектуры (монолит/микросервисы), типа клиента (браузер/SPA/мобайл), требований к revocation.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Сравнение подходов</div>
    <table class="data-table">
      <tr><th>Подход</th><th>Хранение</th><th>Revocation</th><th>Применение</th></tr>
      <tr><td><strong>Session cookie</strong></td><td>Server (Redis/DB) + cookie с session_id</td><td>Мгновенная (удаление из storage)</td><td>Классический web, монолит</td></tr>
      <tr><td><strong>Opaque token (Sanctum)</strong></td><td>Hash в БД</td><td>Мгновенная (удаление токена)</td><td>API для SPA, мобайл, OAuth-like</td></tr>
      <tr><td><strong>JWT (stateless)</strong></td><td>Только клиент</td><td>Сложная (blacklist + короткий TTL)</td><td>Микросервисы, кросс-доменная аутентификация</td></tr>
      <tr><td><strong>JWT + refresh token</strong></td><td>Refresh в БД, access &mdash; stateless</td><td>Revoke через refresh</td><td>OAuth 2.0, мобайл-приложения</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cookie"></i> Session cookies: безопасные настройки</div>
<pre><code><span class="c-comment">// config/session.php</span>
<span class="c-key">return</span> [
    <span class="c-str">'driver'</span>         =&gt; <span class="c-str">'redis'</span>,
    <span class="c-str">'lifetime'</span>       =&gt; <span class="c-num">120</span>,           <span class="c-comment">// 2 часа idle</span>
    <span class="c-str">'expire_on_close'</span>=&gt; <span class="c-key">true</span>,        <span class="c-comment">// сессия умирает с закрытием вкладки</span>
    <span class="c-str">'secure'</span>         =&gt; <span class="c-key">true</span>,         <span class="c-comment">// cookie только по HTTPS</span>
    <span class="c-str">'http_only'</span>      =&gt; <span class="c-key">true</span>,         <span class="c-comment">// JS не имеет доступа</span>
    <span class="c-str">'same_site'</span>      =&gt; <span class="c-str">'strict'</span>,      <span class="c-comment">// защита от CSRF</span>
];
</code></pre>
    <p class="text">Эти 5 настроек &mdash; обязательный минимум для session cookie в production. <code>secure</code> + <code>http_only</code> + <code>same_site=strict</code> покрывает 90% типичных атак на сессии.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="ticket"></i> JWT (JSON Web Token)</div>
    <p class="text">JWT &mdash; три части через точку: <code>header.payload.signature</code>. Header описывает алгоритм, payload содержит claims (sub, exp, iat и кастомные), signature защищает целостность. JWT <strong>читаем</strong> (base64, не зашифрован) &mdash; не кладите туда секреты.</p>

<pre><code><span class="c-comment">// Структура JWT</span>
{<span class="c-str">"alg"</span>:<span class="c-str">"RS256"</span>,<span class="c-str">"typ"</span>:<span class="c-str">"JWT"</span>}                          <span class="c-comment">// header</span>
{<span class="c-str">"sub"</span>:<span class="c-str">"user_42"</span>,<span class="c-str">"exp"</span>:<span class="c-num">1735689600</span>,<span class="c-str">"role"</span>:<span class="c-str">"admin"</span>}  <span class="c-comment">// payload</span>
&lt;signature&gt;                                              <span class="c-comment">// HMAC или RSA</span>
</code></pre>

    <p class="text"><strong>Алгоритмы подписи:</strong> HS256 (HMAC, симметричный, для одного сервиса), RS256 (RSA, асимметричный, для распределённых систем). RS256 предпочтительнее в микросервисах: один сервис подписывает приватным ключом, другие проверяют публичным.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Laravel Sanctum (opaque tokens)</div>
<pre><code><span class="c-comment">// Создание токена</span>
<span class="c-var">$token</span> = <span class="c-var">$user</span>-&gt;<span class="c-fn">createToken</span>(<span class="c-str">'mobile-app'</span>, [<span class="c-str">'orders:read'</span>, <span class="c-str">'orders:write'</span>]);
<span class="c-key">return</span> [<span class="c-str">'token'</span> =&gt; <span class="c-var">$token</span>-&gt;<span class="c-fn">plainTextToken</span>()];

<span class="c-comment">// Защита маршрутов</span>
<span class="c-type">Route</span>::<span class="c-fn">middleware</span>(<span class="c-str">'auth:sanctum'</span>)-&gt;<span class="c-fn">group</span>(<span class="c-key">function</span> () {
    <span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/api/me'</span>, <span class="c-key">fn</span> (<span class="c-type">Request</span> <span class="c-var">$r</span>) =&gt; <span class="c-var">$r</span>-&gt;<span class="c-fn">user</span>());
});

<span class="c-comment">// Проверка ability</span>
<span class="c-key">if</span> (<span class="c-var">$request</span>-&gt;<span class="c-fn">user</span>()-&gt;<span class="c-fn">tokenCan</span>(<span class="c-str">'orders:write'</span>)) { ... }

<span class="c-comment">// Revoke всех токенов</span>
<span class="c-var">$user</span>-&gt;<span class="c-fn">tokens</span>()-&gt;<span class="c-fn">delete</span>();
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. JWT с секретом в коде.</strong> Hardcoded HMAC-секрет в репо = компрометация всех токенов. Через env, секреты-менеджер.</div>
    <div class="pitfall"><strong>2. JWT alg=none.</strong> Атака на старые библиотеки: атакующий подменяет alg на none, signature становится пустой, сервер «верит». Используйте библиотеки, явно блокирующие <code>alg=none</code>.</div>
    <div class="pitfall"><strong>3. Долгоживущий JWT без revocation.</strong> JWT с TTL=24h украденный нельзя отозвать. Используйте короткий access token (5-15 мин) + refresh token, который можно revoke.</div>
    <div class="pitfall"><strong>4. JWT в localStorage.</strong> XSS получает доступ к localStorage. httpOnly cookie защищена от JS.</div>
    <div class="pitfall"><strong>5. Чувствительные данные в JWT payload.</strong> JWT не зашифрован, только подписан. Любой может декодировать base64 и прочитать.</div>
    <div class="pitfall"><strong>6. <code>Sanctum::actingAs</code> в тестах с лишними abilities.</strong> <code>Sanctum::actingAs($user, ['*'])</code> даёт все права &mdash; тест не проверяет реальную авторизацию. Указывайте конкретные abilities.</div>
    <div class="pitfall"><strong>7. Session fixation.</strong> Не регенерируется session_id после логина &mdash; атакующий, давший жертве свою сессию, входит как жертва. Laravel <code>auth()-&gt;login</code> делает regenerate автоматически.</div>
    <div class="pitfall"><strong>8. Cookie без <code>Domain</code> и <code>Path</code>.</strong> По умолчанию cookie привязан к текущему host. Указывать <code>Domain=.example.com</code> только если действительно нужен на поддоменах &mdash; иначе расширение atak surface.</div>
  </div>
</div>

<div id="sec-oauth" class="section">
  <div class="section-title">OAuth 2.0 + OIDC</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">OAuth 2.0 &mdash; протокол <strong>делегированной авторизации</strong>: одно приложение получает разрешение действовать от имени пользователя в другом, без передачи пароля. OIDC (OpenID Connect) &mdash; надстройка над OAuth для аутентификации. Это два разных уровня: OAuth решает «может ли это приложение читать твоё API», OIDC &mdash; «кто этот человек».</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Роли и термины</div>
    <table class="data-table">
      <tr><th>Роль</th><th>Что делает</th></tr>
      <tr><td><strong>Resource Owner</strong></td><td>Пользователь, владеющий данными</td></tr>
      <tr><td><strong>Client</strong></td><td>Приложение, запрашивающее доступ</td></tr>
      <tr><td><strong>Authorization Server</strong></td><td>Выдаёт токены (Google, Auth0, Keycloak)</td></tr>
      <tr><td><strong>Resource Server</strong></td><td>API, защищённое токеном</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-fork"></i> Основные flow</div>

    <div class="card"><h3>Authorization Code (с PKCE)</h3><p class="text">Стандарт для веб и мобайл с 2020. Юзер логинится на AS → получает authorization_code → клиент обменивает на access_token. PKCE (Proof Key for Code Exchange) защищает от перехвата code: client генерирует <code>code_verifier</code>, посылает <code>code_challenge</code> = SHA256(verifier), при обмене предъявляет verifier. Без знания verifier перехваченный code бесполезен.</p></div>

    <div class="card"><h3>Client Credentials</h3><p class="text">Машина-к-машине. Сервис аутентифицируется client_id + client_secret. Нет пользователя. Используется для бэкенд-к-бэкенд интеграций.</p></div>

    <div class="card"><h3>Refresh Token</h3><p class="text">Длинноживущий токен для получения новых access_token без повторного логина. Хранится только в защищённой части клиента (никогда в браузере без httpOnly).</p></div>

    <div class="card"><h3>Implicit (deprecated)</h3><p class="text">Старый flow для SPA, теперь deprecated. SPA должен использовать Authorization Code + PKCE.</p></div>

    <div class="card"><h3>Resource Owner Password Credentials (deprecated)</h3><p class="text">Клиент передаёт пароль на AS. Только для legacy миграций; современные системы &mdash; не используйте.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Authorization Code + PKCE: шаги</div>
<pre><code><span class="c-comment">1. Client → AS: GET /authorize?</span>
<span class="c-comment">     client_id=app&amp;</span>
<span class="c-comment">     redirect_uri=https://app.com/callback&amp;</span>
<span class="c-comment">     response_type=code&amp;</span>
<span class="c-comment">     scope=openid profile email&amp;</span>
<span class="c-comment">     code_challenge=&lt;SHA256(verifier)&gt;&amp;</span>
<span class="c-comment">     code_challenge_method=S256&amp;</span>
<span class="c-comment">     state=&lt;random&gt;</span>

<span class="c-comment">2. User логинится на AS, подтверждает scope</span>

<span class="c-comment">3. AS → Client: redirect to https://app.com/callback?code=&lt;CODE&gt;&amp;state=&lt;random&gt;</span>

<span class="c-comment">4. Client → AS: POST /token</span>
<span class="c-comment">     grant_type=authorization_code&amp;</span>
<span class="c-comment">     code=&lt;CODE&gt;&amp;</span>
<span class="c-comment">     redirect_uri=...&amp;</span>
<span class="c-comment">     client_id=app&amp;</span>
<span class="c-comment">     code_verifier=&lt;VERIFIER&gt;</span>

<span class="c-comment">5. AS возвращает: {</span>
<span class="c-comment">     "access_token": "&lt;JWT or opaque&gt;",</span>
<span class="c-comment">     "refresh_token": "&lt;opaque&gt;",</span>
<span class="c-comment">     "id_token": "&lt;JWT — OIDC only&gt;",</span>
<span class="c-comment">     "expires_in": 3600</span>
<span class="c-comment">   }</span>
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>state</code> параметр забыт.</strong> Без проверки state в callback &mdash; CSRF на OAuth: атакующий заставляет жертву привязать свой аккаунт. State генерируется клиентом, проверяется при возврате.</div>
    <div class="pitfall"><strong>2. redirect_uri без whitelist.</strong> AS должен валидировать redirect_uri против заранее зарегистрированного списка. Иначе атакующий перенаправит code на свой URL.</div>
    <div class="pitfall"><strong>3. PKCE для конфиденциальных клиентов «не нужен».</strong> Современные best practices: PKCE для ВСЕХ flow, даже для бэкенд-клиентов с secret.</div>
    <div class="pitfall"><strong>4. Кеш access_token в браузере без httpOnly.</strong> XSS читает токен. Используйте httpOnly cookie с SameSite=Lax.</div>
    <div class="pitfall"><strong>5. Скоупы «по умолчанию» широкие.</strong> Запрашивайте минимум нужного (<code>openid profile email</code>), не <code>*</code>. Пользователь видит ваш consent screen.</div>
    <div class="pitfall"><strong>6. <code>id_token</code> для авторизации API.</strong> id_token &mdash; для аутентификации (кто это). access_token &mdash; для авторизации API (что может). Не путайте.</div>
    <div class="pitfall"><strong>7. Refresh token rotation.</strong> При использовании refresh AS должен выдать новый refresh, инвалидировать старый. Защита от повторного использования украденного.</div>
    <div class="pitfall"><strong>8. Не проверена подпись id_token.</strong> Доверять id_token без проверки сигнатуры &mdash; принять любой JWT от атакующего. Используйте JWKS endpoint AS для получения публичных ключей.</div>
  </div>
</div>

<div id="sec-authz" class="section">
  <div class="section-title">Authorization: RBAC / ABAC / ReBAC</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Аутентификация отвечает «кто», авторизация &mdash; «что может». Модели авторизации различаются гранулярностью: RBAC (роли) подходит для большинства SaaS, ABAC (атрибуты) &mdash; для сложной бизнес-логики, ReBAC (отношения) &mdash; для соц-сетей и доступа к объектам по графу связей.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Три модели</div>

    <div class="card"><h3>RBAC &mdash; Role-Based Access Control</h3><p class="text">Каждый пользователь имеет роли (admin, editor, viewer); роль имеет набор разрешений. Простая модель, проверка «можешь ли удалять» &rarr; «есть ли у тебя роль editor». Не подходит когда правила зависят от объекта (свой/чужой пост).</p></div>

    <div class="card"><h3>ABAC &mdash; Attribute-Based</h3><p class="text">Решение основано на атрибутах пользователя, объекта, действия и контекста. Пример: «менеджер региона X может видеть отчёты только своего региона». RBAC такое не выражает, ABAC &mdash; элементарно.</p></div>

    <div class="card"><h3>ReBAC &mdash; Relationship-Based</h3><p class="text">Доступ через граф отношений: «друг друга может видеть посты». Используется в Google Zanzibar, OpenFGA. Сложна в реализации, оправдана для соц-приложений.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> RBAC в Laravel через spatie/laravel-permission</div>
<pre><code><span class="c-comment">// composer require spatie/laravel-permission</span>

<span class="c-comment">// Назначить роль</span>
<span class="c-var">$user</span>-&gt;<span class="c-fn">assignRole</span>(<span class="c-str">'editor'</span>);
<span class="c-var">$user</span>-&gt;<span class="c-fn">givePermissionTo</span>(<span class="c-str">'edit articles'</span>);

<span class="c-comment">// Проверка</span>
<span class="c-key">if</span> (<span class="c-var">$user</span>-&gt;<span class="c-fn">can</span>(<span class="c-str">'edit articles'</span>)) { ... }
<span class="c-key">if</span> (<span class="c-var">$user</span>-&gt;<span class="c-fn">hasRole</span>(<span class="c-str">'admin'</span>)) { ... }

<span class="c-comment">// В route</span>
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/admin'</span>, ...)-&gt;<span class="c-fn">middleware</span>(<span class="c-str">'role:admin'</span>);
<span class="c-type">Route</span>::<span class="c-fn">get</span>(<span class="c-str">'/posts/edit'</span>, ...)-&gt;<span class="c-fn">middleware</span>(<span class="c-str">'permission:edit articles'</span>);

<span class="c-comment">// В Blade</span>
@<span class="c-fn">can</span>(<span class="c-str">'edit articles'</span>)
    &lt;<span class="c-key">a</span> href=<span class="c-str">"..."</span>&gt;<span class="c-key">Edit</span>&lt;/<span class="c-key">a</span>&gt;
@<span class="c-fn">endcan</span>
</code></pre>

    <p class="text">Для ABAC-логики (свой/чужой пост) используйте Policies (см. KB_3 раздел Auth). Комбинация Spatie roles + Policies покрывает 95% задач.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. IDOR (Insecure Direct Object Reference).</strong> <code>/orders/{id}</code> без проверки владения. Атакующий перебирает id и читает чужие заказы. Используйте Policies или scoped bindings.</div>
    <div class="pitfall"><strong>2. Проверка только на UI.</strong> Скрытая кнопка <code>Edit</code> в blade при <code>@can</code> &mdash; UI-фасад. Атакующий шлёт POST напрямую. Проверяйте на endpoint всегда.</div>
    <div class="pitfall"><strong>3. <code>is_admin</code> в массовом присваивании.</strong> <code>$user-&gt;update($request-&gt;all())</code> с <code>is_admin</code> в FormRequest &mdash; пользователь сделал себя админом. Whitelist через <code>$fillable</code>.</div>
    <div class="pitfall"><strong>4. Privilege escalation через cookie.</strong> Роль хранится в cookie на клиенте. Атакующий редактирует cookie. Роль &mdash; только в БД, не в клиентском состоянии.</div>
    <div class="pitfall"><strong>5. Race condition при назначении ролей.</strong> Два запроса одновременно назначают противоречивые роли. Транзакция + блокировка.</div>
    <div class="pitfall"><strong>6. Дефолтная роль с лишними правами.</strong> Новый пользователь сразу получает <code>editor</code>, потому что «удобно». Должен быть <code>viewer</code>, с явным повышением.</div>
    <div class="pitfall"><strong>7. Permissions кешируются неинвалидно.</strong> После revoke права в кеше старая роль ещё работает 10 минут. Инвалидируйте кеш в момент изменения.</div>
    <div class="pitfall"><strong>8. Audit без перечисления попыток.</strong> Логируйте отказы в авторизации &mdash; это сигнал brute-force на привилегии.</div>
  </div>
</div>

<div id="sec-csrf" class="section">
  <div class="section-title">CSRF (Cross-Site Request Forgery)</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">CSRF &mdash; атака, при которой злонамеренный сайт заставляет браузер жертвы (уже авторизованной на целевом сайте) отправить запрос. Браузер автоматически прикрепляет cookie сессии &mdash; целевой сервер «верит» что это легитимный запрос пользователя. Защита &mdash; токен, который атакующий не может прочитать.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Механизмы защиты</div>

    <div class="card"><h3>CSRF token (synchronizer token pattern)</h3><p class="text">Сервер генерирует случайный токен на сессию, кладёт в форму. При submit браузер передаёт токен; сервер сравнивает с сохранённым. Атакующий сайт не может прочитать токен (CORS) &mdash; не подделает запрос.</p></div>

    <div class="card"><h3>SameSite cookie</h3><p class="text"><code>Set-Cookie: session=...; SameSite=Strict</code> &mdash; браузер не отправляет cookie при кросс-доменных запросах. <code>Lax</code> &mdash; отправляет только при top-level навигации. <code>None</code> &mdash; всегда отправляет (требует <code>Secure</code>). Strict/Lax почти полностью убирают CSRF.</p></div>

    <div class="card"><h3>Double-submit cookie</h3><p class="text">Альтернатива для stateless API: токен в cookie + тот же токен в заголовке (X-CSRF-TOKEN). Атакующий не читает cookie (XHR с другого домена не имеет доступа), не подставит заголовок.</p></div>

    <div class="card"><h3>Origin / Referer проверка</h3><p class="text">Сервер проверяет, что заголовок Origin (или Referer) совпадает с собственным доменом. Защита fallback, ненадёжна сама по себе.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: Laravel CSRF</div>
<pre><code><span class="c-comment">{{-- Blade: @csrf директива добавляет hidden input --}}</span>
&lt;<span class="c-key">form</span> method=<span class="c-str">"POST"</span> action=<span class="c-str">"/orders"</span>&gt;
    @<span class="c-fn">csrf</span>
    &lt;<span class="c-key">input</span> name=<span class="c-str">"product_id"</span>&gt;
    &lt;<span class="c-key">button</span>&gt;<span class="c-key">Buy</span>&lt;/<span class="c-key">button</span>&gt;
&lt;/<span class="c-key">form</span>&gt;
</code></pre>

<pre><code><span class="c-comment">// AJAX: токен из meta-тега + заголовок</span>
&lt;<span class="c-key">meta</span> name=<span class="c-str">"csrf-token"</span> content=<span class="c-str">"{{ csrf_token() }}"</span>&gt;

<span class="c-comment">// fetch / axios</span>
<span class="c-fn">fetch</span>(<span class="c-str">'/api/orders'</span>, {
    method: <span class="c-str">'POST'</span>,
    headers: {
        <span class="c-str">'X-CSRF-TOKEN'</span>: <span class="c-fn">document</span>.<span class="c-fn">querySelector</span>(<span class="c-str">'meta[name="csrf-token"]'</span>).<span class="c-var">content</span>,
        <span class="c-str">'Content-Type'</span>: <span class="c-str">'application/json'</span>,
    },
    body: <span class="c-type">JSON</span>.<span class="c-fn">stringify</span>({...}),
});
</code></pre>

    <p class="text">Laravel middleware <code>VerifyCsrfToken</code> в группе <code>web</code> автоматически проверяет POST/PUT/PATCH/DELETE. API-маршруты (через Sanctum/JWT) не нужны в CSRF-защите, поскольку используют stateless токены.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. CSRF для GET-запросов.</strong> GET не должен менять состояние. Если меняет (deprecated <code>GET /logout</code>) &mdash; атакующая <code>&lt;img src&gt;</code> разлогинит пользователя.</div>
    <div class="pitfall"><strong>2. <code>VerifyCsrfToken::$except</code> для удобства.</strong> Webhook'и (Stripe, GitHub) приходят без CSRF &mdash; в <code>$except</code>. Но добавление случайного endpoint &laquo;временно&raquo; открывает дыру.</div>
    <div class="pitfall"><strong>3. <code>SameSite=None</code> без <code>Secure</code>.</strong> Браузеры с 2020 блокируют такие cookie. Если нужен кросс-домен &mdash; всегда <code>Secure</code> и HTTPS.</div>
    <div class="pitfall"><strong>4. CSRF в SPA с Sanctum.</strong> Sanctum для SPA использует session cookie + CSRF (это &laquo;stateful&raquo; режим). Для мобайл/external API &mdash; bearer токены без CSRF.</div>
    <div class="pitfall"><strong>5. Long-lived CSRF token.</strong> Токен не должен пережить логаут. Регенерируйте при auth-операциях.</div>
    <div class="pitfall"><strong>6. CSRF через JSON API без preflight.</strong> Простые запросы (form-encoded POST) идут без preflight CORS. Применяйте <code>Content-Type: application/json</code> &mdash; вызывает preflight, дополнительная защита.</div>
    <div class="pitfall"><strong>7. CSRF на основе hidden form field в одном домене.</strong> Если same-origin policy уже защищает, токен дублирует. На multi-domain &mdash; обязателен.</div>
    <div class="pitfall"><strong>8. Замена токена в каждом запросе.</strong> Излишне: один токен на сессию достаточен. Замена усложняет UX (несколько вкладок), не добавляет защиты.</div>
  </div>
</div>

<div id="sec-xss" class="section">
  <div class="section-title">XSS (Cross-Site Scripting)</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">XSS &mdash; внедрение JavaScript в страницу, отображаемую другим пользователем. JS исполняется в его браузере с правами вашего домена: читает cookie, session, делает запросы. Защита &mdash; правильное экранирование при выводе + Content Security Policy.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Три типа XSS</div>
    <div class="card"><h3>Reflected XSS</h3><p class="text">Параметр запроса попадает в HTML без экранирования. <code>/search?q=&lt;script&gt;...&lt;/script&gt;</code> &mdash; атакующий шлёт жертве ссылку, при клике запускается JS. Лечится экранированием.</p></div>
    <div class="card"><h3>Stored XSS</h3><p class="text">Вредоносный код сохраняется в БД (комментарий, профиль) и показывается всем пользователям. Самый опасный тип &mdash; не требует социального инжиниринга.</p></div>
    <div class="card"><h3>DOM-based XSS</h3><p class="text">Атака на клиентский JS: <code>document.write(location.hash)</code> без escape. Сервер не видит атаки &mdash; защита только в браузере.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика в Laravel</div>
<pre><code><span class="c-comment">{{-- ✓ Безопасно: {{ }} экранирует HTML --}}</span>
&lt;<span class="c-key">div</span>&gt;{{ <span class="c-var">$comment</span>-&gt;<span class="c-var">text</span> }}&lt;/<span class="c-key">div</span>&gt;
<span class="c-comment">{{-- &lt;script&gt;alert(1)&lt;/script&gt; → &amp;lt;script&amp;gt;alert(1)&amp;lt;/script&amp;gt; --}}</span>

<span class="c-comment">{{-- ❌ Опасно: {!! !!} выводит как есть --}}</span>
&lt;<span class="c-key">div</span>&gt;{!! <span class="c-var">$comment</span>-&gt;<span class="c-var">html</span> !!}&lt;/<span class="c-key">div</span>&gt;

<span class="c-comment">{{-- Если нужен HTML — санитизируйте через HtmlPurifier --}}</span>
&lt;<span class="c-key">div</span>&gt;{!! <span class="c-type">Purifier</span>::<span class="c-fn">clean</span>(<span class="c-var">$comment</span>-&gt;<span class="c-var">html</span>) !!}&lt;/<span class="c-key">div</span>&gt;
</code></pre>

    <p class="text"><strong>Content Security Policy</strong> &mdash; вторая линия. Заголовок указывает браузеру, откуда можно загружать скрипты:</p>

<pre><code>Content-Security-Policy: default-src <span class="c-str">'self'</span>; script-src <span class="c-str">'self'</span> https://cdn.example.com;
                          style-src  <span class="c-str">'self'</span> <span class="c-str">'unsafe-inline'</span>;
                          img-src    <span class="c-str">'self'</span> data: https:;
                          object-src <span class="c-str">'none'</span>
</code></pre>

    <p class="text">Даже если XSS внедрился, без разрешения inline-скриптов он не выполнится. CSP меняет правила: атакующему нужно ещё обойти политику.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. JSON в HTML без escape.</strong> <code>&lt;script&gt;var data = {{ $data }};&lt;/script&gt;</code> &mdash; если data содержит <code>&lt;/script&gt;</code>, scope script ломается. Используйте <code>@json($data)</code>.</div>
    <div class="pitfall"><strong>2. URL атрибут без validation.</strong> <code>&lt;a href="{{ $link }}"&gt;</code> &mdash; если link = <code>javascript:alert(1)</code>, клик запускает JS. Валидируйте схему: только http/https.</div>
    <div class="pitfall"><strong>3. CSV-injection.</strong> Экспорт пользовательских данных в CSV. Если значение начинается с <code>=</code>, <code>+</code>, <code>-</code>, <code>@</code> &mdash; Excel выполнит как формулу. Префиксируйте кавычкой.</div>
    <div class="pitfall"><strong>4. <code>v-html</code> в Vue, <code>dangerouslySetInnerHTML</code> в React.</strong> Прямой аналог <code>{!! !!}</code>. Только после санитизации.</div>
    <div class="pitfall"><strong>5. CSP с <code>'unsafe-inline'</code> в script-src.</strong> Делает CSP бесполезной для XSS-защиты. Используйте nonces или hashes для legitimate inline скриптов.</div>
    <div class="pitfall"><strong>6. SVG-файлы как картинки.</strong> SVG может содержать JS. Не используйте user-uploaded SVG как <code>&lt;img src&gt;</code>; конвертируйте в PNG.</div>
    <div class="pitfall"><strong>7. <code>X-XSS-Protection</code> deprecated.</strong> Старый header игнорируется современными браузерами. Полагайтесь на CSP.</div>
    <div class="pitfall"><strong>8. Sanitizer-библиотеки старой версии.</strong> HtmlPurifier, DOMPurify периодически находят bypass'ы. Обновляйте.</div>
  </div>
</div>

<div id="sec-sqli" class="section">
  <div class="section-title">SQL Injection</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">SQL Injection &mdash; внедрение SQL-кода через пользовательский ввод. Атакующий шлёт <code>' OR 1=1 --</code> в поле, оригинальный запрос становится <code>SELECT * FROM users WHERE name = '' OR 1=1 --'</code>, возвращая всех пользователей. Защита одна и абсолютна: <strong>prepared statements</strong>. Конкатенация SQL с пользовательским вводом &mdash; всегда уязвимость.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Типы инъекций</div>
    <table class="data-table">
      <tr><th>Тип</th><th>Описание</th></tr>
      <tr><td><strong>Classic / Inband</strong></td><td>Атакующий видит результат: <code>UNION SELECT password FROM users</code></td></tr>
      <tr><td><strong>Blind boolean</strong></td><td>Результат не виден, но атакующий смотрит на разницу в ответе (<code>AND 1=1</code> vs <code>AND 1=2</code>)</td></tr>
      <tr><td><strong>Time-based blind</strong></td><td>Атакующий измеряет задержку (<code>AND IF(..., SLEEP(5), 0)</code>)</td></tr>
      <tr><td><strong>Out-of-band</strong></td><td>Эксфильтрация через DNS-запросы к контролируемому домену</td></tr>
      <tr><td><strong>Second-order</strong></td><td>Вредоносный ввод сохраняется в БД, эксплуатируется при последующем запросе</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Защита: prepared statements</div>
<pre><code><span class="c-comment">// ❌ Уязвимо — конкатенация</span>
<span class="c-var">$users</span> = <span class="c-type">DB</span>::<span class="c-fn">select</span>(<span class="c-str">"SELECT * FROM users WHERE email = '"</span> . <span class="c-var">$_GET</span>[<span class="c-str">'email'</span>] . <span class="c-str">"'"</span>);

<span class="c-comment">// ✓ Безопасно — параметр через ?</span>
<span class="c-var">$users</span> = <span class="c-type">DB</span>::<span class="c-fn">select</span>(<span class="c-str">'SELECT * FROM users WHERE email = ?'</span>, [<span class="c-var">$_GET</span>[<span class="c-str">'email'</span>]]);

<span class="c-comment">// ✓ Eloquent — bindings автоматически</span>
<span class="c-type">User</span>::<span class="c-fn">where</span>(<span class="c-str">'email'</span>, <span class="c-var">$_GET</span>[<span class="c-str">'email'</span>])-&gt;<span class="c-fn">first</span>();

<span class="c-comment">// ⚠ DB::raw с пользовательским вводом — снова уязвимо</span>
<span class="c-type">DB</span>::<span class="c-fn">table</span>(<span class="c-str">'users'</span>)-&gt;<span class="c-fn">whereRaw</span>(<span class="c-str">"email = '"</span> . <span class="c-var">$_GET</span>[<span class="c-str">'email'</span>] . <span class="c-str">"'"</span>);

<span class="c-comment">// ✓ DB::raw с bindings — безопасно</span>
<span class="c-type">DB</span>::<span class="c-fn">table</span>(<span class="c-str">'users'</span>)-&gt;<span class="c-fn">whereRaw</span>(<span class="c-str">'email = ?'</span>, [<span class="c-var">$_GET</span>[<span class="c-str">'email'</span>]]);
</code></pre>

    <p class="text">Eloquent защищает 100% случаев, если использовать parametr binding. Опасные точки: <code>DB::raw</code>, <code>whereRaw</code>, <code>orderByRaw</code> &mdash; при ручной конкатенации.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Имена таблиц/колонок через переменные.</strong> Prepared statements не параметризируют идентификаторы. <code>orderBy($_GET['sort'])</code> &mdash; SQL injection. Whitelist значений.</div>
    <div class="pitfall"><strong>2. LIKE с пользовательским вводом.</strong> Prepared statement защищает от SQL injection, но не от LIKE-метасимволов <code>%</code>, <code>_</code>. Экранируйте или ограничьте.</div>
    <div class="pitfall"><strong>3. Динамический <code>WHERE IN (?)</code> с массивом.</strong> Laravel автоматически разворачивает массив. Без библиотеки &mdash; вручную: <code>'?' . str_repeat(',?', count($ids)-1)</code>.</div>
    <div class="pitfall"><strong>4. NoSQL injection.</strong> MongoDB: <code>db.users.find({email: req.body.email, password: req.body.password})</code> с <code>{$ne: null}</code> в password обходит проверку. Тоже валидируйте.</div>
    <div class="pitfall"><strong>5. Stored procedures с конкатенацией.</strong> SP, выполняющая <code>EXECUTE</code> с конкатенированным SQL &mdash; уязвима так же, как app-код.</div>
    <div class="pitfall"><strong>6. ORM с разрешением сырых выражений.</strong> Eloquent <code>whereRaw</code>, Doctrine <code>->andWhere('u.name = '. $name)</code> &mdash; те же грабли.</div>
    <div class="pitfall"><strong>7. Логи запросов с user input.</strong> При компрометации логов атакующий видит структуру запросов, легче угадывает injection points.</div>
    <div class="pitfall"><strong>8. Минимальные привилегии БД-пользователя.</strong> Web-приложение коннектится с правами на SELECT/INSERT/UPDATE. DROP, ALTER, GRANT &mdash; отдельный пользователь для миграций. Уменьшает blast radius успешной инъекции.</div>
  </div>
</div>

<div id="sec-cors" class="section">
  <div class="section-title">CORS (Cross-Origin Resource Sharing)</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">CORS &mdash; механизм, через который сервер разрешает (или запрещает) браузерам с других доменов делать запросы. По умолчанию same-origin policy запрещает чтение ответа на кросс-доменный запрос. CORS &mdash; контролируемое исключение. Неправильная настройка CORS = открытый API для любого сайта в интернете.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Механизм</div>
    <div class="card"><h3>Simple request</h3><p class="text">GET / POST с <code>Content-Type: application/x-www-form-urlencoded</code>, <code>multipart/form-data</code>, <code>text/plain</code>. Браузер отправляет запрос с заголовком <code>Origin</code>. Сервер отвечает <code>Access-Control-Allow-Origin</code>. Если совпадает &mdash; JS получает ответ.</p></div>

    <div class="card"><h3>Preflight (OPTIONS)</h3><p class="text">Для сложных запросов (custom headers, <code>Content-Type: application/json</code>, методы кроме GET/POST/HEAD) браузер сначала шлёт OPTIONS. Сервер должен ответить с <code>Access-Control-Allow-Methods</code>, <code>Access-Control-Allow-Headers</code>. Только потом &mdash; реальный запрос.</p></div>

    <div class="card"><h3>Credentials</h3><p class="text"><code>Access-Control-Allow-Credentials: true</code> + клиент с <code>credentials: include</code> &mdash; cookie отправляются с кросс-доменным запросом. <strong>Origin не может быть <code>*</code></strong>: при credentials = true он должен быть точным доменом.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: config/cors.php</div>
<pre><code><span class="c-key">return</span> [
    <span class="c-str">'paths'</span> =&gt; [<span class="c-str">'api/*'</span>, <span class="c-str">'sanctum/csrf-cookie'</span>],
    <span class="c-str">'allowed_methods'</span>      =&gt; [<span class="c-str">'GET'</span>, <span class="c-str">'POST'</span>, <span class="c-str">'PUT'</span>, <span class="c-str">'PATCH'</span>, <span class="c-str">'DELETE'</span>],
    <span class="c-str">'allowed_origins'</span>      =&gt; [<span class="c-str">'https://app.example.com'</span>], <span class="c-comment">// явно, не '*'</span>
    <span class="c-str">'allowed_origins_patterns'</span> =&gt; [],
    <span class="c-str">'allowed_headers'</span>      =&gt; [<span class="c-str">'*'</span>],
    <span class="c-str">'exposed_headers'</span>      =&gt; [],
    <span class="c-str">'max_age'</span>             =&gt; <span class="c-num">3600</span>,  <span class="c-comment">// кеш preflight</span>
    <span class="c-str">'supports_credentials'</span>=&gt; <span class="c-key">true</span>,  <span class="c-comment">// для cookie-auth</span>
];
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. <code>Access-Control-Allow-Origin: *</code>.</strong> Открывает API для любого сайта. Допустимо только для публичных read-only API без credentials. Любой private API &mdash; явный whitelist.</div>
    <div class="pitfall"><strong>2. Reflecting Origin без проверки.</strong> <code>header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN'])</code> &mdash; все домены проходят. Атакующий получит доступ.</div>
    <div class="pitfall"><strong>3. CORS не защищает.</strong> CORS &mdash; о чтении ответа в браузере. Атакующий может слать запросы (POST формы), просто не видит ответа. CORS не заменяет CSRF.</div>
    <div class="pitfall"><strong>4. Preflight кешируется надолго.</strong> <code>Access-Control-Max-Age: 86400</code> &mdash; preflight кешируется на сутки. Меняешь CORS-настройки &mdash; пользователи не видят новые до конца кеша.</div>
    <div class="pitfall"><strong>5. <code>credentials: include</code> без обдумывания.</strong> Включение в fetch заставляет посылать cookie. Если эндпоинт не должен принимать аутентифицированные запросы &mdash; не включайте.</div>
    <div class="pitfall"><strong>6. CORS для public CDN.</strong> Если статика на CDN, и приложение делает fetch к этому CDN &mdash; нужен CORS на CDN-стороне. Часто упускается.</div>
    <div class="pitfall"><strong>7. <code>http://localhost:3000</code> в production-config.</strong> Dev-origin остаётся в проде &mdash; локальные приложения других разработчиков могут читать ваше API.</div>
    <div class="pitfall"><strong>8. CORS не работает в WebView.</strong> Мобильные WebView могут отключать CORS или вести себя иначе. Тестируйте на реальных платформах.</div>
  </div>
</div>

<div id="sec-ratelimit" class="section">
  <div class="section-title">Rate Limiting и защита от brute-force</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Rate limiting &mdash; ограничение числа запросов от одного источника за интервал времени. Защищает от: brute-force паролей, credential stuffing, scraping, DDoS уровня приложения, перегрузки API. Без rate limiting один скрипт с одной машины может потушить ваш сервис или перебрать миллионы паролей.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Стратегии</div>
    <div class="card"><h3>По IP</h3><p class="text">Самый простой: N запросов в минуту с одного IP. Минусы: NAT (один IP &mdash; много пользователей), IPv6 (легко получить новые IP). Подходит для unauthenticated endpoints.</p></div>
    <div class="card"><h3>По user_id (после auth)</h3><p class="text">Лимит для аутентифицированных. Защищает от случая, когда легитимный пользователь злоупотребляет.</p></div>
    <div class="card"><h3>По API-ключу</h3><p class="text">Для публичных API: разные тарифы &mdash; разные лимиты. Stripe, GitHub.</p></div>
    <div class="card"><h3>Sliding window / Token bucket</h3><p class="text">Алгоритмы:<br><strong>Fixed window</strong> &mdash; 100 запросов в минуту, счётчик ресетается каждую минуту (проблема: burst на границе).<br><strong>Sliding window log</strong> &mdash; список таймстампов, точно но дорого.<br><strong>Token bucket</strong> &mdash; бюджет токенов, регенерируется со временем (стандарт API limit'ов).</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Laravel throttle</div>
<pre><code><span class="c-comment">// routes/web.php</span>
<span class="c-type">Route</span>::<span class="c-fn">post</span>(<span class="c-str">'/login'</span>, <span class="c-type">LoginController</span>::<span class="c-key">class</span>)
    -&gt;<span class="c-fn">middleware</span>(<span class="c-str">'throttle:5,1'</span>); <span class="c-comment">// 5 попыток в минуту с IP</span>

<span class="c-comment">// API с лимитом на user</span>
<span class="c-type">Route</span>::<span class="c-fn">middleware</span>([<span class="c-str">'auth:sanctum'</span>, <span class="c-str">'throttle:60,1'</span>])-&gt;<span class="c-fn">group</span>(<span class="c-key">function</span> () {
    <span class="c-type">Route</span>::<span class="c-fn">apiResource</span>(<span class="c-str">'orders'</span>, <span class="c-type">OrderController</span>::<span class="c-key">class</span>);
});

<span class="c-comment">// Кастомный лимит — RouteServiceProvider boot()</span>
<span class="c-type">RateLimiter</span>::<span class="c-fn">for</span>(<span class="c-str">'login'</span>, <span class="c-key">function</span> (<span class="c-type">Request</span> <span class="c-var">$request</span>) {
    <span class="c-key">return</span> [
        <span class="c-type">Limit</span>::<span class="c-fn">perMinute</span>(<span class="c-num">5</span>)-&gt;<span class="c-fn">by</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">input</span>(<span class="c-str">'email'</span>)),
        <span class="c-type">Limit</span>::<span class="c-fn">perMinute</span>(<span class="c-num">30</span>)-&gt;<span class="c-fn">by</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">ip</span>()),
    ];
});
</code></pre>
    <p class="text">Лучшая практика для login: лимит и по email, и по IP. Защищает от перебора паролей одного пользователя и от credential stuffing с одного источника.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Только IP-throttle на login.</strong> Атакующий c ботнетом из 10к IP пройдёт. Throttle по email/user_id обязателен.</div>
    <div class="pitfall"><strong>2. Лимит за прокси / load balancer.</strong> Без правильной настройки <code>TrustProxies</code> Laravel видит IP балансировщика, не пользователя &mdash; все запросы &laquo;с одного IP&raquo;.</div>
    <div class="pitfall"><strong>3. Слишком жёсткий лимит на legit-endpoint.</strong> <code>throttle:10,1</code> на autocomplete &mdash; пользователь набирает быстро, лимит исчерпан. Тюнингуйте по UX.</div>
    <div class="pitfall"><strong>4. Лимит без сообщения.</strong> 429 без понятного объяснения &mdash; пользователь не понимает. Возвращайте <code>Retry-After</code> заголовок и человеческое сообщение.</div>
    <div class="pitfall"><strong>5. Хранение counter'ов в БД.</strong> На больших нагрузках лучше Redis с <code>INCR</code> и <code>EXPIRE</code> &mdash; on-disk counter создаёт hot row.</div>
    <div class="pitfall"><strong>6. Account lockout без логирования.</strong> Lockout без записи в audit-лог &mdash; не видим атаки. Логируйте каждое срабатывание.</div>
    <div class="pitfall"><strong>7. Lockout как DoS-вектор.</strong> Атакующий шлёт неудачные логины на email жертвы, блокирует её аккаунт. Используйте exponential backoff, не permanent lock.</div>
    <div class="pitfall"><strong>8. Rate limit на CDN-уровне игнорирует app-аутентификацию.</strong> CloudFlare видит cookie, но не знает auth. Координируйте app-throttle и edge-throttle.</div>
  </div>
</div>

<div id="sec-tls" class="section">
  <div class="section-title">HTTPS, TLS, mTLS</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">TLS &mdash; криптографический протокол, обеспечивающий три свойства: <strong>конфиденциальность</strong> (никто посередине не читает), <strong>целостность</strong> (никто не изменил), <strong>аутентичность сервера</strong> (это действительно тот, кем себя называет). Без TLS любой Wi-Fi в кафе видит ваши пароли. Современный стандарт &mdash; TLS 1.3, минимум приемлемо &mdash; TLS 1.2.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Базовые понятия</div>
    <div class="card"><h3>Сертификаты и CA</h3><p class="text">Сертификат сервера подписан Certificate Authority (Let's Encrypt, DigiCert). Браузер доверяет CA &rarr; верит сертификату. Сертификат содержит публичный ключ сервера, домен, expiry.</p></div>
    <div class="card"><h3>TLS Handshake</h3><p class="text">Клиент и сервер договариваются о cipher suite, обмениваются ключами через ECDHE (forward secrecy), сервер доказывает владение private key. TLS 1.3 &mdash; 1 round-trip; TLS 1.2 &mdash; 2 round-trip.</p></div>
    <div class="card"><h3>Forward Secrecy</h3><p class="text">Сессионный ключ не может быть восстановлен из private key сервера. Если private key утечёт завтра &mdash; старый трафик остаётся незашифрованным. Требует ECDHE/DHE.</p></div>
    <div class="card"><h3>mTLS (Mutual TLS)</h3><p class="text">И клиент, и сервер предъявляют сертификаты. Используется для bot-to-bot аутентификации, между микросервисами в service mesh.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Практика: nginx с Let's Encrypt</div>
<pre><code><span class="c-comment"># nginx config</span>
<span class="c-key">server</span> {
    <span class="c-key">listen</span> <span class="c-num">443</span> <span class="c-key">ssl http2</span>;
    <span class="c-key">server_name</span> <span class="c-var">example.com</span>;

    <span class="c-key">ssl_certificate</span>     /etc/letsencrypt/live/example.com/fullchain.pem;
    <span class="c-key">ssl_certificate_key</span> /etc/letsencrypt/live/example.com/privkey.pem;

    <span class="c-key">ssl_protocols</span>         TLSv1.2 TLSv1.3;
    <span class="c-key">ssl_ciphers</span>           ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256:...;
    <span class="c-key">ssl_prefer_server_ciphers</span> on;
    <span class="c-key">ssl_session_cache</span>     shared:SSL:10m;
    <span class="c-key">ssl_session_tickets</span>   off;

    <span class="c-comment"># HSTS</span>
    <span class="c-key">add_header</span> Strict-Transport-Security <span class="c-str">"max-age=31536000; includeSubDomains; preload"</span> always;
}

<span class="c-comment"># HTTP → HTTPS редирект</span>
<span class="c-key">server</span> {
    <span class="c-key">listen</span> <span class="c-num">80</span>;
    <span class="c-key">server_name</span> <span class="c-var">example.com</span>;
    <span class="c-key">return</span> <span class="c-num">301</span> https://$host$request_uri;
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. TLS 1.0/1.1 ещё включены.</strong> Старые версии уязвимы (BEAST, POODLE). Только 1.2+, лучше 1.3.</div>
    <div class="pitfall"><strong>2. <code>RC4</code>, <code>3DES</code>, <code>MD5</code> ciphers.</strong> Слабые алгоритмы. Используйте Mozilla SSL config generator для актуального списка.</div>
    <div class="pitfall"><strong>3. Expired certificate.</strong> Браузер показывает страшное предупреждение. Auto-renewal через certbot.</div>
    <div class="pitfall"><strong>4. Mixed content.</strong> HTTPS-страница с <code>&lt;script src="http://..."&gt;</code> &mdash; браузер блокирует. Все ресурсы по HTTPS.</div>
    <div class="pitfall"><strong>5. HSTS без preload.</strong> Первый визит уязвим. <code>preload</code> + HSTS-список Chrome исключает первый запрос.</div>
    <div class="pitfall"><strong>6. Wildcard certificate утёк.</strong> Один <code>*.example.com</code> в любой системе &mdash; компрометация всех поддоменов. Лучше per-subdomain.</div>
    <div class="pitfall"><strong>7. TLS termination на LB.</strong> Терминируется на balancer, дальше до app &mdash; HTTP. Промежуточный трафик в private network уязвим, если кто-то получит доступ.</div>
    <div class="pitfall"><strong>8. Certificate transparency monitor.</strong> Не мониторите CT-логи &mdash; не узнаете, что для вашего домена кто-то выпустил неавторизованный сертификат.</div>
  </div>
</div>

<div id="sec-headers" class="section">
  <div class="section-title">Security Headers</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Security headers &mdash; HTTP-заголовки, инструктирующие браузер усиливать защиту. Это дешёвая защита: одна строка конфига даёт многократно сложнее атаки. Чек-лист, который должна пройти любая production-страница: HSTS, CSP, X-Frame-Options, X-Content-Type-Options, Referrer-Policy, Permissions-Policy.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Основные заголовки</div>
    <table class="data-table">
      <tr><th>Header</th><th>Что делает</th></tr>
      <tr><td><code>Strict-Transport-Security</code></td><td>Браузер ходит только по HTTPS. Защита от downgrade-attack</td></tr>
      <tr><td><code>Content-Security-Policy</code></td><td>Whitelist источников скриптов/стилей/картинок. Защита от XSS</td></tr>
      <tr><td><code>X-Frame-Options: DENY</code></td><td>Запрет iframe. Защита от clickjacking</td></tr>
      <tr><td><code>X-Content-Type-Options: nosniff</code></td><td>Браузер не угадывает MIME. Защита от MIME-confusion</td></tr>
      <tr><td><code>Referrer-Policy</code></td><td>Контроль того, что попадает в Referer. <code>strict-origin-when-cross-origin</code> &mdash; разумный дефолт</td></tr>
      <tr><td><code>Permissions-Policy</code></td><td>Whitelist API браузера: camera, microphone, geolocation</td></tr>
      <tr><td><code>Cross-Origin-Opener-Policy</code></td><td>Изоляция от других origin. Защита от Spectre-class</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Middleware в Laravel</div>
<pre><code><span class="c-key">final class</span> <span class="c-type">SecurityHeaders</span>
{
    <span class="c-key">public function</span> <span class="c-fn">handle</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>, <span class="c-type">Closure</span> <span class="c-var">$next</span>): <span class="c-type">Response</span>
    {
        <span class="c-var">$response</span> = <span class="c-var">$next</span>(<span class="c-var">$request</span>);

        <span class="c-var">$response</span>-&gt;<span class="c-fn">headers</span>-&gt;<span class="c-fn">add</span>([
            <span class="c-str">'Strict-Transport-Security'</span>   =&gt; <span class="c-str">'max-age=31536000; includeSubDomains; preload'</span>,
            <span class="c-str">'X-Frame-Options'</span>             =&gt; <span class="c-str">'DENY'</span>,
            <span class="c-str">'X-Content-Type-Options'</span>      =&gt; <span class="c-str">'nosniff'</span>,
            <span class="c-str">'Referrer-Policy'</span>             =&gt; <span class="c-str">'strict-origin-when-cross-origin'</span>,
            <span class="c-str">'Permissions-Policy'</span>          =&gt; <span class="c-str">'camera=(), microphone=(), geolocation=()'</span>,
            <span class="c-str">'Content-Security-Policy'</span>     =&gt; <span class="c-str">"default-src 'self'; script-src 'self' 'nonce-{$nonce}'; img-src 'self' data: https:;"</span>,
        ]);

        <span class="c-key">return</span> <span class="c-var">$response</span>;
    }
}
</code></pre>
    <p class="text">Готовый пакет: <code>bepsvpt/secure-headers</code> &mdash; конфиг + middleware. Тест собственных заголовков &mdash; <code>securityheaders.com</code>.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. CSP сразу строгая в проде.</strong> Включит панику и сломает legitimate скрипты (analytics, ads). Сначала <code>Content-Security-Policy-Report-Only</code> &mdash; собирайте отчёты, потом включайте.</div>
    <div class="pitfall"><strong>2. HSTS preload без подготовки.</strong> Преinload &mdash; на годы. Если решите вернуться на HTTP &mdash; пользователи не смогут (страницы недоступны). Готовьтесь к долгосрочной HTTPS-only.</div>
    <div class="pitfall"><strong>3. <code>X-Frame-Options: ALLOW-FROM</code>.</strong> Не поддерживается Chrome. Используйте <code>frame-ancestors</code> в CSP.</div>
    <div class="pitfall"><strong>4. CSP с <code>'unsafe-eval'</code>.</strong> Многие фреймворки требуют. Делает CSP слабее. Постарайтесь обойтись без или используйте strict-dynamic.</div>
    <div class="pitfall"><strong>5. Кеширование заголовков на CDN.</strong> CDN может кешировать ответ с заголовками; изменение в коде не сразу видно пользователям. Vary headers, purge cache.</div>
    <div class="pitfall"><strong>6. <code>Server: nginx/1.18.0</code>.</strong> Раскрытие версии помогает атакующему. Скройте через <code>server_tokens off</code>.</div>
    <div class="pitfall"><strong>7. Заголовки только на HTML, не на API.</strong> API тоже должны иметь HSTS, CORS, CSP. Применяйте middleware ко всем маршрутам.</div>
    <div class="pitfall"><strong>8. Не тестируется.</strong> securityheaders.com даёт оценку A+ до F. Должно быть в CI: автоматическая проверка после деплоя.</div>
  </div>
</div>

<div id="sec-secrets" class="section">
  <div class="section-title">Secrets Management</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book-open"></i> Назначение</div>
    <p class="text">Секреты (API-ключи, DB-пароли, JWT-секреты, OAuth client_secret) не должны храниться в коде. Гит-история помнит навсегда; удалённые из последнего коммита секреты остаются в истории, доступны через <code>git log -p</code>. Современная практика: переменные окружения для dev, секреты-менеджер (Vault, AWS Secrets Manager) для prod.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list"></i> Уровни хранения</div>
    <div class="card"><h3>.env (dev)</h3><p class="text">Переменные окружения в файле <code>.env</code>, исключённом из git. Подходит для локальной разработки. Не для production.</p></div>
    <div class="card"><h3>Container env (prod basic)</h3><p class="text">Docker secrets / Kubernetes secrets / системные env vars. Достаточно для маленьких проектов. Минусы: rotate означает рестарт; нет audit-trail.</p></div>
    <div class="card"><h3>Secrets manager (prod scale)</h3><p class="text">HashiCorp Vault, AWS Secrets Manager, GCP Secret Manager. Динамическое получение секретов, auto-rotation, audit-логи. Сложнее в setup'е.</p></div>
    <div class="card"><h3>HSM (high security)</h3><p class="text">Hardware Security Module &mdash; private keys никогда не покидают железо. Для финансовых, медицинских данных.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hammer"></i> Минимальные правила</div>
    <ul class="bullets">
      <li><code>.env</code> в <code>.gitignore</code> и в <code>.dockerignore</code>;</li>
      <li><code>.env.example</code> со всеми ключами без значений &mdash; в git;</li>
      <li>Pre-commit hook сканирует коммиты на secrets (<code>git-secrets</code>, <code>gitleaks</code>, <code>trufflehog</code>);</li>
      <li>В CI &mdash; secrets через защищённые переменные (GitHub Secrets, GitLab CI variables);</li>
      <li>На production &mdash; не <code>.env</code>, а env vars через secrets manager;</li>
      <li>Rotate секретов после ухода каждого сотрудника, после инцидента;</li>
      <li>Принцип наименьших привилегий: каждый сервис имеет только свои ключи.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Особые случаи</div>
    <div class="pitfall"><strong>1. Случайно закоммитили секрет.</strong> Удаление из последующего коммита бесполезно &mdash; в истории остаётся. Rotate ключ <em>немедленно</em>, потом cleanup через <code>git filter-repo</code>.</div>
    <div class="pitfall"><strong>2. <code>config:cache</code> с env-ссылками в коде.</strong> Если в коде <code>env('STRIPE_KEY')</code> вне config-файлов &mdash; после <code>config:cache</code> вернёт null. Только в config/, в коде &mdash; <code>config('services.stripe.key')</code>.</div>
    <div class="pitfall"><strong>3. Секреты в логах.</strong> Случайное логирование запроса с Authorization header. Маскируйте через middleware на уровне логгера.</div>
    <div class="pitfall"><strong>4. <code>.env</code> в Docker image.</strong> ADD .env в Dockerfile &mdash; секреты в image, который потом утечёт в registry. Передавайте через env vars при запуске.</div>
    <div class="pitfall"><strong>5. Одинаковые секреты везде.</strong> Один JWT-секрет в dev/staging/prod. Утечка с dev = компрометация prod. Уникальные значения на окружение.</div>
    <div class="pitfall"><strong>6. CI artifacts хранят секреты.</strong> Build-логи в публичных PR могут содержать env vars. Маскируйте секреты в CI (<code>::add-mask::</code> в GitHub Actions).</div>
    <div class="pitfall"><strong>7. Long-lived OAuth tokens в файлах.</strong> Token live forever &mdash; утечка катастрофична. Refresh + revoke.</div>
    <div class="pitfall"><strong>8. <code>chmod 644</code> на <code>.env</code>.</strong> Доступно всем пользователям сервера. <code>chmod 600</code> + правильный owner.</div>
  </div>
</div>

<div id="sec-practice" class="section">
  <div class="section-title">Практика: security review модуля</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> Постановка</div>
    <p class="text">Разработчик принёс на ревью endpoint загрузки аватарки. Сделаем поэтапный security-review, отмечая уязвимости.</p>

<pre><code><span class="c-comment">// ❌ Множество проблем — найдите все</span>
<span class="c-key">final class</span> <span class="c-type">AvatarController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">upload</span>(<span class="c-type">Request</span> <span class="c-var">$request</span>)
    {
        <span class="c-var">$user</span> = <span class="c-type">User</span>::<span class="c-fn">find</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">input</span>(<span class="c-str">'user_id'</span>));
        <span class="c-var">$file</span> = <span class="c-var">$request</span>-&gt;<span class="c-fn">file</span>(<span class="c-str">'avatar'</span>);
        <span class="c-var">$name</span> = <span class="c-var">$file</span>-&gt;<span class="c-fn">getClientOriginalName</span>();
        <span class="c-var">$file</span>-&gt;<span class="c-fn">move</span>(<span class="c-fn">public_path</span>(<span class="c-str">'avatars'</span>), <span class="c-var">$name</span>);
        <span class="c-var">$user</span>-&gt;<span class="c-fn">update</span>([<span class="c-str">'avatar'</span> =&gt; <span class="c-str">"/avatars/{$name}"</span>]);
        <span class="c-key">return</span> [<span class="c-str">'url'</span> =&gt; <span class="c-str">"/avatars/{$name}"</span>];
    }
}
</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="bug"></i> Найденные уязвимости</div>
    <div class="pitfall"><strong>A01 Broken Access Control:</strong> <code>user_id</code> из запроса &mdash; любой может загрузить аватарку другому. Должно быть <code>$request-&gt;user()</code>.</div>
    <div class="pitfall"><strong>Path traversal:</strong> <code>getClientOriginalName()</code> может вернуть <code>../../etc/passwd</code>. Используйте <code>Str::random()</code> + расширение из mime.</div>
    <div class="pitfall"><strong>MIME spoofing / RCE:</strong> Нет проверки типа файла. PHP-файл может быть загружен и выполнен. <code>$request-&gt;validate(['avatar' =&gt; 'image|mimes:jpg,png|max:2048'])</code>.</div>
    <div class="pitfall"><strong>SVG XSS:</strong> Если разрешён SVG &mdash; внутри может быть JS. Конвертируйте в PNG через Intervention Image.</div>
    <div class="pitfall"><strong>DoS через большой файл:</strong> Без <code>max:2048</code> &mdash; пользователь грузит 10 GB.</div>
    <div class="pitfall"><strong>Public folder:</strong> Файлы попадают в <code>public/avatars/</code> &mdash; нет контроля доступа. Используйте <code>storage/app/private/avatars/</code> + signed URLs.</div>
    <div class="pitfall"><strong>Race condition:</strong> Два параллельных загрузки с одним именем &mdash; одна перезаписывается. <code>Str::uuid()</code> для уникальности.</div>
    <div class="pitfall"><strong>Отсутствие rate limiting:</strong> Пользователь может загрузить 1000 файлов и забить storage.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle-2"></i> Безопасная версия</div>
<pre><code><span class="c-key">final class</span> <span class="c-type">AvatarController</span>
{
    <span class="c-key">public function</span> <span class="c-fn">__construct</span>(<span class="c-key">private</span> <span class="c-type">AvatarUploader</span> <span class="c-var">$uploader</span>) {}

    <span class="c-key">public function</span> <span class="c-fn">upload</span>(<span class="c-type">UploadAvatarRequest</span> <span class="c-var">$request</span>): <span class="c-type">JsonResponse</span>
    {
        <span class="c-var">$path</span> = <span class="c-var">$this</span>-&gt;<span class="c-var">uploader</span>-&gt;<span class="c-fn">store</span>(<span class="c-var">$request</span>-&gt;<span class="c-fn">user</span>(), <span class="c-var">$request</span>-&gt;<span class="c-fn">file</span>(<span class="c-str">'avatar'</span>));

        <span class="c-key">return</span> <span class="c-fn">response</span>()-&gt;<span class="c-fn">json</span>([<span class="c-str">'url'</span> =&gt; <span class="c-fn">route</span>(<span class="c-str">'avatar.show'</span>, [<span class="c-str">'path'</span> =&gt; <span class="c-var">$path</span>])]);
    }
}

<span class="c-comment">// FormRequest решает: auth + validate</span>
<span class="c-key">final class</span> <span class="c-type">UploadAvatarRequest</span> <span class="c-key">extends</span> <span class="c-type">FormRequest</span>
{
    <span class="c-key">public function</span> <span class="c-fn">authorize</span>(): <span class="c-key">bool</span> { <span class="c-key">return</span> <span class="c-var">$this</span>-&gt;<span class="c-fn">user</span>() !== <span class="c-key">null</span>; }

    <span class="c-key">public function</span> <span class="c-fn">rules</span>(): <span class="c-key">array</span>
    {
        <span class="c-key">return</span> [
            <span class="c-str">'avatar'</span> =&gt; [<span class="c-str">'required'</span>, <span class="c-str">'image'</span>, <span class="c-str">'mimes:jpg,png,webp'</span>, <span class="c-str">'max:2048'</span>, <span class="c-str">'dimensions:max_width=2000,max_height=2000'</span>],
        ];
    }
}

<span class="c-comment">// Маршрут с throttle</span>
<span class="c-type">Route</span>::<span class="c-fn">post</span>(<span class="c-str">'/avatar'</span>, [<span class="c-type">AvatarController</span>::<span class="c-key">class</span>, <span class="c-str">'upload'</span>])
    -&gt;<span class="c-fn">middleware</span>([<span class="c-str">'auth:sanctum'</span>, <span class="c-str">'throttle:5,60'</span>]); <span class="c-comment">// 5 загрузок в час</span>
</code></pre>
  </div>
</div>

<div id="sec-pitfalls" class="section">
  <div class="section-title">Сводные подводные камни безопасности</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Топ-12</div>
    <div class="pitfall"><strong>1. APP_DEBUG=true в production.</strong> Раскрывает stack traces со структурой кода, конфигом, секретами. Всегда <code>false</code>.</div>
    <div class="pitfall"><strong>2. Mass assignment без <code>$fillable</code>.</strong> <code>User::create($request-&gt;all())</code> с <code>is_admin</code> в payload.</div>
    <div class="pitfall"><strong>3. IDOR.</strong> <code>/orders/{id}</code> без проверки владения. Используйте Policies + scopeBindings.</div>
    <div class="pitfall"><strong>4. Хардкод секрета.</strong> API-ключ в коде &mdash; навсегда в git-истории.</div>
    <div class="pitfall"><strong>5. <code>{!! $userInput !!}</code> в Blade.</strong> Прямой XSS. Используйте <code>{{ }}</code>.</div>
    <div class="pitfall"><strong>6. Загрузка файлов без MIME-проверки.</strong> RCE через php-файл с расширением jpg.</div>
    <div class="pitfall"><strong>7. CORS с <code>*</code> + credentials.</strong> Открыт для любого сайта.</div>
    <div class="pitfall"><strong>8. JWT в localStorage.</strong> Любой XSS читает. Используйте httpOnly cookie.</div>
    <div class="pitfall"><strong>9. Brute-force только по IP.</strong> Ботнет обходит. Throttle по email/user.</div>
    <div class="pitfall"><strong>10. Server-Side Request Forgery (SSRF).</strong> <code>file_get_contents($_GET['url'])</code> &mdash; атакующий шлёт <code>http://169.254.169.254/</code> и читает AWS metadata.</div>
    <div class="pitfall"><strong>11. Сертификат на 10 лет.</strong> Long-lived сертификаты &mdash; больше окно компрометации. Let's Encrypt &mdash; 90 дней с auto-rotate.</div>
    <div class="pitfall"><strong>12. Отсутствие audit-логов.</strong> Инцидент произошёл &mdash; не знаем когда, кем, что. Логируйте успешные/неуспешные логины, изменения прав, удаление данных.</div>
  </div>
</div>

<div id="sec-interview" class="section">
  <div class="section-title">Вопросы на собеседование</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield-alert"></i> Базовые</div>
    <div class="card"><h3>1. Чем аутентификация отличается от авторизации?</h3><p class="text">Аутентификация — «кто этот пользователь» (проверка identity). Авторизация — «что он может сделать» (проверка permissions). Без аутентификации нет авторизации (никто = нет прав).</p></div>
    <div class="card"><h3>2. Почему MD5 нельзя использовать для паролей?</h3><p class="text">MD5 спроектирован быстрым — на GPU перебор 100M+ хешей в секунду. База с MD5-паролями вскрывается за часы. Для паролей нужны медленные адаптивные функции: bcrypt (~250мс на хеш), argon2id.</p></div>
    <div class="card"><h3>3. Что такое OWASP Top 10 и почему важно?</h3><p class="text">Индустриальный список 10 самых критичных уязвимостей веба, обновляемый каждые 3-4 года OWASP Foundation. Обязательный чек-лист для любого production. Версия 2021 включает Broken Access Control (#1), Cryptographic Failures, Injection, Insecure Design.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cookie"></i> Атаки на сессии</div>
    <div class="card"><h3>4. Что такое CSRF и какие механизмы защиты?</h3><p class="text">Cross-Site Request Forgery — злонамеренный сайт заставляет браузер жертвы с активной сессией отправить запрос. Защита: (1) CSRF token в формах + проверка сервером; (2) SameSite=Strict cookie — браузер не отправляет cookie кросс-доменно; (3) double-submit cookie для stateless API; (4) проверка Origin/Referer.</p></div>
    <div class="card"><h3>5. Чем httpOnly cookie защищён от XSS, а localStorage нет?</h3><p class="text">httpOnly cookie недоступен из JavaScript — даже если XSS-payload выполнился, он не прочитает cookie. localStorage и обычные cookie читаются через JS (<code>localStorage.getItem</code>, <code>document.cookie</code>). При выборе хранения токена httpOnly cookie предпочтительнее для защиты от XSS.</p></div>
    <div class="card"><h3>6. Что такое clickjacking и как защититься?</h3><p class="text">Атакующий встраивает ваш сайт в iframe на своём сайте, накладывает прозрачные элементы, обманывает пользователя кликнуть на ваш интерфейс. Защита — заголовок <code>X-Frame-Options: DENY</code> или CSP <code>frame-ancestors 'none'</code> — браузер запрещает встраивание.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="key"></i> OAuth / JWT</div>
    <div class="card"><h3>7. Объясните Authorization Code Flow с PKCE</h3><p class="text">(1) Client генерирует <code>code_verifier</code> (random string) и <code>code_challenge</code> = SHA256(verifier). (2) Перенаправляет user на AS с challenge. (3) User логинится, AS возвращает <code>code</code>. (4) Client обменивает code на access_token, предъявляя verifier — AS проверяет, что SHA256(verifier) = challenge. (5) AS возвращает токены. PKCE защищает от перехвата code: без verifier code бесполезен.</p></div>
    <div class="card"><h3>8. Какая разница между JWT и opaque token?</h3><p class="text">JWT — самодостаточный токен; payload + signature, проверяется без обращения к серверу аутентификации (stateless). Opaque token — случайная строка; чтобы получить данные, нужно запросить auth server (stateful). JWT масштабируется лучше (нет round-trip), но revocation сложнее. Opaque revoke мгновенно (удаление из БД).</p></div>
    <div class="card"><h3>9. Почему JWT с <code>alg=none</code> опасен?</h3><p class="text">Старые JWT-библиотеки принимали алгоритм <code>none</code> — signature не проверялась. Атакующий менял header на <code>{"alg":"none"}</code>, ставил пустой signature, сервер «верил» payload. Современные библиотеки явно блокируют <code>none</code>. При выборе библиотеки убедитесь в защите.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="database"></i> SQL Injection</div>
    <div class="card"><h3>10. Защищает ли ORM от SQL injection полностью?</h3><p class="text">Eloquent через параметризированные запросы защищает 100%, если использовать стандартные методы (<code>where</code>, <code>insert</code>, <code>update</code>). Опасные точки: <code>DB::raw()</code>, <code>whereRaw</code>, <code>orderByRaw</code> с конкатенацией пользовательского ввода. Имена таблиц/колонок не параметризируются — для динамических нужен whitelist.</p></div>
    <div class="card"><h3>11. Что такое second-order SQL injection?</h3><p class="text">Вредоносный ввод проходит через первый запрос (сохраняется в БД), и эксплуатируется во втором запросе, который использует сохранённое значение в небезопасной конкатенации. Защита: prepared statements <em>везде</em>, не только на входе пользователя.</p></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="lock"></i> Транспорт</div>
    <div class="card"><h3>12. Что такое HSTS и зачем preload?</h3><p class="text">HTTP Strict Transport Security — заголовок, инструктирующий браузер всегда ходить по HTTPS. Защита от downgrade-атаки (man-in-the-middle принуждает HTTP). <code>preload</code> добавляет домен в встроенный список Chrome — даже первый запрос идёт по HTTPS, нет окна для атаки.</p></div>
    <div class="card"><h3>13. Что такое forward secrecy?</h3><p class="text">Свойство TLS: сессионный ключ не может быть восстановлен из private key сервера. Если private key утечёт, старый записанный трафик остаётся незашифрованным. Достигается через ECDHE (Ephemeral Diffie-Hellman) — новый ключ для каждой сессии.</p></div>
    <div class="card"><h3>14. Что делает Content Security Policy?</h3><p class="text">CSP — заголовок с whitelist источников скриптов, стилей, изображений. Защита от XSS: даже если payload внедрён в HTML, браузер откажется выполнить inline-скрипт без разрешения. Лучшая практика: <code>default-src 'self'; script-src 'self' 'nonce-XXX'</code> — nonce для legitimate inline скриптов.</p></div>
    <div class="card"><h3>15. Что такое SSRF и пример?</h3><p class="text">Server-Side Request Forgery — атакующий заставляет сервер делать HTTP-запросы по контролируемому URL. Классический пример: <code>file_get_contents($_GET['url'])</code> &mdash; атакующий шлёт <code>http://169.254.169.254/latest/meta-data/iam/</code> (AWS instance metadata) и получает IAM credentials сервера. Защита: whitelist разрешённых доменов, запрет приватных IP-диапазонов, отдельный сервис для outbound requests.</p></div>
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
