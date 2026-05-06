<?php
$subtitle_block = get_field('subtitle_block');
$txt_block = get_field('txt_block');
$cta_block = get_field('cta_block');
$sectors = get_field('sectors');
if(!empty($sectors)) {
    $sectors_c = count($sectors);
?>
    <section class="img-txt sp-py-11 sp-lg-py-16 sp-sxl-py-23">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-4 sp-mt-7 sp-mb-0 sp-lg-my-7 txt-container d-flex flex-column justify-content-between">
                    <div>
                        <?php
                        if($subtitle_block) :
                        ?>
                        <div class="product-3 fw-normal text-secondary">
                            <?php echo $subtitle_block; ?>
                        </div>
                        <?php
                        endif;
                        ?>
                        <div class="h7 fw-normal text-primary">
                            <?php echo $txt_block; ?>
                        </div>
                    </div>
                    <div>
                        <?php if($cta_block) : ?>
                        <a class="btn btn-secondary-1" href="<?php echo $cta_block['url']; ?>"><span><?php echo $cta_block['title']; ?><span class="icon-filcar-icon-arrow-upr"></span></span></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($sectors_c > 0) : ?>
                    <div class="col-12 col-lg-8">
                        <div class="owl-carousel carousel-sectors">
                            <?php for($i = 0; $i < $sectors_c; $i++) :
                                get_template_part('parts/card/card-sector');
                            endfor; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php
}
?>