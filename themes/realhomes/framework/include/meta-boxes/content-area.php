<?php
$tabs['content_area'] = array(
	'label' => esc_html__( 'Content Area', 'framework' ),
	'icon'  => 'dashicons-media-text',
);

$content_position_label = esc_html__( 'Display Content Above Footer?', 'framework' );
if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
	$content_position_label = esc_html__( 'Display Content Area At Bottom?', 'framework' );
}

$fields[] = array(
	'name'      => $content_position_label,
	'id'        => 'REAL_HOMES_content_area_above_footer',
	'type'      => 'switch',
	'style'     => 'square',
	'on_label'  => esc_html__( 'Yes', 'framework' ),
	'off_label' => esc_html__( 'No', 'framework' ),
	'std'       => 0,
	'columns'   => 8,
	'class'     => 'inspiry_switch_inline',
	'tab'       => 'content_area',
);

if ( 'ultra' !== INSPIRY_DESIGN_VARIATION ) {
	$tabs['spacing'] = array(
		'label' => esc_html__( 'Spacing', 'framework' ),
		'icon'  => 'dashicons-yes',
	);

	if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
		$fields[] = array(
			'name'      => esc_html__( 'Remove page’s top and bottom spacing', 'framework' ),
			'id'        => 'REAL_HOMES_page_top_bottom_padding_nil',
			'type'      => 'switch',
			'style'     => 'square',
			'on_label'  => esc_html__( 'Yes', 'framework' ),
			'off_label' => esc_html__( 'No', 'framework' ),
			'std'       => 0,
			'columns'   => 8,
			'class'     => 'inspiry_switch_inline',
			'tab'       => 'spacing',
		);
		$fields[] = array(
			'name'      => esc_html__( 'Remove Content Area Padding?', 'framework' ),
			'id'        => 'REAL_HOMES_content_area_padding_nil',
			'type'      => 'switch',
			'style'     => 'square',
			'on_label'  => esc_html__( 'Yes', 'framework' ),
			'off_label' => esc_html__( 'No', 'framework' ),
			'std'       => 0,
			'columns'   => 8,
			'class'     => 'inspiry_switch_inline',
			'tab'       => 'spacing',
		);

	} else if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
		$fields[] = array(
			'name' => esc_html__( 'Remove Content Area Padding?', 'framework' ),
			'desc' => esc_html__( 'Yes', 'framework' ),
			'id'   => 'REAL_HOMES_content_area_padding_nil',
			'type' => 'checkbox',
			'std'  => 0,
			'tab'  => 'spacing',
		);
	}
}

