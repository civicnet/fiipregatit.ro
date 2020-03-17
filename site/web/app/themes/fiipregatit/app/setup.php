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
      'taxonomies'  => array( 'category' ),
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

  register_post_type(
    Config\Constants::POST_TYPE_GUIDE_SECTION,
    array(
      'labels' => array(
        'name' => __('Secțiune Ghid'),
        'singular_name' => __('Sectiune')
      ),
      'public' => true,
      'has_archive' => false,
      'menu_icon' => 'dashicons-align-center'
    )
  );
});

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
add_action('cmb2_init', function () {
  // Custom Guides meta box
  $cmb_guide = new_cmb2_box(array(
    'id'            => 'attachments_guide',
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
    'context' => 'advanced',
  ));

  $cmb_parteneri->add_field(array(
    'name' => 'Descriere toți partenerii',
    'id'   => Config\Constants::ABOUT_PAGE_METABOX_PARTNER_DESC,
    'type' => 'wysiwyg',
    'options' => array(
      'wpautop' => true,
      'media_buttons' => false,
      'teeny' => true,
    ),
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
        // 'wpautop' => true,
        // 'media_buttons' => false,
        // 'teeny' => true,
      )
    )
  );

  $cmb_parteneri->add_group_field(
    $parteneri_group_id,
    array(
      'name' => 'Nume',
      'id'   => 'name',
      'type' => 'text',
      'options' => array(
      )
    )
  );
});
