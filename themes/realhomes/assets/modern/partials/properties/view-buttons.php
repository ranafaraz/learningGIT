<?php
/**
 * Listing View Buttons
 *
 * View buttons for property listing.
 *
 * @since    3.0.0
 * @package  realhomes/modern
 */

$page_id = get_the_ID();
?>
<div class="rh_view_type">
	<?php
	$page_url = null;
	// Page url.
	if ( is_post_type_archive( 'property' ) ) {
		$page_url = get_post_type_archive_link( 'property' );
	} else if ( is_tax() ) {

		$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$page_url     = get_term_link( $current_term );

	} else {
		global $post;
		$page_url = get_permalink( $page_id );
	}

	// Separator.
	$separator = ( null == parse_url( $page_url, PHP_URL_QUERY ) ) ? '?' : '&';

	// View Type.
	$view_type = 'list';
	if ( isset( $_GET['view'] ) ) {
		if ( 'grid' === $_GET['view'] ) {
			$view_type = 'grid';
		}
	} else {
		if ( is_page_template( array( 'templates/grid-layout.php', 'templates/grid-layout-full-width.php' ) ) ) {
			$view_type = 'grid';
		}
	}

	if ( is_page_template( 'templates/properties.php' ) ) {
		if ( 'grid' === get_post_meta( $page_id, 'realhomes_property_card', true ) ) {
			$view_type = 'grid';
		}
	}
	?>
    <a class="grid <?php echo ( 'grid' === $view_type ) ? 'active' : ''; ?>" href="<?php echo esc_url( $page_url . $separator . 'view=grid' ); ?>">
		<?php inspiry_safe_include_svg( '/images/icons/icon-sort-grid.svg' ); ?>
    </a>
    <a class="list <?php echo ( 'list' === $view_type ) ? 'active' : ''; ?>" href="<?php echo esc_url( $page_url . $separator . 'view=list' ); ?>">
		<?php inspiry_safe_include_svg( '/images/icons/icon-sort-list.svg' ); ?>
    </a>
</div><!-- .rh_view_type -->