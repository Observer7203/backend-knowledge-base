/* Переключатель темы KB. Тема применяется инлайн-скриптом в <head>,
   здесь только кнопка и переключение. */
(function () {
  'use strict';

  var KEY = 'kb-theme';
  var root = document.documentElement;

  function current() { return root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light'; }

  function apply(theme) {
    root.setAttribute('data-theme', theme);
    try { localStorage.setItem(KEY, theme); } catch (e) { /* приватный режим */ }
    var btn = document.getElementById('kb-theme');
    if (btn) {
      btn.textContent = theme === 'dark' ? '☀' : '☾';
      btn.title = theme === 'dark' ? 'Светлая тема' : 'Тёмная тема';
      btn.setAttribute('aria-label', btn.title);
    }
  }

  function mount() {
    if (document.getElementById('kb-theme')) return;
    var btn = document.createElement('button');
    btn.id = 'kb-theme';
    btn.type = 'button';
    btn.addEventListener('click', function () {
      apply(current() === 'dark' ? 'light' : 'dark');
    });
    document.body.appendChild(btn);
    apply(current());
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', mount);
  } else {
    mount();
  }
})();
