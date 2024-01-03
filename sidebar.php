<?php
/**
 * Sidebar Template
 *
 * Based sidebar template
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage Sidebars
 */

?>

<?php do_action( 'slime_sidebar_before' ); ?>

<aside id="sidebar" class="small-12 large-4 cell">

	<?php do_action( 'slime_sidebar_inside_before' ); ?>

	<?php dynamic_sidebar( 'page-widgets' ); ?>

	<?php do_action( 'slime_sidebar_inside_after' ); ?>

</aside>

<?php
do_action( 'slime_after_sidebar' );
