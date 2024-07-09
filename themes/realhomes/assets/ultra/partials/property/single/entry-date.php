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
      // Get the date components
      $day = date('j', strtotime($property_entry_date));  // Day without leading zeros
      $month = date('F', strtotime($property_entry_date));  // Full month name
      $year = date('Y', strtotime($property_entry_date));  // Full year
    
      // Format the date
      $formatted_date = $day . ' ב' . dirabe_get_hebrew_month($month) . ' ' . $year;
      echo $formatted_date;
      ?>
    </div>
  </div>
  <?php
}

