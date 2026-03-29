<?php
function daisy_minimal_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'daisy-minimal'),
    ));
}
add_action('after_setup_theme', 'daisy_minimal_setup');

function daisy_minimal_scripts() {
    // WordPress standard style.css loading
    wp_enqueue_style('daisy-minimal-style', get_stylesheet_uri(), array(), '1.1.0');
}
add_action('wp_enqueue_scripts', 'daisy_minimal_scripts');

function daisy_minimal_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'daisy_minimal_excerpt_length', 999);

// Add customizer setting for theme selection
function daisy_minimal_customize_register($wp_customize) {
    $wp_customize->add_section('daisy_minimal_options', array(
        'title' => __('Theme Settings', 'daisy-minimal'),
        'priority' => 30,
    ));
    $wp_customize->add_setting('daisy_minimal_theme', array(
        'default' => 'light',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('daisy_minimal_theme', array(
        'label' => __('DaisyUI Theme', 'daisy-minimal'),
        'section' => 'daisy_minimal_options',
        'type' => 'select',
        'choices' => array(
            'light' => 'Light',
            'dark' => 'Dark',
            'cupcake' => 'Cupcake',
            'bumblebee' => 'Bumblebee',
            'emerald' => 'Emerald',
            'corporate' => 'Corporate',
            'synthwave' => 'Synthwave',
            'retro' => 'Retro',
            'cyberpunk' => 'Cyberpunk',
            'valentine' => 'Valentine',
            'halloween' => 'Halloween',
            'garden' => 'Garden',
            'forest' => 'Forest',
            'aqua' => 'Aqua',
            'lofi' => 'Lofi',
            'pastel' => 'Pastel',
            'fantasy' => 'Fantasy',
            'wireframe' => 'Wireframe',
            'black' => 'Black',
            'luxury' => 'Luxury',
            'dracula' => 'Dracula',
            'cmyk' => 'CMYK',
            'autumn' => 'Autumn',
            'business' => 'Business',
            'acid' => 'Acid',
            'lemonade' => 'Lemonade',
            'night' => 'Night',
            'coffee' => 'Coffee',
            'winter' => 'Winter',
        ),
    ));
}
add_action('customize_register', 'daisy_minimal_customize_register');
