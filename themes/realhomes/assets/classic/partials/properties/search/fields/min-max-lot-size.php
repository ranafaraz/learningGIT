<?php

/**
 * Minimum and Maximum Lot Size Fields
 */

$min_lot_size_placeholder = get_option( 'realhomes_min_lot_size_placeholder_text' );
$max_lot_size_placeholder = get_option( 'realhomes_max_lot_size_placeholder_text' );
?>
<div class="option-bar rh-search-field rh_classic_min_lot_size_field small">
    <label for="min-lot-size">
		<?php
		$realhomes_min_lot_size_label = get_option( 'realhomes_min_lot_size_label' );
		echo ! empty( $realhomes_min_lot_size_label ) ? esc_html( $realhomes_min_lot_size_label ) : esc_html__( 'Min Lot Size', 'framework' );
		?>
        <span>
			<?php
			$lot_size_unit = get_option( 'realhomes_lot_size_unit' );
			if ( $lot_size_unit ) {
				echo esc_html( "( " . $lot_size_unit . ")" );
			}
			?>
		</span>
    </label>
    <input type="text" name="min-lot-size" id="min-lot-size" pattern="[0-9]+"
           value="<?php echo isset( $_GET['min-lot-size'] ) ? esc_attr( $_GET['min-lot-size'] ) : ''; ?>"
           placeholder="<?php echo empty( $min_lot_size_placeholder ) ? rh_any_text() : esc_attr( $min_lot_size_placeholder ); ?>"
           title="<?php esc_html_e( 'Only provide digits!', 'framework' ); ?>"/>
</div>

<div class="option-bar rh-search-field rh_classic_max_lot_size_field small">
    <label for="max-lot-size">
		<?php
		$realhomes_max_lot_size_label = get_option( 'realhomes_max_lot_size_label' );
		echo ! empty( $realhomes_max_lot_size_label ) ? esc_html( $realhomes_max_lot_size_label ) : esc_html__( 'Max Lot Size', 'framework' );
		?>
        <span>
			<?php
			if ( $lot_size_unit ) {
				echo esc_html( "(" . $lot_size_unit . ")" );
			}
			?>
		</span>
    </label>
    <input type="text" name="max-lot-size" id="max-lot-size" pattern="[0-9]+"
           value="<?php echo isset( $_GET['max-lot-size'] ) ? esc_attr( $_GET['max-lot-size'] ) : ''; ?>"
           placeholder="<?php echo empty( $max_lot_size_placeholder ) ? rh_any_text() : esc_attr( $max_lot_size_placeholder ); ?>"
           title="<?php esc_html_e( 'Only provide digits!', 'framework' ); ?>"/>
</div>