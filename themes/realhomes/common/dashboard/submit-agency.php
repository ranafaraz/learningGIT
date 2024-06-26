<?php
/**
 * Agency add/edit page.
 *
 * @since      4.3.0
 * @package    realhomes
 * @subpackage dashboard
 */

do_action( 'realhomes_before_submit_agency_page_render', get_the_ID() );
?>
<div id="dashboard-agency" class="dashboard-agency">
	<?php get_template_part( 'common/dashboard/submit-post-form', null, array( 'post_type' => 'agency' ) ); ?>
</div><!-- #dashboard-agency -->