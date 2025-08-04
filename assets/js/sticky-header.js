document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.site-header');
    const logo = header.querySelector('.logo');
    let lastScrollTop = 0;
    let ticking = false;
    
    function handleScroll() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollDirection = scrollTop > lastScrollTop ? 'down' : 'up';
        
        
        if (scrollDirection === 'down' && scrollTop > 200) {
            
            header.style.transform = 'translateY(-100%)';
            header.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        } else if (scrollDirection === 'up' || scrollTop <= 100) {
            
            header.style.transform = 'translateY(0)';
            header.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        }
        
        
        if (scrollTop > 30) {
            if (!header.classList.contains('scrolled')) {
                header.classList.add('scrolled');
            }
        } else {
            if (header.classList.contains('scrolled')) {
                header.classList.remove('scrolled');
            }
        }
        
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    }
    
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    const headerHeight = header.offsetHeight;
                    const targetPosition = target.offsetTop - headerHeight - 20;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
    
    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(handleScroll);
            ticking = true;
        }
    }
    
    window.addEventListener('scroll', function() {
        ticking = false;
        requestTick();
    });
    
    handleScroll();
}); 
