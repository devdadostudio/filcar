<?php

add_action('acf/init', function () {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type([
            'name' => 'hero-video-slider',
            'title' => __('HERO VIDEO SLIDER'),
            'render_template' => get_template_directory() . '/parts/hero-video-slider.php',
            'category' => 'layout',
            'icon' => 'format-video',
            'mode' => 'edit',
            'post_types' => ['page'],
        ]);
        acf_register_block_type([
            'name' => 'innovation-scroll',
            'title' => __('SEZIONE INNOVAZIONE ANIMATA'),
            'render_template' => get_template_directory() . '/parts/innovation-scroll.php',
            'category' => 'layout',
            'icon' => 'images-alt2',
            'mode' => 'edit',
            'post_types' => ['page'],
        ]);
        acf_register_block_type([
            'name' => 'technical-text-scroll',
            'title' => __('TESTO TECNICO ANIMATO'),
            'render_template' => get_template_directory() . '/parts/technical-text-scroll.php',
            'category' => 'layout',
            'icon' => 'editor-alignleft',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
        acf_register_block_type([
            'name' => 'expandable-cards',
            'title' => __('CARD ESPANDIBILI'),
            'render_template' => get_template_directory() . '/parts/expandable-cards.php',
            'category' => 'layout',
            'icon' => 'screenoptions',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
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
            'name' => 'block-anchors',
            'title' => __('BLOCCO ANCHORS'),
            'render_template' => get_template_directory() . '/parts/products/product-anchors-section.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
        acf_register_block_type([
            'name' => 'block-anchors-static',
            'title' => __('BLOCCO ANCHORS STATICI'),
            'render_template' => get_template_directory() . '/parts/products/product-anchors-section-statico.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);

        acf_register_block_type([
            'name' => 'grid-4-cta-img',
            'title' => __('CTA grid: 4 CTA + immagine'),
            'render_template' => get_template_directory() . '/parts/grid-4-cta-img.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);

        acf_register_block_type([
            'name' => 'img-txt',
            'title' => __('Immagini + testo affiancato'),
            'render_template' => get_template_directory() . '/parts/img-txt.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);

        acf_register_block_type([
            'name' => 'txt-cta-carousel',
            'title' => __('Testo + CTA + carosello'),
            'render_template' => get_template_directory() . '/parts/txt-cta-carousel.php',
            'category' => 'layout',
            'icon' => 'format-video',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);

        acf_register_block_type([
            'name' => 'marquee-brands',
            'title' => __('Marquee marchi'),
            'render_template' => get_template_directory() . '/parts/marquee-brands.php',
            'category' => 'layout',
            'icon' => 'format-video',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);

        acf_register_block_type([
            'name' => 'scroll-phrases',
            'title' => __('Scorrimento scritte grandi'),
            'render_template' => get_template_directory() . '/parts/scroll-phrases.php',
            'category' => 'layout',
            'icon' => 'format-video',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);

        acf_register_block_type([
            'name' => 'hero-sector',
            'title' => __('Hero settore'),
            'render_template' => get_template_directory() . '/parts/hero-sector.php',
            'category' => 'layout',
            'icon' => 'cover-image',
            'mode' => 'edit',
            'post_types' => ['settori'],
        ]);

        acf_register_block_type([
            'name' => 'parallax-sector-block',
            'title' => __('Parallax settore'),
            'render_template' => get_template_directory() . '/parts/parallax-sector-block.php',
            'category' => 'layout',
            'icon' => 'cover-image',
            'mode' => 'edit',
            'post_types' => ['settori'],
        ]);

        acf_register_block_type([
            'name' => 'hero-image-hotspots',
            'title' => __('Hero immagine con punti'),
            'render_template' => get_template_directory() . '/parts/hero-image-hotspots.php',
            'category' => 'layout',
            'icon' => 'location-alt',
            'mode' => 'edit',
            'post_types' => ['page', 'elementi-arredo'],
        ]);

        acf_register_block_type([
            'name' => 'img-4-txt-blocks',
            'title' => __('Immagine + 4 blocchi di testo'),
            'render_template' => get_template_directory() . '/parts/img-4-txt-blocks.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
        acf_register_block_type([
            'name' => 'faq',
            'title' => __('FAQ'),
            'render_template' => get_template_directory() . '/parts/faq.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
        acf_register_block_type([
            'name' => 'catalogs-launch',
            'title' => __('Lancio cataloghi'),
            'render_template' => get_template_directory() . '/parts/catalogs-launch.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
        acf_register_block_type([
            'name' => 'hero-simple-text-img',
            'title' => __('Hero semplice con testo e immagine'),
            'render_template' => get_template_directory() . '/parts/hero-simple-text-img.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
        acf_register_block_type([
            'name' => 'sectors-grid',
            'title' => __('Griglia settori'),
            'render_template' => get_template_directory() . '/parts/sectors-grid.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
        acf_register_block_type([
            'name' => 'blog-content',
            'title' => __('Contenuto blog/case study'),
            'render_template' => get_template_directory() . '/parts/blog-content.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['caso-studio', 'post'],
        ]);
    }

    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'group_hero_sector',
            'title' => __('Hero settore', 'filcar'),
            'fields' => [
                [
                    'key' => 'field_hero_sector_title',
                    'label' => __('Titolo hero', 'filcar'),
                    'name' => 'title',
                    'type' => 'textarea',
                    'instructions' => __('Titolo grande della hero. La label sopra arriva dal titolo WordPress del settore.', 'filcar'),
                    'rows' => 3,
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_hero_sector_cards',
                    'label' => __('Card ancore', 'filcar'),
                    'name' => 'cards',
                    'type' => 'repeater',
                    'instructions' => __('Card mostrate in overlay da desktop. Da mobile vengono nascoste.', 'filcar'),
                    'layout' => 'block',
                    'button_label' => __('Aggiungi card', 'filcar'),
                    'sub_fields' => [
                        [
                            'key' => 'field_hero_sector_card_image',
                            'label' => __('Immagine', 'filcar'),
                            'name' => 'image',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                        ],
                        [
                            'key' => 'field_hero_sector_card_title',
                            'label' => __('Titolo', 'filcar'),
                            'name' => 'title',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_hero_sector_card_link',
                            'label' => __('Link ancora', 'filcar'),
                            'name' => 'link',
                            'type' => 'link',
                            'return_format' => 'array',
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/hero-sector',
                    ],
                ],
            ],
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        ]);

        acf_add_local_field_group([
            'key' => 'group_hero_image_hotspots',
            'title' => __('Hero immagine con punti', 'filcar'),
            'fields' => [
                [
                    'key' => 'field_hero_image_hotspots_desktop_image',
                    'label' => __('Immagine desktop', 'filcar'),
                    'name' => 'desktop_image',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ],
                [
                    'key' => 'field_hero_image_hotspots_mobile_image',
                    'label' => __('Immagine mobile', 'filcar'),
                    'name' => 'mobile_image',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ],
                [
                    'key' => 'field_hero_image_hotspots_kicker',
                    'label' => __('Sopratitolo', 'filcar'),
                    'name' => 'kicker',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_hero_image_hotspots_logo_icon',
                    'label' => __('Logo linea', 'filcar'),
                    'name' => 'logo_icon',
                    'type' => 'select',
                    'choices' => [
                        '' => __('Nessun logo', 'filcar'),
                        'icon-logo-dual' => __('Dual', 'filcar'),
                        'icon-logo-mono' => __('Mono', 'filcar'),
                        'icon-logo-infinity' => __('Infinity', 'filcar'),
                    ],
                    'default_value' => '',
                    'return_format' => 'value',
                    'allow_null' => 0,
                    'ui' => 1,
                ],
                [
                    'key' => 'field_hero_image_hotspots_title',
                    'label' => __('Titolo', 'filcar'),
                    'name' => 'title',
                    'type' => 'textarea',
                    'rows' => 2,
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_hero_image_hotspots_text',
                    'label' => __('Testo', 'filcar'),
                    'name' => 'text',
                    'type' => 'textarea',
                    'rows' => 2,
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_hero_image_hotspots_points',
                    'label' => __('Punti', 'filcar'),
                    'name' => 'points',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => __('Aggiungi punto', 'filcar'),
                    'sub_fields' => [
                        [
                            'key' => 'field_hero_image_hotspots_point_label',
                            'label' => __('Testo', 'filcar'),
                            'name' => 'label',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_hero_image_hotspots_point_icon',
                            'label' => __('Icona', 'filcar'),
                            'name' => 'icon',
                            'type' => 'select',
                            'choices' => [
                                '' => __('Nessuna icona', 'filcar'),
                                'icon-icon-anticaduta' => __('Anticaduta', 'filcar'),
                                'icon-icon-aperto' => __('Aperto', 'filcar'),
                                'icon-icon-banchi' => __('Banchi', 'filcar'),
                                'icon-icon-chiuso' => __('Chiuso', 'filcar'),
                                'icon-icon-fissa' => __('Fissa', 'filcar'),
                                'icon-icon-lista' => __('Lista', 'filcar'),
                                'icon-icon-grande' => __('Grande', 'filcar'),
                                'icon-icon-media' => __('Media', 'filcar'),
                                'icon-icon-optional' => __('Optional', 'filcar'),
                                'icon-icon-no-predisposizioni' => __('No predisposizioni', 'filcar'),
                                'icon-icon-predisposizioni-elettriche' => __('Predisposizioni elettriche', 'filcar'),
                                'icon-icon-regolabile' => __('Regolabile', 'filcar'),
                                'icon-icon-sottostruttura' => __('Sottostruttura', 'filcar'),
                                'icon-icon-sovrastruttura' => __('Sovrastruttura', 'filcar'),
                                'icon-icon-standard' => __('Standard', 'filcar'),
                                'icon-ip55' => __('IP55', 'filcar'),
                                'icon-push-to-open' => __('Push to open', 'filcar'),
                                'icon-reversibile' => __('Reversibile', 'filcar'),
                                'icon-soft-close-1' => __('Soft close 1', 'filcar'),
                                'icon-soft-close' => __('Soft close', 'filcar'),
                                'icon-spessore-3-mm' => __('Spessore 3 mm', 'filcar'),
                            ],
                            'default_value' => '',
                            'return_format' => 'value',
                            'allow_null' => 0,
                            'ui' => 1,
                        ],
                        [
                            'key' => 'field_hero_image_hotspots_point_desktop_x',
                            'label' => __('Desktop X', 'filcar'),
                            'name' => 'desktop_x',
                            'type' => 'text',
                            'instructions' => __('Valore percentuale, es. 42.5%', 'filcar'),
                        ],
                        [
                            'key' => 'field_hero_image_hotspots_point_desktop_y',
                            'label' => __('Desktop Y', 'filcar'),
                            'name' => 'desktop_y',
                            'type' => 'text',
                            'instructions' => __('Valore percentuale, es. 38%', 'filcar'),
                        ],
                        [
                            'key' => 'field_hero_image_hotspots_point_label_position',
                            'label' => __('Posizione blocco testo', 'filcar'),
                            'name' => 'label_position',
                            'type' => 'select',
                            'choices' => [
                                'right' => __('Sopra a destra', 'filcar'),
                                'left' => __('Sopra a sinistra', 'filcar'),
                            ],
                            'default_value' => 'right',
                            'return_format' => 'value',
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/hero-image-hotspots',
                    ],
                ],
            ],
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        ]);
    }
    
});
