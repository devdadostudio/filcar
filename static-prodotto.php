<?php
/*
 * Template Name: Pagina Statica Prodotto
 * Template Post Type: page
 */

?>
<?php
get_header();
if (have_posts()) {
        while (have_posts()): ?>

        <?php the_post();
            echo the_content(); 
        ?>

    <main class="product-main">

        <!-- HERO PRODOTTO -->
        <?php get_template_part('parts/products/hero-products', 'static'); ?>

        <!-- SEZIONE CON NAV + CONTENUTI -->
        <?php get_template_part('parts/products/product-anchors', 'section-statico'); ?>

    </main>
    
    <?php
        endwhile;
    }
get_footer('no-prefooter');
?>