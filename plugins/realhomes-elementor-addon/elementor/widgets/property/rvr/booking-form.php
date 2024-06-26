<?php
/**
 * Property RVR Booking Form
 *
 * @since 2.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Booking_Form extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-pdp-booking-form';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Booking Form', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
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
			'status-dependent-widget-display',
			[
				'label'        => esc_html__( 'Status specific display', 'realhomes-elementor-addon' ),
				'description'  => esc_html__( 'Show the widget on properties with specific status only.', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$property_statuses = get_terms( array( 'taxonomy' => 'property-status' ) );

		if ( ! is_wp_error( $property_statuses ) ) {

			$allowed_statuses = array();

			// Managing statuses in an array
			foreach ( $property_statuses as $status ) {
				$allowed_statuses[ $status->term_id ] = $status->name;
			}

			$this->add_control(
				'allowed-statuses',
				[
					'label'       => esc_html__( 'Choose Property Status', 'realhomes-elementor-addon' ),
					'type'        => \Elementor\Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple'    => true,
					'options'     => $allowed_statuses,
					'condition'   => [
						'status-dependent-widget-display' => 'yes'
					]
				]
			);
		}

		$this->add_control(
			'name-field-label',
			[
				'label'   => esc_html__( 'Name Field Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Name', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'name-field-placeholder',
			[
				'label'   => esc_html__( 'Name Field Placeholder ', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter your name', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'email-field-label',
			[
				'label'   => esc_html__( 'Email Field Label ', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter your email', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'email-field-placeholder',
			[
				'label'   => esc_html__( 'Email Field Placeholder ', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter your email', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'phone-field-label',
			[
				'label'   => esc_html__( 'Phone Field Label ', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter your phone', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'phone-field-placeholder',
			[
				'label'   => esc_html__( 'Phone Field Placeholder ', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter your phone', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'check-in-field-label',
			[
				'label'   => esc_html__( 'Check In Field Label ', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Check In', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'check-in-field-placeholder',
			[
				'label'   => esc_html__( 'Check In Field Placeholder ', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'yyyy-mm-dd', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'check-out-field-label',
			[
				'label'   => esc_html__( 'Check Out Field Label ', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Check In', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'check-out-field-placeholder',
			[
				'label'   => esc_html__( 'Check Out Field Placeholder ', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'yyyy-mm-dd', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'adults-field-label',
			[
				'label'   => esc_html__( 'Adults Field Label ', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Adults', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'children-field-label',
			[
				'label'   => esc_html__( 'Children Field Label ', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Children', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'infants-field-label',
			[
				'label'   => esc_html__( 'Infants Field Label ', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Infants', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'staying-nights-text',
			[
				'label'   => esc_html__( 'Staying Nights Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Staying Nights', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'price-for-staying-nights-text',
			[
				'label'   => esc_html__( 'Staying Nights text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Price For Staying Nights', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'services-charges-text',
			[
				'label'   => esc_html__( 'Services Charges Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Services Charges', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'sub-total-text',
			[
				'label'   => esc_html__( 'Sub Total Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Subtotal', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'govt-taxes-text',
			[
				'label'   => esc_html__( 'Government Taxes Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Government Taxes', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'total-price-text',
			[
				'label'   => esc_html__( 'Total Price Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Total Price', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'payable-text',
			[
				'label'   => esc_html__( 'Payable Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Payable', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'show-detail-label',
			[
				'label'   => esc_html__( 'Show Detail Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Show Details', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'hide-detail-label',
			[
				'label'   => esc_html__( 'Hide Detail Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Hide Details', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'or-text',
			[
				'label'   => esc_html__( 'Or Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'OR', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'call-now-text',
			[
				'label'   => esc_html__( 'Call Now Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Call Now', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'book-now-button-text',
			[
				'label'   => esc_html__( 'Book Now Button Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Book Now', 'realhomes-elementor-addon' ),
			]
		);

		$this->end_controls_section();


		// Typography controls
		$this->start_controls_section(
			'typography_controls',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'form_labels_typography',
				'label'    => esc_html__( 'Form Labels', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar label'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'field_placeholder_typography',
				'label'    => esc_html__( 'Field Placeholders', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '
				{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar input::placeholder,
				{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar select::placeholder,
				{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar textarea::placeholder
				',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'field_text_typography',
				'label'    => esc_html__( 'Field Text', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '
				{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar input,
				{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar textarea,
				{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar select
				',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'additional_amenities_label',
				'label'    => esc_html__( 'Amenities Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .rvr-additional-amenities .amenity-desc span',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'additional_amenities_price',
				'label'    => esc_html__( 'Amenities Price', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .rvr-additional-amenities .amenity-price',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'additional_amenities_price_unit',
				'label'    => esc_html__( 'Amenities Price Calculation', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .rvr-additional-amenities .amenity-price span',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'detail_heading_typography',
				'label'    => esc_html__( 'Booking Detail Headings', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .booking-cost .cost-field strong'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'detail_text_typography',
				'label'    => esc_html__( 'Booking Detail Text', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .booking-cost .cost-field'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'button_text_typography',
				'label'    => esc_html__( 'Button Text', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .submission-area input[type=submit]'
			]
		);

		$this->end_controls_section();


		// Color Controls
		$this->start_controls_section(
			'colors_section',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_background_color',
			[
				'label'     => esc_html__( 'Section Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'form_background_color',
			[
				'label'     => esc_html__( 'Form Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'field_label_color',
			[
				'label'     => esc_html__( 'Label Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar label' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'field_placeholder_color',
			[
				'label'     => esc_html__( 'Placeholder Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar input::placeholder'    => 'color: {{VALUE}}',
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar select::placeholder'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar textarea::placeholder' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'field_text_color',
			[
				'label'     => esc_html__( 'Field Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar input'    => 'color: {{VALUE}}',
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar textarea' => 'color: {{VALUE}}',
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar select'   => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'field_background_color',
			[
				'label'     => esc_html__( 'Field Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar input'    => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar textarea' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar select'   => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .inspiry_select_picker_trigger > .dropdown-toggle'                                 => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'additional_amenities_checkbox_border',
			[
				'label'     => esc_html__( 'Amenities Checkbox Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .rvr-additional-amenities .amenity-field .amenity-desc label input' => 'border-color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'additional_amenities_label',
			[
				'label'     => esc_html__( 'Amenities Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .rvr-additional-amenities .amenity-field .amenity-desc label span' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'additional_amenities_price',
			[
				'label'     => esc_html__( 'Amenities Price', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .rvr-additional-amenities .amenity-field .amenity-price' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'additional_amenities_price_unit',
			[
				'label'     => esc_html__( 'Amenities Price Calculation', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .rvr-additional-amenities .amenity-field .amenity-price span' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'additional_amenities_price_unit_bg',
			[
				'label'     => esc_html__( 'Amenities Price Calculation Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .rvr-additional-amenities .amenity-field .amenity-price span' => 'background-color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'additional_amenities_border',
			[
				'label'     => esc_html__( 'Amenities Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .rvr-additional-amenities .amenity-field' => 'border-color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'detail_heading_typography',
			[
				'label'     => esc_html__( 'Detail Heading', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .booking-cost .cost-field strong' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'show_detail_link_color',
			[
				'label'     => esc_html__( 'Show Detail Link', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .booking-cost .cost-field .rvr-show-details' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'show_detail_link_hover_color',
			[
				'label'     => esc_html__( 'Show Detail Link Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .booking-cost .cost-field .rvr-show-details:hover' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'detail_text_color',
			[
				'label'     => esc_html__( 'Detail Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .booking-cost .cost-field' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'detail_percentage_background',
			[
				'label'     => esc_html__( 'Percentage Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .booking-cost .cost-field>div.cost-desc span' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'detail_percentage_text',
			[
				'label'     => esc_html__( 'Percentage Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .booking-cost .cost-field>div.cost-desc span' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'     => esc_html__( 'Button Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .submission-area input[type=submit]' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label'     => esc_html__( 'Button Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .submission-area input[type=submit]' => 'border-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__( 'Button Border Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .submission-area input[type=submit]:hover' => 'border-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__( 'Button Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .submission-area input[type=submit]' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => esc_html__( 'Button Hover Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .submission-area input[type=submit]:hover' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'button_text_hover_color',
			[
				'label'     => esc_html__( 'Button Hover Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .submission-area input[type=submit]:hover' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'bottom_section_background_color',
			[
				'label'     => esc_html__( 'Bottom Section Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr_request_cta_booking' => 'background-color: {{VALUE}}',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'bottom_section_inner_background_color',
			[
				'label'     => esc_html__( 'Bottom Inner Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr_request_cta_number_wrapper' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'cta_icon_color',
			[
				'label'     => esc_html__( 'CTA Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr_request_cta_number_wrapper .rvr_phone_icon svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .RVR_Booking_Widget .rvr_request_cta_number_wrapper .rvr_phone_icon svg .a' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .RVR_Booking_Widget .rvr_request_cta_number_wrapper .rvr_phone_icon i' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'cta_label_color',
			[
				'label'     => esc_html__( 'CTA Label Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr_request_cta_number_wrapper .rvr-phone-number strong' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'cta_number_color',
			[
				'label'     => esc_html__( 'CTA Number Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr_request_cta_number_wrapper .rvr-phone-number a' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'cta_number_hover_color',
			[
				'label'     => esc_html__( 'CTA Number Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr_request_cta_number_wrapper .rvr-phone-number a:hover' => 'color: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();

		// Spacing & Sizes
		$this->start_controls_section(
			'spacing_section',
			[
				'label' => esc_html__( 'Borders & Spacings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'section_padding',
			[
				'label'      => esc_html__( 'Section Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'top_section_border_radius',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Top Section Border Radius', 'realhomes-elementor-addon' ),
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'top_inner_border_radius',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Top Inner Border Radius', 'realhomes-elementor-addon' ),
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'form_padding',
			[
				'label'      => esc_html__( 'Form Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_label_margin',
			[
				'label'      => esc_html__( 'Label Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_field_padding',
			[
				'label'      => esc_html__( 'Field Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar input'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar select'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_field_margin',
			[
				'label'      => esc_html__( 'Field Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar input'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar select'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_fields_border_radius',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Fields Border Radius', 'realhomes-elementor-addon' ),
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar input'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .option-bar select'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'amenities_padding',
			[
				'label'      => esc_html__( 'Amenities Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .rvr-additional-amenities .amenity-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'amenities_margin',
			[
				'label'      => esc_html__( 'Amenities Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .rvr-additional-amenities .amenity-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'amenities_checkbox_margin',
			[
				'label'      => esc_html__( 'Amenities Checkbox Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .rvr-additional-amenities .amenity-field input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'amenities_price_unit_margin',
			[
				'label'      => esc_html__( 'Amenities Price Calculation Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .rvr-additional-amenities .amenity-price span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'detail_item_margin',
			[
				'label'      => esc_html__( 'Detail Item Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'.RVR_Booking_Widget .rvr-booking-form-wrap .booking-cost .cost-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => esc_html__( 'Button Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .submission-area input[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'submit_button_border',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Submit Button Border', 'realhomes-elementor-addon' ),
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .submission-area input[type=submit]' => 'border-top-width: {{TOP}}{{UNIT}}; border-right-width: {{RIGHT}}{{UNIT}}; border-bottom-width: {{BOTTOM}}{{UNIT}}; border-left-width: {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'submit_button_border_radius',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Submit Button Border Radius', 'realhomes-elementor-addon' ),
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr-booking-form-wrap .rvr-booking-form .submission-area input[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->add_responsive_control(
			'or_separator_border_radius',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'OR Separator Border Radius', 'realhomes-elementor-addon' ),
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr_cta_or' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'bottom_section_border_radius',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Bottom Section Border Radius', 'realhomes-elementor-addon' ),
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr_request_cta_booking' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'bottom_inner_border_radius',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Bottom Inner Border Radius', 'realhomes-elementor-addon' ),
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .RVR_Booking_Widget .rvr_request_cta_number_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings          = $this->get_settings_for_display();
		$post_id           = get_the_ID();
		$widget_id         = $this->get_id();
		$staying_nights    = $settings['staying-nights-text'];
		$price_for_staying = $settings['price-for-staying-nights-text'];
		$services_charges  = $settings['services-charges-text'];
		$subtotal          = $settings['sub-total-text'];
		$government_taxes  = $settings['govt-taxes-text'];
		$total_price       = $settings['total-price-text'];
		$payable           = $settings['payable-text'];
		$show_details      = $settings['show-detail-label'];
		$hide_details      = $settings['hide-detail-label'];
		$rvr_or            = $settings['or-text'];
		$rvr_call_now      = $settings['call-now-text'];
		$book_now_button   = $settings['book-now-button-text'];

		// Sample Post id for Elementor editor only
		if ( rhea_is_preview_mode() ) {
			$post_id = rhea_get_sample_property_id();
		}

		// Getting RVR related settings
		$rvr_settings = get_option( 'rvr_settings' );

		// Making sure that widget is allowed to be displayed for current post
		$booking_widget_display = get_post_meta( $post_id, 'rvr_booking_widget_display', true );
		if ( 'hide' === $booking_widget_display ) {
			return;
		}

		// Default in case the dependency is not required
		$display_by_status = true;

		// Checking status dependency
		if ( 'yes' === $settings['status-dependent-widget-display'] ) {
			// In case status dependency is enabled, it will be false by default
			$display_by_status = false;

			// Getting allowed statuses by widget settings
			$allowed_statuses = $settings['allowed-statuses'];

			// Getting statuses of the current property
			$current_statuses = get_the_terms( $post_id, 'property-status' );

			if ( $current_statuses && ! is_wp_error( $current_statuses ) ) {
				foreach ( $current_statuses as $current_status ) {
					if ( in_array( $current_status->term_id, $allowed_statuses ) ) {
						$display_by_status = true;
						break;
					}
				}
			}

			if ( ! $display_by_status ) {
				return;
			}
		}

		$contact_page_id  = $rvr_settings['rvr_contact_page'];
		$contact_page_url = get_the_permalink( $contact_page_id );
		$phone_number     = $rvr_settings['rvr_contact_phone'];
		?>
        <div class="RVR_Booking_Widget">
            <div class="rvr-booking-form-wrap">

                <form class="rvr-booking-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">

                    <div class="option-bar large rvr_no_top_border">
                        <label for="rvr-user-name-<?php echo esc_attr( $widget_id ); ?>"><?php echo esc_html( $settings['name-field-label'] ); ?></label>
                        <input id="rvr-user-name-<?php echo esc_attr( $widget_id ); ?>" type="text" class="rvr-user-name" name="user_name" placeholder="<?php echo esc_html( $settings['name-field-placeholder'] ); ?>">
                    </div>

                    <div class="option-bar large">
                        <label for="rvr-email-<?php echo esc_attr( $widget_id ); ?>"><?php echo esc_html( $settings['email-field-label'] ); ?></label>
                        <input id="rvr-email-<?php echo esc_attr( $widget_id ); ?>" type="text" name="email" class="rvr-email required" placeholder="<?php echo esc_html( $settings['email-field-placeholder'] ); ?>">
                    </div>

                    <div class="option-bar large">
                        <label for="rvr-phone-<?php echo esc_attr( $widget_id ); ?>"><?php echo esc_html( $settings['phone-field-label'] ); ?></label>
                        <input id="rvr-phone-<?php echo esc_attr( $widget_id ); ?>" type="text" class="rvr-phone" name="phone" placeholder="<?php echo esc_attr( $settings['phone-field-placeholder'] ); ?>">
                    </div>

                    <div class="option-bar small">
                        <label for="rvr-check-in-<?php echo esc_attr( $widget_id ); ?>"><?php echo esc_html( $settings['check-in-field-label'] ); ?></label>
                        <input id="rvr-check-in-<?php echo esc_attr( $widget_id ); ?>" type="text" name="check_in" class="rvr-check-in required" placeholder="<?php echo esc_attr( $settings['check-in-field-placeholder'] ) ?>" title="<?php echo esc_attr( $settings['check-in-field-label'] ); ?>" autocomplete="off">
                    </div>

                    <div class="option-bar small">
                        <label for="rvr-check-out-<?php echo esc_attr( $widget_id ); ?>"><?php echo esc_html( $settings['check-out-field-label'] ); ?></label>
                        <input id="rvr-check-out-<?php echo esc_attr( $widget_id ); ?>" type="text" name="check_out" class="rvr-check-out required" placeholder="<?php echo esc_attr( $settings['check-out-field-placeholder'] ) ?>" title="<?php echo esc_attr( $settings['check-out-field-label'] ); ?>" autocomplete="off">
                    </div>

					<?php
					$max_guests   = 10;
					$rvr_settings = get_option( 'rvr_settings' );

					if ( ! empty( $rvr_settings['max_guests'] ) ) {
						$max_guests = intval( $rvr_settings['max_guests'] );
					}
					?>
                    <div class="option-bar small">
                        <label for="rvr-adult-<?php echo esc_attr( $widget_id ); ?>"><?php echo esc_html( $settings['adults-field-label'] ); ?></label>
                        <select id="rvr-adult-<?php echo esc_attr( $widget_id ); ?>" name="adult" class="rvr-adult inspiry_select_picker_trigger inspiry_bs_green show-tick">
							<?php
							for ( $num = 1; $num <= $max_guests; $num += 1 ) {
								echo "<option value='{$num}'>{$num}</option>";
							}
							?>
                        </select>
                    </div>

                    <div class="option-bar bar-right small">
                        <label for="rvr-child-<?php echo esc_attr( $widget_id ); ?>"><?php echo esc_html( $settings['children-field-label'] ); ?></label>
                        <select id="rvr-child-<?php echo esc_attr( $widget_id ); ?>" name="child" class="rvr-child inspiry_select_picker_trigger inspiry_bs_green show-tick">
							<?php
							for ( $num = 0; $num <= $max_guests; $num += 1 ) {
								echo "<option value='{$num}'>{$num}</option>";
							}
							?>
                        </select>
                    </div>

                    <div class="option-bar large rvr_no_bottom_border">
                        <label for="rvr-infant-<?php echo esc_attr( $widget_id ); ?>"><?php echo esc_html( $settings['infants-field-label'] ); ?></label>
                        <select id="rvr-infant-<?php echo esc_attr( $widget_id ); ?>" name="infant" class="rvr-infant inspiry_select_picker_trigger inspiry_bs_green show-tick">
			                <?php
			                for ( $num = 0; $num <= $max_guests; $num += 1 ) {
				                echo "<option value='{$num}'>{$num}</option>";
			                }
			                ?>
                        </select>
                    </div>

                    <?php
					// Additional fees calculation fields display.
					$additional_amenities = get_post_meta( $post_id, 'rvr_additional_amenities', true );
					if ( ! empty( $additional_amenities ) && is_array( $additional_amenities ) ) {
						?>
                        <div class="rvr-additional-amenities option-bar large">
							<?php
							foreach ( $additional_amenities as $additional_amenity ) {

								if ( ! empty( $additional_amenity['amenity_label'] ) && ! empty( $additional_amenity['amenity_price'] ) ) {
									$amenity_label     = $additional_amenity['amenity_label'];
									$amenity_price     = $additional_amenity['amenity_price'];
									$price_calculation = $additional_amenity['price_calculation'];

									switch ( $additional_amenity['price_calculation'] ) {
										case 'per_night':
											$price_info_label = esc_html__( 'per night', 'framework' );
											break;
										case 'per_guest':
											$price_info_label = esc_html__( 'per guest', 'framework' );
											break;
										case 'per_night_guest':
											$price_info_label = esc_html__( 'per night per guest', 'framework' );
											break;
										default:
											$price_info_label = 'per stay';
									}
									?>
                                    <div class="amenity-field <?php echo sanitize_key( $amenity_label ); ?>-amenity-field">
                                        <div class="amenity-desc">
                                            <label for="<?php echo sanitize_key( $amenity_label ); ?>-amenity">
                                                <input id="<?php echo sanitize_key( $amenity_label ); ?>-amenity" name="<?php echo sanitize_key( $amenity_label ); ?>" data-label="<?php echo esc_attr( $amenity_label ); ?>" data-calculation="<?php echo esc_attr( $price_calculation ); ?>" data-amount="<?php echo floatVal( $amenity_price ); ?>" type="checkbox" value="<?php echo floatVal( $amenity_price ); ?>">
                                                <span><?php echo esc_html( $amenity_label ); ?></span>
                                            </label>
                                        </div>
                                        <div class="amenity-price"><?php echo rhea_get_custom_price( $amenity_price ) . '<span>' . esc_html( $price_info_label ) . '</span>'; ?></div>
                                    </div>
									<?php
								}
							}
							?>
                        </div>
						<?php
					}

					if ( $rvr_settings['rvr_terms_info'] && ! empty( $rvr_settings['rvr_terms_anchor_text'] ) ) {
						?>
                        <div class="option-bar rvr-terms-conditions">
                            <label for="rvr-terms-conditions-<?php echo esc_attr( $widget_id ); ?>">
                                <input id="rvr-terms-conditions-<?php echo esc_attr( $widget_id ); ?>" type="checkbox" name="terms_conditions" class="rvr-terms-conditions required" title="<?php esc_html_e( 'Please accept the terms and conditions.', 'realhomes-elementor-addon' ); ?>">
                                <span><?php echo wp_kses( $rvr_settings['rvr_terms_anchor_text'], wp_kses_allowed_html( 'post' ) ); ?></span>
                            </label>
                        </div>
						<?php
					}

					if ( function_exists( 'ere_is_reCAPTCHA_configured' ) && ere_is_reCAPTCHA_configured() ) {
						?>
                        <div class="rvr-reCAPTCHA-wrapper inspiry-recaptcha-wrapper clearfix g-recaptcha-type-<?php echo esc_attr( get_option( 'inspiry_reCAPTCHA_type', 'v2' ) ); ?>">
                            <div class="inspiry-google-recaptcha"></div>
                        </div>
						<?php
					}
					?>
                    <div class="booking-cost">

                        <!-- Booking payable amount field -->
                        <div class="cost-field total-price-field">
                            <div class="cost-desc">
                                <strong><?php echo esc_html( $payable ); ?></strong>
                                <a class="rvr-show-details" data-alt-label="(<?php echo esc_html( $hide_details ); ?>)">
                                    (<?php echo esc_html( $show_details ); ?>)
                                </a>
                            </div>
                            <div class="cost-value"></div>
                        </div>

                        <!-- Booking cost details -->
                        <div class="booking-cost-details">
                            <div class="cost-field staying-nights-count-field">
                                <div class="cost-desc"><?php echo esc_html( $staying_nights ); ?></div>
                                <div class="cost-value"></div>
                            </div>
                            <div class="cost-field staying-nights-field">
                                <div class="cost-desc"><?php echo esc_html( $price_for_staying ); ?></div>
                                <div class="cost-value"></div>
                            </div>
							<?php
							// Additional fees calculation fields display.
							$additional_fees = get_post_meta( $post_id, 'rvr_additional_fees', true );
							if ( ! empty( $additional_fees ) && is_array( $additional_fees ) ) {
								foreach ( $additional_fees as $additional_fee ) {
									if ( ! empty( $additional_fee['rvr_fee_label'] ) && ! empty( $additional_fee['rvr_fee_amount'] ) ) {
										?>
                                        <div class="cost-field <?php echo sanitize_key( $additional_fee['rvr_fee_label'] ); ?>-fee-field">
                                            <div class="cost-desc"><?php echo esc_html( $additional_fee['rvr_fee_label'] );
												echo ( 'percentage' === $additional_fee['rvr_fee_type'] ) ? '<span>' . intVal( $additional_fee['rvr_fee_amount'] ) . '%</span>' : ''; ?></div>
                                            <div class="cost-value"></div>
                                        </div>
										<?php
									}
								}
							}

							// Additional amenities calculation fields display.
							$additional_amenities = get_post_meta( $post_id, 'rvr_additional_amenities', true );
							if ( ! empty( $additional_amenities ) && is_array( $additional_amenities ) ) {
								foreach ( $additional_amenities as $additional_amenity ) {
									if ( ! empty( $additional_amenity['amenity_label'] ) && ! empty( $additional_amenity['amenity_price'] ) ) {
										?>
                                        <div class="cost-field <?php echo sanitize_key( $additional_amenity['amenity_label'] ); ?>-amenity-field">
                                            <div class="cost-desc"><?php echo esc_html( $additional_amenity['amenity_label'] ); ?></div>
                                            <div class="cost-value"></div>
                                        </div>
										<?php
									}
								}
							}

							// Guests capacity extension.
							$guests_capacity   = get_post_meta( $post_id, 'rvr_guests_capacity', true );
							$book_child_as     = get_post_meta( $post_id, 'rvr_book_child_as', true );
							$extra_guests      = get_post_meta( $post_id, 'rvr_guests_capacity_extend', true );
							$extra_guest_price = get_post_meta( $post_id, 'rvr_extra_guest_price', true );

							if ( 'allowed' === $extra_guests && ! empty( $extra_guest_price ) ) {
								?>
                                <div class="cost-field extra-guests-field">
                                    <div class="cost-desc"><?php echo esc_html__( 'Extra Guests' ); ?>
                                        <span>0</span></div>
                                    <div class="cost-value"></div>
                                </div>
								<?php
							}

							// Govt tax and service charges percentages.
							$service_charges_percentage = get_post_meta( $post_id, 'rvr_service_charges', true );
							$govt_tax_percentage        = get_post_meta( $post_id, 'rvr_govt_tax', true );

							if ( ! empty( $service_charges_percentage ) ) {
								?>
                                <div class="cost-field services-charges-field">
                                    <div class="cost-desc"><?php echo esc_html( $services_charges ); ?>
                                        <span><?php echo floatval( $service_charges_percentage ); ?>%</span>
                                    </div>
                                    <div class="cost-value"></div>
                                </div>
								<?php
							}

							if ( ! empty( $govt_tax_percentage ) ) {
								?>
                                <div class="cost-field subtotal-price-field">
                                    <div class="cost-desc">
                                        <strong><?php echo esc_html( $subtotal ); ?></strong>
                                    </div>
                                    <div class="cost-value"></div>
                                </div>
                                <div class="cost-field govt-tax-field">
                                    <div class="cost-desc"><?php echo esc_html( $government_taxes ); ?>
                                        <span><?php echo floatval( $govt_tax_percentage ); ?>%</span></div>
                                    <div class="cost-value"></div>
                                </div>
								<?php
							}
							?>
                            <div class="cost-field total-price-field">
                                <div class="cost-desc">
                                    <strong><?php echo esc_html( $total_price ); ?></strong>
                                </div>
                                <div class="cost-value"></div>
                            </div>
                        </div><!-- End of .booking-cost-details -->
                    </div><!-- End of .booking-cost -->

                    <div class="submission-area clearfix">
						<?php
						$additional_fees = get_post_meta( $post_id, 'rvr_additional_fees', true );
						if ( ! empty( $additional_fees ) && is_array( $additional_fees ) ) {
							echo '<div class="rvr-additional-fees">';
							foreach ( $additional_fees as $additional_fee ) {
								if ( ! empty( $additional_fee['rvr_fee_label'] ) && ! empty( $additional_fee['rvr_fee_amount'] ) ) {
									?>
                                    <input type="hidden" name="<?php echo sanitize_key( $additional_fee['rvr_fee_label'] ); ?>" data-label="<?php echo esc_attr( $additional_fee['rvr_fee_label'] ); ?>" data-type="<?php echo esc_attr( $additional_fee['rvr_fee_type'] ); ?>" data-calculation="<?php echo esc_attr( $additional_fee['rvr_fee_calculation'] ); ?>" data-amount="<?php echo esc_html( $additional_fee['rvr_fee_amount'] ); ?>" />
									<?php
								}
							}
							echo '</div>';
						}

						// Property pricing flag if seasonal are available.
						$seasonal_prices  = get_post_meta( $post_id, 'rvr_seasonal_prices_table', true );
						$property_pricing = 'flat';
						if ( ! empty( $seasonal_prices ) && is_array( $seasonal_prices ) ) {
							$property_pricing = 'seasonal';
						}

						// Bulk prices data.
						$bulk_prices = get_post_meta( $post_id, 'rvr_bulk_pricing', true );
						if ( is_array( $bulk_prices ) && ! empty( $bulk_prices ) ) {
							sort( $bulk_prices );

							$bulk_price_pairs = array();
							foreach ( $bulk_prices as $bulk_price ) {
								if ( ! empty( $bulk_price['number_of_nights'] ) && ! empty( $bulk_price['number_of_nights'] ) ) {
									$bulk_price_pairs[ $bulk_price['number_of_nights'] ] = $bulk_price['price_per_night'];
								}
							}
							?>
                            <input type="hidden" name="bulk_prices" class="bulk-prices" value="<?php echo esc_html( htmlspecialchars( wp_json_encode( $bulk_price_pairs ) ) ); ?>" />
							<?php
						}
						?>
                        <input type="hidden" name="guests_capacity" class="guests-capacity" value="<?php echo esc_html( $guests_capacity ); ?>" />
                        <input type="hidden" name="book_child_as" class="book-child-as" value="<?php echo esc_html( $book_child_as ); ?>" />
                        <input type="hidden" name="extra_guests" class="extra-guests" value="<?php echo esc_html( $extra_guests ); ?>" />
                        <input type="hidden" name="extra_guest_price" class="per-extra-guest-price" value="<?php echo esc_html( $extra_guest_price ); ?>" />
                        <input type="hidden" name="property_pricing" class="property-pricing" value="<?php echo esc_attr( $property_pricing ); ?>" />
                        <input type="hidden" name="property_id" class="property-id" value="<?php echo $post_id; ?>" />
                        <input type="hidden" name="price_per_night" class="price-per-night" value="<?php echo intval( get_post_meta( $post_id, 'REAL_HOMES_property_price', true ) ); ?>" />
                        <input type="hidden" name="service_charges" class="service-charges" value="<?php echo floatval( get_post_meta( $post_id, 'rvr_service_charges', true ) ); ?>" />
                        <input type="hidden" name="govt_charges" class="govt-charges" value="<?php echo floatval( get_post_meta( $post_id, 'rvr_govt_tax', true ) ); ?>" />
                        <input type="hidden" name="action" value="rvr_booking_request" />
                        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'rvr_booking_request' ); ?>" />
                        <div class="rvr-booking-button-wrapper">
                            <input type="submit" value="<?php echo esc_html( $book_now_button ); ?>" class="rvr-booking-button real-btn btn">
                        </div>
                        <span class="rvr-ajax-loader"><?php include INSPIRY_THEME_DIR . '/images/loader.svg'; ?></span>

                        <div class="rvr-message-container"></div>
                        <div class="rvr-error-container"></div>
                    </div>
                </form>
            </div>

			<?php
			if ( ! empty( $phone_number ) ) {
				?>
                <div class="rvr_request_cta_booking">
                    <span class="rvr_cta_or"><?php echo esc_html( $rvr_or ); ?></span>
                    <div class="rvr_request_cta_number_wrapper">
                        <span class="rvr_phone_icon_wrapper">
                            <span class="rvr_phone_icon"><?php inspiry_safe_include_svg( '/images/phone-cfos.svg', '/common/' ); ?></span>
                        </span>
                        <p class="rvr-phone-number">
                            <strong><?php echo esc_html( $rvr_call_now ); ?></strong>
                            <a href="tel:<?php echo esc_attr( $phone_number ); ?>"><?php echo esc_html( $phone_number ); ?></a>
                        </p>
                    </div>
                </div>
				<?php
			}
			?>
        </div>
		<?php
	}
}