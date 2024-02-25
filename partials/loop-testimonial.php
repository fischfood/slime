<?php
/**
 * Testimonial Loop Template
 *
 * The default template for displaying looped testimonial content within pages
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage TemplateParts
 */

if ( !$grid_set ) {
	$grid_set = 'cell small-12';
}

if ( !$loop_block_classes ) {
	$loop_block_classes = '';
}

$endorser = get_post_meta( get_the_id(), 'testimonial_name', true);
$company = get_post_meta( get_the_id(), 'testimonial_company', true);

$slash = ( $endorser != '' && $company != '' ) ? '<span class="color-white"> / </span>' : '';


?>

<?php
/** This action is documented in includes/Slime/utilities/hooks.php */
do_action( 'slime_post_before' );
?>

    <article <?php post_class( $grid_set . ' loop-testimonial ' . $loop_block_classes ); ?> id="post-<?php the_ID(); ?>">

        <div class="grid-x">
            <div class="small-12 cell">
                <h4 class="testimonial-content"><span class="quote">&ldquo;</span><?php the_content(); ?><span class="quote">&rdquo;</span></h4>
                <p class="testimonial-details">-
                    <span class="endorser"><?php esc_html_e($endorser); ?></span>
                    <?php echo $slash; ?>
                    <strong class="company"><?php esc_html_e($company); ?></strong>
                </p>
            </div>
        </div>

    </article>
<?php
/** This action is documented in includes/Slime/utilities/hooks.php */
do_action( 'slime_post_after' );
