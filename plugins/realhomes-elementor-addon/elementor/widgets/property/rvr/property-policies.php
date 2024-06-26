<?php
/**
 * Property RVR Property Policies
 *
 * @since 2.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Property_Policies extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-pdp-property-policies';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Policies', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-parallax';
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
				'default' => esc_html__( 'Property Rules', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'section_title_typography',
				'label'    => esc_html__( 'Section Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_rvr_property_policies_wrapper .rh_property__heading'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'    => esc_html__( 'Item Text Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_rvr_property_policies_wrapper .property-policy .rh_property__feature',
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
					'{{WRAPPER}} .rh_rvr_property_policies_wrapper .property-policy .rh_property__feature .rh_done_icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rh_rvr_property_policies_wrapper .property-policy .rh_property__feature .rh_done_icon svg' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .rh_property__features li'   => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_rvr_property_policies_wrapper .rh_property__heading' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_icon_color',
			[
				'label'     => esc_html__( 'Item Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_rvr_property_policies_wrapper .property-policy .rh_property__feature .rh_done_icon i' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Item Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_rvr_property_policies_wrapper .property-policy .rh_property__feature' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .rh_rvr_property_policies_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_rvr_property_policies_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_rvr_property_policies_wrapper .property-policy .rh_property__feature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_rvr_property_policies_wrapper .property-policy .rh_property__feature' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$property_policies = get_post_meta( $post_id, 'rvr_policies', true );

		if ( ! empty( $property_policies ) ) {
			?>
            <div class="rh_property__features_wrap rh_rvr_alternate_wrapper rh_rvr_property_policies_wrapper">
                <h4 class="rh_property__heading"><?php echo $settings['section_title'] ?? esc_html__( 'Outdoor Features', 'realhomes-elementor-addon' ); ?></h4>
                <ul class="rh_property__features arrow-bullet-list no-link-list property-policy">
					<?php
					foreach ( $property_policies as $property_policy ) {
						?>
                        <li class="rh_property__feature">
							<?php
							if ( isset( $property_policy['rvr_policy_icon'] ) && ! empty( $property_policy['rvr_policy_icon'] ) ) {
								?>
                                <span class="rh_done_icon rvr_fa_icon">
                                    <i class="<?php echo esc_attr( $property_policy['rvr_policy_icon'] ); ?>">
                                        <span class="rvr-slash-line"></span>
                                    </i>
                                </span>
								<?php
							} else {
								?>
                                <span class="rh_done_icon">
                                    <?php inspiry_safe_include_svg( '/icons/verified-check.svg', '/common/images' ); ?>
                                </span>
								<?php
							}
							echo esc_html( $property_policy['rvr_policy_detail'] );
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