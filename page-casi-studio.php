<?php
/*
Template Name: Casi studio
*/

get_header();

$posts_per_page = filcar_get_posts_per_page_field(get_queried_object_id());

get_template_part('parts/case-studies-carousel', null, [
    'posts_per_page' => $posts_per_page,
]);
?>

<section class="bg-grey-200 sp-pt-5 sp-uxl-pt-15">
    <div class="container-fluid">

        <div class="row filters-row">
            <div class="col-12 sp-py-5">
                <div class="filters-row__inner">
                    <?php get_template_part('parts/case-studies-filters'); ?>
                </div>
            </div>
        </div>

        <div class="row sp-row-gap-4" id="case-studies-grid">
            <?php
            $case_studies_query = new WP_Query([
                'post_type'      => 'caso-studio',
                'post_status'    => 'publish',
                'paged'          => get_query_var('paged') ?: 1,
                'posts_per_page' => $posts_per_page,
                'order'          => 'DESC',
            ]);

            if ($case_studies_query->have_posts()) :
                while ($case_studies_query->have_posts()) :
                    $case_studies_query->the_post();
                    get_template_part('parts/card/card-case-study', null, [
                        'case_study_id' => get_the_ID(),
                        'card_class'    => 'col-12 col-md-6 col-lg-4',
                    ]);
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>

        <div id="case-studies-pagination" class="row">
            <div class="col-12">
                <?php
                $paged_current = get_query_var('paged') ?: 1;
                echo case_studies_pagination($paged_current, $case_studies_query->max_num_pages);
                ?>
            </div>
        </div>

        <div id="case-studies-loader" style="display:none; text-align:center; padding: 2rem 0;">
            <span class="spinner is-active"></span>
        </div>

    </div>
</section>

<?php get_footer(); ?>
