<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Button_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-button-widget';
	}

	public function get_title() {
		return esc_html__( 'RealHomes: Button', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return ' eicon-button';
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'settings',
			[
				'label' => esc_html__( 'Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'button_text',
			[
				'label'   => esc_html__( 'Button Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Read More', 'realhomes-elementor-addon' )
			]
		);
		$this->add_control(
			'button_text_url',
			[
				'label' => esc_html__( 'Button URL', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::URL,
			]
		);
		$this->add_control(
			'button_icon',
			[
				'label'   => esc_html__( 'Icon', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'button_type',
			[
				'label'   => esc_html__( 'Select Button Type', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default'         => esc_html__( 'Default', 'realhomes-elementor-addon' ),
					'slide-in-left'   => esc_html__( 'Slide In Left', 'realhomes-elementor-addon' ),
					'slide-in-right'  => esc_html__( 'Slide In Right', 'realhomes-elementor-addon' ),
					'slide-in-top'    => esc_html__( 'Slide In Top', 'realhomes-elementor-addon' ),
					'slide-in-bottom' => esc_html__( 'Slide In Bottom', 'realhomes-elementor-addon' ),
				),
			]
		);
		$this->add_control(
			'icon_position',
			[
				'label'   => esc_html__( 'Select Icon Position', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'right',
				'options' => array(
					'left'  => esc_html__( 'left', 'realhomes-elementor-addon' ),
					'right' => esc_html__( 'right', 'realhomes-elementor-addon' ),
				),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'    => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-custom-button',
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => esc_html__( 'Icon Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 40,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-custom-button i'        => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rhea-custom-button span svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_text_gap',
			[
				'label'     => esc_html__( 'Icon And Text Gap', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 40,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-custom-button' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'button_styles',
			[
				'label' => esc_html__( 'Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => esc_html__( 'Button Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-custom-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__( 'Button Text Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-custom-button' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_text_hover_color',
			[
				'label'     => esc_html__( 'Button Text Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-custom-button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_icon_color',
			[
				'label'     => esc_html__( 'SVG/Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-custom-button i'    => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-custom-button svg'  => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rhea-custom-button path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_icon_hover_color',
			[
				'label'     => esc_html__( 'SVG/Icon Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-custom-button:hover i'    => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-custom-button:hover svg'  => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rhea-custom-button:hover path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_icon_stroke_color',
			[
				'label'     => esc_html__( 'SVG Stroke Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-custom-button svg'  => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .rhea-custom-button path' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_icon_stroke_hover_color',
			[
				'label'     => esc_html__( 'SVG Stroke Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-custom-button:hover svg'  => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .rhea-custom-button:hover path' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'     => esc_html__( 'Button Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-custom-button.default'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-custom-button.slide-bg' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => esc_html__( 'Button Background Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-custom-button.default:hover'   => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-custom-button.slide-bg:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'border_tab',
			[
				'label' => esc_html__( 'Button Border', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);

		$this->start_controls_tabs( 'tabs_vew_btn_border' );

		$this->start_controls_tab(
			'ere_border_normal',
			[
				'label' => esc_html__( 'Normal', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'ere_border_type',
				'label'    => esc_html__( 'Border', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-custom-button',
			]
		);
		$this->add_responsive_control(
			'button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-custom-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ere_border_hover',
			[
				'label' => esc_html__( 'Hover', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'ere_border_type_hover',
				'label'    => esc_html__( 'Border', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-custom-button:hover',
			]
		);
		$this->add_responsive_control(
			'button_border_radius_hover',
			[
				'label'      => esc_html__( 'Border Radius Hover', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-custom-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tab();


		$this->end_controls_section();

	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$button_style = 'default';
		if ( 'default' !== $settings['button_type'] ) {
			$button_style = $settings['button_type'] . ' ' . 'slide-bg';
		}
		$button_text_url = $settings['button_text_url'];
		$button_icon     = $settings['button_icon'];
		if ( isset( $button_text_url['url'] ) ) {
			?>
            <a class="rhea-custom-button <?php echo esc_attr( $button_style ) ?>" href="<?php echo esc_url( $button_text_url['url'] ) ?>"
				<?php echo ( isset( $button_text_url['is_external'] ) && 'on' === $button_text_url['is_external'] ) ? 'target="_blank"' : '' ?>
				<?php echo ( isset( $button_text_url['nofollow'] ) && 'on' === $button_text_url['nofollow'] ) ? 'rel="nofollow"' : '' ?>
            >
				<?php
				if ( 'right' == $settings['icon_position'] ) {
					echo esc_html( $settings['button_text'] );
				}
				if ( is_array( $button_icon ) && ! empty( $button_icon ) ) {
					if ( is_array( $button_icon['value'] ) && ! empty( $button_icon['value']['url'] ) ) {
						?><span>
						<?php
						\Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] );

						?>
                        </span><?php
					} else if ( ! empty( $button_icon['library'] && ! empty( $button_icon['value'] ) ) ) {
						?>
                    <i class="<?php echo esc_attr( $button_icon['library'] . ' ' . $button_icon['value'] ) ?>"></i><?php
					}
				}
				if ( 'left' == $settings['icon_position'] ) {
					echo esc_html( $settings['button_text'] );
				}
				?>
            </a>
			<?php
		}

	}

}
