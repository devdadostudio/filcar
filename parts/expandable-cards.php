<?php
$content = get_field('expandable_cards');
$content = is_array($content) ? $content : [];

$eyebrow = ($content['eyebrow'] ?? '') ?: (get_field('eyebrow') ?: get_field('subtitle'));
$title = ($content['title'] ?? '') ?: (get_field('title') ?: get_field('heading'));
$variant = ($content['variant'] ?? '') ?: (get_field('variant') ?: 'products');
$cards = ($content['cards'] ?? null) ?: (get_field('cards') ?: get_field('expandable_cards_items'));

$variant = in_array($variant, ['numbers', 'stats', 'variante_2', 'variante2', 'variant_2'], true) ? 'numbers' : 'products';
$cards = is_array($cards) ? array_values(array_filter($cards, 'is_array')) : [];
$cards_count = count($cards);

if (!function_exists('filcar_expandable_cards_image_data')) {
    function filcar_expandable_cards_image_data($image) {
        $data = [
            'url' => '',
            'alt' => '',
        ];

        if (is_array($image)) {
            $data['url'] = $image['url'] ?? '';
            $data['alt'] = $image['alt'] ?? '';
            return $data;
        }

        if (is_numeric($image)) {
            $data['url'] = wp_get_attachment_image_url((int) $image, 'full') ?: '';
            $data['alt'] = get_post_meta((int) $image, '_wp_attachment_image_alt', true) ?: '';
            return $data;
        }

        if (is_string($image)) {
            $data['url'] = $image;
        }

        return $data;
    }
}

if (!$cards) {
    return;
}

$block_id = !empty($block['anchor']) ? $block['anchor'] : 'expandable-cards-' . ($block['id'] ?? uniqid());
$section_classes = [
    'expandable-cards',
    'js-expandable-cards',
    'expandable-cards--' . $variant,
    'expandable-cards--count-' . $cards_count,
];
?>

<section
    id="<?php echo esc_attr($block_id); ?>"
    class="<?php echo esc_attr(implode(' ', $section_classes)); ?>"
    data-cards-count="<?php echo esc_attr($cards_count); ?>"
>
    <div class="container-fluid expandable-cards__inner">
        <?php if ($eyebrow || $title) : ?>
            <header class="expandable-cards__header">
                <?php if ($eyebrow) : ?>
                    <div class="expandable-cards__eyebrow"><?php echo esc_html($eyebrow); ?></div>
                <?php endif; ?>

                <?php if ($title) : ?>
                    <h2 class="expandable-cards__title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
            </header>
        <?php endif; ?>

        <div class="expandable-cards__list" role="list">
            <?php foreach ($cards as $index => $card) :
                $label = ($card['label'] ?? '') ?: ($card['eyebrow'] ?? '');
                $card_title = ($card['title_card'] ?? '') ?: (($card['titolo_card'] ?? '') ?: (($card['title'] ?? '') ?: ($card['name'] ?? '')));
                $product_icon = $card['product_icon'] ?? $card['icona_prodotto'] ?? '';
                $allowed_product_icons = ['icon-logo-mono', 'icon-logo-dual', 'icon-logo-infinity'];
                $product_icon = in_array($product_icon, $allowed_product_icons, true) ? $product_icon : '';
                $value = ($card['value'] ?? '') ?: ($card['number'] ?? '');
                $unit = ($card['unita'] ?? '') ?: ($card['unit'] ?? '');
                $description = ($card['description'] ?? '') ?: ($card['text'] ?? '');
                $image_inactive = filcar_expandable_cards_image_data(
                    $card['image_inactive'] ??
                    $card['img_inactive'] ??
                    $card['image_inattiva'] ??
                    $card['img_inattiva'] ??
                    $card['image'] ??
                    $card['img'] ??
                    null
                );
                $image_active = filcar_expandable_cards_image_data(
                    $card['image_active'] ??
                    $card['img_active'] ??
                    $card['image_attiva'] ??
                    $card['img_attiva'] ??
                    null
                );
                $orientation = $card['orientation'] ?? $card['image_position'] ?? '';
                $orientation = in_array($orientation, ['left', 'right'], true)
                    ? $orientation
                    : ($variant === 'numbers' ? 'right' : 'left');
                $orientation_class = 'expandable-cards__card--image-' . $orientation;
                $active_image_class = $image_active['url'] ? 'expandable-cards__card--has-active-image' : '';
                $link = $card['link'] ?? ($card['cta'] ?? null);
                $link_url = is_array($link) ? ($link['url'] ?? '') : '';
                $link_title = is_array($link) ? (($link['title'] ?? '') ?: __('Scopri', 'filcar')) : '';
                $link_target = is_array($link) ? ($link['target'] ?? '') : '';
                $description_class = $variant === 'products' ? 'p-big' : 'p-smaller';
                ?>
                <article class="expandable-cards__card <?php echo esc_attr($orientation_class); ?> <?php echo esc_attr($active_image_class); ?>" role="listitem" data-card-index="<?php echo esc_attr($index); ?>" tabindex="0" aria-expanded="false">
                    <div class="expandable-cards__card-bg" aria-hidden="true">
                        <?php if ($image_inactive['url']) : ?>
                            <img class="expandable-cards__bg-image expandable-cards__bg-image--inactive" src="<?php echo esc_url($image_inactive['url']); ?>" alt="<?php echo esc_attr($image_inactive['alt'] ?: $card_title); ?>">
                        <?php endif; ?>
                        <?php if ($image_active['url']) : ?>
                            <img class="expandable-cards__bg-image expandable-cards__bg-image--active" src="<?php echo esc_url($image_active['url']); ?>" alt="<?php echo esc_attr($image_active['alt'] ?: $card_title); ?>">
                        <?php endif; ?>
                    </div>

                    <span class="expandable-cards__toggle" aria-hidden="true"></span>

                    <?php if ($link_url) : ?>
                        <a class="expandable-cards__mobile-arrow" href="<?php echo esc_url($link_url); ?>"<?php echo $link_target ? ' target="' . esc_attr($link_target) . '"' : ''; ?><?php echo $link_target === '_blank' ? ' rel="noopener"' : ''; ?> aria-label="<?php echo esc_attr($link_title); ?>">
                            <i class="icon-filcar-icon-arrow-upr" aria-hidden="true"></i>
                        </a>
                    <?php endif; ?>

                    <div class="expandable-cards__card-content">
                        <?php if ($variant === 'numbers' && $value) : ?>
                            <div class="expandable-cards__value number-2">
                                <?php echo esc_html($value); ?><?php if ($unit) : ?><span><?php echo esc_html($unit); ?></span><?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="expandable-cards__meta">
                            <?php if ($label) : ?>
                                <div class="expandable-cards__label h5"><?php echo esc_html($label); ?></div>
                            <?php endif; ?>

                            <?php if ($variant === 'products' && $product_icon) : ?>
                                <i class="expandable-cards__product-icon <?php echo esc_attr($product_icon); ?>" aria-label="<?php echo esc_attr($card_title); ?>"></i>
                            <?php elseif ($card_title) : ?>
                                <h3 class="expandable-cards__card-title"><?php echo esc_html($card_title); ?></h3>
                            <?php endif; ?>
                        </div>

                        <?php if ($description || $link_url) : ?>
                            <div class="expandable-cards__reveal">
                                <?php if ($description) : ?>
                                    <div class="expandable-cards__description <?php echo esc_attr($description_class); ?>"><?php echo wp_kses_post($description); ?></div>
                                <?php endif; ?>

                                <?php if ($link_url) : ?>
                                    <a class="expandable-cards__link btn btn-secondary-2 w-icon" href="<?php echo esc_url($link_url); ?>"<?php echo $link_target ? ' target="' . esc_attr($link_target) . '"' : ''; ?><?php echo $link_target === '_blank' ? ' rel="noopener"' : ''; ?>>
                                        <span>
                                            <?php echo esc_html($link_title); ?>
                                            <?php if ($variant === 'products' && $product_icon) : ?>
                                                <i class="expandable-cards__link-product-icon <?php echo esc_attr($product_icon); ?>" aria-hidden="true"></i>
                                            <?php endif; ?>
                                            <span class="icon-filcar-icon-arrow-upr"></span>
                                        </span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($description) : ?>
                        <div class="expandable-cards__mobile-description <?php echo esc_attr($description_class); ?>"><?php echo wp_kses_post($description); ?></div>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="expandable-cards__controls" aria-hidden="false">
            <button class="expandable-cards__control expandable-cards__control--prev" type="button" aria-label="<?php echo esc_attr__('Card precedente', 'filcar'); ?>">
                <span class="icon-filcar-icon-chevron-forward" aria-hidden="true"></span>
            </button>
            <button class="expandable-cards__control expandable-cards__control--next" type="button" aria-label="<?php echo esc_attr__('Card successiva', 'filcar'); ?>">
                <span class="icon-filcar-icon-chevron-forward" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</section>
