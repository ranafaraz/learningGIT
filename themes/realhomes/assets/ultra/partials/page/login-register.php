<?php
/**
 * Page: Login or Register
 *
 * Page template for login or register.
 *
 * @since      4.0.2
 * @package    realhomes
 * @subpackage ultra
 */

get_header();
?>
    <div class="rh-page-container container">
        <div class="main-content">
			<?php
			get_template_part( 'assets/ultra/partials/page-head' );

			// Display any contents after the page head and before the contents.
			do_action( 'inspiry_before_page_contents' );
			?>
            <main id="main" class="rh-main main">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-thumbnail-wrapper">
								<?php
								if ( ! empty( get_the_post_thumbnail() ) ) {
									?>
                                    <figure>
										<?php
										$image_id  = get_post_thumbnail_id();
										$image_url = wp_get_attachment_url( $image_id );
										?>
                                        <a href="<?php echo esc_url( $image_url ); ?>" data-fancybox class="" title="<?php the_title_attribute(); ?>">
											<?php the_post_thumbnail( 'post-featured-image' ); ?>
                                        </a>
                                    </figure>
									<?php
								}
								?>
                            </div>
                            <div class="entry-content-wrapper">
                                <div class="entry-content">
									<?php
									the_content();

									if ( ! is_user_logged_in() ) {
										?>
                                        <div class="rh_form rh_form__login_wrap">
                                            <div class="rh_property_detail_login">
                                                <div class="row">
                                                    <div class="col-6">
														<?php get_template_part( 'assets/ultra/partials/member/login-form' ); ?>
                                                    </div>
                                                    <div class="col-6">
														<?php get_template_part( 'assets/ultra/partials/member/register-form' ); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="inspiry_social_login inspiry_mod_social_login_page">
												<?php
												// For social login
												do_action( 'wordpress_social_login' );

												// RealHomes Social Login.
												do_action( 'realhomes_social_login' );
												?>
                                            </div>
                                        </div>
										<?php
									} else if ( is_user_logged_in() ) {
										alert( esc_html__( 'You are already logged in!', 'framework' ) );
									}
									?>
                                </div>
                            </div>
                        </article>
						<?php
					}
				}
				?>
            </main>
        </div>
    </div><!-- .rh-page-container -->
<?php
get_footer();