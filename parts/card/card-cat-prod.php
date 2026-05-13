<?php
$term_id = $args['term_id'];
$taxonomy = $args['taxonomy'];
?>
<div class="<?php echo $args['card_class']; ?> card-cat-prod position-relative">
    <a href="<?php echo get_term_link( $term_id, $taxonomy ); ?>" class="card-category position-relative">
        <figure class="rounded overflow-hidden aspect-ratio-4x3 d-flex respimg position-relative sp-mb-0">
            <?php
            $thumbnail = get_field('img_cat', $taxonomy . '_' . $term_id);
            $thumbnail_id = $thumbnail ? $thumbnail['ID'] : false;
            if ( $thumbnail_id ) {
                echo wp_get_attachment_image( $thumbnail_id, 'cat-prod-card-thumb', false, array( 'class' => '' ) );
            } else {
                echo '<img src="https://placehold.co/450x254" alt="">';
            }
            ?>
            <div class="card-link-arrow">
                <i class="icon-filcar-icon-arrow-upr"></i>
            </div>
        </figure>
        <div class="card-category-content sp-lg-px-4 sp-lg-py-3 sp-px-2 sp-py-2">
            <span class="text-white fw-normal h7">
                <?php echo get_term($term_id, $taxonomy)->name; ?>
            </span>
        </div>
    </a>
</div>