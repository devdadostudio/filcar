<?php
$items = $args['items'] ?? [];
$classes = $args['classes'] ?? '';
$aria_label = $args['aria_label'] ?? __('Navigazione sezioni', 'filcar');

if (empty($items) || !is_array($items)) {
    return;
}
?>

<nav class="category-anchor-nav <?php echo esc_attr($classes); ?>" aria-label="<?php echo esc_attr($aria_label); ?>">
    <?php foreach ($items as $index => $item) :
        $url = $item['url'] ?? '';
        $label = $item['label'] ?? '';

        if (!$url || !$label) {
            continue;
        }
        ?>
        <a class="category-anchor-nav__link subtitle-4 text-uppercase user-select-none<?php echo $index === 0 ? ' is-active' : ''; ?>" href="<?php echo esc_url($url); ?>">
            <span class="category-anchor-nav__meta number-3" aria-hidden="true">
                <?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?>
            </span>
            <span class="category-anchor-nav__label"><?php echo esc_html($label); ?></span>
            <i class="category-anchor-nav__arrow icon-filcar-icon-arrow-right" aria-hidden="true"></i>
        </a>
    <?php endforeach; ?>
</nav>
