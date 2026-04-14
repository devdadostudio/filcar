<?php
$faq = get_field('faq');
?>
<section class="accordion sp-py-9 sp-md-py-11">
    <?php
    $heading_id  = 'faqHeading-1';
    $collapse_id = 'faqCollapse-1';
    ?>
    <div class="container">
        <div class="row sp-gap-6 sp-sxl-gap-8">
            <?php
            if(!empty($faq)){
                $faq_c = count($faq);
                for($i = 0; $i < $faq_c; $i++){
                    $faq_item = $faq[$i];
                    $faq_title = $faq_item['title'];
                    $faq_questions = $faq_item['questions'];
                    ?>
                    <div class="col-12 col-llg-10 offset-llg-1">
                        <?php
                        if($faq_title){
                        ?>
                            <h2 class="text-primary h3 text-uppercase sp-mb-0"><?php echo $faq_title; ?></h2>
                        <?php
                        }
                        if(!empty($faq_questions)){
                            $faq_questions_c = count($faq_questions);
                        ?>
                            <div>
                                <?php
                                for($j = 0; $j < $faq_questions_c; $j++){
                                    $heading_id  = 'faqHeading-' . $i .'-'. $j;
                                    $collapse_id = 'faqCollapse-' . $i .'-'. $j;
                                    $q = $faq_questions[$j];
                                    $q_question = $q['question'];
                                    $q_answer = $q['answer'];
                                ?>
                                <div class="accordion-item sp-py-4 sp-sxl-py-5">
                                    <h2 class="accordion-header" id="<?php echo esc_attr( $heading_id ); ?>">
                                        <button class="accordion-button collapsed h4 sp-py-0 sp-mb-0 fw-bold"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#<?php echo esc_attr( $collapse_id ); ?>"
                                                aria-expanded="false"
                                                aria-controls="<?php echo esc_attr( $collapse_id ); ?>">
                                            <?php
                                            echo $q_question;
                                            ?>
                                        </button>
                                    </h2>

                                    <div id="<?php echo esc_attr( $collapse_id ); ?>"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="<?php echo esc_attr( $heading_id ); ?>"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body heading-5 sp-mt-3">
                                            <?php
                                            echo $q_answer;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>