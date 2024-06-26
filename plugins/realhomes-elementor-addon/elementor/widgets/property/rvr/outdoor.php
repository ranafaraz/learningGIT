<?php
/**
 * Property RVR Outdoor Features
 *
 * @since 2.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Outdoor_Features extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-pdp-outdoor-features';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Outdoor Features', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-image-bold';
	}

	public function get_categories() {
		return [ 'ultra-realhomes-single-property' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'section_title',
			[
				'label'   => esc_html__( 'Section Title', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Outdoor Features', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'section_title_typography',
				'label'    => esc_html__( 'Section Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_rvr_outdoor_features_wrapper .rh_property__heading'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'    => esc_html__( 'Item Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_rvr_outdoor_features_wrapper h5',
			]
		);

		$this->add_control(
			'item_icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20
				],
				'selectors'  => [
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper .rh_done_icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'styles_section',
			[
				'label' => esc_html__( 'Basic Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_title_color',
			[
				'label'     => esc_html__( 'Section Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper .rh_property__heading' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_icon_color',
			[
				'label'     => esc_html__( 'Item Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper .rh_done_icon' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Item Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper ul li h5' => 'color: {{VALUE}}',
				]
			]
		);


		$this->add_responsive_control(
			'section-padding',
			[
				'label'      => esc_html__( 'Section Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'section-margins',
			[
				'label'      => esc_html__( 'Section Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'list-item-padding',
			[
				'label'      => esc_html__( 'List Item Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'list-item-margin',
			[
				'label'      => esc_html__( 'List Item Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_rvr_outdoor_features_wrapper ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$post_id  = get_the_ID();

		// Sample Post id for Elementor editor only
		if ( rhea_is_preview_mode() ) {
			$post_id = rhea_get_sample_property_id();
		}

		$section_heading = $settings['section_title'] ?? esc_html__( 'Outdoor Features', 'realhomes-elementor-addon' );

		$rvr_outdoor_features = get_post_meta( $post_id, 'rvr_outdoor_features', true );

		if ( ! empty( $rvr_outdoor_features ) && ( 0 < count( $rvr_outdoor_features ) ) ) {
			?>
            <div class="rh_property__features_wrap rh_rvr_outdoor_features_wrapper">
                <h4 class="rh_property__heading"><?php echo esc_html( $section_heading ); ?></h4>
                <ul class="rh_property__features arrow-bullet-list no-link-list">
					<?php
					foreach ( $rvr_outdoor_features as $rvr_outdoor_feature ) {
						echo '<li class="rh_property__feature">';
						echo '<span class="rh_done_icon">';
						if ( INSPIRY_DESIGN_VARIATION === 'ultra' ) {
							inspiry_safe_include_svg( '/icons/sun.svg' );
						} else {
							inspiry_safe_include_svg( '/images/icons/sun.svg' );
						}
						echo '</span>';
						echo '<h5>' . esc_html( $rvr_outdoor_feature ) . '</h5>';
						echo '</li>';
					}
					?>
                </ul>
            </div>
			<?php
		} else {
			rhea_print_no_result_for_editor();
		}

	}
}