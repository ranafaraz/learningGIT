<?php
$property_id        = get_the_ID();
$property_size      = get_post_meta( $property_id, 'REAL_HOMES_property_size', true );
$size_postfix       = get_post_meta( $property_id, 'REAL_HOMES_property_size_postfix', true );
$property_bedrooms  = get_post_meta( $property_id, 'REAL_HOMES_property_bedrooms', true );
$property_bathrooms = get_post_meta( $property_id, 'REAL_HOMES_property_bathrooms', true );
$property_address   = get_post_meta( $property_id, 'REAL_HOMES_property_address', true );
$is_featured        = get_post_meta( $property_id, 'REAL_HOMES_featured', true );
?>
<div class="post-column-wrap">
    <div class="large-column-wrap">
        <div class="column column-thumbnail">
            <figure>
                <a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail( $property_id ) ) {
						the_post_thumbnail( 'modern-property-child-slider' );
					} else {
						inspiry_image_placeholder( 'modern-property-child-slider' );
					}
					?>
                </a>
            </figure>
        </div>
        <div class="column column-info">
            <div class="property-info-wrap">
                <h3 class="property-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="property-excerpt"><?php framework_excerpt( 6 ); ?></p>
                <ul class="property-meta">
					<?php
					$bedrooms_label  = get_option( 'inspiry_bedrooms_field_label' );
					$bathrooms_label = get_option( 'inspiry_bathrooms_field_label' );
					$area_label      = get_option( 'inspiry_area_field_label' );

					if ( ! empty( $property_bedrooms ) ) : ?>
                        <li>
                        <span class="property-meta-label">
                          <?php
                          if ( ! empty( $bedrooms_label ) ) {
	                          echo esc_html( $bedrooms_label );
                          } else {
	                          esc_html_e( 'Bedrooms', 'framework' );
                          }
                          ?>
                        </span>
                            <div class="property-meta-icon">
								<?php realhomes_property_meta_icon( 'REAL_HOMES_property_bedrooms', 'images/icon-bed.svg', '/common/' ); ?>
                                <span class="figure"><?php echo esc_html( $property_bedrooms ); ?></span>
                            </div>
                        </li>
					<?php
					endif;
					if ( ! empty( $property_bathrooms ) ) : ?>
                        <li>
                            <span class="property-meta-label">
                               <?php
                               if ( ! empty( $bathrooms_label ) ) {
	                               echo esc_html( $bathrooms_label );
                               } else {
	                               esc_html_e( 'Bathrooms', 'framework' );
                               }
                               ?>
                            </span>
                            <div class="property-meta-icon">
								<?php realhomes_property_meta_icon( 'REAL_HOMES_property_bathrooms', 'images/icon-shower.svg', '/common/' ); ?>
                                <span class="figure"><?php echo esc_html( $property_bathrooms ); ?></span>
                            </div>
                        </li>
					<?php
					endif;

					if ( ! empty( $property_size ) ) : ?>
                        <li>
                            <span class="property-meta-label">
                                <?php
                                if ( ! empty( $area_label ) ) {
	                                echo esc_html( $area_label );
                                } else {
	                                esc_html_e( 'Area', 'framework' );
                                }
                                ?>
                            </span>
                            <div class="property-meta-icon">
								<?php realhomes_property_meta_icon( 'REAL_HOMES_property_size', 'images/icon-area.svg', '/common/' ); ?>
                                <span class="figure"><?php echo esc_html( $property_size ); ?></span>
								<?php
								if ( ! empty( $size_postfix ) ) : ?>
                                    <span class="property-meta-postfix"><?php echo esc_html( $size_postfix ); ?></span>
								<?php
								endif;
								?>
                            </div>
                        </li>
					<?php
					endif;

					/**
					 * This hook can be used to display more property meta fields
					 */
					do_action( 'realhomes_additional_property_listing_meta_fields', $property_id );
					?>
                </ul>
            </div>
        </div>
    </div>
    <div class="small-column-wrap">
        <div class="column column-date">
            <span class="property-date"><?php echo get_the_date(); ?></span>
        </div>
        <div class="column column-property-status">
            <span class="property-status"><?php echo display_property_status( $property_id ); ?></span>
        </div>
		<?php
		$isp_enabled   = realhomes_is_stripe_payments_enabled(); // RealHomes Stripe Payments enable/disable flag.
		$rpp_enabled   = realhomes_is_paypal_payments_enabled(); // RealHomes PayPal Payments enable/disable flag.
		$rhwpa_enabled = realhomes_is_rhwpa_payments_enabled(); // Property WooCommerce payments settings.

		// Check if PayPal or Stripe payment is enabled.
		if ( $isp_enabled || $rpp_enabled || $rhwpa_enabled ) {

			$currency_sign = '';
			$amount_to_pay = '';
			$stripe_button = '';
			$paypal_button = '';
			$woo_button    = '';

			// Set WC payments data if it's truly enabled.
			if ( $rhwpa_enabled ) {
				$rhwpa_settings = get_option( 'rhwpa_property_payment_settings' );
				$currency_sign  = get_woocommerce_currency();
				$amount_to_pay  = $rhwpa_settings['amount'];
				$woo_button     = true;
			} else {

				// Set PayPal payments data if it's truly enabled.
				if ( $rpp_enabled ) {
					$rpp_settings  = get_option( 'rpp_settings' );
					$currency_sign = $rpp_settings['currency_code'];
					$amount_to_pay = $rpp_settings['payment_amount'];
					$paypal_button = true;
				}

				// Set Stripe payments data if it's truly enabled.
				if ( $isp_enabled ) {
					$isp_settings  = get_option( 'isp_settings' );
					$currency_sign = $isp_settings['currency_code'];
					$amount_to_pay = $isp_settings['amount'];
					$stripe_button = true;
				}
			}

			$individual_payment_enabled = true;
		} else {
			$individual_payment_enabled = false;
		}
		?>
        <div class="column column-status">
			<?php
			$property_statuses = get_post_statuses();
			$property_status   = get_post_status();
			if ( isset( $property_statuses[ $property_status ] ) ) {

				// Subtitue the "Pending Review" status label with "Pending" if individual payment is enabled.
				if ( $individual_payment_enabled && 'Pending Review' === $property_statuses[ $property_status ] ) {
					$property_statuses[ $property_status ] = 'Pending';
				} else if ( 'publish' === $property_status ) {
					$individual_payment_enabled = false;
				}

				printf( '<span class="property-status-tag property-status-tag-%s">%s</span>', esc_html( $property_status ), esc_html( $property_statuses[ $property_status ] ) );
			}
			?><?php
			if ( $is_featured ) {
				printf( '<span class="property-featured-tag">%s</span>', esc_html__( 'Featured', 'framework' ) );
			}
			?>
        </div>
        <div class="column column-price">
			<?php
			if ( $individual_payment_enabled ) {
				$publish_property_note = esc_html__( 'Pay' );
				$publish_property_note .= ' ' . $amount_to_pay . ' ' . $currency_sign . ' ';
				$publish_property_note .= esc_html__( 'to Publish' );
				printf( '<p class="property-price pay-to-publish">%s</p>', esc_html( $publish_property_note ) );
			} else if ( function_exists( 'ere_property_price' ) ) {
				if ( ! empty( ere_get_property_price() ) ) {
					printf( '<p class="property-price">%s</p>', ere_get_property_price() );
				} else {
					printf( '<p class="property-price property-price-not-available"><span class="property-price-text">%s</span> %s</p>', esc_html__( 'Price', 'framework' ), esc_html__( 'Not Available', 'framework' ) );
				}
			}
			?>
            <div class="property-payment-info"><?php
				// Payment Status.
				if ( 'Completed' === get_post_meta( $property_id, 'payment_status', true ) ) {
					echo '<h5>' . esc_html__( 'Payment Completed', 'framework' ) . '</h5>';
				} else {
					if ( ! class_exists( 'Inspiry_Memberships' ) && $individual_payment_enabled ) {

						// WooCommerce Payment Button.
						if ( function_exists( 'rhwpa_property_payment_button' ) && $woo_button ) {
							rhwpa_property_payment_button( $property_id );
						} else {
							// PayPal Payment Button.
							if ( class_exists( 'Realhomes_Paypal_Payments_Public' ) && $paypal_button ) {
								Realhomes_Paypal_Payments_Public::payment_button( $property_id );
							}

							// Stripe Payment Button.
							if ( function_exists( 'isp_stripe_button' ) && $stripe_button ) {
								isp_stripe_button( $property_id );
							}
						}

						/**
						 * This action hook is used to add more payment options
						 * for property submission.
						 *
						 * @since 2.6.4
						 */
						do_action( 'inspiry_property_payments', $property_id );
					} else if ( $individual_payment_enabled ) {
						echo sprintf( esc_html__( '%sNote:%s Deactivate RealHomes Memberships plugin to activate individual payments.', 'framework' ), '<strong>', '</strong>' );
					}
				}
				?></div>
        </div>
    </div>
    <div class="post-actions-wrapper">
		<?php
		global $dashboard_globals;
		if ( 'favorites' === $dashboard_globals['current_module'] ) : ?>
            <strong><?php esc_attr_e( 'Action', 'framework' ); ?></strong><a class="delete" href="#">
                <i class="fas fa-trash"></i>
				<?php esc_html_e( 'Remove from Favorites', 'framework' ); ?>
            </a><span class="confirmation hide">
                <a class="remove-from-favorite" data-property-id="<?php the_ID(); ?>" href="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
                     <i class="fas fa-check confirm-icon"></i>
                    <i class="fas fa-spinner fa-spin loader hide"></i>
                    <?php esc_html_e( 'Confirm', 'framework' ); ?>
                </a>
                <a href="#" class="cancel">
                    <i class="fas fa-times"></i>
                    <?php esc_html_e( 'Cancel', 'framework' ); ?>
                </a>
             </span>
		<?php else : ?>
            <strong><?php esc_attr_e( 'Actions', 'framework' ); ?></strong>
			<?php
			// Preview Property Link
			$preview_link = set_url_scheme( get_permalink( $property_id ) );
			$preview_link = esc_url( apply_filters( 'preview_post_link', add_query_arg( 'preview', 'true', $preview_link ) ) );
			if ( ! empty( $preview_link ) ) :
				?>
                <a class="preview" target="_blank" href="<?php echo esc_url( $preview_link ); ?>">
                    <i class="fas fa-eye"></i>
					<?php esc_html_e( 'View', 'framework' ); ?>
                </a>
			<?php
			endif;

			// Edit Property Link
			$submit_url = '';
			$submit_key = 'id';
			if ( realhomes_get_dashboard_page_url() && realhomes_dashboard_module_enabled( 'inspiry_submit_property_module_display' ) ) {
				$submit_url = realhomes_get_dashboard_page_url( 'properties&submodule=submit-property' );
			}

			if ( ! empty( $submit_url ) ) :
				$edit_link = add_query_arg( $submit_key, $property_id, $submit_url );
				?>
                <a class="edit" href="<?php echo esc_url( $edit_link ); ?>">
                    <i class="fas fa-pencil-alt"></i>
					<?php esc_html_e( 'Edit', 'framework' ); ?>
                </a>
			<?php
			endif;

			// Delete Property Link
			if ( current_user_can( 'delete_posts' ) ) : ?>
                <a class="delete" href="#">
                    <i class="fas fa-trash"></i>
					<?php esc_html_e( 'Delete', 'framework' ); ?>
                </a><span class="confirmation hide">
                    <a class="remove-post" data-post-type="property" data-property-id="<?php the_ID(); ?>" href="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" title="<?php esc_attr_e( 'Remove This Property', 'framework' ); ?>">
                        <i class="fas fa-check confirm-icon"></i>
                        <i class="fas fa-spinner fa-spin loader hide"></i>
                        <?php esc_html_e( 'Confirm', 'framework' ); ?>
                    </a>
                    <a href="#" class="cancel">
                        <i class="fas fa-times"></i>
                        <?php esc_html_e( 'Cancel', 'framework' ); ?>
                    </a>
                </span>
			<?php
			endif;
		endif;
		?>
    </div>
</div>