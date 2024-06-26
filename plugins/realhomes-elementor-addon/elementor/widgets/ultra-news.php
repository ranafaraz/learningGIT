<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_News_Grid extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-news';
	}

	public function get_title() {
		return esc_html__( 'Ultra News Grid', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'ultra-real-homes' ];
	}

	protected function register_controls() {
		$grid_size_array = wp_get_additional_image_sizes();

		$prop_grid_size_array = array();
		foreach ( $grid_size_array as $key => $value ) {
			$str_rpl_key = ucwords( str_replace( "-", " ", $key ) );

			$prop_grid_size_array[ $key ] = $str_rpl_key . ' - ' . $value['width'] . 'x' . $value['height'];
		}

		unset( $prop_grid_size_array['partners-logo'] );
		unset( $prop_grid_size_array['property-detail-slider-thumb'] );
		unset( $prop_grid_size_array['post-thumbnail'] );
		unset( $prop_grid_size_array['agent-image'] );
		unset( $prop_grid_size_array['post-featured-image'] );

		if ( INSPIRY_DESIGN_VARIATION == 'modern' ) {
			$default_prop_grid_size = 'modern-property-child-slider';
		} else {
			$default_prop_grid_size = 'gallery-two-column-image';
		}


		$this->start_controls_section(
			'rhea_ultra_news_grid',
			[
				'label' => esc_html__( 'Basic Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ere_news_grid_thumb_sizes',
			[
				'label'   => esc_html__( 'Thumbnail Size', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => $default_prop_grid_size,
				'options' => $prop_grid_size_array
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => esc_html__( 'Number of Posts', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
				'default' => 3,
			]
		);

		// Select controls for Custom Taxonomies related to Property
		$property_taxonomies = get_object_taxonomies( 'post', 'objects' );
		if ( ! empty( $property_taxonomies ) && ! is_wp_error( $property_taxonomies ) ) {
			foreach ( $property_taxonomies as $single_tax ) {
				$options = [];
				$terms   = get_terms( $single_tax->name );

				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
					foreach ( $terms as $term ) {
						$options[ $term->slug ] = $term->name;
					}
				}

				$this->add_control(
					$single_tax->name,
					[
						'label'       => $single_tax->label,
						'type'        => \Elementor\Controls_Manager::SELECT2,
						'multiple'    => true,
						'label_block' => true,
						'options'     => $options,
					]
				);
			}
		}


		// Sorting Controls
		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'date'       => esc_html__( 'Date', 'realhomes-elementor-addon' ),
					'title'      => esc_html__( 'Title', 'realhomes-elementor-addon' ),
					'menu_order' => esc_html__( 'Menu Order', 'realhomes-elementor-addon' ),
					'rand'       => esc_html__( 'Random', 'realhomes-elementor-addon' ),
				],
				'default' => 'date',
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'asc'  => esc_html__( 'Ascending', 'realhomes-elementor-addon' ),
					'desc' => esc_html__( 'Descending', 'realhomes-elementor-addon' ),
				],
				'default' => 'desc',
			]
		);


		$this->add_control(
			'offset',
			[
				'label'   => esc_html__( 'Offset or Skip From Start', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => '0'
			]
		);

		$this->add_control(
			'show_author',
			[
				'label'        => esc_html__( 'Show Author', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'by-label',
			[
				'label'     => esc_html__( 'By', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'By', 'realhomes-elementor-addon' ),
				'condition' => [
					'show_author' => 'yes',
				],
			]
		);


		$this->add_control(
			'show_date',
			[
				'label'        => esc_html__( 'Show Date', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);


		$this->add_control(
			'show_excerpt',
			[
				'label'        => esc_html__( 'Show Excerpt', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'excerpt-length',
			[
				'label'     => esc_html__( 'Excerpt Length (Words)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 5,
				'max'       => 100,
				'default'   => 18,
				'condition' => [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_category',
			[
				'label'        => esc_html__( 'Show Category', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'read-more-text',
			[
				'label'   => esc_html__( 'Read More', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'     => esc_html__( 'View Button Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => esc_html__( 'Icon Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-news-read-more i' => 'font-size: {{SIZE}}px',
					'{{WRAPPER}} .svg-icon'              => 'width: {{SIZE}}px',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'news_typo_section',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'news_heading_typography',
				'label'    => esc_html__( 'Post Title', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} h3.rhea_ultra_post_title a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'news_date_typography',
				'label'    => esc_html__( 'date', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} p.rhea_ultra_news_date .rhea_ultra_date',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'news_excerpt_typography',
				'label'    => esc_html__( 'Excerpt', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} p.rhea_ultra_post_excerpt',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'news_catagory_typography',
				'label'    => esc_html__( 'Catagory', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} p.rhea_ultra_post_tags a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'news_by_typography',
				'label'     => esc_html__( 'By', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea_by',
				'condition' => [
					'show_author' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'news_author_typography',
				'label'     => esc_html__( 'Author', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .author-link',
				'condition' => [
					'show_author' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'news_review_more_typography',
				'label'     => esc_html__( 'Read More', 'realhomes-elementor-addon' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .rhea-read-more',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'news_basic_settings_section',
			[
				'label' => esc_html__( 'Basic Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'news_author_padding',
			[
				'label'      => esc_html__( 'Author Area Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea_ultra_post_author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'show_author' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'news_thumb_margin_bottom',
			[
				'label'     => esc_html__( 'Thumbnail Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_news_thumbnail' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'news_date_margin_bottom',
			[
				'label'     => esc_html__( 'Date Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_news_date' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'news_title_margin_bottom',
			[
				'label'     => esc_html__( 'Title Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_post_title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'news_excerpt_margin_bottom',
			[
				'label'     => esc_html__( 'Excerpt Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_post_excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'news_colors_section',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'author-background-overlay',
			[
				'label'     => esc_html__( 'Author Background Overlay', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_post_author' => '    background: linear-gradient(rgba(0, 0, 0, 0), {{VALUE}});',
				],
				'condition' => [
					'show_author' => 'yes',
				],
			]
		);

		$this->add_control(
			'author-by-color',
			[
				'label'     => esc_html__( 'Author By', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_by' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_author' => 'yes',
				],
			]
		);

		$this->add_control(
			'author-name-color',
			[
				'label'     => esc_html__( 'Author Name', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .author-link' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_author' => 'yes',
				],
			]
		);

		$this->add_control(
			'date-color',
			[
				'label'     => esc_html__( 'Date', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_date' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title-color',
			[
				'label'     => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_post_title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title-color-hover',
			[
				'label'     => esc_html__( 'Title Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_post_title a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'excerpt-color',
			[
				'label'     => esc_html__( 'Excerpt', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_post_excerpt' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'category-color',
			[
				'label'     => esc_html__( 'Category', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_post_tags a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'category-color-hover',
			[
				'label'     => esc_html__( 'Category Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_post_tags a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'slider-nav-color',
			[
				'label'     => esc_html__( 'Gallery Format Slider Nav Buttons', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-prev:not(.disabled)'                 => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-next:not(.disabled)'                 => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button.active'       => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button:hover'        => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button.active:after' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'slider-nav-color-hover',
			[
				'label'     => esc_html__( 'Gallery Format Slider Nav Buttons Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-prev:not(.disabled):hover' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-next:not(.disabled):hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'read-more-color',
			[
				'label'     => esc_html__( 'Read More', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-news-read-more span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-news-read-more i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-news-read-more .rhea-read-more:after' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'read-more-color-hover',
			[
				'label'     => esc_html__( 'Read More Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-news-read-more a:hover span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-news-read-more a:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-news-read-more .rhea-read-more:after' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		global $news_grid_size;
		$news_grid_size = $settings['ere_news_grid_thumb_sizes'];

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} else if ( get_query_var( 'page' ) ) { // if is static front page
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		if ( $settings['offset'] ) {
			$offset = $settings['offset'] + ( $paged - 1 ) * $settings['posts_per_page'];
		} else {
			$offset = '';
		}

		$news_args = array(
			'post_type'           => 'post',
			'posts_per_page'      => $settings['posts_per_page'],
			'ignore_sticky_posts' => 1,
			'order'               => $settings['order'],
			'orderby'             => $settings['orderby'],
			'offset'              => $offset,
			'paged'               => $paged,
			'meta_query'          => array(
				'relation' => 'OR',
				array(
					'key'     => '_thumbnail_id',
					'compare' => 'EXISTS'
				),
				array(
					'key'     => 'REAL_HOMES_embed_code',
					'compare' => 'EXISTS'
				),
				array(
					'key'     => 'REAL_HOMES_gallery',
					'compare' => 'EXISTS'
				)
			)
		);

		$news_args['tax_query'] = array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array( 'post-format-quote', 'post-format-link', 'post-format-audio' ),
				'operator' => 'NOT IN'
			)
		);

		// Filter based on taxonomies
		$post_taxonomies = get_object_taxonomies( 'post', 'objects' );
		if ( ! empty( $post_taxonomies ) && ! is_wp_error( $post_taxonomies ) ) {
			foreach ( $post_taxonomies as $single_tax ) {
				$setting_key = $single_tax->name;
				if ( ! empty( $settings[ $setting_key ] ) ) {
					$news_args['tax_query'][] = [
						'taxonomy' => $setting_key,
						'field'    => 'slug',
						'terms'    => $settings[ $setting_key ],
					];
				}
			}
			if ( isset( $news_args['tax_query'] ) && count( $news_args['tax_query'] ) > 1 ) {
				$news_args['tax_query']['relation'] = 'AND';
			}
		}

		$news_query = new WP_Query( apply_filters( 'rhea_modern_news_widget', $news_args ) );
		?>
        <div id="rh-<?php echo $this->get_id(); ?>" class="rhea_ele_property_ajax_target">
            <div class="home-properties-section-inner-target">

				<?php
				if ( $news_query->have_posts() ) {
					?>
                    <section class="rhea_ultra_news_section owl-carousel" id="rhea-carousel-<?php echo $this->get_id(); ?>">
						<?php
						while ( $news_query->have_posts() ) {
							$news_query->the_post();

							$format = get_post_format( get_the_ID() );

							if ( false === $format ) {
								$format = 'standard';
							} ?>
                            <article>
                                <div class="rhea_ultra_news_thumbnail">
									<?php
									rhea_get_template_part( "assets/partials/post-formats/ultra/$format" );
									if ( 'yes' == $settings['show_author'] ) {
										?>
                                        <div class="rhea_ultra_post_author">

                                            <div class="rhea_author_avatar">
												<?php
												echo get_avatar( get_the_author_meta( 'email' ) ); ?>
                                            </div>
                                            <span class="by-author">
											<span class="rhea_by">
												<?php
												if ( ! empty( $settings['by-label'] ) ) {
													echo esc_html( $settings['by-label'] );
												} else {
													esc_html_e( 'By', 'realhomes-elementor-addon' );
												}
												?>
											</span>
											<span class="author-link"><?php the_author() ?></span>
											</span>

                                        </div>
										<?php
									}
									?>
                                </div>
                                <div class="rhea_ultra_post_detail">
									<?php if ( 'yes' == $settings['show_date'] ) { ?>
                                        <p class="rhea_ultra_news_date">
                                            <time class="rhea_ultra_date" datetime="<?php the_modified_time( 'c' ); ?>"> <?php the_time( get_option( 'date_format' ) ); ?></time>
                                        </p>
										<?php
									} ?>

                                    <h3 class="rhea_ultra_post_title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>

									<?php
									if ( 'yes' == $settings['show_excerpt'] ) {
										?>
                                        <p class="rhea_ultra_post_excerpt"><?php rhea_framework_excerpt( $settings['excerpt-length'] ); ?></p>
										<?php
									}

									if ( 'yes' == $settings['show_category'] ) {
										$get_categories = get_the_category();
										if ( is_array( $get_categories ) && ! empty( $get_categories ) ) {
											?>
                                            <p class="rhea_ultra_post_tags">
												<?php
												foreach ( $get_categories as $category ) {
													?>
                                                    <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo esc_attr( $category->name ); ?></a>
													<?php
												} ?>
                                            </p>
											<?php
										}
									}

	                                if ( ! empty( $settings['read-more-text'] ) ) {
		                                $button_icon = $settings['button_icon'];
		                                ?>
                                        <div class="rhea-news-read-more">

                                            <a  href="<?php the_permalink();?>">
                                                <span class="rhea-read-more"><?php echo esc_html( $settings['read-more-text'] ) ?></span>
			                                <?php
			                                if ( is_array( $button_icon ) && ! empty( $button_icon ) ) {
				                                if ( is_array( $button_icon['value'] ) && ! empty( $button_icon['value']['url'] ) ) {
					                                ?><span class="svg-icon">
					                                <?php
					                                \Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] );
					                                ?>
                                                    </span><?php
				                                } else {
					                                ?>
                                                <i class="<?php echo esc_attr( $button_icon['library'] . ' ' . $button_icon['value'] ) ?>"></i><?php
				                                }
			                                }
			                                ?>
                                            </a>
                                        </div>
		                                <?php
	                                }
	                                ?>
                                </div>
                            </article>
							<?php
						} ?>
                    </section>
					<?php
				}
				wp_reset_postdata();
				?>
                <div id="rhea-nav-<?php echo $this->get_id(); ?>" class="rhea-ultra-carousel-nav-center rhea-ultra-nav-box rhea-ultra-owl-nav owl-nav">
                    <div id="rhea-dots-<?php echo $this->get_id(); ?>" class="rhea-ultra-owl-dots owl-dots"></div>
                </div>
            </div>
        </div>
        <script type="application/javascript">

			<?php
			if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
			?>
            EREloadNewsSlider();
			<?php
			}
			?>
            jQuery( document ).ready( function () {

                jQuery( "#rhea-carousel-<?php echo $this->get_id(); ?>" ).owlCarousel( {
                    items         : 3,
                    nav           : true,
                    dots          : true,
                    dotsEach      : true,
                    smartSpeed    : 500,
                    rtl           : rheaIsRTL(),
                    loop          : false,
                    navText       : ['<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>'],
                    navContainer  : '#rhea-nav-<?php echo $this->get_id(); ?>',
                    dotsContainer : '#rhea-dots-<?php echo $this->get_id(); ?>',
                    responsive    : {
                        // breakpoint from 0 up
                        0    : {
                            items : 1
                        },
                        // breakpoint from 650 up
                        650  : {
                            items  : 2,
                            margin : 20
                        },
                        // breakpoint from 1140 up
                        1140 : {
                            items  : 3,
                            margin : 30
                        },
                        1400 : {
                            margin : 40
                        }
                    }
                } );

                EREloadNewsSlider();
            } );
        </script>
		<?php

	}
}
