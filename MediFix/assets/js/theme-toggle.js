// MediFix Theme Toggle - Light/Dark Mode
(function() {
  'use strict';

  // Load saved theme or default to dark
  var savedTheme = localStorage.getItem('medifix-theme') || 'dark';
  document.documentElement.setAttribute('data-theme', savedTheme);

  // Apply theme after DOM is ready
  document.addEventListener('DOMContentLoaded', function() {
    applyTheme(savedTheme);

    // Bind toggle buttons
    var toggleBtns = document.querySelectorAll('.theme-toggle-btn');
    toggleBtns.forEach(function(btn) {
      btn.addEventListener('click', function() {
        var current = document.documentElement.getAttribute('data-theme');
        var next = current === 'light' ? 'dark' : 'light';
        document.documentElement.setAttribute('data-theme', next);
        localStorage.setItem('medifix-theme', next);
        applyTheme(next);
        updateToggleIcons(next);
      });
    });
  });

  function applyTheme(theme) {
    updateToggleIcons(theme);
  }

  function updateToggleIcons(theme) {
    var toggleBtns = document.querySelectorAll('.theme-toggle-btn');
    toggleBtns.forEach(function(btn) {
      if (theme === 'light') {
        btn.innerHTML = '<i class="ti ti-moon"></i>';
        btn.title = 'Switch to Dark Mode';
      } else {
        btn.innerHTML = '<i class="ti ti-sun"></i>';
        btn.title = 'Switch to Light Mode';
      }
    });
  }

  // Apply theme immediately (before DOM ready) to prevent flash
  var currentTheme = document.documentElement.getAttribute('data-theme');
  if (currentTheme) {
    // Already set from localStorage above
  }
})();
