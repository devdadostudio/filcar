<?php
$adapt_to = get_field('adapt_to_features_block');
$compatibility = $adapt_to['compatibility'];
$compatibility_c = count($compatibility);
?>
<section id="caratteristiche" class="section js-section sp-pt-11 sp-lg-pt-16 sp-lg-pb-8 sp-pb-6" data-anchor="caratteristiche">
    <div class="section-inner container-fluid">
        <div class="subtitle-header sp-mb-5">
            <h2 class="h6 text-secondary text-uppercase semibold">Caratteristiche</h2>
        </div>
        <?php if ($compatibility_c > 0) : ?>
            <div class="sp-pb-5 sp-lg-py-6">
                <div class="row">
                    <div class="col-lg-4 sp-pb-5 sp-lg-pb-0">
                        <!-- TODO - COLORI!! -->
                        <div class="">
                            <span class="text-uppercase subtitle-2">Adatto a</span>
                        </div>
                    </div>
                    <div class="col-lg-8">
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
        $description = get_field('description_features_block');
        if ($description) :
        ?>
        <div class="border-top sp-py-5">
            <div class="row">
                <div class="col-lg-4">
                    <!-- TODO - COLORI!! -->
                    <div class="">
                        <span class="text-uppercase subtitle-2">Descrizione</span>
                    </div>
                </div>
                <div class="col-lg-8 sp-my-6 sp-lg-my-0">
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
            ['Motoveicoli' => '🏍'],
            ['Veicoli piccola cilindrata' => '🚗'],
            ['Veicoli grande cilindrata' => '🚙'],
            ['Autobus e autosnodati' => '🚐'],
            ['Veicoli Autoarticolati' => '🚚'],
            ['Macchine movimento terra' => '🚜'],
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
        <div class="border-top sp-py-5">
            <div class="sp-mb-5">
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
                        $table_features = get_field('table_features_features_block');
                        $table_features_headings = $table_features['headings'];
                        $table_features_rows = $table_features['rows'];
                        for($i = 0; $i < count($table_features_headings); $i++) :
                            $separator_class = $i < count($table_features_headings) - 1 ? 'has-separator' : '';
                            if($i == 0) : ?>
                                <div class="cell corner table-2 head-rowspan-2 has-separator" style="grid-row: span 2;">
                                    <?php echo $table_features_headings[$i]['lable_title']; ?>
                                </div>
                        <?php
                            else :
                                $heading_type = $table_features_headings[$i]['heading_type'];
                                if($heading_type == 'title-normal') : 
                        ?>
                                    <div class="cell head-rowspan-2 table-2 <?php echo $separator_class; ?>" style="grid-row: span 2;">
                                        <?php echo $table_features_headings[$i]['lable_title']; ?>
                                    </div>
                        <?php
                                elseif($heading_type == 'title-advanced') :
                                    $advanced_select = $table_features_headings[$i]['advanced_select'];
                                    if($advanced_select == 'Cilindrate'){
                                        $sub_rows = $table_features_headings[$i]['displacements'];
                                    }elseif($advanced_select == 'Fluidi'){
                                        $sub_rows = $table_features_headings[$i]['fluids'];
                                    }
                                    if (!empty($sub_rows)) : ?>
                                        <div class="cell head-l1 table-2 <?php echo $separator_class; ?>" style="grid-column: span <?php echo count($sub_rows); ?>;">
                                            <?php echo $table_features_headings[$i]['lable_title']; ?>
                                        </div>
                                    <?php endif; ?>
                        <?php
                                elseif($heading_type == 'title-sub') :
                                    $sub_rows = $table_features_headings[$i]['subtitles'];
                        ?>
                                    <div class="cell head-l1 table-2 <?php echo $separator_class; ?>" style="grid-column: span <?php echo count($sub_rows); ?>;">
                                        <?php echo $table_features_headings[$i]['lable_title']; ?>
                                    </div>
                        <?php
                                endif;
                        ?>
                        <?php
                            endif;
                        endfor;
                        ?>

                        <?php
                        /*
                        |--------------------------------------------------------------------------
                        | HEADER - RIGA 2
                        |--------------------------------------------------------------------------
                        */
                        ?>

                        <?php
                        for($i = 0; $i < count($table_features_headings); $i++) :
                            $heading_type = $table_features_headings[$i]['heading_type'];
                            if($heading_type == 'title-advanced') :
                                $advanced_select = $table_features_headings[$i]['advanced_select'];
                                if($advanced_select == 'Cilindrate'){
                                    $sub_rows_2 = $table_features_headings[$i]['displacements'];
                                }elseif($advanced_select == 'Fluidi'){
                                    $sub_rows_2 = $table_features_headings[$i]['fluids'];
                                }
                                for($j = 0; $j < count($sub_rows_2); $j++) :
                                    $separator_class = '';
                                    if ($j < count($sub_rows_2) - 1) {
                                        $separator_class = 'has-separator-lighter';
                                    } elseif ($j === count($sub_rows_2) - 1) {
                                        $separator_class = 'has-separator';
                                    }
                                    $displacement_type = $sub_rows_2[$j]['displacement_type'];
                                ?>
                                    <div class="cell head-l2 <?php echo $separator_class; ?>">
                                        <?php echo esc_html($cilindrate_columns[$j][$displacement_type]); ?>
                                    </div>
                                <?php
                                endfor;
                            elseif($heading_type == 'title-sub') :
                                $sub_rows_2 = $table_features_headings[$i]['subtitles'];
                                $separator_class = '';
                                for($k = 0; $k < count($sub_rows_2); $k++) :
                                    if ($k < count($sub_rows_2) - 1) {
                                        $separator_class = 'has-separator-lighter';
                                    } elseif ($k === count($sub_rows_2) - 1) {
                                        $separator_class = 'has-separator';
                                    }
                        ?>
                                    <div class="cell head-l2 table-2 <?php echo $separator_class; ?>">
                                        <?php echo esc_html($sub_rows_2[$k]['subtitle']); ?>
                                    </div>
                        <?php
                                endfor;
                            endif;
                        endfor;
                        ?>

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
                            $total_cols = 0;
                            for($tc = 0; $tc < count($table_features_headings); $tc++) :
                                if($table_features_headings[$tc]['heading_type'] == 'title-normal') :
                                    $total_cols += 1;
                                elseif($table_features_headings[$tc]['heading_type'] == 'title-advanced') :
                                    $advanced_select = $table_features_headings[$tc]['advanced_select'];
                                    if($advanced_select == 'Cilindrate'){
                                        $sub_rows_tc = $table_features_headings[$tc]['displacements'];
                                    }elseif($advanced_select == 'Fluidi'){
                                        $sub_rows_tc = $table_features_headings[$tc]['fluids'];
                                    }
                                    $total_cols += count($sub_rows_tc);
                                elseif($table_features_headings[$tc]['heading_type'] == 'title-sub') :
                                    $total_cols += count($table_features_headings[$tc]['subtitles']);
                                endif;
                            endfor;
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
                        $rows = $table_features['rows'];
                        if(!empty($rows)){
                            $rows_c = count($rows);
                            for($i = 0; $i < $rows_c; $i++){
                                $row = $rows[$i];
                                $columns = $row['columns'];
                                $columns_c = count($columns);
                        ?>
                                <div class="table-row">
                        <?php
                                    for($j = 0; $j < $columns_c; $j++) :
                                        $column = $columns[$j];
                                        $column_type = $column['column_type'];
                                        if($j == 0) :
                        ?>
                                        <div class="cell first-col table-2 medium text-secondary has-separator">
                                            <?php echo esc_html($column['column_value']); ?>
                                        </div>
                        <?php
                                        else :
                                            if($column_type == 'row-normal') :
                        ?>
                                                <div class="cell table-2 has-separator">
                                                    <?php echo esc_html($column['column_value']); ?>
                                                </div>
                        <?php
                                            elseif($column_type == 'row-advanced') :
                                                $advanced_values = $column['advanced_values'];
                                                if(!empty($advanced_values)):
                                                    $advanced_values_c = count($advanced_values);
                                                    for($k = 0; $k < $advanced_values_c; $k++) :
                                                        $separator_class = '';
                                                        if ($k < $advanced_values_c - 1) {
                                                            $separator_class = 'has-separator-lighter';
                                                        } elseif ($k === $advanced_values_c - 1) {
                                                            $separator_class = 'has-separator';
                                                        }
                                                        $value = $advanced_values[$k]['value'];
                                                ?>
                                                        <div class="cell table-2 <?php echo $separator_class; ?>">
                                                            <?php if ($value) : ?>
                                                                <span class="is-check">
                                                                    <?php echo get_icon('check'); ?>
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                <?php
                                                    endfor;
                                                endif;
                                            elseif($column_type == 'row-sub') :
                                                $values_subtitles = $column['values_subtitles'];
                                                if(!empty($values_subtitles)):
                                                    $values_subtitles_c = count($values_subtitles);
                                                    for($sb = 0; $sb < $values_subtitles_c; $sb++) :
                                                        $separator_class = $sb < $values_subtitles_c - 1 ? 'has-separator-lighter' : '';
                                                        $value = $values_subtitles[$sb]['value'];
                                                        $type_check = $values_subtitles[$sb]['type_check'];
                                                    ?>
                                                        <div class="cell table-2 <?php echo $separator_class; ?>">
                                                            <?php
                                                                if ($value) :
                                                                    if ($type_check === 'dot') : ?>
                                                                        <span class="is-dot">■</span>
                                                            <?php 
                                                                    elseif ($type_check === 'check') : ?>
                                                                        <span class="is-check">
                                                                            <?php echo get_icon('check'); ?>
                                                                        </span>
                                                            <?php
                                                                    endif;
                                                                endif;
                                                            ?>
                                                        </div>
                        <?php                       endfor;
                                                endif;
                                            endif;
                                        endif;
                        ?>

                        <?php
                                    endfor;
                        ?>

                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    