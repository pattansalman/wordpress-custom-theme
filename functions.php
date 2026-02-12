<?php

// ACF JSON Sync
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

}

add_action( 'wp_enqueue_scripts', 'my_service_assets' );


add_theme_support('title-tag');


function my_service_setup() {
    register_nav_menus([
        'primary_menu' => 'Primary Menu'
    ]);
}
add_action('after_setup_theme', 'my_service_setup');



