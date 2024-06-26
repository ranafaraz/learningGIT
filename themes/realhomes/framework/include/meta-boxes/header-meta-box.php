<?php
$tabs['custom_header'] = array(
	'label' => esc_html__( 'Header', 'framework' ),
	'icon'  => 'dashicons-admin-settings',
);

$fields[] = array(
	'name'    => esc_html__( 'Select Template For Custom Header', 'framework' ),
	'id'      => 'REAL_HOMES_custom_header_display',
	'type'    => 'select',
	'std'     => 'default',
	'options' => realhomes_get_elementor_library(),
	'columns' => 6,
	'tab'     => 'custom_header',
);
$fields[] = array(
	'name'    => esc_html__( 'Custom Header Position', 'framework' ),
	'id'      => 'REAL_HOMES_custom_header_position',
	'type'    => 'radio',
	'std'     => 'relative',
	'options' => array(
		'relative' => esc_html__( 'Relative', 'framework' ),
		'absolute' => esc_html__( 'Absolute', 'framework' ),
	),
	'tab'     => 'custom_header',
);