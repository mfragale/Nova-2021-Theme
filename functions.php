<?php

/**
 * Enqueue scripts and styles.
 */
function nova2021_scripts()
{

	wp_enqueue_style('bootstrap-style', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css', false);

	wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js', array('jquery'), true);

	wp_enqueue_script('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js', array('jquery'), true);

	wp_enqueue_style('main-style', get_template_directory_uri() . '/scss/dist/style.min.css', false);

	wp_enqueue_script('functions', get_template_directory_uri() . '/js/dist/functions.prod.js', array('jquery'), true);

	wp_enqueue_script('fontawesome', 'https://pro.fontawesome.com/releases/v5.14.0/js/all.js', array(), null );

}
add_action('wp_enqueue_scripts', 'nova2021_scripts');


function add_font_awesome_5_cdn_attributes( $html, $handle ) {
    if ( 'fontawesome' === $handle ) {
        return str_replace( "media='all'", "media='all' integrity='sha384-8nFttujfhbCh3CZJ34J+BtLPrg9cGflbku3ZQUTUewA7mqA8TG5Uip4fzQRbERs0' crossorigin='anonymous'", $html );
    }
    return $html;
}
add_filter( 'style_loader_tag', 'add_font_awesome_5_cdn_attributes', 10, 2 );



/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );



/*
 * Remove projects custom type added by Divi plugin - https://madlemmings.com/divi-theme-remove-project-custom-type/
 */
if (!function_exists('et_pb_register_posttypes')) :
	function et_pb_register_posttypes()
	{
		global $wp_post_types;
		global $post_type;
		if (isset($wp_post_types[$post_type])) {
			unset($wp_post_types[$post_type]);
			return true;
		}
		return false;
	}
endif;



/*
 * Adiciona o Menu
 */
function register_my_menus() {
	register_nav_menus(
		array(
			'navbar' => 'Navbar'
		)
	);
	register_nav_menus(
		array(
			'fullscreen_menu' => 'Full Screen Menu'
		)
	);
}
add_action( 'init', 'register_my_menus' );


function add_specific_menu_location_atts( $atts, $item, $args ) {
    // check if the item is in the primary menu
    if( $args->theme_location == 'navbar' ) {
      // add the desired attributes:
      $atts['class'] = "nav-link";
    }
    if( $args->theme_location == 'fullscreen_menu' ) {
      // add the desired attributes:
      $atts['class'] = "fullscreen_menu-item";
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3 );



/*
custom menu example @ https://digwp.com/2011/11/html-formatting-custom-menus/
https://wordpress.stackexchange.com/questions/228947/get-css-class-of-menu-item-in-custom-menu-structure
https://stackoverflow.com/questions/10019493/adding-class-current-page-item
 */
function navbar_custom_menu() {
	$menu_name = 'navbar'; // specify custom menu slug
	if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);

		$menu_list = '<div class="collapse navbar-collapse">' ."\n";
		$menu_list .= "\t\t\t\t". '<ul class="navbar-nav mr-auto ml-auto">' ."\n";
		foreach ((array) $menu_items as $key => $menu_item) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			$class = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $menu_item->classes ), $menu_item) ) );
			$active = ( $menu_item->object_id == get_queried_object_id() ) ? 'active' : '';
			
			$menu_list .= "\t\t\t\t\t". '<li class="nav-item ' . $active . '"><a class="nav-link" href="'. $url .'"><div class="active_highlight"><i class="fad '. $class .'"></i><span>'. $title .'</span></div></a></li>' ."\n";
		}
		$menu_list .= "\t\t\t\t". '</ul>' ."\n";
		$menu_list .= "\t\t\t". '</div>' ."\n";

	} else {
		// $menu_list = '<!-- no list defined -->';
	}
	echo $menu_list;
}

function fullscreen_custom_menu() {
	$menu_name = 'fullscreen_menu'; // specify custom menu slug
	if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);

		$menu_list = "\t\t\t\t". '<ul>' ."\n";
		foreach ((array) $menu_items as $key => $menu_item) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			$class = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $menu_item->classes ), $menu_item) ) );
			$active = ( $menu_item->object_id == get_queried_object_id() ) ? 'active' : '';
			
			$menu_list .= "\t\t\t\t\t". '<li class="' . $active . '"><a href="'. $url .'">'. $title .'</a></li>' ."\n";
		}
		$menu_list .= "\t\t\t\t". '</ul>' ."\n";

	} else {
		// $menu_list = '<!-- no list defined -->';
	}
	echo $menu_list;
}
