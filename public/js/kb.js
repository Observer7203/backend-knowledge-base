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

  /* ---------- поиск по навигации текущей страницы ---------- */
  function wireSearch(input) {
    var items = [].slice.call(document.querySelectorAll('.sidebar .nav-item, .sidebar .nav-subitem'));
    var labels = [].slice.call(document.querySelectorAll('.sidebar .nav-group-label'));
    var groups = [].slice.call(document.querySelectorAll('.sidebar .nav-subgroup'));

    function reset() {
      items.forEach(function (el) { el.style.display = ''; });
      labels.forEach(function (el) { el.style.display = ''; });
      groups.forEach(function (el) { el.style.display = ''; });
    }

    function filter(q) {
      q = q.trim().toLowerCase();
      if (!q) { reset(); return; }

      items.forEach(function (el) {
        var hit = (el.textContent || '').toLowerCase().indexOf(q) !== -1;
        el.style.display = hit ? '' : 'none';
      });

      /* подгруппа скрывается, если в ней не осталось видимых подпунктов */
      groups.forEach(function (g) {
        var any = [].slice.call(g.querySelectorAll('.nav-subitem'))
          .some(function (el) { return el.style.display !== 'none'; });
        g.style.display = any ? 'block' : 'none';
        if (any) g.classList.add('open');
      });

      /* заголовок группы — если ничего видимого до следующего заголовка */
      labels.forEach(function (lab) {
        var any = false, n = lab.nextElementSibling;
        while (n && !n.classList.contains('nav-group-label')) {
          if ((n.classList.contains('nav-item') || n.classList.contains('nav-subgroup')) &&
              n.style.display !== 'none') { any = true; break; }
          n = n.nextElementSibling;
        }
        lab.style.display = any ? '' : 'none';
      });
    }

    input.addEventListener('input', function () { filter(input.value); });
    input.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') { input.value = ''; filter(''); input.blur(); }
      if (e.key === 'Enter') {
        var first = items.filter(function (el) { return el.style.display !== 'none'; })[0];
        if (first) { first.click(); input.blur(); }
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === '/' && document.activeElement !== input &&
          !/^(INPUT|TEXTAREA)$/.test((document.activeElement || {}).tagName || '')) {
        e.preventDefault(); input.focus();
      }
    });
  }

  /* ---------- выездное меню на мобильных ---------- */
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
        '<span class="kb-logo">KB</span>' +
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
    wireSearch(bar.querySelector('#kb-search-input'));
    applyTheme(current());
    applyAccent(currentAccent());
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', mount);
  } else { mount(); }
})();
