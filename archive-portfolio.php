

<?php get_header(); ?>
<div class="portfolio-archive-wrapper fade-in">
  <h1 class="archive-title">Portfolio</h1>
  <div class="portfolio-filters">
    <!-- Przykładowe filtry, można rozbudować dynamicznie -->
    <button class="btn active">Wszystkie</button>
    <button class="btn">Grafika</button>
    <button class="btn">Strony www</button>
    <button class="btn">Logo</button>
  </div>
  <div class="portfolio-grid">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="portfolio-item fade-in">
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
    <?php endwhile; ?>
  </div>
</div>
<?php get_footer(); ?>
