<?php get_header(); ?>

<div class="flex flex-col gap-8">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('card bg-base-100 shadow-xl'); ?>>
            <div class="card-body">
                <h2 class="card-title text-3xl font-bold">
                    <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors"><?php the_title(); ?></a>
                </h2>
                <div class="prose max-w-none mt-4">
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
    $pagination = get_the_posts_pagination(array(
        'prev_text' => '«',
        'next_text' => '»',
    ));

    if ($pagination) {
        // Wrap pagination links in DaisyUI join classes using string replacement
        $pagination = str_replace('page-numbers', 'join-item btn', $pagination);
        $pagination = str_replace('nav-links', 'join', $pagination);
        echo $pagination;
    }
    ?>
</div>

<?php get_footer(); ?>
