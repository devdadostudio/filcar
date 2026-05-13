<?php
$term_id = $args['term_id'];
$taxonomy = $args['taxonomy'];
?>
<div class="<?php echo $args['card_class']; ?> card-cat-prod position-relative">
    <a href="<?php echo get_term_link( $term_id, $taxonomy ); ?>" class="card-category position-relative">
        <figure class="rounded overflow-hidden aspect-ratio-4x3 d-flex respimg position-relative">
            <img src="https://placehold.co/450x254" alt="">
            <div class="card-link-arrow">
                <i class="icon-filcar-icon-arrow-upr"></i>
            </div>
        </figure>
        <div class="card-category-content sp-px-4 sp-py-3">
            <span class="text-white fw-normal h7">
                <?php echo get_term($term_id, $taxonomy)->name; ?>
            </span>
        </div>
    </a>
</div>