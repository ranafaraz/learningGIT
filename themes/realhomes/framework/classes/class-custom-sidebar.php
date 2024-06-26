<?php
/**
 * This class is responsible for the custom sidebar generator on "Dashboard > Widgets" screen.
 *
 * @since 4.2.0
 */
class RealHomes_Custom_Sidebar {

	/**
	 * Title of the sidebar generator area.
	 *
	 * @since 4.2.0
	 * @var string
	 */
	protected $title;

	/**
	 * Custom sidebars carrier.
	 *
	 * @since 4.2.0
	 * @var array
	 */
	protected $sidebars;

	/**
	 * Name of the option to store custom sidebars.
	 *
	 * @since 4.2.0
	 * @var string
	 */
	protected $stored;

	/**
	 * Load important stuff for the custom sidebar generator.
	 *
	 * @since 4.2.0
	 */
	public function __construct() {

		$this->sidebars = array();
		$this->stored   = 'realhomes_custom_sidebars';
		$this->title    = esc_html__( 'RealHomes Custom Sidebar', 'framework' );

		add_action( 'load-widgets.php', array( $this, 'load_sidebar_assets' ), 5 );
		add_action( 'widgets_init', array( $this, 'register_custom_sidebars' ), 1000 );
		add_action( 'wp_ajax_rh_ajax_delete_custom_sidebar', array( $this, 'delete_sidebar_area' ), 1000 );
	}

	public function load_sidebar_assets() {
		add_action( 'admin_print_scripts', array( $this, 'print_sidebar_generator_form' ) );
		add_action( 'load-widgets.php', array( $this, 'add_sidebar_area' ), 100 );

		wp_enqueue_script( 'rh_sidebar', INSPIRY_COMMON_URI . 'js/custom-sidebar.js' );

		wp_localize_script( 'rh_sidebar', 'customSidebar', array( 'deleteAlert' => esc_html__( 'Are you sure you want to delete the {sidebar_name} sidebar?', 'framework' ) ) );
	}

	public function print_sidebar_generator_form() {

		$sidebar_gen_form = "\n<script type='text/html' id='rh-add-sidebar-form-script'>";
		$sidebar_gen_form .= "\n <form class='rh-add-sidebar-form " . INSPIRY_DESIGN_VARIATION . "' method='POST'>";
		$sidebar_gen_form .= "\n  <h3>{$this->title}</h3>";
		$sidebar_gen_form .= "\n  <span class='rh-sidebar-field-wrap'><input name='rh_add_sidebar' type='text' value='' placeholder = '" . esc_html__( 'Provide the new sidebar name here', 'framework' ) . "' /></span>";
		$sidebar_gen_form .= "\n  <input class='rh-add-sidebar-btn' type='submit' value='" . esc_html__( 'Add Sidebar Area', 'framework' ) . "' />";
		$sidebar_gen_form .= "\n  <input type='hidden' name='realhomes-delete-custom-sidebar-nonce' value='" . wp_create_nonce( 'rh-delete-custom-sidebar-nonce' ) . "' />";
		$sidebar_gen_form .= "\n </form>";
		$sidebar_gen_form .= "\n</script>\n";

		echo $sidebar_gen_form;
	}

	public function add_sidebar_area() {

		if ( ! empty( $_POST['rh_add_sidebar'] ) ) {

			if ( ! current_user_can( 'manage_options' ) ) {
				die();
			}

			$this->sidebars = get_option( $this->stored );
			$sidebar_name   = $this->unique_name( stripslashes( $_POST['rh_add_sidebar'] ) );

			if ( empty( $this->sidebars ) ) {
				$this->sidebars = array( $sidebar_name );
			} else {
				$this->sidebars = array_merge( $this->sidebars, array( $sidebar_name ) );
			}

			update_option( $this->stored, $this->sidebars );
			wp_redirect( admin_url( 'widgets.php' ) );

			die();
		}
	}

	protected function unique_name( $name ) {
		global $wp_registered_sidebars;

		if ( empty( $wp_registered_sidebars ) ) {
			return $name;
		}

		$taken = array();

		foreach ( $wp_registered_sidebars as $sidebar ) {
			$taken[] = $sidebar['name'];
		}

		if ( empty( $this->sidebars ) ) {
			$this->sidebars = array();
		}

		$taken = array_merge( $taken, $this->sidebars );

		if ( in_array( $name, $taken ) ) {
			$counter  = substr( $name, -1 );

			if ( ! is_numeric( $counter ) ) {
				$new_name = $name . ' 1';
			} else {
				$new_name = substr( $name, 0, -1 ) . ( (int)$counter + 1 );
			}

			$name = $this->unique_name( $new_name );
		}

		return $name;
	}

	public function register_custom_sidebars() {

		if ( empty( $this->sidebars ) ) {
			$this->sidebars = get_option( $this->stored );
		}

		$args = array(
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="title">',
			'after_title'   => '</h3>',
		);

		$args = apply_filters( 'rh_custom_sidebar_args', $args );

		if ( is_array( $this->sidebars ) ) {
			foreach ( $this->sidebars as $sidebar ) {
				$args['name']  = $sidebar;
				$args['id']    = inspiry_backend_safe_string( $sidebar, '-' );
				$args['class'] = 'rh-custom';

				register_sidebar( $args );
			}
		}
	}

	public function delete_sidebar_area() {

		check_ajax_referer( 'rh-delete-custom-sidebar-nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		if ( ! empty( $_POST['name'] ) ) {
			$name           = stripslashes( $_POST['name'] );
			$this->sidebars = get_option( $this->stored );

			$key = array_search( $name, $this->sidebars );

			if ( $key !== false ) {
				unset( $this->sidebars[ $key ] );
				update_option( $this->stored, $this->sidebars );

				echo 'sidebar-deleted';
			}
		}

		die();
	}

	public static function get_attached_sidebar( $current_sidebar = 'default-sidebar' ) {

		if ( is_home() ) {
			$id = get_option( 'page_for_posts' );
		} else {
			$id = get_the_ID();
		}

		$custom_sidebar = get_post_meta( $id, 'realhomes_custom_sidebar', true );

		// A single post returns empty sidebar if not updated
		if ( empty( $custom_sidebar ) ) {
			$custom_sidebar = 'default';
		}

		if ( ( is_home() && 'default' === $custom_sidebar ) || ( is_single() && 'post' == get_post_type() && 'default' === $custom_sidebar ) || is_category() ) {
			$custom_sidebar = get_option( 'realhomes_blog_page_sidebar', 'default' );
		}

		// Set custom sidebar if it's available
		if ( ! empty( $custom_sidebar ) && 'default' != $custom_sidebar ) {
			return $custom_sidebar;
		}

		return $current_sidebar;
	}
}

new RealHomes_Custom_Sidebar();