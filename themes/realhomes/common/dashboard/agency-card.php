<?php
/**
 * Manages the display of agency card information in the agencies posts table.
 *
 * This file is responsible for handling the presentation of agency card details
 * within the agencies posts table in the dashboard.
 *
 * @since      4.3.0
 * @package    realhomes
 * @subpackage dashboard
 */

$agency_id           = get_the_ID();
$agency_info         = get_post_custom( $agency_id );
$agency_mobile       = ! empty( $agency_info['REAL_HOMES_mobile_number'][0] ) ? $agency_info['REAL_HOMES_mobile_number'][0] : false;
$agency_whatsapp     = ! empty( $agency_info['REAL_HOMES_whatsapp_number'][0] ) ? $agency_info['REAL_HOMES_whatsapp_number'][0] : false;
$agency_office_phone = ! empty( $agency_info['REAL_HOMES_office_number'][0] ) ? $agency_info['REAL_HOMES_office_number'][0] : false;
$agency_email        = ! empty( $agency_info['REAL_HOMES_agency_email'] [0] ) ? $agency_info['REAL_HOMES_agency_email'][0] : false;
$facebook_url        = ! empty( $agency_info['REAL_HOMES_facebook_url'] [0] ) ? $agency_info['REAL_HOMES_facebook_url'][0] : false;
$twitter_url         = ! empty( $agency_info['REAL_HOMES_twitter_url'] [0] ) ? $agency_info['REAL_HOMES_twitter_url'][0] : false;
$linked_in_url       = ! empty( $agency_info['REAL_HOMES_linked_in_url'] [0] ) ? $agency_info['REAL_HOMES_linked_in_url'][0] : false;
$instagram_url       = ! empty( $agency_info['inspiry_instagram_url'] [0] ) ? $agency_info['inspiry_instagram_url'][0] : false;
$youtube_url         = ! empty( $agency_info['inspiry_youtube_url'] [0] ) ? $agency_info['inspiry_youtube_url'][0] : false;
$pinterest_url       = ! empty( $agency_info['inspiry_pinterest_url'] [0] ) ? $agency_info['inspiry_pinterest_url'][0] : false;
$agency_website      = ! empty( $agency_info['REAL_HOMES_website'] [0] ) ? $agency_info['REAL_HOMES_website'][0] : false;
?>
<div class="post-column-wrap">
    <div class="large-column-wrap">
        <div class="column column-thumbnail">
            <figure class="agency-thumbnail">
                <a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail( $agency_id ) ) {
						the_post_thumbnail( 'agent-image' );
					} else {
						?>
                        <span class="agency-thumb-placeholder"><i class="fas fa-home"></i></span>
						<?php
					}
					?>
                </a>
            </figure>
        </div>
        <div class="column column-info">

            <h3 class="agency-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <div class="agency-details-separator"></div>

            <div class="agency-contacts-list">
				<?php
				if ( $agency_office_phone ) {
					?>
                    <div class="agency-contact-item">
                        <h4 class="agency-contact-item-label"><?php esc_html_e( 'Office', 'framework' ); ?></h4>
                        <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $agency_office_phone ) ); ?>"><?php echo esc_html( $agency_office_phone ); ?></a>
                    </div>
					<?php
				}
				if ( $agency_mobile ) {
					?>
                    <div class="agency-contact-item">
                        <h4 class="agency-contact-item-label"><?php esc_html_e( 'Mobile', 'framework' ); ?></h4>
                        <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $agency_mobile ) ); ?>"><?php echo esc_html( $agency_mobile ); ?></a>
                    </div>
					<?php
				}
				if ( $agency_whatsapp ) {
					?>
                    <div class="agency-contact-item">
                        <h4 class="agency-contact-item-label"><?php esc_html_e( 'WhatsApp', 'framework' ); ?></h4>
                        <a href="https://wa.me/<?php echo esc_attr( str_replace( ' ', '', $agency_whatsapp ) ); ?>"><?php echo esc_html( $agency_whatsapp ); ?></a>
                    </div>
					<?php
				}
				if ( $agency_email ) {
					?>
                    <div class="agency-contact-item">
                        <h4 class="agency-contact-item-label"><?php esc_html_e( 'Email', 'framework' ); ?></h4>
                        <a href="mailto:<?php echo esc_attr( antispambot( $agency_email ) ); ?>"><?php echo esc_html( antispambot( $agency_email ) ); ?></a>
                    </div>
					<?php
				}
				?>
            </div>

			<?php
			if ( $facebook_url || $twitter_url || $linked_in_url || $instagram_url || $youtube_url || $pinterest_url || $agency_website ) {
				?>
                <div class="agency-social-links">
					<?php
					if ( $facebook_url ) {
						?><a class="facebook" target="_blank" href="<?php echo esc_url( $facebook_url ); ?>"><i class="fab fa-facebook fa-lg"></i></a><?php
					}

					if ( $twitter_url ) {
						?><a class="twitter" target="_blank" href="<?php echo esc_url( $twitter_url ); ?>"><i class="fab fa-twitter fa-lg"></i></a><?php
					}

					if ( $linked_in_url ) {
						?><a class="linkedin" target="_blank" href="<?php echo esc_url( $linked_in_url ); ?>"><i class="fab fa-linkedin fa-lg"></i></a><?php
					}

					if ( $instagram_url ) {
						?><a class="instagram" target="_blank" href="<?php echo esc_url( $instagram_url ); ?>"><i class="fab fa-instagram fa-lg"></i></a><?php
					}
					if ( $youtube_url ) {
						?><a class="youtube" target="_blank" href="<?php echo esc_url( $youtube_url ); ?>"><i class="fab fa-youtube-square fa-lg"></i></a><?php
					}

					if ( $pinterest_url ) {
						?><a class="pinterest" target="_blank" href="<?php echo esc_url( $pinterest_url ); ?>"><i class="fab fa-pinterest fa-lg"></i></a><?php
					}

					if ( $agency_website ) {
						?>
                        <a class="website-icon" target="_blank" href="<?php echo esc_url( $agency_website ); ?>"><i class="fas fa-globe fa-lg"></i></a>
						<?php
					}
					?>
                </div>
				<?php
			}
			?>
        </div>
    </div>

    <div class="small-column-wrap">
        <div class="column column-agency-agents-count">
			<?php
			$agents_count = 0;
			if ( function_exists( 'ere_get_agency_agents_count' ) ) {
				$agency_agents_count = ere_get_agency_agents_count( $agency_id );
				if ( ! empty( $agency_agents_count ) ) {
					$agents_count = $agency_agents_count;
				}
			}
			?>
            <span class="agency-agents-count"><?php echo esc_html( $agents_count ); ?></span>
        </div>
        <div class="column column-status">
			<?php
			$post_statuses = get_post_statuses();
			$post_status   = get_post_status( $agency_id );
			if ( isset( $post_statuses[ $post_status ] ) ) {
				if ( 'pending' === $post_status ) {
					$status = esc_html__( 'Pending', 'framework' );;
				} else {
					$status = $post_statuses[ $post_status ];
				}
				printf( '<span class="post-status-tag post-status-tag-%s">%s</span>', esc_attr( $post_status ), esc_attr( $status ) );
			}
			?>
        </div>
        <div class="column column-date">
            <span class="agency-added-date"><?php echo get_the_date(); ?></span>
        </div>
    </div>

    <div class="post-actions-wrapper">
        <strong><?php esc_attr_e( 'Actions', 'framework' ); ?></strong>
		<?php
		// Preview Agency Link
		$preview_link = set_url_scheme( get_permalink( $agency_id ) );
		$preview_link = esc_url( apply_filters( 'preview_post_link', add_query_arg( 'preview', 'true', $preview_link ) ) );
		if ( ! empty( $preview_link ) ) :
			?>
            <a class="preview" target="_blank" href="<?php echo esc_url( $preview_link ); ?>">
                <i class="fas fa-eye"></i>
				<?php esc_html_e( 'View', 'framework' ); ?>
            </a>
		<?php
		endif;

		// Edit Agency Link
		$submit_agent_url = realhomes_get_dashboard_page_url( 'agencies&submodule=submit-agency' );
		if ( ! empty( $submit_agent_url ) ) :
			?>
            <a class="edit" href="<?php echo esc_url( add_query_arg( 'id', $agency_id, $submit_agent_url ) ); ?>">
                <i class="fas fa-pencil-alt"></i>
				<?php esc_html_e( 'Edit', 'framework' ); ?>
            </a>
		<?php
		endif;

		// Delete Agency Link
		if ( current_user_can( 'delete_posts' ) ) : ?>
            <a class="delete">
                <i class="fas fa-trash"></i>
				<?php esc_html_e( 'Delete', 'framework' ); ?>
            </a>
            <span class="confirmation hide">
                <a class="remove-post" data-post-type="agency" data-post-id="<?php the_ID(); ?>" href="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" title="<?php esc_attr_e( 'Remove This Agency', 'framework' ); ?>">
                    <i class="fas fa-check confirm-icon"></i>
                    <i class="fas fa-spinner fa-spin loader hide"></i>
                    <?php esc_html_e( 'Confirm', 'framework' ); ?>
                </a>
                <a class="cancel">
                    <i class="fas fa-times"></i>
                    <?php esc_html_e( 'Cancel', 'framework' ); ?>
                </a>
            </span>
		<?php
		endif;
		?>
    </div>
</div>