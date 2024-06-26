<?php
/**
 * Field: Agent
 *
 * Agent field for advance property search.
 *
 * @since 	3.5.0
 * @package realhomes/modern
 */
?>
<div class="rh_prop_search__option rh_prop_search__select rh_agent_field_wrapper inspiry_select_picker_field">
	<label for="select-agent">
		<?php
		$agent_field_label = get_option( 'inspiry_agent_field_label' );
		echo ! empty( $agent_field_label ) ? esc_html( $agent_field_label ) : esc_html__( 'Agent', 'framework' );
		?>
	</label>
	<span class="rh_prop_search__selectwrap">
		<select name="agents[]" id="select-agent" class="inspiry_select_picker_trigger show-tick"
                data-selected-text-format="count > 2"
                data-size="5"
                data-actions-box="true"
                data-live-search="true"
                title="<?php
                $agent_placeholder = get_option( 'inspiry_property_agent_placeholder' );
                if ( ! empty( $agent_placeholder ) ) {
	                echo esc_attr( $agent_placeholder );
                } else {
	                esc_attr_e( 'All Agents', 'framework' );
                } ?>"
                data-count-selected-text="{0} <?php
                $agent_counter_placeholder = get_option('inspiry_property_agent_counter_placeholder');
                if ( ! empty( $agent_counter_placeholder ) ) {
	                echo esc_attr( $agent_counter_placeholder );
                } else {
	                esc_attr_e( 'Agents Selected', 'framework' );
                }
                ?>"
                <?php
                $multiselect_for_agents_field = get_option( 'inspiry_search_form_multiselect_agents', 'yes' );
                if ( 'yes' == $multiselect_for_agents_field ) { ?>
                    multiple
		<?php } ?>>
		<?php inspiry_agents_in_search(); ?>
		</select>
	</span>
</div>
