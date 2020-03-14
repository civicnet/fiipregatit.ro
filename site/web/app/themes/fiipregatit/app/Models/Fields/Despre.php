<?php

namespace App\Models\Despre;

use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Config\Constants;

$about = new FieldsBuilder(Constants::PAGE_ABOUT, [
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
      4 => 'featured_image',
      5 => 'categories',
      6 => 'tags',
      7 => 'send-trackbacks',
  ),
  'active' => 1,
  'description' => '',
]);

$about
  ->setLocation('page_template', '==', 'views/page-despre.blade.php');

$about
  ->addWysiwyg('about', [
    'label' => 'Despre',
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'media_upload' => 0,
    'delay' => 1,
  ])
  ->setRequired();

$about
  ->addWysiwyg('context', [
    'label' => 'Context',
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'media_upload' => 0,
    'delay' => 1,
  ])
  ->setRequired();

/* $about
  ->addWysiwyg('partners', [
    'label' => 'Parteneri',
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'media_upload' => 0,
    'delay' => 1,
  ])
  ->setRequired(); */

$about
  ->addWysiwyg('team', [
    'label' => 'Echipă',
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'media_upload' => 0,
    'delay' => 1,
  ])
  ->setRequired();

return $about;
