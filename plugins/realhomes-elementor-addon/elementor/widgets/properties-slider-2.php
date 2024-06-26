<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Properties Slider Two widget.
 *
 * Displays the properties image and details as slider into the page.
 *
 * @since 0.9.7
 */
class RHEA_Properties_Slider_Two_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rhea-properties-slider-two-widget';
	}

	public function get_title() {
		return esc_html__( 'Properties Slider 2', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	public function get_script_depends() {

		wp_register_script(
			'rhea-properties-slider-two',
			RHEA_PLUGIN_URL . 'elementor/js/properties-slider-two.js',
			[ 'elementor-frontend' ],
			RHEA_VERSION,
			true
		);

		return [
			'rhea-properties-slider-two'
		];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'slider_section',
			[
				'label' => esc_html__( 'Slider', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'slider_full_screen',
			[
				'label'        => esc_html__( 'Slider Full Screen', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_responsive_control(
			'slider_height',
			[
				'label'     => esc_html__( 'Slider Height', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-slide' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'slider_full_screen' => 'no',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'exclude'   => [ 'custom' ],
				'default'   => 'full',
				'separator' => 'after',
			]
		);

		$this->add_control(
			'show_property_address',
			[
				'label'        => esc_html__( 'Show Address', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'custom_status_heading',
			[
				'label'     => esc_html__( 'Select Properties', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$slider_properties_args = array(
			'post_type'   => 'property',
			'numberposts' => -1,
			'meta_query'  => array(
				array(
					'key'     => 'REAL_HOMES_add_in_slider',
					'value'   => 'yes',
					'compare' => 'LIKE',
				),
			),
		);

		$slider_properties      = get_posts( $slider_properties_args );
		$slider_properties_list = array();
		if ( $slider_properties ) {
			foreach ( $slider_properties as $slider_property ) {
				$slider_properties_list[ $slider_property->ID ] = esc_html( $slider_property->post_title );
			}
		}

		$slider_properties_defaults = array();
		if ( ! empty( $slider_properties_list ) ) {
			foreach ( $slider_properties_list as $key => $value ) {
				$slider_properties_defaults[] = array(
					'property_id'    => esc_html( $key ),
					'property_title' => '',
					'property_image' => array(),
				);

				break;
			}
		}

		$slider_properties_repeater = new \Elementor\Repeater();
		$slider_properties_repeater->add_control(
			'property_id',
			[
				'label'       => esc_html__( 'Select Property', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => $slider_properties_list,
			]
		);

		$slider_properties_repeater->add_control(
			'property_title',
			[
				'label'       => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);

		$slider_properties_repeater->add_control(
			'property_image',
			[
				'label' => esc_html__( 'Choose Image', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'properties_list',
			[
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $slider_properties_repeater->get_controls(),
				'show_label'  => false,
				'default'     => $slider_properties_defaults,
				'title_field' => '{{{ property_title }}}'
			]
		);

		$this->add_control(
			'description_box_heading',
			[
				'label'     => esc_html__( 'Property Details Alignment', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'vertical_align',
			[
				'label'   => esc_html__( 'Vertical Align', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'flex-start' => esc_html__( 'Top', 'realhomes-elementor-addon' ),
					'center'     => esc_html__( 'Middle', 'realhomes-elementor-addon' ),
					'flex-end'   => esc_html__( 'Bottom', 'realhomes-elementor-addon' ),
				],
			]
		);

		$this->add_control(
			'horizontal_align',
			[
				'label'   => esc_html__( 'Horizontal Align', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'flex-end',
				'options' => [
					'flex-start' => esc_html__( 'Start', 'realhomes-elementor-addon' ),
					'center'     => esc_html__( 'Center', 'realhomes-elementor-addon' ),
					'flex-end'   => esc_html__( 'End', 'realhomes-elementor-addon' ),
				],
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label'      => esc_html__( 'Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-properties-slider-two-slide-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'property_meta_heading',
			[
				'label' => esc_html__( 'Property Meta', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_property_meta',
			[
				'label'        => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$get_meta = array(
			'bedrooms'   => esc_html__( 'Bedrooms', 'realhomes-elementor-addon' ),
			'bathrooms'  => esc_html__( 'Bathrooms', 'realhomes-elementor-addon' ),
			'area'       => esc_html__( 'Area', 'realhomes-elementor-addon' ),
			'garage'     => esc_html__( 'Garages/Parking', 'realhomes-elementor-addon' ),
			'year-built' => esc_html__( 'Year Built', 'realhomes-elementor-addon' ),
			'lot-size'   => esc_html__( 'Lot Size', 'realhomes-elementor-addon' ),
		);

		$meta_defaults = array(
			array(
				'rhea_property_meta_display' => 'bedrooms',
				'rhea_meta_repeater_label'   => esc_html__( 'Bedrooms', 'realhomes-elementor-addon' ),
			),
			array(
				'rhea_property_meta_display' => 'bathrooms',
				'rhea_meta_repeater_label'   => esc_html__( 'Bathrooms', 'realhomes-elementor-addon' ),
			),
			array(
				'rhea_property_meta_display' => 'area',
				'rhea_meta_repeater_label'   => esc_html__( 'Area', 'realhomes-elementor-addon' ),
			),
		);

		if ( rhea_is_rvr_enabled() ) {
			$get_meta['guests']   = esc_html__( 'Guests Capacity', 'realhomes-elementor-addon' );
			$get_meta['min-stay'] = esc_html__( 'Min Stay', 'realhomes-elementor-addon' );

			$meta_defaults[] = array(
				'rhea_property_meta_display' => 'guests',
				'rhea_meta_repeater_label'   => esc_html__( 'Guests', 'realhomes-elementor-addon' ),
			);
		}

		$meta_repeater = new \Elementor\Repeater();
		$meta_repeater->add_control(
			'rhea_property_meta_display',
			[
				'label'   => esc_html__( 'Select Meta', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $get_meta,
			]
		);

		$meta_repeater->add_control(
			'rhea_meta_repeater_label',
			[
				'label'   => esc_html__( 'Meta Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Add Label', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'rhea_add_meta_select',
			[
				'label'       => esc_html__( 'Add Meta', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $meta_repeater->get_controls(),
				'default'     => $meta_defaults,
				'title_field' => ' {{{ rhea_meta_repeater_label }}}',
				'condition'   => [
					'show_property_meta' => 'yes',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'spaces_section',
			[
				'label' => esc_html__( 'Spaces', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_area_padding',
			[
				'label'     => esc_html__( 'Content Box Padding', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-slide-content-wrap' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'border-radius-value',
			[
				'label'      => esc_html__( 'Content Box Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [],
				'selectors'  => [
					'{{WRAPPER}} .rhea-properties-slider-two-slide-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'separator'  => 'after'
			]
		);

		$this->add_responsive_control(
			'title_margin_bottom',
			[
				'label'     => esc_html__( 'Title Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-property-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'address_margin_bottom',
			[
				'label'     => esc_html__( 'Address Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-property-address' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'description_margin_bottom',
			[
				'label'     => esc_html__( 'Meta Margin Top & Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-property-meta' => 'margin: {{SIZE}}{{UNIT}} 0;',
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
			'slider_nav_button_color',
			[
				'label'     => esc_html__( 'Slider Nav Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-nav a path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'slider_nav_button_hover_color',
			[
				'label'     => esc_html__( 'Slider Nav Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-nav a:hover path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'slider_nav_button_bg',
			[
				'label'     => esc_html__( 'Slider Nav Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-nav a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'slider_nav_button_hover_bg',
			[
				'label'     => esc_html__( 'Slider Nav Hover Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-nav a:hover' => 'background-color: {{VALUE}}',
				],
				'separator' => 'after'
			]
		);

		$this->add_control(
			'content_wrapper_background',
			[
				'label'     => esc_html__( 'Content Wrapper Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-slide-content-wrap' => 'background-color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'property_featured_tag_bg',
			[
				'label'     => esc_html__( 'Featured Tag Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--rhea-properties-slider-two-featured-tag-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'property_featured_tag_color',
			[
				'label'     => esc_html__( 'Featured Tag Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-featured-tag>span' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'property_title_color',
			[
				'label'     => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-property-title a' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'property_title_hover_color',
			[
				'label'     => esc_html__( 'Title Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-property-title:hover a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'property_address_color',
			[
				'label'     => esc_html__( 'Address', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-property-address' => 'color: {{VALUE}}',
				],
				'separator' => 'after'
			]
		);

		$this->add_control(
			'property_meta_icon_color',
			[
				'label'     => esc_html__( 'Meta Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-slide-content-wrap .rh_prop_card__meta .rh_svg' => 'fill: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'property_meta_title_color',
			[
				'label'     => esc_html__( 'Meta Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_prop_card_meta_wrap_stylish .rh_prop_card__meta .rhea_meta_titles' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'property_meta_value_color',
			[
				'label'     => esc_html__( 'Meta Value', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-slide-content-wrap .rh_prop_card__meta .figure' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'property_meta_value_label_color',
			[
				'label'     => esc_html__( 'Area Unit', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_prop_card_meta_wrap_stylish .rh_prop_card__meta .label' => 'color: {{VALUE}};',
				],
				'separator' => 'after'
			]
		);

		$this->add_control(
			'property_status_color',
			[
				'label'     => esc_html__( 'Status', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-property-status' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'property_price_color',
			[
				'label'     => esc_html__( 'Price', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-properties-slider-two-property-price' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'property_typography_section',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_title_typography',
				'label'    => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-properties-slider-two-property-title'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_address_typography',
				'label'    => esc_html__( 'Address', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-properties-slider-two-property-address'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_meta_title_typography',
				'label'    => esc_html__( 'Meta Title', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-properties-slider-two-slide-content-wrap .rh_prop_card__meta .rhea_meta_titles'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_meta_value_typography',
				'label'    => esc_html__( 'Meta Value', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-properties-slider-two-slide-content-wrap .rh_prop_card__meta .figure'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_area_postfix_typography',
				'label'    => esc_html__( 'Area Unit', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-properties-slider-two-slide-content-wrap .rh_prop_card__meta .label'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_status_typography',
				'label'    => esc_html__( 'Status', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-properties-slider-two-property-status'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_price_typography',
				'label'    => esc_html__( 'Price', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-properties-slider-two-property-price'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		global $settings;
		global $widget_id;
		$settings               = $this->get_settings_for_display();
		$widget_id              = $this->get_id();
		$slides_container_class = 'rhea-properties-slider-two-slide';
		$content_box_classes    = array( 'rhea-properties-slider-two-inner-wrapper' );

		// Slide full screen class.
		if ( 'yes' === $settings['slider_full_screen'] ) {
			$slides_container_class .= ' rhea-properties-slider-two-slide-full-screen';
		}

		// Vertical alignment class.
		if ( 'flex-start' === $settings['vertical_align'] ) {
			$content_box_classes[] = 'rhea-justify-content-top';
		} else if ( 'center' === $settings['vertical_align'] ) {
			$content_box_classes[] = 'rhea-justify-content-center';
		} else {
			$content_box_classes[] = 'rhea-justify-content-bottom';
		}

		// Horizontal alignment class.
		if ( 'flex-start' === $settings['horizontal_align'] ) {
			$content_box_classes[] = 'rhea-align-items-left';
		} else if ( 'center' === $settings['horizontal_align'] ) {
			$content_box_classes[] = 'rhea-align-items-center';
		} else {
			$content_box_classes[] = 'rhea-align-items-right';
		}

		$content_box_classes = join( ' ', $content_box_classes );

		// Collect the selected properties IDs.
		$slider_properties_ids = array();
		if ( is_array( $settings['properties_list'] ) ) {
			foreach ( $settings['properties_list'] as $key => $value ) {
				if ( isset( $value['property_id'] ) && ! empty( $value['property_id'] ) ) {
					$slider_properties_ids[ $value['property_id'] ] = $key;
				}
			}
		}

		if ( ! empty( $slider_properties_ids ) ) {
			$slider_properties_query = new WP_Query( array(
				'post_type'      => 'property',
				'posts_per_page' => -1,
				'post__in'       => array_keys( $slider_properties_ids ),
				"orderby"        => "post__in"
			) );
			?>
            <div id="rhea-properties-slider-two-wrapper-<?php echo esc_attr( $widget_id ); ?>" class="rhea-properties-slider-two-wrapper">
                <div id="rhea-properties-slider-two-<?php echo esc_attr( $widget_id ); ?>" class="rhea-properties-slider-two flexslider loading">
                    <ul class="slides">
						<?php
						if ( $slider_properties_query->have_posts() ) {
							while ( $slider_properties_query->have_posts() ) {
								$slider_properties_query->the_post();
								$property_id      = get_the_ID();
								$property_title   = get_the_title();
								$slider_image_id  = get_post_meta( $property_id, 'REAL_HOMES_slider_image', true );
								$property_address = get_post_meta( $property_id, 'REAL_HOMES_property_address', true );
								$is_featured      = get_post_meta( $property_id, 'REAL_HOMES_featured', true );

								// Override image and title of the property if exists.
								if ( in_array( $property_id, array_keys( $slider_properties_ids ) ) ) {
									$_property = $settings['properties_list'][ $slider_properties_ids[ $property_id ] ];

									if ( ! empty( $_property['property_image']['id'] ) ) {
										$slider_image_id = $_property['property_image']['id'];
									}

									if ( ! empty( $_property['property_title'] ) ) {
										$property_title = $_property['property_title'];
									}
								}

								$image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $slider_image_id, 'thumbnail', $settings );
								?>
                                <li>
                                    <a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $slides_container_class ); ?>" style="background-image: url('<?php echo esc_url( $image_url ) ?>');"></a>
                                    <div class="<?php echo esc_attr( $content_box_classes ); ?>">
                                        <div class="rhea-properties-slider-two-slide-content-wrap">
											<?php if ( ! empty( $is_featured ) ) { ?>
                                                <div class="rhea-properties-slider-two-featured-tag">
                                                    <span><?php esc_html_e( 'Featured', 'realhomes-elementor-addon' ); ?></span>
                                                </div>
											<?php } ?>
                                            <div class="rhea-properties-slider-two-slide-content">
                                                <h3 class="rhea-properties-slider-two-property-title">
                                                    <a href="<?php the_permalink(); ?>"><?php echo esc_html( $property_title ); ?></a>
                                                </h3>
												<?php
												if ( ! empty( $property_address ) && 'yes' === $settings['show_property_address'] ) { ?>
                                                    <address class="rhea-properties-slider-two-property-address">
														<?php echo esc_html( $property_address ); ?>
                                                    </address>
													<?php
												}

												// Property Meta
												if ( 'yes' === $settings['show_property_meta'] ) {
													rhea_get_template_part( 'assets/partials/stylish/grid-card-meta' );
												}

												// Property Status
												$statuses = get_the_terms( $property_id, 'property-status' );
												if ( ! empty( $statuses ) && ! is_wp_error( $statuses ) ) { ?>
                                                    <span class="rhea-properties-slider-two-property-status">
													<?php echo esc_html( $statuses[0]->name ); ?>
                                                </span>
													<?php
												}

												// Property Price.
												if ( function_exists( 'ere_get_property_price' ) ) { ?>
                                                    <p class="rhea-properties-slider-two-property-price"><?php echo esc_html( ere_get_property_price() ); ?></p>
												<?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
								<?php
							}

							// Reset the main query loop.
							wp_reset_postdata();
						}
						?>
                    </ul>
                </div>
                <div id="rhea-properties-slider-two-nav-<?php echo esc_attr( $widget_id ); ?>" class="rhea-properties-slider-two-nav">
                    <a href="#" class="flex-prev nav-buttons">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                            <path d="M16.5 25.6L24 26.4 24 31.1 33 24.1 24 17.1 24 21.7 16.5 22.5C16.1 22.5 15.7 22.6 15.4 22.9 15.1 23.2 15 23.6 15 24.1 15 24.5 15.1 24.9 15.4 25.1 15.7 25.4 16.1 25.6 16.5 25.6Z" />
                        </svg>
                    </a>
                    <a href="#" class="flex-next nav-buttons">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                            <path d="M16.5 25.6L24 26.4 24 31.1 33 24.1 24 17.1 24 21.7 16.5 22.5C16.1 22.5 15.7 22.6 15.4 22.9 15.1 23.2 15 23.6 15 24.1 15 24.5 15.1 24.9 15.4 25.1 15.7 25.4 16.1 25.6 16.5 25.6Z" />
                        </svg>
                    </a>
                </div>
            </div>
			<?php
		}
	}
}
