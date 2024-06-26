<?php
/**
 * Property RVR Availability Calendar
 *
 * @since 2.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Availability_Calendar extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-pdp-availability-calendar';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Availability Calendar', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-calendar';
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
				'default' => esc_html__( 'Property Availability', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'section_title_typography',
				'label'    => esc_html__( 'Section Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_rvr_outdoor_features_wrapper .rh_property__heading'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'    => esc_html__( 'Item Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_rvr_outdoor_features_wrapper h5',
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
					'size' => 15
				],
				'selectors'  => [
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper .rh_done_icon svg' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper .rh_property__heading' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_icon_color',
			[
				'label'     => esc_html__( 'Item Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper .rh_done_icon' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Item Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper ul li h5' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$availability_table = get_post_meta( $post_id, 'rvr_property_availability_table', true );
		$booking_type       = get_option( 'rvr_settings' )['rvr_booking_type'] ?? 'full_day';
		$data_dates         = array();

		if ( ! empty( $availability_table ) && is_array( $availability_table ) ) {

			foreach ( $availability_table as $dates ) {

				$begin = new DateTime( $dates[0] );
				$end   = new DateTime( $dates[1] );
				if ( ( 'full_day' === $booking_type ) || ( 'split_day' === $booking_type && $begin == $end ) ) {
					$end = $end->modify( '+1 day' );
				}

				$interval  = new DateInterval( 'P1D' );
				$daterange = new DatePeriod( $begin, $interval, $end );

				foreach ( $daterange as $date ) {
					$data_dates[] = $date->format( "Y-m-d" );
				}
			}

			$data_dates = implode( ',', $data_dates );

			?>
            <div class="rh_property__ava_calendar_wrap">
				<?php
				$section_title = $settings['section_title'] ?? esc_html__( 'Property Availability', 'realhomes-elementor-addon' );
				if ( ! empty( $section_title ) ) {
					?>
                    <h4 class="rh_property__heading"><?php echo esc_html( $section_title ); ?></h4>
					<?php
				}
				?>
                <div id="property-availability" class="<?php echo esc_attr( $booking_type ) ?>" data-toggle="calendar" data-dates="<?php echo ! empty( $data_dates ) ? $data_dates : ''; ?>"></div>
                <div class="calendar-guide">
                    <ul class="clearfix">
                        <li class="available-days"><?php esc_html_e( 'Available', 'realhomes-elementor-addon' ); ?></li>
                        <li class="reserved-days"><?php esc_html_e( 'Booked', 'realhomes-elementor-addon' ); ?></li>
                        <li class="past-days"><?php esc_html_e( 'Past', 'realhomes-elementor-addon' ); ?></li>
                        <li class="today"><?php esc_html_e( 'Today', 'realhomes-elementor-addon' ); ?></li>
                    </ul>
                </div>
            </div>
			<?php

		} else {
			rhea_print_no_result_for_editor();
		}

	}
}