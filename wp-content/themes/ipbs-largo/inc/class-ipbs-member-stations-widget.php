<?php
/**
 * Register the widget
 */
add_action( 'widgets_init', function() {
	register_widget( 'ipbs_member_stations_widget' );
});

/**
 * IPBS Member Stations widget
 */
class ipbs_member_stations_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		$widget_ops = array(
			'classname' => 'ipbs-member-stations',
			'description' => __( 'A widget to display IPBS member stations', 'ipbs' )
		);
		parent::__construct(
			'ipbs-member-stations-widget', // Base ID
			__( 'IPBS Member Stations', 'ipbs' ), // Name
			$widget_ops // Args
		);

	}

	/**
	 * Outputs the content of the IBPS member stations widget.
	 *
	 * @param array $args widget arguments.
	 * @param array $instance saved values from databse.
	 * @global $post
	 * @global $wp_query Used to get posts from the specified post type
	 */
	function widget( $args, $instance ) {

		global $post,
			$wp_query; // grab this to copy posts in the main column
		
		// Preserve global $post
        $preserve = $post;
        
		// Add the link to the title.
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( $title ) echo $args['before_title'] . $title . $args['after_title'];

		$query_args = array (
			'post_type' => 'station',
			'posts_per_page' => -1,
			'post_status'	=> 'publish'
		);

		echo '<ul>';

		$my_query = new WP_Query( $query_args );

		if ( $my_query->have_posts() ) {

			$output = '';

            while ( $my_query->have_posts() ) : $my_query->the_post();
            
                $station_link = get_post_meta( get_the_ID(), 'link', true );

				// wrap the items in li's.
				$output .= '<li>';

				$context = array(
					'instance' => $instance,
                    'thumb' => 'large',
                    'station_link' => $station_link
				);

				ob_start();
				largo_render_template( 'partials/widget', 'member-stations', $context );
				$output .= ob_get_clean();

				// close the item
				$output .= '</li>';

			endwhile;

			// print all of the items
			echo $output;

		} else {
			printf( __( '<p class="error"><strong>You don\'t have any member stations.</strong></p>', 'ipbs' ) );
		} // end more featured posts

		// close the ul
		echo '</ul>';

		if( ! empty( $instance['linkurl'] ) ) {
			echo '<p class="morelink"><a href="' . esc_url( $instance['linkurl'] ) . '">' . esc_html( $instance['linktext'] ) . '</a></p>';
		}
		echo $args['after_widget'];

		// Restore global $post
		wp_reset_postdata();
		$post = $preserve;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'title' => __( 'Member Stations', 'ipbs' ),
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'ipbs' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

	<?php
	}
}
