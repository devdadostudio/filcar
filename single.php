<?php
get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();
        get_template_part('parts/hero', 'single', ['post_id' => get_the_ID()]);
        ?>
        <main class="single-content bg-grey-200">
            <?php the_content(); ?>
        </main>
        <?php
    endwhile;
endif;

get_footer();
?>
