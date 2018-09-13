function searchFunction(event) {

  var input = document.getElementById('myinput');

  //send to google maps api for geolocation lat lng

  //console.log(input,event.key,event, locations_array)

  //var targetLatitude, targetLongitude;


  if (event.key === "Enter" || event === "Enter") {

    var postcode = input.value;
    
    geocoder.geocode( { 'address': postcode}, function(results, status) {

      //console.log('RESULT', status, results, results[0].geometry.location.lat())
      
      // var targetLatitude = results[0].geometry.location.lat(); 
      // var targetLongitude = results[0].geometry.location.lng();

          //TO DO DELETE OLD LIST FIRST
          //document.getElementById("scrolling_store_list").empty();
          //ul.innerHTML = '';
          $("#scrolling_store_list").empty();

        map_panels_populate(function(loc_array){

          console.log('loc_array', loc_array)
          console.log(markers)
          markers = [];
          console.log(markers)
        for (var p = 0;p < loc_array.length;p++) {

          var temp_latlng = loc_array[p].split(":");
          var latitude = Number(temp_latlng[0]);
          var longitude = Number(temp_latlng[1]); 

          // Add Markers
          lastKnownLocation = new google.maps.Marker({
            position: {lat: latitude,lng: longitude},
            map: map,
            animation: google.maps.Animation.DROP
            // icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
          })
          markers.push(lastKnownLocation)
        }
        loc_array = [];
      }, [results[0].geometry.location.lat(), results[0].geometry.location.lng()])

        //map_panels_populate(function(){
        //}, [results[0].geometry.location.lat(), results[0].geometry.location.lng()]);
   
    });
  
  }
  

  var filter = document.getElementById('class');

  var title = document.getElementById('store_box_titles');

  //console.log(targetLatitude, targetLongitude);

  // clear searchpanel
  //map_panels_populate(function(){
  //}, null);
}

function pressedAutoLocateButton(){

  console.log('autolocate button pressed' )

  var pos;
  //find client browser location
  if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            console.log(pos)
          }) 
  } else {
    alert('The automatic Geolocate feature is not available from this browser or website.');
  }

  /////////////////////////////
  map_panels_populate(function(){
  }, null);
}




  var rad = function(x) {
    return x * Math.PI / 180;
  };

  var getDistance = function(p1, p2) {
    var R = 6378137; // Earth’s mean radius in meter
    var dLat = rad(p2[0] - p1[0]);
    var dLong = rad(p2[1] - p1[1]);
    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
      Math.cos(rad(p1[0])) * Math.cos(rad(p2[0])) *
      Math.sin(dLong / 2) * Math.sin(dLong / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c;
    return d; // returns the distance in meter
  };


  console.log()