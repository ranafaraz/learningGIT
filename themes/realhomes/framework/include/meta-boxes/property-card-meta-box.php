<?php
$tabs['property_grid_layout'] = array(
	'label' => esc_html__( 'Property Grid', 'framework' ),
	'icon'  => 'dashicons-layout',
);

$fields[] = array(
	'name'    => esc_html__( 'Property Card Design', 'framework' ),
	'desc'    => esc_html__( 'Default is the selected design from Templates & Archives customizer setting', 'framework' ),
	'id'      => 'inspiry-property-card-meta-box',
	'type'    => 'select',
	'std'     => 'default',
	'options' => array(
		'default' => esc_html__( 'Default', 'framework' ),
		'1'       => esc_html__( 'One', 'framework' ),
		'2'       => esc_html__( 'Two', 'framework' ),
		'3'       => esc_html__( 'Three', 'framework' ),
		'4'       => esc_html__( 'Four', 'framework' ),
		'5'       => esc_html__( 'Five', 'framework' ),
	),
	'columns' => 6,
	'tab'     => 'property_grid_layout'
);
$fields[] = array(
	'name'    => esc_html__( 'Number of Columns on the Page', 'framework' ),
	'id'      => 'realhomes_grid_template_column',
	'type'    => 'select',
	'std'     => 'default',
	'options' => array(
		'default' => esc_html__( 'Default', 'framework' ),
		'1'       => esc_html__( 'One', 'framework' ),
		'2'       => esc_html__( 'Two', 'framework' ),
		'3'       => esc_html__( 'Three', 'framework' ),
	),
	'visible' => array( 'page_template', 'templates/grid-layout.php' ),
	'columns' => 6,
	'tab'     => 'property_grid_layout'
);
$fields[] = array(
	'name'    => esc_html__( 'Number of Columns on the Page', 'framework' ),
	'id'      => 'realhomes_grid_fullwidth_template_column',
	'type'    => 'select',
	'std'     => 'default',
	'options' => array(
		'default' => esc_html__( 'Default', 'framework' ),
		'2'       => esc_html__( 'Two', 'framework' ),
		'3'       => esc_html__( 'Three', 'framework' ),
		'4'       => esc_html__( 'Four', 'framework' ),
	),
	'visible' => array( 'page_template', 'templates/grid-layout-full-width.php' ),
	'columns' => 6,
	'tab'     => 'property_grid_layout'
);