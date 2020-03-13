<?php

namespace App\Models\Campaign;

use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Config\Constants;

$campaign = new FieldsBuilder(Constants::POST_TYPE_CAMPAIGN, [
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => array(
    0 => 'the_content',
    1 => 'excerpt',
    2 => 'featured_image',
    3 => 'categories',
    4 => 'tags',
  ),
  'active' => 1,
  'menu_order' => 0,
  'position' => 'acf_after_title',
]);

$campaign
  ->setLocation('post_type', '==', Constants::POST_TYPE_CAMPAIGN);


$campaign
  ->addWysiwyg('content', [
    'label' => 'Conținut',
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'media_upload' => 1,
    'delay' => 'true'
  ])
  ->setRequired();

$campaign
  ->addTextarea('extras', [
    'label' => 'Extras',
    'maxlength' => 256,
  ])
  ->setRequired()
  ->setInstructions('Acest extras de text va apărea pe homepage, dar și în rezultatele motoarelor de căutare.');

$campaign
  ->addImage('image', [
    'label' => 'Imagine',
    'return_format' => 'array',
    'preview_size' => 'large',
    'library' => 'all',
    'min_width' => 640,
    'min_height' => 480,
    'min_size' => '.1',
    'max_width' => '',
    'max_height' => '',
    'max_size' => 5,
    'mime_types' => '.jpg, .png, .jpeg, .gif',
  ])
  ->setRequired()
  ->setInstructions('Această imagine va fi afișată atât pe homepage, împreună cu extrasul, cât și pe pagina de campanie.');

$campaign
  ->addRelationship('related', [
    'label' => 'Ghiduri sugerate',
    'post_type' => array(
      0 => Constants::POST_TYPE_GUIDE,
    ),
    'taxonomy' => array(),
    'allow_null' => 0,
    'multiple' => 1,
    'return_format' => 'object',
    'ui' => 1,
  ])
  ->setInstructions('Dacă doriți să promovați anumite ghiduri care au legătură cu această campanie, le puteți selecta aici (doar primele patru sugestii vor fi incluse)');

return $campaign;
