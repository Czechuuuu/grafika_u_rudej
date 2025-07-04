<?php
/*
Template Name: Kontakt
*/

get_header(); ?>

<main class="wrap contact-page">
    <div class="contact-hero">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
    </div>

    <div class="contact-content">
        <div class="contact-info">
            <h2>Dane kontaktowe</h2>
            <div class="contact-details">
                <div class="contact-item">
                    <span class="icon">📧</span>
                    <div>
                        <h3>Email</h3>
                        <p><a href="mailto:kontakt@twoja-domena.pl">kontakt@twoja-domena.pl</a></p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <span class="icon">📱</span>
                    <div>
                        <h3>Telefon</h3>
                        <p><a href="tel:+48123456789">+48 123 456 789</a></p>
                    </div>
                </div>

                <div class="contact-item">
                    <span class="icon">📍</span>
                    <div>
                        <h3>Lokalizacja</h3>
                        <p>Warszawa, Polska<br>Pracuję zdalnie z klientami z całej Polski</p>
                    </div>
                </div>

                <div class="contact-item">
                    <span class="icon">⏰</span>
                    <div>
                        <h3>Godziny pracy</h3>
                        <p>Poniedziałek - Piątek: 9:00 - 17:00<br>Weekendy: po uzgodnieniu</p>
                    </div>
                </div>
            </div>

            <div class="social-links">
                <h3>Znajdź mnie w mediach społecznościowych</h3>
                <div class="social-grid">
                    <a href="#" class="social-link">
                        <span class="icon">💼</span>
                        <span>LinkedIn</span>
                    </a>
                    <a href="#" class="social-link">
                        <span class="icon">🎨</span>
                        <span>Behance</span>
                    </a>
                    <a href="#" class="social-link">
                        <span class="icon">📱</span>
                        <span>Instagram</span>
                    </a>
                    <a href="#" class="social-link">
                        <span class="icon">🐦</span>
                        <span>Twitter</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="contact-form">
            <h2>Wyślij wiadomość</h2>
            <p>Opowiedz mi o swoim projekcie, a odpowiem w ciągu 24 godzin.</p>
            
            <?php if (function_exists('wpcf7_contact_form')) : ?>
                <!-- Contact Form 7 -->
                <?php echo do_shortcode('[contact-form-7 id="1" title="Formularz kontaktowy"]'); ?>
            <?php else : ?>
                <!-- Podstawowy formularz HTML -->
                <form class="contact-form-basic" method="post" action="">
                    <div class="form-group">
                        <label for="name">Imię i nazwisko *</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefon</label>
                        <input type="tel" id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="service">Rodzaj usługi</label>
                        <select id="service" name="service">
                            <option value="">Wybierz usługę</option>
                            <option value="logo">Projektowanie logo</option>
                            <option value="branding">Identyfikacja wizualna</option>
                            <option value="social">Grafiki na social media</option>
                            <option value="illustration">Ilustracje</option>
                            <option value="dtp">Materiały DTP</option>
                            <option value="web">Grafika na strony WWW</option>
                            <option value="other">Inne</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="budget">Budżet</label>
                        <select id="budget" name="budget">
                            <option value="">Wybierz przedział</option>
                            <option value="500-1000">500 - 1000 zł</option>
                            <option value="1000-3000">1000 - 3000 zł</option>
                            <option value="3000-5000">3000 - 5000 zł</option>
                            <option value="5000+">Powyżej 5000 zł</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="deadline">Termin realizacji</label>
                        <select id="deadline" name="deadline">
                            <option value="">Wybierz termin</option>
                            <option value="urgent">Pilnie (1-2 tygodnie)</option>
                            <option value="normal">Normalnie (3-4 tygodnie)</option>
                            <option value="flexible">Elastycznie (1-2 miesiące)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Opis projektu *</label>
                        <textarea id="message" name="message" rows="6" required placeholder="Opowiedz mi o swoim projekcie, celach i oczekiwaniach..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="privacy" required>
                            <span>Wyrażam zgodę na przetwarzanie moich danych osobowych zgodnie z polityką prywatności *</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Wyślij wiadomość</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="map-section">
        <h2>Gdzie mnie znajdziesz</h2>
        <div class="map-container">
            <!-- Tutaj możesz dodać mapę Google Maps lub OpenStreetMap -->
            <div class="map-placeholder">
                <p>🌍 Warszawa, Polska</p>
                <p>Pracuję zdalnie z klientami z całej Polski i zagranicy</p>
            </div>
        </div>
    </div>

    <div class="faq-contact">
        <h2>Często zadawane pytania</h2>
        <div class="faq-list">
            <div class="faq-item">
                <h3>Jak długo czeka się na odpowiedź?</h3>
                <p>Odpowiadam na wszystkie wiadomości w ciągu 24 godzin w dni robocze.</p>
            </div>
            <div class="faq-item">
                <h3>Czy pracujesz z klientami z zagranicy?</h3>
                <p>Tak, współpracuję z klientami z całej Europy. Komunikacja w języku polskim lub angielskim.</p>
            </div>
            <div class="faq-item">
                <h3>Czy mogę umówić się na rozmowę telefoniczną?</h3>
                <p>Oczywiście! Po wstępnej rozmowie mailowej możemy umówić się na call, aby omówić szczegóły projektu.</p>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?> 