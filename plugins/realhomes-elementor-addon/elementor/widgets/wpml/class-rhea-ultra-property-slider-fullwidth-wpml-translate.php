<?php
/**
 * WPML Support for Property Slider Fullwidth Elementor widget for single property
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Property_Slider_full_WPML_Translate {

	public function __construct() {
		add_filter( 'wpml_elementor_widgets_to_translate', [
			$this,
			'realhomes_ultra_property_slider_full_to_translate'
		] );

	}

	public function realhomes_ultra_property_slider_full_to_translate( $widgets ) {

		$widgets['rhea-ultra-single-property-slider-fullwidth'] = [
			'conditions' => [ 'widgetType' => 'rhea-ultra-single-property-slider-fullwidth' ],
			'fields'     => [

				[
					'field'       => 'ere_properties_labels',
					'type'        => esc_html__( 'Ultra Property Slider: Property Labels', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'ere_property_featured_label',
					'type'        => esc_html__( 'Ultra Property Slider: Featured Tag', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'property_fav_label',
					'type'        => esc_html__( 'Ultra Property Slider: Add To Favourite', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'property_fav_added_label',
					'type'        => esc_html__( 'Ultra Property Slider: Added To Favourite', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'ere_property_compare_label',
					'type'        => esc_html__( 'Ultra Property Slider: Add To Compare', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'ere_property_compare_added_label',
					'type'        => esc_html__( 'Ultra Property Slider: Added To Compare', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'ere_property_print_label',
					'type'        => esc_html__( 'Ultra Property Slider: Print', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'ere_property_share_label',
					'type'        => esc_html__( 'Ultra Property Slider: Share', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'ere_property_photos_label',
					'type'        => esc_html__( 'Ultra Property Slider: Photos Counter Label', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],

			],
		];

		return $widgets;

	}
}


new RHEA_Ultra_Property_Slider_full_WPML_Translate();