<?php
/**
 * Field: Agent Locations
 *
 * Agent Locations field for agent search form.
 *
 * @since    4.0.0
 * @package  realhomes/modern
 */
$location_placeholder       = esc_html__( 'Locations', 'framework' );
$locations_placeholder_text = get_option( 'realhomes_agent_locations_placeholder', $location_placeholder );
if ( empty( $locations_placeholder_text ) ) {
	$locations_placeholder_text = $location_placeholder;
}
?>
<div class="rh_agent_search__option inspiry_bs_default_mod inspiry_bs_agents_listing inspiry_bs_green">
    <span class="rh_agent_search__selectwrap">
		<select name="agent-locations" id="agent-locations" class="rh_agent_search__locations inspiry_select_picker_trigger inspiry_select_picker_agent inspiry_select_picker_status show-tick" data-size="5">
            <option value=""><?php echo esc_html( $locations_placeholder_text ); ?></option>
            <?php realhomes_agent_locations_options(); ?>
		</select>
	</span>
</div>