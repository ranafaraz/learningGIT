<?php
/**
 * This file contains card style two.
 *
 * @version 2.2.0
 */
global $settings;

$property_id = get_the_ID();
?>
<div class="rhea-ultra-property-card-two-wrapper">
    <div class="rhea-ultra-property-card-two">
        <div class="rhea-ultra-property-card-two-thumb">
	        <?php rhea_get_template_part( 'assets/partials/ultra/thumbnail' ); ?>
        </div>
        <div class="rhea-ultra-property-card-two-content">
            <h3 class="rhea-ultra-property-card-two-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php
			if ( 'yes' == $settings['show_address'] ) {
				$REAL_HOMES_property_address = get_post_meta( $property_id, 'REAL_HOMES_property_address', true );
				if ( ! empty( $REAL_HOMES_property_address ) ) {
					?>
                    <span class="rhea-ultra-property-card-two-address"><?php echo esc_html( $REAL_HOMES_property_address ); ?></span>
					<?php
				}
			}

			rhea_get_template_part( 'assets/partials/ultra/grid-card-meta-with-ratings' );
			?>
            <div class="rhea-ultra-property-card-two-footer">
                <p class="rhea-ultra-property-card-two-price">
					<?php
					if ( function_exists( 'ere_property_price' ) ) {
						ere_property_price( $property_id );
					}
					?>
                </p>
                <a class="rhea-ultra-property-card-two-link" href="<?php the_permalink(); ?>">
					<?php esc_html_e( 'View Details', 'realhomes-elementor-addon' ); ?>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L5 5L1 9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
    </div><!-- .rhea-ultra-property-card-two -->
</div><!-- .rhea-ultra-property-card-two-wrapper -->