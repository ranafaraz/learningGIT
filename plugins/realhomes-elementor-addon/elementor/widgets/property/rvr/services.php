<?php
/**
 * Property RVR Amenities
 *
 * @since 2.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Services extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-pdp-services';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Services', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return ' eicon-ai';
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
				'default' => esc_html__( 'Services', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'included_title',
			[
				'label'   => esc_html__( 'Included Title', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Included', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'not_included_title',
			[
				'label'   => esc_html__( 'Not Included Title', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Not Included', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'section_title_typography',
				'label'    => esc_html__( 'Section Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_rvr_optional_services_wrapper .rh_property__heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_heading_typography',
				'label'    => esc_html__( 'Sub Heading Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_rvr_optional_services_wrapper .rh_rvr_optional_services h5',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'item_typography',
				'label'    => esc_html__( 'Item Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_rvr_optional_services_wrapper li',
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
					'{{WRAPPER}} .rh_rvr_optional_services_wrapper .rh_done_icon svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rh_rvr_optional_services_wrapper .rh_done_icon i'   => 'font-size: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'list_size',
			[
				'label'      => esc_html__( 'List Size', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 1000,
						'step' => 1
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__features li' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_rvr_optional_services_wrapper .rh_property__heading' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'sub_heading_color',
			[
				'label'     => esc_html__( 'Sub Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_rvr_optional_services .rvr_optional_services_status h5' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_icon_color',
			[
				'label'     => esc_html__( 'Item Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_optional_services_status .rh_done_icon'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .rvr_optional_services_status .rh_done_icon svg' => 'fill: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Item Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_rvr_optional_services .rvr_optional_services_status li.rh_property__feature' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'sub_heading_not_included_color',
			[
				'label'     => esc_html__( 'Sub Title Not-Included Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_rvr_optional_services .rvr_optional_services_status h5.rhea-title-not-included' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_not_included_icon_color',
			[
				'label'     => esc_html__( 'Item Not-Included Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_optional_services_status .rhea-optional-not-included .rh_done_icon'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .rvr_optional_services_status .rhea-optional-not-included .rh_done_icon svg' => 'fill: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_not_included_title_color',
			[
				'label'     => esc_html__( 'Item Not-Included Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_rvr_optional_services .rvr_optional_services_status .rhea-optional-not-included li.rh_property__feature' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .rh_rvr_optional_services_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_rvr_optional_services_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'heading-margins',
			[
				'label'      => esc_html__( 'Heading Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_rvr_optional_services_wrapper .rh_property__heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'sub-title-margins',
			[
				'label'      => esc_html__( 'Sub Heading Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_rvr_optional_services .rvr_optional_services_status h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'list-item-padding',
			[
				'label'      => esc_html__( 'List Item Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_rvr_optional_services .rvr_optional_services_status li.rh_property__feature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_rvr_optional_services .rvr_optional_services_status li.rh_property__feature' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$section_heading      = $settings['section_title'] ?? esc_html__( 'Services', 'realhomes-elementor-addon' );
		$included_heading     = $settings['included_title'] ?? esc_html__( 'Included', 'realhomes-elementor-addon' );
		$not_included_heading = $settings['not_included_title'] ?? esc_html__( 'Not Included', 'realhomes-elementor-addon' );
		$rvr_included         = get_post_meta( $post_id, 'rvr_included', true );
		$rvr_not_included     = get_post_meta( $post_id, 'rvr_not_included', true );

		if ( ! empty( $rvr_included ) || ! empty( $rvr_not_included ) ) {
			?>
            <div class="rh_property__features_wrap rh_rvr_optional_services_wrapper">
                <h4 class="rh_property__heading"><?php echo esc_html( $section_heading ); ?></h4>
                <div class="rh_rvr_optional_services">
					<?php
					if ( ! empty( $rvr_included ) ) {
						?>
                        <div class="rvr_optional_services_status">
                            <h5><?php echo esc_html( $included_heading ); ?></h5>
                            <ul class="rh_property__features arrow-bullet-list no-link-list rh_rvr_optional_included">
								<?php
								foreach ( $rvr_included as $rvr_include ) {
									echo '<li class="rh_property__feature">';
									echo '<span class="rh_done_icon">';
									inspiry_safe_include_svg( '/icons/right-right.svg' );
									echo '</span>';
									echo esc_html( $rvr_include );
									echo '</li>';
								}
								?>
                            </ul>
                        </div>
						<?php
					}

					if ( ! empty( $rvr_not_included ) ) {
						?>
                        <div class="rvr_optional_services_status">
                            <h5 class="rhea-title-not-included"><?php echo esc_html( $not_included_heading ); ?></h5>
                            <ul class="rh_property__features arrow-bullet-list no-link-list icon-cross rhea-optional-not-included">
								<?php
								foreach ( $rvr_not_included as $rvr_not_include ) {
									echo '<li class="rh_property__feature">';
									echo '<span class="rh_done_icon rvr_not_available"> <i class="fas fa-times"></i>';
									echo '</span>';
									echo esc_html( $rvr_not_include );
									echo '</li>';
								}
								?>
                            </ul>
                        </div>
						<?php
					}
					?>
                </div>

            </div>
			<?php
		} else {
			rhea_print_no_result_for_editor();
		}

	}
}