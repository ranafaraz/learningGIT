<?php
/**
 * Grid Property Card
 *
 * Property grid card to be displayed on grid listing page.
 *
 * @since      4.2.0
 * @package    realhomes
 * @subpackage ultra
 */

$property_id = get_the_ID();
?>
<div class="rh-ultra-property-card-two-wrapper">
    <div class="rh-ultra-property-card-two">
        <div class="rh-ultra-property-card-two-thumb">
            <a href="<?php the_permalink() ?>">
				<?php
				if ( ! empty( get_the_post_thumbnail( $property_id ) ) ) {
					the_post_thumbnail( 'modern-property-child-slider' );
				} else {
					inspiry_image_placeholder( 'modern-property-child-slider' );
				}
				?>
            </a>
        </div>
        <div class="rh-ultra-property-card-two-content">
            <h3 class="rh-ultra-property-card-two-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php
			$REAL_HOMES_property_address = get_post_meta( $property_id, 'REAL_HOMES_property_address', true );
			if ( ! empty( $REAL_HOMES_property_address ) ) {
				?>
                <span class="rh-ultra-property-card-two-address"><?php echo esc_html( $REAL_HOMES_property_address ); ?></span>
				<?php
			}

			get_template_part( 'assets/ultra/partials/properties/card-parts/grid-card-meta' );
			?>
            <div class="rh-ultra-property-card-two-footer">
                <p class="rh-ultra-property-card-two-price">
					<?php
					if ( function_exists( 'ere_property_price' ) ) {
						ere_property_price( $property_id );
					}
					?>
                </p>
                <a class="rh-ultra-property-card-two-link" href="<?php the_permalink(); ?>">
					<?php esc_html_e( 'View Details', 'framework' ); ?>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L5 5L1 9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
    </div><!-- .rh-ultra-property-card-two -->
</div><!-- .rh-ultra-property-card-two-wrapper -->