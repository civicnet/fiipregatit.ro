<?php

namespace App\Algolia;

use App\Config\Constants;

final class GuideSectionIndexCustomFields extends IndexCustomFields {
  protected function getCustomAttributes(): array {
    // Don't leak private posts
    $status = get_post_status($this->post);
    if ($status != 'publish') {
      return array(
        'type' => 'noop',
        'weight' => -1,
      );
    }

    $data = $this->getTrimmedData();
    return array_merge(
      array(
        'weight' => '15',
        'type' => Constants::POST_TYPE_GUIDE,
      ),
      $data
    );
  }

  public function getContent(): string {
    if (!$this->data) {
      $this->data = \App\Controllers\SectiuneGhid::get($this->post);
    }

    $fieldsToIndex = [
      'content',
    ];

    $results = [];

    foreach ($this->data as $key => $value) {
      if (in_array($key, $fieldsToIndex)) {
        $results[] = $value;
      }
    }

    return implode(' ', $results);
  }

  private function getTrimmedData(): array {
    if (!$this->data) {
      $this->data = \App\Controllers\SectiuneGhid::get($this->post);
    }

    return [
      'title' => $this->data['title'],
      'subtitle' => $this->data['subtitle'],
      'image' => $this->data['image'],
      'permalink' => $this->data['permalink'],
    ];
  }
}
