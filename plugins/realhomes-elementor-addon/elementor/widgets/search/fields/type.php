<?php
/**
 * Field: Property Type
 *
 * Property type field for advance search.
 *
 * @package realhomes_elementor_addon
 * @since    3.0.0
 */
global $settings, $the_widget_id, $search_fields_to_display;

if ( is_array( $search_fields_to_display ) && in_array( 'type', $search_fields_to_display ) ) {

	$field_key = array_search( 'type', $search_fields_to_display );

	$field_key = intval( $field_key ) + 1;

	$separator_class = '';
	if ( isset( $settings['show_fields_separator'] ) && 'yes' === $settings['show_fields_separator'] ) {
		$separator_class = '  rhea-ultra-field-separator  ';
	}
	?>

    <div class="rhea_prop_search__option rhea_prop_search__select rhea_types_field <?php echo esc_attr( $separator_class ) ?>"
            data-key-position="<?php echo esc_attr( $field_key ); ?>"
            id="type-<?php echo esc_attr( $the_widget_id ); ?>" style="order: <?php echo esc_attr( $field_key ); ?>">

		<?php
		if ( 'yes' === $settings['show_labels'] ) {
			?>
            <label class="rhea_fields_labels" for="select-type-<?php echo esc_attr( $the_widget_id ); ?>">
				<?php echo ! empty( $settings['property_types_label'] ) ? esc_html( $settings['property_types_label'] ) : esc_html__( 'Property Type', 'realhomes-elementor-addon' ); ?>
            </label>
			<?php
		}
		?>
        <span class="rhea_prop_search__selectwrap <?php rhea_add_fields_icon_class( 'enable_type_icon', $settings ) ?>">
            <?php rhea_generate_fields_icons( 'type_icon', $settings ); ?>
		<select name="type[]" id="select-type-<?php echo esc_attr( $the_widget_id ); ?>"
                class="rhea_multi_select_picker show-tick"
                data-selected-text-format="count > 2"
                data-live-search="true"
                data-size="<?php echo esc_attr( $settings['rhea_dropdown_items_in'] ); ?>"
                <?php if ( 'yes' == $settings['set_multiple_types'] ) { ?>
                    multiple
                <?php } ?>
			<?php if ( 'yes' == $settings['show_types_select_all'] ) { ?>
                data-actions-box="true"
			<?php } ?>
                title="<?php
                if ( ! empty( $settings['property_types_placeholder'] ) ) {
	                echo esc_attr( $settings['property_types_placeholder'] );
                } else {
	                esc_attr_e( 'All Types', 'realhomes-elementor-addon' );
                } ?>"
                data-count-selected-text="{0} <?php echo esc_attr( $settings['types_count_placeholder'] ); ?>"
        >

            <?php
            if ( 'yes' !== $settings['set_multiple_types'] ) {
	            ?>
                <option value="any">
                    <?php if ( ! empty( $settings['property_types_placeholder'] ) ) {
	                    echo esc_html( $settings['property_types_placeholder'] );
                    } else {
	                    esc_html_e( 'All Types', 'realhomes-elementor-addon' );
                    } ?>
                </option>
	            <?php
            }
            ?>
			<?php
			if ( function_exists( 'realhomes_hierarchical_options' ) ) {
				realhomes_hierarchical_options( 'property-type' );
			}
			?>
		</select>
	</span>
    </div>
	<?php

}


