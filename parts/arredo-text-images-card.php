<?php
$block = $block ?? [];
$args = $args ?? [];
$field_values = !empty($args['field_values']) && is_array($args['field_values']) ? $args['field_values'] : [];
$field_source = $args['field_source'] ?? null;
$block_id = !empty($args['block_id']) ? $args['block_id'] : (!empty($block['anchor']) ? $block['anchor'] : 'arredo-text-images-card-' . ($block['id'] ?? uniqid()));
$get_value = static function ($name) use ($field_values, $field_source) {
    if (array_key_exists($name, $field_values)) {
        return $field_values[$name];
    }

    return $field_source ? get_field($name, $field_source) : get_field($name);
};

$variant = $get_value('variant') === 'dark' ? 'dark' : 'light';
$logo_icon = $get_value('logo_icon');
$title = $get_value('title');
$text = $get_value('text');
$image_left = $get_value('image_left');
$image_main = $get_value('image_main');
$link_card = $get_value('link_card');

$get_image_id = static function ($image) {
    if (is_array($image) && !empty($image['ID'])) {
        return (int) $image['ID'];
    }

    return is_numeric($image) ? (int) $image : 0;
};

$get_image_alt = static function ($image, $fallback = '') {
    if (is_array($image)) {
        return $image['alt'] ?? $fallback;
    }

    if (is_numeric($image)) {
        return get_post_meta((int) $image, '_wp_attachment_image_alt', true) ?: $fallback;
    }

    return $fallback;
};

$get_image_url = static function ($image, $size = 'full') {
    if (is_array($image)) {
        return $image['sizes'][$size] ?? $image['url'] ?? '';
    }

    if (is_numeric($image)) {
        return wp_get_attachment_image_url((int) $image, $size) ?: '';
    }

    return is_string($image) ? $image : '';
};

$card_image = is_array($link_card) ? ($link_card['image'] ?? null) : null;
$card_title = is_array($link_card) ? ($link_card['title'] ?? '') : '';
$card_link = is_array($link_card) ? ($link_card['link'] ?? null) : null;
$card_url = is_array($card_link) ? ($card_link['url'] ?? '') : '';
$card_target = is_array($card_link) && !empty($card_link['target']) ? $card_link['target'] : '_self';
$card_label = $card_title ?: (is_array($card_link) ? ($card_link['title'] ?? '') : '');
$has_card = $card_url && $card_label;

$section_classes = [
    'arredo-text-images-card',
    'arredo-text-images-card--' . $variant,
    'sp-pt-10',
    'sp-pb-0',
    'sp-lg-py-16',
    'sp-sxl-py-20',
];
?>

<section id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr(implode(' ', $section_classes)); ?>">
    <div class="container-fluid">
        <div class="row arredo-text-images-card__intro">
            <div class="col-12 col-lg-4">
                <?php if ($logo_icon) : ?>
                    <span class="arredo-text-images-card__logo <?php echo esc_attr($logo_icon); ?>" aria-hidden="true"></span>
                <?php endif; ?>

                <?php if ($title) : ?>
                    <h2 class="arredo-text-images-card__title h3 extralight"><?php echo wp_kses_post($title); ?></h2>
                <?php endif; ?>
            </div>

            <?php if ($text) : ?>
                <div class="col-12 col-lg-8">
                    <div class="arredo-text-images-card__text p-big regular">
                        <?php echo wp_kses_post(wpautop($text)); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="arredo-text-images-card__media-wrap">
            <div class="row arredo-text-images-card__media-row aspect-ratio-3x1">
                <?php if ($image_left) : ?>
                    <div class="col-lg-4 offset-lg-1 d-none d-lg-block">
                        <figure class="arredo-text-images-card__figure arredo-text-images-card__figure--left">
                            <?php
                            echo wp_get_attachment_image($get_image_id($image_left), 'full', false, [
                                'class' => 'arredo-text-images-card__image',
                                'alt' => $get_image_alt($image_left, wp_strip_all_tags($title ?: '')),
                                'loading' => 'lazy',
                            ]);
                            ?>
                        </figure>
                    </div>
                <?php endif; ?>

                <?php if ($image_main) : ?>
                    <div class="col-12 <?php echo $image_left ? 'col-lg-7' : 'col-lg-8 offset-lg-4'; ?>">
                        <figure class="arredo-text-images-card__figure arredo-text-images-card__figure--main">
                            <?php
                            echo wp_get_attachment_image($get_image_id($image_main), 'full', false, [
                                'class' => 'arredo-text-images-card__image',
                                'alt' => $get_image_alt($image_main, wp_strip_all_tags($title ?: '')),
                                'loading' => 'lazy',
                            ]);
                            ?>
                        </figure>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($has_card) : ?>
            <div class="row arredo-text-images-card__card-row">
                <div class="col-12 col-lg-4 offset-lg-8 col-xxl-3 offset-xxl-9">
                    <a class="hero-sector__card arredo-text-images-card__card<?php echo !$card_image ? ' arredo-text-images-card__card--no-media' : ''; ?>" href="<?php echo esc_url($card_url); ?>" target="<?php echo esc_attr($card_target); ?>"<?php echo $card_target === '_blank' ? ' rel="noopener"' : ''; ?>>
                        <?php if ($card_image) : ?>
                            <span class="hero-sector__card-media">
                                <?php
                                echo wp_get_attachment_image($get_image_id($card_image), 'medium', false, [
                                    'alt' => $get_image_alt($card_image, wp_strip_all_tags($card_label)),
                                    'loading' => 'lazy',
                                ]);
                                ?>
                            </span>
                        <?php endif; ?>
                        <span class="hero-sector__card-copy">
                            <span class="hero-sector__card-title p-big"><?php echo wp_kses_post($card_label); ?></span>
                            <i class="hero-sector__card-icon icon icon-filcar-icon-arrow-downr" aria-hidden="true"></i>
                        </span>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
