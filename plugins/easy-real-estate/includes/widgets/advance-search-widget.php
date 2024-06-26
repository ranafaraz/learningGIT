<?php
/**
 * Widget: Advance Property Search
 */

if ( ! class_exists( 'Advance_Search_Widget' ) ) {

	class Advance_Search_Widget extends WP_Widget {

		public function __construct() {
			$widget_ops = array(
				'classname'   => 'Advance_Search_Widget',
				'description' => esc_html__( 'This widget displays advance search form.', 'easy-real-estate' ),
			);
			parent::__construct( 'advance_search_widget', esc_html__( 'RealHomes - Advance Search Widget', 'easy-real-estate' ), $widget_ops );

			add_filter( 'rh_sidebar_widget_id', [ $this, 'rh_widget_id' ] );
		}

		function rh_widget_id() {

			if ( $this->number && is_numeric( $this->number ) ) {
				return $this->number;
			}

			return '';

		}

		function widget( $args, $instance ) {
			extract( $args );

			$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Find Your Home', 'easy-real-estate' );

			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

			// Find and insert 'advance-search' in $before_widget.
			$start_position = strpos( $before_widget, 'clearfix' );
			$before_widget  = substr_replace( $before_widget, 'advance-search ', $start_position, 0 );

			echo $before_widget;

			if ( $title ) :
				echo '<h4 class="title search-heading">' . $title . '<i class="fas fa-search"></i></h4>';
			endif;

			if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {

				if ( class_exists( 'RHEA_Elementor_Search_Form' ) && isset( $instance['elementor_search_form'] ) ) {

					?>
                    <div class="ere-custom-search-form-wrapper rhea-hide-before-load">
						<?php
						do_action( 'realhomes_elementor_search_form', $instance['elementor_search_form'] );
						?>
                    </div>
					<?php
				}
			} else {
				if ( ere_is_search_page_configured() && ( 'classic' === INSPIRY_DESIGN_VARIATION ) ) :
					get_template_part( 'assets/classic/partials/properties/search/form' );
                elseif ( ere_is_search_page_configured() && ( 'modern' === INSPIRY_DESIGN_VARIATION ) ) :
					get_template_part( 'assets/modern/partials/properties/search/widget-form' );
				else :
					echo '<p class="alert alert-error">' . esc_html__( 'Advance search page is not configured yet. Please read this theme documentation for the Advance Search page & form configuration details.', 'easy-real-estate' ) . '</p>';
				endif;
			}

			echo $after_widget;
		}


		function form( $instance ) {
			$instance = wp_parse_args(
				(array)$instance, array(
					'title' => esc_html__( 'Find Your Home', 'easy-real-estate' ),
				)
			);
			$title    = esc_attr( $instance['title'] );


			?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title', 'easy-real-estate' ); ?></label>
                <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" class="widefat" />
            </p>
			<?php
			if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {

				$search_form = isset( $instance['elementor_search_form'] ) ? $instance['elementor_search_form'] : '';
				$args        = array(
					'post_type'      => 'elementor_library',
					'posts_per_page' => 150,
					'post_status'    => array( 'publish' )
				);
				$query       = new WP_Query( $args );
				?>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'elementor_search_form' ) ); ?>"><?php esc_html_e( 'Select Elementor Search Form', 'easy-real-estate' ); ?></label>
                    <select name="<?php echo esc_attr( $this->get_field_name( 'elementor_search_form' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'elementor_search_form' ) ); ?>" class="widefat">
                        <option value=""><?php esc_html_e( 'None','easy-real-estate' ); ?></option>
						<?php
						if ( $query->have_posts() ) {

							while ( $query->have_posts() ) {
								$query->the_post();
								?>
                                <option value="<?php echo esc_attr( get_the_ID() ); ?>"<?php selected( $search_form, get_the_ID() ); ?>><?php echo esc_html( get_the_title() ); ?></option>

								<?php
							}
							wp_reset_postdata();
						}

						?>

                    </select>
                </p>
				<?php
			}
		}

		function update( $new_instance, $old_instance ) {
			$instance                          = $old_instance;
			$instance['title']                 = strip_tags( $new_instance['title'] );
			$instance['elementor_search_form'] = isset( $new_instance['elementor_search_form'] ) ? $new_instance['elementor_search_form'] : '';

			return $instance;
		}

	}
}

if ( ! function_exists( 'register_advance_search_widget' ) ) {
	function register_advance_search_widget() {
		register_widget( 'Advance_Search_Widget' );
	}

	add_action( 'widgets_init', 'register_advance_search_widget' );
}
