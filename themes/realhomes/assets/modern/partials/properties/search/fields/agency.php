<?php
/**
 * Field: Agency
 *
 * Agency field for advance property search.
 *
 * @since 	3.21.0
 * @package realhomes/modern
 */
?>
<div class="rh_prop_search__option rh_prop_search__select rh_agency_field_wrapper inspiry_select_picker_field">
	<label for="select-agency">
		<?php
		$agency_field_label = get_option( 'realhomes_agency_field_label' );
		echo ! empty( $agency_field_label ) ? esc_html( $agency_field_label ) : esc_html__( 'Agency', 'framework' );
		?>
	</label>
	<span class="rh_prop_search__selectwrap">
		<select name="agencies[]" id="select-agency" class="inspiry_select_picker_trigger show-tick"
                data-selected-text-format="count > 1"
                data-size="5"
                data-actions-box="true"
                data-live-search="true"
                title="<?php
                $agency_placeholder = get_option( 'realhomes_property_agency_placeholder' );
                if ( ! empty( $agency_placeholder ) ) {
	                echo esc_attr( $agency_placeholder );
                } else {
	                esc_attr_e( 'All Agencies', 'framework' );
                } ?>"
                data-count-selected-text="{0} <?php
                $agency_counter_placeholder = get_option('realhomes_property_agency_counter_placeholder');
                if ( ! empty( $agency_counter_placeholder ) ) {
	                echo esc_attr( $agency_counter_placeholder );
                } else {
	                esc_attr_e( 'Agencies Selected', 'framework' );
                }
                ?>"
                <?php
                $multiselect_for_agencies_field = get_option( 'realhomes_search_form_multiselect_agencies', 'yes' );
                if ( 'yes' == $multiselect_for_agencies_field ) {
                    echo 'multiple';
                } ?>>
		    <?php realhomes_agency_options_for_search(); ?>
		</select>
	</span>
</div>