@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CLI: Bash · Git · Composer</title>
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
.c-dir{color:#61AFEF;font-weight:600;}
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
<link rel="stylesheet" href="/css/kb.css">
<script>(function(){try{var d=document.documentElement;var t=localStorage.getItem('kb-theme')||(window.matchMedia&&matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light');d.setAttribute('data-theme',t);if(localStorage.getItem('kb-accent')==='blue')d.setAttribute('data-accent','blue');}catch(e){}})();</script>
<script src="/js/kb.js" defer></script>
</head>
<body>
<div class="container">
<div class="sidebar">
  <a href="/" class="sidebar-back"><i data-lucide="arrow-left"></i> На главную</a>
  <div class="sidebar-title">CLI: Bash · Git · Composer</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">Bash</div>
  <a class="nav-item" onclick="showSection('bash-nav',this)"><i data-lucide="folder-tree"></i> Навигация и файлы</a>
  <a class="nav-item" onclick="showSection('bash-text',this)"><i data-lucide="search"></i> Поиск и текст</a>
  <a class="nav-item" onclick="showSection('bash-proc',this)"><i data-lucide="activity"></i> Процессы, диск, сеть</a>
  <a class="nav-item" onclick="showSection('bash-perm',this)"><i data-lucide="lock"></i> Права доступа</a>
  <a class="nav-item" onclick="showSection('bash-pipes',this)"><i data-lucide="git-merge"></i> Пайпы и перенаправление</a>

  <div class="nav-group-label">Git</div>
  <a class="nav-item" onclick="showSection('git-base',this)"><i data-lucide="git-branch"></i> База: от init до push</a>
  <a class="nav-item" onclick="showSection('git-states',this)"><i data-lucide="layers"></i> Три состояния файла</a>
  <a class="nav-item" onclick="showSection('git-undo',this)"><i data-lucide="undo-2"></i> Отмена изменений</a>
  <a class="nav-item" onclick="showSection('git-branch',this)"><i data-lucide="git-fork"></i> Ветки и слияние</a>
  <a class="nav-item" onclick="showSection('git-remote',this)"><i data-lucide="cloud"></i> Remote и теги</a>

  <div class="nav-group-label">Composer</div>
  <a class="nav-item" onclick="showSection('comp-base',this)"><i data-lucide="package"></i> База и зависимости</a>
  <a class="nav-item" onclick="showSection('comp-lock',this)"><i data-lucide="file-lock-2"></i> install vs update и lock</a>
  <a class="nav-item" onclick="showSection('comp-versions',this)"><i data-lucide="tag"></i> Версии и constraints</a>
  <a class="nav-item" onclick="showSection('comp-autoload',this)"><i data-lucide="zap"></i> Автозагрузка и скрипты</a>

  <div class="nav-group-label">Применение</div>
  <a class="nav-item" onclick="showSection('cheatsheet',this)"><i data-lucide="list-checks"></i> Шпаргалка</a>
  <a class="nav-item" onclick="showSection('pitfalls',this)"><i data-lucide="alert-octagon"></i> Подводные камни</a>
</div>

<div class="main">
<div class="page-header">
  <h1>CLI: Bash · Git · Composer</h1>
  <p>Три инструмента, которыми backend-разработчик пользуется каждый день. Команды с объяснением, что именно происходит, а не просто списком. Продвинутый Git (rebase, cherry-pick, hooks) разобран отдельно в <strong>Testing &amp; DevOps</strong>.</p>
  <div class="badge-row">
    <span class="badge">Bash</span>
    <span class="badge">Git</span>
    <span class="badge">Composer</span>
    <span class="badge badge-success">Практика</span>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>
  <div class="subsection">
    <p class="text">Раздел закрывает <strong>базу</strong> по трём CLI-инструментам. Акцент на том, что команда делает под капотом — потому что команды, выученные наизусть без понимания, перестают помогать на первой нестандартной ситуации.</p>
    <table class="data-table">
      <thead><tr><th>Инструмент</th><th>Что здесь</th><th>Что в других разделах</th></tr></thead>
      <tbody>
        <tr><td><strong>Bash</strong></td><td>Навигация, поиск, процессы, права, пайпы</td><td>systemd, SSH, cron — в <em>Nginx &amp; Docker</em></td></tr>
        <tr><td><strong>Git</strong></td><td>init → push, три состояния, отмена, ветки, remote</td><td>rebase vs merge, cherry-pick, hooks — в <em>Testing &amp; DevOps</em></td></tr>
        <tr><td><strong>Composer</strong></td><td>Зависимости, lock, версии, автозагрузка</td><td>PSR-4 — в <em>PHP Core</em></td></tr>
      </tbody>
    </table>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-bash-nav" class="section">
  <div class="section-title">Bash: навигация и файлы</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="compass"></i> Где я и что вокруг</div>
<pre><code>pwd                 <span class="c-comment"># print working directory — где я сейчас</span>
ls                  <span class="c-comment"># список файлов</span>
ls -la              <span class="c-comment"># -l подробно, -a включая скрытые (начинаются с точки)</span>
ls -lh              <span class="c-comment"># -h размеры по-человечески: 4.0K вместо 4096</span>
ls -lt              <span class="c-comment"># -t сортировка по времени, свежие сверху</span>

cd /var/www         <span class="c-comment"># абсолютный путь — от корня</span>
cd ../logs          <span class="c-comment"># относительный: .. это на уровень вверх</span>
cd ~                <span class="c-comment"># домашняя папка</span>
cd -                <span class="c-comment"># вернуться туда, где был до этого</span></code></pre>
    <table class="data-table">
      <thead><tr><th>Символ</th><th>Значение</th></tr></thead>
      <tbody>
        <tr><td><code>.</code></td><td>Текущая папка</td></tr>
        <tr><td><code>..</code></td><td>Родительская папка</td></tr>
        <tr><td><code>~</code></td><td>Домашняя папка пользователя</td></tr>
        <tr><td><code>/</code></td><td>Корень файловой системы</td></tr>
        <tr><td><code>-</code> (в <code>cd</code>)</td><td>Предыдущая папка</td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="files"></i> Создание, копирование, удаление</div>
<pre><code>mkdir logs              <span class="c-comment"># создать папку</span>
mkdir -p a/b/c          <span class="c-comment"># -p создать всю цепочку, не ругаться если есть</span>
touch file.txt          <span class="c-comment"># создать пустой файл / обновить дату</span>

cp file.txt backup.txt  <span class="c-comment"># копировать файл</span>
cp -r src/ dist/        <span class="c-comment"># -r рекурсивно, для папок обязателен</span>
cp -a src/ dist/        <span class="c-comment"># -a сохранить права, владельца, даты</span>

mv old.txt new.txt      <span class="c-comment"># переименовать</span>
mv file.txt /tmp/       <span class="c-comment"># переместить — та же команда</span>

rm file.txt             <span class="c-comment"># удалить файл</span>
rm -r folder/           <span class="c-comment"># удалить папку рекурсивно</span>
rm -f file.txt          <span class="c-comment"># -f не спрашивать и не ругаться на отсутствие</span></code></pre>
    <div class="pitfall"><strong><code>rm</code> не спрашивает и не кладёт в корзину.</strong> Удалённое не восстановить. Особенно опасна связка <code>rm -rf</code> с переменной: если переменная пустая, <code>rm -rf $DIR/</code> превращается в <code>rm -rf /</code>. Привычка, которая спасает: сначала <code>ls</code> на том же пути, и только потом <code>rm</code>.</div>
    <div class="remember-box"><code>mv</code> — это и «переименовать», и «переместить». Разницы нет: файл просто получает новый путь.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-text"></i> Чтение файлов</div>
<pre><code>cat file.txt            <span class="c-comment"># вывести целиком</span>
less file.txt           <span class="c-comment"># постранично: q выход, / поиск, G в конец</span>
head -20 file.txt       <span class="c-comment"># первые 20 строк</span>
tail -20 file.txt       <span class="c-comment"># последние 20 строк</span>
tail -f storage/logs/laravel.log   <span class="c-comment"># следить за новыми строками в реальном времени</span>
wc -l file.txt          <span class="c-comment"># сколько строк</span></code></pre>
    <div class="remember-box"><code>tail -f</code> на логе — самая частая команда при отладке на сервере. Выход — Ctrl+C.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-bash-text" class="section">
  <div class="section-title">Bash: поиск и обработка текста</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="search"></i> grep — поиск по содержимому</div>
<pre><code>grep "error" app.log            <span class="c-comment"># строки со словом error</span>
grep -i "error" app.log         <span class="c-comment"># -i без учёта регистра</span>
grep -r "TODO" app/             <span class="c-comment"># -r рекурсивно по папке</span>
grep -n "error" app.log         <span class="c-comment"># -n показать номера строк</span>
grep -c "error" app.log         <span class="c-comment"># -c только посчитать совпадения</span>
grep -v "debug" app.log         <span class="c-comment"># -v инверсия: всё КРОМЕ совпавшего</span>
grep -A3 -B3 "error" app.log    <span class="c-comment"># 3 строки после (After) и до (Before)</span>
grep -E "error|warning" app.log <span class="c-comment"># -E регулярка, | это ИЛИ</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-search"></i> find — поиск файлов</div>
<pre><code>find . -name "*.php"                  <span class="c-comment"># по имени, с текущей папки</span>
find . -iname "*.PHP"                 <span class="c-comment"># -iname без учёта регистра</span>
find . -type f -size +10M             <span class="c-comment"># файлы больше 10 МБ</span>
find . -type d -name node_modules     <span class="c-comment"># -type d только папки</span>
find . -mtime -7                      <span class="c-comment"># изменённые за последние 7 дней</span>
find . -name "*.log" -delete          <span class="c-comment"># найти и удалить</span>
find . -name "*.php" -exec grep -l "TODO" {} \;   <span class="c-comment"># выполнить команду над каждым</span></code></pre>
    <div class="why-box"><strong><code>find</code> против <code>grep</code>.</strong> <code>find</code> ищет <em>файлы</em> — по имени, размеру, дате, типу. <code>grep</code> ищет <em>внутри</em> файлов — по содержимому. Их часто комбинируют: <code>find</code> отбирает файлы, <code>grep</code> смотрит, что внутри.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="scissors"></i> Обработка потока</div>
<pre><code>sort file.txt           <span class="c-comment"># отсортировать строки</span>
sort -u file.txt        <span class="c-comment"># -u убрать дубликаты</span>
sort -rn file.txt       <span class="c-comment"># -r обратный порядок, -n числовая сортировка</span>
uniq -c file.txt        <span class="c-comment"># -c посчитать повторы (нужен отсортированный вход)</span>
cut -d: -f1 /etc/passwd <span class="c-comment"># -d разделитель, -f номер поля</span>
sed 's/old/new/g' f.txt <span class="c-comment"># замена: s/что/на что/g — g значит все вхождения</span>
awk '{print $1, $3}' f  <span class="c-comment"># вывести 1-ю и 3-ю колонки</span></code></pre>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-bash-proc" class="section">
  <div class="section-title">Bash: процессы, диск, сеть</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cpu"></i> Процессы</div>
<pre><code>ps aux                  <span class="c-comment"># все процессы системы</span>
ps aux | grep php       <span class="c-comment"># отфильтровать по имени</span>
top                     <span class="c-comment"># интерактивно, обновляется (q выход)</span>
htop                    <span class="c-comment"># то же, удобнее — ставится отдельно</span>

kill 1234               <span class="c-comment"># послать SIGTERM — «завершись корректно»</span>
kill -9 1234            <span class="c-comment"># SIGKILL — убить немедленно, без шансов</span>
pkill -f "artisan queue" <span class="c-comment"># убить по совпадению в командной строке</span></code></pre>
    <div class="pitfall"><strong><code>kill -9</code> — последнее средство.</strong> Процесс не успевает закрыть файлы, сбросить буферы и снять блокировки. Для воркера очереди это означает джоб, брошенный на середине. Сначала обычный <code>kill</code>, и только если не умер — <code>-9</code>.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hard-drive"></i> Диск</div>
<pre><code>df -h                   <span class="c-comment"># сколько места на разделах</span>
du -sh /var/www         <span class="c-comment"># -s итог по папке, -h по-человечески</span>
du -sh * | sort -rh     <span class="c-comment"># что занимает больше всего в текущей папке</span>
du -sh * | sort -rh | head -10   <span class="c-comment"># топ-10 тяжёлых</span></code></pre>
    <div class="remember-box"><code>df</code> — сколько свободно <em>на диске</em>. <code>du</code> — сколько занимает <em>конкретная папка</em>. Диск забился — начинай с <code>df -h</code>, потом <code>du</code> по подозрительным путям.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="network"></i> Сеть</div>
<pre><code>curl https://api.example.com          <span class="c-comment"># GET-запрос</span>
curl -I https://example.com           <span class="c-comment"># -I только заголовки</span>
curl -X POST -d '{"a":1}' -H "Content-Type: application/json" URL
curl -o file.zip URL                  <span class="c-comment"># -o сохранить в файл</span>

ping example.com                      <span class="c-comment"># доступен ли хост</span>
lsof -i :8000                         <span class="c-comment"># кто занял порт 8000</span>
netstat -tulpn | grep 80              <span class="c-comment"># что слушает 80 порт (Linux)</span></code></pre>
    <div class="remember-box"><code>lsof -i :порт</code> — первое, что запускают при «Address already in use».</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-bash-perm" class="section">
  <div class="section-title">Bash: права доступа</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="key-round"></i> Как читать <code>rwx</code></div>
<pre><code>$ ls -l
-rw-r--r--  1 observer  staff   1024 Oct 16 12:00 file.txt
drwxr-xr-x  5 observer  staff    160 Oct 16 12:00 folder/
│└┬┘└┬┘└┬┘
│ │  │  └── остальные (others)
│ │  └───── группа (group)
│ └──────── владелец (user)
└────────── тип: - файл, d папка, l симлинк</code></pre>
    <table class="data-table">
      <thead><tr><th>Буква</th><th>Число</th><th>Для файла</th><th>Для папки</th></tr></thead>
      <tbody>
        <tr><td><code>r</code> read</td><td>4</td><td>Читать содержимое</td><td>Смотреть список файлов</td></tr>
        <tr><td><code>w</code> write</td><td>2</td><td>Изменять</td><td>Создавать и удалять файлы внутри</td></tr>
        <tr><td><code>x</code> execute</td><td>1</td><td>Запускать</td><td><strong>Входить внутрь</strong> (<code>cd</code>)</td></tr>
      </tbody>
    </table>
    <div class="why-box"><strong>Откуда берутся числа вроде 755.</strong> Права складываются: <code>rwx</code> = 4+2+1 = 7, <code>r-x</code> = 4+1 = 5, <code>rw-</code> = 4+2 = 6. Три цифры — это владелец, группа, остальные. <code>755</code> = владельцу всё, остальным читать и заходить. <code>644</code> = владельцу читать-писать, остальным только читать.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="settings-2"></i> chmod и chown</div>
<pre><code>chmod 755 script.sh     <span class="c-comment"># числом</span>
chmod +x script.sh      <span class="c-comment"># добавить право запуска всем</span>
chmod -R 775 storage/   <span class="c-comment"># -R рекурсивно</span>

chown www-data file     <span class="c-comment"># сменить владельца</span>
chown -R www-data:www-data /var/www/app   <span class="c-comment"># владелец:группа</span></code></pre>
    <table class="data-table">
      <thead><tr><th>Права</th><th>Для чего</th></tr></thead>
      <tbody>
        <tr><td><code>644</code></td><td>Обычные файлы: конфиги, исходники</td></tr>
        <tr><td><code>755</code></td><td>Папки и исполняемые скрипты</td></tr>
        <tr><td><code>775</code></td><td><code>storage/</code> и <code>bootstrap/cache/</code> в Laravel — пишет и владелец, и группа веб-сервера</td></tr>
        <tr><td><code>600</code></td><td>Секреты: <code>.env</code>, приватные ключи</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong><code>chmod -R 777</code> — не решение, а дыра.</strong> Это «всем всё можно», включая запись чужими процессами. Проблема почти всегда в <em>владельце</em>, а не в правах: нужен <code>chown -R www-data:www-data</code>, а дальше хватит <code>775</code>.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-bash-pipes" class="section">
  <div class="section-title">Bash: пайпы и перенаправление</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-merge"></i> Пайп — выход одной команды на вход другой</div>
<pre><code>cat app.log | grep error | wc -l       <span class="c-comment"># сколько строк с ошибками</span>
ps aux | grep php | grep -v grep       <span class="c-comment"># процессы PHP без самого grep</span>
du -sh * | sort -rh | head -5          <span class="c-comment"># топ-5 тяжёлых папок</span>
git log --oneline | head -20           <span class="c-comment"># последние 20 коммитов</span></code></pre>
    <div class="remember-box">Символ <code>|</code> соединяет команды в конвейер: то, что первая напечатала, вторая получает на вход. Так из простых команд собираются сложные запросы.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-right-to-line"></i> Перенаправление в файл</div>
<pre><code>command &gt; file.txt      <span class="c-comment"># записать, ПЕРЕЗАПИСАВ файл</span>
command &gt;&gt; file.txt     <span class="c-comment"># дописать в конец</span>
command 2&gt; errors.txt   <span class="c-comment"># только ошибки (поток 2)</span>
command &gt; out.txt 2&gt;&amp;1  <span class="c-comment"># и вывод, и ошибки в один файл</span>
command &gt; /dev/null 2&gt;&amp;1 <span class="c-comment"># выбросить всё</span></code></pre>
    <table class="data-table">
      <thead><tr><th>Поток</th><th>Номер</th><th>Что это</th></tr></thead>
      <tbody>
        <tr><td><code>stdin</code></td><td>0</td><td>Вход</td></tr>
        <tr><td><code>stdout</code></td><td>1</td><td>Обычный вывод</td></tr>
        <tr><td><code>stderr</code></td><td>2</td><td>Ошибки — отдельный поток</td></tr>
      </tbody>
    </table>
    <div class="pitfall"><strong>Ошибки не идут в пайп.</strong> <code>command | grep x</code> фильтрует только <code>stdout</code>. Сообщение об ошибке пролетит мимо фильтра прямо в терминал. Чтобы поймать и его — <code>command 2&gt;&amp;1 | grep x</code>.</div>
    <div class="remember-box"><code>&gt;</code> затирает файл целиком, <code>&gt;&gt;</code> дописывает. Перепутать — потерять лог.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Цепочки команд</div>
<pre><code>cmd1 &amp;&amp; cmd2            <span class="c-comment"># cmd2 только если cmd1 успешна (код 0)</span>
cmd1 || cmd2            <span class="c-comment"># cmd2 только если cmd1 упала</span>
cmd1 ; cmd2             <span class="c-comment"># подряд, независимо от результата</span>
cmd &amp;                   <span class="c-comment"># запустить в фоне</span>

<span class="c-comment"># Типичный деплой — каждый шаг только при успехе предыдущего</span>
git pull &amp;&amp; composer install --no-dev &amp;&amp; php artisan migrate --force</code></pre>
    <div class="why-box"><strong>Почему <code>&amp;&amp;</code>, а не <code>;</code>.</strong> С точкой запятой команды выполнятся все подряд, даже если <code>git pull</code> упал с конфликтом. С <code>&amp;&amp;</code> цепочка остановится на первой ошибке — и ты не накатишь миграции на неполный код.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-git-base" class="section">
  <div class="section-title">Git: от init до push</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="play"></i> Начало работы</div>
<pre><code>git init                        <span class="c-comment"># создать репозиторий в текущей папке</span>
git clone URL                   <span class="c-comment"># скачать существующий</span>
git clone URL my-folder         <span class="c-comment"># в папку с другим именем</span>
git clone --depth 1 URL         <span class="c-comment"># только последний коммит, без истории</span>

<span class="c-comment"># Кто автор коммитов — без этого Git откажется коммитить</span>
git config --global user.name "Имя"
git config --global user.email "mail@example.com"
git config --list               <span class="c-comment"># посмотреть все настройки</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="save"></i> Базовый цикл</div>
<pre><code>git status                  <span class="c-comment"># что изменилось — главная команда</span>
git add file.txt            <span class="c-comment"># добавить файл в индекс</span>
git add .                   <span class="c-comment"># всё из текущей папки и ниже</span>
git add -p                  <span class="c-comment"># по кускам: спросит про каждый фрагмент</span>

git commit -m "Описание"    <span class="c-comment"># зафиксировать то, что в индексе</span>
git commit -am "Описание"   <span class="c-comment"># -a добавить все ОТСЛЕЖИВАЕМЫЕ и закоммитить</span>

git push                    <span class="c-comment"># отправить на сервер</span>
git pull                    <span class="c-comment"># забрать и влить чужие изменения</span></code></pre>
    <div class="pitfall"><strong><code>git commit -am</code> не видит новые файлы.</strong> Флаг <code>-a</code> берёт только то, что Git уже отслеживает. Только что созданный файл не попадёт в коммит, и это легко не заметить. Для новых файлов нужен явный <code>git add</code>.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="history"></i> История и просмотр</div>
<pre><code>git log                     <span class="c-comment"># полная история</span>
git log --oneline           <span class="c-comment"># по строке на коммит</span>
git log --oneline --graph --all   <span class="c-comment"># с деревом веток</span>
git log -5                  <span class="c-comment"># последние 5</span>
git log -p file.txt         <span class="c-comment"># история конкретного файла с диффами</span>
git log --author="Имя"      <span class="c-comment"># коммиты одного автора</span>

git diff                    <span class="c-comment"># что изменено, но НЕ в индексе</span>
git diff --staged           <span class="c-comment"># что в индексе и уйдёт в коммит</span>
git diff main..feature      <span class="c-comment"># разница между ветками</span>

git show HEAD               <span class="c-comment"># последний коммит целиком</span>
git blame file.txt          <span class="c-comment"># кто и когда менял каждую строку</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="eye-off"></i> .gitignore</div>
<pre><code><span class="c-comment"># Типичный для Laravel</span>
/vendor
/node_modules
/public/storage
/storage/*.key
.env
.env.backup
.phpunit.result.cache
.DS_Store</code></pre>
    <div class="pitfall"><strong>.gitignore не действует на уже отслеживаемые файлы.</strong> Закоммитил <code>.env</code>, потом добавил в ignore — он продолжит отслеживаться. Нужно убрать из индекса, оставив на диске:
<br><br><code>git rm --cached .env</code><br><br>
И помнить: из <em>истории</em> он при этом никуда не денется — для этого нужна чистка истории.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-git-states" class="section">
  <div class="section-title">Git: три состояния файла</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Рабочая папка → индекс → репозиторий</div>
    <p class="text">Это ключевая модель Git. Без неё команды отмены выглядят набором случайных заклинаний.</p>
    <div class="diagram">┌──────────────┐   git add    ┌──────────────┐  git commit  ┌──────────────┐
│   Working    │ ───────────→ │   Staging    │ ───────────→ │  Repository  │
│  directory   │              │  (index)     │              │  (.git)      │
│              │ ←─────────── │              │ ←─────────── │              │
└──────────────┘ git restore  └──────────────┘ git reset    └──────────────┘
  файлы на диске              «что войдёт в           зафиксированная
  как ты их видишь             следующий коммит»       история

                    git checkout / git restore --source
   ←──────────────────────────────────────────────────────────</div>
    <table class="data-table">
      <thead><tr><th>Состояние</th><th>Где лежит</th><th>Что значит</th></tr></thead>
      <tbody>
        <tr><td><strong>Modified</strong></td><td>Рабочая папка</td><td>Изменён, но не помечен к коммиту</td></tr>
        <tr><td><strong>Staged</strong></td><td>Индекс</td><td>Помечен — войдёт в следующий коммит</td></tr>
        <tr><td><strong>Committed</strong></td><td>Репозиторий</td><td>Сохранён в истории</td></tr>
        <tr><td><strong>Untracked</strong></td><td>Рабочая папка</td><td>Git о нём вообще не знает</td></tr>
      </tbody>
    </table>
    <div class="why-box"><strong>Зачем вообще индекс.</strong> Он позволяет собрать коммит <em>выборочно</em>: наменял в пяти файлах, но в коммит кладёшь только два относящихся к одной задаче. Отсюда же <code>git add -p</code> — добавить не файл целиком, а отдельные куски.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-git-undo" class="section">
  <div class="section-title">Git: отмена изменений</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="undo-2"></i> Что отменять и чем</div>
    <table class="data-table">
      <thead><tr><th>Задача</th><th>Команда</th></tr></thead>
      <tbody>
        <tr><td>Откатить правки в файле</td><td><code>git restore file.txt</code></td></tr>
        <tr><td>Убрать файл из индекса, правки оставить</td><td><code>git restore --staged file.txt</code></td></tr>
        <tr><td>Поправить последний коммит</td><td><code>git commit --amend</code></td></tr>
        <tr><td>Откатить коммит, сохранив изменения в индексе</td><td><code>git reset --soft HEAD~1</code></td></tr>
        <tr><td>Откатить коммит, изменения в рабочей папке</td><td><code>git reset HEAD~1</code></td></tr>
        <tr><td>Откатить коммит и выбросить изменения</td><td><code>git reset --hard HEAD~1</code></td></tr>
        <tr><td>Отменить коммит <em>новым</em> коммитом</td><td><code>git revert HASH</code></td></tr>
        <tr><td>Удалить неотслеживаемые файлы</td><td><code>git clean -fd</code></td></tr>
      </tbody>
    </table>
    <div class="why-box"><strong><code>reset</code> против <code>revert</code>.</strong> <code>reset</code> <em>переписывает</em> историю — коммита больше нет. <code>revert</code> создаёт новый коммит, который отменяет старый, — история сохраняется. Правило: в своей локальной ветке можно <code>reset</code>; в том, что уже запушено и видно другим, — только <code>revert</code>.</div>
    <div class="pitfall"><strong><code>git reset --hard</code> удаляет изменения безвозвратно.</strong> Незакоммиченная работа пропадёт без возможности вернуть — она нигде не сохранена. Если не уверен, сначала <code>git stash</code>: он спрячет изменения, и их можно будет достать обратно.</div>
    <div class="remember-box"><strong>Спасательный круг — <code>git reflog</code>.</strong> Он помнит, где <code>HEAD</code> был раньше, даже после <code>reset --hard</code> по коммитам. Нашёл нужный хеш — <code>git reset --hard HASH</code> вернёт состояние. Работает только для <em>закоммиченного</em>.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-git-branch" class="section">
  <div class="section-title">Git: ветки и слияние</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-fork"></i> Работа с ветками</div>
<pre><code>git branch                  <span class="c-comment"># список локальных веток</span>
git branch -a               <span class="c-comment"># включая удалённые</span>
git branch feature-x        <span class="c-comment"># создать, но не переключаться</span>

git switch feature-x        <span class="c-comment"># переключиться (современный способ)</span>
git switch -c feature-x     <span class="c-comment"># создать и сразу перейти</span>
git checkout -b feature-x   <span class="c-comment"># то же самое, старый синтаксис</span>

git branch -d feature-x     <span class="c-comment"># удалить влитую ветку</span>
git branch -D feature-x     <span class="c-comment"># удалить принудительно, даже не влитую</span></code></pre>
    <div class="remember-box"><code>switch</code> и <code>restore</code> появились, чтобы разделить обязанности перегруженного <code>checkout</code>: он умел и переключать ветки, и восстанавливать файлы. Старый синтаксис работает, но новый понятнее.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-merge"></i> Слияние и конфликты</div>
<pre><code>git switch main
git merge feature-x         <span class="c-comment"># влить feature-x в текущую ветку</span>

<span class="c-comment"># При конфликте Git остановится и разметит файл:</span>
<span class="c-comment"># &lt;&lt;&lt;&lt;&lt;&lt;&lt; HEAD        — что в твоей ветке</span>
<span class="c-comment"># =======              — граница</span>
<span class="c-comment"># &gt;&gt;&gt;&gt;&gt;&gt;&gt; feature-x   — что во вливаемой</span>

git status                  <span class="c-comment"># покажет конфликтные файлы</span>
<span class="c-comment"># правишь руками, убираешь маркеры, затем:</span>
git add file.txt
git commit                  <span class="c-comment"># завершить слияние</span>

git merge --abort           <span class="c-comment"># передумал — откатить слияние целиком</span></code></pre>
    <div class="pitfall"><strong>Забытые маркеры конфликта.</strong> Если <code>&lt;&lt;&lt;&lt;&lt;&lt;&lt;</code> или <code>&gt;&gt;&gt;&gt;&gt;&gt;&gt;</code> останутся в коде, он закоммитится и сломается при запуске. Перед коммитом слияния: <code>grep -rn "&lt;&lt;&lt;&lt;&lt;&lt;&lt;" .</code></div>
    <div class="remember-box">Rebase, squash и cherry-pick разобраны в <strong>Testing &amp; DevOps → Git Advanced</strong>.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-git-remote" class="section">
  <div class="section-title">Git: remote и теги</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cloud"></i> Удалённые репозитории</div>
<pre><code>git remote -v                       <span class="c-comment"># какие remote настроены</span>
git remote add origin URL           <span class="c-comment"># добавить</span>
git remote set-url origin NEW_URL   <span class="c-comment"># сменить адрес</span>

git fetch                   <span class="c-comment"># забрать изменения, НЕ применяя</span>
git pull                    <span class="c-comment"># fetch + merge одной командой</span>
git pull --rebase           <span class="c-comment"># fetch + rebase — история линейнее</span>

git push                            <span class="c-comment"># отправить текущую ветку</span>
git push -u origin feature-x        <span class="c-comment"># -u связать с удалённой при первом пуше</span>
git push --force-with-lease         <span class="c-comment"># безопасный force</span></code></pre>
    <div class="why-box"><strong><code>fetch</code> против <code>pull</code>.</strong> <code>fetch</code> только скачивает изменения — ты можешь посмотреть их через <code>git log origin/main</code> и решить, что делать. <code>pull</code> сразу вливает в текущую ветку. Когда не уверен в состоянии ветки, безопаснее сначала <code>fetch</code>.</div>
    <div class="pitfall"><strong><code>--force</code> против <code>--force-with-lease</code>.</strong> Обычный <code>--force</code> затирает удалённую ветку безусловно — вместе с коммитами коллеги, которые тот запушил минуту назад. <code>--force-with-lease</code> сначала проверяет, что на сервере то, что ты видел последним, и откажется, если кто-то успел запушить. Привычка должна быть на вторую форму.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="tag"></i> Теги</div>
<pre><code>git tag                         <span class="c-comment"># список тегов</span>
git tag v1.0.0                  <span class="c-comment"># лёгкий тег на текущий коммит</span>
git tag -a v1.0.0 -m "Релиз"    <span class="c-comment"># аннотированный: с автором и датой</span>
git tag -a v1.0.0 HASH          <span class="c-comment"># тег на конкретный коммит</span>

git push origin v1.0.0          <span class="c-comment"># теги НЕ уходят с обычным push</span>
git push --tags                 <span class="c-comment"># отправить все теги</span>
git tag -d v1.0.0               <span class="c-comment"># удалить локально</span></code></pre>
    <div class="remember-box">Теги не отправляются при обычном <code>git push</code> — их нужно пушить явно. Для релизов используют аннотированные (<code>-a</code>): в них есть автор, дата и сообщение.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-comp-base" class="section">
  <div class="section-title">Composer: база и зависимости</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package"></i> Что такое Composer</div>
    <p class="text">Менеджер зависимостей для PHP. Решает две задачи: <strong>ставит библиотеки</strong> нужных версий со всеми их зависимостями и <strong>настраивает автозагрузку</strong>, чтобы классы подключались без ручных <code>require</code>.</p>
    <table class="data-table">
      <thead><tr><th>Файл</th><th>Что это</th><th>В Git?</th></tr></thead>
      <tbody>
        <tr><td><code>composer.json</code></td><td>Что тебе нужно — список зависимостей с допустимыми версиями</td><td><strong>Да</strong></td></tr>
        <tr><td><code>composer.lock</code></td><td>Что реально установлено — точные версии до коммита</td><td><strong>Да</strong></td></tr>
        <tr><td><code>vendor/</code></td><td>Сами библиотеки</td><td><strong>Нет</strong></td></tr>
      </tbody>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="terminal"></i> Основные команды</div>
<pre><code>composer init                       <span class="c-comment"># создать composer.json интерактивно</span>
composer require guzzlehttp/guzzle  <span class="c-comment"># поставить пакет и записать в json</span>
composer require --dev phpunit/phpunit   <span class="c-comment"># только для разработки</span>
composer require guzzlehttp/guzzle:^7.5  <span class="c-comment"># конкретное ограничение версии</span>

composer remove guzzlehttp/guzzle   <span class="c-comment"># удалить пакет</span>
composer show                       <span class="c-comment"># что установлено</span>
composer show guzzlehttp/guzzle     <span class="c-comment"># подробности о пакете</span>
composer outdated                   <span class="c-comment"># у чего есть обновления</span>
composer why vendor/package         <span class="c-comment"># КТО тянет этот пакет</span>
composer validate                   <span class="c-comment"># проверить composer.json</span>
composer audit                      <span class="c-comment"># известные уязвимости в зависимостях</span></code></pre>
    <div class="remember-box"><code>composer why</code> отвечает на вопрос «откуда в проекте взялся этот пакет, я его не ставил» — покажет цепочку зависимостей, которая его притянула.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-comp-lock" class="section">
  <div class="section-title">Composer: install против update</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-lock-2"></i> Главное различие</div>
    <table class="data-table">
      <thead><tr><th></th><th><code>composer install</code></th><th><code>composer update</code></th></tr></thead>
      <tbody>
        <tr><td><strong>Читает</strong></td><td><code>composer.lock</code></td><td><code>composer.json</code></td></tr>
        <tr><td><strong>Ставит</strong></td><td>Точно те версии, что в lock</td><td>Самые свежие в рамках ограничений</td></tr>
        <tr><td><strong>Меняет lock</strong></td><td>Нет</td><td><strong>Да</strong>, перезаписывает</td></tr>
        <tr><td><strong>Где запускать</strong></td><td>На проде, в CI, у новых разработчиков</td><td>Локально, осознанно</td></tr>
        <tr><td><strong>Воспроизводимость</strong></td><td>Полная — у всех одинаково</td><td>Зависит от момента запуска</td></tr>
      </tbody>
    </table>
    <div class="why-box"><strong>Зачем нужен <code>composer.lock</code>.</strong> В <code>composer.json</code> написано <code>"^7.5"</code> — это «любая 7.x от 7.5». Поставишь сегодня — приедет 7.8, через месяц — 7.9 с поправленным поведением. Lock фиксирует точный коммит каждой библиотеки, и <code>install</code> воспроизводит ровно его. Поэтому lock-файл <strong>обязательно в Git</strong>: именно он гарантирует, что на проде и у коллеги соберётся то же самое.</div>
    <div class="pitfall"><strong><code>composer update</code> на проде — частая и дорогая ошибка.</strong> Она подтянет свежие версии, которых никто не тестировал, и перепишет lock прямо на сервере. На проде только:
<br><br><code>composer install --no-dev --optimize-autoloader</code></div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="rocket"></i> Флаги для прода</div>
<pre><code>composer install --no-dev --optimize-autoloader --no-interaction

<span class="c-comment"># --no-dev               не ставить require-dev (phpunit, faker, debugbar)
# --optimize-autoloader  собрать статическую карту классов вместо поиска по файлам
# --no-interaction       ничего не спрашивать — обязательно для CI
# --prefer-dist          ставить архивы вместо клонирования репозиториев</span>

composer update vendor/package      <span class="c-comment"># обновить ОДИН пакет, не всё подряд</span>
composer update --lock              <span class="c-comment"># пересобрать lock без переустановки</span></code></pre>
    <div class="remember-box"><code>--optimize-autoloader</code> на проде даёт заметный прирост: вместо поиска файла по PSR-4 при каждом обращении к классу Composer собирает готовую карту «класс → путь».</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-comp-versions" class="section">
  <div class="section-title">Composer: версии и ограничения</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="tag"></i> Semver и операторы</div>
    <p class="text">Версия пишется как <code>MAJOR.MINOR.PATCH</code>, например <code>7.5.2</code>. Правило семантического версионирования: <strong>MAJOR</strong> меняется при ломающих изменениях, <strong>MINOR</strong> — при новых совместимых возможностях, <strong>PATCH</strong> — при исправлениях.</p>
    <table class="data-table">
      <thead><tr><th>Запись</th><th>Что разрешает</th><th>Диапазон</th></tr></thead>
      <tbody>
        <tr><td><code>^7.5</code></td><td>Не менять MAJOR — самый частый вариант</td><td>&gt;= 7.5.0, &lt; 8.0.0</td></tr>
        <tr><td><code>~7.5</code></td><td>Не менять MINOR</td><td>&gt;= 7.5.0, &lt; 8.0.0</td></tr>
        <tr><td><code>~7.5.2</code></td><td>Только PATCH</td><td>&gt;= 7.5.2, &lt; 7.6.0</td></tr>
        <tr><td><code>7.5.*</code></td><td>Любой PATCH внутри 7.5</td><td>&gt;= 7.5.0, &lt; 7.6.0</td></tr>
        <tr><td><code>7.5.2</code></td><td>Ровно эта версия</td><td>= 7.5.2</td></tr>
        <tr><td><code>&gt;=7.5 &lt;8.0</code></td><td>Явный диапазон</td><td>как написано</td></tr>
        <tr><td><code>*</code></td><td>Любая — так не делают</td><td>всё подряд</td></tr>
      </tbody>
    </table>
    <div class="why-box"><strong><code>^</code> против <code>~</code> — в чём подвох.</strong> Для записи из двух чисел они совпадают: <code>^7.5</code> и <code>~7.5</code> оба означают «до 8.0». Разница появляется с тремя: <code>^7.5.2</code> разрешит 7.9.0, а <code>~7.5.2</code> остановится на 7.5.x. Проще держать в голове так: <code>^</code> гибче, <code>~</code> консервативнее.</div>
    <div class="pitfall"><strong>Фиксация точной версии мешает безопасности.</strong> <code>"guzzlehttp/guzzle": "7.5.2"</code> означает, что патчи с исправлением уязвимостей не приедут никогда. Для фиксации есть <code>composer.lock</code> — в <code>composer.json</code> держат диапазон, а воспроизводимость обеспечивает lock.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-comp-autoload" class="section">
  <div class="section-title">Composer: автозагрузка и скрипты</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Секция autoload</div>
<pre><code>{
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/"
        },
        "files": ["app/helpers.php"],
        "classmap": ["database/seeders"]
    },
    "autoload-dev": {
        "psr-4": { "Tests\\": "tests/" }
    }
}</code></pre>
    <table class="data-table">
      <thead><tr><th>Способ</th><th>Как работает</th></tr></thead>
      <tbody>
        <tr><td><code>psr-4</code></td><td>Namespace ↔ папка. <code>App\Services\Foo</code> → <code>app/Services/Foo.php</code>. Основной способ</td></tr>
        <tr><td><code>files</code></td><td>Подключается <strong>всегда</strong>, при каждом запросе. Для функций-хелперов, у которых нет класса</td></tr>
        <tr><td><code>classmap</code></td><td>Сканирует папку и строит карту классов. Для кода без namespace</td></tr>
      </tbody>
    </table>
<pre><code>composer dump-autoload              <span class="c-comment"># пересобрать карту автозагрузки</span>
composer dump-autoload -o           <span class="c-comment"># -o оптимизированная (= --optimize)</span></code></pre>
    <div class="pitfall"><strong>Добавил <code>files</code> или новый namespace — нужен <code>dump-autoload</code>.</strong> Правка <code>composer.json</code> сама по себе ничего не меняет: карта автозагрузки лежит в <code>vendor/composer/</code> и пересобирается только этой командой. Симптом — «Class not found» на файле, который очевидно существует.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="play-circle"></i> Скрипты</div>
<pre><code>{
    "scripts": {
        "test": "phpunit",
        "lint": "pint --test",
        "post-autoload-dump": [
            "@php artisan package:discover --ansi"
        ],
        "post-install-cmd": ["@php artisan optimize"]
    }
}</code></pre>
<pre><code>composer test               <span class="c-comment"># запустить свой скрипт</span>
composer run-script test    <span class="c-comment"># то же явно</span>
composer list               <span class="c-comment"># все доступные команды</span></code></pre>
    <table class="data-table">
      <thead><tr><th>Хук</th><th>Когда срабатывает</th></tr></thead>
      <tbody>
        <tr><td><code>post-install-cmd</code></td><td>После <code>composer install</code></td></tr>
        <tr><td><code>post-update-cmd</code></td><td>После <code>composer update</code></td></tr>
        <tr><td><code>post-autoload-dump</code></td><td>После пересборки автозагрузки — здесь Laravel ищет пакеты</td></tr>
      </tbody>
    </table>
    <div class="remember-box">Скрипты удобны как единая точка входа: <code>composer test</code> работает одинаково на любой машине, независимо от того, где лежит бинарник phpunit.</div>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-cheatsheet" class="section">
  <div class="section-title">Шпаргалка</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="terminal"></i> Bash — что нужно каждый день</div>
    <table class="data-table">
      <thead><tr><th>Задача</th><th>Команда</th></tr></thead>
      <tbody>
        <tr><td>Следить за логом</td><td><code>tail -f storage/logs/laravel.log</code></td></tr>
        <tr><td>Найти по содержимому</td><td><code>grep -rn "текст" app/</code></td></tr>
        <tr><td>Найти файл</td><td><code>find . -name "*.php"</code></td></tr>
        <tr><td>Что занимает место</td><td><code>du -sh * | sort -rh | head</code></td></tr>
        <tr><td>Кто занял порт</td><td><code>lsof -i :8000</code></td></tr>
        <tr><td>Убить процесс</td><td><code>pkill -f "artisan queue"</code></td></tr>
        <tr><td>Права для Laravel</td><td><code>chown -R www-data:www-data storage bootstrap/cache</code></td></tr>
      </tbody>
    </table>
  </div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-branch"></i> Git — что нужно каждый день</div>
    <table class="data-table">
      <thead><tr><th>Задача</th><th>Команда</th></tr></thead>
      <tbody>
        <tr><td>Что изменилось</td><td><code>git status</code></td></tr>
        <tr><td>История коротко</td><td><code>git log --oneline --graph</code></td></tr>
        <tr><td>Новая ветка</td><td><code>git switch -c feature-x</code></td></tr>
        <tr><td>Откатить правки в файле</td><td><code>git restore file.php</code></td></tr>
        <tr><td>Убрать из индекса</td><td><code>git restore --staged file.php</code></td></tr>
        <tr><td>Поправить последний коммит</td><td><code>git commit --amend</code></td></tr>
        <tr><td>Отменить запушенный коммит</td><td><code>git revert HASH</code></td></tr>
        <tr><td>Спасти после reset --hard</td><td><code>git reflog</code></td></tr>
      </tbody>
    </table>
  </div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package"></i> Composer — что нужно каждый день</div>
    <table class="data-table">
      <thead><tr><th>Задача</th><th>Команда</th></tr></thead>
      <tbody>
        <tr><td>Поставить пакет</td><td><code>composer require vendor/package</code></td></tr>
        <tr><td>Поставить по lock</td><td><code>composer install</code></td></tr>
        <tr><td>Деплой на прод</td><td><code>composer install --no-dev --optimize-autoloader</code></td></tr>
        <tr><td>Обновить один пакет</td><td><code>composer update vendor/package</code></td></tr>
        <tr><td>Откуда взялся пакет</td><td><code>composer why vendor/package</code></td></tr>
        <tr><td>Что устарело</td><td><code>composer outdated</code></td></tr>
        <tr><td>Уязвимости</td><td><code>composer audit</code></td></tr>
        <tr><td>Class not found</td><td><code>composer dump-autoload</code></td></tr>
      </tbody>
    </table>
  </div>
</div>

@endverbatim
@verbatim
<div id="sec-pitfalls" class="section">
  <div class="section-title">Подводные камни</div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-octagon"></i> Bash</div>
    <div class="pitfall"><strong><code>rm -rf</code> с пустой переменной.</strong> <code>rm -rf $DIR/</code> при незаданной <code>$DIR</code> превращается в <code>rm -rf /</code>. Всегда кавычки и проверка: <code>rm -rf "${DIR:?переменная не задана}"</code>.</div>
    <div class="pitfall"><strong><code>&gt;</code> вместо <code>&gt;&gt;</code>.</strong> Одна лишняя стрелка — и лог перезаписан вместо дописывания.</div>
    <div class="pitfall"><strong>Ошибки не попадают в пайп.</strong> <code>cmd | grep x</code> фильтрует только stdout. Нужен <code>cmd 2&gt;&amp;1 | grep x</code>.</div>
    <div class="pitfall"><strong><code>chmod 777</code> как решение любой проблемы с правами.</strong> Почти всегда настоящая причина — неверный владелец. Сначала <code>chown</code>, потом 775.</div>
  </div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-branch"></i> Git</div>
    <div class="pitfall"><strong><code>git commit -am</code> не берёт новые файлы.</strong> Только отслеживаемые. Новый файл тихо не попадёт в коммит.</div>
    <div class="pitfall"><strong><code>.gitignore</code> не влияет на уже отслеживаемое.</strong> Нужен <code>git rm --cached</code>. А из истории файл при этом не исчезнет.</div>
    <div class="pitfall"><strong><code>push --force</code> затирает чужую работу.</strong> Всегда <code>--force-with-lease</code>.</div>
    <div class="pitfall"><strong><code>reset --hard</code> съедает незакоммиченное без следа.</strong> <code>reflog</code> спасёт только то, что было в коммитах.</div>
    <div class="pitfall"><strong>Маркеры конфликта в коммите.</strong> Перед завершением слияния: <code>grep -rn "&lt;&lt;&lt;&lt;&lt;&lt;&lt;" .</code></div>
  </div>
  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package"></i> Composer</div>
    <div class="pitfall"><strong><code>composer update</code> на проде.</strong> Подтянет непротестированные версии и перепишет lock на сервере. Только <code>install</code>.</div>
    <div class="pitfall"><strong><code>composer.lock</code> не в Git.</strong> Тогда у всех разные версии, и «у меня работает» становится нормой.</div>
    <div class="pitfall"><strong><code>vendor/</code> в Git.</strong> Десятки тысяч чужих файлов в истории, конфликты при каждом merge. Место <code>vendor/</code> — в <code>.gitignore</code>.</div>
    <div class="pitfall"><strong>Забытый <code>dump-autoload</code>.</strong> Добавил namespace или хелпер — получи «Class not found» на существующем файле.</div>
    <div class="pitfall"><strong><code>--no-dev</code> на машине разработчика.</strong> Снесёт phpunit и остальные dev-зависимости. Этот флаг только для прода и CI.</div>
  </div>
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
