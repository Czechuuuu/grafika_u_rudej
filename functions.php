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
    
    // Dodajemy JavaScript dla sticky header
    wp_enqueue_script(
        'grafika-u-rudej-script',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        filemtime(get_stylesheet_directory() . '/assets/js/main.js'),
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

function gur_fallback_menu() {
    echo '<ul class="nav-menu">';
    
    // Strona O mnie - sprawdź różne możliwe slugi
    $o_mnie_page = get_page_by_path('o-mnie') ?: get_page_by_title('O mnie');
    if ($o_mnie_page) {
        echo '<li><a href="' . esc_url(get_permalink($o_mnie_page->ID)) . '">O mnie</a></li>';
    }
    
    // Strona Usługi - sprawdź różne możliwe slugi
    $uslugi_page = get_page_by_path('uslugi') ?: get_page_by_title('Usługi');
    if ($uslugi_page) {
        echo '<li><a href="' . esc_url(get_permalink($uslugi_page->ID)) . '">Usługi</a></li>';
    }
    
    // Strona Portfolio
    if (get_post_type_archive_link('portfolio')) {
        echo '<li><a href="' . esc_url(get_post_type_archive_link('portfolio')) . '">Portfolio</a></li>';
    }
    
    // Strona Kontakt - sprawdź różne możliwe slugi
    $kontakt_page = get_page_by_path('kontakt') ?: get_page_by_title('Kontakt');
    if ($kontakt_page) {
        echo '<li><a href="' . esc_url(get_permalink($kontakt_page->ID)) . '">Kontakt</a></li>';
    }
    
    echo '</ul>';
}

// Dodatkowa funkcja fallback dla mobile menu
function gur_mobile_fallback_menu() {
    echo '<ul class="mobile-nav-menu">';
    
    // Strona główna
    echo '<li><a href="' . esc_url(home_url('/')) . '">Strona główna</a></li>';
    
    // Strona O mnie
    $o_mnie_page = get_page_by_path('o-mnie') ?: get_page_by_title('O mnie');
    if ($o_mnie_page) {
        echo '<li><a href="' . esc_url(get_permalink($o_mnie_page->ID)) . '">O mnie</a></li>';
    } else {
        echo '<li><a href="' . esc_url(home_url('/o-mnie/')) . '">O mnie</a></li>';
    }
    
    // Strona Usługi
    $uslugi_page = get_page_by_path('uslugi') ?: get_page_by_title('Usługi');
    if ($uslugi_page) {
        echo '<li><a href="' . esc_url(get_permalink($uslugi_page->ID)) . '">Usługi</a></li>';
    } else {
        echo '<li><a href="' . esc_url(home_url('/uslugi/')) . '">Usługi</a></li>';
    }
    
    // Strona Portfolio
    if (get_post_type_archive_link('portfolio')) {
        echo '<li><a href="' . esc_url(get_post_type_archive_link('portfolio')) . '">Portfolio</a></li>';
    } else {
        echo '<li><a href="' . esc_url(home_url('/portfolio/')) . '">Portfolio</a></li>';
    }
    
    // Strona Kontakt
    $kontakt_page = get_page_by_path('kontakt') ?: get_page_by_title('Kontakt');
    if ($kontakt_page) {
        echo '<li><a href="' . esc_url(get_permalink($kontakt_page->ID)) . '">Kontakt</a></li>';
    } else {
        echo '<li><a href="' . esc_url(home_url('/kontakt/')) . '">Kontakt</a></li>';
    }
    
    echo '</ul>';
}

