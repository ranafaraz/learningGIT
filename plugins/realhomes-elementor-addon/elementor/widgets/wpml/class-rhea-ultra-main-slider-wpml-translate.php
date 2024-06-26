<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Main_Slider_WPML_Translate {

	public function __construct() {
		add_filter( 'wpml_elementor_widgets_to_translate', [
			$this,
			'realhomes_ultra_main_slider_to_translate'
		] );

	}

	public function realhomes_ultra_main_slider_to_translate( $widgets ) {

		$widgets['rhea-ultra-main-properties-slider'] = [
			'conditions'        => [ 'widgetType' => 'rhea-ultra-main-properties-slider' ],
			'fields'            => [

				[
					'field'       => 'ere_property_featured_label',
					'type'        => esc_html__( 'Ultra Main Slider: Featured', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'ere_property_build_label',
					'type'        => esc_html__( 'Ultra Main Slider: Build', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],

			],
			'integration-class' => 'RHEA_Ultra_Main_Slider_Repeater_WPML_Translate',
		];

		return $widgets;

	}
}

class RHEA_Ultra_Main_Slider_Repeater_WPML_Translate extends WPML_Elementor_Module_With_Items {
	public function get_items_field() {
		return 'rhea_add_meta_select';
	}

	public function get_fields() {
		return array( 'rhea_meta_repeater_label' );
	}

	protected function get_title( $field ) {
		switch ( $field ) {
			case 'rhea_meta_repeater_label':
				return esc_html__( 'Ultra Main Slider: Meta Label', 'realhomes-elementor-addon' );
			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'rhea_meta_repeater_label':
				return 'LINE';
			default:
				return '';
		}
	}
}

new RHEA_Ultra_Main_Slider_WPML_Translate();