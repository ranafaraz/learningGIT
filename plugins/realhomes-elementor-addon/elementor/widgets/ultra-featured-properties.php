<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Featured_Properties extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-featured-properties';
	}

	public function get_title() {
		return esc_html__( 'Ultra Featured Properties', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'ultra-real-homes' ];
	}

	protected function register_controls() {
		$allowed_html = array(
			'a'      => array(
				'href'  => array(),
				'title' => array()
			),
			'br'     => array(),
			'em'     => array(),
			'strong' => array(),
		);

		$this->start_controls_section(
			'featured_properties_ultra',
			[
				'label' => esc_html__( 'Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default'  => esc_html__( 'Default', 'realhomes-elementor-addon' ),
					'carousel' => esc_html__( 'Carousel', 'realhomes-elementor-addon' ),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'number_of_properties',
			[
				'label'   => esc_html__( 'Number of Properties', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 50,
				'step'    => 1,
				'default' => 5,
			]
		);

		$this->add_control(
			'featured_excerpt_length',
			[
				'label'     => esc_html__( 'Excerpt Length (Words)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 5,
				'max'       => 100,
				'default'   => 15,
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'date'       => esc_html__( 'Date', 'realhomes-elementor-addon' ),
					'price'      => esc_html__( 'Price', 'realhomes-elementor-addon' ),
					'title'      => esc_html__( 'Title', 'realhomes-elementor-addon' ),
					'menu_order' => esc_html__( 'Menu Order', 'realhomes-elementor-addon' ),
					'rand'       => esc_html__( 'Random', 'realhomes-elementor-addon' ),
				],
				'default' => 'date',
			]
		);

		$this->add_control(
			'show_filters',
			[
				'label'        => esc_html__( 'Show Filters', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'show_address',
			[
				'label'        => esc_html__( 'Show Address', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				// Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default'   => 'modern-property-child-slider',
				'separator' => 'none',
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'ere_show_property_status',
			[
				'label'        => esc_html__( 'Show Property Status', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'ere_show_featured_tag',
			[
				'label'        => esc_html__( 'Show Featured Tag', 'realhomes-elementor-addon' ),
				'description'  => wp_kses( __( 'Show if property is set to featured', 'realhomes-elementor-addon' ), $allowed_html ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'ere_show_label_tags',
			[
				'label'        => esc_html__( 'Show Property Label Tag', 'realhomes-elementor-addon' ),
				'description'  => wp_kses( __( 'Show if property label text is set', 'realhomes-elementor-addon' ), $allowed_html ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'ere_show_property_media_count',
			[
				'label'        => esc_html__( 'Show Property Media Count', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'style' => 'default',
				],
			]
		);


		$this->add_control(
			'ere_enable_fav_properties',
			[
				'label'        => esc_html__( 'Show Add To Favourite Button', 'realhomes-elementor-addon' ),
				'description'  => wp_kses( __( '<strong>Important:</strong> Make sure to select <strong>Show</strong> in Customizer <strong>Favorites</strong> settings. ', 'realhomes-elementor-addon' ), $allowed_html ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'ere_enable_compare_properties',
			[
				'label'        => esc_html__( 'Show Add To Compare Button  ', 'realhomes-elementor-addon' ),
				'description'  => wp_kses( __( '<strong>Important:</strong> Make sure <strong>Compare Properties</strong> is <strong>enabled</strong> in Customizer settings. ', 'realhomes-elementor-addon' ), $allowed_html ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'adress_icon_type',
			[
				'label'     => esc_html__( 'Select Address Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'none'  => esc_html__( 'None', 'realhomes-elementor-addon' ),
					'image' => esc_html__( 'Image', 'realhomes-elementor-addon' ),
					'Icon'  => esc_html__( 'Icon', 'realhomes-elementor-addon' ),
				],
				'default'   => 'none',
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'address_image',
			[
				'label'     => esc_html__( 'Choose Image', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'adress_icon_type' => 'image',
				],
			]
		);

		$this->add_responsive_control(
			'Image_icon_size',
			[
				'label' => esc_html__( 'Image Icon Size', 'realhomes-elementor-addon' ),

				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-image-icon' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'adress_icon_type' => 'image',
				],
			]
		);

		$this->add_control(
			'address_icon',
			[
				'label'     => esc_html__( 'Add Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => [
					'adress_icon_type' => 'Icon',
				],
			]
		);

		$this->add_responsive_control(
			'font_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'realhomes-elementor-addon' ),

				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rhea-ultra-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'adress_icon_type' => 'Icon',
				],
			]
		);

		$this->add_control(
			'font_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-icon i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-icon svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'adress_icon_type' => 'Icon',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'ere_properties_labels',
			[
				'label'     => esc_html__( 'Property Labels', 'realhomes-elementor-addon' ),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'style' => 'default',
				],
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
			'property_build_label',
			[
				'label'   => esc_html__( 'Build', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Build', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'ere_property_fav_label',
			[
				'label'   => esc_html__( 'Add To Favourite', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Add To Favourite', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'ere_property_fav_added_label',
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

		$this->end_controls_section();


		$this->start_controls_section(
			'ere_properties_meta_settings',
			[
				'label' => esc_html__( 'Meta Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
			$get_meta = array(
				'bedrooms'   => esc_html__( 'Bedrooms', 'realhomes-elementor-addon' ),
				'bathrooms'  => esc_html__( 'Bathrooms', 'realhomes-elementor-addon' ),
				'area'       => esc_html__( 'Area', 'realhomes-elementor-addon' ),
				'garage'     => esc_html__( 'Garages/Parking', 'realhomes-elementor-addon' ),
				'year-built' => esc_html__( 'Year Built', 'realhomes-elementor-addon' ),
				'lot-size'   => esc_html__( 'Lot Size', 'realhomes-elementor-addon' ),
				'guests'     => esc_html__( 'Guests Capacity', 'realhomes-elementor-addon' ),
				'min-stay'   => esc_html__( 'Min Stay', 'realhomes-elementor-addon' ),
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
					'rhea_property_meta_display' => 'guests',
					'rhea_meta_repeater_label'   => esc_html__( 'Guests', 'realhomes-elementor-addon' ),
				),
				array(
					'rhea_property_meta_display' => 'area',
					'rhea_meta_repeater_label'   => esc_html__( 'Area', 'realhomes-elementor-addon' ),
				),
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
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'featured_typography',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'property_top_tags_typography',
				'label'     => esc_html__( 'Top Tags', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-ultra-status-box span,{{WRAPPER}} .rhea-ultra-status-box a',
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'build_typography',
				'label'     => esc_html__( 'Year Build', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-ultra-featured-year-build',
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'filters_typography',
				'label'     => esc_html__( 'Filters', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-featured-properties-filters li',
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Property Title', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-property-title a, {{WRAPPER}}  .rhea-featured-properties-property-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'address_typography',
				'label'    => esc_html__( 'Address', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea_address_ultra a, {{WRAPPER}} .rhea-featured-properties-property-address',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'meta_typography',
				'label'     => esc_html__( 'Meta', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-featured-properties-property .rhea_ultra_meta_box .figure, {{WRAPPER}} .rhea-featured-properties-property .rhea_ultra_meta_box .label',
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'address_pin_size',
			[
				'label' => esc_html__( 'Address Pin Size', 'realhomes-elementor-addon' ),

				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_address_pin' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'property_price_prefix_typography',
				'label'     => esc_html__( 'Price Prefix (i.e From)', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-prefix',
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_price_typography',
				'label'    => esc_html__( 'Price', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-display, {{WRAPPER}} p.rh_prop_card__price_ultra .property-current-price, {{WRAPPER}} .rhea-featured-properties-property-price, {{WRAPPER}} .rhea-featured-properties-property .ere-price-display',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'property_old_price_typography',
				'label'     => esc_html__( 'Old Price', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} p.rh_prop_card__price_ultra .property-old-price',
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'property_price_postfix_typography',
				'label'     => esc_html__( 'Price Postfix (i.e Monthly)', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-postfix, {{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-slash',
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'link_button_typography',
				'label'     => esc_html__( 'Button', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-featured-properties-property-link',
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'excerpt_typography',
				'label'     => esc_html__( 'Excerpt', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-ultra-fp-excerpt',
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'slides_counter_typography',
				'label'     => esc_html__( 'Slides Counter', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-ultra-thumb-count .rhea-slider-item-total',
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'slides_more_typography',
				'label'     => esc_html__( 'More slides', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-ultra-thumb-count .rhea-more-slides',
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ere_property_basic_styles',
			[
				'label' => esc_html__( 'Basic Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			],
		);

		$this->add_responsive_control(
			'filters_padding',
			[
				'label'      => esc_html__( 'Filters Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-featured-properties-filters li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'filters_margin_bottom',
			[
				'label'     => esc_html__( 'Filters Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-featured-properties-filters' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'property_card_border_radius',
			[
				'label'      => esc_html__( 'Property Card Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-featured-properties-property, {{WRAPPER}} .rhea-featured-properties-carousel-inner .slick-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'property_card_padding',
			[
				'label'      => esc_html__( 'Property Card Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-featured-properties-property' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'featured_border_radius',
			[
				'label'      => esc_html__( 'Featured Image Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-featured-thumbs, {{WRAPPER}} .rhea-featured-properties-property-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'property_card_content_padding',
			[
				'label'      => esc_html__( 'Property Card Content Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-featured-properties-property-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'meta_border_radius',
			[
				'label'      => esc_html__( 'Meta Icon Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-featred-properties .rhea_ultra_prop_card__meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'top_tag_border_radius',
			[
				'label'      => esc_html__( 'Top Tags Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-status-box span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'slider_thumb_border_radius',
			[
				'label'      => esc_html__( 'Slider Thumnails Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-carousel-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin_top',
			[
				'label'     => esc_html__( 'Title Margin Top', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin_bottom',
			[
				'label'     => esc_html__( 'Title Margin bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-title, {{WRAPPER}} .rhea-featured-properties-property-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'address_margin_bottom',
			[
				'label'     => esc_html__( 'Address Margin bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea_address_ultra, {{WRAPPER}} .rhea-featured-properties-property-address' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'meta_margin_bottom',
			[
				'label'     => esc_html__( 'Meta Margin bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_prop_card_meta_wrap_ultra, {{WRAPPER}} .rhea-featured-properties-property .rh_prop_card_meta_wrap_ultra' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'price_margin_bottom',
			[
				'label'     => esc_html__( 'Price Margin bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_prop_card__price_ultra' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'main_slider_margin_bottom',
			[
				'label'     => esc_html__( 'Space Between Slider and Thumnails', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-featured-thumb-slider' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => esc_html__( 'Button Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-featured-properties-property-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label'      => esc_html__( 'Button Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-featured-properties-property-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_radius',
			[
				'label'      => esc_html__( 'Slider Nav Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-featured-properties-carousel-inner .rhea-properties-carousel-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'carousel',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'top_tags_color',
			[
				'label'     => esc_html__( 'Top Tags Colors', 'realhomes-elementor-addon' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_property_status_background',
			[
				'label'     => esc_html__( 'Status Tag Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea-ultra-status' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_status_background_hover',
			[
				'label'     => esc_html__( 'Status Tag Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea-ultra-status:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_status_border_color',
			[
				'label'     => esc_html__( 'Status Tag Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea-ultra-status' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_status_border_hover_color',
			[
				'label'     => esc_html__( 'Status Tag Border Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea-ultra-status:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_status_text_color',
			[
				'label'     => esc_html__( 'Status Tag Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea-ultra-status' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_status_text_hover_color',
			[
				'label'     => esc_html__( 'Status Tag Text Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea-ultra-status:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_featured_background',
			[
				'label'     => esc_html__( 'Featured Tag Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_featured' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_featured_background_hover',
			[
				'label'     => esc_html__( 'Featured Tag Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_featured:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_featured_border',
			[
				'label'     => esc_html__( 'Featured Tag Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_featured' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_featured_border_hover',
			[
				'label'     => esc_html__( 'Featured Tag Border Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_featured:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_featured_color',
			[
				'label'     => esc_html__( 'Featured Tag Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_featured' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_featured_color_hover',
			[
				'label'     => esc_html__( 'Featured Tag Text Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_featured:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_label_background',
			[
				'label'     => esc_html__( 'Label Tag Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_hot' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_label_background_hover',
			[
				'label'     => esc_html__( 'Label Tag Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_hot:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_label_border',
			[
				'label'     => esc_html__( 'Label Tag Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_hot' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_label_border_hover',
			[
				'label'     => esc_html__( 'Label Tag Border Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_hot:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_label_color',
			[
				'label'     => esc_html__( 'Label Tag Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_hot' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_label_color_hover',
			[
				'label'     => esc_html__( 'Label Tag Text Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_hot:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_media_background',
			[
				'label'     => esc_html__( 'Media Count Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_media_count .rhea_media' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_media_background_hover',
			[
				'label'     => esc_html__( 'Media Count Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_media_count .rhea_media:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_media_text',
			[
				'label'     => esc_html__( 'Media Count Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_media_count .rhea_media span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea_ultra_media_count svg'              => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_media_text_hover',
			[
				'label'     => esc_html__( 'Media Count Text Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_media_count .rhea_media:hover span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea_ultra_media_count .rhea_media:hover svg'  => 'fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ere_property_color',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rhea_tooltip-bg-color',
			[
				'label'     => esc_html__( 'ToolTip Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-tooltip [data-tooltip]::before' => 'border-top-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-tooltip [data-tooltip]::after'  => 'background: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_tooltip-text-color',
			[
				'label'     => esc_html__( 'ToolTip Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-tooltip [data-tooltip]::after' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_favourite_compare_bg',
			[
				'label'     => esc_html__( 'Favourite/Compare Button Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .favorite-btn-wrap a'     => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-bottom-box .favorite-btn-wrap span'  => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-bottom-box .rhea_compare_icons a'    => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-bottom-box .rhea_compare_icons span' => 'background: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_favourite_compare_icon_dark',
			[
				'label'     => esc_html__( 'Favourite/Compare Button Icon Outline', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .favorite-btn-wrap a .rh-ultra-dark'  => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-bottom-box .rhea_compare_icons a .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_favourite_compare_icon_light',
			[
				'label'     => esc_html__( 'Favourite/Compare Button Inner', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .favorite-btn-wrap a .rh-ultra-light'  => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-bottom-box .rhea_compare_icons a .rh-ultra-light' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_favourite_added_bg',
			[
				'label'     => esc_html__( 'Favourite Added Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .favorite-btn-wrap span' => 'background: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_favourite_added_icon_dark',
			[
				'label'     => esc_html__( 'Favourite Added Icon Outline', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .favorite-btn-wrap span .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_favourite_added_icon_light',
			[
				'label'     => esc_html__( 'Favourite Added Icon Inner', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .favorite-btn-wrap span .rh-ultra-light' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_compare_added_bg',
			[
				'label'     => esc_html__( 'Compare Added Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .rhea_compare_icons span' => 'background: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);


		$this->add_control(
			'rhea_compare_added_icon_dark',
			[
				'label'     => esc_html__( 'Compare Added Icon Outline', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .rhea_compare_icons span .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);
		$this->add_control(
			'rhea_compare_added_icon_light',
			[
				'label'     => esc_html__( 'Compare Added Icon Inner', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .rhea_compare_icons span .rh-ultra-light' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'filters_color',
			[
				'label'     => esc_html__( 'Filters Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-featured-properties-filters li' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'filters_hover_color',
			[
				'label'     => esc_html__( 'Filters Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-featured-properties-filters li:hover, {{WRAPPER}} .rhea-featured-properties-filters li.active' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'filters_bottom_border_color',
			[
				'label'     => esc_html__( 'Filters Bottom Border Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-featured-properties-filters' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'property_card_bg_color',
			[
				'label'     => esc_html__( 'Property Card Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-featured-properties-property' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'rhea_title_color',
			[
				'label'     => esc_html__( 'Property Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-title a, {{WRAPPER}} .rhea-featured-properties-property-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_title_color_hover',
			[
				'label'     => esc_html__( 'Property Title Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-title a:hover, {{WRAPPER}} .rhea-featured-properties-property-title a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_address_text_color',
			[
				'label'     => esc_html__( 'Address', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_address_ultra a, {{WRAPPER}} .rhea-featured-properties-property-address' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea_address_ultra a .rhea_ultra_address_pin svg'                             => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_address_text_hover_color',
			[
				'label'     => esc_html__( 'Address Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_address_ultra a:hover'                             => 'color: {{VALUE}}',
					'{{WRAPPER}} a:hover .rhea-featured-properties-property-address'      => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea_address_ultra a:hover .rhea_ultra_address_pin svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_meta_bg',
			[
				'label'     => esc_html__( 'Meta Icons Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_prop_card__meta' => 'background: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_meta_icon_color',
			[
				'label'     => esc_html__( 'Meta Icons', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ultra-meta' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_meta_figure_color',
			[
				'label'     => esc_html__( 'Meta Figures', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_meta_box .figure' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_meta_figure_postfix_color',
			[
				'label'     => esc_html__( 'Meta Figures postfix (i.e sqft)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_meta_box .label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_price_text_color',
			[
				'label'     => esc_html__( 'Price', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} p.rh_prop_card__price_ultra .property-current-price'                                                         => 'color: {{VALUE}}',
					'{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-display'                                                              => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-featured-properties-property-price, {{WRAPPER}} .rhea-featured-properties-property .ere-price-display' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_price_prefix_color',
			[
				'label'     => esc_html__( 'Price Prefix (i.e From)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-prefix' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_price_postfix_color',
			[
				'label'     => esc_html__( 'Price Postfix (i.e Monthly)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-postfix' => 'color: {{VALUE}}',
					'{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-slash'   => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_old_price_color',
			[
				'label'     => esc_html__( 'Old Price', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} p.rh_prop_card__price_ultra .property-old-price' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_excerpt_color',
			[
				'label'     => esc_html__( 'Excerpt', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-fp-excerpt' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_slider_thumb_line',
			[
				'label'     => esc_html__( 'Current Thumbnail Bottom Line', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .slick-current .rhea-ultra-carousel-thumb-inner::after' => 'background: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_slider_counter_bg',
			[
				'label'     => esc_html__( 'Slides Counter Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-thumb-count' => 'background: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'rhea_slider_counter_text_color',
			[
				'label'     => esc_html__( 'Slides Counter Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-thumb-count svg'                     => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-thumb-count .rhea-slider-item-total' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-thumb-count .rhea-more-slides'       => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => esc_html__( 'Button Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-featured-properties-property-link' => 'border-color: {{VALUE}}; color: {{VALUE}}; background-color: transparent;',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => esc_html__( 'Button Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-featured-properties-property-link:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label'     => esc_html__( 'Button Hover Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-featured-properties-property-link:hover' => 'border-color: {{VALUE}}; background-color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'slider_nav_color',
			[
				'label'     => esc_html__( 'Slider Nav Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-featured-properties-carousel-inner .rhea-properties-carousel-nav' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'slider_nav_hover_color',
			[
				'label'     => esc_html__( 'Slider Nav Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-featured-properties-carousel-inner .rhea-properties-carousel-nav:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'slider_nav_border_color',
			[
				'label'     => esc_html__( 'Slider Nav Border Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-featured-properties-carousel-inner .rhea-properties-carousel-nav' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'slider_nav_border_hover_color',
			[
				'label'     => esc_html__( 'Slider Nav Border Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-featured-properties-carousel-inner .rhea-properties-carousel-nav:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'slider_nav_bg_color',
			[
				'label'     => esc_html__( 'Slider Nav Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-featured-properties-carousel-inner .rhea-properties-carousel-nav' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'slider_nav_bg_hover_color',
			[
				'label'     => esc_html__( 'Slider Nav Background Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-featured-properties-carousel-inner .rhea-properties-carousel-nav:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ere_property_box_shadow',
			[
				'label'     => esc_html__( 'Box Shadow', 'realhomes-elementor-addon' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow_featured_image',
				'label'    => esc_html__( 'Featured Image Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-ultra-featured-thumbs',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow_meta_icons',
				'label'    => esc_html__( 'Meta Icons Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea_ultra_prop_card__meta',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow_thumbs',
				'label'    => esc_html__( 'Slider Thumbnails Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-ultra-carousel-thumb-inner a, {{WRAPPER}} .rhea-ultra-thumb-count',

			]
		);


		$this->end_controls_section();
	}

	protected function render() {
		global $settings, $widget_id, $featured_properties_query;

		$widget_id = $this->get_id();
		$settings  = $this->get_settings_for_display();

		// Number of Properties
		if ( ! empty( $settings['number_of_properties'] ) ) {
			$properties_to_show = $settings['number_of_properties'];
		} else {
			$properties_to_show = 5;
		}
		// Featured Properties Query Arguments.
		$featured_properties_args = array(
			'post_type'      => 'property',
			'post_status'    => 'publish',
			'posts_per_page' => $properties_to_show,
			'meta_query'     => array(
				array(
					'key'     => 'REAL_HOMES_featured',
					'value'   => 1,
					'compare' => '=',
					'type'    => 'NUMERIC',
				),
			),
		);

		if ( 'price' === $settings['orderby'] ) {
			$featured_properties_args['orderby']  = 'meta_value_num';
			$featured_properties_args['meta_key'] = 'REAL_HOMES_property_price';
		} else {
			// for date, title, menu_order and rand
			$featured_properties_args['orderby'] = $settings['orderby'];
		}

		$featured_properties_query = new WP_Query( apply_filters( 'rhea_modern_featured_properties_widget', $featured_properties_args ) );

		if ( $featured_properties_query->have_posts() ) {
			if ( 'carousel' === $settings['style'] ) {
				rhea_get_template_part( 'elementor/widgets/featured-properties-widget/carousel' );
			} else {
				rhea_get_template_part( 'elementor/widgets/featured-properties-widget/default' );
			}
		}
	}
}
