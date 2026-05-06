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
        'rewrite' => array('slug' => 'prodotto'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
        'show_in_rest' => true
    );
    register_post_type('product', $args);
}

function get_icon($name) {
    $icons = [
        'check' => '<svg width="9" height="7" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 3.33333L3.43478 6L8 1" stroke="#0085DD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>',
    ];

    return $icons[$name] ?? '';
}

function registra_custom_post_type_settori() {

    $labels = array(
        'name'                  => 'Settori',
        'singular_name'         => 'Settore',
        'menu_name'             => 'Settori',
        'name_admin_bar'        => 'Settore',
        'add_new'               => 'Aggiungi Nuovo',
        'add_new_item'          => 'Aggiungi Nuovo Settore',
        'new_item'              => 'Nuovo Settore',
        'edit_item'             => 'Modifica Settore',
        'view_item'             => 'Vedi Settore',
        'all_items'             => 'Tutti i Settori',
        'search_items'          => 'Cerca Settori',
        'not_found'             => 'Nessun settore trovato.',
        'not_found_in_trash'    => 'Nessun settore trovato nel cestino.'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'settori' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-category', // Icona nel menu admin
        'show_in_rest'       => true, // Obbligatorio per abilitare l'editor Gutenberg
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'settori', $args );
}

add_action( 'init', 'registra_custom_post_type_settori' );