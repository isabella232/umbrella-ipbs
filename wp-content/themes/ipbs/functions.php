<?php
/**
 * Require necessary files
 */
function ipbs_requires() {
	$requires = array(
		'/inc/private_content_sharing_shortcode.php'
	);
	foreach ( $requires as $require ) {
		require_once( get_stylesheet_directory() . $require );
	}
}
add_action( 'after_setup_theme', 'ipbs_requires' );

/**
 * enqueue scripts
 */
function ipbs_theme_scripts(){
    wp_enqueue_style( 'normalize', get_template_directory_uri()."/normalize.css" );
    wp_enqueue_style( 'style', get_stylesheet_uri(), array("normalize"), "1.0.0" );

    wp_register_script("owl.carousel", get_template_directory_uri()."/assets/scripts/owl.carousel.js", array("jquery"), false, true);
    wp_localize_script("owl.carousel", "left_arrow_url", get_template_directory_uri()."/assets/images/left_arrow.svg");
    wp_localize_script("owl.carousel", "right_arrow_url", get_template_directory_uri()."/assets/images/right_arrow.svg");
    wp_enqueue_script("owl.carousel");

    wp_enqueue_script("ipbs_script", get_template_directory_uri()."/assets/scripts/scripts.js", array("owl.carousel"), false, true);

    wp_register_script("distance_script", get_template_directory_uri()."/assets/scripts/distance.js" , array("jquery"));

    wp_enqueue_script("ipbs_header", get_template_directory_uri()."/assets/scripts/header.js", array(), false, true);

    $ajaxURL = admin_url( 'admin-ajax.php' );
    wp_localize_script("distance_script", "ajaxurl", $ajaxURL );

    $cities = get_terms('city');
    foreach($cities as $city) {
        $city->lon = get_field('longitude', 'city_'.$city->term_id);
        $city->lat = get_field('latitude', 'city_'.$city->term_id);

        $args = array(
            'post_type'=>'station',
            'post_per_page'=>-1,
            'post_status'=>'publish',
            'tax_query'=>array(
                array(
                    'taxonomy'=>'city',
                    'field'=>'term_id',
                    'terms'=>$city->term_id
                ),
                array(
                    'taxonomy'=>'station_type',
                    'field'=>'slug',
                    'terms'=>'tv'
                )
            )
        );

        $city->TVStations = get_posts($args);

        foreach($city->TVStations as $station) {
            $station->link = get_field('link', $station->ID);
        }

        $args = array(
            'post_type'=>'station',
            'post_per_page'=>-1,
            'post_status'=>'publish',
            'tax_query'=>array(
                array(
                    'taxonomy'=>'city',
                    'field'=>'term_id',
                    'terms'=>$city->term_id
                ),
                array(
                    'taxonomy'=>'station_type',
                    'field'=>'slug',
                    'terms'=>'radio'
                )
            )
        );
        $city->radioStations = get_posts($args);

        foreach($city->radioStations as $station) {
            $station->link = get_field('link', $station->ID);
        }

    }
    wp_localize_script("distance_script", "cities", $cities);

    wp_localize_script("distance_script", "caret_url", get_template_directory_uri()."/assets/images/carrot.svg");

    wp_enqueue_script("distance_script");

}


function get_cities(){
    return $_GET['orderedCities'];
}

add_action('wp_enqueue_scripts', 'ipbs_theme_scripts');
add_action("wp_ajax_get_cities", "get_cities");

register_nav_menu('footer_menu', 'The menu in the footer');
register_nav_menu('ipbsmainmenu', 'The main menu in the header');


add_theme_support('post-thumbnails');

add_image_size('logo', 460, 1000, false);
