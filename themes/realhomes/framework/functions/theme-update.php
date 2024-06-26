<?Php
/**
 * Theme Auto Update
 */

/*
// TEMP: Enable update check on every request. Normally we don't need this! This is for testing only!
*/
//set_site_transient( 'update_themes', null );

if ( ! function_exists( 'inspiry_check_for_update' ) ) {
	/**
	 * Check for the theme update if available
	 *
	 * @param $checked_data
	 *
	 * @return mixed
	 */
	function inspiry_check_for_update( $checked_data ) {

		global $wp_version;
		$api_url = 'http://update.inspirythemes.com/themes/realhomes/';

		$request = array(
			'slug'    => 'realhomes',
			'version' => INSPIRY_THEME_VERSION
		);

		// Start checking for an update
		$send_for_check = array(
			'body'       => array(
				'action'  => 'theme_update',
				'request' => serialize( $request ),
				'api-key' => md5( home_url() )
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
		);

		$raw_response = wp_remote_post( $api_url, $send_for_check );

		if ( ! is_wp_error( $raw_response ) && ( $raw_response['response']['code'] ) == 200 ) {
			$response = unserialize( $raw_response['body'] );

			// Feed the update data into WP updater
			if ( ! empty( $response ) ) {
				$checked_data->response['realhomes'] = $response;
			}
		}

		return $checked_data;
	}

	add_filter( 'pre_set_site_transient_update_themes', 'inspiry_check_for_update' );
}

if ( ! function_exists( 'realhomes_admin_note' ) ) {
	/**
	 * Display an admin note to the users
	 *
	 * @since 4.0.1
	 * @return void
	 */
	function realhomes_admin_note() {

		$current_user_id   = get_current_user_id();
		$dismiss_note_flag = '4.0.1'; // Whenever there is a change in the note below, simply set the current update version here and dismissible note will be displayed to the user.

		if ( isset( $_GET['realhomes-dismiss-note'] ) ) { // Set the dismissed note flag to the user meta on user request.
			update_user_meta( $current_user_id, 'realhomes_dismiss_note', $dismiss_note_flag );
		}

		$dismiss_note_user_flag = get_user_meta( $current_user_id, 'realhomes_dismiss_note', true );

		if ( ! empty( $dismiss_note_user_flag ) ) {

			if ( $dismiss_note_flag === $dismiss_note_user_flag ) { // Don't display the note if user has dismissed the latest note already.
				return;
			}

			delete_user_meta( $current_user_id, 'realhomes_dismiss_note' ); // Remove the old dismissed note flag data from the user meta.
		}
		?>
        <div id="rh-admin-notice" class="rh-admin-notice notice notice-success" style="position: relative">
            <h2>RealHomes Update Note!</h2>
            <p>Since <strong>v4.0.0</strong> RealHomes theme comes with another <strong>New Ultra Design</strong> variation in addition to Classic and Modern designs.</p>
            <p>If you want to migrate to Ultra from any of the existing design variations, it is highly recommended that you follow this <a href="https://support.inspirythemes.com/knowledgebase/realhomes-design-switching-to-ultra/" target="_blank">knowledge base article</a>.</p>
            <a class="notice-dismiss" href="?realhomes-dismiss-note"><span class="screen-reader-text">Dismiss this notice.</span></a>
        </div>
		<?php
	}

	add_action( 'admin_notices', 'realhomes_admin_note' );
}
