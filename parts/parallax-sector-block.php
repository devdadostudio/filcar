<?php
$block_id = !empty($block['anchor']) ? $block['anchor'] : 'parallax-sector-block-' . ($block['id'] ?? uniqid());
$asset_uri = get_template_directory_uri() . '/assets/img/';

$items = [
    [
        'number' => '01',
        'title' => 'Banchi da lavoro per officina',
        'text' => '<p>Un banco da lavoro per officina ben progettato rappresenta il cuore operativo di qualsiasi postazione. I banchi Filcar sono pensati per offrire robustezza, ergonomia e modularita, permettendo di organizzare strumenti, attrezzature e punti di erogazione direttamente dove servono.</p><p>Grazie alla possibilita di integrare prese, sistemi di distribuzione e accessori tecnici, i banchi consentono di migliorare l’efficienza del lavoro quotidiano, ridurre gli spostamenti inutili e mantenere l’area sempre ordinata e funzionale.</p>',
        'image' => $asset_uri . 'parallax-sector-01.jpg',
        'image_alt' => 'Officina attrezzata con banchi da lavoro Filcar',
        'parallax_speed' => '0.16',
        'cta_label' => 'Scopri',
        'cta_title' => 'Arredo Tecnico',
        'cta_url' => '#',
    ],
    [
        'number' => '02',
        'title' => 'Arrotolatori per officina',
        'text' => '<p>Gli arrotolatori per officina permettono di gestire in modo ordinato e sicuro tubazioni, cavi e linee di servizio, evitando ingombri e riducendo il rischio di incidenti.</p><p>Grazie alla loro installazione strategica, consentono di avere sempre a disposizione aria, acqua, lubrificanti o energia direttamente in postazione, migliorando l’organizzazione dello spazio e velocizzando le operazioni quotidiane.</p>',
        'image' => $asset_uri . 'parallax-sector-02.jpg',
        'image_alt' => 'Arrotolatori meccanici installati in officina',
        'parallax_speed' => '0.12',
        'cta_label' => '',
        'cta_title' => 'Arrotolatori meccanici',
        'cta_url' => '#',
    ],
];
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
                        <span class="parallax-sector-block__marquee-group">FILCAR FILCAR FILCAR</span>
                        <span class="parallax-sector-block__marquee-group">FILCAR FILCAR FILCAR</span>
                    </div>
                </div>

                <div class="container-fluid parallax-sector-block__media-wrap">
                    <figure class="parallax-sector-block__media js-parallax-sector-media" data-parallax-speed="<?php echo esc_attr($item['parallax_speed']); ?>">
                        <img class="parallax-sector-block__image js-parallax-sector-image" src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['image_alt']); ?>">
                    </figure>

                    <a class="parallax-sector-block__cta" href="<?php echo esc_url($item['cta_url']); ?>">
                        <?php if ($item['cta_label']) : ?>
                            <span class="parallax-sector-block__cta-label h5 light"><?php echo esc_html($item['cta_label']); ?></span>
                        <?php endif; ?>
                        <span class="parallax-sector-block__cta-title h5 light"><?php echo esc_html($item['cta_title']); ?></span>
                        <span class="parallax-sector-block__cta-icon icon-filcar-icon-arrow-upr" aria-hidden="true"></span>
                        <span class="parallax-sector-block__cta-progress" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</section>
