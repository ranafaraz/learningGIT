<?php
/**
 * This file contains the grid layout of Ultra properties widget.
 *
 * @version 2.2.0
 */

global $settings, $widget_id, $properties_query, $column_classes, $is_grid_view;

$is_grid_view = ( isset( $_GET['rhea-properties-view'] ) && 'grid' === $_GET['rhea-properties-view'] );
if ( 'grid' === $settings['layout'] ) {
	$is_grid_view = false;
}

$card = '1';
if ( $settings['card'] ) {
	$card = $settings['card'];
}

if ( $is_grid_view && $settings['grid_card_in_toggle_view'] ) {
	$card = $settings['grid_card_in_toggle_view'];
}
?>
<div id="rhea-ultra-properties-<?php echo esc_attr( $widget_id ); ?>" class="rhea-ultra-properties-container">
    <?php rhea_get_template_part( 'elementor/widgets/properties-widget/top-bar' ); ?>
    <div class="rhea-ultra-properties-inner-container <?php echo esc_attr( $column_classes ); ?>">
		<?php
		while ( $properties_query->have_posts() ) {
			$properties_query->the_post();

			rhea_get_template_part( 'elementor/widgets/properties-widget/card-' . esc_html( $card ) );
		}

		wp_reset_postdata();
		?>
    </div>
    <div class="rhea-ultra-properties-pagination-wrapper">
		<?php
		if ( 'yes' == $settings['show_pagination'] ) {
			?>
            <div class="rhea_svg_loader">
				<?php include RHEA_ASSETS_DIR . '/icons/loading-bars.svg'; ?>
            </div>
			<?php
			$container_class = 'rhea-ultra-properties-pagination';
			if ( 'yes' === $settings['ajax_pagination'] ) {
				$container_class .= ' rhea-ultra-properties-ajax-pagination';
			}

			RHEA_ajax_pagination( $properties_query->max_num_pages, $properties_query, $container_class );
		}
		?>
    </div>
</div><!-- .rhea-properties-container -->