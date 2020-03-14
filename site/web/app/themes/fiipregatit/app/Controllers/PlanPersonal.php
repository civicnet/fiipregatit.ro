<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use App\Config\Constants;
use App\File\FileUtils;

class PlanPersonal extends Controller {
  public static function sections(): array {
    $query = new \WP_Query(['pagename' => Constants::PAGE_PERSONAL_PLAN]);
    $page = $query->get_queried_object();
    if (!$page) {
      throw new \Exception(sprintf(
        'Couldn\'t query page `%s`',
        Constants::PAGE_PERSONAL_PLAN
      ));
    }

    $pdf = get_field('pdf_table', $page->ID);
    return [
      'kit_description' => get_field('kit_description', $page->ID),
      'table_description' => get_field('table_description', $page->ID),
      'pdf_table' => $pdf['url'],
      'pdf_size' => FileUtils::getHumanSize($pdf['url']),
      'items' => [
        [
          'index' => 1,
          'title' => 'Apă',
          'content' => get_field('water', $page->ID),
          'collapsed' => true,
        ], [
          'index' => 2,
          'title' => 'Alimente',
          'content' => get_field('food', $page->ID),
          'collapsed' => true,
        ], [
          'index' => 3,
          'title' => 'Îmbrăcăminte și încălțăminte',
          'content' => get_field('clothing', $page->ID),
          'collapsed' => true,
        ], [
          'index' => 4,
          'title' => 'Un sac de dormit',
          'content' => get_field('sleeping_bag', $page->ID),
          'collapsed' => true,
        ], [
          'index' => 5,
          'title' => 'O trusă de prim ajutor',
          'content' => get_field('first_aid_kit', $page->ID),
          'collapsed' => true,
        ], [
          'index' => 6,
          'title' => 'Aparate utile',
          'content' => get_field('devices', $page->ID),
          'collapsed' => true,
        ], [
          'index' => 7,
          'title' => 'Articole pentru copii',
          'content' => get_field('kid_items', $page->ID),
          'collapsed' => true,
        ], [
          'index' => 8,
          'title' => 'Articole de igienă',
          'content' => get_field('hygiene', $page->ID),
          'collapsed' => true,
        ], [
          'index' => 9,
          'title' => 'Acte personale',
          'content' => get_field('documents', $page->ID),
          'collapsed' => true,
        ],
      ],
    ];
  }
}
