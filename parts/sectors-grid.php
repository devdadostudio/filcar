<div class="sectors-grid sp-py-3 sp-lg-py-5 bg-grey-200">
    <div class="container-fluid">
        <div class="row sp-row-gap-4">
            <?php
            $sectors = get_field('sectors');
            if(!empty($sectors)) {
                foreach($sectors as $sector) :
                    get_template_part('parts/card/card-sector', null, ['sector_id' => $sector, 'class' => 'col-6 col-sxl-3', 'name_class' => 'h5', 'class_figure' => 'aspect-ratio-4x3']);
                endforeach;
            }
            ?>
        </div>
    </div>
</div>