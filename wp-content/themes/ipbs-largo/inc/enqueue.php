<?php
/**
 * Enqueue specific styles and scripts for SFPP child theme
 */
function ipbs_enqueue_styles(){
	wp_enqueue_style(
		'largo-child-styles',
		get_stylesheet_directory_uri() . '/css/child-style.css',
		null,
		filemtime( get_stylesheet_directory() . '/css/child-style.css' )
	);
	// fonts
	wp_enqueue_style(
		'inter',
		'https://rsms.me/inter/inter.css'
	);
	wp_enqueue_style(
		'typekit',
		'https://use.typekit.net/wzh8ith.css'
	);
}
add_action( 'wp_enqueue_scripts', 'ipbs_enqueue_styles' );
