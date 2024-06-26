<?php
/**
 * Field: Featured
 *
 * @since    3.0.0
 * @package  realhomes/dashboard
 */
?>
<p class="checkbox-field">
	<?php
	global $dashboard_globals;
	$dashboard_url = $dashboard_globals['dashboard_url'];
	$disabled      = $checked = '';

	if ( realhomes_dashboard_edit_property() ) {
		global $post_meta_data;
		if ( isset( $post_meta_data['REAL_HOMES_featured'] ) && ( 1 == $post_meta_data['REAL_HOMES_featured'][0] ) ) {
			$checked = 'checked';
		}
	}

	// Check if inspiry memberships plugin is active.
	if ( inspiry_is_ims_plugin_activated() ) {
		// Check if membership module is enabled.
		$ims_helper_functions  = IMS_Helper_Functions();
		$is_memberships_enable = $ims_helper_functions::is_memberships();
		$update_link           = add_query_arg( 'module', 'membership', $dashboard_url );

		if ( ! empty( $is_memberships_enable ) ) {
			$current_membership       = $ims_helper_functions::ims_get_membership_by_user( wp_get_current_user() );
			$current_allowed_featured = $ims_helper_functions::get_user_featured_properties( array( 'remaining' => true ) );

			// Check user current featured properties.
			if ( empty( $checked ) && $current_allowed_featured < 1 ) {
				$disabled = true;
			}
		}
	}

	if ( $disabled ) {
		?>
        <span><?php printf( esc_html__( "%s Your featured properties are at limit. You can %s your subscription to manage your limits.", 'framework' ), '<strong>' . esc_html__( 'Note:', 'framework' ) . '</strong>', '<a href="' . esc_url( $update_link ) . '">' . esc_html__( 'Change/Update', 'framework' ) . '</a>' ); ?></span>
		<?php
	} else {
		?>
        <input id="featured" name="featured" type="checkbox" <?php echo esc_html( $checked ) . ' ' . esc_html( $disabled ); ?> />
        <label for="featured"><?php esc_html_e( 'Mark this property as featured property', 'framework' ); ?></label>
		<?php
	}
	?>
</p>