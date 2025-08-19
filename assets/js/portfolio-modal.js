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
        const video = item.querySelector('video');
        const videoContainer = item.querySelector('.video-container');
        if (video && videoContainer) {
            video.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                openPortfolioModal(item);
            });
            video.controls = false;
            video.addEventListener('play', function(e) {
                e.preventDefault();
                this.pause();
                openPortfolioModal(item);
            });
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
                <div class="gallery-navigation" style="display: none;">
                    <button class="gallery-nav-btn gallery-prev" aria-label="Poprzednie zdjęcie">❮</button>
                    <button class="gallery-nav-btn gallery-next" aria-label="Następne zdjęcie">❯</button>
                    <div class="gallery-counter">
                        <span class="gallery-current">1</span> / <span class="gallery-total">1</span>
                    </div>
                </div>
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
    const galleryPrev = modal.querySelector('.gallery-prev');
    const galleryNext = modal.querySelector('.gallery-next');
    closeBtn.addEventListener('click', closePortfolioModal);
    galleryPrev.addEventListener('click', () => changeGalleryImage(-1));
    galleryNext.addEventListener('click', () => changeGalleryImage(1));
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closePortfolioModal();
        }
    });
    document.addEventListener('keydown', function(e) {
        if (modal.style.display === 'flex') {
            if (e.key === 'Escape') {
                closePortfolioModal();
            } else if (e.key === 'ArrowLeft') {
                changeGalleryImage(-1);
            } else if (e.key === 'ArrowRight') {
                changeGalleryImage(1);
            }
        }
    });
}

let currentGalleryImages = [];
let currentGalleryIndex = 0;

function openPortfolioModal(portfolioItem) {
    const modal = document.getElementById('portfolio-modal');
    const modalImage = modal.querySelector('.portfolio-modal-image');
    const modalVideo = modal.querySelector('.portfolio-modal-video');
    const modalTitle = modal.querySelector('.portfolio-modal-title');
    const modalDescription = modal.querySelector('.portfolio-modal-description');
    const modalCategories = modal.querySelector('.portfolio-modal-categories');
    const galleryNavigation = modal.querySelector('.gallery-navigation');
    const mediaType = portfolioItem.dataset.mediaType || 'image';
    const videoUrl = portfolioItem.dataset.videoUrl;
    const hasGallery = portfolioItem.dataset.hasGallery === 'true';
    const galleryUrls = portfolioItem.dataset.galleryUrls;
    const image = portfolioItem.querySelector('img');
    const title = portfolioItem.querySelector('h3');
    const description = portfolioItem.querySelector('.description');
    const categoryElement = portfolioItem.querySelector('.category');
    currentGalleryImages = [];
    currentGalleryIndex = 0;
    modalImage.style.display = 'none';
    modalVideo.style.display = 'none';
    galleryNavigation.style.display = 'none';
    if (mediaType === 'video' && videoUrl) {
        modalVideo.querySelector('source').src = videoUrl;
        modalVideo.controls = true;
        modalVideo.preload = 'metadata';
        modalVideo.load();
        modalVideo.style.display = 'block';
        setTimeout(() => {
            modalVideo.play().catch(e => {
                console.log('Automatyczne odtwarzanie zablokowane przez przeglądarkę:', e);
            });
        }, 200);
    } else if (hasGallery && galleryUrls) {
        try {
            const galleryData = JSON.parse(galleryUrls);
            currentGalleryImages = [];
            if (image) {
                let imageSrc = image.src;
                imageSrc = getFullImageUrl(imageSrc);
                currentGalleryImages.push({
                    url: imageSrc,
                    alt: image.alt || title?.textContent || ''
                });
            }
            galleryData.forEach(imageData => {
                if (imageData && imageData.url) {
                    currentGalleryImages.push({
                        url: imageData.url,
                        alt: imageData.alt || ''
                    });
                }
            });
            if (currentGalleryImages.length > 0) {
                displayGalleryImage(0);
                galleryNavigation.style.display = 'block';
                updateGalleryCounter();
            }
        } catch (e) {
            console.error('Błąd parsowania galerii:', e);
            displaySingleImage(image, title);
        }
    } else if (image) {
        displaySingleImage(image, title);
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

function displaySingleImage(image, title) {
    const modal = document.getElementById('portfolio-modal');
    const modalImage = modal.querySelector('.portfolio-modal-image');
    let imageSrc = getFullImageUrl(image.src);
    modalImage.src = imageSrc;
    modalImage.alt = image.alt || title?.textContent || '';
    modalImage.style.display = 'block';
}

function displayGalleryImage(index) {
    const modal = document.getElementById('portfolio-modal');
    const modalImage = modal.querySelector('.portfolio-modal-image');
    if (currentGalleryImages[index]) {
        modalImage.src = currentGalleryImages[index].url;
        modalImage.alt = currentGalleryImages[index].alt;
        modalImage.style.display = 'block';
        currentGalleryIndex = index;
        updateGalleryCounter();
    }
}

function changeGalleryImage(direction) {
    if (currentGalleryImages.length <= 1) return;
    let newIndex = currentGalleryIndex + direction;
    if (newIndex < 0) {
        newIndex = currentGalleryImages.length - 1;
    } else if (newIndex >= currentGalleryImages.length) {
        newIndex = 0;
    }
    displayGalleryImage(newIndex);
}

function updateGalleryCounter() {
    const modal = document.getElementById('portfolio-modal');
    const currentSpan = modal.querySelector('.gallery-current');
    const totalSpan = modal.querySelector('.gallery-total');
    if (currentSpan && totalSpan) {
        currentSpan.textContent = currentGalleryIndex + 1;
        totalSpan.textContent = currentGalleryImages.length;
    }
}

function getFullImageUrl(thumbnailUrl) {
    let imageSrc = thumbnailUrl;
    imageSrc = imageSrc.replace('-150x150', '');
    imageSrc = imageSrc.replace('-300x300', ''); 
    imageSrc = imageSrc.replace('-1024x1024', '');
    imageSrc = imageSrc.replace('-768x768', '');
    imageSrc = imageSrc.replace('-medium', '');
    imageSrc = imageSrc.replace('-large', '');
    imageSrc = imageSrc.replace('-thumbnail', '');
    return imageSrc;
}

function closePortfolioModal() {
    const modal = document.getElementById('portfolio-modal');
    const modalVideo = modal.querySelector('.portfolio-modal-video');
    if (modalVideo && !modalVideo.paused) {
        modalVideo.pause();
    }
    modal.classList.remove('modal-show');
    setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }, 300);
}
