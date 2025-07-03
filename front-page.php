<?php get_header(); ?>

<main class="front-page">

  <!-- HERO -->
  <section class="hero">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero.jpg" alt="Twoje zdjęcie">
    <h1>Twoje hasło przewodnie</h1>
    <a href="<?php echo site_url('/portfolio'); ?>" class="btn">Zobacz portfolio</a>
  </section>

  <!-- WYBRANE PROJEKTY -->
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

  <!-- O MNIE -->
  <section class="about-me">
    <h2>O mnie</h2>
    <div class="about-content">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/o-mnie.jpg" alt="O mnie">
      <div>
        <p>Krótki opis o Tobie. Możesz edytować ten tekst w pliku front-page.php lub dodać pole ACF.</p>
      </div>
    </div>
  </section>

  <!-- USŁUGI -->
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
      <!-- Dodaj kolejne usługi -->
    </div>
  </section>

  <!-- OPINIE (opcjonalnie) -->
  <!--
  <section class="testimonials">
    <h2>Opinie klientów</h2>
    <div class="testimonials-list">
      <blockquote>
        <p>Super współpraca!</p>
        <footer>— Klient 1</footer>
      </blockquote>
      <!-- Dodaj kolejne opinie -->
    </div>
  </section>
  -->

  <!-- KONTAKT / CTA -->
  <section class="contact-cta">
    <h2>Masz pytania? Napisz do mnie!</h2>
    <a href="<?php echo site_url('/kontakt'); ?>" class="btn">Kontakt</a>
  </section>

</main>

<?php get_footer(); ?>