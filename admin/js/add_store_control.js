
    var address001 = [];
    var address002 = [];
    var address003 = [];
    var address004 = [];

  //Add store section
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 51.5255000, lng: -0.0795000},
      zoom: 13
    });
    var card = document.getElementById('pac-card');
    var input = document.getElementById('pac-input');
    var types = document.getElementById('type-selector');
    var strictBounds = document.getElementById('strict-bounds-selector');
    var completeAddress = document.getElementById('complete_address');

    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

    var autocomplete = new google.maps.places.Autocomplete(input);

    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);
    var marker = new google.maps.Marker({
      map: map,
      anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
      infowindow.close();
      infowindowContent.style.display = 'block';

      marker.setVisible(false);
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }

      // If the place has a geometry, then present it on a map.
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
      }
      marker.setPosition(place.geometry.location);
      marker.setVisible(true);

      console.log("place", place.geometry.location.lat() + ":" + place.geometry.location.lng());
      completeAddress.value = place.geometry.location.lat() + ":" + place.geometry.location.lng();


      if (place.address_components) {

        for (var i = 0; i < place.address_components.length; i++) {

          if (place.address_components[i].types[0] === 'street_number' ||
           place.address_components[i].types[0] === 'route' ||
           place.address_components[i].types[0] === 'premise') {
             address001.push(place.address_components[i].long_name);
          } else if (place.address_components[i].types[0] === 'postal_town' ||
           place.address_components[i].types[0] === 'locality' ) {
             address002.push(place.address_components[i].long_name);
          } else if (place.address_components[i].types[0] === 'postal_code') {
             address003.push(place.address_components[i].long_name);
          } else if (place.address_components[i].types[0] === 'country') {
             address004.push(place.address_components[i].long_name);
          } 

        }

        address001.join(' ');
        address002.join(' ');
        address003.join(' ');
        address004.join(' ');
      }

      var title = document.getElementById("pac-title").value;

      infowindowContent.children['place-icon'].src = place.icon;
      infowindowContent.children['place-title'].textContent = title;
      //infowindowContent.children['place-name'].textContent = place.name;
      infowindowContent.children['place-address1'].textContent = address001;
      infowindowContent.children['place-address2'].textContent = address002;
      infowindowContent.children['place-address3'].textContent = address003;
      infowindowContent.children['place-address4'].textContent = address004;
      infowindow.open(map, marker);
    });
  }

  

  // $('#add_store_btn').on('click', function(){

  //   var formObject = {};

  //   formObject['title'] = document.getElementById('pac-title').value;
  //   formObject['address1'] = address001[0];
  //   formObject['address2'] = address002[0];
  //   formObject['address3'] = address003[0];
  //   formObject['address4'] = address004[0];
  //   formObject['phone'] = document.getElementById('phone').value;
  //   formObject['fax'] = document.getElementById('fax').value;
  //   formObject['email'] = document.getElementById('email').value;
  //   formObject['url'] = document.getElementById('url').value;
  //   formObject['description'] = document.getElementById('description_box').value;
  //   formObject['opening_hours'] = document.getElementById('opening_box').value;
  //   formObject['thumbnail'] = document.getElementById('file_input').value;

  //   //`thumbn${/\d/}`

  //   console.log('formObject', formObject);
    

    
  //     // $path = plugin_dir_path(__FILE__);
  //     // $new_file = fopen($path . file_name, 'wb');
  //     // fwrite($new_file, $content);
  //     // fclose($new_file);
    
  //   //send image file to backend php to create copy

  //   //need to store image with increasing/random file name in pictures file

  //   // and then store the route to that file in the in the formObject
  //   // finally you want to trigger the ajax call synchronously

  //   jQuery.ajax({
  //             type: "POST",
  //             url: ajaxurl,
  //             data: {action: 'add_customer',  
  //             title: formObject.title,
  //             address1: formObject.address1,
  //             address2: formObject.address2,
  //             address3: formObject.address3,
  //             address4: formObject.address4,
  //             phone: formObject.phone,
  //             fax: formObject.fax,
  //             email: formObject.email,
  //             url: formObject.url,
  //             description: formObject.description,
  //             opening_hours: formObject.opening_hours,
  //             thumbnail: formObject.thumbnail
  //           },
  //             success: function (data) {
  //                 if (data) {
  //                   console.log(data);
  //                 } 
  //           },
  //             error: function (error) {
  //                 console.log(error);
  //           }
  //         });  
  //   //location.reload();
  // });

///////////drop image controls
var thumbImg = document.getElementById('thumb_opacity');

  /* events fired on the drop targets */
  thumbImg.addEventListener("dragenter", function( event ) {
      // prevent default to allow drop
      event.preventDefault();
      $("#thumb_opacity").css('opacity', '0.5')
  }, false);

  thumbImg.addEventListener("dragleave", function( event ) {
      // reset the transparency
      event.preventDefault();
      $("#thumb_opacity").css('opacity', '0.01')
  }, false);

  thumbImg.addEventListener("dragover", function( event ) {
      // prevent default to allow drop
      event.preventDefault();
  }, false);

  thumbImg.addEventListener("drop", function( event ) {
      // prevent default action (open as link for some elements)
      event.preventDefault();
      var files = event.target.files || event.dataTransfer.files;
      parseFile(files)
     $("#thumb_opacity").css('opacity', '0.01')
  }, false);

/////////upload new image controls
  var parseFileCounter = 0;

  function parseFile(files) {

    var preview = document.getElementById('preview');
    for (var i = 0; i < files.length; i++) {
        var file = files[i];

      if (!file.type.startsWith('image/')){ continue }
        
        var img = document.createElement("img");
        img.classList.add("obj");
        img.id = `thumb${parseFileCounter+1}`;
        img.file = file;

        preview.removeChild(document.getElementById(`thumb${parseFileCounter}`));
        preview.appendChild(img); 

        var reader = new FileReader();
        reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
        reader.readAsDataURL(file);

        parseFileCounter++;
    }
  }
  
////opens file selector
$('#change_img_btn').on('click', function(){
  $('#file_input').click();
});

////puts selected file into parseFile() 
document.getElementById('file_input').onchange = function (event) {
  event.preventDefault();
      var files = event.target.files || event.dataTransfer.files;
      parseFile(files)
};

////replaces current image with placeholder
$('#remove_img_btn').on('click', function(){
  document.getElementById(`thumb${parseFileCounter}`).src = "../wp-content/plugins/loci_store_locator/admin/placeholder5-01.png";
});
