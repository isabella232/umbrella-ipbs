<?php
	global $shown_ids;
	$topstory = largo_home_single_top();
	$shown_ids[] = $topstory->ID;

?>
<div class="">
	<?php
		// note that we're making a section containing a background image,
		// which goes behind a transparent section that contains:
		// - the article heading
		// - the article excerpt
		// - a "Quick links" menu for the site
	?>
	<div id="top-story" <?php post_class( '', $topstory->ID ); ?> >
		<div class="post-image-top-term-container">
			<?php
				// The top term
				largo_maybe_top_term();
			?>
			<a class="img" href="<?php echo esc_attr( get_permalink( $topstory ) ); ?>"><?php echo get_the_post_thumbnail( $topstory, 'large' ); ?></a>
		</div>
		<div class="inner">
			<article <?php post_class( '', $topstory ); ?>>
				<h2><a href="<?php the_permalink( $topstory ); ?>"><?php echo get_the_title( $topstory ); ?></a></h2>
				<div class="excerpt">
					<?php largo_excerpt( $topstory, 2 ); ?>
					<a class="view-more-link" href="<?php the_permalink( $topstory ); ?>">Full Story</a>
				</div>
			</article>
			<?php
				wp_nav_menu( array(
					'theme_location' => IPBS::menu_location,
				) );
			?>
		</div>
	</div>
</div>
<div class="impact-widget-area clearfix">
	<div class="widget-area">
		<?php
			dynamic_sidebar( 'Homepage Impact' );
		?>
	</div>
</div>
<div class="bottom-widget-area clearfix">
	<div class="widget-area">
		<?php
			dynamic_sidebar( 'Homepage Bottom' );
		?>
	</div>
</div>
