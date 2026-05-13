<?php
get_header();

$term = get_queried_object();
$children = get_term_children( $term->term_id, $term->taxonomy );

$direct_children = get_terms( array(
    'taxonomy'   => $term->taxonomy,
    'parent'     => $term->term_id,
    'hide_empty' => false,
) );

if ( ! is_wp_error( $direct_children ) && ! empty( $direct_children ) ) {
    get_template_part('parts/category/parent_category', null, [
        'term_id' => $term->term_id,
        'taxonomy' => $term->taxonomy,
        'children' => $direct_children
    ]);
} else {
    
}

get_footer();
?>