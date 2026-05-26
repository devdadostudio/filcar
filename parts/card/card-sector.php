<div class="overflow-hidden position-relative rounded card-sector <?php echo $args['class'] ?? ''; ?>">
    <a href="<?php echo get_the_permalink($args['sector_id']); ?>" class="d-block w-100 h-100 position-relative">
        <figure class="w-100 h-100 respimg card-shadow <?php echo $args['class_figure']; ?> rounded overflow-hidden sp-mb-0">
            <?php echo get_the_post_thumbnail($args['sector_id'], 'full'); ?>
        </figure>
        <div class="<?php echo $args['name_class']; ?> fw-light text-white position-absolute bottom-0 left-0 sp-lg-p-5 sp-p-4 lh-1 mb-0">
            <?php echo get_the_title($args['sector_id']); ?>
        </div>
    </a>
</div>