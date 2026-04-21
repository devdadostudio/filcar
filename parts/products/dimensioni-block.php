<section id="dimensioni" class="section js-section sp-py-6 sp-lg-py-8" data-anchor="dimensioni">
    <div class="section-inner container-fluid">
        <div class="subtitle-header sp-mb-5">
            <h2 class="h6 text-secondary text-uppercase semibold">Dimensioni</h2>
        </div>

        <?php
        $dimension_images = get_field('imgs_section_dimensions');
        ?>

        <?php 
        if (!empty($dimension_images)) :
            $imgs_count = count($dimension_images);
        ?>
            <?php if ($imgs_count > 0) : ?>
                <div class="dimensions-gallery-shell row">
                    <div class="col-12 col-xl-10 offset-xl-1">
                        <div class="dimensions-gallery-scroll">
                            <div class="dimensions-gallery-track is-<?php echo $imgs_count; ?>">
                                <?php foreach ($dimension_images as $image) : ?>
                                    <div class="dimensions-gallery-item">
                                        <div class="dimensions-gallery-frame aspect-ratio-4x3 respimg">
                                            <img
                                                src="<?php echo esc_url($image['url']); ?>"
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
        <?php endif; ?>

        <?php
        $table_dimensions = get_field('table_dimensions');
        $table_headings = $table_dimensions['headings'] ?? [];
        $table_rows = $table_dimensions['rows'] ?? [];

        /*
        |--------------------------------------------------------------------------
        | GRID TEMPLATE DINAMICO
        |--------------------------------------------------------------------------
        */

        $dimension_grid_parts = [];

        foreach ($table_headings as $i => $heading) {
            if ($i === 0) {
                // prima colonna Mod
                $dimension_grid_parts[] = 'minmax(120px,1.4fr)';
            } else {
                // tutte le altre colonne dimensioni
                $dimension_grid_parts[] = 'minmax(74px,1fr)';
            }
        }

        $dimension_grid_template = implode(' ', $dimension_grid_parts);
        ?>

        <div class="table-shell">
            <div class="table-scroll">
                <div
                    class="fake-table dimension-table"
                    style="grid-template-columns: <?php echo esc_attr($dimension_grid_template); ?>;"
                >

                    <?php
                    /*
                    |--------------------------------------------------------------------------
                    | HEADER
                    |--------------------------------------------------------------------------
                    */
                    foreach ($table_headings as $i => $heading) :
                        $label = $heading['lable_title'] ?? '';

                        if ($i === 0) :
                    ?>
                            <div class="cell corner table-2 head-l1 has-separator">
                                <?php echo $label; ?>
                            </div>
                        <?php
                        else :
                            $separator_class = $i < count($table_headings) - 1 ? 'has-separator-lighter' : '';
                        ?>
                            <div class="cell head-l1 table-2 <?php echo $separator_class; ?>">
                                <?php echo wp_kses($label, ['br' => []]); ?>
                            </div>
                    <?php
                        endif;
                    endforeach;
                    ?>

                    <?php
                    /*
                    |--------------------------------------------------------------------------
                    | SPACER ROW
                    |--------------------------------------------------------------------------
                    */
                    ?>

                    <div class="table-row table-row-spacer" aria-hidden="true">
                        <div class="cell first-col table-spacer-cell"></div>

                        <?php for ($i = 1; $i < count($table_headings); $i++) : ?>
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

                    <?php foreach ($table_rows as $tr => $row) : ?>
                        <div class="table-row">
                            <?php
                            $columns = $row['columns'] ?? [];
                            $columns_c = count($columns);

                            for ($cl = 0; $cl < $columns_c; $cl++) :
                                $col_val = $columns[$cl]['column_value'] ?? '';

                                if ($cl === 0) :
                                ?>
                                    <div class="cell first-col table-2 medium text-secondary has-separator">
                                        <?php echo esc_html($col_val); ?>
                                    </div>
                                <?php
                                else :
                                    $separator_class = $cl < $columns_c - 1 ? 'has-separator-lighter' : '';
                                ?>
                                    <div class="cell table-2 <?php echo $separator_class; ?>">
                                        <?php echo esc_html($col_val); ?>
                                    </div>
                                <?php
                                endif;
                            endfor;
                            ?>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>