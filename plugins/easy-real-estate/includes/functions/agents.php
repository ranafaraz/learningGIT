<?php
/**
 * Functions related to agents
 */

if ( ! function_exists( 'ere_get_agent_properties_count' ) ) {
	/**
	 * Retrieve the count of properties listed by a specific agent.
	 *
	 * This function queries the database to determine the number of properties
	 * associated with a given agent ID, optionally filtered by post status.
	 *
	 * @param int    $agent_id    The unique identifier for the agent.
	 * @param string $post_status Optional. The status of properties to include in the count.
	 * @param string $post_type   Optional. The type of post to query (default: 'property').
	 * @param string $key         Optional. The meta key for agent association (default: 'REAL_HOMES_agents').
	 *
	 * @return int|false The number of listed properties by the agent, or false if agent ID is empty.
	 */
	function ere_get_agent_properties_count( $agent_id, $post_status = '', $post_type = 'property', $key = 'REAL_HOMES_agents' ) {

		// Return if agent id is empty.
		if ( empty( $agent_id ) ) {
			return false;
		}

		// Prepare query arguments.
		$properties_args = array(
			'post_type'      => $post_type,
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => $key,
					'value'   => $agent_id,
					'compare' => '=',
				),
			),
		);

		// If post status is not empty, add it to the query args.
		if ( ! empty( $post_status ) ) {
			$properties_args['post_status'] = $post_status;
		}

		$properties = new WP_Query( $properties_args );
		if ( $properties->have_posts() ) {
			return $properties->found_posts;
		}

		return false;
	}
}

if ( ! function_exists( 'ere_get_agency_agents_count' ) ) {
	/**
	 * Retrieve the count of agents associated with a specific agency.
	 *
	 * This function queries the database to determine the number of agents
	 * associated with a given agency ID, optionally filtered by post status.
	 *
	 * @since 2.2.0
	 *
	 * @param int    $agency_id   The unique identifier for the agency.
	 * @param string $post_status Optional. The status of agents posts to include in the count.
	 * @param string $post_type   Optional. The type of post to query (default: 'agent').
	 * @param string $key         Optional. The meta key for agency association (default: 'REAL_HOMES_agency').
	 *
	 * @return int|false The number of listed agents by the agency, or false if agency ID is empty.
	 */
	function ere_get_agency_agents_count( $agency_id, $post_status = '', $post_type = 'agent', $key = 'REAL_HOMES_agency' ) {
		return ere_get_agent_properties_count( $agency_id, $post_status, $post_type, $key );
	}
}