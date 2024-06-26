<?php

if ( ! function_exists( 'ere_schedule_metabox_tab' ) ) {
	/**
	 * Add schedule a tour metabox tab to property
	 *
	 * @since 2.0.0
	 *
	 * @param $property_metabox_tabs
	 *
	 * @return array
	 */
	function ere_schedule_metabox_tab( $property_metabox_tabs ) {

		if ( is_array( $property_metabox_tabs ) ) {
			$property_metabox_tabs['schedule-a-tour'] = array(
				'label' => esc_html__( 'Schedule a tour', 'easy-real-estate' ),
				'icon'  => 'dashicons-schedule',
			);
		}

		return $property_metabox_tabs;
	}

	add_filter( 'ere_property_metabox_tabs', 'ere_schedule_metabox_tab', 70 );
}

if ( ! function_exists( 'ere_schedule_metabox_fields' ) ) {
	/**
	 * Add schedule a tour functionality metaboxes fields to property
	 *
	 * @since 2.0.0
	 *
	 * @param $property_metabox_fields
	 *
	 * @return array
	 */
	function ere_schedule_metabox_fields( $property_metabox_fields ) {

		$ere_schedule_fields = array(
			array(
				'name'    => esc_html__( 'Schedule A Tour', 'easy-real-estate' ),
				'id'      => 'ere_property_schedule_tour',
				'type'    => 'select',
				'std'     => 'global',
				'desc'    => esc_html__( 'This setting will be applied only to the properties with the ‘Global’ option set for the related field in their metadata.', 'easy-real-estate' ),
				'options' => array(
					'global' => esc_html__( 'Global', 'easy-real-estate' ),
					'show' => esc_html__( 'Show', 'easy-real-estate' ),
					'hide' => esc_html__( 'Hide', 'easy-real-estate' ),
				),
				'columns' => 3,
				'tab'     => 'schedule-a-tour',
			),
			array(
				'id'      => 'ere_property_schedule_time_slots',
				'name'    => esc_html__( 'Time Slots', 'easy-real-estate' ),
				'desc'    => esc_html__( 'If you want to add property specific times instead of using global options then provide comma (,) separated times. (For example: 12:00 am, 12:15 am, 12:30 am)', 'easy-real-estate' ),
				'type'    => 'textarea',
				'std'     => '',
				'columns' => 9,
				'tab'     => 'schedule-a-tour',
			),
			array(
				'id'      => 'ere_property_schedule_description',
				'name'    => esc_html__( 'Schedule Description', 'easy-real-estate' ),
				'desc'    => esc_html__( 'You can use heading, paragraph, image, and anchor tags.', 'easy-real-estate' ),
				'type'    => 'wysiwyg',
				'std'     => '',
				'columns' => 12,
				'tab'     => 'schedule-a-tour',
			)
		);

		/*
		 * The current tour requests are saved under the meta key "ere_property_scheduled_times"
		 * which is hidden and not being displayed on the front-end of the backend.
		 */

		if ( isset( $_GET['post'] ) && ! empty( $_GET['post'] ) && intval( $_GET['post'] ) && function_exists( 'ere_get_scheduled_times' ) ) {
			$property_id       = $_GET['post'];
			$current_schedules = get_post_meta( $property_id, 'ere_property_scheduled_times', true );
			if ( is_array( $current_schedules ) && ! empty( $current_schedules[0] ) ) {
				$ere_schedule_fields[] = array(
					'id'      => 'ere_property_scheduled_times_list',
					'name'    => esc_html__( 'Scheduled Times', 'easy-real-estate' ),
					'type'    => 'custom_html',
					'std'     => ere_get_scheduled_times( $current_schedules ),
					'columns' => 12,
					'tab'     => 'schedule-a-tour',
				);
			}
		}

		return array_merge( $property_metabox_fields, $ere_schedule_fields );

	}

	add_filter( 'ere_property_metabox_fields', 'ere_schedule_metabox_fields', 70 );
}