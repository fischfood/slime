<?php
/**
 * Template Name: Left Sidebar
 *
 * Sidebar on left
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage Templates
 */

?>
<?php get_header(); ?>

    <div class="grid-container">
        <div class="grid-x">
            <div class="small-12 large-8 large-push-4 cell" role="main">
				<?php get_template_part( 'partials/loop', get_post_type() ); ?>
            </div>
			<?php get_sidebar( 'left' ); ?>
        </div>
    </div>

<?php
get_footer();