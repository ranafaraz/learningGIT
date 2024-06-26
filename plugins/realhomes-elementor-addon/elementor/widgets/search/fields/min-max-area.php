<?php
/**
 * Field: Property Area
 *
 * Area field for advance property search.
 *
 * @package realhomes_elementor_addon
 * @since    3.0.0
 */
global $settings, $the_widget_id;

global $search_fields_to_display;
if ( is_array( $search_fields_to_display ) && in_array( 'min-max-area', $search_fields_to_display ) ) {

	$field_key = array_search( 'min-max-area', $search_fields_to_display );

	$field_key = intval( $field_key ) + 1;

	$separator_class = '';
	if ( isset( $settings['show_fields_separator'] ) && 'yes' === $settings['show_fields_separator'] ) {
		$separator_class = '  rhea-ultra-field-separator  ';
	}
	?>
    <div class="rhea_prop_search__option rhea_mod_text_field rhea_min_area_field <?php echo esc_attr( $separator_class ) ?>"
            data-key-position="<?php echo esc_attr( $field_key ); ?>"
            style="order: <?php echo esc_attr( $field_key ); ?>">

		<?php
		if ( 'yes' === $settings['show_labels'] ) {

			?>
            <label class="rhea_fields_labels" for="min-area-<?php echo esc_attr( $the_widget_id ); ?>">
                <span class="label">
                    <?php echo ! empty( $settings['min_area_label'] ) ? esc_html( $settings['min_area_label'] ) : esc_html__( 'Min Area', 'realhomes-elementor-addon' ); ?>
                </span>
				<?php
				if ( ! empty( $settings['area_units_placeholder'] ) ) {
					?>
                    <span class="unit"><?php echo esc_html( $settings['area_units_placeholder'] ); ?></span>
					<?php
				}
				?>
            </label>
			<?php
		}
		?>
        <span class="rhea-text-field-wrapper <?php rhea_add_fields_icon_class( 'enable_min_area_icon', $settings ) ?>">
            <?php rhea_generate_fields_icons( 'min_area_icon', $settings ); ?>
        <input type="text" autocomplete="off" name="min-area" id="min-area-<?php echo esc_attr( $the_widget_id ); ?>"
                pattern="[0-9]+"
                value="<?php echo isset( $_GET['min-area'] ) ? esc_attr( $_GET['min-area'] ) : ''; ?>"
                placeholder="<?php echo esc_attr( $settings['min_area_placeholder'] ); ?>"

			<?php if ( ! empty( $settings['area_units_title_attr'] ) ) { ?>
                title="<?php echo esc_attr( $settings['area_units_title_attr'] ); ?>"
			<?php } ?>
        />
            </span>
    </div>

    <div class="rhea_prop_search__option rhea_mod_text_field rhea_max_area_field <?php echo esc_attr( $separator_class ) ?>"
            data-key-position="<?php echo esc_attr( $field_key + .1 ); ?>"
            style="order: <?php echo esc_attr( $field_key ); ?>">
		<?php
		if ( 'yes' === $settings['show_labels'] ) {
			?>
            <label class="rhea_fields_labels" for="max-area-<?php echo esc_attr( $the_widget_id ); ?>">
                <span class="label">
                    <?php echo ! empty( $settings['max_area_label'] ) ? esc_html( $settings['max_area_label'] ) : esc_html__( 'Max Area', 'realhomes-elementor-addon' ); ?>
                </span>
				<?php
				if ( ! empty( $settings['area_units_placeholder'] ) ) {
					?>
                    <span class="unit"><?php echo esc_html( $settings['area_units_placeholder'] ); ?></span>
					<?php
				}
				?>
            </label>
			<?php
		}
		?>
        <span class="rhea-text-field-wrapper <?php rhea_add_fields_icon_class( 'enable_max_area_icon', $settings ) ?>">
            <?php rhea_generate_fields_icons( 'max_area_icon', $settings ); ?>
        <input type="text" autocomplete="off" name="max-area" id="max-area-<?php echo esc_attr( $the_widget_id ); ?>"
                pattern="[0-9]+"
                value="<?php echo isset( $_GET['max-area'] ) ? esc_attr( $_GET['max-area'] ) : ''; ?>"
                placeholder="<?php echo esc_attr( $settings['max_area_placeholder'] ); ?>"
			<?php if ( ! empty( $settings['area_units_title_attr'] ) ) { ?>
                title="<?php echo esc_attr( $settings['area_units_title_attr'] ); ?>"
			<?php } ?>
        />
        </span>
    </div>

	<?php
}
