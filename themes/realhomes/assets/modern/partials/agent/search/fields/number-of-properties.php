<?php
/**
 * Field: Number Of Properties
 *
 * Agent Locations field for agent search form.
 *
 * @since    4.0.0
 * @package  realhomes/modern
 */
$no_of_properties_placeholder_text = get_option( 'realhomes_agent_number_of_properties_placeholder', esc_html__( 'Number of Properties', 'framework' ) );
if ( empty( $no_of_properties_placeholder_text ) ) {
	$no_of_properties_placeholder_text = esc_html__( 'Number of Properties', 'framework' );
}
$no_of_properties_values = get_option( 'realhomes_number_of_properties_values' );
if ( empty( $no_of_properties_values ) ) {
	$no_of_properties_values = '1,2,3,4,5,6,7,8,9,10';
}
?>
<div class="rh_agent_search__option inspiry_bs_default_mod inspiry_bs_agents_listing inspiry_bs_green">
    <span class="rh_agent_search__selectwrap">
		<select name="no-of-properties" id="no-of-properties" class="rh_agent_search__locations inspiry_select_picker_trigger inspiry_select_picker_agent inspiry_select_picker_status show-tick" data-size="5">
            <option value=""><?php echo esc_html( $no_of_properties_placeholder_text ); ?></option>
            <?php
            $no_of_properties_values_arr = explode( ',', $no_of_properties_values );
            foreach ( $no_of_properties_values_arr as $option ) {
	            echo '<option value="' . esc_html( $option ) . '">' . esc_html( $option ) . '</option>';
            }
            ?>
		</select>
	</span>
</div>