<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use App\Config\Constants;

class Despre extends Controller {
  public static function sections(): array {
    $query = new \WP_Query(['pagename' => Constants::PAGE_ABOUT]);
    $page = $query->get_queried_object();
    if (!$page) {
      throw new \Exception(sprintf(
        'Couldn\'t query page `%s`',
        Constants::PAGE_ABOUT
      ));
    }

    return [
      [
        'name' => 'Despre',
        'slug' => 'custom-menu-despre',
        'is_active' => 'active',
        'content' => get_field('about', $page->ID),
      ],
      [
        'name' => 'Context',
        'slug' => 'custom-menu-context',
        'content' => get_field('context', $page->ID),
      ],
      [
        'name' => 'Parteneri',
        'slug' => 'custom-menu-parteneri',
        // 'parteneri' => get_field('parteneri_despre', $page->ID),
        // 'descriere_parteneri' => get_field('parteneri', $page->ID),
        // 'descriere_parteneri' => 'Lorem ipsum',
        'parteneri' => array_filter(
          (array) get_post_meta(
            $page->ID,
            Constants::ABOUT_PAGE_METABOX_PARTNERS,
            true
          )
        ),
        'descriere_parteneri' => get_post_meta(
          $page->ID,
          Constants::ABOUT_PAGE_METABOX_PARTNER_DESC,
          true
        ),
        'is_partner_page' => true,
      ],
      [
        'name' => 'Echipa',
        'slug' => 'custom-menu-echipa',
        'content' => get_field('team', $page->ID),
      ],
    ];
  }
}
