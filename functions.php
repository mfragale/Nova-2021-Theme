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




// registration code for MENSAGENS post type
function register_mensagens_posttype()
{
	$labels = array(
		'name' 				=> _x('Mensagens', 'post type general name'),
		'singular_name'		=> _x('Mensagem', 'post type singular name'),
		'add_new' 			=> __('Adicionar'),
		'add_new_item' 		=> __('Adicionar item'),
		'edit_item' 		=> __('Editar item'),
		'new_item' 			=> __('Novo item'),
		'view_item' 		=> __('Ver item'),
		'search_items' 		=> __('Buscar itens'),
		'not_found' 		=> __('Não encontrado'),
		'not_found_in_trash' => __('Não encontrado no lixo'),
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





// registration code for GERACAO_NOVA post type
function register_geracao_nova_posttype()
{
	$labels = array(
		'name' 				=> _x('Geração Nova', 'post type general name'),
		'singular_name'		=> _x('Geração Nova', 'post type singular name'),
		'add_new' 			=> __('Adicionar'),
		'add_new_item' 		=> __('Adicionar item'),
		'edit_item' 		=> __('Editar item'),
		'new_item' 			=> __('Novo item'),
		'view_item' 		=> __('Ver item'),
		'search_items' 		=> __('Buscar itens'),
		'not_found' 		=> __('Não encontrado'),
		'not_found_in_trash' => __('Não encontrado no lixo'),
		'parent_item_colon' => __(''),
		'menu_name'			=> __('Geração Nova')
	);

	$supports = array('title', 'editor', 'excerpt', 'thumbnail');

	$post_type_args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Geração Nova'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'publicly_queryable' => true,
		'query_var'			=> true,
		'exclude_from_search' => false,
		'show_in_nav_menus'	=> true,
		'capability_type' 	=> 'post',
		'has_archive' 		=> false,
		'hierarchical' 		=> false,
		'rewrite' 			=> array('slug' => 'gn', 'with_front' => true),
		'supports' 			=> $supports,
		'menu_position' 	=> 4,
		'menu_icon' 		=> 'dashicons-universal-access',
		'taxonomies'		=> false,
		'show_in_rest'		=> true
	);
	register_post_type('geracao_nova', $post_type_args);
}
add_action('init', 'register_geracao_nova_posttype');







// registration code for NOVA_MUSIC post type
function register_nova_music_posttype()
{
	$labels = array(
		'name' 				=> _x('Nova Music', 'post type general name'),
		'singular_name'		=> _x('Nova Music', 'post type singular name'),
		'add_new' 			=> __('Adicionar'),
		'add_new_item' 		=> __('Adicionar item'),
		'edit_item' 		=> __('Editar item'),
		'new_item' 			=> __('Novo item'),
		'view_item' 		=> __('Ver item'),
		'search_items' 		=> __('Buscar itens'),
		'not_found' 		=> __('Não encontrado'),
		'not_found_in_trash' => __('Não encontrado no lixo'),
		'parent_item_colon' => __(''),
		'menu_name'			=> __('Nova Music')
	);

	$supports = array('title', 'editor', 'excerpt', 'thumbnail');

	$post_type_args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Nova Music'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'publicly_queryable' => true,
		'query_var'			=> true,
		'exclude_from_search' => false,
		'show_in_nav_menus'	=> true,
		'capability_type' 	=> 'post',
		'has_archive' 		=> false,
		'hierarchical' 		=> false,
		'rewrite' 			=> array('slug' => 'music', 'with_front' => true),
		'supports' 			=> $supports,
		'menu_position' 	=> 4,
		'menu_icon' 		=> 'dashicons-format-audio',
		'taxonomies'		=> false,
		'show_in_rest'		=> true
	);
	register_post_type('nova_music', $post_type_args);
}
add_action('init', 'register_nova_music_posttype');












/*
 * SET SPLASH SCREEN SHORTCODE [splash-screen]
 */
function splash_screen($atts)
{
	ob_start();

	extract(shortcode_atts(array(
		'imagem' => '',
		'imagem_mobile' => '',
		'texto' => '',
		'texto_botao' => '',
		'link_botao' => '',
	), $atts));

?>

	<div class="splash_screen" style="background-image: url(<?php echo $imagem; ?>);">
		<img class="d-sm-none" src="<?php echo $imagem_mobile; ?>" alt="">

		<div class="container">
			<h1 class="tagline">
				<span><?php echo $texto; ?><span>
			</h1>
			<a href="<?php echo $link_botao; ?>" class="btn btn-lg btn-danger"><?php echo $texto_botao; ?></a>
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
	ob_start();

	$args = array(
		'post_type' => 'mensagens'
	);

	$loop = new WP_Query($args);
?>

	<?php if ($loop->have_posts()) : $loop->the_post(); ?>

		<div class="latest_message">
			<div class="container">
				<h3>
					<span>Vídeo desta semana<span>
				</h3>
				<a class="card" href="<?php the_permalink(); ?>" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
					<i class="fad fa-play"></i>
					<h2><?php the_title(); ?></h2>
				</a>
				<a href="<?php echo get_site_url(); ?>/play" class="btn btn-link">Mais conteúdos <i class="fal fa-long-arrow-right"></i></a>
			</div>
		</div>

		<?php wp_reset_postdata(); ?>

	<?php else : ?>
		<p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif;

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
							<a href="/play" class="btn btn-light">Mais <i class="fal fa-long-arrow-right"></i></a>
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
 * SET SECTION THUMB LIST SHORTCODE [section-thumb-list]
 */
function section_thumb_list($atts)
{
	ob_start();

	extract(shortcode_atts(array(
		'hero' => '',
		'items' => '9',
		'bg' => '#161720',
		'post_type' => 'mensagens',
		'nome' => 'Mensagens',
		'youtube_link' => '',
		'spotify_link' => ''
	), $atts));

	$args = array(
		'post_type' => $post_type,
		'post_count' => $items
	);

	$loop = new WP_Query($args);
?>

	<?php if ($loop->have_posts()) : if ($post_type == 'mensagens') {
			$loop->the_post();
		} ?>

		<div class="section <?php echo $post_type; ?>">

			<?php if ($hero) { ?>

				<div class="section_hero" style="background-color: <?php echo $bg; ?>">

					<?php if ($post_type == 'mensagens') { ?>

						<img src="<?php the_post_thumbnail_url(); ?>" />

						<a href="<?php the_permalink(); ?>">
							<div class="mb-3">
								<div class="badge badge-danger">Mais recente</div>
							</div>
							<h2 class="mb-3"><?php the_title(); ?></h2>
							<div><button type="button" class="btn btn-light btn-lg"><i class="fad fa-play-circle"></i> Play</button></div>
						</a>

					<?php } else { ?>

						<img src="<?php echo $hero; ?>" />

					<?php } ?>

				</div>

			<?php } ?>

			<div class="section_thumb_list">
				<!-- the loop -->
				<?php while ($loop->have_posts()) : $loop->the_post();
					global $post; ?>


					<a href="<?php the_permalink(); ?>">
						<img src="<?php the_post_thumbnail_url('medium'); ?>">
						<h3><?php the_title(); ?></h3>
					</a>


				<?php endwhile; ?>
				<!-- end of the loop -->
			</div>

			<?php if ($youtube_link || $spotify_link) { ?>
				<div class="section_btn" style="background-color: <?php echo $bg; ?>">
					<!-- Action Sheet Trigger -->
					<button type="button" class="btn btn-link" data-toggle="modal" data-target="#<?php echo $post_type; ?>_action_sheet">Mais da <?php echo $nome; ?> <i class="fad fa-external-link-alt"></i></button>

					<!-- Action Sheet Options -->
					<div class="modal fade action_sheet" id="<?php echo $post_type; ?>_action_sheet" tabindex="-1" role="dialog" aria-labelledby="action_sheet">
						<div class="modal-dialog" role="document">
							<div class="modal-content">

								<div class="modal-body">
									<div class="btn-group-vertical mb-2 pt-1">
										<p class="mb-1 text-muted"><small>Escolha a plataforma</small></p>

										<?php if ($youtube_link) { ?>
											<a target="_blank" href="<?php echo $youtube_link; ?>" type="button" class="btn btn-light btn-lg btn-block"><span class="text-primary"><i class="fab fa-youtube"></i> YouTube</span></a>
										<?php } ?>
										<?php if ($spotify_link) { ?>
											<a target="_blank" href="<?php echo $spotify_link; ?>" type="button" class="btn btn-light btn-lg btn-block"><span class="text-primary"><i class="fab fa-spotify"></i> Spotify</span></a>
										<?php } ?>
									</div>

									<button type="button" class="btn btn-light btn-lg btn-block" data-dismiss="modal"><span class="text-primary">Cancelar</span></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

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
add_shortcode('section-thumb-list', 'section_thumb_list');












/*
 * SET LOCAIS SHORTCODE [locais]
 */
function locais()
{
	ob_start();

	$args = array(
		'post_type' => 'locais',
		'order' => 'ASC'
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
