<?php
/**
 * Schedule A Tour Elementor widget for single property WPML Support
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Single_Property_STA_Form_WPML_Translate {

	public function __construct() {
		add_filter( 'wpml_elementor_widgets_to_translate', [
			$this,
			'inspiry_single_sta_form_to_translate'
		] );
	}

	public function inspiry_single_sta_form_to_translate( $widgets ) {

		$widgets['rhea-ultra-single-property-schedule-tour'] = [
			'conditions'        => [ 'widgetType' => 'rhea-ultra-single-property-schedule-tour' ],
			'fields'            => [
				[
					'field'       => 'sta_date_label',
					'type'        => esc_html__( 'Schedule A Tour: Select Date Placeholder', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'sta_in_person_label',
					'type'        => esc_html__( 'Schedule A Tour: In Person Label', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'sta_video_chat_label',
					'type'        => esc_html__( 'Schedule A Tour: Video Chat Label', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'sta_name_label',
					'type'        => esc_html__( 'Schedule A Tour: Name Placeholder', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'sta_phone_label',
					'type'        => esc_html__( 'Schedule A Tour: Phone Placeholder', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'sta_email_label',
					'type'        => esc_html__( 'Schedule A Tour: Email Placeholder', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'sta_message_label',
					'type'        => esc_html__( 'Schedule A Tour: Message Placeholder', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'sta_schedule_label',
					'type'        => esc_html__( 'Schedule A Tour: Submit Button Text', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],

			],
		];

		return $widgets;
	}
}

new RHEA_Single_Property_STA_Form_WPML_Translate();