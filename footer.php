    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3><?php bloginfo('name'); ?></h3>
                    <p>Profesjonalne usługi graficzne i projektowe</p>
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <span class="icon">💼</span>
                        </a>
                        <a href="#" class="social-link" aria-label="Behance">
                            <span class="icon">🎨</span>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <span class="icon">📱</span>
                        </a>
                        <a href="#" class="social-link" aria-label="Email">
                            <span class="icon">📧</span>
                        </a>
                    </div>
                </div>

                <div class="footer-section">
                    <h3>Nawigacja</h3>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer_menu',
                        'menu_class'     => 'footer-menu',
                        'container'      => false,
                        'fallback_cb'    => 'gur_footer_fallback_menu',
                    ]);
                    ?>
                </div>

                <div class="footer-section">
                    <h3>Usługi</h3>
                    <ul class="services-list">
                        <li><a href="<?php echo site_url('/uslugi'); ?>">Projektowanie logo</a></li>
                        <li><a href="<?php echo site_url('/uslugi'); ?>">Identyfikacja wizualna</a></li>
                        <li><a href="<?php echo site_url('/uslugi'); ?>">Grafiki na social media</a></li>
                        <li><a href="<?php echo site_url('/uslugi'); ?>">Ilustracje</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Kontakt</h3>
                    <div class="contact-info">
                        <p>📧 kontakt@twoja-domena.pl</p>
                        <p>📱 +48 123 456 789</p>
                        <p>📍 Warszawa, Polska</p>
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
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
