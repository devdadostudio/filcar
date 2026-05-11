<?php
get_header();

$category = get_queried_object();

if ($category instanceof WP_Term) {
    get_template_part('parts/case-studies-carousel', null, [
        'category_id' => $category->term_id,
        'posts_per_page' => 3,
    ]);
}

get_footer();
?>
