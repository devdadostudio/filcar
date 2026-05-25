<?php
$args = $args ?? [];
$field_values = !empty($args['field_values']) && is_array($args['field_values']) ? $args['field_values'] : [];
$field_source = $args['field_source'] ?? null;
$content_has_value = static function ($value) use (&$content_has_value) {
    if (is_array($value)) {
        if (!empty($value['ID']) || !empty($value['url'])) {
            return true;
        }

        foreach ($value as $item) {
            if ($content_has_value($item)) {
                return true;
            }
        }

        return false;
    }

    return is_string($value) ? trim($value) !== '' : ($value !== null && $value !== false && $value !== '');
};
$get_value = static function ($name) use ($field_values, $field_source) {
    if (array_key_exists($name, $field_values)) {
        return $field_values[$name];
    }

    return $field_source ? get_field($name, $field_source) : get_field($name);
};

$sectionBg = $get_value('section_bg');
$content = $get_value('technical_text_scroll');
$content = is_array($content) ? $content : [];

if (!$content_has_value($content) && $field_source) {
    $direct_content = get_field('technical_text_scroll', $field_source);
    $content = is_array($direct_content) && $content_has_value($direct_content) ? $direct_content : $content;
}

if (!$content_has_value($content)) {
    $content = array_intersect_key($field_values, array_flip([
        'text',
        'testo',
        'main_text',
        'testo_principale',
        'body',
        'intro',
        'intro_text',
        'testo_intro',
        'cta',
        'link',
        'cta_block',
        'has_technical_background',
        'technical_background_enabled',
        'show_technical_background',
        'background_tecnico',
        'technical_image',
        'immagine_tecnica',
        'technical_background_image',
        'background_tecnico_immagine',
        'image',
    ]));
}

if (!function_exists('filcar_tts_field')) {
    function filcar_tts_field(array $content, array $keys, $fallback = '') {
        foreach ($keys as $key) {
            if (array_key_exists($key, $content) && $content[$key] !== '' && $content[$key] !== null) {
                return $content[$key];
            }

            $value = get_field($key);

            if ($value !== '' && $value !== null && $value !== false) {
                return $value;
            }
        }

        return $fallback;
    }
}

if (!function_exists('filcar_tts_image')) {
    function filcar_tts_image($image) {
        $data = [
            'url' => '',
            'alt' => '',
        ];

        if (is_array($image)) {
            $data['url'] = $image['url'] ?? '';
            $data['alt'] = $image['alt'] ?? '';
            return $data;
        }

        if (is_numeric($image)) {
            $data['url'] = wp_get_attachment_image_url((int) $image, 'full') ?: '';
            $data['alt'] = get_post_meta((int) $image, '_wp_attachment_image_alt', true) ?: '';
            return $data;
        }

        if (is_string($image)) {
            $data['url'] = $image;
        }

        return $data;
    }
}

$text = filcar_tts_field($content, ['text', 'testo', 'main_text', 'testo_principale', 'body']);
$intro = filcar_tts_field($content, ['intro', 'intro_text', 'testo_intro']);
$cta = filcar_tts_field($content, ['cta', 'link', 'cta_block']);
$has_technical_bg = (bool) filcar_tts_field($content, ['has_technical_background', 'technical_background_enabled', 'show_technical_background', 'background_tecnico'], false);
$technical_image = filcar_tts_image(filcar_tts_field($content, ['technical_image', 'immagine_tecnica', 'technical_background_image', 'background_tecnico_immagine', 'image']));

if (!$text) {
    return;
}

$cta_url = is_array($cta) ? ($cta['url'] ?? '') : '';
$cta_title = is_array($cta) ? (($cta['title'] ?? '') ?: __('Scopri', 'filcar')) : '';
$cta_target = is_array($cta) ? ($cta['target'] ?? '') : '';
$show_technical_bg = $has_technical_bg && $technical_image['url'];

$block = $block ?? [];
$block_id = !empty($args['block_id']) ? $args['block_id'] : (!empty($block['anchor']) ? $block['anchor'] : 'technical-text-scroll-' . ($block['id'] ?? uniqid()));
$section_classes = [
    'technical-text-scroll',
    'js-technical-text-scroll',
];

if ($show_technical_bg) {
    $section_classes[] = 'technical-text-scroll--has-technical-bg';
}

if ($intro) {
    $section_classes[] = 'technical-text-scroll--has-intro';
}

if ($cta_url) {
    $section_classes[] = 'technical-text-scroll--has-cta';
}
?>

<section id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr(implode(' ', $section_classes)); ?> <?php echo $sectionBg; ?>">
    <?php if ($show_technical_bg) : ?>
        <img class="technical-text-scroll__technical-bg" src="<?php echo esc_url($technical_image['url']); ?>" alt="" aria-hidden="true">
    <?php endif; ?>

    <div class="container-fluid technical-text-scroll__inner">
        <?php if ($intro) : ?>
            <div class="technical-text-scroll__intro p-normal">
                <?php echo wp_kses_post($intro); ?>
            </div>
        <?php endif; ?>

        <div class="technical-text-scroll__content">
            <div class="technical-text-scroll__text js-technical-text-scroll-text h4">
                <?php echo wp_kses_post($text); ?>
            </div>

            <?php if ($cta_url) : ?>
                <a class="technical-text-scroll__cta btn btn-secondary-2 w-icon" href="<?php echo esc_url($cta_url); ?>"<?php echo $cta_target ? ' target="' . esc_attr($cta_target) . '"' : ''; ?><?php echo $cta_target === '_blank' ? ' rel="noopener"' : ''; ?>>
                    <span><?php echo esc_html($cta_title); ?><span class="icon-filcar-icon-arrow-upr" aria-hidden="true"></span></span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
