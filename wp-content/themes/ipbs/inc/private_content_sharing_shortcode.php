<?php
/**
 * This shortcode displays gravity form results
 *
 * Assumptions:
 * - form has 'textarea', 'text', and 'website' fields
 * - the form won't have more than one field of any particular type
 * - the form isn't going to be modified at all
 *
 * If they're gonna modify the form, we should instead do something like:
 * - iterate over fields
 * - display field title and filed value
 *
 */
function private_content_sharing_shortcode( $atts, $content, $tag ) {

	// get the ID of the gravity form we want to use, and sanitize it
	$id = empty( $atts['id'] ) ? '' : intval( $atts['id'] );

	ob_start();

	if ( empty( $id ) ) {
		echo '<h1>You must provide an ID to the shortcode</h1>';
		echo '<code>[ipbs_private_content id="1"]</code>';
	} else if ( class_exists( 'GFAPI') )  {
		$entries = GFAPI::get_entries(
			$id,
			$search_criteria = array(
				'start_date' => date( 'Y-m-d', strtotime('-30 days') ),
				'end_date' => date( 'Y-m-d', time() )
			)
		);

		$form = GFAPI::get_form( $id );
		$title_field = GFAPI::get_fields_by_type( $form, 'text' );
		$link_field = GFAPI::get_fields_by_type( $form, 'website' );
		$excerpt_field = GFAPI::get_fields_by_type( $form, 'textarea' );
		echo '<pre><code>';
		echo (var_export( $form, true));
		echo '</code></pre>';

		// loop over entries, show entry from each
		foreach ( $entries as $entry ) {
			printf(
				'<article><h1><a href="%1$s">%2$s</a></h2><p class="excerpt">%3$s</p></article>',
				esc_url( $entry[$link_field[0]['id']] ),
				sanitize_text_field( $entry[$title_field[0]['id']] ),
				wp_kses_post( $entry[$excerpt_field[0]['id']] )
			);
		}

	}

	return ob_get_clean();
}
add_shortcode( 'ipbs_private_content', 'private_content_sharing_shortcode' );
