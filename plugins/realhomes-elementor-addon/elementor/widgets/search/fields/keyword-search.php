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
        <span class="rhea-text-field-wrapper <?php rhea_add_fields_icon_class( 'enable_keywords_icon', $settings ) ?>">
            <?php rhea_generate_fields_icons( 'keywords_icon', $settings ); ?>
        <input type="text" name="keyword" id="keyword-txt-<?php echo esc_attr( $the_widget_id ); ?>" autocomplete="off"
                value="<?php echo isset( $_GET['keyword'] ) ? esc_attr( $_GET['keyword'] ) : ''; ?>"
                placeholder="<?php if ( ! empty( $settings['keyword_placeholder'] ) ) {
			        echo esc_attr( $settings['keyword_placeholder'] );
		        } else {
			        echo esc_attr__( 'Keyword', 'realhomes-elementor-addon' );
		        } ?>"/>
        </span>

        <!--    <div class="rhea_sfoi_data_fetch_list"></div>-->
        <!--    <span class="rhea_sfoi_ajax_loader">-->
		<?php //include INSPIRY_THEME_DIR . '/images/loader.svg';
		?><!--</span>-->
		<?php

		?>
    </div>
	<?php
}
