<?php
$tabs['search_form'] = array(
	'label' => esc_html__( 'Search Form', 'framework' ),
	'icon'  => 'dashicons-search',
);

$fields[] = array(
	'name'      => esc_html__( 'Hide Search Form In Header?', 'framework' ),
	'id'        => 'REAL_HOMES_hide_advance_search',
	'type'      => 'switch',
	'style'     => 'square',
	'on_label'  => esc_html__( 'Yes', 'framework' ),
	'off_label' => esc_html__( 'No', 'framework' ),
	'std'       => 0,
	'class'     => 'inspiry_switch_inline',
	'columns'   => 10,
	'tab'       => 'search_form',
);
$fields[] = array(
	'name'    => esc_html__( 'Select Custom Search Form Template', 'framework' ),
	'id'      => 'REAL_HOMES_custom_search_form',
	'type'    => 'select',
	'std'     => 'default',
	'options' => realhomes_get_elementor_library(),
	'visible' => array( 'REAL_HOMES_hide_advance_search', '=', 0 ),
	'columns' => 6,
	'tab'     => 'search_form',
);
$fields[] = array(
	'name'    => esc_html__( 'Custom Search Form Margin Top (i.e 50px, 50%)', 'framework' ),
	'id'      => 'REAL_HOMES_search_form_margin_top',
	'type'    => 'text',
	'visible' => array( 'REAL_HOMES_hide_advance_search', '=', 0 ),
	'columns' => 6,
	'tab'     => 'search_form',
);
$fields[] = array(
	'name'    => esc_html__( 'Custom Search Form Margin Bottom (i.e 50px, 50%)', 'framework' ),
	'id'      => 'REAL_HOMES_search_form_margin_bottom',
	'type'    => 'text',
	'visible' => array( 'REAL_HOMES_hide_advance_search', '=', 0 ),
	'columns' => 6,
	'tab'     => 'search_form',
);