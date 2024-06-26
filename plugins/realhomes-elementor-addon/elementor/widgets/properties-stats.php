<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

class RHEA_Properties_Stats_Widget extends \Elementor\Widget_Base
{
  public function __construct(array $data = [], array $args = null)
  {
    parent::__construct($data, $args);

    // Add a hook for setting properties info
    // add_action('rhea_set_properties_info', [$this, 'set_properties_info']);

    // // Add a cron job for setting properties info - hourly job
    // // Replace it with system cron job...
    // if (!wp_next_scheduled('rhea_set_properties_info')) {
    //   wp_schedule_event(time(), 'hourly', 'rhea_set_properties_info');
    //   do_action('rhea_set_properties_info');
    // }
  }

  public function get_name()
  {
    return 'rhea_properties_stats';
  }

  public function get_title()
  {
    return esc_html__('Properties Stats', 'realhomes-elementor-addon');
  }

  public function get_icon()
  {
    return 'eicon-parallax';
  }

  public function get_categories()
  {
    return ['ultra-real-homes'];
  }

  public function get_keywords()
  {
    return ['properties', 'stats', 'real estate'];
  }

  protected function register_controls()
  {
  }

  protected function render()
  {
    // temp
    if (isset($_GET['test'])) {
      echo "stats";
      //   var_dump($this->get_deals());

      //   $properties_info = $this->get_properties_info();
      //   echo "
      //     <div>
      //       <div>
      //         <span><i class='eicon eicon-parallax'></i></span>
      //         <span>Avg. buying price</span>
      //         <span>" . $properties_info['avg_buying_price'] . "</span>
      //       </div>
      //       <div>
      //         <span><i class='eicon eicon-parallax'></i></span>
      //         <span>Avg. rent price</span>
      //         <span>" . $properties_info['avg_rent_price'] . "</span>
      //       </div>
      //       <div>
      //         <span><i class='eicon eicon-parallax'></i></span>
      //         <span>Properties for sale count</span>
      //         <span>" . $properties_info['properties_for_sale_count'] . "</span>
      //       </div>
      //     </div>
      //   ";
    }
  }
  protected function content_template()
  {
  }

  public function set_properties_info()
  {
    $properties = $this->get_all_published_properties();
    $avg_buying_price = $this->get_avg_price($properties['for-sale']);
    $avg_rent_price = $this->get_avg_price($properties['for-rent']);

    update_option('rhea_properties_info', [
      'avg_buying_price' => $avg_buying_price,
      'avg_rent_price' => $avg_rent_price,
      'properties_for_sale_count' => count($properties['for-sale']),
    ]);
  }

  /**
   * Get properties info: avg. buying price, avg. rent price, amount of properties for sale
   * @return array properties info
   */
  protected function get_properties_info()
  {
    $properties = get_option('rhea_properties_info');
    if ($properties) {
      return $properties;
    }

    return [
      'avg_buying_price' => 0,
      'avg_rent_price' => 0,
      'properties_for_sale_count' => 0,
    ];
  }


  private function get_all_published_properties()
  {
    $posts = [
      'for-sale' => [],
      'for-rent' => [],
    ];

    $search_args = array(
      'post_type' => 'property',
      'posts_per_page' => -1,
      'post_status' => 'publish'
    );

    // Get all published for sale properties
    $search_args['tax_query'] = [
      [
        'taxonomy' => 'property-status',
        'field' => 'slug',
        'terms' => ['למכירה'],
      ],
    ];
    $search_query = new WP_Query($search_args);
    if ($search_query->have_posts()) {
      while ($search_query->have_posts()) {
        $search_query->the_post();
        $post_id = get_the_ID();

        $posts['for-sale'][] = [
          'price' => get_post_meta($post_id, 'REAL_HOMES_property_price', true),
        ];
      }

      wp_reset_postdata();
    }

    // Get all published for rent properties
    $search_args['tax_query'] = [
      [
        'taxonomy' => 'property-status',
        'field' => 'slug',
        'terms' => ['להשכרה'],
      ],
    ];
    $search_query = new WP_Query($search_args);
    if ($search_query->have_posts()) {
      while ($search_query->have_posts()) {
        $search_query->the_post();
        $post_id = get_the_ID();

        $posts['for-rent'][] = [
          'price' => get_post_meta($post_id, 'REAL_HOMES_property_price', true),
        ];
      }

      wp_reset_postdata();
    }

    return $posts;
  }

  private function get_avg_price($properties)
  {
    $total_price = 0;
    $count = 0;

    foreach ($properties as $property) {
      $total_price += $property['price'];
      $count++;
    }

    return $count > 0 ? $total_price / $count : 0;
  }

  /**
   * Get deals from the government database
   */
  protected function get_deals()
  {
    // fetch("https://nadlan.taxes.gov.il/svinfonadlan2010/InfoNadlanPerutWithMap.aspx/GetPoints", {
    //   "headers": {
    //     "accept": "application/json, text/javascript, */*; q=0.01",
    //     "accept-language": "en-US,en;q=0.9",
    //     "content-type": "application/json;charset=utf-8",
    //     "sec-ch-ua": "\"Not/A)Brand\";v=\"8\", \"Chromium\";v=\"126\", \"Google Chrome\";v=\"126\"",
    //     "sec-ch-ua-mobile": "?0",
    //     "sec-ch-ua-platform": "\"Windows\"",
    //     "sec-fetch-dest": "empty",
    //     "sec-fetch-mode": "cors",
    //     "sec-fetch-site": "same-origin",
    //     "x-requested-with": "XMLHttpRequest"
    //   },
    //   "referrer": "https://nadlan.taxes.gov.il/svinfonadlan2010/InfoNadlanPerutWithMap.aspx?ProcessKey=cb2fc2f5-08db-4099-9d1e-8eb9f6bcda42",
    //   "referrerPolicy": "strict-origin-when-cross-origin",
    //   "body": null,
    //   "method": "POST",
    //   "mode": "cors",
    //   "credentials": "include"
    // });

    return [];
  }

  private function group_deals()
  {
  }
}
