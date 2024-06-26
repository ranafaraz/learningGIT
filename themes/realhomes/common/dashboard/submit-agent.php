<?php
/**
 * Agent add/edit page.
 *
 * @since      4.3.0
 * @package    realhomes
 * @subpackage dashboard
 */

do_action( 'realhomes_before_submit_agent_page_render', get_the_ID() );
?>
<div id="dashboard-agent" class="dashboard-agent">
	<?php get_template_part( 'common/dashboard/submit-post-form', null, array( 'post_type' => 'agent' ) ); ?>
</div><!-- #dashboard-agent -->