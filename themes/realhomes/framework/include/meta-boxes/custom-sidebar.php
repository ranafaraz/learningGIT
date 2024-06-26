<?php
/**
 * Meta-box fields related to sidebar area.
 *
 * @since 4.2.0
 */

$tabs['custom_sidebar'] = array(
	'label' => esc_html__( 'Sidebar', 'framework' ),
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
	'id'       => 'realhomes_custom_sidebar',
	'name'     => esc_html__( 'Custom Sidebar', 'framework' ),
	'type'     => 'select',
	'options'  => $sidebars_list,
	'multiple' => false,
	'columns'  => 12,
	'tab'      => 'custom_sidebar',
);