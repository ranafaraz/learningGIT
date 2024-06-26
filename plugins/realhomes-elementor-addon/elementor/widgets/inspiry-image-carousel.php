<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Image_Carousel_Widget extends \Elementor\Widget_Base {

	public function __construct( array $data = [], array $args = null ) {
		parent::__construct( $data, $args );
		wp_enqueue_script( 'jquery-slick' );
	}

	public function get_name() {
		return 'inspiry-image-carousel-widget';
	}

	public function get_title() {
		return esc_html__( 'Image Carousel :: RealHomes', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_keywords() {
		return [ 'image', 'photo', 'visual', 'carousel', 'slider' ];
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_image_carousel',
			[
				'label' => esc_html__( 'Image Carousel', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default (Only Images)', 'realhomes-elementor-addon' ),
					'style-2' => esc_html__( 'Carousel With Info', 'realhomes-elementor-addon' ),
				],
				'default' => 'default',
			]
		);


		$this->add_control(
			'carousel',
			[
				'label'      => esc_html__( 'Add Images', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::GALLERY,
				'default'    => [],
				'show_label' => false,
				'condition'  => [
					'style' => 'default',
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => esc_html__( 'Image', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'label-bold',
			[
				'label' => esc_html__( 'Label Bold', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'label',
			[
				'label' => esc_html__( 'Label Thin', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'slide_url',
			[
				'label'         => esc_html__( 'URL', 'realhomes-elementor-addon' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'realhomes-elementor-addon' ),
				'show_external' => true,
				'default'       => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);

		$this->add_control(
			'rhea_carousel_style_2',
			[
				'label'       => esc_html__( 'Add Slide', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => ' {{{ title }}}',
				'condition'   => [
					'style' => 'style-2',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'partners-logo',
				'separator' => 'none',
				'condition' => [
					'style' => 'default',
				],
			]
		);


		$slides_to_show = array(
			''   => esc_html__( 'Default', 'realhomes-elementor-addon' ),
			'1'  => 1,
			'2'  => 2,
			'3'  => 3,
			'4'  => 4,
			'5'  => 5,
			'6'  => 6,
			'7'  => 7,
			'8'  => 8,
			'9'  => 9,
			'10' => 10,
		);

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'              => esc_html__( 'Slides to Show', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::SELECT,
				'options'            => $slides_to_show,
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label'              => esc_html__( 'Slides to Scroll', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::SELECT,
				'description'        => esc_html__( 'Set how many slides are scrolled per swipe.', 'realhomes-elementor-addon' ),
				'options'            => $slides_to_show,
				'condition'          => [
					'slides_to_show!' => '1',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'image_stretch',
			[
				'label'   => esc_html__( 'Image Stretch', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'no'  => esc_html__( 'No', 'realhomes-elementor-addon' ),
					'yes' => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				],
			]
		);

		$this->add_control(
			'link_to',
			[
				'label'   => esc_html__( 'Link', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'   => esc_html__( 'None', 'realhomes-elementor-addon' ),
					'file'   => esc_html__( 'Media File', 'realhomes-elementor-addon' ),
					'custom' => esc_html__( 'Custom URL', 'realhomes-elementor-addon' ),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'realhomes-elementor-addon' ),
				'condition'   => [
					'link_to' => 'custom',
				],
				'show_label'  => false,
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'label'     => esc_html__( 'Lightbox', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default' => esc_html__( 'Default', 'realhomes-elementor-addon' ),
					'yes'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
					'no'      => esc_html__( 'No', 'realhomes-elementor-addon' ),
				],
				'condition' => [
					'link_to' => 'file',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'settings',
			[
				'label' => esc_html__( 'Additional Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'effect',
			[
				'label'              => esc_html__( 'Effect', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::SELECT,
				'default'            => 'slide',
				'options'            => [
					'slide' => esc_html__( 'Slide', 'realhomes-elementor-addon' ),
					'fade'  => esc_html__( 'Fade', 'realhomes-elementor-addon' ),
				],
				'condition'          => [
					'slides_to_show' => '1',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'              => esc_html__( 'Autoplay', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::SELECT,
				'default'            => 'yes',
				'options'            => [
					'yes' => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
					'no'  => esc_html__( 'No', 'realhomes-elementor-addon' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'              => esc_html__( 'Pause on Hover', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::SELECT,
				'default'            => 'yes',
				'options'            => [
					'yes' => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
					'no'  => esc_html__( 'No', 'realhomes-elementor-addon' ),
				],
				'condition'          => [
					'autoplay' => 'yes',
				],
				'render_type'        => 'none',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'pause_on_interaction',
			[
				'label'              => esc_html__( 'Pause on Interaction', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::SELECT,
				'default'            => 'yes',
				'options'            => [
					'yes' => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
					'no'  => esc_html__( 'No', 'realhomes-elementor-addon' ),
				],
				'condition'          => [
					'autoplay' => 'yes',
				],
				'frontend_available' => true,
			]
		);

		// Loop requires a re-render so no 'render_type = none'
		$this->add_control(
			'infinite',
			[
				'label'              => esc_html__( 'Infinite Loop', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::SELECT,
				'default'            => 'yes',
				'options'            => [
					'yes' => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
					'no'  => esc_html__( 'No', 'realhomes-elementor-addon' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'              => esc_html__( 'Autoplay Speed', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::NUMBER,
				'default'            => 3000,
				'condition'          => [
					'autoplay' => 'yes',
				],
				'render_type'        => 'none',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'speed',
			[
				'label'              => esc_html__( 'Animation Speed', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::NUMBER,
				'default'            => 500,
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_carousel',
			[
				'label' => esc_html__( 'Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_carousel_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-image-carousel-wrapper .rhea-image-carousel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rhea-carousel-content-inner'                      => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-carousel-content-inner .title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'style-2',
				],
			]
		);

		$this->add_control(
			'label-color',
			[
				'label'     => esc_html__( 'Label Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-carousel-content-inner .label span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'style-2',
				],
			]
		);

		$this->add_control(
			'label_background',
			[
				'label'     => esc_html__( 'Label Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-carousel-content-inner .label' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'style-2',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'carousel_typography',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography',
				'label'     => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-carousel-content-inner .title',
				'condition' => [
					'style' => 'style-2',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'strong_text_typography',
				'label'     => esc_html__( 'Label Bold', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-carousel-content-inner .label .bold',
				'condition' => [
					'style' => 'style-2',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'light_text_typography',
				'label'     => esc_html__( 'Label Thin', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-carousel-content-inner .label .light',
				'condition' => [
					'style' => 'style-2',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_navigation',
			[
				'label' => esc_html__( 'Navigation', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'              => esc_html__( 'Type', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::SELECT,
				'default'            => 'dots',
				'options'            => [
					'both'   => esc_html__( 'Arrows and Dots', 'realhomes-elementor-addon' ),
					'arrows' => esc_html__( 'Arrows', 'realhomes-elementor-addon' ),
					'dots'   => esc_html__( 'Dots', 'realhomes-elementor-addon' ),
					'none'   => esc_html__( 'None', 'realhomes-elementor-addon' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'arrows_navigation_heading',
			[
				'label'     => esc_html__( 'Arrows Navigation', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_navigation_wrapper_width',
			[
				'label'     => esc_html__( 'Wrapper Width', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default' => esc_html__( 'Default', 'realhomes-elementor-addon' ),
					'inline'  => esc_html__( 'Inline (auto)', 'realhomes-elementor-addon' ),
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_align',
			[
				'label'     => esc_html__( 'Horizontal Alignment', 'realhomes-elementor-addon' ),
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
				'condition' => [
					'arrows_navigation_wrapper_width' => 'inline',
				],
			]
		);

		$this->add_control(
			'arrows_vertical_align',
			[
				'label'     => esc_html__( 'Vertical Alignment', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'top'    => [
						'title' => esc_html__( 'Top', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__( 'Middle', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default'   => 'middle',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_margin',
			[
				'label'      => esc_html__( 'Slider Nav Control Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-image-carousel-button-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_column_gap',
			[
				'label'     => esc_html__( 'Slider Nav Controls Gap', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-image-carousel-button-wrapper' => 'column-gap: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_border_radius',
			[
				'label'     => esc_html__( 'Slider Nav Border Radius', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-image-carousel-button-wrapper .rhea-image-carousel-button' => 'border-radius: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_control(
			'navigation_previous_icon',
			[
				'label'            => esc_html__( 'Previous Arrow Icon', 'realhomes-elementor-addon' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
				'skin_settings'    => [
					'inline' => [
						'none' => [
							'label' => 'Default',
							'icon'  => '',
						],
						'icon' => [
							'icon' => 'eicon-star',
						],
					],
				],
				'recommended'      => [
					'fa-regular' => [
						'arrow-alt-circle-left',
						'caret-square-left',
					],
					'fa-solid'   => [
						'angle-double-left',
						'angle-left',
						'arrow-alt-circle-left',
						'arrow-circle-left',
						'arrow-left',
						'caret-left',
						'caret-square-left',
						'chevron-circle-left',
						'chevron-left',
						'long-arrow-alt-left',
					],
				],
				'conditions'       => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'navigation',
							'operator' => '=',
							'value'    => 'both',
						],
						[
							'name'     => 'navigation',
							'operator' => '=',
							'value'    => 'arrows',
						],
					],
				],
			]
		);

		$this->add_control(
			'navigation_next_icon',
			[
				'label'            => esc_html__( 'Next Arrow Icon', 'realhomes-elementor-addon' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
				'skin_settings'    => [
					'inline' => [
						'none' => [
							'label' => 'Default',
							'icon'  => '',
						],
						'icon' => [
							'icon' => 'eicon-star',
						],
					],
				],
				'recommended'      => [
					'fa-regular' => [
						'arrow-alt-circle-right',
						'caret-square-right',
					],
					'fa-solid'   => [
						'angle-double-right',
						'angle-right',
						'arrow-alt-circle-right',
						'arrow-circle-right',
						'arrow-right',
						'caret-right',
						'caret-square-right',
						'chevron-circle-right',
						'chevron-right',
						'long-arrow-alt-right',
					],
				],
				'conditions'       => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'navigation',
							'operator' => '=',
							'value'    => 'both',
						],
						[
							'name'     => 'navigation',
							'operator' => '=',
							'value'    => 'arrows',
						],
					],
				],
			]
		);

		$this->add_control(
			'buttons_color',
			[
				'label'     => esc_html__( 'Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-image-carousel-button i'                                                 => 'color: {{VALUE}};',
					'{{WRAPPER}} .rhea-image-carousel-button svg, {{WRAPPER}} .rhea-image-carousel-button path' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'buttons_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-image-carousel-button:hover i'                                                       => 'color: {{VALUE}};',
					'{{WRAPPER}} .rhea-image-carousel-button:hover svg, {{WRAPPER}} .rhea-image-carousel-button:hover path' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'buttons_bg_color',
			[
				'label'     => esc_html__( 'Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-image-carousel-button' => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'buttons_hover_bg_color',
			[
				'label'     => esc_html__( 'Hover Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-image-carousel-button:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'buttons_icon_size',
			[
				'label'     => esc_html__( 'Icon Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 6,
						'max' => 24,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-image-carousel-button'     => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rhea-image-carousel-button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'buttons_size',
			[
				'label'     => esc_html__( 'Button Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 24,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-image-carousel-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_navigation_heading',
			[
				'label'     => esc_html__( 'Dots Navigation', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_align',
			[
				'label'     => esc_html__( 'Alignment', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .rhea-image-carousel .slick-dots' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => esc_html__( 'Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-image-carousel .slick-dots li button' => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-image-carousel .slick-dots li.slick-active button' => 'background: {{VALUE}};',
					'{{WRAPPER}} .rhea-image-carousel .slick-dots li:hover button'        => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label'     => esc_html__( 'Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 6,
						'max' => 24,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-image-carousel .slick-dots li button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$widget_id = $this->get_id();
		$link_to   = $this->get_link_url( $settings );

		$container_classes = array( 'rhea-image-carousel' );
		if ( 'yes' === $settings['image_stretch'] ) {
			$container_classes[] = 'rhea-stretch-carousel-image';
		}

		$navigation_alignment_classes = '';
		if ( $settings['arrows_vertical_align'] ) {
			$navigation_alignment_classes .= 'rhea-image-carousel-arrows-vertical-' . $settings['arrows_vertical_align'];
		}

		if ( $settings['arrows_align'] ) {
			$navigation_alignment_classes .= ' rhea-image-carousel-arrows-horizontal-' . $settings['arrows_align'];
		}

		if ( $settings['arrows_navigation_wrapper_width'] ) {
			$navigation_alignment_classes .= ' rhea-image-carousel-arrows-wrapper-width-' . $settings['arrows_navigation_wrapper_width'];
		}
		$show_dots   = in_array( $settings['navigation'], [ 'dots', 'both' ] );
		$show_arrows = in_array( $settings['navigation'], [ 'arrows', 'both' ] );
		?>
        <div id="rhea-image-carousel-wrapper-<?php echo esc_attr( $widget_id ); ?>" class="rhea-image-carousel-wrapper carousel-style-2 <?php echo esc_attr( $navigation_alignment_classes ); ?>">
			<?php
			if ( $show_arrows ) {
				?>
                <div class="rhea-image-carousel-button-wrapper">
                    <div class="rhea-image-carousel-button rhea-image-carousel-button-prev">
						<?php $this->render_slick_button( 'previous' ); ?>
                        <span class="elementor-screen-only"><?php echo esc_html__( 'Previous', 'realhomes-elementor-addon' ); ?></span>
                    </div>
                    <div class="rhea-image-carousel-button rhea-image-carousel-button-next">
						<?php $this->render_slick_button( 'next' ); ?>
                        <span class="elementor-screen-only"><?php echo esc_html__( 'Next', 'realhomes-elementor-addon' ); ?></span>
                    </div>
                </div>
				<?php
			}
			$style = $settings['style'];
			if ( 'default' === $style ) {
				$carousel_items = [];
				foreach ( $settings['carousel'] as $index => $attachment ) {
					$attachment_id = $attachment['id'];
					$attachment_id = rhea_get_wpml_translated_image_id( $attachment_id );
					$image_url     = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $attachment_id, 'thumbnail', $settings );
					if ( ! $image_url && isset( $attachment['url'] ) ) {
						$image_url = $attachment['url'];
					}

					$image_html = '<img class="rhea-image-carousel-image" src="' . esc_url( $image_url ) . '" alt="' . esc_attr( \Elementor\Control_Media::get_image_alt( $attachment ) ) . '" />';

					$link_tag = '';
					$link     = $link_to;

					if ( empty( $link ) ) {
						$link = [ 'url' => wp_get_attachment_url( $attachment_id ) ];
					}

					if ( $link ) {

						$link_key = 'link_' . $index;

						$this->add_lightbox_data_attributes( $link_key, $attachment_id, $settings['open_lightbox'], $this->get_id() );

						if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
							$this->add_render_attribute( $link_key, [
								'class' => 'elementor-clickable',
							] );
						}

						$this->add_link_attributes( $link_key, $link );

						$link_tag = '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
					}

					$slide_html = '<div class="rhea-image-carousel-item">' . $link_tag . $image_html;

					if ( $link ) {
						$slide_html .= '</a>';
					}

					$slide_html .= '</div>';

					$carousel_items[] = $slide_html;
				}
				?>
                <div id="rhea-image-carousel-<?php echo esc_attr( $widget_id ); ?>" class="<?php echo join( ' ', $container_classes ); ?>">
					<?php echo implode( '', $carousel_items ); ?>
                </div>
				<?php
			} else if ( 'style-2' === $style ) {
				$carousel = $settings['rhea_carousel_style_2'];
				if ( $carousel ) {
					?>
                    <div id="rhea-image-carousel-<?php echo esc_attr( $widget_id ); ?>" class="<?php echo join( ' ', $container_classes ); ?>">
						<?php
						foreach ( $carousel as $item ) {
							$title         = $item['title'];
							$label_bold    = $item['label-bold'];
							$label         = $item['label'];
							$attachment_id = $item['image']['id'];
							$attachment_id = rhea_get_wpml_translated_image_id( $attachment_id );
							?>
                            <div class="rhea-carousel-content-wrapper">
                                <div class="rhea-carousel-content">
                                    <div class="rhea-carousel-content-inner">
										<?php
										$slider_thumb = wp_get_attachment_image( $attachment_id, 'modern-property-child-slider' );
										$slide_url    = $item['slide_url'];
										if ( ! empty( $slide_url['url'] ) ) {
											$target   = $slide_url['is_external'] ? ' target="_blank"' : '';
											$nofollow = $slide_url['nofollow'] ? ' rel="nofollow"' : '';
											?>
                                            <a class="rhea-carousel-thumb" href="<?php echo esc_url( $slide_url['url'] ) ?>" <?php echo $target . $nofollow ?>>
												<?php
												echo $slider_thumb;
												?>
                                            </a>
											<?php
										} else {
											?>
                                            <div class="rhea-carousel-thumb">
												<?php
												echo $slider_thumb
												?>
                                            </div>
											<?php
										}
										if ( ! empty( $title ) ) {
											?>
                                            <h4 class="title"><?php echo esc_html( $title ) ?></h4>
											<?php
										}
										if ( ! empty( $label ) || ! empty( $label_bold ) ) {
											?>
                                            <div class="label">
												<?php
												if ( ! empty( $label_bold ) ) {
													?>
                                                    <span class="bold"><?php echo esc_html( $label_bold ) ?></span>
													<?php
												}
												if ( ! empty( $label ) ) {
													?>
                                                    <span class="light"><?php echo esc_html( $label ) ?></span>
													<?php
												}
												?>
                                            </div>
											<?php
										}

										?>

                                    </div>
                                </div>
                            </div>
							<?php
						}
						?>
                    </div>

					<?php
				}
			}
			?>
        </div>
		<?php
		$slides_to_show = 1;
		if ( $settings['slides_to_show'] ) {
			$slides_to_show = $settings['slides_to_show'];
		}

		$slides_to_scroll = 1;
		if ( $settings['slides_to_scroll'] ) {
			$slides_to_scroll = $settings['slides_to_scroll'];
		}

		$slides_to_show_tablet = 1;
		if ( $settings['slides_to_show_tablet'] ) {
			$slides_to_show_tablet = $settings['slides_to_show_tablet'];
		}

		$slides_to_scroll_tablet = 1;
		if ( $settings['slides_to_scroll_tablet'] ) {
			$slides_to_scroll_tablet = $settings['slides_to_scroll_tablet'];
		}

		$slides_to_show_mobile = 1;
		if ( $settings['slides_to_show_mobile'] ) {
			$slides_to_show_mobile = $settings['slides_to_show_mobile'];
		}

		$slides_to_scroll_mobile = 1;
		if ( $settings['slides_to_scroll_mobile'] ) {
			$slides_to_scroll_mobile = $settings['slides_to_scroll_mobile'];
		}

		$carousel_options                         = array();
		$carousel_options['wrapper']              = '#rhea-image-carousel-wrapper-' . esc_html( $widget_id );
		$carousel_options['id']                   = '#rhea-image-carousel-' . esc_html( $widget_id );
		$carousel_options['slidesToShow']         = (int)$slides_to_show;
		$carousel_options['slidesToScroll']       = (int)$slides_to_scroll;
		$carousel_options['slidesToShowTablet']   = (int)$slides_to_show_tablet;
		$carousel_options['slidesToScrollTablet'] = (int)$slides_to_scroll_tablet;
		$carousel_options['slidesToShowMobile']   = (int)$slides_to_show_mobile;
		$carousel_options['slidesToScrollMobile'] = (int)$slides_to_scroll_mobile;
		$carousel_options['speed']                = (int)$settings['speed'];
		$carousel_options['autoplaySpeed']        = (int)$settings['autoplay_speed'];
		$carousel_options['dots']                 = $show_dots;
		$carousel_options['arrows']               = $show_arrows;
		$carousel_options['autoplay']             = ( 'yes' == $settings['autoplay'] );
		$carousel_options['pauseOnHover']         = ( 'yes' == $settings['pause_on_hover'] );
		$carousel_options['pauseOnInteraction']   = ( 'yes' == $settings['pause_on_interaction'] );
		$carousel_options['infinite']             = ( 'yes' == $settings['infinite'] );
		$carousel_options['fade']                 = ( 'fade' == $settings['effect'] );
		?>
        <script type="application/javascript">
            ( function ( $ ) {
                'use strict';
                $( document ).ready( function () {
                    rheaImageCarousel(<?php echo wp_json_encode( $carousel_options ); ?>);
                } );
            } )( jQuery );
        </script>
		<?php
	}

	private function get_link_url( $instance ) {
		if ( 'none' === $instance['link_to'] ) {
			return false;
		}

		if ( 'custom' === $instance['link_to'] ) {
			if ( empty( $instance['link']['url'] ) ) {
				return false;
			}

			return $instance['link'];
		}
	}

	private function render_slick_button( $type ) {
		$icon_settings = $this->get_settings_for_display( 'navigation_' . $type . '_icon' );

		if ( empty( $icon_settings['value'] ) ) {
			if ( 'previous' === $type ) {
				?>
                <svg width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M23 9H1C0.734784 9 0.48043 8.89464 0.292893 8.70711C0.105357 8.51957 0 8.26522 0 8C0 7.73478 0.105357 7.48043 0.292893 7.29289C0.48043 7.10536 0.734784 7 1 7H23C23.2652 7 23.5196 7.10536 23.7071 7.29289C23.8946 7.48043 24 7.73478 24 8C24 8.26522 23.8946 8.51957 23.7071 8.70711C23.5196 8.89464 23.2652 9 23 9Z" fill="#0A1510" />
                    <path d="M2.41394 7.99992L8.70694 1.70692C8.8891 1.51832 8.98989 1.26571 8.98761 1.00352C8.98533 0.741321 8.88017 0.490508 8.69476 0.3051C8.50935 0.119692 8.25854 0.0145233 7.99634 0.0122448C7.73414 0.00996641 7.48154 0.110761 7.29294 0.292919L0.292939 7.29292C0.105468 7.48045 0.000152588 7.73475 0.000152588 7.99992C0.000152588 8.26508 0.105468 8.51939 0.292939 8.70692L7.29294 15.7069C7.48154 15.8891 7.73414 15.9899 7.99634 15.9876C8.25854 15.9853 8.50935 15.8801 8.69476 15.6947C8.88017 15.5093 8.98533 15.2585 8.98761 14.9963C8.98989 14.7341 8.8891 14.4815 8.70694 14.2929L2.41394 7.99992Z" fill="#0A1510" />
                </svg>
				<?php
			} else if ( 'next' === $type ) {
				?>
                <svg width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 9H23C23.2652 9 23.5196 8.89464 23.7071 8.70711C23.8946 8.51957 24 8.26522 24 8C24 7.73478 23.8946 7.48043 23.7071 7.29289C23.5196 7.10536 23.2652 7 23 7H1C0.734784 7 0.480429 7.10536 0.292892 7.29289C0.105356 7.48043 0 7.73478 0 8C0 8.26522 0.105356 8.51957 0.292892 8.70711C0.480429 8.89464 0.734784 9 1 9Z" fill="#0A1510" />
                    <path d="M21.586 7.99992L15.293 1.70692C15.1109 1.51832 15.0101 1.26571 15.0124 1.00352C15.0146 0.741321 15.1198 0.490508 15.3052 0.3051C15.4906 0.119692 15.7414 0.0145233 16.0036 0.0122448C16.2658 0.00996641 16.5184 0.110761 16.707 0.292919L23.707 7.29292C23.8945 7.48045 23.9998 7.73475 23.9998 7.99992C23.9998 8.26508 23.8945 8.51939 23.707 8.70692L16.707 15.7069C16.5184 15.8891 16.2658 15.9899 16.0036 15.9876C15.7414 15.9853 15.4906 15.8801 15.3052 15.6947C15.1198 15.5093 15.0146 15.2585 15.0124 14.9963C15.0101 14.7341 15.1109 14.4815 15.293 14.2929L21.586 7.99992Z" fill="#0A1510" />
                </svg>
				<?php
			}
		} else {
			\Elementor\Icons_Manager::render_icon( $icon_settings, [ 'aria-hidden' => 'true' ] );
		}
	}
}
