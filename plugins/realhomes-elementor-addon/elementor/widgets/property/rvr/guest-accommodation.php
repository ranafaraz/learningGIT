<?php
/**
 * Property RVR Guest Accommodation
 *
 * @since 2.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Guest_Accommodation extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-pdp-guest-accommodation';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Guest Accommodation', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
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
				'default' => esc_html__( 'Guests Accommodation', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'section_title_typography',
				'label'    => esc_html__( 'Section Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rvr_guests_accommodation_wrap .rh_property__heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'    => esc_html__( 'Item Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rvr_guests_accommodation_wrap .rvr_guests_accommodation ul li strong',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'item_detail_typography',
				'label'    => esc_html__( 'Item Detail Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rvr_guests_accommodation_wrap .rvr_guests_accommodation ul li',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'item_guest_info_typography',
				'label'    => esc_html__( 'Guest Info Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rvr_guests_accommodation_wrap .rvr_guests_accommodation ul li i.guests-info',
			]
		);

		$this->add_control(
			'item_icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20
				],
				'selectors'  => [
					'{{WRAPPER}} .rvr_guests_accommodation_wrap .rvr_guests_accommodation ul li i.fas' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'styles_section',
			[
				'label' => esc_html__( 'Basic Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_title_color',
			[
				'label'     => esc_html__( 'Section Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_guests_accommodation_wrap .rh_property__heading' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_icon_color',
			[
				'label'     => esc_html__( 'Item Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_guests_accommodation_wrap .rvr_guests_accommodation ul li i.fas' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Item Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_guests_accommodation_wrap .rvr_guests_accommodation ul li strong' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_detail_color',
			[
				'label'     => esc_html__( 'Item Detail Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_guests_accommodation_wrap .rvr_guests_accommodation ul li' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_guests_count_color',
			[
				'label'     => esc_html__( 'Item Guests Info Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_guests_accommodation_wrap .rvr_guests_accommodation ul li i.guests-info' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_responsive_control(
			'section-padding',
			[
				'label'      => esc_html__( 'Section Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rvr_guests_accommodation_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'section-margins',
			[
				'label'      => esc_html__( 'Section Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rvr_guests_accommodation_wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'list-item-padding',
			[
				'label'      => esc_html__( 'List Item Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rvr_guests_accommodation_wrap .rvr_guests_accommodation ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'list-item-margin',
			[
				'label'      => esc_html__( 'List Item Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rvr_guests_accommodation_wrap .rvr_guests_accommodation ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$section_heading = $settings['section_title'] ?? esc_html__( 'Guests Accommodation', 'realhomes-elementor-addon' );
		$beds_details    = get_post_meta( $post_id, 'rvr_accommodation', true );

		if ( ! empty( $beds_details ) && is_array( $beds_details ) ) {
			?>
            <div class="rvr_guests_accommodation_wrap <?php realhomes_printable_section( 'rvr/guests-accommodation' ); ?>">
                <h4 class="rh_property__heading"><?php echo esc_html( $section_heading ); ?></h4>
                <div class="rvr_guests_accommodation">
                    <ul>
						<?php
						foreach ( $beds_details as $bed_detail ) {
							if ( ! empty( $bed_detail['room_type'] ) && ! empty( $bed_detail['bed_type'] ) && ! empty( $bed_detail['beds_number'] ) && ! empty( $bed_detail['guests_number'] ) ) {
								?>
                                <li>
                                    <i class="fas fa-bed"></i>
                                    <strong><?php echo esc_html( $bed_detail['room_type'] ); ?>:</strong>
									<?php
									echo intval( $bed_detail['beds_number'] ) . ' ' . esc_html( $bed_detail['bed_type'] ) . ' <i class="guests-info">(' . intval( $bed_detail['guests_number'] ) . ' ' . esc_html__( 'guests', 'realhomes-elementor-addon' ) . ')</i>';
									?>
                                </li>
								<?php
							}
						}
						?>
                    </ul>
                </div>
            </div>
			<?php
		} else {
			rhea_print_no_result_for_editor();
		}

	}
}