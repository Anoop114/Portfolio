// Initialize AOS without once:true so elements re-animate on scroll back up (spatial symmetry)
!function(e){e(document).ready((function(){AOS.init({duration:400,once:!1,easing:'ease-out-cubic'})}))}(jQuery);

// Preloader: hide as soon as hero section is paintable, not waiting for full window.load
(function(){
    var div=document.createElement("div");
    div.id="preloader";
    div.className="preloader";
    div.innerHTML='<div class="black_wall"></div><div class="loader"></div>';
    document.body.insertBefore(div,document.body.firstChild);

    function hidePreloader(){
        var el=document.getElementById("preloader");
        if(el){ el.classList.add("off"); }
    }

    // Try to hide early when the hero card is visible in viewport
    if(document.querySelector('.about-me-box')){
        var obs=new IntersectionObserver(function(entries){
            if(entries[0].isIntersecting){
                obs.disconnect();
                hidePreloader();
            }
        },{threshold:0.15});
        obs.observe(document.querySelector('.about-me-box'));
    }
    // Fallback: hide on full load
    window.addEventListener('load',hidePreloader);
})();

// Scroll-driven parallax on bg images — 1:1 subtle depth
(function(){
    var bgImgs = document.querySelectorAll('.bg-img');
    if(!bgImgs.length) return;

    var ticking = false;
    function onScroll(){
        if(!ticking){
            requestAnimationFrame(function(){
                var scrollY = window.pageYOffset;
                bgImgs.forEach(function(img){
                    var card = img.closest('.shadow-box, .featured-game-card, .info-box');
                    if(!card) return;
                    var rect = card.getBoundingClientRect();
                    var centerOffset = rect.top + rect.height/2 - window.innerHeight/2;
                    // Subtle shift: 8% of the offset, capped at 20px
                    var shift = Math.max(-20, Math.min(20, centerOffset * 0.08));
                    img.style.transform = 'translateY(' + shift + 'px) scale(1.08)';
                });
                ticking = false;
            });
            ticking = true;
        }
    }

    window.addEventListener('scroll', onScroll, { passive: true });

    // Also handle back-to-top visibility
    var btn = document.getElementById('backToTopBtn');
    if(btn){
        window.addEventListener('scroll', function(){
            if(window.pageYOffset > 400){
                btn.classList.add('visible');
            } else {
                btn.classList.remove('visible');
            }
        }, { passive: true });
        btn.addEventListener('click', function(){
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
})();