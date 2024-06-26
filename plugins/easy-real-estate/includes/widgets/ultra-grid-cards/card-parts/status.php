<?php

$status_terms = get_the_terms(get_the_ID(), 'property-status');

if (!empty($status_terms)) {
	foreach ($status_terms as $term) {
?>
		<span class="rh-ultra-status"><?php echo esc_html($term->name) ?></span>
<?php
	}
}

?>