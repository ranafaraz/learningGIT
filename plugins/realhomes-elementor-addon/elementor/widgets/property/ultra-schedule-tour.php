<?php
/**
 * Schedule A Tour Elementor widget for single property
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Schedule_Tour extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rhea-ultra-single-property-schedule-tour';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Schedule A Tour', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-calendar';
	}

	public function get_categories() {
		return [ 'ultra-realhomes-single-property' ];
	}

	public function get_script_depends() {

		wp_register_script(
			'schedule-single-elementor-section',
			RHEA_PLUGIN_URL . 'elementor/js/schedule-single-widget.js',
			[],
			RHEA_VERSION,
			true
		);

		return [ 'jquery-ui-datepicker', 'schedule-single-elementor-section' ];
	}

	public function get_style_depends() {

        wp_register_style(
			'jquery-ui-datepicker',
			'//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css',
			array(),
			RHEA_VERSION,
			'all'
		);

		return [ 'jquery-ui-datepicker' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'basic_settings_section',
			[
				'label' => esc_html__( 'Basic Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'section_title',
			[
				'label'   => esc_html__( 'Section Title', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Schedule A Tour', 'realhomes-elementor-addon' ),
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
			'show_thumbnail_side',
			[
				'label'        => esc_html__( 'Show Thumbnails Side', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_responsive_control(
			'content-margin-bottom',
			[
				'label'     => esc_html__( 'Content Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_property__sat_wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'basic_labels_section',
			[
				'label' => esc_html__( 'Labels', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'sta_date_label',
			[
				'label'   => esc_html__( 'Select Date Placeholder', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Select Date', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'sta_in_person_label',
			[
				'label'   => esc_html__( 'In Person Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'In Person', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'sta_video_chat_label',
			[
				'label'   => esc_html__( 'Video Chat Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Video Chat', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'sta_name_label',
			[
				'label'   => esc_html__( 'Name Placeholder', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Your Name', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'sta_phone_label',
			[
				'label'   => esc_html__( 'Phone Placeholder', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Your Phone', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'sta_email_label',
			[
				'label'   => esc_html__( 'Email Placeholder', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Your Email', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'sta_message_label',
			[
				'label'   => esc_html__( 'Message Placeholder', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Message', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'sta_schedule_label',
			[
				'label'   => esc_html__( 'Submit Button Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Schedule', 'realhomes-elementor-addon' ),
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'basic_styles_section',
			[
				'label' => esc_html__( 'Basic', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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
			'thumb-border-radius',
			[
				'label'      => esc_html__( 'Thumbnails Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .sat_property-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'colors_section',
			[
				'label' => esc_html__( 'Form Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'form_bg_color',
			[
				'label'     => esc_html__( 'Form Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'form_in_person_button_bg',
			[
				'label'     => esc_html__( 'Form Buttons Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_sat_field.tour-type .middle-fields .tour-field label' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'form_in_person_button_checked_bg',
			[
				'label'     => esc_html__( 'Form Buttons Background Active', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_sat_field.tour-type .middle-fields .tour-field input:checked + label' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'form_in_person_button_text',
			[
				'label'     => esc_html__( 'Form Buttons Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_sat_field.tour-type .middle-fields .tour-field label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'form_in_person_button_checked_text',
			[
				'label'     => esc_html__( 'Form Buttons Text Active', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_sat_field.tour-type .middle-fields .tour-field input:checked + label' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .rh-ultra-form-field-wrapper .rh-ultra-dark'        => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-form-field-wrapper .rh-ultra-stroke-dark' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-icons-light-color',
			[
				'label'     => esc_html__( 'Fields Icon Light', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper .feather-calendar'     => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-form-field-wrapper .rh-ultra-stroke-dark' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agent-contact-form-icons-active-color',
			[
				'label'       => esc_html__( 'Fields Icon Active', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::COLOR,
				'description' => esc_html__( 'Only for Date and Time Fields Icons', 'realhomes-elementor-addon' ),
				'selectors'   => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper:focus-within .rh-ultra-dark'        => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-form-field-wrapper:focus-within .rh-ultra-stroke-dark' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-dropdown-color',
			[
				'label'     => esc_html__( 'Dropdown Option', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bootstrap-select.rh-ultra-select-dropdown .dropdown-menu li a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-dropdown-active-color',
			[
				'label'     => esc_html__( 'Dropdown Active Option', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bootstrap-select.rh-ultra-select-dropdown .dropdown-menu li.selected .text'           => 'color: {{VALUE}}',
					'{{WRAPPER}} .bootstrap-select.rh-ultra-select-dropdown .dropdown-menu li.selected span.check-mark' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-dropdown-hover-color',
			[
				'label'     => esc_html__( 'Dropdown Hover Option', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bootstrap-select.rh-ultra-select-dropdown .dropdown-menu li:hover' => 'background: {{VALUE}}',
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
					'{{WRAPPER}} .rh_widget_form__submit' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-hover-color',
			[
				'label'     => esc_html__( 'Submit Button Text Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_widget_form__submit:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-bg-color',
			[
				'label'     => esc_html__( 'Submit Button Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_widget_form__submit' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-bg-hover-color',
			[
				'label'     => esc_html__( 'Submit Button Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_widget_form__submit:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-border-color',
			[
				'label'     => esc_html__( 'Submit Button Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_widget_form__submit' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-border-hover-color',
			[
				'label'     => esc_html__( 'Submit Button Border Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_widget_form__submit:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'calendar_colors_section',
			[
				'label' => esc_html__( 'Calendar Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'date-calendar-background-color',
			[
				'label'     => esc_html__( 'Calendar background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.single-property .schedule-section-wrapper'         => 'background-color: {{VALUE}}',
					'.elementor-editor-active .schedule-section-wrapper' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'date-calendar-heading-background-color',
			[
				'label'     => esc_html__( 'Calendar heading background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.single-property #ui-datepicker-div.schedule-section-wrapper .ui-widget-header'         => 'background-color: {{VALUE}}',
					'.elementor-editor-active #ui-datepicker-div.schedule-section-wrapper .ui-widget-header' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'date-calendar-heading-border-color',
			[
				'label'     => esc_html__( 'Calendar heading border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.single-property #ui-datepicker-div.schedule-section-wrapper .ui-widget-header'         => 'border-color: {{VALUE}}',
					'.elementor-editor-active #ui-datepicker-div.schedule-section-wrapper .ui-widget-header' => 'border-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'date-calendar-heading-text-color',
			[
				'label'     => esc_html__( 'Calendar heading color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.single-property .schedule-section-wrapper .ui-datepicker-title'         => 'color: {{VALUE}}',
					'.elementor-editor-active .schedule-section-wrapper .ui-datepicker-title' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'date-calendar-disabled-background-color',
			[
				'label'     => esc_html__( 'Calendar disabled dates background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.single-property #ui-datepicker-div.schedule-section-wrapper .ui-datepicker-calendar td.ui-state-disabled span'         => 'background: {{VALUE}}; border-color: {{VALUE}};',
					'.elementor-editor-active #ui-datepicker-div.schedule-section-wrapper .ui-datepicker-calendar td.ui-state-disabled span' => 'background: {{VALUE}}; border-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'date-calendar-disabled-text-color',
			[
				'label'     => esc_html__( 'Calendar disabled dates text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.single-property #ui-datepicker-div.schedule-section-wrapper .ui-datepicker-calendar td.ui-state-disabled span'         => 'color: {{VALUE}};',
					'.elementor-editor-active #ui-datepicker-div.schedule-section-wrapper .ui-datepicker-calendar td.ui-state-disabled span' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'date-calendar-normal-background-color',
			[
				'label'     => esc_html__( 'Calendar normal dates background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.single-property #ui-datepicker-div.schedule-section-wrapper td a'         => 'background: {{VALUE}}; border-color: {{VALUE}};',
					'.elementor-editor-active #ui-datepicker-div.schedule-section-wrapper td a' => 'background: {{VALUE}}; border-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'date-calendar-normal-text-color',
			[
				'label'     => esc_html__( 'Calendar normal dates text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.single-property #ui-datepicker-div.schedule-section-wrapper td a'         => 'color: {{VALUE}}',
					'.elementor-editor-active #ui-datepicker-div.schedule-section-wrapper td a' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'date-calendar-today-background-color',
			[
				'label'     => esc_html__( 'Calendar today background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.single-property #ui-datepicker-div.schedule-section-wrapper td.ui-datepicker-today a'         => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
					'.elementor-editor-active #ui-datepicker-div.schedule-section-wrapper td.ui-datepicker-today a' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'date-calendar-today-text-color',
			[
				'label'     => esc_html__( 'Calendar today text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.single-property #ui-datepicker-div.schedule-section-wrapper td.ui-datepicker-today a'         => 'color: {{VALUE}}',
					'.elementor-editor-active #ui-datepicker-div.schedule-section-wrapper td.ui-datepicker-today a' => 'color: {{VALUE}}',
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$post_id  = get_the_ID();

		// Sample Post id for Elementor editor only
		if ( rhea_is_preview_mode() ) {
			$post_id = rhea_get_sample_property_id();
		}

		$section_title = get_option( 'realhomes_schedule_a_tour_title' );
		if ( empty( $section_title ) ) {
			$section_title = esc_html__( 'Schedule A Tour', 'realhomes-elementor-addon' );
		}

		// getting schedule times for property
		$tour_times = get_post_meta( $post_id, 'ere_property_schedule_time_slots', true );
		if ( empty( $tour_times ) ) {
			// getting global schedule tour times in case the property specific are not set
			$tour_times = get_option( 'realhomes_schedule_time_slots' );
		}

		$tour_times_array     = explode( ',', $tour_times );
		$current_tours        = get_post_meta( $post_id, 'ere_current_approved_tours', true );
		$date_placeholder     = $settings['sta_date_label'];
		$in_person_label      = $settings['sta_in_person_label'];
		$video_chat_label     = $settings['sta_video_chat_label'];
		$name_placeholder     = $settings['sta_name_label'];
		$phone_placeholder    = $settings['sta_phone_label'];
		$email_placeholder    = $settings['sta_email_label'];
		$message_placeholder  = $settings['sta_message_label'];
		$schedule_button_text = $settings['sta_schedule_label'];
		$schedule_description = get_post_meta( $post_id, 'ere_property_schedule_description', true );
        if ( empty( $schedule_description ) ) {
            $schedule_description = get_option( 'realhomes_schedule_side_description' );
        }
		?>
        <div id="property-content-section-schedule-a-tour" class="property-content-section rh_property__sat_wrap margin-bottom-40px" data-widget-id="<?php echo esc_attr( $this->get_id() ); ?>">
            <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4>
            <div class="rh_property__sat rh-ultra-form">
                <div class="sat_left_side">
                    <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="schedule-a-tour">
                        <div class="schedule-fields rh-ultra-fields-split">
                            <p class="rh_form__item rh-ultra-form-field-wrapper">
                                <label for="sat-single-date">
									<?php inspiry_safe_include_svg( '/ultra/icons/calendar.svg', '/assets/' ); ?>
                                </label>
                                <input type="text" name="sat-date" id="sat-single-date" class="required rh-ultra-field" placeholder="<?php echo esc_attr( $date_placeholder ); ?>" title="<?php esc_attr_e( 'Select a suitable date.', 'realhomes-elementor-addon' ); ?>" autocomplete="off" required>
                            </p>

							<?php
							if ( is_array( $tour_times_array ) && ! empty( $tour_times_array[0] ) ) {
								?>
                                <p class="rh_form__item rh-sat-select-field rh-ultra-form-field-wrapper">
									<?php inspiry_safe_include_svg( '/ultra/icons/time.svg', '/assets/' ); ?>
                                    <select name="sat-time" class="sat_times rh-ultra-select-dropdown inspiry_select_picker_trigger show-tick">
										<?php
										foreach ( $tour_times_array as $tour_time ) {
											echo '<option value="' . esc_attr( $tour_time ) . '">' . esc_html( $tour_time ) . '</option>' . PHP_EOL;
										}
										?>
                                    </select>
                                </p>
								<?php
							}
							?>
                        </div>

                        <div class="rh_sat_field tour-type">
                            <div class="middle-fields">
                                <p class="tour-field in-person">
                                    <input type="radio" id="sat-in-person" name="sat-tour-type" value="<?php echo esc_attr( $in_person_label ); ?>" checked>
                                    <label for="sat-in-person"><?php echo esc_attr( $in_person_label ); ?></label>
                                </p>
                                <p class="tour-field video-chat">
                                    <input type="radio" id="sat-video-chat" name="sat-tour-type" value="<?php echo esc_attr( $video_chat_label ); ?>">
                                    <label for="sat-video-chat"><?php echo esc_attr( $video_chat_label ); ?></label>
                                </p>
                            </div>
                        </div>

                        <div class="user-info rh-ultra-fields-split">
                            <p class="rh_form__item rh-ultra-form-field-wrapper">
                                <label for="sat-user-name">
									<?php inspiry_safe_include_svg( '/ultra/icons/user.svg', '/assets/' ); ?>
                                </label>
                                <input id="sat-user-name" type="text" name="sat-user-name" class="required rh-ultra-field" placeholder="<?php echo esc_attr( $name_placeholder ); ?>" title="<?php esc_attr_e( 'Provide your name', 'realhomes-elementor-addon' ); ?>" required>
                            </p>
                            <p class="rh_form__item rh-ultra-form-field-wrapper">
                                <label for="sat-user-phone">
									<?php inspiry_safe_include_svg( '/ultra/icons/phone.svg', '/assets/' ); ?>
                                </label>
                                <input id="sat-user-phone" type="text" name="sat-user-phone" class="rh-ultra-field" placeholder="<?php echo esc_attr( $phone_placeholder ); ?>">
                            </p>
                        </div>

                        <div class="user-info-full">
                            <p class="rh_form__item rh-ultra-form-field-wrapper">
                                <label for="sat-user-email">
									<?php inspiry_safe_include_svg( '/ultra/icons/email.svg', '/assets/' ); ?>
                                </label>
                                <input id="sat-user-email" type="text" name="sat-user-email" class="required rh-ultra-field" placeholder="<?php echo esc_attr( $email_placeholder ); ?>" title="<?php esc_attr_e( 'Provide your email ID', 'realhomes-elementor-addon' ); ?>" required>
                            </p>
                            <p class="rh_form__item rh-ultra-form-field-wrapper rh-ultra-form-textarea">
                                <label for="sat-user-message">
									<?php inspiry_safe_include_svg( '/ultra/icons/message.svg', '/assets/' ); ?>
                                </label>
                                <textarea id="sat-user-message" class="rh-ultra-field" cols="40" rows="6" name="sat-user-message" placeholder="<?php echo esc_attr( $message_placeholder ); ?>"></textarea>
                            </p>
                        </div>

						<?php
						if ( class_exists( 'Easy_Real_Estate' ) ) {
							/* Display reCAPTCHA if enabled and configured from customizer settings */
							if ( ere_is_reCAPTCHA_configured() ) {
								$recaptcha_type = get_option( 'inspiry_reCAPTCHA_type', 'v2' );
								?>
                                <div class="rh_contact__input rh_contact__input_recaptcha inspiry-recaptcha-wrapper clearfix g-recaptcha-type-<?php echo esc_attr( $recaptcha_type ); ?>">
                                    <div class="inspiry-google-recaptcha"></div>
                                </div>
								<?php
							}
						}
						?>
                        <div class="submit-wrap">
                            <input type="hidden" name="action" value="schedule_a_tour" />
                            <input type="hidden" name="property-id" value="<?php echo esc_attr( $post_id ); ?>" />
                            <input type="hidden" name="sat-nonce" value="<?php echo esc_attr( wp_create_nonce( 'schedule_a_tour_nonce' ) ); ?>" />
                            <input type="submit" id="schedule-submit" class="submit-button rh-btn rh-btn-primary rh_widget_form__submit" value="<?php echo esc_attr( $schedule_button_text ); ?>" />
                            <span id="sat-loader" class="ajax-loader"><?php inspiry_safe_include_svg( '/icons/ball-triangle.svg' ); ?></span>
                        </div>
                        <div id="error-container" class="error-container"></div>
                        <div id="message-container" class="message-container"></div>
                    </form>
                </div><!-- End of the left side -->

				<?php
				if ( '' !== $settings['show_thumbnail_side'] ) {
					?>
                    <div class="sat_right_side property-info">
                        <div class="sat_property-thumbnail">
							<?php
							if ( has_post_thumbnail( $post_id ) ) {
								echo get_the_post_thumbnail( $post_id, 'property-detail-video-image' );
							}
							?>
                        </div>
                        <div class="additional-info">
							<?php echo wp_kses_post( $schedule_description ); ?>
                        </div>
                    </div><!-- End of the right side -->
					<?php
				}
				?>
            </div><!-- End of .rh_property__sat -->
        </div>
		<?php

	}
}