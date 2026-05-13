<?php
$title = get_field('title');
$txt = get_field('txt');
$cta = get_field('cta');
$img = get_field('img');
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
                    $cta_img = $cta['img_cta']['ID'];
                    $cta_txt = $cta['txt_cta'];
                    $link_cta = $cta['link_cta'];
                ?>
                <div class="catalogs-launch-cta sp-mt-4 sp-lg-mt-0">
                    <a href="<?php echo esc_url($link_cta); ?>" class="rounded overflow-hidden sp-lg-pr-8 align-items-center text-decoration-none">
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