<?php
/**
 * Manages the display of the agencies posts page in the dashboard.
 *
 * This file is responsible for handling the presentation and functionality
 * related to the agencies posts page in the dashboard of the RealHomes theme.
 *
 * @since      4.3.0
 * @package    realhomes
 * @subpackage dashboard
 */

global $paged, $posts_per_page, $property_status_filter, $dashboard_posts_query;

if ( isset( $_GET['agency-added'] ) && ( 'true' === $_GET['agency-added'] ) ) {
	realhomes_dashboard_notice(
		array(
			esc_html__( 'Success:', 'framework' ),
			esc_html__( 'Agency added successfully!', 'framework' )
		),
		'success',
		true
	);
} else if ( isset( $_GET['agency-updated'] ) && ( 'true' === $_GET['agency-updated'] ) ) {
	realhomes_dashboard_notice(
		array(
			esc_html__( 'Success:', 'framework' ),
			esc_html__( 'Agency info updated successfully!', 'framework' )
		),
		'success',
		true
	);
}

$post_statuses = array(
	'publish',
	'pending',
	'draft'
);

if ( isset( $_GET['property_status_filter'] ) && in_array( $_GET['property_status_filter'], $post_statuses ) ) {
	$property_status_filter = sanitize_text_field( $_GET['property_status_filter'] );
	$post_statuses          = array( $property_status_filter );
} else {
	$property_status_filter = '-1';
}

$posts_per_page = realhomes_dashboard_posts_per_page();
$current_user   = wp_get_current_user();
$post_args      = array(
	'post_type'      => 'agency',
	'posts_per_page' => $posts_per_page,
	'paged'          => $paged,
	'post_status'    => $post_statuses,
	'author'         => $current_user->ID,
);

$dashboard_posts_query = new WP_Query( apply_filters( 'realhomes_dashboard_agency_post_args', $post_args ) );

do_action( 'realhomes_before_agency_page_render', get_the_ID() );
?>
<div id="agency-message"></div>

<?php
if ( $dashboard_posts_query->have_posts() ) {
	?>
    <div id="dashboard-agencies" class="dashboard-agencies dashboard-content-inner">
		<?php
		// Adding top nav
		get_template_part( 'common/dashboard/top-nav' );
		?>
        <div class="dashboard-posts-list">
			<?php get_template_part( 'common/dashboard/agency-columns' ); ?>
            <div class="dashboard-posts-list-body">
				<?php
				while ( $dashboard_posts_query->have_posts() ) {
					$dashboard_posts_query->the_post();
					get_template_part( 'common/dashboard/agency-card' );
				}
				wp_reset_postdata();
				?>
            </div>
        </div>
		<?php get_template_part( 'common/dashboard/bottom-nav' ); ?>
    </div><!-- #dashboard-agencies -->
	<?php
} else {
	realhomes_dashboard_no_items(
		esc_html__( 'No Agency Found!', 'framework' ),
		esc_html__( 'There are no agencies falling under this criteria.', 'framework' )
	);
}
?>