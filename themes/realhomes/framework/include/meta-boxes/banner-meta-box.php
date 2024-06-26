<?php
if ( 'ultra' !== INSPIRY_DESIGN_VARIATION ) {
	$tabs['banner'] = array(
		'label' => esc_html__( 'Banner', 'framework' ),
		'icon'  => 'dashicons-flag',
	);
}

if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
	$fields[] = array(
		'name'             => esc_html__( 'Banner Image', 'framework' ),
		'id'               => 'REAL_HOMES_page_banner_image',
		'desc'             => esc_html__( 'Please upload the Banner Image. Otherwise the default banner image from theme options will be displayed.', 'framework' ),
		'type'             => 'image_advanced',
		'max_file_uploads' => 1,
		'tab'              => 'banner',
	);
	$fields[] = array(
		'name'    => esc_html__( 'Banner Title and Sub Title Display Status', 'framework' ),
		'id'      => 'REAL_HOMES_banner_title_display',
		'type'    => 'radio',
		'std'     => 'show',
		'options' => array(
			'show' => esc_html__( 'Show', 'framework' ),
			'hide' => esc_html__( 'Hide', 'framework' ),
		),
		'tab'     => 'banner',
	);
	$fields[] = array(
		'name'    => esc_html__( 'Banner Title', 'framework' ),
		'id'      => 'REAL_HOMES_banner_title',
		'desc'    => esc_html__( 'Please provide the Banner Title, Otherwise the Page Title will be displayed in its place.', 'framework' ),
		'type'    => 'text',
		'columns' => 6,
		'tab'     => 'banner',
	);
	$fields[] = array(
		'name'    => esc_html__( 'Banner Sub Title', 'framework' ),
		'id'      => 'REAL_HOMES_banner_sub_title',
		'desc'    => esc_html__( 'Please provide the Banner Sub Title.', 'framework' ),
		'type'    => 'textarea',
		'cols'    => '20',
		'rows'    => '2',
		'columns' => 6,
		'tab'     => 'banner',
	);
	$fields[] = array(
		'name'    => esc_html__( 'Revolution Slider Alias', 'framework' ),
		'id'      => 'REAL_HOMES_rev_slider_alias',
		'desc'    => esc_html__( 'If you want to replace banner with revolution slider then provide its alias here.', 'framework' ),
		'type'    => 'text',
		'columns' => 6,
		'tab'     => 'banner',
	);

} else if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	$fields[] = array(
		'name'             => esc_html__( 'Banner Image', 'framework' ),
		'id'               => 'REAL_HOMES_page_banner_image',
		'desc'             => esc_html__( 'Please upload the Banner Image. Otherwise the default banner image from theme options will be displayed.', 'framework' ),
		'type'             => 'image_advanced',
		'max_file_uploads' => 1,
		'tab'              => 'banner',
	);
	$fields[] = array(
		'name'    => esc_html__( 'Banner Title Display Status', 'framework' ),
		'id'      => 'REAL_HOMES_banner_title_display',
		'type'    => 'radio',
		'std'     => 'show',
		'options' => array(
			'show' => esc_html__( 'Show', 'framework' ),
			'hide' => esc_html__( 'Hide', 'framework' ),
		),
		'tab'     => 'banner',
	);
	$fields[] = array(
		'name'    => esc_html__( 'Banner Title', 'framework' ),
		'id'      => 'REAL_HOMES_banner_title',
		'desc'    => esc_html__( 'Please provide the Banner Title, Otherwise the Page Title will be displayed in its place.', 'framework' ),
		'type'    => 'text',
		'columns' => 6,
		'tab'     => 'banner',
	);
	$fields[] = array(
		'name'    => esc_html__( 'Revolution Slider Alias', 'framework' ),
		'id'      => 'REAL_HOMES_rev_slider_alias',
		'desc'    => esc_html__( 'If you want to replace banner with revolution slider then provide its alias here.', 'framework' ),
		'type'    => 'text',
		'columns' => 6,
		'tab'     => 'banner',
	);
}