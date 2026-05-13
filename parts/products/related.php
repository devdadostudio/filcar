<?php
$related = get_field('related');
$related_c = count($related);
if($related_c > 0) :
?>
    <section id="correlati" class="section js-section sp-py-6 sp-lg-py-8" data-anchor="correlati">
        <div class="section-inner container-fluid">
            <div class="subtitle-header sp-mb-5">
                <h2 class="h6 text-secondary text-uppercase semibold">Correlati</h2>
            </div>
            <div class="row sp-row-gap-4">
                <?php
                for($i = 0; $i < $related_c; $i++) :
                    $prod_id = $related[$i];
                    get_template_part('parts/card/card', 'product', ['card_class' => 'col-6 col-xl-3']);
                endfor; ?>
            </div>
        </div>
    </section>
<?php endif; ?>