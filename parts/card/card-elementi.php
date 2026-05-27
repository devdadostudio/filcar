<?php
$term_id = isset($args['term_id']) ? (int) $args['term_id'] : 0;
$taxonomy = $args['taxonomy'] ?? '';
$term = $term_id && $taxonomy ? get_term($term_id, $taxonomy) : null;

if (!$term || is_wp_error($term)) {
    return;
}

$term_link = get_term_link($term, $taxonomy);

if (is_wp_error($term_link)) {
    return;
}

$thumbnail = function_exists('get_field') ? get_field('img_cat', $taxonomy . '_' . $term_id) : null;
$thumbnail_id = is_array($thumbnail) && !empty($thumbnail['ID']) ? (int) $thumbnail['ID'] : 0;
$thumbnail_alt = is_array($thumbnail) && !empty($thumbnail['alt']) ? $thumbnail['alt'] : $term->name;
$card_class = $args['class'] ?? '';
$figure_class = $args['class_figure'] ?? 'aspect-ratio-1x1';
$name_class = $args['name_class'] ?? 'h5';
?>

<div class="overflow-hidden position-relative rounded card-sector <?php echo esc_attr($card_class); ?>">
    <a href="<?php echo esc_url($term_link); ?>" class="d-block w-100 h-100 position-relative">
        <figure class="w-100 h-100 respimg card-shadow <?php echo esc_attr($figure_class); ?> rounded overflow-hidden sp-mb-0">
            <?php
            if ($thumbnail_id) {
                echo wp_get_attachment_image($thumbnail_id, 'full', false, [
                    'alt' => esc_attr($thumbnail_alt),
                ]);
            } else {
                echo '<img src="https://placehold.co/600x600" alt="' . esc_attr($term->name) . '">';
            }
            ?>
        </figure>
        <div class="<?php echo esc_attr($name_class); ?> fw-light text-white position-absolute bottom-0 left-0 sp-lg-p-5 sp-p-4 lh-1 mb-0">
            <?php echo esc_html($term->name); ?>
        </div>
    </a>
</div>
