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
$anchor_alt_image = function_exists('get_field') ? get_field('immagine_alternativa', $term_key) : null;
$anchor_base_image = is_array($anchor_alt_image) && !empty($anchor_alt_image['ID']) ? $anchor_alt_image : $hero_image;
$anchor_base_image_id = is_array($anchor_base_image) && !empty($anchor_base_image['ID']) ? (int) $anchor_base_image['ID'] : 0;
$anchor_base_image_alt = is_array($anchor_base_image) && !empty($anchor_base_image['alt']) ? $anchor_base_image['alt'] : $term->name;

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

$technical_text_scroll = $get_acf_group('sezione_testo_animato');
$content_sections = [];
$acf_sections = function_exists('get_field') ? get_field('sections_content', $term_key) : [];
/* $acf_sections = [
    [
        'field' => 'caratteristiche',
        'id' => 'caratteristiche',
        'label' => __('Caratteristiche e funzionamento', 'filcar'),
    ],
    [
        'field' => 'criteri',
        'id' => 'criteri-di-scelta',
        'label' => __('Criteri di scelta', 'filcar'),
    ],
    [
        'field' => 'manutenzione',
        'id' => 'manutenzione-sicurezza',
        'label' => __('Manutenzione e sicurezza', 'filcar'),
    ],
    [
        'field' => 'applicazioni',
        'id' => 'applicazioni',
        'label' => __('Applicazioni', 'filcar'),
    ],
]; */

$acf_sections = is_array($acf_sections) ? $acf_sections : [];

foreach ($acf_sections as $section_config) {
    $section_title = $section_config['title'];
    $section_text = $section_config['txt'];
    $section_label = $section_config['title_index'];
    $section_id = str_replace(' ', '-', strtolower($section_label));
    $section_image = !empty($section_config['immagine_sezione']) && is_array($section_config['immagine_sezione']) ? $section_config['immagine_sezione'] : [];

    if (empty($section_title) && empty($section_text)) {
        continue;
    }

    $content_sections[] = array_merge($section_config, [
        'title' => $section_title,
        'text' => $section_text,
        'id' => $section_id,
        'label' => $section_label,
        'image' => $section_image,
    ]);
}

$anchor_section_images = [];

foreach ($content_sections as $section) {
    if (empty($section['image']['ID'])) {
        continue;
    }

    $anchor_section_images[$section['id']] = [
        'id' => (int) $section['image']['ID'],
        'alt' => !empty($section['image']['alt']) ? $section['image']['alt'] : $section['title'],
    ];
}

$has_anchor_section_images = !empty($anchor_section_images);

$faq_field = $get_acf_group('faqs');
$faq_image = !empty($faq_field['immagine_faq']) && is_array($faq_field['immagine_faq']) ? $faq_field['immagine_faq'] : [];
$faq_image_id = !empty($faq_image['ID']) ? (int) $faq_image['ID'] : 0;
$faq_image_alt = !empty($faq_image['alt']) ? $faq_image['alt'] : __('FAQ', 'filcar');
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

    <?php
    get_template_part('parts/technical-text-scroll', null, [
        'field_values' => $technical_text_scroll,
        'field_source' => $term_key,
        'block_id' => 'category-technical-text-scroll',
    ]);
    ?>

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

                        <?php if ($anchor_base_image_id || $has_anchor_section_images || $faq_image_id) : ?>
                            <div class="category-anchor-sections__image category-anchor-sections__image-stack respimg sp-mb-0 d-none d-lg-flex js-category-anchor-image-stack">
                                <?php if ($anchor_base_image_id) : ?>
                                    <figure class="category-anchor-sections__image-layer sp-mb-0 is-active" data-anchor-image-target="base">
                                        <?php
                                        echo wp_get_attachment_image($anchor_base_image_id, 'full', false, [
                                            'alt' => esc_attr($anchor_base_image_alt),
                                        ]);
                                        ?>
                                    </figure>
                                <?php endif; ?>

                                <?php foreach ($anchor_section_images as $anchor_image_id => $anchor_image) : ?>
                                    <figure class="category-anchor-sections__image-layer sp-mb-0<?php echo !$anchor_base_image_id && array_key_first($anchor_section_images) === $anchor_image_id ? ' is-active' : ''; ?>" data-anchor-image-target="#<?php echo esc_attr($anchor_image_id); ?>">
                                        <?php
                                        echo wp_get_attachment_image($anchor_image['id'], 'full', false, [
                                            'alt' => esc_attr($anchor_image['alt']),
                                        ]);
                                        ?>
                                    </figure>
                                <?php endforeach; ?>

                                <?php if ($faq_image_id) : ?>
                                    <figure class="category-anchor-sections__image-layer sp-mb-0<?php echo !$anchor_base_image_id && !$has_anchor_section_images ? ' is-active' : ''; ?>" data-anchor-image-target="#faq">
                                        <?php
                                        echo wp_get_attachment_image($faq_image_id, 'full', false, [
                                            'alt' => esc_attr($faq_image_alt),
                                        ]);
                                        ?>
                                    </figure>
                                <?php endif; ?>
                            </div>
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
                                    <h2 class="category-anchor-panel__title h2 light"><?php echo esc_html($section['title']); ?></h2>
                                <?php endif; ?>
                                <?php if (!empty($section['text'])) : ?>
                                    <div class="category-anchor-panel__body p-big fw-normal">
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

<style>
.category-anchor-sections__image-stack {
    position: relative;
}

.category-anchor-sections__image-layer {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.45s ease;
}

.category-anchor-sections__image-layer.is-active {
    opacity: 1;
}

.category-anchor-sections__image-layer img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (!('IntersectionObserver' in window)) return;

    const links = Array.from(document.querySelectorAll('.category-anchor-nav__link[href^="#"]'));
    const panels = Array.from(document.querySelectorAll('.js-category-anchor-panel'));
    const imageStack = document.querySelector('.js-category-anchor-image-stack');
    const imageLayers = imageStack ? Array.from(imageStack.querySelectorAll('[data-anchor-image-target]')) : [];

    if (!links.length || !panels.length) return;

    const setActive = function (target) {
        links.forEach(function (link) {
            link.classList.toggle('is-active', link.getAttribute('href') === target);
        });

        if (!imageLayers.length) return;

        const activeLayer = imageLayers.find(function (layer) {
            return layer.dataset.anchorImageTarget === target;
        }) || imageLayers.find(function (layer) {
            return layer.dataset.anchorImageTarget === 'base';
        });

        if (!activeLayer) return;

        imageLayers.forEach(function (layer) {
            layer.classList.toggle('is-active', layer === activeLayer);
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
