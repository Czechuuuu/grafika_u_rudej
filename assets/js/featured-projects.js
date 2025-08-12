document.addEventListener('DOMContentLoaded', function() {
    const featuredProjectLinks = document.querySelectorAll('.featured-project-link');
    
    featuredProjectLinks.forEach(link => {
        link.addEventListener('click', function(e) {
        });
    });
});

function openFeaturedProjectModal(projectId) {
    const portfolioUrl = (typeof grafikaReels !== 'undefined' && grafikaReels.portfolioUrl) 
        ? grafikaReels.portfolioUrl 
        : window.location.origin + '/portfolio';
    window.location.href = portfolioUrl + '?project=' + projectId;
}
