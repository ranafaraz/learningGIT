<?php
global $paged, $posts_per_page, $property_status_filter, $dashboard_posts_query, $current_module;

$show_filter = in_array( $current_module, array( 'properties', 'favorites', 'agents', 'agencies', 'bookings', 'reservations' ) );
?>
<div class="dashboard-posts-list-topnav">
	<?php
	if ( $show_filter ) {
		?>
        <select name="property_status_filter" id="property-status-filter" class="noJs-select">
			<?php
			printf( '<option value="" %1$s>%2$s</option>', selected( $property_status_filter, '-1', false ), esc_html__( 'All', 'framework' ) );

			if ( in_array( $current_module, array( 'agents', 'agencies' ) ) ) {
				$post_statuses = array(
					'publish' => esc_html__( 'Publish', 'framework' ),
					'pending' => esc_html__( 'Pending', 'framework' ),
					'draft'   => esc_html__( 'Draft', 'framework' ),
				);

				if ( ! empty( $post_statuses ) ) {
					foreach ( $post_statuses as $post_slug => $post_name ) {
						printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $post_slug ), selected( esc_attr( $property_status_filter ), $post_slug, false ), esc_html( $post_name ) );
					}
				}

			} else if ( 'bookings' === $current_module || 'reservations' === $current_module ) {
				$booking_statuses = array(
					'confirmed' => esc_html__( 'Confirmed', 'framework' ),
					'pending'   => esc_html__( 'Pending', 'framework' ),
					'cancelled' => esc_html__( 'Cancelled', 'framework' ),
					'rejected'  => esc_html__( 'Rejected', 'framework' ),
				);

				if ( ! empty( $booking_statuses ) ) {
					foreach ( $booking_statuses as $term_slug => $term_name ) {
						printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $term_slug ), selected( esc_attr( $_GET['property_status_filter'] ), $term_slug, false ), esc_html( $term_name ) );
					}
				}

			} else if ( class_exists( 'ERE_Data' ) ) {
				$all_statuses = ERE_Data::get_statuses_slug_name();
				if ( ! empty( $all_statuses ) ) {
					foreach ( $all_statuses as $term_slug => $term_name ) {
						printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $term_slug ), selected( $property_status_filter, $term_slug, false ), esc_html( $term_name ) );
					}
				}
			}
			?>
        </select>
		<?php
	}
	?>

    <ul id="paging-entries" class="paging-entries">
		<?php
		$posts_per_page_list = realhomes_dashboard_posts_per_page_list();
		if ( is_array( $posts_per_page_list ) && ! empty( $posts_per_page_list ) ) {
			?>
            <li><?php esc_html_e( 'Show', 'framework' ); ?></li>
            <li class="posts-per-page-filter-wrap">
                <select id="posts-per-page" name="posts_per_page" class="noJs-select">
					<?php
					if ( ! empty( $_GET['posts_per_page'] ) ) {
						$selected_posts_per_page = $_GET['posts_per_page'];
					} else {
						$selected_posts_per_page = realhomes_dashboard_posts_per_page();
					}

					foreach ( $posts_per_page_list as $number ) {
						if ( 'All' === $number ) {
							printf( '<option value="-1" %1$s>%2$s</option>', selected( esc_attr( $selected_posts_per_page ), '-1', false ), esc_html__( 'All', 'framework' ) );
						} else {
							printf( '<option value="%1$s" %2$s>%1$s</option>', esc_attr( $number ), selected( esc_attr( $selected_posts_per_page ), $number, false ) );
						}
					}
					?>
                </select>
            </li>
            <li><?php esc_html_e( 'Entries', 'framework' ); ?></li>
			<?php
		}

		$found_posts = $dashboard_posts_query->found_posts;
		if ( $found_posts ) {
			?>
            <li class="paging">
				<?php
				$pagenum = ( $dashboard_posts_query->query_vars['paged'] < 1 ) ? 1 : $dashboard_posts_query->query_vars['paged'];
				$start   = ( ( $pagenum - 1 ) * $dashboard_posts_query->query_vars['posts_per_page'] ) + 1;
				$end     = ( $start + $dashboard_posts_query->post_count ) - 1;
				?>
                <span class="displaying-num"><span class="start-num"><?php echo esc_html( $start ); ?></span> - <span class="end-num"><?php echo esc_html( $end ); ?></span></span>
                <span class="paging-text"><?php esc_html_e( ' of ', 'framework' ); ?></span>
                <span class="total-posts"><?php echo esc_html( $found_posts ); ?></span>
            </li>
			<?php
		}
		?>
    </ul>
</div>