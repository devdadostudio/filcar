<?php
    $title_section = get_field('title_section_centered_txt');
    $txt_section = get_field('txt_section_centered_txt');
    $img_section = get_field('img_section_centered_txt');
?>
<section id="panoramica" class="bg-primary d-flex align-items-center sp-py-10 js-section" data-anchor="panoramica">
    <div class="container-fluid position-relative sp-px-0">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2 col-uxl-6 offset-uxl-3 text-center">
                <div class="product-3 text-secondary">
                    <?php echo strtoupper(get_the_title()); ?>
                </div>
                <?php if ($title_section) : ?>
                    <h2 class="h5 fw-light sp-mt-2 sp-md-mt-3 sp-lg-mt-4 text-white">
                        <?php echo $title_section; ?>
                    </h2>
                <?php endif;
                if ($txt_section) : ?>
                <div class="p-big fw-light sp-mt-2 sp-md-mt-3 sp-lg-mt-4 text-white">
                    <?php echo $txt_section; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php if ($img_section) : ?>
                <div class="col-lg-10 offset-lg-1 col-12 sp-mt-5">
                    <figure class="respimg sp-mb-0 aspect-ratio-16x7">
                        <img src="<?php echo $img_section['url']; ?>" alt="<?php if($img_section['alt']) echo $img_section['alt']; else echo get_the_title()  ?>" class="w-100">
                    </figure>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>