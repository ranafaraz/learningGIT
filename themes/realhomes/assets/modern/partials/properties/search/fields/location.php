<?php
/**
 * Field: Location
 *
 * @since   3.0.0
 * @package realhomes/modern
 */

if ( 'geo-location' === get_option( 'realhomes_location_field_type', 'default' ) && inspiry_is_rvr_enabled() && 'google-maps' === inspiry_get_maps_type() ) {
	?>

    <div class="rh_prop_search__option rh_mod_text_field rh_geolocation_field_wrapper">
        <label for="geolocation-address">
			<?php
			$geolocation_label = get_option( 'realhomes_geolocation_label' );
			if ( $geolocation_label ) {
				echo esc_html( $geolocation_label );
			} else {
				esc_html_e( 'Location Address', 'framework' );
			}
			?>
        </label>
        <div id="places-autocomplete-wrap" class="geolocation-address-field-inner">
			<?php
			inspiry_safe_include_svg( '/images/icons/icon-marker.svg' );

			$geolocation_placeholder = get_option( 'realhomes_geolocation_placeholder_text' );
			if ( empty( $geolocation_placeholder ) ) {
				$geolocation_placeholder = rh_any_text();
			}

			?>
            <input type="text" name="geolocation-address" id="geolocation-address" autocomplete="off" value="<?php echo isset( $_GET['geolocation-address'] ) ? esc_attr( $_GET['geolocation-address'] ) : ''; ?>" placeholder="<?php echo esc_attr( $geolocation_placeholder ); ?>" />
            <div id="location-fields-wrap">
                <input type="hidden" class="location-field-lat" name="lat" value="<?php echo isset( $_GET['lat'] ) ? esc_attr( $_GET['lat'] ) : ''; ?>">
                <input type="hidden" class="location-field-lng" name="lng" value="<?php echo isset( $_GET['lng'] ) ? esc_attr( $_GET['lng'] ) : ''; ?>">
            </div>
        </div>
		<?php
		if ( is_page_template( array(
			'templates/properties-search.php',
			'templates/properties-search-half-map.php',
			'templates/half-map-layout.php',
			'templates/properties-search-left-sidebar.php',
			'templates/properties-search-right-sidebar.php'
		) ) ) {
			if ( 'modern' === INSPIRY_DESIGN_VARIATION && 'properties-map' === get_option( 'theme_search_module', 'properties-map' ) && inspiry_is_search_page_map_visible() ) {
				$default_radius = ! empty( $_GET['geolocation-radius'] ) ? $_GET['geolocation-radius'] : get_option( 'realhomes_search_radius_range_initial', '20' );
				$radius_unit    = esc_html__( 'miles', 'framework' );

				if ( 'kilometers' === get_option( 'realhomes_search_radius_range_type', 'miles' ) ) {
					$radius_unit = esc_html__( 'km', 'framework' );
				}
				?>
                <div id="geolocation-radius-slider-wrapper" class="geolocation-radius-slider-wrapper">
                    <p class="geolocation-radius-info">
						<?php esc_html_e( 'Radius:', 'framework' ); ?>
                        <strong><?php printf( '%s %s', esc_html( $default_radius ), esc_html( $radius_unit ) ); ?></strong>
                    </p>
                    <div id="geolocation-radius-slider" data-unit="<?php echo esc_attr( $radius_unit ); ?>" data-value="<?php echo esc_attr( $default_radius ); ?>" data-min-value="<?php echo get_option( 'realhomes_search_radius_range_min', '10' ); ?>" data-max-value="<?php echo get_option( 'realhomes_search_radius_range_max', '50' ); ?>"></div>
                    <input type="hidden" name="geolocation-radius" id="geolocation-radius" value="<?php echo esc_attr( $default_radius ); ?>">
                </div>
				<?php
			}
		}
		?>
    </div>
	<?php
} else {
	$location_select_count     = inspiry_get_locations_number(); // Number of locations chosen from theme options.
	$location_select_names     = inspiry_get_location_select_names(); // Variable that contains location select boxes names.
	$location_select_titles    = inspiry_get_location_titles(); // Default location select boxes titles.
	$rh_locations_placeholders = realhomes_locations_placeholders();
	$select_class              = 'inspiry_select_picker_trigger'; // Default class for the location dropdown fields.
	$is_location_ajax          = get_option( 'inspiry_ajax_location_field', 'no' ); // Option to check if location field Ajax is enabled.
	$multiselect_locations     = get_option( 'inspiry_search_form_multiselect_locations', 'yes' );

	$parent_class = '';
	if ( 'yes' === $is_location_ajax ) {
		$parent_class = ' inspiry_ajax_location_wrapper ';
		$select_class = '   inspiry_select_picker_trigger inspiry_ajax_location_field';
	}

	// Generate required location select boxes.
	for ( $select_index = 0; $select_index < $location_select_count; $select_index++ ) {
		$rh_current_select_placeholder = $rh_locations_placeholders[ $select_index ];
		?>
        <div class="<?php echo esc_attr( $parent_class ); ?> inspiry_select_picker_field rh_prop_search__option rh_location_prop_search_<?php echo esc_attr( $select_index ); ?> rh_prop_search__select" data-get-location-placeholder="<?php echo esc_attr( $rh_current_select_placeholder ); ?>">
            <label for="<?php echo esc_attr( $location_select_names[ $select_index ] ); ?>">
				<?php echo esc_html( $location_select_titles[ $select_index ] ); ?>
            </label>

            <span class="rh_prop_search__selectwrap">
            <?php
            if ( 'yes' === $is_location_ajax ) {
	            ?>
                <span class="rh-location-ajax-loader"><?php inspiry_safe_include_svg( '/images/loader.svg' ); ?></span>
	            <?php
            }
            ?>
			<select id="<?php echo esc_attr( $location_select_names[ $select_index ] ); ?>" class="inspiry_multi_select_picker_location <?php echo esc_attr( $select_class ); ?> show-tick" data-size="5" data-live-search="true" data-none-results-text="<?php esc_attr_e( 'No results matched', 'framework' ) ?>{0}" data-none-selected-text="<?php echo esc_attr( $rh_current_select_placeholder ); ?>"
                    <?php
                    if ( 'yes' == $multiselect_locations && $location_select_count <= 1 ) {
	                    ?>
                        name="location[]"data-selected-text-format="count > 2" multiple="multiple" data-actions-box="true" title="<?php
	                    $loc_placeholder = get_option( 'inspiry_location_placeholder_1' );
	                    if ( ! empty( $loc_placeholder ) ) {
		                    echo esc_attr( $loc_placeholder );
	                    } else {
		                    esc_attr_e( 'All Locations', 'framework' );
	                    } ?>"

                        data-count-selected-text="{0} <?php
	                    $loc_counter_placeholder = get_option( 'inspiry_location_count_placeholder_1' );
	                    if ( ! empty( $loc_counter_placeholder ) ) {
		                    echo esc_attr( $loc_counter_placeholder );
	                    } else {
		                    esc_attr_e( ' Locations Selected ', 'framework' );
	                    }
	                    ?>"
	                    <?php
                    } else if ( 'no' == $multiselect_locations && 'yes' === $is_location_ajax ) {
	                    ?>
                        name="location[]" data-max-options="1" multiple="multiple" title="<?php
	                    $loc_placeholder = get_option( 'inspiry_location_placeholder_1' );
	                    if ( ! empty( $loc_placeholder ) ) {
		                    echo esc_attr( $loc_placeholder );
	                    } else {
		                    esc_attr_e( 'All Locations', 'framework' );
	                    } ?>"
	                    <?php
                    } else {
	                    ?>
                        name="<?php echo esc_attr( $location_select_names[ $select_index ] ); ?>"
	                    <?php
                    }
                    ?>>
                <?php
                if ( 'yes' === $is_location_ajax && $location_select_count <= 1 ) {
	                inspiry_searched_ajax_locations();
                }
                ?>
			</select>
		</span>
        </div>
		<?php
	}

	// Important action hook - related JS works based on it.
	do_action( 'after_location_fields' );
}