<?php


/**
 * Enqueue scripts and styles.
 */
function nova2021_scripts() {
			
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/scss/dist/style.min.css', false);
									
	wp_enqueue_script( 'functions', get_template_directory_uri() . '/js/dist/functions.prod.js', array('jquery'), true );

}
add_action( 'wp_enqueue_scripts', 'nova2021_scripts' );






































?>