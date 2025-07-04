<?php
/*
Template Name: O mnie
*/

get_header(); ?>

<main class="wrap about-page">
    <div class="about-hero">
        <div class="about-image">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large'); ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/o-mnie.jpg" alt="O mnie">
            <?php endif; ?>
        </div>
        <div class="about-intro">
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        </div>
    </div>

    <div class="about-details">
        <div class="experience-section">
            <h2>Doświadczenie</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="year">2023 - obecnie</div>
                    <div class="position">
                        <h3>Grafik Freelancer</h3>
                        <p>Projektowanie logo, identyfikacja wizualna, materiały marketingowe</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="year">2020 - 2023</div>
                    <div class="position">
                        <h3>Grafik w agencji</h3>
                        <p>Projekty dla klientów z różnych branż</p>
                    </div>
                </div>
                <!-- Dodaj więcej pozycji według potrzeb -->
            </div>
        </div>

        <div class="skills-section">
            <h2>Umiejętności</h2>
            <div class="skills-grid">
                <div class="skill-category">
                    <h3>Programy</h3>
                    <ul>
                        <li>Adobe Photoshop</li>
                        <li>Adobe Illustrator</li>
                        <li>Adobe InDesign</li>
                        <li>Figma</li>
                    </ul>
                </div>
                <div class="skill-category">
                    <h3>Specjalizacje</h3>
                    <ul>
                        <li>Projektowanie logo</li>
                        <li>Identyfikacja wizualna</li>
                        <li>Ilustracje</li>
                        <li>Projekty na social media</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="social-section">
            <h2>Znajdź mnie</h2>
            <div class="social-links">
                <a href="#" class="social-link">
                    <span class="icon">📧</span>
                    <span>Email</span>
                </a>
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
            </div>
        </div>

        <div class="cta-section">
            <a href="<?php echo site_url('/kontakt'); ?>" class="btn btn-primary">Napisz do mnie</a>
            <a href="#" class="btn btn-secondary">Pobierz CV</a>
        </div>
    </div>
</main>

<?php get_footer(); ?> 