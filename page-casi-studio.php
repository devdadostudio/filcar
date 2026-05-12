<?php
/*
Template Name: Casi studio
*/

get_header();

get_template_part('parts/case-studies-carousel', null, [
    'posts_per_page' => 3,
]);

get_footer();
?>
