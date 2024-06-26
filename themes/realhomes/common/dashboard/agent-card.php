<?php
/**
 * Manages the display of agent card information in the agents posts table.
 *
 * This file is responsible for handling the presentation of agent card details
 * within the agents posts table in the dashboard.
 *
 * @since      4.3.0
 * @package    realhomes
 * @subpackage dashboard
 */

$agent_id           = get_the_ID();
$agent_info         = get_post_custom( $agent_id );
$agent_mobile       = ! empty( $agent_info['REAL_HOMES_mobile_number'][0] ) ? $agent_info['REAL_HOMES_mobile_number'][0] : false;
$agent_whatsapp     = ! empty( $agent_info['REAL_HOMES_whatsapp_number'][0] ) ? $agent_info['REAL_HOMES_whatsapp_number'][0] : false;
$agent_office_phone = ! empty( $agent_info['REAL_HOMES_office_number'][0] ) ? $agent_info['REAL_HOMES_office_number'][0] : false;
$agent_email        = ! empty( $agent_info['REAL_HOMES_agent_email'] [0] ) ? $agent_info['REAL_HOMES_agent_email'][0] : false;
$agent_agency       = ! empty( $agent_info['REAL_HOMES_agency'][0] ) ? $agent_info['REAL_HOMES_agency'][0] : false;
$facebook_url       = ! empty( $agent_info['REAL_HOMES_facebook_url'] [0] ) ? $agent_info['REAL_HOMES_facebook_url'][0] : false;
$twitter_url        = ! empty( $agent_info['REAL_HOMES_twitter_url'] [0] ) ? $agent_info['REAL_HOMES_twitter_url'][0] : false;
$linked_in_url      = ! empty( $agent_info['REAL_HOMES_linked_in_url'] [0] ) ? $agent_info['REAL_HOMES_linked_in_url'][0] : false;
$instagram_url      = ! empty( $agent_info['inspiry_instagram_url'] [0] ) ? $agent_info['inspiry_instagram_url'][0] : false;
$youtube_url        = ! empty( $agent_info['inspiry_youtube_url'] [0] ) ? $agent_info['inspiry_youtube_url'][0] : false;
$pinterest_url      = ! empty( $agent_info['inspiry_pinterest_url'] [0] ) ? $agent_info['inspiry_pinterest_url'][0] : false;
$agent_website      = ! empty( $agent_info['REAL_HOMES_website'] [0] ) ? $agent_info['REAL_HOMES_website'][0] : false;
?>
<div class="post-column-wrap">
    <div class="large-column-wrap">
        <div class="column column-thumbnail">
            <figure class="agent-thumbnail">
                <a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail( $agent_id ) ) {
						the_post_thumbnail( 'agent-image' );
					} else {
						?>
                        <span class="agent-thumb-placeholder"><i class="fas fa-user-tie"></i></span>
						<?php
					}
					?>
                </a>
            </figure>
        </div>
        <div class="column column-info">

            <h3 class="agent-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php
				if ( 0 < $agent_id ) {
					realhomes_verification_badge( 'agent', $agent_id );
				}
				?>
            </h3>

            <div class="agent-details-separator"></div>

            <div class="agent-contacts-list">
				<?php
				if ( $agent_office_phone ) {
					?>
                    <div class="agent-contact-item">
                        <h4 class="agent-contact-item-label"><?php esc_html_e( 'Office', 'framework' ); ?></h4>
                        <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $agent_office_phone ) ); ?>"><?php echo esc_html( $agent_office_phone ); ?></a>
                    </div>
					<?php
				}
				if ( $agent_mobile ) {
					?>
                    <div class="agent-contact-item">
                        <h4 class="agent-contact-item-label"><?php esc_html_e( 'Mobile', 'framework' ); ?></h4>
                        <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $agent_mobile ) ); ?>"><?php echo esc_html( $agent_mobile ); ?></a>
                    </div>
					<?php
				}
				if ( $agent_whatsapp ) {
					?>
                    <div class="agent-contact-item">
                        <h4 class="agent-contact-item-label"><?php esc_html_e( 'WhatsApp', 'framework' ); ?></h4>
                        <a href="https://wa.me/<?php echo esc_attr( str_replace( ' ', '', $agent_whatsapp ) ); ?>"><?php echo esc_html( $agent_whatsapp ); ?></a>
                    </div>
					<?php
				}
				if ( $agent_email ) {
					?>
                    <div class="agent-contact-item">
                        <h4 class="agent-contact-item-label"><?php esc_html_e( 'Email', 'framework' ); ?></h4>
                        <a href="mailto:<?php echo esc_attr( antispambot( $agent_email ) ); ?>"><?php echo esc_html( antispambot( $agent_email ) ); ?></a>
                    </div>
					<?php
				}
				?>
            </div>

			<?php
			if ( $facebook_url || $twitter_url || $linked_in_url || $instagram_url || $youtube_url || $pinterest_url || $agent_website ) {
				?>
                <div class="agent-social-links">
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

					if ( $agent_website ) {
						?>
                        <a class="website-icon" target="_blank" href="<?php echo esc_url( $agent_website ); ?>"><i class="fas fa-globe fa-lg"></i></a>
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
        <div class="column column-agent-properties-count">
			<?php
			$properties_count = 0;
			if ( function_exists( 'ere_get_agent_properties_count' ) ) {
				$agent_properties_count = ere_get_agent_properties_count( $agent_id );
				if ( ! empty( $agent_properties_count ) ) {
					$properties_count = $agent_properties_count;
				}
			}
			?>
            <span class="agent-listing-count"><?php echo esc_html( $properties_count ); ?></span>
        </div>
        <div class="column column-agent-agency">
            <span class="agent-agency">
                <?php
                if ( $agent_agency && ( '-1' !== $agent_agency ) ) {
	                printf( '<a href="%s">%s</a>', esc_url( get_the_permalink( $agent_agency ) ), esc_html( get_the_title( $agent_agency ) ) );
                } else {
	                echo esc_html__( 'N/A', 'framework' );
                }
                ?>
            </span>
        </div>
        <div class="column column-status">
	        <?php
	        $post_statuses = get_post_statuses();
	        $post_status   = get_post_status( $agent_id );
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
            <span class="agent-added-date"><?php echo get_the_date(); ?></span>
        </div>
    </div>

    <div class="post-actions-wrapper">
        <strong><?php esc_attr_e( 'Actions', 'framework' ); ?></strong>
		<?php
		// Preview Agent Link
		$preview_link = set_url_scheme( get_permalink( $agent_id ) );
		$preview_link = esc_url( apply_filters( 'preview_post_link', add_query_arg( 'preview', 'true', $preview_link ) ) );
		if ( ! empty( $preview_link ) ) :
			?>
            <a class="preview" target="_blank" href="<?php echo esc_url( $preview_link ); ?>">
                <i class="fas fa-eye"></i>
				<?php esc_html_e( 'View', 'framework' ); ?>
            </a>
		<?php
		endif;

		// Edit Agent Link
		$submit_agent_url = realhomes_get_dashboard_page_url( 'agents&submodule=submit-agent' );
		if ( ! empty( $submit_agent_url ) ) :
			?>
            <a class="edit" href="<?php echo esc_url( add_query_arg( 'id', $agent_id, $submit_agent_url ) ); ?>">
                <i class="fas fa-pencil-alt"></i>
				<?php esc_html_e( 'Edit', 'framework' ); ?>
            </a>
		<?php
		endif;

		// Delete Agent Link
		if ( current_user_can( 'delete_posts' ) ) : ?>
            <a class="delete">
                <i class="fas fa-trash"></i>
				<?php esc_html_e( 'Delete', 'framework' ); ?>
            </a>
            <span class="confirmation hide">
                <a class="remove-post" data-post-type="agent" data-post-id="<?php the_ID(); ?>" href="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" title="<?php esc_attr_e( 'Remove This Agent', 'framework' ); ?>">
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