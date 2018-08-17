<?php
/*
Plugin Name: Loci Store Locator
Description: This is a store locator plugin designed to add custom locations to a store section on a Wordpress site.
Plugin URI: http://www.jamesmurphy.tech
Author: James Murphy
Version: 1.0
License: none
License URI: none
*/

// exit if file is called directly
if (! defined( 'ABSPATH')) {
  exit;
}


function createStoreTable() {
  global $wpdb;

  $table_name = $wpdb->prefix.'store_details_table';

  if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
     //table not in database. Create new table
     $charset_collate = $wpdb->get_charset_collate();
 
     $sql = "CREATE TABLE $table_name (
          id mediumint(9) NOT NULL AUTO_INCREMENT,
          title text NOT NULL,
          address1 text NOT NULL,
          address2 text NOT NULL,
          address3 text NOT NULL,
          address4 text NOT NULL,
          phone text NOT NULL,
          fax text NOT NULL,
          email text NOT NULL,
          url text NOT NULL,
          description text NOT NULL,
          opening_hours text NOT NULL,
          thumbnail_link text NOT NULL,
          location_code text NOT NULL,
          UNIQUE KEY id (id)
     ) $charset_collate;";
     require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
     dbDelta( $sql );
  } else {
    $tamp = 'table exists already';
    print_r($tamp);
  }
}

register_activation_hook( __FILE__, 'createStoreTable' );

// if admin area
if ( is_admin() ) {
  // include dependencies
 require_once plugin_dir_path(__FILE__) . 'admin/admin_menu.php';
 require_once plugin_dir_path(__FILE__) . 'admin/admin_settings_page.php';
 require_once plugin_dir_path(__FILE__) . 'admin/add_remove_function.php';
 //require_once plugin_dir_path(__FILE__) . 'admin/form_input_control.php';
 //add_action('init', 'wp_jm_form_handle');
}


//debug tool - delete after completion
  function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);
    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

require_once plugin_dir_path(__FILE__) . 'includes/database_actions.php';


function initialize(){
    $root = explode("wp-content/", (string)get_template_directory_uri())[0];
    //$login_path = $root . "wp-content/plugins/loci_store_locator/login.js";
    $map_details_call = $root . "wp-content/plugins/loci_store_locator/public/map_details_call.js";
    $android_locate = $root . "wp-content/plugins/loci_store_locator/images/location-512.png";
    $magnifying_glass = $root . "wp-content/plugins/loci_store_locator/images/magnifying_glass2.png";
    $blank_map_marker = $root . "wp-content/plugins/loci_store_locator/images/map-marker-icon3.png";
    $search_bar = $root . "wp-content/plugins/loci_store_locator/public/search_bar.js";    
    $plugin_path = $root . "wp-content/plugins/loci_store_locator/public/map.js";
    debug_to_console($root);


    require ( plugin_dir_path(__FILE__) . 'public/login_form.php');   

    return $login_form;
  }

  add_shortcode('JMmap', 'initialize');
?>
