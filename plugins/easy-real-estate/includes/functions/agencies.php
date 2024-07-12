<?php
/**
 * Functions related to agencies
 */


if (!function_exists('ere_get_agency_properties_count')) {
	/**
	 * Function: Returns the number of listed properties by an agency.
	 *
	 * @param int $agency_id - Agency ID for properties.
	 * @param string $post_status - Status of properties.
	 *
	 * @return integer|boolean
	 *
	 */
	function ere_get_agency_properties_count($agency_id, $post_status = '')
	{
		// Return if agency id is empty.
		if (empty($agency_id)) {
			return false;
		}

		$agency_post = get_post($agency_id);
		if (empty($agency_post)) {
			return false;
		}

		$user_role = get_user_meta($agency_post->post_author, 'inspiry_user_role', true);
		if (empty($user_role) || $user_role !== 'agency') {
			return false;
		}

		$authors = [$agency_post->post_author];

		// Get all users when inspiry_user_role is agent, and inspiry_user_agency === agency_id
		$agent_user_ids = get_users(
			array(
				'meta_key' => 'inspiry_user_agency',
				'meta_value' => $agency_id,
				'fields' => 'ID'
			)
		);

		// Remove duplicates
		$agent_user_ids = array_unique($agent_user_ids);
		if (!empty($agent_user_ids)) {
			$authors = array_merge($authors, $agent_user_ids);
		}

		global $wpdb;
		$authors_placeholder = implode(',', array_fill(0, count($authors), '%d'));
		$query = "SELECT COUNT( * ) AS num_posts FROM {$wpdb->posts} WHERE post_type = %s";
		if (!empty($post_status)) {
			$query .= " AND post_status = %s";
		}
		$query .= " AND post_author IN ($authors_placeholder)";

		// Prepare the query with the appropriate values
		if (!empty($post_status))
			$query = $wpdb->prepare($query, array_merge(['property', $post_status], $authors));
		else
			$query = $wpdb->prepare($query, array_merge(['property'], $authors));

		$results = (array) $wpdb->get_results($query, ARRAY_A);
		if (empty($results) || count($results) === 0 || !isset($results[0]['num_posts'])) {
			return false;
		}

		$num_posts = (int) $results[0]['num_posts'];
		if ($num_posts === 0) {
			return false;
		}

		return $num_posts;
	}
}