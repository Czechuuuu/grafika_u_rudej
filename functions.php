<?php

function gur_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus([
        'main_menu'   => __('Menu główne',  'grafika_u_rudej'),
    ]);
}
add_action('after_setup_theme', 'gur_setup');

function gur_enqueue_styles() {
    wp_enqueue_style(
        'grafika-u-rudej-style',
        get_stylesheet_uri(),
        [],
        filemtime(get_stylesheet_directory() . '/style.css')
    );
    wp_enqueue_script(
        'sticky-header',
        get_template_directory_uri() . '/assets/js/sticky-header.js',
        [],
        filemtime(get_stylesheet_directory() . '/assets/js/sticky-header.js'),
        true
    );
    wp_enqueue_script(
        'smooth-scroll',
        get_template_directory_uri() . '/assets/js/smooth-scroll.js',
        [],
        filemtime(get_stylesheet_directory() . '/assets/js/smooth-scroll.js'),
        true
    );
    wp_enqueue_script(
        'scroll-animations',
        get_template_directory_uri() . '/assets/js/scroll-animations.js',
        [],
        filemtime(get_stylesheet_directory() . '/assets/js/scroll-animations.js'),
        true
    );
    wp_enqueue_script(
        'mobile-menu',
        get_template_directory_uri() . '/assets/js/mobile-menu.js',
        [],
        filemtime(get_stylesheet_directory() . '/assets/js/mobile-menu.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'gur_enqueue_styles');

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