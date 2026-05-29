<section class="catalogs-block bg-primary">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-white">
                <div class="section-inner">
                    <div class="subtitle-header sp-mb-5 sp-gap-1 subtitle-after-white">
                        <h2 class="h3 light">Cataloghi</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row sp-row-gap-8 sp-pb-5 sp-lg-pb-7">
            <?php
            $args = [
                'post_type' => 'catalogo',
                'posts_per_page' => -1,
                'order' => 'DESC',
            ];
            $catalogs = new WP_Query($args);
            if ($catalogs->have_posts()) :
                while ($catalogs->have_posts()) : $catalogs->the_post();
                $file = get_field('catalogo', get_the_ID());
            ?>
                <div class="col-6 col-lg-2">
                    <a href="<?php echo $file['url']; ?>" download>
                        <figure class="w-100 aspect-ratio-3x4 rounded overflow-hidden bg-catalog sp-mb-2">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'catalog-thumb', ['class' => 'w-100']); ?>
                        </figure>
                        <div class="text-white sp-mb-3 catalog-title"><?php echo get_the_title(); ?></div>
                        <div class="text-white d-flex align-items-center justify-content-between">
                            <div class="catalog-date p-smaller">
                                <?php echo get_the_date('M d, Y'); ?>
                            </div>
                            <div class="catalog-download">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 11.7647H2V17.6471H18V11.7647H20V17.6471C20 18.9529 19.11 20 18 20H2C1.46957 20 0.960859 19.7521 0.585786 19.3108C0.210714 18.8696 0 18.2711 0 17.6471V11.7647ZM10 15.2941L15.55 8.87059L14.13 7.21177L11 10.8824V0H9V10.8824L5.88 7.21177L4.46 8.88235L10 15.2941Z" fill="white"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>

<script>
    jQuery(document).ready(function () {
        jQuery('.catalogs-block .catalog-title').verticalTextAligner();
    });
</script>