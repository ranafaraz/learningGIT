<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_News_WPML_Translate {

	public function __construct() {
		add_filter( 'wpml_elementor_widgets_to_translate', [
			$this,
			'realhomes_ultra_news_widget_to_translate'
		] );
	}

	public function realhomes_ultra_news_widget_to_translate( $widgets ) {

		$widgets['rhea-ultra-news'] = [
			'conditions' => [ 'widgetType' => 'rhea-ultra-news' ],
			'fields'     => [
				[
					'field'       => 'by-label',
					'type'        => esc_html__( 'Ultra News: By Label', 'realhomes-elementor-addon' ),
					'editor_type' => 'LINE'
				],
			],
		];

		return $widgets;
	}
}

new RHEA_Ultra_News_WPML_Translate();