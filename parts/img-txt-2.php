<?php
$sections_block = get_field('sections_block');
$section_bg = get_field('section_bg');
$subtitle_cl = '';
$text_cl = '';
$btn_style = '';
switch($section_bg) {
    case 'bg-white':
        $subtitle_cl = 'text-secondary';
        $text_cl = 'text-primary';
        $btn_style = 'btn-secondary-1';
        break;
    case 'bg-primary':
        $subtitle_cl = 'text-secondary';
        $text_cl = 'text-white';
        $btn_style = 'btn-secondary-2';
        break;
    case 'bg-secondary':
        $subtitle_cl = 'text-white';
        $text_cl = 'text-white';
        $btn_style = 'btn-secondary-2';
        break;
    case 'bg-grey-200':
        $subtitle_cl = 'text-secondary';
        $text_cl = 'text-primary';
        $btn_style = 'btn-secondary-1';
        break;
}
if(!empty($sections_block)) {
    $sections_block_c = count($sections_block);
    for($i = 0; $i < $sections_block_c; $i++) {
        $img_position = $sections_block[$i]['img_position'];
        $img_block = $sections_block[$i]['img_block'];
        $subtitle_block = $sections_block[$i]['subtitle_block'];
        $title_block = $sections_block[$i]['title_block'];
        $txt_block = $sections_block[$i]['txt_block'];
        $cta_block = $sections_block[$i]['cta_block'];
        $class_section = '';
        $class_img_block = '';
        $class_text_block = '';
        if($img_position == 0){
            $class_section = '';
            $class_img_block = 'col-12 col-lg-6';
            $class_text_block = 'col-12 col-lg-5 offset-lg-1';
        }elseif($img_position == 1) {
            $class_section = 'flex-row-reverse';
            $class_img_block = 'col-12 col-lg-6 offset-lg-1';
            $class_text_block = 'col-12 col-lg-5';
        }
        if($sections_block_c > 1 && $sections_block_c == $i + 1) {
            $class_section_padding = 'sp-pt-11 sp-pb-6';
        }else{
            $class_section_padding = 'sp-pt-11 sp-pb-0';
        }
?>
        <section class="img-txt <?php echo $class_section_padding; ?> sp-lg-py-16 sp-sxl-py-23 <?php echo $section_bg; ?>">
            <div class="container-fluid">
                <div class="row align-items-center <?php echo $class_section; ?>">
                    <div class="<?php echo $class_img_block; ?>">
                        <figure class="respimg rounded overflow-hidden h-100 figure-img">
                            <?php
                            echo wp_get_attachment_image($img_block['ID'], 'full', false, ['alt' => $img_block['alt'] ? $img_block['alt'] : $title_block]);?>
                        </figure>
                    </div>
                    <div class="<?php echo $class_text_block; ?> sp-mt-7 sp-mb-0 sp-lg-my-7 txt-container">
                        <?php
                        if($subtitle_block) :
                        ?>
                        <div class="product-3 fw-normal <?php echo $subtitle_cl; ?>">
                            <?php echo $subtitle_block; ?>
                        </div>
                        <?php
                        endif;
                        ?>
                        <h2 class="h2 light <?php echo $text_cl; ?> sp-mt-5">
                            <?php echo $title_block; ?>
                        </h2>
                        <div class="regular<?php echo $text_cl; ?> sp-mt-5 mb-0-p">
                            <?php echo $txt_block; ?>
                        </div>
                        <?php if($cta_block) : ?>
                        <a class="btn <?php echo $btn_style; ?> sp-mt-5" href="<?php echo $cta_block['url']; ?>"><span><?php echo $cta_block['title']; ?><span class="icon-filcar-icon-arrow-upr"></span></span></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
?>