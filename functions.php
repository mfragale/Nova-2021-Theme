<?php

// add theme thumbnail support
add_theme_support('post-thumbnails');


/**
 * Enqueue scripts and styles.
 */
function nova2021_scripts()
{

	$theme = wp_get_theme();
	$ver = $theme->get('Version');
	$themecsspath = get_stylesheet_directory() . '/style.css';
	$style_ver = filemtime($themecsspath);

	wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js', array('jquery'), true);

	wp_enqueue_script('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js', array('jquery'), true);

	//DEV
	wp_enqueue_style('nova2021-style', get_template_directory_uri() . '/scss/dist/style-min.css', array(), $style_ver);


	//PROD
	//wp_enqueue_style('style', get_template_directory_uri() . '/scss/dist/style-min.css', array(), true);

	wp_enqueue_script('nova2021-functions', get_template_directory_uri() . '/js/dist/functions-min.js', array('jquery'), true);

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






// registration code for LOCAIS post type
function register_locais_posttype()
{
	$labels = array(
		'name' 				=> _x('Locais', 'post type general name'),
		'singular_name'		=> _x('Local', 'post type singular name'),
		'add_new' 			=> __('Adicionar'),
		'add_new_item' 		=> __('Adicionar item'),
		'edit_item' 		=> __('Editar item'),
		'new_item' 			=> __('Novo item'),
		'view_item' 		=> __('Ver item'),
		'search_items' 		=> __('Buscar itens'),
		'not_found' 		=> __('Não encontrado'),
		'not_found_in_trash' => __('Não encontrado no lixo'),
		'parent_item_colon' => __(''),
		'menu_name'			=> __('Locais')
	);

	$supports = array('title', 'editor', 'excerpt', 'thumbnail');

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
		'has_archive' 		=> false,
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
 * SET LOCAIS SHORTCODE [locais]
 */
function locais()
{
	ob_start();

	$args = array(
		'post_type' => 'locais',
		'order' => 'ASC',
		'posts_per_page' => -1
	);

	$loop = new WP_Query($args);

?>

	<?php if ($loop->have_posts()) : ?>

		<div class="locais">
			<div class="container-fluid">
				<div class="row">




					<div class="col-12 col-md-4">
						<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

							<!-- the loop -->
							<?php while ($loop->have_posts()) : $loop->the_post();
								global $post; ?>

								<a class="nav-link" id="<?php echo $post->post_name; ?>-tab" data-bs-toggle="pill" data-bs-target="#<?php echo $post->post_name; ?>" href="#<?php echo $post->post_name; ?>" role="tab" aria-controls="<?php echo $post->post_name; ?>" aria-selected="<?php if (!get_next_post_link()) {
																																																																							echo 'true';
																																																																						} ?>">
									<div class="row align-items-center">
										<div class="col-3">
											<img class="img-fluid mx-auto d-block" src="<?php the_post_thumbnail_url('thumbnail'); ?>">
										</div>
										<div class="col-7">
											<h1><?php the_title(); ?></h1>
											<?php if (get_the_excerpt()) {
												the_excerpt();
											} ?>
										</div>
										<div class="col-2 text-right"><i class="fal fa-angle-right"></i></div>
									</div>
								</a>

							<?php endwhile; ?>
							<!-- end of the loop -->

						</div>
					</div>



					<div class="col-12 col-md-8 tab-wrap">
						<div class="tab-content" id="v-pills-tabContent">

							<div class="tab-pane fade show active text-center" id="noLocalSelected" role="tabpanel" aria-labelledby="noLocalSelected-tab">
								<div class="row h-100">
									<div class="col-sm-12 my-auto">
										<i class="fad fa-map-marked-alt"></i>
										<p>Selecione um campus</p>
									</div>
								</div>
							</div>

							<!-- the loop -->
							<?php while ($loop->have_posts()) : $loop->the_post();
								global $post; ?>

								<div class="tab-pane fade" id="<?php echo $post->post_name; ?>" role="tabpanel" aria-labelledby="<?php echo $post->post_name; ?>-tab">


									<h1>
										<a class="btn btn-link closeLocal d-block d-md-none" id="noLocalSelected-tab" data-toggle="tab" href="#noLocalSelected" role="tab" aria-controls="noLocalSelected" aria-selected="true"><i class="fa fa-chevron-left"></i></a>
										<?php the_title(); ?>
									</h1>

									<div class="local-wrap">
										<?php the_content(); ?>
									</div>
								</div>

							<?php endwhile; ?>
							<!-- end of the loop -->

						</div>
					</div>



				</div>
			</div>
		</div>


		<!-- pagination here -->

		<?php wp_reset_postdata(); ?>

	<?php else : ?>
		<p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif;



	$output = ob_get_contents();
	ob_end_clean();
	return  $output;
}
add_shortcode('locais', 'locais');








function misha_my_load_more_scripts() //https://rudrastyh.com/wordpress/load-more-posts-ajax.html
{

	global $wp_query;

	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script('nova2021-functions', 'misha_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode($wp_query->query_vars), // everything about your loop is here
		'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	));
}
add_action('wp_enqueue_scripts', 'misha_my_load_more_scripts');

function misha_loadmore_ajax_handler()
{

	// prepare our arguments for the query
	$args = json_decode(stripslashes($_POST['query']), true);
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';

	// it is always better to use WP_Query but not here
	query_posts($args);

	get_template_part('template-parts/posts/post-content');

	die; // here we exit the script and even no wp_reset_query() required!
}
add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}




/**
 * Create Logo Setting and Upload Control - https://getflywheel.com/layout/how-to-add-options-to-the-wordpress-customizer/
 */
function your_theme_new_customizer_settings($wp_customize)
{
	// add a setting for the site logo
	$wp_customize->add_setting('your_theme_logo');
	// Add a control to upload the logo
	$wp_customize->add_control(new WP_Customize_Media_Control(
		$wp_customize,
		'your_theme_logo',
		array(
			'label' => 'Upload Logo',
			'section' => 'title_tagline',
			'settings' => 'your_theme_logo',
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
			'section' => 'title_tagline',
			'settings' => 'your_navbar_color',
			'choices' => array(
				'dark' => __('Dark'),
				'light' => __('Light'),
			),
		)
	);



	// Add Footer Section
	$wp_customize->add_section('your_theme_footer', array(
		'title' => 'Footer',
		'description' => '',
		'priority' => 120,
	));
	// add a setting for the site logo
	$wp_customize->add_setting('your_footer_info');
	// Add a control to upload the logo
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
