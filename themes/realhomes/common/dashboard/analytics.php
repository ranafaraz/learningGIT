<?php
/**
 * Display property analytics page in front-end dashboard
 *
 * This file contains various types of analytics by properties or single
 * property views count in dashboard.
 *
 * @since 4.3.0
 */

global $dashboard_globals;


if ( 'show' === get_option( 'realhomes_dashboard_analytics_module', 'show' ) && inspiry_is_property_analytics_enabled() && realhomes_get_current_user_role_option( 'property_analytics' ) ) {

	do_action( 'realhomes_dashboard_analytics_before' );
	?>
    <div id="dashboard-analytics" data-analytics-nonce="<?php echo wp_create_nonce("dashboard_analytics_nonce"); ?>">
        <div class="listing-select">
            <h4><?php esc_html_e( 'Filter by Property', 'framework' ); ?></h4>
            <p class="inspiry_select_picker_field field-wrap">
                <select name="analytics-property-select" id="analytics-property-select" class="inspiry_select_picker_trigger">
                    <?php
                    $properties = get_posts( array( 'post_type' => 'property', 'posts_per_page' => -1 ) );
                    if ( 0 < count( $properties ) ) {
                        ?>
                        <option value="0"><?php esc_html_e( 'All', 'framework' ); ?></option>
                        <?php
                        foreach ( $properties as $property ) {
                            ?>
                            <option value="<?php echo esc_attr( $property->ID ); ?>"><?php echo esc_html( $property->post_title ); ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="0"><?php esc_html_e( 'No Properties Found!', '' ); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
        </div>
        <?php
        ?>

        <div class="analytics-wrap">

            <div class="report-wrap general-cards" data-unique-text="<?php esc_html_e( 'Unique', 'framework' ); ?>">
                <div class="general-views today">
                    <h4><?php esc_html_e( 'Today', 'framework' ); ?></h4>
                    <div class="views-detail">
                        <div class="detail-area">
                            <p class="all-views"><span class="number">0</span> <span class="svg-loader"><?php inspiry_safe_include_svg( 'loader.svg', '/common/images/icons/' ); ?></span></p>
                            <p class="unique-views"><span class="number">0</span> <span class="svg-loader"><?php inspiry_safe_include_svg( 'loader.svg', '/common/images/icons/' ); ?></span></p>
                        </div>
                        <div class="chart-area">
                            <canvas id="today_views"></canvas>
                        </div>
                    </div>
                </div>
                <div class="general-views this-week">
                    <h4><?php esc_html_e( 'This Week', 'framework' ); ?></h4>
                    <div class="views-detail">
                        <div class="detail-area">
                            <p class="all-views"><span class="number">0</span> <span class="svg-loader"><?php inspiry_safe_include_svg( 'loader.svg', '/common/images/icons/' ); ?></span></p>
                            <p class="unique-views"><span class="number">0</span> <span class="svg-loader"><?php inspiry_safe_include_svg( 'loader.svg', '/common/images/icons/' ); ?></span></p>
                        </div>
                        <div class="chart-area">
                            <canvas id="this_week_views"></canvas>
                        </div>
                    </div>
                </div>
                <div class="general-views this-month">
                    <h4><?php esc_html_e( 'This Month', 'framework' ); ?></h4>
                    <div class="views-detail">
                        <div class="detail-area">
                            <p class="all-views"><span class="number">0</span> <span class="svg-loader"><?php inspiry_safe_include_svg( 'loader.svg', '/common/images/icons/' ); ?></span></p>
                            <p class="unique-views"><span class="number">0</span> <span class="svg-loader"><?php inspiry_safe_include_svg( 'loader.svg', '/common/images/icons/' ); ?></span></p>
                        </div>
                        <div class="chart-area">
                            <canvas id="this_month_views"></canvas>
                        </div>
                    </div>
                </div>
                <div class="general-views all-time">
                    <h4><?php esc_html_e( 'All Time', 'framework' ); ?></h4>
                    <div class="views-detail">
                        <div class="detail-area">
                            <p class="all-views"><span class="number">0</span> <span class="svg-loader"><?php inspiry_safe_include_svg( 'loader.svg', '/common/images/icons/' ); ?></span></p>
                            <p class="unique-views"><span class="number">0</span> <span class="svg-loader"><?php inspiry_safe_include_svg( 'loader.svg', '/common/images/icons/' ); ?></span></p>
                        </div>
                        <div class="chart-area">
                            <canvas id="all_time_views"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="report-wrap line-chart-tax-info">
                <div class="visits-line-wrap">
                    <span class="svg-loader"><?php inspiry_safe_include_svg( 'loader.svg', '/common/images/icons/' ); ?></span>
                    <div class="visits-header">
                        <h4><?php esc_html_e( 'Visits', 'framework' ); ?></h4>
                        <div class="visits-period">
                            <span class="today active"><?php esc_html_e( 'Today', 'framework' ); ?></span>
                            <span class="this-week"><?php esc_html_e( 'This Week', 'framework' ); ?></span>
                            <span class="this-month"><?php esc_html_e( 'This Month', 'framework' ); ?></span>
                        </div>
                    </div>
                    <div class="visits-line-graph">
                        <div class="today-line-wrap current">
                            <canvas id="visits-line-today" height="100px"></canvas>
                        </div>
                        <div class="week-line-wrap">
                            <canvas id="visits-line-week" height="100px"></canvas>
                        </div>
                        <div class="month-line-wrap">
                            <canvas id="visits-line-month" height="100px"></canvas>
                        </div>
                    </div>

                    <div class="line-visit-types">
                        <span><i style="background: #8b87ff;"></i> <?php esc_html_e( 'All', 'framework' ); ?></span>
                        <span><i style="background: #f58495;"></i> <?php esc_html_e( 'Unique', 'framework' ); ?></span>
                    </div>
                </div>

                <div class="countries-list-wrap">
                    <h4><?php esc_html_e( 'Top Countries', 'framework' ); ?></h4>
                    <ul class="countries-list" id="countries_list"></ul>
                </div>

            </div>

            <div class="report-wrap one-third">
                <h4><?php esc_html_e( 'Top Browsers', 'framework' ); ?></h4>
                <div class="chart-details browsers">
                    <canvas id="browsers_chart" width="110px" height="110px"></canvas>
                    <ul class="analytics-data-list"></ul>
                </div>
            </div>

            <div class="report-wrap one-third">
                <h4><?php esc_html_e( 'Devices', 'framework' ); ?></h4>
                <div class="chart-details devices">
                    <canvas id="devices_chart" width="150px" height="150px"></canvas>
                    <ul class="analytics-data-list"></ul>
                </div>
            </div>

            <div class="report-wrap one-third">
                <h4><?php esc_html_e( 'Top Platforms', 'framework' ); ?></h4>
                <div class="chart-details platforms">
                    <canvas id="platforms_chart" width="150px" height="150px"></canvas>
                    <ul class="analytics-data-list"></ul>
                </div>
            </div>

            <div class="reports-wrapper">
                <div class="popular-properties report-wrap">
                    <h4><?php esc_html_e( 'Popular Properties', 'framework' ); ?></h4>
                    <ul class="analytics-data-list">
				        <?php
				        if ( function_exists( 'ere_get_properties_by_view_count' ) ) {

					        // Getting required popular properties
					        $popular_properties = ere_get_properties_by_view_count( 8 );

					        if ( is_array( $popular_properties ) && 0 < count( $popular_properties ) ) {
						        foreach ( $popular_properties as $property ) {
							        $property_id = $property->PID;
							        $views_count = $property->PID_Count;
							        ?>
                                    <li>
                                        <span class="title"><?php echo get_the_title( $property_id ); ?></span>
                                        <span class="sep"></span>
                                        <span class="number"><?php echo esc_html( $property->PID_Count ); ?> <b><?php echo ( 1 < intval( $views_count ) ) ? esc_html__( 'Views' ) : esc_html__( 'View' ); ?></b></span>
                                    </li>
							        <?php
						        }
					        }
				        }
				        ?>
                    </ul>
                </div>

                <div class="taxonomies-bar-wrap">
                    <h4><?php esc_html_e( 'Popular Locations', 'framework' ); ?></h4>
                    <ul class="terms-list"></ul>
                    <canvas id="taxonomy-bars" width="100%" height="100%"></canvas>
                </div>
            </div>

        </div>

    </div>
	<?php

    do_action( 'realhomes_dashboard_analytics_after' );

} else {

    realhomes_dashboard_notice( esc_html__( 'You are not allowed to observe this area!', 'framework' ), 'error' );

}