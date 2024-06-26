<?php
/**
 * Property Attachments Elementor widget for single property
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Attachments extends \Elementor\Widget_Base
{
	public function get_name() {
		return 'rhea-ultra-single-property-attachments';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Attachments', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-document-file';
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
				'default' => esc_html__( 'Property Attachments', 'realhomes-elementor-addon' ),
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
			'attachments_colors_section',
			[
				'label' => esc_html__( 'Basic Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'attachment-padding',
			[
				'label'      => esc_html__( 'Attachments Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__attachments li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'meta-icons-border',
				'label'    => esc_html__( 'Meta Icon Border', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rh_property__attachments li a',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'meta-icons-border-hover',
				'label'    => esc_html__( 'Meta Icon Border Hover', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rh_property__attachments li a:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'attachment-border-radius',
			[
				'label'      => esc_html__( 'Attachment Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__attachments li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'attachment-width',
			[
				'label'      => esc_html__( 'Attachment Width', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__attachments li' => 'width: {{SIZE}}{{UNIT}};',

				],
			]
		);
		$this->add_responsive_control(
			'attachment-column-gap',
			[
				'label'      => esc_html__( 'Attachment Column Gap', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__attachments' => 'column-gap: {{SIZE}}{{UNIT}};',

				],
			]
		);
		$this->add_responsive_control(
			'attachment-row-gap',
			[
				'label'     => esc_html__( 'Attachment Row Gap', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_property__attachments' => 'row-gap: {{SIZE}}{{UNIT}};',

				],
			]
		);
		$this->add_responsive_control(
			'attachment-wrapper-margin-bottom',
			[
				'label'     => esc_html__( 'Wrapper Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_property__attachments_wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',

				],
			]
		);
		$this->add_control(
			'attachment-bg',
			[
				'label'     => esc_html__( 'Attachment Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__attachments li a' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'attachment-bg-hover',
			[
				'label'     => esc_html__( 'Attachment Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__attachments li a:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'attachment-icon',
			[
				'label'     => esc_html__( 'Attachment Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__attachments li i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'attachment-icon-hover',
			[
				'label'     => esc_html__( 'Attachment Icon Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__attachments li a:hover i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'attachment-text',
			[
				'label'     => esc_html__( 'Attachment Name', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-attachment-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'attachment-size',
			[
				'label'     => esc_html__( 'Attachment Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-attachment-text span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'attachment-text-hover',
			[
				'label'     => esc_html__( 'Attachment Name Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__attachments a:hover .rh-attachment-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'attachment-size-hover',
			[
				'label'     => esc_html__( 'Attachment Size Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__attachments a:hover .rh-attachment-text span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'attachment-icon-bg',
			[
				'label'     => esc_html__( 'Attachment Download Icon Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__attachments li .rh-attachment-download-icon' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'attachment-icon-svg',
			[
				'label'     => esc_html__( 'Attachment Download Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__attachments li .rh-attachment-download-icon svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rh_property__attachments li a',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow_hover',
				'label'    => esc_html__( 'Box Shadow Hover', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rh_property__attachments li a:hover',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'list-typography',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'attachment_label_typography',
				'label'    => esc_html__( 'Attachment Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-attachment-text',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'attachment_size_typography',
				'label'    => esc_html__( 'Attachment Size', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-attachment-text span',
			]
		);
		$this->add_responsive_control(
			'attachment-icon-size',
			[
				'label'     => esc_html__( 'Attachment Icon Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_property__attachments li i' => 'font-size: {{SIZE}}{{UNIT}};',

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

		$attachments = inspiry_get_property_attachments( $post_id );
		if ( ! empty( $attachments ) ) {
			?>
            <div class="rh_property__attachments_wrap margin-bottom-40px">
                <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4>
				<?php
				echo '<ul class="rh_property__attachments">';
				foreach ( $attachments as $attachment_id ) {
					$file_path = wp_get_attachment_url( $attachment_id );
					if ( $file_path ) {
						$file_type = wp_check_filetype( $file_path );
						?>
                        <li class="<?php echo esc_attr( $file_type['ext'] ) ?>">
                            <a target="_blank" href="<?php echo esc_attr( $file_path ) ?>">
								<?php echo get_icon_for_extension( $file_type['ext'] ) ?>
                                <span class="rh-attachment-text">
                                <?php echo get_the_title( $attachment_id ) ?><br>
                                <span>
                                     <?php echo inspiry_filesize_formatted( get_attached_file( $attachment_id ) ) ?>
                                </span>
                            </span>
                                <span class="rh-attachment-download-icon">
                                <?php
                                inspiry_safe_include_svg( 'download.svg', '/assets/ultra/icons/' );
                                ?>
                            </span>
                            </a>
                        </li>
						<?php

					}
				}
				echo '</ul>';
				?>
            </div>
			<?php
		} else {
			rhea_print_no_result_for_editor();
		}

	}
}