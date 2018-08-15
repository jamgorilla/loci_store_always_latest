<?php  // Admin settings page

// exit if file is called directly
if ( ! defined('ABSPATH')) {
  exit;
}


// display the plugin settings page
function myplugin_display_settings_page() {

  // check if user is allowed access
  if ( ! current_user_can( 'manage_options' ) ) return;

  ?>


<div class="wrap">
  <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    
  <style>
    #map {
      height: 300px;
      width: 400px;
      border: 2px solid gray;
    } 
    #add_container {
      background: WhiteSmoke;
      float: left;
      box-shadow: 10px 10px Gainsboro;
      width: 430px;
    }
    #stores_container {
      background: WhiteSmoke;
      float: left;
      box-shadow: 10px 10px Gainsboro;
      width: 100%;
    }
    textarea {
      width: 400px;
      padding: 5px 0px 50px 4px;
      }
    input {
      width: 400px;
    } 
    p {
      font-weight: normal;
      font-family: Calibri; 
      font-size: 16px;
      opacity: 0.9;
    }
    #distance_radio {
      font-weight: normal;
      font-family: Calibri; 
      font-size: 16px;
      vertical-align: -15%;
      opacity: 0.9;
    }
    #thumb_label {
      font-weight: normal;
      font-family: Calibri; 
      font-size: 16px;
      vertical-align: top;
      padding: 0px 0px 5px 2px;
      margin: 0px 0px 20px 0px;
      height: 10px;
      opacity: 0.9;
    }
    #new_img {
      height: 160px;
      width: 226.6px;
    }
    div > img {
      height: 160px;
      width: 226.6px;
    }
    #place-icon{
      height: 16px;
      width: 16px;
    }
    table, th, td {
      border: 1px solid black;
    }


  </style>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<div id="table_container" class="container" style="width: 100%;">

  <ul class="nav nav-tabs">
     <li class="active"><a data-toggle="tab" href="#currentStores">Current Stores</a></li>
      <li ><a data-toggle="tab" href="#addStore">Add Store</a></li>
      <li ><a data-toggle="tab" href="#styling">Styling</a></li>
      <li ><a data-toggle="tab" href="#settings">Settings</a></li>
  </ul>

    <div class="tab-content">
        <div id="currentStores" class="tab-pane fade in active">
        </br>
            <div id="stores_container" class="container">
              <h1>Current List of Stores</h1>
              <table id="store_list_table" class="table table-striped" style="background: white;">
                <thead class="thead-dark">
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Address Line 1</th>
                    <th>Address Line 2</th>
                    <th>Address Line 3</th>
                    <th>Address Line 4</th>
                    <th>Phone</th>
                    <th>Fax</th>
                    <th>Email</th>
                    <th>Url</th>
                    <th>Description</th>
                    <th>Opening hours</th>
                    <th>Thumbnail File</th>
                    <th>Location Code</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
        </div>
        <div id="addStore" class="tab-pane fade">
          </br>
          <form action="../wp-content/plugins/loci_store_locator/admin/form_input_control.php" method="POST" enctype="multipart/form-data">
          <div id="add_container" class="container">
            <h1>Add store</h1>
            </br>
            <input name="pac-title" id="pac-title" type="text" 
                placeholder="Enter store title">

            <br></br>
              <div id="pac-container">
                <input id="pac-input" type="text"
                    placeholder="Enter store location">
              <br></br>
              </div>
            <div class="pac-card" id="pac-card">
            </div>

            <div id="map"></div>
            <div id="infowindow-content" style="display: none;vertical-align: middle;">
              <img src="" width="16" height="16" id="place-icon">
              <strong id="place-title"></strong><br>
              <!--<span id="place-name"  class="title"></span><br>-->
              <span id="place-address1"></span></br>
              <span id="place-address2"></span></br>
              <span id="place-address3"></span></br>
              <span id="place-address4"></span>
            </div>  

              <input id="address1" name="address1" style="display: none;"></input>
              <input id="address2" name="address2" style="display: none;"></input>
              <input id="address3" name="address3" style="display: none;"></input>
              <input id="address4" name="address4" style="display: none;"></input>
              <input id="complete_address" name="complete_address" style="display: none;"></input>

            <p style="padding: 20px 0px 0px 0px;">Optional Details:</p>

                  <input name="phone" id="phone" type="text"
                    placeholder="Phone">
                  <br></br>

                  <input name="fax" id="fax" type="text"
                    placeholder="Fax">
                  <br></br>

                  <input name="email" id="email" type="text"
                    placeholder="Email">
                  <br></br>

                  <input name="url" id="url" type="text"
                    placeholder="Url">
                  <br></br>

                  <textarea name="description" id="description_box" name="Text1" cols="40" rows="3" 
                    placeholder="Description"></textarea>
                  <br></br>

                  <textarea name="opening_hours" id="opening_box" name="Text2" cols="40" rows="3" 
                    placeholder="Opening hours"></textarea>
                  <br></br>
                          
                  <p id="thumb_label">Current Image:</p>
                   
                  <input type="file" name="file_input" id="file_input" style="display: none;">

                  <div id="thumb_opacity" style="height: 160px;width: 226.6px;background-color: black;z-index:1;position: absolute;opacity: 0.01;">
                  </div>
                    <div id="preview">
                      <img id="thumb0" src="../wp-content/plugins/loci_store_locator/admin/placeholder5-01.png" 
                    style="height: 160px;width: 226.6px;">
                  </div>

                  <br></br>
             
                  <button type="button" id="change_img_btn" class="btn btn-info">Change Image</button>
           
                  <button type="button" id="remove_img_btn" class="btn btn-info">Remove Image</button>                        
                 
                  <button type="submit" name="form_submit" id="add_store_btn" class="btn btn-primary" style="float: right;">Add Store</button>  
                  
                  </form>
                  
                  <br></br>
                  
          </div>
        </div> 
        
        <div id="styling" class="tab-pane fade">
          <h1>Style Placeholder</h1>

                <h2>Location box display</h2>

                   <select>
                    <option >Select box dimensions</option>
                    <option id="d1">700px x 200px</option>
                    <option id="d2">800px x 300px</option>
                    <option id="d3">800px x 300px</option>
                    <option id="d4">50% x 30%</option>
                  </select>

                  <select id="themeDropdown" onchange="setPicture();">
                    <option value="red.png">Select a Theme</option>
                    <option value="red.png">Red</option>
                    <option value="white.png">White</option>
                    <option value="white.png">Transparent</option>
                    <option value="white.png">Black</option>
                  </select>

                  <img id="showPreview" src="./wp-content/plugins/loci_store_locator/admin/red.png" width="450" height="300" style="float: right;">

        </div>

        <div id="settings" class="tab-pane fade">
          <h1>Settings Placeholder</h1>

                <input type="radio"></input>
                <label id="distance_radio">Include customer distance from current location</label>
                <br></br>

                <input type="radio">
                <label>Locate users device geolocation to automatically center map</label>
        </div>

    </div>
</div>

<script>
    //load current stores data table
    $( document ).ready(function() {

      retrieveStoreData(function(btn, row){

        $('.btn-danger').on('click', function(e){
          var rowNum = e.target.id.slice(4, 5);
          $(`#row${rowNum}`).remove();
          removeStore(rowNum);
        })

      });
    });

    $('#place-address1').on('DOMSubtreeModified',function(){
      document.getElementById('address1').value = document.getElementById('place-address1').innerHTML;
    })

    $('#place-address2').on('DOMSubtreeModified',function(){
      document.getElementById('address2').value = document.getElementById('place-address2').innerHTML;
    })

    $('#place-address3').on('DOMSubtreeModified',function(){
      document.getElementById('address3').value = document.getElementById('place-address3').innerHTML;
    })

    $('#place-address4').on('DOMSubtreeModified',function(){
      document.getElementById('address4').value = document.getElementById('place-address4').innerHTML;
    })

</script>

<script src="../wp-content/plugins/loci_store_locator/admin/js/add_store_control.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcvdwJXnRdAa3TNcwDt5emB7Z4Mpc_Zl8&libraries=places&callback=initMap"
async defer></script>

      <script type="text/javascript">        


      //styling section     
        function setPicture() {
          var img = document.getElementById("themeDropdown");
          var value = img.options[img.selectedIndex].value;
          document.getElementById("showPreview").src =
                  "../wp-content/plugins/loci_store_locator/admin/" + value;
        }
        setPicture();
      </script>


     


    <script>
      
      function searchAddress() {

  
      }

      function removeStore(rowID) {
        
        jQuery.ajax({
              type: "POST",
              url: ajaxurl,
              data: {action: 'remove_store',
              id: rowID},
              success: function () {

              }
          })

      }

      function retrieveStoreData(callback) {

        var storeObj = {};
        
        jQuery.ajax({
              type: "GET",
              url: ajaxurl,
              data: {action: 'retrieve_store_data'},
              success: function (data) {
                    
                    var seperatedData = data.split('"');
                    var count = 1;
                    var key = 1;


                    for (var i = 0;i < seperatedData.length;i++ ) {
                      if (i%2!==0) {
                        if (count%2===0) {
                          storeObj[key] = seperatedData[i];
                          key++;
                        } 
                        count++;
                      }
                    }
                  
                    //inserting the database table into the current store table
                    var table = document.getElementById('store_list_table');
                    var row;
                    var cell;
                    var rowID;

                    //console.log(storeObj);

                    for (var j = 1;j < Object.keys(storeObj).length+1;j++ ) { 

                      ///////////////////////////////////////////
                      if ((j+13)%14 === 0) {
                        rowID = storeObj[j];
                        row = table.insertRow(Math.floor(j/14)+1);
                        row.id = 'row' + rowID;
                        cell = row.insertCell(j-1-(14*Math.floor(j/14)));
                        cell.innerHTML = storeObj[j];
                      } else if (j%14 === 0) {
                        cell = row.insertCell(j-1-(14*Math.floor(j/14)));
                        cell.innerHTML = storeObj[j];
                        var btn = document.createElement('BUTTON');
                        btn.type = "button";
                        btn.className = "btn btn-danger";
                        btn.innerHTML = 'delete';
                        btn.style.width = '100%';
                        btn.id = 'cell' + rowID;
                        row.appendChild(btn);
                      } else {
                        cell = row.insertCell(j-1-(14*Math.floor(j/14)));
                        cell.innerHTML = storeObj[j];
                      }
                      //////////////////////////////////////////
                  }
                        var tableContainer = document.getElementById('table_container');
                        tableContainer.style.width = '120%';
                        callback(btn, row);
                }
            });
      }


      function addCustomer() {

            jQuery.ajax({
              type: "POST",
              url: ajaxurl,
              data: {action: 'add_customer',  
              msisdn: input.value,
              months: expiration.value},
              success: function (data) {
                    console.log(data)

                }
            });   
      }



    </script>


  </div>

  <?php


}








