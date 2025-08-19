<?php get_header(); ?>
<div class="portfolio-page-wrapper">
    <div class="page-header">
        <h1 class="page-title animate-on-scroll"><?php the_title(); ?></h1>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php if (get_the_content()) : ?>
                <div class="page-content animate-on-scroll" data-delay="200">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>
        <?php endwhile; endif; ?>
    </div>
    <div class="portfolio-filters animate-on-scroll" data-delay="300">
        <button class="btn filter-btn active" data-filter="all">Wszystkie</button>
        <?php 
        $portfolio_categories = get_terms(['taxonomy' => 'portfolio_category', 'hide_empty' => true]);
        if (!empty($portfolio_categories) && !is_wp_error($portfolio_categories)) :
            foreach ($portfolio_categories as $category) : ?>
                <button class="btn filter-btn" data-filter="<?php echo esc_attr($category->slug); ?>">
                    <?php echo esc_html($category->name); ?>
                </button>
            <?php endforeach;
        endif; ?>
    </div>
    <div class="portfolio-grid">
        <?php
        $portfolio_query = new WP_Query(['post_type' => 'portfolio', 'posts_per_page' => -1, 'post_status' => 'publish']);
        if ($portfolio_query->have_posts()) :
            $item_delay = 400;
            while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                $project_categories = get_the_terms(get_the_ID(), 'portfolio_category');
                $category_classes = '';
                if ($project_categories && !is_wp_error($project_categories)) {
                    $category_slugs = array();
                    foreach ($project_categories as $cat) {
                        $category_slugs[] = $cat->slug;
                    }
                    $category_classes = implode(' ', $category_slugs);
                }
                ?>
                <div class="portfolio-item-wrapper animate-on-scroll" data-delay="<?php echo $item_delay; ?>" data-categories="<?php echo esc_attr($category_classes); ?>">
                    <?php get_template_part('template-parts/content', 'portfolio'); ?>
                </div>
                <?php $item_delay += 100; ?>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p class="no-projects">Brak projektów do wyświetlenia.</p>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
