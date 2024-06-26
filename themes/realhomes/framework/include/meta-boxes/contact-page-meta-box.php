<?php
$classic_design = ( 'classic' == INSPIRY_DESIGN_VARIATION );
$last_columns   = 12;
$icon_columns   = 6;

$tabs['contact_form'] = array(
	'label' => esc_html__( 'Contact Form', 'framework' ),
	'icon'  => 'dashicons-email',
);

$tabs['map'] = array(
	'label' => esc_html__( 'Contact Map', 'framework' ),
	'icon'  => 'dashicons-location',
);

$tabs['detail'] = array(
	'label' => esc_html__( 'Contact Details', 'framework' ),
	'icon'  => 'dashicons-businessperson',
);

// Contact Map
$fields[] = array(
	'name'    => esc_html__( 'Map', 'framework' ),
	'id'      => 'theme_show_contact_map',
	'type'    => 'radio',
	'std'     => '1',
	'options' => array(
		'1' => esc_html__( 'Show', 'framework' ),
		'0' => esc_html__( 'Hide', 'framework' ),
	),
	'columns' => 12,
	'tab'     => 'map',
);
$fields[] = array(
	'name'    => esc_html__( 'Map Latitude', 'framework' ),
	'desc'    => 'You can use <a href="http://www.latlong.net/" target="_blank">latlong.net</a> OR <a href="http://itouchmap.com/latlong.html" target="_blank">itouchmap.com</a> to get Latitude and longitude of your desired location.',
	'id'      => 'theme_map_lati',
	'type'    => 'text',
	'std'     => '-37.817917',
	'columns' => 6,
	'tab'     => 'map',
);
$fields[] = array(
	'name'    => esc_html__( 'Map Longitude', 'framework' ),
	'id'      => 'theme_map_longi',
	'type'    => 'text',
	'std'     => '144.965065',
	'columns' => 6,
	'tab'     => 'map',
);
$fields[] = array(
	'name'    => esc_html__( 'Map Zoom Level', 'framework' ),
	'desc'    => esc_html__( 'Provide Map Zoom Level.', 'framework' ),
	'id'      => 'theme_map_zoom',
	'type'    => 'text',
	'std'     => '17',
	'columns' => 6,
	'tab'     => 'map',
);

$map_type = inspiry_get_maps_type();
if ( 'google-maps' == $map_type ) {
	$fields[] = array(
		'name'    => esc_html__( 'Map Type', 'framework' ),
		'desc'    => esc_html__( 'Choose Google Map Type', 'framework' ),
		'id'      => 'inspiry_contact_map_type',
		'type'    => 'select',
		'options' => array(
			'global'    => esc_html__( 'Global Default', 'framework' ),
			'roadmap'   => esc_html__( 'RoadMap', 'framework' ),
			'satellite' => esc_html__( 'Satellite', 'framework' ),
			'hybrid'    => esc_html__( 'Hybrid', 'framework' ),
			'terrain'   => esc_html__( 'Terrain', 'framework' ),
		),
		'std'     => 'global',
		'columns' => 6,
		'tab'     => 'map',
	);

	$icon_columns = 12;
}

$fields[] = array(
	'name'             => esc_html__( 'Maps Marker', 'framework' ),
	'desc'             => esc_html__( 'You may upload custom google maps marker for the contact page here. Image size should be around 50px by 50px.', 'framework' ),
	'id'               => 'inspiry_contact_map_icon',
	'type'             => 'image_advanced',
	'max_file_uploads' => 1,
	'columns'          => $icon_columns,
	'tab'              => 'map',
);

if ( 'mapbox' === $map_type ) {
	$fields[] = array(
		'name'       => esc_html__( 'Marker Color', 'framework' ),
		'desc'       => esc_html__( 'Select the marker color if image is not uploaded.', 'framework' ),
		'id'         => 'inspiry_contact_marker_color',
		'type'       => 'color',
		'columns'    => 12,
		'tab'        => 'map',
		'js_options' => array(
			'palettes' => array( '#125', '#459', '#78b', '#ab0', '#de3', '#f0f' )
		)
	);
}

// Contact Details
$fields[] = array(
	'name'    => esc_html__( 'Contact Detail', 'framework' ),
	'id'      => 'theme_show_details',
	'type'    => 'radio',
	'std'     => '1',
	'options' => array(
		'1' => esc_html__( 'Show', 'framework' ),
		'0' => esc_html__( 'Hide', 'framework' ),
	),
	'columns' => 12,
	'tab'     => 'detail',
);

if ( $classic_design ) {
	$fields[] = array(
		'name'    => esc_html__( 'Contact Details Title', 'framework' ),
		'id'      => 'theme_contact_details_title',
		'type'    => 'text',
		'std'     => '',
		'columns' => 6,
		'tab'     => 'detail',
	);

	$last_columns = 6;
}

$fields[] = array(
	'name'    => esc_html__( 'Cell Number', 'framework' ),
	'id'      => 'theme_contact_cell',
	'type'    => 'text',
	'std'     => '',
	'columns' => 6,
	'tab'     => 'detail',
);
$fields[] = array(
	'name'    => esc_html__( 'Phone Number', 'framework' ),
	'id'      => 'theme_contact_phone',
	'type'    => 'text',
	'std'     => '',
	'columns' => 6,
	'tab'     => 'detail',
);
$fields[] = array(
	'name'    => esc_html__( 'Fax Number', 'framework' ),
	'id'      => 'theme_contact_fax',
	'type'    => 'text',
	'std'     => '',
	'columns' => 6,
	'tab'     => 'detail',
);
$fields[] = array(
	'name'    => esc_html__( 'Display Email', 'framework' ),
	'id'      => 'theme_contact_display_email',
	'type'    => 'text',
	'std'     => '',
	'columns' => 6,
	'tab'     => 'detail',
);
$fields[] = array(
	'name'    => esc_html__( 'Contact Address', 'framework' ),
	'id'      => 'theme_contact_address',
	'type'    => 'textarea',
	'std'     => '',
	'columns' => $last_columns,
	'tab'     => 'detail',
);

// Contact Form
$fields[] = array(
	'name'    => esc_html__( 'Contact Form Display', 'framework' ),
	'id'      => 'realhomes_show_contact_form',
	'type'    => 'radio',
	'std'     => 'show',
	'options' => array(
		'show' => esc_html__( 'Show', 'framework' ),
		'hide' => esc_html__( 'Hide', 'framework' ),
	),
	'columns' => 12,
	'tab'     => 'contact_form',
);

if ( $classic_design ) {
	$fields[] = array(
		'name'    => esc_html__( 'Contact Form Heading', 'framework' ),
		'id'      => 'theme_contact_form_heading',
		'type'    => 'text',
		'std'     => '',
		'columns' => 6,
		'tab'     => 'contact_form',
	);
}

$fields[] = array(
	'name'    => esc_html__( 'Name Field Label', 'framework' ),
	'id'      => 'theme_contact_form_name_label',
	'type'    => 'text',
	'std'     => '',
	'columns' => 6,
	'tab'     => 'contact_form',
);
$fields[] = array(
	'name'    => esc_html__( 'Email Field Label', 'framework' ),
	'id'      => 'theme_contact_form_email_label',
	'type'    => 'text',
	'std'     => '',
	'columns' => 6,
	'tab'     => 'contact_form',
);
$fields[] = array(
	'name'    => esc_html__( 'Phone Number Field Label', 'framework' ),
	'id'      => 'theme_contact_form_number_label',
	'type'    => 'text',
	'std'     => '',
	'columns' => 6,
	'tab'     => 'contact_form',
);
$fields[] = array(
	'name'    => esc_html__( 'Message Field Label', 'framework' ),
	'id'      => 'theme_contact_form_message_label',
	'type'    => 'text',
	'std'     => '',
	'columns' => 6,
	'tab'     => 'contact_form',
);
$fields[] = array(
	'name'    => esc_html__( 'Contact Form Email', 'framework' ),
	'desc'    => esc_html__( 'Provide email address that will get messages from contact form.', 'framework' ),
	'id'      => 'theme_contact_email',
	'type'    => 'text',
	'std'     => get_option( 'admin_email' ),
	'columns' => 6,
	'tab'     => 'contact_form',
);
$fields[] = array(
	'name'    => esc_html__( 'Contact Form CC Email', 'framework' ),
	'desc'    => esc_html__( 'You can add multiple comma separated cc email addresses, to get a carbon copy of contact form message.', 'framework' ),
	'id'      => 'theme_contact_cc_email',
	'type'    => 'text',
	'std'     => '',
	'columns' => 6,
	'tab'     => 'contact_form',
);
$fields[] = array(
	'name'    => esc_html__( 'Contact Form BCC Email', 'framework' ),
	'desc'    => esc_html__( 'You can add multiple comma separated bcc email addresses, to get a blind carbon copy of contact form message.', 'framework' ),
	'id'      => 'theme_contact_bcc_email',
	'type'    => 'text',
	'std'     => '',
	'columns' => 6,
	'tab'     => 'contact_form',
);
$fields[] = array(
	'name'    => esc_html__( 'Contact Form Shortcode ( To Replace Default Form )', 'framework' ),
	'desc'    => esc_html__( 'If you want to replace default contact form with a plugin based form then provide its shortcode here.', 'framework' ),
	'id'      => 'inspiry_contact_form_shortcode',
	'type'    => 'text',
	'std'     => '',
	'columns' => 6,
	'tab'     => 'contact_form',
);
$fields[] = array(
	'name'    => esc_html__( 'Select Page For Redirection', 'framework' ),
	'desc'    => esc_html__( 'User will be redirected to the selected page after successful submission of the contact form.', 'framework' ),
	'id'      => 'inspiry_contact_form_success_redirect_page',
	'type'    => 'select',
	'options' => RH_Data::get_pages_array(),
	'std'     => '',
	'columns' => 6,
	'tab'     => 'contact_form',
);
