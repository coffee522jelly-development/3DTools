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
    wp_enqueue_style('daisy-minimal-style', get_stylesheet_uri(), array(), '1.2.0');
}
add_action('wp_enqueue_scripts', 'daisy_minimal_scripts');

function daisy_minimal_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'daisy-minimal'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'daisy-minimal'),
			'before_widget' => '<section id="%1$s" class="widget card bg-base-100 shadow-md mb-6 p-4">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title text-xl font-bold mb-4 border-b-2 border-primary w-fit">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'daisy_minimal_widgets_init');

function daisy_minimal_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'daisy_minimal_excerpt_length', 999);

function daisy_minimal_customize_register($wp_customize) {
    // Theme Design Section
    $wp_customize->add_section('daisy_minimal_options', array(
        'title' => __('Theme Design', 'daisy-minimal'),
        'priority' => 30,
    ));

    // DaisyUI Theme Setting
    $wp_customize->add_setting('daisy_minimal_theme', array(
        'default' => 'light',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('daisy_minimal_theme', array(
        'label' => __('DaisyUI Theme', 'daisy-minimal'),
        'section' => 'daisy_minimal_options',
        'type' => 'select',
        'choices' => array(
            'light' => 'Light', 'dark' => 'Dark', 'cupcake' => 'Cupcake', 'bumblebee' => 'Bumblebee',
            'emerald' => 'Emerald', 'corporate' => 'Corporate', 'synthwave' => 'Synthwave',
            'retro' => 'Retro', 'cyberpunk' => 'Cyberpunk', 'valentine' => 'Valentine',
            'halloween' => 'Halloween', 'garden' => 'Garden', 'forest' => 'Forest',
            'aqua' => 'Aqua', 'lofi' => 'Lofi', 'pastel' => 'Pastel', 'fantasy' => 'Fantasy',
            'wireframe' => 'Wireframe', 'black' => 'Black', 'luxury' => 'Luxury',
            'dracula' => 'Dracula', 'cmyk' => 'CMYK', 'autumn' => 'Autumn',
            'business' => 'Business', 'acid' => 'Acid', 'lemonade' => 'Lemonade',
            'night' => 'Night', 'coffee' => 'Coffee', 'winter' => 'Winter',
        ),
    ));

    // Layout Setting
    $wp_customize->add_setting('daisy_minimal_layout', array(
        'default' => 'right-sidebar',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('daisy_minimal_layout', array(
        'label' => __('Page Layout', 'daisy-minimal'),
        'section' => 'daisy_minimal_options',
        'type' => 'radio',
        'choices' => array(
            'right-sidebar' => 'Right Sidebar',
            'left-sidebar'  => 'Left Sidebar',
            'full-width'    => 'Full Width',
        ),
    ));
}
add_action('customize_register', 'daisy_minimal_customize_register');
