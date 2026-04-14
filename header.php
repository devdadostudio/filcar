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

        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/img/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-16x16.png">
        <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/img/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
            let template_url = "<?php echo get_template_directory_uri(); ?>";
        </script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

        <!-- Preload fonts -->
        <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/IBMPlexSans-Regular.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/Inter-Regular.woff2" as="font" type="font/woff2" crossorigin>

        <link rel="stylesheet" href="https://use.typekit.net/gww6khf.css">
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
        <!-- <header class="flc-main-nav <?php echo $headerBg; ?> w-100vw">
            <div class="flc-main-nav-container">
                <div class="flc-main-nav-inner">
                    <nav class="flc-main-header">
                        <a class="flc-main-brand flc-logo-mobile" href="<?php echo home_url(); ?>">
                            <?php include('img/logos/flc-logo.svg'); ?>
                        </a>
                    </nav>
                    <div class="flc-nav-container d-flex align-items-lg-center">
                        <div class="flc-nav-mobile-container sp-py-8 sp-px-4 sp-md-p-0">
                            <?php //filcar_nav(); ?>
                        </div>
                    </div>
                    <div class="flc-nav-container d-flex flex-row-reverse flex-xl-row">
                        <div class="d-block d-md-none flc-hamburger-button">
                            <button aria-label="Open Menu" class="hamburger hamburger--squeeze js-toggle-menu" type="button">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                        <div class="flc-right-nav">
                            <?php //filcar_right_nav(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </header> -->
        
        <?php //endif; ?> 
