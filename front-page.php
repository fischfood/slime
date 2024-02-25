<?php
/**
 * Front Page Template
 *
 * Default template utilized when your theme has a define "Front Page"
 * within Setting->Reading within the WordPress admin
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage Templates
 */

?>

<?php get_header(); ?>

<div class="container padding-vertical">
    <?php the_content(); ?>
</div>

<?php
get_footer();
