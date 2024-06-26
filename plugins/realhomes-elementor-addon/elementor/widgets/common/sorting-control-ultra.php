<?php
class RHEA_Sorting_Control_Ultra extends \Elementor\Base_Data_Control {
    use RHEASortingControlTrait;

	public function get_type() {
		return 'rhea-select-unit-control';
	}

	protected function get_default_settings() {
		return [
			'search_fields' => rhea_search_form_fields()
		];
	}

	public function get_default_value() {
		return implode( ',', array_keys( rhea_search_form_fields() ) );
	}
}