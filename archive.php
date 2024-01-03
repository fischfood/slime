<?php
/**
 * Archive Template
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

<div class="grid-container">
    <div class="grid-x">
        <div class="small-12 medium-8 cell" role="main">

            <?php
            /** This action is documented in includes/Linchpin/utilities/hooks.php */
            do_action( 'slime_content_before' );
            ?>

            <?php if ( have_posts() ) : ?>

                <?php
                /** This action is documented in includes/Linchpin/utilities/hooks.php */
                do_action( 'slime_loop_before' );
                ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'partials/loop-post', get_post_type() ); ?>

                <?php endwhile; ?>

                <?php
                /** This action is documented in includes/Linchpin/utilities/hooks.php */
                do_action( 'slime_loop_after' );
                ?>

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
