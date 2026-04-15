<?php

add_filter('posts_where', 'flc_fix_search_placeholders', 99999, 2);
function flc_fix_search_placeholders($where, $query) {
    // Applichiamo la correzione solo se siamo in una ricerca 's'
    if ($query->is_search() || !empty($query->get('s'))) {
        global $wpdb;
        // Questa è la funzione nativa di WP che dovrebbe girare ma che nel tuo caso fallisce
        // Rimuove gli hash e rimette i simboli di percentuale
        $where = str_replace($wpdb->placeholder_escape(), '%', $where);
    }
    return $where;
}
// Load HTML5 Blank scripts (header.php)
function filcar_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js', '', null, false);
        wp_enqueue_script('jquery');
        wp_register_script('bootstrap-js', get_template_directory_uri() . '/js/lib/bootstrap.bundle.min.js', array(), '5.3.2');
        wp_enqueue_script('bootstrap-js'); // Enqueue it!
        wp_enqueue_script(
            'gsap',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
            array(),
            '3.12.5',
            true
        );

        wp_enqueue_script(
            'scrollTrigger',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
            array(),
            '3.12.5',
            true
        );
        wp_enqueue_script(
            'scrollToPlugin',
            get_template_directory_uri() . '/js/lib/ScrollToPlugin.min.js',
            array(),
            '3.12.2',
            true
        );
        wp_register_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', '', null, true);
        //wp_enqueue_script('swiper');
        wp_register_script('aos', 'https://unpkg.com/aos@next/dist/aos.js', '', null, true);
        //wp_enqueue_script('aos');
        wp_register_script('owl-carousel', get_template_directory_uri() . '/js/lib/owl.carousel.min.js', '', null, true);
        wp_enqueue_script('owl-carousel');
        wp_register_script('text-aligner', get_template_directory_uri() . '/js/lib/jquery.verticalTextAligner.js', '', null, true);
        //wp_enqueue_script('text-aligner');
    }
    wp_register_script('filcarscripts', get_template_directory_uri() . '/js/scripts.js', '', null, true);
    wp_enqueue_script('filcarscripts');
}
if (function_exists('add_theme_support')) {
    // Add Menu Support
    add_theme_support('menus');
    
    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('products-thumbs', 369, 233, true); // Ritaglio esatto (hard crop)
    add_image_size('square', 800, 800, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    add_image_size('hero-1536', 1536, 99999, false);
    add_image_size('hero-1024', 1024, 99999, false);
    add_image_size('hero-768', 768, 99999, false);
    add_image_size('hero-400', 400, 99999, false);
    add_image_size('slide-img-ext', 705, 530, false);
    
    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Localisation Support
    load_theme_textdomain('filcar', get_template_directory() . '/languages');
}

/*------------------------------------*\
 Functions
 \*------------------------------------*/

/**
 * Add the 'defer' attribute to specific script tags.
 */
function add_defer_attribute_to_scripts($tag, $handle, $src) {
    // Array of script handles you want to defer
    $defer_scripts = array(
        'swiper',
        'fancybox-js',
        'aos'
    );

    // Check if the current script handle is in our list
    if (in_array($handle, $defer_scripts)) {
        // Use str_replace to insert ' defer' before ' src' in the script tag
        return str_replace(' src', ' defer src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'add_defer_attribute_to_scripts', 10, 3);

// Load HTML5 Blank styles
function filcar_styles()
{
    wp_register_style('aoscss', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array(), '1.0', 'all');
    //wp_enqueue_style('aoscss'); // Enqueue it!
    wp_register_style('filcarcss', get_template_directory_uri() . '/style.min.css', array(), '1.0', 'all');
    wp_enqueue_style('filcarcss'); // Enqueue it!
    wp_register_style('swipercss', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css', array(), '1.0', 'all');
    //wp_enqueue_style('swipercss'); // Enqueue it!
    //wp_enqueue_style('fancybox-css', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4/dist/fancybox.css');
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            //unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }
    
    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'flc'),
        'description' => __('Description for this widget-area...', 'flc'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'flc'),
        'description' => __('Description for this widget-area...', 'flc'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Footer Widget Area 1
    register_sidebar(array(
        'name' => __('Footer Area 1', 'flc'),
        'description' => __('Description for this widget-area...', 'flc'),
        'id' => 'footer-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget-title text-primary fw-bold">',
        'after_title' => '</span>'
    ));

    // Define Footer Widget Area 2
    register_sidebar(array(
        'name' => __('Footer Area 2', 'flc'),
        'description' => __('Description for this widget-area...', 'flc'),
        'id' => 'footer-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget-title text-primary fw-bold">',
        'after_title' => '</span>'
    ));

    // Define Footer Widget Area 3
    register_sidebar(array(
        'name' => __('Footer Area 3', 'flc'),
        'description' => __('Description for this widget-area...', 'flc'),
        'id' => 'footer-area-3',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget-title text-primary fw-bold">',
        'after_title' => '</span>'
    ));

    // Define Footer Widget Area 4
    register_sidebar(array(
        'name' => __('Footer Area 4', 'flc'),
        'description' => __('Description for this widget-area...', 'flc'),
        'id' => 'footer-area-4',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget-title text-primary fw-bold">',
        'after_title' => '</span>'
    ));

    // Define Footer Widget Area 5
    register_sidebar(array(
        'name' => __('Footer Area 5', 'flc'),
        'description' => __('Description for this widget-area...', 'flc'),
        'id' => 'footer-area-5',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget-title text-primary fw-bold">',
        'after_title' => '</span>'
    ));

    // Define Footer Widget Area 5
    register_sidebar(array(
        'name' => __('Footer Area 6', 'flc'),
        'description' => __('Description for this widget-area...', 'flc'),
        'id' => 'footer-area-6',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget-title text-primary fw-bold">',
        'after_title' => '</span>'
    ));

    // Define Footer Widget Mobile Menu
    register_sidebar(array(
        'name' => __('Footer Mobile Menu', 'flc'),
        'description' => __('Description for this widget-area...', 'flc'),
        'id' => 'footer-mobile-menu',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget-title text-primary fw-bold">',
        'after_title' => '</span>'
    ));

    // Define Footer Widget Mobile Menu
    register_sidebar(array(
        'name' => __('Copyright Footer', 'flc'),
        'description' => __('Description for this widget-area...', 'flc'),
        'id' => 'copyright-footer',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget-title">',
        'after_title' => '</span>'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function filcar_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions($html)
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
}
add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);

// Add Actions
add_action('init', 'filcar_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'filcar_styles'); // Add Theme Stylesheet
//add_action('init', 'create_data_post_type'); // Add our HTML5 Blank Custom Post Type
add_action('init', 'filcar_pagination'); // Add our HTML5 Pagination



// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation

add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_filter('wpcf7_load_js', '__return_false');
add_filter('wpcf7_load_css', '__return_false');
add_post_type_support('page', 'excerpt');


// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

/**
 * Add ACF thumbnail columns to Linen Category custom taxonomy
 */
function add_thumbnail_columns($columns)
{
    $columns['product_tax_image'] = __('Immagine categoria');
    // Enable the single line of code below if you want the Thumbnail at the end.
    //return $columns;
    
    // Code below will make the Thumbnail in the front.
    // Code start
    $new = array();
    foreach ($columns as $key => $value) {
        if ($key == 'name') // Put the Thumbnail column before the Name column
            $new['product_tax_image'] = 'Immagine categoria';
            $new[$key] = $value;
    }
    return $new;
    // Code end
}
add_filter('manage_edit-products_category_columns', 'add_thumbnail_columns');

function currentYear()
{
    return date('Y');
}
 
function getCookie(string $name): ?string {
    return $_COOKIE[$name] ?? null;
}
function setCookiee(
    string $name,
    string $value,
    int $expires = 0,
    string $path = '/',
    string $domain = '',
    bool $secure = true,
    bool $httponly = true
): bool {
    if (empty($name)) {
        return false;
    }

    return setcookie($name, $value, [
        'expires'  => $expires,
        'path'     => $path,
        'domain'   => $domain,
        'secure'   => $secure,
        'httponly' => $httponly,
        'samesite' => 'Strict'
    ]);
}
add_action('woocommerce_product_query', 'flc_fix_archive_sorting');
function flc_fix_archive_sorting($q) {
    // Interveniamo solo sul frontend e solo sulla query principale dei prodotti
    if (!is_admin() && $q->is_main_query()) {
        $q->set('orderby', 'ID');
        $q->set('order', 'DESC');
        
        // OPZIONALE: Se vuoi forzare i 10 prodotti per pagina (come calcolato in archive-product.php)
        // $q->set('posts_per_page', 10);
    }
}

include_once get_template_directory() . '/functions/fn-general.php';
include_once get_template_directory() . '/functions/fn-menu.php';
include_once get_template_directory() . '/functions/fn-blocks.php';