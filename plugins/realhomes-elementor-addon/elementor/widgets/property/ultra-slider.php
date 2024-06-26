<?php
/**
 * Property Slider Elementor widget for single property
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Main_Slider extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-property-slider';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Slider', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'ultra-realhomes-single-property' ];
	}

	public function get_script_depends() {

		wp_register_script(
			'rhea-ultra-property-slider',
			RHEA_PLUGIN_URL . 'elementor/js/ultra-single-property-slider.js',
			[ 'elementor-frontend', 'jquery', 'vendors-js' ],
			RHEA_VERSION,
			true
		);

		return [
			'rhea-ultra-property-slider'
		];
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
			'show_carousel',
			[
				'label'        => esc_html__( 'Show Carousel Thumbnails', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'show_favourite_button',
			[
				'label'        => esc_html__( 'Show Property Favourite Button', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'ere_enable_compare_properties',
			[
				'label'        => esc_html__( 'Show Property Compare Button', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'show_print_button',
			[
				'label'        => esc_html__( 'Show Property Print Button', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'show_share_button',
			[
				'label'        => esc_html__( 'Show Property Share Button', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'show_report_button',
			[
				'label'        => esc_html__( 'Show Report Property Button', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'ere_properties_labels',
			[
				'label' => esc_html__( 'Property Labels', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ere_property_featured_label',
			[
				'label'   => esc_html__( 'Featured Tag', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Featured', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'property_fav_label',
			[
				'label'   => esc_html__( 'Add To Favourite', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Add To Favourite', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'property_fav_added_label',
			[
				'label'   => esc_html__( 'Added To Favourite', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Added To Favourite', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'ere_property_compare_label',
			[
				'label'   => esc_html__( 'Add To Compare', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Add To Compare', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'ere_property_compare_added_label',
			[
				'label'   => esc_html__( 'Added To Compare', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Added To Compare', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'ere_property_print_label',
			[
				'label'   => esc_html__( 'Print', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Print', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'ere_property_share_label',
			[
				'label'   => esc_html__( 'Share', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Share', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'report_property_label',
			[
				'label'   => esc_html__( 'Report Property', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Report This Property', 'realhomes-elementor-addon' ),
			]
		);

        $this->add_control(
			'ere_property_photos_label',
			[
				'label'   => esc_html__( 'Photos Counter Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Photos', 'realhomes-elementor-addon' ),
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'ere_testimonials_typo_section',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'tags_typography',
				'label'    => esc_html__( 'Property Tags', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-ultra-property-tag',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Property Title', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-ultra-property-title-price h1',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'price_typography',
				'label'    => esc_html__( 'Property Price', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-ultra-price',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'address_typography',
				'label'    => esc_html__( 'Property Address', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-ultra-property-address',
			]
		);
		$this->add_responsive_control(
			'address_icon_size',
			[
				'label'     => esc_html__( 'Address Icon Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-address-pin' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'counter_typography',
				'label'    => esc_html__( 'Property Counter', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-ultra-thumb-count .rh-slider-item-total',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'counter_label_typography',
				'label'    => esc_html__( 'Property Photos Counter Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-ultra-thumb-count .rh-more-slides',
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
			'slider_height',
			[
				'label'      => esc_html__( 'Slider Height', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1500,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-property-thumb' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'carousel_thumb_height',
			[
				'label'      => esc_html__( 'Carousel Thumbnails Height', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 600,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-property-carousel-thumb' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'carousel-margin-top',
			[
				'label'     => esc_html__( 'Carousel Margin Top', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-carousel-wrapper' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'slider-content-padding',
			[
				'label'      => esc_html__( 'Slider Content Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-property-thumb-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'slider-tag-padding',
			[
				'label'      => esc_html__( 'Tags Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-property-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'slider-price-padding',
			[
				'label'      => esc_html__( 'Price Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title-margins',
			[
				'label'      => esc_html__( 'Property Title Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-property-title-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'action_buttons_gap',
			[
				'label'     => esc_html__( 'Action Buttons Gap', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-slider-container .rh-ultra-thumb-action-box.rh-ultra-action-buttons' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .rh-ultra-property-slider-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
			'type-tag-bg-color',
			[
				'label'     => esc_html__( 'Type Tag Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-tag' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'type-tag-bg-color-hover',
			[
				'label'     => esc_html__( 'Type Tag Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-tag:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'type-tag-color',
			[
				'label'     => esc_html__( 'Type Tag Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-tag' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'type-tag-color-hover',
			[
				'label'     => esc_html__( 'Type Text Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-tag:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'featured-tag-bg-color',
			[
				'label'     => esc_html__( 'Featured Tag Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_ultra_featured' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'featured-tag-bg-text',
			[
				'label'     => esc_html__( 'Featured Tag Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_ultra_featured' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'label-tag-text-color',
			[
				'label'     => esc_html__( 'Label Tag Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property-title-text-color',
			[
				'label'     => esc_html__( 'Property Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-title-price h1' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property-price-bg-color',
			[
				'label'     => esc_html__( 'Property Price Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-price' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property-price-text-color',
			[
				'label'     => esc_html__( 'Property Price Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-price' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property-address-text-color',
			[
				'label'     => esc_html__( 'Property Address Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-address' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property-address-icon-color',
			[
				'label'     => esc_html__( 'Property Address Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-address .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property-action-buttons-bg-color',
			[
				'label'     => esc_html__( 'Action Buttons Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-action-buttons .favorite-btn-wrap a'                         => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-action-buttons .favorite-btn-wrap span'                      => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-action-buttons .add-to-compare-span a'                       => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-action-buttons .add-to-compare-span span'                    => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-property-slider-container .rh-ultra-thumb-action-box .share' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-property-slider-container .rh-ultra-thumb-action-box .print' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property-action-buttons-bg-color-hover',
			[
				'label'     => esc_html__( 'Action Buttons Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-action-buttons .favorite-btn-wrap a:hover'                         => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-action-buttons .favorite-btn-wrap span:hover'                      => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-action-buttons .favorite-btn-wrap span.highlight__red'             => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-action-buttons .add-to-compare-span a:hover'                       => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-action-buttons .add-to-compare-span span:hover'                    => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-action-buttons .add-to-compare-span span.highlight'                => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-property-slider-container .rh-ultra-thumb-action-box .share:hover' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-property-slider-container .rh-ultra-thumb-action-box .print:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property-action-buttons-icons-dark',
			[
				'label'     => esc_html__( 'Action Buttons Icons Dark', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-action-buttons .rh-ultra-dark' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-share-wrapper svg'             => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property-action-buttons-icons-light',
			[
				'label'     => esc_html__( 'Action Buttons Icons Light', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-action-buttons .rh-ultra-light' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-share-wrapper svg'              => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property-fav-active-icons-dark',
			[
				'label'     => esc_html__( 'Favourite Added Icons Dark', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-action-buttons .favorite-btn-wrap span.highlight__red .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property-fav-active-icons-light',
			[
				'label'     => esc_html__( 'Favourite Added Icons Light', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-action-buttons .favorite-btn-wrap span.highlight__red .rh-ultra-light' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property-compare-active-icons-dark',
			[
				'label'     => esc_html__( 'Compare Added Icons Dark', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-action-buttons .add-to-compare-span span.highlight .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property-compare-active-icons-light',
			[
				'label'     => esc_html__( 'Compare Added Icons Light', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-action-buttons .add-to-compare-span span.highlight .rh-ultra-light' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'slider-nav-background',
			[
				'label'     => esc_html__( 'Slider Nav Button Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-slider-wrapper .slick-arrow' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'slider-nav-background-hover',
			[
				'label'     => esc_html__( 'Slider Nav Button Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-slider-wrapper .slick-arrow:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'slider-nav-caret',
			[
				'label'     => esc_html__( 'Slider Nav Caret', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-slider-wrapper .slick-arrow:before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'slider-nav-caret-hover',
			[
				'label'     => esc_html__( 'Slider Nav Caret Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-slider-wrapper .slick-arrow:hover:before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'carousel-icon-color',
			[
				'label'     => esc_html__( 'Camera Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-thumb-count .rh-ultra-black' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'carousel-counter-color',
			[
				'label'     => esc_html__( 'Image Counter Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-thumb-count .rh-slider-item-total' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'carousel-photos-color',
			[
				'label'     => esc_html__( 'Photos Label Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-thumb-count .rh-more-slides' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'carousel-active-slide-color',
			[
				'label'     => esc_html__( 'Carousel Active Slide Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-current .rh-ultra-property-carousel-thumb-box' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		global $settings;
		global $post_id;
		$settings = $this->get_settings_for_display();

		$post_id = get_the_ID();

		// Sample Post id for Elementor editor only
		if ( rhea_is_preview_mode() ) {
			$post_id = rhea_get_sample_property_id();
		}
		$size              = 'post-featured-image';
		$properties_images = rwmb_meta( 'REAL_HOMES_property_images', 'type=plupload_image&size=' . $size, $post_id );
		$prop_detail_login = inspiry_prop_detail_login();

		if ( ! empty( $properties_images ) && 1 < count( $properties_images ) && ( 'yes' != $prop_detail_login || is_user_logged_in() ) ) {
			?>
            <div class="rh-ultra-property-slider-wrapper">
                <div class="rh-ultra-property-slider-container">
                    <div class="rhea-ultra-property-slider" data-count="<?php echo esc_attr( count( $properties_images ) ) ?>">
						<?php
						$title_in_lightbox = get_option( 'inspiry_display_title_in_lightbox' );
						$lightbox_caption  = '';
						foreach ( $properties_images as $prop_image_id => $prop_image_meta ) {
							if ( 'true' == $title_in_lightbox ) {
								$lightbox_caption = 'data-caption="' . $prop_image_meta['title'] . '"';
							}
							?>
                            <div>
                                <div class="rh-ultra-property-thumb-wrapper">
                                    <a class="rh-ultra-property-thumb" href="<?php echo esc_url( $prop_image_meta['full_url'] ) ?>" style='background-image: url("<?php echo esc_url( $prop_image_meta['full_url'] ) ?>")' data-fancybox="gallery" <?php echo esc_attr( $lightbox_caption ) ?>></a>
                                </div>
                            </div>
							<?php
						}
						?>
                    </div>
                    <div class="rh-ultra-property-thumb-box">
                        <div class="rh-ultra-property-thumb-container">
							<?php rhea_get_template_part( 'assets/partials/ultra/single/property/property-head' ); ?>
                            <div class="rh-ultra-thumb-action-box rh-ultra-action-buttons rh-ultra-action-dark hover-dark">
								<?php rhea_get_template_part( 'assets/partials/ultra/single/property/action-buttons' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
				<?php
				if ( 'yes' === $settings['show_carousel'] ) {
					?>
                    <div class="rh-ultra-property-carousel-wrapper">
                        <div class="rh-ultra-property-carousel-box">
                            <div class="rhea-ultra-property-carousel rhea-ultra-horizontal-carousel-trigger" data-count="<?php echo esc_attr( count( $properties_images ) ) ?>">
								<?php
								foreach ( $properties_images as $prop_image_id => $prop_image_meta ) {
									?>
                                    <div>
                                        <div class="rh-ultra-property-carousel-thumb-box">
                                            <span class="rh-ultra-property-carousel-thumb" style='background-image: url("<?php echo esc_url( $prop_image_meta['full_url'] ) ?>")'></span>
                                        </div>
                                    </div>
									<?php
								}
								?>
                            </div>
                        </div>
                        <div class="rh-ultra-thumb-count">
							<?php
							if ( function_exists( 'inspiry_safe_include_svg' ) ) {
								inspiry_safe_include_svg( '/ultra/icons/photos.svg', '/assets/' );
							}
							?>
                            <span class="rh-slider-item-total"><?php echo esc_html( count( $properties_images ) ) ?></span>
							<?php
							if ( ! empty( $settings['ere_property_photos_label'] ) ) {
								?>
                                <span class="rh-more-slides"><?php echo esc_html( $settings['ere_property_photos_label'] ); ?></span>
								<?php
							}
							?>
                        </div>
                    </div>
					<?php
				}
				?>
            </div>
			<?php
			if ( function_exists( 'realhomes_print_property_images' ) ) {
				realhomes_print_property_images( $properties_images );
			}
			?>
            <div class="only-for-print">
				<?php rhea_get_template_part( 'assets/partials/ultra/single/property/property-head' ); ?>
            </div>
			<?php
		} else {

			if ( ! empty( get_the_post_thumbnail( $post_id ) ) ) {
				$image_url = get_the_post_thumbnail_url( $post_id, 'large' );
			} else {
				$image_url = get_inspiry_image_placeholder_url( 'large' );
			}
			?>
            <div class="rh-ultra-property-slider-wrapper">
                <div class="rh-ultra-property-slider-container">
                    <div class="rh-property-featured-image" style="background-image: url('<?php echo esc_url( $image_url ); ?>')">
                        <div id="property-featured-image" class="clearfix only-for-print">
							<?php echo '<img src="' . esc_url( $image_url ) . '" alt="' . the_title_attribute( 'echo=0' ) . '" />'; ?>
                        </div>
                    </div>
                    <div class="rh-ultra-property-thumb-box">
                        <div class="rh-ultra-property-thumb-container">
							<?php rhea_get_template_part( 'assets/partials/ultra/single/property/property-head' ); ?>
                            <div class="rh-ultra-thumb-action-box rh-ultra-action-buttons rh-ultra-action-dark hover-dark">
								<?php rhea_get_template_part( 'assets/partials/ultra/single/property/action-buttons' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

			<?php
		}
	}

}