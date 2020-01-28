<?php
/**
 * Block color palette information
 */
/**
 * Define the block color palette
 *
 * If updating these colors, please update less/vars.less. Slugs should match LESS var names.
 *
 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
 * @return Array of Arrays
 */
function ipbs_block_colors() {
	return array(
        array(
			'name' => __( 'Black', 'ipbs' ),
			'slug' => 'black',
			'color' => '#34363B',
        ),
        array(
			'name' => __( 'Dark Black', 'ipbs' ),
			'slug' => 'darkblack',
			'color' => '#1A1818',
        ),
        array(
			'name' => __( 'White', 'ipbs' ),
			'slug' => 'white',
			'color' => '#fff',
		),
		array(
			'name' => __( 'Grey', 'ipbs' ),
			'slug' => 'grey',
			'color' => '#D6D6D6',
		),
		array(
			'name' => __( 'Light Grey', 'ipbs' ),
			'slug' => 'lightgrey',
			'color' => '#E5EAED',
		),
		array(
			'name' => __( 'Dark Grey', 'ipbs' ),
			'slug' => 'darkgrey',
			'color' => '#626772',
        ),
        array(
			'name' => __( 'Blue', 'ipbs' ),
			'slug' => 'blue',
			'color' => '#1661AD',
        ),
        array(
			'name' => __( 'Light Blue', 'ipbs' ),
			'slug' => 'lightblue',
			'color' => '#3573BE',
        ),
        array(
			'name' => __( 'Dark Blue', 'ipbs' ),
			'slug' => 'darkblue',
			'color' => '#195288',
		),
		array(
			'name' => __( 'Red', 'ipbs' ),
			'slug' => 'red',
			'color' => '#E71618',
		),
		array(
			'name' => __( 'Dark Red', 'ipbs' ),
			'slug' => 'darkred',
			'color' => '#CD3B1E',
        ),
        array(
			'name' => __( 'Orange', 'ipbs' ),
			'slug' => 'orange',
			'color' => '#F57221',
        ),
        array(
			'name' => __( 'Green', 'ipbs' ),
			'slug' => 'green',
			'color' => '#2FA444',
        ),
        array(
			'name' => __( 'Dark Green', 'ipbs' ),
			'slug' => 'darkgreen',
			'color' => '#498349',
		),
	);
}
add_theme_support( 'editor-color-palette', ipbs_block_colors() );
/**
 * Loop over the defined colors and create classes for them
 *
 * @uses ipbs_block_colors
 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
 */
function ipbs_block_colors_styles() {
	$colors = ipbs_block_colors();
	if ( is_array( $colors ) && ! empty( $colors ) ) {
		echo '<style type="text/css" id="ipbs_block_colors_styles">';
		foreach ( $colors as $color ) {
			if (
				is_array( $color )
				&& isset( $color['slug'] )
				&& isset( $color['color'] )
			) {
				printf(
					'.has-%1$s-background-color { background-color: %2$s; }',
					$color['slug'],
					$color['color']
				);
				printf(
					'.has-%1$s-color { color: %2$s; }',
					$color['slug'],
					$color['color']
				);
			}
		}
		echo '</style>';
	}
}
add_action( 'wp_head', 'ipbs_block_colors_styles', 10 );