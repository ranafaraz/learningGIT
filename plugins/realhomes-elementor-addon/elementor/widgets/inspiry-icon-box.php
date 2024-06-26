<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Icon box widget.
 *
 * Displays an icon, a headline and a text.
 *
 * @since 0.9.8
 */
class RHEA_Icon_Box_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-icon-box-widget';
	}

	public function get_title() {
		return esc_html__( 'Icon Box :: RealHomes', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-icon-box';
	}

	public function get_keywords() {
		return [ 'icon box', 'icon' ];
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'icon_box_section',
			[
				'label' => esc_html__( 'Icon Box', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_responsive_control(
			'position',
			[
				'label' => esc_html__( 'Icon Position', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'top',
				'mobile_default' => 'top',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'realhomes-elementor-addon' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => esc_html__( 'Top', 'realhomes-elementor-addon' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'realhomes-elementor-addon' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'selected_icon[value]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => esc_html__( 'Title & Description', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'This is the heading', 'realhomes-elementor-addon' ),
				'placeholder' => esc_html__( 'Enter your title', 'realhomes-elementor-addon' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => '',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elit tellus, luctus ullamcorper mattis pulvinar dapibus.', 'realhomes-elementor-addon' ),
				'placeholder' => esc_html__( 'Enter your description', 'realhomes-elementor-addon' ),
				'rows' => 6,
				'separator' => 'none',
				'show_label' => false,
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'realhomes-elementor-addon' ),
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'selected_icon[value]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' => esc_html__( 'Color', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-icon .rhea-icon' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => esc_html__( 'Background Color', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-icon .rhea-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'hover_primary_color',
			[
				'label' => esc_html__( 'Color', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-icon .rhea-icon:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label' => esc_html__( 'Background Color', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-icon .rhea-icon:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => esc_html__( 'Spacing', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--rhea-icon-box-icon-margin: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-icon .rhea-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-icon .rhea-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				]
			]
		);

		$active_breakpoints = \Elementor\Plugin::$instance->breakpoints->get_active_breakpoints();

		$rotate_device_args = [];

		$rotate_device_settings = [
			'default' => [
				'unit' => 'deg',
				'size' => '',
			],
		];

		foreach ( $active_breakpoints as $breakpoint_name => $breakpoint ) {
			$rotate_device_args[ $breakpoint_name ] = $rotate_device_settings;
		}

		$this->add_responsive_control(
			'rotate',
			[
				'label' => esc_html__( 'Rotate', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'deg',
					'size' => '',
				],
				'device_args' => $rotate_device_args,
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-icon .rhea-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'border_width',
			[
				'label' => esc_html__( 'Border Width', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-icon .rhea-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator' => 'before'
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => esc_html__( 'Border Color', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-icon .rhea-icon' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_hover_color',
			[
				'label' => esc_html__( 'Border Hover Color', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-icon .rhea-icon:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-icon .rhea-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'realhomes-elementor-addon' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'realhomes-elementor-addon' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'realhomes-elementor-addon' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'realhomes-elementor-addon' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_vertical_alignment',
			[
				'label'     => esc_html__( 'Vertical Alignment', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'flex-start' => esc_html__( 'Top', 'realhomes-elementor-addon' ),
					'center'     => esc_html__( 'Middle', 'realhomes-elementor-addon' ),
					'flex-end'   => esc_html__( 'Bottom', 'realhomes-elementor-addon' ),
				],
				'default'   => 'flex-start',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-wrapper-left, {{WRAPPER}} .rhea-icon-box-wrapper-right' => 'align-items: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => esc_html__( 'Spacing', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-title span, {{WRAPPER}} .rhea-icon-box-title a' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-title a:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .rhea-icon-box-title, {{WRAPPER}} .rhea-icon-box-title span, {{WRAPPER}} .rhea-icon-box-title a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .rhea-icon-box-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .rhea-icon-box-title',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => esc_html__( 'Description', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'realhomes-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-box-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .rhea-icon-box-description',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'description_shadow',
				'selector' => '{{WRAPPER}} .rhea-icon-box-description',
			]
		);

		$this->end_controls_section();
	}
    
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'icon', 'class', [ 'rhea-icon', 'elementor-animation-' . $settings['hover_animation'] ] );

		$icon_tag = 'span';

		$has_icon = ! empty( $settings['icon'] );

		if ( ! empty( $settings['link']['url'] ) ) {
			$icon_tag = 'a';
			$this->add_link_attributes( 'link', $settings['link'] );
		}

		if ( $has_icon ) {
			$this->add_render_attribute( 'i', 'class', $settings['icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}

		$this->add_render_attribute( 'description_text', 'class', 'rhea-icon-box-description' );

		if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
			$has_icon = true;
		}

        $container_class = 'rhea-icon-box-wrapper rhea-icon-box-wrapper-' . $settings['position'];
		?>
		<div class="<?php echo esc_attr( $container_class ); ?>">
			<?php if ( $has_icon ) : ?>
			<div class="rhea-icon-box-icon">
				<<?php \Elementor\Utils::print_validated_html_tag( $icon_tag ); ?> <?php $this->print_render_attribute_string( 'icon' ); ?> <?php $this->print_render_attribute_string( 'link' ); ?>>
				<?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</<?php \Elementor\Utils::print_validated_html_tag( $icon_tag ); ?>>
			</div>
			<?php endif; ?>
			<div class="rhea-icon-box-content">
				<h3 class="rhea-icon-box-title">
					<<?php \Elementor\Utils::print_validated_html_tag( $icon_tag ); ?> <?php $this->print_render_attribute_string( 'link' ); ?> <?php $this->print_render_attribute_string( 'title_text' ); ?>>
						<?php $this->print_unescaped_setting( 'title_text' ); ?>
					</<?php \Elementor\Utils::print_validated_html_tag( $icon_tag ); ?>>
				</h3>
				<?php if ( ! \Elementor\Utils::is_empty( $settings['description_text'] ) ) : ?>
					<p <?php $this->print_render_attribute_string( 'description_text' ); ?>>
						<?php $this->print_unescaped_setting( 'description_text' ); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
