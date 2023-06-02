<?php

// add theme thumbnail support
add_theme_support('post-thumbnails');


// Disable two-factor authentication enforcement - https://docs.wpvip.com/technical-references/restricting-site-access/two-factor-authentication/
add_filter('wpcom_vip_is_two_factor_forced', '__return_false');


/**
 * Enqueue scripts and styles.
 */
function nova_scripts()
{

	$theme = wp_get_theme();
	$ver = $theme->get('Version');
	$themecsspath = get_stylesheet_directory() . '/style.css';
	$style_ver = filemtime($themecsspath);

	wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js', array('jquery'), true);

	wp_enqueue_script('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js', array('jquery'), true);

	//DEV
	wp_enqueue_style('nova-style', get_template_directory_uri() . '/scss/dist/style-min.css', array(), $style_ver);


	//PROD
	//wp_enqueue_style('style', get_template_directory_uri() . '/scss/dist/style-min.css', array(), true);

	wp_enqueue_script('nova-functions', get_template_directory_uri() . '/js/dist/functions-min.js', array('jquery'), true);

	wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/edc432ff9b.js', array(), null);
}
add_action('wp_enqueue_scripts', 'nova_scripts');



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
			'secondary_navbar' => 'Secondary Navbar'
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
	if ($args->theme_location == 'secondary_navbar') {
		// add the desired attributes:
		$atts['class'] = "secondary_navbar-link";
	}
	if ($args->theme_location == 'fullscreen_menu') {
		// add the desired attributes:
		$atts['class'] = "fullscreen_menu-item";
	}
	return $atts;
}
add_filter('nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3);










/**
 * Create Logo Setting and Upload Control - https://getflywheel.com/layout/how-to-add-options-to-the-wordpress-customizer/
 */
function your_theme_new_customizer_settings($wp_customize)
{

	// Add Header Section
	$wp_customize->add_section('your_theme_header', array(
		'title' => 'Header',
		'description' => '',
		'priority' => 120,
	));


	// add a setting for the site logo
	$wp_customize->add_setting('your_theme_logo');
	// Add a control to upload the logo
	$wp_customize->add_control(new WP_Customize_Media_Control(
		$wp_customize,
		'your_theme_logo',
		array(
			'label' => 'Upload Logo',
			'section' => 'your_theme_header',
			'settings' => 'your_theme_logo',
		)
	));

	// add a setting for the site logo width
	$wp_customize->add_setting('your_theme_logo_width');
	// Add a control to upload the logo width
	$wp_customize->add_control(new WP_Customize_Media_Control(
		$wp_customize,
		'your_theme_logo_width',
		array(
			'type' => 'number',
			'label' => 'Logo width (px)',
			'section' => 'your_theme_header',
			'settings' => 'your_theme_logo_width',
		)
	));

	// add a setting for the site logo width
	$wp_customize->add_setting('your_theme_paddingtop');
	// Add a control to upload the logo width
	$wp_customize->add_control(new WP_Customize_Media_Control(
		$wp_customize,
		'your_theme_paddingtop',
		array(
			'type' => 'number',
			'label' => 'Padding top (px)',
			'section' => 'your_theme_header',
			'settings' => 'your_theme_paddingtop',
		)
	));


	// add a setting for the site navbar
	$wp_customize->add_setting('your_navbar_color');
	// Add a control to choose navbar color
	$wp_customize->add_control(
		'your_navbar_color',
		array(
			'type' => 'select',
			'label' => 'Navbar color',
			'section' => 'your_theme_header',
			'settings' => 'your_navbar_color',
			'choices' => array(
				'dark' => __('Dark'),
				'light' => __('Light'),
			),
		)
	);



	// add a setting for the site navbar
	$wp_customize->add_setting('your_navbar_alignment');
	// Add a control to choose navbar alignment
	$wp_customize->add_control(
		'your_navbar_alignment',
		array(
			'type' => 'select',
			'label' => 'Navbar alignment',
			'section' => 'your_theme_header',
			'settings' => 'your_navbar_alignment',
			'choices' => array(
				'center' => __('Center'),
				'left' => __('Left'),
				'right' => __('Right'),
			),
		)
	);

	// add a setting for the site navbar
	$wp_customize->add_setting('your_navbar_container');
	// Add a control to choose navbar container
	$wp_customize->add_control(
		'your_navbar_container',
		array(
			'type' => 'checkbox',
			'label' => 'Add container',
			'section' => 'your_theme_header',
			'settings' => 'your_navbar_container',
		)
	);



	// Add Footer Section
	$wp_customize->add_section('your_theme_footer', array(
		'title' => 'Footer',
		'description' => '',
		'priority' => 120,
	));
	// add a setting for the site footer
	$wp_customize->add_setting('your_footer_visibility');
	// Add a control to upload the logo
	$wp_customize->add_control(
		'your_footer_visibility',
		array(
			'type' => 'checkbox',
			'label' => 'Hide Footer',
			'section' => 'your_theme_footer',
			'settings' => 'your_footer_visibility',
		)
	);

	// add a setting for the site footer
	$wp_customize->add_setting('your_footer_info');
	// Add a control
	$wp_customize->add_control(
		'your_footer_info',
		array(
			'label' => 'Footer info',
			'section' => 'your_theme_footer',
			'settings' => 'your_footer_info',
		)
	);
}
add_action('customize_register', 'your_theme_new_customizer_settings');



/**
 * Check if menu item has submenu items - https://gist.github.com/bolante93/a9a15688ed0e7e746a93da712ed54241
 */

function has_sub_menu(string $menu_location, int $id)
{
	//Get proper menu
	$menuLocations = get_nav_menu_locations();
	$menuID = $menuLocations[$menu_location];
	$menu_items = wp_get_nav_menu_items($menuID);

	//Go through and see if this is a parent
	foreach ($menu_items as $menu_item) {
		if ((int)$menu_item->menu_item_parent === $id) {
			return true;
		}
	}
	return false;
}



//Limit subscriber to have only ONE session at a time.
//https://sleeksoft.in/limit-only-one-session-per-user-wordpress/
function check_user_other_sessions()
{
	//Get current user who is logged in
	$user = wp_get_current_user();

	//Check if user's role is subscriber
	if (in_array('novaconf2023online', $user->roles)) {
		//Get current user's session
		$sessions = WP_Session_Tokens::get_instance($user->ID);

		//Get all his active wordpress sessions
		$all_sessions = $sessions->get_all();

		//If there is more than one session then destroy all other sessions except the current session.
		if (count($all_sessions) > 1) {
			$sessions->destroy_others(wp_get_session_token());
		}
	}
}
add_action('init', 'check_user_other_sessions', 99);


// <img id="gform_ajax_spinner_10"  class="gform_ajax_spinner" src="https://nova2021.dev/wp-content/plugins/gravityforms/images/spinner.svg" alt="" />