<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use App\Config\Constants;

class FrontPage extends Controller {
  public static function guides(): array {
    $guides = get_posts(array(
      'post_type' => Constants::POST_TYPE_GUIDE,
      'posts_per_page' => 100,
    ));

    $ret = array();
    foreach ($guides as $guide) {
      $ret[] = self::guideData($guide);
    }

    return $ret;
  }

  public static function guideData(\WP_Post $guide): array {
    $icon = get_field('icon', $guide->ID);
    return [
      'icon' => $icon,
      // TODO: Replace with `post_title`, no need for custom field
      'title' => get_field('name',  $guide->ID),
      'permalink' => get_permalink($guide->ID),
      'color' => get_field('color', $guide->ID),
      'id' => $guide->ID,
      'is_svg' => $icon['mime_type'] === 'image/svg+xml',
      'count_videos' => get_field('video', $guide->ID),
      'count_photos' => 0,
    ];
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
