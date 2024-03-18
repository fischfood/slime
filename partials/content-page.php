<?php
/**
 * Content Template
 *
 * The default template for displaying content within pages.
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage TemplateParts
 */

$thumbnail = ( get_the_post_thumbnail() ) ? 'background-image: url(' . get_the_post_thumbnail_url() . ')' : '';
?>

<div class="grid-container grid-x">
    <div class="small-12 cell">

        <?php
        /** This action is documented in includes/Slime/utilities/hooks.php */
        do_action( 'slime_post_before' );
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php
            /** This action is documented in includes/Slime/utilities/hooks.php */
            do_action( 'slime_post_entry_content_before' );
            ?>

            <div class="entry-content">
                <?php the_content( esc_html__( 'Continue reading...', 'slime' ) ); ?>
            </div>

            <?php
            /** This action is documented in includes/Slime/utilities/hooks.php */
            do_action( 'slime_post_entry_content_after' );
            ?>
        </article>

        <?php
        /** This action is documented in includes/Slime/utilities/hooks.php */
        do_action( 'slime_post_after' );
        ?>

    </div>
</div>
