<?php
$post_id = get_the_ID();
$block_id = !empty($block['anchor']) ? $block['anchor'] : 'hero-sector-' . ($block['id'] ?? uniqid());
$kicker = get_the_title($post_id);
$title = get_field('title') ?: get_the_excerpt($post_id);
$cards = get_field('cards') ?: [];
$background_url = get_the_post_thumbnail_url($post_id, 'full');
$background_alt = get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true) ?: $kicker;

$get_media_url = static function ($media, $size = 'full') {
    if (is_array($media)) {
        return $media['url'] ?? '';
    }

    if (is_numeric($media)) {
        return wp_get_attachment_image_url((int) $media, $size) ?: '';
    }

    return is_string($media) ? $media : '';
};

$get_media_alt = static function ($media) {
    if (is_array($media)) {
        return $media['alt'] ?? '';
    }

    if (is_numeric($media)) {
        return get_post_meta((int) $media, '_wp_attachment_image_alt', true) ?: '';
    }

    return '';
};
?>

<section id="<?php echo esc_attr($block_id); ?>" class="hero-sector">
    <?php if ($background_url) : ?>
        <img class="hero-sector__media" src="<?php echo esc_url($background_url); ?>" alt="<?php echo esc_attr($background_alt); ?>">
    <?php endif; ?>

    <div class="hero-sector__shade" aria-hidden="true"></div>

    <?php
    get_template_part('parts/breadcrumbs', null, [
        'variant' => 'dark',
        'layout' => 'overlay',
        'class' => 'hero-sector__breadcrumb',
        'col_class' => 'col-12',
        'items' => [
            ['label' => __('Home', 'filcar'), 'url' => home_url('/')],
            ['label' => __('Settori', 'filcar'), 'url' => home_url('/settori/')],
            ['label' => $kicker],
        ],
    ]);
    ?>

    <div class="container-fluid hero-sector__content">
        <div class="hero-sector__copy">
            <?php if ($kicker) : ?>
                <p class="hero-sector__kicker product-3 regular"><?php echo esc_html($kicker); ?></p>
            <?php endif; ?>

            <?php if ($title) : ?>
                <h1 class="hero-sector__title h0 extralight"><?php echo wp_kses_post($title); ?></h1>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($cards) && is_array($cards)) : ?>
        <div class="container-fluid hero-sector__cards">
            <div class="hero-sector__cards-grid">
                <?php foreach ($cards as $card) :
                    $card_title = $card['title'] ?? '';
                    $card_image = $card['image'] ?? null;
                    $card_image_url = $get_media_url($card_image);
                    $card_link = $card['link'] ?? null;
                    $card_url = '';
                    $card_target = '_self';

                    if (is_array($card_link)) {
                        $card_url = $card_link['url'] ?? '';
                        $card_title = $card_title ?: ($card_link['title'] ?? '');
                        $card_target = !empty($card_link['target']) ? $card_link['target'] : '_self';
                    } elseif (is_string($card_link)) {
                        $card_url = $card_link;
                    }

                    if (!$card_title || !$card_url) {
                        continue;
                    }
                ?>
                    <div class="hero-sector__card-item">
                        <a class="hero-sector__card" href="<?php echo esc_url($card_url); ?>" target="<?php echo esc_attr($card_target); ?>">
                            <?php if ($card_image_url) : ?>
                                <span class="hero-sector__card-media">
                                    <img src="<?php echo esc_url($card_image_url); ?>" alt="<?php echo esc_attr($get_media_alt($card_image)); ?>">
                                </span>
                            <?php endif; ?>

                            <span class="hero-sector__card-copy">
                                <span class="hero-sector__card-title p-big"><?php echo esc_html($card_title); ?></span>
                                <i class="hero-sector__card-icon icon icon-filcar-icon-arrow-downr" aria-hidden="true"></i>
                            </span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
