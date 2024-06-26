<?php
/**
 * Property Nearby Places Elementor widget for single property
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Nearby_Places extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-property-nearby-places';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Nearby Places', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://elementor.github.io/elementor-icons/
		return 'eicon-map-pin';
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
				'default' => esc_html__( 'Nearby Places', 'realhomes-elementor-addon' ),
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
		$this->end_controls_section();
		$this->start_controls_section(
			'features_colors_section',
			[
				'label' => esc_html__( 'Basic Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'column-width',
			[
				'label'      => esc_html__( 'Columns Width %', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__yelp_wrap .yelp-places-group' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list-label-margin',
			[
				'label'      => esc_html__( 'Label Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__yelp_wrap .yelp-places-group .yelp-places-group-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list-item-margin',
			[
				'label'      => esc_html__( 'List Item Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__yelp_wrap .yelp-places-group .yelp-places-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'section-margin-bottom',
			[
				'label'     => esc_html__( 'Section Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_property__yelp_wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'list-typography',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'label'    => esc_html__( 'Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__yelp_wrap .yelp-places-group .yelp-places-group-title span',
			]
		);
		$this->add_responsive_control(
			'label_icons_size',
			[
				'label'     => esc_html__( 'Label Icon Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_property__yelp_wrap .yelp-places-group .yelp-places-group-title i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'list_item_typography',
				'label'    => esc_html__( 'List Item', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__yelp_wrap .yelp-places-group .yelp-places-list li .content-left-side',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'list_item_reviews_typography',
				'label'    => esc_html__( 'List Item Reviews', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__yelp_wrap .yelp-places-group .yelp-places-list li .yelp-place-review',
			]
		);
		$this->add_responsive_control(
			'list_item_icons_size',
			[
				'label'     => esc_html__( 'List Item Icon Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_property__yelp_wrap .yelp-places-group .yelp-places-list li:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'list-colors',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'label_icon_colors',
			[
				'label'     => esc_html__( 'Label Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__yelp_wrap .yelp-places-group .yelp-places-group-title i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'label_text_color',
			[
				'label'     => esc_html__( 'Label Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__yelp_wrap .yelp-places-group .yelp-places-group-title span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list_icon_color',
			[
				'label'     => esc_html__( 'List Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__yelp_wrap .yelp-places-group .yelp-places-list li:before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list_text_color',
			[
				'label'     => esc_html__( 'List Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__yelp_wrap .yelp-places-group .yelp-places-list li .content-left-side' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list_review_color',
			[
				'label'     => esc_html__( 'List Review Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__yelp_wrap .yelp-places-group .yelp-places-list li .yelp-place-review' => 'color: {{VALUE}}',
				],
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
		?>
        <div class="rh_property__yelp_wrap <?php realhomes_printable_section( 'yelp-nearby-places' ); ?>">
            <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4>
            <div class="rh_property__yelp"><?php echo inspiry_get_yelp_nearby_places( $post_id ); ?></div>
        </div>
		<?php

	}
}