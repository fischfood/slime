<?php
/**
 * Header Template
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage TemplateParts
 */

$url = 'http://' . $_SERVER['SERVER_NAME'];
$parsed = parse_url($url, PHP_URL_HOST);
$exploded = explode(".", $parsed );
$test_tld = 'tld-grid tld-' . end($exploded);

$new_options = get_option( 'slime_theme_options_2023' );

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
	<?php
	/** This action is documented in includes/Linchpin/utilities/hooks.php */
	do_action( 'slime_head_scripts' );
	?>

    <?php /* Featherlight Lightbox */ ?>
    <link href="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css" type="text/css" rel="stylesheet" />
    <script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

    <?php // From http://www.favicomatic.com ?>
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="https://www.themichellegray.com/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="https://www.themichellegray.com/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://www.themichellegray.com/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="https://www.themichellegray.com/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="https://www.themichellegray.com/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="https://www.themichellegray.com/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="https://www.themichellegray.com/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="https://www.themichellegray.com/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="https://www.themichellegray.com/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="https://www.themichellegray.com/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="https://www.themichellegray.com/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="https://www.themichellegray.com/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="https://www.themichellegray.com/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="The Michelle Gray"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="https://www.themichellegray.com/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="https://www.themichellegray.com/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="https://www.themichellegray.com/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="https://www.themichellegray.com/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="https://www.themichellegray.com/mstile-310x310.png" />



    <?php // From https://realfavicongenerator.net ?>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


</head>
<body <?php body_class( $test_tld . ' header-fixed' ); ?>>

<?php do_action( 'slime_body_tag_after' ); ?>

<?php if ( end($exploded) == 'test' || end($exploded) == 'build'): ?>
    <div class="grid-toggle"></div>
<?php endif; ?>

<div class="off-canvas-wrapper">
	<div class="off-canvas position-right" id="offCanvas" data-off-canvas>
		<?php
		wp_nav_menu(
			array(
				'container'       => false,
				'container_class' => '',
				'menu'            => '',
				'menu_class'      => 'off-canvas-list',
				'items_wrap'      => '<ul id="%1$s" class="vertical menu drilldown %2$s" data-drilldown>%3$s</ul>',
				'theme_location'  => 'mobile-off-canvas',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'depth'           => 5,
				'fallback_cb'     => false,
				//'walker'          => new \Foundation\Walker_Nav_Menu(), // Use Custom Walker.
			)
		);
		?>
	</div>

	<div class="inner-wrap off-canvas-content" data-off-canvas-content>

		<?php
		/** This action is documented in includes/Linchpin/utilities/hooks.php */
		do_action( 'slime_layout_start' );
		?>

		<?php
		/** This action is documented in includes/Linchpin/utilities/hooks.php */
		do_action( 'slime_header_before' );
		?>

		<?php get_template_part( 'partials/navigation' ); ?>

		<?php
		/** This action is documented in includes/Linchpin/utilities/hooks.php */
		do_action( 'slime_header_after' );
		?>

		<section role="document">
