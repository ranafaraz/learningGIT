<div class="rh-ultra-thumb-info-box">
    <div class="page-head-inner">
        <div class="rh-ultra-property-tags rh-property-title">
			<?php
			if ( function_exists( 'ere_get_property_statuses_ultra' ) ) {
				ere_get_property_statuses_ultra( get_the_ID(), 'rh-ultra-status rh-ultra-property-tag' );
			}

			$is_featured = get_post_meta( get_the_ID(), 'REAL_HOMES_featured', true );
			if ( $is_featured ) {
				?>
                <span class="rh_ultra_featured rh-ultra-property-tag"><?php esc_html_e( 'Featured', 'framework' ); ?></span>
				<?php
			}
			inspiry_display_property_label( get_the_ID(), 'rh-ultra-label rh-ultra-property-tag' );
			?>
        </div>
        <div class="rh-ultra-property-title-price">
			<?php
			if ( isset( $args['print'] ) && 'true' === $args['print'] ) {
				?>
                <span class="property-title"><?php the_title(); ?></span>
				<?php
			} else {
				?>
                <h1 class="property-title"><?php the_title(); ?></h1>
				<?php
			}

			if ( function_exists( 'ere_property_price' ) ) {
				?>
                <div class="rh-ultra-property-tag-wrapper">
					<?php
					$price_on_call = '';
					$amount        = floatval( get_post_meta( get_the_ID(), 'REAL_HOMES_property_price', true ) );
					if ( empty( $amount ) || is_nan( $amount ) ) {
						$price_on_call = ' price-on-call ';
					}
					?>
                    <span class="rh-ultra-price <?php echo esc_attr( $price_on_call ) ?>"><?php ere_property_price( get_the_ID(), true ); ?></span>
                </div>
				<?php
			}
			?>
        </div>
		<?php
		$address_display  = get_option( 'inspiry_display_property_address', 'true' );
		$property_address = get_post_meta( get_the_ID(), 'REAL_HOMES_property_address', true );

		if ( 'true' === $address_display && ! empty( $property_address ) ) {
			?>
            <p class="rh-ultra-property-address">
                <span class="rh-ultra-address-pin"><?php inspiry_safe_include_svg( '/ultra/icons/pin-line.svg', '/assets/' ); ?></span>
				<?php echo esc_html( $property_address ); ?>
            </p>
			<?php
		}
		?>
    </div>
	<?php inspiry_property_qr_code( '100' ); ?>
</div>