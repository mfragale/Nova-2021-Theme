<?php

/**
 * Enqueue scripts and styles.
 */
function nova2021_scripts() {

	wp_enqueue_style( 'bootstrap-style', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css', false );
	
	wp_enqueue_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js', array('jquery'), true );
	
	wp_enqueue_script( 'bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js', array('jquery'), true );
			
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/scss/dist/style.min.css', false);
									
	wp_enqueue_script( 'functions', get_template_directory_uri() . '/js/dist/functions.prod.js', array('jquery'), true );

}
add_action( 'wp_enqueue_scripts', 'nova2021_scripts' );


?>