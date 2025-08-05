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
    wp_enqueue_style('grafika-header', get_template_directory_uri() . '/assets/css/header.css');
    wp_enqueue_style('grafika-footer', get_template_directory_uri() . '/assets/css/footer.css');
    wp_enqueue_style('grafika-animations', get_template_directory_uri() . '/assets/css/animations.css');
    wp_enqueue_style('grafika-custom-animations', get_template_directory_uri() . '/assets/css/custom-animations.css');
    if (is_front_page()) {
        wp_enqueue_style('grafika-front-page', get_template_directory_uri() . '/assets/css/front-page.css', array('grafika-custom-animations'), '1.0.0');
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
    if (is_page('portfolio')) {
        wp_enqueue_style('grafika-page-portfolio', get_template_directory_uri() . '/assets/css/page-portfolio.css');
        wp_enqueue_script('grafika-portfolio-filters', get_template_directory_uri() . '/assets/js/portfolio-filters.js', array(), '1.0.0', true);
    }
    wp_enqueue_style('grafika-global', get_template_directory_uri() . '/assets/css/global.css');
	wp_enqueue_style('grafika-style', get_template_directory_uri() . '/style.css', array('grafika-global', 'grafika-header', 'grafika-footer', 'grafika-custom-animations'));
    wp_enqueue_script('grafika-mobile-menu', get_template_directory_uri() . '/assets/js/mobile-menu.js', array(), '1.0.0', true);
    wp_enqueue_script('grafika-sticky-header', get_template_directory_uri() . '/assets/js/sticky-header.js', array(), '1.0.0', true);
    wp_enqueue_script('grafika-animations', get_template_directory_uri() . '/assets/js/animations.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'grafika_u_rudej_enqueue_styles');

// Prosty Custom Post Type dla projektów - jak sprzęt
function gur_register_portfolio_cpt() {
    register_post_type('portfolio', [
        'labels' => [
            'name' => 'Projekty',
            'singular_name' => 'Projekt',
            'add_new_item' => 'Dodaj nowy projekt',
            'edit_item' => 'Edytuj projekt',
            'all_items' => 'Wszystkie projekty',
            'view_item' => 'Zobacz projekt',
            'search_items' => 'Szukaj projektów',
            'not_found' => 'Nie znaleziono projektów',
        ],
        'public' => true,
        'has_archive' => false,
        'publicly_queryable' => false,
        'menu_icon' => 'dashicons-portfolio',
        'menu_position' => 5,
        'supports' => ['title', 'editor', 'thumbnail'],
        'taxonomies' => ['portfolio_category'],
    ]);
}
add_action( 'init', 'gur_register_portfolio_cpt' );

// Kategorie projektów - prostsza wersja
function gur_register_portfolio_taxonomy() {
    register_taxonomy('portfolio_category', ['portfolio'], [
        'labels' => [
            'name' => 'Kategorie projektów',
            'singular_name' => 'Kategoria projektu',
            'add_new_item' => 'Dodaj nową kategorię',
            'edit_item' => 'Edytuj kategorię',
            'all_items' => 'Wszystkie kategorie',
        ],
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'kategoria-projektu'],
    ]);
}
add_action( 'init', 'gur_register_portfolio_taxonomy' );

// Dodaj kolumnę kategorii w liście projektów
add_filter('manage_portfolio_posts_columns', function($columns) {
    $columns['portfolio_category'] = 'Kategoria';
    return $columns;
});

add_action('manage_portfolio_posts_custom_column', function($column, $post_id) {
    if ($column === 'portfolio_category') {
        $categories = get_the_terms($post_id, 'portfolio_category');
        if ($categories && !is_wp_error($categories)) {
            $category_names = array();
            foreach ($categories as $category) {
                $category_names[] = $category->name;
            }
            echo esc_html(implode(', ', $category_names));
        } else {
            echo '-';
        }
    }
}, 10, 2);

// Obsługa formularza kontaktowego
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
