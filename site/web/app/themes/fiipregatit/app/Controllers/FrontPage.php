<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use App\Config\Constants;

class FrontPage extends Controller {
  public static function guides($count = 8): array {
    return Ghiduri::get($count);
  }

  public static function campaigns($count = 3): array {
    return Campanii::get($count);
  }

  public static function counters(): array {
    $imageCount = 0;
    $videoCount = 0;
    $guides = Ghiduri::get(100);

    foreach ($guides as $guide) {
      $videoCount += $guide['count_videos'];
      $imageCount += $guide['count_photos'];
    }

    return [
      'guide_count' => count($guides) + 1,
      'image_count' => $imageCount,
      'video_count' => $videoCount,
    ];
  }
}
