<?php
/**
 * Template Name: Mesh Only
 *
 * @since 1.0.0
 *
 * @package FreshAddress
 * @subpackage Templates
 */

?>
<?php get_header(); ?>

<?php if ( function_exists( 'mesh_display_sections' ) ) {
	mesh_display_sections();
} ?>

<?php get_footer();
