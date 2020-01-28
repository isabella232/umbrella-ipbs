<?php
/**
 * The IPBS member map widget, and related functionality
 */

/**
 * Register the widget
 */
add_action( 'widgets_init', function() {
	register_widget( 'ipbs_member_map_widget' );
});

/**
 * The very simple widget
 */
class ipbs_member_map_widget extends WP_Widget {
	/**
	 *
	 */
	public function __construct() {
		parent::__construct(
			'ipbs-member-map-widget',
			__( 'IPBS Member Map', 'ipbs' ),
			array(
				'classname' => 'ipbs-member-map-widget',
				'description' => __( 'Displays IPBS\' member map in the form of an interactive SVG.', 'ipbs' )
			)
		);
	}

	/**
	 * Form allowing for title to be set
	 *
	 * @param Array $instance Saved values for this widget from db.
	 */
	public function form( $instance ) {
		$defaults = array(
			'title' => __( 'Member Stations', 'sfpp' ),
			'description' => 'The IPBS Indiana map displays all of the member stations located in Indiana. Click on a city to see its stations and coverage area.',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'largo' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:90%;" type="text" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Description:', 'largo' ); ?></label>
				<textarea
					id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"
					style="width:90%;"
					type="text"
					rows="4"
				><?php echo wp_kses_post( $instance['description'] ); ?></textarea>
			</p>
		<?php
	}

	/**
	 * Save the widget title
	 *
	 * @param  Array $new_instance The values from the form update
	 * @param  Array $old_instance The values from the database
	 * @return Array the new values.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['description'] = sanitize_textarea_field( $new_instance['description'] );

		return $instance;
	}

	/**
	 * Output the map, which is primarily composed of a single partial that enqueues all its related files.
	 *
	 * @param Array $args Sidebar arguments.
	 * @param Array $instance Saved values for this widget from db.
	 */
	public function widget( $args, $instance ) {
		$template_file = get_stylesheet_directory() . '/partials/member-map.php';
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo wp_kses_post( $args['before_widget'] );

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . wp_kses_post( $title ) . $args['after_title'];
		}

		if ( ! empty( $instance['description'] ) ) {
			echo '<div class="description aligncenter">' . wp_kses_post( $instance['description'] ) . '</div>';
		}


		load_template( $template_file, false );

		echo wp_kses_post( $args['after_widget'] );
	}
}
