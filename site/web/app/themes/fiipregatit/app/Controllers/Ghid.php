<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use App\Config\Constants;
use App\File\FileUtils;

class Ghid extends Controller {
  public static function get(): array {
    $guide = get_post();

    $sidebarLinks = array_map(function($guide) {
      return [
        'text' => $guide['title'],
        'href' => $guide['permalink'],
      ];
    }, Ghiduri::get(100));

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
      'photo_gallery' => null, // $gallery,
      'photo_gallery_is_single' => false, // count($gallery) === 1,
      'has_extra_info' => (
        get_field('info', $guide->ID)
        || get_field('video', $guide->ID)
        || false // $gallery
      ),
      'pdf_guide' =>  get_field('pdf', $guide->ID),
      'pdf_size' => FileUtils::getHumanSize(get_field('pdf', $guide->ID)),
      'sidebar_links' => $sidebarLinks,
    ];
  }
}
