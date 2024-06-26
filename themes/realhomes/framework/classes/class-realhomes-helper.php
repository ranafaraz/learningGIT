<?php

/**
 * RealHomes_Helper class is designed to provide additional support to the theme
 * by providing a set of utility methods and data for several common tasks.
 *
 * @since 4.1.1
 */
class RealHomes_Helper {

	/**
	 * Theme version private variable
	 *
	 * @since 4.1.1
	 *
	 * @var string
	 */
	private static $theme_version;


	/**
	 * Plugin versions array private variable with current and required information attached
	 *
	 * @since 4.1.1
	 *
	 * @var array|mixed
	 */
	private static $plugin_versions;

	/**
	 * Initial constructor calls
	 *
	 * @since 4.1.1
	 */
	public function __construct() {
		$this->rhc_set_theme_version();
		$this->rhc_set_plugin_versions();
	}


	/**
	 * Setting plugin current versions
	 *
	 * @since 4.1.1
	 */
	private function rhc_set_theme_version() {

		// Getting current theme
		$current_theme = wp_get_theme();

		// Checking if child theme is active
		if ( $current_theme->exists() && $current_theme->parent() ) {
			// Getting parent theme
			$realhomes_theme = $current_theme->parent();

			// Getting parent theme version
			self::$theme_version = $realhomes_theme->get( 'Version' );

		} else {

			// Getting parent theme version
			self::$theme_version = $current_theme->get( 'Version' );

		}
	}


	/**
	 * Setting current theme version
	 *
	 * @since 4.1.1
	 */
	private function rhc_set_plugin_versions() {

		self::$plugin_versions = array(
			'easy-real-estate'             => [ 'version' => '2.2.1' ],
			'realhomes-elementor-addon'    => [ 'version' => '2.3.1' ],
			'realhomes-vacation-rentals'   => [ 'version' => '1.4.1' ],
			'realhomes-demo-import'        => [ 'version' => '2.0.7' ],
			'realhomes-property-expirator' => [ 'version' => '2.0.0' ],
			'realhomes-wc-payments-addon'  => [ 'version' => '1.0.2' ],
			'real-estate-crm'              => [ 'version' => '1.0.0' ],
			'revslider'                    => [ 'version' => '6.7.10' ],
			'realhomes-currency-switcher'  => [ 'version' => '1.0.7' ],
			'inspiry-memberships'          => [ 'version' => '3.0.1' ],
			'quick-and-easy-faqs'          => [ 'version' => '1.3.10' ]
		);
	}


	/**
	 * Getting version information for given plugin name
	 *
	 * @since 4.1.1
	 *
	 * @return string
	 */
	public static function get_theme_version() {

		return self::$theme_version;

	}


	/**
	 * Getting version information for given plugin name
	 *
	 * @since 4.1.1
	 *
	 * @param string $plugin
	 *
	 * @return string|boolean
	 */
	public static function get_plugin_version( $plugin = '' ) {

		if ( ! empty( self::$plugin_versions[ $plugin ]['version'] ) ) {
			return self::$plugin_versions[ $plugin ]['version'];
		}

		return false;
	}

}

// Initiating class for the first time
new RealHomes_Helper();