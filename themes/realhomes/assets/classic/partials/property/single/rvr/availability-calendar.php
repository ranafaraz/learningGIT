<?php
// RVR - property availability calendar
if ( inspiry_is_rvr_enabled() && inspiry_show_rvr_availability_calendar() ) {

	$availability_table = get_post_meta( get_the_ID(), 'rvr_property_availability_table', true );
	$booking_type       = get_option( 'rvr_settings' )['rvr_booking_type'] ?? 'full_day';
	$data_dates         = array();

	if ( ! empty( $availability_table ) && is_array( $availability_table ) ) {

		foreach ( $availability_table as $dates ) {

			$begin = new DateTime( $dates[0] );
			$end   = new DateTime( $dates[1] );
			if ( ( 'full_day' === $booking_type ) || ( 'split_day' === $booking_type && $begin == $end ) ) {
				$end = $end->modify( '+1 day' );
			}

			$interval  = new DateInterval( 'P1D' );
			$daterange = new DatePeriod( $begin, $interval, $end );

			foreach ( $daterange as $date ) {
				$data_dates[] = $date->format( "Y-m-d" );
			}
		}

		$data_dates = implode( ',', $data_dates );
	} else {
		$data_dates = "0-0-0";
	}

	?>
    <div class="availability-calendar-wrap">
		<?php
		$section_title = get_option( 'inspiry_availability_calendar_title', esc_html__( 'Property Availability', 'framework' ) );
		if ( ! empty( $section_title ) ) {
			echo "<h4 class='title'>{$section_title}</h4>";
		}
		?>
        <div id="property-availability" class="<?php echo esc_attr( $booking_type ) ?>" data-toggle="calendar" data-dates="<?php echo ! empty( $data_dates ) ? $data_dates : ''; ?>"></div>
    </div>
<?php } ?>