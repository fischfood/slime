<?php
/**
 * Footer Template
 *
 * All stuff that should typically be in the footer.
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage TemplatesParts
 */

$options = get_option( 'slime_theme_options_2023' );

?>

                </section>

                <?php
                /** This action is documented in includes/Linchpin/utilities/hooks.php */
                do_action( 'slime_footer_before' );
                ?>

                <footer id="footer">

                    
                    <?php wave_repeat(); ?>
                    

                    <div class="main-footer container small">
                        <div class="grid-container">
                            <?php
                            /** This action is documented in includes/Linchpin/utilities/hooks.php */
                            do_action( 'slime_sub_footer_inner_before' );
                            ?>

                            <div class="grid-x">
                                <div class="small-12 medium-5 cell align-self-middle text-center medium-text-left margin-bottom medium-margin-bottom-none">

                                    
                                    <img class="footer-logo" src="<?php echo esc_attr( $options['footer_logo_upload_2023'] ); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>"/>
                                

                                </div>

                                <div class="small-12 medium-7 cell align-self-middle text-center medium-text-right">
                                    <?php

                                    wp_nav_menu(
		                                    array(
			                                    'container'       => false,
			                                    'container_class' => '',
			                                    'menu'            => '',
			                                    'menu_class'      => 'social menu text-center medium-text-right',
			                                    'theme_location'  => 'social',
			                                    'before'          => '',
			                                    'after'           => '',
			                                    'link_before'     => '',
			                                    'link_after'      => '',
			                                    'depth'           => 5,
			                                    'fallback_cb'     => false,
			                                    //'walker'          => new \Foundation\Walker_Nav_Menu(),
		                                    )
	                                    );
                                    ?>

                                    <span class="copyright padding-top-small medium-padding-top-none">
	                                <?php
                                        printf(
                                        // translators: 1. Year, 2. Blog Name.
                                            esc_html__( '&copy; %1$s %2$s. All Rights Reserved.', 'slime' ),
                                            esc_html( date( 'Y' ) ),
                                            esc_html( 'TMG' )
                                        );
                                        ?>
                                    </span>
                                </div>
                            </div>

                            <?php
                            /** This action is documented in includes/Linchpin/utilities/hooks.php */
                            do_action( 'slime_sub_footer_inner_after' );
                            ?>
                        </div>
                    </div>
                </footer>

                <?php
                /** This action is documented in includes/Linchpin/utilities/hooks.php */
                do_action( 'slime_footer_after' );
                ?>

                <a class="exit-off-canvas"></a>

                <?php
                /** This action is documented in includes/Linchpin/utilities/hooks.php */
                do_action( 'slime_layout_end' );
                ?>
            </div>
        </div>

        <?php wp_footer(); ?>

        <?php
        /**
         * Additional Footer Scripts is attached to this action
         * If this action is removed from your Additional Footer Scripts
         * area within the Theme Settings will no longer print to the
         * front end of your theme
         */
        /** This action is documented in includes/Linchpin/utilities/hooks.php */
        do_action( 'slime_body_before_close' );
        ?>

    </body>
</html>
