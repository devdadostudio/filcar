<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php //if(wp_title('', false)) { echo ' :'; } ?> <?php //bloginfo('name'); ?></title>
        <!-- Google Tag Manager -->
        
        <?php
        // Prepara la base URL per gli uploads
        $upload_dir = wp_upload_dir();
        $image_path = $upload_dir['baseurl'];
        ?>

        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.svg" />
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/img/apple-touch-icon.png" />
        <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/img/site.webmanifest" />

        <meta name="theme-color" content="#ffffff">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
            let template_url = "<?php echo get_template_directory_uri(); ?>";
        </script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

        <!-- Preload fonts -->
        <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/woff2/IBMPlexSans-Regular.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/woff2/Inter-Regular.woff2" as="font" type="font/woff2" crossorigin>

        <link rel="stylesheet" href="https://use.typekit.net/oxv5uwy.css">
        <!-- Preload fonts -->
        
		<?php wp_head(); ?>
	</head>

<?php $bootstrapScrollSpy = '';
    if( is_single() ){
        $bootstrapScrollSpy = 'data-bs-spy="scroll" data-bs-target="#productSpecs" data-bs-root-margin="0px 0px 0px" data-bs-smooth-scroll="true"';
    } ?>
	<body <?php body_class(); ?> id="top" <?php echo $bootstrapScrollSpy; ?>>
        <?php 
        $headerBg = '';
        if( is_front_page() ){
            $headerBg = 'home';
        }
        ?>
        <header class="flc-main-nav <?php echo $headerBg; ?> w-100vw sp-py-3 sp-lg-py-4 sp-uxl-py-5">
            <div class="flc-main-nav-container container-fluid">
                <div class="flc-main-nav-inner grid sp-gap-3">
                    <nav class="flc-main-header g-col-6 g-col-lg-4">
                        <a class="flc-main-brand flc-logo font-0" href="<?php echo home_url(); ?>">
                            <img src="<?php echo get_home_url(); ?>/wp-content/uploads/2026/04/filcar_logo.svg" alt="Logo">
                        </a>
                    </nav>
                    <div class="flc-nav-container align-items-lg-center d-none d-lg-flex g-col-4 justify-content-center">
                        <div class="sp-py-8 sp-px-4 sp-md-p-0">
                            <?php filcar_main_menu_nav(); ?>
                        </div>
                    </div>
                    <div class="flc-nav-container d-flex align-items-center sp-gap-2 sp-md-gap-3 sp-xl-gap-6 sp-sxl-gap-7 g-col-6 g-col-lg-4 justify-content-end">
                        <div class="search-toggle text-white cursor-pointer">
                            <i class="icon-filcar-icon-arrow-zoom"></i>
                        </div>
                        <a class="btn no-btn text-white d-none d-lg-block" href="<?php echo home_url(); ?>/contatti">
                            Contatti
                            <span class="icon-filcar-icon-arrow-upr"></span>
                        </a>
                        <a class="btn no-btn text-white d-none d-lg-block" href="">
                            IT
                            <span class="icon-filcar-icon-arrow-downr"></span>
                        </a>
                        <div class="d-block flc-hamburger-button text-white">
                            <button aria-label="Open Menu" class="hamburger hamburger--squeeze js-toggle-menu" type="button">
                                <i class="icon-filcar-icon-hamburger"></i>
                                <i class="icon-filcar-icon-close"></i>
                            </button>
                        </div>
                        <div class="flc-right-nav sp-pt-6 sp-md-pt-11 sp-lg-pt-5 sp-px-0 sp-md-px-5">
                            <div class="container-fluid">
                                <div class="d-flex flex-nowrap sp-gap-8">
                                    <div class="col-12 col-lg-6">
                                        <div class="d-flex d-lg-none">
                                            <?php filcar_main_menu_nav_mob(); ?>
                                        </div>
                                        <div class="d-none d-lg-block">
                                            <?php filcar_nav_right(); ?>
                                        </div>
                                        <div class="d-flex d-lg-none">
                                            <?php filcar_nav_right_mob(); ?>
                                        </div>
                                    </div>
                                    <div class="col-6 minh-100 d-none d-lg-block">
                                        <?php if ( is_active_sidebar( 'right-menu-area' ) ) : ?>
                                            <div class="menu-widget-area h-100 d-flex flex-column justify-content-between">
                                                <?php dynamic_sidebar( 'right-menu-area' ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flc-search-container dropdown-menu">
                            <div class="container-fluid">
                                <div class="top-container sp-mb-5">
                                    <?php
                                    get_template_part('parts/breadcrumbs', null, [
                                        'variant' => 'dark',
                                        'layout' => 'inline',
                                        'class' => 'search-breadcrumbs sp-pt-5 sp-pb-7',
                                        'col_class' => 'col-6',
                                        'container' => false,
                                        'items' => [
                                            ['label' => __('Home', 'filcar'), 'url' => home_url('/')],
                                            ['label' => __('Ricerca', 'filcar')],
                                        ],
                                        'after' => '<div class="col-6 d-flex justify-content-end text-white"><div class="search-close"><i class="icon-filcar-icon-close"></i></div></div>',
                                    ]);
                                    ?>
                                    <div class="search-title">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="search-title">
                                                    <span class="subtitle-1 text-white">RICERCA</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="search-container">
                                    <div class="col-12 sp-px-0 sp-md-px-6 sp-sxl-px-16">
                                        <?php get_search_form(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
