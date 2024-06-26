<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Agents_WPML_Translate {

	public function __construct() {
		add_filter( 'wpml_elementor_widgets_to_translate', [
			$this,
			'realhomes_ultra_agents_to_translate'
		] );
	}

	public function realhomes_ultra_agents_to_translate( $widgets ) {

		$widgets['rhea-ultra-agents-widget'] = [
			'conditions'        => [ 'widgetType' => 'rhea-ultra-agents-widget' ],
			'fields'            => [
				[
					'field'       => 'view-profile-text',
					'type'        => esc_html__( 'Ultra Agents : View Profile Button Text', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'listed-properties-single-text',
					'type'        => esc_html__( 'Ultra Agents : Listed Properties Singular Text', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'listed-properties-text',
					'type'        => esc_html__( 'Ultra Agents : Listed Properties Text', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],

			],
			'integration-class' => 'RHEA_Ultra_Agents_Repeater_WPML_Translate',

		];

		return $widgets;

	}
}

class RHEA_Ultra_Agents_Repeater_WPML_Translate extends WPML_Elementor_Module_With_Items {

	public function get_items_field() {
		return 'rhea_agent';
	}

	public function get_fields() {
		return array( 'rhea_agent_title' );
	}

	protected function get_title( $field ) {
		switch ( $field ) {
			case 'rhea_agent_title':
				return esc_html__( 'Ultra Agents: Agent Title', 'realhomes-elementor-addon' );

			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'rhea_agent_title':
				return 'LINE';
			default:
				return '';
		}
	}

}

new RHEA_Ultra_Agents_WPML_Translate();