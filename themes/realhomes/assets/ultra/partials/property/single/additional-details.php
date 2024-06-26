<?php
/**
 * Single Property: Additional Details
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

global $post;

ere_additional_details_migration( get_the_ID() ); // Migrate property additional details from old metabox key to new key.
$additional_details = get_post_meta( get_the_ID(), 'REAL_HOMES_additional_details_list', true );

if ( ! empty( $additional_details ) ) {
	$additional_details = array_filter( $additional_details ); // remove empty values.
}

if ( ! empty( $additional_details ) ) {
	?>
    <div class="rh-property-additional-details-wrapper <?php realhomes_printable_section( 'additional-details' ); ?>">
		<?php
		$additional_details_title = get_option( 'theme_additional_details_title' );
		if ( ! empty( $additional_details_title ) ) {
			echo '<h4 class="rh_property__heading rh_property__additional_details">' . esc_html( $additional_details_title ) . '</h4>';
		}

		echo '<ul class="rh_property__additional margin-bottom-40px clearfix">';
		foreach ( $additional_details as $detail ) {
			?>
            <li>
                <span class="title"><?php echo esc_html( $detail[0] ); ?>:</span>
                <span class="value"><?php echo esc_html( $detail[1] ); ?></span>
            </li>
			<?php
		}
		echo '</ul>';
		?>
    </div>
	<?php
}