<?php
/**
 * Add gallery metabox tab to property
 *
 * @param $property_metabox_tabs
 *
 * @return array
 */
function ere_gallery_metabox_tab( $property_metabox_tabs ) {
	if ( is_array( $property_metabox_tabs ) ) {
		$property_metabox_tabs['gallery'] = array(
			'label' => esc_html__( 'Gallery Images', 'easy-real-estate' ),
			'icon'  => 'dashicons-format-gallery',
		);
	}

	return $property_metabox_tabs;
}

add_filter( 'ere_property_metabox_tabs', 'ere_gallery_metabox_tab', 30 );


/**
 * Add gallery metaboxes fields to property
 *
 * @param $property_metabox_fields
 *
 * @return array
 */
function ere_gallery_metabox_fields( $property_metabox_fields ) {

	$REAL_HOMES_gallery_slider = array();

	/* property gallery slider options */
	if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
		$REAL_HOMES_gallery_slider['thumb-on-right']  = esc_html__( 'Gallery with Thumbnails on Right', 'easy-real-estate' );
		$REAL_HOMES_gallery_slider['thumb-on-bottom'] = esc_html__( 'Gallery with Thumbnails on Bottom', 'easy-real-estate' );
	}

	if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
		$REAL_HOMES_gallery_slider['thumb-on-right']    = esc_html__( 'Default Gallery', 'easy-real-estate' );
		$REAL_HOMES_gallery_slider['thumb-on-bottom']   = esc_html__( 'Gallery with Thumbnails', 'easy-real-estate' );
		$REAL_HOMES_gallery_slider['img-pagination']    = esc_html__( 'Gallery with Thumbnails Two', 'easy-real-estate' );
		$REAL_HOMES_gallery_slider['masonry-style']     = esc_html__( 'Masonry', 'easy-real-estate' );
		$REAL_HOMES_gallery_slider['carousel-style']    = esc_html__( 'Carousel', 'easy-real-estate' );
		$REAL_HOMES_gallery_slider['fw-carousel-style'] = esc_html__( 'Full Width Carousel', 'easy-real-estate' );
	}

	if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
		$REAL_HOMES_gallery_slider['masonry-style']  = esc_html__( 'Masonry', 'easy-real-estate' );
		$REAL_HOMES_gallery_slider['carousel-style'] = esc_html__( 'Carousel', 'easy-real-estate' );
	}

	/* Gallery Description and Type based on designs */
	$gallery_type_desc    = esc_html__( 'It allows you to specify a gallery type specifically for the current property, overriding the default settings found in Appearance > Customize > Property Detail Page > Gallery > Gallery Type.', 'easy-real-estate' );
	$default_gallery_type = 'thumb-on-right';

	if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
		$gallery_type_desc    = esc_html__( 'It enables you to specify a custom gallery type exclusively for the current property in Ultra: Single Property Gallery Elementor Widget.', 'easy-real-estate' );
		$default_gallery_type = 'carousel-style';
	}

	$ere_gallery_fields = array(
		array(
			'name'             => esc_html__( 'Property Gallery Images', 'easy-real-estate' ),
			'id'               => "REAL_HOMES_property_images",
			'desc'             => ere_property_gallery_meta_desc(),
			'type'             => 'image_advanced',
			'max_file_uploads' => apply_filters('ere_property_max_gallery_images', 48),
			'columns'          => 12,
			'tab'              => 'gallery',
		),
		array(
			'name'      => esc_html__( 'Change Gallery Type', 'easy-real-estate' ),
			'desc'      => $gallery_type_desc,
			'id'        => "REAL_HOMES_change_gallery_slider_type",
			'type'      => 'switch',
			'style'     => 'square',
			'on_label'  => esc_html__( 'Yes', 'easy-real-estate' ),
			'off_label' => esc_html__( 'No', 'easy-real-estate' ),
			'std'       => 0,
			'columns'   => 12,
			'tab'       => 'gallery',
		),
		array(
			'name'    => esc_html__( 'Gallery Type You Want to Use', 'easy-real-estate' ),
			'id'      => "REAL_HOMES_gallery_slider_type",
			'type'    => 'select',
			'std'     => $default_gallery_type,
			'options' => $REAL_HOMES_gallery_slider,
			'inline'  => false,
			'visible' => array( 'REAL_HOMES_change_gallery_slider_type', '=', '1' ),
			'columns' => 12,
			'tab'     => 'gallery',
		),
	);

	return array_merge( $property_metabox_fields, $ere_gallery_fields );

}

add_filter( 'ere_property_metabox_fields', 'ere_gallery_metabox_fields', 30 );
