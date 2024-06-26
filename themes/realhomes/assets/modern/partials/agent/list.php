<?php
/**
 * Agents List
 *
 * @since      3.0.0
 * @package    realhomes
 * @subpackage modern
 */

// Page Head.
$header_variation = get_option( 'inspiry_agents_header_variation' );

// Agent Search
$realhomes_agent_search       = get_option( 'realhomes_agent_search', 'no' );
$realhomes_agent_search_class = '';
if ( 'yes' === $realhomes_agent_search ) {
	$realhomes_agent_search_class = 'realhomes_agent_search';
}
?>
<section class="rh_section rh_section--flex rh_wrap--padding rh_wrap--topPadding">
	<?php
	// Display any contents after the page banner and before the contents.
	do_action( 'inspiry_before_page_contents' );
	?>
    <div class="rh_page rh_page__agents rh_page__main">
		<?php if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) : ?>
            <div class="rh_page__head rh_page--agents_listing">
                <h2 class="rh_page__title">
					<?php
					// Page Title.
					$page_title = get_post_meta( get_the_ID(), 'REAL_HOMES_banner_title', true );
					if ( empty( $page_title ) ) {
						$page_title = get_the_title( get_the_ID() );
					}
					inspiry_get_exploded_heading( $page_title );
					?>
                </h2><!-- /.rh_page__title -->
            </div><!-- /.rh_page__head -->
		<?php
		endif;

		$get_content_position = get_post_meta( get_the_ID(), 'REAL_HOMES_content_area_above_footer', true );
		if ( $get_content_position !== '1' ) {
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					if ( get_the_content() ) : ?>
                        <div class="rh_content rh_page__content"><?php the_content(); ?></div>
					<?php
					endif;
				}
			}
		}

		if ( 'yes' === $realhomes_agent_search || 'show' === get_option( 'inspiry_agents_sorting', 'hide' ) ) { ?>
            <div class="rh_page__head rh_page__head-agents-list-template">
                <div class="rh_agent__search_form">
					<?php get_template_part( 'assets/modern/partials/agent/search/agent-form' ); ?>
                </div>
            </div>
		<?php } ?>

		<?php
		$paged = 1;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		}

		$number_of_posts = intval( get_option( 'theme_number_posts_agent' ) );
		if ( ! $number_of_posts ) {
			$number_of_posts = 3;
		}

		$agents_query = array(
			'post_type'      => 'agent',
			'posts_per_page' => $number_of_posts,
			'paged'          => $paged,
		);

		// Apply Search Filter
		$agents_query = apply_filters( 'realhomes_agents_search_filter', $agents_query );

		// Apply Sorting Filter
		$agents_query = inspiry_agents_sort_args( $agents_query );

		$agent_listing_query = new WP_Query( $agents_query );
		?>
        <div id="listing-container" class="rh_page__listing <?php echo sanitize_html_class( $realhomes_agent_search_class ); ?>" data-max="<?php echo esc_attr( $agent_listing_query->max_num_pages ); ?>" data-page="<?php echo $paged; ?>">
			<?php
			if ( $agent_listing_query->have_posts() ) :
				while ( $agent_listing_query->have_posts() ) :
					$agent_listing_query->the_post();
					get_template_part( 'assets/modern/partials/agent/card' );
				endwhile;
				wp_reset_postdata(); 
			else :
				?>
                <div class="rh_agent_card__wrap no-results">
                    <p><strong><?php esc_html_e( 'No Results Found!', 'framework' ); ?></strong></p>
                </div>
			<?php
			endif;
			?>
        </div><!-- /.rh_page__listing -->
		<?php
		if ( 'yes' === $realhomes_agent_search ) {
			realhomes_ajax_pagination( $agent_listing_query->max_num_pages, $agent_listing_query );
		} else {
			inspiry_theme_pagination( $agent_listing_query->max_num_pages );
		}
		?>
    </div><!-- /.rh_page rh_page__main -->

	<?php
	$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'agent-sidebar' );
    if ( is_active_sidebar( $attached_sidebar ) ) : ?>
        <div class="rh_page rh_page__sidebar">
	        <?php get_sidebar( 'agent' ); ?>
        </div><!-- /.rh_page rh_page__sidebar -->
	<?php endif; ?>

</section>

<?php
if ( '1' === $get_content_position ) {
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
            <div class="rh_content <?php if ( get_the_content() ) {
				echo esc_attr( 'rh_page__content' );
			} ?>">
				<?php the_content(); ?>
            </div><!-- /.rh_content -->
			<?php
		}
	}
}
?>
<!-- /.rh_section rh_wrap rh_wrap--padding -->