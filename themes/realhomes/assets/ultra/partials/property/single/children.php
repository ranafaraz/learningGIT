<?php
/**
 * Child properties of the single property.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

global $post;

$property_children_args = array(
	'post_type'      => 'property',
	'posts_per_page' => 100,
	'post_parent'    => get_the_ID(),
);

$child_properties_query = new WP_Query( apply_filters( 'realhomes_children_properties', $property_children_args ) );

if ( $child_properties_query->have_posts() ) : ?>
    <div class="rh_property__child_properties">
		<?php
		$child_properties_title = get_option( 'theme_child_properties_title' );
		if ( ! empty( $child_properties_title ) ) : ?>
            <h4 class="rh_property__heading"><?php echo esc_html( $child_properties_title ); ?></h4>
		<?php endif; ?>
        <div class="rh-property-children ">
			<?php while ( $child_properties_query->have_posts() ) : ?><?php $child_properties_query->the_post(); ?><?php get_template_part( 'assets/ultra/partials/properties/list-card-1' ); ?><?php endwhile; ?>
        </div><!-- /.rh_section__properties -->
		<?php wp_reset_postdata(); ?>
    </div>
<?php endif; ?>
