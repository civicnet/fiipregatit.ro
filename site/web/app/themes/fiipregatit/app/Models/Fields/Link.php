<?php

namespace App\Models\Link;

use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Config\Constants;

$link = new FieldsBuilder(Constants::POST_TYPE_LINK, [
  'menu_order' => 0,
  'position' => 'acf_after_title',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => array(
    0 => 'the_content',
    1 => 'featured_image',
    2 => 'categories',
    3 => 'tags',
  ),
  'active' => 1,
]);

$link
  ->setLocation('post_type', '==', Constants::POST_TYPE_LINK);

$link
  ->addText('title', [
    'label' => 'Nume',
    'placeholder' => 'Inspectoratul General pentru Situații de Urgență',
    'maxlength' => 256,
  ])
  ->setRequired();

  $link
  ->addUrl('target', [
    'label' => 'Link / URL',
    'placeholder' => 'https://igsu.gov.ro',
    'maxlength' => 256,
  ])
  ->setRequired();

return $link;
