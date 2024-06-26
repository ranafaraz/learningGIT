<?php
/**
 * Agent Search Form
 *
 * @since      4.0.0
 * @package    realhomes/modern
 */

$realhomes_agent_search = get_option( 'realhomes_agent_search', 'no' );
$agent_form_class       = '';
if ( 'yes' != $realhomes_agent_search ) {
	$agent_form_class = 'sorting_options_only';
}
?>
<form class="rh_agent_search__form rh_agent_search_form_header advance-agent-search-form <?php echo sanitize_html_class( $agent_form_class ); ?>" method="get">
	<?php
	if ( 'yes' === $realhomes_agent_search ) {
		get_template_part( 'assets/modern/partials/agent/search/fields/agent-keyword' );
		get_template_part( 'assets/modern/partials/agent/search/fields/number-of-properties' );
		get_template_part( 'assets/modern/partials/agent/search/fields/agent-locations' );
	}
	if ( 'show' === get_option( 'inspiry_agents_sorting', 'hide' ) ) {
		get_template_part( 'assets/modern/partials/agent/search/fields/agent-sorting-options' );
	}
	?>
</form>

<?php
if ( 'yes' === $realhomes_agent_search ) {
	$verified_agents_placeholder      = esc_html__( 'Verified Agents', 'framework' );
	$verified_agents_placeholder_text = get_option( 'realhomes_agent_verified_placeholder', $verified_agents_placeholder );
	if ( empty( $verified_agents_placeholder_text ) ) {
		$verified_agents_placeholder_text = $verified_agents_placeholder;
	}
	?>
    <div class="verified-agents">
        <label for="verified-agents"><?php echo esc_html( $verified_agents_placeholder_text ) ?></label>
        <input type="checkbox" id="verified-agents" name="verified-agents" value="yes">
    </div>
<?php } ?>