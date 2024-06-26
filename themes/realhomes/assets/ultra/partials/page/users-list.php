<?php
/**
 * Display users list for Ultra design variation.
 *
 * @since   4.0.0
 * @package realhomes
 */


get_header();

?>

    <div class="rh-page-container container">
        <div class="row">
            <div class="col-8 main-content">
				<?php
				get_template_part( 'assets/ultra/partials/page-head' );

				// Display any contents after the page head and before the contents.
				do_action( 'inspiry_before_page_contents' );

				// Display page content area at top
				do_action( 'realhomes_content_area_at_top' );
				?>
                <main id="main" class="rh-main main">
					<?php
					$number_of_posts = intval( get_option( 'theme_number_posts_agent' ) );
					if ( ! $number_of_posts ) {
						$number_of_posts = 3;
					}

					$paged = 1;
					if ( get_query_var( 'paged' ) ) {
						$paged = get_query_var( 'paged' );
					} else if ( get_query_var( 'page' ) ) { // if is static front page
						$paged = get_query_var( 'page' );
					}

					// Offset for users query.
					$offset = 0;
					if ( $paged > 1 ) {
						$offset = $number_of_posts * ( $paged - 1 );
					}

					// Users query arguments.
					$users_args = array(
						'number' => $number_of_posts,
						'offset' => $offset,
					);

					// Users Query.
					$users_query = new WP_User_Query( $users_args );

					if ( $users_query->results ) {
						foreach ( $users_query->results as $user ) {

							$user_meta       = get_user_meta( $user->ID );
							$author_page_url = get_author_posts_url( $user->ID );

							?>

                            <article class="agent-card">
                                <div class="agent-card-inner">
									<?php

									if ( isset( $user_meta['profile_image_id'] ) ) {
										$profile_image_id = intval( $user_meta['profile_image_id'][0] );
										if ( $profile_image_id ) {
											?>
                                            <figure class="agent-thumbnail">
                                                <a title="<?php echo esc_attr( $user->display_name ); ?>" href="<?php echo esc_url( $author_page_url ); ?>">
													<?php echo wp_get_attachment_image( $profile_image_id, 'agent-image' ); ?>
                                                </a>
                                            </figure>
											<?php
										}
									} else if ( function_exists( 'get_avatar' ) ) {
										?>
                                        <figure class="agent-thumbnail">
                                            <a title="<?php echo esc_attr( $user->display_name ); ?>" href="<?php echo esc_url( $author_page_url ); ?>">
												<?php echo get_avatar( $user->user_email, '180' ); ?>
                                            </a>
                                        </figure>
										<?php
									}

									?>

                                    <div class="agent-details">
                                        <header class="agent-card-header">
                                            <h2 class="agent-title">
                                                <a href="<?php echo esc_url( $author_page_url ); ?>"><?php echo esc_html( $user->display_name ); ?></a>
                                            </h2>
											<?php
											if ( isset( $user_meta['description'] ) ) {
												echo '<p class="agent-description">' . esc_html( get_framework_custom_excerpt( $user_meta['description'][0], 45 ) ) . '</p>';
											}
											?>

                                            <div class="agent-details-separator"></div>
                                        </header>

                                        <div class="agent-contacts-list">
											<?php

											if ( ! empty( $user_meta['office_number'][0] ) ) {
												?>
                                                <div class="agent-contact-item">
													<?php inspiry_safe_include_svg( '/icons/phone.svg' ); ?>
                                                    <div class="agent-contact-item-inner">
                                                        <h4 class="agent-contact-item-label"><?php esc_html_e( 'Office', 'framework' ); ?></h4>
                                                        <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $user_meta['office_number'][0] ) ); ?>"><?php echo esc_html( $user_meta['office_number'][0] ); ?></a>
                                                    </div>
                                                </div>
												<?php
											}
											if ( ! empty( $user_meta['fax_number'][0] ) ) {
												?>
                                                <div class="agent-contact-item">
													<?php inspiry_safe_include_svg( '/icons/print.svg' ); ?>
                                                    <div class="agent-contact-item-inner">
                                                        <h4 class="agent-contact-item-label"><?php esc_html_e( 'Fax', 'framework' ); ?></h4>
                                                        <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $user_meta['fax_number'][0] ) ); ?>"><?php echo esc_html( $user_meta['fax_number'][0] ); ?></a>
                                                    </div>
                                                </div>
												<?php
											}
											if ( ! empty( $user_meta['whatsapp_number'][0] ) ) {
												?>
                                                <div class="agent-contact-item">
													<?php inspiry_safe_include_svg( '/icons/whatsapp.svg' ); ?>
                                                    <div class="agent-contact-item-inner">
                                                        <h4 class="agent-contact-item-label"><?php esc_html_e( 'WhatsApp', 'framework' ); ?></h4>
                                                        <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $user_meta['whatsapp_number'][0] ) ); ?>"><?php echo esc_html( $user_meta['whatsapp_number'][0] ); ?></a>
                                                    </div>
                                                </div>
												<?php
											}
											if ( ! empty( $user->user_email ) ) {
												?>
                                                <div class="agent-contact-item">
													<?php inspiry_safe_include_svg( '/icons/email.svg' ); ?>
                                                    <div class="agent-contact-item-inner">
                                                        <h4 class="agent-contact-item-label"><?php esc_html_e( 'Email', 'framework' ); ?></h4>
                                                        <a href="mailto:<?php echo esc_attr( antispambot( $user->user_email ) ); ?>"><?php echo esc_html( antispambot( $user->user_email ) ); ?></a>
                                                    </div>
                                                </div>
												<?php
											}
											?>
                                        </div>

                                        <footer class="agent-card-footer">
											<?php

											if ( ! empty( $user_meta['facebook_url'][0] ) ||
												! empty( $user_meta['twitter_url'][0] ) ||
												! empty( $user_meta['linkedin_url'][0] ) ||
												! empty( $user_meta['instagram_url'][0] )
											) {
												?>
                                                <div class="agent-social-links">
													<?php
													if ( ! empty( $user_meta['facebook_url'][0] ) ) {
														?>
                                                    <a class="facebook" target="_blank" href="<?php echo esc_url( $user_meta['facebook_url'][0] ); ?>">
                                                            <i class="fab fa-facebook fa-lg"></i></a><?php
													}

													if ( ! empty( $user_meta['twitter_url'][0] ) ) {
														?>
                                                    <a class="twitter" target="_blank" href="<?php echo esc_url( $user_meta['twitter_url'][0] ); ?>">
                                                            <i class="fab fa-twitter fa-lg"></i></a><?php
													}

													if ( ! empty( $user_meta['linkedin_url'][0] ) ) {
														?>
                                                    <a class="linkedin" target="_blank" href="<?php echo esc_url( $user_meta['linkedin_url'][0] ); ?>">
                                                            <i class="fab fa-linkedin fa-lg"></i></a><?php
													}

													if ( ! empty( $user_meta['instagram_url'][0] ) ) {
														?>
                                                    <a class="instagram" target="_blank" href="<?php echo esc_url( $user_meta['instagram_url'][0] ); ?>">
                                                            <i class="fab fa-instagram fa-lg"></i></a><?php
													}
													?>
                                                </div>
												<?php
											}
											$properties_count = inspiry_author_properties_count( $user->ID );

											$agent_properties = 0;

											if ( ! empty( $properties_count ) ) {
												$agent_properties = $listed_properties;
											}

											$listed_properties_text = sprintf( _n( '%s Listed Property', '%s Listed Properties', $agent_properties, 'framework' ), $agent_properties );
											?>
                                            <a class="agent-listing-count" href="<?php echo esc_url( $author_page_url ); ?>"><?php echo esc_html( $listed_properties_text ); ?>
                                                <i class="fas fa-caret-right"></i>
                                            </a>
											<?php
											?>
                                        </footer>
                                    </div>
                                </div>
                            </article><!-- /.agent-card -->

							<?php
						}

						$total_user  = $users_query->total_users;
						$total_pages = ceil( $total_user / $number_of_posts );
						inspiry_users_pagination( $total_pages );
					} else {
						realhomes_print_no_result();
					}
					?>
                </main>
				<?php
				// Display page content area at bottom
				do_action( 'realhomes_content_area_at_bottom' );
				?>
            </div>
			<?php
			if ( is_active_sidebar( 'property-listing-sidebar' ) ) {
				?>
                <div class="col-4 sidebar-content">
					<?php get_sidebar( 'property-listing' ); ?>
                </div>
				<?php
			}
			?>
        </div>
    </div>

<?php

get_footer();
