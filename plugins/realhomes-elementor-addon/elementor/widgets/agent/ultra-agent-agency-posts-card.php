<?php
/**
 * Ultra Agent/Agency Posts Card Widget
 *
 * @since 2.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Agent_Agency_Card_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-agent-card-widget';
	}

	public function get_title() {
		return esc_html__( 'Ultra:Agent/Agency Posts Card', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'ultra-real-homes' ];
	}

	protected function register_controls() {


		$this->start_controls_section(
			'basic_settings',
			[
				'label' => esc_html__( 'Basic', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'all_agent_agency_posts',
			[
				'label'        => esc_html__( 'Display All Posts For Agent/Agency', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);


		$this->add_control(
			'select-post-type',
			[
				'label'       => esc_html__( 'Select Post Type', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'default'     => 'agent',
				'label_block' => true,
				'options'     => array(
					'agent'  => esc_html__( 'Agent', 'realhomes-elementor-addon' ),
					'agency' => esc_html__( 'Agency', 'realhomes-elementor-addon' ),
				),
				'condition'   => [
					'all_agent_agency_posts' => 'yes',
				],
			]
		);

		$this->add_control(
			'agent_id',
			[
				'label'     => esc_html__( 'Agent/Agency ID To Show Single Agent Details', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'condition' => [
					'all_agent_agency_posts' => '',
				],
			]
		);

		$this->add_control(
			'agency_prefix',
			[
				'label'   => esc_html__( 'Related Agency Prefix', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Company Agent at The', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'show_property_counter',
			[
				'label'        => esc_html__( 'Show Property Counter', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_company_name',
			[
				'label'        => esc_html__( 'Show Company Name', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'show_description',
			[
				'label'        => esc_html__( 'Show Description', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'description_heading',
			[
				'label'     => esc_html__( 'Description Heading', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'About', 'realhomes-elementor-addon' ),
				'condition' => [
					'show_description' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_progress_stats',
			[
				'label'        => esc_html__( 'Show Progress & Stats ', 'realhomes-elementor-addon' ),
				'description'  => esc_html__( 'To be displayed only on Agent/Agency single page', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition' => [
					'all_agent_agency_posts' => '',
				],
			]
		);
		$this->add_control(
			'progress_stats_heading',
			[
				'label'     => esc_html__( 'Progress & Stats Heading', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Progress & Stats', 'realhomes-elementor-addon' ),
				'condition' => [
					'show_progress_stats' => 'yes',
				],
			]
		);
		$this->add_control(
			'property_locations_label',
			[
				'label'     => esc_html__( 'Property Locations Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Property Location', 'realhomes-elementor-addon' ),
				'condition' => [
					'show_progress_stats' => 'yes',
				],
			]
		);
		$this->add_control(
			'property_types_label',
			[
				'label'     => esc_html__( 'Property Types Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Property Types', 'realhomes-elementor-addon' ),
				'condition' => [
					'show_progress_stats' => 'yes',
				],
			]
		);
		$this->add_control(
			'property_status_label',
			[
				'label'     => esc_html__( 'Property Status Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Property Status', 'realhomes-elementor-addon' ),
				'condition' => [
					'show_progress_stats' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'sizes_spaces',
			[
				'label' => esc_html__( 'Sizes & Spaces', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'card_padding',
			[
				'label'      => esc_html__( 'Wrapper Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-single-agent-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card-border-radius',
			[
				'label'      => esc_html__( 'Wrapper Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-single-agent-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image-card-border-radius',
			[
				'label'      => esc_html__( 'Thumb Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .agent-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'colors',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => esc_html__( 'Agent Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agent-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'agency_description_prefix',
			[
				'label'     => esc_html__( 'Related Agency Prefix', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agent-description span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'select-post-type' => 'agent',
				],
			]
		);
		$this->add_control(
			'agency_description_name',
			[
				'label'     => esc_html__( 'Agency Name', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agent-description a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'select-post-type' => 'agent',
				],
			]
		);
		$this->add_control(
			'agency_listed_properties',
			[
				'label'     => esc_html__( 'Listed Properties', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agent-listing-count' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent_social_colors',
			[
				'label'     => esc_html__( 'Agent/Agency Social Links', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-agent-card .agent-social-links'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .single-agency-card .agency-social-links' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent_social_colors_hover',
			[
				'label'     => esc_html__( 'Agent/Agency Social Links Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-agent-card .agent-social-links:hover'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .single-agency-card .agency-social-links:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent_meta_icon',
			[
				'label'     => esc_html__( 'Agent/Agency Meta Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent_meta_label',
			[
				'label'     => esc_html__( 'Agent/Agency Meta Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agent-contact-item-label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent_meta_value',
			[
				'label'     => esc_html__( 'Agent/Agency Meta Value', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agent-contact-item-inner a'    => 'color: {{VALUE}}',
					'{{WRAPPER}} .agent-contact-item-inner span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent_meta_value_hover',
			[
				'label'     => esc_html__( 'Agent/Agency Meta Value Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agent-contact-item-inner a:hover'  => 'color: {{VALUE}}',
					'{{WRAPPER}} .agency-contact-item-inner a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent_desc_heading',
			[
				'label'     => esc_html__( 'Agent/Agency Description Heading', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agent-content-heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent_description',
			[
				'label'     => esc_html__( 'Agent/Agency Description', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agent-content p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'area_box_shadow',
				'label'    => esc_html__( 'Area Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-single-agent-card',
			]
		);

		$this->add_control(
			'progress_stats_heading_color',
			[
				'label'     => esc_html__( 'Progress & Stats Heading', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stats-charts-wrap > h3' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_progress_stats' => 'yes',
				],
			]
		);
		$this->add_control(
			'progress_stats_labels_color',
			[
				'label'     => esc_html__( 'Progress & Stats Labels', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stats-charts-wrap .stats-wrapper .tax-stats > h3' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_progress_stats' => 'yes',
				],
			]
		);
		$this->add_control(
			'progress_stats_details_color',
			[
				'label'     => esc_html__( 'Progress & Stats Details', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stats-charts-wrap .stats-wrapper .tax-stats ul li' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_progress_stats' => 'yes',
				],
			]
		);
		$this->add_control(
			'progress_stats_details_strong_color',
			[
				'label'     => esc_html__( 'Progress & Stats Details Strong', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stats-charts-wrap .stats-wrapper .tax-stats ul li strong' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_progress_stats' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'typography_section',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'label'    => esc_html__( 'Agent Label', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .agent-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agency_prefix_typography',
				'label'    => esc_html__( 'Agency Prefix', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .agent-description span',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agency_name_typography',
				'label'    => esc_html__( 'Agency Name', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .agent-description a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agency_listed_properties_typography',
				'label'    => esc_html__( 'Agent/Agency Listed Properties', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .agent-listing-count',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_meta_label_typography',
				'label'    => esc_html__( 'Agent/Agency Meta Label', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .agent-contact-item-label',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_meta_value_typography',
				'label'    => esc_html__( 'Agent/Agency Meta Value', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .agent-contact-item-inner a, {{WRAPPER}} .agent-contact-item-inner span',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_desc_heading_typography',
				'label'    => esc_html__( 'Agent/Agency Description Heading', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .agent-content-heading',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agent_description_typography',
				'label'    => esc_html__( 'Agent/Agency Description', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .agent-content p',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'progress_stats_typography',
				'label'     => esc_html__( 'Progress & Stats', 'realhomes-elementor-addon' ),
				'selector'  => '{{WRAPPER}} .stats-charts-wrap > h3',
				'condition' => [
					'show_progress_stats' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'progress_stats_labels_typography',
				'label'     => esc_html__( 'Progress & Stats Labels', 'realhomes-elementor-addon' ),
				'selector'  => '{{WRAPPER}} .stats-charts-wrap .stats-wrapper .tax-stats > h3',
				'condition' => [
					'show_progress_stats' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'progress_stats_details_typography',
				'label'     => esc_html__( 'Progress & Stats Details', 'realhomes-elementor-addon' ),
				'selector'  => '{{WRAPPER}} .stats-charts-wrap .stats-wrapper .tax-stats ul li',
				'condition' => [
					'show_progress_stats' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'progress_stats_details_strong_typography',
				'label'     => esc_html__( 'Progress & Stats Details Strong', 'realhomes-elementor-addon' ),
				'selector'  => '{{WRAPPER}} .stats-charts-wrap .stats-wrapper .tax-stats ul li strong',
				'condition' => [
					'show_progress_stats' => 'yes',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		global $settings;
		$settings = $this->get_settings_for_display();


		if ( 'yes' === $settings['all_agent_agency_posts'] ) {

			rhea_get_template_part( 'elementor/widgets/agent/partials/agent-agency-loop' );
		} else {
			rhea_get_template_part( 'elementor/widgets/agent/partials/agent-agency-card' );
		}


		?>

		<?php
	}
}
