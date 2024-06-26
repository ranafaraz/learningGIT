<?php
/**
 * Property Gallery Elementor widget for single property
 *
 * @since 2.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Gallery extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-gallery';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Gallery', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'ultra-realhomes-single-property' ];
	}


	protected function register_controls() {
		$this->start_controls_section(
			'basic',
			[
				'label' => esc_html__( 'Basic', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default'        => esc_html__( 'Default ( In dashboard edit property )', 'realhomes-elementor-addon' ),
					'masonry-style'  => esc_html__( 'Masonry', 'realhomes-elementor-addon' ),
					'carousel-style' => esc_html__( 'Carousel', 'realhomes-elementor-addon' ),

				],
				'default' => 'carousel-style',
			]
		);

		$this->add_control(
			'counter_label',
			[
				'label'   => esc_html__( 'Image Counter Label', 'realhomes-elementor-addon' ),
				'default' => esc_html__( 'See All Photos', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'carousel_settings',
			[
				'label'     => esc_html__( 'Carousel Settings', 'realhomes-elementor-addon' ),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'layout' => 'carousel-style',
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
			'basic_styles',
			[
				'label' => esc_html__( 'Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'container_height',
			[
				'label' => esc_html__( 'Container Height', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,

				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 1500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-gallery.grid-carousel .rhea-gallery-item' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rhea-single-property-gallery.grid-box'                         => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'column_gap',
			[
				'label' => esc_html__( 'Column Gap', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,

				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-gallery.grid-box' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'grid',
				],
			]
		);
		$this->add_responsive_control(
			'border-radius',
			[
				'label' => esc_html__( 'border-radius', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,

				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-gallery.grid-box .rhea-gallery-item' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'grid',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'counter_typography',
				'label'     => esc_html__( 'Counter Label', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .overlay-counter',
				'condition' => [
					'layout' => 'grid',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => esc_html__( 'Navigation', 'realhomes-elementor-addon' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'carousel-style',
				],
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
		global $settings, $post_id, $properties_images, $widget_id;

		$settings = $this->get_settings_for_display();

		$post_id = get_the_ID();

		$widget_id = $this->get_id();

		// Sample Post id for Elementor editor only
		if ( rhea_is_preview_mode() ) {
			$post_id = rhea_get_sample_property_id();
		}

		$gallery_style = 'carousel-style';
		if ( ! empty( $settings['layout'] ) && 'default' !== $settings['layout'] ) {
			$gallery_style = $settings['layout'];
		} else {
			$REAL_HOMES_gallery_slider_type = get_post_meta( $post_id, 'REAL_HOMES_gallery_slider_type', true );
			if ( ! empty( $REAL_HOMES_gallery_slider_type ) ) {
				$gallery_style = $REAL_HOMES_gallery_slider_type;
			}
		}

		$size              = 'post-featured-image';
		$properties_images = rwmb_meta( 'REAL_HOMES_property_images', 'type=plupload_image&size=' . $size, $post_id );
		$prop_detail_login = inspiry_prop_detail_login();
		if ( ! empty( $properties_images ) && 1 < count( $properties_images ) && ( 'yes' != $prop_detail_login || is_user_logged_in() ) ) {
			rhea_get_template_part( 'assets/partials/ultra/single/property/gallery-' . esc_html( $gallery_style ) );
		}
	}

}