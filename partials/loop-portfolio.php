<?php
/**
 * Portfolio Loop Template
 *
 * The default template for displaying looped portfolio content within pages
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage TemplateParts
 */

if ( !$grid_set ) {
	$grid_set = 'cell small-12 medium-6 large-4';
}

if ( !$loop_block_classes ) {
	$loop_block_classes = '';
}

$thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url() : '';
$thumb_style = ( $thumbnail ) ? 'background-image: url(' . $thumbnail . ')' : '';
$avg_bg = ( $thumbnail ) ? 'background-color: #' . get_average_color( $thumbnail ) : '';

?>

<?php
/** This action is documented in includes/Linchpin/utilities/hooks.php */
do_action( 'slime_post_before' );
?>

    <article <?php post_class( $grid_set . ' loop-portfolio text-left ' . $loop_block_classes ); ?> id="post-<?php the_ID(); ?>">


        <div class="grid-x">
            <div class="small-12 cell clickable image-container cb-container cb-hidden" itemprop="image" data-equalizer-watch style="background-image: url(<?php echo esc_url( $thumbnail ); ?>);">
                <img src="<?php echo esc_url( $thumbnail ); ?>" />
                <div class="cb-bg" style="<?php echo $thumb_style; ?>"></div>
                <div class="cb-overlay" style="<?php echo $avg_bg; ?>"></div>
                <?php the_title( '<h2 class="entry-title" itemprop="name"><a href="' . get_the_permalink() . '" itemprop="url">', '</a></h2>' ); ?>
            </div>
        </div>


    </article>
<?php
/** This action is documented in includes/Linchpin/utilities/hooks.php */
do_action( 'slime_post_after' );
