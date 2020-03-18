<?php

namespace App\Algolia;

final class GuideIndexCustomFields extends IndexCustomFields {
  private $data = null;
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
        'weight' => '10',
      ),
      $data
    );
  }

  public function getContent(): string {
    if (!$this->data) {
      $this->data = \App\Controllers\Ghid::get($this->post);
    }

    $fieldsToIndex = [
      'title',
      'before_content',
      'during_content',
      'after_content',
    ];

    $results = [];

    foreach ($this->data as $key => $value) {
      if (in_array($key, $fieldsToIndex)) {
        $results[] = $value;
      }
    }

    foreach ($this->data['sections'] as $value) {
      $results[] = $value;
    }

    return implode(' ', $results);
  }

  private function getTrimmedData(): array {
    if (!$this->data) {
      $this->data = \App\Controllers\Ghid::get($this->post);
    }

    return [
      'title' => $this->data['title'],
      'image' => $this->data['icon']['sizes']['thumbnail'],
      'permalink' => $this->data['permalink'],
    ];
  }
}
