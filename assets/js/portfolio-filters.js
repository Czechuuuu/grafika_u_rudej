// Filtrowanie projektów portfolio
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item-wrapper');
    
    if (filterButtons.length === 0 || portfolioItems.length === 0) {
        return; // Jeśli nie ma elementów, zakończ
    }
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Usuń active z wszystkich przycisków
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Dodaj active do klikniętego przycisku
            this.classList.add('active');
            
            // Filtruj projekty z animacją
            portfolioItems.forEach((item, index) => {
                const categories = item.getAttribute('data-categories');
                
                if (filter === 'all' || (categories && categories.includes(filter))) {
                    item.style.display = 'block';
                    // Dodaj małe opóźnienie dla każdego elementu
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, index * 50);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
});
