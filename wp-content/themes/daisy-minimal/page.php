<?php get_header();
$layout = get_theme_mod('daisy_minimal_layout', 'right-sidebar');
$show_sidebar = ($layout !== 'full-width' && is_active_sidebar('sidebar-1'));
$main_class = $show_sidebar ? 'lg:col-span-2' : 'lg:col-span-3';
?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <?php if ($layout === 'left-sidebar' && $show_sidebar) get_sidebar(); ?>

    <div class="<?php echo esc_attr($main_class); ?>">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('prose lg:prose-xl mx-auto bg-base-100 p-6 md:p-10 shadow-xl rounded-box'); ?>>
                <header class="mb-8 not-prose">
                    <h1 class="text-4xl font-bold mb-2"><?php the_title(); ?></h1>
                </header>

                <div class="content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>

    <?php if ($layout === 'right-sidebar' && $show_sidebar) get_sidebar(); ?>
</div>

<?php get_footer(); ?>
