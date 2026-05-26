<?php
$section_bg = get_field('section_bg') ?: 'bg-primary';
$title = get_field('titoletto');
$addresses = get_field('blocco_indirizzi');
$image = get_field('immagine_indirizzi');

$subtitle_cl = 'text-secondary';
$text_cl = 'text-white';

switch ($section_bg) {
    case 'bg-white':
        $subtitle_cl = 'text-secondary';
        $text_cl = 'text-primary';
        break;
    case 'bg-primary':
        $subtitle_cl = 'text-grey-600';
        $text_cl = 'text-white';
        break;
    case 'bg-secondary':
        $subtitle_cl = 'text-white';
        $text_cl = 'text-white';
        break;
    case 'bg-grey-200':
        $subtitle_cl = 'text-secondary';
        $text_cl = 'text-primary';
        break;
}

$image_id = is_array($image) && !empty($image['ID']) ? (int) $image['ID'] : 0;
$image_alt = is_array($image) && !empty($image['alt']) ? $image['alt'] : $title;
$has_addresses = is_array($addresses) && !empty($addresses);

if (!$title && !$has_addresses && !$image_id) {
    return;
}

$block_id = !empty($block['anchor']) ? $block['anchor'] : 'prefooter-contatti-' . ($block['id'] ?? uniqid());
?>

<section id="<?php echo esc_attr($block_id); ?>" class="prefooter-contacts <?php echo esc_attr($section_bg); ?> sp-pt-11 sp-pb-6 sp-lg-py-16 sp-sxl-py-23">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12<?php echo $image_id ? ' col-md-6 col-lg-8' : ''; ?>">
                <?php if ($title) : ?>
                    <h3 class="h6 text-uppercase <?php echo esc_attr($subtitle_cl); ?>"><?php echo esc_html($title); ?></h3>
                <?php endif; ?>

                <?php if ($has_addresses) : ?>
                    <?php foreach ($addresses as $index => $address_group) : ?>
                        <?php
                        $group_name = $address_group['nome_gruppo_indirizzi'] ?? '';
                        $left_text = $address_group['testo_sinistra_indirizzi'] ?? '';
                        $address_text = $address_group['indirizzi'] ?? '';

                        if (!$group_name && !$left_text && !$address_text) {
                            continue;
                        }
                        ?>
                        <div class="prefooter-contacts__info <?php echo esc_attr($text_cl); ?>" id="<?php echo esc_attr('address' . ((int) $index + 1)); ?>">
                            
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1">
                                    <div class="row">
                                        <div class="col-12">
                                            <?php if ($group_name) : ?>
                                                <h4 class="h7 sp-mt-6 sp-mt-lg-10 <?php echo esc_attr($text_cl); ?> regular"><?php echo esc_html($group_name); ?></h4>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($left_text) : ?>
                                            <div class="col-4 sp-mt-4 sp-mt-lg-8">
                                                <?php echo wp_kses_post($left_text); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($address_text) : ?>
                                            <div class="col-4 offset-2">
                                                <div class="<?php echo esc_attr($text_cl); ?> prefooter-contacts__addressblock"><?php echo wp_kses_post($address_text); ?></div>
                                                
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php if ($image_id) : ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="respimg">
                        <?php
                        echo wp_get_attachment_image($image_id, 'full', false, [
                            'alt' => esc_attr($image_alt),
                        ]);
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
