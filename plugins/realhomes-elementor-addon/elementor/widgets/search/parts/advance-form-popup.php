<?php
/**
 * Popup template for search form advance fields
 *
 * @since      2.1.2
 */
global $settings;
global $the_widget_id;
?>
<div class="rhea-search-popup-wrapper" id="rhea-popup-<?php echo esc_attr( $the_widget_id ); ?>">
    <div class="rhea-search-popup">
        <div class="rhea_collapsed_search_fields  rhea_advance_fields_<?php echo esc_attr( $settings['rhea_default_advance_state'] ) ?>">
            <div class="rhea-search-popup-header">
				<?php
				if ( ! empty( $settings['advance_popup_text'] ) ) {
					?>
                    <h3><?php echo esc_html( $settings['advance_popup_text'] ) ?></h3>
					<?php
				}
				?>
                <i class="rhea-popup-close fa fa-times"></i>
            </div>
            <div class="rhea_collapsed_search_fields_inner" id="collapsed-<?php echo esc_attr( $the_widget_id ); ?>"></div>
			<?php
			rhea_get_template_part( 'elementor/widgets/search/fields/property-features' );
			rhea_get_template_part( 'elementor/widgets/search/fields/search-button-popup' );
			?>
        </div>
		<?php
		?>
    </div>
</div>
