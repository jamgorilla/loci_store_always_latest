<?php
$login_form=<<<EOD
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="$root/wp-content/plugins/google_map_plugin/css/styles.css">

<style>
nav ul{
  height: 300px; 
  width:100%;
}
nav ul{
  overflow:hidden; 
  overflow-y:scroll;
}
#store_list{
  padding-right: 0px;
  padding-left: 0px;
}
#map_div{
  padding-right: 0px;
  height: 100%;
}
nav li{
  
  height: 125px;
  border: 1px solid black;
}
.dropdown-toggle:after {
  display: none;
}
.row{
  height: 100%;
}
#mapCon{
  width: 100%;
  height: 100%;
  border: 5px solid grey;
}
p {
  font-size: 10px;
  line-height: 2px;
  margin: 0px;
  padding-left: 0px;
}
#store_box_titles {
  margin-top: 5px;
  margin-bottom: 0px;
}
#search-bar{
  height: 50px;
  border: 5px solid gainsboro;
  position: relative;
}
#myinput{
  background-color: white;
  box-sizing: border-box;
  padding-left: 35px;
}
#auto_locate_image{
  height: 60%;
  width: auto;
  position: absolute;
  top: 8px;
  left: 6px;
}
#magnifying_glass{
  height: 75%;
  width: auto;
  position: absolute;
  top: 6px;
  right: 4px;
}
</style>


<div class="container-fluid" id="mapCon" >

  <div class="row">

        <div class="col-xs-4" id="store_list">          
            <header>
              <div id="search-bar" class="search-bar" placeholder="Search">
                <input type="text" name="search" value="" autocomplete="off"
                id="myinput" onkeyup="searchFunction(event)" placeholder="Enter address or postcode" />
                <input type="image" id="auto_locate_image" src="$android_locate" onclick="pressedAutoLocateButton()" />
                <input type="image" id="magnifying_glass" src="$magnifying_glass" onclick="searchFunction('Enter')"/>
              </div>
            </header>
                <nav>
                    <ul id="scrolling_store_list">
                    </ul>
                </nav>
        </div>

        <div class="col-xs-8" id="map_div">
          <div style="width: 100%;" id="map" >
          </div>
        </div>

  </div>
</div>


<script type="text/javascript" src="$map_details_call"></script>
<script src="$login_path"></script>
<script src="$plugin_path"></script>
<script src="$search_bar"></script>
<script async defer
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcvdwJXnRdAa3TNcwDt5emB7Z4Mpc_Zl8&libraries=places&callback=initCurrentMap">
</script>
EOD;

?>