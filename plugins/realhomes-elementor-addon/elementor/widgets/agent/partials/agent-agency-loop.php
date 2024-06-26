<?php
/**
 * Agent/Agency Post Loop
 *
 * Partial template for ultra-agent-agency-posts-card.php
 *
 * @since 2.3.0
 */
global $settings;


$agents_args = array(
	'post_type'      => ! empty( $settings['select-post-type'] ) ? $settings['select-post-type'] : 'agent',
	'posts_per_page' => 100,
);

$agents_query = new WP_Query( $agents_args );

if ( $agents_query->have_posts() ) {
	while ( $agents_query->have_posts() ) {
		$agents_query->the_post();

		rhea_get_template_part( 'elementor/widgets/agent/partials/agent-agency-card' );

	}
	wp_reset_postdata();
}

?>


