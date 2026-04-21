<section class="product-anchors-section js-anchors-layout">

    <div class="product-anchors-section__inner bg-primary">

        <!-- NAV ANCORE -->
        <aside class="page-header js-page-header">
            <div class="anchor-nav-wrap js-anchor-nav-wrap">
                <nav class="anchor-nav" aria-label="Navigazione sezioni">
                    <a
                        href="#panoramica"
                        class="anchor-link is-active subtitle-4 user-select-none"
                        data-target="#panoramica"
                        ><span class="number-3 anchor-number text-white">01</span>Panoramica</a
                    >
                    <a href="#caratteristiche" class="anchor-link subtitle-4 user-select-none" data-target="#caratteristiche"
                        ><span class="number-3 anchor-number text-white">02</span>Caratteristiche</a
                    >
                    <a href="#dimensioni" class="anchor-link subtitle-4 user-select-none" data-target="#dimensioni"
                        ><span class="number-3 anchor-number text-white">03</span>Dimensioni</a
                    >
                    <a href="#dettagli" class="anchor-link subtitle-4 user-select-none" data-target="#dettagli"
                        ><span class="number-3 anchor-number text-white">04</span>Dettagli</a
                    >
                    <a href="#accessori" class="anchor-link subtitle-4 user-select-none" data-target="#accessori"
                        ><span class="number-3 anchor-number text-white">05</span>Optional</a
                    >
                    <a href="#correlati" class="anchor-link subtitle-4 user-select-none" data-target="#correlati"
                        ><span class="number-3 anchor-number text-white">06</span>Correlati</a
                    >
                </nav>
            </div>
        </aside>

        <!-- CONTENUTO -->
        <div class="product-anchor-content">
            <div class="button-sticky-container">
                <a href="#contactForm" class="button-sticky button-cta btn text-capitalize">Richiedi info</a>
            </div>
            <!-- PANORAMICA -->
            <div id="panoramica" class="bg-primary d-flex align-items-center sp-pt-10 js-section" data-anchor="panoramica">
                <div class="container-fluid position-relative">
                    <?php get_template_part('parts/products/text-centered-img', ''); ?>
                    <?php get_template_part('parts/products/video-section', ''); ?>
                    <?php get_template_part('parts/products/slider-text', ''); ?>
                </div>
            </div>
            <!-- CARATTERISTICHE -->
            <?php get_template_part('parts/products/caratteristiche-block', ''); ?>
            <!-- DIMENSIONI -->
            <?php get_template_part('parts/products/dimensioni', 'block'); ?>
            <!-- DETTAGLI -->
            <?php get_template_part('parts/products/slider-with-external-txt', ''); ?>
            <!-- ACCESSORI -->
            <?php get_template_part('parts/products/accessori-block', ''); ?>
            <!-- CORRELATI -->
            <?php get_template_part('parts/products/related', ''); ?>
        </div>
    </div>
</section>