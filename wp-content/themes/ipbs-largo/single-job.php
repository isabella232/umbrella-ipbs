<?php
/**
 * Job Single Post Template: One Column
 * Template Name: Job One Column
 * Description: Shows the job post content
 */

global $shown_ids;

add_filter( 'body_class', function( $classes ) {
	$classes[] = 'normal';
	return $classes;
} );

get_header();
?>

<div id="content" role="main">
	<?php
		while ( have_posts() ) : the_post();

			$shown_ids[] = get_the_ID();

			$partial = 'single-job';

			get_template_part( 'partials/content', $partial );

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
