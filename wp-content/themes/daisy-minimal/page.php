<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('prose lg:prose-xl mx-auto bg-base-100 p-6 md:p-10 shadow-xl rounded-box'); ?>>
        <header class="mb-8">
            <h1 class="text-4xl font-bold mb-2"><?php the_title(); ?></h1>
        </header>

        <div class="content">
            <?php the_content(); ?>
        </div>
    </article>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
