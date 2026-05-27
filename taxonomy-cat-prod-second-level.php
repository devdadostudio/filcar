<?php
get_header();

$term = get_queried_object();

if (!$term || is_wp_error($term) || !($term instanceof WP_Term)) {
    get_footer();
    return;
}

$term_key = $term->taxonomy . '_' . $term->term_id;
$parent_term = !empty($term->parent) ? get_term($term->parent, $term->taxonomy) : null;

$hero_image = function_exists('get_field') ? get_field('img_cat', $term_key) : null;
$hero_image_id = is_array($hero_image) && !empty($hero_image['ID']) ? (int) $hero_image['ID'] : 0;
$hero_image_alt = is_array($hero_image) && !empty($hero_image['alt']) ? $hero_image['alt'] : $term->name;

$get_acf_group = function ($field_name) use ($term_key) {
    if (!function_exists('get_field')) {
        return [];
    }

    $field = get_field($field_name, $term_key);

    return is_array($field) ? $field : [];
};

$get_acf_text = function ($field, $key) {
    return is_array($field) && !empty($field[$key]) ? $field[$key] : '';
};

$content_sections = [];
$acf_sections = [
    [
        'field' => 'caratteristiche',
        'id' => 'caratteristiche',
        'label' => __('Caratteristiche e funzionamento', 'filcar'),
        'title_class' => 'h2 light',
        'body_class' => 'p-big',
    ],
    [
        'field' => 'criteri',
        'id' => 'criteri-di-scelta',
        'label' => __('Criteri di scelta', 'filcar'),
        'title_class' => 'h1 fw-normal',
        'body_class' => 'p-big fw-normal',
    ],
    [
        'field' => 'manutenzione',
        'id' => 'manutenzione-sicurezza',
        'label' => __('Manutenzione e sicurezza', 'filcar'),
        'title_class' => 'h1 fw-normal',
        'body_class' => 'p-big fw-normal',
    ],
    [
        'field' => 'applicazioni',
        'id' => 'applicazioni',
        'label' => __('Applicazioni', 'filcar'),
        'title_class' => 'h1 fw-normal',
        'body_class' => 'p-big fw-normal',
    ],
];

foreach ($acf_sections as $section_config) {
    $section_field = $get_acf_group($section_config['field']);
    $section_title = $get_acf_text($section_field, 'titolo');
    $section_text = $get_acf_text($section_field, 'testo');

    if (empty($section_title) && empty($section_text)) {
        continue;
    }

    $content_sections[] = array_merge($section_config, [
        'title' => $section_title,
        'text' => $section_text,
    ]);
}

$faq_field = $get_acf_group('faqs');
$faq_items = !empty($faq_field['blocco_faq']) && is_array($faq_field['blocco_faq']) ? array_values(array_filter($faq_field['blocco_faq'], function ($faq_item) {
    return is_array($faq_item) && !empty($faq_item['titolo']) && !empty($faq_item['testo']);
})) : [];

$anchor_items = [
    [
        'url' => '#prodotti',
        'label' => __('Prodotti', 'filcar'),
    ],
];

foreach ($content_sections as $section) {
    $anchor_items[] = [
        'url' => '#' . $section['id'],
        'label' => $section['label'],
    ];
}

if (!empty($faq_items)) {
    $anchor_items[] = [
        'url' => '#faq',
        'label' => __('FAQ', 'filcar'),
    ];
}
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
                    <div class="product-hero__content category-second-hero__content text-grey-500">
                        <?php if ($parent_term && !is_wp_error($parent_term)) : ?>
                            <div class="product-3 fw-normal text-uppercase sp-mb-3 text-primary">
                                <?php echo esc_html($parent_term->name); ?>
                            </div>
                        <?php endif; ?>
                        <h1 class="h1 extralight sp-mb-3 sp-sxl-mb-4 sp-uxl-mb-5 text-primary">
                            <?php echo esc_html($term->name); ?>
                        </h1>
                        <?php if (!empty($term->description)) : ?>
                            <div class="p-big regular">
                                <?php echo wp_kses_post(wpautop($term->description)); ?>
                            </div>
                        <?php endif; ?>
                        <div class="cta-content">
                            <a href="#prodotti" class="btn btn-outline-primary">Prodotti <i class="icon icon-filcar-icon-arrow-downr"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7 offset-lg-1 order-1 order-lg-2 sp-mb-8 sp-lg-mb-0 category-second-hero__visual-col">
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
                        get_template_part('parts/category/anchor-nav', null, [
                            'items' => $anchor_items,
                            'classes' => 'category-anchor-nav--hero d-none d-lg-flex',
                            'aria_label' => __('Categorie prodotto', 'filcar'),
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="prodotti" class="category-products-placeholder js-category-anchor-panel sp-pt-4 sp-lg-pt-7 sp-sxl-pt-10 sp-pb-3 sp-lg-pb-8 sp-sxl-pb-15 sp-uxl-pb-19" data-anchor-target="#prodotti">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="title-products-grid">
                        <div class="title-products-grid__inner">
                            <span class="d-block number-2 fw-normal text-grey-300">01</span>
                            <h2 class="subtitle-1 fw-normal text-primary text-uppercase sp-pt-2 mb-0">Prodotti</h2>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ( have_posts() ) : ?>
                <div class="category-products-grid row sp-pt-5 sp-lg-pt-10 sp-sxl-pt-12 sp-uxl-pt-10 sp-row-gap-3 sp-lg-row-gap-4">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part('parts/card/card', 'product', ['card_class' => 'col-6 col-lg-3']); ?>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <div class="row sp-pt-5 sp-lg-pt-10 sp-sxl-pt-12 sp-uxl-pt-10">
                    <div class="col-12">
                        <p class="p-big fw-normal text-primary mb-0">
                            <?php esc_html_e('Non ci sono prodotti in questa categoria', 'filcar'); ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="category-anchor-sections js-category-anchor-sections">
        <div class="container-fluid">
            <div class="row">
                <aside class="col-12 col-lg-4 category-anchor-sections__aside">
                    <div class="category-anchor-sections__aside-inner">
                        <?php
                        get_template_part('parts/category/anchor-nav', null, [
                            'items' => $anchor_items,
                            'classes' => 'category-anchor-nav--content',
                            'aria_label' => __('Navigazione contenuti categoria', 'filcar'),
                        ]);
                        ?>

                        <?php if ($hero_image_id) : ?>
                            <figure class="category-anchor-sections__image respimg sp-mb-0 d-none d-lg-flex">
                                <?php
                                echo wp_get_attachment_image($hero_image_id, 'full', false, [
                                    'alt' => esc_attr($hero_image_alt),
                                ]);
                                ?>
                            </figure>
                        <?php endif; ?>
                    </div>
                </aside>

                <div class="col-12 col-lg-6 offset-lg-1 category-anchor-sections__content">
                    <?php if (empty($content_sections) && empty($faq_items)) : ?>
                        <div class="category-anchor-panel">
                            <div class="category-anchor-panel__body p-big fw-normal">
                                <?php esc_html_e('La categoria non ha al momento contenuti', 'filcar'); ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <?php foreach ($content_sections as $section_index => $section) : ?>
                            <article id="<?php echo esc_attr($section['id']); ?>" class="category-anchor-panel js-category-anchor-panel" data-anchor-target="#<?php echo esc_attr($section['id']); ?>">
                                <div class="category-anchor-panel__number number-3"><?php echo esc_html(str_pad((string) ($section_index + 2), 2, '0', STR_PAD_LEFT)); ?></div>
                                <?php if (!empty($section['title'])) : ?>
                                    <h2 class="category-anchor-panel__title <?php echo esc_attr($section['title_class']); ?>"><?php echo esc_html($section['title']); ?></h2>
                                <?php endif; ?>
                                <?php if (!empty($section['text'])) : ?>
                                    <div class="category-anchor-panel__body <?php echo esc_attr($section['body_class']); ?>">
                                        <?php echo wp_kses_post($section['text']); ?>
                                    </div>
                                <?php endif; ?>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (!empty($faq_items)) : ?>
                        <?php $faq_number = count($content_sections) + 2; ?>
                        <article id="faq" class="category-anchor-panel category-anchor-panel--faq js-category-anchor-panel" data-anchor-target="#faq">
                            <div class="category-anchor-panel__number number-3"><?php echo esc_html(str_pad((string) $faq_number, 2, '0', STR_PAD_LEFT)); ?></div>
                            <h2 class="category-anchor-panel__title h1 fw-normal">FAQ</h2>
                            <div class="category-anchor-faq accordion" id="categoryAnchorFaqAccordion">
                                <?php foreach ($faq_items as $faq_index => $faq_item) : ?>
                                    <?php
                                    $faq_heading_id = 'categoryAnchorFaqHeading' . $faq_index;
                                    $faq_collapse_id = 'categoryAnchorFaqCollapse' . $faq_index;
                                    ?>
                                    <div class="accordion-item text-white">
                                        <div class="accordion-header" id="<?php echo esc_attr($faq_heading_id); ?>">
                                            <div class="accordion-button collapsed mb-0-p h5 sp-gap-2 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($faq_collapse_id); ?>" aria-expanded="false" aria-controls="<?php echo esc_attr($faq_collapse_id); ?>">
                                                <?php echo esc_html($faq_item['titolo']); ?>
                                            </div>
                                        </div>
                                        <div id="<?php echo esc_attr($faq_collapse_id); ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo esc_attr($faq_heading_id); ?>" data-bs-parent="#categoryAnchorFaqAccordion">
                                            <div class="accordion-body text-white">
                                                <?php echo wp_kses_post($faq_item['testo']); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </article>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (!('IntersectionObserver' in window)) return;

    const links = Array.from(document.querySelectorAll('.category-anchor-nav__link[href^="#"]'));
    const panels = Array.from(document.querySelectorAll('.js-category-anchor-panel'));

    if (!links.length || !panels.length) return;

    const setActive = function (target) {
        links.forEach(function (link) {
            link.classList.toggle('is-active', link.getAttribute('href') === target);
        });
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                setActive(entry.target.dataset.anchorTarget || ('#' + entry.target.id));
            }
        });
    }, {
        rootMargin: '-35% 0px -50% 0px',
        threshold: 0.01
    });

    panels.forEach(function (panel) {
        observer.observe(panel);
    });
});
</script>

<?php
get_footer(null, ['footer-color' => 'bg-grey-500']);
