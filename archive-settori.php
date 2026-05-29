<?php
get_header();
$query = new WP_Query( [ 'page_id' => 443 ] );

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        the_content();
    }
    wp_reset_postdata();
}
get_footer();
?>