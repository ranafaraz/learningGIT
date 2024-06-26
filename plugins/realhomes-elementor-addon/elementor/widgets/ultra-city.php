<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_City extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-city';
	}

	public function get_title() {
		return esc_html__( 'Ultra City', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-image-hotspot';
	}

	public function get_categories() {
		return [ 'ultra-real-homes' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rhea_city',
			[
				'label' => esc_html__( 'City', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$rhea_city_terms = get_terms( array(
			'taxonomy' => 'property-city',
		) );
		$get_city_terms  = array();
		foreach ( $rhea_city_terms as $rhea_term ) {
			$get_city_terms[ $rhea_term->slug ] = $rhea_term->name;
		}

		$this->add_control(
			'rhea_property_location_select',
			[
				'label'   => esc_html__( 'Select Locations', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT2,
				'default' => '',
				'options' => $get_city_terms,
			]
		);

		$this->add_control(
			'rhea_city_label',
			[
				'label'       => esc_html__( 'City Name', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Default city name will appear if field is empty.', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => esc_html__( 'Choose Image', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'rhea_properties_view_all',
			[
				'label'   => esc_html__( 'View Button Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'View All', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'rhea_properties_label',
			[
				'label'   => esc_html__( 'Properties Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Properties', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_responsive_control(
			'rhea_min_height',
			[
				'label'           => esc_html__( 'Minimum Height', 'realhomes-elementor-addon' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'desktop_default' => [
					'size' => '430',
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} .rhea_ultra_City' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ere_property_typo_section',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_city_name_typography',
				'label'    => esc_html__( 'City Name', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea_ultra_city_name',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_counter_typography',
				'label'    => esc_html__( 'Number Of Properties', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea_ultra_city_properties',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_properties_label_typography',
				'label'    => esc_html__( 'Properties Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea_ultra_city_properties_label',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'property_view_all_typography',
				'label'    => esc_html__( 'View All Button', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea_ultra_city_thumb span',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ere_property_basic_styles',
			[
				'label' => esc_html__( 'Basic Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			],
		);


		$this->add_responsive_control(
			'thumb_border_radius',
			[
				'label'      => esc_html__( 'Image Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea_ultra_City' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'view_all_button_padding',
			[
				'label'      => esc_html__( 'View All Button Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea_ultra_city_thumb span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'view_all_border_radius',
			[
				'label'      => esc_html__( 'View All Button Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea_ultra_city_thumb span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'property_counter_tag_padding',
			[
				'label'      => esc_html__( 'Properties Counter Tag Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea_ultra_city_tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'property_counter_tag_border_radius',
			[
				'label'      => esc_html__( 'Properties Counter Tag Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea_ultra_city_tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'city_name_tag_padding',
			[
				'label'      => esc_html__( 'City Name Tag Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea_ultra_city_name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'city_name_tag_border_radius',
			[
				'label'      => esc_html__( 'City Name Tag Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea_ultra_city_name' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'properties_label_margin_top',
			[
				'label'           => esc_html__( 'Properties Label Margin Top', 'realhomes-elementor-addon' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'desktop_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} .rhea_ultra_city_properties_label' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'rhea_city_colors',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rhea_city_view_all_text',
			[
				'label'     => esc_html__( 'View All Button Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_city_thumb span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_city_view_all_bg',
			[
				'label'     => esc_html__( 'View All Button Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_city_thumb span' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_city_name_text_color',
			[
				'label'     => esc_html__( 'City Name', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_city_name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_city_name_bg_color',
			[
				'label'     => esc_html__( 'City Name Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_city_name' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_city_tag_bg_color',
			[
				'label'     => esc_html__( 'Property Counter Tag Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_city_tag' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_counter_color',
			[
				'label'     => esc_html__( 'Number Of Properties Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_city_properties' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_label_color',
			[
				'label'     => esc_html__( 'Properties Label Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_city_properties_label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_city_overlay_color',
			[
				'label'     => esc_html__( 'Overlay Color On Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_City .rhea_ultra_city_thumb:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ere_city_box_shadow',
			[
				'label' => esc_html__( 'Box Shadow', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'tag_box_shadow',
				'label'    => esc_html__( 'Number Tag Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rhea_ultra_City .rhea_ultra_city_tag',
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		$term_link = '';
		$city      = $settings['rhea_property_location_select'];
		$term      = get_term_by( 'slug', esc_html( $city ), 'property-city' );

		if ( $term ) {
			$term_link = get_term_link( $term->term_id, 'property-city' );
		}

		$image_id = $settings['image']['id'];
		$image_src = wp_get_attachment_image_src( $image_id, 'partners-logo' );
		$image_url = ! empty( $image_src[0] ) ? $image_src[0] : '';
		?>

        <section class="rhea_ultra_City rhea_ultra_City-<?php echo $this->get_id(); ?>" style="background-image: url('<?php echo esc_url( $image_url ); ?>');">
            <a href="<?php echo esc_url( $term_link ) ?>" class="rhea_ultra_city_thumb">
                <span>
                    <?php
                    if ( ! empty( $settings['rhea_properties_view_all'] ) ) {
	                    echo esc_html( $settings['rhea_properties_view_all'] );
                    } else {
	                    esc_html_e( 'View All', 'realhomes-elementor-addon' );
                    }
                    ?>
                    <i class="fas fa-caret-right"></i>
                </span>
            </a>

            <div class="rhea_ultra_city_tag_wrapper">
                <div class="rhea_ultra_city_tag">
                    <span class="rhea_ultra_city_name">
                        <?php
                        if ( ! empty( $settings['rhea_city_label'] ) ) {
	                        echo esc_html( $settings['rhea_city_label'] );
                        } else if ( $term ) {
	                        echo esc_html( $term->name );
                        }
                        ?>
                    </span>
					<?php
					if ( $term ) {
						?>
                        <span class="rhea_ultra_city_properties">
                        <?php
                        echo esc_html( $term->count );
                        ?>
                    </span>
						<?php
					}
					if ( ! empty( $settings['rhea_properties_label'] ) ) {
						?>
                        <span class="rhea_ultra_city_properties_label"><?php echo esc_html( $settings['rhea_properties_label'] ); ?></span>
						<?php
					}
					?>
                </div>
            </div>
        </section>
		<?php
	}
}
