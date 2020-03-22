<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use App\Config\Constants;
use App\File\FileUtils;

class Ghid extends Controller {
  public static function get($guide = null): array {
    if (!$guide) {
      $guide = get_post();
    }

    $guideCategories = get_the_category();
    $currentCategory = null;
    if (count($guideCategories)) {
      $currentCategory = $guideCategories[0] ? $guideCategories[0]->slug : null;
    }

    $isFromCategory = true;
    $guides = Ghiduri::get(10, $currentCategory);
    if (count($guides) < 3) {
      $isFromCategory = false;
      $guides = Ghiduri::get(10);
    }

    $sidebarLinks = array_map(function($guide) {
      return [
        'text' => ($isFromCategory ? 'Ghid ' : '') . $guide['title'],
        'href' => $guide['permalink'],
      ];
    }, $guides);

    $sidebarLinks = array_filter($sidebarLinks, function($link) use ($guide) {
      return $link['text'] !== ($isFromCategory ? 'Ghid ' : '') . get_field('name', $guide->ID);
    });

    $gallery = array_filter(
      (array) get_post_meta($guide->ID, Constants::GUIDE_METABOX_GALLERY, 1)
    );

    $sections = get_field('additional_sections', $guide->ID);
    if (is_array($sections)) {
      $sections = array_map(function($section) {
        return [
          'name' => get_field('name', $section->ID),
          'content' => get_field('content', $section->ID),
        ];
      }, $sections);
    } else {
      $sections = [];
    }

    return [
      'title' => get_field('name', $guide->ID),
      'before_content' => get_field('before', $guide->ID),
      'is_before_single' => get_field('before', $guide->ID)
        && !get_field('during', $guide->ID)
        && !get_field('after', $guide->ID),
      'during_content' => get_field('during', $guide->ID),
      'is_during_single' => get_field('during', $guide->ID)
        && !get_field('before', $guide->ID)
        && !get_field('after', $guide->ID),
      'after_content' => get_field('after', $guide->ID),
      'is_after_single' => get_field('after', $guide->ID)
        && !get_field('before', $guide->ID)
        && !get_field('during', $guide->ID),
      'extra_info' => get_field('info', $guide->ID),
      'video' => get_field('video', $guide->ID),
      'photo_gallery' => $gallery,
      'photo_gallery_is_single' => count($gallery) === 1,
      'has_extra_info' => (
        get_field('info', $guide->ID)
        || get_field('video', $guide->ID)
        || false // $gallery
      ),
      'pdf_guide' =>  get_field('pdf', $guide->ID),
      'pdf_size' => FileUtils::getHumanSize(get_field('pdf', $guide->ID)['url']),
      'sidebar_links' => $sidebarLinks,
      'sections' => $sections,
      'is_licensed' => get_field('is_licensed', $guide->ID),
      'icon' =>  get_field('icon', $guide->ID),
      'permalink' => get_permalink($guide->ID),
    ];
  }
}
