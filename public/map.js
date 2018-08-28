var map;
var currentCenter;

var lastPosition = {lat: 0,lng: 0};


function initCurrentMap(geoLat, geoLon){
  geocoder = new google.maps.Geocoder();
        geoLat = geoLat || 51.5255000;
        geoLon = geoLon || -0.0795000;

      currentCenter = {lat: geoLat,lng: geoLon};
 
      //map options
      var options = {
        zoom: 11,
        center: {lat: geoLat,lng: geoLon}
      }

      //new map
      map = new google.maps.Map(document.getElementById('map'), options);

      //callback to initiate markers
      map_panels_populate(function(loc_array){

        for (var p = 0;p < loc_array.length;p++) {

          var temp_latlng = loc_array[p].split(":");
          var latitude = Number(temp_latlng[0]);
          var longitude = Number(temp_latlng[1]); 

          // Add Markers
          let lastKnownLocation = new google.maps.Marker({
            position: {lat: latitude,lng: longitude},
            map: map,
            animation: google.maps.Animation.DROP
            // icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
          })
        }
      }, null)
    
    }


//////////////////////////////////////////////////////////////////////////////////////
//These two functions perform a recet on the maps in the tabs so that they both appear
function ResetMap1() {
     //setTimeout(function(){
    //google.maps.event.trigger(map, 'resize');
    map.setCenter(currentCenter);
    map.setZoom(11);
    // window.location.hash = '#currentLoc';
    // }, 500);
}

// function ResetMap2() {
//    setTimeout(function(){
//       google.maps.event.trigger(map2, 'resize');
//  map2.setCenter(currentCenter);
//  map.setZoom(11);
//    window.location.hash = '#prevLoc';
//   }, 500);
// }
