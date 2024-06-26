<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Properties_Slider_Two_WPML_Translate {

	public function __construct() {
		add_filter( 'wpml_elementor_widgets_to_translate', [
			$this,
			'inspiry_properties_slider_two_widget_to_translate'
		] );
	}

	public function inspiry_properties_slider_two_widget_to_translate( $widgets ) {

		$widgets['rhea-properties-slider-two-widget'] = [
			'conditions'        => [ 'widgetType' => 'rhea-properties-slider-two-widget' ],
			'fields'            => [],
			'integration-class' => ['RHEA_Properties_Slider_Two_Properties_Repeater_WPML_Translate', 'RHEA_Properties_Slider_Two_Repeater_WPML_Translate']
		];

		return $widgets;
	}
}

class RHEA_Properties_Slider_Two_Properties_Repeater_WPML_Translate extends WPML_Elementor_Module_With_Items {

	public function get_items_field() {
		return 'properties_list';
	}

	public function get_fields() {
		return array( 'property_title' );
	}

	protected function get_title( $field ) {
		switch ( $field ) {
			case 'property_title':
				return esc_html__( 'Properties Slider 2 Widget: Property Title', 'realhomes-elementor-addon' );

			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'property_title':
				return 'LINE';

			default:
				return '';
		}
	}
}

class RHEA_Properties_Slider_Two_Repeater_WPML_Translate extends WPML_Elementor_Module_With_Items {

	public function get_items_field() {
		return 'rhea_add_meta_select';
	}

	public function get_fields() {
		return array( 'rhea_meta_repeater_label' );
	}

	protected function get_title( $field ) {
		switch ( $field ) {
			case 'rhea_meta_repeater_label':
				return esc_html__( 'Properties Slider 2 Widget: Meta Label', 'realhomes-elementor-addon' );

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

new RHEA_Properties_Slider_Two_WPML_Translate();