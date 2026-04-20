<?php
    $slides = get_field('slides');
    if($slides) :
        $slide_c = count($slides);
        if ($slide_c > 0) :
?>
            <section id="dettagli" class="js-section section-slider-text-ext section sp-py-8" data-anchor="dettagli">
                <div class="section-inner container-fluid">
                    <div class="subtitle-header sp-mb-5">
                        <h2 class="h6 text-secondary text-uppercase semibold">DETTAGLI</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-12">
                            <div class="single-slider-carousel-txt-ext owl-carousel">
                                <?php for($i = 0; $i < $slide_c; $i++) : ?>
                                    <div class="slider-item">
                                        <figure class="sp-mb-0 rounded-3 overflow-hidden position-relative">
                                            <?php
                                            echo wp_get_attachment_image($slides[$i]['img_slide']['ID'], 'slide-img-ext', false, ['class' => 'w-100']);
                                            ?>
                                        </figure>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                            <div class="position-relative sp-py-4 sp-md-py-12 sp-lg-py-5">
                                <?php for($i = 0; $i < $slide_c; $i++) : ?>
                                    <div class="text-slide-<?php echo $i; ?> <?php if($i == 0) echo 'active'; ?> w-100">
                                        <div class="ts-title h7 fw-light"><?php echo $slides[$i]['title_slide']; ?></div>
                                        <div class="ts-txt fw-light sp-mt-4"><?php echo $slides[$i]['txt_slide']; ?></div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <?php
        endif;
    endif; ?>