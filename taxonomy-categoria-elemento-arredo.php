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
$is_linea = function_exists('get_field') ? (bool) get_field('linea', $term_key) : false;

$term_value_has_content = static function ($value) use (&$term_value_has_content) {
    if (is_array($value)) {
        if (!empty($value['ID']) || !empty($value['url'])) {
            return true;
        }

        foreach ($value as $item) {
            if ($term_value_has_content($item)) {
                return true;
            }
        }

        return false;
    }

    if (is_string($value)) {
        return trim($value) !== '';
    }

    return $value !== null && $value !== false && $value !== '';
};

$line_block_content_fields = [
    'hero_image_hotspots' => [
        'desktop_image',
        'mobile_image',
        'kicker',
        'logo_icon',
        'title',
        'text',
        'points',
    ],
    'carousel_highlights' => [
        'items',
    ],
    'technical_text_scroll_block' => [
        'technical_text_scroll',
    ],
    'arredo_text_images_card' => [
        'logo_icon',
        'title',
        'text',
        'image_left',
        'image_main',
        'link_card',
    ],
    'progettazione_png_sequence_nav' => [
        'floating_cta',
        'intro_label',
        'intro_title',
        'intro_text',
        'fullscreen_intro',
        'sequence_points',
        'ergonomia_title',
        'ergonomia_text',
        'ergonomia_slides',
        'elementi_title',
        'elementi_text',
    ],
    'catalogs_launch' => [
        'title',
        'txt',
        'cta',
        'img',
    ],
];

$line_block_has_content = static function ($values, $group_name) use ($line_block_content_fields, $term_value_has_content) {
    $fields = $line_block_content_fields[$group_name] ?? array_keys($values);

    foreach ($fields as $field_name) {
        if (array_key_exists($field_name, $values) && $term_value_has_content($values[$field_name])) {
            return true;
        }
    }

    return false;
};

$render_line_block = static function ($slug, $group_name, $block_id) use ($term, $term_key, $line_block_has_content, $term_value_has_content) {
    $values = function_exists('get_field') ? get_field($group_name, $term_key) : [];
    $values = is_array($values) ? $values : [];
    $clone_key = $group_name . '_clone';

    if (!empty($values[$clone_key]) && is_array($values[$clone_key])) {
        $values = array_merge($values[$clone_key], $values);
    }

    if ($group_name === 'technical_text_scroll_block' && !$term_value_has_content($values['technical_text_scroll'] ?? null)) {
        $legacy_content = function_exists('get_field') ? get_field('technical_text_scroll', $term_key) : null;

        if (is_array($legacy_content) && $term_value_has_content($legacy_content)) {
            $values['technical_text_scroll'] = $legacy_content;
        }

        $legacy_section_bg = function_exists('get_field') ? get_field('section_bg', $term_key) : null;

        if ($legacy_section_bg !== null && $legacy_section_bg !== false && $legacy_section_bg !== '') {
            $values['section_bg'] = $legacy_section_bg;
        }
    }

    if ($group_name === 'progettazione_png_sequence_nav') {
        $current_frames_folder = trim((string) ($values['frames_folder'] ?? ''));
        $default_frames_folder = 'assets/img/progettazione-sequence';
        $should_use_term_folder = $current_frames_folder === '' || $current_frames_folder === $default_frames_folder;

        if ($should_use_term_folder) {
            $term_frames_folders = [
                'assets/sequenza-' . $term->slug,
                'assets/img/sequenza-' . $term->slug,
                'assets/img/progettazione-sequence-' . $term->slug,
            ];

            foreach ($term_frames_folders as $term_frames_folder) {
                if (is_dir(trailingslashit(get_template_directory()) . $term_frames_folder)) {
                    $values['frames_folder'] = $term_frames_folder;
                    break;
                }
            }
        }
    }

    if (!$line_block_has_content($values, $group_name)) {
        return;
    }

    get_template_part('parts/' . $slug, null, [
        'block_id' => $block_id,
        'field_source' => $term_key,
        'field_values' => $values,
    ]);
};
?>

<main id="main-content-category" class="bg-primary">
    <?php if ($is_linea) : ?>
        <?php
        $render_line_block('hero-image-hotspots', 'hero_image_hotspots', 'linea-' . $term->term_id . '-hero');
        $render_line_block('technical-text-scroll', 'technical_text_scroll_block', 'linea-' . $term->term_id . '-technical-text');
        $render_line_block('arredo-text-images-card', 'arredo_text_images_card', 'linea-' . $term->term_id . '-arredo');
        $render_line_block('carousel-highlights', 'carousel_highlights', 'linea-' . $term->term_id . '-highlights');
        $render_line_block('progettazione-png-sequence-nav', 'progettazione_png_sequence_nav', 'linea-' . $term->term_id . '-progettazione');
        $render_line_block('catalogs-launch', 'catalogs_launch', 'linea-' . $term->term_id . '-cataloghi');
        ?>
    <?php else : ?>
    <section class="position-relative h-74vh-header-desk overflow-hidden d-flex flex-column header-tax-category">
        <?php
        get_template_part('parts/breadcrumbs', null, [
            'variant' => 'light',
            'layout' => 'overlay',
            'class' => 'product-hero__breadcrumb category-second-hero__breadcrumb',
            'mobile_bg' => true,
        ]);
        ?>

        <div class="container-fluid-left-llg position-relative text-container h-100 flex-grow-1 d-flex flex-column">
            <div class="row h-100 flex-grow-1">
                <div class="col-12 col-lg-4">
                    <div class="product-hero__content category-second-hero__content text-white sp-py-4 sp-sxl-py-9 sp-uxl-py-17">
                        <?php if ($parent_term && !is_wp_error($parent_term)) : ?>
                            <div class="product-3 fw-normal text-uppercase sp-mb-3">
                                <?php echo esc_html($parent_term->name); ?>
                            </div>
                        <?php endif; ?>
                        <h1 class="h3 light sp-mb-3 sp-sxl-mb-4 sp-uxl-mb-5">
                            <?php echo esc_html($term->name); ?>
                        </h1>
                        <?php if (!empty($term->description)) : ?>
                            <div class="regular mb-0-p">
                                <?php echo wp_kses_post(wpautop($term->description)); ?>
                            </div>
                        <?php endif; ?>
                        <?php
                        $type_cta = get_field('type_cta', $term_key);
                        $link = get_field('link', $term_key);
                        if ($type_cta == 'link') {
                            if(!empty($link)){
                                echo '<div class="cta-content sp-mt-4 sp-sxl-mt-7">';
                                echo '<a href="' . esc_url($link['url']) . '" class="btn btn-secondary-2" target="' . $link['target'] . '"><span>' . esc_html($link['title']) . '</span></a>';
                                echo '</div>';
                            }
                        } elseif ($type_cta == 'download') {
                            $txt_cta = get_field('txt_cta', $term_key);
                            $file = get_field('file', $term_key);
                            if($file){
                                echo '<div class="cta-content sp-mt-4 sp-sxl-mt-7">';
                                echo '<a href="' . esc_url($file['url']) . '" class="btn btn-secondary-2" download><span>' . esc_html($txt_cta) . '<i class="icon-filcar-icon-document"></i></span></a>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-12 col-lg-7 offset-lg-1 category-second-hero__visual-col">
                    <div class="category-second-hero__visual h-100">
                        <figure class="respimg sp-mb-0 position-absolute h-100 w-100">
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
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="prodotti" class="category-products-placeholder js-category-anchor-panel sp-pt-4 sp-lg-pt-7 sp-sxl-pt-10 sp-pb-3 sp-lg-pb-8 sp-sxl-pb-15 sp-uxl-pb-19" data-anchor-target="#prodotti">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="">
                        <div class="">
                            <h2 class="subtitle-1 fw-normal text-primary text-uppercase sp-pt-2 mb-0">Elementi</h2>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ( have_posts() ) : ?>
                <div class="category-products-grid row sp-pt-5 sp-lg-pt-10 sp-sxl-pt-12 sp-uxl-pt-10 sp-row-gap-7">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part('parts/card/card', 'element', ['card_class' => 'col-12 col-lg-4', 'prod_id' => get_the_ID()]); ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>
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
get_footer(null, ['footer-color' => 'white']);
