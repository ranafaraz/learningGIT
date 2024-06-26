<?php
/**
 * Taxonomy: Title
 *
 * Title of taxonomy.
 *
 * @since    3.0.0
 * @package realhomes/modern
 */

global $paged, $wp_query;

// Taxonomy Title.
$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$page_title   = $current_term->name;

// Page Head.
$header_variation = get_option( 'inspiry_listing_header_variation' );
?>
    <div class="rh_page__head">
        <div class="head-left">
			<?php
			if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
				?>
                <h2 class="rh_page__title rh_page__title_pad">
					<?php inspiry_get_exploded_heading( $page_title ); ?>
                </h2><!-- /.rh_page__title -->
				<?php
			}

			// Adding pagination stats
			if ( $paged === 0 || $paged === - 1 ) {
				$current_page = 1;
			} else {
				$current_page = $paged;
			}
			$found_properties = $wp_query->found_posts;
			$per_page         = $wp_query->query_vars['posts_per_page'];
			$state_first      = ( $per_page * $current_page ) - $per_page + 1;
			$state_last       = min( $found_properties, $per_page * $current_page );
			?>
            <p class="rh_pagination__stats" data-page="<?php echo intval( $paged ); ?>" data-max="<?php echo intval( $wp_query->max_num_pages ); ?>" data-total-properties="<?php echo intval( $found_properties ); ?>" data-page-id="<?php echo intval( $current_term->term_id ); ?>" data-is-taxonomy="true">
				<?php
				if (
					$found_properties > 0
					&& ( $found_properties >= $per_page || - 1 !== $per_page )
				) {
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
        </div>

        <div class="rh_page__controls">
			<?php
            get_template_part( 'assets/modern/partials/properties/sort-controls' );

            if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
                get_template_part( 'assets/modern/partials/properties/view-buttons' );
            }
            ?>
        </div><!-- /.rh_page__controls -->
    </div><!-- /.rh_page__head -->

<?php inspiry_term_description(); ?>