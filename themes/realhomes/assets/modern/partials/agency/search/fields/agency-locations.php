<?php
/**
 * Field: Agency Locations
 *
 * Agency Locations field for agency search form.
 *
 * @since    4.0.0
 * @package  realhomes/modern
 */
$location_placeholder       = esc_html__( 'Locations', 'framework' );
$locations_placeholder_text = get_option( 'realhomes_agency_locations_placeholder', $location_placeholder );
if ( empty( $locations_placeholder_text ) ) {
	$locations_placeholder_text = $location_placeholder;
}
?>
<div class="rh_agency_search__option inspiry_bs_default_mod inspiry_bs_agents_listing inspiry_bs_green">
    <span class="rh_agency_search__selectwrap">
		<select name="agency-locations" id="agency-locations" class="rh_agency_search__locations inspiry_select_picker_trigger inspiry_select_picker_agency inspiry_select_picker_status show-tick" data-size="5">
            <option value=""><?php echo esc_html( $locations_placeholder_text ); ?></option>
            <?php realhomes_agency_locations_options(); ?>
		</select>
	</span>
</div>