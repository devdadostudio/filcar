<?php
$current_term = $args['term'] ?? get_queried_object();
$field_source = $args['field_source'] ?? '';
$content = $args['content'] ?? [];
$content = is_array($content) ? $content : [];

if (!$current_term instanceof WP_Term) {
    return;
}

$section_label = trim((string) ($content['section_label'] ?? ''));
$section_label = $section_label !== '' ? $section_label : __('Prodotti', 'filcar');
$configured_cards = $content['cards'] ?? [];
$configured_cards = is_array($configured_cards) ? array_values(array_filter($configured_cards, 'is_array')) : [];

$product_icon_for_term = static function (?WP_Term $term) {
    if (!$term instanceof WP_Term) {
        return '';
    }

    $slug = strtolower($term->slug);

    if (strpos($slug, 'mono') !== false) {
        return 'icon-logo-mono';
    }

    if (strpos($slug, 'dual') !== false) {
        return 'icon-logo-dual';
    }

    if (strpos($slug, 'infinity') !== false) {
        return 'icon-logo-infinity';
    }

    return '';
};

$normalize_card_term = static function ($item) {
    if ($item instanceof WP_Term) {
        return $item;
    }

    if (is_array($item)) {
        $term_id = $item['term_id'] ?? ($item['ID'] ?? ($item['id'] ?? 0));

        if ($term_id) {
            $term = get_term((int) $term_id, 'categoria-elemento-arredo');
            return $term instanceof WP_Term && !is_wp_error($term) ? $term : null;
        }
    }

    if (is_numeric($item)) {
        $term = get_term((int) $item, 'categoria-elemento-arredo');
        return $term instanceof WP_Term && !is_wp_error($term) ? $term : null;
    }

    return null;
};

$cards = [];

if ($configured_cards) {
    foreach ($configured_cards as $card) {
        $card_term = $normalize_card_term($card['term'] ?? null);

        if (!$card_term instanceof WP_Term || (int) $card_term->parent !== (int) $current_term->term_id) {
            continue;
        }

        $image = $card['image'] ?? null;
        $image_id = is_array($image) && !empty($image['ID']) ? (int) $image['ID'] : 0;
        $image_alt = is_array($image) && !empty($image['alt']) ? $image['alt'] : $card_term->name;
        $term_link = get_term_link($card_term);
        $manual_link = $card['cta_link'] ?? null;
        $manual_link_url = is_array($manual_link) ? ($manual_link['url'] ?? '') : (is_string($manual_link) ? $manual_link : '');
        $manual_link_target = is_array($manual_link) ? ($manual_link['target'] ?? '') : '';

        $cards[] = [
            'term' => $card_term,
            'label' => trim((string) ($card['label'] ?? '')),
            'title' => trim((string) ($card['title'] ?? '')),
            'product_icon' => trim((string) ($card['product_icon'] ?? '')),
            'description' => $card['text'] ?? '',
            'image_id' => $image_id,
            'image_alt' => $image_alt,
            'link' => $manual_link_url ?: (!is_wp_error($term_link) ? $term_link : ''),
            'link_target' => $manual_link_target,
            'cta_text' => trim((string) ($card['cta_text'] ?? '')),
        ];
    }
}

if (!$cards) {
    $terms = get_terms([
        'taxonomy' => 'categoria-elemento-arredo',
        'parent' => $current_term->term_id,
        'hide_empty' => false,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ]);
    $terms = is_array($terms) && !is_wp_error($terms) ? $terms : [];

    foreach ($terms as $child_term) {
        $term_key = $child_term->taxonomy . '_' . $child_term->term_id;
        $image = function_exists('get_field') ? get_field('img_cat', $term_key) : null;
        $image_id = is_array($image) && !empty($image['ID']) ? (int) $image['ID'] : 0;
        $image_alt = is_array($image) && !empty($image['alt']) ? $image['alt'] : $child_term->name;
        $term_link = get_term_link($child_term);

        $cards[] = [
            'term' => $child_term,
            'label' => __('Linea', 'filcar'),
            'title' => $child_term->name,
            'product_icon' => $product_icon_for_term($child_term),
            'description' => $child_term->description,
            'image_id' => $image_id,
            'image_alt' => $image_alt,
            'link' => !is_wp_error($term_link) ? $term_link : '',
            'link_target' => '',
            'cta_text' => __('Scopri', 'filcar'),
        ];
    }
}

if (!$cards) {
    return;
}
?>

<section id="prodotti" class="category-second-level-launch bg-light">
    <div class="container-fluid">
        <div class="category-second-level-launch__head">
            <h2 class="category-second-level-launch__heading subtitle-1">
                <?php echo esc_html($section_label); ?>
            </h2>
        </div>

        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">
                <div class="category-second-level-launch__list">
                    <?php foreach ($cards as $card) :
                        $child_term = $card['term'];
                        $label = $card['label'] !== '' ? $card['label'] : __('Linea', 'filcar');
                        $card_title = $card['title'] !== '' ? $card['title'] : $child_term->name;
                        $description = trim((string) $card['description']);
                        $term_link = $card['link'];
                        $link_target = $card['link_target'] ?? '';
                        $cta_text = $card['cta_text'] !== '' ? $card['cta_text'] : __('Scopri', 'filcar');
                        $product_icon = $card['product_icon'] !== '' ? $card['product_icon'] : $product_icon_for_term($child_term);
                        ?>
                        <article class="category-second-level-launch__card expandable-cards__card expandable-cards__card--image-left is-active" aria-expanded="true">
                            <div class="category-second-level-launch__media expandable-cards__card-bg" aria-hidden="true">
                                <?php if ($card['image_id']) : ?>
                                    <?php echo wp_get_attachment_image($card['image_id'], 'full', false, [
                                        'class' => 'expandable-cards__bg-image expandable-cards__bg-image--inactive',
                                        'alt' => esc_attr($card['image_alt']),
                                        'loading' => 'lazy',
                                    ]); ?>
                                <?php endif; ?>
                            </div>

                            <div class="category-second-level-launch__content expandable-cards__card-content">
                                <div class="expandable-cards__meta">
                                    <div class="expandable-cards__label h5">
                                        <?php echo esc_html($label); ?>
                                    </div>

                                    <?php if ($product_icon) : ?>
                                        <i class="expandable-cards__product-icon <?php echo esc_attr($product_icon); ?>" aria-label="<?php echo esc_attr($child_term->name); ?>"></i>
                                    <?php else : ?>
                                        <h3 class="expandable-cards__card-title"><?php echo esc_html($card_title); ?></h3>
                                    <?php endif; ?>
                                </div>

                                <div class="expandable-cards__reveal">
                                    <?php if ($description) : ?>
                                        <div class="expandable-cards__description p-big">
                                            <?php echo wp_kses_post(wpautop($description)); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($term_link) : ?>
                                        <a class="expandable-cards__link btn btn-secondary-2 w-icon expandable-cards__link-product" href="<?php echo esc_url($term_link); ?>"<?php echo $link_target ? ' target="' . esc_attr($link_target) . '"' : ''; ?><?php echo $link_target === '_blank' ? ' rel="noopener"' : ''; ?>>
                                            <span>
                                                <span>
                                                    <?php echo esc_html($cta_text); ?>
                                                    <?php if ($product_icon) : ?>
                                                        <i class="expandable-cards__link-product-icon <?php echo esc_attr($product_icon); ?>" aria-hidden="true"></i>
                                                    <?php else : ?>
                                                        <?php echo esc_html($child_term->name); ?>
                                                    <?php endif; ?>
                                                </span>
                                                <span class="icon-filcar-icon-arrow-upr"></span>
                                            </span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
