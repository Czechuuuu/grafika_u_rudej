<?php
/*
Template Name: Kontakt
*/

get_header(); ?>

<div class="contact-page">
    <div class="container">
        <!-- Hero Section -->
        <div class="contact-hero">
            <div class="contact-hero-content">
                <h1>Skontaktuj się ze mną</h1>
                <p>Masz projekt do realizacji? Napisz do mnie - odpowiem tak szybko jak to możliwe!</p>
            </div>
        </div>

        <!-- Contact Content -->
        <div class="contact-content">
            <!-- Contact Form -->
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
                        <textarea id="message" name="message" placeholder="Opisz swój projekt lub zadaj pytanie..." required></textarea>
                    </div>
                    <button type="submit" class="btn">Wyślij wiadomość</button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="contact-info-section">
                <h2>Informacje kontaktowe</h2>
                <ul class="contact-info-list">
                    <li class="contact-info-item">
                        <i class="contact-info-icon">📧</i>
                        <div class="contact-info-content">
                            <h4>E-mail</h4>
                            <p><a href="mailto:kontakt@twojadomena.pl">kontakt@twojadomena.pl</a></p>
                        </div>
                    </li>
                    <li class="contact-info-item">
                        <i class="contact-info-icon">📱</i>
                        <div class="contact-info-content">
                            <h4>Telefon</h4>
                            <p><a href="tel:123456789">123 456 789</a></p>
                        </div>
                    </li>
                    <li class="contact-info-item">
                        <i class="contact-info-icon">🕒</i>
                        <div class="contact-info-content">
                            <h4>Godziny pracy</h4>
                            <p>Poniedziałek - Piątek<br>9:00 - 17:00</p>
                        </div>
                    </li>
                    <li class="contact-info-item">
                        <i class="contact-info-icon">⚡</i>
                        <div class="contact-info-content">
                            <h4>Czas odpowiedzi</h4>
                            <p>Zazwyczaj do 24 godzin</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Social Media -->
        <div class="contact-social">
            <h3>Znajdź mnie również tutaj</h3>
            <div class="social-links">
                <a href="#" class="social-link" title="Facebook">📘</a>
                <a href="#" class="social-link" title="Instagram">📷</a>
                <a href="#" class="social-link" title="LinkedIn">💼</a>
                <a href="#" class="social-link" title="Behance">🎨</a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?> 