<?php
/**
 * Displays the member map, and enqueues the relevant assets.
 */

$path = get_stylesheet_directory() . '/images/map.svg';

wp_register_style(
	'ipbs-map-css',
	get_stylesheet_directory_uri() . '/css/map.css',
	null,
	filemtime( get_stylesheet_directory() . '/css/map.css' )
);
wp_register_script(
	'ipbs-map-animate-dependency',
	'https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.js',
	array( 'jquery' ),
	false,
	true
);
wp_register_script(
	'ipbs-map-animate',
	get_stylesheet_directory_uri() . '/js/animate.js',
	array(
		'ipbs-map-animate-dependency',
	),
	filemtime( get_stylesheet_directory() . '/js/animate.js' ),
	true
);

wp_enqueue_script( 'ipbs-map-animate-dependency' );
wp_enqueue_script( 'ipbs-map-animate' );
wp_enqueue_style( 'ipbs-map-css' );

echo file_get_contents( $path );
