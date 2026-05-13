<?php
get_header();
?>
<main id="main-content-search" class="bg-grey-200">
    <div class="search-sticky-wrapper">
        <section class="section-search bg-primary">
            <?php
            get_template_part('parts/breadcrumbs', null, [
                'variant' => 'dark',
                'layout' => 'inline',
                'class' => 'search-breadcrumbs sp-pt-5 sp-pb-7',
                'col_class' => 'col-6',
                'items' => [
                    ['label' => __('Home', 'filcar'), 'url' => home_url('/')],
                    ['label' => __('Ricerca', 'filcar')],
                ],
            ]);
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 sp-px-0">
                        <div class="search-title sp-mb-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="search-title">
                                        <h1 class="subtitle-1 text-white">RICERCA</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="search-in-page bg-primary">
            <div class="search-container container-fluid sp-pb-5">
                <div class="row">
                    <div class="col-12 sp-px-0 sp-md-px-6 sp-sxl-px-16">
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $product_query = new WP_Query([
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
            's' => get_search_query(),
        ]);
        $blog_query = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
            's' => get_search_query(),
        ]);
        $case_study_query = new WP_Query([
            'post_type' => 'caso-studio',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
            's' => get_search_query(),
        ]);
        $number_products = $product_query->found_posts;
        if($blog_query->found_posts > 0) {
            $number_products += $blog_query->found_posts;
        }
        if($case_study_query->found_posts > 0) {
            $number_products += $case_study_query->found_posts;
        }
        if ( $product_query->have_posts() ) :
        ?>
        <section class="section-search-results bg-grey-200">
            <div class="container-fluid">
                <div class="row">
                    <div class="sp-mt-3 number-results">
                        <div class="text-grey-500">
                            <?php echo $number_products; echo ' ' . ($number_products == 1 ? 'Risultato trovato' : 'Risultati trovati'); ?>
                        </div>
                    </div>
                    <div class="col-12 sp-py-5 p-bigger">
                        Prodotti
                    </div>
                    <div class="col-12">
                        <div class="border-bottom-black sp-pb-6">
                            <div class="row sp-row-gap-4">
                                <?php while ( $product_query->have_posts() ) : $product_query->the_post();
                                    get_template_part('parts/card/card', 'product', ['card_class' => 'col-12 col-md-6 col-lg-4 col-sxl-3']);
                                endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <?php if ( $blog_query->have_posts() ) :
        ?>
        <section class="section-search-results bg-grey-200">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 sp-py-5 p-bigger">
                        Blog
                    </div>
                    <div class="col-12">
                        <div class="border-bottom-black sp-pb-6">
                            <div class="row sp-row-gap-4">
                                <?php while ( $blog_query->have_posts() ) : $blog_query->the_post();
                                    get_template_part('parts/card/card', 'post', ['card_class' => 'col-12 col-md-6 col-lg-4 col-sxl-3']);
                                endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <?php if ( $case_study_query->have_posts() ) :
        ?>
        <section class="section-search-results section-search-results-case bg-grey-200">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 sp-py-5 p-bigger">
                        Case Studies
                    </div>
                    <div class="col-12">
                        <div class="border-bottom-black sp-pb-6">
                            <div class="row sp-row-gap-4">
                                <?php while ( $case_study_query->have_posts() ) : $case_study_query->the_post();
                                    get_template_part('parts/card/card', 'case-study', ['card_class' => 'col-12 col-md-6 col-lg-4']);
                                endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
    </div>
</main>
<?php
get_footer();
?>
