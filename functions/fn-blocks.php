<?php

add_action('acf/init', function () {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type([
            'name' => 'hero-product',
            'title' => __('HERO PRODOTTO'),
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
        acf_register_block_type([
            'name' => 'video-section',
            'title' => __('SEZIONE VIDEO'),
            'render_template' => get_template_directory() . '/parts/products/video-section.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
        acf_register_block_type([
            'name' => 'slider-text',
            'title' => __('SLIDER CON TESTO'),
            'render_template' => get_template_directory() . '/parts/products/slider-text.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
        acf_register_block_type([
            'name' => 'slider-with-external-txt',
            'title' => __('SLIDER CON TESTO ESTERNO'),
            'render_template' => get_template_directory() . '/parts/products/slider-with-external-txt.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
        acf_register_block_type([
            'name' => 'caratteristiche-block',
            'title' => __('BLOCCO CARATTERISTICHE'),
            'render_template' => get_template_directory() . '/parts/products/caratteristiche-block.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
        acf_register_block_type([
            'name' => 'dimensioni-block',
            'title' => __('BLOCCO DIMENSIONI'),
            'render_template' => get_template_directory() . '/parts/products/dimensioni-block.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
        acf_register_block_type([
            'name' => 'block-anchors-static',
            'title' => __('BLOCCO ANCHORS STATICI'),
            'render_template' => get_template_directory() . '/parts/products/block-anchors-static.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
    }
});