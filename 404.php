<?php get_header(); ?>
<main class="flc-padded-page">
    <section class="not-found overflow-hidden bg-primary700 height-100 d-flex">
        <div class="container position-relative d-lg-flex align-items-center text-center">
            <div class="not-found-content-left">
                <h1 class="text-white termina bold"><?php _e('404', 'flc'); ?></h1>
                
                <div class="mt-5">
                    <a href="<?php echo home_url(); ?>" class="btn btn-outline-light">
                        <span><?php echo __("Torna alla homepage", 'flc'); ?></span>
                    </a>
                </div>
            </div>
            <div class="not-found-content-right flc-respimg">
                <img class="respimg" src="<?php echo get_template_directory_uri(); ?>/img/utilities/Gartec-404.png" alt="Pagina non trovata" >
            </div>
        </div>
    </section>
</main>



<?php get_footer(); ?>