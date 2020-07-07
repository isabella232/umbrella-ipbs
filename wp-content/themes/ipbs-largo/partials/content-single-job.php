<?php
/**
 * The template for displaying content in the single.php template
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'hnews item' ); ?> itemscope itemtype="https://schema.org/Article">

	<?php do_action('largo_before_post_header'); ?>

	<header>

		<?php largo_maybe_top_term(); ?>

		<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
		<?php if ( $subtitle = get_post_meta( $post->ID, 'subtitle', true ) ) : ?>
			<h2 class="subtitle"><?php echo $subtitle ?></h2>
		<?php endif; ?>

<?php largo_post_metadata( $post->ID ); ?>

	</header><!-- / entry header -->

	<?php
		do_action('largo_after_post_header');

		largo_hero(null,'span12');

		do_action('largo_after_hero');
	?>

	<?php get_sidebar(); ?>

	<section class="entry-content clearfix" itemprop="articleBody">

		<?php 

		$job_location = get_post_meta( $post->ID, 'location', true );
		$organization = get_post_meta( $post->ID, 'organization', true );

		if( !empty( $job_location ) ) { ?>
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
		
		<?php largo_entry_content( $post ); ?>
		
	</section>

	<?php do_action('largo_after_post_content'); ?>

</article>
