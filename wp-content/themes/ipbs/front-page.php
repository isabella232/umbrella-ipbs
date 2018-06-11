<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12/15/15
 * Time: 10:37 AM
 */
wp_enqueue_style( 'map-stylesheet', get_stylesheet_directory_uri() . '/assets/css/map.css' );
wp_enqueue_script( 'map-velocity', "https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.js" );
wp_enqueue_script( 'map-animate', get_stylesheet_directory_uri() . '/assets/scripts/animate.js' );

get_header();
?>

    <!--begin main body--->

    <div class="maincontent">
        <?php
        while (have_posts()) {
            the_post();
            ?>
            <article id="front-page">
                <div class="left">
                    <?php the_content(); ?>
                </div>
                <div class="right">
                    <h2 class="p1"><strong>Member Stations</strong></h2>
                    <p class="p1"><span class="s1">The IPBS Indiana map displays all of the member stations located in Indiana. Click on a city to see its stations and coverage area.</span></p>
                    <div id="map-wrapper">
                        <div id="map-container">
                            <div id="legend">
                                <span class="tv">TV <span class="visuallyhidden">stations are blue</span></span>
                                <span class="fm">FM <span class="visuallyhidden">stations are orange</span></span>
                                <span class="am">AM <span class="visuallyhidden">stations are yellow</span></span>
                            </div>
                            <?php echo file_get_contents( dirname( __FILE__ ) . "/assets/images/map.svg" ); ?>
                        </div>
                    </div>
                </div>
            </article>
        <?php } ?>

    </div>

    <!--end main body-->

    <!--being slider-->
    <div class="slider_wrapper">

        <div class="owl-carousel">

                <?php
                    $args = array(
                        'post_type'=>'station',
                        'posts_per_page'=>-1,
                        'posts_status'=>'publish',
                        'orderby'=>'rand'
                    );

                    $logoQuery = new WP_Query($args);

                    while($logoQuery->have_posts()) {
                        echo '<div class="slider_item">';
                        $logoQuery->the_post();
                        if(get_field('link')) {
                            echo '<a href="' . get_field('link') . '" target="_blank">';
                            the_post_thumbnail('logo');
                            echo '</a>';
                        } else {
                            the_post_thumbnail('logo');
                        }
                        echo '<br>';
                        echo '<span id="logo_title">';
                        the_title();
                        echo '</span></div>';
                    }
                ?>
        </div>

    </div>
    <!--end slider-->


<?php
get_footer();
?>
