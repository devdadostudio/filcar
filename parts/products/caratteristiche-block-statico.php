<section id="caratteristiche" class="section js-section" data-anchor="caratteristiche">
    <div class="section-inner container-fluid">
        <div class="subtitle-header">
            <h2 class="h6 text-secondary text-uppercase semibold">Caratteristiche</h2>
        </div>
        <div class="sp-py-3 sp-lg-py-6">
            <div class="row">
                <div class="col-llg-4">
                    <!-- TODO - COLORI!! -->
                    <div class="">
                        <span class="text-uppercase subtitle-2">Adatto a</span>
                    </div>
                </div>
                <div class="col-llg-8">
                    <!-- Icons -->
                    <div class="fit-block">
                        <div class="fit-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons-cilindrate/moto-aligned-left.svg" alt="" srcset="">
                            <span class="table-2 medium">Motoveicoli</span>
                        </div>
                        <div class="fit-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons-cilindrate/auto-aligned-left.svg" alt="" srcset="">
                            <span class="table-2 medium">Veicoli piccola cilindata</span>
                        </div>
                        <div class="fit-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons-cilindrate/supercar-aligned-left.svg" alt="" srcset="">
                            <span class="table-2 medium">Veicoli grande cilindata</span>
                        </div>
                        <div class="fit-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons-cilindrate/supercar-aligned-left.svg" alt="" srcset="">
                            <span class="table-2 medium">Autobus e autosnodati</span>
                        </div>
                        <div class="fit-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons-cilindrate/articolato-aligned-left.svg" alt="" srcset="">
                            <span class="table-2 medium">Veicoli Autoarticolati</span>
                        </div>
                        <div class="fit-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons-cilindrate/mezzi-pesanti-aligned-left.svg" alt="" srcset="">
                            <span class="table-2 medium">Macchine movimento terra</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top sp-py-3 sp-lg-py-5">
            <div class="row">
                <div class="col-llg-4">
                    <!-- TODO - COLORI!! -->
                    <div class="">
                        <span class="text-uppercase subtitle-2">Descrizione</span>
                    </div>
                </div>
                <div class="col-llg-8 sp-my-6 sp-lg-my-0">
                    <div class="p-big">
                        <p>Il braccio telescopico consente l’aspirazione dei gas di scarico senza la necessità di agganciare la bocchetta alla marmitta o alla carrozzeria, eliminando il rischio di danneggiamenti accidentali durante le operazioni di manutenzione. Grazie alla sua elevata flessibilità e alla struttura telescopica, può essere utilizzato sia con veicoli posizionati sul ponte sollevatore sia a terra, senza dover sostituire la bocchetta in base alla configurazione di lavoro.</p>
                        <p>Il sistema di movimentazione, oggetto di due brevetti, è progettato per non entrare mai in contatto diretto con i gas aspirati. Questa soluzione tecnica preserva nel tempo l’efficienza del meccanismo, riduce l’usura dei componenti e garantisce affidabilità costante anche in condizioni di utilizzo intensivo. Il braccio è dotato di una serranda integrata che si apre automaticamente durante l’abbassamento, ottimizzando il flusso di aspirazione e migliorando la gestione operativa.</p>
                        <p>Installabile a soffitto o a parete, il sistema è compatibile con tutte le canaline esistenti Filcar, permettendo un’integrazione semplice e immediata all’interno di impianti già operativi. Una soluzione professionale progettata per aumentare sicurezza, protezione del veicolo e continuità produttiva in officina.</p>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $table_config_cilindrate = [
            'fit_group' => [
                'title' => 'Adatto alle cilindrate',
                'columns' => [
                    ['key' => 'moto',   'label' => '🏍'],
                    ['key' => 'auto',   'label' => '🚗'],
                    ['key' => 'suv',    'label' => '🚙'],
                    ['key' => 'van',    'label' => '🚐'],
                    ['key' => 'truck',  'label' => '🚚'],
                    ['key' => 'tractor','label' => '🚜'],
                ],
            ],

            'spec_columns' => [
                ['key' => 'diametro',    'label' => 'Diametro interno<br>del tubo'],
                ['key' => 'temperatura', 'label' => 'Temperatura<br>massima di esercizio'],
                ['key' => 'potenza',     'label' => 'Potenza<br>motore'],
                ['key' => 'prova',       'label' => 'Prova'],
            ],

            'canaline_group' => [
                'title' => 'Canaline compatibili',
                'columns' => [
                    ['key' => 'etk', 'label' => 'ETK'],
                    ['key' => 'xtk', 'label' => 'XTK'],
                ],
            ],

            'accessori_group' => [
                'title' => 'Accessori disponibili',
                'columns' => [
                    ['key' => 's',  'label' => 'S'],
                    ['key' => 'ms', 'label' => 'MS'],
                    ['key' => 'mc', 'label' => 'MC'],
                    ['key' => 'tx', 'label' => 'TX'],
                ],
            ],
        ];

        $rows_cilindrate = [
            [
                'mod' => 'ARMTEL-ETK-420',
                'fit_group' => [
                    'moto' => true,
                    'auto' => true,
                    'suv' => true,
                    'van' => true,
                    'truck' => true,
                    'tractor' => true,
                ],
                'specs' => [
                    'diametro' => '100 mm',
                    'temperatura' => '200°C',
                    'potenza' => '0,5 HP',
                    'prova' => 'UNI',
                ],
                'canaline_group' => [
                    'etk' => true,
                    'xtk' => false,
                ],
                'accessori_group' => [
                    's'  => 'dot',
                    'ms' => false,
                    'mc' => 'dot',
                    'tx' => false,
                ],
            ],
            [
                'mod' => 'ARMTEL-ETK-350',
                'fit_group' => [
                    'moto' => true,
                    'auto' => true,
                    'suv' => true,
                    'van' => true,
                    'truck' => true,
                    'tractor' => true,
                ],
                'specs' => [
                    'diametro' => '125 mm',
                    'temperatura' => '200°C',
                    'potenza' => '1 HP',
                    'prova' => 'DIN',
                ],
                'canaline_group' => [
                    'etk' => true,
                    'xtk' => false,
                ],
                'accessori_group' => [
                    's'  => false,
                    'ms' => 'dot',
                    'mc' => false,
                    'tx' => 'dot',
                ],
            ],
        ];
        ?>
        <?php
        $table_config_fluidi = [
            'fit_group' => [
                'title' => 'Adatto ai fluidi',
                'columns' => [
                    ['key' => 'acqua',      'label' => '💧'],
                    ['key' => 'aria',       'label' => '🌬'],
                    ['key' => 'olio',       'label' => '🛢'],
                    ['key' => 'vapore',     'label' => '♨️'],
                    ['key' => 'gas',        'label' => '🔥'],
                    ['key' => 'schiuma',    'label' => '🫧'],
                    ['key' => 'chimici',    'label' => '🧪'],
                    ['key' => 'refrigerante','label' => '❄️'],
                    ['key' => 'polveri',    'label' => '🌫'],
                    ['key' => 'miscela',    'label' => '🔄'],
                ],
            ],

            'spec_columns' => [
                ['key' => 'diametro',    'label' => 'Diametro interno<br>del tubo'],
                ['key' => 'temperatura', 'label' => 'Temperatura<br>massima di esercizio'],
                ['key' => 'potenza',     'label' => 'Potenza<br>motore'],
            ],

            'canaline_group' => [
                'title' => 'Canaline compatibili',
                'columns' => [
                    ['key' => 'etk', 'label' => 'ETK'],
                    ['key' => 'xtk', 'label' => 'XTK'],
                ],
            ],

            'accessori_group' => [
                'title' => 'Accessori disponibili',
                'columns' => [
                    ['key' => 's',   'label' => 'S'],
                    ['key' => 'ms',  'label' => 'MS'],
                    ['key' => 'mc',  'label' => 'MC'],
                    ['key' => 'tx',  'label' => 'TX'],
                    ['key' => 'kit', 'label' => 'KIT'],
                ],
            ],
        ];

        $rows_fluidi = [
            [
                'mod' => 'ARMTEL-FL-420',
                'fit_group' => [
                    'acqua' => true,
                    'aria' => true,
                    'olio' => true,
                    'vapore' => false,
                    'gas' => false,
                    'schiuma' => true,
                    'chimici' => false,
                    'refrigerante' => true,
                    'polveri' => true,
                    'miscela' => false,
                ],
                'specs' => [
                    'diametro' => '100 mm',
                    'temperatura' => '180°C',
                    'potenza' => '0,75 HP',
                ],
                'canaline_group' => [
                    'etk' => true,
                    'xtk' => false,
                ],
                'accessori_group' => [
                    's'   => 'dot',
                    'ms'  => false,
                    'mc'  => false,
                    'tx'  => 'dot',
                    'kit' => true,
                ],
            ],
            [
                'mod' => 'ARMTEL-FL-350',
                'fit_group' => [
                    'acqua' => true,
                    'aria' => true,
                    'olio' => false,
                    'vapore' => true,
                    'gas' => false,
                    'schiuma' => false,
                    'chimici' => true,
                    'refrigerante' => true,
                    'polveri' => false,
                    'miscela' => true,
                ],
                'specs' => [
                    'diametro' => '125 mm',
                    'temperatura' => '240°C',
                    'potenza' => '1 HP',
                ],
                'canaline_group' => [
                    'etk' => false,
                    'xtk' => true,
                ],
                'accessori_group' => [
                    's'   => false,
                    'ms'  => 'dot',
                    'mc'  => 'dot',
                    'tx'  => false,
                    'kit' => false,
                ],
            ],
        ];
        ?>
        <?php
            /*
            |--------------------------------------------------------------------------
            | HELPER
            |--------------------------------------------------------------------------
            */

            function build_tech_table_grid_template($table_config) {
                $w_mod       = 'minmax(140px, 1.6fr)';
                $w_fit       = 'minmax(44px, 0.55fr)';
                $w_spec      = 'minmax(110px, 1.2fr)';
                $w_canalina  = 'minmax(60px, 0.8fr)';
                $w_accessory = 'minmax(40px, 0.55fr)';

                $grid_parts = [];
                $grid_parts[] = $w_mod;

                if (!empty($table_config['fit_group']['columns'])) {
                    $grid_parts[] = 'repeat(' . count($table_config['fit_group']['columns']) . ', ' . $w_fit . ')';
                }

                if (!empty($table_config['spec_columns'])) {
                    $grid_parts[] = 'repeat(' . count($table_config['spec_columns']) . ', ' . $w_spec . ')';
                }

                if (!empty($table_config['canaline_group']['columns'])) {
                    $grid_parts[] = 'repeat(' . count($table_config['canaline_group']['columns']) . ', ' . $w_canalina . ')';
                }

                if (!empty($table_config['accessori_group']['columns'])) {
                    $grid_parts[] = 'repeat(' . count($table_config['accessori_group']['columns']) . ', ' . $w_accessory . ')';
                }

                return implode(' ', $grid_parts);
            }

            function render_tech_table_v2($table_config, $rows, $title = 'Specifiche tecniche') {
                $grid_template_columns = build_tech_table_grid_template($table_config);

                $fit_columns       = $table_config['fit_group']['columns'] ?? [];
                $spec_columns      = $table_config['spec_columns'] ?? [];
                $canaline_columns  = $table_config['canaline_group']['columns'] ?? [];
                $accessori_columns = $table_config['accessori_group']['columns'] ?? [];
                ?>
                
                <div class="border-top sp-py-3 sp-lg-py-5">
                    <div class="sp-mb-8">
                        <span class="text-uppercase subtitle-2"><?php echo esc_html($title); ?></span>
                    </div>

                    <div class="table-shell">
                        <div class="table-scroll">
                            <div
                                class="fake-table tech-table"
                                style="grid-template-columns: <?php echo esc_attr($grid_template_columns); ?>;"
                            >

                                <?php
                                /*
                                |--------------------------------------------------------------------------
                                | HEADER - RIGA 1
                                |--------------------------------------------------------------------------
                                */
                                ?>

                                <div class="cell corner table-2 head-rowspan-2 has-separator" style="grid-row: span 2;">
                                    Mod
                                </div>

                                <?php if (!empty($fit_columns)) : ?>
                                    <div class="cell head-l1 table-2 has-separator" style="grid-column: span <?php echo count($fit_columns); ?>;">
                                        <?php echo esc_html($table_config['fit_group']['title']); ?>
                                    </div>
                                <?php endif; ?>

                                <?php foreach ($spec_columns as $spec_index => $spec) :
                                    $separator_class = 'has-separator';
                                    ?>
                                    <div class="cell head-rowspan-2 table-2 <?php echo $separator_class; ?>" style="grid-row: span 2;">
                                        <?php echo wp_kses($spec['label'], ['br' => []]); ?>
                                    </div>
                                <?php endforeach; ?>

                                <?php if (!empty($canaline_columns)) : ?>
                                    <div class="cell head-l1 table-2 has-separator" style="grid-column: span <?php echo count($canaline_columns); ?>;">
                                        <?php echo esc_html($table_config['canaline_group']['title']); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($accessori_columns)) : ?>
                                    <div class="cell head-l1 table-2" style="grid-column: span <?php echo count($accessori_columns); ?>;">
                                        <?php echo esc_html($table_config['accessori_group']['title']); ?>
                                    </div>
                                <?php endif; ?>

                                <?php
                                /*
                                |--------------------------------------------------------------------------
                                | HEADER - RIGA 2
                                |--------------------------------------------------------------------------
                                */
                                ?>

                                <?php foreach ($fit_columns as $i => $col) :
                                    $separator_class = '';

                                    if ($i < count($fit_columns) - 1) {
                                        $separator_class = 'has-separator-lighter';
                                    } elseif ($i === count($fit_columns) - 1) {
                                        $separator_class = 'has-separator';
                                    }
                                    ?>
                                    <div class="cell head-l2 table-2 <?php echo $separator_class; ?>">
                                        <?php echo esc_html($col['label']); ?>
                                    </div>
                                <?php endforeach; ?>

                                <?php foreach ($canaline_columns as $i => $col) :
                                    $separator_class = '';

                                    if ($i < count($canaline_columns) - 1) {
                                        $separator_class = 'has-separator-lighter';
                                    } elseif ($i === count($canaline_columns) - 1) {
                                        $separator_class = 'has-separator';
                                    }
                                    ?>
                                    <div class="cell head-l2 table-2 <?php echo $separator_class; ?>">
                                        <?php echo esc_html($col['label']); ?>
                                    </div>
                                <?php endforeach; ?>

                                <?php foreach ($accessori_columns as $i => $col) :
                                    $separator_class = $i < count($accessori_columns) - 1 ? 'has-separator-lighter' : '';
                                    ?>
                                    <div class="cell head-l2 table-2 <?php echo $separator_class; ?>">
                                        <?php echo esc_html($col['label']); ?>
                                    </div>
                                <?php endforeach; ?>

                                <?php
                                /*
                                |--------------------------------------------------------------------------
                                | SPACER ROW
                                |--------------------------------------------------------------------------
                                */
                                ?>

                                <div class="table-row table-row-spacer" aria-hidden="true">
                                    <div class="cell first-col table-spacer-cell"></div>

                                    <?php
                                    $total_cols =
                                        count($fit_columns) +
                                        count($spec_columns) +
                                        count($canaline_columns) +
                                        count($accessori_columns);
                                    ?>

                                    <?php for ($i = 0; $i < $total_cols; $i++) : ?>
                                        <div class="cell table-spacer-cell"></div>
                                    <?php endfor; ?>
                                </div>

                                <?php
                                /*
                                |--------------------------------------------------------------------------
                                | BODY
                                |--------------------------------------------------------------------------
                                */
                                ?>

                                <?php foreach ($rows as $row) : ?>
                                    <div class="table-row">

                                        <div class="cell first-col table-2 medium text-secondary has-separator">
                                            <?php echo esc_html($row['mod']); ?>
                                        </div>

                                        <?php foreach ($fit_columns as $i => $col) :
                                            $key = $col['key'];
                                            $value = $row['fit_group'][$key] ?? false;

                                            $separator_class = '';
                                            if ($i < count($fit_columns) - 1) {
                                                $separator_class = 'has-separator-lighter';
                                            } elseif ($i === count($fit_columns) - 1) {
                                                $separator_class = 'has-separator';
                                            }
                                            ?>
                                            <div class="cell table-2 <?php echo $separator_class; ?>">
                                                <?php if ($value) : ?>
                                                    <span class="is-check">
                                                        <?php echo get_icon('check'); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>

                                        <?php foreach ($spec_columns as $spec) :
                                            $key = $spec['key'];
                                            $value = $row['specs'][$key] ?? '';
                                            ?>
                                            <div class="cell table-2 has-separator">
                                                <?php echo esc_html($value); ?>
                                            </div>
                                        <?php endforeach; ?>

                                        <?php foreach ($canaline_columns as $i => $col) :
                                            $key = $col['key'];
                                            $value = $row['canaline_group'][$key] ?? false;

                                            $separator_class = '';
                                            if ($i < count($canaline_columns) - 1) {
                                                $separator_class = 'has-separator-lighter';
                                            } elseif ($i === count($canaline_columns) - 1) {
                                                $separator_class = 'has-separator';
                                            }
                                            ?>
                                            <div class="cell table-2 <?php echo $separator_class; ?>">
                                                <?php if ($value) : ?>
                                                    <span class="is-check">
                                                        <?php echo get_icon('check'); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>

                                        <?php foreach ($accessori_columns as $i => $col) :
                                            $key = $col['key'];
                                            $value = $row['accessori_group'][$key] ?? false;

                                            $separator_class = $i < count($accessori_columns) - 1 ? 'has-separator-lighter' : '';
                                            ?>
                                            <div class="cell table-2 <?php echo $separator_class; ?>">
                                                <?php if ($value === 'dot') : ?>
                                                    <span class="is-dot">■</span>
                                                <?php elseif ($value === true) : ?>
                                                    <span class="is-check">
                                                        <?php echo get_icon('check'); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <?php
            render_tech_table_v2(
                $table_config_cilindrate,
                $rows_cilindrate,
                'Specifiche tecniche — Adatto alle cilindrate'
            );

            render_tech_table_v2(
                $table_config_fluidi,
                $rows_fluidi,
                'Specifiche tecniche — Adatto ai fluidi'
            );
            ?>
        </div>
    </div>

</section>


    