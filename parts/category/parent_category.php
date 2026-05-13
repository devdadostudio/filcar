<?php
$children = $args['children'];
$term_id = $args['term_id'];
$taxonomy = $args['taxonomy'];
?>
<main id="main-content-category" class="bg-grey-200">
    <?php
    get_template_part('parts/breadcrumbs', null, [
        'variant' => 'light',
        'layout' => 'bar',
        'class' => 'bg-grey-200 sp-py-3',
    ]);
    ?>
    <section class="section-category-header sp-py-9 sp-lg-py-15 sp-sxl-py-19">
        <div class="container-fluid">
            <div class="row align-items-end">
                <div class="col-12 col-lg-6">
                    <h2 class="product-3 fw-semibold">ATTREZZATURE OPERATIVE</h2>
                    <h1 class="h0 extralight">
                        <?php single_cat_title(); ?>
                    </h1>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="category-description p-big fw-light">
                        <?php echo category_description(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if(!empty($children)) :
        $children_c = count($children);
    ?>
    <section class="section-category-posts">
        <div class="container-fluid">
            <div class="row">
                <?php
                for($i = 0; $i < $children_c; $i++) {
                    $child = $children[$i];
                    get_template_part('parts/card/card', 'cat-prod', ['card_class' => 'col-6 col-lg-3', 'term_id' => $child->term_id, 'taxonomy' => $taxonomy]);
                }
                ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>
