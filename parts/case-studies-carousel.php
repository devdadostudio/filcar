<?php
$args = wp_parse_args($args ?? [], [
    'term_id' => 0,
    'taxonomy' => 'categoria-caso-studio',
    'posts_per_page' => 3,
]);

$term_id = (int) $args['term_id'];
$taxonomy = sanitize_key($args['taxonomy']);
$posts_limit = max(1, (int) $args['posts_per_page']);
$term = $term_id ? get_term($term_id, $taxonomy) : null;
$block_id = $term instanceof WP_Term ? 'case-studies-carousel-' . $term->slug : 'case-studies-carousel';
$kicker = $term instanceof WP_Term ? strtoupper($term->name) : __('CASI STUDIO', 'filcar');
$title = $term instanceof WP_Term && $term->description ? wp_strip_all_tags($term->description) : __('La visione che diventa layout operativo', 'filcar');

$query_args = [
    'post_type' => 'caso-studio',
    'posts_per_page' => $posts_limit,
    'post_status' => 'publish',
    'ignore_sticky_posts' => true,
];

if ($term instanceof WP_Term) {
    $query_args['tax_query'] = [
        [
            'taxonomy' => $taxonomy,
            'field' => 'term_id',
            'terms' => $term_id,
        ],
    ];
}

$case_studies_query = new WP_Query($query_args);

if ($case_studies_query->have_posts()) :
?>
<section id="<?php echo esc_attr($block_id); ?>" class="case-studies-carousel bg-blog text-white overflow-hidden">
    <?php
    get_template_part('parts/breadcrumbs', null, [
        'variant' => 'dark',
        'layout' => 'inline',
        'class' => 'case-studies-carousel__breadcrumb',
        'inner_class' => 'p-small',
        'col_class' => 'col-12',
        'mobile_bg' => true,
        'items' => [
            ['label' => __('Home', 'filcar'), 'url' => home_url('/')],
            ['label' => $term instanceof WP_Term ? $term->name : __('Casi studio', 'filcar')],
        ],
    ]);
    ?>
    <div class="case-studies-carousel__head container-fluid">
        <div class="case-studies-carousel__kicker product-3 fw-semibold">
            <?php echo esc_html($kicker); ?>
        </div>
        <h1 class="case-studies-carousel__title mb-0 h0 extralight">
            <?php echo esc_html($title); ?>
        </h1>
    </div>

    <div class="case-studies-carousel__slider-wrap">
        <div class="case-studies-carousel__slider js-case-studies-carousel owl-carousel">
            <?php
            while ($case_studies_query->have_posts()) :
                $case_studies_query->the_post();
                get_template_part('parts/card/card-case-studies', 'extended', ['post_id' => get_the_ID()]);
            endwhile;
            ?>
        </div>
    </div>
</section>
<?php
endif;

wp_reset_postdata();
?>
