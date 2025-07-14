<?php
get_header(); ?>
<div class="contact-page">
    <div class="container">
        <div class="contact-hero">
            <div class="contact-hero-content">
                <h1>Skontaktuj się ze mną</h1>
                <p>Masz projekt do realizacji? Napisz do mnie - odpowiem tak szybko jak to możliwe!</p>
            </div>
        </div>
        <div class="contact-content">
            <div class="contact-form-section">
                <h2>Napisz do mnie</h2>
                <form class="contact-form" method="post" action="">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Imię i nazwisko *</label>
                            <input type="text" id="name" name="name" placeholder="Twoje imię i nazwisko" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Adres e-mail *</label>
                            <input type="email" id="email" name="email" placeholder="twoj@email.pl" required>
                        </div>
                    </div>
                    <div class="form-group form-group-full">
                        <label for="subject">Temat</label>
                        <input type="text" id="subject" name="subject" placeholder="Temat wiadomości">
                    </div>
                    <div class="form-group form-group-full">
                        <label for="message">Wiadomość *</label>
                        <textarea id="message" name="message" placeholder="Opisz swój projekt lub zadaj pytanie..." rows="6" required></textarea>
                    </div>
                    <button type="submit" class="btn">Wyślij wiadomość</button>
                </form>
            </div>
        </div>
        <div class="contact-social">
            <h3>Znajdź mnie również tutaj</h3>
            <div class="social-links">
                <a href="#" class="social-link" title="Facebook" aria-label="Facebook">📘</a>
                <a href="#" class="social-link" title="Instagram" aria-label="Instagram">📷</a>
                <a href="#" class="social-link" title="LinkedIn" aria-label="LinkedIn">💼</a>
                <a href="#" class="social-link" title="Behance" aria-label="Behance">🎨</a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?> 