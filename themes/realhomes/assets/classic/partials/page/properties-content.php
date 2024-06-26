<?php
/**
 * Properties page content.
 *
 * @since      4.2.0
 * @package    realhomes
 * @subpackage classic
 */

$page_id      = get_the_ID();
$page_layout  = $args['page_layout'];
$is_grid_card = ( 'grid' === $args['property_card'] );

if ( isset( $_GET['view'] ) ) {
	$is_grid_card = 'grid' === $_GET['view'];
}

if ( $is_grid_card ) {
	$wrapper_classes = 'listing-layout property-grid';
} else {
	$wrapper_classes = 'listing-layout';
}

// Getting current template's meta setting for properties count
$template_properties_count = get_post_meta( $page_id, 'inspiry_posts_per_page', true );

// Assigning properties count based on availability
$number_of_properties = ( 0 < intval( $template_properties_count ) ) ? $template_properties_count : get_option( 'theme_number_of_properties', 6 );

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

// Apply properties filter.
$property_listing_args  = apply_filters( 'inspiry_properties_filter', $property_listing_args );
$property_listing_args  = sort_properties( $property_listing_args );
$property_listing_query = new WP_Query( $property_listing_args );
?>
<div class="main">
    <section class="<?php echo esc_attr( $wrapper_classes ); ?>">
		<?php
		$title_display = get_post_meta( $page_id, 'REAL_HOMES_page_title_display', true );
		if ( 'hide' !== $title_display ) {
			$theme_listing_module = get_option( 'theme_listing_module' );
			if ( 'properties-map' == $theme_listing_module ) {
				?>
                <h1 class="title-heading"><?php the_title(); ?></h1>
				<?php
			} else {
				?>
                <h3 class="title-heading"><?php the_title(); ?></h3>
				<?php
			}
		}

		// Listing view type.
		get_template_part( 'assets/classic/partials/properties/view-buttons' );
		?>
        <div class="list-container inner-wrapper clearfix">
            <div class="list-container-top">
				<?php
				// Sort control
				get_template_part( 'assets/classic/partials/properties/sort-controls' );

				// Page content
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						?>
                        <article <?php post_class(); ?>>
							<?php the_content(); ?>
                        </article>
						<?php
					}
				}
				?>
            </div>
			<?php
			// Properties loop
			if ( $property_listing_query->have_posts() ) {
				?>
                <div class="property-items-wrapper">
					<?php
					$counter = 1;
					while ( $property_listing_query->have_posts() ) {
						$property_listing_query->the_post();

						if ( $is_grid_card ) {
							// properties grid card.
							get_template_part( 'assets/classic/partials/properties/grid-card' );

							if ( $counter % 2 == 0 ) {
								?>
                                <div class="clearfix rh-visible-xs"></div>
								<?php
							}

							if ( $counter % 3 == 0 ) {
								?>
                                <div class="clearfix rh-visible-sm rh-visible-md rh-visible-lg"></div>
								<?php
							}

							$counter++;

						} else {
							get_template_part( 'assets/classic/partials/properties/list-card' );
						}
					}

					wp_reset_postdata();
					?>
                </div><!-- .property-items-wrapper -->
				<?php
			} else {
				?>
                <div class="alert-wrapper">
                    <h4><?php esc_html_e( 'No Results Found!', 'framework' ); ?></h4>
                </div>
				<?php
			}
			?>
        </div>
		<?php
		if ( $property_listing_query->found_posts ) {
			theme_pagination( $property_listing_query->max_num_pages );
		}
		?>
    </section>
</div><!-- .main -->
