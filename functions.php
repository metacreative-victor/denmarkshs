<?php
// DEFINE
define( 'SEN_THEME_VERSION', '1.1' );
define( 'SEN_THEME_URL', trailingslashit( get_stylesheet_directory_uri() ) );
define( 'SEN_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );
//  END DEFINE

require_once( SEN_THEME_DIR. 'inc/shortcodes.php' );

// ACTIONS
function sen_setup() {
	load_theme_textdomain( 'sen' );
	add_theme_support( 'title-tag' );
    add_theme_support( 'menus' );
    add_theme_support( 'post-thumbnails' );
    add_post_type_support( 'page', 'thumbnail' );

    register_nav_menus(
        array(
            'secondary' => 'Secondary Menu',
            'primary' => 'Primary Menu',
            'footer' => 'Footer Menu',
        )
    );
}
add_action( 'after_setup_theme', 'sen_setup' );

function sen_scripts() {
    wp_register_script( 'sen_plugins', SEN_THEME_URL . 'assets/js/plugins.min.js', array('jquery'), null, true );
    wp_register_script( 'sen_theme', SEN_THEME_URL . 'assets/js/theme.js', array('jquery', 'sen_plugins'), SEN_THEME_VERSION, true );
    
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'sen_plugins' );
    wp_enqueue_script( 'sen_theme' );

    $data = array();
    $data['ajaxurl'] = admin_url('admin-ajax.php');
    $data['theme_url'] = SEN_THEME_URL;
    wp_localize_script( 'sen_theme', 'sen_data', $data );
}
add_action( 'wp_enqueue_scripts', 'sen_scripts' );

function sen_styles() {
    wp_register_style( 'sen_plugins', SEN_THEME_URL . 'assets/css/plugins.min.css', array(), null, 'screen' );
    wp_register_style( 'sen_theme', SEN_THEME_URL . 'assets/css/theme.css', array(), SEN_THEME_VERSION, 'screen' );

    wp_enqueue_style( 'sen_plugins' );
    wp_enqueue_style( 'sen_theme' );
}
add_action( 'wp_enqueue_scripts', 'sen_styles' );

function sen_add_options_page() {
    if( function_exists('acf_add_options_page') ) {
        $option_page = acf_add_options_page(array(
            'page_title'    => __('Theme Options', 'sen'),
            'menu_title'    => __('Theme Options', 'sen'),
            'menu_slug'     => 'theme-options',
        ));
    }
}
add_action( 'acf/init', 'sen_add_options_page' );

function sen_pre_get_posts( $query ) {
    if( $query->is_home() && $query->is_main_query() ) {
        $featured_news = get_field( 'featured_news', 'option' );

        if( !empty( $featured_news ) ) {
            $query->set( 'post__not_in', array($featured_news) );
        }
    }
}
add_action( 'pre_get_posts', 'sen_pre_get_posts' );
// END ACTIONS

// FILTERS
function sen_wp_nav_menu_items($items, $args) {
    if( $args->theme_location == 'secondary' ) {
        $facebook_url = get_field( 'facebook_url', 'option' );
        if( !empty( $facebook_url ) ) {
            $socials = '<li class="order-lg-last"><a href="' .esc_url( $facebook_url ). '" target="_blank"><img src="' .SEN_THEME_URL. 'assets/images/facebook-icon.png" alt="facebook" width="34" height="31"></a></li>';
            $menu_toggler = '<li class="d-lg-none"><button type="button" class="menu-toggler" data-toggle="collapse" data-target="#site-menu"><span></span><span></span><span></span></button></li>';

            $items = $socials . $items . $menu_toggler;
        }
    }

    return $items;
}
add_filter( 'wp_nav_menu_items', 'sen_wp_nav_menu_items', 10, 2 );

function sen_excerpt_length($length) {
    return 30;
}
add_filter( 'excerpt_length', 'sen_excerpt_length', 90 );

function sen_excerpt_more($more ) {
    return '';
}
add_filter( 'excerpt_more', 'sen_excerpt_more', 90 );

function sen_mce_buttons( $buttons ) {
    array_push( $buttons, 'separator', 'table' );
    return $buttons;
}
add_filter( 'mce_buttons', 'sen_mce_buttons' );

function sen_mce_external_plugins( $plugins ) {
    $plugins['table'] = SEN_THEME_URL . 'assets/js/tinymce/plugins/table/plugin.min.js';
    return $plugins;
}
add_filter( 'mce_external_plugins', 'sen_mce_external_plugins' );
// END FILTERS

// HELPERS
class Meta_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
        }

        $megamenu = get_field( 'megamenu', 'option' );

        if( 'primary' === $args->theme_location && in_array( 'menu-item-has-children', $item->classes, true ) && $depth == 0 ) {
            $output .= "</div></div></li>{$n}";
        } else {
            $output .= "</li>{$n}";
        }
	}
}

function sen_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {
    if( 'primary' === $args->theme_location ) {
        if( in_array( 'menu-item-has-children', $item->classes, true ) && $depth == 0 ) {
            $submenu_photo = get_field('submenu_photo', $item);
            $submenu_heading = get_field('submenu_heading', $item);

            $item_output .= '<div class="megamenu"><div class="container">';
            if( !empty( $submenu_photo['sizes']['large'] ) ) {
                $item_output .= '<div class="submenu__photo" style="background-image: url(' .esc_url( $submenu_photo['sizes']['large'] ). ');"></div>';
            }
            $item_output .= '<h3>' .$submenu_heading. '</h3>';
        }
    }

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'sen_walker_nav_menu_start_el', 10, 4 );
// END HELPERS