<?php
/**
 * Agent Search Feature
 *
 * @since   4.0.0
 * @package realhomes/functions
 */

if ( ! function_exists( 'realhomes_agent_locations_options' ) ) {
	/**
	 * Agent hierarchical location options
	 *
	 * @since    4.0.0
	 * @return void
	 */
	function realhomes_agent_locations_options() {
		if ( ! class_exists( 'ERE_Data' ) ) {
			return;
		}

		$hierarchical_terms_array = array();
		$searched_terms           = null;
		$excluded_terms           = null;

		$hierarchical_terms_array = ERE_Data::get_agent_hierarchical_locations();

		if ( isset( $_GET['agent-locations'] ) ) {
			$searched_terms = $_GET['agent-locations'];
		} else if ( ! empty( $_GET['agent-locations'] ) ) {
			$searched_terms = $_GET['agent-locations'];
		}

		realhomes_generate_options( $hierarchical_terms_array, $searched_terms, '', $excluded_terms );

	}
}

if ( ! function_exists( 'realhomes_filter_agents' ) ) {
	/**
	 * Filter Agents based on Search Parameters for Ajax Call
	 *
	 * @since 4.0.0
	 * @return string JSON
	 *
	 */
	function realhomes_filter_agents() {

		$paged = 1;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		}

		$number_of_agents = intval( get_option( 'theme_number_posts_agent' ) );
		if ( ! $number_of_agents ) {
			$number_of_agents = 6;
		}

		$search_args = array(
			'post_type'      => 'agent',
			'posts_per_page' => $number_of_agents,
			'paged'          => $paged,
		);

		/* Initialize Taxonomy Query Array */
		$tax_query = array();

		/* Initialize Meta Query Array */
		$meta_query = array();

		/* Keyword Search */
		if ( ! empty( $_POST['name'] ) ) {
			$search_args['s'] = $_POST['name'];
		}

		/* Meta Search Filter */
		$meta_query = apply_filters( 'realhomes_agent_meta_search', $meta_query );

		/* If more than one meta query elements exist then specify the relation */
		$meta_count = count( $meta_query );
		if ( $meta_count > 1 ) {
			$meta_query['relation'] = 'AND';
		}

		/* If meta query has some values then add it to search query */
		if ( $meta_count > 0 ) {
			$search_args['meta_query'] = $meta_query;
		}

		/* Taxonomy Search Filter */
		$tax_query = apply_filters( 'realhomes_agent_taxonomy_search', $tax_query );

		/* If more than one taxonomies exist then specify the relation */
		$tax_count = count( $tax_query );
		if ( $tax_count > 1 ) {
			$tax_query['relation'] = 'AND';
		}

		/* If taxonomy query has some values then add it to search query */
		if ( $tax_count > 0 ) {
			$search_args['tax_query'] = $tax_query;
		}

		/* Sort Agents by Number of Properties */
		if ( ! empty( $_POST['properties'] ) ) {
			$search_args = apply_filters( 'realhomes_filter_agents_by_properties', $search_args );
		}

		$agent_search_query  = new WP_Query( $search_args );
		$agent_search_layout = 'assets/modern/partials/agent/card';

		ob_start();
		if ( $agent_search_query->have_posts() ) {

			while ( $agent_search_query->have_posts() ) {

				$agent_search_query->the_post();

				get_template_part( $agent_search_layout );
				$search_results = ob_get_contents();

			}

			wp_send_json_success(
				array(
					'search_results' => $search_results,
					'status'         => ob_end_clean(),
					'max_pages'      => $agent_search_query->max_num_pages,
					'total_agents'   => $agent_search_query->found_posts,
				)
			);

			wp_reset_postdata();

		} else {

			$search_results .= '<div class="rh_agent_card__wrap no-results">';
			$search_results .= '<p><strong>' . esc_html__( 'No Results Found!', 'framework' ) . '</strong></p>';
			$search_results .= '</div>';

			wp_send_json_success(
				array(
					'search_results' => $search_results,
					'status'         => ob_end_clean(),
				)
			);

		}

		die;

	}

	add_action( 'wp_ajax_nopriv_realhomes_filter_agents', 'realhomes_filter_agents' );
	add_action( 'wp_ajax_realhomes_filter_agents', 'realhomes_filter_agents' );
}


if ( ! function_exists( 'realhomes_agents_search_args' ) ) {
	/**
	 * Filter Agents based on Search Parameters
	 *
	 * @since 4.0.0
	 * @return string JSON
	 *
	 */
	function realhomes_agents_search_args() {

		$paged = 1;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		}

		$number_of_agencies = intval( get_option( 'theme_number_posts_agent', 3 ) );
		if ( ! $number_of_agencies ) {
			$number_of_agencies = 6;
		}

		$search_args = array(
			'post_type'      => 'agent',
			'posts_per_page' => $number_of_agencies,
			'paged'          => $paged,
		);

		/* Initialize Taxonomy Query Array */
		$tax_query = array();

		/* Initialize Meta Query Array */
		$meta_query = array();

		/* Keyword Search */
		if ( ! empty( $_GET['agent-txt'] ) ) {
			$search_args['s'] = $_GET['agent-txt'];
		}

		/* Meta Search Filter */
		$meta_query = apply_filters( 'realhomes_agent_meta_search', $meta_query );

		/* If more than one meta query elements exist then specify the relation */
		$meta_count = count( $meta_query );
		if ( $meta_count > 1 ) {
			$meta_query['relation'] = 'AND';
		}

		/* If meta query has some values then add it to search query */
		if ( $meta_count > 0 ) {
			$search_args['meta_query'] = $meta_query;
		}

		/* Taxonomy Search Filter */
		$tax_query = apply_filters( 'realhomes_agent_taxonomy_search', $tax_query );

		/* If more than one taxonomies exist then specify the relation */
		$tax_count = count( $tax_query );
		if ( $tax_count > 1 ) {
			$tax_query['relation'] = 'AND';
		}

		/* If taxonomy query has some values then add it to search query */
		if ( $tax_count > 0 ) {
			$search_args['tax_query'] = $tax_query;
		}

		return $search_args;

	}

	add_filter( 'realhomes_agents_search_filter', 'realhomes_agents_search_args' );
}

if ( ! function_exists( 'realhomes_agent_location_search' ) ) {
	/**
	 * Add agent location related search arguments to taxonomy query of Agent Search
	 *
	 * @since 4.0.0
	 *
	 * @param $tax_query
	 *
	 * @return array
	 *
	 */
	function realhomes_agent_location_search( $tax_query ) {

		if ( ( ! empty( $_GET['agent-locations'] ) ) && ( $_GET['agent-locations'] != inspiry_any_value() ) ) {
			$tax_query[] = array(
				'taxonomy' => 'agent-location',
				'field'    => 'slug',
				'terms'    => $_GET['agent-locations'],
			);
		}

		if ( ( ! empty( $_POST['agentlocations'] ) ) && ( $_POST['agentlocations'] != inspiry_any_value() ) ) {
			$tax_query[] = array(
				'taxonomy' => 'agent-location',
				'field'    => 'slug',
				'terms'    => $_POST['agentlocations'],
			);
		}

		return $tax_query;

	}

	add_filter( 'realhomes_agent_taxonomy_search', 'realhomes_agent_location_search' );
}

if ( ! function_exists( 'realhomes_agents_by_properties' ) ) {
	/**
	 * Display Agents based on the number of properties selected - Agent Search
	 *
	 * @since 4.0.0
	 *
	 * @param $tax_query
	 *
	 * @return array
	 *
	 */
	function realhomes_agents_by_properties( $search_args ) {

		if ( empty( $_POST['properties'] ) ) {
			return $search_args;
		}

		$agents_args = array(
			'post_type'      => 'agent',
			'posts_per_page' => -1,
		);

		$agent_query = new WP_Query( $agents_args );
		$agents_IDs  = array();

		if ( $agent_query->have_posts() ) {
			$agents_IDs = wp_list_pluck( $agent_query->posts, 'ID' );
		}

		$agents_with_props = array();

		foreach ( $agents_IDs as $agent ) {
			$props                       = new WP_Query(
				array(
					'post_type'      => 'property',
					'posts_per_page' => -1,
					'meta_query'     => array(
						array(
							'key'     => 'REAL_HOMES_agents',
							'value'   => intval( $agent ),
							'compare' => '=',
						)
					),
				)
			);
			$agents_with_props[ $agent ] = $props->found_posts;
		}

		$found_agents = array_filter( $agents_with_props, function( $properties, $agent ) {
			return $properties == $_POST['properties'];
		}, ARRAY_FILTER_USE_BOTH );
		$found_agents = array_keys( $found_agents );

		$search_args['post__in'] = $found_agents;

		return $search_args;

	}

	add_filter( 'realhomes_filter_agents_by_properties', 'realhomes_agents_by_properties' );
}

if ( ! function_exists( 'realhomes_verified_agents' ) ) {
	/**
	 * Display Verified Agents - Agent Search
	 *
	 * @since 4.0.0
	 *
	 * @param $tax_query
	 *
	 * @return array
	 *
	 */
	function realhomes_verified_agents( $meta_query ) {

		if ( ! empty( $_GET['verified-agents'] ) && 'yes' === $_GET['verified-agents'] ) {
			$meta_query[] = array(
				'key'     => 'ere_agent_verification_status',
				'value'   => '1',
				'compare' => '=',
			);
		}

		if ( ! empty( $_POST['verifiedAgents'] ) && 'yes' === $_POST['verifiedAgents'] ) {
			$meta_query[] = array(
				'key'     => 'ere_agent_verification_status',
				'value'   => '1',
				'compare' => '=',
			);
		}

		return $meta_query;

	}

	add_filter( 'realhomes_agent_meta_search', 'realhomes_verified_agents' );
}