<?php
$content = get_field('operative_cards');
$section_bg = get_field('section_bg');
$content = is_array($content) ? $content : [];

$eyebrow = ($content['eyebrow'] ?? '') ?: (get_field('eyebrow') ?: get_field('subtitle'));
$title = ($content['title'] ?? '') ?: (get_field('title') ?: get_field('heading'));
$cards = ($content['cards'] ?? null) ?: (get_field('cards') ?: get_field('operative_cards_items'));
$cards = is_array($cards) ? array_slice(array_values(array_filter($cards, 'is_array')), 0, 5) : [];
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

$block_id = !empty($block['anchor']) ? $block['anchor'] : 'operative-cards-' . ($block['id'] ?? uniqid());
?>

<section
    id="<?php echo esc_attr($block_id); ?>"
    class="<?php echo $section_bg; ?> operative-cards js-expandable-cards operative-cards--count-<?php echo esc_attr($cards_count); ?>"
    data-cards-count="<?php echo esc_attr($cards_count); ?>"
>
    <div class="container-fluid operative-cards__inner">
        <?php if ($eyebrow || $title) : ?>
            <header class="operative-cards__header">
                <?php if ($eyebrow) : ?>
                    <div class="operative-cards__eyebrow"><?php echo esc_html($eyebrow); ?></div>
                <?php endif; ?>

                <?php if ($title) : ?>
                    <h2 class="operative-cards__title h3"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
            </header>
        <?php endif; ?>

        <div class="operative-cards__list expandable-cards__list" role="list">
            <?php foreach ($cards as $index => $card) :
                $card_title = ($card['title_card'] ?? '') ?: (($card['titolo_card'] ?? '') ?: (($card['title'] ?? '') ?: ($card['name'] ?? '')));
                $description = ($card['description'] ?? '') ?: ($card['text'] ?? '');
                $image_inactive = filcar_expandable_cards_image_data(
                    $card['image_inactive'] ??
                    $card['img_inactive'] ??
                    $card['image'] ??
                    $card['img'] ??
                    null
                );
                $image_active = filcar_expandable_cards_image_data(
                    $card['image_active'] ??
                    $card['img_active'] ??
                    null
                );
                $active_image_class = $image_active['url'] ? 'operative-cards__card--has-active-image' : '';
                $link = $card['link'] ?? ($card['cta'] ?? null);
                $link_url = is_array($link) ? ($link['url'] ?? '') : '';
                $link_title = is_array($link) ? (($link['title'] ?? '') ?: $card_title) : '';
                $link_target = is_array($link) ? ($link['target'] ?? '') : '';
                $link_text = ($card['link_text'] ?? '') ?: __('Scopri', 'filcar');
                $taxonomy_term = ($card['taxonomy_term'] ?? null);
                ?>
                <article
                    class="operative-cards__card expandable-cards__card <?php echo esc_attr($active_image_class); ?>"
                    role="listitem"
                    data-card-index="<?php echo esc_attr($index); ?>"
                    tabindex="0"
                    aria-expanded="false"
                >
                    <div class="operative-cards__card-bg" aria-hidden="true">
                        <?php if ($image_inactive['url']) : ?>
                            <img class="operative-cards__bg-image operative-cards__bg-image--inactive" src="<?php echo esc_url($image_inactive['url']); ?>" alt="<?php echo esc_attr($image_inactive['alt'] ?: $card_title); ?>">
                        <?php endif; ?>
                        <?php if ($image_active['url']) : ?>
                            <img class="operative-cards__bg-image operative-cards__bg-image--active" src="<?php echo esc_url($image_active['url']); ?>" alt="<?php echo esc_attr($image_active['alt'] ?: $card_title); ?>">
                        <?php endif; ?>
                    </div>

                    <span class="operative-cards__toggle" aria-hidden="true"></span>

                    <div class="operative-cards__content">
                        <?php if ($card_title) : ?>
                            <h3 class="operative-cards__card-title p-bigger"><?php echo esc_html($card_title); ?></h3>
                        <?php endif; ?>

                        <?php if ($description) : ?>
                            <div class="operative-cards__description subtitle-2 text-grey-400"><?php echo wp_kses_post($description); ?></div>
                        <?php endif; ?>

                        <?php if($taxonomy_term) : ?>
                            <div class="operative-cards__taxonomy">
                                <a class="btn btn-secondary-2" href="<?php echo esc_url(get_term_link($taxonomy_term)); ?>">
                                    <span><?php echo $link_text; ?> <i class="icon-filcar-icon-arrow-upr" aria-hidden="true"></i></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="operative-cards__controls" aria-hidden="false">
            <button class="operative-cards__control operative-cards__control--prev expandable-cards__control--prev" type="button" aria-label="<?php echo esc_attr__('Card precedente', 'filcar'); ?>">
                <span class="icon-filcar-icon-chevron-forward" aria-hidden="true"></span>
            </button>
            <button class="operative-cards__control operative-cards__control--next expandable-cards__control--next" type="button" aria-label="<?php echo esc_attr__('Card successiva', 'filcar'); ?>">
                <span class="icon-filcar-icon-chevron-forward" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</section>
