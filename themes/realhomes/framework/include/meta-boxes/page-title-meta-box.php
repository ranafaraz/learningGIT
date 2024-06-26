<?php
if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
	$tabs['page_head_content'] = array(
		'label' => esc_html__( 'Page Head Content', 'framework' ),
		'icon'  => 'dashicons-welcome-write-blog',
	);

	$fields[] = array(
		'name'    => esc_html__( 'Content Display', 'framework' ),
		'id'      => 'realhomes_page_head_content',
		'type'    => 'radio',
		'std'     => 'show',
		'options' => array(
			'show' => esc_html__( 'Show', 'framework' ),
			'hide' => esc_html__( 'Hide', 'framework' ),
		),
		'tab'     => 'page_head_content',
	);
	$fields[] = array(
		'name'    => esc_html__( 'Page Title', 'framework' ),
		'id'      => 'realhomes_page_title',
		'type'    => 'text',
		'visible' => array( 'realhomes_page_head_content', '=', 'show' ),
		'columns' => 6,
		'tab'     => 'page_head_content',
	);
	$fields[] = array(
		'name'    => esc_html__( 'Page Description', 'framework' ),
		'id'      => 'realhomes_page_description',
		'type'    => 'text',
		'visible' => array( 'realhomes_page_head_content', '=', 'show' ),
		'columns' => 6,
		'tab'     => 'page_head_content',
	);

} else {
	$tabs['page_title_tab'] = array(
		'label' => esc_html__( 'Page Title', 'framework' ),
		'icon'  => 'dashicons-welcome-write-blog',
	);

	$fields[] = array(
		'name'    => esc_html__( 'Page Title Display Status', 'framework' ),
		'id'      => 'REAL_HOMES_page_title_display',
		'type'    => 'radio',
		'std'     => 'show',
		'options' => array(
			'show' => esc_html__( 'Show', 'framework' ),
			'hide' => esc_html__( 'Hide', 'framework' ),
		),
		'tab'     => 'page_title_tab',
	);
}