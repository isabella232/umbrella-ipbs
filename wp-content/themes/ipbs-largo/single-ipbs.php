<?php
/**
 * Single Post Template: IPBS Right-Offset Column
 * Template Name: IPBS Right-Offset Column
 * Description: Left-aligned blocks appear on the left in their own column
 *
 * This uses partials/content-ipbs.php for both pages and posts.
 * @since Largo 0.6.4
 */

global $shown_ids;

add_filter( 'body_class', function( $classes ) {
	$classes[] = 'single-ipbs';
	return $classes;
} );

get_header();
?>

<div id="content" role="main">
	<?php
		while ( have_posts() ) : the_post();

			$shown_ids[] = get_the_ID();

			$partial = ( is_page() ) ? 'page' : 'single';

			echo '<h1>SINGLE LEFT BLOCK COLUMN</h1>';

			get_template_part( 'partials/content', 'ipbs' );

			if ( $partial === 'single' ) {

				do_action( 'largo_before_post_bottom_widget_area' );

				do_action( 'largo_post_bottom_widget_area' );

				do_action( 'largo_after_post_bottom_widget_area' );

				do_action( 'largo_before_comments' );

				comments_template( '', true );

				do_action( 'largo_after_comments' );
			}

		endwhile;
	?>
</div>

<?php do_action( 'largo_after_content' ); ?>

<?php get_footer();
