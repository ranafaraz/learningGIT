<?php
/**
 * Property Video Elementor widget for single property
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Property_Video extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-property-video';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Video', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-slider-video';
	}

	public function get_categories() {
		return [ 'ultra-realhomes-single-property' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'section_title',
			[
				'label'   => esc_html__( 'Section Title', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Property Videos', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'section_title_color',
			[
				'label'     => esc_html__( 'Section Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'section_title_typography',
				'label'    => esc_html__( 'Section Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__heading',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'features_colors_section',
			[
				'label' => esc_html__( 'Basic Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'wrapper-border-radius',
			[
				'label'      => esc_html__( 'Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_property_video_inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'section-margin-bottom',
			[
				'label'     => esc_html__( 'Section Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_property__video' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'floor-typography',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'slide_label_typography',
				'label'    => esc_html__( 'Video Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property_video_inner .rh_video_title',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'slide-colors',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'slide-label-color',
			[
				'label'     => esc_html__( 'Video Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property_video_inner .rh_video_title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'slide-button-color',
			[
				'label'     => esc_html__( 'Video button Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property_video_inner .play-btn' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'slide-button-color-hover',
			[
				'label'     => esc_html__( 'Video button Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property_video_inner:hover .play-btn' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$post_id  = get_the_ID();

		// Sample Post id for Elementor editor only
		if ( rhea_is_preview_mode() ) {
			$post_id = rhea_get_sample_property_id();
		}

		$display_video = get_option( 'theme_display_video', 'true' );

		if ( 'true' === $display_video ) {

			$tour_video_url = get_post_meta( $post_id, 'REAL_HOMES_tour_video_url', true );

			if ( ! empty( $tour_video_url ) ) {
				?>
                <div class="rh_property__video margin-bottom-40px">
                    <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4>
                    <a href="<?php echo esc_url( $tour_video_url ); ?>" data-fancybox class="inspiry-lightbox-item" data-autoplay="true" data-vbtype="video">
                        <div class="play-btn"></div>
						<?php
						$tour_video_image_url = '';
						$tour_video_image_id  = get_post_meta( $post_id, 'REAL_HOMES_tour_video_image', true );
						if ( ! empty( $tour_video_image_id ) ) {
							$tour_video_image_src = wp_get_attachment_image_src( $tour_video_image_id, 'property-detail-video-image' );
							if ( isset( $individual_video_image_src[0] ) and ! empty( $individual_video_image_src[0] ) ) {
								$tour_video_image_url = $tour_video_image_src[0];
							}
						}

						if ( ! empty( $tour_video_image_url ) ) {
							echo '<img src="' . esc_url( $tour_video_image_url ) . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '">';
						} else if ( ! empty( get_the_post_thumbnail( $post_id ) ) ) {
							the_post_thumbnail( 'property-detail-video-image' );
						} else {
							inspiry_image_placeholder( 'property-detail-video-image' );
						}
						?>
                    </a>
                </div>
				<?php
			} else {

				$inspiry_video_group = get_post_meta( $post_id, 'inspiry_video_group', true );

				if ( ! empty( $inspiry_video_group ) ) {
					?>
                    <div class="rh_property__video margin-bottom-40px">
						<?php
						if ( ! empty( $settings['section_title'] ) ) {
							?>
                            <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4><?php
						}
						?>
                        <div class="rh_wrapper_property_videos_slider">
							<?php
							foreach ( $inspiry_video_group as $individual_video ) {

								if ( isset( $individual_video['inspiry_video_group_url'] ) && ! empty( $individual_video['inspiry_video_group_url'] ) ) {

									$individual_video_url = $individual_video['inspiry_video_group_url'];
									?>
                                    <div class="rh_property_video">
                                        <div class="rh_property_video_inner">
											<?php
											if ( isset( $individual_video['inspiry_video_group_title'] ) && ! empty( $individual_video['inspiry_video_group_title'] ) ) {
												?>
                                                <h5 class="rh_video_title"><?php echo esc_html( $individual_video['inspiry_video_group_title'] ); ?></h5><?php
											}
											?>
                                            <a data-fancybox href="<?php echo esc_url( $individual_video_url ); ?>" class="inspiry-lightbox-item" data-autoplay="true" data-vbtype="video">
                                                <div class="play-btn"><i class="fas fa-play"></i></div>
												<?php
												$individual_video_image_url = '';
												if ( isset( $individual_video['inspiry_video_group_image'] ) ) {
													$individual_video_image_id = $individual_video['inspiry_video_group_image'][0];
													if ( ! empty( $individual_video_image_id ) ) {
														$individual_video_image_src = wp_get_attachment_image_src( $individual_video_image_id, 'property-detail-video-image' );
														if ( isset( $individual_video_image_src[0] ) and ! empty( $individual_video_image_src[0] ) ) {
															$individual_video_image_url = $individual_video_image_src[0];
														}
													}
												}

												if ( ! empty( $individual_video_image_url ) ) {
													echo '<img src="' . esc_url( $individual_video_image_url ) . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '">';
												} else if ( ! empty( get_the_post_thumbnail( $post_id ) ) ) {
													the_post_thumbnail( 'property-detail-video-image' );
												} else {
													inspiry_image_placeholder( 'property-detail-video-image' );
												}
												?>
                                            </a>
                                        </div>
                                    </div>
									<?php
								}
							}
							?>
                        </div>
                    </div>
					<?php
				} else {
					rhea_print_no_result_for_editor();
				}
			}
		}

	}
}