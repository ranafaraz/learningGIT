<?php
/**
 * Field: Agency
 *
 * Agency field for the properties Advance Search form widget.
 *
 * @since v3.21.0
 *
 */

global $settings, $the_widget_id;

global $search_fields_to_display;

if ( is_array( $search_fields_to_display ) && in_array( 'agency', $search_fields_to_display ) ) {
	$field_key = array_search( 'agency', $search_fields_to_display );
	$field_key = intval( $field_key ) + 1;

	$separator_class = '';
	if ( isset( $settings['show_fields_separator'] ) && 'yes' === $settings['show_fields_separator'] ) {
		$separator_class = '  rhea-ultra-field-separator  ';
	}
	?>
    <div class="rhea_prop_search__option rhea_prop_search__select rhea_agency_field <?php echo esc_attr( $separator_class ) ?>"
            data-key-position="<?php echo esc_attr( $field_key ); ?>"
            id="agency-<?php echo esc_attr( $the_widget_id ); ?>"
            style="order: <?php echo esc_attr( $field_key ); ?>">

		<?php
		if ( 'yes' === $settings['show_labels'] ) {
			?>
            <label class="rhea_fields_labels" for="select-agency-<?php echo esc_attr( $the_widget_id ); ?>">
				<?php echo ! empty( $settings['agency_label'] ) ? esc_html( $settings['agency_label'] ) : esc_html__( 'Agency', 'realhomes-elementor-addon' ); ?>
            </label>
			<?php
		}

		?>
        <span class="rhea_prop_search__selectwrap <?php rhea_add_fields_icon_class( 'enable_agency_icon', $settings ) ?>">
            <?php rhea_generate_fields_icons( 'agency_icon', $settings ); ?>
            <select name="agencies[]" id="select-agency-<?php echo esc_attr( $the_widget_id ); ?>"
                    class="rhea_multi_select_picker"
                    data-selected-text-format="count > 1"
                    data-size="<?php echo esc_attr( $settings['rhea_dropdown_items_in'] ); ?>"
                <?php if ( 'yes' == $settings['set_multiple_agencies'] ) { ?>
                    multiple
                <?php } ?>

	            <?php if ( 'yes' == $settings['show_select_all_for_agency'] ) { ?>
                    data-actions-box="true"
	            <?php } ?>
                    title="<?php
                    if ( ! empty( $settings['agency_placeholder'] ) ) {
	                    echo esc_attr( $settings['agency_placeholder'] );
                    } else {
	                    esc_attr_e( 'Agencies', 'realhomes-elementor-addon' );
                    } ?>"
                    data-count-selected-text="{0} <?php echo esc_attr( $settings['agency_count_placeholder'] ) ?>">
                    <?php
                    if ( 'no' == $settings['set_multiple_agencies'] ) {
	                    ?>
                        <option value="any">
                        <?php if ( ! empty( $settings['agency_placeholder'] ) ) {
	                        echo esc_html( $settings['agency_placeholder'] );
                        } else {
	                        esc_html_e( 'All Agencies', 'realhomes-elementor-addon' );
                        } ?>
                    </option>
	                    <?php
                    }
                    ?>
	            <?php rhea_search_form_agency_field_options(); ?>
            </select>
	    </span>
    </div>

	<?php
}
