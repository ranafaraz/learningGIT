<?php
/**
 * Property Meta Icons Elementor widget for single property
 *
 * @since 2.1.0
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Property_Meta_Icons extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'rhea-ultra-single-property-meta-icons';
	}

	public function get_title()
	{
		return esc_html__('Ultra: Single Property Meta Icons', 'realhomes-elementor-addon');
	}

	public function get_icon()
	{
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-product-meta';
	}

	public function get_categories()
	{
		return ['ultra-realhomes-single-property'];
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__('Settings', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'section_title',
			[
				'label' => esc_html__('Section Title', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Overview', 'realhomes-elementor-addon'),
			]
		);
		$this->add_control(
			'section_title_color',
			[
				'label' => esc_html__('Section Title Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'section_title_typography',
				'label' => esc_html__('Section Title Typography', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__heading',
			]
		);
		$this->add_control(
			'property_id_label',
			[
				'label' => esc_html__('Property ID Label', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Property ID :', 'realhomes-elementor-addon'),
			]
		);
		$this->add_control(
			'property_id_separator_color',
			[
				'label' => esc_html__('Property ID Separator Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-overview-separator' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'property_id_color',
			[
				'label' => esc_html__('Property ID Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-property-id span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'proeprty_id_typography',
				'label' => esc_html__('Property ID Typography', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-property-id span',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'meta_colors_section',
			[
				'label' => esc_html__('Basic Styles', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'meta-padding',
			[
				'label' => esc_html__('Meta Icon Padding', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .rh_ultra_prop_card__meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('tabs_button_style');
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__('Normal', 'elementor'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'meta-icons-border',
				'label' => esc_html__('Meta Icon Border', 'realhomes-elementor-addon'),
				'selector' => '{{WRAPPER}} .rh_ultra_prop_card__meta',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', 'elementor'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'meta-icons-border-hover',
				'label' => esc_html__('Meta Icon Border Hover', 'realhomes-elementor-addon'),
				'selector' => '{{WRAPPER}} .rh_ultra_prop_card__meta:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'meta-border-radius',
			[
				'label' => esc_html__('Meta Icon Border Radius', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .rh_ultra_prop_card__meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'meta-column-gap',
			[
				'label' => esc_html__('Meta Column Gap', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_ultra_prop_card_meta_wrap' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'meta-row-gap',
			[
				'label' => esc_html__('Meta Row Gap', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_ultra_prop_card_meta_wrap' => 'row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'meta-margin-bottom',
			[
				'label' => esc_html__('Meta Wrapper Margin Bottom', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_ultra_prop_card_meta_wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',

				],
			]
		);


		$this->add_control(
			'meta-card-bg',
			[
				'label' => esc_html__('Meta Background', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_ultra_prop_card__meta' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'meta-card-hover',
			[
				'label' => esc_html__('Meta Background Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_ultra_prop_card__meta:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'meta-card-label',
			[
				'label' => esc_html__('Meta Label', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_ultra_meta_icon_wrapper .rh-ultra-meta-label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'meta-card-icon-dark',
			[
				'label' => esc_html__('Meta Icon Dark', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-dark' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-stroke-dark' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'meta-card-icon-light',
			[
				'label' => esc_html__('Meta Icon Light', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-light' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-stroke-dark' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'meta-card-figure',
			[
				'label' => esc_html__('Meta Figure', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_ultra_meta_icon_wrapper .figure' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'meta-card-figure-label',
			[
				'label' => esc_html__('Meta Figure Postfix', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_ultra_prop_card_meta_wrap .label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'meta_typography',
			[
				'label' => esc_html__('Typography', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_label_typography',
				'label' => esc_html__('Meta Label', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_ultra_meta_icon_wrapper .rh-ultra-meta-label',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_figure_typography',
				'label' => esc_html__('Meta Figure', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_ultra_meta_icon_wrapper .figure',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_figure_postfix_typography',
				'label' => esc_html__('Meta Figure Postfix', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_ultra_prop_card_meta_wrap .label',
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{

		/**
		 * Property meta of single property template.
		 *
		 * @since      4.0.1
		 * @package    realhomes
		 * @subpackage ultra
		 */

		$settings = $this->get_settings_for_display();

		// Sample Post id for Elementor editor only
		if (rhea_is_preview_mode()) {
			$post_id = rhea_get_sample_property_id();
		} else {
			$post_id = get_the_ID();
		}

		// get property custom meta
		$post_meta_data = get_post_custom($post_id);

		$meta_to_display = array(
			[
				'id' => 'REAL_HOMES_property_bedrooms',
				'label' => 'inspiry_bedrooms_field_label',
				'default' => esc_html__('Bedrooms', 'realhomes-elementor-addon'),
				'icon' => 'ultra-bedrooms',
				'post-fix' => ''
			],
			[
				'id' => 'REAL_HOMES_property_bathrooms',
				'label' => 'inspiry_bathrooms_field_label',
				'default' => esc_html__('Bathrooms', 'realhomes-elementor-addon'),
				'icon' => 'ultra-bathrooms',
				'post-fix' => ''
			],
			[
				'id' => 'REAL_HOMES_property_garage',
				'label' => 'inspiry_garages_field_label',
				'default' => esc_html__('Garage', 'realhomes-elementor-addon'),
				'icon' => 'ultra-garagers',
				'post-fix' => ''
			],
			[
				'id' => 'REAL_HOMES_property_size',
				'label' => 'inspiry_area_field_label',
				'default' => esc_html__('Area', 'realhomes-elementor-addon'),
				'icon' => 'ultra-area',
				'post-fix' => 'REAL_HOMES_property_size_postfix'
			],
			[
				'id' => 'REAL_HOMES_property_lot_size',
				'label' => 'inspiry_lot_size_field_label',
				'default' => esc_html__('Lot Size', 'realhomes-elementor-addon'),
				'icon' => 'ultra-lot-size',
				'post-fix' => 'REAL_HOMES_property_lot_size_postfix'
			],
			[
				'id' => 'REAL_HOMES_property_year_built',
				'label' => 'inspiry_year_built_field_label',
				'default' => esc_html__('Year Built', 'realhomes-elementor-addon'),
				'icon' => 'ultra-calender',
				'post-fix' => ''
			]
		);

		if (rhea_is_rvr_enabled()) {
			$rvr_meta_to_display = array(
				[
					'id' => 'rvr_guests_capacity',
					'label' => 'inspiry_rvr_guests_field_label',
					'default' => esc_html__('Capacity', 'realhomes-elementor-addon'),
					'icon' => 'guests-icons'
				],
				[
					'id' => 'rvr_min_stay',
					'label' => 'inspiry_rvr_min_stay_label',
					'default' => esc_html__('Min Stay', 'realhomes-elementor-addon'),
					'icon' => 'icon-min-stay'
				],
			);
			array_splice($meta_to_display, 2, 0, $rvr_meta_to_display);
		}

		$meta_to_display = apply_filters('inspiry_property_detail_meta', $meta_to_display);
		?>
		<div class="rh-ultra-overview-box">
			<h4 class="rh_property__heading"><?php echo esc_html($settings['section_title']); ?></h4>
			<?php
			/*
				 $property_id = get_post_meta( $post_id, 'REAL_HOMES_property_id', true );
				 if ( ! empty( $property_id ) ) {
					 ?>
									 <span class="rh-overview-separator">|</span>
									 <div class="rh-property-id">
											 <span><?php echo esc_html( $settings['property_id_label'] ); ?></span>
											 <span><?php echo esc_html( $property_id ); ?></span>
									 </div>
					 <?php
				 }
				 */
			?>
		</div>
		<div class="rh_ultra_prop_card_meta_wrap margin-bottom-40px">
			<?php
			foreach ($meta_to_display as $key => $value) {
				if (!empty($post_meta_data[$value['id']][0])) {
					$label = get_option($value['label']);
					?>
					<div class="rh_ultra_prop_card__meta">
						<div class="rh_ultra_meta_icon_wrapper">
							<span
								class="rh-ultra-meta-label"><?php echo (empty($label)) ? $value['default'] : esc_html($label); ?></span>
							<div class="rh-ultra-meta-icon-wrapper">
								<span class="rh_ultra_meta_icon"><?php rhea_property_meta_icon($value['id'], $value['icon']); ?></span>
								<span class="rh_ultra_meta_box">
									<span class="figure"><?php echo esc_html($post_meta_data[$value['id']][0]); ?></span>
									<?php
									if (isset($value['post-fix']) && !empty($post_meta_data[$value['post-fix']][0])) {
										?>
										<span class="label"><?php echo esc_html($post_meta_data[$value['post-fix']][0]); ?></span>
										<?php
									}
									?>
								</span>
							</div>
						</div>
					</div>
					<?php
				}
			}
			/**
			 * Additional fields created by New Field Builder
			 */
			do_action('inspiry_additional_property_meta_fields', $post_id);
			?>
		</div>
		<?php
	}
}
