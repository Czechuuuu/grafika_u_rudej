<div class="portfolio-item" 
     data-post-id="<?php echo get_the_ID(); ?>" 
     data-title="<?php echo esc_attr(get_the_title()); ?>"
     role="button" 
     tabindex="0" 
     aria-label="Otwórz szczegóły projektu: <?php echo esc_attr(get_the_title()); ?>">
     
    <?php if (has_post_thumbnail()) : ?>
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