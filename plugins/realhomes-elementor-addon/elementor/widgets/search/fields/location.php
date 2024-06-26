<?php
/**
 * Field: Location
 *
 * @package realhomes_elementor_addon
 * @since   3.0.0
 */
global $settings, $the_widget_id, $search_fields_to_display;
$field_separator = '';
$separator_class = ' location-separator_';
if ( isset( $settings['show_fields_separator'] ) && 'yes' === $settings['show_fields_separator'] ) {
	$field_separator = ' rhea-ultra-field-separator ';
}

if ( is_array( $search_fields_to_display ) && in_array( 'location', $search_fields_to_display ) ) {
	$field_key = array_search( 'location', $search_fields_to_display );
	$field_key = intval( $field_key ) + 1;

	if ( rhea_is_rvr_enabled()
	     && function_exists( 'inspiry_get_maps_type' ) && 'google-maps' === inspiry_get_maps_type()
	     && realhomes_is_location_type_geolocation() ) {
		$location_placeholder = $settings['rhea_location_ph_1'];
		?>
        <div class="rhea_prop_search__option rhea_mod_text_field rh_geolocation_field_wrapper rhea_prop_locations_field <?php echo esc_attr( $field_separator ); ?> rhea_prop_search__select" style="order: <?php echo esc_attr( $field_key ); ?>" data-key-position="<?php echo esc_attr( $field_key ); ?>" data-get-location-placeholder="<?php echo esc_attr( $location_placeholder ); ?>">
            <div id="places-autocomplete-wrap" class="geolocation-address-field-inner">
				<?php
				if ( 'yes' === $settings['show_labels'] ) {
					$location_label = $settings['rhea_location_title_1'];
					?>
                    <label class="rhea_fields_labels" for="<?php echo esc_attr( $location_label ); ?>"><?php echo esc_html( $location_label ); ?></label>
					<?php
				}

				inspiry_safe_include_svg( '/icons/icon-marker.svg' );
				$geolocation_placeholder = $settings['rhea_location_ph_1'];
				if ( empty( $geolocation_placeholder ) ) {
					$geolocation_placeholder = rh_any_text();
				}
				?>
                <input type="text" name="geolocation-address" id="geolocation-address" autocomplete="off" value="<?php echo isset( $_GET['geolocation-address'] ) ? esc_attr( $_GET['geolocation-address'] ) : ''; ?>" placeholder="<?php echo esc_attr( $geolocation_placeholder ); ?>"/>
                <div id="location-fields-wrap">
                    <input type="hidden" class="location-field-lat" name="lat" value="<?php echo isset( $_GET['lat'] ) ? esc_attr( $_GET['lat'] ) : ''; ?>">
                    <input type="hidden" class="location-field-lng" name="lng" value="<?php echo isset( $_GET['lng'] ) ? esc_attr( $_GET['lng'] ) : ''; ?>">
                </div>
            </div>
        </div>
		<?php
	} else {
		$location_select_count  = $settings['rhea_select_locations']; // Number of locations chosen from elementor control.
		$location_select_names  = rhea_get_location_select_names(); // Variable that contains location select boxes names.
		$location_select_titles = rhea_get_location_titles(
			$settings['rhea_location_title_1'],
			$settings['rhea_location_title_2'],
			$settings['rhea_location_title_3'],
			$settings['rhea_location_title_4']
		); // Default location select boxes titles.
		$location_placeholder   = rhea_location_placeholder(
			$settings['rhea_location_ph_1'],
			$settings['rhea_location_ph_2'],
			$settings['rhea_location_ph_3'],
			$settings['rhea_location_ph_4']
		);
		$select_class           = 'rhea_multi_select_picker_location'; // Default class for the location dropdown fields

		// Generate required location select boxes.
		if ( '1' == $location_select_count && 'yes' == $settings['set_multiple_location'] ) {
			$name_multi = '[]';
		} else {
			$name_multi = '';
		}

		for ( $i = 0; $i < $location_select_count; $i ++ ) {
			?>
            <div class="rhea_prop_search__option rhea_prop_locations_field rhea_location_prop_search_<?php echo esc_attr( $i ) . esc_attr( $field_separator ) . esc_attr( $separator_class . $i ) ?> rhea_prop_search__select" style="order: <?php echo esc_attr( $field_key ); ?>" data-key-position="<?php echo esc_attr( $field_key ); ?>" data-get-location-placeholder="<?php echo esc_attr( $location_placeholder[ $i ] ); ?>">
				<?php
				if ( 'yes' === $settings['show_labels'] ) {
					?>
                    <label class="rhea_fields_labels" for="<?php echo esc_attr( $location_select_names[ $i ] ); ?>"><?php echo esc_html( $location_select_titles[ $i ] ); ?></label>
					<?php
				}
				?>
                <span class="rhea_prop_search__selectwrap <?php rhea_add_fields_icon_class( 'enable_location_icon', $settings ) ?>">
                    <?php rhea_generate_fields_icons( 'location_icon', $settings ); ?>
                <select id="<?php echo esc_attr( $the_widget_id . $location_select_names[ $i ] ); ?>" class="<?php echo esc_attr( $select_class ); ?> show-tick" data-size="<?php echo esc_attr( $settings['rhea_dropdown_items_in'] ); ?>" data-none-results-text="<?php esc_attr_e( 'No results matched', 'realhomes-elementor-addon' ) ?>{0}" data-none-selected-text="<?php echo esc_attr( $location_placeholder[ $i ] ); ?>" data-live-search="true"
                         <?php
                         if ( '1' == $location_select_count && 'yes' == $settings['set_multiple_location'] ) {
	                         ?>
                             name="location[]" data-selected-text-format="count > 2" multiple="multiple" data-actions-box="true" data-count-selected-text="{0} <?php echo esc_attr( $settings['location_count_placeholder'] ) ?>" title="<?php echo esc_html( $location_select_titles[ $i ] ); ?>"
	                         <?php
                         } else if ( '1' == $location_select_count && 'yes' !== $settings['set_multiple_location'] ) {
	                         ?>
                             data-max-options="1" name="location[]"
	                         <?php
                         } else {
	                         ?>
                             name="<?php echo esc_attr( $location_select_names[ $i ] . $name_multi ); ?>"
	                         <?php
                         }
                         ?>
                >
                </select>
            </span>
            </div>
			<?php
		}

		// Important action hook - related JS works based on it.
		do_action( 'rhea_after_location_fields' );
	}
}
