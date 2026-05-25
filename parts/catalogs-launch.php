<?php
$args = $args ?? [];
$field_values = !empty($args['field_values']) && is_array($args['field_values']) ? $args['field_values'] : [];
$field_source = $args['field_source'] ?? null;
$get_value = static function ($name) use ($field_values, $field_source) {
    if (array_key_exists($name, $field_values)) {
        return $field_values[$name];
    }

    return $field_source ? get_field($name, $field_source) : get_field($name);
};

$title = $get_value('title');
$txt = $get_value('txt');
$cta = $get_value('cta');
$img = $get_value('img');
?>
<section id="catalogs-launch" class="section sp-py-9" data-anchor="catalogs-launch">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 col-lg-5 position-relative">
                <h2 class="h2 sp-mb-3 sp-lg-mb-4 fw-light catalogs-launch-title"><?php echo $title; ?></h2>
                <div class="sp-mb-3 sp-lg-mb-4 fw-normal">
                    <?php echo $txt; ?>
                </div>
                <?php
                if (!empty($cta)) :
                    $cta_image = $cta['img_cta'] ?? null;
                    $cta_img = is_array($cta_image) && !empty($cta_image['ID']) ? (int) $cta_image['ID'] : (is_numeric($cta_image) ? (int) $cta_image : 0);
                    $cta_txt = $cta['txt_cta'] ?? '';
                    $link_cta = $cta['link_cta'] ?? '';
                    $link_url = is_array($link_cta) ? ($link_cta['url'] ?? '') : $link_cta;
                    $link_target = is_array($link_cta) && !empty($link_cta['target']) ? $link_cta['target'] : '_self';
                ?>
                <?php if ($link_url && $cta_txt) : ?>
                <div class="catalogs-launch-cta sp-mt-4 sp-lg-mt-0">
                    <a href="<?php echo esc_url($link_url); ?>" class="rounded overflow-hidden sp-lg-pr-8 align-items-center text-decoration-none" target="<?php echo esc_attr($link_target); ?>"<?php echo $link_target === '_blank' ? ' rel="noopener"' : ''; ?>>
                        <?php
                        if($cta_img) :
                            echo wp_get_attachment_image($cta_img, 'catalogs-launch-cta-img', false, ['class' => 'catalogs-launch-cta-img']);
                        endif;
                        ?>
                        <div class="catalogs-launch-cta-txt p-small text-white">
                            <?php echo $cta_txt; ?>
                            <div class="catalogs-launch-cta-arrow">
                                <i class="icon-filcar-icon-arrow-downr"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="col-12 col-lg-6 offset-lg-1 catalogs-launch-img">
                <?php
                if($img) :
                    $img_url = $img['url'];
                    $img_alt = $img['alt'];
                ?>
                    <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>" class="w-100">
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
