<?php
get_header(); ?>
<div class="services-hero animate-on-scroll">
  <h1>Moje usługi</h1>
  <p>Profesjonalne usługi graficzne dostosowane do Twoich potrzeb</p>
</div>
<div class="services-main">
  <div class="services-container">
    <div class="services-grid">
      <div class="service-card animate-on-scroll" data-delay="200">
        <div class="service-content">
          <h3>Logo i identyfikacja wizualna</h3>
          <p>Zaprojektuję logo, które odda charakter Twojej marki. Prosto, estetycznie i bez banału.</p>
          <a href="<?php echo home_url('/kontakt'); ?>" class="btn">Zamów projekt</a>
        </div>
      </div>
      <div class="service-card animate-on-scroll" data-delay="400">
        <div class="service-content">
          <h3>Materiały do druku</h3>
          <p>Ulotki, plakaty, wizytówki, zaproszenia, papier firmowy – wszystko w jednym stylu, gotowe do druku.</p>
          <a href="<?php echo home_url('/kontakt'); ?>" class="btn">Zamów projekt</a>
        </div>
      </div>
      <div class="service-card animate-on-scroll" data-delay="600">
        <div class="service-content">
          <h3>Grafiki do social mediów</h3>
          <p>Nie tylko ładne obrazki – projektuję grafiki, które zatrzymują uwagę i pasują do algorytmu.</p>
          <a href="<?php echo home_url('/kontakt'); ?>" class="btn">Zamów projekt</a>
        </div>
      </div>
      <div class="service-card">
        <div class="service-content">
          <h3>Oznakowanie i tablice</h3>
          <p>Przygotuję materiały, które są czytelne, estetyczne i zgodne z przepisami (np. w branży medycznej).</p>
          <a href="<?php echo home_url('/kontakt'); ?>" class="btn">Zamów projekt</a>
        </div>
      </div>
    </div>

        <!-- Sekcja Social Media -->
    <div class="social-media-section">
      <div class="social-media-container">
        <h2>Prowadzenie social media</h2>
        <div class="social-media-grid">
          <div class="social-media-card">
            <div class="social-media-icon">✅</div>
            <h3>Facebook, Instagram, LinkedIn – od A do Z</h3>
            <p>Zaplanuję, stworzę i opublikuję content dopasowany do Twojej branży i klientów. Regularność, strategia i kreatywność w jednym.</p>
          </div>
          <div class="social-media-card">
            <div class="social-media-icon">✅</div>
            <h3>Posty, rolki, stories</h3>
            <p>Dostarczam gotowe materiały – przemyślane teksty, spójne grafiki, pomysły na rolki i relacje.</p>
          </div>
          <div class="social-media-card">
            <div class="social-media-icon">✅</div>
            <h3>Dla kogo?</h3>
            <p>Wspieram małe firmy, gabinety, rękodzielników, fundacje, trenerów, szkoleniowców i inne lokalne biznesy.</p>
          </div>
        </div>
        <div class="social-media-cta">
          <p>📌 Chcesz mieć spokój i regularne posty na Twoim profilu? Odezwij się – mam jeszcze wolne miejsce na współpracę!</p>
          <a href="<?php echo home_url('/kontakt'); ?>" class="btn">Skontaktuj się ze mną</a>
        </div>
      </div>
    </div>
    
    <!-- Sekcja cennika -->
    <div class="pricing-section">
      <div class="pricing-container">
        <h2>Cennik usług</h2>
        <div class="pricing-grid">
          <div class="pricing-item">
            <h4>Logo</h4>
            <span class="price">600 zł</span>
          </div>
          <div class="pricing-item">
            <h4>Ulotka dwustronna</h4>
            <span class="price">200 zł</span>
          </div>
          <div class="pricing-item">
            <h4>Post graficzny</h4>
            <span class="price">50 zł</span>
          </div>
          <div class="pricing-item">
            <h4>Materiały szkoleniowe</h4>
            <span class="price">50 zł / strona</span>
          </div>
          <div class="pricing-item">
            <h4>Social media</h4>
            <span class="price">Wycena indywidualna</span>
          </div>
        </div>
      </div>
    </div>
    
    <div class="services-cta">
      <h3>Potrzebujesz czegoś nietypowego?</h3>
      <p>Masz pomysł na niestandardowy projekt? Skontaktuj się ze mną - razem znajdziemy idealne rozwiązanie!</p>
      <a href="<?php echo home_url('/kontakt'); ?>" class="btn">Napisz do mnie</a>
    </div>
  </div>
</div>
<?php get_footer(); ?> 