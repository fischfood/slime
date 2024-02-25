<?php

$ctas = get_option( 'slime_ctas' );

$banner_text = ( array_key_exists( 'banner_text', $ctas ) ) ? $ctas['banner_text'] : '';
$banner_link = ( array_key_exists( 'banner_link', $ctas ) ) ? $ctas['banner_link'] : '';


?>

<?php if ( ! empty( $banner_text ) ): ?>

    <?php if ( ! empty( $banner_link ) ): ?>

        <?php $filtered_link = ( wp_http_validate_url( $banner_link ) ) ? esc_url( $banner_link ): site_url( $banner_link ); ?>

        <div class="header-banner clickable">
            <div class="container">
                <a href="<?php echo esc_url( $filtered_link ); ?>">
                    <?php echo wp_kses_post( $banner_text ); ?>
                </a>
            </div>
        </div>

    <?php else: ?>

        <div class="header-banner">
            <div class="container">
                <?php echo wp_kses_post( $banner_text ); ?>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>