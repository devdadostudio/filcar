<?php
$block_title = get_field('title_contact', 'option');
$block_text = get_field('txt_contact', 'option');
$form = get_field('form_contact', 'option');
$img = get_field('img_contact', 'option');
$img_mob = get_field('img_contact_mob', 'option');
?>
<section class="contact-form position-relative overflow-hidden sp-pt-6 sp-pb-0 sp-md-pt-13 sp-llg-pt-13 sp-llg-pb-8 bg-grey">
    <div class="position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <figure class="respimg sp-mb-0">
                        <img src="<?php echo $img; ?>" alt="contatti">
                    </figure>
                </div>
                <div class="col-12 col-lg-6">
                    <?php
                    if($block_title){
                    ?>
                        <h2 class="h2-as-label"><?php echo $block_title; ?></h2>
                    <?php
                    }
                    if($block_text){
                    ?>
                        <div class="mb-0-p">
                            <?php echo $block_text; ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-12 col-llg-6 sp-mt-4 sp-llg-mt-0">
                    <?php echo do_shortcode('[contact-form-7 id="' . $form . '" title="Contattaci"]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>