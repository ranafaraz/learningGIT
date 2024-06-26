<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Widget for Site Logo .
 *
 * @since 0.9.7
 */
class RHEA_Site_logo extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rhea-site-logo';
	}

	public function get_title() {
		return esc_html__( 'RealHomes: Site Logo', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-site-logo';
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'site-logo-basics-section',
			[
				'label' => esc_html__( 'Basic', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'site-image',
			[
				'label'       => esc_html__( 'Site Logo', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'Default Site Logo (Customizer -> Site Identity) will be displayed if no logo is selected', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,

			]
		);
		$this->add_control(
			'retina-site-image',
			[
				'label'       => esc_html__( 'Retina Site Logo', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'Default Retina Site Logo (Customizer -> Site Identity) will be displayed if no logo is selected', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,

			]
		);

		$this->add_control(
			'site_title',
			[
				'label' => esc_html__( 'Site Title', 'realhomes-elementor-addon' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'site-logo-settings-section',
			[
				'label' => esc_html__( 'Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'logo-max-width',
			[
				'label'      => esc_html__( 'Logo Max Width', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-site-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'site-title-color',
			[
				'label'     => esc_html__( 'Site Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-logo-heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'site-title-color-hover',
			[
				'label'     => esc_html__( 'Site Title Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-logo-heading:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'site-title-typography',
				'label'    => esc_html__( 'Site Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-logo-heading',
			]
		);

		$this->add_responsive_control(
			'ere_section_align',
			[
				'label'     => esc_html__( 'Alignment', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-site-logo-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['site-image']['url'] ) ) {
			$logo_path = $settings['site-image']['url'];
		} else {
			$logo_path = get_option( 'theme_sitelogo' );
		}

		if ( ! empty( $settings['retina-site-image']['url'] ) ) {
			$retina_logo_path = $settings['retina-site-image']['url'];
		} else {
			$retina_logo_path = get_option( 'theme_sitelogo_retina' );
		}

		if ( ! empty( $settings['site_title'] ) ) {
			$site_title = $settings['site_title'];
		} else {
			$site_title = get_bloginfo( 'name' );
		}
		?>
        <div class="rhea-site-logo-wrapper">
			<?php
			if ( function_exists( 'inspiry_logo_img' ) && ! empty( $logo_path ) ) {
				?>
                <a class="rhea-site-logo" title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url() ); ?>">
					<?php inspiry_logo_img( $logo_path, $retina_logo_path ); ?>
                </a>
				<?php
			} else {
				?>
                <a class="rhea-logo-heading" href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo( 'name' ); ?>">
					<?php echo esc_html( $site_title ); ?>
                </a>
				<?php
			}
			?>
        </div>
		<?php

	}
}