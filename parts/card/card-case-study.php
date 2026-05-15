<?php
if(isset($args['case_study_id'])){
    $post_id = $args['case_study_id'];
}else{
    $post_id = get_the_ID();
}
?>
<div class="<?php echo isset($args['card_class']) ? $args['card_class'] : ''; ?> card-post">
    <div class="post-card h-100 bg-white rounded overflow-hidden">
        <a class="post-card-inner text-decoration-none" href="<?php echo get_the_permalink($post_id); ?> ">
            <figure class="post-card-image d-flex justify-content-center aspect-ratio-16x9 overflow-hidden respimg position-relative">
            <div class="img-overlay">
                <div class="card-link-arrow">
                    <i class="icon-filcar-icon-arrow-upr"></i>
                </div>
            </div>
            <?php
            $img = get_post_thumbnail_id($post_id);
            if($img) : ?>
                <?php echo wp_get_attachment_image($img, 'blog-card-thumb'); ?>
            <?php else : ?>
                <img src="https://placehold.co/450x254" alt="">
            <?php endif; ?>
            </figure>
            <div class="post-card-content sp-px-3 sp-pt-3 sp-pb-6">
                <div class="p-small text-grey-500 fw-light sp-mb-3">
                    <?php echo get_the_date('d M Y', $post_id); ?>
                </div>
                <div class="p-bigger text-primary fw-light sp-mb-3">
                    <?php echo get_the_title($post_id); ?>
                </div>
                <div class="p-small text-grey-500 fw-light">
                    <?php
                        $excerpt = strip_tags(get_the_excerpt($post_id));
                        $excerpt_length = 120;
                        echo strlen($excerpt) > $excerpt_length ? substr($excerpt, 0, $excerpt_length) . '...' : $excerpt;
                    ?>
                </div>
                <span class="d-block p-small text-grey-500 fw-light post-card-link sp-mt-3">Leggi di più</span>
            </div>
        </a>
    </div>
</div>