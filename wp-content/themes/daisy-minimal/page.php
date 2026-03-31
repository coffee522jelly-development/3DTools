<?php get_header();
$layout = get_theme_mod('daisy_minimal_layout', 'right-sidebar');
$card_style = get_theme_mod('daisy_minimal_card_style', 'shadow-xl');
$show_sidebar = ($layout !== 'full-width' && is_active_sidebar('sidebar-1'));

// Layout logic: Main content is always first on mobile.
// On desktop, main content is first if right-sidebar or full-width, else last if left-sidebar.
$main_class = $show_sidebar ? 'lg:col-span-2 order-first ' : 'lg:col-span-3 order-first ';
$main_class .= ($layout === 'left-sidebar' && $show_sidebar) ? 'lg:order-last' : 'lg:order-first';

$sidebar_class = ($layout === 'left-sidebar') ? 'order-last lg:order-first' : 'order-last lg:order-last';
?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="<?php echo esc_attr($main_class); ?>">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('prose lg:prose-xl mx-auto bg-base-100 p-6 md:p-10 rounded-box ' . esc_attr($card_style)); ?>>
                <header class="mb-8 not-prose">
                    <h1 class="text-4xl font-bold mb-2"><?php the_title(); ?></h1>
                </header>

                <div class="content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>

    <?php if ($show_sidebar) : ?>
        <div class="<?php echo esc_attr($sidebar_class); ?>">
            <?php get_sidebar(); ?>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
