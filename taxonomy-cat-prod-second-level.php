<?php
get_header();

$term = get_queried_object();

if (!$term || is_wp_error($term) || !($term instanceof WP_Term)) {
    get_footer();
    return;
}

$term_key = $term->taxonomy . '_' . $term->term_id;
$parent_term = !empty($term->parent) ? get_term($term->parent, $term->taxonomy) : null;
$children = get_terms([
    'taxonomy'   => $term->taxonomy,
    'parent'     => $term->term_id,
    'hide_empty' => false,
]);

if (is_wp_error($children)) {
    $children = [];
}

$products_query = new WP_Query([
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => [
        [
            'taxonomy' => $term->taxonomy,
            'field' => 'term_id',
            'terms' => $term->term_id,
            'include_children' => false,
        ],
    ],
]);

$has_products_section = !empty($children) || $products_query->have_posts();
$anchor_items = [
    [
        'url' => '#prodotti',
        'label' => __('Prodotti', 'filcar'),
    ],
    [
        'url' => '#caratteristiche',
        'label' => __('Caratteristiche e funzionamento', 'filcar'),
    ],
    [
        'url' => '#criteri-di-scelta',
        'label' => __('Criteri di scelta', 'filcar'),
    ],
    [
        'url' => '#manutenzione-sicurezza',
        'label' => __('Manutenzione e sicurezza', 'filcar'),
    ],
    [
        'url' => '#applicazioni',
        'label' => __('Applicazioni', 'filcar'),
    ],
    [
        'url' => '#faq',
        'label' => __('FAQ', 'filcar'),
    ],
];

$hero_image = function_exists('get_field') ? get_field('img_cat', $term_key) : null;
$hero_image_id = is_array($hero_image) && !empty($hero_image['ID']) ? (int) $hero_image['ID'] : 0;
$hero_image_alt = is_array($hero_image) && !empty($hero_image['alt']) ? $hero_image['alt'] : $term->name;
?>

<main id="main-content-category" class="bg-grey-200">
    <section class="position-relative section-hero-product section-hero-cat-prod-second d-flex align-items-center">
        <?php
        get_template_part('parts/breadcrumbs', null, [
            'variant' => 'light',
            'layout' => 'overlay',
            'class' => 'product-hero__breadcrumb category-second-hero__breadcrumb',
            'mobile_bg' => true,
        ]);
        ?>

        <div class="container-fluid-left-llg position-relative text-container category-second-hero__inner">
            <div class="row align-items-center">
                <div class="col-12 col-lg-4 order-2 order-lg-1">
                    <div class="product-hero__content text-grey-500">
                        <?php if ($parent_term && !is_wp_error($parent_term)) : ?>
                            <div class="product-3 fw-normal text-uppercase sp-mb-3">
                                <?php echo esc_html($parent_term->name); ?>
                            </div>
                        <?php endif; ?>
                        <h1 class="h1 fw-normal sp-mb-3 sp-sxl-mb-4 sp-uxl-mb-5">
                            <?php echo esc_html($term->name); ?>
                        </h1>
                        <?php if (!empty($term->description)) : ?>
                            <div class="p-big fw-normal">
                                <?php echo wp_kses_post(wpautop($term->description)); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 col-lg-7 offset-lg-1 order-1 order-lg-2 sp-mb-8 sp-lg-mb-0">
                    <div class="category-second-hero__visual">
                        <figure class="category-second-hero__image respimg sp-mb-0">
                            <?php
                            if ($hero_image_id) {
                                echo wp_get_attachment_image($hero_image_id, 'full', false, [
                                    'alt' => esc_attr($hero_image_alt),
                                ]);
                            } else {
                                echo '<img src="https://placehold.co/900x900" alt="' . esc_attr($term->name) . '">';
                            }
                            ?>
                        </figure>

                        <?php
                        if (!empty($anchor_items)) {
                            get_template_part('parts/category/anchor-nav', null, [
                                'items' => $anchor_items,
                                'classes' => 'category-anchor-nav--hero d-none d-lg-flex',
                                'aria_label' => __('Categorie prodotto', 'filcar'),
                            ]);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if ($has_products_section) : ?>
        <section id="prodotti" class="section-category-posts sp-pt-12 sp-lg-pt-18 sp-pb-0 sp-lg-pb-4 sp-sxl-pb-12">
            <div class="container-fluid">
                <div class="row sp-lg-row-gap-4 sp-row-gap-3">
                    <?php if (!empty($children)) : ?>
                        <?php foreach ($children as $child) : ?>
                            <?php
                            get_template_part('parts/card/card', 'cat-prod', [
                                'card_class' => 'col-6 col-lg-3',
                                'term_id' => $child->term_id,
                                'taxonomy' => $term->taxonomy,
                            ]);
                            ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <?php while ($products_query->have_posts()) :
                            $products_query->the_post();
                            ?>
                            <?php
                            get_template_part('parts/card/card', 'product', [
                                'card_class' => 'col-6 col-lg-3',
                            ]);
                            ?>
                        <?php endwhile;
                        wp_reset_postdata();
                        ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php
get_footer();
