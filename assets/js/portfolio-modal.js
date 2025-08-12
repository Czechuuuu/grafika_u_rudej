document.addEventListener('DOMContentLoaded', function() {
    initPortfolioModal();
    checkAutoOpenProject();
});

function checkAutoOpenProject() {
    const urlParams = new URLSearchParams(window.location.search);
    const projectId = urlParams.get('project');
    
    if (projectId) {
        setTimeout(() => {
            const projectItem = document.querySelector(`.portfolio-item[data-post-id="${projectId}"]`);
            if (projectItem) {
                openPortfolioModal(projectItem);
                const url = new URL(window.location);
                url.searchParams.delete('project');
                window.history.replaceState({}, document.title, url.pathname);
            }
        }, 500);
    }
}

function initPortfolioModal() {
    if (!document.getElementById('portfolio-modal')) {
        createPortfolioModal();
    }
    
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    portfolioItems.forEach(item => {
        // Główny event listener na całym item
        item.addEventListener('click', function(e) {
            e.preventDefault();
            openPortfolioModal(this);
        });
        
        item.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openPortfolioModal(this);
            }
        });
        
        // Specjalne handlery dla video
        const video = item.querySelector('video');
        const videoContainer = item.querySelector('.video-container');
        
        if (video && videoContainer) {
            // Blokuj domyślne zachowanie video
            video.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                openPortfolioModal(item);
            });
            
            // Blokuj kontrolki video w preview
            video.controls = false;
            video.addEventListener('play', function(e) {
                e.preventDefault();
                this.pause();
                openPortfolioModal(item);
            });
            
            // Handler na overlay z przyciskiem play
            const playOverlay = item.querySelector('.play-overlay');
            if (playOverlay) {
                playOverlay.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    openPortfolioModal(item);
                });
            }
        }
        
        item.style.cursor = 'pointer';
    });
}

function createPortfolioModal() {
    const modal = document.createElement('div');
    modal.id = 'portfolio-modal';
    modal.className = 'portfolio-modal';
    
    modal.innerHTML = `
        <div class="portfolio-modal-content">
            <button class="portfolio-modal-close" aria-label="Zamknij">&times;</button>
            <div class="portfolio-modal-media">
                <img class="portfolio-modal-image" src="" alt="" style="display: none;">
                <video class="portfolio-modal-video" controls preload="metadata" style="display: none;">
                    <source src="" type="video/mp4">
                    Twoja przeglądarka nie obsługuje video.
                </video>
            </div>
            <div class="portfolio-modal-info">
                <h2 class="portfolio-modal-title"></h2>
                <div class="portfolio-modal-description"></div>
                <div class="portfolio-modal-categories"></div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    setupModalEvents();
}

function setupModalEvents() {
    const modal = document.getElementById('portfolio-modal');
    const closeBtn = modal.querySelector('.portfolio-modal-close');
    
    closeBtn.addEventListener('click', closePortfolioModal);
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closePortfolioModal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'flex') {
            closePortfolioModal();
        }
    });
}

function openPortfolioModal(portfolioItem) {
    const modal = document.getElementById('portfolio-modal');
    const modalImage = modal.querySelector('.portfolio-modal-image');
    const modalVideo = modal.querySelector('.portfolio-modal-video');
    const modalTitle = modal.querySelector('.portfolio-modal-title');
    const modalDescription = modal.querySelector('.portfolio-modal-description');
    const modalCategories = modal.querySelector('.portfolio-modal-categories');
    
    const mediaType = portfolioItem.dataset.mediaType || 'image';
    const videoUrl = portfolioItem.dataset.videoUrl;
    const image = portfolioItem.querySelector('img');
    const title = portfolioItem.querySelector('h3');
    const description = portfolioItem.querySelector('.description');
    const categoryElement = portfolioItem.querySelector('.category');
    
    // Ukryj oba elementy na początku
    modalImage.style.display = 'none';
    modalVideo.style.display = 'none';
    
    if (mediaType === 'video' && videoUrl) {
        // Wyświetl video
        modalVideo.querySelector('source').src = videoUrl;
        modalVideo.controls = true; // Włącz kontrolki
        modalVideo.setAttribute('controls', 'controls'); // Backup
        modalVideo.preload = 'metadata';
        modalVideo.load();
        modalVideo.style.display = 'block';
        
        console.log('Loading video:', videoUrl);
        console.log('Video controls:', modalVideo.controls);
        console.log('Video element:', modalVideo);
        
        // Spróbuj automatyczne odtwarzanie po chwili
        setTimeout(() => {
            modalVideo.play().catch(e => {
                console.log('Automatyczne odtwarzanie zablokowane przez przeglądarkę:', e);
            });
        }, 200);
    } else if (image) {
        // Wyświetl obraz
        let imageSrc = image.src;
        imageSrc = imageSrc.replace('-150x150', '');
        imageSrc = imageSrc.replace('-300x300', ''); 
        imageSrc = imageSrc.replace('-1024x1024', '');
        imageSrc = imageSrc.replace('-768x768', '');
        imageSrc = imageSrc.replace('-medium', '');
        imageSrc = imageSrc.replace('-large', '');
        imageSrc = imageSrc.replace('-thumbnail', '');
        
        modalImage.src = imageSrc;
        modalImage.alt = image.alt || title?.textContent || '';
        modalImage.style.display = 'block';
    }
    
    if (title) {
        modalTitle.textContent = title.textContent;
    }
    
    if (description) {
        modalDescription.innerHTML = description.innerHTML;
    }
    
    modalCategories.innerHTML = '';
    if (categoryElement) {
        const categoryText = categoryElement.textContent.replace('Kategoria: ', '');
        const categories = categoryText.split(', ');
        
        categories.forEach(category => {
            const categorySpan = document.createElement('span');
            categorySpan.className = 'portfolio-modal-category';
            categorySpan.textContent = category.trim();
            modalCategories.appendChild(categorySpan);
        });
    }
    
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    
    setTimeout(() => {
        modal.classList.add('modal-show');
    }, 10);
}

function closePortfolioModal() {
    const modal = document.getElementById('portfolio-modal');
    const modalVideo = modal.querySelector('.portfolio-modal-video');
    
    // Pauzuj video jeśli jest odtwarzane
    if (modalVideo && !modalVideo.paused) {
        modalVideo.pause();
    }
    
    modal.classList.remove('modal-show');
    
    setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }, 300);
}
