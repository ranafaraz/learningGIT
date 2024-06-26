<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Agents_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-agents-widget';
	}

	public function get_title() {
		return esc_html__( 'Ultra Agents', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'ultra-real-homes' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'rhea_add_agents_section',
			[
				'label' => esc_html__( 'Add Agents', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$agents_repeater = new \Elementor\Repeater();

		$all_post_ids = get_posts( array(
			'fields'         => 'ids',
			'posts_per_page' => - 1,
			'post_type'      => 'agent'
		) );

		$get_agents = array();
		foreach ( $all_post_ids as $rhea_id ) {
			$get_agents["$rhea_id"] = get_the_title( $rhea_id );
		}

		$agents_repeater->add_control(
			'rhea_select_agent',
			[
				'label'   => esc_html__( 'Select Agent', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $get_agents,
			]
		);

		$agents_repeater->add_control(
			'rhea_agent_title',
			[
				'label'       => esc_html__( 'Agent Title', 'realhomes-elementor-addon' ),
				'placeholder' => esc_html__( 'Agent Title', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'Agent Title will be displayed only as sorting control label " ', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]

		);

		$agents_repeater->add_control(
			'featured_images',
			[
				'label'       => esc_html__( 'Add Featured Images', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'Max 3 Images are recommended', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::GALLERY,
			]
		);


		$this->add_control(
			'rhea_agent',
			[
				'label'       => esc_html__( 'Add Agent', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $agents_repeater->get_controls(),
				'title_field' => ' {{{rhea_agent_title}}}',

			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'exclude'   => [ 'custom' ],
				'default'   => 'medium',
				'separator' => 'none',
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'rhea_settings_section',
			[
				'label' => esc_html__( 'Add Agents', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_agency',
			[
				'label'        => esc_html__( 'Show Agency', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);



		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$repeater_agents = $settings['rhea_agent'];
		if ( $repeater_agents ) {

			?>
			<div class="rhea-ultra-agents-wrapper" id="rhea-ultra-<?php echo $this->get_id(); ?>">
				<div class="flexslider">
					<ul class="slides">
						<?php
						foreach ( $repeater_agents as $agent ) {

							$agent_id = intval( $agent['rhea_select_agent'] );

							$listed_properties = 0;
							if ( function_exists( 'ere_get_agent_properties_count' ) ) {
								$listed_properties = ere_get_agent_properties_count( $agent_id );
							}
							?>

							<li>
								<div class="rhea-ultra-agent-slide">
									<div class="rhea-ultra-agent-thumb-detail">
										<div class="rhea-agent-thumb">
											<?php
											if ( has_post_thumbnail( $agent_id ) ) {
												?>
												<a href="<?php echo esc_url( get_the_permalink( $agent_id ) ); ?>">
													<?php
													echo get_the_post_thumbnail( $agent_id, 'agent-image' );
													?>
												</a>
												<?php
											}
											?>
										</div>
										<div class="rhea-agent-detail">
											<h3>
												<a href="<?php echo esc_url( get_the_permalink( $agent_id ) ); ?>"><?php echo get_the_title( $agent_id ); ?></a>
											</h3>
											<?php
											if ( 'yes' === $settings['show_agency'] ) {
												$related_agency = get_post_meta( $agent_id, 'REAL_HOMES_agency', true );
												if ( ! empty( $related_agency ) ) {
													?>
													<a class="rhea-ultra-agent-title"
													   href="<?php echo esc_url( get_the_permalink( $related_agency ) ); ?>">
														<?php echo get_the_title( $related_agency ); ?>
													</a>
													<?php
												}
											}
											//											$agent_email = get_post_meta( $agent_id, 'REAL_HOMES_agent_email', true );
											//											if ( ! empty( $agent_email ) ) { ?>
											<!--                                                <a class="rhea-ultra-agent-email"-->
											<!--                                                   href="mailto:--><?php //echo esc_attr( antispambot( $agent_email ) ); ?><!--">-->
											<!--													--><?php //echo esc_html( antispambot( $agent_email ) ); ?>
											<!--                                                </a>-->
											<!--											--><?php //}
											//											?>
										</div>
									</div>
									<div class="rhea-ultra-agent-listings-thumbs">
										<?php
										foreach ( $agent['featured_images'] as $slider_image ) {


											$image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $slider_image['id'], 'thumbnail', $settings );
											?>
											<img src="<?php echo esc_url( $image_url ) ?>"
											     alt="<?php echo esc_attr( \Elementor\Control_Media::get_image_alt( $slider_image ) ) ?>">
											<?php
										}
										?>
									</div>
									<div class="rhea-ultra-agent-links">
										<a class="rhea-ultra-agent-profile"
										   href="<?php echo esc_url( get_the_permalink( $agent_id ) ); ?>">
											<?php esc_html_e( 'View Profile', 'realhomes-elementor-addon' ); ?>
										</a>
										<!--	                        --><?php //if ( $settings['properties_count'] === 'yes' ) { ?>
										<a class="rhea-ultra-agent-listed"
										   href="<?php echo get_the_permalink( $agent_id ) ?>">
											<?php echo ( ! empty( $listed_properties ) ) ? esc_html( $listed_properties ) : 0;
											echo ' ';
											echo ( 1 === $listed_properties ) ? esc_html__( 'Listed Property', 'realhomes-elementor-addon' ) : esc_html__( 'Listed Properties', 'realhomes-elementor-addon' ); ?>
											<i class="rhea-fas fas fa-caret-right"></i>
										</a>
										<?php
										//                            }
										?>
									</div>
								</div>
							</li>

							<?php
						}
						?>
					</ul>
				</div>
				<div class="rhea-ultra-slider-navigation">
					<a href="#" class="rhea-ultra-directional-nav flex-prev"><i class="fas fa-caret-left"></i></a>
					<div class="rhea-ultra-slider-controls"></div>
					<a href="#" class="rhea-ultra-directional-nav flex-next"><i class="fas fa-caret-right"></i></a>
				</div>
			</div>
			<script type="application/javascript">
                jQuery(document).ready(function () {
                    rheaUltraCarouselAgents('#rhea-ultra-<?php echo $this->get_id(); ?>');
                });
			</script>
			<?php
		}

	}
}