<?php
$brands_logos = get_field('brands_logos');
if(!empty($brands_logos)) {
    $brands_logos_c = count($brands_logos);
    $title = get_field('title');
    $txt = get_field('txt');
    if(!empty($title) || !empty($txt)) {
?>
    <div class="services-title-txt-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6 offset-lg-3">
                    <?php if($title){ ?>
                        <h2 class="h3 sp-mb-0 text-center"><?php echo $title; ?></h2>
                    <?php
                    }
                    if($txt){ ?>
                        <div class="text-center sp-mt-4"><?php echo $txt; ?></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php
    }
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
