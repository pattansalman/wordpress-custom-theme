<?php
add_filter('acf/settings/save_json', function() {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function($paths) {
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

function my_service_assets() {

    // Load CSS
    wp_enqueue_style(
        'my-service-css',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        filemtime( get_template_directory() . '/assets/css/main.css' )
    );

    // Load JS
    wp_enqueue_script(
        'my-service-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        filemtime( get_template_directory() . '/assets/js/main.js' ),
        true
    );

    // Pass AJAX data to JS
    wp_localize_script(
        'my-service-js',
        'myServiceAjax',
        [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
        ]
    );
}

add_action( 'wp_enqueue_scripts', 'my_service_assets' );


function my_service_setup() {
    register_nav_menus([
        'primary_menu' => 'Primary Menu'
    ]);
}
add_action('after_setup_theme', 'my_service_setup');


//creating the table for storing the contact form messages
function my_service_create_contact_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'contact_messages';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        from_user VARCHAR(191) NOT NULL,
        email VARCHAR(191) NOT NULL,
        phone VARCHAR(50),
        message TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}
add_action( 'after_switch_theme', 'my_service_create_contact_table' );


function my_service_register_contact_cpt() {
    register_post_type('contact_message', [
        'labels' => [
            'name' => 'Contact Messages',
            'singular_name' => 'Contact Message'
        ],
        'public'    => false,
        'show_ui'   => true,
        'menu_icon'=> 'dashicons-email',
        'supports' => ['title'],
    ]);
}
add_action('init', 'my_service_register_contact_cpt');


// Handle contact form submissions (admin-post)
add_action('wp_ajax_nopriv_submit_contact_ajax', 'my_service_ajax_contact');
add_action('wp_ajax_submit_contact_ajax', 'my_service_ajax_contact');

function my_service_ajax_contact() {
    global $wpdb;

        // Sanitize
    $from_user = sanitize_text_field($_POST['from_user'] ?? '');
    $email     = sanitize_email($_POST['email'] ?? '');
    $phone     = sanitize_text_field($_POST['phone'] ?? '');
    $message   = sanitize_textarea_field($_POST['message'] ?? '');

    if (!$from_user || !$email || !$message) {
        wp_send_json_error(['message' => 'All required fields']);
    }
    // Security
    if (
        ! isset($_POST['nonce']) ||
        ! wp_verify_nonce($_POST['nonce'], 'contact_nonce')
    ) {
        wp_send_json_error(['message' => 'Security failed']);
    }

    if(strlen($from_user) <2) {
        wp_send_json_error([
            'message' => 'Name must be at least 2 characters long.'
        ]);
    }

    if (! is_email($email) ) {
        wp_send_json_error([
            'message' => 'Invalid email address.'
        ]);
    }
    if ( $phone && ! preg_match('/^\d{10}$/', $phone) ) {
        wp_send_json_error([
            'message' => 'Phone number must be 10 digits.'
        ]);
    }
    if ( strlen($message) > 1000 ) {
        wp_send_json_error([
            'message' => 'Message must be at most 1000 characters long.'
        ]);
    }


    // Insert into DB
    $table = $wpdb->prefix . 'contact_messages';
    $inserted = $wpdb->insert($table, [
        'from_user' => $from_user,
        'email'     => $email,
        'phone'     => $phone,
        'message'   => $message
    ]);

    if ($inserted) {
        wp_send_json_success(['message' => 'Message sent successfully']);
    } else {
        wp_send_json_error(['message' => 'Database error']);
    }
}
