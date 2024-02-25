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

$logos = get_option( 'slime_logos' );
    $logo = array_key_exists( 'logo_upload', $logos ) ? $logos['logo_upload'] : false;
	$alt_logo = array_key_exists( 'alternate_logo_upload', $logos ) ? $logos['alternate_logo_upload'] : false;
	$hair_logo = array_key_exists( 'hair_logo_upload', $logos ) ? $logos['hair_logo_upload'] : false;

$ctas = get_option( 'slime_ctas' );
    $contact_label = ( array_key_exists( 'contact_label', $ctas ) ) ? $ctas['contact_label'] : __('Contact', 'slime');
    $contact_url = ( array_key_exists( 'contact_url', $ctas ) ) ? $ctas['contact_url'] : 'contact';
    $filtered_contact = ( wp_http_validate_url( $contact_url ) ) ? esc_url( $contact_url ) : site_url( $contact_url );

?>
<nav class="mobile-header show-for-mobile">
	<section class="top-bar-title">
		<a href="<?php echo esc_attr( home_url() ); ?>">
			<?php if ( ! empty( $logo ) ) : ?>
				<img src="<?php echo $logo; ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>"/>
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

<header id="header" class="show-for-desktop" data-parent="<?php echo esc_attr( get_post_type() ); ?>">

	<div class="flex-container">

		<div class="shrink header-logo-container">
			<a href="<?php echo esc_attr( home_url() ); ?>" class="header-logo-link">
				<?php if ( ! empty( $logo ) ) : ?>
					<img class="header-logo" src="<?php echo $logo; ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>"/>
					<?php if ( ! empty( $alt_logo ) ) : ?>
						<div class="alt-logo-container">
							<div class="alt-logo" style="background-image: url(<?php echo esc_attr( $alt_logo ); ?>)"></div>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $hair_logo ) ) : ?>
						<div class="hair-logo-container">
							<div class="hair-logo" style="background-image: url(<?php echo esc_attr( $hair_logo ); ?>)"></div>
						</div>
					<?php endif; ?>
				<?php else : ?>
					<?php bloginfo( 'name' ); ?>
				<?php endif; ?>
			</a>
		</div>

		<div class="grow header-menu-container">
			<?php
			wp_nav_menu(
				array(
					'container'       => false,
					'container_class' => '',
					'menu'            => '',
					'menu_id'         => 'main-menu',
					'menu_class'      => 'header-menu dropdown menu',
					'theme_location'  => 'main-nav',
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

		<div class="shrink header-cta-container">
			<a class="button footer-button" href="<?php echo $filtered_contact; ?>"><?php echo $contact_label; ?></a>
		</div>

	</div>
</header>
