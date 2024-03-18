<?php 
/**
 * $name: 'solutions'
 * $attributes: [solutionID]
 * $content: false
 */

$solution_id = $attributes['solutionID'];

$solution_query_args = array(
    'post_type'      => 'solution',
    'posts_per_page' => 99,
    'post_parent' => 0,
    'orderby' => 'menu_order name'
);

if ( $solution_id !== '0' ) {
    $solution_query_args['post__in'] = [$solution_id];
}

$solution_query = new WP_Query( $solution_query_args );
?>


<?php if ( $solution_query->have_posts() ): ?>
    <div class="solution-blocks flex-container column">
        <?php while ( $solution_query->have_posts() ): $solution_query->the_post(); ?>

        <?php $parent_post_id = get_the_ID(); ?>

            <?php
            $child_solution_args = array(
                'post_type'      => 'solution', // Change 'post' to your custom post type if needed
                'post_status'    => 'publish',
                'posts_per_page' => 99, // -1 to retrieve all child posts
                'post_parent'    => $parent_post_id,
            );

            $child_solutions_query = new WP_Query( $child_solution_args );
            $rand = rand(1000,5000);
            ?>

            <div class="solution-block">

                <div class="flex-container">

                    <div class="solution-block-image-container">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>

                    <div class="solution-block-content-container">
                        <?php the_title('<h2>','</h2>'); ?>

                        <div class="solution-block-content">
                            <?php the_content(); ?>
                        </div>

                        <div class="solution-block-accordion-toggle">

                            <?php wave_divider( 'mt-1' ); ?>
                            <h3>
                                <button aria-expanded="false" aria-controls="accordion-panel-<?php echo esc_html( $parent_post_id . '-' . $rand ); ?>" id="solution-accordion-<?php echo esc_html( $parent_post_id . '-' . $rand ); ?>">
                                    <?php esc_html_e( 'Project Types and Pricing', 'slime' ); ?>
                                </button>
                            </h3>
                        </div>
                        
                    </div>
                </div>

                <section class="solution-block-accordion-content" id="accordion-panel-<?php echo esc_html( $parent_post_id . '-' . $rand ); ?>" aria-labelledby="solution-accordion-<?php echo esc_html( $parent_post_id . '-' . $rand ); ?>" hidden>

                    <?php if ( $child_solutions_query->have_posts() ): ?>

                        <div class="flex-container">
                            <div class="solution-block-image-container">
                                <a href="#" class="button"><?php esc_html_e( 'Request Estimate', 'slime' ); ?></a>
                            </div>

                            <div class="solution-block-content-container">
                                <?php while ( $child_solutions_query->have_posts() ) : $child_solutions_query->the_post(); ?>

                                    <?php
                                        $price = get_post_meta( get_the_ID(), 'solution_price', true );
                                        $timeframe = get_post_meta( get_the_ID(), 'solution_time_frame', true );
                                        $gallery = get_post_meta( get_the_ID(), 'solution_gallery', true );

                                        $price_time = [];

                                        if ( ! empty( $price ) ) {
                                            $price_time[] = sprintf( esc_html__('starts at $%s', 'slime' ), number_format( (int) $price) );
                                        }

                                        if ( ! empty( $timeframe ) ) {
                                            $price_time[] = esc_html( $timeframe );
                                        }
                                    ?>

                                    <?php if ( '' !== get_the_content() ): ?>
                                    
                                        <details class="solution-block-subaccordion">

                                            <summary class="solution-block-subaccordion-toggle">
                                                <h4><?php the_title(); ?></h4>
                                            </summary>

                                            <div class="solution-block-subaccordion-content">
                                                <?php the_content(); ?>

                                                <?php if ( ! empty( $price_time ) ): ?>
                                                    <p><?php echo implode( ', ', $price_time ); ?></p>
                                                <?php endif; ?>
                                            </div>

                                        </details>

                                    <?php endif; ?>

                                <?php endwhile; wp_reset_postdata(); ?>
                            </div>
                        </div>

                    <?php else: ?>

                        <p>Lorem ipsum dolor sit amet ...</p>

                    <?php endif; ?>

                </section>

                <?php wave_divider( 'mt-1-5 px-1' ); ?>

            </div>

        <?php endwhile; wp_reset_postdata(); ?>
    </div>
<?php endif; ?>