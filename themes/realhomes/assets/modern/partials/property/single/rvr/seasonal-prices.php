<?php
/**
 * Property Seasonal Prices Section.
 *
 * @since   3.15.0
 * @package realhomes/modern/property
 */

if ( inspiry_is_rvr_enabled() && 'true' === get_option( 'inspiry_seasonal_prices_display', 'true' ) ) {

	$seasonal_prices = get_post_meta( get_the_ID(), 'rvr_seasonal_pricing', true );
	if ( ! empty( $seasonal_prices ) ) {
		?>
        <div class="rvr_seasonal_prices_wrap <?php realhomes_printable_section( 'rvr/seasonal-prices' ); ?>">
			<?php
			$section_heading = get_option( 'inspiry_seasonal_prices_heading', esc_html__( 'Seasonal Prices', 'framework' ) );
			if ( ! empty( $section_heading ) ) {
				?>
                <h4 class="rh_property__heading"><?php echo esc_html( $section_heading ); ?></h4>
				<?php
			}
			?>
            <table class="rvr_seasonal_prices">
	            <?php
	            $count = 0;

	            foreach ( $seasonal_prices as $season_price ) {
		            if ( ! empty( $season_price['rvr_price_start_date'] ) && ! empty( $season_price['rvr_price_end_date'] ) && ! empty( $season_price['rvr_price_amount'] ) ) {

			            if ( 0 === $count ) {
				            ?>
                            <tr>
                                <th class="sp-start-date-column"><?php echo esc_html( get_option( 'inspiry_sp_start_date_column_label', esc_html__( 'Start Date', 'framework' ) ) ); ?></th>
                                <th class="sp-end-date-column"><?php echo esc_html( get_option( 'inspiry_sp_end_date_column_label', esc_html__( 'End Date', 'framework' ) ) ); ?></th>
                                <th class="sp-price-column"><?php echo esc_html( get_option( 'inspiry_sp_price_column_label', esc_html__( 'Per Night', 'framework' ) ) ); ?></th>
                            </tr>
				            <?php
			            }
			            ?>
                        <tr>
                            <td><?php echo esc_html( realhomes_apply_wp_date_format( $season_price['rvr_price_start_date'] ) ); ?></td>
                            <td><?php echo esc_html( realhomes_apply_wp_date_format( $season_price['rvr_price_end_date'] ) ); ?></td>
                            <td><?php echo esc_html( ere_format_amount( intval( $season_price['rvr_price_amount'] ) ) ); ?></td>
                        </tr>
			            <?php
			            $count++;
		            }
	            }
	            ?>
            </table>
        </div>
		<?php
	}
}