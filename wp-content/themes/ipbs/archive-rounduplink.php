<?php
/**
 * Copied from index.php and modified for compatibility with the Link Roundups plugin.
 *
 * @link https://codex.wordpress.org/Post_Types#Custom_Post_Type_Templates
 * @link https://github.com/INN/link-roundups
 * @link https://github.com/INN/largo/blob/master/partials/content-rounduplink.php
 * @since Wordpress 4.8
 * @since Link Roundups 0.4.1
 */

get_header();

?>

<!--begin main body--->

<div class="maincontent">

    <div class="leftcolumn">
        <?php
        while (have_posts()) {
            the_post();
            $custom = get_post_custom($post->ID);
            ?>

            <article>
                <h1 class="entry-title"><?php echo ( isset( $custom['lr_url'][0] ) ) ? '<a href="' . $custom['lr_url'][0] . '">' . get_the_title() . '</a>' : get_the_title(); ?></h1>
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
