<?php
/**
 * Register style variations for the core/group block
 *
 * @link https://developer.wordpress.org/block-editor/developers/filters/block-filters/#server-side-registration-helper
 * @link https://github.com/INN/umbrella-ipbs/issues/61
 */

add_action( 'init', function() {
	wp_register_style(
		'ipbs-block-core-group-editor',
		get_stylesheet_directory_uri() . '/blocks/core-group/editor.css',
		null,
		filemtime( get_stylesheet_directory() . '/blocks/core-group/editor.css' )
	);
	register_block_style(
		'core/group',
		array(
			'name' => 'border-top-green',
			'label' => __( 'Green Top Border', 'ipbs' ),
		)
	);
	register_block_style(
		'core/group',
		array(
			'name' => 'border-top-blue',
			'label' => __( 'Blue Top Border', 'ipbs' ),
		)
	);
	register_block_style(
		'core/group',
		array(
			'name' => 'border-top-red',
			'label' => __( 'Red Top Border', 'ipbs' ),
		)
	);
	register_block_style(
		'core/group',
		array(
			'name' => 'border-top-orange',
			'label' => __( 'orange Top Border', 'ipbs' ),
		)
	);
} );

add_action( 'enqueue_block_editor_assets', function() {
	wp_enqueue_style( 'ipbs-block-core-group-editor' );
});
