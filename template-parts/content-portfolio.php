<div class="portfolio-item">
    <?php if (has_post_thumbnail()) : ?>
        <div class="image">
            <?php the_post_thumbnail('medium'); ?>
        </div>
    <?php endif; ?>

    <h3><?php the_title(); ?></h3>
    <div class="description"><?php the_content(); ?></div>
    
    <div style="margin-top:auto;">
        <?php 
        // Wyświetl kategorie projektu
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