<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
  wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}, 100);

/**
 * Theme setup
 */
add_action('init', function () {
  register_post_type(
    Config\Constants::POST_TYPE_CAMPAIGN,
    array(
      'labels' => array(
        'name' => __('Campanii'),
        'singular_name' => __('Campanie')
      ),
      'supports' => array('title', 'editor', 'thumbnail'),
      'public' => true,
      'has_archive' => false,
      'menu_icon' => 'dashicons-megaphone'
    )
  );

  register_post_type(
    Config\Constants::POST_TYPE_GUIDE,
    array(
      'labels' => array(
        'name' => __('Ghiduri'),
        'singular_name' => __('Ghid')
      ),
      'supports' => array('title', 'editor', 'thumbnail'),
      'public' => true,
      'has_archive' => false,
      'menu_icon' => 'dashicons-clipboard',
    )
  );

  register_post_type(
    Config\Constants::POST_TYPE_LINK,
    array(
      'labels' => array(
        'name' => __('Linkuri utile'),
        'singular_name' => __('Link')
      ),
      'public' => true,
      'has_archive' => false,
      'menu_icon' => 'dashicons-external'
    )
  );
});

if (function_exists('acf_add_local_field_groupp')) {
  /*
    \acf_add_local_field_group(array(
        'key' => 'group_5a92a467ad7b0',
        'title' => 'Despre',
        'fields' => array(
            array(
                'key' => 'field_5a92a46f75fde',
                'label' => 'Despre',
                'name' => 'despre',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a92a48e75fdf',
                'label' => 'Context',
                'name' => 'context',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a92a4a075fe0',
                'label' => 'Parteneri',
                'name' => 'parteneri',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a92a4b375fe1',
                'label' => 'Echipa',
                'name' => 'echipa',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'templates/despre.php',
                ),
            ),
        ),
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
    ));



    \acf_add_local_field_group(array(
        'key' => 'group_5a7d920f836c1',
        'title' => 'Plan Personal',
        'fields' => array(
            array(
                'key' => 'field_5a7d92626cdba',
                'label' => 'Apă',
                'name' => 'apa',
                'type' => 'wysiwyg',
                'instructions' => 'Detalii despre cantitatea de apă necesară, ș.a.m.d.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a7d929b6cdbb',
                'label' => 'Alimente',
                'name' => 'alimente',
                'type' => 'wysiwyg',
                'instructions' => 'Detalii despre alimentele necesare supraviețuirii',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a7d92b86cdbc',
                'label' => 'Îmbrăcăminte / încălțăminte',
                'name' => 'imbracaminte_si_incaltaminte',
                'type' => 'wysiwyg',
                'instructions' => 'Detalii despre ce articole de îmbrăcăminte sunt necesare supraviețuirii',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a7d92fb6cdbd',
                'label' => 'Un sac de dormit',
                'name' => 'sac_de_dormit',
                'type' => 'wysiwyg',
                'instructions' => 'Detalii despre importanța sacului de dormit în condiții de supraviețuire',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a7d93266cdbe',
                'label' => 'Trusă de prim ajutor',
                'name' => 'trusa_prim_ajutor',
                'type' => 'wysiwyg',
                'instructions' => 'Ce ar trebui să conțină trusa de prim ajutor?',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a7d93496cdbf',
                'label' => 'Aparate utile',
                'name' => 'aparate_utile',
                'type' => 'wysiwyg',
                'instructions' => 'Ce alte aparate sunt utile supraviețuirii (lanternă, telefon, etc.)',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a7d936d6cdc0',
                'label' => 'Articole de igienă',
                'name' => 'articole_de_igiena',
                'type' => 'wysiwyg',
                'instructions' => 'Importanța articolelor de igienă pentru supraviețuire. Ce articole de igienă sunt necesare?',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a7d93986cdc1',
                'label' => 'Acte personale',
                'name' => 'acte_personale',
                'type' => 'wysiwyg',
                'instructions' => 'Ce acte personale sunt necesare/utile supraviețuirii?',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a7d93c96cdc2',
                'label' => 'Descriere rucsac de supraviețuire',
                'name' => 'descriere_rucsac_supravietuire',
                'type' => 'wysiwyg',
                'instructions' => 'Ce este rucsacul de supraviețuire?',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'full',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a7d93f56cdc3',
                'label' => 'Descriere tabel informații utile',
                'name' => 'descriere_tabel_informatii_utile',
                'type' => 'wysiwyg',
                'instructions' => 'Ce informații utile sunt cuprinse în acest tabel?',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a7d94316cdc4',
                'label' => 'Tabel PDF',
                'name' => 'tabel_pdf',
                'type' => 'file',
                'instructions' => 'Tabelul cu informații utile în format PDF',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'library' => 'all',
                'min_size' => '',
                'max_size' => 20,
                'mime_types' => '',
            ),
            array(
                'key' => 'field_5a82ecd8e922d',
                'label' => 'Articole pentru copii',
                'name' => 'articole_copii',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page',
                    'operator' => '==',
                    'value' => '42',
                ),
            ),
        ),
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
    ));

    \acf_add_local_field_group(array(
        'key' => 'group_5a8e68eb791ac',
        'title' => 'Prim Ajutor',
        'fields' => array(
            array(
                'key' => 'field_5a8e69b593a8e',
                'label' => 'Pierderea conștienței',
                'name' => 'pierderea_cunostintei',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a8e69e293a90',
                'label' => 'Stopul cardio-respirator',
                'name' => 'stopul_cardio_respirator',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a8e699a93a8d',
                'label' => 'Obstrucția căilor aeriene la copii',
                'name' => 'obstructia_cailor_aeriene_la_copii',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a8e694b93a8a',
                'label' => 'Arsura la copii',
                'name' => 'arsura_la_copii',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a8e69ff93a91',
                'label' => 'Traumatismul cranio-cerebral la adulți',
                'name' => 'traumatismul_cranio_cerebral_la_adulti',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a8e6a2693a92',
                'label' => 'Traumatismul cranio-cerebral la copii',
                'name' => 'traumatismul_cranio_cerebral_la_copii',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a8e696c93a8b',
                'label' => 'Intoxicația alcoolică',
                'name' => 'intoxicatia_alcoolica',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a8e698693a8c',
                'label' => 'Mușcăturile de animal',
                'name' => 'muscaturile_de_animal',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a8e69cf93a8f',
                'label' => 'Reacția alergică',
                'name' => 'reactia_alergica',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5a8e6abf42076',
                'label' => 'Ghid PDF',
                'name' => 'ghid_pdf',
                'type' => 'file',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'library' => 'all',
                'min_size' => '',
                'max_size' => '',
                'mime_types' => '.pdf',
            ),
            array(
                'key' => 'field_5a8e872188de7',
                'label' => 'Pictogramă',
                'name' => 'pictograma',
                'type' => 'image',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_5a931313756c8',
                'label' => 'Culoare pictograma',
                'name' => 'culoare_pictograma',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '#000000',
            ),
            array(
                'key' => 'field_5a940919c4dbb',
                'label' => 'Apel 112',
                'name' => 'apel_112',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'templates/content-prim-ajutor.php',
                ),
            ),
        ),
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
    )); */
};


add_action('after_setup_theme', function () {
  /**
   * Enable features from Soil when plugin is activated
   * @link https://roots.io/plugins/soil/
   */
  add_theme_support('soil-clean-up');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-relative-urls');

  /**
   * Enable plugins to manage the document title
   * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
   */
  add_theme_support('title-tag');

  /**
   * Register navigation menus
   * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
   */
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage')
  ]);

  /**
   * Enable post thumbnails
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support('post-thumbnails');

  /**
   * Enable HTML5 markup support
   * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
   */
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  /**
   * Enable selective refresh for widgets in customizer
   * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
   */
  add_theme_support('customize-selective-refresh-widgets');

  /**
   * Use main stylesheet for visual editor
   * @see resources/assets/styles/layouts/_tinymce.scss
   */
  add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
  $config = [
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ];
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary'
  ] + $config);
  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer'
  ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
  sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
  /**
   * Add JsonManifest to Sage container
   */
  sage()->singleton('sage.assets', function () {
    return new JsonManifest(config('assets.manifest'), config('assets.uri'));
  });

  /**
   * Add Blade to Sage container
   */
  sage()->singleton('sage.blade', function (Container $app) {
    $cachePath = config('view.compiled');
    if (!file_exists($cachePath)) {
      wp_mkdir_p($cachePath);
    }
    (new BladeProvider($app))->register();
    return new Blade($app['view']);
  });

  /**
   * Create @asset() Blade directive
   */
  sage('blade')->compiler()->directive('asset', function ($asset) {
    return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
  });
});

/**
 * Initialize ACF Builder
 */
add_action('init', function () {
  collect(glob(config('theme.dir') . '/app/Models/Fields/*.php'))->map(function ($field) {
    return require_once($field);
  })->map(function ($field) {
    if ($field instanceof FieldsBuilder) {
      acf_add_local_field_group($field->build());
    }
  });
});

/**
 * Initialize CMB boxes
 */
add_action('cmb2_admin_init', function () {
  // Custom Guides meta box
  $cmb_guide = new_cmb2_box(array(
    'id'            => 'galerie_foto_ghiduri',
    'title'         => __('Galerie Foto', 'cmb2'),
    'object_types'  => array(Config\Constants::POST_TYPE_GUIDE),
    'context'       => 'side',
    'show_names'    => true
  ));

  $cmb_guide->add_field(array(
    'name' => '',
    'desc' => 'Alege imaginile pe care dorești să le afișezi pentru ghidul acesta',
    'id'   => Config\Constants::GUIDE_METABOX_GALLERY,
    'type' => 'file_list',
    'query_args' => array('type' => 'image'),
    'text' => array(
      'add_upload_files_text' => 'Adaugă imagini',
      'remove_image_text' => 'Șterge imagine',
      'file_text' => 'Imagine:',
      'file_download_text' => 'Downloadează',
      'remove_text' => 'Șterge',
    ),
  ));

  // Custom Campaign meta box
  $cmb_campaign = new_cmb2_box(array(
    'id'            => 'attachments_campaign',
    'title'         => __('Materiale de Informare', 'cmb2'),
    'object_types'  => array(Config\Constants::POST_TYPE_CAMPAIGN),
    //'context'       => 'side',
    'show_names'    => true
  ));

  $cmb_campaign->add_field(array(
    'name' => '',
    'desc' => 'Alege materialele de informare / promo, pentru campania aceasta',
    'id'   => Config\Constants::CAMPAIGN_METABOX_ATTACHMENTS,
    'type' => 'file_list',
    'text' => array(
      'add_upload_files_text' => 'Adaugă materiale',
      'remove_image_text' => 'Șterge material',
      'file_text' => 'Material:',
      'file_download_text' => 'Downloadează',
      'remove_text' => 'Șterge',
    ),
  ));

  $campaign_video_group_id = $cmb_campaign->add_field(array(
    'id' => Config\Constants::CAMPAIGN_METABOX_VIDEO_GROUP,
    'type' => 'group',
    'description' => __('Listă materiale video (YouTube/Vimeo/etc.)', 'cmb2'),
    'options'     => array(
      'group_title'   => __('Video {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
      'add_button'    => __('Adaugă video', 'cmb2'),
      'remove_button' => __('Șterge video', 'cmb2'),
      'sortable'      => false, // beta
      //'closed'     => true, // true to have the groups closed by default
    ),
  ));

  $cmb_campaign->add_group_field(
    $campaign_video_group_id,
    array(
      'name' => 'Titlu video',
      'id'   => 'title',
      'type' => 'text',
      // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    )
  );

  $cmb_campaign->add_group_field(
    $campaign_video_group_id,
    array(
      'name' => 'URL video',
      'id'   => 'video_oembed',
      'type' => 'oembed',
      // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    )
  );


  // Custom Despre meta box
  $cmb_parteneri = new_cmb2_box(array(
    'id' => 'parteneri_despre',
    'title' => __('Parteneri', 'cmb2'),
    'object_types' => array('page'),
    'show_on' => array(
      'key' => 'slug',
      'value' => 'despre',
    ),
    'context'       => 'advanced',
  ));

  $cmb_parteneri->add_field(array(
    'name' => 'Descriere toți partenerii',
    'id'   => Config\Constants::ABOUT_PAGE_METABOX_PARTNER_DESC,
    'type' => 'wysiwyg',
    'options' => array(
      'wpautop' => true,
      'media_buttons' => false,
      'teeny' => true,
    )
  ));

  $parteneri_group_id = $cmb_parteneri->add_field(array(
    'id' => Config\Constants::ABOUT_PAGE_METABOX_PARTNERS,
    'type' => 'group',
    'description' => __('Secțiune parteneri', 'cmb2'),
    'options'     => array(
      'group_title'   => __('Partener {#}', 'cmb2'),
      'add_button'    => __('Adaugă partener', 'cmb2'),
      'remove_button' => __('Șterge partener', 'cmb2'),
      'sortable'      => false,
    ),
  ));

  $cmb_parteneri->add_group_field(
    $parteneri_group_id,
    array(
      'name' => 'Logo partener',
      'id'   => 'logo_partener',
      'type' => 'file',
      'options' => array(
        'url' => false,
      ),
      'text' => array(
        'add_upload_file_text' => 'Adaugă logo',
      ),
      'query_args' => array(
        'type' => array(
          'image/gif',
          'image/jpeg',
          'image/png',
        ),
      ),
      'preview_size' => 'medium'
    )
  );

  $cmb_parteneri->add_group_field(
    $parteneri_group_id,
    array(
      'name' => 'Descriere partener',
      'id'   => 'descriere_partener',
      'type' => 'wysiwyg',
      'options' => array(
        'wpautop' => true,
        'media_buttons' => false,
        'teeny' => true,
      )
    )
  );
});
