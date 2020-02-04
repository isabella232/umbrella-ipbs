<?php
/**
 * The Template for displaying all single posts.
 */

$template = of_get_option( 'single_template' );
switch ( $template ) {
	case 'single-ipbs.php':
		get_template_part( 'single-ipbs' );
		break;
	case 'classic':
		get_template_part( 'single-two-column' );
		break;
	default:
		get_template_part( 'single-one-column' );
}
