<?php
$block_id = !empty($block['anchor']) ? $block['anchor'] : 'progettazione-png-sequence-' . ($block['id'] ?? uniqid());

$get_value = static function ($name, $key = '') use ($block) {
    $value = get_field($name);

    if (($value === null || $value === false || $value === '') && $key && !empty($block['data'][$key])) {
        $value = $block['data'][$key];
    }

    return $value;
};

$normalize_relative_path = static function ($path) {
    $path = trim((string) $path);
    $path = ltrim($path, '/');
    $path = preg_replace('#/+#', '/', $path);

    return $path ?: '';
};

$intro_label = $get_value('intro_label', 'field_progettazione_png_sequence_intro_label');
$intro_title = $get_value('intro_title', 'field_progettazione_png_sequence_intro_title');
$intro_text = $get_value('intro_text', 'field_progettazione_png_sequence_intro_text');
$fullscreen_intro = $get_value('fullscreen_intro', 'field_progettazione_png_sequence_fullscreen_intro');
$intro_image_url = '';
$intro_image_alt = '';

if (is_array($fullscreen_intro)) {
    $intro_image_url = $fullscreen_intro['url'] ?? '';
    $intro_image_alt = $fullscreen_intro['alt'] ?? '';
} elseif (is_numeric($fullscreen_intro)) {
    $intro_image_url = wp_get_attachment_image_url((int) $fullscreen_intro, 'full') ?: '';
    $intro_image_alt = get_post_meta((int) $fullscreen_intro, '_wp_attachment_image_alt', true) ?: '';
} elseif (is_string($fullscreen_intro)) {
    $intro_image_url = $fullscreen_intro;
}

$points = $get_value('points', 'field_progettazione_png_sequence_points');
$points = is_array($points) ? $points : [];

$frames_folder = trim((string) $get_value('frames_folder', 'field_progettazione_png_sequence_frames_folder'));
$frame_urls = [];

$frames_folder = $normalize_relative_path($frames_folder);

if ($frames_folder) {
    $frames_dir = trailingslashit(get_template_directory()) . $frames_folder;
    $frames_uri = trailingslashit(get_template_directory_uri()) . $frames_folder;

    if (is_dir($frames_dir)) {
        $frame_files = glob(trailingslashit($frames_dir) . '*.png');
        $frame_files = is_array($frame_files) ? $frame_files : [];

        natsort($frame_files);

        foreach ($frame_files as $frame_file) {
            if (is_file($frame_file)) {
                $frame_urls[] = trailingslashit($frames_uri) . basename($frame_file);
            }
        }
    }
}
?>

<section id="<?php echo esc_attr($block_id); ?>" class="progettazione-sequence js-progettazione-sequence">
    <div class="progettazione-sequence__intro">
        <div class="container-fluid progettazione-sequence__intro-copy">
            <div class="row justify-content-center text-center">
                <div class="col-12 col-lg-8 col-uxl-6">
                    <?php if ($intro_label) : ?>
                        <div class="number-3 text-secondary"><?php echo esc_html($intro_label); ?></div>
                    <?php endif; ?>

                    <?php if ($intro_title) : ?>
                        <h2 class="h3 light sp-mt-2 sp-md-mt-3 sp-lg-mt-4 text-white"><?php echo wp_kses_post(wpautop($intro_title)); ?></h2>
                    <?php endif; ?>

                    <?php if ($intro_text) : ?>
                        <div class="p-big light sp-mt-2 sp-md-mt-3 sp-lg-mt-4 text-white"><?php echo wp_kses_post(wpautop($intro_text)); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if ($intro_image_url) : ?>
            <figure class="progettazione-sequence__intro-media">
                <img src="<?php echo esc_url($intro_image_url); ?>" alt="<?php echo esc_attr($intro_image_alt); ?>" loading="lazy">
            </figure>
        <?php endif; ?>
    </div>

    <div class="progettazione-sequence__scroll js-progettazione-sequence-scroll">
        <div class="container-fluid">
            <div class="progettazione-sequence__stage">
                <div class="progettazione-sequence__media js-progettazione-sequence-media">
                    <div class="progettazione-sequence__canvas-wrap">
                        <canvas class="progettazione-sequence__canvas js-progettazione-sequence-canvas" width="1200" height="675" aria-label="<?php esc_attr_e('Sequenza di progettazione', 'filcar'); ?>"></canvas>
                    </div>
                </div>

                <aside class="progettazione-sequence__sidebar" aria-label="<?php esc_attr_e('Punti della sequenza', 'filcar'); ?>">
                    <?php foreach ($points as $index => $point) :
                        $number = str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);
                        $title = $point['title'] ?? '';
                        $text = $point['text'] ?? '';
                        $progress = isset($point['sequence_progress']) && is_numeric($point['sequence_progress']) ? (float) $point['sequence_progress'] / 100 : null;
                        $progress = $progress === null ? ($index / max(count($points) - 1, 1)) : max(0, min(1, $progress));
                    ?>
                        <article class="progettazione-sequence__point js-progettazione-sequence-point" data-sequence-progress="<?php echo esc_attr($progress); ?>">
                            <div class="progettazione-sequence__point-head">
                                <span class="progettazione-sequence__point-number number-3 semibold"><?php echo esc_html($number); ?></span>

                                <?php if ($title) : ?>
                                    <h3 class="progettazione-sequence__point-title h6"><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>
                            </div>

                            <?php if ($text) : ?>
                                <div class="progettazione-sequence__point-text p-normal"><?php echo wp_kses_post(wpautop($text)); ?></div>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </aside>
            </div>
        </div>
    </div>

    <?php if (!empty($frame_urls)) : ?>
        <script type="application/json" class="js-progettazione-sequence-frames"><?php echo wp_json_encode($frame_urls); ?></script>
    <?php endif; ?>
</section>
