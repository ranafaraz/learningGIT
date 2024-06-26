<?php
if ( ! function_exists( 'realhomes_meta_boxes' ) ) {
	/**
	 * Provides the theme meta boxes tabs configuration.
	 *
	 * @since 4.1.0
	 *
	 * @param $meta_boxes
	 *
	 * @return array
	 */
	function realhomes_meta_boxes( $meta_boxes ) {
		global $post_type, $post, $post_id;

		if ( isset( $_GET['post_type'] ) ) {
			$post_type = sanitize_key( $_GET['post_type'] );
		} else if ( isset( $_GET['post'] ) ) {
			$post_id = (int) $_GET['post'];
		} else if ( isset( $_POST['post_ID'] ) ) {
			$post_id = (int) $_POST['post_ID'];
		} else {
			$post_id = 0;
		}

		if ( $post_id ) {
			$post = get_post( $post_id );
		}

		if ( $post ) {
			$post_type = $post->post_type;
		}

		$tabs   = array();
		$fields = array();

		// Header & Footer Meta Box Settings.
		if ( class_exists( 'RHEA_Elementor_Header_Footer' ) ) {
			require_once( INSPIRY_FRAMEWORK . 'include/meta-boxes/header-meta-box.php' );
			require_once( INSPIRY_FRAMEWORK . 'include/meta-boxes/footer-meta-box.php' );
		}

		// Custom Sidebar for post types
		if ( in_array( $post_type, array( 'post', 'property', 'agent', 'agency' ) ) ) {
			require_once( INSPIRY_FRAMEWORK . 'include/meta-boxes/custom-sidebar.php' );
		}

		// Elementor Based Single Property Template Meta Box Settings.
		if ( 'ultra' === INSPIRY_DESIGN_VARIATION && 'property' === $post_type && class_exists( 'RHEA_Elementor_Single_Property' ) ) {
			require_once( INSPIRY_FRAMEWORK . 'include/meta-boxes/elementor-single-property-meta-box.php' );
		}

		// Search Meta Box Settings.
		if ( 'classic' !== INSPIRY_DESIGN_VARIATION ) {
			require_once( INSPIRY_FRAMEWORK . 'include/meta-boxes/search-meta-box.php' );
		}

		if ( 'page' === $post_type ) {
			// Page Layout and Sidebar Meta Box Settings
			require_once( INSPIRY_FRAMEWORK . 'include/meta-boxes/page-layout-and-sidebar.php' );
		}

		// Banner Meta Box Settings.
		if ( in_array( $post_type, array( 'page', 'agent', 'agency' ) ) ) {
			require_once( INSPIRY_FRAMEWORK . 'include/meta-boxes/banner-meta-box.php' );
		}

		if ( 'page' === $post_type ) {
			// Page Title Meta Box Settings.
			require_once( INSPIRY_FRAMEWORK . 'include/meta-boxes/page-title-meta-box.php' );

			// Content Area Meta Box Settings.
			require_once( INSPIRY_FRAMEWORK . 'include/meta-boxes/content-area.php' );

			// Property Grid Template Meta Box Settings.
			if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
				require_once( INSPIRY_FRAMEWORK . 'include/meta-boxes/property-card-meta-box.php' );
			}

			// Contact Page Meta Box Settings.
			require_once( INSPIRY_FRAMEWORK . 'include/meta-boxes/contact-page-meta-box.php' );

			// Partners Section Meta Box Settings for Contact Page in Ultra.
			if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
				require_once( INSPIRY_FRAMEWORK . 'include/meta-boxes/partners-meta-box.php' );
			}
		}

		// Elementor Based Single Agent Template Meta Box Settings.
		if ( 'ultra' === INSPIRY_DESIGN_VARIATION && ( 'agent' === $post_type || 'agency' === $post_type ) && ( class_exists( 'RHEA_Elementor_Single_Agent' ) || class_exists( 'RHEA_Elementor_Single_Agency' ) ) ) {
			require_once( INSPIRY_FRAMEWORK . 'include/meta-boxes/elementor-single-agent-agency-meta-box.php' );
		}

		// RealHomes Misc Meta Box.
		$meta_boxes[] = array(
			'id'         => 'realhomes-page-meta-boxes',
			'title'      => esc_html__( 'RealHomes Misc Settings', 'framework' ),
			'post_types' => array( 'page', 'post', 'agent', 'agency', 'property' ),
			'hide'       => array(
				'template' => array(
					'templates/dashboard.php',
				),
			),
			'context'    => 'normal',
			'priority'   => 'low',
			'tabs'       => apply_filters( 'realhomes_metabox_tabs', $tabs ),
			'tab_style'  => 'left',
			'fields'     => apply_filters( 'realhomes_metabox_fields', $fields ),
		);

		return apply_filters( 'realhomes_metabox', $meta_boxes );
	}

	add_filter( 'rwmb_meta_boxes', 'realhomes_meta_boxes' );

	/**
	 * Controls the tabs & panels visibility based on given conditions.
	 *
	 * @link  https://docs.metabox.io/hide-tabs-with-conditional-logic/ Documentation of hide tabs
	 *
	 * @since 4.1.0
	 *
	 * @param $conditions
	 *
	 * @return array
	 */
	function realhomes_meta_boxes_outside_conditions( $conditions ) {

		$common_templates = array(
			array( 'page_template', 'templates/2-columns-gallery.php' ),
			array( 'page_template', 'templates/3-columns-gallery.php' ),
			array( 'page_template', 'templates/4-columns-gallery.php' ),
			array( 'page_template', 'templates/agencies-list.php' ),
			array( 'page_template', 'templates/agents-list.php' ),
			array( 'page_template', 'templates/compare-properties.php' ),
			array( 'page_template', 'templates/contact.php' ),
			array( 'page_template', 'templates/grid-layout.php' ),
			array( 'page_template', 'templates/grid-layout-full-width.php' ),
			array( 'page_template', 'templates/half-map-layout.php' ),
			array( 'page_template', 'templates/list-layout.php' ),
			array( 'page_template', 'templates/list-layout-full-width.php' ),
			array( 'page_template', 'templates/properties-search.php' ),
			array( 'page_template', 'templates/properties-search-half-map.php' ),
			array( 'page_template', 'templates/properties-search-left-sidebar.php' ),
			array( 'page_template', 'templates/properties-search-right-sidebar.php' ),
		);

		$templates_for_spacing_tab = array(
			array( 'page_template', 'templates/full-width.php' ),
			array( 'page_template', 'templates/fluid-width.php' ),
		);

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$conditions['.rwmb-tab-spacing'] = array(
				'visible' => array(
					'when'     => array_merge( $common_templates, $templates_for_spacing_tab ),
					'relation' => 'or'
				)
			);

			$conditions['.rwmb-tab-page_title_tab'] = array(
				'visible' => array(
					'when'     => array(
						array( 'page_template', '' ),
						array( 'page_template', 'elementor_theme' ),
						array( 'page_template', 'templates/optima-express.php' ),
						array( 'page_template', 'templates/full-width.php' ),
						array( 'page_template', 'templates/fluid-width.php' ),
					),
					'relation' => 'or',
				)
			);

		} else {
			$conditions['.rwmb-tab-spacing'] = array(
				'visible' => array(
					'when'     => $templates_for_spacing_tab,
					'relation' => 'or'
				)
			);
		}

		$conditions['.rwmb-tab-content_area'] = array(
			'visible' => array(
				'when'     => $common_templates,
				'relation' => 'or'
			)
		);

		$conditions['.rwmb-tab-page_title, .rwmb-tab-page_head_content'] = array(
			'hidden' => array(
				'when'     => array(
					array( 'page_template', 'templates/home.php' ),
				),
				'relation' => 'or'
			)
		);

		$conditions['.rwmb-tab-banner'] = array(
			'hidden' => array(
				'when'     => array(
					array( 'page_template', 'templates/home.php' ),
					array( 'page_template', 'templates/properties-search-half-map.php' ),
				),
				'relation' => 'or'
			)
		);

		if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
			$conditions['.rwmb-tab-contact_form, .rwmb-tab-map, .rwmb-tab-detail, .rwmb-tab-contact_form, .rwmb-tab-partners'] = array(
				'visible' => array(
					'when' => array(
						array( 'page_template', 'templates/contact.php' )
					),
				)
			);
		}

		$conditions['.rwmb-tab-property_grid_layout'] = array(
			'visible' => array(
				'when'     => array(
					array( 'page_template', 'templates/grid-layout.php' ),
					array( 'page_template', 'templates/grid-layout-full-width.php' ),
				),
				'relation' => 'or'
			)
		);

		$conditions['.rwmb-tab-page_layout'] = array(
			'visible' => array(
				'when'     => array(
					array( 'page_template', '' ),
					array( 'page_template', 'templates/properties.php' ),
					array( 'page_template', 'templates/properties-search.php' ),
					array( 'page_template', 'templates/list-layout.php' ),
					array( 'page_template', 'templates/grid-layout.php' ),
					array( 'page_template', 'templates/properties-search-left-sidebar.php' ),
					array( 'page_template', 'templates/properties-search-right-sidebar.php' ),
					array( 'page_template', 'templates/agents-list.php' ),
					array( 'page_template', 'templates/agencies-list.php' ),
					array( 'page_template', 'templates/users-lists.php' ),
					array( 'page_template', 'elementor_theme' ),
				),
				'relation' => 'or'
			)
		);

		return apply_filters( 'realhomes_meta_boxes_outside_conditions', $conditions );
	}

	add_filter( 'rwmb_outside_conditions', 'realhomes_meta_boxes_outside_conditions' );
}