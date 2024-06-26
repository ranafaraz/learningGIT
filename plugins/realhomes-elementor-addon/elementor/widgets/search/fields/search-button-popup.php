<?php
/**
 * Search button for popup advance fields
 *
 * @since      2.1.2
 */
global $settings, $the_widget_id;
$rhea_search_button_position = $settings['rhea_search_button_position'];

if ( 'yes' == $rhea_search_button_position ) {
	$search_button_position_class = 'rhea_search_button_at_bottom';
} else {
	$search_button_position_class = '';
}

$rhea_advance_button_animate= '';
$animate_search_button = '';
if('yes' == $settings['rhea_advance_button_animate']){
	$rhea_advance_button_animate = ' rhea-btn-primary ';
}
if('yes' == $settings['rhea_button_animate']){
	$animate_search_button = ' rhea-btn-primary ';
}
?>
<div class="rhea_search_button_wrapper rhea_button_hide <?php echo esc_attr( $search_button_position_class ); ?>">
	<button class="rhea_search_form_button <?php echo esc_attr($animate_search_button)?>" type="submit">
		<?php include RHEA_ASSETS_DIR . '/icons/icon-search.svg'; ?>
		<span>
                <?php
                $inspiry_search_button_text = $settings['search_button_label'];
                if ( ! empty( $inspiry_search_button_text ) ) {
	                echo esc_html( $inspiry_search_button_text );
                } else {
	                echo esc_html__( 'Search', 'realhomes-elementor-addon' );
                }
                ?>
                    </span>
	</button>
</div>


