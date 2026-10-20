/* KB: верхняя плашка (лого + поиск), переключатель темы.
   Тема применяется инлайн-скриптом в <head>, здесь — UI. */
(function () {
  'use strict';

  var KEY = 'kb-theme';
  var root = document.documentElement;

  /* ---------- тема ---------- */
  function current() { return root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light'; }

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
      '<button id="kb-theme" type="button"></button>';

    bar.querySelector('.kb-brand-text').textContent = title.trim();
    document.body.insertBefore(bar, document.body.firstChild);
    document.body.classList.add('kb-has-topbar');

    bar.querySelector('#kb-theme').addEventListener('click', function () {
      applyTheme(current() === 'dark' ? 'light' : 'dark');
    });

    wireSearch(bar.querySelector('#kb-search-input'));
    applyTheme(current());
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', mount);
  } else { mount(); }
})();
