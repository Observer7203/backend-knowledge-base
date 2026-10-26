@verbatim
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Programming Knowledge Base</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --bg:       #F5F8FA;
    --surface:  #FFFFFF;
    --surface2: #F9FAFB;
    --border:   #E4E6EF;
    --text:     #181C32;
    --text2:    #7E8299;
    --text3:    #A1A5B7;

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
    --teal:          #009EF7;
    --teal-light:    #EEF7FF;
    --orange:        #E65100;
    --orange-light:  #FFF3E0;

    --shadow:       0 2px 10px rgba(24,28,50,0.07);
    --shadow-hover: 0 8px 28px rgba(24,28,50,0.13);
    --radius:       12px;
  }

  * { margin:0; padding:0; box-sizing:border-box; }

  body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    font-size: 14px;
    line-height: 1.5;
    -webkit-font-smoothing: antialiased;
  }

  .hub { max-width: 1100px; margin: 0 auto; padding: 40px 24px 60px; }

  /* ── Header ─────────────────────────────────────────── */
  .header {
    text-align: center;
    padding: 52px 40px 48px;
    margin-bottom: 32px;
    background: var(--surface);
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
  }
  .header-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--primary-light);
    color: var(--primary);
    border-radius: 20px;
    padding: 5px 14px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.6px;
    text-transform: uppercase;
    margin-bottom: 18px;
  }
  .header-badge svg { width: 13px; height: 13px; }
  .header h1 {
    font-size: 2.3rem;
    font-weight: 800;
    margin-bottom: 14px;
    color: var(--text);
    letter-spacing: -0.5px;
    line-height: 1.2;
  }
  .header h1 span { color: var(--primary); }
  .header p {
    color: var(--text2);
    font-size: 0.95rem;
    line-height: 1.75;
    max-width: 560px;
    margin: 0 auto;
  }

  /* ── Stats ───────────────────────────────────────────── */
  .stats-row {
    display: flex;
    gap: 10px;
    justify-content: center;
    margin-bottom: 36px;
    flex-wrap: wrap;
  }
  .stat {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 14px 22px;
    text-align: center;
    box-shadow: var(--shadow);
    min-width: 88px;
    transition: box-shadow 0.2s;
  }
  .stat:hover { box-shadow: var(--shadow-hover); }
  .stat .n {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--primary);
    line-height: 1;
    margin-bottom: 5px;
    display: block;
  }
  .stat .l {
    color: var(--text3);
    font-size: 0.68rem;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    font-weight: 600;
  }

  /* ── Section title ───────────────────────────────────── */
  .section-title {
    font-size: 1.05rem;
    font-weight: 700;
    margin: 0 0 16px;
    color: var(--text);
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .section-title::before {
    content: '';
    width: 3px;
    height: 18px;
    background: var(--primary);
    border-radius: 2px;
    flex-shrink: 0;
  }

  /* ── Module Cards ────────────────────────────────────── */
  .grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 14px;
    margin-bottom: 40px;
  }
  .card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 22px 22px 20px;
    text-decoration: none;
    color: var(--text);
    transition: all 0.22s ease;
    position: relative;
    box-shadow: var(--shadow);
    display: block;
  }
  .card:hover {
    transform: translateY(-3px);
    border-color: var(--primary);
    box-shadow: var(--shadow-hover);
  }
  .card-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 14px;
  }
  .card-icon svg { width: 21px; height: 21px; stroke-width: 1.8; }
  .card h3 { font-size: 0.97rem; font-weight: 700; margin-bottom: 7px; color: var(--text); }
  .card p  { color: var(--text2); font-size: 0.83rem; line-height: 1.65; }
  .card .badge {
    position: absolute;
    top: 14px;
    right: 14px;
    padding: 3px 9px;
    border-radius: 6px;
    font-size: 0.67rem;
    font-weight: 700;
    letter-spacing: 0.4px;
  }

  /* icon colour variants — neutral */
  .ic-purple, .ic-blue, .ic-teal, .ic-orange, .ic-danger, .ic-warning, .ic-success {
    background: #EFF2F5;
    color: #7E8299;
  }

  /* badge colour variants — neutral */
  .badge-program, .badge-php, .badge-sql, .badge-laravel, .badge-security, .badge-arch, .badge-devops {
    background: #EFF2F5;
    color: #5E6278;
  }

  /* ── Methodology ─────────────────────────────────────── */
  .intro-text {
    color: var(--text2);
    font-size: 0.87rem;
    margin-bottom: 14px;
    line-height: 1.7;
  }

  .method {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px 22px;
    margin-bottom: 10px;
    box-shadow: var(--shadow);
    display: flex;
    gap: 16px;
    align-items: flex-start;
    transition: border-color 0.2s;
  }
  .method:hover { border-color: var(--primary); }
  .method-icon {
    width: 40px;
    height: 40px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .method-icon svg { width: 19px; height: 19px; stroke-width: 1.8; }
  .method h4 { font-size: 0.92rem; font-weight: 700; margin-bottom: 3px; color: var(--text); }
  .method .source { color: var(--primary); font-size: 0.76rem; font-weight: 600; margin-bottom: 6px; }
  .method p { color: var(--text2); font-size: 0.83rem; line-height: 1.65; }
  .method .tag {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 5px;
    font-size: 0.68rem;
    font-weight: 700;
    margin-top: 9px;
    letter-spacing: 0.3px;
  }
  .tag-research, .tag-practice { background: #EFF2F5; color: #7E8299; }

  /* ── Academic sources ────────────────────────────────── */
  .academic {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 16px 20px;
    margin-bottom: 10px;
    display: flex;
    gap: 14px;
    align-items: flex-start;
    box-shadow: var(--shadow);
    transition: border-color 0.2s;
  }
  .academic:hover { border-color: var(--primary); }
  .acad-icon {
    width: 38px;
    height: 38px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .acad-icon svg { width: 18px; height: 18px; stroke-width: 1.8; }
  .academic h4 { font-size: 0.9rem; font-weight: 700; margin-bottom: 3px; color: var(--text); }
  .academic .inst { color: var(--text2); font-size: 0.76rem; font-weight: 600; margin-bottom: 4px; }
  .academic p { color: var(--text2); font-size: 0.81rem; line-height: 1.55; }
  .academic a {
    color: var(--primary);
    font-size: 0.79rem;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    margin-top: 4px;
  }
  .academic a:hover { text-decoration: underline; }
  .academic a svg { width: 11px; height: 11px; }

  /* ── Footer ──────────────────────────────────────────── */
  .footer {
    text-align: center;
    margin-top: 50px;
    padding: 20px;
    color: var(--text3);
    font-size: 0.76rem;
    border-top: 1px solid var(--border);
    line-height: 1.8;
  }

  @media (max-width: 768px) {
    .grid { grid-template-columns: 1fr; }
    .header { padding: 36px 20px 32px; }
    .header h1 { font-size: 1.65rem; }
    .hub { padding: 20px 16px 40px; }
    .stats-row { gap: 8px; }
    .stat { padding: 12px 16px; }
  }
</style>
<link rel="stylesheet" href="/css/kb.css">
<script>(function(){try{var d=document.documentElement;var t=localStorage.getItem('kb-theme')||(window.matchMedia&&matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light');d.setAttribute('data-theme',t);if(localStorage.getItem('kb-accent')==='blue')d.setAttribute('data-accent','blue');}catch(e){}})();</script>
<script src="/js/kb.js" defer></script>
</head>
<body>
<div class="kb-hero-stage">
<section class="kb-hero">
  <div class="kb-lava" aria-hidden="true">
    <span class="blob b1"></span><span class="blob b2"></span>
    <span class="blob b3"></span><span class="blob b4"></span>
  </div>
  <div class="kb-hero-inner">
    <div class="header-badge kb-rise" style="--d:0ms">
      <i data-lucide="zap"></i>
      Knowledge Base
    </div>
    <h1 class="kb-rise" style="--d:90ms">Programming <span>Knowledge Base</span></h1>
    <p class="kb-rise" style="--d:180ms">A complete knowledge base built on the methods behind Laracasts, Harvard CS50, Bloom&rsquo;s taxonomy and spaced repetition. Academic sources: MIT OCW, Stanford, OWASP, RFC.</p>
    <div class="kb-hero-actions kb-rise" style="--d:270ms">
      <a class="kb-btn kb-btn-primary" href="#modules">Open the modules</a>
      <a class="kb-btn" href="#method">Method</a>
    </div>
  </div>
  <a class="kb-scroll-hint" href="#modules" aria-label="Scroll down"><span></span></a>
</section>
</div>

<div class="hub">

  <!-- ── Stats ── -->
  <!-- Figures are recounted from the published modules. -->
  <div class="stats-row">
    <div class="stat"><span class="n">19</span><span class="l">Modules</span></div>
    <div class="stat"><span class="n">399</span><span class="l">Sections</span></div>
    <div class="stat"><span class="n">1805</span><span class="l">Topics</span></div>
    <div class="stat"><span class="n">1600</span><span class="l">Code examples</span></div>
    <div class="stat"><span class="n">434</span><span class="l">Tables</span></div>
  </div>

  <!-- ── How this base is organised ── -->
  <div class="section-title" id="features">How this base is organised</div>
  <div class="feature-grid">
    <div class="feature">
      <div class="feature-icon"><i data-lucide="layers"></i></div>
      <h3>Split into modules</h3>
      <p>Nineteen modules, from PHP fundamentals to Node.js and React. Each one has its own sidebar, so you can come back to a single topic instead of scrolling through everything.</p>
    </div>
    <div class="feature">
      <div class="feature-icon"><i data-lucide="code-2"></i></div>
      <h3>Code, not paraphrase</h3>
      <p>1,600 examples. Every one is a working snippet with comments that explain what happens underneath, rather than pseudocode and generalities.</p>
    </div>
    <div class="feature">
      <div class="feature-icon"><i data-lucide="alert-triangle"></i></div>
      <h3>Pitfalls</h3>
      <p>Every topic carries its own block of common mistakes and misconceptions. What people actually trip over is stated outright instead of being buried in the prose.</p>
    </div>
    <div class="feature">
      <div class="feature-icon"><i data-lucide="table-2"></i></div>
      <h3>Comparison tables</h3>
      <p>434 tables answering what to choose and when. Binding types in the container, isolation levels, index formats: side by side in one place, not scattered across articles.</p>
    </div>
    <div class="feature">
      <div class="feature-icon"><i data-lucide="help-circle"></i></div>
      <h3>Questions to check yourself</h3>
      <p>Question sets graded from junior-plus to senior. Answer out loud, then check against the section: that is how you tell what you understand from what you merely recognise.</p>
    </div>
    <div class="feature">
      <div class="feature-icon"><i data-lucide="search"></i></div>
      <h3>Search and dark theme</h3>
      <p>Press <code>/</code> to open search. The theme toggles from the top bar and is remembered. On a phone the navigation folds into a slide-out panel.</p>
    </div>
  </div>

  @endverbatim
  @php
      $modulePages       = ($pagesByGroup['Modules'] ?? collect());
      $additionalPages   = ($pagesByGroup['Дополнительно'] ?? collect());
      $advancedPages     = ($pagesByGroup['Advanced'] ?? collect());
  @endphp

  {{-- ── Modules ── --}}
  @if($modulePages->isNotEmpty())
    <div class="section-title" id="modules">Knowledge Base — Modules</div>
    <div class="grid">
      @foreach($modulePages as $page)
        <a class="card" href="{{ url('/en/' . $page->slug) }}">
          <div class="badge {{ $page->badge_class ?? 'badge-program' }}">{{ $page->badge }}</div>
          <div class="card-icon {{ $page->icon_class ?? 'ic-purple' }}"><i data-lucide="{{ $page->icon }}"></i></div>
          @php $tr = trans('kb.modules', [], 'en')[$page->slug] ?? null; @endphp
          <h3>{!! $tr['title'] ?? $page->title !!}</h3>
          <p>{!! $tr['description'] ?? e($page->description) !!}</p>
        </a>
      @endforeach
    </div>
  @endif

  {{-- ── Supplementary ── --}}
  @if($additionalPages->isNotEmpty())
    <div class="section-title" style="margin-top:40px;">Supplementary</div>
    <div class="grid">
      @foreach($additionalPages as $page)
        <a class="card" href="{{ url('/en/' . $page->slug) }}">
          <div class="badge {{ $page->badge_class ?? 'badge-program' }}">{{ $page->badge }}</div>
          <div class="card-icon {{ $page->icon_class ?? 'ic-purple' }}"><i data-lucide="{{ $page->icon }}"></i></div>
          @php $tr = trans('kb.modules', [], 'en')[$page->slug] ?? null; @endphp
          <h3>{!! $tr['title'] ?? $page->title !!}</h3>
          <p>{!! $tr['description'] ?? e($page->description) !!}</p>
        </a>
      @endforeach
    </div>
  @endif

  {{-- ── Advanced ── --}}
  @if($advancedPages->isNotEmpty())
    <div class="section-title" style="margin-top:40px;">Advanced (middle/senior)</div>
    <div class="grid">
      @foreach($advancedPages as $page)
        <a class="card" href="{{ url('/en/' . $page->slug) }}">
          <div class="badge {{ $page->badge_class ?? 'badge-program' }}">{{ $page->badge }}</div>
          <div class="card-icon {{ $page->icon_class ?? 'ic-purple' }}"><i data-lucide="{{ $page->icon }}"></i></div>
          @php $tr = trans('kb.modules', [], 'en')[$page->slug] ?? null; @endphp
          <h3>{!! $tr['title'] ?? $page->title !!}</h3>
          <p>{!! $tr['description'] ?? e($page->description) !!}</p>
        </a>
      @endforeach
    </div>
  @endif
  @verbatim

  <!-- ── Methodology ── -->
  <div class="section-title" id="method">How the material is taught</div>
  <p class="intro-text">Every module is built on evidence-based methods for teaching programming, the same ones the best courses in the world rely on:</p>

  <div class="method">
    <div class="method-icon ic-purple"><i data-lucide="brain"></i></div>
    <div>
      <h4>1. Bloom&rsquo;s taxonomy</h4>
      <div class="source">Grand Canyon University · The foundation of CS pedagogy</div>
      <p>Every topic is structured by level: <strong>remember</strong> (definitions) → <strong>understand</strong> (explain it in your own words) → <strong>apply</strong> (write the code) → <strong>analyse</strong> (compare the approaches) → <strong>create</strong> (build your own project). The same model MIT and Stanford use in their computer science courses.</p>
      <span class="tag tag-research">Academic standard</span>
    </div>
  </div>

  <div class="method">
    <div class="method-icon ic-teal"><i data-lucide="eye"></i></div>
    <div>
      <h4>2. Active recall</h4>
      <div class="source">Research: 13% forgotten, against 50% with passive reading</div>
      <p>Every section carries a “check yourself” block with the answer hidden. You attempt it first, then compare. That is three to four times more effective than rereading notes, and it is what Codecademy and freeCodeCamp are built on.</p>
      <span class="tag tag-research">Backed by research</span>
    </div>
  </div>

  <div class="method">
    <div class="method-icon ic-blue"><i data-lucide="repeat-2"></i></div>
    <div>
      <h4>3. Spaced repetition</h4>
      <div class="source">Derek Sivers: 87% retention against 50% from cramming · 5–10 min a day</div>
      <p>The sixteen-week schedule in the roadmap module is built on widening intervals: a topic comes back after one day, three days, seven and fourteen. The same principle Anki and SuperMemo use. Turn the “worth remembering” blocks into Anki cards.</p>
      <span class="tag tag-practice">Laracasts + Anki</span>
    </div>
  </div>

  <div class="method">
    <div class="method-icon ic-warning"><i data-lucide="hammer"></i></div>
    <div>
      <h4>4. Project-based learning</h4>
      <div class="source">Frontiers in Education, 2025 · Laracasts · freeCodeCamp</div>
      <p>Every section ends with something to build. You write real features: a payment flow, API authentication, a Docker deployment. The research shows it lifts motivation and carries knowledge over into real projects.</p>
      <span class="tag tag-practice">Proven to work</span>
    </div>
  </div>

  <div class="method">
    <div class="method-icon ic-orange"><i data-lucide="play-circle"></i></div>
    <div>
      <h4>5. The Laracasts method: bite-sized modules</h4>
      <div class="source">Jeffrey Way · 200+ courses · the finest Laravel teacher</div>
      <p>Sections are short and narrow: one pattern per module. Not walls of text but tight blocks — definition, code, the key fact, a quiz. That is how the mind takes information in, a portion at a time, without being swamped.</p>
      <span class="tag tag-practice">The Laracasts method</span>
    </div>
  </div>

  <div class="method">
    <div class="method-icon ic-success"><i data-lucide="git-compare"></i></div>
    <div>
      <h4>6. BAD/GOOD Code Comparison</h4>
      <div class="source">Clean Code · Robert C. Martin</div>
      <p>In the architecture module every pattern is shown twice: first the anti-pattern, then the pattern. Learning by contrast is what makes it clear <em>why</em> a pattern exists, not merely how to type it out.</p>
      <span class="tag tag-practice">The Clean Code method</span>
    </div>
  </div>

  <!-- ── Academic sources ── -->
  <div class="section-title">Academic and accredited sources</div>
  <p class="intro-text">The material in this base rests on the following authoritative sources:</p>

  <div class="academic">
    <div class="acad-icon ic-blue"><i data-lucide="graduation-cap"></i></div>
    <div>
      <h4>Harvard CS50's Web Programming</h4>
      <div class="inst">Harvard University · edX</div>
      <p>Python, JavaScript, SQL, Django, React, security, scalability. One of the best free computer science courses anywhere.</p>
      <a href="https://cs50.harvard.edu/web/" target="_blank">cs50.harvard.edu/web <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-blue"><i data-lucide="graduation-cap"></i></div>
    <div>
      <h4>MIT OpenCourseWare — Software Engineering for Web Applications</h4>
      <div class="inst">Massachusetts Institute of Technology</div>
      <p>The architecture of dependable internet applications. Free lectures and materials from MIT.</p>
      <a href="https://ocw.mit.edu/" target="_blank">ocw.mit.edu <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-blue"><i data-lucide="graduation-cap"></i></div>
    <div>
      <h4>Stanford — Databases (Prof. Jennifer Widom)</h4>
      <div class="inst">Stanford University</div>
      <p>Five self-paced courses: relational databases, SQL, advanced SQL, modelling and theory. The academic standard for databases.</p>
      <a href="https://online.stanford.edu/courses/soe-ydatabases" target="_blank">online.stanford.edu <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-purple"><i data-lucide="book-open"></i></div>
    <div>
      <h4>Database System Concepts (7th ed.)</h4>
      <div class="inst">Silberschatz, Korth, Sudarshan · Academic Textbook</div>
      <p>The standard university textbook on databases. SQL, transactions, normalisation, distributed databases.</p>
      <a href="https://www.db-book.com/" target="_blank">db-book.com <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-purple"><i data-lucide="book-open"></i></div>
    <div>
      <h4>Design Patterns — Gang of Four</h4>
      <div class="inst">Gamma, Helm, Johnson, Vlissides · 500K+ copies</div>
      <p>The 23 foundational design patterns, creational, structural and behavioural. The basis of the architecture module.</p>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-purple"><i data-lucide="book-open"></i></div>
    <div>
      <h4>Clean Code &amp; Clean Architecture</h4>
      <div class="inst">Robert C. Martin ("Uncle Bob")</div>
      <p>The industry standard for code quality and architecture: SOLID principles, layered architecture, the dependency rule.</p>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-danger"><i data-lucide="shield"></i></div>
    <div>
      <h4>OWASP Cheat Sheets</h4>
      <div class="inst">Open Web Application Security Project · A non-profit organisation</div>
      <p>The authoritative source on web security: CSRF, XSS, SQL injection, authentication. Everything the security module draws on.</p>
      <a href="https://cheatsheetseries.owasp.org/" target="_blank">cheatsheetseries.owasp.org <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-teal"><i data-lucide="scroll-text"></i></div>
    <div>
      <h4>RFC Documents (IETF)</h4>
      <div class="inst">Internet Engineering Task Force · Internet standards</div>
      <p>RFC 6749 (OAuth 2.0), RFC 7519 (JWT) and RFC 7636 (PKCE): the primary sources for these security protocols.</p>
      <a href="https://datatracker.ietf.org/" target="_blank">datatracker.ietf.org <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-warning"><i data-lucide="award"></i></div>
    <div>
      <h4>Zend Certified PHP Engineer</h4>
      <div class="inst">Zend Technologies · Pearson VUE</div>
      <p>Industry certification for PHP, current through 8.4. Written by PHP core contributors. Over 4,000 testing centres.</p>
      <a href="https://www.zend.com/training/php-certification-exam" target="_blank">zend.com <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-success"><i data-lucide="building-2"></i></div>
    <div>
      <h4>ITMO University — Backend Developer</h4>
      <div class="inst">Saint Petersburg National Research University of Information Technologies</div>
      <p>A professional retraining programme in PHP, MySQL and web technologies, from an accredited Russian university.</p>
      <a href="https://profi.ifmo.ru/backend-developer/" target="_blank">profi.ifmo.ru <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <div class="academic">
    <div class="acad-icon ic-success"><i data-lucide="building-2"></i></div>
    <div>
      <h4>MIPT — IT Product Development (online master’s)</h4>
      <div class="inst">Moscow Institute of Physics and Technology</div>
      <p>An online master’s: half of it practical, building real applications. One of Russia’s leading universities for computer science.</p>
      <a href="https://mipt.online/masters/development" target="_blank">mipt.online <i data-lucide="external-link"></i></a>
    </div>
  </div>

  <!-- ── Footer ── -->
  <div class="footer">
    Built with proven pedagogical methods · Last updated: April 2026<br>
    Sources: Harvard, MIT, Stanford, OWASP, IETF RFC, Laracasts, Frontiers in Education
  </div>

</div>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>lucide.createIcons();</script>
</body>
</html>

@endverbatim