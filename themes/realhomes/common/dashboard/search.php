<?php
global $current_module;

if ( is_user_logged_in() && ( 'show' == get_option( 'inspiry_my_properties_search', 'show' ) ) ) {

	switch ( $current_module ) {
		case 'bookings':
			$search_placeholder = esc_html__( 'Search Booking ID', 'framework' );
			break;
		case 'reservations':
			$search_placeholder = esc_html__( 'Search Reservation ID', 'framework' );
			break;
		case 'invoices':
			$search_placeholder = esc_html__( 'Search Invoice ID', 'framework' );
			break;
		default:
			$search_placeholder = esc_html__( 'Search Properties', 'framework' );
	}

	if ( 'properties' !== $current_module ) {
		$redirect_page_url = realhomes_get_dashboard_page_url( $current_module );
	} else {
		$redirect_page_url = realhomes_get_dashboard_page_url( 'properties' );
	}
	?>
    <div class="dashboard-search-wrap">
        <form id="dashboard-search-form" class="dashboard-search-form" action="<?php echo esc_url( $redirect_page_url ); ?>" autocomplete="off">
            <input type="text" name="posts_search" value="" id="dashboard-search-form-input" placeholder="<?php echo esc_attr( $search_placeholder ); ?>">
            <button type="submit" id="dashboard-search-form-submit-button" class="submit-button">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
	<?php
}