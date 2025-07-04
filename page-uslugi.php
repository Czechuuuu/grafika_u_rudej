<?php
/*
Template Name: Usługi
*/

get_header(); ?>

<main class="wrap services-page">
    <div class="services-hero">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
    </div>

    <div class="services-grid">
        <div class="service-card">
            <div class="service-icon">🎨</div>
            <h2>Projektowanie logo</h2>
            <p>Tworzenie unikalnych, zapadających w pamięć logotypów, które odzwierciedlają charakter i wartości Twojej marki.</p>
            <ul class="service-features">
                <li>Analiza konkurencji</li>
                <li>Koncepty w różnych wersjach</li>
                <li>Dostosowanie kolorystyki</li>
                <li>Pliki w różnych formatach</li>
            </ul>
            <div class="service-price">
                <span class="price">od 500 zł</span>
            </div>
        </div>

        <div class="service-card">
            <div class="service-icon">🏢</div>
            <h2>Identyfikacja wizualna</h2>
            <p>Kompletna identyfikacja wizualna marki - od logo po materiały firmowe i wytyczne brandbook.</p>
            <ul class="service-features">
                <li>Logo i jego warianty</li>
                <li>Paleta kolorów</li>
                <li>Typografia</li>
                <li>Materiały firmowe</li>
                <li>Brandbook</li>
            </ul>
            <div class="service-price">
                <span class="price">od 1500 zł</span>
            </div>
        </div>

        <div class="service-card">
            <div class="service-icon">📱</div>
            <h2>Projekty na social media</h2>
            <p>Grafiki na Instagram, Facebook, LinkedIn i inne platformy społecznościowe.</p>
            <ul class="service-features">
                <li>Posty na Instagram</li>
                <li>Stories</li>
                <li>Banery na Facebook</li>
                <li>Grafiki na LinkedIn</li>
            </ul>
            <div class="service-price">
                <span class="price">od 50 zł/szt</span>
            </div>
        </div>

        <div class="service-card">
            <div class="service-icon">🎨</div>
            <h2>Ilustracje</h2>
            <p>Unikalne ilustracje do stron internetowych, materiałów marketingowych i publikacji.</p>
            <ul class="service-features">
                <li>Ilustracje wektorowe</li>
                <li>Ilustracje rastrowe</li>
                <li>Ikony i piktogramy</li>
                <li>Ilustracje do książek</li>
            </ul>
            <div class="service-price">
                <span class="price">od 200 zł</span>
            </div>
        </div>

        <div class="service-card">
            <div class="service-icon">📄</div>
            <h2>Materiały DTP</h2>
            <p>Projektowanie materiałów do druku - ulotki, plakaty, katalogi, wizytówki.</p>
            <ul class="service-features">
                <li>Ulotki i foldery</li>
                <li>Plakaty</li>
                <li>Wizytówki</li>
                <li>Katalogi produktowe</li>
                <li>Przygotowanie do druku</li>
            </ul>
            <div class="service-price">
                <span class="price">od 300 zł</span>
            </div>
        </div>

        <div class="service-card">
            <div class="service-icon">💻</div>
            <h2>Grafika na strony WWW</h2>
            <p>Grafiki i elementy wizualne do stron internetowych i aplikacji.</p>
            <ul class="service-features">
                <li>Bannery i hero images</li>
                <li>Ikony i przyciski</li>
                <li>Infografiki</li>
                <li>Mockupy produktów</li>
            </ul>
            <div class="service-price">
                <span class="price">od 150 zł</span>
            </div>
        </div>
    </div>

    <div class="faq-section">
        <h2>Często zadawane pytania</h2>
        <div class="faq-list">
            <div class="faq-item">
                <h3>Jak długo trwa realizacja projektu?</h3>
                <p>Czas realizacji zależy od złożoności projektu. Proste logo to 3-5 dni roboczych, pełna identyfikacja wizualna to 2-3 tygodnie.</p>
            </div>
            <div class="faq-item">
                <h3>Czy mogę wprowadzać zmiany w projekcie?</h3>
                <p>Tak, każdy projekt zawiera 2 rundy poprawek w cenie. Dodatkowe zmiany są płatne.</p>
            </div>
            <div class="faq-item">
                <h3>W jakich formatach otrzymam pliki?</h3>
                <p>Otrzymasz pliki źródłowe (AI, PSD) oraz gotowe do użycia (PDF, PNG, JPG, SVG).</p>
            </div>
            <div class="faq-item">
                <h3>Czy projektujesz strony internetowe?</h3>
                <p>Specjalizuję się w grafice. Do tworzenia stron współpracuję z programistami.</p>
            </div>
        </div>
    </div>

    <div class="cta-section">
        <h2>Zainteresowany współpracą?</h2>
        <p>Napisz do mnie i opowiedz o swoim projekcie!</p>
        <a href="<?php echo site_url('/kontakt'); ?>" class="btn btn-primary">Wyślij zapytanie</a>
    </div>
</main>

<?php get_footer(); ?> 