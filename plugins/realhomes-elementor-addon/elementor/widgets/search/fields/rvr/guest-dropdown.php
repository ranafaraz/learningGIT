<?php
/**
 * Field: Guests
 *
 * RVR Guests field for advance property search
 *
 * @since    2.3.0
 */
global $settings, $the_widget_id;

global $search_fields_to_display;

if ( is_array( $search_fields_to_display ) && in_array( 'guests', $search_fields_to_display ) ) {

	$field_key               = array_search( 'guests', $search_fields_to_display );
	$field_key               = intval( $field_key ) + 1;
	$guests_placeholder_text = $settings['guests_placeholder'] ?? esc_html__( 'Guests', 'realhomes-elementor-addon' );
	$separator_class         = '';
	if ( isset( $settings['show_fields_separator'] ) && 'yes' === $settings['show_fields_separator'] ) {
		$separator_class = '  rhea-ultra-field-separator  ';
	}
	?>

    <div class="rhea_prop_search__option rhea_prop_search__select rhea_rvr_guests_field <?php echo esc_attr( $separator_class ) ?>" style="order: <?php echo esc_attr( $field_key ); ?>" data-key-position="<?php echo esc_attr( $field_key ); ?>" id="status-<?php echo esc_attr( $the_widget_id ); ?>">
		<?php
		if ( 'yes' === $settings['show_labels'] ) {
			?>
            <label class="rhea_fields_labels" for="select-status-<?php echo esc_attr( $the_widget_id ); ?>">
				<?php echo ! empty( $settings['guests_label'] ) ? esc_html( $settings['guests_label'] ) : esc_html__( 'Guests', 'realhomes-elementor-addon' ); ?>
            </label>
			<?php

		}
		$adults_label   = $settings['adults_label'];
		$children_label = $settings['children_label'];
		$infants_label  = $settings['infants_label'];
		?>
        <span class="rhea_prop_search__selectwrap rhea-guests-field-dropdown-box <?php rhea_add_fields_icon_class( 'enable_guests_icon', $settings ) ?>">
            <span class="rhea-guests-field-dropdown guests-field-<?php echo esc_attr( $the_widget_id ) ?>">
                <?php rhea_generate_fields_icons( 'guests_icon', $settings ); ?>
                <span class="adults"><i>1</i> <?php echo esc_html( $adults_label ) ?> </span> &nbsp;-&nbsp; <span class="children"><i></i> <?php echo esc_html( $children_label ) ?> </span> &nbsp;-&nbsp; <span class="infants"><i></i> <?php echo esc_html( $infants_label ) ?> </span>

                 <span class="caret">

                 </span>

            </span>

				<span class="rhea-rvr-guests-fields-wrapper guests-field-wrapper-<?php echo esc_attr( $the_widget_id ) ?>"">

            <!--Adults Field-->
                    <span class="rvr-counter-field">
                        <span class="labels">
                            <span class="title"><?php echo esc_html( $adults_label ) ?></span>
                            <span class="limit"><?php echo esc_html( $settings['adults_age_limit'] ) ?></span>
                        </span>
                        <span class="rhea-guests-number number adults-field">
                            <span class="minus">-</span>
                            <input class="rhea-guests-cat-field" type="text" value="1"/>
                            <span class="plus">+</span>
                        </span>
                    </span>

            <!--Children Field-->
                    <span class="rvr-counter-field">
                        <span class="labels">
                            <span class="title"><?php echo esc_html( $children_label ) ?></span>
                            <span class="limit"><?php echo esc_html( $settings['children_age_limit'] ) ?></span>
                        </span>
                        <span class="rhea-guests-number number children-field">
                            <span class="minus">-</span>
                            <input class="rhea-guests-cat-field" type="text" value="0"/>
                            <span class="plus">+</span>
                        </span>
                    </span>

            <!--Infants Field-->
                    <span class="rvr-counter-field">
                        <span class="labels">
                            <span class="title"><?php echo esc_html( $infants_label ) ?></span>
                            <span class="limit"><?php echo esc_html( $settings['infants_age_limit'] ) ?></span>
                        </span>
                        <span class="rhea-guests-number number infants-field">
                            <span class="minus">-</span>
                            <input class="rhea-guests-cat-field" type="text" value="0"/>
                            <span class="plus">+</span>
                        </span>
                    </span>

				</span>

        </span>
    </div>
	<?php
}
