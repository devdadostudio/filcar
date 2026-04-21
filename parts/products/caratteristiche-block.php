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
                        <div class="">
                            <span class="text-uppercase subtitle-2">Adatto a</span>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="fit-block">
                            <?php
                            for ($i = 0; $i < $compatibility_c; $i++) {
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
    </div>
        <?php
        endif;
        ?>

        <?php
        $table_features = get_field('table_features_features_block');

        if (!function_exists('build_tech_table_grid_template')) {
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
        }

        if (!function_exists('render_tech_table_v2')) {
            function render_tech_table_v2($table_config, $rows, $title = 'Specifiche tecniche') {
                $grid_template_columns = build_tech_table_grid_template($table_config);

                $fit_columns       = $table_config['fit_group']['columns'] ?? [];
                $spec_columns      = $table_config['spec_columns'] ?? [];
                $canaline_columns  = $table_config['canaline_group']['columns'] ?? [];
                $accessori_columns = $table_config['accessori_group']['columns'] ?? [];
                ?>
                <div class="border-top sp-py-5">
                    <div class="sp-mb-5">
                        <span class="text-uppercase subtitle-2"><?php echo esc_html($title); ?></span>
                    </div>

                    <div class="table-shell">
                        <div class="table-scroll">
                            <div
                                class="fake-table tech-table"
                                style="grid-template-columns: <?php echo esc_attr($grid_template_columns); ?>;"
                            >

                                <div class="cell corner table-2 head-rowspan-2 has-separator" style="grid-row: span 2;">
                                    Mod
                                </div>

                                <?php if (!empty($fit_columns)) : ?>
                                    <div class="cell head-l1 table-2 has-separator" style="grid-column: span <?php echo count($fit_columns); ?>;">
                                        <?php echo esc_html($table_config['fit_group']['title']); ?>
                                    </div>
                                <?php endif; ?>

                                <?php foreach ($spec_columns as $spec) : ?>
                                    <div class="cell head-rowspan-2 table-2 has-separator" style="grid-row: span 2;">
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
        }

        if (!function_exists('map_features_table_from_acf')) {
    function map_features_table_from_acf($table_features) {

        $headings = $table_features['headings'] ?? [];
        $rows_raw = $table_features['rows'] ?? [];

        if (empty($headings)) {
            return [null, []];
        }

        $fit_group = [
            'title' => '',
            'columns' => [],
        ];

        $spec_columns = [];

        $canaline_group = [
            'title' => '',
            'columns' => [],
        ];

        $accessori_group = [
            'title' => '',
            'columns' => [],
        ];

        $sub_group_order = [];

        /*
        |--------------------------------------------------------------------------
        | HEADERS → CONFIG
        |--------------------------------------------------------------------------
        */

        foreach ($headings as $index => $heading) {

            if ($index === 0) continue;

            $type  = $heading['heading_type'] ?? '';
            $label = $heading['lable_title'] ?? '';

            /* ---------------- ADVANCED ---------------- */

            if ($type === 'title-advanced') {

                $fit_group['title'] = $label;
                $advanced_select = $heading['advanced_select'] ?? '';

                /* CILINDRATE */
                if ($advanced_select === 'Cilindrate') {

                    $items = $heading['displacements'] ?? [];

                    foreach ($items as $item) {

                        $k = $item['displacement_type'] ?? '';

                        $map = [
                            'Motoveicoli'                => ['key' => 'moto',    'label' => '🏍'],
                            'Veicoli piccola cilindrata' => ['key' => 'auto',    'label' => '🚗'],
                            'Veicoli grande cilindrata'  => ['key' => 'suv',     'label' => '🚙'],
                            'Autobus e autosnodati'      => ['key' => 'van',     'label' => '🚐'],
                            'Veicoli Autoarticolati'     => ['key' => 'truck',   'label' => '🚚'],
                            'Macchine movimento terra'   => ['key' => 'tractor', 'label' => '🚜'],
                        ];

                        if (isset($map[$k])) {
                            $fit_group['columns'][] = $map[$k];
                        }
                    }
                }

                /* FLUIDI → GENERICO DINAMICO */
                elseif ($advanced_select === 'Fluidi') {

                    $items = $heading['fluids'] ?? [];

                    foreach ($items as $idx => $item) {

                        $fit_group['columns'][] = [
                            'key'   => 'fluido_' . ($idx + 1),
                            'label' => '💧 ' . ($idx + 1), // 👈 QUI
                        ];
                    }
                }
            }

            /* ---------------- NORMAL ---------------- */

            if ($type === 'title-normal') {

                $spec_columns[] = [
                    'key'   => sanitize_title($label),
                    'label' => $label,
                ];
            }

            /* ---------------- SUB ---------------- */

            if ($type === 'title-sub') {

                $subtitles = $heading['subtitles'] ?? [];
                $group_key = sanitize_title($label);

                $sub_group_order[] = $group_key;

                $mapped = [];

                foreach ($subtitles as $sub) {

                    $subtitle = $sub['subtitle'] ?? '';

                    $mapped[] = [
                        'key'   => sanitize_title($subtitle),
                        'label' => $subtitle,
                    ];
                }

                if ($label === 'Canaline compatibili') {

                    $canaline_group['title']   = $label;
                    $canaline_group['columns'] = $mapped;

                } else {

                    $accessori_group['title']   = $label;
                    $accessori_group['columns'] = $mapped;
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CONFIG FINALE
        |--------------------------------------------------------------------------
        */

        $table_config = [
            'fit_group'        => $fit_group,
            'spec_columns'     => $spec_columns,
            'canaline_group'   => $canaline_group,
            'accessori_group'  => $accessori_group,
        ];

        /*
        |--------------------------------------------------------------------------
        | ROWS
        |--------------------------------------------------------------------------
        */

        $rows = [];

        foreach ($rows_raw as $row) {

            $columns = $row['columns'] ?? [];

            if (empty($columns)) continue;

            $mapped_row = [
                'mod'              => '',
                'fit_group'        => [],
                'specs'            => [],
                'canaline_group'   => [],
                'accessori_group'  => [],
            ];

            $spec_index = 0;
            $sub_index  = 0;

            foreach ($columns as $col_index => $column) {

                $type = $column['column_type'] ?? '';

                /* MOD */
                if ($col_index === 0) {
                    $mapped_row['mod'] = $column['column_value'] ?? '';
                    continue;
                }

                /* ADVANCED */
                if ($type === 'row-advanced') {

                    $advanced_values = $column['advanced_values'] ?? [];

                    foreach ($fit_group['columns'] as $i => $fit_col) {
                        $mapped_row['fit_group'][$fit_col['key']] =
                            !empty($advanced_values[$i]['value']);
                    }
                }

                /* NORMAL */
                if ($type === 'row-normal') {

                    if (!empty($spec_columns[$spec_index])) {
                        $mapped_row['specs'][$spec_columns[$spec_index]['key']] =
                            $column['column_value'] ?? '';
                    }

                    $spec_index++;
                }

                /* SUB */
                if ($type === 'row-sub') {

                    $values_subtitles = $column['values_subtitles'] ?? [];
                    $current_group = $sub_group_order[$sub_index] ?? '';

                    /* CANALINE */
                    if ($current_group === sanitize_title($canaline_group['title'])) {

                        foreach ($canaline_group['columns'] as $i => $sub_col) {
                            $mapped_row['canaline_group'][$sub_col['key']] =
                                !empty($values_subtitles[$i]['value']);
                        }
                    }

                    /* ACCESSORI */
                    else {

                        foreach ($accessori_group['columns'] as $i => $sub_col) {

                            $value      = $values_subtitles[$i]['value'] ?? false;
                            $type_check = $values_subtitles[$i]['type_check'] ?? '';

                            if ($value && $type_check === 'dot') {
                                $mapped_row['accessori_group'][$sub_col['key']] = 'dot';
                            } elseif ($value && $type_check === 'check') {
                                $mapped_row['accessori_group'][$sub_col['key']] = true;
                            } else {
                                $mapped_row['accessori_group'][$sub_col['key']] = false;
                            }
                        }
                    }

                    $sub_index++;
                }
            }

            $rows[] = $mapped_row;
        }

        return [$table_config, $rows];
    }
}

        [$table_config_dynamic, $rows_dynamic] = map_features_table_from_acf($table_features);

        if (!empty($table_config_dynamic) && !empty($rows_dynamic)) :
        ?>
            <div class="container-fluid-left">
                <?php render_tech_table_v2($table_config_dynamic, $rows_dynamic, 'Specifiche tecniche'); ?>
            </div>
        <?php endif; ?>
        <!-- start table -->
        <!-- end table -->
    
</section>