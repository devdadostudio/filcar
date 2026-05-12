<?php
get_header();

$term = get_queried_object();

if ($term instanceof WP_Term) {
    get_template_part('parts/case-studies-carousel', null, [
        'term_id' => $term->term_id,
        'taxonomy' => $term->taxonomy,
        'posts_per_page' => 3,
    ]);
}

get_footer();
?>
