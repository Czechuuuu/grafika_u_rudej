document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const mobileMenu = document.querySelector('.mobile-menu');
    const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
    const mobileMenuClose = document.querySelector('.mobile-menu-close');
    const body = document.body;
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu a, .mobile-nav-menu a');
    
    function openMobileMenu() {
        if (hamburger) hamburger.classList.add('active');
        if (mobileMenu) mobileMenu.classList.add('active');
        if (mobileMenuOverlay) mobileMenuOverlay.classList.add('active');
        body.style.overflow = 'hidden';
    }
    
    function closeMobileMenu() {
        if (hamburger) hamburger.classList.remove('active');
        if (mobileMenu) mobileMenu.classList.remove('active');
        if (mobileMenuOverlay) mobileMenuOverlay.classList.remove('active');
        body.style.overflow = '';
    }
    
    if (hamburger) {
        hamburger.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            openMobileMenu();
        });
    }
    
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeMobileMenu();
        });
    }
    
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeMobileMenu();
        });
    }
    
    // Zamknij menu po kliknięciu w link
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', function() {
            closeMobileMenu();
        });
    });
    
    // Zamknij menu klawiszem Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });
    
    // Zamknij menu i wyczyść stany przy zmianie rozmiaru okna
    window.addEventListener('resize', function() {
        // Zamknij menu na desktop (768px+)
        if (window.innerWidth >= 768 && mobileMenu && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });
    
    // Wyczyść overflow body przy załadowaniu strony
    window.addEventListener('load', function() {
        body.style.overflow = '';
    });
}); 