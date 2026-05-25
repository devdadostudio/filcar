<?php
$block = $block ?? [];
$args = $args ?? [];
$field_values = !empty($args['field_values']) && is_array($args['field_values']) ? $args['field_values'] : [];
$field_source = $args['field_source'] ?? null;
$block_id = !empty($args['block_id']) ? $args['block_id'] : (!empty($block['anchor']) ? $block['anchor'] : 'hero-image-hotspots-' . ($block['id'] ?? uniqid()));
$get_value = static function ($name) use ($field_values, $field_source) {
    if (array_key_exists($name, $field_values)) {
        return $field_values[$name];
    }

    return $field_source ? get_field($name, $field_source) : get_field($name);
};

$desktop_image = $get_value('desktop_image');
$mobile_image = $get_value('mobile_image');
$kicker = $get_value('kicker');
$logo_icon = $get_value('logo_icon');
$title = $get_value('title');
$text = $get_value('text');
$points = $get_value('points') ?: [];

$get_image_id = static function ($image) {
    if (is_array($image) && !empty($image['ID'])) {
        return (int) $image['ID'];
    }

    return is_numeric($image) ? (int) $image : 0;
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

$get_image_alt = static function ($image) {
    if (is_array($image)) {
        return $image['alt'] ?? '';
    }

    if (is_numeric($image)) {
        return get_post_meta((int) $image, '_wp_attachment_image_alt', true) ?: '';
    }

    return '';
};

$format_coord = static function ($coord, $fallback = '50%') {
    if ($coord === null || $coord === '') {
        return $fallback;
    }

    $coord = trim((string) $coord);

    if (is_numeric($coord)) {
        return $coord . '%';
    }

    return strpos($coord, '%') !== false ? $coord : $coord . '%';
};

$desktop_image_id = $get_image_id($desktop_image);
$mobile_image_id = $get_image_id($mobile_image);
$fallback_image = $desktop_image ?: $mobile_image;
$fallback_image_id = $get_image_id($fallback_image);
$fallback_alt = $get_image_alt($fallback_image) ?: wp_strip_all_tags($title ?: get_the_title());
?>

<section id="<?php echo esc_attr($block_id); ?>" class="hero-image-hotspots js-hero-image-hotspots">
    <div class="hero-image-hotspots__stage js-hero-hotspots-positioner">
        <picture class="hero-image-hotspots__picture">
            <?php if ($mobile_image_id || $get_image_url($mobile_image)) : ?>
                <source media="(max-width: 991px)" srcset="<?php echo esc_url($mobile_image_id ? wp_get_attachment_image_url($mobile_image_id, 'full') : $get_image_url($mobile_image)); ?>">
            <?php endif; ?>

            <?php
            if ($fallback_image_id) {
                echo wp_get_attachment_image($fallback_image_id, 'full', false, [
                    'class' => 'hero-image-hotspots__image',
                    'alt' => $fallback_alt,
                ]);
            } elseif ($get_image_url($fallback_image)) {
                echo '<img class="hero-image-hotspots__image" src="' . esc_url($get_image_url($fallback_image)) . '" alt="' . esc_attr($fallback_alt) . '">';
            }
            ?>
        </picture>

        <div class="hero-image-hotspots__shade" aria-hidden="true"></div>

        <?php
        get_template_part('parts/breadcrumbs', null, [
            'variant' => 'dark',
            'layout' => 'overlay',
            'class' => 'hero-image-hotspots__breadcrumb',
            'col_class' => 'col-12',
        ]);
        ?>

        <div class="container-fluid hero-image-hotspots__content">
            <div class="hero-image-hotspots__copy">
                <?php if ($kicker) : ?>
                    <p class="hero-image-hotspots__kicker h0 extralight"><?php echo esc_html($kicker); ?></p>
                <?php endif; ?>

                <?php if ($logo_icon) : ?>
                    <span class="hero-image-hotspots__logo <?php echo esc_attr($logo_icon); ?>" aria-hidden="true"></span>
                <?php endif; ?>

                <?php if ($title) : ?>
                    <h1 class="hero-image-hotspots__title h5 extralight"><?php echo wp_kses_post($title); ?></h1>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="hero-image-hotspots__text p-big regular">
                        <?php echo wp_kses_post(wpautop($text)); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($points) && is_array($points)) : ?>
            <div class="hero-image-hotspots__points" aria-label="<?php esc_attr_e('Punti in evidenza', 'filcar'); ?>">
                <?php foreach ($points as $point) :
                    $label = $point['label'] ?? '';
                    $icon = $point['icon'] ?? '';
                    $desktop_x = $format_coord($point['desktop_x'] ?? null);
                    $desktop_y = $format_coord($point['desktop_y'] ?? null);
                    $label_position = ($point['label_position'] ?? 'right') === 'left' ? 'left' : 'right';

                    if (!$label) {
                        continue;
                    }
                ?>
                    <div
                        class="hero-image-hotspots__point hero-image-hotspots__point--<?php echo esc_attr($label_position); ?>"
                        style="--hotspot-desktop-x: <?php echo esc_attr($desktop_x); ?>; --hotspot-desktop-y: <?php echo esc_attr($desktop_y); ?>;"
                        data-desktop-x="<?php echo esc_attr($desktop_x); ?>"
                        data-desktop-y="<?php echo esc_attr($desktop_y); ?>"
                    >
                        <span class="hero-image-hotspots__pin" aria-hidden="true"></span>
                        <span class="hero-image-hotspots__point-card">
                            <?php if ($icon) : ?>
                                <i class="hero-image-hotspots__point-icon <?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
                            <?php endif; ?>
                            <span class="hero-image-hotspots__point-label p-small"><?php echo esc_html($label); ?></span>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
