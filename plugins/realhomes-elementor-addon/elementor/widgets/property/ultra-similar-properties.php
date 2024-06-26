<?php
/**
 * Property Similar Properties Elementor widget for single property
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Similar_Properties extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-property-similar-properties';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Similar Properties', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-post-list';
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
				'default' => esc_html__( 'Similar Properties', 'realhomes-elementor-addon' ),
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
			'basic-settings',
			[
				'label' => esc_html__( 'Settings', 'realhomes-elementor-addon' ),
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
					'{{WRAPPER}} .rh_property__similar_properties' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb-margin-bottom',
			[
				'label'     => esc_html__( 'Thumbnails Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-card-thumb-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title-margin-bottom',
			[
				'label'     => esc_html__( 'Title Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'address-margin-bottom',
			[
				'label'     => esc_html__( 'Address Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-address-ultra' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'types-margin-bottom',
			[
				'label'     => esc_html__( 'Types Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-types' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'filters-margins',
			[
				'label'      => esc_html__( 'Filters Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .similar-properties-filters-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'filters-padding',
			[
				'label'     => esc_html__( 'Filters Padding', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_property__similar_properties .similar-properties-filters-wrapper a' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'filters-border-radius',
			[
				'label'      => esc_html__( 'Filters Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__similar_properties .similar-properties-filters-wrapper a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb-border-radius',
			[
				'label'      => esc_html__( 'Thumbnails Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-property-card-thumb a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'colors_section',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rhea_property_filter_text',
			[
				'label'     => esc_html__( 'Filters Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .similar-properties-filters-wrapper a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_filter_text_hover',
			[
				'label'     => esc_html__( 'Filters Hover/Active', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .similar-properties-filters-wrapper a:hover'            => 'color: {{VALUE}}',
					'{{WRAPPER}} .similar-properties-filters-wrapper a.rh-btn-secondary' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_filter_bg',
			[
				'label'     => esc_html__( 'Filters Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .similar-properties-filters-wrapper a' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_filter_bg_hover',
			[
				'label'     => esc_html__( 'Filters Background Hover/Active', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .similar-properties-filters-wrapper a:hover'            => 'background: {{VALUE}}',
					'{{WRAPPER}} .similar-properties-filters-wrapper a.rh-btn-secondary' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_filter_border',
			[
				'label'     => esc_html__( 'Filters Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .similar-properties-filters-wrapper a' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_filter_border_hover',
			[
				'label'     => esc_html__( 'Filters Border Hover/Active', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .similar-properties-filters-wrapper a:hover'            => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .similar-properties-filters-wrapper a.rh-btn-secondary' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_title_color',
			[
				'label'     => esc_html__( 'Property Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-card-detail-wrapper .rh-ultra-property-title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_title_color_hover',
			[
				'label'     => esc_html__( 'Property Title Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-card-detail-wrapper .rh-ultra-property-title a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_address_color',
			[
				'label'     => esc_html__( 'Address', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-address-ultra a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_address_color_hover',
			[
				'label'     => esc_html__( 'Address Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-address-ultra a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_address_icon',
			[
				'label'     => esc_html__( 'Address Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-address-pin .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_type_color',
			[
				'label'     => esc_html__( 'Types', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-types a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_type_color_hover',
			[
				'label'     => esc_html__( 'Types Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-types a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_price_text_color',
			[
				'label'     => esc_html__( 'Price', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} p.rh_prop_card__price_ultra .property-current-price' => 'color: {{VALUE}}',
					'{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-display'      => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_price_prefix_color',
			[
				'label'     => esc_html__( 'Price Prefix (i.e From)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-prefix' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_price_postfix_color',
			[
				'label'     => esc_html__( 'Price Postfix (i.e Monthly)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-postfix' => 'color: {{VALUE}}',
					'{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-slash'   => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_old_price_color',
			[
				'label'     => esc_html__( 'Old Price', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} p.rh_prop_card__price_ultra .property-old-price' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_meta_icon_color_dark',
			[
				'label'     => esc_html__( 'Meta Icons Dark', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_meta_icon_color_light',
			[
				'label'     => esc_html__( 'Meta Icons light', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-light' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_meta_figure_color',
			[
				'label'     => esc_html__( 'Meta Figures', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_meta_box .figure' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_meta_figure_postfix_color',
			[
				'label'     => esc_html__( 'Meta Figures postfix (i.e sqft)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_meta_box .label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'top_tags_color',
			[
				'label' => esc_html__( 'Top Tags Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rhea_property_status_background',
			[
				'label'     => esc_html__( 'Status Tag Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-status-box .rh-ultra-status' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_status_background_hover',
			[
				'label'     => esc_html__( 'Status Tag Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-status-box .rh-ultra-status:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_status_border_color',
			[
				'label'     => esc_html__( 'Status Tag Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-status-box .rh-ultra-status' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_status_border_hover_color',
			[
				'label'     => esc_html__( 'Status Tag Border Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-status-box .rh-ultra-status:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_status_text_color',
			[
				'label'     => esc_html__( 'Status Tag Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-status-box .rh-ultra-status' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_status_text_hover_color',
			[
				'label'     => esc_html__( 'Status Tag Text Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-status-box .rh-ultra-status:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_featured_background',
			[
				'label'     => esc_html__( 'Featured Tag Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-featured' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_featured_color',
			[
				'label'     => esc_html__( 'Featured Tag Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-featured' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'rhea_property_label_background',
			[
				'label'     => esc_html__( 'Label Tag Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-hot' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_label_color',
			[
				'label'     => esc_html__( 'Label Tag Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-hot' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'rhea_property_media_background',
			[
				'label'     => esc_html__( 'Media Count Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-media-count .rh-media' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_media_background_hover',
			[
				'label'     => esc_html__( 'Media Count Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-media-count .rh-media:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_favourite_compare_bg',
			[
				'label'     => esc_html__( 'Favourite/Compare Button Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-bottom-box .favorite-btn-wrap a'      => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-bottom-box .favorite-btn-wrap span'   => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-bottom-box .add-to-compare-span a'    => 'background: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-bottom-box .add-to-compare-span span' => 'background: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'rhea_favourite_compare_icon_dark',
			[
				'label'     => esc_html__( 'Favourite/Compare Button Icon Outline', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-bottom-box .favorite-btn-wrap a .rh-ultra-dark'   => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-bottom-box .add-to-compare-span a .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_favourite_compare_icon_light',
			[
				'label'     => esc_html__( 'Favourite/Compare Button Inner', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-bottom-box .favorite-btn-wrap a .rh-ultra-light'   => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-bottom-box .add-to-compare-span a .rh-ultra-light' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_favourite_added_bg',
			[
				'label'     => esc_html__( 'Favourite Added Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-bottom-box .favorite-btn-wrap span' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_favourite_added_icon_dark',
			[
				'label'     => esc_html__( 'Favourite Added Icon Outline', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-bottom-box .favorite-btn-wrap span .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_favourite_added_icon_light',
			[
				'label'     => esc_html__( 'Favourite Added Icon Inner', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-bottom-box .favorite-btn-wrap span .rh-ultra-light' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_compare_added_bg',
			[
				'label'     => esc_html__( 'Compare Added Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-bottom-box .add-to-compare-span span' => 'background: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'rhea_compare_added_icon_dark',
			[
				'label'     => esc_html__( 'Compare Added Icon Outline', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-bottom-box .add-to-compare-span span .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_compare_added_icon_light',
			[
				'label'     => esc_html__( 'Compare Added Icon Inner', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-bottom-box .add-to-compare-span span .rh-ultra-light' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_media_text',
			[
				'label'     => esc_html__( 'Media Count Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-media-count .rh-media span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-media-count svg path'       => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_property_media_text_hover',
			[
				'label'     => esc_html__( 'Media Count Text Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-media-count .rh-media:hover span'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-media-count .rh-media:hover svg path' => 'fill: {{VALUE}}',
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
		$number_of_similar_properties = get_option( 'theme_number_of_similar_properties', '2' );
		$similar_properties_args      = array(
			'post_type'           => 'property',
			'posts_per_page'      => intval( $number_of_similar_properties ),
			'post__not_in'        => array( $post_id ),
			'post_parent__not_in' => array( $post_id ),    // to avoid child posts from appearing in similar properties.
		);

		$inspiry_similar_properties = get_option( 'inspiry_similar_properties', array(
			'property-type',
			'property-city'
		) );

		if ( ! empty( $inspiry_similar_properties ) && is_array( $inspiry_similar_properties ) ) {

			$similar_properties_taxonomies = array_diff( $inspiry_similar_properties, array( 'property-agent' ) );
			$similar_properties_count      = count( $similar_properties_taxonomies );
			$tax_query                     = array();

			for ( $index = 0; $index < $similar_properties_count; $index++ ) {
				/* Property Taxonomies array */
				$property_terms = get_the_terms( $post_id, $similar_properties_taxonomies[ $index ] );
				if ( ! empty( $property_terms ) && is_array( $property_terms ) ) {
					$terms_array = array();
					foreach ( $property_terms as $property_term ) {
						$terms_array[] = $property_term->term_id;
					}
					$tax_query[] = array(
						'taxonomy' => $similar_properties_taxonomies[ $index ],
						'field'    => 'id',
						'terms'    => $terms_array,
					);
				}
			}

			$tax_count = count( $tax_query );   // Count number of taxonomies.
			if ( $tax_count > 1 ) {
				$tax_query['relation'] = 'OR';  // Add OR relation if more than one.
			}
			if ( $tax_count > 0 ) {
				$similar_properties_args['tax_query'] = $tax_query;   // Add taxonomies query.
			}

			if ( in_array( 'property-agent', $inspiry_similar_properties ) ) {
				$property_agents = get_post_meta( $post_id, 'REAL_HOMES_agents' );
				if ( ! empty( $property_agents ) ) {
					$similar_properties_args['meta_query'] = array(
						array(
							'key'     => 'REAL_HOMES_agents',
							'value'   => $property_agents,
							'compare' => 'IN',
						),
					);
				}
			}
		}

		/* Sort Properties Based on Theme Option Selection */
		$similar_properties_sorty_by = get_option( 'inspiry_similar_properties_sorty_by' );
		if ( ! empty( $similar_properties_sorty_by ) ) {
			if ( 'low-to-high' == $similar_properties_sorty_by ) {
				$similar_properties_args['orderby']  = 'meta_value_num';
				$similar_properties_args['meta_key'] = 'REAL_HOMES_property_price';
				$similar_properties_args['order']    = 'ASC';
			} else if ( 'high-to-low' == $similar_properties_sorty_by ) {
				$similar_properties_args['orderby']  = 'meta_value_num';
				$similar_properties_args['meta_key'] = 'REAL_HOMES_property_price';
				$similar_properties_args['order']    = 'DESC';
			} else if ( 'random' == $similar_properties_sorty_by ) {
				$similar_properties_args['orderby'] = 'rand';
			}
		}

		$similar_properties_args  = apply_filters( 'inspiry_similar_properties_filter', $similar_properties_args );
		$similar_properties_query = new WP_Query( $similar_properties_args );

		if ( $similar_properties_query->have_posts() ) :
			?>
            <section class="rh_property__similar_properties margin-bottom-40px">
                <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4>
				<?php
				// Similar properties filters markup.
				if ( function_exists( 'realhomes_similar_properties_filters' ) ) {
					realhomes_similar_properties_filters();
				}
				?>
                <div id="similar-properties-wrapper" class="similar-properties-wrapper">
                    <div class="rh-loader">
						<?php inspiry_safe_include_svg( '/icons/ball-triangle.svg' ); ?>
                    </div>
                    <div id="similar-properties" class="rh-ultra-grid-box rh-ultra-card-col-3">

						<?php
						while ( $similar_properties_query->have_posts() ) :
							$similar_properties_query->the_post();
							get_template_part( 'assets/ultra/partials/properties/grid-card-' . get_option( 'realhomes_property_card_variation', '1' ) );
						endwhile;
						wp_reset_postdata();
						?>
                    </div><!-- /.rh_property__container -->
                </div><!-- /.similar-properties-wrapper -->
            </section><!-- /.rh_property__similar -->
		<?php
		endif;


	}
}