<?php
/**
 * Attachments of a property.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

$display_display_attachments = get_option( 'theme_display_attachments' );
if ( 'true' === $display_display_attachments ) {
	global $post;
	$attachments = inspiry_get_property_attachments();
	if ( ! empty( $attachments ) ) {
		?>
        <div class="rh_property__attachments_wrap margin-bottom-40px">
			<?php
			$property_attachments_title = get_option( 'theme_property_attachments_title' );
			if ( ! empty( $property_attachments_title ) ) {
				?><h4 class="rh_property__heading"><?php echo esc_html( $property_attachments_title ); ?></h4><?php
			}
			echo '<ul class="rh_property__attachments">';
			foreach ( $attachments as $attachment_id ) {
				$file_path = wp_get_attachment_url( $attachment_id );
				if ( $file_path ) {
					$file_type = wp_check_filetype( $file_path );
					?>
                    <li class="<?php echo esc_attr( $file_type['ext'] ) ?>">
                        <a target="_blank" href="<?php echo esc_attr( $file_path ) ?>">
							<?php echo get_icon_for_extension( $file_type['ext'] ) ?>
                            <span class="rh-attachment-text">
                                <?php echo get_the_title( $attachment_id ) ?><br>
                                <span>
                                     <?php echo inspiry_filesize_formatted( get_attached_file( $attachment_id ) ) ?>
                                </span>
                            </span>
                            <span class="rh-attachment-download-icon">
                                <?php
                                inspiry_safe_include_svg( 'download.svg', '/assets/ultra/icons/' );
                                ?>
                            </span>
                        </a>
                    </li>
					<?php

				}
			}
			echo '</ul>';
			?>
        </div>
		<?php
	}
}
