<?php
get_header(); ?>

<main class="wrap portfolio-archive">
    <header class="archive-header">
        <h1><?php _e( 'Moje projekty', 'grafika_u_rudej' ); ?></h1>
        <p>Zobacz moje najnowsze realizacje z różnych dziedzin grafiki i projektowania.</p>
    </header>

    <?php if ( have_posts() ) : ?>
        <div class="portfolio-filters">
            <button class="filter-btn active" data-filter="all">Wszystkie</button>
            <button class="filter-btn" data-filter="logo">Logo</button>
            <button class="filter-btn" data-filter="branding">Branding</button>
            <button class="filter-btn" data-filter="social">Social Media</button>
            <button class="filter-btn" data-filter="illustration">Ilustracje</button>
            <button class="filter-btn" data-filter="dtp">DTP</button>
            <button class="filter-btn" data-filter="web">Web</button>
        </div>

        <div class="portfolio-grid">
            <?php while ( have_posts() ) : the_post(); 
                $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                $category_classes = '';
                if ($categories) {
                    foreach ($categories as $category) {
                        $category_classes .= ' category-' . $category->slug;
                    }
                }
            ?>
                <article <?php post_class('portfolio-item' . $category_classes); ?>>
                    <a href="<?php the_permalink(); ?>" class="portfolio-link">
                        <div class="portfolio-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <div class="placeholder-image">
                                    <span>Brak zdjęcia</span>
                                </div>
                            <?php endif; ?>
                            <div class="portfolio-overlay">
                                <span class="view-project">Zobacz projekt</span>
                            </div>
                        </div>
                        <div class="portfolio-info">
                            <h2><?php the_title(); ?></h2>
                            <?php if (get_field('client_name')) : ?>
                                <p class="client"><?php echo get_field('client_name'); ?></p>
                            <?php endif; ?>
                            <?php if (get_the_excerpt()) : ?>
                                <p class="excerpt"><?php echo get_the_excerpt(); ?></p>
                            <?php endif; ?>
                            <?php if ($categories) : ?>
                                <div class="portfolio-categories">
                                    <?php foreach ($categories as $category) : ?>
                                        <span class="category-tag"><?php echo $category->name; ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="portfolio-pagination">
            <?php the_posts_pagination([
                'prev_text' => '← Poprzednia',
                'next_text' => 'Następna →',
                'mid_size' => 2
            ]); ?>
        </div>

    <?php else : ?>
        <div class="no-projects">
            <p><?php _e( 'Brak projektów do wyświetlenia.', 'grafika_u_rudej' ); ?></p>
            <a href="<?php echo site_url('/kontakt'); ?>" class="btn">Zacznijmy współpracę!</a>
        </div>
    <?php endif; ?>
</main>

<?php
get_footer();
