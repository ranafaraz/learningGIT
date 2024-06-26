<?php
/**
 * Energy Performance Elementor widget for single property
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Energy_Performance extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-property-energy-performance';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Energy Performance', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-flash';
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
				'default' => esc_html__( 'Energy Performance', 'realhomes-elementor-addon' ),
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
			'detail-border-radius',
			[
				'label'      => esc_html__( 'Detail Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .energy-performance .epc-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'list-padding',
			[
				'label'      => esc_html__( 'List Item Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .energy-performance .epc-details li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'energy-types-Padding',
			[
				'label'      => esc_html__( 'Energy Class Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .energy-performance .energy-class li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rh_property__energy_performance_wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'energy-typography',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'energy_label_typography',
				'label'    => esc_html__( 'Class List Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .energy-performance .epc-details li strong',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'energy_value_typography',
				'label'    => esc_html__( 'Class List Value', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .energy-performance .epc-details li span',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'energy_class_typography',
				'label'    => esc_html__( 'Energy Class', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .energy-performance .energy-class li',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'energy-colors',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'list-item-bg-color',
			[
				'label'     => esc_html__( 'List Item Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .energy-performance .epc-details li' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'alternate-list-item-bg-color',
			[
				'label'     => esc_html__( 'Alternative List Item Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .energy-performance .epc-details li:nth-of-type(even)' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list-item-label-color',
			[
				'label'     => esc_html__( 'Class Item Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .energy-performance .epc-details li strong' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list-item-value-color',
			[
				'label'     => esc_html__( 'Class Item Value', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .energy-performance .epc-details li span' => 'color: {{VALUE}}',
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

		$energy_class = get_post_meta( $post_id, 'REAL_HOMES_energy_class', true );

		if ( ! empty( $energy_class ) && 'none' != $energy_class ) {
			$energy_performance = get_post_meta( $post_id, 'REAL_HOMES_energy_performance', true );
			$epc_current        = get_post_meta( $post_id, 'REAL_HOMES_epc_current_rating', true );
			$energy_potential   = get_post_meta( $post_id, 'REAL_HOMES_epc_potential_rating', true );
			?>
            <div class="rh_property__energy_performance_wrap margin-bottom-40px <?php realhomes_printable_section( 'energy-performance' ); ?>">
                <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4>
                <div class="energy-performance">
					<?php
					$current_class_color = '#8ed2cc';
					$energy_classes      = get_option( 'inspiry_property_energy_classes' );

					if ( empty( $energy_classes ) ) {
						$energy_classes = ere_epc_default_fields();
					}

					foreach ( $energy_classes as $class ) {
						if ( $class['name'] === $energy_class ) {
							$current_class_color = $class['color'];
						}
					}
					?>
                    <ul style="border-color: <?php echo esc_attr( $current_class_color ); ?>;" class="epc-details clearfix class-<?php echo esc_attr( strtolower( $energy_class ) ); ?>">
                        <li>
                            <strong><?php esc_html_e( 'Energy Class:', 'realhomes-elementor-addon' ); ?></strong>
                            <span><?php echo esc_html( $energy_class ); ?></span>
                        </li>
						<?php
						if ( ! empty( $energy_performance ) ) {
							?>
                            <li>
                                <strong><?php esc_html_e( 'Energy Performance:', 'realhomes-elementor-addon' ); ?></strong>
                                <span><?php echo esc_html( $energy_performance ); ?></span>
                            </li>
							<?php
						}

						if ( ! empty( $epc_current ) ) {
							?>
                            <li>
                                <strong><?php echo sprintf( esc_html__( '%s Current Rating:', 'realhomes-elementor-addon' ), '<abbr title="Energy Performance Certificate">EPC</abbr>' ); ?></strong>
                                <span><?php echo esc_html( $epc_current ); ?><br></span>
                            </li>
							<?php
						}

						if ( ! empty( $energy_potential ) ) {
							?>
                            <li>
                                <strong><?php echo sprintf( esc_html__( '%s Potential Rating:', 'realhomes-elementor-addon' ), '<abbr title="Energy Performance Certificate">EPC</abbr>' ); ?></strong>
                                <span><?php echo esc_html( $energy_potential ); ?></span>
                            </li>
							<?php
						}
						?>
                    </ul>
                    <ul class="energy-class">
						<?php
						foreach ( $energy_classes as $class ) {

							if ( $class['name'] === $energy_class ) {
								$current_class = 'current ' . $class['name'];
								$class_pointer = '<span style="border-top-color: ' . $class['color'] . '"></span>';
							} else {
								$current_class = strtolower( $class['name'] );
								$class_pointer = '';
							}
							echo "<li class='{$current_class}' style='background-color:" . $class['color'] . ";'>" . $class_pointer . $class['name'] . "</li>";
						}
						?>
                    </ul>
                </div>
            </div>
			<?php
		} else {
			rhea_print_no_result_for_editor();
		}
	}
}