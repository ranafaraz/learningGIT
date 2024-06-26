<?php
/**
 * Template for Single Property or Property Detail Page
 *
 * @package    realhomes
 * @subpackage modern
 */

get_header();

$property_id               = get_the_ID();
$property_content_layout   = get_option( 'realhomes_single_property_content_layout', 'default' );
$single_property_variation = get_option( 'realhomes_single_property_variation', 'default' );

if ( 'default' === $single_property_variation ) {
	// Page Head.
	$header_variation = get_option( 'inspiry_property_detail_header_variation' );

	if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
		get_template_part( 'assets/modern/partials/banner/header' );
	} else if ( ! empty( $header_variation ) && ( 'banner' === $header_variation ) ) {
		// Banner Image.
		$property_banner_image_url = '';
		$banner_image_id           = get_post_meta( $property_id, 'REAL_HOMES_page_banner_image', true );
		if ( $banner_image_id ) {
			$property_banner_image_url = wp_get_attachment_url( $banner_image_id );
		} else {
			$property_banner_image_url = get_default_banner();
		}
		?>
        <section class="rh_banner rh_banner__image" style="background-image: url('<?php echo esc_url( $property_banner_image_url ); ?>');">
            <div class="rh_banner__cover"></div>
			<?php if ( 'true' === get_option( 'inspiry_single_property_banner_title', 'true' ) ) : ?>
                <div class="rh_banner__wrap">
                    <h2 class="rh_banner__title"><?php echo esc_html( get_the_title() ); ?></h2>
                </div>
			<?php endif; ?>
        </section>
		<?php
	}

	if ( inspiry_show_header_search_form() ) {
		$REAL_HOMES_hide_property_advance_search = get_post_meta( $property_id, 'REAL_HOMES_hide_property_advance_search', true );
		if ( ! $REAL_HOMES_hide_property_advance_search ) {
			get_template_part( 'assets/modern/partials/properties/search/advance' );
		}
	}
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single-property' ) ) {

	$theme_property_detail_variation = get_option( 'theme_property_detail_variation', 'default' );

	// Property detail page sections.
	$sortable_property_sections = array(
		'content'                   => 'true',
		'additional-details'        => 'true',
		'common-note'               => get_option( 'theme_display_common_note', 'true' ),
		'features'                  => 'true',
		'attachments'               => get_option( 'theme_display_attachments', 'true' ),
		'floor-plans'               => 'true',
		'video'                     => get_option( 'theme_display_video', 'true' ),
		'virtual-tour'              => get_option( 'inspiry_display_virtual_tour', 'false' ),
		'map'                       => get_option( 'theme_display_google_map', 'true' ),
		'walkscore'                 => get_option( 'inspiry_display_walkscore', 'false' ),
		'yelp-nearby-places'        => get_option( 'inspiry_display_yelp_nearby_places', 'false' ),
		'energy-performance'        => get_option( 'inspiry_display_energy_performance', 'true' ),
		'property-views'            => get_option( 'inspiry_display_property_views', 'true' ),
		'rvr/guests-accommodation'  => get_option( 'inspiry_guests_accommodation_display', 'true' ),
		'rvr/price-details'         => get_option( 'inspiry_price_details_display', 'true' ),
		'rvr/seasonal-prices'       => get_option( 'inspiry_seasonal_prices_display', 'true' ),
		'rvr/availability-calendar' => get_option( 'inspiry_display_availability_calendar', 'true' ),
		'schedule-a-tour'           => 'true',
		'children'                  => 'true',
		'agent'                     => ( 'default' === $theme_property_detail_variation && get_option( 'theme_display_agent_info', 'true' ) ) ? 'true' : 'false',
		'mortgage-calculator'       => get_option( 'inspiry_mc_display', 'false' ),
	);

	$sortable_property_sections = apply_filters( 'realhomes_property_default_sections', $sortable_property_sections );
	$property_sections_order    = array_keys( $sortable_property_sections );
	if ( 'custom' === get_theme_mod( 'inspiry_property_sections_order_default', 'default' ) ) {
		$property_sections_order_string = get_option( 'inspiry_property_sections_order_mod' );
		$property_sections_order        = array_unique( array_merge( explode( ',', $property_sections_order_string ), $property_sections_order ) );
	}

	// Property fullwidth gallery image carousel.
	if ( 'gallery-fullwidth' === $single_property_variation ) {
		get_template_part( 'assets/modern/partials/property/single/gallery-for-top-area' );
	}
	?>
    <section class="rh_section rh_wrap--padding rh_wrap--topPadding">
		<?php
		// Display any contents after the page banner and before the contents.
		do_action( 'inspiry_before_page_contents' );

		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				if ( ! post_password_required() ) {
					if ( 'gallery-fullwidth' === $single_property_variation ) {
						get_template_part( 'assets/modern/partials/property/single/head' );
					}
					?>
                    <div class="rh_page rh_page--fullWidth">
						<?php
						if ( 'default' === $single_property_variation ) {
							get_template_part( 'assets/modern/partials/property/single/head' );
						}
						?>
                        <div class="rh_property">
							<?php
							if ( 'default' === $single_property_variation ) {
								// Property Gallery
								get_template_part( 'assets/modern/partials/property/single/gallery' );
							}
							?>
                            <div class="rh_property__wrap rh_property--padding">
                                <div class="rh_property__main">
                                    <div id="property-content" class="rh_property__content clearfix">
										<?php
										// Display the login form if login is required and user is not logged in.
										$prop_detail_login = inspiry_prop_detail_login();
										if ( 'yes' == $prop_detail_login && ! is_user_logged_in() ) {
											?>
                                            <div class="rh_form rh_property_detail_login">
												<?php
												get_template_part( 'assets/modern/partials/member/login-form' );
												get_template_part( 'assets/modern/partials/member/register-form' );
												?>
                                            </div>
											<?php
										} else {

											// Loader markup for accordion and toggle layouts.
											if ( in_array( $property_content_layout, array(
												'accordion',
												'toggle'
											) ) ) {
												realhomes_print_loader_markup();
											}

											// A list of functions to check the visibility status of tabs sections.
											$tabs_sections_helper = array(
												'floor-plans'        => function () use ( $property_id ) {
													$property_floor_plans = get_post_meta( $property_id, 'inspiry_floor_plans', true );

													return ( ! empty( $property_floor_plans ) && is_array( $property_floor_plans ) && ! empty( $property_floor_plans[0]['inspiry_floor_plan_name'] ) );
												},
												'video'              => function () use ( $property_id ) {
													if ( ! empty( get_post_meta( $property_id, 'REAL_HOMES_tour_video_url', true ) ) ) {
														return true;
													} else {
														return ( ! empty( get_post_meta( $property_id, 'inspiry_video_group', true ) ) );
													}
												},
												'map'                => function () use ( $property_id ) {
													$property_location = get_post_meta( $property_id, 'REAL_HOMES_property_location', true );
													$property_address  = get_post_meta( $property_id, 'REAL_HOMES_property_address', true );
													$hide_property_map = get_post_meta( $property_id, 'REAL_HOMES_property_map', true );

													return ( ! empty( $property_address ) && ! empty( $property_location ) && ( 1 != $hide_property_map ) );
												},
												'energy-performance' => function () use ( $property_id ) {
													$energy_class = get_post_meta( $property_id, 'REAL_HOMES_energy_class', true );

													return ( ! empty( $energy_class ) && '-1' != $energy_class && 'none' != $energy_class );
												}
											);

											// Property section to be used in tabs.
											$tabs_property_sections       = array(
												'overview'           => array(
													'title' => esc_html__( 'Overview', 'framework' ),
													'show'  => true,
													'icon'  => '<i class="fa fa-eye"></i>'
												),
												'content'            => array(
													'title' => esc_html__( 'Description', 'framework' ),
													'show'  => ! empty( get_the_content() ),
													'icon'  => '<i class="fa fa-sticky-note"></i>'
												),
												'additional-details' => array(
													'title' => esc_html__( 'Additional Details', 'framework' ),
													'show'  => ! empty( get_post_meta( $property_id, 'REAL_HOMES_additional_details_list', true ) ),
													'icon'  => '<i class="fa fa-list"></i>'
												),
												'features'           => array(
													'title' => esc_html__( 'Features', 'framework' ),
													'show'  => ! empty( get_the_terms( $property_id, 'property-feature' ) ),
													'icon'  => '<i class="fa fa-clipboard-list"></i>'
												),
												'attachments'        => array(
													'title' => esc_html__( 'Attachments', 'framework' ),
													'show'  => ! empty( inspiry_get_property_attachments( $property_id ) ),
													'icon'  => '<i class="fa fa-paperclip"></i>'
												),
												'floor-plans'        => array(
													'title' => esc_html__( 'Floor Plans', 'framework' ),
													'show'  => $tabs_sections_helper['floor-plans'](),
													'icon'  => '<i class="fa fa-building"></i>'
												),
												'video'              => array(
													'title' => esc_html__( 'Video', 'framework' ),
													'show'  => $tabs_sections_helper['video'](),
													'icon'  => '<i class="fa fa-video"></i>'
												),
												'virtual-tour'       => array(
													'title' => esc_html__( 'Virtual Tour', 'framework' ),
													'show'  => ! empty( trim( get_post_meta( $property_id, 'REAL_HOMES_360_virtual_tour', true ) ) ),
													'icon'  => '<i class="fa fa-street-view fa-file-video"></i>'
												),
												'map'                => array(
													'title' => esc_html__( 'Map', 'framework' ),
													'show'  => $tabs_sections_helper['map'](),
													'icon'  => '<i class="far fa-map"></i>'
												),
												'schedule-a-tour'    => array(
													'title' => esc_html__( 'Schedule A Tour', 'framework' ),
													'show'  => realhomes_display_schedule_a_tour(),
													'icon'  => '<i class="far fa-map"></i>'
												),
												'energy-performance' => array(
													'title' => esc_html__( 'Energy Performance', 'framework' ),
													'show'  => $tabs_sections_helper['energy-performance'](),
													'icon'  => '<i class="fas fa-bolt"></i>'
												),
											);
											$tabs_property_sections_order = array_keys( $tabs_property_sections );

											// Generates the tab's nav when tabs layout is selected.
											if ( in_array( $property_content_layout, array(
												'horizontal-tabs',
												'vertical-tabs'
											) ) ) {
												echo '<div id="property-content-wrapper" class="property-content-wrapper">';

												if ( ! empty( $property_sections_order ) && is_array( $property_sections_order ) ) {
													$format       = '<li data-id="%s"><span class="tabs-item-icon">%s</span><span class="tabs-item-title">%s</span></li>';
													$content_list = sprintf( $format, $tabs_property_sections_order['0'], $tabs_property_sections['overview']['icon'], $tabs_property_sections['overview']['title'] );
													foreach ( $property_sections_order as $section ) {
														if ( isset( $sortable_property_sections[ $section ] ) && 'true' === $sortable_property_sections[ $section ] && in_array( $section, $tabs_property_sections_order ) && $tabs_property_sections[ $section ]['show'] ) {
															$content_list .= sprintf( $format, esc_html( $section ), $tabs_property_sections[ $section ]['icon'], esc_html( $tabs_property_sections[ $section ]['title'] ) );
														}
													}

													printf( '<div class="property-content-tabs-wrapper"><ul id="property-content-tabs" class="property-content-tabs">%s</ul></div>', $content_list );
												}

												// A div to wrap tabs content.
												echo '<div class="property-tabs-content-wrapper">';
											}
											?>
                                            <div id="property-content-section-overview" class="property-content-section property-overview">
												<?php
												$realhomes_property_id        = get_post_meta( $property_id, 'REAL_HOMES_property_id', true );
												$prop_id_field_label          = get_option( 'inspiry_prop_id_field_label' );
												$display_social_share         = get_option( 'theme_display_social_share', 'true' );
												$inspiry_share_property_label = get_option( 'inspiry_share_property_label' );
												$inspiry_print_property_label = get_option( 'inspiry_print_property_label' );
												?>
                                                <div class="rh_property__row rh_property__meta rh_property--borderBottom">
                                                    <div class="rh_property__id">
                                                        <p class="title"><?php echo $prop_id_field_label ? esc_html( $prop_id_field_label ) : esc_html__( 'Property ID', 'framework' ); ?>:</p>
														<?php
                                                        if ( ! empty( $realhomes_property_id ) ) {
                                                            ?>
                                                            <p class="id">
                                                                &nbsp;<?php echo esc_html( $realhomes_property_id ); ?>
                                                            </p>
														<?php
                                                        } else {
                                                            ?>
                                                            <p class="id">
                                                                &nbsp;<?php esc_html_e( 'None', 'framework' ); ?>
                                                            </p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="rh_property__print">
														<?php
														if ( 'true' === $display_social_share ) {
															$share_tooltip = esc_html__( 'Share', 'framework' );
															if ( ! empty( $inspiry_share_property_label ) ) {
																$share_tooltip = $inspiry_share_property_label;
															}
															?>
                                                            <a href="#" class="share" id="social-share" data-tooltip="<?php echo esc_attr( $share_tooltip ); ?>"><?php inspiry_safe_include_svg( '/images/icons/icon-share-2.svg' ); ?></a>
                                                            <div class="share-this" data-check-mobile="<?php echo ( wp_is_mobile() ) ? esc_attr( 'mobile' ) : ''; ?>" data-property-name="<?php the_title(); ?>" data-property-permalink="<?php the_permalink(); ?>"></div>
															<?php
														}

														// Display add to favorite button.
														inspiry_favorite_button( $property_id );

														$compare_properties_module = get_option( 'theme_compare_properties_module' );
														$inspiry_compare_page      = get_option( 'inspiry_compare_page' );
														if ( ( 'enable' === $compare_properties_module ) && ( $inspiry_compare_page ) ) {
															$property_img_url = get_the_post_thumbnail_url( $property_id, 'property-thumb-image' );
															if ( empty( $property_img_url ) ) {
																$property_img_url = get_inspiry_image_placeholder_url( 'property-thumb-image' );
															}
															?>
                                                            <span class="rh_single_compare_button add-to-compare-span compare-btn-<?php echo esc_attr( $property_id ); ?>" data-property-id="<?php echo esc_attr( $property_id ); ?>" data-property-title="<?php echo esc_attr( get_the_title( $property_id ) ); ?>" data-property-url="<?php echo esc_url( get_the_permalink( $property_id ) ); ?>" data-property-image="<?php echo esc_url( $property_img_url ); ?>">
															<span class="compare-placeholder highlight hide" data-tooltip="<?php esc_attr_e( 'Added to compare', 'framework' ); ?>">
																<?php inspiry_safe_include_svg( '/images/icons/icon-compare.svg' ); ?>
															</span>
															<a class="rh_trigger_compare add-to-compare" data-tooltip="<?php esc_attr_e( 'Add to compare', 'framework' ); ?>" href="<?php echo esc_url( get_the_permalink( $property_id ) ); ?>">
																<?php inspiry_safe_include_svg( '/images/icons/icon-compare.svg' ); ?>
															</a>
														</span>
															<?php
														}

														$print_tooltip = esc_html__( 'Print', 'framework' );
														if ( ! empty( $inspiry_print_property_label ) ) {
															$print_tooltip = $inspiry_print_property_label;
														}
														?>
                                                        <a href="javascript:window.print()" class="print" data-tooltip="<?php echo esc_attr( $print_tooltip ); ?>">
															<?php inspiry_safe_include_svg( '/images/icons/icon-printer.svg' ); ?>
                                                        </a>
														<?php
														if ( 'true' === get_option( 'realhomes_enable_report_property', 'false' ) ) {
															?>
                                                            <a class="report-this-property" href="#report-property-modal-<?php echo esc_attr( $property_id ); ?>" data-tooltip="<?php esc_attr_e( 'Report This Property', 'framework' ); ?>">
                                                                <i class="fas fa-flag"></i>
                                                            </a>
															<?php
														}
														?>
                                                    </div>
                                                </div>
												<?php
												// Property meta information.
												get_template_part( 'assets/modern/partials/property/single/meta' );
												?>
                                            </div>
											<?php
											if ( ! empty( $property_sections_order ) && is_array( $property_sections_order ) ) {
												if ( in_array( $property_content_layout, array(
													'horizontal-tabs',
													'vertical-tabs'
												) ) ) {
													// Separates the sections that are not used in tabs.
													$sections_not_in_tabs = array_diff( $property_sections_order, $tabs_property_sections_order );

													// Display tabs related sections.
													foreach ( $tabs_property_sections_order as $tabs_section ) {
														if ( isset( $sortable_property_sections[ $tabs_section ] ) && 'true' === $sortable_property_sections[ $tabs_section ] ) {
															get_template_part( 'assets/modern/partials/property/single/' . $tabs_section );
														}
													}

													// Closing divs related to tab's sections.
													echo '</div>';
													echo '</div><!-- /.property-content-wrapper -->';

													// A div to wrap none tabs content.
													echo '<div class="property-content-not-in-tabs">';

													foreach ( $sections_not_in_tabs as $section ) {
														if ( isset( $sortable_property_sections[ $section ] ) && 'true' === $sortable_property_sections[ $section ] ) {
															get_template_part( 'assets/modern/partials/property/single/' . $section );
														}
													}

													// Closing div related to none tab's sections.
													echo '</div><!-- /.property-content-not-in-tabs -->';

												} else {

													// Display sections according to their order.
													foreach ( $property_sections_order as $section ) {
														if ( isset( $sortable_property_sections[ $section ] ) && 'true' === $sortable_property_sections[ $section ] ) {
															get_template_part( 'assets/modern/partials/property/single/' . $section );
														}
													}
												}
											}
										}
										?>
                                    </div><!-- /.rh_property__content -->

									<?php get_template_part( 'assets/modern/partials/property/single/similar-properties' ); ?>

                                    <section class="realhomes_comments">
										<?php
										/**
										 * Comments
										 *
										 * If comments are open or we have at least one comment, load up the comment template.
										 */
										if ( comments_open() || get_comments_number() ) {
											?>
                                            <div class="property-comments">
												<?php comments_template(); ?>
                                            </div>
											<?php
										}
										?>
                                    </section>
                                </div><!-- /.rh_property__main -->

								<?php // Data attributes to trigger sticky sidebar js plugin. ?>
                                <div class="rh_property__sidebar" data-sticky="true" data-top-gap="60" data-bottom-gap="60">
									<?php
									if ( 'agent-in-sidebar' === $theme_property_detail_variation ) {
										?>
                                        <aside class="rh_sidebar">
											<?php
											/**
											 * Action hook to display contents above agent.
                                             *
											 * @since 4.1.1
											 */
											do_action( 'realhomes_above_single_property_sidebar_agent' );

											get_template_part( 'assets/modern/partials/property/single/agent-for-sidebar' );

											$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'property-sidebar' );
											if ( is_active_sidebar( $attached_sidebar ) ) {
												dynamic_sidebar( $attached_sidebar );
											}
											?>
                                        </aside>
										<?php
									} else {
										get_sidebar( 'property' );
									}
									?>
                                </div><!-- /.rh_property__sidebar -->
                            </div><!-- /.rh_property__wrap -->
                        </div><!-- /.rh_property -->
                    </div><!-- /.rh_page -->
					<?php
				} else {
					?>
                    <div class="rh_page rh_page--fullWidth">
						<?php echo get_the_password_form(); ?>
                    </div><!-- /.rh_page -->
					<?php
				}
			} // end while have_posts();
		} // end if have_posts()
		?>
    </section>
	<?php
}
get_footer();
