<div id="dimensioni" class="section js-section sp-py-8" data-anchor="dimensioni">
    <div class="section-inner container-fluid">
        <div class="subtitle-header sp-mb-5">
            <h2 class="h6 text-secondary text-uppercase semibold">Dimensioni</h2>
        </div>
    </div>
        <?php
        $dimension_images = [
            [
                'src' => 'https://placehold.co/900x1200/F7D7DA/333333?text=Dimensione+1',
                'alt' => 'Schema dimensionale 1',
            ],
            [
                'src' => 'https://placehold.co/900x1200/F7D7DA/333333?text=Dimensione+2',
                'alt' => 'Schema dimensionale 2',
            ],
        ];

        $dimension_images = array_slice($dimension_images, 0, 2);
        $count = count($dimension_images);
        ?>
    <div class="container-fluid-left">
        <?php if (!empty($dimension_images) && $count > 0) : ?>
            <div class="dimensions-gallery-shell row">
                <div class="col-12 col-xl-10 offset-xl-1">
                    <div class="dimensions-gallery-scroll">
                        <div class="dimensions-gallery-track is-<?php echo $count; ?>">
                            <?php foreach ($dimension_images as $image) : ?>
                                <div class="dimensions-gallery-item">
                                    <div class="dimensions-gallery-frame">
                                        <img
                                            src="<?php echo esc_url($image['src']); ?>"
                                            alt="<?php echo esc_attr($image['alt']); ?>"
                                            class="dimensions-gallery-image"
                                        >
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php
        $dimension_columns = [
            ['key' => 'a',    'label' => 'A<br>mm',     'width' => 'minmax(74px, 1fr)'],
            ['key' => 'b',    'label' => 'B (Ø)<br>mm', 'width' => 'minmax(74px, 1fr)'],
            ['key' => 'c',    'label' => 'C (Ø)<br>mm', 'width' => 'minmax(74px, 1fr)'],
            ['key' => 'd',    'label' => 'D<br>mm',     'width' => 'minmax(74px, 1fr)'],
            ['key' => 'e',    'label' => 'E<br>mm',     'width' => 'minmax(74px, 1fr)'],
            ['key' => 'f',    'label' => 'F (Ø)<br>mm', 'width' => 'minmax(74px, 1fr)'],
            ['key' => 'g',    'label' => 'G<br>mm',     'width' => 'minmax(74px, 1fr)'],
            ['key' => 'h',    'label' => 'H<br>mm',     'width' => 'minmax(74px, 1fr)'],
            ['key' => 'i',    'label' => 'I<br>mm',     'width' => 'minmax(74px, 1fr)'],
            ['key' => 'l',    'label' => 'L (Ø)<br>mm', 'width' => 'minmax(74px, 1fr)'],
            ['key' => 'm',    'label' => 'M (Ø)<br>mm', 'width' => 'minmax(74px, 1fr)'],
            ['key' => 'n',    'label' => 'N<br>mm',     'width' => 'minmax(74px, 1fr)'],
            ['key' => 'o',    'label' => 'O (Ø)<br>mm', 'width' => 'minmax(74px, 1fr)'],
            ['key' => 'p',    'label' => 'P<br>mm',     'width' => 'minmax(74px, 1fr)'],
            ['key' => 'q',    'label' => 'Q<br>mm',     'width' => 'minmax(74px, 1fr)'],
            ['key' => 'r',    'label' => 'R (Ø)<br>mm', 'width' => 'minmax(74px, 1fr)'],
            ['key' => 's',    'label' => 'S<br>mm',     'width' => 'minmax(74px, 1fr)'],
            ['key' => 'peso', 'label' => 'Peso<br>kg',  'width' => 'minmax(90px, 1fr)'],
            ['key' => 'hp',   'label' => 'HP',          'width' => 'minmax(90px, 1fr)'],
        ];

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

        $dimension_mod_width = 'minmax(120px, 1.4fr)';

        $dimension_grid_parts = [];
        $dimension_grid_parts[] = $dimension_mod_width;

        foreach ($dimension_columns as $col) {
            $col_width = $col['width'] ?? 'minmax(40px, 1fr)';
            $dimension_grid_parts[] = $col_width;
        }

        $dimension_grid_template = implode(' ', $dimension_grid_parts);
        ?>

        <div class="table-shell">
            <div class="table-scroll">
                <div
                    class="fake-table dimension-table"
                    style="grid-template-columns: <?php echo esc_attr($dimension_grid_template); ?>;"
                >

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

                    <div class="table-row table-row-spacer" aria-hidden="true">
                        <div class="cell first-col table-spacer-cell"></div>

                        <?php for ($i = 0; $i < count($dimension_columns); $i++) : ?>
                            <div class="cell table-spacer-cell"></div>
                        <?php endfor; ?>
                    </div>

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
</div>