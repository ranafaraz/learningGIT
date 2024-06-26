<?php
/**
 * Property Analytics Elementor widget for single property
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Property_Analytics extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-property-analytics';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Analytics', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://elementor.github.io/elementor-icons/
		return 'eicon-hotspot';
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
				'default' => esc_html__( 'Property Views', 'realhomes-elementor-addon' ),
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
		$this->add_control(
			'bg-color',
			[
				'label' => esc_html__( 'Graph Background Color', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			]
		);
		$this->add_control(
			'border-color',
			[
				'label' => esc_html__( 'Graph Border Color', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
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
					'{{WRAPPER}} .rh_property__views_wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
		?>
        <div class="rh_property__views_wrap margin-bottom-40px">
            <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4>
			<?php
			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				echo '<div class="rhea-section-editor-class">';
				rhea_print_no_result( esc_html__( 'Property Analytics will be displayed on frontend only', 'realhomes-elementor-addon' ) );
			} else {
				?>
                <canvas id="property-views-graph" data-bg-color="<?php echo esc_attr( $settings['bg-color'] ) ?>" data-border-color="<?php echo esc_attr( $settings['border-color'] ) ?>" data-property-id="<?php echo esc_attr( $post_id ) ?>"></canvas>
				<?php
			}
			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				echo '</div>';
			}
			?>
        </div>
		<?php

	}
}