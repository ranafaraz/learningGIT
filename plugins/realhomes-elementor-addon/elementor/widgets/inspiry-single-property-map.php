<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Single_Property_Map_Widget extends \Elementor\Widget_Base {
    private $map_service;

	public function __construct( array $data = [], array $args = null ) {
		parent::__construct( $data, $args );
		$this->map_service = function_exists( 'inspiry_get_maps_type' ) ? inspiry_get_maps_type() : '';
	}

	public function get_name() {
		return 'rhea-single-property-map-widget';
	}

	public function get_title() {
		return esc_html__( 'Single Property Map', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-google-maps';
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	public function get_keywords() {
		return [ 'google', 'map', 'embed', 'location' ];
	}

	public function get_style_depends() {

		$return      = array();

		wp_register_style(
			'rhea-mapbox-single-style',
			'https://api.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css',
			array(),
			'2.9.2'
		);

		wp_register_style(
			'leaflet',
			'https://unpkg.com/leaflet@1.3.4/dist/leaflet.css',
			array(),
			'1.3.4'
		);

		if ( $this->map_service == 'googlemap' && ! empty( get_option( 'inspiry_google_maps_api_key', '' ) ) ) {

			$return = false;

		} else if ( $this->map_service == 'mapbox' && ! empty( get_option( 'ere_mapbox_api_key', '' ) ) ) {

			$return[] = 'rhea-mapbox-single-style';

		} else {

			$return[] = 'leaflet';

		}

		return $return;

	}

	public function get_script_depends() {

		$return      = array();

		// default map query arguments
		$google_map_arguments = array();

		// Google Map API.
		wp_register_script(
			'google-map-api',
			esc_url_raw(
				add_query_arg(
					apply_filters(
						'inspiry_google_map_arguments',
						$google_map_arguments
					),
					'//maps.google.com/maps/api/js'
				)
			),
			array(),
			false,
			true
		);

		wp_register_script(
			'leaflet-js',
			'https://unpkg.com/leaflet@1.3.4/dist/leaflet.js',
			array(),
			'1.3.4',
			true
		);

		wp_register_script(
			'mapbox-script-2-9-2',
			'https://api.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.js',
			array(),
			'2.9.2',
			true
		);

		wp_register_script(
			'rhea-single-property-map',
			RHEA_PLUGIN_URL . 'elementor/js/single-property-map.js',
			[ 'elementor-frontend' ],
			RHEA_VERSION,
			true
		);

		if ( $this->map_service == 'google-maps' && ! empty( get_option( 'inspiry_google_maps_api_key', '' ) ) ) {
			$return[] = 'google-map-api';
		} else if ( $this->map_service == 'mapbox' && ! empty( get_option( 'ere_mapbox_api_key', '' ) ) ) {
			$return[] = 'leaflet-js';
			$return[] = 'mapbox-script-2-9-2';
		} else {
			$return[] = 'leaflet-js';
		}

		$return[] = 'rhea-single-property-map';

		return $return;
	}

	protected function register_controls() {

		// getting the map type
		$google_map_api = get_option( 'inspiry_google_maps_api_key', '' );

		$this->start_controls_section(
			'map_section',
			[
				'label' => esc_html__( 'Map', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'lat',
			[
				'label'       => esc_html__( 'Latitude', 'realhomes-elementor-addon' ),
				'default'     => '27.664827',
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'lng',
			[
				'label'       => esc_html__( 'Longitude', 'realhomes-elementor-addon' ),
				'default'     => '-81.515755',
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true
			]
		);

		$this->add_control(
			'zoom',
			[
				'label'   => esc_html__( 'Zoom', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
				],
				'range'   => [
					'px' => [
						'min' => 5,
						'max' => 20,
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'address_section',
			[
				'label' => esc_html__( 'Address', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_address_section',
			[
				'label'        => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_as_infowindow',
			[
				'label'              => esc_html__( 'Show on Map as InfoWindow', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'          => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value'       => 'yes',
				'default'            => 'no',
				'frontend_available' => true,
				'condition'          => [
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'location_label',
			[
				'label'              => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'default'            => esc_html__( 'Location', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::TEXT,
				'label_block'        => true,
				'frontend_available' => true,
				'condition'          => [
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'contact_number',
			[
				'label'       => esc_html__( 'Phone', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
				'condition'   => [
					'show_as_infowindow'   => '',
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'email_address',
			[
				'label'       => esc_html__( 'Email', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
				'condition'   => [
					'show_as_infowindow'   => '',
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'address',
			[
				'label'              => esc_html__( 'Address', 'realhomes-elementor-addon' ),
				'description'        => esc_html__( 'HTML tags ( a, strong, b, em, i, br ) can be used in Address', 'realhomes-elementor-addon' ),
				'default'            => 'Merrick Way, Miami, <br />FL 33134, USA',
				'type'               => \Elementor\Controls_Manager::TEXTAREA,
				'frontend_available' => true,
				'condition'          => [
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_field_icon',
			[
				'label'        => esc_html__( 'Show Field Icon', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'show_as_infowindow'   => '',
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'field_content_align',
			[
				'label'     => esc_html__( 'Alignment', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-info-inner' => 'text-align: {{VALUE}};',
				],
				'separator' => 'after',
				'condition' => [
					'show_as_infowindow'   => '',
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'background_image',
			[
				'label'     => esc_html__( 'Section Background Image', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'show_as_infowindow'   => '',
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				// Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude'   => [ 'custom' ],
				'default'   => 'full',
				'separator' => 'none',
				'condition' => [
					'show_as_infowindow'   => '',
					'show_address_section' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'map_spaces_section',
			[
				'label' => esc_html__( 'Map', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'swap_column_position',
			[
				'label'        => esc_html__( 'Swap Map Column Position', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'show_as_infowindow'   => '',
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label'     => esc_html__( 'Width', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map' => 'width: {{SIZE}}%;',
				],
				'condition' => [
					'show_as_infowindow'   => '',
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'           => esc_html__( 'Height', 'realhomes-elementor-addon' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'range'           => [
					'px' => [
						'min' => 250,
						'max' => 750,
					],
				],
				'desktop_default' => [
					'size' => 460,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 300,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 250,
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} .rhea-single-property-map' => 'height: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'map_border_radius',
			[
				'label'     => esc_html__( 'Border Radius', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'container_width',
			[
				'label'           => esc_html__( 'Container Width', 'realhomes-elementor-addon' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'range'           => [
					'px' => [
						'min' => 400,
						'max' => 1600,
					],
					'%'  => [
						'min' => 50,
						'max' => 100,
					],
				],
				'desktop_default' => [
					'size' => 1140,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 100,
					'unit' => '%',
				],
				'mobile_default'  => [
					'size' => 100,
					'unit' => '%',
				],
				'size_units'      => [ 'px', '%' ],
				'selectors'       => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'map_marker',
			[
				'label'       => esc_html__( 'Map Marker', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'Recommended image size is 30x50.', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'default'     => [
					'url' => '',
				],
			]
		);

		if ( $this->map_service === 'google-maps' && ! empty( $google_map_api ) ) {

			$this->add_control(
				'map_custom_style',
				[
					'label'              => esc_html__( 'Map Custom Style', 'realhomes-elementor-addon' ),
					'type'               => \Elementor\Controls_Manager::SWITCHER,
					'label_on'           => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
					'label_off'          => esc_html__( 'No', 'realhomes-elementor-addon' ),
					'return_value'       => 'yes',
					'default'            => 'yes',
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'map_color',
				[
					'label'       => esc_html__( 'Map Water Color', 'realhomes-elementor-addon' ),
					'description' => esc_html__( 'It will only be applied if custom styles for google map are not provided.', 'realhomes-elementor-addon' ),
					'type'        => \Elementor\Controls_Manager::COLOR,
					'alpha'       => false,
					'default'     => '#1ea69a'
				]
			);

			$this->add_control(
				'google_map_styles',
				[
					'label'       => esc_html__( 'Google Map Styles', 'realhomes-elementor-addon' ),
					'description' => sprintf( '%s %s', esc_html__( 'Add styling code to implement on google map. Find out the suitable Google Map Style for the widget here!', 'realhomes-elementor-addon' ), '<a href="https://snazzymaps.com/" target="_blank">snazzymaps</a>' ),
					'type'        => \Elementor\Controls_Manager::TEXTAREA,
				]
			);
		}
        
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'map_container_box_shadow',
				'label'    => esc_html__( 'Container Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-single-property-map-wrapper',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'address_section_style',
			[
				'label'     => esc_html__( 'Address', 'realhomes-elementor-addon' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'iw_x_offset',
			[
				'label'              => esc_html__( 'Info Window Horizontal Offset', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'frontend_available' => true,
				'condition'          => [
					'show_as_infowindow'   => 'yes',
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'iw_y_offset',
			[
				'label'              => esc_html__( 'Info Window Vertical Offset', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'frontend_available' => true,
				'condition'          => [
					'show_as_infowindow'   => 'yes',
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'address_section_width',
			[
				'label'     => esc_html__( 'Section Width', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-info' => 'width: {{SIZE}}%;',
				],
				'condition' => [
					'show_as_infowindow'   => '',
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'address_container_bg',
			[
				'label'     => esc_html__( 'Address Wrapper Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-info-inner' => 'background-color: {{VALUE}}',
				],
				'separator' => 'after',
				'condition' => [
					'show_as_infowindow'   => '',
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label'     => esc_html__( 'Title Color ', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-heading, {{WRAPPER}} .rhea-single-property-map-wrapper .rhea-map-infowindow-heading' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'heading_typography',
				'label'     => esc_html__( 'Title Typography', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-heading, {{WRAPPER}} .rhea-single-property-map-wrapper .rhea-map-infowindow-heading',
				'condition' => [
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'heading_margin_bottom',
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
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-heading, {{WRAPPER}} .rhea-single-property-map-wrapper .rhea-map-infowindow-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'phone_color',
			[
				'label'     => esc_html__( 'Phone Color ', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-number a' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
				'condition' => [
					'show_as_infowindow' => '',
				],
			]
		);

		$this->add_control(
			'phone_hover_color',
			[
				'label'     => esc_html__( 'Phone Hover Color ', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-number a:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_as_infowindow' => '',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'phone_typography',
				'label'     => esc_html__( 'Phone Typography', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-number',
				'condition' => [
					'show_as_infowindow' => '',
				],
			]
		);

		$this->add_responsive_control(
			'phone_margin_bottom',
			[
				'label'     => esc_html__( 'Phone Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
				'condition' => [
					'show_as_infowindow' => '',
				],
			]
		);

		$this->add_control(
			'email_color',
			[
				'label'     => esc_html__( 'Email Color ', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-email a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_as_infowindow' => '',
				],
			]
		);

		$this->add_control(
			'email_hover_color',
			[
				'label'     => esc_html__( 'Email Hover Color ', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-email a:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_as_infowindow' => '',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'email_typography',
				'label'     => esc_html__( 'Email Typography', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-email',
				'condition' => [
					'show_as_infowindow' => '',
				],
			]
		);

		$this->add_responsive_control(
			'email_margin_bottom',
			[
				'label'     => esc_html__( 'Email Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-email' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
				'condition' => [
					'show_as_infowindow' => '',
				],
			]
		);

		$this->add_control(
			'address_color',
			[
				'label'     => esc_html__( 'Address Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-address, {{WRAPPER}} .rhea-single-property-map-wrapper .rhea-map-infowindow-address' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_address_section' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'address_typography',
				'label'     => esc_html__( 'Address Typography', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-address, {{WRAPPER}} .rhea-single-property-map-wrapper .rhea-map-infowindow-address',
				'condition' => [
					'show_address_section' => 'yes',
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
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-address' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
				'condition' => [
					'show_as_infowindow' => '',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color ', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper p i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_as_infowindow' => '',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => esc_html__( 'Icon Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper p i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_as_infowindow' => '',
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label'     => esc_html__( 'Icon Spacing', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper p i' => is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_as_infowindow' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings        = $this->get_settings_for_display();
		$widget_id       = $this->get_id();
		$container_class = 'rhea-single-property-map-wrapper';

		$address_section = ( 'yes' === $settings['show_address_section'] && 'yes' !== $settings['show_as_infowindow'] && ( $settings['location_label'] || $settings['address'] ) );
		if ( ! $address_section ) {
			$container_class .= ' rhea-single-property-map-fullwidth';
		}

		if ( 'yes' === $settings['swap_column_position'] ) {
			$container_class .= ' rhea-single-property-map-swap-col';
		}

		$show_field_icon = ( 'yes' === $settings['show_field_icon'] );

		if ( 0 === absint( $settings['zoom']['size'] ) ) {
			$settings['zoom']['size'] = 10;
		}
		$data_attributes = 'data-clear=rhea-single-property-map-wrapper';

		if ( $settings['location_label'] ) {
			$data_attributes .= ' data-label=' . $settings['location_label'];
		}

		$data_attributes .= ' data-lat=' . $settings['lat'];
		$data_attributes .= ' data-long=' . $settings['lng'];
		$data_attributes .= ' data-zoom=' . $settings['zoom']['size'];
		$data_attributes .= ' data-map-type=' . $this->map_service;

		if ( $this->map_service === 'google-maps' ) {
			if ( ! empty( $settings['map_color'] ) ) {
				$data_attributes .= ' data-water-color=' . $settings['map_color'];
			}
			if ( ! empty( $settings['google_map_styles'] ) ) {
				$data_attributes .= ' data-map-style=' . base64_encode( $settings['google_map_styles'] );
			}
		}

		if ( $this->map_service === 'mapbox' ) {
			$mapbox_api   = get_option( 'ere_mapbox_api_key', '' );
			$mapbox_style = get_option( 'ere_mapbox_style', '' );
			if ( ! empty( $mapbox_api ) ) {
				$data_attributes .= ' data-mapbox-api=' . $mapbox_api;
			}
			if ( ! empty( $mapbox_style ) ) {
				$data_attributes .= ' data-mapbox-style=' . $mapbox_style;
			}
		}

		$mapMarker = esc_url( RHEA_PLUGIN_URL . 'assets/icons/map-pin.svg' );
		if ( ! empty( $settings['map_marker']['url'] ) ) {
			$mapMarker = esc_url( $settings['map_marker']['url'] );
		}
		$data_attributes .= ' data-map-marker=' . $mapMarker;
		?>
        <div id="rhea-single-property-map-wrapper-<?php echo esc_attr( $widget_id ); ?>" class="<?php echo esc_attr( $container_class ); ?>" <?php echo esc_attr( $data_attributes ); ?>>
            <div id="rhea-single-property-map-<?php echo esc_attr( $widget_id ); ?>" class="rhea-single-property-map"></div>
			<?php
			if ( $address_section ) {
				?>
                <div class="rhea-single-property-map-info" style="background-image: url('<?php echo esc_url( \Elementor\Group_Control_Image_Size::get_attachment_image_src( $settings['background_image']['id'], 'thumbnail', $settings ) ); ?>');">
                    <div class="rhea-single-property-map-info-inner">
						<?php
						if ( $settings['location_label'] ) { ?>
                            <h4 class="rhea-single-property-map-heading"><?php echo esc_html( $settings['location_label'] ); ?></h4>
							<?php
						}

						if ( ! empty( $settings['contact_number'] ) ) { ?>
                            <p class="rhea-single-property-map-number">
								<?php if ( $show_field_icon ) { ?>
                                    <i class="fas fa-phone-alt"></i>
								<?php } ?>
                                <a href="tel:<?php echo esc_attr( $settings['contact_number'] ); ?>"><?php echo esc_html( $settings['contact_number'] ); ?></a>
                            </p>
							<?php
						}

						if ( ! empty( $settings['email_address'] ) ) { ?>
                            <p class="rhea-single-property-map-email">
								<?php if ( $show_field_icon ) { ?>
                                    <i class="fas fa-envelope"></i>
								<?php } ?>
                                <a href="mailto:<?php echo esc_attr( antispambot( $settings['email_address'] ) ); ?>"><?php echo esc_attr( antispambot( $settings['email_address'] ) ); ?></a>
                            </p>
							<?php
						}

						if ( $settings['address'] ) {
							?>
                            <p class="rhea-single-property-map-address">
								<?php if ( $show_field_icon ) { ?>
                                    <i class="fas fa-map-marker-alt"></i>
									<?php
								}
								echo wp_kses( $settings['address'], array(
									'a'      => array(
										'href'   => array(),
										'title'  => array(),
										'alt'    => array(),
										'target' => array(),
									),
									'br'     => array(),
									'i'      => array(
										'class' => array(),
									),
									'em'     => array(),
									'b'      => array(),
									'strong' => array(),
								) );
								?>
                            </p>
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
	}
}
