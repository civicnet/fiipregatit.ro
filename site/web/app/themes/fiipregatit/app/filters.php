<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);

add_filter('wp_nav_menu_items', function($items, $args) {
	if ($args->theme_location === 'primary_navigation') {
        $get_attrs = function() {
            return is_front_page()
                ? 'is-homepage'
                : '';
        };

        $home = '<li class="menu-item homepage_item '. $get_attrs() .'">
			<a href="' . esc_url(get_home_url()) . '"
               title="'.esc_attr(get_bloginfo('name', 'display')).'">
               <i class="fas fa-home"></i>
			</a></li>';
		$items = $home . $items;
	}
	return $items;
}, 10, 2);

add_filter('upload_mimes', function ($mime_types = array()) {
  $mime_types['svg']  = 'image/svg+xml';
  return $mime_types;
});

/**
 * Algolia Custom Index
 */
$algoliaAttributesCallback = function(array $attributes, \WP_Post $post) {
  return Algolia\IndexCustomFields::get($post, $attributes)->index();
};

// https://www.algolia.com/doc/api-reference/settings-api-parameters/
$algoliaSettingsCallback = function(array $settings) {
  return array(
    'searchableAttributes' => array(
      'unordered(title)',
      'unordered(content)',
    ),
    'attributesToRetrieve' => array(
      'type',
      'title',
      'content',
      'image',
      'permalink',
      'weight',
    ),
    'customRanking' => array(
        'desc(post_modified)',
        'desc(weight)',
        'desc(post_date)',
    ),
    'attributeForDistinct'  => 'post_id',
    'distinct'              => true,
    'attributesForFaceting' => array(),
    'attributesToSnippet' => array(
        'title:30',
        'content:30',
    ),
    'snippetEllipsisText' => '…',
    /* 'attributesToHighlight' => array(
      'title',
    ), */
  );
};


add_filter('algolia_post_shared_attributes', $algoliaAttributesCallback, 10, 2);
add_filter('algolia_searchable_post_shared_attributes', $algoliaAttributesCallback, 10, 2);
add_filter('algolia_posts_index_settings', $algoliaSettingsCallback);

$algoliaContentCallback = function(string $post_content, \WP_Post $post) {
  return Algolia\IndexCustomFields::get($post)->getContent();
};

add_filter('algolia_searchable_post_content', $algoliaContentCallback, 10, 2);
add_filter('algolia_post_content', $algoliaContentCallback, 10, 2);
