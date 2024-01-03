<?php
/**
 * Hero/Slideshow area
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage TemplateParts
 */

$hero_bg = '';
$hero_bg_classes = '';

if ( get_the_post_thumbnail_url() != '' ) {
    $hero_bg = 'background-image: url(' . get_the_post_thumbnail_url() . ');';
    $hero_bg_classes = 'background-hero';
}

while (have_posts()) : the_post();
?>

<header id="homepage-hero" class="text-center margin-top-large pull-under" role="banner">
    <div class="grid-container">
        <div class="grid-x">
            <div class="cell text-center <?php echo $hero_bg_classes; ?>" style="<?php esc_html_e( $hero_bg ); ?>">

				<?php the_content(); ?>

            </div>
        </div>
    </div>
</header>

<?php endwhile;