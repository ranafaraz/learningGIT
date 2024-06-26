<?php
/**
 * Field: Agency Name
 *
 * Agency Name field for agent search form.
 *
 * @since    4.0.0
 * @package  realhomes/modern
 */
$keyword_placeholder      = esc_html__( 'Name/Bio', 'framework' );
$keyword_placeholder_text = get_option( 'realhomes_agency_keyword_placeholder', $keyword_placeholder );
if ( empty( $keyword_placeholder_text ) ) {
	$keyword_placeholder_text = $keyword_placeholder;
}
?>
<div class="rh_agency_search__option rh_mod_text_field rh_agent_name_field_wrapper">
    <input type="text" name="agency-txt" id="agency-txt" class="agency-txt" autocomplete="off" value="<?php echo isset( $_GET['agency-txt'] ) ? esc_attr( $_GET['agency-txt'] ) : ''; ?>" placeholder="<?php echo esc_html( $keyword_placeholder_text ); ?>" />
</div>
