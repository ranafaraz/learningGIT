<?php
/**
 * Agency Search Feature
 *
 * @since   4.0.0
 * @package realhomes/functions
 */

if ( ! function_exists( 'realhomes_agency_locations_options' ) ) {
	/**
	 * Agency hierarchical location options
	 *
	 * @since    4.0.0
	 * @return void
	 */
	function realhomes_agency_locations_options() {
		if ( ! class_exists( 'ERE_Data' ) ) {
			return;
		}

		$hierarchical_terms_array = array();
		$searched_terms           = null;
		$excluded_terms           = null;

		$hierarchical_terms_array = ERE_Data::get_agency_hierarchical_locations();

		if ( isset( $_GET['agency-locations'] ) ) {
			$searched_terms = $_GET['agency-locations'];
		} else if ( ! empty( $_GET['agency-locations'] ) ) {
			$searched_terms = $_GET['agency-locations'];
		}

		realhomes_generate_options( $hierarchical_terms_array, $searched_terms, '', $excluded_terms );

	}
}

if ( ! function_exists( 'realhomes_filter_agency' ) ) {
	/**
	 * Filter Agents based on Search Parameters for Ajax Call
	 *
	 * @since 4.0.0
	 * @return string JSON
	 *
	 */
	function realhomes_filter_agency() {

		$paged = 1;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		}

		$number_of_agencies = intval( get_option( 'inspiry_number_posts_agency' ) );
		if ( ! $number_of_agencies ) {
			$number_of_agencies = 3;
		}

		$search_args = array(
			'post_type'      => 'agency',
			'posts_per_page' => $number_of_agencies,
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

		/* Taxonomy Search Filter */
		$tax_query = apply_filters( 'realhomes_agency_taxonomy_search', $tax_query );

		/* If more than one taxonomies exist then specify the relation */
		$tax_count = count( $tax_query );
		if ( $tax_count > 1 ) {
			$tax_query['relation'] = 'AND';
		}

		/* If taxonomy query has some values then add it to search query */
		if ( $tax_count > 0 ) {
			$search_args['tax_query'] = $tax_query;
		}

		$agency_search_query  = new WP_Query( $search_args );
		$agency_search_layout = 'assets/modern/partials/agency/card';

		ob_start();
		if ( $agency_search_query->have_posts() ) {

			while ( $agency_search_query->have_posts() ) {

				$agency_search_query->the_post();

				get_template_part( $agency_search_layout );
				$search_results = ob_get_contents();

			}

			wp_send_json_success(
				array(
					'search_results' => $search_results,
					'status'         => ob_end_clean(),
					'max_pages'      => $agency_search_query->max_num_pages,
					'total_agencies' => $agency_search_query->found_posts
				)
			);

			wp_reset_postdata();

		} else {

			$search_results .= '<div class="rh_agency_card__wrap my-2 no-results">';
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

	add_action( 'wp_ajax_nopriv_realhomes_filter_agency', 'realhomes_filter_agency' );
	add_action( 'wp_ajax_realhomes_filter_agency', 'realhomes_filter_agency' );
}

if ( ! function_exists( 'realhomes_agency_search_args' ) ) {
	/**
	 * Filter Agents based on Search Parameters for Ajax Call
	 *
	 * @since 4.0.0
	 * @return string JSON
	 *
	 */
	function realhomes_agency_search_args() {

		$paged = 1;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		}

		$number_of_agencies = intval( get_option( 'inspiry_number_posts_agency', 3 ) );
		if ( ! $number_of_agencies ) {
			$number_of_agencies = 6;
		}

		$search_args = array(
			'post_type'      => 'agency',
			'posts_per_page' => $number_of_agencies,
			'paged'          => $paged,
		);

		/* Initialize Taxonomy Query Array */
		$tax_query = array();

		/* Initialize Meta Query Array */
		$meta_query = array();

		/* Keyword Search */
		if ( ! empty( $_GET['agency-txt'] ) ) {
			$search_args['s'] = $_GET['agency-txt'];
		}

		/* Taxonomy Search Filter */
		$tax_query = apply_filters( 'realhomes_agency_taxonomy_search', $tax_query );

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

	add_filter( 'realhomes_agencies_search_filter', 'realhomes_agency_search_args' );
}

if ( ! function_exists( 'realhomes_agency_location_search' ) ) {
	/**
	 * Add agency location related search arguments to taxonomy query of Agent Search
	 *
	 * @since 4.0.0
	 *
	 * @param $tax_query
	 *
	 * @return array
	 *
	 */
	function realhomes_agency_location_search( $tax_query ) {

		if ( ( ! empty( $_GET['agency-locations'] ) ) && ( $_GET['agency-locations'] != inspiry_any_value() ) ) {
			$tax_query[] = array(
				'taxonomy' => 'agency-location',
				'field'    => 'slug',
				'terms'    => $_GET['agency-locations'],
			);
		}

		if ( ( ! empty( $_POST['agencylocations'] ) ) && ( $_POST['agencylocations'] != inspiry_any_value() ) ) {
			$tax_query[] = array(
				'taxonomy' => 'agency-location',
				'field'    => 'slug',
				'terms'    => $_POST['agencylocations'],
			);
		}

		return $tax_query;

	}

	add_filter( 'realhomes_agency_taxonomy_search', 'realhomes_agency_location_search' );
}