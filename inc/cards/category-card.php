<?php
$cat = $args['cat'];
$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
$insight = get_field('insight', 'product_cat_' . $cat->term_id);
$pdf = $insight['pdf'];
//img-cat-card
?>
<div class="col-12 col-md-6 col-llg-4 cat-card">
    <div class="h-100 bg-white">
        <div class="d-flex align-items-center bg-primary sp-gap-3">
            <div class="bg-grey image-container sp-py-1 sp-pl-4 sp-pr-7 sp-md-pr-6 sp-sxl-py-2 sp-sxl-pl-4 sp-sxl-pr-7 clip-path-right-20 ">
                <figure class="figure-70 sp-mb-0 respimg">
                    <?php echo wp_get_attachment_image($thumbnail_id , 'img-cat-card', false, array('class' => 'z-0', 'alt' => $cat->name)); ?>
                </figure>
            </div>
            <div class="text-white sp-pr-2">
                <h2 class="p-normal mb-0 text-white"><?php echo $cat->name; ?></h2>
            </div>
        </div>
        <div class="bg-white sp-p-4 sp-llg-py-4 sp-llg-px-5 sp-sxl-py-6 sp-sxl-px-6 d-flex flex-column justify-content-between desc-container">
            <div class="mb-0-p">
                <p><?php echo $cat->description; ?></p>
            </div>
            <div class="row sp-mt-4 sp-md-mt-5 sp-llg-mt-7">
                <div class="col-8 col-sxl-7 cta-container d-flex flex-column">
                    <a href="<?php echo get_term_link($cat); ?>" class="btn btn-secondary btn-small"><span><?php echo __("VAI ALLA RICERCA", 'flc'); ?></span></a>
                    <a href="<?php echo $pdf; ?>" class="btn btn-outline-secondary btn-small" download><span class="d-flex align-items-center justify-content-center"><?php echo __("download pdf", 'flc'); ?> <span class="material-symbols-outlined">download</span></span></a>
                </div>
                <?php
                $logo_produttore_categoria = get_field('logo_produttore_categoria', 'product_cat_' . $cat->term_id);
                if($logo_produttore_categoria){?>
                    <div class="col-4 col-sxl-5">
                        <figure class="respimg sp-mb-0">
                            <?php echo wp_get_attachment_image($logo_produttore_categoria, 'catalogo-logo', false, array('alt' => $cat->name)); ?>
                        </figure>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>