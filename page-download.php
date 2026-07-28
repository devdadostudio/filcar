<?php
/*
Template Name: Download
*/
get_header();
$page_title = get_field('page_title');
?>
<section class="bg-primary hero-download flc-hero-section position-relative">
    <?php
    get_template_part('parts/breadcrumbs', null, [
        'variant' => 'dark',
        'layout' => 'overlay',
        'class' => 'hero-sector__breadcrumb',
        'col_class' => 'col-12',
        'items' => [
            ['label' => __('Home', 'filcar'), 'url' => home_url('/')],
            ['label' => __(get_the_title(), 'filcar'), 'url' => home_url('/download-media')],
        ],
    ]);
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 text-white sp-pt-11 sp-lg-pt-16 sp-pb-5 sp-lg-pb-8">
                <h1 class="product-3 semibold">
                    <?php the_title(); ?>
                </h1>
                <h2 class="h0 extralight">
                    <?php echo $page_title; ?>
                </h2>
            </div>
        </div>
    </div>
</section>
<?php
the_content();
get_footer();
?>