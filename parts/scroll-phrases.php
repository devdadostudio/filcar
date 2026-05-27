<?php
$phrases = get_field('phrases');
if(!empty($phrases)) {
    $phrases_c = count($phrases);
?>
    <div class="services-ticker-block sp-my-10 sp-sxl-my-14">
        <div class="stb_line_single stb_line_single_2 text-grey-800">
            <?php
            if($phrases_c > 0) {
                for($i = 0; $i < $phrases_c; $i++) {
                    $phrase = $phrases[$i];
                ?>
                    <div href="#" class="stb-item number-1 fw-medium">
                        <span><?php echo $phrase['txt']; ?></span>
                    </div>
                <?php
                }
                for($i = 0; $i < $phrases_c; $i++) {
                    $phrase = $phrases[$i];
                ?>
                    <div href="#" class="stb-item number-1 fw-medium">
                        <span><?php echo $phrase['txt']; ?></span>
                    </div>
                <?php
                }
                for($i = 0; $i < $phrases_c; $i++) {
                    $phrase = $phrases[$i];
                ?>
                    <div href="#" class="stb-item number-1 fw-medium">
                        <span><?php echo $phrase['txt']; ?></span>
                    </div>
                <?php
                }
                for($i = 0; $i < $phrases_c; $i++) {
                    $phrase = $phrases[$i];
                ?>
                    <div href="#" class="stb-item number-1 fw-medium">
                        <span><?php echo $phrase['txt']; ?></span>
                    </div>
                <?php
                }
                for($i = 0; $i < $phrases_c; $i++) {
                    $phrase = $phrases[$i];
                ?>
                    <div href="#" class="stb-item number-1 fw-medium">
                        <span><?php echo $phrase['txt']; ?></span>
                    </div>
                <?php
                }
                for($i = 0; $i < $phrases_c; $i++) {
                    $phrase = $phrases[$i];
                ?>
                    <div href="#" class="stb-item number-1 fw-medium">
                        <span><?php echo $phrase['txt']; ?></span>
                    </div>
                <?php
                }
            }
            ?>
        </div>
    </div>
<?php
}
?>