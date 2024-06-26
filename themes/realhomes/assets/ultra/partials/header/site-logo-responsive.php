<?php
$theme_sitelogo_mobile        = get_option( 'theme_sitelogo_mobile' );
$theme_sitelogo_retina_mobile = get_option( 'theme_sitelogo_retina_mobile' );
if ( ! empty( $theme_sitelogo_mobile ) || ! empty( $theme_sitelogo_retina_mobile ) ) {
	?>
    <div class="rh-logo-wrapper">
        <a title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url() ); ?>">
			<?php inspiry_logo_img( $theme_sitelogo_mobile, $theme_sitelogo_retina_mobile ); ?>
        </a>
    </div>
	<?php
} else {
	?>
    <h2 class="rh-logo-heading">
        <a href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo( 'name' ); ?>">
			<?php bloginfo( 'name' ); ?>
        </a>
    </h2>
	<?php
}
?>
<p class="rh-site-description only-for-print">
	<?php bloginfo( 'description' ); ?>
</p><!-- /.only-for-print -->
