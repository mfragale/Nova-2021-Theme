<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;800&display=swap" rel="stylesheet">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<!-- Header -->
	<header id="header">
		<nav class="navbar fixed-top navbar-expand navbar-light bg-light">

			<!-- Logo -->
			<a class="navbar-brand" href="<?php echo get_site_url(); ?>">
				<svg width="60" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 15.43">
					<defs>
						<style>
							.cls-1 {
								fill: #404251;
							}
						</style>
					</defs>
					<path class="cls-1" d="M1493.58,992.28a7.72,7.72,0,1,0,7.72,7.72A7.72,7.72,0,0,0,1493.58,992.28Zm0,11.58a3.86,3.86,0,1,1,3.86-3.86A3.86,3.86,0,0,1,1493.58,1003.86Z" transform="translate(-1470 -992.28)" />
					<path class="cls-1" d="M1470,992.63h3.82l6.07,7.81v-7.81h4v14.77h-3.58l-6.31-8.1v8.1h-4Z" transform="translate(-1470 -992.28)" />
					<polygon class="cls-1" points="43.7 0.39 41.58 4.06 39.46 7.74 37.34 4.06 35.22 0.39 30.98 0.39 35.22 7.74 39.46 15.09 43.7 7.74 47.95 0.39 43.7 0.39" />
					<polygon class="cls-1" points="55.76 7.74 51.52 0.39 47.27 7.74 43.03 15.09 47.27 15.09 49.39 11.41 51.52 7.74 53.64 11.41 55.76 15.09 60 15.09 55.76 7.74" />
				</svg>
			</a>


			<!-- Menu principal -->
			<?php if (function_exists(navbar_custom_menu())) navbar_custom_menu(); ?>


			<!-- FULL SCREEN MENU TOGGLE BUTTON -->
			<div class="hamburger">
				<span class="line"></span>
				<span class="line"></span>
			</div>

		</nav>


		<!-- FULL SCREEN MENU -->
		<nav id="fullscreenmenu">
			<?php if (function_exists(fullscreen_custom_menu())) fullscreen_custom_menu(); ?>
		</nav>
	</header>