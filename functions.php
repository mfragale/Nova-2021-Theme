<?php 


// Remove Block Library CSS - https://designsmaz.com/how-to-remove-block-library-css-from-wordpress/
function dm_remove_wp_block_library_css(){
	wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'dm_remove_wp_block_library_css' );


// Remove wp-embed.min.js - https://wordpress.stackexchange.com/questions/211701/what-does-wp-embed-min-js-do-in-wordpress-4-4
function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );


// Disable XML-RPC RSD link from WordPress Header - https://crunchify.com/how-to-clean-up-wordpress-header-section-without-any-plugin/
remove_action ('wp_head', 'rsd_link');


// Remove WordPress version number - https://crunchify.com/how-to-clean-up-wordpress-header-section-without-any-plugin/
function crunchify_remove_version() {
	return '';
}
add_filter('the_generator', 'crunchify_remove_version');



// Remove wlwmanifest link - https://crunchify.com/how-to-clean-up-wordpress-header-section-without-any-plugin/
remove_action( 'wp_head', 'wlwmanifest_link');


// Remove shortlink
remove_action( 'wp_head', 'wp_shortlink_wp_head');


// Remove api.w.org relation link - https://crunchify.com/how-to-clean-up-wordpress-header-section-without-any-plugin/
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);




?>