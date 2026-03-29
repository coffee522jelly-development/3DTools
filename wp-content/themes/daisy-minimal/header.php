<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="<?php echo esc_attr(get_theme_mod('daisy_minimal_theme', 'light')); ?>">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen bg-base-200'); ?>>
    <header class="navbar bg-base-100 shadow-lg px-4 sticky top-0 z-50">
        <div class="flex-1">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-ghost normal-case text-xl font-bold"><?php bloginfo('name'); ?></a>
        </div>
        <div class="flex-none hidden lg:block">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'container' => false,
                'menu_class' => 'menu menu-horizontal px-1 font-semibold',
                'fallback_cb' => false,
            ));
            ?>
        </div>
        <div class="flex-none lg:hidden">
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                </label>
                <div tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main-menu',
                        'container' => false,
                        'menu_class' => 'menu menu-vertical',
                        'fallback_cb' => false,
                    ));
                    ?>
                </div>
            </div>
        </div>
    </header>
    <main class="container mx-auto p-4 md:p-8 max-w-5xl">
