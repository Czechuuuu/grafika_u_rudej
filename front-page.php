<?php get_header(); ?>
<main class="front-page">
  <section class="hero hero-top">
    <div class="hero-container">
      <div class="hero-content">
        <div class="hero-text animate-on-scroll">
          <h1>Usługi graficzne i social media, które realnie wspierają Twój biznes</h1>
        </div>
        <div class="hero-image animate-on-scroll" data-delay="300">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="Grafika U Rudej">
        </div>
      </div>
    </div>
  </section>
  <section class="featured-projects animate-on-scroll">
    <h2 class="animate-on-scroll" data-delay="100">Wybrane projekty</h2>
    <div class="projects-grid">
      <?php
      $featured = new WP_Query([
        'post_type' => 'portfolio',
        'posts_per_page' => 3
      ]);
      if ($featured->have_posts()) :
        $delay = 200;
        while ($featured->have_posts()) : $featured->the_post(); ?>
          <div class="project-item animate-on-scroll" data-delay="<?php echo $delay; ?>">
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('medium'); ?>
              <h3><?php the_title(); ?></h3>
            </a>
          </div>
        <?php $delay += 100; endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </div>
  </section>
  <section class="about-me animate-on-scroll">
    <h2 class="animate-on-scroll" data-delay="100">O mnie</h2>
    <div class="about-content">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/o-mnie.jpg" alt="O mnie" class="animate-on-scroll" data-delay="200">
      <div class="animate-on-scroll" data-delay="300">
        <p>👉 Tworzę skuteczne grafiki i prowadzę social media dla firm i marek, które chcą się wyróżniać i przyciągać klientów. Bez sztucznych obietnic – z doświadczeniem, pomysłem i konkretnym efektem.</p>
        <a href="<?php echo site_url('/o-mnie'); ?>" class="btn primary-btn">Poznaj mnie lepiej</a>
      </div>
    </div>
  </section>
  <section class="services animate-on-scroll fade-in-up">
    <h2 class="animate-on-scroll" data-delay="100">Usługi</h2>
    <div class="services-list">
      <div class="service animate-on-scroll" data-delay="200">
        <span class="icon">🎨</span>
        <h3>Projektowanie logo</h3>
        <p>Opis usługi...</p>
      </div>
      <div class="service animate-on-scroll" data-delay="400">
        <span class="icon">💻</span>
        <h3>Strony internetowe</h3>
        <p>Opis usługi...</p>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
