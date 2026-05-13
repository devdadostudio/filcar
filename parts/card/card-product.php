<?php
$prod_id = get_the_ID();

?>
<div class="<?php echo $args['card_class']; ?> card-product">
    <div class="product-card h-100">
        <a class="product-card-inner sp-lg-pb-7 sp-sxl-pb-9 sp-uxl-pb-15 h-100 justify-content-between" href="<?php echo get_the_permalink($prod_id); ?> ">
            <div class="product-card-content">
                <h2 class="card-title product-2 text-grey500">
                    <?php echo get_the_title($prod_id); ?>
                </h2>
                <span class="card-subtitle body-4 text-grey500">
                    <?php echo get_field('card_desc', $prod_id); ?>
                </span>
                <div class="card-link-arrow">
                    <i class="icon-filcar-icon-arrow-upr"></i>
                </div>
            </div>
            <?php
            $img = get_post_thumbnail_id($prod_id);
            if($img) : ?>
                <div class="product-card-image d-flex justify-content-center w-100 sp-mt-0 sp-lg-mt-7 sp-sxl-mt-9 sp-uxl-mt-15">
                    <img src="<?php echo wp_get_attachment_image_url($img, 'product-car-thumb'); ?>" alt="" class="">
                </div>
            <?php endif; ?>
            <div class="card-info p-smaller text-white bg-primary sp-p-2 sp-lg-pt-3 sp-lg-pb-4 sp-lg-px-3 mb-0-p">
                <?php echo get_field('info-product-card', $prod_id); ?>
            </div>
        </a>
    </div>
</div>