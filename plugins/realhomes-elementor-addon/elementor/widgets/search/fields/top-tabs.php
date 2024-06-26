<?php
/**
 *
 * Property taxonomy Tabs for advance property search.
 *
 * @since    0.9.8
 * @package realhomes_elementor_addon
 */

global $settings, $the_widget_id;


global $search_fields_to_display;


if ( is_array( $search_fields_to_display ) ) {

	?>
    <div class="rhea-search-top-tabs-wrapper">
		<?php

		if ( in_array( 'status', $search_fields_to_display ) && 'yes' === $settings['show_status_in_tabs'] ) {

			$field_key           = array_search( 'status', $search_fields_to_display );
			$status_in_tabs      = $settings['show_status_in_tabs'];
			$show_all_tab_status = $settings['show_all_tab_status'];

			$field_key = intval( $field_key ) + 1;
			?>

            <div class="rhea-search-tabs rhea-status-tabs-<?php echo esc_attr( $the_widget_id ); ?>" style="order: <?php echo esc_attr( $field_key ); ?>">
				<?php

				rhea_advance_search_tabs( $settings['default_status_select'], $settings['property_status_placeholder'], 'property-status', 'status[]', $args, '', $show_all_tab_status )
				?>

            </div>
			<?php

		}

		if ( in_array( 'type', $search_fields_to_display ) && 'yes' === $settings['show_types_in_tabs'] ) {

			$field_key = array_search( 'type', $search_fields_to_display );

			$types_in_tabs = $settings['types_in_tabs'];
			$show_all_tab  = $settings['show_all_tab'];

			$field_key = intval( $field_key ) + 1;
			?>

            <div class="rhea-search-tabs " style="order: <?php echo esc_attr( $field_key ); ?>">
				<?php

				rhea_advance_search_tabs( $settings['default_types_select'], $settings['property_types_placeholder'], 'property-type', 'type[]', $args, $types_in_tabs, $show_all_tab )
				?>

            </div>
			<?php

		}

		?>
    </div>
	<?php


}
