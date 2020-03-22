<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use App\Config\Constants;

class Ghiduri extends Controller {
  public static function get($count = 8, $category = null): array {
    $query = [
      'post_type' => Constants::POST_TYPE_GUIDE,
      'posts_per_page' => $count,
    ];

    $all_categories = get_categories('category');
    if ($category) {
      foreach ($all_categories as $currentCategory) {
        if ($currentCategory->slug === $category) {
          $query['category'] = $currentCategory->term_id;
          break;
        }
      }

      if (!isset($query['category'])) {
        return [];
      }
    }

    $guides = get_posts($query);
    if (!$category) {
      $guides = array_filter($guides, function ($guide) use ($all_categories) {
        $post_categories = $guide->post_category;
        if (!count($post_categories)) {
          return true;
        }

        return false;
      });
    }

    $ret = array();
    foreach ($guides as $guide) {
      $ret[] = self::guideData($guide);
    }

    return $ret;
  }

  public static function guideData(\WP_Post $guide): array {
    $icon = get_field('icon', $guide->ID);
    $images = array_filter(
      (array) get_post_meta($guide->ID, Constants::GUIDE_METABOX_GALLERY, 1)
    );

    return [
      'icon' => $icon,
      // TODO: Replace with `post_title`, no need for custom field
      'title' => get_field('name',  $guide->ID),
      'permalink' => get_permalink($guide->ID),
      'color' => get_field('color', $guide->ID),
      'id' => $guide->ID,
      'category' => $guide->post_category,
      'is_svg' => $icon['mime_type'] === 'image/svg+xml',
      'count_videos' => get_field('video', $guide->ID) ? 1 : 0,
      'count_photos' => count($images),
    ];
  }
}
