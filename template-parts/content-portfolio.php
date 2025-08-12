<?php 
$media_type = get_post_meta(get_the_ID(), '_portfolio_media_type', true);
$video_url = get_post_meta(get_the_ID(), '_portfolio_video_url', true);
?>

<div class="portfolio-item" 
     data-post-id="<?php echo get_the_ID(); ?>" 
     data-title="<?php echo esc_attr(get_the_title()); ?>"
     data-media-type="<?php echo esc_attr($media_type ? $media_type : 'image'); ?>"
     data-video-url="<?php echo esc_attr($video_url); ?>"
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