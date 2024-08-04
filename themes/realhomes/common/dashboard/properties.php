<?php
global $paged, $posts_per_page, $property_status_filter, $dashboard_posts_query;

if (isset($_GET['deleted']) && (1 == intval($_GET['deleted']))) {
	realhomes_dashboard_notice(
		array(
			esc_html__('Success:', 'framework'),
			esc_html__('Property removed successfully!', 'framework')
		),
		'success',
		true
	);
} elseif (isset($_GET['property-added']) && (true == $_GET['property-added'])) {
	realhomes_dashboard_notice(
		array(
			esc_html__('Success:', 'framework'),
			get_option('theme_submit_message')
		),
		'success',
		true
	);
} elseif (isset($_GET['property-updated']) && (true == $_GET['property-updated'])) {
	realhomes_dashboard_notice(
		array(
			esc_html__('Success:', 'framework'),
			esc_html__('Property updated successfully!', 'framework')
		),
		'success',
		true
	);
} elseif (isset($_GET['payment']) && ('paid' == $_GET['payment'])) {
	realhomes_dashboard_notice(
		array(
			esc_html__('Success:', 'framework'),
			esc_html__('Payment Submitted.', 'framework')
		),
		'success',
		true
	);
} elseif (isset($_GET['payment']) && ('failed' == $_GET['payment'])) {
	realhomes_dashboard_notice(
		array(
			esc_html__('Error:', 'framework'),
			esc_html__('Payment Failed.', 'framework')
		),
		'error',
		true
	);
}

if (class_exists('IMS_Helper_Functions') && !empty(IMS_Helper_Functions::is_memberships())) {
	if (empty(get_user_meta(wp_get_current_user()->ID, 'ims_current_membership', true))) {
		realhomes_dashboard_notice(esc_html__('Please subscribe a membership package to start publishing properties.', 'framework'));
	}
}

$posts_per_page = realhomes_dashboard_posts_per_page();

$property_statuses = array('publish', 'private', 'draft', 'pending', 'future');
if (isset($_GET['status']) && !empty($_GET['status'])) {
	if (in_array($_GET['status'], $property_statuses)) {
		$property_statuses = array(sanitize_text_field($_GET['status']));
	}
}

$current_user = wp_get_current_user();

$properties_args = array(
	'authors' => [$current_user->ID],
);

$user_role = get_user_meta($current_user->ID, 'inspiry_user_role', true);
$user_post_id = get_user_meta($current_user->ID, 'inspiry_role_post_id', true);

if ($user_role === 'agency' && $user_post_id) {
	// Get all users when inspiry_user_role is agent, and inspiry_user_agency === user_post_id
	$agent_user_ids = get_users(
		array(
			'meta_key' => 'inspiry_user_agency',
			'meta_value' => $user_post_id,
			'fields' => 'ID'
		)
	);

	// Remove duplicates
	$agent_user_ids = array_unique($agent_user_ids);

	if (!empty($agent_user_ids)) {
		$properties_args['authors'] = array_merge($properties_args['authors'], $agent_user_ids);
	}
} elseif ($user_role === 'agent' && $user_post_id) {
	unset($properties_args['authors']);
}

// Use sql query to get the properties instead of WP_Query
$query = 'SELECT * FROM ' . $wpdb->prefix . 'posts WHERE post_type = "property"';

// Add search query
if (isset($_GET['posts_search']) && 'show' == get_option('inspiry_my_properties_search', 'show')) {
	$search_query = sanitize_text_field($_GET['posts_search']);
	$search_query = '%' . $search_query . '%';

	// Search in post title, content, and meta value (REAL_HOMES_property_address or REAL_HOMES_property_id)
	$query .= ' AND (post_title LIKE ' . $wpdb->prepare('%s', $search_query) . ' OR post_content LIKE ' . $wpdb->prepare('%s', $search_query) . ' OR ID IN (SELECT post_id FROM ' . $wpdb->prefix . 'postmeta WHERE meta_key = "REAL_HOMES_property_address" AND meta_value LIKE ' . $wpdb->prepare('%s', $search_query) . ') OR ID IN (SELECT post_id FROM ' . $wpdb->prefix . 'postmeta WHERE meta_key = "REAL_HOMES_property_id" AND meta_value LIKE ' . $wpdb->prepare('%s', $search_query) . '))';

	printf('<div class="dashboard-notice"><p>%s <strong>%s</strong></p></div>', esc_html__('Search results for: ', 'framework'), esc_html($_GET['posts_search']));
}

$property_status_filter = realhomes_dashboard_properties_status_filter();
if ('-1' !== $property_status_filter) {
	$query .= $wpdb->prepare(' AND ID IN (SELECT object_id FROM ' . $wpdb->prefix . 'term_relationships WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM ' . $wpdb->prefix . 'term_taxonomy WHERE taxonomy = "property-status" AND term_id IN (SELECT term_id FROM ' . $wpdb->prefix . 'terms WHERE slug = %s)))', $property_status_filter);
}

// Add property statuses
$placeholders = array_fill(0, count($property_statuses), '%s');
$all_status = implode(', ', $placeholders);
$query .= $wpdb->prepare(" AND post_status IN ($all_status)", $property_statuses);

if ($user_role === 'agent' && $user_post_id) {
	$query .= ' AND ID IN (SELECT post_id FROM ' . $wpdb->prefix . 'postmeta WHERE meta_key = "REAL_HOMES_agents" AND meta_value = ' . $user_post_id . ')';
}

if (isset($properties_args['authors']) && !empty($properties_args['authors'])) {
	$placeholders = array_fill(0, count($properties_args['authors']), '%d');
	$all_authors = implode(', ', $placeholders);
	$query .= $wpdb->prepare(" AND post_author IN ($all_authors)", $properties_args['authors']);
}

$query .= ' ORDER BY post_date DESC';

$query_without_pagination = $query;
$query_without_pagination = preg_replace('/^SELECT \* FROM/', 'SELECT COUNT(*) FROM', $query_without_pagination);

// Add pagination
if ($paged > 1) {
	$offset = ($paged - 1) * $posts_per_page;
	$query .= $wpdb->prepare(' LIMIT %d, %d', $offset, $posts_per_page);
} else {
	$query .= $wpdb->prepare(' LIMIT %d', $posts_per_page);
}

$dashboard_posts = $wpdb->get_results($query);
$dashboard_posts_count = $wpdb->get_var($query_without_pagination);

class PostQuery
{
	public $found_posts;
	public $max_num_pages;
	public $post_count;
	public $query_vars;

	public function __construct($args)
	{
		foreach ($args as $key => $value) {
			$this->$key = $value;
		}
	}
	public function have_posts()
	{
		return isset($this->post_count) && $this->post_count > 0;
	}
}
$dashboard_posts_query = new PostQuery([
	'found_posts' => $dashboard_posts_count,
	'max_num_pages' => ceil($dashboard_posts_count / $posts_per_page),
	'post_count' => count($dashboard_posts),
	'query_vars' => [
		'posts_per_page' => $posts_per_page,
		'paged' => $paged,
		'post_status' => $property_statuses,
	],
]);

do_action('inspiry_before_my_properties_page_render', get_the_ID());
?>
<div id="property-message"></div>

<?php
// if ($dashboard_posts_query->have_posts()) {
if (!empty($dashboard_posts)) {
	?>
	<div id="dashboard-properties" class="dashboard-properties dashboard-content-inner">
		<?php
		// Adding top nav
		get_template_part('common/dashboard/top-nav');
		?>
		<div class="dashboard-posts-list">
			<?php get_template_part('common/dashboard/property-columns'); ?>
			<div class="dashboard-posts-list-body">
				<?php
				foreach ($dashboard_posts as $dashboard_post) {
					$post = get_post($dashboard_post->ID);
					setup_postdata($post);
					get_template_part('common/dashboard/property-card');
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
		<?php get_template_part('common/dashboard/bottom-nav'); ?>
	</div><!-- #dashboard-favorites -->
	<?php
} else {
	realhomes_dashboard_no_items('', '', 'no-property.svg');
}
?>