<?php
/**
 * Dashboard: Invoices List
 *
 * @since      4.3.0
 * @subpackage dashboard
 * @package    realhomes
 */

global $paged, $posts_per_page, $property_status_filter, $dashboard_posts_query, $current_module;

$current_user = wp_get_current_user();

$invoices_args = array(
	'post_type'   => 'invoice',
	'post_status' => 'publish',
	'paged'       => $paged,
	'author'      => $current_user->ID,
);

// Posts per page parameter
$invoices_args['posts_per_page'] = realhomes_dashboard_posts_per_page();

/**
 * Add searched parameter.
 * Note: Adding based on the properties settings.
 */
if ( isset( $_GET['posts_search'] ) && 'show' == get_option( 'inspiry_my_properties_search', 'show' ) ) {
	$invoices_args['s'] = sanitize_text_field( $_GET['posts_search'] );
	printf( '<div class="dashboard-notice"><p>%s <strong>%s</strong></p></div>', esc_html__( 'Search results for: ', 'framework' ), esc_html( $_GET['posts_search'] ) );
}

$dashboard_posts_query = new WP_Query( apply_filters( 'realhomes_dashboard_invoices_args', $invoices_args ) );

if ( $dashboard_posts_query->have_posts() ) {
	?>
    <div id="dashboard-invoices" class="dashboard-invoices dashboard-content-inner">
		<?php
		get_template_part( 'common/dashboard/top-nav' );
		?>
        <div class="dashboard-posts-list dashboard-invoices-list">
			<?php get_template_part( 'common/dashboard/partials/invoice-columns' ); ?>
            <div class="dashboard-posts-list-body">
				<?php
				while ( $dashboard_posts_query->have_posts() ) {
					$dashboard_posts_query->the_post();
					get_template_part( 'common/dashboard/partials/invoice-card' );
				}
				wp_reset_postdata();
				?>
            </div>
        </div>
		<?php get_template_part( 'common/dashboard/bottom-nav' ); ?>
    </div><!-- #dashboard-invoices -->
	<?php
} else {
	$invoice_not_found_title = esc_html__( 'No Invoice Found!', 'framework' );
	$invoice_not_found_desc  = esc_html__( 'There are no invoices available to show.', 'framework' );
	realhomes_dashboard_no_items( $invoice_not_found_title, $invoice_not_found_desc );
}