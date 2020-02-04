<?php
/**
 * Functions regarding post template choices
 *
 * @since Largo 0.6.4
 */

/**
 * Add our custom template as an option for the default template
 *
 * @param Array $options Largo's options framework options array
 * @link https://github.com/INN/umbrella-ipbs/issues/41
 * @link https://github.com/INN/largo/blob/v0.6.4/options.php#L389 What we're searching for: 'single_template'.
 * @link https://github.com/INN/largo/blob/v0.6.4/options.php#L705 The filter we use.
 */
function ipbs_filter_largo_options_custom_templates( $options ) {
	foreach ( $options as $key => $option ){
		$search_result = array_search( 'single_template', $option, true );
		if ( false !== $search_result ) {
			if (
				isset( $options[$key]['options'] )
				&& is_array( $options[$key]['options'] )
			) {
				$options[$key]['options']['single-ipbs.php'] = 'IPBS Right-Offset Column';
			}
		}
	}
	return $options;
}
add_filter( 'largo_options', 'ipbs_filter_largo_options_custom_templates', 10, 1 );

/**
 * Contents for the Layout Options metabox
 *
 * Replaces largo_layout_meta_box_display
 *
 * Allows user to choose:
 * - the post template used by the post, if the current post is not a page
 * - the sidebar used by this post
 *
 * @global $post
 * @since Largo 0.6.4
 * @link https://github.com/INN/umbrella-ipbs/issues/41#issuecomment-580972047
 */
function ipbs_layout_meta_box_display() {
	global $post;

	wp_nonce_field( 'largo_meta_box_nonce', 'meta_box_nonce' );

	$current_template = __( 'Default template', 'ipbs' );

	if ( $post->post_type != 'page' ) {
		echo '<p><strong>' . __('Template', 'largo' ) . '</strong></p>';
		echo '<p>' . __('Select the post template you wish this post to use.', 'largo') . '</p>';
		echo '<label class="hidden" for="post_template">' . __("Post Template", 'largo' ) . '</label>';
		echo '<select name="_wp_post_template" id="post_template" class="dropdown">';
		echo '<option value="">' . sprintf(__( '%s', 'largo' ), $current_template) . '</option>';
		post_templates_dropdown(); //get the options
		echo '</select>';
		echo '<p>' . sprintf(
			__('<a href="%s">Click here</a> to change the default template.', 'ipbs' ),
			admin_url('themes.php?page=options-framework#of-option-layoutoptions41'));
		echo '</p>';
	}

	echo '<p><strong>' . __('Custom Sidebar', 'largo' ) . '</strong><br />';
	echo __('Select a custom sidebar to display.', 'largo' ) . '</p>';
	echo '<label class="hidden" for="custom_sidebar">' . __("Custom Sidebar", 'largo' ) . '</label>';
	echo '<select name="custom_sidebar" id="custom_sidebar" class="dropdown">';
	largo_custom_sidebars_dropdown(); //get the options
	echo '</select>';
}

/**
 * Replace Largo's largo_layout_meta_box_display with our own ipbs_layout_meta_box_display
 *
 * @link https://github.com/INN/umbrella-ipbs/issues/41#issuecomment-580972047
 */
function ipbs_metaboxes() {
	// undo https://github.com/INN/largo/blob/v0.6.4/inc/post-metaboxes.php#L85-L93
	remove_meta_box(
		'largo_layout_meta',
		array( 'post', 'page' ),
		'side'
	);
	// add ours, using real functions instead of largo_add_meta_box
	add_meta_box(
		'ipbs_layout_meta',
		__( 'Layout Options', 'largo' ),
		'_largo_metaboxes_content',
		array( 'post', 'page' ),
		'side',
		'core',
		array( 'ipbs_layout_meta_box_display' )
	);
}
add_action( 'add_meta_boxes', 'ipbs_metaboxes', 15 );
