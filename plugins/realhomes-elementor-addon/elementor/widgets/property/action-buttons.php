<?php
/**
 * Action buttons widget for single property template
 *
 * @since 2.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Property_Action_Buttons extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-property-action-buttons';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Action Buttons', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-call-to-action';
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
			'show_favourite_button',
			[
				'label'        => esc_html__( 'Show Favourite Button', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'ere_enable_compare_properties',
			[
				'label'        => esc_html__( 'Show Compare Button', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'show_print_button',
			[
				'label'        => esc_html__( 'Show Print Button', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'show_share_button',
			[
				'label'        => esc_html__( 'Show Share Button', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'show_report_button',
			[
				'label'        => esc_html__( 'Show Report Button', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'labels_section',
			[
				'label' => esc_html__( 'Labels', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'favourites_label_add',
			[
				'label'   => esc_html__( 'Add to Favourites Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Add to favourites', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'favourites_label_added',
			[
				'label'   => esc_html__( 'Added to Favourites Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Added to favourites', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'compare_label',
			[
				'label'   => esc_html__( 'Add to Compare Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Add to compare', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'compare_label_added',
			[
				'label'   => esc_html__( 'Added to Compare Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Added to compare', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'print_label',
			[
				'label'   => esc_html__( 'Print Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Print', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'share_label',
			[
				'label'   => esc_html__( 'Share Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Share', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'report_label',
			[
				'label'   => esc_html__( 'Report Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Report this Property', 'realhomes-elementor-addon' ),
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'basic_settings',
			[
				'label' => esc_html__( 'Size & Spacing', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'action_buttons_wrapper_padding',
			[
				'label'      => esc_html__( 'Buttons Wrapper Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'action_buttons_wrapper_border_radius',
			[
				'label'     => esc_html__( 'Wrapper Border Radius', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons' => 'border-radius: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'action_buttons_size',
			[
				'label'     => esc_html__( 'Buttons Size', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons a svg'    => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons span svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons a i'      => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'action_buttons_margin',
			[
				'label'      => esc_html__( 'Content Area Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons > *' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'colors_section',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'action_buttons_wrap_bg',
			[
				'label'     => esc_html__( 'Action Buttons Wrapper Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'action_buttons_color',
			[
				'label'     => esc_html__( 'Action Buttons Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons svg'                => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons svg .rh-ultra-dark' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons i'                  => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'action_buttons_color_secondary',
			[
				'label'     => esc_html__( 'Action Buttons Secondary Color (where applicable)', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons svg .rh-ultra-light' => 'fill: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'action_buttons_color_hover',
			[
				'label'     => esc_html__( 'Action Buttons Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons a:hover svg'                => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons a:hover svg .rh-ultra-dark' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons a:hover i'                  => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'action_buttons_color_secondary_hover',
			[
				'label'     => esc_html__( 'Action Buttons Secondary Color Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons a:hover svg .rh-ultra-light' => 'fill: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'action_buttons_favourite_added_color',
			[
				'label'     => esc_html__( 'Favourite Added Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-action-buttons-wrap .rh-ultra-action-buttons .favorite-placeholder svg .rh-ultra-light' => 'fill: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		global $settings;
		global $post_id;
		$settings = $this->get_settings_for_display();
		$post_id  = get_the_ID();

		// Sample Post id for Elementor editor only
		if ( rhea_is_preview_mode() ) {
			$post_id = rhea_get_sample_property_id();
		}
		?>
        <div class="rhea-action-buttons-wrap">
            <div class="rh-ultra-action-buttons">
				<?php
				// Favorite button for single property
				if ( ! empty( $settings['show_favourite_button'] ) && 'yes' === $settings['show_favourite_button'] && function_exists( 'inspiry_favorite_button' ) ) {
					$favourite_label       = ! empty( $settings['favourites_label_add'] ) ? $settings['favourites_label_add'] : '';
					$favourite_added_label = ! empty( $settings['favourites_label_added'] ) ? $settings['favourites_label_added'] : '';
					inspiry_favorite_button(
						$post_id,
						$favourite_label,
						$favourite_added_label,
						'/common/images/icons/ultra-favourite.svg',
						'ultra'
					);
				}

				// Compare button for single property
				if ( ! empty( $settings['ere_enable_compare_properties'] ) && 'yes' == $settings['ere_enable_compare_properties'] && function_exists( 'inspiry_add_to_compare_button' ) ) {
					$compare_label       = ! empty( $settings['compare_label'] ) ? $settings['compare_label'] : '';
					$compare_added_label = ! empty( $settings['compare_label_added'] ) ? $settings['compare_label_added'] : '';
					inspiry_add_to_compare_button( $compare_label, $compare_added_label, 'ultra' );
				}

				// Print button for single property
				if ( ! empty( $settings['show_print_button'] ) && 'yes' === $settings['show_print_button'] ) {
					$print_tooltip = ! empty( $settings['print_label'] ) ? $settings['print_label'] : esc_attr__( 'Print', 'realhomes-elementor-addon' );
					?>
                    <a href="javascript:window.print()" class="print rh-ui-tooltip" title="<?php echo esc_attr( $print_tooltip ); ?>"><?php rhea_safe_include_svg( '/icons/print-icon.svg' ); ?></a>
					<?php
				}

				// Share button for single property
				if ( ! empty( $settings['show_share_button'] ) && 'yes' === $settings['show_share_button'] ) {
					$share_tooltip = ! empty( $settings['share_label'] ) ? $settings['share_label'] : esc_attr__( 'Share', 'realhomes-elementor-addon' );
					?>
                    <div class="rh-ultra-share-wrapper">
                        <a href="#" class="rh-ultra-share share rh-ui-tooltip" title="<?php echo esc_attr( $share_tooltip ); ?>"><?php rhea_safe_include_svg( 'icons/share-icon.svg' ); ?></a>
                        <div class="share-this" data-check-mobile="<?php echo wp_is_mobile() ? esc_attr( 'mobile' ) : ''; ?>" data-property-name="<?php the_title(); ?>" data-property-permalink="<?php the_permalink(); ?>"></div>
                    </div>
					<?php
				}

				// Report button for single property
				if ( ! empty( $settings['show_report_button'] ) && 'yes' === $settings['show_report_button'] && function_exists( 'realhomes_report_property_modal' ) ) {

					$report_tooltip = ! empty( $settings['report_label'] ) ? $settings['report_label'] : esc_attr__( 'Report this property', 'realhomes-elementor-addon' );

					// Inserting report property modal html with the wp_footer action
					add_action( 'wp_footer', 'realhomes_report_property_modal' );
					?>
                    <a class="report-this-property rh-ui-tooltip" href="#report-property-modal-<?php echo esc_attr( $post_id ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>" title="<?php echo esc_html( $report_tooltip ); ?>"><i class="fas fa-flag"></i></a>
					<?php
				}
				?>
            </div>
        </div>
		<?php
	}

}