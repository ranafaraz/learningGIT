<?php
/**
 * Meta-box fields related to sidebar area.
 *
 * @since 4.2.0
 */

$tabs['page_layout'] = array(
	'label' => esc_html__( 'Page Layout', 'framework' ),
	'icon'  => 'dashicons-layout',
);

// Prepare registered sidebars options list
$sidebars_list = array();
if ( is_array( $GLOBALS['wp_registered_sidebars'] ) ) {
	foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
		$sidebars_list[ $sidebar['id'] ] = $sidebar['name'];
	}
}

$sidebars_list = array_merge( array( 'default' => esc_html__( 'Default', 'framework' ) ), $sidebars_list );

$fields[] = array(
	'id'       => 'realhomes_page_layout',
	'name'     => esc_html__( 'Page Layout', 'framework' ),
	'type'     => 'select',
	'options'  => array(
		'default'       => esc_html__( 'Default', 'framework' ),
		'fullwidth'     => esc_html__( 'Full Width', 'framework' ),
		'fluid_width'   => esc_html__( 'Fluid Width', 'framework' ),
		'sidebar_right' => esc_html__( 'Sidebar Right', 'framework' ),
		'sidebar_left'  => esc_html__( 'Sidebar Left', 'framework' ),
	),
	'multiple' => false,
	'columns'  => 12,
	'visible'  => array(
		'when'     => array(
			array( 'page_template', '' ),
			array( 'page_template', 'templates/properties.php' ),
			array( 'page_template', 'templates/properties-search.php' ),
		),
		'relation' => 'or'
	),
	'tab'      => 'page_layout',
);

$fields[] = array(
	'id'       => 'realhomes_custom_sidebar',
	'name'     => esc_html__( 'Page Sidebar', 'framework' ),
	'desc'     => esc_html__( 'The page layout will automatically change to Full Width layout when the selected sidebar contains no widget.', 'framework' ),
	'type'     => 'select',
	'options'  => $sidebars_list,
	'multiple' => false,
	'columns'  => 12,
	'visible'  => array(
		'when'     => array(
			array( 'page_template', '' ),
			array( 'page_template', 'templates/properties.php' ),
			array( 'page_template', 'templates/properties-search.php' ),
			array( 'page_template', 'templates/list-layout.php' ),
			array( 'page_template', 'templates/grid-layout.php' ),
			array( 'page_template', 'templates/properties-search-left-sidebar.php' ),
			array( 'page_template', 'templates/properties-search-right-sidebar.php' ),
			array( 'page_template', 'templates/agents-list.php' ),
			array( 'page_template', 'templates/agencies-list.php' ),
			array( 'page_template', 'templates/users-lists.php' ),
			array( 'page_template', 'elementor_theme' ),
		),
		'relation' => 'or',
	),
	'hidden' => array(
		'when'     => array(
			array( 'page_template', 'in', array( '', 'templates/properties.php', 'templates/properties-search.php' ) ),
			array( 'realhomes_page_layout', 'in', array( 'fullwidth', 'fluid_width' ) ),
		),
		'relation' => 'and'
	),
	'tab'      => 'page_layout',
);

$fields[] = array(
	'id'        => 'realhomes_property_half_map',
	'name'      => esc_html__( 'Enable Properties Half Map Layout', 'framework' ),
	'desc'      => esc_html__( 'Enabling this option will override the above settings.', 'framework' ),
	'type'      => 'switch',
	'style'     => 'square',
	'on_label'  => 'Yes',
	'off_label' => 'No',
	'columns'   => 12,
	'visible'   => array(
		'when'     => array(
			array( 'page_template', 'templates/properties.php' ),
			array( 'page_template', 'templates/properties-search.php' ),
		),
		'relation' => 'or'
	),
	'tab'       => 'page_layout',
);

$fields[] = array(
	'id'       => 'realhomes_property_card',
	'name'     => esc_html__( 'Property Card Design', 'framework' ),
	'type'     => 'select',
	'options'  => array(
		'list' => esc_html__( 'List', 'framework' ),
		'grid' => esc_html__( 'Grid', 'framework' ),
	),
	'multiple' => false,
	'columns'  => 6,
	'visible'  => array(
		'when'     => array(
			array( 'page_template', 'templates/properties.php' ),
			array( 'page_template', 'templates/properties-search.php' ),
		),
		'relation' => 'or'
	),
	'hidden'   => [ 'realhomes_property_half_map', '1' ],
	'tab'      => 'page_layout',
);

if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	$fields[] = array(
		'id'      => 'realhomes_properties_card_variation',
		'name'    => esc_html__( 'Property Grid Card Variation', 'framework' ),
		'desc'    => esc_html__( 'Default is the selected variation from Templates & Archives customizer setting.', 'framework' ),
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
		'hidden'  => [ 'realhomes_property_card', 'list' ],
		'columns' => 6,
		'tab'     => 'page_layout',
	);

	$fields[] = array(
		'id'      => 'realhomes_properties_grid_column',
		'name'    => esc_html__( 'Number of Grid Columns', 'framework' ),
		'type'    => 'select',
		'std'     => 'default',
		'options' => array(
			'default' => esc_html__( 'Default', 'framework' ),
			'1'       => esc_html__( 'One', 'framework' ),
			'2'       => esc_html__( 'Two', 'framework' ),
			'3'       => esc_html__( 'Three', 'framework' ),
		),
		'hidden'  => array(
			'when'     => array(
				array( 'page_template', '!=', 'templates/properties.php' ),
				array( 'realhomes_page_layout', 'in', array( 'fullwidth', 'fluid_width' ) ),
				array( 'realhomes_property_card', 'list' )
			),
			'relation' => 'or'
		),
		'columns' => 6,
		'tab'     => 'page_layout',
	);

	$fields[] = array(
		'id'      => 'realhomes_properties_grid_fullwidth_column',
		'name'    => esc_html__( 'Number of Grid Columns', 'framework' ),
		'type'    => 'select',
		'std'     => 'default',
		'options' => array(
			'default' => esc_html__( 'Default', 'framework' ),
			'2'       => esc_html__( 'Two', 'framework' ),
			'3'       => esc_html__( 'Three', 'framework' ),
			'4'       => esc_html__( 'Four', 'framework' ),
		),
		'hidden'  => array(
			'when'     => array(
				array( 'page_template', '!=', 'templates/properties.php' ),
				array( 'realhomes_page_layout', 'in', array( 'default', 'sidebar_right', 'sidebar_left', 'fluid_width' ) ),
				array( 'realhomes_property_card', 'list' )
			),
			'relation' => 'or'
		),
		'columns' => 6,
		'tab'     => 'page_layout',
	);
}