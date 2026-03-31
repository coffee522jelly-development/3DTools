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
        <div class="flex flex-col gap-8">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('card bg-base-100 overflow-hidden ' . esc_attr($card_style)); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <figure><?php the_post_thumbnail('large', array('class' => 'w-full h-auto')); ?></figure>
                    <?php endif; ?>
                    <div class="card-body">
                        <h2 class="card-title text-3xl font-bold mb-2">
                            <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors"><?php the_title(); ?></a>
                        </h2>
                        <div class="text-sm opacity-60 mb-4"><?php echo get_the_date(); ?></div>
                        <div class="prose max-w-none">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="card-actions justify-end mt-4">
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </article>
            <?php endwhile; else : ?>
                <div class="alert alert-info">
                    <span>No posts found.</span>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-12 flex justify-center">
            <?php
            $pagination = get_the_posts_pagination(array('prev_text' => '«', 'next_text' => '»'));
            if ($pagination) {
                $pagination = str_replace('page-numbers', 'join-item btn', $pagination);
                $pagination = str_replace('nav-links', 'join', $pagination);
                echo $pagination;
            }
            ?>
        </div>
    </div>

    <?php if ($show_sidebar) : ?>
        <div class="<?php echo esc_attr($sidebar_class); ?>">
            <?php get_sidebar(); ?>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
