<?php get_header(); ?>

<div class="hero min-h-[60vh] bg-base-200 rounded-box">
  <div class="hero-content text-center">
    <div class="max-w-md">
      <h1 class="text-5xl font-bold">404</h1>
      <p class="py-6 text-2xl">Page Not Found</p>
      <p class="mb-8 opacity-70">The page you're looking for doesn't exist or has been moved.</p>
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Go Home</a>
    </div>
  </div>
</div>

<?php get_footer(); ?>
