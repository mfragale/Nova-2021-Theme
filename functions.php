<?php

/**
 * Enqueue scripts and styles.
 */
function nova2021_scripts()
{

	$theme = wp_get_theme();
	$ver = $theme->get('Version');
	$themecsspath = get_stylesheet_directory() . '/style.css';
	$style_ver = filemtime($themecsspath);

	wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js', array('jquery'), true);

	wp_enqueue_script('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js', array('jquery'), true);

	//DEV
	wp_enqueue_style('style', get_template_directory_uri() . '/scss/dist/style-min.css', array(), $style_ver);

	//PROD
	//wp_enqueue_style('style', get_template_directory_uri() . '/scss/dist/style-min.css', array(), true);

	wp_enqueue_script('functions', get_template_directory_uri() . '/js/dist/functions-min.js', array('jquery'), true);

	wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/edc432ff9b.js', array(), null);
}
add_action('wp_enqueue_scripts', 'nova2021_scripts');



/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support('title-tag');



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
function register_my_menus()
{
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
add_action('init', 'register_my_menus');


function add_specific_menu_location_atts($atts, $item, $args)
{
	// check if the item is in the primary menu
	if ($args->theme_location == 'navbar') {
		// add the desired attributes:
		$atts['class'] = "nav-link";
	}
	if ($args->theme_location == 'fullscreen_menu') {
		// add the desired attributes:
		$atts['class'] = "fullscreen_menu-item";
	}
	return $atts;
}
add_filter('nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3);


/**
 * Create my custom menus
 */
// custom menu example @ https://digwp.com/2011/11/html-formatting-custom-menus/
// https://wordpress.stackexchange.com/questions/228947/get-css-class-of-menu-item-in-custom-menu-structure
// https://stackoverflow.com/questions/10019493/adding-class-current-page-item

function navbar_custom_menu()
{
	$menu_name = 'navbar'; // specify custom menu slug
	if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);

		$menu_list = '<div class="collapse navbar-collapse">' . "\n";
		$menu_list .= "\t\t\t\t" . '<ul class="navbar-nav mr-auto ml-auto">' . "\n";
		foreach ((array) $menu_items as $key => $menu_item) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			$class = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($menu_item->classes), $menu_item)));
			$active = ($menu_item->object_id == get_queried_object_id()) ? 'active' : '';

			$menu_list .= "\t\t\t\t\t" . '<li class="nav-item ' . $active . '"><a class="nav-link" href="' . $url . '"><div class="active_highlight"><i class="fad ' . $class . '"></i><span>' . $title . '</span></div></a></li>' . "\n";
		}
		$menu_list .= "\t\t\t\t" . '</ul>' . "\n";
		$menu_list .= "\t\t\t" . '</div>' . "\n";
	} else {
		// $menu_list = '<!-- no list defined -->';
	}
	echo $menu_list;
}

function fullscreen_custom_menu()
{
	$menu_name = 'fullscreen_menu'; // specify custom menu slug
	if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);

		$menu_list = "\t\t\t\t" . '<ul>' . "\n";
		foreach ((array) $menu_items as $key => $menu_item) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			$class = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($menu_item->classes), $menu_item)));
			$active = ($menu_item->object_id == get_queried_object_id()) ? 'active' : '';

			$menu_list .= "\t\t\t\t\t" . '<li class="' . $active . '"><a href="' . $url . '">' . $title . '</a></li>' . "\n";
		}
		$menu_list .= "\t\t\t\t" . '</ul>' . "\n";
	} else {
		// $menu_list = '<!-- no list defined -->';
	}
	echo $menu_list;
}








// registration code for LOCAIS post type
function register_locais_posttype()
{
	$labels = array(
		'name' 				=> _x('Locais', 'post type general name'),
		'singular_name'		=> _x('Local', 'post type singular name'),
		'add_new' 			=> __('Novo local'),
		'add_new_item' 		=> __('Local'),
		'edit_item' 		=> __('Local'),
		'new_item' 			=> __('Local'),
		'view_item' 		=> __('Local'),
		'search_items' 		=> __('Local'),
		'not_found' 		=> __('Local'),
		'not_found_in_trash' => __('Local'),
		'parent_item_colon' => __(''),
		'menu_name'			=> __('Locais')
	);

	$supports = array('title', 'editor', 'thumbnail');

	$post_type_args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Local'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'publicly_queryable' => true,
		'query_var'			=> true,
		'exclude_from_search' => false,
		'show_in_nav_menus'	=> true,
		'capability_type' 	=> 'post',
		'has_archive' 		=> 'locais',
		'hierarchical' 		=> false,
		'rewrite' 			=> array('slug' => 'local', 'with_front' => true),
		'supports' 			=> $supports,
		'menu_position' 	=> 4,
		'menu_icon' 		=> 'dashicons-admin-site',
		'taxonomies'		=> false,
		'show_in_rest'		=> true
	);
	register_post_type('locais', $post_type_args);
}
add_action('init', 'register_locais_posttype');










/*
 * SET SPLASH SCREEN SHORTCODE [splash-screen]
 */
function splash_screen()
{
	ob_start(); ?>

	<div class="splash_screen">
		<div class="container">
			<h1 class="tagline">
				<span>Uma família integrada, que se ama e apoia em todos os momentos.<span>
			</h1>
			<a href="/sobre" class="btn btn-lg btn-danger">Quero saber mais</a>
		</div>
	</div>

<?php
	$output = ob_get_contents();
	ob_end_clean();
	return  $output;
}
add_shortcode('splash-screen', 'splash_screen');



/*
 * SET LATEST MESSAGE SHORTCODE [latest-message]
 */
function latest_message()
{
	ob_start(); ?>

	<div class="latest_message">
		<div class="container">
			<h3>
				<span>Vídeo desta semana<span>
			</h3>
			<a class="card" href="/play">
				<i class="fad fa-play"></i>
				<h2>Nascidos e chamados com propósito</h2>
			</a>
			<a href="/play" class="btn btn-link">Mais conteúdos <i class="fal fa-long-arrow-right"></i></a>
		</div>
	</div>

<?php
	$output = ob_get_contents();
	ob_end_clean();
	return  $output;
}
add_shortcode('latest-message', 'latest_message');



/*
 * SET MAURICIO E DENISE SHORTCODE [mauricio-denise]
 */
function mauricio_denise()
{
	ob_start(); ?>

	<div class="mauricio_denise container-fluid">
		<div class="row align-items-center">

			<div class="fragales_pic col-lg"></div>

			<div class="fragales_titles col-lg">
				<div class="container">
					<h4>
						<span>“O que mais nos inspira é ver pessoas alcançando o potencial que Deus às deu.”<span>
					</h4>
					<div class="row align-items-center">
						<div class="col-sm">
							<h6>Mauricio & Denise Fragale</h6>
							<p><small>Pastores Sêniores da Nova</small></p>
						</div>
						<div class="col-sm">
							<a href="/play" class="btn btn-dark">Mais <i class="fal fa-long-arrow-right"></i></a>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>

<?php
	$output = ob_get_contents();
	ob_end_clean();
	return  $output;
}
add_shortcode('mauricio-denise', 'mauricio_denise');