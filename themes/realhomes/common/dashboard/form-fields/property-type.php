<?php
/**
 * Field: Property Type
 *
 * @since    3.0.0
 */
$property_type_label = get_option( 'realhomes_submit_property_type_label' );
if ( empty( $property_type_label ) ) {
	$property_type_label = esc_html__( 'Type', 'framework' );
}
?>
<p>
    <label for="type"><?php echo esc_html( $property_type_label ); ?></label>
    <select name="type[]"
            id="type"
            class="inspiry_select_picker_trigger show-tick"
            data-size="5"
            data-actions-box="true"
		    <?php
		    $inspiry_search_form_multiselect_types = get_option( 'inspiry_search_form_multiselect_types', 'yes' );
		    if ( 'yes' == $inspiry_search_form_multiselect_types ) {
                ?>
                data-selected-text-format="count > 2"
                multiple="multiple"
                data-count-selected-text="{0} <?php esc_attr_e( ' Types Selected ', 'framework' ); ?>"
                <?php
		    }
		    ?>
            title="<?php esc_attr_e( 'None', 'framework' ); ?>">
		    <?php
		    if ( realhomes_dashboard_edit_property() ) {
			    global $target_property;
			    realhomes_edit_form_hierarchical_options( $target_property->ID, 'property-type' );
		    } else {
                if ( 'no' == $inspiry_search_form_multiselect_types ) {
                    ?><option selected="selected" value="-1"><?php esc_html_e( 'None', 'framework' ); ?></option><?php
                }

                $target_terms = -1;
                if ( isset( $_GET['type'] ) && ! empty( $_GET['type'] ) ) {
                    $target_terms = $_GET['type'];
                }

                if ( class_exists( 'ERE_Data' ) ) {
                    realhomes_id_based_hierarchical_options( ERE_Data::get_hierarchical_property_types(), $target_terms );
                }
		    }
		?>
    </select>
</p>