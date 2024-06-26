<?php

$status_terms = get_the_terms(get_the_ID(), 'property-status');

if (!empty($status_terms)) {
	foreach ($status_terms as $term) {

?>
		<a href="<?php echo get_term_link($term->term_id)?>" class="rhea-ultra-status"><?php echo esc_html($term->name) ?></a>
<?php
	}
}

?>