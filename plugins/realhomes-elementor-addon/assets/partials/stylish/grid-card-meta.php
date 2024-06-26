<?php
global $settings;

$settings_to_keys = array(
	'bedrooms'   => array(
		'key'     => 'REAL_HOMES_property_bedrooms',
		'icon'    => 'bed',
		'postfix' => ''
	),
	'bathrooms'  => array(
		'key'     => 'REAL_HOMES_property_bathrooms',
		'icon'    => 'shower',
		'postfix' => ''
	),
	'area'       => array(
		'key'     => 'REAL_HOMES_property_size',
		'icon'    => 'area',
		'postfix' => 'REAL_HOMES_property_size_postfix'
	),
	'garage'     => array(
		'key'     => 'REAL_HOMES_property_garage',
		'icon'    => 'icon-garage',
		'postfix' => ''
	),
	'year-built' => array(
		'key'     => 'REAL_HOMES_property_year_built',
		'icon'    => 'icon-calendar',
		'postfix' => ''
	),
	'lot-size'   => array(
		'key'     => 'REAL_HOMES_property_lot_size',
		'icon'    => 'icon-lot',
		'postfix' => 'REAL_HOMES_property_lot_size_postfix'
	),
	'property-id'   => array(
		'key'     => 'REAL_HOMES_property_id',
		'icon'    => 'icon-tag',
		'postfix' => ''
	),
);

if ( rhea_is_rvr_enabled() ) {
	$settings_to_keys['guests'] = array(
		'key'     => 'rvr_guests_capacity',
		'icon'    => 'guests-icons',
		'postfix' => ''
	);

	$settings_to_keys['min-stay'] = array(
		'key'     => 'rvr_min_stay',
		'icon'    => 'icon-min-stay',
		'postfix' => ''
	);
}

if ( isset( $settings['rhea_add_meta_select'] ) && ! empty( $settings['rhea_add_meta_select'] ) ) {
	?>
    <div class="rh_prop_card_meta_wrap_stylish">
		<?php
		foreach ( $settings['rhea_add_meta_select'] as $meta ) {
			if ( isset( $meta['rhea_property_meta_display'] ) &&
			     ! empty( $meta['rhea_property_meta_display'] ) &&
			     isset( $settings_to_keys[ $meta['rhea_property_meta_display'] ] )
			) {
				rhea_stylish_meta(
					$meta['rhea_meta_repeater_label'],
					$settings_to_keys[ $meta['rhea_property_meta_display'] ]['key'],
					$settings_to_keys[ $meta['rhea_property_meta_display'] ]['icon'],
					$settings_to_keys[ $meta['rhea_property_meta_display'] ]['postfix']
				);
			}
		}

		/**
		 * Generating additional meta fields
		 */
		rhea_property_widgets_additional_fields( get_the_ID(), 'listing' );
		?>
    </div>
	<?php
}
