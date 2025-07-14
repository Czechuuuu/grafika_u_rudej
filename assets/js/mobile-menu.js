document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const mobileMenu = document.querySelector('.mobile-menu');
    const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
    const mobileMenuClose = document.querySelector('.mobile-menu-close');
    const body = document.body;
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu a, .mobile-nav-menu a');
    function openMobileMenu() {
        hamburger.classList.add('active');
        mobileMenu.classList.add('active');
        mobileMenuOverlay.classList.add('active');
        body.style.overflow = 'hidden';
    }
    function closeMobileMenu() {
        hamburger.classList.remove('active');
        mobileMenu.classList.remove('active');
        mobileMenuOverlay.classList.remove('active');
        body.style.overflow = '';
    }
    if (hamburger) {
        hamburger.addEventListener('click', openMobileMenu);
    }
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', closeMobileMenu);
    }
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
    }
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });
    window.addEventListener('resize', function() {
        if (window.innerWidth > 767 && mobileMenu && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });
}); 