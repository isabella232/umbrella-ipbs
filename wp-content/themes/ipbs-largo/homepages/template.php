<?php
/**
 * Homepage template for the IPBS layout.
 * Contains:
 * - Homepage top story, with image support
 * - Quick Links menu
 * - Homepage Bottom menu
 */

global $shown_ids;

?>
<div class="">
	<div id="top-story" class="has-post-thumbnail" >
		<?php if ( true ) { ?>
			<div class="post-image-top-term-container" aria-hidden="true">
				<img
					src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/homepage-halved.jpg' ); ?>"
					class="attachment-full size-full wp-post-image"
					srcset="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/homepage-halved.jpg' ); ?> 525w,
						<?php echo esc_url( get_stylesheet_directory_uri() . '/images/homepage.jpg' ); ?> 1050w"
					sizes="(max-width: 1170px) 100vw, 1170px"
					width="1170"
					height="780"
				>
			</div>
		<?php } ?>
		<div class="inner has-white-color">
			<?php
				dynamic_sidebar( 'Homepage Top' );
			?>
			<div class="menu-container">
				<?php
					echo '<h3 class="has-white-color">' . wp_kses_post( __( 'Quick Links', 'ipbs' ) ) . '</h3>';
					wp_nav_menu(
						array(
							'theme_location' => IPBS::menu_location,
						)
					);
				?>
			</div>
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
