<?php

add_action('acf/init', function () {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type([
            'name' => 'hero-video-slider',
            'title' => __('HERO VIDEO'),
            'render_template' => get_template_directory() . '/parts/hero-video-slider.php',
            'category' => 'layout',
            'icon' => 'format-video',
            'mode' => 'edit',
            'post_types' => ['page'],
        ]);
        acf_register_block_type([
            'name' => 'hero-video',
            'title' => __('HERO SIMPLE VIDEO'),
            'render_template' => get_template_directory() . '/parts/hero-video.php',
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
            'name' => 'progettazione-png-sequence',
            'title' => __('PROGETTAZIONE SEQUENZA PNG'),
            'render_template' => get_template_directory() . '/parts/progettazione-png-sequence.php',
            'category' => 'layout',
            'icon' => 'image-rotate',
            'mode' => 'edit',
            'post_types' => ['page', 'product'],
        ]);
        acf_register_block_type([
            'name' => 'progettazione-png-sequence-nav',
            'title' => __('PROGETTAZIONE SEQUENZA PNG CON NAV'),
            'render_template' => get_template_directory() . '/parts/progettazione-png-sequence-nav.php',
            'category' => 'layout',
            'icon' => 'image-rotate',
            'mode' => 'edit',
            'post_types' => ['page'],
        ]);
        acf_register_block_type([
            'name' => 'carousel-highlights',
            'title' => __('CAROUSEL HIGHLIGHTS'),
            'render_template' => get_template_directory() . '/parts/carousel-highlights.php',
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
            'post_types' => ['page', 'product', 'settori'],
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
            'name' => 'operative-cards',
            'title' => __('CARD ATTREZZATURE OPERATIVE'),
            'render_template' => get_template_directory() . '/parts/operative-cards.php',
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
            'name' => 'img-txt-2',
            'title' => __('Immagini + testo affiancato variazione'),
            'render_template' => get_template_directory() . '/parts/img-txt-2.php',
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
            'post_types' => ['page', 'product', 'post', 'caso-studio'],
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
            'name' => 'logos-block',
            'title' => __('Blocco loghi'),
            'render_template' => get_template_directory() . '/parts/logos-block.php',
            'category' => 'layout',
            'icon' => 'grid-view',
            'mode' => 'edit',
            'post_types' => ['page', 'settori'],
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
            'name' => 'arredo-text-images-card',
            'title' => __('Arredo testo immagini e card'),
            'render_template' => get_template_directory() . '/parts/arredo-text-images-card.php',
            'category' => 'layout',
            'icon' => 'layout',
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
        acf_register_block_type([
            'name' => 'hero-contacts',
            'title' => __('Hero contatti'),
            'render_template' => get_template_directory() . '/parts/hero-contacts.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page'],
        ]);
        acf_register_block_type([
            'name' => 'contact-form-block',
            'title' => __('Form di contatto'),
            'render_template' => get_template_directory() . '/parts/contact-form-block.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page'],
        ]);
        acf_register_block_type([
            'name' => 'catalogs-block',
            'title' => __('Cataloghi'),
            'render_template' => get_template_directory() . '/parts/catalogs-block.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page'],
        ]);
        acf_register_block_type([
            'name' => 'videos-block',
            'title' => __('Video'),
            'render_template' => get_template_directory() . '/parts/videos-block.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page'],
        ]);
        acf_register_block_type([
            'name' => 'azienda-image-text',
            'title' => __('Azienda immagine + testo'),
            'render_template' => get_template_directory() . '/parts/azienda-image-text.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page'],
        ]);
         acf_register_block_type([
            'name' => 'prefooter-contatti',
            'title' => __('Prefooter contatti'),
            'render_template' => get_template_directory() . '/parts/prefooter-contatti.php',
            'category' => 'layout',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'post_types' => ['page'],
        ]);
    }

    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'group_hero_video',
            'title' => __('Hero video', 'filcar'),
            'fields' => [
                [
                    'key' => 'field_hero_video_label',
                    'label' => __('Titoletto', 'filcar'),
                    'name' => 'label',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_hero_video_title',
                    'label' => __('Titolo', 'filcar'),
                    'name' => 'title',
                    'type' => 'textarea',
                    'rows' => 2,
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_hero_video_text',
                    'label' => __('Testo', 'filcar'),
                    'name' => 'text',
                    'type' => 'textarea',
                    'rows' => 3,
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_hero_video_video',
                    'label' => __('Video', 'filcar'),
                    'name' => 'video',
                    'type' => 'file',
                    'return_format' => 'array',
                    'library' => 'all',
                    'mime_types' => 'mp4,webm,ogv',
                ],
                [
                    'key' => 'field_hero_video_poster',
                    'label' => __('Poster video', 'filcar'),
                    'name' => 'poster',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ],
                [
                    'key' => 'field_hero_video_cta',
                    'label' => __('CTA', 'filcar'),
                    'name' => 'cta',
                    'type' => 'link',
                    'return_format' => 'array',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/hero-video',
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
            'key' => 'group_progettazione_png_sequence',
            'title' => __('Progettazione sequenza PNG', 'filcar'),
            'fields' => [
                [
                    'key' => 'field_progettazione_png_sequence_intro_label',
                    'label' => __('Label intro', 'filcar'),
                    'name' => 'intro_label',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_progettazione_png_sequence_intro_title',
                    'label' => __('Titolo intro', 'filcar'),
                    'name' => 'intro_title',
                    'type' => 'textarea',
                    'rows' => 2,
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_progettazione_png_sequence_intro_text',
                    'label' => __('Testo intro', 'filcar'),
                    'name' => 'intro_text',
                    'type' => 'textarea',
                    'rows' => 4,
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_progettazione_png_sequence_fullscreen_intro',
                    'label' => __('Immagine fullscreen intro', 'filcar'),
                    'name' => 'fullscreen_intro',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ],
                [
                    'key' => 'field_progettazione_png_sequence_points',
                    'label' => __('Punti scroll', 'filcar'),
                    'name' => 'points',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => __('Aggiungi punto', 'filcar'),
                    'sub_fields' => [
                        [
                            'key' => 'field_progettazione_png_sequence_point_title',
                            'label' => __('Titolo', 'filcar'),
                            'name' => 'title',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_progettazione_png_sequence_point_text',
                            'label' => __('Testo', 'filcar'),
                            'name' => 'text',
                            'type' => 'textarea',
                            'rows' => 3,
                            'new_lines' => 'br',
                        ],
                        [
                            'key' => 'field_progettazione_png_sequence_point_progress',
                            'label' => __('Progress sequenza', 'filcar'),
                            'name' => 'sequence_progress',
                            'type' => 'number',
                            'instructions' => __('Percentuale della sequenza in cui questo punto diventa attivo. Es. 25.', 'filcar'),
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                            'append' => '%',
                        ],
                    ],
                ],
                [
                    'key' => 'field_progettazione_png_sequence_frames_folder',
                    'label' => __('Cartella frame PNG', 'filcar'),
                    'name' => 'frames_folder',
                    'type' => 'text',
                    'instructions' => __('Path relativo alla root del tema. I PNG vengono letti in ordine naturale. Es. assets/img/progettazione-sequence', 'filcar'),
                    'default_value' => 'assets/img/progettazione-sequence',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/progettazione-png-sequence',
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
            'key' => 'group_progettazione_png_sequence_nav',
            'title' => __('Progettazione sequenza PNG con navigazione', 'filcar'),
            'fields' => [
                [
                    'key' => 'field_progettazione_png_sequence_nav_theme_variant',
                    'label' => __('Variante colore', 'filcar'),
                    'name' => 'theme_variant',
                    'type' => 'select',
                    'choices' => [
                        'dark' => __('Sfondo scuro, testi bianchi', 'filcar'),
                        'light' => __('Sfondo bianco, testi scuri', 'filcar'),
                    ],
                    'default_value' => 'dark',
                    'return_format' => 'value',
                    'ui' => 1,
                ],
                [
                    'key' => 'field_progettazione_png_sequence_nav_floating_cta',
                    'label' => __('Card CTA floating', 'filcar'),
                    'name' => 'floating_cta',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_progettazione_png_sequence_nav_floating_cta_title',
                            'label' => __('Titolo', 'filcar'),
                            'name' => 'title',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_progettazione_png_sequence_nav_floating_cta_image',
                            'label' => __('Immagine', 'filcar'),
                            'name' => 'image',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                        ],
                        [
                            'key' => 'field_progettazione_png_sequence_nav_floating_cta_link',
                            'label' => __('Link', 'filcar'),
                            'name' => 'link',
                            'type' => 'link',
                            'return_format' => 'array',
                        ],
                    ],
                ],
                [
                    'key' => 'field_progettazione_png_sequence_nav_intro_label',
                    'label' => __('Label intro', 'filcar'),
                    'name' => 'intro_label',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_progettazione_png_sequence_nav_intro_title',
                    'label' => __('Titolo intro', 'filcar'),
                    'name' => 'intro_title',
                    'type' => 'textarea',
                    'rows' => 2,
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_progettazione_png_sequence_nav_intro_text',
                    'label' => __('Testo intro', 'filcar'),
                    'name' => 'intro_text',
                    'type' => 'textarea',
                    'rows' => 4,
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_progettazione_png_sequence_nav_fullscreen_intro',
                    'label' => __('Immagine fullscreen intro', 'filcar'),
                    'name' => 'fullscreen_intro',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ],
                [
                    'key' => 'field_progettazione_png_sequence_nav_sequence_points',
                    'label' => __('Punti sequenza: struttura, modularità, verticalità', 'filcar'),
                    'name' => 'sequence_points',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => __('Aggiungi punto', 'filcar'),
                    'min' => 3,
                    'max' => 3,
                    'sub_fields' => [
                        [
                            'key' => 'field_progettazione_png_sequence_nav_sequence_point_title',
                            'label' => __('Titolo', 'filcar'),
                            'name' => 'title',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_progettazione_png_sequence_nav_sequence_point_text',
                            'label' => __('Testo', 'filcar'),
                            'name' => 'text',
                            'type' => 'textarea',
                            'rows' => 3,
                            'new_lines' => 'br',
                        ],
                        [
                            'key' => 'field_progettazione_png_sequence_nav_sequence_point_frame',
                            'label' => __('Frame stop sequenza', 'filcar'),
                            'name' => 'sequence_frame',
                            'type' => 'number',
                            'instructions' => __('Numero esatto del frame in cui questo punto deve fermare leggermente l’animazione. Il primo frame è 1.', 'filcar'),
                            'min' => 1,
                            'step' => 1,
                            'append' => 'frame',
                        ],
                    ],
                ],
                [
                    'key' => 'field_progettazione_png_sequence_nav_frames_folder',
                    'label' => __('Cartella frame PNG', 'filcar'),
                    'name' => 'frames_folder',
                    'type' => 'text',
                    'instructions' => __('Path relativo alla root del tema. I PNG vengono letti in ordine naturale. Es. assets/img/progettazione-sequence', 'filcar'),
                    'default_value' => 'assets/img/progettazione-sequence',
                ],
                [
                    'key' => 'field_progettazione_png_sequence_nav_ergonomia_title',
                    'label' => __('Titolo ergonomia', 'filcar'),
                    'name' => 'ergonomia_title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_progettazione_png_sequence_nav_ergonomia_text',
                    'label' => __('Testo ergonomia', 'filcar'),
                    'name' => 'ergonomia_text',
                    'type' => 'textarea',
                    'rows' => 5,
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_progettazione_png_sequence_nav_ergonomia_slides',
                    'label' => __('Carousel ergonomia', 'filcar'),
                    'name' => 'ergonomia_slides',
                    'type' => 'repeater',
                    'layout' => 'table',
                    'button_label' => __('Aggiungi slide', 'filcar'),
                    'sub_fields' => [
                        [
                            'key' => 'field_progettazione_png_sequence_nav_ergonomia_slide_image',
                            'label' => __('Immagine', 'filcar'),
                            'name' => 'image',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                        ],
                    ],
                ],
                [
                    'key' => 'field_progettazione_png_sequence_nav_show_elements',
                    'label' => __('Mostra sezione elementi', 'filcar'),
                    'name' => 'show_elements',
                    'type' => 'true_false',
                    'ui' => 1,
                    'default_value' => 0,
                ],
                [
                    'key' => 'field_progettazione_png_sequence_nav_elementi_title',
                    'label' => __('Titolo elementi', 'filcar'),
                    'name' => 'elementi_title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_progettazione_png_sequence_nav_elementi_text',
                    'label' => __('Testo elementi', 'filcar'),
                    'name' => 'elementi_text',
                    'type' => 'textarea',
                    'rows' => 5,
                    'new_lines' => 'br',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/progettazione-png-sequence-nav',
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
            'key' => 'group_carousel_highlights',
            'title' => __('Carousel highlights', 'filcar'),
            'fields' => [
                [
                    'key' => 'field_carousel_highlights_title',
                    'label' => __('Titolo', 'filcar'),
                    'name' => 'title',
                    'type' => 'text',
                    'default_value' => __('Highlights', 'filcar'),
                ],
                [
                    'key' => 'field_carousel_highlights_items',
                    'label' => __('Card highlights', 'filcar'),
                    'name' => 'items',
                    'type' => 'repeater',
                    'instructions' => __('La vista mostra 3 card alla volta: per vedere il pin con scorrimento orizzontale servono almeno 4 card.', 'filcar'),
                    'layout' => 'block',
                    'button_label' => __('Aggiungi card', 'filcar'),
                    'sub_fields' => [
                        [
                            'key' => 'field_carousel_highlights_item_image',
                            'label' => __('Immagine', 'filcar'),
                            'name' => 'image',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                        ],
                        [
                            'key' => 'field_carousel_highlights_item_hover_image',
                            'label' => __('Immagine hover', 'filcar'),
                            'name' => 'hover_image',
                            'type' => 'image',
                            'instructions' => __('Se compilata, sostituisce l’immagine principale al passaggio del mouse/focus.', 'filcar'),
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                        ],
                        [
                            'key' => 'field_carousel_highlights_item_title',
                            'label' => __('Titolo', 'filcar'),
                            'name' => 'title',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_carousel_highlights_item_text',
                            'label' => __('Testo hover', 'filcar'),
                            'name' => 'text',
                            'type' => 'textarea',
                            'instructions' => __('Compare al passaggio del mouse/focus. Le card 1, 4, 7, ecc. restano larghe il doppio.', 'filcar'),
                            'rows' => 4,
                            'new_lines' => 'br',
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/carousel-highlights',
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
            'key' => 'group_logos_block',
            'title' => __('Blocco loghi', 'filcar'),
            'fields' => [
                [
                    'key' => 'field_logos_block_title',
                    'label' => __('Titolo', 'filcar'),
                    'name' => 'title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_logos_block_text',
                    'label' => __('Testo', 'filcar'),
                    'name' => 'text',
                    'type' => 'textarea',
                    'rows' => 3,
                    'new_lines' => 'wpautop',
                ],
                [
                    'key' => 'field_logos_block_logos',
                    'label' => __('Loghi', 'filcar'),
                    'name' => 'logos',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => __('Aggiungi logo', 'filcar'),
                    'sub_fields' => [
                        [
                            'key' => 'field_logos_block_logo_image',
                            'label' => __('Logo', 'filcar'),
                            'name' => 'image',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'thumbnail',
                            'library' => 'all',
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/logos-block',
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
            'key' => 'group_parallax_sector_block',
            'title' => __('Parallax settore', 'filcar'),
            'fields' => [
                [
                    'key' => 'field_parallax_sector_block_items',
                    'label' => __('Blocchi', 'filcar'),
                    'name' => 'items',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => __('Aggiungi blocco', 'filcar'),
                    'sub_fields' => [
                        [
                            'key' => 'field_parallax_sector_block_item_anchor_id',
                            'label' => __('ID ancora', 'filcar'),
                            'name' => 'anchor_id',
                            'type' => 'text',
                            'instructions' => __('Usalo per linkare il blocco dalle card sopra, senza #. Se vuoto viene generato dal titolo.', 'filcar'),
                        ],
                        [
                            'key' => 'field_parallax_sector_block_item_title',
                            'label' => __('Titolo', 'filcar'),
                            'name' => 'title',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_parallax_sector_block_item_text',
                            'label' => __('Testo', 'filcar'),
                            'name' => 'text',
                            'type' => 'wysiwyg',
                            'tabs' => 'all',
                            'toolbar' => 'basic',
                            'media_upload' => 0,
                            'delay' => 0,
                        ],
                        [
                            'key' => 'field_parallax_sector_block_item_image',
                            'label' => __('Immagine', 'filcar'),
                            'name' => 'image',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                        ],
                        [
                            'key' => 'field_parallax_sector_block_item_parallax_speed',
                            'label' => __('Velocità parallasse', 'filcar'),
                            'name' => 'parallax_speed',
                            'type' => 'number',
                            'instructions' => __('Valore consigliato tra 0.10 e 0.20. Usa valori negativi per invertire la direzione.', 'filcar'),
                            'default_value' => 0.14,
                            'step' => 0.01,
                        ],
                        [
                            'key' => 'field_parallax_sector_block_item_cta_label',
                            'label' => __('Label CTA', 'filcar'),
                            'name' => 'cta_label',
                            'type' => 'text',
                            'instructions' => __('Prima riga della card CTA. Può restare vuota.', 'filcar'),
                            'default_value' => __('Scopri', 'filcar'),
                        ],
                        [
                            'key' => 'field_parallax_sector_block_item_cta_type',
                            'label' => __('Tipo link CTA', 'filcar'),
                            'name' => 'cta_type',
                            'type' => 'button_group',
                            'choices' => [
                                'link' => __('Link normale', 'filcar'),
                                'taxonomy' => __('Categoria prodotto', 'filcar'),
                            ],
                            'default_value' => 'link',
                            'return_format' => 'value',
                        ],
                        [
                            'key' => 'field_parallax_sector_block_item_cta_title',
                            'label' => __('Titolo CTA', 'filcar'),
                            'name' => 'cta_title',
                            'type' => 'text',
                            'instructions' => __('Seconda riga della card CTA. Se vuota usa il titolo del link o il nome della categoria.', 'filcar'),
                        ],
                        [
                            'key' => 'field_parallax_sector_block_item_cta_link',
                            'label' => __('Link CTA', 'filcar'),
                            'name' => 'cta_link',
                            'type' => 'link',
                            'return_format' => 'array',
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_parallax_sector_block_item_cta_type',
                                        'operator' => '==',
                                        'value' => 'link',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'key' => 'field_parallax_sector_block_item_cta_taxonomy',
                            'label' => __('Categoria prodotto CTA', 'filcar'),
                            'name' => 'cta_taxonomy',
                            'type' => 'taxonomy',
                            'taxonomy' => 'cat-prod',
                            'field_type' => 'select',
                            'allow_null' => 1,
                            'add_term' => 0,
                            'save_terms' => 0,
                            'load_terms' => 0,
                            'return_format' => 'id',
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_parallax_sector_block_item_cta_type',
                                        'operator' => '==',
                                        'value' => 'taxonomy',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/parallax-sector-block',
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

        acf_add_local_field_group([
            'key' => 'group_operative_cards',
            'title' => __('Card attrezzature operative', 'filcar'),
            'fields' => [
                [
                    'key' => 'field_operative_cards_group',
                    'label' => __('Card attrezzature operative', 'filcar'),
                    'name' => 'operative_cards',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_operative_cards_eyebrow',
                            'label' => __('Titoletto', 'filcar'),
                            'name' => 'eyebrow',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_operative_cards_title',
                            'label' => __('Titolo', 'filcar'),
                            'name' => 'title',
                            'type' => 'textarea',
                            'rows' => 2,
                            'new_lines' => 'br',
                        ],
                        [
                            'key' => 'field_operative_cards_cards',
                            'label' => __('Card', 'filcar'),
                            'name' => 'cards',
                            'type' => 'repeater',
                            'layout' => 'block',
                            'button_label' => __('Aggiungi card', 'filcar'),
                            'min' => 1,
                            'max' => 5,
                            'sub_fields' => [
                                [
                                    'key' => 'field_operative_cards_card_title',
                                    'label' => __('Titolo card', 'filcar'),
                                    'name' => 'title_card',
                                    'type' => 'textarea',
                                    'rows' => 2,
                                    'new_lines' => 'br',
                                ],
                                [
                                    'key' => 'field_operative_cards_card_image_inactive',
                                    'label' => __('Immagine', 'filcar'),
                                    'name' => 'image_inactive',
                                    'type' => 'image',
                                    'return_format' => 'array',
                                    'preview_size' => 'medium',
                                    'library' => 'all',
                                ],
                                [
                                    'key' => 'field_operative_cards_card_image_active',
                                    'label' => __('Immagine attiva', 'filcar'),
                                    'name' => 'image_active',
                                    'type' => 'image',
                                    'return_format' => 'array',
                                    'preview_size' => 'medium',
                                    'library' => 'all',
                                    'instructions' => __('Opzionale. Se vuota viene usata l’immagine principale.', 'filcar'),
                                ],
                                [
                                    'key' => 'field_operative_cards_card_description',
                                    'label' => __('Descrizione', 'filcar'),
                                    'name' => 'description',
                                    'type' => 'wysiwyg',
                                    'tabs' => 'all',
                                    'toolbar' => 'basic',
                                    'media_upload' => 0,
                                    'delay' => 0,
                                ],
                                [
                                    'key' => 'field_operative_card_link_text',
                                    'label' => __('Testo link', 'filcar'),
                                    'name' => 'link_text',
                                    'type' => 'text',
                                ],
                                [
                                    'key'           => 'field_operative_cards_card_taxonomy',
                                    'label'         => __('Categoria collegata', 'filcar'),
                                    'name'          => 'taxonomy_term',
                                    'type'          => 'taxonomy',
                                    'taxonomy'      => 'cat-prod', // sostituisci con la tua tassonomia (es. 'product_cat')
                                    'field_type'    => 'select',   // select = singola scelta
                                    'multiple'      => 0,
                                    'allow_null'    => 1,
                                    'return_format' => 'id',       // oppure 'object'
                                    'save_terms'    => 0,
                                    'load_terms'    => 0,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/operative-cards',
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

add_filter('acf/get_field_groups', function ($field_groups) {
    if (!is_admin()) {
        return $field_groups;
    }

    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    $taxonomy = $screen && !empty($screen->taxonomy) ? $screen->taxonomy : ($_GET['taxonomy'] ?? $_POST['taxonomy'] ?? '');

    if ($taxonomy !== 'categoria-elemento-arredo') {
        return $field_groups;
    }

    return array_values(array_filter($field_groups, static function ($group) {
        return !empty($group['key']) && $group['key'] === 'group_6a107af9e3eb7';
    }));
});
