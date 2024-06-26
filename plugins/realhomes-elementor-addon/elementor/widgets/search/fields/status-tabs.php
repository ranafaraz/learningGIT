<?php
/**
 * Field: Property Status
 *
 * Property Status field for advance property search.
 *
 * @package realhomes_elementor_addon
 * @since    3.0.0
 */
global $settings, $the_widget_id;

global $search_fields_to_display;

if ( is_array( $search_fields_to_display ) && in_array( 'status', $search_fields_to_display ) ) {

	$field_key = array_search( 'status', $search_fields_to_display );

	$field_key = intval( $field_key ) + 1;

	$separator_class = '';
	if ( isset( $settings['show_fields_separator'] ) && 'yes' === $settings['show_fields_separator'] ) {
		$separator_class = '  rhea-ultra-field-separator  ';
	}
	?>

    <div class="rhea_prop_search__option rhea_prop_search__select rhea_status_field <?php echo esc_attr( $separator_class ) ?> rhea-status-tabs-<?php echo esc_attr( $the_widget_id ); ?>"
            style="order: <?php echo esc_attr( $field_key ); ?>"
            data-key-position="<?php echo esc_attr( $field_key ); ?>"
            id="status-<?php echo esc_attr( $the_widget_id ); ?>">
		<?php
		if ( 'yes' === $settings['show_labels'] ) {
			?>
            <label class="rhea_fields_labels" for="select-status-<?php echo esc_attr( $the_widget_id ); ?>">
				<?php echo ! empty( $settings['property_status_label'] ) ? esc_html( $settings['property_status_label'] ) : esc_html__( 'Property Status', 'realhomes-elementor-addon' ); ?>
            </label>
			<?php
		}
		rhea_ultra_advance_search_tabs( $settings['default_status_select'], $settings['property_status_placeholder'], 'property-status', 'status[]', [], [], $settings['show_all_tab_status'] );
		?>
    </div>
	<?php

}


