

class GrafikaAnimations {
    constructor() {
        this.isDebug = true; 
        this.animatedElements = [];
        this.progressBar = null;
        
        this.log('🚀 Inicjalizacja systemu animacji...');
        this.init();
    }

    log(message, ...args) {
        if (this.isDebug) {
            console.log(`[GrafikaAnimations] ${message}`, ...args);
        }
    }

    init() {
        
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setup());
        } else {
            this.setup();
        }
    }

    setup() {
        this.log('📱 DOM załadowany - rozpoczynanie konfiguracji');
        
        
        this.findAnimatedElements();
        
        
        this.setupIntersectionObserver();
        
        
        this.setupScrollProgress();
        
        
        this.setupSmoothScroll();
        
        
        this.setupEventListeners();
        
        this.log('✅ System animacji gotowy!');
    }

    findAnimatedElements() {
        this.animatedElements = document.querySelectorAll('.animate-on-scroll, .fade-in-up, .fade-in-down, .fade-in-left, .fade-in-right, .scale-in, .slide-in-left, .slide-in-right');
        
        this.log(`🎯 Znaleziono ${this.animatedElements.length} elementów do animacji`);
        
        
        this.animatedElements.forEach((element, index) => {
            
            if (!element.classList.contains('animate-on-scroll')) {
                element.classList.add('animate-on-scroll');
            }
            
            this.log(`Element ${index + 1}: ${element.tagName}.${element.className}`);
        });
    }

    setupIntersectionObserver() {
        const options = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('is-visible')) {
                    this.animateElement(entry.target);
                }
            });
        }, options);

        
        this.animatedElements.forEach(element => {
            this.observer.observe(element);
        });

        this.log('👁️ Intersection Observer skonfigurowany');
    }

    animateElement(element) {
        const delay = parseInt(element.dataset.delay) || 0;
        
        setTimeout(() => {
            
            element.classList.add('is-visible', 'animated');
            
            this.log(`✨ Animacja: ${element.tagName}.${element.className}`);
        }, delay);
    }

    setupScrollProgress() {
        
        const existingProgress = document.querySelector('.scroll-progress');
        if (existingProgress) {
            this.progressBar = existingProgress;
        } else {
            
            this.progressBar = document.createElement('div');
            this.progressBar.className = 'scroll-progress';
            document.body.appendChild(this.progressBar);
        }
        
        this.log('📊 Pasek postępu skonfigurowany');
    }

    updateScrollProgress() {
        if (!this.progressBar) return;
        
        const scrollTop = window.pageYOffset;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPercent = Math.min((scrollTop / docHeight) * 100, 100);
        
        this.progressBar.style.width = `${scrollPercent}%`;
    }

    setupSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(anchor.getAttribute('href'));
                
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        this.log('🎯 Płynne przewijanie skonfigurowane');
    }

    setupEventListeners() {
        
        let ticking = false;
        
        const handleScroll = () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    this.updateScrollProgress();
                    ticking = false;
                });
                ticking = true;
            }
        };

        window.addEventListener('scroll', handleScroll, { passive: true });
        window.addEventListener('resize', () => this.updateScrollProgress());
        
        this.log('🎧 Event listenery skonfigurowane');
    }

    
    animateElementManually(element) {
        if (element && !element.classList.contains('is-visible')) {
            this.animateElement(element);
        }
    }

    resetAnimation(element) {
        if (element) {
            element.classList.remove('is-visible', 'animated');
        }
    }

    destroy() {
        if (this.observer) {
            this.observer.disconnect();
        }
        this.log('🔥 System animacji zniszczony');
    }
}


window.grafikaAnimations = new GrafikaAnimations();


if (typeof module !== 'undefined' && module.exports) {
    module.exports = GrafikaAnimations;
}