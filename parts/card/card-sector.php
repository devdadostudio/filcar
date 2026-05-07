<div class="aspect-ratio-1x1 overflow-hidden position-relative rounded card-sector">
    <a href="<?php echo get_the_permalink($args['sector_id']); ?>">
        <figure class="position-absolute w-100 h-100 respimg card-shadow">
            <?php echo get_the_post_thumbnail($args['sector_id'], 'full'); ?>
        </figure>
        <div class="h3 fw-light text-white position-absolute bottom-0 left-0 sp-lg-p-5 sp-p-4 lh-1 mb-0">
            <?php echo get_the_title($args['sector_id']); ?>
        </div>
    </a>
</div>