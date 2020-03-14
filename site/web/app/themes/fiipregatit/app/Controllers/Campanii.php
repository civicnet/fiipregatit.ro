<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use App\Config\Constants;

class Campanii extends Controller {
  public static function get($count = 3): array {
    $campaigns = get_posts(array(
      'post_type' => Constants::POST_TYPE_CAMPAIGN,
      'posts_per_page' => $count,
    ));

    $ret = array();
    foreach ($campaigns as $campaign) {
      $ret[] = self::campaignData($campaign);
    }

    return $ret;
  }

  public static function campaignData(\WP_Post $campaign): array {
    return [
      'image' => get_field('image',  $campaign->ID),
      // TODO: Replace with `post_title`, no need for custom field
      'title' => $campaign->post_title,
      'permalink' => get_permalink($campaign->ID),
      'extras' => get_field('extras', $campaign->ID),
      'date' => $campaign->post_date,
    ];
  }
}
