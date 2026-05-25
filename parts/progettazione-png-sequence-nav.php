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

$normalize_relative_path = static function ($path) {
    $path = trim((string) $path);
    $path = ltrim($path, '/');
    $path = preg_replace('#/+#', '/', $path);

    return $path ?: '';
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

$theme_variant = $get_value('theme_variant', 'field_progettazione_png_sequence_nav_theme_variant');
$theme_variant = in_array($theme_variant, ['dark', 'light'], true) ? $theme_variant : 'dark';
$section_class = 'progettazione-sequence-nav progettazione-sequence-nav--' . $theme_variant . ' js-progettazione-sequence-nav';

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
$has_floating_cta = $floating_cta_title && $floating_cta_url;

$sequence_points = $get_value('sequence_points', 'field_progettazione_png_sequence_nav_sequence_points');
$sequence_points = is_array($sequence_points) ? array_values($sequence_points) : [];
$sequence_points = array_slice($sequence_points, 0, 3);

$section_ergonomia_title = $get_value('ergonomia_title', 'field_progettazione_png_sequence_nav_ergonomia_title');
$section_ergonomia_text = $get_value('ergonomia_text', 'field_progettazione_png_sequence_nav_ergonomia_text');
$ergonomia_slides = $get_value('ergonomia_slides', 'field_progettazione_png_sequence_nav_ergonomia_slides');
$ergonomia_slides = is_array($ergonomia_slides) ? array_values($ergonomia_slides) : [];

$composition_text = __('Soluzioni configurate dai nostri esperti per rispondere a ogni esigenza operativa, sfruttando la flessibilità estrema della linea Mono. La struttura completamente modulare permette di creare composizioni capaci di evolversi nel tempo e di garantire sempre la massima funzionalità, organizzazione e continuità operativa.', 'filcar');
$composition_cards = [
    __('Composizione con parete attrezzata', 'filcar'),
    __('Banco con accessori integrati', 'filcar'),
    __('Postazione modulare completa', 'filcar'),
    __('Banco doppio con contenimento', 'filcar'),
    __('Banco operativo lineare', 'filcar'),
    __('Modulo con pannello portautensili', 'filcar'),
    __('Configurazione compatta', 'filcar'),
    __('Banco essenziale su ruote', 'filcar'),
];

$frames_folder = $normalize_relative_path((string) $get_value('frames_folder', 'field_progettazione_png_sequence_nav_frames_folder'));
$frame_urls = [];

if ($frames_folder) {
    $frames_dir = trailingslashit(get_template_directory()) . $frames_folder;
    $frames_uri = trailingslashit(get_template_directory_uri()) . $frames_folder;

    if (is_dir($frames_dir)) {
        $frame_files = glob(trailingslashit($frames_dir) . '*.png');
        $frame_files = is_array($frame_files) ? $frame_files : [];

        natsort($frame_files);

        foreach ($frame_files as $frame_file) {
            if (is_file($frame_file)) {
                $frame_urls[] = trailingslashit($frames_uri) . basename($frame_file);
            }
        }
    }
}

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
    [
        'id' => 'ergonomia',
        'number' => '04',
        'label' => __('Ergonomia', 'filcar'),
        'type' => 'section',
    ],
    [
        'id' => 'composizioni',
        'number' => '05',
        'label' => __('Composizioni', 'filcar'),
        'type' => 'section',
    ],
];
$compositions_number = str_pad((string) count($nav_items), 2, '0', STR_PAD_LEFT);
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
                                data-sequence-progress="<?php echo esc_attr($item['progress']); ?>"
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
                <div class="container-fluid">
                    <div class="progettazione-sequence-nav__stage">
                        <div class="progettazione-sequence-nav__media js-sequence-anchor-media">
                            <div class="progettazione-sequence-nav__canvas-wrap">
                                <canvas class="progettazione-sequence-nav__canvas js-sequence-anchor-canvas" width="1200" height="675" aria-label="<?php esc_attr_e('Sequenza di progettazione', 'filcar'); ?>"></canvas>
                            </div>
                        </div>

                        <aside class="progettazione-sequence-nav__sidebar" aria-label="<?php esc_attr_e('Punti della sequenza', 'filcar'); ?>">
                            <?php for ($index = 0; $index < 3; $index++) :
                                $point = $sequence_points[$index] ?? [];
                                $number = str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);
                                $title = $point['title'] ?? '';
                                $text = $point['text'] ?? '';
                                $progress = isset($point['sequence_progress']) && is_numeric($point['sequence_progress']) ? (float) $point['sequence_progress'] / 100 : ($index / 2);
                                $progress = max(0, min(1, $progress));
                                $anchor_id = $nav_items[$index]['id'];
                            ?>
                                <article id="<?php echo esc_attr($block_id . '-' . $anchor_id); ?>" class="progettazione-sequence-nav__point js-sequence-anchor-point" data-sequence-progress="<?php echo esc_attr($progress); ?>" data-anchor-id="<?php echo esc_attr($anchor_id); ?>">
                                    <div class="progettazione-sequence-nav__point-head">
                                        <span class="progettazione-sequence-nav__point-number number-3 semibold"><?php echo esc_html($number); ?></span>

                                        <?php if ($title) : ?>
                                            <h3 class="progettazione-sequence-nav__point-title h6"><?php echo esc_html($title); ?></h3>
                                        <?php endif; ?>
                                    </div>

                                    <?php if ($text) : ?>
                                        <div class="progettazione-sequence-nav__point-text p-normal"><?php echo wp_kses_post(wpautop($text)); ?></div>
                                    <?php endif; ?>

                                    <?php if ($index === 0 && $has_floating_cta) : ?>
                                        <div class="progettazione-sequence-nav__floating-card js-sequence-anchor-floating-card">
                                            <div class="hero-sector__card-item">
                                                <a class="hero-sector__card progettazione-sequence-nav__floating-card-link<?php echo !$floating_cta_image_url ? ' progettazione-sequence-nav__floating-card-link--no-media' : ''; ?>" href="<?php echo esc_url($floating_cta_url); ?>" target="<?php echo esc_attr($floating_cta_target); ?>"<?php echo $floating_cta_target === '_blank' ? ' rel="noopener"' : ''; ?>>
                                                    <?php if ($floating_cta_image_url) : ?>
                                                        <span class="hero-sector__card-media">
                                                            <img src="<?php echo esc_url($floating_cta_image_url); ?>" alt="<?php echo esc_attr($floating_cta_image_alt); ?>" loading="lazy">
                                                        </span>
                                                    <?php endif; ?>

                                                    <span class="hero-sector__card-copy">
                                                        <span class="hero-sector__card-title p-big"><?php echo esc_html($floating_cta_title); ?></span>
                                                        <i class="hero-sector__card-icon icon icon-filcar-icon-arrow-downr" aria-hidden="true"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </article>
                            <?php endfor; ?>
                        </aside>
                    </div>
                </div>
            </div>

            <section id="<?php echo esc_attr($block_id); ?>-ergonomia" class="progettazione-sequence-nav__ergonomia js-sequence-anchor-section" data-anchor-id="ergonomia">
                <div class="container-fluid progettazione-sequence-nav__ergonomia-copy">
                    <div class="row justify-content-center text-center">
                        <div class="col-12 col-lg-9 col-uxl-7">
                            <div class="product-3 text-secondary">04</div>
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

                                if (!$slide_url) {
                                    continue;
                                }
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

            <section id="<?php echo esc_attr($block_id); ?>-composizioni" class="progettazione-sequence-nav__compositions js-sequence-anchor-section" data-anchor-id="composizioni">
                <div class="container-fluid">
                    <div class="row progettazione-sequence-nav__compositions-head">
                        <div class="col-12 col-lg-6">
                            <div class="progettazione-sequence-nav__compositions-title">
                                <div class="progettazione-sequence-nav__compositions-number number-2"><?php echo esc_html($compositions_number); ?></div>
                                <h2 class="progettazione-sequence-nav__compositions-heading subtitle-1"><?php esc_html_e('Composizioni', 'filcar'); ?></h2>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <p class="progettazione-sequence-nav__compositions-text"><?php echo esc_html($composition_text); ?></p>
                        </div>
                    </div>

                    <div class="row progettazione-sequence-nav__compositions-grid">
                        <?php foreach ($composition_cards as $index => $composition_title) : ?>
                            <div class="col-6 col-lg-3 progettazione-sequence-nav__composition-col">
                                <article class="progettazione-sequence-nav__composition-card">
                                    <div class="progettazione-sequence-nav__composition-placeholder" aria-hidden="true">
                                        <span class="progettazione-sequence-nav__composition-shape progettazione-sequence-nav__composition-shape--<?php echo esc_attr(($index % 4) + 1); ?>"></span>
                                    </div>
                                    <div class="progettazione-sequence-nav__composition-overlay">
                                        <span><?php echo esc_html($composition_title); ?></span>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php if (!empty($frame_urls)) : ?>
        <script type="application/json" class="js-sequence-anchor-frames"><?php echo wp_json_encode($frame_urls); ?></script>
    <?php endif; ?>
</section>
