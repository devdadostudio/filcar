<?php
function allow_webp_upload($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'allow_webp_upload');

function fix_webp_mime_type($data, $file, $filename, $mimes) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext === 'webp') {
        $data['ext'] = 'webp';
        $data['type'] = 'image/webp';
    }
    return $data;
}
add_filter('wp_check_filetype_and_ext', 'fix_webp_mime_type', 10, 4);

/* Create post type product */
add_action('init', 'create_product_post_type');

function create_product_post_type() {
    $labels = array(
        'name' => _x('Prodotti', 'post type general name'),
        'singular_name' => _x('Prodotto', 'post type singular name'),
        'menu_name' => _x('Prodotti', 'admin menu'),
        'name_admin_bar' => _x('Prodotto', 'add new on admin bar'),
        'add_new' => _x('Aggiungi Nuovo', 'product'),
        'add_new_item' => __('Aggiungi Nuovo Prodotto'),
        'new_item' => __('Nuovo Prodotto'),
        'edit_item' => __('Modifica Prodotto'),
        'view_item' => __('Visualizza Prodotto'),
        'all_items' => __('Tutti i Prodotti'),
        'search_items' => __('Cerca Prodotti'),
        'not_found' => __('Nessun prodotto trovato'),
        'not_found_in_trash' => __('Nessun prodotto trovato nel Cestino'),
        'parent_item_colon' => '',
        'menu_icon' => 'dashicons-products',
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'product'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
        'show_in_rest' => true
    );
    register_post_type('product', $args);
}
?>