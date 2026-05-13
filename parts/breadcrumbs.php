<?php
$args = wp_parse_args($args ?? [], [
    'variant' => 'light',
    'layout' => 'bar',
    'items' => [],
    'class' => '',
    'inner_class' => '',
    'col_class' => 'col-12 col-lg-4',
    'after' => '',
    'container' => true,
    'mobile_bg' => false,
    'use_yoast' => true,
]);

$variant = in_array($args['variant'], ['dark', 'light'], true) ? $args['variant'] : 'light';
$layout = in_array($args['layout'], ['bar', 'overlay', 'inline'], true) ? $args['layout'] : 'bar';
$items = is_array($args['items']) ? array_values(array_filter($args['items'])) : [];
$classes = array_filter([
    'site-breadcrumb',
    'site-breadcrumb--' . $variant,
    'site-breadcrumb--' . $layout,
    $args['mobile_bg'] ? 'site-breadcrumb--mobile-bg' : '',
    $args['class'],
]);
$inner_classes = array_filter([
    'site-breadcrumb__items',
    'p-smaller',
    $args['inner_class'],
]);
?>
<nav class="<?php echo esc_attr(implode(' ', $classes)); ?>" aria-label="<?php echo esc_attr__('Breadcrumb', 'filcar'); ?>">
    <?php if ($args['container']) : ?>
    <div class="container-fluid">
    <?php endif; ?>
        <div class="row">
            <div class="<?php echo esc_attr($args['col_class']); ?>">
                <div class="<?php echo esc_attr(implode(' ', $inner_classes)); ?>">
                    <?php if (!empty($items)) : ?>
                        <?php foreach ($items as $index => $item) : ?>
                            <?php
                            $label = isset($item['label']) ? (string) $item['label'] : '';
                            $url = isset($item['url']) ? (string) $item['url'] : '';
                            $is_last = $index === count($items) - 1;

                            if ($label === '') {
                                continue;
                            }
                            ?>
                            <?php if ($index > 0) : ?>
                                <i class="site-breadcrumb__separator icon-filcar-icon-chevron-forward" aria-hidden="true"></i>
                            <?php endif; ?>

                            <?php if (!$is_last && $url !== '') : ?>
                                <a href="<?php echo esc_url($url); ?>"><?php echo esc_html($label); ?></a>
                            <?php else : ?>
                                <span class="breadcrumb_last"<?php echo $is_last ? ' aria-current="page"' : ''; ?>><?php echo esc_html($label); ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php elseif ($args['use_yoast'] && function_exists('yoast_breadcrumb')) : ?>
                        <?php yoast_breadcrumb(); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo $args['after']; ?>
        </div>
    <?php if ($args['container']) : ?>
    </div>
    <?php endif; ?>
</nav>
