<?php
$label = get_field('label');
$title = get_field('title');
$text = get_field('text');
$video = get_field('video');
$poster = get_field('poster');
$cta = get_field('cta');

$video_url = is_array($video) ? ($video['url'] ?? '') : $video;
$poster_url = is_array($poster) ? ($poster['url'] ?? '') : (is_numeric($poster) ? wp_get_attachment_image_url($poster, 'full') : $poster);
$cta_url = is_array($cta) ? ($cta['url'] ?? '') : '';
$cta_title = is_array($cta) ? ($cta['title'] ?? __('Scopri', 'filcar')) : __('Scopri', 'filcar');
$cta_target = is_array($cta) && !empty($cta['target']) ? $cta['target'] : '_self';

if (!$video_url && !$title && !$text) {
    return;
}

$block_id = !empty($block['anchor']) ? $block['anchor'] : 'hero-video-' . ($block['id'] ?? uniqid());
?>

<section id="<?php echo esc_attr($block_id); ?>" class="hero-video-slider">
    <div class="hero-video-slider__stage">
        <?php if ($video_url) : ?>
            <video class="hero-video-slider__video" src="<?php echo esc_url($video_url); ?>" <?php echo $poster_url ? 'poster="' . esc_url($poster_url) . '"' : ''; ?> autoplay muted loop playsinline preload="auto"></video>
        <?php endif; ?>

        <div class="hero-video-slider__shade" aria-hidden="true"></div>

        <?php
        get_template_part('parts/breadcrumbs', null, [
            'variant' => 'dark',
            'layout' => 'overlay',
            'class' => 'hero-video-slider__breadcrumb',
            'col_class' => 'col-12',
        ]);
        ?>

        <div class="container-fluid hero-video-slider__content">
            <div class="row w-100">
                <div class="col-12 col-lg-9 col-xl-8 col-uxl-7">
                    <div class="hero-video-slider__copy">
                        <?php if ($label) : ?>
                            <p class="hero-video-slider__label product-3 fw-normal text-uppercase"><?php echo esc_html($label); ?></p>
                        <?php endif; ?>

                        <?php if ($title) : ?>
                            <h1 class="hero-video-slider__title h0 extralight"><?php echo $title; ?></h1>
                        <?php endif; ?>

                        <?php if ($text) : ?>
                            <div class="hero-video-slider__text h7 fw-normal">
                                <?php echo wp_kses_post($text); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($cta_url) : ?>
                            <a class="hero-video-slider__cta p-small" href="<?php echo esc_url($cta_url); ?>" target="<?php echo esc_attr($cta_target); ?>">
                                <span><?php echo esc_html($cta_title); ?></span>
                                <i class="icon icon-filcar-icon-arrow-upr"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
