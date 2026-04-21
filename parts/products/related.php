<?php
$related = get_field('related');
$related_c = count($related);
if($related_c > 0) :
?>
    <section id="correlati" class="section js-section sp-py-6 sp-lg-py-8" data-anchor="correlati">
        <div class="section-inner container-fluid">
            <div class="subtitle-header sp-mb-4 sp-xl-mb-6">
                <h2 class="h6 text-secondary text-uppercase semibold">Correlati</h2>
            </div>
            <div class="row sp-row-gap-4">
                <?php
                for($i = 0; $i < $related_c; $i++) :
                    $prod_id = $related[$i];
                ?>
                    <div class="col-6 col-xl-3">
                        <div class="product-card h-100">
                            <div class="product-card-inner sp-pb-7 sp-sxl-pb-9 sp-uxl-pb-15 h-100 justify-content-between">
                                <div class="product-card-content">
                                    <h2 class="card-title product-2 text-grey500">
                                        <?php echo get_the_title($prod_id); ?>
                                    </h2>
                                    <span class="card-subtitle body-4 text-grey500">
                                        <?php echo get_field('card_desc', $prod_id); ?>
                                    </span>
                                </div>
                                <?php
                                $img = get_post_thumbnail_id($prod_id);
                                if($img) : ?>
                                    <div class="product-card-image d-flex justify-content-center w-100 sp-mt-7 sp-sxl-mt-9 sp-uxl-mt-15">
                                        <img src="<?php echo wp_get_attachment_image_url($img, 'product-car-thumb'); ?>" alt="">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>
<?php endif; ?>