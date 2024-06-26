<?php
/**
 * Compare Properties: Container.
 *
 * @since   3.0.0
 * @package realhomes/common
 */

$compare_page_id = get_option( 'inspiry_compare_page' );
if ( ! empty( $compare_page_id ) ) {
	$compare_page_url = get_permalink( $compare_page_id );
	?>
    <section class="rh_compare rh_compare__section">
        <h4 class="title"><?php echo get_option( 'inspiry_compare_view_title' ) ? esc_html( get_option( 'inspiry_compare_view_title' ) ) : esc_html__( 'Compare Properties', 'framework' ); ?></h4>
        <div class="rh_compare__carousel"></div>
        <a href="<?php echo esc_url( $compare_page_url ); ?>" class="rh_compare__submit rh_btn rh_btn--primary"><?php echo get_option( 'inspiry_compare_button_text' ) ? esc_html( get_option( 'inspiry_compare_button_text' ) ) : esc_html__( 'Compare', 'framework' ); ?></a>
    </section>
	<?php
}