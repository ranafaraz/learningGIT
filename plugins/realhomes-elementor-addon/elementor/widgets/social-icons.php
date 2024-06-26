<?php
/**
 * Social Icons Widget
 *
 * @since 2.1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Social_Icons_List_Widget extends \Elementor\Widget_Base
{

	public function get_name() {
		return 'rhea-social-icons-list-widget';
	}

	public function get_title() {
		return esc_html__( 'Social Icons :: RealHomes', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-social-icons';
	}

	public function get_keywords() {
		return [ 'icon list', 'icon', 'list' ];
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'icon_list_section',
			[
				'label' => esc_html__( 'Icon List', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'social_icon',
			[
				'label'            => esc_html__( 'Icon', 'realhomes-elementor-addon' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'social',
				'default'          => [
					'value'   => 'fab fa-wordpress',
					'library' => 'fa-brands',
				],
				'recommended'      => [
					'fa-brands' => [
						'android',
						'apple',
						'behance',
						'bitbucket',
						'codepen',
						'delicious',
						'deviantart',
						'digg',
						'dribbble',
						'elementor',
						'facebook',
						'flickr',
						'foursquare',
						'free-code-camp',
						'github',
						'gitlab',
						'globe',
						'houzz',
						'instagram',
						'jsfiddle',
						'linkedin',
						'medium',
						'meetup',
						'mix',
						'mixcloud',
						'odnoklassniki',
						'pinterest',
						'product-hunt',
						'reddit',
						'shopping-cart',
						'skype',
						'slideshare',
						'snapchat',
						'soundcloud',
						'spotify',
						'stack-overflow',
						'steam',
						'telegram',
						'thumb-tack',
						'tripadvisor',
						'tumblr',
						'twitch',
						'twitter',
						'viber',
						'vimeo',
						'vk',
						'weibo',
						'weixin',
						'whatsapp',
						'wordpress',
						'xing',
						'yelp',
						'youtube',
						'500px',
					],
					'fa-solid'  => [
						'envelope',
						'link',
						'rss',
					],
				],
			]
		);
		$repeater->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'realhomes-elementor-addon' ),
			]
		);

		$repeater->add_responsive_control(
			'icon_font_size',
			[
				'label'      => esc_html__( 'Icon Font Size', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				// The `%' and `em` units are not supported as the widget implements icons differently then other icons.
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} a'     => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} a svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'social_icon_list',
			[
				'label'       => esc_html__( 'Social Icons', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'social_icon' => [
							'value'   => 'fab fa-facebook',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value'   => 'fab fa-youtube',
							'library' => 'fa-brands',
						],
					],
				],
				'title_field' => '<# var migrated = "undefined" !== typeof __fa4_migrated, social = ( "undefined" === typeof social ) ? false : social; #>{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, social, true, migrated, true ) }}}',
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'basic_settings',
			[
				'label' => esc_html__( 'Basic Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_responsive_control(
			'icon_size',
			[
				'label'      => esc_html__( 'Icon Area Size', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				// The `%' and `em` units are not supported as the widget implements icons differently then other icons.
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-social-icons-list a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_border_size',
			[
				'label'      => esc_html__( 'Border Width', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				// The `%' and `em` units are not supported as the widget implements icons differently then other icons.
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-social-icons-list a' => 'border-width : {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				// The `%' and `em` units are not supported as the widget implements icons differently then other icons.
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-social-icons-list a' => 'border-radius : {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_column_gap',
			[
				'label'      => esc_html__( 'Column Gap', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				// The `%' and `em` units are not supported as the widget implements icons differently then other icons.
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-social-icons-list' => 'column-gap : {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_row_gap',
			[
				'label'      => esc_html__( 'Row Gap', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				// The `%' and `em` units are not supported as the widget implements icons differently then other icons.
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-social-icons-list' => 'row-gap : {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'ere_section_align',
			[
				'label'     => esc_html__( 'Alignment', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'     => [
						'title' => esc_html__( 'Center', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-center',
					],
					'flex-end'   => [
						'title' => esc_html__( 'Right', 'realhomes-elementor-addon' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-social-icons-list' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'font_color',
			[
				'label'     => esc_html__( 'Icon Font Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-social-icons-list a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'font_hover_color',
			[
				'label'     => esc_html__( 'Icon Font Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-social-icons-list a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'svg_stroke_color',
			[
				'label'     => esc_html__( 'SVG Icon Stroke Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-social-icons-list a path' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'svg_stroke_color_hover',
			[
				'label'     => esc_html__( 'SVG Icon Stroke Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-social-icons-list a:hover path' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'svg_fill_color',
			[
				'label'     => esc_html__( 'SVG Icon Fill Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-social-icons-list a path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'svg_fill_color_hover',
			[
				'label'     => esc_html__( 'SVG Icon Fill Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-social-icons-list a:hover path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'font_color_bg',
			[
				'label'     => esc_html__( 'Icon Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-social-icons-list a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'font_hover_color_bg',
			[
				'label'     => esc_html__( 'Icon Background Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-social-icons-list a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'font_color_border',
			[
				'label'     => esc_html__( 'Icon Border Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-social-icons-list a' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'font_hover_color_border',
			[
				'label'     => esc_html__( 'Icon Border Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-social-icons-list a:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
        <ul class="rhea-social-icons-list">
			<?php
			foreach ( $settings['social_icon_list'] as $index => $item ) {
				$link_key = 'link_' . $index;
				$this->add_link_attributes( $link_key, $item['link'] );
				?>
                <li class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">
                    <a class="rhea-social-icon" <?php echo $this->get_render_attribute_string( $link_key ); ?>>
						<?php \Elementor\Icons_Manager::render_icon( $item['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </a>
                </li>
				<?php
			}
			?>
        </ul>
		<?php
	}
}
