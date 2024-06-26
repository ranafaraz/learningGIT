<?php
/**
 * Field: Agent Sorting Options
 *
 * Agent Locations field for agent search form.
 *
 * @since    4.0.0
 * @package  realhomes/modern
 */

?>
<div class="rh_agent_search__option inspiry_bs_default_mod inspiry_bs_agents_listing inspiry_bs_green">
    <span class="rh_agent_search__selectwrap">
        <select name="sort-properties" id="sort-properties" class="rh_agent_search__locations inspiry_select_picker_trigger inspiry_bs_default_mod inspiry_bs_agents_listing inspiry_bs_green">
            <?php inspiry_agent_sort_options(); ?>
        </select>
    </span>
</div>