<?php

namespace App\Models\FirstAid;

use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Config\Constants;

$firstAid = new FieldsBuilder(Constants::PAGE_FIRST_AID, [
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => array(
    0 => 'the_content',
    1 => 'excerpt',
    2 => 'discussion',
    3 => 'comments',
    4 => 'revisions',
    5 => 'format',
    6 => 'featured_image',
    7 => 'categories',
    8 => 'tags',
    9 => 'send-trackbacks',
  ),
  'active' => 1,
  'description' => '',
]);

$firstAid
  ->setLocation('page_template', '==', 'views/template-first-aid.blade.php');

$fields = [
  'Pierderea conștienței',
  'Stopul cardio-respirator',
  'Obstrucția căilor aeriene la copii',
  'Arsura la copii',
  'Traumatismul cranio-cerebral la adulți',
  'Traumatismul cranio-cerebral la copii',
  'Intoxicația alcoolică',
  'Mușcăturile de animal',
  'Reacția alergică',
  'Apel 112',
];

foreach ($fields as $field) {
  $firstAid
    ->addWysiwyg($field, [
      'tabs' => 'visual',
      'toolbar' => 'basic',
      'delay' => 'true'
    ])
    ->setRequired();
}

$firstAid
  ->addFile('Ghid PDF', [
    'return_format' => 'array',
    'library' => 'all',
    'min_size' => '',
    'max_size' => '',
    'mime_types' => '.pdf',
  ])
  ->setRequired();

$firstAid
  ->addImage('Pictogramă', [
    'return_format' => 'array',
    'preview_size' => 'thumbnail',
    'library' => 'all',
  ])
  ->setRequired();

$firstAid
  ->addColorPicker('Culoare pictogramă', [
    'default_value' => '#000000',
  ]);

return $firstAid;
