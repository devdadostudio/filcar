        <?php get_template_part('parts/contact-form'); ?>
        <?php get_template_part('parts/section-newsletter'); ?>
        <footer class="flc-main-footer sp-pt-9 sp-pb-3 sp-sxl-pt-8 sp-sxl-pb-4 bg-blog text-white">
            <div class="container-fluid">
                <div class="row sp-md-gap-7 sp-llg-gap-0">
                    <div class="col-12 col-md-4 col-llg-2 first-column-container">
                        <?php if ( is_active_sidebar( 'footer-area-1' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-area-1' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-2 d-none d-llg-block">
                        <?php if ( is_active_sidebar( 'footer-area-2' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-area-2' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-2 d-none d-llg-block">
                        <?php if ( is_active_sidebar( 'footer-area-3' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-area-3' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-2 d-none d-llg-block">
                        <?php if ( is_active_sidebar( 'footer-area-4' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-area-4' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-2 d-none d-llg-block">
                        <?php if ( is_active_sidebar( 'footer-area-5' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-area-5' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-2 d-none d-llg-block">
                        <?php if ( is_active_sidebar( 'footer-area-6' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-area-6' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-md-8 d-block d-llg-none footer-mobile-container sp-mt-6 sp-md-mt-0">
                        <?php if ( is_active_sidebar( 'footer-mobile-menu' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-mobile-menu' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row copyright-area sp-mt-5 sp-md-mt-10 sp-llg-mt-8">
                    <div class="col-12">
                        <?php if ( is_active_sidebar( 'copyright-footer' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'copyright-footer' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </footer>
		<?php wp_footer(); ?>
	</body>
</html>
