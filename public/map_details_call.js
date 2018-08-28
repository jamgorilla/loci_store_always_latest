var locations_array = [];

function map_panels_populate(callback, clientLocationOrigin){

var storeObj = {};
        
        jQuery.ajax({
              type: "GET",
              url: "/wp-admin/admin-ajax.php",
              data: {action: 'retrieve_store_data'},
              success: function (data) {

                var splitData = data.split('"');

                var cleansed_data = [];

                for (var p = 0;p < splitData.length;p++ ) {

                  if (p%2!==0) {
                    cleansed_data.push(splitData[p]);
                  }  
                }

                console.log(cleansed_data);


                if (clientLocationOrigin !== null) {
                //process based on location
                   console.log('not null', clientLocationOrigin)
                   var unorderedLocationArray = []; 

                   for (var v = 1;v <= cleansed_data.length/28;v++) {

                      //long and lat of cleansed data lnglat
                      var temp_loc = cleansed_data[(v*28)-1].split(":");
                      var cleansedLat = Number(temp_loc[0]);
                      var cleansedLng = Number(temp_loc[1]); 
 
                      var temp = getDistance([cleansedLat, cleansedLng] , clientLocationOrigin);

                      temp = Math.round(temp);
                      console.log(temp)
                      unorderedLocationArray.push([temp,v]);
                   }
                      console.log(unorderedLocationArray);

                      unorderedLocationArray.sort((a,b) => 
                        (a[0] - b[0])
                      );


                      //create order
                      console.log('orderArray', unorderedLocationArray)

                      var dispoArray = [];
                      var totalArray = [];
                      var finalArray = [];
                      
                      //reorder cleansed array based on new order
                      for (var m = 0;m < cleansed_data.length;m++) {
                          dispoArray.push(cleansed_data[m]);
                        if ((m+1)%28===0) {
                          totalArray.push(dispoArray);
                          dispoArray = [];
                        } 
                      }

                      //reorder totolArray
                      for (var n = 0;n < totalArray.length;n++) {
                         finalArray.push(totalArray[unorderedLocationArray[n][1]-1]);
                      }
                      
                      cleansed_data = finalArray.reduce((acc, val) => acc.concat(val), [])

                } else {
                  console.log('is null')
                }


                var count = 0;

                for (var i = 0;i < cleansed_data.length; i++) {

                  var ul = document.getElementById("scrolling_store_list");
                  var li = document.createElement("li");

                  if (i%28===0) {
                    count++;
                    li.innerHTML = '<div class="container" style="width: 100%;">' +
                                      '<div class="row">' +

                                          '<div class="col-sm-2" style="padding-left: 0px;padding-right: 0px;">' +
                                            '<h3 id="store_box_titles">' + 
                                            '<img style="position: absolute;padding-left: 6px;padding-right: 6px;float: left;height: 30px;width: auto;" ' + 
                                            'src="http://www.testenvironment.jamesmurphy.tech/wp-content/plugins/loci_store_locator/images/map-marker-icon2.png" />' + 
                                               '<p style="color: white;font-size: 12px;position: relative;top: 5px;left: 18px;">' + count + '</p>' +
                                          '</div>' +

                                          '<div class="col-sm-8" style="float: left;padding-top: 7px;padding-left: 0px;padding-right: 0px;">' +
                                            cleansed_data[i+3] +
                                            '</h3>' +
                                            '<div>' + '<p>' + cleansed_data[i+5] + '</p>' + 
                                              '<p>' + cleansed_data[i+7] + '</p>' + 
                                              '<p>' + cleansed_data[i+9] + '</p>' + 
                                              '<p>' + cleansed_data[i+11] + '</p>' + 
                                              '<p></p>' +
                                              '<div class="btn-group">' +
                                                '<button style="width: 100px;height: 30px;font-size: 10px;" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                                  'Opening Times' +
                                                '</button>' +
                                                '<div class="dropdown-menu">' +
                                                  '<p style="padding-left: 10px;font-size: 12px;" class="dropdown-item" >' + cleansed_data[i+23].replace(/\r?\n|\r/g, '<br style="line-height: 15px;">') + '</p>' +
                                                '</div>' +
                                              '</div>' +
                                            '</div>' +
                                          '</div>' +

                                          '<div class="col-sm-2" style="padding-top: 10px;position: relative;padding-left: 8px;padding-right: 0px;">' +
                                              '<p>1.5mi</p>' +
                                          '</div>' +

                                      '</div>' +
                                    '</div>';
                    ul.appendChild(li);

                    locations_array.push(cleansed_data[i+27])
                  }
                }
                callback(locations_array)
              }
      });

} 
