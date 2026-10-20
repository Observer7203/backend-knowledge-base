/* KB: верхняя плашка (лого + поиск), переключатели темы и акцента.
   Тема применяется инлайн-скриптом в <head>, здесь — UI. */
(function () {
  'use strict';

  var KEY = 'kb-theme';
  var ACCENT_KEY = 'kb-accent';
  var root = document.documentElement;

  /* ---------- тема ---------- */
  function current() { return root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light'; }

  /* ---------- акцент: красный / синий ---------- */
  function currentAccent() { return root.getAttribute('data-accent') === 'blue' ? 'blue' : 'red'; }

  function applyAccent(accent) {
    if (accent === 'blue') root.setAttribute('data-accent', 'blue');
    else root.removeAttribute('data-accent');
    try { localStorage.setItem(ACCENT_KEY, accent); } catch (e) {}
    var btn = document.getElementById('kb-accent');
    if (btn) {
      btn.title = accent === 'blue' ? 'Красный акцент' : 'Синий акцент';
      btn.setAttribute('aria-label', btn.title);
    }
  }

  function applyTheme(theme) {
    root.setAttribute('data-theme', theme);
    try { localStorage.setItem(KEY, theme); } catch (e) {}
    var btn = document.getElementById('kb-theme');
    if (btn) {
      btn.textContent = theme === 'dark' ? '☀' : '☾';
      btn.title = theme === 'dark' ? 'Светлая тема' : 'Тёмная тема';
      btn.setAttribute('aria-label', btn.title);
    }
  }

  /* ---------- поиск по всей базе ---------- */
  var kbIndex = null;        // [{slug, title, sections:[{id,label}]}]
  var indexLoading = false;

  function currentSlug() {
    var p = location.pathname.replace(/^\/+|\/+$/g, '');
    return p || '';
  }

  function loadIndex(then) {
    if (kbIndex) { then(kbIndex); return; }
    if (indexLoading) { setTimeout(function () { loadIndex(then); }, 120); return; }
    indexLoading = true;
    fetch('/search-index.json', { credentials: 'same-origin' })
      .then(function (r) { return r.ok ? r.json() : []; })
      .catch(function () { return []; })
      .then(function (data) {
        kbIndex = Array.isArray(data) ? data : [];
        indexLoading = false;
        then(kbIndex);
      });
  }

  /* нормализация: регистр и ё/е, чтобы «ёлка» находилась по «елка» */
  function norm(s) { return (s || '').toLowerCase().replace(/ё/g, 'е'); }

  function search(query) {
    var q = norm(query).trim();
    if (q.length < 2 || !kbIndex) return [];

    var here = currentSlug();
    var hits = [];

    kbIndex.forEach(function (mod) {
      var modTitle = mod.title || mod.slug;
      var modHit = norm(modTitle).indexOf(q) !== -1;

      /* сам модуль как результат */
      if (modHit) {
        hits.push({
          kind: 'module', slug: mod.slug, title: modTitle,
          label: modTitle, sub: 'Раздел базы',
          score: norm(modTitle).indexOf(q) === 0 ? 0 : 2
        });
      }

      (mod.sections || []).forEach(function (sec) {
        var pos = norm(sec.label).indexOf(q);
        if (pos === -1) return;
        hits.push({
          kind: 'section', slug: mod.slug, id: sec.id,
          label: sec.label, sub: modTitle,
          /* разделы текущей страницы — выше, совпадение с начала — выше */
          score: (mod.slug === here ? 0 : 3) + (pos === 0 ? 0 : 1)
        });
      });
    });

    hits.sort(function (a, b) {
      return a.score - b.score || a.label.length - b.label.length;
    });
    return hits.slice(0, 12);
  }

  function openHit(hit) {
    if (hit.kind === 'module') { location.href = '/' + hit.slug; return; }
    if (hit.slug === currentSlug() && typeof window.showSection === 'function') {
      /* уже на нужной странице — просто переключаем раздел */
      var link = document.querySelector('.sidebar .nav-item[onclick*="\'' + hit.id + '\'"]');
      if (link) { link.click(); window.scrollTo({ top: 0, behavior: 'smooth' }); return; }
    }
    location.href = '/' + hit.slug + '#sec-' + hit.id;
  }

  function wireSearch(input) {
    var box = document.createElement('div');
    box.id = 'kb-suggest';
    box.setAttribute('role', 'listbox');
    /* в body, а не в плашку: у неё overflow:hidden ради скруглённых углов */
    document.body.appendChild(box);

    function place() {
      var r = input.getBoundingClientRect();
      box.style.left = r.left + 'px';
      box.style.top = (r.bottom + 8) + 'px';
      box.style.width = r.width + 'px';
    }

    var items = [], active = -1;

    function hide() { box.classList.remove('open'); active = -1; }

    function mark(text, q) {
      var i = norm(text).indexOf(norm(q));
      if (i === -1) return escapeHtml(text);
      return escapeHtml(text.slice(0, i)) + '<b>' + escapeHtml(text.slice(i, i + q.length)) +
             '</b>' + escapeHtml(text.slice(i + q.length));
    }

    function escapeHtml(s) {
      return String(s).replace(/[&<>"]/g, function (c) {
        return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c];
      });
    }

    function render(hits, q) {
      items = hits;
      if (!hits.length) {
        box.innerHTML = '<div class="kb-suggest-empty">Ничего не найдено</div>';
        place();
        box.classList.add('open');
        return;
      }
      box.innerHTML = hits.map(function (h, i) {
        return '<a class="kb-suggest-item" role="option" data-i="' + i + '" href="' +
          (h.kind === 'module' ? '/' + h.slug : '/' + h.slug + '#sec-' + h.id) + '">' +
          '<span class="kb-suggest-label">' + mark(h.label, q) + '</span>' +
          '<span class="kb-suggest-sub">' + escapeHtml(h.sub) + '</span></a>';
      }).join('');
      place();
      box.classList.add('open');
      active = -1;
    }

    function setActive(i) {
      var nodes = box.querySelectorAll('.kb-suggest-item');
      if (!nodes.length) return;
      if (i < 0) i = nodes.length - 1;
      if (i >= nodes.length) i = 0;
      active = i;
      nodes.forEach(function (n, k) { n.classList.toggle('active', k === i); });
      nodes[i].scrollIntoView({ block: 'nearest' });
    }

    function run() {
      var q = input.value.trim();
      if (q.length < 2) { hide(); return; }
      loadIndex(function () { render(search(q), q); });
    }

    input.addEventListener('input', run);
    input.addEventListener('focus', function () { if (input.value.trim().length >= 2) run(); });

    box.addEventListener('mousedown', function (e) {
      var a = e.target.closest('.kb-suggest-item');
      if (!a) return;
      e.preventDefault();
      openHit(items[+a.dataset.i]);
      hide();
    });

    input.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') { input.value = ''; hide(); input.blur(); return; }
      if (!box.classList.contains('open')) return;
      if (e.key === 'ArrowDown') { e.preventDefault(); setActive(active + 1); }
      else if (e.key === 'ArrowUp') { e.preventDefault(); setActive(active - 1); }
      else if (e.key === 'Enter') {
        var hit = items[active >= 0 ? active : 0];
        if (hit) { e.preventDefault(); openHit(hit); hide(); input.blur(); }
      }
    });

    document.addEventListener('click', function (e) {
      if (!e.target.closest('.kb-search') && !e.target.closest('#kb-suggest')) hide();
    });
    window.addEventListener('resize', function () { if (box.classList.contains('open')) place(); });
    window.addEventListener('scroll', function () { if (box.classList.contains('open')) place(); }, { passive: true });

    document.addEventListener('keydown', function (e) {
      if (e.key === '/' && document.activeElement !== input &&
          !/^(INPUT|TEXTAREA)$/.test((document.activeElement || {}).tagName || '')) {
        e.preventDefault(); input.focus();
      }
    });

    /* предзагружаем индекс, когда курсор впервые в поле */
    input.addEventListener('focus', function () { loadIndex(function () {}); }, { once: true });
  }

  function wireDrawer(burger) {
    var sidebar = document.querySelector('.sidebar');
    if (!sidebar || !burger) return;

    var backdrop = document.createElement('div');
    backdrop.id = 'kb-backdrop';
    document.body.appendChild(backdrop);

    function close() { sidebar.classList.remove('open'); backdrop.classList.remove('open'); }
    function toggle() {
      var open = sidebar.classList.toggle('open');
      backdrop.classList.toggle('open', open);
    }

    burger.addEventListener('click', toggle);
    backdrop.addEventListener('click', close);
    /* выбрали пункт — меню закрывается */
    sidebar.addEventListener('click', function (e) {
      if (e.target.closest('.nav-item, .nav-subitem, .sidebar-back')) close();
    });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') close(); });
    window.addEventListener('resize', function () { if (window.innerWidth > 900) close(); });
  }


  /* ---------- переход по ссылке вида /KB_21_NodeJS_NestJS#sec-io ---------- */
  function openFromHash() {
    var m = /^#sec-(.+)$/.exec(location.hash || '');
    if (!m) return;
    var link = document.querySelector('.sidebar .nav-item[onclick*="\'' + m[1] + '\'"]');
    if (!link) return;
    link.click();
    /* браузер прыгает к элементу с этим id, и начало раздела уходит под
       плашку. Убираем якорь и возвращаем страницу наверх — повторно после
       текущего кадра, потому что прыжок может произойти позже. */
    try { history.replaceState(null, '', location.pathname + location.search); } catch (e) {}
    window.scrollTo(0, 0);
    setTimeout(function () { window.scrollTo(0, 0); }, 0);
  }

  /* ---------- правый бар «на этой странице» ---------- */
  function buildToc() {
    var el = document.getElementById('kb-toc');
    if (!el) {
      el = document.createElement('nav');
      el.id = 'kb-toc';
      document.body.appendChild(el);
    }

    var sec = document.querySelector('.section.active') || document.querySelector('.section');
    var heads = sec ? [].slice.call(sec.querySelectorAll('.subsection-title')) : [];

    if (heads.length < 2) { el.innerHTML = ''; return; }

    var ul = document.createElement('ul');
    heads.forEach(function (h, i) {
      if (!h.id) h.id = 'kb-h-' + i;
      var a = document.createElement('a');
      a.href = '#' + h.id;
      a.textContent = (h.textContent || '').trim();
      a.addEventListener('click', function (e) {
        e.preventDefault();
        h.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
      var li = document.createElement('li');
      li.appendChild(a);
      ul.appendChild(li);
    });

    el.innerHTML = '<div class="kb-toc-label">На этой странице</div>';
    el.appendChild(ul);
    spy(heads, [].slice.call(ul.querySelectorAll('a')));
  }

  var spyHandler = null;
  function spy(heads, links) {
    if (spyHandler) window.removeEventListener('scroll', spyHandler);
    spyHandler = function () {
      var best = 0;
      for (var i = 0; i < heads.length; i++) {
        if (heads[i].getBoundingClientRect().top <= 140) best = i;
      }
      links.forEach(function (a, i) { a.classList.toggle('active', i === best); });
    };
    window.addEventListener('scroll', spyHandler, { passive: true });
    spyHandler();
  }

  /* перестраивать при смене раздела */
  function watchSections() {
    var prev = window.showSection;
    if (typeof prev === 'function') {
      window.showSection = function () {
        var r = prev.apply(this, arguments);
        setTimeout(buildToc, 30);
        return r;
      };
    }
  }

  /* ---------- липкий баннер на главной ---------- */
  function heroSticky() {
    var stage = document.querySelector('.kb-hero-stage');
    if (!stage) return;
    var inner = stage.querySelector('.kb-hero-inner');
    if (!inner) return;
    if (window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    var lava = stage.querySelector('.kb-lava');
    var hint = stage.querySelector('.kb-scroll-hint');
    var ticking = false;

    function update() {
      ticking = false;
      var total = stage.offsetHeight - window.innerHeight;
      if (total <= 0) return;
      var p = -stage.getBoundingClientRect().top / total;
      p = p < 0 ? 0 : (p > 1 ? 1 : p);

      /* содержимое уходит в первые две трети прокрутки баннера */
      var f = p / 0.65; if (f > 1) f = 1;
      inner.style.opacity = String(1 - f);
      inner.style.transform = 'translateY(' + (-f * 56).toFixed(1) + 'px) scale(' + (1 - f * 0.05).toFixed(3) + ')';

      if (hint) hint.style.opacity = String(1 - (p > 0.15 ? 1 : p / 0.15));
      if (lava) lava.style.transform = 'scale(' + (1 + p * 0.22).toFixed(3) + ')';
    }

    window.addEventListener('scroll', function () {
      if (!ticking) { ticking = true; requestAnimationFrame(update); }
    }, { passive: true });
    window.addEventListener('resize', update);
    update();
  }

  /* ---------- появление блоков при скролле ---------- */
  function revealOnScroll() {
    var targets = [].slice.call(document.querySelectorAll('.hub .card, .hub .stat, .hub .feature, .hub .section-title, .hub .method, .hub .academic, .hub .inst'));
    if (!targets.length) return;
    if (!('IntersectionObserver' in window)) return;

    targets.forEach(function (el, i) {
      el.classList.add('kb-reveal');
      el.style.transitionDelay = (i % 6) * 55 + 'ms';
    });

    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('kb-in'); io.unobserve(e.target); }
      });
    }, { rootMargin: '0px 0px -8% 0px', threshold: .06 });

    targets.forEach(function (el) { io.observe(el); });
  }

  /* ---------- сборка плашки ---------- */
  function mount() {
    if (document.getElementById('kb-topbar')) return;

    var title = (document.querySelector('.sidebar-title') || {}).textContent ||
                (document.querySelector('.page-header h1') || {}).textContent || 'Knowledge Base';

    var bar = document.createElement('header');
    bar.id = 'kb-topbar';
    bar.innerHTML =
      '<a class="kb-brand" href="/">' +
        '<span class="kb-logo">' +
          '<img src="/img/logo-mark-96.png" alt="" class="kb-logo-light" width="34" height="34">' +
          '<img src="/img/logo-mark-dark-96.png" alt="" class="kb-logo-dark" width="34" height="34">' +
        '</span>' +
        '<span class="kb-brand-text"></span>' +
      '</a>' +
      '<div class="kb-search">' +
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" ' +
             'stroke-linecap="round"><circle cx="11" cy="11" r="7"></circle>' +
             '<path d="M21 21l-4.3-4.3"></path></svg>' +
        '<input type="search" id="kb-search-input" placeholder="Поиск по разделу" ' +
               'autocomplete="off" spellcheck="false">' +
        '<kbd>/</kbd>' +
      '</div>' +
      '<button id="kb-accent" type="button"><span class="kb-dot"></span></button>' +
      '<button id="kb-theme" type="button"></button>' +
      '<button id="kb-burger" type="button" aria-label="Меню">' +
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" ' +
             'stroke-linecap="round"><path d="M3 6h18M3 12h18M3 18h18"/></svg>' +
      '</button>';

    bar.querySelector('.kb-brand-text').textContent = title.trim();
    document.body.insertBefore(bar, document.body.firstChild);
    document.body.classList.add('kb-has-topbar');

    bar.querySelector('#kb-theme').addEventListener('click', function () {
      applyTheme(current() === 'dark' ? 'light' : 'dark');
    });

    bar.querySelector('#kb-accent').addEventListener('click', function () {
      applyAccent(currentAccent() === 'blue' ? 'red' : 'blue');
    });

    wireDrawer(bar.querySelector('#kb-burger'));
    buildToc();
    watchSections();
    revealOnScroll();
    heroSticky();
    wireSearch(bar.querySelector('#kb-search-input'));
    openFromHash();
    applyTheme(current());
    applyAccent(currentAccent());
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', mount);
  } else { mount(); }
})();
