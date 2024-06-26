<?php
/**
 * Agent Contact Form Elementor widget for single property WPML Support
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Single_Property_Agent_Contact_Form_WPML_Translate {

	public function __construct() {
		add_filter( 'wpml_elementor_widgets_to_translate', [
			$this,
			'inspiry_single_agent_contact_form_to_translate'
		] );
	}

	public function inspiry_single_agent_contact_form_to_translate( $widgets ) {

		$widgets['rhea-ultra-single-property-agent'] = [
			'conditions'        => [ 'widgetType' => 'rhea-ultra-single-property-agent' ],
			'fields'            => [
				[
					'field'       => 'agent_text',
					'type'        => esc_html__( 'Single Property Agent: Agent Label', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'agent_know_more',
					'type'        => esc_html__( 'Single Property Agent: Know More Link', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'agent_office_contact_label',
					'type'        => esc_html__( 'Single Property Agent: Office Contact', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'agent_office_contact_mobile',
					'type'        => esc_html__( 'Single Property Agent: Mobile Contact', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'agent_office_contact_fax',
					'type'        => esc_html__( 'Single Property Agent: Fax Contact', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'agent_office_contact_whatsapp',
					'type'        => esc_html__( 'Single Property Agent: WhatsApp Contact', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'agent_office_contact_email',
					'type'        => esc_html__( 'Single Property Agent: Email Contact', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'agent_name_placeholder',
					'type'        => esc_html__( 'Single Property Agent: Name Field Placeholder', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'agent_email_placeholder',
					'type'        => esc_html__( 'Single Property Agent: Email Field Placeholder', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'agent_phone_placeholder',
					'type'        => esc_html__( 'Single Property Agent: Phone Field Placeholder', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'agent_textarea_placeholder',
					'type'        => esc_html__( 'Single Property Agent: Textarea Field Placeholder', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'agent_submit_button_text',
					'type'        => esc_html__( 'Single Property Agent: Submit Button Placeholder', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
			],
		];

		return $widgets;
	}
}

new RHEA_Single_Property_Agent_Contact_Form_WPML_Translate();