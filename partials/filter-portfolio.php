<?php
$f = 0;
$filters = array( 'project_type', 'application', 'project');
$filter_titles = array( 'Type', 'Application', 'Project' );

$queried = get_queried_object();
?>

<div class="portfolio-filter-container background-primary">
	<div class="grid-container">
		<div class="grid-x grid-offset">
			<?php foreach ( $filters as $filter ): ?>
				<div class="small-12 medium-4 cell offset-padding">

					<?php
					$terms = get_terms( array(
						'taxonomy' => $filter,
						'hide_empty' => true,
					) );
					?>

					<?php $active_filter = ( ! empty( $queried->taxonomy ) && $queried->taxonomy == $filters[$f] ) ? 'active-filter' : ''; ?>
					<?php $active_val = ( ! empty( $queried->taxonomy ) && $queried->taxonomy == $filters[$f] ) ? get_site_url() . '/portfolio/' : ''; ?>

					<select id="<?php esc_html_e( $filter ); ?>" name="<?php esc_html_e( $filter ); ?>" class="<?php echo $active_filter; ?>">
						<option value="<?php echo $active_val; ?>"><?php echo $filter_titles[$f]; ?></option>

						<?php foreach ( $terms as $term ) {

							$term_link = get_term_link( $term );
							$term_name = $term->name;

							$selected = ( $queried->taxonomy == $filters[$f] && $queried->name == $term_name) ? 'selected="selected"' : '';

							echo '<option value="' . $term_link . '" ' . $selected . ' >' . $term_name . '</option>';
						}
						?>

					</select>

				</div>
				<?php $f++; ?>
			<?php endforeach; ?>

			<?php if (is_tax() ): ?>
				<div class="small-12 cell text-center reset-container">
					<a href="/portfolio/"><?php esc_html_e('Reset','slime'); ?></a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>