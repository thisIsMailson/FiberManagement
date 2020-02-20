
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://www.google.com/jsapi?.js"></script>

    <div id="map" style="width:auto;height:400px;">YOLO</div>
   <script type="text/javascript">

            $(document).ready(function() {
                var infowindow;
            var map;
            var red_icon =  'http://maps.google.com/mapfiles/ms/icons/red-dot.png' ;
            var purple_icon =  'http://maps.google.com/mapfiles/ms/icons/purple-dot.png' ;
            var myOptions = {
                zoom: 15,
                center: new google.maps.LatLng( 14.918313, -23.512537),
                mapTypeId: 'roadmap'
            };
            map = new google.maps.Map(document.getElementById('map'), myOptions);

            /**
             * Global marker object that holds all markers.
             * @type {Object.<string, google.maps.LatLng>}
             */
            var markers = {};

             /**
             * Concatenates given lat and lng with an underscore and returns it.
             * This id will be used as a key of marker to cache the marker in markers object.
             * @param {!number} lat Latitude.
             * @param {!number} lng Longitude.
             * @return {string} Concatenated marker id.
             */
            var getMarkerUniqueId= function(lat, lng) {
                return lat + '_' + lng;
            };

            /**
             * Creates an instance of google.maps.LatLng by given lat and lng values and returns it.
             * This function can be useful for getting new coordinates quickly.
             * @param {!number} lat Latitude.
             * @param {!number} lng Longitude.
             * @return {google.maps.LatLng} An instance of google.maps.LatLng object
             */
            var getLatLng = function(lat, lng) {
                return new google.maps.LatLng(lat, lng);
            };

             /**
             * Binds click event to given map and invokes a callback that appends a new marker to clicked location.
             */
            var addMarker = google.maps.event.addListener(map, 'click', function(e) {
                var lat = e.latLng.lat(); // lat of clicked point
                var lng = e.latLng.lng(); // lng of clicked point

                console.log('LAT: ' + lat + ' LONG: ' + lng)
                var markerId = getMarkerUniqueId(lat, lng); // an that will be used to cache this marker in markers object.
                var marker = new google.maps.Marker({
                    position: getLatLng(lat, lng),
                    map: map,
                    animation: google.maps.Animation.DROP,
                    id: 'marker_' + markerId,
                    html: "    <div id='info_"+markerId+"'>\n" +
                    "        <table class=\"map1\">\n" +
                    "            <tr><td></td><td><input type='button' value='Save' onclick='js:saveIt("+lat+","+lng+")'/></td></tr>\n" +
                    "        </table>\n" +
                    "    </div>"
                });
                markers[markerId] = marker; // cache marker in markers object
                bindMarkerEvents(marker); // bind right click event to marker
                bindMarkerinfo(marker); // bind infowindow with click event to marker
            });

             /**
             * Binds  click event to given marker and invokes a callback function that will remove the marker from map.
             * @param {!google.maps.Marker} marker A google.maps.Marker instance that the handler will binded.
             */
            var bindMarkerinfo = function(marker) {
                google.maps.event.addListener(marker, "click", function (point) {
                    var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
                    var marker = markers[markerId]; // find marker
                    infowindow = new google.maps.InfoWindow();
                    infowindow.setContent(marker.html);
                    infowindow.open(map, marker);
                    // removeMarker(marker, markerId); // remove it
                });
            };

            /**
             * Binds right click event to given marker and invokes a callback function that will remove the marker from map.
             * @param {!google.maps.Marker} marker A google.maps.Marker instance that the handler will binded.
             */

            var bindMarkerEvents = function(marker) {
                google.maps.event.addListener(marker, "rightclick", function (point) {
                    var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
                    var marker = markers[markerId]; // find marker
                    removeMarker(marker, markerId); // remove it
                });
            };

            /**
             * Removes given marker from map.
             * @param {!google.maps.Marker} marker A google.maps.Marker instance that will be removed.
             * @param {!string} markerId Id of marker.
            */
            var removeMarker = function(marker, markerId) {
                marker.setMap(null); // set markers setMap to null to remove it from map
                delete markers[markerId]; // delete marker instance from markers object
            };
            function saveIt() {
                console.log('some')
            }
            function saveData(lat,lng) {
                console.log('saving..')
                console.log('Latitude: ' + lat + ', Longitude: ' + lng)
                var description = document.getElementById('manual_description').value;
                var url = 'locations_model.php?add_location&description=' + description + '&lat=' + lat + '&lng=' + lng;
                downloadUrl(url, function(data, responseCode) {
                    if (responseCode === 200  && data.length > 1) {
                        var markerId = getMarkerUniqueId(lat,lng); // get marker id by using clicked point's coordinate
                        var manual_marker = markers[markerId]; // find marker
                        manual_marker.setIcon(purple_icon);
                        infowindow.close();
                        infowindow.setContent("<div style=' color: purple; font-size: 25px;'> Waiting for admin confirm!!</div>");
                        infowindow.open(map, manual_marker);

                    }else{
                        console.log(responseCode);
                        console.log(data);
                        infowindow.setContent("<div style='color: red; font-size: 25px;'>Inserting Errors</div>");
                    }
                });
            }

            });
            

    </script>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyAUw0-Dsf0cT40H6UVfMLTtAFIVP3RmLdE">
    </script>

<?php 
$script = <<< JS
   $(document).ready(function() {
    });

JS;
$this->registerJs($script);

?>