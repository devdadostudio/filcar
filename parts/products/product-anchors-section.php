<section class="product-anchors-section js-anchors-layout">

    <div class="product-anchors-section__inner">

        <!-- NAV ANCORE -->
        <aside class="page-header js-page-header">
            <div class="anchor-nav-wrap js-anchor-nav-wrap">
                <nav class="anchor-nav" aria-label="Navigazione sezioni">
                    <a
                        href="#panoramica"
                        class="anchor-link is-active subtitle-4 user-select-none"
                        data-target="#panoramica"
                        ><span class="number-3 anchor-number text-white">01</span>Panoramica</a
                    >
                    <a href="#caratteristiche" class="anchor-link subtitle-4 user-select-none" data-target="#caratteristiche"
                        ><span class="number-3 anchor-number text-white">02</span>Caratteristiche</a
                    >
                    <a href="#dimensioni" class="anchor-link subtitle-4 user-select-none" data-target="#dimensioni"
                        ><span class="number-3 anchor-number text-white">03</span>Dimensioni</a
                    >
                    <a href="#dettagli" class="anchor-link subtitle-4 user-select-none" data-target="#dettagli"
                        ><span class="number-3 anchor-number text-white">04</span>Dettagli</a
                    >
                    <a href="#accessori" class="anchor-link subtitle-4 user-select-none" data-target="#accessori"
                        ><span class="number-3 anchor-number text-white">05</span>Optional</a
                    >
                    <a href="#correlati" class="anchor-link subtitle-4 user-select-none" data-target="#correlati"
                        ><span class="number-3 anchor-number text-white">06</span>Correlati</a
                    >
                </nav>
            </div>
        </aside>

        <!-- CONTENUTO -->
        <div class="product-anchor-content">

            <!-- PANORAMICA -->
            <?php get_template_part('parts/products/text-centered', 'img'); ?>

            <!-- CARATTERISTICHE -->
            <section id="caratteristiche" class="section js-section" data-anchor="caratteristiche">
                <div class="section-inner container-fluid">
                    <div class="subtitle-header">
                        <h2 class="h6 text-secondary text-uppercase semibold">Caratteristiche</h2>
                    </div>
                    <div class="border-top sp-py-3 sp-lg-py-6">
                        <div class="row">
                            <div class="col-llg-6">
                                <!-- TODO - COLORI!! -->
                                <div class="">
                                    <span class="text-uppercase subtitle-2">Adatto a</span>
                                </div>
                            </div>
                            <div class="col-llg-6">
                                <!-- Icons -->
                                Icone blocco
                            </div>
                        </div>
                    </div>
                    <div class="border-top sp-py-3 sp-lg-py-5">
                        <div class="row">
                            <div class="col-llg-6">
                                <!-- TODO - COLORI!! -->
                                <div class="">
                                    <span class="text-uppercase subtitle-2">Descrizione</span>
                                </div>
                            </div>
                            <div class="col-llg-6">
                                <div class="p-big">
                                    <p>Il braccio telescopico consente l’aspirazione dei gas di scarico senza la necessità di agganciare la bocchetta alla marmitta o alla carrozzeria, eliminando il rischio di danneggiamenti accidentali durante le operazioni di manutenzione. Grazie alla sua elevata flessibilità e alla struttura telescopica, può essere utilizzato sia con veicoli posizionati sul ponte sollevatore sia a terra, senza dover sostituire la bocchetta in base alla configurazione di lavoro.</p>
                                    <p>Il sistema di movimentazione, oggetto di due brevetti, è progettato per non entrare mai in contatto diretto con i gas aspirati. Questa soluzione tecnica preserva nel tempo l’efficienza del meccanismo, riduce l’usura dei componenti e garantisce affidabilità costante anche in condizioni di utilizzo intensivo. Il braccio è dotato di una serranda integrata che si apre automaticamente durante l’abbassamento, ottimizzando il flusso di aspirazione e migliorando la gestione operativa.</p>
                                    <p>Installabile a soffitto o a parete, il sistema è compatibile con tutte le canaline esistenti Filcar, permettendo un’integrazione semplice e immediata all’interno di impianti già operativi. Una soluzione professionale progettata per aumentare sicurezza, protezione del veicolo e continuità produttiva in officina.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                   <?php
                    /*
                    |--------------------------------------------------------------------------
                    | CONFIGURAZIONE "SIMULAZIONE ACF"
                    |--------------------------------------------------------------------------
                    | Qui puoi aggiungere/togliere colonne liberamente.
                    */

                    // gruppo: Adatto alle cilindrate
                    $cilindrate_columns = [
                        ['key' => 'moto',   'label' => '🏍'],
                        ['key' => 'auto',   'label' => '🚗'],
                        ['key' => 'suv',    'label' => '🚙'],
                        ['key' => 'van',    'label' => '🚐'],
                        ['key' => 'truck',  'label' => '🚚'],
                        ['key' => 'tractor','label' => '🚜'],
                    ];

                    // gruppo: Canaline compatibili
                    $canaline_columns = [
                        ['key' => 'etk', 'label' => 'ETK'],
                        ['key' => 'xtk', 'label' => 'XTK'],
                    ];

                    // gruppo: Accessori disponibili
                    $accessori_columns = [
                        ['key' => 's',  'label' => 'S'],
                        ['key' => 'ms', 'label' => 'MS'],
                        ['key' => 'mc', 'label' => 'MC'],
                        ['key' => 'tx', 'label' => 'TX'],
                    ];

                    /*
                    |--------------------------------------------------------------------------
                    | RIGHE
                    |--------------------------------------------------------------------------
                    | Ogni riga usa le key dei gruppi sopra.
                    | true  = presente
                    | false = assente
                    | Per gli accessori, se vuoi distinguere graficamente puoi usare 'dot'
                    | oppure true. Qui uso 'dot' per il quadratino.
                    */

                    $rows = [
                        [
                            'mod' => 'ARMTEL-ETK-420',
                            'cilindrate' => [
                                'moto' => true,
                                'auto' => true,
                                'suv' => true,
                                'van' => true,
                                'truck' => true,
                                'tractor' => true,
                            ],
                            'diametro' => '100 mm',
                            'temperatura' => '200°C',
                            'potenza' => '0,5 HP',
                            'canaline' => [
                                'etk' => true,
                                'xtk' => false,
                            ],
                            'accessori' => [
                                's'  => 'dot',
                                'ms' => false,
                                'mc' => 'dot',
                                'tx' => false,
                            ],
                        ],
                        [
                            'mod' => 'ARMTEL-ETK-350',
                            'cilindrate' => [
                                'moto' => true,
                                'auto' => true,
                                'suv' => true,
                                'van' => true,
                                'truck' => true,
                                'tractor' => true,
                            ],
                            'diametro' => '125 mm',
                            'temperatura' => '200°C',
                            'potenza' => '1 HP',
                            'canaline' => [
                                'etk' => true,
                                'xtk' => false,
                            ],
                            'accessori' => [
                                's'  => false,
                                'ms' => 'dot',
                                'mc' => false,
                                'tx' => 'dot',
                            ],
                        ],
                        [
                            'mod' => 'ARMTEL-XTK-420',
                            'cilindrate' => [
                                'moto' => true,
                                'auto' => true,
                                'suv' => true,
                                'van' => true,
                                'truck' => true,
                                'tractor' => true,
                            ],
                            'diametro' => '125 mm',
                            'temperatura' => '200°C',
                            'potenza' => '1 HP',
                            'canaline' => [
                                'etk' => false,
                                'xtk' => true,
                            ],
                            'accessori' => [
                                's'  => false,
                                'ms' => false,
                                'mc' => 'dot',
                                'tx' => false,
                            ],
                        ],
                        [
                            'mod' => 'ARMTEL-XTK-422',
                            'cilindrate' => [
                                'moto' => true,
                                'auto' => true,
                                'suv' => true,
                                'van' => true,
                                'truck' => true,
                                'tractor' => true,
                            ],
                            'diametro' => '125 mm',
                            'temperatura' => '200°C',
                            'potenza' => '1 HP',
                            'canaline' => [
                                'etk' => false,
                                'xtk' => true,
                            ],
                            'accessori' => [
                                's'  => false,
                                'ms' => false,
                                'mc' => 'dot',
                                'tx' => false,
                            ],
                        ],
                    ];

                    /*
                    |--------------------------------------------------------------------------
                    | LARGHEZZE COLONNE
                    |--------------------------------------------------------------------------
                    | Puoi cambiarle facilmente.
                    */

                    $w_mod         = '120px';
                    $w_cilindrata  = '44px';
                    $w_diametro    = '95px';
                    $w_temperatura = '100px';
                    $w_potenza     = '60px';
                    $w_canalina    = '60px';
                    $w_accessorio  = '40px';

                    /*
                    |--------------------------------------------------------------------------
                    | COSTRUZIONE AUTOMATICA GRID TEMPLATE
                    |--------------------------------------------------------------------------
                    */

                    /*
                    |--------------------------------------------------------------------------
                    | COSTRUZIONE AUTOMATICA GRID TEMPLATE
                    |--------------------------------------------------------------------------
                    | mobile/tablet = px + scroll
                    | desktop >= 1200 = fr + no scroll orizzontale
                    */

                    $grid_parts_mobile = [];
                    $grid_parts_desktop = [];

                    /* colonna Mod */
                    $grid_parts_mobile[] = $w_mod;
                    $grid_parts_desktop[] = str_replace('px', 'fr', $w_mod);

                    /* gruppo cilindrate */
                    if (!empty($cilindrate_columns)) {
                        $grid_parts_mobile[] = 'repeat(' . count($cilindrate_columns) . ', ' . $w_cilindrata . ')';
                        $grid_parts_desktop[] = 'repeat(' . count($cilindrate_columns) . ', ' . str_replace('px', 'fr', $w_cilindrata) . ')';
                    }

                    /* colonne centrali */
                    $grid_parts_mobile[] = $w_diametro;
                    $grid_parts_desktop[] = str_replace('px', 'fr', $w_diametro);

                    $grid_parts_mobile[] = $w_temperatura;
                    $grid_parts_desktop[] = str_replace('px', 'fr', $w_temperatura);

                    $grid_parts_mobile[] = $w_potenza;
                    $grid_parts_desktop[] = str_replace('px', 'fr', $w_potenza);

                    /* gruppo canaline */
                    if (!empty($canaline_columns)) {
                        $grid_parts_mobile[] = 'repeat(' . count($canaline_columns) . ', ' . $w_canalina . ')';
                        $grid_parts_desktop[] = 'repeat(' . count($canaline_columns) . ', ' . str_replace('px', 'fr', $w_canalina) . ')';
                    }

                    /* gruppo accessori */
                    if (!empty($accessori_columns)) {
                        $grid_parts_mobile[] = 'repeat(' . count($accessori_columns) . ', ' . $w_accessorio . ')';
                        $grid_parts_desktop[] = 'repeat(' . count($accessori_columns) . ', ' . str_replace('px', 'fr', $w_accessorio) . ')';
                    }

                    $grid_template_columns_mobile = implode(' ', $grid_parts_mobile);
                    $grid_template_columns_desktop = implode(' ', $grid_parts_desktop);
                    ?>
                    <div class="border-top sp-py-3 sp-lg-py-5">
                        <div class="sp-mb-8">
                            <span class="text-uppercase subtitle-2">Specifiche tecniche</span>
                        </div>
                        <div class="table-scroll">
                            <div
                            class="fake-table tech-table"
                            style="
                                --grid-mobile: <?php echo esc_attr($grid_template_columns_mobile); ?>;
                                --grid-desktop: <?php echo esc_attr($grid_template_columns_desktop); ?>;
                            "
                            >

                                <?php
                                /*
                                |--------------------------------------------------------------------------
                                | HEADER - RIGA 1
                                |--------------------------------------------------------------------------
                                */

                                // Mod: sempre rowspan 2
                                ?>
                                <div class="cell corner table-2 head-rowspan-2" style="grid-row: span 2;">Mod</div>

                                <?php if (!empty($cilindrate_columns)) : ?>
                                    <div class="cell head-l1 table-2" style="grid-column: span <?php echo count($cilindrate_columns); ?>;">
                                        Adatto alle cilindrate
                                    </div>
                                <?php endif; ?>

                                <div class="cell head-rowspan-2 table-2" style="grid-row: span 2;">
                                    Diametro interno<br>del tubo
                                </div>

                                <div class="cell head-rowspan-2 table-2" style="grid-row: span 2;">
                                    Temperatura<br>massima di esercizio
                                </div>

                                <div class="cell head-rowspan-2 table-2" style="grid-row: span 2;">
                                    Potenza<br>motore
                                </div>

                                <?php if (!empty($canaline_columns)) : ?>
                                    <div class="cell head-l1 table-2" style="grid-column: span <?php echo count($canaline_columns); ?>;">
                                        Canaline compatibili
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($accessori_columns)) : ?>
                                    <div class="cell head-l1 table-2" style="grid-column: span <?php echo count($accessori_columns); ?>;">
                                        Accessori disponibili
                                    </div>
                                <?php endif; ?>

                                <?php
                                /*
                                |--------------------------------------------------------------------------
                                | HEADER - RIGA 2
                                |--------------------------------------------------------------------------
                                */

                                foreach ($cilindrate_columns as $col) : ?>
                                    <div class="cell head-l2"><?php echo esc_html($col['label']); ?></div>
                                <?php endforeach; ?>

                                <?php foreach ($canaline_columns as $col) : ?>
                                    <div class="cell head-l2 table-2"><?php echo esc_html($col['label']); ?></div>
                                <?php endforeach; ?>

                                <?php foreach ($accessori_columns as $col) : ?>
                                    <div class="cell head-l2 table-2"><?php echo esc_html($col['label']); ?></div>
                                <?php endforeach; ?>

                                <?php
                                /*
                                |--------------------------------------------------------------------------
                                | BODY
                                |--------------------------------------------------------------------------
                                */

                                foreach ($rows as $row) :
                                ?>
                                    <div class="table-row">
                                        
                                        <div class="cell first-col table-2 medium text-secondary">
                                            <?php echo esc_html($row['mod']); ?>
                                        </div>

                                        <?php foreach ($cilindrate_columns as $col) :
                                            $key = $col['key'];
                                            $value = $row['cilindrate'][$key] ?? false;
                                        ?>
                                            <div class="cell table-2">
                                                <?php if ($value) : ?>
                                                    <span class="is-check">✓</span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>

                                        <div class="cell table-2"><?php echo esc_html($row['diametro'] ?? ''); ?></div>
                                        <div class="cell table-2"><?php echo esc_html($row['temperatura'] ?? ''); ?></div>
                                        <div class="cell table-2"><?php echo esc_html($row['potenza'] ?? ''); ?></div>

                                        <?php foreach ($canaline_columns as $col) :
                                            $key = $col['key'];
                                            $value = $row['canaline'][$key] ?? false;
                                        ?>
                                            <div class="cell table-2">
                                                <?php if ($value) : ?>
                                                    <span class="is-check">✓</span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>

                                        <?php foreach ($accessori_columns as $col) :
                                            $key = $col['key'];
                                            $value = $row['accessori'][$key] ?? false;
                                        ?>
                                            <div class="cell table-2">
                                                <?php if ($value === 'dot') : ?>
                                                    <span class="is-dot">■</span>
                                                <?php elseif ($value === true) : ?>
                                                    <span class="is-check">✓</span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- DIMENSIONI -->
            <section id="dimensioni" class="section js-section" data-anchor="dimensioni">
                <div class="section-inner container-fluid">
                    <div class="subtitle-header border-bottom sp-pb-6">
                        <h2 class="h6 text-secondary text-uppercase semibold">Dimensioni</h2>
                    </div>

                    <div class="product-dimensions__grid">
                        <img src="" alt="">
                        <img src="" alt="">
                        <img src="" alt="">
                        <img src="" alt="">
                    </div>

                    <?php
                    /*
                    |--------------------------------------------------------------------------
                    | CONFIGURAZIONE "SIMULAZIONE ACF"
                    |--------------------------------------------------------------------------
                    | Qui definisci le colonne reali della tabella dimensioni.
                    | Puoi aggiungerle o toglierle liberamente.
                    */

                    $dimension_columns = [
                        ['key' => 'a',    'label' => 'A<br>mm',     'width' => '74px'],
                        ['key' => 'b',    'label' => 'B (Ø)<br>mm', 'width' => '74px'],
                        ['key' => 'c',    'label' => 'C (Ø)<br>mm', 'width' => '74px'],
                        ['key' => 'd',    'label' => 'D<br>mm',     'width' => '74px'],
                        ['key' => 'e',    'label' => 'E<br>mm',     'width' => '74px'],
                        ['key' => 'f',    'label' => 'F (Ø)<br>mm', 'width' => '74px'],
                        ['key' => 'g',    'label' => 'G<br>mm',     'width' => '74px'],
                        ['key' => 'h',    'label' => 'H<br>mm',     'width' => '74px'],
                        ['key' => 'i',    'label' => 'I<br>mm',     'width' => '74px'],
                        ['key' => 'l',    'label' => 'L (Ø)<br>mm', 'width' => '74px'],
                        ['key' => 'm',    'label' => 'M (Ø)<br>mm', 'width' => '74px'],
                        ['key' => 'n',    'label' => 'N<br>mm',     'width' => '74px'],
                        ['key' => 'o',    'label' => 'O (Ø)<br>mm', 'width' => '74px'],
                        ['key' => 'p',    'label' => 'P<br>mm',     'width' => '74px'],
                        ['key' => 'q',    'label' => 'Q<br>mm',     'width' => '74px'],
                        ['key' => 'r',    'label' => 'R (Ø)<br>mm', 'width' => '74px'],
                        ['key' => 's',    'label' => 'S<br>mm',     'width' => '74px'],
                        ['key' => 'peso', 'label' => 'Peso<br>kg',  'width' => '90px'],
                        ['key' => 'hp',   'label' => 'HP',          'width' => '90px'],
                    ];

                    /*
                    |--------------------------------------------------------------------------
                    | RIGHE
                    |--------------------------------------------------------------------------
                    | 'mod' = prima colonna sticky
                    | 'values' = valori agganciati alle key delle colonne sopra
                    */

                    $dimension_rows = [
                        [
                            'mod' => 'ARMTEL',
                            'values' => [
                                'a' => '100',
                                'b' => '45',
                                'c' => '78',
                                'd' => '130',
                                'e' => '23',
                                'f' => '78',
                                'g' => '56',
                                'h' => '1096',
                                'i' => '124',
                                'l' => '124',
                                'm' => '124',
                                'n' => '124',
                                'o' => '124',
                                'p' => '124',
                                'q' => '124',
                                'r' => '124',
                                's' => '124',
                                'peso' => '124',
                                'hp' => '124',
                            ],
                        ],
                        [
                            'mod' => 'ARMTEL-350',
                            'values' => [
                                'a' => '100',
                                'b' => '45',
                                'c' => '78',
                                'd' => '130',
                                'e' => '23',
                                'f' => '78',
                                'g' => '56',
                                'h' => '1096',
                                'i' => '124',
                                'l' => '124',
                                'm' => '124',
                                'n' => '124',
                                'o' => '124',
                                'p' => '124',
                                'q' => '124',
                                'r' => '124',
                                's' => '124',
                                'peso' => '124',
                                'hp' => '124',
                            ],
                        ],
                    ];

                    /*
                    |--------------------------------------------------------------------------
                    | LARGHEZZA PRIMA COLONNA
                    |--------------------------------------------------------------------------
                    */

                    $dimension_mod_width = '120px';

                    /*
                    |--------------------------------------------------------------------------
                    | COSTRUZIONE AUTOMATICA GRID TEMPLATE
                    |--------------------------------------------------------------------------
                    */

                    /*
                    |--------------------------------------------------------------------------
                    | COSTRUZIONE AUTOMATICA GRID TEMPLATE
                    |--------------------------------------------------------------------------
                    | mobile/tablet = px + scroll
                    | desktop >= 1200 = fr + no scroll orizzontale
                    */

                    $dimension_grid_parts_mobile = [];
                    $dimension_grid_parts_desktop = [];

                    /* prima colonna Mod */
                    $dimension_grid_parts_mobile[] = $dimension_mod_width;
                    $dimension_grid_parts_desktop[] = str_replace('px', 'fr', $dimension_mod_width);

                    /* colonne dati */
                    foreach ($dimension_columns as $col) {
                        $col_width = $col['width'] ?? '40px';

                        $dimension_grid_parts_mobile[] = $col_width;
                        $dimension_grid_parts_desktop[] = str_replace('px', 'fr', $col_width);
                    }

                    $dimension_grid_template_mobile = implode(' ', $dimension_grid_parts_mobile);
                    $dimension_grid_template_desktop = implode(' ', $dimension_grid_parts_desktop);
                    ?>

                    <div class="table-scroll">
                        <div
                        class="fake-table dimension-table"
                        style="
                            --grid-mobile: <?php echo esc_attr($dimension_grid_template_mobile); ?>;
                            --grid-desktop: <?php echo esc_attr($dimension_grid_template_desktop); ?>;
                        "
                        >

                            <!-- HEADER -->
                            <div class="cell corner table-2 head-l1">Mod</div>

                            <?php foreach ($dimension_columns as $col) : ?>
                                <div class="cell head-l1 table-2">
                                    <?php echo wp_kses($col['label'], ['br' => []]); ?>
                                </div>
                            <?php endforeach; ?>

                            <!-- BODY -->
                            <?php foreach ($dimension_rows as $row) : ?>
                                <div class="cell first-col table-2 medium text-secondary"><?php echo esc_html($row['mod']); ?></div>

                                <?php foreach ($dimension_columns as $col) :
                                    $key = $col['key'];
                                    $value = $row['values'][$key] ?? '';
                                    ?>
                                    <div class="cell table-2"><?php echo esc_html($value); ?></div>
                                <?php endforeach; ?>

                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

            </section>

            <!-- DETTAGLI -->
            <section id="dettagli" class="section js-section" data-anchor="dettagli">
                <div class="section-inner container-fluid">
                    <h2>Dettagli</h2>

                    <div class="product-details-slider">

                        <div class="product-details-slide">
                        <img src="" alt="">
                        <div>
                            <h3>Dettaglio 1</h3>
                            <p>Descrizione componente</p>
                        </div>
                        </div>

                        <div class="product-details-slide">
                        <img src="" alt="">
                        <div>
                            <h3>Dettaglio 2</h3>
                            <p>Descrizione componente</p>
                        </div>
                        </div>

                    </div>
                </div>

            </section>

            <!-- ACCESSORI -->
            <section id="accessori" class="section js-section" data-anchor="accessori">
                <div class="section-inner container-fluid">
                    <h2>Accessori</h2>

                    <table class="product-accessories-table">
                        <thead>
                        <tr>
                            <th>Codice</th>
                            <th>Immagine</th>
                            <th>Nome</th>
                            <th>Descrizione</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>0001</td>
                            <td><img src="" alt=""></td>
                            <td>Accessorio 1</td>
                            <td>Descrizione accessorio</td>
                        </tr>
                        <tr>
                            <td>0002</td>
                            <td><img src="" alt=""></td>
                            <td>Accessorio 2</td>
                            <td>Descrizione accessorio</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </section>

            <!-- CORRELATI -->
            <section id="correlati" class="section js-section" data-anchor="correlati">
                <div class="section-inner container-fluid">
                    <h2>Correlati</h2>

                    <div class="product-related-grid">

                        <div class="product-related-card">
                        <img src="" alt="">
                        <h3>Prodotto correlato 1</h3>
                        </div>

                        <div class="product-related-card">
                        <img src="" alt="">
                        <h3>Prodotto correlato 2</h3>
                        </div>

                    </div>
                </div>
            </section>

        </div>
    </div>
</section>