<?php
$prod_id = get_the_ID();
$card_class = $args['card_class'];
?>
<div class="<?php echo esc_attr($card_class); ?>">
    <a href="<?php echo get_the_permalink($prod_id); ?>" class="card-element text-decoration-none">
        <?php
            $img = get_post_thumbnail_id($prod_id);
            if($img) :
        ?>
            <figure class="aspect-ratio-4x3 rounded overflow-hidden respimg bg-primary">
                <img src="<?php echo wp_get_attachment_image_url($img, 'elements-thumb'); ?>" alt="" class="">
            </figure>
        <?php endif; ?>
        <div class="subtitle-1 fw-normal text-primary text-decoration-none">
            <?php echo get_the_title($prod_id); ?>
        </div>
        <?php
        $excerpt = get_the_excerpt($prod_id);
        if(!empty($excerpt)) :
        ?>
        <div class="regular text-grey-500 text-decoration-none sp-mt-3">
            <?php echo $excerpt; ?>
        </div>
        <?php endif; ?>
    </a>
</div>