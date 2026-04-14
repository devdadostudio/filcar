<?php
$slides = get_field('slide');
if(!empty($slides)){
    $slides_c = count($slides);
}
?>
<!-- Hero Section -->
<section class="flc-hero-section">
    <div class="row">
        <div class="col-12">
            <div class="<?php echo is_front_page() ? 'home-slider' : ''; ?> flc-hero hero-slider owl-carousel <?php echo is_front_page() ? 'h-80vh' : ''; ?>">
                <?php for($i = 0; $i < $slides_c; $i++){
                    $slide = $slides[$i];
                    $slide_type = $slide['slide_type'];
                    $slide_label = $slide['label'];
                    $slide_title = $slide['title'];
                    $slide_text = $slide['txt'];
                ?>
                    <div class="hero-item h-100 sp-pt-0 sp-llg-pt-20 d-flex flex-column">
                        <?php
                            if($slide_type == 'img'){
                        ?>
                            <figure class="respimg position-absolute w-100 h-100 top-0 left-0 figure-hero">
                                <?php
                                    echo wp_get_attachment_image(
                                        $slide['img'],
                                        'full',
                                        false,
                                        array(
                                            'class' => 'z-0 hero-img',
                                            'alt' => $slide_title,
                                            'srcset' => wp_get_attachment_image_url($slide['img'], 'hero-1536').' 1536w,'.
                                                wp_get_attachment_image_url($slide['img'], 'hero-1024').' 1024w,'.
                                                wp_get_attachment_image_url($slide['img'], 'hero-768').' 768w,'.
                                                wp_get_attachment_image_url($slide['img'], 'hero-400').' 400w',
                                            'sizes' => '(max-width: 400px) 400px, (max-width: 768px) 768px, (max-width: 1024px) 1024px, 1536px'
                                        )
                                    );
                                ?>
                            </figure>
                        <?php 
                        }elseif($slide_type == 'video'){
                        ?>
                            <figure class="respimg position-absolute w-100 h-100 top-0 left-0 figure-hero w-100 h-100">
                                <video class="z-0" src="<?php echo $slide['video']['url']; ?>" autoplay muted loop playsinline></video>
                            </figure>
                        <?php
                        }
                        ?>
                        <div class="container mt-auto mb-auto z-2 title-block sp-pt-5 sp-llg-pt-0">
                            <div class="row">
                                <div class="col-12 col-md-9 col-llg-6">
                                    <?php
                                    if($slide_label){
                                    ?>
                                        <h3 class="h4 label-primary sp-mb-3 justify-content-center text-primary position-relative"><?php echo $slide_label; ?></h3>
                                    <?php
                                    }
                                    if($slide_title){
                                        if($i == 0){
                                            $tag_type= 'h1';
                                        }else{
                                            $tag_type= 'h2';
                                        }
                                    ?>
                                        <<?php echo $tag_type;?> class="h1 mt-0 sp-mb-6 sp-md-mb-5 <?php if(is_front_page()){echo 'sp-llg-mb-0';}else{echo 'sp-llg-mb-10 sp-sxl-mb-13';} ?> position-relative text-white text-uppercase"><?php echo $slide_title; ?></<?php echo $tag_type;?>>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        if($slide_text){
                        ?>
                            <div class="bg-black-50 text-white sp-py-8 mt-auto z-2 hero-text">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 col-md-8 col-llg-6 mb-0-p h4 fw-normal">
                                            <?php echo $slide_text; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php  
                        }
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section -->