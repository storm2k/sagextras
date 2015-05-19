<?php
/*
Plugin Name:        Sagextras
Plugin URI:         http://dimensionsixdesign.com/se
Description:        Reenables some Bootstrap specific functions in the Sage theme.
Version:            1.0.0
Author:             Michael Romero
Author URI:         http://dimensionsixdesign.com/

License:            MIT License
License URI:        http://opensource.org/licenses/MIT
*/

namespace D6D\Sagextras;

function load_modules() {
  global $_wp_theme_features;
  foreach (glob(__DIR__ . '/modules/*.php') as $file) {
    $feature = 'se-' . basename($file, '.php');
    if (isset($_wp_theme_features[$feature])) {
      require_once $file;
    }
  }
}
add_action('after_setup_theme', __NAMESPACE__ . '\\load_modules');