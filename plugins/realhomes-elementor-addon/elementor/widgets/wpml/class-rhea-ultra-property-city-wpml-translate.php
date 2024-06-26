<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Property_City_WPML_Translate {

	public function __construct() {
		add_filter( 'wpml_elementor_widgets_to_translate', [
			$this,
			'realhomes_property_city_widget_to_translate'
		] );
	}

	public function realhomes_property_city_widget_to_translate( $widgets ) {

		$widgets['rhea-ultra-city'] = [
			'conditions' => [ 'widgetType' => 'rhea-ultra-city' ],
			'fields'     => [
				[
					'field'       => 'rhea_city_label',
					'type'        => esc_html__( 'Ultra Property City: City Name', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'rhea_properties_view_all',
					'type'        => esc_html__( 'Ultra Property City: View Button Text', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'rhea_properties_label',
					'type'        => esc_html__( 'Ultra Property City: Properties Label', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
			],
		];

		return $widgets;
	}
}

new RHEA_Ultra_Property_City_WPML_Translate();