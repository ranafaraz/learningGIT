<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Ultra Properties Main Slider
 *
 * Displays the properties image and details as slider into the page.
 *
 */
class RHEA_Ultra_Main_Properties_Slider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rhea-ultra-main-properties-slider';
	}

	public function get_title() {
		return esc_html__( 'Ultra Main Properties Slider', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'ultra-real-homes' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'slider_section',
			[
				'label' => esc_html__( 'Slider', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
			'custom_status_heading',
			[
				'label'     => esc_html__( 'Select Properties', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$slider_properties_args = array(
			'post_type'        => 'property',
			'suppress_filters' => false,
			'numberposts'      => 100,
			'meta_query'       => array(
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
				'description' => esc_html__( 'Property slide will not be displayed if no Slider Image is selected" ', 'realhomes-elementor-addon' ),

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
		$slider_properties_repeater->add_control(
			'bg_slide_position',
			[
				'label'   => esc_html__( 'Background Position', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'center center',
				'options' => array(
					'center center' => esc_html__( 'Center Center', 'realhomes-elementor-addon' ),
					'center left'   => esc_html__( 'Center Left', 'realhomes-elementor-addon' ),
					'center right'  => esc_html__( 'Center Right', 'realhomes-elementor-addon' ),
					'top center'    => esc_html__( 'Top Center', 'realhomes-elementor-addon' ),
					'top left'      => esc_html__( 'Top Left', 'realhomes-elementor-addon' ),
					'top right'     => esc_html__( 'Top Right', 'realhomes-elementor-addon' ),
					'bottom center' => esc_html__( 'Bottom Center', 'realhomes-elementor-addon' ),
					'bottom left'   => esc_html__( 'Bottom Left', 'realhomes-elementor-addon' ),
					'bottom right'  => esc_html__( 'Bottom Right', 'realhomes-elementor-addon' ),
				),
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

		$this->end_controls_section();

		$this->start_controls_section(
			'property_meta_heading',
			[
				'label' => esc_html__( 'Property Meta', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		if ( rhea_is_rvr_enabled() ) {
			$this->add_control(
				'show_ratings_with_title',
				[
					'label'        => esc_html__( 'Show Ratings', 'realhomes-elementor-addon' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
					'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);

			$this->add_control(
				'show_added_date',
				[
					'label'        => esc_html__( 'Show Added Date', 'realhomes-elementor-addon' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
					'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
					'return_value' => 'yes',
					'default'      => 'yes',
					'condition'    => [
						'show_ratings_with_title' => 'yes'
					]
				]
			);

			$this->add_control(
				'show_added_date_label',
				[
					'label'     => esc_html__( 'Added Label Text', 'realhomes-elementor-addon' ),
					'type'      => \Elementor\Controls_Manager::TEXT,
					'default'   => esc_html__( 'Added:', 'realhomes-elementor-addon' ),
					'condition' => [
						'show_added_date' => 'yes'
					]
				]
			);
		}

		$this->add_control(
			'show_property_meta',
			[
				'label'        => esc_html__( 'Show Meta Info', 'realhomes-elementor-addon' ),
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
			'ere_properties_labels',
			[
				'label' => esc_html__( 'Property Labels', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ere_property_featured_label',
			[
				'label'   => esc_html__( 'Featured', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Featured', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'ere_property_build_label',
			[
				'label'   => esc_html__( 'Build', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( ' Build ', 'realhomes-elementor-addon' ),
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
			'slider_min_height',
			[
				'label'     => esc_html__( 'Slider Min Height', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-main-slider-thumb' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_vertical_position',
			[
				'label'     => esc_html__( 'Content Area Vertical Position', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-main-slider-detail' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_area_padding',
			[
				'label'      => esc_html__( 'Content Box Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-main-slider-detail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'border-radius-value',
			[
				'label'      => esc_html__( 'Content Box Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-main-slider-detail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'property-title-margin',
			[
				'label'      => esc_html__( 'Property Title Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-main-slider-detail h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'rating-stars-size',
			[
				'label'     => esc_html__( 'Rating Stars Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'   => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .rvr_card_info_wrap .rh-ultra-rvr-rating .rating-stars i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating-stars-margin',
			[
				'label'      => esc_html__( 'Rating Stars Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rvr_card_info_wrap .rh-ultra-rvr-rating .rating-stars' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'added-label-margin',
			[
				'label'      => esc_html__( 'Added Label Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rvr_card_info_wrap .added-date .added-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
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
			'slider_nav_button_bg_color',
			[
				'label'     => esc_html__( 'Slider Nav Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-main-slider-nav a' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'slider_nav_button_bg_hover_color',
			[
				'label'     => esc_html__( 'Slider Nav Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-main-slider-nav a:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'slider_nav_button_color',
			[
				'label'     => esc_html__( 'Slider Nav Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-main-slider-nav a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'slider_nav_button_hover_color',
			[
				'label'     => esc_html__( 'Slider Nav Icon Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-main-slider-nav a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_wrapper_background',
			[
				'label'     => esc_html__( 'Content Wrapper Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-main-slider-detail' => 'background-color: {{VALUE}}',
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
					'{{WRAPPER}} .rhea-ultra-slider-featured-tag' => 'background: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'property_featured_tag_color',
			[
				'label'     => esc_html__( 'Featured Tag Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-slider-featured-tag' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'property_title_color',
			[
				'label'     => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-main-slider-detail h3 a' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'property_title_hover_color',
			[
				'label'     => esc_html__( 'Title Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-main-slider-detail h3 a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'property_build_color',
			[
				'label'     => esc_html__( 'Year Build', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-main-slider-detail h3 span' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'rating_stars_color',
			[
				'label'     => esc_html__( 'Rating Stars', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_card_info_wrap .rh-ultra-rvr-rating .rating-stars i' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'rating_bars_color',
			[
				'label'     => esc_html__( 'Rating Count Bars', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_card_info_wrap .inspiry_stars_avg_rating .inspiry_rating_percentage .inspiry_rating_line .inspiry_rating_line_inner' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'added_label_color',
			[
				'label'     => esc_html__( 'Added Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_card_info_wrap .added-date .added-title' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'added_date_color',
			[
				'label'     => esc_html__( 'Added Date', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_card_info_wrap .added-date' => 'color: {{VALUE}}',
				],
				'separator' => 'after'
			]
		);

		$this->add_control(
			'property_meta_icon_color',
			[
				'label'     => esc_html__( 'Meta Icon Primary', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-dark' => 'fill: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'property_meta_icon_color_secondary',
			[
				'label'     => esc_html__( 'Meta Icon Secondary', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-light' => 'fill: {{VALUE}};',
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
					'{{WRAPPER}} .rhea-meta-icons-labels' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .rhea_ultra_meta_box .figure' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .rhea_ultra_meta_box .label' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .rhea-ultra-slider-property-status' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'property_price_color',
			[
				'label'     => esc_html__( 'Price', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ere-price-display' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property_price_pre_fix_color',
			[
				'label'     => esc_html__( 'Price Pre-fix', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ere-price-prefix' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property_price_post_fix_color',
			[
				'label'     => esc_html__( 'Price Post-fix', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ere-price-postfix' => 'color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .rhea-ultra-main-slider-detail h3'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_year_typography',
				'label'    => esc_html__( 'Year Build', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-main-slider-detail h3 span'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_added_on_typography',
				'label'    => esc_html__( 'Added Date Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rvr_card_info_wrap .added-date .added-title'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_added_date_typography',
				'label'    => esc_html__( 'Date', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rvr_card_info_wrap .added-date:not(.added-title)'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_meta_title_typography',
				'label'    => esc_html__( 'Meta Title', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-meta-icons-labels'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_meta_value_typography',
				'label'    => esc_html__( 'Meta Value', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea_ultra_meta_box .figure'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_area_postfix_typography',
				'label'    => esc_html__( 'Area Unit', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea_ultra_meta_box .label'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_status_typography',
				'label'    => esc_html__( 'Status', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-slider-price .rhea-ultra-slider-property-status'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_price_typography',
				'label'    => esc_html__( 'Price', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-slider-price .ere-price-display'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_price_prefix_typography',
				'label'    => esc_html__( 'Price Pre-fix', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-slider-price .ere-price-prefix'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_price_postfix_typography',
				'label'    => esc_html__( 'Price Post-fix', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-slider-price .ere-price-postfix'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		global $settings;
		global $widget_id;
		$settings  = $this->get_settings_for_display();
		$widget_id = $this->get_id();


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
				'posts_per_page' => 15,
				'post__in'       => array_keys( $slider_properties_ids ),
				"orderby"        => "post__in"
			) );

			?>
            <div id="rhea-ultra-main-slider-wrapper-<?php echo esc_attr( $widget_id ); ?>" class="rhea-ultra-main-slider-wrapper">
                <div id="rhea-ultra-main-slider-<?php echo esc_attr( $widget_id ); ?>" class="rhea-ultra-main-slider flexslider loading">
                    <ul class="slides">
						<?php
						if ( $slider_properties_query->have_posts() ) {
							while ( $slider_properties_query->have_posts() ) {
								$slider_properties_query->the_post();
								$property_id       = get_the_ID();
								$property_title    = get_the_title();
								$slider_image_id   = get_post_meta( $property_id, 'REAL_HOMES_slider_image', true );
								$property_address  = get_post_meta( $property_id, 'REAL_HOMES_property_address', true );
								$is_featured       = get_post_meta( $property_id, 'REAL_HOMES_featured', true );
								$bg_slide_position = 'center';
								// Override image and title of the property if exists.
								if ( in_array( $property_id, array_keys( $slider_properties_ids ) ) ) {
									$_property = $settings['properties_list'][ $slider_properties_ids[ $property_id ] ];

									if ( ! empty( $_property['property_image']['id'] ) ) {
										$slider_image_id = $_property['property_image']['id'];
										$slider_image_id = rhea_get_wpml_translated_image_id( $slider_image_id );
									}

									if ( ! empty( $_property['property_title'] ) ) {
										$property_title = $_property['property_title'];
									}

									if ( ! empty( $_property['bg_slide_position'] ) ) {
										$bg_slide_position = $_property['bg_slide_position'];
									}

								}

								$image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $slider_image_id, 'thumbnail', $settings );


								if ( $image_url ) {
									?>
                                    <li>
                                        <a class="rhea-ultra-main-slider-thumb" href="<?php the_permalink(); ?>" style="background-position: <?php echo esc_attr( $bg_slide_position ); ?>; background-image: url('<?php echo esc_url( $image_url ) ?>');"></a>
                                        <div class="rhea-ultra-main-detail-wrapper">

                                            <div class="rhea-ultra-main-slider-detail">
												<?php
												if ( ! empty( $is_featured ) ) { ?>
                                                    <span class="rhea-ultra-slider-featured-tag"><?php
														if ( ! empty( $settings['ere_property_featured_label'] ) ) {
															echo esc_html( $settings['ere_property_featured_label'] );
														} else {
															esc_html_e( 'Featured', 'realhomes-elementor-addon' );
														}
														?></span>
													<?php
												}
												?>
                                                <div class="ultra-slider-property-detail">
                                                    <h3 class="rhea-ultra-main-slider-title">
                                                        <a href="<?php the_permalink(); ?>"><?php echo esc_html( $property_title ); ?></a>
														<?php
														$property_year_built = get_post_meta( get_the_ID(), 'REAL_HOMES_property_year_built', true );
														if ( ! empty( $property_year_built ) ) {
															if ( ! empty( $settings['ere_property_build_label'] ) ) {
																$build = $settings['ere_property_build_label'];
															} else {
																$build = esc_html__( ' Build ', 'realhomes-elementor-addon' );
															}
															?>
                                                            <span class="rhea-ultra-slider-year-build">
                                                                <?php echo esc_html( $build . $property_year_built ); ?>
                                                            </span>
															<?php
														}
														?>
                                                    </h3>

													<?php
													if ( rhea_is_rvr_enabled() && $settings['show_ratings_with_title'] === 'yes' ) {
														?>
                                                        <div class="rvr_card_info_wrap">
                                                            <div class="rh-ultra-rvr-rating">
																<?php
																if ( 'true' === get_option( 'inspiry_property_ratings', 'false' ) ) {
																	inspiry_rating_average_plain();
																}
																?>
                                                            </div>
															<?php
															if ( $settings['show_added_date'] === 'yes' ) {
																$added_title = $settings['show_added_date_label'] ?? esc_html__( 'Added:', 'realhomes-elementor-addon' );
																?>
                                                                <p class="added-date">
                                                                    <span class="added-title"><?php echo esc_html( $added_title ); ?></span> <?php echo get_the_date(); ?>
                                                                </p>
																<?php
															}
															?>
                                                        </div>
														<?php
													}
													?>
                                                </div>
												<?php
												if ( 'yes' === $settings['show_property_meta'] ) {
													rhea_get_template_part( 'assets/partials/ultra/grid-card-meta' );
												}
												?>
                                                <div class="rhea-ultra-slider-price">
													<?php
													$statuses = get_the_terms( $property_id, 'property-status' );
													if ( ! empty( $statuses ) && ! is_wp_error( $statuses ) ) {
														?>
                                                        <span class="rhea-ultra-slider-property-status">
                                                            <?php echo esc_html( $statuses[0]->name ); ?>
                                                        </span>
														<?php
													}
													if ( function_exists( 'ere_get_property_price' ) ) {
														?>
                                                        <p class="rhea-ultra-main-slider-property-price"><?php echo ere_get_property_price( get_the_ID(), false, true ); ?></p>
														<?php
													}
													?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
									<?php
								}
							}

							// Reset the main query loop.
							wp_reset_postdata();
						}
						?>
                    </ul>
                </div>
                <div id="rhea-ultra-main-slider-nav-<?php echo esc_attr( $widget_id ); ?>" class="rhea-ultra-main-slider-nav">
                    <a href="#" class="flex-prev nav-buttons">
                        <i class="fas fa-caret-left"></i>
                    </a>
                    <a href="#" class="flex-next nav-buttons">
                        <i class="fas fa-caret-right"></i>
                    </a>
                </div>
            </div>
            <script type="application/javascript">
                ( function ( $ ) {
                    'use strict';
                    $( document ).ready( function () {
                        if ( $().flexslider ) {
                            $( '#rhea-ultra-main-slider-<?php echo esc_html( $this->get_id() );?>' ).flexslider( {
                                animation          : "fade",
                                slideshowSpeed     : 7000,
                                animationSpeed     : 1500,
                                slideshow          : true,
                                controlNav         : false,
                                keyboardNav        : true,
                                directionNav       : true,
                                pauseOnHover       : true,
                                customDirectionNav : $( '#rhea-ultra-main-slider-nav-<?php echo esc_html( $widget_id ); ?> .nav-buttons' ),
                                start              : function ( slider ) {
                                    slider.removeClass( 'loading' );
                                }
                            } );
                        }
                    } );
                } )( jQuery );
            </script>
			<?php
		}
	}
}
