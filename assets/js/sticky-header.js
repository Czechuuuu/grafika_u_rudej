document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header');
    let lastScrollTop = 0;
    
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop > 100) {
            header.classList.add('sticky');
        } else {
            header.classList.remove('sticky');
        }
        if (scrollTop > lastScrollTop && scrollTop > 200) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
        }
        lastScrollTop = scrollTop;
    });
    window.addEventListener('scroll', function() {
        if (window.pageYOffset === 0) {
            header.style.transform = 'translateY(0)';
        }
    });
}); 