<?php
function daisy_minimal_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'daisy-minimal'),
    ));
}
add_action('after_setup_theme', 'daisy_minimal_setup');

function daisy_minimal_scripts() {
    wp_enqueue_style('daisy-minimal-style', get_template_directory_uri() . '/dist/output.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'daisy_minimal_scripts');

function daisy_minimal_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'daisy_minimal_excerpt_length', 999);
