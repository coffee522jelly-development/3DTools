<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('prose lg:prose-xl mx-auto bg-base-100 p-6 md:p-10 shadow-xl rounded-box'); ?>>
        <header class="mb-8">
            <h1 class="text-4xl font-bold mb-2"><?php the_title(); ?></h1>
            <div class="text-sm opacity-70">
                Posted on <?php echo get_the_date(); ?> by <?php the_author(); ?>
            </div>
        </header>

        <div class="content">
            <?php if (has_post_thumbnail()) : ?>
                <div class="mb-8">
                    <?php the_post_thumbnail('large', array('class' => 'rounded-xl shadow-md w-full h-auto')); ?>
                </div>
            <?php endif; ?>

            <?php the_content(); ?>
        </div>

        <footer class="mt-12 pt-8 border-t border-base-300">
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
        <div><?php previous_post_link('%link', '« Previous: %title'); ?></div>
        <div><?php next_post_link('%link', 'Next: %title »'); ?></div>
    </div>

    <?php if (comments_open() || get_comments_number()) : ?>
        <div class="mt-12 max-w-4xl mx-auto bg-base-100 p-6 rounded-box shadow">
            <?php comments_template(); ?>
        </div>
    <?php endif; ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
