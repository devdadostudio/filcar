<section class="product-anchors-section js-anchors-layout">

    <div class="product-anchors-section__inner">

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

            <!-- PANORAMICA -->
            <?php get_template_part('parts/products/text-centered', 'img'); ?>
            <!-- CARATTERISTICHE -->
            <?php get_template_part('parts/products/caratteristiche', 'block-statico'); ?>
            <!-- DIMENSIONI -->
            <?php get_template_part('parts/products/dimensioni', 'block-statico'); ?>
            <!-- CORRELATI -->
            <!-- <section id="correlati" class="section js-section" data-anchor="correlati">
                <div class="section-inner container-fluid">
                    <h2>Correlati</h2>

                    <div class="product-related-grid">

                        <div class="product-related-card">
                        <img src="" alt="">
                        <h3>Prodotto correlato 1</h3>
                        </div>

                        <div class="product-related-card">
                        <img src="" alt="">
                        <h3>Prodotto correlato 2</h3>
                        </div>

                    </div>
                </div>
            </section> -->

        </div>
    </div>
</section>