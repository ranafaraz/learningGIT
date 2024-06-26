<?php
/**
 * Property Additional Details Elementor widget for single property
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Additional_Details extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-property-additional-details';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Additional Details', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-bullet-list';
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
				'default' => esc_html__( 'Additional Details', 'realhomes-elementor-addon' ),
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
			'additional_details_colors_section',
			[
				'label' => esc_html__( 'Basic Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'list-padding',
			[
				'label'      => esc_html__( 'Features Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__additional li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list-border-radius',
			[
				'label'      => esc_html__( 'Features Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__additional li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'features-margin-bottom',
			[
				'label'     => esc_html__( 'Wrapper Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_property__additional' => 'margin-bottom: {{SIZE}}{{UNIT}};',

				],
			]
		);
		$this->add_control(
			'list-bg',
			[
				'label'     => esc_html__( 'List Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__additional li' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list-title-color',
			[
				'label'     => esc_html__( 'List Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__additional li .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list-title-value',
			[
				'label'     => esc_html__( 'List Value', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__additional li .value' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list-alternate-bg',
			[
				'label'     => esc_html__( 'List Alternate Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__additional li:nth-child(even)' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list-alternate-title-color',
			[
				'label'     => esc_html__( 'List Alternate Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__additional li:nth-child(even) .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list-alternate-title-value',
			[
				'label'     => esc_html__( 'List Alternate Value', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__additional li:nth-child(even) .value' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'list-typography',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'list_label_typography',
				'label'    => esc_html__( 'List Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__additional li .title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'list_label_value',
				'label'    => esc_html__( 'List Value', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__additional li .value',
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

		ere_additional_details_migration( $post_id ); // Migrate property additional details from old metabox key to new key.
		$additional_details = get_post_meta( $post_id, 'REAL_HOMES_additional_details_list', true );

		if ( ! empty( $additional_details ) ) {
			$additional_details = array_filter( $additional_details ); // remove empty values.
		}

		if ( ! empty( $additional_details ) ) {
			?>
            <div class="rh-property-additional-details-wrapper <?php realhomes_printable_section( 'additional-details' ); ?>">
                <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4>
				<?php
				echo '<ul class="rh_property__additional margin-bottom-40px clearfix">';
				foreach ( $additional_details as $detail ) {
					?>
                    <li>
                        <span class="title"><?php echo esc_html( $detail[0] ); ?>:</span>
                        <span class="value"><?php echo esc_html( $detail[1] ); ?></span>
                    </li>
					<?php
				}
				echo '</ul>';
				?>
            </div>
			<?php
		} else {
			rhea_print_no_result_for_editor();
		}

	}
}