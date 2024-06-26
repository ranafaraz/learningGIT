<?php
/**
 * Image post format.
 */

if ( has_post_thumbnail() ) { ?>
	<figure>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php
			global $news_grid_size;
			the_post_thumbnail( $news_grid_size );
			?>
		</a>
	</figure>
	<?php } else { ?>
	<figure>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php
			global $news_grid_size; ?>
			<img src="<?php echo inspiry_get_raw_placeholder_url( $news_grid_size ); ?>" alt="<?php the_title(); ?>" loading="lazy" width="488" height="326">
		</a>
	</figure>
<?php }