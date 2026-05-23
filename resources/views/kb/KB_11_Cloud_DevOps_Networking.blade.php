@verbatim
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cloud &amp; DevOps — Виртуализация и Сети (понятный гид)</title>
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
.analogy{background:#F8F5FF;border-left:4px solid #6F4FBA;border-radius:var(--radius);padding:14px 16px;margin-bottom:16px;font-size:13px;line-height:1.75;color:#3C2E66;}
.analogy strong{color:#1F1538;font-weight:700;}
.why-box{background:#FFF8E1;border-left:4px solid #E0A000;border-radius:var(--radius);padding:14px 16px;margin-bottom:16px;font-size:13px;line-height:1.75;color:#7B5000;}
.why-box strong{color:#3F2C00;font-weight:700;}
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:18px 20px;margin-bottom:16px;box-shadow:var(--shadow);}
.card h3{font-size:14px;font-weight:700;color:var(--text);margin-bottom:8px;display:flex;align-items:center;gap:8px;}
pre{background:var(--code-bg);border:1px solid var(--code-border);border-radius:var(--radius);padding:16px 18px;overflow-x:auto;margin-bottom:14px;font-size:12.5px;line-height:1.65;}
pre code{color:#ABB2BF;font-family:'JetBrains Mono','Fira Code',Consolas,monospace;}
.diagram{background:#1E1E2D;color:#ABB2BF;border-radius:var(--radius);padding:18px;overflow-x:auto;font-family:'JetBrains Mono',monospace;font-size:12px;line-height:1.5;white-space:pre;margin-bottom:14px;}
.data-table{width:100%;border-collapse:collapse;margin-bottom:16px;font-size:13px;}
.data-table th{background:var(--bg);padding:10px 14px;text-align:left;font-weight:700;font-size:11px;text-transform:uppercase;letter-spacing:0.5px;color:var(--text2);border-bottom:1px solid var(--border);}
.data-table td{padding:10px 14px;border-bottom:1px solid var(--border);color:var(--text2);vertical-align:top;}
.data-table td strong{color:var(--text);font-weight:600;}
.data-table tr:last-child td{border-bottom:none;}
ul.bullets{margin:8px 0 14px 22px;color:var(--text2);font-size:13px;line-height:1.85;}
ul.bullets li{margin-bottom:4px;}
ul.bullets strong{color:var(--text);}
</style>
</head>
<body>
<div class="container">
<div class="sidebar">
  <a href="/" class="sidebar-back"><i data-lucide="arrow-left"></i> На главную</a>
  <div class="sidebar-title">Cloud &amp; DevOps</div>
  <a class="nav-item active" onclick="showSection('overview',this)"><i data-lucide="info"></i> О разделе</a>

  <div class="nav-group-label">Виртуализация</div>
  <a class="nav-item" onclick="showSection('virtualization',this)"><i data-lucide="box"></i> Что такое виртуализация</a>
  <a class="nav-item" onclick="showSection('vms',this)"><i data-lucide="monitor"></i> VM и Гипервизоры</a>

  <div class="nav-group-label">Основы сетей</div>
  <a class="nav-item" onclick="showSection('history',this)"><i data-lucide="history"></i> История сетей</a>
  <a class="nav-item" onclick="showSection('net-types',this)"><i data-lucide="network"></i> Типы сетей</a>
  <a class="nav-item" onclick="showSection('topologies',this)"><i data-lucide="git-merge"></i> Топологии</a>
  <a class="nav-item" onclick="showSection('devices',this)"><i data-lucide="router"></i> Сетевые устройства</a>

  <div class="nav-group-label">Модели (уровни)</div>
  <a class="nav-item" onclick="showSection('osi',this)"><i data-lucide="layers"></i> Модель OSI (7 уровней)</a>
  <a class="nav-item" onclick="showSection('tcpip',this)"><i data-lucide="layers-3"></i> Модель TCP/IP (4–5 ур.)</a>
  <a class="nav-item" onclick="showSection('encap',this)"><i data-lucide="package"></i> Инкапсуляция</a>

  <div class="nav-group-label">Адреса</div>
  <a class="nav-item" onclick="showSection('mac',this)"><i data-lucide="cpu"></i> MAC адрес</a>
  <a class="nav-item" onclick="showSection('ipv4',this)"><i data-lucide="map-pin"></i> IPv4</a>
  <a class="nav-item" onclick="showSection('ipv6',this)"><i data-lucide="map"></i> IPv6</a>

  <div class="nav-group-label">Протоколы</div>
  <a class="nav-item" onclick="showSection('arp',this)"><i data-lucide="search"></i> ARP</a>
  <a class="nav-item" onclick="showSection('tcp',this)"><i data-lucide="phone-call"></i> TCP</a>
  <a class="nav-item" onclick="showSection('udp',this)"><i data-lucide="zap"></i> UDP</a>
  <a class="nav-item" onclick="showSection('icmp',this)"><i data-lucide="activity"></i> ICMP (ping)</a>
  <a class="nav-item" onclick="showSection('ports',this)"><i data-lucide="door-open"></i> Порты</a>

  <div class="nav-group-label">Подсети</div>
  <a class="nav-item" onclick="showSection('subnets-why',this)"><i data-lucide="scissors"></i> Зачем подсети</a>
  <a class="nav-item" onclick="showSection('subnets-cidr',this)"><i data-lucide="ruler"></i> Маски и CIDR</a>
  <a class="nav-item" onclick="showSection('subnets-private',this)"><i data-lucide="shield"></i> Приватные сети + NAT</a>
  <a class="nav-item" onclick="showSection('subnets-vlsm',this)"><i data-lucide="scaling"></i> FLSM vs VLSM</a>

  <div class="nav-group-label">VLAN</div>
  <a class="nav-item" onclick="showSection('vlan',this)"><i data-lucide="git-fork"></i> VLAN &amp; 802.1Q</a>

  <div class="nav-group-label">Сводка</div>
  <a class="nav-item" onclick="showSection('cheatsheet',this)"><i data-lucide="bookmark"></i> Шпаргалка</a>
</div>

<div class="main">
<div class="page-header">
  <h1>Cloud &amp; DevOps — Виртуализация и Сети</h1>
  <p>Подробный понятный гид: каждое понятие с «зачем оно нужно», аналогией из реальной жизни и наглядной схемой. Без жаргона ради жаргона.</p>
  <div class="badge-row">
    <span class="badge">DevOps</span>
    <span class="badge">Networking</span>
    <span class="badge">Virtualization</span>
    <span class="badge badge-success">Понятно</span>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     OVERVIEW
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-overview" class="section active">
  <div class="section-title">О разделе</div>

  <p class="text">Бэкенд-разработчику <strong>обязательно</strong> понимать, как устроены сети и виртуализация. Без этого нельзя:</p>
  <ul class="bullets">
    <li>задеплоить приложение (нужно понимать VM, контейнер, IP, порты);</li>
    <li>отладить «у меня работает, а на проде нет» (firewall, NAT, DNS, MTU);</li>
    <li>спроектировать инфраструктуру (подсети, VPC в AWS, VLAN);</li>
    <li>общаться с DevOps-инженерами на одном языке.</li>
  </ul>

  <div class="info-box primary">
    <strong>Цель страницы:</strong> объяснить базу сетей и виртуализации так, чтобы у тебя в голове сложилась <strong>правильная картина</strong>: что такое MAC vs IP, почему есть OSI и TCP/IP одновременно, как пакет проходит от твоего ноутбука до сервера Google и обратно, зачем нужны подсети и VLAN.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map"></i> Карта раздела</div>
    <table class="data-table">
      <tr><th>Блок</th><th>Что узнаешь</th></tr>
      <tr><td><strong>Виртуализация</strong></td><td>Что такое VM, гипервизор Type 1 / Type 2 / Hybrid, чем отличается от контейнера</td></tr>
      <tr><td><strong>Основы сетей</strong></td><td>PAN/LAN/WAN, топологии, hub/switch/router/gateway/modem</td></tr>
      <tr><td><strong>Модели OSI и TCP/IP</strong></td><td>7 уровней OSI vs 4–5 TCP/IP, как пакет «упаковывается» (encapsulation)</td></tr>
      <tr><td><strong>Адреса</strong></td><td>MAC (локально), IPv4 (глобально), IPv6 (будущее)</td></tr>
      <tr><td><strong>Протоколы</strong></td><td>ARP, TCP, UDP, ICMP, порты</td></tr>
      <tr><td><strong>Подсети</strong></td><td>Маски, CIDR, NAT, VLSM — как делят сети</td></tr>
      <tr><td><strong>VLAN</strong></td><td>Логическое разделение сети, 802.1Q tagging</td></tr>
    </table>
  </div>

  <div class="analogy">
    <strong>Аналогия для всей темы:</strong> сеть — это <strong>почтовая система</strong>. MAC — это твоё имя в комнате. IP — это адрес здания и квартиры. Порт — номер двери. TCP — заказное письмо с уведомлением. UDP — открытка. ARP — звонок соседу: «эй, кто такой Сергей?». Switch — почтальон внутри здания. Router — почтовое отделение между городами.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     VIRTUALIZATION
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-virtualization" class="section">
  <div class="section-title">Виртуализация — что это</div>

  <p class="text"><strong>Виртуализация</strong> — это создание программной копии чего-то физического (компьютера, сети, диска), которая ведёт себя как настоящая, но живёт внутри другого компьютера.</p>

  <p class="text" style="text-align:center;"><img src="https://elearn.epam.com/assets/courseware/v1/1099089299c5f19615db8537ba129f8f/asset-v1:RD_CEE+HE+0622+type@asset+block/CS8_Pic1_large.png" alt="Virtualization overview" style="max-width:100%;border:1px solid var(--border);border-radius:8px;" onerror="this.style.display='none'"></p>

  <div class="why-box">
    <strong>Зачем:</strong> один физический сервер стоит дорого и обычно загружен на 10-20%. Если на нём запустить 5 виртуальных серверов — он начнёт «окупаться». Плюс изоляция: один сервис упал → другие живут. Плюс мобильность: VM-файл можно скопировать на другой сервер.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="grid-3x3"></i> Виды виртуализации</div>
    <p class="text" style="text-align:center;"><img src="https://elearn.epam.com/assets/courseware/v1/5b2da64901632b2a1199a87ebd0b2796/asset-v1:RD_CEE+HE+0622+type@asset+block/CS8_Pic2_large.png" alt="Types of virtualization" style="max-width:100%;border:1px solid var(--border);border-radius:8px;" onerror="this.style.display='none'"></p>
    <table class="data-table">
      <tr><th>Тип</th><th>Что виртуализируется</th><th>Пример</th></tr>
      <tr><td><strong>Hardware (Server)</strong></td><td>Целый компьютер (CPU + RAM + диск)</td><td>VMware ESXi, KVM, Hyper-V</td></tr>
      <tr><td><strong>Desktop</strong></td><td>Рабочий стол отдельно от железа</td><td>Citrix, VDI</td></tr>
      <tr><td><strong>Application</strong></td><td>Приложение запускается без установки</td><td>Microsoft App-V, Docker (отчасти)</td></tr>
      <tr><td><strong>Network</strong></td><td>Несколько физ. сетей видны как одна (или наоборот)</td><td>VLAN, VPC, SDN</td></tr>
      <tr><td><strong>Storage</strong></td><td>Несколько дисков как один большой</td><td>SAN, RAID, S3, Ceph</td></tr>
      <tr><td><strong>Mobile</strong></td><td>Виртуализация на телефонах</td><td>Android dual-instance</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers-2"></i> Full Virtualization vs Paravirtualization</div>
    <table class="data-table">
      <tr><th>Признак</th><th>Full Virtualization</th><th>Paravirtualization</th></tr>
      <tr><td><strong>Гостевая ОС знает, что она в VM?</strong></td><td>❌ Нет — думает, что на реальном железе</td><td>✅ Да — специально модифицирована</td></tr>
      <tr><td><strong>Как работает</strong></td><td>Гипервизор «переводит» инструкции на лету (binary translation)</td><td>ОС вызывает гипервизор напрямую (hypercalls)</td></tr>
      <tr><td><strong>Скорость</strong></td><td>Медленнее (доп. перевод)</td><td>Быстрее</td></tr>
      <tr><td><strong>Совместимость</strong></td><td>Любая ОС без изменений</td><td>Нужна модификация гостя</td></tr>
    </table>
    <div class="info-box primary">Сегодня граница размыта — Intel VT-x и AMD-V добавили в CPU инструкции для виртуализации, поэтому full virtualization стала быстрой.</div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     VMs and Hypervisors
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-vms" class="section">
  <div class="section-title">VM и Гипервизоры</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="monitor"></i> Что такое VM</div>
    <p class="text"><strong>Virtual Machine (VM)</strong> — это файл (точнее, набор файлов) на диске, который имитирует целый компьютер: своя ОС, своё «железо», свои настройки сети.</p>
    <p class="text">3 ключевых свойства VM:</p>
    <ul class="bullets">
      <li><strong>Partitioning</strong> — на одном хосте могут жить много VM, делят CPU/RAM/диск.</li>
      <li><strong>Isolation</strong> — VM не видят друг друга (если так настроено), их можно безопасно изолировать.</li>
      <li><strong>Encapsulation</strong> — VM — это файлы. Можно скопировать на другой сервер, сделать снапшот, бэкап.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="cpu"></i> Гипервизор — это что</div>
    <p class="text"><strong>Гипервизор</strong> — программа (или прошивка / железо), которая создаёт и запускает VM. Это «прослойка», которая делит ресурсы реального компа между виртуальными.</p>
    <p class="text" style="text-align:center;"><img src="https://elearn.epam.com/assets/courseware/v1/69ed6853e618d3d8b7ff2f881f01b30b/asset-v1:RD_CEE+HE+0622+type@asset+block/CS8_Pic4_large.png" alt="Hypervisor concept" style="max-width:100%;border:1px solid var(--border);border-radius:8px;" onerror="this.style.display='none'"></p>

    <div class="analogy">
      <strong>Аналогия:</strong> представь, что у тебя есть один большой дом (сервер). Гипервизор — это управляющий, который сдаёт комнаты квартирантам (VM). Каждый квартирант думает, что живёт в своей отдельной квартире, но на самом деле они делят одни и те же ресурсы (вода, электричество, плита).
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> 3 типа гипервизоров</div>
    <table class="data-table">
      <tr><th>Тип</th><th>Где живёт</th><th>Скорость</th><th>Примеры</th></tr>
      <tr><td><strong>Type 1 — Native / Bare Metal</strong></td><td>Прямо на железе, без хостовой ОС</td><td>Самый быстрый</td><td>VMware ESXi, KVM, Hyper-V, Citrix XenServer</td></tr>
      <tr><td><strong>Type 2 — Hosted</strong></td><td>Внутри обычной ОС (Windows/Mac/Linux)</td><td>Медленнее</td><td>VirtualBox, VMware Workstation, Parallels Desktop, QEMU</td></tr>
      <tr><td><strong>Type 3 — Hybrid</strong></td><td>Тонкий гипервизор + служебная ОС</td><td>Средне</td><td>Microsoft Hyper-V (в Win Server), Xen</td></tr>
    </table>

    <div class="diagram">┌─────────────── Type 1 (Bare Metal) ──────────────┐
│                                                    │
│  ┌───────┐ ┌───────┐ ┌───────┐                    │
│  │ VM 1  │ │ VM 2  │ │ VM 3  │  ← гостевые ОС    │
│  └───────┘ └───────┘ └───────┘                    │
│  ─────────── Hypervisor ──────────                 │
│  ─────────── Hardware (CPU/RAM/Disk) ─────        │
└────────────────────────────────────────────────────┘

┌─────────────── Type 2 (Hosted) ──────────────────┐
│                                                    │
│  ┌───────┐ ┌───────┐                              │
│  │ VM 1  │ │ VM 2  │  ← гостевые ОС              │
│  └───────┘ └───────┘                              │
│  ──────── Hypervisor (VirtualBox) ────            │
│  ──────── Host OS (Windows/Mac/Linux) ────        │
│  ──────── Hardware ──────                          │
└────────────────────────────────────────────────────┘</div>

    <div class="info-box success">
      <strong>На практике:</strong> <code>VirtualBox</code> на твоём ноутбуке — это Type 2 (поверх macOS). А продакшен-серверы у хостеров (DigitalOcean, AWS EC2) — это Type 1 (KVM/Xen прямо на железе).
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package"></i> VM vs Container — путаница</div>
    <p class="text">Часто путают VM и Docker-контейнер. Главное различие:</p>
    <table class="data-table">
      <tr><th></th><th>VM</th><th>Container (Docker)</th></tr>
      <tr><td><strong>Что внутри</strong></td><td>Полная ОС + ядро + приложение</td><td>Только приложение + библиотеки. Ядро общее с хостом</td></tr>
      <tr><td><strong>Размер</strong></td><td>Гигабайты (полный диск ОС)</td><td>Мегабайты</td></tr>
      <tr><td><strong>Запуск</strong></td><td>Минуты (загрузка ОС)</td><td>Миллисекунды</td></tr>
      <tr><td><strong>Изоляция</strong></td><td>Полная (отдельное ядро)</td><td>Процессная (общее ядро Linux)</td></tr>
      <tr><td><strong>Когда выбирать</strong></td><td>Разные ОС (Windows + Linux), сильная изоляция</td><td>Микросервисы, CI/CD, скорость</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-square"></i> Практика — установить VM в VirtualBox</div>
    <ol class="bullets" style="list-style:decimal;">
      <li>Скачать VirtualBox с <code>virtualbox.org</code>.</li>
      <li>Скачать ISO с Ubuntu Server / Desktop с <code>ubuntu.com</code>.</li>
      <li>Создать VM, указать ISO как загрузочный диск, выделить 4 ГБ RAM и 20 ГБ диска.</li>
      <li>Установить Ubuntu, попробовать команды управления: Start, Stop, Pause, Save State.</li>
      <li>Сделать клон VM (Clone) — увидишь, что копия запускается независимо.</li>
      <li>Сделать снапшот (Snapshot), что-то сломать, восстановить из снапшота.</li>
    </ol>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     HISTORY
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-history" class="section">
  <div class="section-title">История компьютерных сетей</div>

  <p class="text">Полезно знать, как мы пришли к современному Интернету — это объясняет, <strong>почему многое сделано именно так</strong>.</p>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="phone"></i> 1920s — Teletype (TTY)</div>
    <p class="text"><strong>Электромеханическая печатная машинка</strong>, которая позволяла обмениваться текстом по телефонной линии. Звуковой сигнал переводился в текст и наоборот.</p>
    <ul class="bullets">
      <li><strong>Ограничение:</strong> только point-to-point (двое говорят между собой). Не масштабируется.</li>
      <li><strong>Использовалось</strong> в новостных агентствах, телеграфе.</li>
      <li><strong>Наследие:</strong> современные терминалы в Linux до сих пор называются «TTY» (<code>/dev/tty</code>).</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package"></i> 1967 — Идея пакетной коммутации</div>
    <p class="text"><strong>Дональд Дэвис (UK)</strong> предложил концепцию: вместо того, чтобы держать целую телефонную линию для одного разговора (circuit switching), разбить сообщение на <strong>маленькие пронумерованные пакеты</strong> и отправить их по общей сети.</p>

    <div class="info-box primary">
      <strong>Почему это революция:</strong> один кабель теперь может обслуживать тысячи разговоров одновременно. Если кабель оборвался — пакеты пойдут другим путём. Это фундамент всего Интернета.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> 1969 — ARPANET</div>
    <p class="text"><strong>ARPA (Advanced Research Projects Agency, США)</strong> построило первую <strong>packet-switched сеть</strong>.</p>
    <ul class="bullets">
      <li><strong>29 октября 1969</strong> — первая передача данных между UCLA и Stanford Research Institute.</li>
      <li>Хотели послать «<code>login</code>», но система упала после «<code>lo</code>» — официально первое сетевое сообщение.</li>
      <li>Использовал первую версию <strong>IP (Internet Protocol)</strong>.</li>
      <li>Это <strong>основа современного Интернета</strong>.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="users"></i> 1980 — USENET</div>
    <p class="text">Первая публичная сеть — работает <strong>и сегодня</strong>. Принцип: как email, но «один → многим». Сообщения группируются в <strong>newsgroups</strong> (форумы).</p>
    <p class="text"><strong>Культурное наследие:</strong> из USENET в массы пошли понятия <em>nickname, smiley, moderator, spam, troll, ban</em>. По сути это <strong>прародитель Reddit</strong> и всех форумов.</p>
    <p class="text"><strong>Протокол:</strong> NNTP (Network News Transfer Protocol).</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="bell"></i> 1980-90s — Fidonet</div>
    <p class="text">Любительская сеть на основе <strong>модемов и телефонных линий</strong>. Стоила копейки (звонок ночью был дешёвым) и дала миллионам людей доступ к глобальному общению до массового Интернета.</p>
    <p class="text">Сегодня практически вымерла, но <strong>научила людей строить глобальные сообщества</strong>.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="globe"></i> Интернет — сеть сетей</div>
    <p class="text"><strong>Интернет</strong> = глобальная сеть, состоящая из множества меньших сетей, обменивающихся данными по единым протоколам.</p>
    <p class="text"><strong>Раннее подключение:</strong> модемы по телефонной линии (dial-up). Тот самый звук «писк-шипение» при подключении — это была согласовываемая <strong>модуляция</strong>: модем превращал биты данных в аналоговый звук.</p>

    <div class="subsection-title" style="font-size:13px;margin-top:14px;"><i data-lucide="key"></i> Ключевые понятия Интернета</div>
    <ul class="bullets">
      <li><strong>Data Packets</strong> — данные режутся, отправляются, собираются обратно.</li>
      <li><strong>IP Address</strong> — уникальный идентификатор (напр. <code>192.168.0.1</code>).</li>
      <li><strong>DNS (Domain Name System)</strong> — переводит имена (<code>google.com</code>) в IP (<code>142.250.185.14</code>).</li>
    </ul>
    <div class="analogy"><strong>DNS как телефонная книга:</strong> ты помнишь имя «Сергей», но не помнишь номер. DNS — это справочник, где по имени находят номер.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="building"></i> Инфраструктура Интернета</div>
    <ul class="bullets">
      <li><strong>Internet Hosts</strong> — центральные узлы, связывающие провайдеров.</li>
      <li><strong>ISPs (Internet Service Providers)</strong> — дают доступ конечным пользователям.</li>
      <li><strong>Типы подключения:</strong> dial-up (устар.), DSL, кабельное, LTE/5G, оптоволокно.</li>
      <li><strong>Протоколы:</strong> определяют правила обмена (TCP/IP, HTTP, etc.).</li>
    </ul>
  </div>

  <div class="info-box success">
    <strong>Главное:</strong> Teletype → packet switching → ARPANET → Интернет. Каждый шаг решал ограничение предыдущего. Сегодняшний Интернет — это <strong>сеть сетей</strong>, в которой пакеты с IP-адресами летят через тысячи устройств.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     NETWORK TYPES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-net-types" class="section">
  <div class="section-title">Типы сетей по размеру</div>

  <p class="text">Сети классифицируют по <strong>географическому покрытию</strong>. Каждый тип решает свою задачу.</p>

  <div class="diagram">PAN  →  LAN  →  MAN  →  WAN
 10м    здание   город    страна / мир
 (Bluetooth, Ethernet, ISP-сеть города, Интернет)</div>

  <div class="card">
    <h3>📍 PAN — Personal Area Network</h3>
    <p class="text"><strong>Что:</strong> очень маленькая сеть вокруг одного человека (~10 м).</p>
    <p class="text"><strong>Примеры:</strong> Bluetooth-наушники, мышь, клавиатура, AirDrop между Mac/iPhone.</p>
    <p class="text"><strong>Зачем знать:</strong> понимаешь, чем Bluetooth отличается от Wi-Fi.</p>
  </div>

  <div class="card">
    <h3>🏢 LAN — Local Area Network</h3>
    <p class="text"><strong>Что:</strong> сеть в пределах здания (офис, дом, кампус). До ~16 млн устройств теоретически.</p>
    <p class="text"><strong>Технологии:</strong> Ethernet (по кабелю), Wi-Fi (по воздуху — это WLAN).</p>
    <p class="text"><strong>Адреса:</strong> приватные IP (<code>192.168.x.x</code>, <code>10.x.x.x</code>).</p>
    <p class="text"><strong>Зачем знать:</strong> когда коллега говорит «зайди по локалке на сервер», он про LAN.</p>
  </div>

  <div class="card">
    <h3>🏙️ MAN — Metropolitan Area Network</h3>
    <p class="text"><strong>Что:</strong> сеть масштаба города.</p>
    <p class="text"><strong>Примеры:</strong> городской провайдер (Beeline, Kazakhtelecom), кабельное ТВ, муниципальный оптоволоконный backbone.</p>
    <p class="text"><strong>Роль:</strong> мост между LAN (офисы города) и WAN (глобальной сетью).</p>
  </div>

  <div class="card">
    <h3>🌍 WAN — Wide Area Network</h3>
    <p class="text"><strong>Что:</strong> сеть масштаба страны / континента / мира. <strong>Интернет</strong> — это самый большой WAN.</p>
    <p class="text"><strong>Технологии:</strong> магистральные оптические каналы, спутники, подводные кабели.</p>
    <p class="text"><strong>Кто строит:</strong> крупные провайдеры (Tier-1, Tier-2 ISPs), Google/Meta/Amazon (свои частные WAN).</p>
  </div>

  <div class="card">
    <h3>📡 WLAN — Wireless LAN</h3>
    <p class="text">То же что LAN, но по воздуху (Wi-Fi). Минусы по сравнению с проводным LAN:</p>
    <ul class="bullets">
      <li>медленнее при множестве клиентов;</li>
      <li>помехи (микроволновка может рубить сигнал);</li>
      <li>безопасность — трафик можно «снифать из воздуха», нужен WPA2/WPA3.</li>
    </ul>
  </div>

  <div class="card">
    <h3>🔐 VPN — Virtual Private Network</h3>
    <p class="text"><strong>Что:</strong> «виртуальный приватный кабель», проложенный <strong>поверх</strong> публичного Интернета. Трафик шифруется в туннеле.</p>
    <p class="text"><strong>Зачем 2 типа:</strong></p>
    <ul class="bullets">
      <li><strong>Personal VPN</strong> (NordVPN, Surfshark) — приватность, обход блокировок.</li>
      <li><strong>Corporate VPN</strong> (OpenVPN, WireGuard, Cisco AnyConnect) — сотрудник из дома получает доступ к внутренней сети офиса как будто он там физически.</li>
    </ul>
    <div class="analogy"><strong>Аналогия:</strong> VPN — это <strong>тоннель внутри обычной дороги</strong>. Машины снаружи (Интернет) едут по асфальту и видят твой автомобиль. Машины в тоннеле — едут отдельно, и никто снаружи не видит, что внутри.</div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     TOPOLOGIES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-topologies" class="section">
  <div class="section-title">Топологии — как соединены устройства</div>

  <p class="text"><strong>Топология</strong> — это «карта» того, как провода и устройства соединены между собой.</p>

  <ul class="bullets">
    <li><strong>Физическая топология</strong> — как реально лежат кабели.</li>
    <li><strong>Логическая топология</strong> — как данные «текут» между устройствами (может отличаться от физической).</li>
  </ul>

  <div class="card">
    <h3>🔗 Point-to-Point</h3>
    <p class="text">Два устройства, один кабель. Просто, надёжно, но <strong>не масштабируется</strong>.</p>
    <div class="diagram">[ PC-A ]──────────[ PC-B ]</div>
  </div>

  <div class="card">
    <h3>🚌 Bus</h3>
    <p class="text">Один общий кабель, к нему подключены все. <strong>Устаревшее</strong> (Ethernet 10BASE2).</p>
    <div class="diagram">[PC1]──[PC2]──[PC3]──[PC4]
       Общий кабель (bus)</div>
    <p class="text"><strong>Минус:</strong> если кабель порвётся в середине — вся сеть упадёт. Все устройства слышат весь трафик (security risk).</p>
  </div>

  <div class="card">
    <h3>⭐ Star (самая популярная сегодня)</h3>
    <p class="text">Все устройства подключены к центральному узлу (switch / hub / router).</p>
    <div class="diagram">           [PC2]
             │
    [PC1]──[ Switch ]──[PC3]
             │
           [PC4]</div>
    <p class="text"><strong>Плюс:</strong> один кабель упал — остальные работают. Легко искать неисправность.</p>
    <p class="text"><strong>Минус:</strong> упал центральный switch — упало всё.</p>
  </div>

  <div class="card">
    <h3>⭕ Ring</h3>
    <p class="text">Каждое устройство связано с двумя соседями, образуя кольцо. Данные идут в одну сторону.</p>
    <div class="diagram">    [PC1]───────[PC2]
      │            │
    [PC4]───────[PC3]</div>
    <p class="text"><strong>Минус:</strong> один узел сломался — кольцо разорвалось. Решение: Dual Ring (два кольца, одно резервное).</p>
  </div>

  <div class="card">
    <h3>🕸️ Mesh — на этом построен Интернет</h3>
    <p class="text">Каждое устройство связано <strong>с многими другими</strong> (не обязательно со всеми).</p>
    <div class="diagram">     [A]═══[B]
      ║  ╳  ║
     [C]═══[D]</div>
    <p class="text"><strong>Плюс:</strong> отказ одного устройства/линка не ломает сеть — данные пойдут другим путём.</p>
    <p class="text"><strong>Минус:</strong> очень дорого (много кабелей).</p>
    <p class="text"><strong>Где:</strong> магистральные сети Интернета — Partial Mesh.</p>
  </div>

  <div class="card">
    <h3>🌲 Hybrid</h3>
    <p class="text">Реальные корпоративные сети — комбинация Star + Mesh + Ring. Часто древовидная структура.</p>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     DEVICES
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-devices" class="section">
  <div class="section-title">Сетевые устройства</div>

  <p class="text">Каждое устройство работает на определённом <strong>OSI-уровне</strong>. Чем выше уровень — тем «умнее» устройство и тем больше понимает о трафике.</p>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="building-2"></i> Иерархическая модель корпоративной сети</div>
    <p class="text">Большие корпоративные сети строят по <strong>трёхуровневой модели</strong> (Cisco hierarchical model):</p>
    <div class="diagram">                  ┌─────────────────────────────┐
                  │   CORE LAYER (магистраль)    │  ←─ высокоскоростные
                  │   - L3 Switches              │     switch'и + router'ы
                  │   - Routers                  │     между зданиями/сайтами
                  └──────────┬──────────────────┘
                             │
            ┌────────────────┴───────────────┐
            │   DISTRIBUTION LAYER             │   ←─ соединяет этажи / отделы
            │   - L3 Switches                  │      управляемые switch'и,
            │   - Routers                      │      VLAN routing, ACL
            └────┬──────────────────┬─────────┘
                 │                  │
    ┌────────────┴────┐    ┌────────┴────────┐
    │  ACCESS LAYER    │    │  ACCESS LAYER  │   ←─ к чему подключены
    │  - L2 Switches   │    │  - L2 Switches │      конечные устройства
    │  - PCs, printers │    │  - PCs         │      (этаж в офисе)
    └─────────────────┘    └────────────────┘</div>
    <table class="data-table">
      <tr><th>Уровень</th><th>Где</th><th>Что делает</th><th>Устройства</th></tr>
      <tr><td><strong>Access</strong></td><td>Этаж офиса</td><td>Подключает конечные устройства (ПК, принтеры, IP-телефоны)</td><td>Обычные switch'и</td></tr>
      <tr><td><strong>Distribution</strong></td><td>Между этажами / отделами</td><td>Объединяет access switch'и, фильтрует трафик, маршрутизация VLAN</td><td>Управляемые / L3 switch'и</td></tr>
      <tr><td><strong>Core</strong></td><td>Backbone здания / сайта</td><td>Магистраль — связывает distribution-узлы на максимальной скорости</td><td>Мощные L3 switch'и и router'ы</td></tr>
    </table>
    <div class="info-box primary">
      <strong>Зачем такое разделение:</strong> легче масштабировать (добавил этаж — поставил один access switch), легче находить и изолировать сбои, можно применять разные политики безопасности на разных уровнях.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="bar-chart-3"></i> Карта устройств по уровням</div>
    <table class="data-table">
      <tr><th>Уровень OSI</th><th>Устройство</th><th>Что умеет</th></tr>
      <tr><td>L1 (Physical)</td><td>NIC (отчасти), Repeater, Hub, Modem</td><td>Просто гонит биты / сигналы</td></tr>
      <tr><td>L2 (Data Link)</td><td>NIC (полностью), Bridge, <strong>Switch</strong></td><td>Понимает MAC-адреса, ходит внутри LAN</td></tr>
      <tr><td>L3 (Network)</td><td><strong>Router</strong>, L3 Switch</td><td>Понимает IP, маршрутизирует между сетями</td></tr>
      <tr><td>Все уровни</td><td><strong>Gateway</strong></td><td>Переводит между разными протоколами</td></tr>
    </table>
  </div>

  <div class="card">
    <h3>🔌 NIC (Network Interface Card)</h3>
    <p class="text">Это «сетевая карта» — деталь в твоём ноутбуке/сервере, которая физически подключает к сети. Имеет уникальный <strong>MAC-адрес</strong>.</p>

    <p class="text"><strong>Где живёт:</strong></p>
    <ul class="bullets">
      <li><strong>External</strong> — внешняя (USB Wi-Fi-адаптер).</li>
      <li><strong>Internal</strong> — PCI-карта на материнской плате.</li>
      <li><strong>Integrated</strong> — встроена в чипсет (все современные ноутбуки).</li>
    </ul>

    <p class="text"><strong>Эволюция коннекторов NIC:</strong></p>
    <table class="data-table">
      <tr><th>Коннектор</th><th>Где использовался</th><th>Скорость</th></tr>
      <tr><td><strong>AUI</strong> (Attachment Unit Interface)</td><td>10BASE5 (Thick Ethernet, толстый коаксиал)</td><td>10 Mbps</td></tr>
      <tr><td><strong>BNC</strong> (Bayonet Connector)</td><td>10BASE2 (Thin Ethernet, тонкий коаксиал)</td><td>10 Mbps</td></tr>
      <tr><td><strong>RJ-45</strong> (8P8C)</td><td>Современный Ethernet — то, что ты видишь в кабеле LAN</td><td>до 10 Gbps</td></tr>
      <tr><td><strong>Fiber (SC, LC, ST)</strong></td><td>Магистральные сети, ЦОДы</td><td>до 100 Gbps на 40 км</td></tr>
    </table>
    <p class="text"><strong>OSI:</strong> работает на L1 (Physical) + L2 (Data Link). Это «гибридное» устройство.</p>
  </div>

  <div class="card">
    <h3>📡 Repeater</h3>
    <p class="text"><strong>Что:</strong> регенерирует и усиливает сигнал, чтобы кабель мог быть длиннее.</p>
    <p class="text"><strong>OSI:</strong> L1 (Physical). Не понимает ничего о содержимом — просто усиливает.</p>
    <p class="text"><strong>Зачем:</strong> у Ethernet есть ограничение по длине кабеля (~100 м). Repeater позволяет «продлить» сеть дальше.</p>
    <p class="text"><strong>Минус:</strong> не фильтрует ничего — повторяет всё, включая шум.</p>
    <p class="text"><strong>Сегодня:</strong> почти не используется отдельно, функция встроена в switch'и и Wi-Fi extender'ы.</p>
  </div>

  <div class="card">
    <h3>📢 Hub (устарел)</h3>
    <p class="text">Получил пакет — отправил <strong>всем</strong> подключённым. Тупой повторитель. Все слышат всех → коллизии, security.</p>
    <div class="analogy"><strong>Аналогия:</strong> hub = громкоговоритель в комнате. Кто-то сказал — все услышали, включая тех, кому не предназначалось.</div>
    <p class="text">Сейчас не используется — везде switches.</p>
  </div>

  <div class="card">
    <h3>🌉 Bridge (предок switch'а)</h3>
    <p class="text"><strong>Что:</strong> соединяет и фильтрует трафик между двумя сегментами сети. Использует <strong>MAC-таблицу</strong>, чтобы решить — пропускать кадр дальше или нет.</p>
    <p class="text"><strong>OSI:</strong> L2 (Data Link).</p>
    <p class="text"><strong>Типы:</strong></p>
    <ul class="bullets">
      <li><strong>Transparent</strong> — невидим для устройств, сам строит MAC-таблицу.</li>
      <li><strong>Translating</strong> — соединяет разные среды (Ethernet ↔ Wi-Fi).</li>
      <li><strong>Encapsulating</strong> — оборачивает кадры одного протокола в другой.</li>
    </ul>
    <p class="text"><strong>Плюсы:</strong></p>
    <ul class="bullets">
      <li>Уменьшает количество коллизий, разделяя collision domains.</li>
      <li>Может фильтровать битые или слишком большие кадры.</li>
    </ul>
    <p class="text"><strong>Минус:</strong> добавляет задержку (анализирует кадры).</p>
    <p class="text"><strong>Сегодня:</strong> почти заменён switch'ами. Switch — это, по сути, многопортовый bridge.</p>
  </div>

  <div class="card">
    <h3>🔄 Switch (основа любой LAN)</h3>
    <p class="text">Получил пакет — посмотрел MAC получателя — отправил <strong>только нужному порту</strong>. Хранит <strong>MAC-таблицу</strong> (порт ↔ MAC).</p>
    <div class="analogy"><strong>Аналогия:</strong> switch = почтальон в общежитии. Получил конверт с именем Васи — отнёс именно Васе, остальным жильцам не показывает.</div>
    <p class="text"><strong>Работает на L2.</strong> IP его не интересует — только MAC.</p>
    <p class="text"><strong>Методы коммутации:</strong></p>
    <ul class="bullets">
      <li><strong>Store-and-Forward</strong> — полностью принять кадр, проверить на ошибки, потом отправить. Надёжно, но с задержкой.</li>
      <li><strong>Cut-Through</strong> — отправить сразу как только увидели MAC получателя. Быстро, но может пропустить битый кадр.</li>
      <li><strong>Fragment-Free</strong> — принять первые 64 байта (там обычно ошибки), потом форвардить. Компромисс.</li>
    </ul>
  </div>

  <div class="card">
    <h3>🌐 Router</h3>
    <p class="text">Получил пакет — посмотрел <strong>IP получателя</strong> — посмотрел <strong>routing table</strong> — решил, в какой следующий узел («next hop») отправить.</p>
    <div class="analogy"><strong>Аналогия:</strong> router = почтовое отделение. Получило письмо «в Москву» — отправило в международный сортировочный центр, дальше тот разберётся.</div>
    <p class="text"><strong>Работает на L3.</strong> Связывает <strong>разные сети</strong> между собой (LAN ↔ Интернет).</p>
    <p class="text">Дома твой <strong>Wi-Fi-роутер</strong> — это маленький router + switch + Wi-Fi access point + DHCP-сервер + NAT в одном корпусе.</p>
  </div>

  <div class="card">
    <h3>⚡ L3 Switch (Multilayer)</h3>
    <p class="text">Switch с функциями router'а. Работает на L2 + L3. Очень быстрый (специальные ASIC-чипы), но менее гибкий чем настоящий router.</p>
    <p class="text"><strong>Где:</strong> большие корпоративные LAN с несколькими VLAN — нужно быстро маршрутизировать между VLAN'ами без покупки дорогого роутера.</p>
  </div>

  <div class="card">
    <h3>🚪 Gateway</h3>
    <p class="text">Устройство (или софт), которое <strong>переводит</strong> между разными протоколами. Может работать на любых уровнях OSI.</p>
    <p class="text"><strong>Примеры:</strong> домашний роутер часто называют «default gateway» (он шлюз в Интернет); API Gateway в облаке; firewall как gateway между Интернетом и внутренней сетью.</p>
  </div>

  <div class="card">
    <h3>📞 Modem</h3>
    <p class="text"><strong>Mod</strong>ulator + <strong>Dem</strong>odulator. Переводит цифровой сигнал → аналоговый (для телефонной линии, DSL, кабельного ТВ) и обратно.</p>
    <p class="text">Сегодня чаще встретишь интегрированный <strong>modem + router</strong> от провайдера в коробке.</p>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     OSI MODEL
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-osi" class="section">
  <div class="section-title">Модель OSI — 7 уровней</div>

  <p class="text"><strong>OSI (Open Systems Interconnection)</strong> — это <strong>теоретическая</strong> модель того, как устройства должны общаться по сети. Она <strong>не используется напрямую</strong> в коде, но это «язык», на котором говорят все сетевики.</p>

  <div class="why-box">
    <strong>Зачем нужна:</strong> до OSI каждый производитель железа делал свои протоколы. Cisco не общался с IBM. OSI ввела общий стандарт: «каждый делает свой уровень, лишь бы стыковался с соседним». Теперь Mac общается с Linux-сервером, который общается с Cisco-роутером — все понимают друг друга.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="list-ordered"></i> 7 уровней (сверху вниз)</div>
    <table class="data-table">
      <tr><th>#</th><th>Уровень</th><th>Что делает</th><th>Единица данных (PDU)</th><th>Примеры</th></tr>
      <tr><td>7</td><td><strong>Application</strong></td><td>Сервис для пользователя</td><td>Data</td><td>HTTP, FTP, SMTP, DNS</td></tr>
      <tr><td>6</td><td><strong>Presentation</strong></td><td>Формат, шифрование, сжатие</td><td>Data</td><td>TLS, JPEG, ASCII↔Unicode</td></tr>
      <tr><td>5</td><td><strong>Session</strong></td><td>Сессии, контроль диалога</td><td>Data</td><td>NetBIOS, RPC</td></tr>
      <tr><td>4</td><td><strong>Transport</strong></td><td>Надёжная доставка end-to-end</td><td>Segment</td><td>TCP, UDP</td></tr>
      <tr><td>3</td><td><strong>Network</strong></td><td>Маршрутизация между сетями</td><td>Packet</td><td>IP, ICMP, ARP</td></tr>
      <tr><td>2</td><td><strong>Data Link</strong></td><td>Доставка внутри одной сети</td><td>Frame</td><td>Ethernet, Wi-Fi, PPP</td></tr>
      <tr><td>1</td><td><strong>Physical</strong></td><td>Биты в провод/радио</td><td>Bits</td><td>Кабель, разъёмы, сигналы</td></tr>
    </table>

    <div class="info-box primary">
      <strong>Мнемоника на английском:</strong> <em>All People Seem To Need Data Processing</em> (Application, Presentation, Session, Transport, Network, Data link, Physical).
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="mail"></i> Пример: ты пишешь email</div>
    <ol class="bullets" style="list-style:decimal;">
      <li><strong>L7 Application:</strong> Outlook формирует email через протокол <code>SMTP</code>.</li>
      <li><strong>L6 Presentation:</strong> текст кодируется в UTF-8, прикреплённое фото — в JPEG, всё это шифруется через TLS.</li>
      <li><strong>L5 Session:</strong> устанавливается сессия с почтовым сервером (логин, токен).</li>
      <li><strong>L4 Transport:</strong> TCP режет email на сегменты, нумерует, ждёт подтверждений о доставке.</li>
      <li><strong>L3 Network:</strong> IP добавляет к каждому сегменту твой IP + IP сервера, выбирает маршрут.</li>
      <li><strong>L2 Data Link:</strong> Ethernet оборачивает пакет в кадр, добавляет MAC твоего ноута + MAC роутера.</li>
      <li><strong>L1 Physical:</strong> кадр превращается в электросигнал в кабеле / радиоволну в Wi-Fi.</li>
    </ol>
    <p class="text">На сервере процесс идёт <strong>наоборот</strong> (снизу вверх): сигналы → биты → кадр → пакет → сегмент → email.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-circle"></i> Какие уровни нужны разработчику чаще всего</div>
    <ul class="bullets">
      <li><strong>L7</strong> — каждый день (HTTP, JSON, REST, GraphQL).</li>
      <li><strong>L4</strong> — часто (TCP vs UDP, порты, firewall).</li>
      <li><strong>L3</strong> — иногда (IP, маршруты в VPN/AWS).</li>
      <li><strong>L2</strong> — редко (MAC, VLAN — больше DevOps/сетевики).</li>
      <li><strong>L1</strong> — почти никогда (если не работаешь с железом).</li>
      <li><strong>L5/L6</strong> — почти забыты, их функции «размазали» по L4 и L7.</li>
    </ul>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     TCP/IP MODEL
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-tcpip" class="section">
  <div class="section-title">Модель TCP/IP — 4 уровня (или 5)</div>

  <p class="text"><strong>TCP/IP</strong> — это <strong>практическая</strong> модель, на которой реально построен Интернет. В отличие от OSI это <strong>не теория</strong>, а живой набор протоколов.</p>

  <div class="why-box">
    <strong>Почему две модели:</strong> OSI придумали комитетом, она оказалась слишком сложной. TCP/IP родилась из практики (ARPANET → Интернет), она проще и победила. Сегодня OSI используют для <strong>понимания</strong>, а TCP/IP — для <strong>реальной работы</strong>.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> 4 уровня TCP/IP</div>
    <table class="data-table">
      <tr><th>Уровень</th><th>Соответствует OSI</th><th>Что делает</th><th>Протоколы</th></tr>
      <tr><td><strong>Application</strong></td><td>L5+L6+L7</td><td>Сервис для приложений</td><td>HTTP, FTP, SMTP, DNS, DHCP</td></tr>
      <tr><td><strong>Transport</strong></td><td>L4</td><td>End-to-end доставка, порты</td><td>TCP, UDP</td></tr>
      <tr><td><strong>Internet</strong></td><td>L3</td><td>Маршрутизация по IP</td><td>IP, ICMP, ARP</td></tr>
      <tr><td><strong>Link (Network Interface)</strong></td><td>L1+L2</td><td>Локальная доставка, кадры</td><td>Ethernet, Wi-Fi, PPP</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> 5-уровневая «гибридная» версия</div>
    <p class="text">В учебниках часто рисуют 5 уровней — это TCP/IP, но с разделением Link на Physical и Data Link (чтобы было проще сравнивать с OSI).</p>
    <div class="diagram">┌─────────────────┬─────────────────┐
│  OSI (7 ур.)    │  TCP/IP (5 ур.) │
├─────────────────┼─────────────────┤
│ 7. Application  │                 │
│ 6. Presentation │ 5. Application  │
│ 5. Session      │                 │
├─────────────────┼─────────────────┤
│ 4. Transport    │ 4. Transport    │
├─────────────────┼─────────────────┤
│ 3. Network      │ 3. Internet     │
├─────────────────┼─────────────────┤
│ 2. Data Link    │ 2. Data Link    │
├─────────────────┼─────────────────┤
│ 1. Physical     │ 1. Physical     │
└─────────────────┴─────────────────┘</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle-2"></i> Главное отличие OSI vs TCP/IP</div>
    <table class="data-table">
      <tr><th></th><th>OSI</th><th>TCP/IP</th></tr>
      <tr><td><strong>Тип</strong></td><td>Теоретическая модель</td><td>Реальные протоколы</td></tr>
      <tr><td><strong>Уровней</strong></td><td>7</td><td>4 (или 5 в гибриде)</td></tr>
      <tr><td><strong>Где используется</strong></td><td>Учебники, собеседования</td><td>Интернет, реальные системы</td></tr>
      <tr><td><strong>Кто придумал</strong></td><td>ISO (международный комитет)</td><td>DARPA + DoD (военные США)</td></tr>
    </table>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     ENCAPSULATION
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-encap" class="section">
  <div class="section-title">Инкапсуляция и Декапсуляция</div>

  <p class="text">Когда твои данные идут вниз по уровням (от приложения к проводу), <strong>каждый уровень добавляет свой заголовок</strong>. Это называется <strong>инкапсуляция</strong> — как матрёшка.</p>

  <p class="text">Когда данные приходят на другой стороне и идут вверх — каждый уровень <strong>снимает свой заголовок</strong>. Это <strong>декапсуляция</strong>.</p>

  <div class="analogy">
    <strong>Аналогия:</strong> ты пишешь <strong>письмо</strong>. Запечатываешь в <strong>конверт</strong> с адресом квартиры. Конверт кладёшь в <strong>посылку</strong> с адресом города. Посылку грузят в <strong>контейнер</strong> с маршрутом. Получатель распаковывает: вынимает посылку, открывает конверт, читает письмо.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-down"></i> Инкапсуляция (отправитель, сверху вниз)</div>
    <table class="data-table">
      <tr><th>Уровень</th><th>Что добавляет</th><th>Получается</th></tr>
      <tr><td>Application</td><td>Полезные данные (HTTP request, JSON)</td><td>Data</td></tr>
      <tr><td>Transport (TCP)</td><td>+ порт источника, порт получателя, sequence number</td><td>Segment</td></tr>
      <tr><td>Internet (IP)</td><td>+ IP источника, IP получателя, TTL</td><td>Packet</td></tr>
      <tr><td>Data Link (Ethernet)</td><td>+ MAC источника, MAC получателя, CRC checksum</td><td>Frame</td></tr>
      <tr><td>Physical</td><td>превращает в сигналы (электричество / свет / радио)</td><td>Bits</td></tr>
    </table>
    <div class="diagram">[ App data ]
       ↓
[ TCP hdr | App data ]                                     ← Segment
       ↓
[ IP hdr | TCP hdr | App data ]                            ← Packet
       ↓
[ Eth hdr | IP hdr | TCP hdr | App data | CRC ]            ← Frame
       ↓
01010110010110101001010101011110...                        ← Bits (в провод)</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-up"></i> Декапсуляция (получатель, снизу вверх)</div>
    <p class="text">Зеркальный процесс. Каждый уровень читает свой заголовок (например: «это мой IP? да!»), удаляет его и передаёт «начинку» наверх.</p>
  </div>

  <div class="info-box success">
    <strong>Важно для отладки:</strong> когда ты в браузере открываешь сайт, реально летит большой кадр с 4 вложенными заголовками. Любой из них может быть «не таким» — поэтому полезно понимать, что внутри что.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     MAC
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-mac" class="section">
  <div class="section-title">MAC-адрес</div>

  <p class="text"><strong>MAC (Media Access Control)</strong> — это <strong>уникальный идентификатор</strong> сетевой карты (NIC). Прошивается производителем при изготовлении.</p>

  <div class="analogy">
    <strong>Аналогия:</strong> MAC — это <strong>серийный номер на корпусе</strong> твоего ноутбука. Уникален во всём мире. В отличие от IP, который меняется (дома один, в кафе другой), MAC обычно <strong>прибит к железу</strong>.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="binary"></i> Формат MAC</div>
    <ul class="bullets">
      <li><strong>Длина:</strong> 48 бит = 6 байт.</li>
      <li><strong>Запись:</strong> 6 пар hex через двоеточие или дефис.</li>
      <li><strong>Пример:</strong> <code>D4:6A:6D:89:1F:22</code></li>
    </ul>
    <table class="data-table">
      <tr><th>Часть</th><th>Что</th><th>Пример</th></tr>
      <tr><td>Первые 3 байта (OUI)</td><td>Идентификатор производителя (выдаёт IEEE)</td><td><code>D4:6A:6D</code> = Lenovo</td></tr>
      <tr><td>Последние 3 байта</td><td>Серийник конкретной NIC у производителя</td><td><code>89:1F:22</code></td></tr>
    </table>
    <div class="info-box primary">По первым 3 байтам можно <strong>узнать производителя</strong> любой сетевой карты — есть онлайн-базы OUI lookup.</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Где используется</div>
    <p class="text">MAC работает <strong>только в пределах одной локальной сети (LAN)</strong>. Когда пакет пересекает router — MAC меняется на каждом hop'е.</p>
    <ul class="bullets">
      <li>В LAN-кадре указан MAC отправителя и MAC получателя в той же подсети.</li>
      <li>При переходе через router: router принимает кадр (с его MAC как получатель), снимает Ethernet-заголовок, выбирает следующий hop, упаковывает в новый кадр с <strong>новым MAC получателя</strong>.</li>
      <li>IP при этом <strong>не меняется</strong> на всём пути (если нет NAT).</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shuffle"></i> MAC spoofing — можно ли изменить</div>
    <p class="text">Технически MAC «прошит», но ОС позволяет его подменить (Locally Administered Address). Используется для:</p>
    <ul class="bullets">
      <li>обхода ограничений по MAC (некоторые сети пускают только «известные» MAC);</li>
      <li>анонимности;</li>
      <li>тестирования.</li>
    </ul>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     IPv4
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-ipv4" class="section">
  <div class="section-title">IPv4 — основной адрес Интернета</div>

  <p class="text"><strong>IPv4</strong> — это адрес, по которому твой компьютер находят в Интернете. 32 бита, 4 октета по 8 бит. Пример: <code>192.168.1.1</code>.</p>

  <div class="analogy">
    <strong>Аналогия:</strong> IP = <strong>почтовый адрес</strong>. MAC = <strong>имя жильца</strong>. Когда тебе пишут письмо, на конверте — адрес дома (IP). А внутри дома почтальон (switch) уже разбирается, кому конкретно отдать (MAC).
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="binary"></i> Структура</div>
    <p class="text"><strong>32 бита = 4 байта = 4 октета</strong>. Каждый октет = число от 0 до 255 (потому что <code>2⁸ = 256</code>).</p>
    <div class="diagram">192 . 168 . 1 . 100
 ↓     ↓    ↓    ↓
11000000.10101000.00000001.01100100  ← в бинарном виде</div>
    <p class="text">Всего адресов: <code>2³² ≈ 4.3 млрд</code>. Звучит много — но не хватило!</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Старая система: классы (Classful)</div>
    <p class="text">В 1981 IPv4 разделили на 5 классов по первым битам:</p>
    <table class="data-table">
      <tr><th>Класс</th><th>Диапазон</th><th>Хостов в сети</th><th>Где</th></tr>
      <tr><td>A</td><td>0–127.x.x.x</td><td>~16 млн</td><td>Гигантские сети (gov, гиганты)</td></tr>
      <tr><td>B</td><td>128–191.x.x.x</td><td>~65k</td><td>Крупные организации</td></tr>
      <tr><td>C</td><td>192–223.x.x.x</td><td>254</td><td>Малые сети</td></tr>
      <tr><td>D</td><td>224–239.x.x.x</td><td>—</td><td>Multicast (групповая рассылка)</td></tr>
      <tr><td>E</td><td>240–255.x.x.x</td><td>—</td><td>Экспериментальный</td></tr>
    </table>
    <div class="info-box warning">
      <strong>Проблема классов:</strong> компании надо 300 машин — дают класс B на 65000. Из них 64700 пропадает зря. Так быстро «съели» все адреса.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="info"></i> Особые адреса</div>
    <ul class="bullets">
      <li><code>127.0.0.1</code> — <strong>localhost</strong> («сам себе»). Пингуй сам себя для проверки сетевого стека.</li>
      <li><code>0.0.0.0</code> — «любой адрес» (часто используется как «слушать на всех интерфейсах»).</li>
      <li><code>255.255.255.255</code> — broadcast (всем в локальной сети).</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package"></i> IPv4 заголовок (что внутри пакета)</div>
    <table class="data-table">
      <tr><th>Поле</th><th>Размер</th><th>Что</th></tr>
      <tr><td><strong>Version</strong></td><td>4 бита</td><td>= <code>0100</code> для IPv4</td></tr>
      <tr><td><strong>IHL (Header Length)</strong></td><td>4 бита</td><td>Длина заголовка (мин 20 байт, макс 60)</td></tr>
      <tr><td><strong>ToS / DSCP</strong></td><td>8 бит</td><td>Type of Service — приоритет (QoS)</td></tr>
      <tr><td><strong>Total Length</strong></td><td>16 бит</td><td>Полная длина пакета (до 65 535 байт)</td></tr>
      <tr><td><strong>Identification</strong></td><td>16 бит</td><td>ID для сборки фрагментов</td></tr>
      <tr><td><strong>Flags</strong></td><td>3 бита</td><td>Можно ли фрагментировать (DF), есть ли ещё фрагменты (MF)</td></tr>
      <tr><td><strong>Fragment Offset</strong></td><td>13 бит</td><td>Где в исходном пакете этот фрагмент</td></tr>
      <tr><td><strong>TTL (Time To Live)</strong></td><td>8 бит</td><td>Счётчик хопов. Каждый router −1. Дошёл до 0 → пакет уничтожается.</td></tr>
      <tr><td><strong>Protocol</strong></td><td>8 бит</td><td>Что внутри: TCP=<code>6</code>, UDP=<code>17</code>, ICMP=<code>1</code></td></tr>
      <tr><td><strong>Header Checksum</strong></td><td>16 бит</td><td>Контрольная сумма заголовка</td></tr>
      <tr><td><strong>Source IP</strong></td><td>32 бит</td><td>IP отправителя</td></tr>
      <tr><td><strong>Destination IP</strong></td><td>32 бит</td><td>IP получателя</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="scissors"></i> Фрагментация — что это</div>
    <p class="text">У каждого канала есть <strong>MTU (Maximum Transmission Unit)</strong> — максимальный размер пакета. Для Ethernet это обычно <strong>1500 байт</strong>.</p>
    <p class="text">Если пакет больше MTU — IP <strong>режет его на куски (фрагменты)</strong>. Получатель собирает обратно.</p>

    <div class="diagram">Хочешь отправить пакет 4520 байт.
MTU = 1500.

Payload 4500 + заголовок 20 = 4520

Делится на 4 фрагмента:
  ┌────────────┬────────────┬────────────┬────────────┐
  │ Fragment 1 │ Fragment 2 │ Fragment 3 │ Fragment 4 │
  │ 1480 байт  │ 1480 байт  │ 1480 байт  │ ~60 байт   │
  │ offset 0   │ offset 185 │ offset 370 │ offset 555 │
  │ MF=1       │ MF=1       │ MF=1       │ MF=0       │
  └────────────┴────────────┴────────────┴────────────┘
                                              ↑
                          (MF=0 → это последний фрагмент)

Получатель собирает обратно по Identification + Offset.</div>

    <div class="info-box warning">
      <strong>На практике:</strong> фрагментация — это плохо для производительности. Если хоть один фрагмент потеряется — пересобрать не получится, придётся слать заново <strong>весь</strong> пакет. Поэтому современные системы используют <strong>Path MTU Discovery</strong> и сразу режут данные на куски размером меньше MTU.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     IPv6
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-ipv6" class="section">
  <div class="section-title">IPv6 — адреса будущего</div>

  <p class="text"><strong>IPv6</strong> придумали в 90-х, когда поняли что IPv4 кончится. У IPv6 — <strong>128 бит</strong> (вместо 32). Это <code>2¹²⁸ ≈ 3.4 × 10³⁸</code> адресов — хватит на каждую песчинку на Земле.</p>

  <div class="why-box">
    <strong>Зачем нужен:</strong> IPv4 исчерпан примерно в 2011-2015 годах. NAT (см. далее) помог отсрочить кризис, но это костыль. IPv6 — настоящее решение: адресов столько, что NAT не нужен, каждое устройство может иметь свой публичный IP.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="binary"></i> Формат IPv6</div>
    <ul class="bullets">
      <li><strong>128 бит</strong> = 8 групп по 16 бит (8 «хекстетов»).</li>
      <li>В hex: <code>2001:0db8:85a3:0000:0000:8a2e:0370:7334</code></li>
      <li>Сокращения:
        <ul class="bullets">
          <li>Лидирующие нули в хекстете можно убрать: <code>0db8 → db8</code></li>
          <li>Подряд идущие нули можно заменить на <code>::</code> (только один раз в адресе!).</li>
        </ul>
      </li>
    </ul>
    <div class="diagram">Полная форма:    2001:0db8:0000:0000:0000:ff00:0042:8329
После сжатия:    2001:db8::ff00:42:8329</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> Типы IPv6-адресов</div>
    <table class="data-table">
      <tr><th>Тип</th><th>Префикс</th><th>Аналог в IPv4</th></tr>
      <tr><td><strong>Global Unicast</strong></td><td>обычные</td><td>Публичный IP</td></tr>
      <tr><td><strong>Unique Local (ULA)</strong></td><td><code>fc00::/7</code> (<code>fc</code> или <code>fd</code>)</td><td>Приватные IP (10.x, 192.168.x)</td></tr>
      <tr><td><strong>Link-Local</strong></td><td><code>fe80::/10</code></td><td>Работает только в LAN, обязательный у каждого IPv6-устройства</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="package"></i> IPv6 заголовок (упрощённый по сравнению с IPv4)</div>
    <table class="data-table">
      <tr><th>Поле</th><th>Размер</th><th>Что</th></tr>
      <tr><td><strong>Version</strong></td><td>4 бита</td><td>= <code>0110</code> для IPv6</td></tr>
      <tr><td><strong>Traffic Class</strong></td><td>8 бит</td><td>Приоритет (аналог ToS в IPv4)</td></tr>
      <tr><td><strong>Flow Label</strong></td><td>20 бит</td><td>Помечает поток для real-time (VoIP, видео) — все пакеты идут одним маршрутом</td></tr>
      <tr><td><strong>Payload Length</strong></td><td>16 бит</td><td>Размер данных</td></tr>
      <tr><td><strong>Next Header</strong></td><td>8 бит</td><td>Транспортный протокол: TCP, UDP, ICMPv6</td></tr>
      <tr><td><strong>Hop Limit</strong></td><td>8 бит</td><td>То же что TTL в IPv4</td></tr>
      <tr><td><strong>Source Address</strong></td><td>128 бит</td><td>IP отправителя</td></tr>
      <tr><td><strong>Destination Address</strong></td><td>128 бит</td><td>IP получателя</td></tr>
    </table>
    <div class="info-box primary">
      Всего <strong>8 полей</strong> против 13 в IPv4 → router'ам проще и быстрее обрабатывать. И <strong>фиксированный размер 40 байт</strong> (в IPv4 — переменный 20–60).
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="trending-up"></i> Главные плюсы IPv6</div>
    <ul class="bullets">
      <li><strong>Безграничный пул адресов</strong> → не нужен NAT.</li>
      <li><strong>Автоконфигурация (SLAAC)</strong> — устройство может само выбрать IP без DHCP.</li>
      <li><strong>IPsec встроен</strong> — шифрование «из коробки».</li>
      <li><strong>Заголовок проще</strong> (8 полей vs 13 в IPv4) → router'ы работают быстрее.</li>
      <li><strong>Flow Label</strong> — улучшенный QoS для VoIP и видео.</li>
      <li><strong>Нет broadcast</strong> — заменён на multicast и anycast (эффективнее).</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-compare"></i> IPv4 vs IPv6</div>
    <table class="data-table">
      <tr><th>Признак</th><th>IPv4</th><th>IPv6</th></tr>
      <tr><td>Длина</td><td>32 бита</td><td>128 бит</td></tr>
      <tr><td>Запись</td><td><code>192.168.1.1</code></td><td><code>2001:db8::1</code></td></tr>
      <tr><td>Пул</td><td>~4.3 млрд (исчерпан)</td><td>~3.4 × 10³⁸ (бесконечно)</td></tr>
      <tr><td>NAT</td><td>Нужен (костыль)</td><td>Не нужен</td></tr>
      <tr><td>Конфигурация</td><td>DHCP или вручную</td><td>Автоконфиг (SLAAC) + DHCPv6</td></tr>
      <tr><td>Безопасность</td><td>IPsec опционально</td><td>IPsec обязателен</td></tr>
      <tr><td>Broadcast</td><td>Есть</td><td>Заменён на multicast/anycast</td></tr>
      <tr><td>Заголовок</td><td>20–60 байт, 13 полей</td><td>40 байт, 8 полей</td></tr>
    </table>

    <div class="info-box success">
      <strong>На практике сегодня:</strong> большинство сетей работают в <strong>dual-stack</strong> — поддерживают и IPv4 и IPv6 одновременно. Google в 2024 говорит, что >40% трафика к нему уже идёт по IPv6.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     ARP
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-arp" class="section">
  <div class="section-title">ARP — мост между IP и MAC</div>

  <p class="text"><strong>ARP (Address Resolution Protocol)</strong> отвечает на вопрос: <em>«я знаю IP получателя, а какой у него MAC?»</em></p>

  <div class="why-box">
    <strong>Зачем нужен:</strong> чтобы отправить кадр Ethernet, нужен <strong>MAC</strong> получателя. Приложение знает только IP (например, <code>192.168.1.5</code>). ARP это «справочное бюро» внутри LAN.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="message-circle"></i> Как работает</div>
    <ol class="bullets" style="list-style:decimal;">
      <li><strong>ARP Request</strong> (broadcast — слышат все в LAN): «Кто такой <code>192.168.1.5</code>? Ответь.»</li>
      <li>Все хосты получают запрос. У кого нет такого IP — игнорируют.</li>
      <li>Хост с <code>192.168.1.5</code> отвечает: «Это я, мой MAC — <code>D4:6A:6D:89:1F:22</code>.»</li>
      <li>Отправитель сохраняет пару (<code>IP → MAC</code>) в <strong>ARP-таблице</strong> на несколько минут.</li>
      <li>Все последующие отправки идут сразу, без повторного запроса.</li>
    </ol>
    <div class="diagram">┌───────┐                          ┌───────┐ ┌───────┐ ┌───────┐
│ PC-A  │── "Who has 192.168.1.5?" → │ PC-X  │ │ PC-Y  │ │ PC-Z  │
└───────┘   (broadcast, всем сразу)  └───────┘ └───────┘ └───────┘
                                                                ↓
┌───────┐                                                     "Это я,
│ PC-A  │← "192.168.1.5 → MAC AA:BB:CC:DD:EE:FF" ←───────── MAC..."
└───────┘                                                     </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-text"></i> Формат ARP-сообщения (28 байт)</div>
    <table class="data-table">
      <tr><th>Поле</th><th>Размер</th><th>Что</th></tr>
      <tr><td><strong>Hardware Type</strong></td><td>2 байта</td><td>Тип физической сети. Для Ethernet = <code>1</code></td></tr>
      <tr><td><strong>Protocol Type</strong></td><td>2 байта</td><td>Какой протокол сетевого уровня. Для IPv4 = <code>0x0800</code> (2048)</td></tr>
      <tr><td><strong>Hardware Size</strong></td><td>1 байт</td><td>Длина MAC в байтах = <code>6</code></td></tr>
      <tr><td><strong>Protocol Size</strong></td><td>1 байт</td><td>Длина IP в байтах = <code>4</code> для IPv4</td></tr>
      <tr><td><strong>Operation</strong></td><td>2 байта</td><td><code>1</code> = Request («кто такой?»), <code>2</code> = Reply («это я»)</td></tr>
      <tr><td><strong>Sender MAC</strong></td><td>6 байт</td><td>MAC отправителя</td></tr>
      <tr><td><strong>Sender IP</strong></td><td>4 байта</td><td>IP отправителя</td></tr>
      <tr><td><strong>Target MAC</strong></td><td>6 байт</td><td>MAC получателя (в Request пустой — мы его и спрашиваем)</td></tr>
      <tr><td><strong>Target IP</strong></td><td>4 байта</td><td>IP получателя</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="megaphone"></i> Особые виды ARP</div>
    <table class="data-table">
      <tr><th>Вид</th><th>Что делает</th><th>Зачем</th></tr>
      <tr><td><strong>Gratuitous ARP</strong></td><td>«Бесплатный» ARP — устройство само объявляет свою пару IP/MAC, никто не спрашивал</td><td>Обнаружить конфликт IP (если кто-то уже использует) или обновить ARP-таблицы у других</td></tr>
      <tr><td><strong>RARP (Reverse ARP)</strong></td><td>Наоборот: «Я знаю свой MAC, какой у меня IP?»</td><td>Устарел, заменён <strong>DHCP</strong></td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="table"></i> ARP таблицы</div>
    <p class="text">Каждое устройство хранит свою ARP-таблицу (IP → MAC):</p>
    <ul class="bullets">
      <li><strong>Static</strong> — добавляется вручную администратором (защита от spoofing).</li>
      <li><strong>Dynamic</strong> — выучивается автоматически, истекает через таймаут (обычно несколько минут).</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> ARP spoofing — самая популярная атака в LAN</div>
    <p class="text">ARP не проверяет, кто отвечает. Поэтому злоумышленник в твоей сети может ответить раньше: «<code>192.168.1.5</code> — это я!» — и весь твой трафик пойдёт через него. Это <strong>MITM-атака (Man-In-The-Middle)</strong>.</p>
    <p class="text"><strong>Защита:</strong> Dynamic ARP Inspection на switch'ах, статические ARP-таблицы, VPN.</p>
  </div>

  <div class="info-box primary">
    <strong>В IPv6</strong> ARP заменён на <strong>NDP (Neighbor Discovery Protocol)</strong>. Делает то же самое, но безопаснее.
  </div>

  <p class="text"><strong>Как посмотреть свою ARP-таблицу:</strong></p>
<pre><code>arp -a              <span style="color:#5C6370;"># Mac/Windows/Linux</span>
ip neigh show       <span style="color:#5C6370;"># Linux (новая команда)</span></code></pre>
</div>

<!-- ════════════════════════════════════════════════════════════════
     TCP
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-tcp" class="section">
  <div class="section-title">TCP — надёжная доставка</div>

  <p class="text"><strong>TCP (Transmission Control Protocol)</strong> — это «заказное письмо с уведомлением». Гарантирует, что все байты <strong>дошли в правильном порядке, без потерь и дубликатов</strong>.</p>

  <div class="analogy">
    <strong>Аналогия:</strong> TCP = <strong>телефонный звонок</strong>. Сначала «алло, ты меня слышишь?» (handshake). Потом разговор — каждую фразу подтверждаешь («угу», «понял»). Если связь оборвётся — заметишь сразу.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="handshake"></i> 3-way handshake</div>
    <p class="text">Прежде чем что-то передать, TCP <strong>устанавливает соединение</strong>:</p>
    <div class="diagram">  Client                            Server
    │                                  │
    │── SYN (seq=100) ────────────────→│   "Привет, давай поговорим, мой seq=100"
    │                                  │
    │←─── SYN-ACK (seq=500, ack=101) ──│   "Ок, мой seq=500, я слышал твой 100, жду 101"
    │                                  │
    │── ACK (ack=501) ────────────────→│   "Ок, жду твой 501"
    │                                  │
    ✅ Connection established
    │                                  │
    │── DATA (seq=101) ───────────────→│
    │←──────────────── ACK (ack=...) ──│</div>

    <div class="info-box primary">
      Поэтому когда говорят «TCP — соединение установлено» — это не просто метафора. Реально 3 пакета пролетели прежде чем данные начали идти.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="shield-check"></i> Механизмы надёжности</div>
    <table class="data-table">
      <tr><th>Механизм</th><th>Что делает</th></tr>
      <tr><td><strong>Sequence numbers</strong></td><td>Каждому байту — свой номер. Получатель собирает в правильном порядке.</td></tr>
      <tr><td><strong>ACK</strong></td><td>Получатель подтверждает «я получил байты до N включительно».</td></tr>
      <tr><td><strong>Retransmission</strong></td><td>Если ACK не пришёл за timeout — отправитель шлёт пакет заново.</td></tr>
      <tr><td><strong>Sliding window</strong></td><td>Можно отправить несколько пакетов, не дожидаясь ACK после каждого. Получатель говорит «у меня буфер на 64 КБ» — отправитель не льёт больше.</td></tr>
      <tr><td><strong>Flow control</strong></td><td>Не дать перегрузить медленного получателя.</td></tr>
      <tr><td><strong>Congestion control</strong></td><td>Если сеть забита — снизить скорость отправки (алгоритмы Reno, Cubic, BBR).</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="flag"></i> TCP flags (важные)</div>
    <ul class="bullets">
      <li><strong>SYN</strong> — синхронизация (начало соединения)</li>
      <li><strong>ACK</strong> — подтверждение</li>
      <li><strong>FIN</strong> — корректное закрытие соединения</li>
      <li><strong>RST</strong> — резкий разрыв (что-то пошло не так)</li>
      <li><strong>PSH</strong> — «не буферизуй, отдай приложению немедленно»</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-square"></i> Типы подтверждений (ACK)</div>
    <table class="data-table">
      <tr><th>Тип</th><th>Как работает</th></tr>
      <tr><td><strong>Cumulative ACK</strong> (по умолчанию)</td><td>«Я получил всё до байта N». Если потерян один пакет — нужно перепосылать всё начиная с него.</td></tr>
      <tr><td><strong>Selective ACK (SACK)</strong></td><td>«Я получил с 0 до 1000, а потом с 1500 до 2000. Перешли только 1000–1500». Эффективнее на потерях.</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="file-text"></i> TCP-заголовок (полная структура)</div>
    <table class="data-table">
      <tr><th>Поле</th><th>Размер</th><th>Что</th></tr>
      <tr><td><strong>Source Port</strong></td><td>16 бит</td><td>Порт приложения-отправителя</td></tr>
      <tr><td><strong>Destination Port</strong></td><td>16 бит</td><td>Порт приложения-получателя</td></tr>
      <tr><td><strong>Sequence Number</strong></td><td>32 бит</td><td>Номер первого байта в этом сегменте</td></tr>
      <tr><td><strong>Acknowledgment Number</strong></td><td>32 бит</td><td>Следующий ожидаемый байт от собеседника</td></tr>
      <tr><td><strong>Header Length</strong></td><td>4 бит</td><td>Длина заголовка (бывает разной из-за опций)</td></tr>
      <tr><td><strong>Flags</strong></td><td>9 бит</td><td>URG, ACK, PSH, RST, SYN, FIN, ECE, CWR, NS</td></tr>
      <tr><td><strong>Window Size</strong></td><td>16 бит</td><td>Сколько ещё байт готов принять (flow control)</td></tr>
      <tr><td><strong>Checksum</strong></td><td>16 бит</td><td>Контрольная сумма для проверки ошибок</td></tr>
      <tr><td><strong>Urgent Pointer</strong></td><td>16 бит</td><td>Указатель на «срочные» данные (если URG=1)</td></tr>
      <tr><td><strong>Options</strong></td><td>0–40 байт</td><td>SACK, window scaling, timestamps, MSS и т.д.</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check"></i> Плюсы и минусы TCP</div>
    <table class="data-table">
      <tr><th>✅ Плюсы</th><th>❌ Минусы</th></tr>
      <tr><td>Гарантия доставки</td><td>Тяжёлый — нужен handshake</td></tr>
      <tr><td>Гарантия порядка</td><td>Больше overhead (заголовок 20-60 байт)</td></tr>
      <tr><td>Обнаружение и исправление ошибок</td><td>Медленнее для real-time</td></tr>
      <tr><td>Flow / congestion control</td><td>Head-of-line blocking (потерянный пакет тормозит всё)</td></tr>
    </table>
  </div>

  <div class="info-box success">
    <strong>Где используется TCP:</strong> HTTP/HTTPS (веб), SMTP/IMAP/POP3 (email), FTP/SFTP (файлы), SSH (терминал) — везде, где <strong>важно, чтобы дошли все байты в порядке</strong>.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     UDP
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-udp" class="section">
  <div class="section-title">UDP — быстро, без гарантий</div>

  <p class="text"><strong>UDP (User Datagram Protocol)</strong> — «открытка». Отправил и забыл. Никаких подтверждений, никакой гарантии доставки.</p>

  <div class="analogy">
    <strong>Аналогия:</strong> UDP = <strong>SMS / открытка</strong>. Бросил в ящик, не знаешь — дошло или нет. Зато быстро и без церемоний.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="zap"></i> Что есть и чего нет</div>
    <table class="data-table">
      <tr><th>Есть</th><th>Нет</th></tr>
      <tr><td>Порт отправителя, порт получателя</td><td>Handshake</td></tr>
      <tr><td>Длина пакета</td><td>Подтверждения</td></tr>
      <tr><td>Контрольная сумма (опционально в IPv4, обязательно в IPv6)</td><td>Гарантия доставки</td></tr>
      <tr><td>Заголовок 8 байт (vs 20+ в TCP)</td><td>Гарантия порядка</td></tr>
      <tr><td></td><td>Flow / congestion control</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="target"></i> Когда выбирать UDP</div>
    <p class="text">Когда <strong>скорость важнее надёжности</strong>:</p>
    <ul class="bullets">
      <li><strong>Видео-стриминг</strong> (YouTube, Netflix) — лучше пропустить кадр, чем поставить на паузу.</li>
      <li><strong>VoIP / видеозвонки</strong> (Zoom, WhatsApp) — то же самое: лучше потерять долю секунды звука, чем тормозить.</li>
      <li><strong>Онлайн-игры</strong> — игроку важнее текущая позиция врага, чем «история всех ранее пропущенных позиций».</li>
      <li><strong>DNS</strong> — запрос/ответ маленький, быстрый, нет смысла на handshake.</li>
      <li><strong>DHCP</strong> — выдача IP, тоже короткое сообщение.</li>
    </ul>
  </div>

  <div class="info-box warning">
    <strong>QUIC и HTTP/3</strong> — современный протокол поверх UDP. Берёт скорость UDP + сам реализует надёжность как у TCP. Уже используется в Chrome, YouTube, Cloudflare. Будущее веба — это UDP-based транспорт.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     ICMP
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-icmp" class="section">
  <div class="section-title">ICMP — диагностика сети</div>

  <p class="text"><strong>ICMP (Internet Control Message Protocol)</strong> — не передаёт «полезные» данные. Это «служебный канал» для <strong>сообщений об ошибках и диагностики</strong>.</p>

  <div class="analogy">
    <strong>Аналогия:</strong> ICMP — это <strong>почтальон, который возвращается с конвертом</strong> и говорит «такого адреса нет» или «доставлено». Без него ты бы не знал, что пакет не дошёл.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="message-square"></i> Самые важные типы сообщений</div>
    <table class="data-table">
      <tr><th>Type</th><th>Что значит</th><th>Где встречается</th></tr>
      <tr><td>0 — Echo Reply</td><td>«Я живой» (ответ на ping)</td><td>ping</td></tr>
      <tr><td>8 — Echo Request</td><td>«Ты живой?» (сам ping)</td><td>ping</td></tr>
      <tr><td>3 — Destination Unreachable</td><td>«Не могу доставить» (host down, port closed, etc.)</td><td>отлов проблем</td></tr>
      <tr><td>5 — Redirect</td><td>«Есть лучший маршрут, обнови routing table»</td><td>динамическая маршрутизация</td></tr>
      <tr><td>11 — Time Exceeded</td><td>«TTL дошёл до 0» — пакет уничтожен</td><td>traceroute</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="terminal"></i> Полезные команды</div>
<pre><code><span style="color:#5C6370;"># Проверить, доступен ли хост</span>
ping google.com
ping 8.8.8.8

<span style="color:#5C6370;"># Показать путь до сервера (через какие routers идёт)</span>
traceroute google.com         <span style="color:#5C6370;"># Linux/Mac</span>
tracert google.com            <span style="color:#5C6370;"># Windows</span>

<span style="color:#5C6370;"># Расширенная диагностика (ping + traceroute + loss %)</span>
mtr google.com                <span style="color:#5C6370;"># Linux/Mac</span></code></pre>

    <div class="info-box primary">
      <strong>Как работает traceroute:</strong> отправляет пакеты с TTL=1, 2, 3... Каждый router на пути отвечает «Time Exceeded» при TTL=0. Так traceroute узнаёт каждого участника пути.
    </div>
  </div>

  <div class="info-box warning">
    <strong>Безопасность:</strong> ICMP часто блокируют на firewall'ах (защита от Ping flood DDoS). Если <code>ping</code> до сервера не работает, это <strong>не значит, что сервер мёртв</strong> — может просто ICMP закрыт.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PORTS
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-ports" class="section">
  <div class="section-title">Порты — двери в твоё устройство</div>

  <p class="text"><strong>Порт</strong> — это число от 0 до 65535, которое говорит «к какому приложению на устройстве относится этот трафик».</p>

  <div class="analogy">
    <strong>Аналогия:</strong> IP = адрес дома. Порт = номер двери / квартиры. На одном IP может быть много «дверей» — каждая ведёт в своё приложение.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers-3"></i> 3 диапазона портов</div>
    <table class="data-table">
      <tr><th>Диапазон</th><th>Тип</th><th>Кто использует</th></tr>
      <tr><td><strong>0 – 1023</strong></td><td>Well-known</td><td>Стандартные сервисы (HTTP, SSH, DNS). Требуют root-прав.</td></tr>
      <tr><td><strong>1024 – 49151</strong></td><td>Registered</td><td>IANA закрепила за конкретными сервисами (MySQL 3306, PostgreSQL 5432)</td></tr>
      <tr><td><strong>49152 – 65535</strong></td><td>Dynamic / Ephemeral</td><td>Временные. ОС выдаёт клиенту при исходящем соединении.</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="book"></i> Порты, которые ты должен знать наизусть</div>
    <table class="data-table">
      <tr><th>Порт</th><th>Протокол</th><th>Сервис</th></tr>
      <tr><td><strong>20, 21</strong></td><td>TCP</td><td>FTP (передача файлов)</td></tr>
      <tr><td><strong>22</strong></td><td>TCP</td><td>SSH / SFTP</td></tr>
      <tr><td><strong>25</strong></td><td>TCP</td><td>SMTP (отправка email)</td></tr>
      <tr><td><strong>53</strong></td><td>UDP/TCP</td><td>DNS</td></tr>
      <tr><td><strong>67, 68</strong></td><td>UDP</td><td>DHCP</td></tr>
      <tr><td><strong>80</strong></td><td>TCP</td><td>HTTP</td></tr>
      <tr><td><strong>110</strong></td><td>TCP</td><td>POP3 (приём email)</td></tr>
      <tr><td><strong>143</strong></td><td>TCP</td><td>IMAP (приём email)</td></tr>
      <tr><td><strong>443</strong></td><td>TCP</td><td>HTTPS</td></tr>
      <tr><td><strong>3306</strong></td><td>TCP</td><td>MySQL</td></tr>
      <tr><td><strong>5432</strong></td><td>TCP</td><td>PostgreSQL</td></tr>
      <tr><td><strong>6379</strong></td><td>TCP</td><td>Redis</td></tr>
      <tr><td><strong>3389</strong></td><td>TCP</td><td>RDP (удалённый рабочий стол Windows)</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="search"></i> Что происходит когда ты открываешь сайт</div>
    <div class="diagram">Твой Chrome:  192.168.1.5:52144   ←─ случайный ephemeral port
                    │
                    ▼
Сайт example.com:  93.184.216.34:443  ←─ стандартный HTTPS

TCP-соединение:  (192.168.1.5, 52144) ↔ (93.184.216.34, 443)</div>
    <p class="text">Это <strong>4 числа</strong> однозначно идентифицируют соединение. Поэтому на одном IP сервер может держать сотни тысяч одновременных соединений — у каждого свой набор (client_ip, client_port, server_ip, server_port).</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="terminal"></i> Полезные команды</div>
<pre><code><span style="color:#5C6370;"># Какие порты слушает машина</span>
sudo lsof -i -P -n | grep LISTEN     <span style="color:#5C6370;"># Mac/Linux</span>
sudo ss -tulpn                        <span style="color:#5C6370;"># Linux</span>
netstat -an | grep LISTEN             <span style="color:#5C6370;"># Windows</span>

<span style="color:#5C6370;"># Кто занял порт 8000</span>
lsof -i :8000

<span style="color:#5C6370;"># Проверить, открыт ли порт на удалённом сервере</span>
nc -zv example.com 443
telnet example.com 443</code></pre>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     SUBNETS WHY
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-subnets-why" class="section">
  <div class="section-title">Зачем подсети</div>

  <p class="text"><strong>Subnetting</strong> — это разделение одной большой IP-сети на несколько маленьких.</p>

  <div class="why-box">
    <strong>Зачем:</strong>
    <ul class="bullets" style="margin-top:8px;">
      <li><strong>Экономия адресов</strong> — выдать ровно столько, сколько нужно (а не целый класс).</li>
      <li><strong>Скорость</strong> — broadcast в большой сети грузит все устройства. В маленькой подсети broadcast не «гуляет» дальше.</li>
      <li><strong>Безопасность</strong> — разные отделы (бухгалтерия, разработка) в разных подсетях, между ними firewall.</li>
      <li><strong>Управление</strong> — проще отлавливать проблемы.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="info"></i> Атрибуты любой подсети</div>
    <p class="text">У каждой подсети 4 ключевых параметра:</p>
    <table class="data-table">
      <tr><th>Атрибут</th><th>Что это</th><th>Пример (для 192.168.1.0/24)</th></tr>
      <tr><td><strong>Network address</strong></td><td>Идентификатор подсети (все биты хоста = 0)</td><td><code>192.168.1.0</code></td></tr>
      <tr><td><strong>Broadcast address</strong></td><td>Адрес «всем в подсети» (все биты хоста = 1)</td><td><code>192.168.1.255</code></td></tr>
      <tr><td><strong>First host</strong></td><td>Первый юзабельный адрес</td><td><code>192.168.1.1</code></td></tr>
      <tr><td><strong>Last host</strong></td><td>Последний юзабельный адрес</td><td><code>192.168.1.254</code></td></tr>
      <tr><td><strong>Mask / Prefix</strong></td><td>Где кончается «сеть» и начинается «хост»</td><td><code>255.255.255.0</code> = <code>/24</code></td></tr>
    </table>
    <div class="info-box primary">
      <strong>Минус 2 в подсчёте хостов:</strong> network address и broadcast «съедают» 2 адреса из доступных. Поэтому формула: <code>2^(32 − prefix) − 2</code>.
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     SUBNETS CIDR
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-subnets-cidr" class="section">
  <div class="section-title">Маска подсети и CIDR</div>

  <p class="text"><strong>Subnet mask</strong> — это последовательность 32 бит, где <strong>единицы означают «это сетевая часть»</strong>, а <strong>нули — «это часть хоста»</strong>.</p>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="ruler"></i> Как читать маску</div>
    <div class="diagram">IP:        192.168.1.100
Маска:     255.255.255.0    →    /24

В бинарном виде:
IP:        11000000.10101000.00000001.01100100
Маска:     11111111.11111111.11111111.00000000
                 ←─ 24 единицы ─→  ←─ 8 нулей ─→
                 (сетевая часть)   (часть хоста)

Network:   11000000.10101000.00000001.00000000  = 192.168.1.0
Broadcast: 11000000.10101000.00000001.11111111  = 192.168.1.255</div>

    <div class="info-box primary">
      <strong>Простое правило:</strong> чем больше единиц в маске → тем меньше адресов в подсети.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="hash"></i> CIDR notation — короткая запись</div>
    <p class="text">Вместо «маска 255.255.255.0» пишут «/24» — это просто <strong>количество единиц в маске</strong>.</p>
    <table class="data-table">
      <tr><th>CIDR</th><th>Маска</th><th>Хостов</th><th>Применение</th></tr>
      <tr><td>/8</td><td>255.0.0.0</td><td>~16 777 214</td><td>Гигантские сети</td></tr>
      <tr><td>/16</td><td>255.255.0.0</td><td>65 534</td><td>Средние корпорации</td></tr>
      <tr><td>/24</td><td>255.255.255.0</td><td>254</td><td>Малые офисы, дома</td></tr>
      <tr><td>/27</td><td>255.255.255.224</td><td>30</td><td>Маленький отдел</td></tr>
      <tr><td>/29</td><td>255.255.255.248</td><td>6</td><td>Несколько серверов</td></tr>
      <tr><td>/30</td><td>255.255.255.252</td><td>2</td><td>Линк между двумя router'ами</td></tr>
      <tr><td>/32</td><td>255.255.255.255</td><td>1</td><td>Один конкретный host</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="calculator"></i> Формулы для расчёта</div>
<pre><code><span style="color:#5C6370;"># Сколько хостов в подсети</span>
hosts = 2^(32 − prefix) − 2

<span style="color:#5C6370;"># Например, для /24:</span>
2^(32-24) − 2 = 256 − 2 = 254 хоста

<span style="color:#5C6370;"># Размер блока (block size) в последнем октете</span>
block_size = 256 − (последний октет маски)

<span style="color:#5C6370;"># Например, для маски 255.255.255.192 (/26):</span>
block_size = 256 − 192 = 64
<span style="color:#5C6370;"># → подсети начинаются с .0, .64, .128, .192</span></code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="brain"></i> Бинарная арифметика для подсетей</div>
    <p class="text">Чтобы конвертировать число в бинарный вид: <strong>делим на 2, записываем остатки, читаем снизу вверх</strong>.</p>
    <div class="diagram">Пример: 156 в бинарный

156 ÷ 2 = 78  остаток 0   ←─┐
 78 ÷ 2 = 39  остаток 0     │
 39 ÷ 2 = 19  остаток 1     │
 19 ÷ 2 = 9   остаток 1     │ читаем
  9 ÷ 2 = 4   остаток 1     │ снизу
  4 ÷ 2 = 2   остаток 0     │ вверх
  2 ÷ 2 = 1   остаток 0     │
  1 ÷ 2 = 0   остаток 1   ──┘

156 = 10011100</div>

    <p class="text"><strong>Обратно:</strong> бинарное число → сумма степеней 2 для каждой 1.</p>
    <div class="diagram">10011100
↓
1·128 + 0·64 + 0·32 + 1·16 + 1·8 + 1·4 + 0·2 + 0·1
= 128 + 16 + 8 + 4
= 156</div>

    <div class="info-box success">
      <strong>Запомни магические числа октета:</strong> 128, 64, 32, 16, 8, 4, 2, 1. Любое число от 0 до 255 — это сумма каких-то из них.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="play"></i> Пример 1 — простая /24</div>
    <p class="text">Дано: IP <code>192.168.156.3/24</code>.</p>
    <table class="data-table">
      <tr><th>Параметр</th><th>Расчёт</th><th>Результат</th></tr>
      <tr><td>Маска</td><td>/24 = 24 единицы</td><td><code>255.255.255.0</code></td></tr>
      <tr><td>Network address</td><td>обнуляем 4-й октет</td><td><code>192.168.156.0</code></td></tr>
      <tr><td>Broadcast</td><td>все 1 в 4-м октете</td><td><code>192.168.156.255</code></td></tr>
      <tr><td>First host</td><td>network + 1</td><td><code>192.168.156.1</code></td></tr>
      <tr><td>Last host</td><td>broadcast − 1</td><td><code>192.168.156.254</code></td></tr>
      <tr><td>Хостов</td><td>2^8 − 2</td><td>254</td></tr>
    </table>
    <p class="text"><strong>Интуиция:</strong> 24 единицы маски «закрепили» первые 3 октета — это «адрес сети». Последний октет свободен → 256 вариантов, минус 2 (network + broadcast) = 254 хоста.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="play"></i> Пример 2 — сложнее, /21</div>
    <p class="text">Дано: IP <code>192.168.156.3/21</code>. Что мы можем сказать?</p>
    <table class="data-table">
      <tr><th>Параметр</th><th>Расчёт</th><th>Результат</th></tr>
      <tr><td>Маска</td><td>/21 = 21 единица</td><td><code>255.255.248.0</code></td></tr>
      <tr><td>Block size в 3-м октете</td><td>256 − 248</td><td>8</td></tr>
      <tr><td>Сети начинаются</td><td>.0, .8, .16, ..., .152, .160, ...</td><td>наш .156 попадает в блок .152–.159</td></tr>
      <tr><td>Network address</td><td>192.168.152.0</td><td><code>192.168.152.0</code></td></tr>
      <tr><td>Broadcast</td><td>192.168.159.255</td><td><code>192.168.159.255</code></td></tr>
      <tr><td>First host</td><td>192.168.152.1</td><td><code>192.168.152.1</code></td></tr>
      <tr><td>Last host</td><td>192.168.159.254</td><td><code>192.168.159.254</code></td></tr>
      <tr><td>Хостов</td><td>2^11 − 2</td><td>2046</td></tr>
    </table>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     PRIVATE NETWORKS + NAT
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-subnets-private" class="section">
  <div class="section-title">Приватные сети и NAT</div>

  <p class="text"><strong>Приватные IP-адреса</strong> — это специальные диапазоны, которые «не выходят в Интернет». Их используют внутри LAN. Один и тот же приватный IP может быть у миллионов разных компаний — конфликта нет, потому что они «не видят» друг друга.</p>

  <div class="why-box">
    <strong>Зачем:</strong> публичных IPv4 адресов <strong>не хватает</strong>. Не каждое устройство нужно делать видимым в Интернет (твой принтер, смарт-ТВ, камера видеонаблюдения). Решение: приватные адреса внутри + один публичный на выходе.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="lock"></i> 3 приватных блока (RFC 1918, 1996)</div>
    <table class="data-table">
      <tr><th>Блок</th><th>Диапазон</th><th>Адресов</th><th>Где используют</th></tr>
      <tr><td><code>10.0.0.0/8</code></td><td>10.0.0.0 – 10.255.255.255</td><td>16 777 216</td><td>Гигантские корпорации, AWS VPC</td></tr>
      <tr><td><code>172.16.0.0/12</code></td><td>172.16.0.0 – 172.31.255.255</td><td>1 048 576</td><td>Средние организации, Docker</td></tr>
      <tr><td><code>192.168.0.0/16</code></td><td>192.168.0.0 – 192.168.255.255</td><td>65 536</td><td>Домашние Wi-Fi, малые офисы</td></tr>
    </table>
    <div class="info-box primary">
      <strong>Твой домашний Wi-Fi</strong> почти 100% использует <code>192.168.0.x</code> или <code>192.168.1.x</code>. Если зайти в админку роутера — увидишь это там.
    </div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="repeat"></i> NAT — Network Address Translation</div>
    <p class="text">NAT — это <strong>переводчик</strong> между приватной сетью и Интернетом. Живёт обычно на роутере.</p>

    <div class="diagram">┌────────────── ВНУТРИ ДОМА ────────────────┐
│                                                │
│  Laptop  192.168.1.5  ───┐                    │
│                          │                    │
│  Phone   192.168.1.6  ───┤                    │
│                          ├──→ [Router/NAT] ──→ Internet
│  TV      192.168.1.7  ───┤        ↓           │
│                          │   77.243.80.138   │
│  Все имеют разные         │   (один публич-   │
│  приватные IP            │    ный IP на всех)│
└──────────────────────────────────────────────┘

Как видит сайт Google:
   "Все запросы идут с 77.243.80.138"</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="arrow-left-right"></i> Как NAT отличает «чьи» ответы</div>
    <p class="text">NAT хранит <strong>таблицу трансляций</strong>: какой внутренний клиент с каким портом куда обратился.</p>
    <table class="data-table">
      <tr><th>Внутри</th><th>Снаружи</th><th>Назначение</th></tr>
      <tr><td>192.168.1.5:54321</td><td>77.243.80.138:11001</td><td>google.com:443</td></tr>
      <tr><td>192.168.1.6:33445</td><td>77.243.80.138:11002</td><td>youtube.com:443</td></tr>
    </table>
    <p class="text">Когда ответ приходит на <code>77.243.80.138:11001</code> — NAT смотрит таблицу, переводит обратно в <code>192.168.1.5:54321</code> и отправляет на ноутбук.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="alert-triangle"></i> Минусы NAT</div>
    <ul class="bullets">
      <li><strong>Ломает end-to-end</strong> — извне нельзя инициировать соединение к устройству за NAT (только наоборот).</li>
      <li><strong>Проблемы для P2P / VoIP</strong> — нужны костыли типа STUN/TURN.</li>
      <li>Усложняет debugging.</li>
    </ul>
    <p class="text">В IPv6 NAT <strong>не нужен</strong> — адресов хватает всем.</p>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     FLSM vs VLSM
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-subnets-vlsm" class="section">
  <div class="section-title">FLSM vs VLSM</div>

  <p class="text">Когда делишь сеть на подсети, есть две стратегии:</p>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="square-equal"></i> FLSM — Fixed Length Subnet Mask</div>
    <p class="text">Все подсети — <strong>одного размера</strong>. Берём самую большую нужную и применяем ко всем.</p>
    <p class="text"><strong>Пример:</strong> нужно 6 подсетей в <code>192.168.156.0/24</code>. Делим на /27 (по 32 адреса = 30 хостов в каждой):</p>
    <div class="diagram">192.168.156.0/27    ─ хостов: .1–.30,    broadcast .31
192.168.156.32/27   ─ хостов: .33–.62,   broadcast .63
192.168.156.64/27   ─ хостов: .65–.94,   broadcast .95
192.168.156.96/27   ─ хостов: .97–.126,  broadcast .127
192.168.156.128/27  ─ хостов: .129–.158, broadcast .159
192.168.156.160/27  ─ хостов: .161–.190, broadcast .191</div>
    <p class="text"><strong>Плюс:</strong> просто.</p>
    <p class="text"><strong>Минус:</strong> если одной подсети нужно 28 хостов, а другой 5 — обеим даём по 30, и в маленькой 25 адресов пропадает.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="scaling"></i> VLSM — Variable Length Subnet Mask</div>
    <p class="text"><strong>Каждой подсети — своя маска</strong>. По потребности.</p>
    <p class="text"><strong>Пример:</strong> в той же сети /24 нужны:</p>
    <ul class="bullets">
      <li>1 подсеть на 28 хостов → /27 (32 адреса)</li>
      <li>3 подсети по 16 хостов → /28 (16 адресов каждая)</li>
      <li>2 подсети по 8 хостов → /29 (8 адресов каждая)</li>
      <li>Линки между роутерами по 2 адреса → /30</li>
    </ul>
    <p class="text"><strong>Плюс:</strong> ничего не пропадает, использование адресов в 4-5 раз эффективнее.</p>
    <p class="text"><strong>Минус:</strong> сложнее планировать (но опытные сетевики делают на автомате).</p>
  </div>

  <div class="info-box success">
    <strong>Сегодня все нормальные протоколы маршрутизации</strong> (OSPF, EIGRP, BGP) поддерживают VLSM. FLSM остался только в очень старых системах и учебниках.
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     VLAN
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-vlan" class="section">
  <div class="section-title">VLAN — виртуальные локальные сети</div>

  <p class="text"><strong>VLAN (Virtual LAN)</strong> — это способ <strong>логически разделить один физический switch на несколько независимых сетей</strong>.</p>

  <div class="why-box">
    <strong>Зачем:</strong> представь офис с одним switch. К нему подключены бухгалтерия, разработка, гостевой Wi-Fi. По дефолту все слышат друг друга (один broadcast domain). VLAN разделяет: бухгалтерия в VLAN 10, разработка в VLAN 20, гости в VLAN 30. Между собой не общаются. Без покупки трёх отдельных switch'ей.
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="tag"></i> Как это работает — IEEE 802.1Q tagging</div>
    <p class="text">К каждому Ethernet-кадру switch добавляет <strong>тег</strong> с номером VLAN. Это 32-битное поле между Source MAC и EtherType.</p>
    <div class="diagram">Обычный кадр:
[Dst MAC][Src MAC][EtherType][Data][CRC]

802.1Q-кадр (с VLAN-тегом):
[Dst MAC][Src MAC][0x8100][TCI:VLAN10][EtherType][Data][CRC]
                     │       │
                  TPID     12 бит = VLAN ID (от 1 до 4094)
                (маркер,
                 что есть
                 тег)</div>
    <p class="text">Тег содержит:</p>
    <ul class="bullets">
      <li><strong>TPID</strong> (16 бит) — всегда <code>0x8100</code>, говорит «это VLAN-tagged кадр».</li>
      <li><strong>PCP</strong> (3 бита) — приоритет (QoS).</li>
      <li><strong>DEI</strong> (1 бит) — можно ли дропнуть при перегрузке.</li>
      <li><strong>VLAN ID</strong> (12 бит) — номер VLAN. Доступно 4094 (0 и 4095 зарезервированы).</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="door-open"></i> Access vs Trunk порты</div>
    <table class="data-table">
      <tr><th></th><th>Access</th><th>Trunk</th></tr>
      <tr><td><strong>Куда подключают</strong></td><td>Конечные устройства (ПК, принтеры)</td><td>Между switch'ами или switch ↔ router</td></tr>
      <tr><td><strong>Кадры на проводе</strong></td><td>Без тега (untagged)</td><td>С тегом (tagged)</td></tr>
      <tr><td><strong>Что делает switch</strong></td><td>Добавляет тег на входе, убирает на выходе</td><td>Пропускает кадры с тегами как есть</td></tr>
      <tr><td><strong>Сколько VLAN</strong></td><td>1 (один порт = одна VLAN)</td><td>Много VLAN через один порт</td></tr>
    </table>

    <div class="diagram">┌──────┐        ┌──────────┐                ┌──────────┐         ┌──────┐
│ PC-A │────────│ Switch-1 │═══════════════│ Switch-2 │─────────│ PC-B │
└──────┘ access └──────────┘     trunk      └──────────┘ access └──────┘
 VLAN 10        (добавляет     (тегированные    (убирает     VLAN 10
 untagged        VLAN 10 тег)  кадры идут       тег)         untagged
                                с метками)</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="play"></i> 3 сценария общения</div>

    <p class="text"><strong>Сценарий 1:</strong> PC-A и PC-B в одной VLAN на одном switch — общаются напрямую (внутри switch без тегов).</p>

    <p class="text"><strong>Сценарий 2:</strong> PC-A и PC-B в одной VLAN на разных switch'ах — switch-1 тегирует, кадр идёт через trunk, switch-2 снимает тег, отдаёт PC-B.</p>

    <p class="text"><strong>Сценарий 3 (важный!):</strong> PC-A в VLAN 10, PC-B в VLAN 20 — <strong>не общаются напрямую</strong>. Switch отбросит кадр. Чтобы связать VLAN — нужен <strong>router</strong> (или L3 switch).</p>
    <div class="diagram">VLAN 10  ─┐
           ├──→  Router / L3 Switch  ←── VLAN 20
VLAN 10  ─┘
                    ↑
            (снимает один тег,
             маршрутизирует по IP,
             ставит другой тег)</div>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="settings"></i> Static vs Dynamic VLAN</div>
    <table class="data-table">
      <tr><th></th><th>Static VLAN</th><th>Dynamic VLAN</th></tr>
      <tr><td><strong>Назначение порта</strong></td><td>Вручную админом</td><td>Автоматически на основе MAC / типа устройства</td></tr>
      <tr><td><strong>Переехал на другой порт</strong></td><td>Админ должен переназначить</td><td>Switch сам определит и назначит правильную VLAN</td></tr>
      <tr><td><strong>Где применяют</strong></td><td>Малые/средние офисы</td><td>Большие корпорации, где люди постоянно перемещаются</td></tr>
    </table>

    <div class="subsection-title" style="font-size:13px;margin-top:14px;"><i data-lucide="server"></i> Как работает Dynamic VLAN через VMPS</div>
    <p class="text"><strong>VMPS (VLAN Management Policy Server)</strong> — центральный сервер с политиками: «такой MAC → VLAN 10», «такой тип устройства → VLAN 20».</p>
    <ol class="bullets" style="list-style:decimal;">
      <li>Пользователь подключает устройство к свободному порту.</li>
      <li>Switch отправляет запрос на VMPS: «вот MAC <code>D4:6A:6D:89:1F:22</code>, какая ему VLAN?»</li>
      <li>VMPS смотрит политику и отвечает: «VLAN 10».</li>
      <li>Switch автоматически назначает этот порт в VLAN 10 и начинает тегировать кадры.</li>
    </ol>
    <p class="text"><strong>Плюс:</strong> сотрудник может сесть за любой стол — попадёт в свою VLAN автоматически.</p>
    <p class="text"><strong>Минус:</strong> требует дополнительной инфраструктуры (VMPS-сервер).</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="check-circle"></i> Зачем использовать VLAN</div>
    <ul class="bullets">
      <li><strong>Уменьшение broadcast-доменов</strong> — меньше «шума» в сети.</li>
      <li><strong>Безопасность</strong> — бухгалтерия и разработка изолированы.</li>
      <li><strong>Гибкость</strong> — переехал сотрудник на другой этаж, всё ещё в той же VLAN.</li>
      <li><strong>Дешевле</strong> — не надо покупать отдельные switch'и для каждого отдела.</li>
    </ul>
  </div>
</div>

<!-- ════════════════════════════════════════════════════════════════
     CHEAT SHEET
     ════════════════════════════════════════════════════════════════ -->
<div id="sec-cheatsheet" class="section">
  <div class="section-title">Шпаргалка — всё на одной странице</div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="box"></i> Виртуализация</div>
    <ul class="bullets">
      <li><strong>VM</strong> = полный компьютер в файле. Гипервизор Type 1 (bare metal: ESXi, KVM) / Type 2 (hosted: VirtualBox).</li>
      <li><strong>VM vs Container</strong>: VM = своя ОС, гигабайты, минуты. Container = только приложение, общее ядро, секунды.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="network"></i> Типы сетей</div>
    <p class="text">PAN (Bluetooth) → LAN (офис) → MAN (город) → WAN (мир). WLAN = беспроводная LAN. VPN = шифрованный тоннель в Интернете.</p>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers"></i> OSI vs TCP/IP</div>
    <table class="data-table">
      <tr><th>OSI (7)</th><th>TCP/IP (4)</th><th>Что</th></tr>
      <tr><td>Application + Presentation + Session</td><td>Application</td><td>HTTP, DNS, SMTP</td></tr>
      <tr><td>Transport</td><td>Transport</td><td>TCP, UDP, порты</td></tr>
      <tr><td>Network</td><td>Internet</td><td>IP, ARP, ICMP</td></tr>
      <tr><td>Data Link + Physical</td><td>Link</td><td>Ethernet, Wi-Fi, MAC</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="map-pin"></i> Адреса</div>
    <table class="data-table">
      <tr><th></th><th>MAC</th><th>IPv4</th><th>IPv6</th></tr>
      <tr><td>Длина</td><td>48 бит</td><td>32 бит</td><td>128 бит</td></tr>
      <tr><td>Пример</td><td><code>D4:6A:6D:89:1F:22</code></td><td><code>192.168.1.1</code></td><td><code>2001:db8::1</code></td></tr>
      <tr><td>Где работает</td><td>LAN (один сегмент)</td><td>Глобально</td><td>Глобально</td></tr>
      <tr><td>Аналогия</td><td>Имя жильца</td><td>Адрес квартиры</td><td>Адрес квартиры в новом городе</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="layers-3"></i> Протоколы</div>
    <table class="data-table">
      <tr><th>Протокол</th><th>Уровень</th><th>Что делает</th><th>Пример</th></tr>
      <tr><td><strong>ARP</strong></td><td>L2/L3</td><td>IP → MAC внутри LAN</td><td>«Кто 192.168.1.5? Скажи MAC»</td></tr>
      <tr><td><strong>TCP</strong></td><td>L4</td><td>Надёжно, с порядком, handshake</td><td>HTTP, SSH, Email</td></tr>
      <tr><td><strong>UDP</strong></td><td>L4</td><td>Быстро, без гарантий</td><td>Видео, VoIP, DNS, игры</td></tr>
      <tr><td><strong>ICMP</strong></td><td>L3</td><td>Диагностика, ошибки</td><td>ping, traceroute</td></tr>
      <tr><td><strong>IP</strong></td><td>L3</td><td>Маршрутизация по адресу</td><td>Все пакеты</td></tr>
    </table>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="door-open"></i> Порты ключевые</div>
<pre><code>20/21 FTP    22 SSH    25 SMTP    53 DNS    67/68 DHCP
80 HTTP    443 HTTPS    110 POP3    143 IMAP
3306 MySQL    5432 PostgreSQL    6379 Redis    3389 RDP</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="ruler"></i> Подсети — формулы</div>
<pre><code>Хостов в подсети = 2^(32 − prefix) − 2
Block size в октете = 256 − (последний октет маски)

Маски популярные:
  /24 = 255.255.255.0    → 254 хоста (типичный офис)
  /27 = 255.255.255.224  → 30 хостов
  /29 = 255.255.255.248  → 6 хостов
  /30 = 255.255.255.252  → 2 хоста (point-to-point)

Приватные диапазоны (RFC 1918):
  10.0.0.0/8         (16М)
  172.16.0.0/12      (1М)
  192.168.0.0/16     (65K)</code></pre>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="git-fork"></i> VLAN кратко</div>
    <ul class="bullets">
      <li><strong>VLAN</strong> — логическое разделение switch на отдельные сети.</li>
      <li><strong>802.1Q tag</strong> — 32-битное поле в кадре, содержит VLAN ID (1–4094).</li>
      <li><strong>Access port</strong> = untagged (для ПК). <strong>Trunk port</strong> = tagged (между switch'ами).</li>
      <li>Между разными VLAN общение — только через <strong>router</strong>.</li>
    </ul>
  </div>

  <div class="subsection">
    <div class="subsection-title"><i data-lucide="terminal"></i> Команды на каждый день</div>
<pre><code><span style="color:#5C6370;"># Свой IP</span>
ip addr        <span style="color:#5C6370;"># Linux</span>
ifconfig       <span style="color:#5C6370;"># Mac (старая) / Linux</span>
ipconfig       <span style="color:#5C6370;"># Windows</span>

<span style="color:#5C6370;"># Маршруты</span>
ip route       <span style="color:#5C6370;"># Linux</span>
netstat -nr    <span style="color:#5C6370;"># Mac/BSD</span>
route print    <span style="color:#5C6370;"># Windows</span>

<span style="color:#5C6370;"># ARP таблица</span>
arp -a
ip neigh

<span style="color:#5C6370;"># DNS lookup</span>
nslookup google.com
dig google.com
host google.com

<span style="color:#5C6370;"># Доступность хоста</span>
ping 8.8.8.8
traceroute google.com
mtr google.com

<span style="color:#5C6370;"># Открытые порты на машине</span>
sudo ss -tulpn
sudo lsof -i -P -n | grep LISTEN

<span style="color:#5C6370;"># Открыт ли порт удалённо</span>
nc -zv example.com 443
nmap -p 80,443 example.com

<span style="color:#5C6370;"># Текущие TCP-соединения</span>
ss -t
netstat -ant</code></pre>
  </div>

  <div class="info-box success">
    <strong>Главное:</strong> сети — это не магия. Это <strong>конвейер с конвертами</strong>: приложение пишет письмо → транспорт (TCP/UDP) кладёт в пронумерованный пакет → IP делает на нём адрес → Ethernet/Wi-Fi кладёт в коробку с MAC и грузит на «грузовик». На той стороне всё распаковывается в обратном порядке. Всё остальное (router, switch, NAT, VLAN, ARP) — это вариации на тему «куда какую коробку положить и как разрулить очередь на дороге».
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
