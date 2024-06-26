<?php
/**
 * Half Map with Properties List
 *
 * @package    realhomes
 * @subpackage modern
 */

$ajax_pagination_enabled = realhomes_get_ajax_pagination_status();
$ajax_class              = '';

if ( $ajax_pagination_enabled ) {
	$ajax_class = 'ajax-pagination';
}

?>

<section id="properties-listing" class="rh_section rh_section--flex rh_section__map_listing <?php echo sanitize_html_class( $ajax_class ); ?>">

    <div class="rh_page rh_page__listing_map">
		<?php get_template_part( 'assets/modern/partials/properties/map' ); ?>
    </div>
    <!-- /.rh_page rh_page__listing_map -->

    <div class="rh_page rh_page__map_properties">
		<?php
		$get_content_position = get_post_meta( get_the_ID(), 'REAL_HOMES_content_area_above_footer', true );

		if ( $get_content_position !== '1' ) {
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					?>
                    <div class="rh_content <?php if ( get_the_content() ) {
						echo esc_attr( 'rh_page__content' );
					} ?>">
						<?php the_content(); ?>
                    </div><!-- /.rh_content -->
					<?php
				}
			}
		}


		$number_of_properties = intval( get_option( 'theme_number_of_properties' ) );
		if ( ! $number_of_properties ) {
			$number_of_properties = 6;
		}

		global $paged;
		$paged = 1;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} else if ( get_query_var( 'page' ) ) { // if is static front page
			$paged = get_query_var( 'page' );
		}

		$property_listing_args = array(
			'post_type'      => 'property',
			'posts_per_page' => $number_of_properties,
			'paged'          => $paged,
		);

		$theme_listing_module = get_option( 'theme_listing_module' );

		if ( $theme_listing_module === 'properties-map' ) {

			$property_listing_args['meta_query'] = array(
				array(
					'key'     => 'REAL_HOMES_property_address',
					'compare' => 'EXISTS',
				),
			);

		}

		// Apply properties filter.
		$property_listing_args = apply_filters( 'inspiry_properties_filter', $property_listing_args );

		$property_listing_args = sort_properties( $property_listing_args );

		$property_listing_query = new WP_Query( $property_listing_args );

		if ( $property_listing_query->have_posts() ) :
			?>
            <div class="rh_page__head">

				<?php
				$found_properties = $property_listing_query->found_posts;
				$per_page         = $property_listing_query->query_vars['posts_per_page'];
				$state_first      = ( $per_page * $paged ) - $per_page + 1;
				$state_last       = min( $found_properties, $per_page * $paged );
				?>
                <p class="rh_pagination__stats" data-page="<?php echo intval( $paged ); ?>" data-max="<?php echo intval( $property_listing_query->max_num_pages ); ?>" data-total-properties="<?php echo intval( $found_properties ); ?>" data-page-id="<?php echo intval( get_the_ID() ); ?>">
					<?php
					if ( $found_properties >= $per_page || -1 !== $per_page ) {
						?>
                        <span class="highlight_stats"><?php echo intval( $state_first ); ?></span>
                        <span><?php esc_html_e( ' to ', 'framework' ); ?></span>
                        <span class="highlight_stats"><?php echo intval( $state_last ); ?></span>
                        <span><?php esc_html_e( ' out of ', 'framework' ); ?></span>
                        <span class="highlight_stats"><?php echo intval( $found_properties ); ?></span>
                        <span><?php esc_html_e( ' properties', 'framework' ); ?></span>
						<?php
					}
					?>
                </p><!-- /.rh_pagination__stats -->

                <div class="rh_page__controls">
					<?php get_template_part( 'assets/modern/partials/properties/sort-controls' ); ?>
                </div>
                <!-- /.rh_page__controls -->

            </div><!-- /.rh_page__head -->

            <div class="rh_page__listing">

				<?php
				while ( $property_listing_query->have_posts() ) :
					$property_listing_query->the_post();
					get_template_part( 'assets/modern/partials/properties/half-map-card' );
				endwhile;
				wp_reset_postdata();
				?>
            </div><!-- /.rh_page__listing -->

		<?php
		else :
			?>
            <div class="rh_alert-wrapper">
                <h4><?php esc_html_e( 'No Results Found!', 'framework' ); ?></h4>
            </div>
		<?php
		endif;

		if ( $ajax_pagination_enabled ) {
			realhomes_ajax_pagination( $property_listing_query->max_num_pages, $property_listing_query );
		} else {
			inspiry_theme_pagination( $property_listing_query->max_num_pages );
		}
		?>

    </div>
    <!-- /.rh_page rh_page__map_properties -->

</section><!-- /.rh_section rh_wrap rh_wrap--padding -->

<?php

if ( '1' === $get_content_position ) {
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
            <div class="rh_content rh_content_above_footer <?php if ( get_the_content() ) {
				echo esc_attr( 'rh_page__content' );
			} ?>">
				<?php the_content(); ?>
            </div><!-- /.rh_content -->
			<?php
		}
	}
}
?>
