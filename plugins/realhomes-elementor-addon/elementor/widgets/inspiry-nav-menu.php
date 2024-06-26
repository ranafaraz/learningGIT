<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Widget for Available RealHomes Nav Menus .
 *
 * @since 0.9.7
 */
class RHEA_Nav_Menu_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rhea-nav-menu';
	}

	public function get_title() {
		return esc_html__( 'RealHomes Nav Menu', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'menu-settings-section',
			[
				'label' => esc_html__( 'Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Get Array of Available Menus
		$menu_list = rhea_get_available_menus();

		if ( ! empty( $menu_list ) ) {
			$this->add_control(
				'select-menu',
				[
					'label'        => esc_html__( 'Select Menu', 'realhomes-elementor-addon' ),
					'type'         => \Elementor\Controls_Manager::SELECT,
					'default'      => array_keys( $menu_list )[0],
					'options'      => $menu_list,
					'save_default' => true,
					'description'  => sprintf( __( 'You can create/manage your Menus from <a href="%s" target="_blank">Menus screen</a>.', 'realhomes-elementor-addon' ), admin_url( 'nav-menus.php' ) ),
					'separator'    => 'after',

				]
			);
		} else {
			$this->add_control(
				'no-menu',
				[
					'type'            => \Elementor\Controls_Manager::RAW_HTML,
					'raw'             => '<strong>' . esc_html__( 'No menu available.', 'realhomes-elementor-addon' ) . '</strong><br>' . sprintf( __( 'You can create/manage your Menus from <a href="%s" target="_blank">Menus screen</a>.', 'realhomes-elementor-addon' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator'       => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}
		$this->add_control(
			'main-menu-head',
			[
				'label' => esc_html__( 'Desktop Menu', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'nav-layout',
			[
				'label'              => esc_html__( 'Menu Layout', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::SELECT,
				'default'            => 'horizontal',
				'frontend_available' => true,
				'options'            => [
					'horizontal' => esc_html__( 'Horizontal', 'realhomes-elementor-addon' ),
					'vertical'   => esc_html__( 'Vertical', 'realhomes-elementor-addon' ),
				],
			]
		);

		$this->add_control(
			'animation-styles',
			[
				'label'              => esc_html__( 'Top Menu Style', 'realhomes-elementor-addon' ),
				'type'               => \Elementor\Controls_Manager::SELECT,
				'default'            => 'default',
				'frontend_available' => true,
				'options'            => [
					'default'         => esc_html__( 'Default', 'realhomes-elementor-addon' ),
					'slide-in-left'   => esc_html__( 'Slide In Left', 'realhomes-elementor-addon' ),
					'slide-in-right'  => esc_html__( 'Slide In Right', 'realhomes-elementor-addon' ),
					'slide-in-top'    => esc_html__( 'Slide In Top', 'realhomes-elementor-addon' ),
					'slide-in-bottom' => esc_html__( 'Slide In Bottom', 'realhomes-elementor-addon' ),
				],
			]
		);


		$this->add_control(
			'menu-item-icon',
			[
				'label'   => esc_html__( 'Drop Down Icon', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'  => esc_html__( 'None', 'realhomes-elementor-addon' ),
					'caret' => esc_html__( 'Caret', 'realhomes-elementor-addon' ),
					'angle' => esc_html__( 'Angle', 'realhomes-elementor-addon' ),
				],

			]
		);

		$this->add_control(
			'menu-align-items',
			[
				'label'   => esc_html__( 'Menu Align', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left'   => [
						'title' => esc_html__( 'Left', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-right',
					],
				],

				'selectors_dictionary' => [
					'left'   => 'justify-content: flex-start',
					'center' => 'justify-content: center',
					'right'  => 'justify-content: flex-end',
				],
				'selectors'            => [
					'{{WRAPPER}} .rhea-elementor-nav-menu' => '{{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'main-menu',
				'label'    => esc_html__( 'Main Menu', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' =>
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu > li > a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'main-menu-dropdown',
				'label'    => esc_html__( 'Main Menu Dropdown', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' =>
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu li li a',
			]
		);

		$this->add_responsive_control(
			'dropdown-icons-size',
			[
				'label'     => esc_html__( 'Dropdown Icon Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper .rhea-menu-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'show_menu_item_description',
			[
				'label'        => esc_html__( 'Show Menu Item Description', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'mobile-menu-head',
			[
				'label'     => esc_html__( 'Mobile Menu', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'menu-trigger-icon',
			[
				'label'       => esc_html__( 'Hamburger Menu Icon', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'label_block' => true
			]
		);


		$this->add_control(
			'mobile_menu_show_at',
			[
				'label'   => esc_html__( 'Mobile Menu Show At Width', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 1139,
			]
		);
		$this->add_control(
			'mobile_menu_max_width',
			[
				'label'   => esc_html__( 'Mobile Menu Max Width', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 280,
			]
		);

		$this->add_control(
			'close_button_text',
			[
				'label'   => esc_html__( 'Close Button Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Close', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'back_button_text',
			[
				'label'   => esc_html__( 'Back Button Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Back', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'ham-menu-align-items',
			[
				'label'   => esc_html__( 'Hamburger Menu Align', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left'   => [
						'title' => esc_html__( 'Left', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-right',
					],
				],

				'selectors_dictionary' => [
					'left'   => 'justify-content: flex-start',
					'center' => 'justify-content: center',
					'right'  => 'justify-content: flex-end',
				],
				'selectors'            => [
					'{{WRAPPER}} .rhea-menu-bars-wrapper' => '{{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mobile-menu-item-icon',
			[
				'label'   => esc_html__( 'Drop Down Icon', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'  => esc_html__( 'Default', 'realhomes-elementor-addon' ),
					'caret' => esc_html__( 'Caret', 'realhomes-elementor-addon' ),
				],

			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'mobile-main-menu-dropdown',
				'label'    => esc_html__( 'Mobile Menu', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' =>
					'body nav.rhea-hc-nav-menu.rhea-hc-nav-' . $this->get_id() . ' .nav-item-link,
					body nav.rhea-hc-nav-menu.rhea-hc-nav-' . $this->get_id() . ' .nav-close-button,
					body nav.rhea-hc-nav-menu.rhea-hc-nav-' . $this->get_id() . ' .nav-back-button,
					body nav.rhea-hc-nav-menu.rhea-hc-nav-' . $this->get_id() . ' .level-title',
			]
		);

		$this->add_responsive_control(
			'mobile-menu-hamburger-size',
			[
				'label'     => esc_html__( 'Hamburger Icon Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-menu-bars i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rhea-menu-bars svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'menu_size_spaces_section',
			[
				'label' => esc_html__( 'Size & Spaces', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'main-menu-size-head',
			[
				'label' => esc_html__( 'Desktop Menu', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);


		$this->add_responsive_control(
			'menu-wrapper-padding',
			[
				'label'      => esc_html__( 'Menu Wrapper Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'first-level-list-item-margin',
			[
				'label'      => esc_html__( 'Menu List Item Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'first-level-item-margin',
			[
				'label'      => esc_html__( 'Menu Item Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'first-level-item-padding',
			[
				'label'      => esc_html__( 'Menu Item Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dropdown-level-item-padding',
			[
				'label'      => esc_html__( 'Dropdown Item Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu ul a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rhea-items-gap',
			[
				'label'     => esc_html__( 'Gap Between Items', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rhea-icon-lg-gap',
			[
				'label'     => esc_html__( 'Dropdown Icon Gap', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu li a' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dropdown-min-width',
			[
				'label'     => esc_html__( 'Dropdown Min Width', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu ul' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dropdown-hover-translate',
			[
				'label'     => esc_html__( 'Dropdown Translate On Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu li:hover>ul' => 'transform: translateY({{SIZE}}{{UNIT}});',
				],
			]
		);


		$this->add_responsive_control(
			'dropdown-level-ul-padding',
			[
				'label'      => esc_html__( 'Dropdown Wrapper Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mobile-menu-size-head',
			[
				'label'     => esc_html__( 'Mobile Menu', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'mobile-menu-items-padding',
			[
				'label'      => esc_html__( 'Items Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'.rhea-hc-nav-' . $this->get_id() . ' li a'              => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'.rhea-hc-nav-' . $this->get_id() . ' .nav-close-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'mobile-menu-bars-padding',
			[
				'label'      => esc_html__( 'Menu Button Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-menu-bars' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'menu_colors_section',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desktop-menu-color-head',
			[
				'label' => esc_html__( 'Desktop Menu', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'menu-wrapper-bg-color',
			[
				'label'     => esc_html__( 'Menu Wrapper Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'nav-menu-li-bg-color',
			[
				'label'     => esc_html__( 'Top Menu Items Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper .default > li > a' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-nav-menu-wrapper .animate > li > a' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'nav-menu-li-text-color',
			[
				'label'     => esc_html__( 'Top Menu Items Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu > li > a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'nav-menu-li-bg-hover-color',
			[
				'label'     => esc_html__( 'Top Menu Items Hover/Current Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper .animate > li > a:before'                => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-nav-menu-wrapper .default > li:hover > a'                 => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-nav-menu-wrapper .default > li.current-menu-item > a'     => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-nav-menu-wrapper .default > li.current-menu-ancestor > a' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'nav-menu-li-text-hover-color',
			[
				'label'     => esc_html__( 'Top Menu Items Hover/Current Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu > li:hover > a'                 => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu > li.current-menu-item > a'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu > li.current-menu-ancestor > a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'nav-menu-dropdown-bg',
			[
				'label'     => esc_html__( 'Dropdown Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu li ul' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'nav-menu-dropdown-li-bg',
			[
				'label'     => esc_html__( 'Dropdown Item Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu ul a' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'nav-menu-dropdown-li-text',
			[
				'label'     => esc_html__( 'Dropdown Item Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu ul a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'nav-menu-dropdown-li-hover-bg',
			[
				'label'     => esc_html__( 'Dropdown hover/current Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu ul li:hover > a'                 => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu ul li.current-menu-item > a'     => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu ul li.current-menu-ancestor > a' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'nav-menu-dropdown-li-hover-text',
			[
				'label'     => esc_html__( 'Dropdown hover/current Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu ul li:hover > a'                 => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu ul li.current-menu-item > a'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu ul li.current-menu-ancestor > a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'nav-menu-item-description-color',
			[
				'label'     => esc_html__( 'Item Description Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu li a .menu-item-desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'nav-menu-item-description-background',
			[
				'label'     => esc_html__( 'Item Description Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu li a .menu-item-desc' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'nav-menu-item-description-hover-color',
			[
				'label'     => esc_html__( 'Item Description Color Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu li a:hover .menu-item-desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'nav-menu-item-description-hover-background',
			[
				'label'     => esc_html__( 'Item Description Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu li a:hover .menu-item-desc' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mobile-menu-color-head',
			[
				'label'     => esc_html__( 'Mobile Menu', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'menu-bars-bg',
			[
				'label'     => esc_html__( 'Menu Bars/Icon Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-menu-bars' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'menu-bars-bg-hover',
			[
				'label'     => esc_html__( 'Menu Bars/Icon Hover Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-menu-bars:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'menu-bars-color',
			[
				'label'     => esc_html__( 'Menu Bars/Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-menu-bars'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-menu-bars svg' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'menu-bars-color-hover',
			[
				'label'     => esc_html__( 'Menu Bars/Icon Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-menu-bars:hover'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-menu-bars:hover svg' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'mobile-menu-background',
			[
				'label'     => esc_html__( 'Menu Wrapper Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper' => 'background: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'mobile-menu-li-bg',
			[
				'label'     => esc_html__( 'Menu Item Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper .nav-item-wrapper a' => 'background: {{VALUE}}',
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper .nav-close-button'   => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'mobile-menu-li-color',
			[
				'label'     => esc_html__( 'Menu Item Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper .nav-item-wrapper a'           => 'color: {{VALUE}}',
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper .nav-close-button'             => 'color: {{VALUE}}',
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper .nav-close-button span:before' => 'border-top-color: {{VALUE}};border-left-color: {{VALUE}}',
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper .nav-close-button span:after'  => 'border-top-color: {{VALUE}};border-left-color: {{VALUE}}',
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper .nav-next span:before'         => 'border-top-color: {{VALUE}};border-left-color: {{VALUE}};color: {{VALUE}}',
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper .nav-back-button span:before'  => 'border-top-color: {{VALUE}};border-left-color: {{VALUE}};color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'mobile-menu-li-hover-bg',
			[
				'label'     => esc_html__( 'Menu Hover/Current Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper .nav-item-wrapper a:hover' => 'background: {{VALUE}} !important',
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper .nav-close-button'         => 'background: {{VALUE}} !important',
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper .nav-back-button'          => 'background: {{VALUE}} !important',

				],
			]
		);
		$this->add_control(
			'mobile-menu-li-border-color',
			[
				'label'     => esc_html__( 'Menu Border Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper .nav-item-wrapper a' => 'border-bottom-color: {{VALUE}} !important',
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper .nav-next'           => 'border-left-color: {{VALUE}} !important',
					'body .rhea-hc-nav-' . $this->get_id() . ' .nav-wrapper .nav-close-button'   => 'border-bottom-color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'menu_border_section',
			[
				'label' => esc_html__( 'Border', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'top-main-menu-border',
			[
				'label' => esc_html__( 'Top Menu Border', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'menu-border',
				'label'    => esc_html__( 'Border', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu > li > a',

			]
		);
		$this->add_control(
			'top-main-menu-border-hover',
			[
				'label' => esc_html__( 'Top Menu Border Hover', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'menu-border-hover',
				'label'    => esc_html__( 'Border Hover', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu > li:hover>a,{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu > li.current-menu-item>a,{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu > li.current-menu-ancestor>a',
			]
		);

		$this->add_control(
			'dropdown-menu-border',
			[
				'label'     => esc_html__( 'Dropdown Menu Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'dropdown-menu-border',
				'label'    => esc_html__( 'Dropdown Border', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu ul  li > a',
			]
		);

		$this->add_control(
			'dropdown-menu-border-heading',
			[
				'label' => esc_html__( 'Dropdown Menu Border Hover', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'dropdown-menu-border-hover',
				'label'    => esc_html__( 'Dropdown Border Hover', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu ul li:hover>a,{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu ul li.current-menu-item>a',
			]
		);

		$this->add_responsive_control(
			'menu-wrapper-border-radius',
			[
				'label'     => esc_html__( 'Menu Wrapper Border Radius', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu-list-border-radius',
			[
				'label'     => esc_html__( 'Top Menu Item Border Radius', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu > li > a' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dropdown-border-radius',
			[
				'label'     => esc_html__( 'Dropdown Border Radius', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu li ul' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'dropdown_menu_box_shadow',
				'label'    => esc_html__( 'Dropdown Menu Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-nav-menu-wrapper ul.rhea-elementor-nav-menu li .sub-menu',
			]
		);

		$this->add_control(
			'mobile-menu-border-settings',
			[
				'label'     => esc_html__( 'Menu Bar Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'menu-bar-border',
				'label'    => esc_html__( 'Menu Bar Border ', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-menu-bars',
			]
		);
		$this->add_control(
			'mobile-menu-border-hover-settings',
			[
				'label' => esc_html__( 'Menu Bar Border Hover', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'menu-bar-border-hover',
				'label'    => esc_html__( 'Menu Bar Border Hover', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-menu-bars:hover',
			]
		);
		$this->add_responsive_control(
			'menu-bar-border-radius',
			[
				'label'     => esc_html__( 'Menu Bars Border Radius', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-menu-bars' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

	}

	/**
	 * Process meta icon based on the settings set in related option
	 *
	 * @since 2.1.1
	 *
	 * @param string $key
	 * @param string $default
	 *
	 * @return string
	 */
	private function process_meta_icon( $key, $default ) {
		$settings     = $this->get_settings_for_display();
		$icon_setting = $settings[ $key ];
		$icon         = $default;

		if ( ! empty( $icon_setting['value'] ) ) {
			ob_start();
			\Elementor\Icons_Manager::render_icon( $icon_setting, [ 'aria-hidden' => 'true' ] );
			$icon = ob_get_contents();
			ob_end_clean();
		} else {
			$icon = '<i class="' . esc_attr( $default ) . '"></i>';
		}

		return $icon;
	}

	public function add_menu_description( $item_output, $item, $depth, $args ) {

		if ( ! empty( $item->description ) ) {
			$item_output = '<a href=' . $item->url . '>' . $item->post_title . '<span class="menu-item-desc">' . $item->description . '</span></a>';
		}

		return $item_output;
	}

	protected function render() {

		if ( ! rhea_get_available_menus() ) {
			return;
		}
		$settings        = $this->get_settings_for_display();
		$widget_id       = $this->get_id();
		$animation_style = ' default ';
		if ( 'default' !== $settings['animation-styles'] ) {
			$animation_style = ' animate ' . $settings['animation-styles'];
		}

		$args = [
			'echo'            => true,
			'menu'            => $settings['select-menu'],
			'menu_class'      => 'rhea-elementor-nav-menu' . $animation_style,
			'menu_id'         => 'rhea-menu-' . $widget_id,
			'container_class' => 'rhea-menu-container rhea-menu-' . $settings['nav-layout'],
		];

		if ( $settings['show_menu_item_description'] === 'yes' ) {
			add_filter( 'walker_nav_menu_start_el', array( $this, 'add_menu_description' ), 10, 4 );
		}

		?>
        <div class="rhea-lg-menu-<?php echo esc_attr( $widget_id ); ?>  rhea-nav-menu-wrapper">
			<?php
			wp_nav_menu( $args );
			?>
        </div>

        <div class="rhea-nav-menu-responsive rhea-responsive-men-<?php echo esc_attr( $widget_id ) ?> rhea-show-menu-<?php echo esc_attr( $settings['mobile_menu_show_at'] ) ?>">
            <div class="rhea-menu-bars-wrapper">
                <div class="rhea-menu-bars rhea-bars-<?php echo esc_attr( $widget_id ) ?>">
					<?php
					if ( ! empty( $settings['menu-trigger-icon'] ) ) {
						echo $this->process_meta_icon( 'menu-trigger-icon', 'fa fa-bars' );
					} else {
						?>
                        <i class="fa fa-bars"></i>
						<?php
					}
					?>
                </div>
            </div>
			<?php
			wp_nav_menu( array(
				'menu'            => $settings['select-menu'],
				'theme_location'  => 'responsive-menu',
				'walker'          => new RH_Walker_Nav_Menu(),
				'menu_class'      => 'rhea-menu-responsive clearfix',
				'fallback_cb'     => false, // Do not fall back to wp_page_menu()
				'container_class' => 'rhea-ultra-responsive-nav-' . $widget_id,
			) );
			?>

        </div>

		<?php

		if ( 'caret' == $settings['menu-item-icon'] ) {
			$icon_html = '<i class="rhea-menu-icon fas fa-caret-down rh_menu__indicator"></i>';
		} else if ( 'angle' == $settings['menu-item-icon'] ) {
			$icon_html = '<i class="rhea-menu-icon fas fa-angle-down rh_menu__indicator"></i>';
		} else {
			$icon_html = '';
		}
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			?>
            <script>
                ( function ( $ ) {
                    'use strict';
                    $( window ).resize( function () {
                        rheaMenuDisplayScreen(<?php echo esc_attr( $settings['mobile_menu_show_at'] ); ?>, "<?php echo esc_attr( $widget_id )?>" );
                    } );
                    rheaMenuDisplayScreen(<?php echo esc_attr( $settings['mobile_menu_show_at'] ); ?>, "<?php echo esc_attr( $widget_id )?>" );
                    var sub_lg_menu_parent = $( '.rhea-lg-menu-<?php echo esc_attr( $widget_id )?> ul.sub-menu' )
                    .prev( 'a' );
                    sub_lg_menu_parent.append( '<?php echo $icon_html ?>' );
                    var sub_menu_parent = $( '.rhea-inner-<?php echo esc_attr( $widget_id )?> ul.sub-menu' )
                    .parent();

                    $( '.rhea-inner-<?php echo esc_attr( $widget_id )?> .rhea-elementor-nav-menu > li .rh_menu__indicator' )
                    .on( 'click', function ( e ) {
                        e.preventDefault();
                        $( this ).parent().children( 'ul.sub-menu' ).slideToggle();
                        $( this ).toggleClass( 'rh_menu__indicator_up' );
                    } );
                    // Responsive Nav
                    $( '.rhea-ultra-responsive-nav-<?php echo esc_attr( $widget_id ) ?>' ).hcOffcanvasNav( {
                        disableAt    : '<?php echo esc_attr( $settings['mobile_menu_show_at'] ); ?>',
                        width        : '<?php echo esc_attr( $settings['mobile_menu_max_width'] ); ?>',
                        insertClose  : true,
                        insertBack   : true,
                        labelClose   : '<?php echo esc_attr( $settings['close_button_text'] )?>',
                        labelBack    : '<?php echo esc_attr( $settings['back_button_text'] )?>',
                        levelSpacing : 40,
                        navClass     : 'rhea-hc-nav-menu <?php echo esc_attr( $settings['mobile-menu-item-icon'] ); ?> rhea-hc-nav-<?php echo esc_attr( $widget_id ); ?>',
                        customToggle : '.rhea-bars-<?php echo esc_attr( $widget_id ) ?>'
                    } );

                } )( jQuery );

            </script>
			<?php
		} else {
			?>
            <script>
                ( function ( $ ) {
                    'use strict';
                    $( window ).resize( function () {
                        rheaMenuDisplayScreen(<?php echo esc_attr( $settings['mobile_menu_show_at'] ); ?>, "<?php echo esc_attr( $widget_id )?>" );
                    } );
                    $( document ).on( 'ready', function () {
                        rheaMenuDisplayScreen(<?php echo esc_attr( $settings['mobile_menu_show_at'] ); ?>, "<?php echo esc_attr( $widget_id )?>" );
                        var sub_lg_menu_parent = $( '.rhea-lg-menu-<?php echo esc_attr( $widget_id )?> ul.sub-menu' )
                        .prev( 'a' );
                        sub_lg_menu_parent.append( '<?php echo $icon_html ?>' );
                        var sub_menu_parent = $( '.rhea-inner-<?php echo esc_attr( $widget_id )?> ul.sub-menu' )
                        .parent();
                        $( '.rhea-inner-<?php echo esc_attr( $widget_id )?> .rhea-elementor-nav-menu > li .rh_menu__indicator' )
                        .on( 'click', function ( e ) {
                            e.preventDefault();
                            $( this ).parent().children( 'ul.sub-menu' ).slideToggle();
                            $( this ).toggleClass( 'rh_menu__indicator_up' );
                        } );
                        // Responsive Nav
                        $( '.rhea-ultra-responsive-nav-<?php echo esc_attr( $widget_id ) ?>' ).hcOffcanvasNav( {
                            disableAt    : '<?php echo esc_attr( $settings['mobile_menu_show_at'] ); ?>',
                            width        : '<?php echo esc_attr( $settings['mobile_menu_max_width'] ); ?>',
                            insertClose  : true,
                            insertBack   : true,
                            labelClose   : '<?php echo esc_attr( $settings['close_button_text'] )?>',
                            labelBack    : '<?php echo esc_attr( $settings['back_button_text'] )?>',
                            levelSpacing : 40,
                            navClass     : 'rhea-hc-nav-menu <?php echo esc_attr( $settings['mobile-menu-item-icon'] ); ?> rhea-hc-nav-<?php echo esc_attr( $widget_id ); ?>',
                            customToggle : '.rhea-bars-<?php echo esc_attr( $widget_id ) ?>'
                        } );

                    } );
                } )( jQuery );


            </script>
			<?php
		}

	}
}
