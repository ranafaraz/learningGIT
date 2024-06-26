<?php
/**
 * Page Template
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

$page_layout  = get_post_meta( get_the_ID(), 'realhomes_page_layout', true );
$page_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'default-page-sidebar' );

if ( empty( $page_layout ) ) {
	$page_layout = 'default';
}

$container_class = 'container';
if ( 'fluid_width' === $page_layout ) {
	$container_class = 'container-fluid';
}
?>
    <div class="rh-page-container <?php echo esc_attr( $container_class ); ?>">
		<?php
		if ( in_array( $page_layout, array( 'fullwidth', 'fluid_width' ) ) || ! is_active_sidebar( $page_sidebar ) ) {
			?>
            <div class="main-content">
				<?php get_template_part( 'assets/ultra/partials/page/page-content' ); ?>
            </div><!-- .main-content -->
			<?php
		} else {
			$args = array( 'sidebar' => $page_sidebar );
			?>
            <div class="row">
				<?php
				if ( 'sidebar_left' === $page_layout ) {
					get_template_part( 'assets/ultra/partials/sidebar/sidebar', null, $args );
				}
				?>
                <div class="col-8 main-content">
					<?php get_template_part( 'assets/ultra/partials/page/page-content' ); ?>
                </div><!-- .main-content -->
				<?php
				if ( in_array( $page_layout, array( 'default', 'sidebar_right' ) ) ) {
					get_template_part( 'assets/ultra/partials/sidebar/sidebar', null, $args );
				}
				?>
            </div><!-- .row -->
			<?php
		}
		?>
    </div><!-- .rh-page-container -->
<?php
get_footer();