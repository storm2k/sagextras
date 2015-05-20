<?php

/**
 * Restore the Roots 7.0.3 Bootstrap Navwalker for a cleaner Bootstrap menu 
 */
class Sagextra_Nav_Walker extends Walker_Nav_Menu {
  private $cpt; // Boolean, is current post a custom post type.
  private $archive; // Stores the archive page for current url.
  function __construct() {
    add_filter('nav_menu_css_class', array($this, 'css_classes'), 10, 2);
    add_filter('nav_menu_item_id', '__return_null');
    $cpt           = get_post_type();
    $this->cpt     = in_array($cpt, get_post_types(array('_builtin' => false)));
    $this->archive = get_post_type_archive_link($cpt);
  }
  function check_current($classes) {
    return preg_match('/(current[-_])|active|dropdown/', $classes);
  }
  function start_lvl(&$output, $depth = 0, $args = array()) {
    $output .= "\n<ul class=\"dropdown-menu\">\n";
  }
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $item_html = '';
    parent::start_el($item_html, $item, $depth, $args);
    if ($item->is_dropdown && ($depth === 0)) {
      $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#"', $item_html);
      $item_html = str_replace('</a>', ' <b class="caret"></b></a>', $item_html);
    }
    elseif (stristr($item_html, 'li class="divider')) {
      $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
    }
    elseif (stristr($item_html, 'li class="dropdown-header')) {
      $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
    }
    $item_html = apply_filters('sagextra_wp_nav_menu_item', $item_html);
    $output .= $item_html;
  }
  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
    $element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));
    if ($element->is_dropdown) {
      $element->classes[] = 'dropdown';
      foreach ($children_elements[$element->ID] as $child) {
        if ($child->current_item_parent || url_compare($this->archive, $child->url)) {
          $element->classes[] = 'active';
        }
      }
    }
    $element->is_active = strpos($this->archive, $element->url);
    if ($element->is_active) {
      $element->classes[] = 'active';
    }
    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
  public function css_classes($classes, $item) {
    $slug = sanitize_title($item->title);
    if ($this->cpt) {
      $classes = str_replace('current_page_parent', '', $classes);
      if (url_compare($this->archive, $item->url)) {
        $classes[] = 'active';
      }
    }
    $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
    $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);
    $classes[] = 'menu-' . $slug;
    $classes = array_unique($classes);
    return array_filter($classes, 'is_element_empty');
  }
}

/**
 * Turn off Sage Navwalker
 *
 * Check if Sage NavWalker is enabled
 * Turn it off if it is
 */
function sagextra_disable_walker() {
  if (current_theme_supports('soil-nav-walker')) {
    remove_theme_support('soil-nav-walker');
  }
}

/**
 * Clean up wp_nav_menu_args
 *
 * Remove the container
 * Use Sagextra_Nav_Walker() by default
 * Remove the id="" on nav menu items
 */
function sagextra_nav_menu_args($args = '') {
  $sagextra_nav_menu_args['container'] = false;
  if (!$args['items_wrap']) {
    $sagextra_nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
  }
  if (current_theme_supports('bootstrap-top-navbar') && !$args['depth']) {
    $sagextra_nav_menu_args['depth'] = 2;
  }
  if (!$args['walker']) {
    $sagextra_nav_menu_args['walker'] = new Sagextras_Nav_Walker();
  }
  return array_merge($args, $sagextra_nav_menu_args);
}

/**
 * Utility classes.
 */
function is_element_empty($element) {
  $element = trim($element);
  return !empty($element);
}

function url_compare($url, $rel) {
  $url = trailingslashit($url);
  $rel = trailingslashit($rel);
  if ((strcasecmp($url, $rel) === 0) || sagextra_root_relative_url($url) == $rel) { 
    return true; 
  } else {
    return false;
  }
}

add_action( 'after_setup_theme', 'sagextra_disable_walker' );
add_filter('wp_nav_menu_args', 'sagextra_nav_menu_args');
add_filter('nav_menu_item_id', '__return_null');