<!--begin footer-->

<div class="footer">
    <div class="links">

        <a href="http://protectmypublicmedia.org/" target="_blank">
            <div class="child">
                <h2>PROTECT MY PUBLIC MEDIA</h2>
                <img src="<?php bloginfo('template_directory') ?>/assets/images/PMPM_Color.png">

                <p>
                    Take a stand for the local stations and programs you love.
                </p>
            </div>
        </a>

        <a href="<?php echo get_permalink(get_page_by_title('Indiana Supreme Court Project')); ?>">
            <div class="child">
                <h2>SUPREME COURT</h2>
                <img src="<?php bloginfo('template_directory') ?>/assets/images/INSupremeCourt_bw.png">

                <p>
                    IPBS is a resource to bring our state government closer to every Hoosier home.
                </p>
            </div>
        </a>


        <a href="<?php echo get_permalink(get_page_by_title('MySource')); ?>">
            <div class="child">
                <h2>MYSOURCE</h2>
                <img src="<?php bloginfo('template_directory') ?>/assets/images/mysource_color.png">

                <p>
                    Indiana Public Broadcasting Stations are MySource for programs that really matter.
                </p>
            </div>
        </a>
    </div>
    <!---begin footer menu-->
    <?php
    $args = array(
        'menu' => 'footer_menu',
        'container_class' => 'bottommenu'
    );

    wp_nav_menu($args);
    ?>

    <!--end footer menu-->

</div>

<!---end footer-->
</div>
<?php wp_footer(); ?>
<style type="text/css">
    html {
        margin-top: 0 !important;
    }
</style>
</body>
</html>