<?php
	global $shown_ids;
	$topstory = largo_home_single_top();
	$shown_ids[] = $topstory->ID;

?>
<div class="">
	<div id="top-story" <?php post_class( '', $topstory->ID ); ?> >
		<div class="post-image-top-term-container">
			<a class="img" href="<?php echo esc_attr( get_permalink( $topstory ) ); ?>">
				<?php echo get_the_post_thumbnail( $topstory, 'full' ); ?>
			</a>
		</div>
		<div class="inner has-white-color">
			<article <?php post_class( '', $topstory ); ?>>
				<h2><a href="<?php the_permalink( $topstory ); ?>"><?php echo get_the_title( $topstory ); ?></a></h2>
				<div class="excerpt">
					<?php largo_excerpt( $topstory, 2 ); ?>
				</div>
			</article>
			<div class="menu-container">
				<?php
					echo '<h3 class="has-white-color">' . __( 'Quick Links', 'ipbs' ) . '</h3>';
					wp_nav_menu( array(
						'theme_location' => IPBS::menu_location,
						'after' => ' &gt;',
					) );
				?>
			</div>
		</div>
	</div>
</div>
<div class="bottom-widget-area clearfix">
	<div class="widget-area">
		<?php
			dynamic_sidebar( 'Homepage Bottom' );
		?>
	</div>
</div>
