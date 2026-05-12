<?php
get_header();
?>
<section class="section-search bg-primary">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 sp-px-0">
                <div class="search-breadcrumbs breadcrumbs sp-pt-5 sp-pb-7">
                    <div class="row">
                        <div class="col-6 p-smaller text-grey-600">
                            <span>
                                <span>
                                    <a href="<?php echo home_url(); ?>" class="text-grey-600 text-decoration-none">Home</a>
                                </span> <i class="icon-filcar-icon-chevron-forward"></i> 
                                <span class="breadcrumb_last" aria-current="page">Ricerca</span>
                            </span>
                        </div>
                        <div class="col-6 d-flex justify-content-end text-white">
                            <div class="search-close">
                                <i class="icon-filcar-icon-close"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-title sp-mb-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="search-title">
                                <h1 class="subtitle-1 text-white">RICERCA</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-container sp-mb-5">
                    <div class="col-12 sp-px-0 sp-md-px-6 sp-sxl-px-16">
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
if ( $product_query->have_posts() ) :
$number_products = $product_query->found_posts;
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
<?php
get_footer();
?>