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
        <?php endif; 
        endif; ?>

        <?php
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

        /* $dimension_grid_parts_mobile = [];
        $dimension_grid_parts_desktop = [];

        $dimension_grid_parts_mobile[] = $dimension_mod_width;
        $dimension_grid_parts_desktop[] = str_replace('px', 'fr', $dimension_mod_width);

        foreach ($dimension_columns as $col) {
            $col_width = $col['width'] ?? '40px';
            $dimension_grid_parts_mobile[] = $col_width;
            $dimension_grid_parts_desktop[] = str_replace('px', 'fr', $col_width);
        }

        $dimension_grid_template_mobile = implode(' ', $dimension_grid_parts_mobile);
        $dimension_grid_template_desktop = implode(' ', $dimension_grid_parts_desktop); */
        ?>

        <div class="table-shell">
            <div class="table-scroll">
                <div class="fake-table dimension-table"
                    style="
                        --grid-mobile: <?php //echo esc_attr($dimension_grid_template_mobile); ?>;
                        --grid-desktop: <?php //echo esc_attr($dimension_grid_template_desktop); ?>;
                    ">

                    <?php
                    /*
                    |--------------------------------------------------------------------------
                    | HEADER
                    |--------------------------------------------------------------------------
                    */
                    $table_dimensions = get_field('table_dimensions');
                    $table_headings = $table_dimensions['headings'];
                    for($i = 0; $i < count($table_headings); $i++) {
                        $label = $table_headings[$i]['lable_title'];
                        if($i == 0) :
                    ?>
                            <div class="cell corner table-2 head-l1 has-separator">
                                <?php echo $label; ?>
                            </div>
                        <?php
                        else:
                            $separator_class = $i < count($table_headings) - 1 ? 'has-separator-lighter' : '';
                        ?>
                            <div class="cell head-l1 table-2 <?php echo $separator_class; ?>">
                                <?php echo $label; ?>
                            </div>
                    <?php
                        endif;
                    ?>
                        
                    <?php
                    }
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

                        <?php for ($i = 0; $i < count($table_headings); $i++) : ?>
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

                    <?php
                        $table_rows = $table_dimensions['rows'];
                        for ($tr = 0; $tr < count($table_rows); $tr++) :
                    ?>
                        <div class="table-row">
                            <?php
                            $col = $table_rows[$tr]['columns'];
                            $col_c = count($col);
                            for($cl = 0; $cl < $col_c; $cl++) :
                                $separator_class = $tr < count($table_rows) - 1 ? 'has-separator-lighter' : '';
                                $col_val = $col[$cl]['column_value'];
                                if($cl == 0) :
                                ?>
                                    <div class="cell first-col table-2 medium text-secondary has-separator">
                                        <?php echo $col_val; ?>
                                    </div>
                                <?php
                                else :
                                ?>
                                    <div class="cell table-2 <?php echo $separator_class; ?>">
                                        <?php echo $col_val; ?>
                                    </div>
                                <?php
                                endif;
                            endfor; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</section>