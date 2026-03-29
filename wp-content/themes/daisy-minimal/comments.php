<?php
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area mt-12 pt-8 border-t border-base-300">

	<?php if (have_comments()) : ?>
		<h2 class="text-2xl font-bold mb-6">
			<?php
			$comments_number = get_comments_number();
			if ('1' === $comments_number) {
				printf(_x('One comment on &ldquo;%s&rdquo;', 'comments title', 'daisy-minimal'), get_the_title());
			} else {
				printf(
					_nx(
						'%1$s comment on &ldquo;%2$s&rdquo;',
						'%1$s comments on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'daisy-minimal'
					),
					number_format_i18n($comments_number),
					get_the_title()
				);
			}
			?>
		</h2>

		<ul class="comment-list space-y-6">
			<?php
			wp_list_comments(array(
				'style'      => 'ul',
				'short_ping' => true,
				'callback'   => function($comment, $args, $depth) {
					?>
					<li <?php comment_class('bg-base-200 p-4 rounded-lg'); ?> id="li-comment-<?php comment_ID(); ?>">
						<article id="comment-<?php comment_ID(); ?>" class="comment-body">
							<footer class="comment-meta flex items-center mb-4">
								<div class="avatar mr-4">
									<div class="w-12 rounded-full">
										<?php echo get_avatar($comment, 48); ?>
									</div>
								</div>
								<div class="comment-author-info">
									<b class="font-semibold text-lg"><?php comment_author_link(); ?></b>
									<div class="text-sm opacity-60">
										<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
											<time datetime="<?php comment_time('c'); ?>">
												<?php printf(_x('%1$s at %2$s', '1: date, 2: time'), get_comment_date(), get_comment_time()); ?>
											</time>
										</a>
										<?php edit_comment_link(__('Edit', 'daisy-minimal'), '<span class="edit-link ml-2 text-primary">', '</span>'); ?>
									</div>
								</div>
							</footer>

							<div class="comment-content prose max-w-none">
								<?php comment_text(); ?>
							</div>

							<div class="reply mt-4">
								<?php
								comment_reply_link(array_merge($args, array(
									'add_below' => 'comment',
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
									'before'    => '<div class="btn btn-sm btn-outline btn-secondary">',
									'after'     => '</div>'
								)));
								?>
							</div>
						</article>
					</li>
					<?php
				}
			));
			?>
		</ul>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
			<nav class="comment-navigation mt-8 join" role="navigation">
				<div class="nav-previous join-item btn"><?php previous_comments_link(__('&larr; Older Comments', 'daisy-minimal')); ?></div>
				<div class="nav-next join-item btn"><?php next_comments_link(__('Newer Comments &rarr;', 'daisy-minimal')); ?></div>
			</nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
	?>
		<p class="no-comments mt-4 italic opacity-70"><?php _e('Comments are closed.', 'daisy-minimal'); ?></p>
	<?php endif; ?>

	<?php
	comment_form(array(
		'class_form'         => 'space-y-4 mt-12',
		'title_reply_before' => '<h3 id="reply-title" class="text-2xl font-bold mb-4 text-primary">',
		'title_reply_after'  => '</h3>',
		'comment_field'      => '<div class="form-control"><label class="label"><span class="label-text">Comment</span></label><textarea id="comment" name="comment" class="textarea textarea-bordered h-32" required></textarea></div>',
		'fields'             => array(
			'author' => '<div class="form-control"><label class="label"><span class="label-text">Name</span></label><input id="author" name="author" type="text" class="input input-bordered" required></div>',
			'email'  => '<div class="form-control"><label class="label"><span class="label-text">Email</span></label><input id="email" name="email" type="email" class="input input-bordered" required></div>',
			'url'    => '<div class="form-control"><label class="label"><span class="label-text">Website</span></label><input id="url" name="url" type="url" class="input input-bordered"></div>',
		),
		'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="btn btn-primary mt-4">%4$s</button>',
	));
	?>

</div>
