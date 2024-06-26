<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Testimonials_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'inspiry-testimonial-ultra-widget';
	}

	public function get_title() {
		return esc_html__( 'Ultra Testimonials', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_categories() {
		return [ 'ultra-real-homes' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Testimonials', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default'    => esc_html__( 'Default', 'realhomes-elementor-addon' ),
					'carousel'   => esc_html__( 'Carousel', 'realhomes-elementor-addon' ),
					'carousel-2' => esc_html__( 'Carousel Two', 'realhomes-elementor-addon' ),
				],
				'default' => 'default',
			]
		);

		$testimonial_repeater = new \Elementor\Repeater();

		$testimonial_repeater->add_control(
			'rhea_testimonial_author',
			[
				'label' => esc_html__( 'Author Name', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$testimonial_repeater->add_control(
			'rhea_testimonial_author_designation',
			[
				'label'       => esc_html__( 'Author Designation', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'For example: Director of Automatic', 'realhomes-elementor-addon' ),
			]
		);

		$testimonial_repeater->add_control(
			'rhea_testimonial_author_thumb',
			[
				'label'       => esc_html__( 'Author Thumbnail', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'Recommended Image Size 150x150 (small thumbnail)', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'default'     => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$testimonial_repeater->add_control(
			'rhea_testimonial_text_strong',
			[
				'label' => esc_html__( 'Testimonial Text Strong', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$testimonial_repeater->add_control(
			'rhea_testimonial_text',
			[
				'label' => esc_html__( 'Testimonial Text', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'rhea_testimonials',
			[
				'label'       => esc_html__( 'Add Testimonials', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $testimonial_repeater->get_controls(),
				'default'     => [
					[
						'rhea_testimonial_author'      => esc_html( 'Author Name' ),
						'rhea_testimonial_text_strong' => esc_html( 'This is genuinely the best theme I have ever bought in terms of super easy & clear instructions to follow.' ),
						'rhea_testimonial_text'        => esc_html( 'I have been a web designer for over 18 years now. The theme is fantastic, flexible and simply excellent to use. I cannot recommend enough!' ),
					],
					[
						'rhea_testimonial_author'      => esc_html( 'Author Name' ),
						'rhea_testimonial_text_strong' => esc_html( 'The support and documentation provided by the RealHomes theme team have been outstanding.' ),
						'rhea_testimonial_text'        => esc_html( 'Thanks to the RealHomes theme, my website has become a powerful marketing tool that attracts and engages potential clients.' ),
					],
				],
				'title_field' => ' {{{ rhea_testimonial_author }}}',
				'condition'   => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'testimonials_section_title',
			[
				'label'     => esc_html__( 'Section Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		// For carousel variation
		$carousel_testimonials = new \Elementor\Repeater();

		$carousel_testimonials->add_control(
			'rating',
			[
				'label'   => esc_html__( 'Rating', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 5,
				'step'    => 1,
				'default' => 5,
			]
		);

		$carousel_testimonials->add_control(
			'testimonial_author',
			[
				'label' => esc_html__( 'Author Name', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$carousel_testimonials->add_control(
			'testimonial_author_designation',
			[
				'label'       => esc_html__( 'Author Label', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'For example: Director of Automatic', 'realhomes-elementor-addon' ),
			]
		);

		$carousel_testimonials->add_control(
			'testimonial_author_thumb',
			[
				'label'       => esc_html__( 'Author Thumbnail', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'Recommended Image Size 150x150 (small thumbnail)', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'default'     => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$carousel_testimonials->add_control(
			'heading',
			[
				'label' => esc_html__( 'Heading', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$carousel_testimonials->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'testimonials',
			[
				'label'       => esc_html__( 'Add Testimonials', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $carousel_testimonials->get_controls(),
				'default'     => [
					[
						'testimonial_author' => esc_html( 'Author Name' ),
						'heading'            => esc_html( 'Super easy & clear to follow' ),
						'text'               => esc_html( 'I have been a web designer for over 18 years now. The theme is fantastic, flexible and simply excellent to use. I cannot recommend enough!' ),
					],
					[
						'testimonial_author' => esc_html( 'Author Name' ),
						'heading'            => esc_html( 'Simplified property management' ),
						'text'               => esc_html( 'Thanks to the RealHomes theme, my website has become a powerful marketing tool that attracts and engages potential clients.' ),
					],
				],
				'title_field' => ' {{{ testimonial_author }}}',
				'conditions'  => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'style',
							'operator' => '=',
							'value'    => 'carousel',
						],
						[
							'name'     => 'style',
							'operator' => '=',
							'value'    => 'carousel-2',
						],
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'settings',
			[
				'label' => esc_html__( 'Carousel', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
			'testimonials_typography',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'strong_text_typography',
				'label'     => esc_html__( 'Strong Text', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-ultra-testimonial-strong',
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'light_text_typography',
				'label'     => esc_html__( 'Light Text', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-ultra-testimonial-light',
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'testimonials_section_title_typography',
				'label'     => esc_html__( 'Section Title', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-testimonials-container .rhea-testimonials-section-heading',
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'author_name_typography',
				'label'    => esc_html__( 'Author Name', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-testimonal-author .rhea-author, {{WRAPPER}} .rhea-testimonial-author-name',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'author_designation_typography',
				'label'    => esc_html__( 'Author Designation', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-testimonal-author .rhea-author-designation, {{WRAPPER}} .rhea-testimonial-author-designation',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'testimonial_heading_typography',
				'label'     => esc_html__( 'Testimonials Heading', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-testimonials-container .rhea-testimonial-heading',
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'testimonials_text_typography',
				'label'     => esc_html__( 'Testimonials Text', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-testimonial-text',
				'conditions'  => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'style',
							'operator' => '=',
							'value'    => 'carousel',
						],
						[
							'name'     => 'style',
							'operator' => '=',
							'value'    => 'carousel-2',
						],
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'testimonials_styles',
			[
				'label' => esc_html__( 'Basic', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'testimonials_container_width',
			[
				'label'      => esc_html__( 'Container Width', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 768,
						'max' => 2400,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-testimonials-container' => '--rhea-testimonials-container-width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'testimonials_container_padding',
			[
				'label'      => esc_html__( 'Container Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-testimonials-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'testimonials_carousel_margin',
			[
				'label'      => esc_html__( 'Carousel Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-testimonials-container .rhea-testimonials-carousel' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'testimonial_item_margin',
			[
				'label'      => esc_html__( 'Testimonial Item Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-testimonials-container .rhea-testimonial-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'testimonial_item_padding',
			[
				'label'      => esc_html__( 'Testimonial Item Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-testimonials-container .rhea-testimonial-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'slider_content_gap',
			[
				'label' => esc_html__( 'Gap Between Thumbnail and Content', 'realhomes-elementor-addon' ),

				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-testimonial-box' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'strong_margin_bottom',
			[
				'label'     => esc_html__( 'Strong Text Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-testimonial-strong' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'light_margin_bottom',
			[
				'label'     => esc_html__( 'Light Text Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-testimonial-light' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'top_info_margin_bottom',
			[
				'label'     => esc_html__( 'Author Container Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-testimonial-top' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'author_margin_bottom',
			[
				'label'     => esc_html__( 'Author Name Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-testimonal-author .rhea-author, {{WRAPPER}} .rhea-testimonial-author-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'heading_margin_bottom',
			[
				'label'     => esc_html__( 'Heading Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-testimonials-container .rhea-testimonial-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'thumb-background-dots-size',
			[
				'label'     => esc_html__( 'Thumbnail Background Dots Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bg-dots' => 'background-size: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_padding',
			[
				'label'      => esc_html__( 'Thumbnail Wrapper Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-bg-dots' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'wrapper_padding',
			[
				'label'      => esc_html__( 'Content Wrapper Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-testimonials-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'thumbnail-image-radius',
			[
				'label'      => esc_html__( 'Thumbnail Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .author-thumb'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'testimonials_colors_section',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'strong_text_color',
			[
				'label'     => esc_html__( 'Strong Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-testimonial-strong' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'light_text_color',
			[
				'label'     => esc_html__( 'Light Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-testimonial-light' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'testimonials_section_title_color',
			[
				'label'     => esc_html__( 'Section Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-testimonials-container .rhea-testimonials-section-heading' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'star_color',
			[
				'label'     => esc_html__( 'Unrated Star', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-testimonials-container .rating-stars' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'rating_star_color',
			[
				'label'     => esc_html__( 'Rated Star', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-testimonials-container .rating-stars-colored' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'testimonials_item_bg_color',
			[
				'label'     => esc_html__( 'Testimonial Item Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-testimonials-container .rhea-testimonial-wrapper' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'author_name_color',
			[
				'label'     => esc_html__( 'Author Name', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-author, {{WRAPPER}} .rhea-testimonial-author-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'author_designation_color',
			[
				'label'     => esc_html__( 'Author Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-author-designation, {{WRAPPER}} .rhea-testimonial-author-designation' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'testimonials_heading_color',
			[
				'label'     => esc_html__( 'Testimonials Heading', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-testimonials-container .rhea-testimonial-heading' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'testimonials_text_color',
			[
				'label'     => esc_html__( 'Testimonials Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-testimonial-text' => 'color: {{VALUE}}',
				],
				'conditions'  => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'style',
							'operator' => '=',
							'value'    => 'carousel',
						],
						[
							'name'     => 'style',
							'operator' => '=',
							'value'    => 'carousel-2',
						],
					],
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
					'{{WRAPPER}} .rhea-testimonials-container .rhea-testimonials-carousel-nav' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .rhea-testimonials-container .rhea-testimonials-carousel-nav:hover' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .rhea-testimonials-container .rhea-testimonials-carousel-nav' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .rhea-testimonials-carousel-nav:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .rhea-testimonials-carousel-nav' => 'background-color: {{VALUE}};',
				],
				'conditions'  => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'style',
							'operator' => '=',
							'value'    => 'carousel',
						],
						[
							'name'     => 'style',
							'operator' => '=',
							'value'    => 'carousel-2',
						],
					],
				],
			]
		);

		$this->add_control(
			'nav_icon_stroke_color',
			[
				'label'     => esc_html__( 'Nav Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-testimonials-carousel-nav path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => [
					'style' => 'carousel-2',
				],
			]
		);

		$this->add_control(
			'nav_icon_stroke_color_hover',
			[
				'label'     => esc_html__( 'Nav Icon Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-testimonials-carousel-nav:hover path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => [
					'style' => 'carousel-2',
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
					'{{WRAPPER}} .rhea-testimonials-carousel-nav:hover' => 'background-color: {{VALUE}};',
				],
				'conditions'  => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'style',
							'operator' => '=',
							'value'    => 'carousel',
						],
						[
							'name'     => 'style',
							'operator' => '=',
							'value'    => 'carousel-2',
						],
					],
				],
			]
		);

		$this->add_control(
			'background_dots_color',
			[
				'label'     => esc_html__( 'Thumbnail Background Dots', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bg-dots' => 'background-image: -webkit-radial-gradient({{VALUE}} 20%, transparent 20%); background-image: radial-gradient({{VALUE}} 20%, transparent 20%);',
				],
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'testimonials_box_shadow',
			[
				'label' => esc_html__( 'Box Shadow', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'thumb_box_shadow',
				'label'     => esc_html__( 'Thumbnail Box', 'realhomes-elementor-addon' ),
				'selector'  => '{{WRAPPER}} .rhea-ultra-thumb',
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'testimonial_item_box_shadow',
				'label'     => esc_html__( 'Testimonial Item', 'realhomes-elementor-addon' ),
				'selector'  => '{{WRAPPER}} .rhea-testimonials-container .rhea-testimonial-wrapper.slick-active',
				'condition' => [
					'style' => 'carousel',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_nav_styles',
			[
				'label'     => esc_html__( 'Slider Navigations', 'realhomes-elementor-addon' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_margin_top',
			[
				'label'     => esc_html__( 'Slider Nav Control Margin Top', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box' => 'margin-top: {{SIZE}}{{UNIT}};',

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
					'{{WRAPPER}} .rhea-ultra-nav-box' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'slider_control_nav_margin',
			[
				'label'     => esc_html__( 'Slider nav controls margin', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_nav_color',
			[
				'label'     => esc_html__( 'Directional Nav Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-prev' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-next' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_icon_color',
			[
				'label'     => esc_html__( 'Directional Nav icon ', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-prev i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-next i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_nav_hover_color',
			[
				'label'     => esc_html__( 'Directional Nav Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-prev:hover' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-next:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_icon_hover_color',
			[
				'label'     => esc_html__( 'Directional Nav icon hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-prev:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-next:hover i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_control_nav_background',
			[
				'label'     => esc_html__( 'Slider Control Nav Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow_control_nav',
				'label'    => esc_html__( 'Control Nav Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots',
			]
		);

		$this->add_control(
			'rhea_slider_control_nav',
			[
				'label'     => esc_html__( 'Slider Control Nav Dots Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button'       => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button:after' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_slider_control_nav_active',
			[
				'label'     => esc_html__( 'Slider Control Nav Active/hover Dots Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button.active'       => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button.active:after' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button:hover'        => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button:hover:after'  => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'navigation-buttons-radius',
			[
				'label'      => esc_html__( 'Slider Buttons Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-prev, {{WRAPPER}} .rhea-ultra-nav-box .owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navigation-dots-wrapper-radius',
			[
				'label'      => esc_html__( 'Slider Dots Wrapper Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navigation-dots-radius',
			[
				'label'      => esc_html__( 'Slider Dots Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		global $settings, $widget_id;
		$settings  = $this->get_settings_for_display();
		$widget_id = $this->get_id();

		if ( 'default' === $settings['style'] ) {
			global $repeater_testimonials;
			$repeater_testimonials = $settings['rhea_testimonials'];

			if ( ! $repeater_testimonials ) {
				return '';
			}

			rhea_get_template_part( 'elementor/widgets/testimonials-widget/default' );

		} else if ( 'carousel' === $settings['style'] ) {
			global $testimonials;
			$testimonials = $settings['testimonials'];

			if ( ! $testimonials ) {
				return '';
			}

			rhea_get_template_part( 'elementor/widgets/testimonials-widget/carousel' );
		} else if ( 'carousel-2' === $settings['style'] ) {
			global $testimonials;
			$testimonials = $settings['testimonials'];

			if ( ! $testimonials ) {
				return '';
			}

			rhea_get_template_part( 'elementor/widgets/testimonials-widget/carousel-2' );
		}
	}
}
