<?php
/**
 * Property Agent Contact Form Elementor widget for single property
 *
 * @since 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Agent_Form extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-property-agent';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Agent Contact Form', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'ultra-realhomes-single-property' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'section_title',
			[
				'label'   => esc_html__( 'Section Title', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Agent', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'section_title_color',
			[
				'label'     => esc_html__( 'Section Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'section_title_typography',
				'label'    => esc_html__( 'Section Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__heading',
			]
		);
		$this->add_control(
			'show_contact_card',
			[
				'label'        => esc_html__( 'Show Contact Card', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'agents_labels',
			[
				'label' => esc_html__( 'Labels', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'agent_text',
			[
				'label'   => esc_html__( 'Agent Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Agent', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'agent_know_more',
			[
				'label'   => esc_html__( 'Know More Link', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Know More', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'agent_office_contact_label',
			[
				'label'   => esc_html__( 'Office Contact', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Office:', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'agent_office_contact_mobile',
			[
				'label'   => esc_html__( 'Mobile Contact', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Mobile:', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'agent_office_contact_fax',
			[
				'label'   => esc_html__( 'Fax Contact', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Fax:', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'agent_office_contact_whatsapp',
			[
				'label'   => esc_html__( 'WhatsApp Contact', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'WhatsApp:', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'agent_office_contact_email',
			[
				'label'   => esc_html__( 'Email Contact', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Email:', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'agent_name_placeholder',
			[
				'label'   => esc_html__( 'Name Field Placeholder', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Name', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'agent_email_placeholder',
			[
				'label'   => esc_html__( 'Email Field Placeholder', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Email', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'agent_phone_placeholder',
			[
				'label'   => esc_html__( 'Phone Field Placeholder', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Phone', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'agent_textarea_placeholder',
			[
				'label'   => esc_html__( 'Textarea Field Placeholder', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Message', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'agent_submit_button_text',
			[
				'label'   => esc_html__( 'Submit Button Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Send Message', 'realhomes-elementor-addon' ),
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'ere_agent_typo_section',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_typography',
				'label'    => esc_html__( 'Agent Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-agent-label',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_title_typography',
				'label'    => esc_html__( 'Agent Title', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property_agent__title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_know_more_typography',
				'label'    => esc_html__( 'Know More', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-property-agent-link',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_contact_label_typography',
				'label'    => esc_html__( 'Contact Labels', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-property-agent-info-sidebar .contact span',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_contact_item_typography',
				'label'    => esc_html__( 'Contact', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-property-agent-info-sidebar .contact a',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_contact_fields_typography',
				'label'    => esc_html__( 'Fields', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-ultra-field',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_contact_submit_typography',
				'label'    => esc_html__( 'Submit Button', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-ultra-property-detail-agent .rh-ultra-button',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'basic_settings',
			[
				'label' => esc_html__( 'Basic Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content-margin-bottom',
			[
				'label'     => esc_html__( 'Form Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-detail-agent' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'know-more-margin-bottom',
			[
				'label'     => esc_html__( 'Know More Margin Top', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-property-agent-link' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'contact-list-margin-bottom',
			[
				'label'     => esc_html__( 'Contact List Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-property-agent-info-sidebar .contact' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'forms-fields-margin-bottom',
			[
				'label'     => esc_html__( 'Form Fields Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form-padding',
			[
				'label'      => esc_html__( 'Contact Form Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'form-border-radius',
			[
				'label'      => esc_html__( 'Contact Form Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'fields-padding',
			[
				'label'      => esc_html__( 'Fields Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'fields-border-radius',
			[
				'label'      => esc_html__( 'Fields Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'submit-border-radius',
			[
				'label'      => esc_html__( 'Submit Button Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-form button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'colors_section',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'agent-label-color',
			[
				'label'     => esc_html__( 'Agent Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-agent-label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-title-color',
			[
				'label'     => esc_html__( 'Agent Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property_agent__title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-title-hover-color',
			[
				'label'     => esc_html__( 'Agent Title Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property_agent__title a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-know-more-color',
			[
				'label'     => esc_html__( 'Know More Link', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-property-agent-link' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-know-more-hover-color',
			[
				'label'     => esc_html__( 'Know More Link Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-property-agent-link:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-label-color',
			[
				'label'     => esc_html__( 'Contact List Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-property-agent-info-sidebar .contact span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-list-color',
			[
				'label'     => esc_html__( 'Contact List', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-property-agent-info-sidebar .contact a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-list-hover-color',
			[
				'label'     => esc_html__( 'Contact List Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-property-agent-info-sidebar .contact a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-list-icon-color',
			[
				'label'     => esc_html__( 'Contact List Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-property-agent-info-sidebar .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-bg-color',
			[
				'label'     => esc_html__( 'Form Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-fields-color',
			[
				'label'     => esc_html__( 'Fields Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-field' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-placeholder-color',
			[
				'label'     => esc_html__( 'Fields Placeholder', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form ::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-form :-ms-input-placeholder'      => 'color: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-form ::placeholder'               => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-border-color',
			[
				'label'     => esc_html__( 'Fields Bottom Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-field' => 'border-bottom-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-border-active-color',
			[
				'label'     => esc_html__( 'Fields Bottom Border Active', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-field:focus' => 'border-bottom-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-icons-color',
			[
				'label'     => esc_html__( 'Fields Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper svg' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-icons-active-color',
			[
				'label'     => esc_html__( 'Fields Icon Active', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper:focus-within svg' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow-fields',
				'label'    => esc_html__( 'Fields Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rh-ultra-form-field-wrapper',
			]
		);
		$this->add_control(
			'agent-contact-error-color',
			[
				'label'     => esc_html__( 'Error Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form .error-container label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-color',
			[
				'label'     => esc_html__( 'Submit Button Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-filled-button' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-hover-color',
			[
				'label'     => esc_html__( 'Submit Button Text Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-filled-button:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-bg-color',
			[
				'label'     => esc_html__( 'Submit Button Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-filled-button' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-bg-hover-color',
			[
				'label'     => esc_html__( 'Submit Button Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-filled-button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-border-color',
			[
				'label'     => esc_html__( 'Submit Button Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-filled-button' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-border-hover-color',
			[
				'label'     => esc_html__( 'Submit Button Border Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-filled-button:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		global $rhea_post_id;
		global $settings;

		$settings     = $this->get_settings_for_display();
		$rhea_post_id = get_the_ID();

		// Sample Post id for Elementor editor only
		if ( rhea_is_preview_mode() ) {
			$rhea_post_id = rhea_get_sample_property_id();
		}
		?><?php rhea_get_template_part( 'assets/partials/ultra/single/property/agent' ); ?>

		<?php

	}
}