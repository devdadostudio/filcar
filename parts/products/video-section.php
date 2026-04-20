<?php
  $video = get_field('video');
  $video_desc = get_field('video_desc');
?>
<section class="bg-primary d-flex align-items-center sp-py-10">
    <div class="container-fluid position-relative sp-px-0">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-12">
                <?php if ($video) : ?>
                <figure class="respimg sp-mb-0 aspect-ratio-16x7 rounded-3 overflow-hidden position-relative">
                    <video>
                        <source src="<?php echo $video['url']; ?>" type="<?php echo $video['mime_type']; ?>">
                        Your browser does not support the video tag.
                    </video>
                    <div class="video-overlay position-absolute w-100 h-100 top-0 left-0 d-flex align-items-center justify-content-center">
                        <div class="custom-play-button"><img src="<?php echo get_template_directory_uri(); ?>/img/play.svg" alt="play button"></div>
                    </div>
                </figure>
                <?php endif;
                if ($video_desc) :?>
                <div class="sp-mb-0 sp-mt-1 sp-md-mt-3 h5 fw-light text-white">
                    <?php echo $video_desc; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>