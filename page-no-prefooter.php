<?php
/*
 * Template Name: Pagina Senza Prefooter
 * Template Post Type: page
 */

?>
<?php
get_header();
if (have_posts()) {
        while (have_posts()) {
            the_post();
            echo the_content();
        }
    }
get_footer('no-prefooter');
?>