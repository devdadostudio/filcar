<?php
$img = get_field('img');
$txt_blocks = get_field('txt_blocks');
?>
<section class="section-img-4-txt-blocks bg-grey-200 sp-pt-5 sp-pb-6 sp-md-pt-21 sp-md-pb-9 sp-uxl-pb-8">
    <div class="section-inner container-fluid">
        <div class="row">
            <div class="col-12 col-lg-5 sp-mb-4 sp-lg-mb-0">
                <figure class="respimg rounded overflow-hidden h-100 w-100 img-figure aspect-ratio-1x1">
                    <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" class="w-100">
                </figure>
            </div>
            <?php
            if(!empty($txt_blocks)) {
                $txt_blocks_c = count($txt_blocks);
            ?>
                <div class="col-12 col-lg-6 offset-lg-1 sp-py-0 sp-sxl-py-9 sp-uxl-py-10">
                    <div class="row sp-gap-5 sp-lg-gap-0 sp-lg-row-gap-7">
                        <?php
                        for($i = 0; $i < $txt_blocks_c; $i++) {
                            $txt_block = $txt_blocks[$i];
                        ?>
                            <div class="col-12 col-lg-6 cta-section">
                                <div class="d-flex align-items-end">
                                    <div class="col-12 col-sxl-10">
                                        <h3 class="h3 fw-normal">
                                            <?php echo $txt_block['title']; ?>
                                        </h3>
                                        <div class="fw-normal text-grey-600 mb-0-p">
                                            <?php echo $txt_block['txt']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>