<?php

namespace App\Models\Guide;

use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Config\Constants;

$guide = new FieldsBuilder(Constants::POST_TYPE_GUIDE, [
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

$guide
  ->setLocation('post_type', '==', Constants::POST_TYPE_GUIDE);

$guide
  ->addText('name', [
    'label' => 'Nume eveniment',
    'placeholder' => 'Cutremur',
    'maxlength' => 128,
  ])
  ->setRequired()
  ->setInstructions('Pentru ce fel de eveniment este ghidul (ex: cutremur, viscol, etc.)');

$guide
  ->addTrueFalse('is_licensed', [
    'label' => 'Licențiat?',
  ])
  ->setInstructions('Ghidurile licențiate vor include un link către Creative Commons - Attribution-NonCommercial-ShareAlike 4.0');

$guide
  ->addWysiwyg('before', [
    'label' => 'Pregătire înaintea evenimentului',
    'tabs' => 'all',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setInstructions('Care sunt pașii ce trebuie urmați înaintea evenimentului? Recomandăm folosirea opțiunii de listă pentru a enumera pașii.');

$guide
  ->addWysiwyg('during', [
    'label' => 'Ce trebuie făcut în timpul evenimentului',
    'tabs' => 'all',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setInstructions('Cum reacționăm în timpul evenimentului? Recomandăm folosirea opțiunii de listă pentru a enumera pașii.');

$guide
  ->addWysiwyg('after', [
    'label' => 'Pași de urmat după eveniment',
    'tabs' => 'all',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setInstructions('Care sunt pașii ce trebuie urmați după ce a avut loc evenimentul? Recomandăm folosirea opțiunii de listă pentru a enumera pașii.');

$guide
  ->addWysiwyg('info', [
    'label' => 'Informații adiționale',
    'tabs' => 'all',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setInstructions('Orice alte infomații ajutătoare sub formă de text.');

$guide
  ->addOembed('video', [
    'label' => 'Video ajutător'
  ])
  ->setInstructions('Dacă doriți să includeți tutoriale video, puteți face asta aici. E suficient să introduceți un link de YouTube sau Vimeo către video-ul care trebuie afișat.');

$guide
  ->addRelationship('additional_sections', [
    'label' => 'Alte secțiuni',
    'post_type' => array(
      0 => Constants::POST_TYPE_GUIDE_SECTION,
    ),
    'taxonomy' => array(),
    'allow_null' => 1,
    'multiple' => 1,
    'return_format' => 'object',
    'ui' => 1,
  ])
  ->setInstructions('Dacă doriți, puteți alege ce alte secțiuni să fie afișate în ghidul acesta.');

$guide
  ->addFile('pdf', [
    'label' => 'Ghid PDF',
    'return_format' => 'array',
    'library' => 'all',
    'min_size' => '',
    'max_size' => 30,
    'mime_types' => '.pdf',
  ])
  ->setInstructions('Ghidul complet în format PDF, pentru download.');

$guide
  ->addImage('icon', [
    'label' => 'Pictogramă eveniment',
    'return_format' => 'array',
    'preview_size' => 'thumbnail',
    'library' => 'all',
    'mime_types' => '.jpg, .jpeg, .png, .svg, .gif',
  ])
  ->setRequired()
  ->setInstructions('Fiecare eveniment trebuie să fie reprezentat de către o pictogramă. Alegeți pictograma specifică acestui tip de eveniment.');


$guide
  ->addRelationship('related', [
    'label' => 'Ghiduri similare',
    'post_type' => array(
      0 => Constants::POST_TYPE_GUIDE,
    ),
    'taxonomy' => array(),
    'allow_null' => 1,
    'multiple' => 1,
    'return_format' => 'object',
    'ui' => 1,
  ])
  ->setInstructions('Dacă doriți, puteți alege ce alte ghiduri să fie afișate mai proeminent împreună cu ghidul acesta.');


return $guide;
