<?php
include_once get_template_directory() . '/homepages/homepage-class.php';

class IPBS extends Homepage {
	const menu_location = 'homepage_quick_links';
	var $name = 'IPBS';
	var $type = 'ipbs';
	var $description = 'The homepage for IPBS.';
	var $rightRail = false;

	public function __construct( $options = array() ) {
		$defaults = array(
			'template' => get_stylesheet_directory() . '/homepages/template.php',
			'assets' => array(
				array(
					'homepage',
					get_stylesheet_directory_uri() . '/homepages/assets/css/homepage.css',
					array(),
					filemtime( get_stylesheet_directory() . '/homepages/assets/css/homepage.css' ),
				),
			),
			'prominenceTerms' => array(
				array(
					'name' => __('Homepage Top Story', 'largo'),
					'description' => __('If you are using a "Big story" homepage layout, add this label to a post to make it the top story on the homepage', 'largo'),
					'slug' => 'top-story'
				),
			),
			'sidebars' => array(
				'Homepage Bottom (The bottom area of the homepage, after the top and featured stories)',
			),
		);
		$options = array_merge( $defaults, $options );

		$this->register_nav_menu();
		$this->load( $options );
	}

	/**
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menu/
	 */
	public static function register_nav_menu() {
		register_nav_menu( IPBS::menu_location, __( 'Homepage Quick Links', 'ipbs' ) );
	}
}

/**
 * Register this layout with Largo
 */
function ipbs_homepage_layout() {
	register_homepage_layout( 'ipbs' );
}
add_action( 'init', 'ipbs_homepage_layout' ); 
