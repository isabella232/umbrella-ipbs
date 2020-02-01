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
				$options[$key]['options']['ipbs'] = 'IPBS Right-Offset Column';
			}
		}
	}
	return $options;
}
add_filter( 'largo_options', 'ipbs_filter_largo_options_custom_templates', 10, 1 );
