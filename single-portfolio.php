

<?php get_header(); ?>
<div class="single-portfolio-main">
  <?php if ( has_post_thumbnail() ) : ?>
    <?php the_post_thumbnail('large'); ?>
  <?php endif; ?>
  <h1 class="single-portfolio-title"><?php the_title(); ?></h1>
  <div class="single-portfolio-desc"><?php the_content(); ?></div>
  <?php
  // Przykładowa galeria (jeśli masz ACF lub inną galerię, tu można ją podpiąć)
  if ( function_exists('get_field') && get_field('galeria') ) :
    $galeria = get_field('galeria');
    echo '<div class="single-portfolio-gallery">';
    foreach ( $galeria as $img ) {
      echo '<img src="' . esc_url($img['sizes']['medium_large']) . '" alt="">';
    }
    echo '</div>';
  endif;
  ?>
  <a href="<?php echo get_post_type_archive_link('portfolio'); ?>" class="back-to-portfolio btn">← Powrót do portfolio</a>
</div>
<?php get_footer(); ?>
