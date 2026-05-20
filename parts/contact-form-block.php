<?php
$section_bg = get_field('section_bg');
switch($section_bg) {
    case 'bg-white':
        $text_cl = 'text-primary';
        break;
    case 'bg-primary':
        $text_cl = 'text-white';
        break;
    case 'bg-secondary':
        $text_cl = 'text-white';
        break;
}
$subtitle = get_field('subtitle');
$title = get_field('title');
$txt = get_field('txt');
$form = get_field('form');

?>
<section class="<?php echo $section_bg; ?> contact-form-section contact-form-block sp-py-5 sp-lg-py-12">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-12 offset-lg-3 <?php echo $text_cl; ?>">
                <?php
                if($subtitle):
                ?>
                <h3 class="product-3 sp-mb-5 text-secondary text-center"><?php echo $subtitle; ?></h3>
                <?php
                endif;
                if($title):
                ?>
                <h2 class="h3 fw-light sp-mb-5 text-center"><?php echo $title; ?></h3>
                <?php
                endif;
                if($txt):
                ?>
                <div class="fw-normal sp-mb-5 text-center">
                    <?php echo $txt; ?>
                </div>
                <?php
                endif;
                if($form):
                ?>
                <div class="contact-form">
                <?php
                    echo do_shortcode('[contact-form-7 id="' . $form . '" title="Contattaci"]');
                ?>
                </div>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</section>