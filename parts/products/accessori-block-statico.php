<section id="accessori" class="section js-section sp-py-8" data-anchor="accessori">
    <div class="section-inner container-fluid">
        <div class="subtitle-header">
            <h2 class="h6 text-secondary text-uppercase semibold">Accessori</h2>
        </div>
    </div>
        <?php
        $accessori_rows = [
            [
                'mod' => 'ARMTEL-KIT-TX',
                'image' => 'https://placehold.co/120x120',
                'desc' => 'Sistema di trasmissione radio del segnale di partenza automatica dell’aspiratore derivante dal fermabuto elettrico degli arrotolatori motorizzati.',
                'link' => '#'
            ],
            [
                'mod' => 'QE/RX',
                'image' => 'https://placehold.co/120x120',
                'desc' => 'Quadro elettrico con antenna di ricezione da combinare con i prodotti MICRO-TX, BL-A/TX o AM-TX.',
                'link' => '#'
            ],
        ];

        $grid_template_mobile = '90px 90px minmax(220px,1fr) 130px';
        $grid_template_desktop = 'minmax(110px,1fr) minmax(110px,1fr) minmax(260px,2fr) minmax(150px,1fr)';
        ?>
    <div class="container-fluid-left">

        <div class="table-shell sp-mt-4 sp-xl-mt-6">
            <div class="table-scroll">
                <div class="fake-table accessories-table"
                    style="
                        --grid-mobile: <?php echo esc_attr($grid_template_mobile); ?>;
                        --grid-desktop: <?php echo esc_attr($grid_template_desktop); ?>;
                    ">

                    <div class="cell head-l1 corner table-2 has-separator text-secondary">Mod</div>
                    <div class="cell head-l1 table-2 has-separator">Immagine</div>
                    <div class="cell head-l1 table-2 has-separator">Descrizione</div>
                    <div class="cell head-l1 table-2">Visualizzazione</div>

                    <div class="table-row table-row-spacer" aria-hidden="true">
                        <?php for ($i = 0; $i < 4; $i++) : ?>
                            <div class="cell table-spacer-cell"></div>
                        <?php endfor; ?>
                    </div>

                    <?php foreach ($accessori_rows as $row) : ?>
                        <div class="table-row">

                            <div class="cell first-col table-2 text-secondary has-separator accessory-mod">
                                <?php echo esc_html($row['mod']); ?>
                            </div>

                            <div class="cell has-separator accessory-image-cell">
                                <img
                                    src="<?php echo esc_url($row['image']); ?>"
                                    alt=""
                                    class="accessory-img">
                            </div>

                            <div class="cell has-separator accessory-desc table-4">
                                <?php echo esc_html($row['desc']); ?>
                            </div>

                            <div class="cell accessory-cta-cell">
                                <a href="<?php echo esc_url($row['link']); ?>" class="btn btn-secondary-1 w-icon accessory-btn">
                                    <span>
                                        Vedi prodotto
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.50776 9.47764L9.48096 1.50006C9.4791 0.947778 9.02988 0.500066 8.4776 0.500065L0.499996 0.500065M0.514397 9.49194L8.80709 1.18472" stroke="#17191B" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>

                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>