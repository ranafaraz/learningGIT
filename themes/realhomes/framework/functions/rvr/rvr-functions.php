<?php
/**
 * This file is responsible for the Vacation Rentals related functions
 *
 * @since 4.0.0
 */

if ( ! function_exists( 'realhomes_update_booking_status' ) ) {
	/**
	 * Update booking status on booking status edit from front-end dashboard
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	function realhomes_update_booking_status() {

		// Default booking statuses
		$booking_statuses = array(
			'pending',
			'cancelled',
			'confirmed',
			'rejected'
		);

		// Validate the request data
		if ( ! empty( intval( $_GET['bookingId'] ) ) && ! empty( $_GET['bookingStatus'] ) && in_array( $_GET['bookingStatus'], $booking_statuses ) ) {

			$booking_id     = $_GET['bookingId'];
			$booking_status = $_GET['bookingStatus'];

			// Update booking status
			update_post_meta( intval( $booking_id ), 'rvr_booking_status', $booking_status );

			echo wp_json_encode( array(
				'success' => true,
			) );

		} else {
			echo wp_json_encode( array(
				'success' => false,
				'message' => esc_html__( 'Invalid Request!', 'framework' )
			) );
		}

		wp_die();
	}

	add_action( 'wp_ajax_nopriv_update_booking_status', 'realhomes_update_booking_status' );
	add_action( 'wp_ajax_update_booking_status', 'realhomes_update_booking_status' );
}