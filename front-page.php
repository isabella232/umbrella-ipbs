<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12/15/15
 * Time: 10:37 AM
 */

get_header();
?>

    <!--begin main body--->

    <div class="maincontent">
        <?php
        while (have_posts()) {
            the_post();
            ?>
            <article id="front-page">
                <?php the_content(); ?>
                <div id="map-wrapper">
                    <iframe src="<?php echo get_template_directory_uri(); ?>/map.php" id="map-frame"
                            scrolling="no"></iframe>
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