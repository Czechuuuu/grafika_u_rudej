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
        'posts_per_page' => 3,
        'orderby' => 'rand'
      ]);
      if ($featured->have_posts()) :
        $delay = 200;
        while ($featured->have_posts()) : $featured->the_post(); ?>
          <div class="project-item animate-on-scroll" data-delay="<?php echo $delay; ?>">
            <a href="<?php echo site_url('/portfolio?project=' . get_the_ID()); ?>" class="featured-project-link" data-project-id="<?php echo get_the_ID(); ?>">
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
  <section class="video-reels animate-on-scroll">
    <h2 class="animate-on-scroll" data-delay="100">Rolki i video</h2>
    <p class="section-subtitle animate-on-scroll" data-delay="200">Krótko, wyraziście, zapamiętywalnie</p>
    <div class="reels-grid">
      <?php
      $video_projects = new WP_Query([
        'post_type' => 'portfolio',
        'posts_per_page' => 3,
        'orderby' => 'rand',
        'meta_query' => [
          [
            'key' => '_portfolio_media_type',
            'value' => 'video',
            'compare' => '='
          ],
          [
            'key' => '_portfolio_video_url',
            'value' => '',
            'compare' => '!='
          ]
        ]
      ]);
      
      if ($video_projects->have_posts()) :
        $delay = 300;
        while ($video_projects->have_posts()) : $video_projects->the_post();
          $video_url = get_post_meta(get_the_ID(), '_portfolio_video_url', true);
          $poster = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : '';
          ?>
          <div class="reel-item animate-on-scroll" data-delay="<?php echo $delay; ?>">
            <video class="reel-video" loop muted playsinline preload="metadata" 
                   poster="<?php echo esc_url($poster); ?>"
                   data-project-id="<?php echo get_the_ID(); ?>"
                   data-project-title="<?php echo esc_attr(get_the_title()); ?>">
              <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
              Twoja przeglądarka nie obsługuje video.
            </video>
            <div class="reel-overlay">
              <div class="reel-play-btn">▶</div>
              <div class="reel-title"><?php the_title(); ?></div>
            </div>
          </div>
          <?php $delay += 100; endwhile;
        wp_reset_postdata();
      else : ?>
        <div class="no-video-message animate-on-scroll" data-delay="300">
          <div class="no-video-icon">🎬</div>
          <h3>Brak video do wyświetlenia</h3>
        </div>
      <?php endif; ?>
    </div>
  </section>
  <section class="about-me animate-on-scroll">
    <h2 class="animate-on-scroll" data-delay="100">O mnie</h2>
    <div class="about-content">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/o-mnie.webp" alt="O mnie" class="animate-on-scroll" data-delay="200">
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
        <h3>Projektowanie graficzne</h3>
        <p>Logo, wizytówki, ulotki, plakaty, katalogi, bannery, grafiki do social mediów – komplet spójnych materiałów, które budują rozpoznawalność i wspierają sprzedaż. Od koncepcji po gotowe pliki do druku i online.</p>
      </div>
      <div class="service animate-on-scroll" data-delay="300">
        <span class="icon">📱</span>
        <h3>Grafiki do social mediów</h3>
        <p>Nie tylko ładne obrazki – projektuję grafiki, które zatrzymują uwagę i pasują do algorytmu.</p>
      </div>
      <div class="service animate-on-scroll" data-delay="400">
      <span class="icon">📢</span>
        <h3>Prowadzenie social media</h3>
        <p>Facebook, Instagram, LinkedIn – od A do Z. Regularność, strategia i kreatywność w jednym.</p>
      </div>
    </div>
    <div class="services-cta animate-on-scroll" data-delay="500">
      <a href="<?php echo site_url('/uslugi'); ?>" class="btn primary-btn">Zobacz wszystkie usługi</a>
    </div>
  </section>
</main>
<?php get_footer(); ?>
