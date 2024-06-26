<?php
trait RHEASearchFormTrait {
	public function query_parameter_locations() {
		$parameter_locations = array();

		if ( function_exists( 'inspiry_get_location_select_names' ) ) {
			$location_names = inspiry_get_location_select_names();
			if ( 0 < count( $location_names ) ) {
				foreach ( $location_names as $location ) {
					if ( isset( $_GET[ $location ] ) ) {
						$parameter_locations[ $location ] = $_GET[ $location ];
					}
				}
			}
		}

		return $parameter_locations;
	}

	public function search_template_options() {
		if ( function_exists( 'inspiry_pages' ) ) {
			$search_pages_args = array(
				'meta_query' => array(
					'relation' => 'or',
					array(
						'key'   => '_wp_page_template',
						'value' => 'templates/properties-search.php',
					),
					array(
						'key'   => '_wp_page_template',
						'value' => 'templates/properties-search-half-map.php',
					),
					array(
						'key'   => '_wp_page_template',
						'value' => 'templates/properties-search-left-sidebar.php',
					),
					array(
						'key'   => '_wp_page_template',
						'value' => 'templates/properties-search-right-sidebar.php',
					),
				),
			);

			return inspiry_pages( $search_pages_args );
		}

		return '';
	}

	public function Basic_Common_Settings() {
		$this->start_controls_section(
			'rhea_search_basic_settings',
			[
				'label' => esc_html__( 'Basic Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'rhea_select_search_template',
			[
				'label'       => esc_html__( 'Select Search Template', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'If no search template is selected, "RealHomes > Customize Settings > Property Search > Properties Search Page" settings will be applied by default   ', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => $this->search_template_options(),
			]
		);

		$this->add_control(
			'rhea_top_field_count',
			[
				'label'       => esc_html__( 'Top Fields To Display', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'Select number of fields to display in top bar' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => '3',
				'options'     => array(
					'1' => esc_html__( 'One', 'realhomes-elementor-addon' ),
					'2' => esc_html__( 'Two', 'realhomes-elementor-addon' ),
					'3' => esc_html__( 'Three', 'realhomes-elementor-addon' ),
					'4' => esc_html__( 'Four', 'realhomes-elementor-addon' ),
					'5' => esc_html__( 'Five', 'realhomes-elementor-addon' ),
					'6' => esc_html__( 'Six', 'realhomes-elementor-addon' ),
				),
			]
		);

		$this->add_control(
			'rhea_default_advance_state',
			[
				'label'   => esc_html__( 'Advance Fields Default State', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'collapsed',
				'options' => array(
					'collapsed' => esc_html__( 'Collapsed', 'realhomes-elementor-addon' ),
					'open'      => esc_html__( 'Open', 'realhomes-elementor-addon' ),
				),
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label'        => esc_html__( 'Show Labels', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'show_advance_fields',
			[
				'label'        => esc_html__( 'Show Advance Fields Button', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'search_button_label',
			[
				'label'   => esc_html__( 'Search Button', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Search', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'rhea_search_button_position',
			[
				'label'        => esc_html__( 'Search Button AT Bottom? ', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'rhea_button_animate',
			[
				'label'        => esc_html__( 'Animate Search Buttons? ', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'rhea_advance_button_animate',
			[
				'label'        => esc_html__( 'Animate Advance Search Buttons? ', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'show_advance_fields' => 'yes',
				],
			]
		);


		$this->add_control(
			'show_advance_features',
			[
				'label'        => esc_html__( 'Show More Features ', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'advance_features_text',
			[
				'label'   => esc_html__( 'Advance Features Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Looking for certain features', 'realhomes-elementor-addon' ),
			]
		);
		$this->end_controls_section();
	}
}

trait RHEASearchFormSettings {
	public function SF_fields_icons( $show_icon_key, $icon_key ) {
		$this->add_control(
			$show_icon_key,
			[
				'label'        => esc_html__( 'Show Icon', 'realhomes-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'realhomes-elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'realhomes-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			$icon_key,
			[
				'label'     => esc_html__( 'Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => [
					$show_icon_key => 'yes',
				],
			]
		);
	}
}

/**
 * Trait RHEASortingControlTrait
 *
 * Trait for sorting search form fields for modern.
 *
 * @since 2.3.0
 */
trait RHEASortingControlTrait {
	/**
	 * Enqueue control scripts and styles.
	 *
	 * Enqueue stylesheets and scripts necessary for the control.
	 *
	 * @since 2.3.0
	 */
	public function enqueue() {
		wp_enqueue_style( 'rhea-search-sorting-control', RHEA_PLUGIN_URL . 'elementor/css/search-sorting-control.css', array(), RHEA_VERSION, 'all' );
		wp_enqueue_script( 'rhea-sortable', RHEA_PLUGIN_URL . 'elementor/js/rhea-sortable.js', array( 'jquery' ), RHEA_VERSION );
	}

	/**
	 * Render content template.
	 *
	 * Render the content template for the control.
	 *
	 * @since 2.3.0
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="rhea_sorting_control_wrapper">
			<ul class="rhea-sorting-list-<?php echo esc_attr( $control_uid ); ?>">
				<#
				function arrayFlip( fields ) {
                    let ret = {};

                    for ( let key in fields ) {
                        ret[fields[key]] = key;
                    }

                    return ret;
				}

				let searchFields  = data.search_fields,
				currentFields = data.controlValue;

				if( _.isString(currentFields) && ! _.isEmpty(currentFields) ){
                    currentFields = currentFields.split( ',' );
                    searchFields = _.extend( arrayFlip( currentFields ), searchFields );
				}

				_.each( searchFields, function( field_label, field_value ) {
                    let attribute = '';

                    if ( -1 !== currentFields.indexOf( field_value ) ) {
                        attribute = 'checked=checked';
                    }
				#>
				<li><label for="<?php echo esc_attr( $control_uid ); ?>-{{ field_value }}"><input id="<?php echo esc_attr( $control_uid ); ?>-{{ field_value }}" type="checkbox" value="{{ field_value }}" {{ attribute }}>{{{ field_label }}}</label></li>
				<# } ); #>
			</ul>
			<input type="hidden" id="rhea-sorting-<?php echo esc_attr( $control_uid ); ?>" data-setting="{{ data.name }}">
		</div>
		<?php
	}
}
