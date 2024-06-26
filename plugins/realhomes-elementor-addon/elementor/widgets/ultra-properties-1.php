<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Properties_Widget_One extends \Elementor\Widget_Base
{
	private $is_rvr_enabled;

	public function __construct(array $data = [], array $args = null)
	{
		parent::__construct($data, $args);
		$this->is_rvr_enabled = rhea_is_rvr_enabled();
	}

	public function get_name()
	{
		return 'rhea-ultra-properties-widget-1';
	}

	public function get_title()
	{
		return esc_html__('Ultra Properties', 'realhomes-elementor-addon');
	}

	public function get_icon()
	{
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-posts-grid';
	}

	public function get_categories()
	{
		return ['ultra-real-homes'];
	}

	protected function register_controls()
	{

		$grid_size_array = wp_get_additional_image_sizes();

		$prop_grid_size_array = array();
		foreach ($grid_size_array as $key => $value) {
			$str_rpl_key = ucwords(str_replace("-", " ", $key));

			$prop_grid_size_array[$key] = $str_rpl_key . ' - ' . $value['width'] . 'x' . $value['height'];
		}

		unset($prop_grid_size_array['partners-logo']);
		unset($prop_grid_size_array['property-detail-slider-thumb']);
		unset($prop_grid_size_array['post-thumbnail']);
		unset($prop_grid_size_array['agent-image']);
		unset($prop_grid_size_array['gallery-two-column-image']);
		unset($prop_grid_size_array['post-featured-image']);

		$default_prop_grid_size = 'property-thumb-image';

		$allowed_html = array(
			'a' => array(
				'href' => array(),
				'title' => array()
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
		);

		$this->start_controls_section(
			'ere_properties_section',
			[
				'label' => esc_html__('Properties', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'enable_search',
			[
				'label' => esc_html__('Enable Property Search Filtering', 'realhomes-elementor-addon'),
				'description' => esc_html__('Enabling this will filter the property cards on search results page.', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'single_agent_agency_properties' => ['', 'no'],
				],
			]
		);

		$this->add_control(
			'single_agent_agency_properties',
			[
				'label' => esc_html__('Display Properties for Agent/Agency Single Page', 'realhomes-elementor-addon'),
				'description' => esc_html__('Enabling this will display properties only on agent/agency single page based on agent ID.', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'enable_search' => ['', 'no'],
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__('Layout', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'carousel' => esc_html__('Carousel', 'realhomes-elementor-addon'),
					'grid' => esc_html__('Grid', 'realhomes-elementor-addon'),
					'list' => esc_html__('List', 'realhomes-elementor-addon'),
				],
				'default' => 'carousel',
			]
		);

		$this->add_responsive_control(
			'grid_columns',
			[
				'label' => esc_html__('Grid Columns', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
					5 => 5,
					6 => 6,
				],
				'condition' => [
					'layout' => 'grid',
				],
			]
		);

		$this->add_control(
			'card',
			[
				'label' => esc_html__('Card Style', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1' => esc_html__('One', 'realhomes-elementor-addon'),
					'2' => esc_html__('Two', 'realhomes-elementor-addon'),
					'3' => esc_html__('Three', 'realhomes-elementor-addon'),
					'4' => esc_html__('Four', 'realhomes-elementor-addon'),
					'5' => esc_html__('Five', 'realhomes-elementor-addon'),
				],
				'default' => '1',
				'condition' => [
					'layout' => ['carousel', 'grid'],
				],
			]
		);

		$this->add_responsive_control(
			'list_columns',
			[
				'label' => esc_html__('List Columns', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 1,
				'options' => [
					1 => 1,
					2 => 2,
					3 => 3
				],
				'condition' => [
					'layout' => 'list',
				],
			]
		);

		$this->add_control(
			'ere_property_grid_thumb_sizes',
			[
				'label' => esc_html__('Grid Card Thumbnail Size', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => $default_prop_grid_size,
				'options' => $prop_grid_size_array,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'enable_layout_toggle_buttons',
							'value' => 'yes',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '2', '4', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__('Number of Properties', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 60,
				'step' => 1,
				'default' => 6,
			]
		);

		$get_agents = array();
		$agent_ids = get_posts(
			array(
				'fields' => 'ids',
				'posts_per_page' => -1,
				'post_type' => 'agent'
			)
		);

		if (!empty($agent_ids)) {
			foreach ($agent_ids as $id) {
				$get_agents["$id"] = get_the_title($id);
			}
		}
		$this->add_control(
			'select_agent',
			[
				'label' => esc_html__('Agent Based Properties', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'default' => '',
				'options' => $get_agents,
				'label_block' => true,
				'condition' => [
					'single_agent_agency_properties' => ['', 'no'],
				],
			]
		);

		// Select controls for Custom Taxonomies related to Property
		$property_taxonomies = get_object_taxonomies('property', 'objects');
		if (!empty($property_taxonomies) && !is_wp_error($property_taxonomies)) {
			foreach ($property_taxonomies as $single_tax) {
				$options = [];
				$terms = get_terms($single_tax->name);

				if (!empty($terms) && !is_wp_error($terms)) {
					foreach ($terms as $term) {
						$options[$term->slug] = $term->name;
					}
				}

				$this->add_control(
					$single_tax->name,
					[
						'label' => $single_tax->label,
						'type' => \Elementor\Controls_Manager::SELECT2,
						'multiple' => true,
						'label_block' => true,
						'options' => $options,
					]
				);
			}
		}

		// Sorting Controls
		$this->add_control(
			'orderby',
			[
				'label' => esc_html__('Order By', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'date' => esc_html__('Date', 'realhomes-elementor-addon'),
					'price' => esc_html__('Price', 'realhomes-elementor-addon'),
					'title' => esc_html__('Title', 'realhomes-elementor-addon'),
					'menu_order' => esc_html__('Menu Order', 'realhomes-elementor-addon'),
					'rand' => esc_html__('Random', 'realhomes-elementor-addon'),
				],
				'default' => 'date',
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__('Order', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'asc' => esc_html__('Ascending', 'realhomes-elementor-addon'),
					'desc' => esc_html__('Descending', 'realhomes-elementor-addon'),
				],
				'default' => 'desc',
			]
		);

		$this->add_control(
			'show_only_featured',
			[
				'label' => esc_html__('Show Only Featured Properties', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'skip_sticky_properties',
			[
				'label' => esc_html__('Skip Sticky Properties', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'offset',
			[
				'label' => esc_html__('Offset or Skip From Start', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '0',
			]
		);


		$this->add_control(
			'ere_show_property_status',
			[
				'label' => esc_html__('Show Property Status', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'card',
							'value' => '1',
						],
						[
							'name' => 'layout',
							'value' => 'list',
						],
					],
				],
			]
		);

		$this->add_control(
			'ere_show_featured_tag',
			[
				'label' => esc_html__('Show Featured Tag', 'realhomes-elementor-addon'),
				'description' => wp_kses(__('Show if property is set to featured', 'realhomes-elementor-addon'), $allowed_html),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'card',
							'value' => '1',
						],
						[
							'name' => 'layout',
							'value' => 'list',
						],
					],
				],
			]
		);

		$this->add_control(
			'ere_show_label_tags',
			[
				'label' => esc_html__('Show Property Label Tag', 'realhomes-elementor-addon'),
				'description' => wp_kses(__('Show if property label text is set', 'realhomes-elementor-addon'), $allowed_html),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'card',
							'value' => '1',
						],
						[
							'name' => 'layout',
							'value' => 'list',
						],
					],
				],
			]
		);

		$this->add_control(
			'ere_show_property_media_count',
			[
				'label' => esc_html__('Show Property Media Count', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'card',
							'value' => '1',
						],
						[
							'name' => 'layout',
							'value' => 'list',
						],
					],
				],
			]
		);


		$this->add_control(
			'ere_enable_fav_properties',
			[
				'label' => esc_html__('Show Add To Favourite Button', 'realhomes-elementor-addon'),
				'description' => wp_kses(__('<strong>Important:</strong> Make sure to select <strong>Show</strong> in Customizer <strong>Favorites</strong> settings. ', 'realhomes-elementor-addon'), $allowed_html),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'card',
							'value' => '1',
						],
						[
							'name' => 'layout',
							'value' => 'list',
						],
					],
				],
			]
		);

		$this->add_control(
			'ere_enable_compare_properties',
			[
				'label' => esc_html__('Show Add To Compare Button  ', 'realhomes-elementor-addon'),
				'description' => wp_kses(__('<strong>Important:</strong> Make sure <strong>Compare Properties</strong> is <strong>enabled</strong> in Customizer settings. ', 'realhomes-elementor-addon'), $allowed_html),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'card',
							'value' => '1',
						],
						[
							'name' => 'layout',
							'value' => 'list',
						],
					],
				],
			]
		);

		$this->add_control(
			'show_address',
			[
				'label' => esc_html__('Show Address', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '2', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'ere_show_property_type',
			[
				'label' => esc_html__('Show Property Type', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['1'],
				],
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label' => esc_html__('Show Pagination', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'layout' => ['grid', 'list'],
				],
			]
		);

		$this->add_control(
			'ajax_pagination',
			[
				'label' => esc_html__('Ajax Pagination', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'layout' => ['grid', 'list'],
					'show_pagination' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_year_built',
			[
				'label' => esc_html__('Show Year Built', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'layout' => ['list'],
				],
			]
		);

		$this->add_control(
			'year_built_label',
			[
				'label' => esc_html__('Year Built Label', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'layout' => ['list'],
					'show_year_built' => 'yes'
				],
			]
		);

		if ($this->is_rvr_enabled) {
			$this->add_control(
				'rhea_rating_enable',
				[
					'label' => esc_html__('Show Ratings?', 'realhomes-elementor-addon'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
					'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);
		}

		$this->add_control(
			'excerpt_length',
			[
				'label' => esc_html__('Grid Card Excerpt Length', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 100,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'enable_layout_toggle_buttons',
							'value' => 'yes',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['3', '4', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'show_list_card_excerpt',
			[
				'label' => esc_html__('Show List Card Excerpt', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'no',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'name' => 'enable_layout_toggle_buttons',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'list_card_excerpt_length',
			[
				'label' => esc_html__('List Card Excerpt Length', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 5,
				'condition' => [
					'show_list_card_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['4', '5'],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'top_bar_settings',
			[
				'label' => esc_html__('Top Bar', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'layout' => ['grid', 'list'],
				],
			]
		);

		$this->add_control(
			'enable_top_bar',
			[
				'label' => esc_html__('Enable Top Bar', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'enable_statistics',
			[
				'label' => esc_html__('Enable Statistics', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_top_bar' => 'yes',
				],
			]
		);

		$this->add_control(
			'enable_frontend_sorting',
			[
				'label' => esc_html__('Enable Sorting', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_top_bar' => 'yes',
				],
			]
		);

		$this->add_control(
			'enable_layout_toggle_buttons',
			[
				'label' => esc_html__('Enable Layout Toggle Buttons', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_top_bar' => 'yes',
				],
			]
		);

		$this->add_control(
			'toggle_view_options',
			[
				'label' => esc_html__('Grid Layout Settings in Layout Toggle', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'layout' => 'list',
					'enable_layout_toggle_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'grid_columns_in_toggle_view',
			[
				'label' => esc_html__('Grid Columns', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
					5 => 5,
					6 => 6,
				],
				'condition' => [
					'layout' => 'list',
					'enable_layout_toggle_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'grid_card_in_toggle_view',
			[
				'label' => esc_html__('Grid Card Style', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1' => esc_html__('One', 'realhomes-elementor-addon'),
					'2' => esc_html__('Two', 'realhomes-elementor-addon'),
					'3' => esc_html__('Three', 'realhomes-elementor-addon'),
					'4' => esc_html__('Four', 'realhomes-elementor-addon'),
					'5' => esc_html__('Five', 'realhomes-elementor-addon'),
				],
				'default' => '1',
				'condition' => [
					'layout' => 'list',
					'enable_layout_toggle_buttons' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ere_properties_meta_settings',
			[
				'label' => esc_html__('Meta Settings', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hide_meta_label',
			[
				'label' => esc_html__('Hide Meta Labels', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['4'],
				],
			]
		);

		$get_meta = array(
			'bedrooms' => esc_html__('Bedrooms', 'realhomes-elementor-addon'),
			'bathrooms' => esc_html__('Bathrooms', 'realhomes-elementor-addon'),
			'area' => esc_html__('Area', 'realhomes-elementor-addon'),
			'garage' => esc_html__('Garages/Parking', 'realhomes-elementor-addon'),
			'year-built' => esc_html__('Year Built', 'realhomes-elementor-addon'),
			'lot-size' => esc_html__('Lot Size', 'realhomes-elementor-addon'),
			'floor' => esc_html__('Floor', 'realhomes-elementor-addon'),
		);

		$meta_defaults = array(
			array(
				'rhea_property_meta_display' => 'bedrooms',
				'rhea_meta_repeater_label' => esc_html__('Bedrooms', 'realhomes-elementor-addon'),
			),
			array(
				'rhea_property_meta_display' => 'bathrooms',
				'rhea_meta_repeater_label' => esc_html__('Bathrooms', 'realhomes-elementor-addon'),
			),
			array(
				'rhea_property_meta_display' => 'area',
				'rhea_meta_repeater_label' => esc_html__('Area', 'realhomes-elementor-addon'),
			),
		);

		if ($this->is_rvr_enabled) {
			$get_meta = array(
				'bedrooms' => esc_html__('Bedrooms', 'realhomes-elementor-addon'),
				'bathrooms' => esc_html__('Bathrooms', 'realhomes-elementor-addon'),
				'area' => esc_html__('Area', 'realhomes-elementor-addon'),
				'garage' => esc_html__('Garages/Parking', 'realhomes-elementor-addon'),
				'year-built' => esc_html__('Year Built', 'realhomes-elementor-addon'),
				'lot-size' => esc_html__('Lot Size', 'realhomes-elementor-addon'),
				'guests' => esc_html__('Guests Capacity', 'realhomes-elementor-addon'),
				'min-stay' => esc_html__('Min Stay', 'realhomes-elementor-addon'),
				'floor' => esc_html__('Floor', 'realhomes-elementor-addon'),
			);

			$meta_defaults = array(
				array(
					'rhea_property_meta_display' => 'bedrooms',
					'rhea_meta_repeater_label' => esc_html__('Bedrooms', 'realhomes-elementor-addon'),
				),
				array(
					'rhea_property_meta_display' => 'bathrooms',
					'rhea_meta_repeater_label' => esc_html__('Bathrooms', 'realhomes-elementor-addon'),
				),
				array(
					'rhea_property_meta_display' => 'guests',
					'rhea_meta_repeater_label' => esc_html__('Guests', 'realhomes-elementor-addon'),
				),
				array(
					'rhea_property_meta_display' => 'area',
					'rhea_meta_repeater_label' => esc_html__('Area', 'realhomes-elementor-addon'),
				),
				array(
					'rhea_property_meta_display' => 'floor',
					'rhea_meta_repeater_label' => esc_html__('Floor', 'realhomes-elementor-addon'),
				),
			);
		}

		$get_meta = apply_filters('rhea_custom_fields_meta_icons', $get_meta);

		$meta_repeater = new \Elementor\Repeater();

		$meta_repeater->add_control(
			'rhea_property_meta_display',
			[
				'label' => esc_html__('Select Meta', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $get_meta,
			]
		);

		$meta_repeater->add_control(
			'rhea_meta_repeater_label',
			[
				'label' => esc_html__('Meta Label', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Add Label', 'realhomes-elementor-addon'),
			]
		);

		$this->add_control(
			'rhea_add_meta_select',
			[
				'label' => esc_html__('Add Meta', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $meta_repeater->get_controls(),
				'default' => $meta_defaults,
				'title_field' => ' {{{ rhea_meta_repeater_label }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ere_property_typo_section',
			[
				'label' => esc_html__('Typography', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'property_top_tags_typography',
				'label' => esc_html__('Top Tags', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-status-box span,{{WRAPPER}} .rhea-ultra-status-box a',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'year_built_label_typography',
				'label' => esc_html__('Year Built Label', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-property-list-card-year-built',
				'condition' => [
					'layout' => ['list'],
					'show_year_built' => 'yes'
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'property_heading_typography',
				'label' => esc_html__('Heading', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} h3.rhea-ultra-property-title a, 
							   {{WRAPPER}} .rhea-ultra-property-card-two-title, 
							   {{WRAPPER}} .rhea-ultra-property-card-three-title,
							   {{WRAPPER}} .rhea-ultra-property-card-four-title,
							   {{WRAPPER}} .rhea-ultra-property-card-five-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'property_address_typography',
				'label' => esc_html__('Address', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea_address_ultra a, {{WRAPPER}} .rhea-ultra-property-card-two-address, {{WRAPPER}} .rhea-ultra-property-card-five-address',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '2', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'address_icon_size',
			[
				'label' => esc_html__('Address Marker icon size', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 40,
					],
				],
				'desktop_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .rhea_address_ultra .rhea_ultra_address_pin' => 'width: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'property_excerpt_typography',
				'label' => esc_html__('Grid Card Excerpt', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-property-card-three-content > p,
				                {{WRAPPER}} .rhea-ultra-property-card-four-content > p,
				                {{WRAPPER}} .rhea-ultra-property-card-five-content > p',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'enable_layout_toggle_buttons',
							'value' => 'yes',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['3', '4', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list_card_excerpt_typography',
				'label' => esc_html__('List Card Excerpt', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-property-list-card-excerpt',
				'condition' => [
					'show_list_card_excerpt' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'property_types_typography',
				'label' => esc_html__('Property Types', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-property-types small',
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['1'],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'property_price_prefix_typography',
				'label' => esc_html__('Price Prefix (i.e From)', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-prefix, {{WRAPPER}} .rhea-ultra-property-card-five .ere-price-prefix',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'property_price_typography',
				'label' => esc_html__('Price', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-display, 
								{{WRAPPER}} p.rh_prop_card__price_ultra .property-current-price, 
								{{WRAPPER}} .rhea-ultra-property-card-two-price,
								{{WRAPPER}} .rhea-ultra-property-card-two .ere-price-display,
								{{WRAPPER}} .rhea-ultra-property-card-four .ere-price-display,
								{{WRAPPER}} .rhea-ultra-property-card-four .ere-price-slash,		
								{{WRAPPER}} .rhea-ultra-property-card-five-price,
								{{WRAPPER}} .rhea-ultra-property-card-five .ere-price-display,
								{{WRAPPER}} .rhea-ultra-property-card-five .property-current-price
								',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '2', '4', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'property_old_price_typography',
				'label' => esc_html__('Old Price', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} p.rh_prop_card__price_ultra .property-old-price, {{WRAPPER}} .rhea-ultra-property-card-five .property-old-price',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'property_price_postfix_typography',
				'label' => esc_html__('Price Postfix (i.e Monthly)', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-postfix, 
				                {{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-slash,
				                {{WRAPPER}} .rhea-ultra-property-card-four .ere-price-postfix,
				                {{WRAPPER}} .rhea-ultra-property-card-five .ere-price-postfix,
				                {{WRAPPER}} .rhea-ultra-property-card-five .ere-price-slash
				                ',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '4', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'show_price_slash',
			[
				'label' => esc_html__('Show Price Postfix Separator (i.e "/")', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['1'],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'property_meta_labels_typography',
				'label' => esc_html__('Meta Labels', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea_ultra_meta_box .figure',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'property_meta_figures_typography',
				'label' => esc_html__('Figures postfix (i.e sqft)', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea_ultra_meta_box .label',
			]
		);

		$this->add_responsive_control(
			'meta_icon_icon_size',
			[
				'label' => esc_html__('Meta icon size', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 40,
					],
				],
				'desktop_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .rh_prop_card_meta_wrap_ultra svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rh_prop_card_meta_wrap_ultra img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'link_button_typography',
				'label' => esc_html__('Button', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-property-card-two-link,
				                {{WRAPPER}} .rhea-ultra-property-card-four-link,
				                {{WRAPPER}} .rhea-ultra-property-card-five-link
				',
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['2', '4', '5'],
				],
			]
		);

		if ($this->is_rvr_enabled) {
			$this->add_responsive_control(
				'rating_stars_size',
				[
					'label' => esc_html__('Rating star size', 'realhomes-elementor-addon'),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 40,
						],
					],
					'desktop_default' => [
						'size' => '',
						'unit' => 'px',
					],
					'tablet_default' => [
						'size' => '',
						'unit' => 'px',
					],
					'mobile_default' => [
						'size' => '',
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .rvr_card_info_wrap .rh-ultra-rvr-rating .rating-stars i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .rhea-ultra-meta-info-wrap .rhea-ultra-rvr-rating i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .rhea-ultra-property-card-five .rating-stars i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name' => 'layout',
								'value' => 'list',
							],
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' => 'layout',
										'operator' => 'in',
										'value' => ['carousel', 'grid'],
									],
									[
										'name' => 'card',
										'operator' => 'in',
										'value' => ['1', '3', '4', '5'],
									],
								],
							]
						],
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'ultra_rvr_rating_value',
					'label' => esc_html__('Rating value typography', 'realhomes-elementor-addon'),
					'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .rhea-ultra-rvr-rating-value, {{WRAPPER}} .rhea-ultra-property-card-five .rating-span',
					'condition' => [
						'layout' => ['carousel', 'grid'],
						'card' => ['3', '4', '5'],
					],

				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'property_added_date_typography',
					'label' => esc_html__('Added date typography', 'realhomes-elementor-addon'),
					'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .rvr_card_info_wrap .added-date',
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name' => 'layout',
								'value' => 'list',
							],
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' => 'layout',
										'operator' => 'in',
										'value' => ['carousel', 'grid'],
									],
									[
										'name' => 'card',
										'value' => '1',
									],
								],
							]
						],
					],
				]
			);
		}

		$this->end_controls_section();

		$this->start_controls_section(
			'ere_properties_labels',
			[
				'label' => esc_html__('Property Labels', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'ere_property_featured_label',
			[
				'label' => esc_html__('Featured', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Featured', 'realhomes-elementor-addon'),
			]
		);

		$this->add_control(
			'ere_property_fav_label',
			[
				'label' => esc_html__('Add To Favourite', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Add To Favourite', 'realhomes-elementor-addon'),
			]
		);

		$this->add_control(
			'ere_property_fav_added_label',
			[
				'label' => esc_html__('Added To Favourite', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Added To Favourite', 'realhomes-elementor-addon'),
			]
		);

		$this->add_control(
			'ere_property_compare_label',
			[
				'label' => esc_html__('Add To Compare', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Add To Compare', 'realhomes-elementor-addon'),
			]
		);

		$this->add_control(
			'ere_property_compare_added_label',
			[
				'label' => esc_html__('Added To Compare', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Added To Compare', 'realhomes-elementor-addon'),
			]
		);

		$this->add_control(
			'ere_property_rvt_date_added_label',
			[
				'label' => esc_html__('Date Added Label', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Added:', 'realhomes-elementor-addon'),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'carousel_settings',
			[
				'label' => esc_html__('Carousel Settings', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'layout' => 'carousel',
				],
			]
		);

		$slides_to_show = array(
			'' => esc_html__('Default', 'realhomes-elementor-addon'),
			'1' => 1,
			'2' => 2,
			'3' => 3,
			'4' => 4,
			'5' => 5,
			'6' => 6,
			'7' => 7,
			'8' => 8,
			'9' => 9,
			'10' => 10,
		);

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label' => esc_html__('Slides to Show', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 3,
				'options' => $slides_to_show,
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label' => esc_html__('Slides to Scroll', 'realhomes-elementor-addon'),
				'description' => esc_html__('Set how many slides are scrolled per swipe.', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $slides_to_show,
				'condition' => [
					'slides_to_show!' => '1',
				],
			]
		);

		$this->add_responsive_control(
			'slide_margin',
			[
				'label' => esc_html__('Slide Margin', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 40,
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => esc_html__('Animation Speed', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__('Autoplay', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'layout' => 'carousel',
				],
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => esc_html__('Autoplay Interval Timeout', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 1000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => esc_html__('Pause on Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'autoplay' => 'yes',
				]
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => esc_html__('Infinite Loop', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_arrows',
			[
				'label' => esc_html__('Show Arrows', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_dots',
			[
				'label' => esc_html__('Show Dots', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'realhomes-elementor-addon'),
				'label_off' => esc_html__('No', 'realhomes-elementor-addon'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ere_property_basic_styles',
			[
				'label' => esc_html__('Basic Styles', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'property_card_border_radius',
			[
				'label' => esc_html__('Property Card Radius', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-two,
					 {{WRAPPER}} .rhea-ultra-property-card-three,
					 {{WRAPPER}} .rhea-ultra-property-card-three-content,
					 {{WRAPPER}} .rhea-ultra-property-card-four,				 
					 {{WRAPPER}} .rhea-ultra-property-card-five				 
					' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rhea-ultra-property-card-two .rhea-ultra-property-card-two-thumb img,
					 {{WRAPPER}} .rhea-ultra-property-card-four .rhea-ultra-property-card-four-thumb img,				 
					 {{WRAPPER}} .rhea-ultra-property-card-five .rhea-ultra-property-card-five-thumb img				 
					' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['2', '3', '4', '5'],
				],
			]
		);

		$this->add_responsive_control(
			'property_card_padding',
			[
				'label' => esc_html__('Property Card Padding', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-two,
					 {{WRAPPER}} .rhea-ultra-property-card-three
					' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['2', '3'],
				],
			]
		);

		$this->add_responsive_control(
			'featured_border_radius',
			[
				'label' => esc_html__('Featured Image Radius', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-two-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => '2',
				],
			]
		);

		$this->add_responsive_control(
			'property_card_content_padding',
			[
				'label' => esc_html__('Property Card Content Padding', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-two-content,
					 {{WRAPPER}} .rhea-ultra-property-card-three-content,
					 {{WRAPPER}} .rhea-ultra-property-card-four-content,
					 {{WRAPPER}} .rhea-ultra-property-card-five-content
					' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['2', '3', '4', '5'],
				],
			]
		);

		$this->add_responsive_control(
			'thumb_border_radius',
			[
				'label' => esc_html__('Thumbnail Border Radius', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-thumb a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['1'],
				],
			]
		);

		$this->add_responsive_control(
			'list_card_border_radius',
			[
				'label' => esc_html__('List Card Border Radius', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-list-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rhea-ultra-property-list-card .rh-thumb-with-bg' => is_rtl() ? 'border-radius: 0 {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 0;' : 'border-radius: {{TOP}}{{UNIT}} 0 0 {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'list',
				],
			]
		);

		$this->add_responsive_control(
			'top_tag_border_radius',
			[
				'label' => esc_html__('Top Tags Border Radius', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rhea-ultra-status-box a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'media_count_border_radius',
			[
				'label' => esc_html__('Media Count Border Radius', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_media_count .rhea_media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'thumbnail_margin_bottom',
			[
				'label' => esc_html__('Thumbnail Margin bottom', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-card-thumb-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['1'],
				],
			]
		);
		$this->add_responsive_control(
			'carousel_card_4_info_width',
			[
				'label' => esc_html__('Card Info Container Max Width', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-three-content' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'card' => ['3'],
				],
			]
		);

		$this->add_responsive_control(
			'title_and_price_margin_bottom',
			[
				'label' => esc_html__('Title and Price Container Margin bottom', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-five-content-inner
					' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['5'],
				],
			]
		);

		$this->add_responsive_control(
			'title_margin_bottom',
			[
				'label' => esc_html__('Title Margin bottom', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-title, 
					 {{WRAPPER}} .rhea-ultra-property-card-two-title,
					 {{WRAPPER}} .rhea-ultra-property-card-three-title,
					 {{WRAPPER}} .rhea-ultra-property-card-four-title,
					 {{WRAPPER}} .rhea-ultra-property-card-five-title
					' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'address_margin_bottom',
			[
				'label' => esc_html__('Address Margin bottom', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea_address_ultra, 
					{{WRAPPER}} .rhea-ultra-property-card-two-address,
					{{WRAPPER}} .rhea-ultra-property-card-five-address
					' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '2', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'rating_margin_bottom',
			[
				'label' => esc_html__('Rating Margin bottom', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-five .stars-avg-rating' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['5'],
				],
			]
		);

		$this->add_responsive_control(
			'excerpt_margin_bottom',
			[
				'label' => esc_html__('Grid Card Excerpt Margin bottom', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-three-content > p,
					 {{WRAPPER}} .rhea-ultra-property-card-four-content > p,
					 {{WRAPPER}} .rhea-ultra-property-card-five-content > p
					' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'enable_layout_toggle_buttons',
							'value' => 'yes',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['3', '4', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'list_card_excerpt_margin_bottom',
			[
				'label' => esc_html__('List Card Excerpt Margin', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-list-card-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_list_card_excerpt' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'slide_height',
			[
				'label' => esc_html__('Slide Height', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'.rhea-ultra-property-card-three' => 'min-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['3'],
				],
			]
		);

		$this->add_responsive_control(
			'meta_margin_bottom',
			[
				'label' => esc_html__('Meta Margin bottom', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-two .rh_prop_card_meta_wrap_ultra,
					 {{WRAPPER}} .rhea-ultra-property-card-five .rh_prop_card_meta_wrap_ultra
					' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['2', '5'],
				],
			]
		);

		$this->add_responsive_control(
			'price_wrapper_padding',
			[
				'label' => esc_html__('Price Wrapper Padding', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-four-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['4'],
				],
			]
		);

		$this->add_responsive_control(
			'price_wrapper_radius',
			[
				'label' => esc_html__('Price Wrapper Radius', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-four-price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['4'],
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__('Button Padding', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-two-link,
					 {{WRAPPER}} .rhea-ultra-property-card-four-link,
					 {{WRAPPER}} .rhea-ultra-property-card-five-link
					' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['2', '4', '5'],
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => esc_html__('Button Radius', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-two-link,
					 {{WRAPPER}} .rhea-ultra-property-card-four-link,
					 {{WRAPPER}} .rhea-ultra-property-card-five-link
					' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['2', '4', '5'],
				],
			]
		);

		$this->add_responsive_control(
			'type_margin_bottom',
			[
				'label' => esc_html__('Property Type Margin bottom', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'desktop_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-types' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['1'],
				],
			]
		);

		$this->add_responsive_control(
			'price_column_gap',
			[
				'label' => esc_html__('Column gap price/meta', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'desktop_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-price-meta-box' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['1'],
				],
			]
		);

		$this->add_responsive_control(
			'mta_column_gap',
			[
				'label' => esc_html__('Column gap meta items', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'desktop_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .rh_prop_card_meta_wrap_ultra' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'mta_row_gap',
			[
				'label' => esc_html__('Row gap meta items', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'desktop_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .rh_prop_card_meta_wrap_ultra' => 'row-gap: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'top_bar_styles',
			[
				'label' => esc_html__('Top Bar', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => ['grid', 'list'],
				],
			]
		);

		$this->add_responsive_control(
			'top_bar_padding',
			[
				'label' => esc_html__('Padding', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-properties-top-bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'top_bar_margin',
			[
				'label' => esc_html__('Margin', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-properties-top-bar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'top_bar_border_radius',
			[
				'label' => esc_html__('Border Radius', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-properties-top-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'top_bar_border',
				'label' => esc_html__('Border', 'realhomes-elementor-addon'),
				'selector' => '{{WRAPPER}} .rhea-ultra-properties-top-bar',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'top_bar_box_shadow',
				'label' => esc_html__('Box Shadow', 'realhomes-elementor-addon'),
				'selector' => '{{WRAPPER}} .rhea-ultra-properties-top-bar',
			]
		);

		$this->add_control(
			'statistics_heading',
			[
				'label' => esc_html__('Statistics', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_statistics' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'statistics_text_typography',
				'label' => esc_html__('Text Typography', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-properties-top-bar-stats-wrapper',
				'condition' => [
					'enable_statistics' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'statistics_numbers_typography',
				'label' => esc_html__('Numbers Typography', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-properties-top-bar-stats-wrapper span',
				'condition' => [
					'enable_statistics' => 'yes',
				],
			]
		);

		$this->add_control(
			'statistics_color',
			[
				'label' => esc_html__('Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-properties-top-bar-stats-wrapper' => 'color: {{VALUE}}',
				],
				'condition' => [
					'enable_statistics' => 'yes',
				],
			]
		);

		$this->add_control(
			'sorting_heading',
			[
				'label' => esc_html__('Sorting', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_frontend_sorting' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sorting_label_typography',
				'label' => esc_html__('Label Typography', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-properties-top-bar-sort-controls label',
				'condition' => [
					'enable_frontend_sorting' => 'yes',
				],
			]
		);

		$this->add_control(
			'sorting_label_color',
			[
				'label' => esc_html__('Label Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-properties-top-bar-sort-controls label' => 'color: {{VALUE}}',
				],
				'condition' => [
					'enable_frontend_sorting' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sorting_dropdown_typography',
				'label' => esc_html__('Dropdown Typography', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .bootstrap-select.rh-ultra-select-light .dropdown-menu li a, {{WRAPPER}} .bootstrap-select > .dropdown-toggle',
				'condition' => [
					'enable_frontend_sorting' => 'yes',
				],
			]
		);

		$this->add_control(
			'sorting_dropdown_color',
			[
				'label' => esc_html__('Dropdown Items Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bootstrap-select .dropdown-menu li a, {{WRAPPER}} .bootstrap-select > .dropdown-toggle' => 'color: {{VALUE}}',
				],
				'condition' => [
					'enable_frontend_sorting' => 'yes',
				],
			]
		);

		$this->add_control(
			'sorting_dropdown_selected_item_color',
			[
				'label' => esc_html__('Dropdown Selected Item Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bootstrap-select .dropdown-menu li.selected .text' => 'color: {{VALUE}}',
				],
				'condition' => [
					'enable_frontend_sorting' => 'yes',
				],
			]
		);

		$this->add_control(
			'sorting_dropdown_items_hover_bg_color',
			[
				'label' => esc_html__('Dropdown Items Hover Background Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bootstrap-select .dropdown-menu li:hover' => 'background: {{VALUE}}',
				],
				'condition' => [
					'enable_frontend_sorting' => 'yes',
				],
			]
		);

		$this->add_control(
			'layout_buttons_heading',
			[
				'label' => esc_html__('Layout Buttons', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_layout_toggle_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'layout_button_color',
			[
				'label' => esc_html__('Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-view-type svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'enable_layout_toggle_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'layout_button_color_active',
			[
				'label' => esc_html__('Color (Active)', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-view-type .active svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'enable_layout_toggle_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'layout_button_size',
			[
				'label' => esc_html__('Size', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 18,
						'max' => 64,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-view-type svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'enable_layout_toggle_buttons' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'top_tags_color',
			[
				'label' => esc_html__('Top Tags Colors', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_property_status_background',
			[
				'label' => esc_html__('Status Tag Background', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea-ultra-status' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_status_background_hover',
			[
				'label' => esc_html__('Status Tag Background Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea-ultra-status:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_status_border_color',
			[
				'label' => esc_html__('Status Tag Border', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea-ultra-status' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_status_border_hover_color',
			[
				'label' => esc_html__('Status Tag Border Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea-ultra-status:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_status_text_color',
			[
				'label' => esc_html__('Status Tag Text', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea-ultra-status' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_status_text_hover_color',
			[
				'label' => esc_html__('Status Tag Text Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea-ultra-status:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_featured_background',
			[
				'label' => esc_html__('Featured Tag Background', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_featured' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_featured_background_hover',
			[
				'label' => esc_html__('Featured Tag Background Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_featured:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_featured_border',
			[
				'label' => esc_html__('Featured Tag Border', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_featured' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_featured_border_hover',
			[
				'label' => esc_html__('Featured Tag Border Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_featured:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_featured_color',
			[
				'label' => esc_html__('Featured Tag Text', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_featured' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_featured_color_hover',
			[
				'label' => esc_html__('Featured Tag Text Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_featured:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_label_background',
			[
				'label' => esc_html__('Label Tag Background', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_hot' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'rhea_property_label_background_hover',
			[
				'label' => esc_html__('Label Tag Background Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_hot:hover' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'rhea_property_label_border',
			[
				'label' => esc_html__('Label Tag Border', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_hot' => 'border-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'rhea_property_label_border_hover',
			[
				'label' => esc_html__('Label Tag Border Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_hot:hover' => 'border-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'rhea_property_label_color',
			[
				'label' => esc_html__('Label Tag Text', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_hot' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'rhea_property_label_color_hover',
			[
				'label' => esc_html__('Label Tag Text Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-status-box .rhea_ultra_hot:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'rhea_year_built_label_color',
			[
				'label' => esc_html__('Year Built Label', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-list-card-year-built' => 'color: {{VALUE}} !important',
				],
				'condition' => [
					'layout' => ['list'],
					'show_year_built' => 'yes'
				],
			]
		);

		$this->add_control(
			'rhea_property_media_background',
			[
				'label' => esc_html__('Media Count Background', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_media_count .rhea_media' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_media_background_hover',
			[
				'label' => esc_html__('Media Count Background Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_media_count .rhea_media:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_media_text',
			[
				'label' => esc_html__('Media Count Text', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_media_count .rhea_media span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea_ultra_media_count svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_property_media_text_hover',
			[
				'label' => esc_html__('Media Count Text Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_media_count .rhea_media:hover span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea_ultra_media_count .rhea_media:hover svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ultra_property_colors',
			[
				'label' => esc_html__('Colors', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'property_card_bg',
			[
				'label' => esc_html__('Property Card Background', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-two,
					 {{WRAPPER}} .rhea-ultra-property-card-three-content,
					 {{WRAPPER}} .rhea-ultra-property-card-four,
					 {{WRAPPER}} .rhea-ultra-property-card-five
					' => 'background: {{VALUE}}',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['2', '3', '4', '5'],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'list_card_box_shadow',
				'label' => esc_html__('List Card Box Shadow', 'realhomes-elementor-addon'),
				'selector' => '{{WRAPPER}} .rhea-ultra-property-list-card',
				'condition' => [
					'layout' => 'list',
				],
			]
		);

		$this->add_control(
			'rhea_favourite_compare_bg',
			[
				'label' => esc_html__('Favourite/Compare Button Background', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .favorite-btn-wrap a' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-bottom-box .favorite-btn-wrap span' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-bottom-box .rhea_compare_icons a' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-bottom-box .rhea_compare_icons span' => 'background: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_favourite_compare_icon_dark',
			[
				'label' => esc_html__('Favourite/Compare Button Icon Outline', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .favorite-btn-wrap a .rh-ultra-dark' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-bottom-box .rhea_compare_icons a .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_favourite_compare_icon_light',
			[
				'label' => esc_html__('Favourite/Compare Button Inner', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .favorite-btn-wrap a .rh-ultra-light' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-bottom-box .rhea_compare_icons a .rh-ultra-light' => 'fill: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_favourite_added_bg',
			[
				'label' => esc_html__('Favourite Added Background', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .favorite-btn-wrap span' => 'background: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_favourite_added_icon_dark',
			[
				'label' => esc_html__('Favourite Added Icon Outline', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .favorite-btn-wrap span .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_favourite_added_icon_light',
			[
				'label' => esc_html__('Favourite Added Icon Inner', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .favorite-btn-wrap span .rh-ultra-light' => 'fill: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_compare_added_bg',
			[
				'label' => esc_html__('Compare Added Background', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .rhea_compare_icons span' => 'background: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_compare_added_icon_dark',
			[
				'label' => esc_html__('Compare Added Icon Outline', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .rhea_compare_icons span .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_compare_added_icon_light',
			[
				'label' => esc_html__('Compare Added Icon Inner', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-bottom-box .rhea_compare_icons span .rh-ultra-light' => 'fill: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_title_color',
			[
				'label' => esc_html__('Property Title', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h3.rhea-ultra-property-title a,
					 {{WRAPPER}} .rhea-ultra-property-card-two-title a,
					 {{WRAPPER}} .rhea-ultra-property-card-three-title a,
					 {{WRAPPER}} .rhea-ultra-property-card-four-title a,
					 {{WRAPPER}} .rhea-ultra-property-card-five-title a
					 ' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_title_color_hover',
			[
				'label' => esc_html__('Property Title Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h3.rhea-ultra-property-title a:hover, 
					 {{WRAPPER}} .rhea-ultra-property-card-two-title a:hover,
					 {{WRAPPER}} .rhea-ultra-property-card-three-title a:hover,
					 {{WRAPPER}} .rhea-ultra-property-card-four-title a:hover,
					 {{WRAPPER}} .rhea-ultra-property-card-five-title a:hover
					' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'excerpt_text_color',
			[
				'label' => esc_html__('Grid Card Excerpt Text', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-three-content > p,
					 {{WRAPPER}} .rhea-ultra-property-card-five-content > p,
					 {{WRAPPER}} .rhea-ultra-property-card-four-content > p
					' => 'color: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'enable_layout_toggle_buttons',
							'value' => 'yes',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['3', '4', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'list_card_excerpt_text_color',
			[
				'label' => esc_html__('List Card Excerpt Text', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-list-card-excerpt' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_list_card_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'rhea_address_icon_color',
			[
				'label' => esc_html__('Address Icon', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_address_ultra .rhea_ultra_address_pin svg' => 'fill: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_address_icon_inner_color',
			[
				'label' => esc_html__('Address Icon Inner', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_address_ultra .rhea_ultra_address_pin svg .line-st1' => 'fill: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_address_icon_color_hover',
			[
				'label' => esc_html__('Address Icon Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_address_ultra a:hover .rhea_ultra_address_pin svg' => 'fill: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_address_icon_inner_color_hover',
			[
				'label' => esc_html__('Address Icon Inner Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_address_ultra a:hover .rhea_ultra_address_pin svg .line-st1' => 'fill: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_address_text_color',
			[
				'label' => esc_html__('Address Text', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_address_ultra a, 
					{{WRAPPER}} .rhea-ultra-property-card-two-address,
					{{WRAPPER}} .rhea-ultra-property-card-five-address
					' => 'color: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '2', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_address_text_color_hover',
			[
				'label' => esc_html__('Address Text Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_address_ultra a:hover' => 'color: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_status_text_color',
			[
				'label' => esc_html__('Type', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-card-detail-wrapper .rhea-ultra-property-types small' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-card-detail-wrapper .rhea-ultra-property-types small a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['1'],
				],
			]
		);

		$this->add_control(
			'price_wrapper_bg',
			[
				'label' => esc_html__('Price Wrapper Background', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-four-price' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'card' => ['4'],
					'layout' => ['carousel', 'grid'],
				],
			]
		);

		$this->add_control(
			'rhea_price_text_color',
			[
				'label' => esc_html__('Price', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} p.rh_prop_card__price_ultra .property-current-price,
					 {{WRAPPER}} .rhea-ultra-property-card-two-price,
					 {{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-display,
					 {{WRAPPER}} .rhea-ultra-property-card-two .ere-price-display,
					 {{WRAPPER}} .rhea-ultra-property-card-four-price .ere-price-display,
					 {{WRAPPER}} .rhea-ultra-property-card-four-price .ere-price-slash,
					 {{WRAPPER}} .rhea-ultra-property-card-five-price .ere-price-display
					 ' => 'color: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '2', '4', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_price_prefix_color',
			[
				'label' => esc_html__('Price Prefix (i.e From)', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-prefix' => 'color: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_price_postfix_color',
			[
				'label' => esc_html__('Price Postfix (i.e Monthly)', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-postfix,
					 {{WRAPPER}} p.rh_prop_card__price_ultra .ere-price-slash,
					 {{WRAPPER}} .rhea-ultra-property-card-four-price .ere-price-postfix,
					 {{WRAPPER}} .rhea-ultra-property-card-five-price .ere-price-postfix
					' => 'color: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'operator' => 'in',
									'value' => ['1', '4', '5'],
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_old_price_color',
			[
				'label' => esc_html__('Old Price', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} p.rh_prop_card__price_ultra .property-old-price' => 'color: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'value' => 'list',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => 'in',
									'value' => ['carousel', 'grid'],
								],
								[
									'name' => 'card',
									'value' => '1',
								],
							],
						]
					],
				],
			]
		);

		$this->add_control(
			'rhea_meta_icon_fa_color',
			[
				'label' => esc_html__('Meta Icons FontAwesome', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_meta_icon_fill_dark_color',
			[
				'label' => esc_html__('Meta Icons Fill Dark', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-dark' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_meta_icon_fill_light_color',
			[
				'label' => esc_html__('Meta Icons Fill Light', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-light' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_meta_icon_stroke_dark_color',
			[
				'label' => esc_html__('Meta Icons Stroke Dark', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-stroke-dark' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_meta_icon_stroke_light_color',
			[
				'label' => esc_html__('Meta Icons Stroke Light', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-stroke-light' => 'stroke: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'rhea_meta_figure_color',
			[
				'label' => esc_html__('Meta Figures', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_meta_box .figure' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_meta_figure_postfix_color',
			[
				'label' => esc_html__('Meta Figures postfix (i.e sqft)', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea_ultra_meta_box .label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => esc_html__('Button Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-two-link' => 'border-color: {{VALUE}}; color: {{VALUE}}',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => '2',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__('Button Hover Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-two-link:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => '2',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => esc_html__('Button Hover Background Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-two-link:hover' => 'border-color: {{VALUE}}; background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => '2',
				],
			]
		);

		$this->add_control(
			'solid_button_color',
			[
				'label' => esc_html__('Button Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-four-link,
					 {{WRAPPER}} .rhea-ultra-property-card-five-link
					' => 'color: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['4', '5'],
				],
			]
		);

		$this->add_control(
			'solid_button_hover_color',
			[
				'label' => esc_html__('Button Hover Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-four-link:hover,
					 {{WRAPPER}} .rhea-ultra-property-card-five-link:hover
					' => 'color: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['4', '5'],
				],
			]
		);

		$this->add_control(
			'solid_button_bg_color',
			[
				'label' => esc_html__('Button Background Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-four-link,
					{{WRAPPER}} .rhea-ultra-property-card-five-link
					' => 'border-color: {{VALUE}}; background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['4', '5'],
				],
			]
		);

		$this->add_control(
			'solid_button_hover_bg_color',
			[
				'label' => esc_html__('Button Hover Background Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-property-card-four-link:hover,
					 {{WRAPPER}} .rhea-ultra-property-card-five-link:hover
					' => 'border-color: {{VALUE}}; background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => ['carousel', 'grid'],
					'card' => ['4', '5'],
				],
			]
		);

		if ($this->is_rvr_enabled) {
			$this->add_control(
				'rhea_rating_stars_color',
				[
					'label' => esc_html__('Rating Stars Color', 'realhomes-elementor-addon'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .rvr_card_info_wrap .rh-ultra-rvr-rating .rating-stars i,
						{{WRAPPER}} .rhea-ultra-rvr-rating i,						
						{{WRAPPER}} .rhea-ultra-property-card-five .rating-stars i,
						{{WRAPPER}} .rhea-ultra-property-card-five .rvr_rating_down
						' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'rhea_rating_value_color',
				[
					'label' => esc_html__('Rating Value Color', 'realhomes-elementor-addon'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .rhea-ultra-rvr-rating-value, {{WRAPPER}} .rhea-ultra-property-card-five .rating-span' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'rhea_added_date_label_color',
				[
					'label' => esc_html__('Added Date Label Color', 'realhomes-elementor-addon'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .rvr_card_info_wrap .added-date .added-title' => 'color: {{VALUE}}',
					],
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name' => 'layout',
								'value' => 'list',
							],
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' => 'layout',
										'operator' => 'in',
										'value' => ['carousel', 'grid'],
									],
									[
										'name' => 'card',
										'value' => '1',
									],
								],
							]
						],
					],
				]
			);
			$this->add_control(
				'rhea_added_date_color',
				[
					'label' => esc_html__('Added Date Color', 'realhomes-elementor-addon'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .rvr_card_info_wrap .added-date' => 'color: {{VALUE}}',
					],
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name' => 'layout',
								'value' => 'list',
							],
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' => 'layout',
										'operator' => 'in',
										'value' => ['carousel', 'grid'],
									],
									[
										'name' => 'card',
										'value' => '1',
									],
								],
							]
						],
					],
				]
			);
		}

		$this->end_controls_section();

		$this->start_controls_section(
			'rhea_pagination',
			[
				'label' => esc_html__('Pagination', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => ['grid', 'list'],
					'show_pagination' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_margin',
			[
				'label' => esc_html__('Container Margin', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-properties-pagination .pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_padding',
			[
				'label' => esc_html__('Container Padding', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-properties-pagination .pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_items_padding',
			[
				'label' => esc_html__('Items Padding', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-properties-pagination .pagination a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_items_spacing',
			[
				'label' => esc_html__('Items Spacing', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-properties-pagination .pagination' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_items_border_radius',
			[
				'label' => esc_html__('Items Border Radius', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-properties-pagination .pagination a' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'pagination_items_text_color',
			[
				'label' => esc_html__('Text Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-properties-pagination .pagination a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pagination_items_text_hover_color',
			[
				'label' => esc_html__('Text Hover Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-properties-pagination .pagination a:hover, {{WRAPPER}} .rhea-ultra-properties-pagination .pagination a.current' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pagination_items_bg_color',
			[
				'label' => esc_html__('Background Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-properties-pagination .pagination a' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pagination_items_bg_hover_color',
			[
				'label' => esc_html__('Background Hover Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-properties-pagination .pagination a:hover, {{WRAPPER}} .rhea-ultra-properties-pagination .pagination a.current' => 'background: {{VALUE}}'
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pagination_items_box_shadow',
				'label' => esc_html__('Box Shadow', 'realhomes-elementor-addon'),
				'selector' => '{{WRAPPER}} .rhea-ultra-properties-pagination .pagination a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pagination_items_typography',
				'label' => esc_html__('Typography', 'realhomes-elementor-addon'),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-ultra-properties-pagination .pagination a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_nav_styles',
			[
				'label' => esc_html__('Slider Navigations', 'realhomes-elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_position',
			[
				'label' => esc_html__('CSS Position', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'static' => esc_html__('Default', 'realhomes-elementor-addon'),
					'absolute' => esc_html__('Absolute', 'realhomes-elementor-addon'),
				],
				'default' => 'static',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box' => 'position: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_position_from',
			[
				'label' => esc_html__('Position From', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'top : 0' => esc_html__('Top', 'realhomes-elementor-addon'),
					'bottom : 0' => esc_html__('Bottom', 'realhomes-elementor-addon'),
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-carousel-nav-center' => '{{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'nav-position',
			[
				'label' => esc_html__('Horizontal Position', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'flex-start' => esc_html__('Left', 'realhomes-elementor-addon'),
					'center' => esc_html__('Center', 'realhomes-elementor-addon'),
					'flex-end' => esc_html__('Right', 'realhomes-elementor-addon'),
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-carousel-nav-center' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'nav_icon_style',
			[
				'label' => esc_html__('Icon Style', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__('Default', 'realhomes-elementor-addon'),
					'arrow' => esc_html__('Arrow', 'realhomes-elementor-addon'),
				],
				'default' => 'default',
			]
		);

		$this->add_responsive_control(
			'slider_nav_margin',
			[
				'label' => esc_html__('Slider Nav Control Margin', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_column_gap',
			[
				'label' => esc_html__('Slider Nav Controls Gap', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_border_radius',
			[
				'label' => esc_html__('Slider Nav Border Radius', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_button_width',
			[
				'label' => esc_html__('Slider Nav Width', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'slider_nav_button_height',
			[
				'label' => esc_html__('Slider Nav Height', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'slider_control_nav_margin',
			[
				'label' => esc_html__('Slider nav controls margin', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_nav_color',
			[
				'label' => esc_html__('Directional Nav Background', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-prev' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-next' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_icon_color',
			[
				'label' => esc_html__('Directional Nav icon ', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-prev i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-next i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_svg_icon_color',
			[
				'label' => esc_html__('Directional Nav SVG icon ', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box button path' => 'stroke: {{VALUE}};fill: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'rhea_slider_directional_nav_hover_color',
			[
				'label' => esc_html__('Directional Nav Background Hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-prev:hover' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-next:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_icon_hover_color',
			[
				'label' => esc_html__('Directional Nav icon hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-prev:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-next:hover i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rhea_slider_directional_nav_icon_hover_color',
			[
				'label' => esc_html__('Directional Nav SVG icon hover', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box button:hover path' => 'stroke: {{VALUE}};fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_nav_disable_color',
			[
				'label' => esc_html__('Directional Nav Background Disabled', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-prev.disabled' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-next.disabled' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_directional_icon_disabled_color',
			[
				'label' => esc_html__('Directional Nav icon Disabled', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-prev.disabled i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .owl-next.disabled i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_control_nav_background',
			[
				'label' => esc_html__('Slider Control Nav Background Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_control_nav',
				'label' => esc_html__('Control Nav Box Shadow', 'realhomes-elementor-addon'),
				'selector' => '{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots',
			]
		);

		$this->add_control(
			'rhea_slider_control_nav',
			[
				'label' => esc_html__('Slider Control Nav Dots Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button:after' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rhea_slider_control_nav_active',
			[
				'label' => esc_html__('Slider Control Nav Active/hover Dots Color', 'realhomes-elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button.active' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button.active:after' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button:hover' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .rhea-ultra-nav-box .rhea-ultra-owl-dots button:hover:after' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		global $settings, $widget_id, $properties_query, $paged, $column_classes;

		$settings = $this->get_settings_for_display();
		$widget_id = $this->get_id();

		$paged = 1;
		if (get_query_var('paged')) {
			$paged = get_query_var('paged');
		} else if (get_query_var('page')) { // if is static front page
			$paged = get_query_var('page');
		}

		if ($settings['offset']) {
			$offset = $settings['offset'] + ($paged - 1) * $settings['posts_per_page'];
		} else {
			$offset = '';
		}

		$properties_args = array(
			'post_type' => 'property',
			'posts_per_page' => $settings['posts_per_page'],
			'order' => $settings['order'],
			'offset' => $offset,
			'post_status' => 'publish',
			'paged' => $paged,
		);

		if ($settings['skip_sticky_properties'] !== 'yes') {
			$properties_args['meta_key'] = 'REAL_HOMES_sticky';
		}

		// Sorting
		if ('price' === $settings['orderby']) {
			$properties_args['orderby'] = 'meta_value_num';
			$properties_args['meta_key'] = 'REAL_HOMES_property_price';
		} else {
			// for date, title, menu_order and rand
			$properties_args['orderby'] = $settings['orderby'];
		}

		// Filter based on custom taxonomies
		$property_taxonomies = get_object_taxonomies('property', 'objects');
		if (!empty($property_taxonomies) && !is_wp_error($property_taxonomies)) {
			foreach ($property_taxonomies as $single_tax) {
				$setting_key = $single_tax->name;
				if (!empty($settings[$setting_key])) {
					$properties_args['tax_query'][] = [
						'taxonomy' => $setting_key,
						'field' => 'slug',
						'terms' => $settings[$setting_key],
					];
				}
			}

			if (isset($properties_args['tax_query']) && count($properties_args['tax_query']) > 1) {
				$properties_args['tax_query']['relation'] = 'AND';
			}
		}

		$meta_query = array();
		if ('yes' === $settings['show_only_featured']) {
			$meta_query[] = array(
				'key' => 'REAL_HOMES_featured',
				'value' => 1,
				'compare' => '=',
				'type' => 'NUMERIC',
			);
		}

		$select_agent = $settings['select_agent'];
		if ('yes' === $settings['single_agent_agency_properties'] || !empty($select_agent)) {
			$agent_id = get_the_ID();
			if (!empty($select_agent)) {
				$agent_id = $select_agent;
			}
			$meta_query[] = array(
				'key' => 'REAL_HOMES_agents',
				'value' => $agent_id,
				'compare' => '=',
			);
		}

		$properties_args['meta_query'] = $meta_query;

		if ('yes' === $settings['enable_search']) {
			$properties_args = apply_filters('real_homes_search_parameters', $properties_args);
			$properties_args['posts_per_page'] = $settings['posts_per_page'];
		}

		$properties_args = $this->sort_properties($properties_args);
		$properties_args = apply_filters('rhea_modern_properties_widget', $properties_args);
		rhea_prepare_map_data($properties_args);

		if (is_tax()) {
			global $wp_query;
			$properties_args = array_merge($wp_query->query_vars, $properties_args);
		}

		$properties_query = new WP_Query($properties_args);

		if ($properties_query->have_posts()) {

			if ($settings['layout']) {
				$layout = $settings['layout'];
			} else {
				$layout = 'carousel';
			}

			if (in_array($layout, array('grid', 'list'))) {
				$column_classes = $this->get_columns($layout);
			}

			if (isset($_GET['rhea-properties-view']) && in_array($_GET['rhea-properties-view'], array('grid', 'list'))) {
				$layout = sanitize_text_field($_GET['rhea-properties-view']);

				if ('grid' === $layout) {
					$default_column = 3;

					if ($settings['grid_columns_in_toggle_view']) {
						$default_column = $settings['grid_columns_in_toggle_view'];
					}
				} else {
					$default_column = 1;
				}

				$column_classes = $this->get_columns($layout, $default_column);
			}

			rhea_get_template_part('elementor/widgets/properties-widget/' . esc_html($layout));
		} else if (function_exists('realhomes_print_no_result')) {
			realhomes_print_no_result();
		}

		if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
			?>
			<script>
				rheaSelectPicker('.inspiry_select_picker_trigger');
			</script>
			<?php
		}
	}

	/**
	 * Retrieve the CSS column classes based on the specified layout.
	 *
	 * @since 2.3.0
	 *
	 * @param string $layout         The layout identifier.
	 * @param string $default_column The column identifier.
	 *
	 * @return string The CSS classes for the grid or list columns.
	 */
	public function get_columns($layout, $default_column = '')
	{
		$settings = $this->get_settings_for_display();
		$setting_id = "{$layout}_columns";
		$class_prefix = sprintf('rhea-ultra-properties-%s', str_replace('_', '-', esc_html($setting_id)));
		$container_classes = array($class_prefix);

		// Define the devices list.
		$devices = array(
			"widescreen",
			"laptop",
			"tablet_extra",
			"tablet",
			"mobile_extra",
			"mobile"
		);

		if (!empty($settings[$setting_id])) {
			$default_column = $settings[$setting_id];
		}

		// Default column class.
		$container_classes[] = $class_prefix . '-' . esc_html($default_column);

		// Iterate through each device and add device-specific column class.
		foreach ($devices as $device) {
			$id = $setting_id . '_' . $device;
			if (!empty($settings[$id])) {
				$container_classes[] = $class_prefix . '-' . esc_html($device) . '-' . esc_html($settings[$id]);
			}
		}

		// Combine the container classes into a space-separated string and return
		return join(' ', $container_classes);
	}

	/**
	 * Modify the properties query based on sorting criteria.
	 *
	 * This function adjusts the properties query based on the 'sortby' parameter
	 * in the URL, enabling sorting by title, price, or date in ascending or
	 * descending order.
	 *
	 * @since 2.3.0
	 *
	 * @param array $properties_args The existing arguments for the properties query.
	 *
	 * @return array The modified properties query arguments.
	 */
	public function sort_properties($properties_args)
	{
		// Check if sorting criteria is provided in the URL.
		if (empty($_GET['sortby'])) {
			return $properties_args;
		}

		$sort_by = sanitize_text_field($_GET['sortby']);
		if ($sort_by == 'title-asc') {
			$properties_args['orderby'] = 'title';
			$properties_args['order'] = 'ASC';
		} else if ($sort_by == 'title-desc') {
			$properties_args['orderby'] = 'title';
			$properties_args['order'] = 'DESC';
		} else if ($sort_by == 'price-asc') {
			$properties_args['orderby'] = 'meta_value_num';
			$properties_args['meta_key'] = 'REAL_HOMES_property_price';
			$properties_args['order'] = 'ASC';
		} else if ($sort_by == 'price-desc') {
			$properties_args['orderby'] = 'meta_value_num';
			$properties_args['meta_key'] = 'REAL_HOMES_property_price';
			$properties_args['order'] = 'DESC';
		} else if ($sort_by == 'date-asc') {
			$properties_args['orderby'] = 'date';
			$properties_args['order'] = 'ASC';
		} else if ($sort_by == 'date-desc') {
			$properties_args['orderby'] = 'date';
			$properties_args['order'] = 'DESC';
		}

		return $properties_args;
	}
}