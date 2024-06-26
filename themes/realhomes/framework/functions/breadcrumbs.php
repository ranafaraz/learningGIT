<?php
/**
 * Property Breadcrumbs related functions
 */
if ( ! function_exists( 'inspiry_get_breadcrumbs_items' ) ) {
	/**
	 * Returns an array of breadcrumbs items
	 *
	 * @param $post_id              int Post id.
	 * @param $breadcrumbs_taxonomy string Taxonomy name.
	 * @param $skip_home            bool skip home entry or not.
	 *
	 * @return mixed|void
	 */
	function inspiry_get_breadcrumbs_items( $post_id, $breadcrumbs_taxonomy, $skip_home = false ) {

		// Add home at the beginning of the breadcrumbs.
		$inspiry_breadcrumbs_items = array();

		if ( ! $skip_home ) {
			$inspiry_breadcrumbs_items[] = array(
				'name' => esc_html__( 'Home', 'framework' ),
				'url'  => esc_url( home_url( '/' ) ),
			);
		}

		// Get all assigned terms.
		$the_terms = get_the_terms( $post_id, $breadcrumbs_taxonomy );

		if ( $the_terms && ! is_wp_error( $the_terms ) ) :

			$deepest_term  = $the_terms[0];
			$deepest_depth = 0;

			// Find the deepest term.
			foreach ( $the_terms as $term ) {
				$current_term_depth = inspiry_get_term_depth( $term->term_id, $breadcrumbs_taxonomy );
				if ( $current_term_depth > $deepest_depth ) {
					$deepest_depth = $current_term_depth;
					$deepest_term  = $term;
				}
			}

			// work on deepest term.
			if ( $deepest_term ) {

				// Get ancestors if any and add them to breadcrumbs items.
				$deepest_term_ancestors = get_ancestors( $deepest_term->term_id, $breadcrumbs_taxonomy );
				if ( $deepest_term_ancestors && ( 0 < count( $deepest_term_ancestors ) ) ) {
					$deepest_term_ancestors = array_reverse( $deepest_term_ancestors ); // reversing the array is important
					foreach ( $deepest_term_ancestors as $term_ancestor_id ) {
						$ancestor_term               = get_term_by( 'id', $term_ancestor_id, $breadcrumbs_taxonomy );
						$inspiry_breadcrumbs_items[] = array(
							'name' => $ancestor_term->name,
							'url'  => get_term_link( $ancestor_term, $breadcrumbs_taxonomy ),
						);
					}
				}

				// add deepest term.
				$inspiry_breadcrumbs_items[] = array(
					'name'  => $deepest_term->name,
					'url'   => get_term_link( $deepest_term, $breadcrumbs_taxonomy ),
					'class' => '',
				);

			}

		endif;

		return apply_filters( 'inspiry_breadcrumbs_items', $inspiry_breadcrumbs_items );
	}
}

if ( ! function_exists( 'inspiry_get_term_depth' ) ) {
	/**
	 * Returns an integer value that tells the term depth in its hierarchy.
	 *
	 * @param $term_id
	 * @param $term_taxonomy
	 *
	 * @return int
	 */
	function inspiry_get_term_depth( $term_id, $term_taxonomy ) {
		$term_ancestors = get_ancestors( $term_id, $term_taxonomy );
		if ( $term_ancestors ) {
			return count( $term_ancestors );
		}

		return 0;
	}
}

if ( ! function_exists( 'realhomes_breadcrumbs' ) ) {
	/**
	 * Displays page breadcrumbs.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	function realhomes_breadcrumbs() {
		// Get the query & post information
		global $post;

		$home_link   = get_bloginfo( 'url' );
		$item_format = '<li class="breadcrumb-item active">' . '%1$s' . '</li>';
		$link_format = '<li class="breadcrumb-item">' . '<a href="%1$s">%2$s</a>' . '</li>';
		$archives    = esc_html__( ' Archives', 'framework' );
		$post_type   = get_post_type();

		// Build the Breadcrumbs
		$output = '<nav class="rh-page-breadcrumbs">';
		$output .= '<ol class="breadcrumbs">';
		$output .= sprintf( $link_format, esc_url( $home_link ), esc_html__( 'Home', 'framework' ) );

		if ( is_home() || ( is_single() && 'post' === $post_type ) ) {
			// Static blog page ID.
			$page_id = get_option( 'page_for_posts' );
			if ( ! empty( $page_id ) ) {
				$output .= sprintf( $item_format, esc_html( get_the_title( $page_id ) ) );
			} else {
				// Get blog page title from customizer setting.
				$page_title = get_option( 'theme_news_banner_title' );
				if ( empty( $page_title ) ) {
					// Default title for blog page.
					$page_title = esc_html__( 'News', 'framework' );
				}
				$output .= sprintf( $item_format, esc_html( $page_title ) );
			}

		} else {

			if ( is_singular( 'agent' ) ) {
				$output .= sprintf( $link_format, esc_url( get_post_type_archive_link( 'agent' ) ), esc_html__( 'Agents', 'framework' ) );
				$output .= sprintf( $item_format, esc_html( get_the_title() ) );

			} else if ( is_singular( 'agency' ) ) {
				$output .= sprintf( $link_format, esc_url( get_post_type_archive_link( 'agency' ) ), esc_html__( 'Agencies', 'framework' ) );
				$output .= sprintf( $item_format, esc_html( get_the_title() ) );

			} else if ( function_exists( 'is_product' ) && is_product() ) {
				$output .= sprintf( $link_format, esc_url( get_post_type_archive_link( 'product' ) ), esc_html__( 'Shop', 'framework' ) );
				$output .= sprintf( $item_format, esc_html( get_the_title() ) );

			} else if ( is_page() ) {
				if ( $post->post_parent ) {
					$anc = get_post_ancestors( $post->ID );
					$anc = array_reverse( $anc );

					$page_parents = '';
					foreach ( $anc as $ancestor ) {
						$page_parents .= sprintf( $link_format, esc_url( get_permalink( $ancestor ) ), esc_html( get_the_title( $ancestor ) ) );
					}

					$output .= $page_parents;
				}

				// Just display current page if not parents
				$output .= sprintf( $item_format, esc_html( get_the_title() ) );

			} else if ( is_category() || is_tax() ) {
				if ( is_tax() ) {
					// If it is a custom post type display name and link
					if ( $post_type != 'post' ) {
						$post_type_object  = get_post_type_object( $post_type );
						$post_type_archive = get_post_type_archive_link( $post_type );
						if ( ! is_null( $post_type_object ) ) {
							$output .= sprintf( $link_format, esc_url( $post_type_archive ), esc_html( $post_type_object->labels->name ) );
						}
					}
					$output .= sprintf( $item_format, esc_html( single_term_title( '', false ) ) );

				} else {
					$output .= sprintf( $item_format, esc_html( single_cat_title( '', false ) ) );
				}

			} else if ( is_tag() ) {
				$output .= sprintf( $item_format, esc_html( single_tag_title( '', false ) ) );

			} else if ( is_day() ) {
				$output .= sprintf( $link_format, esc_url( get_year_link( get_the_time( 'Y' ) ) ), esc_html( get_the_time( 'Y' ) . $archives ) );
				$output .= sprintf( $link_format, esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), esc_html( get_the_time( 'M' ) . $archives ) );
				$output .= sprintf( $item_format, esc_html( get_the_time( 'M' ) . $archives ) );

			} else if ( is_month() ) {
				$output .= sprintf( $link_format, esc_url( get_year_link( get_the_time( 'Y' ) ) ), esc_html( get_the_time( 'Y' ) . $archives ) );
				$output .= sprintf( $item_format, esc_html( get_the_time( 'M' ) . $archives ) );

			} else if ( is_year() ) {
				$output .= sprintf( $item_format, esc_html( get_the_time( 'Y' ) . $archives ) );

			} else if ( is_author() ) {
				$output .= sprintf( $item_format, esc_html__( 'Author', 'framework' ) );

			} else if ( is_archive() ) {
				$output .= sprintf( $item_format, post_type_archive_title( '', false ) );

			} else if ( is_search() ) {
				$output .= sprintf( $item_format, esc_html__( 'Search', 'framework' ) );

			} else if ( is_404() ) {
				$output .= sprintf( $item_format, esc_html__( 'Error 404', 'framework' ) );

			}
		}

		$output .= '</ol>';
		$output .= '</nav>';

		echo $output;
	}
}
