document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('contact-modal');
    
    if (modal) {
        showModal();
        
        const closeBtn = modal.querySelector('.modal-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }
        
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.style.display === 'flex') {
                closeModal();
            }
        });
    }
});

function showModal() {
    const modal = document.getElementById('contact-modal');
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        
        setTimeout(() => {
            modal.classList.add('modal-show');
        }, 10);
    }
}

function closeModal() {
    const modal = document.getElementById('contact-modal');
    if (modal) {
        modal.classList.remove('modal-show');
        
        setTimeout(() => {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
            
            const url = new URL(window.location);
            url.searchParams.delete('message');
            url.searchParams.delete('errors');
            window.history.replaceState({}, document.title, url.pathname);
        }, 300);
    }
}
