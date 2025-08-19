<?php 
$media_type = get_post_meta(get_the_ID(), '_portfolio_media_type', true);
$video_url = get_post_meta(get_the_ID(), '_portfolio_video_url', true);
$gallery_images = get_post_meta(get_the_ID(), '_portfolio_gallery_images', true);
$has_gallery = !empty($gallery_images) && is_array($gallery_images) && count($gallery_images) > 0;

$gallery_urls = array();
if ($has_gallery) {
    foreach ($gallery_images as $image_id) {
        $image_url = wp_get_attachment_image_url($image_id, 'full');
        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
        if ($image_url) {
            $gallery_urls[] = array(
                'url' => $image_url,
                'alt' => $image_alt ?: get_the_title($image_id)
            );
        }
    }
}
?>

<div class="portfolio-item" 
     data-post-id="<?php echo get_the_ID(); ?>" 
     data-title="<?php echo esc_attr(get_the_title()); ?>"
     data-media-type="<?php echo esc_attr($media_type ? $media_type : 'image'); ?>"
     data-video-url="<?php echo esc_attr($video_url); ?>"
     data-has-gallery="<?php echo $has_gallery ? 'true' : 'false'; ?>"
     data-gallery-urls="<?php echo $has_gallery ? esc_attr(json_encode($gallery_urls)) : ''; ?>"
     role="button" 
     tabindex="0" 
     aria-label="Otwórz szczegóły projektu: <?php echo esc_attr(get_the_title()); ?>">
     
    <?php if ($media_type === 'video' && !empty($video_url)) : ?>
        <div class="video-container">
            <video poster="<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : ''; ?>" preload="metadata">
                <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                Twoja przeglądarka nie obsługuje video.
            </video>
            <div class="play-overlay">
                <div class="play-button">▶</div>
            </div>
        </div>
    <?php elseif (has_post_thumbnail()) : ?>
        <div class="image">
            <?php 
            the_post_thumbnail('large'); 
            ?>
            <?php if ($has_gallery) : ?>
                <div class="gallery-indicator">
                    <span class="gallery-icon">🖼️</span>
                    <span class="gallery-count"><?php echo count($gallery_images) + 1; ?> zdjęć</span>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <h3><?php the_title(); ?></h3>
    <div class="description"><?php the_content(); ?></div>
    
    <div class="portfolio-meta">
        <?php 
        $categories = get_the_terms(get_the_ID(), 'portfolio_category');
        if ($categories && !is_wp_error($categories)) : 
            $category_names = array();
            foreach ($categories as $category) {
                $category_names[] = $category->name;
            }
            ?>
            <p class="category">Kategoria: <?php echo implode(', ', $category_names); ?></p>
        <?php endif; ?>
    </div>
</div>