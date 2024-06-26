<?php
/**
 * Field: Keyword
 *
 * Keyword field for advance property search.
 *
 * @package realhomes_elementor_addon
 * @since    3.0.0
 */
global $settings, $the_widget_id;

global $search_fields_to_display;

if ( is_array( $search_fields_to_display ) && in_array( 'keyword-search', $search_fields_to_display ) ) {
	$field_key = array_search( 'keyword-search', $search_fields_to_display );
	$field_key = intval( $field_key ) + 1;

	$separator_class = '';
	if ( isset( $settings['show_fields_separator'] ) && 'yes' === $settings['show_fields_separator'] ) {
		$separator_class = '  rhea-ultra-field-separator  ';
	}
	?>
    <div class="rhea_prop_search__option rhea_mod_text_field rhea_keyword_field <?php echo esc_attr( $separator_class ) ?>"
            data-key-position="<?php echo esc_attr( $field_key ); ?>"
            id="keyword-search<?php echo esc_attr( $the_widget_id ); ?>"
            style="order: <?php echo esc_attr( $field_key ); ?>">
		<?php
		if ( 'yes' === $settings['show_labels'] ) {
			?>
            <label class="rhea_fields_labels" for="keyword-txt-<?php echo esc_attr( $the_widget_id ); ?>">
				<?php echo ! empty( $settings['keyword_label'] ) ? esc_html( $settings['keyword_label'] ) : esc_html__( 'Keyword', 'realhomes-elementor-addon' ); ?>
            </label>
			<?php
		}
		?>
        <span class="rhea-text-field-wrapper">
            <?php
            if ( 'yes' === $settings['show_keyword_icon'] ) {
	            ?>
                <label for="keyword-txt-<?php echo esc_attr( $the_widget_id ); ?>" class="rhea-field-icon-wrapper ">
	            <?php rhea_safe_include_svg( 'icons/icon-search.svg' ); ?>
                </label>
	            <?php
            }
            ?>
        <input class="rhea-keyword-live" type="text" name="keyword"
                id="keyword-txt-<?php echo esc_attr( $the_widget_id ); ?>" autocomplete="off"
                value="<?php echo isset( $_GET['keyword'] ) ? esc_attr( $_GET['keyword'] ) : ''; ?>"
                placeholder="<?php if ( ! empty( $settings['keyword_placeholder'] ) ) {
			        echo esc_attr( $settings['keyword_placeholder'] );
		        } else {
			        echo esc_attr__( 'Keyword', 'realhomes-elementor-addon' );
		        } ?>"/>
        </span>

		<?php if ( 'yes' === $settings['enable_ajax_search'] ) { ?>
            <div class="rhea-properties-data-list">
            </div>
            <span class="rhea_sfoi_ajax_loader">
            	            <?php rhea_safe_include_svg( 'icons/ultra-loader.svg' ); ?>
        </span>
			<?php
		}
		?>
    </div>
	<?php
}