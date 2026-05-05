<?php
$content = get_field('innovation_scroll');
$content = is_array($content) ? $content : [];

$intro_text = ($content['intro_text'] ?? '') ?: (get_field('intro_text') ?: __('Tecnologie e impianti per la sicurezza e l’efficienza degli ambienti di lavoro', 'filcar'));
$heading = ($content['heading'] ?? '') ?: (get_field('heading') ?: __('Spinti dall’Innovazione, definiti dall’Eccellenza.', 'filcar'));
$body = ($content['body'] ?? '') ?: (get_field('body') ?: __('Innovazione, passione, funzionalità sono i nostri valori. Migliorare la produttività e l’efficienza sul lavoro è il nostro obiettivo. Sviluppiamo soluzioni tecniche pensate per rispondere alle reali esigenze operative di officine, industrie e ambienti professionali, con l’obiettivo di migliorare produttività, sicurezza e qualità del lavoro. Dall’analisi dei processi alla realizzazione degli impianti, uniamo competenze ingegneristiche, attenzione ai dettagli e visione evolutiva per offrire sistemi affidabili, efficienti e pronti ad adattarsi alle sfide future del settore.', 'filcar'));
$image = ($content['image'] ?? null) ?: get_field('image');
$image_url = '';
$image_alt = '';

if (is_array($image)) {
    $image_url = $image['url'] ?? '';
    $image_alt = $image['alt'] ?? '';
} elseif (is_numeric($image)) {
    $image_url = wp_get_attachment_image_url((int) $image, 'full');
    $image_alt = get_post_meta((int) $image, '_wp_attachment_image_alt', true);
} elseif (is_string($image)) {
    $image_url = $image;
}

if (!$image_url) {
    $slides = get_field('slides_hero_video');
    $first_slide = is_array($slides) ? ($slides[0] ?? null) : null;
    $poster = is_array($first_slide) ? ($first_slide['poster'] ?? null) : null;

    if (is_array($poster)) {
        $image_url = $poster['url'] ?? '';
        $image_alt = $poster['alt'] ?? '';
    } elseif (is_numeric($poster)) {
        $image_url = wp_get_attachment_image_url((int) $poster, 'full');
        $image_alt = get_post_meta((int) $poster, '_wp_attachment_image_alt', true);
    } elseif (is_string($poster)) {
        $image_url = $poster;
    }
}

$block_id = !empty($block['anchor']) ? $block['anchor'] : 'innovation-scroll-' . ($block['id'] ?? uniqid());
?>

<section id="<?php echo esc_attr($block_id); ?>" class="innovation-scroll js-innovation-scroll">
    <div class="innovation-scroll__pin">
        <div class="innovation-scroll__media-wrap">
            <figure class="innovation-scroll__media">
                <?php if ($image_url) : ?>
                    <img class="innovation-scroll__image" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                <?php endif; ?>
                <span class="innovation-scroll__bar" aria-hidden="true"></span>
            </figure>
        </div>

        <div class="innovation-scroll__intro">
            <div class="innovation-scroll__intro-title h2 light"><?php echo wp_kses_post($intro_text); ?></div>
        </div>

        <div class="container-fluid innovation-scroll__content">
            <div class="innovation-scroll__content-grid">
                <h3 class="innovation-scroll__title light"><?php echo esc_html($heading); ?></h3>
                <div class="innovation-scroll__body">
                    <?php echo wp_kses_post($body); ?>
                </div>
            </div>
        </div>
    </div>
</section>
