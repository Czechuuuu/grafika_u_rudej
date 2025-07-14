<?php get_header(); ?>
<main class="front-page">
  <section class="hero hero-top">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="Twoje zdjęcie">
    <h1>Usługi graficzne i social media, które realnie wspierają Twój biznes</h1>
    <a href="<?php echo site_url('/portfolio'); ?>" class="btn">Zobacz portfolio</a>
  </section>
  <section class="featured-projects">
    <h2>Wybrane projekty</h2>
    <div class="projects-grid">
      <?php
      $featured = new WP_Query([
        'post_type' => 'portfolio',
        'posts_per_page' => 3
      ]);
      if ($featured->have_posts()) :
        while ($featured->have_posts()) : $featured->the_post(); ?>
          <div class="project-item">
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('medium'); ?>
              <h3><?php the_title(); ?></h3>
            </a>
          </div>
        <?php endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </div>
  </section>
  <section class="about-me">
    <h2>O mnie</h2>
    <div class="about-content">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/o-mnie.jpg" alt="O mnie">
      <div>
        <p>👉 Tworzę skuteczne grafiki i prowadzę social media dla firm i marek, które chcą się wyróżniać i przyciągać klientów. Bez sztucznych obietnic – z doświadczeniem, pomysłem i konkretnym efektem.</p>
      </div>
    </div>
  </section>
  <section class="services">
    <h2>Usługi</h2>
    <div class="services-list">
      <div class="service">
        <span class="icon">🎨</span>
        <h3>Projektowanie logo</h3>
        <p>Opis usługi...</p>
      </div>
      <div class="service">
        <span class="icon">💻</span>
        <h3>Strony internetowe</h3>
        <p>Opis usługi...</p>
      </div>
    </div>
  </section>
    </div>
  </section>
<?php get_footer(); ?>