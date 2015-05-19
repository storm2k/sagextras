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
  	if (current_theme_supports('se-navwalker')) {
  		require_once __DIR__ . '/modules/se-navwalker.php';
  	}

  	if (current_theme_supports('se-gallery')) {
  		require_once __DIR__ . '/modules/se-gallery.php';
  	}
}
add_action('after_setup_theme', __NAMESPACE__ . '\\load_modules');