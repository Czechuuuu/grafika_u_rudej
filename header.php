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
        <div class="container">
            <div class="site-branding">
                <?php if (is_front_page()) : ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                <?php else : ?>
                    <p class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </p>
                <?php endif; ?>
                
                <?php $description = get_bloginfo('description', 'display');
                if ($description || is_customize_preview()) : ?>
                    <p class="site-description"><?php echo $description; ?></p>
                <?php endif; ?>
            </div>

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="menu-toggle-icon"></span>
                    <span class="screen-reader-text">Menu</span>
                </button>
                
                <?php
                wp_nav_menu([
                    'theme_location' => 'main_menu',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'gur_fallback_menu',
                ]);
                ?>
            </nav>
        </div>
    </header>

    <div id="content" class="site-content">
