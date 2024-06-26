<?php
$tabs['custom_footer'] = array(
	'label' => esc_html__( 'Footer', 'framework' ),
	'icon'  => 'dashicons-admin-settings',
);

$fields[] = array(
	'name'    => esc_html__( 'Select Template For Custom Footer', 'framework' ),
	'id'      => 'REAL_HOMES_custom_footer_display',
	'type'    => 'select',
	'std'     => 'default',
	'options' => realhomes_get_elementor_library(),
	'columns' => 6,
	'tab'     => 'custom_footer',
);