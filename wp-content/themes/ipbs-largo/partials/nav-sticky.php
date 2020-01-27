<?php
/*
 * Sticky Navigation Menu
 *
 * Applied on all pages after a user scrolls past the Main Navigation or affixed
 * to the top of most pages that aren't the home page.
 *
 * @package Largo
 * @link http://largo.readthedocs.io/users/themeoptions.html#navigation
 */

$site_name = ( of_get_option( 'nav_alt_site_name', false ) ) ? of_get_option( 'nav_alt_site_name' ) : get_bloginfo('name'); ?>
 <div class="sticky-nav-wrapper nocontent">
	<div class="sticky-nav-holder">

	<?php
    /*
     * Before Sticky Nav Container
     *
     * Use add_action( 'largo_before_sticky_nav_container', 'function_to_add');
     *
     * @link https://codex.wordpress.org/Function_Reference/add_action
     */
    do_action( 'largo_before_sticky_nav_container' ); ?>

		<div class="sticky-nav-container">
			<nav id="sticky-nav" class="sticky-navbar navbar clearfix">
				<div class="container">
					<div class="nav-right">
					<?php
					/*
					 * Display social icons. Enabled by default, toggle in Theme Options
					 * under the Basic Settings tab under Menu Options.
					 *
					 * @link https://largo.readthedocs.io/users/themeoptions.html
					 */
					if ( of_get_option( 'show_header_social') ) { ?>
						<ul id="header-social" class="social-icons visible-desktop">
							<?php largo_social_links(); ?>
						</ul>
					<?php } ?>

						<ul id="header-extras">
							<?php
							/*
							 * Display Donate button. Change button text and URL in Theme
							 *
							 * Options under the Basic Settings tab under Donate Button.
							 *
							 * @link https://largo.readthedocs.io/users/themeoptions.html
							 */
							if ( of_get_option( 'show_donate_button') ) {
								if ($donate_link = of_get_option('donate_link')) { ?>
								<li class="donate">
									<a class="donate-link" href="<?php echo esc_url($donate_link); ?>">
										<span><i class="icon-heart"></i><?php echo esc_html(of_get_option('donate_button_text')); ?></span>
									</a>
								</li><?php
								}
							}
                            ?>
							<li>
								<!-- "hamburger" button (3 bars) to trigger off-canvas navigation -->
								<a class="btn btn-navbar toggle-nav-bar" title="<?php esc_attr_e('More', 'largo'); ?>">
									<div class="bars">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </div>
                                    <div class="close">
                                        <span class="dashicons dashicons-no-alt"></span>
                                        <p>Close</p>
                                    </div>
								</a>
							</li>
						</ul>

					</div>

					<!-- BEGIN MOBILE MENU (hidden on desktop) -->
					<div class="nav-left">
						<?php if ( of_get_option( 'sticky_header_logo' ) !== '' ) { ?>
							<ul>
								<li class="home-icon"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php largo_home_icon( 'icon-white', 'orig' ); ?></a></li>
							</ul>
						<?php } else { ?>
							<ul>
								<li class="site-name"><a href="/"><?php echo $site_name; ?></a></li>
							</ul>
						<?php } ?>
					</div>
					<!-- END MOBILE MENU -->

					<!-- BEGIN DESKTOP MENU -->
					<div class="nav-shelf">
                        <ul class="nav">
                            <?php if ( of_get_option('sticky_header_logo') !== '') { ?>
                                <li class="home-icon">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                        <?php
                                        if ( of_get_option( 'sticky_header_logo' ) !== '' )
                                            largo_home_icon( 'icon-white' , 'orig' );
                                        ?>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li class="site-name"><a href="/"><?php echo $site_name; ?></a></li>
                            <?php }

                                /* Build Main Navigation using Boostrap_Walker_Nav_Menu() */
                                $args = array(
                                    'theme_location' => 'main-nav',
                                    'depth'		 => 0,
                                    'container'	 => false,
                                    'items_wrap' => '%3$s',
                                    'menu_class' => 'nav',
                                    'walker'	 => new Bootstrap_Walker_Nav_Menu()
                                );
                                largo_nav_menu($args);
                            ?>
                        </ul>
                        <ul class="bottom-nav">
                            <?php
                            
                                /* Build Bottom Main Navigation using Boostrap_Walker_Nav_Menu() */
                                $args = array(
                                    'theme_location' => 'main-nav-bottom',
                                    'depth' => 0,
                                    'container' => true,
                                    'items_wrap' => '%3$s',
                                    'menu_class' => 'nav',
                                    'walker' => new Bootstrap_Walker_Nav_Menu()
                                );
                                largo_nav_menu( $args );

                            ?>
                        </ul>
					</div>
				</div>
			</nav>
		</div>
	</div>
</div>
