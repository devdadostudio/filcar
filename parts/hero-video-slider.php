<?php
$slides = get_field('slides_hero_video');
$news_link = get_field('news_link');
$news_title = get_field('news_title');
$news_url = '';

if (is_array($news_link)) {
    $news_url = $news_link['url'] ?? '';
    $news_title = $news_title ?: ($news_link['title'] ?? '');
} elseif ($news_link instanceof WP_Post) {
    $news_url = get_permalink($news_link);
    $news_title = $news_title ?: get_the_title($news_link);
} elseif (is_numeric($news_link)) {
    $news_url = get_permalink((int) $news_link);
    $news_title = $news_title ?: get_the_title((int) $news_link);
} elseif (is_string($news_link)) {
    $news_url = $news_link;
}

if (!$news_url || !$news_title) {
    $latest_news = get_posts([
        'post_type' => 'post',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'ignore_sticky_posts' => true,
    ]);

    if (!empty($latest_news)) {
        $news_url = $news_url ?: get_permalink($latest_news[0]);
        $news_title = $news_title ?: get_the_title($latest_news[0]);
    }
}

if (empty($slides) || !is_array($slides)) {
    return;
}

$block_id = !empty($block['anchor']) ? $block['anchor'] : 'hero-video-slider-' . ($block['id'] ?? uniqid());
?>

<section id="<?php echo esc_attr($block_id); ?>" class="hero-video-slider js-hero-video-slider">
    <div class="hero-video-slider__stage">
        <?php foreach ($slides as $index => $slide) :
            $label = $slide['label'] ?? '';
            $title = $slide['title'] ?? '';
            $video = $slide['video'] ?? null;
            $video_url = is_array($video) ? ($video['url'] ?? '') : $video;
            $poster = $slide['poster'] ?? null;
            $poster_url = is_array($poster) ? ($poster['url'] ?? '') : (is_numeric($poster) ? wp_get_attachment_image_url($poster, 'full') : $poster);
            $slide_cta = $slide['cta'] ?? null;
            $slide_cta_url = '';
            $slide_cta_title = '';
            $slide_cta_target = '_self';

            if ($slide_cta) {
                $term = get_term((int) $slide_cta, 'cat-prod');

                if ($term && !is_wp_error($term)) {
                    $term_link = get_term_link($term);
                    $slide_cta_url = !is_wp_error($term_link) ? $term_link : '';
                    $slide_cta_title = __('Scopri', 'filcar');
                }
            }
        ?>
            <article class="hero-video-slider__slide <?php echo $index === 0 ? 'is-active' : ''; ?>" data-slide-index="<?php echo esc_attr($index); ?>">
                <?php if ($video_url) : ?>
                    <video class="hero-video-slider__video" src="<?php echo esc_url($video_url); ?>" <?php echo $poster_url ? 'poster="' . esc_url($poster_url) . '"' : ''; ?> muted playsinline preload="<?php echo $index === 0 ? 'auto' : 'metadata'; ?>"></video>
                <?php endif; ?>

                <div class="hero-video-slider__shade" aria-hidden="true"></div>

                <div class="container-fluid hero-video-slider__content">
                    <div class="hero-video-slider__copy">
                        <?php if ($label) : ?>
                            <p class="hero-video-slider__label h6 light"><?php echo esc_html($label); ?></p>
                        <?php endif; ?>

                        <?php if ($title) : ?>
                            <h2 class="hero-video-slider__title h0 extralight"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>
                        
                        <?php if ($slide_cta_url) : ?>
                            <a class="hero-video-slider__cta p-small" href="<?php echo esc_url($slide_cta_url); ?>" target="<?php echo esc_attr($slide_cta_target); ?>">
                                <span><?php echo esc_html($slide_cta_title); ?></span>
                                <i class="icon icon-filcar-icon-arrow-upr"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <div class="hero-video-slider__bottom">
        <div class="container-fluid">
            <div class="hero-video-slider__bottom-grid">
                <div class="hero-video-slider__nav" role="tablist" aria-label="<?php esc_attr_e('Slide hero', 'filcar'); ?>">
                    <?php foreach ($slides as $index => $slide) :
                        $label = $slide['label'] ?? '';
                    ?>
                        <button class="hero-video-slider__tab <?php echo $index === 0 ? 'is-active' : ''; ?>" type="button" data-slide-target="<?php echo esc_attr($index); ?>" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                            <span class="hero-video-slider__track">
                                <span class="hero-video-slider__progress"></span>
                            </span>
                            <?php if ($label) : ?>
                                <span class="hero-video-slider__tab-label p-smaller"><?php echo esc_html($label); ?></span>
                            <?php endif; ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <?php if ($news_url && $news_title) : ?>
                    <a class="hero-video-slider__news" href="<?php echo esc_url($news_url); ?>">
                        <span class="hero-video-slider__news-title h6 light"><?php echo esc_html($news_title); ?></span>
                        <i class="hero-video-slider__news-icon icon icon-filcar-icon-arrow-upr"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
