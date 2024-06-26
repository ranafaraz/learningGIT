<?php
/**
 * Floor Plans Widget Class
 *
 * It creates floor plans custom widget for Elementor
 *
 * @since 2.1.1
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Property_Floor_Plans_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rhea-property-floor-plans-widget';
	}

	public function get_title() {
		return esc_html__( 'Floor Plans', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-inner-section';
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	public function get_style_depends() {

		wp_register_style(
			'fancybox-css',
			'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css'
		);

		return [ 'fancybox-css' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'property_floor_plans',
			[
				'label' => esc_html__( 'Floor Plans', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$fp_repeater = new \Elementor\Repeater();

		$fp_repeater->add_control(
			'fp_title',
			[
				'label'       => esc_html__( 'Floor Plan Name', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Floor Plan Title', 'realhomes-elementor-addon' ),
				'label_block' => true
			]
		);

		$fp_repeater->add_control(
			'fp_price',
			[
				'label'       => esc_html__( 'Price Statement', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => false
			]
		);

		$fp_repeater->add_control(
			'fp_beds',
			[
				'label'       => esc_html__( 'Bedrooms', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => false
			]
		);

		$fp_repeater->add_control(
			'fp_baths',
			[
				'name'        => 'fp_baths',
				'label'       => esc_html__( 'Bathrooms', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => false
			]
		);

		$fp_repeater->add_control(
			'fp_area',
			[
				'label'       => esc_html__( 'Area Statement', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => false
			]
		);

		$fp_repeater->add_control(
			'fp_description',
			[
				'label'      => esc_html__( 'Description', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::TEXTAREA,
				'show_label' => false
			]
		);

		$fp_repeater->add_control(
			'fp_image',
			[
				'label'   => esc_html__( 'Display Image', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src()
				]
			]
		);

		$fp_repeater->add_control(
			'fp_lightbox_image',
			[
				'label'   => esc_html__( 'Lightbox Big Image', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src()
				]
			]
		);

		$this->add_control(
			'floor_plans_list',
			[
				'label'       => esc_html__( 'Floor Plans List', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $fp_repeater->get_controls(),
				'default'     => [
					[
						'fp_title' => esc_html__( 'Floor Plan', 'realhomes-elementor-addon' ),
						'fp_price' => esc_html__( 'From $300 Per Night', 'realhomes-elementor-addon' ),
						'fp_beds'  => 2,
						'fp_baths' => 3,
						'fp_area'  => esc_html__( ' 654 sq ft', 'realhomes-elementor-addon' )
					]
				],
				'title_field' => '{{{ fp_title }}}'
			]
		);

		$this->end_controls_section();

		// Basic Settings
		$this->start_controls_section(
			'floor_plan_settings',
			[
				'label' => esc_html__( 'Basic Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'floor_plans_columns',
			[
				'label'   => esc_html__( 'Columns', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'two_col',
				'options' => array(
					'two_col'   => esc_html__( 'Two Columns', 'realhomes-elementor-addon' ),
					'three_col' => esc_html__( 'Three Columns', 'realhomes-elementor-addon' ),
					'four_col'  => esc_html__( 'Four Columns', 'realhomes-elementor-addon' )
				)
			]
		);

		$this->add_control(
			'floor_plans_animations',
			[
				'label'   => esc_html__( 'Card Hover Animation', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'image_scale',
				'options' => array(
					'none'        => esc_html__( 'None', 'realhomes-elementor-addon' ),
					'image_scale' => esc_html__( 'Image Scale', 'realhomes-elementor-addon' ),
					'card_scale'  => esc_html__( 'Full Card Scale', 'realhomes-elementor-addon' )
				)
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'    => 'floor_plan_image_size',
				'label'   => esc_html__( 'Thumbnail Size', 'realhomes-elementor-addon' ),
				'default' => 'custom'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Floor Plan Title', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .floor-plans-content h3'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'price_typography',
				'label'    => esc_html__( 'Floor Plan Price', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta .fp-price'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'label'    => esc_html__( 'Floor Plan Meta', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta span'
			]
		);

		$this->add_control(
			'bedroom_icon',
			[
				'label'       => esc_html__( 'Bedroom Icon', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fa fa-bed',
					'library' => 'fa-solid',
				],
				'label_block' => true
			]
		);

		$this->add_control(
			'bathroom_icon',
			[
				'label'       => esc_html__( 'Bathroom Icon', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-shower',
					'library' => 'fa-solid',
				],
				'label_block' => true
			]
		);

		$this->add_control(
			'area_icon',
			[
				'label'       => esc_html__( 'Area Icon', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fa fa-arrows-alt',
					'library' => 'fa-solid',
				],
				'label_block' => true
			]
		);

		$this->add_control(
			'fp_button_text',
			[
				'label'       => esc_html__( 'View Button Text', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'View Floor Plan', 'realhomes-elementor-addon' ),
				'label_block' => true,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'    => esc_html__( 'View Button Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta .rhea-custom-button'
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

		$this->end_controls_section();

		$this->start_controls_section(
			'floor_plans_style_section',
			array(
				'label' => esc_html__( 'Style & Color', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .floor-plans-content h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_bottom_margin',
			[
				'label'      => esc_html__( 'Title Bottom Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .floor-plans-content h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'label'     => esc_html__( 'Price Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta .fp-price' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'price_margin',
			[
				'label'      => esc_html__( 'Price Bottom Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta .fp-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label'     => esc_html__( 'Meta Text Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta .meta-info span' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'meta_icon_color',
			[
				'label'     => esc_html__( 'Meta Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta span i'    => 'color: {{VALUE}}',
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta span svg'  => 'fill: {{VALUE}}',
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta span path' => 'fill: {{VALUE}}'
				]
			]
		);

		$this->add_responsive_control(
			'meta_icons_size',
			[
				'label'     => esc_html__( 'Meta Icons Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta span i' => 'font-size: {{SIZE}}px;'
				]
			]
		);

		$this->add_responsive_control(
			'svg_icons_size',
			[
				'label'       => esc_html__( 'SVG Icons Size', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'If SVG icon is provided then its size should be adjusted separately.', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => 5,
						'max'  => 50,
						'step' => 1
					]
				],
				'default'     => [
					'unit' => 'px',
					'size' => 14,
				],
				'selectors'   => [
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta span svg' => 'width: {{SIZE}}px;'
				]
			]
		);

		$this->add_responsive_control(
			'meta_space_between',
			[
				'label'     => esc_html__( 'Gap Between Meta and Value', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-floor-plan-wrap .floor-plans-content .rhea-floor-plan-meta span' => 'margin-right: {{SIZE}}px;'
				]
			]
		);

		$this->add_responsive_control(
			'meta_icons_space',
			[
				'label'     => esc_html__( 'Meta Icons space', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta span i' => 'margin-right: {{SIZE}}px;'
				]
			]
		);

		$this->add_control(
			'view_button_margin',
			[
				'label'      => esc_html__( 'View Button Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta .rhea-custom-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'view_button_padding',
			[
				'label'      => esc_html__( 'View Button Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta .rhea-custom-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'view_button_bg_color',
			[
				'label'     => esc_html__( 'View Button BG Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta .rhea-custom-button.default'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta .rhea-custom-button.slide-bg' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'floor_plan_view_button_text_color',
			[
				'label'     => esc_html__( 'View Button Text Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta .rhea-custom-button' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'floor_plan_view_button_hover_bg_color',
			[
				'label'     => esc_html__( 'View Button Hover BG Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta .rhea-custom-button.default:hover'   => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta .rhea-custom-button.slide-bg:before' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'floor_plan_view_button_hover_text_color',
			[
				'label'     => esc_html__( 'View Button Hover Text Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .floor-plans-content .rhea-floor-plan-meta .rhea-custom-button:hover' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_responsive_control(
			'contents_hover_height',
			[
				'label'       => esc_html__( 'Content hover height', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'This one is to adjust the height of this area upon hover if button hides based on the custom padding or margin as the height is fixed for this section to control the animation.', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min' => 0,
						'max' => 1000
					]
				],
				'default'     => [
					'unit' => 'px',
					'size' => 170,
				],
				'selectors'   => [
					'{{WRAPPER}} .rhea-floor-plan-wrap:hover .rhea-floor-plan-meta' => 'height: {{SIZE}}px;',
				]
			]
		);

		$this->end_controls_tabs();


		$this->end_controls_section();

		$this->start_controls_section(
			'inquiry-border-settings',
			[
				'label' => esc_html__( 'Border Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'submit-heading',
			[
				'label'     => esc_html__( 'View Floor Plan Button', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'submit_border_radius',
			[
				'label'     => esc_html__( 'Border Radius', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-custom-button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'submit-field-border',
				'label'    => esc_html__( 'Submit Button Border', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-custom-button',
			]
		);

		$this->add_responsive_control(
			'submit_border_radius_hover',
			[
				'label'     => esc_html__( 'Border Radius On Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-custom-button:hover' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'submit-field-border-hover',
				'label'    => esc_html__( 'Submit Button Border Hover', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-custom-button:hover',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings           = $this->get_settings_for_display();
		$fp_list            = $settings['floor_plans_list'];
		$wrap_columns       = $settings['floor_plans_columns'];
		$fp_animation_class = $settings['floor_plans_animations'];
		$bed_icon           = $this->process_meta_icon( 'bedroom_icon', 'fa fa-bed' );
		$bath_icon          = $this->process_meta_icon( 'bathroom_icon', 'fas fa-shower' );
		$area_icon          = $this->process_meta_icon( 'area_icon', 'fa fa-arrows-alt' );
		$view_button_text   = ! empty( $settings['fp_button_text'] ) ? $settings['fp_button_text'] : esc_html( 'View Floor Plan', 'realhomes-elementor-addon' );

		if ( is_array( $fp_list ) && 0 < count( $fp_list ) ) {
			?>
            <div class="rhea-property-floor-plans-wrapper <?php echo esc_attr( $wrap_columns ); ?>">
				<?php
				foreach ( $fp_list as $floor_plan ) {
					$fp_name          = $floor_plan['fp_title'];
					$fp_price         = $floor_plan['fp_price'];
					$fp_bedrooms      = $floor_plan['fp_beds'];
					$fp_bathrooms     = $floor_plan['fp_baths'];
					$fp_size          = $floor_plan['fp_area'];
					$fp_desc          = $floor_plan['fp_description'];
					$fp_image         = $floor_plan['fp_image'];
					$attachment_id    = rhea_get_wpml_translated_image_id( $fp_image['id'] );
					$fp_image_full_id = rhea_get_wpml_translated_image_id( $floor_plan['fp_lightbox_image']['id'] );
					$fp_image_url     = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $attachment_id, 'floor_plan_image_size', $settings );
					if ( ! empty( $fp_image_full_id ) ) {
						$fp_image_full = wp_get_attachment_image_src( $fp_image_full_id, 'full' )[0];
					} else {
						$fp_image_full = wp_get_attachment_image_src( $attachment_id, 'full' )[0];
					}
					$fp_lightbox_id = 'lightbox-' . strtolower( str_replace( ' ', '-', $fp_name ) );

					if ( ! empty( $fp_image_url ) ) {
						?>
                        <div class="rhea-floor-plan-wrap animation-<?php echo esc_attr( $fp_animation_class ); ?>">
                            <figure><?php echo '<img src="' . esc_url( $fp_image_url ) . '" />'; ?></figure>
                            <div class="floor-plans-overlay"></div>
                            <div class="floor-plans-content">
								<?php
								echo ! empty( $fp_name ) ? '<h3 class="rhea-floor-plan-title">' . esc_html( $fp_name ) . '</h3>' : '';
								?>
                                <div class="rhea-floor-plan-meta">
									<?php
									echo ! empty( $fp_price ) ? '<p class="fp-price">' . wp_kses_post( $fp_price ) . '</p>' : '';
									?>
                                    <div class="meta-info">
										<?php
										echo ! empty( $fp_bedrooms ) ? '<span class="bedrooms">' . $bed_icon . ' ' . esc_html( $fp_bedrooms ) . '</span>' : '';
										echo ! empty( $fp_bathrooms ) ? '<span class="bathrooms">' . $bath_icon . ' ' . esc_html( $fp_bathrooms ) . '</span>' : '';
										echo ! empty( $fp_size ) ? '<span class="area">' . $area_icon . ' ' . esc_html( $fp_size ) . '</span>' : '';
										?>
                                    </div>
									<?php
									$button_style = 'default';
									if ( 'default' !== $settings['button_type'] ) {
										$button_style = $settings['button_type'] . ' ' . 'slide-bg';
									}
									?>
                                    <button data-fancybox data-src="#<?php echo esc_attr( $fp_lightbox_id ); ?>" data-closeButton="false" class="rhea-custom-button <?php echo esc_attr( $button_style ) ?>"><?php echo esc_html( $view_button_text ); ?></button>
                                </div>
                            </div>
                            <div id="<?php echo esc_attr( $fp_lightbox_id ); ?>" class="rhea-floor-plan-lightbox">
                                <div class="floor-plans-inner">
                                    <figure><?php echo '<img src="' . esc_url( $fp_image_full ) . '" />'; ?></figure>
                                    <div class="rhea-floor-plan-contents">
										<?php
										echo ! empty( $fp_name ) ? '<h3 class="rhea-floor-plan-title">' . esc_html( $fp_name ) . '</h3>' : '';
										echo ! empty( $fp_price ) ? '<p class="fp-price">' . wp_kses_post( $fp_price ) . '</p>' : '';
										echo ! empty( $fp_desc ) ? '<p class="rhea-floor-desc">' . esc_html( $fp_desc ) . '</p>' : '';
										?>
                                        <div class="meta-info">
											<?php
											echo ! empty( $fp_bedrooms ) ? '<span class="bedrooms">' . $bed_icon . ' ' . esc_html( $fp_bedrooms ) . '</span>' : '';
											echo ! empty( $fp_bathrooms ) ? '<span class="bathrooms">' . $bath_icon . ' ' . esc_html( $fp_bathrooms ) . '</span>' : '';
											echo ! empty( $fp_size ) ? '<span class="bathrooms">' . $area_icon . ' ' . esc_html( $fp_size ) . '</span>' : '';
											?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php
					} // if( ! empty( $fp_image ) )
				} // ending foreach
				?>
            </div>
			<?php
		}
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
			$icon = '<i class="' . $default . '"></i>';
		}

		return $icon;
	}

}