<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<!-- 
	<header> 
		<i class="fas fa-planet-ringed"></i>
	</header>
 -->



	<!-- 	Header  -->
	<nav class="navbar fixed-top navbar-expand navbar-light bg-light">


		<!-- Logo -->
		<a class="navbar-brand" href="/">
			<img id="logo" src="<?php echo get_template_directory_uri(); ?>/img_placeholders/nova.png" width="60" title="Nova" class="d-inline-block align-top" />
		</a>


		<!-- Menu principal -->
		<?php if (function_exists(clean_custom_menus())) clean_custom_menus(); ?>


		<!-- Button que abre e fecha o menu lateral -->
		<div class="hamburger nav-toggle" id="hamburger-4">
			<span class="line"></span>
			<span class="line"></span>
			<span class="line"></span>
		</div>



	</nav>