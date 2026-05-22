<?php
$block_id = !empty($block['anchor']) ? $block['anchor'] : 'parallax-sector-block-' . ($block['id'] ?? uniqid());
$asset_uri = get_template_directory_uri() . '/assets/img/';
$marquee_logo_url = get_template_directory_uri() . '/assets/LogoFilcarBG-scroll.svg';

$fallback_items = [
    [
        'number' => '01',
        'anchor_id' => 'banchi-da-lavoro-per-officina',
        'title' => 'Banchi da lavoro per officina',
        'text' => '<p>Un banco da lavoro per officina ben progettato rappresenta il cuore operativo di qualsiasi postazione. I banchi Filcar sono pensati per offrire robustezza, ergonomia e modularita, permettendo di organizzare strumenti, attrezzature e punti di erogazione direttamente dove servono.</p><p>Grazie alla possibilita di integrare prese, sistemi di distribuzione e accessori tecnici, i banchi consentono di migliorare l’efficienza del lavoro quotidiano, ridurre gli spostamenti inutili e mantenere l’area sempre ordinata e funzionale.</p>',
        'image' => $asset_uri . 'parallax-sector-01.jpg',
        'image_alt' => 'Officina attrezzata con banchi da lavoro Filcar',
        'parallax_speed' => '0.16',
        'cta_label' => 'Scopri',
        'cta_title' => 'Arredo Tecnico',
        'cta_url' => '#',
        'cta_target' => '',
    ],
    [
        'number' => '02',
        'anchor_id' => 'arrotolatori-per-officina',
        'title' => 'Arrotolatori per officina',
        'text' => '<p>Gli arrotolatori per officina permettono di gestire in modo ordinato e sicuro tubazioni, cavi e linee di servizio, evitando ingombri e riducendo il rischio di incidenti.</p><p>Grazie alla loro installazione strategica, consentono di avere sempre a disposizione aria, acqua, lubrificanti o energia direttamente in postazione, migliorando l’organizzazione dello spazio e velocizzando le operazioni quotidiane.</p>',
        'image' => $asset_uri . 'parallax-sector-02.jpg',
        'image_alt' => 'Arrotolatori meccanici installati in officina',
        'parallax_speed' => '0.12',
        'cta_label' => '',
        'cta_title' => 'Arrotolatori meccanici',
        'cta_url' => '#',
        'cta_target' => '',
    ],
];

if (!function_exists('filcar_psb_image_data')) {
    function filcar_psb_image_data($image) {
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

if (!function_exists('filcar_psb_term_link_data')) {
    function filcar_psb_term_link_data($term_value, $taxonomy = 'cat-prod') {
        $data = [
            'url' => '',
            'title' => '',
        ];

        if ($term_value instanceof WP_Term) {
            $term = $term_value;
        } elseif (is_numeric($term_value)) {
            $term = get_term((int) $term_value, $taxonomy);
        } elseif (is_array($term_value) && !empty($term_value['term_id'])) {
            $term = get_term((int) $term_value['term_id'], $taxonomy);
        } else {
            $term = null;
        }

        if (!$term || is_wp_error($term)) {
            return $data;
        }

        $term_link = get_term_link($term);

        if (is_wp_error($term_link)) {
            return $data;
        }

        $data['url'] = $term_link;
        $data['title'] = $term->name;

        return $data;
    }
}

$acf_items = function_exists('get_field') ? get_field('items') : [];
$items = [];

if (!empty($acf_items) && is_array($acf_items)) {
    foreach ($acf_items as $index => $acf_item) {
        $image = filcar_psb_image_data($acf_item['image'] ?? null);
        $cta_type = $acf_item['cta_type'] ?? 'link';
        $cta = $acf_item['cta_link'] ?? null;
        $cta_title = $acf_item['cta_title'] ?? '';
        $parallax_speed = $acf_item['parallax_speed'] ?? '';
        $anchor_id = $acf_item['anchor_id'] ?? '';
        $cta_url = '';
        $cta_target = '';
        $cta_fallback_title = '';

        if ($cta_type === 'taxonomy') {
            $term_link = filcar_psb_term_link_data($acf_item['cta_taxonomy'] ?? null);
            $cta_url = $term_link['url'];
            $cta_fallback_title = $term_link['title'];
        } elseif (is_array($cta)) {
            $cta_url = $cta['url'] ?? '';
            $cta_target = $cta['target'] ?? '';
            $cta_fallback_title = $cta['title'] ?? '';
        }

        $items[] = [
            'number' => str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT),
            'anchor_id' => sanitize_title($anchor_id ?: ($acf_item['title'] ?? 'blocco-' . ($index + 1))),
            'title' => $acf_item['title'] ?? '',
            'text' => $acf_item['text'] ?? '',
            'image' => $image['url'],
            'image_alt' => $image['alt'],
            'parallax_speed' => $parallax_speed !== '' && $parallax_speed !== null ? $parallax_speed : '0.14',
            'cta_label' => $acf_item['cta_label'] ?? '',
            'cta_title' => $cta_title ?: $cta_fallback_title,
            'cta_url' => $cta_url,
            'cta_target' => $cta_target,
        ];
    }
} else {
    $items = $fallback_items;
}
?>

<section id="<?php echo esc_attr($block_id); ?>" class="parallax-sector-block js-parallax-sector-block">
    <?php foreach ($items as $index => $item) :
        $is_reverse = $index % 2 === 1;
        $item_classes = [
            'parallax-sector-block__item',
            $is_reverse ? 'parallax-sector-block__item--reverse' : '',
        ];
        ?>
        <article class="<?php echo esc_attr(trim(implode(' ', $item_classes))); ?>">
            <?php if (!empty($item['anchor_id'])) : ?>
                <span id="<?php echo esc_attr($item['anchor_id']); ?>" class="parallax-sector-block__anchor"></span>
            <?php endif; ?>

            <div class="container-fluid parallax-sector-block__copy-wrap">
                <div class="parallax-sector-block__number number-1 regular" aria-hidden="true">
                    <?php echo esc_html($item['number']); ?>
                </div>

                <div class="parallax-sector-block__copy">
                    <h2 class="parallax-sector-block__title h5 medium">
                        <?php echo esc_html($item['title']); ?>
                    </h2>
                    <div class="parallax-sector-block__text p-normal regularatt mb-0-p">
                        <?php echo wp_kses_post($item['text']); ?>
                    </div>
                </div>
            </div>

            <div class="parallax-sector-block__stage">
                <div class="parallax-sector-block__marquee" aria-hidden="true">
                    <div class="parallax-sector-block__marquee-row js-parallax-sector-marquee">
                        <?php for ($marquee_index = 0; $marquee_index < 6; $marquee_index++) : ?>
                            <span class="parallax-sector-block__marquee-group">
                                <img class="parallax-sector-block__marquee-logo" src="<?php echo esc_url($marquee_logo_url); ?>" alt="">
                            </span>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="container-fluid parallax-sector-block__media-wrap">
                    <?php if (!empty($item['image'])) : ?>
                        <figure class="parallax-sector-block__media js-parallax-sector-media" data-parallax-speed="<?php echo esc_attr($item['parallax_speed']); ?>">
                            <img class="parallax-sector-block__image js-parallax-sector-image" src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['image_alt']); ?>">
                        </figure>
                    <?php endif; ?>

                    <?php if (!empty($item['cta_url']) && (!empty($item['cta_label']) || !empty($item['cta_title']))) : ?>
                        <a class="parallax-sector-block__cta" href="<?php echo esc_url($item['cta_url']); ?>"<?php echo !empty($item['cta_target']) ? ' target="' . esc_attr($item['cta_target']) . '"' : ''; ?><?php echo ($item['cta_target'] ?? '') === '_blank' ? ' rel="noopener"' : ''; ?>>
                            <?php if ($item['cta_label']) : ?>
                                <span class="parallax-sector-block__cta-label h5 light"><?php echo esc_html($item['cta_label']); ?></span>
                            <?php endif; ?>
                            <?php if ($item['cta_title']) : ?>
                                <span class="parallax-sector-block__cta-title h5 light"><?php echo esc_html($item['cta_title']); ?></span>
                            <?php endif; ?>
                            <span class="parallax-sector-block__cta-icon icon-filcar-icon-arrow-upr" aria-hidden="true"></span>
                            <span class="parallax-sector-block__cta-progress" aria-hidden="true"></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</section>
