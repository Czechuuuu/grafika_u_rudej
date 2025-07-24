<?php get_header(); ?>
<div class="single-portfolio-main">
  <?php if ( has_post_thumbnail() ) : ?>
    <div class="animate-on-scroll">
      <?php the_post_thumbnail('large'); ?>
    </div>
  <?php endif; ?>
  <h1 class="single-portfolio-title animate-on-scroll" data-delay="200"><?php the_title(); ?></h1>
  <div class="single-portfolio-desc animate-on-scroll" data-delay="300"><?php the_content(); ?></div>
  <?php
  if ( function_exists('get_field') && get_field('galeria') ) :
    $galeria = get_field('galeria');
    echo '<div class="single-portfolio-gallery animate-on-scroll" data-delay="400">';
    foreach ( $galeria as $index => $img ) {
      $delay = ($index * 100) + 500;
      echo '<img src="' . esc_url($img['sizes']['medium_large']) . '" alt="" class="animate-on-scroll" data-delay="' . $delay . '">';
    }
    echo '</div>';
  endif;
  ?>
  <a href="<?php echo get_post_type_archive_link('portfolio'); ?>" class="back-to-portfolio btn animate-on-scroll" data-delay="600">← Powrót do portfolio</a>
</div>
<?php get_footer(); ?>
