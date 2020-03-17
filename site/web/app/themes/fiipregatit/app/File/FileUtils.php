<?php

namespace App\File;

final class FileUtils {
  public static function getHumanSize($url): ?string {
    if (!$url) {
      return null;
    }

    $sslContextOptions = array();

    /**
      * No valid SSL cert during development, skip verification.
      */
    if (WP_DEBUG) {
      $sslContextOptions = array(
        'verify_peer' => false,
        'verify_peer_name' => false,
      );
    }

    $pdftext = file_get_contents(
      $url,
      $use_include_path = false,
      stream_context_create(array('ssl' => $sslContextOptions))
    );

    preg_match_all("/\/Count\s+(\d+)/", $pdftext, $matches);
    if (!$matches) {
      return null;
    }

    $count = intval($matches[1][0]);
    if ($count) {
      return $count . ($count < 2 ? ' pagină' : ' pagini');
    }

    stream_context_set_default(
      array_merge(
        array(
          'http' => array(
            'method' => 'HEAD'
          ),
          'ssl' => $sslContextOptions
        )
      )
    );

    $headers = get_headers($url, $format = 1);
    if (isset($headers['Content-Length'])) {
      return self::formatBytes(
        $headers['Content-Length']
      );
    }

    return null;
  }

  private static function formatBytes(int $bytes, int $precision = 2): string {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
  }
}
