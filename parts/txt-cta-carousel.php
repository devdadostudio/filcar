<?php
$section_bg = get_field('section_bg');
$subtitle_block = get_field('subtitle_block');
$title_block = get_field('title_block');
$title_type = get_field('title_type');
$txt_block = get_field('txt_block');
$txt_type = get_field('txt_type');
$cta_block = get_field('cta_block');
$type_cards = get_field('type_cards');
$items = array();
if($type_cards == 'sectors') {
    $items = get_field('sectors');
}elseif($type_cards == 'case-studies') {
    $items = get_field('case_studies');
}elseif($type_cards == 'blog') {
    $items = get_field('posts');
}
if(!empty($items)) {
    $items_c = count($items);
?>
    <section class="txt-cta-carousel sp-py-11 sp-lg-py-16 sp-sxl-py-23 overflow-hidden <?php echo $section_bg; ?>">
        <div class="container-fluid">
            <!-- <div class="row <?php //if($type_cards == 'case-studies') : ?>align-items-center<?php //endif; ?>"> -->
            <div class="row">
                <div class="<?php echo $section_bg; ?> col-12 col-lg-4 sp-py-0 sp-lg-py-7 txt-container d-flex flex-column position-relative z-1">
                    <div class="d-flex flex-column txt-cta-carousel-inner <?php if($type_cards == 'case-studies') : ?>justify-content-center<?php endif; ?>">
                        <div>
                            <?php
                            if($subtitle_block) :
                            ?>
                            <div class="product-3 fw-normal text-secondary sp-mb-3">
                                <?php echo $subtitle_block; ?>
                            </div>
                            <?php
                            endif;
                            if($title_block) :
                            ?>
                            <div class="<?php echo $title_type ? 'h2' : 'h3'; ?> fw-light text-primary mb-0-p sp-mb-5">
                                <?php echo $title_block; ?>
                            </div>
                            <?php
                            endif;
                            if($txt_block) :
                            ?>
                            <div class="<?php echo $txt_type ? 'h5 fw-light' : 'fw-normal'; ?> text-primary mb-0-p sp-lh-130">
                                <?php echo $txt_block; ?>
                            </div>
                            <?php
                            endif;
                            ?>
                        </div>
                        <div>
                            <?php if($cta_block) : ?>
                            <a class="btn btn-secondary-1 <?php if($txt_block) : ?>sp-mt-4 sp-lg-mt-5 sp-sxl-mt-8<?php endif; ?> btn-100-mb" href="<?php echo $cta_block['url']; ?>"><span><?php echo $cta_block['title']; ?><span class="icon-filcar-icon-arrow-upr"></span></span></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                </div>
                <?php if($items_c > 0) : ?>
                    <div class="col-12 col-lg-8 position-relative z-0 sp-mt-4 sp-lg-mt-0">
                        <div class="owl-carousel carousel-cards <?php echo $type_cards == 'case-studies' ? 'case-studies' : ''; echo $type_cards == 'blog' ? 'blog-posts' : ''; ?>">
                            <?php
                            for($i = 0; $i < $items_c; $i++) :
                                if($type_cards == 'sectors') :
                                    get_template_part('parts/card/card-sector', null, ['sector_id' => $items[$i]->ID, 'class' => '', 'name_class' => 'h3', 'class_figure' => 'aspect-ratio-1x1']);
                                elseif($type_cards == 'case-studies') :
                                    get_template_part('parts/card/card-case-study', null, ['case_study_id' => $items[$i]->ID]);
                                elseif($type_cards == 'blog') :
                                    get_template_part('parts/card/card-post', null, ['post_id' => $items[$i]->ID]);
                                endif;
                            endfor; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php
}
?>
<script>
    jQuery(document).ready(function($) {
        setTimeout(() => {
            jQuery('.txt-cta-carousel .case-studies.carousel-cards .card-post .p-bigger').verticalTextAligner();
            jQuery('.txt-cta-carousel .blog-posts.carousel-cards .card-post .p-big').verticalTextAligner();
        }, 500);
    });
</script>