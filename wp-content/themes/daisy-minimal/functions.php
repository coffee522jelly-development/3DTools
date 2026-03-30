<?php
/**
 * Daisy Minimal Functions and Definitions
 */

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
    wp_enqueue_style('daisy-minimal-style', get_stylesheet_uri(), array(), '1.4.0');
}
add_action('wp_enqueue_scripts', 'daisy_minimal_scripts');

/**
 * Custom Category Walker for DaisyUI Menu (Tree View)
 */
class Daisy_Category_Walker extends Walker_Category {
    public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $cat_name = esc_attr( $category->name );
        $link = '<a href="' . esc_url( get_term_link( $category ) ) . '"';
        if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
            $link .= ' title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
        }
        $link .= '>';
        $link .= $cat_name;
        if ( ! empty( $args['show_count'] ) ) {
            $link .= ' <span class="badge badge-sm badge-ghost ml-auto">' . number_format_i18n( $category->count ) . '</span>';
        }
        $link .= '</a>';

        $output .= "\t<li";
        $css_classes = array(
            'category-item',
            'cat-item-' . $category->term_id,
        );
        if ( ! empty( $args['current_category'] ) ) {
            if ( $category->term_id == $args['current_category'] ) {
                $css_classes[] = 'active font-bold';
            }
        }
        $output .=  ' class="' . esc_attr( implode( ' ', $css_classes ) ) . '">';
        $output .= $link;
    }

    public function end_el( &$output, $page, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "\n<ul class='menu ml-2 border-l border-base-300'>\n";
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "</ul>\n";
    }
}

/**
 * Register Category Tree Widget
 */
class Daisy_Category_Tree_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'daisy_category_tree',
            __('Daisy Category Tree', 'daisy-minimal'),
            array('description' => __('Display categories in a nested tree view using DaisyUI.', 'daisy-minimal'))
        );
    }

    public function widget($args, $instance) {
        $title = ! empty($instance['title']) ? $instance['title'] : __('Categories', 'daisy-minimal');
        echo $args['before_widget'];
        if (! empty($title)) {
            echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        }

        echo '<ul class="menu bg-base-100 w-full rounded-box p-0">';
        wp_list_categories(array(
            'walker' => new Daisy_Category_Walker(),
            'title_li' => '',
            'show_count' => true,
            'hierarchical' => true,
        ));
        echo '</ul>';

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = ! empty($instance['title']) ? $instance['title'] : __('Categories', 'daisy-minimal');
        ?>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'daisy-minimal'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

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
    register_widget('Daisy_Category_Tree_Widget');
}
add_action('widgets_init', 'daisy_minimal_widgets_init');

function daisy_minimal_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'daisy_minimal_excerpt_length', 999);

function daisy_minimal_customize_register($wp_customize) {
    // Theme Design Section
    $wp_customize->add_section('daisy_minimal_options', array(
        'title' => __('Theme Design & Layout', 'daisy-minimal'),
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
            'night' => 'Night', 'coffee' => 'Coffee', 'winter' => 'Winter', 'dim' => 'Dim', 'nord' => 'Nord', 'sunset' => 'Sunset',
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

    // Font Setting
    $wp_customize->add_setting('daisy_minimal_font', array(
        'default' => 'sans',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('daisy_minimal_font', array(
        'label' => __('Font Style', 'daisy-minimal'),
        'section' => 'daisy_minimal_options',
        'type' => 'select',
        'choices' => array(
            'sans' => 'Modern (Sans)',
            'serif' => 'Classic (Serif)',
        ),
    ));

    // Card Style Setting
    $wp_customize->add_setting('daisy_minimal_card_style', array(
        'default' => 'shadow-xl',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('daisy_minimal_card_style', array(
        'label' => __('Post Card Style', 'daisy-minimal'),
        'section' => 'daisy_minimal_options',
        'type' => 'select',
        'choices' => array(
            'shadow-xl' => 'High Shadow (Default)',
            'shadow-md' => 'Small Shadow',
            'card-bordered' => 'Bordered only',
            'card-flat' => 'Flat / Clean',
        ),
    ));
}
add_action('customize_register', 'daisy_minimal_customize_register');
