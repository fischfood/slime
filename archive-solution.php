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

<div class="container padding-vertical">
    
    <?php
        /** This action is documented in includes/Slime/utilities/hooks.php */
        do_action( 'slime_content_before' );
        ?>

        <?php if ( have_posts() ) : ?>

        <div class="container">

            <?php
            /** This action is documented in includes/Slime/utilities/hooks.php */
            do_action( 'slime_loop_before' );
            ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <?php $parent_post_id = get_the_ID(); ?>

                <?php
                $child_solution_args = array(
                    'post_type'      => 'solution', // Change 'post' to your custom post type if needed
                    'post_status'    => 'publish',
                    'posts_per_page' => 99, // -1 to retrieve all child posts
                    'post_parent'    => $parent_post_id,
                );

                $child_solutions_query = new WP_Query( $child_solution_args );
                ?>

                <div class="solutions-container">

                    <div class="flex-container">
                        <div class="solution-image-container">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>

                        <div class="solution-content-container">
                            <?php the_title('<h2>','</h2>'); ?>

                            <div class="solution-content">
                                <?php the_content(); ?>
                            </div>

                            <?php if ( $child_solutions_query->have_posts() ) :?>

                                <div class="solution-accordion-container">

                                    <p class="solution-accordion-toggle">
                                        <?php esc_html_e( 'Project Types and Pricing', 'slime' ); ?>
                                    </p>

                                    <?php while ( $child_solutions_query->have_posts() ) : $child_solutions_query->the_post(); ?>
                                    <div class="solution-accordion">

                                            <p class="solution-sub-accordion-toggle">
                                                <?php the_title(); ?>

                                                <div class="solution-sub-accordion">
                                                    <?php the_content(); ?>
                                                </div>
                                            </p>

                                    </div>
                                    <?php endwhile; wp_reset_postdata(); ?>

                                </div>

                            <?php endif; ?>

                        </div>
                    </div>

                </div>

            <?php endwhile; ?>

            <?php
            /** This action is documented in includes/Slime/utilities/hooks.php */
            do_action( 'slime_loop_after' );
            ?>

        </div>

        <?php else : ?>

            <?php get_template_part( 'partials/content', 'none' ); ?>

        <?php endif; ?>

        <?php
        /** This action is documented in includes/Slime/utilities/hooks.php */
        do_action( 'slime_content_after' );
    ?>
</div>

<?php get_footer();
