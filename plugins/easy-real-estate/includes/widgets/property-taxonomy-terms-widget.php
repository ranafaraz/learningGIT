<?php
/**
 * Widget: Property Taxonomy Terms List Widget
 *
 * @since 2.0.5
 */

if ( ! class_exists( 'Property_Taxonomy_Terms_Widget' ) ) {

	/**
	 * Class: Property_Taxonomy_Terms_Widget.
	 *
	 * Display available property taxonomy terms
	 * in the form of a list.
	 *
	 * @since 2.0.5
	 */
	class Property_Taxonomy_Terms_Widget extends WP_Widget {

		/**
		 * Method: Constructor.
		 */
		function __construct() {
			$widget_ops = array(
				'classname'                   => 'Property_Taxonomy_Terms_Widget',
				'description'                 => esc_html__( 'This widget displays a list of terms for selected property taxonomy.', 'easy-real-estate' ),
				'customize_selective_refresh' => true,
			);
			parent::__construct( 'property_taxonomy_terms_widget', esc_html__( 'RealHomes - Property Taxonomy Terms', 'easy-real-estate' ), $widget_ops );
		}

		/**
		 * Method: Widget front-end display.
		 *
		 * @param array $instance - contains the parameters of the widget.
		 *
		 * @param array $args     - contains the argument of the widget.
		 */
		function widget( $args, $instance ) {

			extract( $args );

			// Title
			if ( isset( $instance['title'] ) ) {
				$title = apply_filters( 'widget_title', $instance['title'] );
			}
			if ( empty( $title ) ) {
				$title = esc_html__( 'Property Taxonomy Terms', 'easy-real-estate' );
			}

			$taxonomy    = $instance['taxonomy'] ?? 'property-type';
			$terms_count = $instance['terms_count'] ?? 'all';
			$orderby     = $instance['orderby'] ?? 'name';
			$order       = $instance['order'] ?? 'ASC';

			echo $before_widget;

			if ( $title ) :
				echo $before_title;
				echo $title;
				echo $after_title;
			endif;

			$this->property_taxonomy_terms( $taxonomy, $terms_count, $orderby, $order );

			echo $after_widget;

		}

		/**
		 * Method: Widget form.
		 *
		 * @param array $instance - contains the parameters of the widget.
		 *
		 * @return void
		 */
		function form( $instance ) {
			$instance    = wp_parse_args(
				(array)$instance, array(
					'title'       => esc_html__( 'Taxonomy Terms', 'easy-real-estate' ),
					'taxonomy'    => 'property-type',
					'terms_count' => 'all',
					'orderby'     => 'name',
					'order'       => 'ASC'
				)
			);
			$title       = esc_attr( $instance['title'] );
			$taxonomy    = esc_attr( $instance['taxonomy'] );
			$terms_count = esc_attr( $instance['terms_count'] );
			$orderby     = esc_attr( $instance['orderby'] );
			$order       = esc_attr( $instance['order'] );
			?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title', 'easy-real-estate' ); ?></label>
                <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" class="widefat" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'taxonomy' ) ); ?>"><?php esc_html_e( 'Select Property Taxonomy', 'easy-real-estate' ); ?></label>
                <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'taxonomy' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'taxonomy' ) ); ?>">
					<?php
					$taxonomy_options = [
						'property-type'    => esc_html__( 'Property Type', 'easy-real-estate' ),
						'property-status'  => esc_html__( 'Property Status', 'easy-real-estate' ),
						'property-city'    => esc_html__( 'Property Location', 'easy-real-estate' ),
						'property-feature' => esc_html__( 'Property Feature', 'easy-real-estate' ),
					];

					foreach ( $taxonomy_options as $tax_id => $tax_item ) {
						?>
                        <option value="<?php echo esc_attr( $tax_id ); ?>" <?php echo selected( $tax_id, $taxonomy ) ?>><?php echo esc_html( $tax_item ); ?></option>
						<?php
					}
					?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'terms_count' ) ); ?>"><?php esc_html_e( 'Number of terms to show', 'easy-real-estate' ); ?></label>
                <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'terms_count' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'terms_count' ) ); ?>">
                    <option value="all" <?php echo selected( 'all', $terms_count ) ?>><?php echo esc_html__( 'All', 'easy-real-estate' ); ?></option>
					<?php
					for ( $count = 3; $count <= 30; $count++ ) {
						?>
                        <option value="<?php echo esc_attr( $count ); ?>" <?php echo selected( $count, $terms_count ) ?>><?php echo esc_html( $count ); ?></option>
						<?php
					}
					?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Terms Order By', 'easy-real-estate' ); ?></label>
                <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
					<?php
					$orderby_options = [
						'name'       => esc_html__( 'Name' ),
						'slug'       => esc_html__( 'Slug' ),
						'term_group' => esc_html__( 'Term Group' ),
						'term_id'    => esc_html__( 'Term ID' ),
						'term_order' => esc_html__( 'Term Order' )
					];

					foreach ( $orderby_options as $id => $option ) {
						?>
                        <option value="<?php echo esc_attr( $id ); ?>" <?php echo selected( $id, $orderby ) ?>><?php echo esc_html( $option ); ?></option>
						<?php
					}
					?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order', 'easy-real-estate' ); ?></label>
                <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
                    <option value="ASC" <?php echo selected( 'ASC', $order ) ?>><?php esc_html_e( 'ASC', 'easy-real-estate' ); ?></option>
                    <option value="DESC" <?php echo selected( 'DESC', $order ) ?>><?php esc_html_e( 'DESC', 'easy-real-estate' ); ?></option>
                </select>
            </p>
			<?php
		}

		/**
		 * Method: Widget update.
		 *
		 * @param array $new_instance - contains the new instance of the widget.
		 * @param array $old_instance - contains the old instance of the widget.
		 *
		 * @return array
		 */
		function update( $new_instance, $old_instance ) {
			$instance                = $old_instance;
			$instance['title']       = strip_tags( $new_instance['title'] );
			$instance['taxonomy']    = $new_instance['taxonomy'];
			$instance['terms_count'] = $new_instance['terms_count'];
			$instance['orderby']     = $new_instance['orderby'];
			$instance['order']       = $new_instance['order'];

			return $instance;
		}

		/**
		 * Method: Get taxonomy terms
		 *
		 * @param string $taxonomy
		 * @param mixed  $count
		 * @param string $orderby
		 * @param string $order
		 */
		function property_taxonomy_terms( $taxonomy, $count = 'all', $orderby = 'name', $order = 'ASC' ) {

			if ( ! class_exists( 'ERE_Data' ) ) {
				return;
			}

			$this->generate_hierarchical_list(
				ERE_Data::get_hierarchical_property_terms( $taxonomy, false, $orderby, $order ),
				$taxonomy,
				false,
				$count
			);
		}

		/**
		 * Method: Show taxonomy terms in the form of list.
		 *
		 * @param array   $hierarchical_terms - Terms of property types.
		 * @param boolean $taxonomy_name      - Required taxonomy name to fetch terms list
		 * @param bool    $children           - True if top level.
		 * @param mixed   $count              - Provide if all or a number of terms should be listed
		 */
		function generate_hierarchical_list( $hierarchical_terms, $taxonomy_name, $children = false, $count = 'all' ) {
			if ( 0 < count( $hierarchical_terms ) ) {

				$list_class = $children ? 'children' : 'parent';
				echo '<ul class="' . esc_attr( $list_class ) . '">';
				$terms_count = 1;

				foreach ( $hierarchical_terms as $term ) {
					echo '<li><a href="' . get_term_link( $term['term_id'], $taxonomy_name ) . '">' . $term['name'] . '</a>';
					if ( ! empty( $term['children'] ) && $count > $terms_count ) {
						$count_child = 'all' === $count ? 'all' : $count - $terms_count;
						$this->generate_hierarchical_list( $term['children'], $taxonomy_name, true, $count_child );
						$terms_count += count( $term['children'] );
					}

					if ( $count !== 'all' ) {
						if ( $count > $terms_count ) {
							$terms_count++;
						} else {
							break;
						}
					}
					echo '</li>';
				}
				echo '</ul>';
			}
		}
	}
}


if ( ! function_exists( 'register_property_taxonomy_terms_widget' ) ) {
	/**
	 * Triggering registration function on widget initiation
	 *
	 * @since 2.0.5
	 */
	function register_property_taxonomy_terms_widget() {
		register_widget( 'Property_Taxonomy_Terms_Widget' );
	}

	add_action( 'widgets_init', 'register_property_taxonomy_terms_widget' );
}