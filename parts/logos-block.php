<?php
$block_id = !empty($block['anchor']) ? $block['anchor'] : 'logos-block-' . ($block['id'] ?? uniqid());
$title = get_field('title');
$text = get_field('text');
$logos = get_field('logos');
?>

<?php if ($title || $text || !empty($logos)) : ?>
    <section id="<?php echo esc_attr($block_id); ?>" class="logos-block bg-grey-200 sp-py-8 sp-md-py-12 sp-lg-py-16">
        <div class="container-fluid">
            <?php if ($title || $text) : ?>
                <div class="row justify-content-center text-center">
                    <div class="col-12 col-md-10 col-lg-6">
                        <?php if ($title) : ?>
                            <h3 class="logos-block__title h3 fw-normal sp-mb-3">
                                <?php echo esc_html($title); ?>
                            </h3>
                        <?php endif; ?>

                        <?php if ($text) : ?>
                            <div class="logos-block__text mb-0-p">
                                <?php echo wp_kses_post($text); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($logos)) : ?>
                <div class="row justify-content-center align-items-center logos-block__logos sp-mt-6 sp-md-mt-8">
                    <?php foreach ($logos as $logo) :
                        $image = $logo['image'] ?? null;

                        if (empty($image)) {
                            continue;
                        }
                        ?>
                        <div class="col-auto logos-block__logo-col">
                            <?php
                            echo wp_get_attachment_image(
                                $image['ID'],
                                'full',
                                false,
                                [
                                    'class' => 'logos-block__logo',
                                    'alt' => $image['alt'] ?: ($title ?: ''),
                                ]
                            );
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
