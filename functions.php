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
        wp_enqueue_script('grafika-featured-projects', get_template_directory_uri() . '/assets/js/featured-projects.js', array(), '1.0.0', true);
        wp_enqueue_style('grafika-reels', get_template_directory_uri() . '/assets/css/reels.css', array('grafika-front-page'), '1.0.0');
        wp_enqueue_script('grafika-reels', get_template_directory_uri() . '/assets/js/reels.js', array(), '1.0.0', true);
        
        wp_localize_script('grafika-featured-projects', 'grafikaReels', array(
            'portfolioUrl' => site_url('/portfolio'),
            'homeUrl' => home_url()
        ));
        wp_localize_script('grafika-reels', 'grafikaReels', array(
            'portfolioUrl' => site_url('/portfolio'),
            'homeUrl' => home_url()
        ));
        
        wp_enqueue_style('grafika-portfolio-modal', get_template_directory_uri() . '/assets/css/portfolio-modal.css');
        wp_enqueue_script('grafika-portfolio-modal', get_template_directory_uri() . '/assets/js/portfolio-modal.js', array(), '1.0.0', true);
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
        wp_enqueue_script('grafika-file-upload', get_template_directory_uri() . '/assets/js/file-upload.js', array(), '1.0.0', true);
    }
    if (is_page('portfolio')) {
        wp_enqueue_style('grafika-page-portfolio', get_template_directory_uri() . '/assets/css/page-portfolio.css');
        wp_enqueue_style('grafika-portfolio-modal', get_template_directory_uri() . '/assets/css/portfolio-modal.css');
        wp_enqueue_script('grafika-portfolio-filters', get_template_directory_uri() . '/assets/js/portfolio-filters.js', array(), '1.0.0', true);
        wp_enqueue_script('grafika-portfolio-modal', get_template_directory_uri() . '/assets/js/portfolio-modal.js', array(), '1.0.0', true);
    }
    wp_enqueue_style('grafika-global', get_template_directory_uri() . '/assets/css/global.css');
	wp_enqueue_style('grafika-style', get_template_directory_uri() . '/style.css', array('grafika-global', 'grafika-header', 'grafika-footer', 'grafika-custom-animations'));
    wp_enqueue_script('grafika-mobile-menu', get_template_directory_uri() . '/assets/js/mobile-menu.js', array(), '1.0.0', true);
    wp_enqueue_script('grafika-sticky-header', get_template_directory_uri() . '/assets/js/sticky-header.js', array(), '1.0.0', true);
    wp_enqueue_script('grafika-animations', get_template_directory_uri() . '/assets/js/animations.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'grafika_u_rudej_enqueue_styles');

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
        $attachment_path = '';
        
        if (empty($name)) {
            $errors[] = 'Imię i nazwisko jest wymagane.';
        }
        
        if (empty($email) || !is_email($email)) {
            $errors[] = 'Podaj prawidłowy adres e-mail.';
        }
        
        if (empty($message)) {
            $errors[] = 'Wiadomość jest wymagana.';
        }

        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['attachment'];
            $file_name = sanitize_file_name($file['name']);
            $file_size = $file['size'];
            $file_type = $file['type'];
            
            $max_size = 10 * 1024 * 1024;
            if ($file_size > $max_size) {
                $errors[] = 'Załącznik jest za duży. Maksymalny rozmiar to 10MB.';
            }
            
            $allowed_types = array(
                'image/jpeg', 'image/jpg', 'image/png', 'image/gif',
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'text/plain',
                'application/zip',
                'application/x-rar-compressed', 'application/vnd.rar'
            );
            
            if (!in_array($file_type, $allowed_types)) {
                $errors[] = 'Nieprawidłowy format załącznika. Dozwolone formaty: JPG, PNG, GIF, PDF, DOC, DOCX, TXT, ZIP, RAR.';
            }
            
            if (empty($errors)) {
                $upload_dir = wp_upload_dir();
                $upload_path = $upload_dir['path'] . '/' . time() . '_' . $file_name;
                
                if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                    $attachment_path = $upload_path;
                } else {
                    $errors[] = 'Błąd podczas przesyłania załącznika.';
                }
            }
        } elseif (isset($_FILES['attachment']) && $_FILES['attachment']['error'] !== UPLOAD_ERR_NO_FILE) {
            $errors[] = 'Błąd podczas przesyłania załącznika.';
        }

        if (empty($errors)) {
            $to = get_option('admin_email');
            $email_subject = '[Kontakt ze strony] ' . (!empty($subject) ? $subject : 'Nowa wiadomość');
            
            $email_message = "Nowa wiadomość ze strony internetowej:\n\n";
            $email_message .= "Imię i nazwisko: " . $name . "\n";
            $email_message .= "E-mail: " . $email . "\n";
            $email_message .= "Temat: " . $subject . "\n\n";
            $email_message .= "Wiadomość:\n" . $message . "\n\n";
            
            if (!empty($attachment_path)) {
                $email_message .= "Załącznik: " . basename($attachment_path) . "\n\n";
            }
            
            $email_message .= "---\n";
            $email_message .= "Ta wiadomość została wysłana ze strony: " . get_site_url();

            $headers = array(
                'Content-Type: text/plain; charset=UTF-8',
                'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
                'Reply-To: ' . $name . ' <' . $email . '>'
            );

            $attachments = array();
            if (!empty($attachment_path)) {
                $attachments[] = $attachment_path;
            }

            $mail_sent = wp_mail($to, $email_subject, $email_message, $headers, $attachments);

            if (!empty($attachment_path) && file_exists($attachment_path)) {
                unlink($attachment_path);
            }

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

function add_portfolio_video_meta_box() {
    add_meta_box(
        'portfolio-video',
        'Video Portfolio',
        'portfolio_video_callback',
        'portfolio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_portfolio_video_meta_box');

function add_portfolio_gallery_meta_box() {
    add_meta_box(
        'portfolio-gallery',
        'Galeria obrazów',
        'portfolio_gallery_callback',
        'portfolio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_portfolio_gallery_meta_box');

function portfolio_video_callback($post) {
    wp_nonce_field(basename(__FILE__), 'portfolio_video_nonce');
    $video_url = get_post_meta($post->ID, '_portfolio_video_url', true);
    $media_type = get_post_meta($post->ID, '_portfolio_media_type', true);
    if (!$media_type) $media_type = 'image';
    ?>
    <table class="form-table">
        <tr>
            <th><label for="portfolio_media_type">Typ mediów:</label></th>
            <td>
                <select name="portfolio_media_type" id="portfolio_media_type">
                    <option value="image" <?php selected($media_type, 'image'); ?>>Obraz</option>
                    <option value="video" <?php selected($media_type, 'video'); ?>>Video</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="portfolio_video_url">URL Video (MP4):</label></th>
            <td>
                <input type="url" name="portfolio_video_url" id="portfolio_video_url" value="<?php echo esc_attr($video_url); ?>" size="80" />
                <p class="description">Wklej URL do pliku MP4 lub wybierz z biblioteki mediów</p>
            </td>
        </tr>
    </table>
    <?php
}

function portfolio_gallery_callback($post) {
    wp_nonce_field(basename(__FILE__), 'portfolio_gallery_nonce');
    
    wp_enqueue_style('admin-portfolio-gallery', get_template_directory_uri() . '/assets/css/admin-portfolio-gallery.css', array(), '1.0.0');
    wp_enqueue_script('admin-portfolio-gallery', get_template_directory_uri() . '/assets/js/admin-portfolio-gallery.js', array('jquery', 'media-upload', 'thickbox'), '1.0.0', true);
    wp_enqueue_media();
    
    $gallery_images = get_post_meta($post->ID, '_portfolio_gallery_images', true);
    if (!$gallery_images) $gallery_images = array();
    ?>
    <div id="portfolio-gallery-container">
        <p><strong>Galeria dodatkowych obrazów:</strong></p>
        <p class="description">Dodaj dodatkowe obrazy do projektu (np. strony broszury). Pierwszy obraz to zawsze miniatura z "Wyróżniony obraz".</p>
        
        <div id="gallery-images-list">
            <?php if (!empty($gallery_images)) : ?>
                <?php foreach ($gallery_images as $index => $image_id) : ?>
                    <div class="gallery-image-item" data-index="<?php echo $index; ?>">
                        <div class="gallery-image-preview">
                            <?php echo wp_get_attachment_image($image_id, array(100, 100)); ?>
                        </div>
                        <div class="gallery-image-controls">
                            <input type="hidden" name="portfolio_gallery_images[]" value="<?php echo esc_attr($image_id); ?>" />
                            <button type="button" class="button remove-gallery-image">Usuń</button>
                            <button type="button" class="button move-up" <?php echo $index === 0 ? 'disabled' : ''; ?>>↑</button>
                            <button type="button" class="button move-down">↓</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="gallery-actions">
            <button type="button" id="add-gallery-image" class="button button-primary">Dodaj obraz</button>
            <span class="gallery-count">Obrazy w galerii: <span id="gallery-count-number"><?php echo count($gallery_images); ?></span></span>
        </div>
    </div>
    <?php
}

function save_portfolio_video_meta($post_id) {
    if (!isset($_POST['portfolio_video_nonce']) || !wp_verify_nonce($_POST['portfolio_video_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    if (isset($_POST['portfolio_video_url'])) {
        update_post_meta($post_id, '_portfolio_video_url', esc_url_raw($_POST['portfolio_video_url']));
    }

    if (isset($_POST['portfolio_media_type'])) {
        update_post_meta($post_id, '_portfolio_media_type', sanitize_text_field($_POST['portfolio_media_type']));
    }

    return $post_id;
}
add_action('save_post', 'save_portfolio_video_meta');

function save_portfolio_gallery_meta($post_id) {
    if (!isset($_POST['portfolio_gallery_nonce']) || !wp_verify_nonce($_POST['portfolio_gallery_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    if (isset($_POST['portfolio_gallery_images'])) {
        $gallery_images = array();
        foreach ($_POST['portfolio_gallery_images'] as $image_id) {
            $image_id = intval($image_id);
            if ($image_id > 0) {
                $gallery_images[] = $image_id;
            }
        }
        update_post_meta($post_id, '_portfolio_gallery_images', $gallery_images);
    } else {
        delete_post_meta($post_id, '_portfolio_gallery_images');
    }

    return $post_id;
}
add_action('save_post', 'save_portfolio_gallery_meta');
