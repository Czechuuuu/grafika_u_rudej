<?php

function gur_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus([
        'main_menu'   => __('Menu główne',  'grafika_u_rudej'),
    ]);
}
add_action('after_setup_theme', 'gur_setup');

function grafika_u_rudej_enqueue_styles() {
	wp_enqueue_style('grafika-style', get_template_directory_uri() . '/style.css');
    // CSS Files
    wp_enqueue_style('grafika-global', get_template_directory_uri() . '/assets/css/global.css');
    wp_enqueue_style('grafika-header', get_template_directory_uri() . '/assets/css/header.css');
    wp_enqueue_style('grafika-footer', get_template_directory_uri() . '/assets/css/footer.css');
    
    // Animation CSS Files (zoptymalizowane)
    wp_enqueue_style('grafika-animations', get_template_directory_uri() . '/assets/css/animations.css');
    wp_enqueue_style('grafika-custom-animations', get_template_directory_uri() . '/assets/css/custom-animations.css');

    // JavaScript Files (zoptymalizowane)
    wp_enqueue_script('grafika-mobile-menu', get_template_directory_uri() . '/assets/js/mobile-menu.js', array(), '1.0.0', true);
    wp_enqueue_script('grafika-sticky-header', get_template_directory_uri() . '/assets/js/sticky-header.js', array(), '1.0.0', true);
    wp_enqueue_script('grafika-animations', get_template_directory_uri() . '/assets/js/animations.js', array(), '1.0.0', true);

    if (is_front_page()) {
        wp_enqueue_style('grafika-front-page', get_template_directory_uri() . '/assets/css/front-page.css');
    }
    if (is_page('o-mnie')) {
        wp_enqueue_style('grafika-page-o-mnie', get_template_directory_uri() . '/assets/css/page-o-mnie.css');
    }
    if (is_page('uslugi')) {
        wp_enqueue_style('grafika-page-uslugi', get_template_directory_uri() . '/assets/css/page-uslugi.css');
    }
    if (is_page('kontakt')) {
        wp_enqueue_style('grafika-page-kontakt', get_template_directory_uri() . '/assets/css/page-kontakt.css');
        wp_enqueue_script('grafika-contact-modal', get_template_directory_uri() . '/assets/js/contact-modal.js', array(), '1.0.0', true);
    }
    if (is_post_type_archive('portfolio')) {
        wp_enqueue_style('grafika-archive-portfolio', get_template_directory_uri() . '/assets/css/archive-portfolio.css');
    }
    if (is_singular('portfolio')) {
        wp_enqueue_style('grafika-single-portfolio', get_template_directory_uri() . '/assets/css/single-portfolio.css');
    }
}
add_action('wp_enqueue_scripts', 'grafika_u_rudej_enqueue_styles');

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

function gur_handle_contact_form() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form_submit'])) {
        if (!wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
            wp_die('Błąd bezpieczeństwa. Spróbuj ponownie.');
        }

        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $subject = sanitize_text_field($_POST['subject']);
        $message = sanitize_textarea_field($_POST['message']);

        $errors = array();
        
        if (empty($name)) {
            $errors[] = 'Imię i nazwisko jest wymagane.';
        }
        
        if (empty($email) || !is_email($email)) {
            $errors[] = 'Podaj prawidłowy adres e-mail.';
        }
        
        if (empty($message)) {
            $errors[] = 'Wiadomość jest wymagana.';
        }

        if (empty($errors)) {
            $to = get_option('admin_email');
            $email_subject = '[Kontakt ze strony] ' . (!empty($subject) ? $subject : 'Nowa wiadomość');
            
            $email_message = "Nowa wiadomość ze strony internetowej:\n\n";
            $email_message .= "Imię i nazwisko: " . $name . "\n";
            $email_message .= "E-mail: " . $email . "\n";
            $email_message .= "Temat: " . $subject . "\n\n";
            $email_message .= "Wiadomość:\n" . $message . "\n\n";
            $email_message .= "---\n";
            $email_message .= "Ta wiadomość została wysłana ze strony: " . get_site_url();

            $headers = array(
                'Content-Type: text/plain; charset=UTF-8',
                'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
                'Reply-To: ' . $name . ' <' . $email . '>'
            );

            $mail_sent = wp_mail($to, $email_subject, $email_message, $headers);

            if ($mail_sent) {
                wp_redirect(add_query_arg('message', 'success', get_permalink()));
                exit;
            } else {
                wp_redirect(add_query_arg('message', 'error', get_permalink()));
                exit;
            }
        } else {
            wp_redirect(add_query_arg(array('message' => 'validation_error', 'errors' => base64_encode(serialize($errors))), get_permalink()));
            exit;
        }
    }
}
add_action('init', 'gur_handle_contact_form');