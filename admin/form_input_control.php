<?php  // Admin settings page

// exit if file is called directly
// if ( ! defined('ABSPATH')) {
//   exit;
// }

//output buffering turned on for this page
ob_start();

//requiring wp-load.php as this page is not linked to main wordpress boot but 
// need wordpress functionality for $wpdb database methods
require_once dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/testenvironment/wp-load.php';


function wp_jm_form_handle(){


if(isset($_POST['form_submit'])) {

 $file = $_FILES['file_input'];

 $fileName = $_FILES['file_input']['name'];
 $fileTmpName = $_FILES['file_input']['tmp_name'];
 $fileSize = $_FILES['file_input']['size'];
 $fileError = $_FILES['file_input']['error'];
 $fileType = $_FILES['file_input']['type'];
  
 $fileExt = explode('.', $fileName);
 $fileActualExt = strtolower(end($fileExt));

 $allowed = array('jpg', 'jpeg', 'png', 'pdf');

 if (in_array($fileActualExt, $allowed)) {
   if ($fileError === 0) {
     if ($fileSize < 1000000) {

        //creates unique id for image
        $fileNameNew = uniqid('', true).".".$fileActualExt;
        
        // moves image file from temporary storage to plugin folder
        $fileDestination = "../images/".$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);

        ///////////////////////////////////////////////////////////
        $prefix = 'wp_';

        global $wpdb;
        
        $title = $_POST['pac-title'];
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
        $complete_address = $_POST['complete_address'];

        //print_r($title.$prefix.'store_details_table');

          //$wpdb->show_errors();

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
                'opening_hours' => $opening_hours,
                'thumbnail_link' => $fileNameNew,
                'location_code' => $complete_address
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
                '%s',
                '%s',
                '%s'
                ) 
              );

            //$wpdb->print_error();

            // if (!$sql) {
            //   print_r('error');
            // }


            // brings client back to admin page
            header("Location: http://www.testenvironment.jamesmurphy.tech/wp-admin/admin.php?page=myplugin");

         } else {
            echo "Your file is too big - 1MB limit";
         }
       } else {
        echo "There was an error uploading your file.";
       }
     } else {
       echo "You cannot upload image files of this type.";
     }

    }

}


wp_jm_form_handle();


