<?php
    /* Template Name: Azienda */
    get_header();
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            echo the_content();
        }
    }
    get_footer(null, ['footer-color' => 'bg-primary']);
?>