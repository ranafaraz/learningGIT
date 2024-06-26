<?php
/**
 * Contains Elementor Single Property template meta box declaration
 *
 * @since 4.1.0
 *
 */

$tabs['elementor-single-property'] = array(
	'label' => esc_html__( 'Elementor Single Property', 'framework' ),
	'icon'  => 'dashicons-admin-settings',
);

$fields[] = array(
	'name'    => esc_html__( 'Elementor Template For Single Property', 'framework' ),
	'id'      => 'realhomes_elementor_single_property_display',
	'desc'    => esc_html__( 'Select Single Property Template designed using Elementor Page Builder. This option will be overridden if Elementor Pro version is being used to design Single Property.', 'framework' ),
	'type'    => 'select',
	'std'     => 'default',
	'options' => realhomes_get_elementor_library(),
	'columns' => 7,
	'tab'     => 'elementor-single-property',
);