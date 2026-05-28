        <?php
        if(!is_page('contatti')){
            if(isset($args['footer-color'])){
                get_template_part('parts/contact-form', null, ['footer-color' => $args['footer-color']]);
            }else{
                get_template_part('parts/contact-form');
            }
        }
        ?>
        <footer class="flc-main-footer bg-blog text-white sp-pt-8 sp-md-pt-5 sp-sxl-pt-16 sp-uxl-pt-23 sp-pb-6 sp-md-pb-18 sp-lg-pb-9 sp-sxl-pb-12">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-3 first-column-container sp-mb-6 sp-lg-mb-0">
                        <?php if ( is_active_sidebar( 'footer-area-1' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-area-1' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-lg-3">
                        <?php if ( is_active_sidebar( 'footer-area-2' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-area-2' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-lg-3">
                        <?php if ( is_active_sidebar( 'footer-area-3' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-area-3' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-lg-3">
                        <?php if ( is_active_sidebar( 'footer-area-4' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-area-4' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row copyright-area sp-mt-5 sp-md-mt-10 sp-llg-mt-8">
                    <!--
                    uxl: 1920px,
                    sxl: 1535px,
                    lg: 992px,
                    md: 768px
                    -->
                    <div class="col-12 col-lg-5 col-uxl-4">
                        <?php if ( is_active_sidebar( 'footer-area-5' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-area-5' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-uxl-5 offset-uxl-3 col-lg-6 offset-lg-1 links-container">
                        <?php if ( is_active_sidebar( 'footer-area-6' ) ) : ?>
                            <div class="footer-widget-area p-small">
                                <?php dynamic_sidebar( 'footer-area-6' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </footer>
        <!-- <footer class="footer-placeholder"></footer> -->
        <?php get_template_part('parts/floating-cta'); ?>
		<?php wp_footer(); ?>
	</body>
</html>
