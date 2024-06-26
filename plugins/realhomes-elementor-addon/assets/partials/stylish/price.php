<?php
global $settings;
?>
<div class="rh_prop_card__priceLabel_sty">
    <span class="rh_prop_card__status_sty">
          <?php
          if (
              ! empty( $settings['ere_show_property_status_with_price'] )
              && 'yes' === $settings['ere_show_property_status_with_price']
              && function_exists( 'ere_get_property_statuses' )
          ) {
              echo esc_html( ere_get_property_statuses( get_the_ID() ) );
          }
          ?>
    </span>
    <p class="rh_prop_card__price_sty">
		<?php
		if ( function_exists( 'ere_property_price' ) ) {
			if ( ! empty( $settings['rhea_show_old_price'] ) && 'yes' === $settings['rhea_show_old_price'] ) {
				ere_property_price( get_the_ID(), true );
			} else {
				ere_property_price();
			}
		}
		?>
    </p>
</div>