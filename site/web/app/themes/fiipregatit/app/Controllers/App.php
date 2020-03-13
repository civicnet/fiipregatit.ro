<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use App\Config\Constants;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }

  public static function links(): array {
    $links = get_posts(array(
      'post_type' => Constants::POST_TYPE_LINK,
      'posts_per_page' => 100,
    ));

    $ret = array();
    foreach ($links as $link) {
      $ret[] = [
        'target' => get_field('target', $link->ID),
        // TODO: Change with post_title
        'title' => get_field('title', $link->ID),
      ];
    }

    return $ret;
  }

}
