<?php
/**
 * Class RHEA_Sorting_Control_Modern
 *
 * Custom Elementor data control for modern search form fields sorting.
 *
 * @since 2.3.0
 */
class RHEA_Sorting_Control_Modern extends \Elementor\Base_Data_Control {
	use RHEASortingControlTrait;

	/**
	 * Get control type.
	 *
	 * Retrieve the control type, in this case, it's 'rhea-select-unit-control-modern'.
	 *
	 * @since 2.3.0
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return 'rhea-select-unit-control-modern';
	}

	/**
	 * Retrieve default settings.
	 *
	 * Retrieve the default settings for the control.
	 *
	 * @since 2.3.0
	 *
	 * @return array Default settings.
	 */
	protected function get_default_settings() {
		return [
			'search_fields' => rhea_search_form_fields( true )
		];
	}

	/**
	 * Retrieve default value.
	 *
	 * Retrieve the default value for the control.
	 *
	 * @since 2.3.0
	 *
	 * @return string Default value.
	 */
	public function get_default_value() {
		return implode( ',', array_keys( rhea_search_form_fields( true ) ) );
	}
}