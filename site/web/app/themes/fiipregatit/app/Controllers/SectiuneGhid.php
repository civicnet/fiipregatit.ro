<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use App\Config\Constants;
use App\File\FileUtils;

class SectiuneGhid extends Controller {
  public static function get($section = null): array {
    if (!$section) {
      $section = get_post();
    }

    $guides = get_posts([
      'post_type' => Constants::POST_TYPE_GUIDE,
      'posts_per_page' => 100,
      'meta_query' => array(
        array(
          'key' => 'additional_sections', // name of custom field
          'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
          'compare' => 'LIKE'
        )
      )
    ]);

    return [
      'title' => get_field('name', $section->ID),
      'content' => get_field('content', $section->ID),
      'permalink' => get_permalink($section->ID),
      'guide' => count($guides) ? Ghid::get($guides[0]) : null,
    ];
  }
}
