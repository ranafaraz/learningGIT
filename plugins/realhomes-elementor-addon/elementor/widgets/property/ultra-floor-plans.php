<?php
/**
 * Floor Plans Elementor widget for single property
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Floor_Plans extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-property-floor-plans';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Floor Plans', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-tabs';
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
				'default' => esc_html__( 'Floor Plans', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'section_title_color',
			[
				'label'     => esc_html__( 'Section Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'section_title_typography',
				'label'    => esc_html__( 'Section Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__heading',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'features_colors_section',
			[
				'label' => esc_html__( 'Basic Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'wrapper-padding',
			[
				'label'      => esc_html__( 'Wrapper Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .floor-plans-accordions' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wrapper-border-radius',
			[
				'label'      => esc_html__( 'Wrapper Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .floor-plans-accordions' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tabs-wrapper-padding',
			[
				'label'      => esc_html__( 'Tabs Wrapper Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-floor-tabs-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tabs-padding',
			[
				'label'      => esc_html__( 'Tabs Inner Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-floor-tabs-wrapper .rh-floor-plan-tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tabs-border-radius',
			[
				'label'      => esc_html__( 'Tabs Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-floor-tabs-wrapper .rh-floor-plan-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tabs-margin',
			[
				'label'      => esc_html__( 'Tabs Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-floor-tabs-wrapper .rh-floor-plan-tab' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'detail-wrapper-padding',
			[
				'label'      => esc_html__( 'Content Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-floor-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'detail-wrapper-border-radius',
			[
				'label'      => esc_html__( 'Content Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-floor-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .floor-plan-title-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'desc-margin-bottom',
			[
				'label'     => esc_html__( 'Description Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .floor-plan-desc p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'meta-margin-bottom',
			[
				'label'     => esc_html__( 'Meta Icons Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .floor-plan-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content-margin-bottom',
			[
				'label'     => esc_html__( 'Section Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_property__floor_plans' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'floor-typography',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'tabs_label_typography',
				'label'    => esc_html__( 'Tabs Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-floor-tabs-wrapper .rh-floor-plan-tab',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'label'    => esc_html__( 'Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-floor-content-wrapper h4',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'price_typography',
				'label'    => esc_html__( 'Price', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .floor-plan-price-wrapper .floor-price',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'price_postfix_typography',
				'label'    => esc_html__( 'Price PostFix', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .floor-plan-price-wrapper .floor-price .floor-price-post-fix',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'    => esc_html__( 'Description', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-floor-content-wrapper .floor-plan-desc p',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_label_typography',
				'label'    => esc_html__( 'Meta Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .floor-plan-meta .rh-floor-meta-label',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_value_typography',
				'label'    => esc_html__( 'Meta Value', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .floor-plan-meta .rh-floor-meta-value',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'floor-colors',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'wrapper-bg-color',
			[
				'label'     => esc_html__( 'Wrapper Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .floor-plans-accordions' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'tab-text-color',
			[
				'label'     => esc_html__( 'Tabs Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-floor-tabs-wrapper .rh-floor-plan-tab' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'current-tab-bg-color',
			[
				'label'     => esc_html__( 'Current/Hover Tab Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-floor-tabs-wrapper .rh-floor-plan-tab.rh-current-tab' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-floor-tabs-wrapper .rh-floor-plan-tab:hover'          => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'current-tab-text-color',
			[
				'label'     => esc_html__( 'Current/Hover Tab Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-floor-tabs-wrapper .rh-floor-plan-tab.rh-current-tab' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rh-floor-tabs-wrapper .rh-floor-plan-tab:hover'          => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'details-bg-color',
			[
				'label'     => esc_html__( 'Content Area Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-floor-content-wrapper' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'label-color',
			[
				'label'     => esc_html__( 'Floor Plan Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-floor-content-wrapper h4' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'price-color',
			[
				'label'     => esc_html__( 'Floor Plan Price', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .floor-plan-price-wrapper .floor-price' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'price-postfix-color',
			[
				'label'     => esc_html__( 'Floor Plan Price PostFix', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .floor-plan-price-wrapper .floor-price-post-fix' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'description-color',
			[
				'label'     => esc_html__( 'Floor Plan Description', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-floor-content-wrapper .floor-plan-desc p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'meta-label-color',
			[
				'label'     => esc_html__( 'Floor Plan Meta Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .floor-plan-meta .rh-floor-meta-label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'meta-icon-light-color',
			[
				'label'     => esc_html__( 'Meta Icon Light Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-light' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'meta-icon-dark-color',
			[
				'label'     => esc_html__( 'Meta Icon Dark Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'meta-value-color',
			[
				'label'     => esc_html__( 'Meta Value', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .floor-plan-meta .rh-floor-meta-value' => 'color: {{VALUE}}',
				],
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
		$property_floor_plans = get_post_meta( $post_id, 'inspiry_floor_plans', true );

		if ( ! empty( $property_floor_plans ) && is_array( $property_floor_plans ) && ! empty( $property_floor_plans[0]['inspiry_floor_plan_name'] ) ) {
			?>
            <div class="rh_property__floor_plans floor-plans margin-bottom-40px <?php realhomes_printable_section( 'floor-plans' ); ?>">
                <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4>
                <div class="floor-plans-accordions">
					<?php
					/**
					 * Floor plans contents
					 */
					$tabs   = '';
					$detail = '';

					$meta_to_display = array(
						[
							'id'       => 'inspiry_floor_plan_bedrooms',
							'label'    => esc_html__( 'Bedrooms', 'realhomes-elementor-addon' ),
							'icon'     => 'ultra-bedrooms.svg',
							'post-fix' => ''
						],

						[
							'id'       => 'inspiry_floor_plan_bathrooms',
							'label'    => esc_html__( 'Bathrooms', 'realhomes-elementor-addon' ),
							'icon'     => 'ultra-bathrooms.svg',
							'post-fix' => ''
						],

						[
							'id'       => 'inspiry_floor_plan_size',
							'label'    => esc_html__( 'Size', 'realhomes-elementor-addon' ),
							'icon'     => 'ultra-area.svg',
							'post-fix' => 'inspiry_floor_plan_size_postfix'
						],

					);

					foreach ( $property_floor_plans as $i => $floor ) {

						if ( 1 === $i + 1 ) {
							$current_tab = 'rh-current-tab';
							$active_tab  = 'rh-active-tab';
						} else {
							$current_tab = '';
							$active_tab  = '';
						}

						if ( isset( $floor['inspiry_floor_plan_name'] ) && ! empty( $floor['inspiry_floor_plan_name'] ) ) {
							$tabs .= '<a class="rh-floor-plan-tab ' . $current_tab . '" data-id="tab-' . ( $i + 1 ) . '" href="#">' . esc_html( $floor['inspiry_floor_plan_name'] ) . '</a>';

							$detail .= '<div class="rh-floor-plan ' . $active_tab . '" data-id="tab-' . ( $i + 1 ) . '">';
							$detail .= '<div class="floor-plan-title-price">';
							$detail .= '<h4>' . esc_html( $floor['inspiry_floor_plan_name'] ) . '</h4>';
							if ( ! empty( $floor['inspiry_floor_plan_price'] ) ) {
								$detail .= '<div class="floor-plan-price-wrapper">';
								$detail .= ' <span class="floor-price"> ';
								$detail .= ere_get_property_floor_price( $floor );
								$detail .= ' </span> ';
								$detail .= '</div>';
							}
							$detail .= '</div>';
							if ( ! empty( $floor['inspiry_floor_plan_descr'] ) ) {
								$detail .= '<div class="floor-plan-desc">';
								$detail .= '<p>' . esc_html( $floor['inspiry_floor_plan_descr'] ) . '</p>';
								$detail .= '</div>';
							}


							$detail .= ' <div class="floor-plan-meta">';
							foreach ( $meta_to_display as $key => $value ) {


								if ( ! empty( $floor[ $value['id'] ] ) ) {
									$detail .= '<div class="rh-floor-meta">';

									$detail .= '<span class="rh-floor-meta-label">' . esc_html( $value['label'] ) . '</span>';
									$detail .= '<div class="rh-floor-meta-icon">';
									$detail .= file_get_contents( get_theme_file_path( '/assets/ultra/icons/' . $value['icon'] ) );

									if ( isset( $value['post-fix'] ) && ! empty( $value['post-fix'] ) ) {
										$post_fix = $floor[ $value['post-fix'] ];
									} else {
										$post_fix = '';
									}
									$detail .= '<span class="rh-floor-meta-value">' . esc_html( $floor[ $value['id'] ] ) . ' ' . esc_html( $post_fix ) . '</span>';
									$detail .= '</div>';
									$detail .= '</div>';
								}
							}
							$detail .= '</div>';

							if ( ! empty( $floor['inspiry_floor_plan_image'] ) ) {
								$detail .= '<div class="floor-plan-map">';
								$detail .= '<a href="' . esc_url( $floor['inspiry_floor_plan_image'] ) . '" data-fancybox="floor-plans">';
								$detail .= '<img src="' . esc_url( $floor['inspiry_floor_plan_image'] ) . '" alt="' . esc_attr( $floor['inspiry_floor_plan_name'] ) . '">';
								$detail .= '</a>';
								$detail .= '</div>';
							}

							$detail .= '</div>';
						}

					}
					?>
                    <div class="rh-floor-tabs-wrapper">
						<?php
						echo $tabs;
						?>
                    </div>
                    <div class="rh-floor-content-wrapper">
						<?php
						echo $detail;
						?>
                    </div>
					<?php
					?>
                </div>
            </div>
			<?php
		} else {
			rhea_print_no_result_for_editor();
		}
	}
}