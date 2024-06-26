<?php
if ( ! function_exists( 'inspiry_blog_customizer' ) ) {
	function inspiry_blog_customizer( WP_Customize_Manager $wp_customize ) {
		// Blog Section
		$wp_customize->add_section( 'inspiry_news_section', array(
			'title'    => esc_html__( 'Blog Page', 'framework' ),
			'priority' => 125,
		) );

		// Modern Header Banner or None
		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting( 'inspiry_news_header_variation', array(
				'type'              => 'option',
				'default'           => 'banner',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'inspiry_news_header_variation', array(
				'label'       => esc_html__( 'Header Variation', 'framework' ),
				'description' => esc_html__( 'Header variation to display on News Page.', 'framework' ),
				'type'        => 'radio',
				'section'     => 'inspiry_news_section',
				'choices'     => array(
					'banner' => esc_html__( 'Banner', 'framework' ),
					'none'   => esc_html__( 'None', 'framework' ),
				),
			) );
		}

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			// News/Blog Page Banner Title and Sub Title Display
			$wp_customize->add_setting( 'inspiry_news_page_banner_title_display', array(
				'type'              => 'option',
				'default'           => 'true',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'inspiry_news_page_banner_title_display', array(
				'label'   => esc_html__( 'Banner Title and Sub Title Display', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_news_section',
				'choices' => array(
					'true'  => esc_html__( 'Show', 'framework' ),
					'false' => esc_html__( 'Hide', 'framework' ),
				),
			) );
		}

		// Blog Banner Title
		$blog_page_control_label = esc_html__( 'Banner Title', 'framework' );
		if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
			$blog_page_control_label = esc_html__( 'Title', 'framework' );
		}

		$wp_customize->add_setting( 'theme_news_banner_title', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'News', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_news_banner_title', array(
			'label'   => $blog_page_control_label,
			'type'    => 'text',
			'section' => 'inspiry_news_section',
		) );

		$theme_news_banner_title_selector = '.blog .page-head .wrap .page-title';
		$container_inclusive              = true;
		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$theme_news_banner_title_selector = '.blog .rh_banner .rh_banner__title';
			$container_inclusive              = false;
		}

		// News Banner Title Selective Refresh
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_news_banner_title', array(
				'selector'            => $theme_news_banner_title_selector,
				'container_inclusive' => $container_inclusive,
				'render_callback'     => 'inspiry_news_banner_title_render',
			) );
		}

		if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
			// Blog page description
			$wp_customize->add_setting( 'realhomes_blog_page_description', array(
				'type'              => 'option',
				'default'           => esc_html__( 'Check out market updates', 'framework' ),
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_blog_page_description', array(
				'label'   => esc_html__( 'Description ', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_news_section',
			) );
		}

		$wp_customize->add_setting( 'realhomes_display_blog_meta', array(
			'type'              => 'option',
			'default'           => 'true',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_display_blog_meta', array(
			'label'       => esc_html__( 'Display Blog Meta', 'framework' ),
			'description' => esc_html__( 'Do you want to display blog meta information?', 'framework' ),
			'type'        => 'radio',
			'section'     => 'inspiry_news_section',
			'choices'     => array(
				'true'  => esc_html__( 'Show', 'framework' ),
				'false' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			// News Banner Sub Title
			$wp_customize->add_setting( 'theme_news_banner_sub_title', array(
				'type'              => 'option',
				'transport'         => 'postMessage',
				'default'           => esc_html__( 'Check out market updates', 'framework' ),
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'theme_news_banner_sub_title', array(
				'label'   => esc_html__( 'Banner Sub Title', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_news_section',
			) );

			// News Banner Sub Title Selective Refresh
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial( 'theme_news_banner_sub_title', array(
					'selector'            => '.blog .page-head .wrap .page-title +',
					'container_inclusive' => true,
					'render_callback'     => 'inspiry_news_banner_sub_title_render',
				) );
			}

			// Link to Previous and Next Post
			$wp_customize->add_setting( 'inspiry_post_prev_next_link', array(
				'type'              => 'option',
				'default'           => 'true',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'inspiry_post_prev_next_link', array(
				'label'   => esc_html__( 'Link to Previous and Next Post', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_news_section',
				'choices' => array(
					'true'  => esc_html__( 'Enable', 'framework' ),
					'false' => esc_html__( 'Disable', 'framework' ),
				),
			) );
		}

		// Creating an array of all registered sidebars
		global $wp_registered_sidebars;
		$all_sidebars = array(
			'default' => esc_html__( 'Default', 'framework' ),
		);
		foreach ( $wp_registered_sidebars as $sidebar ) {
			$all_sidebars[ $sidebar['id'] ] = $sidebar['name'];
		}

		if ( 'classic' !== INSPIRY_DESIGN_VARIATION ) {

			$wp_customize->add_setting( 'realhomes_blog_page_layout', array(
				'type'              => 'option',
				'default'           => 'default',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'realhomes_blog_page_layout', array(
				'label'   => esc_html__( 'Page Layout', 'framework' ),
				'type'    => 'select',
				'section' => 'inspiry_news_section',
				'choices' => array(
					'default'   => esc_html__( 'Default', 'framework' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'framework' ),
				),
			) );

			$wp_customize->add_setting( 'realhomes_blog_page_sidebar', array(
				'type'              => 'option',
				'default'           => 'default',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'realhomes_blog_page_sidebar', array(
				'label'   => esc_html__( 'Sidebar', 'framework' ),
				'description' => esc_html__( 'Select a custom sidebar for the Blog pages.', 'framework' ),
				'type'    => 'select',
				'section' => 'inspiry_news_section',
				'choices' => $all_sidebars,
			) );

			$wp_customize->add_setting( 'realhomes_blog_page_columns', array(
				'type'              => 'option',
				'default'           => '3',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'realhomes_blog_page_columns', array(
				'label'           => esc_html__( 'Number of Columns', 'framework' ),
				'type'            => 'select',
				'section'         => 'inspiry_news_section',
				'choices'         => array(
					'2' => esc_html__( '2 Columns', 'framework' ),
					'3' => esc_html__( '3 Columns', 'framework' ),
					'4' => esc_html__( '4 Columns', 'framework' ),
				),
				'active_callback' => function () {
					return ( in_array( get_option( 'realhomes_blog_page_grid_card_design', '1' ), array( '1', '2' ) ) && realhomes_is_blog_grid_layout() && 'fullwidth' === get_option( 'realhomes_blog_page_layout', 'default' ) );
				}
			) );

			$wp_customize->add_setting( 'realhomes_blog_page_card_layout', array(
				'type'              => 'option',
				'default'           => 'list',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'realhomes_blog_page_card_layout', array(
				'label'   => esc_html__( 'Card Layout', 'framework' ),
				'type'    => 'select',
				'section' => 'inspiry_news_section',
				'choices' => array(
					'list' => esc_html__( 'List', 'framework' ),
					'grid' => esc_html__( 'Grid', 'framework' ),
				),
			) );

			$wp_customize->add_setting( 'realhomes_blog_page_grid_card_design', array(
				'type'              => 'option',
				'default'           => '1',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'realhomes_blog_page_grid_card_design', array(
				'section'         => 'inspiry_news_section',
				'type'            => 'select',
				'label'           => esc_html__( 'Card Design', 'framework' ),
				'choices'         => array(
					'1' => esc_html__( 'One', 'framework' ),
					'2' => esc_html__( 'Two', 'framework' ),
					'3' => esc_html__( 'Three', 'framework' ),
				),
				'active_callback' => 'realhomes_is_blog_grid_layout'
			) );

			$wp_customize->add_setting( 'realhomes_post_layout_shift', array(
				'type'              => 'option',
				'default'           => 'false',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_post_layout_shift', array(
				'label'           => esc_html__( 'Shift First Two Posts Layout', 'framework' ),
				'type'            => 'radio',
				'section'         => 'inspiry_news_section',
				'choices'         => array(
					'true'  => esc_html__( 'Yes', 'framework' ),
					'false' => esc_html__( 'No', 'framework' ),
				),
				'active_callback' => function () {
					return ( '2' === get_option( 'realhomes_blog_page_grid_card_design', '1' ) && 'grid' === get_option( 'realhomes_blog_page_card_layout', 'list' ) );
				}
			) );

			$wp_customize->add_setting( 'realhomes_post_excerpt_length', array(
				'type'              => 'option',
				'default'           => '25',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_post_excerpt_length', array(
				'label'           => esc_html__( 'Excerpt Length', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_news_section',
				'active_callback' => 'realhomes_is_blog_grid_layout'
			) );

		} else {
            // - Blog Sidebar option for Classic Design -
			$wp_customize->add_setting( 'realhomes_blog_page_sidebar', array(
				'type'              => 'option',
				'default'           => 'default',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'realhomes_blog_page_sidebar', array(
				'label'   => esc_html__( 'Blog Sidebar', 'framework' ),
				'description' => esc_html__( 'Select a custom sidebar for the Blog pages.', 'framework' ),
				'type'    => 'select',
				'section' => 'inspiry_news_section',
				'choices' => $all_sidebars,
			) );
        }

	}

	add_action( 'customize_register', 'inspiry_blog_customizer' );
}

if ( ! function_exists( 'inspiry_blog_defaults' ) ) {
	function inspiry_blog_defaults( WP_Customize_Manager $wp_customize ) {
		$blog_settings_ids = array(
			'inspiry_news_header_variation',
			'theme_news_banner_title',
			'theme_news_banner_sub_title',
			'inspiry_post_prev_next_link',
		);
		inspiry_initialize_defaults( $wp_customize, $blog_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_blog_defaults' );
}

if ( ! function_exists( 'inspiry_news_banner_title_render' ) ) {
	function inspiry_news_banner_title_render() {
		$banner_title = get_option( 'theme_news_banner_title' );
		if ( ! empty( $banner_title ) ) {
			if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
				echo esc_html( $banner_title );
			} else if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
				if ( is_single() ) :
					?><h2 class="page-title"><span><?php echo esc_html( $banner_title ); ?></span></h2><?php
				else :
					?><h1 class="page-title"><span><?php echo esc_html( $banner_title ); ?></span></h1><?php
				endif;
			}
		}
	}
}

if ( ! function_exists( 'inspiry_news_banner_sub_title_render' ) ) {
	function inspiry_news_banner_sub_title_render() {
		if ( get_option( 'theme_news_banner_sub_title' ) ) {
			echo '<p>' . get_option( 'theme_news_banner_sub_title' ) . '</p>';
		}
	}
}

if ( ! function_exists( 'realhomes_is_blog_grid_layout' ) ) {
	function realhomes_is_blog_grid_layout() {
		return ( 'grid' === get_option( 'realhomes_blog_page_card_layout', 'list' ) );
	}
}