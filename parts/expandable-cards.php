<?php
$content = get_field('expandable_cards');
$content = is_array($content) ? $content : [];

$eyebrow = ($content['eyebrow'] ?? '') ?: (get_field('eyebrow') ?: get_field('subtitle'));
$title = ($content['title'] ?? '') ?: (get_field('title') ?: get_field('heading'));
$variant = ($content['variant'] ?? '') ?: (get_field('variant') ?: 'products');
$expansion_mode = ($content['expansion_mode'] ?? '') ?: (get_field('expansion_mode') ?: get_field('mode'));
$cards = ($content['cards'] ?? null) ?: (get_field('cards') ?: get_field('expandable_cards_items'));

$variant = in_array($variant, ['numbers', 'stats', 'variante_2', 'variante2', 'variant_2'], true) ? 'numbers' : 'products';
$expansion_mode = in_array($expansion_mode, ['scroll', 'on_scroll'], true) ? 'scroll' : 'hover';
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
    'expandable-cards--mode-' . $expansion_mode,
    'expandable-cards--count-' . $cards_count,
];
?>

<section
    id="<?php echo esc_attr($block_id); ?>"
    class="<?php echo esc_attr(implode(' ', $section_classes)); ?>"
    data-expansion-mode="<?php echo esc_attr($expansion_mode); ?>"
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
                $card_title = ($card['title'] ?? '') ?: ($card['name'] ?? '');
                $value = ($card['value'] ?? '') ?: ($card['number'] ?? '');
                $unit = $card['unit'] ?? '';
                $description = ($card['description'] ?? '') ?: ($card['text'] ?? '');
                $image = filcar_expandable_cards_image_data($card['image'] ?? ($card['img'] ?? null));
                $link = $card['link'] ?? ($card['cta'] ?? null);
                $link_url = is_array($link) ? ($link['url'] ?? '') : '';
                $link_title = is_array($link) ? (($link['title'] ?? '') ?: __('Scopri', 'filcar')) : '';
                $link_target = is_array($link) ? ($link['target'] ?? '') : '';
                $is_active = $index === 0;
                ?>
                <article class="expandable-cards__card <?php echo $is_active ? 'is-active' : ''; ?>" role="listitem" data-card-index="<?php echo esc_attr($index); ?>" tabindex="0">
                    <div class="expandable-cards__card-bg" aria-hidden="true">
                        <?php if ($image['url']) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: $card_title); ?>">
                        <?php endif; ?>
                    </div>

                    <span class="expandable-cards__toggle" aria-hidden="true"></span>

                    <div class="expandable-cards__card-content">
                        <?php if ($variant === 'numbers' && $value) : ?>
                            <div class="expandable-cards__value">
                                <?php echo esc_html($value); ?><?php if ($unit) : ?><span><?php echo esc_html($unit); ?></span><?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($label) : ?>
                            <div class="expandable-cards__label"><?php echo esc_html($label); ?></div>
                        <?php endif; ?>

                        <?php if ($card_title) : ?>
                            <h3 class="expandable-cards__card-title"><?php echo esc_html($card_title); ?></h3>
                        <?php endif; ?>

                        <?php if ($description || $link_url) : ?>
                            <div class="expandable-cards__reveal">
                                <?php if ($description) : ?>
                                    <div class="expandable-cards__description"><?php echo wp_kses_post($description); ?></div>
                                <?php endif; ?>

                                <?php if ($link_url) : ?>
                                    <a class="expandable-cards__link btn btn-secondary-2 w-icon" href="<?php echo esc_url($link_url); ?>"<?php echo $link_target ? ' target="' . esc_attr($link_target) . '"' : ''; ?><?php echo $link_target === '_blank' ? ' rel="noopener"' : ''; ?>>
                                        <span><?php echo esc_html($link_title); ?><span class="icon-filcar-icon-arrow-upr"></span></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
