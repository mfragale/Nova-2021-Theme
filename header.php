<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;800&display=swap" rel="stylesheet"> -->

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php if (!is_page_template('template-blank-page.php')) { ?>

		<!-- Header -->
		<header id="header">

			<nav class="navbar fixed-top navbar-expand <?php if (get_theme_mod('your_navbar_color') == "light") {
															echo "navbar-light bg-light";
														} else {
															echo "navbar-dark bg-dark";
														}
														?>">
				<div class="container-fluid">

					<!-- Logo -->
					<a class="navbar-brand" href="<?php echo get_site_url(); ?>">
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
					<div class="hamburger">
						<span class="line"></span>
						<span class="line"></span>
					</div>
				</div>
			</nav>

			<!-- FULL SCREEN MENU -->
			<?php get_template_part('template-parts/menus/fullscreen-menu'); ?>

		</header>

	<?php } ?>