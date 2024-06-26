<?php
/**
 * This file contains card style five.
 *
 * @version 2.3.0
 */
global $settings;

$property_id = get_the_ID();
?>
<div class="rhea-ultra-property-card-five-wrapper">
    <div class="rhea-ultra-property-card-five">
        <div class="rhea-ultra-property-card-five-thumb">
			<?php rhea_get_template_part( 'assets/partials/ultra/thumbnail' ); ?>
        </div>
        <div class="rhea-ultra-property-card-five-content">
            <div class="rhea-ultra-property-card-five-content-inner">
                <h3 class="rhea-ultra-property-card-five-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php
				if ( function_exists( 'ere_property_price' ) ) {
					?><p class="rhea-ultra-property-card-five-price"><?php ere_property_price( $property_id, true, true ); ?></p><?php
				}
				?>
            </div>
			<?php
			rhea_get_template_part( 'assets/partials/ultra/address' );
			rhea_get_template_part( 'assets/partials/ultra/grid-card-meta' );

			if ( rhea_is_rvr_enabled() && $settings['rhea_rating_enable'] && ( 'true' === get_option( 'inspiry_property_ratings', 'false' ) ) ) {
				inspiry_rating_average();
			}

			$excerpt_length = ! empty( $settings['excerpt_length'] ) ? $settings['excerpt_length'] : 29;
			$excerpt        = rhea_get_framework_excerpt( $excerpt_length, '' );
			if ( ! empty( $excerpt ) ) {
				?>
                <p><?php echo esc_html( $excerpt ); ?></p>
				<?php
			}
			?>
            <div class="rhea-ultra-property-card-five-footer">
                <a class="rhea-ultra-property-card-five-link" href="<?php the_permalink(); ?>">
					<?php
					$button_text = esc_html__( 'Make a Reservation', 'realhomes-elementor-addon' );

					if ( ! empty( $settings['button_text'] ) ) {
						$button_text = $settings['button_text'];
					}

					echo esc_html( $button_text );
					?>
                </a>
            </div>
        </div>
    </div><!-- .rhea-ultra-property-card-five -->
</div><!-- .rhea-ultra-property-card-five-wrapper -->