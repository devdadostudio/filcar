<?php
$block = $block ?? [];
$args = $args ?? [];
$field_values = !empty($args['field_values']) && is_array($args['field_values']) ? $args['field_values'] : [];
$field_source = $args['field_source'] ?? null;
$block_id = !empty($args['block_id']) ? $args['block_id'] : (!empty($block['anchor']) ? $block['anchor'] : 'progettazione-png-sequence-nav-' . ($block['id'] ?? uniqid()));

$script_path = get_template_directory() . '/js/progettazione-png-sequence-nav.js';
if (file_exists($script_path)) {
    wp_enqueue_script(
        'filcar-progettazione-png-sequence-nav',
        get_template_directory_uri() . '/js/progettazione-png-sequence-nav.js',
        ['gsap', 'scrollTrigger', 'scrollToPlugin'],
        filemtime($script_path),
        true
    );
}

$get_value = static function ($name, $key = '') use ($block, $field_values, $field_source) {
    if (array_key_exists($name, $field_values)) {
        return $field_values[$name];
    }

    $value = $field_source ? get_field($name, $field_source) : get_field($name);

    if (($value === null || $value === false || $value === '') && $key && !empty($block['data'][$key])) {
        $value = $block['data'][$key];
    }

    return $value;
};

$get_image_data = static function ($image) {
    $image_url = '';
    $image_alt = '';

    if (is_array($image)) {
        $image_url = $image['url'] ?? '';
        $image_alt = $image['alt'] ?? '';
    } elseif (is_numeric($image)) {
        $image_url = wp_get_attachment_image_url((int) $image, 'full') ?: '';
        $image_alt = get_post_meta((int) $image, '_wp_attachment_image_alt', true) ?: '';
    } elseif (is_string($image)) {
        $image_url = $image;
    }

    return [$image_url, $image_alt];
};

$current_term = null;
$queried_object = get_queried_object();

if ($queried_object instanceof WP_Term) {
    $current_term = $queried_object;
} elseif (is_string($field_source) && strpos($field_source, '_') !== false) {
    $term_separator_position = strrpos($field_source, '_');
    $term_taxonomy = substr($field_source, 0, $term_separator_position);
    $term_id = (int) substr($field_source, $term_separator_position + 1);
    $field_source_term = $term_id ? get_term($term_id, $term_taxonomy) : null;

    if ($field_source_term instanceof WP_Term && !is_wp_error($field_source_term)) {
        $current_term = $field_source_term;
    }
}

$theme_variant = $get_value('theme_variant', 'field_progettazione_png_sequence_nav_theme_variant');
$theme_variant = in_array($theme_variant, ['dark', 'light'], true) ? $theme_variant : 'dark';
$sequence_layout = $get_value('sequence_layout', 'field_progettazione_png_sequence_nav_sequence_layout');
$sequence_layout = in_array($sequence_layout, ['standard', 'pinned_composition'], true) ? $sequence_layout : 'standard';
$is_pinned_composition = $sequence_layout === 'pinned_composition';
$section_class = 'progettazione-sequence-nav progettazione-sequence-nav--' . $theme_variant . ' progettazione-sequence-nav--' . $sequence_layout . ' js-progettazione-sequence-nav';

$intro_label = $get_value('intro_label', 'field_progettazione_png_sequence_nav_intro_label');
$intro_title = $get_value('intro_title', 'field_progettazione_png_sequence_nav_intro_title');
$intro_text = $get_value('intro_text', 'field_progettazione_png_sequence_nav_intro_text');
[$intro_image_url, $intro_image_alt] = $get_image_data($get_value('fullscreen_intro', 'field_progettazione_png_sequence_nav_fullscreen_intro'));

$floating_cta = $get_value('floating_cta', 'field_progettazione_png_sequence_nav_floating_cta');
$floating_cta = is_array($floating_cta) ? $floating_cta : [];
$floating_cta_title = $floating_cta['title'] ?? '';
$floating_cta_image = $floating_cta['image'] ?? null;
$floating_cta_link = $floating_cta['link'] ?? null;
$floating_cta_url = '';
$floating_cta_target = '_self';

if (is_array($floating_cta_link)) {
    $floating_cta_url = $floating_cta_link['url'] ?? '';
    $floating_cta_title = $floating_cta_title ?: ($floating_cta_link['title'] ?? '');
    $floating_cta_target = !empty($floating_cta_link['target']) ? $floating_cta_link['target'] : '_self';
} elseif (is_string($floating_cta_link)) {
    $floating_cta_url = $floating_cta_link;
}

[$floating_cta_image_url, $floating_cta_image_alt] = $get_image_data($floating_cta_image);
$has_floating_cta = $floating_cta_title || $floating_cta_image_url;

$sequence_points = $get_value('sequence_points', 'field_progettazione_png_sequence_nav_sequence_points');
$sequence_points = is_array($sequence_points) ? array_values($sequence_points) : [];
$sequence_points = array_slice($sequence_points, 0, 3);
$sequence_point_images = array_map(static function ($point) use ($get_image_data) {
    return is_array($point) ? $get_image_data($point['image'] ?? null) : ['', ''];
}, $sequence_points);
$section_ergonomia_title = $get_value('ergonomia_title', 'field_progettazione_png_sequence_nav_ergonomia_title');
$section_ergonomia_text = $get_value('ergonomia_text', 'field_progettazione_png_sequence_nav_ergonomia_text');
$ergonomia_slides = $get_value('ergonomia_slides', 'field_progettazione_png_sequence_nav_ergonomia_slides');
$ergonomia_slides = is_array($ergonomia_slides) ? array_values($ergonomia_slides) : [];
$ergonomia_slides = array_values(array_filter($ergonomia_slides, static function ($slide) use ($get_image_data) {
    $image = is_array($slide) && array_key_exists('image', $slide) ? $slide['image'] : $slide;
    [$slide_url] = $get_image_data($image);

    return (bool) $slide_url;
}));

$show_elements = (bool) $get_value('show_elements', 'field_progettazione_png_sequence_nav_show_elements');
$elements_title = $get_value('elementi_title', 'field_progettazione_png_sequence_nav_elementi_title');
$elements_text = $get_value('elementi_text', 'field_progettazione_png_sequence_nav_elementi_text');
$element_terms = [];

if ($show_elements && $current_term instanceof WP_Term) {
    $child_terms = get_terms([
        'taxonomy' => $current_term->taxonomy,
        'parent' => $current_term->term_id,
        'hide_empty' => false,
        'orderby' => 'name',
        'order' => 'ASC',
    ]);

    if (!is_wp_error($child_terms) && is_array($child_terms)) {
        $element_terms = $child_terms;
    }
}

$compositions = $get_value('compositions', 'field_progettazione_png_sequence_nav_compositions');
$compositions = is_array($compositions) ? array_values(array_filter($compositions)) : [];
$compositions_title = $get_value('compositions_title', 'field_progettazione_png_sequence_nav_compositions_title');
$composition_text = $get_value('compositions_text', 'field_progettazione_png_sequence_nav_compositions_text');

$has_ergonomia = trim((string) $section_ergonomia_title) !== '' || trim((string) $section_ergonomia_text) !== '' || !empty($ergonomia_slides);
$has_elements = $show_elements && !empty($element_terms);
$has_compositions = !empty($compositions);

$nav_items = [
    [
        'id' => 'struttura',
        'number' => '01',
        'label' => __('Struttura', 'filcar'),
        'type' => 'sequence',
        'progress' => 0,
    ],
    [
        'id' => 'modularita',
        'number' => '02',
        'label' => __('Modularità', 'filcar'),
        'type' => 'sequence',
        'progress' => 0.5,
    ],
    [
        'id' => 'verticalita',
        'number' => '03',
        'label' => __('Verticalità', 'filcar'),
        'type' => 'sequence',
        'progress' => 1,
    ],
];

if ($has_ergonomia) {
    $nav_items[] = [
        'id' => 'ergonomia',
        'number' => str_pad((string) (count($nav_items) + 1), 2, '0', STR_PAD_LEFT),
        'label' => __('Ergonomia', 'filcar'),
        'type' => 'section',
    ];
}

if ($has_elements) {
    $nav_items[] = [
        'id' => 'elementi',
        'number' => str_pad((string) (count($nav_items) + 1), 2, '0', STR_PAD_LEFT),
        'label' => __('Elementi', 'filcar'),
        'type' => 'section',
    ];
}

if ($has_compositions) {
    $nav_items[] = [
        'id' => 'composizioni',
        'number' => str_pad((string) (count($nav_items) + 1), 2, '0', STR_PAD_LEFT),
        'label' => __('Composizioni', 'filcar'),
        'type' => 'section',
    ];
}

$ergonomia_number = '';
$elements_number = '';
$compositions_number = '';

foreach ($nav_items as $nav_item) {
    if ($nav_item['id'] === 'ergonomia') {
        $ergonomia_number = $nav_item['number'];
    } elseif ($nav_item['id'] === 'elementi') {
        $elements_number = $nav_item['number'];
    } elseif ($nav_item['id'] === 'composizioni') {
        $compositions_number = $nav_item['number'];
    }
}
?>

<section id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($section_class); ?>">
    <div class="progettazione-sequence-nav__inner">
        <aside class="page-header progettazione-sequence-nav__header">
            <div class="anchor-nav-wrap progettazione-sequence-nav__nav-wrap js-sequence-anchor-nav-wrap">
                <nav class="anchor-nav progettazione-sequence-nav__nav" aria-label="<?php esc_attr_e('Navigazione progettazione', 'filcar'); ?>">
                    <?php foreach ($nav_items as $index => $item) : ?>
                        <a
                            href="#<?php echo esc_attr($block_id . '-' . $item['id']); ?>"
                            class="sequence-anchor-link subtitle-4 user-select-none<?php echo $index === 0 ? ' is-active' : ''; ?>"
                            data-target="#<?php echo esc_attr($block_id . '-' . $item['id']); ?>"
                            data-anchor-id="<?php echo esc_attr($item['id']); ?>"
                            data-type="<?php echo esc_attr($item['type']); ?>"
                            <?php if ($item['type'] === 'sequence') : ?>
                                data-sequence-index="<?php echo esc_attr($index); ?>"
                            <?php endif; ?>
                        >
                            <span class="number-3 anchor-number text-white"><?php echo esc_html($item['number']); ?></span><?php echo esc_html($item['label']); ?>
                        </a>
                    <?php endforeach; ?>
                </nav>
            </div>
        </aside>

        <div class="progettazione-sequence-nav__content">

            <div class="progettazione-sequence-nav__scroll js-sequence-anchor-scroll">
                <?php if ($is_pinned_composition) : ?>
                    <div class="progettazione-sequence-nav__pinned-stage js-sequence-pinned-stage">
                        <div class="container-fluid progettazione-sequence-nav__pinned-inner">
                            <div class="progettazione-sequence-nav__pinned-copy">
                                <?php for ($index = 0; $index < 3; $index++) :
                                    $point = $sequence_points[$index] ?? [];
                                    $number = str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);
                                    $title = $point['title'] ?? '';
                                    $text = $point['text'] ?? '';
                                    $anchor_id = $nav_items[$index]['id'];
                                ?>
                                    <article id="<?php echo esc_attr($block_id . '-' . $anchor_id); ?>" class="progettazione-sequence-nav__pinned-point js-sequence-anchor-point js-sequence-pinned-point<?php echo $index === 0 ? ' is-active' : ''; ?>" data-image-index="<?php echo esc_attr($index); ?>" data-anchor-id="<?php echo esc_attr($anchor_id); ?>">
                                        <div class="row">
                                            <div class="col-12 col-lg-8 offset-lg-2">
                                                <span class="progettazione-sequence-nav__pinned-number number-3 semibold"><?php echo esc_html($number); ?></span>
                                                <?php if ($title) : ?>
                                                    <h3 class="progettazione-sequence-nav__pinned-title h4 light"><?php echo wp_kses_post($title); ?></h3>
                                                <?php endif; ?>
                                                <?php if ($text) : ?>
                                                    <div class="progettazione-sequence-nav__pinned-text p-big light"><?php echo wp_kses_post(wpautop($text)); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </article>
                                <?php endfor; ?>
                            </div>

                            <div class="progettazione-sequence-nav__composition-media">
                                <div class="progettazione-sequence-nav__composition-track js-sequence-composition-track">
                                    <?php foreach ($sequence_point_images as $image_index => $image_data) :
                                        [$image_url, $image_alt] = $image_data;

                                        if (!$image_url) {
                                            continue;
                                        }
                                        ?>
                                        <figure class="progettazione-sequence-nav__composition-item js-sequence-composition-item<?php echo $image_index === 0 ? ' is-active' : ''; ?>" data-image-index="<?php echo esc_attr($image_index); ?>">
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" loading="eager">
                                        </figure>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="container-fluid">
                        <div class="progettazione-sequence-nav__stage">
                            <div class="progettazione-sequence-nav__media js-sequence-anchor-media">
                                <div class="progettazione-sequence-nav__image-switch js-sequence-anchor-image-switch" style="position: relative; width: 100%; aspect-ratio: 1800 / 1956; overflow: hidden;">
                                    <?php foreach ($sequence_point_images as $image_index => $image_data) :
                                        [$image_url, $image_alt] = $image_data;

                                        if (!$image_url) {
                                            continue;
                                        }
                                        ?>
                                        <figure class="progettazione-sequence-nav__switch-image js-sequence-anchor-switch-image<?php echo $image_index === 0 ? ' is-active' : ''; ?>" data-image-index="<?php echo esc_attr($image_index); ?>" style="position: absolute; inset: 0; margin: 0; opacity: <?php echo $image_index === 0 ? '1' : '0'; ?>; pointer-events: none;">
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" loading="<?php echo $image_index === 0 ? 'eager' : 'lazy'; ?>" style="display: block; width: 100%; height: 100%; object-fit: contain; object-position: center bottom;">
                                        </figure>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <aside class="progettazione-sequence-nav__sidebar" aria-label="<?php esc_attr_e('Punti della sequenza', 'filcar'); ?>">
                                <?php for ($index = 0; $index < 3; $index++) :
                                    $point = $sequence_points[$index] ?? [];
                                    $number = str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);
                                    $title = $point['title'] ?? '';
                                    $text = $point['text'] ?? '';
                                    $anchor_id = $nav_items[$index]['id'];
                                ?>
                                    <article id="<?php echo esc_attr($block_id . '-' . $anchor_id); ?>" class="progettazione-sequence-nav__point js-sequence-anchor-point" data-image-index="<?php echo esc_attr($index); ?>" data-anchor-id="<?php echo esc_attr($anchor_id); ?>">
                                        <div class="progettazione-sequence-nav__point-head">
                                            <span class="progettazione-sequence-nav__point-number number-3 semibold"><?php echo esc_html($number); ?></span>

                                            <?php if ($title) : ?>
                                                <h3 class="progettazione-sequence-nav__point-title h6"><?php echo wp_kses_post($title); ?></h3>
                                            <?php endif; ?>
                                        </div>

                                        <?php if ($text) : ?>
                                            <div class="progettazione-sequence-nav__point-text p-normal"><?php echo wp_kses_post(wpautop($text)); ?></div>
                                        <?php endif; ?>

                                        <?php // TODO: floating CTA temporaneamente disattivata; riattivare se torna utile nella sequenza PNG. ?>
                                        <?php if (false && $index === 0 && $has_floating_cta) : ?>
                                            <div class="progettazione-sequence-nav__floating-card js-sequence-anchor-floating-card">
                                                <div class="hero-sector__card-item">
                                                    <?php if ($floating_cta_url) : ?>
                                                        <a class="hero-sector__card progettazione-sequence-nav__floating-card-link<?php echo !$floating_cta_image_url ? ' progettazione-sequence-nav__floating-card-link--no-media' : ''; ?>" href="<?php echo esc_url($floating_cta_url); ?>" target="<?php echo esc_attr($floating_cta_target); ?>"<?php echo $floating_cta_target === '_blank' ? ' rel="noopener"' : ''; ?>>
                                                    <?php else : ?>
                                                        <div class="hero-sector__card progettazione-sequence-nav__floating-card-link<?php echo !$floating_cta_image_url ? ' progettazione-sequence-nav__floating-card-link--no-media' : ''; ?>">
                                                    <?php endif; ?>
                                                        <?php if ($floating_cta_image_url) : ?>
                                                            <span class="hero-sector__card-media">
                                                                <img src="<?php echo esc_url($floating_cta_image_url); ?>" alt="<?php echo esc_attr($floating_cta_image_alt); ?>" loading="lazy">
                                                            </span>
                                                        <?php endif; ?>

                                                        <?php if ($floating_cta_title) : ?>
                                                            <span class="hero-sector__card-copy">
                                                                <span class="hero-sector__card-title button"><?php echo esc_html($floating_cta_title); ?></span>
                                                                <?php if ($floating_cta_url) : ?>
                                                                    <i class="hero-sector__card-icon icon icon-filcar-icon-arrow-downr" aria-hidden="true"></i>
                                                                <?php endif; ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    <?php echo $floating_cta_url ? '</a>' : '</div>'; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </article>
                                <?php endfor; ?>
                            </aside>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($has_ergonomia) : ?>
                <section id="<?php echo esc_attr($block_id); ?>-ergonomia" class="progettazione-sequence-nav__ergonomia js-sequence-anchor-section" data-anchor-id="ergonomia">
                    <div class="container-fluid progettazione-sequence-nav__ergonomia-copy">
                        <div class="row justify-content-center text-center">
                            <div class="col-12 col-lg-10">
                                <?php if ($ergonomia_number) : ?>
                                    <div class="number-3 text-secondary"><?php echo esc_html($ergonomia_number); ?></div>
                                <?php endif; ?>
                                <?php if ($section_ergonomia_title) : ?>
                                    <h2 class="h3 light sp-mt-2 sp-md-mt-3 sp-lg-mt-4 text-white"><?php echo esc_html($section_ergonomia_title); ?></h2>
                                <?php endif; ?>
                                <?php if ($section_ergonomia_text) : ?>
                                    <div class="p-big light text-white sp-mt-2 sp-md-mt-3 sp-lg-mt-4"><?php echo wp_kses_post(wpautop($section_ergonomia_text)); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($ergonomia_slides)) : ?>
                        <div class="progettazione-sequence-nav__ergonomia-carousel js-sequence-ergonomia-carousel">
                            <div class="progettazione-sequence-nav__ergonomia-track">
                                <?php foreach ($ergonomia_slides as $index => $slide) :
                                    $image = is_array($slide) && array_key_exists('image', $slide) ? $slide['image'] : $slide;
                                    [$slide_url, $slide_alt] = $get_image_data($image);
                                ?>
                                    <figure class="progettazione-sequence-nav__ergonomia-slide<?php echo $index === 0 ? ' is-active' : ''; ?>">
                                        <img src="<?php echo esc_url($slide_url); ?>" alt="<?php echo esc_attr($slide_alt); ?>" loading="lazy">
                                    </figure>
                                <?php endforeach; ?>
                            </div>

                            <?php if (count($ergonomia_slides) > 1) : ?>
                                <button class="progettazione-sequence-nav__ergonomia-control progettazione-sequence-nav__ergonomia-control--prev js-sequence-ergonomia-prev" type="button" aria-label="<?php esc_attr_e('Slide precedente', 'filcar'); ?>">
                                    <span aria-hidden="true">‹</span>
                                </button>
                                <button class="progettazione-sequence-nav__ergonomia-control progettazione-sequence-nav__ergonomia-control--next js-sequence-ergonomia-next" type="button" aria-label="<?php esc_attr_e('Slide successiva', 'filcar'); ?>">
                                    <span aria-hidden="true">›</span>
                                </button>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </section>
            <?php endif; ?>

            <?php if ($has_elements) : ?>
                <section id="<?php echo esc_attr($block_id); ?>-elementi" class="progettazione-sequence-nav__compositions bg-light js-sequence-anchor-section" data-anchor-id="elementi">
                    <div class="container-fluid">
                        <div class="row progettazione-sequence-nav__compositions-head">
                            <div class="col-12 col-lg-6">
                                <div class="progettazione-sequence-nav__compositions-title">
                                    <div class="progettazione-sequence-nav__compositions-number number-2"><?php echo esc_html($elements_number); ?></div>
                                    <h2 class="progettazione-sequence-nav__compositions-heading subtitle-1"><?php echo esc_html($elements_title ?: __('Elementi', 'filcar')); ?></h2>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <?php if ($elements_text) : ?>
                                    <div class="progettazione-sequence-nav__compositions-text"><?php echo wp_kses_post(wpautop($elements_text)); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row progettazione-sequence-nav__compositions-grid">
                            <?php foreach ($element_terms as $element_term) : ?>
                                <?php
                                get_template_part('parts/card/card-elementi', null, [
                                    'term_id' => $element_term->term_id,
                                    'taxonomy' => $element_term->taxonomy,
                                    'class' => 'col-6 col-md-4 col-xl-3',
                                    'name_class' => 'h7',
                                    'class_figure' => 'aspect-ratio-4x3',
                                ]);
                                ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <?php if ($has_compositions) :
                $compositions_c = count($compositions);
            ?>
            <section id="<?php echo esc_attr($block_id); ?>-composizioni" class="progettazione-sequence-nav__compositions js-sequence-anchor-section" data-anchor-id="composizioni">
                <div class="container-fluid">
                    <div class="row progettazione-sequence-nav__compositions-head">
                        <div class="col-12 col-lg-6">
                            <div class="progettazione-sequence-nav__compositions-title">
                                <div class="progettazione-sequence-nav__compositions-number number-2"><?php echo esc_html($compositions_number); ?></div>
                                <h2 class="progettazione-sequence-nav__compositions-heading subtitle-1"><?php echo $compositions_title ?: __('Composizioni', 'filcar'); ?></h2>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <?php if ($composition_text) : ?>
                                <p class="progettazione-sequence-nav__compositions-text"><?php echo esc_html($composition_text); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row progettazione-sequence-nav__compositions-grid">
                        <?php for($i = 0; $i < $compositions_c; $i++) : ?>
                            <div class="col-6 col-md-4 col-xl-3 progettazione-sequence-nav__composition-col card-product">
                                <a href="<?php echo get_the_permalink($compositions[$i]->ID); ?>" class="progettazione-sequence-nav__composition-card aspect-ratio-7x8 rounded overflow-hidden product-card">
                                    <figure class="aspect-ratio-7x8 respimg overflow-hidden rounded">
                                        <?php
                                        echo wp_get_attachment_image(
                                            get_post_thumbnail_id($compositions[$i]->ID),
                                            '',
                                            false,
                                            ['class' => '', 'loading' => 'lazy']
                                        );
                                        ?>
                                    </figure>
                                    <div class="card-link-arrow">
                                        <i class="icon-filcar-icon-arrow-upr"></i>
                                    </div>
                                    <div class="progettazione-sequence-nav__composition-overlay p-smaller">
                                        <span><?php echo get_the_title($compositions[$i]->ID); ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </section>
            <?php endif; ?>
        </div>
    </div>

</section>
