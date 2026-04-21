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
        endif; ?>
        <?php
        $table_features = get_field('table_features_features_block');
        $table_features_headings = $table_features['headings'] ?? [];
        $table_features_rows = $table_features['rows'] ?? [];

        /*
        |--------------------------------------------------------------------------
        | HELPERS
        |--------------------------------------------------------------------------
        */

        if (!function_exists('features_get_advanced_icon')) {
            function features_get_advanced_icon($item, $mode = 'Cilindrate') {
                if ($mode === 'Fluidi') {
                    $label = trim($item['fluid_type'] ?? '');
                    $map = [
                        'Fluido 1' => '💧',
                        'Fluido 2' => '🌬',
                        'Fluido 3' => '🛢',
                        'Fluido 4' => '♨️',
                        'Fluido 5' => '🔥',
                    ];

                    return $map[$label] ?? $label;
                }

                $label = trim($item['displacement_type'] ?? '');
                $map = [
                    'Motoveicoli'                => '🏍',
                    'Veicoli piccola cilindrata' => '🚗',
                    'Veicoli grande cilindrata'  => '🚙',
                    'Autobus e autosnodati'      => '🚐',
                    'Veicoli Autoarticolati'     => '🚚',
                    'Macchine movimento terra'   => '🚜',
                ];

                return $map[$label] ?? $label;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | GRID DINAMICA DA ACF (ORDINE REALE ACF)
        |--------------------------------------------------------------------------
        */

        $grid_parts_mobile = [];
        $grid_parts_desktop = [];

        foreach ($table_features_headings as $i => $heading) {
            $type = $heading['heading_type'] ?? '';
            $label = trim($heading['lable_title'] ?? '');

            if ($i === 0) {
                $grid_parts_mobile[] = '120px';
                $grid_parts_desktop[] = 'minmax(120px,1.4fr)';
                continue;
            }

            if ($type === 'title-advanced') {
                $sub = [];

                if (($heading['advanced_select'] ?? '') === 'Cilindrate') {
                    $sub = $heading['displacements'] ?? [];
                } elseif (($heading['advanced_select'] ?? '') === 'Fluidi') {
                    $sub = $heading['fluids'] ?? [];
                }

                foreach ($sub as $s) {
                    $grid_parts_mobile[] = '44px';
                    $grid_parts_desktop[] = 'minmax(44px,0.55fr)';
                }

                continue;
            }

            if ($type === 'title-normal') {
                $grid_parts_mobile[] = '95px';
                $grid_parts_desktop[] = 'minmax(95px,1fr)';
                continue;
            }

            if ($type === 'title-sub') {
                $sub = $heading['subtitles'] ?? [];

                if ($label === 'Canaline compatibili') {
                    foreach ($sub as $s) {
                        $grid_parts_mobile[] = '60px';
                        $grid_parts_desktop[] = 'minmax(60px,0.8fr)';
                    }
                } else {
                    foreach ($sub as $s) {
                        $grid_parts_mobile[] = '40px';
                        $grid_parts_desktop[] = 'minmax(40px,0.55fr)';
                    }
                }
            }
        }

        $grid_template_columns_mobile = implode(' ', $grid_parts_mobile);
        $grid_template_columns_desktop = implode(' ', $grid_parts_desktop);

        /*
        |--------------------------------------------------------------------------
        | CONTEGGI ATTESI PER NORMALIZZARE IL BODY
        |--------------------------------------------------------------------------
        */

        $expected_advanced_counts = [];
        $expected_sub_counts = [];
        $expected_sub_group_labels = [];

        foreach ($table_features_headings as $heading) {
            $heading_type = $heading['heading_type'] ?? '';

            if ($heading_type === 'title-advanced') {
                $advanced_select = $heading['advanced_select'] ?? '';
                $sub_rows = [];

                if ($advanced_select === 'Cilindrate') {
                    $sub_rows = $heading['displacements'] ?? [];
                } elseif ($advanced_select === 'Fluidi') {
                    $sub_rows = $heading['fluids'] ?? [];
                }

                $expected_advanced_counts[] = count($sub_rows);
            }

            if ($heading_type === 'title-sub') {
                $expected_sub_counts[] = count($heading['subtitles'] ?? []);
                $expected_sub_group_labels[] = trim($heading['lable_title'] ?? '');
            }
        }
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
                        ?>

                        <?php foreach ($table_features_headings as $i => $heading) :
                            $heading_type = $heading['heading_type'] ?? '';
                            $label = $heading['lable_title'] ?? '';
                            $separator_class = $i < count($table_features_headings) - 1 ? 'has-separator' : '';

                            if ($i === 0) : ?>
                                <div class="cell corner table-2 head-rowspan-2 has-separator" style="grid-row: span 2;">
                                    <?php echo esc_html($label); ?>
                                </div>
                            <?php else : ?>

                                <?php if ($heading_type === 'title-normal') : ?>
                                    <div class="cell head-rowspan-2 table-2 <?php echo $separator_class; ?>" style="grid-row: span 2;">
                                        <?php echo esc_html($label); ?>
                                    </div>

                                <?php elseif ($heading_type === 'title-advanced') :
                                    $advanced_select = $heading['advanced_select'] ?? '';
                                    $sub_rows = [];

                                    if ($advanced_select === 'Cilindrate') {
                                        $sub_rows = $heading['displacements'] ?? [];
                                    } elseif ($advanced_select === 'Fluidi') {
                                        $sub_rows = $heading['fluids'] ?? [];
                                    }

                                    if (!empty($sub_rows)) : ?>
                                        <div class="cell head-l1 table-2 <?php echo $separator_class; ?>" style="grid-column: span <?php echo count($sub_rows); ?>;">
                                            <?php echo esc_html($label); ?>
                                        </div>
                                    <?php endif; ?>

                                <?php elseif ($heading_type === 'title-sub') :
                                    $sub_rows = $heading['subtitles'] ?? [];
                                    if (!empty($sub_rows)) : ?>
                                        <div class="cell head-l1 table-2 <?php echo $separator_class; ?>" style="grid-column: span <?php echo count($sub_rows); ?>;">
                                            <?php echo esc_html($label); ?>
                                        </div>
                                    <?php endif; ?>

                                <?php endif; ?>

                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php
                        /*
                        |--------------------------------------------------------------------------
                        | HEADER - RIGA 2
                        |--------------------------------------------------------------------------
                        */
                        ?>

                        <?php foreach ($table_features_headings as $heading) :
                            $heading_type = $heading['heading_type'] ?? '';

                            if ($heading_type === 'title-advanced') :
                                $advanced_select = $heading['advanced_select'] ?? '';
                                $sub_rows_2 = [];

                                if ($advanced_select === 'Cilindrate') {
                                    $sub_rows_2 = $heading['displacements'] ?? [];
                                } elseif ($advanced_select === 'Fluidi') {
                                    $sub_rows_2 = $heading['fluids'] ?? [];
                                }

                                for ($j = 0; $j < count($sub_rows_2); $j++) :
                                    $separator_class = '';
                                    if ($j < count($sub_rows_2) - 1) {
                                        $separator_class = 'has-separator-lighter';
                                    } elseif ($j === count($sub_rows_2) - 1) {
                                        $separator_class = 'has-separator';
                                    }
                                    ?>
                                    <div class="cell head-l2 <?php echo $separator_class; ?>">
                                        <?php echo esc_html(features_get_advanced_icon($sub_rows_2[$j], $advanced_select)); ?>
                                    </div>
                                <?php endfor;
                            endif;

                            if ($heading_type === 'title-sub') :
                                $sub_rows_2 = $heading['subtitles'] ?? [];

                                for ($k = 0; $k < count($sub_rows_2); $k++) :
                                    $separator_class = '';
                                    if ($k < count($sub_rows_2) - 1) {
                                        $separator_class = 'has-separator-lighter';
                                    } elseif ($k === count($sub_rows_2) - 1) {
                                        $separator_class = 'has-separator';
                                    }
                                    ?>
                                    <div class="cell head-l2 table-2 <?php echo $separator_class; ?>">
                                        <?php echo esc_html($sub_rows_2[$k]['subtitle'] ?? ''); ?>
                                    </div>
                                <?php endfor;
                            endif;
                        endforeach; ?>

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
                            $total_cols = 0;
                            foreach ($table_features_headings as $index => $heading) {
                                if ($index === 0) {
                                    continue;
                                }

                                $type = $heading['heading_type'] ?? '';

                                if ($type === 'title-normal') {
                                    $total_cols += 1;
                                } elseif ($type === 'title-advanced') {
                                    $advanced_select = $heading['advanced_select'] ?? '';
                                    $sub_rows_tc = [];

                                    if ($advanced_select === 'Cilindrate') {
                                        $sub_rows_tc = $heading['displacements'] ?? [];
                                    } elseif ($advanced_select === 'Fluidi') {
                                        $sub_rows_tc = $heading['fluids'] ?? [];
                                    }

                                    $total_cols += count($sub_rows_tc);
                                } elseif ($type === 'title-sub') {
                                    $total_cols += count($heading['subtitles'] ?? []);
                                }
                            }
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

                        <?php if (!empty($table_features_rows)) :
                            foreach ($table_features_rows as $row) :
                                $columns = $row['columns'] ?? [];
                                $advanced_group_index = 0;
                                $sub_group_index = 0;
                                ?>
                                <div class="table-row">

                                    <?php foreach ($columns as $j => $column) :
                                        $column_type = $column['column_type'] ?? '';

                                        if ($j === 0) : ?>
                                            <div class="cell first-col table-2 medium text-secondary has-separator">
                                                <?php echo esc_html($column['column_value'] ?? ''); ?>
                                            </div>

                                        <?php elseif ($column_type === 'row-normal') : ?>
                                            <div class="cell table-2 has-separator">
                                                <?php echo esc_html($column['column_value'] ?? ''); ?>
                                            </div>

                                        <?php elseif ($column_type === 'row-advanced') :
                                            $advanced_values = $column['advanced_values'] ?? [];
                                            $expected_count = $expected_advanced_counts[$advanced_group_index] ?? count($advanced_values);

                                            $advanced_values = array_slice($advanced_values, 0, $expected_count);
                                            while (count($advanced_values) < $expected_count) {
                                                $advanced_values[] = ['value' => false];
                                            }

                                            for ($k = 0; $k < $expected_count; $k++) :
                                                $separator_class = '';
                                                if ($k < $expected_count - 1) {
                                                    $separator_class = 'has-separator-lighter';
                                                } elseif ($k === $expected_count - 1) {
                                                    $separator_class = 'has-separator';
                                                }
                                                $value = $advanced_values[$k]['value'] ?? false;
                                                ?>
                                                <div class="cell table-2 <?php echo $separator_class; ?>">
                                                    <?php if ($value) : ?>
                                                        <span class="is-check">
                                                            <?php echo get_icon('check'); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endfor;

                                            $advanced_group_index++;
                                            ?>

                                        <?php elseif ($column_type === 'row-sub') :
                                            $values_subtitles = $column['values_subtitles'] ?? [];
                                            $expected_count = $expected_sub_counts[$sub_group_index] ?? count($values_subtitles);
                                            $sub_group_label = $expected_sub_group_labels[$sub_group_index] ?? '';

                                            $values_subtitles = array_slice($values_subtitles, 0, $expected_count);
                                            while (count($values_subtitles) < $expected_count) {
                                                $values_subtitles[] = [
                                                    'value' => false,
                                                    'type_check' => '',
                                                ];
                                            }

                                            for ($sb = 0; $sb < $expected_count; $sb++) :
                                                $separator_class = '';

                                                if ($sb < $expected_count - 1) {
                                                    $separator_class = 'has-separator-lighter';
                                                } else {
                                                    if ($sub_group_label === 'Canaline compatibili') {
                                                        $separator_class = 'has-separator';
                                                    } else {
                                                        $separator_class = '';
                                                    }
                                                }

                                                $value = $values_subtitles[$sb]['value'] ?? false;
                                                $type_check = $values_subtitles[$sb]['type_check'] ?? '';
                                                ?>
                                                <div class="cell table-2 <?php echo $separator_class; ?>">
                                                    <?php if ($value) : ?>
                                                        <?php if ($type_check === 'dot') : ?>
                                                            <span class="is-dot">■</span>
                                                        <?php elseif ($type_check === 'check') : ?>
                                                            <span class="is-check">
                                                                <?php echo get_icon('check'); ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endfor;

                                            $sub_group_index++;
                                            ?>

                                        <?php endif; ?>

                                    <?php endforeach; ?>

                                </div>
                            <?php endforeach;
                        endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- start table -->
        <!-- end table -->
    </div>
</section>


    