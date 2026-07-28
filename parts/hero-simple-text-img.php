<?php
get_header();
$subtitle = get_field('subtitle');
$title = get_field('title');
$txt_cta = get_field('txt_cta');
$link_cta = get_field('link_cta');
$img = get_field('img');
?>

<section class="position-relative section-hero-product section-hero-cat-prod-second d-flex align-items-center">
    <?php
    get_template_part('parts/breadcrumbs', null, [
        'variant' => 'light',
        'layout' => 'overlay',
        'class' => 'product-hero__breadcrumb category-second-hero__breadcrumb',
        'mobile_bg' => true,
    ]);
    ?>

    <div class="container-fluid-left-llg position-relative text-container category-second-hero__inner">
        <div class="row align-items-center">
            <div class="col-12 col-lg-4 order-2 order-lg-1">
                <div class="product-hero__content category-second-hero__content">
                    <div class="product-3 fw-semibold text-uppercase sp-mb-3">
                        <?php echo $subtitle; ?>
                    </div>
                    <h1 class="h0 extralight sp-mb-3 sp-sxl-mb-4 sp-uxl-mb-5">
                        <?php echo $title; ?>
                    </h1>
                    <div class="cta-content">
                        <a href="<?php echo $link_cta; ?>" class="btn btn-outline-primary"><?php echo $txt_cta; ?> <i class="icon icon-filcar-icon-arrow-downr"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-7 offset-lg-1 order-1 order-lg-2 sp-mb-8 sp-lg-mb-0 category-second-hero__visual-col">
                <div class="category-second-hero__visual">
                    <figure class="category-second-hero__image respimg sp-mb-0">
                        <?php
                        if ($img) {
                            echo wp_get_attachment_image($img['ID'], 'full', false, [
                                'alt' => $img['alt'] ? $img['alt'] : '',
                            ]);
                        } else {
                            echo '<img src="https://placehold.co/900x900" alt="">';
                        }
                        ?>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>