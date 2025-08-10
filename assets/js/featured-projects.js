document.addEventListener('DOMContentLoaded', function() {
    const featuredProjectLinks = document.querySelectorAll('.featured-project-link');
    
    featuredProjectLinks.forEach(link => {
        link.addEventListener('click', function(e) {
        });
    });
});

function openFeaturedProjectModal(projectId) {
    window.location.href = `/portfolio?project=${projectId}`;
}
