<?php

/**
 * IndexCustomFields::get($attr, $post)->index() -> Vector<attribute>
 * IndexCustomFields::get($attr, $post)->getContent() -> Map<attribute, content>
 *
 */

namespace App\Algolia;

use App\Config\Constants;

abstract class IndexCustomFields {
  private $attributes;
  protected $post;

  final protected function __construct(
    array $attributes,
    /*\WP_Post*/ $post = null
  ) {
    $this->attributes = $attributes;
    $this->post = $post;
  }

  final public static function get(
    \WP_Post $post,
    array $attributes = array()
  )/*: IndexCustomFields */ {
    switch ($post->post_type) {
      case Constants::POST_TYPE_GUIDE:
        return new GuideIndexCustomFields(
          $attributes,
          $post
        );
      case Constants::POST_TYPE_CAMPAIGN:
        return new CampaignIndexCustomFields(
          $attributes,
          $post
        );
      case Constants::POST_TYPE_GUIDE_SECTION:
        return new GuideSectionIndexCustomFields(
          $attributes,
          $post
        );
    }

    return new NoOpIndexCustomFields($attributes);
  }

  final public function index(): array {
    return array_merge(
      $this->getDefaultAttributes(),
      $this->getCustomAttributes()
    );
  }

  final protected function getDefaultAttributes(): array {
    return $this->attributes;
  }

  abstract protected function getCustomAttributes(): array;
  abstract public function getContent(): string;
}
