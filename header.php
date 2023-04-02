<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;800&display=swap" rel="stylesheet"> -->

	<?php wp_head(); ?>

</head>






<body <?php body_class(); ?>>
	<style>
		body.admin-bar #header .navbar.fixed-top {
			top: 32px;
		}

		@media only screen and (max-width: 782px) {
			body.admin-bar #header .navbar.fixed-top {
				top: 46px;
			}
		}

		#header {
			margin-bottom: <?php echo get_theme_mod('your_theme_paddingtop'); ?>px;
		}
	</style>

	<?php if (empty($_GET['novaapp'])) {

	?>

		<!-- Header -->
		<header id="header">

			<nav class="navbar fixed-top navbar-expand <?php if (get_theme_mod('your_navbar_color') == "light") {
															echo "navbar-light bg-light";
														} else {
															echo "navbar-dark bg-dark";
														}
														?>">
				<div class="<?php if (get_theme_mod('your_navbar_container')) {
								echo "container";
							} else {
								echo "container-fluid";
							}
							?>">

					<!-- Logo -->
					<a class="navbar-brand" href="<?php echo get_site_url(); ?>" style="width: <?php echo get_theme_mod('your_theme_logo_width'); ?>px">
						<?php
						// check to see if the logo exists and add it to the page
						if (get_theme_mod('your_theme_logo')) : ?>

							<?php echo wp_get_attachment_image(get_theme_mod('your_theme_logo'), 'full'); ?>

						<?php // add a fallback if the logo doesn't exist
						else : ?>

							<h1 class="site-title"><?php bloginfo('name'); ?></h1>

						<?php endif; ?>

					</a>

					<!-- Menu principal -->
					<?php get_template_part('template-parts/menus/navbar-menu'); ?>


					<!-- FULL SCREEN MENU TOGGLE BUTTON -->

					<?php if (wp_get_nav_menu_items(get_nav_menu_locations()['fullscreen_menu'])) : ?>
						<div class="hamburger">
							<span class="line"></span>
							<span class="line"></span>
						</div>
					<?php endif; ?>

				</div>

				<!-- Menu secundário -->
				<?php get_template_part('template-parts/menus/secondary-navbar-menu'); ?>

			</nav>

			<!-- FULL SCREEN MENU -->
			<?php get_template_part('template-parts/menus/fullscreen-menu'); ?>

		</header>

	<?php }	?>