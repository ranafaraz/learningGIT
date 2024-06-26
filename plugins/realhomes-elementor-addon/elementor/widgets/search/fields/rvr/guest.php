<?php
/**
 * Field: Guests
 *
 * RVR Guests field for advance property search
 *
 * @package  realhomes_elementor_addon
 * @since    2.1.1
 */
global $settings, $the_widget_id;

global $search_fields_to_display;

if ( is_array( $search_fields_to_display ) && in_array( 'guests', $search_fields_to_display ) ) {

	$field_key               = array_search( 'guests', $search_fields_to_display );
	$field_key               = intval( $field_key ) + 1;
	$guests_placeholder_text = $settings['guests_placeholder'] ?? esc_html__( 'Guests', 'realhomes-elementor-addon' );
	$separator_class         = '';
	if ( isset( $settings['show_fields_separator'] ) && 'yes' === $settings['show_fields_separator'] ) {
		$separator_class = '  rhea-ultra-field-separator  ';
	}
	?>

    <div class="rhea_prop_search__option rhea_prop_search__select rhea_rvr_guests_field <?php echo esc_attr( $separator_class ) ?>" style="order: <?php echo esc_attr( $field_key ); ?>" data-key-position="<?php echo esc_attr( $field_key ); ?>" id="status-<?php echo esc_attr( $the_widget_id ); ?>">
		<?php
		if ( 'yes' === $settings['show_labels'] ) {
			?>
            <label class="rhea_fields_labels" for="select-status-<?php echo esc_attr( $the_widget_id ); ?>">
				<?php echo ! empty( $settings['guests_label'] ) ? esc_html( $settings['guests_label'] ) : esc_html__( 'Guests', 'realhomes-elementor-addon' ); ?>
            </label>
			<?php
		}
		?>
        <span class="rhea_prop_search__selectwrap <?php rhea_add_fields_icon_class( 'enable_guests_icon', $settings ) ?>">
            <?php rhea_generate_fields_icons( 'guests_icon', $settings ); ?>
            <select name="guests" id="select-guests-<?php echo esc_attr( $the_widget_id ); ?>" class="rhea_multi_select_picker show-tick" data-size="<?php echo esc_attr( $settings['rhea_dropdown_items_in'] ); ?>" title="<?php echo esc_attr( $guests_placeholder_text ); ?>">
                <?php
                $min_guests_values = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 );
                $rvr_settings      = get_option( 'rvr_settings' );

                if ( ! empty( $settings['max_guests'] ) ) {
	                $min_guests_values = range( 1, intval( $settings['max_guests'] ) );
                }

                /* check and store searched value if there is any */
                $searched_value = '';
                if ( isset( $_GET['guests'] ) ) {
	                $searched_value = $_GET['guests'];
                }

                /* Add any to select box */
                if ( $searched_value == inspiry_any_value() || empty( $searched_value ) ) {
	                echo '<option value="' . inspiry_any_value() . '" selected="selected">' . esc_html( $guests_placeholder_text ) . '</option>';
                } else {
	                echo '<option value="' . inspiry_any_value() . '">' . esc_html( $guests_placeholder_text ) . '</option>';
                }

                /* loop through min guests values and generate select options */
                if ( ! empty( $min_guests_values ) ) {
	                foreach ( $min_guests_values as $guests_value ) {
		                if ( $searched_value == $guests_value ) {
			                echo '<option value="' . $guests_value . '" selected="selected">' . $guests_value . '</option>';
		                } else {
			                echo '<option value="' . $guests_value . '">' . $guests_value . '</option>';
		                }
	                }
                }
                ?>
            </select>
	    </span>
    </div>
	<?php
}
