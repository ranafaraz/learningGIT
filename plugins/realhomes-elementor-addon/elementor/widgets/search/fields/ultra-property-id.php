<?php
/**
 * Field: Property ID
 *
 * Property ID field for advance property search.
 *
 * @package realhomes_elementor_addon
 * @since    3.0.0
 */
global $settings, $the_widget_id;

global $search_fields_to_display;
if ( is_array( $search_fields_to_display ) && in_array( 'property-id', $search_fields_to_display ) ) {

	$field_key = array_search( 'property-id', $search_fields_to_display );

	$field_key = intval( $field_key ) + 1;

	$separator_class = '';
	if ( isset( $settings['show_fields_separator'] ) && 'yes' === $settings['show_fields_separator'] ) {
		$separator_class = '  rhea-ultra-field-separator  ';
	}
	?>
    <div class="rhea_prop_search__option rhea_mod_text_field rhea_property_id_field <?php echo esc_attr( $separator_class ) ?>" style="order: <?php echo esc_attr( $field_key ); ?>"
            data-key-position="<?php echo esc_attr( $field_key ); ?>"
            id="property-id-<?php echo esc_attr( $the_widget_id ); ?>">
		<?php
		if ( 'yes' === $settings['show_labels'] ) {
			?>
            <label class="rhea_fields_labels" for="property-id-txt-<?php echo esc_attr( $the_widget_id ); ?>">
				<?php echo ! empty( $settings['property_id_label'] ) ? esc_html( $settings['property_id_label'] ) : esc_html__( 'Property ID', 'realhomes-elementor-addon' ); ?>
            </label>
			<?php
		}
		?>
        <span class="rhea-text-field-wrapper">
            <?php
            if ( 'yes' === $settings['show_tag_icon'] ) {
	            ?>
                <label for="property-id-txt-<?php echo esc_attr( $the_widget_id ); ?>">
                    <?php rhea_safe_include_svg( 'icons/ultra-tag.svg' ); ?>
                </label>
	            <?php
            }
            ?>
        <input type="text" name="property-id" autocomplete="off"
                id="property-id-txt-<?php echo esc_attr( $the_widget_id ); ?>"
                value="<?php echo isset( $_GET['property-id'] ) ? esc_attr( $_GET['property-id'] ) : ''; ?>"
                placeholder="<?php echo esc_attr( $settings['property_id_placeholder'] ) ?>"/>
        </span>
    </div>

	<?php
}