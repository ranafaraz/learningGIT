<?php
$tabs['partners'] = array(
	'label' => esc_html__( 'Partners', 'framework' ),
	'icon'  => 'dashicons-groups',
);

$fields[] = array(
	'name'      => esc_html__( 'Hide Partners ?', 'framework' ),
	'id'        => 'REAL_HOMES_hide_partners',
	'type'      => 'switch',
	'style'     => 'square',
	'on_label'  => esc_html__( 'Yes', 'framework' ),
	'off_label' => esc_html__( 'No', 'framework' ),
	'std'       => 0,
	'columns'   => 8,
	'class'     => 'inspiry_switch_inline',
	'tab'       => 'partners'
);