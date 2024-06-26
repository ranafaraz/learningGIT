<?php
/**
 * Field: Check-In & Check-Out
 *
 * Check-In & Check-Out field for advance property search.
 * @since   2.1.1
 * @package realhomes-elementor-addon
 *
 */

global $settings, $the_widget_id;

global $search_fields_to_display;

if ( is_array( $search_fields_to_display ) && in_array( 'check-in-out', $search_fields_to_display ) ) {

	$field_key = array_search( 'check-in-out', $search_fields_to_display );

	$field_key = intval( $field_key ) + 1;

	$separator_class = '';
	if ( isset( $settings['show_fields_separator'] ) && 'yes' === $settings['show_fields_separator'] ) {
		$separator_class = '  rhea-ultra-field-separator  ';
	}
	if ( 'yes' === $settings['show_single_checkin_checkout_field'] ) {
		$hide_field  = ' rvr-hide-fields ';
		$check_in_id = 'rhea-check-in-single-search-' . $the_widget_id;
	} else {
		$hide_field  = '';
		$check_in_id = 'rhea-check-in-search-' . $the_widget_id;
	}
	?>
    <div class="rhea_prop_search__option rhea_mod_text_field rvr_check_in rh_mod_text_field <?php echo esc_attr( $separator_class ); ?>" style="order: <?php echo esc_attr( $field_key ); ?>" data-key-position="<?php echo esc_attr( $field_key ); ?>">
		<?php
		if ( 'yes' === $settings['show_labels'] ) {
			?>
            <label class="rhea_fields_labels" for="<?php echo esc_attr( $check_in_id ); ?>">
				<?php echo ! empty( $settings['check_in_label'] ) ? esc_html( $settings['check_in_label'] ) : esc_html__( 'Check In', 'realhomes-elementor-addon' ); ?>
            </label>
			<?php
		}

		$checkin_placeholder_text = $settings['check_in_placeholder'];
		if ( empty( $checkin_placeholder_text ) ) {
			$checkin_placeholder_text = rh_any_text();
		}
		?>
        <span class="rhea-text-field-wrapper <?php rhea_add_fields_icon_class( 'enable_check_in_out_icon', $settings ) ?>">
            <?php rhea_generate_fields_icons( 'check_in_out_icon', $settings );
            if ( 'yes' === $settings['show_single_checkin_checkout_field'] ) {
	            if ( ! empty( $_GET['check-in'] ) || ! empty( $_GET['check-out'] ) ) {
		            $single_check_in_value     = ! empty( $_GET['check-in'] ) ? esc_attr( $_GET['check-in'] ) : '';
		            $single_check_out_value    = ! empty( $_GET['check-out'] ) ? esc_attr( $_GET['check-out'] ) : '';
		            $single_check_in_out_value = esc_attr( $single_check_in_value . '  /  ' . $single_check_out_value );
	            } else {
		            $single_check_in_out_value = '';
	            }
	            ?>
                <input class="rhea-single-check-in-search rhea-trigger-calender" type="text" name="" id="<?php echo esc_attr( $check_in_id ); ?>" value="<?php echo esc_attr( $single_check_in_out_value ); ?>" placeholder="<?php echo esc_attr( $checkin_placeholder_text ); ?>" autocomplete="off" />
	            <?php
            }
            ?>
            <input class="rhea-check-in-search rhea-trigger-calender <?php echo esc_attr( $hide_field ) ?>" type="text" name="check-in" id="rhea-check-in-search-<?php echo esc_attr( $the_widget_id ); ?>" value="<?php echo ! empty( $_GET['check-in'] ) ? esc_attr( $_GET['check-in'] ) : ''; ?>" placeholder="<?php echo esc_attr( $checkin_placeholder_text ); ?>" autocomplete="off" />
        </span>
    </div>

    <div class="rhea_prop_search__option rhea_mod_text_field rvr_check_out rh_mod_text_field <?php echo esc_attr( $separator_class . $hide_field ); ?>" style="order: <?php echo esc_attr( $field_key ); ?>" data-key-position="<?php echo esc_attr( $field_key ); ?>">
		<?php
		if ( 'yes' === $settings['show_labels'] ) {
			?>
            <label class="rhea_fields_labels" for="rhea-check-out-search-<?php echo esc_attr( $the_widget_id ); ?>">
				<?php echo ! empty( $settings['check_out_label'] ) ? esc_html( $settings['check_out_label'] ) : esc_html__( 'Check Out', 'realhomes-elementor-addon' ); ?>
            </label>
			<?php
		}
		$checkout_placeholder_text = $settings['check_out_placeholder'];
		if ( empty( $checkout_placeholder_text ) ) {
			$checkout_placeholder_text = rh_any_text();
		}
		?>
        <span class="rhea-text-field-wrapper">
            <input class="rhea-check-out-search" type="text" name="check-out" id="rhea-check-out-search-<?php echo esc_attr( $the_widget_id ); ?>" value="<?php echo ! empty( $_GET['check-out'] ) ? esc_attr( $_GET['check-out'] ) : ''; ?>" placeholder="<?php echo esc_attr( $checkout_placeholder_text ); ?>" autocomplete="off" />
        </span>
    </div>
	<?php

}
?>
