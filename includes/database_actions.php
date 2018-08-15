<?php  // Admin settings page

// exit if file is called directly
if ( ! defined('ABSPATH')) {
  exit;
}


function _2WA_add_customer() {

  $prefix = 'wp_';

  global $wpdb;
  
  $title = $_POST['title'];
  $address1 = $_POST['address1'];
  $address2 = $_POST['address2'];
  $address3 = $_POST['address3'];
  $address4 = $_POST['address4'];
  $phone= $_POST['phone'];
  $fax = $_POST['fax'];
  $email = $_POST['email'];
  $url = $_POST['url'];
  $description = $_POST['description'];
  $opening_hours = $_POST['opening_hours'];
  $thumbnail = $_POST['thumbnail'];
  

    $path = plugin_dir_path(__FILE__) . 'images/';
  echo "<pre>";
    print_r($path);
    echo "</pre>";


    $new_file = fopen($path . 'test.txt', 'w+');
    if (fwrite($new_file, 'Text to insert') == false)
      echo $new_file;
    fclose($new_file);

    
      $sql = $wpdb->insert( 
          $prefix . 'store_details_table', 
        array( 
          'title' => $title, 
          'address1' => $address1,
          'address2' => $address2,
          'address3' => $address3,
          'address4' => $address4,
          'phone' => $phone,
          'fax' => $fax,
          'email' => $email,
          'url' => $url,
          'description' => $description,
          'opening_hours' => $opening_hours
        ), 
        array( 
          '%s', 
          '%s',
          '%s', 
          '%s',
          '%s', 
          '%s',
          '%s', 
          '%s',
          '%s', 
          '%s',
          '%s'
        ) 
      );
}

function _2WA_retrieve_store_data(){

  global $wpdb;

  $row = $wpdb->get_results( "SELECT * FROM wp_store_details_table");

  var_dump($row); 
}

function _2WA_remove_store () {

  global $wpdb;

  $id = $_POST['id'];

  $table = 'wp_store_details_table';

  $wpdb->delete( $table, array( 'id' => $id ) );
}




add_action( 'wp_ajax_retrieve_store_data', '_2WA_retrieve_store_data');
add_action( 'wp_ajax_add_customer', '_2WA_add_customer');
add_action( 'wp_ajax_remove_store', '_2WA_remove_store');
?>








