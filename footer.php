    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3><?php bloginfo('name'); ?></h3>
                    <div class="footer-content-row">
                        <div class="footer-logo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="Logo">
                        </div>
                        <p>Profesjonalne usługi graficzne i projektowe. Tworzę unikalne projekty, które wyróżniają się na rynku.</p>
                    </div>
                </div>
                <div class="footer-section">
                    <h3>Kontakt</h3>
                    <div class="social-links">
                        <p>📧 shestiger@gmail.com</p>
                    </div>
                    <div class="footer-socials">
                        <a href="https://www.facebook.com/Grafiki.u.Rudej" class="footer-social-btn" aria-label="Facebook" target="_blank" rel="noopener">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.webp" alt="Facebook" class="footer-social-icon">
                        </a>
                        <a href="https://www.behance.net/grafikiurudej" class="footer-social-btn" aria-label="Behance" target="_blank" rel="noopener">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/behance.webp" alt="Behance" class="footer-social-icon">
                        </a>
                        <a href="https://www.instagram.com/grafiki.u.rudej/" class="footer-social-btn" aria-label="Instagram" target="_blank" rel="noopener">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram.webp" alt="Instagram" class="footer-social-icon">
                        </a>
                        <a href="mailto:shestiger@gmail.com" class="footer-social-btn" aria-label="Email">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mail.webp" alt="Email" class="footer-social-icon">
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="copyright">
                    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Wszystkie prawa zastrzeżone.</p>
                </div>
                <div class="footer-links">
                    <a href="<?php echo site_url('/polityka-prywatnosci'); ?>">Polityka prywatności</a>
                    <a href="<?php echo site_url('/regulamin'); ?>">Regulamin</a>
                </div>
            </div>
        </div>
    </footer>
<?php wp_footer(); ?>
</body>
</html>
