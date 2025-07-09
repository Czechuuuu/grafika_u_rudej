<?php
function gur_register_portfolio_cpt() {

    $labels = [
        'name'               => __( 'Portfolio', 'grafika_u_rudej' ),
        'singular_name'      => __( 'Projekt', 'grafika_u_rudej' ),
        'add_new'            => __( 'Dodaj nowy', 'grafika_u_rudej' ),
        'add_new_item'       => __( 'Dodaj nowy projekt', 'grafika_u_rudej' ),
        'edit_item'          => __( 'Edytuj projekt', 'grafika_u_rudej' ),
        'new_item'           => __( 'Nowy projekt', 'grafika_u_rudej' ),
        'view_item'          => __( 'Zobacz projekt', 'grafika_u_rudej' ),
        'search_items'       => __( 'Szukaj w portfolio', 'grafika_u_rudej' ),
        'not_found'          => __( 'Nie znaleziono', 'grafika_u_rudej' ),
        'menu_name'          => __( 'Portfolio', 'grafika_u_rudej' ),
        'archives'           => __( 'Archiwum Portfolio', 'grafika_u_rudej' ),
    ];

    register_post_type( 'portfolio', [
        'labels'             => $labels,
        'public'             => true,
        'show_in_rest'       => true,
        'has_archive'        => true,
        'rewrite'            => [ 'slug' => 'portfolio' ],
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'show_in_nav_menus'  => true,
        'taxonomies'         => [ 'portfolio_category' ],
    ] );
}
add_action( 'init', 'gur_register_portfolio_cpt' );

function gur_register_portfolio_taxonomy() {
    $labels = [
        'name'              => __( 'Kategorie projektów', 'grafika_u_rudej' ),
        'singular_name'     => __( 'Kategoria projektu', 'grafika_u_rudej' ),
        'search_items'      => __( 'Szukaj kategorii', 'grafika_u_rudej' ),
        'all_items'         => __( 'Wszystkie kategorie', 'grafika_u_rudej' ),
        'parent_item'       => __( 'Kategoria nadrzędna', 'grafika_u_rudej' ),
        'parent_item_colon' => __( 'Kategoria nadrzędna:', 'grafika_u_rudej' ),
        'edit_item'         => __( 'Edytuj kategorię', 'grafika_u_rudej' ),
        'update_item'       => __( 'Aktualizuj kategorię', 'grafika_u_rudej' ),
        'add_new_item'      => __( 'Dodaj nową kategorię', 'grafika_u_rudej' ),
        'new_item_name'     => __( 'Nazwa nowej kategorii', 'grafika_u_rudej' ),
        'menu_name'         => __( 'Kategorie', 'grafika_u_rudej' ),
    ];

    register_taxonomy( 'portfolio_category', [ 'portfolio' ], [
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'kategoria-projektu' ],
        'show_in_rest'      => true,
    ] );
}
add_action( 'init', 'gur_register_portfolio_taxonomy' );

function gur_register_menus() {
    register_nav_menus( [
        'main_menu'   => __( 'Menu główne',  'grafika_u_rudej' ),
        'footer_menu' => __( 'Menu w stopce', 'grafika_u_rudej' ),
    ] );
}
add_action( 'after_setup_theme', 'gur_register_menus' );

add_theme_support( 'post-thumbnails' );

function gur_enqueue_assets() {
    $theme_version = '1.0';

    // Google Fonts
    wp_enqueue_style('gur-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap', [], null);

    // Główny arkusz stylów motywu (style.css)
    wp_enqueue_style('gur-main-style', get_stylesheet_uri(), [], $theme_version);

    // Globalne style, ładowane zawsze
    wp_enqueue_style('gur-global', get_template_directory_uri() . '/assets/css/global.css', ['gur-main-style'], $theme_version);
    wp_enqueue_style('gur-header', get_template_directory_uri() . '/assets/css/header.css', ['gur-global'], $theme_version);
    wp_enqueue_style('gur-footer', get_template_directory_uri() . '/assets/css/footer.css', ['gur-global'], $theme_version);

    // Warunkowe ładowanie stylów dla konkretnych stron
    if (is_front_page()) {
        wp_enqueue_style('gur-front-page', get_template_directory_uri() . '/assets/css/front-page.css', ['gur-global'], $theme_version);
    } elseif (is_page_template('page-kontakt.php') || is_page('kontakt')) {
        wp_enqueue_style('gur-contact', get_template_directory_uri() . '/assets/css/page-kontakt.css', ['gur-global'], $theme_version);
    } elseif (is_page_template('page-o-mnie.php') || is_page('o-mnie')) {
        wp_enqueue_style('gur-about', get_template_directory_uri() . '/assets/css/page-o-mnie.css', ['gur-global'], $theme_version);
    } elseif (is_page_template('page-uslugi.php') || is_page('uslugi')) {
        wp_enqueue_style('gur-services', get_template_directory_uri() . '/assets/css/page-uslugi.css', ['gur-global'], $theme_version);
    } elseif (is_post_type_archive('portfolio')) {
        wp_enqueue_style('gur-portfolio-archive', get_template_directory_uri() . '/assets/css/archive-portfolio.css', ['gur-global'], $theme_version);
    } elseif (is_singular('portfolio')) {
        wp_enqueue_style('gur-single-portfolio', get_template_directory_uri() . '/assets/css/single-portfolio.css', ['gur-global'], $theme_version);
    }

    // Główny plik JavaScript
    wp_enqueue_script('gur-main-js', get_template_directory_uri() . '/assets/js/main.js', [], $theme_version, true);
}
add_action('wp_enqueue_scripts', 'gur_enqueue_assets');
