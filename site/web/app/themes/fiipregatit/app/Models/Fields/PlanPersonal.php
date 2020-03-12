<?php

namespace App\Models\PersonalPlan;

use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Config\Constants;

$plan = new FieldsBuilder(Constants::PAGE_PERSONAL_PLAN, [
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
  ),
  'active' => 1,
  'description' => '',
]);

$plan
  ->setLocation('page_template', '==', 'views/template-personal-plan.blade.php');

$plan
  ->addWysiwyg('Apă', [
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setRequired()
  ->setInstructions('Detalii despre cantitatea de apă necesară, ș.a.m.d.');

$plan
  ->addWysiwyg('Alimente', [
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setRequired()
  ->setInstructions('Detalii despre alimentele necesare supraviețuirii');

$plan
  ->addWysiwyg('Îmbrăcăminte / încălțăminte', [
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setRequired()
  ->setInstructions('Detalii despre ce articole de îmbrăcăminte sunt necesare supraviețuirii');

$plan
  ->addWysiwyg('Un sac de dormit', [
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setRequired()
  ->setInstructions('Detalii despre importanța sacului de dormit în condiții de supraviețuire');

$plan
  ->addWysiwyg('Trusă de prim ajutor', [
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setRequired()
  ->setInstructions('Ce ar trebui să conțină trusa de prim ajutor?');

$plan
  ->addWysiwyg('Articole pentru copii', [
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setRequired();

$plan
  ->addWysiwyg('Aparate utile', [
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setRequired()
  ->setInstructions('Ce alte aparate sunt utile supraviețuirii (lanternă, telefon, etc.)');

$plan
  ->addWysiwyg('Articole de igienă', [
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setRequired()
  ->setInstructions('Importanța articolelor de igienă pentru supraviețuire. Ce articole de igienă sunt necesare?');

$plan
  ->addWysiwyg('Acte personale', [
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setRequired()
  ->setInstructions('Ce acte personale sunt necesare/utile supraviețuirii?');

$plan
  ->addWysiwyg('Descriere rucsac de supraviețuire', [
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setRequired()
  ->setInstructions('Ce este rucsacul de supraviețuire?');

$plan
  ->addWysiwyg('Descriere tabel informații utile', [
    'tabs' => 'visual',
    'toolbar' => 'basic',
    'delay' => 'true'
  ])
  ->setRequired()
  ->setInstructions('Ce informații utile sunt cuprinse în acest tabel?');

$plan
  ->addFile('Tabel PDF', [
    'return_format' => 'array',
    'library' => 'all',
    'min_size' => '',
    'max_size' => 20,
    'mime_types' => '',
  ])
  ->setRequired()
  ->setInstructions('Tabelul cu informații utile în format PDF');

return $plan;
