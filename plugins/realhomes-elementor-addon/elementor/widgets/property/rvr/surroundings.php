<?php
/**
 * Property RVR Amenities
 *
 * @since 2.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Surroundings extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-pdp-surroundings';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Surroundings', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-google-maps';
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
				'default' => esc_html__( 'Surroundings', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'section_title_typography',
				'label'    => esc_html__( 'Section Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_rvr_property_surroundings .rh_property__heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'    => esc_html__( 'Item Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_rvr_property_surroundings h5',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'item_value_typography',
				'label'    => esc_html__( 'Item Value Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_rvr_property_surroundings span',
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
					'{{WRAPPER}} .rh_rvr_property_surroundings .rh_done_icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_rvr_property_surroundings .rh_property__heading' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_icon_color',
			[
				'label'     => esc_html__( 'Item Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_rvr_property_surroundings .rh_done_icon' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Item Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_rvr_property_surroundings ul li h5' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_value_color',
			[
				'label'     => esc_html__( 'Item Value Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_rvr_property_surroundings .rh_POI_distance' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .rh_rvr_property_surroundings' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_rvr_property_surroundings' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_rvr_property_surroundings ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'list-item-margin',
			[
				'label'      => esc_html__( 'List Item Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_rvr_property_surroundings ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$section_heading       = $settings['section_title'] ?? esc_html__( 'Surroundings', 'realhomes-elementor-addon' );
		$location_surroundings = get_post_meta( $post_id, 'rvr_surroundings', true );

		if ( ! empty( $location_surroundings ) ) {
			?>
            <div class="rh_property__features_wrap rh_rvr_property_surroundings">
                <h4 class="rh_property__heading"><?php echo esc_html( $section_heading ); ?></h4>
                <ul class="rh_property__features arrow-bullet-list no-link-list">
					<?php
					foreach ( $location_surroundings as $surrounding ) {
						?>
                        <li class="rh_property__feature">
							<?php
							if ( isset( $surrounding['rvr_surrounding_point'] ) && ! empty( $surrounding['rvr_surrounding_point'] ) ) {
								?>
                                <span class="rh_done_icon"><i class="rvr_fa_icon fas fa-map-marker-alt"></i></span>
								<?php
								echo '<h5>' . esc_html( $surrounding['rvr_surrounding_point'] ) . '</h5> ';
							}

							if ( isset( $surrounding['rvr_surrounding_point_distance'] ) && ! empty( $surrounding['rvr_surrounding_point_distance'] ) ) {
								?>
                                <span class="rh_POI_distance">
                                    <?php echo esc_html( $surrounding['rvr_surrounding_point_distance'] ); ?>
                                </span>
								<?php
							}
							?>
                        </li>
						<?php
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