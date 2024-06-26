<?php
/**
 * Ajax Search Feature
 *
 * @since   3.21.0
 * @package realhomes/functions
 */

if ( ! function_exists( 'realhomes_ajax_radius_search' ) ) {
	/**
	 * Find the properties IDs within given miles/km range of location center latitude and longitude
	 *
	 * @param $search_args
	 *
	 * @return array
	 */
	function realhomes_ajax_radius_search( $search_args ) {

		if ( ! empty( $_POST['geolocationAddress'] ) && ! empty( $_POST['lat'] ) && ! empty( $_POST['lng'] ) ) {
			global $wpdb;

			$center_lat   = sanitize_text_field( $_POST['lat'] );
			$center_lng   = sanitize_text_field( $_POST['lng'] );
			$radius_range = ! empty( $_POST['geolocationRadius'] ) ? intval( $_POST['geolocationRadius'] ) : get_option( 'realhomes_search_radius_range_initial', '20' );

			$radius_range_type = get_option( 'realhomes_search_radius_range_type', 'miles' );
			if ( 'kilometers' === $radius_range_type ) {
				$earth_radius = 6371; // km
			} else {
				$earth_radius = 3959; // miles
			}

			$wpdb_query = $wpdb->prepare( "SELECT p.ID
                   FROM {$wpdb->posts} p
                   INNER JOIN {$wpdb->postmeta} m ON p.ID = m.post_id
                   WHERE p.post_type = %s
                   AND m.meta_key = %s
                   AND p.post_status = %s
                   AND (
                    %d * ACOS(
                      COS(RADIANS(%f)) *
                      COS(RADIANS(SUBSTRING_INDEX(SUBSTRING_INDEX(m.meta_value, ',', 2), ',', 1))) *
                      COS(RADIANS(SUBSTRING_INDEX(SUBSTRING_INDEX(m.meta_value, ',', -2), ',', 1)) - RADIANS(%f)) +
                      SIN(RADIANS(%f)) *
                      SIN(RADIANS(SUBSTRING_INDEX(m.meta_value, ',', 1)))
                    )
                   ) <= %d", 'property', 'REAL_HOMES_property_location', 'publish', $earth_radius, $center_lat, $center_lng, $center_lat, $radius_range );

			$results = $wpdb->get_results( $wpdb_query, OBJECT_K );

			$search_args['post__in'] = ! empty( $results ) ? array_keys( $results ) : array( null );
		}

		return $search_args;
	}

	add_filter( 'realhomes_ajax_search_parameters', 'realhomes_ajax_radius_search' );
}

if ( ! function_exists( 'realhomes_ajax_booking_dates_search' ) ) {
	/**
	 * Perform check-in & check-out search on properties
	 * to collect ineligible properties IDs
	 *
	 * @param $search_args
	 *
	 * @return array
	 */
	function realhomes_ajax_booking_dates_search( $search_args ) {

		$check_in  = empty( $_POST['checkIn'] ) ? '' : esc_html( $_POST['checkIn'] );
		$check_out = empty( $_POST['checkOut'] ) ? '' : esc_html( $_POST['checkOut'] );

		if ( ! empty( $check_in ) || ! empty( $check_out ) ) {

			// properties ids that are ineligible for the search results
			$ineligible_properties = inspiry_reserved_properties_ids( $check_in, $check_out );

			if ( ! empty( $search_args['post__not_in'] ) && is_array( $search_args['post__not_in'] ) ) {
				$search_args['post__not_in'] = array_merge( $search_args['post__not_in'], $ineligible_properties );
			} else {
				$search_args['post__not_in'] = $ineligible_properties;
			}
		}

		// Removes post in IDs that are added by Geo Location query using SQL
		if ( isset( $search_args['post__in'] ) && isset( $search_args['post__not_in'] ) ) {
			$search_args['post__in'] = array_diff( $search_args['post__in'], $search_args['post__not_in'] );
		}

		return $search_args;
	}

	add_filter( 'realhomes_ajax_search_parameters', 'realhomes_ajax_booking_dates_search' );
}

if ( ! function_exists( 'realhomes_ajax_guests_search' ) ) {
	/**
	 * Add property guest related search arguments to meta query
	 *
	 * @param $meta_query
	 *
	 * @return array
	 */
	function realhomes_ajax_guests_search( $meta_query ) {

		if ( ! empty( $_POST['guests'] ) && ( $_POST['guests'] != inspiry_any_value() ) ) {
			$meta_query[] = array(
				'key'     => 'rvr_guests_capacity',
				'value'   => $_POST['guests'],
				'compare' => '>=',
				'type'    => 'NUMERIC'
			);
		}

		return $meta_query;
	}

	add_filter( 'realhomes_ajax_meta_search', 'realhomes_ajax_guests_search' );
}

if ( ! function_exists( 'realhomes_ajax_bathrooms_search' ) ) {
	/**
	 * Add bathrooms related arguments to meta query of Ajax Search
	 *
	 * @since 3.21.0
	 *
	 * @param $meta_query
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_bathrooms_search( $meta_query ) {
		if ( ( ! empty( $_POST['bathrooms'] ) ) && ( $_POST['bathrooms'] != inspiry_any_value() ) ) {
			$meta_query[] = array(
				'key'     => 'REAL_HOMES_property_bathrooms',
				'value'   => $_POST['bathrooms'],
				'compare' => inspiry_get_beds_baths_compare_operator(),
				'type'    => 'DECIMAL',
			);
		}

		return $meta_query;
	}

	add_filter( 'realhomes_ajax_meta_search', 'realhomes_ajax_bathrooms_search' );
}

if ( ! function_exists( 'realhomes_ajax_beds_search' ) ) {
	/**
	 * Add bedrooms related arguments to meta query of Ajax Search
	 *
	 * @since 3.21.0
	 *
	 * @param $meta_query
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_beds_search( $meta_query ) {
		if ( ( ! empty( $_POST['bedrooms'] ) ) && ( $_POST['bedrooms'] != inspiry_any_value() ) ) {
			$meta_query[] = array(
				'key'     => 'REAL_HOMES_property_bedrooms',
				'value'   => $_POST['bedrooms'],
				'compare' => inspiry_get_beds_baths_compare_operator(),
				'type'    => 'DECIMAL',
			);
		}

		return $meta_query;
	}

	add_filter( 'realhomes_ajax_meta_search', 'realhomes_ajax_beds_search' );
}

if ( ! function_exists( 'realhomes_ajax_garages_search' ) ) {
	/**
	 * Add garages related arguments to meta query of Ajax Search
	 *
	 * @since 3.21.0
	 *
	 * @param array $meta_query - Meta search query array.
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_garages_search( $meta_query ) {
		if ( ( ! empty( $_POST['garages'] ) ) && ( $_POST['garages'] != inspiry_any_value() ) ) {
			$meta_query[] = array(
				'key'     => 'REAL_HOMES_property_garage',
				'value'   => $_POST['garages'],
				'compare' => inspiry_get_garages_compare_operator(),
				'type'    => 'DECIMAL',
			);
		}

		return $meta_query;
	}

	add_filter( 'realhomes_ajax_meta_search', 'realhomes_ajax_garages_search' );
}

if ( ! function_exists( 'realhomes_ajax_agent_search' ) ) {
	/**
	 * Add property agent search arguments to meta query of Ajax Search
	 *
	 * @since 3.21.0
	 *
	 * @param $meta_query
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_agent_search( $meta_query ) {
		if ( ! empty( $_POST['agents'] ) ) {
			$meta_query[] = array(
				'key'     => 'REAL_HOMES_agents',
				'value'   => $_POST['agents'],
				'compare' => 'IN',
			);
		}

		return $meta_query;
	}

	add_filter( 'realhomes_ajax_meta_search', 'realhomes_ajax_agent_search' );
}

if ( ! function_exists( 'realhomes_ajax_agency_search' ) ) {
	/**
	 * Add property agency search arguments to meta query of Ajax Search
	 *
	 * @since 3.21.0
	 *
	 * @param $meta_query
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_agency_search( $meta_query ) {
		if ( ! empty( $_POST['agencies'] ) ) {

			$agencies_query = new WP_Query(
				array(
					'post_type'      => 'agent',
					'posts_per_page' => -1,
					'meta_query'     => array(
						array(
							'key'     => 'REAL_HOMES_agency',
							'value'   => $_POST['agencies'],
							'compare' => 'IN',
						),
					),
				),
			);

			$agents_in_agency = array();

			if ( $agencies_query->have_posts() ) {
				$agents_in_agency = wp_list_pluck( $agencies_query->posts, 'ID' );
			}

			$meta_query[] = array(
				'key'     => 'REAL_HOMES_agents',
				'value'   => $agents_in_agency,
				'type'    => 'NUMERIC',
				'compare' => 'IN',
			);

		}

		return $meta_query;
	}

	add_filter( 'realhomes_ajax_meta_search', 'realhomes_ajax_agency_search' );
}

if ( ! function_exists( 'realhomes_ajax_area_search' ) ) {
	/**
	 * Add area related search arguments to meta query of Ajax Search
	 *
	 * @since 3.21.0
	 *
	 * @param $meta_query
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_area_search( $meta_query ) {

		if ( ! empty( $_POST['minArea'] ) && ! empty( $_POST['maxArea'] ) ) {
			$min_area = intval( $_POST['minArea'] );
			$max_area = intval( $_POST['maxArea'] );
			if ( $min_area >= 0 && $max_area > $min_area ) {
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_size',
					'value'   => array( $min_area, $max_area ),
					'type'    => 'NUMERIC',
					'compare' => 'BETWEEN',
				);
			}
		} else if ( ! empty( $_POST['minArea'] ) ) {
			$min_area = intval( $_POST['min-area'] );
			if ( $min_area > 0 ) {
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_size',
					'value'   => $min_area,
					'type'    => 'NUMERIC',
					'compare' => '>=',
				);
			}
		} else if ( ! empty( $_POST['maxArea'] ) ) {
			$max_area = intval( $_POST['max-area'] );
			if ( $max_area > 0 ) {
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_size',
					'value'   => $max_area,
					'type'    => 'NUMERIC',
					'compare' => '<=',
				);
			}
		}

		return $meta_query;
	}

	add_filter( 'realhomes_ajax_meta_search', 'realhomes_ajax_area_search' );
}

if ( ! function_exists( 'realhomes_ajax_lot_size_search' ) ) {
	/**
	 * Add lot size related search arguments to meta query of Ajax Search
	 *
	 * @since 3.21.0
	 *
	 * @param $meta_query
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_lot_size_search( $meta_query ) {

		if ( isset( $_POST['minLotSize'] ) && ! empty( $_POST['minLotSize'] ) && isset( $_POST['maxLotSize'] ) && ! empty( $_POST['maxLotSize'] ) ) {
			$min_lot_size = intval( $_POST['minLotSize'] );
			$max_lot_size = intval( $_POST['maxLotSize'] );
			if ( $min_lot_size >= 0 && $max_lot_size > $min_lot_size ) {
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_lot_size',
					'value'   => array( $min_lot_size, $max_lot_size ),
					'type'    => 'NUMERIC',
					'compare' => 'BETWEEN',
				);
			}
		} else if ( isset( $_POST['minLotSize'] ) && ! empty( $_POST['minLotSize'] ) ) {
			$min_lot_size = intval( $_POST['minLotSize'] );
			if ( $min_lot_size > 0 ) {
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_lot_size',
					'value'   => $min_lot_size,
					'type'    => 'NUMERIC',
					'compare' => '>=',
				);
			}
		} else if ( isset( $_POST['maxLotSize'] ) && ! empty( $_POST['maxLotSize'] ) ) {
			$max_lot_size = intval( $_POST['maxLotSize'] );
			if ( $max_lot_size > 0 ) {
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_lot_size',
					'value'   => $max_lot_size,
					'type'    => 'NUMERIC',
					'compare' => '<=',
				);
			}
		}

		return $meta_query;
	}

	add_filter( 'realhomes_ajax_meta_search', 'realhomes_ajax_lot_size_search' );
}

if ( ! function_exists( 'realhomes_ajax_price_search' ) ) {
	/**
	 * Add price related search arguments to meta query of Ajax Search
	 *
	 * @since 3.21.0
	 *
	 * @param $meta_query
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_price_search( $meta_query ) {
		if ( isset( $_POST['minPrice'] ) && ( $_POST['minPrice'] != inspiry_any_value() ) && isset( $_POST['maxPrice'] ) && ( $_POST['maxPrice'] != inspiry_any_value() ) ) {
			$min_price = doubleval( $_POST['minPrice'] );
			$max_price = doubleval( $_POST['maxPrice'] );
			if ( $min_price >= 0 && $max_price > $min_price ) {
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_price',
					'value'   => array( $min_price, $max_price ),
					'type'    => 'NUMERIC',
					'compare' => 'BETWEEN',
				);
			}
		} else if ( isset( $_POST['minPrice'] ) && ( $_POST['minPrice'] != inspiry_any_value() ) ) {
			$min_price = doubleval( $_POST['minPrice'] );
			if ( $min_price > 0 ) {
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_price',
					'value'   => $min_price,
					'type'    => 'NUMERIC',
					'compare' => '>=',
				);
			}
		} else if ( isset( $_POST['maxPrice'] ) && ( $_POST['maxPrice'] != inspiry_any_value() ) ) {
			$max_price = doubleval( $_POST['maxPrice'] );
			if ( $max_price > 0 ) {
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_price',
					'value'   => $max_price,
					'type'    => 'NUMERIC',
					'compare' => '<=',
				);
			}
		}

		return $meta_query;
	}

	add_filter( 'realhomes_ajax_meta_search', 'realhomes_ajax_price_search' );
}

if ( ! function_exists( 'realhomes_ajax_property_id_search' ) ) {
	/**
	 * Add property id related search arguments to meta query of Ajax Search
	 *
	 * @since 3.21.0
	 *
	 * @param $meta_query
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_property_id_search( $meta_query ) {
		if ( isset( $_POST['propertyID'] ) && ! empty( $_POST['propertyID'] ) ) {
			$property_id  = trim( $_POST['propertyID'] );
			$meta_query[] = array(
				'key'     => 'REAL_HOMES_property_id',
				'value'   => $property_id,
				'compare' => 'LIKE',
				'type'    => 'CHAR',
			);
		}

		return $meta_query;
	}

	add_filter( 'realhomes_ajax_meta_search', 'realhomes_ajax_property_id_search' );
}

if ( ! function_exists( 'realhomes_ajax_property_location_search' ) ) {
	/**
	 * Add property location related search arguments to taxonomy query of Ajax Search
	 *
	 * @since 3.21.0
	 *
	 * @param $tax_query
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_property_location_search( $tax_query ) {
		if ( ( ! empty( $_POST['locations'] ) ) && ( $_POST['locations'] != inspiry_any_value() ) ) {
			$tax_query[] = array(
				'taxonomy' => 'property-city',
				'field'    => 'slug',
				'terms'    => $_POST['locations'],
			);
		}

		return $tax_query;
	}

	add_filter( 'realhomes_ajax_taxonomy_search', 'realhomes_ajax_property_location_search' );
}

if ( ! function_exists( 'realhomes_ajax_property_type_search' ) ) {
	/**
	 * Add property type related search arguments to taxonomy query of Ajax Search
	 *
	 * @since 3.21.0
	 *
	 * @param $tax_query
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_property_type_search( $tax_query ) {
		if ( ( ! empty( $_POST['types'] ) ) && ( $_POST['types'] != inspiry_any_value() ) ) {
			$tax_query[] = array(
				'taxonomy' => 'property-type',
				'field'    => 'slug',
				'terms'    => $_POST['types'],
			);
		}

		return $tax_query;
	}

	add_filter( 'realhomes_ajax_taxonomy_search', 'realhomes_ajax_property_type_search' );
}

if ( ! function_exists( 'realhomes_ajax_property_status_search' ) ) {
	/**
	 * Add property status related search arguments to taxonomy query of Ajax Search
	 *
	 * @since 3.21.0
	 *
	 * @param $tax_query
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_property_status_search( $tax_query ) {
		if ( ( ! empty( $_POST['statuses'] ) ) && ( $_POST['statuses'] != inspiry_any_value() ) ) {
			$tax_query[] = array(
				'taxonomy' => 'property-status',
				'field'    => 'slug',
				'terms'    => $_POST['statuses'],
			);
		}

		// Excluding statuses
		$excluded_statuses = get_option( 'inspiry_search_exclude_status' );
		if ( ! empty( $excluded_statuses ) ) {
			$tax_query[] = array(
				array(
					'taxonomy' => 'property-status',
					'field'    => 'id',
					'terms'    => $excluded_statuses,
					'operator' => 'NOT IN',
				),
			);
		}

		return $tax_query;
	}

	add_filter( 'realhomes_ajax_taxonomy_search', 'realhomes_ajax_property_status_search' );
}

if ( ! function_exists( 'realhomes_ajax_property_features_search' ) ) {
	/**
	 * Add features related search arguments to taxonomy query of Ajax Search
	 *
	 * @since 3.21.0
	 *
	 * @param $tax_query
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_property_features_search( $tax_query ) {
		$features = $_POST['features'] ?? '';
		if ( isset( $features ) && is_array( $features ) ) {
			/* validate feature slug */
			$tax_query = array(
				array(
					'taxonomy' => 'property-feature',
					'field'    => 'slug',
					'terms'    => $features,
				)
			);
		}

		return $tax_query;
	}

	add_filter( 'realhomes_ajax_taxonomy_search', 'realhomes_ajax_property_features_search' );
}

if ( ! function_exists( 'realhomes_ajax_property_additional_fields_search' ) ) {
	/**
	 * Add property additional fields to the properties meta query
	 *
	 * @since 3.21.0
	 *
	 * @param $meta_query
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_property_additional_fields_search( $meta_query ) {
		$additional_fields = $_POST['additionalFieldsValues'] ?? '';

		if ( $additional_fields ) {
			foreach ( $additional_fields as $field ) {
				if ( ( ! empty( $field[0]['additional_field_name'] ) ) && ( $field[0]['additional_field_value'] != inspiry_any_value() ) ) {
					$meta_query[] = array(
						'key'     => $field[0]['additional_field_name'],
						'value'   => $field[0]['additional_field_value'],
						'compare' => 'LIKE',
						'type'    => 'CHAR'
					);
				}
			}
		}

		return $meta_query;
	}

	add_filter( 'realhomes_ajax_meta_search', 'realhomes_ajax_property_additional_fields_search' );
}

if ( ! function_exists( 'realhomes_get_additional_fields' ) ) {
	/**
	 * Return a valid list of property additional fields
	 *
	 * @since 3.21.0
	 *
	 * @param $location
	 *
	 * @return array
	 *
	 */
	function realhomes_get_additional_fields( $location = 'all' ) {

		$additional_fields = get_option( 'inspiry_property_additional_fields' );
		$build_fields      = array();

		if ( ! empty( $additional_fields['inspiry_additional_fields_list'] ) ) {
			foreach ( $additional_fields['inspiry_additional_fields_list'] as $field ) {

				// Ensure all required values of a field are available then add it to the fields list
				if ( ( 'all' == $location || ( ! empty( $field['field_display'] ) && in_array( $location, $field['field_display'] ) ) ) && ! empty( $field['field_type'] ) && ! empty( $field['field_name'] ) ) {

					// Prepare select field options list
					if ( in_array( $field['field_type'], array( 'select', 'checkbox_list', 'radio' ) ) ) {
						if ( empty( $field['field_options'] ) ) {
							$field['field_type'] = 'text';
						} else {
							$options                = explode( ',', $field['field_options'] );
							$options                = array_filter( array_map( 'trim', $options ) );
							$field['field_options'] = array_combine( $options, $options );
						}
					}

					// Set the field icon and unique key
					$field['field_icon'] = empty( $field['field_icon'] ) ? '' : $field['field_icon'];
					$field['field_key']  = 'inspiry_' . strtolower( preg_replace( '/\s+/', '_', $field['field_name'] ) );

					// Add final field to the fields list
					$build_fields[] = $field;
				}
			}
		}

		// Return additional fields array
		return $build_fields;

	}
}

if ( ! function_exists( 'realhomes_get_ajax_search_results_status' ) ) {
	/**
	 * Check if Ajax Pagination is enabled globally
	 *
	 * @since 3.21.0
	 * @return bool
	 */
	function realhomes_get_ajax_search_results_status() {

		if ( 'classic' == INSPIRY_DESIGN_VARIATION ) {
			return false;
		}

		if ( 'ultra' == INSPIRY_DESIGN_VARIATION ) {
			return false;
		}

		$ajax_search_results = get_option( 'realhomes_ajax_search_results', 'no' );

		if ( 'yes' !== $ajax_search_results ) {
			return false;
		} else {
			return true;
		}
	}
}

if ( ! function_exists( 'realhomes_map_ajax_search_results' ) ) {
	/**
	 * Generate Properties Data for the MAP based on Search Parameters for Ajax Call
	 *
	 * @since 3.21.0
	 * @return string JSON
	 *
	 */
	function realhomes_map_ajax_search_results() {

		$number_of_properties = intval( get_option( 'theme_properties_on_search' ) );
		if ( ! $number_of_properties ) {
			$number_of_properties = 6;
		}

		// Override number of properties for search results map
		$properties_on_search_map = get_option( 'inspiry_properties_on_search_map', 'all' );
		if ( 'all' == $properties_on_search_map ) {
			$number_of_properties = -1;
		}

		$search_args = array(
			'post_type'      => 'property',
			'posts_per_page' => $number_of_properties,
			'post_status'    => 'publish'
		);

		$paged = $_POST['page'] ?? '';
		if ( ! empty( $paged ) && 'all' !== $properties_on_search_map ) {
			$search_args['paged'] = intval( $paged );
		}

		/* Initialize Taxonomy Query Array */
		$tax_query = array();

		/* Initialize Meta Query Array */
		$meta_query = array();

		if ( inspiry_is_search_page_map_visible() ) {
			$meta_query[] = array(
				'key'     => 'REAL_HOMES_property_address',
				'compare' => 'EXISTS',
			);
		}

		/* Keyword Search */
		if ( ! empty( $_POST['keywords'] ) ) {
			$search_args['s'] = $_POST['keywords'];
		}

		/* Meta Search Filter */
		$meta_query = apply_filters( 'realhomes_ajax_meta_search', $meta_query );

		/* Taxonomy Search Filter */
		$tax_query = apply_filters( 'realhomes_ajax_taxonomy_search', $tax_query );

		/* If more than one taxonomies exist then specify the relation */
		$tax_count = count( $tax_query );
		if ( $tax_count > 1 ) {
			$tax_query['relation'] = 'AND';
		}

		/* If more than one meta query elements exist then specify the relation */
		$meta_count = count( $meta_query );
		if ( $meta_count > 1 ) {
			$meta_query['relation'] = 'AND';
		}

		/* If taxonomy query has some values then add it to search query */
		if ( $tax_count > 0 ) {
			$search_args['tax_query'] = $tax_query;
		}

		/* If meta query has some values then add it to search query */
		if ( $meta_count > 0 ) {
			$search_args['meta_query'] = $meta_query;
		}

		$search_args         = apply_filters( 'realhomes_ajax_search_parameters', $search_args );
		$ajax_search_query   = new WP_Query( $search_args );
		$properties_map_data = array();

		if ( $ajax_search_query->have_posts() ) {

			while ( $ajax_search_query->have_posts() ) {

				$ajax_search_query->the_post();

				$ajax_property_data          = array();
				$ajax_property_data['title'] = get_the_title();

				if ( function_exists( 'ere_get_property_price' ) ) {
					$ajax_property_data['price'] = ere_get_property_price();
				} else {
					$ajax_property_data['price'] = null;
				}

				$ajax_property_data['url'] = get_permalink();
				$ajax_property_data['id']  = get_the_ID();

				// property location
				$property_location = get_post_meta( get_the_ID(), 'REAL_HOMES_property_location', true );
				if ( ! empty( $property_location ) ) {
					$lat_lng                   = explode( ',', $property_location );
					$ajax_property_data['lat'] = $lat_lng[0];
					$ajax_property_data['lng'] = $lat_lng[1];
				}

				// property thumbnail
				if ( has_post_thumbnail() ) {
					$image_id         = get_post_thumbnail_id();
					$image_attributes = wp_get_attachment_image_src( $image_id, 'property-thumb-image' );
					if ( ! empty( $image_attributes[0] ) ) {
						$ajax_property_data['thumb'] = $image_attributes[0];
					}
				} else {
					$ajax_property_data['thumb'] = get_inspiry_image_placeholder_url( 'property-thumb-image' );
				}

				// Property Map icon based on Property Type
				$type_terms = get_the_terms( get_the_ID(), 'property-type' );
				if ( $type_terms && ! is_wp_error( $type_terms ) ) {
					foreach ( $type_terms as $type_term ) {
						$icon_id = get_term_meta( $type_term->term_id, 'inspiry_property_type_icon', true );
						if ( ! empty ( $icon_id ) ) {
							$icon_url = wp_get_attachment_url( $icon_id );
							if ( $icon_url ) {
								$ajax_property_data['icon'] = esc_url( $icon_url );

								// Retina icon
								$retina_icon_id = get_term_meta( $type_term->term_id, 'inspiry_property_type_icon_retina', true );
								if ( ! empty ( $retina_icon_id ) ) {
									$retina_icon_url = wp_get_attachment_url( $retina_icon_id );
									if ( $retina_icon_url ) {
										$ajax_property_data['retinaIcon'] = esc_url( $retina_icon_url );
									}
								}
								break;
							}
						}
					}
				}

				// Set default icons if above code fails to sets any
				if ( ! isset( $ajax_property_data['icon'] ) ) {
					$ajax_property_data['icon']       = INSPIRY_DIR_URI . '/images/map/single-family-home-map-icon.png';     // default icon
					$ajax_property_data['retinaIcon'] = INSPIRY_DIR_URI . '/images/map/single-family-home-map-icon@2x.png';  // default retina icon
				}

				$properties_map_data[] = $ajax_property_data;
			}

			wp_send_json_success(
				array(
					'propertiesData'   => $properties_map_data,
					'paged'            => $paged,
					'max_pages'        => $ajax_search_query->max_num_pages,
					'total_properties' => $ajax_search_query->found_posts,
				)
			);

			wp_reset_postdata();

		} else {

			// Empty array for zero search results
			wp_send_json_success(
				array(
					'propertiesData'   => $properties_map_data,
					'paged'            => $paged,
					'max_pages'        => $ajax_search_query->max_num_pages,
					'total_properties' => $ajax_search_query->found_posts,
				)
			);
		}

		die;
	}

	add_action( 'wp_ajax_nopriv_realhomes_map_ajax_search_results', 'realhomes_map_ajax_search_results' );
	add_action( 'wp_ajax_realhomes_map_ajax_search_results', 'realhomes_map_ajax_search_results' );
}

if ( ! function_exists( 'realhomes_filter_ajax_search_results' ) ) {
	/**
	 * Filter Properties based on Search Parameters for Ajax Call
	 *
	 * @since 3.21.0
	 * @return string JSON
	 *
	 */
	function realhomes_filter_ajax_search_results() {

		$number_of_properties = intval( get_option( 'theme_properties_on_search' ) );
		if ( ! $number_of_properties ) {
			$number_of_properties = 6;
		}

		$search_args = array(
			'post_type'      => 'property',
			'posts_per_page' => $number_of_properties,
			'post_status'    => 'publish'
		);

		/* Initialize Taxonomy Query Array */
		$tax_query = array();

		/* Initialize Meta Query Array */
		$meta_query = array();

		/* Keyword Search */
		if ( ! empty( $_POST['keywords'] ) ) {
			$search_args['s'] = $_POST['keywords'];
		}

		if ( inspiry_is_search_page_map_visible() ) {
			$meta_query[] = array(
				'key'     => 'REAL_HOMES_property_address',
				'compare' => 'EXISTS',
			);
		}

		/* Meta Search Filter */
		$meta_query = apply_filters( 'realhomes_ajax_meta_search', $meta_query );

		/* Taxonomy Search Filter */
		$tax_query = apply_filters( 'realhomes_ajax_taxonomy_search', $tax_query );

		/* If more than one taxonomies exist then specify the relation */
		$tax_count = count( $tax_query );
		if ( $tax_count > 1 ) {
			$tax_query['relation'] = 'AND';
		}

		/* If more than one meta query elements exist then specify the relation */
		$meta_count = count( $meta_query );
		if ( $meta_count > 1 ) {
			$meta_query['relation'] = 'AND';
		}

		/* If taxonomy query has some values then add it to search query */
		if ( $tax_count > 0 ) {
			$search_args['tax_query'] = $tax_query;
		}

		/* If meta query has some values then add it to search query */
		if ( $meta_count > 0 ) {
			$search_args['meta_query'] = $meta_query;
		}

		$page_id                    = ( $_POST['page_id'] ) ?? '';
		$search_args                = apply_filters( 'realhomes_ajax_search_parameters', $search_args );
		$ajax_search_query          = new WP_Query( $search_args );
		$search_results_page_layout = get_option( 'inspiry_search_results_page_layout', 'list' );
		$ajax_search_results_layout = 'assets/modern/partials/properties/list-card';
		$property_card_meta_box     = get_post_meta( $page_id, 'inspiry-property-card-meta-box', true );
		$property_card_variation    = get_option( 'inspiry_property_card_variation', '1' );
		$search_results             = '';

		if ( ! empty( $property_card_meta_box ) && 'default' != $property_card_meta_box ) {
			$property_card_variation = $property_card_meta_box;
		}

        // Page property card layout.
		$property_card = get_post_meta( $page_id, 'realhomes_property_card', true );
		$is_grid_card  = ( ! empty( $property_card ) && 'grid' === $property_card );

		if ( $is_grid_card ) {
			$search_results_page_layout = 'grid';
			$page_property_card_variation = get_post_meta( $page_id, 'realhomes_properties_card_variation', true );
			if ( ! empty( $page_property_card_variation ) && 'default' !== $page_property_card_variation ) {
				$property_card_variation = $page_property_card_variation;
			}
		}

		$current_page_template = get_post_meta( $page_id, '_wp_page_template', true );
		if ( 'templates/properties-search-half-map.php' === $current_page_template ) {
			$ajax_search_results_layout = 'assets/modern/partials/properties/half-map-card';
		} else if ( 'grid' === $search_results_page_layout ) {
			$ajax_search_results_layout = 'assets/modern/partials/properties/grid-card' . '-' . $property_card_variation;
		}

		if ( $ajax_search_query->have_posts() ) {

			ob_start();

			while ( $ajax_search_query->have_posts() ) {
				$ajax_search_query->the_post();
				get_template_part( $ajax_search_results_layout );
			}

			wp_reset_postdata();

			$search_results = ob_get_contents();

			wp_send_json_success(
				array(
					'search_results'   => $search_results,
					'status'           => ob_end_clean(),
					'max_pages'        => $ajax_search_query->max_num_pages,
					'total_properties' => $ajax_search_query->found_posts,
					'page_template'    => $current_page_template,
					'search_args'      => $search_args
				)
			);

		} else {

			wp_send_json_success(
				array(
					'search_results'   => '<div class="rh_alert-wrapper"><h4>' . esc_html__( 'No Results Found!', 'framework' ) . '</h4></div>',
					'status'           => ob_end_clean(),
					'max_pages'        => $ajax_search_query->max_num_pages,
					'total_properties' => $ajax_search_query->found_posts,
					'page_template'    => $current_page_template,
					'search_args'      => $search_args
				)
			);
		}

		die;
	}

	add_action( 'wp_ajax_nopriv_realhomes_filter_ajax_search_results', 'realhomes_filter_ajax_search_results' );
	add_action( 'wp_ajax_realhomes_filter_ajax_search_results', 'realhomes_filter_ajax_search_results' );
}


if ( ! function_exists( 'realhomes_ajax_filter_agents_search' ) ) {
	/**
	 * Add property agent meta field to the meta query of maps for filter widget
	 *
	 * @since 4.1.0
	 *
	 * @param $meta_query
	 *
	 * @return array
	 *
	 */
	function realhomes_ajax_filter_agents_search( $meta_query ) {

		if ( isset( $_POST['agent'] ) && ! empty( $_POST['agent'] ) ) {

			$agents       = $_POST['agent'];
			$agents_array = array();
			if ( is_array( $agents ) ) {
				foreach ( $agents as $agent_item ) {
					$agent_item_array = explode( '|', $agent_item );
					$agents_array[]   = $agent_item_array[0];
				}
			}

			$meta_query[] = array(
				'key'     => 'REAL_HOMES_agents',
				'value'   => $agents_array,
				'compare' => 'IN'
			);
		}

		return $meta_query;
	}

	add_filter( 'realhomes_ajax_meta_search', 'realhomes_ajax_filter_agents_search', 30 );
}


if ( ! function_exists( 'realhomes_filter_widget_map_posts_per_page' ) ) {
	/**
	 * This function manages the posts per page for listing templates map view
	 * handled by the property filters sidebar widget
	 *
	 * @since 4.1.0
	 *
	 * @param $args
	 *
	 * @return array $args
	 *
	 */
	function realhomes_filter_widget_map_posts_per_page( $args ) {

		if ( isset( $_POST['filter_posts_count'] ) && 0 < intval( $_POST['filter_posts_count'] ) ) {

			$args['posts_per_page'] = $_POST['filter_posts_count'];
		}

		return $args;
	}

	add_filter( 'realhomes_ajax_search_parameters', 'realhomes_filter_widget_map_posts_per_page' );
}


if ( ! function_exists( 'realhomes_properties_ajax_filter' ) ) {
	/**
	 * Filter Properties based on selection in Filters sidebar widget
	 *
	 * @since 4.1.0
	 *
	 * @return string JSON
	 *
	 */
	function realhomes_properties_ajax_filter() {

		$page_id = isset( $_POST['pageID'] ) ? $_POST['pageID'] : 0;

		$search_args = array( 'post_type' => 'property' );

		/* Initialize Taxonomy Query Array */
		$tax_query = array();

		/* Initialize Meta Query Array */
		$meta_query = array();

		/* Confirming if necessary information is set */
		if ( isset( $_POST['fieldValues'] ) ) {
			$search_values        = $_POST['fieldValues'];
			$property_features    = isset( $search_values['features'] ) ? $search_values['features'] : '';
			$property_city        = isset( $search_values['locations'] ) ? $search_values['locations'] : '';
			$property_statuses    = isset( $search_values['statuses'] ) ? $search_values['statuses'] : '';
			$property_types       = isset( $search_values['types'] ) ? $search_values['types'] : '';
			$price                = isset( $search_values['price'] ) ? $search_values['price'] : '';
			$area                 = isset( $search_values['area'] ) ? $search_values['area'] : '';
			$min_beds             = isset( $search_values['bedrooms'] ) ? $search_values['bedrooms'] : '';
			$min_baths            = isset( $search_values['bathrooms'] ) ? $search_values['bathrooms'] : '';
			$garages              = isset( $search_values['garages'] ) ? $search_values['garages'] : '';
			$property_id          = isset( $search_values['propertyID'] ) ? $search_values['propertyID'] : '';
			$agents               = isset( $search_values['agent'] ) ? $search_values['agent'] : '';
			$agencies             = isset( $search_values['agencies'] ) ? $search_values['agencies'] : '';
			$number_of_properties = isset( $search_values['filter_posts_count'] ) ? $search_values['filter_posts_count'] : 6;

			$search_args['posts_per_page'] = $number_of_properties;

			// Property Type query filter
			if ( 0 < $property_types ) {
				$tax_query[] = array(
					'taxonomy' => 'property-type',
					'field'    => 'slug',
					'terms'    => $property_types,
				);
			}

			// Property City (location) query filter
			if ( 0 < $property_city ) {
				$tax_query[] = array(
					'taxonomy' => 'property-city',
					'field'    => 'slug',
					'terms'    => $property_city,
				);
			}

			// Property Status query filter
			if ( 0 < $property_statuses ) {
				$tax_query[] = array(
					'taxonomy' => 'property-status',
					'field'    => 'slug',
					'terms'    => $property_statuses,
				);
			}

			// Property Features query filter
			if ( 0 < $property_features ) {
				$tax_query[] = array(
					'taxonomy' => 'property-feature',
					'field'    => 'slug',
					'terms'    => $property_features
				);
			}

			// Minimum Bedrooms
			if ( ! empty( $min_beds ) ) {
				$min_beds = intval( $min_beds ) - 0.1;
				if ( $min_beds > 0 ) {
					$meta_query[] = array(
						'key'     => 'REAL_HOMES_property_bedrooms',
						'value'   => $min_beds,
						'compare' => '>'
					);
				}
			}

			// Minimum Bathrooms
			if ( ! empty( $min_baths ) ) {
				$min_baths = intval( $min_baths ) - 0.1;
				if ( $min_baths > 0 ) {
					$meta_query[] = array(
						'key'     => 'REAL_HOMES_property_bathrooms',
						'value'   => $min_baths,
						'compare' => '>'
					);
				}
			}

			// Minimum Garages
			if ( ! empty( $garages ) ) {
				$garages = intval( $garages ) - 0.1;
				if ( $garages > 0 ) {
					$meta_query[] = array(
						'key'     => 'REAL_HOMES_property_garage',
						'value'   => $garages,
						'compare' => '>'
					);
				}
			}

			// Property ID
			if ( ! empty( $property_id ) ) {
				if ( $property_id > 0 ) {
					$meta_query[] = array(
						'key'     => 'REAL_HOMES_property_id',
						'value'   => $property_id,
						'compare' => '='
					);
				}
			}

			// Property Agents
			if ( ! empty( $agents ) ) {
				$agents_array = array();
				if ( is_array( $agents ) ) {
					foreach ( $agents as $agent_item ) {
						$agent_item_array = explode( '|', $agent_item );
						$agents_array[]   = $agent_item_array[0];
					}
				}

				$meta_query[] = array(
					'key'     => 'REAL_HOMES_agents',
					'value'   => $agents_array,
					'compare' => 'IN'
				);
			}

			// Property Agencies
			if ( ! empty( $agencies ) ) {
				$agency_array = array();
				if ( is_array( $agencies ) ) {
					foreach ( $agencies as $agency_item ) {
						$agency_item_array = explode( '|', $agency_item );
						$agency_array[]    = $agency_item_array[0];
					}
				}

				$agencies_query = new WP_Query(
					array(
						'post_type'      => 'agent',
						'posts_per_page' => -1,
						'meta_query'     => array(
							array(
								'key'     => 'REAL_HOMES_agency',
								'value'   => $agency_array,
								'type'    => 'NUMERIC',
								'compare' => 'IN',
							),
						),
					),
				);

				if ( $agencies_query->have_posts() ) {
					$agents_in_agency = wp_list_pluck( $agencies_query->posts, 'ID' );
				} else {
					$agents_in_agency = [ -1 ];
				}

				$meta_query[] = array(
					'key'     => 'REAL_HOMES_agents',
					'value'   => $agents_in_agency,
					'compare' => 'IN',
				);

			}


			// Prices Range Meta
			$price_array = explode( ' - ', $price );
			if ( is_array( $price_array ) ) {
				$min_price = doubleval( $price_array[0] );
				$max_price = doubleval( $price_array[1] );
				if ( $min_price >= 0 && $max_price > $min_price ) {
					$meta_query[] = array(
						'key'     => 'REAL_HOMES_property_price',
						'value'   => array( $min_price, $max_price ),
						'type'    => 'NUMERIC',
						'compare' => 'BETWEEN'
					);
				}
			}

			// Areas Range Meta
			$area_array = explode( ' - ', $area );
			if ( is_array( $area_array ) ) {
				$min_area = doubleval( $area_array[0] );
				$max_area = doubleval( $area_array[1] );
				if ( $min_area >= 0 && $max_area > $min_area ) {
					$meta_query[] = array(
						'key'     => 'REAL_HOMES_property_size',
						'value'   => array( $min_area, $max_area ),
						'type'    => 'NUMERIC',
						'compare' => 'BETWEEN',
					);
				}
			}

			// Additional fields query filter
			$additional_fields = get_option( 'inspiry_property_additional_fields' );
			$additional_fields = $additional_fields['inspiry_additional_fields_list'];
			if ( is_array( $additional_fields ) && 0 < count( $additional_fields ) ) {
				foreach ( $additional_fields as $field ) {
					$field_name = $field['field_name'];
					$field_type = $field['field_type'];
					$field_slug = 'inspiry_' . strtolower( str_replace( ' ', '_', $field_name ) );

					if ( ! empty( $search_values[ $field_slug ] ) ) {

						if ( $field_type === 'checkbox' ) {
							$meta_query[] = array(
								'key'     => $field_slug,
								'value'   => $search_values[ $field_slug ],
								'compare' => 'IN',
							);

						} else if ( $field_type === 'textarea' ) {
							$meta_query[] = array(
								'key'     => $field_slug,
								'value'   => $_POST[ $field_slug ],
								'compare' => 'LIKE'
							);
						} else {
							$meta_query[] = array(
								'key'     => $field_slug,
								'value'   => $search_values[ $field_slug ],
								'compare' => '='
							);
						}
					}
				}
			}

			/* Managing the page number */
			if ( ! empty( $search_values['page'] ) ) {
				$search_args['paged'] = $search_values['page'];
			}

		} // isset fieldValues

		/* Taxonomy Search Filter */
		$tax_query = apply_filters( 'realhomes_ajax_filters_widget_taxonomy', $tax_query );

		/* Meta Search Filter */
		$meta_query = apply_filters( 'realhomes_ajax_filters_widget_meta', $meta_query );

		/* If more than one taxonomy exists then specify the relation */
		$tax_count = count( $tax_query );
		if ( $tax_count > 1 ) {
			$tax_query['relation'] = 'AND';
		}

		/* If more than one meta query elements exist then specify the relation */
		$meta_count = count( $meta_query );
		if ( $meta_count > 1 ) {
			$meta_query['relation'] = 'AND';
		}

		/* If taxonomy query has some values then add it to search query */
		if ( $tax_count > 0 ) {
			$search_args['tax_query'] = $tax_query;
		}

		/* If meta query has some values then add it to search query */
		if ( $meta_count > 0 ) {
			$search_args['meta_query'] = $meta_query;
		}

		if ( ! empty( $search_values['properties_sort_by'] ) ) {
			$search_args = sort_properties( $search_args, $search_values['properties_sort_by'] );
		}

		$ajax_search_query      = new WP_Query( $search_args );
		$search_results         = '';
		$prop_wrap              = $view_type = false;
		$pagination_inner_class = 'rh_filter_pagination';
		if ( isset( $search_values['view_type'] ) ) {
			$view_type = $search_values['view_type'];
		}

		if ( INSPIRY_DESIGN_VARIATION === 'ultra' ) {

			if ( ! $view_type || $view_type == 'list' ) {
				$properties_wrapper_class = 'rh-ultra-list-box';

				// setting default filter card layout
				$ajax_search_results_layout = 'assets/ultra/partials/properties/list-card-1';
			}

			// getting the current template to ensure results in current template card format
			$current_page_template = get_page_template_slug( $page_id );
			$prop_wrap             = true;
			$grid_wrapper_class    = 'rh-ultra-grid-box rh-ultra-card-col-2';
			$grid_card_variation   = 'assets/ultra/partials/properties/grid-card-' . get_option( 'realhomes_property_card_variation', '1' );

			// checking if the view type is set by buttons
			if ( $view_type !== false ) {
				if ( $view_type === 'grid' ) {
					$ajax_search_results_layout = $grid_card_variation;
					$properties_wrapper_class   = $grid_wrapper_class;
				}
			} else {
				if ( 'templates/grid-layout.php' === $current_page_template ) {
					$ajax_search_results_layout = $grid_card_variation;
					$properties_wrapper_class   = $grid_wrapper_class;
				}
			}


			// design related pagination classes
			$pagination_classes = 'filter-pagination';

		} else {
			// The else body contains the values set for Modern design variation

			// getting the current template to ensure results in current template card format
			$current_page_template = get_page_template_slug( $page_id );

			// getting current card variation to match with the selected listing template layout
			$property_card_meta_box  = get_post_meta( get_the_ID(), 'inspiry-property-card-meta-box', true );
			$property_card_variation = get_option( 'inspiry_property_card_variation', '1' );
			if ( ! empty( $property_card_meta_box ) && 'default' != $property_card_meta_box ) {
				$property_card_variation = $property_card_meta_box;
			}

			// setting default filter card layout to list
			$ajax_search_results_layout = 'assets/modern/partials/properties/list-card';

			// checking if the view type is set by buttons
			if ( $view_type !== false ) {
				if ( $view_type === 'grid' ) {
					$ajax_search_results_layout = 'assets/modern/partials/properties/grid-card' . '-' . $property_card_variation;
				}
			} else {
				if ( 'templates/grid-layout.php' === $current_page_template ) {
					$ajax_search_results_layout = 'assets/modern/partials/properties/grid-card' . '-' . $property_card_variation;
				}
			}

			// design related pagination classes
			$pagination_classes = 'filter-widget-pagination filter-pagination';
		}

		ob_start();

		if ( $ajax_search_query->have_posts() ) {

			if ( $prop_wrap ) {
				?>
                <div class="<?php echo esc_attr( $properties_wrapper_class ); ?>">
				<?php
			}

			while ( $ajax_search_query->have_posts() ) {

				$ajax_search_query->the_post();

				get_template_part( $ajax_search_results_layout );

			}

			if ( $prop_wrap ) {
				?>
                </div>
				<?php
			}
			?>
            <div class="<?php echo esc_attr( $pagination_classes ); ?>">
				<?php
				realhomes_ajax_pagination( $ajax_search_query->max_num_pages, $ajax_search_query, $pagination_inner_class );
				?>
            </div>
			<?php
			$search_results = ob_get_contents();

			wp_send_json_success(
				array(
					'search_results'   => $search_results,
					'status'           => ob_end_clean(),
					'max_pages'        => $ajax_search_query->max_num_pages,
					'search_query'     => $ajax_search_query,
					'total_properties' => $ajax_search_query->found_posts,
					'page_template'    => $current_page_template
				)
			);

			wp_reset_postdata();

		} else {

			realhomes_print_no_result( esc_html__( 'No Properties Found!', 'framework' ) );

			$search_results = ob_get_contents();

			wp_send_json_success(
				array(
					'search_results' => $search_results,
					'status'         => ob_end_clean()
				)
			);

		}

		die;

	}

	add_action( 'wp_ajax_nopriv_realhomes_properties_ajax_filter', 'realhomes_properties_ajax_filter' );
	add_action( 'wp_ajax_realhomes_properties_ajax_filter', 'realhomes_properties_ajax_filter' );
}