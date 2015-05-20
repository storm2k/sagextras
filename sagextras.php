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

function load_modules() {
  	if (current_theme_supports('se-navwalker')) {
  		require_once __DIR__ . '/modules/navwalker.php';
  	}

  	if (current_theme_supports('se-gallery')) {
  		require_once __DIR__ . '/modules/gallery.php';
  	}
}
add_action('after_setup_theme', 'load_modules');