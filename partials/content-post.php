<?php
/**
 * Content Template
 *
 * The default template for displaying content. Used within single and index/archive/search templates.
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage TemplateParts
 */

?>

<?php
/** This action is documented in includes/Slime/utilities/hooks.php */
do_action( 'slime_post_before' );
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Article">

	<header>
		<?php the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="grid-x">
			<div class="small-12 cell" itemprop="image">
				<?php the_post_thumbnail( '', array( 'class' => 'th' ) ); ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="entry-content" itemprop="articleBody">
		<?php
		/** This action is documented in includes/Slime/utilities/hooks.php */
		do_action( 'slime_post_entry_content_before' );
		?>

		<?php the_content(); ?>

		<?php
		/** This action is documented in includes/Slime/utilities/hooks.php */
		do_action( 'slime_post_entry_content_after' );
		?>
	</div>

	<footer>
		<?php
		wp_link_pages(
			array(
				'before' => '<nav id="page-nav"><p>' . esc_html__( 'Pages:', 'slime' ),
				'after'  => '</p></nav>',
			)
		);
		?>
		<div class="tags"><?php the_tags(); ?></div>
	</footer>

	<hr/>

	<?php

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	?>

</article>
<?php
/** This action is documented in includes/Slime/utilities/hooks.php */
do_action( 'slime_post_after' );
