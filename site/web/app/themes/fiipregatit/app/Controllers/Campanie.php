<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use App\Config\Constants;
use App\File\FileUtils;

class Campanie extends Controller
{
  public static function get($campaign = null): array
  {
    if (!$campaign) {
      $campaign = get_post();
    }

    $attachments = array_filter(
      (array) get_post_meta(
        $campaign->ID,
        Constants::CAMPAIGN_METABOX_ATTACHMENTS,
        true
      )
    );

    $finalAttachments = [];
    foreach ($attachments as $attachment) {
      $extension = pathinfo($attachment, PATHINFO_EXTENSION);

      $icon_class = 'fa-file';
      $has_lightbox = false;

      if (in_array($extension, array('png', 'jpg', 'jpeg', 'gif', 'svg'))) {
        $icon_class = 'fa-image';
        $has_lightbox = true;
      } else if ($extension === 'pdf') {
        $icon_class = 'fa-file-pdf';
      }

      $finalAttachments[] = array(
        'url' => $attachment,
        'name' => basename($attachment),
        'icon_class' => $icon_class,
        'has_lightbox' => $has_lightbox,
      );
    }

    $videos = array_filter(
      (array) get_post_meta(
        $campaign->ID,
        Constants::CAMPAIGN_METABOX_VIDEO_GROUP,
        true
      )
    );

    $finalVideos = [];
    foreach ($videos as $video) {
      $finalVideos[] = array(
        'url' => $video['video_oembed'],
        'title' => $video['title'],
        'embed_code' => wp_oembed_get($video['title']),
      );
    }
    return [
      'title' => $campaign->post_title,
      'content' => get_field('content', $campaign->ID),
      'date' => new \DateTime($campaign->post_date),
      'permalink' => get_the_permalink($campaign->ID),
      'image' => get_field('image', $campaign->ID),
      'extras' => get_field('extras', $campaign->ID),
      'attachments' => $finalAttachments,
      'videos' => $finalVideos,
    ];
  }
}
