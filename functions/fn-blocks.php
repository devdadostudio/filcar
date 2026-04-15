<?php

add_action('acf/init', function () {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type([
            'name' => 'hero-product',
            'title' => __('HERO PRODUCT'),
            'render_template' => get_template_directory() . '/parts/products/hero-products-static.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
        acf_register_block_type([
            'name' => 'text-centered-img',
            'title' => __('TESTO CENTRATO CON IMMAGINE'),
            'render_template' => get_template_directory() . '/parts/products/text-centered-img.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
    }
});