<?php
if ( ! function_exists( 'realhomes_is_custom_property_meta_icons' ) ) {
	/**
	 * Checks whether custom property meta icons setting is enabled.
	 *
	 * @since 4.3.0
	 *
	 * @return bool
	 */
	function realhomes_is_custom_property_meta_icons() {

		if ( 'true' === get_option( 'realhomes_custom_property_meta_icons', 'false' ) ) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'realhomes_allow_svg_upload' ) ) {
	/**
	 * Allow SVG file uploads for custom property meta icons if the user enables it.
	 *
	 * @since 4.3.0
	 *
	 * @param array $mimes List of allowed mime types.
	 *
	 * @return array
	 */
	function realhomes_allow_svg_upload( $mimes ) {
		// Add SVG MIME type to the allowed upload types.
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

	// Check if custom property meta icons are enabled and SVG uploads are allowed.
	if ( realhomes_is_custom_property_meta_icons() && 'true' === get_option( 'realhomes_allow_svg_upload', 'false' ) ) {
		// Add a filter to allow SVG file uploads.
		add_filter( 'upload_mimes', 'realhomes_allow_svg_upload' );
	}
}

if ( ! function_exists( 'realhomes_property_meta_fields' ) ) {
	/**
	 * Provides a list of property meta fields.
	 *
	 * @since 4.3.0
	 *
	 * @return array
	 */
	function realhomes_property_meta_fields() {

		$property_meta_fields = array(
			'REAL_HOMES_property_bedrooms'   => array(
				'id'    => 'bedrooms',
				'label' => esc_html__( 'Bedrooms', 'framework' ),
			),
			'REAL_HOMES_property_bathrooms'  => array(
				'id'    => 'bathrooms',
				'label' => esc_html__( 'Bathrooms', 'framework' ),
			),
			'REAL_HOMES_property_garage'     => array(
				'id'    => 'garage',
				'label' => esc_html__( 'Garage', 'framework' ),
			),
			'REAL_HOMES_property_size'       => array(
				'id'    => 'size',
				'label' => esc_html__( 'Area Size', 'framework' ),
			),
			'REAL_HOMES_property_lot_size'   => array(
				'id'    => 'lot_size',
				'label' => esc_html__( 'Lot Size', 'framework' ),
			),
			'REAL_HOMES_property_year_built' => array(
				'id'    => 'year_built',
				'label' => esc_html__( 'Year Built', 'framework' ),
			),
		);

		if ( inspiry_is_rvr_enabled() ) {
			$property_meta_fields['rvr_guests_capacity'] = array(
				'id'    => 'rvr_guests_capacity',
				'label' => esc_html__( 'Capacity', 'framework' ),
			);
			$property_meta_fields['rvr_min_stay']        = array(
				'id'    => 'rvr_min_stay',
				'label' => esc_html__( 'Min Stay', 'framework' ),
			);
		}

		return $property_meta_fields;
	}
}

if ( ! function_exists( 'realhomes_cache_property_meta_svg_icons' ) ) {
	/**
	 * Retrieves and caches SVG icons associated with property meta fields.
	 *
	 * This function iterates through custom property meta fields, checks if SVG icons
	 * are specified, downloads their content, and caches them for later use. It ensures
	 * that duplicate icons are removed before returning the unique SVG icons.
	 *
	 * @since 4.3.0
	 *
	 * @return array An associative array where keys are property meta field IDs and values
	 *               are the SVG icon contents. Returns an empty array if no custom icons are found.
	 */
	function realhomes_cache_property_meta_svg_icons() {
		$svg_icons = array();
		$fields    = realhomes_property_meta_fields();

		foreach ( $fields as $field ) {
			$icon = get_option( 'realhomes_' . $field['id'] . '_property_meta_icon' );

			if ( ! empty( $icon ) ) {

				// Check if the file is an SVG.
				if ( preg_match( '/\.svg$/', $icon ) === 1 ) {
					$file_name = basename( $icon );

					if ( ! in_array( $file_name, array_keys( $svg_icons ) ) ) {

						// Download SVG content and cache it.
						$svg_file = wp_remote_get( $icon );
						if ( is_array( $svg_file ) && ! is_wp_error( $svg_file ) ) {
							$svg_content = wp_remote_retrieve_body( $svg_file );

							$svg_class = 'custom-meta-icon custom-meta-icon-svg';
							if ( preg_match( '/<svg[^>]*\bclass\s*=\s*["\'](.*?)["\'][^>]*>/', $svg_content ) ) {
								$svg_content = str_replace( '<svg class="', '<svg class="' . $svg_class . ' ', $svg_content );
							} else {
								$svg_content = str_replace( '<svg', '<svg class="' . $svg_class . '"', $svg_content );
							}

							$sanitized_svg = ( new RealHomes_Sanitize_Svg() )->sanitize( $svg_content );

							if ( false !== $sanitized_svg ) {
								$svg_icons[ $file_name ] = $sanitized_svg;
							}
						}
					}
				}
			}
		}

		// Remove duplicate icons.
		return array_unique( $svg_icons );
	}
}

// Cache SVG icons if custom property meta icons are available.
if ( realhomes_is_custom_property_meta_icons() ) {
	$realhomes_property_meta_svg_icons_cache = realhomes_cache_property_meta_svg_icons();
}

if ( ! function_exists( 'realhomes_property_meta_icon_custom' ) ) {
	/**
	 * Generates HTML markup for custom property meta icons.
	 *
	 * @since 4.3.0
	 *
	 * @param string $field_name The ID of the property meta field for which the icon is generated.
	 *
	 * @return boolean True if custom icon markup is generated and displayed, false otherwise.
	 */
	function realhomes_property_meta_icon_custom( $field_name ) {
		$fields = realhomes_property_meta_fields();

		if ( realhomes_is_custom_property_meta_icons() && isset( $fields[ $field_name ] ) ) {
			$field = $fields[ $field_name ];
			$icon  = get_option( 'realhomes_' . $field['id'] . '_property_meta_icon' );

			if ( $icon ) {
				if ( preg_match( '/\.svg$/', $icon ) === 1 ) {
					$file_name = basename( $icon );

					global $realhomes_property_meta_svg_icons_cache;
					if ( ! empty( $realhomes_property_meta_svg_icons_cache[ $file_name ] ) ) {
						echo $realhomes_property_meta_svg_icons_cache[ $file_name ];
					}
				} else {
					echo '<img class="custom-meta-icon custom-meta-icon-image" src="' . esc_url( $icon ) . '" alt="' . sprintf( esc_attr__( '%s property meta icon.', 'framework' ), $field['label'] ) . '">';
				}

				return true;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'realhomes_property_meta_icon' ) ) {
	/**
	 * Display the property meta icon.
	 *
	 * @since 4.3.0
	 *
	 * @param string $field_name The ID of the property meta field for which the icon is displayed.
	 * @param string $file       Path to the SVG file to be included if a custom icon is not available.
	 * @param string $path       (Optional) The path to the directory containing the SVG file. Defaults to INSPIRY_THEME_ASSETS.
	 */
	function realhomes_property_meta_icon( $field_name, $file, $path = INSPIRY_THEME_ASSETS ) {
		if ( ! realhomes_property_meta_icon_custom( $field_name ) ) {
			inspiry_safe_include_svg( $file, $path );
		}
	}
}