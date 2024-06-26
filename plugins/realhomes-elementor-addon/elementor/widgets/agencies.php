<?php
/**
 * Creating Agencies Listing widget for elementor
 *
 * @since 1.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Agencies_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rhea-agencies-widget';
	}

	public function get_title() {
		return esc_html__( 'Agencies Listing', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'agencies_section',
			[
				'label' => esc_html__( 'Listing Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'rhea_agency_variations',
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
			'agency_grid_layout',
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
			'number_of_agencies',
			[
				'label'   => esc_html__( 'Number of Agents', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
				'default' => 4,
			]
		);

		$thumb_size_array = wp_get_additional_image_sizes();

		$agency_grid_size_array = array();
        if( is_array( $thumb_size_array ) ){
	        foreach ( $thumb_size_array as $key => $value ) {
		        $str_rpl_key = ucwords( str_replace( "-", " ", $key ) );
		        $agency_grid_size_array[ $key ] = $str_rpl_key . ' - ' . $value['width'] . 'x' . $value['height'];
	        }
        }

		unset( $agency_grid_size_array['1536x1536'] );
		unset( $agency_grid_size_array['2048x2048'] );
		unset( $agency_grid_size_array['partners-logo'] );
		unset( $agency_grid_size_array['post-thumbnail'] );
		unset( $agency_grid_size_array['post-featured-image'] );

		$this->add_control(
			'agency_thumb_sizes_select',
			[
				'label'   => esc_html__( 'Agency Thumbnail Size', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'agent-image',
				'options' => $agency_grid_size_array
			]
		);

		$this->add_control(
			'agency_mobile_number',
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
			'agency_office_number',
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
			'agency_whatsapp_number',
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
			'agency_fax_number',
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
			'agency_website',
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
			'agency_address',
			[
				'label'        => esc_html__( 'Address', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'agency_email',
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

		$this->add_control(
			'view_more_agencies',
			[
				'label'        => esc_html__( 'View All Button', 'realhomes-elementor-addon' ),
				'desc'         => esc_html__( 'Do you want to show the View All button.', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'view_all_button_text',
			[
				'label'     => esc_html__( 'View All Button Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'View All', 'realhomes-elementor-addon' ),
				'condition' => [
					'view_more_agencies' => 'yes',
				]
			]
		);

		$this->add_control(
			'view_all_button_url',
			[
				'label'     => esc_html__( 'View All Button URL', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::URL,
				'condition' => [
					'view_more_agencies' => 'yes',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'agency_section_typography',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agency_title_typography',
				'label'    => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_agent_elementor .rh_agent__details h3 a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agency_number_typography',
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
				'name'     => 'agency_website_typography',
				'label'    => esc_html__( 'Website', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__info.website a'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agency_address_typography',
				'label'    => esc_html__( 'Address', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__info.address'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agency_email_typography',
				'label'    => esc_html__( 'Email', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__email',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agency_figure_typography',
				'label'    => esc_html__( 'Listed Figure', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__listed .figure',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agency_label_typography',
				'label'    => esc_html__( 'Listed Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__listed .heading',
			]
		);

		$this->add_responsive_control(
			'agency_social_icon_size',
			[
				'label'     => esc_html__( 'Social Icons Size', 'realhomes-elementor-addon' ),
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

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'view_all_button_typography',
				'label'    => esc_html__( 'View All Button', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_wrapper__agents_elementor .rhea-view-all a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'agency_styles_sizes',
			[
				'label' => esc_html__( 'Size And Position', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'agency_width',
			[
				'label'       => esc_html__( 'Agency Width (%)', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'This will over-ride the width of "Content -> Layout"', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'range'       => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .rh_agent_elementor' => 'width: {{SIZE}}%;',

				],
			]
		);

		$this->add_responsive_control(
			'agency_thumb_position',
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
			'agencies_spacing_section',
			[
				'label' => esc_html__( 'Spacings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'agency_card_padding',
			[
				'label'      => esc_html__( 'Agency Card Inner Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_agent__wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'agency_vertical_spacings',
			[
				'label'     => esc_html__( 'Vertical Space between Agencies (px)', 'realhomes-elementor-addon' ),
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
			'agency_title_spacings_top',
			[
				'label'     => esc_html__( 'Agency Title Margin Top (px)', 'realhomes-elementor-addon' ),
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
			'agency_title_spacings_bottom',
			[
				'label'     => esc_html__( 'Agency Title Margin Bottom (px)', 'realhomes-elementor-addon' ),
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
			'agency_number_spacings',
			[
				'label'     => esc_html__( 'Agency Numbers Margin Bottom (px)', 'realhomes-elementor-addon' ),
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
			'agency_website_spacings',
			[
				'label'     => esc_html__( 'Agency Website Margin Bottom (px)', 'realhomes-elementor-addon' ),
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
			'agency_address_spacings',
			[
				'label'     => esc_html__( 'Agency Address Margin Bottom (px)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_agent__details .rh_agent__info.address' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'agency_email_spacings',
			[
				'label'     => esc_html__( 'Agency Email Margin Bottom (px)', 'realhomes-elementor-addon' ),
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
			'agency_figure_spacings',
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
			'agency_listed_properties_spacings',
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
			'agency_social_middle_spacings',
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

		$this->add_responsive_control(
			'view_all_button_padding',
			[
				'label'      => esc_html__( 'View All Button Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_wrapper__agents_elementor .rhea-view-all a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'agency_styles',
			[
				'label' => esc_html__( 'Agency Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'agency_bg_color',
			[
				'label'     => esc_html__( 'Agency Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__wrap' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agency_title_color',
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
			'agency_title_hover_color',
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
			'agency_numbers_color',
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
			'agency_numbers_hover_color',
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
			'agency_website_color',
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
			'agency_website_hover_color',
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
			'agency_address_color',
			[
				'label'     => esc_html__( 'Address', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__details .rh_agent__info.address' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agency_email_color',
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
			'agency_email_hover_color',
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
			'agency_figure_color',
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
			'agency_listed_figure_color',
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
			'agency_social_icons_color',
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
			'agency_social_icons_hover',
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
			'agency_arrow_circle',
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
			'agency_arrow',
			[
				'label'     => esc_html__( 'Arrow Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_agent_elementor .rh_agent__arrow .cls-2' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'view_all_button_background',
			[
				'label'     => esc_html__( 'View All Button Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_wrapper__agents_elementor .rhea-view-all a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'view_all_button_text_color',
			[
				'label'     => esc_html__( 'View All Button Text Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_wrapper__agents_elementor .rhea-view-all a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'view_all_button_hover_background',
			[
				'label'     => esc_html__( 'View All Hover Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_wrapper__agents_elementor .rhea-view-all a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'view_all_button_hover_text_color',
			[
				'label'     => esc_html__( 'View All Hover Text Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rh_wrapper__agents_elementor .rhea-view-all a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'agency_box_shadow',
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

		$settings = $this->get_settings_for_display();

		// Number of agents
		if ( ! $settings['number_of_agencies'] ) {
			$settings['number_of_agencies'] = 4;
		}

		$agencies_args = array(
			'post_type'      => 'agency',
			'posts_per_page' => $settings['number_of_agencies'],
		);

		$agencies_query = new WP_Query( apply_filters( 'rhea_modern_agencies_widget', $agencies_args ) );

		if ( $agencies_query->have_posts() ) {
			?>
            <div class="rh_elementor_widget rh_wrapper__agents_elementor <?php echo esc_attr( $settings['rhea_agency_variations'] ); ?>">

                <div class="rh_section__agents_elementor">
					<?php
					while ( $agencies_query->have_posts() ) {

						$agencies_query->the_post();

						$agency_id   = get_the_ID();
						$agency_meta = array();

						if ( $settings['agency_mobile_number'] === 'yes' ) {
							$agency_meta['mobile'] = get_post_meta( $agency_id, 'REAL_HOMES_mobile_number', true );
						}

						if ( $settings['agency_office_number'] === 'yes' ) {
							$agency_meta['office'] = get_post_meta( $agency_id, 'REAL_HOMES_office_number', true );
						}

						if ( $settings['agency_whatsapp_number'] === 'yes' ) {
							$agency_meta['whatsapp'] = get_post_meta( $agency_id, 'REAL_HOMES_whatsapp_number', true );
						}

						if ( $settings['agency_fax_number'] === 'yes' ) {
							$agency_meta['fax'] = get_post_meta( $agency_id, 'REAL_HOMES_fax_number', true );
						}

						if ( $settings['agency_website'] === 'yes' ) {
							$agency_meta['website'] = get_post_meta( $agency_id, 'REAL_HOMES_website', true );
						}

						if ( $settings['agency_address'] === 'yes' ) {
							$agency_meta['address'] = get_post_meta( $agency_id, 'REAL_HOMES_address', true );
						}

						if ( $settings['agency_email'] === 'yes' ) {
							$agency_meta['email'] = get_post_meta( $agency_id, 'REAL_HOMES_agency_email', true );
						}

						if ( $settings['meta_icons'] === 'yes' ) {
							$info_icons = true;
						} else {
							$info_icons = false;
						}

						if ( $settings['properties_count'] === 'yes' && function_exists( 'ere_get_agency_properties_count' ) ) {
							$agency_meta['listed_properties'] = ere_get_agency_properties_count( $agency_id );
						}
						?>
                        <article <?php post_class( 'rh_agent_elementor' ); ?>>
                            <div class="rh_agent__wrap">
                                <div class="rh_agent__thumbnail">
                                    <a href="<?php the_permalink(); ?>">
										<?php
										if ( has_post_thumbnail() ) {
											if ( ! empty( $settings['agency_thumb_sizes_select'] ) ) {
												the_post_thumbnail( $settings['agency_thumb_sizes_select'] );
											} else {
												the_post_thumbnail( 'agency-image' );
											}
										}
										?>
                                    </a>
                                </div>

                                <div class="rh_agent__details">

                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

									<?php
									if ( isset( $agency_meta['mobile'] ) && ! empty( $agency_meta['mobile'] ) ) {
										?>
                                        <p class="rh_agent__info phone number">
                                            <a href="tel:<?php echo esc_attr( $agency_meta['mobile'] ); ?>">
												<?php echo ( $info_icons ) ? '<i class="fas fa-mobile-alt"></i>&nbsp;' : ''; ?><?php echo esc_html( $agency_meta['mobile'] ); ?>
                                            </a>
                                        </p>
										<?php
									}

									if ( isset( $agency_meta['office'] ) && ! empty( $agency_meta['office'] ) ) {
										?>
                                        <p class="rh_agent__info phone number">
                                            <a href="tel:<?php echo esc_attr( $agency_meta['office'] ); ?>">
												<?php echo ( $info_icons ) ? '<i class="fas fa-phone"></i>&nbsp;' : ''; ?><?php echo esc_html( $agency_meta['office'] ); ?>
                                            </a>
                                        </p>
										<?php
									}

									if ( isset( $agency_meta['whatsapp'] ) && ! empty( $agency_meta['whatsapp'] ) ) {
										$agency_whatsapp_link = 'https://wa.me/' . str_replace( '-', '', $agency_meta['whatsapp'] );
										?>
                                        <p class="rh_agent__info whatsapp number">
                                            <a href="<?php echo esc_url( $agency_meta['whatsapp'] ); ?>" target="_blank">
												<?php echo ( $info_icons ) ? '<i class="fab fa-whatsapp"></i>&nbsp;' : ''; ?><?php echo esc_html( $agency_meta['whatsapp'] ); ?>
                                            </a>
                                        </p>
										<?php
									}

									if ( isset( $agency_meta['fax'] ) && ! empty( $agency_meta['fax'] ) ) {
										?>
                                        <p class="rh_agent__info fax number">
                                            <a href="fax:<?php echo esc_attr( $agency_meta['fax'] ); ?>">
												<?php echo ( $info_icons ) ? '<i class="fas fa-fax"></i>&nbsp;' : ''; ?><?php echo esc_html( $agency_meta['fax'] ); ?>
                                            </a>
                                        </p>
										<?php
									}

									if ( isset( $agency_meta['website'] ) && ! empty( $agency_meta['website'] ) ) {
										?>
                                        <p class="rh_agent__info website">
                                            <a href="<?php echo esc_url( $agency_meta['website'] ); ?>" target="_blank">
												<?php echo ( $info_icons ) ? '<i class="fas fa-link"></i> &nbsp;' : ''; ?><?php echo esc_url( $agency_meta['website'] ); ?>
                                            </a>
                                        </p>
										<?php
									}

									if ( isset( $agency_meta['address'] ) && ! empty( $agency_meta['address'] ) ) {
										?>
                                        <p class="rh_agent__info address">
											<?php echo ( $info_icons ) ? '<i class="fas fa-home"></i> &nbsp;' : ''; ?><?php echo esc_html( $agency_meta['address'] ); ?>
                                        </p>
										<?php
									}

									if ( isset( $agency_meta['email'] ) && ! empty( $agency_meta['email'] ) ) {
										?>
                                        <a href="mailto:<?php echo esc_attr( antispambot( $agency_meta['email'] ) ); ?>" class="rh_agent__email">
											<?php echo ( $info_icons ) ? '<i class="fas fa-envelope"></i>&nbsp;' : ''; ?><?php echo esc_html( antispambot( $agency_meta['email'] ) ); ?>
                                        </a>
										<?php
									}

									if ( isset( $agency_meta['listed_properties'] ) && 0 < $agency_meta['listed_properties'] ) {
										?>
                                        <div class="rh_agent__listed">
                                            <p class="figure"><?php echo esc_html( $agency_meta['listed_properties'] ); ?></p>
                                            <p class="heading"><?php echo ( 1 === $agency_meta['listed_properties'] ) ? esc_html__( 'Listed Property', 'realhomes-elementor-addon' ) : esc_html__( 'Listed Properties', 'realhomes-elementor-addon' ); ?></p>
                                        </div>
										<?php
									}

									if ( $settings['social_icons'] === 'yes' ) {
										$facebook  = get_post_meta( $agency_id, 'REAL_HOMES_facebook_url', true );
										$twitter   = get_post_meta( $agency_id, 'REAL_HOMES_twitter_url', true );
										$linkedin  = get_post_meta( $agency_id, 'REAL_HOMES_linked_in_url', true );
										$instagram = get_post_meta( $agency_id, 'inspiry_instagram_url', true );
										$pinterest = get_post_meta( $agency_id, 'inspiry_pinterest_url', true );
										$youtube   = get_post_meta( $agency_id, 'inspiry_youtube_url', true );
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
				<?php
				if ( $settings['view_more_agencies'] === 'yes' ) {
					$button_label = $settings['view_all_button_text'] ?? esc_html__( 'Agency Colors', 'realhomes-elementor-addon' );
					$url_array    = $settings['view_all_button_url'] ?? '';
					$button_url   = $url_array['url'];
					$target       = $url_array['is_external'] ? 'target=_blank' : '';
					$follow       = $url_array['nofollow'] ? 'rel=nofollow' : '';

					if ( ! empty( $button_url ) ) {
						?>
                        <p class="rhea-view-all">
                            <a href="<?php echo esc_url( $button_url ); ?>" <?php echo esc_attr( $target ); ?> <?php echo esc_attr( $follow ); ?>><?php echo esc_html( $button_label ); ?></a>
                        </p>
						<?php
					}
				}
				?>
            </div>
			<?php
		}

	}

}