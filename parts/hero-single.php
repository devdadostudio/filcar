<?php
$args = wp_parse_args($args ?? [], [
    'post_id' => get_the_ID(),
]);

$post_id = (int) $args['post_id'];
$post_type = get_post_type($post_id);
$is_case_study = $post_type === 'caso-studio';
$title = get_the_title($post_id);
$date_attr = get_the_date('c', $post_id);
$date_label = get_the_date('j F Y', $post_id);
$breadcrumb_parent_label = $is_case_study ? __('Case Studies', 'filcar') : __('Blog', 'filcar');
$breadcrumb_parent_url = '';

if ($is_case_study) {
    $case_studies_page = get_page_by_path('casi-studio');
    $breadcrumb_parent_url = $case_studies_page ? get_permalink($case_studies_page) : home_url('/casi-studio/');
} else {
    $posts_page_id = (int) get_option('page_for_posts');
    $breadcrumb_parent_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/');
}

$chips = [];

if ($is_case_study) {
    $terms = get_the_terms($post_id, 'categoria-caso-studio');
    if (!is_wp_error($terms) && !empty($terms)) {
        foreach ($terms as $term) {
            $chips[] = $term->name;
        }
    }

    if (count($chips) < 3) {
        $tags = get_the_terms($post_id, 'tag-caso-studio');
        if (!is_wp_error($tags) && !empty($tags)) {
            foreach ($tags as $tag) {
                $chips[] = $tag->name;
            }
        }
    }
} else {
    $categories = get_the_category($post_id);
    foreach ($categories as $category) {
        $chips[] = $category->name;
    }

    if (count($chips) < 3) {
        $tags = get_the_tags($post_id);
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $chips[] = $tag->name;
            }
        }
    }
}

$chips = array_slice(array_unique(array_filter($chips)), 0, 3);
$thumb_id = get_post_thumbnail_id($post_id);
?>
<section class="hero-single bg-blog text-white">
    <div class="hero-single__inner container-fluid">
        <nav class="hero-single__breadcrumb p-smaller" aria-label="<?php echo esc_attr__('Breadcrumb', 'filcar'); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html__('Home', 'filcar'); ?></a>
            <span><?php echo esc_html__('>', 'filcar'); ?></span>
            <a href="<?php echo esc_url($breadcrumb_parent_url); ?>"><?php echo esc_html($breadcrumb_parent_label); ?></a>
            <span><?php echo esc_html__('>', 'filcar'); ?></span>
            <span><?php echo esc_html($title); ?></span>
        </nav>

        <h1 class="hero-single__title h0 extralight mb-0">
            <?php echo esc_html($title); ?>
        </h1>

        <div class="hero-single__meta">
            <?php if (!empty($chips)) : ?>
                <ul class="hero-single__chips" aria-label="<?php echo esc_attr__('Categorie', 'filcar'); ?>">
                    <?php foreach ($chips as $chip) : ?>
                        <li class="hero-single__chip p-small"><?php echo esc_html($chip); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <time class="hero-single__date p-small" datetime="<?php echo esc_attr($date_attr); ?>">
                <?php echo esc_html($date_label); ?>
            </time>
        </div>

        <figure class="hero-single__media respimg mb-0">
            <?php
            if ($thumb_id) {
                echo wp_get_attachment_image($thumb_id, 'hero-1536', false, [
                    'alt' => $title,
                ]);
            } else {
                ?>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/sfondo-card.jpg'); ?>" alt="<?php echo esc_attr($title); ?>">
                <?php
            }
            ?>
        </figure>
    </div>
</section>
