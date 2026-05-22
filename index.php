<?php
get_header();

$latest_posts = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 1,
    'post_status' => 'publish',
    'ignore_sticky_posts' => true,
));

$featured_post_id = 0;
?>

<main class="blog-index">
    <section class="blog-hero">
        <?php
        get_template_part('parts/breadcrumbs', null, [
            'variant' => 'dark',
            'layout' => 'inline',
            'class' => 'blog-hero__breadcrumb',
            'col_class' => 'col-12',
            'mobile_bg' => true,
            'items' => [
                ['label' => __('Home', 'filcar'), 'url' => home_url('/')],
                ['label' => __('Blog', 'filcar')],
            ],
        ]);
        ?>
        <div class="container-fluid blog-hero__inner">
            <div class="blog-hero__grid row">
                <div class="blog-hero__copy col-12 col-lg-6">
                    <span class="blog-hero__eyebrow product-3">BLOG</span>
                    <h1 class="blog-hero__title h0 extralight">Notizie e aggiornamenti<br>dal mondo Filcar</h1>
                </div>

                <?php if ($latest_posts->have_posts()) : ?>
                    <div class="blog-hero__featured col-12 col-lg-6 offset-xl-1 col-xl-4">
                        <?php
                        while ($latest_posts->have_posts()) :
                            $latest_posts->the_post();
                            $featured_post_id = get_the_ID();
                            ?>
                            <?php
                            get_template_part('parts/card/card-post', null, array(
                                'card_class' => 'blog-hero__post',
                                'show_excerpt' => true,
                            ));
                            ?>
                        <?php endwhile; ?>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    $paged = max(1, get_query_var('paged'), get_query_var('page'));
    $blog_posts = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post_status' => 'publish',
        'ignore_sticky_posts' => true,
        'post__not_in' => $featured_post_id ? array($featured_post_id) : array(),
        'paged' => $paged,
    ));
    ?>

    <section class="blog-listing bg-grey-200 sp-pt-5 sp-uxl-pt-15">
        <div class="container-fluid">

            <div class="row filters-row">
                <div class="col-12 sp-py-5">
                    <div class="filters-row__inner">
                        <?php get_template_part('parts/blog-filters'); ?>
                    </div>
                </div>
            </div>

            <div class="row sp-row-gap-4" id="blog-posts-grid">
                <?php
                if ($blog_posts->have_posts()) :
                    while ($blog_posts->have_posts()) :
                        $blog_posts->the_post();

                        get_template_part('parts/card/card-post', null, array(
                            'card_class' => 'col-12 col-md-6 col-lg-4',
                        ));
                    endwhile;
                else :
                    ?>
                    <div class="col-12 sp-py-10">
                        <p class="no-results"><?php esc_html_e('Nessun articolo disponibile.', 'filcar'); ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <div id="blog-posts-pagination" class="row">
                <div class="col-12">
                    <?php
                    echo case_studies_pagination($paged, $blog_posts->max_num_pages);
                    ?>
                </div>
            </div>

            <div id="blog-posts-loader" style="display:none; text-align:center; padding: 2rem 0;">
                <span class="spinner is-active"></span>
            </div>
        </div>
    </section>

    <?php wp_reset_postdata(); ?>
</main>

<?php get_footer(); ?>
