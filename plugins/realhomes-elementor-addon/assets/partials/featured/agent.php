<?php
if ( ! function_exists( 'rhea_display_fp_agent_list' ) ) {
	function rhea_display_fp_agent_list( $args ) {
		global $settings;
		$display_verification_badge = $settings['show_verification_badge'];
		$verification_status        = get_post_meta( $args['agent_id'], 'ere_agent_verification_status', true );
		?>
        <div class="rhea_fp_agent_list">
			<?php
			if ( isset( $args['display_author'] ) && ( $args['display_author'] ) ) {
				if ( isset( $args['profile_image_id'] ) && ( 0 < $args['profile_image_id'] ) ) {
					?>
                    <a class="agent-image" href="<?php echo esc_url( get_author_posts_url( $args['agent_id'] ) ); ?>">
						<?php echo wp_get_attachment_image( $args['profile_image_id'], 'agent-image' ); ?>
                    </a>
					<?php
				} elseif ( isset( $args['agent_email'] ) ) {
					?>
                    <a class="agent-image" href="<?php echo esc_url( get_author_posts_url( $args['agent_id'] ) ); ?>">
						<?php echo get_avatar( $args['agent_email'], '210' ); ?>
                    </a>
					<?php
				}
			} else {
				if ( isset( $args['agent_id'] ) && has_post_thumbnail( $args['agent_id'] ) ) {
					?>
                    <a class="agent-image" href="<?php echo esc_url( get_permalink( $args['agent_id'] ) ); ?>">
						<?php
						echo get_the_post_thumbnail( $args['agent_id'], 'agent-image' );
						if ( 'yes' === $display_verification_badge && $verification_status ) {
							?>
                            <span class="rh_agent_verification__icon">
                                <?php
                                inspiry_safe_include_svg( '/icons/verified-check.svg', '/common/images' );
                                ?>
                            </span>
							<?php
						}
						?>
                    </a>
					<?php
				}
			}

			if ( isset( $args['agent_title_text'] ) && ! empty( $args['agent_title_text'] ) ) {
				?>
                <div class="rhea_agent_agency">
					<?php
					if ( isset( $args['display_author'] ) && ( $args['display_author'] ) ) {
						?>
                        <a class="rh_property_agent__title" href="<?php echo esc_url( get_author_posts_url( $args['agent_id'] ) ); ?>">
							<?php echo esc_html( $args['agent_title_text'] ); ?>
                        </a>
						<?php
					} else {
						if ( isset( $args['agent_id'] ) && ! empty( $args['agent_id'] ) ) {
							?>
                            <a class="rh_property_agent__title" href="<?php echo esc_url( get_permalink( $args['agent_id'] ) ); ?>">
								<?php echo esc_html( $args['agent_title_text'] ); ?>
                            </a>
							<?php
						}
					}

					if ( isset( $args['agent_agency'] ) && ! empty( $args['agent_agency'] ) ) {
						?>
                        <a class="rh_property_agent__agency" href="<?php echo esc_url( get_permalink( $args['agent_agency'] ) ); ?>">
							<?php echo get_the_title( esc_html( $args['agent_agency'] ) ); ?>
                        </a>
						<?php
					}
					?>
                </div>
				<?php
			}
			?>
        </div>
		<?php
	}
}

$display_agent_info   = get_option( 'theme_display_agent_info', 'true' );
$agent_display_option = get_post_meta( get_the_ID(), 'REAL_HOMES_agent_display_option', true );

if ( ( 'true' === $display_agent_info ) && ( 'none' !== $agent_display_option ) ) {
	if ( 'my_profile_info' === $agent_display_option ) {
		$profile_args                     = array();
		$profile_args['agent_id']         = $profile_args['display_author'] = true;
		$profile_args['author_id']        = get_the_author_meta( 'ID' );
		$profile_args['agent_title_text'] = get_the_author_meta( 'display_name' );
		$profile_args['profile_image_id'] = intval( get_the_author_meta( 'profile_image_id' ) );
		$profile_args['agent_email']      = get_the_author_meta( 'user_email' );
		$profile_args['agent_agency']     = get_user_meta( $profile_args['author_id'], 'inspiry_user_agency', true );
		?>
        <div class="rhea_fp_agent_expand_wrapper">
			<?php rhea_display_fp_agent_list( $profile_args ); ?>
        </div>
		<?php

	} else {
		$property_agents = get_post_meta( get_the_ID(), 'REAL_HOMES_agents' );

		// Remove invalid ids.
		$property_agents = array_filter( $property_agents, function ( $v ) {
			return ( $v > 0 );
		} );

		// Remove duplicated ids.
		$property_agents     = array_unique( $property_agents );
		$agents_count        = 0;
		$agents_count_expand = 0;
		if ( ! empty( $property_agents ) ) {
			?>
            <div class="rhea_fp_agent_expand_wrapper">
				<?php
				foreach ( $property_agents as $agent ) {
					if ( 1 < intval( $agent ) ) {
						$agent_args                     = array();
						$agent_args['agent_id']         = intval( $agent );
						$agent_args['agent_title_text'] = get_the_title( $agent_args['agent_id'] );
						$agent_args['agent_email']      = get_post_meta( $agent_args['agent_id'], 'REAL_HOMES_agent_email', true );
						$agent_args['agent_class']      = ( 0 !== $agents_count ) ? 'multiple-agent' : false;
						$agent_args['agent_agency']     = get_post_meta( $agent_args['agent_id'], 'REAL_HOMES_agency', true );


						if ( $agents_count < 1 ) {
							rhea_display_fp_agent_list( $agent_args );
						}

						$agents_count ++;
					}
				}
				?>
            </div>
			<?php
		}
	}
}
?>
