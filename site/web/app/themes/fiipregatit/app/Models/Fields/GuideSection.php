<?php

namespace App\Models\GuideSection;

use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Config\Constants;

$guide_section = new FieldsBuilder(Constants::POST_TYPE_GUIDE_SECTION, [
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

$guide_section
  ->setLocation('post_type', '==', Constants::POST_TYPE_GUIDE_SECTION);

$guide_section
  ->addText('name', [
    'label' => 'Nume secțiune',
    'maxlength' => 128,
  ])
  ->setRequired()
  ->setInstructions('Numele secțiunii (ex: Ce este COVID-19?');

$guide_section
  ->addWysiwyg('content', [
    'label' => 'Descriere secțiune',
    'tabs' => 'all',
    'toolbar' => 'full',
    'delay' => 'true'
  ])
  ->setInstructions('Recomandăm folosirea opțiunii de listă pentru a enumera pașii.');

return $guide_section;
