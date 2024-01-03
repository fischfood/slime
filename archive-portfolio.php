<?php
/**
 * Portfolio Archive Template
 *
 * Template for display all default archive pages.
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage Templates
 */

?>

<?php get_header(); ?>

<?php get_template_part( 'partials/filter', 'portfolio'); ?>

<div class="grid-container portfolio-container">
    <div class="grid-x">
        <div class="small-12 cell" role="main">

            <?php
            /** This action is documented in includes/Linchpin/utilities/hooks.php */
            do_action( 'slime_content_before' );
            ?>

            <?php if ( have_posts() ) : ?>

            <div class="grid-x grid-offset portfolio-loop-container" id="<?php echo $infinite; ?>" data-equalizer>

                <?php
                /** This action is documented in includes/Linchpin/utilities/hooks.php */
                do_action( 'slime_loop_before' );
                ?>

	            <?php while ( have_posts() ) : the_post(); ?>

		            <?php get_loop_block( get_post_type() ); ?>

	            <?php endwhile; ?>

                <?php
                /** This action is documented in includes/Linchpin/utilities/hooks.php */
                do_action( 'slime_loop_after' );
                ?>

            </div>

            <?php else : ?>

                <?php get_template_part( 'partials/content', 'none' ); ?>

            <?php endif; ?>

            <?php
            /** This action is documented in includes/Linchpin/utilities/hooks.php */
            do_action( 'slime_content_after' );
            ?>

            <?php get_template_part( 'partials/pagination' ); ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer();
