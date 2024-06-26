<?php
/**
 * Contains Elementor Single Agent/Agency template meta box declaration
 *
 * @since 4.3.0
 *
 */

$tabs['elementor-single-agent'] = array(
	'label' => esc_html__( 'Agent/Agency Single Elementor Template', 'framework' ),
	'icon'  => 'dashicons-admin-settings',
);

$fields[] = array(
	'name'    => esc_html__( 'Elementor Template For Single Agent/Agency', 'framework' ),
	'id'      => 'realhomes_elementor_single_agent_agency_template',
	'desc'    => esc_html__( 'Select Agent/Agency Single Template designed using Elementor Page Builder. This option will be overridden if Elementor Pro version is being used to design Single Agent/Agency.', 'framework' ),
	'type'    => 'select',
	'std'     => 'default',
	'options' => realhomes_get_elementor_library(),
	'columns' => 7,
	'tab'     => 'elementor-single-agent',
);