<?php
/**
 * Loop Template
 *
 * The default template for displaying looped content.
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage TemplateParts
 */

?>

<?php
/** This action is documented in includes/Slime/utilities/hooks.php */
do_action( 'slime_content_before' );
?>

<?php if ( have_posts() ) : ?>

	<?php
	/** This action is documented in includes/Slime/utilities/hooks.php */
	do_action( 'slime_loop_before' );
	?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'partials/content', 'page' ); ?>
	<?php endwhile; ?>

	<?php
	/** This action is documented in includes/Slime/utilities/hooks.php */
	do_action( 'slime_loop_after' );
	?>

<?php else : ?>

	<?php get_template_part( 'partials/content', 'none' ); ?>

<?php endif; ?>

<?php
/** This action is documented in includes/Slime/utilities/hooks.php */
do_action( 'slime_content_after' );
