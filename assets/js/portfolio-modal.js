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
            <img class="portfolio-modal-image" src="" alt="">
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
    const modalTitle = modal.querySelector('.portfolio-modal-title');
    const modalDescription = modal.querySelector('.portfolio-modal-description');
    const modalCategories = modal.querySelector('.portfolio-modal-categories');
    
    const image = portfolioItem.querySelector('img');
    const title = portfolioItem.querySelector('h3');
    const description = portfolioItem.querySelector('.description');
    const categoryElement = portfolioItem.querySelector('.category');
    
    if (image) {
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
    
    modal.classList.remove('modal-show');
    
    setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }, 300);
}
