<?php get_header();
$layout = get_theme_mod('daisy_minimal_layout', 'right-sidebar');
$card_style = get_theme_mod('daisy_minimal_card_style', 'shadow-xl');
$show_sidebar = ($layout !== 'full-width' && is_active_sidebar('sidebar-1'));
$main_class = $show_sidebar ? 'lg:col-span-2' : 'lg:col-span-3';
?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <?php if ($layout === 'left-sidebar' && $show_sidebar) get_sidebar(); ?>

    <div class="<?php echo esc_attr($main_class); ?>">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('prose lg:prose-xl mx-auto bg-base-100 p-6 md:p-10 rounded-box ' . esc_attr($card_style)); ?>>
                <header class="mb-8 not-prose">
                    <h1 class="text-4xl font-bold mb-2"><?php the_title(); ?></h1>
                    <div class="text-sm opacity-70">
                        Posted on <?php echo get_the_date(); ?> by <?php the_author(); ?>
                    </div>
                </header>

                <div class="content">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="mb-8 not-prose">
                            <?php the_post_thumbnail('large', array('class' => 'rounded-xl shadow-md w-full h-auto')); ?>
                        </div>
                    <?php endif; ?>

                    <?php the_content(); ?>
                </div>

                <footer class="mt-12 pt-8 border-t border-base-300 not-prose">
                    <div class="flex justify-between items-center">
                        <div class="flex gap-2">
                            <?php the_category(' '); ?>
                        </div>
                        <div>
                            <?php the_tags('<div class="badge badge-outline mr-1">', '</div><div class="badge badge-outline mr-1">', '</div>'); ?>
                        </div>
                    </div>
                </footer>
            </article>

            <div class="mt-12 flex justify-between max-w-4xl mx-auto">
                <div class="btn btn-ghost"><?php previous_post_link('%link', '« %title'); ?></div>
                <div class="btn btn-ghost"><?php next_post_link('%link', '%title »'); ?></div>
            </div>

            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="mt-12 max-w-4xl mx-auto bg-base-100 p-6 rounded-box <?php echo esc_attr($card_style); ?>">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
        <?php endwhile; endif; ?>
    </div>

    <?php if ($layout === 'right-sidebar' && $show_sidebar) get_sidebar(); ?>
</div>

<?php get_footer(); ?>
