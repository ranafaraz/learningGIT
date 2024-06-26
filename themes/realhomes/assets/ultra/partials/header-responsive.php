<?php
/**
 * Responsive Header
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */
?>
<div class="rh-responsive-header">
	<?php
	$theme_sitelogo_mobile        = get_option( 'theme_sitelogo_mobile' );
	$theme_sitelogo_retina_mobile = get_option( 'theme_sitelogo_retina_mobile' );
	if ( ! empty( $theme_sitelogo_mobile ) || ! empty( $theme_sitelogo_retina_mobile ) ) {
		get_template_part( 'assets/ultra/partials/header/site-logo-responsive' );
	} else {
		get_template_part( 'assets/ultra/partials/header/site-logo' );
	}
	?>
    <div class="rh-responsive-header-inner">
		<?php get_template_part( 'assets/ultra/partials/header/menu-list-responsive' ); ?>
		<?php get_template_part( 'assets/ultra/partials/header/user-phone' ); ?>
		<?php get_template_part( 'assets/ultra/partials/header/user-menu' ); ?>
		<?php get_template_part( 'assets/ultra/partials/header/submit-property' ); ?>
        <a class="rh-responsive-toggle" href="#"><span></span></a>
    </div>
</div><!-- /.rh-header -->