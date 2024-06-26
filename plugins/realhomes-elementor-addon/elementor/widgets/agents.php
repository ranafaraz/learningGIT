<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Agents_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'ere-agents-widget';
	}

	public function get_title() {
		return esc_html__( 'Agents Grid', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	protected function register_controls() {


		$this->start_controls_section(
			'agents_section',
			[
				'label' => esc_html__( 'Agents', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'rhea_agent_variations',
			array(
				'label'   => esc_html__( 'Designs', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => array(
					'default'   => array(
						'title' => esc_html__( 'Default', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-gallery-grid',
					),
					'style-two' => array(
						'title' => esc_html__( 'Style Two', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-column',
					),
				),
				'default' => 'default',
				'toggle'  => false,
			)
		);

		$this->add_responsive_control(
			'property_grid_layout',
			[
				'label'       => esc_html__( 'Layout', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'Number of columns will be reduced automatically if parent container has insufficient width.', 'realhomes-elementor-addon' ) . '<br>' .
				                 esc_html__( '* Make sure "Style -> Agent Width" field is empty.', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => '25%',
				'options'     => array(
					'25%'     => esc_html__( '4 Columns', 'realhomes-elementor-addon' ),
					'33.333%' => esc_html__( '3 Columns', 'realhomes-elementor-addon' ),
					'50%'     => esc_html__( '2 Columns', 'realhomes-elementor-addon' ),
					'100%'    => esc_html__( '1 Column', 'realhomes-elementor-addon' ),
				),
				'selectors'   => [
					'{{WRAPPER}} .rh_agent_elementor' => 'width: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'number_of_agents',
			[
				'label'   => esc_html__( 'Number of Agents', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
				'default' => 4,
			]
		);

		$this->add_control(
			'agent_agency_name',
			[
				'label'        => esc_html__( 'Agency Name', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'agent_mobile_number',
			[
				'label'        => esc_html__( 'Mobile Number', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'agent_office_number',
			[
				'label'        => esc_html__( 'Office Number', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'agent_whatsapp_number',
			[
				'label'        => esc_html__( 'Whatsapp Number', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'agent_fax_number',
			[
				'label'        => esc_html__( 'Fax Number', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'agent_license',
			[
				'label'        => esc_html__( 'License', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'agent_website',
			[
				'label'        => esc_html__( 'Website', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'agent_email',
			[
				'label'        => esc_html__( 'Email', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'properties_count',
			[
				'label'        => esc_html__( 'Properties Count', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'social_icons',
			[
				'label'        => esc_html__( 'Social Icons', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'meta_icons',
			[
				'label'        => esc_html__( 'Meta Icons', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'show_verification_badge',
			[
				'label'        => esc_html__( 'Show Verification Badge', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'display_arrow',
			[
				'label'        => esc_html__( 'Animation Arrow on Hover', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'agents_section_typography',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_title_typography',
				'label'    => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_agent_elementor .rh_agent__details h3 a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_agency_typography',
				'label'    => esc_html__( 'Agency', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__agency a'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_number_typography',
				'label'    => esc_html__( 'Numbers', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '
				            {{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__info.number,
				            {{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__info.number a
				            '
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_website_typography',
				'label'    => esc_html__( 'Website', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__info.website a'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_email_typography',
				'label'    => esc_html__( 'Email', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__email',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_figure_typography',
				'label'    => esc_html__( 'Listed Figure', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__listed .figure',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_label_typography',
				'label'    => esc_html__( 'Listed Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__listed .heading',
			]
		);

		$this->add_responsive_control(
			'agent_social_icon_size',
			[
				'label'     => esc_html__( 'Meta Icons Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 90
					]
				],
				'selectors' => [
					'{{WRAPPER}} .rh_section__agents_elementor .rh_agent_elementor .rh_agent__details .rh_agent__social_icons a i' => 'font-size: {{SIZE}}{{UNIT}};',

				],
				'reset'     => true
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'agent_styles_sizes',
			[
				'label' => esc_html__( 'Size And Position', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'agent_width',
			[
				'label'       => esc_html__( 'Agent Width (%)', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'This will over-ride the width of "Content -> Layout"', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'range'       => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .rh_agent_elementor' => 'width: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'agent_thumb_position',
			[
				'label'           => esc_html__( 'Thumbnail Vertical Position (px)', 'realhomes-elementor-addon' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 160,
					],
				],
				'desktop_default' => [
					'size' => 40,
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__thumbnail' => 'margin-top: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rh_agent'                                => 'padding-top: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'agents_spacing_section',
			[
				'label' => esc_html__( 'Spacings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'agent_card_padding',
			[
				'label'      => esc_html__( 'Agent Card Inner Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_agent__wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'agent_vertical_spacings',
			[
				'label'     => esc_html__( 'Vertical Space between Agents (px)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_section__agents_elementor .rh_agent_elementor' => 'padding-bottom: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'agent_title_spacings_top',
			[
				'label'     => esc_html__( 'Agent Title Margin Top (px)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_agent__details h3' => 'margin-top: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'agent_title_spacings_bottom',
			[
				'label'     => esc_html__( 'Agent Title Margin Bottom (px)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_agent__details h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'agency_margin_bottom',
			[
				'label'     => esc_html__( 'Agency Margin Bottom (px)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_agent__agency' => 'margin-bottom: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'agent_number_spacings',
			[
				'label'     => esc_html__( 'Agent Numbers Margin Bottom (px)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_agent__details .rh_agent__info.number' => 'margin-bottom: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'agent_website_spacings',
			[
				'label'     => esc_html__( 'Agent Website Margin Bottom (px)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_agent__details .rh_agent__info.website' => 'margin-bottom: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'agent_email_spacings',
			[
				'label'     => esc_html__( 'Agent Email Margin Bottom (px)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_agent__email' => 'margin-bottom: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'agent_figure_spacings',
			[
				'label'     => esc_html__( 'Listed Figure Margin Bottom (px)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_agent__listed .figure' => 'margin-bottom: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'agent_listed_properties_spacings',
			[
				'label'     => esc_html__( 'Listed Properties Margin Bottom (px)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_agent__listed .heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'agent_social_middle_spacings',
			[
				'label'     => esc_html__( 'Social Icons horizontal spacing (px)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_agent__social_icons li' => 'margin: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'agent_styles',
			[
				'label' => esc_html__( 'Agent Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'agent_bg_color',
			[
				'label'     => esc_html__( 'Agent Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__wrap' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent_title_color',
			[
				'label'     => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__details h3 a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agent_title_hover_color',
			[
				'label'     => esc_html__( 'Title Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__details h3 a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agent_verficiation_badge_bg_color_hover',
			[
				'label'     => esc_html__( 'Verification Badge Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#1cb2ff',
				'selectors' => [
					'{{WRAPPER}} .rh_agent__details h3 .rh_agent_verification__icon' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agent_verficiation_badge_svg_color_hover',
			[
				'label'     => esc_html__( 'Verification Badge Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .rh_agent__details h3 .rh_agent_verification__icon svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agent_agency_color',
			[
				'label'     => esc_html__( 'Agency', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__agency a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agent_agency_hover_color',
			[
				'label'     => esc_html__( 'Agency Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__agency a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agent_numbers_color',
			[
				'label'     => esc_html__( 'Numbers', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__info.number a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__info.number'   => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'agent_numbers_hover_color',
			[
				'label'     => esc_html__( 'Numbers Link Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__info.number a:hover' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'agent_website_color',
			[
				'label'     => esc_html__( 'Website', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__info.website a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agent_website_hover_color',
			[
				'label'     => esc_html__( 'Website Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__info.website a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agent_email_color',
			[
				'label'     => esc_html__( 'Email', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__email' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'agent_email_hover_color',
			[
				'label'     => esc_html__( 'Email Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__email:hover' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'agent_figure_color',
			[
				'label'     => esc_html__( 'Listed Figure', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__listed .figure' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agent_listed_figure_color',
			[
				'label'     => esc_html__( 'Listed Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__listed .heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agent_social_icons_color',
			[
				'label'     => esc_html__( 'Social Icons', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__social_icons li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agent_social_icons_hover',
			[
				'label'     => esc_html__( 'Social Icons Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__social_icons li a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agent_arrow_circle',
			[
				'label'     => esc_html__( 'Arrow Circle Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__arrow .cls-1' => 'fill: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'agent_arrow',
			[
				'label'     => esc_html__( 'Arrow Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__arrow .cls-2' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'agent_box_shadow',
			[
				'label' => esc_html__( 'Box Shadow', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rh_section__agents_elementor .rh_agent_elementor .rh_agent__wrap',
			]
		);


		$this->end_controls_section();

	}

	protected function render() {

		$settings                   = $this->get_settings_for_display();
		$display_verification_badge = $settings['show_verification_badge'];

		// Number of agents
		if ( ! $settings['number_of_agents'] ) {
			$settings['number_of_agents'] = 4;
		}

		$agents_args = array(
			'post_type'      => 'agent',
			'posts_per_page' => $settings['number_of_agents'],
		);

		$agents_query = new WP_Query( apply_filters( 'rhea_modern_agents_widget', $agents_args ) );

		if ( $agents_query->have_posts() ) {
			?>
            <div class="rh_elementor_widget rh_wrapper__agents_elementor <?php echo esc_attr( $settings['rhea_agent_variations'] ); ?>">

                <div class="rh_section__agents_elementor">
					<?php
					while ( $agents_query->have_posts() ) {

						$agents_query->the_post();

						$agent_mobile        = get_post_meta( get_the_ID(), 'REAL_HOMES_mobile_number', true );
						$agent_email         = get_post_meta( get_the_ID(), 'REAL_HOMES_agent_email', true );
						$listed_properties   = ere_get_agent_properties_count( get_the_ID() );
						$verification_status = get_post_meta( get_the_ID(), 'ere_agent_verification_status', true );

						$agent_id = get_the_ID();

						if ( $settings['agent_agency_name'] === 'yes' ) {
							$agent_agency_ID = get_post_meta( $agent_id, 'REAL_HOMES_agency', true );
							if ( $agent_agency_ID > 0 ) {
								$agent_agency_name      = get_the_title( $agent_agency_ID );
								$agent_agency_permalink = get_permalink( $agent_agency_ID );
							}
						}

						if ( $settings['agent_mobile_number'] === 'yes' ) {
							$agent_mobile = get_post_meta( $agent_id, 'REAL_HOMES_mobile_number', true );
						}

						if ( $settings['agent_office_number'] === 'yes' ) {
							$agent_office_number = get_post_meta( $agent_id, 'REAL_HOMES_office_number', true );
						}

						if ( $settings['agent_whatsapp_number'] === 'yes' ) {
							$agent_whatsapp = get_post_meta( $agent_id, 'REAL_HOMES_whatsapp_number', true );
						}

						if ( $settings['agent_fax_number'] === 'yes' ) {
							$agent_fax_number = get_post_meta( $agent_id, 'REAL_HOMES_fax_number', true );
						}

						if ( $settings['agent_website'] === 'yes' ) {
							$agent_website = get_post_meta( $agent_id, 'REAL_HOMES_website', true );
						}

						if ( $settings['agent_license'] === 'yes' ) {
							$agent_license = get_post_meta( $agent_id, 'REAL_HOMES_license_number', true );
						}

						if ( $settings['agent_email'] === 'yes' ) {
							$agent_email = get_post_meta( $agent_id, 'REAL_HOMES_agent_email', true );
						}

						if ( $settings['meta_icons'] === 'yes' ) {
							$info_icons = true;
						} else {
							$info_icons = false;
						}

						if ( function_exists( 'ere_get_agent_properties_count' ) ) {
							$listed_properties = ere_get_agent_properties_count( $agent_id );
						}
						?>
                        <article <?php post_class( 'rh_agent_elementor' ); ?>>
                            <div class="rh_agent__wrap">
                                <div class="rh_agent__thumbnail">
                                    <a href="<?php the_permalink(); ?>">
										<?php
										if ( has_post_thumbnail() ) {
											if ( ! empty( $settings['agent_thumb_sizes_select'] ) ) {
												the_post_thumbnail( $settings['agent_thumb_sizes_select'] );
											} else {
												the_post_thumbnail( 'agent-image' );
											}
										}
										?>
                                    </a>
                                </div>

                                <div class="rh_agent__details">

                                    <h3>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        <?php
                                        if ( 'yes' === $display_verification_badge && $verification_status ) {
                                            ?>
                                            <span class="rh_agent_verification__icon">
                                                <?php
                                                inspiry_safe_include_svg( '/icons/verified-check.svg', '/common/images' );
                                                ?>
                                            </span>
                                            <?php
                                        }
                                        ?>
                                    </h3>

                                    <?php
                                    if ( ! empty( $agent_agency_name ) ) {
                                        ?>
                                        <p class="rh_agent__agency">
                                            <a href="<?php echo esc_url( $agent_agency_permalink ); ?>">
                                                <?php echo esc_html( $agent_agency_name ); ?>
                                            </a>
                                        </p>
                                        <?php
                                    }

                                    if ( ! empty( $agent_mobile ) ) {
                                        ?>
                                        <p class="rh_agent__info phone number">
                                            <a href="tel:<?php echo esc_attr( $agent_mobile ); ?>">
                                                <?php echo ( $info_icons ) ? '<i class="fas fa-mobile-alt"></i>&nbsp;' : ''; ?>
                                                <?php echo esc_html( $agent_mobile ); ?>
                                            </a>
                                        </p>
                                        <?php
                                    }

                                    if ( ! empty( $agent_office_number ) ) {
                                        ?>
                                        <p class="rh_agent__info phone number">
                                            <a href="tel:<?php echo esc_attr( $agent_office_number ); ?>">
                                                <?php echo ( $info_icons ) ? '<i class="fas fa-phone"></i>&nbsp;' : ''; ?>
                                                <?php echo esc_html( $agent_office_number ); ?>
                                            </a>
                                        </p>
                                        <?php
                                    }

                                    if ( ! empty( $agent_whatsapp ) ) {
                                        $agent_whatsapp_link = 'https://wa.me/' . str_replace( '-', '', $agent_whatsapp );
                                        ?>
                                        <p class="rh_agent__info whatsapp number">
                                            <a href="<?php echo esc_url( $agent_whatsapp_link ); ?>" target="_blank">
                                                <?php echo ( $info_icons ) ? '<i class="fab fa-whatsapp"></i>&nbsp;' : ''; ?>
                                                <?php echo esc_html( $agent_whatsapp ); ?>
                                            </a>
                                        </p>
                                        <?php
                                    }

                                    if ( ! empty( $agent_fax_number ) ) {
                                        ?>
                                        <p class="rh_agent__info fax number">
                                            <a href="fax:<?php echo esc_attr( $agent_fax_number ); ?>">
                                                <?php echo ( $info_icons ) ? '<i class="fas fa-fax"></i>&nbsp;' : ''; ?>
                                                <?php echo esc_html( $agent_fax_number ); ?>
                                            </a>
                                        </p>
                                        <?php
                                    }

                                    if ( ! empty( $agent_license ) ) {
                                        ?>
                                        <p class="rh_agent__info license number">
                                            <?php echo ( $info_icons ) ? '<i class="fas fa-id-card"></i>&nbsp;' : ''; ?>
                                            <?php echo esc_html( $agent_license ); ?>
                                        </p>
                                        <?php
                                    }

                                    if ( ! empty( $agent_website ) ) {
                                        ?>
                                        <p class="rh_agent__info website">
                                            <a href="<?php echo esc_url( $agent_website ); ?>" target="_blank">
                                                <?php echo ( $info_icons ) ? '<i class="fas fa-link"></i> &nbsp;' : ''; ?>
                                                <?php echo esc_url( $agent_website ); ?>
                                            </a>
                                        </p>
                                        <?php
                                    }

                                    if ( ! empty( $agent_email ) ) {
                                        ?>
                                        <a href="mailto:<?php echo esc_attr( antispambot( $agent_email ) ); ?>"
                                           class="rh_agent__email">
                                            <?php echo ( $info_icons ) ? '<i class="fas fa-envelope"></i>&nbsp;' : ''; ?>
                                            <?php echo esc_html( antispambot( $agent_email ) ); ?>
                                        </a>
                                        <?php
                                    }

                                    if (
                                        isset( $listed_properties ) &&
                                        $listed_properties > 0 &&
                                        $settings['properties_count'] === 'yes'
                                    ) {
                                        ?>
                                        <div class="rh_agent__listed">
                                            <p class="figure"><?php echo esc_html( $listed_properties ); ?></p>
                                            <p class="heading"><?php echo ( 1 === $listed_properties ) ? esc_html__( 'Listed Property', 'realhomes-elementor-addon' ) : esc_html__( 'Listed Properties', 'realhomes-elementor-addon' ); ?></p>
                                        </div>
                                        <?php
                                    }

                                    if ( $settings['social_icons'] === 'yes' ) {
                                        $facebook  = get_post_meta( $agent_id, 'REAL_HOMES_facebook_url', true );
                                        $twitter   = get_post_meta( $agent_id, 'REAL_HOMES_twitter_url', true );
                                        $linkedin  = get_post_meta( $agent_id, 'REAL_HOMES_linked_in_url', true );
                                        $instagram = get_post_meta( $agent_id, 'inspiry_instagram_url', true );
                                        $pinterest = get_post_meta( $agent_id, 'inspiry_pinterest_url', true );
                                        $youtube   = get_post_meta( $agent_id, 'inspiry_youtube_url', true );
                                        ?>
                                        <ul class="rh_agent__social_icons">
                                            <?php
                                            if ( ! empty( $facebook ) ) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $facebook ); ?>" target="_blank">
                                                        <i class="fab fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <?php
                                            }

                                            if ( ! empty( $twitter ) ) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $twitter ); ?>" target="_blank">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <?php
                                            }

                                            if ( ! empty( $linkedin ) ) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank">
                                                        <i class="fab fa-linkedin"></i>
                                                    </a>
                                                </li>
                                                <?php
                                            }

                                            if ( ! empty( $instagram ) ) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $instagram ); ?>" target="_blank">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                                <?php
                                            }

                                            if ( ! empty( $pinterest ) ) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $pinterest ); ?>" target="_blank">
                                                        <i class="fab fa-pinterest"></i>
                                                    </a>
                                                </li>
                                                <?php
                                            }

                                            if ( ! empty( $youtube ) ) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $youtube ); ?>" target="_blank">
                                                        <i class="fab fa-youtube"></i>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                        <?php
                                    }

                                    if ( 'yes' == $settings['display_arrow'] ) {
                                        ?>
                                        <span class="rh_agent__arrow">
                                            <a href="<?php the_permalink(); ?>"><?php include( RHEA_ASSETS_DIR . '/icons/arrow-right.svg' ); ?></a>
										</span>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </article>
						<?php
					}
                    
					wp_reset_postdata();
					?>
                </div>

            </div>
			<?php
		}

	}

}