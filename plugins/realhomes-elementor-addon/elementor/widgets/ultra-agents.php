<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Agents_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-agents-widget';
	}

	public function get_title() {
		return esc_html__( 'Ultra Agents', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'ultra-real-homes' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'rhea_add_agents_section',
			[
				'label' => esc_html__( 'Add Agents', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_verification_badge',
			[
				'label'        => esc_html__( 'Show Agents Verification Badge', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$agents_repeater = new \Elementor\Repeater();

		$all_post_ids = get_posts( array(
			'fields'         => 'ids',
			'posts_per_page' => -1,
			'post_type'      => 'agent'
		) );

		$get_agents = array();
		foreach ( $all_post_ids as $rhea_id ) {
			$get_agents["$rhea_id"] = get_the_title( $rhea_id );
		}

		$agents_repeater->add_control(
			'rhea_select_agent',
			[
				'label'   => esc_html__( 'Select Agent', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $get_agents,
			]
		);

		$agents_repeater->add_control(
			'rhea_agent_title',
			[
				'label'       => esc_html__( 'Agent Title', 'realhomes-elementor-addon' ),
				'placeholder' => esc_html__( 'Agent Title', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'It is recommended to add an agent title. If agent is being added through "Agent Post Type, Agent Title will be displayed only as sorting control label " ', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]

		);

		$agents_repeater->add_control(
			'featured_images',
			[
				'label'       => esc_html__( 'Add Featured Images', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'Max 3 Images are recommended', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::GALLERY,
			]
		);


		$this->add_control(
			'rhea_agent',
			[
				'label'       => esc_html__( 'Add Agent', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $agents_repeater->get_controls(),
				'title_field' => ' {{{rhea_agent_title}}}',

			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'exclude'   => [ 'custom' ],
				'default'   => 'medium',
				'separator' => 'none',
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'rhea_settings_section',
			[
				'label' => esc_html__( 'Basic Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_agency',
			[
				'label'        => esc_html__( 'Show Agency', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'view-profile-text',
			[
				'label'   => esc_html__( 'View Profile Button Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'View Profile', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'listed-properties-single-text',
			[
				'label'   => esc_html__( 'Listed Properties Singular Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Listed Property', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'listed-properties-text',
			[
				'label'   => esc_html__( 'Listed Properties Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Listed Properties', 'realhomes-elementor-addon' ),
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'typography-section',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_title_typography',
				'label'    => esc_html__( 'Agent Title', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-agent-detail h3 a'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_agency_typography',
				'label'    => esc_html__( 'Agency Title', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-agent-detail .rhea-ultra-agent-title'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_profile_button_typography',
				'label'    => esc_html__( 'View Profile Button', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-agent-profile'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_listed_label_typography',
				'label'    => esc_html__( 'Listed Properties Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-agent-listed'
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'colors-section',
			[
				'label' => esc_html__( 'Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'agent_slide_background',
			[
				'label'     => esc_html__( 'Agent Slide Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-agent-slide' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agent_title_color',
			[
				'label'     => esc_html__( 'Agent Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-agent-detail h3 a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent_title_color_hover',
			[
				'label'     => esc_html__( 'Agent Title Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-agent-detail h3 a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agency_title_color',
			[
				'label'     => esc_html__( 'Agency Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-agent-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agency_title_color_hover',
			[
				'label'     => esc_html__( 'Agency Title Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-agent-title:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'link_wrapper_bg',
			[
				'label'     => esc_html__( 'Slide Links Wrapper Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-agent-links' => 'background: linear-gradient(180deg, rgba(255,255,255,0) 0%, {{VALUE}} 30%)',
				],
			]
		);
		$this->add_responsive_control(
			'link_wrapper_border_radius',
			[
				'label'      => esc_html__( 'Slide Links Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-agent-links' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'listed_properties_color',
			[
				'label'     => esc_html__( 'Listed Properties Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-agent-listed' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'listed_properties_color_hover',
			[
				'label'     => esc_html__( 'Listed Properties Label Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-agent-listed:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'view_profile_text_color',
			[
				'label'     => esc_html__( 'View Profile Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-agent-profile' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'view_profile_bg_color',
			[
				'label'     => esc_html__( 'View Profile Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-agent-profile' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'view_profile_text_hover_color',
			[
				'label'     => esc_html__( 'View Profile Text Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-agent-profile:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'view_profile_bg_hover_color',
			[
				'label'     => esc_html__( 'View Profile Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-agent-profile:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'view_profile_border_color',
			[
				'label'     => esc_html__( 'View Profile Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-agent-profile' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'view_profile_border_hover_color',
			[
				'label'     => esc_html__( 'View Profile Border Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-agent-profile:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'view_profile_border_radius',
			[
				'label'      => esc_html__( 'View Profile Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-agent-profile' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'slide_box_shadow',
				'label'    => esc_html__( 'Slide Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-ultra-agent-slide',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'slider_nav_styles',
			[
				'label' => esc_html__( 'Slider Navigations', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_sizes',
			[
				'label' => esc_html__( 'Slider Sizes & Spaces', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'slide_border_radius',
			[
				'label'      => esc_html__( 'Slide Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-agent-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'link_wrapper_padding',
			[
				'label'      => esc_html__( 'Slide Links Wrapper Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-agent-links' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'view_profile_padding',
			[
				'label'      => esc_html__( 'View Profile Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-ultra-agent-links .rhea-ultra-agent-profile' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'thumbs_margin_top',
			[
				'label'     => esc_html__( 'Thumbs Margin Top', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} rhea-ultra-agent-listings-thumbs' => 'margin-top: {{SIZE}}{{UNIT}};',

				],
			]
		);
		$this->add_responsive_control(
			'agent_thumb_size',
			[
				'label'     => esc_html__( 'Agent Thumbnail Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-agent-thumb-detail .rhea-agent-thumb' => 'width: {{SIZE}}{{UNIT}};',

				],
			]
		);
		$this->add_responsive_control(
			'title-margin-bottom',
			[
				'label'     => esc_html__( 'Title Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-agent-thumb-detail .rhea-agent-detail h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',

				],
			]
		);


		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$repeater_agents = $settings['rhea_agent'];
		if ( $repeater_agents ) {

			?>
            <div class="rhea-ultra-agents-wrapper" id="rhea-ultra-<?php echo $this->get_id(); ?>">
                <div id="rhea-carousel-<?php echo $this->get_id(); ?>" class="owl-carousel">

					<?php
					foreach ( $repeater_agents as $agent ) {

						$agent_id = intval( $agent['rhea_select_agent'] );

						$listed_properties = 0;
						if ( function_exists( 'ere_get_agent_properties_count' ) ) {
							$listed_properties = ere_get_agent_properties_count( $agent_id );
						}
						?>

                        <div class="rhea-ultra-agent-slide-outer">
                            <div class="rhea-ultra-agent-slide">
                                <div class="rhea-ultra-agent-thumb-detail">
                                    <div class="rhea-agent-thumb">
										<?php
										if ( has_post_thumbnail( $agent_id ) ) {
											?>
                                            <a href="<?php echo esc_url( get_the_permalink( $agent_id ) ); ?>">
												<?php
												echo get_the_post_thumbnail( $agent_id, 'agent-image' );
												?>
                                            </a>
											<?php
										} else {
											?>
                                            <a href="<?php echo esc_url( get_the_permalink( $agent_id ) ); ?>">
												<?php
												inspiry_image_placeholder( 'agent-image' );
												?>
                                            </a>
											<?php
										}
										?>
                                    </div>
                                    <div class="rhea-agent-detail">
                                        <h3>
                                            <a href="<?php echo esc_url( get_the_permalink( $agent_id ) ); ?>"><?php echo get_the_title( $agent_id ); ?></a>
	                                        <?php
	                                        if ( 'yes' === $settings['show_verification_badge'] && '1' === get_post_meta( $agent_id, 'ere_agent_verification_status', true ) ) {
		                                        ?>
                                                <span class="rh_agent_verification__icon">
                                                    <?php inspiry_safe_include_svg( '/icons/verified-check.svg', '/common/images' ); ?>
                                                </span>
		                                        <?php
	                                        }
	                                        ?>
                                        </h3>
										<?php
										if ( 'yes' === $settings['show_agency'] ) {
											$related_agency = get_post_meta( $agent_id, 'REAL_HOMES_agency', true );
											if ( ! empty( $related_agency ) ) {
												?>
                                                <a class="rhea-ultra-agent-title" href="<?php echo esc_url( get_the_permalink( $related_agency ) ); ?>">
													<?php echo get_the_title( $related_agency ); ?>
                                                </a>
												<?php
											}
										}
										?>
                                    </div>
                                </div>
                                <div class="rhea-ultra-agent-listings-thumbs">
									<?php
									foreach ( $agent['featured_images'] as $slider_image ) {


										$image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $slider_image['id'], 'thumbnail', $settings );
										?>
                                        <img src="<?php echo esc_url( $image_url ) ?>" alt="<?php echo esc_attr( \Elementor\Control_Media::get_image_alt( $slider_image ) ) ?>">
										<?php
									}
									?>
                                </div>
                                <div class="rhea-ultra-agent-links">
                                    <a class="rhea-ultra-agent-profile" href="<?php echo esc_url( get_the_permalink( $agent_id ) ); ?>">
										<?php
										if ( ! empty( $settings['view-profile-text'] ) ) {
											echo esc_html( $settings['view-profile-text'] );
										} else {
											esc_html_e( 'View Profile', 'realhomes-elementor-addon' );
										}
										?>

                                    </a>
                                    <!--	                        --><?php //if ( $settings['properties_count'] === 'yes' ) { ?>
									<?php
									if ( ! empty( $settings['listed-properties-single-text'] ) ) {
										$listed_single = esc_html( $settings['listed-properties-single-text'] );
									} else {
										$listed_single = esc_html__( 'Listed Property', 'realhomes-elementor-addon' );
									}

									if ( ! empty( $settings['listed-properties-text'] ) ) {
										$listed_multiple = esc_html( $settings['listed-properties-text'] );
									} else {
										$listed_multiple = esc_html__( 'Listed Properties', 'realhomes-elementor-addon' );
									}
									?>
                                    <a class="rhea-ultra-agent-listed" href="<?php echo get_the_permalink( $agent_id ) ?>">
										<?php echo ( ! empty( $listed_properties ) ) ? esc_html( $listed_properties ) : 0;
										echo ' ';
										echo ( 1 === $listed_properties ) ? esc_html( $listed_single ) : esc_html( $listed_multiple ); ?>
                                        <i class="rhea-fas fas fa-caret-right"></i>
                                    </a>
									<?php
									//                            }
									?>
                                </div>
                            </div>
                        </div>

						<?php
					}
					?>

                </div>

                <div id="rhea-nav-<?php echo $this->get_id(); ?>" class="rhea-ultra-nav-box rhea-ultra-owl-nav owl-nav">
                    <div id="rhea-dots-<?php echo $this->get_id(); ?>" class="rhea-ultra-owl-dots owl-dots"></div>
                </div>

            </div>
            <script type="application/javascript">
                jQuery( document ).ready( function () {

                    jQuery( "#rhea-carousel-<?php echo $this->get_id(); ?>" ).owlCarousel( {
                        items         : 3,
                        nav           : true,
                        dots          : true,
                        dotsEach      : true,
                        loop          : true,
                        rtl           : rheaIsRTL(),
                        // center: true,
                        navText       : ['<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>'],
                        navContainer  : '#rhea-nav-<?php echo $this->get_id(); ?>',
                        dotsContainer : '#rhea-dots-<?php echo $this->get_id(); ?>',
                        responsive    : {
                            // breakpoint from 0 up
                            0    : {
                                items : 1
                                // center: false,
                            },
                            // breakpoint from 650 up
                            650  : {
                                items  : 2,
                                // center: false,
                                margin : 20
                            },
                            // breakpoint from 1140 up
                            1140 : {
                                items  : 3,
                                margin : 30
                                // center: false,
                            },
                            1400 : {
                                margin : 50
                            }
                        }
                    } );
                } );
            </script>
			<?php
		}

	}
}