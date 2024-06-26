<?php
/**
 * Field: Property Features Dropdown
 *
 * Features field for advance property search widget.
 * @since    3.0.0
 */

global $settings, $the_widget_id, $search_fields_to_display;

if ( is_array( $search_fields_to_display ) && in_array( 'property-features-dropdown', $search_fields_to_display ) ) {

	$field_key = array_search( 'property-features-dropdown', $search_fields_to_display );

	$field_key = intval( $field_key ) + 1;

	$separator_class = '';
	if ( isset( $settings['show_fields_separator'] ) && 'yes' === $settings['show_fields_separator'] ) {
		$separator_class = '  rhea-ultra-field-separator  ';
	}
	?>
    <div class="rhea_prop_search__option rhea_prop_search__select rhea_features_field <?php echo esc_attr( $separator_class ) ?>" data-key-position="<?php echo esc_attr( $field_key ); ?>" id="property-features-dropdown-<?php echo esc_attr( $the_widget_id ); ?>" style="order: <?php echo esc_attr( $field_key ); ?>">

		<?php
		if ( 'yes' === $settings['show_labels'] ) {
			?>
            <label class="rhea_fields_labels" for="select-property-features-dropdown-<?php echo esc_attr( $the_widget_id ); ?>">
				<?php echo ! empty( $settings['features_label'] ) ? esc_html( $settings['features_label'] ) : esc_html__( 'Features', 'realhomes-elementor-addon' ); ?>
            </label>
			<?php
		}
		?>
        <span class="rhea_prop_search__selectwrap <?php rhea_add_fields_icon_class( 'enable_features_icon', $settings ) ?>">
            <?php rhea_generate_fields_icons( 'features_icon', $settings ); ?>
            <select name="features[]" id="select-features-<?php echo esc_attr( $the_widget_id ); ?>" class="rhea_multi_select_picker show-tick" data-selected-text-format="count > 2" data-size="<?php echo esc_attr( $settings['rhea_dropdown_items_in'] ); ?>" data-live-search="true"
                <?php
                echo( 'yes' === $settings['set_multiple_features'] ? ' multiple ' : '' );
                echo( 'yes' === $settings['show_select_all_features'] ? ' data-actions-box="true" ' : '' );
                echo( ! empty( $settings['features_placeholder'] ) ? " title=" . esc_attr( $settings['features_placeholder'] ) : " title=" . esc_attr__( 'Features', 'realhomes-elementor-addon' ) );
                ?>
                data-count-selected-text="{0} <?php echo esc_attr( $settings['features_count_placeholder'] ) ?>">
                <?php
                if ( 'no' == $settings['set_multiple_features'] ) {
	                ?>
                    <option value="any">
                        <?php if ( ! empty( $settings['features_placeholder'] ) ) {
	                        echo esc_html( $settings['features_placeholder'] );
                        } else {
	                        esc_html_e( 'All Features', 'realhomes-elementor-addon' );
                        } ?>
                    </option>
	                <?php
                }
                ?>
	            <?php
	            $all_features = get_terms( array( 'taxonomy' => 'property-feature' ) );
	            if ( ! empty( $all_features ) && ! is_wp_error( $all_features ) ) {
		            /* features in search query */
		            $check_feature = array();
		            if ( isset( $_GET['features'] ) ) {
			            $check_feature = $_GET['features'];
		            }

		            foreach ( $all_features as $feature ) {
			            if ( is_array( $check_feature ) && in_array( $feature->slug, $check_feature ) ) {
				            echo '<option value="' . esc_attr( $feature->slug ) . '" selected="selected">' . esc_html( $feature->name ) . '</option>';
			            } else {
				            echo '<option value="' . esc_attr( $feature->slug ) . '">' . esc_html( $feature->name ) . '</option>';
			            }
		            }

	            }
	            ?>
            </select>
	    </span>
    </div>
	<?php
}
