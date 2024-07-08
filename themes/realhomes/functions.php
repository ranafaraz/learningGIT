<?php
/**
 * The current version of the theme.
 *
 * @package realhomes
 */

// Framework Path.
define('INSPIRY_FRAMEWORK', get_template_directory() . '/framework/');

// Default Design Variation
if (!defined('REALHOMES_DESIGN_VARIATION')) {

	// Define the latest default design variation of Realhomes theme.
	define('REALHOMES_DESIGN_VARIATION', 'ultra');

	/**
	 * Verify whether the user has saved their preference for the Classic, Modern or Ultra design; if not,
	 * set the latest design as the default.
	 */
	if (!in_array(get_option('inspiry_design_variation'), array('classic', 'modern', 'ultra'))) {
		update_option('inspiry_design_variation', REALHOMES_DESIGN_VARIATION);
	}
}

// Design Variation
if (!defined('INSPIRY_DESIGN_VARIATION')) {
	define('INSPIRY_DESIGN_VARIATION', get_option('inspiry_design_variation', REALHOMES_DESIGN_VARIATION));
}

// Theme assets.
if (!defined('INSPIRY_THEME_ASSETS')) {
	define('INSPIRY_THEME_ASSETS', '/assets/' . INSPIRY_DESIGN_VARIATION);
}

// Theme directory.
if (!defined('INSPIRY_THEME_DIR')) {
	define('INSPIRY_THEME_DIR', get_template_directory() . INSPIRY_THEME_ASSETS);
}

// Theme directory URI.
if (!defined('INSPIRY_DIR_URI')) {
	define('INSPIRY_DIR_URI', get_template_directory_uri() . INSPIRY_THEME_ASSETS);
}

// Theme common directory.
if (!defined('INSPIRY_COMMON_DIR')) {
	define('INSPIRY_COMMON_DIR', get_template_directory() . '/common/');
}

// Theme common directory URI.
if (!defined('INSPIRY_COMMON_URI')) {
	define('INSPIRY_COMMON_URI', get_template_directory_uri() . '/common/');
}

// Load classes files
require_once INSPIRY_FRAMEWORK . 'classes/load.php';

// Theme version.
define('INSPIRY_THEME_VERSION', RealHomes_Helper::get_theme_version());

if (!function_exists('inspiry_theme_setup')) {
	/**
	 * 1. Load text domain
	 * 2. Add custom background support
	 * 3. Add automatic feed links support
	 * 4. Add specific post formats support
	 * 5. Add custom menu support and register a custom menu
	 * 6. Register required image sizes
	 * 7. Add title tag support
	 */
	function inspiry_theme_setup()
	{

		/**
		 * Load text domain for translation purposes
		 */
		$languages_dir = get_template_directory() . '/languages';
		if (file_exists($languages_dir)) {
			load_theme_textdomain('framework', $languages_dir);
		} else {
			load_theme_textdomain('framework');   // For backward compatibility.
		}

		// Set the default content width.
		$GLOBALS['content_width'] = 828;

		/**
		 * Add Theme Support - Custom background
		 */
		add_theme_support('custom-background');

		/**
		 * Add Automatic Feed Links Support
		 */
		add_theme_support('automatic-feed-links');

		/**
		 * Add Post Formats Support
		 */
		add_theme_support('post-formats', array('image', 'video', 'gallery'));

		/**
		 * Register custom menus
		 */
		$nav_menus = array(
			'main-menu' => esc_html__('Main Menu', 'framework'),
			'responsive-menu' => esc_html__('Responsive Menu', 'framework'),
		);
		register_nav_menus(apply_filters('inspiry_nav_menus', $nav_menus));

		/**
		 * Add Post Thumbnails Support and Related Image Sizes
		 */
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(150, 150);                                               // Default Post Thumbnail dimensions.
		add_image_size('modern-property-child-slider', 680, 510, true);       // Moved to common for Dashboard needs. For Gallery, Child Property, Property Card, Property Grid Card, Similar Property.
		add_image_size('property-thumb-image', 488, 326, true);               // For Home page posts thumbnails/Featured Properties carousels thumb.
		add_image_size('property-detail-video-image', 818, 417, true);        // For Property detail page video image.
		add_image_size('agent-image', 210, 210, true);                        // For Agent Picture.
		add_image_size('partners-logo', 600, 9999, true);                     // For partner carousel logos

		if ('modern' === INSPIRY_DESIGN_VARIATION || 'ultra' === INSPIRY_DESIGN_VARIATION) {
			/**
			 * Modern Design Image Sizes
			 */
			add_image_size('post-featured-image', 1240, 720, true);               // For Blog featured image.
		} else if ('classic' === INSPIRY_DESIGN_VARIATION) {
			/**
			 * Classic Design Image Sizes
			 */
			add_image_size('gallery-two-column-image', 536, 269, true);           // For Gallery Two Column property Thumbnails.
			add_image_size('property-detail-slider-image-two', 1170, 648, true);  // For Property detail page slider image.
			add_image_size('property-detail-slider-thumb', 82, 60, true);         // For Property detail page slider thumb.
		}

		add_theme_support('title-tag');

		if (realhomes_is_woocommerce_activated()) {
			/**
			 * Registers support for various WooCommerce features.
			 *
			 * @since  3.13.0
			 */
			add_theme_support('woocommerce');
			add_theme_support('wc-product-gallery-zoom');
			add_theme_support('wc-product-gallery-lightbox');
			add_theme_support('wc-product-gallery-slider');

			/**
			 * Add 'realhomes_woocommerce_setup' action.
			 *
			 * @since  3.13.0
			 */
			do_action('realhomes_woocommerce_setup');
		}

		/**
		 * Add theme support for selective refresh
		 * of widgets in customizer.
		 */
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for Block Styles.
		add_theme_support('wp-block-styles');

		// Add support for full and wide align images.
		add_theme_support('align-wide');

		// Add support for editor styles.
		add_theme_support('editor-styles');

		if (class_exists('Header_Footer_Elementor')) {
			add_theme_support('header-footer-elementor');
		}

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name' => esc_html__('Small', 'framework'),
					'shortName' => esc_html__('S', 'framework'),
					'size' => 14,
					'slug' => 'small',
				),
				array(
					'name' => esc_html__('Normal', 'framework'),
					'shortName' => esc_html__('M', 'framework'),
					'size' => 16,
					'slug' => 'normal',
				),
				array(
					'name' => esc_html__('Large', 'framework'),
					'shortName' => esc_html__('L', 'framework'),
					'size' => 28,
					'slug' => 'large',
				),
				array(
					'name' => esc_html__('Huge', 'framework'),
					'shortName' => esc_html__('XL', 'framework'),
					'size' => 36,
					'slug' => 'huge',
				),
			)
		);

		$editor_color_palette = array(
			array(
				'name' => esc_html__('Primary', 'framework'),
				'slug' => 'primary',
				'color' => '#ec894d',
			),
			array(
				'name' => esc_html__('Orange Dark', 'framework'),
				'slug' => 'orange-dark',
				'color' => '#dc7d44',
			),
			array(
				'name' => esc_html__('Secondary', 'framework'),
				'slug' => 'secondary',
				'color' => '#4dc7ec',
			),
			array(
				'name' => esc_html__('Blue Dark', 'framework'),
				'slug' => 'blue-dark',
				'color' => '#37b3d9',
			),
		);

		if ('modern' === INSPIRY_DESIGN_VARIATION) {
			$editor_color_palette = array(
				array(
					'name' => esc_html__('Primary', 'framework'),
					'slug' => 'primary',
					'color' => '#ea723d',
				),
				array(
					'name' => esc_html__('Orange Dark', 'framework'),
					'slug' => 'orange-dark',
					'color' => '#e0652e',
				),
				array(
					'name' => esc_html__('Secondary', 'framework'),
					'slug' => 'secondary',
					'color' => '#1ea69a',
				),
				array(
					'name' => esc_html__('Green Dark', 'framework'),
					'slug' => 'blue-dark',
					'color' => '#0b8278',
				),
			);
		} else if ('ultra' === INSPIRY_DESIGN_VARIATION) {
			$editor_color_palette = array(
				array(
					'name' => esc_html__('Primary', 'framework'),
					'slug' => 'primary',
					'color' => '#1db2ff',
				),
				array(
					'name' => esc_html__('Primary Light', 'framework'),
					'slug' => 'primary-light',
					'color' => '#e7f6fd',
				),
				array(
					'name' => esc_html__('Primary Dark', 'framework'),
					'slug' => 'primary-dark',
					'color' => '#dbf0fa',
				),
				array(
					'name' => esc_html__('Secondary', 'framework'),
					'slug' => 'secondary',
					'color' => '#f58220',
				),
			);
		}

		$editor_color_palette[] = array(
			'name' => esc_html__('Black', 'framework'),
			'slug' => 'black',
			'color' => '#394041',
		);

		$editor_color_palette[] = array(
			'name' => esc_html__('White', 'framework'),
			'slug' => 'white',
			'color' => '#fff',
		);

		// Editor color palette.
		add_theme_support('editor-color-palette', $editor_color_palette);

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		// Disables the Widget Block Editor
		remove_theme_support('widgets-block-editor');

		global $pagenow;
		if (is_admin() && 'themes.php' == $pagenow && isset($_GET['activated'])) {
			wp_redirect(admin_url("admin.php?page=realhomes-design"));
		}
	}

	add_action('after_setup_theme', 'inspiry_theme_setup');
}

if (!function_exists('inspiry_content_width')) {
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function inspiry_content_width()
	{

		$content_width = $GLOBALS['content_width'];

		if ('modern' === INSPIRY_DESIGN_VARIATION) {
			if (is_page_template('templates/full-width.php')) {
				$content_width = 1140;
			} else if (is_singular('property') || is_singular('agent') || is_singular('agency')) {
				$content_width = 778;
			} else if (is_singular('post') || is_page()) {
				$content_width = 738;
			}
		} else {
			if (is_page_template('templates/full-width.php')) {
				$content_width = 1128;
			} else if (is_singular('agent') || is_singular('agency')) {
				$content_width = 578;
			} else if (is_singular('post')) {
				$content_width = 708;
			}
		}

		/**
		 * Filter RealHomes content width of the theme.
		 *
		 * @since RealHomes 3.6.1
		 *
		 * @param int $content_width Content width in pixels.
		 *
		 */
		$GLOBALS['content_width'] = apply_filters('inspiry_content_width', $content_width);
	}

	add_action('template_redirect', 'inspiry_content_width', 0);
}

if (!function_exists('inspiry_add_editor_style')):
	/**
	 * Add editor styles and fonts
	 */
	function inspiry_add_editor_style()
	{

		wp_enqueue_style(
			'rh-font-awesome',
			get_theme_file_uri('common/font-awesome/css/all.min.css'),
			array(),
			'5.13.1',
			'all'
		);

		wp_enqueue_style(
			'inspiry-google-fonts',
			inspiry_google_fonts(),
			array(),
			INSPIRY_THEME_VERSION
		);

		wp_enqueue_style(
			'inspiry-gutenberg-editor-style',
			get_theme_file_uri(INSPIRY_THEME_ASSETS . '/styles/css/editor-style.css'),
			array(),
			INSPIRY_THEME_VERSION
		);
	}

	add_action('enqueue_block_editor_assets', 'inspiry_add_editor_style');
endif;

if (!function_exists('inspiry_safe_include_svg')) {
	/**
	 * Includes svg file in the theme.
	 *
	 * @since 3.10.2
	 *
	 * @param string $path
	 *
	 * @param string $file
	 */
	function inspiry_safe_include_svg($file, $path = INSPIRY_THEME_ASSETS)
	{
		$file = get_theme_file_path($path . $file);
		if (file_exists($file)) {
			include ($file);
		}
	}
}

/**
 * Load functions files
 */
require_once (INSPIRY_FRAMEWORK . 'functions/load.php');

/**
 * Google Fonts
 */
require_once (INSPIRY_FRAMEWORK . 'customizer/google-fonts/google-fonts.php');

/**
 * Customizer
 */
require_once (INSPIRY_FRAMEWORK . 'customizer/customizer.php');

/**
 * RealHomes Admin
 *
 * @since 3.8.4
 */
if (file_exists(INSPIRY_FRAMEWORK . 'include/admin/class-rh-admin.php')) {
	require_once (INSPIRY_FRAMEWORK . 'include/admin/class-rh-admin.php');
}

/**
 * Theme meta boxes
 */
require_once (INSPIRY_FRAMEWORK . 'include/meta-boxes/post-meta-box.php');
require_once (INSPIRY_FRAMEWORK . 'include/meta-boxes/home-page-meta-box.php');
require_once (INSPIRY_FRAMEWORK . 'include/meta-boxes/meta-boxes.php');

if (!function_exists('inspiry_theme_sidebars')) {
	/**
	 * Sidebars, Footer and other Widget areas
	 */
	function inspiry_theme_sidebars()
	{

		// Location: Default Sidebar.
		register_sidebar(
			array(
				'name' => esc_html__('Default Sidebar', 'framework'),
				'id' => 'default-sidebar',
				'description' => esc_html__('Widget area for default sidebar on news and post pages.', 'framework'),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>',
			)
		);

		// Location: Sidebar Pages.
		register_sidebar(
			array(
				'name' => esc_html__('Pages Sidebar', 'framework'),
				'id' => 'default-page-sidebar',
				'description' => esc_html__('Widget area for default page template sidebar.', 'framework'),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>',
			)
		);

		// Location: Sidebar for contact page.
		if ('classic' === INSPIRY_DESIGN_VARIATION) {
			register_sidebar(
				array(
					'name' => esc_html__('Contact Sidebar', 'framework'),
					'id' => 'contact-sidebar',
					'description' => esc_html__('Widget area for contact page sidebar.', 'framework'),
					'before_widget' => '<section class="widget clearfix %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h3 class="title">',
					'after_title' => '</h3>',
				)
			);
		}

		// Location: Sidebar Property.
		register_sidebar(
			array(
				'name' => esc_html__('Property Sidebar', 'framework'),
				'id' => 'property-sidebar',
				'description' => esc_html__('Widget area for property detail page sidebar.', 'framework'),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>',
			)
		);

		// Location: Sidebar Properties List.
		register_sidebar(
			array(
				'name' => esc_html__('Properties Pages Sidebar', 'framework'),
				'id' => 'property-listing-sidebar',
				'description' => esc_html__('Widget area for sidebar in properties list, grid and archive pages.', 'framework'),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>',
			)
		);

		// Location: Footer First Column.
		register_sidebar(
			array(
				'name' => esc_html__('Footer First Column', 'framework'),
				'id' => 'footer-first-column',
				'description' => esc_html__('Widget area for first column in footer.', 'framework'),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>',
			)
		);

		// Location: Footer Second Column.
		register_sidebar(
			array(
				'name' => esc_html__('Footer Second Column', 'framework'),
				'id' => 'footer-second-column',
				'description' => esc_html__('Widget area for second column in footer.', 'framework'),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>',
			)
		);

		// Location: Footer Third Column.
		register_sidebar(
			array(
				'name' => esc_html__('Footer Third Column', 'framework'),
				'id' => 'footer-third-column',
				'description' => esc_html__('Widget area for third column in footer.', 'framework'),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>',
			)
		);

		// Location: Footer Fourth Column.
		register_sidebar(
			array(
				'name' => esc_html__('Footer Fourth Column', 'framework'),
				'id' => 'footer-fourth-column',
				'description' => esc_html__('Widget area for fourth column in footer.', 'framework'),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>',
			)
		);

		// Location: Sidebar Agent.
		register_sidebar(
			array(
				'name' => esc_html__('Agent Sidebar', 'framework'),
				'id' => 'agent-sidebar',
				'description' => esc_html__('Sidebar widget area for agent detail page.', 'framework'),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>',
			)
		);

		// Location: Sidebar Agency.
		register_sidebar(
			array(
				'name' => esc_html__('Agency Sidebar', 'framework'),
				'id' => 'agency-sidebar',
				'description' => esc_html__('Sidebar widget area for agency detail page.', 'framework'),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>',
			)
		);

		// Location: Property Search Template.
		register_sidebar(
			array(
				'name' => esc_html__('Property Search Sidebar', 'framework'),
				'id' => 'property-search-sidebar',
				'description' => esc_html__('Widget area for property search template with sidebar.', 'framework'),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>',
			)
		);

		if ('classic' !== INSPIRY_DESIGN_VARIATION) {
			// Location: Property Search Template.
			register_sidebar(
				array(
					'name' => esc_html__('404 Page Widgets', 'framework'),
					'id' => '404-sidebar',
					'description' => esc_html__('Widget area for 404 template content area.', 'framework'),
					'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h3 class="title">',
					'after_title' => '</h3>',
				)
			);
		}

		// Create additional sidebar to use with visual composer if needed.
		if (class_exists('Vc_Manager')) {

			// Additional Sidebars.
			register_sidebars(
				4,
				array(
					'name' => esc_html__('Additional Sidebar %d', 'framework'),
					'description' => esc_html__('An extra sidebar to use with Visual Composer if needed.', 'framework'),
					'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h3 class="title">',
					'after_title' => '</h3>',
				)
			);

		}

		// Create additional sidebar to use with Optima Express if needed.
		if (class_exists('iHomefinderAdmin')) {

			// Location: Home Search Area.
			register_sidebar(
				array(
					'name' => esc_html__('Home Search Area', 'framework'),
					'id' => 'home-search-area',
					'description' => esc_html__('Widget area for only IDX Search Widget. Using this area means you want to display IDX search form instead of default search form.', 'framework'),
					'before_widget' => '<section id="home-idx-search" class="clearfix %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h3 class="home-widget-label">',
					'after_title' => '</h3>',
				)
			);

			// Additional Sidebars.
			register_sidebar(
				array(
					'name' => esc_html__('Optima Express Sidebar', 'framework'),
					'id' => 'optima-express-page-sidebar',
					'description' => esc_html__('An extra sidebar to use with Optima Express if needed.', 'framework'),
					'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h3 class="title">',
					'after_title' => '</h3>',
				)
			);
		}

		// Creates additional sidebar to use with WooCommerce page if needed.
		if (realhomes_is_woocommerce_activated()) {

			// Shop Sidebar.
			register_sidebar(
				array(
					'name' => esc_html__('Shop Sidebar', 'framework'),
					'id' => 'shop-page-sidebar',
					'description' => esc_html__('An extra sidebar to use with WooCommerce pages if needed.', 'framework'),
					'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h3 class="title">',
					'after_title' => '</h3>',
				)
			);
		}

	}

	add_action('widgets_init', 'inspiry_theme_sidebars');
}

if (!function_exists('inspiry_google_fonts')) {
	/**
	 * Google fonts enqueue url
	 */
	function inspiry_google_fonts()
	{

		$font_families = array();
		$fonts_url = '';
		$subsets = 'latin,latin-ext';

		// Body Font
		$body_font = get_option('inspiry_body_font', 'Default');
		if ('Default' !== $body_font) {
			$font_families[] = $body_font . ':' . Inspiry_Google_Fonts::get_font_weights($body_font, false, true);
		} else {
			// Open Sans is theme's default text font.
			$font_families[] = 'Open+Sans:400,400i,600,600i,700,700i';
		}

		// Heading Font
		$heading_font = get_option('inspiry_heading_font', 'Default');
		if ('Default' !== $heading_font) {
			$font_families[] = $heading_font . ':' . Inspiry_Google_Fonts::get_font_weights($heading_font, false, true);
		} else {
			// Lato is theme's default heading font.
			$font_families[] = 'Lato:400,400i,700,700i';
		}

		// Secondary Font
		$secondary_font = get_option('inspiry_secondary_font', 'Default');
		if ('Default' !== $secondary_font) {
			$font_families[] = $secondary_font . ':' . Inspiry_Google_Fonts::get_font_weights($secondary_font, false, true);
		} else {
			// Robot is theme's default secondary font.
			$font_families[] = 'Roboto:400,400i,500,500i,700,700i';
		}

		/*
		 * This font is used on dashboard membership order completion page and will be included only on dashboard template.
		 *
		 * Translators: If there are characters in your language that are not
		 * supported by Damion, translate this to 'off'. Do not translate into your own language.
		 */
		if ('off' !== _x('on', 'Damion font: on or off', 'framework') && is_page_template('templates/dashboard.php')) {
			$font_families[] = 'Damion';
		}

		if (('modern' === INSPIRY_DESIGN_VARIATION) || is_page_template('templates/dashboard.php')) {
			/*
			 * Translators: If there are characters in your language that are not
			 * supported by Rubik, translate this to 'off'. Do not translate into your own language.
			 */
			if ('off' !== _x('on', 'Rubik font: on or off', 'framework')) {
				$font_families[] = 'Rubik:400,400i,500,500i,700,700i';
			}
		}

		if ('ultra' === INSPIRY_DESIGN_VARIATION) {
			/*
			 * Translators: If there are characters in your language that are not
			 * supported by DM Sans, translate this to 'off'. Do not translate into your own language.
			 */
			if ('off' !== _x('on', 'DM Sans font: on or off', 'framework')) {
				$font_families[] = 'DM Sans:400,400i,500,500i,700,700i';
			}
		}

		if (!empty($font_families)) {
			$query_args = array(
				'family' => implode('|', array_unique($font_families)),
				'subset' => urlencode($subsets),
				'display' => urlencode('fallback'),
			);

			$fonts_url = add_query_arg($query_args, '//fonts.googleapis.com/css');
		}

		return esc_url_raw($fonts_url);
	}
}

if (!function_exists('inspiry_update_page_templates')) {

	/**
	 * Function to update page templates.
	 *
	 * @since 3.0.0
	 */
	function inspiry_update_page_templates()
	{

		if (!is_page_template()) {
			return;
		}

		$page_id = get_queried_object_id();
		if (!empty($page_id)) {
			$page_template = get_post_meta($page_id, '_wp_page_template', true);
		}

		if (empty($page_template)) {
			return;
		}

		$latest_templates = array(
			/*
			 * Updated properties list template
			 */
			'template-property-listing.php' => 'templates/list-layout.php',
			'templates/template-property-listing.php' => 'templates/list-layout.php',
			/*
			 * Updated properties grid template
			 */
			'template-property-grid-listing.php' => 'templates/list-layout.php',
			'templates/template-property-grid-listing.php' => 'templates/grid-layout.php',
			/*
			 * Updated properties with half map template
			 */
			'template-map-based-listing.php' => 'templates/half-map-layout.php',
			'templates/template-map-based-listing.php' => 'templates/half-map-layout.php',
			/*
			 * Updated agents list template
			 */
			'template-agent-listing.php' => 'templates/agents-list.php',
			'templates/template-agent-listing.php' => 'templates/agents-list.php',
			/*
			 * Updated compare properties template
			 */
			'template-compare.php' => 'templates/compare-properties.php',
			'templates/template-compare.php' => 'templates/compare-properties.php',
			/*
			 * Updated contact template
			 */
			'template-contact.php' => 'templates/contact.php',
			'templates/template-contact.php' => 'templates/contact.php',
			/*
			 * Updated full width template
			 */
			'template-fullwidth.php' => 'templates/full-width.php',
			'templates/template-fullwidth.php' => 'templates/full-width.php',
			/*
			 * Updated 2 Columns Gallery template
			 */
			'template-gallery-2-columns.php' => 'templates/2-columns-gallery.php',
			'templates/template-gallery-2-columns.php' => 'templates/2-columns-gallery.php',
			/*
			 * Updated 3 Columns Gallery template
			 */
			'template-gallery-3-columns.php' => 'templates/3-columns-gallery.php',
			'templates/template-gallery-3-columns.php' => 'templates/3-columns-gallery.php',
			/*
			 * Updated 4 Columns Gallery template
			 */
			'template-gallery-4-columns.php' => 'templates/4-columns-gallery.php',
			'templates/template-gallery-4-columns.php' => 'templates/4-columns-gallery.php',
			/*
			 * Updated home template
			 */
			'template-home.php' => 'templates/home.php',
			'templates/template-home.php' => 'templates/home.php',
			/*
			 * Updated login template
			 */
			'template-login.php' => 'templates/login-register.php',
			'templates/template-login.php' => 'templates/login-register.php',
			/*
			 * Updated optima express template
			 */
			'template-optima-express.php' => 'templates/optima-express.php',
			'templates/template-optima-express.php' => 'templates/optima-express.php',
			/*
			 * Updated search template
			 */
			'template-search.php' => 'templates/properties-search.php',
			'templates/template-search.php' => 'templates/properties-search.php',
			/*
			 * Updated search template with right sidebar
			 */
			'template-search-right-sidebar.php' => 'templates/properties-search-right-sidebar.php',
			'templates/template-search-right-sidebar.php' => 'templates/properties-search-right-sidebar.php',
			/*
			 * Updated search template with left sidebar
			 */
			'template-search-sidebar.php' => 'templates/properties-search-left-sidebar.php',
			'templates/template-search-sidebar.php' => 'templates/properties-search-left-sidebar.php',
			/*
			 * Updated users list template
			 */
			'template-users-listing.php' => 'templates/users-lists.php',
			'templates/template-users-listing.php' => 'templates/users-lists.php',
		);

		if (!empty($page_template) && array_key_exists($page_template, $latest_templates) && !defined('DSIDXPRESS_PLUGIN_VERSION')) {

			$updated_template = $latest_templates[$page_template];
			update_post_meta($page_id, '_wp_page_template', $updated_template);
			echo '<meta HTTP-EQUIV="Refresh" CONTENT="1">';

		} else if (
			!empty($page_template) &&
			false !== strpos($page_template, 'template-') &&
			false === strpos($page_template, 'templates/') &&
			!defined('DSIDXPRESS_PLUGIN_VERSION')
		) {

			update_post_meta($page_id, '_wp_page_template', 'templates/' . $page_template);
			echo '<meta HTTP-EQUIV="Refresh" CONTENT="1">';
		}

	}

	add_action('wp_head', 'inspiry_update_page_templates');
}

// Enable shortcodes in text widgets.
add_filter('widget_text', 'do_shortcode');

if (!function_exists('inspiry_header_variation_body_classes')) {
	/**
	 * Header variation body classes.
	 */
	function inspiry_header_variation_body_classes($classes)
	{
		$get_header_variations = apply_filters('inspiry_header_variation', get_option('inspiry_header_mod_variation_option', 'one'));
		$class_name = 'inspiry_mod_header_variation_' . $get_header_variations;

		if (inspiry_show_header_search_form()) {
			$class_name .= ' inspiry_header_search_form_enabled';
		}

		if ('search-form-over-image' == get_post_meta(get_the_ID(), 'theme_homepage_module', true)) {
			$class_name .= ' inspiry_search_form_over_image_enabled';
		}

		$classes[] = $class_name;

		return $classes;
	}

	if ('modern' === INSPIRY_DESIGN_VARIATION) {
		add_filter('body_class', 'inspiry_header_variation_body_classes');
	}
}

if (!function_exists('inspiry_search_form_variation_body_classes')) {
	/**
	 * Search form variation body classes.
	 */
	function inspiry_search_form_variation_body_classes($classes)
	{
		$get_header_variations = get_option('inspiry_search_form_mod_layout_options', 'default');
		$get_header_location = get_option('inspiry_show_search_in_header', '1');

		if (is_home()) {
			$page_id = get_queried_object_id();
		} else {
			$page_id = get_the_ID();
		}

		$REAL_HOMES_hide_advance_search = get_post_meta($page_id, 'REAL_HOMES_hide_advance_search', true);

		if ('0' === $get_header_location || '1' === $REAL_HOMES_hide_advance_search) {
			$classes[] = 'inspriry_search_form_hidden_in_header';
		}

		$class_name = 'inspiry_mod_search_form_' . $get_header_variations;
		$classes[] = $class_name;

		return $classes;
	}

	if ('modern' === INSPIRY_DESIGN_VARIATION) {
		add_filter('body_class', 'inspiry_search_form_variation_body_classes');
	}
}

if (!function_exists('inspiry_add_meta_based_class')) {
	function inspiry_add_meta_based_class($class)
	{
		if ('modern' === INSPIRY_DESIGN_VARIATION) {
			$REAL_HOMES_page_top_bottom_padding_nil = get_post_meta(get_the_ID(), 'REAL_HOMES_page_top_bottom_padding_nil', true);
			if ($REAL_HOMES_page_top_bottom_padding_nil == 1) {
				$class[] = 'REAL_HOMES_page_top_bottom_padding_nil';
			}
		}
		$REAL_HOMES_content_area_padding_nil = get_post_meta(get_the_ID(), 'REAL_HOMES_content_area_padding_nil', true);
		if ($REAL_HOMES_content_area_padding_nil == 1) {
			$class[] = 'REAL_HOMES_content_area_padding_nil';
		}

		return $class;
	}

	add_filter('body_class', 'inspiry_add_meta_based_class');

}

if (!function_exists('inspiry_floating_bar_class')) {
	/**
	 * Search form variation body classes.
	 */
	function inspiry_floating_bar_class($classes)
	{
		$inspiry_default_floating_bar_display = get_theme_mod('inspiry_default_floating_bar_display', 'show');
		if ('show' == $inspiry_default_floating_bar_display) {
			$class_name = 'inspiry_body_floating_features_show';
		} else {
			$class_name = 'inspiry_body_floating_features_hide';
		}

		$classes[] = $class_name;

		return $classes;
	}

	add_filter('body_class', 'inspiry_floating_bar_class');
}

if (!function_exists('inspiry_elementor_styles')) {
	/**
	 * enqueue Elementor styles.
	 */
	function inspiry_elementor_styles()
	{
		wp_enqueue_style(
			'inspiry-elementor-style',
			get_theme_file_uri('common/css/elementor-styles.min.css'),
			array(),
			INSPIRY_THEME_VERSION
		);
	}

	add_action('elementor/frontend/after_enqueue_styles', 'inspiry_elementor_styles');
}

if (function_exists('realhomes_currency_switcher_enabled') && realhomes_currency_switcher_enabled()) {

	if (!function_exists('inspiry_currency_switcher_flags')) {
		/**
		 * Enqueue currency switcher flags css.
		 */
		function inspiry_currency_switcher_flags()
		{
			wp_enqueue_style(
				'inspiry-currency-flags',
				get_theme_file_uri('common/css/currency-flags.min.css'),
				array(),
				INSPIRY_THEME_VERSION
			);
		}

		add_action('wp_enqueue_scripts', 'inspiry_currency_switcher_flags');
	}
}

if (!function_exists('inspiry_frontend_styles')) {
	/**
	 * enqueue Elementor styles.
	 */
	function inspiry_frontend_styles()
	{
		wp_enqueue_style(
			'inspiry-frontend-style',
			get_theme_file_uri('common/css/frontend-styles.min.css'),
			array(),
			INSPIRY_THEME_VERSION
		);
	}

	add_action('wp_enqueue_scripts', 'inspiry_frontend_styles');
}

if (!function_exists('inspiry_sanitize_field')) {
	function inspiry_sanitize_field($str)
	{
		/**
		 * Filters a sanitized textarea field string.
		 */

		$allowed_html = array(
			'a' => array(
				'href' => array(),
				'target' => array(),
			),
			'br' => array(),
			'strong' => array(),
			'i' => array(),
			'em' => array(),
		);

		$str = wp_kses($str, $allowed_html);

		return apply_filters('inspiry_sanitize_field', $str);
	}
}

if (!function_exists('inspiry_kses')) {
	function inspiry_kses($str)
	{
		/**
		 * Filters content and keeps only allowable HTML elements.
		 */
		$allowed_html = array(
			'a' => array(
				'href' => array(),
				'target' => array(),
			),
			'br' => array(),
			'strong' => array(),
			'i' => array(),
			'em' => array(),
		);

		$str = wp_kses($str, $allowed_html);

		return apply_filters('inspiry_kses', $str);
	}
}

// Register Theme Locations For Elementor Templates
if (!function_exists('inspiry_register_elementor_locations')) {

	function inspiry_register_elementor_locations($elementor_theme_manager)
	{

		$elementor_theme_manager->register_location('header');
		$elementor_theme_manager->register_location('footer');
		$elementor_theme_manager->register_location('single');
		$elementor_theme_manager->register_location('archive');
		$elementor_theme_manager->register_location(
			'single-property',
			[
				'label' => esc_html__('Single Property', 'framework'),
				'multiple' => true,
				'edit_in_content' => true,
			]
		);
		$elementor_theme_manager->register_location(
			'single-property-fullwidth',
			[
				'label' => esc_html__('Single Property Fullwidth', 'framework'),
				'multiple' => true,
				'edit_in_content' => true,
			]
		);
		$elementor_theme_manager->register_location(
			'single-agent',
			[
				'label' => esc_html__('Single Agent', 'framework'),
				'multiple' => true,
				'edit_in_content' => true,
			]
		);
		$elementor_theme_manager->register_location(
			'single-agency',
			[
				'label' => esc_html__('Single Agency', 'framework'),
				'multiple' => true,
				'edit_in_content' => true,
			]
		);
		$elementor_theme_manager->register_location(
			'properties-listings-grid',
			[
				'label' => esc_html__('Properties Grid Layout', 'framework'),
				'multiple' => true,
				'edit_in_content' => true,
			]
		);
		$elementor_theme_manager->register_location(
			'properties-listings-grid-fullwidth',
			[
				'label' => esc_html__('Properties Grid Layout Fullwidth', 'framework'),
				'multiple' => true,
				'edit_in_content' => true,
			]
		);
		$elementor_theme_manager->register_location(
			'properties-listings-list',
			[
				'label' => esc_html__('Properties List Layout', 'framework'),
				'multiple' => true,
				'edit_in_content' => true,
			]
		);
		$elementor_theme_manager->register_location(
			'properties-listings-list-fullwidth',
			[
				'label' => esc_html__('Properties List Layout Fullwidth', 'framework'),
				'multiple' => true,
				'edit_in_content' => true,
			]
		);
		$elementor_theme_manager->register_location(
			'agents-listings',
			[
				'label' => esc_html__('Agents Listings', 'framework'),
				'multiple' => true,
				'edit_in_content' => true,
			]
		);
		$elementor_theme_manager->register_location(
			'agency-listings',
			[
				'label' => esc_html__('Agency Listings', 'framework'),
				'multiple' => true,
				'edit_in_content' => true,
			]
		);
	}

	add_action('elementor/theme/register_locations', 'inspiry_register_elementor_locations');
}

if (!function_exists('inspiry_post_classes')) {

	function inspiry_post_classes($classes)
	{

		if ('modern' === INSPIRY_DESIGN_VARIATION) {

			if (is_home() || is_archive() || is_search() || is_singular('post')) {
				$classes[] = 'rh_blog__post';

			} else if (is_page()) {
				$classes[] = 'rh_blog__post';

				if ('hide' != get_post_meta(get_the_ID(), 'REAL_HOMES_page_title_display', true)) {
					$classes[] = 'entry-header-margin-fix';
				}
			}

		} else {
			if (is_page_template('templates/optima-express.php')) {
				$classes[] = 'optima-express clearfix';
			} else if (is_page()) {
				$classes[] = 'clearfix';
			}
		}

		return $classes;
	}

	add_filter('post_class', 'inspiry_post_classes');
}

if (!function_exists('realhomes_content_width')) {
	/**
	 * Adds css class to body when related sidebar is not active
	 */
	function realhomes_content_width($classes)
	{

		if ('classic' === INSPIRY_DESIGN_VARIATION) {
			if (!is_active_sidebar('contact-sidebar') && is_page_template('templates/contact.php')) {
				$classes[] = 'realhomes-content-fullwidth contact-sidebar-inactive';
			} else if (
				!is_active_sidebar('default-page-sidebar') && is_page_template(
					array(
						'templates/agents-list.php',
						'templates/agencies-list.php'
					)
				)
			) {
				$classes[] = 'realhomes-content-fullwidth default-page-sidebar-inactive';
			}
		}

		if ('modern' === INSPIRY_DESIGN_VARIATION) {
			if (
				!is_active_sidebar('property-listing-sidebar') && is_page_template(
					array(
						'templates/agents-list.php',
						'templates/agencies-list.php',
					)
				)
			) {
				$classes[] = 'realhomes-content-fullwidth property-listing-sidebar-inactive';
			}
		}

		if (
			!is_active_sidebar('property-listing-sidebar') && (is_tax() || is_page_template(
				array(
					'templates/grid-layout.php',
					'templates/list-layout.php',
					'templates/users-lists.php',
				)
			)
			)
		) {
			$classes[] = 'realhomes-content-fullwidth property-listing-sidebar-inactive';

		} else if (
			!is_active_sidebar('property-search-sidebar') && is_page_template(
				array(
					'templates/properties-search-right-sidebar.php',
					'templates/properties-search-left-sidebar.php',
				)
			)
		) {
			$classes[] = 'realhomes-content-fullwidth property-search-sidebar-inactive';

		} else if (!is_active_sidebar('dsidx-sidebar') && is_page_template('templates/dsIDXpress.php')) {
			$classes[] = 'realhomes-content-fullwidth dsidx-sidebar-inactive';

		} else if (!is_active_sidebar('agent-sidebar') && (is_singular('agent') || is_author())) {
			$classes[] = 'realhomes-content-fullwidth agent-sidebar-inactive';

		} else if (!is_active_sidebar('agency-sidebar') && is_singular('agency')) {
			$classes[] = 'realhomes-content-fullwidth agency-sidebar-inactive';

		} else if (!is_active_sidebar('default-page-sidebar') && is_page() && !is_page_template()) {
			$classes[] = 'realhomes-content-fullwidth default-page-sidebar-inactive';

		} else if (!is_active_sidebar('default-sidebar') && !is_tax() && (is_singular('post') || is_home() || is_archive() || is_search())) {
			$classes[] = 'realhomes-content-fullwidth default-sidebar-inactive';
		} else if (!is_active_sidebar('shop-page-sidebar') && realhomes_is_woocommerce_activated() && (is_post_type_archive('product') || is_singular('product'))) {
			$classes[] = 'realhomes-content-fullwidth shop-sidebar-inactive';
		}

		return $classes;
	}

	add_filter('body_class', 'realhomes_content_width');
}

if (!function_exists('inspiry_half_map_fixed_classes')) {

	function inspiry_half_map_fixed_classes($classes)
	{
		if (realhomes_is_half_map_template() || is_page_template('templates/half-map-layout.php') || is_page_template('templates/properties-search-half-map.php')) {
			$classes[] = 'inspiry_half_map_fixed';
		}

		return $classes;
	}

	add_filter('body_class', 'inspiry_half_map_fixed_classes');
}

if (!function_exists('inspiry_home_search_form_class')) {

	// Adds css class to body when search form is disable on Home Page


	function inspiry_home_search_form_class($classes)
	{
		if ('modern' === INSPIRY_DESIGN_VARIATION && is_page_template('templates/home.php')) {
			if ('false' == get_post_meta(get_the_ID(), 'theme_show_home_search', true)) {
				$classes[] = 'inspiry-home-search-form-hide';
			}
		}

		return $classes;
	}

	add_filter('body_class', 'inspiry_home_search_form_class');
}

if (!function_exists('inspiry_responsive_header')) {

	// Adds Responsive header css class to body
	function inspiry_responsive_header($classes)
	{
		if ('modern' === INSPIRY_DESIGN_VARIATION) {
			$get_responsive_header = get_option('inspiry_responsive_header_option', 'solid');
			$classes[] = 'inspiry_responsive_header_' . $get_responsive_header;
		}

		return $classes;
	}

	add_filter('body_class', 'inspiry_responsive_header');
}

if (!function_exists('rh_sfoi_data_fetch')) {

	function rh_sfoi_data_fetch()
	{
		$the_query = new WP_Query(
			array(
				'posts_per_page' => 50,
				's' => esc_attr($_POST['keyword']),
				'post_type' => 'property',
			)
		);
		if ($the_query->have_posts()) {
			while ($the_query->have_posts()) {
				$the_query->the_post(); ?>

				<a href="<?php the_permalink(); ?>">
					<span class="sfoi_ajax_thumb"><?php the_post_thumbnail('thumbnail') ?></span>
					<span class="sfoi_ajax_title"><?php the_title(); ?></span>
					<span class="sfoi_ajax_status"><?php echo esc_html(display_property_status(get_the_ID())); ?></span>
				</a>

				<?php
			}
			wp_reset_postdata();
		}
		die();
	}

	add_action('wp_ajax_rh_sfoi_data_fetch', 'rh_sfoi_data_fetch');
	add_action('wp_ajax_nopriv_rh_sfoi_data_fetch', 'rh_sfoi_data_fetch');
}

// Set theme logo to custom_logo (for Elementor Site Logo widget)
if (!function_exists('inspiry_theme_logo_to_custom_logo')) {

	function inspiry_theme_logo_to_custom_logo()
	{
		$get_attachment_id = '';
		$get_site_log_url = get_option('theme_sitelogo');
		if (!empty($get_site_log_url)) {
			$get_attachment_id = attachment_url_to_postid($get_site_log_url);
		}
		set_theme_mod('custom_logo', $get_attachment_id);
	}

	add_action('customize_save_after', 'inspiry_theme_logo_to_custom_logo');
}

// Remove theme mod of core colors after settings them as theme options
if (!function_exists('inspiry_update_theme_mod_to_options')) {
	function inspiry_update_theme_mod_to_options()
	{
		$keys = array(
			'inspiry_default_styles',
			'theme_core_mod_color_orange',
			'theme_core_mod_color_green_dark',
			'theme_core_mod_color_green',
			'theme_core_color_orange_light',
			'theme_core_color_orange_dark',
			'theme_core_color_orange_glow',
			'theme_core_color_orange_burnt',
			'theme_core_color_blue_light',
			'theme_core_color_blue_dark',
		);

		foreach ($keys as $key) {
			$key_theme_mod = get_theme_mod($key);
			if (!empty($key_theme_mod)) {
				update_option($key, $key_theme_mod);
				remove_theme_mod($key);
			}
		}
	}

	add_action('upgrader_process_complete', 'inspiry_update_theme_mod_to_options');
}

// Remove default image sizes here.
if (!function_exists('inspiry_remove_default_images')) {
	function inspiry_remove_default_images($sizes)
	{
		if ('true' == get_option('inspiry_unset_default_image_sizes')) {
			unset($sizes['small']); // 150px
			unset($sizes['medium']); // 300px
			unset($sizes['medium_large']); // 768px
			unset($sizes['1536x1536']); // 2x medium_large size.
			unset($sizes['large']); // 1024px
			unset($sizes['2048x2048']); // // 2x large size.
		}

		return $sizes;
	}

	add_filter('intermediate_image_sizes_advanced', 'inspiry_remove_default_images');
}

/**
 * This function runs when WordPress theme completes its upgrade process.
 *
 * @param $upgrader_object Array
 * @param $options         Array
 */
function inspiry_upgrade_function($upgrader_object, $options)
{

	if ('update' === $options['action'] && 'theme' === $options['type']) {

		delete_user_meta(get_current_user_id(), 'tgmpa_dismissed_notice_inspiry');
	}
}

add_action('upgrader_process_complete', 'inspiry_upgrade_function', 10, 2);

if (!function_exists('inspiry_filesize_formatted')) {
	/**
	 * This function returns the file size of specified path
	 *
	 * @param string $path Path of the file
	 *
	 * @return string File size with units
	 */
	function inspiry_filesize_formatted($path)
	{
		$size = filesize($path);
		$units = array('b', 'kb', 'mb', 'gb', 'tb');
		$power = $size > 0 ? floor(log($size, 1024)) : 0;

		return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
	}
}

if (!function_exists('inspiry_active_nav_class')) {
	function inspiry_active_nav_class($classes)
	{
		if (in_array('current-menu-ancestor', $classes) || in_array('current-menu-item', $classes)) {
			$classes[] = 'rh-active';
		}

		return $classes;
	}

	add_filter('nav_menu_css_class', 'inspiry_active_nav_class', 10, 1);
}

if (!function_exists('realhomes_unset_page_templates')) {

	/**
	 * This function unset the Page Templates from dropdown
	 *
	 * @since 4.0.0
	 *
	 * @param array $page_templates Page templates.
	 *
	 * @return array modified page templates array
	 */

	function realhomes_unset_page_templates($page_templates)
	{

		if ('ultra' === INSPIRY_DESIGN_VARIATION) {
			unset($page_templates['templates/optima-express.php']);
		}

		return $page_templates;
	}

	add_filter('theme_page_templates', 'realhomes_unset_page_templates');
}

// Change default email address and name
add_filter('wp_mail_from', 'custom_wp_mail_from');

function custom_wp_mail_from($email)
{
	return 'hello@dirabeharish.co.il';
}

// Define the old and new URLs
$old_url = 'https://dirabeharish.co.il/%D7%9C%D7%9E%D7%94-%D7%97%D7%A8%D7%99%D7%A9-%D7%96%D7%95%D7%9C%D7%94-%D7%94%D7%90%D7%9D-%D7%9B%D7%93%D7%90%D7%99-%D7%9C%D7%A7%D7%A0%D7%95%D7%AA-%D7%93%D7%99%D7%A8%D7%94-%D7%91%D7%97%D7%A8%D7%99-2/';
$new_url = 'https://dirabeharish.co.il/%D7%9C%D7%9E%D7%94-%D7%97%D7%A8%D7%99%D7%A9-%D7%96%D7%95%D7%9C%D7%94-%D7%94%D7%90%D7%9D-%D7%9B%D7%93%D7%90%D7%99-%D7%9C%D7%A7%D7%A0%D7%95%D7%AA-%D7%93%D7%99%D7%A8%D7%94-%D7%91%D7%97%D7%A8%D7%99/';

// Check if the requested URL matches the old URL
$request_uri = $_SERVER['REQUEST_URI'];
if ($request_uri === parse_url($old_url, PHP_URL_PATH)) {
	// Perform the redirect
	header('HTTP/1.1 301 Moved Permanently');
	header("Location: $new_url");
	exit;
}

function dirabe_get_hebrew_month($month)
{
	$hebrew_months = array(
		'January' => 'ינואר',
		'February' => 'פברואר',
		'March' => 'מרץ',
		'April' => 'אפריל',
		'May' => 'מאי',
		'June' => 'יוני',
		'July' => 'יולי',
		'August' => 'אוגוסט',
		'September' => 'ספטמבר',
		'October' => 'אוקטובר',
		'November' => 'נובמבר',
		'December' => 'דצמבר'
	);
	return $hebrew_months[$month] ?? $month;
}

function dirabe_show_agencys_and_agents_posts_preview($posts)
{
	global $wp_query, $wpdb;
	// Check if the requested URL is a single post page preview
	$user_id = get_current_user_id();
	if (!is_preview() || !is_single() || $wp_query->post_count > 0 || $user_id == 0) {
		return $posts;
	}

	$user_role = get_user_meta($user_id, 'inspiry_user_role', true);
	$user_post_id = get_user_meta($user_id, 'inspiry_role_post_id', true);
	$fetched_posts = $wpdb->get_results($wp_query->request);

	if (empty($fetched_posts) || empty($fetched_posts[0])) {
		return $posts;
	}

	$fetched_post = $fetched_posts[0];

	// Check permissions
	if ($user_role == 'agency' && $user_post_id) {
		// Check if agency is the post author, or one of the users agency is the post author
		// Get all users when inspiry_user_role is agent, and inspiry_user_agency === user_post_id
		$agent_user_ids = get_users(
			array(
				'meta_key' => 'inspiry_user_agency',
				'meta_value' => $user_post_id,
				'fields' => 'ID'
			)
		);
		$agent_user_ids[] = $user_id;
		$agent_user_ids = array_unique($agent_user_ids);
		if (in_array($fetched_post->post_author, $agent_user_ids)) {
			return $fetched_posts;
		}
	} else if ($user_role == 'agent' && $user_post_id) {
		$is_post_agent = get_post_meta($fetched_post->ID, 'REAL_HOMES_agents', true);
		if ($is_post_agent === $user_post_id) {
			return $fetched_posts;
		}
	}

	return $posts;
}
add_filter('the_posts', 'dirabe_show_agencys_and_agents_posts_preview');

// Temp code to update alt text for property images
// if (isset($_GET['test'])) {
// 	function custom_process_property_data()
// 	{
// 		// Get all posts with the post type "property"
// 		$properties = get_posts(
// 			array(
// 				'post_type' => 'property',
// 				'numberposts' => -1,
// 			)
// 		);

// 		// Loop through each property and get images from post meta 'REAL_HOMES_property_images'
// 		foreach ($properties as $property) {
// 			$alt_text_info = [];
// 			$alt_text_info['city'] = esc_html__('חריש', 'framework');
// 			$alt_text_info['apartment_desc'] = esc_html__('דירת', 'framework');
// 			$alt_text_info['bedrooms'] = !empty(trim(get_post_meta($property->ID, 'REAL_HOMES_property_bedrooms', true))) && intval(trim(get_post_meta($property->ID, 'REAL_HOMES_property_bedrooms', true))) > 0 ? intval(trim(get_post_meta($property->ID, 'REAL_HOMES_property_bedrooms', true))) : 0;
// 			$alt_text_info['bedrooms_desc'] = esc_html__('חדרים', 'framework');
// 			$alt_text_info['street_desc'] = esc_html__('שכונת', 'framework');
// 			$alt_text_info['contractor'] = !empty(trim(get_post_meta($property->ID, 'inspiry_קבלן', true))) ? trim(get_post_meta($property->ID, 'inspiry_קבלן', true)) : '';
// 			$alt_text_info['contractor_desc'] = esc_html__('קבלן', 'framework');

// 			$status_terms = wp_get_object_terms($property->ID, 'property-status');
// 			$alt_text_info['status'] = '';
// 			if (!is_wp_error($status_terms) && !empty($status_terms)) {
// 				$alt_text_info['status'] = $status_terms[0]->name; // Assuming there's only one status term
// 			}
// 			$alt_text_info['street'] = '';
// 			$location_terms = wp_get_object_terms($property->ID, 'property-city');
// 			if (!is_wp_error($location_terms) && !empty($location_terms)) {
// 				$alt_text_info['street'] = $location_terms[0]->name; // Assuming there's only one location term
// 			}

// 			$alt_text = '';
// 			if (!empty($alt_text_info['status'])) {
// 				$alt_text .= $alt_text_info['status'] . ' ';
// 			}
// 			$alt_text .= 'ב' . $alt_text_info['city'] . ' ';

// 			if ($alt_text_info['bedrooms'] > 0) {
// 				$alt_text .= $alt_text_info['apartment_desc'] . ' ' . $alt_text_info['bedrooms'] . ' ' . $alt_text_info['bedrooms_desc'] . ' ';
// 			}
// 			if (!empty($alt_text_info['street'])) {
// 				$alt_text .= 'ב' . $alt_text_info['street_desc'] . ' ' . $alt_text_info['street'] . ' ';
// 			}
// 			if (!empty($alt_text_info['contractor'])) {
// 				$alt_text .= $alt_text_info['contractor_desc'] . ' ' . $alt_text_info['contractor'];
// 			}

// 			$images = get_post_meta($property->ID, 'REAL_HOMES_property_images');
// 			foreach ($images as $image_id) {
// 				update_post_meta($image_id, '_wp_attachment_image_alt', sanitize_text_field(trim($alt_text)));
// 			}
// 		}
// 	}

// 	add_action('wp_loaded', 'custom_process_property_data');
// }
