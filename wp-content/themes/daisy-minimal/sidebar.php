<?php
/**
 * The sidebar containing the main widget area.
 */
if (!is_active_sidebar('sidebar-1')) {
	return;
}
?>

<aside id="secondary" class="widget-area lg:col-span-1 space-y-6">
	<?php dynamic_sidebar('sidebar-1'); ?>
</aside><!-- #secondary -->
