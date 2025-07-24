<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header id="masthead" class="site-header">
        <div class="header-container">
            <div class="site-branding">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="brand-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="<?php bloginfo('name'); ?>" class="logo">
                    <span class="site-title"><?php bloginfo('name'); ?></span>
                </a>
            </div>

            <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu([
                    'theme_location' => 'main_menu',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'gur_fallback_menu',
                    'exclude'        => get_option('page_on_front'),
                ]);
                ?>
            </nav>

            <!-- Mobile Menu Toggle -->
            <button class="hamburger" aria-label="Menu mobilne">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div>
    <nav class="mobile-menu">
        <button class="mobile-menu-close" aria-label="Zamknij menu">&times;</button>
        <?php
        wp_nav_menu([
            'theme_location' => 'main_menu',
            'menu_class'     => 'mobile-nav-menu',
            'container'      => false,
            'fallback_cb'    => 'gur_fallback_menu',
            'exclude'        => get_option('page_on_front'),
        ]);
        ?>
    </nav>

    <div id="content" class="site-content">
