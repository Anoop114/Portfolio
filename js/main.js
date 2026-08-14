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

// Scroll-driven parallax on bg images - 1:1 subtle depth
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

    // ── Back to Top Button & Dori Mutual Exclusivity ──
    var btn = document.getElementById('backToTopBtn');
    var doriWrapper = document.getElementById('doriWrapper');
    var lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
    var hideTopBtnTimer = null;

    function showBackToTop() {
        if (btn) btn.classList.add('visible');
        if (doriWrapper) doriWrapper.classList.add('dori-hidden');
    }

    function hideBackToTop() {
        if (btn) btn.classList.remove('visible');
        if (doriWrapper) doriWrapper.classList.remove('dori-hidden');
    }

    function scheduleHideTopBtn() {
        if (hideTopBtnTimer) clearTimeout(hideTopBtnTimer);
        hideTopBtnTimer = setTimeout(function() {
            hideBackToTop();
        }, 2000);
    }

    if (btn) {
        window.addEventListener('scroll', function() {
            var currentScrollY = window.pageYOffset || document.documentElement.scrollTop;

            // When near top (<= 200px), always hide backToTopBtn and show Dori
            if (currentScrollY <= 200) {
                if (hideTopBtnTimer) clearTimeout(hideTopBtnTimer);
                hideBackToTop();
                lastScrollY = currentScrollY;
                return;
            }

            // Only activate backToTopBtn when scrolling down
            if (currentScrollY > lastScrollY) {
                showBackToTop();
                scheduleHideTopBtn();
            }

            lastScrollY = currentScrollY;
        }, { passive: true });

        btn.addEventListener('click', function() {
            if (hideTopBtnTimer) clearTimeout(hideTopBtnTimer);
            hideBackToTop();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
})();

// ── Dori AI Assistant (Chatling AI Integration) ──
(function(){
    var wrapper     = document.getElementById('doriWrapper');
    var videoWrap   = document.getElementById('doriVideoWrap');
    var video       = document.getElementById('doriVideo');
    var headerBar   = document.getElementById('doriChatHeaderBar');
    var bottomBar   = document.getElementById('doriChatBottomBar');
    var borderFrame = document.getElementById('doriChatBorderFrame');
    var chatX       = document.getElementById('doriChatX');
    if (!wrapper) return;

    var chatOpen = false;
    var scrollStartY = 0;

    function getChatIframe() {
        return document.getElementById('chtl-chat-iframe');
    }

    function enforceChatBounds() {
        var iframe = getChatIframe();
        if (!iframe) return;
        var isMobile = window.innerWidth <= 768;
        if (isMobile) {
            iframe.style.setProperty('position', 'fixed', 'important');
            iframe.style.setProperty('top', 'auto', 'important');
            iframe.style.setProperty('left', '10px', 'important');
            iframe.style.setProperty('right', '10px', 'important');
            iframe.style.setProperty('bottom', '90px', 'important');
            iframe.style.setProperty('width', 'calc(100vw - 20px)', 'important');
            iframe.style.setProperty('max-width', '400px', 'important');
            iframe.style.setProperty('height', '406px', 'important');
            iframe.style.setProperty('max-height', '60vh', 'important');
            iframe.style.setProperty('border-radius', '20px', 'important');
            iframe.style.setProperty('border', 'none', 'important');
            iframe.style.setProperty('margin', '0 auto', 'important');
            iframe.style.setProperty('box-shadow', 'none', 'important');
        } else {
            iframe.style.setProperty('position', 'fixed', 'important');
            iframe.style.setProperty('top', 'auto', 'important');
            iframe.style.setProperty('left', 'auto', 'important');
            iframe.style.setProperty('right', '20px', 'important');
            iframe.style.setProperty('bottom', '140px', 'important');
            iframe.style.setProperty('width', 'min(400px, 94vw)', 'important');
            iframe.style.setProperty('max-width', 'calc(100vw - 40px)', 'important');
            iframe.style.setProperty('height', '406px', 'important');
            iframe.style.setProperty('max-height', '60vh', 'important');
            iframe.style.setProperty('border-radius', '20px', 'important');
            iframe.style.setProperty('border', 'none', 'important');
            iframe.style.setProperty('margin', '0', 'important');
            iframe.style.setProperty('box-shadow', 'none', 'important');
        }
    }

    // ── Open chat & display animated video ──
    function openChat() {
        chatOpen = true;
        scrollStartY = window.pageYOffset;

        // Activate mascot wrapper & play video at full opacity
        wrapper.classList.add('dori-active');
        if (videoWrap) {
            videoWrap.style.display = 'flex';
            videoWrap.style.opacity = '1';
            videoWrap.style.pointerEvents = 'auto';
        }
        if (video) {
            video.currentTime = 0;
            video.play().catch(function(){});
        }

        // Restore iframe visibility
        var iframe = getChatIframe();
        if (iframe) {
            iframe.style.removeProperty('display');
            iframe.style.removeProperty('visibility');
            iframe.style.removeProperty('opacity');
            iframe.style.removeProperty('pointer-events');
            iframe.style.removeProperty('transform');
        }

        // Show custom header, border-frame & bottom mask overlays
        if (headerBar)   headerBar.classList.add('dori-chat-open');
        if (bottomBar)   bottomBar.classList.add('dori-chat-open');
        if (borderFrame) borderFrame.classList.add('dori-chat-open');

        // Trigger Chatling open & lock bounds
        try {
            if (window.Chatling && typeof window.Chatling.open === 'function') {
                window.Chatling.open();
            } else if (iframe) {
                iframe.style.display = 'block';
                iframe.style.opacity = '1';
                iframe.style.visibility = 'visible';
            }
        } catch (err) {}

        requestAnimationFrame(enforceChatBounds);
        setTimeout(enforceChatBounds, 50);
        setTimeout(enforceChatBounds, 250);
    }

    // ── Close chat & restore idle mascot ──
    function closeChat() {
        if (!chatOpen) return;
        chatOpen = false;

        var iframe = getChatIframe();

        // 1. Tell Chatling to minimize in background
        try {
            if (window.Chatling && typeof window.Chatling.minimize === 'function') {
                window.Chatling.minimize();
            }
        } catch (err) {}

        // 2. Hide iframe and overlays immediately so native support UI never flashes
        if (iframe) {
            iframe.style.setProperty('display', 'none', 'important');
            iframe.style.setProperty('visibility', 'hidden', 'important');
            iframe.style.setProperty('opacity', '0', 'important');
            iframe.style.setProperty('pointer-events', 'none', 'important');
        }
        if (headerBar)   headerBar.classList.remove('dori-chat-open');
        if (bottomBar)   bottomBar.classList.remove('dori-chat-open');
        if (borderFrame) borderFrame.classList.remove('dori-chat-open');

        // 3. Restore idle mascot image and stop video
        wrapper.classList.remove('dori-active');
        if (videoWrap) {
            videoWrap.style.display = 'none';
            videoWrap.style.opacity = '';
        }
        if (video) {
            video.pause();
            video.currentTime = 0;
        }
    }

    // ── Click Dori Mascot → Toggle chat ──
    wrapper.addEventListener('click', function(e) {
        e.stopPropagation();
        if (chatOpen) {
            closeChat();
        } else {
            openChat();
        }
    });

    // ── Close button click ──
    if (chatX) {
        chatX.addEventListener('click', function(e) {
            e.stopPropagation();
            closeChat();
        });
    }

    // ── Listen to Chatling Widget internal minimize event ──
    window.addEventListener('message', function(e) {
        try {
            if (!e || !e.data) return;
            var data = e.data;
            if (data === 'chtl_chat_minimized' || (data && data.event_id === 'chtl_chat_widget_closed')) {
                if (chatOpen) closeChat();
            }
        } catch (err) {}
    });

    // ── Enforce on resize ──
    window.addEventListener('resize', function(){
        if (chatOpen) enforceChatBounds();
    }, { passive: true });

    // ── Close on ESC key ──
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && chatOpen) {
            closeChat();
        }
    });

    // ── Scroll → close chat if user scrolls far away ──
    document.addEventListener('scroll', function(){
        if (chatOpen && Math.abs(window.pageYOffset - scrollStartY) > 160) {
            closeChat();
        }
    }, { passive: true });
})();
