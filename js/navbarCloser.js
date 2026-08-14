// Smooth mobile nav toggle — only closes when a nav link is clicked, not on every scroll
(function () {
    'use strict';
    var menuBtn = document.getElementById('navbarClose');
    var navbar = document.querySelector('.header-area .navbar');

    if (!menuBtn || !navbar) return;

    function toggleMenu() {
        menuBtn.classList.toggle('active');
        navbar.classList.toggle('active');
    }

    menuBtn.addEventListener('click', toggleMenu);

    // Close menu when any nav link is tapped
    navbar.querySelectorAll('.menu a').forEach(function (link) {
        link.addEventListener('click', function () {
            menuBtn.classList.remove('active');
            navbar.classList.remove('active');
        });
    });
})();
