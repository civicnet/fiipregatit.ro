<?php

namespace App\Algolia;

final class CampaignIndexCustomFields extends IndexCustomFields {
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
      $this->data = \App\Controllers\Campanie::get($this->post);
    }

    $fieldsToIndex = [
      'title',
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
      $this->data = \App\Controllers\Campanie::get($this->post);
    }

    return array(
      'title' => $this->data['title'],
      'image' => $this->data['image']['sizes']['thumbnail'],
      'permalink' => $this->data['permalink'],
    );
  }
}
