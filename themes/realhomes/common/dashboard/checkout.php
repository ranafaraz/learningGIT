<?php
if ( method_exists( 'IMS_Helper_Functions', 'checkout_form' ) ) {
	// Display the checkout form and also pass the redirect URL to the function.
	IMS_Helper_Functions::checkout_form( realhomes_get_dashboard_page_url( 'membership&submodule=order' ) );
}

?>