<?php
/**
 * Single Post Template
 *
 * Default template utilized for single posts
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage Templates
 */

$portfolio_header_image = ( get_post_meta( get_the_ID(), 'portfolio_header_image', true ) ) ? get_post_meta( get_the_ID(), 'portfolio_header_image', true ) : get_the_post_thumbnail_url() ;
$company_list = get_the_terms(get_the_ID(), 'company' );

?>
<?php get_header(); ?>

<div class="grid-x margin-top-large">
    <div class="small-12 cell" role="main">

        <?php do_action( 'slime_content_before' ); ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="large reveal portfolio-reveal single-modal" data-id="<?php echo get_the_ID(); ?>" id="portfolio-modal-<?php echo get_the_ID(); ?>" data-reveal data-animation-in="fade-in" data-animation-out="fade-out">

                <button class="close-button" data-close aria-label="Close modal" type="button">
                    ✕
                </button>

                <img src="<?php echo esc_url( $portfolio_header_image ); ?>">

            </div>

            <div class="pull-under-large grid-container">
                <div class="grid-x">
                    <div class="small-12 large-7 cell small-order-2 medium-order-1">

                        <?php /* <a href="#" data-featherlight="<?php echo esc_url( $portfolio_header_image ); ?>"><img src="<?php echo esc_url( $portfolio_header_image ); ?>" /></a> */ ?>
                        <div class="show-for-medium" data-open="portfolio-modal-<?php echo get_the_ID(); ?>" style="background-image: url( <?php echo esc_url( $image ); ?> );">
                            <img src="<?php echo esc_url( $portfolio_header_image ); ?>" />
                        </div>
                        <div class="hide-for-medium" style="background-image: url( <?php echo esc_url( $image ); ?> );">
                            <img src="<?php echo esc_url( $portfolio_header_image ); ?>" />
                        </div>

                    </div>
                    <div class="small-12 large-5 cell small-order-2 medium-order-1 text-left medium-text-right">
	                    <?php the_title('<h1 class="entry-title">','</h1>'); ?>
                        <span class="companies"><?php echo $company_list[0]->name; ?></span>
                    </div>
                </div>
            </div>

            <div class="grid-container text-center">
                <div class="grid-x align-center">
                    <div class="cell small-12 portfolio-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

	        <?php if ( function_exists( 'related_portfolio' ) ): ?>
                <div class="grid-container margin-top-large">
                    <div class="overflow-container text-center">
                        <h3 class="lines lines-gray color-gray"><?php esc_html_e( 'Similar Projects', 'tmg' ); ?></h3>
                    </div>
                    <?php echo get_related_portfolio( array('project', 'project_type'), 'cell small-12 medium-6 large-3'); ?>
                </div>
            <?php endif; ?>


        <?php endwhile; ?>

        <?php do_action( 'slime_after_content' ); ?>

    </div>
</div>

<?php
get_footer();
