<?php
$author_id = get_the_author_meta( 'ID' );
?>
    <div class="post-author <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?>">
		<?php echo get_avatar( $author_id, 150 ); ?>
        <div class="post-author-title">
			<?php printf( '<span>%1$s</span> <a class="author-link" href="%2$s" rel="author">%3$s</a>', esc_html__( 'By', 'framework' ), esc_url( get_author_posts_url( $author_id ) ), esc_html( get_the_author() ) ); ?>
        </div>
    </div>
<?php
