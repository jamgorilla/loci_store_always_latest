<?php  // Plugin admin menu

// exit if file is called directly
if ( ! defined('ABSPATH')) {
  exit;
}


// add top-level administrative menu
function myplugin_add_toplevel_menu() {

  /*

  add_menu_page(
    string  $page_title,
    string  $menu_title,
    string  $capability,
    string  $menu_slug,
    callable $function = '',
    string  $icon_url = '',
    int     $position = null
  );

  */

  add_menu_page(
    'Store Locator Options',
    'Loci',
    'manage_options',
    'myplugin',
    'myplugin_display_settings_page',
    'dashicons-admin-site',
    null
  );


}

add_action( 'admin_menu', 'myplugin_add_toplevel_menu' );