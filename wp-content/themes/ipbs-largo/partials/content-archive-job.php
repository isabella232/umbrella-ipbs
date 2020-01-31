<?php
/*
 * The template for displaying jobs CPT archive
 *
 * @package Largo
 */
$args = array (
	// post-specific, should probably not be filtered but may be useful
	'post_id' => $post->ID,

	// this should be filtered in the event of a term-specific archive
	'featured' => has_term( 'homepage-featured', 'prominence' ),

	// $show_thumbnail does not control whether or not the thumbnail is displayed;
	// it controls whether or not the thumbnail is displayed normally.
	'show_excerpt' => TRUE,
);

$args = apply_filters( 'largo_content_partial_arguments', $args, get_queried_object() );

extract( $args );

$entry_classes = 'entry-content';

$show_top_tag = largo_has_categories_or_tags();

if ( $featured ) {
	$entry_classes .= ' span10 with-hero';
	$show_thumbnail = FALSE;
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

	<?php

		echo '<div class="' . $entry_classes . '">';

		if ( largo_has_categories_or_tags() ) {
			largo_maybe_top_term();
		}

		$job_location = get_post_meta( $post->ID, 'location', true );
		$organization = get_post_meta( $post->ID, 'organization', true );

	?>

			<?php if( !empty( $job_location) || !empty( $organization ) ) { ?>
			<div class="left-job-content">
				<?php if( !empty( $job_location ) ) { ?>
					<div class="job-location">
						<h6><?php _e( 'Location', 'ipbs' ); ?></h6>
						<p><?php echo $job_location; ?></p>
					</div>
				<?php } ?>
				<?php if( !empty( $organization ) ) { ?>
				<div class="job-organization">
					<h6><?php _e( 'Organization', 'ipbs' ); ?></h6>
					<p><?php echo $organization; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
			<div class="right-job-content">
				
				<p class="publish-date"><?php echo _e( 'Posted ', 'ipbs' ) . get_the_date( 'd M Y' ); ?></p>
				<h4 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => __( 'Permalink to', 'largo' ) . ' ' ) )?>" rel="bookmark"><?php the_title(); ?></a>
				</h4>

				<?php
					if ( $show_byline ) { ?>
						<h5 class="byline"><?php largo_byline( true, false, get_the_ID() ); ?></h5>
					<?php }
				?>

				<div class="excerpt">
				<?php
					if ( $show_excerpt ) {
						largo_excerpt();
					}
				?>
				</div>

				<a class="job-details" href="<?php echo get_permalink(); ?>"><?php _e( 'View Job Details', 'ipbs' ); ?></a>
			</div>

		</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
