<?php
function filcar_main_menu_nav()
{
    wp_nav_menu(
        array(
            'theme_location'  => 'header-menu',
            'menu'            => '',
            'container'       => 'div',
            'container_class' => 'menu-{menu slug}-container',
            'container_id'    => '',
            'menu_class'      => '',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul class="navbar-nav flc-headmenu flex-md-row">%3$s</ul>',
            'depth'           => 0,
            'walker'          => new Custom_Submenu_Walker()
        )
    );
}
function register_html5_menu()
{
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'pmx'),
        'right-menu'  => __('Right Menu', 'pmx'),
    ));
}
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
function aggiungi_classe_li_widget($classes, $item, $args) {
    // Controlla se il menu ha un nome specifico (sostituisci 'Mio Menu Widget' col nome del tuo menu)
    if (isset($args->menu) && ($args->menu->name == 'Footer Arredo Termico' || $args->menu->name == 'Footer Attrezzature Operative' || $args->menu->name == 'Footer menu al fondo')) {
        $classes[] = 'p-small fw-light footer-menu-link-arrow d-flex justify-content-between align-items-center';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'aggiungi_classe_li_widget', 10, 3);

class Custom_Submenu_Walker extends Walker_Nav_Menu
{
    // -------------------------------------------------------------------------
    // Configurazione
    // -------------------------------------------------------------------------

    private int $columns = 5;
    private int $col_count = 0;

    // Promo standard
    private string $promo_image_url  = '';
    private string $promo_link_url   = '';
    private string $promo_link_label = '';
    private string $promo_alt        = '';

    private string $fallback_image_url  = 'https://placehold.co/300x400/1a1a2e/ffffff?text=Promo';
    private string $fallback_link_url   = '#';
    private string $fallback_link_label = 'Scopri di più →';
    private string $fallback_alt        = 'Immagine promozionale';

    /** Flag e storage per Arredo Tecnico (Righe orizzontali) */
    private bool $is_arredo_tecnico = false;
    private array $arredo_tree = [];
    private int $arredo_current_lvl2 = -1;

    /** Flag e storage per Attrezzature Operative (Sidebar + Pannelli) */
    private bool $is_attrezzature = false;
    private array $attrezzature_tree = [];
    private int $attrezzature_current_lvl2 = -1;


    // =========================================================================
    // start_lvl — apertura sottomenu <ul>
    // =========================================================================
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat( "\t", $depth );

        if ( $this->is_arredo_tecnico || $this->is_attrezzature ) {
            if ( $depth === 0 ) {
                $class = $this->is_arredo_tecnico ? 'arredo-tecnico-megamenu' : 'attrezzature-megamenu';
                $output .= "\n{$indent}<div class=\"dropdown-menu megamenu {$class} w-100 shadow p-0\" role=\"region\">\n";
            }
            return; 
        }

        if ( $depth === 0 ) {
            $img_url  = $this->promo_image_url  ?: $this->fallback_image_url;
            $link_url = $this->promo_link_url   ?: $this->fallback_link_url;
            $label    = $this->promo_link_label ?: $this->fallback_link_label;
            $alt      = $this->promo_alt        ?: $this->fallback_alt;

            $output .= "\n{$indent}<div class=\"dropdown-menu megamenu shadow p-4 sp-md-py-7 sp-llg-py-6\" role=\"region\">\n";
            $output .= "{$indent}\t<div class=\"container\">\n";
            $output .= "{$indent}\t<div class=\"row row-cols-llg-{$this->columns} g-4\">\n";
            $output .= "{$indent}\t\t<div class=\"col megamenu__col megamenu__col--promo\">\n";
            $output .= "{$indent}\t\t\t<a href=\"" . esc_url( $link_url ) . "\" class=\"megamenu__promo-link d-block text-decoration-none\">\n";
            $output .= "{$indent}\t\t\t\t<img src=\"" . esc_url( $img_url ) . "\" alt=\"" . esc_attr( $alt ) . "\" class=\"img-fluid w-100 rounded megamenu__promo-img\" loading=\"lazy\" />\n";
            $output .= "{$indent}\t\t\t\t<span class=\"megamenu__promo-cta mt-2\">" . esc_html( $label ) . "</span>\n";
            $output .= "{$indent}\t\t\t</a>\n";
            $output .= "{$indent}\t\t</div>\n";
            $this->col_count = 0;
        } elseif ( $depth === 1 ) {
            $output .= "\n{$indent}\t\t\t<ul class=\"megamenu__links list-unstyled mb-0\">\n";
        }
    }

    // =========================================================================
    // start_el — apertura singolo elemento
    // =========================================================================
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent  = str_repeat( "\t", $depth );
        $classes = empty( $item->classes ) ? [] : (array) $item->classes;
        $has_children = in_array( 'menu-item-has-children', $classes );

        if ( $depth === 0 ) {
            $this->is_arredo_tecnico = in_array( 'menu-arredo-tecnico', $classes );
            $this->is_attrezzature   = in_array( 'menu-attrezzature-operative', $classes );

            if ( $has_children && !$this->is_arredo_tecnico && !$this->is_attrezzature && function_exists( 'get_field' ) ) {
                $acf_key = 'menu_item_' . $item->ID;
                $acf_image = get_field( 'megamenu_promo_image', $acf_key );
                $this->promo_image_url = is_array($acf_image) ? $acf_image['url'] : $acf_image;
                $acf_link = get_field( 'megamenu_promo_link', $acf_key );
                $this->promo_link_url = is_array($acf_link) ? $acf_link['url'] : $acf_link;
                $this->promo_link_label = get_field( 'megamenu_promo_label', $acf_key ) ?: (is_array($acf_link) ? $acf_link['title'] : '');
            }

            $li_classes = array_merge( [ 'nav-item' ], $classes );
            if ( $has_children ) $li_classes[] = 'megamenu-item';
            $output .= "\n{$indent}<li class=\"" . esc_attr( implode( ' ', $li_classes ) ) . "\">";
            $output .= "<a href=\"" . esc_url($item->url) . "\" class=\"nav-link " . ($has_children ? 'dropdown-toggle' : '') . "\" " . ($has_children ? 'data-bs-toggle="dropdown"' : '') . ">" . esc_html($item->title) . "</a>";
        }

        elseif ( $depth === 1 ) {
            if ( $this->is_arredo_tecnico ) {
                $this->arredo_current_lvl2 = count( $this->arredo_tree );
                $this->arredo_tree[] = [ 'item' => $item, 'children' => [] ];
            } elseif ( $this->is_attrezzature ) {
                $this->attrezzature_current_lvl2 = count( $this->attrezzature_tree );
                $img = function_exists('get_field') ? get_field('immagine', 'menu_item_' . $item->ID) : null;
                $this->attrezzature_tree[] = [
                    'item'     => $item,
                    'image'    => is_array($img) ? $img['url'] : $img,
                    'children' => []
                ];
            } else {
                $output .= "\n{$indent}\t\t<div class=\"col megamenu__col\">\n";
                $output .= "{$indent}\t\t\t<p class=\"megamenu__col-title fw-bold small mb-2\">" . esc_html($item->title) . "</p>\n";
            }
        }

        elseif ( $depth === 2 ) {
            if ( $this->is_arredo_tecnico ) {
                // Recupero immagine ACF per il terzo livello di arredo tecnico
                $img = function_exists('get_field') ? get_field('immagine', 'menu_item_' . $item->ID) : null;
                $img_url_size = wp_get_attachment_image_src( $img['ID'], 'img-menu-arredo-tecnico' );
                $img_url = $img_url_size ? $img_url_size[0] : '';

                $this->arredo_tree[ $this->arredo_current_lvl2 ]['children'][] = [
                    'item'  => $item,
                    'image' => $img_url
                ];
            } elseif ( $this->is_attrezzature ) {
                $this->attrezzature_tree[ $this->attrezzature_current_lvl2 ]['children'][] = $item;
            } else {
                $output .= "{$indent}\t\t\t\t<li class=\"megamenu__link-item\"><a href=\"" . esc_url($item->url) . "\" class=\"megamenu__link d-block py-1 text-white text-decoration-none\">" . esc_html($item->title) . "</a>";
            }
        }
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat( "\t", $depth );

        if ( $depth === 0 ) {
            if ( $this->is_arredo_tecnico ) {
                $this->render_arredo_tecnico( $output, $indent );
                $this->is_arredo_tecnico = false; $this->arredo_tree = [];
            } elseif ( $this->is_attrezzature ) {
                $this->render_attrezzature_operative( $output, $indent );
                $this->is_attrezzature = false; $this->attrezzature_tree = [];
            } else {
                $output .= "{$indent}\t</div></div></div>\n";
            }
            if ($this->is_arredo_tecnico || $this->is_attrezzature) {
                $output .= "{$indent}</div>\n";
            }
        } elseif ( $depth === 1 && !$this->is_arredo_tecnico && !$this->is_attrezzature ) {
            $output .= "{$indent}\t\t\t</ul></div>\n";
        }
    }

    private function render_attrezzature_operative( &$output, $indent ) {
        $output .= "{$indent}<div class=\"container-fluid sp-py-11\">\n";
        $output .= "{$indent}\t<div class=\"attrezzature-wrapper row\">\n";
        $output .= "{$indent}\t\t<div class=\"attrezzature-sidebar col-12 col-lg-6 sp-pt-\">\n";
        $output .= "{$indent}\t\t\t<ul class=\"list-unstyled mb-0\">\n";
        foreach ( $this->attrezzature_tree as $idx => $node ) {
            $active = ($idx === 0) ? 'is-active' : '';
            $img_html = $node['image'] ? "<figure class=\"aspect-ration-3x2 rounded figure-img-left-links respimg overflow-hidden\"><img src='{$node['image']}'></figure>" : "";
            $output .= "{$indent}\t\t\t\t<li class=\"attrezzature-trigger {$active} d-flex align-items-start row\" style=\"cursor:pointer;\" data-bs-target=\"#attr-pane-{$idx}\">\n";
            $output .= "{$indent}\t\t\t\t\t<div class=\"col-6 d-flex justify-content-end\">{$img_html}</div><div class=\"col-6 d-flex align-items-start\"><span class=\"h7 fw-normal text-grey-600\">" . esc_html($node['item']->title) . "</span></div>\n";
            $output .= "{$indent}\t\t\t\t</li>\n";
        }
        $output .= "{$indent}\t\t\t</ul>\n";
        $output .= "{$indent}\t\t</div>\n";

        $output .= "{$indent}\t\t<div class=\"attrezzature-content col-12 col-lg-6 text-white\">\n";
        foreach ( $this->attrezzature_tree as $idx => $node ) {
            $display = ($idx === 0) ? 'd-block' : 'd-none';
            $output .= "{$indent}\t\t\t<div class=\"attrezzature-panel {$display} sp-ml-0 sp-lg-ml-14 sp-sxl-ml-15\" id=\"attr-pane-{$idx}\">\n";
            $output .= "{$indent}\t\t\t\t<ul class=\"list-unstyled d-flex flex-column\">\n";
            foreach ( $node['children'] as $child ) {
                $output .= "{$indent}\t\t\t\t\t<li class=\"col\"><a href=\"" . esc_url($child->url) . "\" class=\"text-white-50 text-decoration-none hover-white p-big\">" . esc_html($child->title) . "</a></li>\n";
            }
            $output .= "{$indent}\t\t\t\t</ul>\n";
            $output .= "{$indent}\t\t\t</div>\n";
        }
        $output .= "{$indent}\t\t</div>\n";
        $output .= "{$indent}\t</div>\n";
        $output .= "{$indent}</div>\n";
    }

    private function render_arredo_tecnico( &$output, $indent ) {
        $output .= "{$indent}\t<div class=\"inner-container-small arredo-tecnico-scroll-container sp-py-9 sp-lg-py-11 sp-sxl-py-13\">\n";
        
        foreach ( $this->arredo_tree as $idx => $node ) {
            $item     = $node['item'];
            $children = $node['children'];
            $is_last  = ( $idx === count($this->arredo_tree) - 1 );

            $row_classes = 'row arredo-tecnico-menu__row text-white flex-nowrap sp-gap-8';
            if ( ! $is_last ) {
                $row_classes .= ' arredo-tecnico-menu__row--divider';
            }

            $output .= "{$indent}\t\t<div class=\"{$row_classes}\">\n";
            $output .= "{$indent}\t\t\t<div class=\"col-4 arredo-tecnico-menu__col-label\">\n";

            if ( ! empty( $item->url ) && $item->url !== '#' ) {
                $output .= "{$indent}\t\t\t\t<a href=\"" . esc_url( $item->url ) . "\" class=\"arredo-tecnico-menu__lvl2-link text-decoration-none\">\n";
                $output .= "{$indent}\t\t\t\t\t" . esc_html( apply_filters( 'the_title', $item->title, $item->ID ) ) . "\n";
                $output .= "{$indent}\t\t\t\t</a>\n";
            } else {
                $output .= "{$indent}\t\t\t\t<span class=\"arredo-tecnico-menu__lvl2-label text-uppercase fw-medium text-uppercase subtitle-2 text-grey-800\">\n";
                $output .= "{$indent}\t\t\t\t\t" . esc_html( apply_filters( 'the_title', $item->title, $item->ID ) ) . "\n";
                $output .= "{$indent}\t\t\t\t</span>\n";
            }

            $output .= "{$indent}\t\t\t</div>\n";
            $output .= "{$indent}\t\t\t<div class=\"col-8 arredo-tecnico-menu__col-children\">\n";

            if ( ! empty( $children ) ) {
                $output .= "{$indent}\t\t\t\t<ul class=\"arredo-tecnico-menu__lvl3-list list-unstyled d-flex flex-wrap gap-4 mb-0\">\n";

                foreach ( $children as $child_data ) {
                    $child = $child_data['item'];
                    $image = $child_data['image'];
                    
                    $child_classes = [ 'arredo-tecnico-menu__lvl3-item' ];
                    if ( $child->current ) $child_classes[] = 'active';

                    $output .= "{$indent}\t\t\t\t\t<li class=\"" . esc_attr( implode( ' ', $child_classes ) ) . "\">\n";
                    $output .= "{$indent}\t\t\t\t\t\t<a href=\"" . esc_url( $child->url ) . "\" class=\"text-white arredo-tecnico-menu__lvl3-link text-decoration-none d-flex sp-gap-3\">\n";
                    
                    // Se esiste l'immagine ACF per il terzo livello, la stampiamo
                    if ( $image ) {
                        $output .= "{$indent}\t\t\t\t\t\t\t<figure class=\"aspect-ratio-4x3 respimg rounded overflow-hidden mb-0 figure-img-menu-arredo-tecnico\">\n";
                        $output .= "{$indent}\t\t\t\t\t\t\t<img src=\"" . esc_url($image) . "\">\n";
                        $output .= "{$indent}\t\t\t\t\t\t\t</figure>\n";
                    }
                    
                    $output .= "{$indent}\t\t\t\t\t\t\t<span>" .apply_filters( 'the_title', $child->title, $child->ID ). "</span>\n";
                    $output .= "{$indent}\t\t\t\t\t\t</a>\n";
                    $output .= "{$indent}\t\t\t\t\t</li>\n";
                }

                $output .= "{$indent}\t\t\t\t</ul>\n";
            }

            $output .= "{$indent}\t\t\t</div>\n";
            $output .= "{$indent}\t\t</div>\n";
        }

        $output .= "{$indent}\t</div>\n";
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        if ( ($this->is_arredo_tecnico || $this->is_attrezzature) && $depth >= 1 ) return;
        if ( $depth === 0 ) $output .= "</li>\n";
    }
}