<?php

/*
  Plugin Name:        Sagextras
  Plugin URI:         https://github.com/storm2k/sagextras
  Description:        Restores some Bootstrap specific functionality to the Sage theme.
  Version:            1.0.0
  Author:             Michael Romero
  Author URI:         https://github.com/storm2k

  License:            MIT License
  License URI:        http://opensource.org/licenses/MIT
 */

namespace Sageextras;

class Options {

  protected static $modules = [];
  protected $options = [];

  public static function init($module, $options = []) {
    if (!isset(self::$modules[$module])) {
      self::$modules[$module] = new static((array) $options);
    }
    return self::$modules[$module];
  }

  public static function getByFile($file) {
    if (file_exists($file) || file_exists(__DIR__ . '/modules/' . $file)) {
      return self::get('se-' . basename($file, '.php'));
    }
    return [];
  }

  public static function get($module) {
    if (isset(self::$modules[$module])) {
      return self::$modules[$module]->options;
    }
    if (substr($module, 0, 5) !== 'se-') {
      return self::get('se-' . $module);
    }
    return [];
  }

  protected function __construct($options) {
    $this->set($options);
  }

  public function set($options) {
    $this->options = $options;
  }
}

function load_modules() {
  global $_wp_theme_features;
  foreach (glob(__DIR__ . '/modules/*.php') as $file) {
    $feature = 'se-' . basename($file, '.php');
    $soil_feature = 'soil-' . basename($file, '.php');
    if (isset($_wp_theme_features[$feature])) {

      if (isset($_wp_theme_features[$soil_feature])) {
        unset($_wp_theme_features[$soil_feature]);
      }

      Options::init($feature, $_wp_theme_features[$feature]);
      require_once $file;
    }
  }
}

add_action('after_setup_theme', __NAMESPACE__ . '\\load_modules');
