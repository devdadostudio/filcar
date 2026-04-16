<?php
    $slides = get_field('slides');
    $slide_c = count($slides);
    if ($slide_c > 0) :
?>
    <section class="bg-primary d-flex align-items-center sp-py-18 overflow-hidden slider-txt">
        <div class="container-fluid position-relative">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-12 sp-mt-5">
                    <div class="carousel-text-2 owl-carousel">
                        <?php for($i = 0; $i < $slide_c; $i++) : ?>
                            <div class="">
                                <figure class="respimg sp-mb-0 aspect-ratio-1x1 rounded-3 overflow-hidden position-relative bg-white">
                                    <img src="<?php echo $slides[$i]['img']['url']; ?>" alt="<?php if($slides[$i]['img']['alt']) echo $slides[$i]['img']['alt']; else echo strip_tags($slides[$i]['txt_under_img']); ?>" class="w-100">
                                </figure>
                                <div class="fw-medium sp-mt-2 sp-md-mt-4 text-white"><?php echo $slides[$i]['txt_under_img']; ?></div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>