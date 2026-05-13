<?php
$section_bg = get_field('section_bg');
$img = get_field('img');
$faqs = get_field('faq');
$text_cl = '';
switch($section_bg) {
    case 'bg-white':
        $text_cl = 'text-primary';
        break;
    case 'bg-primary':
        $text_cl = 'text-white';
        break;
    case 'bg-secondary':
        $text_cl = 'text-white';
        break;
}
?>
<section id="faq" class="section <?php echo $section_bg; ?> sp-py-12 sp-lg-pb-23" data-anchor="faq">
    <div class="container-fluid">
        <div class="row">
            <div class="<?php if($img) echo 'col-lg-7 offset-lg-5'; ?> col-12 <?php echo $text_cl; ?>">
                <h2 class="h2 fw-light sp-mb-5">FAQ</h2>
            </div>
        </div>
        <div class="row">
            <?php if ($img) : ?>
            <div class="col-12 col-lg-4">
                <figure class="w-100">        
                    <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" class="rounded overflow-hidden w-100">
                </figure>
            </div>
            <?php endif; ?>
            <div class="<?php if($img) echo 'col-lg-7 offset-lg-1'; ?> col-12">
                <div class="accordion" id="faqAccordion">
                    <?php
                    if ($faqs) :
                        foreach ($faqs as $index => $faq) :
                            $question = $faq['title'];
                            $answer = $faq['txt'];
                            ?>
                            <div class="accordion-item <?php echo $text_cl; ?>">
                                <div class="accordion-header" id="heading<?php echo $index; ?>">
                                    <div class="accordion-button collapsed mb-0-p h5 sp-gap-2 <?php echo $text_cl; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse<?php echo $index; ?>">
                                        <?php echo $question; ?>
                                    </div>
                                </div>
                                <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $index; ?>" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body <?php echo $text_cl; ?>">
                                        <?php echo wp_kses_post($answer); ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>