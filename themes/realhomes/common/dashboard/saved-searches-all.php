<?php
/**
 * Dashboard: All Users Saved Searches Page
 *
 * @since   4.0.1
 * @package realhomes/dashboard
 */
if ( ! current_user_can( 'administrator' ) ) {
	return;
}

global $wpdb;
$all_users  = get_users();
$table_name = $wpdb->prefix . 'realhomes_saved_searches';

realhomes_dashboard_notice(
	array(
		esc_html__( 'Welcome to Saved Searches!', 'framework' ),
		esc_html__( 'You will get email updates about latest properties that will match your saved search criteria.', 'framework' )
	),
	'info',
	true
);
?>
    <div id="saved-searches" class="saved-searches">
		<?php
		foreach ( $all_users as $user ) {
			$user_id        = $user->ID;
			$saved_searches = $wpdb->get_results( 'SELECT * FROM ' . $table_name . ' WHERE user_id = ' . $user_id . ' ORDER BY id DESC', OBJECT );
			if ( ! empty( $saved_searches ) && is_array( $saved_searches ) ) {
				?>
                <div class="dashboard-posts-users-list" data-user-id="<?php echo esc_attr( $user->data->ID ) ?>">
                    <h3><?php echo esc_html( $user->data->user_login ) ?></h3>
                    <div class="dashboard-posts-list">
                        <div class="dashboard-posts-list-body">
							<?php
							foreach ( $saved_searches as $search_data ) {
								$args = array(
									'search_data' => $search_data,
									'separator'   => '<span>|</span>',
								);
								get_template_part( 'common/dashboard/saved-search-item', '', $args );
							}
							?>
                        </div>
                    </div>
                </div>
				<?php
			}
		}
		?>
    </div>
<?php