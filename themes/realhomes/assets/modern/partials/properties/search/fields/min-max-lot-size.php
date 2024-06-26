<?php

/**
 * Field: Property Lot Size
 *
 * Lot Size field for advance property search.
 *
 * @since    3.19.0
 * @package realhomes/modern
 */

$lot_size_unit            = get_option( 'realhomes_lot_size_unit' );
$min_lot_size_placeholder = get_option( 'realhomes_min_lot_size_placeholder_text' );
$max_lot_size_placeholder = get_option( 'realhomes_max_lot_size_placeholder_text' );
?>
<div class="rh_prop_search__option rh_mod_text_field rh_min_lot_size_field_wrapper">
    <label for="min-lot-size">
		<span class="label">
			<?php
			$realhomes_min_lot_size_label = get_option( 'realhomes_min_lot_size_label' );
			if ( $realhomes_min_lot_size_label ) {
				echo esc_html( $realhomes_min_lot_size_label );
			} else {
				esc_html_e( 'Min Lot Size', 'framework' );
			}
			?>
		</span>
        <span class="unit">
			<?php
			if ( $lot_size_unit ) {
				echo esc_html( "(" . $lot_size_unit . ")" );
			}
			?>
		</span>
    </label>
    <input type="text" autocomplete="off" name="min-lot-size" id="min-lot-size" pattern="[0-9]+"
           value="<?php echo isset( $_GET['min-lot-size'] ) ? esc_attr( $_GET['min-lot-size'] ) : ''; ?>"
           placeholder="<?php echo empty( $min_lot_size_placeholder ) ? esc_attr( rh_any_text() ) : esc_attr( $min_lot_size_placeholder ); ?>"
           title="<?php esc_attr_e( 'Only provide digits!', 'framework' ); ?>"/>
</div>

<div class="rh_prop_search__option rh_mod_text_field rh_max_lot_size_field_wrapper">
    <label for="max-lot-size">
		<span class="label">
			<?php
			$realhomes_max_lot_size_label = get_option( 'realhomes_max_lot_size_label' );
			if ( $realhomes_max_lot_size_label ) {
				echo esc_html( $realhomes_max_lot_size_label );
			} else {
				esc_html_e( 'Max Lot Size', 'framework' );
			}
			?>
		</span>
        <span class="unit">
			<?php
			if ( $lot_size_unit ) {
				echo esc_html( "(" . $lot_size_unit . ")" );
			}
			?>
		</span>
    </label>
    <input type="text" autocomplete="off" name="max-lot-size" id="max-lot-size" pattern="[0-9]+"
           value="<?php echo isset( $_GET['max-lot-size'] ) ? esc_attr( $_GET['max-lot-size'] ) : ''; ?>"
           placeholder="<?php echo empty( $max_lot_size_placeholder ) ? esc_attr( rh_any_text() ) : esc_attr( $max_lot_size_placeholder ); ?>"
           title="<?php esc_attr_e( 'Only provide digits!', 'framework' ); ?>"/>
</div>