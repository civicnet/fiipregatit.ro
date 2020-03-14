<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use App\Config\Constants;

class FrontPage extends Controller {
  public static function guides($count = 8): array {
    return Ghiduri::get($count);
  }

  public static function campaigns(): array {
    $campaigns = get_posts(array(
      'post_type' => Constants::POST_TYPE_CAMPAIGN,
      'posts_per_page' => 3,
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
      'title' => get_field('name',  $campaign->ID),
      'permalink' => get_permalink($campaign->ID),
      'extras' => get_field('extras', $campaign->ID),
      'date' => $campaign->post_date,
    ];
  }
}
