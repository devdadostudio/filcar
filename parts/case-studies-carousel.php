<?php
$args = wp_parse_args($args ?? [], [
    'category_id' => 0,
    'posts_per_page' => 3,
]);

$category_id = (int) $args['category_id'];
$posts_limit = max(1, (int) $args['posts_per_page']);
$category = $category_id ? get_category($category_id) : null;
$block_id = $category instanceof WP_Term ? 'case-studies-carousel-' . $category->slug : 'case-studies-carousel';
$kicker = $category instanceof WP_Term ? strtoupper($category->name) : __('CASE STUDIES', 'filcar');
$title = $category instanceof WP_Term && $category->description ? wp_strip_all_tags($category->description) : __('La visione che diventa layout operativo', 'filcar');

$case_studies_query = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => $posts_limit,
    'post_status' => 'publish',
    'ignore_sticky_posts' => true,
    'cat' => $category_id,
]);

if ($case_studies_query->have_posts()) :
?>
<section id="<?php echo esc_attr($block_id); ?>" class="case-studies-carousel bg-blog text-white overflow-hidden">
    <div class="case-studies-carousel__head container-fluid">
        <div class="case-studies-carousel__breadcrumb p-small">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html__('Home', 'filcar'); ?></a>
            <span><?php echo esc_html__('>', 'filcar'); ?></span>
            <span><?php echo esc_html($category instanceof WP_Term ? $category->name : __('Case Studies', 'filcar')); ?></span>
        </div>
        <div class="case-studies-carousel__kicker product-3 fw-bold">
            <?php echo esc_html($kicker); ?>
        </div>
        <h2 class="case-studies-carousel__title mb-0">
            <?php echo esc_html($title); ?>
        </h2>
    </div>

    <div class="case-studies-carousel__slider-wrap">
        <div class="case-studies-carousel__slider js-case-studies-carousel owl-carousel">
            <?php while ($case_studies_query->have_posts()) :
                $case_studies_query->the_post();
                $post_id = get_the_ID();
                $image_url = get_the_post_thumbnail_url($post_id, 'hero-768') ?: get_template_directory_uri() . '/assets/img/sfondo-card.jpg';
                $excerpt = get_the_excerpt($post_id);
                $excerpt = $excerpt ?: wp_strip_all_tags(get_post_field('post_content', $post_id));
            ?>
                <article class="case-studies-carousel__item">
                    <a class="case-studies-carousel__card" href="<?php echo esc_url(get_permalink($post_id)); ?>">
                        <div class="case-studies-carousel__media respimg">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>" loading="lazy">
                        </div>
                        <div class="case-studies-carousel__content">
                            <time class="case-studies-carousel__date p-small" datetime="<?php echo esc_attr(get_the_date('c', $post_id)); ?>">
                                <?php echo esc_html(get_the_date('j F Y', $post_id)); ?>
                            </time>
                            <h3 class="case-studies-carousel__card-title">
                                <?php echo esc_html(get_the_title($post_id)); ?>
                            </h3>
                            <p class="case-studies-carousel__excerpt p-small mb-0">
                                <?php echo esc_html(wp_trim_words($excerpt, 18, '...')); ?>
                            </p>
                        </div>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php
endif;

wp_reset_postdata();
?>
