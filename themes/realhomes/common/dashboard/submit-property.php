<?php
global $target_property, $edit_property_id, $invalid_nonce, $submitted_successfully, $updated_successfully;

if (isset($_GET['id']) && !empty($_GET['id'])) {

	$edit_property_id = intval(trim($_GET['id']));
	$target_property = get_post($edit_property_id);

	// Check if passed id is a proper property post
	if (!empty($target_property) && ('property' == $target_property->post_type)) {
		// Check Author.
		$current_user = wp_get_current_user();

		// Check if current logged in user is the author of property
		// Or user is agency and property is assigned to that agency
		$user_role = get_user_meta($current_user->ID, 'inspiry_user_role', true);
		$agency_id = get_user_meta($current_user->ID, 'inspiry_role_post_id', true);

		if ($target_property->post_author == $current_user->ID) {
			global $post_meta_data;
			$post_meta_data = get_post_custom($target_property->ID);
		} else if ($user_role === 'agency' && $agency_id) {
			// Get all users when inspiry_user_role is agent, and inspiry_user_agency === agency_id
			$agent_user_ids = get_users(
				array(
					'meta_key' => 'inspiry_user_agency',
					'meta_value' => $agency_id,
					'fields' => 'ID'
				)
			);

			if (in_array($target_property->post_author, $agent_user_ids)) {
				global $post_meta_data;
				$post_meta_data = get_post_custom($target_property->ID);
			}
		}
	}
}

// Update the variable for guest property submission.
if (!is_user_logged_in() && inspiry_guest_submission_enabled() && isset($_GET['property-added']) && 'true' === $_GET['property-added']) {
	$submitted_successfully = true;
}
?>
<div id="dashboard-submit-property" class="dashboard-submit-property">
	<?php
	if ($invalid_nonce) {
		realhomes_dashboard_notice(
			array(
				esc_html__('Error: ', 'framework'),
				esc_html__('Security check failed!', 'framework')
			),
			'error'
		);
	} else if ($submitted_successfully) {
		realhomes_dashboard_notice(
			array(
				esc_html__('Success:', 'framework'),
				get_option('theme_submit_message')
			),
			'success'
		);
	} else if ($updated_successfully) {
		realhomes_dashboard_notice(
			array(
				esc_html__('Success:', 'framework'),
				esc_html__('Property updated successfully!', 'framework')
			),
			'success'
		);
	} else if (realhomes_get_current_user_role_option('property_submit') || inspiry_guest_submission_enabled()) {
		if (class_exists('IMS_Helper_Functions') && !empty(IMS_Helper_Functions::is_memberships())) {

			// Get the user's current allowed properties value.
			$current_properties = get_user_meta(wp_get_current_user()->ID, 'ims_current_properties', true);

			// Show add/edit property form.
			if (isset($_GET['id']) && !empty($_GET['id']) || (!is_user_logged_in() && inspiry_guest_submission_enabled()) || ('' !== $current_properties && 0 !== intval($current_properties))) {
				get_template_part('common/dashboard/submit-property-form');
			} else if ('' === $current_properties) {
				realhomes_dashboard_notice(
					array(
						esc_html__('Info:', 'framework'),
						esc_html__('Please subscribe a membership package to start publishing properties.', 'framework')
					)
				);
			} else {
				realhomes_dashboard_notice(
					array(
						esc_html__('Info:', 'framework'),
						esc_html__('You have reached the maximum allowed number of properties of your current membership package.', 'framework')
					)
				);
			}
		} else {
			get_template_part('common/dashboard/submit-property-form');
		}
	} else {
		realhomes_dashboard_notice(
			array(
				esc_html__('Caution:', 'framework'),
				esc_html__('You are not allowed to visit this template!', 'framework')
			),
			'error'
		);
	}
	?>
</div><!-- #dashboard-submit-property -->