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

$logos = get_option( 'slime_logos' );
    $footer_logo = $logos['footer_logo_upload'];

$ctas = get_option( 'slime_ctas' );
    $contact_label = ( array_key_exists( 'contact_label', $ctas ) ) ? $ctas['contact_label'] : __('Contact', 'slime');
    $contact_url = ( array_key_exists( 'contact_url', $ctas ) ) ? $ctas['contact_url'] : 'contact';
    $filtered_contact = ( wp_http_validate_url( $contact_url ) ) ? esc_url( $contact_url ) : site_url( $contact_url );
?>


<?php
/* From header.php
<html>
<body> 
<div class="site-container">
    <div class="page-container">
        <section role="document" class="main-content">
*/ ?>
        </section>

        <?php
        do_action( 'slime_footer_before' );
        ?>

        <footer id="footer">

            
            <?php wave_repeat(); ?>
            

            <div class="main-footer">
                <div class="flex-container">

                    <div class="shrink footer-logo-container">
                        <?php if ( ! empty( $footer_logo ) ): ?>
                            <a href="<?php echo site_url(); ?>" title="<?php esc_html_e( 'Link to homepage', 'slime' ); ?>">
                                <img class="footer-logo" src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>"/>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="grow">
                        <?php
                        wp_nav_menu(
                                array(
                                    'container'       => false,
                                    'container_class' => '',
                                    'menu'            => '',
                                    'menu_class'      => 'footer-menu menu',
                                    'theme_location'  => 'footer',
                                    'before'          => '',
                                    'after'           => '',
                                    'link_before'     => '',
                                    'link_after'      => '',
                                    'depth'           => 1,
                                    'fallback_cb'     => false,
                                    //'walker'          => new \Foundation\Walker_Nav_Menu(),
                                )
                            );
                        ?>
                    </div>

                    <div class="shrink footer-cta-container">
                        <a class="button footer-button" href="<?php echo $filtered_contact; ?>"><?php echo $contact_label; ?></a>

                        <?php
                        // Socials 
                        $socials = [
                            'Instagram' => 'https://www.instagram.com/themichellegray/',
                            'Twitter / X' => 'https://twitter.com/themichellegray',
                            'TikTok' => 'https://www.tiktok.com/@themichellegray',
                            'Twitch' => 'https://www.twitch.tv/themichellegray',
                        ]
                        ?>
                        <ul class="socials">
                            <?php foreach( $socials as $sname => $slink ): ?>
                                <li>
                                    <a title="Visit TheMichelleGray on <?php echo esc_html( $sname ); ?>" class="social-<?php echo strtolower( str_replace( ['/',' ','X'], '', esc_html( $sname ) ) ); ?>" target="_blank" href="<?php echo esc_url( $slink ); ?>">
                                        <?php echo esc_html( $sname ); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="copyright-container">
                <div class="flex-container align justify">
                    <span class="copyright">
                    <?php
                        printf(
                        // translators: 1. Name, 2. Year, 3. Privacy Policy Link
                            wp_kses_post( __( '&copy; %1$s, %2$s | All Rights Reserved | <a href="%3$s">Privacy Policy</a>', 'slime' ) ),
                            esc_html( 'Michelle Gray' ),
                            esc_html( date( 'Y' ) ),
                            site_url( '/privacy-policy' )
                        );
                        ?>
                    </span>
                </div>
            </div>
            
        </footer>

        <?php do_action( 'slime_footer_after' ); ?>

        <a class="exit-off-canvas"></a>

    </div>
</div>

<?php wp_footer(); ?>

<?php do_action( 'slime_body_before_close' ); ?>

</body>
</html>
