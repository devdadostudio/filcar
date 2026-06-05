<?php
get_header();

$term = get_queried_object();

if ($term instanceof WP_Term) {
    get_template_part('parts/case-studies-carousel', null, [
        'term_id' => $term->term_id,
        'taxonomy' => $term->taxonomy,
        'posts_per_page' => filcar_get_posts_per_page_field(filcar_get_case_studies_page_id()),
    ]);
}

get_footer();
?>
