// Smooth mobile nav toggle — interruptible, cancels in-progress transitions on re-tap
(function () {
    'use strict';
    var menuBtn = document.getElementById('navbarClose');
    var navbar = document.querySelector('.header-area .navbar');

    if (!menuBtn || !navbar) return;

    function toggleMenu() {
        // Cancel any in-progress CSS transition by forcing the current rendered state
        // before toggling, so the new animation starts from the live on-screen value
        var computed = getComputedStyle(navbar);
        navbar.style.transition = 'none';
        navbar.offsetHeight; // force reflow to apply the above
        navbar.classList.toggle('active');
        menuBtn.classList.toggle('active');
        // Restore transition for the next toggle
        requestAnimationFrame(function () {
            navbar.style.transition = '';
        });
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
