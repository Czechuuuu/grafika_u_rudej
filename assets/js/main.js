// Sticky Header
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header');
    let lastScrollTop = 0;
    
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Dodaj klasę sticky po scrollowaniu w dół
        if (scrollTop > 100) {
            header.classList.add('sticky');
        } else {
            header.classList.remove('sticky');
        }
        
        // Opcjonalnie: ukryj/pokaż header przy scrollowaniu w górę/dół
        if (scrollTop > lastScrollTop && scrollTop > 200) {
            // Scrollowanie w dół - ukryj header
            header.style.transform = 'translateY(-100%)';
        } else {
            // Scrollowanie w górę - pokaż header
            header.style.transform = 'translateY(0)';
        }
        
        lastScrollTop = scrollTop;
    });
    
    // Pokaż header przy scrollowaniu na górę strony
    window.addEventListener('scroll', function() {
        if (window.pageYOffset === 0) {
            header.style.transform = 'translateY(0)';
        }
    });
});

// Smooth scroll dla linków wewnętrznych
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                const headerHeight = document.querySelector('header').offsetHeight;
                const targetPosition = targetElement.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});

// Animacje przy scrollowaniu
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Obserwuj elementy z klasą fade-in
    const fadeElements = document.querySelectorAll('.fade-in, .fade-in-left, .fade-in-right');
    fadeElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});

// Hamburger Menu
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const mobileMenu = document.querySelector('.mobile-menu');
    const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
    const mobileMenuClose = document.querySelector('.mobile-menu-close');
    const body = document.body;
    
    // Sprawdź czy elementy istnieją
    console.log('Hamburger found:', !!hamburger);
    console.log('Mobile menu found:', !!mobileMenu);
    console.log('Mobile menu overlay found:', !!mobileMenuOverlay);
    console.log('Mobile menu close found:', !!mobileMenuClose);
    
    // Sprawdź czy menu ma linki
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu a, .mobile-nav-menu a');
    console.log('Mobile menu links found:', mobileMenuLinks.length);

    function openMobileMenu() {
        hamburger.classList.add('active');
        mobileMenu.classList.add('active');
        mobileMenuOverlay.classList.add('active');
        body.style.overflow = 'hidden'; // Blokuj scrollowanie
    }

    function closeMobileMenu() {
        hamburger.classList.remove('active');
        mobileMenu.classList.remove('active');
        mobileMenuOverlay.classList.remove('active');
        body.style.overflow = ''; // Przywróć scrollowanie
    }

    // Otwórz menu po kliknięciu hamburger
    if (hamburger) {
        hamburger.addEventListener('click', openMobileMenu);
    }

    // Zamknij menu po kliknięciu X
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', closeMobileMenu);
    }

    // Zamknij menu po kliknięciu overlay
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
    }

    // Zamknij menu po kliknięciu linku
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });

    // Zamknij menu po naciśnięciu Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });

    // Zamknij menu przy resize okna (jeśli przełączamy na desktop)
    window.addEventListener('resize', function() {
        if (window.innerWidth > 767 && mobileMenu && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });
}); 