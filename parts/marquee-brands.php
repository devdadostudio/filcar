<?php
$brands_logos = get_field('brands_logos');
if(!empty($brands_logos)) {
    $brands_logos_c = count($brands_logos);
?>
    <div class="services-ticker-block sp-my-10">
        <div class="stb_line_single stb_line_single_1">
            <?php
            for($i = 0; $i < $brands_logos_c; $i++) {
                $brand_logo = $brands_logos[$i];
                //print_r($brand_logo);
            ?>
                <div href="#" class="stb-item">
                    <?php
                    echo wp_get_attachment_image($brand_logo['ID'], 'full', false, ['class' => '']);
                    ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
<?php } ?>
