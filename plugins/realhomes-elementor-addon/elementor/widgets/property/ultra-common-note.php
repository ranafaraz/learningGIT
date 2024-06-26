<?php
/**
 * Common Note Elementor widget for single property
 *
 * @since 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Common_Note extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-property-common-note';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Common Note', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-notes';
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
				'default' => esc_html__( 'Common Notes', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'common_note_content',
			[
				'label'       => esc_html__( 'Common Note', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'Leaving empty will get the content from global customizer settings.', 'realhomes-elementor-addon' ),
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
			'content-margin-bottom',
			[
				'label'     => esc_html__( 'Content Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_property__common_note' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {

		if ( 'true' === get_option( 'theme_display_common_note', false ) ) {
			$settings = $this->get_settings_for_display();
			$common_note_title = ! empty( $settings['section_title'] ) ? $settings['section_title'] : get_option( 'theme_common_note_title' );;
			$common_note_content = ! empty( $settings['common_note_content'] ) ? $settings['common_note_content'] : get_option( 'theme_common_note' );

			if ( ! empty( $common_note_content ) ) {
				?>
                <div class="rh_property__common_note margin-bottom-40px <?php realhomes_printable_section( 'common-note' ); ?>">
                    <h4 class="rh_property__heading"><?php echo esc_html( $common_note_title ); ?></h4>
                    <p><?php echo wp_kses_post( $common_note_content ); ?></p>
                </div>
				<?php
			} else {
				rhea_print_no_result_for_editor();
			}
		}

	}
}