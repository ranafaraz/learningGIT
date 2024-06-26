<?php
/**
 * Agency sidebar.
 *
 * @since 3.5.0
 * @package    realhomes
 * @subpackage classic
 */

$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'agency-sidebar' );
if ( is_active_sidebar( $attached_sidebar ) ) : ?>
    <div class="span3 sidebar-wrap">
        <aside class="sidebar">
			<?php dynamic_sidebar( $attached_sidebar ); ?>
        </aside>
    </div>
<?php endif; ?>