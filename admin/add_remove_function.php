<?php // Add and remove functions

if (! defined( 'ABSPATH')) {
  exit;
}


function myplugin_add_customer( ) {

    if ($_POST['msisdn']) {

      $msisdn = $_POST['msisdn'];
      $setup = date("Y-m-d");
      $months = $_POST['months'];
      $effectiveDate = strtotime('+' . $months . ' months', strtotime($setup)); // returns timestamp
      $expiration = date('Y-m-d', $effectiveDate); // formatted version
      

      if (ctype_digit($msisdn)) {

        global $wpdb;
        
        // check if msisdn already exists
            $exists = $wpdb->get_var(
            $wpdb->prepare("SELECT user_id FROM wp_mobile_user_table WHERE msisdn=$msisdn", ARRAY_A));
            
            //debug_to_console($exists);   
            
            if ($exists >= 1) {
              echo 'This customer msisdn already exists';
            } else {
            
            $sql = $wpdb->insert( 
                'wp_mobile_user_table', 
              array( 
                'msisdn' => $msisdn, 
                'setup' => $setup,
                'expiration' => $expiration
              ), 
              array( 
                '%s', 
                '%s',
                '%s'
              ) 
            );

         if ($sql) {
            // retrieve user ID for msisdn number
            $user_id_num = $wpdb->get_results(
                    $wpdb->prepare("SELECT user_id FROM wp_mobile_user_table WHERE msisdn=$msisdn", ARRAY_A));

            if ($user_id_num) {

              $values = array_values($user_id_num);
              $resp = array($values[0]);
              $sum = $resp[0]->user_id;
              $user_id = $sum;

                $sql = $wpdb->insert( 
                    'wp_mobile_user_location', 
                  array( 
                    'user_id' => $user_id
                  ), 
                  array( 
                    '%s'
                  ) 
                );
              
              echo 'New customer successfully inserted';
            } else {
              echo 'error in retrieving user id from user table';
            }
         } else {
          echo 'error in inserting into table';
         } 
        } 
      } else {
        echo 'false';
      }
  }
}


function myplugin_remove_customer( ) {

  $msisdn = $_POST['msisdn'];
  
  global $wpdb;

   

  if ($msisdn) {
    if (ctype_digit($msisdn)) { 
    
      
    
            // retrieve user ID for msisdn number
            $user_id_num = $wpdb->get_results(
                    $wpdb->prepare("SELECT user_id FROM wp_mobile_user_table WHERE msisdn=$msisdn", ARRAY_A));
          
            
        
            if ($user_id_num) {

              $values = array_values($user_id_num);
              $resp = array($values[0]);
              $sum = $resp[0]->user_id;
              
              $user_id = $sum;
              


                $sql = $wpdb->delete( 
                    'wp_mobile_user_location', 
                  array( 
                    'user_id' => $user_id
                  ), 
                  array( 
                    '%s'
                  ) 
                );
              
                            
              // delete from user table
                $sqlm = $wpdb->delete( 
                    'wp_mobile_user_table', 
                  array( 
                    'user_id' => $user_id
                  ), 
                  array( 
                    '%s'
                  ) 
                );
              
              
              echo 'New customer successfully removed';
              
      } else {
        echo 'msisdn not listed';
      } 
    } else {
      echo 'not number';
    } 
  }
}



add_action('wp_ajax_add_customer', 'myplugin_add_customer');
add_action('wp_ajax_remove_customer', 'myplugin_remove_customer');