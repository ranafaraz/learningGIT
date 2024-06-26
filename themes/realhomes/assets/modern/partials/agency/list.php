<?php
/**
 * Agency List
 *
 * @since      3.5.0
 * @package    realhomes
 * @subpackage modern
 */

// Page Head.
$header_variation = get_option( 'inspiry_agencies_header_variation', 'banner' );

// Agency Search
$realhomes_agency_search       = get_option( 'realhomes_agency_search', 'no' );
$realhomes_agency_search_class = '';
if ( 'yes' === $realhomes_agency_search ) {
	$realhomes_agency_search_class = 'realhomes_agency_search';
}
?>

    <section class="rh_section rh_section--flex rh_wrap--padding rh_wrap--topPadding">
		<?php
		// Display any contents after the page banner and before the contents.
		do_action( 'inspiry_before_page_contents' );
		?>
        <div class="rh_page rh_page__agents rh_page__main">

			<?php if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) : ?>
                <div class="rh_page__head rh_page--agents_listing">
                    <h2 class="rh_page__title">
						<?php
						$page_title = get_post_meta( get_the_ID(), 'REAL_HOMES_banner_title', true );
						if ( empty( $page_title ) ) {
							$page_title = get_the_title( get_the_ID() );
						}
						inspiry_get_exploded_heading( $page_title );
						?>
                    </h2>
                </div>
			<?php
			endif;

			$get_content_position = get_post_meta( get_the_ID(), 'REAL_HOMES_content_area_above_footer', true );

			if ( $get_content_position !== '1' ) {
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						if ( get_the_content() ) : ?>
                            <div class="rh_content rh_page__content"><?php the_content(); ?></div>
						<?php
						endif;
					}
				}
			}

			?>
            <div class="rh_page__head rh_page__head-agents-list-template">
				<?php if ( 'yes' === $realhomes_agency_search ) { ?>
                    <div class="rh_agent__search_form">
						<?php get_template_part( 'assets/modern/partials/agency/search/agency-form' ); ?>
                    </div>
				<?php }
				if ( 'show' === get_option( 'inspiry_agencies_sort_controls', 'hide' ) ) {
					?>
                    <div class="rh_page__controls rh_page__controls-agent-sort-controls">
                        <div class="rh_sort_controls">
                            <select name="sort-properties" id="sort-properties" class="inspiry_select_picker_trigger inspiry_bs_default_mod inspiry_bs_agents_listing inspiry_bs_green">
								<?php inspiry_agency_sort_options(); ?>
                            </select>
                        </div>
                    </div>
				<?php } ?>
            </div>

			<?php
			$number_of_agencies = intval( get_option( 'inspiry_number_posts_agency', 3 ) );

			$paged = 1;
			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			}

			$agencies_args = array(
				'post_type'      => 'agency',
				'posts_per_page' => $number_of_agencies,
				'paged'          => $paged,
			);

			// Apply Search Filter
			$agencies_args = apply_filters( 'realhomes_agencies_search_filter', $agencies_args );

			// Apply Sorting Filter
			$agencies_args = inspiry_agencies_sort_args( $agencies_args );

			$agencies_query = new WP_Query( apply_filters( 'realhomes_agencies_list', $agencies_args ) );
			?>
            <div id="listing-container" class="rh_page__listing <?php echo sanitize_html_class( $realhomes_agency_search_class ); ?>" data-max="<?php echo esc_attr( $agencies_query->max_num_pages ); ?>" data-page="<?php echo $paged; ?>">
				<?php

				if ( $agencies_query->have_posts() ) :
					while ( $agencies_query->have_posts() ) :
						$agencies_query->the_post();
						get_template_part( 'assets/modern/partials/agency/card' );
					endwhile;
					wp_reset_postdata();
				else :
					?>
                    <div class="rh_alert-wrapper">
                        <h4 class="no-results"><?php esc_html_e( 'No Results Found!', 'framework' ); ?></h4>
                    </div>
				<?php
				endif;
				?>
            </div>
			<?php
			if ( 'yes' === $realhomes_agency_search ) {
				realhomes_ajax_pagination( $agencies_query->max_num_pages, $agencies_query );
			} else {
				inspiry_theme_pagination( $agencies_query->max_num_pages );
			}
			?>
        </div>

		<?php
		$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'agency-sidebar' );
		if ( is_active_sidebar( $attached_sidebar ) ) : ?>
            <div class="rh_page rh_page__sidebar">
				<?php get_sidebar( 'agency' ); ?>
            </div>
		<?php endif; ?>

    </section>

<?php
if ( '1' === $get_content_position ) {
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
            <div class="rh_content <?php if ( get_the_content() ) {
				echo esc_attr( 'rh_page__content' );
			} ?>">
				<?php the_content(); ?>
            </div>
			<?php
		}
	}
}
?>