<?php

define( 'SHOW_GLOBAL_NAV', false );

/**
 * Include theme files
 *
 * Based off of how Largo loads files: https://github.com/INN/Largo/blob/master/functions.php#L358
 *
 * 1. hook function Largo() on after_setup_theme
 * 2. function Largo() runs Largo::get_instance()
 * 3. Largo::get_instance() runs Largo::require_files()
 *
 * This function is intended to be easily copied between child themes, and for that reason is not prefixed with this child theme's normal prefix.
 *
 * @link https://github.com/INN/Largo/blob/master/functions.php#L145
 */
function largo_child_require_files() {

	$includes = array(
		'/inc/enqueue.php',
		'/inc/private_content_sharing_shortcode.php',
		// homepage
		'/homepages/layout.php',
	);

	foreach ( $includes as $include ) {
		require_once( get_stylesheet_directory() . $include );
	}
	
}
add_action( 'after_setup_theme', 'largo_child_require_files' );

register_nav_menu('main-nav-bottom', 'Main Navigation Bottom');
