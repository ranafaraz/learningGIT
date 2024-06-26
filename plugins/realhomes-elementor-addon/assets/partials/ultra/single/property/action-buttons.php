<?php
/**
 * Action Buttons for single property widgets.
 *
 * @since      2.1.0
 */

global $settings;
global $post_id;

//Favorite button for single property
if ( 'yes' === $settings['show_favourite_button'] && function_exists( 'inspiry_favorite_button' ) ) {
	inspiry_favorite_button( $post_id, $settings['property_fav_label'], $settings['property_fav_added_label'], '/common/images/icons/ultra-favourite.svg', 'ultra' );
}

//Compare button for single property

if ( function_exists( 'inspiry_add_to_compare_button' ) && 'yes' == $settings['ere_enable_compare_properties'] ) {
	inspiry_add_to_compare_button( $settings['ere_property_compare_label'], $settings['ere_property_compare_added_label'], 'ultra' );
}

//Print button for single property
if ( 'yes' === $settings['show_print_button'] ) {
	$print_tooltip = esc_attr__( 'Print', 'realhomes-elementor-addon' );
	if ( ! empty( $settings['ere_property_print_label'] ) ) {
		$print_tooltip = esc_attr( $settings['ere_property_print_label'] );
	}
	?>
    <a href="javascript:window.print()" class="print rh-ui-tooltip" title="<?php echo esc_attr( $print_tooltip ); ?>">
		<?php inspiry_safe_include_svg( '/icons/print.svg' ); ?>
    </a>
	<?php
}

//Share button for single property
if ( 'yes' === $settings['show_share_button'] ) {
	$share_tooltip = esc_attr__( 'Share', 'realhomes-elementor-addon' );
	if ( ! empty( $settings['ere_property_share_label'] ) ) {
		$share_tooltip = esc_attr( $settings['ere_property_share_label'] );
	}
	?>
    <div class="rh-ultra-share-wrapper">
        <a href="#" class="rh-ultra-share share rh-ui-tooltip" title="<?php echo esc_attr( $share_tooltip ); ?>">
			<?php inspiry_safe_include_svg( '/icons/share.svg' ); ?>
        </a>
        <div class="share-this" data-check-mobile="<?php echo wp_is_mobile() ? esc_attr( 'mobile' ) : ''; ?>" data-property-name="<?php the_title(); ?>" data-property-permalink="<?php the_permalink(); ?>"></div>
    </div>
	<?php
}

// Report button for single property
if ( 'yes' === $settings['show_report_button'] && function_exists( 'realhomes_report_property_modal' ) ) {

    // Report property button label
    $report_property_label = ! empty( $settings['report_property_label'] ) ? $settings['report_property_label'] : esc_attr__( 'Report This Property', 'realhomes-elementor-addon' );

    // Inserting report property modal html with the wp_footer action
	add_action( 'wp_footer', 'realhomes_report_property_modal' );
	?>
    <a class="report-this-property rh-ui-tooltip" href="#report-property-modal-<?php echo esc_attr( $post_id ); ?>" title="<?php echo esc_attr( $report_property_label ); ?>">
        <i class="fas fa-flag"></i>
    </a>
	<?php
}