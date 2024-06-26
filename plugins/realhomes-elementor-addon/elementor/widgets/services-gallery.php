<?php
/**
 * Services Widget
 *
 * @since 2.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Services extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-services';
	}

	public function get_title() {
		return esc_html__( 'RealHomes: Services Gallery', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'ultra-real-homes' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'rhea_services_section',
			[
				'label' => esc_html__( 'Services', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'service_title',
			[
				'label'       => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Service Title', 'realhomes-elementor-addon' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'service_post_label',
			[
				'label'       => esc_html__( 'Label', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Service Label', 'realhomes-elementor-addon' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'service_button_icon',
			[
				'label'   => esc_html__( 'Icon', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);

		$repeater->add_control(
			'gallery',
			[
				'label'       => esc_html__( 'Gallery Images', 'realhomes-elementor-addon' ),
				'description' => esc_html__( '4 Images are recommended', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::GALLERY,
				'default'     => [],
				'show_label'  => false,
			]
		);

		$repeater->add_control(
			'gallery_style',
			[
				'label'      => esc_html__( 'Gallery Grid Layout', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SELECT,
				'options'    => [
					'1' => esc_html__( 'Layout One', 'realhomes-elementor-addon' ),
					'2' => esc_html__( 'Layout Two ', 'realhomes-elementor-addon' ),
					'3' => esc_html__( 'Layout Three ', 'realhomes-elementor-addon' ),
					'4' => esc_html__( 'Layout Four ', 'realhomes-elementor-addon' ),
				],
				'default'    => '1',
				'show_label' => false,
			]
		);

		$this->add_control(
			'rhea_add_field_select',
			[
				'label'       => esc_html__( 'Add Service', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => ' {{{ service_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'services_typography_section',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Service Title', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-service-carousel-tabs .slick-current .rhea-service h4',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'label'    => esc_html__( 'Service Label', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea-service-carousel-tabs .slick-current .rhea-service .service-label',
			]
		);

		$this->add_responsive_control(
			'rhea_fa_icon_size',
			[
				'label'     => esc_html__( 'FontAwesome Icon Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-service i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rhea_svg_icon_size',
			[
				'label'     => esc_html__( 'SVG Icon Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-service svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ere_service_basic_styles',
			[
				'label' => esc_html__( 'Basic Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'pagination_padding',
			[
				'label'      => esc_html__( 'Service Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .rhea-service' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'service_background',
			[
				'label'     => esc_html__( 'Service Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .rhea-services' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'service_background_hover',
			[
				'label'     => esc_html__( 'Service Background Hover/Active', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .slick-current .rhea-service' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-service-carousel-tabs .rhea-service:hover'          => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'service_border_color',
			[
				'label'     => esc_html__( 'Service Border Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .rhea-services' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'service_border_color_hover',
			[
				'label'     => esc_html__( 'Service Hover/Active Border Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .slick-current .rhea-service' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-service-carousel-tabs .rhea-services:hover'         => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'service_title_color',
			[
				'label'     => esc_html__( 'Service Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .rhea-service h4' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'service_label_color',
			[
				'label'     => esc_html__( 'Service Label Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .rhea-service span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'service_title_color_hover',
			[
				'label'     => esc_html__( 'Service Hover/Active Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .slick-current .rhea-service h4' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'service_label_color_hover',
			[
				'label'     => esc_html__( 'Service Hover/Active Label Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .slick-current .rhea-service span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'service_icon_fa_color',
			[
				'label'     => esc_html__( 'Service Icon Fontawesome Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .rhea-service i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'service_icon_fa_hover_color',
			[
				'label'     => esc_html__( 'Service Icon Fontawesome Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .rhea-service:hover i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'service_icon_stroke_color',
			[
				'label'     => esc_html__( 'Service Icon Stroke Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .rhea-service .rhea-stroke path' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'service_icon_stroke_color_hover',
			[
				'label'     => esc_html__( 'Service Icon Stroke Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .rhea-service:hover .rhea-stroke path'          => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .rhea-service-carousel-tabs .slick-current .rhea-service .rhea-stroke path' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'service_icon_fill_color',
			[
				'label'     => esc_html__( 'Service Icon Fill Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .rhea-service .rhea-fill path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'service_icon_fill_color_hover',
			[
				'label'     => esc_html__( 'Service Icon Fill Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-service-carousel-tabs .rhea-service:hover .rhea-fill path'          => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rhea-service-carousel-tabs .slick-current .rhea-service .rhea-fill path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'images_container_size',
			[
				'label'      => esc_html__( 'Images Container Height', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-service-carousel-images .services-images' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'slider_nav_styles',
			[
				'label' => esc_html__( 'Slider Navigations', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'nav-position',
			[
				'label'     => esc_html__( 'Horizontal Position', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'flex-start' => esc_html__( 'Left', 'realhomes-elementor-addon' ),
					'center'     => esc_html__( 'Center', 'realhomes-elementor-addon' ),
					'flex-end'   => esc_html__( 'Right', 'realhomes-elementor-addon' ),
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-services-nav-wrapper' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_margin',
			[
				'label'      => esc_html__( 'Slider Nav Control Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-services-nav-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_column_gap',
			[
				'label'     => esc_html__( 'Slider Nav Controls Gap', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-services-nav-wrapper' => 'column-gap: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_border_radius',
			[
				'label'     => esc_html__( 'Slider Nav Border Radius', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-services-nav-wrapper button' => 'border-radius: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_button_width',
			[
				'label'     => esc_html__( 'Slider Nav Width', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-services-nav-wrapper button' => 'width: {{SIZE}}{{UNIT}};',

				],
			]
		);
		$this->add_responsive_control(
			'slider_nav_button_height',
			[
				'label'     => esc_html__( 'Slider Nav Height', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-services-nav-wrapper button' => 'height: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_nav_color',
			[
				'label'     => esc_html__( 'Directional Nav Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-services-nav-wrapper button' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_nav_hover_color',
			[
				'label'     => esc_html__( 'Directional Nav Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-services-nav-wrapper button:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_nav_border_color',
			[
				'label'     => esc_html__( 'Directional Nav Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-services-nav-wrapper button' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_nav_border_hover_color',
			[
				'label'     => esc_html__( 'Directional Nav Border Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-services-nav-wrapper button:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_nav_icon',
			[
				'label'     => esc_html__( 'Directional Nav Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-services-nav-wrapper button path' => 'fill: {{VALUE}};stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_slider_directional_nav_hover_icon',
			[
				'label'     => esc_html__( 'Directional Nav Icon Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-services-nav-wrapper button:hover path' => 'fill: {{VALUE}};stroke: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();


		$services = $settings['rhea_add_field_select'];
		if ( $services ) {
			?>
            <div class="rhea-services-wrapper" id="<?php echo esc_attr( $this->get_id() ); ?>">
                <div class="rhea-services-nav-wrapper">
                    <button class="rhea-prev-service">
						<?php rhea_safe_include_svg( 'icons/thin-arrow-left.svg' ); ?>
                    </button>
                    <button class="rhea-next-service">
						<?php rhea_safe_include_svg( 'icons/thin-arrow-right.svg' ); ?>
                    </button>
                </div>

                <div class="rhea-service-carousel-tabs">
					<?php
					foreach ( $services as $service ) {
						$title       = $service['service_title'];
						$label       = $service['service_post_label'];
						$button_icon = $service['service_button_icon'];
						?>
                        <div class="rhea-service-box service-box-<?php echo esc_attr( $service['_id'] ) ?>">
                            <div class="rhea-service">
								<?php
								if ( is_array( $button_icon ) && ! empty( $button_icon ) ) {
									if ( is_array( $button_icon['value'] ) && ! empty( $button_icon['value']['url'] ) ) {
										?><span class="icon">
										<?php
										\Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] );

										?>
                                        </span><?php
									} else if ( ! empty( $button_icon['library'] && ! empty( $button_icon['value'] ) ) ) {
										?>
                                    <i class="<?php echo esc_attr( $button_icon['library'] . ' ' . $button_icon['value'] ) ?>"></i><?php
									}
								}
								?>
                                <div class="labels">
									<?php
									if ( ! empty( $title ) ) {
										?>
                                        <h4><?php echo esc_html( $title ) ?></h4>
										<?php
									}
									if ( ! empty( $label ) ) {
										?>
                                        <span class="service-label"><?php echo esc_html( $label ) ?></span>
										<?php
									}
									?>

                                </div>
                            </div>
                        </div>
						<?php
					}
					?>

                </div>

                <div class="rhea-service-carousel-images">

					<?php
					$counter = 1;
					foreach ( $services as $service ) {
						$gallery = $service['gallery'];
						if ( $gallery ) {
							?>
                            <div class="services-images-wrapper">
                                <div class="services-images style-<?php echo esc_attr( $service['gallery_style'] ) ?>">
									<?php

									foreach ( $gallery as $image ) {
										$attachment_id = $image['id'];
										$attachment_id = rhea_get_wpml_translated_image_id( $attachment_id );
										?>
                                        <a class="service-image child-1" data-fancybox="gallery-<?php echo esc_attr( $counter ) ?>" href="<?php echo esc_url( $image['url'] ); ?>">
											<?php
											echo wp_get_attachment_image( $attachment_id, 'full', "", array( "class" => "rhea-service-image" ) );
											?>
                                        </a>
										<?php
									}
									?>
                                </div>
                            </div>
							<?php
							$counter++;
						}
					}
					?>
                </div>

            </div>
            <script type="application/javascript">
                ( function ( $ ) {
                    'use strict';
                    $( document ).ready( function () {

                        rheaServicesSlider( '#<?php echo esc_attr( $this->get_id() );?>' );

                    } );
                } )( jQuery );
            </script>
			<?php

		}
	}
}
