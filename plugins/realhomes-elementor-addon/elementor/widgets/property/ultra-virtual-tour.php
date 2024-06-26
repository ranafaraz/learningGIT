<?php
/**
 * Property Virtual Tour Elementor widget for single property
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Property_Virtual_Tour extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-property-virtual-tour';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Virtual Tour', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-video-camera';
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
				'default' => esc_html__( 'Property Tour', 'realhomes-elementor-addon' ),
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
			'virtual_colors_section',
			[
				'label' => esc_html__( 'Basic Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'virtual-tour-height',
			[
				'label'     => esc_html__( 'Section Height', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .property-content-section' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'virtual-tour-border-radius',
			[
				'label'      => esc_html__( 'Section Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-property-virtual-tour-inner-wrap iframe' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'virtual-tour-margin-bottom',
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
					'{{WRAPPER}} .property-content-section' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
		if ( 'true' === get_option( 'inspiry_display_virtual_tour' ) ) {
			$rh_360_virtual_tour = trim( get_post_meta( $post_id, 'REAL_HOMES_360_virtual_tour', true ) );
			if ( ! empty( $rh_360_virtual_tour ) ) {
				?>
                <div id="property-content-section-virtual-tour" class="property-content-section rh_property__virtual_tour margin-bottom-40px">
                    <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4>

                    <div class="rh-property-virtual-tour-inner-wrap">
						<?php
						if ( ( has_shortcode( $rh_360_virtual_tour, 'ipanorama' ) || has_shortcode( $rh_360_virtual_tour, 'ipano' ) ) && class_exists( 'iPanorama_Activator' ) ) {
							echo do_shortcode( $rh_360_virtual_tour );
						} else {
							echo wp_kses( $rh_360_virtual_tour, inspiry_embed_code_allowed_html() );
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
}