<?php
/**
 * Property Map Elementor widget for single property
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Map extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-property-map';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Map', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
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
				'default' => esc_html__( 'Property on Map', 'realhomes-elementor-addon' ),
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
			'map-height',
			[
				'label'     => esc_html__( 'Map Height', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} #property_map' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tabs-border-radius',
			[
				'label'      => esc_html__( 'Map Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} #property_map' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'section-margin-bottom',
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
					'{{WRAPPER}} .rh_property__map_wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {

		$settings     = $this->get_settings_for_display();
		$post_id      = get_the_ID();
		$editor_class = '';
		// Sample Post id for Elementor editor only
		if ( rhea_is_preview_mode() ) {
			$post_id      = rhea_get_sample_property_id();
			$editor_class = ' rhea-map-temp-background ';
		}

		$property_location = get_post_meta( $post_id, 'REAL_HOMES_property_location', true );
		$property_address  = get_post_meta( $post_id, 'REAL_HOMES_property_address', true );
		$hide_property_map = get_post_meta( $post_id, 'REAL_HOMES_property_map', true );

		if ( ! empty( $property_address ) && ! empty( $property_location ) && ( 1 != $hide_property_map ) ) {
			?>
            <div class="rh_property__map_wrap margin-bottom-40px <?php realhomes_printable_section( 'map' );
			echo esc_attr( $editor_class ); ?>">
                <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4>
                <div id="property_map">
					<?php
					if ( rhea_is_preview_mode() ) {
						rhea_print_no_result( esc_html__( 'Map will be displayed on frontend only', 'realhomes-elementor-addon' ) );
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