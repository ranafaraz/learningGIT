<?php
/**
 * Search page content.
 *
 * @package    realhomes
 * @subpackage classic
 */

$page_id              = get_the_ID();
$page_layout          = $args['page_layout'];
$is_grid_card         = ( 'grid' === $args['property_card'] );
$get_content_position = get_post_meta( $page_id, 'REAL_HOMES_content_area_above_footer', true );

if ( $is_grid_card ) {
	$wrapper_classes = 'listing-layout property-grid';
} else {
	$wrapper_classes = 'listing-layout';
}

// Number of properties to display on search results page.
$number_of_properties = intval( get_option( 'theme_properties_on_search' ) );
if ( ! $number_of_properties ) {
	$number_of_properties = 4;
}

$paged = 1;
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} else if ( get_query_var( 'page' ) ) { // if is static front page
	$paged = get_query_var( 'page' );
}

$search_args = array(
	'post_type'      => 'property',
	'posts_per_page' => $number_of_properties,
	'paged'          => $paged,
);

// Apply Search Filter
$search_args  = apply_filters( 'real_homes_search_parameters', $search_args );
$search_args  = sort_properties( $search_args );  // Sort Properties
$search_query = new WP_Query( $search_args );
?>
    <div class="main">
		<?php
		// Advance Search Form
		get_template_part( 'assets/classic/partials/properties/search/form-wrapper' );
		?>
        <section class="property-items <?php echo esc_attr( $wrapper_classes ); ?>">
            <div class="search-header inner-wrapper clearfix">
                <div class="page-top-content">
                    <div class="properties-count">
                <span><strong><?php echo esc_html( $search_query->found_posts ); ?></strong>&nbsp;
                    <?php
                    if ( 1 < $search_query->found_posts ) {
	                    esc_html_e( 'Results', 'framework' );
                    } else {
	                    esc_html_e( 'Result', 'framework' );
                    }
                    ?>
                </span>
                    </div>
                    <div class="multi-control-wrap">
						<?php
						// Save Search
						get_template_part( 'assets/classic/partials/properties/save-alert-button', '', array( 'search_args' => $search_args ) );

						// Sort control
						get_template_part( 'assets/classic/partials/properties/sort-controls' );
						?>
                    </div>
                </div>
				<?php
				if ( '1' !== $get_content_position ) {
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							$rh_content_is_empty = '';
							if ( ! get_the_content() ) {
								$rh_content_is_empty = 'rh_content_is_empty';
							}
							?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class( $rh_content_is_empty ); ?>>
								<?php the_content(); ?>
                            </article>
							<?php
						}
					}
				}
				?>
            </div>
			<?php
			if ( $search_query->have_posts() ) {
				?>
                <div class="searched-properties-wrapper">
					<?php
					while ( $search_query->have_posts() ) {
						$search_query->the_post();
						if ( $is_grid_card ) {
							get_template_part( 'assets/classic/partials/properties/grid-card' );
						} else {
							get_template_part( 'assets/classic/partials/properties/search/search-card' );
						}
					}

					wp_reset_postdata();
					?>
                </div><!-- .searched-properties-wrapper -->
				<?php
			} else {
				?>
                <div class="alert-wrapper">
					<?php
					$inspiry_search_template_no_result_text = get_option( 'inspiry_search_template_no_result_text' );

					if ( ! empty( $inspiry_search_template_no_result_text ) ) {
						?>
                        <h4><?php echo inspiry_kses( $inspiry_search_template_no_result_text ); ?></h4>
						<?php
					} else {
						?>
                        <h4><?php esc_html_e( 'No Property Found!', 'framework' ); ?></h4>
						<?php
					}
					?>
                </div>
				<?php
			}

			if ( $search_query->found_posts ) {
				theme_pagination( $search_query->max_num_pages );
			}
			?>
        </section>
    </div><!-- .main -->
<?php
if ( '1' === $get_content_position ) {
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
            </article>
			<?php
		}
	}
}