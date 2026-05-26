<?php
$image = get_field('immagine_az_text');
$title = get_field('titolo_az_text');
$text = get_field('testo_az_text');

$image_url = '';
$image_alt = $title ?: __('Azienda Image', 'filcar');
$image_id = 0;

if (is_array($image)) {
    $image_id = !empty($image['ID']) ? (int) $image['ID'] : 0;
    $image_url = $image['url'] ?? '';
    $image_alt = !empty($image['alt']) ? $image['alt'] : $image_alt;
} elseif (is_numeric($image)) {
    $image_id = (int) $image;
    $image_url = wp_get_attachment_image_url($image_id, 'full') ?: '';
    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: $image_alt;
} elseif (is_string($image)) {
    $image_url = trim($image);
}

if (!$image_url && !$title && !$text) {
    return;
}

$block_id = !empty($block['anchor']) ? $block['anchor'] : 'azienda-image-text-' . ($block['id'] ?? uniqid());
?>

<section id="<?php echo esc_attr($block_id); ?>" class="az-image-text sp-my-4 sp-xl-my-6">
    <div class="container-fluid">
        <?php if ($image_url) : ?>
            <div class="row align-items-center">
                <div class="col-lg-10 offset-lg-1 az-image-text__image-container">
                    <?php
                    if ($image_id) {
                        echo wp_get_attachment_image($image_id, 'full', false, [
                            'class' => 'img-fluid',
                            'alt' => esc_attr($image_alt),
                        ]);
                    } else {
                        ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="img-fluid">
                        <?php
                    }
                    ?>
                    <span class="innovation-scroll__bar"></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($title || $text) : ?>
            <div class="row align-items-start sp-pt-4 sp-xl-pt-6">
                <?php if ($title) : ?>
                    <div class="col-lg-4">
                        <h2 class="h3 light text-grey-500"><?php echo esc_html($title); ?></h2>
                    </div>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="col-lg-8<?php echo $title ? '' : ' offset-lg-4'; ?>">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
