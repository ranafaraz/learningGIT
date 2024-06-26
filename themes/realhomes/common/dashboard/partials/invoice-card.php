<?php
/**
 * Dashboard: Invoice Card
 *
 * @since      4.3.0
 * @subpackage dashboard
 * @package    realhomes
 */

$invoice_id    = get_the_ID();
$invoice_title = get_the_title();
$invoice_meta  = get_post_custom( $invoice_id );

$not_available = esc_html__( 'NA', 'framework' );

$transaction_id  = isset( $invoice_meta['transaction_id'] ) ? esc_attr( $invoice_meta['transaction_id'][0] ) : $not_available;
$payment_date    = isset( $invoice_meta['payment_date'] ) ? date( "M d, Y, g:i a", strtotime( $invoice_meta['payment_date'][0] ) ) : $not_available;
$payment_method  = isset( $invoice_meta['payment_method'] ) ? esc_attr( $invoice_meta['payment_method'][0] ) : $not_available;
$payer_email     = isset( $invoice_meta['payer_email'] ) ? esc_attr( $invoice_meta['payer_email'][0] ) : $not_available;
$first_name      = isset( $invoice_meta['first_name'] ) ? esc_attr( $invoice_meta['first_name'][0] ) : '';
$last_name       = isset( $invoice_meta['last_name'] ) ? esc_attr( $invoice_meta['last_name'][0] ) : '';
$payment_status  = isset( $invoice_meta['payment_status'] ) ? esc_attr( $invoice_meta['payment_status'][0] ) : $not_available;
$payment_amount  = isset( $invoice_meta['payment_amount'] ) ? esc_attr( $invoice_meta['payment_amount'][0] ) : 0;
$amount_currency = isset( $invoice_meta['amount_currency'] ) ? esc_attr( $invoice_meta['amount_currency'][0] ) : $not_available;
$booking_id      = $invoice_meta['booking_id'][0];

$booking_meta  = get_post_custom( $booking_id );
$renter_mobile = isset( $booking_meta['rvr_renter_phone'] ) ? esc_attr( $booking_meta['rvr_renter_phone'][0] ) : '';
?>
<div class="post-column-wrap">
    <div class="small-column-wrap">
        <div class="column column-info">
			<?php echo esc_html( $invoice_title ); ?>
        </div>
        <div class="column column-payment-by">
			<?php
			echo esc_html( $first_name . ' ' . $last_name );
			?>
        </div>
        <div class="column column-payment-amount">
			<?php echo ere_format_amount( floatval( $payment_amount ) ); ?>
        </div>
        <div class="column column-payment-method">
			<?php
			echo esc_html( ucfirst( $payment_method ) );
			?>
        </div>
        <div class="column column-payment-status">
			<?php echo esc_html( $payment_status ); ?>
        </div>
        <div class="column column-payment-date">
			<?php echo esc_html( $payment_date ); ?>
        </div>
        <div class="column"></div>
    </div>

    <div class="post-actions-wrapper">
        <a class="delete" href="#">
            <i class="fas fa-trash"></i>
			<?php esc_html_e( 'Delete', 'framework' ); ?>
        </a>
        <span class="confirmation hide">
            <a class="remove-post" data-post-type="invoice" data-post-id="<?php the_ID(); ?>" href="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" title="<?php esc_attr_e( 'Remove This Invoice', 'framework' ); ?>">
                <i class="fas fa-check confirm-icon"></i>
                <i class="fas fa-spinner fa-spin loader hide"></i>
                <?php esc_html_e( 'Confirm', 'framework' ); ?>
            </a>
            <a href="#" class="cancel">
                <i class="fas fa-times"></i>
                <?php esc_html_e( 'Cancel', 'framework' ); ?>
            </a>
        </span>
    </div>

    <div class="rvr-invoice-details-wrapper">
        <div class="rvr-invoice-details">

            <div class="rvr-print-invoice">
				<?php inspiry_safe_include_svg( '/images/icons/icon-printer.svg' ); ?>
            </div>

            <div class="rvr-invoice-header">
                <div class="invoice-to">
                    <h4><?php esc_html_e( 'Invoice:', 'framework' ); ?> <span><?php echo esc_html( $invoice_title ) ?></span></h4>
                    <ul>
                        <li><?php echo esc_html( $first_name . ' ' . $last_name ); ?></li>
                        <li><?php echo sanitize_email( $payer_email ); ?></li>
                        <li><?php echo esc_html( $renter_mobile ); ?></li>
                    </ul>
                </div>
                <div class="invoice-info">
                    <ul>
                        <li><strong><?php esc_html_e( 'Date', 'framework' ); ?></strong><span><?php echo esc_html( $payment_date ); ?></span></li>
                        <li><strong><?php esc_html_e( 'Booking ID #', 'framework' ); ?></strong><span><?php echo get_the_title( $booking_id ); ?></span></li>
                        <li><strong><?php esc_html_e( 'Payment Method', 'framework' ); ?></strong><span><?php echo esc_html( ucfirst( $payment_method ) ); ?></span></li>
                    </ul>
                </div>
            </div>

            <div class="rvr-invoice-contents">
                <table>
                    <tr class="invoice-table-heading">
                        <th><?php esc_html_e( 'Description', 'framework' ); ?></th>
                        <th><?php esc_html_e( 'Amount', 'framework' ); ?></th>
                        <th><?php esc_html_e( 'Detail', 'framework' ); ?></th>
                    </tr>
                    <tr>
                        <td><?php esc_html_e( 'Staying Nights', 'framework' ); ?></td>
                        <td><?php echo ere_format_amount( $booking_meta['rvr_price_staying_nights'][0] ); ?></td>
                        <td><?php printf( esc_html__( '%s x %s' ), $booking_meta['rvr_staying_nights'][0], ere_format_amount( $booking_meta['rvr_price_per_night'][0] ) ); ?></td>
                    </tr>
					<?php
					if ( ! empty( $booking_meta['rvr_extra_guests'] ) && ! empty( $booking_meta['rvr_extra_guests_cost'] ) ) {
						?>
                        <tr>
                            <td><?php esc_html_e( 'Extra Guest Charges', 'framework' ); ?></td>
                            <td><?php echo ere_format_amount( $booking_meta['rvr_extra_guests_cost'][0] ); ?></td>
                            <td><?php printf( '%s x %s', esc_html( $booking_meta['rvr_extra_guests'][0] ), ere_format_amount( floatval( $booking_meta['rvr_extra_guests_cost'][0] ) / intval( $booking_meta['rvr_extra_guests'][0] ) ) ); ?></td>
                        </tr>
						<?php
					}

					// Display additional amenities details.
					$additional_amenities = rwmb_meta( 'rvr_additional_amenities_paid', '', $booking_id );
					if ( ! empty( $additional_amenities ) && is_array( $additional_amenities ) ) {
						foreach ( $additional_amenities as $amenity_label => $amenity_amount ) {
							if ( ! empty( $amenity_amount ) ) {
								?>
                                <tr>
                                    <td><?php echo esc_html( $amenity_label ); ?></td>
                                    <td><?php echo ere_format_amount( floatval( $amenity_amount ) ); ?></td>
                                </tr>
								<?php
							}
						}
					}

					// Display additional fees details.
					$additional_fees = rwmb_meta( 'rvr_additional_fees_paid', '', $booking_id );
					if ( ! empty( $additional_fees ) && is_array( $additional_fees ) ) {
						foreach ( $additional_fees as $fee_label => $fee_amount ) {
							if ( ! empty( $fee_amount ) ) {
								?>
                                <tr>
                                    <td><?php echo esc_html( $fee_label ); ?></td>
                                    <td><?php echo ere_format_amount( floatval( str_replace( '$', '', $fee_amount ) ) ); // String replacement used to support old saved prices with $. ?></td>
                                </tr>
								<?php
							}
						}
					}

					if ( ! empty( $booking_meta['rvr_services_charges'] ) ) {
						?>
                        <tr>
                            <td><?php esc_html_e( 'Service Charges', 'framework' ); ?></td>
                            <td><?php echo ere_format_amount( $booking_meta['rvr_services_charges'][0] ); ?></td>
                        </tr>
						<?php
					}
					?>

                </table>

				<?php
				$subtotal = isset( $booking_meta['rvr_subtotal_price'] ) ? esc_attr( $booking_meta['rvr_subtotal_price'][0] ) : '';
				$govt_tax = isset( $booking_meta['rvr_govt_tax'] ) ? esc_attr( $booking_meta['rvr_govt_tax'][0] ) : 0;
				$total    = isset( $booking_meta['rvr_total_price'] ) ? esc_attr( $booking_meta['rvr_total_price'][0] ) : '';
				?>
                <div class="invoice-total">
                    <div class="invoice-payment-status"></div>
                    <div class="invoice-total-detail">
                        <ul>
                            <li><strong><?php esc_html_e( 'Subtotal', 'framework' ); ?></strong><span><?php echo ere_format_amount( floatval( $subtotal ) ); ?></span></li>
                            <li><strong><?php esc_html_e( 'Govt. Tax', 'framework' ); ?></strong><span><?php echo ere_format_amount( floatval( $govt_tax ) ); ?></span></li>
                            <li class="invoice-total"><strong><?php esc_html_e( 'Total', 'framework' ); ?></strong><span><?php echo ere_format_amount( floatval( $total ) ); ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div><!--- .rvr-invoice-details --->
    </div><!--- .rvr-invoice-details-wrapper --->

</div><!--- .post-column-wrap --->