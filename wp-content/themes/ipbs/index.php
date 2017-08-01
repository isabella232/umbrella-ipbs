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
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </article>

        <?php } ?>
    </div>
    <?php get_sidebar(); ?>

</div>

<!--end main body-->


<?php
get_footer();
?>
