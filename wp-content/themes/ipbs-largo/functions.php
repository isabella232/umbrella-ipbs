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
		'/inc/block-color-palette.php',
		'/inc/post-templates.php',
		// homepage
		'/homepages/layout.php',
		// widgets
		'/inc/class-ipbs-member-map-widget.php',
		'/inc/class-ipbs-member-stations-widget.php',
		// blocks and modifications
		'/blocks/core-group.php',
	);

	foreach ( $includes as $include ) {
		require_once( get_stylesheet_directory() . $include );
	}
	
}
add_action( 'after_setup_theme', 'largo_child_require_files' );

register_nav_menu('main-nav-bottom', 'Main Navigation Bottom');

/**
 * Add a custom archive partial for the jobs CPT
 * 
 * @param str $partial Required, the default partial in this context
 * @param str $post_type Required, the given post’s post type
 * @param str $context Required, the context of this partial
 * 
 * @return @partial The default partial for this context
 */
function add_ipbs_jobs_custom_partial( $partial, $post_type, $context ) {

	if( 'job' === $post_type ) {
		if( 'archive' === $context ) {
			$partial = 'archive-job';
		}
	}
	return $partial;
	
}
add_filter( 'largo_partial_by_post_type', 'add_ipbs_jobs_custom_partial', 10, 3 );

/**
 * Update the default 'Jobs' title for the jobs CPT archive
 * 
 * @param str $title The archive title
 * 
 * @return str $title The archive title
 */
function update_ipbs_jobs_archive_title( $title ){

	$title = 'Employment Opportunities';
	return $title;

}
add_filter( 'largo_archive_job_title', 'update_ipbs_jobs_archive_title' );