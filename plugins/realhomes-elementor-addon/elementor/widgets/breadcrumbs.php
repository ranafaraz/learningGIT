<?php
/**
 * Breadcrumbs Widget
 *
 * @since 2.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Breadcrumbs_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-breadcrumbs-widget';
	}

	public function get_title() {
		return esc_html__( 'RealHomes Breadcrumbs', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-yoast';
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'basic_settings',
			[
				'label' => esc_html__( 'Basic Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'breadcrumb_typography',
				'label'    => esc_html__( 'Breadcrumbs', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .breadcrumbs li',
			]
		);

		$this->add_responsive_control(
			'font-size-arrow',
			[
				'label'     => esc_html__( 'Arrows Font Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 32,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-page-breadcrumbs > ol li + li:before' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rh-page-breadcrumbs > ul li + li:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_margin',
			[
				'label'      => esc_html__( 'Arrows Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-page-breadcrumbs > ol li + li:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rh-page-breadcrumbs > ul li + li:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'color',
			[
				'label'     => esc_html__( 'Current Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .breadcrumbs li' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'link-color',
			[
				'label'     => esc_html__( 'Link Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .breadcrumbs li a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'color-hover',
			[
				'label'     => esc_html__( 'Link Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .breadcrumbs li a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'color-arrow',
			[
				'label'     => esc_html__( 'Arrow Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-page-breadcrumbs > ol li + li:before' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rh-page-breadcrumbs > ul li + li:before' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_section();
	}

	protected function render() {
		if ( function_exists( 'realhomes_breadcrumbs' ) ) {
			realhomes_breadcrumbs();
		}
	}
}