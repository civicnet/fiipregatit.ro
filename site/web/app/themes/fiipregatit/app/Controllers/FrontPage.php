<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use App\Config\Constants;

class FrontPage extends Controller {
  public static function guides($count = 8): array {
    return Ghiduri::get($count);
  }

  public static function campaigns($count = 3): array {
    return Campanii::get($count);
  }
}
