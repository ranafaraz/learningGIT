<?php

$property_entry_date = get_post_meta(get_the_ID(), 'REAL_HOMES_property_entry_date', true);
if (isset($property_entry_date) && !empty($property_entry_date)) {
  ?>
  <div class="rh_property__entry_date_wrap <?php realhomes_printable_section('entry_date'); ?>">
    <h4 class="rh_property__heading"><?php
    esc_html_e('תאריך כניסה', 'framework');
    ?>
    </h4>
    <div class="rh_content margin-bottom-40px">
      <?php
      echo $property_entry_date;
      ?>
    </div>
  </div>
  <?php
}

