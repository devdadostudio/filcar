<?php
$post_id = get_the_ID();
?>
<div class="<?php echo $args['card_class']; ?> card-post">
    <div class="post-card h-100 bg-white rounded overflow-hidden">
        <a class="post-card-inner text-decoration-none" href="<?php echo get_the_permalink($post_id); ?> ">
            <?php
            $img = get_post_thumbnail_id($post_id);
            if($img) : ?>
                <figure class="post-card-image d-flex justify-content-center aspect-ratio-16x9 overflow-hidden respimg">
                    <?php echo wp_get_attachment_image($img, 'blog-card-thumb'); ?>
                </figure>
            <?php endif; ?>
            <div class="post-card-content sp-px-3 sp-pt-3 sp-pb-6">
                <?php
                $categories = get_the_category($post_id);
                if(!empty($categories)) {
                    $categories_c = count($categories);
                    if($categories_c > 0) {
                        echo '<div class="post-card-categories d-flex p-smaller sp-mb-2 sp-gap-2">';
                        for($i = 0; $i < $categories_c; $i++) {
                            $category = $categories[$i];
                            $category_bg_color = get_field('bg_label', 'category_' . $category->term_id);
                            $category_border_color = get_field('border_label', 'category_' . $category->term_id);
                            $category_color_label = get_field('color_label', 'category_' . $category->term_id);
                            echo '<span href="' . get_category_link($category->term_id) . '" class="card-category" style="background-color: ' . $category_bg_color . '; border: 1px solid ' . $category_border_color . '; color: ' . $category_color_label . ';">' . $category->name . '</span>';
                        }
                        echo '</div>';
                    }
                }
                ?>
                <div class="p-small text-grey-500 fw-light sp-mb-3">
                    <?php echo get_the_date('d M Y', $post_id); ?>
                </div>
                <div class="p-big text-grey-500 fw-light">
                    <?php echo get_the_title($post_id); ?>
                </div>
            </div>
        </a>
    </div>
</div>