jQuery(document).ready(function($) {
    var mediaUploader;

    $('#add-gallery-image').on('click', function(e) {
        e.preventDefault();
        
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        
        mediaUploader = wp.media({
            title: 'Wybierz obraz do galerii',
            button: {
                text: 'Dodaj do galerii'
            },
            multiple: true
        });
        
        mediaUploader.on('select', function() {
            var attachments = mediaUploader.state().get('selection').toJSON();
            
            attachments.forEach(function(attachment) {
                if (attachment.type === 'image') {
                    addImageToGallery(attachment.id, attachment.sizes.thumbnail.url);
                }
            });
            
            updateGalleryCount();
        });
        
        mediaUploader.open();
    });
    
    $(document).on('click', '.remove-gallery-image', function(e) {
        e.preventDefault();
        $(this).closest('.gallery-image-item').remove();
        updateGalleryCount();
        reorderItems();
    });
    
    $(document).on('click', '.move-up', function(e) {
        e.preventDefault();
        var $item = $(this).closest('.gallery-image-item');
        var $prev = $item.prev('.gallery-image-item');
        if ($prev.length) {
            $item.insertBefore($prev);
            reorderItems();
        }
    });
    
    $(document).on('click', '.move-down', function(e) {
        e.preventDefault();
        var $item = $(this).closest('.gallery-image-item');
        var $next = $item.next('.gallery-image-item');
        if ($next.length) {
            $item.insertAfter($next);
            reorderItems();
        }
    });
    
    function addImageToGallery(imageId, thumbnailUrl) {
        var $list = $('#gallery-images-list');
        var index = $list.children().length;
        
        var $item = $('<div class="gallery-image-item" data-index="' + index + '">' +
            '<div class="gallery-image-preview">' +
                '<img src="' + thumbnailUrl + '" alt="Gallery Image" />' +
            '</div>' +
            '<div class="gallery-image-controls">' +
                '<input type="hidden" name="portfolio_gallery_images[]" value="' + imageId + '" />' +
                '<button type="button" class="button remove-gallery-image">Usuń</button>' +
                '<button type="button" class="button move-up">↑</button>' +
                '<button type="button" class="button move-down">↓</button>' +
            '</div>' +
        '</div>');
        
        $list.append($item);
        reorderItems();
    }
    
    function reorderItems() {
        $('#gallery-images-list .gallery-image-item').each(function(index) {
            $(this).attr('data-index', index);
            $(this).find('.move-up').prop('disabled', index === 0);
            $(this).find('.move-down').prop('disabled', index === $('#gallery-images-list .gallery-image-item').length - 1);
        });
    }
    
    function updateGalleryCount() {
        var count = $('#gallery-images-list .gallery-image-item').length;
        $('#gallery-count-number').text(count);
    }
    
    reorderItems();
});
