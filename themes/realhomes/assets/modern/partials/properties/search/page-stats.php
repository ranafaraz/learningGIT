<?php
/**
 * Page Stats for Search templates
 *
 * @package    realhomes
 * @subpackage modern
 * @since 3.20.0
 */

global $paged, $search_query;

$found_properties = $search_query->found_posts;
$per_page = $search_query->query_vars['posts_per_page'];
$state_first = ( $per_page * $paged ) - $per_page + 1;
$state_last  = min( $found_properties, $per_page * $paged );
?>
<p class="rh_pagination__stats" data-page="<?php echo intval( $paged ); ?>" data-max="<?php echo intval( $search_query->max_num_pages ); ?>" data-total-properties="<?php echo intval( $found_properties ); ?>" data-page-id="<?php echo intval( get_the_ID() ); ?>">
	<?php
	if (
		$found_properties > 0
		&& ( $found_properties >= $per_page || -1 !== $per_page )
	) {
		?>
		<span class="highlight_stats"><?php echo intval( $state_first ); ?></span>
		<span><?php esc_html_e( ' to ', 'framework' ); ?></span>
		<span class="highlight_stats"><?php echo intval( $state_last ); ?></span>
		<span><?php esc_html_e( ' out of ', 'framework' ); ?></span>
		<span class="highlight_stats"><?php echo intval( $found_properties ); ?></span>
        <span><?php esc_html_e( ' properties', 'framework' ); ?></span>
		<?php
	}
	?>
</p><!-- /.rh_pagination__stats -->