var locations_array = [];

function map_panels_populate(callback){

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

                for (var i = 0;i < cleansed_data.length; i++) {

                  var ul = document.getElementById("scrolling_store_list");
                  var li = document.createElement("li");

                  if (i%28===0) {

                    li.innerHTML = '<h3 id="store_box_titles">' + cleansed_data[i+3] + 
                    '<p style="float: right;margin-top: 3px;margin-right: 3px;">1.5mi</p></h3><p>' + cleansed_data[i+5] + '</p><p>' + cleansed_data[i+7] + 
                    '</p><p>' + cleansed_data[i+9] + '</p><p>' + cleansed_data[i+11] + 
                    '</p><p></p><div class="btn-group">' +
                          '<button style="width: 100px;height: 30px;font-size: 10px;" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                            'Opening Times' +
                          '</button>' +
                          '<div class="dropdown-menu">' +
                            '<p style="padding-left: 10px;font-size: 12px;" class="dropdown-item" >' + cleansed_data[i+23].replace(/\r?\n|\r/g, '<br style="line-height: 15px;">') + '</p>' +
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
