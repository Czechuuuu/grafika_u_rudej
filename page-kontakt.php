<?php
get_header(); 

$message_type = isset($_GET['message']) ? $_GET['message'] : '';
$errors = array();

if ($message_type === 'validation_error' && isset($_GET['errors'])) {
    $errors = unserialize(base64_decode($_GET['errors']));
}
?>

<div class="contact-hero">
    <div class="contact-hero-content">
        <h1>Skontaktuj się ze mną</h1>
        <p>Masz projekt do realizacji? Napisz do mnie - odpowiem tak szybko jak to możliwe!</p>
    </div>
</div>

<div class="contact-page">
    <div class="container">
        <div class="contact-content">
            <div class="contact-form-section">
                <h2>Napisz do mnie</h2>
                <form class="contact-form" method="post" action="">
                    <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Imię i nazwisko *</label>
                            <input type="text" id="name" name="name" placeholder="Twoje imię i nazwisko" value="<?php echo isset($_POST['name']) ? esc_attr($_POST['name']) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Adres e-mail *</label>
                            <input type="email" id="email" name="email" placeholder="twoj@email.pl" value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>" required>
                        </div>
                    </div>
                    <div class="form-group form-group-full">
                        <label for="subject">Temat</label>
                        <input type="text" id="subject" name="subject" placeholder="Temat wiadomości" value="<?php echo isset($_POST['subject']) ? esc_attr($_POST['subject']) : ''; ?>">
                    </div>
                    <div class="form-group form-group-full">
                        <label for="message">Wiadomość *</label>
                        <textarea id="message" name="message" placeholder="Opisz swój projekt lub zadaj pytanie..." rows="6" required><?php echo isset($_POST['message']) ? esc_textarea($_POST['message']) : ''; ?></textarea>
                    </div>
                    <button type="submit" name="contact_form_submit" class="btn">Wyślij wiadomość</button>
                </form>
            </div>
        </div>
        <div class="contact-social">
            <h3>Znajdź mnie również tutaj</h3>
            <div class="social-links">
                <a href="https://www.facebook.com/Grafiki.u.Rudej" class="social-link" title="Facebook" aria-label="Facebook" target="_blank" rel="noopener">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-contact.webp" alt="Facebook">
                </a>
                <a href="https://www.instagram.com/grafiki.u.rudej/" class="social-link" title="Instagram" aria-label="Instagram" target="_blank" rel="noopener">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram-contact.webp" alt="Instagram">
                </a>
                <a href="mailto:shestiger@gmail.com" class="social-link" title="Mail" aria-label="Mail" target="_blank" rel="noopener">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mail-contact.webp" alt="LinkedIn">
                </a>
                <a href="https://www.behance.net/grafikiurudej" class="social-link" title="Behance" aria-label="Behance" target="_blank" rel="noopener">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/behance-contact.webp" alt="Behance">
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modalne okna z komunikatami -->
<?php if ($message_type === 'success'): ?>
    <div id="contact-modal" class="contact-modal">
        <div class="modal-content modal-success">
            <span class="modal-close">&times;</span>
            <div class="modal-icon">✅</div>
            <h3>Wiadomość wysłana!</h3>
            <p>Dziękuję! Twoja wiadomość została wysłana pomyślnie. Odpowiem tak szybko jak to możliwe!</p>
            <button class="modal-btn modal-btn-success" onclick="closeModal()">Zamknij</button>
        </div>
    </div>
<?php elseif ($message_type === 'error'): ?>
    <div id="contact-modal" class="contact-modal">
        <div class="modal-content modal-error">
            <span class="modal-close">&times;</span>
            <div class="modal-icon">❌</div>
            <h3>Błąd wysyłania</h3>
            <p>Wystąpił błąd podczas wysyłania wiadomości. Spróbuj ponownie lub skontaktuj się bezpośrednio przez e-mail.</p>
            <button class="modal-btn modal-btn-error" onclick="closeModal()">Zamknij</button>
        </div>
    </div>
<?php elseif (!empty($errors)): ?>
    <div id="contact-modal" class="contact-modal">
        <div class="modal-content modal-error">
            <span class="modal-close">&times;</span>
            <div class="modal-icon">❌</div>
            <h3>Proszę popraw błędy</h3>
            <ul class="modal-errors">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo esc_html($error); ?></li>
                <?php endforeach; ?>
            </ul>
            <button class="modal-btn modal-btn-error" onclick="closeModal()">Zamknij</button>
        </div>
    </div>
<?php endif; ?>

<?php get_footer(); ?> 