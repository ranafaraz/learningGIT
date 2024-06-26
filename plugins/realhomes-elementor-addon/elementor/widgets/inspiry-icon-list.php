<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Icon_List_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'inspiry-icon-list-widget';
	}

	public function get_title() {
		return esc_html__( 'Icon List :: RealHomes', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-bullet-list';
	}

	public function get_keywords() {
		return [ 'icon list', 'icon', 'list' ];
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'icon_list_section',
			[
				'label' => esc_html__( 'Icon List', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => esc_html__( 'Layout', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'traditional',
				'options' => [
					'traditional' => [
						'title' => esc_html__( 'Default', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-editor-list-ul',
					],
					'inline'      => [
						'title' => esc_html__( 'Inline', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-ellipsis-h',
					],
				]
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'text',
			[
				'label'       => esc_html__( 'First Field Text', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'List Item', 'realhomes-elementor-addon' ),
				'default'     => esc_html__( 'List Item', 'realhomes-elementor-addon' ),
			]
		);

		$repeater->add_control(
			'text_right',
			[
				'label'       => esc_html__( 'Second Field Text', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'selected_icon',
			[
				'label'   => esc_html__( 'Icon', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-check',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'icon_list',
			[
				'label'       => esc_html__( 'Items', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'text'          => esc_html__( 'List Item #1', 'realhomes-elementor-addon' ),
						'selected_icon' => [
							'value'   => 'fas fa-check',
							'library' => 'fa-solid',
						],
					],
					[
						'text'          => esc_html__( 'List Item #2', 'realhomes-elementor-addon' ),
						'selected_icon' => [
							'value'   => 'fas fa-times',
							'library' => 'fa-solid',
						],
					],
					[
						'text'          => esc_html__( 'List Item #3', 'realhomes-elementor-addon' ),
						'selected_icon' => [
							'value'   => 'fas fa-dot-circle',
							'library' => 'fa-solid',
						],
					],
				],
				'title_field' => '{{{ elementor.helpers.renderIcon( this, selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_list',
			[
				'label' => esc_html__( 'List', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'container_padding',
			[
				'label'      => esc_html__( 'Container Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-icon-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'container_border_radius',
			[
				'label'      => esc_html__( 'Container Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-icon-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'list_item_padding',
			[
				'label'      => esc_html__( 'List Item Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-icon-list-item-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'list_item_border_radius',
			[
				'label'      => esc_html__( 'List Item Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-icon-list-item-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'container_color',
			[
				'label'     => esc_html__( 'Container Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_item_bg_color',
			[
				'label'     => esc_html__( 'List Item Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-item-wrapper' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_item_bg_hover_color',
			[
				'label'     => esc_html__( 'List Item Background Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-item-wrapper:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label'     => esc_html__( 'Space Between Items', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-traditional .rhea-icon-list-item'                => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rhea-icon-list-inline .rhea-icon-list-item'                     => 'padding-right: {{SIZE}}{{UNIT}}; padding-left: 0;',
					'{{WRAPPER}} .rhea-icon-list-inline .rhea-icon-list-item:last-child'          => 'padding-right: 0',
					'body.rtl {{WRAPPER}} .rhea-icon-list-inline .rhea-icon-list-item'            => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: 0;',
					'body.rtl {{WRAPPER}} .rhea-icon-list-inline .rhea-icon-list-item:last-child' => 'padding-left: 0',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'items_margin_bottom',
			[
				'label'     => esc_html__( 'Items Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-inline .rhea-icon-list-item:not(:last-child)' => 'margin-bottom: calc({{SIZE}}{{UNIT}}/2);',
				],
				'condition' => [
					'view' => 'inline',
				]
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label'     => esc_html__( 'Border Style', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'solid'  => esc_html__( 'Solid', 'realhomes-elementor-addon' ),
					'double' => esc_html__( 'Double', 'realhomes-elementor-addon' ),
					'dotted' => esc_html__( 'Dotted', 'realhomes-elementor-addon' ),
					'dashed' => esc_html__( 'Dashed', 'realhomes-elementor-addon' ),
				],
				'default'   => 'solid',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-traditional .rhea-icon-list-item:not(:last-child)' => 'border-bottom-style: {{VALUE}}',
				],
				'condition' => [
					'view' => 'traditional',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label'     => esc_html__( 'Width', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'default'   => [
					'size' => 1,
				],
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => [
					'view' => 'traditional',
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-traditional .rhea-icon-list-item:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label'     => esc_html__( 'Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'view' => 'traditional',
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-traditional .rhea-icon-list-item' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-item-icon i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .rhea-icon-list-item-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label'     => esc_html__( 'Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-item .rhea-icon-list-item-wrapper:hover .rhea-icon-list-item-icon i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .rhea-icon-list-item .rhea-icon-list-item-wrapper:hover .rhea-icon-list-item-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-item-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_hover_color',
			[
				'label'     => esc_html__( 'Background Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-item:hover .rhea-icon-list-item-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => esc_html__( 'Icon Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-item-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rhea-icon-list-item-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_box_size',
			[
				'label'     => esc_html__( 'Box Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-item-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label'     => esc_html__( 'Border Radius', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-item-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_gap',
			[
				'label'     => esc_html__( 'Gap Between Text and Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-item-icon' => is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[
				'label' => esc_html__( 'Text', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'first_field_text',
				'label'    => esc_html__( 'First Field Text', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-icon-list-item-text',
			]
		);

		$this->add_control(
			'first_field_text_color',
			[
				'label'     => esc_html__( 'Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-item .rhea-icon-list-item-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'first_field_text_color_hover',
			[
				'label'     => esc_html__( 'Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-item .rhea-icon-list-item-wrapper:hover .rhea-icon-list-item-text' => 'color: {{VALUE}};',
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'second_field_text',
				'label'    => esc_html__( 'Second Field Text', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-icon-list-item-text-right',
			]
		);

		$this->add_control(
			'second_field_text_color',
			[
				'label'     => esc_html__( 'Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-item .rhea-icon-list-item-text-right' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'second_field_text_color_hover',
			[
				'label'     => esc_html__( 'Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-icon-list-item:hover .rhea-icon-list-item-text-right' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings        = $this->get_settings_for_display();
		$widget_id       = 'rhea-icon-list-' . $this->get_id();
		$container_class = 'rhea-icon-list';

		if ( isset( $settings['view'] ) ) {
			$container_class .= ' rhea-icon-list-' . $settings['view'];
		}
		?>
        <ul id="<?php echo esc_attr( $widget_id ); ?>" class="<?php echo esc_attr( $container_class ); ?>">
			<?php
			foreach ( $settings['icon_list'] as $index => $item ) :
				?>
                <li class="rhea-icon-list-item">
					<?php
					if ( ! empty( $item['link']['url'] ) ) {
						$link_key = 'link_' . $index;

						$this->add_link_attributes( $link_key, $item['link'] );

						echo '<a class="rhea-icon-list-item-wrapper"' . $this->get_render_attribute_string( $link_key ) . '>';
					} else {
						echo '<span class="rhea-icon-list-item-wrapper">';
					}

					if ( ! empty( $item['selected_icon']['value'] ) ) : ?>
                        <span class="rhea-icon-list-item-icon">
							<?php \Elementor\Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</span>
					<?php endif; ?>
                    <span class="rhea-icon-list-item-text"><?php echo esc_html( $item['text'] ); ?></span>

					<?php
					if ( ! empty( $item['link']['url'] ) ) {
						echo '</a>';
					} else {
						echo '</span>';
					}
					?>

					<?php
					if ( ! empty( $item['text_right'] ) ) : ?>
                        <span class="rhea-icon-list-item-text-right"><?php echo esc_html( $item['text_right'] ); ?></span>
					<?php endif; ?>
                </li>
			<?php
			endforeach;
			?>
        </ul>
		<?php
	}
}