<?php
/**
 * Template for displaying Comments
 *
 * @package realhomes
 */
global $post;

$temp_post_id = '';
//temporary post id to display comments and comment form in Elementor editor
if ( class_exists( '\Elementor\Plugin' ) && ( \Elementor\Plugin::$instance->editor->is_edit_mode() ||
		( function_exists( 'rhea_is_preview_mode' ) && ( rhea_is_preview_mode() ) ) ) ) {
	$temp_post_id = apply_filters( 'rhea_comment_post_id_for_editor', $temp_post_id );
}
?>
<div id="comments">
	<?php
	if ( post_password_required() ) {
	?>
    <p class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'framework' ); ?></p>
</div>
<?php
return;
}

if ( have_comments() ) {
	?>
    <div class="rh_comments__header">
        <h3 id="comments-title">
			<?php
			if ( 'ultra' !== INSPIRY_DESIGN_VARIATION ) {
				?>
                <i class="fas fa-comments" aria-hidden="true"></i>
				<?php
			}
			comments_number( esc_html__( 'No Comment', 'framework' ), esc_html__( '1 Comment', 'framework' ), esc_html__( '% Comments', 'framework' ), $temp_post_id );
			?>
        </h3>
		<?php

		if ( realhomes_get_rating_status() ) {
			?>
            <div class="inspiry_rating_right">
				<?php inspiry_rating_average(); ?>
            </div>
			<?php
		}
		?>
    </div>

    <ol class="commentlist">
		<?php wp_list_comments( array( 'callback' => 'theme_comment', ) ); ?>
    </ol>

	<?php
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
		?>
        <nav class="pagination comments-pagination">
			<?php paginate_comments_links(); ?>
        </nav>
		<?php
	}
}

if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
	?><p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'framework' ); ?></p><?php
}

if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
	$commenter     = wp_get_current_commenter();
	$req           = get_option( 'require_name_email' );
	$aria_req      = ( $req ? " aria-required='true'" : '' );
	$required_text = '  ';

	$args = array(
		'id_form'           => 'commentform',
		'class_form'        => 'comment-form rh-ultra-form rh-property-comment-form',
		'class_submit'      => 'rh-ultra-filled-button rh-ultra-button submit-button',
		'id_submit'         => 'rh-ultra-button',
		'title_reply'       => esc_html__( 'Leave a Reply', 'framework' ),
		'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'framework' ),
		'cancel_reply_link' => esc_html__( 'Cancel Reply', 'framework' ),
		'label_submit'      => esc_html__( 'Post Comment', 'framework' ),

		'comment_notes_before' => '<p class="comment-notes">' .
			esc_html__( 'Your email address will not be published.  ', 'framework' ) . ( $req ? $required_text : '' ) .
			'</p>',


		'comment_field' => '<div class="rh-ultra-form-field"><label for="comment">' . esc_html__( 'Comment', 'framework' ) . '</label><p class="comment-form-comment rh-ultra-form-field-wrapper rh-ultra-form-textarea"><label for="comment">' . file_get_contents( get_theme_file_path( '/assets/ultra/icons/message.svg' ) ) . '</label>' .
			'<textarea  id="comment" required="required" class="form-control rh-ultra-field" ' . $aria_req . ' name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_html__( 'Your comment', 'framework' ) . '">' .
			'</textarea></p></div>',

		'fields' => apply_filters( 'comment_form_default_fields',
			array(
				'author' =>
					'<div class="rh-ultra-fields-split"><div class="rh-ultra-form-field"><label for="author">' . esc_html__( 'Name', 'framework' ) . '</label><p class="comment-form-author rh-ultra-form-field-wrapper"><label for="author">' . file_get_contents( get_theme_file_path( '/assets/ultra/icons/user.svg' ) ) . '</label>' .
					'<input id="author" required="required"  name="author" type="text" class="form-control rh-ultra-field" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . '  placeholder="' . esc_html__( 'Your name', 'framework' ) . '"/>
                </p></div>',

				'email' =>
					'<div class="rh-ultra-form-field"><label for="email">' . esc_html__( 'Email', 'framework' ) . '</label><p class="comment-form-email rh-ultra-form-field-wrapper"><label for="email">' . file_get_contents( get_theme_file_path( '/assets/ultra/icons/email.svg' ) ) . '</label>' .
					'<input id="email" required="required"  name="email" type="text" class="form-control rh-ultra-field"  value="' . esc_attr( $commenter['comment_author_email'] ) .
					'" size="30"' . $aria_req . ' placeholder="' . esc_html__( 'Your email', 'framework' ) . '" /></p></div></div>',

				'url' =>
					'<div class="rh-ultra-form-field"><label for="url">' . esc_html__( 'Website', 'framework' ) . '</label><p class="comment-form-url rh-ultra-form-field-wrapper"><label for="email">' . file_get_contents( get_theme_file_path( '/assets/ultra/icons/globe.svg' ) ) . '</label>' .
					'<input id="url" name="url" type="text" class="form-control rh-ultra-field"  value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" size="30" placeholder="' . esc_html__( 'Your website', 'framework' ) . '"/></p></div>'
			)
		),
	);

	comment_form( $args, $temp_post_id );
} else {
	comment_form();
}
?>
</div><!-- end of comments -->