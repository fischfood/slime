<?php
/**
 * Search Results Template
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage Search
 */

?>
<?php get_header(); ?>

<div class="grid-container">
    <div class="grid-x">
        <div class="small-12 large-8 cell" role="main">

            <h2><?php esc_html_e( 'Search Results for', 'slime' ); ?>
                "<?php echo esc_html( get_search_query() ); ?>"</h2>

            <?php
            $term = $wp_query->get_queried_object();
            $queried = $term->query_var;

            print_r( $term );

            echo $queried . 'bob';
            ?>

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
                    <?php get_template_part( 'partials/loop', 'post' ); ?>
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

<?php
get_footer();
