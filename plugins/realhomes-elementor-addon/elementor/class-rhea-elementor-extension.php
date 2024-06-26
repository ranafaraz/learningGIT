<?php
/**
 * Class Easy Real Estate class to work as Elementor Extension
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class RHEA_Elementor_Extension
{

	/**
	 * Minimum Required Version of Elementor Plugin
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.4.0';

	/**
	 * Minimum Required Version of PHP
	 */
	const MINIMUM_PHP_VERSION = '5.6';

	/**
	 * Plugin's singleton instance.
	 *
	 * @var RHEA_Elementor_Extension
	 */
	protected static $_instance;

	/**
	 * Provides singleton instance.
	 */
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Constructor function.
	 */
	public function __construct()
	{

		// Check if Elementor installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);

			return;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);

			return;
		}

		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);

			return;
		}

		// Register Widgets
		add_action('elementor/widgets/register', [$this, 'init_elementor_widgets']);

		// Register Control
		add_action('elementor/controls/register', [$this, 'include_custom_controls']);

		// Enqueue Widget Styles
		add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_frontend_styles']);

		// Enqueue Widget Scripts
		add_action('elementor/frontend/before_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);

		// Register New Ultra Categories
		add_action('elementor/elements/categories_registered', [$this, 'add_ultra_elementor_widget_categories']);

		// Register Ultra Single Property Category
		add_action('elementor/elements/categories_registered', [$this, 'add_ultra_elementor_single_property']);

		// Register New Categories
		add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);

		// Register New Classic Categories
		add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_classic_categories']);

		//		$this->rhea_leaflet_styles();

		add_action('init', [$this, 'include_RHEA_WPML_nodes']);

	}

	public function rhea_leaflet_styles()
	{
		wp_enqueue_style('leaflet', 'https://unpkg.com/leaflet@1.3.4/dist/leaflet.css', array(), '1.3.4');
	}

	/**
	 * Include widgets files and register them
	 */
	public function init_elementor_widgets()
	{

		$rhea_is_rvr_enabled = rhea_is_rvr_enabled();

		// Include helper files
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/common/elementor-helper.php');


		// Include Widget files
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/section-title.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/classic-slogan.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/properties.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/list-layout-properties.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-properties-2.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-properties-3.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-properties-4.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-properties-os-map.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-properties-google-map.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/properties-mapbox.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/featured-properties.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/featured-properties-2.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/featured-properties-3.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/agent.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/agents.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/agents-2.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/agent-profile.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/agent-contact-form.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/agencies.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inquiry-form.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/news.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/big-single-testimonial.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-testimonials.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-testimonials-3.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-testimonials-4.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-testimonials-5.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/call-to-action.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/call-to-action-2.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/call-to-action-3.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/partners.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/classic-properties.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/classic-featured-properties.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/classic-features-section.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/classic-news.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-login-modal-modern.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-features-section.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-search-form.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-properties-cities.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-hero.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-how-it-works.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-icon-list.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-icon-box.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-image-carousel.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-image-gallery.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-accordion.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-tabs.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-schedule-tour-form.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/schedule-tour-widget.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-single-property-slider.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-single-property-map.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property-taxonomy.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property-floor-plans.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/properties-slider.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/properties-slider-2.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/inspiry-nav-menu.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/rhea-site-logo.php');
		//Ultra Widgets
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/ultra-search-form2.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/ultra-search-form3.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/ultra-properties-1.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/ultra-city.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/ultra-news.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/ultra-testimonials.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/ultra-featured-properties.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/ultra-agents.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/ultra-main-slider-1.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/properties-stats.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/services-gallery.php');

		if ('ultra' === INSPIRY_DESIGN_VARIATION) {
			//Ultra Widgets
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-gallery.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/action-buttons.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-pdp-meta-icons.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-pdp-additional-details.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-features.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-common-note.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-property-attachments.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-description.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-floor-plans.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-video.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-virtual-tour.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-map.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-energy-performance.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-walk-score.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-nearby-places.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-property-analytics.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-similar-properties.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-schedule-tour.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-agent-contact-form.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-slider.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-slider-full-width.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-mortgage-calculator.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/ultra-comments.php');

			//Agent Single Widgets
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/agent/ultra-agent-agency-posts-card.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/agent/ultra-agent-agency-single-form.php');
		}

		if ($rhea_is_rvr_enabled) {
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/rvr/price-details.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/rvr/seasonal-prices.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/rvr/guest-accommodation.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/rvr/surroundings.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/rvr/outdoor.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/rvr/services.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/rvr/property-policies.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/rvr/availability-calendar.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/rvr/booking-form.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/property/rvr/owner.php');
		}

		// Common Widgets
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/button.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/social-icons.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/breadcrumbs.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/page-title.php');

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Section_Title_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Classic_Slogan_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_List_layout_Properties_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Properties_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Properties_Widget_Two());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Properties_Widget_Three());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Properties_Widget_Four());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Properties_OS_Map_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Properties_Google_Map_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Properties_MapBox_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Featured_Properties_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Featured_Properties_Two_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Featured_Properties_Three_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Agent_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Agents_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Agents_Two_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Agent_Profile_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Agent_Contact_Form_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Agencies_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Inquiry_Form_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_News_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Big_Testimonial_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Testimonial_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Testimonial_Widget_Three());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Testimonial_Widget_Four());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Testimonial_Widget_Five());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_CTA_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_CTA_Two_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_CTA_Three_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Partners_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Classic_Properties_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Classic_Featured_Properties_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Classic_Features_Section_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Classic_News_Section_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Login_modal_modern());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Modern_Features_Section_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Search_Form_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Properties_Cities_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Hero_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_How_It_Works_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Icon_List_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Icon_Box_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Image_Carousel_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Image_Gallery_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Accordion_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Tabs_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Schedule_Tour_Form_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Schedule_Tour_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Single_Property_Slider_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Single_Property_Map_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Property_Taxonomy_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Property_Floor_Plans_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Properties_Slider_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Properties_Slider_Two_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Nav_Menu_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Site_logo());

		// Register Ultra Widgets
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_ultra_Search_Form_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_ultra_Search_Form_2_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Properties_Widget_One());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_City());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_News_Grid());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Testimonials_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Featured_Properties());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Agents_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Main_Properties_Slider());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Services());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Properties_Stats_Widget());

		if ('ultra' === INSPIRY_DESIGN_VARIATION) {
			//Register Ultra Single Property Widgets
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Gallery());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Main_Slider());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Main_Slider_Fullwidth());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Property_Action_Buttons());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Description());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Property_Meta_Icons());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Additional_Details());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Common_Note());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Features());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Attachments());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Floor_Plans());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Property_Video());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Property_Virtual_Tour());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Map());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Walk_Score());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Nearby_Places());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Similar_Properties());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Agent_Form());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Energy_Performance());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Mortgage_Calculator());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Property_Analytics());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Schedule_Tour());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Comments());

			//Register Ultra Single Agent Widgets
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Agent_Agency_Card_Widget());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Agent_Agency_Form_Widget());
		}
		if ($rhea_is_rvr_enabled) {
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Price_Details());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Seasonal_Prices());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Guest_Accommodation());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Surroundings());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Outdoor_Features());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Services());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Property_Policies());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Availability_Calendar());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Single_Booking_Form());
			\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Ultra_Property_Owner());
		}

		// Common Widgets
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Button_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Social_Icons_List_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Breadcrumbs_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register(new RHEA_Page_Title_Widget());
	}

	public function include_RHEA_WPML_nodes()
	{
		if (class_exists('SitePress')) {

			// Modern Widgets WPML Support
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-section-title-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-properties-grid-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-properties-list-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-properties-grid-two-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-properties-grid-three-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-properties-grid-four-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-featured-properties-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-featured-properties-two-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-featured-properties-three-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-news-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-big-testimonial-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-testimonials-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-testimonials-three-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-cta-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-cta2-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-cta3-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-features-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-login-modal-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-search-form-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-properties-cities-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-agent-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-agents-grid-two-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-agent-profile-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-agent-contact-form-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-testimonials-four-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-accordion-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-how-it-works-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-hero-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-inquiry-form-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-icon-list-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-tabs-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-image-gallery-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-single-property-map-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-single-property-slider-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-schedule-tour-form-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-testimonials-five-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-property-taxonomy-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-properties-slider-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-properties-slider-2-wpml-translate.php');

			// Classic Widgets WPML Support
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-classic-slogan-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-classic-properties-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-classic-featured-properties-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-classic-news-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-classic-features-wpml-translate.php');

			// Ultra Widgets WPML Support
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-ultra-search-form-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-ultra-search-form-two-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-ultra-properties-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-ultra-featured-properties-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-ultra-testimonials-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-ultra-agents-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-ultra-property-city-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-ultra-news-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-ultra-main-slider-wpml-translate.php');

			//Ultra Single Property Widgets WPML Support
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-ultra-property-slider-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-ultra-property-slider-fullwidth-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-ultra-single-agent-contact-form-wpml-translate.php');
			require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/wpml/class-rhea-ultra-single-sta-form-wpml-translate.php');
		}
	}

	public function include_custom_controls()
	{
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/common/sorting-control-modern.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/common/sorting-control-ultra.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/common/heading-divider.php');
		require_once (RHEA_PLUGIN_DIR . 'elementor/widgets/common/note-control.php');

		\Elementor\Plugin::$instance->controls_manager->register(new RHEA_Sorting_Control_Modern());
		\Elementor\Plugin::$instance->controls_manager->register(new RHEA_Sorting_Control_Ultra());
		\Elementor\Plugin::$instance->controls_manager->register(new RHEA_Heading_Divider());
		\Elementor\Plugin::$instance->controls_manager->register(new RHEA_Important_note());
	}

	/**
	 * Add new category for RHEA Ultra widgets
	 */
	public function add_ultra_elementor_widget_categories($elements_manager)
	{
		$elements_manager->add_category(
			'ultra-real-homes',
			[
				'title' => esc_html__('RealHomes Ultra', 'realhomes-elementor-addon'),
				'icon' => 'fa fa-home',
			]
		);
	}

	/**
	 * Add new category for RHEA Ultra Single Property widgets
	 */
	public function add_ultra_elementor_single_property($elements_manager)
	{
		$elements_manager->add_category(
			'ultra-realhomes-single-property',
			[
				'title' => esc_html__('RealHomes Ultra Single Property', 'realhomes-elementor-addon'),
				'icon' => 'fas fa-laptop-house',
			]
		);
	}

	/**
	 * Add new category for RHEA widgets
	 */
	public function add_elementor_widget_categories($elements_manager)
	{
		$elements_manager->add_category(
			'real-homes',
			[
				'title' => esc_html__('RealHomes Modern', 'realhomes-elementor-addon'),
				'icon' => 'fa fa-home',
			]
		);
	}

	/**
	 * Add new category for RHEA Classic widgets
	 */
	public function add_elementor_widget_classic_categories($elements_manager)
	{
		$elements_manager->add_category(
			'classic-real-homes',
			[
				'title' => esc_html__('RealHomes Classic', 'realhomes-elementor-addon'),
				'icon' => 'fa fa-home',
			]
		);
	}

	/**
	 * Register front end styles
	 */
	public function enqueue_frontend_styles()
	{
		wp_enqueue_style('ere-elementor-frontend', RHEA_PLUGIN_URL . 'elementor/css/frontend.css', array(), RHEA_VERSION, 'all');
	}


	/**
	 * Register Frontend JavaScript
	 */
	public function enqueue_frontend_scripts()
	{
		wp_enqueue_script('ere-elementor-frontend', RHEA_PLUGIN_URL . 'elementor/js/frontend.js', array('jquery'), RHEA_VERSION);
	}

	/**
	 * Warning when the site doesn't have Elementor installed or activated.
	 */
	public function admin_notice_missing_main_plugin()
	{

		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'realhomes-elementor-addon'),
			'<strong>' . esc_html__('RealHomes Elementor Addon', 'realhomes-elementor-addon') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'realhomes-elementor-addon') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

	}

	/**
	 * Warning when the site doesn't have a minimum required PHP version.
	 */
	public function admin_notice_minimum_php_version()
	{

		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'realhomes-elementor-addon'),
			'<strong>' . esc_html__('RealHomes Elementor Addon', 'realhomes-elementor-addon') . '</strong>',
			'<strong>' . esc_html__('PHP', 'realhomes-elementor-addon') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

	}

	/**
	 * Warning when the site doesn't have a minimum required Elementor version.
	 */
	public function admin_notice_minimum_elementor_version()
	{

		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'realhomes-elementor-addon'),
			'<strong>' . esc_html__('RealHomes Elementor Addon', 'realhomes-elementor-addon') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'realhomes-elementor-addon') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

	}

}


RHEA_Elementor_Extension::instance();
