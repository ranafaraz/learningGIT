<?php
/**
 * Schedule a tour elementor widget
 *
 * @since 2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Schedule_Tour_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rhea-schedule-tour-widget';
	}

	public function get_title() {
		return esc_html__( 'Schedule A Tour', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	public function get_script_depends() {

		wp_register_script(
			'rhea-schedule-tour-widget-js',
			RHEA_PLUGIN_URL . 'elementor/js/schedule-tour-widget.js',
			[ 'elementor-frontend' ],
			RHEA_VERSION,
			true
		);

		return [
			'rhea-schedule-tour-widget-js'
		];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'left_area_settings',
			[
				'label' => esc_html__( 'Left Area Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// This option will appear only if there are more than 1 properties available.
		$this->add_control(
			'schedule_left_view_type',
			[
				'label'       => esc_html__( 'Left Area Contents', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'Select what type of content you want to show on the left area box.', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'property',
				'options'     => [
					'property' => esc_html__( 'Property', 'realhomes-elementor-addon' ),
					'agent'    => esc_html__( 'Agent', 'realhomes-elementor-addon' ),
					'nearby'   => esc_html__( 'Nearby Places', 'realhomes-elementor-addon' ),
					'gallery'  => esc_html__( 'Gallery', 'realhomes-elementor-addon' )
				]
			]
		);

		$this->add_control(
			'left_area_title',
			[
				'label'       => esc_html__( 'Left Area Title', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Near By Places', 'realhomes-elementor-addon' ),
				'condition'   => [
					'schedule_left_view_type' => 'nearby'
				]
			]
		);

		// Property Handler options
		$properties_loop = get_posts( array(
			'post_type'        => 'property',
			'posts_per_page'   => -1,
			'suppress_filters' => false,
		) );

		$sat_properties['none'] = esc_html__( 'None', 'realhomes-elementor-addon' );
		if ( ! is_wp_error( $properties_loop ) && is_array( $properties_loop ) ) {
			foreach ( $properties_loop as $property ) {
				$sat_properties[ $property->ID ] = $property->post_title;
			}
		}

		if ( 0 < count( $sat_properties ) ) {

			$this->add_control(
				'schedule_tour_property',
				[
					'label'       => esc_html__( 'Select Property', 'realhomes-elementor-addon' ),
					'description' => esc_html__( 'Select property you want to show on the left side.', 'realhomes-elementor-addon' ),
					'type'        => \Elementor\Controls_Manager::SELECT,
					'default'     => 'none',
					'options'     => $sat_properties,
					'condition'   => [
						'schedule_left_view_type' => 'property'
					]
				]
			);

			$this->add_control(
				'property_read_more_text', [
					'label'     => esc_html__( 'Read More Text', 'realhomes-elementor-addon' ),
					'type'      => \Elementor\Controls_Manager::TEXT,
					'default'   => esc_html__( 'Read More..', 'realhomes-elementor-addon' ),
					'condition' => [
						'schedule_left_view_type' => 'property'
					]
				]
			);
		}

		// Agent related options
		$agents_loop = get_posts( array(
			'post_type'        => 'agent',
			'posts_per_page'   => -1,
			'suppress_filters' => false,
		) );

		$sat_agents['none'] = esc_html__( 'None', 'realhomes-elementor-addon' );
		if ( ! is_wp_error( $agents_loop ) && is_array( $agents_loop ) ) {
			foreach ( $agents_loop as $agent ) {
				$sat_agents[ $agent->ID ] = $agent->post_title;
			}
		}

		if ( 1 < count( $sat_agents ) ) {

			// This option will appear only if there are more than 1 properties available.
			$this->add_control(
				'left_area_agent',
				[
					'label'       => esc_html__( 'Related Agent', 'realhomes-elementor-addon' ),
					'description' => esc_html__( 'Select agent you want to show on the left side.', 'realhomes-elementor-addon' ),
					'type'        => \Elementor\Controls_Manager::SELECT,
					'default'     => 'none',
					'options'     => $sat_agents,
					'condition'   => [
						'schedule_left_view_type' => 'agent'
					]
				]
			);
		}

		$this->add_control(
			'view_agent_detail_text', [
				'label'     => esc_html__( 'View Agent Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'View Agent..', 'realhomes-elementor-addon' ),
				'condition' => [
					'schedule_left_view_type' => 'agent'
				]
			]
		);

		// Nearby related options
		$nearby_places = new \Elementor\Repeater();

		$nearby_places->add_control(
			'nearby_place_title', [
				'label' => esc_html__( 'Place Title', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::TEXT
			]
		);

		$nearby_places->add_control(
			'nearby_place_subtitle', [
				'label' => esc_html__( 'Sub Title', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::TEXT
			]
		);

		$nearby_places->add_control(
			'nearby_place_icon_type',
			[
				'label'   => esc_html__( 'Select Feature Icon Type', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'image',
				'options' => array(
					'image' => esc_html__( 'Image', 'realhomes-elementor-addon' ),
					'icon'  => esc_html__( 'Icon', 'realhomes-elementor-addon' ),
				),
			]
		);

		$nearby_places->add_control(
			'nearby_place_image',
			[
				'label'     => esc_html__( 'Choose Image', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'nearby_place_icon_type' => 'image',
				],
			]
		);

		$nearby_places->add_control(
			'nearby_place_icon',
			[
				'label'     => esc_html__( 'Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => [
					'nearby_place_icon_type' => 'icon',
				],
			]
		);

		$nearby_places->add_control(
			'nearby_distance',
			[
				'label'       => esc_html__( 'Distance', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Provide the distance to this place.', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'nearby_places_repeat_list',
			[
				'label'       => esc_html__( 'Nearby Places List', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $nearby_places->get_controls(),
				'title_field' => '{{{ nearby_place_title }}}',
				'condition'   => [
					'schedule_left_view_type' => 'nearby'
				]
			]
		);

		// Gallery related options
		$this->add_control(
			'left_area_gallery',
			[
				'label'      => esc_html__( 'Add Gallery Images', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::GALLERY,
				'show_label' => true,
				'condition'  => [
					'schedule_left_view_type' => 'gallery'
				]
			]
		);

		$this->add_control(
			'gallery_description',
			[
				'label'       => esc_html__( 'Contents', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'Gallery Details', 'realhomes-elementor-addon' ),
				'placeholder' => esc_html__( 'Provide custom contents here', 'realhomes-elementor-addon' ),
				'condition'   => [
					'schedule_left_view_type' => 'gallery'
				]
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'right_area_settings',
			[
				'label' => esc_html__( 'Right Area Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'right_area_calendar_title',
			[
				'label'       => esc_html__( 'Date & Time Title', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Select a suitable day and time', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'rhea_sat_time_slots',
			[
				'label'       => esc_html__( 'Time Slots', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'Add time slots by providing comma (,) separated values. (For example: 12:00 am,12:15 am, 12:30 am)', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '10:00 am,10:15 pm,10:30 pm,12:00 pm,12:15 pm,12:30 pm,12:45 pm,01:00 pm,01:15 pm,01:30 pm,01:45 pm,02:00 pm,05:00 pm', 'realhomes-elementor-addon' )
			]
		);

		$this->add_control(
			'right_area_form_title',
			[
				'label'       => esc_html__( 'Form title', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Fill out your information', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'right_area_next_button_text',
			[
				'label'       => esc_html__( 'Next Button Text', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Next', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'right_area_in_person_title',
			[
				'label'       => esc_html__( 'In Person Title', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'In Person', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'right_area_video_call_title',
			[
				'label'       => esc_html__( 'Video Call Title', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Video Call', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'form_name_placeholder',
			[
				'label'       => esc_html__( 'Name Field Placeholder', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Your Name', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'form_name_error_message',
			[
				'label'       => esc_html__( 'Name Field Error Message', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Provide your name', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'form_phone_placeholder',
			[
				'label'       => esc_html__( 'Phone Field Placeholder', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Your Phone', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'form_email_placeholder',
			[
				'label'       => esc_html__( 'Email Field Placeholder', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Your Email', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'form_email_error_message',
			[
				'label'       => esc_html__( 'Email Field Error Message', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Provide your email ID', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'form_message_placeholder',
			[
				'label'       => esc_html__( 'Message Field Placeholder', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Your Message', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'right_area_back_button_text',
			[
				'label'       => esc_html__( 'Back Button Text', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Back', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'right_area_submit_button_text',
			[
				'label'       => esc_html__( 'Schedule Button Text', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Submit', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'schedule_form_target_property',
			[
				'label'       => esc_html__( 'Target Property', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'Select property you want to schedule a tour for. If no property is selected then very first property of the site will be targeted.', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'none',
				'options'     => $sat_properties,
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'schedule_send_copy_to_admin',
			[
				'label'       => esc_html__( 'Send copy to admin', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'Select Yes if you want to send the copy of a tour email to the site admin as well.', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'no',
				'options'     => [
					'yes' => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
					'no'  => esc_html__( 'No', 'realhomes-elementor-addon' )
				]
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'sat_main_styles',
			[
				'label' => esc_html__( 'Main Wrapper Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_bg_color',
			[
				'label'     => esc_html__( 'Wrapper Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container' => 'background: {{VALUE}};',
				],
				'default'   => '#f4f7ff',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'left_area_styles',
			[
				'label'     => esc_html__( 'Left Area', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'left_section_title_color',
			[
				'label'     => esc_html__( 'Section Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .nearby-title' => 'color: {{VALUE}};',
				],
				'default'   => '#FFFFFFB8',
				'condition' => [
					'schedule_left_view_type' => 'nearby'
				]
			]
		);

		$this->add_control(
			'left_title_bottom_padding',
			[
				'label'      => esc_html__( 'Left area title bottom padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 17,
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .nearby-title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'schedule_left_view_type' => 'nearby'
				]
			]
		);

		$this->add_control(
			'left_section_title_bottom_margin',
			[
				'label'      => esc_html__( 'Left Title Bottom Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .nearby-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'schedule_left_view_type' => 'nearby'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'background_left_area',
				'label'    => esc_html__( 'Area Background', 'realhomes-elementor-addon' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-left',
			]
		);

		$this->add_control(
			'right_area_styles',
			[
				'label'     => esc_html__( 'Right Area', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'background_right_area',
				'label'    => esc_html__( 'Right Area Background', 'realhomes-elementor-addon' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-right',
			]
		);

		$this->add_control(
			'right_area_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-right .section-title' => 'color: {{VALUE}};',
				],
				'default'   => '#333'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'right_title_typography',
				'label'    => esc_html__( 'Right Title Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-right .section-title',
			]
		);

		$this->add_control(
			'right_section_title_bottom_margin',
			[
				'label'      => esc_html__( 'Right Title Bottom Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-right .section-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'sat_property_styles',
			[
				'label'     => esc_html__( 'Property Styles', 'realhomes-elementor-addon' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'schedule_left_view_type' => 'property'
				]
			]
		);

		$this->add_control(
			'property_info_background_color',
			[
				'label'     => esc_html__( 'Property Info Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .property-info' => 'background: {{VALUE}};',
				],
				'default'   => '#FFFFFFB8'
			]
		);

		$this->add_control(
			'property_info_padding',
			[
				'label'      => esc_html__( 'Property Info Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .property-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_info_title_typography',
				'label'    => esc_html__( 'Property Title Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-left .property-info h3',
			]
		);

		$this->add_control(
			'property_info_title_color',
			[
				'label'     => esc_html__( 'Property Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .property-info h3 a' => 'color: {{VALUE}};',
				],
				'default'   => '#333'
			]
		);

		$this->add_control(
			'property_info_title_bottom_space',
			[
				'label'      => esc_html__( 'Property Title Bottom Space', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .property-info h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_info_content_typography',
				'label'    => esc_html__( 'Property Content Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-left .property-info p',
			]
		);

		$this->add_control(
			'property_info_text_color',
			[
				'label'     => esc_html__( 'Property Text Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .property-info p' => 'color: {{VALUE}};',
				],
				'default'   => '#333'
			]
		);

		$this->add_control(
			'property_info_link_color',
			[
				'label'     => esc_html__( 'Property Read More Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .property-info p a' => 'color: {{VALUE}};',
				],
				'default'   => '#0054a6'
			]
		);

		$this->add_control(
			'property_info_link_hover',
			[
				'label'     => esc_html__( 'Property Read More Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .property-info p a:hover' => 'color: {{VALUE}};',
				],
				'default'   => '#333'
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'sat_agent_styles',
			[
				'label'     => esc_html__( 'Agent Styles', 'realhomes-elementor-addon' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'schedule_left_view_type' => 'agent'
				]
			]
		);

		$this->add_control(
			'agent_wrap_background_color',
			[
				'label'     => esc_html__( 'Agent Wrapper Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info' => 'background: {{VALUE}};',
				],
				'default'   => '#ffffffc9'
			]
		);

		$this->add_control(
			'agent_wrap_padding',
			[
				'label'      => esc_html__( 'Agent Wrapper Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'agent_image_margins',
			[
				'label'      => esc_html__( 'Agent Image Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info .rhea-agent-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'agent_social_icons_color',
			[
				'label'     => esc_html__( 'Social Icons Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info .rhea-agent-image .social a' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'agent_social_icons_hover_color',
			[
				'label'     => esc_html__( 'Social Icons Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info .rhea-agent-image .social a:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_title_typography',
				'label'    => esc_html__( 'Agent Title Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info h3',
			]
		);

		$this->add_control(
			'agent_title_color',
			[
				'label'     => esc_html__( 'Agent Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info h3 a' => 'color: {{VALUE}};',
				],
				'default'   => '#333'
			]
		);

		$this->add_control(
			'agent_title_hover_color',
			[
				'label'     => esc_html__( 'Agent Title Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info h3 a:hover' => 'color: {{VALUE}};',
				],
				'default'   => '#1cb2ff'
			]
		);

		$this->add_control(
			'agent_title_bottom_space',
			[
				'label'      => esc_html__( 'Property Title Bottom Space', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_content_typography',
				'label'    => esc_html__( 'Agent Content Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info p',
			]
		);

		$this->add_control(
			'agent_text_color',
			[
				'label'     => esc_html__( 'Property Text Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info p' => 'color: {{VALUE}};',
				],
				'default'   => '#333'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_button_typography',
				'label'    => esc_html__( 'Agent Button Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info .rh-btn-primary',
			]
		);

		$this->add_control(
			'agent_button_background_color',
			[
				'label'     => esc_html__( 'Agent Button Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info .rh-btn-primary' => 'background-color: {{VALUE}};',
				],
				'default'   => '#1cb2ff'
			]
		);

		$this->add_control(
			'agent_button_text',
			[
				'label'     => esc_html__( 'Agent Button Text Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info .rh-btn-primary' => 'color: {{VALUE}};',
				],
				'default'   => '#fff'
			]
		);

		$this->add_control(
			'agent_button_background_hover_color',
			[
				'label'     => esc_html__( 'Agent Button Hover Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info .rh-btn-primary:hover' => 'background-color: {{VALUE}};',
				],
				'default'   => '#0054a5'
			]
		);

		$this->add_control(
			'agent_button_hover_text',
			[
				'label'     => esc_html__( 'Agent Button Hover Text Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .agent-info .rh-btn-primary:hover' => 'color: {{VALUE}};',
				],
				'default'   => '#fff'
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'sat_nearby_styles',
			[
				'label'     => esc_html__( 'Nearby Styles', 'realhomes-elementor-addon' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'schedule_left_view_type' => 'nearby'
				]
			]
		);

		$this->add_control(
			'nearby_item_background_color',
			[
				'label'     => esc_html__( 'Near by item background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .places-list li' => 'background: {{VALUE}};',
				],
				'default'   => '#ffffff77'
			]
		);

		$this->add_control(
			'nearby_item_background_hover_color',
			[
				'label'     => esc_html__( 'Near by item background hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .places-list li:hover' => 'background: {{VALUE}};',
				],
				'default'   => '#ffffffaa'
			]
		);

		$this->add_control(
			'nearby_item_padding',
			[
				'label'      => esc_html__( 'Nearby Item Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .places-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'schedule_left_view_type' => 'nearby'
				]
			]
		);

		$this->add_control(
			'nearby_icon_bg',
			[
				'label'     => esc_html__( 'Icon Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .places-list li figure' => 'background: {{VALUE}};',
				],
				'default'   => '#f4f7ff'
			]
		);

		$this->add_control(
			'nearby_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .places-list li figure i' => 'color: {{VALUE}};',
				],
				'default'   => '#0054a6'
			]
		);

		$this->add_control(
			'nearby_figure_padding',
			[
				'label'      => esc_html__( 'Icon Container Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .places-list li figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'schedule_left_view_type' => 'nearby'
				]
			]
		);

		$this->add_control(
			'nearby_item_figure_right_margin',
			[
				'label'      => esc_html__( 'Nearby Icon Right Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .places-list li figure' => 'margin-right: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'nearby_title_typography',
				'label'    => esc_html__( 'Nearby Title Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .places-list li h4',
			]
		);

		$this->add_control(
			'nearby_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .places-list li h4' => 'color: {{VALUE}};',
				],
				'default'   => '#333'
			]
		);

		$this->add_control(
			'nearby_item_title_bottom_margin',
			[
				'label'      => esc_html__( 'Nearby Item Title Bottom Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .places-list li h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'nearby_subtitle_typography',
				'label'    => esc_html__( 'Nearby Sub Title Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .places-list li h5',
			]
		);

		$this->add_control(
			'nearby_sub_title_color',
			[
				'label'     => esc_html__( 'Sub Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .places-list li h5' => 'color: {{VALUE}};',
				],
				'default'   => '#808080'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'nearby_distance_typography',
				'label'    => esc_html__( 'Nearby Distance Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .places-list li .number',
			]
		);

		$this->add_control(
			'nearby_distance_color',
			[
				'label'     => esc_html__( 'Distance Value Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .nearby-places .places-list li .number' => 'color: {{VALUE}};',
				],
				'default'   => 'red'
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'sat_gallery_styles',
			[
				'label'     => esc_html__( 'Gallery Styles', 'realhomes-elementor-addon' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'schedule_left_view_type' => 'gallery'
				]
			]
		);

		$this->add_control(
			'gallery_info_background',
			[
				'label'     => esc_html__( 'Content Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info' => 'background-color: {{VALUE}};',
				],
				'default'   => '#ffffffb8'
			]
		);

		$this->add_control(
			'gallery_info_location',
			[
				'label'      => esc_html__( 'Area Location', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'gallery_h1_typography',
				'label'    => esc_html__( 'Gallery H1 Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info h1',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'gallery_h2_typography',
				'label'    => esc_html__( 'Gallery H2 Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info h2',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'gallery_h3_typography',
				'label'    => esc_html__( 'Gallery H3 Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info h3',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'gallery_h4_typography',
				'label'    => esc_html__( 'Gallery H4 Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info h4',
			]
		);

		$this->add_control(
			'gallery_info_heading_color',
			[
				'label'     => esc_html__( 'Headings Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'
					{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info h1,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info h2,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info h3,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info h4,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info h5,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info h6
					' => 'color: {{VALUE}};',
				],
				'default'   => '#1a1a1a'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'gallery_content_typography',
				'label'    => esc_html__( 'Gallery Content Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info',
			]
		);

		$this->add_control(
			'gallery_info_content_color',
			[
				'label'     => esc_html__( 'Content Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'
					{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info p,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info ul li,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info ol li
					' => 'color: {{VALUE}};',
				],
				'default'   => '#1a1a1a'
			]
		);

		$this->add_control(
			'gallery_info_link_color',
			[
				'label'     => esc_html__( 'Link Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info a' => 'color: {{VALUE}};',
				],
				'default'   => '#0054a6'
			]
		);

		$this->add_control(
			'gallery_info_link_color_hover',
			[
				'label'     => esc_html__( 'Link Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info a:hover' => 'color: {{VALUE}};',
				],
				'default'   => '#1cb2ff'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'gallery_content_lists_typography',
				'label'    => esc_html__( 'Gallery Lists Typography', 'realhomes-elementor-addon' ),
				'selector' => '
				    {{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info ul li,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .gallery-info ol li
					',
			]
		);

		$this->add_control(
			'gallery_slider_dots_color',
			[
				'label'     => esc_html__( 'Slider Dots Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .slick-dots li button' => 'background-color: {{VALUE}};',
				],
				'default'   => '#fff'
			]
		);

		$this->add_control(
			'gallery_slider_dots_hover_color',
			[
				'label'     => esc_html__( 'Slider Dots Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .slick-dots li button:hover' => 'background-color: {{VALUE}};',
				],
				'default'   => '#1cb2ff'
			]
		);

		$this->add_control(
			'gallery_slider_dots_active_color',
			[
				'label'     => esc_html__( 'Slider Dots Active Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'
					{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .slick-dots li.slick-active button,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .slick-dots li.slick-active button:hover,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .slick-dots li.slick-active:hover button
					' => 'background-color: {{VALUE}};',
				],
				'default'   => '#0054a6'
			]
		);

		$this->add_control(
			'gallery_slider_dots_bottom_space',
			[
				'label'      => esc_html__( 'Bottom Space', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'gallery_slider_dots_space_between',
			[
				'label'      => esc_html__( 'Space Between', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-left .rhea-gallery-wrap .slick-dots li' => 'margin: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'sat_day_and_time_styles',
			[
				'label' => esc_html__( 'Day & Time Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'dnt_days_top_padding',
			[
				'label'      => esc_html__( 'Days Top Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.day-tiles' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dnt_days_bottom_padding',
			[
				'label'      => esc_html__( 'Days Bottom Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.day-tiles' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dnt_days_typography',
				'label'    => esc_html__( 'Days Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-field.day-tiles .week-day',
			]
		);

		$this->add_control(
			'days_color',
			[
				'label'     => esc_html__( 'Days Normal Text Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.day-tiles .week-day' => 'color: {{VALUE}};',
				],
				'default'   => '#808080'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dnt_active_day_typography',
				'label'    => esc_html__( 'Active Day Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-field.day-tiles .slide.slick-current .week-day',
			]
		);

		$this->add_control(
			'days_background_color_active',
			[
				'label'     => esc_html__( 'Active Day Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.day-tiles .slide.slick-current .week-day' => 'background-color: {{VALUE}};',
				],
				'default'   => '#fff'
			]
		);

		$this->add_control(
			'day_color_active',
			[
				'label'     => esc_html__( 'Active Day Text Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.day-tiles .slide.slick-current .week-day' => 'color: {{VALUE}};',
				],
				'default'   => '#333'
			]
		);

		$this->add_control(
			'dnt_times_top_padding',
			[
				'label'      => esc_html__( 'Times Top Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.time-tiles-wrap' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dnt_times_bottom_padding',
			[
				'label'      => esc_html__( 'Times Bottom Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.time-tiles-wrap' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dnt_times_typography',
				'label'    => esc_html__( 'Times Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-field.time-tiles-wrap .slide .time-tile',
			]
		);

		$this->add_control(
			'times_color',
			[
				'label'     => esc_html__( 'Times Normal Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.time-tiles-wrap .slide .time-tile' => 'color: {{VALUE}};',
				],
				'default'   => '#808080'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dnt_active_time_typography',
				'label'    => esc_html__( 'Active Time Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-field.time-tiles-wrap .slide.slick-current .time-tile',
			]
		);

		$this->add_control(
			'times_background_color_active',
			[
				'label'     => esc_html__( 'Active Time Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.time-tiles-wrap .slide.slick-current .time-tile' => 'background-color: {{VALUE}};',
				],
				'default'   => '#fff'
			]
		);

		$this->add_control(
			'time_color_active',
			[
				'label'     => esc_html__( 'Active Time Text Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.time-tiles-wrap .slide.slick-current .time-tile' => 'color: {{VALUE}};',
				],
				'default'   => '#333'
			]
		);

		$this->add_control(
			'dnt_times_bottom_margin',
			[
				'label'      => esc_html__( 'Times Bottom Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-right .schedule-fields' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'schedule_form_styles',
			[
				'label' => esc_html__( 'Schedule Form Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'visit_types_typography',
				'label'    => esc_html__( 'Visit Types Typography', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-sat-container .rhea-sat-form .tour-type .tour-field .label-head'
			]
		);

		$this->add_control(
			'visit_types_icon_size',
			[
				'label'      => esc_html__( 'Visit Type Icon Size', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.tour-type .tour-field .label-head i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'visit_type_icon_position',
			[
				'label'      => esc_html__( 'Icon Absolute Positeion', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.tour-type .tour-field .label-head i' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'form_visit_type_padding',
			[
				'label'      => esc_html__( 'Visit Type Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.tour-type .tour-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'form_visit_type_bottom_margin',
			[
				'label'      => esc_html__( 'Visit Type Bottom Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.tour-type' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'type_field_active_background',
			[
				'label'     => esc_html__( 'Visit Type Field Active Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.tour-type .tour-field:has(input:checked)' => 'background-color: {{VALUE}};',
				],
				'default'   => '#1cb2ff'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'form_fields_typography',
				'label'    => esc_html__( 'Form Fields Typography', 'realhomes-elementor-addon' ),
				'selector' => '
				    {{WRAPPER}} .rhea-sat-container .sat-right-two .rhea-sat-field input,
				    {{WRAPPER}} .rhea-sat-container .rhea-sat-field textarea
				'
			]
		);

		$this->add_control(
			'form_fields_padding',
			[
				'label'      => esc_html__( 'Form Fields Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'
                        {{WRAPPER}} .rhea-sat-container .sat-right-two .rhea-sat-field input,
                        {{WRAPPER}} .rhea-sat-container .rhea-sat-field textarea
                        ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'form_fields_bottom_margin',
			[
				'label'      => esc_html__( 'Form Fields Bottom Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .sat-right-two .rhea-sat-field' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'form_message_bottom_margin',
			[
				'label'      => esc_html__( 'Message Fields Bottom Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-field.user-message' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'schedule_form_field_background',
			[
				'label'     => esc_html__( 'Form Fields Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-form input,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-field.tour-type .tour-field,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-form textarea' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'schedule_form_field_text',
			[
				'label'     => esc_html__( 'Form Fields Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-form input,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-field.tour-type .tour-field,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-form textarea
					{{WRAPPER}} .rhea-sat-container .rhea-sat-form input::placeholder,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-form input::-ms-input-placeholder,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-form textarea::placeholder,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-form textarea::-ms-input-placeholder' => 'color: {{VALUE}};',
				],
				'default'   => '#808080'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'form_nav_buttons_typography',
				'label'    => esc_html__( 'Form Buttons Typography', 'realhomes-elementor-addon' ),
				'selector' => '
				    {{WRAPPER}} .rhea-sat-container .sat-form-nav button,
				    {{WRAPPER}} .rhea-sat-container .rhea-sat-form input[type=submit]
				'
			]
		);

		$this->add_control(
			'form_nav_buttons_padding',
			[
				'label'      => esc_html__( 'Form Buttons Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-sat-container .sat-form-nav button,
					{{WRAPPER}} .rhea-sat-container .rhea-sat-form input[type=submit]
					' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'form_nav_button_background',
			[
				'label'     => esc_html__( 'Form Navigation Button Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .sat-form-nav button' => 'background-color: {{VALUE}};',
				],
				'default'   => '#0054a6'
			]
		);

		$this->add_control(
			'form_nav_button_color',
			[
				'label'     => esc_html__( 'Form Navigation Button Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .sat-form-nav button' => 'color: {{VALUE}};',
				],
				'default'   => '#fff'
			]
		);

		$this->add_control(
			'form_nav_button_hover_background',
			[
				'label'     => esc_html__( 'Form Navigation Button Hover Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .sat-form-nav button:hover' => 'background-color: {{VALUE}};',
				],
				'default'   => '#1cb2ff'
			]
		);

		$this->add_control(
			'form_nav_button_hover_color',
			[
				'label'     => esc_html__( 'Form Navigation Button Hover Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .sat-form-nav button:hover' => 'color: {{VALUE}};',
				],
				'default'   => '#fff'
			]
		);

		$this->add_control(
			'schedule_button_background',
			[
				'label'     => esc_html__( 'Schedule Button Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-form input[type=submit]' => 'background-color: {{VALUE}};',
				],
				'default'   => '#1cb2ff'
			]
		);

		$this->add_control(
			'schedule_button_color',
			[
				'label'     => esc_html__( 'Schedule Button Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-form input[type=submit]' => 'color: {{VALUE}};',
				],
				'default'   => '#fff'
			]
		);

		$this->add_control(
			'schedule_button_hover_background',
			[
				'label'     => esc_html__( 'Schedule Button Hover Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-form input[type=submit]:hover' => 'background-color: {{VALUE}};',
				],
				'default'   => '#0054a6'
			]
		);

		$this->add_control(
			'schedule_button_hover_color',
			[
				'label'     => esc_html__( 'Schedule Button Hover Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-sat-container .rhea-sat-form input[type=submit]:hover' => 'color: {{VALUE}};',
				],
				'default'   => '#fff'
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings         = $this->get_settings_for_display();
		$widget_id        = $this->get_id();
		$tour_times_array = explode( ',', $settings['rhea_sat_time_slots'] );
		$property_id      = 0;
		if ( isset( $settings['schedule_tour_property'] ) ) {
			$property_id = $settings['schedule_tour_property'];
			$property_id = apply_filters( 'wpml_object_id', $property_id, 'property' );
		}
		$left_view_type    = $settings['schedule_left_view_type'];
		$left_area_classes = 'rhea-sat-left';
		if ( $left_view_type === 'agent' || $left_view_type === 'nearby' ) {
			$left_area_classes .= ' background-holder';
		}
		?>
        <div id="rhea-sat-container-<?php echo esc_attr( $widget_id ); ?>" class="rhea-sat-container clearfix">

            <div class="<?php echo esc_attr( $left_area_classes ); ?>">
				<?php
				if ( $left_view_type === 'property' ) {
					if ( intval( $property_id ) ) {

						$property_read_more = $settings['property_read_more_text'] ?? esc_html__( 'Read More..', 'realhomes-elementor-addon' );
						?>
                        <div class="sat-slides">
							<?php
							$thumbnail_size    = 'modern-property-child-slider';
							$properties_images = rwmb_meta( 'REAL_HOMES_property_images', 'type=plupload_image&size=' . $thumbnail_size, $property_id );
							if ( ! empty( $properties_images ) && count( $properties_images ) ) {
								foreach ( $properties_images as $prop_image_id => $prop_image_meta ) {
									echo '<img src="' . esc_url( $prop_image_meta['url'] ) . '" alt="' . esc_attr( $prop_image_meta['title'] ) . '" />';
								}
							} else if ( has_post_thumbnail( $property_id ) ) {
								the_post_thumbnail( '' );
							}
							?>
                        </div>
                        <div class="property-info">
                            <h3>
                                <a href="<?php echo get_permalink( $property_id ); ?>"><?php echo get_the_title( $property_id ); ?></a>
                            </h3>
                            <p class="excerpt">
								<?php echo rhea_get_framework_excerpt_by_id( $property_id, 18 ); ?>
                                <a href="<?php the_permalink( $property_id ); ?>"><?php echo esc_html( $property_read_more ); ?></a>
                            </p>
                        </div>
						<?php
					} // property id exist condition

				} else if ( $left_view_type === 'agent' ) {

					if ( intval( $settings['left_area_agent'] ) ) {
						$agent_id        = $settings['left_area_agent'];
						$agent_id        = apply_filters( 'wpml_object_id', $agent_id, 'agent' );
						$view_agent_text = $settings['view_agent_detail_text'] ?? esc_html__( 'View Agent', 'realhomes-elementor-addon' );
						?>
                        <div class="agent-info">
							<?php
							if ( has_post_thumbnail( $agent_id ) ) {
								?>
                                <div class="rhea-agent-image">
                                    <a title="<?php echo esc_attr( get_the_title( $agent_id ) ); ?>" href="<?php echo get_permalink( $agent_id ); ?>">
										<?php echo get_the_post_thumbnail( $agent_id, 'agent-image' ); ?>
                                    </a>
                                    <div class="social social-networks-brand-color">
										<?php
										$facebook_url = get_post_meta( $agent_id, 'REAL_HOMES_facebook_url', true );
										if ( ! empty( $facebook_url ) ) {
											?>
                                            <a class="facebook" target="_blank" href="<?php echo esc_url( $facebook_url ); ?>">
                                                <i class="fab fa-facebook fa-lg"></i>
                                            </a>
											<?php
										}

										$twitter_url = get_post_meta( $agent_id, 'REAL_HOMES_twitter_url', true );
										if ( ! empty( $twitter_url ) ) {
											?>
                                            <a class="twitter" target="_blank" href="<?php echo esc_url( $twitter_url ); ?>">
                                                <i class="fab fa-twitter fa-lg"></i>
                                            </a>
											<?php
										}

										$linked_in_url = get_post_meta( $agent_id, 'REAL_HOMES_linked_in_url', true );
										if ( ! empty( $linked_in_url ) ) {
											?>
                                            <a class="linkedin" target="_blank" href="<?php echo esc_url( $linked_in_url ); ?>">
                                                <i class="fab fa-linkedin fa-lg"></i>
                                            </a>
											<?php
										}

										$instagram_url = get_post_meta( $agent_id, 'inspiry_instagram_url', true );
										if ( ! empty( $instagram_url ) ) {
											?>
                                            <a class="instagram" target="_blank" href="<?php echo esc_url( $instagram_url ); ?>">
                                                <i class="fab fa-instagram fa-lg"></i>
                                            </a>
											<?php
										}

										$agent_website = get_post_meta( $agent_id, 'REAL_HOMES_website', true );
										if ( ! empty( $agent_website ) ) {
											?>
                                            <a class="website-icon" target="_blank" href="<?php echo esc_url( $agent_website ); ?>">
                                                <i class="fas fa-globe fa-lg"></i>
                                            </a>
											<?php
										}

										$youtube_url = get_post_meta( $agent_id, 'inspiry_youtube_url', true );
										if ( ! empty( $youtube_url ) ) {
											?>
                                            <a class="youtube" target="_blank" href="<?php echo esc_url( $youtube_url ); ?>">
                                                <i class="fab fa-youtube-square fa-lg"></i>
                                            </a>
											<?php
										}

										$pinterest_url = get_post_meta( $agent_id, 'inspiry_pinterest_url', true );
										if ( ! empty( $pinterest_url ) ) {
											?>
                                            <a class="pinterest" target="_blank" href="<?php echo esc_url( $pinterest_url ); ?>">
                                                <i class="fab fa-pinterest fa-lg"></i>
                                            </a>
											<?php
										}
										?>
                                    </div>
                                    <!-- /.social -->
                                </div><!-- /.rh_agent_card__dp -->
								<?php
							}
							?>
                            <h3>
                                <a href="<?php echo get_permalink( $agent_id ); ?>"><?php echo get_the_title( $agent_id ); ?></a>
                            </h3>
                            <p class="excerpt">
								<?php echo rhea_get_framework_excerpt_by_id( $agent_id, 15 ); ?>
                            </p>
                            <a href="<?php the_permalink( $agent_id ); ?>" class="rh-btn rh-btn-primary"><?php echo esc_html( $view_agent_text ); ?></a>
                        </div>
						<?php
					} // property id exist condition
				} else if ( $left_view_type === 'nearby' ) {
					?>
                    <div class="nearby-wrap">
                        <div class="nearby-places">
							<?php
							if ( isset( $settings['left_area_title'] ) ) {
								?>
                                <h3 class="nearby-title"><?php echo esc_html( $settings['left_area_title'] ); ?></h3>
								<?php
							}

							$nearby_places = $settings['nearby_places_repeat_list'];
							if ( is_array( $nearby_places ) && 0 < count( $nearby_places ) ) {
								?>
                                <ul class="places-list">
									<?php
									foreach ( $nearby_places as $place ) {
										?>
                                        <li class="place-item">
                                            <figure>
												<?php
												if ( $place['nearby_place_icon_type'] === 'image' ) {
													if ( ! empty( intval( $place['nearby_place_image']['id'] ) ) ) {
														$thumbnail_url = wp_get_attachment_image_url( $place['nearby_place_image']['id'], 'agent-image' );
														echo '<img src="' . esc_url( $thumbnail_url ) . '" >';
													}
												} else {
													if ( ! empty( $place['nearby_place_icon']['value'] ) ) {
														echo '<i class="' . esc_attr( $place['nearby_place_icon']['value'] ) . '"></i>';
													}
												}
												?>
                                            </figure>
                                            <div class="titles">
												<?php
												if ( ! empty( $place['nearby_place_title'] ) ) {
													?>
                                                    <h4 class="place-title"><?php echo esc_html( $place['nearby_place_title'] ); ?></h4>
													<?php
												}
												if ( ! empty( $place['nearby_place_subtitle'] ) ) {
													?>
                                                    <h5 class="sub-title"><?php echo esc_html( $place['nearby_place_subtitle'] ); ?></h5>
													<?php
												}
												?>
                                            </div>

											<?php
											if ( ! empty( $place['nearby_distance'] ) ) {
												$number_parts = explode( '-', $place['nearby_distance'] );
												$unit         = '';
												if ( isset( $number_parts[1] ) ) {
													$unit = '<span> ' . $number_parts[1] . '</span>';
												}
												?>
                                                <p class="number"><?php echo esc_html( $number_parts[0] ) . wp_kses_post( $unit ); ?></p>
												<?php
											}
											?>
                                        </li>
										<?php
									}
									?>
                                </ul>
								<?php
							}
							?>
                        </div>
                    </div>
					<?php
				} else if ( $left_view_type === 'gallery' ) {
					?>
                    <div class="rhea-gallery-wrap">
						<?php
						$gallery_images = $settings['left_area_gallery'];
						if ( is_array( $gallery_images ) && 0 < count( $gallery_images ) ) {
							$gallery_size = 'modern-property-child-slider';
							?>
                            <div class="gallery-slides">
								<?php
								foreach ( $gallery_images as $image ) {
									$attachment_id = $image['id'];
									$attachment_id = rhea_get_wpml_translated_image_id( $attachment_id );
									$image_url     = wp_get_attachment_image_url( $attachment_id, $gallery_size );
									$image_title   = get_the_title( $image['id'] );
									echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $image_title ) . '" />';
								}
								?>
                            </div>
							<?php
						}

						if ( ! empty( $settings['gallery_description'] ) ) {
							?>
                            <div class="gallery-info">
								<?php
								if ( function_exists( 'inspiry_allowed_html' ) ) {

									// Allowing specific tags in this area
									$allowed_html = array(
										'p'      => array( 'class' => array(), 'id' => array() ),
										'h1'     => array( 'class' => array(), 'id' => array() ),
										'h2'     => array( 'class' => array(), 'id' => array() ),
										'h3'     => array( 'class' => array(), 'id' => array() ),
										'h4'     => array( 'class' => array(), 'id' => array() ),
										'h5'     => array( 'class' => array(), 'id' => array() ),
										'h6'     => array( 'class' => array(), 'id' => array() ),
										'a'      => array(
											'href'   => array(),
											'title'  => array(),
											'alt'    => array(),
											'target' => array()
										),
										'b'      => array(),
										'br'     => array(),
										'div'    => array( 'class' => array(), 'id' => array() ),
										'em'     => array(),
										'strong' => array(),
										'ul'     => array(),
										'ol'     => array(),
										'li'     => array()
									);

									echo wp_kses( $settings['gallery_description'], $allowed_html );
								}
								?>
                            </div>
							<?php
						}
						?>
                    </div>
					<?php
				}
				?>
            </div><!-- end rhea-sat-left -->

            <div class="rhea-sat-right">

                <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="rhea-schedule-a-tour" class="rhea-sat-form">

                    <div class="sat-right-one">
						<?php
						if ( isset( $settings['right_area_calendar_title'] ) ) {
							?>
                            <h3 class="section-title"><?php echo esc_html( $settings['right_area_calendar_title'] ); ?></h3>
							<?php
						}
						?>
                        <div class="schedule-fields">
                            <div class="rhea-sat-field day-tiles">
								<?php
								$days  = 15;
								$today = date( "Y/m/d" );
								for ( $day = 0; $day < $days; $day++ ) {
									$current_day = date( 'd' ) + $day;
									$this_date   = date( 'd', mktime( 0, 0, 0, date( 'm' ), $current_day, date( 'Y' ) ) );
									$this_month  = date( 'M', mktime( 0, 0, 0, date( 'm' ), $current_day, date( 'Y' ) ) );
									$this_day    = date( "D", strtotime( '+' . $day . ' day', strtotime( $today ) ) );
									?>
                                    <div class="slide" data-time-detail="<?php echo esc_attr( $this_day . ' - ' . $this_date . ' ' . $this_month ) ?>">
                                        <div class="week-day">
                                            <span class="day-name"><?php echo esc_html( $this_day ); ?></span>
                                            <span class="day-date">
                                                <?php echo esc_html( $this_date ); ?>
                                                <span class="month"><?php echo esc_html( $this_month ); ?></span>
                                            </span>
                                        </div>
                                    </div>
									<?php
								}
								?>
                            </div>
                            <input type="hidden" name="sat-date" id="sat-date" value="">

							<?php
							if ( is_array( $tour_times_array ) && ! empty( $tour_times_array[0] ) ) {
								?>
                                <div class="rhea-sat-field time-tiles-wrap">
                                    <div class="time-tiles">
										<?php
										foreach ( $tour_times_array as $tour_time ) {
											?>
                                            <div class="slide">
                                                <div class="time-tile"><?php echo esc_html( $tour_time ); ?></div>
                                            </div>
											<?php
										}
										?>
                                    </div>
                                </div><input type="hidden" name="sat-time" id="sat-time" value="">
								<?php
							}
							?>
                        </div>

                        <div class="sat-form-nav">
							<?php
							$next_button = $settings['right_area_next_button_text'] ?? esc_html__( 'Next', 'realhomes-elementor-addon' );
							?>
                            <button class="sat-next rhea-btn-secondary"><?php echo esc_attr( $next_button ); ?></button>
                        </div>
                    </div>

                    <div class="sat-right-two">
						<?php
						if ( isset( $settings['right_area_form_title'] ) ) {
							?>
                            <h3 class="section-title"><?php echo esc_html( $settings['right_area_form_title'] ); ?></h3>
							<?php
						}

						$in_person_title    = $settings['right_area_in_person_title'] ?? esc_html__( 'In Person', 'realhomes-elementor-addon' );
						$video_call         = $settings['right_area_video_call_title'] ?? esc_html__( 'Video Call', 'realhomes-elementor-addon' );
						$name_ph            = $settings['form_name_placeholder'] ?? esc_html__( 'Your Name', 'realhomes-elementor-addon' );
						$name_error         = $settings['form_name_error_message'] ?? esc_html__( 'Provide your name', 'realhomes-elementor-addon' );
						$phone_ph           = $settings['form_phone_placeholder'] ?? esc_html__( 'Your Phone', 'realhomes-elementor-addon' );
						$email_ph           = $settings['form_email_placeholder'] ?? esc_html__( 'Your Email', 'realhomes-elementor-addon' );
						$email_error        = $settings['form_email_error_message'] ?? esc_html__( 'Provide your email ID', 'realhomes-elementor-addon' );
						$message_ph         = $settings['form_message_placeholder'] ?? esc_html__( 'Your Message', 'realhomes-elementor-addon' );
						$back_button        = $settings['right_area_back_button_text'] ?? esc_html__( 'Your Message', 'realhomes-elementor-addon' );
						$schedule_button    = $settings['right_area_submit_button_text'] ?? esc_html__( 'Your Message', 'realhomes-elementor-addon' );
						$target_email       = $settings['schedule_form_target_email'] ?? esc_html__( 'Your Message', 'realhomes-elementor-addon' );
						$target_property_id = $settings['schedule_form_target_property'] ?? false;
						if ( ! $target_property_id ) {
							$all_properties = get_posts( array( 'post_type' => 'property', 'posts_per_page' => -1 ) );
							if ( is_array( $all_properties ) ) {
								$target_property_id = $all_properties[0]->ID;
							}
						}
						?>
                        <div class="rhea-sat-field tour-type">
                            <label for="sat-in-person" class="tour-field in-person">
                                <input type="radio" id="sat-in-person" name="sat-tour-type" value="<?php echo esc_attr( $in_person_title ); ?>" checked>
                                <span class="label-head"><i class="fas fa-walking"></i><?php echo esc_html( $in_person_title ); ?></span>
                            </label>

                            <label for="sat-video-chat" class="tour-field video-chat">
                                <input type="radio" id="sat-video-chat" name="sat-tour-type" value="<?php echo esc_attr( $video_call ); ?>">
                                <span class="label-head"><i class="fas fa-video"></i><?php echo esc_html( $video_call ); ?></span>
                            </label>
                        </div>

                        <div class="user-info">

                            <div class="rhea-sat-field user-name half">
                                <input type="text" name="sat-user-name" class="required" placeholder="<?php echo esc_attr( $name_ph ); ?>" title="<?php echo esc_attr( $name_error ); ?>" required>
                            </div>

                            <div class="rhea-sat-field user-phone half right">
                                <input type="text" name="sat-user-phone" placeholder="<?php echo esc_attr( $phone_ph ); ?>">
                            </div>

                            <div class="rhea-sat-field user-email full">
                                <input type="text" name="sat-user-email" class="required" placeholder="<?php echo esc_attr( $email_ph ); ?>" title="<?php echo esc_attr( $email_error ); ?>" required>
                            </div>

                            <div class="rhea-sat-field user-message full">
                                <textarea name="sat-user-message" placeholder="<?php echo esc_attr( $message_ph ); ?>"></textarea>
                            </div>

                        </div><!-- End .user-info -->

						<?php
						if ( class_exists( 'Easy_Real_Estate' ) ) {
							/* Display reCAPTCHA if enabled and configured from customizer settings */
							if ( ere_is_reCAPTCHA_configured() ) {
								$recaptcha_type = get_option( 'inspiry_reCAPTCHA_type', 'v3' );
								if ( $recaptcha_type === 'v3' ) {
									?>
                                    <div class="inspiry-recaptcha-wrapper clearfix g-recaptcha-type-<?php echo esc_attr( $recaptcha_type ); ?>">
                                        <div class="inspiry-google-recaptcha"></div>
                                    </div>
									<?php
								}
							}
						}
						?>

                        <div class="submit-wrap sat-form-nav">
                            <input type="hidden" name="action" value="rhea_schedule_a_tour" />
                            <input type="hidden" name="property-id" value="<?php echo esc_attr( $target_property_id ); ?>" />
                            <input type="hidden" name="sat-target-email" value="<?php echo esc_attr( $target_property_id ); ?>" />
                            <input type="hidden" name="rhea-sat-nonce" value="<?php echo esc_attr( wp_create_nonce( 'rhea_schedule_a_tour_nonce' ) ); ?>" />
                            <input type="hidden" name="send-copy-to-admin" value="<?php echo esc_attr( $settings['schedule_send_copy_to_admin'] ); ?>" />
                            <button class="rhea-btn-secondary sat-back"><?php echo esc_attr( $back_button ); ?></button>
                            <span id="sat-loader"><?php rhea_safe_include_svg( 'icons/loading-bars.svg' ); ?></span>
                            <input type="submit" id="schedule-submit" class="submit-button rh-btn rh-btn-primary rh_widget_form__submit" value="<?php echo esc_attr( $schedule_button ) ?>" />
                        </div>
                        <div id="message-container"></div>

                    </div><!-- .sat-right-two -->

                </form>

            </div><!-- end .rhea-sat-right -->
        </div>
		<?php
	}
}