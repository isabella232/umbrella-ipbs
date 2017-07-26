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

        <div class="leftcolumn">
            <?php
            while (have_posts()) {
                the_post();
                ?>

                <article>
                    <?php the_content();

                    $args = array(
                        'post_type'=>'job',
                        'posts_per_page'=>-1,
                        'posts_status'=>'publish'
                    );

                    $jobsQuery = new WP_Query($args);

                    if($jobsQuery->have_posts()) {


                    echo '<ul>';
                    while($jobsQuery->have_posts()) {
                        $jobsQuery->the_post();
                        ?>

                        <li>
                            <h3><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h3>
                            <?php the_excerpt(); ?>
                            <a href="<?php the_permalink()?>">Learn More</a>
                        </li>

                        <?php
                    }

                    echo '</ul>';

                    } else {
                        echo '<p>There are currently no jobs avaliable, please check back soon.</p>';
                    }

                    wp_reset_postdata();

                    ?>


                </article>

            <?php } ?>
        </div>
        <?php get_sidebar(); ?>

    </div>

    <!--end main body-->


<?php
get_footer();
?>