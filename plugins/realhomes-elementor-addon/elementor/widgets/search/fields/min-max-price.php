<?php
/**
 * Field: Price
 *
 * Price field for advance property search.
 *
 * @package  realhomes_elementor_addon
 * @since    3.0.0
 */
global $settings, $the_widget_id;
$inspiry_min_price_label = $settings['min_price_label'];
$inspiry_max_price_label = $settings['max_price_label'];

global $search_fields_to_display;
if ( is_array( $search_fields_to_display ) && in_array( 'min-max-price', $search_fields_to_display ) ) {

	$field_key = array_search( 'min-max-price', $search_fields_to_display );

	$field_key = intval( $field_key ) + 1;

	$separator_class = '';
	if ( isset( $settings['show_fields_separator'] ) && 'yes' === $settings['show_fields_separator'] ) {
		$separator_class = '  rhea-ultra-field-separator  ';
	}
	?>
    <div class="rhea_prop_search__option rhea_prop_search__select price-for-others rhea_min_price_field <?php echo esc_attr( $separator_class ) ?>" data-key-position="<?php echo esc_attr( $field_key ); ?>" style="order: <?php echo esc_attr( $field_key ); ?>">

		<?php if ( 'yes' === $settings['show_labels'] ) { ?>
            <label class="rhea_fields_labels" for="select-min-price-<?php echo esc_attr( $the_widget_id ); ?>">
				<?php echo ! empty( $inspiry_min_price_label ) ? esc_html( $inspiry_min_price_label ) : esc_html__( 'Min Price', 'realhomes-elementor-addon' ); ?>
            </label>
			<?php
		}
		?>
        <span class="rhea_prop_search__selectwrap <?php rhea_add_fields_icon_class( 'enable_min_price_icon', $settings ) ?>">
            <?php rhea_generate_fields_icons( 'min_price_icon', $settings ); ?>
		<select name="min-price" id="select-min-price-<?php echo esc_attr( $the_widget_id ); ?>" class="rhea_multi_select_picker show-tick" data-size="<?php echo esc_attr( $settings['rhea_dropdown_items_in'] ); ?>">
			<?php rhea_min_prices_list( $settings['min_price_placeholder'], $settings['min_price_drop_down_value'] ); ?>
		</select>
	</span>
    </div>

    <div class="rhea_prop_search__option rhea_prop_search__select price-for-others rhea_max_price_field <?php echo esc_attr( $separator_class ) ?>" data-key-position="<?php echo esc_attr( $field_key ); ?>" style="order: <?php echo esc_attr( $field_key ); ?>">

		<?php if ( 'yes' === $settings['show_labels'] ) { ?>
            <label class="rhea_fields_labels" for="select-max-price-<?php echo esc_attr( $the_widget_id ); ?>">
				<?php echo ! empty( $inspiry_max_price_label ) ? esc_html( $inspiry_max_price_label ) : esc_html__( 'Max Price', 'realhomes-elementor-addon' ); ?>
            </label>
			<?php
		}
		?>
        <span class="rhea_prop_search__selectwrap <?php rhea_add_fields_icon_class( 'enable_max_price_icon', $settings ) ?>">
            <?php rhea_generate_fields_icons( 'max_price_icon', $settings ); ?>
		<select name="max-price" id="select-max-price-<?php echo esc_attr( $the_widget_id ); ?>" class="rhea_multi_select_picker show-tick" data-size="<?php echo esc_attr( $settings['rhea_dropdown_items_in'] ); ?>">
			<?php rhea_max_prices_list( $settings['max_price_placeholder'], $settings['max_price_drop_down_value'] ); ?>
		</select>
	</span>
    </div>

	<?php
	/**
	 * Prices for Rent
	 */
	?>
    <div class="rhea_prop_search__option rhea_prop_search__select price-for-rent hide-fields rhea_min_price_field <?php echo esc_attr( $separator_class ) ?>" data-key-position="<?php echo esc_attr( $field_key ); ?>" style="order: <?php echo esc_attr( $field_key ); ?>">
		<?php if ( 'yes' === $settings['show_labels'] ) { ?>
            <label class="rhea_fields_labels" for="select-min-price-for-rent-<?php echo esc_attr( $the_widget_id ); ?>">
				<?php echo ! empty( $inspiry_min_price_label ) ? esc_html( $inspiry_min_price_label ) : esc_html__( 'Min Price', 'realhomes-elementor-addon' ); ?>
            </label>
		<?php } ?>
        <span class="rhea_prop_search__selectwrap <?php rhea_add_fields_icon_class( 'enable_min_price_icon', $settings ) ?>">
            <?php rhea_generate_fields_icons( 'min_price_icon', $settings ); ?>
	    <select name="min-price" id="select-min-price-for-rent-<?php echo esc_attr( $the_widget_id ); ?>" disabled="disabled" class="rhea_multi_select_picker show-tick" data-size="<?php echo esc_attr( $settings['rhea_dropdown_items_in'] ); ?>">
	        <?php rhea_min_prices_for_rent_list( $settings['min_price_placeholder'], $settings['min_rent_price_drop_down_value'] ); ?>
	    </select>
	</span>
    </div>

    <div class="rhea_prop_search__option rhea_prop_search__select price-for-rent hide-fields rhea_max_price_field <?php echo esc_attr( $separator_class ) ?>" data-key-position="<?php echo esc_attr( $field_key ); ?>" style="order: <?php echo esc_attr( $field_key ); ?>">
		<?php if ( 'yes' === $settings['show_labels'] ) { ?>
            <label class="rhea_fields_labels" for="select-max-price-for-rent-<?php echo esc_attr( $the_widget_id ); ?>">
				<?php echo ! empty( $inspiry_max_price_label ) ? esc_html( $inspiry_max_price_label ) : esc_html__( 'Max Price', 'realhomes-elementor-addon' ); ?>
            </label>
		<?php } ?>
        <span class="rhea_prop_search__selectwrap <?php rhea_add_fields_icon_class( 'enable_max_price_icon', $settings ) ?>">
            <?php rhea_generate_fields_icons( 'max_price_icon', $settings ); ?>
	    <select name="max-price" id="select-max-price-for-rent-<?php echo esc_attr( $the_widget_id ); ?>" disabled="disabled" class="rhea_multi_select_picker show-tick" data-size="<?php echo esc_attr( $settings['rhea_dropdown_items_in'] ); ?>">
	        <?php rhea_max_prices_for_rent_list( $settings['max_price_placeholder'], $settings['max_rent_price_drop_down_value'] ); ?>
	    </select>
	</span>
    </div>
	<?php
}
