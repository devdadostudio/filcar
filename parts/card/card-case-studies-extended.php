<?php
$post_id = isset($args['post_id']) ? (int) $args['post_id'] : get_the_ID();
$image_url = get_the_post_thumbnail_url($post_id, 'hero-768') ?: get_template_directory_uri() . '/assets/img/sfondo-card.jpg';
$excerpt = get_the_excerpt($post_id);
$excerpt = $excerpt ?: wp_strip_all_tags(get_post_field('post_content', $post_id));
?>
<article class="case-studies-carousel__item">
    <a class="case-studies-carousel__card" href="<?php echo esc_url(get_permalink($post_id)); ?>">
        <i class="case-studies-carousel__arrow icon icon-filcar-icon-arrow-upr" aria-hidden="true"></i>
        <div class="case-studies-carousel__media respimg">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>" loading="lazy">
        </div>
        <div class="case-studies-carousel__content">
            <time class="case-studies-carousel__date p-small" datetime="<?php echo esc_attr(get_the_date('c', $post_id)); ?>">
                <?php echo esc_html(get_the_date('j F Y', $post_id)); ?>
            </time>
            <h3 class="case-studies-carousel__card-title h5 regular">
                <?php echo esc_html(get_the_title($post_id)); ?>
            </h3>
            <p class="case-studies-carousel__excerpt p-big mb-0 medium">
                <?php echo esc_html(wp_trim_words($excerpt, 18, '...')); ?>
            </p>
        </div>
    </a>
</article>
