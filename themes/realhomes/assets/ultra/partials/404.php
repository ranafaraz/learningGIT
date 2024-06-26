<?php
/**
 * 404 Page
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
	?>
    <div class="rh-page-container container">
        <div class="main-content">
			<?php
			// Display any contents after the page head and before the contents.
			do_action( 'inspiry_before_page_contents' );
			?>
            <main id="main" class="rh-main main">
                <article class="rh-page-404">
                    <div class="error-404-page">
                        <?php
                        $main_404_image = ! empty( get_option('realhomes_404_main_image') ) ? get_option('realhomes_404_main_image') : INSPIRY_COMMON_URI . 'images/404-image.png';
                        $main_404_title = ! empty( get_option('realhomes_404_main_title') ) ? get_option('realhomes_404_main_title') : esc_html__( 'It looks like you are lost!', 'framework' );
                        $main_404_sub_title = ! empty( get_option('realhomes_404_sub_title') ) ? get_option('realhomes_404_sub_title') : esc_html__( 'Perhaps the above header navigation can help.', 'framework' );
                        ?>
                        <img class="main-404-image" src="<?php echo esc_url( $main_404_image ); ?>" alt="404">
                        <h2 class="title "><?php echo esc_html( $main_404_title ); ?></h2>
                        <h4 class="no-results-sub-title"><?php echo esc_html( $main_404_sub_title ); ?></h4>
                    </div>
	                <?php
	                if ( is_active_sidebar( '404-sidebar' ) ) {
		                ?>
                        <div class="widgets-404">
			                <?php dynamic_sidebar( '404-sidebar' ); ?>
                        </div>
		                <?php
	                }
	                ?>
                </article>
            </main>
        </div>
    </div><!-- .rh-page-container -->
	<?php
}

get_footer();