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
    wp_enqueue_style(
        'gur-style',
        get_stylesheet_uri(),
        [],
        filemtime( get_stylesheet_directory() . '/style.css' )
    );
}
add_action( 'wp_enqueue_scripts', 'gur_enqueue_assets' );