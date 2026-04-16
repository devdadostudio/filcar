<section id="dimensioni" class="section js-section" data-anchor="dimensioni">
    <div class="section-inner container-fluid">
        <div class="subtitle-header sp-pb-6">
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
        | mobile/tablet = px + scroll
        | desktop >= 1200 = fr + no scroll orizzontale
        */

        $dimension_grid_parts_mobile = [];
        $dimension_grid_parts_desktop = [];

        $dimension_grid_parts_mobile[] = $dimension_mod_width;
        $dimension_grid_parts_desktop[] = str_replace('px', 'fr', $dimension_mod_width);

        foreach ($dimension_columns as $col) {
            $col_width = $col['width'] ?? '40px';
            $dimension_grid_parts_mobile[] = $col_width;
            $dimension_grid_parts_desktop[] = str_replace('px', 'fr', $col_width);
        }

        $dimension_grid_template_mobile = implode(' ', $dimension_grid_parts_mobile);
        $dimension_grid_template_desktop = implode(' ', $dimension_grid_parts_desktop);
        ?>

        <div class="table-shell">
            <div class="table-scroll">
                <div
                    class="fake-table dimension-table"
                    style="
                        --grid-mobile: <?php echo esc_attr($dimension_grid_template_mobile); ?>;
                        --grid-desktop: <?php echo esc_attr($dimension_grid_template_desktop); ?>;
                    "
                >

                    <?php
                    /*
                    |--------------------------------------------------------------------------
                    | HEADER
                    |--------------------------------------------------------------------------
                    */
                    ?>

                    <div class="cell corner table-2 head-l1 has-separator">
                        Mod
                    </div>

                    <?php foreach ($dimension_columns as $i => $col) :
                        $separator_class = $i < count($dimension_columns) - 1 ? 'has-separator-lighter' : '';
                    ?>
                        <div class="cell head-l1 table-2 <?php echo $separator_class; ?>">
                            <?php echo wp_kses($col['label'], ['br' => []]); ?>
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

                        <?php for ($i = 0; $i < count($dimension_columns); $i++) : ?>
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

                    <?php foreach ($dimension_rows as $row) : ?>
                        <div class="table-row">

                            <div class="cell first-col table-2 medium text-secondary has-separator">
                                <?php echo esc_html($row['mod']); ?>
                            </div>

                            <?php foreach ($dimension_columns as $i => $col) :
                                $key = $col['key'];
                                $value = $row['values'][$key] ?? '';
                                $separator_class = $i < count($dimension_columns) - 1 ? 'has-separator-lighter' : '';
                            ?>
                                <div class="cell table-2 <?php echo $separator_class; ?>">
                                    <?php echo esc_html($value); ?>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>