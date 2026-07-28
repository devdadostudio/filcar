<?php
$content = get_field('content');
if(!empty($content)) {
    $content_c = count($content);
    $thumb = get_post_thumbnail_id(get_the_ID());
    $case_sidebar_image = is_singular('caso-studio') && function_exists('get_field') ? get_field('immagine_alternativa_case', get_the_ID()) : null;
    $case_sidebar_image_id = is_array($case_sidebar_image) && !empty($case_sidebar_image['ID']) ? (int) $case_sidebar_image['ID'] : 0;
    $base_sidebar_image_id = $case_sidebar_image_id ?: $thumb;
    $base_sidebar_image_alt = is_array($case_sidebar_image) && !empty($case_sidebar_image['alt']) ? $case_sidebar_image['alt'] : get_the_title($base_sidebar_image_id);
    $sidebar_images = [];

    for ($i = 0; $i < $content_c; $i++) {
        if (empty($content[$i]['img']) || !is_array($content[$i]['img'])) {
            continue;
        }

        $sidebar_images[$i] = $content[$i]['img'];
    }
?>
<section class="post-content bg-white">
    <div class="container-fluid">
        <div class="row sp-mt-8 sp-lg-mt-14">
            <?php if ( is_singular( 'caso-studio' ) ) { ?>
                <div class="col-12 col-lg-4">
                    <div class="sidebar-inner sp-pb-6">
                        <div class="sidebar-index-container sp-py-4 sp-pr-5 bg-sidebar-index rounded overflow-hidden">
                            <ul class="sidebar-index-list list-unstyled mb-0-p mb-0 d-flex flex-column sp-gap-3">
                                <?php
                                    for($i = 0; $i < $content_c; $i++) :
                                        $index = $i + 1;
                                ?>
                                    <li class="sidebar-index-item mb-0 sp-pl-4 sp-lg-pl-7">
                                        <a href="#post-content-section-<?php echo $i; ?>" class="d-flex align-items-center text-decoration-none justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <span class="number-3 fw-normal number-span flex-grow-1"><?php echo $index < 10 ? '0'.$index : $index; ?></span>
                                                <span class="subtitle-4 w-100 flex-shrink-1"><?php echo esc_html($content[$i]['title']); ?></span>
                                            </div>
                                            <i class="icon-filcar-icon-arrow-right"></i>
                                        </a>
                                    </li>
                                <?php
                                    endfor;
                                ?>
                            </ul>
                        </div>
                        <?php if($base_sidebar_image_id || !empty($sidebar_images)) : ?>
                            <div class="post-content__sidebar_img sp-mt-6 sp-lg-mt-9">
                                <div class="post-content__sidebar_img-stack aspect-ratio-1x1 rounded overflow-hidden respimg js-post-content-sidebar-image-stack">
                                    <?php if($base_sidebar_image_id) : ?>
                                        <figure class="post-content__sidebar_img-layer sp-mb-0 is-active" data-sidebar-image-target="base">
                                            <?php echo wp_get_attachment_image($base_sidebar_image_id, 'square', false, ['alt' => esc_attr($base_sidebar_image_alt)]); ?>
                                        </figure>
                                    <?php endif; ?>

                                    <?php foreach ($sidebar_images as $sidebar_image_index => $sidebar_image) : ?>
                                        <?php
                                            $sidebar_image_id = !empty($sidebar_image['ID']) ? (int) $sidebar_image['ID'] : 0;
                                            $sidebar_image_alt = !empty($sidebar_image['alt']) ? $sidebar_image['alt'] : ($content[$sidebar_image_index]['title'] ?? get_the_title());
                                        ?>
                                        <figure class="post-content__sidebar_img-layer sp-mb-0<?php echo !$base_sidebar_image_id && array_key_first($sidebar_images) === $sidebar_image_index ? ' is-active' : ''; ?>" data-sidebar-image-target="#post-content-section-<?php echo esc_attr($sidebar_image_index); ?>">
                                            <?php
                                                if ($sidebar_image_id) {
                                                    echo wp_get_attachment_image($sidebar_image_id, 'square', false, ['alt' => esc_attr($sidebar_image_alt)]);
                                                } elseif (!empty($sidebar_image['url'])) {
                                                    echo '<img src="' . esc_url($sidebar_image['url']) . '" alt="' . esc_attr($sidebar_image_alt) . '">';
                                                }
                                            ?>
                                        </figure>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 <?php if(is_singular('caso-studio')){ ?> col-lg-6 offset-lg-1 <?php }else{ ?> col-lg-10 offset-lg-1 <?php } ?>">
                <div class="post-content__inner">
                    <?php
                        $counter = 1;
                        for($i = 0; $i < $content_c; $i++) :
                    ?>
                        <div id="post-content-section-<?php echo $i; ?>" class="post-content__item sp-mb-6 sp-lg-mb-11 sp-sxl-mb-21">
                            <?php if(is_singular('caso-studio')) : ?><span class="counter-section-blog number-2 text-grey-300 sp-mb-4 d-block"><?php echo $counter < 10 ? '0'.$counter : $counter; ?></span><?php endif; ?>
                            <h2 class="h2 light sp-mb-6 sp-lg-mb-9 lh-1 fw-light"><?php echo esc_html($content[$i]['title']); ?></h2>
                            <div class="post-content__text sp-row-gap-4 fw-light mb-0-p">
                                <?php echo wp_kses_post(wpautop($content[$i]['txt'])); ?>
                            </div>
                            <?php if($content[$i]['check_cit'] && $content[$i]['cit']) : ?>
                            <div class="post-content__cit sp-mt-6 sp-lg-mt-9">
                                <div class="h2 fw-normal mb-0-p"><?php echo $content[$i]['cit']; ?></div>
                                <div class="subtitle-2 sp-mt-3 mb-0-p"><?php echo "- ".$content[$i]['author_cit']; ?></div>
                            </div>
                            <?php endif; ?>
                            <?php
                                if($content[$i]['img']) :
                            ?>
                            <div class="post-content__img sp-mt-6">
                                <figure class="aspect-ratio-16x9 rounded overflow-hidden respimg">
                                    <img src="<?php echo esc_url($content[$i]['img']['url']); ?>" alt="<?php echo esc_attr($content[$i]['img']['alt']); ?>">
                                </figure>
                            </div>
                            <?php endif; ?>
                        </div>
                    <?php
                            $counter++;
                        endfor;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<style>
.post-content__sidebar_img-stack {
    position: relative;
}

.post-content__sidebar_img-layer {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.45s ease;
}

.post-content__sidebar_img-layer.is-active {
    opacity: 1;
}

.post-content__sidebar_img-layer img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

    const sections = document.querySelectorAll('.post-content__item[id^="post-content-section-"]');
    const navLinks = document.querySelectorAll('.sidebar-index-item a');
    const imageStack = document.querySelector('.js-post-content-sidebar-image-stack');
    const imageLayers = imageStack ? Array.from(imageStack.querySelectorAll('[data-sidebar-image-target]')) : [];

    if (!sections.length || !navLinks.length) return;

    // Offset: altezza header fisso se presente, altrimenti 0
    const OFFSET = 100;

    function getActiveIndex() {
        let active = 0;

        sections.forEach(function (section, i) {
            const top = section.getBoundingClientRect().top;
            if (top <= OFFSET) {
                active = i;
            }
        });

        return active;
    }

    function updateActiveLink() {
        const activeIndex = getActiveIndex();
        const activeSection = sections[activeIndex];
        const activeTarget = activeSection ? '#' + activeSection.id : '';

        navLinks.forEach(function (link, i) {
            link.closest('.sidebar-index-item').classList.toggle('is-active', i === activeIndex);
        });

        updateActiveImage(activeTarget);
    }

    function updateActiveImage(target) {
        if (!imageLayers.length) return;

        const activeLayer = imageLayers.find(function (layer) {
            return layer.dataset.sidebarImageTarget === target;
        }) || imageLayers.find(function (layer) {
            return layer.dataset.sidebarImageTarget === 'base';
        });

        if (!activeLayer) return;

        imageLayers.forEach(function (layer) {
            layer.classList.toggle('is-active', layer === activeLayer);
        });
    }

    // Esegui subito al caricamento
    updateActiveLink();

    // Throttle scroll per performance
    let ticking = false;
    window.addEventListener('scroll', function () {
        if (!ticking) {
            requestAnimationFrame(function () {
                updateActiveLink();
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });

});
</script>
