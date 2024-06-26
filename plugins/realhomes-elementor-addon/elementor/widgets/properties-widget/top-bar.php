<?php
/**
 * This file contains the Ultra properties widget top bar.
 *
 * @version 2.3.0
 */

global $settings, $widget_id, $properties_query, $paged, $column_classes;

if ( 'yes' === $settings['enable_top_bar'] ) {
	$page_id = get_the_ID();
	?>
    <div class="rhea-ultra-properties-top-bar">
        <div class="rhea-ultra-properties-top-bar-stats-wrapper">
			<?php
			if ( 'yes' === $settings['enable_statistics'] ) {
				$found_properties = $properties_query->found_posts;
				$per_page         = $properties_query->query_vars['posts_per_page'];
				$state_first      = ( $per_page * $paged ) - $per_page + 1;
				$state_last       = min( $found_properties, $per_page * $paged );
				?>
                <p class="rhea-ultra-properties-stats" data-page="<?php echo intval( $paged ); ?>" data-max="<?php echo intval( $properties_query->max_num_pages ); ?>" data-total-properties="<?php echo intval( $found_properties ); ?>" data-page-id="<?php echo intval( $page_id ); ?>">
					<?php
					if ( $found_properties > 0 && ( $found_properties >= $per_page || -1 !== $per_page ) ) {
						?>
                        <span><?php echo intval( $state_first ); ?></span>
						<?php esc_html_e( 'to', 'realhomes-elementor-addon' ); ?>
                        <span><?php echo intval( $state_last ); ?></span>
						<?php esc_html_e( 'out of ', 'realhomes-elementor-addon' ); ?>
                        <span><?php echo intval( $found_properties ); ?></span>
						<?php esc_html_e( 'properties', 'realhomes-elementor-addon' ); ?><?php
					}
					?>
                </p>
				<?php
			}
			?>
        </div><!-- .rhea-ultra-properties-top-bar-stats-wrapper -->
        <div class="rhea-ultra-properties-top-bar-sorting-and-view">
			<?php
			if ( 'yes' === $settings['enable_frontend_sorting'] ) {
				?>
                <div class="rhea-ultra-properties-top-bar-sort-controls">
                    <label for="sort-properties"><?php esc_html_e( 'Sort By:', 'realhomes-elementor-addon' ); ?></label>
					<?php
					$sort_by = '';
					if ( ! empty( $_GET['sortby'] ) ) {
						$sort_by = sanitize_text_field( $_GET['sortby'] );
					}
					?>
                    <select name="sort-properties" id="sort-properties" class="inspiry_select_picker_trigger rh-ultra-select-dropdown show-tick">
                        <option value="default"><?php esc_html_e( 'Default Order', 'realhomes-elementor-addon' ); ?></option>
                        <option value="title-asc" <?php echo ( 'title-asc' == $sort_by ) ? 'selected' : ''; ?>><?php esc_html_e( 'Property Title A to Z', 'realhomes-elementor-addon' ); ?></option>
                        <option value="title-desc" <?php echo ( 'title-desc' == $sort_by ) ? 'selected' : ''; ?>><?php esc_html_e( 'Property Title Z to A', 'realhomes-elementor-addon' ); ?></option>
                        <option value="price-asc" <?php echo ( 'price-asc' == $sort_by ) ? 'selected' : ''; ?>><?php esc_html_e( 'Price Low to High', 'realhomes-elementor-addon' ); ?></option>
                        <option value="price-desc" <?php echo ( 'price-desc' == $sort_by ) ? 'selected' : ''; ?>><?php esc_html_e( 'Price High to Low', 'realhomes-elementor-addon' ); ?></option>
                        <option value="date-asc" <?php echo ( 'date-asc' == $sort_by ) ? 'selected' : ''; ?>><?php esc_html_e( 'Date Old to New', 'realhomes-elementor-addon' ); ?></option>
                        <option value="date-desc" <?php echo ( 'date-desc' == $sort_by ) ? 'selected' : ''; ?>><?php esc_html_e( 'Date New to Old', 'realhomes-elementor-addon' ); ?></option>
                    </select>
                </div><!-- .rhea-ultra-properties-sort-controls -->
				<?php
			}

			if ( 'yes' === $settings['enable_layout_toggle_buttons'] ) {
				?>
                <div class="rhea-ultra-properties-top-bar-view-type rh-ultra-view-type">
					<?php
					$layout   = '';
					$page_url = '';

					if ( is_tax() ) {
						$term_link = get_term_link( get_queried_object()->term_id );
						if ( ! is_wp_error( $term_link ) ) {
							$page_url = $term_link;
						}
					} else {
						$page_url = get_permalink( $page_id );
					}

					$separator = ( null == parse_url( $page_url, PHP_URL_QUERY ) ) ? '?' : '&';

					if ( isset( $_GET['rhea-properties-view'] ) && in_array( $_GET['rhea-properties-view'], array( 'grid', 'list' ) ) ) {
						$layout = sanitize_text_field( $_GET['rhea-properties-view'] );
					} else {
						if ( $settings['layout'] && in_array( $settings['layout'], array( 'grid', 'list' ) ) ) {
							$layout = $settings['layout'];
						}
					}
					?>
                    <a class="grid <?php echo ( 'grid' === $layout ) ? 'active' : ''; ?>" href="<?php echo esc_url( $page_url . $separator . 'rhea-properties-view=grid' ); ?>">
						<?php rhea_safe_include_svg( 'icons/icon-sort-grid.svg' ); ?>
                    </a>
                    <a class="list <?php echo ( 'list' === $layout ) ? 'active' : ''; ?>" href="<?php echo esc_url( $page_url . $separator . 'rhea-properties-view=list' ); ?>">
						<?php rhea_safe_include_svg( 'icons/icon-sort-list.svg' ); ?>
                    </a>
                </div><!-- .rhea-ultra-properties-view-type -->
				<?php
			}
			?>
        </div><!-- .rhea-ultra-properties-top-bar-sorting-and-view -->
    </div><!-- .rhea-ultra-properties-top-bar -->
	<?php
}