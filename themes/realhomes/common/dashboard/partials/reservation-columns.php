<?php
/**
 * Dashboard: Reservation Columns
 *
 * @package realhomes
 * @subpackage dashboard
 * @since 4.3.0
 */
?>
<div class="dashboard-posts-list-head">
	<div class="large-column-wrap">
		<div class="column column-info"><span><?php esc_html_e( 'Reservation Info', 'framework' ); ?></span></div>
	</div>
	<div class="small-column-wrap">
		<div class="column column-booked-on"><span><?php esc_html_e( 'Reserved On', 'framework' ); ?></span></div>
		<div class="column column-booking-period">
			<span><?php esc_html_e( 'Reservation Period', 'framework' ); ?></span>
		</div>
		<div class="column column-status">
			<span><?php esc_html_e( 'Status', 'framework' ); ?></span>
		</div>
		<div class="column column-price"><span><?php esc_html_e( 'Price', 'framework' ); ?></span></div>
		<div class="column column-booked-by"><span><?php esc_html_e( 'Property Owner', 'framework' ); ?></span></div>
	</div>
</div>