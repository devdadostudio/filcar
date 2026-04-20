<?php
$adapt_to = get_field('adapt_to');
$compatibility = $adapt_to['compatibility'];
$compatibility_c = count($compatibility);
?>
<section id="caratteristiche" class="section js-section sp-pt-16 sp-pb-8" data-anchor="caratteristiche">
    <div class="section-inner container-fluid">
        <div class="subtitle-header sp-mb-5">
            <h2 class="h6 text-secondary text-uppercase semibold">Caratteristiche</h2>
        </div>
        <?php if ($compatibility_c > 0) : ?>
            <div class="sp-py-0 sp-lg-py-6">
                <div class="row">
                    <div class="col-lg-4">
                        <!-- TODO - COLORI!! -->
                        <div class="">
                            <span class="text-uppercase subtitle-2">Adatto a</span>
                        </div>
                    </div>
                    <div class="col-llg-8">
                        <!-- Icons -->
                        <div class="fit-block">
                            <?php
                            for($i = 0; $i < $compatibility_c; $i++) {
                                $comp = $compatibility[$i];
                            ?>
                            <div class="fit-item">
                                <?php
                                    switch ($comp) {
                                        case 'Motoveicoli':
                                            echo '<img src="' . get_template_directory_uri() . '/assets/icons-cilindrate/moto-aligned-left.svg" alt="Compatibilità ' . $comp . '" srcset="">';
                                            break;
                                        case 'Veicoli piccola cilindrata':
                                            echo '<img src="' . get_template_directory_uri() . '/assets/icons-cilindrate/auto-aligned-left.svg" alt="Compatibilità ' . $comp . '" srcset="">';
                                            break;
                                        case 'Veicoli grande cilindrata':
                                            echo '<img src="' . get_template_directory_uri() . '/assets/icons-cilindrate/supercar-aligned-left.svg" alt="Compatibilità ' . $comp . '" srcset="">';
                                            break;
                                        case 'Autobus e autosnodati':
                                            echo '<img src="' . get_template_directory_uri() . '/assets/icons-cilindrate/autobus-aligned-left.svg" alt="Compatibilità ' . $comp . '" srcset="">';
                                            break;
                                        case 'Veicoli Autoarticolati':
                                            echo '<img src="' . get_template_directory_uri() . '/assets/icons-cilindrate/articolato-aligned-left.svg" alt="Compatibilità ' . $comp . '" srcset="">';
                                            break;
                                        case 'Macchine movimento terra':
                                            echo '<img src="' . get_template_directory_uri() . '/assets/icons-cilindrate/mezzi-pesanti-aligned-left.svg" alt="Compatibilità ' . $comp . '" srcset="">';
                                            break;
                                    }
                                ?>
                                <span class="table-2 medium"><?php echo $comp; ?></span>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endif;
        $description = get_field('description');
        if ($description) :
        ?>
        <div class="border-top sp-py-3 sp-lg-py-5">
            <div class="row">
                <div class="col-lg-4">
                    <!-- TODO - COLORI!! -->
                    <div class="">
                        <span class="text-uppercase subtitle-2">Descrizione</span>
                    </div>
                </div>
                <div class="col-llg-8 sp-my-6 sp-lg-my-0">
                    <div class="">
                        <?php echo $description; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        endif;
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
            <div class="table-shell">
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
                        ?>

                        <div class="cell corner table-2 head-rowspan-2 has-separator" style="grid-row: span 2;">
                            Mod
                        </div>

                        <?php if (!empty($cilindrate_columns)) : ?>
                            <div class="cell head-l1 table-2 has-separator" style="grid-column: span <?php echo count($cilindrate_columns); ?>;">
                                Adatto alle cilindrate
                            </div>
                        <?php endif; ?>

                        <div class="cell head-rowspan-2 table-2 has-separator" style="grid-row: span 2;">
                            Diametro interno<br>del tubo
                        </div>

                        <div class="cell head-rowspan-2 table-2 has-separator" style="grid-row: span 2;">
                            Temperatura<br>massima di esercizio
                        </div>

                        <div class="cell head-rowspan-2 table-2 has-separator" style="grid-row: span 2;">
                            Potenza<br>motore
                        </div>

                        <?php if (!empty($canaline_columns)) : ?>
                            <div class="cell head-l1 table-2 has-separator" style="grid-column: span <?php echo count($canaline_columns); ?>;">
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
                        ?>

                        <?php foreach ($cilindrate_columns as $i => $col) :
                            $separator_class = '';

                            if ($i < count($cilindrate_columns) - 1) {
                                $separator_class = 'has-separator-lighter';
                            } elseif ($i === count($cilindrate_columns) - 1) {
                                $separator_class = 'has-separator';
                            }
                        ?>
                            <div class="cell head-l2 <?php echo $separator_class; ?>">
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
                        | Riga tecnica vuota tra intestazione e body
                        */
                        ?>

                        <div class="table-row table-row-spacer" aria-hidden="true">

                            <!-- prima colonna -->
                            <div class="cell first-col table-spacer-cell"></div>

                            <!-- tutte le altre colonne -->
                            <?php
                            $total_cols =
                                count($cilindrate_columns) +
                                count($canaline_columns) +
                                count($accessori_columns) +
                                3; // diametro + temperatura + potenza
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

                                <?php foreach ($cilindrate_columns as $i => $col) :
                                    $key = $col['key'];
                                    $value = $row['cilindrate'][$key] ?? false;

                                    $separator_class = '';

                                    if ($i < count($cilindrate_columns) - 1) {
                                        $separator_class = 'has-separator-lighter';
                                    } elseif ($i === count($cilindrate_columns) - 1) {
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

                                <div class="cell table-2 has-separator">
                                    <?php echo esc_html($row['diametro'] ?? ''); ?>
                                </div>

                                <div class="cell table-2 has-separator">
                                    <?php echo esc_html($row['temperatura'] ?? ''); ?>
                                </div>

                                <div class="cell table-2 has-separator">
                                    <?php echo esc_html($row['potenza'] ?? ''); ?>
                                </div>

                                <?php foreach ($canaline_columns as $i => $col) :
                                    $key = $col['key'];
                                    $value = $row['canaline'][$key] ?? false;

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
                                    $value = $row['accessori'][$key] ?? false;

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
    </div>

</section>


    