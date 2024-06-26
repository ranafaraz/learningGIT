<?php
/**
 * Schedule a tour for single property full width
 *
 * @since      4.0.0
 * @subpackage modern
 *
 * @package    realhomes
 */

if ( realhomes_display_schedule_a_tour() ) {
	?>
    <div class="sat-content-wrapper single-property-section">
        <div class="container">
			<?php get_template_part( 'assets/modern/partials/property/single/schedule-a-tour' ); ?>
        </div>
    </div>
	<?php
}