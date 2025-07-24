<?php get_header(); ?>
<div class="portfolio-archive-wrapper">
  <h1 class="archive-title animate-on-scroll">Portfolio</h1>
  <div class="portfolio-filters animate-on-scroll" data-delay="200">
    <button class="btn active">Wszystkie</button>
    <button class="btn">Grafika</button>
    <button class="btn">Strony www</button>
    <button class="btn">Logo</button>
  </div>
  <div class="portfolio-grid">
    <?php $item_delay = 300; while ( have_posts() ) : the_post(); ?>
      <div class="portfolio-item animate-on-scroll" data-delay="<?php echo $item_delay; ?>">
        <a href="<?php the_permalink(); ?>">
          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail('large'); ?>
          <?php endif; ?>
          <div class="portfolio-item-title"><?php the_title(); ?></div>
        </a>
        <div class="portfolio-item-excerpt"><?php echo get_the_excerpt(); ?></div>
        <div class="portfolio-item-footer">
          <a href="<?php the_permalink(); ?>" class="btn">Zobacz projekt</a>
        </div>
      </div>
    <?php $item_delay += 100; endwhile; ?>
  </div>
</div>
<?php get_footer(); ?>
