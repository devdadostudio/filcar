<?php
    $subtitle_hero = get_field('subtitle_hero');
    $txt_hero = get_field('txt_hero');
?>
<section class="position-relative section-hero-product d-flex align-items-center h-100vh-header">
    <div class="breadcrumbs">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-4 p-smaller text-grey-600">
                    <?php
                    if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    $thumb_id = get_post_thumbnail_id();
    ?>
    <div class="row bg-container position-absolute w-100 h-100 sp-m-0 image-container-section">
        <div class="offset-lg-5 col-12 col-lg-7 sp-pl-0 mh-100 sp-pr-0 d-flex align-items-center justify-content-center column-img-bg-product">
            <figure class="respimg sp-mb-0 img-container">
                <img src="<?php echo wp_get_attachment_image_url($thumb_id, 'full'); ?>" alt="<?php echo get_the_title(); ?>">
            </figure>
        </div>
    </div>
    <div class="container-fluid position-relative text-container">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="product-hero__content text-grey-500">
                    <?php the_title('<h1 class="product-1 fw-normal sp-mb-3 sp-sxl-mb-4 sp-uxl-mb-5">', '</h1>'); ?>
                    <!-- subtitle -->
                    <?php if ($subtitle_hero) : ?>
                        <div class="h5 fw-light sp-mb-3 sp-sxl-mb-5 sp-uxl-mb-7">
                            <?php echo $subtitle_hero; ?>
                        </div>
                    <?php endif; ?>
                    <!-- testo -->
                    <?php if ($txt_hero) : ?>
                        <div class="p-big fw-normal">
                            <?php echo $txt_hero; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>