<div class="entry-meta">
    <div class="entry-date">
	    <?php inspiry_safe_include_svg( '/ultra/icons/calendar.svg', '/assets/' ); ?>
        <time class="entry-date published" datetime="<?php the_time( 'c' ); ?>"><?php the_time( get_option('date_format', 'M d, Y' ) ); ?></time>
    </div>
    <div class="entry-categories">
	<?php the_category( ', ' ); ?>
    </div>
</div>