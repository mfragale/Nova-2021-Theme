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




// registration code for MENSAGENS post type
function register_mensagens_posttype()
{
	$labels = array(
		'name' 				=> _x('Mensagens', 'post type general name'),
		'singular_name'		=> _x('Mensagem', 'post type singular name'),
		'add_new' 			=> __('Nova Mensagem'),
		'add_new_item' 		=> __('Mensagem'),
		'edit_item' 		=> __('Mensagem'),
		'new_item' 			=> __('Mensagem'),
		'view_item' 		=> __('Mensagem'),
		'search_items' 		=> __('Mensagem'),
		'not_found' 		=> __('Mensagem'),
		'not_found_in_trash' => __('Mensagem'),
		'parent_item_colon' => __(''),
		'menu_name'			=> __('Mensagens')
	);

	$supports = array('title', 'editor', 'excerpt', 'thumbnail');

	$post_type_args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Mensagem'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'publicly_queryable' => true,
		'query_var'			=> true,
		'exclude_from_search' => false,
		'show_in_nav_menus'	=> true,
		'capability_type' 	=> 'post',
		'has_archive' 		=> false,
		'hierarchical' 		=> false,
		'rewrite' 			=> array('slug' => 'mensagem', 'with_front' => true),
		'supports' 			=> $supports,
		'menu_position' 	=> 4,
		'menu_icon' 		=> 'dashicons-video-alt3',
		'taxonomies'		=> false,
		'show_in_rest'		=> true
	);
	register_post_type('mensagens', $post_type_args);
}
add_action('init', 'register_mensagens_posttype');












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
						<span>“O que mais nos inspira é ver pessoas alcançando o potencial que Deus às deu.”</span>
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










/*
 * SET MENSAGENS SHORTCODE [mensagens]
 */
function mensagens()
{
	ob_start();

	$args = array(
		'post_type' => 'mensagens'
	);

	$loop = new WP_Query($args);
?>

	<?php if ($loop->have_posts()) : $loop->the_post(); ?>

		<div class="mensagens">

			<div class="recent_message">
				<video src="https://nova2021.dev/wp-content/themes/Nova-2021-Theme/img_placeholders/Play-original.mp4" autoplay loop playsinline muted></video>
				<a href="/play">
					<h2>Nascidos e chamados com propósito</h2>
					<div><button type="button" class="btn btn-light"><i class="fad fa-play-circle"></i> Play</button></div>
				</a>
			</div>


			<div class="more_messages">
				<div class="more_messages_container">
					<!-- the loop -->
					<?php while ($loop->have_posts()) : $loop->the_post(); ?>


						<a href="<?php the_permalink(); ?>">
							<img src="<?php the_post_thumbnail_url(); ?>">
							<h3><?php the_title(); ?></h3>
						</a>


					<?php endwhile; ?>
					<!-- end of the loop -->
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
add_shortcode('mensagens', 'mensagens');











/*
 * SET LOCAIS SHORTCODE [locais]
 */
function locais()
{
	ob_start();

	$args = array(
		'post_type' => 'locais'
	);

	$loop = new WP_Query($args);

	?>

	<?php if ($loop->have_posts()) : ?>

		<div class="locais">
			<div class="container">

				<!-- the loop -->
				<?php while ($loop->have_posts()) : $loop->the_post(); ?>


					<a href="<?php the_permalink(); ?>">
						<div class="row align-items-center">
							<div class="col-3"><img src="<?php the_post_thumbnail_url(); ?>"></div>
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

		<!-- <div class="local_info">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d909.6455432038415!2d-43.33492431507925!3d-22.998592524446266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9bdc87c943ed9f%3A0x4ef202a53be9425f!2sNova%20Igreja!5e0!3m2!1sen!2sau!4v1597579589853!5m2!1sen!2sau" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
		</div> -->

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
