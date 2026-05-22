<?php
$block_id = !empty($block['anchor']) ? $block['anchor'] : 'carousel-highlights-' . ($block['id'] ?? uniqid());

$script_path = get_template_directory() . '/js/carousel-highlights.js';
if (file_exists($script_path)) {
    wp_enqueue_script(
        'filcar-carousel-highlights',
        get_template_directory_uri() . '/js/carousel-highlights.js',
        ['gsap', 'scrollTrigger', 'scrollToPlugin'],
        filemtime($script_path),
        true
    );
}

$get_value = static function ($name, $key = '') use ($block) {
    $value = get_field($name);

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

$title = $get_value('title', 'field_carousel_highlights_title') ?: __('Highlights', 'filcar');
$items = $get_value('items', 'field_carousel_highlights_items');
$items = is_array($items) ? array_values($items) : [];
?>

<section id="<?php echo esc_attr($block_id); ?>" class="carousel-highlights js-carousel-highlights">
    <div class="carousel-highlights__pin js-carousel-highlights-pin">
        <div class="carousel-highlights__inner">
            <?php if ($title) : ?>
                <h2 class="carousel-highlights__title subtitle-1 h3 light"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if (!empty($items)) : ?>
                <div class="carousel-highlights__viewport js-carousel-highlights-viewport">
                    <div class="carousel-highlights__track js-carousel-highlights-track">
                        <?php foreach ($items as $index => $item) :
                            $image = $item['image'] ?? null;
                            $hover_image = $item['hover_image'] ?? null;
                            [$image_url, $image_alt] = $get_image_data($image);
                            [$hover_image_url, $hover_image_alt] = $get_image_data($hover_image);
                            $item_title = $item['title'] ?? '';
                            $item_text = $item['text'] ?? '';
                            $is_featured = $index % 3 === 0;

                            if (!$image_url && !$item_title && !$item_text) {
                                continue;
                            }
                        ?>
                            <article class="carousel-highlights__card<?php echo $is_featured ? ' carousel-highlights__card--wide' : ''; ?><?php echo $item_text ? ' carousel-highlights__card--has-text' : ''; ?> js-carousel-highlights-card" tabindex="0">
                                <div class="carousel-highlights__media">
                                    <?php if ($image_url) : ?>
                                        <img class="carousel-highlights__image carousel-highlights__image--base" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" loading="lazy">
                                    <?php endif; ?>

                                    <?php if ($hover_image_url) : ?>
                                        <img class="carousel-highlights__image carousel-highlights__image--hover" src="<?php echo esc_url($hover_image_url); ?>" alt="<?php echo esc_attr($hover_image_alt ?: $image_alt); ?>" loading="lazy">
                                    <?php endif; ?>
                                </div>

                                <div class="carousel-highlights__copy">
                                    <?php if ($item_title) : ?>
                                        <h3 class="carousel-highlights__card-title h6"><?php echo esc_html($item_title); ?></h3>
                                    <?php endif; ?>

                                    <?php if ($item_text) : ?>
                                        <div class="carousel-highlights__text p-small"><?php echo wp_kses_post(wpautop($item_text)); ?></div>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>

                        <?php if (count($items) >= 4) : ?>
                            <div class="carousel-highlights__end-spacer" aria-hidden="true"></div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (count($items) > 1) : ?>
                    <div class="carousel-highlights__controls" aria-label="<?php esc_attr_e('Controlli highlights', 'filcar'); ?>">
                        <button class="carousel-highlights__control js-carousel-highlights-prev" type="button" aria-label="<?php esc_attr_e('Highlight precedente', 'filcar'); ?>">
                            <span aria-hidden="true">‹</span>
                        </button>
                        <button class="carousel-highlights__control js-carousel-highlights-next" type="button" aria-label="<?php esc_attr_e('Highlight successivo', 'filcar'); ?>">
                            <span aria-hidden="true">›</span>
                        </button>
                    </div>
                <?php endif; ?>
            <?php elseif (is_admin()) : ?>
                <p class="carousel-highlights__empty"><?php esc_html_e('Aggiungi almeno una card highlight.', 'filcar'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
