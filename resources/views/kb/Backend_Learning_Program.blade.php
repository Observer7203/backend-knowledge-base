@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Backend PHP/Laravel — Программа Обучения</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --bg:            #F5F8FA;
    --surface:       #FFFFFF;
    --surface2:      #F9FAFB;
    --border:        #E4E6EF;
    --text:          #181C32;
    --text2:         #7E8299;
    --text3:         #A1A5B7;
    --primary:       #404357;
    --primary-light: #EFF2F5;
    --purple:        #7239EA;
    --purple-light:  #F8F5FF;
    --success:       #50CD89;
    --success-light: #E8FFF3;
    --success-dark:  #0D7D53;
    --warning:       #FFC700;
    --warning-light: #FFF8DD;
    --warning-dark:  #B45309;
    --danger:        #F1416C;
    --danger-light:  #FFF5F8;
    --blue:          #009EF7;
    --blue-light:    #EEF7FF;
    --orange:        #E65100;
    --orange-light:  #FFF3E0;
    --shadow:        0 2px 10px rgba(24,28,50,0.07);
    --shadow-hover:  0 6px 20px rgba(24,28,50,0.11);
    --radius:        10px;
  }

  * { margin:0; padding:0; box-sizing:border-box; }

  body {
    font-family: 'Inter', -apple-system, sans-serif;
    background: var(--bg);
    color: var(--text);
    line-height: 1.6;
    min-height: 100vh;
    -webkit-font-smoothing: antialiased;
    font-size: 14px;
  }

  /* ── Sidebar layout ── */
  .sidebar {
    background: var(--surface);
    padding: 24px 14px;
    position: fixed;
    width: 260px;
    height: 100vh;
    overflow-y: auto;
    border-right: 1px solid var(--border);
    box-shadow: 2px 0 8px rgba(24,28,50,0.04);
    z-index: 100;
  }
  .sidebar-back {
    display: flex; align-items: center; gap: 7px;
    padding: 8px 10px; margin-bottom: 14px;
    color: var(--primary); text-decoration: none;
    border-radius: 7px; font-size: 12px; font-weight: 600;
    transition: background 0.2s;
  }
  .sidebar-back:hover { background: var(--primary-light); }
  .sidebar-back svg { width: 14px; height: 14px; }
  .sidebar-title {
    font-size: 11px; font-weight: 800; color: var(--text3);
    text-transform: uppercase; letter-spacing: 1.2px;
    margin-bottom: 10px; padding-bottom: 12px;
    border-bottom: 1px solid var(--border);
  }
  .sidebar-nav-label {
    font-size: 10px; font-weight: 700; color: var(--text3);
    text-transform: uppercase; letter-spacing: 0.8px;
    padding: 10px 12px 4px;
  }
  .sidebar-nav-item {
    display: flex; align-items: center; gap: 8px;
    padding: 8px 12px; margin-bottom: 2px;
    color: var(--text2); text-decoration: none;
    border-radius: 8px; font-size: 13px; font-weight: 500;
    border: 1px solid transparent; transition: all 0.18s;
  }
  .sidebar-nav-item svg { width: 14px; height: 14px; flex-shrink: 0; }
  .sidebar-nav-item:hover { background: var(--bg); color: var(--primary); border-color: var(--border); }
  .sidebar-nav-item.active { background: var(--primary-light); color: var(--primary); font-weight: 600; border-color: rgba(64,67,87,0.25); }

  .app { margin-left: 260px; padding: 24px 40px 60px; min-width: 0; width: calc(100vw - 260px); }

  /* ── Back link ── */
  .back-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: var(--primary);
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    padding: 7px 12px;
    border-radius: 7px;
    margin-bottom: 16px;
    transition: background 0.2s;
  }
  .back-link:hover { background: var(--primary-light); }
  .back-link svg { width: 14px; height: 14px; }

  /* ── Header ── */
  .header {
    text-align: center;
    padding: 44px 32px 40px;
    margin-bottom: 24px;
    background: var(--surface);
    border-radius: 14px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
  }
  .header h1 { font-size: 1.9rem; font-weight: 800; margin-bottom: 8px; color: var(--text); letter-spacing: -0.4px; }
  .header h1 span { color: var(--primary); }
  .header p { color: var(--text2); font-size: 0.9rem; }

  /* ── Stats ── */
  .stats-bar {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 10px;
    margin-bottom: 24px;
  }
  .stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 14px 16px;
    text-align: center;
    box-shadow: var(--shadow);
  }
  .stat-card .num { font-size: 1.7rem; font-weight: 800; display: block; line-height: 1; margin-bottom: 4px; }
  .stat-card .label { color: var(--text2); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
  .stat-card.green .num  { color: var(--success-dark); }
  .stat-card.yellow .num { color: var(--warning-dark); }
  .stat-card.red .num    { color: var(--danger); }
  .stat-card.blue .num   { color: var(--primary); }

  /* ── Tabs ── */
  .tabs {
    display: flex;
    gap: 4px;
    margin-bottom: 20px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 5px;
    box-shadow: var(--shadow);
    flex-wrap: wrap;
  }
  .tab {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 16px;
    border-radius: 7px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    color: var(--text2);
    transition: all 0.18s;
    border: none;
    background: transparent;
    font-family: 'Inter', -apple-system, sans-serif;
    white-space: nowrap;
  }
  .tab svg { width: 14px; height: 14px; }
  .tab:hover { background: var(--bg); color: var(--text); }
  .tab.active { background: var(--primary); color: #fff; }

  /* ── Tab sections ── */
  .section { display: none; }
  .section.active { display: block; }

  /* ── Search box ── */
  .search-wrap { position: relative; margin-bottom: 16px; }
  .search-wrap .search-icon {
    position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
    color: var(--text3); pointer-events: none;
  }
  .search-wrap .search-icon svg { width: 14px; height: 14px; }
  .search-box {
    width: 100%;
    padding: 10px 16px 10px 38px;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 13.5px;
    font-family: 'Inter', -apple-system, sans-serif;
    background: var(--surface);
    color: var(--text);
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    box-shadow: var(--shadow);
  }
  .search-box:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(64,67,87,0.1); }
  .search-box::placeholder { color: var(--text3); }

  /* ── Filter row ── */
  .filter-row { display: flex; gap: 6px; margin-bottom: 16px; flex-wrap: wrap; }
  .filter-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 7px 13px;
    border-radius: 7px;
    cursor: pointer;
    font-size: 12.5px;
    font-weight: 600;
    color: var(--text2);
    background: var(--surface);
    border: 1px solid var(--border);
    transition: all 0.18s;
    user-select: none;
  }
  .filter-btn svg { width: 13px; height: 13px; }
  .filter-btn:hover { border-color: var(--primary); color: var(--primary); background: var(--primary-light); }
  .filter-btn.active { background: var(--primary); color: #fff; border-color: var(--primary); }

  /* ── Note box ── */
  .note-box {
    background: var(--primary-light);
    border-left: 4px solid var(--primary);
    border-radius: 0 8px 8px 0;
    padding: 13px 18px;
    margin-bottom: 18px;
    font-size: 13.5px;
    color: var(--text);
    line-height: 1.65;
    display: flex;
    align-items: flex-start;
    gap: 10px;
  }
  .note-box svg { width: 16px; height: 16px; color: var(--primary); flex-shrink: 0; margin-top: 2px; }

  /* ── Phase cards (roadmap) ── */
  .phase {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    margin-bottom: 10px;
    box-shadow: var(--shadow);
    overflow: hidden;
    transition: box-shadow 0.2s;
  }
  .phase:hover { box-shadow: var(--shadow-hover); }
  .phase-header {
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    transition: background 0.18s;
  }
  .phase-header:hover { background: var(--bg); }
  .phase-left { flex: 1; min-width: 0; }
  .phase-title { font-weight: 700; font-size: 14px; color: var(--text); margin-bottom: 4px; }
  .phase-sub { color: var(--text2); font-size: 12px; margin-top: 2px; }
  .progress-bar { height: 4px; background: var(--border); border-radius: 2px; margin-top: 8px; width: 100%; max-width: 280px; }
  .progress-fill { height: 100%; border-radius: 2px; background: linear-gradient(90deg, var(--success), #74C0FC); transition: width 0.4s; }
  .phase-meta { display: flex; align-items: center; gap: 6px; flex-shrink: 0; margin-left: 16px; }
  .phase-badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 3px 9px; border-radius: 6px; font-size: 11px; font-weight: 700;
  }
  .phase-badge svg { width: 11px; height: 11px; }
  .badge-known  { background: var(--success-light); color: var(--success-dark); }
  .badge-review { background: var(--warning-light); color: var(--warning-dark); }
  .badge-new    { background: var(--primary-light);  color: var(--primary); }
  .phase-arrow { color: var(--text3); transition: transform 0.3s; display: flex; align-items: center; margin-left: 8px; }
  .phase-arrow svg { width: 16px; height: 16px; }
  .phase.open .phase-arrow { transform: rotate(180deg); }
  .phase-body { display: none; border-top: 1px solid var(--border); }
  .phase.open .phase-body { display: block; }

  /* ── Topics ── */
  .topic {
    display: flex; gap: 12px; align-items: flex-start;
    padding: 10px 20px; border-bottom: 1px solid var(--border);
    transition: background 0.15s; cursor: default;
  }
  .topic:last-child { border-bottom: none; }
  .topic:hover { background: var(--bg); }
  .topic-check {
    width: 20px; height: 20px; border-radius: 5px;
    border: 2px solid var(--border); cursor: pointer; flex-shrink: 0;
    margin-top: 1px; transition: all 0.18s;
    display: flex; align-items: center; justify-content: center;
  }
  .topic-check:hover { border-color: var(--success); }
  .topic-check.checked { background: var(--success); border-color: var(--success); }
  .topic-check.checked::after { content: '✓'; color: #fff; font-size: 11px; font-weight: 700; }
  .topic-info { flex: 1; min-width: 0; }
  .topic-name {
    font-weight: 600; font-size: 13.5px; color: var(--text);
    margin-bottom: 3px; display: flex; align-items: center; gap: 8px;
  }
  .topic-name.checked-text { text-decoration: line-through; opacity: 0.45; }
  .topic-desc { color: var(--text2); font-size: 12.5px; line-height: 1.55; }
  .topic-tags { margin-top: 5px; }
  .topic-tag { display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 10.5px; font-weight: 700; margin-right: 4px; }
  .tag-interview { background: var(--primary-light);  color: var(--primary); }
  .tag-practice  { background: var(--success-light);  color: var(--success-dark); }
  .tag-repeat    { background: var(--warning-light);  color: var(--warning-dark); }
  .tag-resource  { background: #EFF2F5; color: #5E6278; }
  .known-marker  { display: inline-block; width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
  .known-marker.full    { background: var(--success); }
  .known-marker.partial { background: var(--warning); }
  .known-marker.none    { background: var(--border); }

  /* ── Sub heading ── */
  .sub-heading {
    font-size: 11.5px; font-weight: 800; color: var(--text3);
    text-transform: uppercase; letter-spacing: 1.2px;
    margin: 22px 0 10px; display: flex; align-items: center; gap: 8px;
  }
  .sub-heading::before {
    content: ''; width: 3px; height: 14px;
    background: var(--primary); border-radius: 2px;
  }

  /* ── Schedule ── */
  .schedule-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
  }
  .schedule-grid { display: grid; grid-template-columns: 90px 1fr; }
  .schedule-week {
    padding: 12px 14px; background: var(--primary-light);
    color: var(--primary); font-weight: 700; font-size: 13px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: flex-start;
  }
  .schedule-content {
    padding: 12px 18px; font-size: 13px; color: var(--text2);
    border-bottom: 1px solid var(--border); line-height: 1.6;
  }
  .schedule-content strong { color: var(--text); }
  .review-tag {
    display: inline-flex; align-items: center; gap: 4px;
    background: var(--warning-light); color: var(--warning-dark);
    padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 700; margin-top: 5px;
  }

  /* ── Interview questions ── */
  .interview-q {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius); margin-bottom: 8px;
    box-shadow: var(--shadow); overflow: hidden; transition: border-color 0.2s;
  }
  .interview-q:hover { border-color: var(--primary); }
  .interview-q-header {
    padding: 13px 18px; display: flex; justify-content: space-between;
    align-items: center; cursor: pointer; gap: 12px;
    font-weight: 600; font-size: 13.5px; color: var(--text);
    transition: background 0.18s;
  }
  .interview-q-header:hover { background: var(--bg); }
  .q-header-left { display: flex; align-items: center; gap: 10px; flex: 1; min-width: 0; }
  .q-cat {
    background: var(--primary-light); color: var(--primary);
    padding: 2px 9px; border-radius: 5px; font-size: 11px; font-weight: 700;
    white-space: nowrap; flex-shrink: 0;
  }
  .q-chevron { color: var(--text3); flex-shrink: 0; transition: transform 0.3s; display: flex; }
  .q-chevron svg { width: 15px; height: 15px; }
  .interview-q.open .q-chevron { transform: rotate(180deg); }
  .interview-q-body {
    display: none; padding: 14px 18px; font-size: 13.5px;
    color: var(--text2); line-height: 1.75;
    border-top: 1px solid var(--border); background: var(--bg);
  }
  .interview-q.open .interview-q-body { display: block; }

  /* ── Resource cards ── */
  .resource-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius); padding: 15px 18px; margin-bottom: 8px;
    box-shadow: var(--shadow); transition: border-color 0.2s, box-shadow 0.2s;
  }
  .resource-card:hover { border-color: var(--primary); box-shadow: var(--shadow-hover); }
  .resource-header { display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; margin-bottom: 5px; }
  .resource-card h3 { font-size: 13.5px; font-weight: 700; color: var(--text); }
  .resource-rating { color: var(--warning); font-size: 12px; white-space: nowrap; }
  .resource-meta { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px; font-size: 12px; color: var(--text2); }
  .resource-level { background: var(--bg); border: 1px solid var(--border); color: var(--text2); padding: 1px 8px; border-radius: 4px; font-weight: 600; }
  .resource-cost { font-weight: 600; color: var(--text); }
  .resource-free { background: var(--success-light); color: var(--success-dark); padding: 1px 8px; border-radius: 4px; font-weight: 700; }
  .resource-desc { color: var(--text2); font-size: 12.5px; line-height: 1.55; }
  .resource-link {
    display: inline-flex; align-items: center; gap: 4px;
    color: var(--primary); font-size: 12px; text-decoration: none;
    font-weight: 500; margin-top: 6px; transition: opacity 0.2s;
  }
  .resource-link:hover { text-decoration: underline; }
  .resource-link svg { width: 11px; height: 11px; }

  /* ── Obsidian ── */
  .obsidian-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius); margin-bottom: 10px;
    box-shadow: var(--shadow); overflow: hidden; transition: box-shadow 0.2s;
  }
  .obsidian-card:hover { box-shadow: var(--shadow-hover); }
  .obsidian-header {
    padding: 14px 18px; display: flex; justify-content: space-between;
    align-items: center; cursor: pointer; transition: background 0.18s; gap: 12px;
  }
  .obsidian-header:hover { background: var(--bg); }
  .obsidian-title { font-weight: 700; font-size: 13.5px; color: var(--text); }
  .obsidian-files { color: var(--text3); font-size: 12px; margin-top: 2px; }
  .obsidian-right { display: flex; align-items: center; gap: 8px; flex-shrink: 0; }
  .level-badge { padding: 3px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; }
  .obsidian-body { display: none; border-top: 1px solid var(--border); padding: 14px 18px; }
  .obsidian-card.open .obsidian-body { display: block; }
  .obs-section { margin-bottom: 10px; }
  .obs-section-title { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 5px; }
  .obs-section-title.good { color: var(--success-dark); }
  .obs-section-title.bad  { color: var(--danger); }
  .obs-text { color: var(--text2); font-size: 13px; line-height: 1.6; }

  @media(max-width: 768px) {
    .app { padding: 16px 14px 40px; }
    .stats-bar { grid-template-columns: repeat(2, 1fr); }
    .header h1 { font-size: 1.5rem; }
    .tabs { gap: 3px; }
    .tab { padding: 8px 10px; font-size: 12px; }
    .phase-meta { display: none; }
    .schedule-grid { grid-template-columns: 60px 1fr; }
  }

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

<!-- ── SIDEBAR ── -->
<div class="sidebar">
  <a href="/" class="sidebar-back"><i data-lucide="arrow-left"></i> На главную</a>
  <div class="sidebar-title">Knowledge Base</div>

  <div class="sidebar-nav-label">Языки и фреймворки</div>
  <a href="/KB_1_PHP_Core" class="sidebar-nav-item"><i data-lucide="code-2"></i> PHP Core</a>
  <a href="/KB_2_SQL_Database" class="sidebar-nav-item"><i data-lucide="database"></i> SQL & Database</a>
  <a href="/KB_3_Laravel" class="sidebar-nav-item"><i data-lucide="flame"></i> Laravel</a>

  <div class="sidebar-nav-label">Специальные темы</div>
  <a href="/KB_4_Security" class="sidebar-nav-item"><i data-lucide="shield-check"></i> Security</a>
  <a href="/KB_5_Architecture" class="sidebar-nav-item"><i data-lucide="layers"></i> Architecture</a>
  <a href="/KB_6_Testing_DevOps" class="sidebar-nav-item"><i data-lucide="terminal"></i> Testing & DevOps</a>

  <div class="sidebar-nav-label">Обучение</div>
  <a href="/Backend_Learning_Program" class="sidebar-nav-item active"><i data-lucide="map"></i> Программа обучения</a>
  <a href="/Schedule_Daily" class="sidebar-nav-item"><i data-lucide="calendar"></i> Расписание</a>
</div>

<div class="app" id="app">

  <div class="header">
    <h1>Backend <span>PHP / Laravel</span> — Полная Программа</h1>
    <p>Обучение · Повторение · Подготовка к собеседованиям · База знаний</p>
    <p style="margin-top:6px; font-size:0.82rem; color:var(--text3);">Sanzhar · Обновлено: Апрель 2026</p>
  </div>

  <!-- Stats -->
  <div class="stats-bar">
    <div class="stat-card green"><span class="num" id="stat-known">0</span><span class="label">Знаю</span></div>
    <div class="stat-card yellow"><span class="num" id="stat-review">0</span><span class="label">Повторить</span></div>
    <div class="stat-card red"><span class="num" id="stat-new">0</span><span class="label">Новые темы</span></div>
    <div class="stat-card blue"><span class="num" id="stat-total">0</span><span class="label">Всего тем</span></div>
  </div>

  <!-- Tabs -->
  <div class="tabs">
    <button class="tab active" onclick="switchTab('roadmap', this)"><i data-lucide="map"></i> Roadmap</button>
    <button class="tab" onclick="switchTab('schedule', this)"><i data-lucide="calendar"></i> Расписание</button>
    <button class="tab" onclick="switchTab('interview', this)"><i data-lucide="message-circle"></i> Собеседование</button>
    <button class="tab" onclick="switchTab('resources', this)"><i data-lucide="book-open"></i> Курсы & Ресурсы</button>
    <button class="tab" onclick="switchTab('obsidian', this)"><i data-lucide="notebook-pen"></i> Мои заметки</button>
  </div>

  <!-- ROADMAP -->
  <div class="section active" id="sec-roadmap">
    <div class="search-wrap">
      <span class="search-icon"><i data-lucide="search"></i></span>
      <input class="search-box" type="text" placeholder="Поиск по темам..." oninput="filterTopics(this.value)">
    </div>
    <div class="filter-row">
      <div class="filter-btn active" onclick="filterByStatus('all', this)"><i data-lucide="layers"></i> Все</div>
      <div class="filter-btn" onclick="filterByStatus('known', this)"><i data-lucide="check-circle"></i> Знаю</div>
      <div class="filter-btn" onclick="filterByStatus('review', this)"><i data-lucide="refresh-cw"></i> Повторить</div>
      <div class="filter-btn" onclick="filterByStatus('new', this)"><i data-lucide="plus-circle"></i> Новое</div>
    </div>
    <div id="roadmap-container"></div>
  </div>

  <!-- SCHEDULE -->
  <div class="section" id="sec-schedule">
    <div class="note-box">
      <i data-lucide="calendar-days"></i>
      Программа рассчитана на 16 недель. Каждую неделю: новые темы + повторение пройденного по методу интервального повторения. 1.5–2 часа в день.
    </div>
    <div id="schedule-container"></div>
  </div>

  <!-- INTERVIEW -->
  <div class="section" id="sec-interview">
    <div class="note-box">
      <i data-lucide="target"></i>
      Топ вопросов для собеседований на Backend PHP/Laravel разработчика. Кликните на вопрос чтобы увидеть ответ.
    </div>
    <div class="search-wrap">
      <span class="search-icon"><i data-lucide="search"></i></span>
      <input class="search-box" type="text" placeholder="Поиск вопросов..." oninput="filterQuestions(this.value)">
    </div>
    <div id="interview-container"></div>
  </div>

  <!-- RESOURCES -->
  <div class="section" id="sec-resources">
    <div class="filter-row">
      <div class="filter-btn active" onclick="filterResources('all', this)"><i data-lucide="grid-3x3"></i> Все</div>
      <div class="filter-btn" onclick="filterResources('php', this)"><i data-lucide="code-2"></i> PHP</div>
      <div class="filter-btn" onclick="filterResources('laravel', this)"><i data-lucide="flame"></i> Laravel</div>
      <div class="filter-btn" onclick="filterResources('backend', this)"><i data-lucide="server"></i> Backend</div>
      <div class="filter-btn" onclick="filterResources('ru', this)"><i data-lucide="globe"></i> Русский</div>
      <div class="filter-btn" onclick="filterResources('free', this)"><i data-lucide="gift"></i> Бесплатные</div>
    </div>
    <div id="resources-container"></div>
  </div>

  <!-- OBSIDIAN -->
  <div class="section" id="sec-obsidian">
    <div class="note-box">
      <i data-lucide="notebook-pen"></i>
      Анализ твоего Obsidian Vault. Что уже записано и на каком уровне — чтобы понимать что повторять, а что учить с нуля.
    </div>
    <div id="obsidian-container"></div>
  </div>

</div>

<script>

// ── DATA ─────────────────────────────────────────────────────────────────────

const roadmapData = [
  {
    title: "Фаза 1: PHP Core — Фундамент", duration: "Недели 1–3",
    topics: [
      { name: "Типы данных, переменные, операторы", status: "known", desc: "int, float, string, array, bool, объекты. Арифметические, сравнения, логические операторы.", tags: ["repeat"] },
      { name: "Управляющие конструкции (if/else, switch, match)", status: "known", desc: "Условия, тернарный оператор, null coalescing (??).", tags: ["repeat"] },
      { name: "Циклы (for, while, foreach, do-while)", status: "known", desc: "Итерация по массивам, break/continue.", tags: ["repeat"] },
      { name: "Функции (определение, параметры, возврат)", status: "known", desc: "Параметры по умолчанию, по ссылке, variadic args (...$args).", tags: ["repeat"] },
      { name: "Массивы углублённо", status: "review", desc: "array_map, array_filter, array_reduce, array_walk, usort, array_column, array_combine.", tags: ["repeat", "interview"] },
      { name: "Строковые функции", status: "review", desc: "str_contains, str_starts_with, mb_*, preg_match, sprintf, implode/explode.", tags: ["repeat"] },
      { name: "ООП: Классы и объекты", status: "review", desc: "Свойства, методы, конструкторы, $this, new, область видимости.", tags: ["repeat", "interview"] },
      { name: "ООП: Наследование и полиморфизм", status: "new", desc: "extends, parent::, переопределение методов, позднее статическое связывание (static::).", tags: ["interview"] },
      { name: "ООП: Абстрактные классы и интерфейсы", status: "new", desc: "abstract class vs interface, когда что использовать. implements vs extends.", tags: ["interview"] },
      { name: "ООП: Traits", status: "new", desc: "Горизонтальное переиспользование кода, конфликты, insteadof.", tags: ["interview"] },
      { name: "ООП: Магические методы", status: "new", desc: "__construct, __destruct, __get, __set, __call, __toString, __invoke, __clone.", tags: ["interview"] },
      { name: "Type Declarations & Strict Types", status: "new", desc: "declare(strict_types=1), типизация параметров и возврата, union types (PHP 8), nullable.", tags: ["interview"] },
      { name: "Namespaces и Autoloading (PSR-4)", status: "new", desc: "namespace, use, Composer autoload, PSR-4 стандарт.", tags: ["interview"] },
      { name: "Обработка ошибок (try/catch/finally)", status: "review", desc: "Exception классы, пользовательские исключения, Error vs Exception.", tags: ["interview"] },
      { name: "Работа с файлами", status: "review", desc: "fopen, fread, fwrite, file_get_contents, file_put_contents, JSON encode/decode.", tags: [] },
      { name: "PHP 8.x фичи", status: "new", desc: "Named arguments, match, enums, fibers, readonly properties, intersection types.", tags: ["interview"] },
    ]
  },
  {
    title: "Фаза 2: SQL & Базы данных", duration: "Недели 3–5",
    topics: [
      { name: "SQL основы (SELECT, INSERT, UPDATE, DELETE)", status: "known", desc: "CRUD операции, WHERE, ORDER BY, LIMIT, OFFSET.", tags: ["repeat"] },
      { name: "CREATE TABLE, типы данных, constraints", status: "known", desc: "PRIMARY KEY, FOREIGN KEY, UNIQUE, NOT NULL, DEFAULT, CHECK.", tags: ["repeat"] },
      { name: "JOIN'ы (INNER, LEFT, RIGHT, CROSS, SELF)", status: "review", desc: "Когда какой использовать, производительность, ON vs WHERE.", tags: ["repeat", "interview"] },
      { name: "Индексы", status: "review", desc: "Clustered, Non-clustered, Composite, Unique. B-tree vs Hash. Когда создавать.", tags: ["repeat", "interview"] },
      { name: "Оптимизация запросов & EXPLAIN", status: "review", desc: "EXPLAIN ANALYZE, чтение плана выполнения, bottleneck-и.", tags: ["repeat", "interview"] },
      { name: "Подзапросы (Subqueries)", status: "review", desc: "Коррелированные и некоррелированные, EXISTS, IN, subquery vs JOIN.", tags: ["repeat"] },
      { name: "Агрегатные функции & GROUP BY", status: "review", desc: "COUNT, SUM, AVG, MIN, MAX, HAVING, GROUP BY с несколькими полями.", tags: ["interview"] },
      { name: "Транзакции и ACID", status: "new", desc: "BEGIN, COMMIT, ROLLBACK, уровни изоляции, deadlocks.", tags: ["interview"] },
      { name: "Нормализация (1NF, 2NF, 3NF, BCNF)", status: "new", desc: "Зачем нормализовать, денормализация для производительности.", tags: ["interview"] },
      { name: "PDO & Prepared Statements", status: "known", desc: "Подключение к БД, привязка параметров, защита от SQL injection.", tags: ["repeat"] },
      { name: "Проектирование БД", status: "new", desc: "ER-диаграммы, связи (1:1, 1:N, N:M), pivot tables, полиморфные связи.", tags: ["interview"] },
      { name: "MySQL vs PostgreSQL", status: "new", desc: "Различия движков, InnoDB vs MyISAM, JSONB, полнотекстовый поиск.", tags: ["interview"] },
    ]
  },
  {
    title: "Фаза 3: Laravel Fundamentals", duration: "Недели 5–8",
    topics: [
      { name: "Жизненный цикл запроса Laravel", status: "review", desc: "index.php → bootstrap → HTTP Kernel → middleware → router → controller → response.", tags: ["repeat", "interview"] },
      { name: "Routing (маршрутизация)", status: "known", desc: "GET/POST/PUT/DELETE, параметры, группы, named routes, route model binding.", tags: ["repeat"] },
      { name: "Controllers", status: "known", desc: "Resource controllers, single action, dependency injection, form requests.", tags: ["repeat"] },
      { name: "Blade шаблонизатор", status: "known", desc: "@extends, @section, @yield, @include, @component, {{ }} vs {!! !!}.", tags: ["repeat"] },
      { name: "Eloquent ORM", status: "known", desc: "Модели, CRUD, scopes, accessors/mutators, mass assignment.", tags: ["repeat"] },
      { name: "Eloquent отношения", status: "known", desc: "hasOne, hasMany, belongsTo, belongsToMany, morphTo, morphMany.", tags: ["repeat", "interview"] },
      { name: "Migrations & Seeders & Factories", status: "known", desc: "up/down, column types, seeders для данных, factories для тестов.", tags: ["repeat"] },
      { name: "Middleware", status: "known", desc: "Создание, регистрация, группы. auth, throttle, verified.", tags: ["repeat"] },
      { name: "Validation", status: "known", desc: "Правила валидации, Form Request, кастомные правила.", tags: ["repeat"] },
      { name: "Service Container & Dependency Injection", status: "review", desc: "Binding, resolving, singletons, contextual binding.", tags: ["interview"] },
      { name: "Service Providers", status: "review", desc: "register() vs boot(), deferred providers.", tags: ["interview"] },
      { name: "Artisan CLI", status: "known", desc: "make:model/controller/migration, кастомные команды, schedule.", tags: ["repeat"] },
      { name: "Configuration & .env", status: "known", desc: "config(), env(), кэширование конфигурации.", tags: ["repeat"] },
    ]
  },
  {
    title: "Фаза 4: Laravel Advanced", duration: "Недели 8–11",
    topics: [
      { name: "Аутентификация (Sanctum, Breeze, Jetstream)", status: "review", desc: "Token-based auth, SPA auth, session auth, guards, providers.", tags: ["repeat", "interview"] },
      { name: "Авторизация (Gates & Policies)", status: "review", desc: "Gate::define, Policy классы, @can/@cannot, authorize в контроллерах.", tags: ["repeat", "interview"] },
      { name: "REST API разработка", status: "review", desc: "API Resources, API routes, versioning, pagination, rate limiting.", tags: ["repeat", "interview"] },
      { name: "Очереди (Queues) и Jobs", status: "new", desc: "dispatch, queue drivers (Redis, database, SQS), workers, failed jobs.", tags: ["interview"] },
      { name: "Events & Listeners", status: "new", desc: "Event-driven архитектура, event dispatching, subscribers, broadcasting.", tags: ["interview"] },
      { name: "Caching", status: "new", desc: "Cache drivers (Redis, Memcached, file), cache tags, cache-aside pattern, TTL.", tags: ["interview"] },
      { name: "Task Scheduling", status: "new", desc: "schedule() в Kernel, cron expressions, withoutOverlapping.", tags: ["interview"] },
      { name: "Notifications & Mail", status: "new", desc: "via() — mail, database, broadcast, Slack. Mailables, markdown emails.", tags: [] },
      { name: "File Storage", status: "review", desc: "Storage фасад, диски (local, s3, public), upload файлов.", tags: [] },
      { name: "Logging", status: "review", desc: "Monolog, channels, stack driver, контекстное логирование.", tags: ["repeat"] },
      { name: "Database Transactions", status: "new", desc: "DB::transaction(), savepoints, deadlock handling в Laravel.", tags: ["interview"] },
      { name: "Eager Loading & N+1 проблема", status: "new", desc: "with(), load(), withCount(), preventLazyLoading(). Debugbar.", tags: ["interview"] },
    ]
  },
  {
    title: "Фаза 5: Безопасность", duration: "Недели 11–12",
    topics: [
      { name: "CSRF защита", status: "known", desc: "@csrf, VerifyCsrfToken middleware, STP pattern.", tags: ["repeat", "interview"] },
      { name: "XSS защита", status: "known", desc: "{{ }} escaping в Blade, htmlspecialchars, Content-Security-Policy.", tags: ["repeat", "interview"] },
      { name: "SQL Injection защита", status: "known", desc: "Prepared statements, PDO bindings, Eloquent/Query Builder.", tags: ["repeat"] },
      { name: "Ротация токенов (Token Rotation)", status: "new", desc: "Access token (15-60мин) + Refresh token (7-30 дней). При refresh выдаётся новая пара.", tags: ["interview"] },
      { name: "OAuth 2.0 & OpenID Connect", status: "new", desc: "Authorization Code Flow, Client Credentials, PKCE. Laravel Passport.", tags: ["interview"] },
      { name: "JWT (JSON Web Tokens)", status: "new", desc: "Header.Payload.Signature, алгоритмы (HS256/RS256), когда JWT vs Session.", tags: ["interview"] },
      { name: "CORS", status: "new", desc: "Same-Origin Policy, Access-Control-Allow-Origin, preflight requests.", tags: ["interview"] },
      { name: "Rate Limiting", status: "new", desc: "throttle middleware, RateLimiter::for(), защита от brute force.", tags: ["interview"] },
      { name: "Password Hashing & Encryption", status: "review", desc: "bcrypt, argon2, Hash::make/check, encrypt/decrypt.", tags: ["interview"] },
      { name: "Session Security", status: "known", desc: "Session fixation, hijacking, HttpOnly, Secure, SameSite cookies.", tags: ["repeat"] },
      { name: "Content Security Policy (CSP)", status: "new", desc: "Заголовки безопасности: CSP, X-Frame-Options, HSTS.", tags: ["interview"] },
    ]
  },
  {
    title: "Фаза 6: Архитектура & Паттерны", duration: "Недели 12–14",
    topics: [
      { name: "SOLID принципы", status: "new", desc: "SRP, OCP, LSP, ISP, DIP — с примерами на PHP/Laravel.", tags: ["interview"] },
      { name: "Repository Pattern", status: "new", desc: "Абстракция доступа к данным, interface + implementation.", tags: ["interview"] },
      { name: "Service Pattern (Service Layer)", status: "new", desc: "Бизнес-логика в сервисах, тонкие контроллеры.", tags: ["interview"] },
      { name: "Factory Pattern", status: "new", desc: "Создание объектов без раскрытия логики инстанциирования.", tags: ["interview"] },
      { name: "Observer Pattern", status: "new", desc: "Laravel Model Observers, creating/created/updating events.", tags: ["interview"] },
      { name: "Strategy Pattern", status: "new", desc: "Разные алгоритмы в runtime (платёжные системы, экспорт форматов).", tags: ["interview"] },
      { name: "DTO (Data Transfer Objects)", status: "new", desc: "Типизированные объекты для передачи данных между слоями.", tags: ["interview"] },
      { name: "Action Pattern", status: "new", desc: "Один класс = одно действие. Альтернатива толстым сервисам.", tags: [] },
      { name: "MVC глубже", status: "review", desc: "Разница между MVC и его вариациями (MVP, MVVM).", tags: ["interview"] },
      { name: "DDD основы", status: "new", desc: "Entities, Value Objects, Aggregates, Repositories.", tags: [] },
      { name: "Clean Architecture", status: "new", desc: "Слои: Domain → Application → Infrastructure.", tags: [] },
    ]
  },
  {
    title: "Фаза 7: Тестирование", duration: "Недели 14–15",
    topics: [
      { name: "PHPUnit основы", status: "new", desc: "Assertions, test lifecycle, setUp/tearDown, data providers.", tags: ["interview"] },
      { name: "Unit тесты", status: "new", desc: "Изолированное тестирование. Мокирование зависимостей (Mockery).", tags: ["interview"] },
      { name: "Feature тесты", status: "new", desc: "HTTP тесты, actingAs(), assertStatus, assertJson, RefreshDatabase.", tags: ["interview"] },
      { name: "TDD (Test-Driven Development)", status: "new", desc: "Red → Green → Refactor цикл. Когда стоит применять.", tags: ["interview"] },
      { name: "Pest PHP", status: "new", desc: "Более читаемый синтаксис, it()/test(), expectations.", tags: [] },
      { name: "Мокирование и Fakes", status: "new", desc: "Event::fake(), Queue::fake(), Notification::fake(), Http::fake().", tags: ["interview"] },
    ]
  },
  {
    title: "Фаза 8: DevOps, Docker & Деплой", duration: "Недели 15–16",
    topics: [
      { name: "Docker основы", status: "review", desc: "Dockerfile, docker-compose.yml, images, containers, volumes, networks.", tags: ["repeat", "interview"] },
      { name: "Docker для Laravel", status: "new", desc: "PHP-FPM + Nginx + MySQL + Redis в docker-compose. Laravel Sail.", tags: ["practice"] },
      { name: "Git продвинутый", status: "review", desc: "Branching strategies (GitFlow, trunk-based), rebase vs merge.", tags: ["repeat", "interview"] },
      { name: "CI/CD основы", status: "new", desc: "GitHub Actions, pipeline stages (lint, test, build, deploy).", tags: ["interview"] },
      { name: "Linux основы для backend", status: "new", desc: "Основные команды, файловая система, permissions, ssh, systemd.", tags: ["interview"] },
      { name: "Nginx & Apache конфигурация", status: "new", desc: "Virtual hosts, reverse proxy, SSL/TLS, gzip.", tags: ["interview"] },
      { name: "Деплой Laravel", status: "new", desc: "Envoy, Deployer, zero-downtime, Laravel Forge.", tags: ["practice"] },
      { name: "Мониторинг и логи", status: "new", desc: "Laravel Telescope, Debugbar, Sentry, Grafana.", tags: [] },
    ]
  },
  {
    title: "Фаза 9: Продвинутые темы", duration: "Ongoing",
    topics: [
      { name: "WebSockets & Real-time", status: "new", desc: "Laravel Echo, Pusher, Reverb. Broadcasting events.", tags: [] },
      { name: "Microservices основы", status: "new", desc: "Когда монолит vs микросервисы, API Gateway.", tags: ["interview"] },
      { name: "GraphQL", status: "new", desc: "Schema, queries, mutations, resolvers. Lighthouse для Laravel.", tags: [] },
      { name: "Redis углублённо", status: "new", desc: "Data structures, pub/sub, Redis как cache + queue + session store.", tags: ["interview"] },
      { name: "Elasticsearch / Meilisearch", status: "new", desc: "Full-text search, Laravel Scout, индексация.", tags: [] },
      { name: "Performance Profiling", status: "new", desc: "Xdebug, Blackfire, Clockwork. Bottleneck detection.", tags: ["interview"] },
      { name: "API Documentation (Swagger/OpenAPI)", status: "new", desc: "L5-Swagger, Scribe. Автогенерация документации.", tags: ["practice"] },
      { name: "Composer углублённо", status: "new", desc: "composer.json vs composer.lock, autoload, scripts.", tags: ["interview"] },
      { name: "PSR стандарты", status: "new", desc: "PSR-1, PSR-4, PSR-7, PSR-12, PSR-15.", tags: ["interview"] },
    ]
  }
];

const scheduleData = [
  { week: "1",  content: "<strong>PHP Core:</strong> Типы данных, переменные, операторы, условия, циклы, функции", review: "" },
  { week: "2",  content: "<strong>PHP OOP:</strong> Классы, наследование, абстракции, интерфейсы, traits, магические методы", review: "Повтор: PHP основы (нед.1)" },
  { week: "3",  content: "<strong>PHP Modern:</strong> Namespaces, PSR-4, PHP 8.x фичи, strict types. <strong>SQL начало:</strong> CRUD, JOIN'ы", review: "Повтор: PHP OOP (нед.2)" },
  { week: "4",  content: "<strong>SQL:</strong> Индексы, EXPLAIN, оптимизация, подзапросы, агрегация", review: "Повтор: PHP Core (нед.1)" },
  { week: "5",  content: "<strong>SQL Advanced:</strong> Транзакции, ACID, нормализация, проектирование БД. <strong>Laravel начало:</strong> Routing, Controllers", review: "Повтор: SQL основы (нед.3), PHP OOP (нед.2)" },
  { week: "6",  content: "<strong>Laravel:</strong> Blade, Eloquent ORM, отношения, migrations, seeders", review: "Повтор: SQL Advanced (нед.4)" },
  { week: "7",  content: "<strong>Laravel:</strong> Middleware, Validation, Service Container, Service Providers", review: "Повтор: PHP Modern (нед.3), Laravel Routing (нед.5)" },
  { week: "8",  content: "<strong>Laravel:</strong> Аутентификация (Sanctum/Breeze), Авторизация (Gates/Policies)", review: "Повтор: Eloquent (нед.6), SQL транзакции (нед.5)" },
  { week: "9",  content: "<strong>Laravel API:</strong> REST API, Resources, Versioning, Pagination, Rate Limiting", review: "Повтор: Auth (нед.8), Middleware (нед.7)" },
  { week: "10", content: "<strong>Laravel Advanced:</strong> Queues, Jobs, Events, Listeners, Caching, Scheduling", review: "Повтор: API (нед.9), PHP OOP (нед.2)" },
  { week: "11", content: "<strong>Безопасность:</strong> CSRF, XSS, SQL injection, Token Rotation, OAuth, JWT, CORS", review: "Повтор: Queues/Events (нед.10), Laravel Fundamentals" },
  { week: "12", content: "<strong>Архитектура:</strong> SOLID принципы, Repository Pattern, Service Pattern, DTO", review: "Повтор: Безопасность (нед.11), Auth (нед.8)" },
  { week: "13", content: "<strong>Паттерны:</strong> Factory, Observer, Strategy, DDD основы, Clean Architecture", review: "Повтор: SOLID (нед.12), API (нед.9)" },
  { week: "14", content: "<strong>Тестирование:</strong> PHPUnit, Unit/Feature тесты, TDD, Mocking, Pest", review: "Повтор: Паттерны (нед.12-13), Queues (нед.10)" },
  { week: "15", content: "<strong>DevOps:</strong> Docker, Docker Compose для Laravel, Git advanced, CI/CD", review: "Повтор: Тестирование (нед.14), Безопасность (нед.11)" },
  { week: "16", content: "<strong>Deploy & Advanced:</strong> Linux, Nginx, деплой Laravel, мониторинг, Redis", review: "Повтор: Docker (нед.15), SOLID+Паттерны (нед.12-13)" },
];

const interviewData = [
  { q: "Что такое strict_types в PHP и зачем он нужен?", a: "declare(strict_types=1) включает строгую типизацию. Без него PHP автоматически приводит типы. С strict_types — TypeError если тип не совпадает. Действует только на файл где объявлено.", cat: "PHP" },
  { q: "Разница между == и === в PHP?", a: "== сравнивает значения с приведением типов (0 == '0' → true). === сравнивает значения И типы без приведения (0 === '0' → false). Всегда предпочитай ===.", cat: "PHP" },
  { q: "Что такое Traits и зачем они нужны?", a: "Traits — механизм горизонтального переиспользования кода. В PHP нет множественного наследования, поэтому traits позволяют включать группы методов в несколько классов через use TraitName.", cat: "PHP" },
  { q: "Объясните магические методы в PHP.", a: "__construct, __destruct, __get/__set, __call/__callStatic, __toString, __invoke, __clone. Вызываются автоматически при определённых операциях с объектом.", cat: "PHP" },
  { q: "Что такое Namespaces и зачем нужен PSR-4?", a: "Namespaces предотвращают конфликты имён классов. PSR-4 — стандарт автозагрузки: путь к файлу соответствует namespace (App\\Models\\User → app/Models/User.php). Composer реализует это через autoload в composer.json.", cat: "PHP" },
  { q: "Enums в PHP 8.1 — что это?", a: "Нативные перечисления. Могут быть чистые (без значений) или backed (string/int). enum Status: string { case Active = 'active'; } Поддерживают методы и interfaces.", cat: "PHP" },
  { q: "Разница между абстрактным классом и интерфейсом?", a: "Abstract class: может иметь реализованные методы + абстрактные, свойства, конструктор. Один класс = один extends. Interface: только сигнатуры методов. Класс может implements несколько интерфейсов. Abstract — 'is a', Interface — 'can do'.", cat: "PHP" },
  { q: "Что такое генераторы (generators) в PHP?", a: "Функции с yield вместо return. Выдают значения по одному, не загружая всё в память. Идеальны для обработки больших файлов и потоков данных.", cat: "PHP" },
  { q: "Опишите жизненный цикл запроса в Laravel.", a: "1) index.php (front controller) 2) bootstrap/app.php, создаётся service container 3) HTTP Kernel 4) глобальные middleware 5) Router находит маршрут 6) route middleware 7) Controller 8) Response возвращается обратно.", cat: "Laravel" },
  { q: "Что такое Service Container в Laravel?", a: "Инструмент для управления зависимостями и Dependency Injection. Автоматически разрешает зависимости через type-hinting. Позволяет bind интерфейсов к конкретным реализациям. Singleton для одного экземпляра.", cat: "Laravel" },
  { q: "Разница между Sanctum и Passport?", a: "Sanctum: лёгкий, для SPA + мобильных + простых API tokens. Не реализует OAuth2. Passport: полная реализация OAuth2. Используй Sanctum для 1st party приложений, Passport — когда нужен полный OAuth2.", cat: "Laravel" },
  { q: "Что такое N+1 проблема и как её решить?", a: "N+1 — когда для N записей делается N дополнительных запросов к связанным моделям. Решение: Eager Loading — Post::with('author')->get() — всего 2 запроса вместо N+1. preventLazyLoading() для обнаружения в разработке.", cat: "Laravel" },
  { q: "Как работают Queues в Laravel?", a: "Очереди выносят тяжёлые задачи в фоновый процесс. dispatch(new Job()) отправляет в очередь. Queue drivers: Redis, database, SQS. Worker (php artisan queue:work) слушает очередь. Supervisor следит за worker.", cat: "Laravel" },
  { q: "Gates vs Policies — разница?", a: "Gates: closure-based проверки. Gate::define('edit-post', fn(User $user, Post $post) => ...). Policies: классы привязанные к модели, группируют CRUD проверки. Policies — для ресурсов, Gates — для действий не привязанных к модели.", cat: "Laravel" },
  { q: "Как реализовать API versioning в Laravel?", a: "URL-based (рекомендуется): /api/v1/posts, /api/v2/posts. Группировка: Route::prefix('v1')->group(...). Разные контроллеры: Api\\V1\\PostController. Альтернативы: header-based или query param.", cat: "Laravel" },
  { q: "Что такое ротация токенов (Token Rotation)?", a: "При каждом обновлении access token — выдаётся НОВЫЙ refresh token, старый аннулируется. Access token живёт 15-60 мин, refresh — 7-30 дней. Если утечка refresh token — он уже использован и невалиден.", cat: "Security" },
  { q: "OAuth 2.0 — кратко объясните flows.", a: "Authorization Code + PKCE: для серверных и SPA. Пользователь → auth сервер → code → обмен на token. Client Credentials: сервер-к-серверу без пользователя. Implicit — устаревший.", cat: "Security" },
  { q: "JWT vs Session — когда что использовать?", a: "Session: stateful, хранится на сервере, ID в cookie. Для традиционных веб-приложений, проще revoke. JWT: stateless, всё в токене. Для API, микросервисы, мобильные. Для SPA + API — Sanctum с cookie-based auth оптимальнее.", cat: "Security" },
  { q: "Что такое CORS и как настроить?", a: "Механизм позволяющий запросы между разными доменами. Браузер отправляет preflight OPTIONS. Сервер отвечает Access-Control-Allow-Origin и др. В Laravel: config/cors.php, HandleCors middleware.", cat: "Security" },
  { q: "XSS атаки — виды и защита?", a: "Stored XSS: скрипт в БД. Reflected XSS: скрипт в URL. DOM-based: манипуляция DOM. Защита: {{ }} экранирует вывод в Blade. Content-Security-Policy. HTML Purifier для user-generated content.", cat: "Security" },
  { q: "Что такое Rate Limiting в Laravel?", a: "RateLimiter::for('api', fn($r) => Limit::perMinute(60)->by($r->ip())). Применяется через middleware throttle:api. Ответ: X-RateLimit-Limit, X-RateLimit-Remaining, 429 Too Many Requests.", cat: "Security" },
  { q: "Объясните принципы SOLID.", a: "S — Single Responsibility: один класс = одна ответственность. O — Open/Closed: открыт для расширения, закрыт для изменения. L — Liskov: подклассы заменяют базовые. I — Interface Segregation: маленькие интерфейсы. D — Dependency Inversion: зависи от абстракций.", cat: "Architecture" },
  { q: "Что такое Repository Pattern?", a: "Абстракция доступа к данным. Interface (find, create, update, delete) + Implementation (EloquentUserRepository). Binding в ServiceProvider. Плюсы: тестируемость, легко подменить реализацию.", cat: "Architecture" },
  { q: "Что такое DTO?", a: "Data Transfer Object — объект только для передачи данных без бизнес-логики. class CreateUserDTO { public function __construct(public readonly string $name, ...) {} }. Плюсы: типизация, IDE автокомплит, не передаём Request в сервис.", cat: "Architecture" },
  { q: "Что такое ACID?", a: "Atomicity: транзакция либо полностью, либо откатывается. Consistency: БД всегда в валидном состоянии. Isolation: параллельные транзакции не мешают (Read Uncommitted < Serializable). Durability: после commit данные сохранены.", cat: "Database" },
  { q: "Уровни изоляции транзакций.", a: "Read Uncommitted: видны незакоммиченные изменения. Read Committed: только закоммиченные (default PostgreSQL). Repeatable Read: повторное чтение даёт тот же результат (default MySQL). Serializable: полная изоляция.", cat: "Database" },
  { q: "Нормализация — 1NF, 2NF, 3NF.", a: "1NF: атомарные значения, уникальные строки. 2NF: 1NF + нет частичных зависимостей от составного ключа. 3NF: 2NF + нет транзитивных зависимостей.", cat: "Database" },
  { q: "Unit тесты vs Feature тесты.", a: "Unit: тестирование одного класса/метода изолированно, зависимости мокаются, быстрые. Feature: тестирование целого HTTP запроса. $this->get('/api/posts')->assertStatus(200). Взаимодействуют с БД, медленнее.", cat: "Testing" },
  { q: "Что такое TDD?", a: "Test-Driven Development: 1) Red — пишем тест, он падает. 2) Green — минимальный код чтобы пройти. 3) Refactor — улучшаем, тесты проходят. Плюсы: покрытие, лучший дизайн, уверенность при рефакторинге.", cat: "Testing" },
  { q: "Docker — зачем для backend?", a: "Одинаковое окружение: dev = staging = production. docker-compose.yml описывает сервисы (PHP-FPM, Nginx, MySQL, Redis). Laravel Sail — официальная Docker-обёртка. Volumes для данных, Networks для связи контейнеров.", cat: "DevOps" },
  { q: "Что такое CI/CD?", a: "CI: автоматический запуск тестов при push/PR. CD: автоматическая подготовка к деплою. GitHub Actions: on push → install → test → build → deploy. Этапы: lint → test → build → staging → production.", cat: "DevOps" },
];

const resourcesData = [
  { name: "Laracasts: PHP for Beginners", url: "https://laracasts.com/series/php-for-beginners-2023-edition", cat: "php", level: "Beginner", cost: "Частично бесплатно", desc: "Лучший старт в PHP. Jeffrey Way — лучший преподаватель Laravel.", rating: "★★★★★" },
  { name: "PHP: The Right Way", url: "https://phptherightway.com/", cat: "php", level: "All levels", cost: "Бесплатно", desc: "Референс best practices PHP. Стандарты, безопасность, тестирование.", rating: "★★★★★", free: true },
  { name: "PHP Beginner to Advanced (Udemy)", url: "https://www.udemy.com/course/php-beginner-to-advanced/", cat: "php", level: "Beginner → Advanced", cost: "~$15", desc: "850K+ студентов. OOP, namespaces, PSR-4, MVC, 12+ проектов.", rating: "★★★★½" },
  { name: "PHP.net Official Docs", url: "https://www.php.net/docs.php", cat: "php", level: "All levels", cost: "Бесплатно", desc: "Официальная документация с отличными комментариями сообщества.", rating: "★★★★★", free: true },
  { name: "Laracasts (платформа)", url: "https://laracasts.com", cat: "laravel", level: "All levels", cost: "$15-20/мес", desc: "200+ курсов. Главный ресурс в экосистеме Laravel.", rating: "★★★★★" },
  { name: "30 Days to Learn Laravel", url: "https://laracasts.com/series/30-days-to-learn-laravel-11", cat: "laravel", level: "Beginner", cost: "Бесплатно", desc: "Бесплатный курс. От нуля до рабочего приложения за 30 дней.", rating: "★★★★★", free: true },
  { name: "Laravel Official Getting Started", url: "https://laravel.com/learn/getting-started-with-laravel", cat: "laravel", level: "Beginner", cost: "Бесплатно", desc: "Официальный 2-часовой bootcamp. Первое full-stack приложение.", rating: "★★★★★", free: true },
  { name: "Laravel Daily", url: "https://laraveldaily.com", cat: "laravel", level: "Intermediate → Advanced", cost: "Бесплатно / Paid", desc: "Ежедневные видео, продвинутые темы, SaaS, best practices. Povilas Korop.", rating: "★★★★★" },
  { name: "Laravel Official Docs", url: "https://laravel.com/docs", cat: "laravel", level: "All levels", cost: "Бесплатно", desc: "Лучшая документация в PHP экосистеме.", rating: "★★★★★", free: true },
  { name: "roadmap.sh/backend", url: "https://roadmap.sh/backend", cat: "backend", level: "All levels", cost: "Бесплатно", desc: "Интерактивная карта всех тем backend разработчика.", rating: "★★★★★", free: true },
  { name: "roadmap.sh/php", url: "https://roadmap.sh/php", cat: "backend", level: "All levels", cost: "Бесплатно", desc: "PHP-специфичный roadmap. Все темы которые нужно знать.", rating: "★★★★★", free: true },
  { name: "DesignPatternsPHP", url: "https://designpatternsphp.readthedocs.io/", cat: "backend", level: "Intermediate", cost: "Бесплатно", desc: "Все паттерны проектирования с примерами на PHP.", rating: "★★★★½", free: true },
  { name: "OTUS: Backend-разработчик на PHP", url: "https://otus.ru/lessons/razrabotchik-php/", cat: "ru", level: "Intermediate", cost: "Платно", desc: "5 месяцев. Командный проект, микросервисы, углублённый PHP.", rating: "★★★★" },
  { name: "Hexlet: PHP Laravel", url: "https://ru.hexlet.io/courses/php-laravel", cat: "ru", level: "Beginner → Intermediate", cost: "Бесплатно / Paid", desc: "Routing, controllers, CRUD. Хорошая теоретическая база на русском.", rating: "★★★★", free: true },
];

const obsidianData = [
  { section: "PHP", level: "Intermediate", files: 4, topics: "Основы PHP (типы, переменные, операторы, циклы, функции), PDO и работа с БД, базовые операторы", gaps: "Нет OOP продвинутого (наследование, интерфейсы, traits), нет namespaces, PSR, PHP 8.x фич, генераторов" },
  { section: "Laravel — Введение", level: "Intermediate", files: 10, topics: "История PHP, роль в вебе, установка Laravel, структура проекта, MVC, Composer, Artisan", gaps: "Заметки вводного уровня. Хорошая база но нужно углублять" },
  { section: "Laravel — Веб-приложение", level: "Intermediate-Advanced", files: 11, topics: "Routing, Controllers, Views/Blade, Migrations, Eloquent ORM, Middleware, Authentication, Logging", gaps: "Нет Queues, Events, Caching, Task Scheduling, Transactions" },
  { section: "Laravel — Интеграция PHP", level: "Intermediate", files: 11, topics: "PHP libraries, CSRF, Session Security, Validation, REST API, API Controllers, XSS protection", gaps: "Нет OAuth, JWT, Token Rotation, Rate Limiting, CORS углублённо" },
  { section: "SQL & Databases", level: "Basic-Intermediate", files: 12, topics: "SQL Database основы, CREATE TABLE, Indexes, JOINs, EXPLAIN, Subqueries", gaps: "Нет Transactions/ACID, нормализации, проектирования БД" },
  { section: "JavaScript", level: "Basic", files: 6, topics: "Введение в JS, типы данных, функции, массивы, Ajax", gaps: "Базовый уровень, не связано с backend" },
  { section: "Docker", level: "Minimal", files: 1, topics: "docker-compose.yml файл", gaps: "Нужно полноценное изучение Docker для разработки" },
  { section: "Git", level: "Minimal", files: 1, topics: "Базовые команды", gaps: "Нужны branching strategies, rebase, CI/CD" },
  { section: "Собеседования", level: "Started", files: 2, topics: "Вопросы Abelhost, общие вопросы", gaps: "Нужно значительно расширить" },
];

// ── RENDER ────────────────────────────────────────────────────────────────────

function renderRoadmap() {
  const container = document.getElementById('roadmap-container');
  let html = '';

  roadmapData.forEach((phase, pi) => {
    const known  = phase.topics.filter(t => t.status === 'known').length;
    const review = phase.topics.filter(t => t.status === 'review').length;
    const newT   = phase.topics.filter(t => t.status === 'new').length;
    const total  = phase.topics.length;
    const pct    = Math.round((known / total) * 100);

    html += `<div class="phase" data-phase="${pi}">
      <div class="phase-header" onclick="togglePhase(${pi})">
        <div class="phase-left">
          <div class="phase-title">${phase.title}</div>
          <div class="phase-sub">${phase.duration} · ${total} тем · ${pct}% освоено</div>
          <div class="progress-bar"><div class="progress-fill" style="width:${pct}%"></div></div>
        </div>
        <div class="phase-meta">
          ${known  > 0 ? `<span class="phase-badge badge-known"><i data-lucide="check-circle"></i>${known}</span>` : ''}
          ${review > 0 ? `<span class="phase-badge badge-review"><i data-lucide="refresh-cw"></i>${review}</span>` : ''}
          ${newT   > 0 ? `<span class="phase-badge badge-new"><i data-lucide="plus-circle"></i>${newT}</span>` : ''}
          <span class="phase-arrow"><i data-lucide="chevron-down"></i></span>
        </div>
      </div>
      <div class="phase-body">`;

    phase.topics.forEach((topic, ti) => {
      const markerClass = topic.status === 'known' ? 'full' : topic.status === 'review' ? 'partial' : 'none';
      const tags = topic.tags.map(t => {
        if (t === 'interview') return `<span class="topic-tag tag-interview">Interview</span>`;
        if (t === 'practice')  return `<span class="topic-tag tag-practice">Practice</span>`;
        if (t === 'repeat')    return `<span class="topic-tag tag-repeat">Повторить</span>`;
        return `<span class="topic-tag tag-resource">${t}</span>`;
      }).join('');

      html += `<div class="topic" data-status="${topic.status}" data-name="${topic.name.toLowerCase()}">
        <div class="topic-check" data-p="${pi}" data-t="${ti}" onclick="toggleCheck(this)"></div>
        <div class="topic-info">
          <div class="topic-name"><span class="known-marker ${markerClass}"></span>${topic.name}</div>
          <div class="topic-desc">${topic.desc}</div>
          ${tags ? `<div class="topic-tags">${tags}</div>` : ''}
        </div>
      </div>`;
    });

    html += `</div></div>`;
  });

  container.innerHTML = html;
  updateStats();
}

function renderSchedule() {
  let html = '<div class="schedule-wrap"><div class="schedule-grid">';
  scheduleData.forEach(s => {
    const reviewTag = s.review
      ? `<br><span class="review-tag"><i data-lucide="refresh-cw" style="width:10px;height:10px;"></i>${s.review}</span>`
      : '';
    html += `<div class="schedule-week">Нед ${s.week}</div>
             <div class="schedule-content">${s.content}${reviewTag}</div>`;
  });
  html += '</div></div>';
  document.getElementById('schedule-container').innerHTML = html;
}

function renderInterview() {
  const cats = [...new Set(interviewData.map(q => q.cat))];
  let html = '';
  cats.forEach(cat => {
    html += `<div class="sub-heading">${cat}</div>`;
    interviewData.filter(q => q.cat === cat).forEach(q => {
      html += `<div class="interview-q" data-q="${q.q.toLowerCase()}" data-cat="${q.cat}">
        <div class="interview-q-header" onclick="this.parentElement.classList.toggle('open')">
          <div class="q-header-left">
            <span class="q-cat">${q.cat}</span>
            <span>${q.q}</span>
          </div>
          <span class="q-chevron"><i data-lucide="chevron-down"></i></span>
        </div>
        <div class="interview-q-body">${q.a}</div>
      </div>`;
    });
  });
  document.getElementById('interview-container').innerHTML = html;
}

function renderResources() {
  const groups = { php: "PHP", laravel: "Laravel", backend: "Backend общее", ru: "На русском языке" };
  let html = '';
  Object.keys(groups).forEach(cat => {
    const items = resourcesData.filter(r => r.cat === cat);
    if (!items.length) return;
    html += `<div class="sub-heading">${groups[cat]}</div>`;
    items.forEach(r => {
      html += `<div class="resource-card" data-cat="${r.cat}" data-free="${!!r.free}">
        <div class="resource-header">
          <h3>${r.name}</h3>
          <span class="resource-rating">${r.rating || ''}</span>
        </div>
        <div class="resource-meta">
          <span class="resource-level">${r.level}</span>
          <span class="resource-cost">${r.cost}</span>
          ${r.free ? '<span class="resource-free">FREE</span>' : ''}
        </div>
        <div class="resource-desc">${r.desc}</div>
        <a class="resource-link" href="${r.url}" target="_blank">
          <i data-lucide="external-link"></i> ${r.url.replace('https://', '')}
        </a>
      </div>`;
    });
  });
  document.getElementById('resources-container').innerHTML = html;
}

function renderObsidian() {
  let html = '';
  obsidianData.forEach(s => {
    const lvl = s.level;
    let badgeStyle = '';
    if (lvl.includes('Advanced'))    badgeStyle = 'background:var(--success-light);color:var(--success-dark)';
    else if (lvl.includes('Intermediate')) badgeStyle = 'background:var(--warning-light);color:var(--warning-dark)';
    else                             badgeStyle = 'background:var(--danger-light);color:var(--danger)';

    html += `<div class="obsidian-card">
      <div class="obsidian-header" onclick="this.parentElement.classList.toggle('open')">
        <div>
          <div class="obsidian-title">${s.section}</div>
          <div class="obsidian-files">${s.files} файлов в Obsidian</div>
        </div>
        <div class="obsidian-right">
          <span class="level-badge" style="${badgeStyle}">${s.level}</span>
          <span class="phase-arrow"><i data-lucide="chevron-down"></i></span>
        </div>
      </div>
      <div class="obsidian-body">
        <div class="obs-section">
          <div class="obs-section-title good">Что записано</div>
          <div class="obs-text">${s.topics}</div>
        </div>
        <div class="obs-section">
          <div class="obs-section-title bad">Пробелы</div>
          <div class="obs-text">${s.gaps}</div>
        </div>
      </div>
    </div>`;
  });
  document.getElementById('obsidian-container').innerHTML = html;
}

// ── INTERACTIONS ──────────────────────────────────────────────────────────────

function switchTab(tab, el) {
  document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  el.classList.add('active');
  document.getElementById('sec-' + tab).classList.add('active');
}

function togglePhase(i) {
  document.querySelector(`.phase[data-phase="${i}"]`).classList.toggle('open');
}

// ── API PROGRESS ───────────────────────────────────────────────────────────────
const API = '/api/progress/state';
let progressState = {};
let saveTimer = null;

async function loadState() {
  try {
    const res = await fetch(API);
    const data = await res.json();
    progressState = (data && !Array.isArray(data)) ? data : {};
    // Restore checkboxes
    document.querySelectorAll('.topic-check').forEach(el => {
      const key = el.dataset.p + '_' + el.dataset.t;
      if (progressState[key]) {
        el.classList.add('checked');
        el.nextElementSibling.querySelector('.topic-name').classList.add('checked-text');
      }
    });
    updateStats();
  } catch(e) {
    console.warn('API недоступен, используем только визуальное состояние');
  }
}

function saveState() {
  clearTimeout(saveTimer);
  saveTimer = setTimeout(() => {
    fetch(API, {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(progressState)
    }).catch(() => {});
  }, 400);
}

function toggleCheck(el) {
  el.classList.toggle('checked');
  el.nextElementSibling.querySelector('.topic-name').classList.toggle('checked-text');
  const key = el.dataset.p + '_' + el.dataset.t;
  progressState[key] = el.classList.contains('checked');
  updateStats();
  saveState();
}

function updateStats() {
  const checks = document.querySelectorAll('.topic-check.checked').length;
  const total  = document.querySelectorAll('.topic-check').length;
  const known  = roadmapData.reduce((s,p) => s + p.topics.filter(t => t.status === 'known').length, 0);
  const review = roadmapData.reduce((s,p) => s + p.topics.filter(t => t.status === 'review').length, 0);
  const newT   = roadmapData.reduce((s,p) => s + p.topics.filter(t => t.status === 'new').length, 0);
  document.getElementById('stat-known').textContent   = known;
  document.getElementById('stat-review').textContent  = review;
  document.getElementById('stat-new').textContent     = newT;
  document.getElementById('stat-total').textContent   = total;
  // Update progress bars per phase
  document.querySelectorAll('.phase').forEach((phaseEl, pi) => {
    const pChecks = phaseEl.querySelectorAll('.topic-check.checked').length;
    const pTotal  = phaseEl.querySelectorAll('.topic-check').length;
    const pct     = pTotal > 0 ? Math.round(pChecks / pTotal * 100) : 0;
    const fill    = phaseEl.querySelector('.progress-fill');
    const sub     = phaseEl.querySelector('.phase-sub');
    if (fill) fill.style.width = pct + '%';
    if (sub)  sub.textContent  = sub.textContent.replace(/\d+% освоено/, pct + '% освоено');
  });
}

function filterTopics(query) {
  query = query.toLowerCase();
  document.querySelectorAll('.topic').forEach(t => {
    t.style.display = t.dataset.name.includes(query) ? 'flex' : 'none';
  });
}

function filterByStatus(status, btn) {
  document.querySelectorAll('#sec-roadmap .filter-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.topic').forEach(t => {
    t.style.display = (status === 'all' || t.dataset.status === status) ? 'flex' : 'none';
  });
}

function filterQuestions(query) {
  query = query.toLowerCase();
  document.querySelectorAll('.interview-q').forEach(q => {
    q.style.display = q.dataset.q.includes(query) ? 'block' : 'none';
  });
}

function filterResources(cat, btn) {
  document.querySelectorAll('#sec-resources .filter-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.resource-card').forEach(r => {
    if (cat === 'all')  { r.style.display = 'block'; return; }
    if (cat === 'free') { r.style.display = r.dataset.free === 'true' ? 'block' : 'none'; return; }
    r.style.display = r.dataset.cat === cat ? 'block' : 'none';
  });
}

// ── INIT ──────────────────────────────────────────────────────────────────────
renderRoadmap();
renderSchedule();
renderInterview();
renderResources();
renderObsidian();
loadState();

</script>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>
lucide.createIcons();
</script>
</body>
</html>

@endverbatim