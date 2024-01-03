<?php
/**
 * Navigation
 *
 * This template handles our main navigation markup
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage TemplateParts
 */

?>
<?php

$maybe2023 = '_2023';
$options = get_option( 'slime_theme_options_2023' );

$logo = true;
$alt_logo = true;

?>
<nav class="mobile-header top-bar show-for-mobile">
	<section class="top-bar-title">
		<a href="<?php echo esc_attr( home_url() ); ?>">
			<?php if ( ! empty( $logo ) ) : ?>
				<img src="<?php echo esc_attr( $options['logo_upload' . $maybe2023] ); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>"/>
			<?php else : ?>
				<?php bloginfo( 'name' ); ?>
			<?php endif; ?>
		</a>
	</section>

	<section class="top-bar-toggle">
		<a class="right-off-canvas-toggle menu-icon" data-toggle="offCanvas"><span></span></a>
	</section>
</nav>

<div class="header-spacer"></div>

<div id="main-menu" class="show-for-desktop" data-parent="<?php echo esc_attr( get_post_type() ); ?>">
	<div class="top-bar grid-container" data-topbar="">
        <div class="top-bar-left">
			<?php
			wp_nav_menu(
				array(
					'container'       => false,
					'container_class' => '',
					'menu'            => '',
					'menu_id'         => 'primary-menu-left',
					'menu_class'      => 'dropdown menu',
					'theme_location'  => 'top-bar',
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
        </div>
		<div class="top-bar-title">
			<a class="logo-link" href="<?php echo esc_attr( home_url() ); ?>">
				<?php if ( ! empty( $logo ) ) : ?>
					<div class="logo-bg">
                        <img class="logo" src="<?php echo esc_attr( $options['logo_upload' . $maybe2023] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
                        <?php if ( ! empty( $alt_logo ) ) : ?>
                            <div class="alt-logo-container">
                                <div class="alt-logo" style="background-image: url(<?php echo esc_attr( $options['alternate_logo_upload' . $maybe2023] ); ?>)"></div>
                            </div>
                        <?php endif; ?>
                    </div>
				<?php else : ?>
					<?php bloginfo( 'name' ); ?>
				<?php endif; ?>
			</a>
		</div>
		<div class="top-bar-right">
			<?php
			wp_nav_menu(
				array(
					'container'       => false,
					'container_class' => '',
					'menu'            => '',
					'menu_id'         => 'primary-menu-right',
					'menu_class'      => 'dropdown menu',
					'theme_location'  => 'top-bar-right',
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
		</div>
	</div>
</div>
