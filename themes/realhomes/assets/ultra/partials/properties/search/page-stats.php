<?php
/**
 * Page Stats for Search templates
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

//global $paged, $search_query;

$found_properties = $args['listing_query']->found_posts;
$per_page = $args['listing_query']->query_vars['posts_per_page'];
$state_first = ( $per_page * $args['paged'] ) - $per_page + 1;
$state_last  = min( $found_properties, $per_page * $args['paged'] );
?>
<p class="rh_pagination__stats"
   data-page="<?php echo intval( $args['paged'] ); ?>"
   data-max="<?php echo intval( $args['listing_query']->max_num_pages ); ?>"
   data-total-properties="<?php echo intval( $found_properties ); ?>"
   data-page-id="<?php echo intval( get_the_ID() ); ?>">
	<?php
	if (
		$found_properties > 0
		&& ( $found_properties >= $per_page || -1 !== $per_page )
	) {
		?>
		<span><?php echo intval( $state_first ); ?></span>
		<?php esc_html_e( 'to', 'framework' ); ?>
		<span><?php echo intval( $state_last ); ?></span>
		<?php esc_html_e( 'out of ', 'framework' ); ?>
		<span><?php echo intval( $found_properties ); ?></span>
		<?php esc_html_e( 'properties', 'framework' ); ?>
		<?php
	}
	?>
</p><!-- /.rh_pagination__stats -->