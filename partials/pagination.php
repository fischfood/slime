<?php
/**
 * Pagination Partial
 *
 * Display navigation to next/previous pages when applicable.
 *
 * @since      1.0.0
 *
 * @package    Slime
 * @subpackage TemplateParts
 */

?>

<?php do_action( 'slime_pagination_before' ); ?>

<div itemprop="pagination">
	<?php
	if ( function_exists( 'slime_pagination' ) ) :
		slime_pagination( '&laquo;', '&raquo;' );
	elseif ( is_paged() ) :
	?>
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'slime' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'slime' ) ); ?></div>
		</nav>
	<?php endif; ?>
</div>

<?php do_action( 'slime_pagination_after' );
