<?php get_header(); ?>
<main class="flc-padded-page">
    <section class="not-found overflow-hidden bg-primary700 height-100 d-flex h-100vh-header">
        <div class="not-found-content-left w-100">
            <div class="h-100 d-flex flex-column justify-content-center align-items-center">
                <h1 class="text-white termina bold h-0 sp-mb-0"><?php _e('404', 'flc'); ?></h1>
                <div class="container-fluid">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-6 col-12">
                            <div class="w-100 respimg">
                                <img src="wp-content/themes/filcar/img/404.webp" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sp-mt-5 sp-lg-mt-8 text-center">
                    <a href="<?php echo home_url(); ?>" class="btn btn-secondary-1">
                        <span><?php echo __("Torna alla homepage", 'flc'); ?> <i class="icon-filcar-icon-arrow-upr"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>



<?php get_footer(); ?>