<?php
/**
 * This file contains Property_Analytics_View class and 'inspiry_get_property_views' Ajax handler
 * to display property analytics data.
 *
 * @since 3.10
 * @package easy_real_estate
 */

/**
 * Property_Analytics_View class is responsible to display properties' views data.
 */
class Property_Analytics_View {

	/**
	 * ID of the property that will be used as 'key' to reterive property views data.
	 *
	 * @var int $property_id
	 */
	private $property_id;

	/**
	 * Constructor function that set the class data variable on instantiating.
	 *
	 * @param int $property_id ID of the property that will be used as 'key' to reterive property views data.
	 *
	 * @return void
	 */
	public function __construct( $property_id = 0 ) {
		if ( ! empty( $property_id ) ) {
			$this->property_id = $property_id;
		} else {
			global $wp_query;
			if ( is_object( $wp_query->post ) ) {
				$this->property_id = $wp_query->post;
			}
		}
	}

	/**
	 * Return views based on given Type and Date.
	 *
	 * @param string $type Property views type that's required. By default all views will be returned.
	 * @param string $date The date for which property views are required. By default views will be returned for all dates.
	 *
	 * @return string Count of property views.
	 */
	public function get_views( $type = 'all', $date = '' ) {

		global $wpdb;
		$table_name  = $wpdb->prefix . "inspiry_property_analytics";
		$property_id = $this->property_id;

		switch ( $type ) {
			// Getting property's unique views
			case 'property_unique_views':
				$unique_args['post_id'] = $property_id;
				$unique_args['unique']  = true;
				if ( ! empty( $date ) ) {
					$day_time_start_string     = date( 'Y-m-d ' . '00:00:00', $date );
					$day_time_end_string       = date( 'Y-m-d ' . '23:59:59', $date );
					$unique_args['time_start'] = strtotime( $day_time_start_string );
					$unique_args['time_end']   = strtotime( $day_time_end_string );
				}
				$views  = ere_get_properties_by_time_period( $unique_args );
				$result = $views[0]->PID;
				break;
			case 'property_today_views':
				// Getting property's today's views
				$date                         = empty( $date ) ? time() : $date;
				$day_time_start_string        = date( 'Y-m-d ' . '00:00:00', $date );
				$day_time_end_string          = date( 'Y-m-d ' . '23:59:59', $date );
				$day_times_args['time_start'] = strtotime( $day_time_start_string );
				$day_times_args['time_end']   = strtotime( $day_time_end_string );
				$day_times_args['post_id']    = $property_id;
				$views                        = ere_get_properties_by_time_period( $day_times_args );
				$result                       = $views[0]->PID;
				break;
			case 'property_total_views':
				// Getting property's total views
				$sql_query = "SELECT COUNT(PID) FROM {$table_name} WHERE PID = {$property_id}";
				$result    = $wpdb->get_var( $sql_query ); // phpcs:ignore
				break;
			case 'property_views_history':
				// Property total views.
				$sql_query = "SELECT * FROM {$table_name} WHERE PID = {$property_id}";
				$result    = $wpdb->get_results( $sql_query ); // phpcs:ignore
				break;
			default:
				// Properties total views.
				$sql_query = "SELECT COUNT(PID) FROM {$table_name}";
				$result    = $wpdb->get_var( $sql_query ); // phpcs:ignore
		}

		return $result;
	}
}

if ( ! function_exists( 'inspiry_get_property_views' ) ) {
	/**
	 * Ajax request handler to fulfil requested property
	 * views result based on given property ID.
	 */
	function inspiry_get_property_views() {

		if ( empty( $_REQUEST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'ere-property-analytics' ) ) {
			exit( 'No naughty business please!' );
		}

		if ( isset( $_POST['property_id'] ) && ! empty( $_POST['property_id'] ) ) {

			$property_id = sanitize_text_field( wp_unslash( $_POST['property_id'] ) );

			// Add a view to the property of given ID.
			new Property_Analytics( $property_id );

			$property_views = new Property_Analytics_View( $property_id );
			$views          = (array)$property_views->get_views( 'property_views_history' );
			$view_time      = array();

			foreach ( $views as $view ) {
				$view              = (array)$view;
				$view['TimeStamp'] = explode( ' ', $view['TimeStamp'] );
				$view_time[]       = date( 'd-M-Y', intval( $view['TimeStamp'][0] ) );
			}

			$view_time = array_values( array_unique( $view_time ) );

			$total_views = array();
			$num_of_days = get_option( 'inspiry_property_analytics_time_period', 14 );
			$view_time   = array_slice( $view_time, -( intval( $num_of_days ) ) );
			foreach ( $view_time as $time_stamp ) {
				$time_stamp    = strtotime( $time_stamp );
				$total_views[] = $property_views->get_views( 'property_today_views', $time_stamp );
			}

			echo wp_json_encode(
				array(
					'dates' => $view_time,
					'views' => $total_views
				)
			);
		}

		wp_die();
	}

	add_action( 'wp_ajax_inspiry_property_views', 'inspiry_get_property_views' );
	add_action( 'wp_ajax_nopriv_inspiry_property_views', 'inspiry_get_property_views' );
}

if ( ! function_exists( 'inspiry_get_property_summed_views' ) ) {
	/**
	 * Return property summed up views for the configured timestamp.
	 */
	function inspiry_get_property_summed_views( $property_id ) {

		$property_views = new Property_Analytics_View( $property_id );
		$views          = (array)$property_views->get_views( 'property_views_history' );
		$time_stamps    = array();

		foreach ( $views as $view ) {
			$view              = (array)$view;
			$view['TimeStamp'] = explode( ' ', $view['TimeStamp'] );
			$time_stamps[]     = $view['TimeStamp'][0];
		}

		$time_stamps = array_values( array_unique( $time_stamps ) );

		$total_views = 0;
		$num_of_days = get_option( 'inspiry_property_analytics_time_period', 14 );
		$time_stamps = array_slice( $time_stamps, -( intval( $num_of_days ) ) );
		foreach ( $time_stamps as $time_stamp ) {
			$total_views += intval( $property_views->get_views( 'property_today_views', $time_stamp ) );
		}

		return intval( $total_views );
	}
}

if ( ! function_exists( 'ere_get_properties_by_view_count' ) ) {
	/**
	 * Return properties array by views count
	 *
	 * @since 2.4.0
	 *
	 * @param int $num Mention how many properties are required. Will return all if empty
	 *
	 * @return string
	 */
	function ere_get_properties_by_view_count( $num = -1 ) {

		global $wpdb;

		$sql_query = "SELECT PID, COUNT(PID) AS PID_Count FROM {$wpdb->prefix}inspiry_property_analytics GROUP BY PID ORDER BY PID_Count DESC";

		if ( intval( $num ) > 0 ) {
			$sql_query .= " LIMIT " . $num;
		}

		return $wpdb->get_results( $sql_query );
	}
}

if ( ! function_exists( 'ere_get_properties_by_time_period' ) ) {
	/**
	 * Return properties IDs from given time till date
	 *
	 * @since 2.4.0
	 *
	 * @param string $args      This function manages following arguments
	 *                          unique      (bool)  If the return values should be unique by IP
	 *                          time_start  (int)   Unix timestamp int value for starting time range
	 *                          time_end    (int)   Unix timestamp int value for ending time range
	 *
	 * @return array    Array of values from the table
	 */
	function ere_get_properties_by_time_period( $args = array() ) {

		$unique          = isset( $args['unique'] ) ? $args['unique'] : false;
		$timestamp_start = isset( $args['time_start'] ) ? $args['time_start'] : 0;
		$timestamp_end   = isset( $args['time_end'] ) ? $args['time_end'] : 0;
		$post_id         = isset( $args['post_id'] ) ? $args['post_id'] : 0;

		global $wpdb;
		$table_name = $wpdb->prefix . 'inspiry_property_analytics';

		$sql_query = "SELECT COUNT(*) PID";

		if ( $unique ) {
			$sql_query .= ", COUNT(DISTINCT IP) AS UniqueIPCount";
		}

		$sql_query .= " FROM $table_name";

		// Add condition for $post_id if provided
		if ( $post_id ) {
			$sql_query .= $wpdb->prepare( " WHERE PID = %s", $post_id );
		}

		if ( $timestamp_start > 0 && $timestamp_end > 0 ) {
			// If both timestamps are given
			if ( $post_id ) {
				$sql_query .= $wpdb->prepare( " AND TimeStamp >= %s AND TimeStamp <= %s", $timestamp_start, $timestamp_end );
			} else {
				$sql_query .= $wpdb->prepare( " WHERE TimeStamp >= %s AND TimeStamp <= %s", $timestamp_start, $timestamp_end );
			}
		} else if ( $timestamp_start > 0 ) {
			// If starting point is given then till now will be considered
			if ( $post_id ) {
				$sql_query .= $wpdb->prepare( " AND TimeStamp >= %s", $timestamp_start );
			} else {
				$sql_query .= $wpdb->prepare( " WHERE TimeStamp >= %s", $timestamp_start );
			}
		}

		if ( $unique ) {
			$sql_query .= " GROUP BY PID ORDER BY UniqueIPCount DESC";
		}

		return $wpdb->get_results( $sql_query );
	}
}

if ( ! function_exists( 'ere_get_all_time_views' ) ) {
	/**
	 * Return all time (total) property views for a website
	 *
	 * @since 2.4.1
	 *
	 * @return array    Array of values from the table
	 */
	function ere_get_all_time_views() {

		global $wpdb;
		$table_name = $wpdb->prefix . 'inspiry_property_analytics';

		$query       = "SHOW TABLE STATUS WHERE Name = '$table_name'";
		$table_stats = $wpdb->get_results( $query );

		if ( ! $table_stats ) {
			// Query failed, display error message
			return "Error: " . $wpdb->last_error;
		} else {
			return $table_stats;
		}
	}
}

if ( ! function_exists( 'ere_get_analytics_views_sorted_data' ) ) {
	/**
	 * Return properties IDs from given time till date
	 *
	 * @since 2.4.0
	 *
	 * @param string    $args   It contains the following arguments
	 *                          $column:    (string)    Name of the column in analytics table. Default: Country
	 *                          $limit:     (int)       Limit of the top most counted values. Default: 4
	 *                          $others:    (boolean)   If rest of the remaining values should be shown
	 *                                                  combined in 'Others'
	 *
	 * @return array
	 */
	function ere_get_analytics_views_sorted_data( $args = array() ) {

		$column = 'Country';
		$limit = 4;
		$includeOthers = false;
		$others_label = esc_html__( 'Others', 'easy-real-estate' );
		$post_id = 0;

		if ( is_array( $args ) && 0 < count( $args ) ) {
			$column = isset( $args['column'] ) ? $args['column'] : 'Country';
			$limit = isset( $args['limit'] ) ? $args['limit'] : 4;
			$includeOthers = $args['others'] ?? false;
			$others_label = isset( $args['others_label'] ) ? $args['others_label'] : esc_html__( 'Others', 'easy-real-estate' );
			$post_id = isset( $args['post_id'] ) ? intval( $args['post_id'] ) : 0;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . 'inspiry_property_analytics';

		if ( ! $includeOthers ) {
			$sql_query = "SELECT $column, COUNT(*) AS ValueCount FROM $table_name GROUP BY $column ORDER BY ValueCount DESC LIMIT $limit";

			$results = $wpdb->get_results($sql_query);
		} else {
			$sql_query = "WITH RankedValues AS (
								    SELECT
								        $column,
								        COUNT(*) AS ValueCount,
								        ROW_NUMBER() OVER (ORDER BY COUNT(*) DESC) AS RowNum
								    FROM
								        $table_name";

			if ( $post_id ) {
				$sql_query .= " WHERE PID = $post_id";
			}

			$sql_query .= " GROUP BY
								$column
								)
								SELECT
								    CASE
								        WHEN RowNum <= $limit THEN $column
								        " . ( $includeOthers ? "ELSE 'Others'" : "" ) . "
								    END AS $column,
								    SUM(ValueCount) AS ValueCount
								FROM
								    RankedValues
								GROUP BY
								    CASE
								        WHEN RowNum <= $limit THEN $column
								        " . ( $includeOthers ? "ELSE 'Others'" : "" ) . "
								    END
								ORDER BY
								    ValueCount DESC;";

			$results = $wpdb->get_results($sql_query);

			usort($results, function ( $a, $b ) use ( $column, $others_label ) {
				return ere_custom_sort_analytics_chart_array( $a, $b, $column, $others_label );
			});
		}

		return $results;
	}
}

if ( ! function_exists( 'ere_check_and_convert_timestamps_once' ) ) {
	/**
	 * This function converts standard time and date format in TimeStamp
	 * column of $wpdb inspiry_property_analytics column to a proper timestamp
	 * It runs first time only and then gets disabled to make sure it doesn't run
	 * on each load.
	 * It is required to fix the timestamps' column to be used in date manipulation for
	 * analytics.
	 *
	 * @since 2.4.0
	 *
	 */
	function ere_check_and_convert_timestamps_once() {
		// Check if the flag is set
		if ( get_option( 'timestamps_checked' ) ) {
			return; // The check has already been performed
		}

		global $wpdb;

		$table_name = $wpdb->prefix . 'inspiry_property_analytics';

		$sql_query = "
			UPDATE $table_name
			SET TimeStamp = UNIX_TIMESTAMP(STR_TO_DATE(TimeStamp, '%Y-%m-%d %H:%i:%s'))
			WHERE TimeStamp LIKE '____-__-__ __:__:__';
		";

		// Performing the conversion here
		$wpdb->query( $sql_query );

		// Set the flag to indicate that the check has been performed
		update_option( 'timestamps_checked', true );
	}

	add_action( 'init', 'ere_check_and_convert_timestamps_once' );
}

if ( ! function_exists( 'ere_custom_sort_analytics_chart_array' ) ) {
	/**
	 * Function to manage a custom sort for an array using usort()
	 * It is sorting the array elements by associative key $column
	 * It is also keeping the 'others' column at the end
	 *
	 * @since 2.4.0
	 *
	 * @param mixed $a
	 * @param mixed $b
	 * @param string $column
	 * @param string $value
	 *
	 * @return mixed
	 */
	function ere_custom_sort_analytics_chart_array( $a, $b, $column, $value ) {
		if ( $a->$column === $value ) {
			return 1;
		} else if ( $b->$column === $value ) {
			return -1;
		} else {
			return $a->ValueCount > $b->ValueCount ? -1 : 1;
		}
	}
}

if ( ! function_exists( 'ere_get_properties_all_time_views' ) ) {
	/**
	 * Setting all time views to transient for better performance
	 *
	 * @since 2.4.1
	 *
	 * @return int
	 */
	function ere_get_properties_all_time_views() {
		$transient_key  = 'ere_properties_all_time_views';
		$all_time_views = get_transient( $transient_key );

		if ( false === $all_time_views ) {
			global $wpdb;
			$table_name = $wpdb->prefix . 'inspiry_property_analytics';

			$sql_query = "SELECT COUNT(*) AS TotalViews FROM $table_name";

			$all_time_views = $wpdb->get_var( $sql_query );

			// Set transient with total views
			set_transient( $transient_key, $all_time_views, HOUR_IN_SECONDS );
		}

		return $all_time_views;
	}
}